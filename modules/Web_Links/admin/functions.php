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

if (!defined('IN_WEBLINKS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN WEBLINKS ADMINISTRATION');
}

function WebLinksConfig()
{
  global $db, $module_name, $cache, $lang_new;
  static $weblinksconfig;
    if(isset($weblinksconfig) && is_array($weblinksconfig)) { return $weblinksconfig; }
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

function linksHeader()
{
    global $admin_file, $db, $lang_new, $module_name, $totallinks;
    include_once(NUKE_BASE_DIR.'header.php');
    $totalbrokenlinks = $db->sql_numrows($db->sql_query("SELECT `requestid` FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `brokenlink`='1'"));
    $totalmodrequests = $db->sql_numrows($db->sql_query("SELECT `requestid` FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `brokenlink`='0'"));
    $totalwaitvalidate = $db->sql_numrows($db->sql_query("SELECT `lid` FROM `"._WEBLINKS_NEWLINK_TABLE."`"));
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Links\">" . $lang_new[$module_name]['ADMIN_HEADER'] . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['ADMIN_GO_MAIN'] . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><span class=\"title\"><strong>" . $lang_new[$module_name]['ADMIN_WEBLINKSADMIN'] . "</strong></span><br /><br /><hr noshade=\"noshade\" />";

    $result = $db->sql_query("SELECT `lid` FROM `" . _WEBLINKS_LINKS_TABLE . "`");
    $totallinks = $db->sql_numrows($result);
    echo "<span class=\"content\">-->> " . $lang_new[$module_name]['THERE_ARE'] . " <strong>$totallinks</strong> " . $lang_new[$module_name]['WEBLINKS_IN_DB'] . " <<--</span></center>";
    echo "<hr noshade=\"noshade\" /><br />";
    echo "<table width=\"100%\">\n";
    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=AddNewLink\">" . $lang_new[$module_name]['ADMIN_ADD_LINK'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksAddMainCategory\">" . $lang_new[$module_name]['ADMIN_ADD_CAT'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksSettings\">". $lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] ."</a></span></td>\n";
    echo "</tr>";

    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=SelectModifyLink\">" . $lang_new[$module_name]['ADMIN_MODIFY_LINK'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksAddSubCat\">" . $lang_new[$module_name]['ADMIN_ADD_SUBCAT'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksListBrokenLinks\">" . $lang_new[$module_name]['ADMIN_BROKEN_LINK'] . " ($totalbrokenlinks)</a></span></td>\n";
    echo "</tr>";

    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksLinkCheck\">" . $lang_new[$module_name]['ADMIN_LINK_CHECK'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksSelectModifyCategory\">" . $lang_new[$module_name]['ADMIN_MODIFY_CAT'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksListModRequests\">" . $lang_new[$module_name]['ADMIN_MODIFY_LINK_REQUEST'] . " ($totalmodrequests)</a></span></td>\n";
    echo "</tr>";

    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksTransferCat\">" . $lang_new[$module_name]['ADMIN_TRANSFER_CAT'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksListNewLinks\">" . $lang_new[$module_name]['ADMIN_LINK_VALIDATE'] . " ($totalwaitvalidate)</a></span></td>\n";
    echo "</tr>";

    echo "<tr>";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"><a href=\"".$admin_file.".php?op=LinksCleanVotes\">" . $lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] . "</a></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"></span></td>\n";
    echo "<td width=\"33%\" align=\"center\"><span class=\"content\"></span></td>\n";
    echo "</tr>";
    echo "</table>";
    CloseTable();
    echo "<br />";
}

function linksgetparent($parentid,$title) {
    global $db;
    $parentid = intval($parentid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, parentid FROM " . _WEBLINKS_CATEGORIES_TABLE . " WHERE cid='$parentid'"));
    $ptitle = $row['title'];
    $pparentid = intval($row['parentid']);
    $db->sql_freeresult($result);
    if (!empty($ptitle)) $title=$ptitle." -> ".$title;
    if ($pparentid!=0) {
        $title=linksgetparent($pparentid,$title);
    }
    return $title;
}

function LinksAddMainCategory() {
    global $db, $admin_file, $lang_new, $module_name, $bgcolor2;
    linksHeader();

    OpenTable();
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_ADD_CAT'] . "</strong></span></center><br /><br />\n";
    echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"addmaincat\">";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['NAME'] . ": </td><td><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"50\" /></td></tr>";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_IMAGE_URL']. ": </td><td><input type=\"text\" name=\"imageurl\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_IMAGE']. ": </td><td>".select_gallery('image', 'images/topics', TRUE)."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
    echo Make_TextArea('cdescription',(isset($cdescription) ? $cdescription : ''), 'addmaincat');
    echo "</td></tr>";
    echo "</table>";
    echo "<input type=\"hidden\" name=\"op\" value=\"LinksAddCat\" />";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_ADD'] . "\" /></center><br />";
    echo "</form>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function LinksSelectModifyCategory() {
    global $db, $admin_file, $lang_new, $module_name;
    linksHeader();

    OpenTable();
    $numrows = $db->sql_numrows($db->sql_query("SELECT `cid` FROM `"._WEBLINKS_CATEGORIES_TABLE."`"));
    if ($numrows>0) {
        echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_MODIFY_CAT'] . "</strong></span></center><br /><br />\n";
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectmodifycat\">";
        echo "<table width=\"100%\" border=\"0\">\n";
        $result11 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` ORDER BY `title`");
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td><td>";
        echo "<select name=\"cat\">";
        while($row11 = $db->sql_fetchrow($result11)) {
            $cid2 = intval($row11['cid']);
            $ctitle2 = stripslashes($row11['title']);
            $parentid2 = intval($row11['parentid']);
            if ($parentid2!=0) {
                $ctitle2=linksgetparent($parentid2,$ctitle2);
            }
            echo "<option value=\"$cid2\">$ctitle2</option>";
        }
        $db->sql_freeresult($result11);
        echo "</select>\n";
        echo "</td></tr>";
        echo "</table><br />";
        echo "<input type=\"hidden\" name=\"op\" value=\"LinksModCat\" />";
        echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_MODIFY'] . "\" /></center>";
        echo "</form>\n";
    } else {
        echo "<br /><br /><center>". $lang_new[$module_name]['WARN_CAT_NOT_FOUND'] ."</center><br /><br />\n";
        echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function SelectModifyLink() {
    global $db, $admin_file, $lang_new, $module_name;
    linksHeader();

    OpenTable();
    $numrows = $db->sql_numrows($db->sql_query("SELECT `lid` FROM `"._WEBLINKS_LINKS_TABLE."`"));
    if ($numrows>0) {
        echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_MODIFY_LINK'] . "</strong></span></center><br /><br />\n";
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"selectmodifylink\">";
        echo "<table width=\"100%\" border=\"0\">\n";
        $result1 = $db->sql_query("SELECT `lid`, `title` FROM `"._WEBLINKS_LINKS_TABLE."` ORDER BY `title`");
        echo "<tr><td align=\"left\">". $lang_new[$module_name]['LINK_ID'] . ": ";
        echo "&nbsp;";
        echo "<select name=\"lid\">";
        while($row = $db->sql_fetchrow($result1)) {
            $lid = intval($row['lid']);
            $title = stripslashes($row['title']);
            echo "<option value=\"$lid\">$title</option>";
        }
        $db->sql_freeresult($result1);
        echo "</select>\n";
        echo "&nbsp;";
        echo "<select name=\"op\">";
        echo "<option value=\"LinksModLink\" selected='selected'>".$lang_new[$module_name]['MODIFY']."</option>\n";
        echo "<option value=\"LinksDelLink\">".$lang_new[$module_name]['DELETE']."</option></select>\n";
        echo "<input type=\"submit\" value=\"".$lang_new[$module_name]['OK']."\" />\n";
        echo "</td></tr>";
        echo "</table><br />";
        echo "</form>\n";
    } else {
        echo "<br /><br /><center>". $lang_new[$module_name]['WARN_LINK_NOT_FOUND'] ."</center><br /><br />\n";
        echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function links() {
    linksHeader();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function LinksTransfer($cidfrom,$cidto) {
    global $db, $admin_file;

// begin new categories
// (comment lines to transfer existing datas)
    $db->sql_query("UPDATE `"._WEBLINKS_LINKS_TABLE."` SET `cid`=$cidto WHERE `cid`='$cidfrom'");
// end new categorie
    redirect($admin_file.".php?op=Links");
}

function LinksDelComment($lid, $rldbid) {
    global $db, $admin_file;
    $rldbid = intval($rldbid);
    $lid = intval($lid);
    $db->sql_query("UPDATE `"._WEBLINKS_VOTEDATA_TABLE."` SET `ratingcomments`='' WHERE `ratingdbid` = '$rldbid'");
    $db->sql_query("UPDATE `"._WEBLINKS_LINKS_TABLE."` SET `totalcomments` = (`totalcomments` - 1) WHERE `lid` = '$lid'");
    redirect($admin_file.".php?op=LinksModLink&amp;lid=$lid");
}

function LinksDelVote($lid, $rldbid) {
    global $db, $admin_file, $module_name;
    $rldbid = intval($rldbid);
    $lid = intval($lid);
    $db->sql_query("DELETE FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratingdbid`=$rldbid");
    $voteresult = $db->sql_query("SELECT `rating`, `ratinguser`, `ratingcomments` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid` = '$lid'");
    $totalvotesDB = $db->sql_numrows($voteresult);
    include(NUKE_MODULES_DIR.$module_name.'/public/VoteInclude.php');
    $db->sql_query("UPDATE `"._WEBLINKS_LINKS_TABLE."` SET `linkratingsummary`='$finalrating', `totalvotes`='$totalvotesDB', `totalcomments`='$truecomments' WHERE `lid` = '$lid'");
    redirect($admin_file.".php?op=LinksModLink&lid=$lid");
}

function LinksDelBrokenLinks($lid) {
    global $db, $admin_file, $cache;
    $lid = intval($lid);
    $db->sql_query("DELETE FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `lid`='$lid'");
    $cache->delete('numbrokenl', 'submissions');
    $cache->delete('nummodreql', 'submissions');
    $db->sql_query("DELETE FROM `"._WEBLINKS_LINKS_TABLE."` WHERE lid='$lid'");
    redirect($admin_file.".php?op=LinksListBrokenLinks");
}

function LinksIgnoreBrokenLinks($lid) {
    global $db, $admin_file, $cache;
    $db->sql_query("DELETE FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `lid`='$lid' AND `brokenlink`='1'");
    $cache->delete('numbrokenl', 'submissions');
    $cache->delete('nummodreql', 'submissions');
    redirect($admin_file.".php?op=LinksListBrokenLinks");
}

function LinksChangeModRequests($requestid) {
    global $db, $admin_file, $cache;
    $requestid = intval($requestid);
    $result = $db->sql_query("SELECT `requestid`, `lid`, `cid`, `sid`, `title`, `image`, `url`, `description` FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `requestid`='$requestid'");
    while ($row = $db->sql_fetchrow($result)) {
        $requestid = intval($row['requestid']);
        $lid = intval($row['lid']);
        $cid = intval($row['cid']);
        $sid = intval($row['sid']);
        $title = stripslashes($row['title']);
        $image = $row['image'];
        $url = $row['url'];
        $description = stripslashes($row['description']);
        $db->sql_query("UPDATE `"._WEBLINKS_LINKS_TABLE."` SET `cid`='$cid', `sid`='$sid', `title`='$title', `image`='$image', `url`='$url', `description`='$description' WHERE `lid` = '$lid'");
    }
    $db->sql_query("DELETE FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `requestid`=$requestid");
    $cache->delete('numbrokenl', 'submissions');
    $cache->delete('nummodreql', 'submissions');
    redirect($admin_file.".php?op=LinksListModRequests");
}

function LinksChangeIgnoreRequests($requestid) {
    global $db, $admin_file, $cache;
    $requestid = intval($requestid);
    $db->sql_query("DELETE FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `requestid`=$requestid");
    $cache->delete('numbrokenl', 'submissions');
    $cache->delete('nummodreql', 'submissions');
    redirect($admin_file.".php?op=LinksListModRequests");
}

function LinksDelLink($lid) {
    global $db, $admin_file, $cache;
    $lid = intval($lid);
    $db->sql_query("DELETE FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='$lid'");
    // Has the link been submitted for modification? we deleted it so let's remove it FROM the modrequest table
    $sql = "SELECT * FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `lid`='$lid'";
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
        $db->sql_query("DELETE FROM `"._WEBLINKS_MODREQUEST_TABLE."` WHERE `lid`='$lid'");
        $cache->delete('numbrokenl', 'submissions');
        $cache->delete('nummodreql', 'submissions');
    }
    redirect($admin_file.".php?op=Links");
}

function LinksModCatS($cid, $sid, $sub, $title, $image, $cdescription) {
    global $db, $admin_file;
    $cid = intval($cid);
    if ($sub==0) {
        $db->sql_query("UPDATE `"._WEBLINKS_CATEGORIES_TABLE."` SET `title`='$title', `image`='$image', `cdescription`='$cdescription' WHERE `cid`='$cid'");
    } else {
        $db->sql_query("UPDATE `"._WEBLINKS_SUBCATEGORIES_TABLE."` SET `title`='$title' WHERE `sid`='$sid'");
    }
    redirect($admin_file.".php?op=Links");
}

function LinksDelNew($lid) {
    global $db, $admin_file, $cache;
    $lid = intval($lid);
    $db->sql_query("DELETE FROM `"._WEBLINKS_NEWLINK_TABLE."` WHERE `lid`='$lid'");
    $cache->delete('numwaitl', 'submissions');
    redirect($admin_file.".php?op=Links");
}

function LinksModEditorial($linkid, $editorialtitle, $editorialtext) {
    global $db, $admin_file, $lang_new, $module_name, $_GETVAR;
    $linkid = intval($linkid);
    $editorialtext = $_GETVAR->fixQuotes($editorialtext);
    $db->sql_query("UPDATE `"._WEBLINKS_EDITORIALS_TABLE."` SET `editorialtext`='$editorialtext', `editorialtitle`='$editorialtitle' WHERE `linkid`='$linkid'");
    linksHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        . $lang_new[$module_name]['MESSAGE_EDITORIAL_MODIFIED'] . "<br />"
        ."[ <a href=\"".$admin_file.".php?op=Links\">" . $lang_new[$module_name]['ADMIN_WEBLINKSADMIN'] . "</a> ]<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function LinksDelEditorial($linkid) {
    global $db, $admin_file, $lang_new, $module_name;
    $linkid = intval($linkid);
    $db->sql_query("DELETE FROM `"._WEBLINKS_EDITORIALS_TABLE."` WHERE `linkid`='$linkid'");
    linksHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        .$lang_new[$module_name]['MESSAGE_EDITORIAL_REMOVED'] . "<br />"
        ."[ <a href=\"".$admin_file.".php?op=Links\">" . $lang_new[$module_name]['ADMIN_WEBLINKSADMIN'] . "</a> ]<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}


function LinksAddCat($title, $image, $cdescription) {
    global $db, $admin_file, $lang_new, $module_name, $_GETVAR;
    $parentid = 0;
    $result = $db->sql_query("SELECT `cid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `title`='$title'");
    $numrows = $db->sql_numrows($result);
    if ($numrows > 0) {
        linksHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<em>$title</em><br />"
            ."<strong>" . $lang_new[$module_name]['ERROR_CAT_EXISTS'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $db->sql_query("INSERT INTO `"._WEBLINKS_CATEGORIES_TABLE."` (`cid`, `title`, `image`, `cdescription`, `parentid`) VALUES (NULL, '$title', '$image', '$cdescription', '$parentid')");
        redirect($admin_file.".php?op=Links");
    }
}

function LinksSaveSubCat($cid, $title, $image, $cdescription) {
    global $db, $admin_file, $lang_new, $module_name;
    $cid = intval($cid);
    $result = $db->sql_query("SELECT `cid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `title`='$title' AND `cid`='$cid'");
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
        linksHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<em>$title</em><br />"
            ."<strong>" . $lang_new[$module_name]['ERROR_CAT_EXISTS'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $db->sql_query("INSERT INTO `"._WEBLINKS_CATEGORIES_TABLE."` (`cid`, `title`, `image`, `cdescription`, `parentid`) VALUES (NULL, '$title', '$image', '$cdescription', '$cid')");
        redirect($admin_file.".php?op=Links");
    }
}

function LinksAddEditorial($linkid, $editorialtitle, $editorialtext) {
    global $aid, $db, $admin_file, $lang_new, $module_name, $_GETVAR;
    $editorialtext = $_GETVAR->fixQuotes($editorialtext);
    $db->sql_query("INSERT INTO `"._WEBLINKS_EDITORIALS_TABLE."` (`linkid`, `adminid`, `editorialtimestamp`, `editorialtext`, `editorialtitle`) VALUES ('$linkid', '$aid', ". time() .", '$editorialtext', '$editorialtitle')");
    linksHeader();
    OpenTable();
    echo "<center><span class=option>"
        . $lang_new[$module_name]['MESSAGE_EDITORIAL_ADDED'] . "<br /><br />"
        ."[ <a href=\"".$admin_file.".php?op=Links\">" . $lang_new[$module_name]['ADMIN_WEBLINKSADMIN'] . "</a> ]<br /><br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>