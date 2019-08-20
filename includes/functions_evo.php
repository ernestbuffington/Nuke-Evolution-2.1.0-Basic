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

define('HEX_CACHED', 'bec5e1918eb2cc75d5d3bbdeb475e0c6bed5b481a294818be7b1e5d486929fbdd4d7bba0ab7fa39471d3dbc2e29fadde9fbdd4d7bba0b5c2e6d6bad3e08daec56bcdebb4d8a172cdedc3e29e7a94f0c6e992b0dbe87cd9c9bdd2dabda0c7bad2a06fe6c5bdccdec3af8baad3dec699a290dbe875e0c6bed5b493d7dab0d1e8bfdfc9b9d99fbdd4d7bba0cdb4d3d18794da8dae93bed9ebbee0cb8965794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65794f72644b65');
define('HEX_PREG', '#Evo-CMS.*?www.evo-german.com.*#mi');

//define('SENDMAIL', 'true');
define('COOKIEDB', TRUE);

/**
 * Loads the entire evo config
 * original written by JeFFb68CAM
 * recoded and enhanced by ReOrGaNiSaTiOn
 */
function load_evoconfig() {
    global $db, $cache, $debugger;

    if ((($evoconfig = $cache->load('evoconfig', 'config')) === false) || empty($evoconfig)) {
        $evoconfig = array();
        $result = $db->sql_query('SELECT `evo_field`, `evo_value` FROM '._EVOCONFIG_TABLE.' WHERE `evo_field` != "cache_data"');
        while(list($evo_field, $evo_value) = $db->sql_fetchrow($result)) {
            if($evo_field != 'cache_data') {
                $evoconfig[$evo_field] = $evo_value;
            }
        }
        $db->sql_freeresult($result);
        $result = $db->sql_query('SELECT `evo_field`, `evo_value` FROM '._EVO_CONFIG_TABLE);
        while(list($evo_field, $evo_value) = $db->sql_fetchrow($result)) {
            $evoconfig[$evo_field] = $evo_value;
        }
        $db->sql_freeresult($result);
        $result = $db->sql_query("SELECT `config_name`, `config_value` FROM " . CONFIG_TABLE);
        while(list($evo_field, $evo_value) = $db->sql_fetchrow($result) ) {
            $evoconfig[$evo_field] = $evo_value;
        }
        $db->sql_freeresult($result);
        $result = $db->sql_query("SELECT `config_name`, `config_value` FROM " . _CNBYA_CONFIG_TABLE);
        while(list($evo_field, $evo_value) = $db->sql_fetchrow($result)) {
            $evoconfig[$evo_field] = $evo_value;
        }
        $db->sql_freeresult($result);
        $wordrow = array();
        $sql = 'SELECT `word`, `replacement` FROM `'.WORDS_TABLE.'`';
        if( !($resultwords = $db->sql_query($sql))) {
            $debugger->handle_error("Could not query bad words information", 'Error');
        }
        while(list($word, $replacement) = $db->sql_fetchrow($resultwords)) {
            $wordrow[$word] = $replacement;
        }
        $evoconfig['censor_words'] = $wordrow;
        //OK as next, we need all modules
        $sql = "SELECT `active`, `blocks`, `cat_id`, `groups`, `inmenu`, `view`, `pos`, `mid`, `title`, `custom_title`  FROM " . _MODULES_TABLE." ORDER BY `mid` ASC";
        if( !($resultmodule = $db->sql_query($sql))) {
            $debugger->handle_error("Could not query module config information", 'Error');
        } else {
            while($row = $db->sql_fetchrow($resultmodule)) {
                $title = $row['title'];
                $evoconfig['modules'][$title] = array();
                $evoconfig['modules'][$title]['title']  = $row['title'];
                $evoconfig['modules'][$title]['mid']    = $row['mid'];
                $evoconfig['modules'][$title]['active'] = $row['active'];
                $evoconfig['modules'][$title]['blocks'] = $row['blocks'];
                $evoconfig['modules'][$title]['cat_id'] = $row['cat_id'];
                $evoconfig['modules'][$title]['view']   = $row['view'];
                $evoconfig['modules'][$title]['custom_title'] = $row['custom_title'];
                $evoconfig['modules'][$title]['inmenu'] = $row['inmenu'];
                $evoconfig['modules'][$title]['pos']    = $row['pos'];
                $evoconfig['modules'][$title]['groups'] = $row['groups'];
            }
        }
        $db->sql_freeresult($resultmodule);
        //... and the Modulecategories
        $sql = "SELECT `cid`, `name`, `pos`, `image`, `collapse` FROM " . _MODULES_CATEGORIES_TABLE." ORDER BY `pos` ASC";
        if( !($resultmodulecat = $db->sql_query($sql))) {
            $debugger->handle_error("Could not query module category config information", 'Error');
        } else {
            while($row = $db->sql_fetchrow($resultmodulecat)) {
                $cid = $row['cid'];
                $evoconfig['modulcat'][$cid] = array();
                $evoconfig['modulcat'][$cid]['name'] = $row['name'];
                $evoconfig['modulcat'][$cid]['pos']  = $row['pos'];
                $evoconfig['modulcat'][$cid]['image']  = $row['image'];
                $evoconfig['modulcat'][$cid]['collapse']  = $row['collapse'];
            }
        }
        $db->sql_freeresult($resultmodulecat);

        // for the future we add here our nuke_config parameters
        $nuke_fieldnames = array('CensorMode', 'CensorReplace', 'Version_Num', 'admin_log_lines', 'admin_pos', 'admingraphic', 'adminmail',
                                            'anonpost', 'anonymous', 'articlecomm', 'backend_language', 'backend_title', 'banners', 'broadcast_msg', 'commentlimit',
                                            'copyright', 'default_Theme', 'error_log_lines', 'foot1', 'foot2', 'foot3', 'httpref', 'httprefmax', 'language',
                                            'locale', 'minpass', 'moderate', 'multilingual', 'my_headlines', 'notify', 'notify_email', 'notify_from',
                                            'notify_message', 'notify_subject', 'nukeurl', 'oldnum', 'pollcomm', 'site_logo', 'sitename', 'slogan', 'startdate',
                                            'storyhome', 'top', 'ultramode', 'useflags', 'user_news');
        $newconfig = $db->sql_ufetchrow('SELECT CensorMode, CensorReplace, Version_Num, admin_log_lines, admin_pos, admingraphic, adminmail,
                                            anonpost, anonymous, articlecomm, backend_language, backend_title, banners, broadcast_msg, commentlimit,
                                            copyright, default_Theme, error_log_lines, foot1, foot2, foot3, httpref, httprefmax, language,
                                            locale, minpass, moderate, multilingual, my_headlines, notify, notify_email, notify_from,
                                            notify_message, notify_subject, nukeurl, oldnum, pollcomm, site_logo, sitename, slogan, startdate,
                                            storyhome, top, ultramode, useflags, user_news FROM '._NUKE_CONFIG_TABLE, SQL_ASSOC);
        if (!$newconfig) {
            die('No Configuration available');
        }
        foreach ($nuke_fieldnames as $field) {
            $evoconfig[$field] = str_replace('\\"', '"', $newconfig[$field]);
        }
        $evoconfig['startdate_timestamp'] = $evoconfig['startdate'];
        $cache->delete('evoconfig', 'config');
        $cache->save('evoconfig', 'config', $evoconfig);
    }
    if(is_array($evoconfig)) {
        return $evoconfig;
    } else {
        $cache->delete('evoconfig', 'config');
        $debugger->handle_error('There is an error in your evoconfig data', 'Error');
        return array();
    }
}

// main_module function by Quake
function main_module() {
  global $db, $cache;
  static $main_module;
  if (isset($main_module)) { return $main_module; }
    if((($main_module = $cache->load('main_module', 'config')) === false) || empty($main_module)) {
        list($main_module) = $db->sql_ufetchrow('SELECT main_module FROM '._MAIN_TABLE, SQL_NUM);
      $cache->save('main_module', 'config', $main_module);
  }
  return $main_module;
}

// update_modules function by JeFFb68CAM
function update_modules() {
    // New function to add new modules and delete old ones
    global $db, $cache;

    //Here we will pull all currently installed modules from the database
    $result = $db->sql_query("SELECT title FROM "._MODULES_TABLE, true);
    while(list($mtitle) = $db->sql_fetchrow($result, SQL_NUM)) {
        if(substr($mtitle,0,3) != '~l~') {
            $modules[] = $mtitle;
        }
    }
    $db->sql_freeresult($result);
    sort($modules);

    //Here we will get all current modules uploaded
    $handle=@opendir(NUKE_MODULES_DIR);
    $modlist = array();
    while (false !== ($file = @readdir($handle))) {
        if ( @is_dir(NUKE_MODULES_DIR . $file) && ($file != '.') && ($file != '..') ) {
            $modlist[] = $file;
        }
    }
    @closedir($handle);
    sort($modlist);
    $updated = FALSE;
    //Now we will run a check to make sure that all uploaded modules are installed
    for($i=0, $maxi=count($modlist);$i<$maxi;$i++) {
        $module = $modlist[$i];
        if (!in_array($module, $modules)) {
            $db->sql_uquery("INSERT INTO `"._MODULES_TABLE."` (`mid`, `title`, `custom_title`, `active`, `view`, `inmenu`, `pos`, `cat_id`, `blocks`, `admins`, `groups`) VALUES (NULL, '$module', '".str_replace("_", " ", $module)."', 0, 0, 1, 0, 7, 1, '', '')");
            $updated = TRUE;
        }
    }

    //Now we will run a check to make sure all installed modules still exist
    for($i=0, $maxi=count($modules);$i<$maxi;$i++){
        $module = $modules[$i];
        if (!in_array($module, $modlist)) {
            $db->sql_uquery("DELETE FROM `"._MODULES_TABLE."` WHERE `title`= '$module'");
            $result = $db->sql_uquery("OPTIMIZE TABLE `"._MODULES_TABLE."`");
            $updated = TRUE;
        }
    }
    if ($updated) {
        $cache->delete('active_modules');
        $cache->delete('evoconfig');
        $cache->delete('blocks');
    }
    return $updated = true;
}

// evo_setcookie function by ReOrGaNiSatiOn
// Centralized Funktion to set cookie all times in the same way
// 0 = name of the cookie -> allowed = user + admin
// 1 = value of the cookie -> shouldn't be base64 encoded because we do it here
// 2 = maximal age of the cookie -> in seconds - a value below 0 means, the cookie should be deleted
// 3 = secured cookie ? True or False -> send the cookie only if https connection is established
// 4 = httponly ? True or False -> only valid php > 5.2 .. if True, cookie is not available for other scripting languages than php
function evo_setcookie($evocookie0='default', $evocookie1, $evocookie2=0, $evocookie3 = false, $evocookie4 = false) {
    global $evoconfig, $userinfo, $db, $aid;

    $actualtime = time();
    if (!isset($userinfo['user_id'])) {
        $userinfo['user_id'] = ANONYMOUS;
    }
    $evo_cookie_path     = (!empty($evoconfig['cookie_path'])) ? $evoconfig['cookie_path'] : '/';
    $evo_cookie_domain   = $evoconfig['cookie_domain'];
    if (empty($evo_cookie_domain) || stristr($evo_cookie_domain, '.domain')) {
        $evo_cookie_domain = (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '';
    }
    if ( stristr($evo_cookie_domain, 'localhost') || stristr($evo_cookie_domain, '.0.') ) {
        $evo_cookie_domain = '';
    }
    $evo_cookie_secure   = $evocookie3;
    $evo_cookie_httponly = (version_compare(PHPVERS, '5.2.0', '>=')) ?  ( ($evocookie4 == TRUE) ? $evocookie4 : FALSE) : FALSE;
    if ( empty($evocookie1) ) {
        return FALSE;
    } else {
        $evo_cookie_value = $evocookie1;
    }
    if ( ($evocookie0 != 'default') && (!empty($evocookie0)) ) {
        $evo_cookie_name = $evocookie0;
    } else {
        $evo_cookie_name = $evoconfig['cookie_name'];
    }
    if ( $evocookie2 < 0 ) {
        $evo_cookie_value  = '';
        $evo_cookie_maxage = $actualtime - 86400;
        // Cookie must be deleted, so we must delete it from the environment variable too
        unset($_COOKIE[$evo_cookie_name]);
    } elseif ($evocookie2 == 0) {
        $evo_cookie_maxage = $actualtime + $evoconfig['session_length'];
    } else {
        $evo_cookie_maxage = $actualtime + $evocookie2;
    }
    if (defined('COOKIEDB') && ($evo_cookie_name != 'admin' && $evo_cookie_name != 'user' && $evo_cookie_name != 'CNB_test1') && $userinfo['user_id'] != ANONYMOUS) {
        $usercookie    = array();
        if ( is_admin() && !is_user() ) {
            $result = $db->sql_ufetchrow('SELECT `cookie` FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$aid.'"');
            $storetable = 'admin';
        } else {
            $result = $db->sql_ufetchrow('SELECT `cookie` FROM `'._USERS_TABLE.'` WHERE `user_id` = "'.$userinfo['user_id'].'"');
            $storetable = 'user';
        }
        if (isset($result['cookie']) && !empty($result['cookie'])) {
            $usercookie = unserialize(base64_decode($result['cookie']));
        } else {
            $usercookie = array();
        }
        foreach ($usercookie as $fieldname => $field) {
            if ($usercookie[$fieldname]['cookie_maxage'] > $actualtime) {
                $usercookie[$fieldname]['cookie_value']  = $field['cookie_value'];
                $usercookie[$fieldname]['cookie_maxage'] = $field['cookie_maxage'];
            }
        }
        if ( $evo_cookie_maxage > $actualtime ) {
            $usercookie[$evo_cookie_name]['cookie_value']  = $evo_cookie_value;
            $usercookie[$evo_cookie_name]['cookie_maxage'] = $evo_cookie_maxage;
        } else {
            if ( isset($usercookie[$evo_cookie_name]) ) {
                unset($usercookie[$evo_cookie_name]);
            }
        }
        if ( $storetable == 'admin' ) {
            $db->sql_uquery('UPDATE `'._AUTHOR_TABLE.'` set `cookie` = "'.base64_encode(serialize($usercookie)).'" WHERE `aid`="'.$aid.'"');
        } else {
            $db->sql_uquery('UPDATE `'._USERS_TABLE.'` set `cookie` = "'.base64_encode(serialize($usercookie)).'" WHERE `user_id`="'.$userinfo['user_id'].'"');
        }
    } else {
        if ( version_compare(PHPVERS, '5.2.0', '>=' ) ) {
            @setcookie($evo_cookie_name, base64_encode($evo_cookie_value), $evo_cookie_maxage, $evo_cookie_path, $evo_cookie_domain, $evo_cookie_secure, $evo_cookie_httponly);
        } else {
            @setcookie($evo_cookie_name, base64_encode($evo_cookie_value), $evo_cookie_maxage, $evo_cookie_path, $evo_cookie_domain, $evo_cookie_secure);
        }
        // We too set $_COOKIE, so there is no need to refresh side after cookiesetting
        if ($evo_cookie_maxage >= $actualtime && ($evo_cookie_name != 'CNB_test1') ) {
            $_COOKIE[$evo_cookie_name] = base64_encode($evo_cookie_value);
        }
    }
    return TRUE; // It isn't really true that the cookie is set, but we have passed all parameters - that's true
}

// evo_getcookie function by ReOrGaNiSatiOn
// Centralized Funktion to get cookie all times in the same way
// 0 = name of the cookie
function evo_getcookie($evocookie0='default') {
    global $_GETVAR, $db, $userinfo, $aid;

    $actualtime = time();
    if (!isset($userinfo['user_id'])) {
        $userinfo['user_id'] = ANONYMOUS;
    }
    if (defined('COOKIEDB') && ($evocookie0 != 'admin' && $evocookie0 != 'user' && $evocookie0 != 'CNB_test1') && $userinfo['user_id'] != ANONYMOUS) {
        if ( defined('SETADMINCOOKIE') && !defined('SETUSERCOOKIE') ) {
            $result = $db->sql_ufetchrow('SELECT `cookie` FROM `'._AUTHOR_TABLE.'` WHERE `aid` = "'.$aid.'"');
            $storetable = 'admin';
        } else {
            $result = $db->sql_ufetchrow('SELECT `cookie` FROM `'._USERS_TABLE.'` WHERE `user_id` = "'.$userinfo['user_id'].'"');
            $storetable = 'user';
        }
        if (isset($result['cookie']) && !empty($result['cookie'])) {
            $usercookie = unserialize(base64_decode($result['cookie']));
        } else {
            $usercookie = array();
        }
        foreach ($usercookie as $fieldname => $field) {
            $usercookie[$fieldname]['cookie_value']  = $field['cookie_value'];
            $usercookie[$fieldname]['cookie_maxage'] = $field['cookie_maxage'];
            if ($usercookie[$fieldname]['cookie_maxage'] < $actualtime) {
                unset($usercookie[$fieldname]);
            }
        }
        if ( $storetable == 'admin' ) {
            $db->sql_uquery('UPDATE `'._AUTHOR_TABLE.'` set `cookie` = "'.base64_encode(serialize($usercookie)).'" WHERE `aid`="'.$aid.'"');
        } else {
            $db->sql_uquery('UPDATE `'._USERS_TABLE.'` set `cookie` = "'.base64_encode(serialize($usercookie)).'" WHERE `user_id`="'.$userinfo['user_id'].'"');
        }
        if ($evocookie0 == '*') {
            foreach($_COOKIE as $key => $content) {
                $mycookie = $_GETVAR->get($key, '_COOKIE', 'string');
                $usercookie[$key]['cookie_value'] = $mycookie;
            }
            return $usercookie;
        } else {
            if (isset($usercookie[$evocookie0])) {
                return $usercookie[$evocookie0]['cookie_value'];
            } else {
                return FALSE;
            }
        }
    } else{
        if ($evocookie0 == '*') {
            foreach($_COOKIE as $key => $content) {
                $mycookie = $_GETVAR->get($key, '_COOKIE', 'string');
                $usercookie[$key]['cookie_value'] = $mycookie;
            }
            return $usercookie;
        } else {
            if ($_GETVAR->get($evocookie0, '_COOKIE', 'string')) {
                return base64_decode($_GETVAR->get($evocookie0, '_COOKIE', 'string'));
            } else {
                return FALSE;
            }
        }
    }
}

// evo_setusercookie function by ReOrGaNiSatiOn
// Centralized Funktion to set usercookies all times in the same way
// $guestid = Ip-Adress or User-ID for the user where a cookie has to be set
// $type    = 'userid' or 'ip'; identifies the content of $guestid
// Note: We only set an usercookie for an user - not for guests
function evo_setusercookie($guestid=0, $type='userid') {
    global $evoconfig, $db, $userinfo, $cache;

    // We only allow type 'ip' or 'userid'
    if ( ($type != 'ip') && ($type != 'userid') ) {
        return FALSE;
    }
    // At the moment we don't support ip as type - will come in a later version
    if ($type == 'ip') {
        return FALSE;
    }
    // if cookietimelife in cnbya_config is set to 0, no registration or login is allowed
    if ($evoconfig['cookietimelife'] == 0) {
        return FALSE;
    }
    // Do some checks against guestid and userinfo if type = userid
    // We do not allow ANONYMOUS (guests) to set a cookie - nor do we allow to set a cookie for another user
    if ($type == 'userid') {
        if ( $guestid == ANONYMOUS || ($guestid <= 0) ) {
            return FALSE;
        }
        // Check if we allready have informations for this user and if there is a try to set a cookie for a different userid
        if ( (isset($userinfo['user_id']) && ($userinfo['user_id'] != ANONYMOUS)) && $userinfo['user_id'] != $guestid ) {
            return FALSE;
        }
    }
    // We did all checks, now we need informations from the database
    $row = $db->sql_ufetchrow("SELECT user_id, username, user_password, storynum, umode, uorder, thold, noscore, ublockon, theme, commentmax FROM "._USERS_TABLE." WHERE user_id = '".$guestid."'");
    $info = $row['user_id'].":".$row['username'].":".$row['user_password'].":".$row['storynum'].":".$row['umode'].":".$row['uorder'].":".$row['thold'].":".$row['noscore'].":".$row['ublockon'].":".$row['theme'].":".$row['commentmax'];
    // cookietimelife:
    // '-' means only for session
    // 0   means blocking all registrations and logins, but we have checked this earlier
    if ($evoconfig['cookietimelife'] != '-') {
        // set cookie with a lifetime
        evo_setcookie('user', $info, $evoconfig['cookietimelife']);
    } else {
        // set session cookie
        evo_setcookie('user', $info, 0);
    }
    // We too set $_COOKIE, so there is no need to refresh site
    $_COOKIE['user'] = $info;
    // maybe this could be an user within registration, therefore we delete numwaituser from cache
    $cache->delete('numwaituser', 'submissions');
    // ok, cookie is set, now we have to refresh session informations
    // if this action is a login or registration - user was as guest before and we have to update this session
    $ctime  = time();
    if ($userinfo['user_id'] == $guestid) {
        // This is only a refresh of a cookie so a sessionuser must exist and we only update sessiontime
        $db->sql_uquery("UPDATE "._SESSION_TABLE." set time='".$ctime."' WHERE guest='0' AND uname='".$row['username']."'");
    } else {
        // User must be guest before, so delete or update session informations based on the ip-adress of the user
        $userip = identify::get_ip();
        $result = $db->sql_unumrows("SELECT starttime FROM "._SESSION_TABLE." WHERE guest='1' AND uname='".$userip."'");
        if ($result > 0) {
            // We delete the sessions begun from this ip-adress
            $db->sql_uquery("DELETE FROM "._SESSION_TABLE." WHERE guest='1' AND uname='".$userip."' OR uname='".$row['username']."'");
        }
        // ok .. let's check if user has another session started if yes, only update sessiontime
        $db->sql_uquery("REPLACE INTO "._SESSION_TABLE." (uname, time, host_addr, guest, starttime) VALUES ('".$row['username']."', '".$ctime."', '".$userip."', '0', '".$ctime."')");
    }
}

function cookiedecode($trash=0) {
    $rcookie = explode(':', evo_getcookie('user'));
    if (isset($rcookie[1]) && !empty($rcookie[1])) {
        $pass    = get_user_field('user_password', $rcookie[1], true);
        $user    = get_user_field('username', $rcookie[1], true);
        if ( isset($rcookie[2]) && ($pass == $rcookie[2]) && ($user == $rcookie[1]) && !empty($pass) && !empty($user) ) {
            return $rcookie[1];
        }
    }
    return false;
}

function encode_mail($email) {
    $finished = '';
    for($i=0, $j = strlen($email); $i<$j; ++$i) {
        $n = mt_rand(0, 1);
        $finished .= ($n) ? '&#x'.sprintf('%X',ord($email{$i})).';' : '&#'.ord($email{$i}).';';
    }
    return $finished;
}

// EvoCrypt function by JeFFb68CAM
function EvoCrypt($pass) {
    return md5($pass);
}

// EvoCrypt function by JeFFb68CAM
function EvoCrypt1($pass) {
    return md5(md5(md5(md5(md5($pass)))));
}

// http://www.php.net/array_combine
if (!function_exists('array_combine')) {
    function array_combine($keys, $values) {
        $result = array();
        if (is_array($keys) && is_array($values)) {
            while (list(, $key) = each($keys)) {
                if (list(, $value) = each($values)) {
                    $result[$key] = $value;
                } else {
                    break 1;
                }
            }
        }
        return $result;
    }
}

// http://www.php.net/file_get_contents
if(!function_exists('file_get_contents')) {
    function file_get_contents($filename, $use_include_path = 0) {
        $file = @fopen($filename, 'rb', $use_include_path);
        $data = '';
        if ($file) {
            while (!feof($file)) $data .= fread($file, 1024);
            @fclose($file);
        }
        return $data;
    }
}

// http://www.php.net/html_entity_decode
if(!function_exists('html_entity_decode')) {
    function html_entity_decode($given_html, $quote_style = ENT_QUOTES, $charset = 'UTF-8') {
        $trans_table = array_flip(get_html_translation_table(HTML_ENTITIES, $quote_style));
        $trans_table['&#39;'] = "'";
        return (strtr($given_html, $trans_table));
    }
}

// EvoDate function by JeFFb68CAM (based off phpBB mod)
// Changed for international users by ReOrGaNiSaTiOn
function EvoDate($format, $gmepoch, $tz)
{
    global $evoconfig, $currentlang, $pc_dateTime, $userinfo;
    static $EvoDate_loaded;
    static $translate;

    if ( $EvoDate_loaded != $currentlang ) {
        $lang_path = NUKE_LANGUAGE_DIR . 'evo/';
        if (@file_exists($lang_path . 'time_'.$currentlang.'.php'))
        {
            include_once($lang_path . 'time_'.$currentlang.'.php');
            $EvoDate_loaded = $currentlang;
        }
        elseif (@file_exists($lang_path . 'time_' . $evoconfig['default_lang'] . '.php'))
        {
            include_once($lang_path . 'time_' . $evoconfig['default_lang'] . '.php');
            $EvoDate_loaded = $evoconfig['default_lang'];
        }
        else
        {
            DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $module_name);
        }
        @reset($langtime['datetime']);
        while ( list($match, $replace) = @each($langtime['datetime']) )
        {
            $translate[$match] = $replace;
        }
    }


  if ( is_user() )
  {
    switch ( $userinfo['user_time_mode'] )
    {
      case MANUAL_DST:
        $dst_sec = $userinfo['user_dst_time_lag'] * 60;
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
        break;
      case SERVER_SWITCH:
        $dst_sec = date('I', $gmepoch) * $userinfo['user_dst_time_lag'] * 60;
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
        break;
      case FULL_SERVER:
        return ( !empty($translate) ) ? strtr(@date($format, $gmepoch), $translate) : @date($format, $gmepoch);
        break;
      case SERVER_PC:
        if ( isset($pc_dateTime['pc_timezoneOffset']) )
        {
          $tzo_sec = $pc_dateTime['pc_timezoneOffset'];
        } else
        {
          $user_pc_timeOffsets = explode("/", $userinfo['user_pc_timeOffsets']);
          $tzo_sec = $user_pc_timeOffsets[0];
        }
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
        break;
      case FULL_PC:
        if ( isset($pc_dateTime['pc_timeOffset']) )
        {
          $tzo_sec = $pc_dateTime['pc_timeOffset'];
        } else
        {
          $user_pc_timeOffsets = explode("/", $userinfo['user_pc_timeOffsets']);
          if (isset($user_pc_timeOffsets[1])) {
             $tzo_sec = $user_pc_timeOffsets[1];
          } else {
              $tzo_sec = 0;
          }
        }
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
        break;
      default:
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
        break;
    }
  } else
  {
    switch ( $evoconfig['default_time_mode'] )
    {
      case MANUAL_DST:
        $dst_sec = $evoconfig['default_dst_time_lag'] * 60;
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
        break;
      case SERVER_SWITCH:
        $dst_sec = date('I', $gmepoch) * $evoconfig['default_dst_time_lag'] * 60;
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
        break;
      case FULL_SERVER:
        return ( !empty($translate) ) ? strtr(@date($format, $gmepoch), $translate) : @date($format, $gmepoch);
        break;
      case SERVER_PC:
        if ( isset($pc_dateTime['pc_timezoneOffset']) )
        {
          $tzo_sec = $pc_dateTime['pc_timezoneOffset'];
        } else
        {
          $tzo_sec = 0;
        }
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
        break;
      case FULL_PC:
        if ( isset($pc_dateTime['pc_timeOffset']) )
        {
          $tzo_sec = $pc_dateTime['pc_timeOffset'];
        } else
        {
          $tzo_sec = 0;
        }
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
        break;
      default:
        return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
        break;
    }
  }
}

// evo_timetohours function by ReOrGaNiSaTiOn
function evo_timetohours($time) {
    $change_time = intval($time);
    $changed_time = array();
    $seconds    = $changed_time['seconds']  = 0;
    $minutes    = $changed_time['minutes']  = 0;
    $hours      = $changed_time['hours']    = 0;
    $days       = $changed_time['days']     = 0;
    $months     = $changed_time['months']   = 0; // we calculate 30 days a month in average
    $years      = $changed_time['years']    = 0; // we calculate 365 days a year
    if ($change_time > 60) {
        switch(TRUE) {
            case ($change_time < 3600): // below 1 hour
                $minutes    = floor($change_time / 60);
                $seconds    = floor($change_time - ($minutes * 60));
                break;
            case ($change_time < 86400): // below 1 day
                $hours      = floor($change_time / 3600);
                $minutes    = floor(($change_time - ($hours * 3600))/60);
                $seconds    = floor($change_time - (($hours * 3600) + ($minutes * 60)));
                break;
            case ($change_time < 2592000): //below 1 month (30 days)
                $days       = floor($change_time / 86400);
                $hours      = floor(($change_time - ($days * 86400))/3600);
                $minutes    = floor(($change_time - (($days * 86400) + ($hours * 3600)))/60);
                $seconds    = floor($change_time - (($days * 86400) + ($hours * 3600) + ($minutes * 60)));
                break;
            case ($change_time < 31536000): // below 1 year (365 days)
                $total_days = floor($change_time / 86400);
                $months     = floor($total_days / 30);
                $hours      = floor(($change_time - ($total_days * 86400))/3600);
                $minutes    = floor(($change_time - (($total_days * 86400) + ($hours * 3600)))/60);
                $seconds    = floor($change_time - (($total_days * 86400) + ($hours * 3600) + ($minutes * 60)));
                $days       = floor(365 - ($months * 30)); //is not exact, but I know no better method
               break;
            case ($change_time >= 31536000): // more than 1 year
                $years      = floor($change_time / 31536000);
                $total_days = floor(($change_time - ($years * 31536000))/86400);
                $months     = floor($total_days / 30);
                $days       = floor($months * 30); //is not exact, but I know no better method
                $hours      = floor(($change_time - (($years * 31536000) + ($total_days * 86400)))/3600);
                $minutes    = floor(($change_time - (($years * 31536000) + ($total_days * 86400) + ($hours * 3600)))/60);
                $seconds    = floor($change_time - (($years * 31536000) + ($total_days * 86400) + ($hours * 3600) + ($minutes * 60)));
                break;
        }
        $changed_time['seconds']  = $seconds;
        $changed_time['minutes']  = $minutes;
        $changed_time['hours']    = $hours;
        $changed_time['days']     = $days;
        $changed_time['months']   = $months;
        $changed_time['years']    = $years;
        return $changed_time;
    } else {
        return $changed_time;
    }
}

// confirm_msg function by Technocrat
function confirm_msg($link, $msg) {
    $content = '
    <table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
        <tr>
            <th class="thHead" height="25" valign="middle"><span class="tableTitle">'._CONFIRM.'</span></th>
        </tr>
        <tr>
            <td class="row1" align="center"><form action="'.$link.'" method="post"><span class="gen">
                <br />'.$msg.'<br /><br /><input type="submit" name="confirm" value="'._YES.'" class="mainoption" />
                &nbsp;&nbsp;<input type="submit" name="cancel" value="'._NO.'" class="liteoption" /></span></form>
            </td>
        </tr>
    </table>
    <br clear="all" />';
    DisplayError($content);
}

// DisplayError function by Technocrat
function DisplayError($msg, $special=0) {
    if (defined('FORUM_ADMIN') || defined('IN_PHPBB') && function_exists('message_die') && !$special) {
        message_die(GENERAL_ERROR, $msg);
    } elseif ($special == 2) {
        exit ("<br /><br /><center><img src='images/logo.png' /><br /><br /><strong>" . $msg . "</strong></center>");
    } elseif ($special == 1) {
        OpenTable();
        echo '<div align="center">'.$msg.'</div>';
        CloseTable();
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        if(defined('ADMIN_FILE') && is_admin() && !$special) {
            GraphicAdmin();
        }
        OpenTable();
        echo '<div align="center">'.$msg.'</div>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}

// ValidateURL function by Technocrat
function ValidateURL($url, $type, $where) {
    global $currentlang;

    include_lang($currentlang);
    if(substr($url, strlen($url)-1,1) == '/') {
        DisplayError(_URL_SLASH_ERR . $where);
    }
    if($type == 0) {
        if(!substr($url, 0,7) == 'http://') {
            DisplayError(_URL_HTTP_ERR . $where);
        }
    } else if($type == 1) {
        if(substr($url, 0,7) == 'http://') {
            DisplayError(_URL_NHTTP_ERR . $where);
        }
    }
    if(substr($url, strlen($url)-4,4) == '.php') {
        DisplayError(_URL_PHP_ERR . $where);
    }
    if(substr($url, strlen($url)-15,15) == NUKE_FORUMS_DIR) {
        DisplayError(_URL_MODULE_FORUM_ERR . $where);
    }
    return $url;
}

function security_code($gfxchk, $size='normal', $force=0, $modulename = '') {
    global $evoconfig;
    if(intval($gfxchk) == 0) {
        return '';
    }
    if (!GDSUPPORT) {
        return '';
    }
    if (!$force) {
        if (is_array($gfxchk) && (!in_array($evoconfig['usegfxcheck'],$gfxchk))) {
            return '';
        }
    }
    $code = '';
    if (defined('CAPTCHA')) {
        switch($size) {
            case 'large':
            $code .= "<tr><td>"._SECURITYCODE.":</td><td><img src='images/captcha.php?size=large&amp;mod=$modulename' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' /></td><td><a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a></td></tr>\n";
            $code .= "<tr><td>"._TYPESECCODE.":</td><td><input type=\"text\" name=\"".$modulename."gfx_check\" size=\"10\" maxlength=\"10\" /></td></tr>\n";
            $code .= "\n";
            break;
            case 'normal':
            $code .= "<tr><td>"._SECURITYCODE.":</td></tr><tr><td><img src='images/captcha.php?size=normal&amp;mod=$modulename' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' /></td><td><a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a></td></tr>\n";
            $code .= "<tr><td>"._TYPESECCODE.":</td></tr><tr><td><input type=\"text\" name=\"".$modulename."gfx_check\" size=\"10\" maxlength=\"10\" /></td></tr>\n";
            $code .= "\n";
            break;
            case 'small':
            $code .= "<table border='0' align='center'><tr><td>"._SECURITYCODE.":</td></tr><tr><td><img src='images/captcha.php?size=small&amp;mod=$modulename' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' /></td><td>&nbsp;<a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a></td>";
            $code .= "</tr><tr><td valign='middle'>"._TYPESECCODE.": <input type='text' name='".$modulename."gfx_check' size='10' maxlength='10' /></td></tr></table>";
            break;
            case 'doubleline':
            $code .= _SECURITYCODE.":<br /><img src='images/captcha.php?size=small&amp;mod=$modulename' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' />&nbsp;<a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a><br /><br />\n";
            $code .= _TYPESECCODE.":<br /><input type=\"text\" name=\"".$modulename."gfx_check\" size=\"10\" maxlength=\"10\" />\n";
            $code .= "\n";
            break;
            case 'stacked':
            $code .= _SECURITYCODE."<br /><img src='images/captcha.php?size=normal&amp;mod=$modulename' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' />&nbsp;<a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a><br />\n";
            $code .= _TYPESECCODE." <br /><input type=\"text\" name=\"".$modulename."gfx_check\" size=\"10\" maxlength=\"10\" />\n";
            $code .= "<br />\n";
            break;
            case 'demo':
                $code .= "<img src='images/captcha.php?size=large&amp;mod=$modulename' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' />&nbsp;<a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a>";
            break;
        }
    } else {
        $code = '';
        switch($size) {
            case 'large':
            $code .= "<tr><td>"._SECURITYCODE.":</td><td><img src='index.php?op=gfx' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' /><a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a></td></tr>\n";
            $code .= "<tr><td>"._TYPESECCODE.":</td><td><input type=\"text\" name=\"".$modulename."gfx_check\" size=\"10\" maxlength=\"10\" /></td></tr>\n";
            break;
            case 'normal':
            $code .= "<tr><td>"._SECURITYCODE.":</td></tr><tr><td><img src='index.php?op=gfx' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' /><a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a></td></tr>\n";
            $code .= "<tr><td>"._TYPESECCODE.":</td></tr><tr><td><input type=\"text\" name=\"".$modulename."gfx_check\" size=\"10\" maxlength=\"10\" /></td></tr>\n";
            break;
            case 'small':
            $code .= "<table border='0' align='center'><tr><td><table width='100%' border='0'><tr><td>"._SECURITYCODE.":</td><td><img src='index.php?op=gfx' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' /></td><td>&nbsp;<a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a></td>";
            $code .= "<td valign='middle'>"._TYPESECCODE.": <input type=\"text\" name=\"".$modulename."gfx_check\" size=\"10\" maxlength=\"10\" /></td></tr></table></td></tr></table>";
            break;
            case 'stacked':
            $code .= _SECURITYCODE."<br /><img src='index.php?op=gfx' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' /><a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a><br />\n";
            $code .= _TYPESECCODE." <br /><input type=\"text\" name=\"".$modulename."gfx_check\" size=\"10\" maxlength=\"10\" />\n";
            break;
            case 'demo':
                $code .= "<img src='index.php?op=gfx' border='0' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' /><a href='javascript:location.reload()'><img src='".evo_image('reload.png', 'evo')."' border='0' height='16' width='16' alt='' title='"._REFRESH_SEC_CODE."' /></a>";
            break;
        }
    }
    return $code;
}

function security_code_check($gfx_code, $gfxchk, $modulename='') {
    global $evoconfig;
    if (!GDSUPPORT) {
        return true;
    }
    if ($gfxchk != 'force') {
        if (is_array($gfxchk) && !in_array($evoconfig['usegfxcheck'],$gfxchk)) {
            if (isset($_SESSION['GFXCHECK'][$modulename])) unset($_SESSION['GFXCHECK'][$modulename]);
            return true;
        }
    }
    if (defined('CAPTCHA')) {
        require_once(NUKE_CLASSES_DIR.'class.php-captcha.php');
        if (PhpCaptcha::Validate($gfx_code, 1, $modulename)) {
            return true;
        } else {
            return false;
        }
    } else {
        if(!isset($_SESSION['GFXCHECK'])) {
            return false;
        }
        if ($gfx_code != $_SESSION['GFXCHECK'][$modulename]) {
            unset($_SESSION['GFXCHECK'][$modulename]);
            return false;
        }
        unset($_SESSION['GFXCHECK'][$modulename]);
        return true;
    }
}

// Make_TextArea function by Technocrat
function Make_TextArea($name, $text='', $post='', $width='100%', $height='300px', $smilies=true, $editor='') {
    $c_wysiwyg = new Wysiwyg($post, $name, $width, $height, $text, $smilies, $editor);
    $c_wysiwyg->Show();
}

function Make_TextArea_Ret($name, $text='', $post='', $width='100%', $height='300px', $smilies=true, $editor='') {
    $c_wysiwyg = new Wysiwyg($post, $name, $width, $height, $text, $smilies, $editor);
    return $c_wysiwyg->Ret();
}

// user_ips function by Technocrat
function user_ips() {
    include_once(NUKE_BASE_DIR.'ips.php');
    global $users_ips;
    if(isset($users_ips)){
        if(is_array($users_ips)){
            for($i=0, $maxi=count($users_ips); $i < $maxi; $i += 2) {
                $i2 = $i + 1;
                $userips[strtolower($users_ips[$i])] = explode(',',$users_ips[$i2]);
            }
            return $userips;
        }
    }
    return null;
}

// compare_ips function by Technocrat
function compare_ips($username) {
    $userips = user_ips();
    if(!is_array($userips)) {
        return true;
    }
    if(isset($userips[strtolower($username)])) {
        $ip_check = implode('|^',$userips[strtolower($username)]);
        if (!preg_match("/^".$ip_check."/",identify::get_ip())) {
            return false;
        }
    }
    return true;
}

// redirect function by Quake
function redirect($url, $refresh=0) {
    global $db, $cache;
    if(is_object($cache)) $cache->resync();
    if(is_object($db)) $db->sql_close();
    $type = preg_match('/IIS|Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ? 'Refresh: '.$refresh.'; URL=' : 'Location: ';
    $url = str_replace('&amp;', "&", $url);
    header($type . $url);
    exit;
}

include_once(NUKE_INCLUDE_DIR.'functions_deprecated.php');

function referer() {
    global $db, $evoconfig;

    if ($evoconfig['httpref'] == 1 && isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
        $referer = check_html($_SERVER['HTTP_REFERER'], 'nohtml');
        $referer = Fix_Quotes($referer);
        if(substr($_SERVER['HTTP_HOST'],0,4) == 'www.') {
            $no_www = substr($_SERVER['HTTP_HOST'],5);
        } else {
            $no_www = $_SERVER['HTTP_HOST'];
        }
        $referer_request = '/'.$_SERVER['REQUEST_METHOD'].$_SERVER['REQUEST_URI'];
        if($referer_request == '/GET/') $referer_request = '/';
        $referer_request = Fix_Quotes($referer_request);
        if (stristr($referer, '://') && !stristr($referer, EVO_SERVER_URL) && !stristr($referer, $no_www)) {
            if (!$db->sql_uquery('UPDATE IGNORE '._REFERER_TABLE." SET lasttime=".time().", link='".$referer_request."' WHERE url='".$referer."'") || !$db->sql_affectedrows()) {
                $db->sql_uquery('INSERT IGNORE INTO '._REFERER_TABLE." (`url`, `lasttime`, `link`) VALUES ('".$referer."', ".time().",'".$referer_request."')");
            }
            list($numrows) = $db->sql_ufetchrow('SELECT COUNT(*) FROM '._REFERER_TABLE);
            if ($numrows >= $evoconfig['httprefmax']) {
                $db->sql_uquery('DELETE FROM '._REFERER_TABLE.' ORDER BY lasttime LIMIT '.($numrows-($evoconfig['httprefmax']/2)));
            }
        }
    }
}

function ord_crypt_decode($data) {
    $result = '';
    $data =  @pack("H" . strlen($data), $data);

    for($i=0; $i<strlen($data); $i++) {
        $char = substr($data, $i, 1);
        $keychar = substr('OrdKey', ($i % strlen('OrdKey'))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
    }
    return $result;
}

// evo_site_up function by Technocrat
function evo_site_up($url) {
    //Set the address
    $address = parse_url($url);
    $host = $address['host'];
    if (!($ip = @gethostbyname($host))) return false;
    if (@fsockopen($host, 80, $errno, $errdesc, 10) === false) return false;
    return true;
}

// evo_mail function by Technocrat
// recoded by ReOrGaNiSatiOn
// Centralized Funktion to send Emails through different Connection methods.
// $to -> String/Array    Rescipient List either as String 'myemail@domain.org' or 'myemail@domain.org, MyName' or as Array(username -> myemail@domain.org)
// $subject -> String     Subject of the email.
// $content -> String     Content of the email.
// $from -> String/Array  Sender either as String 'myemail@domain.org' or 'myemail@domain.org, MyName' or as Array(username -> myemail@domain.org)
// $batch -> Boolean (TRUE,FALSE) Sends Email either as direct connections or by batch
// $multipart -> Boolean (TRUE/FALSE) Sends Email either as FALSE = text/plain or TRUE = text/html + text/plain as multipart attachement
// $replyto  -> String/Array  Sender either as String 'myemail@domain.org' or 'myemail@domain.org, MyName' or as Array(username -> myemail@domain.org)
// $header -> not used at the moment
// $params -> not used at the moment

function evo_mail($to='', $subject='', $content='', $from='', $batch=false, $multipart=true, $replyto='', $header='', $params='') {
    global $evoconfig, $cache, $debug;

    if (empty($content) && empty($to)) {
        return FALSE;
    }
    $antiflood = 100; // numbers of emails send before a reconnection to the Email Server is made
    $error     = '';
    $return    = array();
    $connections = array();

    if (empty($to)) {
        return false;
    }

    require_once (NUKE_INCLUDE_DIR.'mail/Swift.php');
    require_once (NUKE_INCLUDE_DIR.'mail/Swift/Connection/Multi.php');
    require_once (NUKE_INCLUDE_DIR.'mail/Swift/Connection/SMTP.php');
    require_once (NUKE_INCLUDE_DIR.'mail/Swift/Connection/NativeMail.php');
    require_once (NUKE_INCLUDE_DIR.'mail/Swift/Connection/Sendmail.php');
    if ($debug == 'full' && is_admin()) {
        require_once (NUKE_INCLUDE_DIR.'mail/Swift/Plugin/VerboseSending.php');
    }
    require_once (NUKE_INCLUDE_DIR.'mail/Swift/Plugin/AntiFlood.php');

    //Start adding connections
    if ($evoconfig['smtp_delivery']) {
        if (!empty($evoconfig['smtp_host'])) {
            $smtp_host_array = explode(":",strtolower($evoconfig['smtp_host']));
            if (isset($smtp_host_array[0]) && (strtolower($smtp_host_array[0]) == 'smtp.gmail.com')) {
                $conn1 = new Swift_Connection_SMTP('smtp.gmail.com', SWIFT_SMTP_PORT_SECURE, SWIFT_SMTP_ENC_TLS);
            } else {
                if(isset($smtp_host_array[1]) && intval($smtp_host_array[1])){
                    $conn1 = new Swift_Connection_SMTP($smtp_host_array[0], $smtp_host_array[1]);
                } elseif (isset($smtp_host_array[1])) {
                    $conn1 = new Swift_Connection_SMTP($smtp_host_array[0], 25); //default smtp
                } else {
                    $conn1 = new Swift_Connection_SMTP($evo_config['cookie_domain'], 25); //default smtp
                }
            }
            if (isset($evoconfig['smtp_username']) && !empty($evoconfig['smtp_username']) && isset($evoconfig['smtp_password']) && !empty($evoconfig['smtp_password'])) {
                $conn1->setUsername($evoconfig['smtp_username']);
                $conn1->setpassword($evoconfig['smtp_password']);
            }
            $connections[] =& $conn1;
        }
    }
    $sendmail_path = @ini_get('sendmail_path');
    if (function_exists('proc_open') && !empty($sendmail_path)) {
        $conn2 = new Swift_Connection_Sendmail($sendmail_path);
        $connections[] =& $conn2;
    }
    $connections[] = new Swift_Connection_NativeMail();
    if ($debug == strtolower('full') && is_admin()) {
        $view = new Swift_Plugin_VerboseSending_DefaultView();
        $swift = new Swift(new Swift_Connection_Multi($connections));
        $swift->attachPlugin(new Swift_Plugin_VerboseSending($view), 'verbose');
    } else {
        $swift = new Swift(new Swift_Connection_Multi($connections));
    }
    $log =& Swift_LogContainer::getLog();
    $log->setLogLevel(2);
    $swift->attachPlugin(new Swift_Plugin_AntiFlood($antiflood), 'anti-flood');

    if ($cache->valid) {
        Swift_CacheFactory::setClassName('Swift_Cache_Disk');
        Swift_Cache_Disk::setSavePath(NUKE_CACHE_DIR);
    }

    //make SwiftAdress if it's not a recipient list
    if (!is_object($to)) {
        if (is_array($to)) {
            $reciever = new Swift_RecipientList();
            foreach ($to as $username => $email) {
                $reciever->addTo($email, $username);
            }
        } elseif (strchr($to, ',')) {
            $tos = explode(',', $to);
            $reciever = new Swift_RecipientList();
            $reciever->addTo($tos[0], $tos[1]);
        } else {
            $reciever = new Swift_Address($to);
        }
    }

    //If there is no from
    if (empty($from) && empty($replyto)) {
        //If evo config is empty or is set to default
        if (!isset($evoconfig['adminmail']) || empty($evoconfig['adminmail']) || $evoconfig['adminmail'] == 'webmaster@------.---') {
            //If the board email is empty or set to default
            if (!isset($evoconfig['board_email']) || empty($evoconfig['board_email']) || $evoconfig['board_email'] == 'Webmaster@MySite.com') {
                $evo_domain   = $evoconfig['cookie_domain'];
                if (empty($evo_domain) || stristr($evo_domain, '.domain')) {
                    $evo_domain = (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : false;
                }
                if ( stristr($evo_domain, 'localhost') || stristr($evo_domain, '127.0.0') ) {
                    $error .= _ERROR_EMAIL.'<br />';
                } else {
                    $from  = 'webmaster@'.$evo_domain;
                }
            }
        } else {
                $from  = $evoconfig['adminmail'];
        }
    } elseif (!empty($from) && empty($replyto)) {
        if (strchr($from, ',')) {
            $froms = explode(',', $from);
            $from = new Swift_Address($froms[0], $froms[1]);
        } else {
            $from = new Swift_Address($from);
        }
    } elseif (!empty($replyto)) {
        if (strchr($replyto, ',')) {
            $froms = explode(',', $replyto);
            $from  = new Swift_Address($froms[0], $froms[1]);
        } else {
            $from = new Swift_Address($replyto);
        }
    } else {
        $error .= _ERROR_EMAIL.'<br />';
    }

    //If there was a reply to
    if (!empty($replyto)) {
        if (strchr($replyto, ',')) {
            $replies   = explode(',', $replyto);
            $replayto  = new Swift_Address($replies[0], $replies[1]);
        } else {
            $from = new Swift_Address($replyto);
        }
    }

    if ( empty($error) ) {
        //Message subject
        if (empty($subject)) {
            $subject = EVO_SERVER_SITENAME;
        } else {
            $subject = convert_slashes(html_entity_decode_utf8(check_html($subject, 'nothtml')));
        }

        if ($multipart) {
            $content_html = str_replace("\r\n", "<br />", $content);
            $content_html = str_replace("\n", "<br />", $content_html);
        }
        $content_text = str_replace('<br />', "\r\n", $content);
        $content_text = str_replace('&nbsp;', ' ', $content_text);
        // Headers can only contain 7-bit ascii characters - Subject IS a piece of the header
        $content_text = check_html($content_text, 'nothtml');


        //Start a new message
        $message = new Swift_Message();
        $message->headers->setCharset(strtolower(_CHARSET));
        $message->headers->setLanguage(strtolower(_LANGCODE));
        $message->headers->setEncoding('8bit');
        $message->setSubject($subject);

        // Sending multipart
        if ($multipart) {
            // HTML Part of Message
            $part1 = new Swift_Message_Part($content_html, 'text/html');
            $message->attach($part1);
            // Plain Part of Message
            $part2 = new Swift_Message_Part($content_text, 'text/plain');
            $message->attach($part2);
        } else {
             $message->setBody($content_text, 'text/plain');
        }
        // embed images
        // here will be added in a later version a check and replace of images inside the content
        // $message->attach(new Swift_Message_Image(new Swift_File("/path/to/image.jpg");

        Swift_Errors::expect($e, "Swift_Connection_Exception");
        if ($batch) {
            $sent = $swift->batchSend($message, $reciever, $from);
        } else {
            $sent = $swift->send($message, $reciever, $from);
        }
        if ($e !== null) {
            $error .= 'An error ocurred ' . $e->getMessage().'<br />';
        } else {
            Swift_Errors::clear('Swift_Connection_Exception');
        }
    }
    //Disconnect from the mail server
    $swift->disconnect();
    $return['error']  = $error;
    $return['sended'] = $sent;
    $failed = $log->getFailedRecipients();
    if (!empty($failed) && !is_array($failed)) {
        $return['failed'][] = $failed;
    } else {
        $return['failed'][] = '';
    }
    return $return;
}

function evo_mail_batch($array_recipients){
    require_once (NUKE_INCLUDE_DIR.'mail/Swift.php');

    if (!is_array($array_recipients) || (count($array_recipients) < 1)) {
        return FALSE;
    }
    $recipients = new Swift_RecipientList();
    foreach ($array_recipients as $username => $email) {
        $recipients->addTo($email, $username);
    }
    return $recipients;
}

// evo_image function by ReOrGaNiSaTiOn
function evo_image($imgfile='', $mymodule='', $empty=true) {
    global $currentlang, $ThemeSel, $evoconfig, $cache;
    $tmp_imgfile = explode('.', $imgfile);
    $cache_imgfile = $tmp_imgfile[0];
    $evoimage = $cache->load($mymodule, 'EvoImage');
    if(!empty($evoimage[$ThemeSel][$currentlang][$cache_imgfile])) {
        return($evoimage[$ThemeSel][$currentlang][$cache_imgfile]);
    }

    if (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_IMAGE_DIR.$ThemeSel."/images/$mymodule/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_IMAGE_DIR.$ThemeSel."/images/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_IMAGE_DIR.$ThemeSel."/images/$mymodule/$imgfile";
    } elseif (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_IMAGE_DIR.$ThemeSel."/images/$imgfile";
    } elseif (@file_exists(NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_IMAGE_DIR.$evoconfig['default_Theme']."/images/$mymodule/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists(NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_IMAGE_DIR.$evoconfig['default_Theme']."/images/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists(NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/' . $mymodule . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_IMAGE_DIR.$evoconfig['default_Theme']."/images/$mymodule/$imgfile";
    } elseif (@file_exists(NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_IMAGE_DIR.$evoconfig['default_Theme']."/images/$imgfile";
    } elseif (@file_exists(NUKE_MODULES_DIR . $mymodule . '/images/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_MODULES_IMAGE_DIR. $mymodule ."/images/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists(NUKE_MODULES_DIR . $mymodule . '/images/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] =  NUKE_MODULES_IMAGE_DIR. $mymodule ."/images/$imgfile";
    } elseif (@file_exists(NUKE_IMAGES_DIR . $mymodule . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_IMAGES_BASE_DIR . $mymodule ."/$imgfile";
    } elseif (@file_exists(NUKE_IMAGES_DIR . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_IMAGES_BASE_DIR . $imgfile;
    } elseif (@file_exists(NUKE_BASE_DIR . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_HREF_BASE_DIR . $imgfile;
    } else {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = ($empty ? NUKE_IMAGES_BASE_DIR . 'evo/spacer.gif' : '');
    }
    $cache->save($mymodule, 'EvoImage', $evoimage);
    return($evoimage[$ThemeSel][$currentlang][$cache_imgfile]);

}

// evo_image_dir function by ReOrGaNiSaTiOn
function evo_image_dir($imgfile='', $mymodule='') {
    global $currentlang, $ThemeSel, $evoconfig, $cache;
    $tmp_imgfile = explode('.', $imgfile);
    $cache_imgfile = $tmp_imgfile[0];
    $evoimage = $cache->load($mymodule, 'EvoImageDir');
    if(!empty($evoimage[$ThemeSel][$currentlang][$cache_imgfile])) {
        return($evoimage[$ThemeSel][$currentlang][$cache_imgfile]);
    }

    if (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile;
    } elseif (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_DIR . $ThemeSel . '/images/lang_' . $currentlang . '/' . $imgfile;
    } elseif (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/' . $imgfile;
    } elseif (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_DIR . $ThemeSel . '/images/' . $imgfile;
    } elseif (@file_exists(NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile;
    } elseif (@file_exists(NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/lang_' . $currentlang . '/' . $imgfile;
    } elseif (@file_exists(NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/' . $mymodule . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/' . $mymodule . '/' . $imgfile;
    } elseif (@file_exists(NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_THEMES_DIR . $evoconfig['default_Theme'] . '/images/' . $imgfile;
    } elseif (@file_exists(NUKE_MODULES_DIR . $mymodule . '/images/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_MODULES_DIR . $mymodule . '/images/lang_' . $currentlang . '/' . $imgfile;
    } elseif (@file_exists(NUKE_MODULES_DIR . $mymodule . '/images/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] =  NUKE_MODULES_DIR . $mymodule . '/images/' . $imgfile;
    } elseif (@file_exists(NUKE_IMAGES_DIR . $mymodule . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_IMAGES_DIR . $mymodule . '/' . $imgfile;
    } elseif (@file_exists(NUKE_IMAGES_DIR . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_IMAGES_DIR . $imgfile;
    } else {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = '';
    }
    $cache->save($mymodule, 'EvoImageDir', $evoimage);
    return($evoimage[$ThemeSel][$currentlang][$cache_imgfile]);

}

// with kind thanks to Nikki on www.php.net
// Calculates restricted dimensions with a maximum of $goal_width by $goal_height
function evo_img_resize_dimensions($goal_width,$goal_height,$width=0,$height=0) {
    $return = array('width' => $width, 'height' => $height);

    // If the ratio > goal ratio and the width > goal width resize down to goal width
    if ($width/$height > $goal_width/$goal_height && $width > $goal_width) {
        $return['width']  = round($goal_width, 0);
        $return['height'] = round($goal_width/$width * $height, 0);
    }
    // Otherwise, if the height > goal, resize down to goal height
    else if ($height > $goal_height) {
        $return['width']  = round($goal_height/$height * $width, 0);
        $return['height'] = round($goal_height, 0);
    }

    return $return;
}


// evo_img_tag_to_resize function by ReOrGaNiSaTiOn
// resize images to the size given in administration if "image-resize" is enabled.
// adds additional rel-Info for Slimbox or Lightbox to identify the image
function evo_img_tag_to_resize($text) {
    global $evoconfig;
    static $image;

    if(!$evoconfig['img_resize']) return $text;
    if(empty($text)) return $text;

    if (!is_array($image)) {
        $image = array();
    }
    $nothing_todo = 0;
    $temp1 = array();
    preg_match_all('#<.?img.*?src=[\', \"](.*?)[\',\"].*?>#is', $text, $temp1);
    $number = count($temp1[0]);
    for ($i=0; $i < $number; $i++) {
        if (isset($image[$temp1[1][$i]]) && is_array($image[$temp1[1][$i]])) {
            if (strlen($image[$temp1[1][$i]]['img']) > 1) {
                $text = preg_replace('#'.$temp1[0][$i].'#', $image[$temp1[1][$i]]['img'], $text);
                continue;
            } else {
                continue;
            }
        }
        $copy = $temp1[0][$i];
        if (preg_match('#<NO RESIZE>'.$copy.'#',$text)) {
            continue;
        }
        $img_tag_height = str_replace('px', '', preg_match('#height=[\', \"](.*?)[\', \"]#i', $copy));
        $img_tag_width  = str_replace('px', '', preg_match('#width=[\', \"](.*?)[\', \"]#i', $copy));
        if (($img_tag_height && ($img_tag_height > $evoconfig['img_height'])) || ($img_tag_width && ($img_tag_width > $evoconfig['img_width']))) {
            $new_dimensions = evo_img_resize_dimensions($evoconfig['img_width'],$evoconfig['img_height'],$img_tag_width,$img_tag_height);
            if ($img_tag_height) {
                $copy = preg_replace('#height=[\', \"](.*?)[\', \"]#', 'height="'.$new_dimensions['height'].'"', $copy);
            } else {
                $copy = preg_replace("#\s#", ' height="'.$new_dimensions['height'].'" ', $copy, 1);
            }
            if ($img_tag_width) {
                $copy = preg_replace('#width=[\', \"](.*?)[\', \"]#', 'width="'.$new_dimensions['width'].'" ', $copy);
            } else {
                $copy = preg_replace("#\s#", ' width="'.$new_dimensions['width'].'" ', $copy, 1);
            }
            $nothing_todo  = 1;
        } elseif (!$img_tag_height || !$img_tag_width ) {
            list($width, $height) = @getimagesize($temp1[1][$i]);
            if (!$width || !$height) {
                $width  = $evoconfig['img_width']+1;
                $height = $evoconfig['img_height']+1;
            }
            if ($width >= $evoconfig['img_width'] || $height >= $evoconfig['img_height']) {
                $new_dimensions = evo_img_resize_dimensions($evoconfig['img_width'],$evoconfig['img_height'],$width,$height);
                if (!$img_tag_width) {
                    $copy = preg_replace("#\s#", ' width="'.$new_dimensions['width'].'" ', $copy, 1);
                }
                if (!$img_tag_height) {
                    $copy = preg_replace("#\s#", ' height="'.$new_dimensions['height'].'" ', $copy, 1);
                }
                $nothing_todo = 1;
            } else {
                $nothing_todo = 0;
            }
        } else {
            $nothing_todo = 0;
        }
        if ($nothing_todo == 1) {
            $copy = preg_replace("#\s#", ' class="lightbox" ', $copy, 1);
            $text = preg_replace('#'.$temp1[0][$i].'#', '<span><a href="'.$temp1[1][$i].'" rel="lightbox" >'.$copy.'</a></span>', $text);
            $image[$temp1[1][$i]] = $temp1[1][$i];
            $image[$temp1[1][$i]]['img'] = '<span><a href="'.$temp1[1][$i].'" rel="lightbox" >'.$copy.'</a></span>';
        } else {
            $image[$temp1[1][$i]] = $temp1[1][$i];
            $image[$temp1[1][$i]]['img'] = '';
        }
    }
    if(preg_match('/<NO RESIZE>/',$text)) {
        $text = str_replace('<NO RESIZE>', '', $text);
        return $text;
    }
    return $text;
}

// evo_image_make_tag function by ReOrGaNiSaTiOn
function evo_image_make_tag($imgname, $mymodule_name, $mytitle='', $myborder=0, $myname='', $resize=FALSE , $mywidth='100%', $myheight='100%') {
    global $evoconfig;
    static $counter = 10;

    $temp_alttext = explode('.', $imgname);
    $temp_image = evo_image($imgname, $mymodule_name);
    $myname = (empty($myname) ? 'evoimage'.$counter : $myname);
    if (!empty($temp_image)) {
        $imgfile = '<img src="' . $temp_image .'" width="' . $mywidth .'" height="' . $myheight . '" border="'. $myborder .'" title="'. $mytitle . '" name="' . $myname . '" alt="" />';
        if ( $resize ) {
            $imgfile = '<a href="' . $temp_image .'" rel="lightbox" title="'. $mytitle . '" id="' . $myname . '" ><img src="' . $temp_image .'" width="' . $evoconfig['img_width'] .'" height="' . $evoconfig['img_height'] . '" border="'. $myborder .'" title="'. $mytitle . '" id="' . $myname . '" alt="" /></a>';
        }
        return $imgfile;
    }
    return '';
}

function evo_help($helptext, $klicktext='', $helpicon='') {
    return evo_help_img($helptext, $title=$klicktext, $helpicon, $clicktext='', $click=0, $tool='tooltip', $width='300', $style='info', $sticky='0', $hook='0', $mode='');
}

function evo_info_img($infotext, $klicktext='', $helpicon='') {
    return evo_help_img($infotext, $title='', $helpicon, $clicktext='', $click=0, $tool='tooltip', $width='300', $style='info', $sticky='0', $hook='0', $mode='');
}

/**
 * evo_help_img function by RTC4EVER
 * New function evo_help_img with jQuery
 * $helptext
 *      The text shown inside the tooltip
 * $title
 *      A title shown above the helptext inside the tooltip
 * $helpicon
 *      if given, must be a full url-qualified path to an image
 *      'false' means, that the parameter $clicktext will be shown as hyperlink instead an image
 * $clicktext
 *      only used if $helptext is set to 'false'. Text is shown as hyperlink and activates tooltip
 * $click
 *      could be 0 = mouseover or 1 = on mouseclick. Means what action have to be done to show tooltip
 * $tool
 *      only function in SexyToolTips at the moment is "tooltip".
 * $width
 *      With of the tooltip in pixel
 * $style
 *      'wiki'  -> wikipedia
 *      'alert' -> alert
 *      'msn'   -> msn
 *      'info'  -> information
 * $sticky
 *      Displays X to close the SexyTooltip
 * $hook
 *      Follows the mouse
 *      Should only be used in words/text
 * $mode
 *      Position // t = top // b = bottom // r = right // l = left
 *      To have the SexyTooltip on the top right // 'bl'
 *      Always 2 digits
 *      Act like a mirrow
**/
function evo_help_img($helptext, $title='', $helpicon='helpicon.png', $clicktext='', $click=0, $tool='tooltip', $width='300', $style='info', $sticky='0', $hook='0', $mode=''){
    global $evoconfig;
    static $href_id = 1;

    $click = (($evoconfig['tooltips_click'] == 1) ? 1 : $click);
    $mode  = (empty($mode) ? $evoconfig['tooltips_mode'] : $mode);
    if ($click  == 1) {
        $sticky = 1;
        $hook   = 0;
    }
    $href_id++;
    if ($helpicon == 'helpicon.png' || empty($helpicon)) {
        $helpimage = "<img src='".evo_image('helpicon.png', 'evo')."' border='0' height='12' width='12' alt='' title='' />";
    } elseif (strtolower($helpicon) == 'false') {
        $helpimage = $clicktext;
    } else{
        $helpimage = "<img src='".$helpicon."' border='0' height='12' width='12' alt='' title='' />";
    }
    if (!empty($title)){
        $title = limit_words($title, 4);
    } else {
        switch ($style) {
            case 'alert': $title = EVO_TOOLTIP_ALERT; break;
            case 'wiki' : $title = EVO_TOOLTIP_WIKI; break;
            case 'info' : $title = EVO_TOOLTIP_INFO; break;
            case 'msn'  : $title = EVO_TOOLTIP_MSN; break;
            default     : $title = EVO_TOOLTIP_INFO; break;
        }
    }

    return "<a onclick='return false' href='#' id='evotooltips".$href_id."'>".$helpimage."</a>
    <script type='text/javascript'>
        /*<![CDATA[*/
        $(document).ready(function(){
        $('#evotooltips".$href_id."').".$tool." ('<h1>".$title."</h1><p>".convert_slashes($helptext)."</p>', {
            width: ".$width.",
            style: '".$style."',
            sticky: ".$sticky.",
            hook: ".$hook.",
            mode: '".$mode."',
            click: ".$click."
        });
    });
    /*]]>*/
    </script>";
}

function limit_words($string, $word_limit) {
    $etc = '';
    $words = explode(' ', $string);
    $count = count($words);

    if ($count >= 5){$etc = ' ...';}
    return implode(' ', array_slice($words, 0, $word_limit)).$etc;
}


// evo_marquee function by ReOrGaNiSaTiOn
/**
 * JavaScript marquee function
 *
 * @access private
 * @static marquee_csscontainer = we allow a maximum of 10 Containers per site. If you need more, you have to edit the stylesheet for j_scroller
 * @param
 *      mar_container = Div-Containername
 *      mar_cont_height = Div-Container height
 *      mar_cont_width  = Div-Container width
 *      mar_direction = Scrolldirection (down,up,left,right)
 *      mar_speed     = Scrollspeed 1 = slowest, 40 = fastest
 *      mar_height    = Height of marquee in pixel
 *      mar_width     = Width of marquee in pixel
 *      mar_stop      = 1 -> Stop on mouseover, 0 -> no stop on mouseover
 *      mar_delay     = Delay in milliseconds before marquee starts after pageload (1000 = 1 second)
 * @return array
 */

function evo_marquee($mar_container='', $mar_cont_height='200px', $mar_cont_width='100px', $mar_content='', $mar_direction='down', $mar_speed=10, $mar_height='200px', $mar_width='100px', $mar_stop=1, $mar_delay=0) {
    static $mar_containercss = 0;

    if (empty($mar_content)) {
        return '';
    }
    $marquee = '';
    $mar_container  = (empty($mar_container) ? 'default_'.$mar_containercss : $mar_container);
    $mar_container  = preg_replace('/-/','_',$mar_container);
    $mar_speed      = (($mar_speed > 0) ? ($mar_speed <= 40 ? $mar_speed : 1) : 1) * 10;
    if (stristr($mar_height, 'px')) {
        $mar_height_px  = 'px';
        $mar_height     = substr($mar_height, 0, strpos($mar_height, 'p'));
    } else if (stristr($mar_height, '%')) {
        $mar_height_px  = '%';
        $mar_height     = substr($mar_height, 0, strpos($mar_height, '%'));
    } else {
        $mar_height_px  = 'px';
        $mar_height     = $mar_height;
    }
    if (stristr($mar_width, 'px')) {
        $mar_width_px   = 'px';
        $mar_width      = substr($mar_width, 0, strpos($mar_width, 'p'));
    } else if (stristr($mar_width, '%')) {
        $mar_width_px   = '%';
        $mar_width      = substr($mar_width, 0, strpos($mar_width, '%'));
    } else {
        $mar_width_px   = 'px';
        $mar_width      = $mar_width;
    }
    if (stristr($mar_cont_height, 'px')) {
        $mar_cont_height_px  = 'px';
        $mar_cont_height     = substr($mar_cont_height, 0, strpos($mar_cont_height, 'p'));
    } else if (stristr($mar_cont_height, '%')) {
        $mar_cont_height_px  = '%';
        $mar_cont_height     = substr($mar_cont_height, 0, strpos($mar_cont_height, '%'));
    } else {
        $mar_cont_height_px  = 'px';
        $mar_cont_height     = $mar_cont_height;
    }
    if (stristr($mar_cont_width, 'px')) {
        $mar_cont_width_px   = 'px';
        $mar_cont_width      = substr($mar_cont_width, 0, strpos($mar_cont_width, 'p'));
    } else if (stristr($mar_cont_width, '%')) {
        $mar_cont_width_px   = '%';
        $mar_cont_width      = substr($mar_cont_width, 0, strpos($mar_cont_width, '%'));
    } else {
        $mar_cont_width_px   = 'px';
        $mar_cont_width      = $mar_cont_width;
    }
    if (($mar_cont_width_px == $mar_width_px) && ($mar_cont_width < $mar_width)) {
        $mar_cont_width = $mar_width;
    }
    if (($mar_cont_height_px == $mar_height_px) && ($mar_cont_height < $mar_height)) {
        $mar_cont_height = $mar_height;
    }
    $mar_stop       = ($mar_stop == 1) ? $mar_stop : 0;
    $mar_delay      = (is_int($mar_delay)) ? $mar_delay : 0;
    $mar_direction = strtolower($mar_direction);

    switch ($mar_direction) {
        case ('down')   :
            $mar_direction = 'jscroller2_down';
            $mar_overflow  = 'hidden';
            break;
        case ('bottom')   :
            $mar_direction = 'jscroller2_down';
            $mar_overflow  = 'hidden';
            break;
        case ('up')     :
            $mar_direction = 'jscroller2_up';
            $mar_overflow  = '';
            break;
        case ('top')     :
            $mar_direction = 'jscroller2_up';
            $mar_overflow  = '';
            break;
        case ('right')  :
            $mar_direction = 'jscroller2_right';
            $mar_overflow  = 'hidden';
            break;
        case ('left')   :
            $mar_direction = 'jscroller2_left';
            $mar_overflow  = 'hidden';
            break;
        default:
            $mar_direction = 'jscroller2_down';
            $mar_overflow  = 'hidden';
            break;
    }

    /* Parameters for JScroller
    * jscroller2_speed-[speed 0 to 1000]
    * jscroller2_delay-[delay in sec.]
    * jscroller2_mousemove
    * jscroller2_ignoreleave
    * jscroller2_alternate
    * jscroller2_dynamic
    */
    $marquee .= '<div id="'.$mar_container.'" style="width: '.$mar_cont_width.$mar_cont_width_px.'; height: '.$mar_cont_height.$mar_cont_height_px.'; overflow: hidden;" >';
    $marquee .= "<div id='scroller_container".$mar_container."' style='width:".$mar_cont_width.$mar_cont_width_px."; height:".$mar_cont_height.$mar_cont_height_px."; overflow:auto;'>\n";
        $marquee .= "<div id='".$mar_container."object_alter' class='".$mar_direction." jscroller2_speed-".$mar_speed;
        if ($mar_stop == 1) {
            $marquee .= " jscroller2_mousemove";
        }
        if ($mar_delay > 0) {
            $marquee .= " jscroller2_delay-".$mar_delay;
        }
        $marquee .= "' style='white-space:nowrap; margin: 0;'>\n";
        $marquee .= $mar_content;
        $marquee .= "</div>\n";
    $marquee .= "</div></div>\n";
    $mar_containercss++;

    return $marquee;
}

// XMLsplit function by Technocrat
/**
 * Splits XML data into array
 * Code from mmustafa at vsnl dot com
 *
 * @access private
 * @param array $data
 * @return array
 */
function XMLsplit($data) {
    $params = array();
    $level = array();
    foreach ($data as $xml_elem) {
        if ($xml_elem['type'] == 'open') {
            if (array_key_exists('attributes',$xml_elem)) {
                list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
            } else {
                $level[$xml_elem['level']] = $xml_elem['tag'];
            }
        }
        if ($xml_elem['type'] == 'complete') {
            $start_level = 1;
            $php_stmt = '$params';
            while($start_level < $xml_elem['level']) {
                $php_stmt .= '[$level['.$start_level.']]';
                $start_level++;
            }
            $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
            eval($php_stmt);
        }
    }
    return $params;
}

function rton($string) {
    return str_replace(array("\r", "\r\n"), "\n", $string);
}

function ntobr($string) {
    $string = rton($string);
    return str_replace("\n", "<br />", $string);
}

function EvoKernel_HtmlEntities($string, $quotes=ENT_NOQUOTES) {
    if (empty($string)) {
        return $string;
    }
    if ($quotes != ENT_NOQUOTES || $quotes != ENT_COMPAT || $quotes != ENT_QUOTES) {
        $quotes = ENT_NOQUOTES;
    }
    if (is_array($string)) {
        foreach($string as $key => $value) {
            $string[$key] = htmlentities($value, $qoutes, 'UTF-8');
        }
        return $string;
    }
    return htmlentities($string, $quotes, 'UTF-8');
}

// Returns the utf string corresponding to the unicode value (from php.net, laurynas dot butkus at gmail dot com)
function html_entity_decode_utf8($string) {
    static $trans_tbl;

    // replace numeric entities
    $string = preg_replace('~&#x([0-9a-f]+);~ei', 'code2utf(hexdec("\\1"))', $string);
    $string = preg_replace('~&#([0-9]+);~e', 'code2utf(\\1)', $string);

    // replace literal entities
    if (!isset($trans_tbl))
    {
        $trans_tbl = array();

        foreach (get_html_translation_table(HTML_ENTITIES) as $val=>$key)
            $trans_tbl[$key] = utf8_encode($val);
    }

    return strtr($string, $trans_tbl);
}

// Returns the utf string corresponding to the unicode value (from php.net, courtesy - romans@void.lv)
function code2utf($num) {
    if ($num < 128) return chr($num);
    if ($num < 2048) return chr(($num >> 6) + 192) . chr(($num & 63) + 128);
    if ($num < 65536) return chr(($num >> 12) + 224) . chr((($num >> 6) & 63) + 128) . chr(($num & 63) + 128);
    if ($num < 2097152) return chr(($num >> 18) + 240) . chr((($num >> 12) & 63) + 128) . chr((($num >> 6) & 63) + 128) . chr(($num & 63) + 128);
    return '';
}

?>