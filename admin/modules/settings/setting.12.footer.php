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
        $menupoint[$settingspoint]['menuimage'] = 'adm_foo.png';
        return;
    }

    $fieldset = array(
            'foot1' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FOOTER1'],
                'input_type'        => 'textarea',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'foot1',
                'input_size'        => 150,
                'input_maxlength'   => 5,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'foot1',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'foot1'),
            'foot2' => array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FOOTER2'],
                'input_type'        => 'textarea',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'foot2',
                'input_size'        => 150,
                'input_maxlength'   => 5,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'foot2',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'foot2'),
            'foot3' => array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_FOOTER3'],
                'input_type'        => 'textarea',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'foot3',
                'input_size'        => 150,
                'input_maxlength'   => 5,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'foot3',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'foot3'),
            'copyright' => array(
                'input_order'       => 4,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COPYRIGHT'],
                'input_type'        => 'textarea',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'copyright',
                'input_size'        => 150,
                'input_maxlength'   => 5,
                'input_readonly'    => TRUE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'copyright',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'copyright'),
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