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

global $db, $evoconfig;
if (!is_user()) {
    include_once(NUKE_BASE_DIR.'header.php');
    Show_CNBYA_menu();

    if ($evoconfig['servermail']) {
        OpenTable();
        echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\"><tr>";
        echo "<form action=\"modules.php?name=$module_name\" method=\"post\">\n";
        echo "<td colspan=\"2\"><img src=\"modules/$module_name/images/warning.png\" align=\"left\" width=\"40\" height=\"40\" alt=\"\" />";
        echo "<span class=\"content\"><strong>"._PASSWORDLOST."</strong> "._NOPROBLEM."</td>";
        echo "</tr>";
        echo "<tr><td width=\"100%\">";
        echo "<table border=\"0\">\n";
        echo "<tr><td align='right'>"._NICKNAME.":</td><td><input type=\"text\" name=\"username\" size=\"15\" maxlength=\"25\" /></td></tr>\n";
        echo "<tr><td colspan='2' align='center'><strong>--"._OR."--</strong></td></tr>\n";
        echo "<tr><td align='right'>"._EMAIL.":</td><td><input type=\"text\" name=\"user_email\" size=\"15\" maxlength=\"50\" /></td></tr>\n";
        echo "<tr><td>"._CONFIRMATIONCODE.":</td><td><input type=\"text\" name=\"code\" size=\"11\" maxlength=\"10\" /></td></tr>";
        echo "</table>\n";
        echo "</td><td valign=\"top\"><br /></td></tr>";
        echo "<tr><td style='text-align:center;'>";
        echo "<input type=\"hidden\" name=\"op\" value=\"mailpasswd\" />\n";
        echo "<input type=\"submit\" value=\""._SENDPASSWORD."\" /><br />\n";
        echo "</td><td></td></form></tr></table>";
        CloseTable();
    } else {
        title(_SERVERNOMAIL);
    }
    include_once(NUKE_BASE_DIR.'footer.php');
} elseif (is_user()) {
    global $userinfo;
    redirect("modules.php?name=$module_name&amp;op=userinfo&amp;username=".$userinfo['username']);
}

?>