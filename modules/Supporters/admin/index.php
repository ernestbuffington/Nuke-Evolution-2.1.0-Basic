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
$textrowcol = "rows='10' cols='50'";

global $db, $admin_file, $file_mode, $cache, $currentlang;
if(is_mod_admin($module_name)) {
    getmodule_lang($module_name);

    if (!defined('IN_SUPPORTER_ADMIN')) {
        define('IN_SUPPORTER_ADMIN', TRUE);
    }
    include_once(NUKE_MODULES_DIR.$module_name.'/includes/nsnsp_func.php');
    $supporter_config = spget_configs();

    $lang_path = NUKE_MODULES_DIR . $module_name . '/language/';

    $op = $_GETVAR->get('op', '_REQUEST');
    switch ($op) {
        case 'SPMain':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPConfig.php');
        break;
        case 'SPActivate':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPActivate.php');
        break;
        case 'SPActive':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPActive.php');
        break;
        case 'SPAdd':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPAdd.php');
        break;
        case 'SPAddSave':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPAddSave.php');
        break;
        case 'SPApprove':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPApprove.php');
        break;
        case 'SPApproveSave':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPApproveSave.php');
        break;
        case 'SPConfig':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPConfig.php');
        break;
        case 'SPConfigSave':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPConfigSave.php');
        break;
        case 'SPDeactivate':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPDeactivate.php');
        break;
        case 'SPDelete':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPDelete.php');
        break;
        case 'SPDeleteConfirm':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPDeleteConfirm.php');
        break;
        case 'SPEdit':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPEdit.php');
        break;
        case 'SPEditSave':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPEditSave.php');
        break;
        case 'SPInactive':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPInactive.php');
        break;
        case 'SPPending':
            include(NUKE_MODULES_DIR.$module_name.'/admin/SPPending.php');
        break;
    }
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>