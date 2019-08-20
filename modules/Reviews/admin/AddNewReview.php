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
OpenTable();
$result = $db->sql_query("SELECT `cid`, `title` FROM `"._REVIEWS_CATEGORIES_TABLE."`");
$numrows = $db->sql_numrows($result);
$db->sql_freeresult($result);
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_ADD_REVIEW'] . "</strong></span></center><br /><br />\n";
if ($numrows>0) {
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"addnewreview\">";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_PAGETITLE'] . ": </td><td><input type=\"text\" name=\"title\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
    if ($reviewsconfig['reviewimgurlallowed'] == 1) {
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE_URL']. ": </td><td><input type=\"text\" name=\"image\" size=\"75\" maxlength=\"100\" value=\"\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' ></td><td>".$lang_new[$module_name]['INFO_REVIEW_IMGURL']."<br /></td></tr>\n";
    }
        $result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` ORDER BY `title`");
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
    echo "<select name=\"cat\">";
        while($row = $db->sql_fetchrow($result1)) {
             $cid2 = intval($row['cid']);
             $ctitle2 = stripslashes($row['title']);
             $parentid2 = intval($row['parentid']);
             if ($parentid2!=0) {
                $ctitle2=reviewgetparent($parentid2,$ctitle2);
             }
             echo "<option value=\"$cid2\">$ctitle2</option>";
        }
        $db->sql_freeresult($result9);
        echo "</select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . "</td><td>";
    echo Make_TextArea('description',$description,'addnewreview');
    echo "</td></tr>\n";
    if ($reviewsconfig['reviewurlallowed'] == 1) {
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_URL'] . ": </td><td><input type=\"text\" name=\"url\" size=\"75\" maxlength=\"100\" value=\"\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' ></td><td>".$lang_new[$module_name]['INFO_REVIEW_URL']."<br /></td></tr>\n";
    }
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_HEADER'] . "</td><td>";
    echo Make_TextArea('reviewheader',$reviewheader,'addnewreview');
    echo "</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_BODY'] . "</td><td>";
    echo Make_TextArea('reviewbody',$reviewbody,'addnewreview');
    echo "</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_FOOTER'] . "</td><td>";
    echo Make_TextArea('reviewfooter',$reviewfooter,'addnewreview');
    echo "</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_SIGNATURE'] . "</td><td>";
    echo Make_TextArea('reviewsignature',$reviewsignature,'addnewreview');
    echo "</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['USER'] .": </td><td><input type=\"text\" name=\"username\" value=\"".$userinfo['username']."\" size=\"60\" maxlength=\"60\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['EMAIL'] .": </td><td><input type=\"text\" name=\"email\" value=\"".$userinfo['user_email']."\" size=\"60\" maxlength=\"60\" /></td></tr>\n";
    echo "</table><br />";
    echo "<input type=\"hidden\" name=\"op\" value=\"ReviewsAddReview\" />\n";
    echo "<input type=\"hidden\" name=\"new\" value=\"0\" />";
    echo "<input type=\"hidden\" name=\"submitter\" value=\"".$userinfo['username']."\" />";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_ADD'] . "\" /></center>\n";
    echo "</form>";
} else {
    echo "<br /><br /><center>" . $lang_new[$module_name]['WARN_CAT_NOT_FOUND'] . "</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>