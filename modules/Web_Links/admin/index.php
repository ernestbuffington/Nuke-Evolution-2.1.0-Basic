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

define('IN_WEBLINKS_ADMIN', TRUE);

global $db, $admin_file, $currentlang, $cache, $weblinksconfig;

get_lang($module_name);

/*********************************************************/
/* Links Modified Web Links                              */
/*********************************************************/

include_once(NUKE_MODULES_DIR.$module_name.'/admin/functions.php');
$weblinksconfig = WebLinksConfig();

$cat                    = $_GETVAR->get('cat', '_REQUEST', 'int');
$cdescription           = $_GETVAR->get('cdescription', '_REQUEST');
$cid                    = $_GETVAR->get('cid', '_REQUEST', 'int');
$cidfrom                = $_GETVAR->get('cidfrom', '_REQUEST', 'int');
$cidto                  = $_GETVAR->get('cidto', '_REQUEST', 'int');
$description            = $_GETVAR->get('description', '_REQUEST');
$editorialtext          = $_GETVAR->get('editorialtext', '_REQUEST');
$editorialtitle         = $_GETVAR->get('editorialtitle', '_REQUEST');
$email                  = $_GETVAR->get('email', '_REQUEST', 'email');
$hits                   = $_GETVAR->get('hits', '_REQUEST', 'int');
$image                  = $_GETVAR->get('image', '_REQUEST');
$imageurl               = $_GETVAR->get('imageurl', '_REQUEST', 'url');
if (!empty($imageurl)) {
    $image = $imageurl;
}
$lid                    = $_GETVAR->get('lid', '_REQUEST', 'int');
$linkid                 = $_GETVAR->get('linkid', '_REQUEST', 'int');
$username               = $_GETVAR->get('username', '_REQUEST');
$new                    = $_GETVAR->get('new', '_REQUEST', 'int');
$rid                    = $_GETVAR->get('rid', '_REQUEST', 'int');
$rldbid                 = $_GETVAR->get('rldbid', '_REQUEST', 'int');
$ok                     = $_GETVAR->get('ok', '_REQUEST', 'int');
$op                     = $_GETVAR->get('op', '_REQUEST');
$sid                    = $_GETVAR->get('sid', '_REQUEST', 'int');
$sub                    = $_GETVAR->get('sub', '_REQUEST', 'int');
$submitter              = $_GETVAR->get('submitter', '_REQUEST');
$requestid              = $_GETVAR->get('requestid', '_REQUEST', 'int');
$title                  = $_GETVAR->get('title', '_REQUEST');
$ttitle                 = $_GETVAR->get('ttitle', '_REQUEST');
$url                    = $_GETVAR->get('url', '_REQUEST', 'url');

$block_rows             = $_GETVAR->get('block_rows', '_REQUEST', 'int');
$topbox_scroll          = $_GETVAR->get('topbox_scroll', '_REQUEST', 'int');
$block_scroll           = $_GETVAR->get('block_scroll', '_REQUEST', 'int');
$topbox_scroll_amount   = $_GETVAR->get('topbox_scroll_amount', '_REQUEST', 'int');
$block_scroll_amount    = $_GETVAR->get('block_scroll_amount', '_REQUEST', 'int');
$topbox_scroll_direction= $_GETVAR->get('topbox_scroll_direction', '_REQUEST', 'int');
$block_scroll_direction = $_GETVAR->get('block_scroll_direction', '_REQUEST', 'int');
$block_height           = $_GETVAR->get('block_height', '_REQUEST', 'int');
$topbox_height          = $_GETVAR->get('topbox_height', '_REQUEST', 'int');
$block_image_show       = $_GETVAR->get('block_image_show', '_REQUEST', 'int');
$block_image_width      = $_GETVAR->get('block_image_width', '_REQUEST');
$block_image_height     = $_GETVAR->get('block_image_height', '_REQUEST');
$block_line_breaks      = $_GETVAR->get('block_line_breaks', '_REQUEST', 'int');
$tablecolor1            = $_GETVAR->get('tablecolor1', '_REQUEST');
$tablecolor2            = $_GETVAR->get('tablecolor2', '_REQUEST');
$link_box               = $_GETVAR->get('link_box', '_REQUEST', 'int');
$maxshow                = $_GETVAR->get('maxshow', '_REQUEST');
$image_width            = $_GETVAR->get('image_width', '_REQUEST');
$image_height           = $_GETVAR->get('image_height', '_REQUEST');
$links_perpage          = $_GETVAR->get('links_perpage', '_REQUEST', 'int');
$popular                = $_GETVAR->get('popular', '_REQUEST', 'int');
$newlinks               = $_GETVAR->get('newlinks', '_REQUEST', 'int');
$toplinks               = $_GETVAR->get('toplinks', '_REQUEST', 'int');
$linksresults           = $_GETVAR->get('linksresults', '_REQUEST', 'int');
$anonaddlinklock        = $_GETVAR->get('anonaddlinklock', '_REQUEST', 'int');
$allow_guest_vote       = $_GETVAR->get('allow_guest_vote', '_REQUEST', 'int');
$anonwaitdays           = $_GETVAR->get('anonwaitdays', '_REQUEST', 'int');
$outsidewaitdays        = $_GETVAR->get('outsidewaitdays', '_REQUEST', 'int');
$useoutsidevoting       = $_GETVAR->get('useoutsidevoting', '_REQUEST', 'int');
$anonweight             = $_GETVAR->get('anonweight', '_REQUEST', 'int');
$outsideweight          = $_GETVAR->get('outsideweight', '_REQUEST', 'int');
$detailvotedecimal      = $_GETVAR->get('detailvotedecimal', '_REQUEST', 'int');
$mainvotedecimal        = $_GETVAR->get('mainvotedecimal', '_REQUEST', 'int');
$toplinkspercentrigger  = $_GETVAR->get('toplinkspercentrigger', '_REQUEST', 'int');
$toplinks               = $_GETVAR->get('toplinks', '_REQUEST', 'int');
$mostpoplinkspercentrigger = $_GETVAR->get('mostpoplinkspercentrigger', '_REQUEST', 'int');
$mostpoplinks           = $_GETVAR->get('mostpoplinks', '_REQUEST', 'int');
$featurebox             = $_GETVAR->get('featurebox', '_REQUEST', 'int');
$linkvotemin            = $_GETVAR->get('linkvotemin', '_REQUEST', 'int');
$blockunregmodify       = $_GETVAR->get('blockunregmodify', '_REQUEST', 'int');
$securitycheck          = $_GETVAR->get('securitycheck', '_REQUEST', 'int');
$check                  = $_GETVAR->get('check', '_REQUEST', 'int');
$date                   = $_GETVAR->get('date', '_REQUEST', 'int');
$show_header            = $_GETVAR->get('show_header', '_POST', 'int');
$show_topbox            = $_GETVAR->get('show_topbox', '_POST', 'int');
$thumbnail_use          = $_GETVAR->get('thumbnail_use', '_REQUEST', 'int');
$thumbnail_url          = $_GETVAR->get('thumbnail_url', '_REQUEST', 'string');
$info                   = $_GETVAR->get('info', '_REQUEST');

switch ($op) {

    case 'Links':
    links();
    break;

    case 'LinksDelNew':
    LinksDelNew($lid);
    break;

    case 'LinksAddCat':
    LinksAddCat($title, $image, $cdescription);
    break;

    case 'LinksAddSubCat':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksAddSubCat.php');
    break;

    case 'LinksAddLink':
    include(NUKE_MODULES_DIR.$module_name.'/admin/AddNewLinkS.php');
    break;

    case 'LinksAddEditorial':
    LinksAddEditorial($linkid, $editorialtitle, $editorialtext);
    break;

    case 'LinksModEditorial':
    LinksModEditorial($linkid, $editorialtitle, $editorialtext);
    break;

    case 'LinksLinkCheck':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksLinkCheck.php');
    break;

    case 'LinksValidate':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksValidate.php');
    break;

    case 'LinksDelEditorial':
    LinksDelEditorial($linkid);
    break;

    case 'LinksCleanVotes':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksCleanVotes.php');
    break;

    case 'LinksListBrokenLinks':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksListBrokenLinks.php');
    break;

    case 'LinksEditBrokenLinks':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksEditBrokenLinks.php');
    break;

    case 'LinksDelBrokenLinks':
    LinksDelBrokenLinks($lid);
    break;

    case 'LinksIgnoreBrokenLinks':
    LinksIgnoreBrokenLinks($lid);
    break;

    case 'LinksListModRequests':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksListModRequests.php');
    break;

    case 'LinksChangeModRequests':
    LinksChangeModRequests($requestid);
    break;

    case 'LinksChangeIgnoreRequests':
    LinksChangeIgnoreRequests($requestid);
    break;

    case 'LinksDelCat':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksDelCat.php');
    break;

    case 'LinksModCat':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksModCat.php');
    break;

    case 'LinksModCatS':
    LinksModCatS($cid, $sid, $sub, $title, $image, $cdescription);
    break;

    case 'LinksModLink':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksModLink.php');
    break;

    case 'LinksModLinkS':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksModLinkS.php');
    break;

    case 'LinksDelLink':
    LinksDelLink($lid);
    break;

    case 'LinksDelVote':
    LinksDelVote($lid, $rldbid);
    break;

    case 'LinksDelComment':
    LinksDelComment($lid, $rldbid);
    break;

    case 'LinksTransfer':
    LinksTransfer($cidfrom,$cidto);
    break;


    case 'LinksSettings':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksSettings.php');
    break;

    case 'LinksSaveSettings':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksSettingsS.php');
    break;

    case 'LinksAddMainCategory':
    LinksAddMainCategory();
    break;

    case 'LinksSaveSubCat':
    LinksSaveSubCat($cid, $title, $image, $cdescription);
    break;

    case 'LinksSelectModifyCategory':
    LinksSelectModifyCategory();
    break;

    case 'AddNewLink':
    include(NUKE_MODULES_DIR.$module_name.'/admin/AddNewLink.php');
    break;

    case 'LinkAdminValidation':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinkAdminValidation.php');
    break;

    case 'LinksListNewLinks':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksListNewLinks.php');
    break;

    case 'SelectModifyLink':
    SelectModifyLink();
    break;

    case 'LinksTransferCat':
    include(NUKE_MODULES_DIR.$module_name.'/admin/LinksTransferCat.php');
    break;
}

?>