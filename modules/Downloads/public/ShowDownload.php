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

if (!defined('MODULE_FILE') || !defined('DOWNLOADS_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

global $userinfo;
include_once(NUKE_BASE_DIR.'header.php');
DownloadsHeading();

$did        = $_GETVAR->get('did', '_REQUEST', 'int', 0);
$forward    = $_GETVAR->get('forward', '_POST', 'int', 0);

$mypage     = $db->sql_ufetchrow("SELECT * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did`=".$did);
$myactive   = intval($mypage['download_active']);
$mycounter  = intval($mypage['hits']);
if ( (($myactive == 0) || (DownloadsAllowed($did, $userinfo['user_id'], 'view') == FALSE)) && (!is_mod_admin($module_name)) ) {
    OpenTable();
    echo "<center><span class=\"option\">"
        . $lang_new[$module_name]['INFO_DOWNLOAD_RESTRICTED'] . "<br />"
        . $lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
    echo "</span></center>";
    CloseTable();
} else {
    OpenTable();
    DownloadsInfoMenu($did, stripslashes($mypage['title']));
    CloseTable();
    OpenTable();
    echo "<fieldset>\n";
    DownloadShowSingle($mypage);
    echo "</fieldset>\n";
    CloseTable();
}

include_once(NUKE_BASE_DIR.'footer.php');

?>