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
        $menupoint[$settingspoint]['menuimage'] = 'adm_user.png';
        return;
    }

    $fieldset = array(
            'text_regoptions' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_HEADER_REGOPTIONS'],
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
            'allowuserreg' => array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ALLOWUSERREG'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'allowuserreg',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'allowuserreg',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERREG'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'requireadmin' => array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_REQUIREADMIN'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'requireadmin',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'requireadmin',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_REQUIREADMIN'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'allowuserdelete' => array(
                'input_order'       => 4,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ALLOWUSERDELETE'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'allowuserdelete',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'allowuserdelete',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERDELETE'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'doublecheckemail' => array(
                'input_order'       => 5,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_DOUBLECHECKEMAIL'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'doublecheckemail',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'doublecheckemail',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_DOUBLECHECKEMAIL'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'allowusertheme' => array(
                'input_order'       => 6,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ALLOWUSERTHEME'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'allowusertheme',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'allowusertheme',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERTHEME'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'text_emailoptions' => array(
                'input_order'       => 10,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_HEADER_EMAILOPTIONS'],
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
            'servermail' => array(
                'input_order'       => 11,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SERVERMAIL'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'servermail',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'servermail',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_SERVERMAIL'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'sendaddmail' => array(
                'input_order'       => 12,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SENDMAILADD'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'sendaddmail',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'sendaddmail',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_SENDMAILADD'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'senddeletemail' => array(
                'input_order'       => 13,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SENDMAILDELETE'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'senddeletemail',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'senddeletemail',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_SENDMAILDELETE'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'useactivate' => array(
                'input_order'       => 14,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_USEACTIVATE'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'useactivate',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'useactivate',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_USEACTIVATE'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'allowmailchange' => array(
                'input_order'       => 15,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ALLOWMAILCHANGE'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'allowmailchange',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'allowmailchange',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_ALLOWMAILCHANGE'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'emailvalidate' => array(
                'input_order'       => 16,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_EMAILVALIDATE'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'emailvalidate',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'emailvalidate',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_EMAILVALIDATE'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
            'text_suspendoptions' => array(
                'input_order'       => 20,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_HEADER_SUSPENDOPTIONS'],
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
            'autosuspendmain' => array(
                'input_order'       => 21,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_AUTOSUSPENDMAIN'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'autosuspendmain',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'autosuspendmain',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPENDMAIN'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name'),
    );
    $suspendtime[0] = array(
        'input_text'  => $lang_admin[$settingspoint]['OPTION_SUSPEND_DEACTIVATED'],
        'input_value' => 0,
     );
    $i = 1;
    $j = 1;
    $suspendtime[1] = array(
        'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_SUSPEND_WEEK'],
        'input_value' => 604800,
    );
    while ($i <= 52) {
        $i++;
        $j++;
        $k = $i * 604800;
        $suspendtime[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_SUSPEND_WEEKS'],
            'input_value' => $k,
        );
    }
    $fieldset ['autosuspend'] = array(
                'input_order'       => 22,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_AUTOSUSPEND'],
                'input_type'        => 'option',
                'input_option'       => $suspendtime,
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'autosuspend',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'autosuspend',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name');
    $suspendtemp[0] = array(
        'input_text'  => $lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DEACTIVATED'],
        'input_value' => 0,
     );
    $i = 1;
    $j = 1;
    $suspendtemp[1] = array(
        'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAY'],
        'input_value' => 86400,
    );
    while ($i <= 30) {
        $i++;
        $j++;
        $k = $i * 86400;
        $suspendtemp[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAYS'],
            'input_value' => $k,
        );
    }
    $fieldset ['expiring'] = array(
                'input_order'       => 23,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_AUTOSUSPEND_TEMP'],
                'input_type'        => 'option',
                'input_option'       => $suspendtemp,
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'expiring',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'expiring',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND_TEMP'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name');
    $fieldset ['text_limitoptions'] = array(
                'input_order'       => 30,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_HEADER_LIMITOPTIONS'],
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
                'db_fieldname'      => '');
    $i = 1;
    $k = 60;
    $j = 2;
    $inactivity[0] = array(
        'input_text'  => '&nbsp;'. $lang_admin[$settingspoint]['OPTION_SHOWONLINE_CHOICE'],
        'input_value' => '-',
    );
    $inactivity[1] = array(
        'input_text'  => '30&nbsp;'. $lang_admin[$settingspoint]['OPTION_SHOWONLINE_SECONDS'],
        'input_value' => 30,
    );
    $inactivity[2] = array(
        'input_text'  => '1&nbsp;'. $lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTE'],
        'input_value' => 60,
    );
    while ($i < 5) {
        $i++;
        $j++;
        $s = $i * $k;
        $inactivity[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTES'],
            'input_value' => $s,
        );
    }
    $i = 0;
    while ($i < 45) {
        $i = $i + 15;
        $j++;
        $s = $i * $k;
        $inactivity[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTES'],
            'input_value' => $s,
        );
    }
    $j++;
    $inactivity[$j] = array(
        'input_text'  => '1&nbsp;'. $lang_admin[$settingspoint]['OPTION_SHOWONLINE_HOUR'],
        'input_value' => 3600,
    );
    $fieldset ['showonlinetime'] = array(
                'input_order'       => 31,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SHOWONLINE'],
                'input_type'        => 'option',
                'input_option'       => $inactivity,
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'showonlinetime',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'showonlinetime',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_SHOWONLINE_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');
    $i = 0;
    $k = 100;
    $j = 0;
    while ($i < 100000) {
        $i = $i + $k;
        $perpage[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_USERS_PER_PAGE'],
            'input_value' => $i,
        );
        if ($i > 900) { $k = 1000; }
        if ($i > 9000) { $k = 10000; }
        $j++;
    }
    $fieldset ['perpage'] = array(
                'input_order'       => 32,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_USERS_PER_PAGE'],
                'input_type'        => 'option',
                'input_option'       => $perpage,
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'perpage',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'perpage',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_USERS_PER_PAGE'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name');
    $i = 2;
    $k = 1;
    $j = 0;
    while ($i < 30) {
        $i = $i + $k;
        $nickmin[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_NICK_MIN'],
            'input_value' => $i,
        );
        $j++;
    }
    $fieldset ['nick_min'] = array(
                'input_order'       => 33,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_NICK_MIN'],
                'input_type'        => 'option',
                'input_option'       => $nickmin,
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'nick_min',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'nick_min',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_NICK_MIN'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name');
    $i = 3;
    $k = 1;
    $j = 0;
    while ($i < 30) {
        $i = $i + $k;
        $nickmax[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_NICK_MAX'],
            'input_value' => $i,
        );
        $j++;
    }
    $fieldset ['nick_max'] = array(
                'input_order'       => 34,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_NICK_MAX'],
                'input_type'        => 'option',
                'input_option'       => $nickmax,
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'nick_max',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'nick_max',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_NICK_MAX'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name');
    $i = 3;
    $k = 1;
    $j = 0;
    while ($i < 30) {
        $i = $i + $k;
        $passmin[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_PASS_MIN'],
            'input_value' => $i,
        );
        $j++;
    }
    $fieldset ['pass_min'] = array(
                'input_order'       => 35,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_PASS_MIN'],
                'input_type'        => 'option',
                'input_option'       => $passmin,
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'pass_min',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'pass_min',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_PASS_MIN'],
                'input_additional'  => '',
                'db_table'          => '_CNBYA_CONFIG_TABLE',
                'db_valuefield'     => 'config_value',
                'db_fieldname'      => 'config_name');
    $i = 4;
    $k = 1;
    $j = 0;
    while ($i < 30) {
        $i = $i + $k;
        $passmax[$j] = array(
            'input_text'  => $i. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_PASS_MAX'],
            'input_value' => $i,
        );
        $j++;
    }
    $fieldset ['pass_max'] = array(
                'input_order'       => 36,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_PASS_MAX'],
                'input_type'        => 'option',
                'input_option'       => $passmax,
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'pass_max',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'pass_max',
                'input_help'        => $lang_admin[$settingspoint]['HELP_FIELD_PASS_MAX'],
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