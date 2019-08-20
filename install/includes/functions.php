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

if (!defined('NUKE_EVO')) {
   die('You can\'t access this file directly...');
}

function install_header($goback=0, $gonext=0) {
    global $lang_install, $theme_name, $currentlang, $ThemeInfo, $InstallConfig, $var_install;

    $ThemeInfo['link1'] = 'install.php?mode=restart';
    $ThemeInfo['link1text'] = $lang_install['Restart'];
    if (($InstallConfig['step'] > $InstallConfig['min_step']) && $goback > 0) {
        $ThemeInfo['link2'] = 'install.php?step='.$InstallConfig['old_step'];
        $ThemeInfo['link2text'] = $lang_install['Back'];
    }
    if (($InstallConfig['next_step'] < $InstallConfig['max_step']) && $gonext > 0) {
        $ThemeInfo['link3'] = 'install.php?step='.$InstallConfig['next_step'];
        $ThemeInfo['link3text'] = $lang_install['Next'];
    }
    $ThemeInfo['link4'] = 'javascript:wiki_help()';
    $ThemeInfo['link4text'] = $lang_install['Help'];
    ob_start();
    ob_implicit_flush(0);
    include_once(NUKE_INCLUDE_DIR . 'mimetype.php');
    if (file_exists(NUKE_BASE_DIR.'themes/chromo/images/favicon.ico')) {
        $head .= "<link rel=\"shortcut icon\" href=\"themes/chromo/images/favicon.ico\" type=\"image/x-icon\" />\n";
    }
    $head .= "<link rel=\"stylesheet\" href=\"themes/chromo/style/style.css\" type=\"text/css\" />\n";
    echo $head;
    include_stylesheet('includes/javascript/sexyscript/sexyalertbox.css');
    include_stylesheet('includes/javascript/sexyscript/sexytooltips/blue.css');
    $head = "<title>".html_entity_decode($var_install['version'])." ".html_entity_decode($lang_install['Head_Title'])."</title>\n";
    $head .= "<style type=\"text/css\">\n";
    $head .= ".texterror {\n";
    $head .= "font-weight: bold;\n";
    $head .= "color: #FF0000;\n";
    $head .= "font-size: large;\n";
    $head .= "}\n";
    $head .= "</style>\n";
    $head .= "<script type=\"text/javascript\">\n";
    $head .= "<!--\n";
    $head .= "function wiki_help() {\n";
    $head .= "  window.open (\"http://wiki.evo-german.com/index.php?title=Installation\",\"Wiki\",\"toolbar=yes,location=no,directories=no,status=no,scrollbars=yes,resizable=yes,copyhistory=no\");\n";
    $head .= "}\n";
    $head .= "//-->\n";
    $head .= "</script>\n\n";
    $head .= "<script type=\"text/javascript\" src=\"includes/overlib.js\"></script>\n";
    echo $head;
    include_javascript(NUKE_INCLUDE_DIR.'javascript/jquery.min.js');
    include_javascript(NUKE_INCLUDE_DIR .'slimbox/slimbox.js');
    include_javascript(NUKE_INCLUDE_DIR.'javascript/jquery.easing.1.3.js');
    include_javascript(NUKE_INCLUDE_DIR.'javascript/sexyscript/sexyalertbox.v1.2.jquery.js');
    echo "</head>\n";
    themeheader();
    return;
}

function include_javascript($dirfile, $addition='') {
    echo "<script ".$addition." type='text/javascript'>\n";
    echo "/*<![CDATA[*/\n";
    include_once($dirfile);
    echo "\n/*]]>*/\n";
    echo "</script>\n\n";
    return;
}

function include_stylesheet($dirfile, $addition='') {
    static $cssfiles;

    if (!is_array($cssfiles)) {
        $cssfiles = array();
    }
    if (!isset($cssfile[$dirfile]) && !empty($dirfile)) {
        echo '<link rel="stylesheet" type="text/css" href="'.$dirfile.'" />';
    }
    return;
}

function evo_help_img($helptext, $title='', $click=0, $tool='tooltip', $width='300', $style='info', $sticky=0, $hook=0, $mode='tl'){
    static $href_id = 1;

    if ($click  == 1) {
        $sticky = 1;
        $hook   = 0;
    }
    $href_id++;

    if (!empty($title)){
        $title = limit_words($title, 4);
    } else {
        $title = 'Info';
    }

    return "<a onclick='return false' href='#' id='evotooltips".$href_id."'><img src='images/evo/helpicon.png' border='0' height='12' width='12' alt='' title='' /></a>
    <script type='text/javascript'>
        /*<![CDATA[*/
        $(document).ready(function(){
        $('#evotooltips".$href_id."').".$tool." ('<h1>".$title."</h1><p>".$helptext."</p>', {
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

function blocks($waste='') {
    global $lang_install, $InstallStatus, $InstallConfig;
    $Installmenue = '<table width="100%">';
    for ($i = $InstallConfig['min_step']; $i < $InstallConfig['max_step']; $i++) {
        if ( $InstallConfig['Step_'.$i] == 1 && $InstallConfig['Step_'.$i.'_'.'_error'] == 2) {
            $Installmenue .= '<tr><td><img src="install/images/checked.png" height="20" width="20" alt="" />'.$lang_install['Block_Step_'.$i].'</td></tr>';
        } elseif ( $InstallConfig['Step_'.$i.'_'.'_error'] == 1 )  {
            $Installmenue .= '<tr><td><img src="install/images/failed.png" height="20" width="20" alt="" />'.$lang_install['Block_Step_'.$i].'</td></tr>';
        } else {
            $Installmenue .= '<tr><td><img src="install/images/unchecked.png" height="20" width="20" alt="" />'.$lang_install['Block_Step_'.$i].'</td></tr>';
        }
    }
    $Installmenue .= '</table>';
    themesidebox($lang_install['Block_Title'], $Installmenue, 1);
}

function blocks_visible($waste='') {

    return (($waste=='left') ? true : false);
}


function install_footer() {
    themefooter();
    echo "</body></html>";
    ob_end_flush();
    exit;
}

function initialize_installer() {
    $InstallConfig = array();
    $InstallConfig['max_step'] = 9;
    $InstallConfig['min_step'] = 0;
    $InstallConfig['language'] = detect_lang();
    $InstallConfig['ip'] = identify::get_ip();
    $InstallConfig['step'] = 0;
    $InstallConfig['old_step'] = 0;
    $InstallConfig['next_step'] = 1;
    evo_setcookie($InstallConfig);
    return $InstallConfig;
}

function log_write($logline, $logdata='', $sqlerror='') {
    global $InstallConfig, $lang_install;
    $logtime = @date("d M Y - H:i:s");
    $sqlmessage = '';
    if ( @is_array($logdata) ) {
        foreach( $logdata as $key => $value) {
            $sqlmessage .= $key.': '.$value.' ';
        }
    }
    $writeline = $lang_install['Date'].': '.$logtime . '-----'.$lang_install['Log_Message'].': '.$logline.' '.$sqlmessage.' '.$sqlerror;
    $writeline .= "\n";
    if($handle = @fopen(NUKE_INSTALL_DIR.'log/install.log','a')) {
        @fwrite($handle, $writeline);
        @fclose($handle);
    }
    return;
}

function evo_setcookie($evocookie) {
    global $InstallConfig;
    $evo_cookie_domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
    $evo_cookie_path = '';
    if ( empty($evocookie) ) {
        return FALSE;
    } else {
        $evo_value = '';
        foreach($evocookie as $key => $value ) {
            $evo_value .= $key.'|'.$value.':';
        }
        $evo_value = substr($evo_value, 0, -1);
        $evo_cookie_value = base64_encode($evo_value);
    }
    $evo_cookie_name   = 'evoinstaller';
    $evo_cookie_maxage = time() + 43200;
    @setcookie($evo_cookie_name, $evo_cookie_value, $evo_cookie_maxage, $evo_cookie_path, $evo_cookie_domain);
    return TRUE; // It isn't really true that the cookie is set, but we have passed all parameters - that's true
}

function evo_read_cookie() {
    global $InstallConfig;
    $tmpValue = base64_decode($_COOKIE['evoinstaller']);
    $tmpValue = explode(':', $tmpValue);
    foreach ($tmpValue as $tmpstring) {
        $tempValue3 = explode('|', $tmpstring);
        $InstallConfig[$tempValue3[0]] = $tempValue3[1];
    }
}

function detect_lang() {
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
    $http_accept_language = (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : getenv('HTTP_ACCEPT_LANGUAGE');
    $accepted_languages = @explode(',', strtolower($http_accept_language));
    foreach ($accepted_languages as $browser_lang) {
        $langcode = ($browser_lang[2] == '-') ? substr($browser_lang, 0, 5) : substr($browser_lang, 0, 2);
        $tmplang = $browserlang[$langcode];
        if ( @file_exists(NUKE_LANGUAGE_DIR.'lang_'.$tmplang.'/lang-main.php') ) {
            if (!defined('_LANGCODE')) {
                define('_LANGCODE', $langcode);
            }
            return $tmplang;
        }
    }
    if (!defined('_LANGCODE')) {
        define('_LANGCODE', 'en');
    }
    return 'english';
}

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

function get_microtime() {
    list($usec, $sec) = @explode(' ', microtime());
    return ($usec + $sec);
}

function lang_list() {
    $handle = @opendir(NUKE_BASE_DIR . 'language');
    while (false !== ($file = @readdir($handle))) {
        if (@preg_match('/lang-(.*?)\.php/i', $file, $lang)) {
            $languages[] = $lang[1];
        }
    }
    @closedir($handle);
    @sort($languages);
    return $languages;
}

// The following codelines must be, because some of the inclusions needs them
if(!function_exists('is_admin')) {
	function is_admin($trash=0) {
	    // Because we are in Install-Mode, we are not only Admin, we are God-Admin !!
	    return $adminstatus = 1;
	}
}

if(!function_exists('LoadThemeInfo')) {
    function LoadThemeInfo() {
        return;
    }
}

if(!function_exists('ads')) {
    function ads() {
        return;
    }
}

if(!function_exists('blocks_visible')) {
    function blocks_visible() {
        return false;
    }
}

if(!function_exists('footmsg')) {
    function footmsg() {
        return;
    }
}

function get_fileinfo($file) {
    if (function_exists('posix_getuid')) {
        $ben_uid = posix_getuid();
        $ben_gid = posix_getgid();
        $ben_uinfo = posix_getpwuid(intval($ben_uid));
        $ben_ginfo = posix_getgrgid(intval($ben_gid));
        $datei['run_user']  = $ben_uinfo['name'];
        $datei['run_group'] = $ben_ginfo['name'];
    } else {
        $ben_uid = @getmyuid();
        $ben_gid = @getmygid();
        $ben_uinfo = @get_current_user();
        $datei['run_user']  = $ben_uinfo['name'];
    }        
    $datei['file']  = realpath($file);
    if (file_exists($datei['file'])) {
        $datei['exists']= TRUE;
        $datei_owner = fileowner($datei['file']);
        $datei_group = filegroup($datei['file']);
        if (function_exists('posix_getuid')) {
            $datei_owner1= posix_getpwuid(intval($datei_owner));
            $datei_group1= posix_getgrgid(intval($datei_group));
            $datei['is_owner']   = (($ben_uid == $datei_owner) ? TRUE : FALSE);
            $datei['is_group']   = (($ben_gid == $datei_group) ? TRUE : FALSE);
        } else {
            $datei['is_owner']   = (($ben_uid == $datei_owner) ? TRUE : FALSE);
            $datei['is_group']   = (($ben_gid == $datei_group) ? TRUE : FALSE);
        }
        $datei['owner']      = $datei_owner;
        $datei['group']      = $datei_group;
        $datei['writeable']  = (is_writeable($datei['file']) ? TRUE : FALSE);
        $datei['executable'] = (is_executable($datei['file']) ? TRUE : FALSE);
        $datei['readable']   = (is_readable($datei['file']) ? TRUE : FALSE);
        $datei['is_dir']     = (is_dir($datei['file']) ? TRUE : FALSE);
        $datei['is_file']    = (is_file($datei['file']) ? TRUE : FALSE);
    } else {
        $datei['exists']= FALSE;
    }
    return $datei;
}
?>