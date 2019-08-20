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

if (!defined('IN_DOWNLOADS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN DOWNLOADS ADMINISTRATION');
}

global $db, $module_name, $lang_new, $_GETVAR, $ThemeInfo;

$requestid = $_GETVAR->get('did', '_REQUEST', 'int', 0);


DownloadsHeader();

OpenTable();
echo "<center><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_BROKEN_DOWNLOAD'] . "</strong></span></center><br /><br />";
echo "<form method='POST' action='".$admin_file.".php' name='downloadseditbroken' enctype='multipart/form-data'>";

$result = $db->sql_query("SELECT * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did`='".$did."'");
while($row = $db->sql_fetchrow($result)) {
    echo "<table width='100%' border='0'>";
    $broken_download_filename           = stripslashes($row['download_filename']);
    $cid                                = intval($row['cid']);
    $title                              = stripslashes($row['title']);
    $image                              = $row['image'];
    $hits                               = intval($row['hits']);
    $date_validated                     = intval($row['date_validated']);
    $download_active                    = intval($row['download_active']);
    $description                        = evo_img_tag_to_resize(stripslashes($row['description']));
    $download_submitter                 = stripslashes($row['submitter']);
    $download_submitter_email           = stripslashes($row['email']);
    $download_submitted                 = formatTimestamp($row['date']);
	$download_author                    = stripslashes($row['download_author']);
    $download_email                     = stripslashes($row['download_author_email']);
    $download_website                   = stripslashes($row['download_author_website']);
    $download_added                     = intval($row['date']);
    $download_version                   = stripslashes($row['download_version']);
    $download_size                      = intval($row['download_size']);
    $download_license                   = intval($row['download_license']);
    $download_mimetype                  = stripslashes($row['download_mimetype']);
    $download_name                      = stripslashes($row['download_name']);
    $downloads_in_time                  = intval($row['download_mintime']);
    $total_downloads_meantime           = intval($row['download_countmintime']);
    $total_downloads                    = intval($row['download_countmax']);
    $download_groups_see                = intval($row['download_groups_see']);
    $download_groups                    = intval($row['download_groups']);

    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left'>".$lang_new[$module_name]['DOWNLOAD_ID'].": </td><td><strong>".$did."</strong></td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_TITLE'])." ".$lang_new[$module_name]['DOWNLOAD_PAGETITLE'] . ": </td><td><input type='text' name='broken_title' size='75' maxlength='100' value='".$title."'/></td></tr>";

    $result1 = $db->sql_ufetchrow("SELECT `title` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid` = '".$cid."'");
    $result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` ORDER BY `title`");

    while($row = $db->sql_fetchrow($result1)) {
        $cid2 = intval($row['cid']);
        $ctitle2 = stripslashes($row['title']);
        $parentid2 = intval($row['parentid']);
        if ($parentid2!=0) {
            $ctitle2=DownloadsGetParent($parentid2,$ctitle2);
        }
    }

    echo "<tr><td  bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_IMAGE_URL'])." ".$lang_new[$module_name]['DOWNLOAD_IMAGE_URL']. ": </td><td>".$image."</td></tr>";
    echo "<tr><td  bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_IMAGE_URL_MODIFY'])." ".$lang_new[$module_name]['DOWNLOAD_IMAGE_URL_MODIFY']. ": </td><td><input name='broken_imageupload' type='file' size='75' maxlength='100' /></td></tr>";

    if ($image !='http://' && !empty($image) ){
        echo "<tr><td  bgcolor='".$ThemeInfo['bgcolor2']."' align='left'>".evo_help_img($lang_new[$module_name]['HELP_IMAGE_PREVIEW'])." ".$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW']."</td><td>";
        echo "<img src='".$image."' /></td></tr>";
    }

    if ( @file_exists($broken_download_filename)) {
        $is_available = evo_image('ok.png', $module_name);
        $img_text = $lang_new[$module_name]['MESSAGE_DOWNLOAD_AVAILABLE'];
    } else {
        $is_available = evo_image('bad.png', $module_name);
        $img_text = $lang_new[$module_name]['ERROR_FILENO_EXISTS'];
    }
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_URL'])." ". $lang_new[$module_name]['DOWNLOAD_URL']. ": </td><td>".$broken_download_filename."&nbsp;<img src='".$is_available."' alt='".$img_text."' title='".$img_text ."'/></td></tr>";
	echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_UPLOAD'])." New ". $lang_new[$module_name]['DOWNLOAD_UPLOAD'] . ": </td><td><input type='file' name='broken_uploadfile' size='75' maxlength='255' /></td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MAX_FILESIZE'])." " . $lang_new[$module_name]['DOWNLOAD_MAX_FILESIZE'] . "</td><td>".DownloadsMaxAllowedFileSize(TRUE)."</td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left'>".evo_help_img($lang_new[$module_name]['HELP_ALLOWED_EXTENSIONS'])." ". $lang_new[$module_name]['DOWNLOAD_ALLOWED_EXTENSIONS'] . ": </td><td bgcolor='".$ThemeInfo['bgcolor1']."'>".DownloadsAllowedExtensions(TRUE)."</td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left'>".evo_help_img($lang_new[$module_name]['HELP_DESCRIPTION'])." ". $lang_new[$module_name]['DESCRIPTION']. "</td><td>";
    echo Make_TextArea('broken_description',$description,'downloadseditbroken', '90%', '150px', true, 'bbcode');
    echo "</td></td>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_HITS'])." ". $lang_new[$module_name]['HITS'] . ": </td><td>".$hits."</td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SIZE'])." ". $lang_new[$module_name]['DOWNLOAD_FILESIZE'] . ": </td><td>".$download_size." ".$lang_new[$module_name]['SIZE_BYTE']."</td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR'])." ". $lang_new[$module_name]['DOWNLOAD_AUTHOR'] . ": </td><td><input type='text' name='broken_download_author' size='60' maxlength='100' value='".$download_author."'/></td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_EMAIL'])." ". $lang_new[$module_name]['DOWNLOAD_AUTHOR_EMAIL'] . ": </td><td><input type='text' name='broken_download_email' size='60' maxlength='100' value='".$download_email."'/></td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_WEBSITE'])." ". $lang_new[$module_name]['DOWNLOAD_AUTHOR_WEBSITE'] . ": </td><td><input type='text' name='broken_download_website' size='60' maxlength='100' value='".$download_website."' /></td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_VERSION'])." ". $lang_new[$module_name]['DOWNLOAD_VERSION'] . ": </td><td><input type='text' name='broken_download_version' size='20' maxlength='20' value='".$download_version."'/></td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMITTER'])." ".$lang_new[$module_name]['DOWNLOAD_SUBMITTER'].": </td><td>".$download_submitter."</td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMITTER_EMAIL'])." ".$lang_new[$module_name]['DOWNLOAD_SUBMITTER_EMAIL'].": </td><td>".$download_submitter_email."</td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMIT_DATE'])." ".$lang_new[$module_name]['DOWNLOAD_SUBMIT_DATE'].": </td><td>".$download_submitted."</td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_VALIDATE_NAME'])." ".$lang_new[$module_name]['NAME'].": </td><td>".$userinfo['username']."</td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_VALIDATE_EMAIL'])." ".$lang_new[$module_name]['EMAIL'].": </td><td>".$userinfo['user_email']."</td></tr>";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='30%'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_ACTIVE'])." ".$lang_new[$module_name]['DOWNLOAD_ACTIVE']."</td><td>";
    echo yesno_option('broken_download_active', $download_active);
    echo "</td></tr>";
    echo "</table><br />";
    echo "<input type='hidden' name='broken_did' value='".$did."' />";
    echo "<input type='hidden' name='op' value='DownloadsEditBrokenDownloadS' />";
    echo "<input type='hidden' name='broken_download_filename' value='".$broken_download_filename."' />";
    echo "<input type='hidden' name='broken_download_submitter' value='".$download_submitter."' />";
	echo "<input type='hidden' name='broken_download_submitter_email' value='".$download_submitter_email."' />";
    echo "<input type='hidden' name='broken_cat' value='".$cid2."' />";
    echo "<input type='hidden' name='broken_last_modified_date' value='".time()."' />";
    echo "<input type='hidden' name='broken_last_modified_user' value='".$userinfo['username']."' />";
    echo "<input type='hidden' name='broken_image' value='".$image."' />";
    echo "<center><input type='submit' value='" . $lang_new[$module_name]['SUBMIT_MODIFY'] . "' /></center>";
    echo "<center>[ <a href='".$admin_file.".php?op=DownloadsDelBrokenDownloads&amp;did=".$did."'>" . $lang_new[$module_name]['SUBMIT_DELETE'] . "</a> ]</center>";
    echo "</form>";
    echo "<br />";
    CloseTable();

    /* Show Comments */
    $temp_color = $db->sql_query("SELECT `config_name`, `config_value` FROM `". _DOWNLOADS_CONFIG_TABLE ."` WHERE `config_name` LIKE 'tablecolor%'");
    while(list($config_name, $config_value) = $db->sql_fetchrow($temp_color)) {
        $color[$config_name] = $config_value;
    }
    $db->sql_freeresult($temp_color);
    OpenTable();
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['COMMENTS'] . "</strong></span></center><br />\n";
    $result4 = $db->sql_query("SELECT `ratingdbid`, `ratinguser`, `ratingcomments`, `ratingtimestamp` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratingdid` = '$did' AND `ratingcomments` <> '' ORDER BY `ratingtimestamp` DESC");
    $totalcomments = $db->sql_numrows($result4);
    echo "<br /><fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['COMMENTS'] . "</strong> (". $lang_new[$module_name]['COMMENTS_TOTAL'] .": $totalcomments)</span></legend>";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td width=\"20%\" bgcolor='".$ThemeInfo['bgcolor1']."' colspan=1><strong>". $lang_new[$module_name]['USER'] ."</strong></td><td  bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"5\"><strong>". $lang_new[$module_name]['COMMENTS'] ." </strong></td><td  bgcolor='".$ThemeInfo['bgcolor1']."'><strong><center>". $lang_new[$module_name]['DELETE'] ."</center></strong></td></tr>";
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
        echo "<tr><td valign=top bgcolor=\"$colorswitch\">$ratinguser</td><td valign=\"top\" colspan=\"5\" bgcolor=\"$colorswitch\">$ratingcomments</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=DownloadsDelComment&amp;did=$did&amp;rldbid=$ratingdid>X</a></strong></center></td></tr>\n";
        $x++;
        if ($colorswitch == $color['tablecolor1'])
            $colorswitch = $color['tablecolor2'];
        else
            $colorswitch = $color['tablecolor1'];
    }
    $db->sql_freeresult($result4);
    echo "</table></fieldset><br /><br />";
    // Show Registered Users Votes
    $result5 = $db->sql_query("SELECT `ratingdbid`, `ratinguser`, `rating`, `ratinghostname`, `ratingtimestamp` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratingdid` = '$did' AND `ratinguser` <> 'outside' AND `ratinguser` <> '' ORDER BY `ratingtimestamp` DESC");
    $totalvotes = $db->sql_numrows($result5);
    echo "<br /><fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_VOTE_REGUSER'] . "</strong> (". $lang_new[$module_name]['ADMIN_DOWNLOAD_VOTE_TOTAL'] .": $totalvotes)</span></legend>";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td width=\"25%\" align=\"center\" bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['USER'] ."</strong></td>";
    echo "<td width=\"15%\"  align=\"center\" bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['IP_ADRESS'] ."</strong></td>";
    echo "<td width=\"10%\"  align=\"center\" bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['ADMIN_DOWNLOAD_RATING'] ."</strong></td>";
    echo "<td width=\"15%\"  align=\"center\" bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['DATE'] ."</strong></td>";
    echo "<td width=\"10%\"  align=\"center\" bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['ADMIN_DOWNLOAD_RATING_TOTAL'] ."</strong></td>";
    echo "<td width=\"13%\"  align=\"center\" bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['ADMIN_DOWNLOAD_RATING_AVERAGE'] ."</strong></td>";
    echo "<td width=\"12%\"  align=\"center\" bgcolor='".$ThemeInfo['bgcolor1']."'><strong><center>". $lang_new[$module_name]['DELETE'] ."</center></strong></td>";
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
        $result6 = $db->sql_query("SELECT `rating` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratinguser` = '$ratinguser'");
        $usertotalcomments = $db->sql_numrows($result6);
        $useravgrating = 0;
        while($row6 = $db->sql_fetchrow($result6)) {$useravgrating = $useravgrating + $row6['rating'];}
        $db->sql_freeresult($result6);
        $useravgrating = $useravgrating / $usertotalcomments;
        $useravgrating = number_format($useravgrating, 1);
        echo "<tr><td bgcolor=\"$colorswitch\">$ratinguser</td><td bgcolor=\"$colorswitch\">$ratinghostname</td><td bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\">$usertotalcomments</td><td bgcolor=\"$colorswitch\">$useravgrating</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=DownloadsDelVote&amp;did=$did&amp;rldbid=$ratingdid>X</a></strong></center></td></tr>\n";
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
    $result7 = $db->sql_query("SELECT `ratingdbid`, `rating`, `ratinghostname`, `ratingtimestamp` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratingdid` = '$did' AND `ratinguser` = '' ORDER BY `ratingtimestamp` DESC");
    $totalvotes = $db->sql_numrows($result7);
    echo "<br /><fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_VOTE_UNREG'] . "</strong> (". $lang_new[$module_name]['ADMIN_DOWNLOAD_VOTE_TOTAL'] .": $totalvotes)</span></legend>";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"2\"><strong>" . $lang_new[$module_name]['IP_ADRESS'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"3\"><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_RATING'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['DATE'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."'><strong><center>". $lang_new[$module_name]['DELETE'] ."</center></strong></td></tr>\n";
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
        echo "<td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=DownloadsDelVote&amp;did=$did&amp;rldbid=$ratingdid>X</a></strong></center></td></tr>\n";
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
    $result8 = $db->sql_query("SELECT `ratingdbid`, `rating`, `ratinghostname`, `ratingtimestamp` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratingdid` = '$did' AND `ratinguser` = 'outside' ORDER BY `ratingtimestamp` DESC");
    $totalvotes = $db->sql_numrows($result8);
    echo "<br /><fieldset><legend><span class='option'><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_VOTE_GUESTS'] . "</strong> (". $lang_new[$module_name]['ADMIN_DOWNLOAD_VOTE_TOTAL'] .": $totalvotes)</span></legend>";
    echo "<table width=\"100%\" border=\"0\">\n";
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"2\"><strong>". $lang_new[$module_name]['IP_ADRESS'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"3\"><strong>". $lang_new[$module_name]['ADMIN_DOWNLOAD_RATING'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['DATE'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."'><strong><center>". $lang_new[$module_name]['DELETE'] ."</center></strong></td></tr>\n";
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
        echo "<tr><td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=DownloadsDelVote&amp;did=$did&amp;rldbid=$ratingdid>X</a></strong></center></td></tr>\n";
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
echo "</form>";
CloseTable();
echo "<br />";
include_once(NUKE_BASE_DIR.'footer.php');

?>