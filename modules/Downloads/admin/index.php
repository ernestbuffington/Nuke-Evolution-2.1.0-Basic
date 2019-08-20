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

define('IN_DOWNLOADS_ADMIN', TRUE);

define('LIGHTBOX', true);

global $db, $admin_file, $currentlang, $cache, $downloadsconfig, $_GETVAR, $ThemeInfo;

$lang_path = NUKE_MODULES_DIR . $module_name . '/language/';
if (@file_exists($lang_path . 'lang-' . $currentlang . '.php')) {
    require($lang_path . 'lang-' . $currentlang . '.php');
} elseif (@file_exists($lang_path . 'lang-' . $board_config['default_lang'] . '.php')) {
    require($lang_path . 'lang-' . $board_config['default_lang'] . '.php');
} else {
    DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $module_name);
}

include_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

$downloadsconfig = DownloadsConfig();

$downloadsconfig['tablecolor1'] = ($downloadsconfig['tablecolor1'] ? $downloadsconfig['tablecolor1'] : $ThemeInfo['bgcolor1']);
$downloadsconfig['tablecolor2'] = ($downloadsconfig['tablecolor2'] ? $downloadsconfig['tablecolor2'] : $ThemeInfo['bgcolor2']);

$over_out = "onmouseover='style.backgroundColor=\"".$ThemeInfo['bgcolor1']."\"' onmouseout='style.backgroundColor=\"".$ThemeInfo['bgcolor2']."\"'";
$add_extactive        = $_GETVAR->get('add_extactive', '_POST', 'int');
$add_extension        = $_GETVAR->get('add_extension', '_POST');
$add_extdescription   = $_GETVAR->get('add_extdescription', '_POST');
$add_extmimetype      = $_GETVAR->get('add_extmimetype', '_POST');
$add_exttype          = $_GETVAR->get('add_exttype', '_POST', 'int');
$allow_guest_vote     = $_GETVAR->get('allow_guest_vote', '_POST', 'int');
$anonadddownloadlock  = $_GETVAR->get('anonadddownloadlock', '_POST', 'int');
$anonwaitdays         = $_GETVAR->get('anonwaitdays', '_POST', 'int');
$anonweight           = $_GETVAR->get('anonweight', '_POST', 'int');
$block_height         = $_GETVAR->get('block_height', '_POST', 'int');
$block_image_width    = $_GETVAR->get('block_image_width', '_POST');
$block_image_height   = $_GETVAR->get('block_image_height', '_POST');
$block_line_breaks    = $_GETVAR->get('block_line_breaks', '_POST', 'int');
$block_rows           = $_GETVAR->get('block_rows', '_POST', 'int');
$block_scroll         = $_GETVAR->get('block_scroll', '_POST', 'int');
$block_scroll_amount  = $_GETVAR->get('block_scroll_amount', '_POST', 'int');
$block_scroll_direction   = $_GETVAR->get('block_scroll_direction', '_POST', 'int');
$blockunregmodify     = $_GETVAR->get('blockunregmodify', '_POST', 'int');
$canupload            = $_GETVAR->get('canupload', '_POST', 'int');
$cat                  = $_GETVAR->get('cat', '_REQUEST', 'int');
$catactive            = $_GETVAR->get('catactive', '_POST', 'int');
$catoverride          = $_GETVAR->get('catoverride', '_POST', 'int');
$cdescription         = $_GETVAR->get('cdescription', '_POST');
$check                = $_GETVAR->get('check', '_POST', 'int');
$cid                  = $_GETVAR->get('cid', '_REQUEST', 'int');
$cidfrom              = $_GETVAR->get('cidfrom', '_REQUEST', 'int');
$cidto                = $_GETVAR->get('cidto', '_REQUEST', 'int');
$date                 = $_GETVAR->get('date', '_POST', 'int');
$description          = $_GETVAR->get('description', '_POST');
$detailvotedecimal    = $_GETVAR->get('detailvotedecimal', '_POST', 'int');
$did                  = $_GETVAR->get('did', '_REQUEST', 'int');
$downloadid           = $_GETVAR->get('downloadid', '_REQUEST', 'int');
$download_active      = $_GETVAR->get('download_active', '_POST', 'int');
$download_added       = $_GETVAR->get('download_added', '_POST', 'int');
$download_author      = $_GETVAR->get('download_author', '_POST');
$download_author_email   = $_GETVAR->get('download_author_email', '_POST');
$download_author_website = $_GETVAR->get('download_author_website', '_POST');
$download_box         = $_GETVAR->get('download_box', '_POST', 'int');
$download_email       = $_GETVAR->get('download_email', '_POST');
$download_license     = $_GETVAR->get('download_license', '_POST', 'int');
$download_mimetype    = $_GETVAR->get('download_mimetype', '_POST');
$download_name        = $_GETVAR->get('download_name', '_POST');
$download_restricted_group_download = $_GETVAR->get('download_restricted_group_download', '_POST', 'int');
$download_restricted_group_see = $_GETVAR->get('download_restricted_group_see', '_POST', 'int');
$download_size        = $_GETVAR->get('download_size', '_POST', 'int');
$download_submitter_email   = $_GETVAR->get('download_submitter_email', '_POST');
$download_torrent     = $_GETVAR->get('download_torrent', '_POST');
$download_type        = $_GETVAR->get('download_type', '_POST', 'int');
$download_username    = $_GETVAR->get('download_username', '_POST');
$download_version     = $_GETVAR->get('download_version', '_POST');
$downloads_basedir    = $_GETVAR->get('downloads_basedir', '_POST');
$downloads_in_time    = $_GETVAR->get('downloads_in_time', '_POST', 'int');
$downloads_perpage    = $_GETVAR->get('downloads_perpage', '_POST', 'int');
$downloads_ftpuser    = $_GETVAR->get('downloads_ftpuser', '_POST');
$downloads_ftppasswd  = $_GETVAR->get('downloads_ftppasswd', '_POST');
$downloads_useftp     = $_GETVAR->get('downloads_useftp', '_POST', 'int');
$downloadsresults     = $_GETVAR->get('downloadsresults', '_POST', 'int');
$downloadvotemin      = $_GETVAR->get('downloadvotemin', '_POST', 'int');
$eid                  = $_GETVAR->get('eid', '_POST', 'int');
$editorialtext        = $_GETVAR->get('editorialtext', '_POST');
$editorialtitle       = $_GETVAR->get('editorialtitle', '_POST');
$email                = $_GETVAR->get('email', '_POST');
$exttype              = $_GETVAR->get('exttype', '_POST', 'int');
$featurebox           = $_GETVAR->get('featurebox', '_POST', 'int');
$goback               = $_GETVAR->get('goback', '_REQUEST', 'int');
$groupactive          = $_GETVAR->get('groupactive', '_POST', 'int');
$groupdescription     = $_GETVAR->get('groupdescription', '_POST');
$groupid              = $_GETVAR->get('groupid', '_REQUEST', 'int');
$hits                 = $_GETVAR->get('hits', '_REQUEST', 'int');
$image                = $_GETVAR->get('image', '_POST');
$image_width          = $_GETVAR->get('image_width', '_POST');
$image_height         = $_GETVAR->get('image_height', '_POST');
$imageurl             = $_GETVAR->get('imageurl', '_POST');
if (!empty($imageurl)) {
    $image = $imageurl;
}
$info                 = $_GETVAR->get('info', '_REQUEST');

$is_validate          = $_GETVAR->get('is_validate', '_REQUEST', 'int',0);

$last_modified_date   = $_GETVAR->get('last_modified_date', '_POST', 'int');
$last_modified_user   = $_GETVAR->get('last_modified_user', '_POST');
$licenseid            = $_GETVAR->get('licenseid', '_REQUEST', 'int');
$licensetext          = $_GETVAR->get('licensetext', '_POST');
$licensetitle         = $_GETVAR->get('licensetitle', '_POST');
$licenseurl           = $_GETVAR->get('licenseurl', '_POST');
$mainvotedecimal      = $_GETVAR->get('mainvotedecimal', '_POST', 'int');
$maxdirsize           = $_GETVAR->get('maxdirsize', '_POST', 'int');
$maxfilesize          = $_GETVAR->get('maxfilesize', '_POST', 'int');
$maxshow              = $_GETVAR->get('maxshow', '_POST');
$min                  = $_GETVAR->get('min', '_REQUEST', 'int');
$mintime              = $_GETVAR->get('mintime', '_POST', 'int');
$mode                 = $_GETVAR->get('mode', '_REQUEST');
$mostpopdownloads     = $_GETVAR->get('mostpopdownloads', '_POST', 'int');
$mostpopdownloadspercentrigger = $_GETVAR->get('mostpopdownloadspercentrigger', '_POST', 'int');
$new                  = $_GETVAR->get('new', '_POST', 'int');
$newdownloads         = $_GETVAR->get('newdownloads', '_POST', 'int');
$ok                   = $_GETVAR->get('ok', '_REQUEST', 'int');
$op                   = $_GETVAR->get('op', '_REQUEST');
$order_field          = $_GETVAR->get('order_field', '_POST', 'int', 1);
$order_sort           = $_GETVAR->get('order_sort', '_POST', 'int', 1);
$outsidewaitdays      = $_GETVAR->get('outsidewaitdays', '_POST', 'int');
$outsideweight        = $_GETVAR->get('outsideweight', '_POST', 'int');
$popular              = $_GETVAR->get('popular', '_POST', 'int');
$rddbid               = $_GETVAR->get('rddbid', '_POST', 'int');
$restricted_group_add = $_GETVAR->get('restricted_group_add', '_POST', 'int');
$restricted_group_see = $_GETVAR->get('restricted_group_see', '_POST', 'int');
$securitycheck        = $_GETVAR->get('securitycheck', '_POST', 'int');
$show_header          = $_GETVAR->get('show_header', '_POST', 'int');
$show_topbox          = $_GETVAR->get('show_topbox', '_POST', 'int');
$show_updated         = $_GETVAR->get('show_updated', '_POST', 'int');
$show_updated_days    = $_GETVAR->get('show_updated_days', '_POST', 'int');
$sid                  = $_GETVAR->get('sid', '_REQUEST', 'int');
$sizedefinebandwidth  = $_GETVAR->get('sizedefinebandwidth', '_POST', 'int');
$sizedefinedir        = $_GETVAR->get('sizedefinedir', '_POST', 'int');
$sizedefinefile       = $_GETVAR->get('sizedefinefile', '_POST', 'int');
$sub                  = $_GETVAR->get('sub', '_POST', 'int');
$submitter            = $_GETVAR->get('submitter', '_POST');
$title                = $_GETVAR->get('title', '_POST');
$topdownloadspercentrigger  = $_GETVAR->get('topdownloadspercentrigger', '_POST', 'int');
$topdownloads         = $_GETVAR->get('topdownloads', '_POST', 'int');
$topbox_height        = $_GETVAR->get('topbox_height', '_POST', 'int');
$topbox_scroll        = $_GETVAR->get('topbox_scroll', '_POST', 'int');
$topbox_scroll_amount = $_GETVAR->get('topbox_scroll_amount', '_POST', 'int');
$topbox_scroll_direction  = $_GETVAR->get('topbox_scroll_direction', '_POST', 'int');
$thumbnail_url        = $_GETVAR->get('thumbnail_url', '_POST');
$thumbnail_use        = $_GETVAR->get('thumbnail_use', '_POST', 'int');
$total_downloads      = $_GETVAR->get('total_downloads', '_POST', 'int');
$total_downloads_meantime    = $_GETVAR->get('total_downloads_meantime', '_POST', 'int');
$ttitle               = $_GETVAR->get('ttitle', '_POST');
$uploaddir            = $_GETVAR->get('uploaddir', '_POST');
$uploadfile           = $_GETVAR->get('uploadfile', '_FILES', 'array');
$uploadfile_new       = $_GETVAR->get('uploadfile_new', '_FILES', 'array');
$uploadimage          = $_GETVAR->get('uploadimage', '_FILES', 'array');
$upload_file          = $_GETVAR->get('upload_file', '_POST');
$url                  = $_GETVAR->get('url', '_POST');
$url_new              = $_GETVAR->get('url_new', '_POST');
$useoutsidevoting     = $_GETVAR->get('useoutsidevoting', '_POST', 'int');
$useractive           = $_GETVAR->get('useractive', '_POST', 'int');
$userdescription      = $_GETVAR->get('userdescription', '_POST');
$userid               = $_GETVAR->get('userid', '_REQUEST', 'int');
$username             = $_GETVAR->get('username', '_POST');

switch ($op) {
    case 'AddNewDownload':                  include(NUKE_MODULES_DIR.$module_name.'/admin/AddNewDownload.php'); break;
    case 'Downloads':                       DownloadsDeleteUploaderDir(); downloads(); break;
    case 'DownloadsActivate':               include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsActivate.php'); break;
    case 'DownloadsAddCat':                 include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsAddCat.php'); break;
    case 'DownloadsAddCatS':                include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsAddCatS.php'); break;
    case 'DownloadsAddDownload':            include(NUKE_MODULES_DIR.$module_name.'/admin/AddNewDownload.php'); break;
    case 'DownloadsAddEditorial':           DownloadsAddEditorial($downloadid, $editorialtitle, $editorialtext); break;
    case 'DownloadsAddNewDownloadS':        include(NUKE_MODULES_DIR.$module_name.'/admin/AddNewDownloadS.php'); break;
    case 'DownloadsAddSubCat':              include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsAddCat.php'); break;
    case 'DownloadsCatActivate':            include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsCatActivate.php'); break;
    case 'DownloadsCatDeactivate':          include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsCatDeactivate.php'); break;
    case 'DownloadsCatList':                include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsCatList.php'); break;
    case 'DownloadsCheck':                  include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsCheck.php');  break;
    case 'DownloadsCleanVotes':             include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsCleanVotes.php'); break;
    case 'DownloadsDeactivate':             include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsDeactivate.php'); break;
    case 'DownloadsDelBrokenDownloads':     DownloadsDelBrokenDownloads($did); break;
    case 'DownloadsDelCat':                 include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsDelCat.php');  break;
    case 'DownloadsDelComment':             DownloadsDelComment($did, $rddbid); break;
    case 'DownloadsDelDBRow':               DownloadsDelDBRow($did, $min, $is_validate); break;
    case 'DownloadsDelEditorial':           DownloadsDelEditorial($downloadid); break;
    case 'DownloadsDelete':                 DownloadsDelDownload($did, $min, $is_validate); break;
    case 'DownloadsDelVote':                DownloadsDelVote($did, $rddbid);  break;
    case 'DownloadsEditBrokenDownload':     include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsEditBrokenDownload.php'); break;
   	case 'DownloadsEditBrokenDownloadS':	include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsEditBrokenDownloadS.php');  break;
    case 'DownloadsExtActivate':            DownloadsExtActivate($eid, $min); break;
    case 'DownloadsExtAdd':                 include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsExtAdd.php');  break;
    case 'DownloadsExtDeactivate':          DownloadsExtDeactivate($eid, $min); break;
    case 'DownloadsExtDel':                 DownloadsExtDel($eid, $min); break;
    case 'DownloadsExtList':                include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsExtList.php'); break;
    case 'DownloadsExtModify':              include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsExtModify.php'); break;
    case 'DownloadsExtModifyS':             DownloadsExtModifyS($eid, $min, $add_extension, $add_extmimetype, $add_extdescription, $add_exttype, $add_extactive); break;
    case 'DownloadsGroupActivate':          include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsGroupActivate.php'); break;
    case 'DownloadsGroupAdd':               include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsGroupAdd.php'); break;
    case 'DownloadsGroupAddS':              include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsGroupAddS.php'); break;
    case 'DownloadsGroupDeactivate':        include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsGroupDeactivate.php'); break;
    case 'DownloadsGroupDel':               include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsGroupDel.php');  break;
    case 'DownloadsGroupList':              include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsGroupList.php'); break;
    case 'DownloadsGroupMod':               include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsGroupMod.php');  break;
    case 'DownloadsGroupModS':              include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsGroupAddS.php'); break;
    case 'DownloadsIgnoreBrokenDownloads':  DownloadsIgnoreBrokenDownloads($did); break;
    case 'DownloadsLicensesAdd':            include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsLicensesAdd.php'); break;
    case 'DownloadsLicensesAddS':           include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsLicensesAddS.php'); break;
    case 'DownloadsLicensesDel':            DownloadsLicensesDel($licenseid, $min); break;
    case 'DownloadsLicensesList':           include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsLicensesList.php'); break;
    case 'DownloadsLicensesMod':            include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsLicensesMod.php'); break;
    case 'DownloadsLicensesModS':           include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsLicensesModS.php'); break;
    case 'DownloadsListBrokenDownloads':    include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsListBrokenDownloads.php'); break;
    case 'DownloadsListValidateDownloads':  include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsListValidateDownloads.php'); break;
    case 'DownloadsModCat':                 include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsModCat.php'); break;
    case 'DownloadsModCatS':                include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsModCatS.php'); break;
    case 'DownloadsModDownload':            include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsModDownload.php'); break;
    case 'DownloadsModDownloadS':           include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsModDownloadS.php'); break;
    case 'DownloadsModEditorial':           DownloadsModEditorial($downloadid, $editorialtitle, $editorialtext);  break;
    case 'DownloadsModSelect':              include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsList.php'); break;
    case 'DownloadsSaveSettings':           include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsSettingsS.php'); break;
    case 'DownloadsSettings':               include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsSettings.php'); break;
    case 'DownloadsTransfer':               DownloadsTransfer($cidfrom,$cidto); break;
    case 'DownloadsTransferCat':            include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsTransferCat.php'); break;
    case 'DownloadsUserActivate':           include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsUserActivate.php'); break;
    case 'DownloadsUserAdd':                include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsUserAdd.php'); break;
    case 'DownloadsUserAddS':               include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsUserAddS.php'); break;
    case 'DownloadsUserDeactivate':         include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsUserDeactivate.php'); break;
    case 'DownloadsUserDel':                include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsUserDel.php'); break;
    case 'DownloadsUserList':               include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsUserList.php'); break;
    case 'DownloadsUserMod':                include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsUserMod.php');  break;
    case 'DownloadsUserModS':               include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsUserAddS.php');  break;
    case 'DownloadsValidate':               include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsValidate.php');  break;
    case 'DownloadsValidateEditDownloads':  include(NUKE_MODULES_DIR.$module_name.'/admin/DownloadsValidateEditDownloads.php'); break;
}
?>