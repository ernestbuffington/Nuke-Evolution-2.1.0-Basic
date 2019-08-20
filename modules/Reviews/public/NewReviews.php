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

if (!defined('MODULE_FILE') || !defined('REVIEW_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');
ReviewHeading();
OpenTable();
echo "<table width=\"100%\" border=\"1\"><tr bgcolor=\"$bgcolor1\"><td width=\"100%\"><center><span class=\"option\"><strong>".$lang_new[$module_name]['REVIEWS_NEW']."</strong></span></center></td></tr></table><br />";
$allweekreviews = 0;
$newreviewdayend = strtotime("-7 day");
$newreviewdaystart = time();
$totalweekreviews = $db->sql_numrows($db->sql_query("SELECT `rid` FROM "._REVIEWS_REVIEWS_TABLE." WHERE `date` < '$newreviewdaystart' AND `date` > '$newreviewdayend'"));
$allweekreviews = $totalweekreviews;

$allmonthreviews = 0;
$newreviewdayend = strtotime("-30 day");
$newreviewdaystart = time();
$totalmonthreviews = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `date` < '$newreviewdaystart' AND `date` > '$newreviewdayend'"));
$allmonthreviews = $totalmonthreviews;

echo "<center><strong>".$lang_new[$module_name]['NEW_TOTAL'].":</strong><br />".$lang_new[$module_name]['NEW_LASTWEEK'].": $allweekreviews <br />".$lang_new[$module_name]['NEW_LAST30DAY'].": $allmonthreviews<br /><br />"
.$lang_new[$module_name]['SHOW'].": <a href=\"modules.php?name=$module_name&amp;op=NewReviews&amp;newreviewshowdays=7\">[".$lang_new[$module_name]['WEEKS_1']."]</a>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=NewReviews&amp;newreviewshowdays=14\">[".$lang_new[$module_name]['WEEKS_2']."]</a>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=NewReviews&amp;newreviewshowdays=30\">[".$lang_new[$module_name]['DAYS_30']."]</a>"
."</center><br />";
/* List Last VARIABLE Days of REVIEWs */
if ($newreviewshowdays <= 0) {$newreviewshowdays = 7;}
echo "<br /><center><strong>".$lang_new[$module_name]['NEW_TOTAL_FORLAST']." $newreviewshowdays ".$lang_new[$module_name]['DAYS'].":</strong><br /><br />";
$counter = 0;
$allweekreviews = 0;
while ($counter <= $newreviewshowdays-1) {
    $newreviewdaystart = strtotime("-$counter day");
    $newreviewdayend = $newreviewdaystart - 86400;
    $newreviewView = formatTimeStamp($newreviewdaystart, '', '1');
    $totalreviews = $db->sql_numrows($db->sql_query("SELECT * FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `date` < '$newreviewdaystart' AND `date` > '$newreviewdayend'"));
    $counter++;
    $allweekreviews = $allweekreviews + $totalreviews;
    echo "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;op=NewReviewsDate&amp;selectdate=$newreviewdayend\">$newreviewView</a>&nbsp;($totalreviews)<br />";
}
$counter = 0;
$allmonthreviews = 0;
echo "</center>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>