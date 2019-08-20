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

global $_GETVAR;
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include(NUKE_MODULES_DIR.$module_name.'/public/doc_config.php');

define('DOC_INDEX', true);

$pagetitle = _NSINDEXLEGAL;

function main() {
    global $module_name, $questions;
    include_once(NUKE_BASE_DIR.'header.php');
    title(_NSINDEXLEGAL, $module_name, 'docs-logo.png');
    OpenTable();
    echo "<br /><br /><div align=\"justify\">";
    echo "<strong>".EVO_SERVER_SITENAME."</strong> "._NSINDEX1." <strong>".EVO_SERVER_SITENAME."</strong> "._NSINDEX2."<br /><br />";
    echo _NSINDEX3." <strong>".EVO_SERVER_SITENAME."</strong> "._NSINDEX4."<br /><br />";
    echo _NSINDEX5." ";
    ns_doc_questions();
    echo "</div><br /><br />";
    ns_doc_links();
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

$op = $_GETVAR->get('op', '_REQUEST');

switch ($op) {
    case 'about':
        include(NUKE_MODULES_DIR.$module_name.'/public/about.php');
        break;
    case 'disclaimer':
        include(NUKE_MODULES_DIR.$module_name.'/public/disclaimer.php');
        break;
    case 'privacy':
        include(NUKE_MODULES_DIR.$module_name.'/public/privacy.php');
        break;
    case 'terms':
        include(NUKE_MODULES_DIR.$module_name.'/public/terms.php');
        break;
    default:
        main();
    break;

}

?>