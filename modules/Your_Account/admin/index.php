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

if (!defined('ADMIN_FILE')) {
    die('You can\'t access this file directly...');
}

$module_name = basename(dirname(dirname(__FILE__)));
define('YA_ADMIN', TRUE);

global $_GETVAR, $admin_file, $module_name;
get_lang($module_name);

/*=====
  For more information on how to use this please see the help file in the help/features folder
  =====*/
include(NUKE_BASE_DIR.'ips.php');

if(isset($ips) && is_array($ips)) {
    $ip_check = implode('|^',$ips);
    if (!preg_match("/^".$ip_check."/",identify::get_ip())) {
        unset($aid);
        unset($admin);
        $name = $userinfo['username'];
        log_write('admin', $name.'&nbsp;'._ERROR_LOG_INVALID_IP_YA, _ERROR_LOG_SECURITY_BREACH);
        die('Invalid IP<br />Access denied');
    }
    define('ADMIN_IP_LOCK',true);
}

include_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

if (is_mod_admin($module_name)) {
    $op   = $_GETVAR->get('op', '_REQUEST', 'string');
    $xop  = $_GETVAR->get('xop', '_POST', 'string');
    $file = $_GETVAR->get('file', '_REQUEST', 'string');

    $file = (!$file ? $op : $file);
    switch ($file) {
        case 'addUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/adduser.php');
            break;
        case 'addUserConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/adduserconf.php');
            break;
        case 'approveUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/approveuser.php');
            break;
        case 'approveUserConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/approveuserconf.php');
            break;
        case 'activateUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/activateuser.php');
            break;
        case 'activateUserConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/activateuserconf.php');
            break;
        case 'autoSuspend':
            include(NUKE_MODULES_DIR.$module_name.'/admin/autosuspend.php');
            break;
        case 'credits':
            include(NUKE_MODULES_DIR.$module_name.'/admin/credits.php');
            break;
        case 'deleteUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/deleteuser.php');
            break;
        case 'deleteUserConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/deleteuserconf.php');
            break;
        case 'denyUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/denyuser.php');
            break;
        case 'denyUserConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/denyuserconf.php');
            break;
        case 'detailsTemp':
            include(NUKE_MODULES_DIR.$module_name.'/admin/detailstemp.php');
            break;
        case 'detailsUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/detailsuser.php');
            break;
        case 'findTemp':
            include(NUKE_MODULES_DIR.$module_name.'/admin/findtemp.php');
            break;
        case 'findUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/finduser.php');
            break;
        case 'listnormal':
            include(NUKE_MODULES_DIR.$module_name.'/admin/listnormal.php');
            break;
        case 'listpending':
            include(NUKE_MODULES_DIR.$module_name.'/admin/listpending.php');
            break;
        case 'listresults':
            include(NUKE_MODULES_DIR.$module_name.'/admin/listresults.php');
            break;
        case 'modifyTemp':
            include(NUKE_MODULES_DIR.$module_name.'/admin/modifytemp.php');
            break;
        case 'modifyTempConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/modifytempconf.php');
            break;
        case 'modifyUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/modifyuser.php');
            break;
        case 'modifyUserConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/modifyuserconf.php');
            break;
        case 'removeUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/removeuser.php');
            break;
        case 'removeUserConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/removeuserconf.php');
            break;
        case 'resendMail':
            include(NUKE_MODULES_DIR.$module_name.'/admin/resendmail.php');
            break;
        case 'resendMailConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/resendmailconf.php');
            break;
        case 'restoreUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/restoreuser.php');
            break;
        case 'restoreUserConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/restoreuserconf.php');
            break;
        case 'searchUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/searchuser.php');
            break;
        case 'suspendUser':
            include(NUKE_MODULES_DIR.$module_name.'/admin/suspenduser.php');
            break;
        case 'suspendUserConf':
            include(NUKE_MODULES_DIR.$module_name.'/admin/suspenduserconf.php');
            break;
        case 'addField':
            include(NUKE_MODULES_DIR.$module_name.'/admin/addfield.php');
            break;
        case 'Your_Account':
            $pagetitle = ': '._USERADMIN;
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align=\"center\">\n<a href='".$admin_file.".php?op=Your_Account'>" . _USER_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
            echo "<div align=\"center\">\n[ <a href='".$admin_file.".php'>" . _USER_RETURNMAIN . "</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            title(_USERADMIN);
            amain();
            include_once(NUKE_BASE_DIR.'footer.php');
        break;
    }
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>