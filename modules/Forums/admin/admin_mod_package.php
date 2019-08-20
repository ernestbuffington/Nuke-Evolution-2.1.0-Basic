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
        $module['Statistics']['Package_Module'] = $filename . '?mode=mod_pak';
        return;
    }
}

global $_GETVAR;

$mode   = $_GETVAR->get('mode', 'request', 'string', '');
$submit = $_GETVAR->get('submit', 'post', 'string', NULL) ? TRUE : FALSE;
if (($mode == 'mod_pak') && ($submit)) {
    $no_page_header = true;
}
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
// BEGIN Package Module
if (($mode == 'mod_pak') && ($submit)) {
    $info_file = trim($_GETVAR->get('info_file', 'post', 'string'));
    $lang_file = trim($_GETVAR->get('lang_file', 'post', 'string'));
    $php_file  = trim($_GETVAR->get('php_file', 'post', 'string'));
    $pak_name  = (trim($_GETVAR->get('pak_name', 'post', 'string')) != '') ? trim($_GETVAR->get('pak_name', 'post', 'string')) . '.pak' : 'module.pak';
    // create temporary file
    if (!($fp = @fopen(NUKE_FORUMS_DIR . 'modules/cache/' . $pak_name, 'wb'))) {
        message_die(GENERAL_ERROR, 'Unable to write Package File. Please check the Package Naming.');
    }
    // Write PAK Header
    @fwrite($fp, '3.0.0', 5);
    @fwrite($fp, 'MPAK', 4);
    @fwrite($fp, pack("C*", 0xFF, 0xFC, 0xCC), 3);
    @fwrite($fp, 'INFO', 4);
    @fwrite($fp, pack("C*", 0xCC, 0xFC, 0xFF), 3);
    $content = implode('', file(NUKE_FORUMS_DIR . 'modules/pakfiles/' . $info_file));
    $size = strlen($content);
    @fwrite($fp, $content, $size);
    @fwrite($fp, pack("C*", 0xCC, 0xCC, 0xFF), 3);
    @fwrite($fp, 'INFO', 4);
    @fwrite($fp, pack("C*", 0xFF, 0xCC, 0xCC), 3);
    @fwrite($fp, pack("C*", 0xFF, 0xFC, 0xCC), 3);
    @fwrite($fp, 'LANG', 4);
    @fwrite($fp, pack("C*", 0xCC, 0xFC, 0xFF), 3);
    $content = implode('', file(NUKE_FORUMS_DIR . 'modules/pakfiles/' . $lang_file));
    $size = strlen($content);
    @fwrite($fp, $content, $size);
    @fwrite($fp, pack("C*", 0xCC, 0xCC, 0xFF), 3);
    @fwrite($fp, 'LANG', 4);
    @fwrite($fp, pack("C*", 0xFF, 0xCC, 0xCC), 3);
    @fwrite($fp, pack("C*", 0xFF, 0xFC, 0xCC), 3);
    @fwrite($fp, 'MOD', 3);
    @fwrite($fp, pack("C*", 0xCC, 0xFC, 0xFF), 3);
    $content = implode('', file(NUKE_FORUMS_DIR . 'modules/pakfiles/' . $php_file));
    $size = strlen($content);
    @fwrite($fp, $content, $size);
    @fwrite($fp, pack("C*", 0xCC, 0xCC, 0xFF), 3);
    @fwrite($fp, 'MOD', 4);
    @fwrite($fp, pack("C*", 0xFF, 0xCC, 0xCC), 3);
    @fclose($fp);
    $content = implode('', file(NUKE_FORUMS_DIR . 'modules/cache/' . $pak_name));
    @unlink(NUKE_FORUMS_DIR . 'modules/cache/' . $pak_name);
    header("Content-Type: text/x-delimtext; name=\"" . $pak_name . "\"");
    header("Content-disposition: attachment; filename=" . $pak_name);
    echo $content;
    exit;
}

if (($mode == 'mod_pak') && (!$submit)) {
    $template->set_filenames(array(
        'body' => 'admin/stat_make_pak.tpl')
    );
    $info_files = array();
    $lang_files = array();
    $php_files = array();
    $dir = @opendir(NUKE_FORUMS_DIR . 'modules/pakfiles');
    while($file = @readdir($dir)) {
        if( !@is_dir(NUKE_FORUMS_DIR . 'modules/pakfiles' . '/' . $file) ) {
            if ( preg_match('#.info#', $file) ) {
                $info_files[] = $file;
            } else if ( preg_match('#.lang#', $file) ) {
                $lang_files[] = $file;
            } else if ( preg_match('#.php#', $file) ) {
                $php_files[] = $file;
            }
        }
    }
    @closedir($dir);
    if ((count($info_files) == 0) || (count($lang_files) == 0) || (count($php_files) == 0)) {
        message_die(GENERAL_MESSAGE, $lang['No_package_Up']);
    }
    sort($info_files, SORT_STRING);
    sort($lang_files, SORT_STRING);
    sort($php_files, SORT_STRING);
    $info_select_field = '<select name="info_file">';
    for ($i = 0; $i < count($info_files); $i++) {
        $selected = ($i == 0) ? ' selected="selected"' : '';
        $info_select_field .= '<option value="' . $info_files[$i] . '"' . $selected . '>' . $info_files[$i] . '</option>';
    }
    $info_select_field .= '</select>';
    $lang_select_field = '<select name="lang_file">';
    for ($i = 0; $i < count($lang_files); $i++) {
        $selected = ($i == 0) ? ' selected="selected"' : '';
        $lang_select_field .= '<option value="' . $lang_files[$i] . '"' . $selected . '>' . $lang_files[$i] . '</option>';
    }
    $lang_select_field .= '</select>';
    $php_select_field = '<select name="php_file">';
    for ($i = 0; $i < count($php_files); $i++) {
        $selected = ($i == 0) ? ' selected="selected"' : '';
        $php_select_field .= '<option value="' . $php_files[$i] . '"' . $selected . '>' . $php_files[$i] . '</option>';
    }
    $php_select_field .= '</select>';
    $template->assign_vars(array(
        'L_PACKAGE_MODULE'          => $lang['Package_module'],
        'L_PACKAGE_MODULE_EXPLAIN'  => $lang['Package_module_explain'],
        'L_SELECT_INFO_FILE'        => $lang['Select_info_file'],
        'L_SELECT_LANG_FILE'        => $lang['Select_lang_file'],
        'L_SELECT_MODULE_FILE'      => $lang['Select_module_file'],
        'L_PACKAGE_NAME'            => $lang['Package_name'],
        'L_CREATE'                  => $lang['Create'],
        'S_ACTION'                  => admin_sid('admin_mod_package.php&amp;mode=' . $mode),
        'S_LANG_FILE'               => $lang_select_field,
        'S_INFO_FILE'               => $info_select_field,
        'S_PHP_FILE'                => $php_select_field)
    );
}
// END Package Module
$template->pparse('body');
//
// Page Footer
//
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>