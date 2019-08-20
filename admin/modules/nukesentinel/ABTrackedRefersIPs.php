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
    $column     = $_GETVAR->get('column', '_REQUEST', 'string');
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string', 'asc');
    $tid        = $_GETVAR->get('tid', '_REQUEST', 'int');
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_REFERIPTRACKING);
    mastermenu();
    CarryMenu();
    trackedmenu();
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
    list($uname) = $db->sql_ufetchrow("SELECT `refered_from` FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `tid`='$tid' LIMIT 0,1");
    $totalselected = $db->sql_unumrows("SELECT DISTINCT(`ip_addr`) FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `refered_from`='$uname'");
    if ($totalselected > 0) {
        echo '<center><strong>'.$uname.'</strong></center><br />'."\n";
        echo '<table summary="" align="center" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0">'."\n";
        echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
        echo '<td nowrap="nowrap" width="40%"><strong>'._AB_IPADDRESSES.'</strong></td>'."\n";
        echo '<td align="center" width="30%"><strong>'._AB_DATE.'</strong></td>'."\n";
        echo '<td align="center" width="30%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
        echo '</tr>'."\n";
        $result = $db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `refered_from`='$uname' ORDER BY `ip_long` LIMIT $min, $perpage");
        while(list($lipaddr) = $db->sql_fetchrow($result)){
            $newrow = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `refered_from`='$uname' AND `ip_addr`='$lipaddr' ORDER BY `date` DESC LIMIT 1");
            $countrytitle = abget_countrytitle($newrow['c2c']);
            echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
            echo '<td><a href="'.$ab_config['lookup_link'].$lipaddr.'" target="_blank">'.$lipaddr.'</a></td>'."\n";
            echo '<td align="center" nowrap="nowrap">'.date("Y-m-d \@ H:i:s",$newrow['date']).'</td>'."\n";
            echo '<td align="center" nowrap="nowrap">'.$countrytitle['country'].'</td>'."\n";
            echo '</tr>'."\n";
        }
        $db->sql_freeresult($result);
        echo '</table>'."\n";
        abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction, "", "", $tid);
    } else {
        echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>