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

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}
global $_GETVAR, $userdata, $evoconfig;

$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

$glance_forum_dir     = 'modules.php?name=Forums&amp;file=';
$glance_news_forum_id = $evoconfig['glance_news_id'];
$glance_num_news      = intval($evoconfig['glance_num_news']);
$glance_num_recent    = intval($evoconfig['glance_num']);
$glance_recent_ignore = $evoconfig['glance_ignore_forums'];
$glance_news_heading  = $lang['glance_news_heading'];
$glance_recent_heading = $lang['glance_recent_heading'];
$glance_table_width   = $evoconfig['glance_table_width'];
$glance_show_new_bullets = true;
$glance_auth_read     = intval($evoconfig['glance_auth_read']);
$glance_topic_length  = intval($evoconfig['glance_topic_length']);

//
// GET USER LAST VISIT
//
$glance_last_visit     = $userdata['user_lastvisit'];
$gro                   = $_GETVAR->get('gro', '_REQUEST', 'int', 0);
$gno                   = $_GETVAR->get('gno', '_REQUEST', 'int', 0);
$glance_file           = $_GETVAR->get('file', '_REQUEST', 'string', '');
$glance_post_id        = '';

switch ($glance_file) {
    case 'viewforum':
        $glance_param = $_GETVAR->get(POST_FORUM_URL, '_REQUEST', 'int', 0);
        if ($glance_param > 0) {
            $glance_file = 'viewforum&amp;'.POST_FORUM_URL.'='.$glance_param;
        }
        break;
    case 'viewtopic':
        $glance_param = $_GETVAR->get(POST_TOPIC_URL, '_REQUEST', 'int', 0);
        if ($glance_param == 0) {
            $glance_param = $_GETVAR->get(POST_POST_URL, '_REQUEST', 'int', 0);
            $glance_file = 'viewtopic&amp;';
            $glance_post_id = '&amp;p='.$glance_param.'#'.$glance_param;
        } else {
            $glance_file = 'viewtopic&amp;t='.$glance_param;
        }
        break;
    default:
        $glance_file = 'index';
}


//
// MESSAGE TRACKING
//
$tracking_topics = evo_getcookie($evoconfig['cookie_name'] . '_t') ? unserialize(evo_getcookie($evoconfig['cookie_name'] . '_t')) : array();
$tracking_forums = evo_getcookie($evoconfig['cookie_name'] . '_f') ? unserialize(evo_getcookie($evoconfig['cookie_name'] . '_f')) : array();
$tracking_forumsall = evo_getcookie($evoconfig['cookie_name'] . '_all') ? unserialize(evo_getcookie($evoconfig['cookie_name'] . '_all')) : FALSE;

if ( empty($attach_config['topic_icon'])) {
    $result = $db->sql_ufetchrow("SELECT config_value FROM ". ATTACH_CONFIG_TABLE." WHERE config_name = 'topic_icon'");
    $attach_config['topic_icon'] = $result[0];
}

// CHECK FOR BAD WORDS
//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

// set the topic title sql depending on the character limit set in glance_config
$sql_title = ($glance_topic_length) ? ", LEFT(t.topic_title, " . $glance_topic_length . ") as topic_title" : ", t.topic_title";

//
// GET THE LATEST NEWS TOPIC
//
if ( $glance_num_news ) {
    $glance_auth_level = ( $glance_auth_read ) ? AUTH_VIEW : AUTH_ALL;
    $is_auth_ary = auth($glance_auth_level, AUTH_LIST_ALL, $userdata);
    $forumsignore = '';
    if ( $num_forums = count($is_auth_ary) ) {
        while ( list($forum_id, $auth_mod) = each($is_auth_ary) ) {
            $unauthed = false;
            if ( !$auth_mod['auth_view'] ) {
                $unauthed = true;
            }
            if ( !$glance_auth_read && !$auth_mod['auth_read'] ) {
                $unauthed = true;
            }
            if ( $unauthed ) {
                $forumsignore .= ($forumsignore) ? ',' . $forum_id : $forum_id;
            }
        }
    }
    $forumsignore .= ($forumsignore && $glance_recent_ignore) ? ',' : '';
    $sql = "SELECT f.forum_id, f.forum_name " . $sql_title . ", t.topic_id, t.topic_last_post_id, t.topic_poster, t.topic_views, t.topic_replies, t.topic_type, t.topic_status, t.topic_icon, t.topic_attachment,
          p2.post_time, p2.poster_id, p2.post_username, p.post_username, u.username as last_username, u.user_active as last_active, u2.user_active as author_active, u2.username as author_username
          FROM (". FORUMS_TABLE . " f, ". POSTS_TABLE . " p, ". TOPICS_TABLE . " t, ". POSTS_TABLE . " p2,
                ". USERS_TABLE . " u, ". USERS_TABLE . " u2)
          WHERE
          f.forum_id IN (" . $glance_news_forum_id . ")
          ".($forumsignore ? ($glance_recent_ignore ? 'AND f.forum_id NOT IN ('.$forumsignore . $glance_recent_ignore .')' : 'AND f.forum_id NOT IN ('.$forumsignore .')') : '')."
          AND t.forum_id = f.forum_id
          AND p.post_id = t.topic_first_post_id
          AND p2.post_id = t.topic_last_post_id
          AND t.topic_moved_id = 0
          AND p2.poster_id = u.user_id
          AND t.topic_poster = u2.user_id";
    $total_news = $db->sql_unumrows($sql);
    $sql .= ' ORDER BY t.topic_glance_priority DESC, t.topic_last_post_id DESC';
    $sql .= ($gno > 0) ? " LIMIT " . $gno . ", " . $glance_num_news : " LIMIT " . $glance_num_news;
    if( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Could not query new news information", "", __LINE__, __FILE__, $sql);
    }
    $latest_news = array();
    $count_news = 0;
    while ( $topic_row = $db->sql_fetchrow($result) ) {
        $topic_row['topic_title'] = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_row['topic_title']) : $topic_row['topic_title'];
        $count_news++;
        $latest_news[] = $topic_row;
    }
    $db->sql_freeresult($result);
}

//
// GET THE LAST TOPICS
//
if ( $glance_num_recent ) {
    $glance_auth_level = ( $glance_auth_read ) ? AUTH_VIEW : AUTH_ALL;
    $is_auth_ary = auth($glance_auth_level, AUTH_LIST_ALL, $userdata);
    $forumsignore = $glance_news_forum_id;
    if ( $num_forums = count($is_auth_ary) ) {
        while ( list($forum_id, $auth_mod) = each($is_auth_ary) ) {
            $unauthed = false;
            if ( !$auth_mod['auth_view'] ) {
                $unauthed = true;
            }
            if ( !$glance_auth_read && !$auth_mod['auth_read'] ) {
                $unauthed = true;
            }
            if ( $unauthed ) {
                $forumsignore .= ($forumsignore) ? ',' . $forum_id : $forum_id;
            }
        }
    }
    $forumsignore .= ($forumsignore && $glance_recent_ignore) ? ',' : '';
    $glance_recent_ignore = ($glance_recent_ignore) ? $glance_recent_ignore : '';
    $sql = "SELECT f.forum_id, f.forum_name " . $sql_title . ", t.topic_id, t.topic_last_post_id, t.topic_poster, t.topic_views, t.topic_replies, t.topic_type, t.topic_status, t.topic_icon, t.topic_attachment,
              p2.post_time, p2.poster_id, p2.post_username, p.post_username, u.username as last_username, u.user_active as last_active, u2.user_active as author_active, u2.username as author_username
            FROM (". FORUMS_TABLE . " f, ". POSTS_TABLE . " p, ". TOPICS_TABLE . " t, ". POSTS_TABLE . " p2,
                  ". USERS_TABLE . " u, ". USERS_TABLE . " u2)
            WHERE
            f.forum_id NOT IN (" . $forumsignore . $glance_recent_ignore . ")
            AND t.forum_id = f.forum_id
            AND p.post_id = t.topic_first_post_id
            AND p2.post_id = t.topic_last_post_id
            AND t.topic_moved_id = 0
            AND p2.poster_id = u.user_id
            AND t.topic_poster = u2.user_id";
    $total_recent = $db->sql_unumrows($sql);
    $sql .= ' ORDER BY t.topic_glance_priority DESC, t.topic_last_post_id DESC';
    $sql .= ($gro) ? " LIMIT " . $gro . ", " . $glance_num_recent : " LIMIT " . $glance_num_recent;
    if( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Could not query latest topic information", "", __LINE__, __FILE__, $sql);
    }
    $latest_topics = array();
    $latest_anns = array();
    $latest_stickys = array();
    $count_topic = 0;
    while ( $topic_row = $db->sql_fetchrow($result) ) {
        $topic_row['topic_title'] = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_row['topic_title']) : $topic_row['topic_title'];
        $count_topic++;
        switch ($topic_row['topic_type']) {
            case POST_GLOBAL_ANNOUNCE:
            case POST_ANNOUNCE:
                $latest_anns[] = $topic_row;
                break;
            case POST_STICKY:
                $latest_stickys[] = $topic_row;
                break;
            default:
                $latest_topics[] = $topic_row;
                break;
        }
    }
    $latest_topics = array_merge($latest_anns, $latest_stickys, $latest_topics);
    $db->sql_freeresult($result);
}

//
// BEGIN OUTPUT
//
$template->set_filenames(array(
    'glance_output' => 'glance_body.tpl')
);

if ( $glance_num_news ) {
    if ( $count_news > 0 ) {
        $bullet_pre = '<img src="';
        for ( $i = 0; $i < count($latest_news); $i++ ) {
            $unread_topics = false;
            $glance_topic_id = $latest_news[$i]['topic_id'];
            $glance_forum_id = $latest_news[$i]['forum_id'];
            if( is_user() ) {
                if( $latest_news[$i]['post_time'] > $glance_last_visit )  {
                    $unread_topics = TRUE;
                }
            }
            if( isset($tracking_topics[$glance_topic_id]) || isset($tracking_forums[$glance_forum_id]) ) {
                if (isset($tracking_topics[$glance_topic_id]) && ($tracking_topics[$glance_topic_id] > $latest_news[$i]['post_time']) ) {
                    $unread_topics = FALSE;
                } else {
                    if ($tracking_forums[$glance_forum_id] > $latest_news[$i]['post_time'])  {
                        $unread_topics = FALSE;
                    }
                }
            }
            if (isset($tracking_forumsall) && $tracking_forumsall > $latest_news[$i]['post_time']) {
                $unread_topics = FALSE;
            }
            $shownew = $unread_topics;
            $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ?  $images['folder_announce_new'] :  $images['folder_announce'] ) . '" border="0" alt="" />';
            $newest_code = ( $unread_topics && $glance_show_new_bullets ) ? '&amp;view=newest' : '';
            $topic_link = $glance_forum_dir . 'viewtopic&amp;t=' . $latest_news[$i]['topic_id'] . $newest_code . '&amp;gro='.$gro.'&amp;gno='.$gno;
            $icon = get_icon_title($latest_news[$i]['topic_icon'], 1, $latest_news[$i]['topic_type']);
            $attachement_img = ($latest_news[$i]['topic_attachment'] == 1) ? '<img src="' . $attach_config['topic_icon'] . '" alt="" border="0" /> ' : '';
            if ( ($latest_news[$i]['topic_poster'] == ANONYMOUS) || $latest_news[$i]['author_active'] < 1 || (empty($latest_news[$i]['topic_poster'] )) )  {
                $topic_poster = $lang['Guest'];
            } else {
                $topic_poster = '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_news[$i]['topic_poster']) . '">' . UsernameColor($latest_news[$i]['author_username']) . '</a> ';
            }
            if ( ($latest_news[$i]['poster_id'] == ANONYMOUS )  || $latest_news[$i]['last_active'] < 1 || (empty($latest_news[$i]['poster_id'])) ) {
                $last_poster = $lang['Guest'];
            } else {
                $last_poster = '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_news[$i]['poster_id']) . '">' . UsernameColor($latest_news[$i]['last_username']) . '</a> ';
            }
            $last_poster .= '<a href="' . append_sid('viewtopic.php&amp;gro=' . $gro . '&amp;gno='.$gno.'&amp;'.POST_POST_URL . '=' . $latest_news[$i]['topic_last_post_id'] . '#' . $latest_news[$i]['topic_last_post_id']).'"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
            $last_post_time = create_date($evoconfig['default_dateformat'], $latest_news[$i]['post_time'], $evoconfig['board_timezone']);
            $template->assign_block_vars('news', array(
                'BULLET'            => $bullet_full,
                'TOPIC_ATTACH_IMG'  => $attachement_img,
                'TOPIC_TITLE'       => ($evoconfig['smilies_in_titles']) ? smilies_pass($latest_news[$i]['topic_title']) : $latest_news[$i]['topic_title'],
                'TOPIC_LINK'        => $topic_link,
                'TOPIC_TIME'        => $last_post_time,
                'ICON'              => $icon,
                'TOPIC_POSTER'      => $topic_poster,
                'TOPIC_VIEWS'       => $latest_news[$i]['topic_views'],
                'TOPIC_REPLIES'     => $latest_news[$i]['topic_replies'],
                'LAST_POSTER'       => $last_poster,
                'FORUM_TITLE'       => $latest_news[$i]['forum_name'],
                'FORUM_LINK'        => $glance_forum_dir . 'viewforum&amp;f=' . $latest_news[$i]['forum_id'].'&amp;gro='.$gro. '&amp;gno='.$gno)
                );
        }
    } else {
        $template->assign_block_vars('switch_news_off', array());
    }
}

if ( $glance_num_recent ) {
    $glance_info = 'counted recent';
    $bullet_pre = '<img src="';
    if ( !empty($latest_topics) ) {
        for ( $i = 0; $i < count($latest_topics); $i++ ) {
            $unread_topics = false;
            $glance_topic_id = $latest_topics[$i]['topic_id'];
            $glance_forum_id = $latest_topics[$i]['forum_id'];
            if( is_user() ) {
                if( $latest_topics[$i]['post_time'] > $glance_last_visit ) {
                    $unread_topics = TRUE;
                }
            }
            if( isset($tracking_topics[$glance_topic_id]) || isset($tracking_forums[$glance_forum_id]) ) {
                if (isset($tracking_topics[$glance_topic_id]) && ($tracking_topics[$glance_topic_id] > $latest_topics[$i]['post_time']) ) {
                    $unread_topics = FALSE;
                } else {
                    if (isset($tracking_forums[$glance_forum_id]) && ($tracking_forums[$glance_forum_id] > $latest_topics[$i]['post_time']))  {
                        $unread_topics = FALSE;
                    }
                }
            }
            if (isset($tracking_forumsall) && $tracking_forumsall > $latest_topics[$i]['post_time']) {
                $unread_topics = FALSE;
            }
            $shownew = $unread_topics;
            switch ($latest_topics[$i]['topic_type']) {
                case POST_GLOBAL_ANNOUNCE:
                    $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $images['folder_global_announce_new'] :  $images['folder_global_announce'] ) . '" border="0" alt="" />';
                    break;
                case POST_ANNOUNCE:
                    $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $images['folder_announce_new'] :  $images['folder_announce'] ) . '" border="0" alt="" />';
                    break;
                case POST_STICKY:
                    $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $images['folder_sticky_new'] :  $images['folder_sticky'] ) . '" border="0" alt="" />';
                    break;
                default:
                    if ($latest_topics[$i]['topic_status'] == TOPIC_LOCKED) {
                        $folder = $images['folder_locked'];
                        $folder_new = $images['folder_locked_new'];
                    } else if ($latest_topics[$i]['topic_replies'] >= $evoconfig['hot_threshold']) {
                        $folder = $images['folder_hot'];
                        $folder_new = $images['folder_hot_new'];
                    } else {
                        $folder = $images['folder'];
                        $folder_new = $images['folder_new'];
                    }
                    $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $folder_new :  $folder ) . '" border="0" alt="" />';
                    break;
            }
            $newest_code = ( $unread_topics && $glance_show_new_bullets ) ? '&amp;view=newest' : '';
            $topic_link = $glance_forum_dir . 'viewtopic&amp;t=' . $latest_topics[$i]['topic_id'] . $newest_code.'&amp;gro='.$gro.'&amp;gno='.$gno;
            if ( ($latest_topics[$i]['topic_poster'] == ANONYMOUS) || $latest_topics[$i]['author_active'] < 1 || (empty($latest_topics[$i]['topic_poster'] )) )  {
                $topic_poster = $lang['Guest'];
            } else {
                $topic_poster = '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_topics[$i]['topic_poster']) . '">' . UsernameColor($latest_topics[$i]['author_username']) . '</a> ';
            }
            $last_post_time = create_date($evoconfig['default_dateformat'], $latest_topics[$i]['post_time'], $evoconfig['board_timezone']);
            if ( ($latest_topics[$i]['poster_id'] == ANONYMOUS )  || $latest_topics[$i]['last_active'] < 1 || (empty($latest_topics[$i]['poster_id'])) ) {
                $last_poster = $lang['Guest'];
            } else {
                $last_poster = '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_topics[$i]['poster_id']) . '">' . UsernameColor($latest_topics[$i]['last_username']) . '</a> ';
            }
            $last_poster .= '<a href="' . append_sid('viewtopic.php&amp;gro=' . $gro . '&amp;gno='.$gno.'&amp;'.POST_POST_URL . '=' . $latest_topics[$i]['topic_last_post_id'] . '#' . $latest_topics[$i]['topic_last_post_id']).'"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
            $icon = get_icon_title($latest_topics[$i]['topic_icon'], 1, $latest_topics[$i]['topic_type']);
            $attachement_img = ($latest_topics[$i]['topic_attachment'] == 1) ? '<img src="' . $attach_config['topic_icon'] . '" alt="" border="0" /> ' : '';
            $template->assign_block_vars('recent', array(
                 'BULLET'           => $bullet_full,
                 'ICON'             => $icon,
                 'TOPIC_ATTACH_IMG' => $attachement_img,
                 'TOPIC_LINK'       => $topic_link,
                 'TOPIC_TITLE'      => ($evoconfig['smilies_in_titles']) ? smilies_pass($latest_topics[$i]['topic_title']) : $latest_topics[$i]['topic_title'],
                 'TOPIC_POSTER'     => $topic_poster,
                 'TOPIC_VIEWS'      => $latest_topics[$i]['topic_views'],
                 'TOPIC_REPLIES'    => $latest_topics[$i]['topic_replies'],
                 'LAST_POST_TIME'   => $last_post_time,
                 'LAST_POSTER'      => $last_poster,
                 'FORUM_TITLE'      => $latest_topics[$i]['forum_name'],
                 'FORUM_LINK'       => $glance_forum_dir . 'viewforum&amp;f=' . $latest_topics[$i]['forum_id'] . '&amp;gro='.$gro. '&amp;gno='.$gno)
             );
         }
    } else {
        $template->assign_block_vars('switch_recent_off', array());
    }
}

if (($glance_num_news > 0) && ($total_news > 0)) {
    $nav_news = TRUE;
} else {
    $nav_news = FALSE;
}
if (($glance_num_recent > 0) && ($total_recent > 0)) {
    $nav_recent = TRUE;
} else {
    $nav_recent = FALSE;
}

if ($nav_news) {
    if ($gno > 0) {
        // if we're not on the first record, we can always go backwards
        $back_news = (($gno - $glance_num_news) > 0) ? ($gno-$glance_num_news) : 0;
        $prev_news_url = '&amp;gno='.$back_news;
    } else {
        $prev_news_url = '';
    }
    if ($total_news > ($gno + $glance_num_news)) {
        // if all news > offset + limit we show next button
        $next_news = (($gno + $glance_num_news) >= $total_news) ? $total_news : ($gno + $glance_num_news);
        $next_news_url = '&amp;gno='.$next_news;
    } else {
        $next_news_url = '';
    }
} else {
    $prev_news_url = '';
    $next_news_url = '';
}

if ($nav_recent) {
    if ($gro > 0) {
        // if we're not on the first record, we can always go backwards
        $back_recent = (($gro - $glance_num_recent) > 0 ? ($gro-$glance_num_recent) : 0);
        $prev_recent_url = '&amp;gro='.$back_recent;
    } else {
        $prev_recent_url = '';
    }
    if ($total_recent > ($gro + $glance_num_recent)) {
        // if all news > offset + limit we show next button
        $next_recent = (($gro + $glance_num_recent) > $total_recent) ? $total_recent : ($gro + $glance_num_recent);
        $next_recent_url = '&amp;gro='.$next_recent;
    } else {
        $next_recent_url = '';
    }
} else {
    $prev_recent_url = '';
    $next_recent_url = '';
}

$glance_url = '<a href="'.$glance_forum_dir.$glance_file;

$prev_news_url   = (!empty($prev_news_url)    ? $glance_url.'&amp;gro='.$gro.(!empty($glance_post_id) ? $glance_post_id : '').$prev_news_url.'" class="th">'.'&lt;&lt;&nbsp;'.$lang['glance_previous'].'&nbsp;'.$glance_num_news.'</a>' : '');
$next_news_url   = (!empty($next_news_url)    ? $glance_url.'&amp;gro='.$gro.(!empty($glance_post_id) ? $glance_post_id : '').$next_news_url.'" class="th">'.$lang['glance_next'].'&nbsp;' . $glance_num_news . '&nbsp;&gt;&gt;</a>' : '');
$prev_recent_url = (!empty($prev_recent_url)  ? $glance_url.'&amp;gno='.$gno.(!empty($glance_post_id) ? $glance_post_id : '').$prev_recent_url.'" class="th">'.'&lt;&lt;&nbsp;'.$lang['glance_previous'].'&nbsp;'.$glance_num_recent.'</a>' : '');
$next_recent_url = (!empty($next_recent_url)  ? $glance_url.'&amp;gno='.$gno.(!empty($glance_post_id) ? $glance_post_id : '').$next_recent_url.'" class="th">'.$lang['glance_next'].'&nbsp;'.$glance_num_recent.'&nbsp;&gt;&gt;</a>' : '');

if ($nav_news) {
    $template->assign_block_vars('switch_glance_news', array(
        'NEXT_URL' => $next_news_url,
        'PREV_URL' => $prev_news_url
    ));
}
if ($nav_recent) {
    $template->assign_block_vars('switch_glance_recent', array(
        'NEXT_URL' => $next_recent_url,
        'PREV_URL' => $prev_recent_url
    ));
}

$template->assign_vars(array(
    'GLANCE_TABLE_WIDTH' => $glance_table_width,
    'RECENT_HEADING' => $glance_recent_heading,
    'NEWS_HEADING' => $glance_news_heading,
    'L_TOPICS' => $lang['Topics'],
    'L_REPLIES' => $lang['Replies'],
    'L_VIEWS' => $lang['Views'],
    'L_LASTPOST' => $lang['Last_Post'],
    'L_FORUM' => $lang['Forum'],
    'L_AUTHOR' => $lang['Author'])
    );

$template->assign_var_from_handle('GLANCE_OUTPUT', 'glance_output');

// THE END

?>