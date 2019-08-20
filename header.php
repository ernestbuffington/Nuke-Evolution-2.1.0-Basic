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

if(!defined('HEADER')) {
    define('HEADER', true);
} else {
    return;
}

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }


require_once(dirname(__FILE__).'/mainfile.php');
$add_count=array();

function head() {
    global $evoconfig, $ab_config, $cache, $userinfo, $sitekey, $db, $name, $ads, $browser, $ThemeSel, $header_meta, $simple_header, $more_styles;
    include_once(NUKE_THEMES_DIR.$ThemeSel.'/theme.php');
    if (@file_exists(NUKE_INCLUDE_DIR . 'mimetype.php')) {
        include(NUKE_INCLUDE_DIR . 'mimetype.php');
    } else {
        header('Content-Type: ' . _MIME . ';charset=' . _CHARSET);
        header('Vary: Accept');
        echo '<?xml version="1.0" encoding="' . _MIME . '"?>';
        echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'._LANGCODE.'">', "\n";
        echo '<head>', "\n";
    }
    include_once(NUKE_INCLUDE_DIR.'meta.php');
    if (!empty($header_meta)) {
        echo $header_meta;
    }
    include_once(NUKE_INCLUDE_DIR.'dynamic_titles.php');
    if (!$simple_header) {
        $favicon = evo_image('favicon.ico', 'evo');
        echo "<link rel='shortcut icon' href='".$favicon."' type='image/x-icon' />\n";
        if (is_active('News')) {
            echo "<link rel='alternate' type='application/rss+xml' title='RSS ".EVO_SERVER_SITENAME." &raquo; "._ADMIN_BLOCK_NEWS."' href='rss.php?feed=news' />\n";
        } else if (is_active('ForumNews')) {
            echo "<link rel='alternate' type='application/rss+xml' title='RSS ".EVO_SERVER_SITENAME." &raquo; "._FNA."' href='rss.php?feed=forumnews' />\n";
        }
        if (is_active('Forums')) {
            echo "<link rel='alternate' type='application/rss+xml' title='RSS ".EVO_SERVER_SITENAME." &raquo; "._BBFORUMS."' href='rss.php?feed=forums' />\n";
        }
        if (is_active('Downloads')) {
            echo "<link rel='alternate' type='application/rss+xml' title='RSS ".EVO_SERVER_SITENAME." &raquo; "._UDOWNLOADS."' href='rss.php?feed=downloads' />\n";
        }
        if (is_active('Web_Links')) {
           echo "<link rel='alternate' type='application/rss+xml' title='RSS ".EVO_SERVER_SITENAME." &raquo; "._AWL."' href='rss.php?feed=weblinks' />\n";
        }
    }
    $style = "<link rel='stylesheet' href='".NUKE_THEMES_MAIN_DIR.$ThemeSel."/style/style.css' type='text/css'/>\n";
    if ($browser == 'ie' || $browser == 'konqueror' || $browser == 'MSIE') {
        if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/style/style_ie.css')) {
            $style = "<link rel='stylesheet' href='".NUKE_THEMES_MAIN_DIR.$ThemeSel."/style/style_ie.css' type='text/css' />\n";
        }
    } else if ($browser == 'Mozilla' || $browser == 'Firefox' || $browser == 'Gecko' || $browser == 'Netscape') {
        if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/style/style_mozilla.css')) {
            $style = "<link rel='stylesheet' href='".NUKE_THEMES_MAIN_DIR.$ThemeSel."/style/style_mozilla.css' type='text/css' />\n";
        }
    } else if ($browser == 'Opera') {
        if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/style/style_opera.css')) {
            $style = "<link rel='stylesheet' href='".NUKE_THEMES_MAIN_DIR.$ThemeSel."/style/style_opera.css' type='text/css' />\n";
        }
    }
    echo $style;
    echo "<link rel='stylesheet' href='".NUKE_INCLUDE_HREF_DIR."slimbox/css/slimbox.css' type='text/css' />\n";
    include_once(NUKE_INCLUDE_DIR.'styles.php');

    if (!$simple_header) {
        include_once(NUKE_INCLUDE_DIR.'javascript.php');
        if ((($custom_head = $cache->load('custom_head', 'config')) === false) || empty($custom_head)) {
            $custom_head = array();
            if (@file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_head.php')) {
                $custom_head[] = 'custom_head';
            }
            if (@file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_header.php')) {
                $custom_head[] = 'custom_header';
            }
            if (!empty($custom_head)) {
                foreach ($custom_head as $file) {
                    include_once(NUKE_INCLUDE_DIR.'custom_files/'.$file.'.php');
                }
            }
            $cache->save('custom_head', 'config', $custom_head);
        } else {
            if (!empty($custom_head)) {
                foreach ($custom_head as $file) {
                    include_once(NUKE_INCLUDE_DIR.'custom_files/'.$file.'.php');
                }
            }
        }
    }
    if (!defined('PHPBB_ADMIN')) {
        echo "</head>\n";
    }
    if($ab_config['site_switch'] == 1) {
        echo '<center><img src="images/nukesentinel/disabled.png" alt="'._AB_SITEDISABLED.'" title="'._AB_SITEDISABLED.'" border="0" /></center><br />';
    }
    if (!$simple_header) {
        themeheader();
    }
}

function online() {
    global $db, $name, $evoconfig, $userinfo, $add_count, $SID, $admin_file, $_GETVAR, $cache;

    define('EVO_KERNEL_ONLINE', TRUE);
    $session_id = '';
    $ip = identify::get_ip();
    $url = Fix_Quotes($_SERVER['REQUEST_URI']);
    $uname = $ip;
    $guest = 1;
    $user_agent = identify::identify_agent();
    if (is_user()) {
        $uname = $userinfo['username'];
        $guest = 0;
        $session_id = (( !empty($userinfo['session_id']) ) ? $userinfo['session_id'] : ( (!empty($SID) ) ? substr($SID, 4) : ''));
    } elseif($user_agent['engine'] == 'bot') {
        $uname = $user_agent['bot'];
        $guest = 3;
        $session_id = (( !empty($userinfo['session_id']) ) ? $userinfo['session_id'] : ( (!empty($SID) ) ? substr($SID, 4) : ''));
    }
    if (preg_match('^'.$admin_file.'^', $url)) {
        $custom_title = _ADMINISTRATION.': ';
        if ($_GETVAR->get('op', '_REQUEST', 'string')) {
            $custom_title .= ucfirst($_GETVAR->get('op', '_REQUEST', 'string'));
        }
    } elseif (preg_match('^modules.php^', $url)) {
        $custom_title = _ADMIN_BLOCK_MODULES.': '.ucfirst($name);
    } else {
        $custom_title = _HOME;
    }
    $url = str_replace('&amp;', '&', $url);
    $past = time()-($evoconfig['session_length']- 60);
    $db->sql_uquery('DELETE FROM '._SESSION_TABLE.' WHERE time < "'.$past.'"');
    $ctime = time();
    list($count) = $db->sql_ufetchrow("SELECT COUNT(uname) FROM "._SESSION_TABLE." WHERE uname='$uname'");
    if ($count >= 1) {
       $result = $db->sql_uquery('UPDATE '._SESSION_TABLE.' SET time="'.$ctime.'", module="'.$custom_title.'", url="'.$url.'" WHERE uname="'.$uname.'"');
    } else {
       $db->sql_uquery('INSERT INTO '._SESSION_TABLE.' (uname, time, starttime, host_addr, guest, module, url, session_id) VALUES ("'.$uname.'", "'.$ctime.'", "'.$ctime.'", "'.$ip.'", "'.$guest.'","'.$custom_title.'", "'.$url.'", "'.$session_id.'")');
       $add_count['count'] = 1;
       $add_count['who'] = $guest;
    }#
    if ( $evoconfig['expiring'] != 0 ) {
        $past = time()-$evoconfig['expiring'];
        $res = $db->sql_query("SELECT user_id FROM "._USERS_TEMP_TABLE." WHERE time < '$past'");
        while (list($uid) = $db->sql_fetchrow($res)) {
            $uid = intval($uid);
            $db->sql_uquery("DELETE FROM "._USERS_TEMP_TABLE." WHERE user_id = '".$uid."'");
            $db->sql_uquery("DELETE FROM "._CNBYA_VALUE_TEMP_TABLE." WHERE uid = '".$uid."'");
        }
        $cache->delete('numwaituser', 'submissions');
    }
}

online();
if (!defined('LOADER')) {
    head();

    if(!defined('ADMIN_FILE')) {
        echo '<div id="evo_content">';
        include(NUKE_INCLUDE_DIR.'counter.php');
        if(defined('HOME_FILE')) {
            include(NUKE_INCLUDE_DIR.'messagebox.php');
            blocks('Center');
        }
    }
}

?>