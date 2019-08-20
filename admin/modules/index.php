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

$adminpoint = 'index';
global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin, $ab_config;

if (is_admin()) {
    getmodule_lang($adminpoint);
    define('ADMIN_POS', true);
    include_once(NUKE_BASE_DIR.'header.php');
    GraphicAdmin();
    if (is_mod_admin('super')) {
        OpenTable();
        echo "<center><font size='3'><strong>" . $lang_admin['INDEX']['SECURITY_SEC_STATUS'] . "</strong></font><br /><br />"
        ."<table border='0' width='70%'>";
        if(defined('ADMIN_IP_LOCK')) {
            echo "<tr><td>"
                ."<img src='images/evo/ok.png' alt='' width='10' height='10' /></td><td>"
                ."<em>" . $lang_admin['INDEX']['SECURITY_ADMIN_IP_LOCK'] . ":</em></td><td>" . $lang_admin['INDEX']['SECURITY_SEC_ON'] . "</td></tr>";
        } else {
            echo "<tr><td>"
                ."<img src='images/evo/bad.png' alt='' width='10' height='10' /></td><td>"
                ."<em>" . $lang_admin['INDEX']['SECURITY_ADMIN_IP_LOCK'] . ":</em></td><td>" . $lang_admin['INDEX']['SECURITY_SEC_OFF'] . "</td></tr>";
        }
        if($ab_config['disable_switch'] == 0) {
            echo "<tr><td>"
                ."<img src='images/evo/ok.png' alt='' width='10' height='10' /></td><td>"
                ."<em>" . $lang_admin['INDEX']['SECURITY_SENTINEL'] . ":</em></td><td>" . $lang_admin['INDEX']['SECURITY_SEC_ON'] . "</td></tr>";
        } else {
            echo "<tr><td>"
                ."<img src='images/evo/bad.png' alt='' width='10' height='10' /></td><td>"
                ."<em>" . $lang_admin['INDEX']['SECURITY_SENTINEL'] . ":</em></td><td>" . $lang_admin['INDEX']['SECURITY_SEC_OFF'] . "</td></tr>";
        }
        echo "</table></center>";
        CloseTable();
        echo '<br />';
        OpenTable();
        echo "<center><strong><font size='3'>".$lang_admin['INDEX']['ADMIN_LOG']."</font></strong><br /><br />";
        echo"<table border='0' width='40%' align='center'>";
        echo "<tr><td>"
            ."<strong>".$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN1']."</strong>"
            ."</td></tr>"
            ."<tr><td>"
            .$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN2']
            ."</td></tr>";
        echo "</table>";
        echo"<table border='0' width='70%'>";
        $ret_log = log_size('admin');
        $img = ($ret_log == -1 || $ret_log == -2 || $ret_log) ? 'bad' : 'ok';
        echo "<tr><td width='8%'>"
            ."<img src='images/evo/$img.png' alt='' width='10' height='10' /></td><td width='22%'><em>".$lang_admin['INDEX']['ADMIN_LOG_TITLE']."</em>:</td>";
        if($ret_log == -1) {
        echo "<td align='center' width='40%'><font color='red'>" . $lang_admin['INDEX']['ADMIN_LOG_ERR'] . "</font></td>";
        } elseif($ret_log == -2) {
            echo "<td align='center' width='40%'><font color='red'>" . $lang_admin['INDEX']['ADMIN_LOG_ERRCHMOD'] . "</font></td>";
        }    elseif($ret_log) {
            echo "<td align='center' width='40%'><font color='red'>" . $lang_admin['INDEX']['ADMIN_LOG_CHG'] . "</font></td>";
        } else {
            echo "<td align='center' width='40%'><font color='green'>" . $lang_admin['INDEX']['ADMIN_LOG_FINE'] . "</font></td>";
        }
        if($ret_log != -1 && $ret_log != -2) {
            echo "<td align='center' width='30%'>[ <a href='".$admin_file.".php?op=viewadminlog&amp;log=admin'>".$lang_admin['INDEX']['ADMIN_LOG_VIEW']."</a>" . (($ret_log) ? " | <a href='".$admin_file.".php?op=adminlog_ack&amp;log=admin'>".$lang_admin['INDEX']['ADMIN_LOG_ACK']."</a>" : "") ." ]</td>";
        }
        echo "</tr>";
        $ret_log = log_size('error');
        $img = ($ret_log == -1 || $ret_log == -2 || $ret_log) ? 'bad' : 'ok';
        echo "<tr><td width='8%'>"
            ."<img src='images/evo/$img.png' alt='' width='10' height='10' /></td><td width='22%'><em>".$lang_admin['INDEX']['ERROR_LOG_TITLE']."</em>:</td>";
        if($ret_log == -1) {
            echo "<td align='center' width='40%'><font color='red'>" . $lang_admin['INDEX']['ERROR_LOG_ERR'] . "</font></td>";
        } elseif($ret_log == -2) {
            echo "<td align='center' width='40%'><font color='red'>" . $lang_admin['INDEX']['ERROR_LOG_ERRCHMOD'] . "</font></td>";
        } elseif($ret_log) {
            echo "<td align='center' width='40%'><font color='red'>" . $lang_admin['INDEX']['ERROR_LOG_CHG'] . "</font></td>";
        } else {
            echo "<td align='center' width='40%'><font color='green'>" . $lang_admin['INDEX']['ERROR_LOG_FINE'] . "</font></td>";
        }
        if($ret_log != -1 && $ret_log != -2) {
            echo "<td align='center' width='30%'>[ <a href='".$admin_file.".php?op=viewadminlog&amp;log=error'>".$lang_admin['INDEX']['ADMIN_LOG_VIEW']."</a>" . (($ret_log) ? " | <a href='".$admin_file.".php?op=adminlog_ack&amp;log=error'>".$lang_admin['INDEX']['ADMIN_LOG_ACK']."</a>" : "") ." ]</td>";
        }
        echo "</tr>\n</table>\n</center>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        include_once(NUKE_ADMIN_MODULE_DIR . 'version.php');
        echo "<center><strong><font size='3'>".$lang_admin['INDEX']['VERSIONCTL_TITLE']."</font></strong><br /><br />";
        evo_version_check();
        echo "</center>";
        CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>'.$lang_admin['KERNEL']['ERROR'].'</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS']);
}

?>