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

global $_GETVAR;
define('IN_PHPBB', true);

$popup = $_GETVAR->get('popup', '_REQUEST', 'int');

if ($popup != '1'){
    $module_name = basename(dirname(__FILE__));
    require(NUKE_FORUMS_DIR.'nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

define('IN_PROFILE', TRUE);
include($phpbb_root_path . 'common.php');
$userdata = session_pagestart($user_ip, PAGE_PROFILE);
init_userprefs($userdata);

// -----------------------
// Page specific functions
//
function gen_rand_string($hash) {
    $rand_str = dss_rand();
    return ( $hash ) ? md5($rand_str) : substr($rand_str, 0, 8);
}
//
// End page specific functions
// ---------------------------

//
// Start of program proper
//

$mode       = $_GETVAR->get('mode', '_REQUEST');
$check_num  = $_GETVAR->get('check_num', '_REQUEST');
$submit     = $_GETVAR->get('submit', '_POST');
$agreed     = $_GETVAR->get('agreed', '_REQUEST');
$title_name = 'Profile';
$logo_name  = 'profile-logo.png';

if ( !is_user() ) {
    if ( $mode != 'viewprofile' && $mode != 'register' ) {
        redirect('modules.php?name=Your_Account&amp;op=new_user');
        exit;
    }
} else {
    if ( !$mode ) {
        $mode = 'editprofile';
    }
}

switch ($mode) {
    case 'activate':
        if ( is_admin() || is_user() ) {
            include(NUKE_INCLUDE_DIR.'usercp_activate.php');
        }
        exit;
        break;
    case 'confirm':
        exit;
        break;
    case 'editprofile':
        $page_title = $lang['Edit_profile'];
        include_once(NUKE_INCLUDE_DIR.'page_header.php');
        if ( is_admin() || is_user() ) {
            echo '<script type="text/javascript" src="includes/profile_add_body.js"></script>';
            include(NUKE_INCLUDE_DIR.'usercp_register.php');
        }
        include_once(NUKE_INCLUDE_DIR.'page_tail.php');
        exit;
        break;
    case 'email':
        if ( is_admin() || is_user() ) {
            include(NUKE_INCLUDE_DIR.'usercp_email.php');
        }
        exit;
        break;
    case 'register':
        if ( $check_num || !empty($submit) ) {
            $page_title = $lang['Register'];
            include_once(NUKE_INCLUDE_DIR.'page_header.php');
            echo '<script type="text/javascript" src="includes/profile_add_body.js"></script>';
            include(NUKE_INCLUDE_DIR.'usercp_register.php');
            include_once(NUKE_INCLUDE_DIR.'page_tail.php');
            exit;
        } else if ( !$check_num ) {
            redirect('modules.php?name=Your_Account&amp;op=new_user');
            exit;
        }
        break;
    case 'sendpassword':
        if ( is_admin() || is_user() ) {
            include(NUKE_INCLUDE_DIR.'usercp_sendpasswd.php');
            exit;
        }
        break;
    case 'signature':
        if ( is_admin() || is_user() ) {
            include_once(NUKE_INCLUDE_DIR.'page_header.php');
            include(NUKE_INCLUDE_DIR.'usercp_signature.php');
            exit;
        }
        break;
    case 'viewprofile':
        include(NUKE_INCLUDE_DIR.'usercp_viewprofile.php');
        exit;
        break;
    default:
        break;
}

redirect('modules.php?name=Your_Account&amp;redirect=Profile&amp;mode='.$mode);

?>