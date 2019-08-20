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

if(defined('NUKE_EVO')) return;

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

if(stristr($_SERVER['REQUEST_URI'], '.php/')) {
    redirect(str_replace('.php/', '.php', $_SERVER['REQUEST_URI']));
}
$start_time = get_microtime();
$start_mem  = function_exists('memory_get_usage') ? memory_get_usage() : 0;

// Define File
define('NUKE_EVO', '2.1.0');
define('EVO_EDITION', 'Basic');
define('EVO_BUILD', 2030);
define('PHPVERS', phpversion());
define('EVO_VERSION', NUKE_EVO . ' ' . EVO_EDITION);
// If you want to work without Sentinel, uncomment the next line
// define('NO_SENTINEL', TRUE);
if (version_compare(PHPVERS, '5.0.0', '>=')) {
    define('PHPVERS5', TRUE);
}
if (version_compare(PHPVERS, '5.1.0', '>=')) {
    define('EVO_KERNEL_TZ_DEFAULT', @date_default_timezone_get());
    if (!ini_get('date.timezone')) {
        date_default_timezone_set(EVO_KERNEL_TZ_DEFAULT);
    }
}
// Uncomment this line if you don't want check_html using InputFilter
//define('INPUT_FILTER', TRUE);

$rel_path=array();
$rel_path['file']   = str_replace('\\', "/", realpath(dirname(__FILE__)));
$server_ary         = pathinfo(realpath(basename($_SERVER['PHP_SELF'])));
$rel_path['server'] = str_replace('\\', "/", $server_ary['dirname']);
$rel_path['uri']    = realpath(basename(substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'))));
$script_abs_path    = pathinfo(realpath($_SERVER['SCRIPT_FILENAME']));
$rel_path['script'] = str_replace('\\', "/",$script_abs_path['dirname']);
if ( ($rel_path['file'] == $rel_path['script']) && (strlen($_SERVER['DOCUMENT_ROOT']) < strlen($script_abs_path['dirname'])) ) {
    $href_path = '/'.str_replace($_SERVER['DOCUMENT_ROOT'], '', $rel_path['script'] );
    if ( substr($href_path, 0, 2) == '//') {
        $href_path = substr($href_path, 1);
    }
} elseif (strlen($rel_path['file']) == (strlen($_SERVER['DOCUMENT_ROOT']) - 1) ) {
    $href_path = '';
} elseif ( strlen($rel_path['script']) > strlen($_SERVER['DOCUMENT_ROOT']) && (strlen($_SERVER['DOCUMENT_ROOT']) > strlen($rel_path['file'])) ) {
    $href_path = '';
} elseif (strlen($rel_path['file']) > strlen($_SERVER['DOCUMENT_ROOT'])) {
    $href_path = '/'.str_replace($_SERVER['DOCUMENT_ROOT'], '', $rel_path['file']);
    if ( substr($href_path, 0, 2) == '//') {
        $href_path = substr($href_path, 1);
    }
} else {
    $href_path='http://'.$_SERVER['SERVER_NAME'];
}

unset ($rel_path);
unset ($server_ary);
unset ($script_abs_path);
// BASE Directory
define('NUKE_BASE_DIR', dirname(__FILE__) . '/');
define('NUKE_HREF_BASE_DIR', $href_path . '/');
// ADMIN Directory
define('NUKE_ADMIN_DIR', NUKE_BASE_DIR . 'admin/');
define('NUKE_ADMIN_MODULE_DIR', NUKE_ADMIN_DIR . 'modules/');
// INCLUDES Directories
define('NUKE_INCLUDE_DIR', NUKE_BASE_DIR . 'includes/');
define('NUKE_INCLUDE_HREF_DIR', $href_path . '/includes/');
define('NUKE_CACHE_DIR', NUKE_INCLUDE_DIR . 'cache/');
define('NUKE_CLASSES_DIR', NUKE_INCLUDE_DIR . 'classes/');
// DB Directory
define('NUKE_DB_DIR', NUKE_INCLUDE_DIR . 'db/');
// MODULES Directory
define('NUKE_HREF_MODULES_DIR', $href_path . '/modules/');
define('NUKE_MODULES_DIR', NUKE_BASE_DIR . 'modules/');
define('NUKE_MODULES_IMAGE_DIR', $href_path . '/modules/');
// BLOCKS Directory
define('NUKE_BLOCKS_DIR', NUKE_BASE_DIR . 'blocks/');
// IMAGES Directory
define('NUKE_IMAGES_DIR', NUKE_BASE_DIR . '/images/');
define('NUKE_IMAGES_BASE_DIR', $href_path . '/images/');
// LANGUAGE Directory
define('NUKE_LANGUAGE_DIR', NUKE_BASE_DIR . 'language/');
define('NUKE_LANGUAGE_CUSTOM_DIR', NUKE_LANGUAGE_DIR . 'custom/');
// STYLE Directory
define('NUKE_THEMES_DIR', NUKE_BASE_DIR . 'themes/');
define('NUKE_THEMES_IMAGE_DIR', $href_path . '/themes/');
define('NUKE_THEMES_MAIN_DIR',  $href_path . '/themes/');
// FORUMS Directory
define('NUKE_FORUMS_DIR', NUKE_MODULES_DIR . 'Forums/');
define('NUKE_FORUMS_ADMIN_DIR', NUKE_FORUMS_DIR . 'admin/');
define('NUKE_FORUMS_ADMIN_HREF_DIR', $href_path . '/modules/Forums/admin/');
// OTHER Directories
define('NUKE_RSS_DIR', NUKE_INCLUDE_DIR . 'rss/');
define('NUKE_STATS_DIR', NUKE_THEMES_DIR);
define('INCLUDE_PATH', NUKE_BASE_DIR);

define('GZIPSUPPORT', extension_loaded('zlib'));
define('GDSUPPORT', extension_loaded('gd'));
define('CAN_MOD_INI', !stristr(ini_get('disable_functions'), 'ini_set'));

//Check for these functions to see if we can use the new captcha
if(function_exists('imagecreatetruecolor') && function_exists('imageftbbox')) {
    define('CAPTCHA',true);
}

if (CAN_MOD_INI) {
    ini_set('magic_quotes_sybase', 0);
    ini_set('zlib.output_compression', 0);
}

if (ini_get('output_buffering') && !isset($agent['bot'])) {
    ob_end_clean();
    header('Content-Encoding: none');
}
$do_gzip_compress = false;
if (GZIPSUPPORT && !ini_get('zlib.output_compression') && isset($_SERVER['HTTP_ACCEPT_ENCODING']) && preg_match('#gzip#', $_SERVER['HTTP_ACCEPT_ENCODING'])) {
    if (version_compare(PHPVERS, '4.3.0', '>=')) { // PHP 4.2.x seems to give memleak
        ob_start('ob_gzhandler');
    } else {
        $do_gzip_compress = true;
        ob_start();
        ob_implicit_flush(0);
        header('Content-Encoding: gzip');
    }
} else {
    ob_start();
    ob_implicit_flush(0);
}

$session_start = session_start();
$_SESSION['NUKE_EVO'] = NUKE_EVO;

// Include config file
@require(NUKE_DB_DIR.'config.php');
if(!$directory_mode) {
    $directory_mode = 0755;
}
if (!$file_mode) {
    $file_mode = 0644;
}
if(!isset($admin_file) || empty($admin_file)) {
    die('You must set a value for $admin_file in config.php');
} elseif (!empty($admin_file) && (!defined('ADMIN_FILE') && !@file_exists(NUKE_BASE_DIR.$admin_file.'.php'))) {
    die('The $admin_file you defined in config.php does not exist');
}
require(NUKE_INCLUDE_DIR.'constants.php');
require(NUKE_DB_DIR.'db.php');
require(NUKE_CLASSES_DIR.'class.cache.php');
require(NUKE_CLASSES_DIR.'class.identify.php');
global $agent;
$agent = identify::identify_agent();
require(NUKE_INCLUDE_DIR.'log.php');
require(NUKE_INCLUDE_DIR.'functions_evo.php');
require(NUKE_INCLUDE_DIR.'functions_user.php');
require(NUKE_INCLUDE_DIR.'functions_selects.php');
require(NUKE_CLASSES_DIR.'class.variables.php');
require(NUKE_CLASSES_DIR.'class.debugger.php');
include(NUKE_INCLUDE_DIR.'validation.php');

$donate_cookie = $_GETVAR->get('DONATION', '_COOKIE', 'string');
if (!empty($donate_cookie)) {
    evo_setcookie('DONATION', 'delete', -1);
    redirect('modules.php?name=Donations&amp;op=thankyou');
}
unset($get_file);
unset($donate_cookie);
// We globalize the $userinfo variable,
// so that they dont have to be called each time
// And as you can see, getusrinfo() and $cookie now is deprecated.
// You dont have to call it anymore, just call $userinfo
// Be aware, that an admin which isn't logged in as user, get's as $userinfo
// the same values as a guest
if(is_user()) {
    $userinfo = get_user_field('*', cookiedecode(), true);
} else {
    $userinfo = get_user_field('*', ANONYMOUS, false);
}
//If they have been deactivated send them to logout to kill their cookie and sessions
$getname = $_GETVAR->get('name', '_REQUEST', 'string');
if (is_array($userinfo) && isset($userinfo['user_active']) && $userinfo['user_id'] != ANONYMOUS && $userinfo['user_id'] != 0 && $userinfo['user_active'] == 0 && $getname != 'Your_Account') {
    redirect('modules.php?name=Your_Account&amp;op=logout');
    die();
}
unset($getname);
$postcache = $_GETVAR->get('clear_cache', '_POST', 'string');
if (!empty($postcache)) {
    $cache->clear();
}
unset ($postcache);
define('NUKE_FILE', true);

$sitekey        = md5($_SERVER['HTTP_HOST']);
$gfx_chk        = 0;
$tipath         = 'images/Topics/';

$evoconfig      = load_evoconfig();
$nukeconfig     = &$evoconfig;
$board_config   = &$evoconfig;
// Ok ... this must be - otherwise we get the board-startdate allways in the install language
$evoconfig['startdate'] = formatTimestamp($evoconfig['startdate']);
$evoconfig['directory_mode'] = (empty($evoconfig['directory_mode']) ? $directory_mode : $evoconfig['directory_mode']);
$evoconfig['file_mode'] = (empty($evoconfig['file_mode']) ? $file_mode : $evoconfig['file_mode']);

if (CAN_MOD_INI) {
    ini_set('sendmail_from', $evoconfig['adminmail']);
}
$more_js        = array();
$more_styles    = array();

define('EVO_SERVER_URL', $evoconfig['nukeurl']);
define('EVO_SERVER_SLOGAN', $evoconfig['slogan']);
define('EVO_SERVER_SITENAME', $evoconfig['sitename']);

include_once(NUKE_MODULES_DIR.'Your_Account/includes/mainfileend.php');
require_once(NUKE_INCLUDE_DIR.'language.php');
$evoconfig['reasons'] = array(_AS_IS, _OFFTOPIC, _FLAMEBAIT, _TROLL, _REDUNDANT, _INSIGHTFUL, _INTERESTING, _INFORMATIVE, _FUNNY, _OVERRATED, _UNDERRATED);

require_once(NUKE_INCLUDE_DIR.'functions_browser.php');
require_once(NUKE_INCLUDE_DIR.'themes.php');
if ($evoconfig['lazy_tap'] && !defined('ADMIN_FILE') && !defined('FORUM_ADMIN') && !defined('IN_ADMIN') && !defined('CNBYA')) {
    include_once(NUKE_INCLUDE_DIR.'functions_tap.php');
}
if (!defined('NO_SENTINEL')) {
    require_once(NUKE_INCLUDE_DIR.'nukesentinel.php');
}
include_once(NUKE_CLASSES_DIR.'class.wysiwyg.php');

if (@file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_mainfile.php')) {
    require_once(NUKE_INCLUDE_DIR.'custom_files/custom_mainfile.php');
}
include_once(NUKE_INCLUDE_DIR.'functions_files.php');

if (!defined('RSS_FEED')) {
    $ThemeSel = get_theme();
    include_once(NUKE_THEMES_DIR . $ThemeSel . '/theme.php');
    // Those variables are depreciated and won't be available in a later version
    $bgcolor1 = $ThemeInfo['bgcolor1'];
    $bgcolor2 = $ThemeInfo['bgcolor2'];
    $bgcolor3 = $ThemeInfo['bgcolor3'];
    $bgcolor4 = $ThemeInfo['bgcolor4'];
    $textcolor1 = $ThemeInfo['textcolor1'];
    $textcolor2 = $ThemeInfo['textcolor2'];
}

function define_once($constant, $value) {
    if(!defined($constant)) {
        define($constant, $value);
    }
}

function is_admin($trash=0, $godadmin=0) {
    global $userinfo, $aid;

    $admincookie = evo_getcookie('admin');
    if (empty($admincookie)) {
        return $adminstatus = FALSE;
    }
    $admincookie = explode(':', $admincookie);
    $aid = $admincookie[0];
    $pwd = $admincookie[1];
    if (!empty($aid) && !empty($pwd)) {
        if (!function_exists('get_admin_field')) {
            global $db;
            $row = $db->sql_ufetchrow("SELECT `pwd`, `aid`, `name`, `radminsuper` FROM `" . _AUTHOR_TABLE."` WHERE `aid` = '".$aid. "'");
        } else {
            $row = get_admin_field('*', $aid);
        }
        if ( (($row['pwd'] == $pwd) && !empty($pwd)) && ($aid == $row['aid'] && !empty($aid)) ) {
            if ($godadmin != 0) {
                if ($row['name'] == 'God') {
                    return $godadminstatus = TRUE;
                } else {
                    return $godadminstatus = FALSE;
                }
            } else {
                return $adminstatus = TRUE;
            }
        }
    }
    if ($godadmin == 0) {
        return $adminstatus = FALSE;
    } else {
        return $godadminstatus = FALSE;
    }
}

function is_god_admin($trash=0) {
    return is_admin(0,1);
}


function is_user($trash=0) {
    $userstatus = cookiedecode();
    return $userstatus;
}

function title($text, $modulename='', $logo='') {
    OpenTable();
    if (!empty($logo) && !empty($modulename)) {
            echo "<div style='text-align: center;'><img src='".evo_image($logo, $modulename)."' title='".$modulename."' alt='' border='0' /><br /><br /></div>\n";
    }
    echo '<div class="title" style="text-align: center; font-weight: bold;">'.$text.'</div>';
    CloseTable();
    echo '<br />';
}

function is_active($module) {
    global $db, $cache;
    static $active_modules;
    if (is_array($active_modules)) {
        return(isset($active_modules[$module]) ? 1 : 0);
    }
    if ((($active_modules = $cache->load('active_modules', 'config')) === false) || empty($active_modules)) {
        $active_modules = array();
        $result = $db->sql_query('SELECT `title` FROM `'._MODULES_TABLE.'` WHERE `active`="1"');
        while(list($title) = $db->sql_fetchrow($result, SQL_NUM)) {
            $active_modules[$title] = 1;
        }
        $db->sql_freeresult($result);
        $cache->save('active_modules', 'config', $active_modules);
    }
    return (isset($active_modules[$module]) ? 1 : 0);
}

function render_blocks($side, $block) {
    global $evoconfig, $plus_minus_images, $lang_block, $lang;
    define_once('BLOCK_FILE', true);
    $blocktemptitle = str_replace('.php', '', $block['blockfile']);
    if ( !empty($lang_block[$blocktemptitle])) {
        $block['title'] = $lang_block[$blocktemptitle];
    }
    if($evoconfig['collapse']) {
        if (!$evoconfig['collapsetype']) {
            if ($evoconfig['collapse_start']) {
                $image = $plus_minus_images['minus'];
                $name = 'minus';
            } else {
                $image = $plus_minus_images['plus'];
                $name = 'plus';
            }
            $block['title'] = $block['title'] . "&nbsp;&nbsp;&nbsp;<img src=\"".$image."\" class=\"showstate\" name=\"".$name."block".($block['bid'])."\" width=\"9\" height=\"9\" onclick=\"expandcontent(this, 'block".$block['bid']."')\" alt=\"\" style=\"cursor: pointer;\" />";
        } else {
            $block['title'] = "<a href=\"javascript:expandcontent(this, 'block".$block['bid']."')\">".$block['title']."</a>";
        }
        $style = '';
        if (!$evoconfig['collapse_start']) {
            $style = 'style="display: none;"';
        }
        $block['content'] = "<div id='block".$block['bid']."' class='switchcontent' $style>".$block['content']."</div>";
    }
    if (empty($block['url'])) {
        if (empty($block['blockfile'])) {
            if ($side == 'c' || $side == 'd') {
                themecenterbox($block['title'], set_smilies(decode_bbcode(stripslashes($block['content']), 1, true)));
            } else {
                themesidebox($block['title'], set_smilies(decode_bbcode(stripslashes($block['content']), 1, true)), $block['bid']);
            }
        } else {
            blockfileinc($block['title'], $block['blockfile'], $side, $block['bid']);
        }
    } else {
        headlines($block['bid'], $side, $block);
    }
}

function blocks_visible($side) {
    global $showblocks;

    //If in the admin show l blocks
    if (defined('ADMIN_FILE') && (!isset($showblocks) || $showblocks == NULL)) {
        return true;
    }
    $showblocks = ($showblocks == null) ? 3 : $showblocks;

    $side = strtolower($side[0]);

    //If there are no blocks for this module && not admin file
    if (!$showblocks && !defined('ADMIN_FILE')) return false;

    //If set to 3 its all blocks
    if ($showblocks == 3) return true;

    //Count the blocks on the side
    $blocks = blocks($side, true);

    //If there are no blocks
    if (!$blocks) {
        return false;
    }

    //Check for blocks to show
    if (($showblocks == 1 && $side == 'l') || ($showblocks == 2 && $side == 'r')) {
        return true;
    }

    return false;
}

function blocks($side, $count=false) {
    global $db, $evoconfig, $userinfo, $cache, $currentlang, $lang_block, $lang;
    static $blocks;

    //Include the block lang files
    if (@file_exists(NUKE_LANGUAGE_DIR.'blocks/lang-'.$currentlang.'.php')) {
        include_once(NUKE_LANGUAGE_DIR.'blocks/lang-'.$currentlang.'.php');
    } else {
        include_once(NUKE_LANGUAGE_DIR.'blocks/lang-english.php');
    }
    $querylang = ($evoconfig['multilingual']) ? 'AND (`blanguage`="'.$currentlang.'" OR `blanguage`="")' : '';
    $side = strtolower($side[0]);
    if((($blocks = $cache->load('blocks', 'config')) === false) || !isset($blocks)) {
        $sql = 'SELECT * FROM `'._BLOCKS_TABLE.'` WHERE `active`="1" '.$querylang.' ORDER BY `weight` ASC';
        $result = $db->sql_query($sql);
        while($row = $db->sql_fetchrow($result, SQL_ASSOC)) {
            $blocks[$row['bposition']][] = $row;
        }
        $db->sql_freeresult($result);
        $cache->save('blocks', 'config', $blocks);
    }
    if ($count) {
        return (!empty($blocks[$side]) ? count($blocks[$side]) : 0);
    }
    $blockrow = (!empty($blocks[$side])) ? $blocks[$side] : array();
    for($i=0,$j = count($blockrow); $i < $j; $i++) {
        $bid = intval($blockrow[$i]['bid']);
        $view = $blockrow[$i]['view'];
        if(isset($blockrow[$i]['expire'])) {
            $expire = intval($blockrow[$i]['expire']);
        } else {
            $expire = '';
        }
        if(isset($blockrow[$i]['action'])) {
            $action = $blockrow[$i]['action'];
            $action = substr($action, 0,1);
        } else {
            $action = '';
        }
        $now = time();
        if ($expire != 0 AND $expire <= $now) {
            if ($action == 'd') {
                $db->sql_uquery('UPDATE `'._BLOCKS_TABLE.'` SET `active`="0", `expire`="0" WHERE `bid`="'.$bid.'"');
                $cache->delete('blocks', 'config');
                return;
            } elseif ($action == 'r') {
                $db->sql_uquery('DELETE FROM `'._BLOCKS_TABLE.'` WHERE `bid`="'.$bid.'"');
                $cache->delete('blocks', 'config');
                return;
            }
        }
        if (empty($blockrow[$i]['bkey'])) {
            if ( ($view == '0' || $view == '1') ||
               ( ($view == '3' AND is_user()) ) ||
               ( $view == '4' AND is_admin()) ||
               ( ($view == '2' AND !is_user())) ) {
                render_blocks($side, $blockrow[$i]);
            } else {
                if (substr($view, strlen($view)-1) == '-') {
                    $ingroups = explode('-', $view);
                    if (is_array($ingroups)) {
                        foreach ($ingroups as $group) {
                            if (isset($userinfo['groups'][($group)])) {
                                render_blocks($side, $blockrow[$i]);
                            }
                        }
                    }
                }
            }
        }
    }
    return;
}

function blockfileinc($blockfiletitle, $blockfile, $side=1, $bid) {
    global $evoconfig, $currentlang, $lang_block, $lang;

    if (!@file_exists(NUKE_BLOCKS_DIR.$blockfile)) {
        $content = $lang_block['BLOCK_NO_CONTENT'];
    } else {
        include(NUKE_BLOCKS_DIR.$blockfile);
    }
    if (empty($content)) {
        $content = $lang_block['BLOCK_NO_CONTENT'];
    }
    $style = '';
    if (!$evoconfig['collapse_start']) {
        $style = 'style="display: none;"';
    }
    if($evoconfig['collapse']) {
        $content = "<div id='block".$bid."' class='switchcontent' $style>".$content."</div>";
    }
    if ($side == 'r' || $side == 'l') {
        themesidebox($blockfiletitle, $content, $bid);
    } else {
        themecenterbox($blockfiletitle, $content);
    }
}

function rss_content($url) {
    if (!evo_site_up($url)) return false;
    require_once(NUKE_CLASSES_DIR.'class.simplepie.php');
    $content = '';
    $feed = new SimplePie();
    $feed->set_feed_url($url);
    $feed->init();
    $feed->handle_content_type();
    foreach($feed->get_items() as $item) {
        $feed = $item->get_feed();
        $site_link = $item->get_permalink();
        $content .= '<strong><big>&middot;</big></strong> <a href="'.$site_link.'" target="new" >'.$item->get_title().'</a><br />'."\n";
    }
    if ($feed->error) {
            $content .= "<br /><a href=\"$url\" target=\"_blank\"><strong>"._HREADMORE.'</strong></a>';
    }
    return $content;
}

function headlines($bid, $side=0, $row='') {
    global $db, $evoconfig, $cache, $_GETVAR;

    $bid = intval($bid);
    if (!is_array($row)) {
        $row = $db->sql_ufetchrow('SELECT `title`, `content`, `url`, `refresh`, `time` FROM `'._BLOCKS_TABLE.'` WHERE `bid`='.$bid, SQL_ASSOC);
    }
    $content = trim($row['content']);
    if ($row['time'] < (time()-$row['refresh']) || empty($content)) {
        $content = rss_content($row['url']);
        $btime = time();
        $db->sql_uquery('UPDATE `'._BLOCKS_TABLE.'` SET `content`="'.$_GETVAR->fixQuotes($content).'", `time`="'.$btime.'" WHERE `bid`="'.$bid.'"');
        $cache->delete('blocks', 'config');
    }
    if (empty($content)) {
        $content = _RSSPROBLEM.' ('.$row['title'].')';
    }
    if ($side == 'c' || $side == 'd') {
        themecenterbox($row['title'], $content);
    } else {
        themesidebox($row['title'], $content, $bid);
    }
}


// Adds slashes to string and strips PHP+HTML for SQL insertion and hack prevention
// $str: the string to modify
// $nohtml: strip PHP+HTML tags, false=no, true=yes, default=false
function Fix_Quotes($str, $nohtml=false) {
    //If there is not supposed to be HTML
    if ($nohtml) $str = strip_tags($str);
    return $str;
}

function Remove_Slashes($str) {
    global $_GETVAR;
    return $_GETVAR->stripSlashes($str);
}

// check_words function by ReOrGaNiSaTiOn
function check_words($message) {
    global $evoconfig;
    if(empty($message)) {
        return '';
    }
    if(empty($evoconfig['censor_words'])) {
        return $message;
    }
    $orig_word = array();
    $replacement_word = array();
    foreach( $evoconfig['censor_words'] as $word => $replacement ) {
        $orig_word[] = '#' . str_replace('\*', '\w*?', preg_quote($word, '#')) . '#i';
        $replacement_word[] = $replacement;
    }
    $return_message = @preg_replace($orig_word, $replacement_word, $message);
    return $return_message;
}

function check_html($str, $strip='') {
    static $classloaded, $html, $html_filter;

    if(defined('INPUT_FILTER')) {
        if ($classloaded) {
            $str = $html_filter->process($str);
        } else {
            if ($strip == 'nohtml') {
                global $AllowableHTML;
            }
            if (!is_array($AllowableHTML)) {
                $html = '';
            } else {
                $html = '';
                foreach($AllowableHTML as $type => $key) {
                     if($key == 1) {
                       $html[] = $type;
                     }
                }
            }
            include_once(NUKE_INCLUDE_DIR.'classes/class.inputfilter.php');
            $html_filter = new InputFilter($html, "", 0, 0, 1);
            $str = $html_filter->process($str);
            $classloaded = TRUE;
        }
    } else {
        $str = Fix_Quotes($str, !empty($strip));
    }
    return $str;
}

function filter_text($Message, $strip='') {
    $Message = check_words($Message);
    $Message = check_html($Message, $strip);
    return $Message;
}

function convert_slashes($converttext) {
    $converttext = preg_replace('#\'#', '&#39;', $converttext);
    $converttext = preg_replace('#\"#', '&quot;', $converttext);
    return $converttext;
}

// actualTime function by ReOrGaNiSaTiOn
function actualTime() {
  $date = date('Y-m-d H:i:s');
  $actualTime_tempdate = formatTimestamp($date, $format='Y-m-d H:i:s');
  return $actualTime_tempdate;
}

function actualTimeServer() {
  $date = date('Y-m-d H:i:s');
  return $date;
}

// formatTimestamp function by ReOrGaNiSaTiOn
function formatTimestamp($time=0, $format='', $dateonly='') {
    global $datetime, $evoconfig, $userinfo, $board_config;
    if ($time == 0) {return '00-00-00';}
    if (empty($format)) {
        if (isset($userinfo['user_dateformat']) && !empty($userinfo['user_dateformat'])) {
            $format = $userinfo['user_dateformat'];
        } else if (isset($board_config['default_dateformat']) && !empty($board_config['default_dateformat'])) {
            $format = $board_config['default_dateformat'];
        } else {
            $format = 'D M d, Y g:i a';
        }
    }
    if (!empty($dateonly)) {
        $replaces = array('a', 'A', 'B', 'c', 'D', 'g', 'G', 'h', 'H', 'i', 'I', 'O', 'r', 's', 'U', 'Z', ':');
        $format = str_replace($replaces, '', $format);
        $format = str_replace('D', 'd', $format);
    }
    if ((isset($userinfo['user_timezone']) && !empty($userinfo['user_timezone'])) && $userinfo['user_id'] != 1) {
        $tz = $userinfo['user_timezone'];
    } else if (isset($board_config['board_timezone']) && !empty($board_config['board_timezone'])) {
        $tz = $board_config['board_timezone'];
    } else {
        $tz = '10';
    }
    setlocale(LC_TIME, $evoconfig['locale']);
    if (!is_numeric($time)) {
        preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
        $time = gmmktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
    }
    $datetime = EvoDate($format, $time, $tz);
    return $datetime;
}

function get_microtime() {
    list($usec, $sec) = explode(' ', microtime());
    return ($usec + $sec);
}

function get_author($aid) {
    global $db;
    static $get_authorusers;

    if (!is_array($get_authorusers)) {
        $get_authorusers = array();
    }
    if (isset($get_authorusers[$aid])) {
        $row = $get_authorusers[$aid];
    } else {
        $row = get_admin_field('*', $aid);
        $get_authorusers[$aid] = $row;
    }
    $userid = get_user_field('user_id', $aid, TRUE);
    if (isset($userid[0])) {
        $aid = "<a href=\"modules.php?name=Profile&amp;mode=viewprofile&amp;u=".$userid[0]."\">".UsernameColor($aid)."</a>";
    } else if (isset($row['url']) && $row['url'] != 'http://') {
        $aid = "<a href=\"".$row['url']."\">".UsernameColor($aid)."</a>";
    } else {
        $aid = UsernameColor($aid);
    }
    return $aid;
}

if(!function_exists('themepreview')) {
    function themepreview($title, $hometext, $bodytext='', $notes='') {
        echo '<strong>'.$title.'</strong><br /><br />'.$hometext;
        if (!empty($bodytext)) {
            echo '<br /><br />'.$bodytext;
        }
        if (!empty($notes)) {
            echo '<br /><br /><strong>'._NOTE.'</strong> <em>'.$notes.'</em>';
        }
    }
}

if(!function_exists('themecenterbox')) {
    function themecenterbox($title, $content) {
        OpenTable();
        echo '<center><span class="option"><strong>'.$title.'</strong></span></center><br />'.$content;
        CloseTable();
        echo '<br />';
    }
}

function ads($position) {
    global $db, $evoconfig;
    if(!$evoconfig['banners']) { return ''; }
    $position = intval($position);
    $result = $db->sql_query('SELECT * FROM `'._BANNER_TABLE.'` WHERE `position`="'.$position.'" AND `active`="1" ORDER BY RAND() LIMIT 0,1');
    $numrows = $db->sql_numrows($result);
    if ($numrows < 1) return '';
    $row = $db->sql_fetchrow($result, SQL_ASSOC);
    $db->sql_freeresult($result);
    foreach($row as $var => $value) {
        if (isset($$var)) unset($$var);
        $$var = $value;
    }
    $bid = intval($bid);
    if(!is_admin()) {
        $db->sql_uquery('UPDATE `'._BANNER_TABLE.'` SET `impmade`=' . intval($impmade) . '+1 WHERE `bid`='.intval($bid));
    }
    $sql2 = 'SELECT `cid`, `imptotal`, `impmade`, `clicks`, `date`, `ad_class`, `ad_code`, `ad_width`, `ad_height` FROM (`'._BANNER_TABLE.'`) WHERE `bid`='.intval($bid).'';
    $result2 = $db->sql_query($sql2);
    list($cid, $imptotal, $impmade, $clicks, $date, $ad_class, $ad_code, $ad_width, $ad_height) = $db->sql_fetchrow($result2, SQL_NUM);
    $db->sql_freeresult($result2);
    $cid = intval($cid);
    $imptotal = intval($imptotal);
    $impmade = intval($impmade);
    $clicks = intval($clicks);
    /* Check if this impression is the last one and print the banner */
    if (($imptotal <= $impmade) && ($imptotal != 0)) {
        $db->sql_uquery('UPDATE `'._BANNER_TABLE.'` SET `active`="0" WHERE `bid`='.intval($bid).'');
        $sql3 = 'SELECT `name`, `contact`, `email` FROM (`'._BANNER_CLIENT_TABLE.'`) WHERE `cid`='.intval($cid).'';
        $result3 = $db->sql_query($sql3);
        list($c_name, $c_contact, $c_email) = $db->sql_fetchrow($result3, SQL_NUM);
        $db->sql_freeresult($result3);
        if (!empty($c_email)) {
            $message = _HELLO." $c_contact:\n\n";
            $message .= _THISISAUTOMATED."\n\n";
            $message .= _THERESULTS."\n\n";
            $message .= _TOTALIMPRESSIONS." $imptotal\n";
            $message .= _CLICKSRECEIVED." $clicks\n";
            $message .= _IMAGEURL." $imageurl\n";
            $message .= _CLICKURL." $clickurl\n";
            $message .= _ALTERNATETEXT." $alttext\n\n";
            $message .= _HOPEYOULIKED."\n\n";
            $message .= _THANKSUPPORT."\n\n";
            $message .= "- ".EVO_SERVER_SITENAME." "._TEAM."\n";
            $message .= EVO_SERVER_URL;
            $subject = EVO_SERVER_SITENAME.': '._BANNERSFINNISHED;
            $to      = $c_email.','.$c_contact;
            $return  = evo_mail($to, $subject, $message);
        }
    }
    if ($ad_class == 'code') {
        $ad_code = stripslashes($ad_code);
        $ads = "<center>$ad_code</center>";
    } elseif ($ad_class == 'flash') {
        $ads = "<center>"
              ."<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\" width=\"".$ad_width."\" height=\"".$ad_height."\" id=\"$bid\">"
              ."<param name=\"movie\" value=\"".$imageurl."\" />"
              ."<param name=\"quality\" value=\"high\" />"
              ."<embed src=\"".$imageurl."\" quality=\"high\" width=\"".$ad_width."\" height=\"".$ad_height."\" name=\"".$bid."\" align=\"\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"></embed></object>"
              ."</center>";
    } else {
        $ads = "<center><a href=\"index.php?op=ad_click&amp;bid=$bid\" target=\"_blank\"><img src=\"$imageurl\" width=\"".$ad_width."\" height=\"".$ad_height."\" border=\"0\" alt=\"$alttext\" title=\"$alttext\" /></a></center>";
    }
    return $ads;
}

function makePass() {
    $cons = 'bcdfghjklmnpqrstvwxyz';
    $vocs = 'aeiou';
    for ($x=0; $x < 6; $x++) {
        mt_srand ((double) microtime() * 1000000);
        $con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
        $voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
    }
    mt_srand((double)microtime()*1000000);
    $num1 = mt_rand(0, 9);
    $num2 = mt_rand(0, 9);
    $makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];
    return $makepass;
}

// Function to translate Datestrings
function translate($phrase) {
    switch($phrase) {
        case'xdatestring': $tmp='%A, %B %d @ %T %Z'; break;
        case'linksdatestring': $tmp='%d-%b-%Y'; break;
        case'xdatestring2': $tmp='%A, %B %d'; break;
        default: $tmp=$phrase; break;
    }
    return $tmp;
}

function removecrlf($str) {
    return strtr($str, '\015\012', ' ');
}

function validate_mail($email) {
    if(strlen($email) < 7 || !preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/', $email)) {
        DisplayError(_ERRORINVEMAIL);
        return false;
    } else {
        return $email;
    }
}

include_once(NUKE_INCLUDE_DIR.'nbbcode.php');

function get_plus_minus_image () {
    $image['plus'] = evo_image('plus.png', 'blocks');
    $image['minus'] = evo_image('minus.png', 'blocks');
    return $image;
}
$plus_minus_images = get_plus_minus_image();

function setTimezoneByOffset($offset) {
   $testTimestamp = time();
   date_default_timezone_set('UTC');
   $testLocaltime = localtime($testTimestamp,true);
   $testHour = $testLocaltime['tm_hour'];
   $abbrarray = timezone_abbreviations_list();
   foreach ($abbrarray as $abbr) {
        foreach ($abbr as $city) {
            date_default_timezone_set($city['timezone_id']);
            $testLocaltime     = localtime($testTimestamp,true);
            $hour                     = $testLocaltime['tm_hour'];
            $testOffset =  $hour - $testHour;
            if($testOffset == $offset) {
                return true;
            }
        }
    }
    return false;
}

referer();

?>