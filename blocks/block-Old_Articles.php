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

global $db, $userinfo, $evoconfig, $currentlang, $storynum, $_GETVAR, $lang;
$module_name = 'Stories_Archive';

if (!is_active('Stories_Archive')) {
    $content = $lang_block['BLOCK_NO_CONTENT'];
    return $content;
}

// This Block couldn't be cached because it reacts on actual informations submitted by the user

$new_topic = $_GETVAR->get('new_topic', '_GET', 'int', 0);
$start_min = $_GETVAR->get('min', '_GET', 'int', 0);
$cat_id    = $_GETVAR->get('catid', '_GET', 'int', 0);
$startsid  = $_GETVAR->get('sid', '_GET', 'int', 0);
$in_module = $_GETVAR->get('name', '_GET');

$shown_stories = ((intval($storynum)) ? $storynum : 0);
switch (strtolower($in_module)) {
    case 'news':                $sql_start = (($startsid) ? $startsid : $shown_stories); break;
    case 'stories_archive':     $sql_start = (($startsid) ? $startsid : $shown_stories); break;
    case 'topics':              $sql_start = (($startsid) ? $startsid : $shown_stories); break;
    default:                    $sql_start = $shown_stories; break;
}

$sql_start = ($start_min > 0) ? $start_min : $sql_start;
$sql_end   = ($evoconfig['oldnum'] > 30) ? 30 : $evoconfig['oldnum'];

$actualtime = actualTime();

$querylang = 'WHERE `time` <= "'.$actualtime.'"';
$querylang .= (($new_topic > 0) ? ' AND `topic_id`='.$new_topic : (($cat_id > 0) ? ' AND `cat_id`='.$cat_id : ''));
if ($evoconfig['multilingual'] == 1) {
    $querylang .= "AND (`alanguage`='".$currentlang."' OR `alanguage`='')";
}

if ( isset($userinfo['storynum']) || ($userinfo['storynum'] < $storynum) ) {
    $storynum = (($userinfo['storynum']) ? $userinfo['storynum'] : 10);
}

// Old Articles are Articles not shown acutally on the screen, therefore we have to add storynum
$sql_start = $sql_start + $storynum;

$querylang .= 'ORDER BY `time` DESC LIMIT '.$sql_start.','.$storynum;

$result = $db->sql_query('SELECT `sid`, `title`, UNIX_TIMESTAMP(`time`), `comments` FROM `'._STORIES_TABLE.'` '.$querylang);

$blockcontent = '';
$changetime = 0;
while (list($sid, $title, $time, $comments) = $db->sql_fetchrow($result)) {
        $title     = stripslashes(check_html($title, "nohtml"));
        $sid       = intval($sid);
        $time      = intval($time);
        $comments  = intval($comments);
    if ($evoconfig['articlecomm'] == 1) {
        $comments = '('.$comments.')';
    } else {
        $comments = '';
    }
    if ($changetime == $time ) {
        // date is the same
        $blockcontent .= "<div style='text-align: center;'><span><a href='modules.php?name=News&amp;op=article&amp;sid=".$sid."'>".$title."</a></span><br />\n";
        if ( !empty($comments) ) {
            $blockcontent .= "<span style='font-size: x-small;'>".$comments."</span></div><br />\n";
        } else {
            $blockcontent .= "</div><br />\n";
        }
        $changetime = $time;
    } else {
        // date has changed
        $blockcontent .= "<p style='text-align: center; font-weight: bold; font-size: x-small;'>".formatTimestamp($time)."</p>\n";
        $blockcontent .= "<div style='text-align: center;'><span><a href='modules.php?name=News&amp;op=article&amp;sid=".$sid."'>".$title."</a></span><br />\n";
        if ( !empty($comments) ) {
            $blockcontent .= "<span style='font-size: x-small;'>".$comments."</span></div><br />\n";
        } else {
            $blockcontent .= "</div><br />\n";
        }
        $changetime = $time;
    }
}
$db->sql_freeresult($result);

$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<p style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</p>\n";
} else {
    $content .= "<p style='text-align:center; font-weight: bold'>".$lang_block['BLOCK_NEWS_ARTICLES_LAST']."</p>\n";
    $content .= $blockcontent;
    $content .= "<p style='text-align:center; font-size: small; font-weight: bold;'>[<a href=\"modules.php?name=News\">".$lang_block['BLOCK_NEWS_MORENEWS']."</a>]</p>\n";
}
$content .= "</div>\n";

?>