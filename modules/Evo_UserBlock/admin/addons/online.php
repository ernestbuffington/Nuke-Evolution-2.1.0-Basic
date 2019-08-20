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
title($lang_evo_userblock['ADMIN']['EVO_USERINFO']. "&nbsp;-&nbsp;" .$lang_evo_userblock['ONLINE']['ONLINE']);
OpenTable();
if(!empty($_POST)) {
    $values = array('show_members' => Fix_Quotes($_POST['show_members']),'show_hv' => Fix_Quotes($_POST['show_hv']), 'scroll' => Fix_Quotes($_POST['scroll']));
    evouserinfo_write_addon('online', $values);
    echo "<div align=\"center\">\n";
    echo $lang_evo_userblock['ADMIN']['SAVED'];
    echo "</div>";
    global $admin_file;
    echo "<meta http-equiv=\"refresh\" content=\"3;url=$admin_file.php?op=evo-userinfo\" />";
} else {
    echo "<div align=\"center\">\n";
    echo "<form name=\"good_afternoon\" method=\"post\" action=\"".$admin_file.".php?op=evo-userinfo&amp;file=online\">";
    $radio[] = array('value' => 'yes', 'text' => $lang_evo_userblock['YES'], 'name' => 'show_members', 'checked' => ($blocksession[1]['online_show_members'] == 'yes') ? ' checked="checked" ' : '');
    $radio[] = array('value' => 'no', 'text' => $lang_evo_userblock['NO'], 'name' => 'show_members', 'checked' => ($blocksession[1]['online_show_members'] == 'no') ? ' checked="checked" ' : '');
    echo $lang_evo_userblock['ONLINE']['SHOW_MEMBERS']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br />";
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $lang_evo_userblock['YES'], 'name' => 'show_hv', 'checked' => ($blocksession[1]['online_show_hv'] == 'yes') ? ' checked="checked" ' : '');
    $radio[] = array('value' => 'no', 'text' => $lang_evo_userblock['NO'], 'name' => 'show_hv', 'checked' => ($blocksession[1]['online_show_hv'] == 'no') ? ' checked="checked" ' : '');
    echo $lang_evo_userblock['ONLINE']['SHOW_HV']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br />";
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $lang_evo_userblock['YES'], 'name' => 'scroll', 'checked' => ($blocksession[1]['online_scroll'] == 'yes') ? ' checked="checked" ' : '');
    $radio[] = array('value' => 'no', 'text' => $lang_evo_userblock['NO'], 'name' => 'scroll', 'checked' => ($blocksession[1]['online_scroll'] == 'no') ? ' checked="checked" ' : '');
    echo $lang_evo_userblock['ONLINE']['SCROLL']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br />";
    echo "<input type=\"submit\" value=\"".$lang_evo_userblock['ADMIN']['SAVE']."\" />";
    echo "</form>";
    echo "</div>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');
?>