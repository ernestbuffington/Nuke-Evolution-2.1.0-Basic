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

global $InstallConfig;
$goback = 1;
$gonext = 0;
install_header($goback, $gonext);
$install_error      = 0;
$install_warning    = 0;
$apache_info        = true;
$check_int          = 0;
$check_var          = '';
$check_ary          = array();
if (@version_compare(phpversion(), '4.3.2', '>=')) {
    if (function_exists('apache_get_modules')) {
        $apache_modules = @apache_get_modules();
    } else {
        $apache_info = false;
        $apache_modules = array();
    }
} else {
    $apache_info = false;
    $apache_modules = array();
}
$img_ok             = '<img src="install/images/ok.png" width="16" height="16" alt="" title="'.$lang_install['IMG_OK'].'" />';
$img_bad            = '<img src="install/images/error.png" width="16" height="16" alt="" title="'.$lang_install['IMG_BAD'].'" />';
$img_warn           = '<img src="install/images/warn.png" width="16" height="16" alt="" title="'.$lang_install['IMG_WARN'].'" />';

OpenTable();
OpenTable2();
echo "<div class='topictitle'><center>".$lang_install['Infos_Title']."</center></div>";
echo "<div class='textarea'><center>".$lang_install['IMG_OK'].":&nbsp;&nbsp;".$img_ok."</center></div>";
echo "<div class='textarea'><center>".$lang_install['IMG_BAD'].":&nbsp;&nbsp;".$img_bad."</center></div>";
echo "<div class='textarea'><center>".$lang_install['IMG_WARN'].":&nbsp;&nbsp;".$img_warn."</center></div>";
CloseTable2();

echo '<fieldset><legend>'.$lang_install['Server_Configuration_Details'].'</legend>';
echo '<table width="100%">';
// Get System Infos
$lang_temp = '';
if (function_exists('posix_uname')) {
    $check_ary = @posix_uname();
    echo '<tr><td class="row1" colspan="2"><strong>'.$lang_install['SystemInfo'].':</strong><br />';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysNodename'].':&nbsp;'.$check_ary['nodename'].'<br />';
    log_write($lang_install['SysNodename'].'='.$check_ary['nodename']);
    if (isset($check_ary['domainname'])) {
        echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysDomain'].':&nbsp;'.$check_ary['domainname'].'<br />';
        log_write($lang_install['SysDomain'].'='.$check_ary['domainname']);
    }
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysMachine'].':&nbsp;'.$check_ary['machine'].'<br />';
    log_write($lang_install['SysMachine'].'='.$check_ary['machine']);
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['Sysname'].':&nbsp;'.$check_ary['sysname'].'<br />';
    log_write($lang_install['Sysname'].'='.$check_ary['sysname']);
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysRelease'].':&nbsp;'.$check_ary['release'].'<br />';
    log_write($lang_install['SysRelease'].'='.$check_ary['release']);
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysVersion'].':&nbsp;'.$check_ary['version'].'<br />';
    log_write($lang_install['SysVersion'].'='.$check_ary['version']);
    echo '</td></tr>';
} elseif (function_exists('php_uname')) {
    $check_ary['nodename'] = @php_uname('n');
    $check_ary['sysname']  = @php_uname('s');
    $check_ary['release']  = @php_uname('r');
    $check_ary['version']  = @php_uname('v');
    $check_ary['machine']  = @php_uname('m');
    echo '<tr><td class="row1" colspan="2"><strong>'.$lang_install['SystemInfo'].':</strong><br />';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysNodename'].':&nbsp;'.$check_ary['nodename'].'<br />';
    log_write($lang_install['SysNodename'].'='.$check_ary['nodename']);
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysMachine'].':&nbsp;'.$check_ary['machine'].'<br />';
    log_write($lang_install['SysMachine'].'='.$check_ary['machine']);
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['Sysname'].':&nbsp;'.$check_ary['sysname'].'<br />';
    log_write($lang_install['Sysname'].'='.$check_ary['sysname']);
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysRelease'].':&nbsp;'.$check_ary['release'].'<br />';
    log_write($lang_install['SysRelease'].'='.$check_ary['release']);
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysVersion'].':&nbsp;'.$check_ary['version'].'<br />';
    log_write($lang_install['SysVersion'].'='.$check_ary['version']);
    echo '</td></tr>';
}
$lang_temp = '';
if (function_exists('posix_getgid')) {
    $check_ary['guid']     = @posix_getgid(); // Liefert die effektive Gruppen-ID des aktuellen Prozesses
    $check_ary['guidinfo'] = @posix_getgrgid(intval($check_ary['guid']));
    $check_ary['uid']      = @posix_getuid(); // Liefert die effektive Benutzer-ID des aktuellen Prozesses
    $check_ary['uinfo']    = @posix_getpwuid(intval($check_ary['uid']));
    echo '<tr><td class="row1" colspan="2"><strong>'.$lang_install['SystemUserInfo'].':</strong><br />';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysUserProcessID'].':&nbsp;'.$check_ary['uid'].'<br />';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysUserProcessName'].':&nbsp;'.$check_ary['uinfo']['name'].'<br />';
    log_write($lang_install['SysUser'].'= ID: '.$check_ary['uid'].' Name: '.$check_ary['uinfo']['name']);
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysGroupProcessID'].':&nbsp;'.$check_ary['guid'].'<br />';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysGroupProcessName'].':&nbsp;'.$check_ary['guidinfo']['name'].'<br />';
    log_write($lang_install['SysGroup'].'= ID: '.$check_ary['guid'].' Name: '.$check_ary['guidinfo']['name']);
    echo '</td></tr>';
} else {
    $check_ary['guid']     = @getmygid(); // Liefert die effektive Gruppen-ID des aktuellen Prozesses
    $check_ary['uid']      = @getmyuid(); // Liefert die effektive Benutzer-ID des aktuellen Prozesses
    $check_ary['uinfo']    = @get_current_user();
    echo '<tr><td class="row1" colspan="2"><strong>'.$lang_install['SystemUserInfo'].':</strong><br />';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysUserProcessID'].':&nbsp;'.$check_ary['uid'].'<br />';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysUserProcessName'].':&nbsp;'.$check_ary['uinfo'].'<br />';
    log_write($lang_install['SysUser'].'= ID: '.$check_ary['uid'].' Name: '.$check_ary['uinfo']);
    echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SysGroupProcessID'].':&nbsp;'.$check_ary['guid'].'<br />';
    log_write($lang_install['SysGroup'].'= ID: '.$check_ary['guid']);
    echo '</td></tr>';
}

// Check for free Diskspace
$lang_temp = '';
$check = @disk_free_space(NUKE_BASE_DIR);
if ( !empty($check) ) {
    $check = round(@disk_free_space(NUKE_BASE_DIR)/1024/1024,2);
    if ( $check < 50 ) {
        $out_img = $img_bad;
        $install_error++;
    } elseif ( $check < 100 ) {
        $out_img = $img_warn;
        $install_warning++;
    } else {
        $out_img = $img_ok;
    }
} else {
    // free_disk_space got no result
    $out_img = $img_warn;
    $install_warning++;
    $check = '---';
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['No_Free_Disk_Space'].'</div>';
}
echo '<tr><td class="row1">'.$lang_install['FreeDiskSpace'].':&nbsp;'.$check.'&nbsp;'.$lang_install['Size_MB'].$lang_temp.'</td><td class="row1">'.$out_img.'</td></tr>';
log_write($lang_install['FreeDiskSpace'].'='.$check.$lang_install['Size_MB']);

//Check for Open Basedir
$lang_temp = '';
$check = @ini_get('open_basedir');
if ($check == 'On' || $check == 'on' || $check == true) {
    // Check if Open Basedir is set correct - if yes, we should have write access to files
    $file_to_change = NUKE_INCLUDE_DIR . 'db/config.php';
    $chmod = intval('0644', 8);
    if ( @chmod($file_to_change, $chmod) ) {
        $check   = 0;
        $out_img = $img_ok;
    } else {
        $filerights = get_fileinfo($file_to_change);
        if (!$filerights['is_owner'] && !$filerights['is_group']) {
            $check   = 1;
            $out_img = $img_warn;
            $install_warning++;
            $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Open_Basedir_On'].'</div>';
        }
    }
} else {
    $check   = 0;
    $out_img = $img_ok;
}
echo '<tr><td class="row2">'.$lang_install['Open_Basedir'].$lang_temp.'</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['Open_Basedir'].'='.$check);
$install_open_basedir = $check;

//Check for safemode
$lang_temp = '';
$check = @ini_get('safe_mod');
if ($check == 'On' || $check == 'on' || $check == true) {
    $check   = 1;
    $out_img = $img_warn;
    $install_warning++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['SafeMod_On'].'</div>';
} else {
    $check   = 0;
    $out_img = $img_ok;
}
echo '<tr><td class="row2">'.$lang_install['Safe_Mod'].$lang_temp.'</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['Safe_Mod'].'='.$check);
$install_safe_mode = $check;

//Check for php version
$lang_temp = '';
if (version_compare(phpversion(), '4.1.2', '<')) {
    $out_img = $img_bad;
    $install_error++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Wrong_PHP_Version'].'</div>';
} elseif (version_compare(phpversion(), '4.4.0', '<')) {
    $out_img = $img_warn;
    $install_warning++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Unsafe_PHP_Version'].'</div>';
} elseif (version_compare(phpversion(), '5.0.4', '<') && version_compare(phpversion(), '5.0.0', '>=') ) {
    $out_img = $img_warn;
    $install_warning++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Unsafe_PHP_Version'].'</div>';
} else {
    $out_img = $img_ok;
}
echo '<tr><td class="row1">'.$lang_install['PHP_Version'].':&nbsp;'.phpversion().$lang_temp.'</td><td class="row1">'.$out_img.'</td></tr>';
log_write($lang_install['PHP_Version'].'='.phpversion());

//Check for Register Globals
$lang_temp = '';
$check = @ini_get('register_globals');
if ($check == 'On' || $check == 'on' || $check == true) {
    $out_img = $img_warn;
    $install_warning++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Register_Globals_On'].'</div>';
} else {
    $out_img = $img_ok;
}
echo '<tr><td class="row2">'.$lang_install['Register_Globals'].$lang_temp.'</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['Register_Globals'].'='.$check);

//Check for Session Support
$lang_temp = '';
$check = @extension_loaded('session') ? true : false;
if ( $check ) {
    $check   = 1;
    $out_img = $img_ok;
} else {
    $check   = 0;
    $out_img = $img_bad;
    $install_error++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['No_Session_Support'].'</div>';
}
echo '<tr><td class="row1">'.$lang_install['Session_Support'].$lang_temp.'</td><td class="row1">'.$out_img.'</td></tr>';
log_write($lang_install['Session_Support'].'='.$check);
$install_session_support = $check;

//Check for CURL Support
$lang_temp = '';
$check = @extension_loaded('curl') ? true : false;
if ( $check ) {
    $check   = 1;
    $out_img = $img_ok;
} else {
    $check   = 0;
    $out_img = $img_warn;
    $install_warning++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['No_Curl_Modul'].'</div>';
}
echo '<tr><td class="row2">'.$lang_install['CURL_Libary'].$lang_temp.'</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['CURL_Libary'].'='.$check);
$install_curl_support = $check;

//Check for File Upload
$lang_temp = '';
$check = @ini_get('file_uploads');
if ($check == 'On' || $check == 'on' || $check == true) {
    $check   = 1;
    $out_img = $img_ok;
} else {
    $check   = 0;
    $out_img = $img_warn;
    $install_warning++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['No_FileUploads'].'</div>';
}
echo '<tr><td class="row1">'.$lang_install['File_Upload'].$lang_temp.'</td><td class="row1">'.$out_img.'</td></tr>';
log_write($lang_install['File_Upload'].'='.$check);
$install_file_upload = $check;

// Check for File Upload Maxsize
$lang_temp = '';
$check = round(@ini_get('upload_max_filesize'),2);
if ( $check < 2 ) {
    $out_img = $img_bad;
    $install_error++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Max_FileSize_ToSmall'].'</div>';
} elseif ( $check < 10 ) {
    $out_img = $img_warn;
    $install_warning++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Max_FileSize_Small'].'</div>';
} else {
    $out_img = $img_ok;
}
echo '<tr><td class="row2">'.$lang_install['File_Upload_Maxsize'].':&nbsp;'.$check.'&nbsp;'.$lang_install['Size_MB'].$lang_temp.'</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['File_Upload_Maxsize'].'='.$check.$lang_install['Size_MB']);
$install_file_size = $check;

//Check for FTP Support
$lang_temp = '';
$check = @extension_loaded('ftp');
if ($check == 'On' || $check == 'on' || $check == true) {
    $out_img = $img_ok;
} else {
    $out_img = $img_warn;
    $install_warning++;
}
echo '<tr><td class="row1">'.$lang_install['FTP_enabled'].'</td><td class="row1">'.$out_img.'</td></tr>';
log_write($lang_install['FTP_enabled'].'='.$check);

// Check for Postings Maxsize
$lang_temp = '';
$check = round(@ini_get('post_max_size'),2);
if ( $check  < 2 ) {
    $out_img = $img_bad;
    $install_error++;
} else {
    $out_img = $img_ok;
}
echo '<tr><td class="row2">'.$lang_install['Max_Post_Size'].':&nbsp;'.$check.'&nbsp;'.$lang_install['Size_MB'].'</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['Max_Post_Size'].'='.$check.$lang_install['Size_MB']);
$install_post_size = $check;

// Check for SMTP
$lang_temp = '';
$check1 = @ini_get('SMTP');
$check2 = @ini_get('sendmail_from');
$check3 = @ini_get('sendmail_path');
if ( (strlen($check1) > 2) && (strlen($check2) > 2) && (strlen($check3) > 2) ) {
    $out_img = $img_ok;
    $check = 1;
} else {
    $out_img = $img_warn;
    $install_warning++;
    $check = 0;
}
echo '<tr><td class="row1">'.$lang_install['SMTP_enabled'].'<br />';
echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SMTP_host'].':&nbsp;'.((strlen($check1) < 2) ? $check1 . $img_warn : $check1).'<br />';
echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SMTP_sender'].':&nbsp;'.((strlen($check2) < 2) ? $check2 . $img_warn : $check2).'<br />';
echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang_install['SMTP_command'].':&nbsp;'.((strlen($check3) < 2) ? $check3 . $img_warn : $check3).'<br />';
echo '</td><td class="row1">'.$out_img.'</td></tr>';
log_write($lang_install['SMTP_enabled'].'='.$check);


// Check for mod_rewrite
$lang_temp = '';
$check = @in_array('mod_rewrite', $apache_modules);
if ($check == true) {
    $out_img = $img_ok;
    $lang_temp = '';
} elseif  ( ($check == false) && (version_compare(phpversion(), '4.3.2', '>=')) ) {
    if ($apache_info == true) {
        $out_img = $img_warn;
        $install_warning++;
        $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Mod_Rewrite_no'].'</div>';
    } else {
        $out_img = $img_warn;
        $install_warning++;
        $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Mod_Rewrite_no_check'].'</div>';
    }
} else {
    $out_img = $img_warn;
    $install_warning++;
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Mod_Rewrite_no_check'].'</div>';
}
echo '<tr><td class="row2">'.$lang_install['Mod_Rewrite'].':'.$lang_temp.'</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['Mod_Rewrite'].'='.$check);


// Check for gd Support
$lang_temp = '';
$check = @extension_loaded('gd');
if ( $check ) {
    $check  = 1;
    $check1 = gd_info();
    if ( $check1['JPG Support'] || $check1['JPEG Support']) {
        $out_img = $img_ok;
    } else {
        $out_img = $img_warn;
        $install_warning++;
    }
} else {
    $check   = 0;
    $out_img = $img_warn;
    $install_warning++;
}
echo '<tr><td class="row2">'.$lang_install['GD_Libary'].':</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['GD_Libary'].'='.$check);
echo '<tr><td class="row2">'.$lang_install['GD_Libary_JPEG'].':</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['GD_Libary_JPEG'].'='.$check1);
$install_gd_support = $check;

//Check for Captcha enabled
$lang_temp = '';
$check = (function_exists('imagecreatetruecolor') && function_exists('imageftbbox')) ? true : false;
if( $check ) {
    $out_img = $img_ok;
} else {
    $out_img = $img_warn;
    $install_warning++;
}
echo '<tr><td class="row1">'.$lang_install['Captcha_enabled'].'</td><td class="row1">'.$out_img.'</td></tr>';
log_write($lang_install['Captcha_enabled'].'='.$check);

// Check for Memory Limit > 16 M
$check = ini_get('memory_limit');
$lang_temp = '';

if ( !empty($check) ) {
    switch (true) {
        case (stristr($check, 'KB')):
            $check = @str_replace('KB', '', $check);
            $lang_temp = $lang_install['Size_MB'];
            $multi = 1/1024;
            break;
        case (stristr($check, 'Kb')):
            $check = @str_replace('Kb', '', $check);
            $lang_temp = $lang_install['Size_MB'];
            $multi = 1/1024;
            break;
        case (stristr($check, 'K')):
            $check = @str_replace('K', '', $check);
            $lang_temp = $lang_install['Size_MB'];
            $multi = 1/1024;
            break;
        case (stristr($check, 'MB')):
            $check = @str_replace('MB', '', $check);
            $lang_temp = $lang_install['Size_MB'];
            $multi = 1;
            break;
        case (stristr($check, 'Mb')):
            $check = @str_replace('Mb', '', $check);
            $lang_temp = $lang_install['Size_MB'];
            $multi = 1;
            break;
        case (stristr($check, 'M')):
            $check = @str_replace('M', '', $check);
            $lang_temp = $lang_install['Size_MB'];
            $multi = 1;
            break;
        case (stristr($check, 'GB')):
            $check = @str_replace('GB', '', $check);
            $lang_temp = $lang_install['Size_GB'];
            $multi = 1024;
            break;
        case (stristr($check, 'Gb')):
            $check = @str_replace('Gb', '', $check);
            $lang_temp = $lang_install['Size_GB'];
            $multi = 1024;
            break;
        case (stristr($check, 'G')):
            $check = @str_replace('G', '', $check);
            $lang_temp = $lang_install['Size_GB'];
            $multi = 1024;
            break;
        default:
            $check = 0;
            $lang_temp = $lang_install['Size_MB'];
            $multi = 1;
            break;
    }
    $check = $check * $multi;

    if ( $check  < 12 ) {
        $out_img = $img_bad;
        $install_error++;
    } elseif ( $check < 16 ) {
        $out_img = $img_warn;
        $install_warning++;
    } elseif ( $check > 16 ) {
        $out_img = $img_ok;
    }
} else {
    $out_img = $img_warn;
    $install_warning++;
    $check = 'none';
    $lang_temp = '<br /><div style="color : red;font-size: 10px;">'.$lang_install['Memory_Limit_not'].'</div>';
}
echo '<tr><td class="row2">'.$lang_install['Memory_Limit'].':&nbsp;'.$check.'&nbsp;'.$lang_temp.'</td><td class="row2">'.$out_img.'</td></tr>';
log_write($lang_install['Memory_Limit'].'='.$check.$lang_install['Size_MB']);
$install_max_memory = ($check ? $check : 12);

echo '</table></fieldset>';

echo '<br />';
echo '<fieldset><legend>'.$lang_install['Server_Configuration_Summary'].'</legend>';
echo '<table width="100%">';
echo '<tr><td class="row1">'.$lang_install['Errors_found'].':</td><td class="row1">'.$install_error.'</td></tr>';
echo '<tr><td class="row1">'.$lang_install['Warnings_found'].':</td><td class="row1">'.$install_warning.'</td></tr>';
echo '</table></fieldset>';
log_write($lang_install['Errors_found'].'='.$install_error);
log_write($lang_install['Warnings_found'].'='.$install_warning);

echo '<br />';
if ( $install_error > 0 ) {
    OpenTable2();
    echo "<div class='topictitle'><center>".$lang_install['Installation_Start_failed']."</center></div>";
    CloseTable2();
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
} else {
    $InstallConfig['KERNEL_STATUS_SAFEMODE']           = $install_safe_mode;
    $InstallConfig['KERNEL_STATUS_OPENBASEDIR']        = $install_open_basedir;
    $InstallConfig['KERNEL_STATUS_SESSIONSUPPORT']     = $install_session_support;
    $InstallConfig['KERNEL_STATUS_CURLSUPPORT']        = $install_curl_support;
    $InstallConfig['KERNEL_STATUS_FILEUPLOAD']         = $install_file_upload;
    $InstallConfig['KERNEL_STATUS_FILEUPLOADMAXSIZE']  = $install_file_size;
    $InstallConfig['KERNEL_STATUS_POSTMAXSIZE']        = $install_post_size;
    $InstallConfig['KERNEL_STATUS_GDSUPPORT']          = $install_gd_support;
    $InstallConfig['KERNEL_STATUS_MAXMEMORY']          = $install_max_memory;
    $InstallConfig['SYSTEM_USER_ID']                   = $check_ary['uid'];
    $InstallConfig['SYSTEM_USER_GROUPID']              = $check_ary['guid'];
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 2;
    $previous = $next = '';
    if ($InstallConfig['old_step'] > $InstallConfig['min_step'] ) {
        $previous = '<a href="install.php?step='.$InstallConfig['old_step'].'"><img src="install/images/left.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }
    if ($InstallConfig['next_step'] < $InstallConfig['max_step'] ) {
        $next = '<a href="install.php?step='.$InstallConfig['next_step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }
    echo "<center>$previous&nbsp;&nbsp;$next</center>";
}
evo_setcookie($InstallConfig);
echo "<br /><br />";
CloseTable();

?>