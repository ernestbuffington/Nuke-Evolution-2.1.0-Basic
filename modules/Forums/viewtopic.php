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
 Nuke-Evo Author        :       ReOrGaNiSatiOn

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

global $_GETVAR, $currentlang, $board_config, $userdata;
define('IN_PHPBB', TRUE);

$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ( (!(isset($popup)) OR ($popup == '1')) && ($_GETVAR->get('printertopic', 'request', 'string', NULL) != 1) ) {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
}else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

include($phpbb_root_path . 'common.php');
include_once(NUKE_INCLUDE_DIR . 'functions_post.php');
include_once(NUKE_INCLUDE_DIR . 'bbcode.php');
include_once($phpbb_root_path . 'post_icon_mod/includes/def_icons.php');

//
// Start initial var setup
//
$topic_id       = $_GETVAR->get(POST_TOPIC_URL, 'request', 'int', NULL) ? $_GETVAR->get(POST_TOPIC_URL, 'request', 'int') : ( $_GETVAR->get('topic', 'request', 'int', NULL) ? $_GETVAR->get('topic', 'request', 'int') : NULL);
$reply_topic_id = $topic_id;
$post_id        = $_GETVAR->get(POST_POST_URL, 'request', 'int', NULL) ? $_GETVAR->get(POST_POST_URL, 'request', 'int') : 0;
$start          = $_GETVAR->get('start', 'request', 'int', 0);
$start          = ($start < 1) ? 1 : $start;
$printertopic   = $_GETVAR->get('printertopic', 'request', 'string', NULL);
$view           = $_GETVAR->get('view', 'request', 'string', NULL);

if( $printertopic == '1' ) {
    $start_temp = $_GETVAR->get('start_rel', 'request', 'int', 0);
    $start = (($start_temp <= 1 ) ? 0 : ($start_temp - 1));
    $sql_finish = $board_config['posts_per_page'];
    $finish_temp = $_GETVAR->get('finish_rel', 'request', 'int', 1);
    if ( ($finish_temp < 1) || ($finish_temp - $start < 0) || $finish_temp < $start_temp) {
        $sql_finish = $board_config['posts_per_page'];
        $finish = $start + $board_config['posts_per_page'];
    } elseif ($finish_temp == $start_temp) {
        $sql_finish = 1;
        $finish = $finish_temp;
    } elseif (($finish_temp - $start_temp) <= 0) {
        $sql_finish = $board_config['posts_per_page'];
        $finish = $start + $board_config['posts_per_page'];
    } else {
        $sql_finish = ($finish_temp - $start_temp)+1;
        $finish = $finish_temp;
    }
}

if (!$topic_id && !$post_id) {
        message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

// Start session management
$userdata = session_pagestart($user_ip, PAGE_TOPICS);
init_userprefs($userdata);
// End session management

// Find topic id if user requested a newer
// or older topic
if ( $view  && ($post_id == 0) && ($topic_id != 0) ) {
    if ( $view == 'newest' ) {
        if ( is_user() ) {
            $tracking_topics =  evo_getcookie($board_config['cookie_name'] . '_t')  ? unserialize(evo_getcookie($board_config['cookie_name'] . '_t')) : array();
            $tracking_forums =  evo_getcookie($board_config['cookie_name'] . '_f')  ? unserialize(evo_getcookie($board_config['cookie_name'] . '_f')) : array();
            if ( !empty($tracking_topics[$topic_id]) && !empty($tracking_forums[$forum_id]) ) {
                $topic_last_read = ( $tracking_topics[$topic_id] > $tracking_forums[$forum_id] ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
            } else if ( !empty($tracking_topics[$topic_id]) || !empty($tracking_forums[$forum_id]) ) {
                $topic_last_read = ( !empty($tracking_topics[$topic_id]) ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
            } else {
                $topic_last_read = 'u.user_lastvisit';
            }

            $sql = "SELECT p.post_id, p.post_time
                    FROM (" . POSTS_TABLE . " p, " . _SESSION_TABLE . " s,  " . USERS_TABLE . " u)
                    WHERE u.username = s.uname
                    AND s.uname = '".$userdata['username']."'
                    AND p.topic_id = " . intval($topic_id) . "
                    AND p.post_time >= " . $topic_last_read . "
                    LIMIT 1";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
            }
            if ( !($row = $db->sql_fetchrow($result)) ) {
                $sql = "SELECT topic_last_post_id as post_id FROM " . TOPICS_TABLE . " WHERE topic_id = " . intval($topic_id);
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
                }
                if ( !($row = $db->sql_fetchrow($result)) ) {
                    message_die(GENERAL_MESSAGE, 'No_new_posts_last_visit');
                }
            }
            $post_id = $row['post_id'];
            redirect(append_sid('viewtopic.php?' . POST_POST_URL . '=' . $post_id . '#' . $post_id, TRUE));
        }
    } else if ( $view == 'next' || $view == 'previous' ) {
        $sql_condition = ( $view == 'next' ) ? '>' : '<';
        $sql_ordering  = ( $view == 'next' ) ? 'ASC' : 'DESC';

        $sql = "SELECT t.topic_id
                FROM (" . TOPICS_TABLE . " t, " . TOPICS_TABLE . " t2)
                WHERE t2.topic_id = '$topic_id'
                AND t.forum_id = t2.forum_id
                AND t.topic_moved_id = 0
                AND t.topic_last_post_id $sql_condition t2.topic_last_post_id
                ORDER BY t.topic_last_post_id $sql_ordering
                LIMIT 1";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, "Could not obtain newer/older topic information", '', __LINE__, __FILE__, $sql);
        }
        if ( $row = $db->sql_fetchrow($result) ) {
            $topic_id = intval($row['topic_id']);
            redirect(append_sid('viewtopic.php?' . POST_TOPIC_URL . '=' . $topic_id, TRUE));
        } else {
            $message = ( $view == 'next' ) ? 'No_newer_topics' : 'No_older_topics';
            message_die(GENERAL_MESSAGE, $message);
        }
    }
}

//
// This rather complex gaggle of code handles querying for topics but
// also allows for direct linking to a post (and the calculation of which
// page the post is on and the correct display of viewtopic)
//
$join_sql_table = (!$post_id) ? '' : ", " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2 ";
$join_sql = (!$post_id) ? "t.topic_id = '$topic_id'" : "p.post_id = '$post_id' AND t.topic_id = p.topic_id AND p2.topic_id = p.topic_id AND p2.post_id <= '$post_id'";
$count_sql = (!$post_id) ? '' : ", COUNT(p2.post_id) AS prev_posts";
$order_sql = (!$post_id) ? '' : "GROUP BY p.post_id, t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments ORDER BY p.post_id ASC";
$sql = "SELECT t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments" . $count_sql . "
        FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $join_sql_table . "
        WHERE $join_sql
        AND f.forum_id = t.forum_id
        $order_sql";
attach_setup_viewtopic_auth($order_sql, $sql);
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, "Could not obtain topic information", '', __LINE__, __FILE__, $sql);
}
if ( !($forum_topic_data = $db->sql_fetchrow($result)) ) {
    message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

$forum_id = intval($forum_topic_data['forum_id']);

if(!@file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_printertopic.php'))) {
    include_once($phpbb_root_path . 'language/lang_english/lang_printertopic.php');
} else {
    include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_printertopic.php');
}

// Start auth check
$is_auth = array();
$is_auth = $tree['auth'][POST_FORUM_URL . $forum_id];

if( !$is_auth['auth_view'] || !$is_auth['auth_read'] ) {
    if ( !is_user() ) {
        $redirect = ($post_id) ? POST_POST_URL . "=$post_id" : POST_TOPIC_URL . "=$topic_id";
        $redirect .= ($start) ? "&amp;start=$start" : '';
        redirect('modules.php?name=Your_Account&amp;redirect=viewtopic&amp;'.$redirect, TRUE);
        exit;
    }
    $message = sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
    message_die(GENERAL_MESSAGE, $message);
}
// End auth check

$forum_name  = get_object_lang(POST_FORUM_URL . $forum_topic_data['forum_id'], 'name');
$topic_title = $forum_topic_data['topic_title'];
$topic_id    = intval($forum_topic_data['topic_id']);
$reply_topic_id = $topic_id;
$topic_time  = $forum_topic_data['topic_time'];

if ($post_id) {
    $start = floor(($forum_topic_data['prev_posts'] -1) / intval($board_config['posts_per_page'])) * intval($board_config['posts_per_page']);
}

// Is user watching this thread?
if( is_user() ) {
    if ( $_GETVAR->get('report', 'request', 'string', NULL) ) {
        include_once(NUKE_INCLUDE_DIR . 'functions_report.php');
        $comments = htmlspecialchars(trim($_GETVAR->get('comments', 'post', 'string', '')));
        if ( empty($comments) ) {
            // show form to add comments about topic
            $page_title = $lang['Report_post'] . ' - ' . $topic_title;
            include_once(NUKE_INCLUDE_DIR . 'page_header.php');
            $template->set_filenames(array(
                'body' => 'report_post.tpl')
            );

            $template->assign_vars(array(
                'TOPIC_TITLE'           => $topic_title,
                'POST_ID'               => $post_id,
                'U_VIEW_TOPIC'          => append_sid('viewtopic.php?report=TRUE&amp;' . POST_TOPIC_URL . '=' . $topic_id),
                'L_SEE_FAQ_MORE_HELP'   => $lang['printertopic_see_faq_more_help'],
                'L_REPORT_POST'         => $lang['Report_post'],
                'L_COMMENTS'            => $lang['Comments'],
                'L_SUBMIT'              => $lang['Submit'],
                'S_ACTION'              => append_sid('viewtopic.php?report=TRUE&amp;' . POST_POST_URL . '=' . $post_id))
            );

            $template->pparse('body');
            include_once(NUKE_INCLUDE_DIR . 'page_tail.php');
            exit;
        } else {
            if ( !report_flood() ) {
                message_die(GENERAL_MESSAGE, $lang['Flood_Error']);
            }
            // insert the report
            insert_report($post_id, $comments);
            // email the report if need to
            if ( $board_config['report_email'] ) {
                email_report($forum_id, $post_id, $topic_title, $comments);
            }

            $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id") . '" />')
            );
            $message =  $lang['Post_reported'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
            message_die(GENERAL_MESSAGE, $message);
        }
    }
    $can_watch_topic = TRUE;

    $sql = "SELECT notify_status
            FROM " . TOPICS_WATCH_TABLE . "
            WHERE topic_id = '$topic_id'
            AND user_id = " . $userdata['user_id'];
    if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, "Could not obtain topic watch information", '', __LINE__, __FILE__, $sql);
    }

    if ( $row = $db->sql_fetchrow($result) ) {
        if ( $_GETVAR->get('unwatch', 'get', 'string', NULL) ) {
            if ( $_GETVAR->get('unwatch', 'get', 'string') == 'topic' ) {
                $is_watching_topic = 0;
                $sql_priority = (SQL_LAYER == "mysql" || SQL_LAYER == "mysqli") ? "LOW_PRIORITY" : '';
                $sql = "DELETE $sql_priority FROM " . TOPICS_WATCH_TABLE . "
                        WHERE topic_id = '$topic_id'
                        AND user_id = " . $userdata['user_id'];
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Could not delete topic watch information", '', __LINE__, __FILE__, $sql);
                }
            }
            $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '" />')
                 );
            $message = $lang['No_longer_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
            message_die(GENERAL_MESSAGE, $message);
        }else {
            $is_watching_topic = TRUE;
            if ( $row['notify_status'] ) {
                    $sql_priority = (SQL_LAYER == "mysql" || SQL_LAYER == "mysqli") ? "LOW_PRIORITY" : '';
                    $sql = "UPDATE $sql_priority " . TOPICS_WATCH_TABLE . "
                            SET notify_status = '0'
                            WHERE topic_id = '$topic_id'
                            AND user_id = " . $userdata['user_id'];
                    if ( !($result = $db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, "Could not update topic watch information", '', __LINE__, __FILE__, $sql);
                    }
            }
        }
    } else {
        if ( $_GETVAR->get('watch', 'get', 'string', NULL) ) {
            if ( $_GETVAR->get('watch', 'get', 'string') == 'topic' ) {
                $is_watching_topic = TRUE;
                $sql_priority = (SQL_LAYER == "mysql" || SQL_LAYER == "mysqli") ? "LOW_PRIORITY" : '';
                $sql = "INSERT $sql_priority INTO " . TOPICS_WATCH_TABLE . " (user_id, topic_id, notify_status)
                        VALUES (" . $userdata['user_id'] . ", '$topic_id', '0')";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Could not insert topic watch information", '', __LINE__, __FILE__, $sql);
                }
            }
            $template->assign_vars(array(
               'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '" />')
             );
            $message = $lang['You_are_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
            message_die(GENERAL_MESSAGE, $message);
        } else {
            $is_watching_topic = 0;
        }
    }
} else {
    if ( $_GETVAR->get('unwatch', 'get', 'string', NULL) ) {
        if ( $_GETVAR->get('unwatch', 'get', 'string') == 'topic' ) {
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_GETVAR->get('SERVER_SOFTWARE', 'server', 'string', NULL)) ) ? 'Refresh: 0; URL=' : 'Location: ';
            redirect(append_sid('login.php?redirect=viewtopic.php&amp;' . POST_TOPIC_URL . '=' . $topic_id . '&amp;unwatch=topic', TRUE));
            exit;
        }
    } else {
        $can_watch_topic = 0;
        $is_watching_topic = 0;
    }
}

// Generate a 'Show posts in previous x days' select box. If the postdays var is POSTed
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if( $_GETVAR->get('postdays', 'request', 'int', NULL) ) {
    $post_days = $_GETVAR->get('postdays', 'request', 'int');
    $min_post_time = time() - (intval($post_days) * 86400);

    $sql = "SELECT COUNT(p.post_id) AS num_posts
            FROM (" . TOPICS_TABLE . " t, " . POSTS_TABLE . " p)
            WHERE t.topic_id = '$topic_id'
            AND p.topic_id = t.topic_id
            AND p.post_time >= '$min_post_time'";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Could not obtain limited topics count information", '', __LINE__, __FILE__, $sql);
    }

    $total_replies = ( $row = $db->sql_fetchrow($result) ) ? intval($row['num_posts']) : 0;
    $limit_posts_time = "AND p.post_time >= $min_post_time ";

    if ( $_GETVAR->get('postdays', 'post', 'int', NULL) ) {
        $start = 0;
    }
} else {
    $total_replies = intval($forum_topic_data['topic_replies']) + 1;
    $limit_posts_time = '';
    $post_days = 0;
}

$select_post_days = '<select name="postdays">';
for($i = 0; $i < count($previous_days); $i++) {
    $selected = ($post_days == $previous_days[$i]) ? ' selected="selected"' : '';
    $select_post_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_post_days .= '</select>';

//
// Decide how to order the post display
//
if ( $_GETVAR->get('postorder', 'request', 'string', NULL) ) {
    $post_order = htmlspecialchars($_GETVAR->get('postorder', 'request', 'string'));
    if (!preg_match("/^((asc)|(desc))$/",$post_order) ) {
        message_die(GENERAL_ERROR, 'Selected post order is not valid');
    }
    $post_time_order = ($post_order == "asc") ? "ASC" : "DESC";
} else {
    $post_order = 'asc';
    $post_time_order = 'ASC';
}

$select_post_order = '<select name="postorder">';
if ( $post_time_order == 'ASC' ) {
    $select_post_order .= '<option value="asc" selected="selected">' . $lang['Oldest_First'] . '</option><option value="desc">' . $lang['Newest_First'] . '</option>';
} else {
    $select_post_order .= '<option value="asc">' . $lang['Oldest_First'] . '</option><option value="desc" selected="selected">' . $lang['Newest_First'] . '</option>';
}
$select_post_order .= '</select>';

//
// Go ahead and pull all data for this topic
//
if (isset($topic_id) ) {
    $sql_limit =  "LIMIT ".($start > 1 ? $start : 0).",".(!empty($sql_finish)? $sql_finish : $board_config['posts_per_page']);
} else {
    $sql_limit = "LIMIT 0, ".$board_config['posts_per_page'];
}
$sql = "SELECT u.username, u.user_posts, u.user_active, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, u.user_allowsignature, u.user_allow_viewonline, u.user_session_time, u.user_id,
               p.enable_bbcode, p.enable_html, p.enable_sig, p.enable_smilies, p.forum_id, p.post_attachment, p.post_edit_count, p.post_edit_time, p.post_icon, p.post_id, p.post_move, p.post_time, p.post_username, p.poster_id, p.poster_ip, p.topic_id,
               pt.post_text, pt.post_subject, pt.bbcode_uid
        FROM (" . POSTS_TABLE . " AS p Left Outer Join " . USERS_TABLE . " AS u ON u.user_id = p.poster_id
                Inner Join " . POSTS_TEXT_TABLE . " AS pt ON p.post_id = pt.post_id)
        WHERE p.topic_id = '$topic_id'
        $limit_posts_time
        ORDER BY p.post_time $post_time_order
        ".$sql_limit;

if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, "Could not obtain post/user information.", '', __LINE__, __FILE__, $sql);
}
$postrow = array();
if ($row = $db->sql_fetchrow($result)) {
    do {
        $postrow[] = $row;
    } while ($row = $db->sql_fetchrow($result));
    $db->sql_freeresult($result);
   $total_posts = count($postrow);
} else {
   include_once(NUKE_INCLUDE_DIR . 'functions_admin.php');
   sync('topic', $topic_id);
   message_die(GENERAL_MESSAGE, $lang['No_posts_topic']);
}

$resync = FALSE;
if ($forum_topic_data['topic_replies'] + 1 < $start + count($postrow)) {
   $resync = TRUE;
} elseif ($start + $board_config['posts_per_page'] > $forum_topic_data['topic_replies']) {
   $row_id = intval($forum_topic_data['topic_replies']) % intval($board_config['posts_per_page']);
   if ($postrow[$row_id]['post_id'] != $forum_topic_data['topic_last_post_id'] || $start + count($postrow) < $forum_topic_data['topic_replies']) {
      $resync = TRUE;
   }
} elseif (count($postrow) < $board_config['posts_per_page']) {
   $resync = TRUE;
}

if ($resync) {
   include_once(NUKE_INCLUDE_DIR . 'functions_admin.php');
   sync('topic', $topic_id);

   $result = $db->sql_query('SELECT COUNT(post_id) AS total FROM ' . POSTS_TABLE . ' WHERE topic_id = ' . $topic_id);
   $row = $db->sql_fetchrow($result);
   $total_replies = $row['total'];
}

$sql = "SELECT *
        FROM " . RANKS_TABLE . "
        ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) ) {
   message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) ) {
    $ranksrow[] = $row;
}
$db->sql_freeresult($result);

// Censor topic title
$topic_title = check_words($topic_title);

// Was a highlight request part of the URI?
$highlight_match = $highlight = '';
if ( $_GETVAR->get('highlight', 'get', 'string', NULL) ) {
    // Split words and phrases
    $words = explode(' ', trim(htmlspecialchars($_GETVAR->get('highlight', 'get', 'string'))));

    for($i = 0; $i < count($words); $i++) {
        if (trim($words[$i]) != '') {
            $highlight_match .= (($highlight_match != '') ? '|' : '') . str_replace('*', '\w*', preg_quote($words[$i], '#'));
        }
    }
    unset($words);

    $highlight = urlencode($_GETVAR->get('highlight', 'get', 'string'));
    $highlight_match = phpbb_rtrim($highlight_match, "\\");
}

// Post, reply and other URL generation for
// templating vars
$printer_topic_url = append_sid('viewtopic.php?printertopic=1&amp;' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $start . '&amp;postdays=' . $post_days . '&amp;postorder=' . $post_order . '&amp;vote=viewresult');
$new_topic_url = append_sid('posting.php?mode=newtopic&amp;' . POST_FORUM_URL . '=' . $forum_id);
$reply_topic_url = append_sid('posting.php?mode=reply&amp;' . POST_TOPIC_URL . '=' . $topic_id);
$view_forum_url = append_sid('viewforum.php?' . POST_FORUM_URL . '=' . $forum_id);
$view_prev_topic_url = append_sid('viewtopic.php?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;view=previous');
$view_next_topic_url = append_sid('viewtopic.php?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;view=next');

// Mozilla navigation bar
$nav_links['prev'] = array(
    'url' => $view_prev_topic_url,
    'title' => $lang['View_previous_topic']
);
$nav_links['next'] = array(
    'url' => $view_next_topic_url,
    'title' => $lang['View_next_topic']
);
$nav_links['up'] = array(
    'url' => $view_forum_url,
    'title' => $forum_name
);

$reply_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $images['reply_locked'] : $images['reply_new'];
$reply_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['Reply_to_topic'];
$post_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'];
$post_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'];
$printer_img = $images['printer'];
$printer_alt = $lang['printertopic_button'];

//
// Set a cookie for this topic
//
if ( is_user() ) {
    $tracking_topics = evo_getcookie($board_config['cookie_name'] . '_t') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_t')) : array();
    $tracking_forums = evo_getcookie($board_config['cookie_name'] . '_f') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_f')) : array();

    if ( !empty($tracking_topics[$topic_id]) && !empty($tracking_forums[$forum_id]) ) {
        $topic_last_read = ( $tracking_topics[$topic_id] > $tracking_forums[$forum_id] ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
    } else if ( !empty($tracking_topics[$topic_id]) || !empty($tracking_forums[$forum_id]) ) {
        $topic_last_read = ( !empty($tracking_topics[$topic_id]) ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
    } else {
        $topic_last_read = $userdata['user_lastvisit'];
    }
    if ( count($tracking_topics) >= 600 && empty($tracking_topics[$topic_id]) ) {
        asort($tracking_topics);
        unset($tracking_topics[key($tracking_topics)]);
    }
    $tracking_topics[$topic_id] = time();
    evo_setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 2592000);
}

// Load templates
if( $printertopic ) {
    $template->set_filenames(array(
       'body' => 'printertopic_body.tpl')
    );
} else {
   $template->set_filenames(array(
       'qrbody' => 'viewtopic_quickreply.tpl',
       'body' => 'viewtopic_body.tpl')
   );
   make_jumpbox('viewforum.php', $forum_id);
}

// Output page header
$page_title = $lang['View_topic'] .' - ' . $topic_title;
if( $printertopic == '1' ) {
    include_once(NUKE_INCLUDE_DIR . 'page_header_printer.php');
} else {
    include_once(NUKE_INCLUDE_DIR . 'page_header.php');
}
$topic_title = ($board_config['smilies_in_titles']) ? smilies_pass($topic_title) : $topic_title;

// User authorisation levels output
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';

attach_build_auth_levels($is_auth, $s_auth_can);

$topic_mod = '';

if ( $is_auth['auth_mod'] ) {
    $s_auth_can .= sprintf($lang['Rules_moderate'], '<a href="' . append_sid("modcp.php?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
    $topic_mod .= '<a href="' . append_sid("modcp.php?" . POST_TOPIC_URL . "=$topic_id&amp;mode=delete") . '"><img src="' . $images['topic_mod_delete'] . '" alt="' . $lang['Delete_topic'] . '" title="' . $lang['Delete_topic'] . '" border="0" /></a>&nbsp;';
    $topic_mod .= '<a href="' . append_sid("modcp.php?" . POST_TOPIC_URL . "=$topic_id&amp;mode=move"). '"><img src="' . $images['topic_mod_move'] . '" alt="' . $lang['Move_topic'] . '" title="' . $lang['Move_topic'] . '" border="0" /></a>&nbsp;';
    $topic_mod .= ( $forum_topic_data['topic_status'] == TOPIC_UNLOCKED ) ? '<a href="' . append_sid("modcp.php?" . POST_TOPIC_URL . "=$topic_id&amp;mode=lock") . '"><img src="' . $images['topic_mod_lock'] . '" alt="' . $lang['Lock_topic'] . '" title="' . $lang['Lock_topic'] . '" border="0" /></a>&nbsp;' : '<a href="' . append_sid("modcp.php?" . POST_TOPIC_URL . "=$topic_id&amp;mode=unlock") . '"><img src="' . $images['topic_mod_unlock'] . '" alt="' . $lang['Unlock_topic'] . '" title="' . $lang['Unlock_topic'] . '" border="0" /></a>&nbsp;';
    $topic_mod .= '<a href="' . append_sid("modcp.php?" . POST_TOPIC_URL . "=$topic_id&amp;mode=split") . '"><img src="' . $images['topic_mod_split'] . '" alt="' . $lang['Split_topic'] . '" title="' . $lang['Split_topic'] . '" border="0" /></a>&nbsp;';
    $topic_mod .= '<a href="' . append_sid("merge.php?" . POST_TOPIC_URL . '=' . $topic_id) . '"><img src="' . $images['topic_mod_merge'] . '" alt="' . $lang['Merge_topics'] . '" title="' . $lang['Merge_topics'] . '" border="0" /></a>&nbsp;';
}

// Topic watch information
$s_watching_topic = '';
$s_watching_topic_img = '';
if ( $can_watch_topic ) {
    if ( $is_watching_topic ) {
        $s_watching_topic = '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;unwatch=topic&amp;start=$start") . '">' . $lang['Stop_watching_topic'] . '</a>';
        $s_watching_topic_img = ( isset($images['Topic_un_watch']) ) ? '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;unwatch=topic&amp;start=$start") . '"><img src="' . $images['Topic_un_watch'] . '" alt="' . $lang['Stop_watching_topic'] . '" title="' . $lang['Stop_watching_topic'] . '" border="0"></a>' : '';
    } else {
        $s_watching_topic = '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;watch=topic&amp;start=$start") . '">' . $lang['Start_watching_topic'] . '</a>';
        $s_watching_topic_img = ( isset($images['Topic_watch']) ) ? '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;watch=topic&amp;start=$start") . '"><img src="' . $images['Topic_watch'] . '" alt="' . $lang['Stop_watching_topic'] . '" title="' . $lang['Start_watching_topic'] . '" border="0"></a>' : '';
    }
}

// If we've got a hightlight set pass it on to pagination,
// I get annoyed when I lose my highlight after the first page.
if( $printertopic == '1' ) {
    $pagination_printertopic = "printertopic=1&amp;";
}
if(!empty($highlight)) {
    $pagination_highlight = "highlight=$highlight&amp;";
}
$pagination_ppp = $board_config['posts_per_page'];
if(isset($finish)) {
    $pagination_finish_rel = "finish_rel=". $pagination_ppp. "&amp";
} else {
    $finish = '';
}

$pagination_printertopic = (isset($pagination_printertopic)) ? $pagination_printertopic : '';
$pagination_highlight = (isset($pagination_highlight)) ? $pagination_highlight : '';
$pagination_finish_rel = (isset($pagination_finish_rel)) ? $pagination_finish_rel : '';
$pagination = generate_pagination("viewtopic&amp;". $pagination_printertopic . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;". $pagination_highlight . $pagination_finish_rel, $total_replies, $pagination_ppp, $start);
if($pagination != '' && !empty($pagination_printertopic)) {
    $pagination .= " &nbsp;<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;". $pagination_printertopic. POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;". $pagination_highlight. "start=0&amp;finish_rel=-10000\" title=\"" . $lang['printertopic_cancel_pagination_desc'] . "\">:|&nbsp;|:</a>";
}

// Send vars to template
$template->assign_vars(array(
        'START_REL'             => $start +1,
        'FINISH_REL'            => $finish,
        'FORUM_ID'              => $forum_id,
        'FORUM_NAME'            => $forum_name,
        'TOPIC_ID'              => $topic_id,
        'TOPIC_TITLE'           => $topic_title,
        'PAGINATION'            => str_replace('&amp;&amp;', '&amp;', $pagination),
        'PAGE_NUMBER'           => sprintf($lang['Page_of'], ( floor( $start / $pagination_ppp ) + 1 ), ceil( $total_replies / $pagination_ppp )),
        'POST_IMG'              => $post_img,
        'REPLY_IMG'             => $reply_img,
        'PRINTER_IMG'           => $printer_img,
        'L_AUTHOR'              => $lang['Author'],
        'L_MESSAGE'             => $lang['Message'],
        'L_POSTED'              => $lang['Posted'],
        'L_POST_SUBJECT'        => $lang['Post_subject'],
        'L_VIEW_NEXT_TOPIC'     => $lang['View_next_topic'],
        'L_VIEW_PREVIOUS_TOPIC' => $lang['View_previous_topic'],
        'L_POST_NEW_TOPIC'      => $post_alt,
        'L_POST_REPLY_TOPIC'    => $reply_alt,
        'L_PRINTER_TOPIC'       => $printer_alt,
        'L_BACK_TO_TOP'         => $lang['Back_to_top'],
        'L_DISPLAY_POSTS'       => $lang['Display_posts'],
        'L_LOCK_TOPIC'          => $lang['Lock_topic'],
        'L_UNLOCK_TOPIC'        => $lang['Unlock_topic'],
        'L_MOVE_TOPIC'          => $lang['Move_topic'],
        'L_SPLIT_TOPIC'         => $lang['Split_topic'],
        'L_DELETE_TOPIC'        => $lang['Delete_topic'],
        'L_GOTO_PAGE'           => $lang['Goto_page'],
        'L_PRINT_CLOSE'         => $lang['Close'],
        'L_SEE_FAQ_MORE_HELP'   => $lang['printertopic_see_faq_more_help'],
        'S_TOPIC_LINK'          => POST_TOPIC_URL,
        'S_SELECT_POST_DAYS'    => $select_post_days,
        'S_SELECT_POST_ORDER'   => $select_post_order,
        'S_POST_DAYS_ACTION'    => append_sid('viewtopic.php?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $start),
        'S_AUTH_LIST'           => $s_auth_can,
        'S_TOPIC_ADMIN'         => $topic_mod,
        'S_WATCH_TOPIC'         => $s_watching_topic,
        'S_WATCH_TOPIC_IMG'     => $s_watching_topic_img,
        'U_VIEW_TOPIC'          => append_sid('viewtopic.php?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $start . '&amp;postdays=' . $post_days . '&amp;postorder=' . $post_order . '&amp;highlight=' . $highlight),
        'U_VIEW_FORUM'          => $view_forum_url,
        'U_VIEW_OLDER_TOPIC'    => $view_prev_topic_url,
        'U_VIEW_NEWER_TOPIC'    => $view_next_topic_url,
        'U_POST_NEW_TOPIC'      => $new_topic_url,
        'U_PRINTER_TOPIC'       => $printer_topic_url,
        'U_POST_REPLY_TOPIC'    => $reply_topic_url)
);
// Does this topic contain a poll?
if ( !empty($forum_topic_data['topic_vote']) ) {
        /*--FNA #1--*/
    $s_hidden_fields = '';
    $sql = "SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vd.poll_view_toggle, vr.vote_option_id, vr.vote_option_text, vr.vote_result
            FROM (" . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr)
            WHERE vd.topic_id = '$topic_id'
            AND vr.vote_id = vd.vote_id
            ORDER BY vr.vote_option_id ASC";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Could not obtain vote data for this topic", '', __LINE__, __FILE__, $sql);
    }
    if ( $vote_info = $db->sql_fetchrowset($result) ) {
        $db->sql_freeresult($result);
        $vote_options = count($vote_info);
        $vote_id = $vote_info[0]['vote_id'];
        $vote_title = smilies_pass($vote_info[0]['vote_text']);
        $poll_view_toggle = $vote_info[0]['poll_view_toggle'];
        $sql = "SELECT vote_id
                FROM " . VOTE_USERS_TABLE . "
                WHERE vote_id = '$vote_id'
                AND vote_user_id = " . intval($userdata['user_id']);
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, "Could not obtain user vote data for this topic", '', __LINE__, __FILE__, $sql);
        }
        $user_voted = ( $row = $db->sql_fetchrow($result) ) ? TRUE : 0;
        $db->sql_freeresult($result);
        if ( $_GETVAR->get('vote', 'request', 'string', NULL) ) {
           $view_result = ( $_GETVAR->get('vote', 'request', 'string') == 'viewresult' ) ? TRUE : 0;
        } else {
           $view_result = 0;
        }
        $poll_expired = ( $vote_info[0]['vote_length'] ) ? ( ( $vote_info[0]['vote_start'] + $vote_info[0]['vote_length'] < time() ) ? TRUE : 0 ) : 0;
        if ( $user_voted || $view_result || $poll_expired || !$is_auth['auth_vote'] || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) {
            //If poll is over, allow results to be viewed by all.
            if (!$user_voted && !$poll_view_toggle && $view_result && !$poll_expired) {
                message_die(GENERAL_ERROR, $lang['must_first_vote']);
            }
            $template->set_filenames(array(
                    'pollbox' => 'viewtopic_poll_result.tpl')
            );
            $vote_results_sum = 0;
            for($i = 0; $i < $vote_options; $i++) {
                $vote_results_sum += $vote_info[$i]['vote_result'];
            }
            $vote_graphic = 0;
            $vote_graphic_max = count($images['voting_graphic']);
            for($i = 0; $i < $vote_options; $i++) {
                $vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
                $vote_graphic_length = round($vote_percent * $board_config['vote_graphic_length']);
                $vote_graphic_img = $images['voting_graphic'][$vote_graphic];
                $vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;
                $vote_info[$i]['vote_option_text'] = check_words($vote_info[$i]['vote_option_text']);
                $template->assign_block_vars("poll_option", array(
                    'POLL_OPTION_CAPTION'   => smilies_pass($vote_info[$i]['vote_option_text']),
                    'POLL_OPTION_RESULT'    => $vote_info[$i]['vote_result'],
                    'POLL_OPTION_PERCENT'   => sprintf("%.1d%%", ($vote_percent * 100)),
                    'VOTING_LCAP_IMG'       => $images['voting_lcap'],
                    'VOTING_RCAP_IMG'       => $images['voting_rcap'],
                    'POLL_OPTION_IMG'       => $vote_graphic_img,
                    'POLL_OPTION_IMG_WIDTH' => $vote_graphic_length)
                );
            }

            $template->assign_vars(array(
                'L_TOTAL_VOTES' => $lang['Total_votes'],
                'TOTAL_VOTES'   => $vote_results_sum)
            );
        } else {
            $template->set_filenames(array(
                'pollbox' => 'viewtopic_poll_ballot.tpl')
            );
            for($i = 0; $i < $vote_options; $i++) {
                $vote_info[$i]['vote_option_text'] = check_words($vote_info[$i]['vote_option_text']);
                $template->assign_block_vars("poll_option", array(
                    'POLL_OPTION_ID'      => $vote_info[$i]['vote_option_id'],
                    'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'])
                );
            }
            $template->assign_vars(array(
                'L_SUBMIT_VOTE'  => $lang['Submit_vote'],
                'L_VIEW_RESULTS' => (!$user_voted && $poll_view_toggle) ? $lang['View_results'] : '',
                'U_VIEW_RESULTS' => append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;vote=viewresult"))
            );
            $s_hidden_fields = '<input type="hidden" name="topic_id" value="' . $topic_id . '" /><input type="hidden" name="mode" value="vote" />';
        }
        $vote_title = check_words($vote_title);
        $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
        $template->assign_vars(array(
            'POLL_QUESTION'   => $vote_title,
            'S_HIDDEN_FIELDS' => $s_hidden_fields,
            'S_POLL_ACTION'   => append_sid("posting.php?mode=vote&amp;" . POST_TOPIC_URL . "=$topic_id"))
        );

        $template->assign_var_from_handle('POLL_DISPLAY', 'pollbox');
    }
}

init_display_post_attachments($forum_topic_data['topic_attachment']);

//
// Update the topic view counter
//
$sql = "UPDATE " . TOPICS_TABLE . "
        SET topic_views = topic_views + 1
        WHERE topic_id = '$topic_id'";
if ( !$db->sql_query($sql) ) {
    message_die(GENERAL_ERROR, "Could not update topic views.", '', __LINE__, __FILE__, $sql);
}

$sqr_last_page = ((floor( $start / intval($board_config['posts_per_page']) ) + 1 ) == ceil( $total_replies / intval($board_config['posts_per_page'])));
if ( is_user() ) {
    $sqr_user_display = (bool)( ($userdata['user_show_quickreply'] == 2) ? $sqr_last_page : $userdata['user_show_quickreply'] );
} else {
    $sqr_user_display = (bool)( ($board_config['anonymous_show_sqr'] == 2) ? $sqr_last_page : $board_config['anonymous_show_sqr'] );
}

if ( $board_config['allow_quickreply'] && $sqr_user_display && (($forum_topic_data['forum_status'] != FORUM_LOCKED) || $is_auth['auth_mod'] ) && ( ($forum_topic_data['topic_status'] != TOPIC_LOCKED) || $is_auth['auth_mod'] ) ) {
    $show_qr_form =    TRUE;
} else {
    $show_qr_form =    FALSE;
}

// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
$already_processed = array();
for($i = 0; $i < $total_posts; $i++) {
    $leave_out['show_sig_once'] = FALSE;
    $leave_out['show_avatar_once'] = FALSE;
    $leave_out['show_rank_once'] = FALSE;
    $leave_out['main'] = FALSE;
    if( $postrow[$i]['user_id'] != ANONYMOUS ) {
        reset($already_processed);
        while( list(, $v) = each($already_processed) ) {
            if( $v == $postrow[$i]['user_id'] ) {
                // We've already processed a post by this user on this page
                $leave_out['show_sig_once'] = $board_config['show_sig_once'];
                $leave_out['show_avatar_once'] = $board_config['show_avatar_once'];
                $leave_out['show_rank_once'] = $board_config['show_rank_once'];
                $leave_out['main'] = TRUE;
                continue 1;
            }
        }
        if( !$leave_out['main'] ) {
            // We're about to process the first post by a user on this page
            $already_processed[] = $postrow[$i]['user_id'];
        }
    }
    $poster_id = $postrow[$i]['user_id'];
    $poster = ( $poster_id == ANONYMOUS || $postrow[$i]['user_active'] < 1) ? $lang['Guest'] : $postrow[$i]['username'];
    $post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);
    $poster_posts = ( $postrow[$i]['user_id'] != ANONYMOUS && $postrow[$i]['user_active'] > 0) ? $lang['Posts'] . ': ' . $postrow[$i]['user_posts'] : '';
    $poster_from = ( $postrow[$i]['user_from'] && $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $postrow[$i]['user_from'] : '';
    $poster_from = preg_replace("/.gif/", "", $poster_from);
    $poster_joined = ( $postrow[$i]['user_id'] != ANONYMOUS && $postrow[$i]['user_active'] > 0) ? $lang['Joined'] . ': ' . formatTimestamp(strtotime(substr($postrow[$i]['user_regdate'], 4,2).' '.substr($postrow[$i]['user_regdate'], 0,3).' '.substr($postrow[$i]['user_regdate'], 8,4)), '', '1') : '';
    $poster_xd = ( $postrow[$i]['user_id'] != ANONYMOUS && $postrow[$i]['user_active'] > 0 ) ? get_user_xdata($postrow[$i]['user_id']) : array();
    $poster_avatar = GetAvatar($poster_id);
    // Define the little post icon
    if ( $userdata['session_logged_in'] && $postrow[$i]['post_time'] > $userdata['user_lastvisit'] && $postrow[$i]['post_time'] > $topic_last_read ) {
        $mini_post_img = $images['icon_minipost_new'];
        $mini_post_alt = $lang['New_post'];
    } else {
        $mini_post_img = $images['icon_minipost'];
        $mini_post_alt = $lang['Post'];
    }
    $mini_post_url = append_sid("viewtopic.php?" . POST_POST_URL . '=' . $postrow[$i]['post_id']) . '#' . $postrow[$i]['post_id'];
    // Generate ranks, set them to empty string initially.
    $poster_rank = '';
    $rank_image = '';
    if ( $postrow[$i]['user_id'] == ANONYMOUS || $postrow[$i]['user_active'] < 1 || $leave_out['show_rank_once']) {
        // Do nothing
    } else if ( $postrow[$i]['user_rank'] ) {
        for($j = 0; $j < count($ranksrow); $j++) {
            if ( $postrow[$i]['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] ) {
                $poster_rank = $ranksrow[$j]['rank_title'];
                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
            }
        }
    } else {
        for($j = 0; $j < count($ranksrow); $j++) {
            if ( $postrow[$i]['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] ) {
                $poster_rank = $ranksrow[$j]['rank_title'];
                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
            }
        }
    }
    // Handle anon users posting with usernames
    if ( $poster_id == ANONYMOUS && !empty($postrow[$i]['post_username']) ) {
        $poster = $postrow[$i]['post_username'];
        $poster_rank = $lang['Guest'];
    }
    $temp_url = '';
    if ( $poster_id != ANONYMOUS  && $postrow[$i]['user_active'] > 0) {
        $contact_img = EvoKernel_UserContactImg($postrow[$i]);
    } else {
        $contact_img = EvoKernel_UserContactImg(ANONYMOUS);
    }
    $temp_url = append_sid("posting.php?mode=quote&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
    $quote_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_quote'] . '" alt="' . $lang['Reply_with_quote'] . '" title="' . $lang['Reply_with_quote'] . '" border="0" /></a>';
    $quote = '<a href="' . $temp_url . '">' . $lang['Reply_with_quote'] . '</a>';
    $temp_url = "modules.php?name=Search&search_author=" . urlencode($postrow[$i]['username'] . "&amp;showresults=posts");
    $search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $postrow[$i]['username']) . '" title="' . sprintf($lang['Search_user_posts'], $postrow[$i]['username']) . '" border="0" /></a>';
    $search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $postrow[$i]['username']) . '</a>';
    if ( ( $userdata['user_id'] == $poster_id && $is_auth['auth_edit'] ) || $is_auth['auth_mod'] ) {
        $temp_url = append_sid("posting.php?mode=editpost&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
        $edit_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_edit'] . '" alt="' . $lang['Edit_delete_post'] . '" title="' . $lang['Edit_delete_post'] . '" border="0" /></a>';
        $edit = '<a href="' . $temp_url . '">' . $lang['Edit_delete_post'] . '</a>';
    } else {
        $edit_img = '';
        $edit = '';
    }
    if ( $is_auth['auth_mod'] ) {
        $temp_url = append_sid("modcp.php?mode=ip&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;" . POST_TOPIC_URL . "=" . $topic_id);
        $ip_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_ip'] . '" alt="' . $lang['View_IP'] . '" title="' . $lang['View_IP'] . '" border="0" /></a>';
        $ip = '<a href="' . $temp_url . '">' . $lang['View_IP'] . '</a>';
        $temp_url = append_sid("posting.php?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
        $delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
        $delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
    } else {
        $ip_img = '';
        $ip = '';
        if ( $userdata['user_id'] == $poster_id && $is_auth['auth_delete'] && $forum_topic_data['topic_last_post_id'] == $postrow[$i]['post_id'] ) {
            $temp_url = append_sid("posting.php?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
            $delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
            $delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
        } else {
            $delpost_img = '';
            $delpost = '';
        }
    }
    if ($board_config['smilies_in_titles']) {
        $post_subject = smilies_pass(( !empty($postrow[$i]['post_subject']) ) ? $postrow[$i]['post_subject'] : '');
    } else {
        $post_subject = ( !empty($postrow[$i]['post_subject']) ) ? $postrow[$i]['post_subject'] : '';
    }
    $message = $postrow[$i]['post_text'];
    $bbcode_uid = $postrow[$i]['bbcode_uid'];
    if($userdata['user_showsignatures']){
         $user_sig = ( $postrow[$i]['enable_sig'] && !empty($postrow[$i]['user_sig']) && $board_config['allow_sig'] && $postrow[$i]['user_allowsignature'] ) ? $postrow[$i]['user_sig'] : '';
    }
    $user_sig_bbcode_uid = $postrow[$i]['user_sig_bbcode_uid'];
    // Note! The order used for parsing the message _is_ important, moving things around could break any
    // output
    if( $leave_out['show_sig_once'] ) {
        $user_sig = "&nbsp;";   // Leaves out signature
        $user_sig_image = "&nbsp;"; // Leaves out sig image (for Signature panel)
    }
    if( $leave_out['show_rank_once'] ) {
        $poster_rank = "&nbsp;";    // Leaves out rank title
        $rank_image = "&nbsp;";   // Leaves out rank images
    }
    if( $leave_out['show_avatar_once'] ) {
        $poster_avatar = "&nbsp;";
    }
    // If the board has HTML off but the post has HTML
    // on then we process it, else leave it alone
    if ( !$board_config['allow_html'] || !$userdata['user_allowhtml']) {
        if ( !empty($user_sig) ) {
            $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
        }
        if ( $postrow[$i]['enable_html'] ) {
            $message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
        }
    }
    // Parse message and/or sig for BBCode if reqd
    if ($user_sig != '' && $user_sig_bbcode_uid != '') {
        $user_sig = ($board_config['allow_bbcode']) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid, FALSE) : preg_replace("/\:$user_sig_bbcode_uid/si", '', $user_sig);
    }
    if ($bbcode_uid != '') {
        $message = ($board_config['allow_bbcode']) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $message);
    }
    if ( !empty($user_sig) ) {
        $user_sig = make_clickable($user_sig);
    }
    $message = make_clickable($message);
        /*--FNA #2--*/
    // Parse smilies
    if ( $board_config['allow_smilies'] ) {
        if ( $postrow[$i]['user_allowsmile'] && !empty($user_sig) ) {
            $user_sig = smilies_pass($user_sig);
        }
        if ( $postrow[$i]['enable_smilies'] ) {
            $message = smilies_pass($message);
        }
    }
    // Highlight active words (primarily for search)
    if ($highlight_match) {
        // This has been back-ported from 3.0 CVS
        $message = preg_replace('#(?!<.*)(?<!\w)(' . $highlight_match . ')(?!\w|[^<>]*>)#i', '<span style="color:#'.$theme['fontcolor3'].'">\1</span>', $message);
    }
    // Replace naughty words
    $post_subject = check_words($post_subject);
    if (!empty($user_sig)) {
       $user_sig = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@check_words('\\0')", '>' . $user_sig . '<'), 1, -1));
    }
    $message = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@check_words('\\0')", '>' . $message . '<'), 1, -1));
    @reset($poster_xd);
    while ( list($code_name, ) = each($poster_xd) ) {
       $poster_xd[$code_name] = str_replace('\"', '"', substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "check_words('\\0')", '>' . $poster_xd[$code_name] . '<'), 1, -1));
    }
    // Replace newlines (we use this rather than nl2br because
    // till recently it wasn't XHTML compliant)
    if ( !empty($user_sig) ) {
        $user_sig = word_wrap_pass($user_sig);
        if ($board_config['sig_line'] == "<hr />" || $board_config['sig_line'] == "<hr />") {
            $user_sig = '<br />' . $board_config['sig_line']. str_replace("\n", "\n<br />\n", $user_sig);
        } else {
            $user_sig = $board_config['sig_line'].'<br />' . str_replace("\n", "\n<br />\n", $user_sig);
        }
    }
    $message = word_wrap_pass($message);
    $message = str_replace("\n", "\n<br />\n", $message);
    // Editing information
    if ( $postrow[$i]['post_edit_count'] ) {
        $l_edit_time_total = ( $postrow[$i]['post_edit_count'] == 1 ) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];
        $l_edited_by = '<br /><br />' . sprintf($l_edit_time_total, $poster, create_date($board_config['default_dateformat'], $postrow[$i]['post_edit_time'], $board_config['board_timezone']), $postrow[$i]['post_edit_count']);
    } else {
        $l_edited_by = '';
    }

    $post_subject = get_icon_title($postrow[$i]['post_icon']) . '&nbsp;' . $post_subject;
    $title_bbcodeuid = make_bbcode_uid();
    $post_subject = bbencode_second_pass(bbencode_first_pass($post_subject, $title_bbcodeuid), $title_bbcodeuid);
    // Again this will be handled by the templating
    // code at some point
    $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
    $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
    $xd_root = array();
    $xd_block = array();
    $xd_meta = get_xd_metadata();
    while ( list($code_name, $meta) = each($xd_meta) ) {
        if ( isset($poster_xd[$code_name]) ) {
            $value = $poster_xd[$code_name];
            if ( !$meta['allow_html'] ) {
                $value = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $value);
            }
            if ( $meta['allow_bbcode'] && $user_sig_bbcode_uid != '') {
                $value = bbencode_second_pass($value, $userdata['xdata_bbcode']);
            }
            if ($meta['allow_bbcode']) {
                $value = make_clickable($value);
            }
            if ( $meta['allow_smilies'] ) {
                $value = smilies_pass($value);
            }
            if ($meta['field_type'] == 'date') {
                $value = create_date($userdata['user_dateformat'], $value, $userdata['user_timezone']);
            }
            $value = str_replace("\n", "\n<br />\n", $value);
            if ( $meta['display_posting'] == XD_DISPLAY_ROOT && $meta['viewtopic']) {
                $xd_root[$code_name] = $value;
            } elseif ( $meta['display_posting'] == XD_DISPLAY_NORMAL && $meta['viewtopic']) {
                $xd_block[$code_name] = $value;
            }
        }
    }
    if ( $userdata['session_logged_in'] ) {
        $report_img = '<a href="' . append_sid('viewtopic.php?report=TRUE&amp;' . POST_POST_URL . '=' . $postrow[$i]['post_id']) . '"><img src="' . $images['icon_report'] . '" border="0" width="16" height="18" alt="' . $lang['Report_post'] . '" title="' . $lang['Report_post'] . '" /></a>';
    } else {
        $report_img = '';
    }

    /*--FNA #3--*/
    $template->assign_block_vars('postrow',array_merge( array(
        'REPORT_IMG'        => $report_img,
        'ROW_COLOR'         => '#' . $row_color,
        'ROW_CLASS'         => $row_class,
        'POSTER_NAME'       => UsernameColor($poster),
        'POSTER_RANK'       => (!empty($poster_rank) ? $poster_rank : '&nbsp;'),
        'RANK_IMAGE'        => $rank_image,
        'POSTER_JOINED'     => $poster_joined,
        'POSTER_POSTS'      => $poster_posts,
        'POSTER_FROM'       => (!empty($poster_from) ? $poster_from : '&nbsp;'),
        'POSTER_AVATAR'     => (!empty($poster_avatar) ? $poster_avatar : '&nbsp;'),
        'POSTER_ONLINE_STATUS_IMG' => $contact_img['online_status_img'],
        'POSTER_ONLINE_STATUS'     => $contact_img['online_status'],
        'POST_NUMBER'       => ($i + $start + 1),
        'POST_DATE'         => $post_date,
        'POST_SUBJECT'      => $post_subject,
        'MESSAGE'           => $message,
        'SIGNATURE'         => (empty($user_sig) ? '&nbsp;' : $user_sig),
        'EDITED_MESSAGE'    => (!empty($l_edited_by) ? $l_edited_by : '&nbsp;'),
        'MINI_POST_IMG'     => $mini_post_img,
        'PROFILE_IMG'       => $contact_img['profile_img'],
        'PROFILE'           => $contact_img['profile'],
        'SEARCH_IMG'        => $search_img,
        'SEARCH'            => $search,
        'PM_IMG'            => $contact_img['pm_img'],
        'PM'                => $contact_img['pm'],
        'EMAIL_IMG'         => $contact_img['email_img'],
        'EMAIL'             => $contact_img['email'],
        'WWW_IMG'           => $contact_img['www_img'],
        'WWW'               => $contact_img['www'],
        'ICQ_STATUS_IMG'    => $contact_img['icq_status_img'],
        'ICQ_IMG'           => $contact_img['icq_img'],
        'ICQ'               => $contact_img['icq'],
        'ICQ_IMG_NOSCRIPT'  => $contact_img['icq_noscript'],
        'AIM_IMG'           => $contact_img['aim_img'],
        'AIM'               => $contact_img['aim'],
        'MSN_IMG'           => $contact_img['msn_img'],
        'MSN'               => $contact_img['msn'],
        'YIM_STATUS_IMG'    => $contact_img['yim_status_img'],
        'YIM_IMG'           => $contact_img['yim_img'],
        'YIM'               => $contact_img['yim'],
        'YIM_IMG_NOSCRIPT'  => $contact_img['yim_noscript'],
        'EDIT_IMG'          => $edit_img,
        'EDIT'              => $edit,
        'QUOTE_IMG'         => $quote_img,
        'QUOTE'             => $quote,
        'IP_IMG'            => $ip_img,
        'IP'                => $ip,
        'DELETE_IMG'        => $delpost_img,
        'DELETE'            => $delpost,
        'SPACER_IMG'        => $images['spacer'],
        'L_MINI_POST_ALT'   => $mini_post_alt,
        'U_MINI_POST'       => $mini_post_url,
        'ATTACHMENTS'       => '&nbsp;',
        'U_POST_ID'         => $postrow[$i]['post_id']),
        $xd_root)
    );
    if ($userdata['user_showavatars']) {
        $template->assign_block_vars('postrow.switch_showavatars', array());
    }

    $sql = "SELECT mode
            FROM ". LOGS_TABLE ."
            WHERE last_post_id = '". $postrow[$i]['post_id'] ."'
            ORDER BY log_id DESC LIMIT 1";
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Could not get moved type', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $moved_type = $row['mode'];
    $select = '';
    if ( $moved_type == 'move' ) {
        $select = "mv.time, mv.last_post_id, f.forum_name AS forumparent, f2.forum_name AS forumtarget, u.username";
        $from = "(". LOGS_TABLE ." mv, ". TOPICS_TABLE ." t, ". FORUMS_TABLE ." f, ". FORUMS_TABLE ." f2, ". USERS_TABLE ." u) ";
        $where = "mv.last_post_id = '". $postrow[$i]['post_id'] ."'
                AND mv.forum_id = f.forum_id
                AND mv.new_forum_id = f2.forum_id
                AND mv.user_id = u.user_id";
    }
    if ( $moved_type == 'split' ) {
        $select = "mv.time, mv.last_post_id, f.forum_name as forumparent, t2.topic_title, u.username";
        $from = "(". LOGS_TABLE ." mv, ". TOPICS_TABLE ." t, ". TOPICS_TABLE ." t2, ". FORUMS_TABLE ." f, ". USERS_TABLE ." u )";
        $where = "mv.last_post_id = '". $postrow[$i]['post_id'] ."'
                AND mv.forum_id = f.forum_id
                AND mv.topic_id = t2.topic_id
                AND mv.user_id = u.user_id";
    }
    if ( $moved_type == 'lock' || $moved_type == 'unlock' || $moved_type == 'edit') {
        $select = "mv.time, mv.last_post_id,  u.username";
        $from = "(". LOGS_TABLE ." mv,  ". USERS_TABLE ." u) ";
        $where = "mv.last_post_id = '". $postrow[$i]['post_id'] ."'
                AND mv.user_id = u.user_id";
    }
    if (!empty($select)) {
        $sql = "SELECT $select
                FROM $from
                WHERE $where
                ORDER BY mv.time DESC LIMIT 1";
        if ( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not get main move information', '', __LINE__, __FILE__, $sql);
        }
        $moved = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
    }

    $mini_icon = $images['icon_minipost'];
    $move_date = (isset($moved['time'])) ? create_date($board_config['default_dateformat'], $moved['time'],$board_config['board_timezone']) : '';
    $mover = (isset($moved['username'])) ? UsernameColor($moved['username']) : '';
    $parent_topic = (isset($moved['topic_title'])) ? $moved['topic_title'] : '';
    $parent_forum = (isset($moved['forumparent'])) ? $moved['forumparent'] : '';
    $target_forum = (isset($moved['forumtarget'])) ? $moved['forumtarget'] : '';

    if (allow_log_view($userdata['user_level'])) {
        if ( $moved_type == 'move') {
            $move_message = sprintf($lang['Move_move_message'], $move_date, $mover, $parent_forum, $target_forum);
        }
        if ( $moved_type == 'lock') {
            $move_message = sprintf($lang['Move_lock_message'], $move_date, $mover);
        }
        if ( $moved_type == 'unlock') {
            $move_message = sprintf($lang['Move_unlock_message'], $move_date, $mover);
        }
        if ( $moved_type == 'split') {
            $move_message = sprintf($lang['Move_split_message'], $move_date, $mover, $parent_topic, $parent_forum);
        }
        if ( $moved_type == 'edit') {
            $move_message = sprintf($lang['Move_edit_message'], $move_date, $mover);
        }
        if ( isset($moved) && ($moved['last_post_id'] == $postrow[$i]['post_id'] && show_log($moved_type))) {
            $template->assign_block_vars('postrow.move_message', array(
                'MOVE_MESSAGE' => '<img src="'.$mini_icon.'" border="0" alt="" />'.$move_message)
            );
        } else {
            $template->assign_block_vars('postrow.switch_spacer', array());
        }
    } else {
        $template->assign_block_vars('postrow.switch_spacer', array());
    }
    if ($postrow[$i]['post_attachment']) {
        display_post_attachments($postrow[$i]['post_id'], $postrow[$i]['post_attachment']);
    }
    @reset($xd_block);
    while ( list($code_name, $value) = each($xd_block) ) {
        $template->assign_block_vars( 'postrow.xdata', array(
            'NAME'  => $xd_meta[$code_name]['field_name'],
            'VALUE' => $value
            )
        );
    }

    @reset($xd_meta);
    while ( list($code_name, $value) = each($xd_meta) ) {
        if (isset($xd_root[$code_name])) {
            $template->assign_block_vars( "postrow.switch_$code_name", array() );
        } else {
            $template->assign_block_vars( "postrow.switch_no_$code_name", array() );
        }
    }

}

if( !$printertopic ) {
    if (show_glance('topics')) {
        include_once($phpbb_root_path . 'glance.php');
    }

    if ( $show_qr_form ) {
        $template->assign_block_vars('switch_quick_reply', array());
        include_once(NUKE_INCLUDE_DIR.'viewtopic_quickreply.php');
    }
}

$template->pparse('body');

if( $printertopic ) {
    $gen_simple_header = 1;
}
include_once(NUKE_INCLUDE_DIR . 'page_tail.php');

?>