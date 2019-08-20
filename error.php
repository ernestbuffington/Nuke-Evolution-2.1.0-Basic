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

require_once(dirname(__FILE__) . '/mainfile.php');

global $currentlang, $db, $nsnst_const, $_GETVAR; 

$module_name = 'error';
if(@file_exists(NUKE_LANGUAGE_DIR.$module_name.'/lang-'.$currentlang.'.php')) {
    include(NUKE_LANGUAGE_DIR.$module_name.'/lang-'.$currentlang.'.php');
} else {
    include(NUKE_LANGUAGE_DIR.$module_name.'/lang-english.php');
}

$error = $_GETVAR->get('error', '_GET', 'int');

//query the database for the configuration settings
$result = $db->sql_query("SELECT log_errors, show_image, modulblocks, show_info_saved, totalerrors FROM "._ERROR_CONFIG_TABLE);
list($log_errors, $show_image, $modulblocks, $show_info_saved, $totalerrors) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

$showblocks = $modulblocks;

if ($log_errors == 1) {
        $time           = actualTime();
        $referer        = ($nsnst_const['referer'] != 'none') ? $nsnst_const['referer'] : $nsnst_const['user_agent'];
        $ip_address     = ($nsnst_const['client_ip'] != 'none') ? $nsnst_const['client_ip'] : $nsnst_const['remote_ip'] ;
        // Build the current URL
        $servername     = $nsnst_const['http_host'];
        $serverport     = $nsnst_const['remote_port'];
        $current_url    = $_GETVAR->get('REQUEST_URI', '_SERVER', 'string', '');
        $error_url      = "http://".$servername.":".$serverport."".$current_url;
        $db->sql_uquery("INSERT INTO "._ERROR_TABLE." values ('', '$error', '$time', '$ip_address', '$referer', '$error_url')");
        //add 1 to the counter of total errors
        $totalerrors = $totalerrors + 1;
        $db->sql_uquery("UPDATE "._ERROR_CONFIG_TABLE." SET totalerrors='$totalerrors'");
}
// lets build the error page!

switch ($error) {
    case (203): $pagetitle = $lang_new[$module_name]['EM203']; $type = 1; $type = 0; break;
    case (204): $pagetitle = $lang_new[$module_name]['EM204']; $type = 1; break;
    case (205): $pagetitle = $lang_new[$module_name]['EM205']; $type = 1; break;
    case (300): $pagetitle = $lang_new[$module_name]['EM300']; $type = 1; break;
    case (301): $pagetitle = $lang_new[$module_name]['EM301']; $type = 1; break;
    case (302): $pagetitle = $lang_new[$module_name]['EM302']; $type = 1; break;
    case (303): $pagetitle = $lang_new[$module_name]['EM303']; $type = 1; break;
    case (304): $pagetitle = $lang_new[$module_name]['EM304']; $type = 3; break;
    case (400): $pagetitle = $lang_new[$module_name]['EM400']; $type = 2; break;
    case (401): $pagetitle = $lang_new[$module_name]['EM401']; $type = 3; break;
    case (402): $pagetitle = $lang_new[$module_name]['EM402']; $type = 3; break;
    case (403): $pagetitle = $lang_new[$module_name]['EM403']; $type = 3; break;
    case (404): $pagetitle = $lang_new[$module_name]['EM404']; $type = 2; break;
    case (405): $pagetitle = $lang_new[$module_name]['EM405']; $type = 0; break;
    case (406): $pagetitle = $lang_new[$module_name]['EM406']; $type = 1; break;
    case (407): $pagetitle = $lang_new[$module_name]['EM407']; $type = 1; break;
    case (408): $pagetitle = $lang_new[$module_name]['EM408']; $type = 2; break;
    case (409): $pagetitle = $lang_new[$module_name]['EM409']; $type = 2; break;
    case (410): $pagetitle = $lang_new[$module_name]['EM410']; $type = 1; break;
    case (411): $pagetitle = $lang_new[$module_name]['EM411']; $type = 0; break;
    case (412): $pagetitle = $lang_new[$module_name]['EM412']; $type = 1; break;
    case (413): $pagetitle = $lang_new[$module_name]['EM413']; $type = 1; break;
    case (414): $pagetitle = $lang_new[$module_name]['EM414']; $type = 3; break;
    case (415): $pagetitle = $lang_new[$module_name]['EM415']; $type = 2; break;
    case (500): $pagetitle = $lang_new[$module_name]['EM500']; $type = 1; break;
    case (502): $pagetitle = $lang_new[$module_name]['EM502']; $type = 1; break;
    case (503): $pagetitle = $lang_new[$module_name]['EM503']; $type = 1; break;
    case (504): $pagetitle = $lang_new[$module_name]['EM504']; $type = 1; break;
    case (505): $pagetitle = $lang_new[$module_name]['EM505']; $type = 3; break;
    default   : $pagetitle = $lang_new[$module_name]['EMUNKNOWN']; $type = 4; break;
}

switch ($type) {
    case(0): $img_error = 'stop.png'; break;
    case(1): $img_error = 'attention.png'; break;
    case(2): $img_error = 'question.png'; break;
    case(3): $img_error = 'forbidden.png'; break;
    case(4): $img_error = 'unknown.png'; break;
    default: $img_error = 'unknown.png'; break;
}    
$to_echo = '<center><strong>'.$pagetitle.'</strong></center>';
$pagetitle = '- '.$pagetitle;

include_once(NUKE_BASE_DIR.'header.php');

OpenTable();

echo $to_echo . "<br />";

if ($show_image == 1) {
    echo '<div align="center"><img src="'.evo_image($img_error, 'error').'" alt="" title="" />';
}

echo '<br />[<a href="'.EVO_SERVER_URL.'/index.php">'.$lang_new[$module_name]['EMHOME'].'</a>]<br /><br />';
echo $lang_new[$module_name]['EMSORRY'].'&nbsp;'. EVO_SERVER_SITENAME .'&nbsp;!</div><br />';

if ($log_errors == 1) {
    if ($show_info_saved == 1) {
        echo '<div align="center">'.$lang_new[$module_name]['EMRECDATA'].'</div><br />';
        echo "<dl class=\"twocolumn\"><dt class=\"twocolumn\">".$lang_new[$module_name]['EMDATETIME']." : </dt><dd class=\"twocolumn\">$time</dd>";
        echo "<dt class=\"twocolumn\">".$lang_new[$module_name]['EMSORT']." : </dt><dd class=\"twocolumn\">$error</dd>";
        echo "<dt class=\"twocolumn\">".$lang_new[$module_name]['EMIP']." : </dt><dd class=\"twocolumn\">$ip_address</dd>";
        echo "<dt class=\"twocolumn\">".$lang_new[$module_name]['EMREF']." : </dt><dd class=\"twocolumn\">$referer</dd>";
        echo "<dt class=\"twocolumn\">".$lang_new[$module_name]['EMURL']." : </dt><dd class=\"twocolumn\">$error_url</dd></dl><div class=\"clear-left\"></div>";
    }
}
CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');
die();
?>