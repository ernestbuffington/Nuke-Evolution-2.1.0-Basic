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
define('NO_DISABLE', true);
define('IN_CAPTCHA', true);

define('ROOT', dirname(dirname(__FILE__)) . '/');
require_once(ROOT.'mainfile.php');
//error_reporting(0);
require_once(NUKE_CLASSES_DIR.'class.php-captcha.php');
define('FONTS', NUKE_INCLUDE_DIR.'fonts/');

global $_GETVAR;
$size   = $_GETVAR->get('size', '_GET', 'string', 'normal');
$file   = $_GETVAR->get('file', '_GET', 'string', '');
$module = $_GETVAR->get('mod', '_GET', 'string', '');

$aFonts = array();

if ($handle = @opendir(FONTS)) {
    while (FALSE !== ($fontsfile = @readdir($handle))) {
        if ($fontsfile != "." && $fontsfile != "..") {
            $aFonts[] = FONTS.$fontsfile;
        }
    }
}


switch ($size) {
    case 'normal':
        $width = 140;
        $height = 60;
        $length = 5;
    break;
    case 'large':
        $width = 200;
        $height = 60;
        $length = 6;
    break;
    case 'small':
        $width = 100;
        $height = 30;
        $length = 4;
    break;
    default:
        $width = 140;
        $height = 60;
        $length = 5;
    break;
}

//Look for invalid crap
if (preg_match("/[^\w_\-]/i",$file)) {
    die();
}

if (!is_array($aFonts)) {
    die('Fonts Not Found');
}
global $evoconfig;
$oVisualCaptcha = new PhpCaptcha($aFonts, $width, $height, $module);
$oVisualCaptcha->SetNumChars($length);
if ($size != 'small') {
    $oVisualCaptcha->SetOwnerText(str_replace('http://', '', EVO_SERVER_URL));
}
if (!empty($file) && $file != 'default') {
    $gfx_bg = evo_image($file.'.jpg', 'captcha');
    $gfx_bg = NUKE_BASE_DIR . str_replace(NUKE_HREF_BASE_DIR, '', $gfx_bg);
    if (@file_exists($gfx_bg)) {
        $oVisualCaptcha->SetBackgroundImages($gfx_bg);
    } else {
        $gfx_bg = '';
        $oVisualCaptcha->SetBackgroundImages($gfx_bg);
    }
} else if (!empty($evoconfig['capfile']) && ($file != 'default')) {
    $gfx_bg = evo_image($evoconfig['capfile'].'.jpg', 'captcha');
    $gfx_bg = NUKE_BASE_DIR . str_replace(NUKE_HREF_BASE_DIR, '', $gfx_bg);
    if (@file_exists($gfx_bg)) {
        $oVisualCaptcha->SetBackgroundImages($gfx_bg);
    } else {
        $gfx_bg = '';
        $oVisualCaptcha->SetBackgroundImages($gfx_bg);
    }
} else {
    $gfx_bg = '';
    $oVisualCaptcha->SetBackgroundImages($gfx_bg);
}

$oVisualCaptcha->Create();

?>