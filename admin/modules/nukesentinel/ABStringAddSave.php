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

    $string     = $_GETVAR->get('string', '_REQUEST', 'string');
    $another    = $_GETVAR->get('another', '_REQUEST', 'int');
    $testnum1 = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_STRINGS_TABLE."` WHERE `string`='$string'");
    if ($testnum1 > 0) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        OpenMenu(_AB_ADDSTRINGERROR);
        mastermenu();
        CarryMenu();
        stringmenu();
        CloseMenu();
        CloseTable();
        echo '<br />'."\n";
        OpenTable();
        echo '<center><strong>'._AB_STRINGEXISTS.'</strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } elseif ($string == "") {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        OpenMenu(_AB_EDITSTRINGERROR);
        mastermenu();
        CarryMenu();
        stringmenu();
        CloseMenu();
        CloseTable();
        echo '<br />'."\n";
        OpenTable();
        echo '<center><strong>'._AB_STRINGEMPTY.'</strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $db->sql_uquery("INSERT INTO `"._SENTINEL_STRINGS_TABLE."` (`string`) VALUES ('$string')");
        $db->sql_uquery("ALTER TABLE `"._SENTINEL_STRINGS_TABLE."` ORDER BY `string`");
        $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_STRINGS_TABLE."`");
        $list_string = $ab_config['list_string']."\r\n".$string;
        $list_string = explode("\r\n", $list_string);
        rsort($list_string);
        $endlist = count($list_string)-1;
        if (empty($list_string[$endlist])) {
            array_pop($list_string);
        }
        sort($list_string);
        $list_string = implode("\r\n", $list_string);
        absave_config("list_string", $list_string);
        if($another == 1) {
            redirect($admin_file.'.php?op=ABStringAdd');
        }else {
            redirect($admin_file.'.php?op=ABStringList');
        }
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>