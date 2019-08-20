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
global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin, $theme;

if (is_admin()) {
    getmodule_lang($adminpoint);

    include_once(NUKE_BASE_DIR.'header.php');
    include_once(NUKE_INCLUDE_DIR.'sessions.php');
    if(!function_exists('abget_country')) {
        define_once('NUKESENTINEL_ADMIN', TRUE);
        include_once(NUKE_ADMIN_DIR . 'modules/nukesentinel/functions.php');
    }
    if ($_GETVAR->get('delete', '_GET', 'string') == 'deletesess') {
        $del_uname = $_GETVAR->get('uname', '_GET', 'string');
        $del_host  = $_GETVAR->get('hostadr', '_GET', 'string');
        if ( !empty($del_uname) && !empty($del_host)) {
            $db->sql_uquery('DELETE FROM `'._SESSION_TABLE.'` WHERE `uname`= "'.$del_uname.'" and `host_addr` = "'.$del_host.'"');
        }
    }
    $sessions_online = array();
    list($lastuser) = $db->sql_ufetchrow("SELECT username FROM " . _USERS_TABLE . " ORDER BY user_id DESC limit 0,1");
    $totalmembers = $db->sql_ufetchrow("SELECT COUNT(user_id) AS counted FROM " . _USERS_TABLE ." WHERE user_active > '0' AND user_id <> " . ANONYMOUS);
    $totalmembers = number_format($totalmembers['counted'], 0);
    $sessions_online = phpBB_whoisonline(TRUE);
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=who\">" . $lang_admin[$adminpoint]['WHO_ADMIN_HEADER'] . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['WHO_RETURNMAIN'] . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    $serverdate = EvoDate($board_config['default_dateformat'], time(), $board_config['board_timezone']);
    echo "<div align=\"center\"><strong>".EVO_SERVER_SITENAME."</strong><br /><br />";
    echo $lang_admin[$adminpoint]['WHO_Actual_Servertime'] . "<br />";
    echo "<img src=\"". evo_image('who_time.png', 'evo') ."\" align=\"bottom\" border=\"0\" title=\"" . $lang_admin[$adminpoint]['WHO_Servertime'] . "\" alt=\"\" />&nbsp;".$serverdate;
    echo "<br /><br />";
    echo $lang_admin[$adminpoint]['WHO_Statistic_last_updated'].':&nbsp;'.formatTimestamp($sessions_online[0]['stat_created']).'<br /><br />';
    echo $lang_admin[$adminpoint]['WHO_Lastuser'] . ":&nbsp;<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$lastuser."'><strong>".$lastuser."</strong></a><br />";
    echo $lang_admin[$adminpoint]['WHO_Sumuser']  . ":&nbsp;<strong>".$totalmembers."</strong></div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><img src='".evo_image('user.png', 'admin/modules')."' width='10px' height='10px' border='0' alt='' />&nbsp;=&nbsp;".$lang_admin[$adminpoint]['WHO_PicUser'].'&nbsp;||&nbsp;';
    echo "<img src='".evo_image('bot.png', 'admin/modules')."' width='10px' height='10px' border='0' alt='' />&nbsp;=&nbsp;".$lang_admin[$adminpoint]['WHO_PicBot'].'&nbsp;||&nbsp;';
    echo "<img src='".evo_image('unknown.png', 'admin/modules')."' width='10px' height='10px' border='0' alt='' />&nbsp;=&nbsp;".$lang_admin[$adminpoint]['WHO_PicUnknown']."</center>\n";
    echo "<table width='100%' cellpadding='4' cellspacing='1' border='1' class='forumline'>\n";
    echo "<tr>\n";
    echo "<th width='20%' class='thCornerL' height='25'>".$lang_admin[$adminpoint]['WHO_Username']."</th>\n";
    echo "<th width='15%' height='25' class='thTop'>".$lang_admin[$adminpoint]['WHO_SERVERNAME']."</th>\n";
    echo "<th width='15%' class='thTop'>".$lang_admin[$adminpoint]['WHO_COUNTRY']."</th>\n";
    echo "<th width='15%' class='thTop'>".$lang_admin[$adminpoint]['WHO_OnlineTime']."</th>\n";
    echo "<th width='20%' class='thTop'>".$lang_admin[$adminpoint]['WHO_UserAction']."</th>\n";
    echo "<th width='15%' height='25' class='thCornerR'>".$lang_admin[$adminpoint]['WHO_UserIPAdress']."</th>\n";
    echo "</tr>\n";
    if ( is_array($sessions_online) && ($sessions_online[0]['stat_created'] != FALSE) && ($sessions_online[0]['count_sessions'] > 0)) {
        $count_hidden       = $sessions_online[0]['count_hidden'];
        $count_reg_user     = $sessions_online[0]['count_reg_user'];
        $count_guests       = $sessions_online[0]['count_guests'];
        $count_last_update  = $sessions_online[0]['stat_created'];
        $count_sess         = $sessions_online[0]['count_sessions'];
        for ( $i = 1; $i < $count_sess; $i++) {
            $sess_username  = $sessions_online[$i]['username'];
            $sess_hostadr   = $sessions_online[$i]['hostaddr'];
            $sess_usertyp   = $sessions_online[$i]['usertyp'];
            $sess_lastupd   = $sessions_online[$i]['lastupd_date'];
            $sess_url       = str_replace("&", "&amp;", $sessions_online[$i]['url']);
            $sess_module    = $sessions_online[$i]['module'];
            $sess_isactive  = $sessions_online[$i]['isactive'];
            $sess_guest     = $sessions_online[$i]['guest'];
            $sess_active_time   = evo_timetohours($sessions_online[$i]['active_time']);
            $sess_start_date    = ($sessions_online[$i]['starttime'] > 0) ? formatTimestamp($sessions_online[$i]['starttime']) : '---';
            $username       = (!empty($sessions_online[$i]['username_color'])) ? $sessions_online[$i]['username_color'] : $sessions_online[$i]['username'];
            $row_color      = ( $count_sess % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class      = ( $count_sess % 2 ) ? $theme['td_class1'] : $theme['td_class2'];
            $onlinetime     = $sess_active_time['days'].$lang_admin[$adminpoint]['WHO_ABR_DAY'].':'.$sess_active_time['hours'].$lang_admin[$adminpoint]['WHO_ABR_HOUR'].':'.$sess_active_time['minutes'].$lang_admin[$adminpoint]['WHO_ABR_MINUTE'].':'.$sess_active_time['seconds'].$lang_admin[$adminpoint]['WHO_ABR_SECOND'];
            $sess_image     = ($sess_isactive == TRUE) ? evo_image('ok.png', 'evo') : evo_image('bad.png', 'evo');
            $sess_where_active = (!empty($sess_module)) ? str_replace('_', ' ', $sess_module) : 'Forum ACP';
            $session_delete = "<a href='".$admin_file.".php?op=who&amp;delete=deletesess&amp;hostadr=".$sess_hostadr."&amp;uname=".$sess_username."'><img src='".evo_image('delete.png', 'evo')."' height='10px' width='10px' title='".$lang_admin[$adminpoint]['WHO_DELETE_SESSION']."' alt='' /></a>\n";
            echo "<tr>\n";
            echo "<td width='20%' class='".$row_class."'>".$session_delete;
            if ( ($sess_guest == 0) || ($sess_guest == 2) ) {
                echo "<img src='".evo_image('user.png', 'admin/modules')."' width='10px' height='10px' border='0' alt='' />&nbsp;<a href='modules.php?name=Profile&amp;mode=viewprofile&amp;u=" . get_user_field('user_id', $sess_username, TRUE)."' class='gen'>".$username."</a>";
            } elseif ($sess_guest == 3) {
                echo "<img src='".evo_image('bot.png', 'admin/modules')."' width='10px' height='10px' border='0' alt='' />&nbsp;<span class='gensmall'>".$username."</span>";
            } else {
                echo "<img src='".evo_image('unknown.png', 'admin/modules')."' width='10px' height='10px' border='0' alt='' />&nbsp;<span class='gensmall'>".$username."</span>";
            }
            echo "</td>\n";
            $country_info = abget_country($sess_hostadr);
            echo "<td width='15%' align='center' class='".$row_class."'><span class='gensmall'>".gethostbyaddr($sess_hostadr)."</span></td>\n";
            echo "<td width='15%' align='center' class='".$row_class."'><span class='gensmall'>".$country_info['country']."</span></td>\n";
            echo "<td width='15%' align='center' nowrap='nowrap' class='".$row_class."'><span class='gensmall'>$onlinetime</span></td>\n";
            echo "<td width='20%' class='".$row_class."'><span class='gensmall'><a href='".$sess_url."' class='gen'>".$sess_where_active."</a></span></td>\n";
            echo "<td width='15%' class='".$row_class."'><span class='gensmall'><a href='http://network-tools.com/default.asp?prog=express&amp;host=". $sess_hostadr."' class='gen' target='_evowhois'>$sess_hostadr</a></span></td>\n";
            echo "</tr>\n";
        }
    } else {
        echo "</tr><td colspan='6' class='gen'><span class='gen'>";
        echo $lang_admin[$adminpoint]['WHO_NoUserBrowsing'];
        echo "</span></td></tr>\n";
    }
    echo "</table>";
    echo "<br /><br />";
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=who\">" . $lang_admin[$adminpoint]['WHO_REFRESH_SCREEN'] . "</a></div>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>