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


function log_write($file, $output, $title = _ERROR_LOG_GENERAL_ERROR) {
    global $userinfo;
    if(isset($userinfo) && is_array($userinfo)) {
        $username = $userinfo['username'];
    } else {
        if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])) {
            $ucookie = explode(':', base64_decode($_COOKIE['user']));
        }
        if(isset($ucookie) && is_array($ucookie) && !empty($ucookie[1])) {
            $username = $ucookie[1];
        } else {
            $username = _ANONYMOUS;
        }
    }
    $ip = GetHostByName(identify::get_ip());
    $date = date("d M Y - H:i:s");
    if($file == 'admin') {
        $string = '';
    } elseif ($file == 'error') {
        $string = 'URL: <a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '">' . $_SERVER['REQUEST_URI'] . "</a>\n";
    } else {
        $string = '';
    }
    $header  = "---------[" . $title . "]------------------------------------------------------------------------------------------------------------\n";
    $wdata = $header;
    $wdata .= "- [" . $date . "] - \n";
    $wdata .= (defined('_ERROR_LOG_USER') ? _ERROR_LOG_USER : 'Username:');
    $wdata .= '&nbsp;'. UsernameColor($username)."\n";
    $wdata .= (defined('_ERROR_LOG_USER') ? _ERROR_LOG_USER : 'Userip:');
    $wdata .= '&nbsp;'. $ip."\n";
    $wdata .= htmlspecialchars($string);
    $wdata .= "\n";
    if(is_array($output)) {
        foreach($output as $line) {
             $wdata .= htmlspecialchars($line) . "\n";
        }
    } else {
        $wdata .= htmlspecialchars($output) . "\n";
    }
    $wdata .= str_repeat('-', strlen($header));
    $wdata .= "\n\n";
    if($handle = @fopen(NUKE_INCLUDE_DIR.'log/' . $file . '.log','a')) {
        fwrite($handle, $wdata);
        fclose($handle);
    }
    return;
}

function log_size($file) {
    global $db;

    $filename = NUKE_INCLUDE_DIR.'log/' . $file . '.log';
    if(!@is_file($filename)) {
        return -1;
    }
    if(!is_writable($filename)) {
        return -2;
    }
    if(@filesize($filename) == 0) {
        return 0;
    }
    $handle = @fopen($filename,'r');
    if($handle) {
        $filesize = @filesize($filename);
        @fclose($handle);
    } else {
        return -1;
    }
    $row_log = $db->sql_ufetchrow('SELECT ' . $file . '_log_lines FROM '._NUKE_CONFIG_TABLE);
    if($row_log[0] != $filesize) {
        return 1;
    }
    return 0;
}

?>