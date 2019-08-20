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

if (defined('PHPBB_BOARD_CONFIG')) {
    if( !empty($setmodules) ) {
        $filename = basename(__FILE__);
        $module['Statistics']['Edit_module'] = $filename . '&amp;mode=select_module';
        return;
    }
}

global $_GETVAR;
$lang_file = '/lang_admin_statistics.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

$mode   = $_GETVAR->get('mode', 'post', 'string') ? $_GETVAR->get('mode', 'post', 'string') : ( $_GETVAR->get('mode', 'get', 'string') ? $_GETVAR->get('mode', 'get', 'string') : '');
$submit = $_GETVAR->get('submit', 'post', 'string') ? TRUE : FALSE;
$cancel = $_GETVAR->get('cancel', 'post', 'string') ? TRUE : FALSE;
$editmodule = $_GETVAR->get('editmodule', '_REQUEST', 'int');

if ($cancel) {
    $no_page_header = TRUE;
}
include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/constants.php');
$sql = "SELECT * FROM " . STATS_CONFIG_TABLE;
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
}
$stats_config = array();
while ($row = $db->sql_fetchrow($result)) {
    $stats_config[$row['config_name']] = trim($row['config_value']);
}

include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/lang_functions.php');
include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/stat_functions.php');
include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/admin_functions.php');

$message = '';

if ($mode == 'mod_edit') {
    $module_id = (!empty($editmodule) ? $editmodule : message_die(GENERAL_ERROR, 'Unable to edit Module.' ) );
    $template->set_filenames(array(
        'body' => 'admin/stat_edit_module.tpl')
    );
    $sql = "SELECT m.*, i.* FROM (" . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i)
            WHERE i.module_id = m.module_id AND m.module_id = " . $module_id;
    if (!($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
    }
    if ($db->sql_numrows($result) == 0) {
        message_die(GENERAL_MESSAGE, 'Module not found.');
    }
    $mod_info = $db->sql_fetchrow($result);
    $mod_info_changed = FALSE;
}

if ($submit && $mode == 'mod_edit') {
    if ($_GETVAR->get('update_time', 'post', 'int')) {
        if (intval($mod_info['update_time']) != $_GETVAR->get('update_time', 'post', 'int')) {
            $sql = "UPDATE " . MODULES_TABLE . " SET update_time = " . $_GETVAR->get('update_time', 'post', 'int') . " WHERE module_id = " . $module_id;
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Unable to update modules table', '', __LINE__, __FILE__, $sql);
            }
            $mod_info_changed = TRUE;
            $message = ($message == '') ? $message . $lang['Msg_changed_update_time'] : $message . '<br />' . $lang['Msg_changed_update_time'];
        }
    }
    if ($_GETVAR->get('clear_module_cache', 'post', 'string')) {
        $sql = "UPDATE " . CACHE_TABLE . " SET module_cache_time = 0, db_cache = '', priority = 0 WHERE module_id = " . $module_id;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to update modules cache table', '', __LINE__, __FILE__, $sql);
        }
        $message = ($message == '') ? $message . $lang['Msg_cleared_module_cache'] : $message . '<br />' . $lang['Msg_cleared_module_cache'];
    }
    // Permission Updates
    $update_sql = '';
    $perm_array = array('perm_all', 'perm_reg', 'perm_mod', 'perm_admin');
    for ($i = 0; $i < count($perm_array); $i++) {
        if ($_GETVAR->get($perm_array[$i], 'post', 'string')) {
            $update_sql .= ($update_sql == '') ? $perm_array[$i] . ' = 1' : ', ' . $perm_array[$i] . ' = 1';
        } else {
            $update_sql .= ($update_sql == '') ? $perm_array[$i] . ' = 0' : ', ' . $perm_array[$i] . ' = 0';
        }
    }
    if ($update_sql != '') {
        $sql = "UPDATE " . MODULES_TABLE . " SET " . $update_sql . " WHERE module_id = " . $module_id;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to update Permissions', '', __LINE__, __FILE__, $sql);
        }
        $message = ($message == '') ? $message . $lang['Msg_permissions_updated'] : $message . '<br />' . $lang['Msg_permissions_updated'];
        $mod_info_changed = TRUE;
    }

    // Admin Panel Integration fields
    // Get Module Variables
    $sql = "SELECT * FROM " . MODULE_ADMIN_TABLE . " WHERE module_id = " . $module_id;
    if (!$result = $db->sql_query($sql)) {
        message_die(GENERAL_ERROR, 'Could not find Module Admin Table', '', __LINE__, __FILE__, $sql);
    }
    $rows = $db->sql_fetchrowset($result);
    $num_rows = $db->sql_numrows($result);
    $admin_update = FALSE;
    for ($i = 0; $i < $num_rows; $i++) {
        if ($_GETVAR->get(trim($rows[$i]['config_name'], 'post', 'string'))) {
            if ($_GETVAR->get(trim($rows[$i]['config_name'], 'post', 'string')) != trim($rows[$i]['config_value'])) {
                $sql = "UPDATE " . MODULE_ADMIN_TABLE . " SET config_value = '" . trim($_GETVAR->get(trim($rows[$i]['config_name'], 'post', 'string'))) . "'
                        WHERE config_name = '" . trim($rows[$i]['config_name']) . "' AND module_id = " . $module_id;
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Unable to update modules cache table', '', __LINE__, __FILE__, $sql);
                }
                $admin_update = TRUE;
            }
        }
    }
    if ($admin_update) {
        $message = ($message == '') ? $message . $lang['Msg_module_fields_updated'] : $message . '<br />' . $lang['Msg_module_fields_updated'];
    }
}

if ($_GETVAR->get('add_group', 'post', 'string') && $mode == 'mod_edit') {
    $group_id = $_GETVAR->get('group', 'post', 'int');
    if ( (!$group_id) || (empty($group_id)) ) {
        message_die(GENERAL_MESSAGE, 'Wrong Group ID submitted, hacking attempt ?');
    }
    $sql = "INSERT INTO " . MODULE_GROUP_AUTH_TABLE . " (module_id, group_id) VALUES (" . $module_id . ", " . $group_id . ")";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Couldn't insert Group", "", __LINE__, __FILE__, $sql);
    }
}

if ($_GETVAR->get('delete_group', 'post', 'string') && $mode == 'mod_edit') {
    $group_id = $_GETVAR->get('added_group', 'post', 'int');
    if ( (!$group_id) || (empty($group_id)) ) {
        message_die(GENERAL_MESSAGE, 'Wrong Group ID submitted, hacking attempt ?');
    }
    $sql = "DELETE FROM " . MODULE_GROUP_AUTH_TABLE . " WHERE module_id = " . $module_id . " AND group_id = " . $group_id;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Couldn't delete Group", "", __LINE__, __FILE__, $sql);
    }
}

if ($mode == 'mod_edit') {
    $template->set_filenames(array(
        'body' => 'admin/stat_edit_module.tpl')
    );
    if ($mod_info_changed) {
        $sql = "SELECT m.*, i.* FROM (" . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i)
                WHERE i.module_id = m.module_id AND m.module_id = " . $module_id;
        if (!($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
        }
        if ($db->sql_numrows($result) == 0) {
            message_die(GENERAL_MESSAGE, 'Module not found.');
        }
        $mod_info = $db->sql_fetchrow($result);
    }
    $s_hidden_fields = '<input type="hidden" name="editmodule" value="' . $module_id . '" />';
    $module_langs = get_module_languages(trim($mod_info['short_name']));
    $module_languages = '';
    for ($i = 0; $i < count($module_langs); $i++) {
        $module_languages .= ( ($module_languages == '') ? $module_langs[$i] : ', ' . $module_langs[$i]);
    }
    $yes_no_switches = array('perm_all', 'perm_reg', 'perm_mod', 'perm_admin');
    for ($i = 0; $i < count($yes_no_switches); $i++) {
        eval("\$" . $yes_no_switches[$i] . " = ( intval(\$mod_info['" . $yes_no_switches[$i] . "']) != 0 ) ? 'checked=\"checked\"' : '';");
    }
    $sql = "SELECT group_id, group_name FROM " . GROUPS_TABLE . "
            WHERE group_single_user = 0
            ORDER BY group_name";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Couldn't query Groups Table", "", __LINE__, __FILE__, $sql);
    }
    $num_groups = $db->sql_numrows($result);
    $group_name = $db->sql_fetchrowset($result);
    $group_ids = array();
    for ($i = 0; $i < $num_groups; $i++) {
        $group_ids[] = $group_name[$i]['group_id'];
    }
    $sql = "SELECT g.group_id, g.group_name
            FROM (" . GROUPS_TABLE . " g, " . MODULE_GROUP_AUTH_TABLE . " m)
            WHERE m.group_id = g.group_id AND m.module_id = " . intval($mod_info['module_id']) . "
            ORDER BY group_name";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Couldn't query Groups Table", "", __LINE__, __FILE__, $sql);
    }
    $rows = $db->sql_fetchrowset($result);
    $num_rows = $db->sql_numrows($result);
    // Rebuild Auth Table, maybe the user have deleted groups
    if (($num_groups > 0) && ($num_rows > 0)) {
        for ($i = 0; $i < $num_rows; $i++) {
            if (!in_array($rows[$i]['group_id'], $group_ids))  {
                $sql = "DELETE FROM " . MODULE_GROUP_AUTH_TABLE . "
                        WHERE module_id = " . $module_id . "
                        AND group_id = " . $rows[$i]['group_id'];
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Couldn't delete Group", "", __LINE__, __FILE__, $sql);
                }
            }
        }
    }
    $added_groups = array();
    for ($i = 0; $i < $num_rows; $i++) {
        $added_groups['group_id'][] = $rows[$i]['group_id'];
        $added_groups['group_name'][] = $rows[$i]['group_name'];
    }
    $act_group = 0;
    if ( $num_groups > 0 ) {
        $group_select = '<select name="group">';
        for($i = 0; $i < count($group_name); $i++) {
            $add = FALSE;
            if (!isset($added_groups['group_id']) || (count($added_groups['group_id']) == 0)) {
                $add = TRUE;
            } else if (!in_array($group_name[$i]['group_id'], $added_groups['group_id'])) {
                $add = TRUE;
            }
            if ($add) {
                $selected = ($act_group == 0) ? ' selected="selected"' : '';
                $group_select .= '<option value="' . $group_name[$i]['group_id'] . '"' . $selected . '>' . $group_name[$i]['group_name'] . '</option>';
                $act_group++;
            }
        }
        $group_select .= '</select>';
    }
    if ($act_group == 0) {
        $group_select = $lang['No_groups_to_add'];
    } else {
        $template->assign_block_vars('switch_groups_there', array());
    }
    if (!isset($added_groups['group_id']) || (count($added_groups['group_id']) == 0)) {
        $group_added_select = $lang['No_groups_selected'];
    } else {
        $template->assign_block_vars('switch_groups_selected', array());
        $group_added_select = '<select name="added_group">';
        for($i = 0; $i < count($added_groups['group_id']); $i++) {
            $selected = ($i == 0) ? ' selected="selected"' : '';
            $group_added_select .= '<option value="' . $added_groups['group_id'][$i] . '"' . $selected . '>' . $added_groups['group_name'][$i] . '</option>';
        }
        $group_added_select .= '</select>';
    }
    // Module Edit Panel
    $template->assign_vars(array(
        'L_EDIT_MODULE'         => $lang['Edit_module'],
        'L_EDIT_MODULE_EXPLAIN' => $lang['Edit_module_explain'],
        'L_MODULE_INFORMATIONS' => $lang['Module_informations'],
        'L_MODULE_NAME'         => $lang['Module_name'],
        'L_MODULE_DESCRIPTION'  => $lang['Module_description'],
        'L_MODULE_VERSION'      => $lang['Module_version'],
        'L_MODULE_AUTHOR'       => $lang['Module_author'],
        'L_AUTHOR_EMAIL'        => $lang['Author_email'],
        'L_MODULE_URL'          => $lang['Module_url'],
        'L_UPDATE_URL'          => $lang['Update_url'],
        'L_MODULE_LANGUAGES'    => $lang['Module_languages'],
        'L_MODULE_STATUS'       => $lang['Module_status'],
        'L_MESSAGES'            => $lang['Messages'],
        'L_PREVIEW_MODULE'      => $lang['Preview_module'],
        'L_CONFIGURATION'       => $lang['Module_configuration'],
        'L_UPDATE_TIME'         => $lang['Update_time'],
        'L_UPDATE_TIME_EXPLAIN' => $lang['Update_time_explain'],
        'L_UPDATE_MODULE'       => $lang['Update_module'],
        'L_CLEAR_MODULE_CACHE'  => $lang['Clear_module_cache'],
        'L_CLEAR_MODULE_CACHE_EXPLAIN' => $lang['Clear_module_cache_explain'],
        'L_SUBMIT'              => $lang['Submit'],
        'L_RESET'               => $lang['Reset'],
        'L_UPDATE'              => $lang['Update'],
        'L_PERMISSIONS'         => $lang['Permissions'],
        'L_PERMISSIONS_TITLE'   => $lang['Set_permissions_title'],
        'L_PERM_ALL'            => $lang['Perm_all'],
        'L_PERM_REG'            => $lang['Perm_reg'],
        'L_PERM_MOD'            => $lang['Perm_mod'],
        'L_PERM_ADMIN'          => $lang['Perm_admin'],
        'L_GROUPS'              => $lang['Perm_group'],
        'L_ADDED_GROUPS'        => $lang['Added_groups'],
        'L_GROUPS_TITLE'        => $lang['Perm_groups_title'],
        'L_ADD'                 => $lang['Perm_add_group'],
        'L_REMOVE'              => $lang['Perm_remove_group'],
        'PERM_ALL'              => $perm_all,
        'PERM_REG'              => $perm_reg,
        'PERM_MOD'              => $perm_mod,
        'PERM_ADMIN'            => $perm_admin,
        'S_GROUP_SELECT'        => $group_select,
        'S_SELECTED_GROUPS'     => $group_added_select,
        'MODULE_NAME'           => nl2br($mod_info['long_name']),
        'MODULE_DESCRIPTION'    => nl2br($mod_info['extra_info']),
        'MODULE_AUTHOR'         => trim($mod_info['author']),
        'MODULE_VERSION'        => trim($mod_info['version']),
        'AUTHOR_EMAIL'          => trim($mod_info['email']),
        'MODULE_URL'            => trim($mod_info['url']),
        'MODULE_STATUS'         => (intval($mod_info['active']) == 1) ? $lang['Active'] : $lang['Not_active'],
        'U_MODULE_URL'          => trim($mod_info['url']),
        'UPDATE_URL'            => trim($mod_info['update_site']),
        'U_UPDATE_URL'          => trim($mod_info['update_site']),
        'MODULE_LANGUAGES'      => $module_languages,
        'MESSAGE'               => $message,
        'S_HIDDEN_FIELDS'       => $s_hidden_fields,
        'UPDATE_TIME'           => intval($mod_info['update_time']),
        'S_ACTION'              => admin_sid('admin_edit_module.php&amp;mode='.$mode),
        'U_PREVIEW_MODULE'      => append_sid('modules.php?name=Forums&amp;file=statistics&amp;preview='.$module_id)
    ));
    // Admin Panel Integration fields
    // Get Module Variables
    $sql = "SELECT *
            FROM " . MODULE_ADMIN_TABLE . "
            WHERE module_id = " . $module_id;
    if (!$result = $db->sql_query($sql)) {
        message_die(GENERAL_ERROR, 'Could not find Module Admin Table', '', __LINE__, __FILE__, $sql);
    }
    $rows = $db->sql_fetchrowset($result);
    $num_rows = $db->sql_numrows($result);
    if ($num_rows > 0) {
        $lang_file = '/lang_modules.php';
        if (@file_exists(NUKE_FORUMS_DIR . 'modules/language/lang_' . $currentlang . $lang_file))  {
            include_once(NUKE_FORUMS_DIR . 'modules/language/lang_' . $currentlang . $lang_file);
        } elseif (@file_exists(NUKE_FORUMS_DIR . 'modules/language/lang_' . $board_config['default_lang'] . $lang_file)) {
            include_once(NUKE_FORUMS_DIR . 'modules/language/lang_' . $board_config['default_lang'] . $lang_file);
        } else {
            die('Neither your selected nor the board-default language-file could be found');
        }
        // Set Language
        $keys = array();
        eval('$current_lang = $' . $mod_info['short_name'] . ';');
        if (is_array($current_lang)) {
            foreach ($current_lang as $key => $value) {
                $lang[$key] = $value;
                $keys[] = $key;
            }
        }
    }
    for ($i = 0; $i < $num_rows; $i++)  {
        $lang_title = $lang[trim($rows[$i]['config_title'])];
        $lang_explain = (isset($lang[trim($rows[$i]['config_explain'])])) ? $lang[trim($rows[$i]['config_explain'])] : '';
        switch (trim($rows[$i]['config_trigger'])) {
            case 'enum':
                $option_field = '<input type="radio" name="' . trim($rows[$i]['config_name']) . '" value="1" ';
                if (intval($rows[$i]['config_value']) == 1) {
                    $option_field .= 'checked=\"checked\" ';
                }
                $option_field .= ' /> ' . $lang['Yes'] . '&nbsp;&nbsp;<input type="radio" name="' . trim($rows[$i]['config_name']) . '" value="0" ';
                if (intval($rows[$i]['config_value']) == 0) {
                    $option_field .= 'checked=\"checked\" ';
                }
                $option_field .= ' /> ' . $lang['No'];
                break;
            case 'integer':
                $option_field = '<input type="text" name="' . trim($rows[$i]['config_name']) . '" value="' . intval($rows[$i]['config_value']) . '" />';
                break;
        }
        $template->assign_block_vars('module_admin_fields', array(
            'L_TITLE' => $lang_title,
            'L_EXPLAIN' => $lang_explain,
            'S_OPTION_FIELD' => $option_field)
        );
    }
    if ( !($_GETVAR->get('fileupload', 'post', 'string')) && !($_GETVAR->get('fileselect', 'post', 'string')) ) {
        $module_paks = array();
        $dir = @opendir(NUKE_FORUMS_DIR . 'modules/pakfiles');
        while($file = @readdir($dir)) {
            if( !@is_dir(NUKE_FORUMS_DIR . 'modules/pakfiles' . '/' . $file) ) {
                if ( preg_match('#.pak#', $file) ) {
                    $module_paks[] = $file;
                }
            }
        }
        @closedir($dir);
        if (count($module_paks) > 0) {
            $module_select_field = '<select name="selected_pak_file">';
            for ($i = 0; $i < count($module_paks); $i++) {
                $selected = ($i == 0) ? ' selected="selected"' : '';
                $module_select_field .= '<option value="' . $module_paks[$i] . '"' . $selected . '>' . $module_paks[$i] . '</option>';
            }
            $module_select_field .= '</select>';
            $s_hidden_fields = '<input type="hidden" name="fileselect" value="1" />';
        } else {
            $module_select_field = $lang['No_module_packages_found'];
            $s_hidden_fields = '';
        }
        $template->assign_vars(array(
            'L_SELECT_MODULE'       => $lang['Select_module_pak'],
            'S_SELECT_MODULE'       => $module_select_field,
            'S_SELECT_HIDDEN_FIELDS'=> $s_hidden_fields)
        );
        $s_hidden_fields = '<input type="hidden" name="fileupload" value="1" /><input type="hidden" name="update_id" value="' . $module_id . '" />';
        $template->assign_vars(array(
            'L_INSTALL_MODULE'          => $lang['Install_module'],
            'L_INSTALL_MODULE_EXPLAIN'  => $lang['Install_module_explain'],
            'L_UPLOAD_MODULE'           => $lang['Upload_module_pak'],
            'L_SUBMIT'                  => $lang['Submit'],
            'S_ACTION_UPDATE'           => admin_sid('admin_statistics.php&amp;mode=mod_install'),
            'S_UPLOAD_HIDDEN_FIELDS'    => $s_hidden_fields)
        );
    }
} else if ($mode == 'select_module') {
    $template->set_filenames(array(
        'body' => 'admin/stat_select_module.tpl')
    );
    $sql = "SELECT m.module_id, i.long_name
            FROM (" . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i)
            WHERE i.module_id = m.module_id
            ORDER BY long_name ASC";
    if (!($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
    }
    if ($db->sql_numrows($result) == 0) {
        message_die(GENERAL_MESSAGE, 'No installed Modules found.');
    }
    $rows = $db->sql_fetchrowset($result);
    $module_select_field = '<select name="editmodule">';
    for ($i = 0; $i < count($rows); $i++) {
        $selected = ($i == 0) ? ' selected="selected"' : '';
        $module_select_field .= '<option value="' . $rows[$i]['module_id'] . '"' . $selected . '>' . $rows[$i]['long_name'] . '</option>';
    }
    $module_select_field .= '</select>';
    $template->assign_vars(array(
        'L_SELECT_MODULE_TITLE'     => $lang['Module_select_title'],
        'L_SELECT_MODULE_EXPLAIN'   => $lang['Module_select_explain'],
        'L_MODULE_SELECT'           => $lang['Module_select_title'],
        'L_EDIT'                    => $lang['Edit'],
        'S_ACTION'                  => admin_sid('admin_edit_module.php&amp;mode=mod_edit'),
        'S_MODULE_SELECT'           => $module_select_field)
    );
}
$template->pparse('body');

//
// Page Footer
//
include(NUKE_FORUMS_ADMIN_DIR.'page_footer_admin.php');

?>