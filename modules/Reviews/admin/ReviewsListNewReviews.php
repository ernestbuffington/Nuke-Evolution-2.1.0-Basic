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

if (!defined('IN_REVIEWS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN REVIEWS ADMINISTRATION');
}

reviewsHeader();

OpenTable();
echo "<center><span class=\"option\"><strong>" . $lang_new[$module_name]['ADMIN_REVIEW_VALIDATE'] . "</strong></span></center><br /><br />\n";
$result = $db->sql_query("SELECT `rid`, `cid`, `sid`, `title`, `image`, `url`, `description`, `header`, `footer`, `body`, `signature`, `name`, `email`, `submitter`, `date` FROM `"._REVIEWS_NEWREVIEW_TABLE."`");
$totalnewreviews = $db->sql_numrows($result);
if ($totalnewreviews == 0 ) {
    echo "<center>". $lang_new[$module_name]['WARN_REVIEW_NOT_FOUND'] ."</center><br /><br />\n";
} else {
    echo "<table width=\"100%\" border=\"0\">\n";
    $colorswitch = $bgcolor2;
    echo "<tr>";
    echo "<td width=\"31%\" align=\"center\"><strong>" . $lang_new[$module_name]['TITLE'] . "</strong></td>";
    echo "<td width=\"25%\" align=\"center\"><strong>" . $lang_new[$module_name]['REVIEW_URL'] . "</strong></td>";
    echo "<td width=\"15%\" align=\"center\"><strong>" . $lang_new[$module_name]['REVIEW_SUBMITTER'] . "</strong></td>";
    echo "<td width=\"15%\" align=\"center\"><strong>" . $lang_new[$module_name]['REVIEW_SUBMIT_DATE'] . "</strong></td>";
    echo "<td width=\"7%\" align=\"center\"><strong>" . $lang_new[$module_name]['EDIT'] . "</strong></td>";
    echo "<td width=\"7%\" align=\"center\"><strong>" . $lang_new[$module_name]['DELETE'] . "</strong></td>";
    echo "</tr>";
    while($row = $db->sql_fetchrow($result)) {
        $title = stripslashes($row['title']);
        $url = $row['url'];
        $owner = $row['submitter'];
        $subdate = (($row['date'] > 0 ) ? formatTimestamp($row['date']) : 0);
        $rid = $row['rid'];
        echo "<tr>";
        echo "<td bgcolor=\"$colorswitch\">$title</td>";
        echo "<td bgcolor=\"$colorswitch\">$url</td>";
        echo "<td bgcolor=\"$colorswitch\">$owner</td>";
        echo "<td bgcolor=\"$colorswitch\">$subdate</td>";
        echo "<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=ReviewAdminValidation&amp;rid=$rid\">X</a></center></td>";
        echo "<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=ReviewsDelNew&amp;rid=$rid\">X</a></center></td>";
        echo "</tr>";
        if ($colorswitch == $bgcolor2) {
            $colorswitch = $bgcolor1;
        } else {
            $colorswitch = $bgcolor2;
        }
    }
    $db->sql_freeresult($result);
    echo "</table>";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>