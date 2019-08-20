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
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_REVIEW_VALIDATE'] . "</strong></span></center><br /><br />\n";
$result = $db->sql_query("SELECT `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `header`, `footer`, `body`, `signature`, `name`, `email`, `submitter`, `date` FROM `"._REVIEWS_NEWREVIEW_TABLE."` WHERE `rid`='$rid'" );
$numrows = $db->sql_numrows($result);
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_REVIEW_VALIDATE'] . "</strong></span></center><br /><br />\n";
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"reviewadminvalidation\">";
echo "<table width=\"100%\" border=\"0\">\n";
if ($numrows>0) {
    while($row = $db->sql_fetchrow($result)) {
        $rid = intval($row['rid']);
        $cid = intval($row['cid']);
        $title = stripslashes($row['title']);
        $image = $row['image'];
        $url = $row['url'];
        $description = stripslashes($row['description']);
        $name = $row['name'];
        $email = $row['email'];
        $date = intval($row['date']);
        $reviewheader = $row['header'];
        $reviewfooter = $row['footer'];
        $reviewbody = $row['body'];
        $reviewsignature = $row['signature'];
        $submitter = $row['submitter'];
        if (empty($submitter)) {
            $submitter = $lang_new[$module_name]['NONE'];
        }
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"adminreviewvalidation\">";
        echo "<table width=\"100%\" border=\"0\">\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_ID'] . ": </td><td><strong>$rid</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_PAGETITLE'] . ": </td><td><input type=\"text\" name=\"title\" value=\"$title\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE_URL']. ": </td><td><input type=\"text\" name=\"image\" size=\"75\" maxlength=\"100\" value=\"$image\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_URL'] . ": </td><td><input type=\"text\" name=\"url\" value=\"$url\" size=\"75\" maxlength=\"100\" />&nbsp;[ <a href=\"index.php?url=$url\" target=\"_blank\">". $lang_new[$module_name]['VISIT'] ."</a> ]</td></tr>";
        if ($image !='http://' && !empty($image) ){
            echo "<tr><td bgcolor='$bgcolor2' align=\"left\">";
            echo "<span class=\"option\">".$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW']."</span></td><td>";
            echo "<img src=\"$image\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\" /></td></tr>\n";
        }
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
        echo Make_TextArea('description',$description, 'adminreviewvalidation', '100%', '100px');
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_HEADER'] . "</td><td>";
        echo Make_TextArea('reviewheader',$reviewheader,'adminreviewvalidation', '100%', '100px');
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_BODY'] . "</td><td>";
        echo Make_TextArea('reviewbody',$reviewbody,'adminreviewvalidation', '100%', '100px');
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_FOOTER'] . "</td><td>";
        echo Make_TextArea('reviewfooter',$reviewfooter,'adminreviewvalidation', '100%', '100px');
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_SIGNATURE'] . "</td><td>";
        echo Make_TextArea('reviewsignature',$reviewsignature,'adminreviewvalidation', '100%', '100px');
        echo "</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['NAME'] . ": </td><td><input type=\"text\" name=\"name\" size=\"75\" maxlength=\"100\" value=\"$name\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['EMAIL'] . ": </td><td><input type=\"text\" name=\"email\" size=\"75\" maxlength=\"100\" value=\"$email\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_SUBMITTER']. ": </td><td><input type=\"text\" name=\"submitter\" size=\"75\" maxlength=\"100\" value=\"$submitter\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_SUBMIT_DATE'] . ": </td><td>".(($date > 0) ? formatTimestamp($date) : 0)."</td></tr>";
        echo "<input type=\"hidden\" name=\"rid\" value=\"$rid\" />";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td>";
        echo "<td><select name=\"cat\">";
        $result2 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` ORDER BY `title`");
        while($row2 = $db->sql_fetchrow($result2)) {
            $cid2 = intval($row2['cid']);
            $ctitle2 = stripslashes($row2['title']);
            $parentid2 = $row2['parentid'];
            if ($cid2==$cid) {
                $sel = "selected";
            } else {
                $sel = "";
            }
            if ($parentid2 != 0) {
                $ctitle2 = reviewgetparent($parentid2,$ctitle2);
            }
            echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
        }
        echo "</select></td></tr>\n";
        $db->sql_freeresult($result2);
    }
    $db->sql_freeresult($result);
    echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\" />";
    echo "</table><br />\n";
    echo "<input type=\"hidden\" name=\"op\" value=\"ReviewsAddReview\" />";
    echo "<input type=\"hidden\" name=\"new\" value=\"1\" />";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_ADD'] . "\" /></center><br />";
    echo "<center>[ <a href=\"".$admin_file.".php?op=ReviewsDelNew&amp;rid=$rid\">" . $lang_new[$module_name]['SUBMIT_DELETE'] . "</a> ]</center>";
    echo "</form>";
} else {
    echo "</table>\n";
    echo "</form>";
    echo "<center>". $lang_new[$module_name]['WARN_REVIEW_NOT_FOUND'] ."</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>