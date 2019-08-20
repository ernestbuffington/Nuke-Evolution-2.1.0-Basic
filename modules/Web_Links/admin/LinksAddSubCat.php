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

if (!defined('IN_WEBLINKS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN WEBLINKS ADMINISTRATION');
}

linksHeader();

OpenTable();
$numrows = $db->sql_numrows($db->sql_query("SELECT `cid` FROM `"._WEBLINKS_CATEGORIES_TABLE."`"));
if ($numrows>0) {
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_ADD_SUBCAT'] . "</strong></span></center><br /><br />\n";
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"addsubcat\">";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['NAME'] . ": </td><td><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"50\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['IN'] . " </td><td>";
    $result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM "._WEBLINKS_CATEGORIES_TABLE." ORDER BY `parentid`, `title`");
    echo "<select name=\"cid\">";
    while($row = $db->sql_fetchrow($result1)) {
        $cid2 = intval($row['cid']);
        $ctitle2 = stripslashes($row['title']);
        $parentid2 = intval($row['parentid']);
        if ($parentid2!=0) {
            $ctitle2 = linksgetparent($parentid2,$ctitle2);
        }
        echo "<option value=\"$cid2\">$ctitle2</option>";
    }
    $db->sql_freeresult($result7);
    echo "</select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_IMAGE_URL']. ": </td><td><input type=\"text\" name=\"imageurl\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_IMAGE']. ": </td><td>".select_gallery('image', 'images/topics', TRUE)."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
    echo Make_TextArea('cdescription',$cdescription, 'addsubcat');
    echo "</td></tr>";
    echo "</table><br />";
    echo "<input type=\"hidden\" name=\"op\" value=\"LinksSaveSubCat\" />";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_ADD'] . "\" /></center><br />";
    echo "</form>";
} else {
    echo "<br /><br /><center>" . $lang_new[$module_name]['WARN_CAT_NOT_FOUND'] . "</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>