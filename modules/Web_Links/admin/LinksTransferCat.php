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
$numrows = $db->sql_numrows($db->sql_query("SELECT `cid` FROM `"._WEBLINKS_LINKS_TABLE."`"));
if ($numrows>0) {
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_TRANSFER_CAT'] . "</strong></span></center><br /><br />\n";
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"linkstransfercat\">";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
    echo "<select name=\"cidfrom\">";
    $result = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` ORDER BY `parentid`, `title`");
    while($row = $db->sql_fetchrow($result)) {
        $cid2 = intval($row['cid']);
        $ctitle2 = stripslashes($row['title']);
        $parentid2 = intval($row['parentid']);
        if ($parentid2!=0) {
            $ctitle2=linksgetparent($parentid2,$ctitle2);
        }
        echo "<option value=\"$cid2\">$ctitle2</option>";
    }
    $db->sql_freeresult($result);
    echo "</select></td></tr>";
    echo "<tr><td align=\"left\">". $lang_new[$module_name]['IN'] . " </td><td></td></tr>\n";
    echo "<tr><td align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
    $result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` ORDER BY `parentid`, `title`");
    echo "<select name=\"cidto\">";
    while($row1 = $db->sql_fetchrow($result1)) {
        $cid2 = intval($row1['cid']);
        $ctitle2 = stripslashes($row1['title']);
        $parentid2 = $row1['parentid'];
        if ($parentid2!=0) {
            $ctitle2=linksgetparent($parentid2,$ctitle2);
        }
        echo "<option value=\"$cid2\">$ctitle2</option>";
    }
    $db->sql_freeresult($result15);
    echo "</select></td></tr>\n";
    echo "</table><br />";
    echo "<input type=\"hidden\" name=\"op\" value=\"LinksTransfer\" />";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_DOIT'] . "\" /></center><br />\n";
    echo "</form>\n";
} else {
    echo "<br /><br /><center>" . $lang_new[$module_name]['WARN_CAT_NOT_FOUND'] . "</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>