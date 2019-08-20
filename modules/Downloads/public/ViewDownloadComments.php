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

include_once(NUKE_BASE_DIR.'header.php');
DownloadsHeading();
$did = intval(trim($did));
echo "<br />";
$result = $db->sql_query("SELECT `ratinguser`, `rating`, `ratingcomments`, `ratingtimestamp` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratingdid` = '$did' AND `ratingcomments` != '' ORDER BY `ratingtimestamp` DESC");
$totalcomments = $db->sql_numrows($result);
$ttitle = stripslashes($ttitle);
$transfertitle = preg_replace ('#_#', ' ', $ttitle);
$displaytitle = $transfertitle;
OpenTable();
echo "<center><span class=\"option\"><strong>".$lang_new[$module_name]['DOWNLOAD_PROFILE'].": ".$displaytitle."</strong></span><br /><br />";
DownloadsInfoMenu($did, $ttitle);
echo "<br /><br /><br />".$lang_new[$module_name]['TOTAL']." $totalcomments ".$lang_new[$module_name]['COMMENTS']."</center><br />"
    ."<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"450\"><tr><td>";
$x=0;
while($row = $db->sql_fetchrow($result)) {
    $ratinguser = $row['ratinguser'];
    $rating = intval($row['rating']);
    $ratingcomments = set_smilies(decode_bbcode(stripslashes($row['ratingcomments']), 1, true));
    $ratingtimestamp = $row['ratingtimestamp'];
    $formatted_date = formatTimeStamp($ratingtimestamp);
    /* Individual user information */
    $result2 = $db->sql_query("SELECT `rating` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratinguser` = '$ratinguser'");
    $usertotalcomments = $db->sql_numrows($result2);
    $useravgrating = 0;
    while($row2 = $db->sql_fetchrow($result2)) {
        $rating2 = intval($row2['rating']);
    }
    $db->sql_freeresult($result2);
    $useravgrating = $useravgrating + $rating2;
    $useravgrating = $useravgrating / $usertotalcomments;
    $useravgrating = number_format($useravgrating, 1);
    echo "<tr><td bgcolor='".$ThemeInfo['bgcolor2']."'>"
        ."<span class=\"content\"><strong> ".$lang_new[$module_name]['USER'].": </strong><a href=\"".EVO_SERVER_URL."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$ratinguser\">$ratinguser</a></span>"
        ."</td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."'>"
        ."<span class=\"content\"><strong>".$lang_new[$module_name]['RATING'].": </strong>$rating</span>"
        ."</td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align=\"right\">"
        ."<span class=\"content\">$formatted_date</span>"
        ."</td>"
        ."</tr>"
        ."<tr>"
        ."<td valign=\"top\">"
        ."<span class=\"tiny\">".$lang_new[$module_name]['RATED_USER_AVERAGE'].": $useravgrating</span>"
        ."</td>"
        ."<td valign=\"top\" colspan=\"2\">"
        ."<span class=\"tiny\">".$lang_new[$module_name]['RATED_NUMBERS'].": $usertotalcomments</span>"
        ."</td>"
        ."</tr>"
        ."<tr>"
        ."<td colspan=\"3\">"
        ."<span class=\"content\">";
    if (is_mod_admin($module_name)) {
        echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;did=$did\"><img src=\"".evo_image('comment_edit.png', $module_name)."\" border=\"0\" alt=\"\" title=\"".$lang_new[$module_name]['EDIT']."\" /></a>";
    }
    echo " $ratingcomments</span>"
        ."<br /><br /><br /></td></tr>";
    $x++;
}
$db->sql_freeresult($result);
echo "</td></tr></table><br /><br /><center>";
DownloadsFooter($did,$ttitle);
echo "</center>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>