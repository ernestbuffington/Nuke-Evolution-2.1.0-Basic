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

define('HOME_FILE', true);
define('MODULE_FILE', true);
$_SERVER['PHP_SELF'] = 'modules.php';

require_once(dirname(__FILE__).'/mainfile.php');

/*--ARCADE MOD--*/

global $db, $evoconfig, $admin_file, $_GETVAR;

$bid        = $_GETVAR->get('bid', 'request', 'int', NULL);
$file       = $_GETVAR->get('file', 'REQUEST', 'string', 'index');
$mod_file   = $_GETVAR->get('mod_file', 'REQUEST', 'string', 'index');
$modpath    = $_GETVAR->get('modpath', 'REQUEST');
$mop        = $_GETVAR->get('mop', 'REQUEST', 'string', 'modload');
$op         = $_GETVAR->get('op', 'request', 'string', NULL);
$url        = $_GETVAR->get('url', 'request', 'string', NULL);

if ( $op ) {
    if( ($op == 'ad_click') && $bid ) {
        list($clickurl) = $db->sql_ufetchrow("SELECT `clickurl` FROM `"._BANNER_TABLE."` WHERE `bid`=" . $bid, SQL_NUM);
        if( (!is_admin() || ($_GETVAR->get('SCRIPT_NAME', 'server', 'string', NULL) != '/admin' )) ) {
           $db->sql_query("UPDATE `"._BANNER_TABLE."` SET `clicks`=clicks+1 WHERE `bid`=" . $bid);
        }
        redirect($clickurl);
    } elseif( $op == 'gfx') {
        include_once(NUKE_INCLUDE_DIR.'gfxchk.php');
    } else {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ILLEGAL_OP_OPERATION, 2);
        exit;
    }
}

if (is_admin() && isset($url) && !empty($url)) {
    redirect($url);
}

$module_name = main_module();
if((!is_user() && !is_admin()) && ($evoconfig['lock_modules'] && $module_name != 'Your_Account')) {
    include(NUKE_MODULES_DIR.'Your_Account/index.php');
}


if (stristr($file,"..") || stristr($mod_file,"..") || stristr($mop,"..")) {
    log_write('error', _ERROR_LOG_WRONG_MODUL_PATH, _ERROR_LOG_HACK_ATTEMPT);
    die("You are so cool...");
} else {
    $modpath = NUKE_MODULES_DIR.$evoconfig['modules'][$module_name]['title'].'/'.$file.'.php';
    if (@file_exists($modpath)) {
        $showblocks = $evoconfig['modules'][$module_name]['blocks'];
        unset($module, $error);
        require($modpath);
    } else {
        DisplayError((is_admin()) ? "<strong>"._HOMEPROBLEM."</strong><br /><br />[ <a href=\"".$admin_file.".php?op=modules\">"._ADDAHOME."</a> ]" : _HOMEPROBLEMUSER);
    }
}

?>