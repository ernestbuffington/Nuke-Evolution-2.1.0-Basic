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

global $userinfo, $evoconfig;
if (is_user() )  {
    include_once(NUKE_BASE_DIR.'header.php');
    title(_HOMECONFIG);
    OpenTable();
    nav();
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<form action=\"modules.php?name=$module_name\" method=\"post\">";
    if ($evoconfig['user_news'] == 1) {
        echo "<strong>"._NEWSINHOME."</strong> "._MAX127." ";
        echo "<input type=\"text\" name=\"storynum\" size=\"4\" maxlength=\"3\" value=\"".$userinfo['storynum']."\" />";
        echo "<br /><br />";
    } else {
        echo "<input type=\"hidden\" name=\"storynum\" value='".$evoconfig['storyhome']."' />";
    }
    echo "<input type=\"hidden\" name=\"username\" value=\"".$userinfo['username']."\" />";
    echo "<input type=\"hidden\" name=\"user_id\" value=\"".$userinfo['user_id']."\" />";
    echo "<input type=\"hidden\" name=\"op\" value=\"savehome\" />";
    echo "<input type=\"submit\" value=\""._YA_SAVECHANGES."\" />";
    echo "</form>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    mmain($user);
}

?>