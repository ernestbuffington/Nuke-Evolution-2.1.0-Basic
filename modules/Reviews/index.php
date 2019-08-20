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

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

define('LIGHTBOX', true);

global $db, $currentlang;
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = $lang_new[$module_name]['REVIEWS'];
define('REVIEW_INDEX_FILE', true);

require_once(NUKE_MODULES_DIR.$module_name.'/public/functions.php');
$reviewsconfig = ReviewsConfig();
$reviewsconfig['tablecolor1'] = ($reviewsconfig['tablecolor1'] ? $reviewsconfig['tablecolor1'] : $ThemeInfo['bgcolor1']);
$reviewsconfig['tablecolor2'] = ($reviewsconfig['tablecolor2'] ? $reviewsconfig['tablecolor2'] : $ThemeInfo['bgcolor2']);

$min            = $_GETVAR->get('min', '_REQUEST', 'int');
$show           = $_GETVAR->get('show', '_REQUEST', 'int');
$op             = $_GETVAR->get('op', '_REQUEST', 'string', '');
$orderby        = $_GETVAR->get('orderby', '_REQUEST', 'string', '');
$newreviewshowdays = $_GETVAR->get('newreviewshowdays', '_REQUEST', 'string', '');
$ratenum        = $_GETVAR->get('ratenum', '_REQUEST', 'string', '');
$ratetype       = $_GETVAR->get('ratetype', '_REQUEST', 'string', '');
$ttitle         = $_GETVAR->get('ttitle', '_REQUEST', 'string', '');
$selectdate     = $_GETVAR->get('selectdate', '_REQUEST', 'string', '');
$cid            = $_GETVAR->get('cid', '_REQUEST', 'int');
$cid2           = $_GETVAR->get('cid2', '_REQUEST', 'int');
$rid            = $_GETVAR->get('rid', '_REQUEST', 'int', 0);
$cat            = $_GETVAR->get('cat', '_REQUEST', 'string', '');
$title          = $_GETVAR->get('title', '_REQUEST', 'string', '');
$url            = $_GETVAR->get('url', '_REQUEST', 'string', '');
$description    = $_GETVAR->get('description', '_REQUEST', 'string', '');
$username       = $_GETVAR->get('username', '_REQUEST', 'string', '');
$email          = $_GETVAR->get('email', '_REQUEST', 'string', '');
$auth_name      = $_GETVAR->get('auth_name', '_REQUEST', 'string', '');
$ratingrid      = $_GETVAR->get('ratingrid', '_REQUEST', 'int', 0);
$ratinguser     = $_GETVAR->get('ratinguser', '_REQUEST', 'string', '');
$rating         = $_GETVAR->get('rating', '_REQUEST', 'int', 0);
$ratingcomments = $_GETVAR->get('ratingcomments', '_REQUEST', 'string', '');
$image          = $_GETVAR->get('image', '_REQUEST', 'string', '');
$gfx_check      = $_GETVAR->get('gfx_check', '_REQUEST', 'string', '');
$modifysubmitter  = $_GETVAR->get('modifysubmitter', '_REQUEST', 'string', '');
$page           = $_GETVAR->get('page', '_REQUEST', 'int');
$forward        = $_GETVAR->get('forward', '_REQUEST', 'int');
$reviewheader   = $_GETVAR->get('reviewheader', '_REQUEST');
$reviewbody     = $_GETVAR->get('reviewbody', '_REQUEST');
$reviewfooter   = $_GETVAR->get('reviewfooter', '_REQUEST');
$reviewsignature = $_GETVAR->get('reviewsignature', '_REQUEST');

switch($op) {
    case 'AddRating':               include(NUKE_MODULES_DIR.$module_name.'/public/AddRating.php'); break;
    case 'AddReview':               include(NUKE_MODULES_DIR.$module_name.'/public/AddReview.php'); break;
    case 'AddReviewSave':           include(NUKE_MODULES_DIR.$module_name.'/public/AddReviewSave.php'); break;
    case 'brokenreview':            include(NUKE_MODULES_DIR.$module_name.'/public/BrokenReview.php'); break;
    case 'brokenreviewS':           brokenreviewS($rid,$cid, $title, $image, $url, $description, $reviewheader, $reviewbody, $reviewfooter, $reviewsignature, $submitter); break;
    case 'modifyreviewrequest':     include(NUKE_MODULES_DIR.$module_name.'/public/ModifyReviewRequest.php'); break;
    case 'modifyreviewrequestS':    modifyreviewrequestS($rid, $cat, $title, $image, $url, $description, $reviewheader, $reviewbody, $reviewfooter, $reviewsignature, $modifysubmitter); break;
    case 'MostPopular':             include(NUKE_MODULES_DIR.$module_name.'/public/MostPopular.php'); break;
    case 'NewReviews':              include(NUKE_MODULES_DIR.$module_name.'/public/NewReviews.php'); break;
    case 'NewReviewsDate':          include(NUKE_MODULES_DIR.$module_name.'/public/NewReviewsDate.php'); break;
    case 'outsidereviewsetup':      include(NUKE_MODULES_DIR.$module_name.'/public/OutSideReviewSetup.php'); break;
    case 'ratereview':              include(NUKE_MODULES_DIR.$module_name.'/public/RateReview.php'); break;
    case 'reviewrateinfo':          reviewrateinfo($rid); break;
    case 'reviewvisit':             reviewvisit($rid); break;
    case 'search':                  include(NUKE_MODULES_DIR.$module_name.'/public/Search.php'); break;
    case 'showreview':              include(NUKE_MODULES_DIR.$module_name.'/public/ShowReview.php'); break;
    case 'TopRated':                include(NUKE_MODULES_DIR.$module_name.'/public/TopRated.php'); break;
    case 'viewreview':              include(NUKE_MODULES_DIR.$module_name.'/public/ViewReview.php'); break;
    case 'viewreviewcomments':      include(NUKE_MODULES_DIR.$module_name.'/public/ViewReviewComments.php'); break;
    case 'viewrevieweditorial':     include(NUKE_MODULES_DIR.$module_name.'/public/ViewReviewEditorial.php'); break;
    case 'viewreviewdetails':       include(NUKE_MODULES_DIR.$module_name.'/public/ViewReviewDetails.php'); break;
    default:                        include(NUKE_MODULES_DIR.$module_name.'/public/index.php'); break;
}

?>