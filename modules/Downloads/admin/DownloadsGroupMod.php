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

DownloadsHeader();
OpenTable();

echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_GROUP_MODIFY'] . "</strong></span></center><br /><br />\n";
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"downloadsmodgroup\">";
echo "<table width=\"100%\" border=\"0\">\n";
$row = $db->sql_fetchrow($db->sql_query("SELECT `group_id`, `group_name` FROM `".GROUPS_TABLE."` WHERE `group_id`='$groupid'"));
$row1 = $db->sql_fetchrow($db->sql_query("SELECT  `group_description`, `group_allowed_upload`, `group_allowed_download`, `group_mintime`, `group_filesize`, `group_definefilesize`, `group_bandwidth`, `group_definebandwidth`, `group_meantime`, `group_active` FROM `"._DOWNLOADS_GROUPS_TABLE."` WHERE `group_id`='$groupid'"));
$groupname = stripslashes($row['group_name']);
$groupdescription = stripslashes($row1['group_description']);
$canupload = intval($row1['group_allowed_upload']);
$candownload = intval($row1['group_allowed_download']);
$mintime = intval($row1['group_mintime']);
$maxfilesize = intval($row1['group_filesize']);
$sizedefinefile = intval($row1['group_definefilesize']);
$maxbandwidth = intval($row1['group_bandwidth']);
$sizedefinebandwidth = intval($row1['group_definebandwidth']);
$meantime = intval($row1['group_meantime']);
$groupactive = intval($row1['group_active']);

echo "<table width=\"100%\" border=\"0\">\n";
echo "<tr><td width=\"40%\"></td><td width=\"60%\"></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">". $lang_new[$module_name]['GROUP_NAME'] . ": </td><td><strong>".$row['group_name']."</strong></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\"></td><td></td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_GROUP_DESCRIPTION'])." ". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
echo Make_TextArea('groupdescription',$groupdescription, 'downloadsmodgroup', '', '', true, 'bbcode');
echo "</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_GROUP_UPLOAD_ALLOWED'])." ".$lang_new[$module_name]['GROUP_UPLOAD_ALLOWED'].":</td><td>";
echo yesno_option('canupload', $canupload);
echo "</td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_GROUP_DOWNLOAD_ALLOWED'])." ".$lang_new[$module_name]['GROUP_DOWNLOAD_ALLOWED'].":</td><td>";
echo yesno_option('candownload', $candownload);
echo "</td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_GROUP_MINTIME'])." ". $lang_new[$module_name]['GROUP_MINTIME'] . ": </td><td><input type=\"text\" name=\"mintime\" size=\"11\" maxlength=\"11\" value=\"$mintime\" /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_GROUP_MAXFILESIZE'])." ". $lang_new[$module_name]['GROUP_MAXFILESIZE'] . ": </td><td><input type=\"text\" name=\"maxfilesize\" size=\"11\" maxlength=\"11\" value=\"$maxfilesize\" />";
echo "<select name='sizedefinefile'>\n";
switch ($sizedefinefile) {
    case '0': $sizedefinefile_sel_0 = 'selected'; break;
    case '1': $sizedefinefile_sel_1 = 'selected'; break;
    case '2': $sizedefinefile_sel_2 = 'selected'; break;
}
echo "<option value='0' $sizedefinefile_sel_0>".$lang_new[$module_name]['SIZE_KB']."</option>\n";
echo "<option value='1' $sizedefinefile_sel_1>".$lang_new[$module_name]['SIZE_MB']."</option>\n";
echo "<option value='2' $sizedefinefile_sel_2>".$lang_new[$module_name]['SIZE_GB']."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_GROUP_MAXBANDWIDTH'])." ". $lang_new[$module_name]['GROUP_BANDWIDTH'] . ": </td><td><input type=\"text\" name=\"maxbandwidth\" size=\"11\" maxlength=\"11\" value=\"$maxbandwidth\" />";
echo "<select name='sizedefinebandwidth'>\n";
switch ($sizedefinebandwidth) {
    case '0': $sizedefinebandwidth_sel_0 = 'selected'; break;
    case '1': $sizedefinebandwidth_sel_1 = 'selected'; break;
    case '2': $sizedefinebandwidth_sel_2 = 'selected'; break;
}
echo "<option value='0' $sizedefinebandwidth_sel_0>".$lang_new[$module_name]['SIZE_KB']."</option>\n";
echo "<option value='1' $sizedefinebandwidth_sel_1>".$lang_new[$module_name]['SIZE_MB']."</option>\n";
echo "<option value='2' $sizedefinebandwidth_sel_2>".$lang_new[$module_name]['SIZE_GB']."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_GROUP_MEANTIME'])." ". $lang_new[$module_name]['GROUP_MEANTIME'] . ": </td><td><input type=\"text\" name=\"meantime\" size=\"11\" maxlength=\"11\" value=\"$meantime\" /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_GROUP_ACTIVE'])." ". $lang_new[$module_name]['GROUP_ACTIVE'] ."</td><td>";
echo yesno_option('groupactive', $groupactive);
echo "</td></tr>";
echo "<input type=\"hidden\" name=\"groupid\" value=\"".$row['group_id']."\" />";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsGroupAddS\" />";
echo "<input type=\"hidden\" name=\"mode\" value=\"DownloadsGroupMod\" />";
echo "</form>";
echo "</table>";
echo "<br />";
echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_MODIFY'] . "\" /></center><br />";

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>