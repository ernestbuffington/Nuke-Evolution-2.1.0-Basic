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

$sql_order  = $_GETVAR->get('orderby', '_REQUEST', 'string', 'titleA');
$min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
$max        = $_GETVAR->get('max', '_REQUEST', 'int', 0);
$show       = $_GETVAR->get('show', '_REQUEST', 'int', $downloadsconfig['topdownloads']);
$cid        = $_GETVAR->get('cid', '_REQUEST', 'int', 0);
$ratenum    = $_GETVAR->get('ratenum', '_REQUEST', 'int', 0);
$ratetype   = $_GETVAR->get('ratetype', '_REQUEST', 'string', '');

if ($max == 0) {
    $max =$min+$downloadsconfig['downloads_perpage'];
}

include_once(NUKE_BASE_DIR.'header.php');
DownloadsHeading();
OpenTable();

$totalmostpopdownloads = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."`");
$percentrigger = 0;
if ($ratenum > 0 && !empty($ratetype)) {
    $mostpopdownloads = ($totalmostpopdownloads > $ratenum) ? $ratenum : $totalmostpopdownloads;
    if ($ratetype == 'percent') {
        $percentrigger    = 1;
        $mostpopdownloads = round(($ratenum * $totalmostpopdownloads) / 100);
        $mostpopdownloads = ($totalmostpopdownloads > $mostpopdownloads) ? $mostpopdownloads : $totalmostpopdownloads;
    }
}

if(empty($mostpopdownloads)) {
    $mostpopdownloads = $downloadsconfig['topdownloads'];
    $ratenum          = $downloadsconfig['topdownloads'];
}

$totalselecteddownloads = $mostpopdownloads;
OpenTable2();
echo "<table border='0' width='100%'>\n";
echo "<tr><td align='center'>";
if ($percentrigger == 1) {
    echo "<span class='option'><strong>".$lang_new[$module_name]['MOST_POPULAR']." $ratenum% (".$lang_new[$module_name]['OF']." $totalmostpopdownloads ".$lang_new[$module_name]['DOWNLOADS'].")</strong></span>";
} else {
    echo "<span class='option'><strong>".$lang_new[$module_name]['MOST_POPULAR']." $ratenum (".$lang_new[$module_name]['OF']." $totalmostpopdownloads ".$lang_new[$module_name]['DOWNLOADS'].")</strong></span>";
}
echo "</td></tr>";
echo "<tr><td align='center'>".$lang_new[$module_name]['SHOW_MOSTPOPULAR'].":  ";
echo "[ <a href='modules.php?name=".$module_name."&amp;op=MostPopular&amp;ratenum=10&amp;ratetype=num'>10</a> - "
    ."<a href='modules.php?name=".$module_name."&amp;op=MostPopular&amp;ratenum=25&amp;ratetype=num'>25</a> - "
    ."<a href='modules.php?name=".$module_name."&amp;op=MostPopular&amp;ratenum=50&amp;ratetype=num'>50</a> | "
    ."<a href='modules.php?name=".$module_name."&amp;op=MostPopular&amp;ratenum=1&amp;ratetype=percent'>1%</a> - "
    ."<a href='modules.php?name=".$module_name."&amp;op=MostPopular&amp;ratenum=5&amp;ratetype=percent'>5%</a> - "
    ."<a href='modules.php?name=".$module_name."&amp;op=MostPopular&amp;ratenum=10&amp;ratetype=percent'>10%</a> ]";
echo "</td></tr>";
echo "</table>\n";
CloseTable2();
echo "<br />";
$result3 = $db->sql_query("SELECT * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` ORDER BY `hits` DESC LIMIT ".$min.", ".$show);
$counter = 0;
while($row3 = $db->sql_fetchrow($result3)) {
    if ( !DownloadsAllowed($row3['did'], $userinfo['user_id'], 'view') && !is_mod_admin($module_name)) {
        continue;
    } else {
        $counter++;
        echo "<fieldset>";
        DownloadShowSingle($row3);
        echo "</fieldset><br />";
    }
}
$db->sql_freeresult($result3);
$totalselecteddownloads = $counter;
// Calculates how many pages exist. Which page one should be on, etc...
$downloadpagesint      = ($totalselecteddownloads / $downloadsconfig['topdownloads']);
$downloadpageremainder = ($totalselecteddownloads % $downloadsconfig['topdownloads']);
if ($downloadpageremainder != 0) {
    $downloadpages = ceil($downloadpagesint);
    if ($totalselecteddownloads < $downloadsconfig['topdownloads']) {
        $downloadpageremainder = 0;
    }
} else {
    $downloadpages = $downloadpagesint;
}

// Page Numbering
if ($downloadpages!=1 && $downloadpages!=0) {
    echo "<center><br /><br />";
    $prev=$min-$downloadsconfig['topdownloads'];
    if ($prev>=0) {
        echo "&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=MostPopular&amp;ratenum=".$ratenum."&amp;ratetype=".$ratetype."&amp;min=".$prev."&amp;show=".$downloadsconfig['topdownloads']."'>";
        echo "<img src='".evo_image('left.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_PREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }else{
        echo "<img src='".evo_image('noleft.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NOPREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }
    $counter = 1;
    $currentpage = ($max / $downloadsconfig['topdownloads']);
    while ($counter<=$downloadpages ) {
       $cpage = $counter;
       $mintemp = ($downloadsconfig['topdownloads'] * $counter) - $downloadsconfig['topdownloads'];
       $next = (($totalselecteddownloads - $mintemp) > $downloadsconfig['topdownloads']) ? $downloadsconfig['topdownloads'] : ($totalselecteddownloads - $mintemp);
       if ($counter == $currentpage) {
          echo "<strong>".$counter."</strong>&nbsp;";
        } else {
          echo "<a href='modules.php?name=".$module_name."&amp;op=MostPopular&amp;ratenum=".$ratenum."&amp;ratetype=".$ratetype."&amp;min=".$mintemp."&amp;show=".$next."'>".$counter."</a> ";
        }
        $counter++;
    }
    if ($max < $totalselecteddownloads ) {
        echo "&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=MostPopular&amp;ratenum=".$ratenum."&amp;ratetype=".$ratetype."&amp;min=".$max."&amp;show=".$next."'>";
        echo "<img src='".evo_image('right.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NEXT']."' alt='".$lang_new[$module_name]['PAGE_NEXT']."' border='0' /></a>";
    }else{
        echo "&nbsp;&nbsp;<img src='".evo_image('noright.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NONEXT']."' alt='".$lang_new[$module_name]['PAGE_NONEXT']."' border='0' /></a>";
    }
    echo "</center>";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>