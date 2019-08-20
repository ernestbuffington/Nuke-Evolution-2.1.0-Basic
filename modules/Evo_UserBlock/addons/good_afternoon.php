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

if (defined('ADMIN_FILE')) {
    global $evouserinfo_good_afternoon, $userinfo;
}

global $lang_evo_userblock;

$now = time();
$evouserinfo_time = formatTimestamp($now, 'G');
$evouserinfo_good_afternoon = "<div align=\"center\">";
//Morning
if ($evouserinfo_time >= 0 && $evouserinfo_time <= 11) {
    $evouserinfo_good_afternoon .= $lang_evo_userblock['BLOCK']['AFTERNOON']['MORNING']."&nbsp;";
//Afternoon
} else if ($evouserinfo_time >= 12 && $evouserinfo_time <= 17) {
    $evouserinfo_good_afternoon .= $lang_evo_userblock['BLOCK']['AFTERNOON']['AFTERNOON']."&nbsp;";
//Evening
} else if ($evouserinfo_time >= 18 && $evouserinfo_time <= 23) {
    $evouserinfo_good_afternoon .= $lang_evo_userblock['BLOCK']['AFTERNOON']['EVENING']."&nbsp;";
}
//Username
$evouserinfo_good_afternoon .= "<br />".UsernameColor($userinfo['username'])."</div>";
$evouserinfo_good_afternoon .= "<br />\n";
?>