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

$html_entities_match = array('#&(?!(\#[0-9]+;))#', '#<#', '#>#', '#"#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;', '&quot;');

$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');

//
// This function will prepare a posted message for
// entry into the database.
//
function prepare_message($message, $html_on, $bbcode_on, $smile_on, $bbcode_uid = 0) {
    global $board_config, $html_entities_match, $html_entities_replace, $userdata, $lang;
    //
    // Clean up the message
    //
    $message = trim($message);
    if ($html_on) {
        // If HTML is on, we try to make it safe
        // This approach is quite agressive and anything that does not look like a valid tag
        // is going to get converted to HTML entities
        $message = stripslashes($message);
        $html_match = '#<[^\w<]*(\w+)((?:"[^"]*"|\'[^\']*\'|[^<>\'"])+)?>#';
        $matches = array();
        $message_split = preg_split($html_match, $message);
        preg_match_all($html_match, $message, $matches);
        $message = '';
        foreach ($message_split as $part) {
          $tag = array(array_shift($matches[0]), array_shift($matches[1]), array_shift($matches[2]));
          $message .= @preg_replace($html_entities_match, $html_entities_replace, $part) . clean_html($tag);
        }
        $message = addslashes($message);
        $message = str_replace('&quot;', '\&quot;', $message);
    } else {
        if(is_admin()) {
            //do nothing
        } else {
           $message = preg_replace($html_entities_match, $html_entities_replace, $message);
        }
    }
    if($bbcode_on && $bbcode_uid != '') {
        $message = bbencode_first_pass($message, $bbcode_uid);
    }
    $message = replace_double_spaces($message);
    return $message;
}

function unprepare_message($message) {
    global $unhtml_specialchars_match, $unhtml_specialchars_replace;
    return preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, $message);
}

//
// Prepare a message for posting
//
function prepare_post(&$mode, &$post_data, &$bbcode_on, &$html_on, &$smilies_on, &$error_msg, &$username, &$bbcode_uid, &$subject, &$message, &$poll_title, &$poll_options, &$poll_length, &$poll_view_toggle) {
    global $board_config, $userdata, $lang, $phpbb_root_path, $evoconfig;

    // Check username
    if (!empty($username)) {
        $username = phpbb_clean_username($username);
        if ($post_data['poster_id'] != ANONYMOUS  && (!$userdata['session_logged_in'] || ($userdata['session_logged_in'] && $username != $userdata['username']))) {
            include(NUKE_INCLUDE_DIR . 'functions_validate.php');
            $result = validate_username($username);
            if ($result['error']) {
                $error_msg .= (!empty($error_msg)) ? '<br />' . $result['error_msg'] : $result['error_msg'];
            }
        } else {
            $username = $evoconfig['anonymous'];
        }
    }
    // Check subject
    if (substr_count(smilies_pass($message), '<img src="'. NUKE_HREF_BASE_DIR . $board_config['smilies_path']) > $board_config['max_smilies'] ) {
        $to_much_smilies = substr_count(smilies_pass($message), '<img src="'. NUKE_HREF_BASE_DIR . $board_config['smilies_path']) - $board_config['max_smilies'];
        $to_many_smilies = sprintf($lang['Max_smilies_per_post'], $board_config['max_smilies'], $to_much_smilies);
        $error_msg .= ( !empty($error_msg) ) ? '<br />' . $to_many_smilies : $to_many_smilies;
    }
    if (!empty($subject)) {
        $subject = htmlspecialchars(trim($subject));
    } else if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post'])) {
        $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_subject'] : $lang['Empty_subject'];
    }
    // Check message
    if (!empty($message)) {
        $bbcode_uid = ($bbcode_on) ? make_bbcode_uid() : '';
        $message = prepare_message($message, $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
    } else if ($mode != 'delete' && $mode != 'poll_delete') {
        $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_message'] : $lang['Empty_message'];
    }
    //
    // Handle poll stuff
    //
    if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post'])) {
        $poll_length = (isset($poll_length)) ? max(0, intval($poll_length)) : 0;
        if (!empty($poll_title)) {
            $poll_title = htmlspecialchars(trim($poll_title));
        }
        if(!empty($poll_options)) {
            $temp_option_text = array();
            while(list($option_id, $option_text) = @each($poll_options)) {
                $option_text = trim($option_text);
                if (!empty($option_text)) {
                    $temp_option_text[intval($option_id)] = htmlspecialchars($option_text);
                }
            }
            $option_text = $temp_option_text;
            if (count($poll_options) < 2) {
                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_few_poll_options'] : $lang['To_few_poll_options'];
            } else if (count($poll_options) > $board_config['max_poll_options']) {
                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_many_poll_options'] : $lang['To_many_poll_options'];
            } else if ($poll_title == '') {
                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_poll_title'] : $lang['Empty_poll_title'];
            }
        }
    }
    return;
}

//
// Post a new topic/reply/poll or edit existing post/poll
//
function submit_post($mode, &$post_data, &$message, &$page_meta, &$forum_id, &$topic_id, &$post_id, &$poll_id, &$topic_type, &$bbcode_on, &$html_on, &$smilies_on, &$attach_sig, &$bbcode_uid, $post_username, $post_subject, $post_message, $poll_title, &$poll_options, &$poll_length, &$poll_view_toggle, $post_icon = 0) {
    global $board_config, $lang, $db, $phpbb_root_path, $userdata, $user_ip;
    /*--FNA--*/
    include(NUKE_INCLUDE_DIR . 'functions_search.php');
    $current_time = time();
    //
    // Retreive authentication info to determine if this user has moderator status
    //
    $is_auth = auth(AUTH_ALL, $forum_id, $userdata);
    $is_mod = $is_auth['auth_mod'];

    if (($mode == 'newtopic' || $mode == 'reply' || $mode == 'editpost') && !$is_mod) {
        //
        // Flood control
        //
        $where_sql = ($userdata['user_id'] == ANONYMOUS) ? "poster_ip = '$user_ip'" : 'poster_id = ' . $userdata['user_id'];
        $sql = "SELECT MAX(post_time) AS last_post_time
                FROM " . POSTS_TABLE . "
                WHERE $where_sql";
        if ($result = $db->sql_query($sql)) {
            if ($row = $db->sql_fetchrow($result)) {
                if (intval($row['last_post_time']) > 0 && ($current_time - intval($row['last_post_time'])) < intval($board_config['flood_interval'])) {
                    message_die(GENERAL_MESSAGE, $lang['Flood_Error']);
                }
            }
        }
    }
    if ($mode == 'editpost') {
        remove_search_post($post_id);
    }
    if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post'])) {
        $topic_vote = (!empty($poll_title) && count($poll_options) >= 2) ? 1 : 0;
        $sql  = ($mode != 'editpost') ? "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type, topic_icon, topic_vote) VALUES ('$post_subject', '" . $userdata['user_id'] . "', '$current_time', '$forum_id', " . TOPIC_UNLOCKED . ", '$topic_type', '$post_icon', '$topic_vote')" : "UPDATE " . TOPICS_TABLE . " SET topic_title = '$post_subject', topic_type = $topic_type, topic_icon=$post_icon " . ((isset($post_data['edit_vote']) || !empty($poll_title)) ? ", topic_vote = " . $topic_vote : "") . " WHERE topic_id = '$topic_id'";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }
        if ($mode == 'newtopic') {
            $topic_id = $db->sql_nextid();
        }
    }

    if ($mode == 'newtopic') {
        if ( $topic_type == POST_GLOBAL_ANNOUNCE ) {
            log_action('Global Announcement', '', $topic_id, $userdata['user_id'], '', '');
        } elseif ( $topic_type == POST_ANNOUNCE ) {
            log_action('Announcement', '', $topic_id, $userdata['user_id'], '', '');
        } else if ( $topic_type == POST_STICKY ) {
            log_action('Sticky', '', $topic_id, $userdata['user_id'], '', '');
        }
    }
    $edited_sql = ($mode == 'editpost' && !$post_data['last_post'] && $post_data['poster_post']) ? ", post_edit_time = $current_time, post_edit_count = post_edit_count + 1 " : "";
    $sql = ($mode != "editpost") ? "INSERT INTO " . POSTS_TABLE . " (topic_id, forum_id, poster_id, post_username, post_time, poster_ip, enable_bbcode, enable_html, enable_smilies, enable_sig, post_icon) VALUES ('$topic_id', '$forum_id', '" . $userdata['user_id'] . "', '$post_username', '$current_time', '$user_ip', '$bbcode_on', '$html_on', '$smilies_on', '$attach_sig', '$post_icon')" : "UPDATE " . POSTS_TABLE . " SET post_username = '$post_username', enable_bbcode = '$bbcode_on', enable_html = '$html_on', enable_smilies = '$smilies_on', enable_sig = '$attach_sig', post_icon = '$post_icon'" . $edited_sql . " WHERE post_id = '$post_id'";
    if (!$db->sql_query($sql)) {
        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
    }
    if ($mode != 'editpost') {
        $post_id = $db->sql_nextid();
    }

    $sql = ($mode != 'editpost') ? "INSERT INTO " . POSTS_TEXT_TABLE . " (post_id, post_subject, bbcode_uid, post_text) VALUES ('$post_id', '$post_subject', '$bbcode_uid', '$post_message')" : "UPDATE " . POSTS_TEXT_TABLE . " SET post_text = '$post_message',  bbcode_uid = '$bbcode_uid', post_subject = '$post_subject' WHERE post_id = '$post_id'";
    if (!$db->sql_query($sql)) {
        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
    }

    add_search_words('single', $post_id, stripslashes($post_message), stripslashes($post_subject));
    $post_data['post_username']  = UsernameColor($userdata['username']);
    $post_data['post_text']      = $post_message;
    $post_data['post_bbcodeuid'] = $bbcode_uid;

    //
    // Add poll
    //
    if (($mode == 'newtopic' || ($mode == 'editpost' && $post_data['edit_poll'])) && !empty($poll_title) && count($poll_options) >= 2) {
        $sql = (!$post_data['has_poll']) ? "INSERT INTO " . VOTE_DESC_TABLE . " (topic_id, vote_text, vote_start, vote_length, poll_view_toggle) VALUES ('$topic_id', '$poll_title', '$current_time', " . ($poll_length * 86400) . ", '$poll_view_toggle')" : "UPDATE " . VOTE_DESC_TABLE . " SET vote_text = '$poll_title', vote_length = " . ($poll_length * 86400) . ", poll_view_toggle = '$poll_view_toggle' WHERE topic_id = '$topic_id'";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }

        $delete_option_sql = '';
        $old_poll_result = array();
        if ($mode == 'editpost' && $post_data['has_poll']) {
            $sql = "SELECT vote_option_id, vote_result
                    FROM " . VOTE_RESULTS_TABLE . "
                    WHERE vote_id = '$poll_id'
                    ORDER BY vote_option_id ASC";
            if (!($result = $db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Could not obtain vote data results for this topic', '', __LINE__, __FILE__, $sql);
            }
            while ($row = $db->sql_fetchrow($result)) {
                $old_poll_result[$row['vote_option_id']] = $row['vote_result'];
                if (!isset($poll_options[$row['vote_option_id']])) {
                    $delete_option_sql .= ($delete_option_sql != '') ? ', ' . $row['vote_option_id'] : $row['vote_option_id'];
                }
            }
        } else {
            $poll_id = $db->sql_nextid();
        }

        @reset($poll_options);

        $poll_option_id = 1;
        while (list($option_id, $option_text) = each($poll_options)) {
            if (!empty($option_text)) {
                $option_text = str_replace("\'", "''", htmlspecialchars($option_text));
                $poll_result = ($mode == "editpost" && isset($old_poll_result[$option_id])) ? $old_poll_result[$option_id] : 0;

                $sql = ($mode != "editpost" || !isset($old_poll_result[$option_id])) ? "INSERT INTO " . VOTE_RESULTS_TABLE . " (vote_id, vote_option_id, vote_option_text, vote_result) VALUES ('$poll_id', '$poll_option_id', '$option_text', '$poll_result')" : "UPDATE " . VOTE_RESULTS_TABLE . " SET vote_option_text = '$option_text', vote_result = '$poll_result' WHERE vote_option_id = '$option_id' AND vote_id = '$poll_id'";
                if (!$db->sql_query($sql)) {
                    message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                }
                $poll_option_id++;
            }
        }

        if ($delete_option_sql != '') {
            $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . "
                    WHERE vote_option_id IN ($delete_option_sql)
                    AND vote_id = '$poll_id'";
            if (!$db->sql_query($sql)) {
                message_die(GENERAL_ERROR, 'Error deleting pruned poll options', '', __LINE__, __FILE__, $sql);
            }
        }
    }
    board_stats();
    cache_tree(true);
    $page_meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.php?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '" />';
    $message = $lang['Stored'] . '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.php?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.php?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
    return;
}

//
// Update post stats and details
//
function update_post_stats(&$mode, &$post_data, &$forum_id, &$topic_id, &$post_id, &$user_id) {
    global $db, $userdata;

    $sign = ($mode == 'delete') ? '- 1' : '+ 1';
    $forum_update_sql = "forum_posts = forum_posts $sign";
    $topic_update_sql = '';

    if ($mode == 'delete') {
        if ($post_data['last_post']) {
            if ($post_data['first_post']) {
                $forum_update_sql .= ', forum_topics = forum_topics - 1';
            } else {
                $topic_update_sql .= 'topic_replies = topic_replies - 1';
                $sql = "SELECT MAX(post_id) AS last_post_id
                        FROM " . POSTS_TABLE . "
                        WHERE topic_id = '$topic_id'";
                if (!($result = $db->sql_query($sql))) {
                    message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                }
                if ($row = $db->sql_fetchrow($result)) {
                    $topic_update_sql .= ', topic_last_post_id = ' . $row['last_post_id'];
                }
            }

            if ($post_data['last_topic']) {
                $sql = "SELECT MAX(post_id) AS last_post_id
                        FROM " . POSTS_TABLE . "
                        WHERE forum_id = '$forum_id'";
                if (!($result = $db->sql_query($sql))) {
                    message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                }
                if ($row = $db->sql_fetchrow($result)) {
                    $forum_update_sql .= ($row['last_post_id']) ? ', forum_last_post_id = ' . $row['last_post_id'] : ', forum_last_post_id = 0';
                }
            }
        } else if ($post_data['first_post']) {
            $sql = "SELECT MIN(post_id) AS first_post_id
                    FROM " . POSTS_TABLE . "
                    WHERE topic_id = '$topic_id'";
            if (!($result = $db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
            }
            if ($row = $db->sql_fetchrow($result)) {
                $topic_update_sql .= 'topic_replies = topic_replies - 1, topic_first_post_id = ' . $row['first_post_id'];
            }
        } else {
            $topic_update_sql .= 'topic_replies = topic_replies - 1';
        }
    } else if ($mode != 'poll_delete') {
        $forum_update_sql .= ", forum_last_post_id = $post_id" . (($mode == 'newtopic') ? ", forum_topics = forum_topics $sign" : "");
        $topic_update_sql = "topic_last_post_id = $post_id" . (($mode == 'reply') ? ", topic_replies = topic_replies $sign" : ", topic_first_post_id = $post_id");
    } else {
        $topic_update_sql .= 'topic_vote = 0';
    }
    if ($mode != 'poll_delete') {
        $sql = "UPDATE " . FORUMS_TABLE . " SET
                $forum_update_sql
                WHERE forum_id = $forum_id";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }
    }
    if ($topic_update_sql != '') {
        $sql = "UPDATE " . TOPICS_TABLE . " SET
               $topic_update_sql
               WHERE topic_id = '$topic_id'";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }
    }
    if ($mode != 'poll_delete') {
        $sql = "UPDATE " . USERS_TABLE . "
                SET user_posts = user_posts $sign
                WHERE user_id = '$user_id'";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }
    }
    board_stats();
    cache_tree(true);
    if (is_user()) {
        $sql = "SELECT ug.user_id, g.group_id as g_id, u.user_posts, g.group_count, g.group_count_max
                FROM (".USERS_TABLE." u, (" . GROUPS_TABLE . " g
                LEFT JOIN ". USER_GROUP_TABLE." ug ON g.group_id=ug.group_id AND ug.user_id=$user_id))
                WHERE u.user_id=$user_id
                AND g.group_single_user=0
                AND g.group_count_enable=1
                AND g.group_moderator<>$user_id
                ORDER BY g.group_count_max ASC";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Error geting users post stat', '', __LINE__, __FILE__, $sql);
        }
        while ($group_data = $db->sql_fetchrow($result)) {
            $user_already_added = (empty($group_data['user_id'])) ? FALSE : TRUE;
            $user_add = ($group_data['group_count'] == $group_data['user_posts'] && $user_id != ANONYMOUS) ? TRUE : FALSE;
            $user_remove = ($group_data['group_count'] > $group_data['user_posts'] || $group_data['group_count_max'] < $group_data['user_posts']) ? TRUE : FALSE;
            if ($user_add && !$user_already_added) {
                //user join a autogroup
                $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                        VALUES (".$group_data['g_id'].", $user_id, '0')";
                if ( !($db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Error insert users, group count', '', __LINE__, __FILE__, $sql);
                }
                add_group_attributes($user_id, $group_data['g_id']);
            } else {
                if ( $user_already_added && $user_remove) {
                    //remove user from auto group
                    $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                            WHERE group_id=".$group_data['g_id']."
                            AND user_id=$user_id";
                    if ( !($db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);
                    }
                }
            }
        }
    }
    return;
}

//
// Delete a post/poll
//
function delete_post($mode, &$post_data, &$message, &$page_meta, &$forum_id, &$topic_id, &$post_id, &$poll_id) {
    global $board_config, $lang, $db, $phpbb_root_path, $userdata, $user_ip, $cache, $thislang;
    $cache->delete('TopicData', 'home');
    $cache->delete('AnnounceData', 'home');

    if ($mode != 'poll_delete') {
        include(NUKE_INCLUDE_DIR . 'functions_search.php');
        $sql = "DELETE FROM " . POSTS_TABLE . "
                WHERE post_id = '$post_id'";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
        }
        $sql = "DELETE FROM " . POSTS_TEXT_TABLE . "
                WHERE post_id = '$post_id'";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
        }
        if ($post_data['last_post']) {
            if ($post_data['first_post']) {
                $forum_update_sql .= ', forum_topics = forum_topics - 1';
                $sql = "DELETE FROM " . TOPICS_TABLE . "
                        WHERE topic_id = '$topic_id'
                        OR topic_moved_id = '$topic_id'";
                if (!$db->sql_query($sql)) {
                    message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                }
                $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
                        WHERE topic_id = '$topic_id'";
                if (!$db->sql_query($sql)) {
                    message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                }
            }
        }
        remove_search_post($post_id);
    }
    if ($mode == 'poll_delete' || ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post']) && $post_data['has_poll'] && $post_data['edit_poll']) {
        $sql = "DELETE FROM " . VOTE_DESC_TABLE . "
                WHERE topic_id = '$topic_id'";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
        }
        $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . "
                WHERE vote_id = '$poll_id'";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
        }
        $sql = "DELETE FROM " . VOTE_USERS_TABLE . "
                WHERE vote_id = '$poll_id'";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
        }
    }
    if ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post']) {
        $page_meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.php?" . POST_FORUM_URL . '=' . $forum_id) . '" />';
        $message = $lang['Deleted'];
    } else {
        $page_meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.php?" . POST_TOPIC_URL . '=' . $topic_id) . '" />';
        $message = (($mode == 'poll_delete') ? $lang['Poll_delete'] : $lang['Deleted']) . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
    }
    $message .=  '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.php?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
    board_stats();
    cache_tree(true);
    return;
}

//
// Handle user notification on new post
//
function user_notification($mode, &$post_data, &$topic_title, &$forum_id, &$topic_id, &$post_id, &$notify_user) {
    global $board_config, $lang, $db, $phpbb_root_path, $userdata;
    $current_time = time();
    $is_updated   = FALSE;
    $langemail    = array();

    if ($mode != 'delete') {
        $result = $db->sql_query("SELECT u.username as username, u.user_id as user_id, u.user_email as user_email, u.user_lang as user_lang, u.user_notify FROM ".TOPICS_WATCH_TABLE." as t, "._USERS_TABLE." as u
                                    WHERE t.topic_id = '".$topic_id."'
                                    AND t.notify_status ='".TOPIC_WATCH_UN_NOTIFIED."'
                                    AND u.user_id = t.user_id");
        if ($db->sql_numrows($result) > 0) {
            $recipients = array();
            $send_count = 0;
            $update_sql = '';
            $attach_result = $db->sql_ufetchrow("SELECT ad.physical_filename
                                                FROM ".ATTACHMENTS_TABLE." a, ".ATTACHMENTS_DESC_TABLE." ad
                                                WHERE a.post_id = '".$post_id."'
                                                AND a.attach_id = ad.attach_id");
            if (isset($attach_result['physical_filename']) && !empty($attach_result['physical_filename'])) {
                $attachment   = $attach_result['physical_filename'];
            } else {
                $attachment = '';
            }
            $script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
            $script_name = 'modules.php?name=Forums&file=viewtopic';
            $server_name = trim($board_config['server_name']);
            $server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
            $server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';
            while ($row = $db->sql_fetchrow($result)) {
                if (EvoKernel_UserBanned($row['user_id'], 'userid') || !$row['user_notify']) {
                    $db->sql_uquery("DELETE FROM ".TOPICS_WATCH_TABLE." WHERE topic_id = '".$topic_id."'
                                     AND user_id = '".$row['user_id']."'");
                    continue;
                }
                if (($mode == 'reply') && $userdata['username'] == $row['username']) {
                    $is_updated = TRUE;
                    continue;
                }
                $thislang    = (!$row['user_lang'] ? $board_config['default_lang'] : $row['user_lang']);
                if (!isset($langemail[$thislang])) {
                    if (is_file(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/topic_notify.php')) {
                        include_once(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/topic_notify.php');
                    } else {
                        include_once(NUKE_FORUMS_DIR.'language/lang_english/email/topic_notify.php');
                    }
                }
                $subject     = $langemail[$thislang]['Subject'].' - '.EVO_SERVER_SITENAME;
                $topiclink   = $topic_title.':&nbsp;<a href="'.$server_protocol . $server_name . $server_port . $script_name . '&amp;'.POST_POST_URL."=".$post_id."#".$post_id.'" >'.$server_protocol . $server_name . $server_port . $script_name . '&amp;'.POST_POST_URL."=".$post_id."#".$post_id.'</a>';
                $message     = $langemail[$thislang]['Welcome'].' '.$row['username'].'<br /><br />';
                $message    .= $langemail[$thislang]['Part1'].'&nbsp;<strong>'.$topic_title.'</strong>&nbsp;'.$langemail[$thislang]['Part2'].'&nbsp;<strong>'.EVO_SERVER_SITENAME.'</strong>.<br />';
                $message    .= $post_data['post_username'].'&nbsp;'.$langemail[$thislang]['Part3'].'<br /><br />';
                $message    .= '<strong>'.$langemail[$thislang]['Content'].':</strong><br />';
                $message    .= '************************************************<br />'.bbencode_second_pass($post_data['post_text'], $post_data['post_bbcodeuid']).'<br />************************************************<br />';
                if (!empty($attachement)) {
                    $message .= '<strong>'.$langemail['german']['Attachement'].':</strong><br />'.$attachement;
                }
                $message    .= '<br /><br />'.$langemail[$thislang]['Part4'].'&nbsp;<br />'.$topiclink.'<br /><br />';
                $message    .= $langemail[$thislang]['Stop_watching_topic'].'<br />';
                $message    .= '<a href="'.$server_protocol . $server_name . $server_port . $script_name . '&amp;'.POST_TOPIC_URL.'='.$topic_id.'&amp;unwatch=topic" >'.$server_protocol . $server_name . $server_port . $script_name . '&amp;'.POST_TOPIC_URL.'='.$topic_id.'&amp;unwatch=topic</a><br /><br />';
                $message    .= (!empty($board_config['board_email_sig']) ? $board_config['board_email_sig'] : '').'<br /><br />';
                $recipients[$row['username']] = $row['user_email'];
                $update_sql .= (!empty($update_sql) ? ','.$row['user_id'] : $row['user_id']);
                $mailsend    = evo_mail($row['user_email'].','.$row['username'], $subject, $message, '', '', TRUE);
                $send_count++;
            }
            $db->sql_freeresult($result);
            if ($send_count > 0) {
                $db->sql_uquery("UPDATE " . TOPICS_WATCH_TABLE . "
                                SET notify_status = " . TOPIC_WATCH_NOTIFIED . "
                                WHERE topic_id = '".$topic_id."'
                                AND user_id IN (".$update_sql.")");
            }
        }
        if ($notify_user) {
            $db->sql_uquery("REPLACE INTO " . TOPICS_WATCH_TABLE . " (user_id, topic_id, notify_status)
                    VALUES ('" . $userdata['user_id'] . "', '".$topic_id."', '".TOPIC_WATCH_NOTIFIED."')");
        }
    }
}

//
// Fill smiley templates (or just the variables) with smileys
// Either in a window or inline
//
function generate_smilies($mode, $page_id) {
    global $db, $board_config, $template, $currentlang, $phpbb_root_path, $userdata, $user_ip, $lang;
    if (@file_exists(NUKE_LANGUAGE_DIR.'bbcode/smilies-'.$currentlang.'.php')) {
        include(NUKE_LANGUAGE_DIR.'bbcode/smilies-'.$currentlang.'.php');
    } else {
        include(NUKE_LANGUAGE_DIR.'bbcode/smilies-english.php');
    }

    $inline_columns = 4;
    $inline_rows = 5;
    $window_columns = 8;
    if ($mode == 'window') {
        $userdata = session_pagestart($user_ip, $page_id);
        init_userprefs($userdata);
        $gen_simple_header = TRUE;
        $page_title = $lang['Emoticons'];
        if ( defined('IN_ADMIN') ) {
            include_once(NUKE_FORUMS_ADMIN_DIR . 'page_header_admin.php');
        } else {
            include(NUKE_INCLUDE_DIR . 'page_header_review.php');
        }
        $template->set_filenames(array(
            'smiliesbody' => 'posting_smilies.tpl')
        );
    }

    $sql = "SELECT emoticon, code, smile_url
            FROM " . SMILIES_TABLE . "
            ORDER BY smilies_id";
    if ($result = $db->sql_query($sql)) {
        $num_smilies = 0;
        $rowset = array();
        while ($row = $db->sql_fetchrow($result)) {
            if (empty($rowset[$row['smile_url']])) {
                $rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
                $rowset[$row['smile_url']]['emoticon'] = ($bbsmilies_lang[$row['code']] ? str_replace($row['emoticon'], $bbsmilies_lang[$row['code']], $row['emoticon']) : $row['emoticon']) ;
                $num_smilies++;
            }
        }
        $db->sql_freeresult($result);
        if ($num_smilies) {
            $smilies_count = ($mode == 'inline') ? min(19, $num_smilies) : $num_smilies;
            $smilies_split_row = ($mode == 'inline') ? $inline_columns - 1 : $window_columns - 1;

            $s_colspan = 0;
            $row = 0;
            $col = 0;
            while (list($smile_url, $data) = @each($rowset)) {
                if (!$col) {
                    $template->assign_block_vars('smilies_row', array());
                }
                $template->assign_block_vars('smilies_row.smilies_col', array(
                    'SMILEY_CODE' => $data['code'],
                    'SMILEY_IMG' => NUKE_HREF_BASE_DIR . $board_config['smilies_path'] . '/' . $smile_url,
                    'SMILEY_DESC' => $data['emoticon'])
                );
                $s_colspan = max($s_colspan, $col + 1);
                if ($col == $smilies_split_row) {
                    if ($mode == 'inline' && $row == $inline_rows - 1) {
                        break;
                    }
                    $col = 0;
                    $row++;
                } else {
                    $col++;
                }
            }
            if ($mode == 'inline' && $num_smilies > $inline_rows * $inline_columns) {
                if ( defined('IN_ADMIN')) {
                    $smilies_popup = admin_sid("posting.php?mode=smilies&amp;popup=1");
                } else {
                    $smilies_popup = append_sid("posting.php?mode=smilies&amp;popup=1");
                }
                $template->assign_block_vars('switch_smilies_extra', array());
                $template->assign_vars(array(
                    'L_MORE_SMILIES' => $bbcode_lang['More_emoticons'],
                    'U_MORE_SMILIES' => $smilies_popup)
                );
            }
            $template->assign_vars(array(
               'L_EMOTICONS' => $bbcode_lang['Emoticons'],
               'L_CLOSE_WINDOW' => $bbcode_lang['smilies_close'],
               'S_SMILIES_COLSPAN' => $s_colspan)
            );
        }
    }
    if ($mode == 'window') {
        $template->pparse('smiliesbody');
        include(NUKE_INCLUDE_DIR . 'page_tail_review.php');
    }
}

function replace_double_spaces($message) {
    // setup find/replace vars
    $nbsp_match = '/  /';
    $nbsp_replace = ' &nbsp;';
    // replace all instances of double-spaces with a single space + &nbsp;
    $message = preg_replace($nbsp_match, $nbsp_replace, $message);
    return $message;
}

/**
* Called from within prepare_message to clean included HTML tags if HTML is
* turned on for that post
* @param array $tag Matching text from the message to parse
*/
function clean_html($tag) {
    global $board_config;

    if (empty($tag[0])) {
        return '';
    }

    $allowed_html_tags = preg_split('/, */', strtolower($board_config['allow_html_tags']));
    $disallowed_attributes = '/^(?:style|on)/i';

    // Check if this is an end tag
    preg_match('/<[^\w\/]*\/[\W]*(\w+)/', $tag[0], $matches);
    if (sizeof($matches)) {
        if (in_array(strtolower($matches[1]), $allowed_html_tags)) {
            return  '</' . $matches[1] . '>';
        } else {
            return  htmlspecialchars('</' . $matches[1] . '>');
        }
    }

    // Check if this is an allowed tag
    if (in_array(strtolower($tag[1]), $allowed_html_tags)) {
        $attributes = '';
        if (!empty($tag[2])) {
            preg_match_all('/[\W]*?(\w+)[\W]*?=[\W]*?(["\'])((?:(?!\2).)*)\2/', $tag[2], $test);
            for ($i = 0; $i < sizeof($test[0]); $i++) {
                if (preg_match($disallowed_attributes, $test[1][$i])) {
                    continue;
                }
                $attributes .= ' ' . $test[1][$i] . '=' . $test[2][$i] . str_replace(array('[', ']'), array('&#91;', '&#93;'), htmlspecialchars($test[3][$i])) . $test[2][$i];
            }
        }
        if (in_array(strtolower($tag[1]), $allowed_html_tags)) {
            return '<' . $tag[1] . $attributes . '>';
        } else {
            return htmlspecialchars('<' . $tag[1] . $attributes . '>');
        }
    } else {
        // Finally, this is not an allowed tag so strip all the attibutes and escape it
        return htmlspecialchars('<' .   $tag[1] . '>');
    }
}

?>