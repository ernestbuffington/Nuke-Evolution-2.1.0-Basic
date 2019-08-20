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

if (!defined('IN_LINKUS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN LINK_US ADMINISTRATION');
}

LinkusAdminMain();
OpenTable();

$num = 0;
$result = $db->sql_query("SELECT `id`, `site_name`, `site_image`, `site_description`, `site_hits`, `date_added` FROM `"._LINKUS_TABLE."` WHERE `site_status` = '1' AND `button_type` = '1'");
$numrows = $db->sql_numrows($result);
$config = $db->sql_ufetchrow("SELECT * FROM "._LINKUS_CONFIG_TABLE." LIMIT 0,1");

if($numrows == 0){
    echo "<center><span style='color:red; font-size:medium;'>".$lang_new[$module_name]['NO_ACTIVE_SITES']."</span></center>";
} else {
    if ($numrows > 0) {
        echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
        echo "<tr><th width='100%'>".$lang_new[$module_name]['STANDARD_BUTTONS']."</th></tr>";
        echo "</table>";
        echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
        while(list($id, $site_name, $site_image, $site_description, $site_hits, $date_added) = $db->sql_fetchrow($result)) {
            if ($num == 0) { echo "<tr>"; }
            echo "<td width='50%' valign='top'>";
            LinkusTableOpen();
            echo "<table border='0' width='100%'>";
            echo "<tr><td width='25%' align='center' rowspan='3'>";
            echo "<img src='".$site_image."' width='".$config['button_width']."' height='".$config['button_height']."' border='0' align='middle' alt='' />";
            echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&amp;id=".$id."'><img src='".evo_image('edit.png', '')."' border='0' alt='".$lang_new[$module_name]['EDIT']."' title='".$lang_new[$module_name]['EDIT']."' /></a>";
            echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$id."'><img src='".evo_image('delete.png', '')."' border='0' alt='".$lang_new[$module_name]['DELETE']."' title='".$lang_new[$module_name]['DELETE']."' /></a>";
            echo "</td>";
            echo "<td width='75%' valign='top'>";
            echo "<table border='0' width='100%'>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['SITE_NAME'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_name), 1, true))."</td></tr>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['ADDED'].":</strong></td><td>".formatTimestamp($date_added)."</td></tr>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['VISITS'].":</strong></td><td>".$site_hits."</td></tr>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['DESCRIPTION'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_description), 1, true))."</td></tr>";
            echo "</table></td>";
            echo "</tr></table>";
            LinkusTableClose();
            echo "</td>";
            $num++;
            if ($num == 1) { echo "</tr>"; $num = 0; }
        }
        if ($num ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
    }
}
$db->sql_freeresult($result);

$num = 0;
$result = $db->sql_query("SELECT `id`, `site_name`, `site_image`, `site_description`, `site_hits`, `date_added` FROM `"._LINKUS_TABLE."` WHERE `site_status` = '1' AND `button_type` = '2'");
$numrows = $db->sql_numrows($result);

if ($numrows > 0) {
    echo "<br /><br />";
    echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
    echo "<tr><th width='100%'>".$lang_new[$module_name]['BANNER_BUTTONS']."</th></tr>";
    echo "</table>";
    echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
    while(list($id, $site_name, $site_image, $site_description, $site_hits,$date_added) = $db->sql_fetchrow($result)) {
        if ($num == 0) { echo "<tr>"; }
        echo "<td width='50%' valign='top'>";
        LinkusTableOpen();
        echo "<table border='0' width='100%'>";
        echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";
        echo "<img src='".$site_image."' width='".$config['button_banner_width']."' height='".$config['button_banner_height']."' border='0' />";
        echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&amp;id=".$id."'><img src='".evo_image('edit.png', '')."' border='0' alt='".$lang_new[$module_name]['EDIT']."' title='".$lang_new[$module_name]['EDIT']."' /></a>";
        echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$id."'><img src='".evo_image('delete.png', '')."' border='0' alt='".$lang_new[$module_name]['DELETE']."' title='".$lang_new[$module_name]['DELETE']."' /></a>";
        echo "</td><td width='75%' valign='top'>";
        echo "<table border='0' width='100%'>";
        echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['SITE_NAME'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_name), 1, true))."</td></tr>";
        echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['ADDED'].":</strong></td><td>".formatTimestamp($date_added)."</td></tr>";
        echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['VISITS'].":</strong></td><td>".$site_hits."</td></tr>";
        echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['DESCRIPTION'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_description), 1, true))."</td></tr>";
        echo "</table></td>";
        echo "</tr></table>";
        LinkusTableClose();
        echo "</td>";
        $num++;
        if ($num == 1) { echo "</tr>"; $num = 0; }
    }
    if ($num ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
}
$db->sql_freeresult($result);

$num = 0;
$result = $db->sql_query("SELECT `id`, `site_name`, `site_image`, `site_description`, `site_hits`, `date_added` FROM `"._LINKUS_TABLE."` WHERE `site_status` = '1' AND `button_type` = '3'");
$numrows = $db->sql_numrows($result);

if ($numrows > 0) {
    echo "<br /><br />";
    echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
    echo "<tr><th width='100%'>".$lang_new[$module_name]['RESOURCES']."</th></tr>";
    echo "</table>";
    echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
    while(list($id, $site_name, $site_image, $site_description, $site_hits, $date_added) = $db->sql_fetchrow($result)) {
        if ($num == 0) { echo "<tr>"; }
        echo "<td width='25%' valign='top'>";
        LinkusTableOpen();
        echo "<table border='0' width='100%'>";
        echo "<tr><td width='25%' align='center'>";
        echo "<img src='".$site_image."' width='".$config['button_ressource_width']."' height='".$config['button_ressource_height']."' border='0' align='middle' alt='' />";
        echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&amp;id=".$id."'><img src='".evo_image('edit.png', '')."' border='0' alt='".$lang_new[$module_name]['EDIT']."' title='".$lang_new[$module_name]['EDIT']."' /></a>";
        echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$id."'><img src='".evo_image('delete.png', '')."' border='0' alt='".$lang_new[$module_name]['DELETE']."' title='".$lang_new[$module_name]['DELETE']."' /></a>";
        echo "</td>";
        echo "<td width='75%' valign='top'>";
        echo "<table border='0' width='100%'>";
        echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['SITE_NAME'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_name), 1, true))."</td></tr>";
        echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['ADDED'].":</strong></td><td>".formatTimestamp($date_added)."</td></tr>";
        echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['VISITS'].":</strong></td><td>".$site_hits."</td></tr>";
        echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['DESCRIPTION'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_description),1, true))."</td></tr>";
        echo "</table></td>";
        echo "</tr></table>";
        LinkusTableClose();
        echo "</td>";
        $num++;
        if ($num == 4) { echo "</tr>"; $num = 0; }
    }
    if ($num == 1) { echo "<td width='25%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
}
$db->sql_freeresult($result);

CloseTable();

?>