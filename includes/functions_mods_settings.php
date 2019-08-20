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

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

// some standard lists
$list_yes_no = array('Yes' => 1, 'No' => 0);
define('BOARD_ADMIN', 98);

//---------------------------------------------------------------
//
//  mods_settings_get_lang() : translation keys
//
//---------------------------------------------------------------
function mods_settings_get_lang($key) {
    global $lang;
    return ( (!empty($key) && isset($lang[$key])) ? $lang[$key] : $key );
}

//---------------------------------------------------------------
//
//  init_board_config_key() : add a key and its value to the board config table
//
//---------------------------------------------------------------
function init_board_config_key($key, $value, $force=false) {
    global $db, $board_config;

    if (!isset($board_config[$key])) {
        $board_config[$key] = $value;
        $sql = "INSERT INTO " . CONFIG_TABLE . " (config_name,config_value) VALUES('$key','$value')";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not add key ' . $key . ' in config table', '', __LINE__, __FILE__, $sql);
        }
    } else if ($force) {
        $board_config[$key] = $value;
        $sql = "UPDATE " . CONFIG_TABLE . " SET config_value='$value' WHERE config_name='$key'";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not add key ' . $key . ' in config table', '', __LINE__, __FILE__, $sql);
        }
    }
}

//---------------------------------------------------------------
//
//  user_board_config_key() : get the user choice if defined
//
//---------------------------------------------------------------
function user_board_config_key($key, $user_field='', $over_field='') {
    global $board_config, $userdata;

    // get the user fields name if not given
    if (empty($user_field)) {
        $user_field = 'user_' . $key;
    }
    // get the overwrite allowed switch name if not given
    if (empty($over_field)) {
        $over_field = $key . '_over';
    }
    // does the key exists ?
    if (!isset($board_config[$key])) {
        return;
    }
    // does the user field exists ?
    if (!isset($userdata[$user_field])) {
        return;
    }
    // does the overwrite switch exists ?
    if (!isset($board_config[$over_field])) {
        $board_config[$over_field] = 0; // no overwrite
    }
    // overwrite with the user data only if not overwrite sat, not anonymous, and logged in
    if (!intval($board_config[$over_field]) && is_user() ) {
        $board_config[$key] = $userdata[$user_field];
    } else {
        $userdata[$user_field] = $board_config[$key];
    }
}

//---------------------------------------------------------------
//
//  init_board_config() : get the user choice if defined
//
//---------------------------------------------------------------
function init_board_config($mod_name, $config_fields, $sub_name='', $sub_sort=0, $mod_sort=0, $menu_name='Preferences', $menu_sort=0) {
    global $mods;

    @reset($config_fields);
    while ( list($config_key, $config_data) = each($config_fields) ) {
        if (!isset($config_data['user_only']) || !$config_data['user_only']) {
            // create the key value
            init_board_config_key($config_key, ( !empty($config_data['values']) ? $config_data['values'][ $config_data['default'] ] : $config_data['default']) );
            if (!empty($config_data['user'])) {
                // create the "overwrite user choice" value
                init_board_config_key($config_key . '_over', 0);
                // get user choice value
                user_board_config_key($config_key, $config_data['user']);
            }
        }
        // deliever it for input only if not hidden
        if (!isset($config_data['hide'])) {
            $mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['data'][$config_key] = $config_data;
            // sort values : overwrite only if not yet provided
            if (empty($mods[$menu_name]['sort']) || ($mods[$menu_name]['sort'] == 0) ) {
                $mods[$menu_name]['sort'] = $menu_sort;
            }
            if (empty($mods[$menu_name]['data'][$mod_name]['sort']) || ($mods[$menu_name]['data'][$mod_name]['sort'] == 0) ) {
                $mods[$menu_name]['data'][$mod_name]['sort'] = $mod_sort;
            }
            if (empty($mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['sort']) || ($mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['sort'] == 0) ) {
                $mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['sort'] = $sub_sort;
            }
        }
    }
}

?>