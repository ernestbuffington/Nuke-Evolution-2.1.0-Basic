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
$lid = intval($lid);
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_MODIFY_LINK'] . "</strong></span></center><br /><br />\n";
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"linksmodlink\">";
echo "<table width=\"100%\" border=\"0\">\n";
$result = $db->sql_query("SELECT `cid`, `title`, `image`, `url`, `description`, `name`, `email`, `hits`, `date`, `date_validated` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `lid`='$lid'");
while($row = $db->sql_fetchrow($result)) {
    $cid = intval($row['cid']);
    $title = stripslashes($row['title']);
    $image = $row['image'];
    $url = $row['url'];
    $description = evo_img_tag_to_resize(stripslashes($row['description']));
    $name = $row['name'];
    $email = $row['email'];
    $hits = intval($row['hits']);
    $date = intval($row['date']);
    $date_validated = intval($row['date_validated']);
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_ID'] . ": </td><td><strong>$lid</strong></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_PAGETITLE'] . ": </td><td><input type=\"text\" name=\"title\" value=\"$title\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_IMAGE_URL']. ": </td><td><input type=\"text\" name=\"image\" size=\"75\" maxlength=\"100\" value=\"$image\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_URL'] . ": </td><td><input type=\"text\" name=\"url\" value=\"$url\" size=\"75\" maxlength=\"100\" />&nbsp;[ <a href=\"index.php?url=$url\" target=\"_blank\">". $lang_new[$module_name]['VISIT'] ."</a> ]</td></tr>";
    if ($image !='http://' && !empty($image) ){
        echo "<tr><td align=\"left\">";
        echo "<span class=\"option\">".$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW']."</span></td><td>";
        echo "<img src=\"$image\" /></td></tr>\n";
    }
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
    echo Make_TextArea('description',$description, 'linksmodlink');
    echo "</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['NAME'] . ": </td><td><input type=\"text\" name=\"username\" size=\"75\" maxlength=\"100\" value=\"$name\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['EMAIL'] . ": </td><td><input type=\"text\" name=\"email\" size=\"75\" maxlength=\"100\" value=\"$email\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['HITS'] . ": </td><td><input type=\"text\" name=\"hits\" value=\"$hits\" size=\"12\" maxlength=\"11\" /></td></tr>";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_SUBMIT_DATE'] . ": </td><td>".(($date > 0) ? formatTimestamp($date) : 0)."</td></tr>";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['LINK_VALIDATE_DATE'] . ": </td><td>".(($date_validated >0 ) ? formatTimestamp($date_validated) : 0)."</td></tr>";
    echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\" />";
    echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['CATEGORY'] . ": </td>";
    echo "<td><select name=\"cat\">";
    $result2 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` ORDER BY `title`");
    while($row2 = $db->sql_fetchrow($result2)) {
        $cid2 = intval($row2['cid']);
        $ctitle2 = stripslashes($row2['title']);
        $parentid2 = $row2['parentid'];
        if ($cid2==$cid) {
            $sel = "selected";
        } else {
            $sel = "";
        }
        if ($parentid2 != 0) {
            $ctitle2 = linksgetparent($parentid2,$ctitle2);
        }
        echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
    }
    echo "</select></td></tr>\n";
    echo "<input type=\"hidden\" name=\"op\" value=\"LinksModLinkS\" />";
    echo "</table><br />";
    echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_MODIFY'] . "\" /></center>\n";
    echo "<center>[ <a href=\"".$admin_file.".php?op=LinksDelLink&amp;lid=$lid\">" . $lang_new[$module_name]['SUBMIT_DELETE'] . "</a> ]</center>\n";
    echo "</form>";
    echo "<br />";
    /* Modify or Add Editorial */
    $resulted2 = $db->sql_query("SELECT `adminid`, `editorialtimestamp`, `editorialtext`, `editorialtitle` FROM `"._WEBLINKS_EDITORIALS_TABLE."` WHERE `linkid`='$lid'");
    $recordexist = $db->sql_numrows($resulted2);
    /* if returns 'bad query' status 0 (add editorial) */
    if ($recordexist == 0) {
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_EDITORIAL_ADD'] . "</strong></span></center><br /><br />\n";
        echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"modifyadd\">";
        echo "<table width=\"100%\" border=\"0\">\n";
        echo "<input type=\"hidden\" name=\"linkid\" value=\"$lid\" />";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['TITLE'] . ": </td><td><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"75\" maxlength=\"100\" /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
        echo Make_TextArea('editorialtext',$editorialtext, 'modifyadd');
        echo "</td></tr>\n";
        echo "</table><br />";
        echo "<input type=\"hidden\" name=\"op\" value=\"LinksAddEditorial\" />\n";
        echo "<center><input type=\"submit\" value=\"Add\" /></center>\n";
        echo "</form>";
        CloseTable();
    } else {
        /* if returns 'cool' then status 1 (modify editorial) */
        while($row3 = $db->sql_fetchrow($resulted2)) {
            $editorialtext = stripslashes($row3['editorialtext']);
            $editorialtitle = stripslashes($row3['editorialtitle']);
            $formatted_date = formatTimestamp($row3['editorialtimestamp']);
            $adminid = $row3['adminid'];
            OpenTable();
            echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_EDITORIAL_MODIFY'] . "</strong></span></center><br /><br />\n";
            echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"modifyeditorial\">";
            echo "<table width=\"100%\" border=\"0\">\n";
            echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['AUTHOR'] . ": </td><td>$adminid</td></tr>\n";
            echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DATE_WRITTEN'] . ": </td><td>$formatted_date</td></tr>\n";
            echo "<input type=\"hidden\" name=\"linkid\" value=\"$lid\" />\n";
            echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['TITLE'] . ": </td><td><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"75\" maxlength=\"100\" /></td></tr>";
            echo "<tr><td bgcolor='$bgcolor2' align=\"left\">". $lang_new[$module_name]['DESCRIPTION'] . ": </td><td>";
            echo Make_TextArea('editorialtext',$editorialtext, 'modifyeditorial');
            echo "</td></tr>\n";
            echo "</table><br />";
            echo "<input type=\"hidden\" name=\"op\" value=\"LinksModEditorial\" />\n";
            echo "<center><input type=\"submit\" value=\"" . $lang_new[$module_name]['SUBMIT_MODIFY'] . "\" /></center>\n";
            echo "<center>[ <a href=\"".$admin_file.".php?op=LinksDelEditorial&amp;linkid=$lid\">" . $lang_new[$module_name]['SUBMIT_DELETE'] . "</a> ]</center>\n";
            echo "</form>";
            CloseTable();
        }
        $db->sql_freeresult($resulted2);
    }
    CloseTable();
    echo "<br />";
    /* Show Comments */
    $temp_color = $db->sql_query("SELECT `config_name`, `config_value` FROM `". _WEBLINKS_CONFIG_TABLE ."` WHERE `config_name` LIKE 'tablecolor%'");
    while(list($config_name, $config_value) = $db->sql_fetchrow($temp_color)) {
        $color[$config_name] = $config_value;
    }
    $db->sql_freeresult($temp_color);
    OpenTable();
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['COMMENTS'] . "</strong></span></center><br />\n";
    $result4 = $db->sql_query("SELECT `ratingdbid`, `ratinguser`, `ratingcomments`, `ratingtimestamp` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid` = '$lid' AND `ratingcomments` <> '' ORDER BY `ratingtimestamp` DESC");
    $totalcomments = $db->sql_numrows($result4);
    echo "<br /><fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['COMMENTS'] . "</strong> (". $lang_new[$module_name]['COMMENTS_TOTAL'] .": $totalcomments)</span></legend>";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td width=\"20%\" bgcolor=\"$bgcolor1\" colspan=1><strong>". $lang_new[$module_name]['USER'] ."</strong></td><td  bgcolor=\"$bgcolor1\" colspan=\"5\"><strong>". $lang_new[$module_name]['COMMENTS'] ." </strong></td><td  bgcolor=\"$bgcolor1\"><strong><center>". $lang_new[$module_name]['DELETE'] ."</center></strong></td></tr>";
    if ($totalcomments == 0) {
        echo "<tr><td colspan=7><center>" . $lang_new[$module_name]['WARN_COMMENT_NOT_FOUND'] ."</center></td></tr>\n";
    }
    $x=0;
    $colorswitch = $color['tablecolor1'];
    while($row4 = $db->sql_fetchrow($result4)) {
        $ratingdbid = intval($row4['ratingdbid']);
        $ratinguser = $row4['ratinguser'];
        $ratingcomments = stripslashes($row4['ratingcomments']);
        $formatted_date = formatTimestamp($row4['ratingtimestamp']);
        echo "<tr><td valign=top bgcolor=\"$colorswitch\">$ratinguser</td><td valign=\"top\" colspan=\"5\" bgcolor=\"$colorswitch\">$ratingcomments</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=LinksDelComment&amp;lid=$lid&amp;rldbid=$ratingdbid>X</a></strong></center></td></tr>\n";
        $x++;
        if ($colorswitch == $color['tablecolor1'])
            $colorswitch = $color['tablecolor2'];
        else
            $colorswitch = $color['tablecolor1'];
    }
    $db->sql_freeresult($result4);
    echo "</table></fieldset><br /><br />";
    // Show Registered Users Votes
    $result5 = $db->sql_query("SELECT `ratingdbid`, `ratinguser`, `rating`, `ratinghostname`, `ratingtimestamp` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid` = '$lid' AND `ratinguser` <> 'outside' AND `ratinguser` <> '' ORDER BY `ratingtimestamp` DESC");
    $totalvotes = $db->sql_numrows($result5);
    echo "<br /><fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_LINK_VOTE_REGUSER'] . "</strong> (". $lang_new[$module_name]['ADMIN_LINK_VOTE_TOTAL'] .": $totalvotes)</span></legend>";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td width=\"25%\" align=\"center\" bgcolor=\"$bgcolor1\"><strong>". $lang_new[$module_name]['USER'] ."</strong></td>";
    echo "<td width=\"15%\"  align=\"center\" bgcolor=\"$bgcolor1\"><strong>". $lang_new[$module_name]['IP_ADRESS'] ."</strong></td>";
    echo "<td width=\"10%\"  align=\"center\" bgcolor=\"$bgcolor1\"><strong>". $lang_new[$module_name]['ADMIN_LINK_RATING'] ."</strong></td>";
    echo "<td width=\"15%\"  align=\"center\" bgcolor=\"$bgcolor1\"><strong>". $lang_new[$module_name]['DATE'] ."</strong></td>";
    echo "<td width=\"10%\"  align=\"center\" bgcolor=\"$bgcolor1\"><strong>". $lang_new[$module_name]['ADMIN_LINK_RATING_TOTAL'] ."</strong></td>";
    echo "<td width=\"13%\"  align=\"center\" bgcolor=\"$bgcolor1\"><strong>". $lang_new[$module_name]['ADMIN_LINK_RATING_AVERAGE'] ."</strong></td>";
    echo "<td width=\"12%\"  align=\"center\" bgcolor=\"$bgcolor1\"><strong><center>". $lang_new[$module_name]['DELETE'] ."</center></strong></td>";
    echo "</tr>\n";
    if ($totalvotes == 0) {
        echo "<tr><td colspan=\"7\"><center>". $lang_new[$module_name]['WARN_VOTE_NOT_FOUND'] ."</center></td></tr>";
    }
    $x = 0;
    $colorswitch = $color['tablecolor1'];
    while($row5 = $db->sql_fetchrow($result5)) {
        $ratingdbid = intval($row5['ratingdbid']);
        $ratinguser = $row5['ratinguser'];
        $rating = intval($row5['rating']);
        $ratinghostname = $row5['ratinghostname'];
        $formatted_date = formatTimestamp($row5['ratingtimestamp']);

        //Individual user information
        $result6 = $db->sql_query("SELECT `rating` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinguser` = '$ratinguser'");
        $usertotalcomments = $db->sql_numrows($result6);
        $useravgrating = 0;
        while($row6 = $db->sql_fetchrow($result6)) {$useravgrating = $useravgrating + $row6['rating'];}
        $db->sql_freeresult($result6);
        $useravgrating = $useravgrating / $usertotalcomments;
        $useravgrating = number_format($useravgrating, 1);
        echo "<tr><td bgcolor=\"$colorswitch\">$ratinguser</td><td bgcolor=\"$colorswitch\">$ratinghostname</td><td bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\">$usertotalcomments</td><td bgcolor=\"$colorswitch\">$useravgrating</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=LinksDelVote&amp;lid=$lid&amp;rldbid=$ratingdbid>X</a></strong></center></td></tr>\n";
        $x++;
        if ($colorswitch == $color['tablecolor1']) {
            $colorswitch = $color['tablecolor2'];
        } else {
            $colorswitch = $color['tablecolor1'];
        }
    }
    $db->sql_freeresult($result5);
    echo "</table></fieldset><br /><br />";
    // Show Unregistered Users Votes
    $result7 = $db->sql_query("SELECT `ratingdbid`, `rating`, `ratinghostname`, `ratingtimestamp` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid` = '$lid' AND `ratinguser` = '' ORDER BY `ratingtimestamp` DESC");
    $totalvotes = $db->sql_numrows($result7);
    echo "<br /><fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_LINK_VOTE_UNREG'] . "</strong> (". $lang_new[$module_name]['ADMIN_LINK_VOTE_TOTAL'] .": $totalvotes)</span></legend>";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td bgcolor=\"$bgcolor1\" colspan=\"2\"><strong>" . $lang_new[$module_name]['IP_ADRESS'] ."</strong></td><td bgcolor=\"$bgcolor1\" colspan=\"3\"><strong>" . $lang_new[$module_name]['ADMIN_LINK_RATING'] ."</strong></td><td bgcolor=\"$bgcolor1\"><strong>". $lang_new[$module_name]['DATE'] ."</strong></td><td bgcolor=\"$bgcolor1\"><strong><center>". $lang_new[$module_name]['DELETE'] ."</center></strong></td></tr>\n";
    if ($totalvotes == 0) {
        echo "<tr><td colspan=\"7\"><center>". $lang_new[$module_name]['WARN_VOTE_NOT_FOUND'] ."</center></td></tr>\n";
    }
    $x=0;
    $colorswitch = $color['tablecolor1'];
    while($row7 = $db->sql_fetchrow($result7)) {
        $ratingdbid = intval($row7['ratingdbid']);
        $rating = intval($row7['rating']);
        $ratinghostname = $row7['ratinghostname'];
        $formatted_date = formatTimestamp($row7['ratingtimestamp']);
        echo "<td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=LinksDelVote&amp;lid=$lid&amp;rldbid=$ratingdbid>X</a></strong></center></td></tr>\n";
        $x++;
        if ($colorswitch == $color['tablecolor1']) {
              $colorswitch = $color['tablecolor2'];
        } else {
              $colorswitch = $color['tablecolor1'];
        }
    }
    $db->sql_freeresult($result7);
    echo "</table></fieldset><br /><br />";
    // Show Outside Users Votes
    $result8 = $db->sql_query("SELECT `ratingdbid`, `rating`, `ratinghostname`, `ratingtimestamp` FROM `"._WEBLINKS_VOTEDATA_TABLE."` WHERE `ratinglid` = '$lid' AND `ratinguser` = 'outside' ORDER BY `ratingtimestamp` DESC");
    $totalvotes = $db->sql_numrows($result8);
    echo "<br /><fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_LINK_VOTE_GUESTS'] . "</strong> (". $lang_new[$module_name]['ADMIN_LINK_VOTE_TOTAL'] .": $totalvotes)</span></legend>";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td bgcolor=\"$bgcolor1\" colspan=\"2\"><strong>". $lang_new[$module_name]['IP_ADRESS'] ."</strong></td><td bgcolor=\"$bgcolor1\" colspan=\"3\"><strong>". $lang_new[$module_name]['ADMIN_LINK_RATING'] ."</strong></td><td bgcolor=\"$bgcolor1\"><strong>". $lang_new[$module_name]['DATE'] ."</strong></td><td bgcolor=\"$bgcolor1\"><strong><center>". $lang_new[$module_name]['DELETE'] ."</center></strong></td></tr>\n";
    if ($totalvotes == 0) {
        echo "<tr><td colspan=\"7\"><center>". $lang_new[$module_name]['WARN_VOTE_NOT_FOUND'] ."</center></td></tr>\n";
    }
    $x=0;
    $colorswitch=$color['tablecolor1'];
    while($row8 = $db->sql_fetchrow($result8)) {
        $ratingdbid = intval($row8['ratingdbid']);
        $rating = intval($row8['rating']);
        $ratinghostname = $row8['ratinghostname'];
        $formatted_date = formatTimestamp($row8['ratingtimestamp']);
        echo "<tr><td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=LinksDelVote&amp;lid=$lid&amp;rldbid=$ratingdbid>X</a></strong></center></td></tr>\n";
        $x++;
        if ($colorswitch == $color['tablecolor1']) {
              $colorswitch = $color['tablecolor1'];
        } else {
              $colorswitch = $color['tablecolor1'];
        }
    }
    $db->sql_freeresult($result8);

    echo "<tr><td colspan=\"7\"></td></tr>";
    echo "</table></fieldset>";
}
$db->sql_freeresult($result);
echo "</form>";
CloseTable();
echo "<br />";
include_once(NUKE_BASE_DIR.'footer.php');

?>