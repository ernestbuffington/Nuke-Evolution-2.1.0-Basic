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

if (!defined('MODULE_FILE') || !defined('WEBLINK_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');
LinksHeading();
OpenTable();
if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$weblinksconfig['toplinks'];
if (empty($show)) {
    $show=$weblinksconfig['toplinks'];
}
$totalmostpoplinks = $db->sql_numrows($db->sql_query("SELECT `lid` FROM `"._WEBLINKS_LINKS_TABLE."`"));
$percentrigger = 0;
if (!empty($ratenum) && !empty($ratetype)) {
    $ratenum = intval($ratenum);
    $ratetype = htmlentities($ratetype);
    $mostpoplinks = ($totalmostpoplinks > $ratenum) ? $ratenum : $totalmostpoplinks;
    if ($ratetype == 'percent') {
        $percentrigger = 1;
        $mostpoplinks = round(($ratenum * $totalmostpoplinks) / 100);
        $mostpoplinks = ($totalmostpoplinks > $mostpoplinks) ? $mostpoplinks : $totalmostpoplinks;
    }
}

if(empty($mostpoplinks)) {
    $mostpoplinks = $weblinksconfig['toplinks'];
    $ratenum = $weblinksconfig['toplinks'];
}
$totalselectedlinks = $mostpoplinks;
OpenTable2();
echo "<table border=\"0\" width=\"100%\">\n";
echo "<tr><td align=\"center\">";
if ($percentrigger == 1) {
    echo "<span class=\"option\"><strong>".$lang_new[$module_name]['MOST_POPULAR']." $ratenum% (".$lang_new[$module_name]['OF']." $totalmostpoplinks ".$lang_new[$module_name]['LINKS'].")</strong></span>";
} else {
    echo "<span class=\"option\"><strong>".$lang_new[$module_name]['MOST_POPULAR']." $ratenum (".$lang_new[$module_name]['OF']." $totalmostpoplinks ".$lang_new[$module_name]['LINKS'].")</strong></span>";
}
echo "</td></tr><tr><td></td></tr>";
echo "<tr><td align=\"center\">".$lang_new[$module_name]['SHOW_MOSTPOPULAR'].":  ";
echo "[ <a href=\"modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=10&amp;ratetype=num\">10</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=25&amp;ratetype=num\">25</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=50&amp;ratetype=num\">50</a> | "
    ."<a href=\"modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]";
echo "</td></tr>";
echo "</table>\n";
CloseTable2();
echo "<br />";
$result3 = $db->sql_query("SELECT `lid`, `cid`, `sid`, `title`, `image`, `description`, `date`, `hits`, `linkratingsummary`, `totalvotes`, `totalcomments`, `name`, `url` FROM `"._WEBLINKS_LINKS_TABLE."` ORDER BY `hits` DESC LIMIT $min, ".$show);
while($row3 = $db->sql_fetchrow($result3)) {
    $lid = intval($row3['lid']);
    $cid = intval($row3['cid']);
    $sid = intval($row3['sid']);
    $title = set_smilies(decode_bbcode(stripslashes($row3['title']), 1, true));
    $image = stripslashes($row3['image']);
    $url = stripslashes($row3['url']);
    $name = $row3['name'];
    $description = evo_img_tag_to_resize(set_smilies(decode_bbcode(stripslashes($row3['description']), 1, true)));
    $time = $row3['date'];
    $hits = intval($row3['hits']);
    $linkratingsummary = intval($row3['linkratingsummary']);
    $totalvotes = intval($row3['totalvotes']);
    $totalcomments = $row3['totalcomments'];
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `cid`='$cid'"));
    $ctitle = $row2['title'];
    $parentid = intval($row2['parentid']);
    $ctitle = linksgetparent($parentid,$ctitle);
    echo "<fieldset><table width=\"100%\" border=\"0\" bgcolor=\"".$weblinksconfig['tablecolor1']."\">\n";
    echo "<tr>";
    echo "<td><a href=\"modules.php?name=$module_name&amp;op=linkvisit&amp;lid=$lid\" target=\"_blank\"><img src=\"".evo_image('link.png', $module_name)."\" border=\"0\" alt=\"\" />&nbsp;<strong>$title</strong></a>".newlinkgraphic($time).linkpopgraphic($hits);
    echo "</td>";
    if ($linkratingsummary != '0' || $linkratingsummary != '0.0') {
        echo "<td width=\"20%\" align=\"right\">";
        echo WeblinksDisplayScore($linkratingsummary);
        echo "</td>";
    } else {
        echo "<td width=\"20%\"></td>";
    }
    echo "</tr>\n";
    echo "<tr><td colspan=\"2\">".$lang_new[$module_name]['CATEGORY'].": <a href=\"modules.php?name=$module_name&amp;op=viewlink&amp;cid=$cid\"> $ctitle</a></td></tr>\n";
    echo "</table> ";
    echo "<table bgcolor=\"".$weblinksconfig['tablecolor2']."\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr>";
    if($image!='http://' && !empty($image) ){
        echo "<td valign=\"top\" width=\"".$weblinksconfig['image_width']."\" height=\"".$weblinksconfig['image_height']."\" ><a href=\"".$image."\" rel=\"lightbox\" title=\"".$title."\" rev=\"modules.php?name=$module_name&amp;op=linkvisit&amp;lid=$lid\" ><img src=\"$image\" width=\"".$weblinksconfig['image_width']."\" height=\"".$weblinksconfig['image_height']."\" border=\"0\" alt=\"\" title=\"".$lang_new[$module_name]['VISIT']."\" /></a></td>";
        echo "<td width=\"2%\"></td>";
        echo "<td align=\"left\" valign=\"top\" width=\"100%\"><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />$description </td>";
    }elseif ( $weblinksconfig['thumbnail_use'] && !empty($weblinksconfig['thumbnail_url']) ) {
        echo "<td valign=\"top\" width=\"".$weblinksconfig['image_width']."\" ><a href=\"".htmlentities($weblinksconfig['thumbnail_url'].$url, ENT_NOQUOTES)."\" rel=\"lightbox\" title=\"".$title."\" rev=\"modules.php?name=$module_name&amp;op=linkvisit&amp;lid=$lid\" ><img src=\"".$weblinksconfig['thumbnail_url'].$url."\" width=\"".$weblinksconfig['image_width']."\" height=\"".$weblinksconfig['image_height']."\"  border=\"0\" title=\"".$lang_new[$module_name]['VISIT']."\" alt=\"\" /></a></td>";
        echo "<td width=\"2%\"></td>";
        echo "<td align=\"left\" valign=\"top\" width=\"100%\"><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />$description </td>";
    }else{
        echo "<td valign=\"top\" width=\"".$weblinksconfig['image_width']."\" height=\"".$weblinksconfig['image_height']."\" ><a href=\"modules.php?name=$module_name&amp;op=linkvisit&amp;lid=$lid\" target=\"new\"><img src=\"".evo_image('blank.gif', $module_name)."\" width=\"".$weblinksconfig['image_width']."\" height=\"".$weblinksconfig['image_height']."\"  border=\"0\" alt=\"\" title=\"".$lang_new[$module_name]['VISIT']."\" /></a></td>";
        echo "<td width=\"2%\"></td>";
        echo "<td align=\"left\" valign=\"top\" width=\"100%\"><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />$description </td>";
    }
    echo "</tr></table>";
    echo "<table bgcolor=\"".$weblinksconfig['tablecolor1']."\" width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tr>";
    $datetime = formatTimeStamp($time);
    $transfertitle = str_replace (" ", "_", $title);
    echo "<td width=\"25%\" align=\"left\" height=\"20\"><img src=\"".evo_image('date.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" title=\"".$lang_new[$module_name]['DATE_WRITTEN']." $datetime ".$lang_new[$module_name]['BY']." $name\" alt=\"\" />&nbsp;$datetime </td>";
    echo "<td width=\"20%\"><img src=\"".evo_image('hits.png', $module_name)."\" width=\"16\" height=\"16\" border=\"0\" title=\"".$lang_new[$module_name]['HITS']." $hits\" alt=\"\" />&nbsp;<strong>$hits</strong></td>  ";
    $votestring = ($totalvotes == 1) ? $lang_new[$module_name]['VOTE'] : $lang_new[$module_name]['VOTES'];
    if ($totalvotes != 0) {
        echo "<td width=\"9%\"><a href=\"modules.php?name=$module_name&amp;op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$transfertitle\"><img src=\"".evo_image('details.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_SHOW_DETAILS']."\" alt=\"\" /></a></td>";
    } else {
        echo "<td width=\"9%\"></td>";
    }
    if ($userinfo['username'] != $name) {
        echo "<td width=\"10%\" align=\"center\"><a href=\"modules.php?name=$module_name&amp;op=ratelink&amp;lid=$lid&amp;ttitle=".$transfertitle."\"><img src=\"".evo_image('votein.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_RATE']."\" alt=\"\" /></a></td>";
    }
    if ($totalcomments != 0) {
        echo "<td width=\"9%\"><a href=\"modules.php?name=$module_name&amp;op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle\"><img src=\"".evo_image('comments.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['DO_SHOW_COMMENTS']."\" alt=\"\" />&nbsp;<strong>$totalcomments</strong></a></td>";
    } else {
        echo "<td width=\"9%\"></td>";
    }
    echo "<td width=\"9%\">".linkdetecteditorial($lid, $transfertitle)."</td>";
    if (is_user()) {
        echo "<td width=\"9%\" align=\"right\"><a href=\"modules.php?name=$module_name&amp;op=brokenlink&amp;lid=$lid\"><img src=\"".evo_image('alert.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['REPORT_BROKEN']."\" alt=\"\" /></a></td>";
    } else {
        echo "<td width=\"9%\"></td>";
    }
    if (is_mod_admin($module_name)) {
        echo "<td width=\"9%\" align=\"right\" ><a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\"><img src=\"".evo_image('editicon.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['EDIT']."\" alt=\"\" /></a></td>";
    } else {
        echo "<td width=\"9%\" align=\"right\" ><a href=\"modules.php?name=$module_name&amp;op=modifylinkrequest&amp;lid=$lid\"><img src=\"".evo_image('editicon.png', $module_name)."\" border=\"0\" width=\"16\" height=\"16\" title=\"".$lang_new[$module_name]['MODIFY_LINK_REQUEST']."\" alt=\"\" /></a></td>";
    }
    echo " </tr></table>";
    echo "</fieldset><br />";
}
$db->sql_freeresult($result3);
// Calculates how many pages exist. Which page one should be on, etc...
$linkpagesint = ($totalselectedlinks / $weblinksconfig['toplinks']);
$linkpageremainder = ($totalselectedlinks % $weblinksconfig['toplinks']);
if ($linkpageremainder != 0) {
    $linkpages = ceil($linkpagesint);
    if ($totalselectedlinks < $weblinksconfig['toplinks']) {
        $linkpageremainder = 0;
    }
} else {
    $linkpages = $linkpagesint;
}

// Page Numbering
if ($linkpages!=1 && $linkpages!=0) {
    echo "<center><br /><br />";
    $prev=$min-$weblinksconfig['toplinks'];
    if ($prev>=0) {
        echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=$ratenum&amp;ratetype=$ratetype&amp;min=$prev&amp;show=".$weblinksconfig['toplinks']."\">";
        echo "<img src='".evo_image('left.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_PREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }else{
        echo "<img src='".evo_image('noleft.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NOPREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }
    $counter = 1;
    $currentpage = ($max / $weblinksconfig['toplinks']);
    while ($counter<=$linkpages ) {
       $cpage = $counter;
       $mintemp = ($weblinksconfig['toplinks'] * $counter) - $weblinksconfig['toplinks'];
       $next = (($totalselectedlinks - $mintemp) > $weblinksconfig['toplinks']) ? $weblinksconfig['toplinks'] : ($totalselectedlinks - $mintemp);
       if ($counter == $currentpage) {
          echo "<strong>$counter</strong>&nbsp;";
        } else {
          echo "<a href=\"modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=$ratenum&amp;ratetype=$ratetype&amp;min=$mintemp&amp;show=$next\">$counter</a> ";
        }
        $counter++;
    }
    if ($max < $totalselectedlinks ) {
        echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=$ratenum&amp;ratetype=$ratetype&amp;min=$max&amp;show=$next\">";
        echo "<img src='".evo_image('right.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NEXT']."' alt='".$lang_new[$module_name]['PAGE_NEXT']."' border='0' /></a>";
    }else{
        echo "&nbsp;&nbsp;<img src='".evo_image('noright.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NONEXT']."' alt='".$lang_new[$module_name]['PAGE_NONEXT']."' border='0' /></a>";
    }
    echo "</center>";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>