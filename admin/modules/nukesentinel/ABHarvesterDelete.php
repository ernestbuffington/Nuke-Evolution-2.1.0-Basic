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

    $xop        = $_GETVAR->get('xop', '_REQUEST', 'string');
    $min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $hid        = $_GETVAR->get('hid', '_REQUEST', 'int');
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string', 'asc');

    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_HARVESTERDELETE);
    mastermenu();
    CarryMenu();
    harvestermenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    $getIPs = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_HARVESTER_TABLE."` WHERE `hid`='".$hid."' LIMIT 0,1");
    echo '<form action="'.$admin_file.'.php" method="post">'."\n";
    echo '<input type="hidden" name="op" value="ABHarvesterDeleteSave" />'."\n";
    echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n";
    echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
    echo '<input type="hidden" name="hid" value="'.$hid.'" />'."\n";
    echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
    echo '<tr><td align="center" class="content">'._AB_HARVESTERDELETES.' <strong>'.$getIPs['harvester'].'</strong>?</td></tr>'."\n";
    echo '<tr><td align="center"><input type="submit" value="'._AB_HARVESTERDELETE.'" /></td></tr>'."\n";
    echo '<tr><td align="center">'._GOBACK.'</td></tr>'."\n";
    echo '</table>'."\n";
    echo '</form>'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>