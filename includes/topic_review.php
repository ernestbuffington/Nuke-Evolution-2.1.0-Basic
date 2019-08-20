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

if(!defined('NUKE_EVO') && !defined('IN_PHPBB') ) {
   die('You can\'t access this file directly...');
}

function topic_review($topic_id, $is_inline_review) {
    global $db, $evoconfig, $template, $lang, $images, $theme, $userdata, $user_ip, $starttime;
    // $is_inline_review has to be set to true, if we are in Reply mode and want to have an iframe
    $is_auth = array();
    if ( !$is_inline_review ) {
        if ( !isset($topic_id) || !$topic_id) {
            message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
        }
        //
        // Get topic info ...
        //
        $sql = "SELECT t.topic_title, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments
                FROM (" . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f)
                WHERE t.topic_id = '$topic_id'
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
        $forum_id    = $forum_row['forum_id'];
        $topic_title = $forum_row['topic_title'];
        $is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);
        if ( !$is_auth['auth_read'] ) {
            message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']));
        }
    }
    //
    // Dump out the page header and load viewtopic body template
    //
    init_display_review_attachments($is_auth);
    //
    // Go ahead and pull all data for this topic
    //
    $sql = "SELECT u.username, u.user_id, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
            FROM (" . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt)
            WHERE p.topic_id = '$topic_id'
            AND p.poster_id = u.user_id
            AND p.post_id = pt.post_id
            ORDER BY p.post_time DESC
            LIMIT " . $evoconfig['posts_per_page'];
    if ( !($result = $db->sql_query($sql,false)) ) {
        message_die(GENERAL_ERROR, 'Could not obtain post/user information', '', __LINE__, __FILE__, $sql);
    }
    //
    $row = $db->sql_fetchrow($result,SQL_BOTH);
    if ( $row ) {
        $mini_post_img = $images['icon_minipost'];
        $mini_post_alt = $lang['Post'];
        $i = 0;
        do {
            $poster_id = $row['user_id'];
            $plain_poster = $row['username'];
            $poster = UsernameColor($row['username']);
            $post_date = create_date($evoconfig['default_dateformat'], $row['post_time'], $evoconfig['board_timezone']);
            //
            // Handle anon users posting with usernames
            //
            if( $poster_id == ANONYMOUS && $row['post_username'] != '' ) {
                $poster = $row['post_username'];
                $poster_rank = $lang['Guest'];
            } elseif ( $poster_id == ANONYMOUS ) {
                $poster = $lang['Guest'];
                $poster_rank = '';
            }
            if ($evoconfig['smilies_in_titles']) {
                $post_subject = ( $row['post_subject'] != '' ) ? smilies_pass($row['post_subject']) : '';
            } else {
                $post_subject = ( $row['post_subject'] != '' ) ? $row['post_subject'] : '';
            }
            $message = $row['post_text'];
            $bbcode_uid = $row['bbcode_uid'];
            $plain_message = $row['post_text'];
            $plain_message = preg_replace('/\:(([a-z0-9]:)?)' . $bbcode_uid . '/s', '', $plain_message);
            $plain_message = str_replace('<', '&lt;', $plain_message);
            $plain_message = str_replace('>', '&gt;', $plain_message);
            $plain_message = str_replace('<br />', "\n", $plain_message);
            $orig_word = array();
            $replacement_word = array();
            $plain_message = ( !empty($plain_message) ? $plain_message : '');
            $plain_message = addslashes($plain_message);
            $plain_message = str_replace("\n", "\\n", $plain_message);
            //
            // If the board has HTML off but the post has HTML
            // on then we process it, else leave it alone
            //
            if ( !$evoconfig['allow_html'] && $row['enable_html'] ) {
                $message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $message);
            }
            if ( $bbcode_uid != "" ) {
                $message = ( $evoconfig['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
            }
            $post_subject = check_words($post_subject);
            $message      = check_words($message);
            $message      = make_clickable($message);
            if ( $evoconfig['allow_smilies'] && $row['enable_smilies'] ) {
                $message = smilies_pass($message);
            }
            $message = word_wrap_pass($message);
            $message = str_replace("\n", '<br />', $message);
            $post_subject = get_icon_title($row['post_icon']) . '&nbsp;' . $post_subject;
            //
            // Again this will be handled by the templating
            // code at some point
            //
            $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
            /*--FNA #2--*/
            $template->assign_block_vars('postrow', array(
                    'ROW_COLOR'           => '#' . $row_color,
                    'ROW_CLASS'           => $row_class,
                    'MINI_POST_IMG'       => $mini_post_img,
                    'POSTER_MESSAGE_NAME' => $plain_poster,
                    'POSTER_NAME'         => UsernameColor($poster),
                    'POST_DATE'           => $post_date,
                    'POST_SUBJECT'        => $post_subject,
                    'MESSAGE'             => $message,
                    'U_POST_ID'           => $row['post_id'],
                    'PLAIN_MESSAGE'       => str_replace(chr(13), '', $plain_message),
                    'EXT_POSTER_NAME'     => $plain_poster,
                    'L_MINI_POST_ALT'     => $mini_post_alt,
                    'L_POSTED'       => $lang['Posted'],
                    'L_POST_SUBJECT' => $lang['Post_subject'],
                    'SPACER_IMG'     => $images['spacer'],
                    'L_TOPIC_REVIEW' => $lang['Topic_review'],
                    'L_QUOTE'        => $lang['Quote'])
            );
            display_review_attachments($row['post_id'], $row['post_attachment'], $is_auth);
            $i++;
        } while ( $row = $db->sql_fetchrow($result) );
    } else {
        message_die(GENERAL_MESSAGE, 'Topic_post_not_exist', '', __LINE__, __FILE__, $sql);
    }
    $db->sql_freeresult($result);
}
$template->assign_vars(array(
    'L_AUTHOR'       => $lang['Author'],
    'L_MESSAGE'      => $lang['Message'])
);

?>