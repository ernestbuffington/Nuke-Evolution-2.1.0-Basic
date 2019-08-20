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

if (!defined('MODULE_FILE') || !defined('REVIEW_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');

if (is_user()) {
    ReviewHeading();
    OpenTable();
    $ratinguser = $userinfo['username'];
    $result = $db->sql_query("SELECT `rid`, `title` FROM `"._REVIEWS_MODREQUEST_TABLE."` WHERE `rid` = $rid");
    $numresults = $db->sql_numrows($result);
    $row1 = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    if ($numresults > 0) {
        $title = stripslashes(check_html($row1['title'], "nohtml"));
        echo "<center><span class=\"option\"><strong>".$lang_new[$module_name]['REPORT_BROKEN']."</strong></span></center><br />";
        echo "<center><span class=\"option\"><< <em>".$title."</em> >></span></center><br /><br />";
        echo "<center>".$lang_new[$module_name]['WELCOME_USERNAME']." </center><br />";
        echo "<center>".$lang_new[$module_name]['MESSAGE_REVIEW_BROKEN_EXISTS'] . "</center><br />";
        echo "<center>".$lang_new[$module_name]['SUBMIT_GOBACK'] ."</center><br />";

    } else {
        $row = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `title`, `url`, `description`, `image` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`='$rid'"));
        $cid = intval($row['cid']);
        $title = stripslashes(check_html($row['title'], "nohtml"));
        $image = stripslashes($row['image']);
        $url = stripslashes($row['url']);
        $description = stripslashes($row['description']);
        echo "<center><span class=\"option\"><strong>".$lang_new[$module_name]['REPORT_BROKEN']."</strong></span></center><br />";
        echo "<center><span class=\"option\"><< <em>".$title."</em> >></span></center><br /><br />";
        echo "<form action=\"modules.php?name=$module_name\" method=\"post\"><center>";
        echo "<input type=\"hidden\" name=\"rid\" value=\"$rid\" />";
        echo "<input type=\"hidden\" name=\"cid\" value=\"$cid\" />";
        echo "<input type=\"hidden\" name=\"title\" value=\"$title\" />";
        echo "<input type=\"hidden\" name=\"image\" value=\"$image\" />";
        echo "<input type=\"hidden\" name=\"url\" value=\"$url\" />";
        echo "<input type=\"hidden\" name=\"description\" value=\"$description\" />";
        echo "<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\" />";
        echo "<center>".$lang_new[$module_name]['WELCOME_USERNAME']." </center><br />";
        echo $lang_new[$module_name]['MESSAGE_REVIEW_BROKEN_ADDED']."<br /><br />";
        if ($reviewsconfig['securitycheck'] == 1) {
            echo "<table align=\"center\">".security_code(1,'small', 1)."</table>\n";
        }
        echo "<input type=\"hidden\" name=\"op\" value=\"brokenreviewS\" /><input type=\"submit\" value=\"".$lang_new[$module_name]['DO_REPORT_BROKEN']."\" /></center></form>";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect("modules.php?name=$module_name");
}

?>