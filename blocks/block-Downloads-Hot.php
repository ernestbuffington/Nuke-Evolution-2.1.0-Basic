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

global $db, $cache, $evoconfig;
$blkh = 20; // Number of lines high
$blkw = 0; // Number of characters wide 0 = unused
$scron = 1; // Turn scrolling on by setting to 1
$scrdr = 'up'; // Scroll direction (up, down, left, or right)
$scrhg = 150; // Scroller height in pixels

function block_downloadshot_cache($block_cachetime, $blkh) {
    global $db, $cache;
    if ((($blockcache = $cache->load('downloadshot', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query('SELECT `did`, `title`, `hits` FROM `'._DOWNLOADS_DOWNLOADS_TABLE.'` ORDER BY `hits` DESC LIMIT 0, '.$blkh);
        $a = 0;
        while (list($did, $title, $hits) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['did']= $did;
            $blockcache[$a]['title']= $title;
            $blockcache[$a]['hits']= $hits;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('downloadshot', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_downloadshot_cache($evoconfig['block_cachetime'], $blkh);

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
    $title = stripslashes(check_html($blocksession[$a]['title'], "nohtml"));
    $did = intval($blocksession[$a]['did']);
    $hits = intval($blocksession[$a]['hits']);
    $title2 = str_replace("_", " ", $title);
    $title = strtr($title, " ()", "_[]");
    $blockcontent .= "<div style='float: left;width: 10%;'><img src='".evo_image('arrow.png', 'blocks/modules')."' alt='' title='' />&nbsp;</div>\n";
    $blockcontent .= "<div style='float: left;white-space: normal;width: 90%;'><a href='modules.php?name=Downloads&amp;op=showdownload&amp;did=$did'>$title2</a></div><br />\n";
    $blockcontent .= "<div style='clear: both;text-align: center;font-size: x-small;'>$hits * ".$lang_block['BLOCK_DOWNLOAD_DONE']."</div><br />\n";
}

$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<div style='text-align:center;font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    if ($scron == 1) {
        $content .= "<div style='width: 100%; height: 150px; text-align: left;'>\n";
        $content .= evo_marquee('block_Downloads_Hot', '100%', '100%', $blockcontent, $scrdr, 1, '100%', '100%' , 1, 0);
        $content .= "</div>\n";
    } else {
        $content .= $blockcontent;
    }
}
$content .= "</div>\n";

?>