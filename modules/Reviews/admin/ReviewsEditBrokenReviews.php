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
$rid = intval($rid);
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_BROKEN_REVIEW'] . "</strong></span></center><br /><br />\n";
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"revieweditbroken\">";
echo "<table width=\"100%\" border=\"0\">\n";
$row = $db->sql_fetchrow($db->sql_query("SELECT `rid`, `cid`, `title`, `image`, `url`, `description`, `modifysubmitter` FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `brokenreview`='1' ORDER BY `requestid`"));
$rid = intval($row['rid']);
$cid = intval($row['cid']);
$title = stripslashes($row['title']);
$image = $row['image'];
$url = $row['url'];
$description = stripslashes($row['description']);
$modifysubmitter = $row['modifysubmitter'];
$row2 = $db->sql_fetchrow($db->sql_query("SELECT `name`, `email`, `hits` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='$rid'"));
$name = $row2['name'];
$email = $row2['email'];
$hits = intval($row2['hits']);
echo "<tr><td align=\"left\"><strong>" . $lang_new[$module_name]['REVIEW_ID'] . ": </td><td>$rid</strong></td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_SUBMITTER'] . ": </td><td>$modifysubmitter</td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_PAGETITLE'] . ": </td><td><input type=\"text\" name=\"title\" value=\"$title\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE_URL']. ": </td><td><input type=\"text\" name=\"image\" size=\"75\" maxlength=\"100\" value=\"$image\" /></td></tr>\n";
if ( !empty( $image ) ) {
    echo "<tr><td align=\"left\">". $lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'] ."</td><td><img src=\"$image\" /></td></tr>\n";
}
echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_URL'] . ": </td><td><input type=\"text\" name=\"url\" value=\"$url\" size=\"75\" maxlength=\"100\" />&nbsp;[ <a href=\"index.php?url=$url\" target=\"_blank\">" . $lang_new[$module_name]['VISIT'] . "</a> ]</td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
echo Make_TextArea('description',$description, 'revieweditbroken');
echo "</td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_HEADER'] . "</td><td>";
echo Make_TextArea('reviewheader',$reviewheader,'revieweditbroken');
echo "</td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_BODY'] . "</td><td>";
echo Make_TextArea('reviewbody',$reviewbody,'revieweditbroken');
echo "</td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_FOOTER'] . "</td><td>";
echo Make_TextArea('reviewfooter',$reviewfooter,'revieweditbroken');
echo "</td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_SIGNATURE'] . "</td><td>";
echo Make_TextArea('reviewsignature',$reviewsignature,'revieweditbroken');
echo "</td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['NAME'] . ": </td><td><input type=\"text\" name=\"username\" size=\"75\" maxlength=\"100\" value=\"$name\" /></td></tr>\n";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['EMAIL'] . ": </td><td><input type=\"text\" name=\"email\" size=\"75\" maxlength=\"100\" value=\"$email\" /></td></tr>\n";
echo "<input type=\"hidden\" name=\"rid\" value=\"$rid\" />";
echo "<input type=\"hidden\" name=\"hits\" value=\"$hits\" />";
echo "<tr><td align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
echo "<select name=\"cat\">";
$result = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` ORDER BY `title`");
while ($row = $db->sql_fetchrow($result)) {
    $cid2 = intval($row['cid']);
    $ctitle2 = $row['title'];
    $parentid2 = intval($row['parentid']);
    if ($cid2 == $cid) {
      $sel = "selected";
    } else {
        $sel = "";
    }
    if ($parentid2!=0) {
        $ctitle2=reviewgetparent($parentid2,$ctitle2);
    }
    echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
}
echo "</select></td></tr>\n";
echo "</table>\n";
echo "<input type=\"hidden\" name=\"op\" value=\"ReviewsModReviewS\" />\n";
echo "<input type=\"hidden\" name=\"rid\" value=\"$rid\" />\n";
echo "<center><input type=\"submit\" value=" . $lang_new[$module_name]['SUBMIT_MODIFY'] . " /></center>\n";
echo "<center>[ <a href=\"".$admin_file.".php?op=ReviewsDelNew&amp;rid=$rid\">" . $lang_new[$module_name]['SUBMIT_DELETE'] . "</a> ]</center>\n";
echo "</form>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>