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

if (!defined('MODULE_FILE') || !defined('WEBLINK_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');
LinksHeading();
OpenTable();
echo "<table width=\"100%\" border=\"1\"><tr bgcolor=\"$bgcolor1\"><td width=\"100%\"><center><span class=\"option\"><strong>".$lang_new[$module_name]['LINKS_NEW']."</strong></span></center></td></tr></table><br />";
$allweeklinks = 0;
$newlinkdayend = strtotime("-7 day");
$newlinkdaystart = time();
$totalweeklinks = $db->sql_numrows($db->sql_query("SELECT `lid` FROM "._WEBLINKS_LINKS_TABLE." WHERE `date` < '$newlinkdaystart' AND `date` > '$newlinkdayend'"));
$allweeklinks = $totalweeklinks;

$allmonthlinks = 0;
$newlinkdayend = strtotime("-30 day");
$newlinkdaystart = time();
$totalmonthlinks = $db->sql_numrows($db->sql_query("SELECT `lid` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `date` < '$newlinkdaystart' AND `date` > '$newlinkdayend'"));
$allmonthlinks = $totalmonthlinks;

echo "<center><strong>".$lang_new[$module_name]['NEW_TOTAL'].":</strong><br />".$lang_new[$module_name]['NEW_LASTWEEK'].": $allweeklinks <br />".$lang_new[$module_name]['NEW_LAST30DAY'].": $allmonthlinks<br /><br />"
.$lang_new[$module_name]['SHOW'].": <a href=\"modules.php?name=$module_name&amp;op=NewLinks&amp;newlinkshowdays=7\">[".$lang_new[$module_name]['WEEKS_1']."]</a>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=NewLinks&amp;newlinkshowdays=14\">[".$lang_new[$module_name]['WEEKS_2']."]</a>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=NewLinks&amp;newlinkshowdays=30\">[".$lang_new[$module_name]['DAYS_30']."]</a>"
."</center><br />";
/* List Last VARIABLE Days of Links */
if ($newlinkshowdays <= 0) {$newlinkshowdays = 7;}
echo "<br /><center><strong>".$lang_new[$module_name]['NEW_TOTAL_FORLAST']." $newlinkshowdays ".$lang_new[$module_name]['DAYS'].":</strong><br /><br />";
$counter = 0;
$allweeklinks = 0;
while ($counter <= $newlinkshowdays-1) {
    $newlinkdaystart = strtotime("-$counter day");
    $newlinkdayend = $newlinkdaystart - 86400;
    $newlinkView = formatTimeStamp($newlinkdaystart, '', '1');
    $totallinks = $db->sql_numrows($db->sql_query("SELECT * FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `date` < '$newlinkdaystart' AND `date` > '$newlinkdayend'"));
    $counter++;
    $allweeklinks = $allweeklinks + $totallinks;
    echo "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;op=NewLinksDate&amp;selectdate=$newlinkdayend\">$newlinkView</a>&nbsp;($totallinks)<br />";
}
$counter = 0;
$allmonthlinks = 0;
echo "</center>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>