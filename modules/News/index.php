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

define('NEWS_INDEX_FILE', true);

global $db, $evoconfig, $currentlang, $userinfo, $_GETVAR;

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = _NEWS;

include_once(NUKE_MODULES_DIR.$module_name.'/includes/nsnne_func.php');
$neconfig = ne_get_configs();

automated_news();
$main_module = main_module();
$actualtime  = actualTimeServer();
$acomm       = array();
// Set defaults for Article Comments
$acomm['allowed']  = ($evoconfig['articlecomm'] && (is_user() || is_admin() || ($evoconfig['anonpost'] && !is_user())) ? TRUE : FALSE);
if ($evoconfig['moderate'] > 0) {
    if (($evoconfig['moderate'] == 1) && is_user()) {
        $acomm['moderate'] = TRUE;
    } elseif (($evoconfig['moderate'] == 2) && is_admin()) {
        $acomm['moderate'] = TRUE;
    } else {
        $acomm['moderate'] = FALSE;
    }
} else {
    $acomm['moderate'] = FALSE;
}
$acomm['maxsize']  = $evoconfig['commentlimit'];

$op          = $_GETVAR->get('op', '_REQUEST', 'string', '');
$umode       = $_GETVAR->get('umode', '_REQUEST', 'string', (isset($userinfo['umode']) ? $userinfo['umode'] : ''));
$order       = $_GETVAR->get('order', '_REQUEST', 'int', (isset($userinfo['uorder']) ? $userinfo['uorder'] : ''));
$thold       = $_GETVAR->get('thold', '_REQUEST', 'int', (isset($userinfo['thold']) ? $userinfo['thold'] : ''));

$querylang   = ' AND (`alanguage`="'.$currentlang.'" OR `alanguage`="" OR `alanguage`=NULL)';
$display     = '&amp;umode='.$umode.'&amp;order='.$order.'&amp;thold='.$thold;
$display_ary = array('umode' => $umode, 'order' => $order, 'thold' => $thold);

if ($neconfig['homenumber'] == 0 && isset($userinfo['storynum'])) {
    $storynum = $userinfo['storynum'];
} else {
    $storynum = $neconfig['homenumber'];
}
$storynum = ($storynum <= 0 ? 10 : $storynum);

switch ($op) {
    case 'article':         include(NUKE_MODULES_DIR. $module_name .'/public/article.php'); break;
    case 'categories':      include(NUKE_MODULES_DIR. $module_name .'/public/categories.php'); break;
    case 'comments':        include(NUKE_MODULES_DIR. $module_name .'/public/comments.php'); break;
    case 'friend':          include(NUKE_MODULES_DIR. $module_name .'/public/friend.php'); break;
    case 'rate_article':    include(NUKE_MODULES_DIR. $module_name .'/public/rate_article.php'); break;
    case 'rate_complete':   include(NUKE_MODULES_DIR. $module_name .'/public/rate_article.php'); break;
    case 'read_article':    include(NUKE_MODULES_DIR. $module_name .'/public/read_article.php'); break;
    case 'print':           include(NUKE_MODULES_DIR. $module_name .'/public/print.php'); break;
    case 'topics':          include(NUKE_MODULES_DIR. $module_name .'/public/topics.php'); break;
    default:                include(NUKE_MODULES_DIR. $module_name .'/public/index.php'); break;
}

?>