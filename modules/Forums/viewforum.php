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

$popup = $_GETVAR->get('popup', '_REQUEST', 'int');

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}


include($phpbb_root_path . 'common.php');
include_once($phpbb_root_path . 'post_icon_mod/includes/def_icons.php');
include_once(NUKE_INCLUDE_DIR.'functions_separate.php');
include_once(NUKE_INCLUDE_DIR.'bbcode.php');

// Start initial var setup
$forum_id = $_GETVAR->get(POST_FORUM_URL, 'request', 'int', NULL) ? $_GETVAR->get(POST_FORUM_URL, 'request', 'int') : '';
define('IN_VIEWFORUM', TRUE);
if ( $_GETVAR->get('selected_id', 'request', 'string', NULL) ) {
    $selected_id = $_GETVAR->get('selected_id', 'request', 'string');
    $type = substr($selected_id, 0, 1);
    $id   = intval(substr($selected_id, 1));
    if ($type == POST_FORUM_URL)   {
        $forum_id = $id;
    } else if (($type == POST_CAT_URL) || ($selected_id == 'Root')) {
        $parm = ($id != 0) ? "?" . POST_CAT_URL . "=$id" : '';
        redirect(append_sid('index.php' . $parm));
        exit;
    }
}
$start      = $_GETVAR->get('start', 'get', 'int', 0);
$start      = ($start < 0) ? 0 : $start;
$mark_read  = $_GETVAR->get('mark', 'request', 'string', '');

// Start session management
$userdata = session_pagestart($user_ip, (isset($forum_id) ? $forum_id : PAGE_FORUMS));
init_userprefs($userdata);
// End session management

// get the forum row
$forum_row = $tree['data'][ $tree['keys'][ POST_FORUM_URL . $forum_id ] ];
if ( empty($forum_row) ) {
    message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

// handle forum link type
$selected_id = POST_FORUM_URL . $forum_id;
$this_var = isset($tree['keys'][$selected_id]) ? $tree['keys'][$selected_id] : -1;
if ( ($this_var > -1) && !empty($tree['data'][$this_var]['forum_link'])) {
    // add 1 to hit if count ativated
    if ($tree['data'][$this_var]['forum_link_hit_count']) {
        $sql = "UPDATE " . FORUMS_TABLE . " 
                SET forum_link_hit = forum_link_hit + 1 
                WHERE forum_id=$forum_id";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Could not increment forum hits information', '', __LINE__, __FILE__, $sql);
        }
        cache_tree(TRUE);
    }

    // prepare url
    $url = $tree['data'][$this_var]['forum_link'];
    if ($tree['data'][$this_var]['forum_link_internal']) {
        $part = explode( '?', $url);
        $url .= ((count($part) > 1) ? '&' : '?') . 'sid=' . $userdata['session_id'];
        $url = append_sid($url);
        // redirect to url
        redirect($url);
    }
    // Redirect via an HTML form for PITA webservers
    if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) {
        header('Refresh: 0; URL=' . $url);
        echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><meta http-equiv="refresh" content="0; url=' . $url . '"><title>' . $lang['Redirect'] . '</title></head><body><div align="center">' . sprintf($lang['Rediect_to'], '<a href="' . $url . '">', '</a>') . '</div></body></html>';
        exit;
    }
    // Behave as per HTTP/1.1 spec for others
    header('Location: ' . $url);
    exit;
}

// Start auth check
$is_auth = array();
$is_auth = $tree['auth'][POST_FORUM_URL . $forum_id];

if ( !$is_auth['auth_read'] || !$is_auth['auth_view'] ) {
    if ( !is_user() ) {
        $redirect = POST_FORUM_URL . "=$forum_id" . ( ( isset($start) ) ? "&amp;start=$start" : '' );
        redirect(append_sid('login.php?redirect=viewforum.php&amp;'.$redirect, TRUE));
    }
    // The user is not authed to read this forum ...
    $message = ( !$is_auth['auth_view'] ) ? $lang['Forum_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
    message_die(GENERAL_MESSAGE, $message);
}
// End of auth check

// Handle marking posts
if ( $mark_read == 'topics' ) {
    if ( is_user() ) {
        $tracking_forums = evo_getcookie($board_config['cookie_name'] . '_f') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_f')) : array();
        $tracking_forums[$forum_id] = time();
        evo_setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), 2592000);
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.php?" . POST_FORUM_URL . "=$forum_id") . '" />')
        );
    }
    $message = $lang['Topics_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.php?" . POST_FORUM_URL . "=$forum_id") . '">', '</a> ');
    message_die(GENERAL_MESSAGE, $message);
}
// End handle marking posts
$tracking_topics = evo_getcookie($board_config['cookie_name'] . '_t') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_t')) : array();
$tracking_forums = evo_getcookie($board_config['cookie_name'] . '_f') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_f')) : array();
$tracking_forumsall = evo_getcookie($board_config['cookie_name'] . '_all') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_all')) : FALSE;
// Do the forum Prune
if ( $is_auth['auth_mod'] && $board_config['prune_enable'] ) {
    if ( $forum_row['prune_next'] < time() && $forum_row['prune_enable'] ) {
        include_once(NUKE_INCLUDE_DIR.'prune.php');
        require_once(NUKE_INCLUDE_DIR.'functions_admin.php');
        auto_prune($forum_id);
    }
}
// End of forum prune

// Obtain list of moderators of each forum
// First users, then groups ... broken into two queries

// moderators list
$moderators = array();
$idx = $tree['keys'][ POST_FORUM_URL . $forum_id ];
$xy = (isset($tree['mods'][$idx]['user_id']) ? count($tree['mods'][$idx]['user_id']) : 0);
for ( $i = 0; $i < $xy; $i++ ) {
    $moderators[] = '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $tree['mods'][$idx]['user_id'][$i]) . '">' . UsernameColor($tree['mods'][$idx]['username'][$i]) . '</a>';
}
$xy = (isset($tree['mods'][$idx]['group_id']) ? count($tree['mods'][$idx]['group_id']) : 0);
for ( $i = 0; $i < $xy; $i++ ) {
    $moderators[] = '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=" . $tree['mods'][$idx]['group_id'][$i]) . '">' . GroupColor($tree['mods'][$idx]['group_name'][$i]) . '</a>';
}

$l_moderators = ( count($moderators) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
$forum_moderators = ( count($moderators) ) ? implode(', ', $moderators) : $lang['None'];
unset($moderators);

// Generate a 'Show topics in previous x days' select box. If the topicsdays var is sent
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Topics'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if ( $_GETVAR->get('topicdays', 'request', 'int', NULL) ) {
    $topic_days = $_GETVAR->get('topicdays', 'request', 'int');
    $min_topic_time = time() - ($topic_days * 86400);

    $sql = "SELECT COUNT(t.topic_id) AS forum_topics
            FROM (" . TOPICS_TABLE . " t, " . POSTS_TABLE . " p)
            WHERE t.forum_id = '$forum_id'
            AND p.post_id = t.topic_last_post_id
            AND p.post_time >= '$min_topic_time'";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not obtain limited topics count information', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $topics_count = ( $row['forum_topics'] ) ? $row['forum_topics'] : 1;
    $limit_topics_time = "AND p.post_time >= $min_topic_time";
    if ( $_GETVAR->get('topicdays', 'post', 'int', NULL) ) {
        $start = 0;
    }
} else {
    $topics_count = ( $forum_row['forum_topics'] ) ? $forum_row['forum_topics'] : 1;
    $limit_topics_time = '';
    $topic_days = 0;
}

$select_topic_days = '<select name="topicdays">';
for($i = 0; $i < count($previous_days); $i++) {
    $selected = ($topic_days == $previous_days[$i]) ? ' selected="selected"' : '';
    $select_topic_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_topic_days .= '</select>';

$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username
        FROM (" . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2)
        WHERE t.topic_poster = u.user_id
        AND p.post_id = t.topic_last_post_id
        AND p.poster_id = u2.user_id
        AND t.topic_type = " . POST_GLOBAL_ANNOUNCE . "
        ORDER BY t.topic_priority DESC, t.topic_last_post_id DESC ";
if( !$result = $db->sql_query($sql) ) {
    message_die(GENERAL_ERROR, "Couldn't obtain topic information", "", __LINE__, __FILE__, $sql);
}

$topic_rowset = array();
$total_announcements = 0;
while( $row = $db->sql_fetchrow($result) ) {
    $topic_rowset[] = $row;
    $total_announcements++;
}
$db->sql_freeresult($result);

// All announcement data, this keeps announcements
// on each viewforum page ...
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username
        FROM (" . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2)
        WHERE t.forum_id = '$forum_id'
        AND t.topic_poster = u.user_id
        AND p.post_id = t.topic_last_post_id
        AND p.poster_id = u2.user_id
        AND t.topic_type = " . POST_ANNOUNCE . "
        ORDER BY t.topic_last_post_id DESC ";
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) ) {
    $topic_rowset[] = $row;
    $total_announcements++;
}
$db->sql_freeresult($result);

// Grab all the basic data (all topics except announcements)
// for this forum
$dft_sort = $forum_row['forum_display_sort'];
$dft_order = $forum_row['forum_display_order'];

// Sort def
$sort_value = $dft_sort;
if ( $_GETVAR->get('sort', 'request', 'int', NULL) ) {
    $sort_value = $_GETVAR->get('sort', 'request', 'int');
}
$sort_list = '<select name="sort">' . get_forum_display_sort_option($sort_value, 'list', 'sort') . '</select>';

// Order def
$order_value = $dft_order;
if ( $_GETVAR->get('order', 'request', 'int', NULL) ) {
    $order_value = $_GETVAR->get('order', 'request', 'int');
}
$order_list = '<select name="order">' . get_forum_display_sort_option($order_value, 'list', 'order') . '</select>';

// display
$s_display_order = '&nbsp;' . $lang['Sort_by'] . ':&nbsp;' . $sort_list . $order_list . '&nbsp;';

// selected method
$sort_method = get_forum_display_sort_option($sort_value, 'field', 'sort');
$sort_method = ($sort_method ? ','.$sort_method : '');
$order_method = get_forum_display_sort_option($order_value, 'field', 'order');
$sql = "SELECT t.*, u.username, u.user_id, u2.username as username2, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time
        FROM (" . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2)
        WHERE t.forum_id = '$forum_id'
        AND t.topic_poster = u.user_id
        AND p.post_id = t.topic_first_post_id
        AND p2.post_id = t.topic_last_post_id
        AND u2.user_id = p2.poster_id
        AND t.topic_type <> " . POST_ANNOUNCE . "
        AND t.topic_type <> " . POST_GLOBAL_ANNOUNCE . "
        $limit_topics_time
        ORDER BY t.topic_type DESC, t.topic_priority DESC $sort_method $order_method, t.topic_last_post_id DESC
        LIMIT $start, ".$board_config['topics_per_page'];
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

$total_topics = 0;
while( $row = $db->sql_fetchrow($result) ) {
    $topic_rowset[] = $row;
    $total_topics++;
}
$db->sql_freeresult($result);

// Total topics ...
$total_topics += $total_announcements;
$dividers = get_dividers($topic_rowset);
// Define censored word matches
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

// Post URL generation for templating vars
$template->assign_vars(array(
    'L_DISPLAY_TOPICS'      => $lang['Display_topics'],
    'U_POST_NEW_TOPIC'      => append_sid('posting.php?mode=newtopic&amp;' . POST_FORUM_URL . '='.$forum_id),
    'S_SELECT_TOPIC_DAYS'   => $select_topic_days,
    'S_POST_DAYS_ACTION'    => append_sid('viewforum.php?' . POST_FORUM_URL . '=' . $forum_id . '&amp;start='.$start))
);

// User authorisation levels output
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';
attach_build_auth_levels($is_auth, $s_auth_can);
if ( $is_auth['auth_mod'] ) {
    $s_auth_can .= sprintf($lang['Rules_moderate'], '<a href="' . append_sid("modcp.php?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
}

// Mozilla navigation bar
$nav_links['up'] = array(
    'url'   => append_sid('index.php'),
    'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
);

// Dump out the page header and load viewforum template
$forum_row['forum_name'] = get_object_lang(POST_FORUM_URL . $forum_id, 'name');
define('SHOW_ONLINE', TRUE);
$page_title = $lang['View_forum'] . ' - ' . $forum_row['forum_name'];

include_once(NUKE_INCLUDE_DIR.'page_header.php');

$template->set_filenames(array(
    'body' => 'viewforum_body.tpl')
);
jumpbox('viewforum.php');
display_index(POST_FORUM_URL . $forum_id);

$template->assign_vars(array(
        'FORUM_ID'                      => $forum_id,
        'FORUM_NAME'                    => $forum_row['forum_name'],
        'MODERATORS'                    => $forum_moderators,
        'POST_IMG'                      => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'],
        'FOLDER_IMG'                    => $images['folder'],
        'FOLDER_NEW_IMG'                => $images['folder_new'],
        'FOLDER_HOT_IMG'                => $images['folder_hot'],
        'FOLDER_HOT_NEW_IMG'            => $images['folder_hot_new'],
        'FOLDER_LOCKED_IMG'             => $images['folder_locked'],
        'FOLDER_LOCKED_NEW_IMG'         => $images['folder_locked_new'],
        'FOLDER_STICKY_IMG'             => $images['folder_sticky'],
        'FOLDER_STICKY_NEW_IMG'         => $images['folder_sticky_new'],
        'FOLDER_ANNOUNCE_IMG'           => $images['folder_announce'],
        'FOLDER_ANNOUNCE_NEW_IMG'       => $images['folder_announce_new'],
        'FOLDER_GLOBAL_ANNOUNCE_IMG'    => $images['folder_global_announce'],
        'FOLDER_GLOBAL_ANNOUNCE_NEW_IMG'=> $images['folder_global_announce_new'],
        'L_TOPICS'                      => $lang['Topics'],
        'L_REPLIES'                     => $lang['Replies'],
        'L_VIEWS'                       => $lang['Views'],
        'L_POSTS'                       => $lang['Posts'],
        'L_LASTPOST'                    => $lang['Last_Post'],
        'L_MODERATOR'                   => $l_moderators,
        'L_MARK_TOPICS_READ'            => $lang['Mark_all_topics'],
        'L_POST_NEW_TOPIC'              => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'],
        'L_NO_NEW_POSTS'                => $lang['No_new_posts'],
        'L_NEW_POSTS'                   => $lang['New_posts'],
        'L_NO_NEW_POSTS_LOCKED'         => $lang['No_new_posts_locked'],
        'L_NEW_POSTS_LOCKED'            => $lang['New_posts_locked'],
        'L_NO_NEW_POSTS_HOT'            => $lang['No_new_posts_hot'],
        'L_NEW_POSTS_HOT'               => $lang['New_posts_hot'],
        'L_ANNOUNCEMENT'                => $lang['Post_Announcement'],
        'L_GLOBAL_ANNOUNCEMENT'         => $lang['Post_global_announcement'],
        'L_STICKY'                      => $lang['Post_Sticky'],
        'L_POSTED'                      => $lang['Posted'],
        'L_JOINED'                      => $lang['Joined'],
        'L_AUTHOR'                      => $lang['Author'],
        'S_AUTH_LIST'                   => $s_auth_can,
        'U_VIEW_FORUM'                  => append_sid('viewforum.php?' . POST_FORUM_URL .'='.$forum_id),
        'U_MARK_READ'                   => append_sid('viewforum.php?' . POST_FORUM_URL .'='.$forum_id.'&amp;mark=topics'))
);
// End header

/*--FNA #1--*/

// Okay, lets dump out the page ...
$template->assign_vars(array(
    'S_DISPLAY_ORDER' => $s_display_order)
);
if( $total_topics ) {
    for($i = 0; $i < $total_topics; $i++) {
        $topic_id = $topic_rowset[$i]['topic_id'];
        $topic_title = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_rowset[$i]['topic_title']) : $topic_rowset[$i]['topic_title'];
        $topic_title = ($board_config['smilies_in_titles']) ? smilies_pass($topic_title) : $topic_title;
        $replies = $topic_rowset[$i]['topic_replies'];
        $topic_type = $topic_rowset[$i]['topic_type'];
        $type = $topic_rowset[$i]['topic_type'];
        if ($type == POST_NORMAL) {
            if (!empty($topic_rowset[$i]['topic_calendar_time'])) {
                $type = POST_CALENDAR;
            }
            if (!empty($topic_rowset[$i]['topic_pic_url'])) {
                $type = POST_PICTURE;
            }
        }
        $icon = get_icon_title($topic_rowset[$i]['topic_icon'], 1, $type);
        $topic_type = '';
        if( $topic_rowset[$i]['topic_vote'] ) {
            $topic_type .= $lang['Topic_Poll'] . ' ';
        }
        if( $topic_rowset[$i]['topic_status'] == TOPIC_MOVED ) {
            $topic_id = $topic_rowset[$i]['topic_moved_id'];
            $topic_title = $board_config['moved_view_open'] . "&nbsp;" . $topic_title . $board_config['moved_view_close'];
            $folder_image =  $images['folder'];
            $folder_alt = $lang['Topics_Moved'];
            $newest_post_img = '';
        } else {
            if( $topic_rowset[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE ) {
                $folder = $images['folder_global_announce'];
                $folder_new = $images['folder_global_announce_new'];
                $topic_title = $board_config['global_view_open'] . "&nbsp;" . $topic_title . $board_config['global_view_close'];
            } else if( $topic_rowset[$i]['topic_type'] == POST_ANNOUNCE ) {
                $folder = $images['folder_announce'];
                $folder_new = $images['folder_announce_new'];
                $topic_title = $board_config['announce_view_open'] . "&nbsp;" . $topic_title . $board_config['announce_view_close'];
            } else if( $topic_rowset[$i]['topic_type'] == POST_STICKY ) {
                $folder = $images['folder_sticky'];
                $folder_new = $images['folder_sticky_new'];
                $topic_title = $board_config['sticky_view_open'] . "&nbsp;" . $topic_title . $board_config['sticky_view_close'];
            } else if( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) {
                $folder = $images['folder_locked'];
                $folder_new = $images['folder_locked_new'];
                $topic_title = $board_config['locked_view_open'] . "&nbsp;" . $topic_title . $board_config['locked_view_close'];
            } else {
                if($replies >= $board_config['hot_threshold']) {
                    $folder = $images['folder_hot'];
                    $folder_new = $images['folder_hot_new'];
                } else {
                    $folder = $images['folder'];
                    $folder_new = $images['folder_new'];
                }
            }
            $newest_post_img = '';
            $unread_topics = false;
            if( is_user() ) {
                if( $topic_rowset[$i]['post_time'] > $userdata['user_lastvisit'] ) {
                    $unread_topics = TRUE;
                }
            }
            if( isset($tracking_topics[$topic_id]) || isset($tracking_forums[$forum_id]) ) {
                if (isset($tracking_topics[$topic_id]) && ($tracking_topics[$topic_id] > $topic_rowset[$i]['post_time']) ) {
                    $unread_topics = FALSE;
                } else {
                    if ($tracking_forums[$forum_id] > $topic_rowset[$i]['post_time'])  {
                        $unread_topics = FALSE;
                    }
                }
            }
            if (isset($tracking_forumsall) && $tracking_forumsall > $topic_rowset[$i]['post_time']) {
                $unread_topics = FALSE;
            }
            if( $unread_topics ) {
                $folder_image = $folder_new;
                $folder_alt = $lang['New_posts'];
                $newest_post_img = '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
            } else {
                $folder_image = $folder;
                $folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
                $newest_post_img = '';
            }
        }
        if( ( $replies + 1 ) > $board_config['posts_per_page'] ) {
            $total_pages = ceil( ( $replies + 1 ) / $board_config['posts_per_page'] );
            $goto_page = ' [ <img src="' . $images['icon_gotopost'] . '" alt="' . $lang['Goto_page'] . '" title="' . $lang['Goto_page'] . '" />' . $lang['Goto_page'] . ': ';
            $times = 1;
            for($j = 0; $j < $replies + 1; $j += $board_config['posts_per_page']) {
                $goto_page .= '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=" . $topic_id . "&amp;start=$j") . '">' . $times . '</a>';
                if( $times == 1 && $total_pages > 4 ) {
                    $goto_page .= ' ... ';
                    $times = $total_pages - 3;
                    $j += ( $total_pages - 4 ) * $board_config['posts_per_page'];
                } else if ( $times < $total_pages ) {
                    $goto_page .= ', ';
                }
                $times++;
            }
            $goto_page .= ' ] ';
        } else {
            $goto_page = '';
        }
        $topic_rowset[$i]['username']  = UsernameColor($topic_rowset[$i]['username']);
        $topic_rowset[$i]['username2'] = (isset($topic_rowset[$i]['username2']) ? UsernameColor($topic_rowset[$i]['username2']) : '');
        $topic_rowset[$i]['user2']     = UsernameColor($topic_rowset[$i]['user2']);
        $view_topic_url                = append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id");
        $topic_author                  = ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $topic_rowset[$i]['user_id']) . '">' : '';
        $topic_author                 .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? $topic_rowset[$i]['username'] : ( ( $topic_rowset[$i]['post_username'] != '' ) ? $topic_rowset[$i]['post_username'] : $lang['Guest'] );
        $topic_author                 .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '</a>' : '';
        $first_post_time               = create_date($board_config['default_dateformat'], $topic_rowset[$i]['topic_time'], $board_config['board_timezone']);
        $last_post_time                = create_date($board_config['default_dateformat'], $topic_rowset[$i]['post_time'], $board_config['board_timezone']);
        $last_post_author              = ( $topic_rowset[$i]['id2'] == ANONYMOUS ) ? ( ($topic_rowset[$i]['post_username2'] != '' ) ? $topic_rowset[$i]['post_username2'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $topic_rowset[$i]['id2']) . '">' . $topic_rowset[$i]['user2'] . '</a>';
        $last_post_url                 = '<a href="' . append_sid("viewtopic.php?"  . POST_POST_URL . '=' . $topic_rowset[$i]['topic_last_post_id']) . '#' . $topic_rowset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" /></a>';
        $views                         = $topic_rowset[$i]['topic_views'];

        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

        /*--FNA #2--*/

        $template->assign_block_vars('topicrow', array(
            'ICON'                  => $icon,
            'ROW_COLOR'             => $row_color,
            'ROW_CLASS'             => $row_class,
            'FORUM_ID'              => $forum_id,
            'TOPIC_ID'              => $topic_id,
            'TOPIC_FOLDER_IMG'      => $folder_image,
            'TOPIC_AUTHOR'          => $topic_author,
            'GOTO_PAGE'             => $goto_page,
            'REPLIES'               => $replies,
            'NEWEST_POST_IMG'       => $newest_post_img,
            'TOPIC_ATTACHMENT_IMG'  => topic_attachment_image($topic_rowset[$i]['topic_attachment']),
            'TOPIC_TITLE'           => $topic_title,
            'TOPIC_TYPE'            => $topic_type,
            'VIEWS'                 => $views,
            'FIRST_POST_TIME'       => $first_post_time,
            'LAST_POST_TIME'        => $last_post_time,
            'LAST_POST_AUTHOR'      => $last_post_author,
            'LAST_POST_IMG'         => $last_post_url,
            /*--FNA #3--*/
            'L_TOPIC_FOLDER_ALT'    => $folder_alt,
            'U_VIEW_TOPIC'          => $view_topic_url)
        );
        if ( array_key_exists($i, $dividers) ) {
            $template->assign_block_vars('topicrow.divider', array(
                'L_DIV_HEADERS' => $dividers[$i])
            );
        }
    }
    $total_topics -= $total_announcements;
    $template->assign_vars(array(
        'PAGINATION'  => generate_pagination("viewforum.php?" . POST_FORUM_URL . "=$forum_id&amp;topicdays=$topic_days&amp;sort=$sort_value&amp;order=$order_value", $topics_count, $board_config['topics_per_page'], $start),
        'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $topics_count / $board_config['topics_per_page'] )),
        'L_GOTO_PAGE' => $lang['Goto_page'])
    );
} else {
    // No topics
    $no_topics_msg = ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['No_topics_post_one'];
    $template->assign_vars(array(
        'L_NO_TOPICS' => $no_topics_msg)
    );
    $template->assign_block_vars('switch_no_topics', array() );
}

if (show_glance('forums')) {
    include_once($phpbb_root_path . 'glance.php');
}

$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>