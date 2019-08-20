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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$adminpoint = @basename(__FILE__,'.php');
global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin, $adminpoint, $evoconfig;

if (is_god_admin() || is_admin('super')) {
    getmodule_lang($adminpoint);

    $theme_input = $_GETVAR->get('theme_name', 'REQUEST', 'string');
    $op    = $_GETVAR->get('op', '_REQUEST', 'string');
    require_once(NUKE_CLASSES_DIR.'class.paginator.php');
    function theme_header() {
        global $admin_file, $adminpoint, $lang_admin, $evoconfig;
        OpenTable();
        echo "<center>"
        ."<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_HEADER'] . "</a>"
        ."<br /><br />"
        ."<table border='0' width='70%'><tr><td>"
        ."<img src='images/evo/ok.png' alt='' width='10' height='10' /></td><td>"
        ."<em>" . $lang_admin[$adminpoint]['THEMES_DEFAULT'] . "</em></td><td>" . $evoconfig['default_Theme'] . "</td>"
        ."</tr><tr><td>"
        ."<img src='images/evo/ok.png' alt='' width='10' height='10' /></td><td>"
        ."<em>" . $lang_admin[$adminpoint]['THEMES_NUMTHEMES'] . "</em></td><td>" . count(get_themes('all')) . "</td>"
        ."</tr><tr><td>"
        ."<img src='images/evo/ok.png' alt='' width='10' height='10' /></td><td>"
        ."<em>" . $lang_admin[$adminpoint]['THEMES_NUMUNINSTALLED'] . "</em></td><td>" . count(get_themes('uninstalled')) . "</td>"
        ."</tr>"
        ."<tr><td>"
        ."<img src='images/evo/ok.png' alt='' width='10' height='10' /></td><td>"
        ."<em>" . $lang_admin[$adminpoint]['THEMES_MOSTPOPULAR'] . "</em></td><td>" . ThemeMostPopular() . "</td>"
        ."</tr>"
        ."</table>"
        .'<br />'
        ."[ <a href='".$admin_file.".php?op=theme_users'>" . $lang_admin[$adminpoint]['THEMES_USER_OPTIONS'] . "</a> | <a href='".$admin_file.".php?op=theme_options'>" . $lang_admin[$adminpoint]['THEMES_OPTIONS'] . "</a> | <a href='".$admin_file.".php'>" . $lang_admin[$adminpoint]['THEMES_RETURNMAIN'] . "</a> ]"
        ."</center>";
        CloseTable();
        echo "<br />";
    }

    function theme_footer() {
        echo "<br />";
    }

    function display_main() {
        global $admin_file, $db, $ThemeInfo, $adminpoint, $lang_admin, $evoconfig, $cache;

        $installed_themes   = get_themes('all');
        $uninstalled_themes = get_themes('uninstalled');
        function make_a_row($theme_input) {
            global $admin_file, $ThemeInfo, $db, $adminpoint, $lang_admin, $evoconfig, $cache;

            if (!theme_exists($theme_input['theme_name'])) {
                if ($db->sql_uquery("DELETE FROM " . _THEMES_TABLE . " WHERE theme_name = '".$theme_input['theme_name']."'")) {
                    $db->sql_uquery("DELETE FROM " . _THEMES_INFO_TABLE . " WHERE theme_name = '".$theme_input['theme_name']."'");
                    $db->sql_uquery("UPDATE " . _USERS_TABLE . " SET theme = '" . $evoconfig['default_Theme'] . "' WHERE theme = '".$theme_input['theme_name']."'");
                    $cache->delete($theme_input['theme_name'], 'themes');
                }
                return ;
            }
            $bold = ($theme_input['theme_name'] == $evoconfig['default_Theme']) ? " style='font-weight: bold;'" : "";
            $theme_edit = "<img src='".evo_image('edit.png', '')."' alt='".$lang_admin[$adminpoint]['THEMES_EDIT']."' title='".$lang_admin[$adminpoint]['THEMES_EDIT']."' border='0' width='16' height='16' />";
            $default_link = ($theme_input['theme_name'] == $evoconfig['default_Theme'] || !theme_exists($theme_input['theme_name'])) ? "<img src='".evo_image('default.png', '')."' alt='".$lang_admin[$adminpoint]['THEMES_MAKEDEFAULT']."' title='".$lang_admin[$adminpoint]['THEMES_MAKEDEFAULT']."' border='0' width='16' height='16' />" : "<a href='".$admin_file.".php?op=theme_makedefault&amp;theme_name=" . $theme_input['theme_name'] . "'><img src='".evo_image('default.png', '')."' alt='".$lang_admin[$adminpoint]['THEMES_MAKEDEFAULT']."' title='".$lang_admin[$adminpoint]['THEMES_MAKEDEFAULT']."' border='0' width='16' height='16' /></a>";
            $activate_link = ($theme_input['theme_name'] == $evoconfig['default_Theme']) ? "<img src='".evo_image('deactivate.png', '')."' alt='".$lang_admin[$adminpoint]['THEMES_DEACTIVATE']."' title='".$lang_admin[$adminpoint]['THEMES_DEACTIVATE']."' border='0' width='16' height='16' />" : ($theme_input['active'] ? "<a href='".$admin_file.".php?op=theme_deactivate&amp;theme_name=" . $theme_input['theme_name'] . "'><img src='".evo_image('deactivate.png', '')."' alt='".$lang_admin[$adminpoint]['THEMES_DEACTIVATE']."' title='".$lang_admin[$adminpoint]['THEMES_DEACTIVATE']."' border='0' width='16' height='16' /></a>" : "<a href='".$admin_file.".php?op=theme_activate&amp;theme_name=" . $theme_input['theme_name'] . "'><img src='".evo_image('activate.png', '')."' alt='".$lang_admin[$adminpoint]['THEMES_ACTIVATE']."' title='".$lang_admin[$adminpoint]['THEMES_ACTIVATE']."' border='0' width='16' height='16' /></a>");
            //
            if($theme_input['permissions'] == 1) {
                $permissions = $lang_admin[$adminpoint]['THEMES_ALLUSERS'];
            } elseif ($theme_input['permissions'] == 2) {
                $permissions = $lang_admin[$adminpoint]['THEMES_GROUPSONLY'];
            } elseif ($theme_input['permissions'] == 3) {
                $permissions = $lang_admin[$adminpoint]['THEMES_ADMINS'];
            }
            echo  "<tr valign='middle' ".$bold.">"
            ."<td width='20%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'><img src='".NUKE_THEMES_MAIN_DIR . $theme_input['theme_name']."/images/thumb.png' alt='' /></td>\n"
            ."<td width='15%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $theme_input['theme_name'] . "</td>\n"
            ."<td width='15%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $theme_input['custom_name'] . "</td>\n"
            ."<td width='10%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . ThemeNumUsers($theme_input['theme_name']) . "</td>\n"
            ."<td width='10%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . ThemeGetStatus($theme_input['theme_name'], $theme_input['active']) . "</td>\n"
            ."<td width='10%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $permissions . "</td>\n"
            ."<td width='20%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'><small>&nbsp;<a href='".$admin_file.".php?op=theme_edit&amp;theme_name=" . $theme_input['theme_name'] . "'>" . $theme_edit . "</a> " . $default_link . " " . $activate_link . " <a href='javascript:themepreview(\"" . $theme_input['theme_name'] . "\")'><img src='".evo_image('view.png', '')."' alt='".$lang_admin[$adminpoint]['THEMES_VIEW']."' title='".$lang_admin[$adminpoint]['THEMES_VIEW']."' border='0' width='16' height='16' /></a>&nbsp;</small></td>\n"
            ."</tr>\n";
        }

        function CategoryOpen($text, $data) {
            global $adminpoint, $lang_admin, $ThemeInfo;

            echo  "<table border='1' align='center' width='99%' class='bodyline'>\n";
            echo "<tr>";
            echo  "<th height='20' width='100%' colspan='6' align='center'><strong>$text</strong></th>\n"
            ."</tr>"
            ."\n";
            echo  "\n";
            if(count($data) == 0) {
                echo  "<tr valign='middle'>"
                ."<td width='100%' colspan='6' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'><strong>" . $lang_admin[$adminpoint]['THEMES_NONE'] . "</strong></td>\n"
                ."</tr>\n";
            }
        }
        function CategoryClose() {
            global $adminpoint, $lang_admin;

            echo  "</table>\n";
        }

        OpenTable();
        echo  "<table border='2' align='center' width='99%'>\n"
        ."<tr>"
        ."<th width='20%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_PREVIEW'] . "</strong></span></th>\n"
        ."<th width='15%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_NAME'] . "</strong></span></th>\n"
        ."<th width='15%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_CUSTOMN'] . "</strong></span></th>\n"
        ."<th width='10%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_NUMUSERS'] . "</strong></span></th>\n"
        ."<th width='10%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_STATUS'] . "</strong></span></th>\n"
        ."<th width='10%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_PERMISSIONS'] . "</strong></span></th>\n"
        ."<th width='20%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_OPTS']. "</strong></span></th>\n"
        ."</tr>"
        ."</table>"
        ."<br /><br />\n";
        echo  "<table border='1' align='center' width='99%'>\n";
        echo  "\n<tr>"
        ."<th width='100%' align='center' colspan='6'><span class='title'><strong>" . $lang_admin[$adminpoint]['THEMES_INSTALLED'] . "</strong></span></th>\n"
        ."\n"
        ."</tr>"
        ."</table>"
        ."<br />\n\n";
        echo  "<table border='1' align='center' width='99%'>\n";
        if(count($installed_themes) == 0) {
            echo  "<tr valign='middle'>"
            ."<td width='100%' colspan='6' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'><strong>" . $lang_admin[$adminpoint]['THEMES_NONE'] . "</strong></td>\n"
            ."</tr>\n";
        } else {
            if (is_array($installed_themes)) {
                foreach($installed_themes as $theme_input) {
                    make_a_row($theme_input);
                }
            }
        }
        echo "</table>\n";
        echo  "<br /><table border='1' align='center' width='99%'>\n";
        echo  "<tr>\n"
        ."<th width='100%' align='center' colspan='6'><span class='title'><strong>" . $lang_admin[$adminpoint]['THEMES_UNINSTALLED'] . "</strong></span></th>\n"
        ."\n"
        ."</tr>"
        ."</table>"
        ."<br />\n\n";
        echo  "<table border='1' align='center' width='99%'>\n";
        echo  "\n";
        if(count($uninstalled_themes) == 0) {
            echo  "<tr valign='middle'>"
            ."<td width='100%' colspan='6' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'><strong>" . $lang_admin[$adminpoint]['THEMES_NONE'] . "</strong></td>\n"
            ."</tr>\n";
        }
        if (is_array($uninstalled_themes)) {
            foreach($uninstalled_themes as $theme_input) {
                echo  "<tr valign='middle'>"
                ."<td width='40%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $theme_input . "</td>\n"
                ."<td width='20%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . ThemeGetStatus($theme_input) . "</td>\n"
                ."<td width='40%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'><small>[ <a href='".$admin_file.".php?op=theme_quickinstall&amp;theme_name=" . $theme_input . "'>" . $lang_admin[$adminpoint]['THEMES_QINSTALL'] . "</a> | <a href='".$admin_file.".php?op=theme_install&amp;theme_name=" . $theme_input . "'>" . $lang_admin[$adminpoint]['THEMES_INSTALL'] . "</a> | <a href='".$admin_file.".php?op=theme_makedefault&amp;theme_name=" . $theme_input . "'>" . $lang_admin[$adminpoint]['THEMES_MAKEDEFAULT'] . "</a> | <a href='javascript:themepreview(\"" . $theme_input . "\")'>" . $lang_admin[$adminpoint]['THEMES_VIEW'] . "</a> ]</small></td>\n"
                ."</tr>\n";
            }
        }
        echo  "</table>\n";
        CloseTable();
    }

    // Function to change ATO infomations stored into database
    // by ReOrGaNiSaTiOn
    function theme_changeato() {
        global $db, $evoconfig, $ThemeInfo, $admin_file, $adminpoint, $lang_admin, $_GETVAR;

        $theme_name = $_GETVAR->get('theme_name', 'REQUEST', 'string', '');
        OpenTable();
        $theme_langinfo = theme_check_ato($theme_name);
        // Let`s have a look into database if we have ato-values for this theme
        $result = $db->sql_query("SELECT `ato_key`, `ato_value`, `language` FROM `"._THEMES_INFO_TABLE."` WHERE `theme_name` = '" . $theme_name . "'");
        if ( $db->sql_numrows($result) > 0) {
            while($row = $db->sql_fetchrow($result)) {
                $ato_key = $row['ato_key'];
                $language = $row['language'];
                $theme_info_db[$language][$ato_key] = $row['ato_value'];
            }
            $db->sql_freeresult($result);
        }
        // ok ... now we wants to have the theme_info values as default values
        if ( ($theme_langinfo['is_ato'] == TRUE) && ($theme_langinfo['multilang'] == TRUE) ) {
            $theme_languages = $theme_langinfo['language'];
            for ($i=0, $maxi=count($theme_langinfo['count_lang']); $i < $maxi; $i++) {
                if (!empty($theme_languages[$i]) ) {
                    $theme_lang = $theme_languages[$i];
                    include(NUKE_THEMES_DIR.$theme_name.'/lang_'.$theme_lang.'/theme_info.php');
                    for($y=0, $maxi = count($params);$y < $maxi;$y++) {
                        $param = $params[$y];
                        $theme_info_file[$theme_lang][$param] = $default[$y];
                    }
                }
            }
        } elseif ( $theme_langinfo['is_ato'] == TRUE ) {
                $theme_languages = lang_list();
                include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');
                for ($i=0, $maxi=count($theme_languages); $i < $maxi; $i++) {
                    if (!empty($theme_languages[$i]) ) {
                        $theme_lang = $theme_languages[$i];
                        include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');
                        for($y=0, $maxi = count($params);$y < $maxi;$y++) {
                            $param = $params[$y];
                            $theme_info_file[$theme_lang][$param] = $default[$y];
                        }
                    }
                }
        } else {
            die('hier ist noch keine lösung');
        }
        // now we go into the loop for every language available in our system
        $languageslist = lang_list();
        if (empty($languageslist) ) { $languageslist[0] = $evoconfig['default_lang'];}
        echo "<form action='".$admin_file.".php' method='post'>";
        for ($i=0, $maxi=count($languageslist); $i < $maxi; $i++) {
              $theme_language = trim($languageslist[$i]);
              $y = 0;
              if (!empty($theme_info_file[$theme_language])) {
                  echo "<fieldset><legend><strong>".ucfirst($theme_language)."</strong></legend><table border='2' width='100%'>";
                  echo "<tr bgcolor='".$ThemeInfo['bgcolor1']."'><td><span class='content'><strong>". $lang_admin[$adminpoint]['THEMES_ATO_KEY'] ."</strong></span></td><td><span class='content'><strong>". $lang_admin[$adminpoint]['THEMES_DEFAULT_VALUE'] ."</strong></span></td><td><span class='content'><strong>". $lang_admin[$adminpoint]['THEMES_DB_VALUE'] ."</strong></span></td></tr>";
                  foreach($theme_info_file[$theme_language] as $key => $default)  {
                        echo "<tr><td>".$key."</td><td>".$default."</td><td>";
                        if (empty($theme_info_db[$theme_language][$key])) {
                              $theme_info_db[$theme_language][$key] = $default;
                        }
                        echo "<input type='text' name='param[".$theme_language."][".$key."]' value='".$theme_info_db[$theme_language][$key]."' lenght='100' size='50' /></td></tr>";
                  }
                  echo "</table></fieldset><br />";
              }
              echo "<br /><table border='0' width='100%'>";
              echo "<tr><td align='center' colspan='2'>";
              echo "<input type='hidden' name='language[".$theme_language."]' value='" . $theme_language . "' />";
              echo "<input type='hidden' name='theme_name' value='" . $theme_name . "' />";
              echo "<input type='hidden' name='op' value='theme_ato_save' />";
              echo "<input type='submit' value='".$lang_admin[$adminpoint]['THEMES_SAVECHANGES']."' /></td></tr>";
              echo "<tr><td align='center' colspan='2'>"._GOBACK."</td></tr>";
              echo "</table>";
        }
        echo "</form>";
        CloseTable();
    }

    // Function to check if Theme is ATO compatible + to get some infos
    // by ReOrGaNiSaTiOn
    function theme_check_ato($theme_name) {
        global $adminpoint, $lang_admin;
            $languageslist = lang_list();
            $theme_multilang = $theme_is_ato = FALSE;
            $count_themelang = 0;
            $ato_image = '';
            if ( @file_exists(NUKE_THEMES_DIR.$theme_name.'/theme_info.php') ) {
                  $theme_multilang = FALSE;
                  $theme_is_ato = TRUE;
            } else {
                  $theme_multilang = FALSE;
                  $theme_is_ato = FALSE;
            }
            if ( !empty($languageslist) ) {
                for ($i=0, $maxi=count($languageslist); $i < $maxi; $i++) {
                    if(!empty($languageslist[$i])) {
                        $theme_language = trim($languageslist[$i]);
                        $theme_lang[$theme_language] = (@file_exists(NUKE_THEMES_DIR.$theme_name.'/lang_'.$theme_language.'/theme_info.php')) ? TRUE : FALSE;
                        if ($theme_lang[$theme_language] == TRUE) {
                            $theme_lang_infos['language'][$count_themelang] = $theme_language;
                            $count_themelang++;
                        }
                    }
                }
                if ($count_themelang > 0) {
                    $theme_multilang = TRUE;
                    $theme_is_ato = TRUE;
                } else {
                    $theme_multilang = FALSE;
                }
            }
            if ($theme_multilang == TRUE) {
                $theme_lang_infos['info_multilang'] = "<tr><td align='center'><img src='".evo_image('ok.png', 'evo')."' alt='' width='10' height='10' /> " . $lang_admin[$adminpoint]['THEMES_MULTLANG_COMP'] . "</td></tr>";
            } else {
                $theme_lang_infos['info_multilang'] = "<tr><td align='center'><img src='".evo_image('bad.png', 'evo')."' alt='' width='10' height='10' /> " . $lang_admin[$adminpoint]['THEMES_NOT_MULTLANG_COMP'] . "</td></tr>";
            }
            if ($theme_is_ato == TRUE) {
                $theme_lang_infos['info_is_ato'] = "<tr><td align='center'><img src='".evo_image('ok.png', 'evo')."' alt='' width='10' height='10' /> " . $lang_admin[$adminpoint]['THEMES_ADV_COMP'] . "</td></tr>";
            } else {
                $theme_lang_infos['info_is_ato'] = "<tr><td align='center'><img src='".evo_image('bad.png', 'evo')."' alt='' width='10' height='10' /> " . $lang_admin[$adminpoint]['THEMES_NOT_COMPAT'] . "</td></tr>";
            }
            $theme_lang_infos['multilang'] = $theme_multilang;
            $theme_lang_infos['is_ato'] = $theme_is_ato;
            $theme_lang_infos['count_lang'] = $count_themelang;
            return $theme_lang_infos;
    }

    // function so save ATO values into database
    // by ReOrGaNiSaTiOn
    function theme_ato_save() {
        global $db, $_GETVAR, $cache, $admin_file, $adminpoint, $lang_admin;

        $form_language = $_GETVAR->get('language', '_POST', 'array');
        $form_param    = $_GETVAR->get('param', '_POST', 'array');
        $theme_name    = $_GETVAR->get('theme_name', '_POST', 'string');
        $error = 0;
        $result = $db->sql_query("SELECT `ato_key`, `ato_value`, `language` FROM `"._THEMES_INFO_TABLE."` WHERE `theme_name` = '" . $theme_name . "'");
        if ( $db->sql_numrows($result) > 0) {
            while($row = $db->sql_fetchrow($result)) {
                $ato_key = $row['ato_key'];
                $language = $row['language'];
                $theme_info_db[$language][$ato_key] = $row['ato_value'];
            }
            $db->sql_freeresult($result);
        }
        foreach($form_language as $db_language)  {
                foreach($form_param[$db_language] as $key => $default)  {
                    $param = $default;
                    $theme_info[$db_language][$key] = $param;
                    if ( isset($theme_info_db[$db_language][$key]) ) {
                        $sql = "UPDATE `"._THEMES_INFO_TABLE."` set `ato_value` = '".$theme_info[$db_language][$key]."' WHERE `theme_name`= '" . $theme_name . "' AND `language` = '". $db_language ."' AND `ato_key` = '". $key ."'";
                    } else {
                        $sql = "INSERT INTO `"._THEMES_INFO_TABLE."` (`theme_name`, `language`, `ato_key`, `ato_value`) VALUES ('". $theme_name ."', '".$db_language."', '".$key."', '".$param."')";
                    }
                    if (!$db->sql_query($sql)) {$error++;}
                }
        }
        $cache->delete($theme_name, 'themes');
        $cache->delete('evoconfig', 'config');
        if($error == 0) {
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['THEMES_UPDATED'] . "</strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=theme_edit&amp;theme_name=".$theme_name."'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        } else {
            OpenTable();
                echo "<center>\n";
                echo "<strong><font color='red'>" . $lang_admin[$adminpoint]['THEMES_UPDATEFAILED'] . "</font></strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=theme_edit&amp;theme_name=".$theme_name."'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        }
    }

    function theme_edit($theme_name) {
        global $db, $admin_file, $ThemeInfo, $adminpoint, $lang_admin, $evoconfig;

        $theme_info = $db->sql_ufetchrow("SELECT * FROM " . _THEMES_TABLE . " WHERE theme_name = '".$theme_name."'");
        OpenTable();
        $theme_langinfos = theme_check_ato($theme_info['theme_name']);
        echo "<div align='center'><table align='center' border='0' cellpadding='2' cellspacing='2'>"
        ."<tr>"
        ."<td align='center' colspan='2' class='option'><strong>". $theme_info['theme_name'] ."</strong></td>"
        ."</tr>";
        if( $theme_info['theme_name'] == $evoconfig['default_Theme']) {
        echo"<tr>"
        ."<td align='center' colspan='2' class='option'><strong>( ".$lang_admin[$adminpoint]['THEMES_DEFAULT']." )</strong></td>"
        ."</tr>";
        }
        echo"<tr>";
        if( $theme_info['theme_name'] == $evoconfig['default_Theme']) {
            echo "<td align='center' colspan='2' class='option'>[ <strike>" . $lang_admin[$adminpoint]['THEMES_MAKEDEFAULT'] . "</strike> | <strike>" . $lang_admin[$adminpoint]['THEMES_UNINSTALL'] . "</strike> ]";
        } else {
            echo "<td align='center' colspan='2' class='option'>[ <a href='".$admin_file.".php?op=theme_makedefault&amp;theme_name=" . $theme_info['theme_name'] . "'>" . $lang_admin[$adminpoint]['THEMES_MAKEDEFAULT'] . "</a> | <a href='".$admin_file.".php?op=theme_uninstall&amp;theme_name=" . $theme_info['theme_name'] . "'>" . $lang_admin[$adminpoint]['THEMES_UNINSTALL'] . "</a> ]";
        }
        if ($theme_langinfos['is_ato'] == TRUE) {
            echo " | [ <a href='".$admin_file.".php?op=theme_changeato&amp;theme_name=" . $theme_info['theme_name'] . "'>" . $lang_admin[$adminpoint]['THEMES_CHANGEATO'] . "</a>]";
        }
        echo"</td></tr></table></div><br />";
        echo "<fieldset><table border='0' width='100%'>";
        echo $theme_langinfos['info_multilang'];
        echo $theme_langinfos['info_is_ato'];
        echo "</table></fieldset>";
        echo "<div align='center'>"
        ."<form action='".$admin_file.".php' method='get'>"
        ."<table align='center' border='0' cellpadding='2' cellspacing='2'>"
        ."<tr>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."'>" . $lang_admin[$adminpoint]['THEMES_CUSTOMNAME'] . "</td>"
        ."<td><input type='text' name='custom_name' value='".$theme_info['custom_name']."' size='50' /></td>"
        ."</tr>";
        $selected1 = ($theme_info['permissions'] == 1) ? "selected='selected'" : "";
        $selected2 = ($theme_info['permissions'] == 2) ? "selected='selected'" : "";
        $selected3 = ($theme_info['permissions'] == 3) ? "selected='selected'" : "";
        if( $theme_info['theme_name'] == $evoconfig['default_Theme']) {
            $disabled = "disabled";
            $selected1 = "selected='selected'";
            $selected2 = "";
            $selected3 = "";
        } else {
            $disabled = "";
        }
        echo"<tr>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."'>" . $lang_admin[$adminpoint]['THEMES_ACTIVE'] . "</td>";
        $yes_selected = ($theme_info['active']) ? "selected='selected'" : "";
        $no_selected = (!$theme_info['active']) ? "selected='selected'" : "";
        echo"<td><select name='active' ".$disabled." ><option value='1' ".$yes_selected.">" . $lang_admin[$adminpoint]['THEMES_YES'] . "</option><option value='0' ".$no_selected.">" . $lang_admin[$adminpoint]['THEMES_NO'] . "</option></select></td>"
        ."</tr>";
        if( $theme_info['theme_name'] == $evoconfig['default_Theme']) {
            echo "<input type='hidden' name='active' value='1' />";
            echo "<input type='hidden' name='permissions' value='1' />";
        }
        echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'>" . $lang_admin[$adminpoint]['THEMES_PRIVILEGES'] . "</td><td><select name='permissions' $disabled>"
        ."<option value='1' ".$selected1.">" . $lang_admin[$adminpoint]['THEMES_ALLUSERS'] . "</option>"
        ."<option value='2' ".$selected2.">".$lang_admin[$adminpoint]['THEMES_GROUPSONLY']."</option>"
        ."<option value='3' ".$selected3.">" . $lang_admin[$adminpoint]['THEMES_ADMINS'] . "</option>"
        ."</select></td></tr>";
        echo "<tr><td valign='top' bgcolor='".$ThemeInfo['bgcolor2']."'>".$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS'].":</td><td><span class='tiny'>".$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS_INFO']."</span><br /><select name='groups[]' multiple='multiple' size='5'>";
        $ingroups = explode("-",$theme_info['groups']);
        $groupsResult = $db->sql_query("SELECT group_id, group_name FROM ".GROUPS_TABLE." WHERE group_description <> 'Personal User'");
        while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
            if(in_array($gid,$ingroups)) { $sel = "selected='selected'"; } else { $sel = ""; }
                      echo "<option value='".$gid."' ".$sel.">".$gname."</option>";
        }
        $db->sql_freeresult($result);
        echo "</select></td></tr>";
        echo "<tr><td align='center' colspan='2'><br />";
        echo "<input type='hidden' name='theme_name' value='" . $theme_info['theme_name'] . "' />";
        echo "<input type='hidden' name='op' value='theme_edit_save' />";
        echo "<input type='submit' value='".$lang_admin[$adminpoint]['THEMES_SAVECHANGES']."' /></td></tr>";
        echo "<tr><td align='center' colspan='2'>"._GOBACK."</td></tr>";
        echo "</table></form></div>";
        CloseTable();
    }

    // Changed to edit ATO values in separate form
    // by ReOrGaNiSaTiOn
    function theme_install() {
        global $db, $admin_file, $adminpoint, $lang_admin, $_GETVAR, $ThemeInfo;

        $theme_name = $_GETVAR->get('theme_name', '_REQUEST', 'string');
        OpenTable();
        $theme_langinfos = theme_check_ato($theme_name);
        echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>"
        ."<tr>"
        ."<td align='center' colspan='2' class='option'><strong>". $theme_name ."</strong></td>";
        echo"</tr></table><br />";
        echo "<fieldset><table border='0' width='100%'>";
        echo $theme_langinfos['info_multilang'];
        echo $theme_langinfos['info_is_ato'];
        echo "</table></fieldset><br />";
        echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>"
        ."<form action='".$admin_file.".php' method='get'>"
        ."<tr>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."'>" . $lang_admin[$adminpoint]['THEMES_CUSTOMNAME'] . "</td>"
        ."<td><input type='text' name='custom_name' value='".$theme_name."' size='50' /></td>"
        ."</tr>";
        echo"<tr>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."'>" . $lang_admin[$adminpoint]['THEMES_ACTIVE'] . "</td>";
        echo"<td><select name='active'><option value='1' selected='selected'>" . $lang_admin[$adminpoint]['THEMES_YES'] . "</option><option value='0'>" . $lang_admin[$adminpoint]['THEMES_NO'] . "</option></select></td>"
        ."</tr>";
        echo "<tr><td>" . $lang_admin[$adminpoint]['THEMES_PRIVILEGES'] . "</td><td><select name='permissions'>"
        ."<option value='1' selected='selected'>" . $lang_admin[$adminpoint]['THEMES_ALLUSERS'] . "</option>"
        ."<option value='2'>".$lang_admin[$adminpoint]['THEMES_GROUPSONLY']."</option>"
        ."<option value='3'>" . $lang_admin[$adminpoint]['THEMES_ADMINS'] . "</option>"
        ."</select></td></tr>";
        echo "<tr><td valign='top'>".$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS'].":</td><td><span class='tiny'>".$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS_INFO']."</span><br /><select name='groups[]' multiple size='5'>";
        $ingroups = explode("-",$theme_info['groups']);
        $groupsResult = $db->sql_query("select group_id, group_name from ".GROUPS_TABLE." WHERE group_description <> 'Personal User'");
        while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
            if(in_array($gid,$ingroups)) { $sel = "selected='selected'"; } else { $sel = ""; }
                      echo "<option value='".$gid."' ".$sel.">$gname</option>";
        }
        echo "</select></td></tr>";
        echo "<input type='hidden' name='theme_name' value='" . $theme_name . "' />";
        echo "<input type='hidden' name='op' value='theme_install_save' />";
        echo "<tr><td align='center' colspan='2'><input type='submit' value=".$lang_admin[$adminpoint]['THEMES_INSTALL']." /></td></tr>";
        if ($theme_langinfos['is_ato'] == TRUE) {
            echo "<tr><td align='center' colspan='2'>" . $lang_admin[$adminpoint]['THEMES_INFO_CHANGEATO'] . "</td></tr>";
        }
        echo "<tr><td align='center' colspan='2'>"._GOBACK."</td></tr>";
            echo "</table></form>";
        CloseTable();
    }

    function update_theme() {
        global $evoconfig, $db, $admin_file, $cache, $adminpoint, $lang_admin, $_GETVAR;

        $custom_name = $_GETVAR->get('custom_name', '_GET', 'string');
        $theme_name  = $_GETVAR->get('theme_name', '_GET', 'string');
        $permissions = $_GETVAR->get('permissions', '_GET', 'int');
        $groups      = $_GETVAR->get('groups', '_GET', 'array');
        $active      = $_GETVAR->get('active', '_GET', 'int');
        $error = false;
        if(is_array($groups)) {
            $groups = implode('-', $groups);
        }
        $sql[] = "UPDATE " . _THEMES_TABLE . " SET custom_name = '" . $custom_name . "' WHERE theme_name = '" . $theme_name . "'";
        $sql[] = "UPDATE " . _THEMES_TABLE . " SET active = '" . $active . "' WHERE theme_name = '" . $theme_name . "'";
        $sql[] = "UPDATE " . _THEMES_TABLE . " SET permissions = '" . $permissions . "' WHERE theme_name = '" . $theme_name . "'";
        if (($permissions > 1) || (!$active )) {
            $sql[] = "UPDATE " . _USERS_TABLE . " SET theme = '" . $evoconfig['default_Theme'] . "' WHERE theme = '" . $theme_name . "'";
        }
        $sql[] = "UPDATE " . _THEMES_TABLE . " SET groups = '" . $groups . "' WHERE theme_name = '" . $theme_name . "'";
        foreach($sql as $query) {
            if(!$db->sql_query($query)) {
                $error = true;
            }
        }
        $cache->delete($theme_name, 'themes');
        if(!$error) {
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['THEMES_UPDATED'] . "</strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        } else {
            OpenTable();
                echo "<center>\n";
                echo "<strong><font color='red'>" . $lang_admin[$adminpoint]['THEMES_UPDATEFAILED'] . "</font></strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        }
    }

    function install_save() {
        global $db, $admin_file, $adminpoint, $lang_admin, $_GETVAR;

        $groups      = $_GETVAR->get('groups', '_GET', 'array');
        $groups      = (is_array($groups)) ? implode('-', $groups) : '';
        $theme_name  = $_GETVAR->get('theme_name', '_GET', 'string');
        $permissions = $_GETVAR->get('permissions', '_GET', 'int');
        $custom_name = $_GETVAR->get('custom_name', '_GET', 'string');
        $active      = $_GETVAR->get('active', '_GET', 'int');
        $sql = "INSERT INTO " . _THEMES_TABLE . " (`theme_name`, `groups`, `permissions`, `custom_name`, `active`) VALUES('" . $theme_name . "', '" . $groups . "', '" . $permissions . "', '" . $custom_name . "', '" . $active . "')";
        if($db->sql_query($sql)) {
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['THEMES_THEME_INSTALLED'] . "</strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        } else {
            OpenTable();
                echo "<center>\n";
                echo "<strong><font color='red'>" . $lang_admin[$adminpoint]['THEMES_THEME_INSTALLED_FAILED'] . "</font></strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        }
    }

    function uninstall_theme($theme_input) {
        global $db, $admin_file, $cache, $adminpoint, $lang_admin, $_GETVAR, $evoconfig;

        $confirm = $_GETVAR->get('confirm', '_POST', 'int');
        function uninstall_success() {
            global $admin_file, $lang_admin, $adminpoint;
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED'] . "</strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        }
        function uninstall_failed(){
            global $admin_file, $lang_admin, $adminpoint;
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED_FAILED'] . "</strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        }
        if(!$confirm) {
            OpenTable();
                echo "<form name='confirm_uninstall' action='".$admin_file.".php' method='post'><center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['THEMES_UNINSTALL1'] . "</strong><br /><br />\n";
                echo $lang_admin[$adminpoint]['THEMES_UNINSTALL2'] . "<br />\n";
                echo $lang_admin[$adminpoint]['THEMES_UNINSTALL3'] . "<br /><br />";
                echo "<input type='hidden' name='theme_name' value='".$theme_input."' />";
                echo "<input type='hidden' name='op' value='theme_uninstall' />";
                echo "<input type='hidden' name='confirm' value='1' />";
                echo "<a href='javascript:document.confirm_uninstall.submit()'>" . $lang_admin[$adminpoint]['THEMES_THEME_UNINSTALL'] . "</a><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center></form>\n";
            CloseTable();
            return false;
        } else {
            if( $theme_input != $evoconfig['default_Theme']) {
                if ($db->sql_query("DELETE FROM " . _THEMES_TABLE . " WHERE theme_name = '".$theme_input."'")) {
                    $db->sql_uquery("DELETE FROM " . _THEMES_INFO_TABLE . " WHERE theme_name = '".$theme_input."'");
                    $db->sql_uquery("UPDATE " . _USERS_TABLE . " SET theme = '" . $evoconfig['default_Theme'] . "' WHERE theme = '".$theme_input."'");
                    $cache->delete($theme_input, 'themes');
                    uninstall_success();
                    return true;
                }
            }
            uninstall_failed();
            return false;
        }
        uninstall_failed();
        return false;
    }

    function theme_makedefault() {
        global $db, $admin_file, $cache, $adminpoint, $lang_admin, $_GETVAR;

        $theme_input = $_GETVAR->get('theme_name', 'GET', 'string', '');
        if (empty($theme_input)) {
            return;
        }
        if(!theme_installed($theme_input)) {
            $db->sql_uquery("INSERT INTO " . _THEMES_TABLE . " (`theme_name`, `groups`, `permissions`, `custom_name`, `active`)
                     VALUES('".$theme_input."', '', '1', '".$theme_input."', '1')");
        }
        $db->sql_uquery("UPDATE " . _THEMES_TABLE . " SET active = '1' WHERE theme_name = '".$theme_input."'");
        $db->sql_uquery("UPDATE " . _NUKE_CONFIG_TABLE . " SET default_Theme = '".$theme_input."'");
        $db->sql_uquery("UPDATE " . _THEMES_TABLE . " SET permissions = '1' WHERE theme_name = '".$theme_input."'");
        $cache->delete('evoconfig', 'config');
        redirect($admin_file . '.php?op=themes');
    }

    function theme_deactivate() {
        global $db, $admin_file, $cache, $adminpoint, $lang_admin, $_GETVAR, $evoconfig;

        $confirm     = $_GETVAR->get('confirm', '_POST', 'int');
        $theme_input = $_GETVAR->get('theme_name', 'REQUEST', 'string', '');

        function deactivate_success() {
            global $admin_file, $lang_admin, $adminpoint;
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED'] . "</strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        }
        function deactivate_failed(){
            global $admin_file, $lang_admin, $adminpoint;
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED_FAILED'] . "</strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        }

        if(!$confirm) {
            OpenTable();
                echo "<form name='confirm_deactivate' action='".$admin_file.".php' method='post'><center>\n";
                echo "<strong>" . $lang_admin[$adminpoint]['THEMES_DEACTIVATE1'] . "</strong><br /><br />\n";
                echo $lang_admin[$adminpoint]['THEMES_DEACTIVATE2'] . "<br /><br />";
                echo "<input type='hidden' name='theme_name' value='".$theme_input."' />";
                echo "<input type='hidden' name='op' value='theme_deactivate' />";
                echo "<input type='hidden' name='confirm' value='1' />";
                echo "<a href='javascript:document.confirm_deactivate.submit()'>" . $lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATE'] . "</a><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center></form>\n";
            CloseTable();
            return false;
        } else {
            if( $theme_input != $evoconfig['default_Theme']) {
                if ($db->sql_query("UPDATE " . _THEMES_TABLE . " SET active='0' WHERE theme_name = '".$theme_input."'")) {
                    if($db->sql_query("UPDATE " . _USERS_TABLE . " SET theme = '" . $evoconfig['default_Theme'] . "' WHERE theme = '".$theme_input."'")){
                        $cache->delete($theme_input, 'themes');
                        deactivate_success();
                        return true;
                    }
                }
            }
            deactivate_failed();
            return false;
        }
    }

    function theme_options() {
        global $db, $admin_file, $cache, $adminpoint, $lang_admin, $_GETVAR;

        $mode = $_GETVAR->get('act', '_REQUEST', 'string');
        if(!$mode) {$mode = 'main';}
        switch($mode) {
            case 'main':
                list($usrthemeselect) = $db->sql_ufetchrow("SELECT config_value FROM " . _CNBYA_CONFIG_TABLE . " WHERE config_name = 'allowusertheme'");
                $thmselect_selected_yes = ($usrthemeselect == 1) ? "selected='selected'" : "";
                $thmselect_selected_no  = ($usrthemeselect == 0) ? "selected='selected'" : "";
                OpenTable();
                echo "<form action='".$admin_file.".php' method='get'><center>"
                    ."<strong>" . $lang_admin[$adminpoint]['THEMES_MANG_OPTIONS'] . "</strong><br /><br />\n"
                    ."[ <a href='" . $admin_file . ".php?op=theme_transfer'>" . $lang_admin[$adminpoint]['THEMES_TRANSFER'] . "</a> ]<br /><br />"
                    ."<table border='1' class='bodyline' width='30%'>"
                    ."<tr><td class='row2'>"
                    .$lang_admin[$adminpoint]['THEMES_ALLOWCHANGE']
                    ."</td><td class='row3'>"
                    ."<select name='allowusertheme'><option value='1' ".$thmselect_selected_yes.">" . $lang_admin[$adminpoint]['THEMES_YES'] . "</option><option value='0' ".$thmselect_selected_no.">" . $lang_admin[$adminpoint]['THEMES_NO'] . "</option></select>"
                    ."</td></tr>"
                    ."<tr><td class='row2' colspan='2' align='center'>"
                    ."<input type='hidden' name='op' value='theme_options' />"
                    ."<input type='hidden' name='act' value='save' />"
                    ."<input type='submit' value='" . $lang_admin[$adminpoint]['THEMES_SUBMIT'] . "' />"
                    ."</td></tr>"
                    ."</table>"
                    ."<br />"
                    ."</center></form>";
                CloseTable();
            break;
            case 'save':
                $allowusertheme = $_GETVAR->get('allowusertheme', '_GET', 'int');
                $db->sql_uquery("UPDATE " . _CNBYA_CONFIG_TABLE . " SET config_value = '" . $allowusertheme . "' WHERE config_name = 'allowusertheme'");
                $cache->delete('evoconfig', 'config');
                OpenTable();
                    echo "<center>\n";
                    echo "<strong>" . $lang_admin[$adminpoint]['THEMES_SETTINGS_UPDATED'] . "</strong><br /><br />\n";
                    echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                    echo "</center>\n";
                CloseTable();
            break;
        }
        return true;
    }

    function theme_transfer() {
        global $db, $admin_file, $adminpoint, $lang_admin, $_GETVAR;

        $transfer = $_GETVAR->get('transfer', '_POST', 'int');
        if(!$transfer) {
            $from_themes = get_themes('dir');
            $to_themes   = get_themes('all');
            OpenTable();
                echo "<form action='".$admin_file.".php' method='post'><center>"
                ."<strong>" . $lang_admin[$adminpoint]['THEMES_THEME_TRANSFER'] . "</strong><br />\n"
                ."[ <a href='" . $admin_file . ".php?op=theme_options'>" . $lang_admin[$adminpoint]['THEMES_RETURN_OPTIONS'] . "</a> ]<br /><br />"
                ."<table border='0' width='30%'>"
                ."<tr><td align='center'>"
                .$lang_admin[$adminpoint]['THEMES_FROM']
                ."</td><td align='center'>"
                .$lang_admin[$adminpoint]['THEMES_TO']
                ."</td></tr>"
                ."<tr><td align='center'>"
                ."<select name='from'>"
                ."<option value='all'>" . $lang_admin[$adminpoint]['THEMES_ALLUSERS'] . "</option>";
                foreach($from_themes as $theme_input) {
                     echo "<option value='" . $theme_input['theme_name'] . "'>" . (($theme_input['custom_name']) ? $theme_input['custom_name'] : $theme_input['theme_name']) . " (" . ThemeNumUsers($theme_input['theme_name']) . ")</option>";
                }
                echo "</select>"
                ."</td><td align='center'>"
                ."<select name='to'>"
                ."<option value='default'>" . $lang_admin[$adminpoint]['THEMES_DEFAULT'] . "</option>";
                foreach($to_themes as $theme_input) {
                     echo"<option value='" . $theme_input['theme_name'] . "'>" . (($theme_input['custom_name']) ? $theme_input['custom_name'] : $theme_input['theme_name']) . "</option>";
                }
                echo "</select>"
                ."</td></tr>"
                ."<tr><td colspan='2' align='center'>"
                ."<input type='hidden' name='transfer' value='1' />"
                ."<input type='hidden' name='op' value='theme_transfer' />"
                ."<input type='submit' value='" . $lang_admin[$adminpoint]['THEMES_SUBMIT'] . "' />"
                ."</td></tr>"
                ."</table>"
                ."<br />"
                ."</center></form>";
            CloseTable();
        } else {
            $from = $_GETVAR->get('from', '_POST', 'string');
            $to   = $_GETVAR->get('to', '_POST', 'string');
            $where = ($from == 'all') ? "WHERE user_id <> '1'" : "WHERE theme='" . $from . "' AND user_id <> '1'";
            $to   = ($to == 'default') ? "" : $to;
            $result = $db->sql_uquery("UPDATE " . _USERS_TABLE . " SET theme = '" . $to . "' $where");
            $count = intval($db->sql_affectedrows($result));
            OpenTable();
                echo "<center>\n";
                echo "<strong>$count " . $lang_admin[$adminpoint]['THEMES_TRANSFER_UPDATED'] . "</strong><br /><br />\n";
                echo "<a href='".$admin_file.".php?op=themes'>" . $lang_admin[$adminpoint]['THEMES_RETURN'] . "</a>\n";
                echo "</center>\n";
            CloseTable();
        }
        return true;
    }

    function users_themes() {
    global $db, $admin_file, $theme, $ThemeInfo, $_GETVAR, $adminpoint, $lang_admin, $evoconfig;

        $page = $_GETVAR->get('page', '_GET', 'int', 0);
        $bold = ($theme['theme_name'] == $evoconfig['default_Theme']) ? " style='font-weight: bold;'" : "";
        OpenTable();
          echo "<table border='2' align='center' width='100%'><tr>"
             ."<th width='16%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_USERID'] . "</strong></span></th>\n"
             ."<th width='16%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_USERNAME'] . "</strong></span></th>\n"
             ."<th width='16%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_REALNAME'] . "</strong></span></th>\n"
             ."<th width='16%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_USEREMAIL'] . "</strong></span></th>\n"
             ."<th width='16%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_USERTHEME'] . "</strong></span></th>\n"
             ."<th width='16%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_FUNCTIONS']. "</strong></span></th>\n"
             ."</tr>";
        $num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM " . _USERS_TABLE));
        $pagination = new Paginator($page,$num_rows);
        $pagination->set_Limit(15);
        $pagination->set_Links(3);
        $limit1 = $pagination->getRange1();
        $limit2 = $pagination->getRange2();
        $result = $db->sql_query("SELECT user_id, username, name, user_email, theme FROM " . _USERS_TABLE . " WHERE user_id != '1' ORDER BY username LIMIT ".$limit1.", ".$limit2);
        while($row = $db->sql_fetchrow($result)) {
            $user_id  = intval($row['user_id']);
            $username = Fix_Quotes($row['username']);
            if(empty($row['name'])) {
                $realname = $lang_admin[$adminpoint]['THEMES_NOREALNAME'];
            } else {
                $realname = Fix_Quotes($row['name']);
            }
            $useremail = Fix_Quotes($row['user_email']);
            if(empty($row['theme'])) {
                $usertheme = $evoconfig['default_Theme'];
            } else {
                $usertheme = Fix_Quotes($row['theme']);
            }
            echo "<tr valign='middle' ".$bold.">\n"
                ."<td colspan='6'>\n<form method='post' action='".$admin_file.".php'>\n"
                ."<table border='0' align='center' width='100%'>\n<tr>\n"
                ."<td width='16%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $user_id . "</td>\n"
                ."<td width='16%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $username . "</td>\n"
                ."<td width='16%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $realname . "</td>\n"
                ."<td width='16%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $useremail . "</td>\n"
                ."<td width='16%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $usertheme . "</td>\n"
                ."<td width='16%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'><select name='op'>\n"
                ."<option value='theme_users_reset' selected='selected'>".$lang_admin[$adminpoint]['THEMES_USER_RESET']."</option>\n"
                ."<option value='theme_users_modify'>".$lang_admin[$adminpoint]['THEMES_USER_MODIFY']."</option>\n"
                ."</select><p><input type='hidden' name='theme_userid' value='".$user_id."' /><input type='hidden' name='theme_username' value='".$username."' /><input type='submit' value='".$lang_admin[$adminpoint]['THEMES_SUBMIT']."' /></p></td>\n"
                ."</tr></table></form></td>"
                ."</tr>\n";
        }
        echo "</table>";

        CloseTable();
        OpenTable();
        if($pagination->getCurrent()==1) {
            $first = $lang_admin[$adminpoint]['THEMES_PAGE_FIRST']." | ";
        } else {
            $first="<a href='" .  $pagination->getPageName() . "?op=theme_users&amp;page=" . $pagination->getFirst() . "'>".$lang_admin[$adminpoint]['THEMES_PAGE_FIRST']."</a> |";
        }
        //check to see that getPrevious() is returning a value. If not there will be no link.
        if($pagination->getPrevious()) {
          $prev = "<a href='" .  $pagination->getPageName() . "?op=theme_users&amp;page=" . $pagination->getPrevious() . "'>".$lang_admin[$adminpoint]['THEMES_PAGE_PREVIOUS']."</a> | ";
        } else {
            $prev="".$lang_admin[$adminpoint]['THEMES_PAGE_PREVIOUS']." | ";
        }
        //check to see that getNext() is returning a value. If not there will be no link.
        if($pagination->getNext()) {
          $next = "<a href='" . $pagination->getPageName() . "?op=theme_users&amp;page=" . $pagination->getNext() . "'>".$lang_admin[$adminpoint]['THEMES_PAGE_NEXT']."</a> | ";
        } else {
            $next="".$lang_admin[$adminpoint]['THEMES_PAGE_NEXT']." | ";
        }
        //check to see that getLast() is returning a value. If not there will be no link.
        if($pagination->getLast()) {
            $last = "<a href='" . $pagination->getPageName() . "?op=theme_users&amp;page=" . $pagination->getLast() . "'>".$lang_admin[$adminpoint]['THEMES_PAGE_LAST']."</a> | ";
        } else {
            $last="".$lang_admin[$adminpoint]['THEMES_PAGE_LAST']." | ";
        }
        //since these will always exist just print out the values.  Result will be
        //something like 1 of 4 of 25
        echo $pagination->getFirstOf() . " ".$lang_admin[$adminpoint]['THEMES_PAGE_OF']." " .$pagination->getSecondOf() . " ".$lang_admin[$adminpoint]['THEMES_PAGE_OF_TOTAL']." " . $pagination->getTotalItems() . " ";
        //print the values determined by the if statements above.
        echo $first . " " . $prev . " " . $next . " " . $last;
        CloseTable();
    }

    function theme_users_reset() {
        global $db, $admin_file, $_GETVAR, $evoconfig;

        $user_id   = $_GETVAR->get('theme_userid', '_POST', 'int');
        $username  = $_GETVAR->get('theme_username', '_POST', 'string');
        $db->sql_uquery("UPDATE " . _USERS_TABLE . " SET theme = '" . $evoconfig['default_Theme'] . "' WHERE user_id = '".$user_id."' AND username = '".$username."'");
        redirect($admin_file . '.php?op=theme_users');
    }

    function theme_users_modify($theme) {
        global $db, $admin_file, $adminpoint, $lang_admin, $_GETVAR, $evoconfig, $ThemeInfo;

        $theme_userid   = $_GETVAR->get('theme_userid', '_POST', 'int', 0);
        $theme_username = $_GETVAR->get('theme_username', '_POST', 'string', '');
        $themename      = $_GETVAR->get('theme_name', '_POST', 'string', '');
        $submit         = $_GETVAR->get('theme_change', '_POST', 'int', 0);
        if (empty($themename) && ($theme_userid != 0) && !$submit) {
            $bold = ($theme == $evoconfig['default_Theme']) ? " style='font-weight: bold;'" : "";
            OpenTable();
            echo"<form method='post' action='".$admin_file.".php?op=theme_users_modify'><table border='2' align='center' width='100%'>\n"
                 ."<tr>"
                 ."<th width='16%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_USERNAME'] . "</strong></span></th>\n"
                 ."<th width='16%' align='center'><span class='content'><strong>" . $lang_admin[$adminpoint]['THEMES_USER_SELECT']. "</strong></span></th>\n"
                 ."</tr>";
            $username = get_user_field('username', $theme_userid, FALSE);
            $theme    = get_user_field('theme', $theme_userid, FALSE);
            if ($username) {
                if(!$theme || empty($theme)) {
                    $usertheme = $evoconfig['default_Theme'];
                } else {
                    $usertheme = $theme;
                }
                echo"<tr valign='middle' ".$bold.">"
                     ."<td width='50%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>" . $username . "</td>\n"
                     ."<td width='50%' align='center' bgcolor='".$ThemeInfo['bgcolor3']."'>". GetThemeSelect('theme_name', 'user_themes', false, '', $usertheme, 0)
                     ."<input type='hidden' name='theme_userid' value='".$theme_userid."' />"
                     ."<input type='hidden' name='theme_username' value='".$username."' />"
                     ."<input type='hidden' name='theme_change' value='1' />"
                     ."<input type='submit' value='".$lang_admin[$adminpoint]['THEMES_SUBMIT']."' /></td></tr>";
            }
            echo "</table></form>";
            CloseTable();
        } elseif ( $submit && !empty($themename) && !empty($theme_username) && ($theme_userid != 0)) {
            $db->sql_uquery("UPDATE " . _USERS_TABLE . " SET theme = '" . $themename . "' WHERE user_id = '".$theme_userid."' and username = '".$theme_username."'");
            redirect($admin_file.".php?op=theme_users");
        } else {
            redirect($admin_file.".php?op=theme_users");
        }

    }
    include_once(NUKE_BASE_DIR.'header.php');
    switch ($op) {
        case 'theme_edit':
            theme_header();
            theme_edit($theme_input);
            theme_footer();
            break;
        case 'theme_install':
            theme_header();
            theme_install();
            theme_footer();
            break;
        case 'theme_makedefault':
            theme_makedefault();
            break;
        case 'theme_deactivate':
            theme_header();
            theme_deactivate();
            theme_footer();
            break;
        case 'theme_activate':
            if ($theme_input != $evoconfig['default_Theme']) {
                $db->sql_uquery("UPDATE " . _THEMES_TABLE . " SET active='1' WHERE theme_name = '".$theme_input."'");
            }
            theme_header();
            display_main();
            theme_footer();
            break;
        case 'theme_install_save':
            theme_header();
            install_save();
            theme_footer();
            break;
        case 'theme_edit_save':
            theme_header();
            update_theme();
            theme_footer();
            break;
        case 'theme_ato_save':
            theme_header();
            theme_ato_save();
            theme_footer();
            break;
        case 'theme_quickinstall':
            if(!theme_installed($theme_input)) {
                $db->sql_uquery("INSERT INTO `" . _THEMES_TABLE . "` (`theme_name`, `groups`, `permissions`, `custom_name`, `active`) VALUES('".$theme_input."', '', '1', '".$theme_input."', '1')");
            }
            theme_header();
            display_main();
            theme_footer();
            break;
        case 'theme_uninstall':
            theme_header();
            uninstall_theme($theme_input);
            theme_footer();
            break;
        case 'theme_options':
            theme_header();
            theme_options();
            theme_footer();
            break;
        case 'theme_transfer':
            theme_header();
            theme_transfer();
            theme_footer();
            break;
        case 'theme_users':
            theme_header();
            users_themes();
            theme_footer();
            break;
        case 'theme_users_reset':
            theme_header();
            theme_users_reset();
            theme_footer();
            break;
        case 'theme_users_modify':
            theme_header();
            theme_users_modify($theme_input);
            theme_footer();
            break;
        case 'theme_changeato':
            theme_header();
            theme_changeato();
            theme_footer();
            break;
        default:
            theme_header();
            display_main();
            theme_footer();
            break;
    }
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>