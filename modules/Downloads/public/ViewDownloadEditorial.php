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
$did = intval(trim($did));
$result = $db->sql_query("SELECT `adminid`, `editorialtimestamp`, `editorialtext`, `editorialtitle` FROM `"._DOWNLOADS_EDITORIALS_TABLE."` WHERE `downloadid` = '$did'");
$recordexist = $db->sql_numrows($result);
$ttitle = htmlentities($ttitle);
$transfertitle = preg_replace ('#_#', ' ', $ttitle);
$displaytitle = $transfertitle;
DownloadsHeading();
OpenTable();
echo "<center><span class=\"option\"><strong>".$lang_new[$module_name]['DOWNLOAD_PROFILE'].": ".htmlentities($displaytitle)."</strong></span></center><br />";
DownloadsInfoMenu($did, $ttitle);
if ($recordexist > 0 ) {
    while($row = $db->sql_fetchrow($result)) {
        $adminid = UsernameColor($row['adminid']);
        $editorialtext = set_smilies(decode_bbcode(stripslashes($row['editorialtext']), 1, true));
        $editorialtitle = stripslashes(check_html($row['editorialtitle'], "nohtml"));
        $formatted_date = formatTimeStamp($row['editorialtimestamp']);
        echo "<br /><br />";
        OpenTable2();
        echo "<center><span class=\"option\"><strong>'$editorialtitle'</strong></span></center>";
        echo "<center><span class=\"tiny\">".$lang_new[$module_name]['EDITORIAL_BY']." $adminid - $formatted_date</span></center><br /><br />";
        echo $editorialtext;
        CloseTable2();
        }
} else {
    echo "<br /><br /><center><span class=\"option\"><strong>".$lang_new[$module_name]['WARN_EDITORIAL_NOT_FOUND']."</strong></span></center>";
}
echo "<br /><br /><center>";
DownloadsFooter($did,$ttitle);
echo "</center>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>