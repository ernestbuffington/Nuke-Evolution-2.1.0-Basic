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
    'user_and_forum' => 'admin/board_config/board_user_and_forum.tpl')
);

$html_tags              = $new['allow_html_tags'];
$html_yes               = ( $new['allow_html'] ) ? 'checked="checked"' : '';
$html_no                = ( !$new['allow_html'] ) ? 'checked="checked"' : '';
$bbcode_yes             = ( $new['allow_bbcode'] ) ? 'checked="checked"' : '';
$bbcode_no              = ( !$new['allow_bbcode'] ) ? 'checked="checked"' : '';
$smile_yes              = ( $new['allow_smilies'] ) ? 'checked="checked"' : '';
$smile_no               = ( !$new['allow_smilies'] ) ? 'checked="checked"' : '';
$allow_autologin_yes    = ($new['allow_autologin']) ? 'checked="checked"' : '';
$allow_autologin_no     = (!$new['allow_autologin']) ? 'checked="checked"' : '';
$loginindexpage_yes     = ($new['loginpage'] == 1) ? 'checked="checked"' : '';
$loginindexpage_no      = ($new['loginpage'] == 0) ? 'checked="checked"' : '';
$loginindexpage_other   = ($new['loginpage'] == 2) ? 'checked="checked"' : '';
$smilies_in_titles_yes  = ( $new['smilies_in_titles'] ) ? 'checked="checked"' : '';
$smilies_in_titles_no   = ( !$new['smilies_in_titles'] ) ? 'checked="checked"' : '';
$show_images_yes        = ( $new['hide_images'] ) ? 'checked = "checked"' : '';
$show_images_no         = ( !$new['hide_images'] ) ? 'checked = "checked"' : '';
$show_links_yes         = ( $new['hide_links'] ) ? 'checked = "checked"' : '';
$show_links_no          = ( !$new['hide_links'] ) ? 'checked = "checked"' : '';
$show_emails_yes        = ( $new['hide_emails'] ) ? 'checked = "checked"' : '';
$show_emails_no         = ( !$new['hide_emails'] ) ? 'checked = "checked"' : '';
$allow_view_select      = allow_view_select($new['logs_view_level']);
$show_edited_logs_yes   = ($new['show_edited_logs']) ? 'checked="checked"' : '';
$show_edited_logs_no    = (!$new['show_edited_logs']) ? 'checked="checked"' : '';
$show_locked_logs_yes   = ($new['show_locked_logs']) ? 'checked="checked"' : '';
$show_locked_logs_no    = (!$new['show_locked_logs']) ? 'checked="checked"' : '';
$show_unlocked_logs_yes = ($new['show_unlocked_logs']) ? 'checked="checked"' : '';
$show_unlocked_logs_no  = (!$new['show_unlocked_logs']) ? 'checked="checked"' : '';
$show_splitted_logs_yes = ($new['show_splitted_logs']) ? 'checked="checked"' : '';
$show_splitted_logs_no  = (!$new['show_splitted_logs']) ? 'checked="checked"' : '';
$show_moved_logs_yes    = ($new['show_moved_logs']) ? 'checked="checked"' : '';
$show_moved_logs_no     = (!$new['show_moved_logs']) ? 'checked="checked"' : '';

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_ABILITIES_SETTINGS'      => $lang['Abilities_settings'],
    'L_MAX_POLL_OPTIONS'        => $lang['Max_poll_options'],
    'L_ALLOW_HTML'              => $lang['Allow_HTML'],
    'L_ALLOW_BBCODE'            => $lang['Allow_BBCode'],
    'L_ALLOWED_TAGS'            => $lang['Allowed_tags'],
    'L_ALLOWED_TAGS_EXPLAIN'    => $lang['Allowed_tags_explain'],
    'L_ALLOW_SMILIES'           => $lang['Allow_smilies'],
    'L_ALLOW_AUTOLOGIN'         => $lang['Allow_autologin'],
    'L_ALLOW_AUTOLOGIN_EXPLAIN' => $lang['Allow_autologin_explain'],
    'L_AUTOLOGIN_TIME'          => $lang['Autologin_time'],
    'L_AUTOLOGIN_TIME_EXPLAIN'  => $lang['Autologin_time_explain'],
    'L_LOGIN_PAGE'              => $lang['Login_page'],
    'L_LOGIN_PAGE_EXPLAIN'      => $lang['Login_page_explain'],
    'L_LOGIN_INDEX'             => $lang['Login_page_index'],
    'L_SMILIES_IN_TITLES'       => $lang['smilies_in_titles'],
    'L_HIDE_IMAGES'             => $lang['hide_images'],
    'L_HIDE_LINKS'              => $lang['hide_links'],
    'L_HIDE_EMAILS'             => $lang['hide_emails'],
    'L_SHOW_EDITED_LOGS'        => $lang['show_edited_logs'],
    'L_SHOW_LOCKED_LOGS'        => $lang['show_locked_logs'],
    'L_SHOW_UNLOCKED_LOGS'      => $lang['show_unlocked_logs'],
    'L_SHOW_SPLITTED_LOGS'      => $lang['show_splitted_logs'],
    'L_SHOW_MOVED_LOGS'         => $lang['show_moved_logs'],
    'L_ALLOW_VIEW'              => $lang['allow_logs_view'],
    'L_SMILIES_PATH'            => $lang['Smilies_path'],
    'L_SMILIES_PATH_EXPLAIN'    => $lang['Smilies_path_explain'],
    'L_IMAGE_RESIZE_WIDTH'      => $lang['image_resize_width'],
    'L_IMAGE_RESIZE_HEIGHT'     => $lang['image_resize_height'],
));

//Data Template Variables
$template->assign_vars(array(
    'MAX_POLL_OPTIONS'          => $new['max_poll_options'],
    'HTML_TAGS'                 => $html_tags,
    'HTML_YES'                  => $html_yes,
    'HTML_NO'                   => $html_no,
    'BBCODE_YES'                => $bbcode_yes,
    'BBCODE_NO'                 => $bbcode_no,
    'SMILE_YES'                 => $smile_yes,
    'SMILE_NO'                  => $smile_no,
    'ALLOW_AUTOLOGIN_YES'       => $allow_autologin_yes,
    'ALLOW_AUTOLOGIN_NO'        => $allow_autologin_no,
    'LOGINPAGE_YES'             => $loginindexpage_yes,
    'LOGINPAGE_NO'              => $loginindexpage_no,
    'LOGINPAGE_OTHER'           => $loginindexpage_other,
    'AUTOLOGIN_TIME'            => (int) $new['max_autologin_time'],
    'SMILES_IN_TITLES_YES'      => $smilies_in_titles_yes,
    'SMILES_IN_TITLES_NO'       => $smilies_in_titles_no,
    'HIDE_IMAGES_YES'           => $show_images_yes,
    'HIDE_IMAGES_NO'            => $show_images_no,
    'HIDE_LINKS_YES'            => $show_links_yes,
    'HIDE_LINKS_NO'             => $show_links_no,
    'HIDE_EMAILS_YES'           =>$show_emails_yes,
    'HIDE_EMAILS_NO'            => $show_emails_no,
    'SHOW_EDITED_LOGS_YES'      => $show_edited_logs_yes,
    'SHOW_EDITED_LOGS_NO'       => $show_edited_logs_no,
    'SHOW_LOCKED_LOGS_YES'      => $show_locked_logs_yes,
    'SHOW_LOCKED_LOGS_NO'       => $show_locked_logs_no,
    'SHOW_UNLOCKED_LOGS_YES'    => $show_unlocked_logs_yes,
    'SHOW_UNLOCKED_LOGS_NO'     => $show_unlocked_logs_no,
    'SHOW_SPLITTED_LOGS_YES'    => $show_splitted_logs_yes,
    'SHOW_SPLITTED_LOGS_NO'     => $show_splitted_logs_no,
    'SHOW_MOVED_LOGS_YES'       => $show_moved_logs_yes,
    'SHOW_MOVED_LOGS_NO'        => $show_moved_logs_no,
    'ALLOW_VIEW_SELECT'         => $allow_view_select,
    'SMILIES_PATH'              => $new['smilies_path'],
    'IMAGE_RESIZE_WIDTH'        => $new['image_resize_width'],
    'IMAGE_RESIZE_HEIGHT'       => $new['image_resize_height'],
 ));
$template->pparse('user_and_forum');

?>