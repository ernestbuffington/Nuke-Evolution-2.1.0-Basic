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

    $referer    = $_GETVAR->get('referer', '_REQUEST', 'string');
    $another    = $_GETVAR->get('another', '_REQUEST', 'int');

    $testnum1 = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_REFERERS_TABLE."` WHERE `referer`='$referer'");
    if($testnum1 > 0) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        OpenMenu(_AB_ADDREFERERERROR);
        mastermenu();
        CarryMenu();
        referermenu();
        CloseMenu();
        CloseTable();
        echo '<br />'."\n";
        OpenTable();
        echo '<center><strong>'._AB_REFEREREXISTS.'</strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } elseif ($referer == '') {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        OpenMenu(_AB_EDITREFERERERROR);
        mastermenu();
        CarryMenu();
        referermenu();
        CloseMenu();
        CloseTable();
        echo '<br />'."\n";
        OpenTable();
        echo '<center><strong>'._AB_REFEREREMPTY.'</strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $db->sql_uquery("INSERT INTO `"._SENTINEL_REFERERS_TABLE."` (`referer`) VALUES ('$referer')");
        $db->sql_uquery("ALTER TABLE `"._SENTINEL_REFERERS_TABLE."` ORDER BY `referer`");
        $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_REFERERS_TABLE."`");
        $list_referer = $ab_config['list_referer']."\r\n".$referer;
        $list_referer = explode("\r\n", $list_referer);
        rsort($list_referer);
        $endlist = count($list_referer)-1;
        if (empty($list_referer[$endlist])) {
            array_pop($list_referer);
        }
        sort($list_referer);
        $list_referer = implode("\r\n", $list_referer);
        absave_config("list_referer", $list_referer);
        if ($another == 1) {
            redirect($admin_file.'.php?op=ABRefererAdd');
        }else {
            redirect($admin_file.'.php?op=ABRefererList');
        }
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>