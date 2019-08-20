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

if (!defined('NUKE_EVO')) {
    die("You can't access this file directly...");
}

global $evoconfig, $cache, $_GETVAR, $currentlang;

// This data was taken from Dragonfly CMS
// http://www.dragonflycms.org
$browserlang = array(
    'af' => 'afrikaans', // ISO-8859-1
    'sq' => 'albanian',  // ISO-8859-1
    'ar' => 'arabic',   // 1256
    'ar-dz' => 'arabic', // algeria
    'ar-bh' => 'arabic', // bahrain
    'ar-eg' => 'arabic', // egypt
    'ar-iq' => 'arabic', // iraq
    'ar-jo' => 'arabic', // jordan
    'ar-kw' => 'arabic', // kuwait
    'ar-lb' => 'arabic', // lebanon
    'ar-ly' => 'arabic', // libya
    'ar-ma' => 'arabic', // morocco
    'ar-om' => 'arabic', // oman
    'ar-qa' => 'arabic', // qatar
    'ar-sa' => 'arabic', // Saudi Arabia
    'ar-sy' => 'arabic', // syria
    'ar-tn' => 'arabic', // tunisia
    'ar-ae' => 'arabic', // U.A.E
    'ar-ye' => 'arabic', // yemen
    'hy' => 'armenian',
    'ast' => 'asturian',
    'eu' => 'basque',
    'be' => 'belarusian',
    'bs' => 'bosanski',//bosnian -bosanski is nuke lang name
    'bg' => 'bulgarian',
    'ca' => 'catalan',
    'zh' => 'chinese',
    'zh-cn' => 'chinese', // China
    'zh-hk' => 'chinese', // Hong Kong
    'zh-sg' => 'chinese', // Singapore
    'zh-tw' => 'chinese', // Taiwan
    'hr' => 'croatian',   // 1250
    'cs' => 'czech',
    'da' => 'danish',   // ISO-8859-1
    'dcc' => 'desi',    // Deccan, India
    'nl' => 'dutch',    // ISO-8859-1
    'nl-be' => 'dutch', // Belgium
    'en' => 'english',
    'en-au' => 'english', // Australia
    'en-bz' => 'english', // Belize
    'en-ca' => 'english', // Canada
    'en-ie' => 'english', // Ireland
    'en-jm' => 'english', // Jamaica
    'en-nz' => 'english', // New Zealand
    'en-ph' => 'english', // Philippines
    'en-za' => 'english', // South Africa
    'en-tt' => 'english', // Trinidad
    'en-gb' => 'english', // United Kingdom
    'en-us' => 'english', // United States
    'en-zw' => 'english', // Zimbabwe
    'eo' => 'esperanto',
    'et' => 'estonian',
    'eu' => 'euraska',   // ISO-8859-1
    'fo' => 'faeroese',
    'fi' => 'finnish',   // ISO-8859-1
    'fr' => 'french',   // ISO-8859-1
    'fr-be' => 'french', // Belgium
    'fr-ca' => 'french', // Canada
    'fr-fr' => 'french', // France
    'fr-lu' => 'french', // Luxembourg
    'fr-mc' => 'french', // Monaco
    'fr-ch' => 'french', // Switzerland
    'gl' => 'galego', //galician- galego is nuke lang name // ISO-8859-1
    'ka' => 'georgian',
    'de' => 'german',   // ISO-8859-1
    'de-at' => 'german', // Austria
    'de-de' => 'german', // Germany
    'de-li' => 'german', // Liechtenstein
    'de-lu' => 'german', // Luxembourg
    'de-ch' => 'german', // Switzerland
    'el' => 'greek',      // ISO-8859-7
    'he' => 'hebrew',
    'hu' => 'hungarian',  // ISO-8859-2
    'is' => 'icelandic',  // ISO-8859-1
    'id' => 'indonesian', // ISO-8859-1
    'ga' => 'irish',
    'it' => 'italian',  // ISO-8859-1
    'it-ch' => 'italian', // Switzerland
    'ja' => 'japanese',
    'ko' => 'korean',
    'ko-kp' => 'korean', // North Korea
    'ko-kr' => 'korean', // South Korea
    'ku' => 'kurdish',    // 1254
    'lv' => 'latvian',
    'lt' => 'lithuanian',   // 1257
    'mk' => 'macedonian',   // 1251
    'ms' => 'malayu',
    'no' => 'norwegian',    // ISO-8859-1
    'nb' => 'norwegian',    // bokmal
    'nn' => 'norwegian',    // nynorsk
    'pl' => 'polish',      // ISO-8859-2
    'pt' => 'portuguese',   // 28591, Latin-I, iso-8859-1
    'pt-br' => 'brazilian', // Brazil
    'ro' => 'romanian',  // 28592, Central Europe, iso-8859-2
    'ru' => 'russian',    // 1251 ANSI
    'gd' => 'scots gealic',
    'sr' => 'serbian',
    'sk' => 'slovak',      // 1250 ANSI
    'sl' => 'slovenian',    // 28592, Central Europe, iso-8859-2
    'es' => 'spanish',    // 28591, Latin-I, iso-8859-1
    'es-ar' => 'spanish',   // Argentina
    'es-bo' => 'spanish', // Bolivia
    'es-cl' => 'spanish', // Chile
    'es-co' => 'spanish', // Colombia
    'es-cr' => 'spanish', // Costa Rica
    'es-do' => 'spanish', // Dominican Republic
    'es-ec' => 'spanish', // Ecuador
    'es-sv' => 'spanish', // El Salvador
    'es-gt' => 'spanish', // Guatemala
    'es-hn' => 'spanish', // Honduras
    'es-mx' => 'spanish', // Mexico
    'es-ni' => 'spanish', // Nicaragua
    'es-pa' => 'spanish', // Panama
    'es-py' => 'spanish', // Paraguay
    'es-pe' => 'spanish', // Peru
    'es-pr' => 'spanish', // Puerto Rico
    'es-es' => 'castellano', // Spain
    'es-uy' => 'spanish', // Uruguay
    'es-ve' => 'spanish', // Venezuela
    'sv' => 'swedish',
    'sv-fi' => 'swedish',   // Finland
    'sw' => 'swahili',    // Kenya and Tanzania
    'th' => 'thai',      // 874
    'tr' => 'turkish',    // 1254
    'ug' => 'uighur',      // ISO-8859-1, 28591 Turkish, Uzbek, China
    'uk' => 'ukrainian',
    'vi' => 'vietnamese',
    'cy' => 'welsh',
    'xh' => 'xhosa',
    'yi' => 'yiddish',
    'zu' => 'zulu'
);

//To resolve getting the random capital letters ie (English)
$currentlang = strtolower($evoconfig['language']);
$newlang     = $_GETVAR->get('newlang', '_REQUEST', 'string', '');
$cookielang  = evo_getcookie('user_language');

if ($evoconfig['multilingual']) {
    if (!empty($newlang) && is_lang($newlang)) {
        $currentlang = $newlang;
    } elseif (!empty($cookielang) && is_lang($cookielang)) {
        $currentlang = $cookielang;
    } else {
        $currentlang = detect_lang($browserlang);
        $evoconfig['language'] = $currentlang;
    }
    if (!is_lang($currentlang)) {
        $currentlang = 'english';
    }
    evo_setcookie('user_language', $currentlang, 0);
} else {
    if (empty($currentlang)) {
        $currentlang = 'english';
        $evoconfig['language'] = 'english';
    }
    evo_setcookie('user_language', $evoconfig['language'], 0);
}

$evoconfig['language'] = $currentlang;
$userinfo['user_lang'] = $currentlang;

define('_LANGCODE', array_search($currentlang, $browserlang));
unset($browserlang);

include_lang($currentlang);

function is_lang($language) {
    $maincheck = @file_exists(NUKE_LANGUAGE_DIR.'lang-'.$language.'.php');
    $admncheck = @file_exists(NUKE_ADMIN_DIR.'language/lang_'.$language.'/lang_admin.php');
    if($maincheck && $admncheck) {
        return true;
    }
    return false;
}

function include_lang($language) {
    static $loaded;
    
    if (!is_array($loaded)) {
        $loaded = array();
        include_once(NUKE_LANGUAGE_DIR.'lang-'.$language.'.php');
        include_once(NUKE_LANGUAGE_CUSTOM_DIR.'lang-'.$language.'.php');
    }
    $loaded[$language] = TRUE;
}

function detect_lang($browserlang) {
    $http_accept_language = (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : getenv('HTTP_ACCEPT_LANGUAGE');
    $accepted_languages = explode(',', strtolower($http_accept_language));
    foreach ($accepted_languages as $browser_lang) {
        $langcode = ($browser_lang[2] == '-') ? substr($browser_lang, 0, 5) : substr($browser_lang, 0, 2);
        $tmplang = $browserlang[$langcode];
        if (is_lang($tmplang)) {
            return $tmplang;
        }
    }
    return false;
}

function get_lang($module) {
    global $currentlang, $language, $lang_new;
    static $included;
    if(!isset($included)) {
        $included = array();
    } elseif (isset($included[$module][$currentlang])) {
        return true;
    }
    if (@file_exists(NUKE_MODULES_DIR.$module.'/language/lang-'.$currentlang.'.php')) {
        $path = NUKE_MODULES_DIR.$module.'/language/lang-'.$currentlang.'.php';
    } elseif (@file_exists(NUKE_MODULES_DIR.$module.'/language/lang-'.$language.'.php')) {
        $path = NUKE_MODULES_DIR.$module.'/language/lang-'.$language.'.php';
    } elseif (@file_exists(NUKE_MODULES_DIR.$module.'/language/lang-english.php')) {
        $path = NUKE_MODULES_DIR.$module.'/language/lang-english.php';
    } else {
        return $included[$module][$currentlang] = false;
    }
    require($path);
    return $included[$module][$currentlang] = true;
}

function get_blocklang($blockname) {
    global $currentlang, $language, $lang_block;
    static $blockincluded;
    if(!isset($blockincluded)) {
        $blockincluded = array();
    } elseif (isset($blockincluded[$blockname][$currentlang])) {
        return true;
    }
    if (@file_exists(NUKE_LANGUAGE_DIR.'blocks/language/lang_'.$currentlang.'/lang-'.$blockname.'.php')) {
        $path = NUKE_LANGUAGE_DIR.'blocks/language/lang_'.$currentlang.'/lang-'.$blockname.'.php';
    } elseif (@file_exists(NUKE_LANGUAGE_DIR.'blocks/language/lang_'.$language.'/lang-'.$blockname.'.php')) {
        $path = NUKE_LANGUAGE_DIR.'blocks/language/lang_'.$language.'/lang-'.$blockname.'.php';
    } elseif (@file_exists(NUKE_LANGUAGE_DIR.'blocks/language/lang_english/lang-'.$blockname.'.php')) {
        $path = NUKE_LANGUAGE_DIR.'blocks/language/lang_english/lang-'.$blockname.'.php';
    } else {
        return $blockincluded[$blockname][$currentlang] = false;
    }
    require($path);
    return $blockincluded[$blockname][$currentlang] = true;
}
function lang_list() {
    static $languages;
    if (!isset($languages)) {
        $handle = opendir(NUKE_LANGUAGE_DIR);
        while (false !== ($file = readdir($handle))) {
            if (preg_match('/lang-(.*?)\.php/i', $file, $lang)) {
                $languages[] = $lang[1];
            }
        }
        closedir($handle);
        sort($languages);
    }
    return $languages;
}

?>