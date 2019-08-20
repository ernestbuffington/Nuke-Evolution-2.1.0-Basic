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
 Nuke-Evo Author        :   ReOrGaNiSaTiOn

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

if (!defined('MODULE_FILE') || !defined('DOWNLOADS_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}


global $module_name, $db, $cache, $lang_new, $downloadsconfig;

$modifysubmitter    = $_GETVAR->get('modifysubmitter', '_POST', 'string', '');
$modifyip           = $_GETVAR->get('modifyip', '_POST', 'string', '');
$did                = $_GETVAR->get('modifydid', '_POST', 'int', 0);

if ($downloadsconfig['securitycheck'] == 1) {
    $gfx_check = $_GETVAR->get($module_name.'gfx_check', '_POST', 'string', '');
    if (!security_code_check($gfx_check, 1, $module_name)) {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
    }
}

include_once(NUKE_BASE_DIR.'header.php');
DownloadsHeading();
OpenTable();

if (!empty($modifysubmitter)) {
// $downloadsconfig['blockunregmodify'] == 0) &&
    $result = $db->sql_query("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."`
                SET `download_modifier` = '".$modifysubmitter."',
                    `download_modifier_ip` = '".$modifyip."',
                    `download_broken` = '1',
                    `download_active` = '0',
                    `download_modified_time` = '".time()."'
                WHERE `did` = '".$did."'");
    if ( $result ) {
        $cache->delete('numbrokend', 'submissions');
        $output = "<br /><center>".$lang_new[$module_name]['INFO_THANKS']."<br /><br />".$lang_new[$module_name]['INFO_LOOK_AFTER']."</center><br />";
    } else {
        $output = "<br /><center>".$lang_new[$module_name]['ERROR_DB_INSERT']."</center><br />";
    }
    echo $output;
    CloseTable();
}

include_once(NUKE_BASE_DIR.'footer.php');

?>