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

global $evoconfig, $admin_file, $db, $ab_config, $_GETVAR, $bgcolor2, $bgcolor1;

if (is_admin()) {

    $op         = $_GETVAR->get('op', '_REQUEST', 'string');
    $min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $max        = $_GETVAR->get('max', '_REQUEST', 'int', 0);
    $column     = $_GETVAR->get('column', '_REQUEST', 'string', $ab_config['track_sort_column']);
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string', $ab_config['track_sort_direction']);
    $showmodule = $_GETVAR->get('showmodule', '_REQUEST', 'string', 'All_Modules');
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_TRACKEDIPS);
    mastermenu();
    CarryMenu();
    trackedmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    $tbcol = 6;
    $perpage = $ab_config['track_perpage'];
    if ($perpage == 0) {
        $perpage = 25;
    }
    if ($max == 0) {
        $max=$min+$perpage;
    }
    if (preg_match('#All.*Modules#', $showmodule) || !$showmodule ) {
        $modfilter = '';
    } elseif (preg_match('#Admin#', $showmodule)) {
        $modfilter = "WHERE page LIKE '%".$admin_file.".php%'";
    } elseif (preg_match('#Index#', $showmodule)) {
        $modfilter = "WHERE page LIKE '%index.php%'";
    } elseif (preg_match('#Backend#', $showmodule)) {
        $modfilter = "WHERE page LIKE '%backend.php%'";
    } else {
        $modfilter = "WHERE page LIKE '%name=$showmodule%'";
    }
    $totalselected = $db->sql_unumrows("SELECT `username`, `ip_addr`, MAX(`date`), COUNT(*) FROM `"._SENTINEL_TRACKED_IPS_TABLE."` $modfilter GROUP BY 1,2");
    if($totalselected > 0) {
        $selcolumn1 = $selcolumn2 = $selcolumn3 = $selcolumn4 = $selcolumn5 = $selcolumn6 = $seldirection1 = $seldirection2 = '';
        echo '<table summary="" width="100%" cellpadding="2" cellspacing="2" border="0">'."\n";
        echo '<tr>'."\n";
        // START Modules
        $handle=opendir('modules');
        $moduleslist = '';
        while ($file = readdir($handle)) {
            if ( (!preg_match("#^[.]#",$file)) && !preg_match("#html$#", $file) ) {
                $moduleslist .= "$file ";
            }
        }
        closedir($handle);
        $moduleslist .= "All_Modules &nbsp;Index &nbsp;Admin &nbsp;Backend";
        $moduleslist = explode(" ", $moduleslist);
        sort($moduleslist);
        echo '<td width="60%" nowrap="nowrap">'."\n";
        echo '<form action="'.$admin_file.'.php?op=ABTrackedList" method="post" style="padding: 0px; margin: 0px;">'."\n";
        echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
        echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
        echo '<strong>'._AB_MODULE.':</strong> <select name="showmodule">'."\n";
        for($i=0; $i < sizeof($moduleslist); $i++) {
            if ($moduleslist[$i] != '' ) {
                $moduleslist[$i] = str_replace("&nbsp;", " ", $moduleslist[$i]);
                echo '<option value="'.$moduleslist[$i].'" ';
                if ($showmodule == $moduleslist[$i] OR ((!$showmodule OR $showmodule == '') AND $moduleslist[$i] == "All_Modules")) {
                    echo ' selected="selected"';
                }
                echo '>'.str_replace("_", " ", $moduleslist[$i]).'</option>'."\n";
          }
        }
        echo '</select> <input type="submit" value="'._AB_GO.'" /></form></td>'."\n";
        // END Modules
        // Page Sorting
        if ($column == 'date') {
            $selcolumn3 = ' selected="selected"';
        } elseif ($column == 'username') {
            $selcolumn4 = ' selected="selected"';
        } elseif ($column == 5) {
            $selcolumn5 = ' selected="selected"';
        } elseif($column == 'c2c') {
            $selcolumn6 = ' selected="selected"';
        } else {
            $selcolumn1 = ' selected="selected"';
        }
        if ($direction == 'desc') {
            $seldirection2 = ' selected="selected"';
        } else {
            $seldirection1 = ' selected="selected"';
        }
        echo '<td align="right" width="40%" nowrap="nowrap">'."\n";
        echo '<form action="'.$admin_file.'.php?op=ABTrackedList" method="post" style="padding: 0px; margin: 0px;">'."\n";
        echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
        echo '<input type="hidden" name="showmodule" value="'.$showmodule.'" />'."\n";
        echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
        echo '<option value="ip_long"'.$selcolumn1.'>'._AB_IPTRACKED.'</option>'."\n";
        echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
        echo '<option value="username"'.$selcolumn4.'>'._AB_USERNAME.'</option>'."\n";
        echo '<option value="5"'.$selcolumn5.'>'._AB_HITS.'</option>'."\n";
        echo '<option value="c2c"'.$selcolumn6.'>'._AB_C2CODE.'</option>'."\n";
        echo '</select> <select name="direction">'."\n";
        echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
        echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
        echo '</select> <input type="submit" value="'._AB_SORT.'" />'."\n";
        echo '</form>'."\n";
        echo '</td>'."\n";
        // Page Sorting
        echo '</tr>'."\n";
        echo '</table>'."\n";
        echo '<table summary="" width="100%" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0">'."\n";
        echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
        echo '<td><strong>'._AB_IPADDRESS.'</strong></td>'."\n";
        echo '<td width="2%"><strong>&nbsp;</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_LASTVIEWED.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_HITS.'</strong></td>'."\n";
        echo '<td align="center"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
        echo '</tr>'."\n";
        $result = $db->sql_query("SELECT `user_id`, `username`, `ip_addr`, MAX(`date`), COUNT(*), MIN(`tid`), `c2c` FROM `"._SENTINEL_TRACKED_IPS_TABLE."` $modfilter GROUP BY 2,3 ORDER BY $column $direction LIMIT $min, $perpage");
        while(list($userid,$username,$ipaddr,$lastview,$hits,$tid,$c2c) = $db->sql_fetchrow($result)){
            echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
            echo '<td>';
            if ($userid != ANONYMOUS) {
                echo '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$username.'" target="_blank"><img src="images/nukesentinel/usericon.png" height="16" width="16" alt="'.$username.'" title="'.$username.'" border="0" /></a>';
            } else {
                echo '<img src="images/nukesentinel/anonicon.png" height="16" width="16" alt="'._ANONYMOUS.'" title="'.$evoconfig['anonymous'].'" border="0" />';
            }
            echo ' <a href="'.$ab_config['lookup_link'].$ipaddr.'" target="_blank">'.$ipaddr.'</a></td>'."\n";
            $getIPs['flag_img'] = flag_img($c2c);
            echo '<td width="2%">'.$getIPs['flag_img'].'</td>'."\n";
            echo '<td align="center">'.date("Y-m-d \@ H:i:s",$lastview).'</td>'."\n";
            echo '<td align="center">'.$hits.'</td>'."\n";
            echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABTrackedPagesPrint&amp;user_id='.$userid.'&amp;ip_addr='.$ipaddr.'" target="_blank"><img src="images/nukesentinel/print.png" height="16" width="16" alt="'._AB_PRINT.'" title="'._AB_PRINT.'" border="0" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABTrackedPages&amp;user_id='.$userid.'&amp;ip_addr='.$ipaddr.'" target="_blank"><img src="images/nukesentinel/view.png" height="16" width="16" alt="'._AB_VIEW.'" title="'._AB_VIEW.'" border="0" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABTrackedAdd&amp;tid='.$tid.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;showmodule='.$showmodule.'" target="_blank"><img src="images/nukesentinel/block.png" height="16" width="16" alt="'._AB_BLOCK.'" title="'._AB_BLOCK.'" border="0" /></a>'."\n";
            echo '<a href="'.$admin_file.'.php?op=ABTrackedDelete&amp;tid='.$tid.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;showmodule='.$showmodule.'&amp;xop='.$op.'"><img src="images/nukesentinel/delete.png" height="16" width="16" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" border="0" /></a></td>'."\n";
            echo '</tr>'."\n";
        }
        $db->sql_freeresult($result);
        echo '</table>'."\n";
        abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction, "", $showmodule);
    } else {
        echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>