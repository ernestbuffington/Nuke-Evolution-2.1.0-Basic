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

if (is_god_admin() || is_admin('super')) {
    getmodule_lang($adminpoint);

    function Info_header($info, $title) {
        global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin;
        
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=info\">" . $lang_admin[$adminpoint]['INFO_HEAD_TITLE'] . "</a></div>\n";
        echo "<br /><br />";
        echo '<div align="center">';
        echo (($info == 'general') ? '<strong>'.$lang_admin[$adminpoint]['INFO_TITLE_GENERALINFO'].'</strong>' : '<a href="'.$admin_file.'.php?module=info&amp;op=info">'.$lang_admin[$adminpoint]['INFO_TITLE_GENERALINFO'].'</a>').' |
        '.(($info == 'getcore') ? '<strong>'.$lang_admin[$adminpoint]['INFO_TITLE_PHPCORE'].'</strong>' : '<a href="'.$admin_file.'.php?module=info&amp;op=core">'.$lang_admin[$adminpoint]['INFO_TITLE_PHPCORE'].'</a>').' |
        '.(($info == 'getenv') ? '<strong>'.$lang_admin[$adminpoint]['INFO_TITLE_PHPENVIRONMENT'].'</strong>' : '<a href="'.$admin_file.'.php?module=info&amp;op=envi">'.$lang_admin[$adminpoint]['INFO_TITLE_PHPENVIRONMENT'].'</a>').' |
        '.(($info == 'getmods') ? '<strong>'.$lang_admin[$adminpoint]['INFO_TITLE_PHPMODULES'].'</strong>' : '<a href="'.$admin_file.'.php?module=info&amp;op=mods">'.$lang_admin[$adminpoint]['INFO_TITLE_PHPMODULES'].'</a>').' |
        '.(($info == 'getvars') ? '<strong>'.$lang_admin[$adminpoint]['INFO_TITLE_PHPVARIABLES'].'</strong>' : '<a href="'.$admin_file.'.php?module=info&amp;op=vars">'.$lang_admin[$adminpoint]['INFO_TITLE_PHPVARIABLES'].'</a>');
        if(SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') {
            echo '| '.(($info == 'getmysql') ? '<strong>'.$lang_admin[$adminpoint]['INFO_TITLE_MYSQL'].'</strong>' : '<a href="'.$admin_file.'.php?module=info&amp;op=datab">'.$lang_admin[$adminpoint]['INFO_TITLE_MYSQL'].'</a>');
        }
        echo '</div>';
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['MESSAGES_RETURNMAIN'] . "</a> ]</div>\n";
        CloseTable();
        echo '<br />';
        OpenTable();
        echo '<fieldset><legend><strong>'.$title.'</strong></legend><br />';
        echo "<div style=\"overflow:auto; height:600px; width:700px;\" align=\"center\">";
    }

    function Info_footer() {
        echo '</div>';
        echo '</fieldset>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function Info_getphpinfo($mode) {
        ob_start();
        phpinfo($mode);
        $info_cache = ob_get_contents();
        ob_end_clean();
        wordwrap($info_cache);
        $info_cache = preg_split('/(<body>|<\/body>)/', $info_cache, -1, PREG_SPLIT_NO_EMPTY);
        if ($mode != INFO_MODULES) {
            $info_cache = preg_split('/(<table border="0" cellpadding="3" width="600">|<\/table>)/', $info_cache[1], -1, PREG_SPLIT_NO_EMPTY);
            if ($mode == INFO_GENERAL) {
                $info_cache = str_replace('<td', '<td', $info_cache[3]);
                return $info_cache;
            }
        }
        $info_cache = str_replace('<td', '<td', $info_cache[1]);
        $info_cache = str_replace('<th>', '<td>', $info_cache);
        $info_cache = str_replace('</th>', '</td>', $info_cache);
        return $info_cache;
    }

    function Info_getmods() {
        global $adminpoint, $lang_admin;

        Info_header('getmods', $lang_admin[$adminpoint]['INFO_TITLE_PHPMODULES']);
        $info_cache = Info_getphpinfo(INFO_MODULES);
        $info_cache = preg_replace('#(<tr class="h">)#', '<tr>', $info_cache);
        $info_cache = preg_replace('#(<td>)#', '<td class="row1">', $info_cache);
        $info_cache = preg_replace('#(<td class="e">)#', '<td class="row3">', $info_cache);
        $info_cache = preg_replace('#(<td class="v">)#', '<td class="row3">', $info_cache);
        $info_cache = preg_replace('#module_Zend Optimizer#', 'module_Zend_Optimizer', $info_cache);
        $info_cache = preg_replace('#(<th colspan="2">)#', '<td class="row1" colspan="2">', $info_cache);
        $info_cache = preg_replace('#(<div class="center">|<\/div>)#', '', $info_cache);
        $info_cache = preg_replace('#(<h2>)#', '<tr><td><strong>', $info_cache);
        $info_cache = preg_replace('#(<\/h2>)#', '</strong></td></tr>', $info_cache);
        $info_cache = preg_split('/(<table border="0" cellpadding="3" width="600">|<\/table><br \/>|<\/table><br \/>)/', $info_cache, -1, PREG_SPLIT_NO_EMPTY);
        for ($i=0, $maxi=count($info_cache); $i < $maxi; $i++) {
            if (strlen($info_cache[$i]) > 1) {
                    echo '<table width="100%" style="border-collapse: collapse">'.$info_cache[$i].'</table>';
            }
        }
        Info_footer();
    }

    function Info_getcore() {
        global $adminpoint, $lang_admin;
        
        Info_header('getcore', $lang_admin[$adminpoint]['INFO_TITLE_PHPCORE']);
        $info_core = Info_getphpinfo(INFO_CONFIGURATION);
        $info_core = preg_replace('#(<tr class="h">)#', '<tr>', $info_core);
        $info_core = preg_replace('#(<td>)#', '<td class="row1">', $info_core);
        $info_core = preg_replace('#(<td class="e">)#', '<td class="row3">', $info_core);
        $info_core = preg_replace('#(<td class="v">)#', '<td class="row3">', $info_core);
        echo '<table width="100%" style="border-collapse: collapse" cellpadding="0" cellspacing="1">'.$info_core.'</table>';
        Info_footer();
    }

    function Info_getenv() {
        global $adminpoint, $lang_admin;

        Info_header('getenv', $lang_admin[$adminpoint]['INFO_TITLE_PHPENVIRONMENT']);
        $info_envi = Info_getphpinfo(INFO_ENVIRONMENT);
        $info_envi = preg_replace('#(<tr class="h">)#', '<tr>', $info_envi);
        $info_envi = preg_replace('#(<td>)#', '<td class="row1">', $info_envi);
        $info_envi = preg_replace('#(<td class="e">)#', '<td class="row3">', $info_envi);
        $info_envi = preg_replace('#(<td class="v">)#', '<td class="row3">', $info_envi);
        echo '<table width="100%" style="border-collapse: collapse" cellpadding="0" cellspacing="1">'.$info_envi.'</table>';
        Info_footer();
    }

    function Info_getvars() {
        global $adminpoint, $lang_admin;

        Info_header('getvars', $lang_admin[$adminpoint]['INFO_TITLE_PHPVARIABLES']);
        $info_vars = Info_getphpinfo(INFO_VARIABLES);
        $info_vars = preg_replace('#(<tr class="h">)#', '<tr>', $info_vars);
        $info_vars = preg_replace('#(<td>)#', '<td class="row1">', $info_vars);
        $info_vars = preg_replace('#(<td class="e">)#', '<td class="row3">', $info_vars);
        $info_vars = preg_replace('#(<td class="v">)#', '<td class="row3">', $info_vars);
        echo '<table width="100%" style="border-collapse: collapse" cellpadding="0" cellspacing="1">'.$info_vars.'</table>';
        Info_footer();
    }

    function Info_getmysql() {
        global $db, $adminpoint, $lang_admin;

        Info_header('getmysql', $lang_admin[$adminpoint]['INFO_TITLE_MYSQL']);
//        SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli'
        $stat = preg_split('/:\s+([0-9]*\.?[0-9]*)/', mysql_stat($db->connect_id), -1, PREG_SPLIT_DELIM_CAPTURE ^ PREG_SPLIT_NO_EMPTY);
        $days = intval($stat[1] / 86400);
        $stat[1] -= ($days * 86400);
        $hrs = intval($stat[1] / 3600);
        $stat[1] -= ($hrs * 3600);
        $mins = intval($stat[1] / 60);
        $stat[1] -= ($mins * 60);
        $secs = $stat[1];
        $stat[1] = $days . "D " . $hrs . "H " . $mins . "M " . $secs . "S";
        echo '<table width="100%" style="border-collapse: collapse" cellpadding="0" cellspacing="1">
              <tr><td valign="top">
              <table border="0">
              <tr><td valign="top"><div><strong>Quick Stats:</strong></div></td></tr>
              <tr><td><strong>Server Version:</strong></td><td>' .mysql_get_server_info($db->connect_id) . '</td></tr>
              <tr><td><strong>Client Version:</strong></td><td>' . mysql_get_client_info() . '</td></tr>
              <tr><td><strong>Host Connection:</strong></td><td>' . mysql_get_host_info($db->connect_id) . '</td></tr>';

        for ($i = 0; isset($stat[$i]); $i += 2) {
            $val = $stat[$i + 1];
            if (is_numeric($val)) {
                if (fmod($val, 1.0) == 0) {
                    $val = number_format($val);
                } else {
                    $val = number_format($val, 3);
                }
            }
            echo "<tr><td><strong>" . $stat[$i] . "</strong></td><td>" . $val . "</td></tr>";
        }
        echo '</table></td>';
        // complete status
        $res = $db->sql_query("SHOW STATUS");
        echo '<td valign="top">
              <table border="0"><tr><td><div><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_EXTENDED'].':</strong></div></td></tr>
              <tr><td><select name="status" size="13">';
        while ($row = $db->sql_fetchrow($res, SQL_NUM)) {
            echo '<option>'.$row[0].'&nbsp;=&nbsp;'.$row[1].'</option>';
        }
        echo '</select></td></tr></table></td>';
        echo '</tr><tr><td colspan="3"></td></tr><tr><td colspan="3">
              <table width="100%" border="0">
              <tr><td colspan="8"><div><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES'].':</strong></div></td></tr>
              <tr><td><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_ID'].'</strong></td>
              <td><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_USER'].'</strong></td>
              <td><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_HOST'].'</strong></td>
              <td><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_DATABASE'].'</strong></td>
              <td><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_COMMAND'].'</strong></td>
              <td><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_TIME'].'</strong></td>
              <td><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_STATE'].'</strong></td>
              <td><strong>'.$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_INFO'].'</strong></td></tr>';
        $res = mysql_list_processes();
        while ($row = $db->sql_fetchrow($res)) {
            echo '<tr><td>' . $row['Id'] . '</td>';
            echo '<td>' . $row['User'] . '</td>';
            echo '<td>' . $row['Host'] . '</td>';
            echo '<td>' . $row['db'] . '</td>';
            echo '<td>' . $row['Command'] . '</td>';
            echo '<td>' . $row['Time'] . '</td>';
            echo '<td>' . $row['State'] . '&nbsp;</td>';
            echo '<td>' . $row['Info'] . '&nbsp;</td></tr>';
        }
        echo '</table></td></tr></table>';
        Info_footer();
    }

    function Info_menu() {
        global $db, $adminpoint, $lang_admin;
    
        Info_header('general', $lang_admin[$adminpoint]['INFO_TITLE_GENERALINFO']);
        echo '<table width="100%" style="border-collapse: collapse" cellpadding="0" cellspacing="1">
              <tr><td class="row1" height="20"><strong>Setting</strong></td><td class="row1" height="20"><strong>Value</strong></td></tr>
              <tr><td class="row3">CMS Root</td><td class="row3">'.NUKE_BASE_DIR.'</td></tr>
              <tr><td class="row3">CMS Version</td><td class="row3">'.NUKE_EVO.'</td></tr>
              <tr><td class="row3">PHP Version</td><td class="row3">'.PHPVERS.'</td></tr>
              <tr><td class="row3">GD Version</td><td class="row3">';
        if (GDSUPPORT && function_exists('gd_info')) {
            $gd = gd_info();
            echo $gd['GD Version'];
        } else {
            echo 'N/A';
        }
        if (SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') {
            $result = $db->sql_query('SELECT VERSION()');
            list($mysqlversion) = $db->sql_fetchrow($result);
            if ($mysqlversion[0] > 3) {
                echo '</td></tr>
                      <tr><td class="row3">MySQL Version</td><td class="row3">'.$mysqlversion;
            }
        }
        echo '</td></tr>';
        $session_path = session_save_path();
        if (!empty($session_path)){
            echo '<tr><td class="row3">Session save_path</td><td class="row3">'.$session_path.'</td></tr>';
        }
        $info_general = Info_getphpinfo(INFO_GENERAL);
        $info_general = preg_replace('#(<td class="e">)#', '<td class="row3">', $info_general);
        $info_general = preg_replace('#(<td class="v">)#', '<td class="row3">', $info_general);
        echo '<tr><td class="row3">Owner</td><td class="row3">'.get_current_user().' ('.getmyuid().')</td></tr>
            <tr><td class="row3">Group</td><td class="row3">'.getmygid().'</td></tr>
           '.$info_general.'
            </table>';
        Info_footer();
    }

    $op = $_GETVAR->get('op', '_REQUEST', 'string');
    
    switch ($op) {
        case 'mods':
            Info_getmods();
            break;
        case 'core':
            Info_getcore();
            break;
        case 'envi':
            Info_getenv();
            break;
        case 'vars':
            Info_getvars();
            break;
        case 'datab':
            Info_getmysql();
            break;
        case 'info':
            Info_menu();
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>