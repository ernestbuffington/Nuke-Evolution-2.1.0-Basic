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
 Nuke-Evo Author        :   ReOrGaNiSaTiOn

 Copyright (c) 2010 by The Nuke-Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS 'NOT' ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE 'NOT' ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if (!defined('NUKE_EVO')) {
   die('You can\'t access this file directly...');
}

$img_ok     = '<img src="install/images/ok.png" width="16px" height="16px" title="'.$lang_install['IMG_OK'].'" />';
$img_bad    = '<img src="install/images/error.png" width="16px" height="16px" title="'.$lang_install['IMG_BAD'].'" />';
$img_warn   = '<img src="install/images/warn.png" width="16px" height="16px" title="'.$lang_install['IMG_WARN'].'" />';
$img_done   = '<img src="install/images/tick.png" width="16px" height="16px" title="'.$lang_install['IMG_Done'].'" />';

$Installready = 0;
$Installerror = 0;
$Installnostep = 0;
for ($i = $InstallConfig['min_step']; $i < $InstallConfig['max_step']; $i++) {
    if ( $InstallConfig['Step_'.$i] == 1 && $InstallConfig['Step_'.$i.'_'.'_error'] == 2) {
        $Installready++;
    } elseif ( $InstallConfig['Step_'.$i.'_'.'_error'] == 1 )  {
        $Installerror++;
    } else {
        $Installnostep++;
    }
}

if ( ($InstallConfig['max_step']-1) == $Installready ) {
    $goback = 1;
    $gonext = 1;
} else {
    $goback = 1;
    $gonext = 0;
}

$InstallConfig['Step_'.$InstallConfig['step']] = 1;
if ( $Installerror > 0 || $Installnostep > 1 ) {
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
} else {
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 2;
}
$filetime = date('Y_m_d');
$db->sql_uquery('DROP TABLE IF EXISTS `evo_installer_vars`');
$db->sql_uquery('DROP TABLE IF EXISTS `evo_installer_done`');
@copy(NUKE_INSTALL_DIR.'log/install.log', NUKE_BASE_DIR.'includes/cache/install_log_'.$filetime.'.log'); 


install_header($goback, $gonext);

OpenTable();

if ( ($InstallConfig['max_step']-1) == $Installready ) {
    OpenTable2();
    echo "<div class='topictitle'><center>".$lang_install['Information_Setup_Ready']."</center></div>";
    CloseTable2();
    echo '<br />';
    OpenTable2();
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="color:green; text-align:center;">'.$lang_install['Information_Setup_Ready_allok'].'</div></td></tr>';
    echo '</table>';
    $showhome = 1;
    CloseTable2();
} elseif ( ($Installnostep > 1) && ($Installerror > 0)) {
    OpenTable2();
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="color:red; text-align:center;">'.$lang_install['Information_Setup_Ready_nostep'].'</div></td></tr></table>';
    $showhome = 1;
    CloseTable2();
}elseif ( $Installerror > 0) {
    OpenTable2();
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="color:red; text-align:center;">'.$lang_install['Information_Setup_Ready_error'].'</div></td></tr></table>';
    $showhome = 0;
    CloseTable2();
} else {
    OpenTable2();
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="color:red; text-align:center;">'.$lang_install['Information_Setup_Ready_noinfo'].'</div></td></tr></table>';
    $showhome = 0;
    CloseTable2();
}
echo "<br /><br />";
if ( $showhome == 1) {
    echo '<center><a href="http://www.evo-german.com/modules.php?name=Donations&amp;op=make"><img src="images/donations/horizontal_solution_PPeCheck.gif" alt="" title="" /><br />'.$lang_install['Donate'].'</a></center><br /><br />';
    echo '<center><a href="http://'.$InstallConfig['base_url'].'">[&nbsp;'.$lang_install['Information_Setup_GoHome'].'&nbsp;]</a>&nbsp;&nbsp;<a href="http://'.$InstallConfig['base_url'].'/admin.php">[&nbsp;'.$lang_install['Information_Setup_GoAdmin'].'&nbsp;]</a></center>';
}

echo "<br /><br />";

CloseTable();

?>