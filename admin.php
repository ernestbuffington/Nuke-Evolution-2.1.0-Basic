<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 Copyright (c) 2010 by The Nuke Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

define('ADMIN_FILE', true);
define('VALIDATE', true);

// Include functions
require_once(dirname(__FILE__) . '/mainfile.php');
require_once(NUKE_ADMIN_DIR.'includes/functions.php');

global $admin_file, $_GETVAR, $currentlang, $lang_admin, $userinfo;

getadmin_lang('admin');
$aid        = $_GETVAR->get('aid', '_REQUEST', 'string', '');
$pwd        = $_GETVAR->get('pwd', '_POST', 'string', '');
$admin      = evo_getcookie('admin');
$op         = $_GETVAR->get('op', '_REQUEST', 'string', '');
$fop        = $_GETVAR->get('fop', '_POST', 'string', '');
$persistent = $_GETVAR->get('persistent', '_POST', 'int', 0);
$gfx_check  = $_GETVAR->get('admingfx_check', '_POST', 'string', '');
$module     = $_GETVAR->get('module', '_REQUEST', 'string', '');

if(empty($op) && empty($module)) {
    $op = 'adminMain';
}

if( $op!='login' && (!empty($aid)) && (!isset($admin) || empty($admin)) ) {
    unset($aid, $admin);
    log_write('admin', $aid.'&nbsp;'.$lang_admin['KERNEL']['ERROR'], $lang_admin['KERNEL']['ERROR_LOG_SECURITY_BREACH']);
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['INFO_NICE_TRY']);
    exit(1);
}

include(NUKE_BASE_DIR.'ips.php');

if(isset($ips) && is_array($ips)) {
    $ip_check = implode('|^',$ips);
    if (!preg_match("/^".$ip_check."/",identify::get_ip())) {
        unset($aid);
        unset($admin);
        $name = $userinfo['username'];
        log_write('admin', $name.'&nbsp;'.$lang_admin['KERNEL']['ERROR_LOG_INVALID_IP_ADMIN'], $lang_admin['KERNEL']['ERROR_LOG_SECURITY_BREACH']);
        DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['INFO_LOGIN_WRONG_IP'].'<br />'.$lang_admin['KERNEL']['INFO_ACCESS_DENIED']);
        exit(1);
    }
    define('ADMIN_IP_LOCK',true);
}

$the_first = $db->sql_unumrows("SELECT aid FROM "._AUTHOR_TABLE);

if ($the_first == 0) {
    switch($fop) {
        case 'create_first':
            create_first();
            redirect($admin_file.'.php');
    }
    create_admin();
    exit;
}

if ( !empty($op) && ($op == 'login') && !empty($aid) && !empty($pwd) ) {
    $gfxchk = array(1,5,6,7);
    if (!security_code_check($gfx_check, $gfxchk, 'admin')) {
        login();
        exit;
    }
    if (!empty($aid) && !empty($pwd)) {
        $txt_pwd = $pwd;
        $evo_crypt = EvoCrypt1($pwd);
        $pwd = EvoCrypt($pwd);
        $admlanguage = get_admin_field('admlanguage', $aid);
        $rpwd = get_admin_field('pwd', $aid);
        //Un-evocrypt
        if ($evo_crypt == $rpwd) {
            $db->sql_query("UPDATE `"._AUTHOR_TABLE."` SET `pwd`='".$pwd."' WHERE `aid`='".$aid."'");
            $rpwd = get_admin_field('pwd', $aid);
        }
        if($rpwd == $pwd && !empty($rpwd)) {
            $admin = "$aid:$pwd:$admlanguage:$persistent";
            $time = 43200*60; // 0 = Session Cookie
            evo_setcookie('admin', $admin, $time);
            unset($txt_pwd);
            redirect($admin_file.'.php');
        } else {
            log_write('admin', $lang_admin['KERNEL']['ERROR_LOG_WRONG_ADMIN_ACCOUNT'] .' "'. $aid . '/' . $txt_pwd . '" '.$lang_admin['KERNEL']['ERROR_LOG_BUT_FAILED'], $lang_admin['KERNEL']['ERROR_LOG_SECURITY_BREACH']);
            unset($txt_pwd);
            redirect($admin_file.'.php?op=login');
        }
    } else {
        if(empty($aid) && empty($pwd)) {
            log_write('admin', $lang_admin['KERNEL']['ERROR_LOG_ADMIN_NO_USER_PASSWORD'], $lang_admin['KERNEL']['ERROR_LOG_SECURITY_BREACH']);
        } else if(empty($aid)) {
            log_write('admin', $lang_admin['KERNEL']['ERROR_LOG_ADMIN_NO_USERNAME'], $lang_admin['KERNEL']['ERROR_LOG_SECURITY_BREACH']);
        } else {
            log_write('admin', $lang_admin['KERNEL']['ERROR_LOG_ADMIN_NO_PASSWORD'], $lang_admin['KERNEL']['ERROR_LOG_SECURITY_BREACH']);
        }
        unset($op);
        unset($txt_pwd);
        redirect($admin_file.'.php?op=login');
    }
}
$admintest = 0;

if (isset($admin) && !empty($admin) && (!isset($admin1) || !is_array($admin1))) {
    $admin1 = explode(':', $admin);
    $aid = $admin1[0];
    $pwd = $admin1[1];
    $admlanguage = (isset($admin1[2])) ? $admin1[2] : 'english';
    if (empty($aid) OR empty($pwd)) {
        $admintest=0;
        log_write('admin', $lang_admin['KERNEL']['ERROR_LOG_INTRUDER_ALERT'], $lang_admin['KERNEL']['ERROR_LOG_SECURITY_BREACH']);
        die('Intruder Alert');
    }
    $aid = substr($aid, 0,30);
    $admdata = get_admin_field('*', $aid);
    if (!isset($admdata['aid']) || $admdata['aid'] != $aid || $admdata['pwd'] != $pwd) {
        evo_setcookie('admin', 'deleted', -1);
        redirect($admin_file.'.php?op=login');
    } else {
        if (($admdata['pwd'] == $pwd) && !empty($pwd)) {
            $admintest = 1;
            $persistent = intval($admin1[3]);
            $time = ($persistent ? (43200*60)  : 0); // 0 = Session Cookie
            if (!isset($op) || $op != 'logout') {
                $admin = "$aid:$pwd:$admlanguage:$persistent";
                evo_setcookie('admin',$admin,$time);
            }
        } else {
            $admdata = array();
            log_write('admin', $lang_admin['KERNEL']['ERROR_LOG_WRONG_ADMIN_ACCOUNT'] .' ' . $aid . ' '. $lang_admin['KERNEL']['ERROR_LOG_BUT_FAILED'], $lang_admin['KERNEL']['ERROR_LOG_SECURITY_BREACH']);
        }
    }
    unset($admin1);
}

need_delete('install.php');
need_delete('upgrade.php');
need_delete('install', true);

if($admintest) {
    if(!$admin) exit('Illegal Admintest');
    switch($op) {
        case 'GraphicAdmin':
        case 'adminMain':
            include_once(NUKE_ADMIN_MODULE_DIR.'index.php');
            break;
        case 'logout':
            evo_setcookie('admin', 'delete', -1);
            unset($admin);
            header("Refresh: 3; url=".$admin_file.".php");
            DisplayError("<span class=\"title\"><strong>".$lang_admin['KERNEL']['YOUARELOGGEDOUT']."</strong></span>", 1);
            break;
        case 'login':
            unset($op);
            login();
            break;
        default:
            define('ADMIN_POS', true);
            define('ADMIN_PROTECTION', true);
            if (isset($module) && !empty($module)) {
                include(NUKE_ADMIN_DIR.'/case/case.'.$module.'.php');
            } else {
                $allowed_modules = array();
                $result = $db->sql_query("SELECT title FROM "._MODULES_TABLE." ORDER BY title ASC");
                while (list($mod_title) = $db->sql_fetchrow($result)) {
                    if (is_mod_admin($mod_title) || is_mod_admin('super')) {
                        $allowed_modules[$mod_title] = TRUE;
                    }
                }
                $db->sql_freeresult($result);
                // We only load those case-files where the admin has the allowance for
                if (is_array($allowed_modules) && !empty($allowed_modules)) {
                    $casedir = @opendir(NUKE_ADMIN_DIR.'case');
                    while(false !== ($func = @readdir($casedir))) {
                        $case_file = substr($func, 0, 5);
                        if( ($case_file == 'case.') && in_array($case_file, $allowed_modules) ) {
                            include(NUKE_ADMIN_DIR.'case/'.$func);
                        }
                    }
                    closedir($casedir);
                    while (list($mod_runtitle) = each($allowed_modules)) {
                        if (is_mod_admin($mod_runtitle) && @file_exists(NUKE_MODULES_DIR.$mod_runtitle.'/admin/index.php') AND @file_exists(NUKE_MODULES_DIR.$mod_runtitle.'/admin/links.php') AND @file_exists(NUKE_MODULES_DIR.$mod_runtitle.'/admin/case.php')) {
                           include(NUKE_MODULES_DIR.$mod_runtitle.'/admin/case.php');
                        }
                    }
                } else {
                    DisplayError("<strong>".$lang_admin['KERNEL']['ERROR']."</strong><br /><br />You do not have ANY administration permission for ANY module");
                }
            }
            // Ok, if we are here, $op wasn't found in case-switches of the allowed modules or the Admin has no allowance to administrate this module
            include_once(NUKE_BASE_DIR . 'header.php');
            OpenTable();
            echo "<center>The file you have called is either not within the modules you are allowed to administrate<br />or the action you had selected: ".$op." isn't available";
            echo "<br /><br />";
            echo _GOBACK."   [ <a href='".$admin_file.".php?op=adminMain'>".$lang_admin['KERNEL']['TITLE_ADMINISTRATION']."</a> ]</center>";
            echo "<br /><br />";
            CloseTable();
            unset($allowed_modules);
            unset($op);
            include_once(NUKE_BASE_DIR . 'footer.php');
            break;
    }
} else {
    switch($op) {
        default:
            if (!stristr($_SERVER['HTTP_USER_AGENT'], 'WebTV')) {
                header('HTTP/1.0 403 Forbidden');
            }
            login();
        break;
    }
}
?>