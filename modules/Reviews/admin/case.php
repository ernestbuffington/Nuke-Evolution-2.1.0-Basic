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
$lang_path = NUKE_MODULES_DIR . $module_name . '/language/';
if (file_exists($lang_path . 'lang-' . $currentlang . '.php'))
{
    include_once($lang_path . 'lang-' . $currentlang . '.php');
}
elseif (file_exists($lang_path . 'lang-' . $board_config['default_lang'] . '.php'))
{
    include_once($lang_path . 'lang-' . $board_config['default_lang'] . '.php');
}
else
{
    DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $module_name);
}

switch($op) {

    case "Reviews":
    case "ReviewsDelNew":
    case "ReviewsAddCat":
    case "ReviewsAddSubCat":
    case "ReviewsAddReview":
    case "ReviewsAddEditorial":
    case "ReviewsModEditorial":
    case "ReviewsLinkCheck":
    case "ReviewsValidate":
    case "ReviewsDelEditorial":
    case "ReviewsCleanVotes":
    case "ReviewsListBrokenReviews":
    case "ReviewsEditBrokenReviews":
    case "ReviewsDelBrokenReviews":
    case "ReviewsIgnoreBrokenReviews":
    case "ReviewsListModRequests":
    case "ReviewsChangeModRequests":
    case "ReviewsChangeIgnoreRequests":
    case "ReviewsDelCat":
    case "ReviewsModCat":
    case "ReviewsModCatS":
    case "ReviewsModReview":
    case "ReviewsModReviewS":
    case "ReviewsDelReview":
    case "ReviewsDelVote":
    case "ReviewsDelComment":
    case "ReviewsTransfer":
    case "ReviewsSettings":
    case "ReviewsSaveSettings":
    case "ReviewsAddMainCategory":
    case "ReviewsSaveSubCat":
    case "ReviewsSelectModifyCategory":
    case "AddNewReview":
    case "ReviewAdminValidation":
    case "SelectModifyReview":
    case "ReviewTransferCat":
    case "ReviewsListNewReviews":
        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;

}

?>