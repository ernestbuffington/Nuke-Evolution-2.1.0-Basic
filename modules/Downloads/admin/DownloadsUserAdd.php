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
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_USER_ADD'] . "</strong></span></center><br /><br />\n";
$row = $db->sql_fetchrow($db->sql_query("SELECT `user_id`, `username` FROM `".USERS_TABLE."` WHERE `user_id`='$userid'"));
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"adduser\">";
echo "<table width=\"100%\" border=\"0\">\n";
echo "<tr><td width=\"40%\"></td><td width=\"60%\"></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">". $lang_new[$module_name]['USER_NAME'] . ": </td><td><strong>".$row['username']."</strong></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\"></td><td></td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_DESCRIPTION'])." ". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
echo Make_TextArea('userdescription',$userdescription, 'adduser', '90%', '150px', true, 'bbcode');
echo "</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_UPLOAD_ALLOWED'])." ".$lang_new[$module_name]['USER_UPLOAD_ALLOWED'].":</td><td>";
echo yesno_option('canupload', 1);
echo "</td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_DOWNLOAD_ALLOWED'])." ".$lang_new[$module_name]['USER_DOWNLOAD_ALLOWED'].":</td><td>";
echo yesno_option('candownload', 1);
echo "</td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_MINTIME'])." ". $lang_new[$module_name]['USER_MINTIME'] . ": </td><td><input type=\"text\" name=\"mintime\" size=\"11\" maxlength=\"11\" value=\"0\" /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_MAXFILESIZE'])." ". $lang_new[$module_name]['USER_MAXFILESIZE'] . ": </td><td><input type=\"text\" name=\"maxfilesize\" size=\"11\" maxlength=\"11\" value=\"0\" />";
echo "<select name='sizedefinefile'>\n";
echo "<option value='0'>".$lang_new[$module_name]['SIZE_KB']."</option>\n";
echo "<option value='1'>".$lang_new[$module_name]['SIZE_MB']."</option>\n";
echo "<option value='2'>".$lang_new[$module_name]['SIZE_GB']."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_MAXBANDWIDTH'])." ". $lang_new[$module_name]['USER_BANDWIDTH'] . ": </td><td><input type=\"text\" name=\"maxbandwidth\" size=\"11\" maxlength=\"11\" value=\"0\" />";
echo "<select name='sizedefinebandwidth'>\n";
echo "<option value='0'>".$lang_new[$module_name]['SIZE_KB']."</option>\n";
echo "<option value='1'>".$lang_new[$module_name]['SIZE_MB']."</option>\n";
echo "<option value='2'>".$lang_new[$module_name]['SIZE_GB']."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_MEANTIME'])." ". $lang_new[$module_name]['USER_MEANTIME'] . ": </td><td><input type=\"text\" name=\"meantime\" size=\"11\" maxlength=\"11\" value=\"0\" /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_USER_ACTIVE'])." ". $lang_new[$module_name]['USER_ACTIVE'] ."</td><td>";
echo yesno_option('useractive', 1);
echo "</td></tr>";
echo "</table><br />";
echo "<input type=\"hidden\" name=\"userid\" value=\"".$row['user_id']."\" />";
echo "<input type=\"hidden\" name=\"mode\" value=\"DownloadsUserAdd\" />";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsUserAddS\" />";
echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_ADD'] . "\" /></center><br />";
echo "</form>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>