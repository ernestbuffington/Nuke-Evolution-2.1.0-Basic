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

if (!defined('ADMIN_FILE') && !defined('IN_SETTINGS')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$settingspoint = substr(@basename(__FILE__,'.php'), 11);

global $admin_file, $_GETVAR, $lang_admin, $adminsetmenu;

if (is_god_admin() || is_admin('super')) {
    getsettings_lang($settingspoint);
    if ($adminsetmenu == 1) {
        $menupoint[$settingspoint]['menutitle'] = (isset($lang_admin[$settingspoint]['MENU_TITLE']) ? $lang_admin[$settingspoint]['MENU_TITLE'] : $settingspoint);
        $menupoint[$settingspoint]['menuurl']   = $settingspoint;
        $menupoint[$settingspoint]['menuimage'] = 'adm_coo.png';
        return;
    }

    $fieldset = array(
            'text_cookieexplain' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO'],
                'input_type'        => 'info',
                'check_type'        => '',
                'check_special'     => '',
                'input_name'        => '',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => '',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => ''),
            'cookie_domain' => array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'cookie_domain',
                'input_size'        => 30,
                'input_maxlength'   => 50,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'cookie_domain',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN_HELP'],
                'input_additional'  => '',
                'db_table'          => 'CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'cookie_path' => array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COOKIE_PATH'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'cookie_path',
                'input_size'        => 30,
                'input_maxlength'   => 50,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'cookie_path',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COOKIE_PATH_HELP'],
                'input_additional'  => '',
                'db_table'          => 'CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'cookie_name' => array(
                'input_order'       => 4,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COOKIE_NAME'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'cookie_name',
                'input_size'        => 30,
                'input_maxlength'   => 50,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'cookie_name',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COOKIE_NAME_HELP'],
                'input_additional'  => '',
                'db_table'          => 'CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'cookie_secure' => array(
                'input_order'       => 5,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COOKIE_SECURE'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'cookie_secure',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'cookie_secure',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COOKIE_SECURE_HELP'],
                'input_additional'  => '',
                'db_table'          => 'CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'session_length' => array(
                'input_order'       => 6,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH'],
                'input_type'        => 'text',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'session_length',
                'input_size'        => 5,
                'input_maxlength'   => 6,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'session_length',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH_HELP'],
                'input_additional'  => '',
                'db_table'          => 'CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'text_cookieuser' => array(
                'input_order'       => 7,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO_USER'],
                'input_type'        => 'info',
                'check_type'        => '',
                'check_special'     => '',
                'input_name'        => '',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => '',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => ''),
            'cookiecheck' => array(
                'input_order'       => 8,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COOKIE_CHECK'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'cookiecheck',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'cookiecheck',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COOKIE_CHECK_HELP'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'cookiecleaner' => array(
                'input_order'       => 9,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'cookiecleaner',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'cookiecleaner',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER_HELP'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
    );
    $i = 1;
    $k = 60;
    $j = 3;
    $inactivity[0] = array(
        'input_text'  => '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_INDEFINITE'],
        'input_value' => '-',
    );
    $inactivity[1] = array(
        'input_text'  => '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_AUTOMATIC'],
        'input_value' => 0,
    );
    $inactivity[2] = array(
        'input_text'  => '30&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_SECONDS'],
        'input_value' => 30,
    );
    $inactivity[3] = array(
        'input_text'  => '1&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_MINUTE'],
        'input_value' => 60,
    );
    while ($i < 5) {
        $i++;
        $j++;
        $s = $i * $k;
        $inactivity[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_MINUTES'],
            'input_value' => $s,
        );
    }
    $i = 0;
    while ($i < 45) {
        $i = $i + 15;
        $j++;
        $s = $i * $k;
        $inactivity[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_MINUTES'],
            'input_value' => $s,
        );
    }
    $j++;
    $inactivity[$j] = array(
        'input_text'  => '1&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_HOUR'],
        'input_value' => 3600,
    );
    $fieldset ['cookieinactivity'] = array(
                'input_order'       => 10,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY'],
                'input_type'        => 'option',
                'input_option'       => $inactivity,
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'cookieinactivity',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'cookieinactivity',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY_HELP'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name');
    $i = 1;
    $k = 60;
    $j = 3;
    $lifetime[0] = array(
        'input_text'  => '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_LOGOUT'],
        'input_value' => '-',
    );
    $lifetime[1] = array(
        'input_text'  => '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_BLOCK'],
        'input_value' => 0,
    );
    $lifetime[2] = array(
        'input_text'  => '30&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_SECONDS'],
        'input_value' => 30,
    );
    $lifetime[3] = array(
        'input_text'  => '1&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_MINUTE'],
        'input_value' => 60,
    );
    while ($i < 5) {
        $i++;
        $j++;
        $s = $i * $k;
        $lifetime[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_MINUTES'],
            'input_value' => $s,
        );
    }
    $i = 0;
    while ($i < 45) {
        $i = $i + 15;
        $j++;
        $s = $i * $k;
        $lifetime[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_MINUTES'],
            'input_value' => $s,
        );
    }
    $j++;
    $lifetime[$j] = array(
        'input_text'  => '1&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_HOUR'],
        'input_value' => 3600,
    );
    $i = 1;
    $k = 3600;
    while ($i < 4) {
        $i++;
        $j++;
        $s = $i * $k;
        $lifetime[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_HOURS'],
            'input_value' => $s,
        );
    }
    $i = 0;
    while ($i < 20) {
        $i = $i + 5;
        $j++;
        $s = $i * $k;
        $lifetime[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_HOURS'],
            'input_value' => $s,
        );
    }
    $j++;
    $lifetime[$j] = array(
        'input_text'  => '1&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_DAY'],
        'input_value' => 86400,
    );
    $i = 1;
    $k = 86400;
    while ($i < 6) {
        $i++;
        $j++;
        $s = $i * $k;
        $lifetime[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_DAYS'],
            'input_value' => $s,
        );
    }
    $j++;
    $lifetime[$j] = array(
        'input_text'  => '1&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_WEEK'],
        'input_value' => 604800,
    );
    $i = 1;
    $k = 604800;
    while ($i < 3) {
        $i++;
        $j++;
        $s = $i * $k;
        $lifetime[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_WEEKS'],
            'input_value' => $s,
        );
    }
    $j++;
    $lifetime[$j] = array(
        'input_text'  => '1&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_MONTH'],
        'input_value' => 2592000,
    );
    $i = 1;
    $k = 2592000;
    while ($i < 12) {
        $i++;
        $j++;
        $s = $i * $k;
        $lifetime[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_COOKIE_MONTHS'],
            'input_value' => $s,
        );
    }
    $fieldset ['cookietimelife'] = array(
                'input_order'       => 11,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME'],
                'input_type'        => 'option',
                'input_option'       => $lifetime,
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'cookietimelife',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'cookietimelife',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME_HELP'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name');

    $settings_todo = ($_GETVAR->get('op', '_REQUEST', 'string') ? $_GETVAR->get('op', '_REQUEST', 'string') : 'show');

    switch ($settings_todo) {
        case 'show':
            admin_settingsshow($settingspoint, $fieldset);
            break;
        case 'save':
            admin_settingssave($settingspoint, $fieldset);
            break;
    }
}

?>