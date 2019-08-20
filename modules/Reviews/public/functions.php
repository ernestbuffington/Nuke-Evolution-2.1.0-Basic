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

function ReviewsConfig() {
    global $db, $module_name, $cache, $lang_new;
    static $reviewsconfig;
    if(isset($reviewsconfig) && is_array($reviewsconfig)) { 
        return $reviewsconfig; 
    }
    if ((($reviewsconfig = $cache->load('Reviews', 'config')) === false) || empty($reviewsconfig)) {
        $sql = 'SELECT `config_value`, `config_name` from `'._REVIEWS_CONFIG_TABLE.'`' ;
        if(!$result = $db->sql_query($sql)) {
            DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $lang_new[$module_name]['ERROR_NO_CONFIG'] . $module_name);
        }
        while ($row = $db->sql_fetchrow($result)) {
            $reviewsconfig[$row['config_name']] = $row['config_value'];
        }
        $cache->save('Reviews', 'config', $reviewsconfig);
        $db->sql_freeresult($result);
    }
    return $reviewsconfig;
}

function ReviewHeading() {
    global $module_name, $lang_new;
    $text = '';
    if (!defined('MAINPAGE')) {
      $text .= "<a href=\"modules.php?name=$module_name\"><img src=\"".evo_image('main.png', $module_name)."\" title=\"".$lang_new[$module_name]['INDEX_PAGE']."\" alt=\"".$lang_new[$module_name]['INDEX_PAGE']."\" border=\"0\" /></a>\n";
    }
    $text .= "&nbsp;<a href=\"modules.php?name=$module_name&amp;op=AddReview\"><img src=\"".evo_image('add.png', $module_name)."\" title=\"".$lang_new[$module_name]['REVIEW_SUBMIT']."\" alt=\"".$lang_new[$module_name]['REVIEW_SUBMIT']."\" border=\"0\" /></a>\n";
    $text .= "&nbsp;<a href=\"modules.php?name=$module_name&amp;op=NewReviews\"><img src=\"".evo_image('new.png', $module_name)."\" title=\"".$lang_new[$module_name]['SHOW_NEWSREVIEWS']."\" alt=\"".$lang_new[$module_name]['SHOW_NEWSREVIEWS']."\" border=\"0\" /></a>\n";
    $text .= "&nbsp;<a href=\"modules.php?name=$module_name&amp;op=MostPopular\"><img src=\"".evo_image('popular.png', $module_name)."\" title=\"".$lang_new[$module_name]['SHOW_MOSTPOPULAR']."\" alt=\"".$lang_new[$module_name]['SHOW_MOSTPOPULAR']."\" border=\"0\" /></a>\n";
    $text .= "&nbsp;<a href=\"modules.php?name=$module_name&amp;op=TopRated\"><img src=\"".evo_image('top.png', $module_name)."\" title=\"".$lang_new[$module_name]['SHOW_TOPRATED']."\" alt=\"".$lang_new[$module_name]['SHOW_TOPRATED']."\" border=\"0\" /></a>\n";
    $text .= "<br />\n";
    $text .= "<div align=\"center\"><form action=\"modules.php?name=$module_name&amp;op=search\" method=\"post\">";
    $text .="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">";
    $text .="<tr><td><span class=\"content\"><input type=\"text\" size=\"25\" name=\"query\" />&nbsp;<input type=\"submit\" value=\""._SEARCH."\" /></span></td></tr>";
    $text .="</table>";
    $text .="</form></div>";
    title($text, $module_name, 'reviews-logo.png');
}

function ReviewLegend() {
    global $module_name, $lang_new;
    OpenTable();
    echo "<table align='center' cellpadding='2' cellspacing='2' border='0' width='100%'>\n";
    echo "<tr>\n";
    echo "<td align='center' width='25%'><img src='".evo_image('new_01.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['NEW_TODAY']."</td>\n";
    echo "<td align='center' width='25%'><img src='".evo_image('new_03.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['NEW_LAST3DAY']."</td>\n";
    echo "<td align='center' width='25%'><img src='".evo_image('new_07.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['NEW_THISWEEK']."</td>\n";
    echo "<td align='center' width='25%'><img src='".evo_image('small-popular.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['POPULAR']."</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    CloseTable();
    echo "<br />\n";
}

function reviewgetparent($parentid,$title) {
    global $db;
    $parentid = intval($parentid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid`=".$parentid));
    $ptitle = $row['title'];
    $pparentid = intval($row['parentid']);
    if (!empty($ptitle)) {
        $title=$ptitle."&nbsp;-&gt;&nbsp;".$title;
    }
    if ($pparentid!=0) {
        $title=reviewgetparent($pparentid,$title);
    }
    return $title;
}

function getparentreview($parentid,$title) {
    global $db, $module_name;
    $parentid = intval($parentid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid`=".$parentid));
    $cid = intval($row['cid']);
    $ptitle = stripslashes(check_html($row['title'], "nohtml"));
    $pparentid = intval($row['parentid']);
    if (!empty($ptitle)) {
        $title = "<a href=modules.php?name=".$module_name."&amp;op=viewreview&amp;cid=$cid>$ptitle</a>/".$title;
    }
    if ($pparentid!=0) {
        $title = getparentreview($pparentid,$title);
    }
    return $title;
}

function reviewinfomenu($rid, $ttitle) {
    global $db, $module_name, $lang_new, $reviewsconfig;
    $reviewinfomenu = '<br /><br /><center>';
    $count_comments  = $db->sql_unumrows("SELECT `ratingdbid` FROM `"._REVIEWS_VOTEDATA_TABLE."` WHERE `ratingrid` = '".$rid."' AND `ratingcomments` != '' ORDER BY `ratingtimestamp` DESC");
    $count_votes     = $db->sql_unumrows("SELECT `rating` FROM `"._REVIEWS_VOTEDATA_TABLE."` WHERE `ratingrid` = '".$rid."'");
    $count_editorial = $db->sql_unumrows("SELECT `adminid` FROM `"._REVIEWS_EDITORIALS_TABLE."` WHERE `reviewid` = '".$rid."'");
    if ($count_comments > 0 || $count_votes > 0 || $count_editorial > 0) {
        $reviewinfomenu .= "<span class='content'>[&nbsp;";
        if ($count_comments > 0) {
            $reviewinfomenu .= "<a href='modules.php?name=$module_name&amp;op=viewreviewcomments&amp;rid=".$rid."&amp;ttitle=".$ttitle."'>".$lang_new[$module_name]['SHOW_REVIEW_COMMENTS']."</a>";
        }
        if ($count_votes > 0) {
            $reviewinfomenu .= "&nbsp;|&nbsp;<a href='modules.php?name=$module_name&amp;op=viewreviewdetails&amp;rid=".$rid."&amp;ttitle=".$ttitle."'>".$lang_new[$module_name]['DO_SHOW_DETAILS']."</a>";
        }
        if ($count_editorial > 0) {
            $reviewinfomenu .= "&nbsp;|&nbsp;<a href='modules.php?name=$module_name&amp;op=viewrevieweditorial&amp;rid=".$rid."&amp;ttitle=".$ttitle."'>".$lang_new[$module_name]['SHOW_EDITORIAL']."</a>";
        }
        $reviewinfomenu .= "&nbsp;]</span></center><center>\n";
    }
    if (is_user() || $reviewsconfig['blockunregmodify'] == 0 ) {
        $reviewinfomenu .= "<span class='content'>[&nbsp;";
        $reviewinfomenu .= "<a href='modules.php?name=".$module_name."&amp;op=modifyreviewrequest&amp;rid=".$rid."'>".$lang_new[$module_name]['MODIFY_REVIEW_REQUEST']."</a>";
        if (is_user()) {
            $reviewinfomenu .= "&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=brokenreview&amp;rid=".$rid."'>".$lang_new[$module_name]['DO_REPORT_BROKEN']."</a>";
        }
        $reviewinfomenu .= "&nbsp;]</span>\n";
    }
    $reviewinfomenu .= "</center><center>";
    $reviewinfomenu .= "<span class='content' style='target-new:tab;'>[&nbsp;<a href='modules.php?name=".$module_name."&amp;op=linkvisit&amp;rid=".$rid."' >".$lang_new[$module_name]['VISIT']."</a></span><span class='content'>&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=ratereview&amp;rid=".$rid."&amp;ttitle=".$ttitle."'>".$lang_new[$module_name]['DO_RATE']."</a> ]</span>";
    $reviewinfomenu .= "</center>\n";
    if ($reviewsconfig['useoutsidevoting'] == 1) {
        $reviewinfomenu .= "<center><span class='content'>".$lang_new[$module_name]['INFO_ISTHSYOURSITE']."&nbsp;<a href='modules.php?name=".$module_name."&amp;op=outsidereviewsetup&amp;rid=".$rid."'>".$lang_new[$module_name]['INFO_ALLOW_TO_RATE']."</a></span></center>\n";
    }
    return $reviewinfomenu;
}

function RandomReview() {
    global $db;
    $result = $db->sql_query("SELECT * FROM `"._REVIEWS_REVIEWS_TABLE."`");
    $numrows = $db->sql_numrows($result);
    if ($numrows == 1) {
        $random = 1;
    } else {
        srand((double)microtime()*1000000);
        $random = rand(1,$numrows);
        $random = intval($random);
    }
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT `url` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='$random'"));
    $url = stripslashes($row2['url']);
    $db->sql_query("UPDATE `"._REVIEWS_REVIEWS_TABLE."` SET `hits`=`hits`+1 WHERE `rid`='$random'");
    redirect($url);
}

function newreviewgraphic($time) {
    global $module_name, $lang_new;
    $startdate = time();
    $count = 0;
    $checktime = time() - $time;
    if ($checktime <= 86400 ) {
        return ("<img src=\"".evo_image('new_01.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_TODAY']."\" />");
    } elseif ($checktime <= 259200) {
        return ("<img src=\"".evo_image('new_03.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_LAST3DAY']."\" />");
    } elseif ($checktime <= 604800) {
        return ("<img src=\"".evo_image('new_07.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_THISWEEK']."\" />");
    }
}

function categorynewreviewgraphic($cat) {
    global $db, $module_name, $lang_new;
    $cat = intval(trim($cat));
    $row = $db->sql_fetchrow($db->sql_query("SELECT `date` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$cat' ORDER BY `date` DESC LIMIT 1"));
    $time = time() - $row['date'];
    if ($time <= 86400 ) {
        return ("<img src=\"".evo_image('new_01.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_TODAY']."\" />");
    } elseif ($time <= 259200) {
        return ("<img src=\"".evo_image('new_03.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_LAST3DAY']."\" />");
    } elseif ($time <= 604800) {
        return ("<img src=\"".evo_image('new_07.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_THISWEEK']."\" />");
    }
}

function reviewpopgraphic($hits) {
    global $module_name, $reviewsconfig, $lang_new;
    if ($hits >= $reviewsconfig['popular']) {
        return ("<img src=\"".evo_image('small-popular.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['POPULAR']."\" />");
    }
}

function reviewcategorypopgraphic($cat) {
    global $db, $module_name, $reviewsconfig, $lang_new;
    $cat = intval(trim($cat));
    $row = $db->sql_fetchrow($db->sql_query("SELECT `hits` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$cat' ORDER BY `hits` DESC LIMIT 1"));
    if ($row['hits'] >= $reviewsconfig['popular']) {
        return ("<img src=\"".evo_image('small-popular.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['POPULAR']."\" />");
    }
}

function reviewconvertorderbyin($orderby) {
    if ($orderby != "titleA" AND $orderby != "dateA" AND $orderby != "hitsA" AND $orderby != "ratingA" AND $orderby != "titleD" AND $orderby != "dateD" AND $orderby != "hitsD" AND $orderby != "ratingD") {
        redirect("index.php");
    }
    if ($orderby == "titleA")    $orderby = "title ASC";
    if ($orderby == "dateA")    $orderby = "date ASC";
    if ($orderby == "hitsA")    $orderby = "hits ASC";
    if ($orderby == "ratingA")    $orderby = "reviewratingsummary ASC";
    if ($orderby == "titleD")    $orderby = "title DESC";
    if ($orderby == "dateD")    $orderby = "date DESC";
    if ($orderby == "hitsD")    $orderby = "hits DESC";
    if ($orderby == "ratingD")    $orderby = "reviewratingsummary DESC";
    return $orderby;
}

function reviewconvertorderbytrans($orderby) {
    global $module_name, $lang_new;
    if ($orderby != "hits ASC" AND $orderby != "hits DESC" AND $orderby != "title ASC" AND $orderby != "title DESC" AND $orderby != "date ASC" AND $orderby != "date DESC" AND $orderby != "reviewratingsummary ASC" AND $orderby != "reviewratingsummary DESC") {
        redirect("index.php");
    }
    if ($orderby == "hits ASC")                 $orderbyTrans = $lang_new[$module_name]['SORTS_POPULARITY_UP'];
    if ($orderby == "hits DESC")                $orderbyTrans = $lang_new[$module_name]['SORTS_POPULARITY_DOWN'];
    if ($orderby == "title ASC")                $orderbyTrans = $lang_new[$module_name]['SORTS_TITLEAZ'];
    if ($orderby == "title DESC")               $orderbyTrans = $lang_new[$module_name]['SORTS_TITLEZA'];
    if ($orderby == "date ASC")                 $orderbyTrans = $lang_new[$module_name]['SORTS_DATE_UP'];
    if ($orderby == "date DESC")                $orderbyTrans = $lang_new[$module_name]['SORTS_DATE_DOWN'];
    if ($orderby == "reviewratingsummary ASC")    $orderbyTrans = $lang_new[$module_name]['SORTS_RATING_UP'];
    if ($orderby == "reviewratingsummary DESC")   $orderbyTrans = $lang_new[$module_name]['SORTS_RATING_DOWN'];
    return $orderbyTrans;
}

function reviewconvertorderbyout($orderby) {
    if ($orderby != "title ASC" AND $orderby != "date ASC" AND $orderby != "hits ASC" AND $orderby != "reviewratingsummary ASC" AND $orderby != "title DESC" AND $orderby != "date DESC" AND $orderby != "hits DESC" AND $orderby != "reviewratingsummary DESC") {
        redirect("index.php");
    }
    if ($orderby == "title ASC")        $orderby = "titleA";
    if ($orderby == "date ASC")            $orderby = "dateA";
    if ($orderby == "hits ASC")            $orderby = "hitsA";
    if ($orderby == "reviewratingsummary ASC")    $orderby = "ratingA";
    if ($orderby == "title DESC")        $orderby = "titleD";
    if ($orderby == "date DESC")        $orderby = "dateD";
    if ($orderby == "hits DESC")        $orderby = "hitsD";
    if ($orderby == "reviewratingsummary DESC")    $orderby = "ratingD";
    return $orderby;
}

function ReviewOrderLegend($orderbyTrans, $cid=0, $module='viewreview') {
  global $module_name, $lang_new;
  echo "<center><span class=\"content\">".$lang_new[$module_name]['SORTS_BY'].": "
        .$lang_new[$module_name]['TITLE']." (<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=titleA\"><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=titleD\"><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>) "
        .$lang_new[$module_name]['DATE']." (<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=dateA\"><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=dateD\"><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>) "
        .$lang_new[$module_name]['RATING']." (<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=ratingA\"><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=ratingD\"><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>) "
        .$lang_new[$module_name]['POPULAR']." (<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=hitsA\"><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=hitsD\"><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>)"
        ."<br /><strong>".$lang_new[$module_name]['SORTS_IS'].": $orderbyTrans</strong></span></center><br /><br />";

}

function reviewvisit($rid) {
    global $db, $module_name;
    $rid = intval($rid);
    $db->sql_query("UPDATE `"._REVIEWS_REVIEWS_TABLE."` SET `hits`=`hits`+1 WHERE `rid`='$rid'");
    $row = $db->sql_fetchrow($db->sql_query("SELECT `url` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='$rid'"));
    $url = stripslashes($row['url']);
    if (!empty($url)) {
        redirect($url);
    } else {
        redirect("modules.php?name=$module_name&amp;op=showreview&amp;rid=$rid");
    }
}

function reviewdetecteditorial($rid, $ttitle) {
    global $db, $module_name, $lang_new;
    $rid = intval($rid);
    $returnstring = '';
    $resulted2 = $db->sql_query("SELECT `adminid` FROM `"._REVIEWS_EDITORIALS_TABLE."` WHERE reviewid='$rid'");
    $recordexist = $db->sql_numrows($resulted2);
    if ($recordexist != 0) {
        $returnstring = "<a href=\"modules.php?name=$module_name&amp;op=viewrevieweditorial&amp;rid=$rid&amp;ttitle=$ttitle\"><img src=\"".evo_image('editorial.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['EDITORIAL']."\" title=\"".$lang_new[$module_name]['EDITORIAL']."\" /></a>";
    }
    return ($returnstring);
}

function ReviewsDisplayScore($score) {
    global $module_name;
    $image = "<img src=\"".evo_image('full.png', $module_name)."\" title=\"\" alt=\"\" />\n";
    $halfimage = "<img src=\"".evo_image('half.png', $module_name)."\" title=\"\" alt=\"\" />\n";
    $full = "<img src=\"".evo_image('full.png', $module_name)."\" title=\"\" alt=\"\" />\n";
    $null = "<img src=\"".evo_image('null.png', $module_name)."\" title=\"\" alt=\"\" />\n";
    $scoreimage = '';
    if ($score == 10) {
        for ($i=0; $i < 5; $i++)
            $scoreimage .= $full;
     } else if ($score % 2) {
        $score -= 1;
        $score /= 2;
        for ($i=0; $i < $score; $i++)
            $scoreimage .= $image;
            $scoreimage .=  $halfimage;
        $score = 4 - $score;
        for ($i=0; $i < $score; $i++)
            $scoreimage .=  $null;
    } else {
        $score /= 2;
        for ($i=0; $i < $score; $i++)
            $scoreimage .=  $image;
        $score = 5 - $score;
        for ($i=0; $i < $score; $i++)
            $scoreimage .=  $null;
    }
    return($scoreimage);
}

function reviewfooter($rid,$ttitle) {
    return;
}

function brokenreviewS($rid,$cid, $title, $image, $url, $description, $reviewheader, $reviewbody, $reviewfooter, $reviewsignature, $submitter) {
    global $db, $module_name, $userinfo, $cache, $_GETVAR, $lang_new, $reviewsconfig;
    if (!security_code_check($_POST['gfx_check'], 'force') && $reviewsconfig['securitycheck'] == 1) {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
    }
    if (is_user()) {
        $ratinguser = $userinfo['username'];
        $rid = intval($rid);
        $cid = intval($cid);
        $db->sql_query("INSERT INTO `"._REVIEWS_MODREQUEST_TABLE."` (`requestid`, `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `modifysubmitter`, `brokenreview`, `date`)
                VALUES (NULL, '$rid', '$cid', '0', '".$_GETVAR->fixQuotes($title)."', '".$_GETVAR->fixQuotes($image)."', '".$_GETVAR->fixQuotes($url)."', '".$_GETVAR->fixQuotes($description)."', '".$_GETVAR->fixQuotes($ratinguser)."', '1', '".time()."')");
        $cache->delete('numbrokenr', 'submissions');
        $cache->delete('nummodreqr', 'submissions');
        include_once(NUKE_BASE_DIR.'header.php');
        ReviewHeading();
        OpenTable();
        echo "<br /><center>".$lang_new[$module_name]['INFO_THANKS']."<br /><br />".$lang_new[$module_name]['INFO_LOOK_AFTER']."</center><br />";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        redirect("modules.php?name=$module_name");
    }
}

function modifyreviewrequestS($rid, $cat, $title, $image, $url, $description, $modifysubmitter) {
    global $db, $module_name, $userinfo, $cache, $reviewsconfig, $lang_new, $_GETVAR;
    if (!security_code_check($_POST['gfx_check'], 'force') && $reviewsconfig['securitycheck'] == 1) {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
    }
    if ( ($reviewsconfig['blockunregmodify'] == 1) && empty($modifysubmitter)) {
        include_once(NUKE_BASE_DIR.'header.php');
        ReviewHeading();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"content\">".$lang_new[$module_name]['INFO_ONLYREGISTERED']."</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $cat = explode("-", $cat);
        if (empty($cat[1])) {
            $cat[1] = 0;
        }
        $rid = intval($rid);
        $cat[0] = intval($cat[0]);
        $cat[1] = intval($cat[1]);
        $db->sql_query("INSERT INTO `"._REVIEWS_MODREQUEST_TABLE."`
                      (`requestid`, `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `modifysubmitter`, `date`)
                      VALUES (NULL, '$rid', '$cat[0]', '$cat[1]', '".$_GETVAR->fixQuotes($title)."', '".$_GETVAR->fixQuotes($image)."', '".$_GETVAR->fixQuotes($url)."', '".$_GETVAR->fixQuotes($description)."', '".$_GETVAR->fixQuotes($modifysubmitter)."', '".time()."')");
        $cache->delete('numbrokenr', 'submissions');
        $cache->delete('nummodreqr', 'submissions');
        include_once(NUKE_BASE_DIR.'header.php');
    ReviewHeading();
    echo "<br />";
    OpenTable();
        echo "<center><span class=\"content\">".$lang_new[$module_name]['INFO_THANKS']."<br />".$lang_new[$module_name]['INFO_LOOK_AFTER']."</span></center>";
        CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    }
}

function reviewrateinfo($rid) {
    global $db;
    $rid = intval($rid);
    $db->sql_query("UPDATE `"._REVIEWS_REVIEWS_TABLE."` SET `hits`=`hits`+1 WHERE `rid`='$rid'");
    $row = $db->sql_fetchrow($db->sql_query("SELECT `url` FROM "._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='$rid'"));
    $url = stripslashes($row['url']);
    redirect($url);
}

function reviewcompletevote($error) {
    global $module_name, $lang_new;
    OpenTable2();
    if ($error == 'none') echo "<center><strong>".$lang_new[$module_name]['INFO_RATE_COMPLETED_OK']."</strong></center><br />";
    if ($error == 'anonflood') echo "<center><strong>".$lang_new[$module_name]['WARN_RATE_COMPLETED_TOSHORT']."</strong></center><br />";
    if ($error == 'regflood') echo "<center><strong>".$lang_new[$module_name]['WARN_RATE_ONLY_ONCE']."</strong></center><br />";
    if ($error == 'postervote') echo "<center><strong>".$lang_new[$module_name]['WARN_RATE_NOT_SELF']."</strong></center><br />";
    if ($error == 'nullerror') echo "<center><strong>".$lang_new[$module_name]['WARN_RATE_NO_SELECTED']."</strong></center><br />";
    if ($error == 'outsideflood') echo "<center><strong>".$lang_new[$module_name]['WARN_RATE_OUTSIDE_TOSHORT']."</strong></center><br />";
    CloseTable2();
    if ($error != 'none') {
        echo "<br /><center><strong>".$lang_new[$module_name]['SUBMIT_GOBACK']."</strong></center><br />";
    }
}

function reviewshowsingle($rid) {
    global $db, $module_name, $lang_new, $reviewsconfig;
    $mypage = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`=".$rid));
    $mycid          = intval($mypage['cid']);
    $mytitle        = set_smilies(decode_bbcode(stripslashes(check_html($mypage['title'], "nohtml")), 1));
    $mydescription  = set_smilies(decode_bbcode(stripslashes($mypage['description']), 1, true));
    $mydescription  = evo_img_tag_to_resize($mydescription);
    $mypage_header  = set_smilies(decode_bbcode(stripslashes($mypage['header']), 1, true));
    $mypage_header  = evo_img_tag_to_resize($mypage_header);
    $mytext         = set_smilies(decode_bbcode(stripslashes($mypage['body']), 1, true));
    $mytext         = evo_img_tag_to_resize($mytext);
    $mypage_footer  = set_smilies(decode_bbcode(stripslashes($mypage['footer']), 1, true));
    $mypage_footer  = evo_img_tag_to_resize($mypage_footer);
    $mysignature    = set_smilies(decode_bbcode(stripslashes($mypage['signature']), 1, true));
    $mysignature    = evo_img_tag_to_resize($mysignature);
    $mydate         = $mypage['date'];
    $mycounter      = intval($mypage['hits']);
    $mysubmitter    = "<a href='modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$mypage['submitter']."'>".UsernameColor($mypage['submitter'])."</a>";
    $date = formatTimestamp($mydate);
    echo "<center><strong><span class='title'>".$mytitle."</span><br />";
    echo "<span class='content'>".$mydescription."</span></strong></center><br />";
    echo "<table width='100%'><tr><td width='50%' align='left'>";
    echo "<span style='font-size: xx-small;'>".$lang_new[$module_name]['COPYRIGHT']."<br />".EVO_SERVER_SITENAME."<br />".$lang_new[$module_name]['COPYRIGHT2']."</span></td>";
    echo "<td width='50%' align='right'>";
    echo "<span style='font-size: xx-small;'>".$lang_new[$module_name]['REVIEW_SUBMIT_DATE'].":<br />".$date."<br />".$lang_new[$module_name]['BY'].":&nbsp;".$mysubmitter."<br />(".$mycounter."&nbsp;".$lang_new[$module_name]['HITS'].")</span>";
    echo "</td></tr></table>";
    return;
}

?>