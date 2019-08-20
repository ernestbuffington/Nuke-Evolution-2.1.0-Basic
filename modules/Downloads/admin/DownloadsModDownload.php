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


global $admin_file, $db, $module_name, $_GETVAR, $lang_new, $aid, $userinfo, $ThemeInfo;

DownloadsHeader();

OpenTable();

$admin_data = get_admin_field('*', $aid);

if (!is_user()) {
    $userinfo['username'] = $admin_data['aid'];
    $userinfo['user_email'] = $admin_data['email'];
}

$lresult    = $db->sql_query("SELECT `license_id`, `license_title` FROM `"._DOWNLOADS_LICENSES_TABLE."` ORDER BY `license_title`");
$result1    = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` ORDER BY `title`");
$result     = $db->sql_query("SELECT * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did`='".$did."'");

while($row = $db->sql_fetchrow($result)) {

    $modify_cid                         = intval($row['cid']);
    $modify_description                 = evo_img_tag_to_resize($row['description']);
    $modify_download_active             = intval($row['download_active']);
    $modify_download_author             = $row['download_author'];
    $modify_download_author_email       = $row['download_author_email'];
    $modify_download_author_website     = $row['download_author_website'];
    $modify_download_groups             = intval($row['download_groups']);
    $modify_download_groups_see         = intval($row['download_groups_see']);
    $modify_download_in_time            = intval($row['download_mintime']);
    $modify_download_license            = intval($row['download_license']);
    $modify_download_name               = $row['download_name'];
    $modify_download_version            = $row['download_version'];
    $modify_download_size               = intval($row['download_size']);
    $modify_download_submitter          = $row['submitter'];
    $modify_download_torrent            = htmlspecialchars($row['download_torrent'],ENT_QUOTES);
    $modify_filename                    = $row['download_filename'];
    $modify_image_filename              = $row['image'];
    $modify_title                       = $row['title'];
    $modify_total_downloads             = intval($row['download_countmax']);
    $modify_total_downloads_meantime    = intval($row['download_countmintime']);
    $modify_download_groups_see         = intval($row['download_groups_see']);
    $modify_download_groups             = intval($row['download_groups']);
}
/*
    $date                   = intval($row['date']);
    $date_validated         = intval($row['date_validated']);
    $email                  = $row['email'];
    $name                   = $row['name'];
*/

echo "<span class='option'><strong>".$lang_new[$module_name]['ADMIN_MODIFY_DOWNLOAD']."</strong></span>";
echo "<h3></h3>";
echo "<form method='post' action='".$admin_file.".php?op=DownloadsModDownloadS' name='downloadsmoddownload' id='downloadsmoddownload' enctype='multipart/form-data'>";
echo "<table width='100%' border='0' align='center'>";

/********** TITLE START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_PAGETITLE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_PAGETITLE'].":</td>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><span style='color:red; font-weight:bold;'>*</span></td>
        <td><input type='text' name='modify_title' size='75%' maxlength='100' value='".$modify_title."'/></td>
    </tr>";
/********** TITLE END **********/

/********** CATEGORY START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_CATEGORY'])."&nbsp;".$lang_new[$module_name]['CATEGORY'].":</td>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><span style='color:red; font-weight:bold;'>*</span></td>
        <td><select name='modify_cat'>";

while($row = $db->sql_fetchrow($result1)) {
    $cid2       = intval($row['cid']);
    $ctitle2    = stripslashes($row['title']);
    $parentid2  = intval($row['parentid']);
    if ($parentid2!=0) {
        $ctitle2=DownloadsGetParent($parentid2,$ctitle2);
    }
    if ($cid2 == $modify_cid ) {
        echo "<option value='".$cid2."' selected='selected'>".$ctitle2."</option>";
    } else {
        echo "<option value='".$cid2."'>".$ctitle2."</option>";
    }
}

$db->sql_freeresult($result1);
echo "
        </select></td>
    </tr>";
/********** CATEGORY END **********/

echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";

/********** DESCRIPTION START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' colspan='3' >
            ".evo_help_img($lang_new[$module_name]['HELP_DESCRIPTION'])."&nbsp;".$lang_new[$module_name]['DESCRIPTION']."
        </td>
    </tr>";
/********** DESCRIPTION END **********/

echo "
    <tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' colspan='3' style='border:solid white 1px' >";
echo Make_TextArea('modify_description',$modify_description,'downloadsmoddownload', '90%', '150px', true, 'bbcode')."
    </td></tr>";
echo "<tr><td colspan='3'><h3><br /></h3></td></tr>";

//echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_URL'])."&nbsp;". $lang_new[$module_name]['DOWNLOAD_URL'].":</td><td></td><td>".$modify_filename."</td></tr>";

/********** UPLOAD START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_UPLOAD'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_UPLOAD'].":</td>
        <td></td><td><input type='file' name='modify_uploadfile' size='75%' maxlength='255' /></td>
    </tr>";
/********** UPLOAD END **********/

/********** EXTENSION START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_ALLOWED_EXTENSIONS'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_ALLOWED_EXTENSIONS'].":</td><td></td>
        <td bgcolor='".$ThemeInfo['bgcolor1']."'><b>".DownloadsAllowedExtensions(TRUE)."</b></td>
    </tr>";
/********** EXTENSION END **********/

/********** SIZE START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MAX_FILESIZE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_MAX_FILESIZE']."</td><td></td>
        <td><b>".DownloadsMaxAllowedFileSize(TRUE)."</b></td>
    </tr>";
/********** SIZE END **********/

//echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['HELP_IMAGE_URL'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_IMAGE_URL'].":</td><td></td><td>".$modify_image_filename."</td></tr>";

/********** PREVIEW START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_IMAGE_PREVIEW'])."&nbsp;".$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'].":</td><td></td>
        <td><a href='".$modify_image_filename."' rel='lightbox' title='".$modify_title."' rev='' ><img src='"."imgsize.php?src=".$modify_image_filename."&amp;w=80'  border='0' title='".$modify_title."' alt='' /></a></td>
    </tr>";
/********** PREVIEW END **********/

/********** IMAGEUPLOAD START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
        ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_UPLOAD'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_IMAGEUPLOAD'].":</td><td></td><td><input type='file' name='modify_image_upload' size='75%' maxlength='255' /></td>
    </tr>";
/********** IMAGEUPLOAD END **********/

echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";

/********** AUTHOR START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_AUTHOR'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."'></td>
        <td><input type='text' name='modify_download_author' size='75%' maxlength='255' value='".$modify_download_author."' /></td>
    </tr>";
/********** AUTHOR END **********/

/********** AUTHOREMAIL START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_EMAIL'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_AUTHOR_EMAIL'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."'></td>
        <td><input type='text' name='modify_download_author_email' size='75%' maxlength='255' value='".$modify_download_author_email."' /></td>
    </tr>";
/********** AUTHOREMAIL END **********/

/********** AUTHORSITE START **********/
if(!empty($modify_download_author_website)){
    $http = '';
}else{
    $http = 'http://';
}

echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_WEBSITE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_AUTHOR_WEBSITE'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."'></td>
        <td><input type='text' name='modify_download_author_website' size='75%' maxlength='255' value='".$http.$modify_download_author_website."' /></td>
    </tr>";
/********** AUTHORSITE END ***********/

/********** VERSION START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_VERSION'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_VERSION'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."'></td>
        <td><input type='text' name='modify_download_version' size='75%' maxlength='255' value='".$modify_download_version."' /></td>
    </tr>";
/********** VERSION END **********/

/********** LICENSE START **********/
echo "
    <tr>
        <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
            ".evo_help_img($lang_new[$module_name]['HELP_LICENSE_TYPE'])."&nbsp;".$lang_new[$module_name]['LICENSE_TYPE'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."'></td>
        <td><select name='modify_download_license'>
            <option value='0' >".$lang_new[$module_name]['NONE']."</option>";

while($licinfo = $db->sql_fetchrow($lresult)) {
    if ( $licinfo['license_id'] == $modify_download_license ) {
        $lsel = 'selected="selected"';
    } else {
        $lsel = '';
    }
    $license_title = stripslashes($licinfo['license_title']);
    echo "<option value='".$licinfo['license_id']."' ".$lsel.">".$license_title."</option>";
}

$db->sql_freeresult($lresult);
echo "
        </select></td>
    </tr>";
/*********** LICENSE END **********/

echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";

/********** GROUPDOWNLOAD / GROUPSEE START **********/
echo "
    <tr><td colspan='3'>
        <table width='100%' style='border:solid white 1px' align='center'>
            <tr><td width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid 1px' >
                ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_GROUP_RESTRICTED_DOWNLOAD'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_RESTRICTED_GROUP_DOWNLOAD'].":</td>
            <td width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid 1px' >
                ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_GROUP_RESTRICTED_SEE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_RESTRICTED_GROUP_SEE'].":
            </td></tr>
        </table>
    </td></tr>
    <tr><td colspan='3'>
        <table width='100%' style='border:solid white 1px' align='center'>
            <tr><td width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' >
                <select name='modify_download_restricted_group_download'>";
echo DownloadsGroupSelect($modify_download_groups);
echo "</select></td>";
echo "       <td width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' >
                <select name='modify_download_restricted_group_see'>";
echo DownloadsGroupSelect($modify_download_groups_see);
echo "</select></td></tr></table></td></tr>";
/********** GROUPDOWNLOAD / GROUPSEE END **********/

/********** MEANTIME / MEANTIMEALLOWED / TOTALDOWNLOADS START **********/
echo "
    <tr><td colspan='3'>
        <table width='100%' style='border:solid white 1px' align='center' >
            <tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='33%' style='border:solid 1px' >
                ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MEANTIME'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_MEANTIME'].":</td>
            <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='33%' style='border:solid 1px' >
                ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MEANTIME_ALLOWED'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_ALLOWED_DOWNLOADS_MEANTIME'].":</td>
            <td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='33%' style='border:solid 1px' >
                ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_TOTAL_ALLOWED_DOWNLOADS'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_TOTAL_ALLOWED_DOWNLOADS'].":
            </td></tr>
        </table>
    </td></tr>

    <tr><td colspan='3'>
        <table width='100%' style='border:solid white 1px' align='center' >
            <tr><td width='33%' align='center' ><input type='text' name='modify_download_in_time' size='6' maxlength='6' value='".$modify_download_in_time."' />&nbsp;".$lang_new[$module_name]['SECONDS']."</td>
            <td width='33%' align='center' ><input type='text' name='modify_total_downloads_meantime' size='6' maxlength='6' value='".$modify_total_downloads_meantime."' /></td>
            <td width='33%' align='center' ><input type='text' name='modify_total_downloads' size='6' maxlength='6' value='".$modify_total_downloads."' /></td></tr>
        </table>
    </td></tr>";
/********** MEANTIME / MEANTIMEALLOWED / TOTALDOWNLOADS END **********/

echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";

/********** SUBMITTER START **********/
echo "
    <tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
        ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMITTER'])."&nbsp;".$lang_new[$module_name]['NAME'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><span style='color:red; font-weight:bold;'>*</span></td>
        <td>".$userinfo['username']."</td>
    </tr>";
/********** SUBMITTER END **********/

/********** SUBEMAIL START **********/
echo "
    <tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
        ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMITTER_EMAIL'])."&nbsp;".$lang_new[$module_name]['EMAIL'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><span style='color:red; font-weight:bold;'>*</span></td>
        <td>".$userinfo['user_email']."</td>
    </tr>";
/********** SUBMAIL END **********/

/********** TORRENT START **********/
echo "
    <tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >
        ".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_TORRENTS'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_TORRENT'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."'></td>
        <td><input type='text' name='modify_download_torrent' size='75%' maxlength='255' value='".$modify_download_torrent."' /></td>
    </tr>";
/********** TORRENT END **********/

echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'  align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_UPDATED'])."&nbsp;".$lang_new[$module_name]['ADMIN_DOWNLOAD_SHOW_UPDATE']."</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><span style='color:red; font-weight:bold;'>*</span></td><td>";
echo yesno_option('modify_show_updated', 0)."</td></tr>";

echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_ACTIVE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_ACTIVE']."</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><span style='color:red; font-weight:bold;'>*</span></td><td>";
echo yesno_option('modify_download_active', $modify_download_active)."</td></tr>";

echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "</table><br />";
echo "<input type='hidden' name='modify_first_cid' value='".$modify_cid."' />";
echo "<input type='hidden' name='modify_did' value='".$did."' />";
echo "<input type='hidden' name='modify_download_name' value='".$modify_download_name."' />";
echo "<input type='hidden' name='modify_image_name' value='".$modify_image_filename."' />";
echo "<input type='hidden' name='modify_filename' value='".$modify_filename."' />";
echo "<input type='hidden' name='modify_download_submitter' value='".$modify_download_submitter."' />";
echo "<input type='hidden' name='modify_download_type' value='".$row['download_type']."' />";
echo "<center><input type='submit' value='".$lang_new[$module_name]['SUBMIT_MODIFY']."' /></center>";
echo "<center>[ <a href='".$admin_file.".php?op=DownloadsDelDownload&amp;did=".$did."'>".$lang_new[$module_name]['SUBMIT_DELETE']."</a> ]</center>";
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
echo "<tr><td width=\"20%\" bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"1\"><strong>". $lang_new[$module_name]['USER'] ."</strong></td><td  bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"5\"><strong>". $lang_new[$module_name]['COMMENTS'] ." </strong></td><td  bgcolor='".$ThemeInfo['bgcolor1']."' align=\"center\"><strong>". $lang_new[$module_name]['DELETE'] ."</strong></td></tr>";
if ($totalcomments == 0) {
    echo "<tr><td colspan=\"7\"><center>" . $lang_new[$module_name]['WARN_COMMENT_NOT_FOUND'] ."</center></td></tr>\n";
}
$x=0;
$colorswitch = $color['tablecolor1'];
while($row4 = $db->sql_fetchrow($result4)) {
    $ratingdbid = intval($row4['ratingdbid']);
    $ratinguser = $row4['ratinguser'];
    $ratingcomments = stripslashes($row4['ratingcomments']);
    $formatted_date = formatTimestamp($row4['ratingtimestamp']);
    echo "<tr><td valign=top bgcolor=\"$colorswitch\">$ratinguser</td><td valign=\"top\" colspan=\"5\" bgcolor=\"$colorswitch\">$ratingcomments</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=DownloadsDelComment&amp;did=$did&amp;rldbid=$ratingdbid>X</a></strong></center></td></tr>\n";
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
echo "<td width=\"12%\"  align=\"center\" bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['DELETE'] ."</strong></td>";
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
    echo "<tr><td bgcolor=\"$colorswitch\">$ratinguser</td><td bgcolor=\"$colorswitch\">$ratinghostname</td><td bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\">$usertotalcomments</td><td bgcolor=\"$colorswitch\">$useravgrating</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=DownloadsDelVote&amp;did=$did&amp;rldbid=$ratingdbid>X</a></strong></center></td></tr>\n";
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
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"2\"><strong>" . $lang_new[$module_name]['IP_ADRESS'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"3\"><strong>" . $lang_new[$module_name]['ADMIN_DOWNLOAD_RATING'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['DATE'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."' align=\"center\"><strong>". $lang_new[$module_name]['DELETE'] ."</strong></td></tr>\n";
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
    echo "<td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=DownloadsDelVote&amp;did=$did&amp;rldbid=$ratingdbid>X</a></strong></center></td></tr>\n";
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
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"2\"><strong>". $lang_new[$module_name]['IP_ADRESS'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."' colspan=\"3\"><strong>". $lang_new[$module_name]['ADMIN_DOWNLOAD_RATING'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."'><strong>". $lang_new[$module_name]['DATE'] ."</strong></td><td bgcolor='".$ThemeInfo['bgcolor1']."' align=\"center\"><strong>". $lang_new[$module_name]['DELETE'] ."</strong></td></tr>\n";
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
    echo "<tr><td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\"><center><strong><a href=".$admin_file.".php?op=DownloadsDelVote&amp;did=$did&amp;rldbid=$ratingdbid>X</a></strong></center></td></tr>\n";
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
echo "<input type=\"hidden\" name=\"new\" value=\"0\" />";
$db->sql_freeresult($result);
CloseTable();

echo "<br />";
include_once(NUKE_BASE_DIR.'footer.php');

?>