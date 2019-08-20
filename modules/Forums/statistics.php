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
global $_GETVAR, $directory_mode;

$module_name = basename(dirname(__FILE__));
require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');

define('IN_PHPBB', TRUE);

include($phpbb_root_path . 'common.php');

$userdata = session_pagestart($user_ip, PAGE_STATS);
init_userprefs($userdata);

include($phpbb_root_path . 'stats_mod/includes/constants.php');
include($phpbb_root_path . 'stats_mod/includes/lang_functions.php');
include($phpbb_root_path . 'stats_mod/includes/stat_functions.php');
include($phpbb_root_path . 'stats_mod/includes/template.php');
include($phpbb_root_path . 'stats_mod/core.php');

if (STATS_DEBUG) {
    $m_time = microtime();
    $m_time = explode(" ",$m_time);
    $m_time = $m_time[1] + $m_time[0];
    $stats_starttime = $m_time;
}

$sql = 'SELECT * FROM ' . STATS_CONFIG_TABLE;

if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
}

$stats_config = array();

while ($row = $db->sql_fetchrow($result)) {
    $stats_config[$row['config_name']] = trim($row['config_value']);
}
$db->sql_freeresult($result);

init_core();

$preview_module = $_GETVAR->get('preview', 'get', 'int', -1);

if ($preview_module == -1 || $preview_module == 0 || is_user() ) {
    // Get all module informations about activated modules
    $modules = get_modules();
} else {
    // Get all module informations about given module_id (activated or not)
    $modules = get_modules(FALSE, $preview_module);
    $core->do_not_use_cache = TRUE;
}

$lang_file = '/lang_admin.php';
if (@file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

$lang_file = '/lang_statistics.php';
if (@file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

$lang_file = '/lang_modules.php';
if (@file_exists($phpbb_root_path . 'modules/language/lang_' . $currentlang . $lang_file)) {
    include_once($phpbb_root_path . 'modules/language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists($phpbb_root_path . 'modules/language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once($phpbb_root_path . 'modules/language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

$page_title = $lang['Board_statistics'];
include_once(NUKE_INCLUDE_DIR.'page_header.php');

$development = FALSE;

$iterate_index = 0;
$iterate_end = count($modules);
while ($iterate_index < $iterate_end) {
    $first_iterate = ($iterate_index == 0 && !$development) ? TRUE : FALSE;
    $last_iterate = ($iterate_index == $iterate_end-1) ? TRUE : FALSE;

    $core->current_module_path = $phpbb_root_path . 'modules/' . trim($modules[$iterate_index]['short_name']) . '/';
    $core->current_module_name = trim($modules[$iterate_index]['short_name']);
    $core->current_module_id = intval($modules[$iterate_index]['module_id']);

    // Set Language
    $keys = array();
    eval('$current_lang = $' . $core->current_module_name . ';');

    if (is_array($current_lang)) {
        foreach ($current_lang as $key => $value) {
            $lang[$key] = $value;
            $keys[] = $key;
        }
    }
    include($core->current_module_path . 'module.php');
    $iterate_index++;

  // Unset the language keys
    for ($i = 0; $i < count($keys); $i++) {
        unset($lang[$keys[$i]]);
    }
}

$sql = "UPDATE " . STATS_CONFIG_TABLE . "
        SET config_value = " . (intval($stats_config['page_views']) + 1) . "
        WHERE (config_name = 'page_views')";

if (!$db->sql_query($sql)) {
    message_die(GENERAL_ERROR, 'Unable to Update View Counter', '', __LINE__, __FILE__, $sql);
}

if (STATS_DEBUG) {
    if (!@file_exists($phpbb_root_path . 'modules/cache/explain')) {
        @umask(0);
        @mkdir($phpbb_root_path . 'modules/cache/explain', $directory_mode);
    }

    $m_time = microtime();
    $m_time = explode(" ",$m_time);
    $m_time = $m_time[1] + $m_time[0];
    $stats_endtime = $m_time;
    $stats_totaltime = $lang['Footer_Text_TotalTime'].': '.($stats_endtime - $stats_starttime);
    $explain = ($userdata['user_level'] == ADMIN) ? '<a href="modules/Forums/modules/cache/explain/e' . $userdata['user_id'] . '.html " target="_blank">Explain</a>' : '';
    $template->assign_vars(array(
        'TIME'      => $stats_totaltime,
        'SQL_TIME'  => $lang['Footer_Text_SQLTime'].': '.$stat_db->sql_time,
        'QUERY'     => $lang['Footer_Text_SQLQueries'].': '.$stat_db->num_queries,
        'U_EXPLAIN' => $explain)
    );

    $template->assign_block_vars('switch_debug', array());

    if ($stat_db->sql_time > 0) {
        $fp = fopen($phpbb_root_path . 'modules/cache/explain/e' . $userdata['user_id'] . '.html', 'wt');
        fwrite($fp, $stat_db->sql_report);
        $str = "<pre><strong>" . $lang['Footer_Text_Generated'] . $stat_db->num_queries . " ". $lang['Footer_Text_Queries'] . $stat_db->sql_time . " " . $lang['Footer_Text_Mysql'] ." " . ($stats_totaltime - $stat_db->sql_time) . " " . $lang['Footer_Text_Php']. "</strong></pre>";
        fwrite($fp, $str);
        fclose($fp);
    }
}

$template->set_filenames(array(
    'body' => 'statistics.tpl')
);

$template->pparse('body');

include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>