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

global $db, $evoconfig;

function block_Hits_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('hits', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_ufetchrow('SELECT `count` FROM `'._COUNTER_TABLE.'` WHERE `type`="total" AND `var`="hits" LIMIT 1');
        $blockcache[1]['count'] = $result['count'];
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('hits', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_Hits_cache($evoconfig['block_cachetime']);

$content = "<div style='text-align: center; width: 100%;'>\n";
if (empty($blocksession[1]['count'])) {
    $content .= "<div style='text-align:center;font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    $content .= "<div style='text-align: center;'>".$lang_block['BLOCK_HITS_TOTALHITS']."&nbsp;".$lang_block['BLOCK_HITS_PAGEVIEWS']."</div>\n";
    $content .= "<div style='text-align: center; font-weight: bold;'><a href='modules.php?name=Statistics'>".$blocksession[1]['count']."</a></div>";
    $content .= "<div style='text-align: center;font-size: x-small;'>".$lang_block['BLOCK_HITS_SINCE']."&nbsp;".$evoconfig['startdate']."</div>\n";
}
$content .= "</div>\n";

?>