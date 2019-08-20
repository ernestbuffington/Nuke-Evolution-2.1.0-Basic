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

echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_USER_MODIFY'] . "</strong></span></center><br /><br />\n";
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"downloadsmoduser\">";
$row = $db->sql_fetchrow($db->sql_query("SELECT `user_id`, `username` FROM `".USERS_TABLE."` WHERE `user_id`='$userid'"));
$row1 = $db->sql_fetchrow($db->sql_query("SELECT  `user_description`, `user_allowed_upload`, `user_allowed_download`, `user_mintime`, `user_filesize`, `user_definefilesize`, `user_bandwidth`, `user_definebandwidth`, `user_meantime`, `user_active` FROM `"._DOWNLOADS_USERS_TABLE."` WHERE `user_id`='$userid'"));
$username = stripslashes($row['username']);
$userdescription = stripslashes($row1['user_description']);
$canupload = intval($row1['user_allowed_upload']);
$candownload = intval($row1['user_allowed_download']);
$mintime = intval($row1['user_mintime']);
$maxfilesize = intval($row1['user_filesize']);
$sizedefinefile = intval($row1['user_definefilesize']);
$maxbandwidth = intval($row1['user_bandwidth']);
$sizedefinebandwidth = intval($row1['user_definebandwidth']);
$meantime = intval($row1['user_meantime']);
$useractive = intval($row1['user_active']);

echo "<table width=\"100%\" border=\"0\">\n";
echo "<tr><td width=\"40%\"></td><td width=\"60%\"></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">". $lang_new[$module_name]['USER_NAME'] . ": </td><td><strong>".$row['username']."</strong></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\"></td><td></td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_DESCRIPTION'])." ". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
echo Make_TextArea('userdescription',$userdescription, 'downloadsmoduser', '90%', '150px', true, 'bbcode');
echo "</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_UPLOAD_ALLOWED'])." ".$lang_new[$module_name]['USER_UPLOAD_ALLOWED'].":</td><td>";
echo yesno_option('canupload', $canupload);
echo "</td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_DOWNLOAD_ALLOWED'])." ".$lang_new[$module_name]['USER_DOWNLOAD_ALLOWED'].":</td><td>";
echo yesno_option('candownload', $candownload);
echo "</td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_MINTIME'])." ". $lang_new[$module_name]['USER_MINTIME'] . ": </td><td><input type=\"text\" name=\"mintime\" size=\"11\" maxlength=\"11\" value=\"$mintime\" /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_MAXFILESIZE'])." ". $lang_new[$module_name]['USER_MAXFILESIZE'] . ": </td><td><input type=\"text\" name=\"maxfilesize\" size=\"11\" maxlength=\"11\" value=\"$maxfilesize\" />";
echo "<select name='sizedefinefile'>\n";
$sizedefinefile_sel_0 = $sizedefinefile_sel_1 = $sizedefinefile_sel_2 = '';
switch ($sizedefinefile) {
    case '0': $sizedefinefile_sel_0 = "selected='selected'"; break;
    case '1': $sizedefinefile_sel_1 = "selected='selected'"; break;
    case '2': $sizedefinefile_sel_2 = "selected='selected'"; break;
}
echo "<option value='0' $sizedefinefile_sel_0>".$lang_new[$module_name]['SIZE_KB']."</option>\n";
echo "<option value='1' $sizedefinefile_sel_1>".$lang_new[$module_name]['SIZE_MB']."</option>\n";
echo "<option value='2' $sizedefinefile_sel_2>".$lang_new[$module_name]['SIZE_GB']."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_MAXBANDWIDTH'])." ". $lang_new[$module_name]['USER_BANDWIDTH'] . ": </td><td><input type=\"text\" name=\"maxbandwidth\" size=\"11\" maxlength=\"11\" value=\"$maxbandwidth\" />";
echo "<select name='sizedefinebandwidth'>\n";
$sizedefinebandwidth_sel_0 = $sizedefinebandwidth_sel_1 = $sizedefinebandwidth_sel_2 = '';
switch ($sizedefinebandwidth) {
    case '0': $sizedefinebandwidth_sel_0 = "selected='selected'"; break;
    case '1': $sizedefinebandwidth_sel_1 = "selected='selected'"; break;
    case '2': $sizedefinebandwidth_sel_2 = "selected='selected'"; break;
}
echo "<option value='0' $sizedefinebandwidth_sel_0>".$lang_new[$module_name]['SIZE_KB']."</option>\n";
echo "<option value='1' $sizedefinebandwidth_sel_1>".$lang_new[$module_name]['SIZE_MB']."</option>\n";
echo "<option value='2' $sizedefinebandwidth_sel_2>".$lang_new[$module_name]['SIZE_GB']."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_MEANTIME'])." ". $lang_new[$module_name]['USER_MEANTIME'] . ": </td><td><input type=\"text\" name=\"meantime\" size=\"11\" maxlength=\"11\" value=\"$meantime\" /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_ACTIVE'])." ". $lang_new[$module_name]['USER_ACTIVE'] ."</td><td>";
echo yesno_option('useractive', $useractive);
echo "</td></tr>";
echo "</table>";
echo "<input type=\"hidden\" name=\"userid\" value=\"".$row['user_id']."\" />";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsUserAddS\" />";
echo "<input type=\"hidden\" name=\"mode\" value=\"DownloadsUserMod\" />";
echo "<br />";
echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_MODIFY'] . "\" /></center><br />";
echo "</form>";

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>