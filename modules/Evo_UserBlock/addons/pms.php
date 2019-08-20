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
    global $evouserinfo_pms, $lang_evo_userblock;
}

global $userinfo;

$evouserinfo_pms = '';
if (is_user()) {
    $pms = check_priv_mess($userinfo['user_id']);
    $evouserinfo_pms .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" alt=\"\" style=\"vertical-align:middle\" />\n";
    if (defined('ADMIN_FILE')) {
        $evouserinfo_pms .= $lang_evo_userblock['BLOCK']['PMS']['INBOX'].$lang_evo_userblock['BLOCK']['BREAK']."<span style=\"font-weight: bold;\">&nbsp;".$pms."</span><br />\n";
    } else {
        $evouserinfo_pms .= $lang_evo_userblock['BLOCK']['PMS']['INBOX'].$lang_evo_userblock['BLOCK']['BREAK']."<span style=\"font-weight: bold;\"><a title=\"".$lang_evo_userblock['BLOCK']['PMS']['OPEN_INBOX']."\" href=\"modules.php?name=Private_Messages\">&nbsp;".$pms."</a></span><br />\n";
    }
}

?>