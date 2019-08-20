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
        $menupoint[$settingspoint]['menuimage'] = 'adm_com.png';
        return;
    }

    $fieldset = array(
            'commentlimit' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COMMENT_LIMIT'],
                'input_type'        => 'text',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'commentlimit',
                'input_size'        => 5,
                'input_maxlength'   => 8,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'commentlimit',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'commentlimit'),
            'anonymous' => array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COMMENT_ANONYMOUS'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'anonymous',
                'input_size'        => 30,
                'input_maxlength'   => 30,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'anonymous',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'anonymous'),
            'moderate' => array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COMMENT_MODERATE'],
                'input_type'        => 'option',
                'input_option'       => array(
                        0 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_MODERATE_NONE'],
                            'input_value' => 0,
                            ),
                        1 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_MODERATE_USER'],
                            'input_value' => 2,
                            ),
                        2 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_MODERATE_ADMIN'],
                            'input_value' => 1,
                            )
                ),
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'moderate',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'moderate',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'moderate'),
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