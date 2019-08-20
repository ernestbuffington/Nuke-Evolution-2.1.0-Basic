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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

define('HEADER_INC', true);

global $name, $is_inline_review, $db, $cache, $ThemeSel;

//
// gzip_compression
//
$do_gzip_compress = FALSE;

$template->set_filenames(array(
    'header' => 'printer_header.tpl')
);

//
// The following assigns all _common_ variables that may be used at any point
// in a template. Note that all URL's should be wrapped in append_sid, as
// should all S_x_ACTIONS for forms.
//

$template->assign_vars(array(
    'SITENAME' => $board_config['sitename'],
    'SITE_DESCRIPTION' => $board_config['site_desc'],
    'PAGE_TITLE' => $page_title,
    'PATH_TO_STYLE' => NUKE_THEMES_MAIN_DIR . $ThemeSel .'/style/style.css',
    'CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], time(), $board_config['board_timezone'])),
    'L_Board_Currently_Disabled' => $lang['Board_Currently_Disabled'],
    'L_USERNAME' => $lang['Username'],
    'L_PASSWORD' => $lang['Password'],
    'L_LOGIN' => $lang['Login'],
    'L_LOG_ME_IN' => $lang['Log_me_in'],
    'L_AUTO_LOGIN' => $lang['Log_me_in'],
    'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
    'L_REGISTER' => $lang['Register'],
    'L_PROFILE' => $lang['Profile'],
    'L_SEARCH' => $lang['Search'],
    'L_PRIVATEMSGS' => $lang['Private_Messages'],
    'L_WHO_IS_ONLINE' => $lang['Who_is_Online'],
    'L_MEMBERLIST' => $lang['Memberlist'],
    'L_FAQ' => $lang['FAQ'],
    'L_STATISTICS' => $lang ['Statistics'],
    'L_USERGROUPS' => $lang['Usergroups'],
    'L_SEARCH_NEW' => $lang['Search_new'],
    'L_SEARCH_UNANSWERED' => $lang['Search_unanswered'],
    'L_SEARCH_SELF' => $lang['Search_your_posts'],
    'L_WHOSONLINE_ADMIN' => sprintf($lang['Admin_online_color'], '<span style="color:#' . $theme['fontcolor3'] . '">', '</span>'),
    'L_WHOSONLINE_MOD' => sprintf($lang['Mod_online_color'], '<span style="color:#' . $theme['fontcolor2'] . '">', '</span>'),
    'L_SELECT_MESSAGES_FROM' => $lang['printertopic_Select_messages_from'],
    'L_SELECT_THROUGH' => $lang['printertopic_through'],
    'L_BOX1_DESC' => $lang['printertopic_box1_desc'],
    'L_BOX2_DESC' => $lang['printertopic_box2_desc'],
    'L_SHOW' => $lang['printertopic_Show'],
    'L_PRINT' => $lang['printertopic_Print'],
    'L_PRINT_DESC' => $lang['printertopic_Print_desc'],
    'L_OUTPUT_GENERATED' => $lang['output_generated'],
    'L_RMW_IMAGE_TITLE' => $lang['rmw_image_title'],
    'U_RMW_JSLIB' => 'includes/rmw_jslib.js',
    'IMAGE_RESIZE_WIDTH' => $board_config['image_resize_width'],
    'IMAGE_RESIZE_HEIGHT' => $board_config['image_resize_height'],
    'U_RECENT' => append_sid('recent.php'),
    'L_RECENT' => $lang['Recent_topics'],
    'U_SEARCH_UNANSWERED' => append_sid('search.php?search_id=unanswered'),
    'U_SEARCH_SELF' => append_sid('search.php?search_id=egosearch'),
    'U_SEARCH_NEW' => append_sid('search.php?search_id=newposts'),
    'U_INDEX' => append_sid('index.php'),
    'U_REGISTER' => append_sid('profile.php?mode=register'),
    'U_PROFILE' => 'modules.php?name=Your_Account&amp;op=edituser',
    'U_PRIVATEMSGS' => append_sid('privmsg.php?folder=inbox'),
    'U_PRIVATEMSGS_POPUP' => append_sid('privmsg.php?mode=newpm&amp;popup=1'),
    'U_SEARCH' => append_sid('search.php'),
    'U_MEMBERLIST' => append_sid('memberlist.php'),
    'U_MODCP' => append_sid('modcp.php'),
    'U_FAQ' => append_sid('faq.php'),
    'U_STATISTICS' => append_sid('statistics.php'),
    'U_VIEWONLINE' => append_sid('viewonline.php'),
    'U_MEMBERSLIST' => append_sid('memberlist.php'),
    'U_GROUP_CP' => append_sid('groupcp.php'),
    'U_STAFF' => append_sid('staff.php'),
    'L_STAFF' => $lang['Staff'],
    'S_CONTENT_DIRECTION' => _LANG_DIRECTION,
    'S_CONTENT_LANGUAGE' => _LANGCODE,
    'S_CONTENT_ENCODING' => _CHARSET,
    'S_CONTENT_DIR_LEFT' => $lang['LEFT'],
    'S_CONTENT_DIR_RIGHT' => $lang['RIGHT'],
    'S_LOGIN_ACTION' => 'modules.php?name=Your_Account',
    'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
    'T_BODY_BACKGROUND' => "",
    'T_BODY_BGCOLOR' => '#'."ffffff",
    'T_BODY_TEXT' => '#'."000000",
    'T_BODY_LINK' => '#'."000000",
    'T_BODY_VLINK' => '#'."000000",
    'T_BODY_ALINK' => '#'."000000",
    'T_BODY_HLINK' => '#'."000000",
    'T_TR_COLOR1' => '#'."ffffff",
    'T_TR_COLOR2' => '#'."ffffff",
    'T_TR_COLOR3' => '#'."ffffff",
    'T_TR_CLASS1' => "",
    'T_TR_CLASS2' => "",
    'T_TR_CLASS3' => "",
    'T_TH_COLOR1' => '#'."ffffff",
    'T_TH_COLOR2' => '#'."ffffff",
    'T_TH_COLOR3' => '#'."ffffff",
    'T_TH_CLASS1' => "",
    'T_TH_CLASS2' => "",
    'T_TH_CLASS3' => "",
    'T_TD_COLOR1' => '#'."ffffff",
    'T_TD_COLOR2' => '#'."ffffff",
    'T_TD_COLOR3' => '#'."ffffff",
    'T_TD_CLASS1' => "",
    'T_TD_CLASS2' => "",
    'T_TD_CLASS3' => "",
    'T_FONTFACE1' => "Verdana, Arial, Helvetica, sans-serif",
    'T_FONTFACE2' => "Trebuchet MS",
    'T_FONTFACE3' => "Courier, Courier New, sans-serif",
    'T_FONTSIZE1' => "10",
    'T_FONTSIZE2' => "11",
    'T_FONTSIZE3' => "12",
    'T_FONTCOLOR1' => '#'."444444",
    'T_FONTCOLOR2' => '#'."000000",
    'T_FONTCOLOR3' => '#'."000000",
    'T_SPAN_CLASS1' => "",
    'T_SPAN_CLASS2' => "",
    'T_SPAN_CLASS3' => "")
);

$template->pparse('header');

?>