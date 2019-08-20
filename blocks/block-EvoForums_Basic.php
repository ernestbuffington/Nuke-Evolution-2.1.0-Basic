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

if(!defined('NUKE_EVO')) exit;

global $db, $userinfo, $ThemeSel, $board_config, $currentlang, $images;

if (!defined('IN_PHPBB')) {define('IN_PHPBB', TRUE);}

include_once(NUKE_FORUMS_DIR.'attach_mod/includes/functions_includes.php');
include_once(NUKE_INCLUDE_DIR.'auth.php');
include_once(NUKE_INCLUDE_DIR.'bbcode.php');
include_once(NUKE_THEMES_DIR.$ThemeSel.'/forums/forums.cfg');

$userdata['user_id'] = $userinfo['user_id'];
$userdata['user_level'] = $userinfo['user_level'];
$userdata['session_logged_in'] = is_user();


// Some fix settings
$topicstoshow = 15;             # Number of topics which should be shown in this block
$AlternateRowClass = 0;   # Set this to 1 to give your block a little bit of 'class' by changing the style of each row, set to 0 to disable.
$SplitAnnouncements = 1;  # Set this to 1 to split your board's most recent Announcements and Global Announcements from the normal topics.
$NumAnnouncements = 4;    # Set this to the number of announcements you'd like to be displayed.

$latest_topics = array();

// Functions for this block
// Thanks to JeFFb68CAM (www.Evo-Mods.com)

function make_EvoForumsBasicforumsrow($row_class, $topic_id, $post_time, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_postername, $forumname, $forum_id, $topic_last_post_id, $post_username, $post_user_id) {
    global $ThemeSel, $lang_block;

    $row = "<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;t=$topic_id#$topic_id\">$topic_title</a><strong> by </strong>"
         ."<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$post_user_id\">$topic_postername</a><strong> in </strong>"
         ."<a href=\"modules.php?name=Forums&amp;file=viewforum&amp;f=$forum_id\"><em>$forumname</em></a><br />";
    return $row;
}

function make_EvoForumsBasicforumstable($topicrows, $announcements, $SplitAnnouncements) {
    global $lang_block;

    $table = '';
    if ($SplitAnnouncements) {
        $table .= ($announcements) ? $announcements : "";
    }
    $table .= ($topicrows) ? $topicrows :  $lang_block['BLOCK_FORUM_NOTOPIC'];
    $table .= "<br />[ <a href=\"modules.php?name=Forums&amp;file=recent\">" . $lang_block['BLOCK_FORUM_RECENT'] . "</a> ]";
    return $table;
}

//
// So let`s get topic informations
// we make no difference between normal-user and mods
//
$glance_auth_level = AUTH_ALL;
$is_auth_ary = auth($glance_auth_level, AUTH_LIST_ALL, $userdata);

$forumsignore = "-1";
if ( $num_forums = count($is_auth_ary) ) {
    while ( list($forum_id, $auth_mod) = each($is_auth_ary) ) {
        $unauthed = false;
        if ( !$auth_mod['auth_view'] ) {
            $unauthed = true;
        }
        if ( !$auth_mod['auth_read'] ) {
            $unauthed = true;
        }
        if ( $unauthed ) {
            $forumsignore .= ($forumsignore) ? ',' . $forum_id : $forum_id;
        }
    }
}

$forumsignore .= ($forumsignore) ? ',' : '';
$sql = "SELECT DISTINCT (bbt.topic_id), bbt.topic_time, bbt.topic_title, bbt.topic_poster, bbt.topic_views,
                    bbt.topic_replies,  bbt.topic_type, bbt.topic_last_post_id, u.username, ft.forum_name, ft.forum_id, pt.post_time, u2.username, u.user_id
        FROM (  ".TOPICS_TABLE." bbt,
                ".FORUMS_TABLE." ft,
                ".USERS_TABLE." u,
                ".USERS_TABLE." u2,
                ".POSTS_TABLE." pt )
        WHERE ft.forum_id = bbt.forum_id
        AND pt.post_id = bbt.topic_last_post_id";
$sql1 = "ORDER by pt.post_time desc
                LIMIT $topicstoshow";
if ( is_admin() ) {
    $where1 = "";
} elseif ( is_user() ) {
    $where1 = "AND (ft.auth_view = ". AUTH_VIEW ."
                    OR ft.auth_view = ". AUTH_ALL .")
               AND bbt.topic_type <> " . POST_GLOBAL_ANNOUNCE ."
               AND bbt.topic_type <> " . POST_ANNOUNCE ."
               GROUP by bbt.topic_id";
} else {
    $where1 = "AND ft.auth_view = ". AUTH_ALL ."";
}
$where2 = "AND bbt.topic_type <> " . POST_GLOBAL_ANNOUNCE ."
           AND bbt.topic_type <> " . POST_ANNOUNCE ."
           AND u.user_id = pt.poster_id
           AND u2.user_id = bbt.topic_poster";
$sql = $sql." ".$where1." ".$where2." ".$sql1;
$result = $db->sql_query($sql);
$Count_Announce = 0;
$Count_Topics   = 0;
$topicrows      = '';
$announcements  = '';

if ( is_admin() || is_user() ) {
$sql = "SELECT DISTINCT (bbt.topic_id), bbt.topic_time, bbt.topic_title, bbt.topic_poster, bbt.topic_views,
            bbt.topic_replies, bbt.topic_type, bbt.topic_last_post_id, u.username, ft.forum_name, ft.forum_id, pt.post_time, u2.username, u.user_id
        FROM (  ".TOPICS_TABLE." bbt,
                ".FORUMS_TABLE." ft,
                ".USERS_TABLE." u,
                ".USERS_TABLE." u2,
                ".POSTS_TABLE." pt )
        WHERE ft.forum_id = bbt.forum_id
              AND (bbt.topic_type = " . POST_ANNOUNCE . "
                   OR bbt.topic_type = " . POST_GLOBAL_ANNOUNCE . ")
              AND pt.post_id = bbt.topic_last_post_id
              AND u.user_id = pt.poster_id
              AND u2.user_id = bbt.topic_poster
        ORDER by pt.post_time desc
        LIMIT $NumAnnouncements";
    $result1 = $db->sql_query($sql);
    $Count_Announce = 0;
    while ( list( $topic_id, $topic_time, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_type, $topic_last_post_id, $topic_postername, $forumname, $forum_id, $post_time, $post_username, $post_user_id ) =  $db->sql_fetchrow($result1)) {
        $topic_postername = UsernameColor($topic_postername);
        $post_username = UsernameColor($post_username);
        $topic_title = ($board_config['smilies_in_titles']) ? smilies_pass($topic_title) : $topic_title;
        if ($topic_type == POST_GLOBAL_ANNOUNCE) {
            $rowimage = ($post_time >= $userinfo['user_lastvisit']) ? str_replace("{LANG}", "lang_".$currentlang, $images['folder_global_announce_new']) : str_replace("{LANG}", "lang_".$currentlang, $images['folder_global_announce']);
        } else {
            $rowimage = ($post_time >= $userinfo['user_lastvisit']) ? str_replace("{LANG}", "lang_".$currentlang, $images['folder_announce_new']) : str_replace("{LANG}", "lang_".$currentlang, $images['folder_announce']);
        }
        $post_time = EvoDate( $board_config['default_dateformat'] , $post_time , $board_config['board_timezone'] );
        $row_class = ($Count_Topics % 2 && $AlternateRowClass) ? "row3" : "row2";
        $Count_Announce += 1;
        $announcements .= make_EvoForumsBasicforumsrow($rowimage, $row_class, $topic_id, $post_time, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_postername, $forumname, $forum_id, $topic_last_post_id, $post_username, $post_user_id);
    }
    $db->sql_freeresult($result1);
}

$Count_Topics = 0;
while ( list( $topic_id, $topic_time, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_type, $topic_last_post_id, $topic_postername, $forumname, $forum_id, $post_time, $post_username, $post_user_id ) =  $db->sql_fetchrow($result)) {
    $topic_postername = UsernameColor($topic_postername);
    $post_username = UsernameColor($post_username);
    $topic_title = set_smilies(decode_bbcode(stripslashes($topic_title), 1, true));
    $forumname = set_smilies(decode_bbcode(stripslashes($forumname), 1, true));
    $post_time = EvoDate( $board_config['default_dateformat'] , $post_time , $board_config['board_timezone'] );
    $row_class = ($Count_Topics % 2 && $AlternateRowClass) ? "row3" : "row2";
    $Count_Topics += 1;
    $topicrows .= make_EvoForumsBasicforumsrow($row_class, $topic_id, $post_time, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_postername, $forumname, $forum_id, $topic_last_post_id, $post_username, $post_user_id);
}
$db->sql_freeresult($result);
if( !($SplitAnnouncements == 1)) {
    $showrows = $announcements;
    $showrows .= $topicrows;
} else {
    $showrows = $topicrows;
}

$content = make_EvoForumsBasicforumstable($showrows, $announcements, $SplitAnnouncements);

?>