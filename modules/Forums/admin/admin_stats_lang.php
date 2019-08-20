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
        $module['Statistics']['Stats_langcp'] = $filename . '&amp;mode=select';
        return;
    }
}

global $_GETVAR;

$mode            = $_GETVAR->get('mode', 'request', 'string', NULL);
$m_mode          = $_GETVAR->get('m_mode', 'request', 'string', NULL);
$submit          = $_GETVAR->get('submit', 'post', 'string') ? TRUE : FALSE;
$lang_decollapse = trim($_GETVAR->get('d_lang', 'get', 'string', ''));
$lang_file = '/lang_admin_statistics.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}
$lang_file = '/lang_statistics.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
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

$update_list        = $_GETVAR->get('update', 'post', 'array', NULL) ? $_GETVAR->get('update', 'post', 'array') : array();
$delete_list        = $_GETVAR->get('delete', 'post', 'array', NULL) ? $_GETVAR->get('delete', 'post', 'array') : array();
$lang_entry         = $_GETVAR->get('lang_entry', 'post', 'array', NULL) ? $_GETVAR->get('lang_entry', 'post', 'array') : array();
$update_all_lang    = $_GETVAR->get('update_all_lang', 'post', 'int', 1) ? TRUE : FALSE;
$add_new_key        = $_GETVAR->get('add_new_key', 'post', 'array', NULL) ? $_GETVAR->get('add_new_key', 'post', 'array') : array();
$add_key            = trim(htmlspecialchars($_GETVAR->get('add_key', 'post', 'string', '')));
$add_value          = trim($_GETVAR->get('add_value', 'post', 'string', ''));
$new_lang_submit    = $_GETVAR->get('new_lang_submit', 'post', 'int', 1) ? TRUE : FALSE;
$new_language       = $_GETVAR->get('new_language', 'post', 'string', NULL);
$delete_complete_lang =  $_GETVAR->get('delete_complete_lang', 'post', 'array', NULL) ? $_GETVAR->get('delete_complete_lang', 'post', 'array') : array();

if (($new_lang_submit) && ($new_language != '')) {
    if (!strstr($new_language, 'lang_')) {
        message_die(GENERAL_MESSAGE, 'Please specify a valid Language to be created');
    }
    $installed_languages = get_all_installed_languages();
    if (count($installed_languages) > 0) {
        if (in_array($new_language, $installed_languages)) {
            message_die(GENERAL_MESSAGE, 'The Language ' . $new_language . ' already exist.');
        }
        if (in_array('lang_english', $installed_languages)) {
            $preset = 'lang_english';
        } else {
            $preset = $installed_languages[0];
        }
    } else {
        $preset = '';
    }
    if ($preset != '') {
        add_new_language($new_language, $preset);
    } else {
        add_empty_language($new_language);
    }
    $mode = 'select';
    $m_mode = 'edit';
    redirect(admin_sid('admin_stats_lang.php&amp;mode=select&amp;lang='.$new_language));
} else if (count($delete_complete_lang) > 0) {
    @reset($delete_complete_lang);
    list($language, $value) = each($delete_complete_lang);
    $language = trim($language);
    delete_complete_language($language);
    $m_mode = '';
}

if (count($update_list) > 0) {
    @reset($update_list);
    list($language, $v_array) = each($update_list);
    list($module_id, $v2_array) = each($v_array);
    list($key, $value) = each($v2_array);
    set_lang_entry($language, $module_id, $key, $lang_entry[$language][$module_id][$key]);
} else if ($update_all_lang) {
    @reset($lang_entry);
    // Begin Language
    while (list($language, $v_array) = each($lang_entry)) {
        // Begin Modules
        while (list($module_id, $v2_array) = each($v_array)) {
            $lang_block = '';
            // Begin Language Entries
            while (list($key, $value) = each($v2_array)) {
                $lang_block .= '$lang[\'' . trim($key) . '\'] = \'' . trim($value) . '\';';
                $lang_block .= "\n";
            }
            set_lang_block($language, $module_id, $lang_block);
        }
    }
} else if (($add_key != '') && (count($add_new_key) > 0)) {
    @reset($add_new_key);
    list($language, $v_array) = each($add_new_key);
    list($module_id, $value) = each($v_array);
    lang_add_new_key($language, $module_id, $add_key, $add_value);
} else if (count($delete_list) > 0) {
    @reset($delete_list);
    list($language, $v_array) = each($delete_list);
    list($module_id, $v2_array) = each($v_array);
    list($key, $value) = each($v2_array);
    delete_lang_key($language, $module_id, $key);
}

if ($mode == 'select') {
    $template->set_filenames(array(
        'body' => 'admin/stat_admin_lang.tpl',
        'lang_body' => 'admin/stat_edit_lang.tpl')
    );
    $template->assign_vars(array(
        'L_EDIT'                => $lang['Edit'],
        'L_UPDATE'              => $lang['Update'],
        'L_DELETE'              => $lang['Delete'],
        'L_EXPORT_MODULE'       => $lang['Export_lang_module'],
        'L_COMPLETE_LANG_EXPORT'=> $lang['Export_language'],
        'L_COMPLETE_EXPORT'     => $lang['Export_everything'],
        'L_LANG_CP_TITLE'       => $lang['Language_cp_title'],
        'L_LANG_CP_EXPLAIN'     => $lang['Language_cp_explain'],
        'L_LANGUAGE_KEY'        => $lang['Language_key'],
        'L_LANGUAGE_VALUE'      => $lang['Language_value'],
        'L_UPDATE_ALL'          => $lang['Update_all_lang'],
        'L_ADD_NEW_KEY'         => $lang['Add_new_key'],
        'L_CREATE_NEW_LANG'     => $lang['Create_new_lang'],
        'L_DELETE_LANG'         => $lang['Delete_language'],
        'L_IMPORT_NEW_LANGUAGE' => $lang['Import_new_language'],
        'SPACER_IMG'            => $images['spacer'],
        'U_NEW_LANG_IMPORT'     => admin_sid('import_lang.php&amp;mode=import_new_lang'),
        'U_LANG_COMPLETE_EXPORT'=> admin_sid('download_lang.php&amp;mode=export_everything'))
    );
    // Collect available Languages
    $provided_languages = get_all_installed_languages();
    $sql = "SELECT m.*, i.* FROM " . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i WHERE i.module_id = m.module_id";
    if (!($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
    }
    $modules = $db->sql_fetchrowset($result);
    for ($i = 0; $i < count($provided_languages); $i++) {
        if ($lang_decollapse == $provided_languages[$i]) {
            $col_decol = '-';
            $link_col_decol = admin_sid('admin_stats_lang.php&amp;mode=select');
        } else {
            $col_decol = '+';
            $link_col_decol = admin_sid('admin_stats_lang.php&amp;mode=select&amp;d_lang=' . $provided_languages[$i]);
        }
        $template->assign_block_vars('langrow', array(
            'LANGUAGE'              => $provided_languages[$i],
            'L_COLLAPSE_DECOLLAPSE' => $col_decol,
            'U_COLLAPSE_DECOLLAPSE' => $link_col_decol,
            'U_LANG_COMPLETE_EDIT'  => admin_sid('admin_stats_lang.php&amp;mode=select&amp;m_mode=edit&amp;m_lang=' . $provided_languages[$i] . '&amp;d_lang=' . $lang_decollapse),
            'U_LANG_COMPLETE_EXPORT'=> admin_sid('download_lang.php&amp;mode=export_lang&amp;m_lang=' . $provided_languages[$i])
            )
        );
        if ($lang_decollapse == $provided_languages[$i]) {
            for ($j = 0; $j < count($modules); $j++) {
                $informations = ( intval($modules[$j]['active']) == 1) ? 'Active' : 'Not Active';
                if (!module_is_in_lang($modules[$j]['short_name'], $provided_languages[$i])) {
                    $informations .= '<br />No Content';
                }
                $template->assign_block_vars('langrow.modulerow', array(
                    'MODULE_NAME'   => $modules[$j]['long_name'],
                    'MODULE_DESC'   => $modules[$j]['extra_info'],
                    'U_LANG_EDIT'   => admin_sid('admin_stats_lang.php&amp;mode=select&amp;m_mode=edit&amp;m_lang=' . $provided_languages[$i] . '&amp;m_module=' . $modules[$j]['module_id'] . '&amp;d_lang=' . $lang_decollapse),
                    'U_LANG_EXPORT' => admin_sid('download_lang.php&amp;mode=export_module&amp;m_lang=' . $provided_languages[$i] . '&amp;m_module=' . $modules[$j]['module_id']),
                    'INFORMATIONS'  => $informations)
                );
            }
        }
    }
    if ($m_mode == 'edit') {
        $module_id = $_GETVAR->get('m_module', 'request', 'int', -1);
        $language = trim($_GETVAR->get('m_lang', 'request', 'string', ''));
        if ($language == '') {
            message_die(GENERAL_MESSAGE, 'Invalid Call, Hacking Attempt ?');
        }
        $current_modules = array();
        if ($module_id != -1) {
            for ($i = 0; $i < count($modules); $i++) {
                if (intval($modules[$i]['module_id']) == $module_id) {
                    $current_modules[0] = $modules[$i];
                    break;
                }
            }
        } else {
            $current_modules = $modules;
        }
        $template->assign_vars(array(
            'LANGUAGE' => $language)
        );
        for ($i = 0; $i < count($current_modules); $i++) {
            $template->assign_block_vars('modules', array(
                'MODULE_NAME' => $current_modules[$i]['long_name'],
                'MODULE_ID'   => $current_modules[$i]['module_id'])
            );
            $lang_entries = get_lang_entries($current_modules[$i]['short_name'], $language);
            for ($j = 0; $j < count($lang_entries); $j++) {
                $template->assign_block_vars('modules.language_entries', array(
                    'KEY'       => $lang_entries[$j]['key'],
                    'MODULE_ID' => $current_modules[$i]['module_id'],
                    'VALUE'     => $lang_entries[$j]['value'])
                );
            }
        }
        $template->assign_var_from_handle('EDIT_LANG_PANEL', 'lang_body');
    }
}

$template->pparse('body');
//
// Page Footer
//
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>