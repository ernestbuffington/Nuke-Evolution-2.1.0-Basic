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

global $ThemeInfo;

$admin_data             = get_admin_field('*', $aid);
$extens_list            = '';

$eresult = $db->sql_query("SELECT `ext`, `mimetype`, `description` FROM `". _DOWNLOADS_EXTENSIONS_TABLE ."` WHERE `active`='1' ORDER BY `ext` ASC");
$result1 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` ORDER BY `title`");
$lresult = $db->sql_query("SELECT `license_id`, `license_title` FROM `"._DOWNLOADS_LICENSES_TABLE."` ORDER BY `license_title`");

while ($row = $db->sql_fetchrow($eresult)) {
    $extens_list  .= $row['ext'].', ';
}

DownloadsHeader();

echo "<script type='text/javascript'>
      /*<![CDATA[*/\n
function validate(){
    if (document.DownloadsAddDownload.title.value == ''){
        Sexy.alert('".$lang_new[$module_name]['HELP_ADD_TITLE']."');
        return false;
    }

    if (document.DownloadsAddDownload.fileupload.value == '' && document.DownloadsAddDownload.download_url.value == ''){
        Sexy.alert('".$lang_new[$module_name]['HELP_FILE_TO_UPLOAD']."');
        return false;
    } else {
        var fieldvalue  = document.DownloadsAddDownload.fileupload.value;
        fieldvalue      = fieldvalue.toLowerCase();
        var ext         = '".$extens_list."';
        var extens      = new Array();
        var extens      = ext.split(', ');
        var thisext     = fieldvalue.substr(fieldvalue.lastIndexOf('.'));
        for(var i = 0; i < extens.length; i++) {
            if(thisext == extens[i]) { return true; }
        }
        Sexy.alert('".$lang_new[$module_name]['HELP_FILE_VALID1']."' + ext + '".$lang_new[$module_name]['HELP_FILE_VALID2']."');
        return false;
    }

    if (document.DownloadsAddDownload.cat.value == '' || document.DownloadsAddDownload.cat.value == 0){
        Sexy.alert('".$lang_new[$module_name]['HELP_SELECT_CAT']."');
        return false;
    }

    if (document.DownloadsAddDownload.uploadimage.value != ''){
        var extension   = new Array();
        var fieldvalue  = document.DownloadsAddDownload.uploadimage.value;
        fieldvalue      = fieldvalue.toLowerCase();
        extension[0]    = '.png';
        extension[1]    = '.gif';
        extension[2]    = '.jpg';
        extension[3]    = '.jpeg';
        extension[4]    = '.bmp';
        var thisext = fieldvalue.substr(fieldvalue.lastIndexOf('.'));
        for(var i = 0; i < extension.length; i++) {
            if(thisext == extension[i]) { return true; }
        }
        Sexy.alert('".$lang_new[$module_name]['HELP_IMAGE_VALID']."');
        return false;
    }
}
\n/*]]>*/\n
</script>";

OpenTable();

echo "<span class='option'><span style='font-weight:bold;'>".$lang_new[$module_name]['ADMIN_ADD_DOWNLOAD']."</span></span>";
echo "<h3></h3>";
echo "<form id='DownloadsAddDownload' name='DownloadsAddDownload' action='".$admin_file.".php?op=DownloadsAddNewDownloadS' method='post' enctype='multipart/form-data'>\n";
echo "<table width='100%' border='0' align='center'>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_PAGETITLE'],$lang_new[$module_name]['DOWNLOAD_PAGETITLE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_PAGETITLE'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input type='text' name='title' size='75%' maxlength='255' /></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_CATEGORY'],$lang_new[$module_name]['CATEGORY'])."&nbsp;".$lang_new[$module_name]['CATEGORY'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td>";
echo "<select name='cat'>";
    while($row = $db->sql_fetchrow($result1)) {
        $cid2       = intval($row['cid']);
        $ctitle2    = stripslashes($row['title']);
        $parentid2  = intval($row['parentid']);
        if ($parentid2 != 0) {
                $ctitle2 = DownloadsGetParent($parentid2,$ctitle2);
        }
        echo "<option value='".$cid2."'>".$ctitle2."</option>";
    }

$db->sql_freeresult($result1);
echo "</select></td></tr>\n";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px' align='left' colspan='3' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DESCRIPTION'],$lang_new[$module_name]['DESCRIPTION'])."&nbsp;".$lang_new[$module_name]['DESCRIPTION'].":</td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='center' colspan='3' style='border:solid white 1px' ><br />";
echo Make_TextArea('description',$description,'DownloadsAddDownload', '90%', '150px', true, 'bbcode')."</td></tr>\n";
echo "<tr><td colspan='3'><h3><br /></h3></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_UPLOAD'],$lang_new[$module_name]['DOWNLOAD_UPLOAD'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_UPLOAD'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input type='file' name='fileupload' size='75%' maxlength='100' /></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_URL'],$lang_new[$module_name]['DOWNLOAD_UPLOAD'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_URL'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input type='text' name='download_url' size='75%' maxlength='100' /></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_ALLOWED_EXTENSIONS_PUBLIC'],$lang_new[$module_name]['DOWNLOAD_ALLOWED_EXTENSIONS'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_ALLOWED_EXTENSIONS'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'></td><td bgcolor='".$ThemeInfo['bgcolor1']."'>".DownloadsAllowedExtensions(TRUE)."</td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MAX_FILESIZE_PUBLIC'],$lang_new[$module_name]['DOWNLOAD_MAX_FILESIZE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_MAX_FILESIZE'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'></td><td bgcolor='".$ThemeInfo['bgcolor1']."'>".DownloadsMaxAllowedFileSize(TRUE)."</td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_UPLOAD_IMAGE'],$lang_new[$module_name]['DOWNLOAD_IMAGEUPLOAD'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_IMAGEUPLOAD']."</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'></td><td><input type='file' name='uploadimage' size='75' maxlength='100' /></td></tr>\n";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR'],$lang_new[$module_name]['DOWNLOAD_AUTHOR'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_AUTHOR'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'></td><td><input type='text' name='download_author' size='75%' maxlength='255' /></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_EMAIL'],$lang_new[$module_name]['DOWNLOAD_AUTHOR_EMAIL'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_AUTHOR_EMAIL'].":</td><td  bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'></td><td><input type='text' name='download_author_email' size='75%' maxlength='255' /></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_WEBSITE'],$lang_new[$module_name]['DOWNLOAD_AUTHOR_WEBSITE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_AUTHOR_WEBSITE'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'></td><td><input type='text' name='download_author_website' size='75%' maxlength='255' value='http://' /></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_VERSION'],$lang_new[$module_name]['DOWNLOAD_VERSION'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_VERSION'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'></td><td><input type='text' name='download_version' size='75%' maxlength='255' /></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_TORRENTS'],$lang_new[$module_name]['DOWNLOAD_TORRENT'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_TORRENT'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'></td><td><input type='text' name='download_torrent' size='75%' maxlength='255' /></td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_LICENSE_TYPE'],$lang_new[$module_name]['LICENSE_TYPE'])."&nbsp;".$lang_new[$module_name]['LICENSE_TYPE'].":</td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px'></td>";
echo "<td><select name='download_license'>";
echo "<option value='0' selected='selected'>".$lang_new[$module_name]['NONE']."</option>";
while($licinfo = $db->sql_fetchrow($lresult)) {
    $license_title = stripslashes($licinfo['license_title']);
    echo "<option value='".$licinfo['license_id']."'>".$license_title."</option>";
}
$db->sql_freeresult($lresult);
echo "</select></td></tr>\n";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>\n";
echo "<tr><td colspan='3' style='border:solid white 1px' ><table width='100%' align='center'>\n<tr><td class='dl_td' ".$over_out." width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_GROUP_RESTRICTED_DOWNLOAD'],$lang_new[$module_name]['DOWNLOAD_RESTRICTED_GROUP_DOWNLOAD'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_RESTRICTED_GROUP_DOWNLOAD'].":</td>";
echo "<td class='dl_td' ".$over_out." width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_GROUP_RESTRICTED_SEE'],$lang_new[$module_name]['DOWNLOAD_RESTRICTED_GROUP_SEE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_RESTRICTED_GROUP_SEE'].":</td></tr>\n</table>\n</td></tr>";
echo "<tr><td colspan='3' style='border:solid white 1px' ><table width='100%' align='center'>\n<tr><td class='dl_td' ".$over_out." width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' ><select name='download_restricted_group_download'>";
echo DownloadsGroupSelect(0);
echo "</select></td>";
echo "<td class='dl_td' ".$over_out." width='50%' bgcolor='".$ThemeInfo['bgcolor2']."' align='center' ><select name='download_restricted_group_see'>";
echo DownloadsGroupSelect(0);
echo "</select></td></tr>\n</table>\n</td></tr><tr><td><br /></td></tr>\n";
echo "<tr><td colspan='3' style='border:solid white 1px' ><table width='100%' align='center' >\n<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='33%' valign='top' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MEANTIME'],$lang_new[$module_name]['DOWNLOAD_MEANTIME'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_MEANTIME'].":</td>";
echo "<td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='33%' valign='top' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MEANTIME_ALLOWED'],$lang_new[$module_name]['DOWNLOAD_ALLOWED_DOWNLOADS_MEANTIME'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_ALLOWED_DOWNLOADS_MEANTIME'].":</td>";
echo "<td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' width='33%' valign='top' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_TOTAL_ALLOWED_DOWNLOADS'],$lang_new[$module_name]['DOWNLOAD_TOTAL_ALLOWED_DOWNLOADS'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_TOTAL_ALLOWED_DOWNLOADS'].":</td></tr>\n</table>\n</td></tr>\n";
echo "<tr><td colspan='3' style='border:solid white 1px' ><table width='100%' align='center' ><tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' width='33%' align='center' ><input type='text' value='0' name='download_intime' size='6' maxlength='6' /></td><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' width='33%' align='center' ><input type='text' value='0' name='total_downloads_meantime' size='6' maxlength='6' /></td><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' width='33%' align='center' ><input type='text' value='0' name='total_downloads' size='6' maxlength='6' /></td></tr>\n</table>\n</td></tr>\n";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMITTER'],$lang_new[$module_name]['NAME'])."&nbsp;".$lang_new[$module_name]['NAME'].": </td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td>".$admin_data['aid']."</td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_SUBMITTER_EMAIL'],$lang_new[$module_name]['EMAIL'])."&nbsp;".$lang_new[$module_name]['EMAIL'].": </td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td>".$admin_data['email']."</td></tr>\n";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_ACTIVE'],$lang_new[$module_name]['DOWNLOAD_ACTIVE'])."&nbsp;".$lang_new[$module_name]['DOWNLOAD_ACTIVE']."</td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td>";
echo yesno_option('download_active', 1)."</td></tr>\n";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>\n";
echo "<tr><td colspan='3' align='center'><input type='submit' onclick='return validate();' value='".$lang_new[$module_name]['SUBMIT_ADD']."' /></td></tr>\n";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>\n";
echo "</table>\n";
echo "<input type='hidden' name='download_username' value='".$admin_data['aid']."' />\n";
echo "<input type='hidden' name='download_email' value='".$admin_data['email']."' />\n";
echo "</form>\n";

CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');
?>