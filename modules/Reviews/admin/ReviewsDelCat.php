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


include_once(NUKE_BASE_DIR.'header.php');
$cid = intval($cid);
if($ok == 1) {
    if ($sub > 0) {
        $db->sql_query("DELETE FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid`='$cid'");
        $db->sql_query("DELETE FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$cid'");
    } else {
        $db->sql_query("DELETE FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$cid'");
        $result2 = $db->sql_query("SELECT `cid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `parentid`='$cid'");
        while ($row2 = $db->sql_fetchrow($result2)) {
            $cid2 = intval($row2['cid']);
            $db->sql_query("DELETE FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$cid2'");
        }
        $db->sql_query("DELETE FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `parentid`='$cid'");
        $db->sql_query("DELETE FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `cid`='$cid'");
    }
    redirect($admin_file.".php?op=Reviews");
} else {
    $result3 = $db->sql_query("SELECT `cid` FROM `"._REVIEWS_CATEGORIES_TABLE."` WHERE `parentid`='$cid'");
    $nbsubcat1 = $db->sql_numrows($result3);
    $nbsubcat = (empty($nbsubcat1)) ? 0 : $nbsubcat1;
    $nblink = 0;
    while ($row3 = $db->sql_fetchrow($result3)) {
        $cid2 = intval($row3['cid']);
        $nblink1 = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `cid`='$cid2'"));
        $nblink += ((empty($nblink1)) ? 0 : $nblink1);
    }
    reviewsHeader();
    OpenTable();
    echo "<center><strong>". $lang_new[$module_name]['DELETE'] ." ".$lang_new[$module_name]['CATEGORY']."</strong><br /><br />";
    echo $lang_new[$module_name]['THERE_ARE'] . " $nbsubcat " . $lang_new[$module_name]['CATEGORIESSUB'] . " " . $lang_new[$module_name]['ADMIN_CAT_ATTACHED'] . "<br />";
    echo $lang_new[$module_name]['THERE_ARE'] . " $nblink " . $lang_new[$module_name]['LINKS'] . " " . $lang_new[$module_name]['ADMIN_CAT_ATTACHED'] . "<br /><br />";
    echo "<strong>" . $lang_new[$module_name]['WARN_CAT_DELETE'] . "</strong><br /><br />";
    echo "</center>";
}
echo "<center>[ <a href=\"".$admin_file.".php?op=ReviewsDelCat&amp;cid=$cid&amp;sid=$sid&amp;sub=$sub&amp;ok=1\">" .$lang_new[$module_name]['SUBMIT_DOIT'] . "</a> | <a href=\"".$admin_file.".php?op=Reviews\">" . $lang_new[$module_name]['SUBMIT_RETURN'] . "</a> ]</center><br /><br />";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>