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

if (!defined('IN_PHPBB') && !defined('NUKE_EVO')) {
    die('Hacking attempt');
}

/**
* set_var
*
* Set variable, used by {@link request_var the request_var function}
*
* @access: private
*/
function set_var(&$result, $var, $type, $multibyte = false) {
    settype($var, $type);
    $result = $var;
    if ($type == 'string') {
        $result = trim(htmlspecialchars(str_replace(array("\r\n", "\r"), array("\n", "\n"), $result)));
        // Check for possible multibyte characters to save a preg_replace call if nothing is in there...
        if ($multibyte && strpos($result, '&amp;#') !== false) {
            $result = preg_replace('#&amp;(\#[0-9]+;)#', '&\1', $result);
        }
    }
}

/**
* request_var
*
* Used to get passed variable
*/
function request_var($var_name, $default, $multibyte = false) {
    if (!isset($_REQUEST[$var_name]) || (is_array($_REQUEST[$var_name]) && !is_array($default)) || (is_array($default) && !is_array($_REQUEST[$var_name]))) {
        return (is_array($default)) ? array() : $default;
    }
    $var = $_REQUEST[$var_name];
    if (!is_array($default)) {
        $type = gettype($default);
    } else {
        list($key_type, $type) = each($default);
        $type = gettype($type);
        $key_type = gettype($key_type);
    }
    if (is_array($var)) {
        $_var = $var;
        $var = array();
        foreach ($_var as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $_k => $_v) {
                    set_var($k, $k, $key_type);
                    set_var($_k, $_k, $key_type);
                    set_var($var[$k][$_k], $_v, $type, $multibyte);
                }
            } else {
                set_var($k, $k, $key_type);
                set_var($var[$k], $v, $type, $multibyte);
            }
        }
    } else {
        set_var($var, $var, $type, $multibyte);
    }
    return $var;
}

include_once(NUKE_FORUMS_DIR . 'cat_mod/includes/functions_categories_hierarchy.php');

function get_forum_display_sort_option($selected_row=0, $action='list', $list='sort') {
    global $lang;

    $forum_display_sort = array(
        'lang_key'  => array('Last_Post', 'Sort_Topic_Title', 'Sort_Time', 'Sort_Author'),
        'fields'    => array('t.topic_last_post_id', 't.topic_title', 't.topic_time', 'u.username'),
    );
    $forum_display_order = array(
        'lang_key'  => array('Sort_Descending', 'Sort_Ascending'),
        'fields'    => array('DESC', 'ASC'),
    );
    // get the good list
    $list_name = 'forum_display_' . $list;
    $listrow = $$list_name;
    // init the result
    $res = '';
    if ( $selected_row > count($listrow['lang_key']) ) {
        $selected_row = 0;
    }
    // build list
    if ($action == 'list') {
        for ($i=0; $i < count($listrow['lang_key']); $i++) {
            $selected = ($i==$selected_row) ? ' selected="selected"' : '';
            $l_value = (isset($lang[$listrow['lang_key'][$i]])) ? $lang[$listrow['lang_key'][$i]] : $listrow['lang_key'][$i];
            $res .= '<option value="' . $i . '"' . $selected . '>' . $l_value . '</option>';
        }
    } else {
        // field
        $res = $listrow['fields'][$selected_row];
    }
    return $res;
}

function get_icon_title($icon, $empty=0, $topic_type=-1, $admin=false) {
    global $lang, $images;

    // get icons parameters
    include(NUKE_FORUMS_DIR . 'post_icon_mod/includes/def_icons.php');
    // alignment
    switch ($empty) {
        case 1:
            $align= 'middle';
            break;
        case 2:
            $align= 'bottom';
            break;
        default:
            $align = 'bottom';
            break;
    }
    // find the icon
    $found = false;
    $icon_map = -1;
    $icon_count = count($icones);
    for ($i=0; ($i < $icon_count && !$found); $i++) {
        if ($icones[$i]['ind'] == $icon) {
            $found = true;
            $icon_map = $i;
        }
    }
    // icon not found : try a default value
    if (!$found || ($found && empty($icones[$icon_map]['img']))) {
        $change = true;
        switch($topic_type) {
            case POST_NORMAL:
                $icon = $icon_defined_special['POST_NORMAL']['icon'];
                break;
            case POST_STICKY:
                $icon = $icon_defined_special['POST_STICKY']['icon'];
                break;
            case POST_ANNOUNCE:
                $icon = $icon_defined_special['POST_ANNOUNCE']['icon'];
                break;
            case POST_GLOBAL_ANNOUNCE:
                $icon = $icon_defined_special['POST_GLOBAL_ANNOUNCE']['icon'];
                break;
            case POST_BIRTHDAY:
                $icon = $icon_defined_special['POST_BIRTHDAY']['icon'];
                break;
            case POST_CALENDAR:
                $icon = $icon_defined_special['POST_CALENDAR']['icon'];
                break;
            case POST_PICTURE:
                $icon = $icon_defined_special['POST_PICTURE']['icon'];
                break;
            case POST_ATTACHMENT:
                $icon = $icon_defined_special['POST_ATTACHEMENT']['icon'];
                break;
            default:
                $change=false;
                break;
        }
        // a default icon has been sat
        if ($change)  {
            // find the icon
            $found = false;
            $icon_map = -1;
            for ($i=0; ($i < $icon_count && !$found); $i++) {
                if ($icones[$i]['ind'] == $icon) {
                    $found = true;
                    $icon_map = $i;
                }
            }
        }
    }
    // build the icon image
    if (!$found || ($found && empty($icones[$icon_map]['img']))) {
        switch ($empty) {
            case 0:
                $res = '';
                break;
            case 1:
                $res = '<img width="20" align="' . $align . '" src="' . $admin_path . $images['spacer'] . '" alt="" border="0" />';
                break;
            case 2:
                $res = isset($lang[ $icones[$icon_map]['alt'] ]) ? $lang[ $icones[$icon_map]['alt'] ] : $icones[$icon_map]['alt'];
                break;
        }
    } else {
        $image_base = pathinfo($icones[$icon_map]['img']);
        $image = evo_image($image_base['basename'], 'Forums', false);
        $show_image = (!empty($image) ? $image : evo_image($image_base['basename'], 'icons'));
        $res = '<img align="' . $align . '" src="' . $show_image . '" alt="' . ( isset($lang[ $icones[$icon_map]['alt'] ]) ? $lang[ $icones[$icon_map]['alt'] ] : $icones[$icon_map]['alt'] ) . '" title="' . ( isset($lang[ $icones[$icon_map]['alt'] ]) ? $lang[ $icones[$icon_map]['alt'] ] : $icones[$icon_map]['alt'] ) . '" border="0" />';
    }
    return $res;
}

function get_db_stat($mode) {
    global $db;

    switch( $mode ) {
        case 'usercount':
            $sql = "SELECT COUNT(user_id) AS total
                    FROM " . USERS_TABLE . "
                    WHERE user_id <> " . ANONYMOUS . "
                    AND user_active = 1 AND user_level > 0";
            break;
        case 'newestuser':
            $sql = "SELECT user_id, username
                    FROM " . USERS_TABLE . "
                    WHERE user_id <> " . ANONYMOUS . "
                    AND user_active = 1 AND user_level > 0
                    ORDER BY user_id DESC
                    LIMIT 1";
            break;
        case 'postcount':
        case 'topiccount':
            $sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total
                    FROM " . FORUMS_TABLE;
            break;
    }
    if ( !($result = $db->sql_query($sql)) )  {
        return false;
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    switch ( $mode ) {
        case 'usercount':
            return $row['total'];
            break;
        case 'newestuser':
            return $row;
            break;
        case 'postcount':
            return $row['post_total'];
            break;
        case 'topiccount':
            return $row['topic_total'];
            break;
    }
    return false;
}

// added at phpBB 2.0.11 to properly format the username
function phpbb_clean_username($username) {
    $username = substr(htmlspecialchars(str_replace("\'", "'", trim($username))), 0, 25);
    $username = phpbb_rtrim($username, "\\");
    $username = str_replace("'", "\'", $username);
    return $username;
}
/**
* This function is a wrapper for ltrim, as charlist is only supported in php >= 4.1.0
* Added in phpBB 2.0.18
*/
function phpbb_ltrim($str, $charlist = false) {
    if ($charlist === false) {
        return ltrim($str);
    }
    $php_version = explode('.', PHP_VERSION);
    // php version < 4.1.0
    if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1)) {
        while ($str{0} == $charlist) {
            $str = substr($str, 1);
        }
    } else {
        $str = ltrim($str, $charlist);
    }
    return $str;
}

// added at phpBB 2.0.12 to fix a bug in PHP 4.3.10 (only supporting charlist in php >= 4.1.0)
function phpbb_rtrim($str, $charlist = false) {
    if ($charlist === false) {
        return rtrim($str);
    }
    $php_version = explode('.', PHP_VERSION);
    // php version < 4.1.0
    if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1)) {
        while ($str{strlen($str)-1} == $charlist) {
            $str = substr($str, 0, strlen($str)-1);
        }
    } else {
        $str = rtrim($str, $charlist);
    }
    return $str;
}

/**
* Our own generator of random values
* This uses a constantly changing value as the base for generating the values
* The board wide setting is updated once per page if this code is called
* With thanks to Anthrax101 for the inspiration on this one
* Added in phpBB 2.0.20
*/
function dss_rand() {
    global $db, $board_config, $dss_seeded;

    $val = $board_config['rand_seed'] . microtime();
    $val = md5($val);
    $board_config['rand_seed'] = md5($board_config['rand_seed'] . $val . 'a');
    if($dss_seeded !== true) {
        $sql = "UPDATE " . CONFIG_TABLE . " SET
                config_value = '" . $board_config['rand_seed'] . "'
                WHERE config_name = 'rand_seed'";
        if( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, "Unable to reseed PRNG", "", __LINE__, __FILE__, $sql);
        }
        $dss_seeded = true;
    }
    return substr($val, 4, 16);
}

//
// Get Userdata, $user can be username or user_id. If force_str is true, the username will be forced.
//
function get_userdata($user, $force_str = false) {
    global $db;
    $user = (!is_numeric($user) || $force_str) ? phpbb_clean_username($user) : intval($user);
    $sql = "SELECT * FROM " . USERS_TABLE . " WHERE ";
    $sql .= ( ( is_integer($user) ) ? "user_id = $user" : "username = '" .  str_replace("\'", "''", $user) . "'" ) . " AND user_id <> " . ANONYMOUS;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Tried obtaining data for a non-existent user', '', __LINE__, __FILE__, $sql);
    }
    return ( $row = $db->sql_fetchrow($result) ) ? $row : false;
}

/**
 * FUNCTION set_user_xdata
 *
 * Sets a specefic custom profile field ($which_xdata) to the specefied
 * value ($value) for the user ($user).
 *
 * @param int|string $user        - user_id or username of the user we're editing
 * @param int|string $which_xdata - the profile field being changed
 * @param mixed $value            - value to assign
 * @global class $db
 * @return null
 */
function set_user_xdata($user, $which_xdata, $value) {
    global $db;

//    $value = trim(htmlspecialchars($value));
    $value = str_replace("\\'", "'", $value);
    $value = str_replace("'", "\\'", $value);
    $user_is_name = (!is_numeric($user)) ? true : false;
    $xd_is_name = (!is_numeric($which_xdata)) ? true : false;
    if ($user_is_name) {
        $user = phpbb_clean_username($user);
    }
    $user_where = ($user_is_name) ? ('u.username = \'' . $user . '\'') : ('u.user_id = ' . $user );
    $field_where = ($xd_is_name) ? ('xf.code_name = \'' . $which_xdata . '\'') : ('xf.field_id = ' . $which_xdata);
    $sql = "SELECT u.user_id, xf.field_id
            FROM (". USERS_TABLE . " AS u, " . XDATA_FIELDS_TABLE . " AS xf)
            WHERE " . $user_where . " AND " . $field_where . "
            LIMIT 1";
    if ( !($result = $db->sql_query($sql)) )  {
        message_die(GENERAL_ERROR, $lang['XData_error_obtaining_userdata'], '', __LINE__, __FILE__, $sql);
    }

    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $sql = "DELETE FROM " . XDATA_DATA_TABLE . "
            WHERE user_id = " . $row['user_id'] . " AND field_id = " . $row['field_id'] . "
            LIMIT 1";
    if ( !($db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, $lang['XData_failure_removing_data'], '', __LINE__, __FILE__, $sql);
    }
    if ($value !== '')  {
        $sql = "INSERT INTO " . XDATA_DATA_TABLE . "
                (user_id, field_id, xdata_value)
                VALUES (" . $row['user_id'] . ", " . $row['field_id'] . ", '" . $value . "')";
        if ( !($db->sql_query($sql)) ) {
               message_die(GENERAL_ERROR, $lang['XData_failure_inserting_data'], '', __LINE__, __FILE__, $sql);
        }
    }
}

/**
 * FUNCTION get_user_xdata
 *
 * retrieves the custom profile field data for the user ($user)
 * similar to get_userdata
 *
 * @param int|string $user
 * @param bool $force_str
 * @global class $db
 * @global array $lang
 * @return array $data
 */
function get_user_xdata($user, $force_str = false) {
    global $db;
    $is_name = ((intval($user) == 0) || $force_str);
    if(!isset($user) || empty($user)) {
        return '';
    }
    if ($is_name) {
        $user = phpbb_clean_username($user);
        $sql = "SELECT xf.field_type, xf.code_name, xd.xdata_value
                FROM (" . XDATA_DATA_TABLE . " xd, " . USERS_TABLE . " u, " . XDATA_FIELDS_TABLE . " xf)
                WHERE xf.field_id = xd.field_id AND xd.user_id = u.user_id AND u.username = '" . $user . "'";
    } else {
        $user = intval($user);
        $sql = "SELECT xf.field_type, xf.code_name, xd.xdata_value
                FROM (" . XDATA_DATA_TABLE . " xd, " . XDATA_FIELDS_TABLE . " xf)
                WHERE xf.field_id = xd.field_id AND xd.user_id = " . $user;
    }
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, $lang['XData_error_obtaining_user_xdata'], '', __LINE__, __FILE__, $sql);
    }
    $data = array();
    while ( $row = $db->sql_fetchrow($result) ) {
        $data[$row['code_name']] = ( $row['field_type'] != 'checkbox') ? $row['xdata_value'] : ( ( $row['xdata_value'] == 1 ) ? $lang['true'] : $lang['false']);
    }
    $db->sql_freeresult($result);
    return $data;
}

/**
 * FUNCTION get_xd_metadata
 *
 * get a list of xdata fields
 *
 * @param boolean $force_refresh    - if true then we reselect the data from the db.
 *                  - otherwise we use the data selected before
 * @static array $meta        - stores the previous selections
 * @return array $meta        - the data of the fields.
 */
function get_xd_metadata($force_refresh = false) {
    global $db;
    static $meta = false;

    if ( !is_array($meta) || $force_refresh ) {
        $sql = "SELECT
                field_id,
                field_name,
                field_desc,
                field_type,
                field_order,
                code_name,
                field_length,
                field_values,
                field_regexp,
                manditory,
                default_auth,
                display_viewprofile,
                display_register,
                display_posting,
                handle_input,
                allow_bbcode,
                allow_smilies,
                allow_html,
                viewtopic,
                signup
            FROM " . XDATA_FIELDS_TABLE . "
            ORDER BY field_order ASC";

        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_field_data'], '', __LINE__, __FILE__, $sql);
        }
        $data = array();
        while ( $row = $db->sql_fetchrow($result) ) {
            $data[$row['code_name']] = $row;
            if ($row['field_values'] != '') {
                $data[$row['code_name']]['values_array'] = array('toast');
                $values = array();
                preg_match_all("/(?<!\\\)'(.*?)(?<!\\\)'/", $row['field_values'], $values);
                $data[$row['code_name']]['values_array'] = array_map(create_function('$a', "return str_replace(\"\\\\'\", \"'\", \$a);"), $values[1]);
            } else {
                $data[$row['code_name']]['values_array'] = array();
            }
        }
        $meta = $data;
        $db->sql_freeresult($result);
    }
    return $meta;
}

function xdata_auth($fields, $userid, $meta = false) {
    global $db;

    if(!isset($userid) || empty($userid)) {
        return '';
    }
    if ($fields == false) {
        $field_sql_1 = ' ';
        $field_sql_2 = ' ';
    } elseif (is_array($fields)) {
        $field_sql_1 = 'WHERE xf.code_name IN(' . implode(', ', $fields) . ')';
        $field_sql_2 = 'AND xf.code_name IN(' . implode(', ', $fields) . ')';
    } else {
        $field_sql_1 = "WHERE xf.code_name = '$fields'";
        $field_sql_2 = "AND xf.code_name = '$fields'";
    }
    if ($meta == false) {
        $sql = "SELECT xf.default_auth AS default_auth, xf.code_name AS code_name FROM " . XDATA_FIELDS_TABLE . " xf
                $field_sql_1";
        if (!($result = $db->sql_query($sql))) {
            message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_field_data'], '', __LINE__, __FILE__, $sql);
        }
        $meta = array();
        while ($data = $db->sql_fetchrow($result)) {
            $meta[$data['code_name']]['default_auth'] = $data['default_auth'];
        }
        $db->sql_freeresult($result);
    }
    $sql = "SELECT xf.code_name, xa.auth_value, g.group_single_user
            FROM (" . XDATA_FIELDS_TABLE . " xf, " . XDATA_AUTH_TABLE . " xa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g)
            WHERE xf.field_id = xa.field_id
            AND xa.group_id = ug.group_id
            AND xa.group_id = g.group_id
            AND ug.user_id = $userid
            $field_sql_2
            ORDER BY g.group_single_user ASC";
    if (!($result = $db->sql_query($sql))) {
        message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_field_auth'], '', __LINE__, __FILE__, $sql);
    }
    $auth = array();
    foreach($meta as $key => $value) {
        $auth[$key] = $value['default_auth'];
    }
    while($data = $db->sql_fetchrow($result)) {
        $auth[$data['code_name']] = ( $data['auth_value'] == XD_AUTH_ALLOW);
    }
    $db->sql_freeresult($result);
    if (!is_array($fields)) {
        return $auth[$fields];
    }
    return $auth;
}

function make_jumpbox($action, $match_forum_id = 0) {
    return jumpbox($action, $match_forum_id);
}

//
// Include language files
// borrowed from Board-Message XL Mod
//
function language_include($category) {
    global $board_config, $lang;

    $dirname = NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'];
    $dir = @opendir($dirname);
    while($file = @readdir($dir)) {
        if( preg_match("#^lang_$category.*?\.php$#", $file) && @is_file($dirname . "/" . $file) && !@is_link($dirname . "/" . $file) ) {
            include(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] .'/' . $file);
        }
    }
    @closedir($dir);
    return;
}

//
// Initialise user settings on page load
function init_userprefs($userdata) {
    global $board_config, $theme, $images, $template, $currentlang, $phpbb_root_path, $nav_links;
    global $db, $mods, $list_yes_no, $userdata, $lang;

    //  get all the mods settings
    $dir = @opendir(NUKE_FORUMS_DIR . 'cat_mod/includes/mods_settings');
    while( $file = @readdir($dir) ) {
        if( preg_match("/^mod_.*?\.php$/", $file) ) {
            include_once(NUKE_FORUMS_DIR . 'cat_mod/includes/mods_settings/' . $file);
        }
    }
    @closedir($dir);
    //  get all the mods settings
    $dir = @opendir(NUKE_FORUMS_DIR . 'post_icon_mod/includes/mods_settings');
    while( $file = @readdir($dir) ) {
        if( preg_match("/^mod_.*?\.php$/", $file) ) {
            include_once(NUKE_FORUMS_DIR . 'post_icon_mod/includes/mods_settings/' . $file);
        }
    }
    @closedir($dir);
    // We are going to set users language preferences
    if ( is_user() ) {
        if ( !empty($userdata['user_lang']) && ( $userdata['user_lang'] == $currentlang ) ) {
            $default_lang = $userdata['user_lang'];
        } else {
            $default_lang = $currentlang;
        }
        if ( !empty($userdata['user_dateformat']) ) {
            $board_config['default_dateformat'] = $userdata['user_dateformat'];
        }
        if ( isset($userdata['user_timezone']) )  {
            $board_config['board_timezone'] = $userdata['user_timezone'];
        }
    } else {
        if ( $board_config['default_lang'] == $currentlang ) {
            $default_lang = $board_config['default_lang'];
        } else {
            $default_lang = $currentlang;
        }
    }
    // So let`s see, if our language exists
    if ( !@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $default_lang . '/lang_main.php') ) {
        // Try english
        // This is a long shot since it means serious errors in the setup to reach here,
        // but english is part of a new install so it's worth us trying
        $default_lang = 'english';
        if ( !@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $default_lang . '/lang_main.php') ) {
            message_die(CRITICAL_ERROR, 'Could not locate valid language pack');
        }
    }
    // We do not write back changed data into database, because at this moment we don`t know if we are admin
    // next is, that we don`t write anywhere a temporary language
    $board_config['default_lang'] = $default_lang;
    language_include('main');

    /*--FNA #1--*/

    if ( defined('FORUM_ADMIN') ) {
        if( !@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.php') ) {
            $board_config['default_lang'] = 'english';
        }
        language_include('admin');
    }
    include_attach_lang();
    language_include('extend');
    //
    // Set up style
    //
    global $tree;
    if (empty($tree['auth'])) {
        get_user_tree($userdata);
    }
    if ( !$board_config['override_user_style'] ) {
        if ( is_user() && $userdata['user_style'] > 0 ) {
            if ( $theme = setup_style($userdata['user_style']) ) {
                return;
            }
        }
    }
    $theme = setup_style($board_config['default_style']);
    //
    // Mozilla navigation bar
    // Default items that should be valid on all pages.
    // Defined here to correctly assign the Language Variables
    // and be able to change the variables within code.
    //
    $nav_links['top'] = array (
        'url' => append_sid('index.php'),
        'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
    );
    $nav_links['search'] = array (
        'url' => append_sid('search.php'),
        'title' => $lang['Search']
    );
    $nav_links['help'] = array (
        'url' => append_sid('faq.php'),
        'title' => $lang['FAQ']
    );
    $nav_links['author'] = array (
        'url' => append_sid('memberlist.php'),
        'title' => $lang['Memberlist']
    );
    return;
}

function setup_style($style) {
    global $db, $board_config, $template, $images, $phpbb_root_path, $name, $user, $cookie;

    if($name == 'Forums'){
        $default_style = $board_config['default_style'];
        if(empty($cookie[1]) AND $style != $default_style) {
            $style = $default_style;
        }
    }
    $sql = "SELECT * FROM " . THEMES_TABLE . " WHERE themes_id = ". (int) $style;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(CRITICAL_ERROR, 'Could not query database for theme info');
    }
    if ( !($row = $db->sql_fetchrow($result)) ) {
        // We are trying to setup a style which does not exist in the database
        // Try to fallback to the board default (if the user had a custom style)
        // and then any users using this style to the default if it succeeds
        if ( $style != $board_config['default_style']) {
            $sql = 'SELECT *
                    FROM ' . THEMES_TABLE . '
                    WHERE themes_id = ' . (int) $board_config['default_style'];
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(CRITICAL_ERROR, 'Could not query database for theme info');
            }
            if ( $row = $db->sql_fetchrow($result) ) {
                $db->sql_freeresult($result);
                $sql = 'UPDATE ' . USERS_TABLE . '
                        SET user_style = ' . (int) $board_config['default_style'] . "
                        WHERE user_style = $style";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(CRITICAL_ERROR, 'Could not update user theme info');
                }
            } else {
                message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
            }
        } else {
            message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
        }
    }
    $db->sql_freeresult($result);
    $ThemeSel = get_theme();
    if (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/forums/index_body.tpl')) {
        $template_name = 'forums';
        $template_path = NUKE_THEMES_DIR . $ThemeSel . '/forums/';
    } elseif (@file_exists(NUKE_THEMES_DIR . $row['template_name'].'/forums/index_body.tpl')) {
        $template_name = $row['template_name'] ;
        $template_path = NUKE_THEMES_DIR . $row['template_name'] . '/forums/';
    } elseif (@file_exists(NUKE_THEMES_DIR . 'chromo/forums/index_body.tpl')) {
        $template_name = 'forums';
        $template_path = NUKE_THEMES_DIR . 'chromo/forums/';
    } else {
        message_die(CRITICAL_ERROR, "Could not open any pbpBB Template directory", '', __LINE__, __FILE__);
    }
    $template = new Template($template_path, $board_config, $db);

    if ( $template ) {
        if (@file_exists($template_path . $template_name . '.cfg') ) {
            include($template_path . $template_name . '.cfg');
        }
        if ( !defined('TEMPLATE_CONFIG') ) {
            message_die(CRITICAL_ERROR, "Could not open $template_name template config file", '', __LINE__, __FILE__);
        }
        if ( @is_dir($template_path . 'images/lang_' . $currentlang ) ) {
            $img_lang = $currentlang;
        } elseif ( @is_dir($template_path . 'images/lang_' . $board_config['default_lang'] ) ) {
            $img_lang = $board_config['default_lang'];
        } elseif ( @is_dir($template_path . 'images/lang_english' ) ) {
            $img_lang = 'english';
        } else {
            message_die(CRITICAL_ERROR, "Could not open any image directory", '', __LINE__, __FILE__);
        }
        while( list($key, $value) = @each($images) ) {
           if ( !is_array($value) ) {
               $images[$key] = str_replace('{LANG}', 'lang_' . $img_lang, $value);
           }
        }
    }
    return $row;
}

function encode_ip($dotquad_ip) {
    $ip_sep = explode('.', $dotquad_ip);
    return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
}

function decode_ip($int_ip) {
    $hexipbang = explode('.', chunk_split($int_ip, 2, '.'));
    return hexdec($hexipbang[0]). '.' . hexdec($hexipbang[1]) . '.' . hexdec($hexipbang[2]) . '.' . hexdec($hexipbang[3]);
}

//
// Create date/time from format and timezone
//
function create_date($format, $gmepoch, $tz) {
    global $board_config, $lang, $userdata, $pc_dateTime;
    static $translate;

    if ( empty($translate) && $board_config['default_lang'] != 'english' ) {
        @reset($lang['datetime']);
        while ( list($match, $replace) = @each($lang['datetime']) ) {
            $translate[$match] = $replace;
        }
    }

    if ( is_user() ) {
        switch ( $userdata['user_time_mode'] ) {
            case MANUAL_DST:
                $dst_sec = $userdata['user_dst_time_lag'] * 60;
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
                break;
            case SERVER_SWITCH:
                if (!empty($gmepoch) && is_long($gmepoch)) {
                    $dst_sec = date('I', $gmepoch) * $userdata['user_dst_time_lag'] * 60;
                } else {
                    $dst_sec = date('I') * $userdata['user_dst_time_lag'] * 60;
                }
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
                break;
            case FULL_SERVER:
                return ( !empty($translate) ) ? strtr(@date($format, $gmepoch), $translate) : @date($format, $gmepoch);
                break;
            case SERVER_PC:
                if ( isset($pc_dateTime['pc_timezoneOffset']) ) {
                    $tzo_sec = $pc_dateTime['pc_timezoneOffset'];
                } else {
                    $user_pc_timeOffsets = explode("/", $userdata['user_pc_timeOffsets']);
                    $tzo_sec = $user_pc_timeOffsets[0];
                }
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
                break;
            case FULL_PC:
                if ( isset($pc_dateTime['pc_timeOffset']) ) {
                    $tzo_sec = $pc_dateTime['pc_timeOffset'];
                } else {
                    $user_pc_timeOffsets = explode("/", $userdata['user_pc_timeOffsets']);
                    $tzo_sec = (isset($user_pc_timeOffsets[1])) ? $user_pc_timeOffsets[1] : '';
                }
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
                break;
            default:
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
                break;
        }
    } else {
        switch ( $board_config['default_time_mode'] ) {
            case MANUAL_DST:
                $dst_sec = $board_config['default_dst_time_lag'] * 60;
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
                break;
            case SERVER_SWITCH:
                $dst_sec = date('I', $gmepoch) * $board_config['default_dst_time_lag'] * 60;
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
                break;
            case FULL_SERVER:
                return ( !empty($translate) ) ? strtr(@date($format, $gmepoch), $translate) : @date($format, $gmepoch);
                break;
            case SERVER_PC:
                if ( isset($pc_dateTime['pc_timezoneOffset']) ) {
                    $tzo_sec = $pc_dateTime['pc_timezoneOffset'];
                } else {
                    $tzo_sec = 0;
                }
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
                break;
            case FULL_PC:
                if ( isset($pc_dateTime['pc_timeOffset']) ) {
                    $tzo_sec = $pc_dateTime['pc_timeOffset'];
                } else {
                    $tzo_sec = 0;
                }
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
                break;
            default:
                return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
                break;
        }
    }
}

//
// Pagination routine, generates
// page number sequence
//
function generate_pagination($base_url, $num_items, $per_page, $start_item, $add_prevnext_text = TRUE) {
    global $lang;

    function append_page_sid($pagetogo) {
        if (defined('FORUM_ADMIN')) {
            $pagetogo = admin_sid($pagetogo);
            return $pagetogo;
        } else {
            $pagetogo = append_sid($pagetogo);
            return $pagetogo;
        }
    }
    $total_pages = ceil($num_items/$per_page);
    if ( $total_pages == 1 ) {
        return '';
    }
    $on_page = floor($start_item / $per_page) + 1;
    $page_string = '';
    if ( $total_pages > 10 ) {
        $init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;
        for($i = 1; $i < $init_page_max + 1; $i++) {
            $page_string .= ( $i == $on_page ) ? $i : '<a href="' . append_page_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
            if ( $i <  $init_page_max ) {
                $page_string .= ", ";
            }
        }
        if ( $total_pages > 3 ) {
            if ( $on_page > 1  && $on_page < $total_pages ) {
                $page_string .= ( $on_page > 5 ) ? ' ... ' : ', ';
                $init_page_min = ( $on_page > 4 ) ? $on_page : 5;
                $init_page_max = ( $on_page < $total_pages - 4 ) ? $on_page : $total_pages - 4;
                for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++) {
                    $page_string .= ($i == $on_page) ? $i : '<a href="' . append_page_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
                    if ( $i <  $init_page_max + 1 ) {
                        $page_string .= ', ';
                    }
                }
                $page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
            } else {
                $page_string .= ' ... ';
            }
            for($i = $total_pages - 2; $i < $total_pages + 1; $i++) {
                $page_string .= ( $i == $on_page ) ?  $i : '<a href="' . append_page_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
                if( $i <  $total_pages ) {
                    $page_string .= ", ";
                }
            }
        }
    } else {
        for($i = 1; $i < $total_pages + 1; $i++) {
            $page_string .= ( $i == $on_page ) ? $i : '<a href="' . append_page_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
            if ( $i <  $total_pages ) {
                $page_string .= ', ';
            }
        }
    }
    if ( $add_prevnext_text ) {
        if ( $on_page > 1 ) {
            $page_string = ' <a href="' . append_page_sid($base_url . "&amp;start=" . ( ( $on_page - 2 ) * $per_page ) ) . '">' . $lang['Previous'] . '</a>&nbsp;&nbsp;' . $page_string;
        }
        if ( $on_page < $total_pages ) {
            $page_string .= '&nbsp;&nbsp;<a href="' . append_page_sid($base_url . "&amp;start=" . ( $on_page * $per_page ) ) . '">' . $lang['Next'] . '</a>';
        }
    }
    if ( $total_pages > 5 ) {
        $select_page = ' <select name="generate_pagination" onchange="if(this.options[this.selectedIndex].value != -1){ window.location = this.options[this.selectedIndex].value; }">';
        for($i = 1; $i <= $total_pages; $i++) {
            $selected = ( $i == $on_page ) ? ' selected="selected"' : ''; // highlight current page by default
            $select_page .= '<option value="' . append_page_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) )  . '"' . $selected . '>' . $i . '</option>';
        }
        $select_page .= '</select>:';
    } else {
        $select_page = '';
    }
    $page_string = $lang['Goto_page'] . $select_page . ' ' . $page_string;
    return $page_string;
}

//
// This does exactly what preg_quote() does in PHP 4-ish
// If you just need the 1-parameter preg_quote call, then don't bother using this.
//
function phpbb_preg_quote($str, $delimiter) {
    $text = preg_quote($str);
    $text = str_replace($delimiter, '\\' . $delimiter, $text);
    return $text;
}

//
// Obtain list of naughty words and build preg style replacement arrays for use by the
// calling script, note that the vars are passed as references this just makes it easier
// to return both sets of arrays
//
function obtain_word_list(&$orig_word, &$replacement_word) {
    global $db;
    global $global_orig_word, $global_replacement_word;

    if (isset($global_orig_word)) {
        $orig_word      = $global_orig_word;
        $replacement_word = $global_replacement_word;
    } else {
        if ( defined('CACHE_WORDS') ) {
            @include(NUKE_BASE_DIR . NUKE_FORUMS_DIR . 'cat_mod/includes/def_words.php');
            if ( !isset($word_replacement) ) {
                cache_words();
                @include(NUKE_BASE_DIR . NUKE_FORUMS_DIR . 'cat_mod/includes/def_words.php');
            }
        }
        if ( isset($word_replacement) ) {
            $orig_word = array();
            $replacement_word = array();
            @reset($word_replacement);
            while ( list($word, $replacement) = @each($word_replacement) ) {
                $orig_word[] = '#\b(' . str_replace('\*', '\w*?', nuke_bbpreg_quote(stripslashes($word), '#')) . ')\b#i';
                $replacement_word[] = $replacement;
            }
        } else {
            //
            // Define censored word matches
            //
            $sql = "SELECT word, replacement
                    FROM  " . WORDS_TABLE;
            if( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get censored words from database', '', __LINE__, __FILE__, $sql);
            }
            if ( $row = $db->sql_fetchrow($result) ) {
                do {
                    $orig_word[] = '#\b(' . str_replace('\*', '\w*?', preg_quote($row['word'], '#')) . ')\b#i';
                    $replacement_word[] = $row['replacement'];
                } while ( $row = $db->sql_fetchrow($result) );
            }
            $db->sql_freeresult($result);
        }
        $global_orig_word     = $orig_word;
        $global_replacement_word  = $replacement_word;
    }
    return true;
}

//
// This is general replacement for die(), allows templated
// output in users (or default) language, etc.
//
// $msg_code can be one of these constants:
//
// GENERAL_MESSAGE : Use for any simple text message, eg. results
// of an operation, authorisation failures, etc.
//
// GENERAL ERROR : Use for any error which occurs _AFTER_ the
// common.php include and session code, ie. most errors in
// pages/functions
//
// CRITICAL_MESSAGE : Used when basic config data is available but
// a session may not exist, eg. banned users
//
// CRITICAL_ERROR : Used when config data cannot be obtained, eg
// no database connection. Should _not_ be used in 99.5% of cases
//
function message_die($msg_code, $msg_text = '', $msg_title = '', $err_line = '', $err_file = '', $sql = '', $meta = '') {
    global $db, $template, $board_config, $theme, $lang, $phpbb_root_path, $nav_links, $gen_simple_header, $images, $userdata, $user_ip, $session_length, $starttime, $page_meta, $header_meta, $pagetitle, $gen_simple_footer;
    global $tree;
    static $has_died;
    if (empty($pagetitle)) {
        $pagetitle = _MESSAGE_DIE_TITLE;
    }
    if($has_died == 1 && !$board_config['board_disable']) {
        die("message_die() was called multiple times. This isn't supposed to happen. Was message_die() used in page_tail.php?");
    }
    $has_died = 1;
    $sql_store = $sql;
    //
    // Get SQL error if we are debugging. Do this as soon as possible to prevent
    // subsequent queries from overwriting the status of sql_error()
    //
    if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) ) {
        $sql_error = $db->sql_error();
        $debug_text = '';
        if ( !empty($sql_error['message']) ) {
            $debug_text .= '<br /><br />SQL Error : ' . $sql_error['code'] . ' ' . $sql_error['message'];
        }
        if ( !empty($sql_store) ) {
            $debug_text .= "<br /><br />$sql_store";
        }
        if ( !empty($err_line) && !empty($err_file) ) {
            $debug_text .= '<br /><br />Line : ' . $err_line . '<br />File : ' . basename($err_file);
        }
    }
    if( empty($userdata) && ( $msg_code == GENERAL_MESSAGE || $msg_code == GENERAL_ERROR ) ) {
        $userdata = session_pagestart($user_ip, PAGE_INDEX);
        init_userprefs($userdata);
    }
    //
    // If the header hasn't been output then do it
    //
    if (  $msg_code != CRITICAL_ERROR ) {
        if ( empty($lang) ) {
            if ( !empty($board_config['default_lang']) ) {
                language_include('main');
                /*--FNA #2--*/
            } else {
                include(NUKE_FORUMS_DIR . 'language/lang_english/lang_main.php');
                /*--FNA #3--*/
            }
        }
        // We don't need any longer to include lang_extend_mac.php - those lines could be done here
        $dirname = NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'];
        $dir = @opendir($dirname);
        while($file = @readdir($dir)) {
            if( preg_match("/^lang_extend_.*?\.php$/", $file) && is_file($dirname . "/" . $file) && !is_link($dirname . "/" . $file) ) {
                @include($dirname .'/'. $file);
            }
        }
        @closedir($dir);
        if ( empty($theme) ) {
            $theme = setup_style($board_config['default_style']);
        }
        //
        // Load the Page Header
        //
        if ( !defined('FORUM_ADMIN') ) {
            if (!empty($meta)) {
                $header_meta = $meta;
            }
            $gen_simple_header = TRUE;
            include_once(NUKE_INCLUDE_DIR . 'page_header.php');
        } else {
            include_once(NUKE_FORUMS_DIR . 'admin/page_header_admin.php');
        }
    }

    switch($msg_code) {
        case GENERAL_MESSAGE:
            if ( empty($msg_title) ) {
                $msg_title = $lang['Information'];
            }
            break;
        case CRITICAL_MESSAGE:
            if ( empty($msg_title) ) {
                $msg_title = $lang['Critical_Information'];
            }
            break;
        case GENERAL_ERROR:
            if ( empty($msg_text) ) {
                $msg_text = $lang['An_error_occured'];
            }
            if ( empty($msg_title) ) {
                $msg_title = $lang['General_Error'];
            }
            break;
        case CRITICAL_ERROR:
            //
            // Critical errors mean we cannot rely on _ANY_ DB information being
            // available so we're going to dump out a simple echo'd statement
            //
            if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $lang . 'lang_main.php')) {
                  include(NUKE_FORUMS_DIR . 'language/lang_' . $lang . 'lang_main.php');
            } else {
                  include(NUKE_FORUMS_DIR . 'language/lang_english/lang_main.php');
            }
            if ( empty($msg_text) ) {
                $msg_text = $lang['A_critical_error'];
            }
            if ( empty($msg_title) ) {
                $msg_title = 'phpBB : <strong>' . $lang['Critical_Error'] . '</strong>';
            }
            break;
    }
    //
    // Add on DEBUG info if we've enabled debug mode and this is an error. This
    // prevents debug info being output for general messages should DEBUG be
    // set TRUE by accident (preventing confusion for the end user!)
    //
    if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) ) {
        if ( !empty($debug_text) ) {
            $msg_text = $msg_text . '<br /><br /><strong><u>DEBUG MODE</u></strong>' . $debug_text;
        }
    }
    if ( $msg_code != CRITICAL_ERROR ) {
        if ( !empty($lang[$msg_text]) ) {
            $msg_text = $lang[$msg_text];
        }
        if ( !defined('FORUM_ADMIN') ) {
            $template->set_filenames(array(
                'message_body' => 'message_body.tpl')
            );
        } else {
            $template->set_filenames(array(
                'message_body' => 'admin/admin_message_body.tpl')
            );
        }
        $template->assign_vars(array(
            'MESSAGE_TITLE' => $msg_title,
            'MESSAGE_TEXT'  => $msg_text)
        );
        $template->pparse('message_body');
        if ( !defined('FORUM_ADMIN') ) {
            $gen_simple_footer = FALSE;
            include_once(NUKE_INCLUDE_DIR . 'page_tail.php');
        } else {
            $gen_simple_footer = FALSE;
            include_once(NUKE_FORUMS_DIR . 'admin/page_footer_admin.php');
        }
    } else {
        echo "<html>\n<body>\n" . $msg_title . "\n<br /><br />\n" . $msg_text . "</body>\n</html>";
    }
    die();
}

//
// This function is for compatibility with PHP 4.x's realpath()
// function.  In later versions of PHP, it needs to be called
// to do checks with some functions.  Older versions of PHP don't
// seem to need this, so we'll just return the original value.
// dougk_ff7 <October 5, 2002>
function phpbb_realpath($path) {
    global $phpbb_root_path;
    return (!@function_exists('realpath') || !@realpath($phpbb_root_path . 'includes/functions.php')) ? $path : @realpath($path);
}

// modded by Quake for NOT using $nukeuser
function bblogin($session_id) {
        global $userdata, $user_ip, $session_length, $session_id, $db, $nuke_file_path, $cookie;
        define('IN_LOGIN', true);
        $nuid = $cookie[0];
        $sql = "SELECT s.*
                FROM " . SESSIONS_TABLE . " s
                WHERE s.session_id = '$session_id'
                AND s.session_ip = '$user_ip'";
        if ( !($result = $db->sql_query($sql)) ) {
                message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch : session_pagestar');
        }
        $logindata = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        if( $nuid != $logindata['session_user_id'] ) {
            $nusername = $cookie[1];
            $sql = "SELECT user_id, username, user_password, user_active, user_level
                    FROM ".USERS_TABLE."
                    WHERE username = '" . str_replace("\'", "''", $nusername) . "'";
            $result = $db->sql_query($sql);
            if(!$result) {
                message_die(GENERAL_ERROR, "Error in obtaining userdata : login", "", __LINE__, __FILE__, $sql);
            }
            $rowresult = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);
            $password = $cookie[2];
            if(count($rowresult) ) {
                if( $rowresult['user_level'] != ADMIN && $board_config['board_disable'] ) {
                    redirect(append_sid('index.php', true));
                } else {
                    if( $password == $rowresult['user_password'] && $rowresult['user_active'] ) {
                        $autologin = 0;
                        $userdata = session_begin($rowresult['user_id'], $user_ip);
                        $session_id = $userdata['session_id'];
                        if(!$session_id ) {
                            message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);
                        } else {
                        }
                    } else {
                        $message = $lang['Error_login'] . "<br /><br />" . sprintf($lang['Click_return_login'], "<a href=\"" . append_sid("login.php?$redirect") . "\">", "</a> ") . "<br /><br />" .  sprintf($lang['Click_return_index'], "<a href=\"" . append_sid("index.php") . "\">", "</a> ");
                        message_die(GENERAL_MESSAGE, $message);
                    }
                }
            } else {
                $message = $lang['Error_login'] . "<br /><br />" . sprintf($lang['Click_return_login'], "<a href=\"" . append_sid("login.php?$redirect") . "\">", "</a> ") . "<br /><br />" .  sprintf($lang['Click_return_index'], "<a href=\"" . append_sid("index.php") . "\">", "</a> ");
                message_die(GENERAL_MESSAGE, $message);
            }
        }
}

function show_glance($where) {
    global $userdata, $board_config;

    $mode = ($board_config['glance_show_override']) ? $board_config['glance_show'] : $userdata['user_glance_show'];
    if(intval($mode) == 0) {
        return false;
    }
    $where_array['categorie'] = array(GLANCE_CATEGORIE, GLANCE_INDEX_AND_CATEGORIE, GLANCE_INDEX_AND_CATEGORIE_AND_FORUM, GLANCE_ALL);
    $where_array['index']     = array(GLANCE_INDEX, GLANCE_INDEX_AND_FORUMS, GLANCE_INDEX_AND_TOPICS, GLANCE_INDEX_AND_CATEGORIE, GLANCE_INDEX_AND_CATEGORIE_AND_FORUM,GLANCE_ALL);
    $where_array['forums']    = array(GLANCE_FORUMS, GLANCE_INDEX_AND_FORUMS, GLANCE_FORUMS_AND_TOPICS, GLANCE_INDEX_AND_CATEGORIE_AND_FORUM, GLANCE_ALL);
    $where_array['topics']    = array(GLANCE_TOPICS, GLANCE_INDEX_AND_TOPICS, GLANCE_FORUMS_AND_TOPICS, GLANCE_ALL);
    if (in_array($mode, $where_array[$where])) {
        return true;
    }
    return false;
}

function allow_log_view($user_level) {
    global $board_config, $userdata;
    if ($board_config['logs_view_level'] == ADMIN && $user_level == ADMIN) {
        return true;
        exit;
    } elseif ($board_config['logs_view_level'] == MOD && ($user_level == MOD || $user_level == ADMIN)) {
        return true;
        exit;
    } elseif ($board_config['logs_view_level'] == USER && is_user() ) {
        return true;
        exit;
    } elseif ($board_config['logs_view_level'] == "0") {
        return true;
        exit;
    } else {
        return false;
        exit;
    }
    return false;
}

function show_log($type){
    global $board_config;

    switch($type) {
        case 'lock':
            $show = ($board_config['show_locked_logs']) ? true : false;
            break;
        case 'edit':
            $show = ($board_config['show_edited_logs']) ? true : false;
            break;
        case 'move':
            $show = ($board_config['show_moved_logs']) ? true : false;
            break;
        case 'split':
            $show = ($board_config['show_splitted_logs']) ? true : false;
            break;
        case 'unlock':
            $show = ($board_config['show_unlocked_logs']) ? true : false;
            break;
    }
    return $show;
}

function resize_avatar($avatar_url) {
    //moved to functions_evo.php
    return avatar_resize($avatar_url);
}

?>