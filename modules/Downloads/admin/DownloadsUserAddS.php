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


$result = $db->sql_query("SELECT COUNT(`user_id`) AS `numrows` FROM `"._DOWNLOADS_USERS_TABLE."` WHERE `user_id`='$userid'");
if ($result['numrows'] > 0) {
    DownloadsHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        ."<em>$title</em><br />"
        ."<strong>" . $lang_new[$module_name]['ERROR_USER_EXISTS'] . "</strong><br />"
        .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}
$db->sql_freeresult($result);

$maxallowed = DownloadsMaxAllowedFileSize();
$maxwanted = $maxfilesize * ( ($sizedefinefile == 0) ? 1 : (($sizedefinefile == 1) ? 1024 : 1048576));

if ( $maxwanted > $maxallowed )  {
        DownloadsHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<em>$title</em><br />"
            ."<strong>" . $lang_new[$module_name]['ERROR_UPLOAD_FILESIZE'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
}

$maxbandwidth = $maxbandwidth * ( ($sizedefinebandwidth == 0) ? 1 : (($sizedefinebandwidth == 1) ? 1024 : 1048576));
if ( $maxwanted > $maxbandwidth )  {
        DownloadsHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<em>$title</em><br />"
            ."<strong>" . $lang_new[$module_name]['ERROR_USER_BANDWIDTH'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
}

$userdescription = (empty($userdescription) ? '' : FixQuotes($userdescription));
$mintime = intval($mintime);
$meantime = intval($meantime);
$sizedefinebandwidth = intval($sizedefinebandwidth);
$sizedefinefile = intval($sizedefinefile);
$canupload = intval($canupload);
$candownload = intval($candownload);
$useractive = intval($useractive);
$userid = intval($userid);

if ($mode == 'DownloadsUserAdd') {
        $db->sql_query("INSERT INTO `"._DOWNLOADS_USERS_TABLE."` (`user_id`, `user_description`, `user_allowed_upload`, `user_allowed_download`, `user_mintime`, `user_filesize`, `user_definefilesize`, `user_bandwidth`, `user_definebandwidth`, `user_meantime`, `user_active` )
                        VALUES ('$userid', '$userdescription', '$canupload', '$candownload', '$mintime', '$maxfilesize', '$sizedefinefile', '$maxbandwidth', '$sizedefinebandwidth', '$meantime', '$useractive')");
        redirect($admin_file.".php?op=Downloads");
} elseif ($mode == 'DownloadsUserMod' ) {
        $db->sql_query("UPDATE `"._DOWNLOADS_USERS_TABLE."` set
        `user_description` = '$userdescription',
        `user_allowed_upload` = '$canupload',
        `user_allowed_download` = '$candownload',
        `user_mintime` = '$mintime',
        `user_filesize` = '$maxfilesize',
        `user_definefilesize` = '$sizedefinefile',
        `user_bandwidth` = '$maxbandwidth',
        `user_definebandwidth` = '$sizedefinebandwidth',
        `user_meantime` = '$meantime',
        `user_active` = '$useractive'
        WHERE `user_id` = '$userid'");
        redirect($admin_file.".php?op=DownloadsUserList");
}

?>