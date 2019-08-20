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

global $admin_file, $db, $bgcolor2;

if (is_admin()) {

    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_ADDEXCLUDED);
    mastermenu();
    CarryMenu();
    excludedmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    echo '<form action="'.$admin_file.'.php" method="post">'."\n";
    echo '<input type="hidden" name="op" value="ABExcludedAddSave" />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
    echo '<tr><td align="center" class="content" colspan="2">'._AB_ADDEXCLUDEDS.'</td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPLO.':</strong></td>'."\n";
    echo '<td><input type="text" name="xip_lo[0]" size="4" maxlength="3" style="text-align: center;" />'."\n";
    echo '. <input type="text" name="xip_lo[1]" size="4" value="0" maxlength="3" style="text-align: center;" />'."\n";
    echo '. <input type="text" name="xip_lo[2]" size="4" value="0" maxlength="3" style="text-align: center;" />'."\n";
    echo '. <input type="text" name="xip_lo[3]" size="4" value="0" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPHI.':</strong></td>'."\n";
    echo '<td><input type="text" name="xip_hi[0]" size="4" maxlength="3" style="text-align: center;" />'."\n";
    echo '. <input type="text" name="xip_hi[1]" size="4" value="255" maxlength="3" style="text-align: center;" />'."\n";
    echo '. <input type="text" name="xip_hi[2]" size="4" value="255" maxlength="3" style="text-align: center;" />'."\n";
    echo '. <input type="text" name="xip_hi[3]" size="4" value="255" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_NOTES.':</strong></td><td><textarea name="xnotes" rows="10" cols="60">'._AB_ADDBY.' '.$aid.'</textarea></td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_COUNTRY.':</strong></td>'."\n";
    echo '<td><select name="xc2c">'."\n";
    $result = $db->sql_query("SELECT * FROM `"._SENTINEL_COUNTRIES_TABLE."` ORDER BY `c2c`");
    while($countryrow = $db->sql_fetchrow($result)) {
        echo '<option value="'.$countryrow['c2c'].'">'.strtoupper($countryrow['c2c']).' - '.$countryrow['country'].'</option>'."\n";
    }
    $db->sql_freeresult($result);
    echo '</select></td></tr>'."\n";
    echo '<tr><td colspan="2" align="center"><input type="checkbox" name="another" value="1" checked="checked" />'._AB_ADDANOTHERRANGE.'</td></tr>'."\n";
    echo '<tr><td colspan="2" align="center"><input type="submit" value="'._AB_ADDEXCLUDED.'" /></td></tr>'."\n";
    echo '</table>'."\n";
    echo '</form>'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>