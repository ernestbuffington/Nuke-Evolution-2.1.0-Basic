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

$module_name = basename(dirname(dirname(__FILE__)));

if(!is_mod_admin($module_name)) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

define('IN_REVIEWS_ADMIN', TRUE);

global $db, $admin_file, $currentlang, $cache, $reviewsconfig;

get_lang($module_name);

/*********************************************************/
/* Reviews Modified Reviews                              */
/*********************************************************/

include_once(NUKE_MODULES_DIR.$module_name.'/admin/functions.php');
$reviewsconfig = ReviewsConfig();

$cat                = $_GETVAR->get('cat', '_REQUEST', 'int');
$cdescription       = $_GETVAR->get('cdescription', '_REQUEST');
$cid                = $_GETVAR->get('cid', '_REQUEST', 'int');
$cidfrom            = $_GETVAR->get('cidfrom', '_REQUEST', 'int');
$cidto              = $_GETVAR->get('cidto', '_REQUEST', 'int');
$description        = $_GETVAR->get('description', '_REQUEST');
$editorialtext      = $_GETVAR->get('editorialtext', '_REQUEST');
$editorialtitle     = $_GETVAR->get('editorialtitle', '_REQUEST');
$email              = $_GETVAR->get('email', '_REQUEST', 'email');
$hits               = $_GETVAR->get('hits', '_REQUEST', 'int');
$image              = $_GETVAR->get('image', '_REQUEST');
$imageurl           = $_GETVAR->get('imageurl', '_REQUEST', 'url');
if (!empty($imageurl)) {
    $image = $imageurl;
}
$rid                = $_GETVAR->get('rid', '_REQUEST', 'int');
$reviewid           = $_GETVAR->get('reviewid', '_REQUEST', 'int');
$username           = $_GETVAR->get('username', '_REQUEST');
$new                = $_GETVAR->get('new', '_REQUEST', 'int');
$rrdbid             = $_GETVAR->get('rrdbid', '_REQUEST', 'int');
$ok                 = $_GETVAR->get('ok', '_REQUEST', 'int');
$op                 = $_GETVAR->get('op', '_REQUEST');
$sid                = $_GETVAR->get('sid', '_REQUEST', 'int');
$sub                = $_GETVAR->get('sub', '_REQUEST', 'int');
$submitter          = $_GETVAR->get('submitter', '_REQUEST');
$requestid          = $_GETVAR->get('requestid', '_REQUEST', 'int');
$title              = $_GETVAR->get('title', '_REQUEST');
$ttitle             = $_GETVAR->get('ttitle', '_REQUEST');
$url                = $_GETVAR->get('url', '_REQUEST', 'url');

$block_rows         = $_GETVAR->get('block_rows', '_REQUEST', 'int');
$topbox_scroll      = $_GETVAR->get('topbox_scroll', '_REQUEST', 'int');
$block_scroll       = $_GETVAR->get('block_scroll', '_REQUEST', 'int');
$topbox_scroll_amount   = $_GETVAR->get('topbox_scroll_amount', '_REQUEST', 'int');
$block_scroll_amount    = $_GETVAR->get('block_scroll_amount', '_REQUEST', 'int');
$topbox_scroll_direction= $_GETVAR->get('topbox_scroll_direction', '_REQUEST', 'int');
$block_scroll_direction = $_GETVAR->get('block_scroll_direction', '_REQUEST', 'int');
$block_height       = $_GETVAR->get('block_height', '_REQUEST', 'int');
$topbox_height      = $_GETVAR->get('topbox_height', '_REQUEST', 'int');
$block_image_width  = $_GETVAR->get('block_image_width', '_REQUEST');
$block_image_height = $_GETVAR->get('block_image_height', '_REQUEST');
$block_line_breaks  = $_GETVAR->get('block_line_breaks', '_REQUEST', 'int');
$tablecolor1        = $_GETVAR->get('tablecolor1', '_REQUEST');
$tablecolor2        = $_GETVAR->get('tablecolor2', '_REQUEST');
$review_box         = $_GETVAR->get('review_box', '_REQUEST', 'int');
$maxshow            = $_GETVAR->get('maxshow', '_REQUEST');
$image_width        = $_GETVAR->get('image_width', '_REQUEST');
$image_height       = $_GETVAR->get('image_height', '_REQUEST');
$reviews_perpage    = $_GETVAR->get('reviews_perpage', '_REQUEST', 'int');
$popular            = $_GETVAR->get('popular', '_REQUEST', 'int');
$newreviews         = $_GETVAR->get('newreviews', '_REQUEST', 'int');
$topreviews         = $_GETVAR->get('topreviews', '_REQUEST', 'int');
$reviewsresults     = $_GETVAR->get('reviewsresults', '_REQUEST', 'int');
$anonaddreviewlock  = $_GETVAR->get('anonaddreviewlock', '_REQUEST', 'int');
$allow_guest_vote   = $_GETVAR->get('allow_guest_vote', '_REQUEST', 'int');
$anonwaitdays       = $_GETVAR->get('anonwaitdays', '_REQUEST', 'int');
$outsidewaitdays    = $_GETVAR->get('outsidewaitdays', '_REQUEST', 'int');
$useoutsidevoting   = $_GETVAR->get('useoutsidevoting', '_REQUEST', 'int');
$anonweight         = $_GETVAR->get('anonweight', '_REQUEST', 'int');
$outsideweight      = $_GETVAR->get('outsideweight', '_REQUEST', 'int');
$detailvotedecimal  = $_GETVAR->get('detailvotedecimal', '_REQUEST', 'int');
$mainvotedecimal    = $_GETVAR->get('mainvotedecimal', '_REQUEST', 'int');
$topreviewspercentrigger  = $_GETVAR->get('topreviewspercentrigger', '_REQUEST', 'int');
$topreviews         = $_GETVAR->get('topreviews', '_REQUEST', 'int');
$mostpopreviewspercentrigger = $_GETVAR->get('mostpopreviewspercentrigger', '_REQUEST', 'int');
$mostpopreviews     = $_GETVAR->get('mostpopreviews', '_REQUEST', 'int');
$featurebox         = $_GETVAR->get('featurebox', '_REQUEST', 'int');
$reviewvotemin      = $_GETVAR->get('reviewvotemin', '_REQUEST', 'int');
$blockunregmodify   = $_GETVAR->get('blockunregmodify', '_REQUEST', 'int');
$securitycheck      = $_GETVAR->get('securitycheck', '_REQUEST', 'int');
$check              = $_GETVAR->get('check', '_REQUEST', 'int');
$date               = $_GETVAR->get('date', '_REQUEST', 'int');
$thumbnail_use      = $_GETVAR->get('thumbnail_use', '_REQUEST', 'int');
$thumbnail_url      = $_GETVAR->get('thumbnail_url', '_REQUEST', 'url');
$reviewheader       = $_GETVAR->get('reviewheader', '_REQUEST');
$reviewbody         = $_GETVAR->get('reviewbody', '_REQUEST');
$reviewfooter       = $_GETVAR->get('reviewfooter', '_REQUEST');
$reviewsignature    = $_GETVAR->get('reviewsignature', '_REQUEST');
$show_header          = $_GETVAR->get('show_header', '_POST', 'int');
$show_topbox          = $_GETVAR->get('show_topbox', '_POST', 'int');
$info               = $_GETVAR->get('info', '_REQUEST');

switch ($op) {

    case 'Reviews':
    reviews();
    break;

    case 'ReviewsDelNew':
    ReviewsDelNew($rid);
    break;

    case 'ReviewsAddCat':
    ReviewsAddCat($title, $image, $cdescription);
    break;

    case 'ReviewsAddSubCat':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsAddSubCat.php');
    break;

    case 'ReviewsAddReview':
    include(NUKE_MODULES_DIR.$module_name.'/admin/AddNewReviewS.php');
    break;

    case 'ReviewsAddEditorial':
    ReviewsAddEditorial($reviewid, $editorialtitle, $editorialtext);
    break;

    case 'ReviewsModEditorial':
    ReviewsModEditorial($reviewid, $editorialtitle, $editorialtext);
    break;

    case 'ReviewsLinkCheck':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsLinkCheck.php');
    break;

    case 'ReviewsValidate':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsValidate.php');
    break;

    case 'ReviewsDelEditorial':
    ReviewsDelEditorial($reviewid);
    break;

    case 'ReviewsCleanVotes':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsCleanVotes.php');
    break;

    case 'ReviewsListBrokenReviews':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsListBrokenReviews.php');
    break;

    case 'ReviewsEditBrokenReviews':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsEditBrokenReviews.php');
    break;

    case 'ReviewsDelBrokenReviews':
    ReviewsDelBrokenReviews($rid);
    break;

    case 'ReviewsIgnoreBrokenReviews':
    ReviewsIgnoreBrokenReviews($rid);
    break;

    case 'ReviewsListModRequests':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsListModRequests.php');
    break;

    case 'ReviewsChangeModRequests':
    ReviewsChangeModRequests($requestid);
    break;

    case 'ReviewsChangeIgnoreRequests':
    ReviewsChangeIgnoreRequests($requestid);
    break;

    case 'ReviewsDelCat':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsDelCat.php');
    break;

    case 'ReviewsModCat':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsModCat.php');
    break;

    case 'ReviewsModCatS':
    ReviewsModCatS($cid, $sid, $sub, $title, $image, $cdescription);
    break;

    case 'ReviewsModReview':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsModReview.php');
    break;

    case 'ReviewsModReviewS':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsModReviewS.php');
    break;

    case 'ReviewsDelReview':
    ReviewsDelReview($rid);
    break;

    case 'ReviewsDelVote':
    ReviewsDelVote($rid, $rrdbid);
    break;

    case 'ReviewsDelComment':
    ReviewsDelComment($rid, $rrdbid);
    break;

    case 'ReviewsTransfer':
    ReviewsTransfer($cidfrom,$cidto);
    break;


    case 'ReviewsSettings':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsSettings.php');
    break;

    case 'ReviewsSaveSettings':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsSettingsS.php');
    break;

    case 'ReviewsAddMainCategory':
    ReviewsAddMainCategory();
    break;

    case 'ReviewsSaveSubCat':
    ReviewsSaveSubCat($cid, $title, $image, $cdescription);
    break;

    case 'ReviewsSelectModifyCategory':
    ReviewsSelectModifyCategory();
    break;

    case 'AddNewReview':
    include(NUKE_MODULES_DIR.$module_name.'/admin/AddNewReview.php');
    break;

    case 'ReviewAdminValidation':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsAdminValidation.php');
    break;

    case 'ReviewsListNewReviews':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewsListNewReviews.php');
    break;

    case 'SelectModifyReview':
    SelectModifyReview();
    break;

    case 'ReviewTransferCat':
    include(NUKE_MODULES_DIR.$module_name.'/admin/ReviewTransferCat.php');
    break;
}

?>