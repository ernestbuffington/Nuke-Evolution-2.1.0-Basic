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


$result = $db->sql_query("SELECT COUNT(`group_id`) AS `numrows` FROM `"._DOWNLOADS_GROUPS_TABLE."` WHERE `group_id`='$groupid'");
if ($result['numrows'] > 0) {
    DownloadsHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        ."<em>$title</em><br />"
        ."<strong>" . $lang_new[$module_name]['ERROR_GROUP_EXISTS'] . "</strong><br />"
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
            ."<strong>" . $lang_new[$module_name]['ERROR_GROUP_BANDWIDTH'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
}

$groupdescription = (empty($groupdescription) ? '' : FixQuotes($groupdescription));
$mintime = intval($mintime);
$meantime = intval($meantime);
$sizedefinebandwidth = intval($sizedefinebandwidth);
$sizedefinefile = intval($sizedefinefile);
$canupload = intval($canupload);
$candownload = intval($candownload);
$groupactive = intval($groupactive);
$groupid = intval($groupid);

if ($mode == 'DownloadsGroupAdd') {
        $db->sql_query("INSERT INTO `"._DOWNLOADS_GROUPS_TABLE."` (`group_id`, `group_description`, `group_allowed_upload`, `group_allowed_download`, `group_mintime`, `group_filesize`, `group_definefilesize`, `group_bandwidth`, `group_definebandwidth`, `group_meantime`, `group_active` )
                        VALUES ('$groupid', '$groupdescription', '$canupload', '$candownload', '$mintime', '$maxfilesize', '$sizedefinefile', '$maxbandwidth', '$sizedefinebandwidth', '$meantime', '$groupactive')");
        redirect($admin_file.".php?op=Downloads");
} elseif ($mode == 'DownloadsGroupMod' ) {
        $db->sql_query("UPDATE `"._DOWNLOADS_GROUPS_TABLE."` set
        `group_description` = '$groupdescription',
        `group_allowed_upload` = '$canupload',
        `group_allowed_download` = '$candownload',
        `group_mintime` = '$mintime',
        `group_filesize` = '$maxfilesize',
        `group_definefilesize` = '$sizedefinefile',
        `group_bandwidth` = '$maxbandwidth',
        `group_definebandwidth` = '$sizedefinebandwidth',
        `group_meantime` = '$meantime',
        `group_active` = '$groupactive'
        WHERE `group_id` = '$groupid'");
        redirect($admin_file.".php?op=DownloadsGroupList");
}

?>