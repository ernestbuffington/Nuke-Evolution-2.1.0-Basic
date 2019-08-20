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

if (!defined('IN_DOWNLOADS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN DOWNLOADS ADMINISTRATION');
}

    /* Check if Title exist */
    if (empty($licensetitle)) {
        DownloadsHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<strong>" . $lang_new[$module_name]['ERROR_NO_TITLE'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
    /* Check if URL exist */
    if (empty($licenseurl) && empty($licensetext)) {
        DownloadsHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<strong>" . $lang_new[$module_name]['ERROR_NO_URL'] . "<br />".$lang_new[$module_name]['OR']."</strong><br />"
            ."<strong>" . $lang_new[$module_name]['ERROR_NO_DESCRIPTION'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
    $db->sql_query("INSERT INTO `"._DOWNLOADS_LICENSES_TABLE."` (`license_id`, `license_title` , `license_text` , `license_url`)
              VALUES (NULL, '".$licensetitle."', '".$licensetext."', '".$licenseurl."')");
    DownloadsHeader();
    OpenTable();
    echo "<center><span class=\"option\">";
    echo  $lang_new[$module_name]['MESSAGE_LICENSE_ADDED'] . "<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

?>