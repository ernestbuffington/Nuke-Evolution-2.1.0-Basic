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

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

include_once(NUKE_BASE_DIR.'header.php');
title(_USERAPPLOGIN);

global $evoconfig, $module_name, $setinfo;
// menelaos: shows top table (differently for new users and current members)
OpenTable();
if ( is_user() && !$setinfo['agreedtos'] ) {
    echo "<img src='".evo_image('warning.png', $module_name)."' align='left' width='40' height='40' alt='' /><center>"._YATOSINTRO1."</center>\n";
} else {
    echo "<img src='".evo_image('warning.png', $module_name)."' align='left' width='40' height='40' alt='' /><center>"._YATOSINTRO2."</center>\n";
}
CloseTable();
echo "<br />";

// menelaos: shows bottom table (differently for new users and current members)
OpenTable();
if ( !$setinfo['agreedtos'] && $setinfo['user_id'] ) {
    echo "<form name='tos1' action='modules.php?name=$module_name' method='POST'>\n";
    echo "<input type='hidden' name='username' value='".$username."' />\n";
    echo "<input type='hidden' name='user_password' value='".$user_password."' />\n";
    echo "<input type='hidden' name='gfx_check' value='".$gfx_check."' />\n";
    echo "<input type='hidden' name='redirect' value='".$redirect."' />\n";
    echo "<input type='hidden' name='mode' value='".$mode."' />\n";
    echo "<input type='hidden' name='f' value='".$f."' />\n";
    echo "<input type='hidden' name='t' value='".$t."' />\n";
    echo "<input type='hidden' name='op' value='login' />\n";
} else {
    echo "<form name='tos1' action='modules.php?name=$module_name&amp;op=new_user' method='post'>\n";
}

if ($coppa_yes) {
    echo "<input type='hidden' name='coppa_yes' value='1' />\n";
}
echo "<table width='100%' cellspacing='0' cellpadding='5' border='0'><tr align='center'>";
if ( ((!$setinfo['agreedtos']) && !$tos_yes) && $submit == 'tos') {
    if (!$setinfo['agreedtos']) {
        echo "<td><font color='#FF3333'>"._YATOS5."</font></td>\n";
    } else {
        echo "<td><font color='#FF3333'>"._YATOS4."</font></td>\n";
    }
    echo "</tr><tr align='center'><td><p><input type='submit' value='"._YA_GOBACK."' /></p></td></tr>\n";
} else {
    echo "<td class='title'>";
    echo "<strong>".EVO_SERVER_SITENAME." - "._YATOS1."</strong>";
    echo "<p>".set_smilies(decode_bbcode($evoconfig['tos_text'],1,true))."</p>\n";
    echo "</td></tr>";
    echo "<tr align='right'><td valign='top'>\n";
    echo _YATOS3."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo yesno_option('tos_yes', 0);
    echo "<br /><br /><input type='submit' value='"._YA_CONTINUE."' />\n";
    echo "<input type='hidden' name='submit' value='tos' />";
    echo "</td></tr>";
}
echo "</table></form>\n";
CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');

?>