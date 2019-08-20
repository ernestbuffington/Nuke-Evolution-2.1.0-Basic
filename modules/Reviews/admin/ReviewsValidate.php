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
$transfertitle = str_replace ("_", " ", $ttitle);
/* Check ALL Links */
echo "<table width=\"100%\" border=\"0\">";
if ($cid == 0 && $sid == 0) {
    echo "<tr><td ><center><strong>" . $lang_new[$module_name]['ADMIN_REVIEW_CHECK_ALL'] . "</strong><br />" . $lang_new[$module_name]['BE_PATIENT'] . "</center><br /><br /></td></tr>";
    $result = $db->sql_query("SELECT `rid`, `title`, `image`, `url` FROM `"._REVIEWS_REVIEWS_TABLE."` ORDER BY `title`");
}
/* Check Categories & Subcategories */
if ($cid != 0 && $sid == 0) {
    echo "<tr><td ><center><strong>" . $lang_new[$module_name]['ADMIN_CAT_VALIDATE'] . ": $transfertitle</strong><br />" . $lang_new[$module_name]['BE_PATIENT'] . "</center><br /><br /></td></tr>";
    $result = $db->sql_query("SELECT `rid`, `title`, `image`, `url` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$cid' ORDER BY `title`");
}
/* Check Only Subcategory */
if ($cid == 0 && $sid != 0) {
   echo "<tr><td ><center><strong>" . $lang_new[$module_name]['ADMIN_CATSUB_VALIDATE'] . ": $transfertitle</strong><br />" . $lang_new[$module_name]['BE_PATIENT'] . "</center><br /><br /></td></tr>";
   $result = $db->sql_query("SELECT `rid`, `title`, `image`, `url` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `sid`='$sid' ORDER BY `title`");
}
echo "</table><table width=\"100%\" border=\"0\">\n";
echo "<tr><td width=\"20%\" bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . $lang_new[$module_name]['ADMIN_REVIEWS_STATUS'] . "</strong></td>";
echo "<td width=\"10%\" bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . $lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'] . "</strong></td>";
echo "<td width=\"50%\" bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . $lang_new[$module_name]['TITLE'] . "</strong></td>";
echo "<td width=\"20%\" bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . $lang_new[$module_name]['ADMIN_VALIDATE_OPTIONS'] . "</strong></td></tr>";
$x = 0;
while($row = $db->sql_fetchrow($result)) {
    $rid = intval($row['rid']);
    $title = stripslashes($row['title']);
    $image = stripslashes($row['image']);
    $url = stripslashes($row['url']);
    $vurl = parse_url($row['url']);
    $fp = @fsockopen($vurl['host'], 80, $errno, $errstr, 15);
    if ($x == 0) {
        $color = $bgcolor1;
       $x++;
    } else {
        $color = $bgcolor2;
        $x = 0;
    }
    if (!$fp){
        echo "<tr bgcolor=\"$color\"><td align=\"center\"><strong><span style=\"color:red\">" . $lang_new[$module_name]['ADMIN_VALIDATE_FAILED'] . "</span></strong></td>";
        echo "<td>";
        echo "<table width=\"100%\" border=\"0\"><tr><td>\n";
        if($image!='http://' && !empty($image) ){
            echo "<a href=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" target=\"_blank\"><img src=\"$image\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\" border=\"0\" alt=\"\" title=\"".$lang_new[$module_name]['VISIT']."\" valign=\"absmiddle\" /></a>";
        }elseif ( $reviewsconfig['thumbnail_use'] && !empty($reviewsconfig['thumbnail_url']) ) {
            echo "<a href=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" target=\"_blank\"><img src=\"".htmlentities($reviewsconfig['thumbnail_url'].$url, ENT_NOQUOTES)."\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\"  border=\"0\" title=\"".$lang_new[$module_name]['VISIT']."\" alt=\"\" /></a>";
        }else{
            echo "<a href=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" target=\"_blank\"><img src=\"".evo_image('blank.gif', $module_name)."\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\"  border=\"0\" alt=\"\" title=\"".$lang_new[$module_name]['VISIT']."\" /></a>";
        }
        echo "</td></tr></table>\n";
        echo "</td>";
        echo "<td><a href=\"$url\" target=\"_blank\">$title<br />";
        echo "</a></td>"
            ."<td align=\"center\"><span class=\"content\">[ <a href=\"".$admin_file.".php?op=ReviewsModReview&amp;rid=$rid\">" . $lang_new[$module_name]['EDIT'] . "</a> | <a href=\"".$admin_file.".php?op=ReviewsDelReview&amp;rid=$rid\">" . $lang_new[$module_name]['SUBMIT_DELETE'] . "</a> ]</span>"
            ."</td></tr>";
    }
    if ($fp){
        echo "<tr bgcolor=\"$color\" ><td align=\"center\"><span style=\"color:green\">" . $lang_new[$module_name]['OK'] . "</span></td>";
        echo "<td>";
        echo "<table width=\"100%\" border=\"0\"><tr><td>\n";
        if($image!='http://' && !empty($image) ){
            echo "<a href=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" target=\"_blank\"><img src=\"$image\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\" border=\"0\" alt=\"\" title=\"".$lang_new[$module_name]['VISIT']."\" valign=\"absmiddle\" /></a>";
        }elseif ( $reviewsconfig['thumbnail_use'] && !empty($reviewsconfig['thumbnail_url']) ) {
            echo "<a href=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" target=\"_blank\"><img src=\"".htmlentities($reviewsconfig['thumbnail_url'].$url, ENT_NOQUOTES)."\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\"  border=\"0\" title=\"".$lang_new[$module_name]['VISIT']."\" alt=\"\" /></a>";
        }else{
            echo "<a href=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" target=\"_blank\"><img src=\"".evo_image('blank.gif', $module_name)."\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\"  border=\"0\" alt=\"\" title=\"".$lang_new[$module_name]['VISIT']."\" /></a>";
        }
        echo "</td></tr></table>\n";
        echo "</td>";
        echo "<td><a href=\"$url\" target=\"_blank\">$title<br />";
        echo "</a></td>"
            ."<td align=\"center\"><span class=\"content\">" . $lang_new[$module_name]['NONE'] . "</span>"
            ."</td></tr>";
    }
}
$db->sql_freeresult($result);
echo "</table>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>