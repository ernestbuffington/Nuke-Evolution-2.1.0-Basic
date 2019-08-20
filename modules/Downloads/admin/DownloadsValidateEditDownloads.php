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

global $ThemeInfo, $downloads_config;
DownloadsHeader();

OpenTable();
$did = intval($did);
echo "<span class='option'><strong>".$lang_new[$module_name]['ADMIN_VALIDATION_DOWNLOAD']."</strong></span>";
echo "<h3></h3>";
echo "<form method='post' action='".$admin_file.".php' name='downloadseditvalidate' enctype='multipart/form-data'>";
$row = $db->sql_ufetchrow("SELECT * FROM `"._DOWNLOADS_NEWDOWNLOADS_TABLE."` WHERE `did`='".$did."'");
$admin_data = get_admin_field('*', $aid);

if ($row['did'] =! $did) {
    echo "<script type='text/javascript'>
        window.onload = load;
        function load(){
            Sexy.alert('".$lang_new[$module_name]['ERROR_NO_DID']."', {
                onComplete: function(returnvalue){
                    if(returnvalue){
                        window.location.href = 'admin.php?op=Downloads';
                    }
                }
            });
            return false;
        }
    </script>";
}
    
$cid                        = intval($row['cid']);
$title                      = stripslashes($row['title']);
$image                      = $row['image'];
$description                = evo_img_tag_to_resize(stripslashes($row['description']));
$download_active            = intval($row['download_active']);
$download_username          = stripslashes($row['name']);
$download_submitter         = stripslashes($row['submitter']);
$download_submitter_email   = $row['email'];
$download_submitted         = formatTimestamp($row['date']);
$uploadfile                 = stripslashes($row['download_filename']);
$download_author            = stripslashes($row['download_author']);
$download_author_email      = stripslashes($row['download_author_email']);
$download_author_website    = stripslashes($row['download_author_website']);
$download_added             = intval($row['date']);
$download_version           = stripslashes($row['download_version']);
$download_size              = intval($row['download_size']);
$download_license           = intval($row['download_license']);
$download_mimetype          = stripslashes($row['download_mimetype']);
$download_name              = stripslashes($row['download_name']);
$download_type              = intval($row['download_type']);
$download_torrent           = stripslashes($row['download_torrent']);
$download_url               = stripslashes($row['url']);
$is_valid                   = DownloadsIsValid($uploadfile, $download_url, $download_type);

$result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` ORDER BY `title`");
$gresult = $db->sql_query("SELECT `dg`.`group_id`, `bb`.`group_name` FROM (`"._DOWNLOADS_GROUPS_TABLE."` dg LEFT JOIN `".GROUPS_TABLE."` bb ON `bb`.`group_id` = `dg`.`group_id`) WHERE `dg`.`group_active` = '1' ORDER BY group_name");
$lresult = $db->sql_query("SELECT `license_id`, `license_title` FROM `"._DOWNLOADS_LICENSES_TABLE."` ORDER BY `license_title`");

echo "<table width='100%' border='0'>";

echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_PAGETITLE'])." ".$lang_new[$module_name]['DOWNLOAD_PAGETITLE'].": </td><td><input type='text' name='modify_title' size='75%' maxlength='255' value='".$title."'/></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_CATEGORY'])." ".$lang_new[$module_name]['CATEGORY'].": </td><td>";
echo "<select name='modify_cat'>";

while($row = $db->sql_fetchrow($result1)) {
    $cid2 = intval($row['cid']);
    $ctitle2 = stripslashes($row['title']);
    $parentid2 = intval($row['parentid']);
    if ($parentid2!=0) {
        $ctitle2=DownloadsGetParent($parentid2,$ctitle2);
    }
    if ($cid2 == $cid ) {
        echo "<option value='$cid2' selected='selected'>".$ctitle2."</option>";
    } else {
        echo "<option value='$cid2'>".$ctitle2."</option>";
    }
}

$db->sql_freeresult($result1);
echo "</select></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";

if (!empty($image) ){
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_IMAGE_PREVIEW'])." ".$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'].":</td><td><a href='".$image."' rel='lightbox' title='".$title."' rev='' ><img src='"."imgsize.php?src=".$image."&amp;w=80'  border='0' title='".$title."' alt='' /></a></td></tr>";
}

echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_FILENAME'])." ".$lang_new[$module_name]['DOWNLOAD_NAME'].":</td><td><img src='".($is_valid ? evo_image('ok.png', $module_name) : evo_image('bad.png', $module_name))."' title='' alt='' />&nbsp;<a href='".$uploadfile."' target='_blank'>".$download_name."</a>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SIZE'])." ".$lang_new[$module_name]['DOWNLOAD_FILESIZE'].":</td><td>".$download_size." ".$lang_new[$module_name]['SIZE_BYTE']."</td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td bgcolor='".$bgcolor1."' align='left' colspan='3' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DESCRIPTION'])." ". $lang_new[$module_name]['DESCRIPTION']."</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' colspan='3' style='border:solid white 1px'>";
Make_TextArea('modify_description',$description,'downloadseditvalidate', '90%', '150px', TRUE, 'bbcode');
echo "</td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";

if(!empty($download_author_website)){
    $http = '';
}else{
    $http = 'http://';
}

echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR'])." ".$lang_new[$module_name]['DOWNLOAD_AUTHOR'].": </td><td><input type='text' name='modify_download_author' size='75%' maxlength='255' value='".$download_author."'/></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_EMAIL'])." ".$lang_new[$module_name]['DOWNLOAD_AUTHOR_EMAIL'].": </td><td><input type='text' name='modify_download_author_email' size='75%' maxlength='255' value='".$download_author_email."'/></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_WEBSITE'])." ".$lang_new[$module_name]['DOWNLOAD_AUTHOR_WEBSITE'].": </td><td><input type='text' name='modify_download_author_website' size='75%' maxlength='255' value='".$http.$download_author_website."'/></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_VERSION'])." ".$lang_new[$module_name]['DOWNLOAD_VERSION'].": </td><td><input type='text' name='modify_download_version' size='75%' maxlength='255' value='".$download_version."'/></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_TORRENTS'],$lang_new[$module_name]['DOWNLOAD_TORRENT'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_TORRENT'].": </td><td><input type='text' name='modify_download_torrent' value='".$download_torrent."' size='75%' maxlength='255' /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_LICENSE_TYPE'])." ".$lang_new[$module_name]['LICENSE_TYPE'].": </td>";
echo "<td><select name='download_license'>\n";
echo "<option value='0' >".$lang_new[$module_name]['NONE']."</option>\n";

while($licinfo = $db->sql_fetchrow($lresult)) {
    if ( $licinfo['license_id'] == $download_license ) {
        $lsel = 'selected';
    } else {
        $lsel = '';
    }
    $license_title = stripslashes($licinfo['license_title']);
    echo "<option value='".$licinfo['license_id']."' $lsel>".$license_title."</option>";
}

$db->sql_freeresult($lresult);
echo "</select></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_GROUP_RESTRICTED_DOWNLOAD'])." ".$lang_new[$module_name]['DOWNLOAD_RESTRICTED_GROUP_DOWNLOAD'].":</td><td><select name='modify_download_restricted_group_download'>";
echo DownloadsGroupSelect(0);
echo "</select></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_GROUP_RESTRICTED_SEE'])." ".$lang_new[$module_name]['DOWNLOAD_RESTRICTED_GROUP_SEE'].":</td><td><select name='modify_download_restricted_group_see'>";
echo DownloadsGroupSelect(0);
echo "</select></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MEANTIME'])." ".$lang_new[$module_name]['DOWNLOAD_MEANTIME'].": </td><td><input type='text' name='modify_download_in_time' size='6' maxlength='6' value='0' /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MEANTIME_ALLOWED'])." ".$lang_new[$module_name]['DOWNLOAD_ALLOWED_DOWNLOADS_MEANTIME'].": </td><td><input type='text' name='modify_total_downloads_meantime' size='6' maxlength='6' value='0' /></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_TOTAL_ALLOWED_DOWNLOADS'])." ".$lang_new[$module_name]['DOWNLOAD_TOTAL_ALLOWED_DOWNLOADS'].": </td><td><input type='text' name='modify_total_downloads' size='6' maxlength='6' value='0' /></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMITTER'])." ".$lang_new[$module_name]['DOWNLOAD_SUBMITTER'].": </td><td>".UsernameColor($download_username)."</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMITTER_EMAIL'])." ".$lang_new[$module_name]['DOWNLOAD_SUBMITTER_EMAIL'].": </td><td>".$download_submitter_email."</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMIT_DATE'])." ".$lang_new[$module_name]['DOWNLOAD_SUBMIT_DATE'].": </td><td>".$download_submitted."</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_VALIDATE_NAME'])." ".$lang_new[$module_name]['NAME'].": </td><td>".UsernameColor($admin_data['aid'])."</td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_VALIDATE_EMAIL'])." ".$lang_new[$module_name]['EMAIL'].": </td><td>".$admin_data['email']."</td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_ACTIVE'])." ".$lang_new[$module_name]['DOWNLOAD_ACTIVE']."</td><td>";

if ($is_valid) {
    echo yesno_option('modify_download_active', $download_active);
} else {
    echo $lang_new[$module_name]['DOWNLOAD_NOT_ACTIVABLE'];
}

echo "</td></tr>";
echo "</table><br />";
echo "<input type='hidden' name='op' value='DownloadsModDownloadS' />";
echo "<input type='hidden' name='modify_did' value='".$did."' />";
echo "<input type='hidden' name='modify_download_name' value='".$download_name."' />";
echo "<input type='hidden' name='modify_download_type' value='".$download_mimetype."' />";
echo "<input type='hidden' name='modify_first_cid' value='".$cid."' />";
echo "<input type='hidden' name='modify_filename' value='".$uploadfile."' />";
echo "<input type='hidden' name='modify_image_name' value='".$image."' />";
echo "<input type='hidden' name='modify_download_submitter' value='".$download_username."' />";
echo "<input type='hidden' name='modify_download_submitter_email' value='".$download_submitter_email."' />";
echo "<input type='hidden' name='modify_validation' value='1' />";
echo "<input type='hidden' name='modify_added' value='".$download_added."' />";

if (!$is_valid || !$download_active) {
    echo "<center><font color='red'>".$lang_new[$module_name]['DOWNLOAD_INACTIVE']."</font><br /><br />";
} else {
    echo "<center><font color='green'>".$lang_new[$module_name]['DOWNLOAD_ACTIVE']."</font><br /><br />";
}

echo "<input type='submit' value='".$lang_new[$module_name]['SUBMIT_MODIFY']."' /></center>";
echo "<center>[ <a href='".$admin_file.".php?op=DownloadsDelete&amp;did=$did&amp;is_validate=1'>".$lang_new[$module_name]['SUBMIT_DELETE']."</a> ]</center>";
echo "<br />";
echo "</form>";

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>