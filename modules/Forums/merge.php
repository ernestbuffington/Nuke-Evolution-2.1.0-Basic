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
include(NUKE_INCLUDE_DIR.'functions_admin.php');
include_once(NUKE_INCLUDE_DIR.'functions_topics_list.php');
include_once(NUKE_INCLUDE_DIR.'functions_log.php');

// function block
function get_topic_id($topic) {
    global $db;
    $topic_id = 0;

    // is this a direct value ?
    $num_topic = intval($topic);
    if ($topic == $num_topic) {
        $topic_id = intval($topic);
    } else {
    // is it an url with topic id or post id ?
        $name  = explode('?', $topic);
        $parms = ( isset($name[1]) ) ? $name[1] : $name[0];
        parse_str($parms, $parm);
        $found = false;
        $topic_id = 0;
        while ((list($key, $val) = each($parm)) && !$found) {
            $vals = explode('#', $val);
            $val = $vals[0];
            if (empty($val)) {
                $val = 0;
            }
            switch($key) {
                case POST_POST_URL:
                    $sql = "SELECT topic_id FROM " . POSTS_TABLE . " WHERE post_id=$val";
                    if ( !($result = $db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, 'Could not get post informations', '', __LINE__, __FILE__, $sql);
                    }
                    if ($row = $db->sql_fetchrow($result)) {
                        $val = $row['topic_id'];
                        $found = true;
                    }
                    $db->sql_freeresult($result);
                    break;
                case POST_TOPIC_URL:
                    $found = true;
                    break;
            }
            if ($found) {
                $topic_id = intval($val);
            }
        }
    }
    return $topic_id;
}

// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
// End session management

// check if user is a moderator or an admin
if (($userdata['user_level'] != MOD) && (!is_admin())) {
    message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}

// from topic
$from_topic = $_GETVAR->get('from_topic', 'post', 'string', NULL);
if ( (!$from_topic && $_GETVAR->get(POST_TOPIC_URL, 'get', 'int', NULL)) || $_GETVAR->get(POST_POST_URL, 'get', 'int', NULL) )
{
    $from_topic = $_GETVAR->get(POST_TOPIC_URL, 'get', 'int', NULL) ?  $_GETVAR->get(POST_TOPIC_URL, 'get', 'int', NULL) : POST_POST_URL . '=' . $_GETVAR->get(POST_POST_URL, 'get', 'int');
}
$from_topic_id = get_topic_id($from_topic);

// to topic
$to_topic    = $_GETVAR->get('to_topic', 'post', 'string', NULL);
$to_topic_id =  get_topic_id($to_topic);

// topic title
$topic_title = htmlspecialchars(trim($_GETVAR->get('topic_title', 'post', 'string', '')));

// start
$start = $_GETVAR->get('start', 'post', 'int', 0);

// buttons
$submit       = $_GETVAR->get('submit', 'post', 'string', NULL) ? TRUE : FALSE;
$confirm      = $_GETVAR->get('confirm', 'post', 'string', NULL) ? TRUE : FALSE;
$cancel       = $_GETVAR->get('cancel', 'post', 'string', NULL) ? TRUE : FALSE;
if ($cancel) {
    $submit = FALSE;
}
$shadow       = $_GETVAR->get('shadow', 'post', 'string', NULL) ? TRUE : FALSE;
$select_from  = $_GETVAR->get('select_from', 'post', 'string', NULL) ? TRUE : FALSE;
$select_to    = $_GETVAR->get('select_to', 'post', 'string', NULL) ? TRUE : FALSE;
$page_prec    = $_GETVAR->get('page_rec', 'post', 'string', NULL) ? TRUE : FALSE;
$page_next    = $_GETVAR->get('page_next', 'post', 'string', NULL) ? TRUE : FALSE;

// check if a selection has been made
$topic_selected = 0;
if ( $_GETVAR->get('topic_selected', 'post', 'string', NULL) ) {
    $topic_selected = intval(substr($_GETVAR->get('topic_selected', 'post', 'string'),1));
}

if ( $submit && ($topic_selected > 0) ) {
    $submit = false;
    if ($select_from) {
        $from_topic = $topic_selected;
        $from_topic_id = $topic_selected;
    }
    if ($select_to) {
        $to_topic = $topic_selected;
        $to_topic_id = $topic_selected;
    }
    $select_from = false;
    $select_to   = false;
}


// titles
$from_title = '';
if (!empty($from_topic_id)) {
    $sql = "SELECT topic_title FROM " . TOPICS_TABLE . " WHERE topic_id=$from_topic_id";
    if ( !($result = $db->sql_query($sql)) ) {
      message_die(GENERAL_ERROR, 'Could not get from-topic informations', '', __LINE__, __FILE__, $sql);
    }
    if ($row = $db->sql_fetchrow($result)) {
        $from_title = $row['topic_title'];
    }
    $db->sql_freeresult($result);
}
$to_title = '';
if (!empty($to_topic_id)) {
    $sql = "SELECT topic_title FROM " . TOPICS_TABLE . " WHERE topic_id=$to_topic_id";
    if ( !($result = $db->sql_query($sql)) ) {
      message_die(GENERAL_ERROR, 'Could not get to-topic informations', '', __LINE__, __FILE__, $sql);
    }
    if ($row = $db->sql_fetchrow($result)) {
        $to_title = $row['topic_title'];
    }
    $db->sql_freeresult($result);
}

// forum_id
$forum_id = $_GETVAR->get(POST_FORUM_URL, 'request', 'int', 0);
$fid      = $_GETVAR->get('fid', 'request', 'string', '');

if ( $fid != '' ) {
    if (substr($fid, 0, 1) == POST_FORUM_URL) {
        $forum_id = intval(substr($fid, 1));
    }
}

// selection
if (($select_from || $select_to) && (!$cancel)) {
    // get the list of forums
    if (function_exists(selectbox)) {
        $list_forums = selectbox('fid', false, POST_FORUM_URL . $forum_id);
    } else {
        $list_forums = make_forum_select(POST_FORUM_URL, false, $forum_id);
    }

    // how many record in the forum
    $nbpages = 0;
    $per_page = intval($board_config['topics_per_page']);

    $sql_merge = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time
                FROM (" . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2)
                WHERE t.forum_id = $forum_id
                AND t.topic_poster = u.user_id
                AND p.post_id = t.topic_first_post_id
                AND p2.post_id = t.topic_last_post_id
                AND u2.user_id = p2.poster_id
                AND topic_status <> " . TOPIC_MOVED;

    if ( !empty($forum_id) ) {
        $sql = $sql_merge;
        if ( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not get topics informations', '', __LINE__, __FILE__, $sql);
        }
        $nbitems = $db->sql_numrows($result);
        $db->sql_freeresult($result);
        $nbpages = floor( ($nbitems-1) / $per_page )+1;
    }

    // change current page
    if ($page_prec && ($start > 0)) {$start--;}
    if ($page_next && ( $start < ($nbpages-1) )) {$start++;}

    $pagination = '';
    if ($nbpages > 1) {
        if ( $start > 0 ) {
            $pagination .= '<input type="submit" name="page_prec" value="&laquo;" class="liteoption" />&nbsp;';
        }
        $pagination .= sprintf($lang['Page_of'], ($start+1), $nbpages) . '&nbsp;';
        if ( $start < ($nbpages-1) ) {
            $pagination .= '<input type="submit" name="page_next" value="&raquo;" class="liteoption" />';
        }
    }

    // set the page title and include the page header
    $page_title = $lang['Merge_topics'];
    include_once(NUKE_INCLUDE_DIR.'page_header.php');

    // template name
    $template->set_filenames(array(
        'body' => 'merge_select_body.tpl')
    );
    // header
    $template->assign_vars(array(
        'L_GO'          => $lang['Go'],
        'S_LIST_FORUMS' => $list_forums,
        'PAGINATION'    => $pagination,
        )
    );

    // read the forum
    $start_topic = $start * $per_page;
    $topic_rowset = array();
    if ( !empty($forum_id) ) {
        $sql = $sql_merge . " ORDER BY t.topic_type DESC, t.topic_last_post_id DESC LIMIT $start_topic, $per_page";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not get topics informations', '', __LINE__, __FILE__, $sql);
        }
        while ($row = $db->sql_fetchrow($result)) {
            $row['topic_id'] = POST_TOPIC_URL . $row['topic_id'];
            $topic_rowset[] = $row;
        }
        $db->sql_freeresult($result);
    }

    // topics list parameters
    $box                = 'MERGE_BOX';
    $tpl                = '';
    $list_title         = ($select_from) ? $lang['Merge_topic_from'] : $lang['Merge_topic_to'];
    $split_type         = true;
    $display_nav_tree   = false;
    $footer             = '<input type="submit" name="submit" value="' . $lang['Select'] . '" class="mainoption" />';
    $footer            .= '&nbsp;<input type="submit" name="cancel" value="' . $lang['Cancel'] . '" class="liteoption" />';
    $inbox              = false;
    $select_field       = 'topic_selected';
    $select_type        = 2;
    $select_formname    = 'post';
    topic_list($box, $tpl, $topic_rowset, $list_title, $split_type, $display_nav_tree, $footer, $inbox, $select_field, $select_type, $select_formname );

    // system
    $s_hidden_fields    = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
    $s_hidden_fields   .= '<input type="hidden" name="topic_title" value="' . addslashes($topic_title) . '" />';
    $s_hidden_fields   .= '<input type="hidden" name="from_topic" value="' . $from_topic . '" />';
    $s_hidden_fields   .= '<input type="hidden" name="to_topic" value="' . $to_topic . '" />';
    $s_hidden_fields   .= '<input type="hidden" name="submit" value="1" />';
    if ($shadow) {
        $s_hidden_fields .= '<input type="hidden" name="shadow" value="1" />';
    }
    if ($select_from) {
        $s_hidden_fields .= '<input type="hidden" name="select_from" value="1" />';
    }
    if ($select_to) {
        $s_hidden_fields .= '<input type="hidden" name="select_to" value="1" />';
    }
    $s_hidden_fields   .= '<input type="hidden" name="start" value="' . $start . '" />';
    $template->assign_vars(array(
        'S_ACTION'        => append_sid('merge.php'),
        'S_HIDDEN_FIELDS' => $s_hidden_fields,
        )
    );
    // footer
    $template->pparse('body');
    include_once(NUKE_INCLUDE_DIR.'page_tail.php');
    exit;
}

// submission
if ($submit) {
    // init
    $error      = false;
    $error_msg  = '';
    $message    = '';

    // check if the from topic exists and get the forum_id
    $found         = false;
    $from_forum_id = 0;
    $from_poll     = false;
    if (!empty($from_topic_id)) {
        $sql = "SELECT forum_id, topic_vote FROM " . TOPICS_TABLE . " WHERE topic_id=$from_topic_id";
        if ( !($result = $db->sql_query($sql)) ) {
          message_die(GENERAL_ERROR, 'Could not get topic informations', '', __LINE__, __FILE__, $sql);
        }
        if ($row = $db->sql_fetchrow($result)) {
            $from_forum_id = $row['forum_id'];
            $from_poll = $row['topic_vote'];
            $found = true;
        }
        $db->sql_freeresult($result);
    }
    if (!$found) {
        $error = true;
        $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_from_not_found'];
    }

    // check if the from topic exists and get the forum_id
    $found       = false;
    $to_forum_id = 0;
    $to_poll     = false;
    if (!empty($to_topic_id)) {
        $sql = "SELECT forum_id, topic_vote FROM " . TOPICS_TABLE . " WHERE topic_id=$to_topic_id";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not get topic informations', '', __LINE__, __FILE__, $sql);
        }
        if ($row = $db->sql_fetchrow($result)) {
            $to_forum_id = $row['forum_id'];
            $to_poll = $row['topic_vote'];
            $found = true;
        }
        $db->sql_freeresult($result);
    }
    if (!$found) {
        $error = true;
        $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_to_not_found'];
    }

    // verify the topics are not the same
    if (!$error) {
        if ($from_topic_id == $to_topic_id) {
            $error = true;
            $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_topics_equals'];
        }
    }

    // check authorizations
    if (!empty($from_forum_id)) {
        $is_auth = auth(AUTH_ALL, $from_forum_id, $userdata);
        if ( !$is_auth['auth_mod'] ) {
            $error = true;
            $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_from_not_authorized'];
        }
    }
    if (!empty($to_forum_id)) {
        $is_auth = auth(AUTH_ALL, $to_forum_id, $userdata);
        if ( !$is_auth['auth_mod'] ) {
            $error = true;
            $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_to_not_authorized'];
        }
    }

    //
    // warnings
    //
    // add here warnings regarding ie mycalendar

    // does from topic has a poll ?
    if ($from_poll) {
        if ($to_poll) {
            $message .= (($message != '') ? '<br />' : '') . $lang['Merge_poll_from_and_to'];
        } else {
            $message .= (($message != '') ? '<br />' : '') . $lang['Merge_poll_from'];
        }
    }

    // error found
    if ($error) {
        message_die(GENERAL_ERROR, $error_msg);
    }

    // ask for confirmation or process
    if ($confirm) {
        // process poll
        if ($from_poll) {
            if ($to_poll) {
                // delete the vote
                $vote_id = 0;
                $sql = "SELECT vote_id FROM " . VOTE_DESC_TABLE . " WHERE topic_id=$from_topic_id";
                if ( !$result=$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not read vote description', '', __LINE__, __FILE__, $sql);
                }
                if ($row = $db->sql_fetchrow($result)) {
                    $vote_id = $row['vote_id'];
                }
                $db->sql_freeresult($result);
                if (!empty($vote_id)) {
                    // delete voters
                    $sql = "DELETE FROM " . VOTE_USERS_TABLE . " WHERE vote_id=$vote_id";
                    if ( !$db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not delete votes', '', __LINE__, __FILE__, $sql);
                    }
                    // delete results
                    $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . " WHERE vote_id=$vote_id";
                    if ( !$db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not delete vote results', '', __LINE__, __FILE__, $sql);
                    }
                    // delete description
                    $sql = "DELETE FROM " . VOTE_DESC_TABLE . " WHERE vote_id=$vote_id";
                    if ( !$db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not delete vote description', '', __LINE__, __FILE__, $sql);
                    }
                }
            } else  {
                // grab the poll to the new topic
                $sql = "UPDATE " . VOTE_DESC_TABLE . "
                        SET topic_id=$to_topic_id
                        WHERE topic_id=$from_topic_id";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not update vote desc information', '', __LINE__, __FILE__, $sql);
                }
            }
        }

        // check if the destination is already watched
        $sql = "SELECT * FROM " . TOPICS_WATCH_TABLE . " WHERE topic_id=$to_topic_id";
        if ( !$result=$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not read topics watch informations', '', __LINE__, __FILE__, $sql);
        }
        $user_ids = array();
        while ($row = $db->sql_fetchrow($result)) {
            $user_ids[] = $row['user_id'];
        }
        $db->sql_freeresult($result);
        $sql_user = '';
        if (!empty($user_ids)) {
            $sql_user = " AND user_id NOT IN (" . implode(', ', $user_ids) . ")";
        }
        // grab the topics watch to the new topic
        $sql = "UPDATE " . TOPICS_WATCH_TABLE . " SET topic_id=$to_topic_id WHERE topic_id=$from_topic_id" . $sql_user;
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not update topics watch table', '', __LINE__, __FILE__, $sql);
        }
        // clean up the old topics watch
        $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . " WHERE topic_id=$from_topic_id";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not delete topics watch table', '', __LINE__, __FILE__, $sql);
        }

        // process the posts
        $sql = "UPDATE " . POSTS_TABLE . " SET forum_id=$to_forum_id, topic_id=$to_topic_id WHERE topic_id=$from_topic_id";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not update posts information', '', __LINE__, __FILE__, $sql);
        }

        // get the old topic data for a shadow
        $sql = "SELECT * FROM " . TOPICS_TABLE . " WHERE topic_id=$from_topic_id";
        if ( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not read from-topic informations', '', __LINE__, __FILE__, $sql);
        }
        $topic_data = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        if ($shadow) {
            // transform the merged topic in a shadow
            $sql = "UPDATE " . TOPICS_TABLE . "
                    SET topic_status=" . TOPIC_MOVED . ", topic_type=" . POST_NORMAL . ", topic_moved_id=$to_topic_id
                    WHERE topic_id=$from_topic_id";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not set shadow topic', '', __LINE__, __FILE__, $sql);
            }
        } else {
            // delete the old topic
            $sql = "DELETE FROM " . TOPICS_TABLE . " WHERE topic_id=$from_topic_id";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update delete topic merged', '', __LINE__, __FILE__, $sql);
            }
        }

        // build the update request
        $sql_update = '';
        if ( !empty($topic_title) ) {
            $sql_title = "topic_title = '" . str_replace("\'", "''", $topic_title) . "'";
        }

        // update the poll status
        if ($from_poll && !$to_poll) {
            $sql_update .= ( empty($sql_update) ? '' : ', ') . 'topic_vote=1';
            $sql = "UPDATE " . TOPICS_TABLE . " SET topic_vote=1 WHERE topic_id=$to_topic_id";
        }

        // final update
        if ( !empty($sql_update) ) {
            $sql = " UPDATE " . TOPICS_TABLE . " SET $sql_update WHERE topic_id=$to_topic_id";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update to topic', '', __LINE__, __FILE__, $sql);
            }
        }

        log_action('merge', '', $to_topic_id, $userdata['user_id'], '', '');

         // synchronise the destination topic, and the both forums
        sync('topic', $to_topic_id);
        if ($from_forum_id != $to_forum_id) {
            sync('forum', $from_forum_id);
        }
        sync('forum', $to_forum_id);

        // send end message
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$to_topic_id") . '" />')
        );
        message_die(GENERAL_MESSAGE, $lang['Merge_topic_done'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$to_topic_id") . '" class="gen">', '</a>')  . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '" class="gen">', '</a>'));
        exit;
    } else {
        // ask for confirmation
        $message .= (($message != '') ? '<br />' : '') . sprintf($lang['Merge_confirm_process'], $from_title, $to_title);

        $page_title = $lang['Merge_topics'];
        include_once(NUKE_INCLUDE_DIR.'page_header.php');
        $template->set_filenames(array(
            'body' => 'confirm_body.tpl')
        );

        $s_hidden_fields  = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
        $s_hidden_fields .= '<input type="hidden" name="topic_title" value="' . addslashes($topic_title) . '" />';
        $s_hidden_fields .= '<input type="hidden" name="from_topic" value="' . $from_topic . '" />';
        $s_hidden_fields .= '<input type="hidden" name="to_topic" value="' . $to_topic . '" />';
        $s_hidden_fields .= '<input type="hidden" name="submit" value="1" />';
        if ($shadow) {
            $s_hidden_fields .= '<input type="hidden" name="shadow" value="1" />';
        }

        // header
        $template->assign_vars(array(
            'MESSAGE_TITLE'    => $page_title,
            'MESSAGE_TEXT'     => $message,
            'L_YES'            => $lang['Yes'],
            'L_NO'             => $lang['No'],
            'S_CONFIRM_ACTION' => append_sid('merge.php'),
            'S_HIDDEN_FIELDS'  => $s_hidden_fields,
            )
        );
        // footer
        $template->pparse('body');
        include_once(NUKE_INCLUDE_DIR.'page_tail.php');
        exit;
    }
}

//
// set the page title and include the page header
//
$page_title = $lang['Merge_topics'];
include_once(NUKE_INCLUDE_DIR.'page_header.php');
//
// template name
//
$template->set_filenames(array(
    'body' => 'merge_body.tpl')
);
//
// header
//
$template->assign_vars(array(
    'L_TITLE'                => $page_title,
    'L_TOPIC_TITLE'          => $lang['Merge_title'],
    'L_TOPIC_TITLE_EXPLAIN'  => $lang['Merge_title_explain'],
    'L_FROM_TOPIC'           => $lang['Merge_topic_from'],
    'L_FROM_TOPIC_EXPLAIN'   => $lang['Merge_topic_from_explain'],
    'L_TO_TOPIC'             => $lang['Merge_topic_to'],
    'L_TO_TOPIC_EXPLAIN'     => $lang['Merge_topic_to_explain'],
    'L_SHADOW'               => $lang['Leave_shadow_topic'],
    'L_SUBMIT'               => $lang['Submit'],
    'L_CANCEL'               => $lang['Cancel'],
    'L_REFRESH'              => $lang['Refresh'],
    'L_SEARCH'               => $lang['Select'],
    )
);
if (!empty($to_title) && empty($topic_title)) {
    $topic_title = $to_title;
}
// values
$template->assign_vars(array(
    'TOPIC_TITLE' => $topic_title,
    'FROM_TOPIC'  => $from_topic,
    'TO_TOPIC'    => $to_topic,
    'SHADOW'      => ($shadow) ? 'checked="checked"' : '',
    )
);

// system
$s_hidden_fields  = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
$template->assign_vars(array(
    'S_ACTION'        => append_sid('merge.php'),
    'S_HIDDEN_FIELDS' => $s_hidden_fields,
    )
);
//
// footer
//
$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>