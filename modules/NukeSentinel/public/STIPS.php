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

$pagetitle = _AB_NUKESENTINEL.": "._AB_BLOCKEDIPS;
include_once(NUKE_BASE_DIR.'header.php');
title(_AB_BLOCKEDIPS, $module_name, 'sentinel-logo.png');
stmain_menu(_AB_BLOCKEDIPS);
echo "<br />\n";
OpenTable();

$perpage    = $_GETVAR->get('perpage', '_REQUEST', 'int', 50);
$min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
$max        = $_GETVAR->get('max', '_REQUEST', 'int', $min + $perpage);
$column     = $_GETVAR->get('column', '_REQUEST', 'string', 'ip_long');
$direction  = $_GETVAR->get('direction', '_REQUEST', 'string', 'asc');
if ($column != 'ip_long' && $column != 'reason' && $column != 'date') {
    $column = 'ip_long';
} 

$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."`"));
if ($totalselected > 0) {
    $selcolumn1 = '';
    $selcolumn2 = '';
    $selcolumn3 = '';
    $seldirection1 = '';
    $seldirection2 = '';
    // Page Sorting
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
    echo '<tr><td align="right" colspan="3">'."\n";
    echo '<form action="modules.php?name='.$module_name.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="op" value="STIPS" />'."\n";
    echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
    echo '<strong>'._AB_SORT.':</strong> ';
    echo '<select name="column">'."\n";
    if ($column == 'ip_long') {
        $selcolumn1 = ' selected="selected"';
    }
    echo '<option value="ip_long"'.$selcolumn1.'>'._AB_IPBLOCKED.'</option>'."\n";
    if ($column == 'date') {
        $selcolumn2 = ' selected="selected"';
    }
    echo '<option value="date"'.$selcolumn2.'>'._AB_DATE.'</option>'."\n";
    if ($column == 'reason') {
        $selcolumn3 = ' selected="selected"';
    }
    echo '<option value="reason"'.$selcolumn3.'>'._AB_REASON.'</option>'."\n";
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
    echo '</td></tr>'."\n";
    echo '</table>'."\n";
    // Page Sorting
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td align="center" width="34%"><strong>'._AB_IPBLOCKED.'</strong></td>'."\n";
    echo '<td align="center" width="33%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td align="center" width="33%"><strong>'._AB_REASON.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $result = $db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` ORDER BY $column $direction LIMIT $min,$perpage");
    while ($getIPs = $db->sql_fetchrow($result)) {
        $bdate = date("Y-m-d @ H:i:s", $getIPs['date']);
        $lookupip = str_replace('*', '0', $getIPs['ip_addr']);
        echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
        if ((is_admin() AND $ab_config['display_link']==1) OR ((is_user() OR is_admin()) AND $ab_config['display_link']==2) OR $ab_config['display_link']==3) {
            $lookupip = str_replace('*', '0', $getIPs['ip_addr']);
            $ipcontent = '<a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$getIPs['ip_addr'].'</a>';
        } else {
            $ipcontent = $getIPs['ip_addr'];
        }
        echo '<td align="center">'.$ipcontent.'</td>'."\n";
        echo '<td align="center">'.$bdate.'</td>'."\n";
        $reason = "----------";
        if((is_admin() AND $ab_config['display_reason']==1) OR ((is_user() OR is_admin()) AND $ab_config['display_reason']==2) OR $ab_config['display_reason']==3) {
            $result2 = $db->sql_query("SELECT `reason` FROM `"._SENTINEL_BLOCKERS_TABLE."` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1");
            list($reason) = $db->sql_fetchrow($result2);
            $reason = str_replace('Abuse-','',$reason);
        }
        echo '<td align="center">'.$reason.'</td>'."\n";
        echo '</tr>'."\n";
    }
    $db->sql_freeresult($result);
    echo '</table>'."\n";
    stpagenumspub($op, $totalselected, $perpage, $max, $column, $direction);
} else {
  echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>