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

if (!defined('IN_DOWNLOADS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN DOWNLOADS ADMINISTRATION');
}

$pagemodulname = 'DownloadsGroupList';

DownloadsHeader();

OpenTable();
$perpage = $downloadsconfig['downloads_perpage'];
if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$perpage;

$totalselected = $db->sql_numrows($db->sql_query("SELECT `group_id` FROM `".GROUPS_TABLE."` WHERE `group_single_user` = '0'"));
downloadspagenums_admin($op, $totalselected, $perpage, $max);
if ($totalselected > 0) {
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_GROUP_LIST'] . "</strong></span></center><br /><br />\n";
    echo "<table width=\"100%\" border=\"0\">\n";
    $result11 = $db->sql_query("SELECT `group_id`, `group_name`  FROM `".GROUPS_TABLE."` WHERE `group_single_user`= '0' LIMIT $min, $perpage");
    echo "<tr bgcolor='".$ThemeInfo['bgcolor2']."'>\n<td width=\"70%\"><strong>".$lang_new[$module_name]['ADMIN_GROUPS']."</strong></td>\n";
    echo "<td align=\"center\" width=\"30%\"><strong>".$lang_new[$module_name]['ADMIN_GROUP_FUNCTION']."</strong></td>\n</tr>\n</table>\n";
    $x = 0;
    while($row11 = $db->sql_fetchrow($result11)) {
        $groupexists = $db->sql_fetchrow($db->sql_query("SELECT `group_id`, `group_active` FROM `"._DOWNLOADS_GROUPS_TABLE."` WHERE `group_id`= '".$row11['group_id']."'"));
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectmodifygroup_$x\">";
        echo "<table width=\"100%\" border=\"0\">\n";
        echo "<tr><td width='70%'>";
        echo "<input type=\"hidden\" name=\"min\" value=\"$min\" />\n";
        echo "<input type='hidden' name='groupid' value='".$row11['group_id']."' />\n";
        $groupname = stripslashes($row11['group_name']);
        if ($groupexists['group_active'] == 1) {
            $active_img = evo_image_make_tag('ok.png', 'evo', $lang_new[$module_name]['ADMIN_DOWNLOAD_ENABLED'], 0, $lang_new[$module_name]['ADMIN_DOWNLOAD_ENABLED'], FALSE, '12px', '12px');
        } else {
            $active_img = evo_image_make_tag('bad.png', 'evo', $lang_new[$module_name]['ADMIN_DOWNLOAD_DISABLED'], 0, $lang_new[$module_name]['ADMIN_DOWNLOAD_DISABLED'], FALSE, '12px', '12px');
        }
        echo $active_img.'&nbsp;';
        echo $groupname."</td>\n";
        echo "<td align='center' width='30%'><select name='op'>";
        if ( !empty($groupexists)) {
            echo "<option value='DownloadsGroupDel'>".$lang_new[$module_name]['DELETE']."</option>\n";
            echo "<option value='DownloadsGroupMod' selected='selected'>".$lang_new[$module_name]['MODIFY']."</option>\n";
            if ($groupexists['group_active'] == 1) {
                echo "<option value='DownloadsGroupDeactivate'>".$lang_new[$module_name]['ADMIN_DEACTIVATE_GROUP']."</option>\n";
            } else {
                echo "<option value='DownloadsGroupActivate'>".$lang_new[$module_name]['ADMIN_ACTIVATE_GROUP']."</option>\n";
            }
        } else {
            echo "<option value='DownloadsGroupAdd' selected='selected'>".$lang_new[$module_name]['ADD']."</option>\n";
        }
        echo "</select>\n<input type=\"submit\" value=\"" . $lang_new[$module_name]['OK'] . "\" /></td></tr>\n";
        echo "</table>\n";
        echo "</form>\n";
        $x++;
    }
    $db->sql_freeresult($result11);
    echo "<br />";
    downloadspagenums_admin($op, $totalselected, $perpage, $max);
} else {
    echo "<br /><br /><center>". $lang_new[$module_name]['WARN_GROUP_NOT_FOUND'] ."</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>