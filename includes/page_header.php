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

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

define('HEADER_INC', TRUE);

global $name, $userinfo, $userdata, $page_title, $pagetitle, $is_inline_review, $db, $cache, $ThemeSel, $template, $currentlang, $evoconfig, $phpbb_root_path, $_GETVAR, $pc_dateTime, $suppress, $nav_separator, $page_meta, $header_meta, $title_name, $logo_name;

// $gen_simple_header means, that we do not need ANY Output of Variables ... only generate Header
$gen_simple_header = ((!empty($gen_simple_header) && $gen_simple_header == TRUE) ? TRUE : FALSE );
//
// Parse and show the overall header.
//
$template->set_filenames(array(
        'overall_header' => ( !$gen_simple_header ) ? 'overall_header.tpl' : 'simple_header.tpl')
);

if ( (isset($page_meta) && !empty($page_meta)) || (isset($header_meta) && !empty($header_meta)) ) {
    $meta = '';
    if ((isset($page_meta) && !empty($page_meta))) {
        $meta .= $page_meta;
    }
    if ((isset($header_meta) && !empty($header_meta))) {
        $meta .= $header_meta;
    }
    $template->assign_vars(array(
        'META' => $meta)
    );
    $header_meta = $meta;
}

$s_privmsg_new     = 0;

//
// Generate logged in/logged out status
//
if ( is_user() ) {
    $u_login_logout = 'modules.php?name=Your_Account&amp;op=logout&amp;redirect=Forums';
    $l_login_logout = $lang['Logout'] . ' [ ' . UsernameColor($userdata['username']) . ' ]';
} else {
    $u_login_logout = 'modules.php?name=Your_Account&amp;redirect=index';
    $l_login_logout = $lang['Login'];
}

if (defined('SHOW_ONLINE') && !$gen_simple_header) {
    $online_users = phpBB_showonline();
}

$online_color  = ' style="color: #' . $theme['online_color'] . '"';
$offline_color = ' style="color: #' . $theme['offline_color'] . '"';
$hidden_color  = ' style="color: #' . $theme['hidden_color'] . '"';

// Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', $evoconfig['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $evoconfig['board_timezone'])] : $lang[number_format($evoconfig['board_timezone'])];

$template->assign_block_vars('colors',array(
    'GROUPS'    => GetColorGroups())
);

//
// Is Quick Search enabled? If so, assign our vars for the template.
//
if ( $evoconfig['quick_search_enable'] == 1 && $userdata['session_page'] != PAGE_SEARCH ) {
    $sql = "SELECT * FROM " . QUICKSEARCH_TABLE . " ORDER BY search_name";
    if( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Couldn't obtain quick search data", "", __LINE__, __FILE__, $sql);
    }
    $search_count = $db->sql_numrows($result);
    $search_rows = array();
    $search_rows = $db->sql_fetchrowset($result);
    $db->sql_freeresult($result);

    $search_list = '<option value="forum_search" selected="selected">' . $evoconfig['sitename'] . '</option>';
    $checkSearch = '';

    //
    // First Search Entry
    //
    if ( $search_count != '' ) {
        $search_name = $search_rows[0]['search_name'];
        $search_url1 = $search_rows[0]['search_url1'];
        $search_url2 = $search_rows[0]['search_url2'];

        $search_list .= '<option value="' . $search_name . '">' . $search_name . '</option>';

        // checkSearch() function, adapted from Smartor's ezPortal
        $checkSearch .= "if (document.search_block.site_search.value == '$search_name')
             {
                window.open('$search_url1' + document.search_block.search_keywords.value + '$search_url2', '_$search_name', '');
                return false;
             }\n";
    }

    //
    // Start from Second Entry
    //
    for($i = 1; $i < $search_count; $i++) {
        $search_name = $search_rows[$i]['search_name'];
        $search_url1 = $search_rows[$i]['search_url1'];
        $search_url2 = $search_rows[$i]['search_url2'];

        $search_list .= '<option value="' . $search_name . '">' . $search_name . '</option>';

        // checkSearch() function, adapated from Smartor's ezPortal
        $checkSearch .= "else if (document.search_block.site_search.value == '$search_name')
             {
                window.open('$search_url1' + document.search_block.search_keywords.value + '$search_url2', '_$search_name', '');
                return false;
             }\n";

    }

    //
    // Set $l_advanced_forum_search variable
    //
    $l_advanced_forum_search = sprintf($lang['Forum_advanced_search'], $evoconfig['sitename']);
    if ( !is_user() && $evoconfig['search_disable_security_code'] == 1) {
        $template->assign_block_vars('switch_search_security_code', array());
        $template->assign_vars(array(
            'L_SEARCH_SECURITY_CODE' => security_code(1,'small', 1))
        );
    }

    $template->assign_block_vars('switch_quick_search', array(
        'L_QUICK_SEARCH_FOR' => $lang['Quick_search_for'],
        'L_QUICK_SEARCH_AT' => $lang['Quick_search_at'],
        'L_ADVANCED_FORUM_SEARCH' => $l_advanced_forum_search,
        'CHECKSEARCH' => $checkSearch,
        'SEARCHLIST' => $search_list)
    );
}

$script_name     = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($evoconfig['script_path']));
$server_name     = trim($evoconfig['server_name']);
$server_protocol = ( $evoconfig['cookie_secure'] ) ? 'https://' : 'http://';
$server_port     = ( $evoconfig['server_port'] <> 80 ) ? ':' . trim($evoconfig['server_port']) . '/' : '/';
$server_url      = $server_protocol . $server_name . $server_port . "modules.php?name=Forums";

//
// The following assigns all _common_ variables that may be used at any point
// in a template.
//
if( (!isset($page_title) || empty($page_title)) ) {
    $page_title = basename(dirname(__FILE__));
}
$pagetitle = ((isset($pagetitle) && !empty($pagetitle)) ? $pagetitle : $page_title);

if(!isset($day_userlist)) {
    $day_userlist = '';
}


if (!$gen_simple_header) {
    $pc_tzo     = $_GETVAR->get('pc_tzo', '_GET', 'int', NULL);
    $nav_key    = ($_GETVAR->get(POST_CAT_URL, '_REQUEST', 'int') ? POST_CAT_URL.$_GETVAR->get(POST_CAT_URL, '_REQUEST', 'int') : (
                        $_GETVAR->get(POST_FORUM_URL, '_REQUEST', 'int') ? POST_FORUM_URL.$_GETVAR->get(POST_FORUM_URL, '_REQUEST', 'int') : (
                        $_GETVAR->get(POST_TOPIC_URL, '_REQUEST', 'int') ? POST_TOPIC_URL.$_GETVAR->get(POST_TOPIC_URL, '_REQUEST', 'int') : (
                        $_GETVAR->get(POST_POST_URL, '_REQUEST', 'string')  ? POST_POST_URL.$_GETVAR->get(POST_POST_URL, '_REQUEST', 'string') : (
                        $_GETVAR->get('selected_id', '_REQUEST', 'string')  ? $_GETVAR->get('selected_id', '_REQUEST', 'string') : 'Root')))));
    if ( !@file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $evoconfig['default_lang'] . '/lang_adv_time.php')) ) {
        include_once($phpbb_root_path . 'language/lang_english/lang_adv_time.php');
    } else {
        include_once($phpbb_root_path . 'language/lang_' . $evoconfig['default_lang'] . '/lang_adv_time.php');
    }

    if ( ($userdata['user_id'] != ANONYMOUS && $userdata['user_time_mode'] >= 4)  || ($userdata['user_id'] == ANONYMOUS && $evoconfig['default_time_mode'] >= 4) ) {
        if ( !isset($pc_dateTime['pc_timezoneOffset']) && !isset($pc_tzo) ) {
            $template->assign_block_vars('switch_send_pc_dateTime', array());
            if ( $userdata['user_pc_timeOffsets'] != '0' ) {
                $template->assign_block_vars('switch_valid_time', array());
            }
        } else {
            $template->assign_block_vars('switch_valid_time', array());
        }
    } else {
        $template->assign_block_vars('switch_valid_time', array());
    }

    $lang_file = '/lang_extend_ranks.php';
    if (@file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
        include($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
    } elseif (file_exists($phpbb_root_path . 'language/lang_' . $evoconfig['default_lang'] . $lang_file)) {
        include($phpbb_root_path . 'language/lang_' . $evoconfig['default_lang'] . $lang_file);
    } else {
        die('Neither your selected nor the board-default language-file could be found');
    }
    if ( is_user() ) {
        switch ( $userdata['user_time_mode'] )     {
            case MANUAL_DST:
                $time_message = sprintf($lang['All_times'], $l_timezone) . $lang['dst_enabled_mode'];
                break;
            case SERVER_SWITCH:
                $time_message = sprintf($lang['All_times'], $l_timezone);
                if ( date('I', time()) ) {
                    $time_message = $time_message . $lang['dst_enabled_mode'];
                }
                break;
            case FULL_SERVER:
                $time_message = $lang['full_server_mode'];
                break;
            case SERVER_PC:
                $time_message = $lang['server_pc_mode'];
                break;
            case FULL_PC:
                $time_message = $lang['full_pc_mode'];
                break;
            default:
                $time_message = sprintf($lang['All_times'], $l_timezone);
                break;
        }
    } else {
        switch ( $evoconfig['default_time_mode'] ) {
            case MANUAL_DST:
                $time_message = sprintf($lang['All_times'], $l_timezone) . $lang['dst_enabled_mode'];
                break;
            case SERVER_SWITCH:
                $time_message = sprintf($lang['All_times'], $l_timezone);
                if ( date('I', time()) ) {
                    $time_message = $time_message . $lang['dst_enabled_mode'];
                }
                break;
            case FULL_SERVER:
                $time_message = $lang['full_server_mode'];
                break;
            case SERVER_PC:
                $time_message = $lang['server_pc_mode'];
                break;
            case FULL_PC:
                $time_message = $lang['full_pc_mode'];
                break;
            default:
                $time_message = sprintf($lang['All_times'], $l_timezone);
                break;
        }
    }
    $time_message    = str_replace('GMT', 'UTC', $time_message);
    //
    // Obtain number of new private messages
    // if user is logged in
    //
    if ( is_user() ) {
        $have_priv_mess = check_priv_mess($userdata['user_id']);
        if ( $have_priv_mess > 0 ) {
            $l_message_new = ( $have_priv_mess == 1 ) ? $lang['New_pm'] : $lang['New_pms'];
            $l_privmsgs_text = sprintf($l_message_new, $have_priv_mess);
            if ( !$suppress || !$userdata['user_popup_pm'] ) {
                $icon_pm = $images['pm_new_msg'];
                $pms = $db->sql_ufetchrow("SELECT COUNT(privmsgs_id) as no FROM ".PRIVMSGS_TABLE." WHERE privmsgs_to_userid='".$userdata['user_id']."' AND privmsgs_type='1'");
                if ($pms['no'] > 0) {
                    $s_privmsg_new = 1;
                }
            } else {
                $s_privmsg_new = 0;
                $icon_pm = $images['pm_new_msg'];
            }
        } else {
            $l_privmsgs_text = $lang['No_new_pm'];
            $s_privmsg_new = 0;
            $icon_pm = $images['pm_no_new_msg'];
        }
    }
    //
    // Generate HTML required for Mozilla Navigation bar
    //
    if (!isset($nav_links)) {
        $nav_links = array();
    }
    $nav_links_html = '';
    $nav_link_proto = '<link rel="%s" href="%s" title="%s" />' . "\n";
    while( list($nav_item, $nav_array) = @each($nav_links) ) {
        if ( !empty($nav_array['url']) ) {
            $nav_links_html .= sprintf($nav_link_proto, $nav_item, append_sid($nav_array['url']), $nav_array['title']);
        } else {
            // We have a nested array, used for items like <link rel='chapter' /> that can occur more than once.
            while( list(,$nested_array) = each($nav_array) ) {
                $nav_links_html .= sprintf($nav_link_proto, $nav_item, $nested_array['url'], $nested_array['title']);
            }
       }
    }
    $gfxchk = array(2,4,5,7);
    $gfx = "<br />" . security_code($gfxchk, 'stacked', 0) . "<br />";
    include($phpbb_root_path . 'board_message_xl.php');
    $template->assign_vars(array(
            'SITENAME' => $evoconfig['sitename'],
            'SITE_DESCRIPTION' => $evoconfig['site_desc'],
            'PAGE_TITLE' => $pagetitle,
            'PATH_TO_STYLE' => NUKE_THEMES_MAIN_DIR . $ThemeSel . '/style/style.css',
            'LAST_VISIT_DATE' => (is_user() ? sprintf($lang['You_last_visit'], formatTimestamp($userdata['user_lastvisit'])) : '&nbsp;'),
            'CURRENT_TIME' => sprintf($lang['Current_time'], formatTimestamp(time(), 'D, d M Y H:i', '' )),
            'TOTAL_USERS_ONLINE' => (isset($online_users['l_online_users']) ? $online_users['l_online_users'] : ''),
            'LOGGED_IN_USER_LIST' => (isset($online_users['all_online_userlist']) ? $online_users['all_online_userlist'] : ''),
            'LOGGED_USER_FORUM' => (isset($online_users['forum_online_userlist']) ? $online_users['forum_online_userlist'] : ''),
            'ONLINE_USERS_NOW' => $lang['Online'],
            'RECORD_USERS' => sprintf($lang['Record_online_users'], $evoconfig['record_online_users'], create_date($evoconfig['default_dateformat'], $evoconfig['record_online_date'], $evoconfig['board_timezone'])),
            'PRIVATE_MESSAGE_INFO_UNREAD' => (isset($l_privmsgs_text) ? $l_privmsgs_text : ''),
            'PRIVATE_MESSAGE_NEW_FLAG' => $s_privmsg_new,
            'PRIVMSG_IMG' => (isset($icon_pm) ? $icon_pm : ''),
            'L_Board_Currently_Disabled' => $lang['Board_Currently_Disabled'],
            'L_USERNAME' => $lang['Username'],
            'L_PASSWORD' => $lang['Password'],
            'L_LOGIN_LOGOUT' => $l_login_logout,
            'L_LOGIN' => $lang['Login'],
            'L_LOG_ME_IN' => $lang['Log_me_in'],
            'L_AUTO_LOGIN' => $lang['Log_me_in'],
            'L_INDEX' => sprintf($lang['Forum_Index'], $evoconfig['sitename']),
            'L_REGISTER' => $lang['Register'],
            'L_SEARCH' => $lang['Search'],
            'L_PRIVATEMSGS' => $lang['Private_Messages'],
            'IMG_WHO_IS_ONLINE' => NUKE_THEMES_IMAGE_DIR . $ThemeSel . '/forums/images/whosonline.gif',
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
            'L_RMW_IMAGE_TITLE' => $lang['rmw_image_title'],
            'U_RMW_JSLIB' => 'includes/rmw_jslib.js',
            'IMAGE_RESIZE_WIDTH' => $evoconfig['image_resize_width'],
            'IMAGE_RESIZE_HEIGHT' => $evoconfig['image_resize_height'],
            'U_RECENT' => append_sid('recent.php'),
            'L_RECENT' => $lang['Recent_topics'],
            'U_SEARCH_UNANSWERED' => append_sid('search.php?search_id=unanswered'),
            'U_SEARCH_SELF' => append_sid('search.php?search_id=egosearch'),
            'U_SEARCH_NEW' => append_sid('search.php?search_id=newposts'),
            'U_INDEX' => append_sid('index.php'),
            'U_REGISTER' => append_sid('profile.php?mode=register'),
            'U_PRIVATEMSGS_POPUP' => append_sid('privmsg.php?mode=newpm&popup=1', TRUE),  // do NOT change here & to &amp;
            'U_SEARCH' => append_sid('search.php'),
            'U_MODCP' => append_sid('modcp.php'),
            'U_FAQ' => append_sid('faq.php'),
            'U_ONLINE' => append_sid('viewonline.php'),
            'L_ONLINE' => $lang['Viewonline'],
            'U_STATISTICS' => append_sid('statistics.php'),
            'U_VIEWONLINE' => append_sid('viewonline.php'),
            'U_LOGIN_LOGOUT' => $u_login_logout,
            'U_MEMBERLIST' => append_sid('memberlist.php'),
            'U_GROUP_CP' => append_sid('groupcp.php'),
            'U_SELF' => $server_url,
            'U_STAFF' => append_sid('staff.php'),
            'L_STAFF' => $lang['Staff'],
            'S_CONTENT_DIRECTION' => $lang['DIRECTION'],
            'S_CONTENT_ENCODING' => $lang['ENCODING'],
            'S_CONTENT_DIR_LEFT' => $lang['LEFT'],
            'S_CONTENT_DIR_RIGHT' => $lang['RIGHT'],
            'S_TIMEZONE' => $time_message,
            'S_LOGIN_ACTION' => 'modules.php?name=Your_Account&amp;op=login&amp;module=Forums',
            'GFX' => $gfx,
            'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
            'T_BODY_BACKGROUND' => $theme['body_background'],
            'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
            'T_BODY_TEXT' => '#'.$theme['body_text'],
            'T_BODY_LINK' => '#'.$theme['body_link'],
            'T_BODY_VLINK' => '#'.$theme['body_vlink'],
            'T_BODY_ALINK' => '#'.$theme['body_alink'],
            'T_BODY_HLINK' => '#'.$theme['body_hlink'],
            'T_TR_COLOR1' => '#'.$theme['tr_color1'],
            'T_TR_COLOR2' => '#'.$theme['tr_color2'],
            'T_TR_COLOR3' => '#'.$theme['tr_color3'],
            'T_TR_CLASS1' => $theme['tr_class1'],
            'T_TR_CLASS2' => $theme['tr_class2'],
            'T_TR_CLASS3' => $theme['tr_class3'],
            'T_TH_COLOR1' => '#'.$theme['th_color1'],
            'T_TH_COLOR2' => '#'.$theme['th_color2'],
            'T_TH_COLOR3' => '#'.$theme['th_color3'],
            'T_TH_CLASS1' => $theme['th_class1'],
            'T_TH_CLASS2' => $theme['th_class2'],
            'T_TH_CLASS3' => $theme['th_class3'],
            'T_TD_COLOR1' => '#'.$theme['td_color1'],
            'T_TD_COLOR2' => '#'.$theme['td_color2'],
            'T_TD_COLOR3' => '#'.$theme['td_color3'],
            'T_TD_CLASS1' => $theme['td_class1'],
            'T_TD_CLASS2' => $theme['td_class2'],
            'T_TD_CLASS3' => $theme['td_class3'],
            'T_FONTFACE1' => $theme['fontface1'],
            'T_FONTFACE2' => $theme['fontface2'],
            'T_FONTFACE3' => $theme['fontface3'],
            'T_FONTSIZE1' => $theme['fontsize1'],
            'T_FONTSIZE2' => $theme['fontsize2'],
            'T_FONTSIZE3' => $theme['fontsize3'],
            'T_FONTCOLOR1' => '#'.$theme['fontcolor1'],
            'T_FONTCOLOR2' => '#'.$theme['fontcolor2'],
            'T_FONTCOLOR3' => '#'.$theme['fontcolor3'],
            'T_SPAN_CLASS1' => $theme['span_class1'],
            'T_SPAN_CLASS2' => $theme['span_class2'],
            'T_SPAN_CLASS3' => $theme['span_class3'],
            // Not used, but can help you...
            'T_ONLINE_COLOR' => '#' . $theme['online_color'],
            'T_OFFLINE_COLOR' => '#' . $theme['offline_color'],
            'T_HIDDEN_COLOR' => '#' . $theme['hidden_color'],
            'NAV_LINKS' => $nav_links_html)
    );

    if ( is_admin() ) {
         if($evoconfig['board_disable'] == 1) {
             $template->assign_block_vars('boarddisabled', array());
         }
    }
    //
    // Login box?
    //
    if ( !is_user() ) {
        $template->assign_block_vars('switch_user_logged_out', array());
        //
        // Allow autologin?
        //
        if (!isset($evoconfig['allow_autologin']) || $evoconfig['allow_autologin'] ) {
            $template->assign_block_vars('switch_allow_autologin', array());
            $template->assign_block_vars('switch_user_logged_out.switch_allow_autologin', array());
        }
    } else {
        $template->assign_block_vars('switch_user_logged_in', array());

        if ( $s_privmsg_new ) {
            $template->assign_block_vars('switch_enable_pm_popup', array());
        }
        $template->assign_block_vars('switch_private_message', array(
            'U_PRIVATEMSGS' => append_sid('privmsg.php?folder=inbox&amp;suppress=1'),
            'I_MINI_PRIVATEMSGS' => '<img class="absmiddle" src="' . $images['Mini_Private_Messages'] . '"  border="0" alt="' . $lang['Private_Messages'] . '" hspace="3" />',
            'PRIVATE_MESSAGE_INFO' => (isset($l_privmsgs_text) ? $l_privmsgs_text : '') )
        );
        $template->assign_block_vars('switch_edit_profile', array(
            'U_PROFILE' => append_sid('profile.php?mode=editprofile'),
            'I_MINI_PROFILE' => '<img class="absmiddle" src="' . $images['Mini_Profile'] . '" border="0" alt="' . $lang['Profile'] . '" hspace="3" />',
            'L_PROFILE' => $lang['Edit_profile'])
        );
    }

    $template->assign_vars(array(
        'I_RANKS' => '<img class="absmiddle" src="' . $images['Ranks'] . '"  border="0" alt="' . $lang['Ranks'] . '" hspace="3" />',
        'U_RANKS' => append_sid('ranks.php'),
        'L_RANKS' => $lang['Ranks'],
        'logo' => '<img class="absmiddle" src="' . evo_image('forums-logo.png', 'Forums') . '"   border="0" alt="' . $evoconfig['sitename'] . ' Forum Index" hspace="1" />',
        'I_MINI_INDEX' => '<img class="absmiddle" src="' . $images['Mini_Index'] . '"  border="0" alt="' . $evoconfig['sitename'] . ' Forum Index" hspace="3" />',
        'L_MINI_INDEX' => $lang['Mini_Index'],
        'I_MINI_FAQ' => '<img class="absmiddle" src="' . $images['Mini_Faq'] . '"  border="0" alt="' . $lang['FAQ'] . '" hspace="3" />',
        'I_MINI_SEARCH' => '<img class="absmiddle" src="' . $images['Mini_Search'] . '"  border="0" alt="' . $lang['Search'] . '" hspace="3" />',
        'I_MINI_ONLINE' => '<img class="absmiddle" src="' . $images['Mini_Online'] . '"  border="0" alt="' . $lang['Online'] . '" hspace="3" />',
        'I_MINI_USERGROUPS' => '<img class="absmiddle" src="' . $images['Mini_Usergroups'] . '"  border="0" alt="' . $lang['Usergroups'] . '" hspace="3" />',
        'I_MINI_MEMBERLIST' => '<img class="absmiddle" src="' . $images['Mini_Memberlist'] . '"  border="0" alt="' . $lang['Memberlist'] . '" hspace="3" />',
        'I_STAFF' => '<img class="absmiddle" src="' . $images['Staff'] . '"  border="0" alt="' . $lang['Staff'] . '" hspace="3" />',
        'I_RULES' => '<img class="absmiddle" src="' . $images['Rules'] . '"  border="0" alt="' . $lang['Rules'] . '" hspace="3" />',
        'U_RULES' => append_sid('rules.php'),
        'L_RULES' => $lang['Rules'],
        'I_STATISTICS' => '<img class="absmiddle" src="' . $images['Statistics'] . '"  border="0" alt="' . $lang['Statistics'] . '" hspace="3" />',
        'I_MINI_LOGIN_LOGOUT' => '<img class="absmiddle" src="' . $images['Mini_Login_Logout'] . '"  border="0" alt="' . $lang['Login_Logout'] . '" hspace="3" />',
        )
    );
    $nav_pgm = (isset($nav_pgm) ? $nav_pgm : '');
    $nav_cat_desc = make_cat_nav_tree($nav_key, $nav_pgm);
    if ($nav_cat_desc != '') {
        $nav_cat_desc = $nav_separator . $nav_cat_desc;
    }
    // send to template
    $template->assign_vars(array(
        'NAV_SEPARATOR' => $nav_separator,
        'NAV_CAT_DESC'  => $nav_cat_desc,
        )
    );
}
// send to template
$template->assign_vars(array(
    'SPACER'        => $images['spacer'],
    'SPACER_IMG'    => $images['spacer'],
    )
);

include_once(NUKE_BASE_DIR . 'header.php');
if (!empty($title_name) && !empty($logo_name)) {
    title('', $title_name, $logo_name);
} else {
    if (isset($module_name) && ($module_name == 'Forums')) {
        title('', $module_name, 'forums-logo.png');
    }
}
OpenTable();
$template->pparse('overall_header');


if (!is_admin() && $evoconfig['board_disable'] && !defined('IN_ADMIN') && !defined('IN_LOGIN')) {
    if ( $evoconfig['board_disable_msg'] != '' ) {
        message_die(GENERAL_MESSAGE, $evoconfig['board_disable_msg'], 'Information');
    } else {
        message_die(GENERAL_MESSAGE, 'Board_disable', 'Information');
    }
} else{
    if (is_admin() && $evoconfig['board_disable_adminview'] != '1' && $evoconfig['board_disable'] && !defined('IN_ADMIN') && !defined('IN_LOGIN')) {
        if ( $evoconfig['board_disable_msg'] != '' ) {
            message_die(GENERAL_MESSAGE, $evoconfig['board_disable_msg'], 'Information');
        } else {
            message_die(GENERAL_MESSAGE, 'Board_disable', 'Information');
        }
    }
}

?>