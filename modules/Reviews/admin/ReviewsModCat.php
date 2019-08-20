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

if (!defined('IN_REVIEWS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN REVIEWS ADMINISTRATION');
}

reviewsHeader();
$cat = explode("-", $cat);
if (empty($cat[1])) {
    $cat[1] = 0;
}
OpenTable();
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_MODIFY_CAT'] . "</strong></span></center><br /><br />\n";
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"reviewsmodcat\">";
echo "<table width=\"100%\" border=\"0\">\n";
if ($cat[1] == 0) {
    $row = $db->sql_fetchrow($db->sql_query("SELECT `title`, `image`, `cdescription` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid`='$cat[0]'"));
    $title = stripslashes($row['title']);
    $image = stripslashes($row['image']);
    $cdescription = stripslashes($row['cdescription']);
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['NAME'] . ": </td><td><input type=\"text\" name=\"title\" value=\"$title\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE_URL']. ": </td><td><input type=\"text\" name=\"imageurl\" size=\"75\" maxlength=\"100\" value=\"$image\" />";
    if ( !empty($image) ) {
        echo " <img src=\"$image\" width=\"16\" height=\"16\" /></td></tr>\n";
    } else {
        echo " <img src=\"".evo_image('dir.png', $module_name)."\" width=\"16\" height=\"16\" /></td></tr>\n";
    }
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE']. ": </td><td>".select_gallery('image', 'images/topics', TRUE, $image)."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
    echo Make_TextArea('cdescription', $cdescription, 'reviewsmodcat');
    echo "</td></tr>\n";
    echo "<input type=\"hidden\" name=\"sub\" value=\"0\" />";
    echo "<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\" />";
    echo "<input type=\"hidden\" name=\"op\" value=\"ReviewsModCatS\" />";
    echo "</td></tr>";
    echo "</table>";
    echo "<table width=\"100%\" border=\"0\"><tr><td align=\"center\">";
    echo "<input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_SAVE'] . "\" /></form></td></tr>\n";
    echo "<tr><td align=\"center\"><form action=\"".$admin_file.".php\" method=\"get\">";
    echo "<input type=\"hidden\" name=\"sub\" value=\"0\" />";
    echo "<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\" />";
    echo "<input type=\"hidden\" name=\"op\" value=\"ReviewsDelCat\" />";
    echo "<input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_DELETE'] . "\" />";
    echo "</form></td></tr>\n";
    echo "</table>";
} else {
    $row = $db->sql_fetchrow($db->sql_query("SELECT `title` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid`='$cat[0]'"));
    $ctitle = stripslashes($row['title']);
    $row1 = $db->sql_fetchrow($db->sql_query("SELECT `title` FROM `"._REVIEWS_SUBCATEGORIES_TABLE."` WHERE `sid`='$cat[1]'"));
    $stitle = stripslashes($row1['title']);
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>$ctitle</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['CATEGORYSUB'] . ": </td><td><input type=\"text\" name=\"title\" value=\"$stitle\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
    echo "<input type=\"hidden\" name=\"sub\" value=\"1\" />";
    echo "<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\" />";
    echo "<input type=\"hidden\" name=\"sid\" value=\"$cat[1]\" />";
    echo "<input type=\"hidden\" name=\"op\" value=\"ReviewsModCatS\" />";
    echo "</td></tr>";
    echo "</table>";
    echo "<table width=\"100%\" border=\"0\"><tr><td align=\"center\">";
    echo "<input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_SAVE'] . "\" /></form></td></tr>\n";
    echo "<tr><td align=\"center\"><form action=\"".$admin_file.".php\" method=\"get\">";
    echo "<input type=\"hidden\" name=\"sub\" value=\"1\" />";
    echo "<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\" />";
    echo "<input type=\"hidden\" name=\"sid\" value=\"$cat[1]\" />";
    echo "<input type=\"hidden\" name=\"op\" value=\"ReviewsDelCat\" />";
    echo "<input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_DELETE'] . "\" />";
    echo "</form></td></tr>\n";
    echo "</table>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>