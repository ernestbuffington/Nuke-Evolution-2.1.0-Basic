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

$modify_added                               = $_GETVAR->get('modify_added', 'POST', 'string');
$modify_broken                              = ',`download_broken`=0';
$modify_description                         = $_GETVAR->get('modify_description', 'POST', 'string');
$modify_did                                 = $_GETVAR->get('modify_did', 'POST', 'int');
$modify_download_active                     = $_GETVAR->get('modify_download_active', 'POST', 'int');
$modify_download_author                     = $_GETVAR->get('modify_download_author', 'POST', 'string');
$modify_download_author_email               = $_GETVAR->get('modify_download_author_email', 'POST', 'string');
$modify_download_author_website             = $_GETVAR->get('modify_download_author_website', 'POST', 'string');
$modify_download_in_time                    = $_GETVAR->get('modify_download_in_time', 'POST', 'int');
$modify_download_license                    = $_GETVAR->get('modify_download_license', 'POST', 'int');
$modify_download_name                       = $_GETVAR->get('modify_download_name', 'POST', 'string');
$modify_download_restricted_group_download  = $_GETVAR->get('modify_download_restricted_group_download', 'POST', 'int');
$modify_download_restricted_group_see       = $_GETVAR->get('modify_download_restricted_group_see', 'POST', 'int');
$modify_download_torrent                    = $_GETVAR->get('modify_download_torrent', 'POST', 'string');
$modify_download_type                       = $_GETVAR->get('modify_download_type', 'POST', 'string');
$modify_download_version                    = $_GETVAR->get('modify_download_version', 'POST', 'string');
$modify_filename                            = $_GETVAR->get('modify_filename', 'POST', 'string');
$modify_first_cat                           = $_GETVAR->get('modify_first_cid', 'POST', 'int');
$modify_image_name                          = $_GETVAR->get('modify_image_name', 'POST', 'string');
$modify_image_upload                        = $_GETVAR->get('modify_image_upload', 'FILES', 'array');
$modify_modified                            = '';
$modify_title                               = $_GETVAR->get('modify_title', 'POST', 'string');
$modify_total_downloads                     = $_GETVAR->get('modify_total_downloads', 'POST', 'int');
$modify_total_downloads_meantime            = $_GETVAR->get('modify_total_downloads_meantime', 'POST', 'int');
$modify_uploadfile                          = $_GETVAR->get('modify_uploadfile', 'FILES', 'array');
$modify_second_cat                          = $_GETVAR->get('modify_cat', 'POST', 'int');
$modify_show_updated                        = $_GETVAR->get('modify_show_updated', 'POST', 'int');
$modify_show_updated                        = ($modify_show_updated == 1 ? time() : 0);
$modify_submitter                           = $_GETVAR->get('modify_download_submitter', 'POST', 'string');
$modify_submitter_email                     = $_GETVAR->get('modify_download_submitter_email', 'POST', 'string');
$modify_validation                          = $_GETVAR->get('modify_validation', 'POST', 'int');

$file                                       = array();
$error                                      = '0';
$error_msg                                  = '';
$done                                       = '';

if ($modify_image_name){
    $modify_image_filename  = explode('/', $modify_image_name);
    $slash                  = count($modify_image_filename);
    $slash                  = $slash -1;
    $modify_image_filename  = $modify_image_filename[$slash];
}

function evo_rename_file($from, $name1, $to, $name2){
    if (file_exists($to)) {
        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 5; $x = rand(0,$z), $s .= $a{$x}, $i++);
        $name2  = $s.'_'.$name2;
        $to     = explode('/', $to, -1);
        $to     = implode('/',$to);
        $to     = $to.'/'.$name2;
    }
    rename($from, $to);
    if (!file_exists($to)){
        $error          = 11;
        $file['error']  = 1;
    } else {
        $file['error']      = 0;
        $file['filename']   = $to;
        $file['upload']     = $to;
    }
    return $file;
}

function evo_rename_image($from, $name1, $to, $name2){
    if (file_exists($to)) {
        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 5; $x = rand(0,$z), $s .= $a{$x}, $i++);
        $name2  = $s.'_'.$name2;
        $to     = explode('/', $to, -1);
        $to     = implode('/',$to);
        $to     = $to.'/'.$name2;
    }
    rename($from, $to);
    if (!file_exists($to)){
        $file['error']          = 2;
    } else {
        $file['error']          = 0;
        $file['image']          = $to;
        $file['image_upload']   = $to;
    }
    return $file;
}

DownloadsHeader();
$modify_file_size = @filesize($modify_filename);
if ($modify_first_cat != $modify_second_cat){
    $result = $db->sql_ufetchrow("SELECT uploaddir, title, downloadimagedir FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`='".$modify_second_cat."'");
    $rename_file = evo_rename_file($modify_filename, '', $result['uploaddir'].'/'.$modify_download_name, $modify_download_name);
    if($modify_image_name){$rename_image = evo_rename_image($modify_image_name, '', $result['downloadimagedir'].'/'.$modify_image_filename, $modify_image_filename);}
} else {
    $rename_file['filename'] = $modify_filename;
    $rename_image['image'] = $modify_image_name;
}

if ($modify_uploadfile['tmp_name']){
    $result = $db->sql_ufetchrow("SELECT uploaddir FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`='".$modify_second_cat."'");
    $modify_file_size       = $modify_uploadfile['size'];
    $modify_download_type   = $modify_uploadfile['type'];
    $modify_file_name       = $modify_uploadfile['name'];
    if (@is_uploaded_file($modify_uploadfile['tmp_name']) && $modify_uploadfile['error'] == 0) {
        $done = 01;
        if (@DownloadsIsAllowedExtension($modify_uploadfile) != 0){
            $done = 02;
            if (!@empty($result['uploaddir'])){
                $done = 03;
                if (@file_exists($result['uploaddir'].'/'.$modify_file_name)) {
                    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 5; $x = rand(0,$z), $s .= $a{$x}, $i++);
                    $modify_file_name = $s.'_'.$modify_file_name;
                    $done = 04;
                }
                if (@move_uploaded_file($modify_uploadfile['tmp_name'], $result['uploaddir'].'/'.$modify_file_name)) {
                    $rename_file['filename'] = $result['uploaddir'].'/'.$modify_file_name;
                    $modify_download_name = $modify_file_name;
                    $done = 05;
                    if(file_exists($modify_filename)){
                        $done = 06;
                        if (@unlink($modify_filename)){
                            $done = 07;
                        } else {
                            $error = 5000;
                            $error_msg = 'The old file could not be deleted.';
                        }
                    } else {
                        if (file_exists($rename_file['upload'])){
                            $done = 06;
                            if (@unlink($rename_file['upload'])){
                                $done = 07;
                            } else {
                                $error = 5000;
                                $error_msg = 'The old file could not be deleted.';
                            }
                        }
                    }
                } else {
                    $error = 5001;
                    $error_msg = 'Uploaded file not moved to destination folder.';
                }
            } else {
                $error = 4999;
                $error_msg = 'There is no information about the destination folder';
            }
        } else {
            $error = 5002;
            $error_msg = 'The uploaded file extension is not allowed in our server.';
        }
    } else {
        $error = 5003;
        $error_msg = 'The file could not be uploaded to an Temporary folder.';
    }
}


if ($modify_image_upload['tmp_name']){
    $result = $db->sql_ufetchrow("SELECT downloadimagedir FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`='".$modify_second_cat."'");
    $modify_image_type                  = $modify_image_upload['type'];
    $modify_image_filename              = $modify_image_upload['name'];
    $modify_file_parts                  = @pathinfo($modify_image_upload['name']);
    $modify_image_upload['extension']   = $modify_file_parts['extension'];
    if (@is_uploaded_file($modify_image_upload['tmp_name']) && $modify_image_upload['error'] == 0) {
        $done = 11;
        if ($modify_image_upload['extension'] == ('jpg' || 'gif' || 'png' || 'bmp')){
            $done = 12;
            if (!@empty($result['downloadimagedir'])){
                $done = 13;
                if (@file_exists($result['downloadimagedir'].'/'.$modify_image_upload['name'])) {
                    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 5; $x = rand(0,$z), $s .= $a{$x}, $i++);
                    $modify_image_filename = $s.'_'.$modify_image_upload['name'];
                    $done = 14;
                }
                if (@move_uploaded_file($modify_image_upload['tmp_name'], $result['downloadimagedir'].'/'.$modify_image_filename)) {
                    $rename_image['image'] = $result['downloadimagedir'].'/'.$modify_image_filename;
                    $done = 15;
                    if(file_exists($modify_image_name)){
                        $done = 16;
                        if (@unlink($modify_image_name)){
                            $done = 17;
                        } else {
                            $error = 5000;
                            $error_msg = 'The old file could not be deleted.';
                        }
                    } else {
                        if (file_exists($rename_image['image_upload'])){
                            $done = 16;
                            if (@unlink($rename_image['image_upload'])){
                                $done = 17;
                            } else {
                                $error = 6000;
                                $error_msg = 'The old file could not be deleted.';
                            }
                        }
                    }
                } else {
                    $error = 6001;
                    $error_msg = 'Uploaded file not moved to destination folder.';
                }
            } else {
                $error = 5999;
                $error_msg = 'There is no information about the destination folder';
            }
        } else {
            $error = 6002;
            $error_msg = 'The uploaded file extension is none of the following jpg || gif || png || bmp.';
        }
    } else {
        $error = 6003;
        $error_msg = 'The file could not be uploaded to an Temporary folder.';
    }
}

if($modify_download_author_website == 'http://'){$modify_download_author_website = '';}

if ($modify_validation == '1'){
    if ($error != 0){
        echo 'Wrong';
    } else {
        $result = $db->sql_uquery("INSERT INTO `"._DOWNLOADS_DOWNLOADS_TABLE."` 
                            (`did`, `cid`, `sid`, `title`, `image`, `url`, `description`, `date`, `date_validated`, `name`, `email`, `submitter`, `download_author`, `download_author_website`, `download_author_email`,
                             `download_version`, `download_filename`, `download_name`, `download_active`, `download_type`, `download_mimetype`, `download_groups`, `download_groups_see`, `download_mintime`, `download_countmintime`,
                             `download_countmax`, `download_size`, `download_license`, `download_torrent`)
                             VALUES  (NULL, '".$modify_second_cat."', '0', '".$modify_title."', '".$rename_image['image']."', '', '".$modify_description."', '".$modify_added."', '".time()."', '".$userinfo['username']."', '".$modify_submitter_email."', '".$modify_submitter."', '".$modify_download_author."', '".$modify_download_author_website."',  '".$modify_download_author_email."',
                             '".$modify_download_version."', '".$rename_file['filename']."', '".$modify_download_name."', '".$modify_download_active."', '2', '".$modify_download_type."', '".$modify_download_restricted_group_download."', '".$modify_download_restricted_group_see."', '".$modify_download_in_time."', '".$modify_total_downloads_meantime."',
                             '".$modify_total_downloads."', '".$modify_file_size."', '".$download_license."', '".$modify_download_torrent."')");
        $result = $db->sql_uquery("DELETE FROM `"._DOWNLOADS_NEWDOWNLOADS_TABLE."` WHERE `did`='$modify_did' ");

        global $cache;
        $cache->delete('numwaitd', 'submissions');
        
        if (!empty($modify_submitter_email) && $modify_download_active == 1) {
            global $nukeurl, $sitename;
            $subject = $lang_new[$module_name]['MAIL_SITENAME'].EVO_SERVER_SITENAME;
            $message = $lang_new[$module_name]['MAIL_HELLO']."&nbsp;".$modify_submitter.",\n\n";
            $message .= $lang_new[$module_name]['MAIL_APPROVED_MESSAGE']."\n\n";
            $message .= $lang_new[$module_name]['TITLE'].": ".$modify_title."\n\n";
            if($modify_description){$message .= $lang_new[$module_name]['DESCRIPTION'].":\n".$modify_description."\n\n";}else{$message .= "\n\n";}
            $message .= $lang_new[$module_name]['MAIL_BROWSEURL']." ".NUKE_HREF_BASE_DIR."modules.php?name=Downloads&op=showdownload&did=".$modify_did."\n\n";
            $message .= $lang_new[$module_name]['MAIL_THANKYOU']."\n\n".EVO_SERVER_SITENAME."\n ".$lang_new[$module_name]['MAIL_SIGNATURE'];
            $to      = $modify_submitter_email.', '.$modify_submitter;
            evo_mail($to, $subject, $message);
        }
        redirect($admin_file.".php?op=DownloadsModSelect&amp;modify_did=".$modify_did."&amp;status=2");
        
        $status    = '<br /><br /><b>';
        $status    .= $lang_new[$module_name]['EDITORIAL_BY'];
        $status    .= ':</b> '.$modify_submitter;
        $status    .= '<br /><br /><br /><b>';
        $status    .= $lang_new[$module_name]['MESSAGE_DOWNLOAD_ADDED_VALID'].'</b>';
    }
}else{
    $db->sql_query("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` set
    `cid`                       = '".$modify_second_cat."',
    `date_validated`            = '".time()."',
    `description`               = '".$modify_description."',
    `download_active`           = '".$modify_download_active."',
    `download_author`           = '".$modify_download_author."',
    `download_author_email`     = '".$modify_download_author_email."',
    `download_author_website`   = '".$modify_download_author_website."',
    `download_countmax`         = '".$modify_total_downloads."',
    `download_countmintime`     = '".$modify_total_downloads_meantime."',
    `download_filename`         = '".$rename_file['filename']."',
    `download_groups`           = '".$modify_download_restricted_group_download."',
    `download_groups_see`       = '".$modify_download_restricted_group_see."',
    `download_mimetype`         = '".$modify_download_type."',
    `download_mintime`          = '".$modify_download_in_time."',
    `download_license`          = '".$modify_download_license."',
    `download_name`             = '".$modify_download_name."',
    `download_size`             = '".$modify_file_size."',
    `download_torrent`          = '".$modify_download_torrent."',
    `download_version`          = '".$modify_download_version."',
    `email`                     = '".$userinfo['user_email']."' ,
    `image`                     = '".$rename_image['image']."',
    `last_modified_date`        = '".time()."',
    `last_modified_user`        = '".$userinfo['username']."',
    `name`                      = '".$userinfo['username']."',
    `sid`                       = '0',
    `show_update`               = '".$modify_show_updated."' ".$modify_broken." ".$modify_modified.",
    `title`                     = '".$modify_title."'
    WHERE `did`                 = '".$modify_did."'");
    
    redirect($admin_file.".php?op=DownloadsModSelect&amp;modify_did=".$modify_did."&amp;status=2");
}

include_once(NUKE_BASE_DIR.'footer.php');
// Please don't remove the next script - RTC4EVER
/*
                $lfile = @fopen($uploaddir['uploaddir'].'/images/'.$s.'_'.basename($image), "w");
                $ifile = $uploaddir['uploaddir'].'/images/'.$s.'_'.basename($image);

                $link = curl_init();
                curl_setopt($link, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($link, CURLOPT_URL, $image);
                curl_setopt($link, CURLOPT_HEADER, 0);
                curl_setopt($link, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2) Gecko/20070219 Firefox/2.0.0.2');
                curl_setopt($link, CURLOPT_BINARYTRANSFER, 1);
                $curl_file = curl_exec($link);
                @fwrite($lfile, $curl_file);
                @fclose($lfile);
                curl_close($link);

                $image = $ifile;

            $lfile = @fopen($uploaddir['uploaddir'].'/images/'.$s.'_'.basename($image), "w");
            $ifile = $uploaddir['uploaddir'].'/images/'.$s.'_'.basename($image);

            $link = curl_init();
            curl_setopt($link, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($link, CURLOPT_URL, $image);
            curl_setopt($link, CURLOPT_HEADER, 0);
            curl_setopt($link, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2) Gecko/20070219 Firefox/2.0.0.2');
            curl_setopt($link, CURLOPT_BINARYTRANSFER, 1);
            $curl_file = curl_exec($link);
            @fwrite($lfile, $curl_file);
            @fclose($lfile);
            curl_close($link);

            $image = $ifile;
*/
?>