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
$module_name = 'Nuke_Sentinel';

function block_SentinelCenter_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('sentinelcenter', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_ufetchrow('SELECT COUNT(`ip_addr`) AS no FROM `'._SENTINEL_BLOCKED_IPS_TABLE.'`');
        $blockcache[1]['ip_addr'] = $result['no'];
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('sentinelcenter', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession  = block_SentinelCenter_cache($evoconfig['block_cachetime']);
$block_image   = evo_image('Sentinel_Large.png', 'nukesentinel');

$blockcontent  = '';
$hack_count    = $blocksession[1]['ip_addr'];
$blockcontent .= "<div style='text-align:center;'>".$lang_block['BLOCK_SENTINEL_CAUGHT']."&nbsp;<strong>".intval($hack_count)."&nbsp;".$lang_block['BLOCK_SENTINEL_SHAME']."</strong>&nbsp;".$lang_block['BLOCK_SENTINEL_SHAME1']."</div>\n";
$content = "<div style='text-align: center; width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<div style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    $content .= "<div style='text-align:center; font-size: small;'><a href='http://www.nukescripts.net'><img src='".$block_image."' alt='".$lang_block['BLOCK_SENTINEL_SENTINEL_TITLE_IMG']."' title='".$lang_block['BLOCK_SENTINEL_SENTINEL_TITLE_IMG']."' /></a></div>\n";
    $content .= $blockcontent;
}
$content .= "</div>\n";

?>