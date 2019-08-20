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

$pagemodulname = 'DownloadsLicensesList';

DownloadsHeader();

OpenTable();
$perpage = $downloadsconfig['downloads_perpage'];
if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$perpage;

$totalselected = $db->sql_numrows($db->sql_query("SELECT `license_id` FROM `"._DOWNLOADS_LICENSES_TABLE."`"));
downloadspagenums_admin($op, $totalselected, $perpage, $max);
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_LICENSES_LIST'] . "</strong></span></center><br /><br />\n";
echo "<center>[ <a href=\"".$admin_file.".php?op=DownloadsLicensesAdd\">".$lang_new[$module_name]['ADMIN_LICENSES_ADD']."</a> ]</center><br />\n";
if ($totalselected > 0) {
    echo "<table width=\"100%\" border=\"0\">\n";
    $result11 = $db->sql_query("SELECT `license_id`, `license_title`, `license_text`, `license_url`  FROM `"._DOWNLOADS_LICENSES_TABLE."`  ORDER BY `license_title`  LIMIT $min, $perpage");
    echo "<tr bgcolor='".$ThemeInfo['bgcolor2']."'>\n<td><strong>".$lang_new[$module_name]['ADMIN_LICENSES']."</strong></td>\n";
    echo "<td align='center' colspan=\"2\"><strong>".$lang_new[$module_name]['ADMIN_LICENSES_FUNCTION']."</strong></td>\n</tr><tr><td colspan='3'>\n";
    $x = 0;
    while($row11 = $db->sql_fetchrow($result11)) {
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectmodifylicense_$x\">";
        echo "<input type=\"hidden\" name=\"min\" value=\"$min\" />\n";
        echo "<input type='hidden' name='licenseid' value='".$row11['license_id']."' />\n";
        echo "<table width='100%'><tr><td  width='70%'>";
        $title = stripslashes($row11['license_title']);
        echo $title."</td>\n";
        echo "<td align='left'><select name='op'>";
        echo "<option value='DownloadsLicensesDel'>".$lang_new[$module_name]['DELETE']."</option>\n";
        echo "<option value='DownloadsLicensesMod' selected='selected'>".$lang_new[$module_name]['MODIFY']."</option>\n";
        echo "</select></td><td align=\"left\"><input type=\"submit\" value=\"" . $lang_new[$module_name]['OK'] . "\" /></td></tr></table>\n";
        echo "</form>\n";
        $x++;
    }
    $db->sql_freeresult($result11);
    echo "</td></tr></table><br />";
    downloadspagenums_admin($op, $totalselected, $perpage, $max);
    echo "<center>[ <a href=\"".$admin_file.".php?op=DownloadsLicensesAdd\">".$lang_new[$module_name]['ADMIN_LICENSES_ADD']."</a> ]</center><br />\n";
} else {
    echo "<br /><br /><center>". $lang_new[$module_name]['WARN_LICENSE_NOT_FOUND'] ."</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>