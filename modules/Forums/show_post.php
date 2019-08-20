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

// Start initial var setup
$topic_id = $post_id = 0;
$post_id  = $_GETVAR->get('p', 'get', 'int', -1);
$view     = $_GETVAR->get('view', 'get', 'string', NULL);

if ( !isset($post_id) || $post_id == -1 ) {
    message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

// Find topic id if user requested a newer
// or older topic
if ( $view ) {
    if ( $view == 'next' || $view == 'previous' ) {
        $sql_condition = ( $view == 'next' ) ? '>' : '<';
        $sql_ordering  = ( $view == 'next' ) ? 'ASC' : 'DESC';

        $sql = "SELECT topic_id, post_time FROM " . POSTS_TABLE . " WHERE post_id = " . $post_id . " LIMIT 1";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, "Could not obtain newer/older post information", '', __LINE__, __FILE__, $sql);
        }
        $row = $db->sql_fetchrow($result);

        $topic_id  = $row['topic_id'];
        $post_time = $row['post_time'];
        $sql = "SELECT post_id FROM " . POSTS_TABLE . "
                WHERE topic_id = $topic_id
                AND post_time $sql_condition " . $post_time . "
                ORDER BY post_time $sql_ordering
                LIMIT 1";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, "Could not obtain newer/older post information", '', __LINE__, __FILE__, $sql);
        }
        if ($row = $db->sql_fetchrow($result)) {
            $post_id = $row['post_id'];
        } else {
            $message = ( $view == 'next' ) ? 'No_newer_posts' : 'No_older_posts';
            message_die(GENERAL_MESSAGE, $message);
        }
    }
}

//
// Get topic info ...
//
$sql = "SELECT t.topic_title, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments
        FROM (" . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f, " . POSTS_TABLE . " p)
        WHERE p.post_id = $post_id
        AND t.topic_id = p.topic_id
        AND f.forum_id = t.forum_id";

$tmp = '';
attach_setup_viewtopic_auth($tmp, $sql);

if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}
if ( !($forum_row = $db->sql_fetchrow($result)) ) {
    message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}
$db->sql_freeresult($result);
$forum_id = $forum_row['forum_id'];
$topic_title = $forum_row['topic_title'];

// Start session management
$userdata = session_pagestart($user_ip, PAGE_POSTS);
init_userprefs($userdata);
// End session management

$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

if ( !$is_auth['auth_read'] ) {
    message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']));
}

// Define censored word matches
if ( empty($orig_word) && empty($replacement_word) ) {
    $orig_word = array();
    $replacement_word = array();
    obtain_word_list($orig_word, $replacement_word);
}

// Censor topic title
if ( count($orig_word) ) {
    $topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
}

// Dump out the page header and load viewtopic body template
$gen_simple_header = TRUE;
$page_title = $lang['Post_review'] . ' - ' . $topic_title;
include_once(NUKE_INCLUDE_DIR.'page_header_review.php');

$template->set_filenames(array(
    'reviewbody' => 'post_review.tpl')
);

if ( $popup != 1 ) {
    $view_prev_post_url = append_sid('show_post.php?p=' . $post_id . '&amp;view=previous');
    $view_next_post_url = append_sid('show_post.php?p=' . $post_id . '&amp;view=next');

    $template->assign_vars(array(
        'L_AUTHOR'              => $lang['Author'],
        'L_MESSAGE'             => $lang['Message'],
        'L_POSTED'              => $lang['Posted'],
        'L_POST_SUBJECT'        => $lang['Post_subject'],
        'L_VIEW_NEXT_POST'      => $lang['View_next_post'],
        'L_VIEW_PREVIOUS_POST'  => $lang['View_previous_post'],
        'U_VIEW_OLDER_POST'     => $view_prev_post_url,
        'U_VIEW_NEWER_POST'     => $view_next_post_url)
    );
} else {
    $template->assign_vars(array(
        'L_AUTHOR'          => $lang['Author'],
        'L_MESSAGE'         => $lang['Message'],
        'L_POSTED'          => $lang['Posted'],
        'L_POST_SUBJECT'    => $lang['Post_subject'])
    );
}
// send to template
$template->assign_vars(array(
    'SPACER'        => $images['spacer'],
    'SPACER_IMG'    => $images['spacer'],
    )
);

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

// Go ahead and pull all data for this topic
$sql = "SELECT u.*, p.*, u.user_allow_viewonline, u.user_session_time, pt.post_text, pt.post_subject, pt.bbcode_uid
        FROM (" . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt)
        WHERE p.post_id = $post_id
        AND p.poster_id = u.user_id
        AND p.post_id = pt.post_id
        LIMIT 1";
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not obtain post/user information', '', __LINE__, __FILE__, $sql);
}

//init_display_review_attachments($is_auth);
//
// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
//
if ( $row = $db->sql_fetchrow($result) ) {
    $mini_post_img = $images['icon_minipost'];
    $mini_post_alt = $lang['Post'];

    $i = 0;
    do {
        $poster_id      = $row['user_id'];
        $poster         = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $row['username'];
        $post_date      = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']);
        $poster_posts   = ( $row['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $row['user_posts'] : '';
        $poster_from    = ( $row['user_from'] && $row['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $row['user_from'] : '';
        $poster_from    = preg_replace('#.gif#', '', $poster_from);
        $poster_joined  = ( $row['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . formatTimestamp(strtotime(substr($row['user_regdate'], 4,2).' '.substr($row['user_regdate'], 0,3).' '.substr($row['user_regdate'], 8,4)), '', '1') : '';
        $poster_avatar  = GetAvatar($poster_id);
        // Generate ranks, set them to empty string initially.
        $poster_rank = '';
        $rank_image = '';
        if ( $row['user_id'] == ANONYMOUS ) {
            // do nothing
        } else if ( $row['user_rank'] ) {
            for($j = 0; $j < count($ranksrow); $j++) {
                if ( $row['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] ) {
                    $poster_rank = $ranksrow[$j]['rank_title'];
                    $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
                }
            }
        } else {
            for($j = 0; $j < count($ranksrow); $j++) {
                if ( $row['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] ) {
                    $poster_rank = $ranksrow[$j]['rank_title'];
                    $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
                }
            }
        }

        // Handle anon users posting with usernames
        if ( $poster_id == ANONYMOUS && !empty($row['post_username']) ) {
            $poster = $row['post_username'];
            $poster_rank = $lang['Guest'];
        }

        $temp_url = '';

        if ( $poster_id != ANONYMOUS ) {
            $contact_img = EvoKernel_UserContactImg($row);
        } else {
            $contact_img = EvoKernel_UserContactImg(ANONYMOUS);
        }
        $temp_url = append_sid('posting.php?mode=quote&amp;' . POST_POST_URL . '=' . $row['post_id']);
        $quote_img = '<a href="' . $temp_url . '" target="_parent"><img src="' . $images['icon_quote'] . '" alt="' . $lang['Reply_with_quote'] . '" title="' . $lang['Reply_with_quote'] . '" border="0" /></a>';
        $quote = '<a href="' . $temp_url . '" target="_parent">' . $lang['Reply_with_quote'] . '</a>';
        if ($board_config['smilies_in_titles']) {
            $post_subject = smilies_pass(( !empty($row['post_subject'] )) ? $row['post_subject'] : '');
        } else {
            $post_subject = ( !empty($row['post_subject'] )) ? $row['post_subject'] : '';
        }
        $message = $row['post_text'];
        $bbcode_uid = $row['bbcode_uid'];
        if($userdata['user_showsignatures']){
             $user_sig = ( $row['enable_sig'] && !empty($row['user_sig']) && $board_config['allow_sig'] ) ? $row['user_sig'] : '';
        }
        $user_sig_bbcode_uid = $row['user_sig_bbcode_uid'];
        // Note! The order used for parsing the message _is_ important, moving things around could break any
        // output
        //
        // If the board has HTML off but the post has HTML
        // on then we process it, else leave it alone
        //
        if ( !$board_config['allow_html'] || !$userdata['user_allowhtml']) {
            if ( !empty($user_sig) ) {
                $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
            }
            if ( $row['enable_html'] ) {
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

        // Parse smilies
        if ( $board_config['allow_smilies'] ) {
            if ( $row['user_allowsmile'] && !empty($user_sig) ) {
                $user_sig = smilies_pass($user_sig);
            }
            if ( $row['enable_smilies'] ) {
                $message = smilies_pass($message);
            }
        }
        // Replace naughty words
        if (count($orig_word)) {
            $post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
            if (!empty($user_sig)) {
              $user_sig = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $user_sig . '<'), 1, -1));
            }
            $message = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $message . '<'), 1, -1));
        }

        // Replace newlines (we use this rather than nl2br because
        // till recently it wasn't XHTML compliant)
        //
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
        if ( $row['post_edit_count'] ) {
            $l_edit_time_total = ( $row['post_edit_count'] == 1 ) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];
            $l_edited_by = '<br /><br />' . sprintf($l_edit_time_total, $poster, create_date($board_config['default_dateformat'], $row['post_edit_time'], $board_config['board_timezone']), $row['post_edit_count']);
        } else {
            $l_edited_by = '';
        }
        if ( $userdata['session_logged_in'] ) {
            $report_img = '<a href="' . append_sid('viewtopic.php?report=TRUE&amp;' . POST_POST_URL . '=' . $post_id ) . '"><img src="' . $images['icon_report'] . '" border="0" alt="' . $lang['Report_post'] . '" title="' . $lang['Report_post'] . '" /></a>&nbsp;';
        } else {
            $report_img = '';
        }
        // Again this will be handled by the templating
        // code at some point
        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

        $template->assign_block_vars('postrow', array(
            'ROW_COLOR'         => '#' . $row_color,
            'ROW_CLASS'         => $row_class,
            'POSTER_NAME'       => UsernameColor($poster),
            'POSTER_RANK'       => $poster_rank,
            'RANK_IMAGE'        => $rank_image,
            'POSTER_JOINED'     => $poster_joined,
            'POSTER_POSTS'      => $poster_posts,
            'POSTER_FROM'       => $poster_from,
            'POSTER_AVATAR'     => $poster_avatar,
            'POSTER_ONLINE_STATUS_IMG' => $contact_img['online_status_img'],
            'POSTER_ONLINE_STATUS'     => $contact_img['online_status'],
            'POST_DATE'         => $post_date,
            'POST_SUBJECT'      => $post_subject,
            'MESSAGE'           => $message,
            'SIGNATURE'         => $user_sig,
            'EDITED_MESSAGE'    => $l_edited_by,
            'MINI_POST_IMG'     => $mini_post_img,
            'PROFILE_IMG'       => $contact_img['profile_img'],
            'PROFILE'           => $contact_img['profile'],
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
            'QUOTE_IMG'         => $quote_img,
            'REPORT_IMG'        => $report_img,
            'QUOTE'             => $quote,
            'L_MINI_POST_ALT'   => $mini_post_alt,
            'U_POST_ID'         => $row['post_id'])
        );
        $i++;
    } while ( $row = $db->sql_fetchrow($result) );
} else {
    message_die(GENERAL_MESSAGE, 'Topic_post_not_exist', '', __LINE__, __FILE__, $sql);
}

$template->pparse('reviewbody');
include_once(NUKE_INCLUDE_DIR.'page_tail_review.php');

?>