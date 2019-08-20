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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

global $db, $evoconfig, $_GETVAR, $template, $userinfo, $currentlang, $lang;
$num = ($_GETVAR->get('num', '_REQUEST') ) ? 'LIMIT '.$num : 'LIMIT 10';

$gmtdiff = date("O", time());
$gmtstr = substr($gmtdiff, 0, 3) . ":" . substr($gmtdiff, 3, 9);

define('TIME_ZONE', $gmtstr);

include_once(NUKE_CLASSES_DIR . 'class.feedcreator.php');
if (!defined('IN_PHPBB')) {define('IN_PHPBB', TRUE);}

//define channel
$rss = new UniversalFeedCreator();
$rss->useCached();
$rss->encoding      ='UTF-8';
$rss->descriptionHtmlSyndicated = true;
$rss->title         =EVO_SERVER_SITENAME;
$rss->description   =$evoconfig['slogan'];
$rss->link          =EVO_SERVER_URL . '/';
$rss->syndicationURL=EVO_SERVER_URL . '/rss.php?feed=forums';
$rss->image->url    =EVO_SERVER_URL . '/images/evo/minilogo.gif';
$rss->image->title  =EVO_SERVER_SITENAME;
$rss->image->link   =EVO_SERVER_URL . '/';
$rss->image->width  ='88';
$rss->image->height ='31';

include_once(NUKE_FORUMS_DIR.'attach_mod/includes/functions_includes.php');
include_once(NUKE_INCLUDE_DIR.'auth.php');
include_once(NUKE_INCLUDE_DIR.'bbcode.php');
$lang = array();
include_once(NUKE_FORUMS_DIR.'language/lang_'.$currentlang.'/lang_main.php');
$userdata['user_id'] = $userinfo['user_id'];
$userdata['user_level'] = $userinfo['user_level'];
$userdata['session_logged_in'] = is_user();
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

$sql = "SELECT t.topic_title, p3.post_id, p3.post_text, p2.post_time, u2.username as author_username, u2.user_email as author_email
        FROM ". FORUMS_TABLE . " f,
             ". POSTS_TABLE . " p,
             ". TOPICS_TABLE . " t,
             ". POSTS_TABLE . " p2,
             ". _USERS_TABLE . " u,
             ". _USERS_TABLE . " u2,
             ". POSTS_TEXT_TABLE." p3
        WHERE f.forum_id NOT IN (" . $forumsignore . ")
            AND t.forum_id = f.forum_id
            AND p.post_id = t.topic_first_post_id
            AND p2.post_id = t.topic_last_post_id
            AND t.topic_moved_id = 0
            AND u.user_id = p2.poster_id
            AND u2.user_id = t.topic_poster
            AND p3.post_id = p2.post_id
        GROUP BY p2.topic_id
        ORDER BY p2.post_time DESC
        $num";

$result1 = $db->sql_query($sql);

//channel items/entries
while ( list( $topic_title, $post_id, $desc, $post_time, $username, $useremail ) =  $db->sql_fetchrow($result1)) {
    $topic_title    = set_smilies(decode_bbcode(check_words(stripslashes($topic_title)), 0, true), EVO_SERVER_URL);
    $desc           = set_smilies(decode_bbcode(stripslashes($desc), 0, true), EVO_SERVER_URL);
    $item = new FeedItem();
    $item->title    = html_entity_decode(check_words($topic_title));
    $item->link     = EVO_SERVER_URL."/modules.php?name=Forums&amp;file=viewtopic&amp;p=$post_id#$post_id";
    $item->source   = EVO_SERVER_URL;
    $item->updated  = $post_time;
    $item->creator  = $username;
    $item->description = check_words($desc);
    $item->descriptionTruncSize = 500;
    $item->descriptionHtmlSyndicated = true;
    $item->guid     = $post_id.'@'.EVO_SERVER_URL;
    $item->date     = $post_time;
    $rss->addItem($item);
}

$rss->outputFeed('RSS2.0');

?>