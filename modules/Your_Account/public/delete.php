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

global $userinfo;
include_once(NUKE_BASE_DIR.'header.php');
$check = $userinfo['username'];
$result = $db->sql_query("SELECT user_id, username, user_password FROM "._USERS_TABLE." WHERE username='$check'");
list($uid, $uname, $pass) = $db->sql_fetchrow($result);
OpenTable();
echo "<center><span class=\"option\">"._SUREDELETE."<br /><a href=\"modules.php?name=$module_name&amp;op=deleteconfirm&amp;uid=$uid&amp;code=$pass\"><strong>"._YES."</strong></a> "._OR." <a href=\"modules.php?name=$module_name\"><strong>"._NO."</strong></a></span></center>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>