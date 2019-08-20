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

define('IN_PHPBB', TRUE);
// Load default header
//
$no_page_header = TRUE;
require_once(dirname(__FILE__) . '/pagestart.php');
require_once(NUKE_INCLUDE_DIR . 'functions_log.php');

global $db_name, $currentlang, $userinfo, $ThemeSel, $board_config, $_GETVAR, $lang, $table_prefix, $images;
// ---------------
// Begin functions
//
function inarray($needle, $haystack) {
    for($i = 0; $i < count($haystack); $i++ ) {
        if( $haystack[$i] == $needle ) {
            return true;
        }
    }
    return false;
}

//
// End functions
// -------------

$var_vchk   = $_GETVAR->get('vchk', 'get', 'string', NULL);
$var_op     = $_GETVAR->get('op', 'get', 'string', NULL);
$var_pane   = $_GETVAR->get('pane', 'get', 'string', NULL);
$file       = $_GETVAR->get('file', '_REQUEST', 'string', NULL);
//
// Generate relevant output
//
if ( isset($var_pane) && $var_pane == 'main' ) {
    if (@file_exists(NUKE_FORUMS_ADMIN_DIR . $file.'.php')) {
        if ( !empty($no_page_header) ) {
            // Not including the pageheader can be neccesarry if META tags are
            // needed in the calling script.
            define('PHPBB_ADMIN', TRUE);
            include_once(NUKE_FORUMS_ADMIN_DIR.'page_header_admin.php');
        }
        include_once(NUKE_FORUMS_ADMIN_DIR . $file.'.php');
    }
} elseif ( isset($var_pane) && $var_pane == 'left' ) {
    define('PHPBB_BOARD_CONFIG', TRUE);
    $dir = @opendir(NUKE_FORUMS_ADMIN_DIR);
    $setmodules = 1;
    while( $file = @readdir($dir) ) {
        if( preg_match('/^admin_.*?\.php$/', $file) ) {
            include_once(NUKE_FORUMS_ADMIN_DIR . $file);
        }
    }
    @closedir($dir);
    unset($setmodules);
    if ( !empty($no_page_header) ) {
        // Not including the pageheader can be neccesarry if META tags are
        // needed in the calling script.
        define('PHPBB_ADMIN', TRUE);
        include_once(NUKE_FORUMS_ADMIN_DIR.'page_header_admin.php');
    }
    $template->set_filenames(array(
        'body' => 'admin/index_navigate.tpl')
    );
    $template->assign_vars(array(
        'U_FORUM_INDEX'     => append_sid('index.php'),
        'U_FORUM_PREINDEX'  => append_sid('index.php'),
        'U_ADMIN_INDEX'     => admin_sid('index.php?pane=right'),
        'PHPBB_LOGO_IMG'    => $images['phpbb_logo'],
        'COOKIE_NAME'       => $board_config['cookie_name'],
        'COOKIE_PATH'       => $board_config['cookie_path'],
        'COOKIE_DOMAIN'     => $board_config['cookie_domain'],
        'COOKIE_SECURE'     => $board_config['cookie_secure'],
        'U_ADMIN_NUKE'      => ADMIN_NUKE,
        'U_HOME_NUKE'       => HOME_NUKE,
        'L_FORUM_INDEX'     => $lang['Main_index'],
        'L_ADMIN_INDEX'     => $lang['Admin_Index'],
        'L_PREVIEW_FORUM'   => $lang['Preview_forum'],
        'L_ADMIN_NUKE'      => $lang['Admin_Nuke'],
        'L_HOME_NUKE'       => $lang['Home_Nuke'],)
        );

        ksort($module);
        $menu_cat_id = 0;
    while( list($cat, $action_array) = each($module) ) {
        $cat = ( !empty($lang[$cat]) ) ? $lang[$cat] : preg_replace('/_/', ' ', $cat);
        $template->assign_block_vars('catrow', array(
            'MENU_CAT_ID' => $menu_cat_id,
            'MENU_CAT_ROWS' => count($action_array),
            'ADMIN_CATEGORY' => $cat)
        );
        ksort($action_array);
        $row_count = 0;
        while( list($action, $file)   = each($action_array) ) {
            $row_color = ( !($row_count%2) ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( !($row_count%2) ) ? $theme['td_class1'] : $theme['td_class2'];
            $action = ( !empty($lang[$action]) ) ? $lang[$action] : preg_replace('/_/', ' ', $action);
            $template->assign_block_vars('catrow.modulerow', array(
                'ROW_COUNT'     => $row_count,
                'ROW_COLOR'     => '#' . $row_color,
                'ROW_CLASS'     => $row_class,
                'ADMIN_MODULE'  => $action,
                'U_ADMIN_MODULE' => admin_sid(str_replace('.php', '', $file)) )
            );
            $row_count++;
        }
        $menu_cat_id++;
    }
    $template->pparse('body');
    include(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
} elseif( isset($var_pane) && $var_pane == 'right' ) {
    $template->set_filenames(array(
        'body' => 'admin/index_body.tpl')
    );
    if(defined('ADMIN_IP_LOCK')) {
        $admin_ip_lock = $lang['ADMIN_IP_LOCK_ON'];
        $admin_ip_lock_img = evo_image('ok.png', 'evo');
    } else {
        $admin_ip_lock = $lang['ADMIN_IP_LOCK_OFF'];
        $admin_ip_lock_img = evo_image('bad.png', 'evo');
    }
    define('PHPBB_ADMIN', TRUE);
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_header_admin.php');
    $template->assign_vars(array(
        'L_WELCOME'             => $lang['Welcome_phpBB'],
        'L_ADMIN_INTRO'         => $lang['Admin_intro'],
        'L_FORUM_STATS'         => $lang['Forum_stats'],
        'L_WHO_IS_ONLINE'       => $lang['Who_is_Online'],
        'L_USERNAME'            => $lang['Username'],
        'L_LOCATION'            => $lang['Location'],
        'L_LAST_UPDATE'         => $lang['Last_updated'],
        'L_IP_ADDRESS'          => $lang['IP_Address'],
        'L_STATISTIC'           => $lang['Statistic'],
        'L_VALUE'               => $lang['Value'],
        'L_NUMBER_POSTS'        => $lang['Number_posts'],
        'L_POSTS_PER_DAY'       => $lang['Posts_per_day'],
        'L_NUMBER_TOPICS'       => $lang['Number_topics'],
        'L_TOPICS_PER_DAY'      => $lang['Topics_per_day'],
        'L_NUMBER_USERS'        => $lang['Number_users'],
        'L_USERS_PER_DAY'       => $lang['Users_per_day'],
        'L_BOARD_STARTED'       => $lang['Board_started'],
        'L_AVATAR_DIR_SIZE'     => $lang['Avatar_dir_size'],
        'L_DB_SIZE'             => $lang['Database_size'],
        'L_FORUM_LOCATION'      => $lang['Forum_Location'],
        'L_STARTED'             => $lang['Joined'],
        'L_NUMBER_DEACTIVATED_USERS' => $lang['Thereof_deactivated_users'],
        'L_NAME_DEACTIVATED_USERS'   => $lang['Deactivated_Users'],
        'L_NUMBER_MODERATORS'   => $lang['Thereof_Moderators'],
        'L_NAME_MODERATORS'     => $lang['Users_with_Mod_Privileges'],
        'L_NUMBER_ADMINISTRATORS'    => $lang['Thereof_Administrators'],
        'L_NAME_ADMINISTRATORS' => $lang['Users_with_Admin_Privileges'],
        'L_DB_SIZE'             => $lang['DB_size'],
        'L_PHP_VERSION'         => $lang['Version_of_PHP'],
        'L_MYSQL_VERSION'       => $lang['Version_of_MySQL'],
        'SPACER_IMG'            => $images['spacer'],
        'L_ADMIN_IP_LOCK'       => $lang['ADMIN_IP_LOCK'],
        'ADMIN_IP_LOCK_IMAGE'   => $admin_ip_lock_img,
        'ADMIN_IP_LOCK_ED'      => $admin_ip_lock,
        'L_GZIP_COMPRESSION'    => $lang['Gzip_compression'])
    );
    //
    // Get forum statistics
    //
    $total_posts = get_db_stat('postcount');
    $total_users = get_db_stat('usercount');
    $total_topics = get_db_stat('topiccount');
    $count = 0;
    $deactivated_names = '';
    $sql = 'SELECT username FROM ' . USERS_TABLE . '
            WHERE user_active = 0
            AND user_level <> -1
            AND user_id <> ' . ANONYMOUS . '
            ORDER BY username';
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR,'Couldn\'t get statistic data!', __LINE__, __FILE__, $sql);
    }
    while ( $row = $db->sql_fetchrow($result) ) {
        $deactivated_names .= (($deactivated_names == '') ? '' : ', ') . UsernameColor($row['username']);
        $count++;
    }
    $total_deactivated_users = $count;
    $db->sql_freeresult($result);
    $moderator_names = '';
    $count = 0;
    $sql = 'SELECT username
            FROM ' . USERS_TABLE . '
            WHERE user_level = ' . MOD . '
            AND user_id <> ' . ANONYMOUS;
    if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR,'Couldn\'t get statistic data!', __LINE__, __FILE__, $sql);
    }
    while ( $row = $db->sql_fetchrow($result) ) {
        $moderator_names .= (($moderator_names == '') ? '' : ', ') . UsernameColor($row['username']);
        $count++;
    }
    $total_moderators = $count;
    $db->sql_freeresult($result);
    $count = 0;
    $administrator_names = '';
    $sql = 'SELECT username FROM ' . USERS_TABLE . '
            WHERE user_level = ' . ADMIN . '
            AND user_id <> ' . ANONYMOUS . '
            ORDER BY username';
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR,'Couldn\'t get statistic data!', __LINE__, __FILE__, $sql);
    }
    while ( $row = $db->sql_fetchrow($result) ) {
        $administrator_names .= (($administrator_names == '') ? '' : ', ') . UsernameColor($row['username']);
        $count++;
    }
    $db->sql_freeresult($result);
    $total_administrators = $count;
    $start_date = create_date($board_config['default_dateformat'], $board_config['board_startdate'], $board_config['board_timezone']);
    $boarddays = ( time() - $board_config['board_startdate'] ) / 86400;
    $posts_per_day = sprintf('%.2f', $total_posts / $boarddays);
    $topics_per_day = sprintf('%.2f', $total_topics / $boarddays);
    $users_per_day = sprintf('%.2f', $total_users / $boarddays);
    $avatar_dir_size = 0;
    if ($avatar_dir = @opendir(NUKE_BASE_DIR . $board_config['avatar_path'])) {
        while( $file = @readdir($avatar_dir) ) {
            if( $file != '.' && $file != '..' ) {
                $avatar_dir_size += @filesize(NUKE_BASE_DIR . $board_config['avatar_path'] . '/' . $file);
            }
        }
        @closedir($avatar_dir);
        //
        // This bit of code translates the avatar directory size into human readable format
        // Borrowed the code from the PHP.net annoted manual, origanally written by:
        // Jesse (jesse@jess.on.ca)
        //
        if($avatar_dir_size >= 1048576) {
            $avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . ' MB';
        } else if($avatar_dir_size >= 1024) {
            $avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . ' KB';
        } else {
            $avatar_dir_size = $avatar_dir_size . ' Bytes';
        }
    } else {
        // Couldn't open Avatar dir.
        $avatar_dir_size = $lang['Not_available'];
    }
    if($posts_per_day > $total_posts) {
        $posts_per_day = $total_posts;
    }
    if($topics_per_day > $total_topics) {
        $topics_per_day = $total_topics;
    }
    if($users_per_day > $total_users)  {
        $users_per_day = $total_users;
    }

    //
    // DB size ... MySQL only
    //
    // This code is heavily influenced by a similar routine
    // in phpMyAdmin 2.2.0
    //
    if( preg_match('/^mysql/', SQL_LAYER) ) {
        $sql = 'SELECT VERSION() AS mysql_version';
        if($result = $db->sql_query($sql)) {
            $row = $db->sql_fetchrow($result);
            $version = $row['mysql_version'];
            if( preg_match('/^(3\.23|4\.|5\.|6\.)/', $version) ) {
                $db_name = ( preg_match('/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)|(5\.)|(6\.)/', $version) ) ? "`$dbname`" : $dbname;
                $sql = 'SHOW TABLE STATUS FROM ' . $db_name;
                $result1 = $db->sql_query($sql);
                $dbsize = 0;
                while ($rowset = $db->sql_fetchrow($result1)) {
                    $dbsize += $rowset['Data_length'] + $rowset['Index_length'];
                }
                $db->sql_freeresult($result1);
            } else {
                $dbsize = $lang['Not_available'];
            }
        } else {
            $dbsize = $lang['Not_available'];
        }
        $db->sql_freeresult($result);
    } else if( preg_match('/^mssql/', SQL_LAYER) ) {
        $sql = 'SELECT ((SUM(size) * 8.0) * 1024.0) as dbsize
                FROM sysfiles';
        if( $result = $db->sql_query($sql) ) {
            $dbsize = ( $row = $db->sql_fetchrow($result) ) ? intval($row['dbsize']) : $lang['Not_available'];
        } else {
            $dbsize = $lang['Not_available'];
        }
    } else {
        $dbsize = $lang['Not_available'];
    }
    if ( is_integer($dbsize) ) {
        if( $dbsize >= 1048576 ) {
            $dbsize = sprintf('%.2f MB', ( $dbsize / 1048576 ));
        } else if( $dbsize >= 1024 ) {
            $dbsize = sprintf('%.2f KB', ( $dbsize / 1024 ));
        } else {
            $dbsize = sprintf('%.2f Bytes', $dbsize);
        }
    }
    $sql = 'SELECT VERSION() AS mysql_version';
    $result = $db->sql_query($sql);
    if ( !$result ) {
        message_die(GENERAL_ERROR,'Couldn\'t obtain MySQL Version', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $mysql_version = $row['mysql_version'];
    $db->sql_freeresult($result);
    $template->assign_vars(array(
        'NUMBER_OF_POSTS'       => $total_posts,
        'NUMBER_OF_TOPICS'      => $total_topics,
        'NUMBER_OF_USERS'       => $total_users,
        'START_DATE'            => $start_date,
        'POSTS_PER_DAY'         => $posts_per_day,
        'TOPICS_PER_DAY'        => $topics_per_day,
        'USERS_PER_DAY'         => $users_per_day,
        'AVATAR_DIR_SIZE'       => $avatar_dir_size,
        'DB_SIZE'               => $dbsize,
        'PHP_VERSION'           => phpversion(),
        'MYSQL_VERSION'         => $mysql_version,
        'NUMBER_OF_DEACTIVATED_USERS'   => $total_deactivated_users,
        'NUMBER_OF_MODERATORS'  => $total_moderators,
        'NUMBER_OF_ADMINISTRATORS'      => $total_administrators,
        'NAMES_OF_ADMINISTRATORS'       => $administrator_names,
        'NAMES_OF_MODERATORS'   => $moderator_names,
        'NAMES_OF_DEACTIVATED'  => $deactivated_names,
        'GZIP_COMPRESSION'      => ( $board_config['gzip_compress'] ) ? $lang['ON'] : $lang['OFF'])
    );
    //
    // End forum statistics
    //

    //
    // Get users online information.
    //
    $sessions_online = array();
    $sessions_online = phpBB_whoisonline(TRUE);
    $template->assign_vars(array(
        'L_STATISTIC_LAST_UPDATED' => $lang['Statistic_last_updated'].':',
        'L_ONLINE_TIME' => $lang['Online_time'],
        'STATISTIC_LAST_UPDATED' => formatTimestamp($sessions_online[0]['stat_created']))
    );
    if ( ($sessions_online[0]['stat_created'] != FALSE) && ($sessions_online[0]['count_sessions'] > 0)) {
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
            $username = (!empty($sessions_online[$i]['username_color'])) ? $sessions_online[$i]['username_color'] : $sessions_online[$i]['username'];
            if ( ($sess_guest == 0) || ($sess_guest == 2) ) {
                $userprofile = '<a href="'.admin_sid('file=admin_users&amp;mode=edit&amp;' . POST_USERS_URL . '=' . get_user_field('user_id', $sess_username, TRUE)).'" class="gen">'.$username.'</a>';
            } else {
                $userprofile = '<span class="gensmall">'.$username.'</span>';
            }

            $row_color = ( $count_sess % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( $count_sess % 2 ) ? $theme['td_class1'] : $theme['td_class2'];
            $template->assign_block_vars('reg_user_row', array(
                'ROW_COLOR'     => '#' . $row_color,
                'ROW_CLASS'     => $row_class,
                'U_USER_ACTIVE' => ($sess_isactive == TRUE) ?  evo_image('ok.png', 'evo') :  evo_image('bad.png', 'evo'),
                'STARTED'       => $sess_start_date,
                'LASTUPDATE'    => $sess_lastupd,
                'ONLINETIME'    => $sess_active_time['days']._ABR_DAYS.':'.$sess_active_time['hours']._ABR_HOURS.':'.$sess_active_time['minutes']._ABR_MINUTES.':'.$sess_active_time['seconds']._ABR_SECONDS,
                'FORUM_LOCATION' => (!empty($sess_module)) ? str_replace('_', ' ', $sess_module) : 'Forum ACP',
                'IP_ADDRESS'    => $sess_hostadr,
                'U_WHOIS_IP'    => 'http://www.db.ripe.net/whois/?form_type=simple&amp;searchtext=' . $sess_hostadr,
                'U_USER_PROFILE' => $userprofile,
                'U_FORUM_LOCATION' => $sess_url
                )
            );
        }
    } else {
        $template->assign_vars(array(
            'L_NO_REGISTERED_USERS_BROWSING' => $lang['No_users_browsing'],
            'L_NO_GUESTS_BROWSING' => $lang['No_users_browsing'])
        );
    }

    $template->pparse('body');
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
} else {
    //
    // Generate frameset
    //
    global $doctype;
    $doctype = 'frameset';
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_header_admin.php');
    if(isset($file) && ($file == 'Groups' || $file == 'xdata_fields' )) {
        $mainframe = ($file == 'Groups') ? admin_sid('admin_groups.php') : admin_sid('admin_xdata_fields.php?mode=add');
    } else {
        $mainframe = NUKE_HREF_BASE_DIR .'admin.php?op=forums&amp;pane=right';
    }
    $frameset  = "<frameset cols='200,*' rows='*' >\n";
    $frameset .= "    <frame src='".NUKE_HREF_BASE_DIR ."admin.php?op=forums&amp;pane=left' name='nav' frameborder='1' marginwidth='3' marginheight='3' scrolling='auto' />\n";
    $frameset .= "    <frame src='".$mainframe."' name='main' frameborder='1' marginwidth='10' marginheight='10' scrolling='auto' />\n";
    $frameset .= "    <noframes>\n";
    $frameset .= "        <body bgcolor='#FFFFFF' text='#000000'>\n";
    $frameset .= "            <p>Sorry, your browser doesn't seem to support frames</p>\n";
    $frameset .= "        </body>\n";
    $frameset .= "    </noframes>\n";
    $frameset .= "</frameset>\n";
    log_action($lang['LOG_Accessed_Administration'], '', '', $userdata['user_id'], '', '');
    echo $frameset;
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
}

?>