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

if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$reviewsconfig['reviewsresults'];
if (empty($show)) {
    $show=$reviewsconfig['reviewsresults'];
}

if (empty($query)) {
      redirect('modules.php?name='.$module_name);
}

$query = $_GETVAR->fixQuotes($query);

$reviewresult = $db->sql_query("SELECT `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `date`, `hits`, `reviewratingsummary`, `totalvotes`, `totalcomments`, `url`, `name` FROM `". _REVIEWS_REVIEWS_TABLE ."` WHERE `title` LIKE '%$query%' OR `description` LIKE '%$query%' ORDER BY `rid` LIMIT $min,".$show);
$fullcountresult = $db->sql_query("SELECT `rid` FROM `". _REVIEWS_REVIEWS_TABLE ."` WHERE `title` LIKE '%$query%' OR `description` LIKE '%$query%'");
$totalselectedreviews = $db->sql_numrows($fullcountresult);
$result2 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `title` LIKE '%$query%' ORDER BY `title` DESC");
$nrows2 = $db->sql_numrows($result2);
$nrows1 = $totalselectedreviews;
$nrows = $nrows2 + $nrows1;
$the_query = stripslashes($query);
$the_query = str_replace("\\'", "'", $the_query);
ReviewHeading();
ReviewLegend();
OpenTable();
if ($nrows > 0) {
    OpenTable2();
    echo "<table border=\"0\" width=\"100%\">\n";
    echo "<tr><td align=\"center\">";
    echo "<span class=\"option\"><strong>".$lang_new[$module_name]['SEARCH_RESULTS_HEADER']."</strong></span>";
    echo "</td></tr>\n";
    echo "<tr><td align=\"center\"><span class=\"option\"><em>$the_query</em></span></td></tr>\n";
    echo "</table>\n";
    CloseTable2();
    echo "<br />";
    echo "<table width=\"100%\" border=\"0\"><tr><td bgcolor=\"$bgcolor2\"><span class=\"option\"><strong>".$lang_new[$module_name]['SEARCH_RESULTS_CATEGORIES']."</strong>: $nrows2</span></td></tr>\n";
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
        if ($parentid > 0) {$title = reviewgetparent($parentid,$title);}
        $title = preg_replace('#'.$query.'#si', "<strong>$query</strong>", $title);
        echo "<tr><td><strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;op=viewreview&amp;cid=$cid\">$title</a> ($numrows)</td></tr>\n";
    }
    echo "</table>";
    echo "<br /><table width=\"100%\" bgcolor=\"$bgcolor2\"><tr><td><span class=\"option\"><strong>".$lang_new[$module_name]['SEARCH_RESULTS_REVIEWS']."</strong>: $nrows1</span></td></tr></table>\n";
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td>\n";
    while($row = $db->sql_fetchrow($reviewresult)) {
        $rid = intval($row['rid']);
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
        $reviewratingsummary = $row['reviewratingsummary'];
        $totalvotes = intval($row['totalvotes']);
        $totalcomments = intval($row['totalcomments']);
        $reviewratingsummary = number_format($reviewratingsummary, $mainvotedecimal);
        $transfertitle = str_replace (" ", "_", $row['title']);
        $title = preg_replace('#'.$query.'#si', "<strong>$query</strong>", $title);
        echo "<fieldset><table width=\"100%\" border=\"0\" bgcolor=\"".$reviewsconfig['tablecolor1']."\">\n";
        echo "<tr>";
        echo "<td><a href=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" ><img src=\"".evo_image('review.png', $module_name)."\" border=\"0\" alt=\"\" />&nbsp;<strong>$title</strong></a>".newreviewgraphic($time).reviewpopgraphic($hits);
        echo "</td>";
        if ($reviewratingsummary != '0' || $reviewratingsummary != '0.0') {
            echo "<td width=\"20%\" align=\"right\">";
            echo ReviewsDisplayScore($reviewratingsummary);
            echo "</td>";
        } else {
            echo "<td width=\"20%\"></td>";
        }
        echo "</tr>\n";
        echo "</table> ";
        echo "<table bgcolor=\"".$reviewsconfig['tablecolor2']."\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr>";
        if($image != 'http://' && !empty($image) ){
            echo "<td valign=\"top\" width=\"".$reviewsconfig['image_width']."\" ><a href=\"".$image."\" rel=\"lightbox\" title=\"".$title."\" rev=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" ><img src=\"$image\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\" border=\"0\" title=\"".$lang_new[$module_name]['VISIT']." \" valign=\"absmiddle\" alt=\"\" /></a></td>";
            echo "<td width=\"2%\"></td>";
            echo "<td align=\"left\" valign=\"top\" width=\"100%\"><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />$description </td>";
        }elseif ( $reviewsconfig['thumbnail_use'] && !empty($reviewsconfig['thumbnail_url']) ) {
            echo "<td valign=\"top\" width=\"".$reviewsconfig['image_width']."\" ><a href=\"".htmlentities($reviewsconfig['thumbnail_url'].$url, ENT_NOQUOTES)."\" rel=\"lightbox\" title=\"".$title."\" rev=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" ><img src=\"".$reviewsconfig['thumbnail_url'].$url."\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\"  border=\"0\" title=\"".$lang_new[$module_name]['VISIT']."\" alt=\"\" /></a></td>";
            echo "<td width=\"2%\"></td>";
            echo "<td align=\"left\" valign=\"top\" width=\"100%\"><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />$description </td>";
        }else{
            echo "<td valign=\"top\" width=\"".$reviewsconfig['image_width']."\" ><a href=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" ><img src=\"".evo_image('blank.gif', $module_name)."\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\"  border=\"0\" title=\"".$lang_new[$module_name]['VISIT']."\" alt=\"\" /></a></td>";
            echo "<td width=\"2%\"></td>";
            echo "<td align=\"left\" valign=\"top\" width=\"100%\"><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />$description </td>";
        }
        echo "</tr></table>";
        echo "<table bgcolor=\"".$reviewsconfig['tablecolor1']."\" width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tr>";
        $datetime = formatTimeStamp($time);
        echo "<td width=\"25%\" align=\"left\" height=\"20\"><img src=\"".evo_image('date.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" title=\"".$lang_new[$module_name]['DATE_WRITTEN']." $datetime ".$lang_new[$module_name]['BY']." $name\" alt=\"\" />&nbsp;$datetime </td>";
        echo "<td width=\"20%\"><img src=\"".evo_image('hits.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" title=\"".$lang_new[$module_name]['HITS']." $hits\" alt=\"\" />&nbsp;<strong>$hits</strong></td>  ";
        $votestring = ($totalvotes == 1) ? $lang_new[$module_name]['VOTE'] : $lang_new[$module_name]['VOTES'];
        if ($totalvotes != 0) {
            echo "<td width=\"9%\"><a href=\"modules.php?name=$module_name&amp;op=viewreviewdetails&amp;rid=$rid&amp;ttitle=$transfertitle\"><img src=\"".evo_image('details.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_SHOW_DETAILS']."\" alt=\"\" /></a></td>";
        } else {
            echo "<td width=\"9%\"></td>";
        }
        if ($userinfo['username'] != $name) {
            echo "<td width=\"10%\" align=\"center\"><a href=\"modules.php?name=$module_name&amp;op=ratereview&amp;rid=$rid&amp;ttitle=".$transfertitle."\"><img src=\"".evo_image('votein.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_RATE']."\" alt=\"\" /></a></td>";
        }
        if ($totalcomments != 0) {
            echo "<td width=\"9%\"><a href=\"modules.php?name=$module_name&amp;op=viewreviewcomments&amp;rid=$rid&amp;ttitle=$transfertitle\"><img src=\"".evo_image('comments.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_SHOW_COMMENTS']."\" alt=\"\" />&nbsp;<strong>$totalcomments</strong></a></td>";
        } else {
            echo "<td width=\"9%\"></td>";
        }
        echo "<td width=\"9%\">".reviewdetecteditorial($rid, $transfertitle)."</td>";
        if (is_user()) {
            echo "<td width=\"9%\" align=\"right\"><a href=\"modules.php?name=$module_name&amp;op=brokenreview&amp;rid=$rid\"><img src=\"".evo_image('alert.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['REPORT_BROKEN']."\" alt=\"\" /></a></td>";
        } else {
            echo "<td width=\"9%\"></td>";
        }
        if (is_mod_admin($module_name)) {
            echo "<td width=\"9%\" align=\"right\" ><a href=\"".$admin_file.".php?op=ReviewsModReview&amp;rid=$rid\"><img src=\"".evo_image('editicon.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['EDIT']."\" alt=\"\" /></a></td>";
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
$reviewpagesint = ($totalselectedreviews / $reviewsconfig['reviewsresults']);
$reviewpageremainder = ($totalselectedreviews % $reviewsconfig['reviewsresults']);
if ($reviewpageremainder != 0) {
    $reviewpages = ceil($reviewpagesint);
    if ($totalselectedreviews < $reviewsconfig['reviewsresults']) {
        $reviewpageremainder = 0;
    }
} else {
    $reviewpages = $reviewpagesint;
}

// Page Numbering
if ($reviewpages!=1 && $reviewpages!=0) {
    echo "<center><br /><br />";
    $prev=$min-$reviewsconfig['reviewsresults'];
    if ($prev>=0) {
        echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;min=$prev&amp;orderby=$orderby&amp;show=".$reviewsconfig['reviewsresults']."\">";
        echo "<img src='".evo_image('left.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_PREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }else{
        echo "<img src='".evo_image('noleft.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NOPREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }
    $counter = 1;
    $currentpage = ($max / $reviewsconfig['reviewsresults']);
    while ($counter<=$reviewpages ) {
       $cpage = $counter;
       $mintemp = ($reviewsconfig['reviewsresults'] * $counter) - $reviewsconfig['reviewsresults'];
       $next = (($totalselectedreviews - $mintemp) > $reviewsconfig['reviewsresults']) ? $reviewsconfig['reviewsresults'] : ($totalselectedreviews - $mintemp);
       if ($counter == $currentpage) {
          echo "<strong>$counter</strong>&nbsp;";
        } else {
          echo "<a href=\"modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$next\">$counter</a> ";
        }
        $counter++;
    }
    if ($max < $totalselectedreviews) {
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