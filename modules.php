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

define('MODULE_FILE', true);

if (!defined('NUKE_EVO')) {
    require(dirname(__FILE__) . '/mainfile.php');
}

global $_GETVAR;

$mode       = $_GETVAR->get('mode', 'REQUEST');
$check_num  = $_GETVAR->get('check_num', 'REQUEST');
$file       = $_GETVAR->get('file', 'REQUEST', 'string', 'index');
$mop        = $_GETVAR->get('mop', 'REQUEST');
$open       = $_GETVAR->get('open', 'REQUEST');
$name       = $_GETVAR->get('name', 'REQUEST');
$submit     = $_GETVAR->get('submit', '_REQUEST', 'string');


if (isset($name) || !empty($name)) {
    global $db, $userinfo, $evoconfig;
    if(($evoconfig['lock_modules'] && $name != 'Your_Account') && !is_admin() && !is_user() && ($name != 'Profile' && $mode == 'register' && (isset($check_num) || isset($submit)))) {
        include(NUKE_MODULES_DIR.'Your_Account/index.php');
    }
    $module_in_db = (isset($evoconfig['modules'][$name]['title']) ? TRUE : FALSE );
    if ($module_in_db) {
        $module_name = $evoconfig['modules'][$name]['title'];
        if ($module_name == 'Your_Account' || $module_name == main_module()) {
            $evoconfig['modules'][$module_name]['active'] = true;
            $view = 0;
        } else {
            $view = $evoconfig['modules'][$module_name]['view'];
        }
        if ($evoconfig['modules'][$module_name]['active'] || is_mod_admin($module_name)) {
            if ((isset($file) && stristr($file,"..")) || (isset($mop) && stristr($mop,"..")) || (isset($open) && stristr($open,".."))) {
                die('You are so cool...');
            }
            $showblocks     = $evoconfig['modules'][$module_name]['blocks'];
            $module_title   = ($evoconfig['modules'][$module_name]['custom_title'] != '') ? $evoconfig['modules'][$module_name]['custom_title'] : str_replace('_', ' ', $module_name);
            $modpath        = isset($evoconfig['modules'][$module_name]['title']) ? NUKE_MODULES_DIR.$evoconfig['modules'][$module_name]['title'].'/'.$file.'.php' : NUKE_MODULES_DIR.$name.'/'.$file.'.php';
            $groups = (!empty($evoconfig['modules'][$module_name]['groups'])) ? $groups = explode('-', $evoconfig['modules'][$module_name]['groups']) : '';
            if(!empty($open)) {
                $modpath = isset($evoconfig['modules'][$module_name]['title']) ? NUKE_MODULES_DIR.$evoconfig['modules'][$module_name]['title'].'/'.$open.'.php' : NUKE_MODULES_DIR.$name.'/'.$open.'.php';
            }
            $error = '';
            if ($view >= 1 && !is_admin()) {
            //Must Not be a user
                if ($view == 2 AND is_user()) {
                    $error = _MVIEWANON;
            //Must Be a user
                } else if ($view == 3 && !is_user()) {
                    $error = _MODULEUSERS;
            //Must Be a admin
                } elseif ($view == 4 && !is_mod_admin($evoconfig['modules'][$module_name]['title'])) {
                    $error = _MODULESADMINS;
            //Groups
                } elseif ($view == 6 && !empty($groups) && is_array($groups)) {
                    $ingroup = false;
                    global $userinfo;
                    $misgroup = '';
                    foreach ($groups as $group) {
                        if (isset($userinfo['groups'][$group])) {
                            $ingroup = true;
                        }
                    }
                    if (!$ingroup) {
                        $bbgroups = $db->sql_query("SELECT `group_id`, `group_name`, `group_type` FROM `".GROUPS_TABLE."` WHERE `group_single_user` = '0'");
                        while ( list($group_id, $group_name, $group_type) = $db->sql_fetchrow($bbgroups) ) {
                            $modul_group[$group_id]['group_name'] = $group_name;
                        }
                        $misgroup = '';
                        $miscount = 0;
                        foreach ($groups as $group) {
                            if (!isset($userinfo['groups'][$group]) && !is_admin() && ($group_type < 2)) {
                                if ( $miscount == 0 ) {
                                    $misgroup .= $modul_group[$group]['group_name'];
                                } else {
                                    $misgroup .= ',&nbsp;'.$modul_group[$group]['group_name'];
                                }
                                $miscount++;
                            }
                        }
                        $error = _MODULESGROUP.'&nbsp;:&nbsp;'.$misgroup;
                    }
                }
            }
            if($error != '') {
                DisplayError($error);
            } elseif(@file_exists($modpath)) {
                include($modpath);
            } else {
                DisplayError(_MODULEDOESNOTEXIST."<br /><br /><center>--&gt;".$name."&lt;--</center><br />");
            }
        } else {
            DisplayError(_MODULENOTACTIVE."<br /><br />"._GOBACK);
        }
    }
    DisplayError(_MODULEDOESNOTEXIST."<br /><br /><center>--&gt;".$name."&lt;--</center><br />");
} else {
    redirect('index.php');
}

?>