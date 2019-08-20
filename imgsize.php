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


require_once(dirname(__FILE__).'/mainfile.php');

global $_GETVAR, $currentlang, $board_config;

$module_name = 'Downloads';
$lang_path = NUKE_MODULES_DIR . $module_name . '/language/';
if (@file_exists($lang_path . 'lang-' . $currentlang . '.php')) {
    @include_once($lang_path . 'lang-' . $currentlang . '.php');
} elseif (@file_exists($lang_path . 'lang-' . $board_config['default_lang'] . '.php')) {
    @include_once($lang_path . 'lang-' . $board_config['default_lang'] . '.php');
} else {
    DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $module_name);
}

function error_message($text = ''){
        $img = imagecreatetruecolor(strlen($text) * 7, 20); 
        imagefill($img, 0, 0, imagecolorallocate($img, 255, 255, 255)); 
        imagestring($img, 2, 0, 0, $text, imagecolorallocate($img, 0, 0, 0)); 
        imagepng($img); 
        imagedestroy($img); 
}

$img_src    = $_GETVAR->get('src', '_GET', 'string');
$img_p      = $_GETVAR->get('p', '_GET', 'int');
$img_w      = $_GETVAR->get('w', '_GET', 'int');
$img_h      = $_GETVAR->get('h', '_GET', 'int');


if (empty($img_src)) {
    error_message($lang_new[$module_name]['ERROR_IMGSIZE_NOPATH']); 
}

$image_infos = @getimagesize($img_src) or error_message($lang_new[$module_name]['ERROR_IMGSIZE_NOACCESS']);
$width  = $image_infos[0];
$height = $image_infos[1];
$type   = $image_infos[2];
$mime   = $image_infos['mime'];
$thumb  = '';


if (isset($img_p) && !isset($img_w) && !isset($img_h)){ 
    if($width < $height) { 
        $new_width  = ceil(($img_p / $height) * $width);
        $new_height = intval($img_p); 
    } else {
        $new_height = ceil(($img_p / $width) * $height);
        $new_width = intval($img_p); 
    }
} else if (isset($img_w) && !isset($img_h) && !isset($img_p)){ 
    if ($width < $img_w){
        $new_width = intval($width);
        $new_height = ceil($height * $new_width / $width);
    } else {
        $new_width = intval($img_w); 
        $new_height = ceil($height * $new_width / $width); 
    }
} else if (isset($img_h) && !isset($img_w) && !isset($img_p)){ 
    $new_height = intval($img_h); 
    $new_width = ceil($width * $new_height / $height); 
} else if (isset($img_h) && isset($img_w) && isset($img_p)){
    $new_height = intval($img_h); 
    $new_width = intval($img_w); 
} else {
    error_message($lang_new[$module_name]['ERROR_IMGSIZE_NO_HEIGHT_OR_WIDTH']); 
}

switch ($type){
    case 1:
        header('Content-type: '.$mime); 
        if (imagetypes() & IMG_GIF){ 
            $thumb = ImageCreate($new_width,$new_height);
            $original = ImageCreateFromGif($img_src);
            $transcol=imagecolortransparent($original);
            imagepalettecopy($thumb,$original);
            imagefill($thumb,0,0,$transcol);
            ImageCopyResized($thumb,$original,0,0,0,0,$new_width, $new_height, $width, $height);
            imagecolortransparent($thumb,$transcol);
            imageinterlace($thumb,1);
            imagegif($thumb);
        } else {
            error_message($lang_new[$module_name]['ERROR_IMGSIZE_NO_GIF_IMG']); 
        }
        break;
    case 2:
        header('Content-type: '.$mime); 
        if (imagetypes() & IMG_JPG){ 
            $orginal = ImageCreateFromJpeg($img_src) or error_message($lang_new[$module_name]['ERROR_IMGSIZE_NOACCESS']);
            $thumb = imagecreatetruecolor($new_width, $new_height); 
            imagecopyresampled($thumb, $orginal, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($thumb); 
        } else {
            error_message($lang_new[$module_name]['ERROR_IMGSIZE_NO_JPEG_IMG']); 
        }
        break;
    case 3:
        header('Content-type: '.$mime); 
        if (imagetypes() & IMG_PNG){         
            $original = imagecreatefrompng($img_src) or error_message($lang_new[$module_name]['ERROR_IMGSIZE_NOACCESS']); 
            $thumb    = imagecreatetruecolor($new_width, $new_height); 
            imageAlphaBlending($thumb, false);
            imageSaveAlpha($thumb, true);
            imagecopyresampled($thumb, $original, 0, 0, 0, 0, $new_width, $new_height, $width, $height); 
            imagepng($thumb); 
        } else {    
            error_message($lang_new[$module_name]['ERROR_IMGSIZE_NO_PNG_IMG']);        
        }
        break;
    default:
        error_message($lang_new[$module_name]['ERROR_IMGSIZE_NO_SUPPORTED_MIME']); 
}

if (!empty($thumb)){
    imagedestroy($thumb);
}
?>