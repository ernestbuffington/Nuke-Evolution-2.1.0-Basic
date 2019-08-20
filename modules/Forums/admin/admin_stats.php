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
        $module['Statistics']['Stats_configuration'] = $filename . '&amp;mode=config';
        return;
    }
}

global $_GETVAR;

$mode   = $_GETVAR->get('mode', 'request', 'string', NULL);
$submit = $_GETVAR->get('submit', 'post', 'string') ? TRUE : FALSE;
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
$message = '';
$stats_config = array();
while ($row = $db->sql_fetchrow($result)) {
    $stats_config[$row['config_name']] = trim($row['config_value']);
}

include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/lang_functions.php');
include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/stat_functions.php');
include_once(NUKE_FORUMS_DIR . 'stats_mod/includes/admin_functions.php');


if ($submit) {
    $config_update = FALSE;
    // Go through all configuration settings
    if ( (intval($stats_config['return_limit']) != $_GETVAR->get('return_limit', 'post', 'int', NULL)) ) {
        $sql = "UPDATE " . STATS_CONFIG_TABLE . " SET config_value = '" . trim($_GETVAR->get('return_limit', 'post', 'int')) . "' WHERE config_name = 'return_limit'";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to update statistics config table', '', __LINE__, __FILE__, $sql);
        }
        $config_update = TRUE;
    }
    if ($config_update) {
        $sql = "SELECT * FROM " . STATS_CONFIG_TABLE;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
        }
        $stats_config = array();
        while ($row = $db->sql_fetchrow($result)) {
            $stats_config[$row['config_name']] = trim($row['config_value']);
        }
        $message = ($message == '') ? $message . $lang['Msg_config_updated'] : $message . '<br />' . $lang['Msg_config_updated'];
    }
    // Reset Settings
    if ( $_GETVAR->get('reset_view_count', 'post', 'string', NULL) ) {
        $sql = "UPDATE " . STATS_CONFIG_TABLE . " SET config_value = '0' WHERE config_name = 'page_views'";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to update statistics config table', '', __LINE__, __FILE__, $sql);
        }
        $message = ($message == '') ? $message . $lang['Msg_reset_view_count'] : $message . '<br />' . $lang['Msg_reset_view_count'];
    }
    // Reset Settings
    if ( $_GETVAR->get('reset_install_date', 'post', 'string', NULL) ) {
        $sql = "UPDATE " . STATS_CONFIG_TABLE . " SET config_value = '" . time() . "' WHERE config_name = 'install_date'";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to update statistics config table', '', __LINE__, __FILE__, $sql);
        }
        $sql = "SELECT * FROM " . STATS_CONFIG_TABLE;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
        }
        $stats_config = array();
        while ($row = $db->sql_fetchrow($result)) {
            $stats_config[$row['config_name']] = trim($row['config_value']);
        }
        $message = ($message == '') ? $message . $lang['Msg_reset_install_date'] : $message . '<br />' . $lang['Msg_reset_install_date'];
    }
    // Reset Cache
    if ( $_GETVAR->get('reset_cache', 'post', 'string', NULL) ) {
        // Clear Module Cache
        $sql = "UPDATE " . CACHE_TABLE . " SET module_cache_time = 0, db_cache = '', priority = 0";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to update cache table', '', __LINE__, __FILE__, $sql);
        }
        // Clear the Smilies Cache
        $sql = "DELETE FROM " . SMILIE_INDEX_TABLE;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to update smiley index table', '', __LINE__, __FILE__, $sql);
        }
        $sql = "UPDATE " . SMILIE_INFO_TABLE . " SET last_post_id = 0, last_update_time = 0";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Unable to update smiley info table', '', __LINE__, __FILE__, $sql);
        }
        // Clear Cache Directory
        clear_directory('modules/cache');
        $message = ($message == '') ? $message . $lang['Msg_reset_cache'] : $message . '<br />' . $lang['Msg_reset_cache'];
    }
    // Delete Module Directory
    if ( $_GETVAR->get('purge_module_directory', 'post', 'string', NULL) ) {
        clear_directory('modules');
        $message = ($message == '') ? $message . $lang['Msg_purge_modules'] : $message . '<br />' . $lang['Msg_purge_modules'];
    }
} else {
    $sql = "SELECT * FROM " . STATS_CONFIG_TABLE;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
    }
    $stats_config = array();
    while ($row = $db->sql_fetchrow($result)) {
        $stats_config[$row['config_name']] = trim($row['config_value']);
    }
    $message = ($message == '') ? $message . $lang['Msg_config_updated'] : $message . '<br />' . $lang['Msg_config_updated'];
}

if ($mode == 'config') {
    $template->set_filenames(array(
        'body' => 'admin/stat_config_body.tpl')
    );
    $template->assign_vars(array(
        'L_SUBMIT'                          => $lang['Submit'],
        'L_RESET'                           => $lang['Reset'],
        'L_MESSAGES'                        => $lang['Messages'],
        'L_CONFIGURATION'                   => $lang['Stats_configuration'],
        'L_CONFIG_TITLE'                    => $lang['Config_Stat_title'],
        'L_CONFIG_EXPLAIN'                  => $lang['Config_Stat_explain'],
        'L_RETURN_LIMIT'                    => $lang['Return_limit'],
        'L_PURGE_MODULE_DIRECTORY'          => $lang['Purge_module_dir'],
        'L_PURGE_MODULE_DIRECTORY_EXPLAIN'  => $lang['Purge_module_dir_explain'],
        'L_RETURN_LIMIT_EXPLAIN'            => $lang['Return_limit_explain'],
        'L_RESET_SETTINGS_TITLE'            => $lang['Reset_settings_title'],
        'L_RESET_VIEW_COUNT'                => $lang['Reset_view_count'],
        'L_RESET_VIEW_COUNT_EXPLAIN'        => $lang['Reset_view_count_explain'],
        'L_RESET_INSTALL_DATE'              => $lang['Reset_install_date'],
        'L_RESET_INSTALL_DATE_EXPLAIN'      => $lang['Reset_install_date_explain'],
        'L_RESET_CACHE'                     => $lang['Reset_cache'],
        'L_RESET_CACHE_EXPLAIN'             => $lang['Reset_cache_explain'],
        'RETURN_LIMIT'                      => $stats_config['return_limit'],
        'MODULE_PAGINATION'                 => $stats_config['modules_per_page'],
        'S_ACTION'                          => admin_sid('admin_stats.php&amp;mode=' . $mode),
        'MESSAGE'                           => $message)
    );
}
$template->assign_vars(array(
    'VIEWED_INFO'  => sprintf($lang['Viewed_info'], $stats_config['page_views']),
    'INSTALL_INFO' => sprintf($lang['Install_info'], create_date($board_config['default_dateformat'], $stats_config['install_date'], $board_config['board_timezone'])),
    'VERSION_INFO' => sprintf($lang['Version_info'], $stats_config['version']))
);
$template->pparse('body');
//
// Page Footer
//
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>