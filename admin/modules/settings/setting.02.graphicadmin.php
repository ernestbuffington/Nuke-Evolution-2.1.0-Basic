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
        $menupoint[$settingspoint]['menuimage'] = 'adm_gfx.png';
        return;
    }

    $fieldset = array(
            'admingraphic' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'admingraphic',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'admingraphic',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'admingraphic'),
            'adminpos1' => array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ADMIN_POS'],
                'input_type'        => 'radio',
                'input_radio'       => array(
                        0 => array(
                            'input_text'  => $lang_admin[$settingspoint]['FIELD_ADMIN_POS_UP'],
                            'input_value' => 1,
                            ),
                        1 => array(
                            'input_text'  => $lang_admin[$settingspoint]['FIELD_ADMIN_POS_DOWN'],
                            'input_value' => 0,
                            )
                ),
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'admin_pos',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'admin_pos',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ADMIN_POS_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'admin_pos'),
            'img_resize' => array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'img_resize',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'img_resize',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'img_width' => array(
                'input_order'       => 4,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH'],
                'input_type'        => 'text',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'img_width',
                'input_size'        => 3,
                'input_maxlength'   => 4,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'img_width',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'img_height' => array(
                'input_order'       => 5,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT'],
                'input_type'        => 'text',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'img_height',
                'input_size'        => 3,
                'input_maxlength'   => 4,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'img_height',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
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