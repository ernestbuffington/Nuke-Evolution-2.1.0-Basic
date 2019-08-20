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

global $db, $evoconfig, $ab_config;
$module_name = 'Nuke_Sentinel';

function block_Sentinel_cache($block_cachetime, $ab_config) {
    global $db, $cache;
    if ((($blockcache = $cache->load('sentinel', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query('SELECT `nbi`.`ip_addr`,`nb`.`reason` FROM `'._SENTINEL_BLOCKED_IPS_TABLE.'` AS `nbi`
                                Inner Join `'._SENTINEL_BLOCKERS_TABLE.'` AS `nb` ON `nb`.`blocker` = `nbi`.`reason` ORDER BY `nbi`.`date` DESC LIMIT 10');
        $a = 0;
        while (list($ip_addr, $reason) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['ip_addr'] = $ip_addr;
            $blockcache[$a]['reason']  = $reason;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('sentinel', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_Sentinel_cache($evoconfig['block_cachetime'], $ab_config);
$block_image  = evo_image('Sentinel_Small.png', 'nukesentinel');

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
        $ip_addr  = $blocksession[$a]['ip_addr'];
        $reason   = $blocksession[$a]['reason'];
        $lookupip = str_replace('*', 0, $ip_addr);
    if((is_admin() && $ab_config['display_link']==1) || ((is_user() || is_admin()) && $ab_config['display_link']==2) || $ab_config['display_link']==3) {
        $blockcontent .= "<div style='text-align: center;'><a href='".$ab_config['lookup_link'].$lookupip."' target='_blank'>".$ip_addr."</a><br />\n";
    } else {
        $blockcontent .= "<div style='text-align: center;'>".$ip_addr."<br />\n";
    }
    if((is_admin() && $ab_config['display_reason']==1) || ((is_user() || is_admin()) && $ab_config['display_reason']==2) || $ab_config['display_reason']==3) {
        $reason = str_replace('Abuse-','',$reason);
        $blockcontent .= "<strong><span style='font-size: x-small;'>".$reason."</span></strong></div>\n";
    } else {
        $blockcontent .= "</div>\n";
    }
}

$content = "<div style='text-align: center; width: 100%;'>\n";
$content .= "<div style='text-align:center; font-size: small;'><a href='http://www.nukescripts.net'><img src='".$block_image."' width='88px' alt='".$lang_block['BLOCK_SENTINEL_SENTINEL_TITLE_IMG']."' title='".$lang_block['BLOCK_SENTINEL_SENTINEL_TITLE_IMG']."' /></a></div><br />\n";
if (empty($blockcontent)) {
    $content .= $lang_block['BLOCK_NO_CONTENT']."\n";
} else {
    $content .= $blockcontent;
}
$content .= "</div>\n";

?>