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

if (empty($ok)) {
    DownloadsHeader();
    OpenTable();
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] . "</strong></span></center><br /><br />\n";
    echo "<br /><center><strong>" . $lang_new[$module_name]['WARN_COMMENT_DELETE_ALL'] ."</strong></center>";
    echo "<br />";
    echo "<center><a href=\"".$admin_file.".php?op=DownloadsCleanVotes&amp;ok=5\">" . $lang_new[$module_name]['SUBMIT_DOIT'] . "</a></center>";
    echo "<center>" . $lang_new[$module_name]['SUBMIT_GOBACK'] ."</center>";
    CloseTable();
} else {
    DownloadsHeader();
    OpenTable();
    $result = $db->sql_query("SELECT distinct `ratingdid` FROM `"._DOWNLOADS_VOTEDATA_TABLE."`");
    while ($row = $db->sql_fetchrow($result)) {
        $did = intval($row['ratingdid']);
        $voteresult = $db->sql_query("SELECT `rating`, `ratinguser`, `ratingcomments` FROM `"._DOWNLOADS_VOTEDATA_TABLE."` WHERE `ratingdid` = '$did'");
        $totalvotesDB = $db->sql_numrows($voteresult);
        include(NUKE_MODULES_DIR.$module_name.'/public/VoteInclude.php');
        $db->sql_query("UPDATE `"._DOWNLOADS_DOWNLOADS_TABLE."` SET `downloadratingsummary`='$finalrating', `totalvotes`='$totalvotesDB', `totalcomments`='$truecomments' WHERE `did` = '$did'");
      }
    $db->sql_freeresult($result);
    echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] . "</strong></span></center><br /><br />\n";
    echo "<br /><center><strong>" . $lang_new[$module_name]['MESSAGE_COMMENT_DELETE_ALL'] ."</strong></center>";
    echo "<br /><center><a href=\"".$admin_file.".php?op=Downloads\">" . $lang_new[$module_name]['OK'] . "</a></center>";
    CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');

?>