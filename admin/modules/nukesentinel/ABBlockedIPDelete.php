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

global $_GETVAR, $admin_file;

if (is_admin()) {

    $sip        = $_GETVAR->get('sip', '_GET', 'int');
    $xIPs       = $_GETVAR->get('xIPs', '_GET', 'string');
    $xop        = $_GETVAR->get('xop', '_GET', 'string');
    $min        = $_GETVAR->get('min', '_GET', 'int');
    $column     = $_GETVAR->get('column', '_GET', 'string');
    $direction  = $_GETVAR->get('direction', '_GET', 'string');
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_UNBLOCKIP);
    mastermenu();
    CarryMenu();
    blockedipmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    if (isset($xIPs) && !empty($xIPs)) {
        echo '<form action="'.$admin_file.'.php" method="post">'."\n";
        echo '<input type="hidden" name="op" value="ABBlockedIPDeleteSave" />'."\n";
        echo '<input type="hidden" name="xIPs" value="'.$xIPs.'" />'."\n";
        echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n";
        echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
        echo '<input type="hidden" name="sip" value="'.$sip.'" />'."\n";
        echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
        echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
        echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
        echo '<tr><td align="center" class="content">'._AB_UNBLOCKIPS.' '.$xIPs.'?</td></tr>'."\n";
        echo '<tr><td align="center"><input type="submit" value="'._AB_UNBLOCKIP.'" /></td></tr>'."\n";
        echo '<tr><td align="center">'._GOBACK.'</td></tr>'."\n";
        echo '</table>'."\n";
        echo '</form>'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        redirect($admin_file.'.php?op='.$xop);
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>