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

if (!defined('MODULE_FILE') || !defined('NUKESENTINEL_PUBLIC') ) {
   die ('You can\'t access this file directly...');
}

global $_GETVAR, $ab_config, $bgcolor1, $bgcolor2, $module_name;

$pagetitle = _AB_NUKESENTINEL.": "._AB_BLOCKEDRANGES;
include_once(NUKE_BASE_DIR.'header.php');
title(_AB_BLOCKEDRANGES, $module_name, 'sentinel-logo.png');
stmain_menu(_AB_BLOCKEDRANGES);
echo "<br />\n";
OpenTable();

$perpage    = $_GETVAR->get('perpage', '_REQUEST', 'int', 50);
$min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
$max        = $_GETVAR->get('max', '_REQUEST', 'int', $min + $perpage);
$column     = $_GETVAR->get('column', '_REQUEST', 'string', 'ip_lo');
$direction  = $_GETVAR->get('direction', '_REQUEST', 'string', 'asc');
if ($column != 'ip_lo' && $column != 'date') {
    $column = 'ip_long';
} 

$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_RANGES_TABLE."`"));
if ($totalselected > 0) {
    $selcolumn1 = '';
    $selcolumn2 = '';
    $selcolumn3 = '';
    $seldirection1 = '';
    $seldirection2 = '';
    // Page Sorting
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
    echo '<tr>'."\n";
    echo '<td align="right" colspan="3">'."\n";
    echo '<form method="post" action="modules.php?name='.$module_name.'" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="op" value="STRanges" />'."\n";
    echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
    echo '<strong>'._AB_SORT.':</strong> ';
    echo '<select name="column">'."\n";
    if ($column == 'ip_lo') {
        $selcolumn1 = ' selected="selected"';
    }
    echo '<option value="ip_lo"'.$selcolumn1.'>'._AB_IP2CRANGE.'</option>'."\n";
    if ($column == 'date') {
        $selcolumn3 = ' selected="selected"';
    }
    echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
    echo '</select> ';
    echo '<select name="direction">'."\n";
    if ($direction == 'asc') {
        $seldirection1 = ' selected="selected"';
    }
    echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
    if ($direction == 'desc') {
        $seldirection2 = ' selected="selected"';
    }
    echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
    echo '</select> ';
    echo '<input type="submit" value="'._AB_SORT.'" />'."\n";
    echo '</form>'."\n";
    echo '</td>'."\n";
    echo '</tr>'."\n";
    echo '</table>'."\n";
    // Page Sorting
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td align="center" width="33%"><strong>'._AB_IPLO.'</strong></td>'."\n";
    echo '<td align="center" width="33%"><strong>'._AB_IPHI.'</strong></td>'."\n";
    echo '<td align="center" width="34%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $result = $db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_RANGES_TABLE."` ORDER BY $column $direction LIMIT $min,$perpage");
    while ($getIPs = $db->sql_fetchrow($result)) {
        $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
        $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
        echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
        echo '<td align="center">'.$getIPs['ip_lo_ip'].'</td>'."\n";
        echo '<td align="center">'.$getIPs['ip_hi_ip'].'</td>'."\n";
        echo '<td align="center">'.date("Y-m-d \@ H:i:s",$getIPs['date']).'</td>'."\n";
        echo '</tr>'."\n";
    }
    $db->sql_freeresult($result);
    echo '</table>'."\n";
    stpagenumspub($op, $totalselected, $perpage, $max, $column, $direction);
} else {
    echo '<center><strong>'._AB_NORANGES.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>