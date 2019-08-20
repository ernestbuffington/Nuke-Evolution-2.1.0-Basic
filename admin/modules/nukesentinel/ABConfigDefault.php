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

global $admin_file, $ab_config, $bgcolor2;

if (is_admin()) {

    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_DEFAULTBLOCKER);
    mastermenu();
    CarryMenu();
    configmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    echo '<form action="'.$admin_file.'.php" method="post">'."\n";
    echo '<input type="hidden" name="xblocker_row[block_name]" value="other" />'."\n";
    echo '<input type="hidden" name="xop" value="'.$op.'" />'."\n";
    echo '<input type="hidden" name="op" value="ABConfigSave" />'."\n";
    $blocker_row = abget_blocker('other');
    $blocker_row['duration'] = $blocker_row['duration'] / 86400;
    echo '<input type="hidden" name="xblocker_row[activate]" value="'.$blocker_row['activate'].'" />'."\n";
    echo '<input type="hidden" name="xblocker_row[htaccess]" value="'.$blocker_row['htaccess'].'" />'."\n";
    echo '<input type="hidden" name="xblocker_row[forward]" value="'.$blocker_row['forward'].'" />'."\n";
    echo '<input type="hidden" name="xblocker_row[block_type]" value="'.$blocker_row['block_type'].'" />'."\n";
    echo '<input type="hidden" name="xblocker_row[email_lookup]" value="'.$blocker_row['email_lookup'].'" />'."\n";
    echo '<input type="hidden" name="xblocker_row[duration]" value="'.$blocker_row['duration'].'" />'."\n";
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
    echo '<tr><td align="center" bgcolor="'.$bgcolor2.'" colspan="2"><strong>'._AB_DEFAULTBLOCKER.'</strong></td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'">'.evo_help_img(_AB_HELP_015).' '._AB_TEMPLATE.':</td><td><select name="xblocker_row[template]">'."\n";
    $templatedir = dir(NUKE_INCLUDE_DIR.'nukesentinel/abuse');
    $templatelist = '';
    while($func=$templatedir->read()) {
        if (substr($func, 0, 6) == 'abuse_') {
            $templatelist .= $func.' ';
        }
    }
    closedir($templatedir->handle);
    $templatelist = explode(" ", $templatelist);
    sort($templatelist);
    for($i=0; $i < sizeof($templatelist); $i++) {
        if($templatelist[$i]!="") {
            $bl = preg_replace('#abuse_#', '', $templatelist[$i]);
            $bl = preg_replace('#.tpl#', '', $bl);
            $bl = preg_replace('#_#', ' ', $bl);
            echo '<option';
            if ($templatelist[$i]==$blocker_row['template']) {
                echo ' selected="selected"';
            }
            echo ' value="'.$templatelist[$i].'">'.ucfirst($bl).'</option>'."\n";
        }
    }
    echo '</select></td></tr>'."\n";
    echo '<tr><td bgcolor="'.$bgcolor2.'">'.evo_help_img(_AB_HELP_017).' '._AB_REASON.':</td><td><input type="text" name="xblocker_row[reason]" size="20" maxlength="20" value="'.$blocker_row['reason'].'" /></td></tr>'."\n";
    echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
    echo '</table>'."\n";
    echo '</form>'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}
?>