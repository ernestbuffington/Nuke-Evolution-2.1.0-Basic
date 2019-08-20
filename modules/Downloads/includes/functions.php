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

if (!defined('MODULE_FILE') && !defined('DOWNLOADS_INDEX_FILE') && !defined('ADMIN_FILE')) {
   die('You can\'t access this file directly...');
}

function DownloadsConfig(){
  global $db, $module_name, $cache, $lang_new;
  static $downloadsconfig;
    if(isset($downloadsconfig) && is_array($downloadsconfig)) { return $downloadsconfig; }
    if ((($downloadsconfig = $cache->load('Downloads', 'config')) === false) || empty($downloadsconfig)) {
        $sql = 'SELECT `config_value`, `config_name` from `'._DOWNLOADS_CONFIG_TABLE.'`' ;
        if(!$result = $db->sql_query($sql)) {
            DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $lang_new[$module_name]['ERROR_NO_CONFIG'] . $module_name);
        }
        while ($row = $db->sql_fetchrow($result)) {
            $downloadsconfig[$row['config_name']] = $row['config_value'];
        }
        $cache->save('Downloads', 'config', $downloadsconfig);
        $db->sql_freeresult($result);
    }
    return $downloadsconfig;
}

function DownloadsHeading() {
    global $db, $module_name, $lang_new, $more_js, $more_styles;

    include_once(NUKE_BASE_DIR.'header.php'); 
    
    $sql = $db->sql_ufetchrow("SELECT `cid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `catactive`=1 AND `canupload`=1 ");
    $sql = (!is_array($sql) ? 0 : 1);
    
    echo "<script type='text/javascript'>
    function check_cat(){
        if(".$sql." == '0') {
            Sexy.alert('".$lang_new[$module_name]['ERROR_NO_CAT']."');
            return false;
        }
    }
    </script>";
   
    $text = '';
    
    if (!defined('MAINPAGE')) {
        $text .= "<a href='modules.php?name=".$module_name."'><img src='".evo_image('main.png', $module_name)."' title='".$lang_new[$module_name]['INDEX_PAGE']."' alt='".$lang_new[$module_name]['INDEX_PAGE']."' border='0' /></a>\n";
    }
    $text .= "&nbsp;<a href='modules.php?name=".$module_name."&amp;op=AddDownload' onClick='return check_cat()'><img src='".evo_image('add.png', $module_name)."' title='".$lang_new[$module_name]['DOWNLOAD_SUBMIT']."' alt='".$lang_new[$module_name]['DOWNLOAD_SUBMIT']."' border='0' /></a>\n";
    $text .= "&nbsp;<a href='modules.php?name=".$module_name."&amp;op=NewDownloads'><img src='".evo_image('new.png', $module_name)."' title='".$lang_new[$module_name]['SHOW_NEWSDOWNLOADS']."' alt='".$lang_new[$module_name]['SHOW_NEWSDOWNLOADS']."' border='0' /></a>\n";
    $text .= "&nbsp;<a href='modules.php?name=".$module_name."&amp;op=MostPopular'><img src='".evo_image('popular.png', $module_name)."' title='".$lang_new[$module_name]['SHOW_MOSTPOPULAR']."' alt='".$lang_new[$module_name]['SHOW_MOSTPOPULAR']."' border='0' /></a>\n";
    $text .= "&nbsp;<a href='modules.php?name=".$module_name."&amp;op=TopRated'><img src='".evo_image('top.png', $module_name)."' title='".$lang_new[$module_name]['SHOW_TOPRATED']."' alt='".$lang_new[$module_name]['SHOW_TOPRATED']."' border='0' /></a>\n";
    $text .= "<br />\n";
    $text .= "<div align='center'><form action='modules.php?name=".$module_name."&amp;op=search' method='post'>";
    $text .= "<table border='0' cellspacing='0' cellpadding='0' align='center'>";
    $text .= "<tr><td><span class='content'><input type='text' size='25' name='query' />&nbsp;<input type='submit' value='"._SEARCH."' /></span></td></tr>";
    $text .= "</table>";
    $text .= "</form></div>";
    title($text, $module_name, 'downloads-logo.png');
}

function DownloadsLegend() {
    global $module_name, $lang_new;
    OpenTable();
    echo "<table align='center' cellpadding='2' cellspacing='2' border='0' width='100%'>\n";
    echo "<tr>\n";
    echo "<td align='center' width='20%'><img src='".evo_image('new_01.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['NEW_TODAY']."</td>\n";
    echo "<td align='center' width='20%'><img src='".evo_image('new_03.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['NEW_LAST3DAY']."</td>\n";
    echo "<td align='center' width='20%'><img src='".evo_image('new_07.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['NEW_THISWEEK']."</td>\n";
    echo "<td align='center' width='20%'><img src='".evo_image('upd.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['UPDATED']."</td>\n";
    echo "<td align='center' width='20%'><img src='".evo_image('small-popular.png', $module_name)."' alt='' title='' />".$lang_new[$module_name]['POPULAR']."</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    CloseTable();
    echo "<br />\n";
}

function DownloadsGetParent($parentid,$title) {
    global $db;
    $parentid = intval($parentid);
    $row = $db->sql_ufetchrow("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`=".$parentid);
    $ptitle = check_html($row['title'], 'nohtml');
    $pparentid = intval($row['parentid']);
    if (!empty($ptitle)) {
        $title=$ptitle." -&gt; ".$title;
    }
    if ($pparentid!=0) {
        $title=DownloadsGetParent($pparentid,$title);
    }
    return $title;
}

function DownloadsGetParentLink($parentid,$title) {
    global $db, $module_name;
    $parentid = intval($parentid);
    $row = $db->sql_ufetchrow("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`=".$parentid);
    $cid = intval($row['cid']);
    $ptitle = check_html($row['title'], 'nohtml');
    $pparentid = intval($row['parentid']);
    if (!empty($ptitle)) {
        $title = "<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$cid."'>".$ptitle."</a>/".$title;
    }
    if ($pparentid!=0) {
        $title = DownloadsGetParentLink($pparentid,$title);
    }
    return $title;
}

function DownloadsInfoMenu($did, $ttitle) {
    global $module_name, $lang_new, $downloadsconfig;
    echo "<br /><center><span class=\"content\">[ "
        ."<a href=\"modules.php?name=$module_name&amp;op=viewdownloadcomments&amp;did=$did&amp;ttitle=$ttitle\">".$lang_new[$module_name]['SHOW_DOWNLOAD_COMMENTS']."</a>"
        ." | <a href=\"modules.php?name=$module_name&amp;op=viewdownloaddetails&amp;did=$did&amp;ttitle=$ttitle\">".$lang_new[$module_name]['DO_SHOW_DETAILS']."</a>"
        ." | <a href=\"modules.php?name=$module_name&amp;op=viewdownloadseditorial&amp;did=$did&amp;ttitle=$ttitle\">".$lang_new[$module_name]['SHOW_EDITORIAL']."</a>";
    if ( $downloadsconfig['blockunregmodify'] == 1 || is_user() )  {
        echo "<br /> | <a href=\"modules.php?name=$module_name&amp;op=brokendownload&amp;did=$did\">".$lang_new[$module_name]['DO_REPORT_BROKEN']."</a>";
    }
    echo " ]</span></center>";
}

function DownloadsGraphicNew($time, $update) {
    global $module_name, $lang_new;
    $startdate = time();
    $count = 0;
    $checktime = time() - $time;
    $check_upd = time() - $update;

    if ($update == 0){
        if ($checktime <= 86400 ) {
            return ("<img src=\"".evo_image('new_01.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_TODAY']."\" />");
        } elseif ($checktime <= 259200) {
            return ("<img src=\"".evo_image('new_03.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_LAST3DAY']."\" />");
        } elseif ($checktime <= 604800) {
            return ("<img src=\"".evo_image('new_07.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_THISWEEK']."\" />");
        }
    } else {
        if ($check_upd <= 86400) {
            return ("<img src=\"".evo_image('upd.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['UPDATED']."\" />");
        } elseif ($check_upd <= 259200) {
            return ("<img src=\"".evo_image('upd_1.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['UPDATED_LAST3DAY']."\" />");
        } elseif ($check_upd <= 604800) {
            return ("<img src=\"".evo_image('upd_2.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['UPDATED_THISWEEK']."\" />");
        }
    }
}

function DownloadsGraphicCatNew($cat) {
    global $db, $module_name, $lang_new;
    $cat = intval(trim($cat));
    $row = $db->sql_fetchrow($db->sql_query("SELECT `date`, `date_validated`, `show_update` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid`='$cat' AND `download_active`='1' ORDER BY `date` DESC LIMIT 1"));

    if ($row['show_update'] != 0){
        $time = time() - $row['show_update'];
    } else {
        $time = time() - $row['date'];
    }

    if ($row['show_update'] == 0){
        if ($time <= 86400 ) {
            return ("<img src=\"".evo_image('new_01.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_TODAY']."\" />");
        } elseif ($time <= 259200) {
            return ("<img src=\"".evo_image('new_03.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_LAST3DAY']."\" />");
        } elseif ($time <= 604800) {
            return ("<img src=\"".evo_image('new_07.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['NEW_THISWEEK']."\" />");
        }
    } else {
        if ($time <= 86400) {
            return ("<img src=\"".evo_image('upd.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['UPDATED']."\" />");
        } elseif ($time <= 259200) {
            return ("<img src=\"".evo_image('upd_1.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['UPDATED_LAST3DAY']."\" />");
        } elseif ($time <= 604800) {
            return ("<img src=\"".evo_image('upd_2.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['UPDATED_THISWEEK']."\" />");
        }
    }
}

function DownloadsGraphicPopular($hits) {
    global $module_name, $downloadsconfig, $lang_new;
    if ($hits >= $downloadsconfig['popular']) {
        return ("<img src=\"".evo_image('small-popular.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['POPULAR']."\" />");
    }
}

function DownloadsGraphicCatPopular($cat) {
    global $db, $module_name, $downloadsconfig, $lang_new;
    $cat = intval(trim($cat));
    $row = $db->sql_fetchrow($db->sql_query("SELECT `hits` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid`='$cat' ORDER BY `hits` DESC LIMIT 1"));
    if ($row['hits'] >= $downloadsconfig['popular']) {
        return ("<img src=\"".evo_image('small-popular.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['POPULAR']."\" />");
    }
}

function DownloadsConvertOrderByIn($orderby) {
    if ($orderby != "titleA" AND $orderby != "dateA" AND $orderby != "hitsA" AND $orderby != "ratingA" AND $orderby != "titleD" AND $orderby != "dateD" AND $orderby != "hitsD" AND $orderby != "ratingD") {
        $orderby = 'titleA';
    }
    if ($orderby == "titleA")    $orderby = "title ASC";
    if ($orderby == "dateA")    $orderby = "date ASC";
    if ($orderby == "hitsA")    $orderby = "hits ASC";
    if ($orderby == "ratingA")    $orderby = "downloadratingsummary ASC";
    if ($orderby == "titleD")    $orderby = "title DESC";
    if ($orderby == "dateD")    $orderby = "date DESC";
    if ($orderby == "hitsD")    $orderby = "hits DESC";
    if ($orderby == "ratingD")    $orderby = "downloadratingsummary DESC";
    return $orderby;
}

function DownloadsConvertOrderByTrans($orderby) {
    global $module_name, $lang_new;
    if ($orderby != "hits ASC" AND $orderby != "hits DESC" AND $orderby != "title ASC" AND $orderby != "title DESC" AND $orderby != "date ASC" AND $orderby != "date DESC" AND $orderby != "downloadratingsummary ASC" AND $orderby != "downloadratingsummary DESC") {
        redirect("index.php");
    }
    if ($orderby == "hits ASC")                 $orderbyTrans = $lang_new[$module_name]['SORTS_POPULARITY_UP'];
    if ($orderby == "hits DESC")                $orderbyTrans = $lang_new[$module_name]['SORTS_POPULARITY_DOWN'];
    if ($orderby == "title ASC")                $orderbyTrans = $lang_new[$module_name]['SORTS_TITLEAZ'];
    if ($orderby == "title DESC")               $orderbyTrans = $lang_new[$module_name]['SORTS_TITLEZA'];
    if ($orderby == "date ASC")                 $orderbyTrans = $lang_new[$module_name]['SORTS_DATE_UP'];
    if ($orderby == "date DESC")                $orderbyTrans = $lang_new[$module_name]['SORTS_DATE_DOWN'];
    if ($orderby == "downloadratingsummary ASC")    $orderbyTrans = $lang_new[$module_name]['SORTS_RATING_UP'];
    if ($orderby == "downloadratingsummary DESC")   $orderbyTrans = $lang_new[$module_name]['SORTS_RATING_DOWN'];
    return $orderbyTrans;
}

function DownloadsConvertOrderByOut($orderby) {
    if ($orderby != "title ASC" AND $orderby != "date ASC" AND $orderby != "hits ASC" AND $orderby != "downloadratingsummary ASC" AND $orderby != "title DESC" AND $orderby != "date DESC" AND $orderby != "hits DESC" AND $orderby != "downloadratingsummary DESC") {
        redirect("index.php");
    }
    if ($orderby == "title ASC")        $orderby = "titleA";
    if ($orderby == "date ASC")            $orderby = "dateA";
    if ($orderby == "hits ASC")            $orderby = "hitsA";
    if ($orderby == "downloadratingsummary ASC")    $orderby = "ratingA";
    if ($orderby == "title DESC")        $orderby = "titleD";
    if ($orderby == "date DESC")        $orderby = "dateD";
    if ($orderby == "hits DESC")        $orderby = "hitsD";
    if ($orderby == "downloadratingsummary DESC")    $orderby = "ratingD";
    return $orderby;
}

function DownloadsOrderLegend($orderbyTrans, $cid=0, $module='viewdownload') {
  global $module_name, $lang_new;
  echo "<center><span class=\"content\">".$lang_new[$module_name]['SORTS_BY'].": "
        .$lang_new[$module_name]['TITLE']." (<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=titleA\"><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=titleD\"><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>) "
        .$lang_new[$module_name]['DATE']." (<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=dateA\"><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=dateD\"><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>) "
        .$lang_new[$module_name]['RATING']." (<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=ratingA\"><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=ratingD\"><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>) "
        .$lang_new[$module_name]['POPULAR']." (<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=hitsA\"><img align='bottom' src='".evo_image('up.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['UP']."' title='".$lang_new[$module_name]['UP']."' /></a>|<a href=\"modules.php?name=$module_name&amp;op=$module&amp;cid=$cid&amp;orderby=hitsD\"><img align='bottom' src='".evo_image('down.png', $module_name)."' border='0' alt='".$lang_new[$module_name]['DOWN']."' title='".$lang_new[$module_name]['DOWN']."' /></a>)"
        ."<br /><strong>".$lang_new[$module_name]['SORTS_IS'].": $orderbyTrans</strong></span></center><br /><br />";

}


function DownloadsDetectEditorial($did, $ttitle) {
    global $db, $module_name, $lang_new;
    $did = intval($did);
    $returnstring = '';
    $recordexist = $db->sql_unumrows("SELECT `adminid` FROM `"._DOWNLOADS_EDITORIALS_TABLE."` WHERE downloadid='$did'");
    if ($recordexist > 0) {
        $returnstring = "<a href=\"modules.php?name=$module_name&amp;op=viewdownloadseditorial&amp;did=$did&amp;ttitle=$ttitle\"><img src=\"".evo_image('editorial.png', $module_name)."\" border=\"0\" alt=\"".$lang_new[$module_name]['EDITORIAL']."\" title=\"".$lang_new[$module_name]['EDITORIAL']."\" /></a>";
    }
    return ($returnstring);
}

function DownloadsDisplayScore($score) {
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

function DownloadsFooter($did,$ttitle) {
    global $module_name, $lang_new;
    echo "<span class=\"content\">[ <a href=\"modules.php?name=$module_name&amp;op=visit&amp;did=$did\" target=\"_blank\">".$lang_new[$module_name]['VISIT']."</a> | <a href=\"modules.php?name=$module_name&amp;op=ratedownload&amp;did=$did&amp;ttitle=$ttitle\">".$lang_new[$module_name]['DO_RATE']."</a> ]</span><br /><br />";
    echo "<br /><span class=\"content\">".$lang_new[$module_name]['INFO_ISTHSYOURSITE']." <a href=\"modules.php?name=$module_name&amp;op=outsidedownloadsetup&amp;did=$did\">".$lang_new[$module_name]['INFO_ALLOW_TO_RATE']."</a></span>";
}

function DownloadsRateInfo($did) {
    global $db;
    $did = intval($did);
    $db->sql_query("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` SET `hits`=`hits`+1 WHERE `did`='$did'");
    $row = $db->sql_ufetchrow("SELECT `url` FROM "._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did`='$did'");
    $url = stripslashes($row['url']);
    redirect($url);
}

function DownloadsCompleteVote($error) {
    global $module_name, $lang_new;
    OpenTable2();
    if ($error == 'none') echo "<center><strong>".$lang_new[$module_name]['INFO_RATE_COMPLETED_OK']."</strong></center>";
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


function DownloadShowSingle($showdid) {
    global $db, $downloadsconfig, $module_name, $admin_file, $lang_new, $userinfo;
        $did            = intval($showdid['did']);
        $transfertitle  = str_replace (" ", "_", $showdid['title']);
        $title          = set_smilies(decode_bbcode(stripslashes($showdid['title']), 1, true));
        $description    = evo_img_tag_to_resize(set_smilies(decode_bbcode(stripslashes($showdid['description']), 1, true)));
        $image          = $showdid['image'];
        $url            = $showdid['url'];
        $name           = $showdid['submitter'];
        $time           = $showdid['date'];
        $time_1         = $showdid['date'];
        $update         = $showdid['show_update'];
        $datetime       = formatTimestamp($time);
        $hits           = intval($showdid['hits']);
        $submitter      = UsernameColor($showdid['submitter']);
        $submitter2     = $showdid['submitter'];
        $downloadratingsummary = $showdid['downloadratingsummary'];
        $totalvotes     = intval($showdid['totalvotes']);
        $totalcomments  = intval($showdid['totalcomments']);
        $author         = stripslashes($showdid['download_author']);
        $author_email   = stripslashes($showdid['download_author_email']);
        $author_website = stripslashes($showdid['download_author_website']);
        $version        = stripslashes($showdid['download_version']);
        $license        = intval($showdid['download_license']);
        $filesize       = intval($showdid['download_size']);
        $torrent        = stripslashes($showdid['download_torrent']);
        $cid            = intval($showdid['cid']);

        if  ($license > 0 ) {
            $result = $db->sql_ufetchrow("SELECT `license_title` FROM `"._DOWNLOADS_LICENSES_TABLE."` WHERE `license_id` = $license");
            $show_license = "<a href='modules.php?name=".$module_name."&amp;op=ShowLicense&amp;license_id=".$license."' onclick=\"window.open('modules.php?name=".$module_name."&amp;op=ShowLicense&amp;license_id=".$license."', '_license', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=500');return false;\" target='_license' class='nav'>".$result['license_title']."</a>";
        }

        if ($update > 1) {
            $time_1 = $update;
        } else {
            $time_1 = $time;
        }

        $row1     = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`='".$cid."'");
        $category = "<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$cid."'>".stripslashes(check_html($row1['title'], "nohtml"))."</a>";
        $parentid = intval($row1['parentid']);
        $category = DownloadsGetParentLink($parentid,$category);
        $last_modified = formatTimestamp($showdid['last_modified_date']);
        $downloadratingsummary = number_format($downloadratingsummary, $downloadsconfig['mainvotedecimal']);
        echo "<form method='post' action='modules.php?name=".$module_name."&amp;op=DownloadDoDownload' name='dodownload_".$did."'>";
        echo "<table width='100%' border='0' bgcolor='".$downloadsconfig['tablecolor1']."'>\n";
        echo "<tr>\n";
        echo "<td colspan='3' class='row1'>".$lang_new[$module_name]['CATEGORY'].":&nbsp;".$category."</td>";
        echo "</tr>\n<tr>\n";
        echo "<td width='50%'><input type='hidden' name='did' value='".$did."' /><input type='hidden' name='license' value='".$license."' />";
        if ($url) {
            echo "&nbsp;<a href='modules.php?name=".$module_name."&amp;op=visit&amp;did=".$did."' target='_blank'><img src='".evo_image('download.png', $module_name)."' width='16' height='16' border='0' alt='' />&nbsp;<strong>".$title."</strong></a>&nbsp;".DownloadsGraphicNew($time_1, $update).DownloadsGraphicPopular($hits);
        } else {
            echo "&nbsp;<a href='modules.php?name=".$module_name."&amp;op=showdownload&amp;did=".$did."'><img src='".evo_image('show_download.png', $module_name)."' width='16' height='16' border='0' alt='' />&nbsp;<strong>".$title."</strong></a>&nbsp;".DownloadsGraphicNew($time_1, $update).DownloadsGraphicPopular($hits);
        }
        echo "</td>\n";
        echo "<td width='100%'></td>\n";

        $user_id  = get_user_field('user_id', $submitter2, TRUE);
        $temp_url = "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=".$user_id;
        $profile_img = '<a href="' . $temp_url . '">'.$submitter.'</a>';

        echo "<td class='row1' width='20%' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>".$lang_new[$module_name]['BY']."</strong>&nbsp;".$profile_img."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
        echo "</tr>\n";
        if ($downloadratingsummary != '0' || $downloadratingsummary != '0.0') {
            echo "<tr><td colspan='3' align='left'>";
            echo DownloadsDisplayScore($downloadratingsummary);
            echo "</td></tr>\n";
        }
        echo "</table>\n";
        echo "<table bgcolor='".$downloadsconfig['tablecolor2']."' width='100%' cellspacing='0' cellpadding='0' border='0'>\n<tr>\n";

        if($image != 'http://' && !empty($image) ){
            echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td valign='top'><a href='".$image."' rel='lightbox' title='".$title."' rev='' ><img src='"."imgsize.php?src=".$image."&amp;w=".$downloadsconfig['image_width']."'  border='0' title='".$title."' alt='' /></a></td>\n";
        } else {
            echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td valign='top'><img src='".evo_image('blank.gif', $module_name)."' width='".$downloadsconfig['image_width']."' border='0' title='".$title."' alt='' /></td>\n";
        }
        echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
        echo "<td  valign='top' width='100%'><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />".$description."</td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo "<table bgcolor='".$downloadsconfig['tablecolor2']."' width='100%' cellspacing='0' cellpadding='0' border='0'>\n";
        if(!empty($author_email) && !is_admin()) {
            $author_email = str_replace("@", "[at]", $author_email);
            $author_email = str_replace(".", "[dot]", $author_email);
            echo "<tr><td width='50%' class='row1' align='left'>".$lang_new[$module_name]['DOWNLOAD_AUTHOR'].":</td><td class='row1' >".$author." (".$author_email.")</td></tr>\n";
        } elseif (!empty($author_email) && is_admin()) {
              echo "<tr><td width='50%' class='row1' align='left'>".$lang_new[$module_name]['DOWNLOAD_AUTHOR'].":</td><td class='row1' >".$author." (<a href='mailto:".$author_email."'>".$author_email."</a>)</td></tr>\n";
        } else {
            echo "<tr><td width='50%' class='row1' align='left'>".$lang_new[$module_name]['DOWNLOAD_AUTHOR'].":</td><td class='row1' >".$author."</td></tr>\n";
        }
        echo "<tr><td width='50%' class='row1' align='left'>".$lang_new[$module_name]['DOWNLOAD_AUTHOR_WEBSITE'].":</td><td class='row1' ><a href='".$author_website."' target='_blank'>".$author_website."</a></td></tr>\n";
        echo "<tr><td width='50%' class='row1' align='left'>".$lang_new[$module_name]['DOWNLOAD_VERSION'].":</td><td class='row1'>".$version."</td></tr>\n";
            if (!empty($torrent) ){
                   echo "<tr><td width='40%' class='row1' align='left'>Torrent:</td><td class='row1'><a href='".$torrent."' target='_blank'>".$torrent."</a></td></tr>\n";
            }
            if (!empty($show_license)) {
               echo "<tr><td width='50%' class='row1' align='left'>".$lang_new[$module_name]['LICENSE_TYPE'].":</td><td class='row1' >".$show_license."</td></tr>\n";
            }
        echo "<tr><td width='50%' class='row1' align='left'>".$lang_new[$module_name]['DOWNLOAD_FILESIZE'].":</td><td class='row1' >".$filesize."&nbsp;".$lang_new[$module_name]['SIZE_BYTE']."</td></tr>\n";
        if ( !DownloadsAllowed($did, $userinfo['user_id'], 'download') && !is_mod_admin($module_name)) {
            echo "<tr><td width='50%' class='row1' align='left'>".$lang_new[$module_name]['DOWNLOAD_GO'].":</td><td class='row1' align='center'>".$lang_new[$module_name]['INFO_DOWNLOAD_RESTRICTED']."</td></tr>\n";
        } else {
            echo "<tr><td width='50%' class='row1' align='left'>".$lang_new[$module_name]['DOWNLOAD_GO'].":</td><td class='row1' ><a href='javascript:document.dodownload_".$did.".submit()'><img src='".evo_image('do_download.png', $module_name)."' border='0' title='".$lang_new[$module_name]['DOWNLOAD']."' alt='' /></a></td></tr>\n";
            if ($downloadsconfig['securitycheck'] == 1) {
                echo "<tr><td class='row1' colspan='2' align='center'>".security_code(1,'small', 1, $module_name.$did)."</td></tr>\n";
            }
        }
        echo "</table>\n";
        echo "<table bgcolor='".$downloadsconfig['tablecolor1']."' width='100%' cellspacing='0' cellpadding='2' border='0'>\n<tr>\n";

        if ($update == 0){
            $datetime = formatTimestamp($time);
        } else {
            $datetime = formatTimestamp($update);
        }

        echo "<td width='25%' align='left' height='20'><img src='".evo_image('date.png', $module_name)."' width='16' height='16' border='0' title='".$lang_new[$module_name]['DATE_WRITTEN']." ".$datetime." ".$lang_new[$module_name]['BY']." $name' alt='' />&nbsp;".$datetime."</td>\n";
        echo "<td width='20%'><img src='".evo_image('hits.png', $module_name)."' width='16' height='16' border='0' title='".$lang_new[$module_name]['HITS']." $hits' alt='' />&nbsp;<strong>".$hits."</strong></td>";
        $votestring = ($totalvotes == 1) ? $lang_new[$module_name]['VOTE'] : $lang_new[$module_name]['VOTES'];
        if ($totalvotes != 0) {
            echo "<td width='9%'><a href='modules.php?name=".$module_name."&amp;op=viewdownloaddetails&amp;did=".$did."&amp;ttitle=".$transfertitle."'><img src='".evo_image('details.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['DO_SHOW_DETAILS']."' alt='' /></a></td>\n";
        } else {
            echo "<td width='9%'></td>\n";
        }
        echo "<td width='10%' align='center'><a href='modules.php?name=".$module_name."&amp;op=ratedownload&amp;did=".$did."&amp;ttitle=".$transfertitle."'><img src='".evo_image('votein.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['DO_RATE']."' alt='' /></a></td>\n";
        if ($totalcomments != 0) {
              echo "<td width='9%'><a href='modules.php?name=".$module_name."&amp;op=viewdownloadcomments&amp;did=".$did."&amp;ttitle=".$transfertitle."'><img src='".evo_image('comments.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['DO_SHOW_COMMENTS']."' alt='' />&nbsp;<strong>".$totalcomments."</strong></a></td>\n";
        } else {
            echo "<td width='9%'></td>\n";
        }
        echo "<td width='9%'>".DownloadsDetectEditorial($did, $transfertitle)."</td>\n";
        if (is_user()||$downloadsconfig['blockunregmodify'] == 0 || is_mod_admin($module_name)) {
                echo "<td width='9%' align='right'><a href='modules.php?name=".$module_name."&amp;op=brokendownload&amp;did=".$did."'><img src='".evo_image('alert.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['REPORT_BROKEN']."' alt='' /></a></td>\n";
        } else {
            echo "<td width='9%'></td>\n";
        }
        if (is_mod_admin($module_name)) {
              echo "<td width='9%' align='right' ><a href='".$admin_file.".php?op=DownloadsModDownload&amp;did=".$did."'><img src='".evo_image('editicon.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['EDIT']."' alt='' /></a></td\n>";
        } else {
            echo "<td width='9%'></td>\n";
        }
        echo "</tr>\n</table>\n";
        echo "</form>";
        return;
}

function DownloadsDeleteUploaderDir() {
    $dir = NUKE_BASE_DIR.'modules/Downloads/uploader/caxe';
    $filesArray = glob($dir."/*.*");
    for($i=0, $max= count($filesArray); $i < $max; $i++) {
        @unlink($filesArray[$i]);
    }
    return;
}

// Delivers defined 'upload_max_filesize' in bytes
function DownloadsMaxAllowedFileSize($pur = FALSE)
{
    $inifilesize = ini_get('upload_max_filesize');
    if ($pur) {
        return $inifilesize;
    }
    $inifilesize_number = preg_replace('/[A-Z]/i', '', $inifilesize);
    $inifilesize_multi = (stristr($inifilesize, 'K') ? 1024 : ( stristr($inifilesize, 'M') ? 1048576 : 1073741824));
    $maxallowed = $inifilesize_number * $inifilesize_multi;
    return $maxallowed;
}

function DownloadsForbiddenExtensions($list=FALSE) {
    global $db;
    $forb_extens = array();
    $forb_extens_list = '';
    $result = $db->sql_query("SELECT `ext`, `mimetype`, `description` FROM `". _DOWNLOADS_EXTENSIONS_TABLE ."` WHERE `active`='0' ORDER BY `ext` ASC");
    $i = 0;
    while ($row = $db->sql_fetchrow($result)) {
        $forb_extens[$i]['ext'] = $row['ext'];
        $forb_extens[$i]['mimetype'] = $row['mimetype'];
        $forb_extens_list  .= $row['ext'].', ';
        $i++;
    }
    if ( $list == FALSE ) {
        return $forb_extens;
    } else {
        return $forb_extens_list;
    }
}

function DownloadsAllowedExtensions($list=FALSE) {
    global $db;
    $forb_extens = array();
    $forb_extens_list = '';
    $result = $db->sql_query("SELECT `ext`, `mimetype`, `description` FROM `". _DOWNLOADS_EXTENSIONS_TABLE ."` WHERE `active`='1' ORDER BY `ext` ASC");
    $i = 0;
    while ($row = $db->sql_fetchrow($result)) {
        $forb_extens[$i]['ext'] = $row['ext'];
        $forb_extens[$i]['mimetype'] = $row['mimetype'];
        $forb_extens_list  .= $row['ext'].' ';
        $i++;
    }
    if ( $list == FALSE ) {
        return $forb_extens;
    } else {
        return $forb_extens_list;
    }
}

function DownloadsIsForbiddenExtension($myfile) {
    $forbidden_list = DownloadsForbiddenExtensions();
    foreach($forbidden_list as $key => $value ) {
        if (trim(strtoupper($value['ext'])) == trim('.'.strtoupper($myfile['extension'])) ) {
            return FALSE;
        } elseif ( $value['mimetype'] == $myfile['type']) {
            return FALSE;
        }
    }
    return TRUE;
}

function DownloadsIsAllowedExtension($myfile) {
    $forbidden_list = DownloadsAllowedExtensions();
    foreach($forbidden_list as $key => $value ) {
        if (trim(strtoupper($value['ext'])) == trim('.'.strtoupper($myfile['extension'])) ) {
            return 1;
        } elseif ( $value['mimetype'] == $myfile['type']) {
            return 1;
        }
    }
    return 0;
}

function DownloadsUpload($upload, $uploaddir, $type) {
    global $file_mode, $downloadsconfig, $lang_new, $module_name;

    $error              = 1;
    $error_msg          = "<strong>" . $lang_new[$module_name]['ERROR_FILEUPLOAD_UNKNOWN'] . "</strong><br />";
    $max_file_size      = DownloadsMaxAllowedFileSize(TRUE);
    $max_file_size      = preg_replace("#[^0-9]#si", '', $max_file_size);
    $max_file_size      = $max_file_size*1024*1024;
    $pattern            = '/\s*/m';
    $replace            = '';

 if (!empty($upload)){
        $file['name']       = $upload['name'];
        $file['name']       = preg_replace($pattern, $replace, $file['name']);
        $file['temp']       = $upload['tmp_name'];
        $file['type']       = str_replace('"', '', $upload['type']);
        $file['type']       = str_replace("'", '', $file['type']);
        $file['error']      = $upload['error'];
        $file['size']       = $upload['size'];
        $file_parts         = @pathinfo($upload['name']);
        $file['extension']  = $file_parts['extension'];
    } else {
        $error = 99;
    }

    if (is_uploaded_file($file['temp']) && $file['error'] == 0) {
        if ($file['size'] <= 1){
            $error = 2;
            $error_msg = $lang_new[$module_name]['ERROR_NO_SIZE'];
        } else {
            if ($type == 'file'){
                if ( DownloadsIsAllowedExtension($file) == 0 ) {
                    $error      = 3;
                    $error_msg  = $lang_new[$module_name]['ERROR_WRONG_TYPE'] . ": ".$file['extension'];
                } else {
                    if (@file_exists(NUKE_BASE_DIR.$uploaddir.'/'.$file['name'])) {
                        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 5; $x = rand(0,$z), $s .= $a{$x}, $i++);
                        $file['name'] = $s.'_'.$file['name'];
                    }
                }
                if (@move_uploaded_file($file['temp'], NUKE_BASE_DIR.$uploaddir.'/'.$file['name'])) {
                    if (@chmod(NUKE_BASE_DIR.$uploaddir.'/'.$file['name'], $file_mode)) {
                        $error      = 0;
                        $error_msg  = '';
                    } else {
                        @unlink($upload['tmp_name']);
                        $error      = 4;
                        $error_msg  = $lang_new[$module_name]['WARN_CHMOD_FALSE'];
                    }
                } else {
                    $error      = 5;
                    $error_msg  = $lang_new[$module_name]['ERROR_FILEUPLOAD'];
                }
            } elseif ($type == 'image'){
                 if (@file_exists(NUKE_BASE_DIR.$uploaddir.'/images/'.$file['name'])) {
                    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 5; $x = rand(0,$z), $s .= $a{$x}, $i++);
                    $file['name'] = $s.'_'.$file['name'];
                }
                if (@move_uploaded_file($file['temp'], NUKE_BASE_DIR.$uploaddir.'/images/'.$file['name'])) {
                    if (@chmod(NUKE_BASE_DIR.$uploaddir.'/images/'.$file['name'], $file_mode)) {
                        $error      = 0;
                        $error_msg  = '';
                    } else {
                        @unlink($upload['tmp_name']);
                        $error      = 4;
                        $error_msg  = $lang_new[$module_name]['WARN_CHMOD_FALSE'];
                    }
                } else {
                    $error      = 5;
                    $error_msg  = $lang_new[$module_name]['ERROR_FILEUPLOAD'];
                }
            }
        }
    } else {
        $error = 6;
        switch ($file['error']) {
            case '1':   // File is greater than maximum filesize allowed in 'upload_max_filesize'
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_MAXSIZE1'];
                break;
            case '2':   // File is greater than the size given in HTML-POST size parameter
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_MAXSIZE2'];
                break;
            case '3':   // File is only partial uploaded
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_PARTIAL'];
                break;
            case '4':   // No File is uploaded
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_NONE'];
                break;
            default:    // On every other not successfull case
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_UNKNOWN'];
                break;
        }
    }
    $file['error']      = $error;
    $file['error_msg']  = $error_msg;
    return $file;
}

function DownloadsUploadImage($uploadimage, $uploaddir) {
    global $file_mode, $downloadsconfig, $lang_new, $module_name;
    $error = 1;
    $error_msg = "<strong>" . $lang_new[$module_name]['ERROR_FILEUPLOAD_UNKNOWN'] . "</strong><br />";
    if (!empty($uploadimage)) {
        $file['name']  = $uploadimage['name'];
        $file['temp']  = $uploadimage['tmp_name'];
        $file['type']  = $uploadimage['type'];
        $file['error'] = $uploadimage['error'];
        $file['size']  = $uploadimage['size'];
        $file_parts    = @pathinfo($uploadimage['name']);
        $file['extension']  = $file_parts['extension'];
    } else {
        $error = 99;
    }
    if (is_uploaded_file($file['temp']) && $file['error'] == 0) {
        if ( $file['size'] <= 1) {
            $error = 2;
            $error_msg = $lang_new[$module_name]['ERROR_NO_SIZE'];
        } else {
            if ( DownloadsIsAllowedExtension($file) == 0 ) {
                $error = 3;
                $error_msg = $lang_new[$module_name]['ERROR_WRONG_TYPE'] . ": ".$file['extension'];
            } else {
                if ( @file_exists(NUKE_BASE_DIR . $uploaddir . '/images/' . $file['name'] )) {
                    // the next line is from whatchildisthis(at)gmail(dot)com found on http://de.php.net/manual/de/function.rand.php
                    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 5; $x = rand(0,$z), $s .= $a{$x}, $i++);
                    $file['name'] = $s.'_'.$file['name'];
                }
                if (@move_uploaded_file($file['temp'], NUKE_BASE_DIR . $uploaddir . '/images/' . $file['name'])) {
                    if (@chmod(NUKE_BASE_DIR . $uploaddir . '/images/' . $file['name'], $file_mode)) {
                        $error = 0;
                        $error_msg = '';
                    } else {
                        @unlink($uploadimage['tmp_name']);
                        $error = 4;
                        $error_msg = $lang_new[$module_name]['WARN_CHMOD_FALSE'];
                    }
                } else {
                    $error = 5;
                    $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD'];
                }
            }
        }
    } else {
        $error = 6;
        switch ($file['error']) {
            case '1':   // File is greater than maximum filesize allowed in 'upload_max_filesize'
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_MAXSIZE1'];
                break;
            case '2':   // File is greater than the size given in HTML-POST size parameter
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_MAXSIZE2'];
                break;
            case '3':   // File is only partial uploaded
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_PARTIAL'];
                break;
            case '4':   // No File is uploaded
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_NONE'];
                break;
            default:    // On every other not successfull case
                $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_UNKNOWN'];
                break;
        }
    }
    $file['error'] = $error;
    $file['error_msg'] = $error_msg;
    return $file;
}

function DownloadsURLValidate($url) {
    global $lang_new, $module_name;

    $error = 1;
    $error_msg = "<strong>" . $lang_new[$module_name]['ERROR_FILEUPLOAD_UNKNOWN'] . "</strong><br />";
    $file  = array();
    $url_parts = @parse_url( $url );
    if ( empty( $url_parts['host'] ) ) {
        $error = 1;
        $error_msg = $lang_new[$module_name]['ERROR_HOSTS_NO'];
    }
    if ( !empty( $url_parts['path'] ) ) {
        $documentpath = $url_parts['path'];
    } else {
        $documentpath = '/';
    }
    if ( !empty( $url_parts['query'] ) ) {
        $documentpath .= '?' . $url_parts['query'];
    }

    $host = @$url_parts['host'];
    $port = @$url_parts['port'];
    if (empty( $port ) ) {
        $port = '80';
    }
    $socket = @fsockopen( $host, $port, $errno, $errstr, 30 );
    if (!$socket) {
        $error = 1;
        $error_msg = $lang_new[$module_name]['ERROR_HOSTS_WRONG'];
    } else {
        @fwrite ($socket, "HEAD ".$documentpath." HTTP/1.0\r\nHost: $host\r\n\r\n");
        $http_response = @fgets( $socket, 22 );
        if (preg_match('#200 OK#', $http_response, $regs )) {
            $error = 0;
            $error_msg = '';
            @fclose( $socket );
        } else {
            if ((preg_match('#302#', $http_response)) || (preg_match('#303#', $http_response)) || (preg_match('#301#', $http_response))) {
                while (!@feof($socket)) {
                    $line = @fgets($socket);
                    if (preg_match('#Location:#',$line)) {
                        $line = str_replace('Location:','',$line);
                        $line = trim($line);
                        if (substr($line,0,1)!='/') {
                            if (substr($host,0,3)!='http') {
                                $host='http://'.$host;
                            }
                            $line=$host.$line;
                        }
                        $local_url = DownloadsURLValidate($line);
                        if ($local_url['error'] == 0 ) {
                            $error = 0;
                            $error_msg = '';
                        } else {
                            $error = 1;
                            $error_msg = $lang_new[$module_name]['ERROR_FILEUPLOAD_UNKNOWN'];
                        }
                    }
                }
            } else {
                $error = 1;
                $error_msg = $lang_new[$module_name]['ERROR_LINK_UNKNOWN'];
            }
            @fclose( $socket );
        }
    }
    if ($error == 0) {
        if (function_exists('remote_filesize')) {
            $file['size'] = remote_filesize($url);
        } else {
            $file['size'] = 0;
        }
        $file['type'] = @get_mime_content_type($url);
        if (empty($type)) {
            $file['type'] = 'text/plain';
        }
        if (empty($size)) {
            $file['size'] = 0;
        }
    }
    $file['error']     = $error;
    $file['error_msg'] = $error_msg;
    return $file;
}

function DownloadsLinkCheck($linkurl) {
    global $downloadsconfig, $lang_new, $module_name;

    $error     = 1;
    $file      = array();
    $error_msg = "<strong>" . $lang_new[$module_name]['ERROR_LINK_UNKNOWN'] . "</strong><br />";
    if (stristr($linkurl, 'http') || stristr($linkurl, 'ftp') || stristr($linkurl, 'https')) {
        if (Validate($linkurl,'url',$lang_new[$module_name]['DOWNLOADS'])) {
            $file  = DownloadsURLValidate($linkurl);
            $file['remote'] = TRUE;
            if ($file['error'] == 0) {
                $error     = 0;
                $error_msg = '';
            } else {
                $error     = 1;
                $error_msg = $file['error_msg'];
            }
        }
    } else {
        if (@file_exists($linkurl)) {
            $error             = 0;
            $error_msg         = '';
            $file['size']      = @filesize($linkurl);
            $file['type']      = @get_mime_content_type($linkurl);
            $file['remote']    = FALSE;
           if (empty($file['type'])) {
                $file['type']  = 'text/plain';
            }
            if (empty($file['size'])) {
                $file['size']  = 0;
            }
        } else {
            $error     = 1;
            $error_msg = $lang_new[$module_name]['ERROR_LINK_UNKNOWN'];
        }
    }
    $file['error']     = $error;
    $file['error_msg'] = $error_msg;
    return $file;
}

function DownloadsGetUserInfo($did) {
    global $db, $downloadsconfig, $userinfo, $module_name;
    // We do not cache this informations to prevent
    // tries from clever users to download with several opened tasks
    // Therefore it is important to call this function at the moment the Information is needed
    // to get actual informations
    $allowed_download_groups = array();
    $user_is_in_group        = array();
    // Get allowed Categories
    // General SQL-Statements needed in all Right-Checks
    $row_1   = $db->sql_ufetchrow("SELECT `download_groups`, `cid`, `download_groups_see`, `download_mintime`, `download_size`, `download_active` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did`='".$did."'");
    $cat_row = $db->sql_ufetchrow("SELECT `canupload`, `catoverride`, `maxdirsize`, `maxfilesize`, `mintime`, `restricted_group_add`, `restricted_group_see`, `sizedefinedir`, `sizedefinefile`, `catactive`
                                    FROM `". _DOWNLOADS_CATEGORIES_TABLE ."`
                                    WHERE `cid` = '". $row_1['cid']."'");

    if ( is_mod_admin($module_name)) {
        // Module Admin has all rights, even if Category isn't active
        $userinfo['DL_auth_view']       = TRUE;
        $userinfo['DL_auth_download']   = TRUE;
        $userinfo['DL_auth_upload']     = TRUE;
    } elseif ($cat_row['catactive'] == '1' && $row_1['download_active'] == '1') {
        // Get activities of this user
        // Down-/Uploads this month
        $result = $db->sql_ufetchrow("SELECT MAX(`download_time`) as `last_download` FROM `"._DOWNLOADS_HISTORY_TABLE."`
                                        WHERE `user_id`='".$userinfo['user_id']."'
                                        AND `type`   = '1'
                                        AND `status` = '9'");
        $userinfo['DL_last_download'] = $result['last_download'];
        $result = $db->sql_ufetchrow("SELECT MAX(`download_time`) as `last_upload` FROM `"._DOWNLOADS_HISTORY_TABLE."`
                                        WHERE `user_id`='".$userinfo['user_id']."'
                                        AND `type`   = '0'
                                        AND `status` = '9'");
        $userinfo['DL_last_upload']   = $result['last_upload'];

        // Is user allowed to Upload Files (could only be set on group level- we only need one active group where he is authed to)
        $result = $db->sql_ufetchrow("SELECT COUNT(`ndg`.`group_id`) as `upgroups`
                                        FROM `"._DOWNLOADS_GROUPS_TABLE."` ndg Inner Join `".USER_GROUP_TABLE."` nbg ON `ndg`.`group_id` = `nbg`.`group_id`
                                        WHERE `nbg`.`user_id` =  '".$userinfo['user_id']."'
                                        AND `ndg`.`group_allowed_upload` =  '1'
                                        AND ((`ndg`.`group_mintime` = '0') OR
                                            (UNIX_TIMESTAMP(now()) + `ndg`.`group_mintime` > '".$userinfo['DL_last_upload']."'))
                                        AND `ndg`.`group_active` =  '1'");
        $userinfo['DL_auth_upload'] = ($result['upgroups'] > 0) ? TRUE : FALSE;

        // Is user allowed to download this file
        $row_2  = $db->sql_ufetchrow("SELECT COUNT(`user_id`) as `userid` FROM `"._DOWNLOADS_USERS_TABLE."` WHERE `user_id` = '".$userinfo['user_id']."' AND `user_active` = '1' AND `user_allowed_download`= '0'");
        $result = $db->sql_query("SELECT `ndg`.`group_id` as `downgroups`
                                        FROM `"._DOWNLOADS_GROUPS_TABLE."` ndg Inner Join `".USER_GROUP_TABLE."` nbg ON `ndg`.`group_id` = `nbg`.`group_id`
                                        WHERE `nbg`.`user_id` =  '".$userinfo['user_id']."'
                                        AND `ndg`.`group_allowed_download` =  '1'
                                        AND ((`ndg`.`group_mintime` = '0') OR
                                            (UNIX_TIMESTAMP(now()) + `ndg`.`group_mintime` > '".$userinfo['DL_last_download']."'))
                                        AND `ndg`.`group_active` =  '1'");
        while ( list($temp_group) = $db->sql_fetchrow($result)) {
            // We build an array with Downloads-Groups the user is in
            // Because we add "2" on Downloads-Table for Groups, we have to add them here too
            $temp_group = intval($temp_group) + 2;
            $user_is_in_group[$temp_group] = $temp_group;
        }
        // Remember: Restrictions for Download is set on Download-Level and User Level - not on Category Level
        switch (intval($row_1['download_groups'])) {
            case -1: // no one is allowed - set on Download Level so Download-Level is the leading one
                     $userinfo['DL_auth_download'] = FALSE;
                     break;
            case 0 : // Everyone is allowed for Download
                     $userinfo['DL_auth_download'] = TRUE;
                     break;
            case 1 : // only registered Users are allowed
                     if (is_user() || is_mod_admin($module_name)) {
                        $userinfo['DL_auth_download'] = TRUE;
                     } else {
                        $userinfo['DL_auth_download'] = FALSE;
                     }
                     break;
            case 2 : // Admins only
                     if ( is_admin($module_name)) {
                        $userinfo['DL_auth_download'] = TRUE;
                     } else {
                        $userinfo['DL_auth_download'] = FALSE;
                     }
                     break;
            default: // There is a either a group set on Download Level so Download Level is the leading one - or 'download_groups' is empty
                     if ( !empty($row_1['download_groups']) && ($row_1['download_groups'] > 0)) {
                        if (in_array($row_1['download_groups'], $user_is_in_group)) {
                            $userinfo['DL_auth_download'] = TRUE;
                        } else {
                            $userinfo['DL_auth_download'] = FALSE;
                        }
                     } else {
                        $userinfo['DL_auth_download'] = FALSE;
                     }
        }
        /* This will be done in a later version
        // OK .. to finish Download Right, we have to check if user is active in Downloads Module and Download is forbidden to him
        if ($row_2['userid'] > 0) {
            $userinfo['DL_auth_download'] = FALSE;
        }
        */
        // Right to view could be set on Category Level and Download Level. Even too, on Category we can say: Override Download Level
        if ($cat_row['catoverride'] == '1') {
            // We only have to check Category Level, because Category overrides File Permissions
            switch (intval($cat_row['restricted_group_see'])) {
                case -1: // no one is allowed to see this Category
                         $userinfo['DL_auth_view'] = FALSE;
                         break;
                case 0 : // Everyone is allowed to see this Category
                         $userinfo['DL_auth_view'] = TRUE;
                         break;
                case 1 : // only registered Users are allowed
                         if (is_user() || is_mod_admin($module_name)) {
                            $userinfo['DL_auth_view'] = TRUE;
                         } else {
                            $userinfo['DL_auth_view'] = FALSE;
                         }
                         break;
                case 2 : // Admins only
                         if ( is_mod_admin($module_name)) {
                            $userinfo['DL_auth_view'] = TRUE;
                         } else {
                            $userinfo['DL_auth_view'] = FALSE;
                         }
                         break;
                default: // There is a either a group set on Download Level so Download Level is the leading one - or 'download_groups' is empty
                         if ( !empty($cat_row['restricted_group_see']) && ($cat_row['restricted_group_see'] > 0)) {
                            if (in_array($cat_row['restricted_group_see'], $user_is_in_group)) {
                                $userinfo['DL_auth_view'] = TRUE;
                            } else {
                                $userinfo['DL_auth_view'] = FALSE;
                            }
                         } else {
                            $userinfo['DL_auth_view'] = FALSE;
                         }
            }
        } else {
            // OK .. Category doesn't override Download Permissions, so we have to check it
            switch (intval($row_1['download_groups_see'])) {
                case -1: // no one is allowed to see this Category
                         $userinfo['DL_auth_view'] = FALSE;
                         break;
                case 0 : // Everyone is allowed to see this Category
                         $userinfo['DL_auth_view'] = TRUE;
                         break;
                case 1 : // only registered Users are allowed
                         if (is_user() || is_mod_admin($module_name)) {
                            $userinfo['DL_auth_view'] = TRUE;
                         } else {
                            $userinfo['DL_auth_view'] = FALSE;
                         }
                         break;
                case 2 : // Admins only
                         if ( is_mod_admin($module_name)) {
                            $userinfo['DL_auth_view'] = TRUE;
                         } else {
                            $userinfo['DL_auth_view'] = FALSE;
                         }
                         break;
                default: // There is either a group set on Download Level so Download Level is the leading one - or 'download_groups' is empty
                         if ( !empty($row_1['download_groups_see']) && ($row_1['download_groups_see'] > 0)) {
                            if (in_array($row_1['download_groups_see'], $user_is_in_group)) {
                                $userinfo['DL_auth_view'] = TRUE;
                            } else {
                                $userinfo['DL_auth_view'] = FALSE;
                            }
                         } else {
                            $userinfo['DL_auth_view'] = FALSE;
                         }
            }
        }
    } else {
        // Categorie and/or Download isn't active, so user has NO right to do something
        $userinfo['DL_auth_view']       = FALSE;
        $userinfo['DL_auth_download']   = FALSE;
        $userinfo['DL_auth_upload']     = FALSE;
    }
    return;
}

function DownloadsAllowed($did, $userid, $right='download') {
    global $userinfo;
    if ($userinfo['user_id'] != $userid) {
        die('Nice try ....');
    }
    switch ($right) {
        case '1':        $right='DL_auth_download'; break;
        case '2':        $right='DL_auth_upload'; break;
        case '3':        $right='DL_auth_view'; break;
        case 'download': $right='DL_auth_download'; break;
        case 'upload':   $right='DL_auth_upload'; break;
        case 'view':     $right='DL_auth_view'; break;
        default:         $right='DL_auth_view'; break;
    }
    DownloadsGetUserInfo($did);
    if ($userinfo[$right] == TRUE) {
        return TRUE;
    } else {
        return FALSE;
    }
}

if (is_admin($module_name)) {
    function downloads() {
        DownloadsHeader();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function DownloadsHeader() {
        global $admin_file, $db, $lang_new, $module_name, $totaldownloads, $downloadsconfig, $header_meta, $more_js, $more_styles;

        include_once(NUKE_BASE_DIR.'header.php');

        $cat                = $db->sql_unumrows("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `catactive` = 1");
        $subcat             = $db->sql_unumrows("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `catactive` = 1 AND `parentid` = 0");
        $downloadsconfig    = DownloadsConfig();
        $folder             = $downloadsconfig['downloads_basedir'];

        echo "<script type='text/javascript'>
          /*<![CDATA[*/\n
            function cat_val(){
                var category = '".$cat."';
                if (category == '' || category == 0){
                    Sexy.error('".$lang_new[$module_name]['ERROR_NO_CAT01']."');
                    return false;
                }
            }
            function subcat_val(){
                var subcat = '".$subcat."';
                if (subcat == '' || subcat == 0){
                    Sexy.error ('".$lang_new[$module_name]['ERROR_NO_CAT02']."');
                    return false;
                }
            }
            function base_dir(){
                var folder = '".$folder."';
                if (folder != 'modules/Downloads/files'){
                    Sexy.error ('".$lang_new[$module_name]['ERROR_BASEDIR_WRONG']."');
                    return false;
                }
            }
    \n/*]]>*/\n
        </script>\n";

        $totalbrokendownloads = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `download_broken`='1'");
        $totalmodrequests     = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `download_modified`='1'");
        $totalwaitvalidate    = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_NEWDOWNLOADS_TABLE."`");
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=Downloads'>" . $lang_new[$module_name]['ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>" . $lang_new[$module_name]['ADMIN_GO_MAIN'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class='title'><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOADSADMIN'] . "</strong></span><br /><br /><hr noshade='noshade' />";
        $totaldownloads = $db->sql_unumrows("SELECT * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."`");
        echo "<span class='content'>--&gt;&gt;&nbsp;" . $lang_new[$module_name]['THERE_ARE'] . "&nbsp;<strong>".$totaldownloads."</strong>&nbsp;" . $lang_new[$module_name]['DOWNLOADS_IN_DB'] . "&nbsp;&lt;&lt;--</span></center>";
        echo "<hr noshade='noshade' /><br />";
        echo "<table width='100%'>\n";
        echo "<tr>";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=AddNewDownload' onclick='return cat_val();'>" . $lang_new[$module_name]['ADMIN_ADD_DOWNLOAD']."</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsAddCat' onclick='return base_dir();'>" . $lang_new[$module_name]['ADMIN_ADD_CAT'] . "</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content' style='font-style:italic;'><a href='#' onclick=\"Sexy.info('".$lang_new[$module_name]['ADMIN_CAT_TRANSFER']."')\"><font color='#8d8d8d'>". $lang_new[$module_name]['ADMIN_LIST_GROUPS'] ."</font></a></span></td>\n"; //<a href='".$admin_file.".php?op=DownloadsGroupList'>
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsSettings'>". $lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] ."</a></span></td>\n";
        echo "</tr>";
        echo "<tr>";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsModSelect'>" . $lang_new[$module_name]['ADMIN_MODIFY_DOWNLOAD'] . "</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsAddSubCat' onclick='return subcat_val();'>" . $lang_new[$module_name]['ADMIN_ADD_SUBCAT'] . "</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsUserList'>" . $lang_new[$module_name]['ADMIN_LIST_USERS'] . "</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsListBrokenDownloads'>" . $lang_new[$module_name]['ADMIN_BROKEN_DOWNLOAD'] . " ($totalbrokendownloads)</a></span></td>\n";
        echo "</tr>";
        echo "<tr>";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsCheck'>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_CHECK'] . "</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsCatList'>" . $lang_new[$module_name]['ADMIN_LIST_CAT'] . "</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsCleanVotes'>" . $lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] . "</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'></span></td>\n";
        echo "</tr>";
        echo "<tr>";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsLicensesList'>" . $lang_new[$module_name]['ADMIN_LICENSES_LIST'] . "</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content' style='font-style:italic;'><a href='#' onclick=\"Sexy.info('".$lang_new[$module_name]['ADMIN_CAT_TRANSFER']."')\"><font color='#8d8d8d'>" . $lang_new[$module_name]['ADMIN_TRANSFER_CAT'] . "</font></a></span></td>\n"; //<a href='".$admin_file.".php?op=DownloadsTransferCat'>
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsExtList'>" . $lang_new[$module_name]['ADMIN_EXTENSIONS_LIST'] . "</a></span></td>\n";
        echo "<td width='25%' height='20px' align='left' class='extra' nowrap='nowrap' ><span class='content'><a href='".$admin_file.".php?op=DownloadsListValidateDownloads'>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_VALIDATE'] . " ($totalwaitvalidate)</a></span></td>\n";
        echo "</tr>";
        echo "</table>";
        CloseTable();
        echo "<br />";
    }

    function DownloadsMakeDirectory($newdir) {
        return EvoKernel_CreateDir($newdir);
    }

    function DownloadsdeepCat($catid, $catary) {
        global $db;
        static $catary, $counter;
        $allcats = $db->sql_query("SELECT `cid`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `parentid` =".$catid);
        while ( list($catid, $parentid) = $db->sql_fetchrow($allcats) ) {
            $counter++;
            $catary[$counter] = $catid;
            DownloadsdeepCat($catid, $catary);
        }
        $db->sql_freeresult($allcats);
        return $catary;
    }

    // select_gallery function by RTC4EVER
    function DownloadsSelectGallery($name='default', $gallery='', $img_show = FALSE, $selected='', $tabindex=0) {

        if ($tabindex > 0) {
            $tab = "tabindex='".$tabindex."'";
        } else {
            $tab = '';
        }
        if (empty($gallery)) {
            $select = "<select class='set' name='".$name."' id='".$name."' ".$tab.">";
            $select .= "<option value='".FALSE."' >"._NONE."</option>";
            return $select.'</select>';
        }
        if ( substr($gallery, 0, 1) == '/' ) {
            $gallery = substr($gallery, 1);
        }
        if ( substr($gallery, -1) == '/' ) {
            $gallery = substr($gallery, 0, strlen($gallery) -1);
        }
        $dir        = NUKE_BASE_DIR.$gallery;
        $href_dir   = NUKE_HREF_BASE_DIR.$gallery;
        if (is_dir($dir)) {
            if (!defined('GALLERY_JAVASCRIPT') && ($img_show == TRUE)) {
                $select = '<script language="javascript" type="text/javascript">
                            <!--
                            function update_gallery(newimage)
                            {
                                document.gallery_image.src = newimage;
                            }
                            //-->
                            </script>';
                define('GALLERY_JAVASCRIPT', TRUE);
            }
            if ( $img_show == TRUE ) {
                $select .= "<select class='set' name='".$name."' id='".$name."' onchange='update_gallery(this.options[selectedIndex].value);' ".$tab.">";
            } else {
                $select .= "<select class='set' name='".$name."' id='".$name."' ".$tab.">";
            }
            if ( empty($selected)) {
                $select .= "<option value='".NUKE_IMAGES_BASE_DIR."evo/spacer.gif' selected='selected'>"._NONE."</option>";
            } else {
                $select .= "<option value='".NUKE_IMAGES_BASE_DIR."evo/spacer.gif' >"._NONE."</option>";
            }
            $exclude        = ".|..";
            $recursive      = true;
            $path           = rtrim($gallery, "/") . "/";
            $folder_handle  = opendir($path);
            $exclude_array  = explode("|", $exclude);
            $result         = array();
            while(false !== ($filename = readdir($folder_handle))) {
                if(!in_array(strtolower($filename), $exclude_array)) {
                    if(is_dir(realpath($path . $filename . "/"))) {
                    } else {
                        $result[] = $filename;
                      /*  $exp = explode('.',$filename);

                        if ($selected == $exp[0]){
                            $select .= "<option value='modules/Downloads/images/categories/".$filename."' selected='selected'>".$exp[0]."</option>";
                        } else {
                            $select .= "<option value='modules/Downloads/images/categories/".$filename."'>".$exp[0]."</option>";
                        }*/
                    }
                }
            }
            sort($result);
            foreach ($result as $key => $value){
                $exp = explode('.',$value);
                if ($selected == "modules/Downloads/images/categories/".$value){
                    $select .= "<option value='modules/Downloads/images/categories/".$value."' selected='selected'>".$exp[0]."</option>";
                } else {
                    $select .= "<option value='modules/Downloads/images/categories/".$value."'>".$exp[0]."</option>";
                }
            }
        } else {
            $select = "<select class='set' name='".$name."' id='".$name."'>";
            $select .= "<option value='".FALSE."' >"._NONE."</option>";
        }
        if ( $img_show == TRUE ) {
            if (!empty($selected)){
                return $select."</select>&nbsp;<br /><img name='gallery_image' src='".$selected."' border='0' alt='' />";
            } else {
                return $select."</select>&nbsp;<br /><img name='gallery_image' src='".NUKE_IMAGES_BASE_DIR."evo/spacer.gif' border='0' alt='' />";
            }
        } else {
            return $select."</select>";
        }
    }
    function evo_explode($delim, $str, $lim = 1) {
        if ($lim > -2) return explode($delim, $str, abs($lim));

        $lim = -$lim;
        $out = explode($delim, $str);
        if ($lim >= count($out)) return $out;

        $out = array_chunk($out, count($out) - $lim + 1);

        return array_merge(array(implode($delim, $out[0])), $out[1]);
    }


    function DownloadsDeleteDirectory($cid) {
        global $db;
        // We have the order to delete all files which are in the category and physically stored on our server
        // So we first have to get all categories below our selected category
        $fileerror = 0;
        $direrror  = 0;
        $catarray  = array();
        $sql_ary   = '';
        $database  = array();
        $physical  = array();
        $upgrade   = array();
        $childcats = array();
        $error     = array();
        $childcats = DownloadsdeepCat($cid, $catarray);
        // Add our selected category
        $childcats[0] = $cid;
        // Ok, now we have all categories. We now need all downloads inside those categories
        foreach ( $childcats as $number => $cat ) {
            $sql_ary .= $cat . ',';
        }
        // Add a category which is never possible, to get a correct sql-statement
        $sql_ary .= '-1';
        $result = $db->sql_query("SELECT `download_filename`, `did`, `download_type`, `image` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid` IN ($sql_ary)");
        // Now we have all Downloads inside the category and subcategories selected
        while ( list($filename, $did, $type, $image) = $db->sql_fetchrow($result) ) {
            switch ($type) {
                case '1':
                    // Download is an external link, so we must only delete him from database
                    $database[$did] = $did;
                    break;
                case '2':
                    // Download is a physically stored file, so we must delete him from database and from server
                    $physical[$did]['did']      = $did;
                    $physical[$did]['filename'] = $filename;
                    $physical[$did]['image']    = $image;
                    break;
                case '3':
                    // Download is a link to a physically stored file
                    $upgrade[$did]['did']       = $did;
                    $upgrade[$did]['filename']  = $filename;
                    $physical[$did]['image']    = $image;
                    break;
            }
        }
        $db->sql_freeresult($result);
        // OK, first is to delete the links
        if ( count($database) > 0 ) {
            foreach ( $database as $delete_no => $delete_did) {
                $db->sql_uquery("DELETE FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did` = '$delete_did'");
            }
        }
        // Ok, next is to delete links to physical stored files
        if ( count($upgrade) > 0 ) {
            foreach ($upgrade as $upgrade_no => $upgrade_did) {
                $act_did  = $upgrade_did['did'];
                $act_file = $upgrade_did['filename'];
                $act_image= $upgrade_did['image'];
                // Select first link from downloads table which is a link to our physical file
                $result = $db->sql_ufetchrow("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `download_filename` = '$act_file'
                                                AND `download_type`= '3' AND `did` < > '$act_did' LIMIT 1");
                // Make this link now type physical
                $db->sql_uquery("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` SET `download_type` = '2' WHERE `did`= '".$result['did']."'");
                // Because physically deleting is later, we only have to add the did to the physical array
                $physical[$act_did]['did']      = $act_did;
                $physical[$act_did]['filename'] = $act_file;
                $physical[$act_did]['image']    = $act_image;
            }
        }
        // OK, next is to delete physically files
        if ( count($physical) > 0 ) {
            foreach ( $physical as $delete_no => $delete_did) {
                $del_file = $delete_did['filename'];
                $del_image= $delete_did['image'];
                $del_did  = $delete_did['did'];
                $del_dir = evo_explode('/', $del_file, -2);
                $download_file = evo_explode('/', 'download_filename', -2);
                $totalcatdir = $db->sql_unumrows("SELECT FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE = `$download_file[0]` = '".NUKE_BASE_DIR . $del_dir[0]."'");

                if (@is_file($del_image)) {
                    @unlink($del_image);
                }
                if (@is_file($del_file)) {
                    @unlink($del_file);
                    @rmdir(NUKE_BASE_DIR . $del_dir[0] . '/images');
                    @rmdir(NUKE_BASE_DIR . $del_dir[0]);
                }
                if (!@is_file($del_file) && !@is_file($del_image)) {
                    $db->sql_uquery("DELETE FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did` = '$del_did'");
                } else {
                    $fileerror++;
                    $error['file'][$del_did] = $del_file;
                }
            }
        }

        // OK, we deleted the files. Now we have to delete the directories of the categories involved
        // Directory-Path is stored as path beginning from root. So the only thing we have to test (before we delete the category) is,
        // if another Category have the same path or a path deeper than our category we want to delete
        // We cannot avoid the number of sql-statements here to be compatible with MySQL < 4.1
        @arsort($childcats); // Thanks to RTC4EVER for this hint

        foreach ( $childcats as $number => $cat ) {
            $search_dir = $db->sql_ufetchrow("SELECT `uploaddir`, `title` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid` = '$cat'");
            $number = $db->sql_ufetchrow("SELECT COUNT(`cid`) as no FROM `"._DOWNLOADS_CATEGORIES_TABLE."`
                                          WHERE `cid` NOT IN ($sql_ary) AND `uploaddir` REGEXP '".$search_dir['uploaddir']."'");
            if ( $number['no'] > 0 ) {
                // We cannot delete the directory because there are others
                // Because this is no error, we can continue
                $db->sql_uquery("DELETE FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid` = '$cat'");
            } else {
                if (@is_dir(NUKE_BASE_DIR . $search_dir['uploaddir'] . '/images')) {
                    @rmdir(NUKE_BASE_DIR . $search_dir['uploaddir'] . '/images');
                    } else {
                        $direrror++;
                        $error['cat'][$cat] = $search_dir['title'];
                        }
                if (@is_dir(NUKE_BASE_DIR . $search_dir['uploaddir'])) {
                    if (@rmdir(NUKE_BASE_DIR . $search_dir['uploaddir'])) {
                        $db->sql_uquery("DELETE FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid` = '$cat'");
                    } else {
                        $direrror++;
                        $error['cat'][$cat] = $search_dir['title'];
                    }
                } else {
                    $direrror++;
                    $error['cat'][$cat] = $search_dir['title'];
                }
            }
        }
        if ( $fileerror > 0 || $direrror > 0 ) {
            $error['ok'] = 'notok';
            return $error;
        } else {
            $error['ok'] = 'ok';
            return $error;
        }
    }


    function DownloadsCutDirectorySlashesStart(&$newdir, $REC = 0) {
        if( (substr($newdir,0,1) != '/') && (substr($newdir,0,1) != '\\')) {
            if ($REC == 1) {
                return TRUE;
            } else {
                return $newdir;
            }
        } else {
            $newdir = substr($newdir,1);
            if (!DownloadsCutDirectorySlashesStart($newdir, 1)) return FALSE;
        }
        return $newdir;
    }

    function DownloadsCutDirectorySlashesEnd(&$newdir, $REC = 0) {
        if( (substr($newdir,-1,1) != '/') && (substr($newdir,-1,1) != '\\')) {
            if ($REC == 1) {
                return TRUE;
            } else {
                return $newdir;
            }
        } else {
            $newdir = substr($newdir,0,-1);
            if (!DownloadsCutDirectorySlashesEnd($newdir, 1)) return FALSE;
        }
        return $newdir;
    }

    function DownloadsCatList() {
        global $db, $admin_file, $lang_new, $module_name;
        DownloadsHeader();

        OpenTable();
        $numrows = $db->sql_numrows($db->sql_query("SELECT `cid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."`"));
        if ($numrows>0) {
            echo "<center><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_MODIFY_CAT'] . "</strong></span></center><br /><br />\n";
            echo "<form method='post' action='".$admin_file.".php' name='selectmodifycat'>";
            echo "<table width='100%' border='0'>\n";
            $result11 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` ORDER BY `title` ASC");
            echo "<tr><td align='left'>". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
            echo "<select name='cat'>";
            while($row11 = $db->sql_fetchrow($result11)) {
                $cid2 = intval($row11['cid']);
                $ctitle2 = stripslashes($row11['title']);
                $parentid2 = intval($row11['parentid']);
                if ($parentid2!=0) {
                    $ctitle2=DownloadsGetParent($parentid2,$ctitle2);
                }
                echo "<option value='".$cid2."'>".$ctitle2."</option>";
            }
            $db->sql_freeresult($result11);
            echo "</select>\n";
            echo "</td></tr>";
            echo "</table><br />";
            echo "<input type='hidden' name='op' value='DownloadsModCat' />";
            echo "<center><input type='submit' value='" . $lang_new[$module_name]['SUBMIT_MODIFY'] . "' /></center>";
            echo "</form>\n";
        } else {
            echo "<br /><br /><center>". $lang_new[$module_name]['WARN_CAT_NOT_FOUND'] ."</center><br /><br />\n";
            echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function DownloadsTransfer($cidfrom,$cidto) {
        global $db, $admin_file;
        $db->sql_uquery("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` SET `cid`=$cidto WHERE `cid`='$cidfrom'");
        redirect($admin_file.".php?op=Downloads");
    }

    function DownloadsDelComment($did, $rddbid) {
        global $db, $admin_file;
        $db->sql_uquery("UPDATE `"._DOWNLOADS_VOTEDATA_TABLE."` SET `ratingcomments`='' WHERE `ratingdbid` = '$rddbid'");
        $db->sql_uquery("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` SET `totalcomments` = (`totalcomments` - 1) WHERE `did` = '$did'");
        redirect($admin_file.".php?op=DownloadsModDownload&amp;did=$did");
    }

    function DownloadsDelVote($did, $rddbid) {
        global $db, $admin_file, $module_name;
        $db->sql_uquery("DELETE FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratingdbid`=$rddbid");
        $voteresult = $db->sql_query("SELECT `rating`, `ratinguser`, `ratingcomments` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratingdid` = '$rddbid'");
        $totalvotesDB = $db->sql_numrows($voteresult);
        include(NUKE_MODULES_DIR.$module_name.'/public/VoteInclude.php');
        $db->sql_uquery("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` SET `downloadratingsummary`='$finalrating', `totalvotes`='$totalvotesDB', `totalcomments`='$truecomments' WHERE `did` = '$did'");
        redirect($admin_file.".php?op=DownloadsModDownload&did=$did");
    }

    function DownloadsDelBrokenDownloads($did) {
        global $db, $admin_file, $cache;
        $db->sql_query("DELETE FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE did='$did'");
        $cache->delete('numbrokend', 'submissions');
        $cache->delete('nummodreqd', 'submissions');
        redirect($admin_file.".php?op=DownloadsListBrokenDownloads");
    }

    function DownloadsIgnoreBrokenDownloads($did) {
        global $db, $admin_file, $cache;
        $db->sql_uquery("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` set
                        `download_modifier`='',
                        `download_modifier_ip`='',
                        `download_broken`=0,
                        `download_modified_time`= 0,
                        `download_modified_text`=''
                        WHERE `did`='$did'");
        $cache->delete('numbrokend', 'submissions');
        redirect($admin_file.'.php?op=DownloadsListBrokenDownloads');
    }

    function DownloadsIgnoreModRequestDownloads($did) {
        global $db, $admin_file, $cache;
        $db->sql_uquery("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` set
                        `download_modifier`='',
                        `download_modifier_ip`='',
                        `download_modified`=0,
                        `download_modified_time`= 0,
                        `download_modified_text`=''
                        WHERE `did`='$did'");
        $cache->delete('nummodreqd', 'submissions');
        redirect($admin_file.'.php?op=DownloadsListModRequests');
    }

    function DownloadsDelDownload($did, $min, $is_validate=FALSE) {
        global $db, $admin_file, $cache, $lang_new, $module_name;

        $min = (intval($min)) ? intval($min) : 0;
        $error = FALSE;
        $error_message = '';
        if ($is_validate) {
            $row = $db->sql_query("SELECT `image`, `download_filename` FROM `"._DOWNLOADS_NEWDOWNLOADS_TABLE."` WHERE `did`=$did");
        } else {
            $row = $db->sql_query("SELECT `image`, `download_filename` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did`='$did'");
        }

        while ($rows = $db->sql_fetchrow($row)){
            $del_file = stripslashes($rows['download_filename']);
            $del_image = stripslashes($rows['image']);
        }

         if (@strlen($del_image) > 1) {
            if (@is_file($del_image)) {
                @unlink($del_image);
            }
        }
        if (@is_file($del_file)) {
            if (@unlink($del_file)) {
                if ($is_validate) {
                    $db->sql_uquery("DELETE FROM `"._DOWNLOADS_NEWDOWNLOADS_TABLE."` WHERE `did` = '$did'");
                } else {
                    $db->sql_uquery("DELETE FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did` = '$did'");
                }
            } else {
                $error = TRUE;
                $error_message = '<br />'.$lang_new[$module_name]['ERROR_FILE_DELETION'].':<br />'.$del_file.'<br />';
            }
        } else {
            $error = TRUE;
            $error_message = '<br />'.$lang_new[$module_name]['ERROR_FILEDELNOT_EXISTS'].'<br />';
        }
        if ($error) {
            DownloadsHeader();
            OpenTable();
            echo "<center><font color='red'>".$error_message."</font><br /><br />";
            echo "<center>[ <a href='".$admin_file.".php?op=DownloadsDelDBRow&amp;did=".$did."&amp;is_validate=".$is_validate."'>" . $lang_new[$module_name]['SUBMIT_DELETE'] . "</a> ]</center>\n";
            echo "<br />";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        } else {
            $cache->delete('numbrokend', 'submissions');
            $cache->delete('nummodreqd', 'submissions');
            $cache->delete('numwaitd', 'submissions');
            if ($is_validate) {
                redirect($admin_file.".php?op=DownloadsListValidateDownloads");
            } else {
                redirect($admin_file.".php?op=DownloadsModSelect&amp;min=$min");
            }
        }
    }

    function DownloadsDelDBRow($did, $min, $is_validate=FALSE) {
        global $db, $admin_file, $cache;

        if ($is_validate) {
            $db->sql_uquery("DELETE FROM `"._DOWNLOADS_NEWDOWNLOADS_TABLE."` WHERE did='".$did."'");
        } else {
            $db->sql_uquery("DELETE FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE did='".$did."'");
        }
        $cache->delete('numbrokend', 'submissions');
        $cache->delete('nummodreqd', 'submissions');
        $cache->delete('numwaitd', 'submissions');
        if ($is_validate) {
            redirect($admin_file.".php?op=DownloadsListValidateDownloads");
        } else {
            redirect($admin_file.".php?op=DownloadsModSelect&amp;min=$min");
        }
    }

    function DownloadsModEditorial($downloadid, $editorialtitle, $editorialtext) {
        global $db, $admin_file, $lang_new, $module_name, $_GETVAR;
        $editorialtext = FixQuotes($editorialtext);
        $db->sql_uquery("UPDATE `"._DOWNLOADS_EDITORIALS_TABLE."` SET `editorialtext`='$editorialtext', `editorialtitle`='$editorialtitle' WHERE `downloadid`='$downloadid'");
        DownloadsHeader();
        OpenTable();
        echo "<center><span class='option'>"
            . $lang_new[$module_name]['MESSAGE_EDITORIAL_MODIFIED'] . "<br />"
            ."[ <a href='".$admin_file.".php?op=Downloads'>" . $lang_new[$module_name]['ADMIN_DOWNLOADSADMIN'] . "</a> ]<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function DownloadsDelEditorial($downloadid) {
        global $db, $admin_file, $lang_new, $module_name;
        $db->sql_uquery("DELETE FROM `"._DOWNLOADS_EDITORIALS_TABLE."` WHERE `downloadid`='$downloadid'");
        DownloadsHeader();
        OpenTable();
        echo "<center><span class='option'>"
            .$lang_new[$module_name]['MESSAGE_EDITORIAL_REMOVED'] . "<br />"
            ."[ <a href='".$admin_file.".php?op=Downloads'>" . $lang_new[$module_name]['ADMIN_DOWNLOADSADMIN'] . "</a> ]<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }


    function DownloadsAddEditorial($downloadid, $editorialtitle, $editorialtext) {
        global $aid, $db, $admin_file, $lang_new, $module_name, $_GETVAR;
        $editorialtext = FixQuotes($editorialtext);
        $db->sql_uquery("INSERT INTO `"._DOWNLOADS_EDITORIALS_TABLE."` (`downloadid`, `adminid`, `editorialtimestamp`, `editorialtext`, `editorialtitle`) VALUES ('$downloadid', '$aid', ". time() .", '$editorialtext', '$editorialtitle')");
        DownloadsHeader();
        OpenTable();
        echo "<center><span class=option>"
            . $lang_new[$module_name]['MESSAGE_EDITORIAL_ADDED'] . "<br />"
            ."[ <a href='".$admin_file.".php?op=Downloads'>" . $lang_new[$module_name]['ADMIN_DOWNLOADSADMIN'] . "</a> ]<br />";
        echo "$downloadid  $adminid, $editorialtitle, $editorialtext";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    // Copyright (c) 2003 --- NukeScripts Network ---
    // Can not be reproduced in whole or in part without
    // written consent from NukeScripts Network CEO
    function downloadspagenums_admin($op, $totalselected, $perpage, $max) {
        global $admin_file, $lang_new, $module_name;
        $pagesint = ($totalselected / $perpage);
        $pageremainder = ($totalselected % $perpage);
        if ($pageremainder != 0) {
            $pages = ceil($pagesint);
            if ($totalselected < $perpage) { $pageremainder = 0; }
        } else {
            $pages = $pagesint;
        }
        if ($pages != 1 && $pages != 0) {
            $counter = 1;
            $currentpage = ($max / $perpage);
            echo "<form action='".$admin_file.".php' method='post'>\n";
            echo "<table border='0' cellpadding='2' cellspacing='2' width='100%'>\n";
            echo "<tr>\n";
            echo "<td align='right'><strong>".$lang_new[$module_name]['PAGE'].":&nbsp;</strong><select name='min' onchange='top.location.href=this.options[this.selectedIndex].value'>\n";
            while ($counter <= $pages ) {
                $cpage = $counter;
                $mintemp = ($perpage * $counter) - $perpage;
                if ($counter == $currentpage) {
                    echo "<option selected='selected'>".$counter."</option>\n";
                } else {
                    echo "<option value='".$admin_file.".php?op=".$op."&amp;min=".$mintemp;

                    if ($op > '' ) { echo "&amp;op=".$op; }
                    //if ($query > '') { echo "&amp;query=".$query; }
                    if (isset($cid)) { echo "&amp;cid=".$cid; }
                    echo "'>".$counter."</option>\n";
                }
                $counter++;
            }
            echo "</select><strong> ".$lang_new[$module_name]['OF']."&nbsp;".$pages."&nbsp;".$lang_new[$module_name]['PAGES']."</strong></td>\n</tr>\n";
            echo "</table>\n";
            echo "</form>\n";
        }
    }

    function DownloadsExtDel($eid, $min) {
        global $db, $admin_file;
        $db->sql_uquery("DELETE FROM `"._DOWNLOADS_EXTENSIONS_TABLE."` WHERE `eid`='".$eid."'");
        redirect($admin_file.'.php?op=DownloadsExtList&amp;min='.$min);
    }

    function DownloadsExtActivate($eid, $min) {
        global $db, $admin_file;
        $db->sql_uquery("UPDATE `"._DOWNLOADS_EXTENSIONS_TABLE."` SET `active`='1' WHERE `eid`='".$eid."'");
        redirect($admin_file.'.php?op=DownloadsExtList&amp;min='.$min);
    }

    function DownloadsExtDeactivate($eid, $min) {
        global $db, $admin_file;
         $db->sql_uquery("UPDATE `"._DOWNLOADS_EXTENSIONS_TABLE."` SET `active`='0' WHERE `eid`='".$eid."'");
        redirect($admin_file.'.php?op=DownloadsExtList&amp;min='.$min);
    }

    function DownloadsExtModifyS($eid, $min, $add_extension, $add_extmimetype, $add_extdescription, $add_exttype, $add_extactive) {
        global $db, $admin_file;
        $db->sql_uquery("UPDATE `"._DOWNLOADS_EXTENSIONS_TABLE."` SET
                `ext`           = '".$add_extension."',
                `mimetype`      = '".$add_extmimetype."',
                `description`   = '".$add_extdescription."',
                `type`          = '".$add_exttype."',
                `active`        = '".$add_extactive."'
                WHERE `eid`='".$eid."'");
        redirect($admin_file.'.php?op=DownloadsExtList&amp;min='.$min);
    }

    // ***** This could be used to remove the last comma on reporting every Allowed Extension 'example : .jpg, .png, .zip(,)'... You never know. ;)
    function DeleteLastComma($str) {
        return preg_replace("/(.*),([^,]+)$/", "$1$2", $str);
    }

    function DownloadsUploadsAllowed() {
        global $downloadsconfig;

        $allowed = TRUE;
        if (ini_get('file_uploads') == FALSE ) {
            $allowed = FALSE;
            $conn_id        = @ftp_connect($downloadsconfig['ftp_server']);
            $login_result   = @ftp_login($conn_id, $downloadsconfig['ftp_user'], $downloadsconfig['ftp_pass']);
            if ($login_result) {
                $allowed = TRUE;
            }
            @ftp_quit($conn_id);
        }
        return $allowed;
    }

    function DownloadsGroupSelect($default) {
        global $db, $module_name, $lang_new;

        $gresult = $db->sql_query("SELECT `dg`.`group_id`, `bb`.`group_name` FROM (`"._DOWNLOADS_GROUPS_TABLE."` dg LEFT JOIN `".GROUPS_TABLE."` bb ON `bb`.`group_id` = `dg`.`group_id`) WHERE `dg`.`group_active` = '1' ORDER BY group_name");
        $counted = $db->sql_numrows($gresult);
        $sel1 = $sel2 = $sel3 = $sel4 = $sel5 = '';
        switch($default) {
            case -1:
                $sel1 = "selected='selected'";
                break;
            case 0:
                $sel2 = "selected='selected'";
                break;
            case 1:
                $sel3 = "selected='selected'";
                break;
            case 2:
                $sel4 = "selected='selected'";
                break;
        }
        $groups  = "<optgroup label='".$lang_new[$module_name]['ALLOWED_GENERAL']."'>\n";
        $groups .= "<option value='-1' ".$sel1.">".$lang_new[$module_name]['ALLOWED_NONE']."</option>\n";
        $groups .= "<option value='0'  ".$sel2.">".$lang_new[$module_name]['ALLOWED_ANY']."</option>\n";
        $groups .= "<option value='1'  ".$sel3.">".$lang_new[$module_name]['ALLOWED_REGISTERED']."</option>\n";
        $groups .= "<option value='2'  ".$sel4.">".$lang_new[$module_name]['ALLOWED_ADMINS']."</option>\n";
        $groups .= "</optgroup>\n";
        if ($counted > 0) {
            $groups .= "<optgroup label='".$lang_new[$module_name]['ALLOWED_GROUPS']."'>\n";
            while($gdinfo = $db->sql_fetchrow($gresult))  {
                $gidinfo['group_id'] = $gdinfo['group_id']+2;
                if ($gidinfo['group_id'] == $default) {
                    $sel5 = "selected='selected'";
                } else {
                    $sel5 = '';
                }
                $groups .= "<option value='".$gidinfo['group_id']."' ".$sel5.">".$lang_new[$module_name]['ALLOWED_ONLY']." ".$gdinfo['group_name']."</option>\n";
            }
            $groups .= "</optgroup>\n";
        }
        $db->sql_freeresult($gresult);
        return $groups;
    }

    function DownloadsIsValid($filename='', $url='', $type=2) {
        if ($type == 2) {
            if ( @file_exists($filename)) {
                $is_active = true;
            } else {
                $is_active = false;
            }
        } elseif ($type == 1) {
            $exist_tmp = DownloadsLinkCheck($url);
            $is_active     = (($exist_tmp['error'] > 0) ? false : true);
        } else {
            if ( @file_exists($filename)) {
                $is_active = true;
            } else {
                $is_active = false;
            }
        }
        return $is_active;
    }

    function DownloadsFileCheck($fileurl) {
        global $downloadsconfig, $lang_new, $module_name;
        $error = 1;
        $error_msg = $lang_new[$module_name]['ERROR_LINK_UNKNOWN'];
        if (@is_file($fileurl) ) {
            $file['size']  = @filesize($fileurl);
            $file_parts    = @pathinfo($fileurl);
            $file['name']  = $file_parts['basename'];
            $file['extension']  = $file_parts['extension'];
            $file['type']  = get_mime_content_type($filename);
            if ( DownloadsIsAllowedExtension($file) == 0 ) {
                $error = 3;
                $error_msg = $lang_new[$module_name]['ERROR_WRONG_TYPE'] . ": ".$file['extension'];
            } else {
                $error = 0;
                $error_msg = '';
            }
        }
        $file['error'] = $error;
        $file['error_msg'] = $error_msg;
        return $file;
    }

    function DownloadsLicensesDel($licenseid, $min) {
        global $db, $admin_file;
        $licenseid = intval($licenseid);
        $db->sql_uquery("DELETE FROM `"._DOWNLOADS_LICENSES_TABLE."` WHERE `license_id`='$licenseid'");
        redirect($admin_file.'.php?op=DownloadsLicensesList&amp;min='.$min);
    }

    function DisplayErrorDL($msg) {
        header("Cache-control: admin/AddNewDownload.php");
        include_once(NUKE_BASE_DIR.'header.php');
        echo '<div align="center">'.$msg.'</div>';
        foreach($_POST as $key=>$value){
            $_SESSION[$key]=$value;
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}
?>