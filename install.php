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
 Nuke-Evo Author        :   ReOrGaNiSaTiOn

 Copyright (c) 2010 by The Nuke-Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS 'NOT' ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE 'NOT' ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if(!isset($_SESSION)) { session_start(); }

@set_time_limit(300);
$rel_path=array();
$rel_path['file']   = str_replace('\\', "/", @realpath(dirname(__FILE__)));
$server_ary         = @pathinfo(@realpath($_SERVER['PHP_SELF']));
$rel_path['server'] = $server_ary['dirname'];
$rel_path['uri']    = @realpath($_SERVER['REQUEST_URI']);
$script_abs_path    = @pathinfo(@realpath($_SERVER['SCRIPT_FILENAME']));
$rel_path['script'] = $script_abs_path['dirname'];
if ( ($rel_path['file'] == $script_abs_path['dirname']) && (strlen($_SERVER['DOCUMENT_ROOT']) < strlen($script_abs_path['dirname'])) ) {
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
    $href_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $rel_path['file'] );
}
define('NUKE_BASE_DIR', dirname(__FILE__).'/');
define('NUKE_HREF_PATH', $href_path);
define('NUKE_INSTALL_DIR', NUKE_BASE_DIR.'install/');
define('NUKE_INSTALL_INC_DIR', NUKE_BASE_DIR.'install/includes/');
define('NUKE_DATA_DIR', NUKE_INSTALL_DIR.'data/');
define('NUKE_INCLUDE_DIR', NUKE_BASE_DIR.'includes/');
define('NUKE_LANGUAGE_DIR', NUKE_INSTALL_DIR.'language/');
define('NUKE_THEMES_DIR', NUKE_BASE_DIR.'themes/');
define('NUKE_THEMES_IMAGE_DIR', 'themes/');
define('NUKE_EVO', true);
define('IN_PHPBB', true);
if (version_compare(phpversion(), '5.1.0', '>=')) {
    define('EVO_KERNEL_TZ_DEFAULT', @date_default_timezone_get());
    if (!ini_get('date.timezone')) {
        date_default_timezone_set(EVO_KERNEL_TZ_DEFAULT);
    }
}

require_once(NUKE_INSTALL_INC_DIR.'functions.php');
require_once(NUKE_INCLUDE_DIR.'functions_selects.php');
require_once(NUKE_INCLUDE_DIR.'classes/class.identify.php');
require_once(NUKE_INCLUDE_DIR.'classes/class.variables.php');
require_once(NUKE_BASE_DIR.'themes/chromo/theme.php');

$var_install = array();
$InstallConfig = array();
$theme_name = 'chromo';
$InstallConfig['max_step'] = 9;
$InstallConfig['min_step'] = 0;
global $_GETVAR, $InstallConfig, $currentlang, $lang_install, $theme_name, $InstallStatus, $ThemeInfo;

$step       = $_GETVAR->get('step', '_REQUEST', 'int', 0, $InstallConfig['min_step'], $InstallConfig['max_step']);
$mode       = $_GETVAR->get('mode', '_REQUEST', 'string', '');
$newlang    = $_GETVAR->get('newlang', '_POST', 'string', '');
$dbsetup    = $_GETVAR->get('dbsetup', '_POST', 'int', 0);
$tablesetup = $_GETVAR->get('tablesetup', '_POST', 'int', 0);
$basesetup  = $_GETVAR->get('basesetup', '_POST', 'int', 0);
$adminsetup = $_GETVAR->get('adminsetup', '_POST', 'int', 0);
$addition   = $_GETVAR->get('addition', '_GET', 'int', 0);
$informationsetup = $_GETVAR->get('informationsetup', '_POST', 'int', 0);

if ( $mode == 'restart' ) {
    $step = 0;
}

evo_read_cookie();
if ( isset($newlang) && !empty($newlang) && $step==0) {
    $currentlang = $InstallConfig['language'] = $newlang;
}

if ( $step !=0 ) {
    if ($InstallConfig['dbconnect'] == 1) {
        require_once(NUKE_INCLUDE_DIR.'db/config.php');
        require_once(NUKE_INCLUDE_DIR.'db/'.$InstallConfig['dbtype'].'.php');
        $db = new sql_db($dbhost, $dbuname, $dbpass, $dbname, false);
    }
    if ( $InstallConfig['Installfailed'] == 1 ) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'install/error.html';
        $InstallConfig = array();
        evo_setcookie($InstallConfig);
        header("Location: http://$host$uri/$extra");
        exit();
    }
    if ($dbsetup == 1 ) {
        $InstallConfig['dbhost']  = $_GETVAR->get('dbhost', '_POST', 'string');
        $InstallConfig['dbname']  = $_GETVAR->get('dbname', '_POST', 'string');
        $InstallConfig['dbuname'] = $_GETVAR->get('dbuname', '_POST', 'string');
        $InstallConfig['dbpass']  = $_GETVAR->get('dbpass', '_POST', 'string');
        $InstallConfig['dbtype']  = $_GETVAR->get('dbtype', '_POST', 'string');
        $InstallConfig['configprefix'] = $_GETVAR->get('configprefix', '_POST', 'string');
        $InstallConfig['userprefix'] = $_GETVAR->get('userprefix', '_POST', 'string');
        $InstallConfig['diffuserprefix'] = $_GETVAR->get('diffuserprefix', '_POST', 'int', 0);
        $InstallConfig['dbprefix'] = $InstallConfig['configprefix'];
        $InstallConfig['dbtab']   = $_GETVAR->get('dbtab', '_POST', 'int', 0);
        $InstallConfig['dbconnect']   = $_GETVAR->get('dbconnect', '_POST', 'int', 0);
        $InstallConfig['deletequest'] = $_GETVAR->get('deletequest', '_POST', 'int', 0);
        $InstallConfig['updatequest'] = $_GETVAR->get('updatequest', '_POST', 'int', 0);
        $InstallConfig['convertquest'] = $_GETVAR->get('convertquest', '_POST', 'int', 0);
        $InstallConfig['dbconvert'] = $_GETVAR->get('dbconvert', '_POST', 'int', 0);
        $InstallConfig['update'] = $_GETVAR->get('update', '_POST', 'int', 0);
        $InstallConfig['dbsetup'] = $dbsetup;
        if ($InstallConfig['diffuserprefix'] == 1) {
            $InstallConfig['Installfailed'] = 1;
        }
    }
    if ( $InstallConfig['dbconnect'] == 1) {
        $InstallConfig['tablesetup'] = $_GETVAR->get('tablesetup', '_GET', 'int', 0);
    }
    if ($basesetup == 1) {
        $InstallConfig['base_sitename']     = deepStrip($_GETVAR->get('base_sitename', '_POST', 'string'));
        $InstallConfig['base_description']  = deepStrip($_GETVAR->get('base_description', '_POST', 'string'));
        $InstallConfig['base_url']          = $_GETVAR->get('base_url', '_POST', 'string');
        $InstallConfig['base_server_port']  = $_GETVAR->get('base_server_port', '_POST', 'int', 80);
        $InstallConfig['base_cookie_domain']= $_GETVAR->get('base_cookie_domain', '_POST', 'string');
        $InstallConfig['base_cookie_path']  = $_GETVAR->get('base_cookie_path', '_POST', 'string');
        $InstallConfig['base_cookie_name']  = $_GETVAR->get('base_cookie_name', '_POST', 'string');
        $InstallConfig['base_board_email']  = $_GETVAR->get('base_board_email', '_POST', 'string');
        $InstallConfig['base_board_email_sig']      = $_GETVAR->get('base_board_email_sig', '_POST', 'string');
        $InstallConfig['base_board_default_lang']   = $_GETVAR->get('base_board_default_lang', '_POST', 'string');
        $InstallConfig['base_board_dateformat']     = $_GETVAR->get('base_board_dateformat', '_POST', 'string');
        $InstallConfig['base_board_startdate_date'] = $_GETVAR->get('base_board_startdate_date', '_POST', 'int');
        $InstallConfig['base_board_startdate_day']  = $_GETVAR->get('base_board_startdate_day', '_POST', 'int', 1, 1, 31);
        $InstallConfig['base_board_startdate_month']= $_GETVAR->get('base_board_startdate_month', '_POST', 'int', 1, 1, 12);
        $InstallConfig['base_board_startdate_year'] = $_GETVAR->get('base_board_startdate_year', '_POST', 'int', 1970, 1970, 2099);
        $InstallConfig['base_board_timezone']       = $_GETVAR->get('base_board_timezone', '_POST', 'int', 0, -12, 12);
        $InstallConfig['basesetup'] = $basesetup;
    }
    if ($adminsetup == 1) {
        $InstallConfig['admin_name']     = $_GETVAR->get('admin_name', '_POST', 'string');
        $InstallConfig['admin_homepage'] = $_GETVAR->get('admin_homepage', '_POST', 'string');
        $InstallConfig['admin_email']    = $_GETVAR->get('admin_email', '_POST', 'string');
        $InstallConfig['admin_password'] = $_GETVAR->get('admin_password', '_POST', 'string');
        $InstallConfig['admin_password2']= $_GETVAR->get('admin_password2', '_POST', 'string');
        $InstallConfig['admin_md5_password']= $_GETVAR->get('md5_password', '_POST', 'string');
        $InstallConfig['admin_lang']     = $_GETVAR->get('admin_lang', '_POST', 'string');
        $InstallConfig['admin_create_user']  = $_GETVAR->get('admin_create_user', '_POST', 'int', 0);
        $InstallConfig['adminsetup'] = $adminsetup;
    }
    if ($informationsetup == 1) {
        $InstallConfig['informationsetup'] = $informationsetup;
    }
    $InstallConfig['old_step'] = ( ($step-1) <= $InstallConfig['min_step']) ? 0 : $step - 1 ;
    $InstallConfig['Step_'.$InstallConfig['old_step']] = 1;
    $InstallConfig['step'] = $step;
    $InstallConfig['next_step'] = $InstallConfig['step'] + 1;
    evo_setcookie($InstallConfig);
    if ( $InstallConfig['Installfailed'] == 1 ) {
            header('Location: install.php');
    }
} else {
    $InstallConfig = initialize_installer();
    if ( $newlang ) {
        $InstallConfig['language'] = $currentlang;
    }
}

require_once(NUKE_LANGUAGE_DIR.'lang_'.$InstallConfig['language'].'/variables.php');
include(NUKE_LANGUAGE_DIR.'lang_'.$InstallConfig['language'].'/lang-main.php');
if ($step == 0 || !$step ) {
    log_write($lang_install['Installation_started']);
}
if ( $step > 3 && $InstallConfig['dbconnect'] != 1) {
    header('Location: install.php?mode=restart&step=0');
}

if ($addition > 0) {
    include(NUKE_INSTALL_DIR . 'step'.$step.'_'.$addition.'.php');
} else {
    include(NUKE_INSTALL_DIR . 'step'.$step.'.php');
}
install_footer();
?>