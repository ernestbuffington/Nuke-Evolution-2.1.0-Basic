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
   die('You can\´t access this file directly');;
}

define('IN_PHPBB', TRUE);
global $_GETVAR;

$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR . $module_name. '/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

include($phpbb_root_path . 'common.php');

$forum_id   = $_GETVAR->get('f', '_REQUEST', 'int', 0);
$privmsg    = (!$forum_id) ? TRUE : FALSE;

// Start Session Management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

// Display the allowed Extension Groups and Upload Size
if ($privmsg) {
    $auth['auth_attachments'] = ($userdata['user_level'] != ADMIN) ? intval($attach_config['allow_pm_attach']) : TRUE;
    $auth['auth_view'] = TRUE;
    $_max_filesize = $attach_config['max_filesize_pm'];
} else {
    $auth = auth(AUTH_ALL, $forum_id, $userdata);
    $_max_filesize = $attach_config['max_filesize'];
}

if (!($auth['auth_attachments'] && $auth['auth_view'])) {
    message_die(GENERAL_ERROR, 'You are not allowed to call this file (ID:2)');
}

$template->set_filenames(array(
    'body' => 'posting_attach_rules.tpl')
);

$sql = 'SELECT group_id, group_name, max_filesize, forum_permissions
        FROM ' . EXTENSION_GROUPS_TABLE . '
        WHERE allow_group = 1
        ORDER BY group_name ASC';
if (!($result = $db->sql_query($sql))) {
    message_die(GENERAL_ERROR, 'Could not query Extension Groups.', '', __LINE__, __FILE__, $sql);
}

$allowed_filesize = array();
$rows             = $db->sql_fetchrowset($result);
$num_rows         = $db->sql_numrows($result);
$db->sql_freeresult($result);

// Ok, only process those Groups allowed within this forum
$nothing = TRUE;
for ($i = 0; $i < $num_rows; $i++) {
    $auth_cache = trim($rows[$i]['forum_permissions']);
    $permit = ($privmsg) ? TRUE : ((is_forum_authed($auth_cache, $forum_id)) || trim($rows[$i]['forum_permissions']) == '');

    if ($permit) {
        $nothing    = FALSE;
        $group_name = $rows[$i]['group_name'];
        $f_size     = intval(trim($rows[$i]['max_filesize']));
        $det_filesize = (!$f_size) ? $_max_filesize : $f_size;
        $size_lang  = ($det_filesize >= 1048576) ? $lang['MB'] : (($det_filesize >= 1024) ? $lang['KB'] : $lang['Bytes']);

        if ($det_filesize >= 1048576) {
            $det_filesize = round($det_filesize / 1048576 * 100) / 100;
        } else if ($det_filesize >= 1024) {
            $det_filesize = round($det_filesize / 1024 * 100) / 100;
        }
        $max_filesize = ($det_filesize == 0) ? $lang['Unlimited'] : $det_filesize . ' ' . $size_lang;
        $template->assign_block_vars('group_row', array(
            'GROUP_RULE_HEADER' => sprintf($lang['Group_rule_header'], $group_name, $max_filesize))
        );

        $sql = 'SELECT extension
                FROM ' . EXTENSIONS_TABLE . "
                WHERE group_id = " . (int) $rows[$i]['group_id'] . "
                ORDER BY extension ASC";
        if (!($result = $db->sql_query($sql))) {
            message_die(GENERAL_ERROR, 'Could not query Extensions.', '', __LINE__, __FILE__, $sql);
        }
        $e_rows     = $db->sql_fetchrowset($result);
        $e_num_rows = $db->sql_numrows($result);
        $db->sql_freeresult($result);

        for ($j = 0; $j < $e_num_rows; $j++) {
            $template->assign_block_vars('group_row.extension_row', array(
                'EXTENSION' => $e_rows[$j]['extension'])
            );
        }
    }
}

$gen_simple_header = TRUE;
$page_title = $lang['Attach_rules_title'];
include_once(NUKE_INCLUDE_DIR.'page_header.php');

$template->assign_vars(array(
    'L_RULES_TITLE'       => $lang['Attach_rules_title'],
    'L_CLOSE_WINDOW'      => $lang['Close_window'],
    'L_EMPTY_GROUP_PERMS' => $lang['Note_user_empty_group_permissions'])
);

if ($nothing) {
    $template->assign_block_vars('switch_nothing', array());
}
$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>