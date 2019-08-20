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
 Nuke-Evo Author        :       ReOrGaNiSatiOn

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

if (!defined('MODULE_FILE')) {
   die ('You can\'t access this file directly...');
}

define('IN_PHPBB', TRUE);
include($phpbb_root_path . 'common.php');
include_once(NUKE_FORUMS_DIR .'nukebb.php');

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_VIEWONLINE);
init_userprefs($userdata);
//
// End session management
//

//
// Output page header and load viewonline template
//
$page_title = $lang['Who_is_Online'];
include_once(NUKE_INCLUDE_DIR.'page_header.php');

$template->set_filenames(array(
        'body' => 'viewonline_body.tpl')
);

$sessions_online = array();
$sessions_online = phpBB_whoisonline(FALSE);

$template->assign_vars(array(
        'L_WHOSONLINE' => $lang['Who_is_Online'],
        'L_ONLINE_EXPLAIN' => $lang['Online_explain'],
        'L_USERNAME' => $lang['Username'],
        'L_FORUM_LOCATION' => $lang['Forum_Location'],
        'L_LAST_UPDATE' => $lang['Last_updated'],
        'L_STATISTIC_LAST_UPDATED' => $lang['Statistic_last_updated'].':',
        'L_ONLINE_TIME' => $lang['Online_time'],
        'STATISTIC_LAST_UPDATED' => formatTimestamp($sessions_online[0]['stat_created']))
);


if ( ($sessions_online[0]['count_sessions'] > 0)) {
    $count_hidden       = $sessions_online[0]['count_hidden'];
    $count_reg_user     = $sessions_online[0]['count_reg_user'];
    $count_guests       = $sessions_online[0]['count_guests'];
    $count_last_update  = $sessions_online[0]['stat_created'];
    $count_sess         = $sessions_online[0]['count_sessions'];
    for ( $i = 1; $i < $count_sess; $i++) {
        if ( ($sessions_online[$i]['is_hidden'] == 1 || is_mod_admin('super')) && $sessions_online[$i]['isactive'] ) {
            $sess_username  = $sessions_online[$i]['username'];
            $sess_userid    = $sessions_online[$i]['user_id'];
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
    
            $row_color = ( $count_sess % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( $count_sess % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

            if ( ($sess_guest == 0) || ($sess_guest == 2) ) {
                $template->assign_block_vars('reg_user_row', array(
                        'ROW_COLOR'     => '#' . $row_color,
                        'ROW_CLASS'     => $row_class,
                        'U_USER_ACTIVE' => ($sess_isactive == TRUE) ? evo_image('ok.png', 'evo') : evo_image('bad.png', 'evo'),
                        'USERNAME'      => $username,
                        'STARTED'       => $sess_start_date,
                        'LASTUPDATE'    => $sess_lastupd,
                        'ONLINETIME'    => $sess_active_time['days']._ABR_DAYS.':'.$sess_active_time['hours']._ABR_HOURS.':'.$sess_active_time['minutes']._ABR_MINUTES.':'.$sess_active_time['seconds']._ABR_SECONDS,
                        'FORUM_LOCATION' => (!empty($sess_module)) ? str_replace('_', ' ', $sess_module) : 'Forum ACP',
                        'IP_ADDRESS' => $sess_hostadr,
                        'U_WHOIS_IP' => 'http://www.db.ripe.net/whois/?form_type=simple&amp;searchtext=' . $sess_hostadr,
                        'U_USER_PROFILE' => append_sid('profile.php?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $sess_userid),
                        'U_FORUM_LOCATION' => $sess_url
                    )
                );
            } else {
                $template->assign_block_vars('guest_user_row', array(
                        'ROW_COLOR'     => '#' . $row_color,
                        'ROW_CLASS'     => $row_class,
                        'U_USER_ACTIVE' => ($sess_isactive == TRUE) ? evo_image('ok.png', 'evo') : evo_image('bad.png', 'evo'),
                        'USERNAME'      => (is_admin()) ? $username : $lang['Guest'],
                        'STARTED'       => $sess_start_date,
                        'LASTUPDATE'    => $sess_lastupd,
                        'ONLINETIME'    => $sess_active_time['days']._ABR_DAYS.':'.$sess_active_time['hours']._ABR_HOURS.':'.$sess_active_time['minutes']._ABR_MINUTES.':'.$sess_active_time['seconds']._ABR_SECONDS,
                        'FORUM_LOCATION' => (!empty($sess_module)) ? str_replace('_', ' ', $sess_module) : 'Forum ACP',
                        'IP_ADDRESS' => $sess_hostadr,
                        'U_WHOIS_IP' => 'http://dnsstuff.com/tools/whois.ch?cache=off&amp;ip=' . $sess_hostadr,
                        'U_USER_PROFILE' => (is_admin()) ? 'http://dnsstuff.com/tools/whois.ch?cache=off&amp;ip=' . $sess_hostadr : '',
                        'U_FORUM_LOCATION' => $sess_url
                    )
                );
            }
        }
    }
} else {
    $template->assign_vars(array(
        'L_NO_REGISTERED_USERS_BROWSING' => $lang['No_users_browsing'],
        'L_NO_GUESTS_BROWSING' => $lang['No_users_browsing'])
    );
}

if( $count_reg_user == 0 ) {
    $l_r_user_s = $lang['Reg_users_zero_online'];
}
else if( $count_reg_user == 1 ) {
    $l_r_user_s = $lang['Reg_user_online'];
} else {
    $l_r_user_s = $lang['Reg_users_online'];
}
if( $count_hidden == 0 ) {
    $l_h_user_s = $lang['Hidden_users_zero_online'];
} else if( $count_hidden == 1 ) {
    $l_h_user_s = $lang['Hidden_user_online'];
} else {
    $l_h_user_s = $lang['Hidden_users_online'];
}
if( $count_guests == 0 ) {
    $l_g_user_s = $lang['Guest_users_zero_online'];
} else if( $count_guests == 1 ) {
    $l_g_user_s = $lang['Guest_user_online'];
} else {
    $l_g_user_s = $lang['Guest_users_online'];
}

$template->assign_vars(array(
    'TOTAL_REGISTERED_USERS_ONLINE' => sprintf($l_r_user_s, $count_reg_user) . sprintf($l_h_user_s, $count_hidden),
    'TOTAL_GUEST_USERS_ONLINE' => sprintf($l_g_user_s, $count_guests))
);

$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>