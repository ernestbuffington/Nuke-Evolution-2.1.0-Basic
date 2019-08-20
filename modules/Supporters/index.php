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

global $admin_file, $userinfo, $nsnst_const, $_GETVAR, $file_mode, $currentlang, $board_config, $evoconfig;

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = $lang_new[$module_name]['SP_SUPPORTERS'];

include_once(NUKE_MODULES_DIR.$module_name.'/includes/nsnsp_func.php');
$supporter_config = spget_configs();

$op = $_GETVAR->get('op', '_REQUEST', 'string');

$textrowcol = "rows='10' cols='75'";
switch ($op) {
    case 'SPGo':
        include(NUKE_MODULES_DIR.$module_name.'/public/SPGo.php');
    break;
    case 'SPSubmit':
        include(NUKE_MODULES_DIR.$module_name.'/public/SPSubmit.php');
    break;
    case 'SPSubmitSave':
        include(NUKE_MODULES_DIR.$module_name.'/public/SPSubmitSave.php');
    break;
    case 'SPIndex':
        include(NUKE_MODULES_DIR.$module_name.'/public/SPIndex.php');
    break;
    default:
        include(NUKE_MODULES_DIR.$module_name.'/public/SPIndex.php');
    break;
}

?>