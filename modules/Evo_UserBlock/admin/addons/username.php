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

include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
CloseTable();
echo "<br />";
title($lang_evo_userblock['ADMIN']['EVO_USERINFO']. "&nbsp;-&nbsp;" .$lang_evo_userblock['USERNAME']['USERNAME']);
OpenTable();
if(!empty($_POST['center'])) {
    $values = array('center' => Fix_Quotes($_POST['center']));
    evouserinfo_write_addon('username', $values);
    echo "<div align=\"center\">\n";
    echo $lang_evo_userblock['ADMIN']['SAVED'];
    echo "</div>";
    global $admin_file;
    echo "<meta http-equiv=\"refresh\" content=\"3;url=$admin_file.php?op=evo-userinfo\" />";
} else {
    echo "<div align=\"center\">\n";
    echo "<form name=\"good_afternoon\" method=\"post\" action=\"".$admin_file.".php?op=evo-userinfo&amp;file=username\">";
    $radio[] = array('value' => 'yes', 'text' => $lang_evo_userblock['YES'], 'name' => 'center', 'checked' => ($blocksession[1]['username_center'] == 'yes') ? ' checked="checked" ' : '');
    $radio[] = array('value' => 'no', 'text' => $lang_evo_userblock['NO'], 'name' => 'center', 'checked' => ($blocksession[1]['username_center'] == 'yes') ? '' : ' checked="checked" ');
    echo $lang_evo_userblock['USERNAME']['CENTER']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br /><input type=\"submit\" value=\"".$lang_evo_userblock['ADMIN']['SAVE']."\" />";
    echo "</form>";
    echo "</div>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>