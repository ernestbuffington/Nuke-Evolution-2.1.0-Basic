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

if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$downloadsconfig['downloadsresults'];
if (empty($show)) {
    $show=$downloadsconfig['downloadsresults'];
}

if (empty($query)) {
      redirect('modules.php?name='.$module_name);
}

$downloadresult = $db->sql_query("SELECT `did`, `cid`, `sid`, `title`, `image`, `url`, `description`, `date`, `hits`, `downloadratingsummary`, `totalvotes`, `totalcomments`, `url` FROM `". _DOWNLOADS_DOWNLOADS_TABLE ."` WHERE `download_active` = '1' AND (`title` LIKE '%$query%' OR `description` LIKE '%$query%' OR `submitter` LIKE '%$query%') ORDER BY `did` LIMIT $min,".$show);
$fullcountresult = $db->sql_query("SELECT `did` FROM `". _DOWNLOADS_DOWNLOADS_TABLE ."` WHERE `download_active` = '1' AND (`title` LIKE '%$query%' OR `description` LIKE '%$query%' OR `submitter` LIKE '%$query%')");
$totalselecteddownloads = $db->sql_numrows($fullcountresult);
$result2 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `title` LIKE '%$query%' AND `catactive`= '1' ORDER BY `title` DESC");
$nrows2 = $db->sql_numrows($result2);
$nrows1 = $totalselecteddownloads;
$nrows = $nrows2 + $nrows1;
DownloadsHeading();
DownloadsLegend();
OpenTable();
if ($nrows > 0) {
    OpenTable2();
    echo "<table border=\"0\" width=\"100%\">\n";
    echo "<tr><td align=\"center\">";
    echo "<span class=\"option\"><strong>".$lang_new[$module_name]['SEARCH_RESULTS_HEADER']."</strong></span>";
    echo "</td></tr>\n";
    echo "<tr><td align=\"center\"><span class=\"option\"><em>$query</em></span></td></tr>\n";
    echo "</table>\n";
    CloseTable2();
    echo "<br />";
    echo "<table width=\"100%\" border=\"0\"><tr><td bgcolor='".$ThemeInfo['bgcolor2']."'><span class=\"option\"><strong>".$lang_new[$module_name]['SEARCH_RESULTS_CATEGORIES']."</strong>: $nrows2</span></td></tr>\n";
    while ($row2 = $db->sql_fetchrow($result2)) {
        $cid = intval($row2['cid']);
        $stitle = set_smilies(decode_bbcode(stripslashes($row2['title']), 1, true));
        $numrows = 0;
        while ($row3 = $db->sql_fetchrow($result) ) {
              if ( $row3['cid'] == $cid ) {
                  $numrows++;
              }
        }
        $title = stripslashes(check_html($row2['title'], "nohtml"));
        $parentid = intval($row2['parentid']);
        if ($parentid > 0) {$title = DownloadsGetParent($parentid,$title);}
        $title = preg_replace('#'.$query.'#si', "<strong>$query</strong>", $title);
        echo "<tr><td><strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;op=viewdownload&amp;cid=$cid\">$title</a> ($numrows)</td></tr>\n";
    }
    echo "</table>";
    echo "<br /><table width=\"100%\" bgcolor='".$ThemeInfo['bgcolor2']."'><tr><td><span class=\"option\"><strong>".$lang_new[$module_name]['SEARCH_RESULTS_DOWNLOADS']."</strong>: $nrows1</span></td></tr></table>\n";
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td>\n";
    while($row = $db->sql_fetchrow($downloadresult)) {
        $did = intval($row['did']);
        $title = set_smilies(decode_bbcode(stripslashes($row['title']), 1, true));
        $description = set_smilies(decode_bbcode(stripslashes($row['description']), 1, true));
        $description = preg_replace('#'.$query.'#si', "<strong>$query</strong>", $description);
        $image = stripslashes($row['image']);
        $url = stripslashes($row['url']);
        $name = $row['name'];
        $time = $row['date'];
        $datetime = formatTimeStamp($time);
        $hits = intval($row['hits']);
        $submitter = UsernameColor($row['name']);
        $downloadratingsummary = $row['downloadratingsummary'];
        $totalvotes = intval($row['totalvotes']);
        $totalcomments = intval($row['totalcomments']);
        $downloadratingsummary = number_format($downloadratingsummary, $mainvotedecimal);
        $transfertitle = str_replace (" ", "_", $row['title']);
        $title = preg_replace('#'.$query.'#si', "<strong>$query</strong>", $title);
        echo "<fieldset><table width=\"100%\" border=\"0\" bgcolor=\"".$downloadsconfig['tablecolor1']."\">\n";
        echo "<tr>";
        echo "<td><a href=\"modules.php?name=$module_name&amp;op=visit&amp;did=$did\" target=\"_blank\"><img src=\"".evo_image('download.png', $module_name)."\" border=\"0\" />&nbsp;<strong>$title</strong></a>".DownloadsGraphicNew($time).DownloadsGraphicPopular($hits);
        echo "</td>";
        if ($downloadratingsummary != '0' || $downloadratingsummary != '0.0') {
            echo "<td width=\"20%\" align=\"right\">";
            echo DownloadsDisplayScore($downloadratingsummary);
            echo "</td>";
        } else {
            echo "<td width=\"20%\"></td>";
        }
        echo "</tr>\n";
        echo "</table> ";
        echo "<table bgcolor=\"".$downloadsconfig['tablecolor2']."\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr>";
        if($image != 'http://' && !empty($image) ){
            echo "<td valign=\"top\" width=\"".$downloadsconfig['image_width']."\" ><a href=\"modules.php?name=$module_name&amp;op=visit&amp;did=$did\" target=\"_blank\"><img src=\"$image\" width=\"".$downloadsconfig['image_width']."\" height=\"".$downloadsconfig['image_height']."\" border=\"0\" title=\"".$lang_new[$module_name]['VISIT']." \" valign=\"absmiddle\" alt=\"\" /></a></td>";
            echo "<td width=\"2%\"></td>";
            echo "<td align=\"left\" valign=\"top\" width=\"100%\"><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />$description </td>";
        }elseif ( $downloadsconfig['thumbnail_use'] && !empty($downloadsconfig['thumbnail_url']) ) {
            echo "<td valign=\"top\" width=\"".$downloadsconfig['image_width']."\" ><a href=\"modules.php?name=$module_name&amp;op=visit&amp;did=$did\" target=\"_blank\"><img src=\"".htmlentities($downloadsconfig['thumbnail_url'].$url, ENT_NOQUOTES)."\" width=\"".$downloadsconfig['image_width']."\" height=\"".$downloadsconfig['image_height']."\"  border=\"0\" title=\"".$lang_new[$module_name]['VISIT']."\" alt=\"\" /></a></td>";
            echo "<td width=\"2%\"></td>";
            echo "<td align=\"left\" valign=\"top\" width=\"100%\"><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />$description </td>";
        }else{
            echo "<td valign=\"top\" width=\"".$downloadsconfig['image_width']."\" ><a href=\"modules.php?name=$module_name&amp;op=visit&amp;did=$did\" target=\"_blank\"><img src=\"".evo_image('blank.gif', $module_name)."\" width=\"".$downloadsconfig['image_width']."\" height=\"".$downloadsconfig['image_height']."\"  border=\"0\" title=\"".$lang_new[$module_name]['VISIT']."\" alt=\"\" /></a></td>";
            echo "<td width=\"2%\"></td>";
            echo "<td align=\"left\" valign=\"top\" width=\"100%\"><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />$description </td>";
        }
        echo "</tr></table>";
        echo "<table bgcolor=\"".$downloadsconfig['tablecolor1']."\" width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tr>";
        $datetime = formatTimeStamp($time);
        echo "<td width=\"25%\" align=\"left\" height=\"20\"><img src=\"".evo_image('date.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" title=\"".$lang_new[$module_name]['DATE_WRITTEN']." $datetime ".$lang_new[$module_name]['BY']." $name\" alt=\"\" />&nbsp;$datetime </td>";
        echo "<td width=\"20%\"><img src=\"".evo_image('hits.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" title=\"".$lang_new[$module_name]['HITS']." $hits\" alt=\"\" />&nbsp;<strong>$hits</strong></td>  ";
        $votestring = ($totalvotes == 1) ? $lang_new[$module_name]['VOTE'] : $lang_new[$module_name]['VOTES'];
        if ($totalvotes != 0) {
            echo "<td width=\"9%\"><a href=\"modules.php?name=$module_name&amp;op=viewdownloaddetails&amp;did=$did&amp;ttitle=$transfertitle\"><img src=\"".evo_image('details.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_SHOW_DETAILS']."\" alt=\"\" /></a></td>";
        } else {
            echo "<td width=\"9%\"></td>";
        }
        echo "<td width=\"10%\" align=\"center\"><a href=\"modules.php?name=$module_name&amp;op=ratedownload&amp;did=$did&amp;ttitle=$transfertitle\"><img src=\"".evo_image('votein.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_RATE']."\" alt=\"\" /></a></td>";
        if ($totalcomments != 0) {
            echo "<td width=\"9%\"><a href=\"modules.php?name=$module_name&amp;op=viewdownloadcomments&amp;did=$did&amp;ttitle=$transfertitle\"><img src=\"".evo_image('comments.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_SHOW_COMMENTS']."\" alt=\"\" />&nbsp;<strong>$totalcomments</strong></a></td>";
        } else {
            echo "<td width=\"9%\"></td>";
        }
        echo "<td width=\"9%\">".DownloadsDetectEditorial($did, $transfertitle)."</td>";
        if (is_user()) {
            echo "<td width=\"9%\" align=\"right\"><a href=\"modules.php?name=$module_name&amp;op=brokendownload&amp;did=$did\"><img src=\"".evo_image('alert.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['REPORT_BROKEN']."\" alt=\"\" /></a></td>";
        } else {
            echo "<td width=\"9%\"></td>";
        }
        if (is_mod_admin($module_name)) {
            echo "<td width=\"9%\" align=\"right\" ><a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;did=$did\"><img src=\"".evo_image('editicon.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['EDIT']."\" alt=\"\" /></a></td>";
        } else {
            echo "<td width=\"9%\"></td>";
        }
        echo " </tr></table></fieldset>";
    }
    echo "</td></tr></table>\n";
} else {
    echo "<br /><br /><center><span class=\"option\"><strong>".$lang_new[$module_name]['SEARCH_RESULTS_NO_MATCH']."</strong></span><br /><br />".$lang_new[$module_name]['SUBMIT_GOBACK']."<br /></center>";
}
// Calculates how many pages exist. Which page one should be on, etc...
$downloadpagesint = ($totalselecteddownloads / $downloadsconfig['downloadsresults']);
$downloadpageremainder = ($totalselecteddownloads % $downloadsconfig['downloadsresults']);
if ($downloadpageremainder != 0) {
    $downloadpages = ceil($downloadpagesint);
    if ($totalselecteddownloads < $downloadsconfig['downloadsresults']) {
        $downloadpageremainder = 0;
    }
} else {
    $downloadpages = $downloadpagesint;
}

// Page Numbering
if ($downloadpages!=1 && $downloadpages!=0) {
    echo "<center><br /><br />";
    $prev=$min-$downloadsconfig['downloadsresults'];
    if ($prev>=0) {
        echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;min=$prev&amp;orderby=$orderby&amp;show=".$downloadsconfig['downloadsresults']."\">";
        echo "<img src='".evo_image('left.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_PREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }else{
        echo "<img src='".evo_image('noleft.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NOPREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }
    $counter = 1;
    $currentpage = ($max / $downloadsconfig['downloadsresults']);
    while ($counter<=$downloadpages ) {
       $cpage = $counter;
       $mintemp = ($downloadsconfig['downloadsresults'] * $counter) - $downloadsconfig['downloadsresults'];
       $next = (($totalselecteddownloads - $mintemp) > $downloadsconfig['downloadsresults']) ? $downloadsconfig['downloadsresults'] : ($totalselecteddownloads - $mintemp);
       if ($counter == $currentpage) {
          echo "<strong>$counter</strong>&nbsp;";
        } else {
          echo "<a href=\"modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$next\">$counter</a> ";
        }
        $counter++;
    }
    if ($max < $totalselecteddownloads) {
        echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;min=$max&amp;orderby=$orderby&amp;show=$next\">";
        echo "<img src='".evo_image('right.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NEXT']."' alt='".$lang_new[$module_name]['PAGE_NEXT']."' border='0' /></a>";
    }else{
        echo "&nbsp;&nbsp;<img src='".evo_image('noright.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NONEXT']."' alt='".$lang_new[$module_name]['PAGE_NONEXT']."' border='0' /></a>";
    }
    echo "</center>";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>