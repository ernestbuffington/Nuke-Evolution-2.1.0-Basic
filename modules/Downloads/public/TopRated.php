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

include_once(NUKE_BASE_DIR.'header.php');
DownloadsHeading();
OpenTable();
if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$downloadsconfig['downloads_perpage'];
if (empty($show)) {
    $show=$downloadsconfig['downloads_perpage'];
}
$totalrateddownloads = $db->sql_numrows($db->sql_query("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `downloadratingsummary` <> '0' and `totalvotes` >= ".$downloadsconfig['downloadvotemin'].""));
$toppercentrigger = 0;
if (!empty($ratenum) && !empty($ratetype)) {
    $ratenum = intval($ratenum);
    $ratetype = htmlentities($ratetype);
    $topdownloads = ($totalrateddownloads > $ratenum) ? $ratenum : $totalrateddownloads;
    if ($ratetype == 'percent') {
      $toppercentrigger = 1;
      $topdownloads = round(($ratenum * $totalrateddownloads) / 100);
      $topdownloads = ($totalrateddownloads > $topdownloads) ? $topdownloads : $totalrateddownloads;
    }
}
if(empty($topdownloads)) {
    $topdownloads=$downloadsconfig['downloads_perpage'];
    $ratenum = $downloadsconfig['downloads_perpage'];
}
$totalselecteddownloads = $topdownloads;
OpenTable2();
echo "<table border=\"0\" width=\"100%\">\n";
echo "<tr><td align=\"center\">";
if ($toppercentrigger == 1) {
    echo "<span class=\"option\"><strong>".$lang_new[$module_name]['RATED_BEST_HEADER']." $ratenum% (".$lang_new[$module_name]['OF']." $totalrateddownloads ".$lang_new[$module_name]['RATED_TOTAL'].")</strong></span>";
} else {
    echo "<span class=\"option\"><strong>".$lang_new[$module_name]['RATED_BEST']." $ratenum </strong></span>";
}
echo "</td></tr><tr><td></td></tr>";
echo "<tr><td align=\"center\">".$lang_new[$module_name]['NOTE']." ".$downloadsconfig['downloadvotemin']." ".$lang_new[$module_name]['VOTE_MINIMUM']."</td></tr>\n";
echo "<tr><td align=\"center\">".$lang_new[$module_name]['SHOW_TOPRATED'].":  ";
echo "[ <a href=\"modules.php?name=$module_name&amp;op=TopRated&amp;ratenum=10&amp;ratetype=num\">10</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;op=TopRated&amp;ratenum=25&amp;ratetype=num\">25</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;op=TopRated&amp;ratenum=50&amp;ratetype=num\">50</a> | "
    ."<a href=\"modules.php?name=$module_name&amp;op=TopRated&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;op=TopRated&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;op=TopRated&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]";
echo "</td></tr>";
echo "</table>\n";
CloseTable2();
echo "<br />";
$result = $db->sql_query("SELECT  * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `downloadratingsummary` <> 0 and `totalvotes` >= ".$downloadsconfig['downloadvotemin']." ORDER BY `downloadratingsummary` DESC limit $min, ".$show);
while ($row4 = $db->sql_fetchrow($result)) {
    echo "<fieldset>";
    DownloadShowSingle($row4);
    echo "</fieldset><br />";
}
$db->sql_freeresult($result);
// Calculates how many pages exist. Which page one should be on, etc...
$downloadpagesint = ($totalselecteddownloads / $downloadsconfig['downloads_perpage']);
$downloadpageremainder = ($totalselecteddownloads % $downloadsconfig['downloads_perpage']);
if ($downloadpageremainder != 0) {
    $downloadpages = ceil($downloadpagesint);
    if ($totalselecteddownloads < $downloadsconfig['downloads_perpage']) {
        $downloadpageremainder = 0;
    }
} else {
    $downloadpages = $downloadpagesint;
}

// Page Numbering
if ($downloadpages!=1 && $downloadpages!=0) {
    echo "<center><br /><br />";
    $prev=$min-$downloadsconfig['downloads_perpage'];
    if ($prev>=0) {
        echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=TopRated&amp;ratenum=$ratenum&amp;ratetype=$ratetype&amp;min=$prev&amp;show=".$downloadsconfig['downloads_perpage']."\">";
        echo "<img src='".evo_image('left.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_PREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }else{
      echo "<img src='".evo_image('noleft.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NOPREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }
    $counter = 1;
    $currentpage = ($max / $downloadsconfig['downloads_perpage']);
    while ($counter<=$downloadpages ) {
       $cpage = $counter;
       $mintemp = ($downloadsconfig['downloads_perpage'] * $counter) - $downloadsconfig['downloads_perpage'];
       $next = (($totalselecteddownloads - $mintemp) > $downloadsconfig['downloads_perpage']) ? $downloadsconfig['downloads_perpage'] : ($totalselecteddownloads - $mintemp);
       if ($counter == $currentpage) {
          echo "<strong>$counter</strong>&nbsp;";
        } else {
          echo "<a href=\"modules.php?name=$module_name&amp;op=TopRated&amp;ratenum=$ratenum&amp;ratetype=$ratetype&amp;min=$mintemp&amp;show=$next\">$counter</a> ";
        }
        $counter++;
    }
    if ($max < $totalselecteddownloads ) {
        echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=TopRated&amp;ratenum=$ratenum&amp;ratetype=$ratetype&amp;min=$max&amp;show=$next\">";
        echo "<img src='".evo_image('right.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NEXT']."' alt='".$lang_new[$module_name]['PAGE_NEXT']."' border='0' /></a>";
    }else{
      echo "&nbsp;&nbsp;<img src='".evo_image('noright.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NONEXT']."' alt='".$lang_new[$module_name]['PAGE_NONEXT']."' border='0' /></a>";
    }
    echo "</center>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>