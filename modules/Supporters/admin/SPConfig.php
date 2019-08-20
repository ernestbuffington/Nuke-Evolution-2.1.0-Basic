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

global $lang_new, $module_name;
$pagetitle = ': '.$lang_new[$module_name]['SP_CONFIGMAIN'].' '.$supporter_config['version_number'];
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . $lang_new[$module_name]['SP_ADMIN_HEADER'] . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SP_RETURNMAIN'] . "</a> ]</div>\n";
CloseTable();
echo "<br />";
title($lang_new[$module_name]['SP_CONFIGMAIN']." ".$supporter_config['version_number']);
spmenu();
echo "<br />\n";
OpenTable();
echo "<form action='".$admin_file.".php?op=SPConfigSave' method='post'>\n";
echo "<div align=\"center\"><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>".$lang_new[$module_name]['SP_REQUIREUSER'].":</strong></td>\n<td>";
echo yesno_option('require_user', $supporter_config['require_user']);
echo "</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>".$lang_new[$module_name]['SP_IMAGETYPE'].":</strong></td>\n<td>";
if($supporter_config['image_type'] == 0) {
    $chk3 = ' checked="checked"';
    $chk4 = '';
} else {
    $chk3 = '';
    $chk4 = ' checked="checked"';
}
echo "<input type='radio' name='image_type' value='0'$chk3 />".$lang_new[$module_name]['SP_LINKED']."&nbsp;";
echo "<input type='radio' name='image_type' value='1'$chk4 />".$lang_new[$module_name]['SP_UPLOAD']."</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>".$lang_new[$module_name]['SP_MAXWIDTH'].":</strong></td>\n";
echo "<td><input type='text' name='max_width' value='".$supporter_config['max_width']."' size='5' maxlength='4' /></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>".$lang_new[$module_name]['SP_MAXHEIGHT'].":</strong></td>\n";
echo "<td><input type='text' name='max_height' value='".$supporter_config['max_height']."' size='5' maxlength='4' /></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='".$lang_new[$module_name]['SP_SAVECHANGES']."' /></td></tr>\n";
echo "</table></div></form>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>