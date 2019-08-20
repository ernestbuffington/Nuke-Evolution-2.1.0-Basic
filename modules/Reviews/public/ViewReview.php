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

if (!empty($orderby)) {
    $orderby = htmlspecialchars($orderby);
}
include_once(NUKE_BASE_DIR.'header.php');
if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$reviewsconfig['reviews_perpage'];
if(!empty($orderby)) {
    $orderby = reviewconvertorderbyin($orderby);
} else {
    $orderby = "title ASC";
}
if (!empty($show)) {
    $reviewsconfig['reviews_perpage'] = $show;
} else {
    $show=$reviewsconfig['reviews_perpage'];
}
ReviewHeading();
ReviewLegend();
OpenTable();
$cid = intval($cid);
$row1 = $db->sql_fetchrow($db->sql_query("SELECT `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid`='$cid'"));
$title = stripslashes(check_html($row1['title'], "nohtml"));
$parentid = intval($row1['parentid']);
$legendid = $cid;
$title = getparentreview($parentid,$title);
$title = "<a href=\"modules.php?name=".$module_name."\">".$lang_new[$module_name]['MODULE_NAME']."/".$title;
echo "<center><span class=\"option\"><strong>".$lang_new[$module_name]['CATEGORY'].": <em>$title</a></em></strong></span></center><br />";
echo "<hr noshade=\"noshade\" size=\"1\" />";
$result2 = $db->sql_query("SELECT `cid`, `title`, `image`, `cdescription` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `parentid`='$cid' ORDER BY `title`");
$numcats = $db->sql_numrows($result2);
$count = 0;
$count1 = 0;
if ( $numcats > 0 ) {
    while (list($tcid, $ttitle, $tcimage, $tcdescription) = $db->sql_fetchrow($result2) ) {
        if ($count == 0) {
            $leftside[$count1]['reviews'] = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$tcid'"));
            $leftside[$count1]['cid'] = $tcid;
            $leftside[$count1]['title'] = $ttitle;
            $leftside[$count1]['image'] = $tcimage;
            $leftside[$count1]['cdescription'] = $tcdescription;
            $count++;
        } else {
            $rightside[$count1]['reviews'] = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$tcid'"));
            $rightside[$count1]['cid'] = $tcid;
            $rightside[$count1]['title'] = $ttitle;
            $rightside[$count1]['image'] = $tcimage;
            $rightside[$count1]['cdescription'] = $tcdescription;
            $count = 0;
        }
        $count1++;
    }
    $db->sql_freeresult($result2);
    $tablerows = ($numcats / 2) + ($numcats % 2);
    $count = 0;
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n";
    echo "<tr>\n";
    echo "<td width=\"50%\">\n";
    if (!empty($leftside)) {
          foreach( $leftside as $tableleft)  {
                    $cid = $tableleft['cid'];
                    $title = $tableleft['title'];
                    $image = $tableleft['image'];
                    $cdescription = $tableleft['cdescription'];
                    $countreviews = $tableleft['reviews'];
                    echo "<fieldset><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
                    echo "<tr><td width=\"100%\" bgcolor=\"".$reviewsconfig['tablecolor1']."\">";
                    if ( !empty($image) ) {
                        echo " <img src=\"$image\" width=\"16\" height=\"16\" alt=\"\" />&nbsp;";
                    } else {
                        echo " <img src=\"".evo_image('dir.png', $module_name)."\" width=\"16\" height=\"16\" alt=\"\" />&nbsp;";
                    }
                    echo "<a href=\"modules.php?name=$module_name&amp;op=viewreview&amp;cid=".$cid."\">". set_smilies(decode_bbcode(stripslashes($title), 1, true)) ." ($countreviews)".categorynewreviewgraphic($cid) ."</td></tr>\n";
                    echo "<tr><td width=\"100%\" >". set_smilies(decode_bbcode(stripslashes($cdescription), 1, true)) ."</td></tr>\n";
                    // Lookup for SubCategories
                    $result3 = $db->sql_query("SELECT `cid`, `title`, `image` from `"._REVIEWS_CATEGORIES_TABLE."` WHERE `parentid`='".$cid."' ORDER BY `title`");
                    $numsubcats = $db->sql_numrows($result3);
                    if ( $numsubcats > 0 ) {
                          echo "<tr><td>\n";
                          echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
                          while($row3 = $db->sql_fetchrow($result3)) {
                                echo "<tr><td width=\"100%\">&nbsp;&nbsp;";
                                if ( !empty($row3['image']) ) {
                                    echo " <img src=\"".$row3['image']."\" width=\"16\" height=\"16\" alt=\"\" />&nbsp;";
                                } else {
                                    echo " <img src=\"".evo_image('sub-dir.png', $module_name)."\" width=\"16\" height=\"16\" alt=\"\" />&nbsp;";
                                }
                                echo "<a href=\"modules.php?name=$module_name&amp;op=viewreview&amp;cid=".$row3['cid']."\">";
                                echo stripslashes($row3['title']) ."</a></td></tr>\n";
                          }
                          $db->sql_freeresult($result3);
                          echo "</td></tr>\n";
                          echo "</table>\n";
                    }
                    echo "</table></fieldset>\n";
          }
    }
    echo "</td>\n";
    echo "<td width=\"50%\">\n";
    if (!empty($rightside)) {
          foreach( $rightside as $tableright)  {
                    $cid = $tableright['cid'];
                    $title = $tableright['title'];
                    $image = $tableright['image'];
                    $cdescription = $tableright['cdescription'];
                    $countreviews = $tableright['reviews'];
                    echo "<fieldset><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
                    echo "<tr><td width=\"100%\" bgcolor=\"".$reviewsconfig['tablecolor1']."\">";
                    if ( !empty($image) ) {
                        echo " <img src=\"$image\" width=\"16\" height=\"16\" alt=\"\" />&nbsp;";
                    } else {
                        echo " <img src=\"".evo_image('dir.png', $module_name)."\" width=\"16\" height=\"16\" alt=\"\" />&nbsp;";
                    }
                    echo "<a href=\"modules.php?name=$module_name&amp;op=viewreview&amp;cid=".$cid."\">". set_smilies(decode_bbcode(stripslashes($title), 1, true)) ." ($countreviews)".categorynewreviewgraphic($cid) ."</td></tr>\n";
                    echo "<tr><td width=\"100%\" >". set_smilies(decode_bbcode(stripslashes($cdescription), 1, true)) ."</td></tr>\n";
                    // Lookup for SubCategories
                    $result3 = $db->sql_query("SELECT `cid`, `title`, `image`  from `"._REVIEWS_CATEGORIES_TABLE."` WHERE `parentid`='".$cid."' ORDER BY `title`");
                    $numsubcats = $db->sql_numrows($result3);
                    if ( $numsubcats > 0 ) {
                          echo "<tr><td>\n";
                          echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
                          while($row3 = $db->sql_fetchrow($result3)) {
                                echo "<tr><td width=\"100%\">&nbsp;&nbsp;";
                                if ( !empty($row3['image']) ) {
                                    echo " <img src=\"".$row3['image']."\" width=\"16\" height=\"16\" alt=\"\" />&nbsp;";
                                } else {
                                    echo " <img src=\"".evo_image('sub-dir.png', $module_name)."\" width=\"16\" height=\"16\" alt=\"\" />&nbsp;";
                                }
                                echo "<a href=\"modules.php?name=$module_name&amp;op=viewreview&amp;cid=".$row3['cid']."\">";
                                echo stripslashes($row3['title']) ."</a></td></tr>\n";
                          }
                          $db->sql_freeresult($result3);
                          echo "</td></tr>\n";
                          echo "</table>\n";
                    }
                    echo "</table></fieldset>\n";
          }
    }
    echo "</td>\n";
    echo "</tr></table>\n";

} else {
    echo "<center><span class=\"option\"><em>".$lang_new[$module_name]['INFO_NO_SUBCAT']."</em></span></center><br />\n";
}
echo "<hr noshade=\"noshade\" size=\"1\" />\n";
$orderbyTrans = reviewconvertorderbytrans($orderby);
ReviewOrderLegend($orderbyTrans, $legendid);

if(!is_numeric($min)){
    $min=0;
}

$result4 = $db->sql_query("SELECT `rid`, `title`, `image`, `description`, `date`, `hits`, `reviewratingsummary`, `totalvotes`, `totalcomments`, `name`, `url` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$legendid' ORDER BY $orderby LIMIT $min, ". $reviewsconfig['reviews_perpage']);
$fullcountresult = $db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$legendid'");
$totalselectedreviews = $db->sql_numrows($fullcountresult);

echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td>\n";
while($row4 = $db->sql_fetchrow($result4)) {
    $rid = intval($row4['rid']);
    $transfertitle = str_replace (" ", "_", $row4['title']);
    $title = set_smilies(decode_bbcode(stripslashes($row4['title']), 1, true));
    $description = set_smilies(decode_bbcode(stripslashes($row4['description']), 1, true));
    $image = stripslashes($row4['image']);
    $url = stripslashes($row4['url']);
    $name = $row4['name'];
    $time = $row4['date'];
    $datetime = formatTimeStamp($time);
    $hits = intval($row4['hits']);
    $submitter = UsernameColor($row4['name']);
    $reviewratingsummary = $row4['reviewratingsummary'];
    $totalvotes = intval($row4['totalvotes']);
    $totalcomments = intval($row4['totalcomments']);
    $reviewratingsummary = number_format($reviewratingsummary, $reviewsconfig['mainvotedecimal']);
    echo "<fieldset><table width=\"100%\" border=\"0\" bgcolor=\"".$reviewsconfig['tablecolor1']."\">\n";
    echo "<tr>";
    echo "<td>";
    if ($url) {
        echo "<a href=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" ><img src=\"".evo_image('review.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\"\" />&nbsp;<strong>$title</strong></a>&nbsp;".newreviewgraphic($time).reviewpopgraphic($hits);
    } else {
        echo "<a href=\"modules.php?name=$module_name&amp;op=showreview&amp;rid=$rid\"><img src=\"".evo_image('show_review.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" alt=\"\" />&nbsp;<strong>$title</strong></a>&nbsp;".newreviewgraphic($time).reviewpopgraphic($hits);
    }
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
        if (!file_exists($image)) {
            if (file_exists(NUKE_MODULES_DIR . $module_name . '/images/'.$image)) {
                $image = NUKE_MODULES_IMAGE_DIR . $module_name . '/images/'.$image;
            } else {
                $image = '';
            }
        }
        echo "<td valign=\"top\" width=\"".$reviewsconfig['image_width']."\" ><a href=\"".$image."\" rel=\"lightbox\" title=\"".$title."\" rev=\"modules.php?name=$module_name&amp;op=reviewvisit&amp;rid=$rid\" ><img src=\"$image\" width=\"".$reviewsconfig['image_width']."\" height=\"".$reviewsconfig['image_height']."\" border=\"0\" title=\"".$lang_new[$module_name]['VISIT']."\"  align=\"middle\" alt=\"\" /></a></td>";
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
    echo "<td width=\"20%\"><img src=\"".evo_image('hits.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" title=\"".$lang_new[$module_name]['HITS']." $hits\" alt=\"\" />&nbsp;<strong>$hits</strong></td>";
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
          echo "<td width=\"9%\"><a href=\"modules.php?name=$module_name&amp;op=viewreviewcomments&amp;rid=$rid&amp;ttitle=".$transfertitle."\"><img src=\"".evo_image('comments.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_SHOW_COMMENTS']."\" alt=\"\" />&nbsp;<strong>$totalcomments</strong></a></td>";
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
$db->sql_freeresult($result4);
$orderby = reviewconvertorderbyout($orderby);
// Calculates how many pages exist. Which page one should be on, etc...
$reviewpagesint = ($totalselectedreviews / $reviewsconfig['reviews_perpage']);
$reviewpageremainder = ($totalselectedreviews % $reviewsconfig['reviews_perpage']);
if ($reviewpageremainder != 0) {
    $reviewpages = ceil($reviewpagesint);
    if ($totalselectedreviews < $reviewsconfig['reviews_perpage']) {
        $reviewpageremainder = 0;
    }
} else {
    $reviewpages = $reviewpagesint;
}

// Page Numbering
if ($reviewpages!=1 && $reviewpages!=0) {
    echo "<center><br /><br />";
    $prev=$min-$reviewsconfig['reviews_perpage'];
    if ($prev>=0) {
        echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=viewreview&amp;cid=$legendid&amp;min=$prev&amp;orderby=$orderby&amp;show=".$reviewsconfig['reviews_perpage']."\">";
        echo "<img src='".evo_image('left.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_PREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }else{
      echo "<img src='".evo_image('noleft.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NOPREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }
    $counter = 1;
    $currentpage = ($max / $reviewsconfig['reviews_perpage']);
    while ($counter<=$reviewpages ) {
       $cpage = $counter;
       $mintemp = ($reviewsconfig['reviews_perpage'] * $counter) - $reviewsconfig['reviews_perpage'];
       if ($counter == $currentpage) {
          echo "<strong>$counter</strong>&nbsp;";
        } else {
          echo "<a href=\"modules.php?name=$module_name&amp;op=viewreview&amp;cid=$legendid&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";
        }
        $counter++;
    }
    $next=$min+$reviewsconfig['reviews_perpage'];
    if ($max < $totalselectedreviews) {
        echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=viewreview&amp;cid=$legendid&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">";
        echo "<img src='".evo_image('right.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NEXT']."' alt='".$lang_new[$module_name]['PAGE_NEXT']."' border='0' /></a>";
    }else{
        echo "&nbsp;&nbsp;<img src='".evo_image('noright.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NONEXT']."' alt='".$lang_new[$module_name]['PAGE_NONEXT']."' border='0' /></a>";
    }
    echo "</center>";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>