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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

function theme_exists($theme_name) {
    static $ThemeExists;

    if ($ThemeExists[$theme_name]) {
        return $ThemeExists[$theme_name];
    }

    if (@is_file(NUKE_THEMES_DIR . $theme_name . '/theme.php')) {
        return true;
    }
    return false;
}

function ThemeAllowed($theme) {
    global $evoconfig;
    static $themesA;

    if (isset($themesA[$theme])) {
        return $themesA[$theme];
    }
    if(!$theme || !theme_exists($theme)) {
        $themesA[$theme] = FALSE;
        return FALSE;
    }
    if( is_admin() || ($theme == $evoconfig['default_Theme'])) {
        $themesA[$theme] = TRUE;
        return TRUE;
    }
    $themes = get_themes();
    foreach($themes as $allowed_themes) {
        $allowed[] = $allowed_themes['theme_name'];
    }
    if (@in_array($theme, $allowed)) {
        $themesA[$theme] = TRUE;
        return TRUE;
    }
    $themesA[$theme] = FALSE;
    return FALSE;
}

function theme_installed($theme_name) {
    global $db;
    static $ThemeInstalled;

    if (isset($ThemeInstalled[$theme_name])) {
        return $ThemeInstalled[$theme_name];
    }
    $theme_installed = $db->sql_unumrows("SELECT theme_name FROM "._THEMES_TABLE." WHERE theme_name = '".$theme_name."'");
    if ($theme_installed == 1) {
        $ThemeInstalled[$theme_name] = TRUE;
        return TRUE;
    }
    $ThemeInstalled[$theme_name] = FALSE;
    return FALSE;
}

function ThemeGetStatus($theme_name, $active=0) {
    global $evoconfig;
    if ($theme_name == $evoconfig['default_Theme']) {
        return "<strong>"._THEMES_DEFAULT."</strong>";
    }
    if(!theme_installed($theme_name)) {
        return _THEMES_QUNINSTALLED;
    }
    if(!theme_exists($theme_name)) {
        return "<font color='red'><strong>"._THEMES_THEME_MISSING."</strong></font>";
    }
    return (($active==1) ? "<em>"._THEMES_ACTIVE."</em>" : "<em>"._THEMES_INACTIVE."</em>");
}

function ThemeNumUsers($theme_name) {
    global $db, $evoconfig;
    $where = ($evoconfig['default_Theme'] == $theme_name ) ? "theme = '' OR theme = '" . $theme_name . "'" : "theme = '".$theme_name."'";
    $num = $db->sql_unumrows("SELECT user_id FROM "._USERS_TABLE." WHERE user_id != '1' AND ".$where."");
    return $num;
}

function ThemeIsActive($theme, $admin_file=false) {
    global $db;
    static $activeT;

    if (is_admin() && !$admin_file) {
        return TRUE;
    }
    if(isset($activeT[$theme])) {
        return $activeT[$theme];
    }
    $num = $db->sql_unumrows("SELECT active FROM "._THEMES_TABLE." WHERE theme_name = '".$theme."'");
    if ($num == 1) {
        $activeT[$theme] = TRUE;
        return TRUE;
    }
    $activeT[$theme] = FALSE;
    return FALSE;
}

function ThemeGetGroups($groups) {
    global $db;

    $return_groups = '';
    if (!is_array($groups)) {
        $groups = explode('-',$groups);
    }
    $countgroups = count($groups);
    for($i=0, $maxi=$countgroups; $i < $maxi; $i++) {
        $comma = (empty($groups[$i+1])) ? '' : ', ';
        $row   = $db->sql_ufetchrow("SELECT group_name FROM ".GROUPS_TABLE." WHERE group_id = '" . $groups[$i] . "'");
        if (strlen($row['group_name']) > 1) {
            $return_groups .= $row['group_name'] . $comma;
        }
    }
    if (empty($return_groups)) {
        $return_groups = _THEMES_NONE;
    }
    return $return_groups;
}

function ThemeAllowedGroups($groups) {
    global $db, $userinfo;

    if (empty($groups)) {
        return FALSE;
    }
    $return_groups = 0;
    if (!is_array($groups)) {
        $groups = explode('-',$groups);
    }
    $countgroups = count($groups);
    for($i=0, $maxi=$countgroups; $i < $maxi; $i++) {
        $result = $db->sql_unumrows("SELECT group_id FROM ".USER_GROUP_TABLE." WHERE group_id = '" . $groups[$i] . "' AND user_id = '". $userinfo['user_id']."'");
        if ( $result > 0 ) {
            $return_groups++;
        }
    }
    if ( $return_groups > 0 ) {
        $return_groups = TRUE;
    }
    return FALSE;
}

function add_theme($themes, $theme_name, $custom_name, $groups, $perms, $active) {
    $themes[$theme_name] = array();
    $themes[$theme_name]['theme_name'] = $theme_name;
    $themes[$theme_name]['custom_name'] = $custom_name;
    $themes[$theme_name]['groups'] = $groups;
    $themes[$theme_name]['permissions'] = $perms;
    $themes[$theme_name]['active'] = $active;
    return $themes;
}

function ThemeMostPopular() {
    global $db, $evoconfig;
    static $theme;
    if(isset($theme)) return $theme;
    $sql = "SELECT COUNT(*) AS theme_count, theme FROM "._USERS_TABLE." WHERE user_id > 1 GROUP BY theme ORDER BY theme_count DESC";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $theme = ($row['theme'] && theme_exists($row['theme']) ) ? $row['theme'] : $evoconfig['default_Theme'];
    return $theme;
}


// Function: get_theme by ReOrGaNiSaTiOn
// centralized function for changing theme
// is called from mainfile.php
// Variables:
// $inputvar = name of the variable where we have to look for a theme preview themename
// tpreview  = themename - string - must be in themes table field "theme_name"
//             does not change basic settings - only a preview for the theme - so it's saved in a separate cookie 'theme'
//             overrides user settings until cookie is deleted or cookie value is changed
// newtheme  = themename - string - must be in themes table field "theme_name"
//             does change user settings permanent - so it's not allowed to be called for guests
// chngtheme = boolean (0 = FALSE; 1= TRUE)
//             additional field for newtheme. If set to TRUE, newtheme will be changed in user table too
function get_theme() {
    global $userinfo, $evoconfig, $_GETVAR, $db, $ThemeSel;

    $tchange      = $_GETVAR->get('chngtheme', '_REQUEST', 'int', 0);
    $adminpreview = $_GETVAR->get('adminpreview', '_REQUEST', 'int', 0);
    $themecookie  = evo_getcookie('theme');
    $inputvar     = $_GETVAR->get('tpreview', '_REQUEST', 'string', '');
    if (!empty($inputvar)) {
        $tpreview = $_GETVAR->get($inputvar, '_REQUEST', 'string', '');
    } else {
        $tpreview = '';
    }
    $DefaultTheme = ((isset($evoconfig['default_Theme']) && !empty($evoconfig['default_Theme'])) ? $evoconfig['default_Theme'] : 'chromo');
    if (!theme_exists($DefaultTheme)) {
        die('No default Theme could be selected');
    }
    // if adminpreview, we set a cookie and go ahead
    if ($adminpreview && !empty($tpreview)) {
        evo_setcookie('theme', $tpreview, 0);
        return $tpreview;
    }
    // ok .. let's check, what to do - first we have to do the actions if variables are filled
    if (is_user() && $evoconfig['allowusertheme']) {
        // it's allowed for users to change theme permanently
        $ttheme   = $_GETVAR->get('newtheme', 'REQUEST', 'string', '');
        if ($tchange) {
            $permanent = TRUE;
        } else {
            $permanent = FALSE;
        }
    } else {
        // in all other cases permanent have to be false and only preview is allowed
        $ttheme    = '';
        $permanent = FALSE;
    }
    if (empty($ttheme) && !empty($tpreview)) {
        // no newtheme is selected but preview - so set this temporary in a themecookie
        $ttheme    = $tpreview;
        $permanent = FALSE;
    }
    $allowed = ThemeAllowed($ttheme);
    if ($allowed && $permanent) {
        // Theme should be changed (newtheme) and permanent is true 
        $db->sql_uquery('UPDATE '._USERS_TABLE.' set theme = "'.$ttheme.'" WHERE user_id = '.$userinfo['user_id']);
        evo_setusercookie($userinfo['user_id'], 'userid');
        evo_setcookie('theme', $ttheme, 0);
        redirect($_SERVER['REQUEST_URI']);
    } elseif ($allowed) {
        // theme is allowed and permanent is false
        evo_setcookie('theme', $ttheme, 0);
        redirect($_SERVER['REQUEST_URI']);
    } else {
        // either the selected theme isn't allowed for this user/guest or no input was given (normal modus)
        $tempTheme = $DefaultTheme;
    }
    // Now the actions if we are in "normal" modus
    // Prio 1 = themecookie
    if (!empty($themecookie)) {
        $tempTheme      = $themecookie;
        $is_themecookie = TRUE;
        $is_usercookie  = FALSE;
    } elseif (is_user()) {
        // Prio 2 = usercookie
        $temp = explode(':', evo_getcookie('user'));
        $tempTheme = $temp[10];
        $is_themecookie = FALSE;
        $is_usercookie  = FALSE;
        if (!isset($tempTheme) || empty($tempTheme)) {
            // Prio 3 for users = userinfo
            $tempTheme = $userinfo['theme'];
            $is_themecookie = TRUE;
            $is_usercookie  = TRUE;
        }
    } else {
        // ok, either we have really nothing for our user or we must be a guest
        $tempTheme = $DefaultTheme;
        $is_themecookie = FALSE;
        $is_usercookie  = FALSE;
    }
    // Let's check the theme
    if (!theme_exists($tempTheme)) {
        // there was something wrong in the past - so let's fix it
        $tempTheme = $DefaultTheme;
    }
    if ($is_usercookie) {
        $db->sql_uquery('UPDATE '._USERS_TABLE.' set theme = "'.$tempTheme.'" WHERE user_id = '.$userinfo['user_id']);
        evo_setusercookie($userinfo['user_id'], 'userid');
    }
    if ($is_themecookie) {
        evo_setcookie('theme', $tempTheme, 0);
    }
    $ThemeSel = $tempTheme;
    return $ThemeSel;
}

function get_themes($mode='user_themes') {
    //Returns all themes the user is allowed to use
    global $db, $debugger;

    switch($mode) {
        case 'user_themes':
            $sql = "SELECT * FROM "._THEMES_TABLE." WHERE active='1' ORDER BY theme_name ASC";
            if (!$result = $db->sql_query($sql)) {
                $debugger->handle_error(_THEMES_ERROR_MESSAGE, _THEMES_ERROR);
            }
            $themes = array();
            while ($row=$db->sql_fetchrow($result)) {
                $active = $row['active'];
                $theme_name = $row['theme_name'];
                $groups = $row['groups'];
                $perms = $row['permissions'];
                $custom_name = $row['custom_name'];
                if (theme_exists($theme_name) && ($perms == 1 || ($perms == 2 && ThemeAllowedGroups($groups)) || ($perms == 3 && is_admin()))) {
                    $themes[$theme_name]['theme_name'] = $theme_name;
                    $themes[$theme_name]['custom_name'] = $custom_name;
                    $themes[$theme_name]['groups'] = $groups;
                    $themes[$theme_name]['permissions'] = $perms;
                    $themes[$theme_name]['active'] = $active;
                }
            }
            $db->sql_freeresult($result);
            return $themes;
            break;
        case 'all':
            $sql = "SELECT * FROM "._THEMES_TABLE." ORDER BY theme_name ASC";
            if (!$result = $db->sql_query($sql)) {
                $debugger->handle_error(_THEMES_ERROR_MESSAGE, _THEMES_ERROR);
            }
            $themes = array();
            while ($row=$db->sql_fetchrow($result)) {
                $theme_name = $row['theme_name'];
                $themes[$theme_name]['theme_name']  = $row['theme_name'];
                $themes[$theme_name]['custom_name'] = $row['custom_name'];
                $themes[$theme_name]['groups']      = $row['groups'];
                $themes[$theme_name]['permissions'] = $row['permissions'];
                $themes[$theme_name]['active']      = $row['active'];
            }
            $db->sql_freeresult($result);
            return $themes;
            break;
        case 'active':
            $sql = "SELECT * FROM "._THEMES_TABLE." WHERE active='1' ORDER BY theme_name ASC";
            if (!$result = $db->sql_query($sql)) {
                $debugger->handle_error(_THEMES_ERROR_MESSAGE, _THEMES_ERROR);
            }
            $themes = array();
            while ($row=$db->sql_fetchrow($result)) {
                $theme_name = $row['theme_name'];
                if(theme_exists($theme_name)) {
                    $themes[$theme_name]['theme_name']  = $row['theme_name'];
                    $themes[$theme_name]['custom_name'] = $row['custom_name'];
                    $themes[$theme_name]['groups']      = $row['groups'];
                    $themes[$theme_name]['permissions'] = $row['permissions'];
                    $themes[$theme_name]['active']      = $row['active'];
                }
            }
            $db->sql_freeresult($result);
            return $themes;
            break;
        case 'uninstalled':
            $uninstalled_themes = array();
            $themes = opendir(NUKE_THEMES_DIR);
            while(false !== ($theme_name = readdir($themes))) {
                if(is_dir(NUKE_THEMES_DIR . $theme_name) && $theme_name != "." && $theme_name != ".." && $theme_name != ".svn") {
                    $theme_installed = $db->sql_unumrows("SELECT theme_name FROM "._THEMES_TABLE." WHERE theme_name = '".$theme_name."'");
                    if ($theme_installed == 0) {
                        $uninstalled_themes[] = $theme_name;
                    }
                }
            }
            sort($uninstalled_themes);
            return $uninstalled_themes;
            break;
        case 'dir':
            $sql = "SELECT * FROM "._THEMES_TABLE." ORDER BY theme_name ASC";
            if (!$result = $db->sql_query($sql)) {
                $debugger->handle_error(_THEMES_ERROR_MESSAGE, _THEMES_ERROR);
            }
            $themes = array();
            while ($row=$db->sql_fetchrow($result)) {
                $theme_name = $row['theme_name'];
                $themes[$theme_name]['theme_name']  = $row['theme_name'];
                $themes[$theme_name]['custom_name'] = $row['custom_name'];
                $themes[$theme_name]['groups']      = $row['groups'];
                $themes[$theme_name]['permissions'] = $row['permissions'];
                $themes[$theme_name]['active']      = $row['active'];
            }
            $db->sql_freeresult($result);
            $dir = opendir(NUKE_THEMES_DIR);
            while(false !== ($theme_name = readdir($dir))) {
                if(is_dir(NUKE_THEMES_DIR . $theme_name) && $theme_name != "." && $theme_name != ".." && $theme_name != ".svn") {
                    $sql = "SELECT * FROM "._THEMES_TABLE." WHERE theme_name = '".$theme_name."'";
                    $theme_installed = $db->sql_unumrows($sql);
                    if ($theme_installed == 0) {
                        $theme_name = $theme_name;
                        $themes[$theme_name]['theme_name']  = $theme_name;
                        $themes[$theme_name]['custom_name'] = '';
                        $themes[$theme_name]['groups']      = '';
                        $themes[$theme_name]['permissions'] = '';
                        $themes[$theme_name]['active'] = '';
                    }
                }
            }
            return $themes;
            break;
    }
}

function GetThemeSelect($name, $mode='user_themes', $other_user=false, $extra='', $current='', $show_default=1) {
    global $userinfo;

    if(!$other_user) {
        $usertheme = $userinfo['theme'];
    } else {
        $usertheme = $other_user['theme'];
    }

    $themes = get_themes($mode);
    $select = "<select id='".$name."' name=\"" . $name . "\" $extra>";
    if($show_default) {
        $dSelect = "selected='selected'";
        $select .= "<option value=\"". $dSelect."\">"._THEMES_DEFAULT."</option>";
    }
    foreach($themes as $theme) {
        $name = (!empty($theme['custom_name'])) ? $theme['custom_name'] : $theme['theme_name'];
        $selected =  $show_default ? '' : (($usertheme == $theme['theme_name']) || ($current == $theme['theme_name'])) ? 'selected="selected"' : '';
        $select .= "<option value=\"" . $theme['theme_name'] . "\" $selected>" . $name . "</option>";
    }
    $select .= "</select>";
    return $select;
}


// Changed to be multilingual + cached
// by ReOrGaNiSatiOn
function LoadThemeInfo($theme) {
    global $db, $params, $default, $cache, $currentlang, $debugger, $theme_info;

    if(!empty($theme_info[$currentlang])) {
        return $theme_info[$currentlang];
    }
    if ((($theme_info = $cache->load($theme, 'themes')) === false) || empty($theme_info[$currentlang])) {
        $result = $db->sql_query("SELECT `ato_key`, `ato_value` FROM `"._THEMES_INFO_TABLE."` WHERE `theme_name` = '" . $theme . "' AND `language` = '".$currentlang."'");
        if ( $db->sql_numrows($result) > 0) {
            while($row = $db->sql_fetchrow($result)) {
                $ato_key = $row['ato_key'];
                $theme_info[$currentlang][$ato_key] = $row['ato_value'];
            }
            $db->sql_freeresult($result);
            $cache->save($theme, 'themes', $theme_info);
            return $theme_info[$currentlang];
        } else if ( !empty($default) && !empty($params) )  {
            for($i=0, $maxi = count($params);$i < $maxi;$i++) {
                $param = $params[$i];
                $theme_info[$currentlang][$param] = $default[$i];
                $db->sql_query("INSERT INTO `"._THEMES_INFO_TABLE."` (`theme_name`, `language`, `ato_key`, `ato_value`) VALUES ('". $theme."', '".$currentlang."', '".$param."', '".$default[$i]."')");
            }
            $cache->save($theme, 'themes', $theme_info);
            return $theme_info[$currentlang];
        } else {
            if (@file_exists(NUKE_THEMES_DIR.$theme.'/lang_'.$currentlang.'/theme_info.php')) {
                include(NUKE_THEMES_DIR.$theme.'/lang_'.$currentlang.'/theme_info.php');
            } elseif (@file_exists(NUKE_THEMES_DIR.$theme.'/theme_info.php')) {
                include(NUKE_THEMES_DIR.$theme.'/theme_info.php');
            } elseif (@file_exists(NUKE_THEMES_DIR.$theme.'/lang_english/theme_info.php')) {
                include(NUKE_THEMES_DIR.$theme.'/lang_english/theme_info.php');
            } else {
                $debugger->handle_error('There is an error in your themes configuration', 'Error');
            }
        }
    } else {
        return $theme_info[$currentlang];
    }
}

?>