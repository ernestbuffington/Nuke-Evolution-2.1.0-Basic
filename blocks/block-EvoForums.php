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
global $userinfo, $db, $ThemeSel, $board_config, $currentlang, $images, $_GETVAR;

if (!defined('IN_PHPBB')) {define('IN_PHPBB', TRUE);}

include_once(NUKE_FORUMS_DIR.'attach_mod/includes/functions_includes.php');
include_once(NUKE_INCLUDE_DIR.'auth.php');
include_once(NUKE_INCLUDE_DIR.'bbcode.php');
include_once(NUKE_THEMES_DIR.$ThemeSel.'/forums/forums.cfg');

$userdata['user_id'] = $userinfo['user_id'];
$userdata['user_level'] = $userinfo['user_level'];
$userdata['session_logged_in'] = is_user();


// Some fix settings
$topicstoshow = 15;       // Number of topics which should be shown in this block
$AlternateRowClass = 1;   // Set this to 1 to give your block a little bit of 'class' by changing the style of each row, set to 0 to disable.
$SplitAnnouncements = 1;  // Set this to 1 to split your board's most recent Announcements and Global Announcements from the normal topics.
$NumAnnouncements = 4;    // Set this to the number of announcements you'd like to be displayed.
$tracking_topics = evo_getcookie($board_config['cookie_name'] . '_t') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_t')) : array();
// Functions for this block
// Thanks to JeFFb68CAM (www.Evo-Mods.com)

function make_EvoForumsrow($rowimage, $row_class, $topic_id, $post_time, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_icon, $topic_postername, $forum_name, $forum_id, $topic_last_post_id, $post_username, $post_user_id) {
global $ThemeSel, $currentlang, $lang_block;

$row = "<tr>"
         ."<td align=\"center\" height=\"20\" nowrap=\"nowrap\" class=\"$row_class\"><img src=\"$rowimage\" height='30px' width='30px' alt=\"New Topic\" border=\"0\" /></td>"
         ."<td align=\"left\" class=\"$row_class\"><a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;t=$topic_id\">$topic_title</a></td>"
         ."<td align=\"center\" class=\"$row_class\"><a href=\"modules.php?name=Forums&amp;file=viewforum&amp;f=$forum_id\"><em>$forum_name</em></a></td>"
         ."<td align=\"center\" class=\"$row_class\">$topic_replies</td>"
         ."<td align=\"center\" class=\"$row_class\">$topic_views</td>"
         ."<td align=\"center\" nowrap=\"nowrap\" class=\"$row_class\"><span style=\"font-size:x-small;\"><em>&nbsp;&nbsp;$post_time&nbsp;</em></span><br />"
         ."<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$topic_poster\">$topic_postername</a>&nbsp;<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;p=$topic_last_post_id#$topic_last_post_id\">"
         ."<img src=\"themes/$ThemeSel/forums/images/lang_$currentlang/icon_newest_reply.gif\" height='9px' width='18px' alt=\"".$lang_block['BLOCK_FORUM_NEWPOST']."\" border=\"0\" /></a></td>"
      ."</tr>";
  return $row;
}

function make_EvoForumstable($topicrows, $announcements, $SplitAnnouncements, $count_topics, $count_posts, $count_forum) {
    global $lang_block;

    $table = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">";
        $table .= "<tr><td  colspan=\"7\" height=\"15\" align=\"center\">" . $lang_block['BLOCK_FORUM_WEHAVE'] . "  $count_forum " . $lang_block['BLOCK_FORUM_FORUMS'] . ", $count_topics " . $lang_block['BLOCK_FORUM_TOPICS'] . ",  $count_posts " . $lang_block['BLOCK_FORUM_POSTS'] . "</td></tr>"
                 ."<tr><td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"
                   ."<tr>"
                     ."<td><table width=\"100%\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" class=\"forumline\">"
                       ."<tr>"
                         ."<th width=\"50%\" height=\"20\" colspan=\"2\" align=\"center\" nowrap=\"nowrap\" class=\"thcornerl\"><span class=\"block-title\"><strong>" . $lang_block['BLOCK_FORUM_TOPICS'] . "</strong></span></th>"
                         ."<th width=\"10%\" align=\"center\" nowrap=\"nowrap\" class=\"thcornerr\"><span class=\"block-title\"><strong>" . $lang_block['BLOCK_FORUM_FORUM'] ."</strong></span></th>"
                         ."<th width=\"10%\" align=\"center\" nowrap=\"nowrap\" class=\"thtop\"><span class=\"block-title\"><strong>" . $lang_block['BLOCK_FORUM_COUNTREPLIES'] . "</strong></span></th>"
                         ."<th width=\"10%\" align=\"center\" nowrap=\"nowrap\" class=\"thtop\"><span class=\"block-title\"><strong>" . $lang_block['BLOCK_FORUM_COUNTVIEWS'] . "</strong></span></th>"
                         ."<th width=\"20%\" align=\"center\" nowrap=\"nowrap\" class=\"thtop\"><span class=\"block-title\"><strong>" . $lang_block['BLOCK_FORUM_LASTPOST'] . "</strong></span></th>"
                       ."</tr>";
    if ($SplitAnnouncements) {
        $table .= "<tr><th class=\"thTop\" colspan=\"7\" height=\"28\" align=\"left\"><span class=\"cattitle\">" . $lang_block['BLOCK_FORUM_ANNOUNCE'] . "</span></th></tr>";
        $table .= ($announcements) ? $announcements : "<tr><td class=\"row3\" colspan=\"6\" height=\"15\">" . $lang_block['BLOCK_FORUM_ANNOUNCENO'] . "</td></tr>";
    }
    $table .= ($SplitAnnouncements) ? "<tr><th class=\"thTop\" colspan=\"7\" height=\"28\" align=\"left\"><span class=\"cattitle\">" . $lang_block['BLOCK_FORUM_TOPICS'] . "</span></th></tr>" : "";
    $table .= ($topicrows) ? $topicrows : "<tr><td class=\"row3\" colspan=\"7\" height=\"15\">" . $lang_block['BLOCK_FORUM_NOTOPIC'] . "</td></tr>";
    $table .= "<tr>"
             ."<th height=\"28\" colspan=\"7\" align=\"right\" class=\"catbottom\">[ <a href=\"modules.php?name=Forums&amp;file=recent\">" . $lang_block['BLOCK_FORUM_RECENT'] . "</a> ]&nbsp;</th>"
           ."</tr>"
         ."</table></td>"
         ."</tr>"
       ."</table></td>"
      ."</tr>"
     ."</table>";
  return $table;
}

//
// Some informations we want to show
//
$result = $db->sql_query("SELECT count(forum_id) as forumcount from ".FORUMS_TABLE);
$result1 = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
$count_forum = $result1['forumcount'];
$result = $db->sql_query("SELECT count(post_id)as postcount from ".POSTS_TABLE);
$result1 = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
$count_posts = $result1['postcount'];
$result = $db->sql_query("SELECT count(topic_id)as topiccount from ".TOPICS_TABLE);
$result1 = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
$count_topics = $result1['topiccount'];


//
// So let`s get topic informations
// we make no difference between normal-user and mods
//
//
// So let`s get topic informations
// we make no difference between normal-user and mods
//
$glance_auth_level = AUTH_ALL;
$is_auth_ary = auth($glance_auth_level, AUTH_LIST_ALL, $userdata);

$forumsignore = "-1";
$num_forums = count($is_auth_ary);
if ( $num_forums > 0 ) {
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

$sql = "SELECT f.forum_id, f.forum_name, t.topic_id, t.topic_title, t.topic_last_post_id, t.topic_poster, t.topic_views, t.topic_replies, t.topic_type, t.topic_status, t.topic_icon,
                p2.post_time, p2.poster_id, p2.post_username, p.post_username, u.username as last_username, u2.username as author_username
        FROM ". FORUMS_TABLE . " f,
             ". POSTS_TABLE . " p,
             ". TOPICS_TABLE . " t,
             ". POSTS_TABLE . " p2,
             ". _USERS_TABLE . " u,
             ". _USERS_TABLE . " u2
        WHERE f.forum_id NOT IN (" . $forumsignore . ")
            AND t.forum_id = f.forum_id
            AND p.post_id = t.topic_first_post_id
            AND p2.post_id = t.topic_last_post_id
            AND t.topic_moved_id = 0
            AND u.user_id = p2.poster_id
            AND u2.user_id = t.topic_poster
        GROUP BY p2.topic_id
        ORDER BY p2.post_time DESC
        LIMIT $topicstoshow";

$result1 = $db->sql_query($sql);
$Count_Announce = 0;
$Count_Topics   = 0;
$topicrows      = '';
$announcements  = '';

while ( list( $forum_id, $forum_name, $topic_id, $topic_title, $topic_last_post_id, $topic_poster, $topic_views, $topic_replies, $topic_type, $topic_status, $topic_icon,
       $post_time, $poster_id, $post_username, $post_username2, $last_username, $author_username ) =  $db->sql_fetchrow($result1)) {
    $Count_Topics += 1;
    $topic_postername = UsernameColor($author_username);
    $post_username = UsernameColor($last_username);
    $row_class = ($Count_Topics % 2 && $AlternateRowClass) ? 'row3' : 'row2';
    $topic_title = ($board_config['smilies_in_titles']) ? smilies_pass($topic_title) : $topic_title;
    $unread_topic = FALSE;
    if ( $topic_type == POST_GLOBAL_ANNOUNCE || $topic_type == POST_ANNOUNCE ) {
        if ( $Count_Announce <= $NumAnnouncements ) {
            if ($topic_type == POST_GLOBAL_ANNOUNCE ) {
                if (is_user() && (($post_time <= $userinfo['user_lastvisit']) || !empty($tracking_topics[$topic_id]))) {
                    $rowimage = str_replace("{LANG}", "lang_".$currentlang, $images['folder_global_announce']);
                } else {
                    $rowimage = str_replace("{LANG}", "lang_".$currentlang, $images['folder_global_announce_new']);
                }
            } else {
                if (is_user() && (($post_time <= $userinfo['user_lastvisit']) || !empty($tracking_topics[$topic_id]))) {
                    $rowimage = str_replace("{LANG}", "lang_".$currentlang, $images['folder_announce']);
                } else {
                    $rowimage = str_replace("{LANG}", "lang_".$currentlang, $images['folder_announce_new']);
                }
            }
            $post_time = formatTimeStamp($post_time);
            $announcements .= make_EvoForumsrow($rowimage, $row_class, $topic_id, $post_time, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_icon, $topic_postername, $forum_name, $forum_id, $topic_last_post_id, $post_username, $poster_id);
            $Count_Announce += 1;
        }
    } else {
        if (is_user() && (($post_time <= $userinfo['user_lastvisit']) || !empty($tracking_topics[$topic_id]))) {
            $rowimage = str_replace("{LANG}", "lang_".$currentlang, $images['folder']);
        } else {
            $rowimage = str_replace("{LANG}", "lang_".$currentlang, $images['folder_new']);
        }
        $post_time = formatTimestamp($post_time);
        $topicrows .= make_EvoForumsrow($rowimage, $row_class, $topic_id, $post_time, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_icon, $topic_postername, $forum_name, $forum_id, $topic_last_post_id, $post_username, $poster_id);
    }
}
$db->sql_freeresult($result1);
if( $SplitAnnouncements != 1) {
    $showrows = $announcements;
    $showrows .= $topicrows;
} else {
    $showrows = $topicrows;
}

$content = make_EvoForumstable($showrows, $announcements, $SplitAnnouncements, $count_topics, $count_posts, $count_forum);

?>