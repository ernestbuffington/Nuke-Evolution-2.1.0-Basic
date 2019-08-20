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
        $menupoint[$settingspoint]['menuimage'] = 'adm_gen.png';
        return;
    }

    $fieldset = array(
            'sitename' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SITENAME'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'sitename',
                'input_size'        => 40,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'sitename',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_SITENAME_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'sitename'),
            'siteurl' => array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SITEURL'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'nukeurl',
                'input_size'        => 40,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'nukeurl',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_SITEURL_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'nukeurl'),
            'sitelogo' => array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SITELOGO'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'site_logo',
                'input_size'        => 40,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'site_logo',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_SITELOGO_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'site_logo'),
            'siteslogan' => array(
                'input_order'       => 4,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SITESLOGAN'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'slogan',
                'input_size'        => 50,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'slogan',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_SITESLOGAN_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'slogan'),
            'startdate_timestamp' => array(
                'input_order'       => 5,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_STARTDATE'],
                'input_type'        => 'date',
                'check_type'        => 'date',
                'check_special'     => 'admin_general_startdate_save',
                'input_name'        => 'startdate_timestamp',
                'input_size'        => 20,
                'input_maxlength'   => 50,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'startdate_timestamp',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_STARTDATE_HELP'],
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => 'startdate'),
            'adminmail' => array(
                'input_order'       => 6,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ADMINMAIL'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'adminmail',
                'input_size'        => 30,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'adminmail',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ADMINMAIL_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'adminmail'),
            'top' => array(
                'input_order'       => 7,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ITEMSTOP'],
                'input_type'        => 'text',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'top',
                'input_size'        => 1,
                'input_maxlength'   => 2,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'top',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ITEMSTOP_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'top'),
            'anonpost' => array(
                'input_order'       => 8,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ANONPOST'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'anonpost',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'anonpost',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ANONPOST_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'anonpost'),
            'locale' => array(
                'input_order'       => 9,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_LOCALEFORMAT'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'locale',
                'input_size'        => 20,
                'input_maxlength'   => 40,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'locale',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_LOCALEFORMAT_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'locale'),
    );

    function admin_general_startdate_save($values, $fieldset, $settingspoint) {
        global $db, $lang_admin, $_GETVAR;

        $field_day   = $_GETVAR->get($values['input_name'].'_day', '_POST', 'int');
        $field_month = $_GETVAR->get($values['input_name'].'_month', '_POST', 'int');
        $field_year  = $_GETVAR->get($values['input_name'].'_year', '_POST', 'int');
        $error = array();
        if (isset($field_day) && !empty($field_day) && isset($field_month) && !empty($field_month) && isset($field_year) && !empty($field_year)) {
            $timestamp = mktime(0,0,0,$field_month,$field_day,$field_year);
            $db->sql_uquery("UPDATE "._NUKE_CONFIG_TABLE." SET startdate = ".$timestamp);
            $db->sql_uquery("UPDATE ".CONFIG_TABLE." SET config_value = ".$timestamp." WHERE config_name = 'board_startdate'");
            $error['check_err'] = FALSE;
            $error['check_text'] = '';
            return $error;
        } else {
            $error['check_err'] = FALSE;
            $error['check_text'] = '';
            return $error;
        }
    }

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