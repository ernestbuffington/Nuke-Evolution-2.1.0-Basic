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

DownloadsHeader();

OpenTable();

echo "<span class='option'><strong>".$lang_new[$module_name]['ADMIN_VALIDATION_LIST']."</strong></span>";
echo "<h3></h3>";

$result = $db->sql_query("SELECT * FROM `"._DOWNLOADS_NEWDOWNLOADS_TABLE."` ORDER BY `date` DESC");
$totalvalidatedownloads = $db->sql_numrows($result);

if ($totalvalidatedownloads == 0 ) {
    echo "<center>".$lang_new[$module_name]['WARN_DOWNLOAD_NOT_FOUND'] . "</center><br />";
} else {
    echo "<table width='100%' border='0' align='center'>";
    $colorswitch = $ThemeInfo['bgcolor2'];
    echo "<tr bgcolor='".$ThemeInfo['bgcolor2']."'>";
    echo "<td width='30%' align='left' style='border:solid white 1px'><strong>".$lang_new[$module_name]['TITLE']."</strong></td>";
    echo "<td width='25%' align='left' style='border:solid white 1px'><strong>".$lang_new[$module_name]['DOWNLOAD_SUBMITTER']."</strong></td>";
    echo "<td width='25%' align='left' style='border:solid white 1px'><strong>".$lang_new[$module_name]['DOWNLOAD_SUBMIT_DATE']."</strong></td>";
    echo "<td width='10%' align='center' style='border:solid white 1px'><strong>".$lang_new[$module_name]['EDIT']."</strong></td>";
    echo "<td width='10%' align='center' style='border:solid white 1px'><strong>".$lang_new[$module_name]['DELETE']."</strong></td>";
    echo "</tr>";
    
    while($row = $db->sql_fetchrow($result)) {
        echo "<tr><td colspan='5'><table width='100%' style='border:solid white 1px'><tr>";
        $did        = intval($row['did']);
        $submitter  = $row['submitter'];
        $title      = stripslashes($row['title']);
        $date       = formatTimestamp($row['date']);
        
        echo "<td width='30%' bgcolor='".$colorswitch."' align='left'>".$title."</td>";
        echo "<td width='25%' bgcolor='".$colorswitch."' align='left'>".$submitter."</td>";
        echo "<td width='25%' bgcolor='".$colorswitch."' align='left'>".$date."</td>";
        echo "<td width='10%' bgcolor='".$colorswitch."' align='center'><a href='".$admin_file.".php?op=DownloadsValidateEditDownloads&amp;did=$did'><font color='green'><b>X</b></font></a></td>";
        echo "<td width='10%' bgcolor='".$colorswitch."' align='center'><a href='".$admin_file.".php?op=DownloadsDelete&amp;did=$did&amp;is_validate=1'><font color='red'><b>X</b></font></a></td>";
        echo "</tr></table></td></tr>";
        
        if ($colorswitch == $ThemeInfo['bgcolor2']) {
            $colorswitch = $ThemeInfo['bgcolor1'];
        } else {
            $colorswitch = $ThemeInfo['bgcolor2'];
        }
    }
    $db->sql_freeresult($result);
    echo "</table>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>