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

$pagetitle = ': '.$lang_new[$module_name]['SP_ADMINMAIN'].' - '.$lang_new[$module_name]['SP_EDITSITE'];
$result = $db->sql_query("SELECT * FROM `"._NSNSP_SITES_TABLE."` WHERE `site_id`='$site_id'");
$site_row = $db->sql_fetchrow($result);
$cdate2 = formatTimestamp($site_row['site_date']);
if ($site_row['last_edit_user_date'] > 0 ) {
    $cdate1 = formatTimestamp($site_row['last_edit_user_date']);
} else {
    $cdate1 = 0;
}
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . $lang_new[$module_name]['SP_ADMIN_HEADER'] . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SP_RETURNMAIN'] . "</a> ]</div>\n";
CloseTable();
echo "<br />";
title($lang_new[$module_name]['SP_ADMINMAIN'].' - '.$lang_new[$module_name]['SP_EDITSITE']);
spmenu();
echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form name='editsupporter' action='".$admin_file.".php?op=SPEditSave' method='post' enctype='multipart/form-data'>";
echo "<input type='hidden' name='site_id' value='".$site_row['site_id']."' />";
echo "<input type='hidden' name='old_image_type' value='".$site_row['image_type']."' />";
echo "<input type='hidden' name='old_image' value='".$site_row['site_image']."' />";
echo "<input type='hidden' name='edit_user_id' value='".$userinfo['user_id']."' />";
echo "<input type='hidden' name='edit_user_name' value='".$userinfo['username']."' />";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_SITEID'].":</strong></td><td><strong>".$site_row['site_id']."</strong></tr></td>";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_NAME'].":</strong></td><td><input type='text' name='site_name' size='75' value='".$site_row['site_name']."' /></tr></td>";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_URL'].":</strong></td><td><input type='text' name='site_url' size='75' value='".$site_row['site_url']."' /></tr></td>";
echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_IMAGE_URL'].":</strong></td><td><input type='text' name='new_image' size='75' /><br />".$site_row['site_image']."</tr></td>";
echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_IMAGE_UPLOAD'].":</strong></td><td><input type='file' name='new_image_file' size='75' /></tr></td>";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_ADDED'].":</strong></td><td><input type='text' name='site_date' size='30' value='".$cdate2."' readonly /></tr></td>";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_EDITED'].":</strong></td><td><input type='text' name='site_edited' size='30' value='".$cdate1."' readonly /></tr></td>";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_EDITED_USER'].":</strong></td><td><input type='text' name='site_edited_user' size='30' value='".$site_row['last_edit_user_name']."' readonly /></tr></td>";
echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_DESCRIPTION'].":</strong></td><td>";
echo Make_TextArea('site_description', $site_row['site_description'],'editsupporter');
echo "</tr></td>\n";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_USERNAME'].":</strong></td><td><input type='text' name='user_name' size='30' value='".$site_row['user_name']."' /></tr></td>";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_USEREMAIL'].":</strong></td><td><input type='text' name='user_email' size='30' value='".$site_row['user_email']."' /></tr></td>";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_USERIP']."</strong></td><td>".$site_row['user_ip']."</tr></td>";
echo "<input type='hidden' name='comefrom' value='$comefrom' />\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._EDIT."' /></td></tr>";
echo "</form></table>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>