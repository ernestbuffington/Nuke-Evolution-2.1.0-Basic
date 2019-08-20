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
        $module['General']['Configuration'] = $filename;
        return;
    }
}


global $_GETVAR, $currentlang;
include_once(NUKE_INCLUDE_DIR.'functions_selects.php');
$lang_file = '/lang_adv_time.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

//
// Pull all config data
//
$sql = "SELECT * FROM " . CONFIG_TABLE;
if(!$result = $db->sql_query($sql)) {
    message_die(CRITICAL_ERROR, "Could not query config information in admin_board", "", __LINE__, __FILE__, $sql);
} else {
    while( $row = $db->sql_fetchrow($result) ) {
        $config_name  = $row['config_name'];
        $config_value = $row['config_value'];
        $default_config[$config_name] = $config_value;
        $new[$config_name] =  $_GETVAR->get($config_name, 'post', 'string', $default_config[$config_name]);
        if ($config_name == 'cookie_name') {
            $cookie_name = str_replace('.', '_', $new['cookie_name']);
        }
        // Attempt to prevent a common mistake with this value,
        // http:// is the protocol and not part of the server name
        if ($config_name == 'server_name') {
            $new['server_name'] = str_replace('http://', '', $new['server_name']);
        }
        // Attempt to prevent a mistake with this value.
        if ($config_name == 'avatar_path') {
            $new['avatar_path'] = trim($new['avatar_path']);
            if (strstr($new['avatar_path'], "\0") || !is_dir(NUKE_FORUMS_DIR . $new['avatar_path']) || !is_writable(NUKE_FORUMS_DIR . $new['avatar_path'])) {
                $new['avatar_path'] = $default_config['avatar_path'];
            }
        }
        if( $_GETVAR->get('submit', 'post', 'string', NULL) ) {
            if ($config_name == 'default_Theme') {
                $sql = "UPDATE "._NUKE_CONFIG_TABLE." SET
                     default_Theme = '" . str_replace("\'", "''", $new[$config_name]) . "'";
                if( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
                }
            } else {
                $sql = "UPDATE " . CONFIG_TABLE . " SET
                    config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
                    WHERE config_name = '$config_name'";
                if( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
                }
            }
            $cache->delete('nukeconfig');
            $cache->delete('board_config');
            $cache->delete('evoconfig');
        }
    }
    if( $_GETVAR->get('submit', 'post', 'string', NULL) ) {
        $message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . admin_sid("admin_board.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
        message_die(GENERAL_MESSAGE, $message);
    }
}

$config_dir     = NUKE_FORUMS_ADMIN_DIR.'board_config';

define('BOARD_CONFIG', TRUE);
include($config_dir . '/page_header.php');
$load_files = 1;
$dir = opendir($config_dir);
$dhtml_id = 0;
while( false !== ($file = @readdir($dir)) )  {
    if( preg_match("/^board_.*?\.php$/", $file) ) {
        $dhtml_id++;
        include_once($config_dir . '/' . $file);
    }
}
@closedir($dir);
unset($load_files);
include_once($config_dir . '/page_footer.php');
include_once(NUKE_FORUMS_ADMIN_DIR.'page_footer_admin.php');

?>