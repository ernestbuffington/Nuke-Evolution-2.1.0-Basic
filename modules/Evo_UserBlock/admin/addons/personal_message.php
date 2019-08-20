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

if(!empty($_POST['message'])) {
    $values = array('message' => Fix_Quotes($_POST['message']));
    evouserinfo_write_addon('personal_message', $values);
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title($lang_evo_userblock['ADMIN']['EVO_USERINFO']. "&nbsp;-&nbsp;" .$lang_evo_userblock['PERSONAL_MESSAGE']['PERSONAL_MESSAGE']);
    OpenTable();
    echo "<div align=\"center\">\n";
    echo $lang_evo_userblock['ADMIN']['MSG_SAVED'];
    echo "</div>";
    CloseTable();
    global $admin_file;
    echo "<meta http-equiv=\"refresh\" content=\"3;url=$admin_file.php?op=evo-userinfo\" />";
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title($lang_evo_userblock['ADMIN']['EVO_USERINFO']. "&nbsp;-&nbsp;" .$lang_evo_userblock['PERSONAL_MESSAGE']['PERSONAL_MESSAGE']);
    OpenTable();
    echo "<div align=\"center\">\n";
    echo "<span style=\"font-size: large; font-weight: bold;\">".$lang_evo_userblock['ADMIN']['HELP']."</span>\n<br /><br />\n";
    echo $lang_evo_userblock['PERSONAL_MESSAGE']['HELP'];
    echo "</div>";
    CloseTable();
    
    echo "<br />";
    
    OpenTable();
    echo "<div align=\"center\">\n";
    echo "<form name=\"good_afternoon\" method=\"post\" action=\"".$admin_file.".php?op=evo-userinfo&amp;file=personal_message\">";
    echo evouserinfo_text_area('message', $blocksession[1]['personal_message_message']);
    echo "<br /><input type=\"submit\" value=\"".$lang_evo_userblock['ADMIN']['SAVE']."\" />";
    echo "</form>";
    echo "</div>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>