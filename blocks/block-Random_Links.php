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
$module_name = 'Web_Links';
$line_br = '';

function Block_RandomWebLinksConfig() {
  global $db, $module_name, $cache, $lang_block;
  static $weblinksconfig;
    if(isset($weblinksconfig) && is_array($weblinksconfig)) { return $weblinksconfig; }
    if ((($weblinksconfig = $cache->load('WebLinks', 'config')) === false) || empty($weblinksconfig)) {
        $sql = 'SELECT `config_value`, `config_name` from `'._WEBLINKS_CONFIG_TABLE.'`' ;
        if(!$result = $db->sql_query($sql)) {
            DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $lang_block['BLOCK_NO_CONFIG'] . $module_name);
        }
        while ($row = $db->sql_fetchrow($result)) {
            $weblinksconfig[$row['config_name']] = $row['config_value'];
        }
        $cache->save('WebLinks', 'config', $weblinksconfig);
        $db->sql_freeresult($result);
    }
    return $weblinksconfig;
}

$webblocklinksconfig = $cache->load('WebLinks', 'config');
if ( empty($webblocklinksconfig) ) {
    $webblocklinksconfig = Block_RandomWebLinksConfig();
}

function block_randomlinks_cache($block_cachetime, $webblocklinksconfig) {
    global $db, $cache;
    if ((($blockcache = $cache->load('random', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query("SELECT `lid`, `title`, `image`, `url` FROM `"._WEBLINKS_LINKS_TABLE."` ORDER BY RAND() LIMIT 0,".$webblocklinksconfig['block_rows']);
        $a = 0;
        while (list($lid, $title,$image, $url) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['lid']   = $lid;
            $blockcache[$a]['title'] = $title;
            $blockcache[$a]['image'] = $image;
            $blockcache[$a]['url']   = $url;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('random', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_randomlinks_cache($evoconfig['block_cachetime'], $webblocklinksconfig);
for($i = 0; $i < $webblocklinksconfig['block_line_breaks']; $i++){
    $line_br.="<br />";
}

$blockcontent = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
    $title  = stripslashes(check_html($blocksession[$a]['title'], "nohtml"));
    $url    = stripslashes($blocksession[$a]['url']);
    $lid    = intval($blocksession[$a]['lid']);
    $url    = stripslashes($blocksession[$a]['image']);
    $blockcontent .= "<p style='margin-left: auto; margin-right: auto; text-align:center; width: 100%;'>";
    $blockcontent .= "<a href=\"modules.php?name=".$module_name."&amp;op=visit&amp;lid=$lid\" target=\"_blank\"></a>";
    if($url != 'http://' && !empty($url) ){
        $blockcontent .= "<a href=\"modules.php?name=$module_name&amp;op=linkvisit&amp;lid=$lid\" target=\"_blank\" ><img src=\"$url\"  width=\"".$webblocklinksconfig['block_image_width']."\" height=\"".$webblocklinksconfig['block_image_height']."\" border=\"0\" title=\"".$lang_block['BLOCK_WEBLINKS_FULL_VIEW']."\"  valign=\"absmiddle\" alt=\"\" /></a>";
    }elseif ( $webblocklinksconfig['thumbnail_use'] && !empty($webblocklinksconfig['thumbnail_url']) ) {
        $blockcontent .= "<a href=\"modules.php?name=$module_name&amp;op=linkvisit&amp;lid=$lid\" target=\"_blank\" ><img src=\"".htmlentities($webblocklinksconfig['thumbnail_url'].$url, ENT_NOQUOTES)."\" width=\"".$webblocklinksconfig['block_image_width']."\" height=\"".$webblocklinksconfig['block_image_height']."\"  border=\"0\" title=\"".$lang_block['BLOCK_WEBLINKS_FULL_VIEW']."\" alt=\"\" /></a>";
    }else{
        $blockcontent .= "<a href=\"modules.php?name=$module_name&amp;op=linkvisit&amp;lid=$lid\" target=\"_blank\"><img src=\"".evo_image('blank.gif', $module_name)."\" width=\"".$webblocklinksconfig['block_image_width']."\" height=\"".$webblocklinksconfig['block_image_height']."\"  border=\"0\" title=\"".$lang_block['BLOCK_WEBLINKS_VISIT']."\" alt=\"\" /></a>";
    }
    $blockcontent .= "</p>\n";
    $blockcontent .= $line_br;
}

if( $webblocklinksconfig['block_scroll_direction'] == '1') {
       $direction = 'up'; // $direction 0=down 1=up
}else{
       $direction = 'down';
}

$content = "<div style='height: ".$webblocklinksconfig['block_height']."px; width:100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<p style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</p>\n";
} else {
    if ( $webblocklinksconfig['block_scroll'] == '1') {
        $content .= "<div style='width: 100%; height: 150px; text-align: left;'>\n";
        $content .= evo_marquee('block_RandomLinks', '100%', '100%', $blockcontent, $direction, $webblocklinksconfig['block_scroll_amount'], '100%', '100%' , 0, 0);
        $content .= "</div>\n";
    } else {
        $content .= $blockcontent;
    }
}
$content .= "</div>\n";
?>