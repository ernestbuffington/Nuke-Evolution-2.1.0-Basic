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
        $menupoint[$settingspoint]['menuimage'] = 'adm_file.png';
        return;
    }

    $fieldset = array(
            'ftphost' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FTPHOST'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'ftphost',
                'input_size'        => 40,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'ftphost',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_FTPHOST_HELP'],
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => 'ftphost'),
            'ftpport' => array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FTPPORT'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'ftpport',
                'input_size'        => 40,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'ftpport',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_FTPPORT_HELP'],
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => 'ftpport'),
            'ftppath' => array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FTPPATH'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'ftppath',
                'input_size'        => 40,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'ftppath',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_FTPPATH_HELP'],
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => 'ftppath'),
            'ftpuser' => array(
                'input_order'       => 4,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FTPUSER'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'ftpuser',
                'input_size'        => 40,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'ftpuser',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_FTPUSER_HELP'],
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => 'ftpuser'),
            'ftppwd' => array(
                'input_order'       => 5,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FTPPWD'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => 'admin_filehandling_checkftp',
                'input_name'        => 'ftppwd',
                'input_size'        => 40,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'ftppwd',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_FTPPWD_HELP'],
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => 'ftppwd'),
            'break1' => array(
                'input_order'       => 6,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_BREAK_FILESETTINGS'],
                'input_type'        => 'break',
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
            'directory_mode' => array(
                'input_order'       => 7,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_DIRECTORY_MODE'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'directory_mode',
                'input_size'        => 4,
                'input_maxlength'   => 4,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'directory_mode',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_DIRECTORY_MODE_HELP'],
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => 'directory_mode'),
            'file_mode' => array(
                'input_order'       => 8,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FILE_MODE'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => 'admin_filehandling_checkmode',
                'input_name'        => 'file_mode',
                'input_size'        => 4,
                'input_maxlength'   => 4,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'file_mode',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_FILE_MODE_HELP'],
                'input_additional'  => '',
                'db_table'          => '',
                'db_valuefield'     => '',
                'db_fieldname'      => 'file_mode'),
    );

    function admin_filehandling_checkftp($values, $fieldset, $settingspoint) {
        global $db, $lang_admin, $_GETVAR;

        $ftphost = $_GETVAR->get('ftphost', '_POST', 'string', '');
        $ftpport = $_GETVAR->get('ftpport', '_POST', 'int', 21);
        $ftppath = $_GETVAR->get('ftppath', '_POST', 'string', '');
        $ftpuser = $_GETVAR->get('ftpuser', '_POST', 'string', '');
        $ftppwd  = $_GETVAR->get('ftppwd', '_POST', 'string', '');

        $error = array();
        if ( EvoKernel_FtpCheck($ftphost, $ftpport, $ftppath, $ftpuser, $ftppwd) ) {
            $db->sql_uquery('REPLACE INTO `'._EVOCONFIG_TABLE.'` set `evo_value` = "'.$ftphost.'", `evo_field` = "ftphost"');
            $db->sql_uquery('REPLACE INTO `'._EVOCONFIG_TABLE.'` set `evo_value` = "'.$ftpport.'", `evo_field` = "ftpport"');
            $db->sql_uquery('REPLACE INTO `'._EVOCONFIG_TABLE.'` set `evo_value` = "'.$ftppath.'", `evo_field` = "ftppath"');
            $db->sql_uquery('REPLACE INTO `'._EVOCONFIG_TABLE.'` set `evo_value` = "'.$ftpuser.'", `evo_field` = "ftpuser"');
            $db->sql_uquery('REPLACE INTO `'._EVOCONFIG_TABLE.'` set `evo_value` = "'.$ftppwd.'" , `evo_field` = "ftppwd"');
            $db->sql_uquery('REPLACE INTO `'._EVOCONFIG_TABLE.'` set `evo_value` = "TRUE" , `evo_field` = "ftpchecked"');
            $error['check_err']  = FALSE;
            $error['check_text'] = '';
            return $error;
        } else {
            $error['check_err']  = TRUE;
            $error['check_text'] = $lang_admin[$settingspoint]['CHECK_ERROR_NOConnection'];
            return $error;
        }
    }

    function admin_filehandling_checkmode($values, $fieldset, $settingspoint) {
        global $db, $lang_admin, $_GETVAR, $evoconfig;

        $dir_mode  = $_GETVAR->get('directory_mode', '_POST', 'string', '');
        $file_mode = $_GETVAR->get('file_mode', '_POST', 'string', '');

        if (empty($dir_mode)) {
            $dir_mode = $evoconfig['directory_mode'];
        }
        if (empty($file_mode)) {
            $file_mode = $evoconfig['file_mode'];
        }

        $error = array();
        $db->sql_uquery('REPLACE INTO `'._EVOCONFIG_TABLE.'` set `evo_value` = "'.$dir_mode.'" , `evo_field` = "directory_mode"');
        $db->sql_uquery('REPLACE INTO `'._EVOCONFIG_TABLE.'` set `evo_value` = "'.$file_mode.'", `evo_field` = "file_mode"');
        $error['check_err']  = FALSE;
        $error['check_text'] = '';
        return $error;
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