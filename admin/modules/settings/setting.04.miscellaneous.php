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
        $menupoint[$settingspoint]['menuimage'] = 'adm_ein.png';
        return;
    }

    $fieldset = array(
            'httpref' => array(
                'input_order'       => 1,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_HTTPREF_ON'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'httpref',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'httpref',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_HTTPREF_ON_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'httpref'),
            'httprefmax' => array(
                'input_order'       => 2,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_HTTPREF_MAX'],
                'input_type'        => 'text',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'httprefmax',
                'input_size'        => 5,
                'input_maxlength'   => 7,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'httprefmax',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_HTTPREF_MAX_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'httprefmax'),
/*            'htmlheader' => array(
                'input_order'       => 3,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_HTMLHEADER'],
                'input_type'        => 'option',
                'input_option'       => array(
                        0 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_HTMLHEADERXHTML_STRICT'],
                            'input_value' => 0,
                            ),
                        1 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_HTMLHEADERXHTML_TRANSITIONAL'],
                            'input_value' => 1,
                            ),
                        2 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_HTMLHEADERXHTML_FRAMESET'],
                            'input_value' => 2,
                            ),
                        3 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_HTMLHEADERXHTML_MATHML'],
                            'input_value' => 3,
                            ),
                ),
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'htmlheader',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'htmlheader',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_HTMLHEADER_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
*/
            'pollcomm' => array(
                'input_order'       => 4,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'pollcomm',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'pollcomm',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'pollcomm'),
            'articlecomm' => array(
                'input_order'       => 5,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'articlecomm',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'articlecomm',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'articlecomm'),
            'my_headlines' => array(
                'input_order'       => 6,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'my_headlines',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'my_headlines',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES_HELP'],
                'input_additional'  => '',
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'my_headlines'),
            'adminssl' => array(
                'input_order'       => 7,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'adminssl',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'adminssl',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL_HELP'],
                'input_additional'  => $lang_admin[$settingspoint]['INFO_ACTIVATE_ADMINSSL'],
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'queries_count' => array(
                'input_order'       => 8,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'queries_count',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'queries_count',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'use_colors' => array(
                'input_order'       => 9,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'use_colors',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'use_colors',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'lock_modules' => array(
                'input_order'       => 10,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'lock_modules',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'lock_modules',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'banners' => array(
                'input_order'       => 11,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'banners',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'banners',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS_HELP'],
                'input_additional'  => $lang_admin[$settingspoint]['INFO_ACTIVATE_BANNERS'],
                'db_table'          => '_NUKE_CONFIG_TABLE',
                'db_valuefield'     => '',
                'db_fieldname'      => 'banners'),
            'collapse' => array(
                'input_order'       => 12,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'collapse',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'collapse',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'collapse_start' => array(
                'input_order'       => 13,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN'],
                'input_type'        => 'yesno',
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'collapse_start',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'collapse_start',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'collapsetype' => array(
                'input_order'       => 14,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE'],
                'input_type'        => 'option',
                'input_option'       => array(
                        0 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_ICON'],
                            'input_value' => 0,
                            ),
                        1 => array(
                            'input_text'  => $lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_TITLE'],
                            'input_value' => 1,
                            )
                ),
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'collapsetype',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'collapsetype',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
            'analytics' => array(
                'input_order'       => 15,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS'],
                'input_type'        => 'text',
                'check_type'        => 'sring',
                'check_special'     => '',
                'input_name'        => 'analytics',
                'input_size'        => 25,
                'input_maxlength'   => 50,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'analytics',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field'),
    );
    $blocktime[0] = array(
        'input_text'  => $lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_DEACTIVATED'],
        'input_value' => 0,
     );
    $i = 300;
    $j = 0;
    while ($i <= 86400) {
        $j++;
        if ($i <= 3300 ) {
            $k = ($i/60);
            $blocktime[$j] = array(
                'input_text'  => $k. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_MINUTES'],
                'input_value' => $i,
            );
            $i = $i + 300;
        } else {
            $k = ($i/3600);
            $blocktime[$j] = array(
                'input_text'  => $k. '&nbsp;'. $lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_HOURS'],
                'input_value' => $i,
            );
            $i = $i + 3600;
        }
    }
    $fieldset ['block_cachetime'] = array(
                'input_order'       => 16,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME'],
                'input_type'        => 'option',
                'input_option'       => $blocktime,
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'block_cachetime',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'block_cachetime',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME_HELP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');
    $admin_wysiwyg = new Wysiwyg('','');
    $editors = $admin_wysiwyg->getEditors();
    $count_editors = 0;
    $texteditors = array();
    foreach($editors as $editorvalue => $editortext) {
        $texteditors[$count_editors] = array(
            'input_text'  => $editortext,
            'input_value' => $editorvalue,
        );
        $count_editors++;
    }
    $fieldset ['textarea'] = array(
                'input_order'       => 17,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_TEXTEDITORS'],
                'input_type'        => 'option',
                'input_option'       => $texteditors,
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'textarea',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'textarea',
                'input_help'        => $lang_admin[$settingspoint]['FIELD_TEXTEDITORS_HELP'],
                'input_additional'  => $lang_admin[$settingspoint]['INFO_TEXTEDITORS'],
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');
    $returnlazytap = admin_lazytap_check(1);
    if (strlen($returnlazytap) < 2) {
        $fieldset ['lazy_tap'] = array(
                    'input_order'       => 18,
                    'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP'],
                    'input_type'        => 'radio',
                    'input_radio'       => array(
                            0 => array(
                                'input_text'  => $lang_admin[$settingspoint]['OPTION_LAZYTAP_DEACTIVATED'],
                                'input_value' => 0,
                                ),
                            1 => array(
                                'input_text'  => $lang_admin[$settingspoint]['OPTION_LAZYTAP_BOTS'],
                                'input_value' => 1,
                                ),
                            2 => array(
                                'input_text'  => $lang_admin[$settingspoint]['OPTION_LAZYTAP_ALL'],
                                'input_value' => 2,
                                ),
                            3 => array(
                                'input_text'  => $lang_admin[$settingspoint]['OPTION_LAZYTAP_ADMINBOTS'],
                                'input_value' => 3,
                                ),
                            ),
                    'check_type'        => 'int',
                    'check_special'     => '',
                    'input_name'        => 'lazy_tap',
                    'input_size'        => 0,
                    'input_maxlength'   => 0,
                    'input_readonly'    => FALSE,
                    'input_checked'     => FALSE,
                    'input_disabled'    => FALSE,
                    'input_value'       => 'lazy_tap',
                    'input_help'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP_HELP'],
                    'input_additional'  => '',
                    'db_table'          => '_EVOCONFIG_TABLE',
                    'db_valuefield'     => 'evo_value',
                    'db_fieldname'      => 'evo_field');
    } else {
                $fieldset ['lazy_tap'] = array(
                    'input_order'       => 18,
                    'input_text'        => $lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP'],
                    'input_type'        => 'radio',
                    'input_radio'       => array(
                            0 => array(
                                'input_text'  => $lang_admin[$settingspoint]['OPTION_LAZYTAP_DEACTIVATED'],
                                'input_value' => 0,
                                ),
                            1 => array(
                                'input_text'  => $lang_admin[$settingspoint]['OPTION_LAZYTAP_BOTS'],
                                'input_value' => 1,
                                ),
                            2 => array(
                                'input_text'  => $lang_admin[$settingspoint]['OPTION_LAZYTAP_ALL'],
                                'input_value' => 2,
                                ),
                            3 => array(
                                'input_text'  => $lang_admin[$settingspoint]['OPTION_LAZYTAP_ADMINBOTS'],
                                'input_value' => 3,
                                ),
                            ),
                    'check_type'        => 'int',
                    'check_special'     => '',
                    'input_name'        => 'lazy_tap',
                    'input_size'        => 0,
                    'input_maxlength'   => 0,
                    'input_readonly'    => FALSE,
                    'input_checked'     => FALSE,
                    'input_disabled'    => TRUE,
                    'input_value'       => 0,
                    'input_help'        => TRUE,
                    'input_additional'  => '<br />'.$lang_admin[$settingspoint]['INFO_DEACTIVATED_LAZYTAP'].'<br />'.$returnlazytap,
                    'db_table'          => '_EVOCONFIG_TABLE',
                    'db_valuefield'     => 'evo_value',
                    'db_fieldname'      => 'evo_field');
    }
    
// SexyTooltip Admin menu

    $tooltip_css = array();
    $i = 0;
      
    $handle = @opendir(NUKE_INCLUDE_DIR.'javascript/sexyscript/sexytooltips/');
    while(false !== ($file = @readdir($handle))) {
        if(preg_match('/^(.*?)\.css$/i', $file, $readfile)) {
            $i++;
            $showfile = str_replace('.css','',$readfile[1]);
            $tooltip_css[$i] = array(
                    'input_text'  => $showfile,
                    'input_value' => $file,
            );
        }
    }
    @closedir($handle);
    $fieldset ['tooltips'] = array(
                'input_order'       => 20,
                'input_text'        => 'ToolTips Layout',
                'input_type'        => 'option',
                'input_option'      => $tooltip_css,
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'tooltips',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'tooltips',
                'input_help'        => $lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_LAYOUT'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');
                
    $click = array(
        0 => array(
            'input_text' => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_MOUSECLICK'],
            'input_value' => 1,
        ),
        1 => array(
            'input_text' => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_MOUSEOVER'],
            'input_value' => 0,
        ),
    );
    $fieldset ['break'] = array(
                'input_order'       => 19,
                'input_text'        => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_BREAK'],
                'input_type'        => 'break',
                'input_option'      => '',
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
                
    $fieldset ['tooltips_click'] = array(
                'input_order'       => 21,
                'input_text'        => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_POPUP'],
                'input_type'        => 'option',
                'input_option'      => $click,
                'check_type'        => 'int',
                'check_special'     => '',
                'input_name'        => 'tooltips_click',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'tooltips_click',
                'input_help'        => $lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_POPUP'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');
                
    $mode = array(
        0 => array(
            'input_text' => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_AUTO'],
            'input_value' => 'auto'
        ),
        1 => array(
            'input_text' => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_TR'],
            'input_value' => 'bl',
        ),
        2 => array(
            'input_text' => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_TL'],
            'input_value' => 'br',
        ),
        3 => array(
            'input_text' => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_BR'],
            'input_value' => 'tl',
        ),
        4 => array(
            'input_text' => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_BL'],
            'input_value' => 'tr',
        ),
    );
                
    $fieldset ['tooltips_mode'] = array(
                'input_order'       => 22,
                'input_text'        => $lang_admin[$settingspoint]['SEXY_TOOLTIPS_MODE'],
                'input_type'        => 'option',
                'input_option'      => $mode,
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => 'tooltips_mode',
                'input_size'        => 0,
                'input_maxlength'   => 0,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => 'tooltips_mode',
                'input_help'        => $lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_MODE'],
                'input_additional'  => '',
                'db_table'          => '_EVOCONFIG_TABLE',
                'db_valuefield'     => 'evo_value',
                'db_fieldname'      => 'evo_field');            
                
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