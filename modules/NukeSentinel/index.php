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
   die ('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
define('NUKESENTINEL_PUBLIC', true);
$ab_config = abget_configs();
$checkrow = $db->sql_numrows($db->sql_query("SELECT * FROM `"._SENTINEL_IP2COUNTRY_TABLE."` LIMIT 0,1"));
if ($checkrow > 0) {
    $tableexist = 1;
} else {
    $tableexist = 0;
}
$op = (isset($op) ? $op : 'STIndex');
if ($op == 'STIP2C' AND $tableexist != 1) {
    $op = 'STIndex';
}

include_once(NUKE_MODULES_DIR . $module_name . '/public/functions.php');

switch($op) {
    case 'STIndex':     include(NUKE_MODULES_DIR . $module_name . '/public/STIndex.php');   break;
    case 'STIPS':       include(NUKE_MODULES_DIR . $module_name . '/public/STIPS.php');     break;
    case 'STRanges':    include(NUKE_MODULES_DIR . $module_name . '/public/STRanges.php');  break;
    case 'STReferers':  include(NUKE_MODULES_DIR . $module_name . '/public/STReferers.php');break;
    case 'STIP2C':      include(NUKE_MODULES_DIR . $module_name . '/public/STIP2C.php');    break;
}

?>