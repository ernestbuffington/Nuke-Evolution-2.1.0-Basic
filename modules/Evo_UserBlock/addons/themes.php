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

if(!defined('NUKE_EVO')) exit;

if (defined('ADMIN_FILE')) {
    global $_GETVAR, $admin_file, $evouserinfo_themes;
}

global $ThemeSel;

$qs = defined('ADMIN_FILE') ? $admin_file.'.php?' : '';
$qs_ary = explode('&', $_GETVAR->get('QUERY_STRING', '_SERVER'));
foreach($qs_ary as $var_temp => $value_temp) {
    $var_ary = explode('=', $value_temp);
    $var = $var_ary[0];
    $value = $var_ary[1];
    if ($var == 'name') {
        $name = $value;
        $qs .= $name.'&amp;';
    }
    if ($var != 'newlang' && $var != 'name')  {            
        $qs .= $var.'='.$value.'&amp;';
    }
}  

if (defined('ADMIN_FILE')) {
    $action = $qs;
} elseif (!$name) {
    $action = "index.php";
} else {
    $action = "modules.php?name=".$qs;
}

if (is_user()) {
    $evouserinfo_themes = "<div align='center'>\n"; 
    $evouserinfo_themes .= "<form method='post' action='" . $action . "'>\n";
    $evouserinfo_themes .= "<input type='hidden' name='tpreview' value='EvoUserBlocktpreview' />\n";
    $evouserinfo_themes .= "<input type='hidden' name='chngtheme' value='0' />\n";
    $evouserinfo_themes .= "<br />\n"; 
    $evouserinfo_themes .= GetThemeSelect('EvoUserBlocktpreview', 'user_themes', false, 'onchange="submit();"', $ThemeSel, 0);
    $evouserinfo_themes .= "<br />\n"; 
    $evouserinfo_themes .= "</form><br />\n"; 
    $evouserinfo_themes .= "</div>\n";
} else {
    $evouserinfo_themes = "<div align='center'>\n";
    $evouserinfo_themes .= "<form method='post' action='" . $action . "'>\n";
    $evouserinfo_themes .= "<input type='hidden' name='tpreview' value='EvoUserBlocktpreview' />\n";
    $evouserinfo_themes .= "<input type='hidden' name='chngtheme' value='0' />\n";
    $evouserinfo_themes .= "<br />\n";
    $evouserinfo_themes .= GetThemeSelect('EvoUserBlocktpreview', 'user_themes', false, 'onchange="submit();"', $ThemeSel, 0);
    $evouserinfo_themes .= "<br />\n";
    $evouserinfo_themes .= "</form><br />\n";
    $evouserinfo_themes .= "</div>\n";
}
?>