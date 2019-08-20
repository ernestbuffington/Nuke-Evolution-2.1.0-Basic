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

$pagetitle = ': '.$lang_new[$module_name]['SP_ADMINMAIN'].' - '.$lang_new[$module_name]['SP_ADDSUPPORTER'];
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . $lang_new[$module_name]['SP_ADMIN_HEADER'] . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SP_RETURNMAIN'] . "</a> ]</div>\n";
CloseTable();
echo "<br />";
$sip = identify::get_ip();
title($lang_new[$module_name]['SP_ADMINMAIN'].' - '.$lang_new[$module_name]['SP_ADDSUPPORTER']);
spmenu();
echo "<br />\n";
OpenTable();
echo "<center><br />".$lang_new[$module_name]['SP_ALLREQ']."<br />\n";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form name='addsupporter' action='".$admin_file.".php?op=SPAddSave' method='post' enctype='multipart/form-data'>\n";
echo "<input type='hidden' name='user_id' value='".$userinfo['user_id']."' />\n";
echo "<input type='hidden' name='user_name' value='".$userinfo['username']."' />\n";
echo "<input type='hidden' name='user_email' value='".$userinfo['user_email']."' />\n";
echo "<input type='hidden' name='user_ip' value='".$sip."' />\n";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_NAME'].":</strong></td><td><input type='text' name='site_name' size='75' /></td></tr>\n";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_URL'].":</strong></td><td><input type='text' name='site_url' size='75' value='http://' /></td></tr>\n";
echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_IMAGE_URL'].":</strong></td><td><input type='input' name='site_image' size='75' /><br />";
echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_IMAGE_UPLOAD'].":</strong></td><td><input type='file' name='site_image_file' size='75' /><br />";
echo $lang_new[$module_name]['SP_MUSTBE']."</td></tr>\n";
echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_DESCRIPTION'].":</strong></td><td>";
echo Make_TextArea('site_description', '','addsupporter');
echo "</td></tr>\n";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_YOURNAME'].":</strong></td><td>".$userinfo['username']."</td></tr>\n";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_YOUREMAIL'].":</strong></td><td>".$userinfo['user_email']."</td></tr>\n";
echo "<tr><td><strong>".$lang_new[$module_name]['SP_YOURIP'].":</strong></td><td>".$sip."</td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='".$lang_new[$module_name]['SP_SUBMITSITE']."' /></td></tr>\n";
echo "</form></table></center>\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>