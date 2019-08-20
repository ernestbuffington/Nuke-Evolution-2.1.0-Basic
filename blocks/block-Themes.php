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

global $ThemeSel, $_GETVAR, $admin_file;

$qs = defined('ADMIN_FILE') ? $admin_file.'.php?' : '';
$qs_ary = explode('&', $_GETVAR->get('QUERY_STRING', '_SERVER'));
$blockcontent = '';
foreach($qs_ary as $var_temp => $value_temp) {
    $var_ary = explode('=', $value_temp);
    $var   = $var_ary[0];
    $value = (isset($var_ary[1]) ? $var_ary[1] : '');
    if ($var == 'name') {
        $name = $value;
        $qs .= $name.'&amp;';
    }
    if ($var != 'newlang' && $var != 'name')  {
        $qs .= $var.'='.$value.'&amp;';
    }
}

if (substr($qs, -5) == '&amp;') {
    $qs = substr($qs, 0, -5);
}
if (defined('ADMIN_FILE')) {
    $action = $qs;
} elseif (!isset($name)) {
    $action = 'index.php';
} else {
    $action = 'modules.php?name='.$qs;
}

if (is_user() && $evoconfig['allowusertheme']) {
    $blockcontent .= "<form method='post' action='" . $action . "'>\n";
    $blockcontent .= "<input type='hidden' name='tpreview' value='blockthemespreview' />\n";
    $blockcontent .= "<input type='hidden' name='chngtheme' value='0' />\n";
    $blockcontent .= "<label for='blockthemespreview'>&nbsp;</label>";
    $blockcontent .= GetThemeSelect('blockthemespreview', 'user_themes', true, 'onchange="submit();"', $ThemeSel, 0);
    $blockcontent .= "</form>\n";
} else {
    $blockcontent .= "<form method='post' action='" . $action . "'>\n";
    $blockcontent .= "<label for='blockthemespreview'>&nbsp;</label>";
    $blockcontent .= "<input type='hidden' name='tpreview' value='blockthemespreview' />\n";
    $blockcontent .= "<input type='hidden' name='chngtheme' value='0' />\n";
    $blockcontent .= GetThemeSelect('blockthemespreview', 'user_themes', true, 'onchange="submit();"', $ThemeSel, 0);
    $blockcontent .= "</form>\n";
}

$content = "<div style='width: 100%; text-align: center;'>\n";
if (empty($blockcontent)) {
    $content .= "<p style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</p>\n";
} else {
    $content .= $blockcontent;
}
$content .= "</div>\n";

?>