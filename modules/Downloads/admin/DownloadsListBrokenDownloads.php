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

global $db, $admin_file, $module_name, $lang_new, $ThemeInfo;

DownloadsHeader();

OpenTable();
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_BROKEN_DOWNLOAD'] . "</strong></span></center><br /><br />\n";
$result = $db->sql_query("SELECT `did`, `download_modifier`, `title`, `image`, `url`, `submitter`, `email` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `download_broken`='1' ORDER BY `did`");
$totalbrokendownloads = $db->sql_numrows($result);
echo "<center>". $lang_new[$module_name]['INFO_IGNORE'] . "</center>";
echo "<center>". $lang_new[$module_name]['INFO_DELETE'] . "</center><br />";
if ($totalbrokendownloads == 0 ) {
    echo "<center>" . $lang_new[$module_name]['WARN_DOWNLOAD_NOT_FOUND'] . "</center><br />";
} else {
    echo "<table width=\"100%\" border=\"0\">\n";
    $colorswitch = $ThemeInfo['bgcolor2'];
    echo "<tr>";
    echo "<td width=\"10%\" align=\"center\"></td>";
    echo "<td width=\"39%\" align=\"center\"><strong>" . $lang_new[$module_name]['TITLE'] . "</strong></td>";
    echo "<td width=\"15%\" align=\"center\"><strong>" . $lang_new[$module_name]['DOWNLOAD_SUBMITTER'] . "</strong></td>";
    echo "<td width=\"15%\" align=\"center\"><strong>" . $lang_new[$module_name]['DOWNLOAD_OWNER'] . "</strong></td>";
    echo "<td width=\"7%\" align=\"center\"><strong>" . $lang_new[$module_name]['EDIT'] . "</strong></td>";
    echo "<td width=\"7%\" align=\"center\"><strong>" . $lang_new[$module_name]['IGNORE'] . "</strong></td>";
    echo "<td width=\"7%\" align=\"center\"><strong>" . $lang_new[$module_name]['DELETE'] . "</strong></td>";
    echo "</tr>";
    while($row = $db->sql_fetchrow($result)) {
        $did = intval($row['did']);
        $modifysubmitter = $row['download_modifier'];
        if ( !empty($modifysubmitter ) ) {
            $email = get_user_field('user_email', $modifysubmitter, true);
        }
        $title = stripslashes($row['title']);
        $image = $row['image'];
        $url = $row['url'];
        $owner = $row['submitter'];
        $owneremail = $row['email'];
        echo "<tr>";
        echo "<td colspan='2' bgcolor=\"$colorswitch\"><a href=\"index.php?url=$url\">";
        if ($image !='http://' && !empty($image) ){
            echo "<img src=\"$image\">$title</a></td>";
        } else {
            echo $title."</a></td>";
        }
        if (empty($email)) {
            echo "<td bgcolor=\"$colorswitch\">$modifysubmitter</td>";
        } else {
            echo "<td bgcolor=\"$colorswitch\"><a href=\"mailto:$email\">$modifysubmitter</a></td>";
        }
        if (empty($owneremail)) {
            echo "<td bgcolor=\"$colorswitch\">$owner</td>";
        } else {
            echo "<td bgcolor=\"$colorswitch\"><a href=\"mailto:$owneremail\">$owner</a></td>";
        }
        echo "<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=DownloadsEditBrokenDownload&amp;did=$did\">X</a></center></td>";
        echo "<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=DownloadsIgnoreBrokenDownloads&amp;did=$did\">X</a></center></td>";
        echo "<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=DownloadsDelBrokenDownloads&amp;did=$did\">X</a></center></td>";
        echo "</tr>";
        if ($colorswitch == $ThemeInfo['bgcolor2']) {
            $colorswitch = $ThemeInfo['bgcolor1'];
        } else {
            $colorswitch = $ThemeInfo['bgcolor2'];
        }
    }
    echo "</table>";
}
$db->sql_freeresult($result);
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>