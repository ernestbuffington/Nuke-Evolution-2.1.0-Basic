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
        $menupoint[$settingspoint]['menuimage'] = 'adm_code.png';
        return;
    }

    $fieldset = array(
            'usegfxcheck' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_USEGFXCHECK'],
                'input_type'        => 'option',
                'input_option'       => array(
                        0 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_CHECKING_NO'],
                            'input_value' => 0,
                            ),
                        1 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMIN'],
                            'input_value' => 1,
                            ),
                        2 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_USER'],
                            'input_value' => 2,
                            ),
                        3 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_CHECKING_NEW_USER'],
                            'input_value' => 3,
                            ),
                        4 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_NEW_USER'],
                            'input_value' => 4,
                            ),
                        5 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMINUSER'],
                            'input_value' => 5,
                            ),
                        6 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_CHECKING_NEW_ADMINUSER'],
                            'input_value' => 6,
                            ),
                        7 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_EVERYWHERE'],
                            'input_value' => 7,
                            ),
                ),
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'usegfxcheck',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'usegfxcheck',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            );
    if (GDSUPPORT) {
        if (!defined('CAPTCHA')) {
            $fieldset['codesize'] = array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_CODESIZE'],
                'input_type'        => 'text',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'codesize',
                'input_size'        => 1,
                'input_maxlength'   => 1,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'codesize',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');
            $fieldset['codefont'] = array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_CODEFONT'],
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'codefont',
                'input_size'        => 40,
                'input_maxlength'   => 255,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'codefont',
                'input_help'        => FALSE,
                'input_additional'  => '<br />'.$lang_admin[$settingspoint]['FIELD_FONT_UPLOAD'].':&nbsp;'.NUKE_BASE_DIR.'images/captcha/',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');
            $fieldset['useimage'] = array(
                'input_order'       => 4,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_IMAGE_BACKGROUND'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'useimage',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'useimage',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');
        } else {
            $gfxinput[0] = array(
                            'input_text'  => "<img src='images/captcha.php?size=large&amp;file=default' border='0' alt='".$lang_admin[$settingspoint]['IMG_CAPFILE_FILE']."' title='".$lang_admin[$settingspoint]['IMG_CAPFILE_FILE']."' />&nbsp;".$lang_admin[$settingspoint]['OPTION_CAPFILE_DEFAULT']."<br />",
                            'input_value' => '',
                     );
            $i=0;
            $handle = @opendir(NUKE_BASE_DIR.'images/captcha/');
            while(false !== ($file = @readdir($handle))) {
                if(preg_match('/^(.*?)\.jpg$/i', $file, $readfile)) {
                    $i++;
                    $showfile = str_replace('.jpg','',$readfile[1]);
                    $gfxinput[$i] = array(
                            'input_text'  => "<img src='images/captcha.php?size=large&amp;file=".$showfile."' border='0' alt='".$lang_admin[$settingspoint]['IMG_CAPFILE_FILE']."' title='".$lang_admin[$settingspoint]['IMG_CAPFILE_FILE']."' />&nbsp;".$lang_admin[$settingspoint]['OPTION_CAPFILE_FILE'].'&nbsp;'.$showfile."<br />",
                            'input_value' => $showfile,
                    );
                }
            }
            @closedir($handle);
            $fieldset['capfile'] = array(
                'input_order'       => 5,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_CAPFILE'],
                'input_type'        => 'radio',
                'input_radio'       => $gfxinput,
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'capfile',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'capfile',
                'input_help'        => FALSE,
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');
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