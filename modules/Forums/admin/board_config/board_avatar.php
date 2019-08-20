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

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    'avatar' => 'admin/board_config/board_avatar.tpl')
);

$avatars_local_yes      = ( $new['allow_avatar_local'] ) ? 'checked="checked"' : '';
$avatars_local_no       = ( !$new['allow_avatar_local'] ) ? 'checked="checked"' : '';
$avatars_remote_yes     = ( $new['allow_avatar_remote'] ) ? 'checked="checked"' : '';
$avatars_remote_no      = ( !$new['allow_avatar_remote'] ) ? 'checked="checked"' : '';
$avatars_upload_yes     = ( $new['allow_avatar_upload'] ) ? 'checked="checked"' : '';
$avatars_upload_no      = ( !$new['allow_avatar_upload'] ) ? 'checked="checked"' : '';
$default_avatar_guests  = ($new['default_avatar_set'] == '0') ? 'checked="checked"' : '';
$default_avatar_users   = ($new['default_avatar_set'] == '1') ? 'checked="checked"' : '';
$default_avatar_both    = ($new['default_avatar_set'] == '2') ? 'checked="checked"' : '';
$default_avatar_none    = ($new['default_avatar_set'] == '3') ? 'checked="checked"' : '';

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_AVATAR_SETTINGS'             => $lang['Avatar_settings'],
    'L_DEFAULT_AVATAR'              => $lang['Default_avatar'],
    'L_DEFAULT_AVATAR_EXPLAIN'      => $lang['Default_avatar_explain'],
    'L_DEFAULT_AVATAR_GUESTS'       => $lang['Default_avatar_guests'],
    'L_DEFAULT_AVATAR_USERS'        => $lang['Default_avatar_users'],
    'L_DEFAULT_AVATAR_BOTH'         => $lang['Default_avatar_both'],
    'L_DEFAULT_AVATAR_NONE'         => $lang['Default_avatar_none'],
    'L_ALLOW_LOCAL'                 => $lang['Allow_local'],
    'L_ALLOW_REMOTE'                => $lang['Allow_remote'],
    'L_ALLOW_REMOTE_EXPLAIN'        => $lang['Allow_remote_explain'],
    'L_ALLOW_UPLOAD'                => $lang['Allow_upload'],
    'L_MAX_FILESIZE'                => $lang['Max_filesize'],
    'L_MAX_FILESIZE_EXPLAIN'        => $lang['Max_filesize_explain'],
    'L_MAX_AVATAR_SIZE'             => $lang['Max_avatar_size'],
    'L_MAX_AVATAR_SIZE_EXPLAIN'     => $lang['Max_avatar_size_explain'],
    'L_AVATAR_STORAGE_PATH'         => $lang['Avatar_storage_path'],
    'L_AVATAR_STORAGE_PATH_EXPLAIN' => $lang['Avatar_storage_path_explain'],
    'L_AVATAR_GALLERY_PATH'         => $lang['Avatar_gallery_path'],
    'L_AVATAR_GALLERY_PATH_EXPLAIN' => $lang['Avatar_gallery_path_explain'],
));

//Data Template Variables
$template->assign_vars(array(
    'AVATARS_LOCAL_YES'     => $avatars_local_yes,
    'AVATARS_LOCAL_NO'      => $avatars_local_no,
    'AVATARS_REMOTE_YES'    => $avatars_remote_yes,
    'AVATARS_REMOTE_NO'     => $avatars_remote_no,
    'AVATARS_UPLOAD_YES'    => $avatars_upload_yes,
    'AVATARS_UPLOAD_NO'     => $avatars_upload_no,
    'AVATAR_FILESIZE'       => $new['avatar_filesize'],
    'AVATAR_MAX_HEIGHT'     => $new['avatar_max_height'],
    'AVATAR_MAX_WIDTH'      => $new['avatar_max_width'],
    'AVATAR_PATH'           => $new['avatar_path'],
    'AVATAR_GALLERY_PATH'   => $new['avatar_gallery_path'],
    'DEFAULT_AVATAR_GUESTS_URL' => $new['default_avatar_guests_url'],
    'DEFAULT_AVATAR_USERS_URL'  => $new['default_avatar_users_url'],
    'DEFAULT_AVATAR_GUESTS' => $default_avatar_guests,
    'DEFAULT_AVATAR_USERS'  => $default_avatar_users,
    'DEFAULT_AVATAR_BOTH'   => $default_avatar_both,
    'DEFAULT_AVATAR_NONE'   => $default_avatar_none,
 ));
$template->pparse('avatar');

?>