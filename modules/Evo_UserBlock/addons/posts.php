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
    global $db, $cache, $evoconfig, $evouserinfo_posts, $lang_evo_userblock;
}

global $userinfo;
function block_Evo_UserInfo_posts_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('evo_userinfo_posts', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $posts       = $db->sql_ufetchrow('SELECT COUNT(`post_id`) AS posts FROM `'.POSTS_TABLE.'`');
        $topics      = $db->sql_ufetchrow('SELECT COUNT(`topic_id`) AS topics FROM `'.TOPICS_TABLE.'`');
        $blockcache[1]['posts']     = $posts['posts'];
        $blockcache[1]['topics']    = $topics['topics'];
        $blockcache[0]['stat_created'] = time();
        $cache->save('evo_userinfo_posts', 'blocks', $blockcache);
    }
    return $blockcache;
}

$posts_blocksession = block_Evo_UserInfo_posts_cache($evoconfig['block_cachetime']);

if (is_user()) {
    $own_posts = $db->sql_ufetchrow('SELECT COUNT(`topic_id`) AS posts FROM `'.TOPICS_TABLE.'` WHERE `topic_poster`='.$userinfo['user_id']);
    $posts_blocksession[1]['own_posts'] = $own_posts['posts'];
}
$evouserinfo_posts = "<div style='width:100%; text-align: left;'>\n";
$evouserinfo_posts .= "<img src=\"".evo_image('posts.png', 'evo_userinfo')."\" alt=\"".$lang_evo_userblock['BLOCK']['POSTS']['FORUMS']."\" border=\"0\" />\n";
$evouserinfo_posts .= "<span style=\"text-decoration:underline; font-weight: bold;\">".$lang_evo_userblock['BLOCK']['POSTS']['FORUMS'].$lang_evo_userblock['BLOCK']['BREAK']."</span>".evouserinfo_expand_collapse_start('posts')."<br />\n";
$evouserinfo_posts .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['POSTS']['POSTS'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".number_format($posts_blocksession[1]['posts'])."<br />\n";
$evouserinfo_posts .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['POSTS']['TOPICS'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".number_format($posts_blocksession[1]['topics'])."<br />\n";
if (is_user()) {
    $evouserinfo_posts .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['POSTS']['UR_TOPICS'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".number_format($posts_blocksession[1]['own_posts'])."<br />\n";
    $evouserinfo_posts .= "<img src=\"".evo_image('li.png', 'evo_userinfo')."\" style=\"vertical-align:middle\" alt=\"\" />&nbsp;".$lang_evo_userblock['BLOCK']['POSTS']['UR_POSTS'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".number_format($userinfo['user_posts'])."<br />\n";
}
$evouserinfo_posts .= evouserinfo_expand_collapse_end();
$evouserinfo_posts .= "</div>\n";
?>