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

global $db, $evoconfig, $cache, $direction;
$module_name = 'Reviews';


$blkh = 5; // Number of lines high
$blkw = 0; // Number of characters wide 0 = unused
$scron = 1; // Turn scrolling on by setting to 1
$scrdr = 'up'; // Scroll direction (up, down, left, or right)
$scrhg = 100; // Scroller height in pixels
$blockcontent = '';

function Block_Last5ReviewsConfig() {
    global $db, $module_name, $cache, $lang_block;
    static $reviewsconfig;
    if(isset($reviewsconfig) && is_array($reviewsconfig)) {
        return $reviewsconfig;
    }
    if ((($reviewsconfig = $cache->load('Reviews', 'config')) === false) || empty($reviewsconfig)) {
        $sql = 'SELECT `config_value`, `config_name` from `'._REVIEWS_CONFIG_TABLE.'`' ;
        if(!$result = $db->sql_query($sql)) {
            DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $lang_block['BLOCK_NO_CONFIG'] . $module_name);
        }
        while ($row = $db->sql_fetchrow($result)) {
            $reviewsconfig[$row['config_name']] = $row['config_value'];
        }
        $cache->save('Reviews', 'config', $reviewsconfig);
        $db->sql_freeresult($result);
    }
    return $reviewsconfig;
}

$reviewblockconfig = $cache->load('Reviews', 'config');
if ( empty($reviewblockconfig) ) {
    $reviewblockconfig = Block_Last5ReviewsConfig();
}

$number_of_reviews = 5;
$rand_review = '';


$sql = "SELECT rid, title, body, image, date FROM "._REVIEWS_REVIEWS_TABLE." ORDER BY rid DESC LIMIT 0,$number_of_reviews ";
$result = $db->sql_query($sql);
while (list($rid, $title, $body, $image, $date) = $db->sql_fetchrow($result)) {
    $rid = intval($rid);
    $title = stripslashes($title);
    $body = wordwrap(set_smilies(decode_bbcode(stripslashes($body)), 1, true));
    $blockcontent .= "<div style='float: left;width: 10%;'><img src='".evo_image('arrow.png', 'blocks/modules')."' alt='' title='' />&nbsp;</div>\n";
    $blockcontent .= "<div style='float: left;white-space: normal;width: 90%;'><a href='modules.php?name=Reviews&amp;op=showcontent&amp;rid=$rid'>$title</a></div><br />\n";
    $blockcontent .= "<div style='clear: both;'></div><br />\n";
}
$db->sql_freeresult($result);

$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<div style='text-align:center;font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    if ($scron == 1) {
        $content .= "<div style='width: 100%; height: 150px; text-align: left;'>\n";
        $content .= evo_marquee('block_Last_5_Reviews', '100%', '100%', $blockcontent, $scrdr, 1, '100%', '100%' , 1, 0);
        $content .= "</div>\n";
    } else {
        $content .= $blockcontent;
    }
}
$content .= "</div>\n";

?>