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

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
define('CNBYA', TRUE);

get_lang($module_name);
$userpage = 1;
global $_GETVAR, $userinfo, $evoconfig;

include_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

$pagetitle = _AWU;

$op             = $_GETVAR->get('op', '_REQUEST', 'string', '');
$username       = $_GETVAR->get('username', '_REQUEST', 'string', '');
$redirect       = $_GETVAR->get('redirect', '_REQUEST', 'string', '');
$module         = $_GETVAR->get('module', '_REQUEST', 'string', '');
$user_password  = $_GETVAR->get('user_password', '_REQUEST', 'string', '');
$mode           = $_GETVAR->get('mode', '_REQUEST', 'string', '');
$t              = $_GETVAR->get('t', '_REQUEST', 'string', '');
$p              = $_GETVAR->get('p', '_REQUEST', 'string', '');
$f              = $_GETVAR->get('f', '_REQUEST', 'string', '');
$user           = $_GETVAR->get('user', '_REQUEST', 'string', '');
$coppa_yes      = $_GETVAR->get('coppa_yes', '_REQUEST', 'int', 0);
$tos_yes        = $_GETVAR->get('tos_yes', '_REQUEST', 'int', 0);
$stop           = $_GETVAR->get('stop', '_REQUEST', 'string', '');
$submit         = $_GETVAR->get('submit', '_REQUEST', 'string', '');
$modgfx_check   = $_GETVAR->get($module_name.'gfx_check', '_REQUEST', 'string', '');
$gfx_check      = $_GETVAR->get('gfx_check', '_REQUEST', 'string', '');
$cookieresult   = $_GETVAR->get('cookieresult', '_GET', 'int', 0);
$forward        = $_GETVAR->get('forward', '_REQUEST', 'string', '');


include(NUKE_MODULES_DIR.$module_name.'/includes/cookiecheck.php');
if ( $evoconfig['cookiecheck'] ) {
    yacookiecheckresults($op, $cookieresult);
}

if (is_user()) {
    include(NUKE_MODULES_DIR.$module_name.'/public/navbar.php');
}

switch($op) {
    case 'activate':
        include(NUKE_MODULES_DIR.$module_name.'/public/activate.php');
        break;
    case 'delete':
        if ($evoconfig['allowuserdelete'] == 1) {
            include(NUKE_MODULES_DIR.$module_name.'/public/delete.php');
        } else {
            disabled();
        }
        break;
    case 'deleteconfirm':
        if ($evoconfig['allowuserdelete'] == 1) {
            include(NUKE_MODULES_DIR.$module_name.'/public/deleteconfirm.php');
        } else {
            disabled();
        }
        break;
    case 'edithome':
        include(NUKE_MODULES_DIR.$module_name.'/public/edithome.php');
        break;
    case 'changemail':
        include(NUKE_MODULES_DIR.$module_name.'/public/changemail.php');
        changemail();
        break;
    case 'edituser':
        redirect('modules.php?name=Profile&amp;mode=editprofile');
        exit;
        break;
    case 'login':
        if(!compare_ips($username)) {
            DisplayError('Your IP is not valid for this user');
            exit;
        }
        $pm_login = '';
        $setinfo  = get_user_field('*', $username, TRUE);
        if (preg_match('#privmsg#', $forward)) { $pm_login = 'active'; }
        if (!isset($setinfo['username']) || empty($setinfo['username'])) {
            include_once(NUKE_BASE_DIR.'header.php');
            Show_CNBYA_menu();
            OpenTable();
            echo "<center><span class='title'>"._SORRYNOUSERINFO."</span></center>\n";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        } elseif ((isset($setinfo['username']) && !empty($setinfo['username'])) AND $setinfo['user_id'] != ANONYMOUS AND !empty($setinfo['user_password']) AND $setinfo['user_active'] >0 AND $setinfo['user_level'] >0) {
            $setinfo['agreedtos'] = (isset($setinfo['agreedtos']) ? $setinfo['agreedtos'] : FALSE);
            if (($evoconfig['tos']) AND ($tos_yes)) {
                $db->sql_uquery("UPDATE "._USERS_TABLE." SET agreedtos='1' WHERE username='$username'");
                $setinfo['agreedtos'] = TRUE;
            }
            if ($evoconfig['tos'] AND $evoconfig['tosall'] AND !$setinfo['agreedtos']) {
                include(NUKE_MODULES_DIR.$module_name.'/public/ya_tos.php');
            }
            $forward        = str_replace('redirect=', '', $redirect);
            $dbpass         = $setinfo['user_password'];
            $non_crypt_pass = $user_password;
            $old_crypt_pass = crypt($user_password,substr($dbpass,0,2));
            $new_pass = EvoCrypt($user_password);
            $evo_crypt = EvoCrypt1($user_password);
            //Reset to md5x1
            if (($dbpass == $evo_crypt) || (($dbpass == $non_crypt_pass) || ($dbpass == $old_crypt_pass))) {
                $db->sql_uquery("UPDATE "._USERS_TABLE." SET user_password='$new_pass' WHERE username='$username'");
                list($dbpass) = $db->sql_ufetchrow("SELECT user_password FROM "._USERS_TABLE." WHERE username='$username'");
            }
            if ($dbpass != $new_pass) {
                //Does it need another md5?
                if (md5($dbpass) == $new_pass) {
                    $db->sql_uquery("UPDATE "._USERS_TABLE." SET user_password='$new_pass' WHERE username='$username'");
                    list($dbpass) = $db->sql_ufetchrow("SELECT user_password FROM "._USERS_TABLE." WHERE username='$username'");
                    if ($dbpass != $new_pass) {
                        redirect("modules.php?name=$module_name&amp;stop=1");
                        return;
                    }
                } else {
                    redirect("modules.php?name=$module_name&amp;stop=1");
                    return;
                }
            }
            $gfxchk = array(2,4,5,7);
            if (!empty($modgfx_check)) {
                $check_module = $module_name;
                $check_code   = $modgfx_check;
            } else {
                $check_module = '';
                $check_code   = $gfx_check;
            }
            if (!security_code_check($check_code, $gfxchk, $check_module)) {
                redirect("modules.php?name=$module_name&amp;stop=1");
                exit;
            } else {
                evo_setusercookie($setinfo['user_id'], 'userid');
            }
            if (!empty($pm_login)) {
                redirect('modules.php?name=Private_Messages&amp;file=index&amp;folder=inbox');
            } else if (!empty($t))  {
                redirect("modules.php?name=Forums&amp;file=$forward&amp;mode=$mode&amp;t=$t");
            } else if (!empty($p))  {
                redirect("modules.php?name=Forums&amp;file=$forward&amp;mode=$mode&amp;p=$p");
            } else if (!empty($module)) {
                redirect("modules.php?name=$module");
            } else if (empty($redirect)) {
                if ($evoconfig['loginpage'] == 1) {
                  redirect("modules.php?name=Your_Account&amp;op=userinfo&amp;bypass=1&amp;username=$username");
                } elseif ($evoconfig['loginpage'] == 0) {
                  redirect('modules.php?name=Forums');
                } else {
                  redirect('index.php');
                }
            } else if (empty($mode)) {
                if(!empty($f)) {
                    redirect("modules.php?name=Forums&amp;file=$forward&amp;f=$f");
                } else {
                    redirect("modules.php?name=Forums&amp;file=$forward");
                }
            } else {
                    redirect("modules.php?name=Forums&amp;file=$forward&amp;mode=$mode&amp;f=$f");
            }
        } elseif ($db->sql_numrows($result) == 1 AND ($setinfo['user_level'] < 1 OR $setinfo['user_active'] < 1)) {
            $db->sql_freeresult($result);
            include_once(NUKE_BASE_DIR.'header.php');
            Show_CNBYA_menu();
            OpenTable();
            if ($setinfo['user_level'] == 0) {
                echo "<br /><center><span class=\"title\"><strong>"._ACCSUSPENDED."</strong></span></center><br />\n";
            } elseif ($setinfo['user_level'] == -1) {
                echo "<br /><center><span class=\"title\"><strong>"._ACCDELETED."</strong></span></center><br />\n";
            } else {
                echo "<br /><center><span class=\"title\"><strong>"._SORRYNOUSERINFO."</strong></span></center><br />\n";
            }
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        } else {
            redirect("modules.php?name=$module_name&amp;stop=1");
        }
        break;
    case 'logout':
        $r_uid      = $userinfo['user_id'];
        $r_username = $userinfo['username'];
        evo_setcookie('user', 'delete', -1);
        $db->sql_uquery("DELETE FROM "._SESSION_TABLE." WHERE uname='$r_username'");
        $db->sql_uquery("UPDATE "._USERS_TABLE." SET user_lastvisit='".time()."' WHERE user_id='".$r_uid."'");
        $evo_cookie_name = $evoconfig['cookie_name'];
        evo_setcookie($evo_cookie_name . '_data', 'delete', -1);
        evo_setcookie($evo_cookie_name . '_sid', 'delete', -1);
        $user = '';
        @session_unset();
        if (!empty($redirect)) {
            redirect("modules.php?name=$redirect");
            exit;
        } else {
            redirect('index.php');
            exit;
        }
        break;
    case 'mailpasswd':
        include(NUKE_MODULES_DIR.$module_name.'/public/mailpass.php');
        break;
    case 'new_user':
        if (is_user()) {
            mmain($user);
        } else {
            if ($evoconfig['allowuserreg']) {
                if ($evoconfig['coppa']) {
                    if(!$coppa_yes) {
                        include(NUKE_MODULES_DIR.$module_name.'/public/ya_coppa.php');
                        exit;
                    }
                }
                if ($evoconfig['tos']) {
                    if(!$tos_yes ) {
                        include(NUKE_MODULES_DIR.$module_name.'/public/ya_tos.php');
                        exit;
                    }
                }
                if (!$evoconfig['coppa'] OR ($evoconfig['coppa'] AND $coppa_yes )){
                    if (!$evoconfig['tos'] OR ($evoconfig['tos'] AND $tos_yes)){
                        if ($evoconfig['requireadmin']) {
                            include(NUKE_MODULES_DIR.$module_name.'/public/new_user1.php');
                        } elseif (!$evoconfig['requireadmin'] AND $evoconfig['useactivate']) {
                            include(NUKE_MODULES_DIR.$module_name.'/public/new_user2.php');
                        } elseif (!$evoconfig['requireadmin'] AND !$evoconfig['useactivate'] ) {
                            include(NUKE_MODULES_DIR.$module_name.'/public/new_user3.php');
                        }
                    }
                    redirect("modules.php?name=$module_name&amp;op=new_user&amp;tos_yes=0");;
                }
                redirect("modules.php?name=$module_name&amp;op=new_user&amp;coppy_yes=0");;
            }else {
                disabled();
            }
        }
        break;
    case 'new_confirm':
        if (is_user()) {
            mmain($user);
        } else {
            if ($evoconfig['allowuserreg']) {
                if ($evoconfig['requireadmin']) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_confirm1.php');
                } elseif (!$evoconfig['requireadmin'] AND $evoconfig['useactivate']) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_confirm2.php');
                } elseif (!$evoconfig['requireadmin'] AND !$evoconfig['useactivate']) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_confirm3.php');
                }
            } else {
                disabled();
            }
        }
        break;
    case 'new_finish':
        if (is_user()) {
            mmain($user);
        } else {
            if ($evoconfig['allowuserreg']) {
                if ($evoconfig['requireadmin']) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_finish1.php');
                } elseif (!$evoconfig['requireadmin'] AND $evoconfig['useactivate']) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_finish2.php');
                } elseif (!$evoconfig['requireadmin'] AND !$evoconfig['useactivate']) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_finish3.php');
                }
            } else {
                disabled();
            }
        }
        break;
    case 'pass_lost':
        include(NUKE_MODULES_DIR.$module_name.'/public/passlost.php');
        break;
    case 'saveactivate':
        include(NUKE_MODULES_DIR.$module_name.'/public/saveactivate.php');
        break;
    case 'savehome':
        if (is_user()) {
            include(NUKE_MODULES_DIR.$module_name.'/public/savehome.php');
        } else {
            notuser();
        }
        break;
    case 'userinfo':
        list($uid) = $db->sql_ufetchrow('SELECT user_id FROM '._USERS_TABLE.' WHERE username="'.$username.'"', SQL_NUM);
        redirect('modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$uid);
        exit;
        break;
    case 'ShowCookiesRedirect':
        ShowCookiesRedirect();
        break;
    case 'ShowCookies':
        ShowCookies();
        break;
    case 'DeleteCookies':
        DeleteCookies();
        break;
    default:
        mmain($user);
        break;
}

?>