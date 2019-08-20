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

    $op         = $_GETVAR->get('op', '_REQUEST', 'string');
    $min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $max        = $_GETVAR->get('max', '_REQUEST', 'int', 0);
    $column     = $_GETVAR->get('column', '_REQUEST', 'string', 'username');
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string', 'asc');
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_TRACKEDUSERS);
    mastermenu();
    CarryMenu();
    trackedmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    $tbcol = 5;
    $perpage = $ab_config['track_perpage'];
    if ($perpage == 0) {
        $perpage = 25;
    }
    if ($max == 0) {
        $max=$min+$perpage;
    }
    $totalselected = $db->sql_unumrows("SELECT `username`, MAX(`date`), COUNT(*) FROM `"._SENTINEL_TRACKED_IPS_TABLE."` GROUP BY 1");
    if ($totalselected > 0) {
        // Page Sorting
        $selcolumn1 = $selcolumn2 = $selcolumn3 = $seldirection1 = $seldirection2= '';
        if ($column == 'date') {
            $selcolumn1 = ' selected="selected"';
        } elseif ($column == 4) {
            $selcolumn3 = ' selected="selected"';
        } elseif ($column == 'username') {
            $selcolumn2 = ' selected="selected"';
        }
        if ($direction == 'desc') {
            $seldirection2 = ' selected="selected"';
        } else {
            $seldirection1 = ' selected="selected"';
        }
        echo '<table summary="" width="100%" cellpadding="2" cellspacing="2" border="0">'."\n";
        echo '<tr>'."\n";
        echo '<td align="right" nowrap="nowrap">'."\n";
        echo '<form action="'.$admin_file.'.php?op=ABTrackedUsersList" method="post" style="padding: 0px; margin: 0px;">'."\n";
        echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
        echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
        echo '<option value="date"'.$selcolumn1.'>'._AB_DATE.'</option>'."\n";
        echo '<option value="username"'.$selcolumn2.'>'._AB_USERNAME.'</option>'."\n";
        echo '<option value="4"'.$selcolumn3.'>'._AB_HITS.'</option>'."\n";
        echo '</select> <select name="direction">'."\n";
        echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
        echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
        echo '</select> <input type="submit" value="'._AB_SORT.'" />'."\n";
        echo '</form>'."\n";
        echo '</td>'."\n";
        echo '</tr>'."\n";
        echo '</table>'."\n";
        // Page Sorting
        echo '<table summary="" width="100%" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0">'."\n";
        echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
        echo '<td><strong>'._AB_USERNAME.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_IPSTRACKED.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_LASTVIEWED.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_HITS.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
        echo '</tr>'."\n";
        $result = $db->sql_query("SELECT `user_id`, `username`, MAX(`date`), COUNT(*) FROM `"._SENTINEL_TRACKED_IPS_TABLE."` GROUP BY 2 ORDER BY $column $direction LIMIT $min, $perpage");
        while(list($userid,$username,$lastview,$hits) = $db->sql_fetchrow($result)){
            echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
            echo '<td>'."\n";
            if ($userid != ANONYMOUS) {
                echo '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$username.'" target="_blank">'.UsernameColor($username).'</a>';
            } else {
                echo _ANONYMOUS;
            }
            echo '</td>'."\n";
            $trackedips = $db->sql_unumrows("SELECT DISTINCT(`ip_addr`) FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `user_id`='$userid'");
            echo '<td align="center"><a href="'.$admin_file.'.php?op=ABTrackedUsersIPs&amp;tid='.$userid.'" target="_blank">'.$trackedips.'</a></td>'."\n";
            echo '<td align="center">'.date("Y-m-d \@ H:i:s",$lastview).'</td>'."\n";
            echo '<td align="center">'.$hits.'</td>'."\n";
            echo '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABTrackedUsersPagesPrint&amp;tid='.$userid.'" target="_blank"><img src="images/nukesentinel/print.png" height="16" width="16" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" border="0" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABTrackedUsersPages&amp;tid='.$userid.'" target="_blank"><img src="images/nukesentinel/view.png" height="16" width="16" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" border="0" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABTrackedUsersDelete&amp;user_id='.$userid.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'"><img src="images/nukesentinel/delete.png" height="16" width="16" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" border="0" /></a></td>'."\n";
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