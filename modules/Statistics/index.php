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

global $_GETVAR, $currentlang, $board_config;

$op    = $_GETVAR->get('op', '_GET', 'string');
$year  = $_GETVAR->get('year', '_GET', 'int', 0);
$month = $_GETVAR->get('month', '_GET', 'int', 0);
$date  = $_GETVAR->get('date', '_GET', 'int', 0);

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = $lang_new[$module_name]['STATISTICS'];

define('IN_STATISTICS_MODULE', true);
require_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

include_once(NUKE_BASE_DIR.'header.php');


switch(strtolower($op)) {
    case 'stats':   Stats();                        break;
    case 'yearly':  YearlyStats($year);             break;
    case 'monthly': MonthlyStats($year,$month);     break;
    case 'daily':   DailyStats($year,$month,$date); break;
    default:        Stats_Main();                   break;
}

include_once(NUKE_BASE_DIR.'footer.php');

?>