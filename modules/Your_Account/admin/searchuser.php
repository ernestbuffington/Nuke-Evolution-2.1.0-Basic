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

if (!defined('YA_ADMIN')) {
    die('CNBYA admin protection');
}


if(is_mod_admin($module_name)) {
    global $db, $admin_file, $_GETVAR, $evoconfig;

    $query    = $_GETVAR->get('query', '_REQUEST', 'string');
    $min      = $_GETVAR->get('min', '_REQUEST', 'int');
    $xop      = $_GETVAR->get('xop', '_REQUEST', 'string');
    $pagetitle = ': '._USERADMIN.' - '._SEARCHUSERS;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title(_USERADMIN.' - '._SEARCHUSERS);
    amain();
    echo "<br />\n";
    asearch();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>