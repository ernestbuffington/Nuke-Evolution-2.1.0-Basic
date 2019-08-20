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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (!defined('IN_SUPPORTER_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN SUPPORTER ADMINISTRATION');
}

$pagetitle = ': '.$lang_new[$module_name]['SP_ADMINMAIN'].' - '.$lang_new[$module_name]['SP_ACTIVESITES'];
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . $lang_new[$module_name]['SP_ADMIN_HEADER'] . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SP_RETURNMAIN'] . "</a> ]</div>\n";
CloseTable();
echo "<br />";
title($lang_new[$module_name]['SP_ADMINMAIN'].' - '.$lang_new[$module_name]['SP_ACTIVESITES']);
spmenu();
echo "<br />\n";
OpenTable();
$a = 0;
$result = $db->sql_query("SELECT * FROM `"._NSNSP_SITES_TABLE."` WHERE `site_status`='1' ORDER BY `site_name`");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
    echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
    while($site_row = $db->sql_fetchrow($result)) {
        if($a == 0) {
            echo "<tr>";
        }
        echo "<td width='50%' valign='top'>";
        OpenTable();
        if ($site_row['image_type'] == 1) {
            list($width, $height, $type, $attr) = @getimagesize(NUKE_MODULES_DIR . '/' . $site_row['site_image']);
        } 
        if($width > $supporter_config['max_width'] || $site_row['image_Type'] == 0) { 
            $width = $supporter_config['max_width']; 
        }
        if($height > $supporter_config['max_height'] || $site_row['image_Type'] == 0) { 
            $height = $supporter_config['max_height']; 
        }
        $cdate2 = formatTimestamp($site_row['site_date']);
        $cdescription = set_smilies(decode_bbcode(stripslashes($site_row['site_description']), 1, true));
        echo "<table border='0' width='100%'>";
        echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";
        echo "<a href='modules.php?name=$module_name&amp;op=SPGo&amp;site_id=".$site_row['site_id']."' target='_blank'><img src='".(($site_row['image_type'] == 1) ? NUKE_MODULES_IMAGE_DIR.$site_row['site_image'] : $site_row['site_image'])."' border='0' alt='' title='".$site_row['site_name']."' height='".$height."px' width='".$width."px' /></a><br /><br />";
        echo "</td>\n<td width='75%' valign='top'><strong>".$lang_new[$module_name]['SP_ADDED'].":</strong> ".$cdate2."</td></tr>";
        echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_DESCRIPTION']."</strong>: ".$cdescription."</td></tr>";
        echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_VISITS']."</strong>: ".$site_row['site_hits']."</td></tr>";
        echo "<tr><td align='center' valign='top'>";
        echo " <a href='".$admin_file.".php?op=SPDeactivate&amp;site_id=".$site_row['site_id']."&amp;comefrom=SPActive'><img src='".evo_image('deactivate.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['SP_DEACTIVATE']."' title='".$lang_new[$module_name]['SP_DEACTIVATE']."' /></a>";
        echo " <a href='".$admin_file.".php?op=SPEdit&amp;site_id=".$site_row['site_id']."&amp;comefrom=SPActive'><img src='".evo_image('edit.png', $module_name)."' width='16' height='16' border='0' alt='"._EDIT."' title='"._EDIT."' /></a>";
        echo " <a href='".$admin_file.".php?op=SPDelete&amp;site_id=".$site_row['site_id']."&amp;comefrom=SPActive'><img src='".evo_image('delete.png', $module_name)."' width='16' height='16' border='0' alt='"._DELETE."' title='"._DELETE."' /></a>";
        echo "</td></tr>";
        echo "</table>";
        CloseTable();
        echo "</td>";
        $a++;
        if($a == 2) {
            echo "</tr>";
            $a = 0;
        }
    }
    if($a == 1) {
        echo "<td width='50%'>&nbsp;</td></tr></table>";
    } else {
        echo "</tr></table>";
    }
} else {
    echo "<center class='title'>".$lang_new[$module_name]['SP_NOACTIVESITES']."</center>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>