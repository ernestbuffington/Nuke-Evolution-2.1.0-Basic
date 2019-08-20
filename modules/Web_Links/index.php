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

global $db, $currentlang, $evoconfig, $ThemeInfo;
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = $lang_new[$module_name]['MODULE_NAME'];
define('WEBLINK_INDEX_FILE', true);

require_once(NUKE_MODULES_DIR.$module_name.'/public/functions.php');
$weblinksconfig = WebLinksConfig();
$weblinksconfig['tablecolor1'] = ($weblinksconfig['tablecolor1'] ? $weblinksconfig['tablecolor1'] : $ThemeInfo['bgcolor1']);
$weblinksconfig['tablecolor2'] = ($weblinksconfig['tablecolor2'] ? $weblinksconfig['tablecolor2'] : $ThemeInfo['bgcolor2']);


$min            = $_GETVAR->get('min', '_REQUEST', 'int');
$show           = $_GETVAR->get('show', '_REQUEST', 'int');
$op             = $_GETVAR->get('op', '_REQUEST', 'string', '');
$orderby        = $_GETVAR->get('orderby', '_REQUEST', 'string', '');
$newlinkshowdays = $_GETVAR->get('newlinkshowdays', '_REQUEST', 'string', '');
$ratenum        = $_GETVAR->get('ratenum', '_REQUEST', 'string', '');
$ratetype       = $_GETVAR->get('ratetype', '_REQUEST', 'string', '');
$ttitle         = $_GETVAR->get('ttitle', '_REQUEST', 'string', '');
$selectdate     = $_GETVAR->get('selectdate', '_REQUEST', 'string', '');
$cid            = $_GETVAR->get('cid', '_REQUEST', 'int');
$cid2           = $_GETVAR->get('cid2', '_REQUEST', 'int');
$lid            = $_GETVAR->get('lid', '_REQUEST', 'int', 0);
$cat            = $_GETVAR->get('cat', '_REQUEST', 'string', '');
$title          = $_GETVAR->get('title', '_REQUEST', 'string', '');
$url            = $_GETVAR->get('url', '_REQUEST', 'string', '');
$description    = $_GETVAR->get('description', '_REQUEST', 'string', '');
$username       = $_GETVAR->get('username', '_REQUEST', 'string', '');
$email          = $_GETVAR->get('email', '_REQUEST', 'string', '');
$auth_name      = $_GETVAR->get('auth_name', '_REQUEST', 'string', '');
$ratinglid      = $_GETVAR->get('ratinglid', '_REQUEST', 'int', 0);
$ratinguser     = $_GETVAR->get('ratinguser', '_REQUEST', 'string', '');
$rating         = $_GETVAR->get('rating', '_REQUEST', 'int', 0);
$ratingcomments = $_GETVAR->get('ratingcomments', '_REQUEST', 'string', '');
$image          = $_GETVAR->get('image', '_REQUEST', 'string', '');
$gfx_check      = $_GETVAR->get('gfx_check', '_REQUEST', 'string', '');
$modifysubmitter  = $_GETVAR->get('modifysubmitter', '_REQUEST', 'string', '');
$query          = $_GETVAR->get('query', '_REQUEST');

switch($op) {
    case 'AddLink':             include(NUKE_MODULES_DIR.$module_name.'/public/AddLink.php'); break;
    case 'AddLinkSave':         include(NUKE_MODULES_DIR.$module_name.'/public/AddLinkSave.php');  break;
    case 'addrating':           include(NUKE_MODULES_DIR.$module_name.'/public/AddRating.php'); break;
    case 'brokenlink':          include(NUKE_MODULES_DIR.$module_name.'/public/BrokenLink.php'); break;
    case 'brokenlinkS':         brokenlinkS($lid, $cid, $title, $image, $url, $description); break;
    case 'linkvisit':           linkvisit($lid); break;
    case 'linkrateinfo':        linkrateinfo($lid); break;
    case 'modifylinkrequest':   include(NUKE_MODULES_DIR.$module_name.'/public/ModifyLinkRequest.php'); break;
    case 'modifylinkrequestS':  modifylinkrequestS($lid, $cat, $title, $image, $url, $description, $modifysubmitter); break;
    case 'MostPopular':         include(NUKE_MODULES_DIR.$module_name.'/public/MostPopular.php');  break;
    case 'NewLinks':            include(NUKE_MODULES_DIR.$module_name.'/public/NewLinks.php'); break;
    case 'NewLinksDate':        include(NUKE_MODULES_DIR.$module_name.'/public/NewLinksDate.php'); break;
    case 'outsidelinksetup':    include(NUKE_MODULES_DIR.$module_name.'/public/OutSideLinkSetup.php'); break;
    case 'RandomLink':          RandomLink(); break;
    case 'ratelink':            include(NUKE_MODULES_DIR.$module_name.'/public/RateLink.php'); break;
    case 'search':              include(NUKE_MODULES_DIR.$module_name.'/public/Search.php'); break;
    case 'TopRated':            include(NUKE_MODULES_DIR.$module_name.'/public/TopRated.php'); break;
    case 'viewlink':            include(NUKE_MODULES_DIR.$module_name.'/public/ViewLink.php'); break;
    case 'viewlinkcomments':    include(NUKE_MODULES_DIR.$module_name.'/public/ViewLinkComments.php'); break;
    case 'viewlinkeditorial':   include(NUKE_MODULES_DIR.$module_name.'/public/ViewLinkEditorial.php'); break;
    case 'viewlinkdetails':     include(NUKE_MODULES_DIR.$module_name.'/public/ViewLinkDetails.php'); break;
    default:                    include(NUKE_MODULES_DIR.$module_name.'/public/index.php'); break;
}

?>