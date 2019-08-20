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

global $admin_file, $_GETVAR, $lang_admin, $adminsetmenu, $db;

if (is_god_admin() || is_admin('super')) {
    getsettings_lang($settingspoint);
    if ($adminsetmenu == 1) {
        $menupoint[$settingspoint]['menutitle'] = (isset($lang_admin[$settingspoint]['MENU_TITLE']) ? $lang_admin[$settingspoint]['MENU_TITLE'] : $settingspoint);
        $menupoint[$settingspoint]['menuurl']   = $settingspoint;
        $menupoint[$settingspoint]['menuimage'] = 'adm_meta.png';
        return;
    }

    $sql = "SELECT meta_name, meta_content FROM "._META_TABLE;
    $result = $db->sql_query($sql);
    $i=1;
    $fieldset = array();
    while(list($meta_name, $meta_content) = $db->sql_fetchrow($result)) {
        $fieldset[$meta_name] = array(
                'input_order'       => $i,
                'input_text'        => $lang_admin[$settingspoint]['FIELD_META'].':&nbsp;'.$meta_name,
                'input_type'        => 'text',
                'check_type'        => 'string',
                'check_special'     => '',
                'input_name'        => $meta_name,
                'input_size'        => 50,
                'input_maxlength'   => 150,
                'input_readonly'    => FALSE,
                'input_checked'     => FALSE,
                'input_disabled'    => FALSE,
                'input_value'       => $meta_content,
                'input_help'        => $lang_admin[$settingspoint]['FIELD_META_'.strtoupper($meta_name).''],
                'input_additional'  => "<a href='".$admin_file.".php?module=settings&amp;sub=".$settingspoint."&amp;op=delete&amp;meta=".$meta_name."'><img src='".evo_image('delete.png', 'evo')."' alt='' title='".$lang_admin[$settingspoint]['IMG_DELETE_TITLE']."' border='0' align='middle' /></a>",
                'db_table'          => '_META_TABLE',
                'db_valuefield'     => 'meta_content',
                'db_fieldname'      => 'meta_name');
        $i++;
    }
    $fieldset['new_value'] = array(
            'input_order'       => $i+1,
            'input_text'        => "<input type='text' name='new_name' value='' size='30' maxlength='40' />",
            'input_type'        => 'text',
            'check_type'        => 'string',
            'check_special'     => 'admin_meta_newvalue',
            'input_name'        => 'new_value',
            'input_size'        => 50,
            'input_maxlength'   => 150,
            'input_readonly'    => FALSE,
            'input_checked'     => FALSE,
            'input_disabled'    => FALSE,
            'input_value'       => '',
            'input_help'        => FALSE,
            'input_additional'  => '',
            'db_table'          => '_META_TABLE',
            'db_valuefield'     => 'meta_content',
            'db_fieldname'      => 'meta_name');

    function admin_meta_newvalue($values, $fieldset, $settingspoint) {
        global $db, $lang_admin, $_GETVAR;

        $fieldname  = $_GETVAR->get('new_name', '_POST', 'string');
        $fieldvalue = $_GETVAR->get('new_value', '_POST', 'string');
        $error = array();
        if (isset($fieldname) && !empty($fieldname)) {
            if (@array_key_exists($fieldname, $fieldset)) {
                $error['check_err'] = TRUE;
                $error['check_text'] = $lang_admin[$settingspoint]['CHECK_NAME_EXISTS'].'&nbsp;->'.$fieldname;
                return $error;
            } else {
                if (!isset($fieldname) || !isset($fieldvalue) || empty($fieldname)) {
                    $error['check_err'] = TRUE;
                    $error['check_text'] = $lang_admin[$settingspoint]['CHECK_NOT_VALID'];
                    return $error;
                } else {
                    $fieldname = str_replace(' ', '_', $fieldname);
                    $sql = "INSERT INTO `".constant($values['db_table'])."` (`".$values['db_fieldname']."`, `".$values['db_valuefield']."`) VALUES ('".$fieldname."', '".$fieldvalue."')";
                    if (!$db->sql_query($sql)) {
                        $error['check_err'] = TRUE;
                        $error['check_text'] = $lang_admin[$settingspoint]['CHECK_INSERT_FAILED'];
                        return $error;
                    } else {
                        $error['check_err'] = FALSE;
                        $error['check_text'] = '';
                        return $error;
                    }
                }
            }
        } else {
            $error['check_err'] = FALSE;
            $error['check_text'] = '';
            return $error;
        }
    }
    
    function admin_meta_delete($settingspoint, $fieldset) {
        global $admin_file, $db, $lang_admin, $_GETVAR;
        
        $todelete = $_GETVAR->get('meta', '_GET', 'string');
        if (@array_key_exists($todelete, $fieldset)) {
            $db->sql_uquery("DELETE FROM "._META_TABLE." WHERE `meta_name` = '".$todelete."'");
        }
        redirect($admin_file.'.php?module=settings&amp;sub='.$settingspoint.'&amp;op=show');
    }

    $settings_todo = ($_GETVAR->get('op', '_REQUEST', 'string') ? $_GETVAR->get('op', '_REQUEST', 'string') : 'show');

    switch ($settings_todo) {
        case 'show':
            admin_settingsshow($settingspoint, $fieldset);
            break;
        case 'save':
            admin_settingssave($settingspoint, $fieldset);
            break;
        case 'delete':
            admin_meta_delete($settingspoint, $fieldset);
            break;
    }
}

?>