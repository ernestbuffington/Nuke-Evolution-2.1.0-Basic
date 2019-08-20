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

$newdownloadshowdays = $_GETVAR->get('newdownloadshowdays', '_REQUEST', 'int', 0);
$newdownloaddaystart = time();

include_once(NUKE_BASE_DIR.'header.php');
DownloadsHeading();
OpenTable();
echo "<table width='100%' border='1'><tr bgcolor='".$ThemeInfo['bgcolor1']."'><td width='100%'><center><span class='option'><strong>".$lang_new[$module_name]['DOWNLOADS_NEW']."</strong></span></center></td></tr></table><br />";
$allweekdownloads    = 0;
$newdownloaddayend   = strtotime("-7 day");
$totalweekdownloads  = $db->sql_numrows($db->sql_query("SELECT `did` FROM "._DOWNLOADS_DOWNLOADS_TABLE." WHERE `date_validated` < '".$newdownloaddaystart."' AND `date_validated` > '".$newdownloaddayend."'"));
$allweekdownloads    = $totalweekdownloads;

$allmonthdownloads   = 0;
$newdownloaddayend   = strtotime("-30 day");
$totalmonthdownloads = $db->sql_numrows($db->sql_query("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `date_validated` < '".$newdownloaddaystart."' AND `date_validated` > '".$newdownloaddayend."'"));
$allmonthdownloads   = $totalmonthdownloads;

echo "<center><strong>".$lang_new[$module_name]['NEW_TOTAL'].":</strong><br />".$lang_new[$module_name]['NEW_LASTWEEK'].":&nbsp;".$allweekdownloads."<br />".$lang_new[$module_name]['NEW_LAST30DAY'].":&nbsp;".$allmonthdownloads."<br /><br />"
.$lang_new[$module_name]['SHOW'].": <a href='modules.php?name=".$module_name."&amp;op=NewDownloads&amp;newdownloadshowdays=7'>[".$lang_new[$module_name]['WEEKS_1']."]</a>&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=NewDownloads&amp;newdownloadshowdays=14'>[".$lang_new[$module_name]['WEEKS_2']."]</a>&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=NewDownloads&amp;newdownloadshowdays=30'>[".$lang_new[$module_name]['DAYS_30']."]</a>"
."</center><br />";
/* List Last VARIABLE Days of Downloads */
if ($newdownloadshowdays <= 0) {$newdownloadshowdays = 7;}
echo "<br /><center><strong>".$lang_new[$module_name]['NEW_TOTAL_FORLAST']."&nbsp;".$newdownloadshowdays."&nbsp;".$lang_new[$module_name]['DAYS'].":</strong><br /><br />";
$counter = 0;
$allweekdownloads = 0;
while ($counter <= $newdownloadshowdays-1) {
    $newdownloaddaystart = strtotime("-".$counter." day");
    $newdownloaddayend   = $newdownloaddaystart - 86400;
    $newdownloadView     = formatTimeStamp($newdownloaddaystart, '', '1');
    $totaldownloads      = $db->sql_unumrows("SELECT * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `date_validated` < '".$newdownloaddaystart."' AND `date_validated` >'".$newdownloaddayend."'");
    $counter++;
    $allweekdownloads    = $allweekdownloads + $totaldownloads;
    echo "<strong><big>&middot;</big></strong>&nbsp;<a href='modules.php?name=".$module_name."&amp;op=NewDownloadsDate&amp;selectdate=".$newdownloaddayend."'>".$newdownloadView."</a>&nbsp;(".$totaldownloads.")<br />";
}
$counter = 0;
$allmonthdownloads = 0;
echo "</center>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>