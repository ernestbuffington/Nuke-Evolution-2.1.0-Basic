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

function Block_ReviewsConfig() {
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
    $reviewblockconfig = Block_ReviewsConfig();
}

function block_reviews_cache($block_cachetime, $reviewblockconfig) {
    global $db, $cache;
    if ((($blockcache = $cache->load('reviews', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query('SELECT `rid`, `title` FROM `'._REVIEWS_REVIEWS_TABLE.'` ORDER BY `date` DESC limit 0, '.$reviewblockconfig['block_rows']);
        $a = 0;
        while (list($rid, $title) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['rid']   = $rid;
            $blockcache[$a]['title'] = $title;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('reviews', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_reviews_cache($evoconfig['block_cachetime'], $reviewblockconfig);

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
    $title = stripslashes(check_html($blocksession[$a]['title'], 'nohtml'));
    $rid   = intval($blocksession[$a]['rid']);
    $blockcontent .= "<div style='float: left;width: 10%;'><img src='".evo_image('arrow.png', 'blocks/modules')."' alt='' title='' />&nbsp;</div>\n";
    $blockcontent .= "<div style='float: left;white-space: normal;width: 90%;'><a href='modules.php?name=Reviews&amp;op=showcontent&amp;rid=$rid'>$title</a></div><br />\n";
    $blockcontent .= "<div style='clear: both;'></div><br />\n";
}

$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<div style='text-align:center;font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    if ($scron == 1) {
        $content .= "<div style='width: 100%; height: 150px; text-align: left;'>\n";
        $content .= evo_marquee('block_Reviews', '100%', '100%', $blockcontent, $scrdr, 1, '100%', '100%' , 1, 0);
        $content .= "</div>\n";
    } else {
        $content .= $blockcontent;
    }
}
$content .= "</div>\n";


?>