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

global $db, $usrinfo, $evoconfig;
// Last 10 Comments
if ($evoconfig['articlecomm'] == 1) {
    $result6 = $db->sql_query("SELECT tid, sid, subject FROM "._COMMENTS_TABLE." WHERE name='".$usrinfo['username']."' ORDER BY tid DESC LIMIT 0,10");
    if (($db->sql_numrows($result6) > 0)) {
        echo "<br />";
        OpenTable();
        $usrcolor = UsernameColor($usrinfo['username']);
        echo "<strong>".$usrcolor."'s "._LAST10COMMENT.":</strong><br />";
        while($row6 = $db->sql_fetchrow($result6)) {
            $tid = $row6['tid'];
            $sid = $row6['sid'];
            $subject = $row6['subject'];
            echo "<a href=\"modules.php?name=News&amp;op=article&amp;thold=-1&amp;mode=flat&amp;order=0&amp;sid=$sid#$tid\">$subject</a><br />";
        }
        $db->sql_freeresult($result6);
        CloseTable();
    }
}

// Last 10 Submissions
$result7 = $db->sql_query("SELECT sid, title FROM "._STORIES_TABLE." WHERE informant='$usrinfo[username]' ORDER BY sid DESC LIMIT 0,10");
if (($db->sql_numrows($result7) > 0)) {
    echo "<br />";
    OpenTable();
    $usrcolor = UsernameColor($usrinfo['username']);
    echo "<strong>".$usrcolor."'s "._LAST10SUBMISSION.":</strong><br />";
    while($row7 = $db->sql_fetchrow($result7)) {
        $sid = $row7['sid'];
        $title = $row7['title'];
        echo "<a href=\"modules.php?name=News&amp;op=article&amp;sid=$sid\">$title</a><br />";
    }
    CloseTable();
}

?>