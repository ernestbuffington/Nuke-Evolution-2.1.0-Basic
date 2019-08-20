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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

global $db, $userinfo, $_GETVAR, $evoconfig;

$name = $_GETVAR->get('name', '_GET', 'string');
$file = $_GETVAR->get('file', '_GET', 'string');
$mode = $_GETVAR->get('mode', '_GET', 'string');

if ( !isset($userinfo['user_level']) || ($userinfo['user_level'] < 1) OR ($userinfo['user_active'] < 1) ) {
    unset($userinfo);
}

if(isset($name) && isset($file) || isset($mode)) {
    if ( ($name=='Forums') && ($file=='profile') && ($mode=='register') ) {
        redirect("modules.php?name=Your_Account&amp;op=new_user");
    }
}

// CNB Mod
// WARNING THIS SECTION OF CODE PREVENTS NEW POSTS REGISTERING AS UNREAD

if (is_user()) {
    $lv = time();
    $result = $db->sql_query("SELECT time FROM "._SESSION_TABLE." WHERE uname='".$userinfo['username']."'");
    list($sessiontime) = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    if (($evoconfig['cookieinactivity'] != '-') AND ( ($sessiontime + $evoconfig['cookieinactivity'] < $lv ) ) ) {
        evo_setcookie('user', 'delete', -1);
        $db->sql_uquery("DELETE FROM "._SESSION_TABLE." WHERE uname='".$userinfo['username']."'");
        $db->sql_uquery("OPTIMIZE TABLE "._SESSION_TABLE);
        unset($userinfo);
        redirect('modules.php?name=Your_Account');
        exit;
    };

    // WARNING THIS SECTION OF CODE CAN SLOW SITE LOAD TIME DOWN!!!!!!!!!!!!!
    // IF YOU DO NOT WANT TO USE THIS CODE YOU DO NOT HAVE TO.
    // THIS FUNCTION IS IN USER ADMIN AND CAN BE TRIGGERED ONLY
    // WHEN THE ADMIN WANTS IT RUN.
    if (($evoconfig['autosuspend'] > 0) AND ($evoconfig['autosuspendmain']==1)) {
        $st = time() - $evoconfig['autosuspend'];
        $susresult = $db->sql_query("SELECT user_id FROM "._USERS_TABLE." WHERE user_lastvisit <= $st AND user_level > 0");
        while(list($sus_uid) = $db->sql_fetchrow($susresult)) {
            $db->sql_uquery("UPDATE "._USERS_TABLE." SET user_level='0', user_active='0' WHERE user_id='$sus_uid'");
        }
        $db->sql_freeresult($susresult);
    }

} else {
    evo_setcookie('CNB_test1', 'value1', 0);
}

// CNB Mod

?>