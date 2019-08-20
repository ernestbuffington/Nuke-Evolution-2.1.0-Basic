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

global $admin_file, $db, $_GETVAR, $bgcolor2;

if (is_admin()) {

    $harvester  = $_GETVAR->get('harvester', '_REQUEST', 'string');
    $hid        = $_GETVAR->get('hid', '_REQUEST', 'int');
    $xop        = $_GETVAR->get('xop', '_REQUEST', 'string');
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string');
    $testnum1 = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_HARVESTER_TABLE."` WHERE `harvester`='".$harvester."' AND `hid`!='".$hid."'");
    if ($testnum1 > 0) {
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
        echo '<center><strong>'._AB_HARVESTEREXISTS.'</strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } elseif ($harvester == '') {
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
        $getIPs = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_HARVESTER_TABLE."` WHERE `hid`='".$hid."' LIMIT 0,1");
        $db->sql_uquery("UPDATE `"._SENTINEL_HARVESTER_TABLE."` SET `harvester`='".$harvester."' WHERE `hid`='".$hid."'");
        $list_harvester = explode("\r\n", $ab_config['list_harvester']);
        $list_harvester = str_replace($getIPs['harvester'], $harvester, $list_harvester);
        rsort($list_harvester);
        $endlist = count($list_harvester)-1;
        if (empty($list_harvester[$endlist])) {
            array_pop($list_harvester);
        }
        sort($list_harvester);
        $list_harvester = implode("\r\n", $list_harvester);
        absave_config('list_harvester', $list_harvester);
        redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;direction='.$direction);
    }
}
?>