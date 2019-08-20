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
        $menupoint[$settingspoint]['menuimage'] = 'adm_imp.png';
        return;
    }

    $fieldset = array(
            'legal_aboutus' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SHOW_ABOUTUS'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'legal_aboutus',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'legal_aboutus',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_EVO_CONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'legal_disclaimer' => array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SHOW_DISCLAIMER'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'legal_disclaimer',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'legal_disclaimer',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_EVO_CONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'legal_privacy' => array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SHOW_PRIVACY'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'legal_privacy',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'legal_privacy',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_EVO_CONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'legal_terms' => array(
                'input_order'       => 4,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_SHOW_TERMS'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'legal_terms',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'legal_terms',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_EVO_CONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'legal_questions' => array(
                'input_order'       => 5,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FEEDBACK_MODUL'],
                'input_type'        => 'option',
                'input_option'       => array(
                        0 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_FEEDBACK_NONE'],
                            'input_value' => 0,
                            ),
                        1 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_FEEDBACK_FEEDBACK'],
                            'input_value' => 2,
                            ),
                        2 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_FEEDBACK_CONTACT'],
                            'input_value' => 1,
                            )
                ),
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'legal_questions',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'legal_questions',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_EVO_CONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
    );

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