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

if (!defined('ADMIN_FILE') && !defined('FORUM_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$forum_id = 0; // You could change this value unless forum ID 3 did not exist in your board
if (defined('PHPBB_BOARD_CONFIG')) {
    if( !empty($setmodules) ) {
        $filename = basename(__FILE__);
        $module['Forums']['Overall_Permissions']   = $filename . '?' . POST_FORUM_URL . '=' . $forum_id;
        return;
    }
}
//
// Load default header
//

global $_GETVAR, $currentlang;
$lang_file = '/lang_admin_attach.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

$auth_key = '';
$forum_auth_levels = array('ALL', 'REG', 'PRIVATE', 'MOD', 'ADMIN');
$forum_auth_const = array(0 => AUTH_ALL, 1 => AUTH_REG, 2 => AUTH_ACL, 3 => AUTH_MOD, 4 => AUTH_ADMIN);
attach_setup_forum_auth($simple_auth_ary, $forum_auth_fields, $field_names);
global $forum_auth_classes;
$forum_auth_images = array(
    AUTH_ALL    => 'ALL',
    AUTH_REG    => 'REG',
    AUTH_ACL    => 'PRIVATE',
    AUTH_MOD    => 'MOD',
    AUTH_ADMIN  => 'ADMIN',
);
$forum_auth_cats = array(
    'VIEW'            => 'auth_view',
    'READ'            => 'auth_read',
    'POST'            => 'auth_post',
    'REPLY'           => 'auth_reply',
    'EDIT'            => 'auth_edit',
    'DELETE'          => 'auth_delete',
    'STICKY'          => 'auth_sticky',
    'ANNOUNCE'        => 'auth_announce',
    'VOTE'            => 'auth_vote',
    'POLLCREATE'      => 'auth_pollcreate',
    'GLOBALANNOUNCE'  => 'auth_globalannounce',
    'ATTACHMENTS'     => 'auth_attachments',
    'DOWNLOAD'        => 'auth_download'
);
if( $_GETVAR->get('adv', 'get', 'int') ) {
    $adv = $_GETVAR->get('adv', 'get', 'int');
} else {
    unset($adv);
}
$template->set_filenames(array(
    'body' => 'admin/auth_overall_forum_body.tpl')
);

for($i=0, $max=count($forum_auth_const); $i < $max; $i++) {
    $auth_key .= '<img src="'.evo_image('spacer.gif', 'evo').'" width=10 height=10 class="' . $forum_auth_classes[$forum_auth_const[$i]] . '">&nbsp;' . $forum_auth_levels[$i] . '&nbsp;&nbsp;';
    $template->assign_block_vars('authedit',  array(
        'CLASS' => $forum_auth_classes[$forum_auth_const[$i]],
        'NAME'  => $forum_auth_levels[$i],
        'VALUE' => $forum_auth_const[$i],)
    );
}

$template->assign_vars(array(
    'INCLUDE_PATH'              => NUKE_INCLUDE_HREF_DIR,
    'IMG_PATH'                  => NUKE_IMAGES_BASE_DIR . 'auth_overall_forum/',
    'L_FORUM_TITLE'             => $lang['Auth_Control_Forum'],
    'L_FORUM_EXPLAIN'           => $lang['Forum_auth_explain_overall'],
    'L_FORUM_EXPLAIN_EDIT'      => $lang['Forum_auth_explain_overall_edit'],
    'L_FORUM_OVERALL_RESTORE'   => $lang['Forum_auth_overall_restore'],
    'L_FORUM_OVERALL_STOP'      => $lang['Forum_auth_overall_stop'],
    'L_SUBMIT'                  => $lang['Submit'],
    'AUTH_KEY'                  => $auth_key,
    'L_VIEW'                    => $lang['View'],
    'L_READ'                    => $lang['Read'],
    'L_POST'                    => $lang['Post'],
    'L_REPLY'                   => $lang['Reply'],
    'L_EDIT'                    => $lang['Edit'],
    'L_DELETE'                  => $lang['Delete'],
    'L_STICKY'                  => $lang['Sticky'],
    'L_ANNOUNCE'                => $lang['Announce'],
    'L_VOTE'                    => $lang['Vote'],
    'L_POLLCREATE'              => $lang['Pollcreate'],
    'L_GLOBALANNOUNCE'          => $lang['Globalannounce'],
    'L_ATTACH'                  => $lang['Auth_attach'],
    'L_DOWNLOAD'                => $lang['Auth_download']
));
//
// Start program proper
//
if( $_GETVAR->get('submit', 'post', 'string') ) {
    $temp_auth = $_GETVAR->get('auth', 'post', 'array');
    foreach($temp_auth as $forum_id => $forum) {
        $forum_id = intval($forum_id);
        $sql = '';
        foreach($forum as $a => $newval) {
            if ($newval && in_array($newval, $forum_auth_levels) && array_key_exists($a, $forum_auth_cats)) { // Changed and is valid
                $sql .= ( ( $sql != '' ) ? ', ' : '' ) . $forum_auth_cats[$a] . '=' . array_search($newval, $forum_auth_images);
            }
        }
        if ($sql != '') {
            $sql = "UPDATE " . FORUMS_TABLE . " SET $sql WHERE forum_id = $forum_id;";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update auth table', '', __LINE__, __FILE__, $sql);
            }
        }
    }
}
$row = array();
$all_categories = array();
$counter = 0;
$sql = "SELECT cat_id, cat_title, cat_order, cat_main
       FROM " . CATEGORIES_TABLE . "
       ORDER BY cat_order, cat_id";
if( !$q_categories = $db->sql_query($sql) ) {
    message_die(GENERAL_ERROR, "Could not query categories list", "", __LINE__, __FILE__, $sql);
}
while(list($cat_id, $cat_title, $cat_order, $cat_main) = $db->sql_fetchrow($q_categories)) {
    $row[$counter]['cat_id'] = $cat_id;
    $row[$counter]['cat_title'] = $cat_title;
    $row[$counter]['cat_order'] = $cat_order;
    $row[$counter]['cat_main'] = $cat_main;
    $row[$counter]['type'] = POST_CAT_URL;
    $root_cat[$cat_main] = TRUE;
    $display_order[$cat_order] = TRUE;
    $display_cat[$cat_order] = $cat_id;
    $display_main[$cat_order] = $cat_main;
    $display_id[$cat_order] = $counter;
    $counter++;
}
$db->sql_freeresult($q_categories);
$sql = "SELECT forum_id, forum_name, forum_order, cat_id, main_type, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_sticky,
        auth_announce, auth_globalannounce, auth_vote, auth_pollcreate, auth_attachments, auth_download
        FROM " . FORUMS_TABLE ."
        ORDER by forum_order, cat_id";
if( !$f_categories = $db->sql_query($sql) ) {
    message_die(GENERAL_ERROR, "Could not query forumscategory list", "", __LINE__, __FILE__, $sql);
}
while ( list($forum_id, $forum_name, $forum_order, $cat_id, $main_type, $auth_view, $auth_read, $auth_post, $auth_reply, $auth_edit, $auth_delete, $auth_sticky,
    $auth_announce, $auth_globalannounce, $auth_vote, $auth_pollcreate, $auth_attachments, $auth_download) = $db->sql_fetchrow($f_categories)) {
    $row[$counter]['cat_id']    = $forum_id;
    $row[$counter]['cat_title'] = $forum_name;
    $row[$counter]['cat_order'] = $forum_order;
    $row[$counter]['cat_main']  = $cat_id;
    $row[$counter]['type']      = POST_FORUM_URL;
    $row[$counter]['view']      = $auth_view;
    $row[$counter]['read']      = $auth_read;
    $row[$counter]['post']      = $auth_post;
    $row[$counter]['reply']     = $auth_reply;
    $row[$counter]['edit']      = $auth_edit;
    $row[$counter]['delete']    = $auth_delete;
    $row[$counter]['sticky']    = $auth_sticky;
    $row[$counter]['announce']  = $auth_announce;
    $row[$counter]['globalannounce'] = $auth_globalannounce;
    $row[$counter]['vote'] = $auth_vote;
    $row[$counter]['pollcreate'] = $auth_pollcreate;
    $row[$counter]['attachments'] = $auth_attachments;
    $row[$counter]['download']  = $auth_download;
    $root_cat[$cat_id]          = TRUE;
    $display_order[$forum_order]= TRUE;
    $display_cat[$forum_order]  = $forum_id;
    $display_main[$forum_order] = $cat_id;
    $display_id[$forum_order]   = $counter;
    $counter++;
}
ksort($root_cat);
ksort($display_order);
$actual_id = 999999999999;
foreach($display_order as $cat_order => $cat_ordervalue) {
    $i = $display_id[$cat_order];
    if ($row[$i]['cat_main'] == 0) {
        $cat_level = 0;
    } elseif($row[$i]['cat_main'] == $actual_id) {
        $cat_level++;
        $actual_id = $row[$i]['cat_main'];
    } else {
        $cat_level = 1;
        $actual_id = $row[$i]['cat_id'];
    }
    $level_deep = '';
    if($cat_level > 0) {
        for($k = 0; $k <= $cat_level; $k++) {
            $level_deep .= '<img width="10px" src="'. evo_image('spacer.gif', 'evo').'">';
        }
    }
    if($row[$i]['type'] == POST_FORUM_URL) {
        $row[$i]['cat_title'] = $level_deep . $row[$i]['cat_title'];
        $template->assign_block_vars('forumrow',  array(
            'FORUM_NAME'            => $row[$i]['cat_title'],
            'FORUM_ID'              => $row[$i]['cat_id'],
            'CLASSCOLOR'            => 'row1',
            'AUTH_VIEW_IMG'         => $forum_auth_images[$row[$i]['view']],
            'AUTH_READ_IMG'         => $forum_auth_images[$row[$i]['read']],
            'AUTH_POST_IMG'         => $forum_auth_images[$row[$i]['post']],
            'AUTH_REPLY_IMG'        => $forum_auth_images[$row[$i]['reply']],
            'AUTH_EDIT_IMG'         => $forum_auth_images[$row[$i]['edit']],
            'AUTH_DELETE_IMG'       => $forum_auth_images[$row[$i]['delete']],
            'AUTH_STICKY_IMG'       => $forum_auth_images[$row[$i]['sticky']],
            'AUTH_ANNOUNCE_IMG'     => $forum_auth_images[$row[$i]['announce']],
            'AUTH_VOTE_IMG'         => $forum_auth_images[$row[$i]['vote']],
            'AUTH_POLLCREATE_IMG'   => $forum_auth_images[$row[$i]['pollcreate']],
            'AUTH_GLOBALANNOUNCE_IMG' => $forum_auth_images[$row[$i]['globalannounce']],
            'AUTH_ATTACHMENTS_IMG'  => $forum_auth_images[$row[$i]['attachments']],
            'AUTH_DOWNLOAD_IMG'     => $forum_auth_images[$row[$i]['download']],
        ));
    } elseif($row[$i]['type'] == POST_CAT_URL) {
        $row[$i]['cat_title'] = $level_deep . $row[$i]['cat_title'];
        $template->assign_block_vars('forumrow',  array(
            'FORUM_NAME'            => $row[$i]['cat_title'],
            'FORUM_ID'              => $row[$i]['cat_id'].'c',
            'CLASSCOLOR'            => 'row2',
            'AUTH_VIEW_IMG'         => 'spacer',
            'AUTH_READ_IMG'         => 'spacer',
            'AUTH_POST_IMG'         => 'spacer',
            'AUTH_REPLY_IMG'        => 'spacer',
            'AUTH_EDIT_IMG'         => 'spacer',
            'AUTH_DELETE_IMG'       => 'spacer',
            'AUTH_STICKY_IMG'       => 'spacer',
            'AUTH_ANNOUNCE_IMG'     => 'spacer',
            'AUTH_VOTE_IMG'         => 'spacer',
            'AUTH_POLLCREATE_IMG'   => 'spacer',
            'AUTH_GLOBALANNOUNCE_IMG' => 'spacer',
            'AUTH_ATTACHMENTS_IMG'  => 'spacer',
            'AUTH_DOWNLOAD_IMG'     => 'spacer'
        ));
    }
    $db->sql_freeresult($f_categories);
}
$template->pparse('body');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>