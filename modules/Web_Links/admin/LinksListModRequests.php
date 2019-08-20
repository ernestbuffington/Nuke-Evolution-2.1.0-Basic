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

linksHeader();

OpenTable();
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_MODIFY_LINK_REQUEST'] . "</strong></span></center><br /><br />\n";
$result = $db->sql_query("SELECT `requestid`, `lid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `modifysubmitter` FROM `" . _WEBLINKS_MODREQUEST_TABLE . "` WHERE `brokenlink` = '0' ORDER BY `requestid`");
$totalmodrequests1 = $db->sql_numrows($result);
if ($totalmodrequests1 == 0) {
    echo "<center>" . $lang_new[$module_name]['WARN_LINK_NOT_FOUND'] . "</center><br />";
} else {
    echo "<table width=\"100%\"><tr><td>";
    while($row = $db->sql_fetchrow($result)) {
        $requestid = intval($row['requestid']);
        $lid = intval($row['lid']);
        $cid = intval($row['cid']);
        $sid = intval($row['sid']);
        $title = stripslashes($row['title']);
        $image = $row['image'];
        $url = $row['url'];
        $description = evo_img_tag_to_resize(stripslashes($row['description']));
        $xdescription = preg_replace("#<a href=\"http://#i", "<a href=\"index.php?url=http://", $description);
        $modifysubmitter = $row['modifysubmitter'];
        $row2 = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `sid`, `title`, `image`, `url`, `description`, `submitter` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='$lid'"));
        $origcid = intval($row2['cid']);
        $origsid = intval($row2['sid']);
        $origtitle = stripslashes($row2['title']);
        $origimage = $row2['image'];
        $origurl = $row2['url'];
        $origdescription = evo_img_tag_to_resize(stripslashes($row2['description']));
        $xorigdescription = preg_replace("#<a href=\"http://#i", "<a href=\"index.php?url=http://", $origdescription);
        $owner = $row2['submitter'];
        $result3 = $db->sql_query("SELECT `title` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE cid='$cid'");
        $result5 = $db->sql_query("SELECT `title` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE cid='$origcid'");
        $result7 = $db->sql_query("SELECT `user_email` FROM `"._USERS_TABLE."` WHERE `username`='$modifysubmitter'");
        $result8 = $db->sql_query("SELECT `user_email` FROM `"._USERS_TABLE."` WHERE `username`='$owner'");
        $row3 = $db->sql_fetchrow($result3);
        $cidtitle = stripslashes($row3['title']);
        $row5 = $db->sql_fetchrow($result5);
        $origcidtitle = stripslashes($row5['title']);
        $row7 = $db->sql_fetchrow($result7);
        $modifysubmitteremail = $row7['user_email'];
        $row8 = $db->sql_fetchrow($result8);
        $owneremail = $row8['user_email'];
        if (empty($owner)) {
            $owner="administration";
        }
        if (empty($origsidtitle)) {
            $origsidtitle= "-----";
        }
        if (empty($sidtitle)) {
            $sidtitle= "-----";
        }
        echo "<table border=\"1\" bordercolor=\"black\" cellpadding=\"5\" cellspacing=\"0\" align=\"center\" width=\"100%\">";
        echo "<tr><td>\n<table width=\"100%\" bgcolor=\"$bgcolor2\">\n";
        echo "<tr><td valign=\"top\" width=\"30%\"><strong>" . $lang_new[$module_name]['ADMIN_LINK_ORIGINAL'] . "</strong></td>";
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['TITLE'] . ": </td><td width=\"55%\">$origtitle</td></tr>\n";
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['DESCRIPTION'] . ": </td><td width=\"55%\">$xorigdescription</td></tr>\n";
        if (!empty($origimage)) {
            echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['LINK_IMAGE_URL']. ": </td><td width=\"55%\">$origimage</td></tr>\n";
        }
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['LINK_URL'] . ": </td><td width=\"55%\"><a href=\"index.php?url=$origurl\">$origurl</a></td></tr>\n";
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['CATEGORY'] . ": </td><td width=\"55%\">$origcidtitle</td></tr>\n";
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['CATEGORYSUB'] . ": </td><td width=\"55%\">$origsidtitle</td></tr>\n";
        echo "</table>\n";
        echo "</td></tr>\n";
        echo "<tr><td><table width=\"100%\">\n";
        echo "<tr><td valign=\"top\" width=\"30%\"><strong>" . $lang_new[$module_name]['ADMIN_LINK_PROPOSED'] . "</strong></td><td width=\"55%\"></td></tr>";
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['TITLE'] . ": </td><td width=\"55%\">$title</td></tr>\n";
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['DESCRIPTION'] . ": </td><td width=\"55%\" valign=\"top\" align=\"left\">$xdescription</td></tr>\n";
        if (!empty($image)) {
            echo "<tr><td valign=\"top\" width=\"30%\">" .$lang_new[$module_name]['LINK_IMAGE_URL']. ": </td><td width=\"55%\">$image</td></tr>\n";
            echo "<tr><td valign=\"top\" width=\"30%\"></td><td width=\"55%\"><img src=\"$image\" /></td></tr>\n";
        }
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['LINK_URL'] . ": </td><td width=\"55%\"><a href=\"index.php?url=$url\">$url</a></td></tr>\n";
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['CATEGORY'] . ": </td><td width=\"55%\">$cidtitle</td></tr>\n";
        echo "<tr><td valign=\"top\" width=\"30%\">" . $lang_new[$module_name]['CATEGORYSUB'] . ": </td><td width=\"55%\">$sidtitle</td></tr>\n";
        echo "</table>\n";
        echo "</td></tr>\n";
        echo "</table>\n";
        echo "<table align=\"center\" width=\"200%\">\n";
        echo "<tr>";
        if (empty($modifysubmitteremail)) {
            echo "<td align=\"left\"><span class=\"tiny\">" . $lang_new[$module_name]['LINK_SUBMITTER'] . ":  $modifysubmitter</span></td>";
        } else {
            echo "<td align=\"left\"><span class=\"tiny\">" . $lang_new[$module_name]['LINK_SUBMITTER'] . ":  <a href=\"mailto:$modifysubmitteremail\">$modifysubmitter</a></span></td>";
        }
        if (empty($owneremail)) {
            echo "<td align=\"center\"><span class=\"tiny\">" . $lang_new[$module_name]['LINK_OWNER'] . ":  $owner</span></td>";
        } else {
            echo "<td align=\"center\"><span class=\"tiny\">" . $lang_new[$module_name]['LINK_OWNER'] . ": <a href=\"mailto:$owneremail\">$owner</a></span></td>";
        }
        echo "<td align=\"right\"><span class=\"tiny\">( <a href=\"".$admin_file.".php?op=LinksChangeModRequests&amp;requestid=$requestid\">" . $lang_new[$module_name]['SUBMIT_ACCEPT'] . "</a> / <a href=\"".$admin_file.".php?op=LinksChangeIgnoreRequests&amp;requestid=$requestid\">" . $lang_new[$module_name]['IGNORE'] . "</a> )</span></td>";
        echo "</tr></table>\n";
    }
    $db->sql_freeresult($result);
    echo "</td></tr></table>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>