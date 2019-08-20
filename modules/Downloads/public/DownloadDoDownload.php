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

if (!defined('MODULE_FILE') || !defined('DOWNLOADS_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

global $module_name, $_GETVAR;

$did       = $_GETVAR->get('did', '_POST', 'int', 0);
$gfx_check = $_GETVAR->get($module_name.$did.'gfx_check', '_POST', 'string');
if ($downloadsconfig['securitycheck'] == 1 && !security_code_check($gfx_check, 1, $module_name.$did)) {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
}

function remote_filesize($url, $timeout=2) {
    $url = parse_url($url);
    $size=false;
    if ($fp = @fsockopen($url['host'], ($url['port'] ? $url['port'] : 80), $errno, $errstr, $timeout))
    {
        @fwrite($fp, 'HEAD '.$url['path']." HTTP/1.0\r\nHost: ".$url['host']."\r\n\r\n");
        @stream_set_timeout($fp, $timeout);
        while (!feof($fp)) {
            $size = @fgets($fp, 4096);
            if (stristr($size, 'Content-Length') !== false) {// PHP5: stripos
                $size = trim(substr($size, 16));
                break;
            }
        }
        @fclose ($fp);
    }
    return ((int)$size == $size) ? ((int)$size) : false;
}

if ( (is_mod_admin($module_name) || DownloadsAllowed($did, $userinfo['user_id'], 'download')) ) {
    $dinfo = $db->sql_fetchrow($db->sql_query("SELECT `download_type`, `download_filename`, `download_name`, `url`, `download_size`, `download_mimetype`, `cid` FROM "._DOWNLOADS_DOWNLOADS_TABLE." WHERE did=$did"));
    $error = 0;
    if ( $dinfo['download_type'] == 2 || $dinfo['download_type'] == 3) {
        if (!@file_exists($dinfo['download_filename'])) {
            $error = 2;
        }
    } else {
        if ( isset($dinfo['url']) && !evo_site_up($dinfo['url'])) {
            $error = 1;
        }
    }
    if ($error == 0) {
        global $do_gzip_compress;
        $size = $dinfo['download_size'];
        if ( empty($size) || $size == 0 ) {
            if ( $dinfo['download_type'] == 1 ) {
                if (function_exists($dinfo['url'])) {
                    $size = @remote_filesize($dinfo['url']);
                } else {
                    $size = 0;
                }
            } else {
                $size     = @filesize($dinfo['download_filename']);
            }
        }
        if ( empty($dinfo['download_name']) ) {
            if ( !empty($dinfo['download_filename']) ) {
                $dinfo['download_name'] = @basename($dinfo['download_filename']);
            } else {
                $dinfo['download_name'] = 'SaveFile';
            }
        }
        $content = $dinfo['download_mimetype'];
        if (empty($content)) {
            if ( $dinfo['download_type'] == 2 || $dinfo['download_type'] == 3) {
                $content = @get_mime_content_type($dinfo['download_filename']);
            } else {
                $content = @get_mime_content_type($dinfo['url']);
            }
        }
        if (empty($content)) {
            $content = 'text/plain';
        }
        $downloadtime = time();
        $db->sql_uquery('INSERT INTO `'._DOWNLOADS_HISTORY_TABLE.'` (`user_id`, `did`, `cid`, `download_time`, `type`, `size`, `status`)
                            VALUES ("'.$userinfo['user_id'].'", "'.$did.'", "'.$dinfo['cid'].'", "'.$downloadtime.'", "'.$dinfo['download_type'].'", "'.$size.'", 0)');

        $error = 0;

        if(GZIPSUPPORT && $do_gzip_compress) {
            while (ob_end_clean());
            header('Content-Encoding: none');
        }
        // Start of script
        session_destroy();// I've tested and it seems that the session is only killed on this call but it remains alive as it was from the beginning.
        // still needs to be checked.
        header("Pragma: public");
        header("Content-type: '".$content."'; name=".$dinfo['download_name']."");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-length: $size");
        header("Content-Disposition: inline; filename=".$dinfo['download_name']."");

        // Please don't erase the next code. Will be needed for later versions

/*        if(is_user() || is_admin()){
            $kbps = 30;
            $kbps = $kbps/10;
            ob_start();
            $fh = @fopen($dinfo['download_filename'],"rb");
                while (!feof($fh)){
                    $stream = stream_get_line($fh, 1024*$kbps);
                    echo $stream;
                    ob_end_flush();
                    flush();
                    usleep(100000);
                }
            fclose($fh);
        } else {
            $kbps = 30;
            $kbps = $kbps/10;
            ob_start();
            $fh = @fopen($dinfo['download_filename'],"rb");
                while (!feof($fh)){
                    $stream = stream_get_line($fh, 1024*$kbps);
                    echo $stream;
                    ob_end_flush();
                    flush();
                    usleep(100000);
                }
            fclose($fh);
        }
*/
        // End of script

        $fh = @fopen($dinfo['download_filename'],"rb");
            while (!feof($fh)){
                $stream = fgets($fh, 1024);
                echo $stream;
            }
            fclose($fh);

        $db->sql_uquery('UPDATE `'._DOWNLOADS_DOWNLOADS_TABLE.'` SET
                            `hits` = `hits`+1 WHERE `did` = '.$did);
        $db->sql_uquery('UPDATE `'._DOWNLOADS_HISTORY_TABLE.'` SET `status`=9 WHERE `user_id`="'.$userinfo['user_id'].'" AND `did`="'.$did.'" AND `download_time`="'.$downloadtime.'"');
        exit;

    } else {
        $date = time();
        $sub_ip = $userinfo['user_ip'];
        $db->sql_uquery('UPDATE `'._DOWNLOADS_DOWNLOADS_TABLE.'` SET
                `download_active`       = 0,
                `download_broken`       = 1,
                `download_modifier`     = "'.$userinfo['username'].'",
                `download_modifier_ip`  = "'.$userinfo['user_ip'].'",
                `download_modified_time`= "'.time().'",
                `download_modified_text`= "'.$lang_new[$module_name]['ERROR_AUTO_DOWNLOAD_MODIFIED'].'"
                WHERE `did` = '.$did);
        if ( function_exists('log_write') ) {
            log_write($module_name, $userinfo['username'] .'&nbsp;'. $lang_new[$module_name]['ERROR_LOG_DOWNLOAD_NOTAVAILABLE'].'&nbsp<a href="'.EVO_SERVER_URL.'/admin.php?op=DownloadsListBrokenDownloads">'.$lang_new[$module_name]['ADMIN_BROKEN_DOWNLOAD'].'</a>', _ERROR);
        }
        include_once(NUKE_BASE_DIR.'header.php');
        DownloadsHeading();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<strong>" . ( ($error == 1 ) ? $lang_new[$module_name]['ERROR_HOSTS_WRONG'] : $lang_new[$module_name]['ERROR_DOWNLOAD_DOWNLOADING'] ). "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    DownloadsHeading();
    OpenTable();
    echo "<center><span class=\"option\">"
        . $lang_new[$module_name]['INFO_DOWNLOAD_RESTRICTED'] . "<br />"
        . $lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>