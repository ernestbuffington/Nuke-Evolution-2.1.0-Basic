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
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(dirname(__FILE__)));

if (is_user()) {
    get_lang($module_name);
    include_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

    global $db, $evoconfig, $thmcount;

    // Set TD widths
    $tds = 3;
    $thmcount = count(get_themes());
    if (is_active('Private_Messages')) { $tds++; }
    if (is_active('Journal')) { $tds++; }
    if (($thmcount > 1) AND ($evoconfig['allowusertheme'] == 0)) { $tds++; }
    if ($evoconfig['articlecomm'] == 1) { $tds++; }
    if ($evoconfig['allowuserdelete'] == 1) { $tds++; }
    $tdwidth = (int) ( (100/$tds) );
    // END Set TD widths

    function nav($main_up=0) {
        global $module_name, $admin, $evoconfig, $thmcount, $tdwidth;
        echo "<table border=\"0\" width=\"100%\" align=\"center\"><tr>\n";

        echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
        echo "<a href=\"modules.php?name=Profile&amp;op=editprofile\"><img src=\"".evo_image('info.png', $module_name)."\" border=\"0\" alt=\""._CHANGEYOURINFO."\" title=\""._CHANGEYOURINFO."\" /></a><br />\n";
        echo "<a href=\"modules.php?name=Profile&amp;op=editprofile\">"._ACCTCHANGE."</a>\n";
        echo "</td>\n";

        echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=edithome\"><img src=\"".evo_image('home.png', $module_name)."\" border=\"0\" alt=\""._CHANGEHOME."\" title=\""._CHANGEHOME."\" /></a><br />\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=edithome\">"._ACCTHOME."</a>\n";
        echo "</td>\n";

        if (is_active('Private_Messages')) {
            echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
            echo "<a href=\"modules.php?name=Private_Messages\"><img src=\"".evo_image('messages.png', $module_name)."\" border=\"0\" alt=\""._PRIVATEMESSAGES."\" title=\""._PRIVATEMESSAGES."\" /></a><br />\n";
            echo "<a href=\"modules.php?name=Private_Messages\">"._MESSAGES."</a>\n";
            echo "</td>\n";
        }

        if (is_active('Journal')) {
            echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
            echo "<a href=\"modules.php?name=Journal&amp;op=edit\"><img src=\"".evo_image('journal.png', $module_name)."\" border=\"0\" alt=\""._JOURNAL."\" title=\""._JOURNAL."\" /></a><br />\n";
            echo "<a href=\"modules.php?name=Journal&amp;op=edit\">"._ACCTJOURNAL."</a>\n";
            echo "</td>\n";
        }

        if ($evoconfig['allowuserdelete'] == 1) {
            echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
            echo "<a href=\"modules.php?name=Your_Account&amp;op=delete\"><img src=\"".evo_image('delete.png', $module_name)."\" border=\"0\" alt=\""._DELETEACCT."\" /></a><br />\n";
            echo "<a href=\"modules.php?name=Your_Account&amp;op=delete\">"._DELETEACCT."</a>\n";
            echo "</td>\n";
        }

        echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=logout\"><img src=\"".evo_image('exit.png', $module_name)."\" border=\"0\" alt=\""._LOGOUTEXIT."\" title=\""._LOGOUTEXIT."\" /></a><br />\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=logout\">"._ACCTEXIT."</a>\n";
        echo "</td>\n";

        echo "</tr></table>";
        if ($main_up != 1) { echo "<br /><center>[ <a href=\"modules.php?name=Your_Account\">"._RETURNACCOUNT."</a> ]</center>\n"; }
    }

} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _MODULEUSERS . $module_name);
}

?>