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
        $module['Statistics']['Install_module'] = $filename . '&amp;mode=mod_install';
        $module['Statistics']['Manage_modules'] = $filename . '&amp;mode=mod_manage';
        return;
    }
}

global $_GETVAR, $board_config, $directory_mode, $file_mode;

$submit = $_GETVAR->get('submit', '_POST');
$cancel = $_GETVAR->get('cancel', '_POST');
$mode   = $_GETVAR->get('mode', '_REQUEST');
$deletemodule = $_GETVAR->get('deletemodule', '_REQUEST', 'int');
$module_id = $deletemodule;

$lang_file = '/lang_admin_statistics.php';
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

if ($cancel) {
    $url = admin_sid('admin_statistics.php&amp;mode=mod_manage', true);
    redirect($url);
    exit;
}

// BEGIN Install Module
if (($mode == 'mod_install') && ($submit)) {
    $update_id = $_GETVAR->get('update_id', '_POST', 'int', -1);
    $filename  = $_GETVAR->get('filename', '_POST');
    $install_languages = $_GETVAR->get('checked_languages', '_POST', 'array', array());
    $template->set_filenames(array(
        'body' => 'admin/stat_install_module.tpl')
    );
    if ( !empty($filename) ) {
        if (!($fp = @fopen($filename, 'r')) ) {
            message_die(GENERAL_ERROR, 'Unable to open ' . $filename);
        }
        read_pak_header($fp);
        @fclose($fp);
        if (strstr($filename, 'test.pak')) {
            @unlink($filename);
        }
        $stream     = implode('', @file($filename));
        $info_file  = read_pak_file($stream, 'INFO');
        $lang_file  = read_pak_file($stream, 'LANG');
        $php_file   = read_pak_file($stream, 'MOD');
        $info_array = parse_info_file($info_file);
        for ($i = 0; $i < count($install_languages); $i++) {
            $install_languages[$i] = 'lang_' . trim($install_languages[$i]);
        }
        $lang_array = parse_lang_file($lang_file, $install_languages);
        build_module($info_array, $lang_array, $php_file, $update_id);
        if ($update_id == -1) {
            message_die(GENERAL_MESSAGE, $lang['Module_installed']);
        } else {
            message_die(GENERAL_MESSAGE, $lang['Module_updated']);
        }
    }
    if ( $_GETVAR->get('fileselect', '_POST') ) {
        $filename = NUKE_FORUMS_DIR . 'modules/pakfiles/' . trim($HTTP_POST_VARS['selected_pak_file']);
    } else if ( $_GETVAR->get('fileupload', '_POST') ) {
        $filename = $HTTP_POST_FILES['package']['tmp_name'];
        // check php upload-size
        if ( ($filename == 'none') || ($filename == '') ) {
            message_die(GENERAL_ERROR, 'Unable to upload file, please use the pak file selector');
        }
        $contents = @implode('', @file($filename));
        if ($contents == '') {
            message_die(GENERAL_ERROR, 'Unable to upload file, please use the pak file selector');
        }
        if (!@file_exists(NUKE_FORUMS_DIR . 'modules/cache')) {
            @umask(0);
            @mkdir(NUKE_FORUMS_DIR . 'modules/cache', $directory_mode);
        }
        if (!($fp = fopen(NUKE_FORUMS_DIR . 'modules/cache/temp.pak', 'wt'))) {
            message_die(GENERAL_ERROR, 'Unable to write temp file');
        }
        @fwrite($fp, $contents, strlen($contents));
        @fclose($fp);
        $filename = NUKE_FORUMS_DIR . 'modules/cache/temp.pak';
    } else {
        message_die(GENERAL_ERROR, 'Unable to find Module Package');
    }
    if (!($fp = @fopen($filename, 'r')) ) {
        message_die(GENERAL_ERROR, 'Unable to open ' . $filename);
    }
    read_pak_header($fp);
    @fclose($fp);
    $stream     = implode('', @file($filename));
    $info_file  = read_pak_file($stream, 'INFO');
    $lang_file  = read_pak_file($stream, 'LANG');
    $s_hidden_fields = '<input type="hidden" name="filename" value="' . $filename . '" />';
    // Prepare the Data
    $info_array = parse_info_file($info_file);
    $lang_array = parse_lang_file($lang_file);
    if (trim($info_array['short_name']) == '') {
        message_die(GENERAL_ERROR, 'Short name not specified.', '', __LINE__, __FILE__, $sql);
    }
    if ($update_id == -1) {
        $sql = "SELECT short_name FROM " . MODULES_TABLE . " WHERE short_name = '" . trim($info_array['short_name']) . "'";
        if (!($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
        }
        if ($db->sql_numrows($result) > 0) {
            message_die(GENERAL_ERROR, sprintf($lang['Inst_module_already_exist'], $info_array['short_name']));
        }
    } else {
        $sql = "SELECT * FROM " . MODULES_TABLE . " WHERE module_id = " . $update_id;
        if (!($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
        }
        if ($db->sql_numrows($result) == 0) {
            message_die(GENERAL_ERROR, 'Unable to get Module ' . $update_id);
        }
        $row = $db->sql_fetchrow($result);
        if (trim($row['short_name']) != trim($info_array['short_name'])) {
            message_die(GENERAL_ERROR, $lang['Incorrect_update_module']);
        }
    }
    // Prepare Template
    $template->assign_block_vars('switch_install_module', array());
    // Info Array
    $template->assign_vars(array(
        'L_INSTALL_MODULE'          => $lang['Install_module'],
        'L_INSTALL_MODULE_EXPLAIN'  => $lang['Install_module_explain'],
        'L_MODULE_NAME'             => $lang['Module_name'],
        'L_MODULE_DESCRIPTION'      => $lang['Module_description'],
        'L_MODULE_VERSION'          => $lang['Module_version'],
        'L_REQUIRED_STATS_VERSION'  => $lang['Required_stats_version'],
        'L_INSTALLED_STATS_VERSION' => $lang['Installed_stats_version'],
        'L_MODULE_AUTHOR'           => $lang['Module_author'],
        'L_AUTHOR_EMAIL'            => $lang['Author_email'],
        'L_MODULE_URL'              => $lang['Module_url'],
        'L_UPDATE_URL'              => $lang['Update_url'],
        'L_PROVIDED_LANGUAGE'       => $lang['Provided_language'],
        'L_INSTALL_LANGUAGE'        => $lang['Install_language'],
        'L_INSTALL'                 => $lang['Install'],
        'MODULE_NAME'               => nl2br($info_array['name']),
        'MODULE_DESCRIPTION'        => nl2br($info_array['extra_info']),
        'MODULE_VERSION'            => $info_array['version'],
        'STATS_VERSION'             => $info_array['stats_mod_version'],
        'INSTALLED_STATS_VERSION'   => $stats_config['version'],
        'MODULE_AUTHOR'             => nl2br($info_array['author']),
        'AUTHOR_EMAIL'              => nl2br($info_array['email']),
        'MODULE_URL'                => nl2br($info_array['url']),
        'UPDATE_URL'                => nl2br($info_array['check_update_site']))
    );
    @reset($lang_array);
    while (list($key, $data) = @each($lang_array)) {
        $language = str_replace('lang_', '', $key);
        $template->assign_block_vars('languages', array(
            'MODULE_LANGUAGE' => $language)
        );
    }
    $s_hidden_fields .= '<input type="hidden" name="install_module" value="1" />';
    if ($update_id != -1) {
        $s_hidden_fields .= '<input type="hidden" name="update_id" value="' . $update_id . '" />';
    }
    $template->assign_vars(array(
        'S_HIDDEN_FIELDS' => $s_hidden_fields)
    );
}

if (($mode == 'mod_install') && (!$submit)) {
    $template->set_filenames(array(
        'body' => 'admin/stat_install_module.tpl')
    );
    // first we have to pack ... or upload
    if ( (!isset($HTTP_POST_VARS['fileupload'])) && (!isset($HTTP_POST_VARS['fileselect'])) ) {
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
            $template->assign_block_vars('switch_select_module', array());
            $module_select_field = '<select name="selected_pak_file">';
            for ($i = 0; $i < count($module_paks); $i++) {
                $selected = ($i == 0) ? ' selected="selected"' : '';
                $module_select_field .= '<option value="' . $module_paks[$i] . '"' . $selected . '>' . $module_paks[$i] . '</option>';
            }
            $module_select_field .= '</select>';
            $s_hidden_fields = '<input type="hidden" name="fileselect" value="1" />';
            $template->assign_vars(array(
                'L_SELECT_MODULE'       => $lang['Select_module_pak'],
                'S_SELECT_MODULE'       => $module_select_field,
                'S_SELECT_HIDDEN_FIELDS'=> $s_hidden_fields)
            );
        }
        $template->assign_block_vars('switch_upload_module', array());
        $s_hidden_fields = '<input type="hidden" name="fileupload" value="1" />';
        $template->assign_vars(array(
            'L_INSTALL_MODULE'          => $lang['Install_module'],
            'L_INSTALL_MODULE_EXPLAIN'  => $lang['Install_module_explain'],
            'L_UPLOAD_MODULE'           => $lang['Upload_module_pak'],
            'L_SUBMIT'                  => $lang['Submit'],
            'S_ACTION'                  => admin_sid('admin_statistics.php&amp;mode=' . $mode),
            'S_UPLOAD_HIDDEN_FIELDS'    => $s_hidden_fields)
        );
    }
}
// END Install Module

// BEGIN Manage Modules
if ($mode == 'mod_manage') {
    if ( !empty($module_id )) {
        move_up($module_id);
    } else if ( $module_id = $_GETVAR->get('move_down', '_GET', 'int') ) {
        move_down($module_id);
    } else if ( $module_id = $_GETVAR->get('activate', '_GET', 'int') ) {
        activate($module_id);
    } else if ( $module_id = $_GETVAR->get('deactivate', '_GET', 'int') ) {
        deactivate($module_id);
    }
    $template->set_filenames(array(
        'body' => 'admin/stat_manage_body.tpl')
    );
    $sql = "SELECT m.*, i.* FROM " . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i WHERE i.module_id = m.module_id ORDER BY module_order ASC";
    if (!($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
    }
    if ($db->sql_numrows($result) == 0) {
        message_die(GENERAL_MESSAGE, 'No installed Modules found.');
    }
    $template->assign_vars(array(
        'L_EDIT'                    => $lang['Edit'],
        'L_DELETE'                  => $lang['Delete'],
        'L_MOVE_UP'                 => $lang['Move_up'],
        'L_MOVE_DOWN'               => $lang['Move_down'],
        'L_MANAGE_MODULES'          => $lang['Manage_modules'],
        'SPACER_IMG'                => $images['spacer'],
        'L_MANAGE_MODULES_EXPLAIN'  => $lang['Manage_modules_explain'])
    );
    while ($row = $db->sql_fetchrow($result)) {
        $module_id = intval($row['module_id']);
        $module_short_name = trim($row['short_name']);
        $module_active = (intval($row['active'])) ? TRUE : FALSE;
        $template->assign_block_vars('modulerow', array(
            'MODULE_NAME'       => trim($row['long_name']),
            'MODULE_DESC'       => trim(nl2br($row['extra_info'])),
            'U_VIEW_MODULE'     => append_sid('modules.php?name=Forums&amp;file=statistics&amp;preview=' . $module_id . '#' . $module_short_name),
            'U_MODULE_EDIT'     => admin_sid('admin_edit_module.php&amp;mode=mod_edit&amp;editmodule=' . $module_id),
            'U_MODULE_DELETE'   => admin_sid('admin_statistics.php&amp;mode=mod_delete&amp;deletemodule=' . $module_id),
            'U_MODULE_MOVE_UP'  => admin_sid('admin_statistics.php&amp;mode=' . $mode . '&amp;move_up=' . $module_id),
            'U_MODULE_MOVE_DOWN'=> admin_sid('admin_statistics.php&amp;mode=' . $mode . '&amp;move_down=' . $module_id),
            'U_MODULE_ACTIVATE' => ($module_active) ? admin_sid('admin_statistics.php&amp;mode=' . $mode . '&amp;deactivate=' . $module_id) : admin_sid('admin_statistics.php&amp;mode=' . $mode . '&amp;activate=' . $module_id),
            'ACTIVATE'          => ($module_active) ? $lang['Deactivate'] : $lang['Activate'])
        );
    }
}
// END Manage Modules

// BEGIN Delete Module
if ($mode == 'mod_delete') {
    if (!$_GETVAR->get('confirm', '_POST') ) {
        if (empty($deletemodule)) {
            message_die(GENERAL_ERROR, 'Unable to delete Module.');
        }
        $hidden_fields = '<input type="hidden" name="mode" value="'.$mode.'" /><input type="hidden" name="module_id" value="'.$module_id.'" />';
        $template->set_filenames(array(
            'body' => 'confirm_body.tpl')
        );
        $template->assign_vars(array(
            'MESSAGE_TITLE'     => $lang['Confirm'],
            'MESSAGE_TEXT'      => $lang['Confirm_delete_module'],
            'L_YES'             => $lang['Yes'],
            'L_NO'              => $lang['No'],
            'S_CONFIRM_ACTION'  => admin_sid('admin_statistics.php'),
            'S_HIDDEN_FIELDS'   => $hidden_fields)
        );
    } else {
        if ( empty($module_id) ) {
            message_die(GENERAL_ERROR, 'Unable to delete Module.');
        }
        // Firstly, we need the Module Informations ;)
        $sql = "SELECT * FROM " . MODULES_TABLE . " WHERE module_id = " . $module_id;
        if (!($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
        }
        if ($db->sql_numrows($result) == 0) {
            message_die(GENERAL_MESSAGE, 'No Module Data found... unable to delete Module.');
        }
        $row = $db->sql_fetchrow($result);
        $short_name = trim($row['short_name']);
        // Ok, collect the Informations for deleting the Language Variables
        $language_directory = NUKE_FORUMS_DIR . 'modules/language';
        $languages = array();
        if (!@file_exists($language_directory)) {
            message_die(GENERAL_ERROR, 'Unable to find Language Directory');
        }
        if( $dir = @opendir($language_directory) ) {
            while( $sub_dir = @readdir($dir) ) {
                if( !@is_file($language_directory . '/' . $sub_dir) && !@is_link($language_directory . '/' . $sub_dir) && $sub_dir != "." && $sub_dir != ".." && $sub_dir != "CVS" ) {
                    if (strstr($sub_dir, 'lang_')) {
                        $languages[] = trim($sub_dir);
                    }
                }
            }
            @closedir($dir);
        }
        $new_language_data = array();
        // Ok, go through all Languages and generate new Language Files
        for ($i = 0; $i < count($languages); $i++) {
            $language_file = NUKE_FORUMS_DIR . 'modules/language/' . $languages[$i] . '/lang_modules.php';
            $file_content = implode('', @file($language_file));
            if (trim($file_content) != '') {
                $file_content = delete_language_block($file_content, $short_name);
            }
            $new_language_data[$languages[$i]] = trim($file_content);
        }
        // Now begin the Transaction
        $sql = "DELETE FROM " . MODULES_TABLE . " WHERE module_id = " . $module_id;
        if (!($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to delete Module', '', __LINE__, __FILE__, $sql);
        }
        $sql = "DELETE FROM " . MODULE_INFO_TABLE . " WHERE module_id = " . $module_id;
        if (!($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to delete Module', '', __LINE__, __FILE__, $sql);
        }
        $sql = "DELETE FROM " . CACHE_TABLE . " WHERE module_id = " . $module_id;
        if (!($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to delete Module', '', __LINE__, __FILE__, $sql);
        }
        // was this the last module ?
        $sql = "SELECT * FROM " . MODULES_TABLE;
        if (!($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to select Modules', '', __LINE__, __FILE__, $sql);
        }
        if ($db->sql_numrows($result) == 0) {
            $delete_language_folder = TRUE; 
        } else {
            $delete_language_folder = FALSE;
        }
        // We are through successfully ? hmm... this was not intended. anyway, delete the Language Variables
        if ($delete_language_folder) {
            for ($i = 0; $i < count($languages); $i++) {
                $language = trim($languages[$i]);
                $language_dir = NUKE_FORUMS_DIR . 'modules/language';
                $language_file = NUKE_FORUMS_DIR . 'modules/language/' . $language . '/lang_modules.php';
                if (@file_exists($language_file)) {
                    @chmod($language_file, $file_mode);
                    @unlink($language_file);
                }
                if (@file_exists($language_dir . '/' . $language)) {
                    @chmod($language_dir . '/' . $language, $directory_mode);
                    @rmdir($language_dir . '/' . $language);
                }
            }
            @chmod($language_dir, $directory_mode);
            @rmdir($language_dir);
        } else {
            for ($i = 0; $i < count($languages); $i++) {
                $language = trim($languages[$i]);
                $language_dir = NUKE_FORUMS_DIR . 'modules/language';
                $language_file = NUKE_FORUMS_DIR . 'modules/language/' . $language . '/lang_modules.php';
                if (!@file_exists($language_dir)) {
                    @umask(0);
                    @mkdir($language_dir, $directory_mode);
                } else {
                    @chmod($language_dir, $directory_mode);
                }

                if (!@file_exists($language_dir . '/' . $language)) {
                    @umask(0);
                    @mkdir($language_dir . '/' . $language, $directory_mode);
                } else {
                    @chmod($language_dir . '/' . $language, $directory_mode);
                }
                if (@file_exists($language_file)) {
                    @chmod($language_file, $directory_mode);
                }
                if (!($fp = @fopen($language_file, 'wt'))) {
                    message_die(GENERAL_ERROR, 'Unable to write to: ' . $language_file);
                }
                @fwrite($fp, $new_language_data[$language], strlen($new_language_data[$language]));
                @fclose($fp);
                @chmod($language_file, $file_mode);
                @chmod($language_dir . '/' . $language, $directory_mode);
                @chmod($language_dir, $directory_mode);
            }
        }
        // Delete the Module Files
        $directory = NUKE_FORUMS_DIR . 'modules/' . $short_name;
        $module_file = NUKE_FORUMS_DIR . 'modules/' . $short_name . '/module.php';
        if (@file_exists($module_file)) {
            @chmod($module_file, $file_mode);
            @unlink($module_file);
        }
        if (@file_exists($directory)) {
            @chmod($directory, $directory_mode);
            @rmdir($directory);
        }
        // Resync Order
        resync_module_order();
        message_die(GENERAL_MESSAGE, 'Module successfully deleted');
    }
}
// END Delete Module
$template->pparse('body');

//
// Page Footer
//
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>