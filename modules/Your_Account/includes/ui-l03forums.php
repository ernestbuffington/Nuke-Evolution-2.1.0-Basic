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

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

global $db, $usrinfo;
if (is_admin() ) {
    $auth_sql = '';
} elseif ( is_user() ) {
    $auth_sql = "AND auth_view <= '".AUTH_REG."' AND auth_read <= '".AUTH_REG."'";
} else {
    $auth_sql = "AND auth_view = '".AUTH_ALL."' AND auth_read = '".AUTH_ALL."'";
}


// Last 10 Forum Topics
$result8 = $db->sql_query("SELECT t.topic_id, t.topic_title, f.forum_name, t.forum_id FROM (".TOPICS_TABLE." t, ".FORUMS_TABLE." f) WHERE t.forum_id=f.forum_id AND t.topic_poster='".$usrinfo['user_id']."' $auth_sql ORDER BY t.topic_time DESC LIMIT 0,10");
if (($db->sql_numrows($result8) > 0)) {
    echo "<br />";
    OpenTable();
    $usrcolor = UsernameColor($usrinfo['username']);
    echo "<strong>".$usrcolor."'s "._LAST10BBTOPIC.":</strong><br />";
    while(list($topic_id, $topic_title, $forum_name, $forum_id) = $db->sql_fetchrow($result8)) {
        echo "<a href=\"modules.php?name=Forums&amp;file=viewforum&amp;f=$forum_id\">$forum_name</a>&nbsp;&#187;&nbsp;<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;t=$topic_id\">$topic_title</a><br />";
    }
    $db->sql_freeresult($result8);
    CloseTable();
}

// Last 10 Forum Posts
$result12 = $db->sql_query("SELECT p.post_id, r.post_subject, f.forum_name, p.forum_id FROM (".POSTS_TABLE." p, ".POSTS_TEXT_TABLE." r, ".FORUMS_TABLE." f) WHERE p.forum_id=f.forum_id AND r.post_id=p.post_id AND p.poster_id='".$usrinfo['user_id']."' $auth_sql ORDER BY p.post_time DESC LIMIT 0,10");
if (($db->sql_numrows($result12) > 0)) {
    echo "<br />";
    OpenTable();
     $usrcolor = UsernameColor($usrinfo['username']);
     echo "<strong>$usrcolor's "._LAST10BBPOST.":</strong><br />";
    while(list($post_id, $post_subject, $forum_name, $forum_id) = $db->sql_fetchrow($result12)) {
        if(empty($post_subject)) { $post_subject = _NOPOSTSUBJECT; }
        echo "<a href=\"modules.php?name=Forums&amp;file=viewforum&amp;f=$forum_id\">$forum_name</a>&nbsp;&#187;&nbsp;<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;p=$post_id#$post_id\">$post_subject</a><br />";
    }
    $db->sql_freeresult($result12);
    CloseTable();
}

?>