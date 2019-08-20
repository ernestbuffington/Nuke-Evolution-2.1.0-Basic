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
global $_GETVAR, $popup, $evoconfig;

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

include($phpbb_root_path . 'common.php');
include_once(NUKE_INCLUDE_DIR.'bbcode.php');

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

$viewcat = $_GETVAR->get(POST_CAT_URL, 'REQUEST', 'int', -1);
if ($viewcat <= 0) {
    $viewcat = -1;
}
$viewcatkey = ($viewcat < 0) ? 'Root' : POST_CAT_URL . $viewcat;
$mark_read = $_GETVAR->get('mark', 'request', 'string', '');

//
// Handle marking posts
//
if( $mark_read == 'forums' ) {
    if ( $viewcat < 0 ) {
        evo_setcookie($board_config['cookie_name'] . '_f_all', serialize(time()), 2592000);
        $template->assign_vars(array(
            "META" => '<meta http-equiv="refresh" content="3;url='  .append_sid("index.php") . '" />')
        );
    } else {
        $tracking_forums = evo_getcookie($board_config['cookie_name'] . '_f') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_f')) : array();
        // get the list of object authorized
        $keys = array();
        $keys = get_auth_keys($viewcatkey);
        // mark each forums
        $count_keys = count($keys['id']);
        for ($i=0, $max = $count_keys; $i < $max; $i++) {
            if ($tree['type'][ $keys['idx'][$i] ] == POST_FORUM_URL) {
                $forum_id = $tree['id'][ $keys['idx'][$i] ];
                $tracking_forums[$forum_id] = time();
            }
        }
        evo_setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), 2592000);
        $template->assign_vars(array(
            "META" => '<meta http-equiv="refresh" content="3;url='  .append_sid("index.php?" . POST_CAT_URL . "=$viewcat") . '">')
            );
    }
    $message = $lang['Forums_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a> ');
    message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//
if ( ($board_config['display_viewonline'] == 2) || ( ($viewcat < 0) && ($board_config['display_viewonline'] == 1) ) ) {
    if ( empty($board_config['max_posts']) || empty($board_config['max_users']) ) {
        board_stats();
    }
    $total_posts = $board_config['max_posts'];
    $total_users = get_db_stat('usercount');
    $newest_userdata = get_db_stat('newestuser');
    $newest_user = UsernameColor($newest_userdata['username']);
    $newest_uid = $newest_userdata['user_id'];
    if( $total_posts == 0 ) {
        $l_total_post_s = $lang['Posted_articles_zero_total'];
    } else if( $total_posts == 1 ) {
        $l_total_post_s = $lang['Posted_article_total'];
    } else {
        $l_total_post_s = $lang['Posted_articles_total'];
    }
    if( $total_users == 0 ) {
        $l_total_user_s = $lang['Registered_users_zero_total'];
    } else if( $total_users == 1 ) {
        $l_total_user_s = $lang['Registered_user_total'];
    } else {
        $l_total_user_s = $lang['Registered_users_total'];
    }
}
//
// Start page proper
//
// set the parm of the mark read func
$mark = ($viewcat == -1 ) ? '' : '&amp;' . POST_CAT_URL . '=' . $viewcat;
// monitor the board statistic
if (($board_config['display_viewonline'] == 2) || (($viewcat < 0) && ($board_config['display_viewonline'] == 1))) {
    //
    // Start output of page
    //
    define('SHOW_ONLINE', TRUE);
}

$page_title = $lang['Forums'] . ' '.$lang['Index'];
include_once(NUKE_INCLUDE_DIR.'page_header.php');
$template->set_filenames(array(
    'body' => 'index_body.tpl')
    );

if ( ($board_config['display_viewonline'] == 2) || ( ($viewcat < 0) && ($board_config['display_viewonline'] == 1) ) ) {
    $total_posts_format = sprintf($l_total_post_s, $total_posts);
    $total_posts_format = str_replace($total_posts, number_format($total_posts), $total_posts_format);
    $template->assign_vars(array(
        'TOTAL_POSTS' => $total_posts_format,
        'TOTAL_USERS' => sprintf($l_total_user_s, $total_users),
        'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">', $newest_user, '</a>'))
        );
}
$template->assign_vars(array(
    'FORUM_IMG' => $images['explain_forum'],
    'FORUM_NEW_IMG' => $images['explain_forum_new'],
    'FORUM_LOCKED_IMG' => $images['explain_forum_locked'],
    'L_FORUM' => $lang['Forum'],
    'L_TOPICS' => $lang['Topics'],
    'L_REPLIES' => $lang['Replies'],
    'L_VIEWS' => $lang['Views'],
    'L_POSTS' => $lang['Posts'],
    'L_LASTPOST' => $lang['Last_Post'],
    'L_NO_NEW_POSTS' => $lang['No_new_posts'],
    'L_NEW_POSTS' => $lang['New_posts'],
    'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'],
    'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'],
    'L_ONLINE_EXPLAIN' => $lang['Online_explain'],
    'L_MODERATOR' => $lang['Moderators'],
    'L_FORUM_LOCKED' => $lang['Forum_is_locked'],
    'L_MARK_FORUMS_READ' => $lang['Mark_all_forums'],
    'U_MARK_READ' => append_sid('index.php?mark=forums'.$mark))
    );

//
// Okay, let's build the index
//
// don't display the board statistics
if ( ($board_config['display_viewonline'] == 2) || ( ($viewcat < 0) && ($board_config['display_viewonline'] == 1) ) ) {
    $template->assign_block_vars('disable_viewonline', array(
        'GROUPS'    => GetColorGroups())
        );
}

// display the index
$display = display_index($viewcatkey);

if ( !$display ) {
    message_die(GENERAL_MESSAGE, $lang['No_forums']);
}

if ($viewcat > 0) {
    if (show_glance('categorie')) {
        include_once($phpbb_root_path . 'glance.php');
    }
} elseif (show_glance('index')) {
    include_once($phpbb_root_path . 'glance.php');
}

//
// Generate the page
//
$template->pparse('body');

include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>