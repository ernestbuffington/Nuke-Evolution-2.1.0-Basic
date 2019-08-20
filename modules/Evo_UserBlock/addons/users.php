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
    global $db, $cache, $evoconfig, $evouserinfo_users, $lang_evo_userblock;
}

function block_Evo_UserInfo_users_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('evo_userinfo_users', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $newest      = $db->sql_ufetchrow('SELECT `username` FROM `'._USERS_TABLE.'` WHERE `user_active` = 1 AND `user_level` > 0 AND `user_id` <> "'.ANONYMOUS.'" ORDER BY `user_id` DESC LIMIT 0,1');
        $today       = $db->sql_ufetchrow('SELECT COUNT(`user_id`) AS today FROM `'._USERS_TABLE.'` WHERE `user_regdate`="'.date("M d, Y").'"');
        $yesterday   = $db->sql_ufetchrow('SELECT COUNT(`user_id`) AS yesterday FROM `'._USERS_TABLE.'` WHERE `user_regdate`="'.date("M d, Y", time()-86400).'"');
        $waiting     = $db->sql_ufetchrow('SELECT COUNT(`user_id`) AS waiting FROM `'._USERS_TEMP_TABLE.'`');
        $total       = $db->sql_ufetchrow('SELECT COUNT(`user_id`) AS total FROM `'._USERS_TABLE.'` WHERE `user_id` <> "'. ANONYMOUS .'" AND `user_active` > 0');
        $blockcache[1]['newest']    = UsernameColor($newest['username']);
        $blockcache[1]['today']     = $today['today'];
        $blockcache[1]['yesterday'] = $yesterday['yesterday'];
        $blockcache[1]['waiting']   = $waiting['waiting'];
        $blockcache[1]['total']     = $total['total'];
        $blockcache[0]['stat_created'] = time();
        $cache->save('evo_userinfo_users', 'blocks', $blockcache);
    }
    return $blockcache;
}

$users_blocksession = block_Evo_UserInfo_users_cache($evoconfig['block_cachetime']);
$evouserinfo_users = '';

if (is_user()) {
    $evouserinfo_users .= "<div style='width:100%; text-align: left;'>\n";
    $evouserinfo_users .= "<a href=\"modules.php?name=Members_List\" title=\"".$lang_evo_userblock['BLOCK']['USERS']['MEMBERSHIPS']."\"><img src=\"".evo_image('members.png', 'evo_userinfo')."\" alt=\"".$lang_evo_userblock['BLOCK']['USERS']['MEMBERSHIPS']."\" border=\"0\" /></a>\n";
    $evouserinfo_users .= "<span style=\"text-decoration:underline; font-weight: bold;\">".$lang_evo_userblock['BLOCK']['USERS']['MEMBERSHIPS'].$lang_evo_userblock['BLOCK']['BREAK']."</span>".evouserinfo_expand_collapse_start('users')."<br />\n";
    $evouserinfo_users .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['USERS']['NEW_TODAY'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".number_format($users_blocksession[1]['today'])."<br />\n";
    $evouserinfo_users .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['USERS']['NEW_YESTERDAY'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".number_format($users_blocksession[1]['yesterday'])."<br />\n";
    $evouserinfo_users .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['USERS']['WAITING'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".number_format($users_blocksession[1]['waiting'])."<br />\n";
    $evouserinfo_users .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['USERS']['TOTAL'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".number_format($users_blocksession[1]['total'])."<br />\n";
    $evouserinfo_users .= "<div style='width:130px; overflow:hidden;'><img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['USERS']['LATEST'].$lang_evo_userblock['BLOCK']['BREAK']."\n";
    $evouserinfo_users .= "<strong>".$users_blocksession[1]['newest']."</strong></div></div><br />\n";
    $evouserinfo_users .= evouserinfo_expand_collapse_end();
}

?>