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

if (!defined('MODULE_FILE') && !defined('ADMIN_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA') && !defined('YA_ADMIN')) {
    die('CNBYA protection');
}

function init_group($uid) {
    global $db, $board_config, $cache;
    if($board_config['initial_group_id'] != '0' && $board_config['initial_group_id'] != NULL) {
        $initialusergroup = intval($board_config['initial_group_id']);
        if($initialusergroup == 0) {
            return;
        }
        $db->sql_uquery("INSERT INTO ".USER_GROUP_TABLE." (group_id, user_id, user_pending) VALUES ('$initialusergroup', $uid, '0')");
        add_group_attributes($uid, $initialusergroup);
    }
}

?>