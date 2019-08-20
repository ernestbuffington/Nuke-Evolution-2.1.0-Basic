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
global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin;

if (is_admin()) {
    getmodule_lang($adminpoint);

    function out_header($headertext='') {
        global $admin_file, $lang_admin, $adminpoint;

        OpenTable();
        echo "<center><strong><font size='3'>".$lang_admin[$adminpoint]['ADMIN_LOG']."</font></strong></center><br /><br />";
        echo "<center><strong><a href='".$admin_file.".php'>".$lang_admin['KERNEL']['MAIN_BACK']."</a></strong></center><br />";
        CloseTable();
        OpenTable();
        echo "<table>\n<tr>\n";
        echo "<th><strong>".$lang_admin[$adminpoint]['HEAD_DATE']."</strong></th>\n";
        echo "<th><strong>".$lang_admin[$adminpoint]['HEAD_TIME']."</strong></th>\n";
        echo "<th><strong>".$lang_admin[$adminpoint]['HEAD_IP']."</strong></th>\n";
        echo "<th><strong>".$lang_admin[$adminpoint]['HEAD_MSG']."</strong></th>\n";
        echo "</tr>\n";
    }

    function out_footer($file='') {
        global $admin_file, $lang_admin, $adminpoint;

        echo "</table>\n<br />";
        if (!empty($file)) {
            echo "<center><strong><a href='".$admin_file.".php?op=adminlog_clear&amp;log=" . $file . "'><span style=\"color:red\">".$lang_admin[$adminpoint]['CLEAR_LOG']."</span></a></strong></center>";
        }
        echo "<center><strong><a href='".$admin_file.".php'>".$lang_admin[$adminpoint]['BACK']."</a></strong></center><br />";
        CloseTable();

    }
    function view_log($file) {
        global $admin_file, $lang_admin, $adminpoint;

        out_header();
        $error = '';
        $filename = NUKE_INCLUDE_DIR.'log/' . $file . '.log';
        if(!@is_file($filename)) {
            $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['ADMIN_LOG_ERRFND']."</span>";
        }
        $file_size = @filesize($filename);
        if($file_size == 0) {
            $error .= "<span style=\"color:red\">".$lang_admin[$adminpoint]['LOG_NO_ENTRY']."</span>";
        } else if ( $file_size > 6291456) {// if file is greater than 6 MB we do not open it
            $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['LOG_TOBIG']."</span>";
        } else {
            if($handle = @fopen($filename,'r')) {
                $content = @fread($handle, $file_size);
                @fclose($handle);
            } else {
                $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['LOG_NOT_OPEN']."</span>";
            }
        }
        if ( strlen($error) <= 1) {
            $content = nl2br($content);
            echo "<tr>\n<td colspan='4' style='overflow:scroll; height:600px; width:100%;'>\n";
            echo $content;
            echo "</td>\n</tr>\n";
        } else {
            echo "<tr>\n<td colspan ='4'>\n";
            echo $error;
            echo "</tr>\n</td>\n";
        }
        out_footer($file);
        return;
    }

    function log_ack($file) {
        global $db, $admin_file, $lang_admin, $adminpoint, $cache;

        $error = '';
        $filename = NUKE_INCLUDE_DIR.'log/' . $file . '.log';
        if(!@is_file($filename)) {
            $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['ADMIN_LOG_ERRFND']."</span>";
        }
        $file_size = @filesize($filename);
        if($file_size == 0) {
            $error .= "<span style=\"color:red\">".$lang_admin[$adminpoint]['LOG_NO_ENTRY']."</span>";
        } else if ( $file_size > 6291456) {// if file is greater than 6 MB we do not open it
            $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['LOG_TOBIG']."</span>";
        } else {
            if($handle = @fopen($filename,'r')) {
                @fclose($handle);
            } else {
                $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['LOG_NOT_OPEN']."</span>";
            }
        }
        if ( strlen($error) <= 1) {
            $db->sql_uquery("UPDATE "._NUKE_CONFIG_TABLE." SET " . $file . "_log_lines='".$file_size."'");
            $cache->delete('nukeconfig');
        } else {
            out_header();
            echo $error;
            out_footer();
            exit;
        }
        redirect($admin_file.'.php');
    }

    function log_clear($file) {
        global $db, $admin_file, $lang_admin, $adminpoint, $cache;

        out_header();
        $error = '';
        $filename = NUKE_INCLUDE_DIR.'log/' . $file . '.log';
        if(!is_file($filename)) {
            $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['ADMIN_LOG_ERRFND']."</span>";
        }
        $file_size = filesize($filename);
        if($file_size == 0) {
            $error .= "<span style=\"color:red\">".$lang_admin[$adminpoint]['LOG_NO_ENTRY']."</span>";
        } else if ( $file_size > 6291456) {// if file is greater than 6 MB we do not open it
            $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['LOG_TOBIG']."</span>";
            unlink($filename);
            if($handle = fopen($filename,'w')) {
                fwrite($handle, '');
                fclose($handle);
            } else {
                $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['LOG_NOT_OPEN']."</span>";
            }
        } else {
            if($handle = fopen($filename,'w')) {
                fwrite($handle, '');
                fclose($handle);
            } else {
                $error .= "<span style='color:red'>".$lang_admin[$adminpoint]['LOG_NOT_OPEN']."</span>";
            }
        }
        if ( strlen($error) <= 1) {
            $db->sql_uquery("UPDATE "._NUKE_CONFIG_TABLE." SET " . $file . "_log_lines='".time()."'");
            $cache->delete('nukeconfig');
        } else {
            echo "<tr>\n<td colspan ='4'>\n";
            echo $error;
            echo "</tr>\n</td>\n";
        }
        out_footer();
        return;
    }

    if (is_admin()) {
        $op  = $_GETVAR->get('op', '_REQUEST', 'string');
        $log = $_GETVAR->get('log', '_GET', 'string');
        if ($log != 'error' && $log != 'admin' && $log != 'install' && (($log == 'admin' || $log == 'install') && !is_god_admin()) ) {
            $log = 'error';
        }
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        switch ($op) {
            case 'viewadminlog':
                view_log($log);
                break;
            case 'adminlog_ack':
                log_ack($log);
                break;
            case 'adminlog_clear':
                log_clear($log);
                break;
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>