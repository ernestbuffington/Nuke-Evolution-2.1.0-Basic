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

global $admin_file, $db, $_GETVAR, $bgcolor2, $bgcolor1, $ab_config;

if (is_admin()) {

    $op         = $_GETVAR->get('op', '_REQUEST', 'string');
    $min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $max        = $_GETVAR->get('max', '_REQUEST', 'int', 0);
    $column     = $_GETVAR->get('column', '_REQUEST', 'string', $ab_config['block_sort_column']);
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string', $ab_config['block_sort_direction']);
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_BLOCKEDIPS);
    mastermenu();
    CarryMenu();
    blockedipmenu();
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
    $selcolumn1 = $selcolumn2 = $selcolumn3 = $selcolumn4 = $selcolumn5 = $seldirection1 = $seldirection2 = '';
    $totalselected = $db->sql_unumrows("SELECT date FROM `"._SENTINEL_BLOCKED_IPS_TABLE."`");
    if($totalselected > 0) {
        if ($column == 'c2c') {
            $selcolumn2 = ' selected="selected"';
        } elseif($column == 'date') {
            $selcolumn3 = ' selected="selected"';
        } elseif($column == 'expires') {
            $selcolumn4 = ' selected="selected"';
        } elseif($column == 'reason') {
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
        echo '<tr>'."\n";
        echo '<td align="right" nowrap="nowrap">'."\n";
        echo '<form action="'.$admin_file.'.php?op=ABBlockedIPList" method="post" style="padding: 0px; margin: 0px;">'."\n";
        echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
        echo '<option value="ip_long"'.$selcolumn1.'>'._AB_IPBLOCKED.'</option>'."\n";
        echo '<option value="expires"'.$selcolumn2.'>'._AB_EXPIRES.'</option>'."\n";
        echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
        echo '<option value="reason"'.$selcolumn4.'>'._AB_REASON.'</option>'."\n";
        echo '<option value="c2c"'.$selcolumn5.'>'._AB_C2CODE.'</option>'."\n";
        echo '</select> <select name="direction">'."\n";
        echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
        echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
        echo '</select> <input type="hidden" name="min" value="'.$min.'" /><input type="submit" value="'._AB_SORT.'" />'."\n";
        echo '</form>'."\n";
        echo '</td>'."\n";
        echo '</tr>'."\n";
        echo '</table>'."\n";
        // Page Sorting
        echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
        echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
        echo '<td width="20%"><strong>'._AB_IPBLOCKED.'</strong></td>'."\n";
        echo '<td width="2%"><strong>&nbsp;</strong></td>'."\n";
        echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
        echo '<td align="center" width="25%"><strong>'._AB_EXPIRES.'</strong></td>'."\n";
        echo '<td align="center" width="20%"><strong>'._AB_REASON.'</strong></td>'."\n";
        echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
        echo '</tr>'."\n";
        $result = $db->sql_query("SELECT * FROM `"._SENTINEL_BLOCKED_IPS_TABLE."` ORDER BY `$column` $direction LIMIT $min,$perpage");
        while($getIPs = $db->sql_fetchrow($result)) {
            list($getIPs['reason']) = $db->sql_ufetchrow("SELECT `reason` FROM `"._SENTINEL_BLOCKERS_TABLE."` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1");
            $getIPs['reason'] = str_replace("Abuse-", "", $getIPs['reason']);
            $bdate = date("Y-m-d @ H:i:s", $getIPs['date']);
            $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
            if ($getIPs['expires']==0) {
                $bexpire = _AB_PERMENANT;
            } else {
                $bexpire = date("Y-m-d @ H:i:s", $getIPs['expires']);
            }
            list($bname) = $db->sql_ufetchrow("SELECT `username` FROM `"._USERS_TABLE."` WHERE `user_id`='".$getIPs['user_id']."' LIMIT 0,1");
            echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
            $qs = base64_decode($getIPs['query_string']);
            $qs = str_replace("%20", " ", $qs);
            $qs = str_replace("/**/", "/* */", $qs);
            $qs = str_replace("&", "<br />&", $qs);
            $gs = base64_decode($getIPs['get_string']);
            $gs = str_replace("%20", " ", $gs);
            $gs = str_replace("/**/", "/* */", $gs);
            $gs = str_replace("&", "<br />&", $gs);
            $ps = base64_decode($getIPs['post_string']);
            $ps = str_replace("%20", " ", $ps);
            $ps = str_replace("/**/", "/* */", $ps);
            $ps = str_replace("&", "<br />&", $ps);
            $ua = $getIPs['user_agent'];
            $getIPs['flag_img'] = flag_img($getIPs['c2c']);
            echo '<td>'.evo_info_img('<strong>'._AB_USERAGENT.':</strong> '.$ua.'<br /><br /><strong>'._AB_QUERY.':</strong> '.$qs.'<br /><br /><strong>'._AB_GET.':</strong> '.$gs.'<br /><br /><strong>'._AB_POST.':</strong> '.$ps).' <a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$getIPs['ip_addr'].'</a></td>'."\n";
            echo '<td width="2%">'.$getIPs['flag_img'].'</td>'."\n";
            echo '<td align="center">'.$bdate.'</td>'."\n";
            echo '<td align="center">'.$bexpire.'</td>'."\n";
            echo '<td align="center">'.$getIPs['reason'].'</td>'."\n";
            echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABBlockedIPViewPrint&amp;xIPs='.$getIPs['ip_addr'].'" target="_blank"><img src="images/nukesentinel/print.png" border="0" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" height="16" width="16" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABBlockedIPView&amp;xIPs='.$getIPs['ip_addr'].'" target="_blank"><img src="images/nukesentinel/view.png" border="0" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" height="16" width="16" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABBlockedIPEdit&amp;xIPs='.$getIPs['ip_addr'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABBlockedIPDelete&amp;xIPs='.$getIPs['ip_addr'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'"><img src="images/nukesentinel/unblock.png" border="0" alt="'._AB_UNBLOCK.'" title="'._AB_UNBLOCK.'" height="16" width="16" /></a></td>'."\n";
            echo '</tr>'."\n";
        }
        $db->sql_freeresult($result);
        echo '</table>'."\n";
        abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction);
    } else {
      echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>