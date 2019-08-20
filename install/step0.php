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

$goback = 1;
$gonext = 1;
install_header($goback, $gonext);

OpenTable();
OpenTable2();
echo "<div class='topictitle'><center>".$lang_install['Welcome']."</center></div>";
CloseTable2();
echo '<br />';
if (strlen($lang_install['Language_Select']) > 2) {
    OpenTable2();
    echo "<div class='topictitle'><center>".$lang_install['Language_Select']."</center></div>";
    CloseTable2();
}
echo '<br />';
echo '<fieldset><legend>'.$lang_install['Server_Configuration_Details'].'1</legend>';
echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
echo '<table width="100%">';
echo '<tr><td class="row1" width="60%">'.$lang_install['Found_language'].'</td><td class="row1" width="40%">'.$InstallConfig['language'].'</td></tr>';
echo '<tr><td class="row1" width="60%">'.$lang_install['Found_language_change'].'</td>';
echo '<td class="row1" width="40%">';

$handle = opendir(NUKE_INSTALL_DIR.'language/');
$langs  = array();
while (false !== ($file = readdir($handle))) {
    if (is_dir(NUKE_INSTALL_DIR.'language/'.$file)) {
        if (preg_match('#lang_#i', $file)) {
            $file = substr($file, 5);
            $langs[] = $file;
        }
    }
}
closedir($handle);
sort($langs);
$out = '<select name="newlang" onchange="submit();">';
foreach ($langs as $choice) {
    $out .= '<option value="'.$choice.'"'.(($choice == $InstallConfig['language'])? ' selected="selected"' : '').'>'.$choice.'</option>';
}
$out .= '</select>';
echo $out;
echo '</td></tr>';
echo '</table></form></fieldset>';
echo '<br />';
echo '<fieldset><legend>'.$lang_install['Server_Configuration_Details'].'2</legend>';
echo '<table width="100%">';
echo '<tr><td class="row1" width="100%">'.$lang_install['License_Header'].'</td></tr>';
echo '<tr><td class="row1" width="100%" align="center"><textarea name="license_text" cols="110" rows="15">'.$lang_install['License_Text'].'</textarea></td></tr>';
echo '</table></fieldset>';
echo '<br />';

$InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 2;
evo_setcookie($InstallConfig);
$previous = $next = '';
if ($InstallConfig['old_step'] > $InstallConfig['min_step'] ) {
    $previous = '<a href="install.php?step='.$InstallConfig['old_step'].'"><img src="install/images/left.png" width="32" height="32" border="0" title="" alt="" /></a>';
}
if ($InstallConfig['next_step'] < $InstallConfig['max_step'] ) {
    $next = '<a href="install.php?step='.$InstallConfig['next_step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
}
echo "<div class='topictitle'><center>".$lang_install['License_Agreement']."</center></div><br />";
echo "<center>$previous&nbsp;&nbsp;$next</center>";
echo "<br /><br />";
CloseTable();

?>