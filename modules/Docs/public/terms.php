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

if (!defined('MODULE_FILE') && !defined('DOC_INDEX')) {
   die('You can\'t access this file directly...');
}

function terms() {
    global $module_name, $currentlang;
    include_once(NUKE_BASE_DIR.'header.php');
    title(_NSTERMS, $module_name, 'docs-logo.png');
    OpenTable();
    echo "<br /><table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" align=\"center\">";
    echo "<tr><td valign=\"top\">";
    echo "<div align=\"justify\"><span class=\"content\">";
    if (@file_exists(NUKE_MODULES_DIR.$module_name."/documents/terms-".$currentlang.".txt")) {
        @include(NUKE_MODULES_DIR.$module_name.'/documents/terms-'.$currentlang.'.txt');
    } else {
        @include(NUKE_MODULES_DIR.$module_name.'/documents/terms-english.txt');
    }
    echo "</span></div>";
    ns_doc_questions();
    echo "<br /></td></tr></table>";
    ns_doc_links();
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

switch ($op) {
    default:
        terms();
    break;
}

?>