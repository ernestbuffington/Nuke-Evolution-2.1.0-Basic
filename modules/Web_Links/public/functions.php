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

function WebLinksConfig() {
    global $db, $module_name, $cache, $lang_new;
    static $weblinksconfig;
    if(isset($weblinksconfig) && is_array($weblinksconfig)) {
        return $weblinksconfig;
    }
    if ((($weblinksconfig = $cache->load('WebLinks', 'config')) === false) || empty($weblinksconfig)) {
        $sql = 'SELECT `config_value`, `config_name` from `'._WEBLINKS_CONFIG_TABLE.'`' ;
        if(!$result = $db->sql_query($sql)) {
            DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $lang_new[$module_name]['ERROR_NO_CONFIG'] . $module_name);
        }
        while ($row = $db->sql_fetchrow($result)) {
            $weblinksconfig[$row['config_name']] = $row['config_value'];
        }
        $cache->save('WebLinks', 'config', $weblinksconfig);
        $db->sql_freeresult($result);
    }
    return $weblinksconfig;
}

function LinksHeading() {
    global $module_name, $lang_new;
    $text = '';
    if (!defined('MAINPAGE')) {
        $text .= "<a href='modules.php?name=$module_name'><img src='".evo_image('main.png', $module_name)."' title='".$lang_new[$module_name]['INDEX_PAGE']."' alt='".$lang_new[$module_name]['INDEX_PAGE']."' border='0' /></a>\n";
    }
    $text .= "&nbsp;<a href='modules.php?name=$module_name&amp;op=AddLink'><img src='".evo_image('add.png', $module_name)."' title='".$lang_new[$module_name]['LINK_SUBMIT']."' alt='".$lang_new[$module_name]['LINK_SUBMIT']."' border='0' /></a>\n";
    $text .= "&nbsp;<a href='modules.php?name=$module_name&amp;op=NewLinks'><img src='".evo_image('new.png', $module_name)."' title='".$lang_new[$module_name]['SHOW_NEWSLINKS']."' alt='".$lang_new[$module_name]['SHOW_NEWSLINKS']."' border='0' /></a>\n";
    $text .= "&nbsp;<a href='modules.php?name=$module_name&amp;op=MostPopular'><img src='".evo_image('popular.png', $module_name)."' title='".$lang_new[$module_name]['SHOW_MOSTPOPULAR']."' alt='".$lang_new[$module_name]['SHOW_MOSTPOPULAR']."' border='0' /></a>\n";
    $text .= "&nbsp;<a href='modules.php?name=$module_name&amp;op=TopRated'><img src='".evo_image('top.png', $module_name)."' title='".$lang_new[$module_name]['SHOW_TOPRATED']."' alt='".$lang_new[$module_name]['SHOW_TOPRATED']."' border='0' /></a>\n";
    $text .= "&nbsp;<a href='modules.php?name=$module_name&amp;op=RandomLink' target='_blank'><img src='".evo_image('random.png', $module_name)."' title='".$lang_new[$module_name]['SHOW_RANDOM']."' alt='".$lang_new[$module_name]['SHOW_RANDOM']."' border='0' /></a>\n";
    $text .= "<br />\n";
    $text .= "<div align='center'><form action='modules.php?name=$module_name&amp;op=search' method='post'>";
    $text .= "<table border='0' cellspacing='0' cellpadding='0' align='center'>";
    $text .= "<tr><td><span class='content'><input type='text' size='25' name='query' />&nbsp;<input type='submit' value='"._SEARCH."' /></span></td></tr>";
    $text .= "</table>";
    $text .= "</form></div>";
    title($text, $module_name, 'weblinks-logo.png');
}

function LinksLegend() {
    global $module_name, $lang_new;
    OpenTable();
    echo "<table align='center' cellpadding='2' cellspacing='2' border='0' width='100%'>\n";
    echo "<tr>\n";
    echo "<td align='center' width='25%'><img  src='".evo_image('new_01.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['NEW_TODAY']."</td>\n";
    echo "<td align='center' width='25%'><img  src='".evo_image('new_03.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['NEW_LAST3DAY']."</td>\n";
    echo "<td align='center' width='25%'><img  src='".evo_image('new_07.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['NEW_THISWEEK']."</td>\n";
    echo "<td align='center' width='25%'><img  src='".evo_image('small-popular.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['POPULAR']."</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    CloseTable();
    echo "<br />\n";
}

function linksgetparent($parentid,$title) {
    global $db;
    $parentid = intval($parentid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `cid`=".$parentid));
    $ptitle = $row['title'];
    $pparentid = intval($row['parentid']);
    if (!empty($ptitle)) {
        $title=$ptitle."&nbsp;-&gt;&nbsp;".$title;
    }
    if ($pparentid!=0) {
        $title=linksgetparent($pparentid,$title);
    }
    return $title;
}

function getparentlink($parentid,$title) {
    global $db, $module_name;
    $parentid = intval($parentid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `cid`=".$parentid));
    $cid = intval($row['cid']);
    $ptitle = stripslashes(check_html($row['title'], "nohtml"));
    $pparentid = intval($row['parentid']);
    if (!empty($ptitle)) {
        $title = "<a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=$cid'>$ptitle</a>/".$title;
    }
    if ($pparentid!=0) {
        $title = getparentlink($pparentid,$title);
    }
    return $title;
}

function linkinfomenu($lid, $ttitle) {
    global $db, $module_name, $lang_new, $weblinksconfig;
    $linkinfomenu = '<br /><br /><center>';
    $count_comments  = $db->sql_unumrows("SELECT `ratingdbid` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid` = '".$lid."' AND `ratingcomments` != '' ORDER BY `ratingtimestamp` DESC");
    $count_votes     = $db->sql_unumrows("SELECT `rating` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid` = '".$lid."'");
    $count_editorial = $db->sql_unumrows("SELECT `adminid` FROM `"._WEBLINKS_EDITORIALS_TABLE."` WHERE `linkid` = '".$lid."'");
    if ($count_comments > 0 || $count_votes > 0 || $count_editorial > 0) {
        $linkinfomenu .= "<span class='content'>[&nbsp;";
        if ($count_comments > 0) {
            $linkinfomenu .= "<a href='modules.php?name=".$module_name."&amp;op=viewlinkcomments&amp;lid=".$lid."&amp;ttitle=".$ttitle."'>".$lang_new[$module_name]['SHOW_LINK_COMMENTS']."</a>";
        }
        if ($count_votes > 0) {
            $linkinfomenu .= "&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=viewlinkdetails&amp;lid=".$lid."&amp;ttitle=".$ttitle."'>".$lang_new[$module_name]['DO_SHOW_DETAILS']."</a>";
        }
        if ($count_editorial > 0) {
            $linkinfomenu .= "&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=viewlinkeditorial&amp;lid=".$lid."&amp;ttitle=".$ttitle."'>".$lang_new[$module_name]['SHOW_EDITORIAL']."</a>";
        }
        $linkinfomenu .= "&nbsp;]</span></center><center>\n";
    }
    if (is_user() || $weblinksconfig['blockunregmodify'] == 0 ) {
        $linkinfomenu .= "<span class='content'>[&nbsp;";
        $linkinfomenu .= "<a href='modules.php?name=".$module_name."&amp;op=modifylinkrequest&amp;lid=".$lid."'>".$lang_new[$module_name]['MODIFY_LINK_REQUEST']."</a>";
        if (is_user()) {
            $linkinfomenu .= "&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=brokenlink&amp;lid=".$lid."'>".$lang_new[$module_name]['DO_REPORT_BROKEN']."</a>";
        }
        $linkinfomenu .= "&nbsp;]</span>\n";
    }
    $linkinfomenu .= "</center><center>";
    $linkinfomenu .= "<span class='content' style='target-new:tab;'>[&nbsp;<a href='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=".$lid."' >".$lang_new[$module_name]['VISIT']."</a></span><span class='content'>&nbsp;|&nbsp;<a href='modules.php?name=".$module_name."&amp;op=ratelink&amp;lid=".$lid."&amp;ttitle=".$ttitle."'>".$lang_new[$module_name]['DO_RATE']."</a> ]</span>";
    $linkinfomenu .= "</center>\n";
    if ($weblinksconfig['useoutsidevoting'] == 1) {
        $linkinfomenu .= "<center><span class='content'>".$lang_new[$module_name]['INFO_ISTHSYOURSITE']."&nbsp;<a href='modules.php?name=".$module_name."&amp;op=outsidelinksetup&amp;lid=".$lid."'>".$lang_new[$module_name]['INFO_ALLOW_TO_RATE']."</a></span></center>\n";
    }
    return $linkinfomenu;
}

function RandomLink() {
    global $db;
    $result = $db->sql_query("SELECT * FROM `"._WEBLINKS_LINKS_TABLE."`");
    $numrows = $db->sql_numrows($result);
    if ($numrows == 1) {
        $random = 1;
    } else {
        srand((double)microtime()*1000000);
        $random = rand(1,$numrows);
        $random = intval($random);
    }
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT `url` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='$random'"));
    $url = stripslashes($row2['url']);
    $db->sql_query("UPDATE `"._WEBLINKS_LINKS_TABLE."` SET `hits`=`hits`+1 WHERE `lid`='$random'");
    redirect($url);
}

function newlinkgraphic($time) {
    global $module_name, $lang_new;
    $startdate = time();
    $count = 0;
    $checktime = time() - $time;
    if ($checktime <= 86400 ) {
        return ("<img src='".evo_image('new_01.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['NEW_TODAY']."' />");
    } elseif ($checktime <= 259200) {
        return ("<img src='".evo_image('new_03.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['NEW_LAST3DAY']."' />");
    } elseif ($checktime <= 604800) {
        return ("<img src='".evo_image('new_07.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['NEW_THISWEEK']."' />");
    }
}

function categorynewlinkgraphic($cat) {
    global $db, $module_name, $lang_new;
    $cat = intval(trim($cat));
    $row = $db->sql_fetchrow($db->sql_query("SELECT `date` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `cid`='$cat' ORDER BY `date` DESC LIMIT 1"));
    $time = time() - $row['date'];
    if ($time <= 86400 ) {
        return ("<img src='".evo_image('new_01.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['NEW_TODAY']."' />");
    } elseif ($time <= 259200) {
        return ("<img src='".evo_image('new_03.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['NEW_LAST3DAY']."' />");
    } elseif ($time <= 604800) {
        return ("<img src='".evo_image('new_07.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['NEW_THISWEEK']."' />");
    }
}

function linkpopgraphic($hits) {
    global $module_name, $weblinksconfig, $lang_new;
    if ($hits >= $weblinksconfig['popular']) {
        return ("<img src='".evo_image('small-popular.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['POPULAR']."' />");
    }
}

function linkcategorypopgraphic($cat) {
    global $db, $module_name, $weblinksconfig, $lang_new;
    $cat = intval(trim($cat));
    $row = $db->sql_fetchrow($db->sql_query("SELECT `hits` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `cid`='$cat' ORDER BY `hits` DESC LIMIT 1"));
    if ($row['hits'] >= $weblinksconfig['popular']) {
        return ("<img src='".evo_image('small-popular.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['POPULAR']."' />");
    }
}

function linkconvertorderbyin($orderby) {
    if ($orderby != "titleA" AND $orderby != "dateA" AND $orderby != "hitsA" AND $orderby != "ratingA" AND $orderby != "titleD" AND $orderby != "dateD" AND $orderby != "hitsD" AND $orderby != "ratingD") {
        redirect("index.php");
    }
    if ($orderby == "titleA")    $orderby = "title ASC";
    if ($orderby == "dateA")    $orderby = "date ASC";
    if ($orderby == "hitsA")    $orderby = "hits ASC";
    if ($orderby == "ratingA")    $orderby = "linkratingsummary ASC";
    if ($orderby == "titleD")    $orderby = "title DESC";
    if ($orderby == "dateD")    $orderby = "date DESC";
    if ($orderby == "hitsD")    $orderby = "hits DESC";
    if ($orderby == "ratingD")    $orderby = "linkratingsummary DESC";
    return $orderby;
}

function linkconvertorderbytrans($orderby) {
    global $module_name, $lang_new;
    if ($orderby != "hits ASC" AND $orderby != "hits DESC" AND $orderby != "title ASC" AND $orderby != "title DESC" AND $orderby != "date ASC" AND $orderby != "date DESC" AND $orderby != "linkratingsummary ASC" AND $orderby != "linkratingsummary DESC") {
        redirect("index.php");
    }
    if ($orderby == "hits ASC")                 $orderbyTrans = $lang_new[$module_name]['SORTS_POPULARITY_UP'];
    if ($orderby == "hits DESC")                $orderbyTrans = $lang_new[$module_name]['SORTS_POPULARITY_DOWN'];
    if ($orderby == "title ASC")                $orderbyTrans = $lang_new[$module_name]['SORTS_TITLEAZ'];
    if ($orderby == "title DESC")               $orderbyTrans = $lang_new[$module_name]['SORTS_TITLEZA'];
    if ($orderby == "date ASC")                 $orderbyTrans = $lang_new[$module_name]['SORTS_DATE_UP'];
    if ($orderby == "date DESC")                $orderbyTrans = $lang_new[$module_name]['SORTS_DATE_DOWN'];
    if ($orderby == "linkratingsummary ASC")    $orderbyTrans = $lang_new[$module_name]['SORTS_RATING_UP'];
    if ($orderby == "linkratingsummary DESC")   $orderbyTrans = $lang_new[$module_name]['SORTS_RATING_DOWN'];
    return $orderbyTrans;
}

function linkconvertorderbyout($orderby) {
    if ($orderby != "title ASC" AND $orderby != "date ASC" AND $orderby != "hits ASC" AND $orderby != "linkratingsummary ASC" AND $orderby != "title DESC" AND $orderby != "date DESC" AND $orderby != "hits DESC" AND $orderby != "linkratingsummary DESC") {
        redirect("index.php");
    }
    if ($orderby == "title ASC")        $orderby = "titleA";
    if ($orderby == "date ASC")            $orderby = "dateA";
    if ($orderby == "hits ASC")            $orderby = "hitsA";
    if ($orderby == "linkratingsummary ASC")    $orderby = "ratingA";
    if ($orderby == "title DESC")        $orderby = "titleD";
    if ($orderby == "date DESC")        $orderby = "dateD";
    if ($orderby == "hits DESC")        $orderby = "hitsD";
    if ($orderby == "linkratingsummary DESC")    $orderby = "ratingD";
    return $orderby;
}

function LinkOrderLegend($orderbyTrans, $cid=0, $module='viewlink') {
  global $module_name, $lang_new;
  echo "<center><span class='content'>".$lang_new[$module_name]['SORTS_BY'].": "
        .$lang_new[$module_name]['TITLE']." (<a href='modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=titleA'><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href='modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=titleD'><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>) "
        .$lang_new[$module_name]['DATE']." (<a href='modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=dateA'><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href='modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=dateD'><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>) "
        .$lang_new[$module_name]['RATING']." (<a href='modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=ratingA'><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href='modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=ratingD'><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>) "
        .$lang_new[$module_name]['POPULAR']." (<a href='modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=hitsA'><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href='modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=hitsD'><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>)"
        ."<br /><strong>".$lang_new[$module_name]['SORTS_IS'].": $orderbyTrans</strong></span></center><br /><br />";

}

function linkvisit($lid) {
    global $db;
    $lid = intval($lid);
    $db->sql_query("UPDATE `"._WEBLINKS_LINKS_TABLE."` SET `hits`=`hits`+1 WHERE `lid`='$lid'");
    $row = $db->sql_fetchrow($db->sql_query("SELECT `url` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='$lid'"));
    $url = stripslashes($row['url']);
    redirect($url);
}

function linkdetecteditorial($lid, $ttitle) {
    global $db, $module_name, $lang_new;
    $lid = intval($lid);
    $returnstring = '';
    $resulted2 = $db->sql_query("SELECT `adminid` FROM `"._WEBLINKS_EDITORIALS_TABLE."` WHERE linkid='$lid'");
    $recordexist = $db->sql_numrows($resulted2);
    if ($recordexist != 0) {
        $returnstring = "<a href='modules.php?name=$module_name&amp;op=viewlinkeditorial&amp;lid=$lid&amp;ttitle=$ttitle'><img src='".evo_image('editorial.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['EDITORIAL']."' title='".$lang_new[$module_name]['EDITORIAL']."' /></a>";
    }
    return ($returnstring);
}

function WeblinksDisplayScore($score) {
    global $module_name;
    $image = "<img src='".evo_image('full.png', $module_name)."' title='' alt='' />\n";
    $halfimage = "<img src='".evo_image('half.png', $module_name)."' title='' alt='' />\n";
    $full = "<img src='".evo_image('full.png', $module_name)."' title='' alt='' />\n";
    $null = "<img src='".evo_image('null.png', $module_name)."' title='' alt='' />\n";
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

function linkfooter($lid,$ttitle) {
    return;
}

function brokenlinkS($lid,$cid, $title, $image, $url, $description) {
    global $db, $module_name, $userinfo, $cache, $_GETVAR, $lang_new, $weblinksconfig;
    if (!security_code_check($_POST['gfx_check'], 'force') && $weblinksconfig['securitycheck'] == 1) {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
    }
    if (is_user()) {
        $ratinguser = $userinfo['username'];
        $lid = intval($lid);
        $cid = intval($cid);
        $db->sql_query("INSERT INTO `"._WEBLINKS_MODREQUEST_TABLE."` (`requestid`, `lid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `modifysubmitter`, `brokenlink`, `date`)
                VALUES (NULL, '$lid', '$cid', '0', '".$_GETVAR->fixQuotes($title)."', '".$_GETVAR->fixQuotes($image)."', '".$_GETVAR->fixQuotes($url)."', '".$_GETVAR->fixQuotes($description)."', '".$_GETVAR->fixQuotes($ratinguser)."', '1', '".time()."')");
        $cache->delete('numbrokenl', 'submissions');
        $cache->delete('nummodreql', 'submissions');
        include_once(NUKE_BASE_DIR.'header.php');
        LinksHeading();
        OpenTable();
        echo "<br /><center>".$lang_new[$module_name]['INFO_THANKS']."<br /><br />".$lang_new[$module_name]['INFO_LOOK_AFTER']."</center><br />";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        redirect("modules.php?name=$module_name");
    }
}

function modifylinkrequestS($lid, $cat, $title, $image, $url, $description, $modifysubmitter) {
    global $db, $module_name, $userinfo, $cache, $weblinksconfig, $lang_new, $_GETVAR;
    if (!security_code_check($_POST['gfx_check'], 'force') && $weblinksconfig['securitycheck'] == 1) {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
    }
    if ( ($weblinksconfig['blockunregmodify'] == 1) && empty($modifysubmitter)) {
        include_once(NUKE_BASE_DIR.'header.php');
        LinksHeading();
        echo "<br />";
        OpenTable();
        echo "<center><span class='content'>".$lang_new[$module_name]['INFO_ONLYREGISTERED']."</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $cat = explode("-", $cat);
        if (empty($cat[1])) {
            $cat[1] = 0;
        }
        $lid = intval($lid);
        $cat[0] = intval($cat[0]);
        $cat[1] = intval($cat[1]);
        $db->sql_query("INSERT INTO `"._WEBLINKS_MODREQUEST_TABLE."`
                      (`requestid`, `lid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `modifysubmitter`, `date`)
                      VALUES (NULL, '$lid', '$cat[0]', '$cat[1]', '".$_GETVAR->fixQuotes($title)."', '".$_GETVAR->fixQuotes($image)."', '".$_GETVAR->fixQuotes($url)."', '".$_GETVAR->fixQuotes($description)."', '".$_GETVAR->fixQuotes($modifysubmitter)."', '".time()."')");
        $cache->delete('numbrokenl', 'submissions');
        $cache->delete('nummodreql', 'submissions');
        include_once(NUKE_BASE_DIR.'header.php');
    LinksHeading();
    echo "<br />";
    OpenTable();
        echo "<center><span class='content'>".$lang_new[$module_name]['INFO_THANKS']."<br />".$lang_new[$module_name]['INFO_LOOK_AFTER']."</span></center>";
        CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    }
}

function linkrateinfo($lid) {
    global $db;
    $lid = intval($lid);
    $db->sql_query("UPDATE `"._WEBLINKS_LINKS_TABLE."` SET `hits`=`hits`+1 WHERE `lid`='$lid'");
    $row = $db->sql_fetchrow($db->sql_query("SELECT `url` FROM "._WEBLINKS_LINKS_TABLE."` WHERE `lid`='$lid'"));
    $url = stripslashes($row['url']);
    redirect($url);
}


function linkcompletevote($error) {
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

function linkshowsingle($lid) {
    global $db, $module_name, $lang_new, $weblinksconfig;
    $result = $db->sql_query("SELECT `lid`, `title`, `image`, `description`, `date`, `hits`, `name`, `url` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='$lid'");
    $row4   = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $lid    = intval($row4['lid']);
    $title  = set_smilies(decode_bbcode(stripslashes($row4['title']), 1, true));
    $description = evo_img_tag_to_resize(set_smilies(decode_bbcode(htmlentities($row4['description'], ENT_NOQUOTES, 'UTF-8'), 1, true)));
    $image  = htmlentities($row4['image']);
    $url    = $row4['url'];
    $time   = $row4['date'];
    $datetime = formatTimeStamp($time);
    $hits   = intval($row4['hits']);
    $submitter = UsernameColor($row4['name']);
    echo "<table width='100%' cellspacing='0' cellpadding='10' border='0'>\n";
    echo "<tr><td width='10%'>\n";
    echo "<table width='100%' border='0'><tr><td>\n";
    if($image!='http://' && !empty($image) ){
        echo "<a href='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=$lid' target='_blank'><img src='".$image."' width='".$weblinksconfig['image_width']."' height='".$weblinksconfig['image_height']."' border='0' alt='' title='".$lang_new[$module_name]['VISIT']."' align='middle' /></a>";
    }elseif ( $weblinksconfig['thumbnail_use'] && !empty($weblinksconfig['thumbnail_url']) ) {
        echo "<a href='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=".$lid."' target='_blank'><img src='".$weblinksconfig['thumbnail_url'].$url."' width='".$weblinksconfig['image_width']."' height='".$weblinksconfig['image_height']."'  border='0' title='".$lang_new[$module_name]['VISIT']."' alt='' /></a>";
    }else{
        echo "<a href='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=$lid' target='_blank'><img src='".evo_image('blank.gif', $module_name)."' width='".$weblinksconfig['image_width']."' height='".$weblinksconfig['image_height']."'  border='0' alt='' title='".$lang_new[$module_name]['VISIT']."' /></a>";
    }
    echo "</td></tr></table>\n";
    echo "</td>\n";
    echo "<td width='90%'>\n";
    echo "<fieldset><table width='100%' cellspacing='0' cellpadding='0' border='0'>\n";
    echo "<tr><td height='20' bgcolor='".$weblinksconfig['tablecolor1']."'><img src='".evo_image('link.png', $module_name)."' alt='' />&nbsp;<span class='content'><a href='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=".$lid."' target='_blank'><strong>".$title."</strong></a></span>";
    newlinkgraphic($datetime, $time);
    linkpopgraphic($hits);
    echo "</td></tr>\n";
    echo "<tr><td align='left'><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong></td></tr>\n";
    echo "<tr><td><table width='100%'><tr><td>".$description."</td></tr></table></td></tr>\n";
    echo "</table>";
    echo "<table bgcolor='".$weblinksconfig['tablecolor1']."' width='100%' cellspacing='0' cellpadding='2' border='0'>\n";
    echo "<tr>";
    echo "<td width='50%' height='20'><img src='".evo_image('date.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['LINK_SUBMIT_DATE']."' />&nbsp;".$datetime."</td>\n";
    echo "<td width='50%'>".$lang_new[$module_name]['AUTHOR'] ."&nbsp;".$submitter."</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "</fieldset>";
    echo "</td></tr>";
    echo "</table>\n";
}

?>