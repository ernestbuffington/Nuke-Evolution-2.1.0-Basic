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

global $evoconfig, $tos_yes, $coppa_yes;

if( $submit == 'coppa' && !$coppa_yes ){
        include_once(NUKE_BASE_DIR.'header.php');
        title(_USERAPPLOGIN);
        OpenTable();
        echo "<img src=\"".evo_image('warning.png', $module_name)."\" align=\"left\" width=\"40\" height=\"40\" alt=\"\" /><center>"._YACOPPA2."</center></td>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\">"._YACOPPA1."</center>\n";
        echo "<p align=\"center\"><font color=\"#FF3333\">"._YACOPPA4."</font>\n";
        echo "<font color=\"#FF3333\">"._YACOPPAFAX."</font></p>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
}

include_once(NUKE_BASE_DIR.'header.php');
title(_USERAPPLOGIN);
OpenTable();
echo "<img src=\"".evo_image('warning.png', $module_name)."\" align=\"left\" width=\"40\" height=\"40\" alt=\"\" />\n";
echo "<center><p>".set_smilies(decode_bbcode($evoconfig['coppa_text'],1,true))."</p></center>\n";
CloseTable();
echo "<br />";
OpenTable();
echo "<form name=\"coppa1\" action=\"modules.php?name=$module_name&amp;op=new_user\" method=\"post\">\n";
echo "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\"><tr>\n";
echo "<td align=\"center\" colspan=\"2\" class=\"title\">"._YACOPPA1."</td></tr>\n";
echo "<tr><td align=\"center\" colspan=\"2\" ><p class=\"content\">"._YACOPPA3."</p></td></tr>\n";
echo "<tr><td align=\"center\"><p>";
echo yesno_option('coppa_yes', 0);
echo "</p></td></tr>\n";
echo "<tr><td align=\"center\" colspan=\"2\"><br /><input type=\"submit\" value='"._YA_CONTINUE."' />\n";
echo "<input type='hidden' name='submit' value='coppa' />";
echo "</td></tr>";
echo "</table></form>\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>