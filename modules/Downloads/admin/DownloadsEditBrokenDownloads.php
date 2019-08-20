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

// BROKEN DOWNLOAD EDIT
$broken_title                       = $_GETVAR->get('broken_title', '_REQUEST', 'string');
$broken_cat                         = $_GETVAR->get('broken_cat', '_REQUEST', 'int');
$broken_image                       = $_GETVAR->get('broken_image', '_REQUEST', 'string');
$broken_imageupload                 = $_GETVAR->get('broken_imageupload', '_FILES', 'array');
$broken_uploadfile                  = $_GETVAR->get('broken_uploadfile', '_FILES', 'array');
$broken_description                 = $_GETVAR->get('broken_description', '_REQUEST', 'string');
$broken_download_author             = $_GETVAR->get('broken_download_author', '_REQUEST', 'string');
$broken_download_email              = $_GETVAR->get('broken_download_email', '_REQUEST', 'string');
$broken_download_website            = $_GETVAR->get('broken_download_website', '_REQUEST', 'string');
$broken_download_version            = $_GETVAR->get('broken_download_version', '_REQUEST');
$broken_download_submitter          = $_GETVAR->get('broken_download_submitter', '_REQUEST', 'string');
$broken_last_modified_user          = $_GETVAR->get('broken_last_modified_user', '_REQUEST', 'string');
$broken_last_modified_date          = $_GETVAR->get('broken_last_modified_date', '_REQUEST');
$broken_did                         = $_GETVAR->get('broken_did', '_REQUEST', 'int');
$broken_download_torrent            = $_GETVAR->get('broken_torrent', '_REQUEST', 'string');
$op                                 = $_GETVAR->get('op', '_REQUEST', 'string');
$show_updated                       = $_GETVAR->get('broken_show_updated', '_REQUEST', 'int', 0);
$broken_download_submitter_email    = $_GETVAR->get('broken_download_submitter_email', '_REQUEST', 'string');
$row            = $db->sql_ufetchrow("SELECT * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `did`='".$broken_did."'");
$downloadtype   = $row['download_type'];
$uploaddir      = $db->sql_ufetchrow("SELECT `uploaddir` FROM `". _DOWNLOADS_CATEGORIES_TABLE ."` WHERE `cid`='".$broken_cat."'");
$error                      = 0;
$actualtime                 = time();
$show_updated               = ($show_updated == 1 ? time() : 0);
$broken_download_size       = stripslashes($row['download_size']);
$broken_download_filename   = stripslashes($row['download_filename']);
$broken                     = ',`download_broken`=0';
$modified                   = ',`download_modified`=1';
$download_name              = stripslashes($row['download_name']);
$broken_download_mimetype   = stripslashes($row['download_mimetype']);
$broken_uploadresult        = array();


if (isset($broken_uploadfile['tmp_name']) && !empty($broken_uploadfile['tmp_name'])){
    $broken_uploadresult        = BrokenDownloadsUpload($broken_uploadfile, $uploaddir['uploaddir']);
    @unlink($broken_download_filename);
    $broken_download_filename   = NUKE_BASE_DIR.$uploaddir['uploaddir'].'/'.$broken_uploadresult['name'];
    $download_name              = @basename($broken_download_filename);
    $broken_download_size       = $broken_uploadresult['size'];
    $broken_download_mimetype   = $broken_uploadresult['type'];
}

if ($error == 1 ) {
    $error_text = "<center><span class=\"option\">";
    $error_text .= $error_message;
    $error_text .= '<br /><br />'.$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
    $error_text .= "</span></center>";
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$error_text);
} else {

    $db->sql_query("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` set `sid` = '0', `title` = '".$broken_title."' ,
        `image` = '".$broken_image."', `description` = '".$broken_description."', `download_name` = '".$download_name."',
        `date_validated` = '".$actualtime."', `download_author` = '".$broken_download_author."',
        `download_author_website` = '".$broken_download_website."', `download_author_email` = '".$broken_download_email."',
        `download_mimetype` = '".$broken_download_mimetype."', `download_version` = '".$broken_download_version."',
        `download_filename` = '".$broken_download_filename."', `download_active` = '".$broken_download_active."',
        `last_modified_date` = '".$actualtime."', `last_modified_user`= '".$broken_last_modified_user."',
        `show_update` = '".$show_updated."' ".$broken." ".$modified.", `download_size` = '".$broken_download_size."', `download_torrent` = '".$broken_download_torrent."'
        WHERE `did` = '".$broken_did."'");

    $cache->delete('numbrokend', 'submissions');

    DownloadsHeader();

    OpenTable();
    echo "<center><span class='option'>";
    echo  $lang_new[$module_name]['MESSAGE_DOWNLOAD_ADDED'] . "<br />";
    echo "[ <a href='".$admin_file.".php?op=DownloadsModSelect'>" . $lang_new[$module_name]['SUBMIT_RETURN'] . "</a> ]<br /><br />";
    echo "</span></center>";
    CloseTable();

    include_once(NUKE_BASE_DIR.'footer.php');
}

?>