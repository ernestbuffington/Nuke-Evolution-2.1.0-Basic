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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (!defined('IN_REVIEWS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN REVIEWS ADMINISTRATION');
}

function ReviewsConfig()
{
  global $db, $module_name, $cache, $lang_new;
  static $reviewsconfig;
    if(isset($reviewsconfig) && is_array($reviewsconfig)) { return $reviewsconfig; }
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

function reviewsHeader()
{
  global $admin_file, $db, $lang_new, $module_name, $totalreviews;
    include_once(NUKE_BASE_DIR.'header.php');
    $totalbrokenreviews = $db->sql_numrows($db->sql_query("SELECT `requestid` FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `brokenreview`='1'"));
    $totalmodrequests = $db->sql_numrows($db->sql_query("SELECT `requestid` FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `brokenreview`='0'"));
    $totalwaitvalidate = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_NEWREVIEW_TABLE."`"));
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Reviews\">" . $lang_new[$module_name]['ADMIN_HEADER'] . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['ADMIN_GO_MAIN'] . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><span class=\"title\"><strong>" . $lang_new[$module_name]['ADMIN_REVIEWSADMIN'] . "</strong></span><br /><br /><hr noshade=\"noshade\" />";

    $result = $db->sql_query("SELECT `rid` FROM `" . _REVIEWS_REVIEWS_TABLE . "`");
    $totalreviews = $db->sql_numrows($result);
    echo "<span class=\"content\">-->> " . $lang_new[$module_name]['THERE_ARE'] . " <strong>$totalreviews</strong> " . $lang_new[$module_name]['REVIEWS_IN_DB'] . " <<--</span></center>";
    echo "<hr noshade=\"noshade\" /><br />";
    echo "<table width=\"100%\">\n";
    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=AddNewReview\">" . $lang_new[$module_name]['ADMIN_ADD_REVIEW'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewsAddMainCategory\">" . $lang_new[$module_name]['ADMIN_ADD_CAT'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewsSettings\">". $lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] ."</a></span></td>\n";
    echo "</tr>";

    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=SelectModifyReview\">" . $lang_new[$module_name]['ADMIN_MODIFY_REVIEW'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewsAddSubCat\">" . $lang_new[$module_name]['ADMIN_ADD_SUBCAT'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewsListBrokenReviews\">" . $lang_new[$module_name]['ADMIN_BROKEN_REVIEW'] . " ($totalbrokenreviews)</a></span></td>\n";
    echo "</tr>";

    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewsLinkCheck\">" . $lang_new[$module_name]['ADMIN_REVIEW_CHECK'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewsSelectModifyCategory\">" . $lang_new[$module_name]['ADMIN_MODIFY_CAT'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewsListModRequests\">" . $lang_new[$module_name]['ADMIN_MODIFY_REVIEW_REQUEST'] . " ($totalmodrequests)</a></span></td>\n";
    echo "</tr>";

    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewTransferCat\">" . $lang_new[$module_name]['ADMIN_TRANSFER_CAT'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewsListNewReviews\">" . $lang_new[$module_name]['ADMIN_REVIEW_VALIDATE'] . " ($totalwaitvalidate)</a></span></td>\n";
    echo "</tr>";

    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=ReviewsCleanVotes\">" . $lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"></span></td>\n";
    echo "</tr>";
    echo "</table>";
    CloseTable();
    echo "<br />";
}

function reviewgetparent($parentid,$title) {
    global $db;
    $parentid = intval($parentid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, parentid FROM " . _REVIEWS_CATEGORIES_TABLE . " WHERE cid='$parentid'"));
    $ptitle = $row['title'];
    $pparentid = intval($row['parentid']);
    $db->sql_freeresult($result);
    if (!empty($ptitle)) $title=$ptitle." -> ".$title;
    if ($pparentid!=0) {
        $title=reviewgetparent($pparentid,$title);
    }
    return $title;
}

function ReviewsAddMainCategory()
{
    global $db, $admin_file, $lang_new, $module_name, $bgcolor2;
    reviewsHeader();

    $cdescription = '';
    OpenTable();
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_ADD_CAT'] . "</strong></span></center><br /><br />\n";
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"addmaincat\">";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['NAME'] . ": </td><td><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"50\" /></td></tr>";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE_URL']. ": </td><td><input type=\"text\" name=\"imageurl\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['REVIEW_IMAGE']. ": </td><td>".select_gallery('image', 'images/topics', TRUE)."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
    echo Make_TextArea('cdescription',$cdescription, 'addmaincat');
    echo "</td></tr>";
    echo "</table>";
    echo "<input type=\"hidden\" name=\"op\" value=\"ReviewsAddCat\" />";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_ADD'] . "\" /></center><br />";
    echo "</form>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

}

function ReviewsSelectModifyCategory()
{
    global $db, $admin_file, $lang_new, $module_name;
    reviewsHeader();

    OpenTable();
    $numrows = $db->sql_numrows($db->sql_query("SELECT `cid` FROM `"._REVIEWS_CATEGORIES_TABLE."`"));
    if ($numrows>0) {
        echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_MODIFY_CAT'] . "</strong></span></center><br /><br />\n";
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectmodifycat\">";
        echo "<table width=\"100%\" border=\"0\">\n";
        $result11 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._REVIEWS_CATEGORIES_TABLE."` ORDER BY `title` ASC");
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
        echo "<select name=\"cat\">";
        while($row11 = $db->sql_fetchrow($result11)) {
            $cid2 = intval($row11['cid']);
            $ctitle2 = stripslashes($row11['title']);
            $parentid2 = intval($row11['parentid']);
            if ($parentid2!=0) {
                $ctitle2=reviewgetparent($parentid2,$ctitle2);
            }
            echo "<option value=\"$cid2\">$ctitle2</option>";
        }
        $db->sql_freeresult($result11);
        echo "</select>\n";
        echo "</td></tr>";
        echo "</table><br />";
        echo "<input type=\"hidden\" name=\"op\" value=\"ReviewsModCat\" />";
        echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_MODIFY'] . "\" /></center>";
        echo "</form>\n";
    } else {
        echo "<br /><br /><center>". $lang_new[$module_name]['WARN_CAT_NOT_FOUND'] ."</center><br /><br />\n";
        echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function reviews() {
    reviewsHeader();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function SelectModifyReview()
{
  global $db, $admin_file, $lang_new, $module_name;
  reviewsHeader();

    OpenTable();
    $numrows = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."`"));
    if ($numrows>0) {
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_MODIFY_REVIEW'] . "</strong></span></center><br /><br />\n";
      echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectmodifyreview\">";
      echo "<table width=\"100%\" border=\"0\">\n";
        $result1 = $db->sql_query("SELECT `rid`, `title` FROM `"._REVIEWS_REVIEWS_TABLE."` ORDER BY `title`");
    echo "<tr><td align=\"left\">". $lang_new[$module_name]['REVIEW_ID'] . ": ";
    echo "&nbsp;";
    echo "<select name=\"rid\">";
        while($row = $db->sql_fetchrow($result1)) {
            $rid = intval($row['rid']);
            $title = stripslashes($row['title']);
            echo "<option value=\"$rid\">$title</option>";
        }
        $db->sql_freeresult($result1);
        echo "</select>\n";
    echo "&nbsp;";
        echo "<select name=\"op\">";
    echo "<option value=\"ReviewsModReview\" selected='selected'>".$lang_new[$module_name]['MODIFY']."</option>\n";
        echo "<option value=\"ReviewsDelReview\">".$lang_new[$module_name]['DELETE']."</option></select>\n";
        echo "<input type=\"submit\" value=\"".$lang_new[$module_name]['OK']."\" />\n";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>\n";
  } else {
    echo "<br /><br /><center>". $lang_new[$module_name]['WARN_REVIEW_NOT_FOUND'] ."</center><br /><br />\n";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
  }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function ReviewsTransfer($cidfrom,$cidto) {
    global $db, $admin_file;

// begin new categories
// (comment lines to transfer existing datas)
    $db->sql_query("UPDATE `"._REVIEWS_REVIEWS_TABLE."` SET `cid`=$cidto WHERE `cid`='$cidfrom'");
// end new categorie
    redirect($admin_file.".php?op=Reviews");
}

function ReviewsDelComment($rid, $rrdbid) {
    global $db, $admin_file;
    $rid = intval($rid);
    $rrdbid = intval($rrdbid);
    $db->sql_query("UPDATE `"._REVIEWS_VOTEDATA_TABLE."` SET `ratingcomments`='' WHERE `ratingdbid` = '$rrdbid'");
    $db->sql_query("UPDATE `"._REVIEWS_REVIEWS_TABLE."` SET `totalcomments` = (`totalcomments` - 1) WHERE `rid` = '$rid'");
    redirect($admin_file.".php?op=ReviewsModReview&amp;rid=$rid");
}

function ReviewsDelVote($rid, $rrdbid) {
    global $db, $admin_file, $module_name;
    $rid = intval($rid);
    $rrdbid = intval($rrdbid);
    $db->sql_query("DELETE FROM `"._REVIEWS_VOTEDATA_TABLE."` WHERE `ratingdbid`=$rrdbid");
    $voteresult = $db->sql_query("SELECT `rating`, `ratinguser`, `ratingcomments` FROM `"._REVIEWS_VOTEDATA_TABLE."` WHERE `ratingrid` = '$rrdbid'");
    $totalvotesDB = $db->sql_numrows($voteresult);
    include(NUKE_MODULES_DIR.$module_name.'/voteinclude.php');
    $db->sql_query("UPDATE `"._REVIEWS_REVIEWS_TABLE."` SET `reviewratingsummary`='$finalrating', `totalvotes`='$totalvotesDB', `totalcomments`='$truecomments' WHERE `rid` = '$rid'");
    redirect($admin_file.".php?op=ReviewsModReview&rid=$rid");
}

function ReviewsDelBrokenReviews($rid) {
    global $db, $admin_file, $cache;
    $rid = intval($rid);
    $db->sql_query("DELETE FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `rid`='$rid'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numbrokenr', 'submissions');
    $cache->delete('nummodreqr', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $db->sql_query("DELETE FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE rid='$rid'");
    redirect($admin_file.".php?op=ReviewsListBrokenReviews");
}

function ReviewsIgnoreBrokenReviews($rid) {
    global $db, $admin_file, $cache;
    $db->sql_query("DELETE FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `rid`='$rid' AND `brokenreview`='1'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numbrokenr', 'submissions');
    $cache->delete('nummodreqr', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    redirect($admin_file.".php?op=ReviewsListBrokenReviews");
}

function ReviewsChangeModRequests($requestid) {
    global $db, $admin_file, $cache;
    $requestid = intval($requestid);
    $result = $db->sql_query("SELECT `requestid`, `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `header`, `footer`, `body`, `signature`, `modifysubmitter`, `date` FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `requestid`='$requestid'");
    while ($row = $db->sql_fetchrow($result)) {
        $requestid = $row['requestid'];
        $rid = $row['rid'];
        $cid = $row['cid'];
        $sid = $row['sid'];
        $date = $row['date'];
        $title = $row['title'];
        $image = $row['image'];
        $description = $row['description'];
        $url = $row['url'];
        $reviewheader = $row['reviewheader'];
        $reviewbody = $row['reviewbody'];
        $reviewfooter = $row['reviewfooter'];
        $reviewsignature = $row['reviewsignature'];
        $db->sql_query("UPDATE `"._REVIEWS_REVIEWS_TABLE."` SET `cid`='$cid', `sid`='$sid', `title`='$title', `image`='$image', `url`='$url', `description`='$description', `header`='$reviewheader', `body`='$reviewbody', `footer`='$reviewfooter', `signature`='$signature', `date_modified`='$date'  WHERE `rid` = '$rid'");
    }
    $db->sql_query("DELETE FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `requestid`=$requestid");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numbrokenr', 'submissions');
    $cache->delete('nummodreqr', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    redirect($admin_file.".php?op=ReviewsListModRequests");
}

function ReviewsChangeIgnoreRequests($requestid) {
    global $db, $admin_file, $cache;
    $requestid = intval($requestid);
    $db->sql_query("DELETE FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `requestid`=$requestid");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numbrokenr', 'submissions');
    $cache->delete('nummodreqr', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    redirect($admin_file.".php?op=ReviewsListModRequests");
}

function ReviewsDelReview($rid) {
    global $db, $admin_file, $cache;
    $rid = intval($rid);
    $db->sql_query("DELETE FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='$rid'");
    // Has the Review been submitted for modification? we deleted it so let's remove it FROM the modrequest table
    $sql = "SELECT * FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `rid`='$rid'";
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
        $db->sql_query("DELETE FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `rid`='$rid'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('numbrokenr', 'submissions');
        $cache->delete('nummodreqr', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    }
    redirect($admin_file.".php?op=Reviews");
}

function ReviewsModCatS($cid, $sid, $sub, $title, $image, $cdescription) {
    global $db, $admin_file;
    $cid = intval($cid);
    if ($sub==0) {
        $db->sql_query("UPDATE `"._REVIEWS_CATEGORIES_TABLE."` SET `title`='$title', `image`='$image', `cdescription`='$cdescription' WHERE `cid`='$cid'");
    } else {
        $db->sql_query("UPDATE `"._REVIEWS_SUBCATEGORIES_TABLE."` SET `title`='$title' WHERE `sid`='$sid'");
    }
    redirect($admin_file.".php?op=Reviews");
}

function ReviewsDelNew($rid) {
    global $db, $admin_file, $cache;
    $rid = intval($rid);
    $db->sql_query("DELETE FROM `"._REVIEWS_NEWREVIEW_TABLE."` WHERE `rid`='$rid'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numwaitr', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    redirect($admin_file.".php?op=Reviews");
}

function ReviewsModEditorial($reviewid, $editorialtitle, $editorialtext) {
    global $db, $admin_file, $lang_new, $module_name, $_GETVAR;
    $reviewid = intval($reviewid);
    $editorialtext = $_GETVAR->fixQuotes($editorialtext);
    $db->sql_query("UPDATE `"._REVIEWS_EDITORIALS_TABLE."` SET `editorialtext`='$editorialtext', `editorialtitle`='$editorialtitle' WHERE `reviewid`='$reviewid'");
    reviewsHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        . $lang_new[$module_name]['MESSAGE_EDITORIAL_MODIFIED'] . "<br />"
        ."[ <a href=\"".$admin_file.".php?op=Reviews\">" . $lang_new[$module_name]['ADMIN_REVIEWSADMIN'] . "</a> ]<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function ReviewsDelEditorial($reviewid) {
    global $db, $admin_file, $lang_new, $module_name;
    $reviewid = intval($reviewid);
    $db->sql_query("DELETE FROM `"._REVIEWS_EDITORIALS_TABLE."` WHERE `reviewid`='$reviewid'");
    reviewsHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        .$lang_new[$module_name]['MESSAGE_EDITORIAL_REMOVED'] . "<br />"
        ."[ <a href=\"".$admin_file.".php?op=Reviews\">" . $lang_new[$module_name]['ADMIN_REVIEWSADMIN'] . "</a> ]<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}


function ReviewsAddCat($title, $image, $cdescription) {
    global $db, $admin_file, $lang_new, $module_name, $_GETVAR;
    $parentid = 0;
    $result = $db->sql_query("SELECT `cid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `title`='$title'");
    $numrows = $db->sql_numrows($result);
    if ($numrows > 0) {
    reviewsHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
          ."<em>$title</em><br />"
            ."<strong>" . $lang_new[$module_name]['ERROR_CAT_EXISTS'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $db->sql_query("INSERT INTO `"._REVIEWS_CATEGORIES_TABLE."` (`cid`, `title`, `image`, `cdescription`, `parentid`) VALUES (NULL, '".$_GETVAR->fixQuotes($title)."', '".$_GETVAR->fixQuotes($image)."', '".$_GETVAR->fixQuotes($cdescription)."', '$parentid')");
        redirect($admin_file.".php?op=Reviews");
    }
}

function ReviewsSaveSubCat($cid, $title, $image, $cdescription) {
    global $db, $admin_file, $lang_new, $module_name;
    $cid = intval($cid);
    $result = $db->sql_query("SELECT `cid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `title`='$title' AND `cid`='$cid'");
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
        reviewsHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<em>$title</em><br />"
            ."<strong>" . $lang_new[$module_name]['ERROR_CAT_EXISTS'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $db->sql_query("INSERT INTO `"._REVIEWS_CATEGORIES_TABLE."` (`cid`, `title`, `image`, `cdescription`, `parentid`) VALUES (NULL, '$title', '$image', '$cdescription', '$cid')");
        redirect($admin_file.".php?op=Reviews");
    }
}

function ReviewsAddEditorial($reviewid, $editorialtitle, $editorialtext) {
    global $aid, $db, $admin_file, $lang_new, $module_name, $_GETVAR;
    $editorialtext = $_GETVAR->fixQuotes($editorialtext);
    $db->sql_query("INSERT INTO `"._REVIEWS_EDITORIALS_TABLE."` (`reviewid`, `adminid`, `editorialtimestamp`, `editorialtext`, `editorialtitle`) VALUES ('$reviewid', '$aid', ". time() .", '$editorialtext', '$editorialtitle')");
    reviewsHeader();
    OpenTable();
    echo "<center><span class=option>"
        . $lang_new[$module_name]['MESSAGE_EDITORIAL_ADDED'] . "<br /><br />"
        ."[ <a href=\"".$admin_file.".php?op=Reviews\">" . $lang_new[$module_name]['ADMIN_REVIEWSADMIN'] . "</a> ]<br /><br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>