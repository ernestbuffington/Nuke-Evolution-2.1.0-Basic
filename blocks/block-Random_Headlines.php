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

global $db, $evoconfig, $currentlang;
$module_name = 'News';

// Makes no sense to cache this - one statement with changing content every time called
$blockcontent = '';
$result = $db->sql_ufetchrow('SELECT `sid`, `title`, `score`, `ratings`, `counter` FROM `'._STORIES_TABLE.'` ORDER BY RAND() LIMIT 1');
$title     = $result['title'];
$sid       = intval($result['sid']);
$counter   = intval($result['counter']);
$score     = intval($result['score']);
$ratings   = intval($result['ratings']);
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
$blockcontent .= "<div style='text-align: center;'><span><a href='modules.php?name=News&amp;op=article&amp;sid=".$sid."'>".$title."</a></span><br />\n";
if (!empty($the_image)) {
    $blockcontent .= "<span>".$the_image."</span><br />\n";
}
if ( $counter > 0 ) {
    $blockcontent .= "<span style='font-size: x-small;'>[&nbsp;".$counter."*".$lang_block['BLOCK_NEWS_READS']."&nbsp;]</span></div><br />\n";
} else {
    $blockcontent .= "</div>\n";
}

$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<p style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</p>\n";
} elseif (empty($title)) {
    $content .= "<p style='text-align: center;'><a href='http://www.nuke-evolution.de' target='_blank'><img src='".evo_image('evo_german_minilogo.gif', 'evo')."' width='88px' title='Evo-German' alt='Evo-German' /></a></p><br />\n";
    $content .= "<p style='text-align:center; font-size: small; font-weight: bold;'>[<a href=\"modules.php?name=News\">".$lang_block['BLOCK_NEWS_MORENEWS']."</a>]</p>\n";
} else {
    $content .= $blockcontent;
    $content .= "<p style='text-align:center; font-size: small; font-weight: bold;'>[<a href=\"modules.php?name=News\">".$lang_block['BLOCK_NEWS_MORENEWS']."</a>]</p>\n";
}
$content .= "</div>\n";

?>