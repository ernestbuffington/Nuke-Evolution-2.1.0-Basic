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

global $db, $evoconfig, $admin_file;

$ref = 15;           // Set to the number of referers which should be shown in the block
$scroll = 1;         // Set to 1 if scrolling should be enabled;
$direction = 'up'; // Direction for scrolling 'up' OR 'down' - for right or left the bock isn't designed.

function block_LastReferers_cache($block_cachetime, $ref) {
    global $db, $cache;
    if ((($blockcache = $cache->load('lastreferers', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query('SELECT `url`, `lasttime` total  FROM `'._REFERER_TABLE.'` GROUP BY `url` ORDER BY `lasttime` DESC LIMIT 0,'.$ref);
        $a = 0;
        while (list($url, $lasttime) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['url']      = $url;
            $blockcache[$a]['lasttime'] = $lasttime;
        }
        $db->sql_freeresult($result);
        $result2 = $db->sql_ufetchrow('SELECT COUNT(`url`) AS total FROM `'._REFERER_TABLE.'`');
        $db->sql_freeresult($result);
        $blockcache[$a]['total'] = $result2['total'];
        $blockcache[0]['stat_created']  = time();
        $cache->save('lastreferers', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_LastReferers_cache($evoconfig['block_cachetime'], $ref);

$blockcontent = '';
$admincontent = '';
$total        = 0;
$count_blocksession = count($blocksession);
for ($a = 1, $max = $count_blocksession; $a < $max; $a++) {
    $url      = $blocksession[$a]['url'];
    $url      = str_replace("&", "&amp;", $url);
    $url2     = str_replace('http://', '', $blocksession[$a]['url']);
    $url2     = str_replace('_', ' ', $url2);
    $lasttime = $blocksession[$a]['lasttime'];
    $total    = (isset($blocksession[$a]['total']) ? $blocksession[$a]['total'] : 0);

    if (strlen($url2) > 18) {
        $url2 = substr($url2, 0, 18);
        $url2 .= '..';
    }

    $blockcontent .= "<span style='text-align:left; font-size: x-small;'><a href='".$url."' target='_blank'>".$url2."</a></span><br />\n";
}

if (is_admin()) {
    $admincontent .= "<p style='text-align:center; font-size: x-small;'>".$lang_block['BLOCK_SENTINEL_REFERERS_TOTAL'].":&nbsp;".$total."&nbsp;".$lang_block['BLOCK_SENTINEL_HTTPREFERERS']."<br />\n";
    $admincontent .= "[<a href=\"".$admin_file.".php?op=hreferer&amp;del=all\">".$lang_block['BLOCK_SENTINEL_REFERERS_DELETE']."</a>]</p>\n";
}


$content = "<div style='width: 100%;'>\n";
if ( empty($blockcontent) ) {
    $content .= "<div style='text-align:center;font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    if ($scroll == 1) {
        $content .= "<div style='width: 100%; height: 80px; text-align: left;'>\n";
        $content .= evo_marquee('block_Last_Referers', '100%', '100%', $blockcontent, $direction, 1, '100%', '100%' , 1, 0);
        $content .= "</div><hr noshade='noshade' />\n";
        $content .= $admincontent;
    } else {
        $content .= $blockcontent."<hr noshade='noshade' />\n";
        $content .= $admincontent;
    }
}
$content .= "</div>\n";

?>