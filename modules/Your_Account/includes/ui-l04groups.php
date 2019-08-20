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

global $db, $usrinfo;
// Group Memberships
$result = $db->sql_query('SELECT ug.`group_id`, g.`group_name`, g.`group_type` FROM (`'.USER_GROUP_TABLE.'` ug INNER JOIN `'.GROUPS_TABLE.'` g ON g.`group_id` = ug.`group_id` AND g.`group_single_user` = 0) WHERE ug.`user_pending` = 0 AND ug.`user_id` = "'.$usrinfo['user_id'].'"');
if ($db->sql_numrows($result) > 0) {
    echo "<br />";
    OpenTable();
    $usrcolor = UsernameColor($usrinfo['username']);
    echo "<strong>".$usrcolor."'s "._MEMBERGROUPS.":</strong><br />\n";
    while(list($gid, $gname, $gtype) = $db->sql_fetchrow($result)) {
        if ((isset($usrinfo['groups'][$gid])  || ($gtype != 2)) || is_admin()) {
            $grpcolor = GroupColor($gname);
            echo "<a href=\"modules.php?name=Groups&amp;g=$gid\">".$grpcolor."</a>";
            if(is_mod_admin($module_name)) { echo "&nbsp;($gid)"; }
            echo "<br />";
        }
    }
    $db->sql_freeresult($result);
    CloseTable();
}

?>