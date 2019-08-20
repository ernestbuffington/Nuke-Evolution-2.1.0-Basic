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

global $db, $cache, $evoconfig, $lang_block;
$module_name = 'Reviews';

function Block_LastReviewsConfig() {
  global $db, $module_name, $cache, $lang_block;
  static $reviewsconfig;
    if(isset($reviewsconfig) && is_array($reviewsconfig)) { return $reviewsconfig; }
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
    $reviewblockconfig = Block_LastReviewsConfig();
}

function block_lastreviews_cache($block_cachetime, $reviewblockconfig) {
    global $db, $cache;
    if ((($blockcache = $cache->load('lastreviews', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query('SELECT `rid`, `title`, `hits`, `reviewratingsummary` FROM `'._REVIEWS_REVIEWS_TABLE.'` ORDER BY `date` DESC LIMIT 0,'.$reviewblockconfig['block_rows']);
        $a = 0;
        while (list($rid, $title, $hits, $rating) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['rid']      = $rid;
            $blockcache[$a]['title']    = $title;
            $blockcache[$a]['hits']     = $hits;
            $blockcache[$a]['rating']   = $rating;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('lastreviews', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_lastreviews_cache($evoconfig['block_cachetime'], $reviewblockconfig);

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
        $title     = stripslashes(check_html($blocksession[$a]['title'], "nohtml"));
        $rid       = intval($blocksession[$a]['rid']);
        $hits      = intval($blocksession[$a]['hits']);
        $rating    = intval($blocksession[$a]['rating']);
    $image = "<img src='".evo_image('full.png', $module_name)."' width='10px' height='10px' alt='' />\n";
    $halfimage = "<img src='".evo_image('half.png', $module_name)."' width='10px' height='10px' alt='' />\n";
    $full = "<img src='".evo_image('full.png', $module_name)."' width='10px' height='10px' alt='' />\n";
    $null = "<img src='".evo_image('null.png', $module_name)."' width='10px' height='10px' alt='' />\n";
    $ratingimage = '';
    if ($rating == 10) {
        for ($i=0; $i < 5; $i++)
            $ratingimage .= $full;
     } else if ($rating % 2) {
        $rating -= 1;
        $rating /= 2;
        for ($i=0; $i < $rating; $i++)
            $ratingimage .= $image;
            $ratingimage .=  $halfimage;
        $rating = 4 - $rating;
        for ($i=0; $i < $rating; $i++)
            $ratingimage .=  $null;
    } else {
        $rating /= 2;
        for ($i=0; $i < $rating; $i++)
            $ratingimage .=  $image;
        $rating = 5 - $rating;
        for ($i=0; $i < $rating; $i++)
            $ratingimage .=  $null;
    }
    $blockcontent .= "<div style='text-align: center;'><a href='modules.php?name=Reviews&amp;op=showcontent&amp;rid=".$rid."'>".$title."</a></div>\n";
    $blockcontent .= "<div style='text-align: center;'>".$ratingimage."</div>\n";
    $blockcontent .= "<div style='text-align: center; font-size: x-small;'>&nbsp;".$hits." * ".$lang_block['BLOCK_REVIEWS_READS']."&nbsp;</div><br />\n";
}

$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<div style='text-align:center;font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    $content .= $blockcontent;
}
$content .= "</div>\n";

?>