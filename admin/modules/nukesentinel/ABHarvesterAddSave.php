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

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

global $admin_file, $db, $ab_config, $_GETVAR;

if (is_admin()) {

    $another    = $_GETVAR->get('another', '_REQUEST', 'int', 0);
    $harvester  = $_GETVAR->get('harvester', '_REQUEST', 'string');
    $testnum1 = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_HARVESTER_TABLE."` WHERE `harvester`='$harvester'");
    if($testnum1 > 0) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        OpenMenu(_AB_ADDHARVESTERERROR);
        mastermenu();
        CarryMenu();
        harvestermenu();
        CloseMenu();
        CloseTable();
        echo '<br />'."\n";
        OpenTable();
        echo '<center><strong>'._AB_HARVESTEREXISTS.'</strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } elseif($harvester == "") {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        OpenMenu(_AB_EDITHARVESTERERROR);
        mastermenu();
        CarryMenu();
        harvestermenu();
        CloseMenu();
        CloseTable();
        echo '<br />'."\n";
        OpenTable();
        echo '<center><strong>'._AB_HARVESTEREMPTY.'</strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $db->sql_uquery("INSERT INTO `"._SENTINEL_HARVESTER_TABLE."` (`harvester`) VALUES ('$harvester')");
        $db->sql_uquery("ALTER TABLE `"._SENTINEL_HARVESTER_TABLE."` ORDER BY `harvester`");
        $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_HARVESTER_TABLE."`");
        $list_harvester = $ab_config['list_harvester']."\r\n".$harvester;
        $list_harvester = explode("\r\n", $list_harvester);
        rsort($list_harvester);
        $endlist = count($list_harvester)-1;
        if (empty($list_harvester[$endlist])) {
            array_pop($list_harvester);
        }
        sort($list_harvester);
        $list_harvester = implode("\r\n", $list_harvester);
        absave_config("list_harvester", $list_harvester);
        if($another == 1) {
            redirect($admin_file.'.php?op=ABHarvesterAdd');
        }else {
            redirect($admin_file.'.php?op=ABHarvesterList');
        }
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>