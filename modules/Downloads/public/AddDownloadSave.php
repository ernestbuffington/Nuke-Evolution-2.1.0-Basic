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

if (!defined('MODULE_FILE') || !defined('DOWNLOADS_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

DownloadsHeading();

$actualtime                 = time();
$alerts                     = 'done';
$title                      = check_words($_GETVAR->get('title', '_POST', 'string', ''));
$cat                        = $_GETVAR->get('cat', '_POST', 'int', 0);
$uploadimage                = $_GETVAR->get('uploadimage', '_FILES', 'array');
$uploadfile                 = $_GETVAR->get('uploadfile', '_FILES', 'array');
$description                = check_words($_GETVAR->get('description', '_POST', 'string', ''));
$download_author            = check_words($_GETVAR->get('download_author', '_POST', 'string', ''));
$download_author_email      = check_words($_GETVAR->get('download_author_email', '_POST', 'string', ''));
$download_author_website    = check_words($_GETVAR->get('download_author_website', '_POST', 'string', ''));
$download_version           = check_words($_GETVAR->get('download_version', '_POST', 'string', ''));
$download_license           = $_GETVAR->get('download_license', '_POST', 'int');
$download_email             = $_GETVAR->get('download_email', '_POST', 'string');
$download_username          = $_GETVAR->get('download_username', '_POST', 'string');
$download_torrent           = check_words($_GETVAR->get('download_torrent', '_POST', 'string'));
$submitter                  = $userinfo['username'];
$error_message              = '';
$download_type              = 0;
$image                      = '';
$download_url               = $_GETVAR->get('download_url', 'POST', 'string');

$fileuploadresult       = array();
$imageuploadresult      = array();
$filelinkresult         = array();
$uploaddir              = $db->sql_ufetchrow("SELECT `uploaddir`,`title`  FROM `". _DOWNLOADS_CATEGORIES_TABLE ."` WHERE `cid`='".$cat."'");

($download_author_website == 'http://' ? '' : $download_author_website);

if (!empty($uploadfile['tmp_name'])) {
    $download_url = '';
    $fileuploadresult   = DownloadsUpload($uploadfile, $uploaddir['uploaddir'], 'file');
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

if(!empty($uploadimage['name'])){
    $imageuploadresult  = DownloadsUpload($uploadimage, $uploaddir['uploaddir'], 'image');
    if ($imageuploadresult['error'] != 0){
        $error  = 2;
    } else {
        $image  = $uploaddir['uploaddir'].'/images/'.$imageuploadresult['name'];
    }
}

if (!empty($download_url)) {
    DownloadsCutDirectorySlashesStart($download_url, 0);
    DownloadsCutDirectorySlashesEnd($download_url, 0);
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
    $db->sql_uquery("INSERT INTO `"._DOWNLOADS_NEWDOWNLOADS_TABLE."` (`did`, `cid` , `sid` , `title` , `image`, `url`, `description` , `date`, `name` , `email` , `submitter`, `download_author`, `download_author_website`, `download_author_email`, `download_version`, `download_filename`, `download_name`, `download_size`, `download_license`, `download_type`, `download_mimetype`, `download_active`, `download_torrent`)
                  VALUES (NULL, '".$cat."', '0', '".$title."', '".$image."', '', '".$description."', '".$actualtime."', '".$download_username."', '".$download_email."', '".$submitter."', '".$download_author."', '".$download_author_website."', '".$download_author_email."', '".$download_version."', '".$download_filename."', '".$download_name."', '".$download_size."', '".$download_license."', '".$download_type."', '".$download_mimetype."', '0', '".$download_torrent."')");
    $db->sql_uquery("INSERT INTO `"._DOWNLOADS_HISTORY_TABLE."` (`history_id`,  `download_time`,    `did`,              `user_id`,                                          `type`, `status`,   `cid`,      `size`)
                                                    VALUES      (NULL,          '".$actualtime."',  LAST_INSERT_ID(),   '".get_user_field('user_id', $download_username, true)."',  '".$download_type."',      9,          '".$cat."', '".$historysize."' )");
    global $cache;
    $cache->delete('numwaitd', 'submissions');
    if (!empty($download_email)) {
        global $nukeurl, $sitename;
        $subject = $lang_new[$module_name]['MAIL_SITENAME'].EVO_SERVER_SITENAME;
        $message = $lang_new[$module_name]['MAIL_HELLO']."&nbsp;".($userinfo['name'] == '' ? $download_username : $userinfo['name']).",\n\n";
        $message .= $lang_new[$module_name]['MAIL_APPROVE_MESSAGE']."\n\n";
        $message .= $lang_new[$module_name]['TITLE'].":".$title."\n\n";
        if($description){$message .= $lang_new[$module_name]['DESCRIPTION'].":\n".$description."\n\n";}else{$message .="\n\n";}
        $message .= $lang_new[$module_name]['MAIL_THANKYOU']."\n\n".EVO_SERVER_SITENAME."\n".$lang_new[$module_name]['MAIL_SIGNATURE'];
        $to      = $download_email.', '.$download_username;
        evo_mail($to, $subject, $message);
    }
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
    $status    .= $lang_new[$module_name]['MESSAGE_DOWNLOAD_ADDED'].'</strong><br /><br />';
    $status    .= (!empty($download_email) ? $lang_new[$module_name]['MESSAGE_DOWNLOAD_SUBMITTED_EMAIL'] : $lang_new[$module_name]['MESSAGE_DOWNLOAD_SUBMITTED_NOEMAIL']);
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
        Sexy.".$alerts."('".$status."', {onComplete: function(returnvalue) {if (returnvalue) {window.location.href= 'modules.php?name=Downloads';}}});
        return false;
    }
    </script>";
} else {
    echo"<script type='text/javascript'>
    window.onload = load;
    function load(){
        Sexy.".$alerts."('".$status."', {onComplete: function(returnvalue) {if (returnvalue) {window.location.href= 'modules.php?name=Downloads&amp;op=AddDownload';}}});
        return false;
    }
    </script>";
}
include_once(NUKE_BASE_DIR.'footer.php');

?>