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

global $db, $cache, $currentlang, $admin_file, $evoconfig;
$module_name = 'Supporters';


function block_SupportersRandom_configs(){
  global $db, $cache;
  if(isset($supporter_config)) return $supporter_config;
  if(($supporter_config = $cache->load('supporters', 'config')) === false) {
      $configresult = $db->sql_query("SELECT `config_name`, `config_value` FROM `"._NSNSP_CONFIG_TABLE."`");
      while(list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
        $supporter_config[$config_name] = $config_value;
      }
      $db->sql_freeresult($configresult);
      $cache->save('supporters', 'config', $supporter_config);
  }
  return $supporter_config;
}

$supportersconfig = $cache->load('supporters', 'config');
if ( empty($supportersconfig) ) {
    $supportersconfig = block_SupportersRandom_configs();
}

function block_SupportersRandom_cache($block_cachetime, $supportersconfig) {
    global $db, $cache;
    if ((($blockcache = $cache->load('supportersrandom', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $image_atts = array();
        $result = $db->sql_query("SELECT `site_id`, `site_name`, `site_url`, `site_image`, `image_type`, `site_date`, `site_description`, `site_hits` FROM `"._NSNSP_SITES_TABLE."` WHERE `site_status`>'0' ORDER BY RAND() LIMIT 0,5");
        $a = 0;
        while(list($site_id, $site_name, $site_url, $site_image, $image_type, $site_date, $site_description, $site_hits) = $db->sql_fetchrow($result)) {
            $a++;
            if ($image_type == 0) {
                if (evo_site_up($site_image)) {
                    list($width, $height, $type, $attr) = @getimagesize($site_image);
                    $img_type = $type;
                } else {
                    $width = $supportersconfig['max_width'];
                    $height = $supportersconfig['max_height'];
                    $attr = '';
                    $img_type = $image_type;
                }
            } else {
                list($width, $height, $type, $attr) = @getimagesize(NUKE_MODULES_DIR . $site_image);
            }
            if($width > $supportersconfig['max_width'] || ($width <= 0 ) ) {
                $width = (int)$supportersconfig['max_width'];
            }
            if($height > $supporter_config['max_height'] || ($height <= 0) ) {
                $height = (int)$supportersconfig['max_height'];
            }
            $site_date = formatTimestamp($site_date);
            $site_description = set_smilies(decode_bbcode(stripslashes($site_description), 1, true));
            $blockcache[$a]['imgattr'] = array('site_id' => $site_id, 'site_name' => $site_name, 'site_url' => $site_url, 'site_image' => $site_image, 'site_date' => $site_date, 'site_description' => $site_description,
                                                'site_hits' => $site_hits, 'width' => $width, 'height' => $height, 'attr' => $attr, 'img_type' => $image_type);
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('supportersrandom', 'blocks', $blockcache);
    }
    return $blockcache;
}

if (@file_exists(NUKE_MODULES_DIR.$module_name.'/language/lang-' . $currentlang . '.php')) {
    include(NUKE_MODULES_DIR.$module_name.'/language/lang-' . $currentlang . '.php');
} else {
    include(NUKE_MODULES_DIR.$module_name.'/language/lang-english.php');
}

$blocksession = block_SupportersRandom_cache($evoconfig['block_cachetime'], $supportersconfig);

$blockcontent = '';
$blockfoot    = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
    $site_id    = $blocksession[$a]['imgattr']['site_id'];
    $site_name  = $blocksession[$a]['imgattr']['site_name'];
    $site_url   = $blocksession[$a]['imgattr']['site_url'];
    $site_image = $blocksession[$a]['imgattr']['site_image'];
    $site_date  = $blocksession[$a]['imgattr']['site_date'];
    $site_description = $blocksession[$a]['imgattr']['site_description'];
    $site_hits  = $blocksession[$a]['imgattr']['site_hits'];
    $width      = $blocksession[$a]['imgattr']['width'];
    $height     = $blocksession[$a]['imgattr']['height'];
    $width      = ($width > $supportersconfig['max_width'] || $width == 0) ? $supportersconfig['max_width'] : $blocksession[$a]['imgattr']['width'];
    $height     = ($height > $supportersconfig['max_height'] || $height == 0) ? $supportersconfig['max_height'] : $blocksession[$a]['imgattr']['height'];
    $attr       = $blocksession[$a]['imgattr']['attr'];
    $image_type = $blocksession[$a]['imgattr']['img_type'];
    $blockcontent .= "<p style='margin-left: auto; margin-right: auto; text-align:center; width: 100%;'><a href='modules.php?name=$module_name&amp;op=SPGo&amp;site_id=".$site_id."'>\n";
    $blockcontent .= "<img src='".((intval($image_type) == 1) ? NUKE_MODULES_IMAGE_DIR.$site_image : $site_image)."' border='0' alt='' title='$site_name' height='".$height."px' width='".$width."px' /></a></p>\n";
}

if($supportersconfig['require_user'] == 0 || is_user()) {
    $blockfoot .= "[ <a href='modules.php?name=Supporters&amp;op=SPSubmit'>".$lang_new[$module_name]['SP_BESUPPORTER']."</a> ]<br />\n";
}
if(is_admin()) {
    $blockfoot .= "[ <a href='".$admin_file.".php?op=SPMain'>".$lang_new[$module_name]['SP_GOTOADMIN']."</a> ]<br />\n";
}
if (is_active($module_name)) {
    $blockfoot .= "[ <a href='modules.php?name=Supporters'>".$lang_new[$module_name]['SP_SUPPORTERS']."</a> ]\n";
}


$content = "<div style='width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<p style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</p>\n";
} else {
    $content .= "<p style='text-align: center;'>".$lang_new[$module_name]['SP_SUPPORTEDBY']."</p><br />";
    $content .= "<div style='width: 100%; height: 150px; text-align: left;'>\n";
    $content .= evo_marquee('block_SupportersRandom', '100%', '100%', $blockcontent, 'down', 1, '100%', '100%' , 0, 0);
    $content .= "</div><br /><hr noshade='noshade' />\n";
    $content .= "<p style='text-align: center;'>".$blockfoot."</p>\n";
}
$content .= "</div>\n";

?>