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

global $db, $currentlang, $board_config, $downloadsconfig, $userinfo;

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = $lang_new[$module_name]['DOWNLOADS'];
define('DOWNLOADS_INDEX_FILE', true);

require_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');
$downloadsconfig = DownloadsConfig();
$downloadsconfig['tablecolor1'] = ($downloadsconfig['tablecolor1'] ? $downloadsconfig['tablecolor1'] : $ThemeInfo['bgcolor1']);
$downloadsconfig['tablecolor2'] = ($downloadsconfig['tablecolor2'] ? $downloadsconfig['tablecolor2'] : $ThemeInfo['bgcolor2']);

$over_out   = "onmouseover='style.backgroundColor=\"".$ThemeInfo['bgcolor1']."\"' onmouseout='style.backgroundColor=\"".$ThemeInfo['bgcolor2']."\"'";
$op         = $_GETVAR->get('op', '_REQUEST', 'string', '');

switch($op) {
    case 'AddDownload':             include(NUKE_MODULES_DIR.$module_name.'/public/AddDownload.php'); break;
    case 'AddDownloadSave':         include(NUKE_MODULES_DIR.$module_name.'/public/AddDownloadSave.php'); break;
    case 'AddRating':               include(NUKE_MODULES_DIR.$module_name.'/public/AddRating.php'); break;
    case 'brokendownload':          include(NUKE_MODULES_DIR.$module_name.'/public/DownloadBroken.php'); break;
    case 'brokendownloadS':         include(NUKE_MODULES_DIR.$module_name.'/public/DownloadBrokenS.php'); break;
    case 'DownloadDoDownload':      include(NUKE_MODULES_DIR.$module_name.'/public/DownloadDoDownload.php'); break;
    case 'downloadrateinfo':        downloadrateinfo($did); break;
    case 'outsidedownloadsetup':    include(NUKE_MODULES_DIR.$module_name.'/public/OutSideDownloadSetup.php');  break;
    case 'MostPopular':             include(NUKE_MODULES_DIR.$module_name.'/public/MostPopular.php'); break;
    case 'NewDownloads':            include(NUKE_MODULES_DIR.$module_name.'/public/NewDownloads.php'); break;
    case 'NewDownloadsDate':        include(NUKE_MODULES_DIR.$module_name.'/public/NewDownloadsDate.php'); break;
    case 'ratedownload':            include(NUKE_MODULES_DIR.$module_name.'/public/RateDownload.php'); break;
    case 'search':                  include(NUKE_MODULES_DIR.$module_name.'/public/Search.php'); break;
    case 'showdownload':            include(NUKE_MODULES_DIR.$module_name.'/public/ShowDownload.php'); break;
    case 'ShowLicense':             include(NUKE_MODULES_DIR.$module_name.'/public/ShowLicense.php'); break;
    case 'TopRated':                include(NUKE_MODULES_DIR.$module_name.'/public/TopRated.php'); break;
    case 'viewdownload':            include(NUKE_MODULES_DIR.$module_name.'/public/ViewDownload.php'); break;
    case 'viewdownloadcomments':    include(NUKE_MODULES_DIR.$module_name.'/public/ViewDownloadComments.php'); break;
    case 'viewdownloadseditorial':  include(NUKE_MODULES_DIR.$module_name.'/public/ViewDownloadEditorial.php'); break;
    case 'viewdownloaddetails':     include(NUKE_MODULES_DIR.$module_name.'/public/ViewDownloadDetails.php'); break;
    default:                        include(NUKE_MODULES_DIR.$module_name.'/public/index.php'); break;
}

?>