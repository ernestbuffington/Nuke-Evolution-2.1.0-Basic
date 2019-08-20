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

global $_GETVAR, $bgcolor2, $admin_file;

if(is_god_admin()) {

    $a_aid = $_GETVAR->get('a_aid', '_GET', 'string');
    include_once(NUKE_BASE_DIR.'header.php');
    $sapi_name = strtolower(php_sapi_name());
    OpenTable();
    OpenMenu(_AB_EDITADMINS);
    mastermenu();
    CarryMenu();
    authmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    $admin_row = abget_admin($a_aid);
    echo '<form action="'.$admin_file.'.php" method="post">'."\n";
    echo '<input type="hidden" name="a_aid" value="'.$a_aid.'" />'."\n";
    echo '<input type="hidden" name="op" value="ABAuthEditSave" />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_ADMIN.':</strong></td>';
    echo '<td><strong>'.UsernameColor($a_aid).'</strong></td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_AUTHLOGIN.':</strong></td>';
    echo '<td><input type="text" name="xlogin" size="20" maxlength="25" value="'.$admin_row['login'].'" /></td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_PASSWORD.':</strong></td>';
    echo '<td><input type="text" name="xpassword" size="20" maxlength="20" value="'.$admin_row['password'].'" /></td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_PROTECTED.':</strong></td>';
    $sel1=$sel2='';
    if ($admin_row['protected']==0) {
        $sel1 = ' selected="selected"';
    } else {
        $sel2 = ' selected="selected"';
    }
    echo '<td><select name="xprotected">'."\n";
    echo '<option value="0"'.$sel1.'>'._AB_NOTPROTECTED.'</option>'."\n";
    echo '<option value="1"'.$sel2.'>'._AB_ISPROTECTED.'</option>'."\n";
    echo '</select></td></tr>'."\n";
    echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
    echo '</table>'."\n";
    echo '</form>'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>