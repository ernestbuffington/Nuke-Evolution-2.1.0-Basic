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

global $admin_file, $ab_config, $db, $bgcolor2, $bgcolor1, $_GETVAR;

if (is_admin()) {

    $sip        = $_GETVAR->get('sip', '_POST', 'string');
    $op         = $_GETVAR->get('op', '_REQUEST', 'string');
    $min        = $_GETVAR->get('min', '_POST', 'int', 0);
    $max        = $_GETVAR->get('max', '_POST', 'int', 0);
    $column     = $_GETVAR->get('column', '_POST', 'string', 'country');
    $direction  = $_GETVAR->get('direction', '_POST', 'string', 'asc');
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_COUNTRYLISTING);
    mastermenu();
    CarryMenu();
    blankmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    $perpage = $ab_config['block_perpage'];
    if ($perpage == 0) {
        $perpage = 25;
    }
    if ($max == 0) {
        $max=$min+$perpage;
    }
    $totalselected = $db->sql_unumrows("SELECT * FROM `"._SENTINEL_COUNTRIES_TABLE."`");
    if($totalselected > 0) {
        $selcolumn1=$selcolumn2=$seldirection1=$seldirection2='';
        // Page Sorting
        echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
        echo '<tr><td align="right" nowrap="nowrap">'."\n";
        echo '<form action="'.$admin_file.'.php?op=ABCountryList" method="post" style="padding: 0px; margin: 0px;">'."\n";
        echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
        echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
        if ($column == 'c2c') {
            $selcolumn1 = ' selected="selected"';
        }
        echo '<option value="c2c"'.$selcolumn1.'>'._AB_C2CODE.'</option>'."\n";
        if ($column == 'country') {
            $selcolumn2 = ' selected="selected"';
        }
        echo '<option value="country"'.$selcolumn2.'>'._AB_COUNTRY.'</option>'."\n";
        echo '</select> <select name="direction">'."\n";
        if ($direction == 'asc') {
            $seldirection1 = ' selected="selected"';
        }
        echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
        if ($direction == 'desc') {
            $seldirection2 = ' selected="selected"';
        }
        echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
        echo '</select> <input type="submit" value="'._AB_SORT.'" />'."\n";
        echo '</form>'."\n";
        echo '</td></tr>'."\n";
        echo '</table>'."\n";
        // Page Sorting
        echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
        echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
        echo '<td align="center" width="10%"><strong>'._AB_FLAG.'</strong></td>'."\n";
        echo '<td align="center" width="10%"><strong>'._AB_C2CODE.'</strong></td>'."\n";
        echo '<td width="80%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
        echo '</tr>'."\n";
        $result = $db->sql_query("SELECT * FROM `"._SENTINEL_COUNTRIES_TABLE."` ORDER BY $column $direction LIMIT $min,$perpage");
        while($getIPs = $db->sql_fetchrow($result)) {
            $getIPs['flag'] = flag_img($getIPs['c2c']);
            $getIPs['c2c'] = strtoupper($getIPs['c2c']);
            echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
            echo '<td align="center">'.$getIPs['flag'].'</td>'."\n";
            echo '<td align="center">'.strtoupper($getIPs['c2c']).'</td>'."\n";
            echo '<td>'.$getIPs['country'].'</td>'."\n";
            echo '</tr>'."\n";
        }
        $db->sql_freeresult($result);
        echo '</table>'."\n";
        abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction);
    } else {
        echo '<center><strong>'._AB_NOCOUNTRIES.'</strong></center>'."\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>