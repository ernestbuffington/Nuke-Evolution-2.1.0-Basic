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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

include_once(dirname(dirname((__FILE__))).'/mainfile.php');

global $evoconfig, $textcolor1, $bgcolor1, $ThemeSel;

function random_code($number) {
    $out = '';
    $letters = range('a', 'z');
    for ($i=0; $i < $number; $i++) {
        mt_srand(crc32(microtime()));
        $num = mt_rand(0,1);
        if ($num) {
            //Number 1 - 9
            $out .= mt_rand(1, 9);
        } else {
            $out .= $letters[mt_rand(0, 25)];
        }
    }
    return $out;
}

if(GDSUPPORT) {
    $useimage = intval($evoconfig['useimage']);
    $fontsize = 5;
    $ttf = false;
    if ($evoconfig['codefont']) {
        $codefont = stripslashes($evoconfig['codefont']);
        $font = NUKE_INCLUDE_DIR.'fonts/'.$codefont.'.ttf';
        $ttf = (function_exists('imagettftext') && file_exists($font));
        $ttfsize = $fontsize*2;
    }

    $code = random_code($evoconfig['codesize']);

    if ($ttf) {
        $border = imagettfbbox($ttfsize, 0, $font, $code);
        $width = $border[2]-$border[0];
    } else {
        $width = strlen($code)*(4+$fontsize);
    }

    if ($useimage) {
        $code_bg = evo_image('code_bg.png', '');
        $image = ImageCreateFromJPEG('themes/' . $ThemeSel . '/images/code_bg.jpg');
        if (!isset($gfxcolor)) {
            $gfxcolor = '#505050';
        }

    } else {

        if (!isset($gfxcolor)) {
            $txtclr = $textcolor1;
        }
        $bgclr  = $bgcolor1;

        $bred   = hexdec(substr($bgclr, 1, 2));
        $bgreen = hexdec(substr($bgclr, 3, 2));
        $bblue  = hexdec(substr($bgclr, -2));

        $image = ImageCreate($width+6,20);
        $background_color = ImageColorAllocate($image, $bred, $bgreen, $bblue);
        ImageFill($image, 0, 0, $background_color);

    }

    $tred   = hexdec(substr($gfxcolor, 1, 2));
    $tgreen = hexdec(substr($gfxcolor, 3, 2));
    $tblue  = hexdec(substr($gfxcolor, -2));

    $left = (imagesx($image)-$width)/2;

    if (function_exists('imagecolorallocatealpha')) {
        $txt_color = imagecolorallocatealpha($image, $tred, $tgreen, $tblue, 50);
        if ($ttf) {
            imagettftext($image, $ttfsize, 0, $left+1, 16, $txt_color, $font, $code);
        } else {
            ImageString($image, $fontsize, $left+2, 3, $code, $txt_color);
        }
    }

    if ($ttf) {
        imagettftext($image, $ttfsize, 0, $left, 15, ImageColorAllocate($image, $tred, $tgreen, $tblue), $font, $code);
    } else {
        ImageString($image, $fontsize, $left, 2, $code, ImageColorAllocate($image, $tred, $tgreen, $tblue));
    }
//    session_start();
    if(isset($_SESSION['GFXCHECK'])) unset($_SESSION['GFXCHECK']);
    $_SESSION['GFXCHECK'] = $code;
    Header('Content-type: image/png');
    ImagePNG($image);
    ImageDestroy($image);
    exit;
}

?>