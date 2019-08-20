<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   BASIC
 Nuke-Evo Version       :   2.1.0
 Nuke-Evo Build         :   1930
 Nuke-Evo Patch         :   0
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   07-08-2010

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

//
// Check and set various parameters
//
$post_id      = $_GETVAR->get(POST_POST_URL, '_REQUEST', 'int', 0);
$topic_id     = $_GETVAR->get(POST_TOPIC_URL, '_REQUEST', 'int', 0);
$forum_id     = $_GETVAR->get(POST_FORUM_URL, '_REQUEST', 'int', 0);

$submit       = $_GETVAR->get('post', 'post', 'string', NULL) ? TRUE : FALSE;
$preview      = $_GETVAR->get('preview', 'post', 'string', NULL) ? TRUE : FALSE;
$delete       = $_GETVAR->get('delete', 'post', 'string', NULL) ? TRUE : FALSE;
$poll_delete  = $_GETVAR->get('poll_delete', 'post', 'string', NULL) ? TRUE : FALSE;
$poll_add     = $_GETVAR->get('add_poll_option', 'post', 'string', NULL) ? TRUE : FALSE;
$poll_edit    = $_GETVAR->get('edit_poll_option', 'post', 'string', NULL) ? TRUE : FALSE;
$confirm      = $_GETVAR->get('confirm', 'post', 'string', NULL) ? TRUE : FALSE;
$sid          = $_GETVAR->get('sid', 'post', 'string', 0);
$refresh      = $preview || $poll_add || $poll_edit || $poll_delete;
$mode         = ($delete && !$preview && !$refresh && $submit) ? 'delete' : $_GETVAR->get('mode', '_REQUEST', 'string');
$post_icon    = $_GETVAR->get('post_icon', 'post', 'int', 0);
$orig_word    = $replacement_word = array();
$del_poll_option = $_GETVAR->get('del_poll_option', 'post', 'array');

//
// Set topic type
//
$topic_type = $_GETVAR->get('topictype', 'post', 'int', POST_NORMAL);
$topic_type = ( in_array($topic_type, array(POST_NORMAL, POST_STICKY, POST_ANNOUNCE, POST_GLOBAL_ANNOUNCE)) ) ? $topic_type : POST_NORMAL;
include_once($phpbb_root_path . 'common.php');
include_once(NUKE_INCLUDE_DIR.'bbcode.php');
include_once(NUKE_INCLUDE_DIR.'functions_post.php');

//
// If the mode is set to topic review then output
// that review ...
//
if ( $mode == 'topicreview' ) {
    include_once(NUKE_INCLUDE_DIR.'page_header_review.php');
    require_once(NUKE_INCLUDE_DIR.'topic_review.php');
    topic_review($topic_id, FALSE);
    include_once(NUKE_INCLUDE_DIR.'page_tail_review.php');
} else if ( $mode == 'smilies' ) {
    generate_smilies('window', PAGE_POSTING);
}
include_once(NUKE_INCLUDE_DIR.'functions_log.php');
include_once($phpbb_root_path . 'post_icon_mod/includes/def_icons.php');

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_POSTING);
init_userprefs($userdata);
//
// End session management
//

//
// Was cancel pressed? If so then redirect to the appropriate
// page, no point in continuing with any further checks
//
if ( $_GETVAR->get('cancel', 'post', 'string', NULL) ) {
    if ( $post_id ) {
        $redirect = 'viewtopic.php?' . POST_POST_URL . '='.$post_id;
        $post_append = "#P$post_id";
    } else if ( $topic_id ) {
        $redirect = 'viewtopic.php?' . POST_TOPIC_URL . '='.$topic_id;
        $post_append = '';
    } else if ( $forum_id ) {
        $redirect = 'viewforum.php?' . POST_FORUM_URL . '='.$forum_id;
        $post_append = '';
    } else {
        $redirect = 'index.php';
        $post_append = '';
    }
    redirect(append_sid($redirect, TRUE) . $post_append);
    exit;
}

//
// What auth type do we need to check?
//
$is_auth = array();
switch( $mode ) {
    case 'newtopic':
        if ( $topic_type == POST_GLOBAL_ANNOUNCE ) {
            $is_auth_type = 'auth_globalannounce';
        } else {
            if ( $topic_type == POST_ANNOUNCE ) {
                $is_auth_type = 'auth_announce';
            } else if ( $topic_type == POST_STICKY ) {
                $is_auth_type = 'auth_sticky';
            } else {
                $is_auth_type = 'auth_post';
            }
        }
            break;
    case 'reply':
    case 'quote':
            $is_auth_type = 'auth_reply';
            break;
    case 'editpost':
            $is_auth_type = 'auth_edit';
            break;
    case 'delete':
    case 'poll_delete':
            $is_auth_type = 'auth_delete';
            break;
    case 'vote':
            $is_auth_type = 'auth_vote';
            break;
    case 'topicreview':
            $is_auth_type = 'auth_read';
            break;
    default:
            message_die(GENERAL_MESSAGE, $lang['No_post_mode']);
            break;
}

//
// Here we do various lookups to find topic_id, forum_id, post_id etc.
// Doing it here prevents spoofing (eg. faking forum_id, topic_id or post_id
//
$error_msg = '';
$post_data = array();
switch ( $mode ) {
    case 'newtopic':
        if ( empty($forum_id) ) {
            message_die(GENERAL_MESSAGE, $lang['Forum_not_exist']);
        }
        $sql = "SELECT *
                FROM " . FORUMS_TABLE . "
                WHERE forum_id = '$forum_id'";
        break;
    case 'reply':
    case 'vote':
        if ( empty( $topic_id) ) {
            message_die(GENERAL_MESSAGE, $lang['No_topic_id']);
        }
        $sql = "SELECT f.*, t.topic_status, t.topic_title, t.topic_type
                FROM (" . FORUMS_TABLE . " f, " . TOPICS_TABLE . " t)
                WHERE t.topic_id = '$topic_id'
                AND f.forum_id = t.forum_id";
        break;
    case 'quote':
    case 'editpost':
    case 'delete':
    case 'poll_delete':
        if ( empty($post_id) ) {
            message_die(GENERAL_MESSAGE, $lang['No_post_id']);
        }
        $select_sql = (!$submit) ? ', t.topic_title, t.topic_icon, p.enable_bbcode, p.enable_html, p.enable_smilies, p.enable_sig, p.post_username, pt.post_subject, p.post_icon, pt.post_text, pt.bbcode_uid, u.username, u.user_id, u.user_sig, u.user_sig_bbcode_uid' : '';
        $from_sql = ( !$submit ) ? ", " . POSTS_TEXT_TABLE . " pt, " . USERS_TABLE . " u" : '';
        $where_sql = ( !$submit ) ? "AND pt.post_id = p.post_id AND u.user_id = p.poster_id" : '';
        $sql = "SELECT f.*, t.topic_id, t.topic_status, t.topic_glance_priority, t.topic_type, t.topic_first_post_id, t.topic_last_post_id, t.topic_vote, p.post_id, p.poster_id, p.post_time" . $select_sql . "
                FROM (" . POSTS_TABLE . " p, " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $from_sql . ")
                WHERE p.post_id = '$post_id'
                AND t.topic_id = p.topic_id
                AND f.forum_id = p.forum_id
                $where_sql";
        break;
    default:
        message_die(GENERAL_MESSAGE, $lang['No_valid_mode']);
}

if ( ($result = $db->sql_query($sql)) && ($post_info = $db->sql_fetchrow($result)) ) {
    $db->sql_freeresult($result);
    $forum_id    = $post_info['forum_id'];
    $forum_name  = $post_info['forum_name'];
    $topic_title = (isset($post_info['topic_title']) ? (($board_config['smilies_in_titles']) ? smilies_pass($post_info['topic_title']) : $post_info['topic_title']) : '');
    $forum_name  = get_object_lang(POST_FORUM_URL . $post_info['forum_id'], 'name');
    $is_auth     = auth(AUTH_ALL, $forum_id, $userdata, $post_info);
    $lock        = ($_GETVAR->get('lock', 'post', 'int') ? TRUE : FALSE);
    $unlock      = ($_GETVAR->get('unlock', 'post', 'int') ? TRUE : FALSE);

    if ( ($submit || $confirm) && ($lock || $unlock) && ($is_auth['auth_mod']) && ($mode != 'newtopic') && (!$refresh) ) {
        $t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];
        if ( $unlock ) {
            log_action($lang['Unlock'], '', $t_id, $userdata['user_id'], '', '');
            $sql = "UPDATE " . TOPICS_TABLE . "
            SET topic_status = " . TOPIC_UNLOCKED . "
            WHERE topic_id = " . $t_id . "
            AND topic_moved_id = 0";
        } else if ($lock) {
            log_action($lang['Lock'], '', $t_id, $userdata['user_id'], '', '');
                $sql = "UPDATE " . TOPICS_TABLE . "
                SET topic_status = " . TOPIC_LOCKED . "
                WHERE topic_id = " . $t_id . "
                AND topic_moved_id = 0";
        }
        if ($lock || $unlock) {
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, sprintf($lang['Could_not_update'], TOPICS_TABLE), '', __LINE__, __FILE__, $sql);
            }
        }
    }

    if ( $post_info['forum_status'] == FORUM_LOCKED && !$is_auth['auth_mod']) {
       message_die(GENERAL_MESSAGE, $lang['Forum_locked']);
    } else if ( $mode != 'newtopic' && $post_info['topic_status'] == TOPIC_LOCKED && !$is_auth['auth_mod']) {
       message_die(GENERAL_MESSAGE, $lang['Topic_locked']);
    }
    if ( $mode == 'editpost' || $mode == 'delete' || $mode == 'poll_delete' ) {
        $topic_id = $post_info['topic_id'];
        $post_data['poster_post'] = ( $post_info['poster_id'] == $userdata['user_id'] ) ? TRUE : FALSE;
        $post_data['first_post'] = ( $post_info['topic_first_post_id'] == $post_id ) ? TRUE : FALSE;
        $post_data['last_post'] = ( $post_info['topic_last_post_id'] == $post_id ) ? TRUE : FALSE;
        $post_data['last_topic'] = ( $post_info['forum_last_post_id'] == $post_id ) ? TRUE : FALSE;
        $post_data['has_poll'] = ( $post_info['topic_vote'] ) ? TRUE : FALSE;
        $post_data['topic_type'] = $post_info['topic_type'];
        $post_data['post_icon'] = (isset($post_info['post_icon']) ? $post_info['post_icon'] : '');
        $post_data['poster_id'] = $post_info['poster_id'];
        if ( $post_data['first_post'] && $post_data['has_poll'] )  {
            $sql = "SELECT *
                    FROM (" . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr)
                    WHERE vd.topic_id = '$topic_id'
                    AND vr.vote_id = vd.vote_id
                    ORDER BY vr.vote_option_id";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, sprintf($lang['Could_not_obtain'], 'vote data', 'this topic'), '', __LINE__, __FILE__, $sql);
            }
            $poll_options = array();
            $poll_results_sum = 0;
            if ( $row = $db->sql_fetchrow($result) ) {
                $poll_title = $row['vote_text'];
                $poll_id = $row['vote_id'];
                $poll_length = $row['vote_length'] / 86400;
                $poll_view_toggle = $row['poll_view_toggle'];
                do {
                    $poll_options[$row['vote_option_id']] = $row['vote_option_text'];
                    $poll_results_sum += $row['vote_result'];
                } while ( $row = $db->sql_fetchrow($result) );
            }
            $db->sql_freeresult($result);
            $post_data['edit_poll'] = ( ( !$poll_results_sum || $is_auth['auth_mod'] ) && $post_data['first_post'] ) ? TRUE : 0;
        } else {
            $post_data['edit_poll'] = ($post_data['first_post'] && $is_auth['auth_pollcreate']) ? TRUE : FALSE;
        }

        //
        // Can this user edit/delete the post/poll?
        //
        if ( $post_info['poster_id'] != $userdata['user_id'] && !$is_auth['auth_mod'] ) {
            $message = ( $delete || $mode == 'delete' ) ? $lang['Delete_own_posts'] : $lang['Edit_own_posts'];
            $message .= '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
            message_die(GENERAL_MESSAGE, $message);
        } else if ( !$post_data['last_post'] && !$is_auth['auth_mod'] && ( $mode == 'delete' || $delete ) ) {
            message_die(GENERAL_MESSAGE, $lang['Cannot_delete_replied']);
        } else if ( !$post_data['edit_poll'] && !$is_auth['auth_mod'] && ( $mode == 'poll_delete' || $poll_delete ) ) {
                message_die(GENERAL_MESSAGE, $lang['Cannot_delete_poll']);
        }
    } else {
        if ( $mode == 'quote' ) {
            $topic_id = $post_info['topic_id'];
        }
        if ( $mode == 'newtopic' ) {
            $post_data['topic_type'] = POST_NORMAL;
        }
        $post_data['first_post'] = ( $mode == 'newtopic' ) ? TRUE : 0;
        $post_data['last_post'] = FALSE;
        $post_data['has_poll'] = FALSE;
        $post_data['edit_poll'] = FALSE;
    }
    if ( $mode == 'poll_delete' && !isset($poll_id) ) {
        message_die(GENERAL_MESSAGE, $lang['No_such_post']);
    }
        /*--FNA #1--*/
} else {
    message_die(GENERAL_MESSAGE, $lang['No_such_post']);
}

//
// The user is not authed, if they're not logged in then redirect
// them, else show them an error message
//
if ( !$is_auth[$is_auth_type] ) {
    if ( is_user() ) {
        message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_' . $is_auth_type], $is_auth[$is_auth_type . "_type"]));
    }
    switch( $mode ) {
        case 'newtopic':
            $redirect = 'mode=newtopic&amp;' . POST_FORUM_URL . '=' . $forum_id;
            break;
        case 'reply':
        case 'topicreview':
            $redirect = 'mode=reply&amp;' . POST_TOPIC_URL . '=' . $topic_id;
            break;
        case 'quote':
        case 'editpost':
            $redirect = 'mode=quote&amp;' . POST_POST_URL . '=' . $post_id;
            break;
    }
    redirect('modules.php?name=Your_Account&amp;redirect=posting&amp;' . $redirect, TRUE);
    exit;
}

//
// Set toggles for various options
//
if ( !$board_config['allow_html'] ) {
    $html_on = 0;
} else {
    $html_on = ( $submit || $refresh ) ? ( ( $_GETVAR->get('disable_html', 'post', 'string', NULL) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_html'] : $userdata['user_allowhtml'] );
}
if ( !$board_config['allow_bbcode'] ) {
    $bbcode_on = 0;
} else {
    $bbcode_on = ( $submit || $refresh ) ? ( ( $_GETVAR->get('disable_bbcode', 'post', 'string', NULL) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );
}
if ( !$board_config['allow_smilies'] ) {
    $smilies_on = 0;
} else {
    $smilies_on = ( $submit || $refresh ) ? ( ( $_GETVAR->get('disable_smilies', 'post', 'string', NULL) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_smilies'] : $userdata['user_allowsmile'] );
}
if ( ($submit || $refresh) && $is_auth['auth_read']) {
    $notify_user = $_GETVAR->get('notify', 'post', 'string', NULL) ? 1 : 0;
    if ( $mode != 'newtopic' && is_user() && $is_auth['auth_read'] ) {
        $is_notify = $db->sql_unumrows("SELECT topic_id FROM " . TOPICS_WATCH_TABLE . "
                                        WHERE topic_id = '$topic_id'
                                        AND user_id = " . $userdata['user_id']);
        $notify_user = ( $is_notify > 0 ) ? 1 : $notify_user;
    } else {
        $notify_user = ( is_user() && $is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;
    }
} else {
    $notify_user = ( is_user() && $is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;
}
$attach_sig = ( $submit || $refresh ) ? ( ( $_GETVAR->get('attach_sig', 'post', 'string', NULL) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? 0 : $userdata['user_attachsig'] );
execute_posting_attachment_handling();

// --------------------
//  What shall we do?
//

/*--FNA #2--*/
if ( ( $delete || $poll_delete || $mode == 'delete' ) && !$confirm ) {
    //
    // Confirm deletion
    //
    $s_hidden_fields = '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post_id . '" />';
    $s_hidden_fields .= ( $delete || $mode == "delete" ) ? '<input type="hidden" name="mode" value="delete" />' : '<input type="hidden" name="mode" value="poll_delete" />';
    $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
    $l_confirm = ( $delete || $mode == 'delete' ) ? $lang['Confirm_delete'] : $lang['Confirm_delete_poll'];
    //
    // Output confirmation page
    //
    include(NUKE_INCLUDE_DIR.'page_header.php');
    $template->set_filenames(array(
        'confirm_body' => 'confirm_body.tpl')
    );
    $template->assign_vars(array(
        'MESSAGE_TITLE' => $lang['Information'],
        'MESSAGE_TEXT' => $l_confirm,
        'L_YES' => $lang['Yes'],
        'L_NO' => $lang['No'],
        'S_CONFIRM_ACTION' => append_sid('posting.php'),
        'S_HIDDEN_FIELDS' => $s_hidden_fields)
    );
    $template->pparse('confirm_body');
    include(NUKE_INCLUDE_DIR.'page_tail.php');
} else if ( $mode == 'vote' ) {
    //
    // Vote in a poll
    //
    if ( $_GETVAR->get('vote_id', 'post', 'int', NULL) ) {
        $vote_option_id = $_GETVAR->get('vote_id', 'post', 'int');
        $sql = "SELECT vd.vote_id
                FROM (" . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr)
                WHERE vd.topic_id = '$topic_id'
                AND vr.vote_id = vd.vote_id
                AND vr.vote_option_id = '$vote_option_id'
                GROUP BY vd.vote_id";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, sprintf($lang['Could_not_obtain'],  'vote data', 'this topic'), '', __LINE__, __FILE__, $sql);
        }
        if ( $vote_info = $db->sql_fetchrow($result) ) {
            $vote_id = $vote_info['vote_id'];
            $sql = "SELECT *
                    FROM " . VOTE_USERS_TABLE . "
                    WHERE vote_id = '$vote_id'
                    AND vote_user_id = " . $userdata['user_id'];
            if ( !($result2 = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, sprintf($lang['Could_not_obtain'],  'user vote data', 'this topic'), '', __LINE__, __FILE__, $sql);
            }
            if ( !($row = $db->sql_fetchrow($result2)) ) {
                $sql = "UPDATE " . VOTE_RESULTS_TABLE . "
                        SET vote_result = vote_result + 1
                        WHERE vote_id = '$vote_id'
                        AND vote_option_id = '$vote_option_id'";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, sprintf($lang['Could_not_update'], VOTE_RESULTS_TABLE), '', __LINE__, __FILE__, $sql);
                }
                $sql = "INSERT INTO " . VOTE_USERS_TABLE . " (vote_id, vote_user_id, vote_user_ip, vote_cast)
                        VALUES ('$vote_id', " . $userdata['user_id'] . ", '$user_ip', '$vote_option_id')";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, sprintf($lang['Could_not_insert'], 'user_id', VOTE_USERS_TABLE), '', __LINE__, __FILE__, $sql);
                }
                $message = $lang['Vote_cast'];
            } else {
                $message = $lang['Already_voted'];
            }
            $db->sql_freeresult($result2);
        } else {
            $message = $lang['No_vote_option'];
        }
        $db->sql_freeresult($result);
        $meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id") . '" />';
        $message .=  '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message, $lang['Submit_vote'], '', '', '', $meta);
    } else {
        redirect(append_sid('viewtopic.php?' . POST_TOPIC_URL . '='.$topic_id, TRUE));
    }
} else if ( $submit || $confirm ) {
    //
    // Submit post/vote (newtopic, edit, reply, etc.)
    //
    $return_message = '';
    $page_meta = '';
    // session id check
    if ($sid == '' || $sid != $userdata['session_id']) {
        $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Session_invalid'] : $lang['Session_invalid'];
    }
    switch ( $mode ) {
        case 'editpost':
            $username     = phpbb_clean_username($_GETVAR->get('username', 'post', 'string', NULL));
            $subject      = trim($_GETVAR->get('subject', 'post', 'string', ''));
            $message      = $_GETVAR->get('message', 'post', 'string', NULL);
            $poll_title   = $is_auth['auth_pollcreate'] ? $_GETVAR->get('poll_title', 'post', 'string', '') : '';
            $poll_options = $is_auth['auth_pollcreate'] ? $_GETVAR->get('poll_option_text', 'post', 'array') : array();
            $poll_length  = $is_auth['auth_pollcreate'] ? $_GETVAR->get('poll_length', 'post', 'int', NULL) : 0;
            $poll_view_toggle = $is_auth['auth_pollcreate'] ? $_GETVAR->get('poll_view_toggle', 'post', 'int', FALSE) : FALSE;
            $bbcode_uid = '';
            prepare_post($mode, $post_data, $bbcode_on, $html_on, $smilies_on, $error_msg, $username, $bbcode_uid, $subject, $message, $poll_title, $poll_options, $poll_length, $poll_view_toggle);
            if ( $error_msg == '' ) {
                $topic_type = ( $topic_type != $post_data['topic_type'] && !$is_auth['auth_sticky'] && !$is_auth['auth_announce']  && !$is_auth['auth_globalannounce'] ) ? $post_data['topic_type'] : $topic_type;

                /*--FNA REPLACE 1--*/
                submit_post($mode, $post_data, $return_message, $page_meta, $forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, str_replace("\'", "''", $username), str_replace("\'", "''", $subject), str_replace("\'", "''", $message), str_replace("\'", "''", $poll_title), $poll_options, $poll_length, $poll_view_toggle, $post_icon);
                if($is_auth['auth_mod'] && $post_data['first_post']) {
                    $topic_glance_priority = $_GETVAR->get('topic_glance_priority', 'post', 'int', NULL) ? 1 : 0;
                    $t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];
                    $sqlA = "UPDATE " . TOPICS_TABLE . "
                            SET topic_glance_priority = " . $topic_glance_priority . "
                            WHERE topic_id = " . $topic_id . "
                            AND topic_moved_id = '0'";
                    if ( !($resultA = $db->sql_query($sqlA)) ) {
                        message_die(GENERAL_ERROR, sprintf($lang['Could_not_update'], TOPICS_TABLE), '', __LINE__, __FILE__, $sql);
                    }
                }
                if ( $is_auth['auth_mod'] ) {
                    log_action($lang['Edit_Post'], '', $topic_id, $userdata['user_id'], '', '');
                }
            }
            break;
        case 'newtopic':
        case 'reply':
            $reply_gfxcheck = $_GETVAR->get('gfx_check', 'POST', 'string');
            if ( (!security_code_check($reply_gfxcheck, 'force') && $board_config['board_disable_security_code'] == 1)  && !$userdata['session_logged_in'] ) {
                message_die(GENERAL_ERROR, $lang['Wrong Security Code']);
            }
            $username     = phpbb_clean_username($_GETVAR->get('username', 'post', 'string', ''));
            $subject      = trim($_GETVAR->get('subject', 'post', 'string', ''));
            $message      = $_GETVAR->get('message', 'post', 'string', NULL);
            $poll_title   = $is_auth['auth_pollcreate'] ? $_GETVAR->get('poll_title', 'post', 'string', '') : '';
            $poll_options = $is_auth['auth_pollcreate'] ? $_GETVAR->get('poll_option_text', 'post', 'array') : array();
            $poll_length  = $is_auth['auth_pollcreate'] ? $_GETVAR->get('poll_length', 'post', 'int', NULL) : 0;
            $poll_view_toggle = $is_auth['auth_pollcreate'] ? $_GETVAR->get('poll_view_toggle', 'post', 'int', FALSE) : FALSE;
            $bbcode_uid = '';
            prepare_post($mode, $post_data, $bbcode_on, $html_on, $smilies_on, $error_msg, $username, $bbcode_uid, $subject, $message, $poll_title, $poll_options, $poll_length, $poll_view_toggle);
            if ( $error_msg == '' ) {
                if (isset($topic_type) || isset($post_data['topic_type'])) {
                    $topic_type = ( $topic_type != (isset($post_data['topic_type']) && !empty($post_data['topic_type']) ? $post_data['topic_type'] : '') && !$is_auth['auth_sticky'] && !$is_auth['auth_announce']  && !$is_auth['auth_globalannounce']) ? $post_data['topic_type'] : $topic_type;
                }
                /*--FNA REPLACE 2--*/
                submit_post($mode, $post_data, $return_message, $page_meta, $forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, str_replace("\'", "''", $username), str_replace("\'", "''", $subject), str_replace("\'", "''", $message), str_replace("\'", "''", $poll_title), $poll_options, $poll_length, $poll_view_toggle, $post_icon);
                if($is_auth['auth_mod'] && $mode == 'newtopic') {
                    $topic_glance_priority = $_GETVAR->get('topic_glance_priority', 'post', 'int', NULL) ? 1 : 0;
                    $t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];
                    $sqlA = "UPDATE " . TOPICS_TABLE . "
                            SET topic_glance_priority = " . $topic_glance_priority . "
                            WHERE topic_id = " . $topic_id . "
                            AND topic_moved_id = '0'";
                    if ( !($resultA = $db->sql_query($sqlA)) ) {
                        message_die(GENERAL_ERROR, sprintf($lang['Could_not_update'], TOPICS_TABLE), '', __LINE__, __FILE__, $sql);
                    }
                }
            }
            break;
        case 'delete':
        case 'poll_delete':
            if ($error_msg != '') {
                message_die(GENERAL_MESSAGE, $error_msg);
            }
            if ( $is_auth['auth_mod'] ) {
                log_action($lang['Delete'], '', $topic_id, $userdata['user_id'], '', '');
            }
            delete_post($mode, $post_data, $return_message, $page_meta, $forum_id, $topic_id, $post_id, $poll_id);
            /*--FNA #3--*/
            break;
    }
    if ( $error_msg == '' ) {
        if ( $mode != 'editpost' ) {
            $user_id = ( $mode == 'reply' || $mode == 'newtopic' ) ? $userdata['user_id'] : $post_data['poster_id'];
            update_post_stats($mode, $post_data, $forum_id, $topic_id, $post_id, $user_id);
        }
        $attachment_mod['posting']->insert_attachment($post_id);
        if ($mode != 'poll_delete') {
            user_notification($mode, $post_data, $post_info['topic_title'], $forum_id, $topic_id, $post_id, $notify_user);
        }
        /*--FNA #4--*/
        if ( ( $error_msg == '' ) && ( $lock ) && ( $mode == 'newtopic' ) ) {
            $sql = "UPDATE " . TOPICS_TABLE . "
                    SET topic_status = " . TOPIC_LOCKED . "
                    WHERE topic_id = " . $topic_id . "
                    AND topic_moved_id = 0";
            log_action($lang['Lock'], '', $topic_id, $userdata['user_id'], '', '');
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, sprintf($lang['Could_not_update'], TOPICS_TABLE), '', __LINE__, __FILE__, $sql);
            }
        }
        if ( $mode == 'newtopic' || $mode == 'reply' ) {
            $tracking_topics = evo_getcookie($board_config['cookie_name'] . '_t') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_t')) : array();
            $tracking_forums = evo_getcookie($board_config['cookie_name'] . '_f') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_f')) : array();
            if ( (count($tracking_topics) + count($tracking_forums)) >= 600 && empty($tracking_topics[$topic_id]) ) {
                asort($tracking_topics);
                unset($tracking_topics[key($tracking_topics)]);
            }
            $tracking_topics[$topic_id] = time();
            evo_setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 2592000);
        }
        $header_meta = $page_meta;
        $page_meta   = '';
        message_die(GENERAL_MESSAGE, $return_message, '', '', '', '', $header_meta);
    }
}

if( $refresh || (isset($del_poll_option) && is_array($del_poll_option)) || $error_msg != '' ) {
    $username     = phpbb_clean_username($_GETVAR->get('username', 'post', 'string', ''));
    $subject      = htmlspecialchars(trim(stripslashes($_GETVAR->get('subject', 'post', 'string', NULL))));
    $message      = htmlspecialchars(trim(stripslashes($_GETVAR->get('message', 'post', 'string', NULL))));
    $post_icon    = $_GETVAR->get('post_icon', 'post', 'int', 0);
    $poll_title   = htmlspecialchars(trim(stripslashes($_GETVAR->get('poll_title', 'post', 'string', NULL))));
    $poll_length  = max(0, $_GETVAR->get('poll_length', 'post', 'int', 0));
    $poll_view_toggle = $_GETVAR->get('poll_view_toggle', 'post', 'int', FALSE);
    $poll_options = array();
    $temp_poll_option_text = $_GETVAR->get('poll_option_text', '_POST', 'array', array());
    if ( isset($temp_poll_option_text) && is_array($temp_poll_option_text)) {
        $temp_del_poll_option  = $_GETVAR->get('del_poll_option', 'post', 'array', array());
            while( list($option_id, $option_text) = @each($temp_poll_option_text) ) {
                if( isset($temp_del_poll_option[$option_id]) ) {
                    unset($poll_options[$option_id]);
                } else if ( !empty($option_text) ) {
                    $poll_options[$option_id] = htmlspecialchars(trim(stripslashes($option_text)));
                }
            }
    }
    if ( $poll_add ) {
        $poll_options[] = htmlspecialchars(trim(stripslashes($_GETVAR->get('add_poll_option_text', 'post', 'string'))));
    }
    $user_allowsignature = $userdata['user_allowsignature'];
    if ( $mode == 'newtopic' || $mode == 'reply') {
        $user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] && $userdata['user_allowsignature'] ) ? $userdata['user_sig'] : '';
    } else if ( $mode == 'editpost' && $post_info['user_id'] != ANONYMOUS ) {
        $user_sig = ( $post_info['user_sig'] != '' && $board_config['allow_sig'] && $userdata['user_allowsignature'] ) ? $post_info['user_sig'] : '';
        $userdata['user_sig_bbcode_uid'] = $post_info['user_sig_bbcode_uid'];
    } else {
        $user_sig = '';
    }
    if( $preview ) {
        $orig_word = array();
        $replacement_word = array();
        obtain_word_list($orig_word, $replacement_word);
        $bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
        $preview_message = stripslashes(prepare_message(addslashes(unprepare_message($message)), $html_on, $bbcode_on, $smilies_on, $bbcode_uid));
        $preview_subject = ($board_config['smilies_in_titles']) ? smilies_pass($subject) : $subject;
        $preview_subject = ($board_config['smilies_in_titles']) ? smilies_pass($subject) : $subject;
        $preview_username = $username;
        //
        // Finalise processing as per viewtopic
        //
        if( !$html_on ) {
            if( $user_sig != '' || !$userdata['user_allowhtml'] ) {
                $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $user_sig);
            }
        }
        if( $attach_sig && $user_sig != '' && $userdata['user_sig_bbcode_uid'] ) {
            $user_sig = bbencode_second_pass($user_sig, $userdata['user_sig_bbcode_uid']);
        }
        if( $bbcode_on ) {
            $preview_message = bbencode_second_pass($preview_message, $bbcode_uid);
        }
        if( !empty($orig_word) ) {
            $preview_username = ( !empty($username) ) ? preg_replace($orig_word, $replacement_word, $preview_username) : '';
            $preview_subject = ( !empty($subject) ) ? preg_replace($orig_word, $replacement_word, $preview_subject) : '';
            $preview_message = ( !empty($preview_message) ) ? preg_replace($orig_word, $replacement_word, $preview_message) : '';
        }
        if( $user_sig != '' ) {
            $user_sig = make_clickable($user_sig);
        }
        $preview_message = make_clickable($preview_message);
        if( $smilies_on ) {
            if( $userdata['user_allowsmile'] && $user_sig != '' ) {
                $user_sig = smilies_pass($user_sig);
            }
            $preview_message = smilies_pass($preview_message);
        }
        if( $attach_sig && $user_sig != '' ) {
            $preview_message = $preview_message . '<br />' . $board_config['sig_line'] . '<br />' . $user_sig;
        }
        $preview_message = word_wrap_pass($preview_message);
        $preview_message = str_replace("\n", '<br />', $preview_message);
        $template->set_filenames(array(
            'preview' => 'posting_preview.tpl')
        );
        $preview_subject = get_icon_title($post_icon) . '&nbsp;' . $preview_subject;
        $attachment_mod['posting']->preview_attachments();
        $template->assign_vars(array(
            'TOPIC_TITLE'   => $preview_subject,
            'POST_SUBJECT'  => $preview_subject,
            'POSTER_NAME'   => $preview_username,
            'POST_DATE'     => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
            'MESSAGE'       => $preview_message,
            'MINIPOST_IMG'  => $images['icon_minipost'],
            'SPACER_IMG'    => $images['spacer'],
            'L_QUOTE'       => $lang['Quote'],
            'L_POST_SUBJECT'=> $lang['Post_subject'],
            'L_PREVIEW'     => $lang['Preview'],
            'L_POSTED'      => $lang['Posted'],
            'L_POST'        => $lang['Post'])
            );
        $template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
    } else if( $error_msg != '' ) {
        $template->set_filenames(array(
           'reg_header' => 'error_body.tpl')
        );
        $template->assign_vars(array(
           'ERROR_MESSAGE' => $error_msg)
        );
        $template->assign_var_from_handle('ERROR_BOX', 'reg_header');
    }
} else {
    //
    // User default entry point
    //
    if ( $mode == 'newtopic' || $mode == 'preview' ) {
        $user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';
        $user_allowsignature = $userdata['user_allowsignature'];
        $username = ($userdata['session_logged_in']) ? $userdata['username'] : '';
        $poll_title = '';
        $poll_length = 0;
        $poll_view_toggle = FALSE;
        $subject = '';
        $message = '';
        $post_icon = 0;
    } else if ( $mode == 'reply' ) {
        $user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';
        $user_allowsignature = $userdata['user_allowsignature'];
        $username = ( $userdata['session_logged_in'] ) ? $userdata['username'] : '';
        $subject = '';
        $subject = $post_info['topic_title'];
        if ( !preg_match('/^Re:/', $subject) && strlen($subject) > 0) {
                $subject = 'Re: ' . $subject;
        }
        $message = '';
        $post_icon = 0;
    } else if ( $mode == 'quote' || $mode == 'editpost' ) {
        $subject = ( $post_data['first_post'] ) ? $post_info['topic_title'] : $post_info['post_subject'];
        $message = $post_info['post_text'];
        $post_icon = ( $post_data['first_post'] ) ? $post_info['topic_icon'] : $post_info['post_icon'];
        if ( $mode == 'editpost' ) {
            $attach_sig = ( $post_info['enable_sig'] && $post_info['user_sig'] != '' ) ? TRUE : 0;
            $user_sig = $post_info['user_sig'];
            $user_allowsignature = $userdata['user_allowsignature'];
            $html_on = ( $post_info['enable_html'] ) ? TRUE : FALSE;
            $bbcode_on = ( $post_info['enable_bbcode'] ) ? TRUE : FALSE;
            $smilies_on = ( $post_info['enable_smilies'] ) ? TRUE : FALSE;
        } else {
            $attach_sig = ( $userdata['user_attachsig'] ) ? TRUE : 0;
            $user_sig = $userdata['user_sig'];
            $user_allowsignature = $userdata['user_allowsignature'];
        }
        if ( $post_info['bbcode_uid'] != '' ) {
            $message = preg_replace('/\:(([a-z0-9]:)?)' . $post_info['bbcode_uid'] . '/s', '', $message);
        }
        $message = str_replace('<', '&lt;', $message);
        $message = str_replace('>', '&gt;', $message);
        $message = str_replace('<br />', "\n", $message);
        if ( $mode == 'quote' ) {
            $orig_word = array();
            $replacement_word = array();
            obtain_word_list($orig_word, $replace_word);
            $msg_date =  create_date($board_config['default_dateformat'], $post_info['post_time'], $board_config['board_timezone']);
            // Use trim to get rid of spaces placed there by MS-SQL 2000
            $quote_username = ( trim($post_info['post_username']) != '' ) ? $post_info['post_username'] : $post_info['username'];
            $message = '[quote="' . $quote_username . '";p="' . $post_id . '"]' . $message . '[/quote]';
            if ( !empty($orig_word) ) {
                $subject = ( !empty($subject) ) ? preg_replace($orig_word, $replace_word, $subject) : '';
                $message = ( !empty($message) ) ? preg_replace($orig_word, $replace_word, $message) : '';
            }
            if ( !preg_match('/^Re:/', $subject) && strlen($subject) > 0 ) {
                $subject = 'Re: ' . $subject;
            }
            $mode = 'reply';
            /*--FNA #5--*/
        } else {
            $username = ( $post_info['user_id'] == ANONYMOUS && !empty($post_info['post_username']) ) ? $post_info['post_username'] : '';
        }
    }
}

//
// Signature toggle selection
//
if( $user_sig != '' && $user_allowsignature ) {
    $template->assign_block_vars('switch_signature_checkbox', array());
}

//
// HTML toggle selection
//
if ( $board_config['allow_html'] ) {
    $html_status = $lang['HTML_is_ON'];
    $template->assign_block_vars('switch_html_checkbox', array());
} else {
    $html_status = $lang['HTML_is_OFF'];
}
//
// BBCode toggle selection
//
if ( $board_config['allow_bbcode'] ) {
    $bbcode_status = $lang['BBCode_is_ON'];
    $template->assign_block_vars('switch_bbcode_checkbox', array());
} else {
    $bbcode_status = $lang['BBCode_is_OFF'];
}
//
// Smilies toggle selection
//
if ( $board_config['allow_smilies'] ) {
    $smilies_status = $lang['Smilies_are_ON'];
    $template->assign_block_vars('switch_smilies_checkbox', array());
} else {
    $smilies_status = $lang['Smilies_are_OFF'];
}
if( !$userdata['session_logged_in'] || ( $mode == 'editpost' && $post_info['poster_id'] == ANONYMOUS ) ) {
    $template->assign_block_vars('switch_username_select', array());
}
//
// Notify checkbox - only show if user is logged in
//
if ( $userdata['session_logged_in'] && $is_auth['auth_read'] ) {
    if ( $mode != 'editpost' || ( $mode == 'editpost' && $post_info['poster_id'] != ANONYMOUS ) ) {
        $template->assign_block_vars('switch_notify_checkbox', array());
    }
}
//
// Delete selection
//
if ( $mode == 'editpost' && ( ( $is_auth['auth_delete'] && $post_data['last_post'] && ( !$post_data['has_poll'] || $post_data['edit_poll'] ) ) || $is_auth['auth_mod'] ) ) {
    $template->assign_block_vars('switch_delete_checkbox', array());
}
if ( ( $mode == 'editpost' || $mode == 'reply' || $mode == 'quote' || $mode == 'newtopic' ) && ( $is_auth['auth_mod'] ) ) {
    if ( isset($post_info['topic_status']) &&  ($post_info['topic_status'] == TOPIC_LOCKED) ) {
        $template->assign_block_vars('switch_unlock_topic', array());
        $template->assign_vars(array(
            'L_UNLOCK_TOPIC'   => $lang['Unlock_topic'],
            'S_UNLOCK_CHECKED' => ( $unlock ) ? 'checked="checked"' : '')
        );
    } else if ( !isset($post_info['topic_status']) || (isset($post_info['topic_status']) && $post_info['topic_status'] == TOPIC_UNLOCKED) ) {
        $template->assign_block_vars('switch_lock_topic', array());
        $template->assign_vars(array(
            'L_LOCK_TOPIC'   => $lang['Lock_topic'],
            'S_LOCK_CHECKED' => ( $lock ) ? 'checked="checked"' : '')
        );
    }
}
if ( ( $mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post'])) && ( $is_auth['auth_mod'] ) ) {
    if ( isset($post_info['topic_glance_priority']) && ($post_info['topic_glance_priority']) || $_GETVAR->get('topic_glance_priority', 'post', 'int', NULL) ) {
        $checked = 'checked="checked"';
    } else {
        $checked = '';
    }
    $template->assign_block_vars('switch_topic_glance_priority', array());
    $template->assign_vars(array(
         'L_TOPIC_GLANCE_PRIORITY'       => $lang['topic_glance_priority'],
         'TOPIC_GLANCE_PRIORITY_CHECKED' => $checked,
         )
    );
}
//
// Topic type selection
//
$topic_type_toggle = '';
if ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['first_post'] ) ) {
    if( $is_auth['auth_sticky'] ) {
        $topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_STICKY . '"';
        if ( $post_data['topic_type'] == POST_STICKY || $topic_type == POST_STICKY ) {
            $topic_type_toggle .= ' checked="checked"';
        }
        $topic_type_toggle .= ' /> ' . $lang['Post_Sticky'] . '&nbsp;&nbsp;';
    }
    if( $is_auth['auth_announce'] ) {
        $topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_ANNOUNCE . '"';
        if ( $post_data['topic_type'] == POST_ANNOUNCE || $topic_type == POST_ANNOUNCE ) {
            $topic_type_toggle .= ' checked="checked"';
        }
        $topic_type_toggle .= ' /> ' . $lang['Post_Announcement'] . '&nbsp;&nbsp;';
    }
    if( $is_auth['auth_globalannounce'] ) {
        $topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_GLOBAL_ANNOUNCE . '"';
        if ( $post_data['topic_type'] == POST_GLOBAL_ANNOUNCE || $topic_type == POST_GLOBAL_ANNOUNCE ) {
            $topic_type_toggle .= ' checked="checked"';
        }
        $topic_type_toggle .= ' /> ' . $lang['Post_global_announcement'] . '&nbsp;&nbsp;';
    }
    if ( $topic_type_toggle != '' ) {
        $topic_type_toggle = $lang['Post_topic_as'] . ': <input type="radio" name="topictype" value="' . POST_NORMAL .'"' . ( ( $post_data['topic_type'] == POST_NORMAL || $topic_type == POST_NORMAL ) ? ' checked="checked"' : '' ) . ' /> ' . $lang['Post_Normal'] . '&nbsp;&nbsp;' . $topic_type_toggle;
    }
    if (!empty($topic_type_toggle)) {
        $template->assign_block_vars('switch_type_toggle', array());
    }
}
$hidden_form_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
$hidden_form_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
switch( $mode ) {
    case 'newtopic':
        $page_title = $lang['Post_a_new_topic'];
        $hidden_form_fields .= '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';
        break;
    case 'reply':
        $page_title = $lang['Post_a_reply'];
        $hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
        break;
    case 'editpost':
        $page_title = $lang['Edit_Post'];
        $hidden_form_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post_id . '" />';
        break;
}
// Generate smilies listing for page output
generate_smilies('inline', PAGE_POSTING);
/*--FNA #6--*/
//
// Include page header
//
include(NUKE_INCLUDE_DIR.'page_header.php');
$template->set_filenames(array(
    'body'      => 'posting_body.tpl',
    'pollbody'  => 'posting_poll_body.tpl',
    'reviewbody'=> 'posting_topic_review.tpl')
);
make_jumpbox('viewforum.php');
$template->assign_vars(array(
    'FORUM_NAME'    => $forum_name,
    'TOPIC_SUBJECT' => $topic_title,
    'L_QUOTE'       => $lang['Quote'],
    'L_POST_A'      => $page_title,
    'L_POST_SUBJECT'=> $lang['Post_subject'],
    'MINIPOST_IMG'  => $images['icon_minipost'],
    'SPACER_IMG'    => $images['spacer'],
    'U_VIEW_TOPIC'  => append_sid('viewtopic.php?' . POST_TOPIC_URL . '='.$topic_id),
    'U_VIEW_FORUM'  => append_sid('viewforum.php?' . POST_FORUM_URL . '='.$forum_id))
);

//
// This enables the forum/topic title to be output for posting
// but not for privmsg (where it makes no sense)
//
$template->assign_block_vars('switch_not_privmsg', array());
if ( $mode == 'reply' || $mode == 'quote' || $mode == 'editpost' ) {
    $template->assign_block_vars('switch_not_privmsg.reply_mode', array());
}
//
// Output the data to the template
//
if ( (!is_user() && ($board_config['board_disable_security_code'] == 1)) && ($mode == 'reply' || $mode == 'newtopic')) {
    $template->assign_block_vars('switch_generate_security_code', array());
    $template->assign_vars(array(
        'L_GUEST_SECURITY_CODE' => security_code(1,'small', 1))
    );
}

$template->assign_vars(array(
    'BB_BOX'            => bbcode_table('message', 'post', 1, $message),
    'USERNAME'          => (isset($username) ? $username : ''),
    'SUBJECT'           => $subject,
    'MESSAGE'           => $message,
    'HTML_STATUS'       => $html_status,
    'BBCODE_STATUS'     => sprintf($bbcode_status, '<a href="' . append_sid("faq.php?mode=bbcode") . '" onclick="window.open(this.href,\'_blank\'); return false;">', '</a>'),
    'SMILIES_STATUS'    => $smilies_status,
    'L_SUBJECT'         => $lang['Subject'],
    'L_MESSAGE_BODY'    => $lang['Message_body'],
    'L_OPTIONS'         => $lang['Options'],
    'L_PREVIEW'         => $lang['Preview'],
    'L_SUBMIT'          => $lang['Submit'],
    'L_CANCEL'          => $lang['Cancel'],
    'L_CONFIRM_DELETE'  => $lang['Confirm_delete'],
    'L_DISABLE_HTML'    => $lang['Disable_HTML_post'],
    'L_DISABLE_BBCODE'  => $lang['Disable_BBCode_post'],
    'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'],
    'L_ATTACH_SIGNATURE'=> $lang['Attach_signature'],
    'L_NOTIFY_ON_REPLY' => $lang['Notify'],
    'L_DELETE_POST'     => $lang['Delete_post'],
    'S_HTML_CHECKED'    => ( !$html_on )? 'checked="checked"' : '',
    'S_BBCODE_CHECKED'  => ( !$bbcode_on ) ? 'checked="checked"' : '',
    'S_SMILIES_CHECKED' => ( !$smilies_on ) ? 'checked="checked"' : '',
    'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? 'checked="checked"' : '',
    'S_NOTIFY_CHECKED'  => ( $notify_user ) ? 'checked="checked"' : '',
    'S_TYPE_TOGGLE'     => $topic_type_toggle,
    'S_TOPIC_ID'        => $topic_id,
    'S_POST_ACTION'     => append_sid('posting.php'),
    'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields)
);
if ($mode == 'reply') {
$template->assign_vars(array(
    'U_VIEW_POST'    => append_sid('posting.php?mode=topicreview&amp;' . POST_TOPIC_URL . '='.$topic_id.'&amp;popup=1')));
}

// get the number of icon per row from config
$icon_per_row = isset($board_config['icon_per_row']) ? intval($board_config['icon_per_row']) : 10;
if ($icon_per_row <= 1) {
    $icon_per_row = 10;
}
// get the list of icon available to the user
$icones_sort = array();
for ($i = 0; $i < count($icones); $i++) {
    switch ($icones[$i]['auth']) {
        case AUTH_ADMIN:
            if ( $userdata['user_level'] == ADMIN ) {
                $icones_sort[] = $i;
            }
            break;
        case AUTH_MOD:
            if ( $is_auth['auth_mod'] ) {
                $icones_sort[] = $i;
            }
            break;
        case AUTH_REG:
            if ( $userdata['session_logged_in'] ) {
                $icones_sort[] = $i;
            }
            break;
        default:
            $icones_sort[] = $i;
            break;
    }
}

// check if the icon exists
$found = FALSE;
for ($i=0; ( ($i < count($icones_sort)) && !$found );$i++) {
    $found = ($icones[ $icones_sort[$i] ]['ind'] == $post_icon);
}
if (!$found) {
    $post_icon = 0;
}
// send to template
$template->assign_block_vars('switch_icon_checkbox', array());
$template->assign_vars(array(
    'L_ICON_TITLE' => $lang['post_icon_title']
    )
);

// display the icons
$nb_row = intval( (count($icones_sort)-1) / $icon_per_row )+1;
$offset = 0;
for ($i=0; $i < $nb_row; $i++) {
    $template->assign_block_vars('switch_icon_checkbox.row',array());
    for ($j=0; ( ($j < $icon_per_row) && ($offset < count($icones_sort)) ); $j++) {
        $icon_id  = $icones_sort[$offset];
        // send to cell or cell_none
        $template->assign_block_vars('switch_icon_checkbox.row.cell', array(
            'ICON_ID'       => $icones[$icon_id]['ind'],
            'ICON_CHECKED'  => ($post_icon == $icones[$icon_id]['ind']) ? ' checked="checked"' : '',
            'ICON_IMG'      => get_icon_title($icones[$icon_id]['ind'], 2),
            )
        );
        $offset++;
    }
}
//
// Poll entry switch/output
//
if( ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['edit_poll']) ) && $is_auth['auth_pollcreate'] ) {
    $template->assign_vars(array(
        'L_ADD_A_POLL'          => $lang['Add_poll'],
        'L_ADD_POLL_EXPLAIN'    => $lang['Add_poll_explain'],
        'L_POLL_QUESTION'       => $lang['Poll_question'],
        'L_POLL_OPTION'         => $lang['Poll_option'],
        'L_ADD_OPTION'          => $lang['Add_option'],
        'L_UPDATE_OPTION'       => $lang['Update'],
        'L_DELETE_OPTION'       => $lang['Delete'],
        'L_POLL_LENGTH'         => $lang['Poll_for'],
        'L_POLL_TOGGLE'         => $lang['Poll_view_toggle'],
        'L_POLL_TOGGLE_EXPLAIN' => $lang['Poll_view_toggle_explain'],
        'L_DAYS'                => $lang['Days'],
        'L_POLL_LENGTH_EXPLAIN' => $lang['Poll_for_explain'],
        'L_POLL_DELETE'         => $lang['Delete_poll']));
    if (isset($poll_title) && !empty($poll_title)) {
        $template->assign_vars(array(
            'POLL_TITLE'            => $poll_title,
            'POLL_LENGTH'           => $poll_length,
            'POLL_TOGGLE_CHECKED'   => ($poll_view_toggle) ? "checked" : "",
            'POLL_TOGGLE'           => $poll_view_toggle)
        );
    }
    if( $mode == 'editpost' && $post_data['edit_poll'] && $post_data['has_poll']) {
        $template->assign_block_vars('switch_poll_delete_toggle', array());
    }
    if( !empty($poll_options) ) {
        while( list($option_id, $option_text) = each($poll_options) ) {
            $template->assign_block_vars('poll_option_rows', array(
                'POLL_OPTION'       => str_replace('"', '&quot;', $option_text),
                'S_POLL_OPTION_NUM' => $option_id)
            );
        }
    }
    $template->assign_var_from_handle('POLLBOX', 'pollbody');
}
//
// Topic review
//
if( $mode == 'reply' && $is_auth['auth_read'] ) {
    require(NUKE_INCLUDE_DIR.'topic_review.php');
    topic_review($topic_id, TRUE);
    $template->assign_var_from_handle('TOPIC_REVIEW_BOX', 'reviewbody');
}

$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>