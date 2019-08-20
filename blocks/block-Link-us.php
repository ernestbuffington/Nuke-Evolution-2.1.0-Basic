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

global $db, $cache, $evoconfig, $bgcolor2;

function Block_Linkus_config() {
  global $db, $cache;
  static $linkusconfig;
    if(isset($linkusconfig) && is_array($linkusconfig)) { return $linkusconfig; }
    if ((($linkusconfig = $cache->load('LinkUs', 'config')) === false) || empty($linkusconfig)) {
        $linkusconfig = $db->sql_ufetchrow('SELECT * from `'._LINKUS_CONFIG_TABLE.'` limit 0,1', SQL_ASSOC);
        $linkusconfig = str_replace('\\"', '"', $linkusconfig);
        $cache->save('LinkUs', 'config', $linkusconfig);
    }
    return $linkusconfig;
}

$linkusblockconfig = $cache->load('LinkUs', 'config');
if ( empty($linkusblockconfig) ) {
    $linkusblockconfig = Block_Linkus_config();
}

function block_linkus_cache($block_cachetime, $linkusblockconfig) {
    global $db, $cache;
    if ((($blockcache = $cache->load('linkus', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query("SELECT `id`, `site_name`, `site_url`, `site_image`, `site_hits`, `button_type` FROM "._LINKUS_TABLE." WHERE `site_status` = '1' AND `button_type`='1' OR `button_type`='3' ORDER BY `id` DESC");
        $a = 1;
        while (list($id, $site_name, $site_url, $site_image, $site_hits, $button_type) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['id']           = $id;
            $blockcache[$a]['site_name']    = $site_name;
            $blockcache[$a]['site_url']     = $site_url;
            $blockcache[$a]['site_image']   = $site_image;
            $blockcache[$a]['site_hits']    = $site_hits;
            $blockcache[$a]['button_type']  = $button_type;
        }
        $db->sql_freeresult($result);
        switch ($linkusblockconfig['marquee_direction']) {
            case (1): $direction = 'up'; break;
            case (2): $direction = 'down'; break;
            case (3): $direction = 'left'; break;
            case (4): $direction = 'right'; break;
            default : $direction = 'up'; break;
        }
        switch ($linkusblockconfig['button_seperate']) {
            case (0): $seperation = ''; break;
            case (1): $seperation = "<hr noshade='noshade' size='5' />"; break;
            case (2): $seperation = "-------------------"; break;
            default : $seperation = ''; break;
        }
        switch ($linkusblockconfig['block_height']) {
            case (1): $height = "100"; break;
            case (2): $height = "150"; break;
            case (3): $height = "200"; break;
            case (4): $height = "250"; break;
            case (5): $height = "300"; break;
            default : $height = "150"; break;
        }
        $scroll_speed = ($linkusblockconfig['marquee_scroll'] == 1) ? 3 : 2;
        $blockcache[1]['marq_direction'] = $direction;
        $blockcache[1]['separation']     = $seperation;
        $blockcache[1]['block_height']   = $height;
        $blockcache[1]['scroll_speed']   = $scroll_speed;
        $blockcache[0]['stat_created'] = time();
        $cache->save('linkus', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_linkus_cache($evoconfig['block_cachetime'], $linkusblockconfig);

$my_image = '<img src="'.EVO_SERVER_URL.'/'.$linkusblockconfig['my_image'].'" alt="'.EVO_SERVER_SITENAME.'" title="'.EVO_SERVER_SITENAME.'" width="88" height="31" />';
$linkus_settings = '<a href="'.EVO_SERVER_URL.'" target="_blank">'.$my_image.'</a>';
$buttoncontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
    if ($a == 1) {
        $height       = intval($blocksession[$a]['block_height']);
        $separation   = $blocksession[$a]['separation'];
        $direction    = $blocksession[$a]['marq_direction'];
        $scroll_speed = intval($blocksession[$a]['scroll_speed']);
        continue;
    }
    $id          = intval($blocksession[$a]['id']);
    $button_type = intval($blocksession[$a]['button_type']);
    $site_name   = $blocksession[$a]['site_name'];
    $url         = $blocksession[$a]['site_url'];
    $site_image  = $blocksession[$a]['site_image'];
    $site_hits   = $blocksession[$a]['site_hits'];
    if ( $button_type == 1) {
        $img_width  = $linkusblockconfig['button_width'];
        $img_height = $linkusblockconfig['button_height'];
    } else {
        $img_width  = $linkusblockconfig['button_ressource_width'];
        $img_height = $linkusblockconfig['button_ressource_height'];
    }

    if($linkusblockconfig['show_clicks'] == 1){
        $clicks = "(".$lang_block['BLOCK_LINKUS_CLICKS'].":&nbsp;".$site_hits.")";
    } else {
        $clicks = '';
    }
    $buttoncontent .= "<div style='text-align: center;'><p style='text-align:center;'><a href='modules.php?name=Link_Us&amp;op=visit&amp;id=".$id."' target='_blank'><img src='".$site_image."' width='".$img_width."px' height='".$img_height."px' border='0' title='".$site_name."' alt='' /></a></p>\n";
    $buttoncontent .= "<span style='font-size: x-small;'>".$clicks."</span><br />\n";
    $buttoncontent .= "<span>".$seperation."</span></div><br />\n";
}

$content = "<div style='width: 100%; text-align: center;'>\n";
$content .= "<span style='text-align: center;'>".$my_image."</span><br /><br />\n";
$content .= "<textarea id='Block_Link_us' name='Block_Link_us' rows='10' cols='21' readonly='readonly' style='text-align:center; font-size: xx-small; border-style: groove;'>".htmlspecialchars($linkus_settings)."</textarea><br />\n";
if (!empty($buttoncontent)) {
    $content .= "<p style='text-align: center;'><a href='modules.php?name=Link_Us'>".$lang_block['BLOCK_LINKUS_VIEW_ALL_BUTTONS']."</a></p>\n";
    $content .= "<hr noshade='noshade' align='center' />\n";
    $content .= "<div style='width: 100%; height: ".$height."px; text-align: center;'>\n";
    if($linkusblockconfig['marquee'] == 1){
        $content .= evo_marquee('block_Link_us', '100%', '100%', $buttoncontent, $direction, $amount, '100%', '100%' , 1, 0);
    } else {
        $content .= $buttoncontent;
    }
    $content .= "</div>\n";
}
$content .= "<p style='text-align:right; font-size: xx-small;'>&copy;&nbsp;<a href='http://www.darkforgegfx.com' title='DarkForge GFX' target='_blank'>DarkForgeGFX</a></p>\n";
$content .= "</div>\n";

?>