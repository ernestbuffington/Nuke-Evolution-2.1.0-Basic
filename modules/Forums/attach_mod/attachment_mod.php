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

if (!defined('FORUM_ADMIN') && !defined('MODULE_FILE') && !defined('IN_PHPBB') ) {
   die('You can\'t access this file directly');
}

global $file_mode;

include_once($phpbb_root_path . 'attach_mod/includes/functions_includes.php');
include_once($phpbb_root_path . 'attach_mod/includes/functions_attach.php');
include_once($phpbb_root_path . 'attach_mod/includes/functions_delete.php');
include_once($phpbb_root_path . 'attach_mod/includes/functions_thumbs.php');
include_once($phpbb_root_path . 'attach_mod/includes/functions_filetypes.php');

if (defined('ATTACH_INSTALL')) {
    return;
}

/**
* wrapper function for determining the correct language directory
*/
function attach_mod_get_lang($language_file) {
    global $phpbb_root_path, $attach_config, $board_config;

    $language = $board_config['default_lang'];
    if (!@file_exists($phpbb_root_path . 'language/lang_' . $language . '/' . $language_file . '.php')) {
        $language = $attach_config['board_lang'];
        if (!@file_exists($phpbb_root_path . 'language/lang_' . $language . '/' . $language_file . '.php')) {
            message_die(GENERAL_MESSAGE, 'Attachment Mod language file does not exist: language/lang_' . $language . '/' . $language_file . '.php');
        } else {
            return $language;
        }
    } else {
        return $language;
    }
}

/**
* Include attachment mod language entries
*/
function include_attach_lang() {
    global $phpbb_root_path, $lang, $board_config, $attach_config;

    // Include Language
    $language = attach_mod_get_lang('lang_main_attach');
    include_once($phpbb_root_path . 'language/lang_' . $language . '/lang_main_attach.php');

    if (defined('IN_ADMIN')) {
        $language = attach_mod_get_lang('lang_admin_attach');
        include_once($phpbb_root_path . 'language/lang_' . $language . '/lang_admin_attach.php');
    }
}

/**
* Get attachment mod configuration
*/
function get_config() {
    global $db, $board_config;

    $attach_config = array();
    $sql = 'SELECT *
            FROM ' . ATTACH_CONFIG_TABLE;
    if (!($result = $db->sql_query($sql))) {
        message_die(GENERAL_ERROR, 'Could not query attachment information', '', __LINE__, __FILE__, $sql);
    }
    while ($row = $db->sql_fetchrow($result)) {
        $attach_config[$row['config_name']] = trim($row['config_value']);
    }
    $db->sql_freeresult($result);
    // We assign the original default board language here, because it gets overwritten later with the users default language
    $attach_config['board_lang'] = trim($board_config['default_lang']);
    return $attach_config;
}

// Get Attachment Config
$cache_dir     = $phpbb_root_path . '/cache';
$cache_file    = $cache_dir . '/attach_config.php';
$attach_config = array();

if (@file_exists($cache_dir) && @is_dir($cache_dir) && is_writable($cache_dir)) {
    if (@file_exists($cache_file)) {
        include($cache_file);
    } else {
        $attach_config = get_config();
        $fp = @fopen($cache_file, 'wt+');
        if ($fp) {
            $lines = array();
            foreach ($attach_config as $k => $v) {
                if (is_int($v)) {
                    $lines[] = "'$k'=>$v";
                } else if (is_bool($v)) {
                    $lines[] = "'$k'=>" . (($v) ? 'TRUE' : 'FALSE');
                } else {
                    $lines[] = "'$k'=>'" . str_replace("'", "\\'", str_replace('\\', '\\\\', $v)) . "'";
                }
            }
            @fwrite($fp, '<?php $attach_config = array(' . implode(',', $lines) . '); ?>');
            @fclose($fp);
            @chmod($cache_file, $file_mode);
        }
    }
} else {
    $attach_config = get_config();
}

// Please do not change the include-order, it is valuable for proper execution.
// Functions for displaying Attachment Things
include_once($phpbb_root_path . 'attach_mod/displaying.php');

// Posting Attachments Class (HAVE TO BE BEFORE PM)
include_once($phpbb_root_path . 'attach_mod/posting_attachments.php');

// PM Attachments Class
include_once($phpbb_root_path . 'attach_mod/pm_attachments.php');

if (!intval($attach_config['allow_ftp_upload'])) {
    $upload_dir = $attach_config['upload_dir'];
} else {
    $upload_dir = $attach_config['download_path'];
}

if (!function_exists('attach_mod_sql_escape')) {
    message_die(GENERAL_MESSAGE, 'You haven\'t correctly updated/installed the Attachment Mod.<br />You seem to forgot uploading a new file. Please refer to the update instructions for help and make sure you have uploaded every file correctly.');
}

?>