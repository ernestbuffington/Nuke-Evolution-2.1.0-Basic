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

global $db, $evoconfig, $userinfo;

function block_whoisonline_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('whoisonline', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        if (!function_exists('phpBB_whoisonline')) {
            include(NUKE_INCLUDE_DIR . 'sessions.php');
        }
        $blockcache = phpBB_whoisonline();
    }
    return $blockcache;
}

$blocksession  = block_whoisonline_cache($evoconfig['block_cachetime']);

$count_guests  = $blocksession[0]['count_guests'];
$lang_guests   = ($count_guests == 1) ? $lang_block['BLOCK_USERINFO_GUEST'] : $lang_block['BLOCK_USERINFO_GUESTS'];
$count_reg_user = $blocksession[0]['count_reg_user'];
$lang_members  = ($count_reg_user == 1) ? $lang_block['BLOCK_USERINFO_MEMBER_TITLE'] : $lang_block['BLOCK_USERINFO_MEMBERS_TITLE'];

$blockcontent = "<div style='text-align: center;'>".$lang_block['BLOCK_USERINFO_ONLINE']."</div><div style='text-align: center;font-size: x-small;'>".$count_guests."&nbsp;".$lang_guests."<br />".$count_reg_user."&nbsp;".$lang_members."</div>\n";
if (is_user()) {
    $blockcontent .= "<br /><div style='text-align: center;font-size: x-small;'>".$lang_block['BLOCK_USERINFO_YOU_BE_USER']."</div><div style='font-weight: bold;'>".$userinfo['username']."</div><br />";
    if (is_active('Private_Messages')) {
        $newpm = check_priv_mess($userinfo['user_id']);
        $blockcontent .= "<div style='text-align: center;font-size: x-small;'>".$lang_block['BLOCK_USERINFO_YOU_HAVE']."</div><div style='font-weight: bold;'><a href='modules.php?name=Private_Messages'>".$newpm."</a></div><div style='text-align: center;font-size: x-small;'>".$lang_block['BLOCK_USERINFO_PN_UNREAD']."</div>\n";
    }
}

$content = "<div style='text-align: center; width: 100%;'>\n";
if (empty($blockcontent)) {
    $content .= "<div style='text-align:center;font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    $content .= $blockcontent;
}
$content .= "</div>\n";

?>