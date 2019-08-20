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

$url = $_GETVAR->fixQuotes($url);

/*****[BEGIN]******************************************
 [ Mod:    Advanced Security Code Control      v1.0.0 ]
 ******************************************************/
    if (!security_code_check($_POST['gfx_check'], 'force') && $reviewsconfig['securitycheck'] == 1) {
        //DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
    }
/*****[END]********************************************
 [ Mod:    Advanced Security Code Control      v1.0.0 ]
 ******************************************************/
// Check if Title exist
if (empty($title)) {
    $message = $lang_new[$module_name]['ERROR_NO_TITLE'] . '<br /><br /><center>'.$lang_new[$module_name]['SUBMIT_GOBACK'].'<br />';
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $message);
}
// Check if URL exist
if (empty($url)) {
    $reviewheader = $_GETVAR->fixQuotes($reviewheader);
    $reviewbody = $_GETVAR->fixQuotes($reviewbody);
    $reviewfooter = $_GETVAR->fixQuotes($reviewfooter);
    $reviewsignature = $_GETVAR->fixQuotes($reviewsignature);
} else {
    Validate($url,'url',$lang_new[$module_name]['REVIEWS']);
    $reviewheader = '';
    $reviewbody = '';
    $reviewfooter = '';
    $reviewsignature = '';
    $url = $_GETVAR->fixQuotes($url);
}
// Check if Description exist
if (empty($description)) {
    $message = $lang_new[$module_name]['ERROR_NO_DESCRIPTION'] . '<br /><br /><center>'.$lang_new[$module_name]['SUBMIT_GOBACK'].'<br />';
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $message);
}

$title = $_GETVAR->fixQuotes($title);
$image = $_GETVAR->fixQuotes($image);
$description = $_GETVAR->fixQuotes($description);
$name = $_GETVAR->fixQuotes($username);
$email = $_GETVAR->fixQuotes($email);
if (!empty($email)) {
     Validate($email,'email',$lang_new[$module_name]['REVIEWS']);
}
if (!empty($url)) {
    $num_new = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_NEWREVIEW_TABLE."` WHERE `title`='$title' OR `url`='$url' "));
    $num_new2 = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `title`='$title' OR `url`='$url' "));
} else {
    $num_new = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_NEWREVIEW_TABLE."` WHERE `title`='$title'"));
    $num_new2 = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `title`='$title'"));
}
if ($num_new > 0 || $num_new2 > 0) {
    $message = $lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] . '<br /><br /><center>'.$lang_new[$module_name]['SUBMIT_GOBACK'].'<br />';
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $message);
} else {
    $db->sql_query("INSERT INTO `"._REVIEWS_NEWREVIEW_TABLE."` (`rid`, `cid` , `sid` , `title` , `image`, `url`, `description` , `date`, `name` , `email` , `submitter`, `header`, `body`, `footer`, `signature` )
                      VALUES (NULL, '".$cat."', '0', '".$title."', '".$image."', '".$url."', '".$description."', '".time()."', '".$name."', '".$email."', '".$submitter."', '".$reviewheader."', '".$reviewbody."', '".$reviewfooter."', '".$reviewsignature."')");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numwaitr', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    ReviewHeading();
    OpenTable();
    echo "<center><strong>".$lang_new[$module_name]['MESSAGE_REVIEW_ADDED']."</strong><br />";
    if (!empty($email)) {
        echo $lang_new[$module_name]['MESSAGE_REVIEW_SUBMITTED_EMAIL'];
    } else {
        echo $lang_new[$module_name]['MESSAGE_REVIEW_SUBMITTED_NOEMAIL'];
    }
    echo "</center>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>