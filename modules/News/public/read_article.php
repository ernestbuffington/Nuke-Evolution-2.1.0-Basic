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

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

global $userinfo, $_GETVAR;

$module_name = basename(dirname(dirname(__FILE__)));
get_lang($module_name);

$sid    =   $_GETVAR->get('sid', '_REQUEST', 'int');
$tid    =   $_GETVAR->get('tid', '_REQUEST', 'int');
$mode   =   $_GETVAR->get('mode', '_REQUEST');

if (!isset($sid) && !isset($tid)) {
    redirect('index.php');
}

// Counting has to be done because read_article do not call header.php
@include_once(NUKE_INCLUDE_DIR.'counter.php');

if ($mode == 'Reply') {
    redirect("modules.php?name=$module_name&amp;op=comments&amp;op=Reply&amp;pid=0&amp;sid=$sid&amp;mode=$mode&amp;order=$order&amp;thold=$thold");
}

$artinfo    = ModuleNews_GetDBRow('`sid`="'.$sid.'"', $display);
$datetime   = formatTimeStamp($artinfo['time'], '', 1);
$pagetitle = '- '.$artinfo['title'];
$simple_header = TRUE;
define('LOADER', 'TRUE');
require(NUKE_BASE_DIR.'header.php');
head();
echo "\n<body lang='"._LANGCODE."'>\n";
if (function_exists('themearticle')) {
    themearticle($artinfo['aid'], $artinfo['informant'], $artinfo['datetime'], $artinfo['title'], $artinfo['counter'], $artinfo['topic'], $artinfo['row_text'], $artinfo['notes'], $artinfo['morelink'], $artinfo['topics']['topicname'], $artinfo['topics']['topicimage'], $artinfo['topics']['topictext'], $artinfo['informantwrites']);
} else {
    themeindex($artinfo['aid'], $artinfo['informant'], $artinfo['datetime'], $artinfo['title'], $artinfo['counter'], $artinfo['topic'], $artinfo['row_text'], $artinfo['notes'], $artinfo['morelink'], $artinfo['topics']['topicname'], $artinfo['topics']['topicimage'], $artinfo['topics']['topictext'], $artinfo['informantwrites']);
}
echo "\n</body>\n</html>";
$cache->resync();
$db->sql_close();
if(GZIPSUPPORT && $do_gzip_compress) {
    $gzip_contents = ob_get_contents();
    ob_end_clean();
    $gzip_size = strlen($gzip_contents);
    $gzip_crc = crc32($gzip_contents);
    $gzip_contents = gzcompress($gzip_contents, 9);
    $gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);
    echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
    echo $gzip_contents;
    echo pack('V', $gzip_crc);
    echo pack('V', $gzip_size);
}
ob_end_flush();
exit;

?>