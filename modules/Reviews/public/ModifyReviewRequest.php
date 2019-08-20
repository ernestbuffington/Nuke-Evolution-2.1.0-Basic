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

if (!defined('MODULE_FILE') || !defined('REVIEW_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');
if(is_user()) {
    $ratinguser = $userinfo['username'];
} else {
    $ratinguser = '';
}
ReviewHeading();
echo "<br />";
OpenTable();
if ( ($reviewsconfig['blockunregmodify'] == 1) && empty($ratinguser)) {
    echo "<br /><center>".$lang_new[$module_name]['INFO_ONLYREGISTERED']."<br /></center>";
} else {
    $result = $db->sql_query("SELECT `cid`, `sid`, `title`, `image`, `url`, `description`, `header`, `footer`, `body`, `signature` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='$rid'");
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['MODIFY_REVIEW_REQUEST'] . "</strong></span></center>\n";
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['REVIEW_ID'] . ": $rid</strong></span></center><br /><br />\n";
    echo "<form method=\"post\" action=\"modules.php?name=$module_name\" name=\"modifyreviewrequest\">";
    echo "<table width=\"100%\" border=\"0\">\n";
    while($row = $db->sql_fetchrow($result)) {
        $cid = intval($row['cid']);
        $sid = intval($row['sid']);
        $title = stripslashes($row['title']);
        $image = $row['image'];
        $url = $row['url'];
        $description = stripslashes($row['description']);
        $reviewheader = $row['header'];
        $reviewfooter = $row['footer'];
        $reviewbody = $row['body'];
        $reviewsignature = $row['signature'];
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_PAGETITLE'] . " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$title</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_PAGETITLE'] . ": </td><td><input type=\"text\" name=\"title\" value=\"$title\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE_URL']. " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$image</td></tr>\n";
        if ($reviewsconfig['reviewimgurlallowed'] == 1) {
            echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE_URL']. " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td><input type=\"text\" name=\"image\" size=\"75\" maxlength=\"100\" value=\"$image\" /></td></tr>\n";
            echo "<tr><td bgcolor='$bgcolor2' ></td><td>".$lang_new[$module_name]['INFO_REVIEW_IMGURL']."<br /></td></tr>\n";
        }
        $result11 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid` = $cid");
        $row11 = $db->sql_fetchrow($result11);
        $cid11 = intval($row11['cid']);
        $ctitle11 = stripslashes($row11['title']);
        $parentid11 = intval($row11['parentid']);
        if ($parentid11 != 0) {
            $ctitle11 = reviewgetparent($parentid11,$ctitle11);
        }
        $db->sql_freeresult($result11);
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['CATEGORY'] . " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$ctitle11</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
        $result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` ORDER BY `title`");
        echo "<select name=\"cat\">";
        while($row2 = $db->sql_fetchrow($result1)) {
            $cid2 = intval($row2['cid']);
            $ctitle2 = stripslashes($row2['title']);
            $parentid2 = intval($row2['parentid']);
            if ($cid2 == $cid) {
                $sel = "selected";
            } else {
                $sel = "";
            }
            if ($parentid2 != 0) {
                $ctitle2 = reviewgetparent($parentid2,$ctitle2);
            }
            echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
        }
        $db->sql_freeresult($result1);
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_URL'] . " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$url</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_URL'] . ": </td><td><input type=\"text\" name=\"url\" value=\"$url\" size=\"75\" maxlength=\"100\" value=\"\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$description</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . "</td><td>";
        echo Make_TextArea('description',$description,'modifyreviewrequest', '100%', '100px');
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_HEADER'] . " " .$lang_new[$module_name]['ORIGINAL'] ."</td><td bgcolor='$bgcolor2' >$reviewheader</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_HEADER'] . "</td><td>";
        echo Make_TextArea('reviewheader',$reviewheader,'modifyreviewrequest', '100%', '100px');
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_BODY'] . " " .$lang_new[$module_name]['ORIGINAL'] ."</td><td bgcolor='$bgcolor2' >$reviewbody</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_BODY'] . "</td><td>";
        echo Make_TextArea('reviewbody',$reviewbody,'modifyreviewrequest', '100%', '100px');
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_FOOTER'] . " " .$lang_new[$module_name]['ORIGINAL'] ."</td><td bgcolor='$bgcolor2' >$reviewfooter</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_FOOTER'] . "</td><td>";
        echo Make_TextArea('reviewfooter',$reviewfooter,'modifyreviewrequest', '100%', '100px');
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_SIGNATURE'] . " " .$lang_new[$module_name]['ORIGINAL'] ."</td><td bgcolor='$bgcolor2' >$reviewsignature</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_SIGNATURE'] . "</td><td>";
        echo Make_TextArea('reviewsignature',$reviewsignature,'modifyreviewrequest', '100%', '100px');
        echo "</td></tr>\n";
    }
    echo "</table>";
    if ($reviewsconfig['securitycheck'] == 1) {
        echo "<center>".security_code(1,'small', 1)."</center><br />\n";
    }
    echo "<input type=\"hidden\" name=\"rid\" value=\"$rid\" />"
        ."<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\" />"
        ."<input type=\"hidden\" name=\"op\" value=\"modifyreviewrequestS\" />"
        ."<center><input type=\"submit\" value=\"".$lang_new[$module_name]['SUBMIT_MODIFY_REQUEST']."\" /></center></form>";
    $db->sql_freeresult($result);
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>