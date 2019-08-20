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

if (defined('ADMIN_FILE')) {
    global $evouserinfo_mostever, $db, $cache, $evoconfig, $lang_evo_userblock;
}

function block_Evo_UserInfo_mostonline_cache($block_cachetime) {
    global $db, $cache, $addon_name;
    if ((($blockcache = $cache->load('mostonline', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $mostonline      = $db->sql_ufetchrow('SELECT `members`, `guests`, `bots`, `total`, `year`, `month`, `date` 
                                FROM `'._STATS_HOUR_TABLE.'` 
                                GROUP BY `total`
                                ORDER BY total DESC
                                LIMIT 0, 1');
        $blockcache[1]['total']   = $mostonline['total'];
        $blockcache[1]['members'] = $mostonline['members'];
        $blockcache[1]['guests']  = $mostonline['guests'];
        $blockcache[1]['bots']    = $mostonline['bots'];
        $blockcache{1}['date']    = $mostonline['year'].'-'.$mostonline['month'].'-'.$mostonline['date'].' 0:0:0';
        $blockcache[0]['stat_created'] = time();
        $cache->save('mostonline', 'blocks', $blockcache);
    }
    return $blockcache;
}

$mostever_blocksession = block_Evo_UserInfo_mostonline_cache($evoconfig['block_cachetime']);

$evouserinfo_mostever .= "<a href=\"modules.php?name=Statistics\" title=\"".$lang_evo_userblock['BLOCK']['MOST']['STATS']."\"><img src=\"".evo_image('stats.png', 'evo_userinfo')."\" alt=\"\" border=\"0\" /></a>\n";
$evouserinfo_mostever .= "<span style=\"text-decoration:underline; font-weight: bold;\">".$lang_evo_userblock['BLOCK']['MOST']['MOST'].$lang_evo_userblock['BLOCK']['BREAK']."</span>".evouserinfo_expand_collapse_start('mostever')."<br />\n";
$evouserinfo_mostever .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['BOTS'].$lang_evo_userblock['BLOCK']['ONLINE']['BREAK']."&nbsp;".number_format($mostever_blocksession[1]['bots'])."<br />\n";
$evouserinfo_mostever .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['GUESTS'].$lang_evo_userblock['BLOCK']['ONLINE']['BREAK']."&nbsp;".number_format($mostever_blocksession[1]['guests'])."<br />\n";
$evouserinfo_mostever .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['MEMBERS'].$lang_evo_userblock['BLOCK']['ONLINE']['BREAK']."&nbsp;".number_format($mostever_blocksession[1]['members'])."<br />\n";
$evouserinfo_mostever .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['TOTAL'].$lang_evo_userblock['BLOCK']['ONLINE']['BREAK']."&nbsp;".number_format($mostever_blocksession[1]['total'])."<br />\n";
$evouserinfo_mostever .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['DATE'].$lang_evo_userblock['BLOCK']['ONLINE']['BREAK']."&nbsp;".formatTimestamp($mostever_blocksession[1]['date'], '', TRUE).evouserinfo_expand_collapse_end()."\n";

?>