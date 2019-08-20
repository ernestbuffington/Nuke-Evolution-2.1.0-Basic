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
ReviewHeading();

global $userinfo, $module_name, $lang_new, $reviewsconfig;

OpenTable();
$numrows  = $db->sql_unumrows("SELECT `cid`, `title` FROM `"._REVIEWS_CATEGORIES_TABLE."`");
echo "<center><span class='option'><strong>" . $lang_new[$module_name]['ADD_REVIEW'] . "</strong></span></center><br /><br />\n";
if ( $numrows>0 && (($reviewsconfig['anonaddreviewlock'] == 1) || is_user()) ) {
    echo "<form method='post' action='modules.php?name=".$module_name."&amp;op=AddReviewSave' name='addnewreview'>";
    OpenTable2();
    echo "<table width='100%' border='0'>\n";
    echo "<tr><td><center><strong>".$lang_new[$module_name]['INSTRUCTIONS'].":</strong></center></td></tr>";
    echo "<tr><td><center>".$lang_new[$module_name]['INFO_ONLYONCE']."</center></td></tr>";
    echo "<tr><td><center>".$lang_new[$module_name]['INFO_PENDING']."</center></td></tr>";
    echo "<tr><td><center>".$lang_new[$module_name]['WARN_RECORDED']."</center></td></tr>";
    echo "<tr><td><center>".$lang_new[$module_name]['PICSIZE']."  ".$lang_new[$module_name]['PICSIZE_WIDTH'].": ".$reviewsconfig['image_width']." x ".$lang_new[$module_name]['PICSIZE_HEIGHT'].": ".$reviewsconfig['image_height']."  ".$lang_new[$module_name]['IMAGE_PIXEL']."</center></td></tr>";
    echo "</table>\n";
    CloseTable2();
    echo "<br />";
    echo "<table width='100%' border='0'>\n";
    echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['REVIEW_PAGETITLE'] . ": </td><td><input type='text' name='title' size='75' maxlength='100' /></td></tr>\n";
    if ($reviewsconfig['reviewimgurlallowed'] == 1) {
        echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['REVIEW_IMAGE_URL']. ": </td><td><input type='text' name='image' size='75' maxlength='100' value='' /></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor2."' ></td><td>".$lang_new[$module_name]['INFO_REVIEW_IMGURL']."<br /></td></tr>\n";
    }
    $result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` ORDER BY `title`");
    echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
    echo "<select name='cat'>";
    while($row = $db->sql_fetchrow($result1)) {
        $cid2 = intval($row['cid']);
        $ctitle2 = stripslashes($row['title']);
        $parentid2 = intval($row['parentid']);
        if ($parentid2!=0) {
            $ctitle2=reviewgetparent($parentid2,$ctitle2);
        }
        echo "<option value='$cid2'>$ctitle2</option>";
    }
    $db->sql_freeresult($result1);
    echo "</select></td></tr>\n";
    echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['DESCRIPTION'] . "</td><td>";
    echo Make_TextArea('description',$description,'addnewreview');
    echo "</td></tr>\n";
    if ($reviewsconfig['reviewurlallowed'] == 1) {
        echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['REVIEW_URL'] . ": </td><td><input type='text' name='url' size='75' maxlength='100' value='' /><br />\n";
        echo $lang_new[$module_name]['INFO_REVIEW_URL']."<br /><br /></td></tr>\n";
    }
    echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['REVIEW_HEADER'] . "</td><td>";
    echo Make_TextArea('reviewheader',$reviewheader,'addnewreview');
    echo "</td></tr>\n";
    echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['REVIEW_BODY'] . "</td><td>";
    echo Make_TextArea('reviewbody',$reviewbody,'addnewreview');
    echo "</td></tr>\n";
    echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['REVIEW_FOOTER'] . "</td><td>";
    echo Make_TextArea('reviewfooter',$reviewfooter,'addnewreview');
    echo "</td></tr>\n";
    echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['REVIEW_SIGNATURE'] . "</td><td>";
    echo Make_TextArea('reviewsignature',$reviewsignature,'addnewreview');
    echo "</td></tr>\n";
    if ( is_user() ) {
        echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['NAME'] .": </td><td>".$userinfo['username'];
        echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['EMAIL'] .": </td><td>".$userinfo['user_email'];
        echo "<input type='hidden' name='email' value='".$userinfo['user_email']."' />";
        echo "<input type='hidden' name='username' value='".$userinfo['username']."' />";
    } else {
        echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['USER'] .": </td><td><input type='text' name='username' size='60' maxlength='60' /></td></tr>\n";
        echo "<tr><td bgcolor='".$bgcolor2."' align='left'>". $lang_new[$module_name]['EMAIL'] .": </td><td><input type='text' name='email' size='60' maxlength='60' /></td></tr>\n";
    }
    if ($reviewsconfig['securitycheck'] == 1) {
        echo "<tr><td bgcolor='".$bgcolor2."' align='left'></td><td>".security_code(1,'small', 1)."</td></tr>\n";
    }
    echo "</table><br />";
    echo "<input type='hidden' name='new' value='0' />";
    echo "<input type='hidden' name='submitter' value='".$userinfo['username']."' />";
    echo "<center><input type='submit' value='" . $lang_new[$module_name]['SUBMIT_ADD'] . "' /></center>\n";
    echo "</form>";
} else {
    if ( !($numrows > 0) ) {
        echo "<br /><br /><center>" . $lang_new[$module_name]['WARN_CAT_NOT_FOUND'] . "</center><br /><br />\n";
        echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
    } else {
        echo "<br /><br /><center>" . $lang_new[$module_name]['INFO_ONLYREGISTERED'] . "</center><br /><br />\n";
        echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
    }
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>