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
$title_name  = $module_name;
$logo_name   = 'memberlist-logo.png';
require(NUKE_FORUMS_DIR.'/nukebb.php');

define('IN_PHPBB', true);
include_once(NUKE_FORUMS_DIR . 'common.php');
include_once(NUKE_INCLUDE_DIR.'functions_selects.php');

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_VIEWMEMBERS);
init_userprefs($userdata);
//
// End session management
//

global $_GETVAR;

$start          = $_GETVAR->get('start', '_GET', 'int', 0);
$start          = ($start < 0) ? 0 : $start;
$mode           = $_GETVAR->get('mode', '_REQUEST', 'string', 'joined');
$sort_order     = $_GETVAR->get('order', '_REQUEST', 'string');
$sort_order     = ($sort_order == 'ASC') ? $sort_order : 'DESC';
$username       = $_GETVAR->get('username', '_POST', 'string', NULL);
$submituser     = $_GETVAR->get('submituser', '_POST', 'string', NULL);

//
// Memberlist sorting
//
$mode_types_text = array($lang['Sort_Joined'], $lang['Sort_Username'], $lang['Sort_Location'], $lang['Sort_Posts'], $lang['Sort_Email'],  $lang['Sort_Website'], $lang['Sort_Top_Ten'], $lang['Online_status']);
$mode_types = array('joined', 'username', 'location', 'posts', 'email', 'website', 'topten', 'online');

$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++) {
    $selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
    $select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';

$select_sort_order = '<select name="order">';
if($sort_order == 'ASC') {
    $select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
} else {
    $select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';

//
// Generate page
//
$page_title = $lang['Memberlist'];
include(NUKE_INCLUDE_DIR.'page_header.php');

$template->set_filenames(array(
    'body' => 'memberlist_body.tpl')
);
if (is_active('Forums')) {
    make_jumpbox('viewforum.php');
}

$template->assign_vars(array(
    'L_SELECT_SORT_METHOD'  => $lang['Select_sort_method'],
    'L_EMAIL'               => $lang['Email'],
    'L_WEBSITE'             => $lang['Website'],
    'L_FROM'                => $lang['Location'],
    'L_ORDER'               => $lang['Order'],
    'L_PRIVATE_MESSAGE'     => $lang['Private_Message'],
    'L_LOOK_UP'             => $lang['Look_up_User'],
    'L_FIND_USERNAME'       => $lang['Find_username'],
    'U_SEARCH_USER'         => 'modules.php?name=Forums&amp;file=search&amp;mode=searchuser&amp;popup=1',
    'L_SORT'                => $lang['Sort'],
    'L_SUBMIT'              => $lang['Sort'],
    'L_AIM'                 => $lang['AIM'],
    'L_YIM'                 => $lang['YIM'],
    'L_MSNM'                => $lang['MSNM'],
    'L_ICQ'                 => $lang['ICQ'],
    'L_JOINED'              => $lang['Joined'],
    'L_POSTS'               => $lang['Posts'],
    'L_ONLINE_STATUS'       => $lang['Online_status'],
    'L_PM'                  => $lang['Private_Message'],
    'S_MODE_SELECT'         => $select_sort_mode,
    'S_ORDER_SELECT'        => $select_sort_order,
    'S_MODE_ACTION'         => append_sid('memberlist.php'))
);

switch( $mode ) {
    case 'joined':
        $order_by = "user_id $sort_order LIMIT $start, " . $board_config['topics_per_page'];
        break;
    case 'username':
        $order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
        break;
    case 'location':
        $order_by = "user_from $sort_order LIMIT $start, " . $board_config['topics_per_page'];
        break;
    case 'posts':
        $order_by = "user_posts $sort_order LIMIT $start, " . $board_config['topics_per_page'];
        break;
    case 'email':
        $order_by = "user_email $sort_order LIMIT $start, " . $board_config['topics_per_page'];
        break;
    case 'website':
        $order_by = "user_website $sort_order LIMIT $start, " . $board_config['topics_per_page'];
        break;
    case 'topten':
        $order_by = "user_posts $sort_order LIMIT 10";
        break;
    case 'online':
        break;
    default:
        $order_by = "user_id $sort_order LIMIT $start, " . $board_config['topics_per_page'];
        break;
}

if ( $username && isset($submituser) ) {
    $sql = "SELECT username, user_id, user_viewemail, user_posts, user_regdate, user_from, user_website, user_email, user_icq, user_aim, user_yim, user_msnm, user_avatar, user_avatar_type, user_allowavatar, user_allow_viewonline, user_session_time
        FROM " . USERS_TABLE . "
        WHERE username = '$username' AND user_id <> " . ANONYMOUS . " AND user_active > 0 LIMIT 1";
} elseif ($mode == 'online') {
    $sql = "SELECT username, user_id, user_viewemail, user_posts, user_regdate, user_from, user_website, user_email, user_icq, user_aim, user_yim, user_msnm, user_avatar, user_avatar_type, user_allowavatar, user_allow_viewonline, user_session_time
        FROM " . USERS_TABLE . " RIGHT OUTER JOIN ". _SESSION_TABLE ." ON " . USERS_TABLE . ".username = ". _SESSION_TABLE .".uname
        WHERE user_id <> " . ANONYMOUS . "
        AND user_active > 0
        ORDER BY username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
} else {
    $sql = "SELECT username, user_id, user_viewemail, user_posts, user_regdate, user_from, user_website, user_email, user_icq, user_aim, user_yim, user_msnm, user_avatar, user_avatar_type, user_allowavatar, user_allow_viewonline, user_session_time
        FROM " . USERS_TABLE . "
        WHERE user_id <> " . ANONYMOUS . "
        AND user_active > 0
        ORDER BY $order_by ";
}

if( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) ) {
    $i = 0;
    do {
        $username = $row['username'];
        $user_id = intval($row['user_id']);
        if (( $row['user_website'] == "http:///") || ( $row['user_website'] == "http://")){
            $row['user_website'] =  "";
        }
        if (($row['user_website'] != "" ) && (substr($row['user_website'],0, 7) != "http://")) {
            $row['user_website'] = "http://".$row['user_website'];
        }
        $row['user_from'] = str_replace(".gif", "", $row['user_from']);
        $from = ( !empty($row['user_from']) ) ? $row['user_from'] : '&nbsp;';
        $joined = formatTimestamp(strtotime(substr($row['user_regdate'], 4,2).' '.substr($row['user_regdate'], 0,3).' '.substr($row['user_regdate'], 8,4)), '', '1');
        $posts = ( $row['user_posts'] ) ? $row['user_posts'] : 0;
        $poster_avatar = GetAvatar($row['user_id']);
        $temp_url = "modules.php?name=Search&search_author=" . urlencode($username) . "&amp;showresults=posts";
        $search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $username) . '" title="' . sprintf($lang['Search_user_posts'], $username) . '" border="0" /></a>';
        $search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $username) . '</a>';
        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
        $contact_img = EvoKernel_UserContactImg($row);
        $template->assign_block_vars('memberrow', array(
            'ROW_NUMBER'    => $i + ( $start + 1 ),
            'ROW_COLOR'     => '#' . $row_color,
            'ROW_CLASS'     => $row_class,
            'USERNAME'      => UsernameColor($row['username']),
            'FROM'          => $from,
            'JOINED'        => $joined,
            'POSTS'         => $posts,
            'AVATAR_IMG'    => $poster_avatar,
            'PROFILE_IMG'   => $contact_img['profile_img'],
            'PROFILE'       => $contact_img['profile'],
            'SEARCH_IMG'    => $search_img,
            'SEARCH'        => $search,
            'PM_IMG'        => $contact_img['pm_img'],
            'PM'            => $contact_img['pm'],
            'EMAIL_IMG'     => $contact_img['email_img'],
            'EMAIL'         => $contact_img['email'],
            'WWW_IMG'       => $contact_img['www_img'],
            'WWW'           => $contact_img['www'],
            'ICQ_STATUS_IMG'=> $contact_img['icq_status_img'],
            'ICQ_IMG'       => $contact_img['icq_img'],
            'ICQ'           => $contact_img['icq_noscript'],
            'AIM_IMG'       => $contact_img['aim_img'],
            'AIM'           => $contact_img['aim'],
            'MSN_IMG'       => $contact_img['msn_img'],
            'MSN'           => $contact_img['msn'],
            'YIM_STATUS_IMG'=> $contact_img['yim_status_img'],
            'YIM_IMG'       => $contact_img['yim_img'],
            'YIM'           => $contact_img['yim_noscript'],
            'ONLINE_STATUS_IMG' => $contact_img['online_status_img'],
            'ONLINE_STATUS' => $contact_img['online_status'],
            'U_VIEWPROFILE' => "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id")
        );
        $i++;
    } while ( $row = $db->sql_fetchrow($result) );
    $db->sql_freeresult($result);
} else {
    $template->assign_block_vars('no_username', array(
        'NO_USER_ID_SPECIFIED' => $lang['No_user_id_specified']    )
    );
}

if ( $mode != 'topten'  ) {
    if ($mode == 'online') {
        $sql = "SELECT COUNT(user_id) as total
            FROM " . USERS_TABLE . " RIGHT OUTER JOIN ". _SESSION_TABLE ." ON " . USERS_TABLE . ".username = ". _SESSION_TABLE .".uname
            WHERE user_id <> " . ANONYMOUS . "
            AND user_active > 0";
    } else {
        $sql = "SELECT count(user_id) AS total
            FROM " . USERS_TABLE . "
            WHERE user_id <> " . ANONYMOUS . "
            AND user_active > 0";
    }
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
    }
    if ( $total = $db->sql_fetchrow($result) ) {
        $total_members = $total['total'];
        $pagination = generate_pagination('memberlist.php?mode='.$mode.'&amp;order='.$sort_order, $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
    }
    $db->sql_freeresult($result);
} else {
    $pagination = '&nbsp;';
    $total_members = 10;
}

$page_number_of    = floor( $start / $board_config['topics_per_page'] ) + 1;
$page_number_total = ceil( $total_members / $board_config['topics_per_page'] );
$page_number_total = ($page_number_total > 0 ? $page_number_total : 1);
$template->assign_vars(array(
    'PAGINATION' => $pagination,
    'PAGE_NUMBER' => sprintf($lang['Page_of'], $page_number_of, $page_number_total ),
    'L_GOTO_PAGE' => $lang['Goto_page'])
);

$template->pparse('body');

include(NUKE_INCLUDE_DIR.'page_tail.php');

?>