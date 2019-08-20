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

if (!defined('ADMIN_FILE') && !defined('FORUM_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (defined('PHPBB_BOARD_CONFIG')) {
    if( !empty($setmodules) ) {
        $filename = basename(__FILE__);
        $module['Users']['Manage'] = $filename;
        return;
    }
}

global $_GETVAR;

//
// Set mode
//
$mode           = $_GETVAR->get('mode', '_REQUEST');
$admin_userid   = $_GETVAR->get(POST_USERS_URL, '_REQUEST');
$username       = $_GETVAR->get('username', '_POST');

if ( (empty($admin_userid) && empty($username)) && !empty($mode) ) {
    message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
} else {
    if ( (!empty($admin_userid) && !is_int($admin_userid)) || !empty($username) ) {
        if (!empty($username)) {
            $admin_userid = get_user_field('user_id', $username, TRUE);
        }
    } else {
        $mode = '';
    }
}
//
// Begin program
//
if ($mode == 'deleteuser' ) {
    redirect('modules.php?name=Your_Account&amp;file=admin&amp;op=deleteUser&amp;chng_uid='.$admin_userid);
    exit;
}

if ( $mode == 'edit' || $mode=='editprofile' ) {
    define('IN_ADMIN_USERS', TRUE);
    echo '<script type="text/javascript" src="includes/profile_add_body.js"></script>';
    include(NUKE_INCLUDE_DIR . 'usercp_register.php');
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
} else if ( $mode == 'signature' ) {
    define('IN_ADMIN_USERS', TRUE);
    include(NUKE_INCLUDE_DIR.'usercp_signature.php');
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
} else if ( $mode == 'sendpassword' ) {
    define('IN_ADMIN_USERS', TRUE);
    include(NUKE_INCLUDE_DIR.'usercp_sendpasswd.php');
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
} else {
    //
    // Default user selection box
    //
    $template->set_filenames(array(
            'body' => 'admin/user_select_body.tpl')
    );
    $template->assign_vars(array(
        'L_USER_TITLE'      => $lang['User_admin'],
        'L_USER_EXPLAIN'    => $lang['User_admin_explain'],
        'L_USER_SELECT'     => $lang['Select_a_User'],
        'L_LOOK_UP'         => $lang['Look_up_user'],
        'L_FIND_USERNAME'   => $lang['Find_username'],
        'U_SEARCH_USER'     => append_sid('search.php?mode=searchuser&amp;popup=1&amp;menu=1'),
        'S_USER_ACTION'     => admin_sid('admin_users.php'),
        )
    );
    $template->pparse('body');
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
}

?>