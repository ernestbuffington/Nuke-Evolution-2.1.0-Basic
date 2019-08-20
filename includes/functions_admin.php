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

//
// Simple version of jumpbox, just lists authed forums
//

function make_forum_select($box_name, $ignore_forum = false, $select_forum = '') {
    global $db, $userdata, $lang;
    
    $is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);
    $sql = 'SELECT f.forum_id, f.forum_name
            FROM ' . CATEGORIES_TABLE . ' c, ' . FORUMS_TABLE . ' f
            WHERE f.cat_id = c.cat_id 
            ORDER BY c.cat_order, f.forum_order';
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Couldn not obtain forums information', '', __LINE__, __FILE__, $sql);
    }
    $forum_list = '';
    while( $row = $db->sql_fetchrow($result) ) {
        if ( $is_auth_ary[$row['forum_id']]['auth_read'] && $ignore_forum != $row['forum_id'] ) {
            $selected = ( $select_forum == $row['forum_id'] ) ? ' selected="selected"' : '';
            $forum_list .= '<option value="' . $row['forum_id'] . '"' . $selected .'>' . $row['forum_name'] . '</option>';
        }
    }
    $db->sql_freeresult($result);
    $forum_list = ( $forum_list == '' ) ? $lang['No_forums'] : '<select name="' . $box_name . '">' . $forum_list . '</select>';
    return $forum_list;
}

//
// Synchronise functions for forums/topics
//
function sync($type, $id = false) {
    global $db;

    switch($type) {
        case 'all forums':
            $sql = "SELECT forum_id
                    FROM " . FORUMS_TABLE;
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get forum IDs', '', __LINE__, __FILE__, $sql);
            }
            while( $row = $db->sql_fetchrow($result) ) {
                sync('forum', $row['forum_id']);
            }
            $db->sql_freeresult($result);
            break;
        case 'all topics':
            $sql = "SELECT topic_id
                    FROM " . TOPICS_TABLE;
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
            }
            while( $row = $db->sql_fetchrow($result) ) {
                sync('topic', $row['topic_id']);
            }
            $db->sql_freeresult($result);
            break;
        case 'forum':
            $sql = "SELECT MAX(post_id) AS last_post, COUNT(post_id) AS total
                    FROM " . POSTS_TABLE . "
                    WHERE forum_id = '$id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
            }
            if ( $row = $db->sql_fetchrow($result) ) {
                $last_post = ( $row['last_post'] ) ? $row['last_post'] : 0;
                $total_posts = ($row['total']) ? $row['total'] : 0;
            } else {
                $last_post = 0;
                $total_posts = 0;
            }
            $db->sql_freeresult($result);
            $sql = "SELECT COUNT(topic_id) AS total
                    FROM " . TOPICS_TABLE . "
                    WHERE forum_id = '$id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get topic count', '', __LINE__, __FILE__, $sql);
            }
            $total_topics = ( $row = $db->sql_fetchrow($result) ) ? ( ( $row['total'] ) ? $row['total'] : 0 ) : 0;
            $sql = "UPDATE " . FORUMS_TABLE . "
                    SET forum_last_post_id = '$last_post', forum_posts = '$total_posts', forum_topics = '$total_topics'
                    WHERE forum_id = '$id'";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update forum', '', __LINE__, __FILE__, $sql);
            }
            $db->sql_freeresult($result);
            break;
        case 'topic':
            $sql = "SELECT MAX(post_id) AS last_post, MIN(post_id) AS first_post, COUNT(post_id) AS total_posts
                    FROM " . POSTS_TABLE . "
                    WHERE topic_id = '$id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
            }
            if ( $row = $db->sql_fetchrow($result) ) {
                if ($row['total_posts']) {
                    // Correct the details of this topic
                    $sql = 'UPDATE ' . TOPICS_TABLE . ' 
                            SET topic_replies = ' . ($row['total_posts'] - 1) . ', topic_first_post_id = ' . $row['first_post'] . ', topic_last_post_id = ' . $row['last_post'] . "
                            WHERE topic_id = $id";
                    if (!$db->sql_query($sql)) {
                        message_die(GENERAL_ERROR, 'Could not update topic', '', __LINE__, __FILE__, $sql);
                    }
                } else {
                    // There are no replies to this topic
                    // Check if it is a move stub
                    $sql = 'SELECT topic_moved_id 
                            FROM ' . TOPICS_TABLE . " 
                            WHERE topic_id = $id";
                    if (!($result = $db->sql_query($sql))) {
                        message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
                    }
                    if ($row = $db->sql_fetchrow($result)) {
                        if (!$row['topic_moved_id']) {
                            $sql = 'DELETE FROM ' . TOPICS_TABLE . " WHERE topic_id = $id";
                            if (!$db->sql_query($sql)) {
                                message_die(GENERAL_ERROR, 'Could not remove topic', '', __LINE__, __FILE__, $sql);
                            }
                        }
                    }
                    $db->sql_freeresult($result);
                }
            }
            attachment_sync_topic($id);
            break;
    }
    global $board_config;
    board_stats();
    return true;
}

?>