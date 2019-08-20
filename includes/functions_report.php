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

function insert_report($post_id, $comments) {
    global $db, $userdata;

    $sql = "INSERT INTO " . POST_REPORTS_TABLE . " (post_id, reporter_id, report_time, report_status, report_comments)
            VALUES ($post_id, " . $userdata['user_id'] . ", " . time() . ", " . REPORT_POST_NEW . ", '" . str_replace("\'", "''", $comments) . "')";
    if ( !$db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Could not insert report', '', __LINE__, __FILE__, $sql);
    }
    return;
}

function email_report($forum_id, $post_id, $topic_title, $comments) {
    global $db, $userdata, $board_config, $lang, $tree;

    $langemail = array();
    // moderators list
    $moderators = array();
    $idx = $tree['keys'][ POST_FORUM_URL . $forum_id ];
    $xy = (isset($tree['mods'][$idx]['user_id']) ? count($tree['mods'][$idx]['user_id']) : 0);
    for ( $i = 0; $i < $xy; $i++ ) {
        $moderators[$tree['mods'][$idx]['username'][$i]] = get_user_field('user_email', $tree['mods'][$idx]['user_id'][$i], FALSE);
    }
    $xy = (isset($tree['mods'][$idx]['group_id']) ? count($tree['mods'][$idx]['group_id']) : 0);
    for ( $i = 0; $i < $xy; $i++ ) {
        $groupusers = $db->sql_query("SELECT u.user_email, u.username FROM "._USERS_TABLE." as u, ".USER_GROUP_TABLE." as ug
                                      WHERE u.user_id = ug.user_id
                                      AND ug.group_id = '".$tree['mods'][$idx]['group_id'][$i]."'");
        while ($row = $db->sql_fetchrow($groupusers)) {
            $moderators[$row['username']] = $row['user_email'];
        }
        $db->sql_freeresult($groupusers);
    }
    $admins = get_mod_admins('Forums', FALSE);
    $max = count($admins);
    for ($i = 0; $i < $max; $i++) {
        $moderators[$admins[$i]['aid']] = $admins[$i]['email'];
    }
    if (empty($moderators)) {
        $admins = get_mod_admins('super');
        $max = count($admins);
        for ($i = 0; $i < $max; $i++) {
            $moderators[$admins[$i]['aid']] = $admins[$i]['email'];
        }
    }
    if (is_array($moderators) && (count($moderators) > 0)) {
        $thislang = strtolower($board_config['default_lang']);
        if (!isset($langemail[$thislang])) {
            if (is_file(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/report_post.php')) {
                @include_once(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/report_post.php');
            } else {
                @include_once(NUKE_FORUMS_DIR.'language/lang_english/email/report_post.php');
            }
        }
        $recipients_to = evo_mail_batch($moderators);
        $subject       = $langemail[$thislang]['Report_post'] . ' - ' . $topic_title;
        $message       = $langemail[$thislang]['Report_post_Entry'];
        $message      .= $langemail[$thislang]['Report_post_LinkPost'].':<br /><br />';
        $message      .= "<a href='http://".EVO_SERVER_URL."modules.php?name=Forums&amp;viewtopic&amp;".POST_POST_URL."=".$post_id."#".$post_id."'>".$langemail['german']['Report_post_Link']."</a><br /><br />";
        $message      .= $langemail[$thislang]['Report_post_Userline'].':&nbsp;'.$userdata['username'].'<br />';
        $message      .= $langemail[$thislang]['Report_post_Commentline'].'<br /><br />';
        $message      .= $comments.'<br /><br />';
        $message      .= $board_config['board_email_sig'];
        $mailsend      = evo_mail($recipients_to, $subject, $message, '', '', TRUE);
    }
    return;
}

function show_reports($status = REPORT_POST_NEW) {
    global $db, $board_config, $template, $lang, $userdata;

    // find the forums where the user is a moderator
    $forum_ids = array();
    $forum_ids = get_forums_auth_mod();
    if ( empty($forum_ids) ) {
        return;
    } else {
        $where_sql2 = ' AND p.forum_id IN (' . implode(',', $forum_ids) . ')';
    }
    $where_sql = ( $status == 'all') ? '' : ' AND pr.report_status = ' . intval($status);
    // get the reports from the user's moderated forums
    $sql = "SELECT pr.*, u.username, t.topic_title, f.forum_id, f.forum_name
            FROM (" . POST_REPORTS_TABLE . " pr, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f)
            WHERE u.user_id = pr.reporter_id
            AND pr.post_id = p.post_id
            AND p.topic_id = t.topic_id
            AND t.forum_id = f.forum_id
            $where_sql
            $where_sql2
            ORDER BY report_time DESC";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not query reports', '', __LINE__, __FILE__, $sql);
    }
    $i = 0;
    while( $row = $db->sql_fetchrow($result) ) {
        $comments_temp          = array();
        $comments_temp          = create_comments($row);
        $last_action            = $comments_temp['last_action'];
        $comments               = $comments_temp['comments'];
        $last_action_comments   = $comments_temp['last_action_comments'];
        $row_class = ( !($i % 2) ) ? 'row1' : 'row2';
        $template->assign_block_vars('postrow', array(
            'ROW_CLASS'             => $row_class,
            'REPORT_ID'             => $row['report_id'],
            'TOPIC_TITLE'           => $row['topic_title'],
            'REPORTER'              => '<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['reporter_id'] . '">' . UsernameColor($row['username']) . '</a>',
            'COMMENTS'              => $comments,
            'DATE'                  => formatTimestamp($row['report_time']),
            'FORUM'                 => $row['forum_name'],
            'LAST_ACTION'           => $last_action,
            'LAST_ACTION_COMMENTS'  => $last_action_comments,
            'L_CLOSE_REPORT'        => ( $row['report_status'] == REPORT_POST_NEW ) ? $lang['Close'] : $lang['Open'],
            'U_VIEW_POST'           => append_sid('viewtopic.php?' . POST_POST_URL . '=' . $row['post_id'] . '#' . $row['post_id']),
            'U_CLOSE_REPORT'        => ( $row['report_status'] == REPORT_POST_NEW ) ? append_sid('viewpost_reports.php?mode=closereport&amp;report=' . $row['report_id']) : append_sid('viewpost_reports.php?mode=openreport&amp;report=' . $row['report_id']))
        );
        $i++;
    }
    $db->sql_freeresult($result);
    //
    // do a little bit of cleanup
    //
    // find how many reports with non-existent posts will be deleted
    $delete_ids = array();
    $delete_ids = get_reports_with_no_posts();
    if ( !empty($delete_ids) ) {
        // delete the specific reports
        $sql = "DELETE FROM " . POST_REPORTS_TABLE . "
                WHERE report_id IN (" . implode(',', $delete_ids) . ")";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not delete reports', '', __LINE__, __FILE__, $sql);
        }
        $deleted_reports = sprintf($lang['Non_existent_posts'], count($delete_ids));
    } else {
        $deleted_reports = '&nbsp;';
    }
    $template->assign_vars(array(
        'DELETED_REPORTS'    => $deleted_reports)
    );
    return;
}

function report_flood() {
    global $db, $board_config, $userdata;

    $sql = "SELECT MAX(report_time) AS latest_time FROM " . POST_REPORTS_TABLE . "
            WHERE reporter_id = " . $userdata['user_id'];
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not get most recent report', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $current_time = time();
    if ( ($current_time - $row['latest_time']) < $board_config['flood_interval'] ) {
        return false;
    } else {
        return true;
    }
}

// get the number of open/closed reports
function reports_count($status = REPORT_POST_NEW) {
    global $db;

    $forum_ids = array();
    $forum_ids = get_forums_auth_mod();
    // if the user is not a moderator return 0
    // normally this shouldn't happen since we are checking it while calling the function
    if ( empty($forum_ids) ) {
        return 0;
    } else {
        $where_sql = ' AND p.forum_id IN (' . implode(',', $forum_ids) . ')';
    }
    // get the number of open reports for all the forums the user is a moderator
    $sql = "SELECT COUNT(pr.report_id) as total
            FROM (" . POST_REPORTS_TABLE . " pr, " . POSTS_TABLE . " p)
            WHERE pr.report_status = " . intval($status) . "
            AND pr.post_id = p.post_id
            " . $where_sql;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not get reports count', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    return ( $row['total'] ) ? $row['total'] : 0;
}

// check if a post has already been reported
function report_exists($post_id) {
    global $db;
    // maybe we have to check if the report is closed too in order to reopen it after the 2nd report
    $sql = "SELECT report_id FROM " . POST_REPORTS_TABLE . "
            WHERE post_id = $post_id
            AND report_status = " . REPORT_POST_NEW;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not get report', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    return ( $row ) ? TRUE : FALSE;
}

// get the already stored report comments
function get_report_comments($report_id) {
    global $db;

    $sql = "SELECT last_action_comments FROM " . POST_REPORTS_TABLE . "
            WHERE report_id = " . $report_id;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not get report comments', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    return ( $row['last_action_comments'] && $row['last_action_comments'] != '' ) ? $row['last_action_comments'] : '';
}

// get the forums where the user is a moderator
function get_forums_auth_mod() {
    global $userdata;

    $auth = auth(AUTH_MOD, AUTH_LIST_ALL, $userdata);
    // create an array to store the moderated forums
    $forums_auth = array();
    while ( list($forum) = each($auth) ) {
        if ( $auth[$forum]['auth_mod'] ) {
            $forums_auth[] = $forum;
        }
    }
    return $forums_auth;
}

// create the comments from the reports
function create_comments($row) {
    global $db, $board_config, $lang;

    // find if we have a last action user_id and last action time
    if ( $row['last_action_user_id'] != 0 && $row['last_action_time'] != 0 ) {
        $sql2 = "SELECT username FROM " . USERS_TABLE . "
                WHERE user_id = " . $row['last_action_user_id'];
        if ( !($result2 = $db->sql_query($sql2)) ) {
            message_die(GENERAL_ERROR, 'Could not get last action user id information', '', __LINE__, __FILE__, $sql2);
        }
        $row2 = $db->sql_fetchrow($result2);
        $db->sql_freeresult($result2);
        $last_action_user = '<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['last_action_user_id'] . '">' . UsernameColor($row2['username']) . '</a>';
        $last_action_date = formatTimestamp($row['last_action_time']);
        if ( $row['report_status'] == REPORT_POST_NEW ) {
            $last_action = sprintf($lang['Opened_by_user_on_date'], $last_action_user, $last_action_date);
        } else {
            $last_action = sprintf($lang['Closed_by_user_on_date'], $last_action_user, $last_action_date);
        }
        $last_action_comments = $row['last_action_comments'];
    } else {
        $last_action = ( $row['report_status'] == REPORT_POST_NEW ) ? $lang['Opened'] : $lang['Closed'];
        $last_action_comments = '';
    }
    // replace "\n" with "\n<br />\n" for correct html output on browser
    $comments = str_replace("\n", "\n<br />\n", $row['report_comments']);
    $last_action_comments = str_replace("\n", "\n<br />\n", $last_action_comments);
    $comments_temp = array(
        'last_action' => $last_action,
        'comments'    => $comments,
        'last_action_comments' => $last_action_comments
    );
    return $comments_temp;
}

// find which reports have their posts non-existent
function get_reports_with_no_posts() {
    global $db;

    $sql = "SELECT pr.post_id FROM " . POST_REPORTS_TABLE . ' pr, ' . POSTS_TABLE . " p
            WHERE pr.post_id = p.post_id";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not query reports', '', __LINE__, __FILE__, $sql);
    }
    // create an array with all the common post_ids of the reports and posts table
    $common_post_ids = array();
    while( $row = $db->sql_fetchrow($result) )  {
        $common_post_ids[] = $row['post_id'];
    }
    $db->sql_freeresult($result);
    // get all the post_ids from the reports table
    $sql = "SELECT report_id, post_id
            FROM " . POST_REPORTS_TABLE ;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not query reports', '', __LINE__, __FILE__, $sql);
    }
    // find which reports exist in the reports table but do not exist in the posts table
    $delete_ids = array();
    while( $row = $db->sql_fetchrow($result) ) {
        if ( !in_array($row['post_id'], $common_post_ids) ) {
            $delete_ids[] = $row['report_id'];
        }
    }
    $db->sql_freeresult($result);
    return $delete_ids;
}

?>