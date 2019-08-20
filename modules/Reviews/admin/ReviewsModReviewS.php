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


$cat = explode("-", $cat);
if (empty($cat[1])) {
    $cat[1] = 0;
}
/* Check if Title exist */
if (empty($title)) {
    reviewsHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        ."<strong>" . $lang_new[$module_name]['ERROR_NO_TITLE'] . "</strong><br />"
        .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}
$title = $_GETVAR->fixQuotes($title);
$image = $_GETVAR->fixQuotes($image);
/* Check if URL exist */
if (empty($url)) {
    $reviewheader = $_GETVAR->fixQuotes($reviewheader);
    $reviewbody = $_GETVAR->fixQuotes($reviewbody);
    $reviewfooter = $_GETVAR->fixQuotes($reviewfooter);
    $reviewsignature = $_GETVAR->fixQuotes($reviewsignature);
    $sqlurl = '';
} else {
    Validate($url,'url',$lang_new[$module_name]['REVIEWS']);
    $reviewheader = '';
    $reviewbody = '';
    $reviewfooter = '';
    $reviewsignature = '';
    $url = $_GETVAR->fixQuotes($url);
    $sqlurl = "OR `url`='$url'";
}
/* Check if Description exist */
if (empty($description)) {
    reviewsHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        ."<strong>" . $lang_new[$module_name]['ERROR_NO_DESCRIPTION'] . "</strong><br />"
        . $lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

$description = $_GETVAR->fixQuotes($description);
$name = $_GETVAR->fixQuotes($username);
$email = $_GETVAR->fixQuotes($email);
if (!empty($email)) {
     Validate($email,'email',$lang_new[$module_name]['REVIEWS']);
}

$num_new = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `title`='$title' $sqlurl"));

if ($num_new > 1 ) {
    reviewsHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        ."<strong>" . $lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] . "</strong><br />"
        . $lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
    echo "</span></center>";
    CloseTable();
} else {
    $db->sql_query("UPDATE `"._REVIEWS_REVIEWS_TABLE."` set `cid`='$cat[0]', `sid`='$cat[1]', `title`='$title', `image`='$image', `url`='$url', `description`='$description', `name`='$name', `email`='$email', `hits`='$hits', `header`='$reviewheader', `body`='$reviewbody', `footer`='$reviewfooter', `signature`='$reviewsignature' WHERE `rid`='$rid'");
    // Has the link been submitted for modification? we edited it so let's remove it FROM the modrequest table
    $sql = "SELECT * FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `rid`='$rid'";
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
        $db->sql_query("DELETE FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `rid`='$rid'");
    /*****[BEGIN]******************************************
     [ Base:    Caching System                     v3.0.0 ]
     ******************************************************/
        $cache->delete('numbrokenr', 'submissions');
        $cache->delete('nummodreqr', 'submissions');
    /*****[END]********************************************
     [ Base:    Caching System                     v3.0.0 ]
     ******************************************************/
    }
    reviewsHeader();
    OpenTable();
    echo "<center><span class=\"option\">";
    echo  $lang_new[$module_name]['MESSAGE_REVIEW_MODIFIED'] . "<br />";
    echo "</span></center>";
    CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');

?>