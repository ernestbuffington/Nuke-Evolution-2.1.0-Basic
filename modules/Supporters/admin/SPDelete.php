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

$site_id    = $_GETVAR->get('site_id', '_GET', 'int');
$comefrom   = ($_GETVAR->get('comefrom', '_GET') ? $_GETVAR->get('comefrom', '_GET') : 'SPMain');
$pagetitle = ': '.$module_name.' - '.$lang_new[$module_name]['SP_DELETESITE'];
$result = $db->sql_query("SELECT `site_name`, `site_url` FROM `"._NSNSP_SITES_TABLE."` WHERE `site_id`='$site_id'");
list($site_name, $site_url) = $db->sql_fetchrow($result);
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . $lang_new[$module_name]['SP_ADMIN_HEADER'] . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SP_RETURNMAIN'] . "</a> ]</div>\n";
CloseTable();
echo "<br />";
title($module_name.' - '.$lang_new[$module_name]['SP_DELETESITE']);
spmenu();
echo "<br />\n";
OpenTable();
echo "<center>".$lang_new[$module_name]['SP_YOUDELETE']." <a href='$site_url' target='_blank'><strong>$site_name</strong></a><br /><br />";
echo "".$lang_new[$module_name]['SP_SURE2DELETE']."<br /><br /></center>";
echo "<center><table><tr>\n";
echo "<form action='".$admin_file.".php?op=SPDeleteConfirm' method='post'>\n";
echo "<input type='hidden' name='site_id' value='$site_id' />\n";
echo "<input type='hidden' name='comefrom' value='$comefrom' />\n";
echo "<td align='center'><input type='submit' value=' "._YES." ' /><br />\n";
echo _GOBACK."</td>\n";
echo "</form>\n";
echo "</tr></table></center>\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>