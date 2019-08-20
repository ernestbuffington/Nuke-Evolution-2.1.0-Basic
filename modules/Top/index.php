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
   die('You can\'t access this file directly...');
}
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

include_once(NUKE_BASE_DIR.'header.php');

global $db, $evoconfig, $currentlang, $lang_new, $_GETVAR;

if ($evoconfig['multilingual'] == 1) {
    $queryalang  = "WHERE (alanguage='$currentlang' OR alanguage='')"; /* top stories */
    $querya1lang = "WHERE (alanguage='$currentlang' OR alanguage='') AND"; /* top stories */
    $querya2lang = "WHERE (alanguage='$currentlang' OR alanguage='') AND "; /* top comments */
    $queryslang  = "WHERE slanguage='$currentlang' "; /* top section articles */
    $queryplang  = "WHERE planguage='$currentlang' "; /* top polls */
    $queryrlang  = "WHERE rlanguage='$currentlang' "; /* top reviews */
} else {
    $queryalang  = '';
    $querya1lang = 'WHERE';
    $querya2lang = 'WHERE';
    $queryslang  = '';
    $queryplang  = '';
    $queryrlang  = '';
}
title($lang_new[$module_name]['TOPWELCOME'].' '.EVO_SERVER_SITENAME, $module_name, 'top-logo.png');
OpenTable();

/* Top 10 read stories */
$result = $db->sql_query("SELECT sid, title, counter FROM "._STORIES_TABLE." ".$queryalang." ORDER BY counter DESC LIMIT 0,".$evoconfig['top']);
echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top'] ." ".$lang_new[$module_name]['READSTORIES']."</strong></span><ol>\n";
if ($db->sql_numrows($result) > 0) {
    while ($row = $db->sql_fetchrow($result)) {
        $sid = intval($row['sid']);
        $title = stripslashes(check_html($row['title'], 'nohtml'));
        $counter = intval($row['counter']);
        echo "<li><a href='modules.php?name=News&amp;op=article&amp;sid=".$sid."'>".$title."</a> - (".$counter." ".$lang_new[$module_name]['READS'].")</li>\n";
    }
} else {
    echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
}
echo "</ol></div>\n";
$db->sql_freeresult($result);

/* Top 10 most voted stories */
$result2 = $db->sql_query("SELECT sid, title, ratings FROM "._STORIES_TABLE." ".$querya1lang." score!='0' ORDER BY ratings DESC LIMIT 0,".$evoconfig['top']);
echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top']." ".$lang_new[$module_name]['MOSTVOTEDSTORIES']."</strong></span><ol>\n";
if ($db->sql_numrows($result2) > 0) {
    while ($row2 = $db->sql_fetchrow($result2)) {
        $sid = intval($row2['sid']);
        $title = stripslashes(check_html($row2['title'], 'nohtml'));
        $ratings = intval($row2['ratings']);
        if($ratings>0) {
            echo "<li><a href='modules.php?name=News&amp;op=article&amp;sid=".$sid."'>".$title."</a> - (".$ratings." ".$lang_new[$module_name]['LVOTES'].")</li>\n";
        }
    }
} else {
    echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
}
echo "</ol></div>\n";
$db->sql_freeresult($result2);

/* Top 10 best rated stories */
$result3 = $db->sql_query("SELECT sid, title, score, ratings FROM "._STORIES_TABLE." ".$querya1lang." score!='0' ORDER BY ratings+score DESC LIMIT 0,".$evoconfig['top']);
echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top']." ".$lang_new[$module_name]['BESTRATEDSTORIES']."</strong></span><ol>\n";
if ($db->sql_numrows($result3) > 0) {
    while ($row3 = $db->sql_fetchrow($result3)) {
        $sid = intval($row3['sid']);
        $title = stripslashes(check_html($row3['title'], 'nohtml'));
        $score = intval($row3['score']);
        $ratings = intval($row3['ratings']);
        if($score>0) {
            $rate = substr($score / $ratings, 0, 4);
            echo "<li><a href='modules.php?name=News&amp;op=article&amp;sid=".$sid."'>".$title."</a> - (".$rate." ".$lang_new[$module_name]['POINTS'].")</li>\n";
        }
    }
} else {
    echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
}
echo "</ol></div>\n";
$db->sql_freeresult($result3);

/* Top 10 commented stories */
if ($evoconfig['articlecomm'] == 1) {
    echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top']." ".$lang_new[$module_name]['COMMENTEDSTORIES']."</strong></span><ol>\n";
    $result4 = $db->sql_query("SELECT sid, title, comments FROM "._STORIES_TABLE." ".$querya2lang." comments > 0 ORDER BY comments DESC LIMIT 0,".$evoconfig['top']);
    if ($db->sql_numrows($result4) > 0) {
        while ($row4 = $db->sql_fetchrow($result4)) {
            $sid = intval($row4['sid']);
            $title = stripslashes(check_html($row4['title'], 'nohtml'));
            $comments = intval($row4['comments']);
            if($comments>0) {
                echo "<li><a href='modules.php?name=News&amp;op=article&amp;sid=".$sid."'>".$title."</a> - (".$comments." ".$lang_new[$module_name]['COMMENTS'].")</li>\n";
            }
        }
    } else {
        echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
    }
    echo "</ol></div>\n";
}
$db->sql_freeresult($result4);

/* Top 10 categories */
$result5 = $db->sql_query("SELECT catid, title, counter FROM "._STORIES_CATEGORIES_TABLE." WHERE counter > 0 ORDER BY counter DESC LIMIT 0,".$evoconfig['top']);
echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top']." ".$lang_new[$module_name]['ACTIVECAT']."</strong></span><ol>\n";
if ($db->sql_numrows($result5) > 0) {
    while ($row5 = $db->sql_fetchrow($result5)) {
        $catid = intval($row5['catid']);
        $title = stripslashes(check_html($row5['title'], 'nohtml'));
        $counter = intval($row5['counter']);
        if($counter>0) {
            echo "<li><a href='modules.php?name=News&amp;op=categories&amp;op=newindex&amp;catid=".$catid."'>".$title."</a> - (".$counter." ".$lang_new[$module_name]['HITS'].")</li>\n";
        }
    }
} else {
    echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
}
echo "</ol></div>\n";
$db->sql_freeresult($result5);

/* Top 10 users submitters */
$result7 = $db->sql_query("SELECT username, counter FROM "._USERS_TABLE." WHERE counter > '0' AND user_id <> " . ANONYMOUS . "  AND user_active > '0' ORDER BY counter DESC LIMIT 0,".$evoconfig['top']);
echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top']." ".$lang_new[$module_name]['NEWSSUBMITTERS']."</strong></span><ol>\n";
if ($db->sql_numrows($result7) > 0) {
    while ($row7 = $db->sql_fetchrow($result7)) {
        $uname = stripslashes($row7['username']);
        $counter = intval($row7['counter']);
        if($counter>0) {
            echo "<li><a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$uname."'>".$uname."</a> - (".$counter." ".$lang_new[$module_name]['NEWSSENT'].")</li>\n";
        }
    }
} else {
    echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
}
echo "</ol></div>\n";
$db->sql_freeresult($result7);

/* Top 10 Polls */
$result8 = $db->sql_query("SELECT * FROM "._POLL_DESC_TABLE." ".$queryplang);
echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top']." ".$lang_new[$module_name]['VOTEDPOLLS']."</strong></span><ol>\n";
if ($db->sql_numrows($result8)>0) {
    $result9 = $db->sql_query("SELECT pollID, pollTitle, timeStamp, voters FROM "._POLL_DESC_TABLE." $queryplang ORDER BY voters DESC limit 0,".$evoconfig['top']);
    $counter = 0;
    while($row9 = $db->sql_fetchrow($result9)) {
        $resultArray[$counter] = array($row9['pollID'], $row9['pollTitle'], $row9['timeStamp'], $row9['voters']);
        $counter++;
    }
    $db->sql_freeresult($result9);
    for ($count = 0; $count < count($resultArray); $count++) {
        $id = $resultArray[$count][0];
        $pollTitle = $resultArray[$count][1];
        $voters = $resultArray[$count][3];
        for($i = 0; $i < 12; $i++) {
            $result10 = $db->sql_query("SELECT optionCount FROM "._POLL_DATA_TABLE." WHERE (pollID='".$id."') AND (voteID='".$i."')");
            $row10 = $db->sql_fetchrow($result10);
            $optionCount = $row10['optionCount'];
            if(!isset($sum)) {
                $sum = 0;
            }
            $sum = (int)$sum+$optionCount;
        }
        echo "<li><a href='modules.php?name=Surveys&amp;pollID=".$id."'>".$pollTitle."</a> - (".$sum." ".$lang_new[$module_name]['LVOTES'].")</li>\n";
        $sum = 0;
    }
} else {
    echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
}
echo "</ol></div>\n";
$db->sql_freeresult($result8);

/* Top 10 reviews */
$result12 = $db->sql_query("SELECT rid, title, hits FROM "._REVIEWS_REVIEWS_TABLE." ORDER BY hits DESC LIMIT 0,".$evoconfig['top']);
echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top']." ".$lang_new[$module_name]['READREVIEWS']."</strong></span><ol>\n";
if ($db->sql_numrows($result12) > 0) {
    while ($row12 = $db->sql_fetchrow($result12)) {
        $id = intval($row12['rid']);
        $title = stripslashes(check_html($row12['title'], "nohtml"));
        $hits = intval($row12['hits']);
        if($hits>0) {
            echo "<li><a href='modules.php?name=Reviews&amp;op=showreview&amp;rid=".$id."'>".$title."</a> - (".$hits." ".$lang_new[$module_name]['READS'].")</li>\n";
        } else {
            echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
        }
    }
} else {
    echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
}
echo "</ol></div>\n";
$db->sql_freeresult($result12);

/* Top 10 downloads */

$result13 = $db->sql_query("SELECT did, cid, title, hits FROM "._DOWNLOADS_DOWNLOADS_TABLE." WHERE hits > 0 ORDER BY hits DESC LIMIT 0,".$evoconfig['top']);
echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top']." ".$lang_new[$module_name]['DOWNLOADEDFILES']."</strong></span><ol>\n";
if ($db->sql_numrows($result13) > 0) {
    while ($row13 = $db->sql_fetchrow($result13)) {
        $did = intval($row13['did']);
        $cid = intval($row13['cid']);
        $title = stripslashes(check_html($row13['title'], 'nohtml'));
        $hits = intval($row13['hits']);
        if($hits>0) {
            $row_res = $db->sql_fetchrow($db->sql_query("SELECT title FROM "._DOWNLOADS_CATEGORIES_TABLE." WHERE cid='".$cid."'"));
            $ctitle = stripslashes(check_html($row_res['title'], 'nohtml'));
            $utitle = preg_replace('# #', '_', $title);
            echo "<li><a href='modules.php?name=Downloads&amp;op=viewdownloaddetails&amp;did=".$did."&amp;ttitle=".$utitle."'>".$title."</a> (".$lang_new[$module_name]['CATEGORY'].": ".$ctitle.") - (".$hits." ".$lang_new[$module_name]['LDOWNLOADS'].")</li>\n";
        } else {
            echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
        }
    }
} else {
    echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
}
echo "</ol></div>\n";
$db->sql_freeresult($result13);

/* Top 10 Pages in Content */
$result14 = $db->sql_query("SELECT pid, title, counter FROM "._PAGES_TABLE." WHERE active='1' ORDER BY counter DESC LIMIT 0,".$evoconfig['top']);
echo "<div style='padding: 10px;'><span class='option'><strong>".$evoconfig['top']." ".$lang_new[$module_name]['MOSTREADPAGES']."</strong></span><ol>\n";
if ($db->sql_numrows($result14) > 0) {
    while ($row14 = $db->sql_fetchrow($result14)) {
        $pid = intval($row14['pid']);
        $title = stripslashes(check_html($row14['title'], 'nohtml'));
        $counter = intval($row14['counter']);
        if($counter>0) {
            echo "<li><a href='modules.php?name=Content&amp;pa=showpage&amp;pid=".$pid."'>".$title."</a> (".$counter." ".$lang_new[$module_name]['READS'].")</li>\n";
        } else {
            echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
        }
    }
} else {
    echo "<li>".$lang_new[$module_name]['NONE']."</li>\n";
}
echo "</ol></div>\n";
$db->sql_freeresult($result14);

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>