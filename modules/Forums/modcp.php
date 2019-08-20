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

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}


include($phpbb_root_path . 'common.php');
include_once(NUKE_INCLUDE_DIR.'bbcode.php');
include_once(NUKE_INCLUDE_DIR.'functions_admin.php');
include_once(NUKE_INCLUDE_DIR.'functions_log.php');
 
// Obtain initial var settings
$mode     = $_GETVAR->get('mode', 'request', 'string', NULL);
$post_id  = $_GETVAR->get('p', 'request', 'int', 0);
$topic_id = $_GETVAR->get('t', 'request', 'int', 0);
$forum_id = $_GETVAR->get('f', 'request', 'int', 0);
$confirm  = $_GETVAR->get('confirm', 'post', 'string', NULL) ? TRUE : 0;
$selected_id = $_GETVAR->get('selected_id', 'request', 'string', NULL);
$topics   = $_GETVAR->get('topic_id_list', 'post', 'array', array($topic_id));
$posts    = $_GETVAR->get('post_id_list', 'post', 'array', array());
$fid      = $_GETVAR->get('new_forum', 'post', 'string', '');
$move_leave_shadow = $_GETVAR->get('move_leave_shadow', 'post', 'string', NULL);

if ( $selected_id ) {
    $type = substr($selected_id, 0, 1);
    $id   = intval(substr($selected_id, 1));
    if ($type == POST_FORUM_URL) {
        $forum_id = $id;
    } else if (($type == POST_CAT_URL) || ($selected_id == 'Root')) {
        $parm = ($id != 0) ? '?' . POST_CAT_URL . "=$id" : '';
        redirect(append_sid('index.php' . $parm));
        exit;
    }
}

// Continue var definitions
$start    = $_GETVAR->get('start', 'get', 'int', 0);
$start    = ($start < 0) ? 0 : $start;
$delete   = $_GETVAR->get('delete', 'post', 'string', NULL) ? TRUE : FALSE;
$move     = $_GETVAR->get('move', 'post', 'string', NULL) ? TRUE : FALSE;
$lock     = $_GETVAR->get('lock', 'post', 'string', NULL) ? TRUE : FALSE;
$unlock   = $_GETVAR->get('unlock', 'post', 'string', NULL) ? TRUE : FALSE;
$cement   = $_GETVAR->get('cement', 'post', 'string', NULL) ? TRUE : FALSE;
$cancel   = $_GETVAR->get('cancel', 'post', 'string', NULL);

if ($mode) {
    $mode   = ($delete && $start) ? 'delete' : $mode;
} else {
    if ( $delete ) {
        $mode = 'delete';
    } elseif ( $move ) {
        $mode = 'move';
    } elseif ( $lock ) {
        $mode = 'lock';
    } elseif ( $unlock ) {
        $mode = 'unlock';
    } elseif ( $cement ) {
        $mode = 'cement';
    } else {
        $mode = '';
    }
}

// Obtain relevant data
if ( !empty($topic_id) ) {
    $sql = "SELECT f.forum_id, f.forum_name, f.forum_topics
            FROM (" . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f)
            WHERE t.topic_id = " . $topic_id . "
            AND f.forum_id = t.forum_id";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
    }
    $topic_row = $db->sql_fetchrow($result);
    if (!$topic_row) {
        message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
    }
    $db->sql_freeresult($result);
    $forum_topics = ( $topic_row['forum_topics'] == 0 ) ? 1 : $topic_row['forum_topics'];
    $forum_id = $topic_row['forum_id'];
    $forum_name = get_object_lang(POST_FORUM_URL . $topic_row['forum_id'], 'name');
} else if ( !empty($forum_id) ) {
    $sql = "SELECT forum_id, forum_name, forum_topics
            FROM " . FORUMS_TABLE . "
            WHERE forum_id = " . $forum_id;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_MESSAGE, 'Forum_not_exist');
    }
    $topic_row = $db->sql_fetchrow($result);
    if (!$topic_row) {
        message_die(GENERAL_MESSAGE, 'Forum_not_exist');
    }
    $db->sql_freeresult($result);
    $forum_topics = ( $topic_row['forum_topics'] == 0 ) ? 1 : $topic_row['forum_topics'];
    $forum_name = get_object_lang(POST_FORUM_URL . $topic_row['forum_id'], 'name');
} else {
    message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

// Start session management
$userdata = session_pagestart($user_ip, PAGE_POSTING);
init_userprefs($userdata);
// End session management

// Check if user did or did not confirm
// If they did not, forward them to the last page they were on
if ( $cancel ) {
    if ( $topic_id ) {
        $redirect = 'viewtopic.php?' . POST_TOPIC_URL . '='.$topic_id;
    } else if ( $forum_id ) {
        $redirect = 'viewforum.php?' . POST_FORUM_URL . '='.$forum_id;
    } else {
        $redirect = 'index.php';
    }
    redirect(append_sid($redirect, TRUE));
    exit;
}

// Start auth check
$is_auth = auth(AUTH_ALL, $forum_id, $userdata);
if ( !$is_auth['auth_mod'] ) {
    message_die(GENERAL_MESSAGE, $lang['Not_Moderator'], $lang['Not_Authorised']);
}
// End Auth Check

// Do major work ...
switch( $mode ) {
    case 'delete':
        if (!$is_auth['auth_delete']) {
            message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_auth_delete'], $is_auth['auth_delete_type']));
        }
        $page_title = $lang['Mod_CP'];
        include_once(NUKE_INCLUDE_DIR.'page_header.php');
        if ( $confirm ) {
            if ( !is_array($topics) && empty($topic_id) ) {
                message_die(GENERAL_MESSAGE, $lang['None_selected']);
            }
            include_once(NUKE_INCLUDE_DIR.'functions_search.php');
            $topic_id_sql = '';
            for($i = 0; $i < count($topics); $i++) {
                $topic_id_sql .= ( ( !empty($topic_id_sql) ) ? ', ' : '' ) . intval($topics[$i]);
            }
            $sql = "SELECT topic_id 
                    FROM " . TOPICS_TABLE . "
                    WHERE topic_id IN ($topic_id_sql)
                    AND forum_id = '$forum_id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get topic id information', '', __LINE__, __FILE__, $sql);
            }
              
            $topic_id_sql = '';
            while ($row = $db->sql_fetchrow($result)) {
                $topic_id_sql .= ((!empty($topic_id_sql)) ? ', ' : '') . intval($row['topic_id']);
            }
            $db->sql_freeresult($result);

            if ( $topic_id_sql == '') {
                message_die(GENERAL_MESSAGE, $lang['None_selected']);
            }
            $sql = "SELECT poster_id, COUNT(post_id) AS posts
                    FROM " . POSTS_TABLE . "
                    WHERE topic_id IN ($topic_id_sql)
                    GROUP BY poster_id";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get poster id information', '', __LINE__, __FILE__, $sql);
            }

            $count_sql = array();
            $user_updated = array();
            while ( $row = $db->sql_fetchrow($result) ) {
                $count_sql[] = "UPDATE ".USERS_TABLE."
                                SET user_posts = user_posts - " . $row['posts'] . "
                                WHERE user_id = " . $row['poster_id'];
                $user_updated [] = "SELECT ug.user_id, g.group_id as g_id, u.user_posts, g.group_count, g.group_count_max, ".$row['poster_id']." as u_id 
                                FROM ((" . GROUPS_TABLE . " g, ".USERS_TABLE." u)
                                LEFT JOIN ". USER_GROUP_TABLE." ug ON g.group_id=ug.group_id AND ug.user_id=".$row['poster_id'].")
                                WHERE u.user_id=".$row['poster_id']."
                                AND g.group_single_user=0
                                AND g.group_count_enable=1
                                AND g.group_moderator<>".$row['poster_id'];
            }
            $db->sql_freeresult($result);

            if ( count($count_sql) ) {
                for($i = 0; $i < count($count_sql); $i++) {
                    if ( !$db->sql_query($count_sql[$i]) ) {
                        message_die(GENERAL_ERROR, 'Could not update user post count information', '', __LINE__, __FILE__, $sql);
                    }
                }
            }

            if ( sizeof($user_updated) ) {
                for($i = 0; $i < sizeof($user_updated); $i++) {
                    if ( !($result = $db->sql_query($user_updated[$i])) ) {
                        message_die(GENERAL_ERROR, 'Error geting users post stat', '', __LINE__, __FILE__, $user_updated[$i]);
                    }
                    while ($group_data = $db->sql_fetchrow($result)) {
                        $user_already_added = (!empty($group_data['user_id']) || $group_data['u_id']==ANONYMOUS) ? TRUE : FALSE;
                        $user_add = ($group_data['group_count'] == $group_data['user_posts'] && $group_data['u_id']!=ANONYMOUS) ? TRUE : FALSE;
                        $user_remove = ($group_data['group_count'] > $group_data['user_posts'] && $group_data['u_id']!=ANONYMOUS) ? TRUE : FALSE;
                        if ($user_add && !$user_already_added) {
                            //user join a autogroup
                            $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                                    VALUES (".$group_data['g_id'].", ".$group_data['u_id'].", '0')";
                            if ( !($db->sql_query($sql)) ) {
                                message_die(GENERAL_ERROR, 'Error insert users, group count', '', __LINE__, __FILE__, $sql);
                            }
                        } else if ( $user_already_added && $user_remove) {
                            //remove user from autogroup
                            $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                                    WHERE group_id=".$group_data['g_id']." 
                                    AND user_id=".$group_data['u_id'];
                            if ( !($db->sql_query($sql)) ) {
                                message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);
                            }
                        }
                        unset ($group_data);
                    }
                    $db->sql_freeresult($result);
                    }
            }
            $sql = "SELECT post_id
                    FROM " . POSTS_TABLE . "
                    WHERE topic_id IN ($topic_id_sql)";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get post id information', '', __LINE__, __FILE__, $sql);
            }

            $post_id_sql = '';
            while ( $row = $db->sql_fetchrow($result) ) {
                $post_id_sql .= ( ( !empty($post_id_sql) ) ? ', ' : '' ) . intval($row['post_id']);
            }
            $db->sql_freeresult($result);

            $sql = "SELECT vote_id
                    FROM " . VOTE_DESC_TABLE . "
                    WHERE topic_id IN ($topic_id_sql)";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get vote id information', '', __LINE__, __FILE__, $sql);
            }

            $vote_id_sql = '';
            while ( $row = $db->sql_fetchrow($result) ) {
                $vote_id_sql .= ( ( !empty($vote_id_sql) ) ? ', ' : '' ) . $row['vote_id'];
            }
            $db->sql_freeresult($result);

            // Got all required info so go ahead and start deleting everything
            $sql = "DELETE
                    FROM " . TOPICS_TABLE . "
                    WHERE topic_id IN ($topic_id_sql)
                    OR topic_moved_id IN ($topic_id_sql)";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not delete topics', '', __LINE__, __FILE__, $sql);
            }

            if ( !empty($post_id_sql) ) {
                $sql = "DELETE
                        FROM " . POSTS_TABLE . "
                        WHERE post_id IN ($post_id_sql)";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete posts', '', __LINE__, __FILE__, $sql);
                }
                log_action('delete', 0, $topic_id_sql, $userdata['user_id'], 0, 0);

                $sql = "DELETE
                        FROM " . POSTS_TEXT_TABLE . "
                        WHERE post_id IN ($post_id_sql)";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete posts text', '', __LINE__, __FILE__, $sql);
                }
                remove_search_post($post_id_sql);
                delete_attachment(explode(', ', $post_id_sql));
            }

            if ( !empty($vote_id_sql) ) {
                $sql = "DELETE
                        FROM " . VOTE_DESC_TABLE . "
                        WHERE vote_id IN ($vote_id_sql)";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete vote descriptions', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE
                        FROM " . VOTE_RESULTS_TABLE . "
                        WHERE vote_id IN ($vote_id_sql)";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete vote results', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE
                        FROM " . VOTE_USERS_TABLE . "
                        WHERE vote_id IN ($vote_id_sql)";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete vote users', '', __LINE__, __FILE__, $sql);
                }
            }

            $sql = "DELETE
                    FROM " . TOPICS_WATCH_TABLE . "
                    WHERE topic_id IN ($topic_id_sql)";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not delete watched post list', '', __LINE__, __FILE__, $sql);
            }

            sync('forum', $forum_id);
      
            if ( !empty($topic_id) ) {
                $redirect_page = append_sid('viewforum.php?' . POST_FORUM_URL . '='.$forum_id);
                $l_redirect = sprintf($lang['Click_return_forum'], '<a href="' . $redirect_page . '">', '</a>');
            } else {
                $redirect_page = append_sid('modcp.php?' . POST_FORUM_URL . '='.$forum_id);
                $l_redirect = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
            }

            $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '" />'
                )
            );

            message_die(GENERAL_MESSAGE, $lang['Topics_Removed'] . '<br /><br />' . $l_redirect);
        } else {
            // Not confirmed, show confirmation message
            if ( !is_array($topics) && empty($topic_id) ) {
                message_die(GENERAL_MESSAGE, $lang['None_selected']);
            }
            $hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';
            if ( is_array($topics) ) {
                for($i = 0; $i < count($topics); $i++) {
                    $hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($topics[$i]) . '" />';
                }
            } else {
                $hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
            }
            // Set template files
            $template->set_filenames(array(
                'confirm' => 'confirm_body.tpl'
                )
            );
            $template->assign_vars(array(
                'MESSAGE_TITLE'     => $lang['Confirm'],
                'MESSAGE_TEXT'      => $lang['Confirm_delete_topic'],
                'L_YES'             => $lang['Yes'],
                'L_NO'              => $lang['No'],
                'S_CONFIRM_ACTION'  => append_sid('modcp.php'),
                'S_HIDDEN_FIELDS'   => $hidden_fields
                )
            );
            $template->pparse('confirm');
        }
        break;
    case 'move':
        $page_title = $lang['Mod_CP'];
        include_once(NUKE_INCLUDE_DIR.'page_header.php');
        if ( $confirm ) {
            if ( !is_array($topics) && empty($topic_id) ) {
                message_die(GENERAL_MESSAGE, $lang['None_selected']);
            }
            if ($fid == 'Root') {
                $type = POST_CAT_URL;
                $new_forum_id = 0;
            } else {
                $type = substr($fid, 0, 1);
                $new_forum_id = ($type == POST_FORUM_URL) ? intval(substr($fid, 1)) : 0;
            }
            if ($new_forum_id <= 0 ) {
                message_die(GENERAL_MESSAGE, $lang['Forum_not_exist']);
            }

            $old_forum_id = $forum_id;
            $sql = 'SELECT forum_id FROM ' . FORUMS_TABLE . ' 
                    WHERE forum_id = ' . $new_forum_id; 
            if ( !($result = $db->sql_query($sql)) ) { 
                message_die(GENERAL_ERROR, 'Could not select from forums table', '', __LINE__, __FILE__, $sql); 
            } 
            if (!$db->sql_fetchrow($result))  { 
                message_die(GENERAL_MESSAGE, 'New forum does not exist'); 
            } 
            $db->sql_freeresult($result); 
            if ( $new_forum_id != $old_forum_id ) {
                $topic_list = '';
                for($i = 0; $i < count($topics); $i++) {
                    $topic_list .= ( ( !empty($topic_list) ) ? ', ' : '' ) . intval($topics[$i]);
                }
                $sql = "SELECT *
                        FROM " . TOPICS_TABLE . "
                        WHERE topic_id IN ($topic_list)
                        AND forum_id = '$old_forum_id'
                        AND topic_status <> " . TOPIC_MOVED;
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not select from topic table', '', __LINE__, __FILE__, $sql);
                }
                $row = $db->sql_fetchrowset($result);
                $db->sql_freeresult($result);
                for($i = 0; $i < count($row); $i++) {
                    $topic_id = $row[$i]['topic_id'];
                    if ( $move_leave_shadow ) {
                        // Insert topic in the old forum that indicates that the forum has moved.
                        $sql = "INSERT INTO " . TOPICS_TABLE . " (forum_id, topic_title, topic_poster, topic_time, topic_status, topic_type, topic_vote, topic_views, topic_replies, topic_first_post_id, topic_last_post_id, topic_moved_id)
                                VALUES ('$old_forum_id', '" . addslashes(str_replace("\'", "''", $row[$i]['topic_title'])) . "', '" . str_replace("\'", "''", $row[$i]['topic_poster']) . "', " . $row[$i]['topic_time'] . ", " . TOPIC_MOVED . ", " . POST_NORMAL . ", " . $row[$i]['topic_vote'] . ", " . $row[$i]['topic_views'] . ", " . $row[$i]['topic_replies'] . ", " . $row[$i]['topic_first_post_id'] . ", " . $row[$i]['topic_last_post_id'] . ", '$topic_id')";
                        if ( !$db->sql_query($sql) ) {
                            message_die(GENERAL_ERROR, 'Could not insert shadow topic', '', __LINE__, __FILE__, $sql);
                        }
                    }
                    log_action('move', 0, $topic_id, $userdata['user_id'], $old_forum_id, $new_forum_id);
 
                    $sql = "UPDATE " . TOPICS_TABLE . "
                            SET forum_id = '$new_forum_id'
                            WHERE topic_id = '$topic_id'";
                    if ( !$db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not update old topic', '', __LINE__, __FILE__, $sql);
                    }

                    $sql = "UPDATE " . POSTS_TABLE . "
                            SET forum_id = '$new_forum_id'
                            WHERE topic_id = '$topic_id'";
                    if ( !$db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not update post topic ids', '', __LINE__, __FILE__, $sql);
                    }
                }
                // Sync the forum indexes
                sync('forum', $new_forum_id);
                sync('forum', $old_forum_id);

                $message = $lang['Topics_Moved'] . '<br /><br />';
            } else {
                $message = $lang['No_Topics_Moved'] . '<br /><br />';
            }
            if ( !empty($topic_id) ) {
                $redirect_page = append_sid('viewtopic.php?' . POST_TOPIC_URL . '='.$topic_id);
                $message .= sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
            } else {
                $redirect_page = append_sid('modcp.php?' . POST_FORUM_URL . '='.$forum_id);
                $message .= sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
            }
            $message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.php?" . POST_FORUM_URL . "=$old_forum_id") . '">', '</a>');
            $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '" />')
            );
            message_die(GENERAL_MESSAGE, $message);
        } else {
            if ( !is_array($topics) && empty($topic_id) ) {
                message_die(GENERAL_MESSAGE, $lang['None_selected']);
            }
            $hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

            if ( is_array($topics) ) {
                for($i = 0; $i < count($topics); $i++) {
                    $hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($topics[$i]) . '" />';
                }
            } else {
                $hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
            }

            // Set template files
            $template->set_filenames(array(
                'movetopic' => 'modcp_move.tpl'
                )
            );
            $template->assign_vars(array(
                'MESSAGE_TITLE'     => $lang['Confirm'],
                'MESSAGE_TEXT'      => $lang['Confirm_move_topic'],
                'L_MOVE_TO_FORUM'   => $lang['Move_to_forum'],
                'L_LEAVESHADOW'     => $lang['Leave_shadow_topic'],
                'L_YES'             => $lang['Yes'],
                'L_NO'              => $lang['No'],
                'S_FORUM_SELECT'    => selectbox('new_forum', $forum_id),
                'S_MODCP_ACTION'    => append_sid('modcp.php'),
                'S_HIDDEN_FIELDS'   => $hidden_fields
                )
            );
            $template->pparse('movetopic');
        }
        break;
    case 'lock':
        if ( !is_array($topics) && empty($topic_id) ) {
            message_die(GENERAL_MESSAGE, $lang['None_selected']);
        }
        $topic_id_sql = '';
        for($i = 0; $i < count($topics); $i++) {
            $topic_id_sql .= ( ( !empty($topic_id_sql) ) ? ', ' : '' ) . intval($topics[$i]);
        }
        log_action('lock', 0, $topic_id_sql, $userdata['user_id'], 0, 0);

        $sql = "UPDATE " . TOPICS_TABLE . "
                SET topic_status = " . TOPIC_LOCKED . "
                WHERE topic_id IN ($topic_id_sql)
                AND forum_id = '$forum_id'
                AND topic_moved_id = '0'";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
        }
        if ( !empty($topic_id) ) {
            $redirect_page = append_sid('viewtopic.php?' . POST_TOPIC_URL . '='.$topic_id);
            $message = sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
        } else {
            $redirect_page = append_sid('modcp.php?' . POST_FORUM_URL . '='.$forum_id);
            $message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
        }
        $message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.php?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '" />'
            )
        );
        message_die(GENERAL_MESSAGE, $lang['Topics_Locked'] . '<br /><br />' . $message);
        break;
    case 'unlock':
        if ( !is_array($topics) && empty($topic_id) ) {
            message_die(GENERAL_MESSAGE, $lang['None_selected']);
        }
        $topic_id_sql = '';
        for($i = 0; $i < count($topics); $i++) {
            $topic_id_sql .= ( ( !empty($topic_id_sql) ) ? ', ' : '' ) . intval($topics[$i]);
        }

        $sql = "UPDATE " . TOPICS_TABLE . "
                SET topic_status = " . TOPIC_UNLOCKED . "
                WHERE topic_id IN ($topic_id_sql)
                AND forum_id = '$forum_id'
                AND topic_moved_id = '0'";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
        }
        log_action('unlock', 0, $topic_id_sql, $userdata['user_id'], 0, 0);
        if ( !empty($topic_id) ) {
            $redirect_page = append_sid('viewtopic.php?' . POST_TOPIC_URL . '='.$topic_id);
            $message = sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
        } else {
            $redirect_page = append_sid('modcp.php?' . POST_FORUM_URL . '='.$forum_id);
            $message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
        }
        $message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.php?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '" />')
        );
        message_die(GENERAL_MESSAGE, $lang['Topics_Unlocked'] . '<br /><br />' . $message);
        break;
    case 'split':
        $page_title = $lang['Mod_CP'];
        include_once(NUKE_INCLUDE_DIR.'page_header.php');
        $post_id_sql = '';
        if ( $_GETVAR->get('split_type_all', 'post', 'string', NULL) || $_GETVAR->get('split_type_beyond', 'post', 'string', NULL) ) {
            if (!is_array($posts)) {
                message_die(GENERAL_MESSAGE, $lang['None_selected']);
            }
            for ($i = 0; $i < count($posts); $i++) {
                $post_id_sql .= ((!empty($post_id_sql)) ? ', ' : '') . intval($posts[$i]);
            }
        }
        if (!empty($post_id_sql)) {
            $sql = "SELECT post_id 
                   FROM " . POSTS_TABLE . "
                   WHERE post_id IN ($post_id_sql)
                   AND forum_id = '$forum_id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get post id information', '', __LINE__, __FILE__, $sql);
            }
            $post_id_sql = '';
            while ($row = $db->sql_fetchrow($result)) {
                $post_id_sql .= ((!empty($post_id_sql)) ? ', ' : '') . intval($row['post_id']);
            }
            $db->sql_freeresult($result);
            if ($post_id_sql == '') {
                message_die(GENERAL_MESSAGE, $lang['None_selected']);
            }
            $sql = "SELECT post_id, poster_id, topic_id, post_time
                    FROM " . POSTS_TABLE . "
                    WHERE post_id IN ($post_id_sql)
                    ORDER BY post_time ASC";
            if (!($result = $db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Could not get post information', '', __LINE__, __FILE__, $sql);
            }
            if ($row = $db->sql_fetchrow($result)) {
                $first_poster = $row['poster_id'];
                $topic_id = $row['topic_id'];
                $post_time = $row['post_time'];
                $user_id_sql = '';
                $post_id_sql = '';
                do {
                    $user_id_sql .= ((!empty($user_id_sql)) ? ', ' : '') . intval($row['poster_id']);
                    $post_id_sql .= (($post_id_sql != '') ? ', ' : '') . intval($row['post_id']);
                    $post_id_sql .= ((!empty($post_id_sql)) ? ', ' : '') . intval($row['post_id']);
                } while ($row = $db->sql_fetchrow($result));
                $post_subject = trim(htmlspecialchars($_GETVAR->get('subject', 'post', 'string', NULL)));
                if (empty($post_subject)) {
                    message_die(GENERAL_MESSAGE, $lang['Empty_subject']);
                }
                if ($fid == 'Root') {
                    $type = POST_CAT_URL;
                    $new_forum_id = 0;
                } else {
                    $type = substr($fid, 0, 1);
                    $new_forum_id = ($type == POST_FORUM_URL) ? intval(substr($fid, 1)) : 0;
                }
                if ($new_forum_id <= 0 ) {
                    message_die(GENERAL_MESSAGE, $lang['Forum_not_exist']);
                }
                $topic_time = time();
                $sql = 'SELECT forum_id FROM ' . FORUMS_TABLE . ' 
                        WHERE forum_id = ' . $new_forum_id; 
                if ( !($result = $db->sql_query($sql)) )  {
                    message_die(GENERAL_ERROR, 'Could not select from forums table', '', __LINE__, __FILE__, $sql); 
                } 
                if (!$db->sql_fetchrow($result)) {
                    message_die(GENERAL_MESSAGE, 'New forum does not exist'); 
                } 
                $db->sql_freeresult($result); 

                $sql  = "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type)
                         VALUES ('" . str_replace("\'", "''", $post_subject) . "', '$first_poster', " . $topic_time . ", '$new_forum_id', " . TOPIC_UNLOCKED . ", " . POST_NORMAL . ")";
                if (!($db->sql_query($sql))) {
                    message_die(GENERAL_ERROR, 'Could not insert new topic', '', __LINE__, __FILE__, $sql);
                }

                $new_topic_id = $db->sql_nextid();
                log_action('split', $new_topic_id, $topic_id, $userdata['user_id'], $forum_id, 0);

                // Update topic watch table, switch users whose posts
                // have moved, over to watching the new topic
                $sql = "UPDATE " . TOPICS_WATCH_TABLE . "
                        SET topic_id = '$new_topic_id'
                        WHERE topic_id = '$topic_id'
                        AND user_id IN ($user_id_sql)";
                if (!$db->sql_query($sql)) {
                    message_die(GENERAL_ERROR, 'Could not update topics watch table', '', __LINE__, __FILE__, $sql);
                }

                $sql_where = $_GETVAR->get('split_type_beyond', 'post', 'string', NULL) ? " post_time >= '$post_time' AND topic_id = '$topic_id'" : "post_id IN ($post_id_sql)";
                $sql = "UPDATE " . POSTS_TABLE . "
                        SET topic_id = '$new_topic_id', forum_id = '$new_forum_id'
                        WHERE $sql_where";
                if (!$db->sql_query($sql)) {
                    message_die(GENERAL_ERROR, 'Could not update posts table', '', __LINE__, __FILE__, $sql);
                }

                sync('topic', $new_topic_id);
                sync('topic', $topic_id);
                sync('forum', $new_forum_id);
                sync('forum', $forum_id);

                $template->assign_vars(array(
                    'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id") . '" />')
                );
                $message = $lang['Topic_split'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
                message_die(GENERAL_MESSAGE, $message);
            }
        } else {
            // Set template files
            $template->set_filenames(array(
                'split_body' => 'modcp_split.tpl')
            );
            $sql = "SELECT u.username, p.*, pt.post_text, pt.bbcode_uid, pt.post_subject, p.post_username
                    FROM (" . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt)
                    WHERE p.topic_id = '$topic_id'
                    AND p.poster_id = u.user_id
                    AND p.post_id = pt.post_id
                    ORDER BY p.post_time ASC";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get topic/post information', '', __LINE__, __FILE__, $sql);
            }

            $s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" /><input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" /><input type="hidden" name="mode" value="split" />';
            if( ( $total_posts = $db->sql_numrows($result) ) > 0 ) {
                $postrow = $db->sql_fetchrowset($result);
                $db->sql_freeresult($result);
                $template->assign_vars(array(
                    'L_SPLIT_TOPIC'         => $lang['Split_Topic'],
                    'L_SPLIT_TOPIC_EXPLAIN' => $lang['Split_Topic_explain'],
                    'L_AUTHOR'              => $lang['Author'],
                    'L_MESSAGE'             => $lang['Message'],
                    'L_SELECT'              => $lang['Select'],
                    'L_SPLIT_SUBJECT'       => $lang['Split_title'],
                    'L_SPLIT_FORUM'         => $lang['Split_forum'],
                    'L_POSTED'              => $lang['Posted'],
                    'L_SPLIT_POSTS'         => $lang['Split_posts'],
                    'L_SUBMIT'              => $lang['Submit'],
                    'L_SPLIT_AFTER'         => $lang['Split_after'],
                    'L_POST_SUBJECT'        => $lang['Post_subject'],
                    'L_MARK_ALL'            => $lang['Mark_all'],
                    'L_UNMARK_ALL'          => $lang['Unmark_all'],
                    'L_POST'                => $lang['Post'],
                    'MINIPOST_IMG'          => $images['icon_minipost'],
                    'SPACER_IMG'            => $images['spacer'],
                    'FORUM_NAME'            => $forum_name,
                    'U_VIEW_FORUM'          => append_sid('viewforum.php?' . POST_FORUM_URL . '='.$forum_id),
                    'S_SPLIT_ACTION'        => append_sid('modcp.php'),
                    'S_HIDDEN_FIELDS'       => $s_hidden_fields,
                    'S_FORUM_SELECT'        => selectbox('new_forum',FALSE, $forum_id)
                    )
                );
                // Define censored word matches
                $orig_word = array();
                $replacement_word = array();
                obtain_word_list($orig_word, $replacement_word);
                for($i = 0; $i < $total_posts; $i++) {
                    $post_id    = $postrow[$i]['post_id'];
                    $poster_id  = $postrow[$i]['poster_id'];
                    $poster     = UsernameColor($postrow[$i]['username']);
                    $post_date  = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);
                    $bbcode_uid = $postrow[$i]['bbcode_uid'];
                    $message    = $postrow[$i]['post_text'];
                    $post_subject = ( !empty($postrow[$i]['post_subject']) ) ? $postrow[$i]['post_subject'] : $topic_title;
                    // If the board has HTML off but the post has HTML
                    // on then we process it, else leave it alone
                    if ( !$board_config['allow_html'] ) {
                        if ( $postrow[$i]['enable_html'] ) {
                            $message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\\2&gt;', $message);
                        }
                    }
                    if ( !empty($bbcode_uid) ) {
                        $message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
                    }
                    if ( count($orig_word) ) {
                        $post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
                        $message = preg_replace($orig_word, $replacement_word, $message);
                    }
                    $message = make_clickable($message);
                    if ( $board_config['allow_smilies'] && $postrow[$i]['enable_smilies'] ) {
                        $message = smilies_pass($message);
                    }
                    $message = str_replace("\n", '<br />', $message);
                    $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                    $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
                    $checkbox = ( $i > 0 ) ? '<input type="checkbox" name="post_id_list[]" value="' . $post_id . '" />' : '&nbsp;';
                    $template->assign_block_vars('postrow', array(
                        'ROW_COLOR'     => '#' . $row_color,
                        'ROW_CLASS'     => $row_class,
                        'POSTER_NAME'   => UsernameColor($poster),
                        'POST_DATE'     => $post_date,
                        'POST_SUBJECT'  => $post_subject,
                        'MESSAGE'       => $message,
                        'POST_ID'       => $post_id,
                        'S_SPLIT_CHECKBOX' => $checkbox
                        )
                    );
                }
                $template->pparse('split_body');
            }
        }
        break;
    case 'ip':
        $page_title = $lang['Mod_CP'];
        include_once(NUKE_INCLUDE_DIR.'page_header.php');
        $rdns_ip_num = $_GETVAR->get('rdns', 'get', 'string', '');
        if ( !$post_id ) {
            message_die(GENERAL_MESSAGE, $lang['No_such_post']);
        }

        // Set template files
        $template->set_filenames(array(
            'viewip' => 'modcp_viewip.tpl'
            )
        );

        // Look up relevent data for this post
        $sql = "SELECT poster_ip, poster_id
                FROM " . POSTS_TABLE . "
                WHERE post_id = '$post_id'
                AND forum_id = '$forum_id'";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not get poster IP information', '', __LINE__, __FILE__, $sql);
        }
        if ( !($post_row = $db->sql_fetchrow($result)) ) {
            message_die(GENERAL_MESSAGE, $lang['No_such_post']);
        }
        $db->sql_freeresult($result);

        $ip_this_post = decode_ip($post_row['poster_ip']);
        $ip_this_post = ( $rdns_ip_num == $ip_this_post ) ? htmlspecialchars(gethostbyaddr($ip_this_post)) : $ip_this_post;
        $poster_id = $post_row['poster_id'];

        $template->assign_vars(array(
            'L_IP_INFO'     => $lang['IP_info'],
            'L_THIS_POST_IP'=> $lang['This_posts_IP'],
            'L_OTHER_IPS'   => $lang['Other_IP_this_user'],
            'L_OTHER_USERS' => $lang['Users_this_IP'],
            'L_LOOKUP_IP'   => $lang['Lookup_IP'],
            'L_SEARCH'      => $lang['Search'],
            'SEARCH_IMG'    => $images['icon_search'],
            'IP'            => $ip_this_post,
            'U_LOOKUP_IP'   => append_sid('modcp.php?mode=ip&amp;' . POST_POST_URL . '='.$post_id.'&amp;' . POST_TOPIC_URL . '='.$topic_id.'&amp;rdns=' . $ip_this_post)
            )
        );
        // Get other IP's this user has posted under
        $sql = "SELECT poster_ip, COUNT(*) AS postings
                FROM " . POSTS_TABLE . "
                WHERE poster_id = '$poster_id'
                GROUP BY poster_ip
                ORDER BY postings DESC";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not get IP information for this user', '', __LINE__, __FILE__, $sql);
        }
        if ( $row = $db->sql_fetchrow($result) ) {
            $i = 0;
            do {
                if ( $row['poster_ip'] == $post_row['poster_ip'] ) {
                    $template->assign_vars(array(
                        'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ))
                    );
                    continue;
                }
                $ip = decode_ip($row['poster_ip']);
                $ip = ( $rdns_ip_num == $row['poster_ip'] || $rdns_ip_num == 'all') ? htmlspecialchars(gethostbyaddr($ip)) : $ip;
                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                $template->assign_block_vars('iprow', array(
                    'ROW_COLOR'     => '#' . $row_color,
                    'ROW_CLASS'     => $row_class,
                    'IP'            => $ip,
                    'POSTS'         => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ),
                    'U_LOOKUP_IP'   => append_sid('modcp.php?mode=ip&amp;' . POST_POST_URL . '='.$post_id.'&amp;' . POST_TOPIC_URL . '='.$topic_id.'&amp;rdns=' . $row['poster_ip']))
                );
                $i++;
            } while ( $row = $db->sql_fetchrow($result) );
        }
        $db->sql_freeresult($result);
        // Get other users who've posted under this IP
        $sql = "SELECT u.user_id, u.username, COUNT(*) as postings
                FROM (" . USERS_TABLE ." u, " . POSTS_TABLE . " p)
                WHERE p.poster_id = u.user_id
                AND p.poster_ip = '" . $post_row['poster_ip'] . "'
                GROUP BY u.user_id, u.username
                ORDER BY postings DESC";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not get posters information based on IP', '', __LINE__, __FILE__, $sql);
        }
        if ( $row = $db->sql_fetchrow($result) ) {
            $i = 0;
            do {
                $id = $row['user_id'];
                $username = ( $id == ANONYMOUS ) ? $lang['Guest'] : $row['username'];
                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                $template->assign_block_vars('userrow', array(
                    'ROW_COLOR' => '#' . $row_color,
                    'ROW_CLASS' => $row_class,
                    'USERNAME' => $username,
                    'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ),
                    'L_SEARCH_POSTS' => sprintf($lang['Search_user_posts'], $username),
                    'U_PROFILE' => append_sid('profile.php?mode=viewprofile&amp;' . POST_USERS_URL . '='.$id),
                    'U_SEARCHPOSTS' => append_sid('search.php?search_author=' . (($id == ANONYMOUS) ? 'Anonymous' : urlencode($username)) . '&amp;showresults=topics'))
                );
                $i++;
            } while ( $row = $db->sql_fetchrow($result) );
        }
        $db->sql_freeresult($result);
        $template->pparse('viewip');
        break;
    case 'cement':
        if ( !is_array($topics) && empty($topic_id) ) {
            message_die(GENERAL_MESSAGE, $lang['None_selected']);
        }
        for($i = 0; $i < count($topics); $i++) {
            $priority_box_id = "topic_cement:" . intval($topics[$i]);
            $topic_priority = $_GETVAR->get($priority_box_id, 'post', 'int', 0);
            $sql = "UPDATE " . TOPICS_TABLE . " 
                    SET topic_priority = $topic_priority
                    WHERE topic_id = ".$topics[$i];
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
            }
        }
        if ( !empty($topic_id) ) {
            $redirect_page = append_sid('viewtopic.php?' . POST_TOPIC_URL . '='.$topic_id);
            $message = sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
        } else {
            $redirect_page = append_sid('modcp.php?' . POST_FORUM_URL . '='.$forum_id);
            $message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
        }
        $message .= '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewtopic.php?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '" />')
        );
        message_die(GENERAL_MESSAGE, $lang['Topics_Prioritized'] . '<br /><br />' . $message);
        break;
    default:
        $page_title = $lang['Mod_CP'];
        include_once(NUKE_INCLUDE_DIR.'page_header.php');
        $template->assign_vars(array(
            'FORUM_NAME'        => $forum_name,
            'L_MOD_CP'          => $lang['Mod_CP'],
            'L_MOD_CP_EXPLAIN'  => $lang['Mod_CP_explain'],
            'L_SELECT'          => $lang['Select'],
            'L_PRIORITY'        => $lang['Priority'], 
            'L_PRIORITIZE'      => $lang['Prioritize'], 
            'L_DELETE'          => $lang['Delete'],
            'L_MOVE'            => $lang['Move'],
            'L_LOCK'            => $lang['Lock'],
            'L_UNLOCK'          => $lang['Unlock'],
            'L_TOPICS'          => $lang['Topics'],
            'L_REPLIES'         => $lang['Replies'],
            'L_LASTPOST'        => $lang['Last_Post'],
            'L_SELECT'          => $lang['Select'],
            'U_VIEW_FORUM'      => append_sid('viewforum.php?' . POST_FORUM_URL . '='.$forum_id),
            'S_HIDDEN_FIELDS'   => '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />',
            'S_MODCP_ACTION'    => append_sid('modcp.php')
            )
        );
        $template->set_filenames(array(
            'body' => 'modcp_body.tpl')
        );
        make_jumpbox('modcp.php');

        // Define censored word matches
        $orig_word = array();
        $replacement_word = array();
        obtain_word_list($orig_word, $replacement_word);

        $sql = "SELECT t.*, u.username, u.user_id, p.post_time
                FROM (" . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p)
                WHERE t.forum_id = '$forum_id'
                AND t.topic_poster = u.user_id
                AND p.post_id = t.topic_last_post_id
                ORDER BY t.topic_type DESC, t.topic_priority DESC, p.post_time DESC
                LIMIT $start, " . $board_config['topics_per_page'];
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
        }

        while ( $row = $db->sql_fetchrow($result) ) {
            $topic_title = '';
            if ( $row['topic_status'] == TOPIC_LOCKED ) {
                $folder_img = $images['folder_locked'];
                $folder_alt = $lang['Topic_locked'];
            } else {
                if ( $row['topic_type'] == POST_GLOBAL_ANNOUNCE ) {
                    $folder_img = $images['folder_global_announce'];
                    $folder_alt = $lang['Global_announcement'];
                } else if ( $row['topic_type'] == POST_ANNOUNCE ) {
                    $folder_img = $images['folder_announce'];
                    $folder_alt = $lang['Topic_Announcement'];
                } else if ( $row['topic_type'] == POST_STICKY ) {
                    $folder_img = $images['folder_sticky'];
                    $folder_alt = $lang['Topic_Sticky'];
                } else {
                    $folder_img = $images['folder'];
                    $folder_alt = $lang['No_new_posts'];
                }
            }
            $topic_id       = $row['topic_id'];
            $topic_type     = $row['topic_type'];
            $topic_status   = $row['topic_status'];
            $topic_priority = $row['topic_priority'];
            if ( $topic_type == POST_GLOBAL_ANNOUNCE ) {
                $topic_type = $lang['Topic_global_announcement'] . ' ';
            } else if ( $topic_type == POST_ANNOUNCE ) {
                $topic_type = $lang['Topic_Announcement'] . ' ';
            } else if ( $topic_type == POST_STICKY ) {
                $topic_type = $lang['Topic_Sticky'] . ' ';
            } else if ( $topic_status == TOPIC_MOVED ) {
                $topic_type = $lang['Topic_Moved'] . ' ';
            } else {
                $topic_type = '';
            }
            if ( $row['topic_vote'] ) {
                $topic_type .= $lang['Topic_Poll'] . ' ';
            }
            $topic_title = ($board_config['smilies_in_titles']) ? smilies_pass($row['topic_title']) : $row['topic_title'];
            if ( count($orig_word) ) {
                $topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
            }
            $u_view_topic   = append_sid('modcp.php?mode=split&amp;' . POST_TOPIC_URL . '='.$topic_id);
            $topic_replies  = $row['topic_replies'];
            $last_post_time = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']);

            $template->assign_block_vars('topicrow', array(
                'U_VIEW_TOPIC'          => $u_view_topic,
                'TOPIC_FOLDER_IMG'      => $folder_img,
                'TOPIC_TYPE'            => $topic_type,
                'TOPIC_TITLE'           => $topic_title,
                'REPLIES'               => $topic_replies,
                'LAST_POST_TIME'        => $last_post_time,
                'TOPIC_ID'              => $topic_id,
                'TOPIC_PRIORITY'        => $topic_priority,
                'TOPIC_ATTACHMENT_IMG'  => topic_attachment_image($row['topic_attachment']),
                'L_TOPIC_FOLDER_ALT'    => $folder_alt
                )
            );
        }
        $template->assign_vars(array(
            'PAGINATION'  => generate_pagination("modcp.php?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'], $forum_topics, $board_config['topics_per_page'], $start),
            'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $forum_topics / $board_config['topics_per_page'] )),
            'L_GOTO_PAGE' => $lang['Goto_page']
            )
        );
        $template->pparse('body');
        break;
}
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>