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

global $ThemeInfo;

DownloadsHeader();
OpenTable();
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_LICENSES_ADD'] . "</strong></span></center><br /><br />\n";
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"addnewlicense\" >";
echo "<table width=\"100%\" border=\"0\">\n";
echo "<tr><td  width='25%' bgcolor='".$ThemeInfo['bgcolor2']."' align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_LICENSE_TITLE'])." ". $lang_new[$module_name]['LICENSE_TITLE'] . ": </td><td><input type=\"text\" name=\"licensetitle\" size=\"30\" maxlength=\"30\" /></td></tr>\n";
echo "<tr><td  width='25%' bgcolor='".$ThemeInfo['bgcolor2']."' align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_LICENSE_URL'])." ". $lang_new[$module_name]['LICENSE_URL'] . ": </td><td><input type=\"text\" name=\"licenseurl\" size=\"75\" maxlength=\"255\" /></td></tr>\n";
echo "<tr><td  width='25%' bgcolor='".$ThemeInfo['bgcolor2']."' align=\"left\">".evo_help_img($lang_new[$module_name]['HELP_LICENSE_TEXT'])." ". $lang_new[$module_name]['LICENSE_TEXT'] . "</td><td>";
echo Make_TextArea('licensetext','','addnewlicense', '90%', '150px', true, 'bbcode');
echo "</td></tr>\n";
echo "</table><br />";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsLicensesAddS\" />";
echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_ADD'] . "\" /></center>\n";
echo "</form>";

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>