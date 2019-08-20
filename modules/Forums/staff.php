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

if (!defined('MODULE_FILE') ) {
   die('You can\'t access this file directly...');
}

define('IN_PHPBB', TRUE);
global $_GETVAR;

$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ($popup != '1'){
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

include($phpbb_root_path . 'common.php');

$userdata = session_pagestart($user_ip, PAGE_STAFF);
init_userprefs($userdata);

$page_title = $lang['Staff'];
include_once(NUKE_INCLUDE_DIR.'page_header.php');

$template->set_filenames(array(
    'body' => 'staff_body.tpl')
);

if ( is_user() ) {
    $uid = $userdata['user_id'];
} else {
    $uid = ANONYMOUS;
}

// forums
 $sql = "SELECT ug.user_id, f.forum_id, f.forum_name
         FROM (" . USER_GROUP_TABLE . " ug
         LEFT JOIN  " . USER_GROUP_TABLE . " ug2  ON ug2.user_id = " . $uid . "
         LEFT JOIN  " . AUTH_ACCESS_TABLE . " aa2 ON aa2.group_id = ug2.group_id AND aa2.auth_view = " . TRUE . ",
         " . FORUMS_TABLE . " f, " . AUTH_ACCESS_TABLE . " aa)
         WHERE aa.auth_mod = " . TRUE . "
         AND ug.group_id = aa.group_id
         AND f.forum_id = aa.forum_id
         AND ( f.auth_view <= '".AUTH_VIEW."'
         OR aa2.auth_view = " . TRUE . ")";
if ( !$result = $db->sql_query($sql) ) {
    message_die(GENERAL_ERROR, 'Could not query forums.', '', __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) ) {
    $forum_id = $row['forum_id'];
    $staff2[$row['user_id']][$row['forum_id']] = '<a href="'.append_sid("viewforum.php?f=$forum_id").'">'.$row['forum_name'].'</a><br />';
}
$db->sql_freeresult($result);

//main
$sql = "SELECT * FROM ".USERS_TABLE."
        WHERE user_level >= 2
        AND user_active = ".TRUE."
        ORDER BY user_level = 3, user_level = 4";
if ( !($results = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not obtain user information.', '', __LINE__, __FILE__, $sql);
}
while($staff = $db->sql_fetchrow($results)) {
    $poster_avatar = GetAvatar($staff['user_id']);
    $lvl = $staff['user_level']-1;
    $result = $db->sql_query('SELECT group_name FROM '. AUC_TABLE .' WHERE group_id='.$lvl);
    list($group_name) = $db->sql_fetchrow($result);
    $level = GroupColor($group_name);
    $db->sql_freeresult($result);
    $level .= "<br />\n<hr />\n";

    //Groups
    $result = $db->sql_query("SELECT g.group_name FROM (" . GROUPS_TABLE . " g LEFT JOIN " . USER_GROUP_TABLE . " ug on ug.group_id=g.group_id) WHERE ug.user_id='".$staff['user_id']."' and g.group_description != 'Personal User'");
    if ($db->sql_numrows($result) != 0) {
        while(list($group_name) = $db->sql_fetchrow($result)) {
            $level .= GroupColor($group_name). "<br />";
        }
        $db->sql_freeresult($result);
    }
    $forums = '';
    if ( !empty($staff2[$staff['user_id']]) ) {
        asort($staff2[$staff['user_id']]);
        $forums = implode(' ',$staff2[$staff['user_id']]);
    }
    $regdate = $staff['user_regdate'];
    $nukedate = strtotime($regdate);
    $memberdays = max(1, round( ( time() - $nukedate ) / 86400 ));
    $posts_per_day = $staff['user_posts'] / $memberdays;
    if ( $staff['user_posts'] != 0 ) {
        $total_posts = get_db_stat('postcount');
        $percentage = ( $total_posts ) ? min(100, ($staff['user_posts'] / $total_posts) * 100) : 0;
    } else {
        $percentage = 0;
    }
    $user_id = $staff['user_id'];
    $sql = "SELECT post_time, post_id FROM ".POSTS_TABLE." WHERE poster_id = " . $user_id . " ORDER BY post_time DESC LIMIT 1";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Error getting user last post time', '', __LINE__, __FILE__, $post_time_sql);
    }
    $row = $db->sql_fetchrow($result);
    $last_post = ( isset($row['post_time']) ) ? '<a href="'.append_sid("viewtopic.php?" . POST_POST_URL . "=$row[post_id]#$row[post_id]").'">'.create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']).'</a>' : $lang['None'];
    $sql = "SELECT * FROM " . RANKS_TABLE . " ORDER BY rank_special, rank_min";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
    }
    $ranksrow = array();
    while ( $row = $db->sql_fetchrow($result) ) {
        $ranksrow[] = $row;
    }
    $db->sql_freeresult($result);

    $rank = '';
    $rank_image = '';
    if ( $staff['user_rank'] ) {
        for($j = 0; $j < count($ranksrow); $j++) {
            if ( $staff['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] ) {
                $rank = $ranksrow[$j]['rank_title'];
                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $rank . '" title="' . $rank . '" border="0" /><br />' : '';
            }
        }
    } else {
        for($j = 0; $j < count($ranksrow); $j++) {
            if ( $staff['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] ) {
                $rank = $ranksrow[$j]['rank_title'];
                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $rank . '" title="' . $rank . '" border="0" /><br />' : '';
            }
        }
    }
    $contact_img = EvoKernel_UserContactImg($staff);
    $template->assign_block_vars('staff', array(
        'AVATAR'            => $poster_avatar,
        'RANK'              => $rank,
        'RANK_IMAGE'        => $rank_image,
        'U_NAME'            => "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=$staff[user_id]",
        'NAME'              => UsernameColor($staff['username']),
        'LEVEL'             => $level,
        'ONLINE_STATUS_IMG' => $contact_img['online_status_img'],
        'ONLINE_STATUS'     => $contact_img['online_status'],
        'FORUMS'            => $forums,
        'JOINED'            => formatTimestamp(strtotime(substr($staff['user_regdate'], 4,2).' '.substr($staff['user_regdate'], 0,3).' '.substr($staff['user_regdate'], 8,4)), '', '1'),
        'PERIOD'            => sprintf($lang['Period'], $memberdays),
        'POSTS'             => $staff['user_posts'],
        'POST_DAY'          => sprintf($lang['User_post_day_stats'], $posts_per_day),
        'POST_PERCENT'      => sprintf($lang['User_post_pct_stats'], $percentage),
        'LAST_POST'         => $last_post,
        'MAIL'              => $contact_img['email_img'],
        'PM'                => $contact_img['pm_img'],
        'MSN'               => $contact_img['msn_img'],
        'YIM_STATUS_IMG'    => $contact_img['yim_status_img'],
        'YIM_IMG'           => $contact_img['yim_img'],
        'YIM'               => $contact_img['yim'],
        'YIM_IMG_NOSCRIPT'  => $contact_img['yim_noscript'],
        'AIM'               => $contact_img['aim_img'],
        'ICQ_STATUS_IMG'    => $contact_img['icq_status_img'],
        'ICQ_IMG'           => $contact_img['icq_img'],
        'ICQ'               => $contact_img['icq'],
        'ICQ_IMG_NOSCRIPT'  => $contact_img['icq_noscript'],
        'WWW'               => $contact_img['www_img']
        )
    );
}
$template->assign_vars(array(
    'L_AVATAR'      => $lang['Avatar'],
    'L_USERNAME'    => $lang['Username'],
    'L_FORUMS'      => $lang['Forums'],
    'L_POSTS'       => $lang['Posts'],
    'L_JOINED'      => $lang['Joined'],
    'L_EMAIL'       => $lang['Email'],
    'L_PM'          => $lang['Private_Message'],
    'L_MESSENGER'   => $lang['Messenger'],
    'L_WWW'         => $lang['Website'])
);

$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>