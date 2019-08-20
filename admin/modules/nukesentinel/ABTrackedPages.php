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

global $admin_file, $db, $bgcolor2, $bgcolor1, $ab_config, $_GETVAR;

if (is_admin()) {

    $op         = $_GETVAR->get('op', '_REQUEST', 'string');
    $min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $max        = $_GETVAR->get('max', '_REQUEST', 'int', 0);
    $column     = $_GETVAR->get('column', '_REQUEST', 'string', 'date');
    $direction  = $_GETVAR->get('direction', '_REQUEST', 'string', 'desc');
    $showmodule = $_GETVAR->get('showmodule', '_REQUEST', 'string');
    $tid        = $_GETVAR->get('tid', '_REQUEST', 'int');
    $user_id    = $_GETVAR->get('user_id', '_REQUEST', 'int');
    $ip_addr    = $_GETVAR->get('ip_addr', '_REQUEST', 'string');
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_PAGETRACKING);
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
    $result = $db->sql_query("SELECT `ip_long` FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `user_id`='$user_id' AND `ip_addr`='$ip_addr' LIMIT 0,1");
    list($ip_long) = $db->sql_fetchrow($result);
    echo '<center><strong>'.$ip_addr.'</strong></center><br />'."\n";
    // Page Sorting
    $selcolumn1 = $selcolumn2 = $seldirection1 = $seldirection2 = "";
    if ($column == 'page') {
        $selcolumn1 = ' selected="selected"';
    }
    if ($column == 'date') {
        $selcolumn2 = ' selected="selected"';
    }
    if ($direction == 'asc') {
        $seldirection1 = ' selected="selected"';
    }
    if ($direction == "desc") {
        $seldirection2 = ' selected="selected"';
    }
    echo '<table summary="" align="center" cellpadding="2" cellspacing="2" border="0" width="100%">'."\n";
    echo '<tr>'."\n";
    echo '<td align="right" nowrap="nowrap">'."\n";
    echo '<form method="post" action="'.$admin_file.'.php?op=ABTrackedPages" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
    echo '<input type="hidden" name="user_id" value="'.$user_id.'" />'."\n";
    echo '<input type="hidden" name="ip_addr" value="'.$ip_addr.'" />'."\n";
    echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
    echo '<option value="page"'.$selcolumn1.'>'._AB_PAGEVIEWED.'</option>'."\n";
    echo '<option value="date"'.$selcolumn2.'>'._AB_HITDATE.'</option>'."\n";
    echo '</select> <select name="direction">'."\n";
    echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
    echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
    echo '</select> <input type="submit" value="'._AB_SORT.'" />'."\n";
    echo '</form>'."\n";
    echo '</td>'."\n";
    echo '</tr>'."\n";
    echo '</table>'."\n";
    // Page Sorting
    echo '<table summary="" align="center" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0" width="100%">'."\n";
    echo '<tr>'."\n";
    echo '<td bgcolor="'.$bgcolor2.'" nowrap="nowrap" width="70%"><strong>'._AB_PAGEVIEWED.'</strong></td>'."\n";
    echo '<td bgcolor="'.$bgcolor2.'" nowrap="nowrap" width="20%"><strong>'._AB_DATE.'</strong></td>'."\n";
    echo '<td bgcolor="'.$bgcolor2.'" nowrap="nowrap" width="10%"><strong>&nbsp;</strong></td>'."\n";
    echo '</tr>'."\n";
    $result = $db->sql_query("SELECT `tid`, `page`, `date` FROM `"._SENTINEL_TRACKED_IPS_TABLE."` WHERE `ip_addr`='$ip_addr' AND `user_id`='$user_id' ORDER BY $column $direction LIMIT $min, $perpage");
    while(list($ltid, $page, $date_time) = $db->sql_fetchrow($result)){
        $page = str_replace(" ", "_", $page);
        if(strlen($page) > 50) {
            $rpage = substr($page, 0, 50)."...";
        } else {
            $rpage = $page;
        }
        echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
        echo '<td><a href="'.$page.'" target="_blank" title="'.$page.'">'.$rpage.'</a></td>'."\n";
        echo '<td nowrap="nowrap">'.date("Y-m-d \@ H:i:s",$date_time).'</td>'."\n";
        echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABTrackedDeleteSave&amp;tid='.$ltid.'&amp;user_id='.$user_id.'&amp;ip_addr='.$ip_addr.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;min='.$min.'"><img src="images/nukesentinel/delete.png" height="16" width="16" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" /></a></td>'."\n";
        echo '</tr>'."\n";
    }
    $db->sql_freeresult($result);
    echo '</table>'."\n";
    abadminpagenums($op, 1, $perpage, $max, $column, $direction);
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>