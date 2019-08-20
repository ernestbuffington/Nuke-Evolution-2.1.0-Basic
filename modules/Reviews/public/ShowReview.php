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
ReviewHeading();

$reviewid = intval($rid);
$forward = intval($forward);
$mypage = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `rid`=".$reviewid));
$mycid = intval($mypage['cid']);
$mytitle = set_smilies(decode_bbcode(stripslashes(check_html($mypage['title'], "nohtml")), 1));
$mydescription = set_smilies(decode_bbcode(stripslashes($mypage['description']), 1, true));
$mydescription = evo_img_tag_to_resize($mydescription);
$mypage_header = set_smilies(decode_bbcode(stripslashes($mypage['header']), 1, true));
$mypage_header = evo_img_tag_to_resize($mypage_header);
$mytext = set_smilies(decode_bbcode(stripslashes($mypage['body']), 1, true));
$mytext = evo_img_tag_to_resize($mytext);
$mypage_footer = set_smilies(decode_bbcode(stripslashes($mypage['footer']), 1, true));
$mypage_footer = evo_img_tag_to_resize($mypage_footer);
$mysignature = set_smilies(decode_bbcode(stripslashes($mypage['signature']), 1, true));
$mysignature = evo_img_tag_to_resize($mysignature);
$mydate = $mypage['date'];
$mycounter = intval($mypage['hits']);
$mysubmitter = "<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$mypage['submitter']."\">".UsernameColor($mypage['submitter'])."</a>";
OpenTable();
echo reviewinfomenu($reviewid, stripslashes($mypage['title']));
CloseTable();
OpenTable();
if ($forward != 1)
{
  $db->sql_query("UPDATE `"._REVIEWS_REVIEWS_TABLE."` SET `hits`=`hits`+1 WHERE rid='$reviewid'");
}
$date = formatTimestamp($mydate);
echo "<center><strong><span class=\"title\">$mytitle</span><br />";
echo "<span class=\"content\">$mydescription</span></strong></center><br />";
echo "<table width=\"100%\"><tr><td width=\"50%\" align=\"left\">";
echo "<span style=\"font-size: xx-small;\">" .$lang_new[$module_name]['COPYRIGHT']."<br />".EVO_SERVER_SITENAME."<br /> ".$lang_new[$module_name]['COPYRIGHT2']."</span></td>";
echo "<td width=\"50%\" align=\"right\">";
echo "<span style=\"font-size: xx-small;\">" .$lang_new[$module_name]['REVIEW_SUBMIT_DATE'].":<br />$date<br />".$lang_new[$module_name]['BY'].": $mysubmitter<br />($mycounter ".$lang_new[$module_name]['HITS'].")</span>";
echo "</td></tr></table><hr />";
$contentpages = explode( "<!--pagebreak-->", $mytext );
$pageno = count($contentpages);
if ( empty($page) || $page < 1 ) { $page = 1; }
if ( $page > $pageno ) { $page = $pageno; }
$arrayelement = (int)$page;
$arrayelement --;
if($page <= 1) {
    $previous_page = '';
} else {
    $previous_pagenumber = $page - 1;
    $previous_page = "<a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;rid=$reviewid&amp;page=$previous_pagenumber&amp;forward=1\"><img src=\"images/left.gif\" border=\"0\" alt=\"".$lang_new[$module_name]['PAGE_PREVIOUS']."\" title=\"".$lang_new[$module_name]['PAGE_PREVIOUS']."\" /> ".$lang_new[$module_name]['PAGE_PREVIOUS']."</a>";
}
if($page >= $pageno) {
    $next_page = "";
} else {
    $next_pagenumber = $page + 1;
    if ($page != 1) {
        $next_page = '';
    }
    $next_page = "<a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;rid=$reviewid&amp;page=$next_pagenumber&amp;forward=1\">".$lang_new[$module_name]['PAGE_NEXT']." <img src=\"images/right.gif\" border=\"0\" alt=\"".$lang_new[$module_name]['PAGE_NEXT']."\" title=\"".$lang_new[$module_name]['PAGE_NEXT']."\" /></a>";
}
echo "<table width=\"100%\"><tr><td align=\"left\" width=\"33%\">$previous_page</td><td align=\"center\" width=\"34%\">" . $lang_new[$module_name]['PAGE']. ": $page/$pageno</td><td align=\"right\" width=\"33%\">$next_page</td></tr></table><hr /><br />";
if ($page == 1) {
    echo "<p align=\"justify\">".nl2br($mypage_header)."</p><br />";
}
echo "<p align=\"justify\">$contentpages[$arrayelement]</p>";
if ($page == $pageno) {
    echo "<br /><p align=\"justify\">".nl2br($mypage_footer)."</p><br /><br />";
    echo "<p align=\"right\">".nl2br($mysignature)."</p>";
}
echo "<center>".$lang_new[$module_name]['SUBMIT_GOBACK']."</center>";
CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');

?>