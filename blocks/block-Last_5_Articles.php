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

global $db, $cache, $evoconfig, $currentlang;
$module_name = 'News';

function block_last5articles_cache($block_cachetime) {
    global $db, $cache, $evoconfig, $currentlang;
    if ((($blockcache = $cache->load('last5articles', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        if ($evoconfig['multilingual'] == 1) {
            $querylang = "AND (alanguage='$currentlang' OR alanguage='')";
        } else {
            $querylang = '';
        }
        $actualtime = actualTime();
        $result = $db->sql_query('SELECT `sid`, `title`, `score`, `ratings`, `counter` FROM `'._STORIES_TABLE.'` WHERE `time` <= "'.$actualtime.'" '.$querylang.' ORDER BY `time` DESC LIMIT 0,5');
        $a = 0;
        while (list($sid, $title, $score, $ratings, $counter) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['sid']      = $sid;
            $blockcache[$a]['title']    = $title;
            $blockcache[$a]['score']    = $score;
            $blockcache[$a]['counter']  = $counter;
            $blockcache[$a]['ratings']  = $ratings;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('last5articles', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_last5articles_cache($evoconfig['block_cachetime']);

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
        $title     = stripslashes(check_html($blocksession[$a]['title'], "nohtml"));
        $sid       = intval($blocksession[$a]['sid']);
        $counter   = intval($blocksession[$a]['counter']);
        $score     = intval($blocksession[$a]['score']);
        $ratings   = intval($blocksession[$a]['ratings']);
    if (($ratings > 0) && ($score > 0)) {
        $r_image = round($score / $ratings);
        switch ($r_image) {
            case (1):
                $the_image = "<img src='".evo_image('stars-1.png', $module_name)."' alt='' border='0' />";
                break;
            case (2):
                $the_image = "<img src='".evo_image('stars-2.png', $module_name)."' alt='' border='0' />";
                break;
            case (3):
                $the_image = "<img src='".evo_image('stars-3.png', $module_name)."' alt='' border='0' />";
                break;
            case (4):
                $the_image = "<img src='".evo_image('stars-4.png', $module_name)."' alt='' border='0' />";
                break;
            case (5):
                $the_image = "<img src='".evo_image('stars-5.png', $module_name)."' alt='' border='0' />";
                break;
        }
    } else {
        $the_image = '';
    }
    $blockcontent .= "<div style='text-align: center;'><a href='modules.php?name=News&amp;op=article&amp;sid=".$sid."'>".$title."</a></div>\n";
    if (!empty($the_image)) {
        $blockcontent .= "<div style='text-align: center;'>".$the_image."</div>\n";
    }
    $blockcontent .= "<div style='text-align: center;font-size: x-small;'>&nbsp;".$counter." * ".$lang_block['BLOCK_NEWS_READS']."&nbsp;</div><br />\n";
}

$content = "<div style='width:100%; text-align:center;'>\n";
if (empty($blockcontent)) {
    $content .= "<span style='font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</span>\n";
} else {
    $content .= $blockcontent;
    $content .= "<a href=\"modules.php?name=News\"><span style='font-size: x-small;'>".$lang_block['BLOCK_NEWS_MORENEWS']."</span></a>\n";
}
$content .= "</div>\n";

?>