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
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_MODIFY_REVIEW_REQUEST'] . "</strong></span></center><br /><br />\n";
$result = $db->sql_query("SELECT `requestid`, `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `header`, `footer`, `body`, `signature`, `modifysubmitter`, `date` FROM `". _REVIEWS_MODREQUEST_TABLE . "` WHERE `brokenreview` = '0' ORDER BY `requestid`");
$totalmodrequests1 = $db->sql_numrows($result);
if ($totalmodrequests1 == 0) {
    echo "<center>" . $lang_new[$module_name]['WARN_REVIEW_NOT_FOUND'] . "</center><br />";
} elseif ( empty($requestid) && ($totalmodrequests1 > 1) ) {
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectreviewrequest\">";
    echo "<table width=\"100%\" border=\"0\">\n";
    $result1 = $db->sql_query("SELECT `requestid`, `rid`, `title` FROM `"._REVIEWS_MODREQUEST_TABLE."` ORDER BY `date` DESC");
    echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_ID'] . ": ";
    echo "&nbsp;";
    echo "<select name=\"requestid\">";
    while($row = $db->sql_fetchrow($result1)) {
        $rid = intval($row['rid']);
        $requestid = intval($row['requestid']);
        $title = stripslashes($row['title']);
        echo "<option value=\"$requestid\">$title</option>";
    }
    $db->sql_freeresult($result1);
    echo "</select>\n";
    echo "&nbsp;";
    echo "<select name=\"op\">";
    echo "<option value=\"ReviewsListModRequests\" selected='selected'>".$lang_new[$module_name]['MODIFY']."</option>\n";
    echo "<option value=\"ReviewsDelModRequest\">".$lang_new[$module_name]['DELETE']."</option></select>\n";
    echo "<input type=\"submit\" value=\"".$lang_new[$module_name]['OK']."\" />\n";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>\n";
} else {
    if ($totalmodrequests1 == 1) {
        $result1 = $db->sql_query("SELECT `requestid`, `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `header`, `footer`, `body`, `signature`, `modifysubmitter`, `date` FROM `"._REVIEWS_MODREQUEST_TABLE."`");
    } else {
        $result1 = $db->sql_query("SELECT `requestid`, `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `header`, `footer`, `body`, `signature`, `modifysubmitter`, `date` FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `requestid`='$requestid'");
    }
    $row1 = $db->sql_fetchrow($result1);
    $rid_new = intval($row1['rid']);
    $cid_new = intval($row1['cid']);
    $sid_new = intval($row1['sid']);
    $title_new = stripslashes($row1['title']);
    $image_new = $row1['image'];
    $url_new = $row1['url'];
    $description_new = stripslashes($row1['description']);
    $reviewheader_new = $row1['header'];
    $reviewfooter_new = $row1['footer'];
    $reviewbody_new = $row1['body'];
    $reviewsignature_new = $row1['signature'];
    $requestid_new = $row1['requestid'];
    $result = $db->sql_query("SELECT `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `header`, `footer`, `body`, `signature` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='".$row1['rid']."'");
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['MODIFY_REVIEW_REQUEST'] . "</strong></span></center>\n";
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['REVIEW_ID'] . ": ".$row1['rid']."<p dir=\"ltr\" style=\"margin-left: 20px; margin-right: 0px\"></p></strong></span></center><br /><br />\n";
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
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_REQUEST_SUBMITTER'] .": </td><td bgcolor='$bgcolor2' >". $row1['modifysubmitter']."</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DATE'] .": </td><td bgcolor='$bgcolor2' 4>". formatTimestamp($row1['date']) ."</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_PAGETITLE'] . " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$title</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_PAGETITLE'] . ": </td><td>$title_new</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE_URL']. " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$image</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE_URL']. ": </td><td>$image_new</td></tr>\n";
        $result11 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid` = $cid");
        $row11 = $db->sql_fetchrow($result11);
        $cid11 = intval($row11['cid']);
        $ctitle11 = stripslashes($row11['title']);
        $parentid11 = intval($row11['parentid']);
        if ($parentid11 != 0) {
          $ctitle11 = reviewgetparent($parentid11,$ctitle11);
        }
        $db->sql_freeresult($result11);
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['CATEGORY'] . " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$ctitle11</td></tr>\n";
        $result12 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid` = '".$row1['cid']."'");
        $row12 = $db->sql_fetchrow($result12);
        $cid12 = intval($row12['cid']);
        $ctitle12 = stripslashes($row12['title']);
        $parentid11 = intval($row12['parentid']);
        if ($parentid11 != 0) {
          $ctitle11 = reviewgetparent($parentid12,$ctitle12);
        }
        $db->sql_freeresult($result12);
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>$ctitle12</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_URL'] . " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$url</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_URL'] . ": </td><td>$url_new</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . " " .$lang_new[$module_name]['ORIGINAL'] .": </td><td bgcolor='$bgcolor2' >$description</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ":</td><td>$description_new</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_HEADER'] . " " .$lang_new[$module_name]['ORIGINAL'] .":</td><td bgcolor='$bgcolor2' >$reviewheader</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_HEADER'] . ":</td><td>$reviewheader_new</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_BODY'] . " " .$lang_new[$module_name]['ORIGINAL'] .":</td><td bgcolor='$bgcolor2' >$reviewbody</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_BODY'] . ":</td><td>$reviewbody_new</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_FOOTER'] . " " .$lang_new[$module_name]['ORIGINAL'] .":</td><td bgcolor='$bgcolor2' >$reviewfooter</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_FOOTER'] . ":</td><td>$reviewfooter_new</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_SIGNATURE'] . " " .$lang_new[$module_name]['ORIGINAL'] .":</td><td bgcolor='$bgcolor2' >$reviewsignature</td></tr>\n";
        echo "<tr><td width=\"25%\" bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_SIGNATURE'] . ":</td><td>$reviewsignature_new</td></tr>\n";
    }
    echo "</table>";
    echo "<center><span class=\"tiny\">[<a href=\"".$admin_file.".php?op=ReviewsChangeModRequests&amp;requestid=$requestid\">" . $lang_new[$module_name]['SUBMIT_ACCEPT'] . "</a>]</center></span><br />";
    echo "<center><span class=\"tiny\">[<a href=\"".$admin_file.".php?op=ReviewsChangeIgnoreRequests&amp;requestid=$requestid\">" . $lang_new[$module_name]['IGNORE'] . "</a>]</center></span><br />";
    $db->sql_freeresult($result);
    $db->sql_freeresult($result1);
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>