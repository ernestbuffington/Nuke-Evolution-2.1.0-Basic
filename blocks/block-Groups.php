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

global $db, $evoconfig, $lang_block, $userinfo;

if (!is_active('Groups')) {
    $content = $lang_block['BLOCK_NO_CONTENT'];
    return $content;
}

$member_groups    = '<img src="'. evo_image('group-1.png', 'blocks') .'" alt="'.$lang_block['Current_memberships'].'" border="0" height="14" width="17" /><span style=\'font-weight: bold;\'>&nbsp;'.$lang_block['Current_memberships']."</span><br />\n";
$pending_groups   = '<img src="'. evo_image('group-2.png', 'blocks') .'" alt="'.$lang_block['Memberships_pending'].'" border="0" height="14" width="17" /><span style=\'font-weight: bold;\'>&nbsp;'.$lang_block['Memberships_pending']."</span><br />\n";
$available_groups = '<img src="'. evo_image('group-3.png', 'blocks') .'" alt="'.$lang_block['Group_member_join'].'" border="0" height="14" width="17" /><span style=\'font-weight: bold;\'>&nbsp;'.$lang_block['Group_member_join']."</span><br />\n";

function block_groups_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('groups', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query('SELECT `group_type`, `group_name`, `group_id` FROM `'.GROUPS_TABLE.'` WHERE `group_single_user`="0" ORDER BY `group_id` ASC ');
        $a = 0;
        while (list($group_type, $group_name, $group_id) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['group_type']= $group_type;
            $blockcache[$a]['group_name']= $group_name;
            $blockcache[$a]['group_id']  = $group_id;
        }
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('groups', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_groups_cache($evoconfig['block_cachetime']);

$blockcontent = 0;
$is_member_of = '';
$is_pending_member = '';
$could_be_member = '';
$pending_list = array();

// we couldn't avoid this SQL-Statement
if (is_user()) {
    $result = $db->sql_query('SELECT `group_id` FROM `'.USER_GROUP_TABLE.'` WHERE `user_id`="'.$userinfo['user_id'].'" AND `user_pending`="1"');
    while(list($group_id) = $db->sql_fetchrow($result)) {
        $pending_list[$group_id] = $group_id;
    }
    $db->sql_freeresult($result);
}
$count_pending = (isset($pending_list['group_id']) ? count($pending_list) : 0);
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
        $group_name = $blocksession[$a]['group_name'];
        $group_type = intval($blocksession[$a]['group_type']);
        $group_id   = intval($blocksession[$a]['group_id']);

    if (isset($userinfo['groups'][$group_id])) {
        // The user is member of this group
        $is_member_of .= '<span style="float:left; width: 10%;"><img src="'. evo_image('arrow.png', 'blocks') .'" alt="'.$group_name.'" border="0" height="9" width="9" /></span><span style="float:right; width: 80%;"><a title="'.$group_name.'" href="modules.php?name=Groups&amp;g='.$group_id.'">'.$group_name."</a></span><br />\n";
        $blockcontent++;
    } else {
        if ( intval($group_type) == 2 && is_admin() ) {
            // Grouptype is hidden - but not for admin
            $could_be_member .= '<span style="float:left; width: 10%;"><img src="'. evo_image('arrow.png', 'blocks') .'" alt="'.$group_name.'" border="0" height="9" width="9" /></span><span style="float:right; width: 80%;"><a title="'.$group_name.'" href="modules.php?name=Groups&amp;g='.$group_id.'">'.$group_name."</a></span><br />\n";
            $blockcontent++;
        } elseif ( is_user() && ($count_pending > 0) ) {
            // Only users can be pending members - and only if user has pending group memberships we go inside this statement
            if ( $pending_list[$group_id] ) {
                $is_pending_member .= '<span style="float:left; width: 10%;"><img src="'. evo_image('arrow.png', 'blocks') .'" alt="'.$group_name.'" border="0" height="9" width="9" /></span><span style="float:right; width: 80%;"><a title="'.$group_name.'" href="modules.php?name=Groups&amp;g='.$group_id.'">'.$group_name."</a></span><br />\n";
                $blockcontent++;
            }
        } elseif ( is_user() ) {
            // Only a user can have the choice to become a groupmember of this group
            $could_be_member .= '<span style="float:left; width: 10%;"><img src="'. evo_image('arrow.png', 'blocks') .'" alt="'.$group_name.'" border="0" height="9" width="9" /></span><span style="float:right; width: 80%;"><a title="'.$group_name.'" href="modules.php?name=Groups&amp;g='.$group_id.'">'.$group_name."</a></span><br />\n";
            $blockcontent++;
        } elseif ($group_type == 0) {
            // Ok, we got all other things - this group is allowed to be seen by guest
            $could_be_member .= '<span style="float:left; width: 10%;"><img src="'. evo_image('arrow.png', 'blocks') .'" alt="'.$group_name.'" border="0" height="9" width="9" /></span><span style="float:right; width: 80%;">'.$group_name."</span><br />\n";
            $blockcontent++;
        }
    }
}

$content = "<div style='width: 100%;'>\n";
if ( $blockcontent == 0 ) {
    $content .= "<p style='text-align:center;'>".$lang_block['BLOCK_NO_CONTENT']."</p>\n";
} else {
    $content .= $member_groups;
    $content .= $is_member_of.'<br />';
    $content .= $pending_groups;
    $content .= $is_pending_member.'<br />';
    $content .= $available_groups;
    $content .= $could_be_member.'<br />';
}
$content .= "</div>\n";

?>