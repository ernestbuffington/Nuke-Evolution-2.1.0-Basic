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

 Copyright (c) 2007 by The Nuke Evolution Development Team
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

DownloadsHeader();

$actualtime                         = time();
$alerts                             = 'done';
$cat                                = $_GETVAR->get('cat', 'POST', 'int');
$description                        = $_GETVAR->get('description', 'POST', 'string');
$download_active                    = $_GETVAR->get('download_active', 'POST', 'int');
$download_author                    = $_GETVAR->get('download_author', 'POST', 'string');
$download_author_email              = $_GETVAR->get('download_author_email', 'POST', 'string');
$download_author_website            = $_GETVAR->get('download_author_website', 'POST', 'string');
$download_email                     = $_GETVAR->get('download_email', 'POST', 'string');
$download_intime                    = $_GETVAR->get('download_intime', 'POST', 'int');
$download_license                   = $_GETVAR->get('download_license', 'POST', 'int');
$download_restricted_group_download = $_GETVAR->get('download_restricted_group_download', 'POST', 'int');
$download_restricted_group_see      = $_GETVAR->get('download_restricted_group_see', 'POST', 'int');
$download_torrent                   = $_GETVAR->get('download_torrent', 'POST', 'string');
$download_totaldownload             = $_GETVAR->get('total_downloads', 'POST', 'int');
$download_totalmeantime             = $_GETVAR->get('total_downloads_meantime', 'POST', 'int');
$download_type                      = 0;
$download_username                  = $_GETVAR->get('download_username', 'POST', 'string');
$download_version                   = $_GETVAR->get('download_version', 'POST', 'string');
$error                              = 0;
$error_message                      = '';
$fileupload                         = $_GETVAR->get('fileupload', 'FILES', 'array');
$image                              = '';
$imageupload                        = $_GETVAR->get('uploadimage', 'FILES', 'array');
$title                              = $_GETVAR->get('title', 'POST', 'string');
$download_url                       = $_GETVAR->get('download_url', 'POST', 'string');

$fileuploadresult                   = array();
$imageuploadresult                  = array();
$filelinkresult                     = array();

if($download_author_website == 'http://') {$download_author_website = '';}
if (!empty($fileupload['tmp_name'])) {
    $download_url = '';
    $uploaddir          = $db->sql_ufetchrow("SELECT `uploaddir`,`title`  FROM `". _DOWNLOADS_CATEGORIES_TABLE ."` WHERE `cid`='".$cat."'");
    $fileuploadresult   = DownloadsUpload($fileupload, $uploaddir['uploaddir'], $type='file');
    $download_filename  = $uploaddir['uploaddir'].'/'.$fileuploadresult['name'];
    $download_name      = @basename($download_filename);
    if ($fileuploadresult['error'] != 0){
        $error  = 1;
    } else {
        $download_size      = $fileuploadresult['size'];
        $download_mimetype  = $fileuploadresult['type'];
        $download_type      = 2;
        $historysize        = $download_size;
    }
}

if(!empty($imageupload['name'])){
    $imageuploadresult  = DownloadsUpload($imageupload, $uploaddir['uploaddir'], $type='image');
    if ($imageuploadresult['error'] != 0){
        $error  = 2;
    } else {
    $image              = $uploaddir['uploaddir'].'/images/'.$imageuploadresult['name'];
    }
}

if (!empty($download_url)) {
    DownloadsCutDirectorySlashesStart($download_url, 0);
    DownloadsCutDirectorySlashesEnd($download_url, 0);
    $uploaddir          = $db->sql_ufetchrow("SELECT `uploaddir`,`title`  FROM `". _DOWNLOADS_CATEGORIES_TABLE ."` WHERE `cid`='".$cat."'");
    $filelinkresult     = DownloadsLinkCheck($download_url);
    $download_filename  = $download_url;
    $download_name      = @basename($download_url);
    if ($filelinkresult['error'] != 0){
        $error  = 3;
    } else {
        $download_size      = $filelinkresult['size'];
        $download_mimetype  = $filelinkresult['type'];
        $download_type      = ($filelinkresult['remote'] ? 1 : 3);
        $historysize        = ($filelinkresult['remote'] ? 0 : $download_size);
    }
}

if ($error == 0){
    $result = $db->sql_uquery("INSERT INTO `"._DOWNLOADS_DOWNLOADS_TABLE."` (`did`,     `cid`,      `sid`,  `title`,        `image`,        `url`,      `description`,      `date`,             `date_validated`,   `name`,                     `email`,                `submitter`,                `download_author`,      `download_author_website`,      `download_author_email`,        `download_version`,         `download_filename`,        `download_name`,        `download_active`,      `download_type`,        `download_mimetype`,        `download_groups`,                          `download_groups_see`,                  `download_mintime`,     `download_countmintime`,        `download_countmax`,            `download_size`,        `download_license`,         `download_torrent` )
                                                                    VALUES  (NULL,      '".$cat."', '0',    '".$title."',   '".$image."', '".$download_url."', '".$description."', '".$actualtime."',  '".$actualtime."',  '".$download_username."',   '".$download_email."',  '".$download_username."',   '".$download_author."', '".$download_author_website."', '".$download_author_email."',   '".$download_version."',    '".$download_filename."',   '".$download_name."',   '".$download_active."', '".$download_type."', '".$download_mimetype."',   '".$download_restricted_group_download."',  '".$download_restricted_group_see."',   '".$download_intime."', '".$download_totalmeantime."',  '".$download_totaldownload."',  '".$download_size."',   '".$download_license."',    '".$download_torrent."' )");
    $db->sql_uquery("INSERT INTO `"._DOWNLOADS_HISTORY_TABLE."` (`history_id`,  `download_time`,    `did`,              `user_id`,                                          `type`, `status`,   `cid`,      `size`)
                                                    VALUES      (NULL,          '".$actualtime."',  LAST_INSERT_ID(),   '".get_user_field('user_id', $download_username, true)."',  '".$download_type."',      9,          '".$cat."', '".$historysize."' )");
    $status     = '<br /><strong>';
    $status    .= $lang_new[$module_name]['TITLE'];
    $status    .= ':</strong> '.$title;
    $status    .= '<br /><br /><strong>';
    $status    .= $lang_new[$module_name]['CATEGORY'];
    $status    .= ':</strong> '.$uploaddir['title'];
    if ($description){
        $status .= '<br /><br /><strong>';
        $status .= $lang_new[$module_name]['DESCRIPTION'];
        $status .= ':</strong> <br />'.$description;
    }

    if ($download_version){
        $status .= '<br /><br /><strong>';
        $status .= $lang_new[$module_name]['DOWNLOAD_VERSION'];
        $status .= ':</strong> '.$download_version;
    }
    if ($download_type == 2) {
        $status    .= '<br /><br /><strong>';
        $status    .= $lang_new[$module_name]['EXTENSIONS_TYPE1'];
        $status    .= ':</strong> '.$fileuploadresult['name'];
    }
    if ($download_type == 3) {
        $status    .= '<br /><br /><strong>';
        $status    .= $lang_new[$module_name]['EXTENSIONS_TYPE1'];
        $status    .= ':</strong> '.$download_url;
    }
    if (!empty($imageuploadresult['name'])){
        $status .= '<br /><br /><strong>';
        $status .= $lang_new[$module_name]['EXTENSIONS_TYPE3'];
        $status .= ':</strong> '.$imageuploadresult['name'];
    }
    if ($download_torrent){
        $status .= '<br /><br /><strong>';
        $status .= 'Torrent:</strong> '.$download_torrent;
    }
    $status    .= '<br /><br /><strong>';
    $status    .= $lang_new[$module_name]['EDITORIAL_BY'];
    $status    .= ':</strong> '.$download_username;
    $status    .= '<br /><br /><br /><strong>';
    $status    .= $lang_new[$module_name]['MESSAGE_DOWNLOAD_ADDED'].'</strong>';
    $alerts     = 'done';
} else {
    if ($error == 1){
        $status = "<br />File: ".$fileuploadresult['error_msg']." (".$fileuploadresult['error'].")<br />";
        $alerts = 'error';
    } elseif ($error == 2){
        $status = "<br />Image: ".$imageuploadresult['error_msg']." (".$imageuploadresult['error'].")<br />";
        $alerts = 'error';
    } elseif ($error == 3){
        $status = "<br />URL: ".$filelinkresult['error_msg']." (".$filelinkresult['error'].")<br />";
        $alerts = 'error';
    } else {
        $status = "<br />URL: ".$filelinkresult['error_msg']." (".$filelinkresult['error'].")<br />";
        $alerts = 'error';
    }
}

if ($error == 0) {
    echo"<script type='text/javascript'>
    window.onload = load;
    function load(){
        Sexy.$alerts('$status', {onComplete: function(returnvalue) {if (returnvalue) {window.location.href= 'admin.php?op=DownloadsModSelect';}}});
        return false;
    }
    </script>";
} else {
    echo"<script type='text/javascript'>
    window.onload = load;
    function load(){
        Sexy.$alerts('$status', {onComplete: function(returnvalue) {if (returnvalue) {window.location.href= 'admin.php?op=AddNewDownload';}}});
        return false;
    }
    </script>";
}
include_once(NUKE_BASE_DIR.'footer.php');
?>