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

$error = '';
$dbsetupvalue = 1;
if ( $InstallConfig['dbsetup'] == 1 && ($InstallConfig['deletequest'] != 1 && $InstallConfig['deletequest'] != 2)) {
    $db_ok = 0;
    @require(NUKE_INCLUDE_DIR.'db/'.$InstallConfig['dbtype'].'.php');
    $db = new sql_db($InstallConfig['dbhost'], $InstallConfig['dbuname'], $InstallConfig['dbpass'], $InstallConfig['dbname'], false);
    if ($db->db_connect_id) {
        $db_ok = 1;
        $InstallConfig['dbconnect'] = 0;
        if ($result = $db->sql_query('SHOW DATABASES')) {
            while (list($db_database) = $db->sql_fetchrow($result)) {
                if ($InstallConfig['dbname'] == $db_database ) {
                    $db_ok = 2;
                }
            }
        } else {
            if ( $result = $db->sql_query('SHOW TABLES FROM `'.$InstallConfig['dbname'].'`')) {
                $db_ok = 2;
            }
        }
        if ( $db_ok > 1 )  {
            $result = $db->sql_uquery('SHOW TABLES FROM '.$InstallConfig['dbname'].' LIKE "'.$InstallConfig['dbprefix'].'%"');
            $numrows = $db->sql_numrows($result);
            if ( $numrows != 0 ) {
                $error .= '<div style="color : red;">'.$lang_install['DB_Prefix_exists'].'</div>';
                $InstallConfig['deletequest'] = 1;
            }
            $error .= '<div style="color : green;">'.$lang_install['DB_Conf_ok'].'<br /></div>';
            $InstallConfig['dbconnect'] = 1;
            $rename = 0;
            if ( $InstallConfig['diffuserprefix'] == 2 ) {
                if ($result = $db->sql_uquery('ALTER TABLE `'.$InstallConfig['userprefix'].'_users` TO `'.$InstallConfig['dbprefix'].'_users`')) {
                    $rename++;
                    if ($result = $db->sql_uquery('ALTER TABLE `'.$InstallConfig['userprefix'].'_users_temp` TO `'.$InstallConfig['dbprefix'].'_users_temp`')) {
                        $rename++;
                    }
                }
            }
            if ( $rename == 0 ) {
                // This lines are from JeFFb68CAM (www.Evo-Mods.com)
                // taken from old Installer for Nuke-Evolution
                if(!$directory_mode) {
                    $directory_mode = 0755; 
                }
                if (!$file_mode) {
                    $file_mode = 0644; 
                }

                if(@is_file(NUKE_INCLUDE_DIR . 'db/config.php')) {
                    @unlink(NUKE_INCLUDE_DIR . 'db/config.php');
                }

                $filename = NUKE_DATA_DIR.'config_blank.php';
                if(!$handle = @fopen ($filename, "r"))
                {
                    $error .= '<div style="color : red;">'.$lang_install['cant_open'] . ' '.$filename.'</div><br />';
                }
                $contents = @fread ($handle, filesize ($filename));
                @fclose ($handle);

                $contents = str_replace("%dbhost%", $InstallConfig['dbhost'], $contents);
                $contents = str_replace("%dbname%", $InstallConfig['dbname'], $contents);
                $contents = str_replace("%dbuname%", $InstallConfig['dbuname'], $contents);
                $contents = str_replace("%dbpass%", $InstallConfig['dbpass'], $contents);
                $contents = str_replace("%prefix%", $InstallConfig['configprefix'], $contents);
                $contents = str_replace("%user_prefix%", $InstallConfig['configprefix'], $contents);
                $contents = str_replace("%dbtype%", $InstallConfig['dbtype'], $contents);

                $contents = str_replace("%safe_mode%", $InstallConfig['KERNEL_STATUS_SAFEMODE'], $contents);
                $contents = str_replace("%open_basedir%", $InstallConfig['KERNEL_STATUS_OPENBASEDIR'], $contents);
                $contents = str_replace("%session_support%", $InstallConfig['KERNEL_STATUS_SESSIONSUPPORT'], $contents);
                $contents = str_replace("%curl_support%", $InstallConfig['KERNEL_STATUS_CURLSUPPORT'], $contents);
                $contents = str_replace("%file_upload%", $InstallConfig['KERNEL_STATUS_FILEUPLOAD'], $contents);
                $contents = str_replace("%file_upload_maxsize%", $InstallConfig['KERNEL_STATUS_FILEUPLOADMAXSIZE'], $contents);
                $contents = str_replace("%post_maxsize%", $InstallConfig['KERNEL_STATUS_POSTMAXSIZE'], $contents);
                $contents = str_replace("%gd_support%", $InstallConfig['KERNEL_STATUS_GDSUPPORT'], $contents);
                $contents = str_replace("%max_memory%", $InstallConfig['KERNEL_STATUS_MAXMEMORY'], $contents);

                $filename = NUKE_INCLUDE_DIR . 'db/config.php';

                if(!@touch ($filename)) {
                    $DownloadData = true;
                }
                @chmod($filename, $directory_mode);
                if (@is_writable($filename)) {
                    if (!$handle = @fopen($filename, 'a')) {
                        $InstallConfig['dbconnect'] = 0;
                        $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
                        $error .= '<div style="color : red;">'.$lang_install['File_CantOpen'] . ' '.$filename.'</div><br />';
                    } 
                    if ( !@fwrite($handle, $contents)) {
                        $InstallConfig['dbconnect'] = 0;
                        $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
                        $error .= '<div style="color : red;">'.$lang_install['File_CantWrite'] . ' '.$filename.'</div><br />';
                    } else {
                        $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 2;
                        $InstallConfig['dbconnect'] = 1;
                    }
                    @fclose($handle);
                } else {    
                    $InstallConfig['dbconnect'] = 0;
                    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
                    $error .= '<div style="color : red;">'.$lang_install['File_CantWrite'] . ' '.$filename.'</div><br />';
                }
                // End Technocrat lines
                evo_setcookie($InstallConfig);
            } else {
                $error .= '<div style="color : red;">'.$lang_install['DB_RenameUserTableFail'].'</div><br />';
                $InstallConfig['dbconnect'] = 0;
                $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
                evo_setcookie($InstallConfig);
            }
        } else {
            $error .= '<div style="color : red;">'.$lang_install['DB_DB_wrong'].'</div><br />';
            $InstallConfig['dbconnect'] = 0;
            $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
            evo_setcookie($InstallConfig);
        }
    } else {
        $error .= '<div style="color : red;">'.$lang_install['DB_Conf_wrong'].'</div><br />';
        $InstallConfig['dbconnect'] = 0;
        $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
        evo_setcookie($InstallConfig);
    }
}

if ( $InstallConfig['dbconnect'] == 1 && $InstallConfig['dbsetup'] == 1) {
    $goback = 1;
    $gonext = 1;
} else {
    $goback = 1;
    $gonext = 0;
}    
install_header($goback, $gonext);

OpenTable();
OpenTable2();
echo "<div class='topictitle' style='text-align:center;'>".$lang_install['DB_Setup'];
if ( strlen($error) > 1 ) {
    echo "</div>\n";
    CloseTable2();
    OpenTable2();
    echo "<div class='topictitle' style='text-align:center;'>";
    echo $error;
}
if ( ($InstallConfig['dbsetup'] != 1) && ( @file_exists(NUKE_INCLUDE_DIR . 'db/config.php' )) ) {
    include(NUKE_INCLUDE_DIR . 'db/config.php');
    if ( ($dbname != 'xxx_evo') && ($dbname != '%dbhost%') && ($dbuname != 'xxx_evo') && ($dbuname != '%dbuname%') && (strlen($dbuname) > 2) && (strlen($dbpass) > 2) ) {
        $InstallConfig['dbhost'] = $dbhost;
        $InstallConfig['dbname'] = $dbname;
        $InstallConfig['dbuname'] = $dbuname;
        $InstallConfig['dbpass'] = $dbpass;
        $InstallConfig['dbtype'] = $dbtype;
        if ( $prefix != $user_prefix ) {
            $InstallConfig['diff_prefix'] = 1;
        }
        if ( @substr($prefix, -1) == '_') {
            $prefix = @substr($prefix, 0, -1);
        }
        $InstallConfig['userprefix'] = $user_prefix;
        $InstallConfig['configprefix'] = $prefix;
        @include(NUKE_INCLUDE_DIR.'db/'.$InstallConfig['dbtype'].'.php');
        $db = new sql_db($InstallConfig['dbhost'], $InstallConfig['dbuname'], $InstallConfig['dbpass'], $InstallConfig['dbname'], false);
        if ($db->db_connect_id) {
            $result = $db->sql_unumrows('SHOW TABLES FROM '.$InstallConfig['dbname'].' LIKE "'.$InstallConfig['dbprefix'].'%"');
            if ( $result != 0 ) {
                // seems that this is an update rather than a fresh install
                $InstallConfig['updatequest'] = 1;
                $InstallConfig['update'] = 2;
                $InstallConfig['deletequest'] = 0;
                echo '<span style="color: red;">'.$lang_install['DB_Update_Question'].'</span>';
            }
        }
    } else {
        $InstallConfig['dbhost'] = 'localhost';
        $InstallConfig['dbname'] = '';
        $InstallConfig['dbuname'] = '';
        $InstallConfig['dbpass'] = '';
        $InstallConfig['configprefix'] = '';
        $InstallConfig['dbtype'] = '';
        $InstallConfig['updatequest'] = 0;
        $InstallConfig['update'] = 0;
        $InstallConfig['deletequest'] = 0;
    }
}
echo "</div>\n";
CloseTable2();
echo '<br />';
echo '<fieldset><legend>'.$lang_install['Server_Configuration_Details'].'</legend>';
echo '<form method="post" name="form_dbsetup" action="' . $_SERVER['PHP_SELF'] . '">';
echo '<input type="hidden" name="dbsetup" value="'.$dbsetupvalue.'" />';
echo '<input type="hidden" name="step" value="'.$InstallConfig['step'].'" />';
echo '<input type="hidden" name="dbconnect" value="'.$InstallConfig['dbconnect'].'" />';
echo '<table width="100%">';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['DB_Help_Host']).'&nbsp;'.$lang_install['DB_Host'].'</td>';
echo '<td class="row1" width="40%"><input type="text" name="dbhost" size="30" value="'.($InstallConfig['dbhost'] ? $InstallConfig['dbhost'] : 'localhost').'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['DB_Help_Name']).'&nbsp;'.$lang_install['DB_Name'].'</td>';
echo '<td class="row1" width="40%"><input type="text" name="dbname" size="30" value="'.$InstallConfig['dbname'].'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['DB_Help_Username']).'&nbsp;'.$lang_install['DB_Username'].'</td>';
echo '<td class="row1" width="40%"><input type="text" name="dbuname" size="30" value="'.$InstallConfig['dbuname'].'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['DB_Help_Password']).'&nbsp;'.$lang_install['DB_Password'].'</td>';
echo '<td class="row1" width="40%"><input type="password" name="dbpass" size="30" value="'.$InstallConfig['dbpass'].'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['DB_Help_Type']).'&nbsp;'.$lang_install['DB_Type'].'</td>';
echo '<td class="row1" width="40%">';
echo '<select name="dbtype">';
if (!$handle = opendir(NUKE_INCLUDE_DIR.'db/')) {
    install_error($lang_install['Config'], $lang_install['Error_DB_Dir']);
}
while (false !== ($file = readdir($handle))) {
    if ($file != '.' && $file != '..' && $file != 'index.html' && $file != '.htaccess' && $file != 'db.php') {
        $file = substr($file, 0, -4);
        if ( function_exists($file.'_connect')) {
            echo '<option value="'.$file.'"'.(($file == $InstallConfig['dbtype'])? ' selected="selected"' : '').'>'.$file.'</option>';
        }
    }
}
closedir($handle);
echo '</select>';
echo '</td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['DB_Help_Prefix']).'&nbsp;'.$lang_install['DB_Prefix'].'</td>';
echo '<td class="row1" width="40%"><input type="text" name="configprefix" size="30" value="'.($InstallConfig['configprefix'] ? $InstallConfig['configprefix'] : 'evo').'" /></td></tr>';
if ( $InstallConfig['diff_prefix'] == 1 ) {
    echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['DB_Help_DiffUserPrefix']).'&nbsp;'.$lang_install['DB_DiffUserPrefix'].'<br /><div style="color : red;">'.$lang_install['DB_DiffUserPrefixMore'].'</div></td>';
    echo '<td><select name="diffuserprefix">';
    if ( $InstallConfig['diffuserprefix'] == 1) {
        $diffuserprefix2 = 'selected="selected"';
        $diffuserprefix1 = '';
    } else {
        $diffuserprefix1 = 'selected="selected"';
        $diffuserprefix2 = '';
    }
    echo '<option value="1" '.$diffuserprefix1.'>'.$lang_install['No'].'</option>';
    echo '<option value="2" '.$diffuserprefix2.'>'.$lang_install['Yes'].'</option>';
    echo '</select>';
    echo '</td></tr>';
}

if ( $InstallConfig['updatequest'] == 1 || $InstallConfig['updatequest'] == 2) {
    echo '<tr><td class="row1" width="60%"><input type="hidden" name="updatequest" value="2" />';
    echo evo_help_img($lang_install['DB_Help_Update_Existing']).'&nbsp;'.$lang_install['DB_Update_Existing'].'</td>';
    echo '<td><select name="update">';
    if ( $InstallConfig['update'] == 2) {
        $update_select2 = 'selected="selected"';
        $update_select1 = '';
    } else {
        $update_select1 = 'selected="selected"';
        $update_select2 = '';
    }
    echo '<option value="1" '.$update_select1.'>'.$lang_install['DB_Installation'].'</option>';
    echo '<option value="2" '.$update_select2.'>'.$lang_install['DB_Update'].'</option>';
    echo '</select>';
    echo '</td></tr>';
}
if ( $InstallConfig['updatequest'] == 1 || $InstallConfig['updatequest'] == 2) {
    echo '<tr><td class="row1" width="60%"><input type="hidden" name="convertquest" value="2" />';
    echo evo_help_img($lang_install['DB_Help_Update_Convert']).'&nbsp;'.$lang_install['DB_Update_Convert'].'</td>';
    echo '<td><select name="dbconvert">';
    if ( $InstallConfig['dbconvert'] == 2) {
        $update_select2 = 'selected="selected"';
        $update_select1 = '';
    } else {
        $update_select1 = 'selected="selected"';
        $update_select2 = '';
    }
    echo '<option value="1" '.$update_select1.'>'.$lang_install['DB_No_Convertion'].'</option>';
    echo '<option value="2" '.$update_select2.'>'.$lang_install['DB_Convert'].'</option>';
    echo '</select>';
    echo '</td></tr>';
}

if ( $InstallConfig['deletequest'] == 1 || $InstallConfig['deletequest'] == 2) {
    echo '<tr><td class="row1" width="60%"><input type="hidden" name="deletequest" value="2" />';
    echo evo_help_img($lang_install['DB_Help_Delete_Existing']).'&nbsp;'.$lang_install['DB_Delete_Existing'].'</td>';
    echo '<td><select name="dbtab">';
    if ( $dbtab == 2) {
        $dtab_select2 = 'selected="selected"';
        $dtab_select1 = '';
    } else {
        $dtab_select1 = 'selected="selected"';
        $dtab_select2 = '';
    }
    echo '<option value="1" '.$dtab_select1.'>'.$lang_install['No'].'</option>';
    echo '<option value="2" '.$dtab_select2.'>'.$lang_install['Yes'].'</option>';
    echo '</select>';
    echo '</td></tr>';
}
if ($InstallConfig['deletequest'] != 2 && $InstallConfig['dbconnect'] != 1) {
    echo '<tr><td colspan="2"><center><input type="submit" name="button_dbsetup" value="'.$lang_install['Submit'].'" /></center></td></tr>';
}
echo '</table></form></fieldset>';
echo '<br />';

if ( $InstallConfig['dbconnect'] == 1 ) {
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