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

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$pagetitle = $lang_new[$module_name]['SP_SUPPORTERS'];
include_once(NUKE_BASE_DIR.'header.php');
global $module_name, $admin_file, $supporter_config;

$counter    = 0;
$title_text = "<center>";
if(is_mod_admin($module_name)) {
    $title_text .= "[ <a href='".$admin_file.".php?op=SPMain'>".$lang_new[$module_name]['SP_GOTOADMIN']."</a> ]\n";
}
if($supporter_config['require_user'] == 0 || is_user()) {
    $title_text .= "[ <a href='modules.php?name=$module_name&amp;op=SPSubmit'>".$lang_new[$module_name]['SP_BESUPPORTER']."</a> ]\n";
}
$title_text .= "</center>";
title($title_text, $module_name, 'supporter-logo.png');

echo "<br />";
OpenTable();
$a = 0;
$result = $db->sql_query("SELECT `site_id`, `site_name`, `site_url`, `site_image`, `image_type`, `site_date`, `site_description`, `site_hits` FROM `"._NSNSP_SITES_TABLE."` WHERE `site_status`='1' ORDER BY `site_name`");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
    $image_atts = array();
    while(list($site_id, $site_name, $site_url, $site_image, $image_type, $site_date, $site_description, $site_hits) = $db->sql_fetchrow($result)) {
        $counter++;
        $width = 0;
        $height = 0;
        $type = '';
        $attr = '';
        if ((int)$image_type == 0) {
            if (evo_site_up($site_image)) {
                list($width, $height, $type, $attr) = @getimagesize($site_image);
            } else {
                $width  = $supporter_config['max_width'];
                $height = $supporter_config['max_height'];
                $type = '';
                $attr = '';
            }
            $image_type = 0;
        } else {
           list($width, $height, $type, $attr) = @getimagesize(NUKE_MODULES_DIR . $site_image);
            $image_type = 1;
        }
        if($width > $supporter_config['max_width'] || ($width <= 0 ) ) { 
            $width = (int)$supporter_config['max_width']; 
        }
        if($height > $supporter_config['max_height'] || ($height <= 0) ) { 
            $height = (int)$supporter_config['max_height']; 
        }
        $site_date = formatTimestamp($site_date);
        $site_description = set_smilies(decode_bbcode(stripslashes($site_description), 1, true));
        $image_atts[] = array('site_id' => $site_id, 'site_name' => $site_name, 'site_url' => $site_url, 'site_image' => $site_image, 'site_date' => $site_date, 'site_description' => $site_description,
                              'site_hits' => $site_hits, 'width' => $width, 'height' => $height, 'type' => $type, 'attr' => $attr, 'img_type' => $image_type);
    }
    $db->sql_freeresult($result);
    echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
    for ($i=0, $max=count($image_atts); $i < $max; $i++) {
        if($a == 0) { echo "<tr>"; }
        echo "<td width='50%' valign='top'>";
        OpenTable();
        echo "<table border='0' width='100%' cellpadding='0' cellspacing='0' width='100%'>";
        echo "<tr><td width='30%' align='center' valign='middle'>";
        $site_id    = $image_atts[$i]['site_id'];
        $site_name  = $image_atts[$i]['site_name'];
        $site_url   = $image_atts[$i]['site_url'];
        $site_image = $image_atts[$i]['site_image'];
        $site_date  = $image_atts[$i]['site_date'];
        $site_description = $image_atts[$i]['site_description'];
        $site_hits  = $image_atts[$i]['site_hits'];
        $width      = (int)$image_atts[$i]['width'];
        $height     = (int)$image_atts[$i]['height'];
        $type       = $image_atts[$i]['type'];
        $attr       = $image_atts[$i]['attr'];
        $image_type = (int)$image_atts[$i]['img_type'];
        echo "<a href='modules.php?name=$module_name&amp;op=SPGo&amp;site_id=$site_id' target='_blank'><img src='".(($image_type == 1) ? NUKE_MODULES_IMAGE_DIR.$site_image : $site_image)."' border='0' alt='' title='$site_name' height='".$height."px' width='".$width."px' /></a>";
        echo "</td><td width='70%' align='center' valign='middle'>";
        if(is_mod_admin($module_name)) {
            global $admin_file;
            echo " <a href='".$admin_file.".php?op=SPDeactivate&amp;site_id=$site_id'><img src='".evo_image('deactivate.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['SP_DEACTIVATE']."' title='".$lang_new[$module_name]['SP_DEACTIVATE']."' /></a>";
            echo " <a href='".$admin_file.".php?op=SPEdit&amp;site_id=$site_id'><img src='".evo_image('edit.png', $module_name)."' border='0' alt='"._EDIT."' title='"._EDIT."' /></a>";
            echo " <a href='".$admin_file.".php?op=SPDelete&amp;site_id=$site_id'><img src='".evo_image('delete.png', $module_name)."' border='0' alt='"._DELETE."' title='"._DELETE."' /></a>";
        }
        echo "</td>\n";
        echo "<tr><td valign='top' colspan='2'><br /><span style='font-weight: bold;'>".$lang_new[$module_name]['SP_ADDED'].":</span>&nbsp;$site_date</td></tr>";
        echo "<tr><td valign='top' colspan='2'><span style='font-weight: bold;'>".$lang_new[$module_name]['SP_VISITS'].":</span>&nbsp;$site_hits</td></tr>";
        echo "<tr><td valign='top' colspan='2'><span style='font-weight: bold;'>".$lang_new[$module_name]['SP_DESCRIPTION'].":</span>&nbsp;$site_description</td></tr>";
        echo "</table>";
        CloseTable();
        echo "</td>";
        $a++;
        if($a == 2) {
            echo "</tr>";
            $a = 0;
        }
    }
    if($a ==1) {
        echo "<td width='50%'>&nbsp;</td></tr></table>";
    } else {
        echo "</tr></table>";
    }
} else {
        echo "<br /><br /><center>". $lang_new[$module_name]['SP_NOACTIVESITES'] ."</center><br /><br />\n";
        echo "<center>" . _GOBACK . "</center>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>