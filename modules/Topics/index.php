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

include_once(NUKE_BASE_DIR.'header.php');

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- '._ACTIVETOPICS;
$actualtime = actualTime();

function TopicsHeading() {
    global $module_name;
    $text = "<center><span class=\"title\"><strong>"._ACTIVETOPICS."</strong></span><br />\n";
    $text .= "<br /><br />\n";
    $text .= "<form action=\"modules.php?name=Search\" method=\"post\">";
    $text .= "<input type=\"text\" name=\"query\" size=\"30\" /><br />";
    $text .= "<input type=\"submit\" value=\""._SEARCH."\" />";
    $text .= "</form></center>";
    title($text, $module_name, 'topics-logo.png');
}

global $db, $ThemeSel;
TopicsHeading();
OpenTable();
$sql = "SELECT t.topicid, t.topicimage, t.topictext, count(s.sid) AS stories, SUM(s.counter) AS readcount
        FROM (" ._TOPICS_TABLE." t LEFT OUTER JOIN " ._STORIES_TABLE." s ON t.topicid = s.topic)
        WHERE s.time <= '".$actualtime."'
        GROUP BY t.topicid";
$result = $db->sql_query($sql);
if ($db->sql_numrows($result) > 0) {
    while ($row = $db->sql_fetchrow($result)) {
        $output = '';
        $topicid = intval($row['topicid']);
        $topicimage = @evo_image(@basename($row['topicimage']), $module_name);
        $topictext = stripslashes(check_html($row['topictext'], "nohtml"));
        $output .= "<fieldset><legend><strong>$topictext</strong></legend><table border=\"0\" width=\"100%\" align=\"center\" cellpadding=\"2\">\n";
        $output .= "<tr>\n<td valign=\"top\" width=\"25%\">\n";
        $output .= "<center><a href=\"modules.php?name=News&amp;op=topics&amp;topic=".$topicid."\"><img src=\"".$topicimage."\" border=\"0\" alt=\"$topictext\" title=\"$topictext\"/></a></center><br />\n";
        $output .= "<span class=\"content\">";
        //$output .= "<big><strong>&middot;</strong></big>&nbsp;<strong>"._TOPIC.":</strong> $topictext<br />\n";
        $output .= "<strong>"._TOTNEWS.":</strong> ".$row['stories']."<br />\n";
        //$output .= "<big><strong>&middot;</strong></big>&nbsp;<strong>"._TOTREADS.":</strong> ".(isset($row['reads']) ? $row['reads'] : 0)."</span>";
        $output .= "<strong>"._TOTREADS.":</strong> ".(isset($row['readcount']) ? $row['readcount'] : 0)."</span>";
        $output .= "</td>\n<td valign=\"top\">\n";
        echo $output;
        if ($row['stories'] > 0) {
            $sql2 = "SELECT s.sid, s.catid, s.title, c.title AS cat_title
                    FROM ("._STORIES_TABLE." s LEFT OUTER JOIN "._STORIES_CATEGORIES_TABLE." c ON s.catid = c.catid)
                    WHERE s.topic=$topicid
                    AND s.time <= '".$actualtime."'
                    ORDER BY s.time DESC LIMIT 0,10";
            $result2 = $db->sql_query($sql2);
            while ($row2 = $db->sql_fetchrow($result2)) {
                $cat_link = (intval($row2['catid']) > 0) ? "<a href=\"modules.php?name=News&amp;op=categories&amp;mode=newindex&amp;catid=".intval($row2['catid'])."\"><strong>".check_words(stripslashes(check_html($row2['cat_title'], "nohtml")))."</strong></a>: " : "";
                echo "<img src=\"". evo_image('arrow.png', 'evo')."\" alt=\"\" /> $cat_link<a href=\"modules.php?name=News&amp;op=article&amp;sid=".intval($row2['sid'])."\">".check_words($row2['title'])."</a><br />";
            }
            if ($row['stories'] > 10) {
                echo "<div align=\"right\"><a href=\"modules.php?name=News&amp;op=topics&amp;topic=".$topicid."\"><strong>"._MORE."</strong><img class=\"absmiddle\" src=\"". evo_image('more.png', 'evo')."\" width=\"16\" height=\"16\" alt=\"\"  /></a></div>";
            }
        } else {
            echo "<em>"._NONEWSYET."</em>";
        }
        echo "</td>\n</tr>\n";
        echo "</table></fieldset>\n<br />";
    }
} else {
  echo "<em>"._NONEWSYET."</em>";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>