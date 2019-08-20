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

global $admin_file, $db, $ab_config, $_GETVAR, $bgcolor2, $bgcolor1;

if (is_admin()) {

    $sip        = $_GETVAR->get('sip', '_POST', 'string');
    $xop        = $_GETVAR->get('xop', '_POST', 'string');
    $min        = $_GETVAR->get('min', '_POST', 'int', 0);
    $max        = $_GETVAR->get('max', '_POST', 'int', 0);
    $column     = $_GETVAR->get('column', '_POST', 'string', 'ip_lo');
    $direction  = $_GETVAR->get('direction', '_POST', 'string', 'asc');
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_BLOCKEDRANGES);
    mastermenu();
    CarryMenu();
    blockedrangemenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    $perpage = $ab_config['track_perpage'];
    if ($perpage == 0) {
        $perpage = 25;
    }
    if ($max == 0) {
        $max=$min+$perpage;
    }
    $totalselected = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_BLOCKED_RANGES_TABLE."`");
    if($totalselected > 0) {
        $selcolumn1 = $selcolumn2 = $selcolumn3 = $selcolumn4 = $selcolumn5 = $seldirection1 = $seldirection2 = '';
        if ($column == 'c2c') {
            $selcolumn2 = ' selected="selected"';
        } elseif($column == "date") {
            $selcolumn3 = ' selected="selected"';
        } elseif($column == "expires") {
            $selcolumn4 = ' selected="selected"';
        } elseif($column == "reason") {
            $selcolumn5 = ' selected="selected"';
        } else {
            $selcolumn1 = ' selected="selected"';
        }
        if ($direction == 'desc') {
            $seldirection2 = ' selected="selected"';
        } else {
            $seldirection1 = ' selected="selected"';
        }
        // Page Sorting
        echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
        echo '<tr><td align="right" nowrap="nowrap">'."\n";
        echo '<form action="'.$admin_file.'.php?op=ABBlockedRangeList" method="post" style="padding: 0px; margin: 0px;">'."\n";
        echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
        echo '<option value="ip_lo"'.$selcolumn1.'>'._AB_IP2CRANGE.'</option>'."\n";
        echo '<option value="c2c"'.$selcolumn2.'>'._AB_C2CODE.'</option>'."\n";
        echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
        echo '<option value="expires"'.$selcolumn4.'>'._AB_EXPIRES.'</option>'."\n";
        echo '<option value="reason"'.$selcolumn5.'>'._AB_REASON.'</option>'."\n";
        echo '</select> <select name="direction">'."\n";
        echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
        echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
        echo '</select> <input type="hidden" name="min" value="'.$min.'" /><input type="submit" value="'._AB_SORT.'" />'."\n";
        echo '</form>'."\n";
        echo '</td></tr>'."\n";
        echo '</table>'."\n";
        // Page Sorting
        echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
        echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
        echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
        echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
        echo '<td align="center" width="2%"><strong>&nbsp;</strong></td>'."\n";
        echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
        echo '<td align="center" width="25%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
        echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
        echo '</tr>'."\n";
        $result = $db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_RANGES_TABLE."` ORDER BY $column $direction LIMIT $min,$perpage");
        while($getIPs = $db->sql_fetchrow($result)) {
            $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
            $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
            $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
            $masscidr = str_replace("||", ",<br />", $masscidr);
            if (stristr($masscidr, "<br />")) {
                $valign = ' valign="top"';
            } else {
                $valign = '';
            }
            $getIPs['c2c'] = strtoupper($getIPs['c2c']);
            $getIPs['flag_img'] = flag_img($getIPs['c2c']);
            echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
            echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_lo_ip'].'" target="_blank">'.$getIPs['ip_lo_ip'].'</a></td>'."\n";
            echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_hi_ip'].'" target="_blank">'.$getIPs['ip_hi_ip'].'</a></td>'."\n";
            echo '<td align="center"'.$valign.'>'.$getIPs['flag_img'].'</td>'."\n";
            echo '<td align="center"'.$valign.'>'.date("Y-m-d",$getIPs['date']).'</td>'."\n";
            echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
            echo '<td align="center"'.$valign.' nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABBlockedRangeViewPrint&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'" target="_blank"><img src="images/nukesentinel/print.png" border="0" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" height="16" width="16" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABBlockedRangeView&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'" target="_blank"><img src="images/nukesentinel/view.png" border="0" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" height="16" width="16" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'"><img src="images/nukesentinel/unblock.png" border="0" alt="'._AB_UNBLOCK.'" title="'._AB_UNBLOCK.'" height="16" width="16" /></a></td>'."\n";
            echo '</tr>'."\n";
        }
        $db->sql_freeresult($result);
        echo '</table>'."\n";
        abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction);
    } else {
        echo '<center><strong>'._AB_NORANGES.'</strong></center>'."\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>