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

global $ab_config, $db, $admin_file, $bgcolor1, $bgcolor2;

if(is_god_admin()) {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_LISTHTTPAUTH);
    mastermenu();
    CarryMenu();
    authmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="80%">'."\n";
    if(!empty($ab_config['staccess_path'])  AND is_writable($ab_config['staccess_path'])){
        echo '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="5"><strong>'._AB_BUILDCGI.': <a href="'.$admin_file.'.php?op=ABCGIBuild">'.$ab_config['staccess_path'].'</a></strong></td></tr>'."\n";
    }
    echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
    echo '<td width="30%"><strong>'._AB_ADMIN.'</strong></td>'."\n";
    echo '<td width="25%"><strong>'._AB_AUTHLOGIN.'</strong></td>'."\n";
    echo '<td width="25%" align="center"><strong>'._AB_PASSWORD.'</strong></td>'."\n";
    echo '<td width="10%" align="center"><strong>'._AB_PROTECTED.'</strong></td>'."\n";
    echo '<td width="10%" align="center"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
    echo '</tr>'."\n";
    $adminresult = $db->sql_query("SELECT * FROM `"._SENTINEL_ADMINS_TABLE."` ORDER BY `aid`");
    while($adminrow = $db->sql_fetchrow($adminresult)) {
        if ($adminrow['password'] > '') {
            $adminrow['password'] = _AB_SET;
        } else {
            $adminrow['password'] = _AB_UNSET;
        }
        if ($adminrow['protected']==0) {
            $adminrow['protected'] = "<em>"._AB_NO."</em>";
        } else {
            $adminrow['protected'] = _AB_YES;
        }
        echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
        echo '<td>'.UsernameColor($adminrow['aid']).'</td>'."\n";
        echo '<td>'.$adminrow['login'].'</td>'."\n";
        echo '<td align="center">'.$adminrow['password'].'</td>'."\n";
        echo '<td align="center">'.$adminrow['protected'].'</td>'."\n";
        echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=';
        if ($adminrow['password']==_AB_SET) {
            echo 'ABAuthResend';
        } else {
            echo 'ABAuthEdit';
        }
        echo '&amp;a_aid='.$adminrow['aid'].'"><img src="images/nukesentinel/resend.png" height="16" width="16" border="0" alt="'._AB_RESEND.'" title="'._AB_RESEND.'" /></a> ';
        echo '<a href="'.$admin_file.'.php?op=ABAuthEdit&amp;a_aid='.$adminrow['aid'].'"><img src="images/nukesentinel/edit.png" height="16" width="16" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" /></a></td>'."\n";
        echo '</tr>'."\n";
    }
    $db->sql_freeresult($result);
    echo '</table>'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>