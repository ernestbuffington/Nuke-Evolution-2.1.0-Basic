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
 Nuke-Evo Author        :   ReOrGaNiSaTiOn

 Copyright (c) 2010 by The Nuke-Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS 'NOT' ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE 'NOT' ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if (!defined('NUKE_EVO')) {
   die('You can\'t access this file directly...');
}

$errorcounter = 0;
$lang_temp = '';
if ( $basesetup == 1 ) {
    // Let's check our variables
    $var_db = array();
    $var_count    = 0;    
    
    if ( $InstallConfig['base_sitename'] ) {
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'sitename';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_sitename'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'config';
        $var_db[$var_count]['fieldname']    = 'sitename';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_sitename'];
    } else {
        $base_sitename_error = '<div style="color : red;">'.$lang_install['Base_Sitename_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_description'] ) {
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'site_desc';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_description'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'config';
        $var_db[$var_count]['fieldname']    = 'slogan';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_description'];
    } else {
        $base_description_error = '<div style="color : red;">'.$lang_install['Base_Descriptione_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_url'] ) {
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'server_name';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_url'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'config';
        $var_db[$var_count]['fieldname']    = 'nukeurl';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = 'http://'.$InstallConfig['base_url'];
    } else {
        $base_url_error = '<div style="color : red;">'.$lang_install['Base_Url_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_server_port'] ) {
        if ( ($InstallConfig['base_server_port'] >= 80) && ($InstallConfig['base_server_port'] <= 65535) ) {
            $var_count++;
            $var_db[$var_count]['tablename']    = 'bbconfig';
            $var_db[$var_count]['fieldname']    = 'config_name';
            $var_db[$var_count]['fieldvalue']   = 'server_port';
            $var_db[$var_count]['valuefield']   = 'config_value';
            $var_db[$var_count]['value']        = $InstallConfig['base_server_port'];
        } else {
            $base_server_port_error = '<div style="color : red;">'.$lang_install['Base_Server_Port_wrong_entry'].'</div>';
            $errorcounter++;
        }
    } else {
        $base_server_port_error = '<div style="color : red;">'.$lang_install['Base_Server_Port_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_cookie_domain'] ) {
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'cookie_domain';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_cookie_domain'];
    } else {
        $base_cookie_domain_error = '<div style="color : red;">'.$lang_install['Base_Cookie_Domain_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( ($InstallConfig['base_cookie_path'] == '/') || (strlen($InstallConfig['base_cookie_path']) >=2 ) ) {
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'cookie_path';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_cookie_path'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'cnbya_config';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'cookiepath';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_cookie_path'];
    } else {
        $base_cookie_path_error = '<div style="color : red;">'.$lang_install['Base_Cookie_Path_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_cookie_name'] ) {
        if ( (preg_match("/[0-9]|[A-Z]|[a-z]/", $InstallConfig['base_cookie_name']) ) ) {
            $var_count++;
            $var_db[$var_count]['tablename']    = 'bbconfig';
            $var_db[$var_count]['fieldname']    = 'config_name';
            $var_db[$var_count]['fieldvalue']   = 'cookie_name';
            $var_db[$var_count]['valuefield']   = 'config_value';
            $var_db[$var_count]['value']        = $InstallConfig['base_cookie_name'];
        } else {
            $base_cookie_name_error = '<div style="color : red;">'.$lang_install['Base_Cookie_Name_wrong_chars'].'</div>';
            $errorcounter++;
        }
    } else {
        $base_cookie_name_error = '<div style="color : red;">'.$lang_install['Base_Cookie_Name_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_board_email'] ) {
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'board_email';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_email'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'config';
        $var_db[$var_count]['fieldname']    = 'adminmail';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_email'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'config';
        $var_db[$var_count]['fieldname']    = 'notify_email';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_email'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'nsnst_config';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'admin_contact';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_email'];
    } else {
        $base_board_email_error = '<div style="color : red;">'.$lang_install['Base_Board_Email_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_board_email_sig'] ) {
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'board_email_sig';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_email_sig'];
    } else {
        $base_board_email_sig_error = '<div style="color : red;">'.$lang_install['Base_Board_Email_Sig_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_board_default_lang'] ) {
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'default_lang';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_default_lang'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'config';
        $var_db[$var_count]['fieldname']    = 'language';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_default_lang'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'users';
        $var_db[$var_count]['fieldname']    = 'user_lang';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_default_lang'];
    } else {
        $base_board_default_lang_error = '<div style="color : red;">'.$lang_install['Base_Board_Default_Lang_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_board_dateformat'] ) {
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'default_dateformat';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_dateformat'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'users';
        $var_db[$var_count]['fieldname']    = 'user_dateformat';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_dateformat'];
    } else {
        $base_board_dateformat_error = '<div style="color : red;">'.$lang_install['Base_Board_Dateformat_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['base_board_startdate_day'] && $InstallConfig['base_board_startdate_month'] && $InstallConfig['base_board_startdate_year'] ) {
        $startdate = @mktime(0,0,0,$InstallConfig['base_board_startdate_month'], $InstallConfig['base_board_startdate_day'], $InstallConfig['base_board_startdate_year']);
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'board_startdate';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $startdate;
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'record_online_date';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $startdate;
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbposts';
        $var_db[$var_count]['fieldname']    = 'post_time';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $startdate;
        $var_count++;
        $var_db[$var_count]['tablename']    = 'stats_config';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'install_date';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $startdate;
        $var_count++;
        $var_db[$var_count]['tablename']    = 'stats_hour';
        $var_db[$var_count]['fieldname']    = 'month';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_startdate_month'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'stats_hour';
        $var_db[$var_count]['fieldname']    = 'year';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_startdate_year'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'stats_hour';
        $var_db[$var_count]['fieldname']    = 'date';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_startdate_day'];
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbtopics';
        $var_db[$var_count]['fieldname']    = 'topic_time';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $startdate;
        $var_count++;
        $var_db[$var_count]['tablename']    = 'nsnst_config';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'version_check';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $startdate;
        $var_count++;
        $var_db[$var_count]['tablename']    = 'var_install';
        $var_db[$var_count]['fieldname']    = 'timeStamp';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $startdate;
        $var_count++;
        $var_db[$var_count]['tablename']    = 'evolution';
        $var_db[$var_count]['fieldname']    = 'evo_field';
        $var_db[$var_count]['fieldvalue']   = 'cache_last_cleared';
        $var_db[$var_count]['valuefield']   = 'evo_value';
        $var_db[$var_count]['value']        = $startdate;
        $var_count++;
        $var_db[$var_count]['tablename']    = 'evolution';
        $var_db[$var_count]['fieldname']    = 'evo_field';
        $var_db[$var_count]['fieldvalue']   = 'ver_check';
        $var_db[$var_count]['valuefield']   = 'evo_value';
        $var_db[$var_count]['value']        = $startdate;
        $var_count++;
        $var_db[$var_count]['tablename']    = 'users';
        $var_db[$var_count]['fieldname']    = 'user_regdate';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = date('M d, Y', $startdate);
        $var_count++;
        $var_db[$var_count]['tablename']    = 'stories';
        $var_db[$var_count]['fieldname']    = 'time';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = date('Y-m-d H:m:s', $startdate);
        $var_count++;
        $var_db[$var_count]['tablename']    = 'config';
        $var_db[$var_count]['fieldname']    = 'startdate';
        $var_db[$var_count]['fieldvalue']   = '';
        $var_db[$var_count]['valuefield']   = '';
        $var_db[$var_count]['value']        = $startdate;
    } else {
        $base_board_startdate_error = '<div style="color : red;">'.$lang_install['Base_Board_Startdate_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( ($InstallConfig['base_board_timezone'] < 13) && ($InstallConfig['base_board_timezone'] > -13) ) {
        $var_count++;
        $var_db[$var_count]['tablename']    = 'bbconfig';
        $var_db[$var_count]['fieldname']    = 'config_name';
        $var_db[$var_count]['fieldvalue']   = 'board_timezone';
        $var_db[$var_count]['valuefield']   = 'config_value';
        $var_db[$var_count]['value']        = $InstallConfig['base_board_timezone'];
    } else {
        $base_board_timezone_error = '<div style="color : red;">'.$lang_install['Base_Board_Timezone_no_entry'].'</div>';
        $errorcounter++;
    }
    if ($errorcounter == 0) {
        $db->sql_uquery('DROP TABLE IF EXISTS `evo_installer_vars`');
        $db->sql_uquery('CREATE TABLE `evo_installer_vars` (`id` int(5) NOT NULL, `tablename` varchar(255) NOT NULL, `fieldname` varchar(255), `fieldvalue` varchar(255), `valuefield` varchar(255), `value` varchar(255), `info_done` int(1) default "0",  PRIMARY KEY (`id`)) TYPE=MyISAM');
        $varscount = count($var_db);
        for ($i=0; $i < $varscount; $i++) {
            if ( $var_db[$i]['tablename'] ) {
                if ( !$result = $db->sql_uquery('INSERT INTO `evo_installer_vars` (`id`, `tablename`, `fieldname`, `fieldvalue`, `valuefield`, `value`, `info_done`) VALUES ('.$i.', "'.$var_db[$i]['tablename'].'", "'.$var_db[$i]['fieldname'].'", "'.$var_db[$i]['fieldvalue'].'", "'.$var_db[$i]['valuefield'].'", "'.$_GETVAR->fixQuotes($var_db[$i]['value']).'", "0")')) {
                    $InstallConfig['basesetup'] = 0;
                }
            } 
        }
        $result = $db->sql_query('SELECT COUNT(`tablename`) as `countvars` FROM `evo_installer_vars`');
        $dbcountvars = $db->sql_fetchrow($result);
        if ( $dbcountvars['countvars'] != $varscount ) {
            $error .= '<div style="color : red;text-align : center;">'.$lang_install['Base_Conf_wrong'].'</div><br />';
            $error .= '<div style="color : red;text-align : center;">'.$lang_install['DB_Entry_Update_missed'].'</div><br />';
            $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
            evo_setcookie($InstallConfig);
            $InstallConfig['basesetup'] = 0;
        } else {
            $error = '<div style="color : green;text-align : center;">'.$lang_install['Base_Conf_ok'].'<br />'.$error.'</div>';
            $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 2;
            evo_setcookie($InstallConfig);
        }
    } else {
        $error .= '<div style="color : red;text-align : center;">'.$lang_install['Base_Conf_wrong'].'</div><br />';
        $InstallConfig['basesetup'] = 0;
        $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
        evo_setcookie($InstallConfig);
    }
}

if ($InstallConfig['next_step'] < $InstallConfig['max_step'] && $InstallConfig['dbsetup'] == 1 && $InstallConfig['basesetup'] == 1) {
    $goback = 1;
    $gonext = 1;
} else {
    $goback = 1;
    $gonext = 0;
}    
install_header($goback, $gonext);

if ( $InstallConfig['update'] == 2 && $basesetup != 1) {
    $config = $db->sql_ufetchrow('SELECT * FROM `'.$InstallConfig['dbprefix'].'_config`', SQL_ASSOC);
    $result = $db->sql_query('SELECT * FROM `'.$InstallConfig['dbprefix'].'_bbconfig`', true);
    while ( $row = $db->sql_fetchrow($result) ) {
        $bbconfig[$row['config_name']] = $row['config_value'];
    }
    $db->sql_freeresult($result);
    $InstallConfig['base_sitename'] = ($config['sitename'] ? $config['sitename'] : $bbconfig['sitename']);
    $InstallConfig['base_description'] = ($config['slogan'] ? $config['slogan'] : $bbconfig['site_desc']);
    $InstallConfig['base_board_default_lang'] = ($config['language'] ? $config['language'] : $bbconfig['default_lang']);
    $InstallConfig['base_board_email'] = ($config['notify_email'] ? $config['notify_email'] : $bbconfig['board_email']);
    $InstallConfig['base_board_startdate_day'] = intval(date('j', $bbconfig['board_startdate']));
    $InstallConfig['base_board_startdate_month'] = intval(date('n', $bbconfig['board_startdate']));
    $InstallConfig['base_board_startdate_year'] = intval(date('Y', $bbconfig['board_startdate']));
    $InstallConfig['base_board_startdate_date'] = $bbconfig['board_startdate'];
    $InstallConfig['base_board_dateformat'] = $bbconfig['default_dateformat'];
    $InstallConfig['base_board_email_sig'] = $bbconfig['board_email_sig'];
    $InstallConfig['base_cookie_name'] = $bbconfig['cookie_name'];
    $InstallConfig['base_cookie_path'] = $bbconfig['cookie_path'];
    $InstallConfig['base_cookie_domain'] = $bbconfig['cookie_domain'];
    $InstallConfig['base_server_port'] = $bbconfig['server_port'];
    $InstallConfig['base_board_timezone'] = $bbconfig['board_timezone'];
    $InstallConfig['base_url'] = ($bbconfig['server_name'] ? $bbconfig['server_name'] : 'localhost');
    $lang_temp = '<div style="color : red;text-align : center;">'.$lang_install['Base_From_Update'].'</div>';
}

    
OpenTable();
OpenTable2();
echo "<div class='topictitle'><center>".$lang_install['Base_Setup'].($lang_temp != '' ? '<br />'.$lang_temp : '')."</center></div>";
CloseTable2();
echo '<br />';
if ( strlen($error) > 1 ) {
    OpenTable2();
    echo $error;
    CloseTable2();
}
echo '<fieldset><legend>'.$lang_install['Server_Configuration_Details'].'</legend>';
echo '<form method="post" name="form_basesetup" action="' . $_SERVER['PHP_SELF'] . '">';
echo '<input type="hidden" name="basesetup" value="1" />';
echo '<input type="hidden" name="step" value="'.$InstallConfig['step'].'" />';
echo '<table width="100%">';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Sitename']).'&nbsp;'.$lang_install['Base_Sitename'];
if ( $base_sitename_error ) { echo '<br />'.$base_sitename_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="base_sitename" size="50" value="'.($InstallConfig['base_sitename'] ? $InstallConfig['base_sitename'] : $var_install['bbconfig_sitename']).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Sitedescription']).'&nbsp;'.$lang_install['Base_Sitedescription'];
if ( $base_description_error ) { echo '<br />'.$base_description_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><textarea name="base_description" cols="50" rows="5">'.($InstallConfig['base_description'] ? $InstallConfig['base_description'] : $var_install['bbconfig_site_desc']).'</textarea></td></tr>';
$var_install['bbconfig_server_name'] = ($_SERVER['SERVER_NAME'] ? $_SERVER['SERVER_NAME'].$href_path : $var_install['bbconfig_server_name']);
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Url']).'&nbsp;'.$lang_install['Base_Url'];
if ( $base_url_error ) { echo '<br />'.$base_url_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="base_url" size="50" maxlength="200" value="'.($InstallConfig['base_url'] ? $InstallConfig['base_url'] : $var_install['bbconfig_server_name']).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Server_Port']).'&nbsp;'.$lang_install['Base_Server_Port'];
if ( $base_server_port_error ) { echo '<br />'.$base_server_port_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="base_server_port" size="5" value="'.($InstallConfig['base_server_port'] ? $InstallConfig['base_server_port'] : $var_install['bbconfig_server_port']).'" /></td></tr>';
$var_install['bbconfig_cookie_domain'] = ($_SERVER['SERVER_NAME'] ? $_SERVER['SERVER_NAME'] : $var_install['bbconfig_cookie_domain']);
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Cookie_Domain']).'&nbsp;'.$lang_install['Base_Cookie_Domain'];
if ( $base_cookie_domain_error ) { echo '<br />'.$base_cookie_domain_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="base_cookie_domain" size="50" maxlength="200" value="'.($InstallConfig['base_cookie_domain'] ? $InstallConfig['base_cookie_domain'] : $var_install['bbconfig_cookie_domain']).'" /></td></tr>';
$var_install['bbconfig_cookie_path'] = (strlen($href_path) > 1 ? $href_path : $var_install['bbconfig_cookie_path']);
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Cookie_Path']).'&nbsp;'.$lang_install['Base_Cookie_Path'];
if ( $base_cookie_path_error ) { echo '<br />'.$base_cookie_path_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="base_cookie_path" size="50" maxlength="200" value="'.($InstallConfig['base_cookie_path'] ? $InstallConfig['base_cookie_path'] : $var_install['bbconfig_cookie_path']).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Cookie_Name']).'&nbsp;'.$lang_install['Base_Cookie_Name'];
if ( $base_cookie_name_error ) { echo '<br />'.$base_cookie_name_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="base_cookie_name" size="50" maxlength="50" value="'.($InstallConfig['base_cookie_name'] ? $InstallConfig['base_cookie_name'] : $var_install['bbconfig_cookie_name']).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Board_Email']).'&nbsp;'.$lang_install['Base_Board_Email'];
if ( $base_board_email_error ) { echo '<br />'.$base_board_email_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="base_board_email" size="50" maxlength="50" value="'.($InstallConfig['base_board_email'] ? $InstallConfig['base_board_email'] : $var_install['bbconfig_board_email']).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Board_Email_Sig']).'&nbsp;'.$lang_install['Base_Board_Email_Sig'];
if ( $base_board_email_sig_error ) { echo '<br />'.$base_board_email_sig_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="base_board_email_sig" size="50" maxlength="200" value="'.($InstallConfig['base_board_email_sig'] ? $InstallConfig['base_board_email_sig'] : $var_install['bbconfig_board_email_sig']).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Board_Default_Lang']).'&nbsp;'.$lang_install['Base_Board_Default_Lang'];
if ( $base_board_default_lang_error ) { echo '<br />'.$base_board_default_lang_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="60%"><select name="base_board_default_lang">';
$languageslist = lang_list();
for ($i=0, $maxi=count($languageslist); $i < $maxi; $i++) {
    if(!empty($languageslist[$i])) {
        echo '<option value="'.$languageslist[$i].'"';
        if($languageslist[$i]==($InstallConfig['base_board_default_lang'] ? $InstallConfig['base_board_default_lang'] : $InstallConfig['language'])) {
            echo ' selected="selected"';
        }
        echo '>'.$languageslist[$i].'</option>';
    }
}
echo '</select></td></tr>';
$dateformat = ( $InstallConfig['base_board_dateformat'] ? $InstallConfig['base_board_dateformat'] : $var_install['bbconfig_default_dateformat']);
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Board_Dateformat']).'&nbsp;'.$lang_install['Base_Board_Dateformat'];
if ( $base_board_dateformat_error ) { echo '<br />'.$base_board_dateformat_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="base_board_dateformat" size="50" maxlength="50" value="'.($InstallConfig['base_board_dateformat'] ? $InstallConfig['base_board_dateformat'] : $dateformat).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Board_Startdate']).'&nbsp;'.$lang_install['Base_Board_Startdate'];
if ( $base_board_startdate_error ) { echo '<br />'.$base_board_startdate_error.'</td>'; } else { echo '</td>'; }
// It is easier to let the user select the date than afterwards make checks and convertion
echo '<td class="row1" width="60%"><select name="base_board_startdate_day">';
for ( $i = 1; $i <= 31; $i++ ) {
    echo '<option value="'.$i.'"';
    if ( $i == ($InstallConfig['base_board_startdate_day'] ? $InstallConfig['base_board_startdate_day'] : date('d')) ) {
        echo ' selected="selected"';
    }
    echo '>'.$i.'</option>';
}
echo '</select>';
echo '<select name="base_board_startdate_month">';
for ( $i = 1; $i <= 12; $i++ ) {
    echo '<option value="'.$i.'"';
    if ( $i == ($InstallConfig['base_board_startdate_month'] ? $InstallConfig['base_board_startdate_month'] : date('m')) ) {
        echo ' selected="selected"';
    }
    echo '>'.$i.'</option>';
}
echo '</select>';
echo '<select name="base_board_startdate_year">';
for ( $i = 1990; $i <= (date('Y')+1); $i++ ) {
    echo '<option value="'.$i.'"';
    if ( $i == ($InstallConfig['base_board_startdate_year'] ? $InstallConfig['base_board_startdate_year'] : date('Y')) ) {
        echo ' selected="selected"';
    }
    echo '>'.$i.'</option>';
}
echo '</select>';
echo '</td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Base_Help_Board_Timezone']).'&nbsp;'.$lang_install['Base_Board_Timezone'];
if ( $base_board_timezone_error ) { echo '<br />'.$base_board_timezone_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="60%"><select name="base_board_timezone">';
foreach($var_install['tz'] as $i => $wastebasket) {
    if(!empty($var_install['tz'][$i])) {
        echo '<option value="'.$i.'"';
        if($i==($InstallConfig['base_board_timezone'] ? $InstallConfig['base_board_timezone'] : $var_install['bbconfig_board_timezone'])) {
            echo ' selected="selected"';
        }
        echo '>'.$var_install['tz_zones'][$i].'</option>';
    }
}
echo '</select></td></tr>';
if ( $InstallConfig['basesetup'] != 1 ) {
    echo '<tr><td colspan="2"><center><input type="submit" name="button_basesetup" value="'.$lang_install['Submit'].'" /></center></td></tr>';
}
echo '</table></form></fieldset>';
echo '<br />';

if ($InstallConfig['basesetup'] == 1) {
    $previous = $next = '';
    if ($InstallConfig['old_step'] > $InstallConfig['min_step'] ) {
        $previous = '<a href="install.php?step='.$InstallConfig['old_step'].'"><img src="install/images/left.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }
    if ($InstallConfig['next_step'] < $InstallConfig['max_step'] && $InstallConfig['dbsetup'] == 1) {
        $next = '<a href="install.php?step='.$InstallConfig['next_step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
    } else {
        $next = '<a href="install.php?step='.$InstallConfig['step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }    
    echo "<center>$previous&nbsp;&nbsp;$next</center>";
}
echo "<br /><br />";
CloseTable();

?>