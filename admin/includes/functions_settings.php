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


function admin_show_settings($sub='') {
    if (empty($sub)) {
        admin_settingsmenu();
        return;
    } else {
        $settingsdir = @opendir(NUKE_ADMIN_MODULE_DIR.'/settings');
        while(false !== ($func = readdir($settingsdir))) {
            $readfile = substr(@basename($func,'.php'), 11);
            if( $readfile == $sub) {
                @closedir($settingsdir);
                include(NUKE_ADMIN_MODULE_DIR.'/settings/'.$func);
                return;
            }
        }
        @closedir($settingsdir);
        return;
    }
}

function admin_save_settings($sub='') {
    if (empty($sub)) {
        return;
    } else {
        $settingsdir = @opendir(NUKE_ADMIN_MODULE_DIR.'/settings');
        while(false !== ($func = readdir($settingsdir))) {
            $readfile = substr(@basename($func,'.php'), 11);
            if( $readfile == $sub) {
                @closedir($settingsdir);
                include(NUKE_ADMIN_MODULE_DIR.'/settings/'.$func);
                return;
            }
        }
        @closedir($settingsdir);
        return;
    }
}

function admin_include_settings($sub='') {
    if (empty($sub)) {
        return;
    } else {
        $settingsdir = @opendir(NUKE_ADMIN_MODULE_DIR.'/settings');
        while(false !== ($func = readdir($settingsdir))) {
            $readfile = substr(@basename($func,'.php'), 11);
            if( $readfile == $sub) {
                @closedir($settingsdir);
                include(NUKE_ADMIN_MODULE_DIR.'/settings/'.$func);
                return;
            }
        }
        @closedir($settingsdir);
        return;
    }
}

function admin_settingsshow ($settingspoint, $fieldset) {
    global $admin_file, $lang_admin;
    admin_settingsheader($lang_admin[$settingspoint]['SETTING_HEADER'], $lang_admin[$settingspoint]['SETTING_FIELDSET']);
    $position = array();
    foreach($fieldset as $key => $values) {
        if (isset($key) && !empty($key)) {
            $position[$values['input_order']]['input_name'] = $values;
        }
    }
    asort($position);
    if (isset($position) && is_array($position)) {
        echo "<form name='".$settingspoint."' action='".$admin_file.".php?module=settings' method='post'>\n";
        echo "<table align='center' border='0' width='100%' cellspacing='1'><tr><td width='100%'>\n";
        foreach($position as $order_no => $ary_key) {
            admin_settingsfield($ary_key['input_name'], $settingspoint);
        }
        echo "</td></tr>\n";
        echo "<tr><td width='100%'><input type='hidden' name='sub' value='".$settingspoint."' /></td></tr>\n";
        echo "<tr><td width='100%'><input type='hidden' name='op' value='save' /></td></tr>\n";
        echo "<tr><td width='100%' align='center'><br /><input type='submit' name='submit' value='".$lang_admin[$settingspoint]['BUTTON_SAVE']."' /></td></tr></table></form>\n";
    } else {
        echo $lang_admin[$settingspoint]['FIELD_NONE'];
    }
    admin_settingsfooter();
}

function admin_settingssave($settingspoint, $fieldset) {
    global $admin_file, $db, $lang_admin, $cache, $prefix, $_GETVAR, $adminpoint;
    $all_error = '';
    foreach($fieldset as $key => $values) {
        $error = '';
        if (isset($key) && !empty($key)) {
            if ( $values['input_type'] == 'info' ) { continue;}
            if ( $values['input_type'] == 'break' ) { continue;}
            if (!empty($values['db_fieldname'])) {
                $values['check_type'] = (isset($values['check_type']) ? $values['check_type'] : 'string');
                switch ($values['check_type']) {
                    case 'int':
                        $input_field = $_GETVAR->get($values['input_name'], '_POST', 'int'); break;
                    case 'array':
                        $input_field = $_GETVAR->get($values['input_name'], '_POST', 'array'); break;
                    case 'date':
                        $field_day   = $_GETVAR->get($values['input_name'].'_day', '_POST', 'int');
                        $field_month = $_GETVAR->get($values['input_name'].'_month', '_POST', 'int');
                        $field_year  = $_GETVAR->get($values['input_name'].'_year', '_POST', 'int');
                        $input_field = $field_day.'.'.$field_month.'.'.$field_year; break;
                    default:
                        $input_field = $_GETVAR->get($values['input_name'], '_POST', 'string'); break;
                }
                if (isset($input_field)) {
                    if (isset($values['check_special']) && !empty($values['check_special'])) {
                        if (function_exists($values['check_special'])) {
                            $return = $values['check_special']($values, $fieldset, $settingspoint);
                            if ($return['check_err'] == TRUE) {
                                $error .= $return['check_text'].'<br />';
                            }
                        } else {
                            $error .= $lang_admin[$adminpoint]['ERROR_FUNCTION_NOT_EXISTS'].'<br />';
                        }
                    }
                } else {
                    if ($values['input_readonly'] == TRUE || $values['input_disabled'] == TRUE) {
                        $error .= ''; // if something is disabled or set to readonly, we get no input_value
                    } else {
                        $error .= 'No Input for  '.$values['input_name'].'<br />';
                    }
                }
                // some more checks
                if (!isset($values['db_fieldname'])) {
                    $error .= $lang_admin[$adminpoint]['ERROR_NO_DBFIELD'].'<br />';
                }
            } else {
                $error .= $lang_admin[$adminpoint]['ERROR_NO_TABLE'].'&nbsp;'.$key.'<br />';
            }
        } else {
            $error .= $lang_admin[$adminpoint]['ERROR_MODULE_FIELD_WRONG'] .'&nbsp;'. $settingspoint.'<br />';
        }
        if (strlen($error) < 1 && ($values['input_readonly'] != TRUE && $values['input_disabled'] != TRUE) && !empty($values['db_table'])) {
            if (!isset($values['db_valuefield']) || empty($values['db_valuefield']) || ($values['db_valuefield'] == $values['db_fieldname'])) {
                $sql = "UPDATE `".constant($values['db_table'])."` SET `".$values['db_fieldname']."` = '".$input_field."'";
                if (!$result = $db->sql_query($sql)) {
                    $error .= $lang_admin[$adminpoint]['ERROR_UPDATE_DBFIELD'] . '&nbsp;'.$key.'<br />';
                }
            } else {
                $sql = "UPDATE `".constant($values['db_table'])."` SET `".$values['db_valuefield']."` = '".$input_field."' WHERE `".$values['db_fieldname']."` = '".$values['input_name']."'";
                $db->sql_uquery($sql);
                if ($db->sql_affectedrows() < 1) {
                    $sql = "REPLACE INTO `".constant($values['db_table'])."` SET `".$values['db_fieldname']."` = '".$values['input_name']."', `".$values['db_valuefield']."` = '".$input_field."'";
                    if (!$result = $db->sql_query($sql)) {
                        $error .= $lang_admin[$adminpoint]['ERROR_UPDATE_DBFIELD'] . '&nbsp;'.$key.'<br />';
                    }
                }
            }
        } else {
            $all_error .= $error;
        }
    }
    if (strlen($all_error) < 1) {
        $all_error = '<img src="'.evo_image('infoicon.png', 'evo').'" alt="" title="" />&nbsp;'.$lang_admin[$adminpoint]['INFO_DBUPDATE_SUCCESSFULL'];
        admin_settingsheader($lang_admin[$adminpoint]['SETTINGS_ADMIN_HEADER'], $lang_admin[$adminpoint]['INFO_MESSAGE'], FALSE);
        $backlink = $admin_file.".php?module=settings&amp;op=show&amp;sub=".$settingspoint;
        $cache->clear();
    } else {
        admin_settingsheader($lang_admin[$adminpoint]['SETTINGS_ADMIN_HEADER'], $lang_admin[$adminpoint]['ERROR'], FALSE);
        $backlink = 'javascript:history.back(-1)';
        $all_error = '<img src="'.evo_image('erroricon.png', 'evo').'" alt="" title="" />&nbsp;'.$all_error;
    }
    echo $all_error;
    echo "<br /><br /><center><span style='text-align:center; font-weight:bold;'><a href='".$backlink."' title='".$lang_admin[$adminpoint]['BUTTON_BACK']."'>".$lang_admin[$adminpoint]['BUTTON_BACK']."</a></span></center><br /><br />";
    admin_settingsfooter();
}

function admin_settingsmenu() {
    global $admin_file, $adminpoint, $lang_admin, $adminpoint, $menupoint, $adminsetmenu;

    admin_settingsheader($lang_admin[$adminpoint]['SETTINGS_ADMIN_HEADER'], '', FALSE);
    echo"<table border=\"0\" width=\"100%\" cellspacing=\"1\">";
    $settingsdir = @opendir(NUKE_ADMIN_MODULE_DIR.'/settings');
    $adminsetmenu = 1;
    $menulist  = array();
    $menupoint = array();
    $i = 0;
    while(false !== ($func = readdir($settingsdir))) {
        if(substr($func, 0, 8) == 'setting.') {
            $menulist[$i]['filename'] = $func;
            $menulist[$i]['basename'] = @basename(substr($func, 10),'.php');
            $i++;
        }
    }
    @closedir($settingsdir);
    sort($menulist);
    $counter = 0;
    for ($j=0; $j < $i; $j++) {
        if(!empty($menulist[$j]['filename'])) {
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/'.$menulist[$j]['filename']);
            $counter++;
        }
    }
    unset($menulist);
    unset($adminsetmenu);
    while(list($function, $settings) = each($menupoint)) {
        $menuurl = (isset($settings['menuurl']) ? $settings['menuurl'] : '');
        $menutitle = (isset($settings['menutitle']) ? $settings['menutitle'] : '');
        $menuimage = (isset($settings['menuimage']) ? $settings['menuimage'] : '');
        adminmenu($admin_file.'.php?module='.$adminpoint.'&amp;op=show&amp;sub='.$menuurl, $menutitle, $menuimage, 'settings');
    }
    unset($menupoint);
    echo "</tr></table>\n";
    admin_settingsfooter();
}

function admin_settingsfield($field='', $settingsmodule) {
    global $evoconfig, $bgcolor3, $lang_admin;

    if (isset($field) && is_array($field)) {
        $input_text = (isset($field['input_text']) ? $field['input_text'] : (isset($field['input_name']) ? $field['input_name'] : 'None'));
        $input_type = (isset($field['input_type']) ? strtolower($field['input_type']) : 'text');
        $input_name = (isset($field['input_name']) ? $field['input_name'] : 'name');
        $input_checked = '';
        $input_disabled = (isset($field['input_disabled']) && ($field['input_disabled'] == TRUE) ? "disabled='disabled'" : '');
        $input_size = '';
        $input_maxlength = '';
        $input_readonly = (isset($field['input_readonly']) && ($field['input_readonly'] == TRUE) ? "readonly='readonly'" : '');
        if (!isset($evoconfig[$input_name])) {
            $evoconfig[$input_name] = '';
        }
        if (isset($field['input_value']) && !empty($evoconfig[$input_name])) {
            $input_value = $evoconfig[$input_name];
        } elseif (isset($field['input_value']) && !empty($field['input_value'])) {
            $input_value = $field['input_value'];
        } else {
            $input_value = '';
        }
        if (isset($field['input_help']) && ($field['input_help'] != FALSE)) {
            $input_text = evo_help_img($field['input_help']) . '&nbsp;'.$input_text;
        }
        $input_additional = (isset($field['input_additional']) ? $field['input_additional'] : '');
        switch ($input_type) {
            case 'info':
                echo "<table width='100%' style='border:solid white 1px'><tr><td width='100%' colspan='2' bgcolor='".$bgcolor3."'>".$input_text."</td></tr></table>\n";
                break;
            case 'password': break;
            case 'checkbox': break;
            case 'textarea':
                echo "<table width='100%' style='border:solid white 1px'><tr>\n";
                if ($input_readonly) {
                    $textarea_width = ((isset($values['input_size']) && $values['input_size'] > 50) ? $values['input_size'].'%' : '90%');
                    $textarea_rows  = ((isset($values['input_maxlength']) && $values['input_maxlength'] > 5) ? $values['input_maxlength'] : 5);
                    echo "<td width='50%' align='left'>".$input_text."</td><td width='50%' align='left'>";
                    echo "<textarea name='".$input_name."' cols='".$textarea_width."' rows='".$textarea_rows."' ".$input_readonly.">".$input_value."</textarea><br />".$input_additional."\n";
                } else {
                    $textarea_width = ((isset($values['input_size']) && $values['input_size'] > 50) ? $values['input_size'].'%' : '90%');
                    $textarea_rows  = ((isset($values['input_maxlength']) && $values['input_maxlength'] > 300) ? $values['input_maxlength'].'px' : '300px');
                    echo "<td align='left'>".$input_text."</td><td width='".$textarea_width."' align='left'>";
                    Make_TextArea($input_name, $input_value, $settingsmodule, $textarea_width, $textarea_rows);
                }
                echo "</td></tr></table>\n";
                break;
            case 'option':
                echo "<table width='100%' style='border:solid white 1px'><tr>\n";
                echo "<td width='50%' align='left'>".$input_text."</td><td width='50%' align='left'>";
                echo "<select name='".$input_name."' ".$input_disabled.">\n";
                foreach ($field['input_option'] as $pos => $option) {
                    if (strval($option['input_value']) == strval($evoconfig[$input_name])) {
                        $input_checked = "selected='selected'";
                    } else {
                        $input_checked = '';
                    }
                    echo "<option value='".$option['input_value']."' ".$input_checked." >".$option['input_text']."</option>";
                }
                echo "</select>\n".$input_additional;
                echo "</td></tr></table>\n";
                break;
            case 'radio':
                echo "<table width='100%' style='border:solid white 1px'><tr><td width='50%' align='left'>".$input_text."</td><td width='50%' align='left'>";
                foreach ($field['input_radio'] as $pos => $radio) {
                    if ($radio['input_value'] == (isset($evoconfig[$input_name]) ? $evoconfig[$input_name] : $radio['input_value'])) {
                        $input_checked = "checked='checked'";
                    } else {
                        $input_checked = '';
                    }
                    echo "<input type='radio' name='".$input_name."' value='".$radio['input_value']."' ".$input_checked." ".$input_disabled."/>".$radio['input_text'];
                }
                echo "&nbsp;".$input_additional;
                echo "</td></tr></table>\n";
                break;
            case 'hidden':
                if (!empty($input_value)) {
                    $input_value = "value='".$input_value."'";
                } else {
                    $input_value = '';
                }
                echo "<input type='hidden' name='".$input_name."' ".$input_value." />\n";
                break;
            case 'yesno':
                $input = yesno_option($input_name, ($evoconfig[$input_name]));
                $input_disabled = (isset($field['input_disabled']) ? "disabled='disabled'" : '');
                echo "<table width='100%' style='border:solid white 1px'><tr><td width='50%' align='left'>".$input_text."</td><td width='50%' align='left'>";
                echo $input."&nbsp;".$input_additional."</td></tr></table>\n";
                break;
            case 'text':
                if (!empty($input_value)) {
                    $input_value = "value='".$input_value."'";
                } else {
                    $input_value = '';
                }
                $input_size = "size='".(isset($field['input_size']) ? $field['input_size'] : 30)."'";
                $input_maxlength = "maxlength='".(isset($field['input_maxlength']) ? $field['input_maxlength'] : 255)."'";
                $input_readonly = (($field['input_readonly'] == TRUE) ? "readonly='readonly'" : '');
                echo "<table width='100%' style='border:solid white 1px'><tr><td width='50%' align='left'>".$input_text."</td><td width='50%' align='left'>";
                echo "<input type='".$input_type."' name='".$input_name."' ".$input_size." ".$input_maxlength." ".$input_value." ".$input_readonly." ".$input_checked." ".$input_disabled." />".$input_additional."</td></tr></table>\n";
                break;
            case 'date':
                if (!empty($input_value) && is_numeric($input_value)) {
                    $day   = date('j', $input_value);
                    $month = date('n', $input_value);
                    $year  = date('Y', $input_value);
                } else {
                    $day   = 1;
                    $month = 1;
                    $year  = 1990;
                }
                echo "<table width='100%' style='border:solid white 1px'><tr><td width='50%' align='left'>".$input_text."</td><td width='50%' align='left'>";
                echo "<select name='".$input_name."_day' ".$input_disabled.">\n";
                for ($i = 1; $i <=31; $i++) {
                    if ($day == $i) {
                        $input_checked = "selected='selected'";
                    } else {
                        $input_checked = '';
                    }
                    echo "<option value='".$i."' ".$input_checked." >".$i."</option>";
                }
                echo "</select>&nbsp;".$lang_admin[$settingsmodule]['FIELD_STARTDATE_DAY']."&nbsp;\n";
                echo "<select name='".$input_name."_month' ".$input_disabled.">\n";
                for ($i = 1; $i <=12; $i++) {
                    if ($month == $i) {
                        $input_checked = "selected='selected'";
                    } else {
                        $input_checked = '';
                    }
                    echo "<option value='".$i."' ".$input_checked." >".$i."</option>";
                }
                echo "</select>&nbsp;".$lang_admin[$settingsmodule]['FIELD_STARTDATE_MONTH']."&nbsp;\n";
                echo "<select name='".$input_name."_year' ".$input_disabled.">\n";
                for ($i = 1990; $i <=2015; $i++) {
                    if ($year == $i) {
                        $input_checked = "selected='selected'";
                    } else {
                        $input_checked = '';
                    }
                    echo "<option value='".$i."' ".$input_checked." >".$i."</option>";
                }
                echo "</select>&nbsp;".$lang_admin[$settingsmodule]['FIELD_STARTDATE_YEAR']."&nbsp;\n";
                echo $input_additional;
                echo "</td></tr></table>\n";
                break;
            case 'break':
                echo "<div style='text-align:left;'>\n";
                echo "<h4>".$input_text."</h4>";
                echo "</div>";
                break;
            default:
                return;
                break;
        }
    } else {
        return;
    }
}

function admin_settingsheader($title='', $fieldset='', $back=TRUE) {
    global $admin_file, $lang_admin, $adminpoint;

    include_once(NUKE_BASE_DIR . 'header.php');
    OpenTable();
    echo "<center><strong><font size='3'>".$title."</font></strong></center><br /><br />";
    echo "<center><strong><a href='".$admin_file.".php'>".$lang_admin['KERNEL']['MAIN_BACK']."</a></strong></center><br />";
    CloseTable();
    echo "<br />";
    OpenTable();
    if ($back == TRUE) {
        echo "<center><span style='text-align:center; font-weight:bold;'><a href='".$admin_file.".php?module=settings&amp;op=show' >".$lang_admin[$adminpoint]['BUTTON_BACK_SETTINGS']."</a></span></center><br /><br />\n";
    }
    echo "<div id='admin_settings' style='text-align:left;'>\n";
    if (!empty($fieldset)) {
        echo "<h4>".$fieldset."</h4>\n";
    }
}

function admin_settingsfooter() {
    echo "<h4></h4></div>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR. 'footer.php');
    exit;
}


function getsettings_lang ($settingspoint) {
    global $currentlang, $lang_admin;

    if (@file_exists(NUKE_ADMIN_DIR . 'language/lang_'.$currentlang.'/settings/lang_'.$settingspoint.'.php')) {
        include_once(NUKE_ADMIN_DIR . 'language/lang_'.$currentlang.'/settings/lang_'.$settingspoint.'.php');
    } else if (@file_exists(NUKE_ADMIN_DIR . 'language/lang_english/settings/lang_'.$settingspoint.'.php')) {
        include_once(NUKE_ADMIN_DIR . 'language/lang_english/settings/lang_'.$settingspoint.'.php');
    }
}

function admin_lazytap_check($set) {
    global $adminpoint, $lang_admin;

    if ($set == 0){
        return '';
    }
    $error = '';
    $content = '';
    $filename = NUKE_BASE_DIR . '.htaccess';
    if(!@is_file($filename)) {
        $error = $lang_admin[$adminpoint]['ERROR_LAZY_TAP_NF'];
        return $error;
    }
    if($handle = @fopen($filename,'r')) {
        $content = @fread($handle, @filesize($filename));
        @fclose($handle);
    } else {
        $error = $lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR_OPEN'];
        return $error;
    }
    if (empty($content)) {
        $error = $lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR_OPEN'];
        return $error;
    }
    $pos = strpos($content,'RewriteEngine on');
    $pos2 = strpos($content,'RewriteRule');
    if ($pos === false || $pos2 === false) {
        $error = $lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR'];
        return $error;
    }
    return '';
}

?>