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

$op = $_GETVAR->get('op', 'request', 'string');

switch($op) {

    case 'BannersAdmin':
    case 'BannersAdd':
    case 'BannerAddClient':
    case 'BannerDelete':
    case 'BannerEdit':
    case 'BannerChange':
    case 'BannerClientDelete':
    case 'BannerClientEdit':
    case 'BannerClientChange':
    case 'BannerStatus':
    case 'add_banner':
    case 'add_client':
    case 'ad_positions':
    case 'position_add':
    case 'position_save':
    case 'position_edit':
    case 'position_delete':
    case 'ad_terms':
    case 'ad_plans':
    case 'ad_plans_add':
    case 'ad_plans_edit':
    case 'ad_plans_save':
    case 'ad_plans_delete':
    case 'ad_plans_status':
        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;

}

?>