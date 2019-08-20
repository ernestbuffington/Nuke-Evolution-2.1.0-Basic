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

if(!defined('NUKE_EVO')) {
   die('You can\'t access this file directly...');
}

function phpBB_whoisonline($force=FALSE) {
    global $db, $evoconfig, $debugger;
    //We need only one sessions_table. So we use what we have -> nuke_sessions
    $result = $db->sql_query("SELECT * FROM `"._SESSION_TABLE."` ORDER BY `starttime` ASC");
    $count_sess     = 1;
    $count_hidden   = 0;
    $count_reg_user = 0;
    $count_guests   = 0;
    $whoisonline_sess           = array();
    if ($db->sql_numrows($result) > 0) {
        while($sessions_all = $db->sql_fetchrow($result)) {
            $whoisonline_sess[$count_sess]['username']  = $sessions_all['uname'];
            $whoisonline_sess[$count_sess]['hostaddr']  = $sessions_all['host_addr'];
            switch($sessions_all['guest']) {
                case 0: $whoisonline_sess[$count_sess]['usertyp'] = _REGISTERED;    break;
                case 1: $whoisonline_sess[$count_sess]['usertyp'] = _GUESTS;        break;
                case 2: $whoisonline_sess[$count_sess]['usertyp'] = _REGISTERED;    break;
                case 3: $whoisonline_sess[$count_sess]['usertyp'] = _BOT;           break;
            }
            $whoisonline_sess[$count_sess]['guest']     = $sessions_all['guest'];
            $whoisonline_sess[$count_sess]['starttime'] = ($sessions_all['starttime'] > 0) ? $sessions_all['starttime'] : $sessions_all['time'];
            $whoisonline_sess[$count_sess]['lastupd']   = $sessions_all['time'];
            $whoisonline_sess[$count_sess]['url']       = $sessions_all['url'];
            $whoisonline_sess[$count_sess]['module']    = $sessions_all['module'];
            $whoisonline_sess[$count_sess]['isactive']  = (($sessions_all['time'] - $evoconfig['showonlinetime']) < time()) ? TRUE : FALSE;
            if ($whoisonline_sess[$count_sess]['isactive'] == TRUE) {
                $whoisonline_sess[$count_sess]['active_time'] = time() - $whoisonline_sess[$count_sess]['starttime'];
            } else {
                $whoisonline_sess[$count_sess]['active_time'] = $whoisonline_sess[$count_sess]['starttime'];
            }
            $whoisonline_sess[$count_sess]['starttime_date']    = formatTimestamp($whoisonline_sess[$count_sess]['starttime']);
            $whoisonline_sess[$count_sess]['lastupd_date']      = formatTimestamp($sessions_all['time']);
            if ($sessions_all['guest'] == 0 || $sessions_all['guest'] == 2) {
                $whoisonline_sess[$count_sess]['username_color']    = UsernameColor($sessions_all['uname']);
                $whoisonline_sess[$count_sess]['is_hidden']         = get_user_field('user_allow_viewonline', $sessions_all['uname'], TRUE);
                $whoisonline_sess[$count_sess]['user_id']           = get_user_field('user_id', $sessions_all['uname'], TRUE);
                if ($whoisonline_sess[$count_sess]['is_hidden'] == TRUE) {
                    $count_hidden++;
                } else {
                    $count_reg_user++;
                }
            } else {
                $whoisonline_sess[$count_sess]['username_color']    = '';
                $whoisonline_sess[$count_sess]['is_hidden']         = TRUE;
                $whoisonline_sess[$count_sess]['user_id']           = '';
                $count_guests++;
            }
            $count_sess++;
        }
        $db->sql_freeresult($result);
        $whoisonline_sess[0]['count_hidden']    = $count_hidden;
        $whoisonline_sess[0]['count_reg_user']  = $count_reg_user;
        $whoisonline_sess[0]['count_guests']    = $count_guests;
        $whoisonline_sess[0]['count_sessions']  = $count_sess;
        $whoisonline_sess[0]['stat_created']    = time();
        asort($whoisonline_sess);
        return $whoisonline_sess;
    } else {
            $db->sql_freeresult($result);
            $whoisonline_sess[0]['count_hidden']    = 0;
            $whoisonline_sess[0]['count_reg_user']  = 0;
            $whoisonline_sess[0]['count_guests']    = 0;
            $whoisonline_sess[0]['stat_created']    = time();
            $whoisonline_sess[0]['count_sessions']  = 0;
            asort($whoisonline_sess);
            return $whoisonline_sess;
    }
}

function phpBB_showonline() {
    global $lang, $evoconfig, $db, $cache;
    $sessions_online = phpBB_whoisonline();
    if ( is_array($sessions_online) && ($sessions_online[0]['stat_created'] != FALSE) && ($sessions_online[0]['count_sessions'] > 0)) {
        $logged_hidden_online   = ($sessions_online[0]['count_hidden'] > 0) ? $sessions_online[0]['count_hidden'] : 0;
        $logged_visible_online  = ($sessions_online[0]['count_reg_user'] > 0) ? $sessions_online[0]['count_reg_user'] : 0;
        $guests_online          = ($sessions_online[0]['count_guests'] > 0) ? $sessions_online[0]['count_guests'] : 0;
        $total_online_users     = $logged_hidden_online + $logged_visible_online + $guests_online;
        $count_sess             = $sessions_online[0]['count_sessions'];
        $all_online_userlist        = '';
        $forum_online_userlist  = '';
        for ( $i = 1; $i < $count_sess; $i++) {
            if ( ($sessions_online[$i]['is_hidden'] == FALSE || is_mod_admin('super')) && $sessions_online[$i]['isactive'] ) {
                $sess_username  = $sessions_online[$i]['username'];
                $sess_usertyp   = $sessions_online[$i]['usertyp'];
                $sess_url       = str_replace("&", "&amp;", $sessions_online[$i]['url']);
                $sess_in_this   = (!empty($forum_id)) ? ( stristr($sess_url, 'f='.$forum_id) ? TRUE : FALSE ) : FALSE;
                $sess_module    = $sessions_online[$i]['module'];
                $sess_isactive  = $sessions_online[$i]['isactive'];
                $sess_guest     = $sessions_online[$i]['guest'];
                $username = (!empty($sessions_online[$i]['username_color'])) ? $sessions_online[$i]['username_color'] : $sessions_online[$i]['username'];
                $sess_where_active = (!empty($sess_module)) ? str_replace('_', ' ', $sess_module) : 'Forum ACP';
                if ( ($sess_guest == 0) || ($sess_guest == 2) ) {
                    $all_online_userlist .= ", " . "<a href='modules.php?name=Profile&amp;mode=viewprofile&amp;u=" . get_user_field('user_id', $sess_username, TRUE)."' class='gen'>$username</a>";
                    if ( $sess_in_this ) {
                        $forum_online_userlist .= ", " . "<a href='modules.php?name=Profile&amp;mode=viewprofile&amp;u=" . get_user_field('user_id', $sess_username, TRUE)."' class='gen'>$username</a>";
                    }
                }
            }
        }
        $online_users['all_online_userlist'] = $lang['Registered_users'] . substr($all_online_userlist, 1);
        if (!empty($forum_online_userlist)) {
            $online_users['forum_online_userlist'] = $lang['Browsing_forum'] . substr($forum_online_userlist, 1);
        }
        if ( $total_online_users > $evoconfig['record_online_users'])  {
            $evoconfig['record_online_users'] = $total_online_users;
            $evoconfig['record_online_date']  = time();

            $sql = "UPDATE " . CONFIG_TABLE . "
                    SET config_value = '$total_online_users'
                    WHERE config_name = 'record_online_users'";
            if ( !$db->sql_query($sql) )  {
                    message_die(GENERAL_ERROR, 'Could not update online user record (nr of users)', '', __LINE__, __FILE__, $sql);
            }

            $sql = "UPDATE " . CONFIG_TABLE . "
                    SET config_value = '" . $evoconfig['record_online_date'] . "'
                    WHERE config_name = 'record_online_date'";
            if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not update online user record (date)', '', __LINE__, __FILE__, $sql);
            }
            $cache->delete('board_config', 'config');
        }
    } else {
        $logged_hidden_online   = 0;
        $logged_visible_online  = 0;
        $guests_online          = 0;
        $total_online_users     = 0;
    }
    if ( $total_online_users == 0 )  {
            $l_t_user_s = $lang['Online_users_zero_total'];
    } else if ( $total_online_users == 1 )  {
            $l_t_user_s = $lang['Online_user_total'];
    } else {
            $l_t_user_s = $lang['Online_users_total'];
    }

    if ( $logged_visible_online == 0 ) {
            $l_r_user_s = $lang['Reg_users_zero_total'];
    } else if ( $logged_visible_online == 1 ) {
            $l_r_user_s = $lang['Reg_user_total'];
    } else {
            $l_r_user_s = $lang['Reg_users_total'];
    }

    if ( $logged_hidden_online == 0 ) {
            $l_h_user_s = $lang['Hidden_users_zero_total'];
    } else if ( $logged_hidden_online == 1 ) {
            $l_h_user_s = $lang['Hidden_user_total'];
    } else {
            $l_h_user_s = $lang['Hidden_users_total'];
    }

    if ( $guests_online == 0 ) {
            $l_g_user_s = $lang['Guest_users_zero_total'];
    } else if ( $guests_online == 1 ) {
            $l_g_user_s = $lang['Guest_user_total'];
    } else {
            $l_g_user_s = $lang['Guest_users_total'];
    }

    $l_online_users = sprintf($l_t_user_s, $total_online_users);
    $l_online_users .= sprintf($l_r_user_s, $logged_visible_online);
    $l_online_users .= sprintf($l_h_user_s, $logged_hidden_online);
    $l_online_users .= sprintf($l_g_user_s, $guests_online);
    $online_users['l_online_users'] = $l_online_users;
    
    return $online_users;
}
    
// 
// session_begin is only called from functions.php -> bblogin and sessions.php -> session_pagestart()
// Returns a session ID .
//
function session_begin($user_id, $user_ip, $thispage_id=0)
{
    global $db, $evoconfig, $_GETVAR, $SID, $userinfo, $add_count, $sessionmethod, $name;

    $session_old = 1000;
    $sessiondata = array();
    $test_SID    = @substr($SID, 4);
    $ip = identify::get_ip(); // We don't trust anyone .. 
    if ( ($user_ip != encode_ip($ip)) || ($user_id != $userinfo['user_id']) ) {
        message_die(CRITICAL_ERROR, 'Nice Try .....');
        exit;
    }        
    $evo_cookie_name     = $evoconfig['cookie_name'];
    $evo_cookie_path     = (isset($evoconfig['cookie_path'])) ? $evoconfig['cookie_path'] : '/';
    $evo_cookie_domain   = $evoconfig['cookie_domain'];
    if (empty($evo_cookie_domain) || $evo_cookie_domain == 'MySite.com') {
        $evo_cookie_domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : FALSE;  
    }
    $evo_cookie_secure   = (!empty($evoconfig['cookie_secure'])) ? $evoconfig['cookie_secure'] : FALSE;
    $evo_cookie_httponly = (version_compare(PHPVERS, '5.2.0', '>=')) ?  TRUE : FALSE;

    // We have to check if there is a cookie - cookies are set AFTER we have sent a page, 
    // therefore we have to ask for a cookie of a previous cookie-setting
    if ( empty($sessionmethod) ) {
        $sessioncookie = evo_getcookie('user');
        if ( isset($sessioncookie) && !empty($sessioncookie) ) { // there is allready a cookie from us so we can use cookies
            $sessionmethod  = SESSION_METHOD_COOKIE;
        } else { // we are not sure if we can set a cookie, so we have to add sid
            $sessionmethod  = SESSION_METHOD_GET;
        }           
    }
    if ( $sessionmethod == SESSION_METHOD_GET ) { // we know the method - sid is appended to the URL
        if ( ($_GETVAR->get('sid', '_GET') == $test_SID) && ($_GETVAR->get('sid', '_GET') != '') ) { // if yes, it's not a fake
            $sessiondata['session_ip'] = encode_ip($ip);
            $session_old = 100;
        } else { // we know the method, but either sid was not appended or someone wants to fake us
            $sessiondata['session_ip'] = encode_ip($ip);
            $session_old = 1001;
        }
    } else { // we know the method - sid is stored in the cookie
        $session_id        = evo_getcookie($evo_cookie_name . '_sid');
        $sessioncookiedata = evo_getcookie($evo_cookie_name . '_data');
        $session_old = 100;
        if ( empty($session_id) || empty($sessiondata) ) { // if one of those is empty, something went wrong
            $sessiondata['session_ip'] = encode_ip($ip);
            $session_old = 1002;
        } else { // we have informations from the cookie, so let's check if they are serious
            if ( $sessioncookiedata['session_ip'] != encode_ip($ip) ) { // different ip's - so stored session in cookie is either old or a fake
                $sessiondata['session_ip'] = encode_ip($ip);
                $session_old = 102;
            }
            if ( $session_id != $test_SID ) { // different sid's - so we take the cookies one
                $session_old = 103;
            } else {
                $session_old = 104;
            }
        }
    } 
    if ( $sessionmethod == SESSION_METHOD_GET ) {
        $sessiondata['session_id'] = $test_SID; // we take our internal one ... 
    } else {
        if ( $session_old < 1000 ) {
            $sessiondata['session_id'] = $session_id;  // everything seems to be fine .. so we take the cookie sid
        } else {
            $sessiondata['session_id'] = $test_SID; // there is no sid ... so we have to take those one from internal
        }
    }
        
        
    // Define variables we need
    $page_id        = $thispage_id;
    $login          = 0;
    $last_visit     = 0;
    $current_time   = time();
    $userdata       = array();
    $user_agent     = identify::identify_agent();

    // Because we are in Nuke-Evo, we use the informations allready got
    if ( is_user() ) {
        $userdata   =& $userinfo;
        $sessiondata['session_user_id']  = $userinfo['user_id'];
        $sessiondata['session_username'] = $userinfo['username'];
        $guest      = 0;
        $sessiondata['session_logged_in']= 1;
    } elseif ($user_agent['engine'] == 'bot') {
        $userdata   =& $userinfo;
        $sessiondata['session_user_id']  = $user_agent['bot'];
        $sessiondata['session_username'] = $ip;
        $guest      = 3;
        $sessiondata['session_logged_in']= 0;
    } else {
        $userdata   =& $userinfo;
        $sessiondata['session_user_id']  = ANONYMOUS;
        $sessiondata['session_username'] = $ip;
        $guest      = 1;
        $sessiondata['session_logged_in']= 0;
    }

    // One more check with session_id in the database. Even too, we check if session has ended
    $result = $db->sql_ufetchrow("SELECT `session_id`, `time` FROM `"._SESSION_TABLE."` WHERE `uname` = '".$sessiondata['session_username']."' ORDER BY `starttime` LIMIT 1");

    if ( ($result['session_id'] != $sessiondata['session_id']) && ($result['session_id'] != '') ) {
        if ( ($result['time'] + $evoconfig['session_length'] + 60) > $current_time ) {
            $sessiondata['session_id'] = $result['session_id']; // we take our value in the database as the correct one
            $session_old = $session_old + 1000;
        } else {
            $sessiondata['session_id'] = md5(dss_rand()); // We have to create a new session id
        }
    } elseif  ( (empty($result['session_id'])) && ($session_old < 1000) ) {
        $session_old = $session_old + 1; // eveything seems fine ... only database sid isn't set, so we can go on
    } else {
        $session_old = $session_old + 1000;
        $sessiondata['session_id'] = md5(dss_rand()); // We have to create a new session id
    }

      
    // Normally we have to include here queries against Nuke-Sentinel. But if we are here, the Ban from Nuke-Sentinel 
    // allready has worked (or not)
    //
    if (EvoKernel_UserBanned($sessiondata, 'all')) {
        DisplayError('You_been_banned', 2);
        exit;
    }
    //
    //
    // We only use the nuke session table
    // code from header.php
    // we only have to do it once (if header.php isn't loaded)
    if (!defined('EVO_KERNEL_ONLINE')) {
        $url            = Fix_Quotes($_SERVER['REQUEST_URI']);
        $url            = str_replace('&amp;', '&', $url);
        $custom_title   = ( $thispage_id ) ? (@constant('_MODULE_'.$thispage_id) ? @constant('_MODULE_'.$thispage_id) : $thispage_id) : $name;
        $past           = $current_time - ($evoconfig['session_length'] - 60);
        $db->sql_uquery('DELETE FROM '._SESSION_TABLE.' WHERE time < "'.$past.'"');
        list($count) = $db->sql_ufetchrow("SELECT COUNT(uname) FROM "._SESSION_TABLE." WHERE uname='".$sessiondata['session_username']."'");
        if ($count >= 1) {
           $result = $db->sql_uquery('UPDATE '._SESSION_TABLE.' SET time="'.$current_time.'", module="'.$custom_title.'", url="'.$url.'", session_id="'.$sessiondata['session_id'].'" WHERE uname="'.$sessiondata['session_username'].'"');
        } else {
           $db->sql_uquery('INSERT INTO '._SESSION_TABLE.' (uname, time, starttime, host_addr, guest, module, url, session_id) VALUES ("'.$sessiondata['session_username'].'", "'.$current_time.'", "'.$current_time.'", "'.$ip.'", "'.$guest.'","'.$custom_title.'", "'.$url.'", "'.$sessiondata['session_id'].'")');
           $add_count['count'] = 1;
           $add_count['who'] = $guest;
        }
    }

    $sessiondata['session_page']    = $page_id;
    $sessiondata['session_start']   = $current_time;
    $sessiondata['session_time']    = $current_time;
    $userdata['session_old']        = $session_old;
    $userdata['session_id']         = $sessiondata['session_id'];
    $userdata['session_ip']         = $ip;
    $userdata['session_user_id']    = $sessiondata['session_user_id'];
    $userdata['session_logged_in']  = $sessiondata['session_logged_in'];
    $userdata['session_page']       = $sessiondata['session_page'];
    $userdata['session_start']      = $current_time;
    $userdata['session_time']       = $current_time;
    $serialize_data                 = serialize($sessiondata);
    $cookie_time                    = 31536000;
    evo_setcookie($evo_cookie_name . '_data', $serialize_data, $cookie_time, $evo_cookie_secure, $evo_cookie_httponly);
    evo_setcookie($evo_cookie_name . '_sid', $sessiondata['session_id'], $cookie_time, $evo_cookie_secure, $evo_cookie_httponly);
        $SID = 'sid=' . $sessiondata['session_id']; // We have to append SID to the URL
    return $userdata;
}

//
// Checks for a given user session, tidies session table and updates user
// sessions at each page refresh
//
// modded by Quake for NOT using $nukeuser
function session_pagestart($user_ip, $thispage_id, $trash=0)
{
    @ini_set('arg_separator.output', '&amp;');
    global $userinfo;
    $ip = identify::get_ip(); // We don't trust anyone .. 
    if ( $user_ip != encode_ip($ip) ) {
        message_die(CRITICAL_ERROR, 'Nice Try .....');
        exit;
    }        
    $userdata = session_begin($userinfo['user_id'], $user_ip, $thispage_id);
    $userdata['bm_page'] = $thispage_id;
    return $userdata;
}

/**
* Terminates the specified session
* It will delete the entry in the sessions table for this session,
* remove the corresponding auto-login key and reset the cookies
*/
function session_end($session_id, $username)
{
    global $db, $evoconfig, $userinfo;

    $cookiename = $evoconfig['cookie_name'];
    //
    // Delete existing session
    //
    $sql = 'DELETE FROM ' . _SESSION_TABLE . "
            WHERE session_id = '$session_id'
            AND uname = $username";
    if ( !$db->sql_query($sql) ) {
        message_die(CRITICAL_ERROR, 'Error removing user session', '', __LINE__, __FILE__, $sql);
    }

    if (!is_admin() && ($username == $userinfo['username'])) {
        evo_setcookie($cookiename . '_data', 'delete', -1);
        evo_setcookie($cookiename . '_sid', 'delete', -1);
    }
    return TRUE;
}

/**
* Removes expired sessions and auto-login keys from the database
*/
function session_clean($session_id)
{
    global $evoconfig, $db;

    //
    // Delete expired sessions
    //
    $db->sql_uquery('DELETE FROM ' . _SESSION_TABLE . '
            WHERE time < ' . (time() - (int) $evoconfig['session_length']) . '
            AND session_id <> "'.$session_id.'"');

    return true;
}

/**
* Reset all login keys for the specified user
* Called on password changes
*/
function session_reset_keys($user_id, $user_ip) {
    global $db, $userdata, $sessiondata;

    if ( $user_id != $userdata['user_id'] ) {
        message_die(CRITICAL_ERROR, 'Nice Try .....');
        exit;
    }        

    $db->sql_uquery('DELETE FROM ' . _SESSION_TABLE . '
            WHERE uname = "' . $userdata['username'].'"');
    unset($sessiondata);
}

//
// Append $SID to a url. Borrowed from phplib and modified. This is an
// extra routine utilised by the session code above and acts as a wrapper
// around every single URL and form action. If you replace the session
// code you must include this routine, even if it's empty.
//
function append_sid($url, $non_html_amp = false)
{
    global $SID, $admin, $userdata;
    if (preg_match('/^admin=1/', $url) || preg_match('/^admin_/', $url) || preg_match('/^pane=/', $url)){
    //  The format is fine, don't change a thing.
    } else if (preg_match('/^Your_Account/', $url)){
            $url = str_replace('.php', '', $url);               //  Strip the .php from all the files,
            $url = str_replace('modules', 'modules.php', $url); //  and put it back for the modules.php
    }
    else if (preg_match('/^redirect/', $url))
    {
            $url = str_replace('login.php', 'modules.php?name=Your_Account', $url);                                                 //  Strip the .php from all the files,
            $url = str_replace('.php', '', $url);                                                                                   //  Strip the .php from all the files,
            $url = ($non_html_amp) ? str_replace('?redirect', '&redirect', $url) : str_replace('?redirect', '&amp;redirect', $url); //  Strip the .php from all the files,
            $url = str_replace('modules', 'modules.php', $url);                                                                     //  and put it back for the modules.php
    }
    else if (preg_match('/^menu=1/', $url))
    {
            $url = ($non_html_amp) ? str_replace('?', '&', $url) : str_replace('?', '&amp;', $url);                                                   //  As we are already in nuke, change the ? to &
            $url = str_replace('.php', '', $url);                                                                                                     //  Strip the .php from all the files,
            if($url != 'index') {
                    $url = NUKE_HREF_BASE_DIR . 'modules.php?name=Forums&amp;file='.$url; //  Change to Nuke format
            } else {
                    $url = NUKE_HREF_BASE_DIR . 'modules.php?name=Forums';
            }
    }
    else if ((preg_match('/^privmsg/', $url)) && (!preg_match('/^highlight=privmsg/', $url))) {
            $url = ($non_html_amp) ? str_replace('?', '&', $url) : str_replace('?', '&amp;', $url); //  As we are already in nuke, change the ? to &
            $url = str_replace('privmsg.php', 'modules.php?name=Private_Messages', $url);           //  and put it back for the modules.php
    }
    else if ((preg_match('/^groupcp/', $url)) && (!preg_match('/^highlight=groupc/', $url))) {
            $url = ($non_html_amp) ? str_replace('?', '&', $url) : str_replace('?', '&amp;', $url); //  As we are already in nuke, change the ? to &
            $url = str_replace('groupcp.php', 'modules.php?name=Groups', $url);                     //  and put it back for the modules.php
    }
    else if ((preg_match('/^profile/', $url)) && (!preg_match('/^highlight=profile/', $url))) {
            $url = ($non_html_amp) ? str_replace('?', '&', $url) : str_replace('?', '&amp;', $url); //  As we are already in nuke, change the ? to &
            $url = str_replace('profile.php', 'modules.php?name=Profile', $url);                    //  and put it back for the modules.php
            $dummy = 1;
    }
    else if ((preg_match('/^memberlist/', $url)) && (!preg_match('/^highlight=memberlist/', $url))) {
            $url = ($non_html_amp) ? str_replace('?', '&', $url) : str_replace('?', '&amp;', $url); //  As we are already in nuke, change the ? to &
            $url = str_replace('memberlist.php', 'modules.php?name=Members_List', $url);            //  and put it back for the modules.php
    } else {
            $url = ($non_html_amp) ? str_replace('?', '&', $url) : str_replace('?', '&amp;', $url); //  As we are already in nuke, change the ? to &
            $url = str_replace('.php', '', $url);
            if($url != 'index') {
                    $url = 'modules.php?name=Forums&amp;file='.$url; //  Change to Nuke format
            } else {
                    $url = 'modules.php?name=Forums';
            }
    }
    global $agent;
    if ($agent['engine'] == 'bot') return $url;
    return($url);
}

function admin_sid($url, $non_html_amp = false) {
    global $SID;
    if($url != 'index.php') {
        $url = str_replace('?', '&amp;', $url);
        $url = str_replace('.php', '', $url);                                                     //  Strip the .php from all the files,
        $url = NUKE_HREF_BASE_DIR . 'admin.php?op=forums&amp;pane=main&amp;file='.$url;                     //  Change to Nuke format
    } else {
        $url = NUKE_HREF_BASE_DIR . 'modules.php?name=Forums';
    }
    if ( !empty($SID) && !preg_match('/^sid=/', $url) ) {
        $url .= ( ( strpos($url, '?') != false ) ?  ( ( $non_html_amp ) ? '&' : '&amp;' ) : '?' ) . $SID;
    }
    return $url;
}

?>