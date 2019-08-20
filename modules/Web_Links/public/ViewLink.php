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

if (!empty($orderby)) {
    $orderby = htmlspecialchars($orderby);
}
include_once(NUKE_BASE_DIR.'header.php');
if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$weblinksconfig['links_perpage'];
if(!empty($orderby)) {
    $orderby = linkconvertorderbyin($orderby);
} else {
    $orderby = "title ASC";
}
if (!empty($show)) {
    $weblinksconfig['links_perpage'] = $show;
} else {
    $show=$weblinksconfig['links_perpage'];
}
LinksHeading();
LinksLegend();
OpenTable();
$cid        = intval($cid);
$row1       = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `cid`='".$cid."'");
if (empty($row1)) {
    redirect('modules.php?name='.$module_name);
}
$title      = stripslashes(check_html($row1['title'], "nohtml"));
$parentid   = intval($row1['parentid']);
$legendid   = $cid;
$title      = getparentlink($parentid,$title);
$title      = "<a href='modules.php?name=".$module_name."'>".$lang_new[$module_name]['MODULE_NAME']."</a>/".$title;
echo "<center><span class='option'><strong>".$lang_new[$module_name]['CATEGORY'].": <em>$title</em></strong></span></center><br />";
echo "<hr noshade='noshade' size='1' />";
$result2 = $db->sql_query("SELECT `cid`, `title`, `image`, `cdescription` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `parentid`='".$cid."' ORDER BY `title`");
$numcats = $db->sql_numrows($result2);
$count = 0;
$count1 = 0;
if ( $numcats > 0 ) {
    while (list($tcid, $ttitle, $tcimage, $tcdescription) = $db->sql_fetchrow($result2) ) {
        if ($count == 0) {
            $leftside[$count1]['links'] = $db->sql_numrows($db->sql_query("SELECT `lid` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `cid`='".$tcid."'"));
            $leftside[$count1]['cid'] = $tcid;
            $leftside[$count1]['title'] = $ttitle;
            $leftside[$count1]['image'] = $tcimage;
            $leftside[$count1]['cdescription'] = evo_img_tag_to_resize($tcdescription);
            $count++;
        } else {
            $rightside[$count1]['links'] = $db->sql_numrows($db->sql_query("SELECT `lid` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `cid`='".$tcid."'"));
            $rightside[$count1]['cid'] = $tcid;
            $rightside[$count1]['title'] = $ttitle;
            $rightside[$count1]['image'] = $tcimage;
            $rightside[$count1]['cdescription'] = evo_img_tag_to_resize($tcdescription);
            $count = 0;
        }
        $count1++;
    }
    $db->sql_freeresult($result2);
    $tablerows = ($numcats / 2) + ($numcats % 2);
    $count = 0;
    echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>\n";
    echo "<tr>\n";
    echo "<td width='50%'>\n";
    if (!empty($leftside)) {
          foreach( $leftside as $tableleft)  {
                    $cid = $tableleft['cid'];
                    $title = $tableleft['title'];
                    $image = $tableleft['image'];
                    $cdescription = $tableleft['cdescription'];
                    $countlinks = $tableleft['links'];
                    echo "<fieldset><table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
                    echo "<tr><td width='100%' bgcolor='".$weblinksconfig['tablecolor1']."'>";
                    if ( !empty($image) ) {
                        echo " <img src='".$image."' width='16' height='16' alt='' />&nbsp;";
                    } else {
                        echo " <img src='".evo_image('dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
                    }
                    echo "<a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$cid."'>". set_smilies(decode_bbcode(stripslashes($title), 1, true)) ." ($countlinks)</a>".categorynewlinkgraphic($cid) ."</td></tr>\n";
                    echo "<tr><td width='100%' >". set_smilies(decode_bbcode(stripslashes($cdescription), 1, true)) ."</td></tr>\n";
                    // Lookup for SubCategories
                    $result3 = $db->sql_query("SELECT `cid`, `title`, `image` from `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `parentid`='".$cid."' ORDER BY `title`");
                    $numsubcats = $db->sql_numrows($result3);
                    if ( $numsubcats > 0 ) {
                          echo "<tr><td>\n";
                          echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
                          while($row3 = $db->sql_fetchrow($result3)) {
                                echo "<tr><td width='100%'>&nbsp;&nbsp;";
                                if ( !empty($row3['image']) ) {
                                    echo " <img src='".$row3['image']."' width='16' height='16'>&nbsp;";
                                } else {
                                    echo " <img src='".evo_image('sub-dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
                                }
                                echo "<a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$row3['cid']."'>";
                                echo stripslashes($row3['title']) ."</a></td></tr>\n";
                          }
                          $db->sql_freeresult($result3);
                          echo "</td></tr>\n";
                          echo "</table>\n";
                    }
                    echo "</table></fieldset>\n";
          }
    }
    echo "</td>\n";
    echo "<td width='50%'>\n";
    if (!empty($rightside)) {
          foreach( $rightside as $tableright)  {
                    $cid = $tableright['cid'];
                    $title = $tableright['title'];
                    $image = $tableright['image'];
                    $cdescription = $tableright['cdescription'];
                    $countlinks = $tableright['links'];
                    echo "<fieldset><table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
                    if ( !empty($image) ) {
                        echo " <img src='".$image."' width='16' height='16' alt='' />&nbsp;";
                    } else {
                        echo " <img src='".evo_image('dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
                    }
                    echo "<a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$cid."'>". set_smilies(decode_bbcode(stripslashes($title), 1, true)) ." ($countlinks)".categorynewlinkgraphic($cid) ."</td></tr>\n";
                    echo "<tr><td width='100%' >". set_smilies(decode_bbcode(stripslashes($cdescription), 1, true)) ."</td></tr>\n";
                    // Lookup for SubCategories
                    $result3 = $db->sql_query("SELECT `cid`, `title`, `image`  from `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `parentid`='".$cid."' ORDER BY `title`");
                    $numsubcats = $db->sql_numrows($result3);
                    if ( $numsubcats > 0 ) {
                          echo "<tr><td>\n";
                          echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
                          while($row3 = $db->sql_fetchrow($result3)) {
                                echo "<tr><td width='100%'>&nbsp;&nbsp;";
                                if ( !empty($row3['image']) ) {
                                    echo " <img src='".$row3['image']."' width='16' height='16' alt='' />&nbsp;";
                                } else {
                                    echo " <img src='".evo_image('sub-dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
                                }
                                echo "<a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$row3['cid']."'>";
                                echo stripslashes($row3['title']) ."</a></td></tr>\n";
                          }
                          $db->sql_freeresult($result3);
                          echo "</td></tr>\n";
                          echo "</table>\n";
                    }
                    echo "</table></fieldset>\n";
          }
    }
    echo "</td>\n";
    echo "</tr></table>\n";

} else {
    echo "<center><span class='option'><em>".$lang_new[$module_name]['INFO_NO_SUBCAT']."</em></span></center><br />\n";
}
echo "<hr noshade='noshade' size='1' />\n";
$orderbyTrans = linkconvertorderbytrans($orderby);
LinkOrderLegend($orderbyTrans, $legendid);

if(!is_numeric($min)){
    $min=0;
}

$result4 = $db->sql_query("SELECT `lid`, `title`, `image`, `description`, `date`, `hits`, `linkratingsummary`, `totalvotes`, `totalcomments`, `name`, `url` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `cid`='".$legendid."' ORDER BY ".$orderby." LIMIT ".$min.", ". $weblinksconfig['links_perpage']);
$fullcountresult = $db->sql_query("SELECT `lid` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `cid`='".$legendid."'");
$totalselectedlinks = $db->sql_numrows($fullcountresult);

echo "<table width='100%' cellspacing='0' cellpadding='10' border='0'><tr><td>\n";
while($row4 = $db->sql_fetchrow($result4)) {
    $lid            = intval($row4['lid']);
    $transfertitle  = str_replace (" ", "_", $row4['title']);
    $title          = set_smilies(decode_bbcode($row4['title'], 1, true));
    $description    = evo_img_tag_to_resize(set_smilies(decode_bbcode($row4['description'], 1, true)));
    $image          = $row4['image'];
    $url            = $row4['url'];
    $name           = $row4['name'];
    $time           = $row4['date'];
    $datetime       = formatTimeStamp($time);
    $hits           = intval($row4['hits']);
    $submitter      = UsernameColor($row4['name']);
    $linkratingsummary = $row4['linkratingsummary'];
    $totalvotes     = intval($row4['totalvotes']);
    $totalcomments  = intval($row4['totalcomments']);
    $linkratingsummary = number_format($linkratingsummary, $weblinksconfig['mainvotedecimal']);
    echo "<fieldset><table width='100%' border='0' bgcolor='".$weblinksconfig['tablecolor1']."'>\n";
    echo "<tr>";
    echo "<td><a href='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=".$lid."' target='_blank'><img src='".evo_image('link.png', $module_name)."' border='0' alt='' />&nbsp;<strong>$title</strong></a>".newlinkgraphic($time).linkpopgraphic($hits);
    echo "</td>";
    if ($linkratingsummary != '0' || $linkratingsummary != '0.0') {
        echo "<td width='20%' align='right'>";
        echo WeblinksDisplayScore($linkratingsummary);
        echo "</td>";
    } else {
        echo "<td width='20%'></td>";
    }
    echo "</tr>\n";
    echo "</table> ";
    echo "<table bgcolor='".$weblinksconfig['tablecolor2']."' width='100%' cellspacing='0' cellpadding='0' border='0'><tr>";
    if($image != 'http://' && !empty($image) ){
        echo "<td valign='top' width='".$weblinksconfig['image_width']."' ><a href='".$image."' rel='lightbox' title='".$title."' rev='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=".$lid."' ><img src='".$image."'  width='".$weblinksconfig['image_width']."' height='".$weblinksconfig['image_height']."' border='0' title='".$lang_new[$module_name]['VIEW_FULL']."' alt='' /></a></td>";
        echo "<td width='2%'></td>";
        echo "<td align='left' valign='top' width='100%'><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />".$description."</td>";
    }elseif ( $weblinksconfig['thumbnail_use'] && !empty($weblinksconfig['thumbnail_url']) ) {
        echo "<td valign='top' width='".$weblinksconfig['image_width']."' ><a href='".$weblinksconfig['thumbnail_url'].$url."' rel='lightbox' title='".$title."' rev='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=".$lid."' ><img src='".$weblinksconfig['thumbnail_url'].$url."' width='".$weblinksconfig['image_width']."' height='".$weblinksconfig['image_height']."'  border='0' title='".$lang_new[$module_name]['VIEW_FULL']."' alt='' /></a></td>";
        echo "<td width='2%'></td>";
        echo "<td align='left' valign='top' width='100%'><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />".$description."</td>";
    }else{
        echo "<td valign='top' width='".$weblinksconfig['image_width']."' ><a href='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=".$lid."' target='_blank'><img src='".evo_image('blank.gif', $module_name)."' width='".$weblinksconfig['image_width']."' height='".$weblinksconfig['image_height']."'  border='0' title='".$lang_new[$module_name]['VISIT']."' alt='' /></a></td>";
        echo "<td width='2%'></td>";
        echo "<td align='left' valign='top' width='100%'><strong><u>".$lang_new[$module_name]['DESCRIPTION'].":</u></strong><br />".$description."</td>";
    }
    echo "</tr></table>";
    echo "<table bgcolor='".$weblinksconfig['tablecolor1']."' width='100%' cellspacing='0' cellpadding='2' border='0'><tr>";
    $datetime = formatTimeStamp($time);
    echo "<td align='left' height='20'><img src='".evo_image('date.png', $module_name)."' width='16' height='16' border='0' title='".$lang_new[$module_name]['DATE_WRITTEN']."&nbsp;".$datetime."&nbsp;".$lang_new[$module_name]['BY']." $name' alt='' />&nbsp;".$datetime."</td>";
    echo "<td><img src='".evo_image('hits.png', $module_name)."' width='16' height='16' border='0' title='".$lang_new[$module_name]['HITS']."&nbsp;".$hits."' alt='' /><strong>".$hits."</strong></td>";
    $votestring = ($totalvotes == 1) ? $lang_new[$module_name]['VOTE'] : $lang_new[$module_name]['VOTES'];
    if ($totalvotes != 0) {
        echo "<td><a href='modules.php?name=".$module_name."&amp;op=viewlinkdetails&amp;lid=".$lid."&amp;ttitle=".$transfertitle."'><img src='".evo_image('details.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['DO_SHOW_DETAILS']."' alt='' /></a></td>";
    } else {
        echo "<td></td>";
    }
    //Visit
    echo "<td><a href='modules.php?name=".$module_name."&amp;op=linkvisit&amp;lid=".$lid."' target='_blank'><img src='".evo_image('link.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['VISIT']."' alt='' /></a></td>";
    if ($userinfo['username'] != $name) {
        echo "<td align='center'><a href='modules.php?name=".$module_name."&amp;op=ratelink&amp;lid=".$lid."&amp;ttitle=".$transfertitle."'><img src='".evo_image('votein.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['DO_RATE']."' alt='' /></a></td>";
    }
    if ($totalcomments != 0) {
        echo "<td><a href='modules.php?name=".$module_name."&amp;op=viewlinkcomments&amp;lid=".$lid."&amp;ttitle=".$transfertitle."'><img src='".evo_image('comments.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['DO_SHOW_COMMENTS']."' alt='' /><strong>".$totalcomments."</strong></a></td>";
    } else {
        echo "<td></td>";
    }
    echo "<td>".linkdetecteditorial($lid, $transfertitle)."</td>";
    if (is_user()) {
        echo "<td align='right'><a href='modules.php?name=".$module_name."&amp;op=brokenlink&amp;lid=".$lid."'><img src='".evo_image('alert.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['REPORT_BROKEN']."' alt='' /></a></td>";
    } else {
        echo "<td></td>";
    }
    if (is_mod_admin($module_name)) {
        echo "<td align='right' ><a href='".$admin_file.".php?op=LinksModLink&amp;lid=".$lid."'><img src='".evo_image('editicon.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['EDIT']."' alt='' /></a></td>";
    } else {
        echo "<td align='right' ><a href='modules.php?name=".$module_name."&amp;op=modifylinkrequest&amp;lid=".$lid."'><img src='".evo_image('editicon.png', $module_name)."' border='0' width='16' height='16' title='".$lang_new[$module_name]['MODIFY_LINK_REQUEST']."' alt='' /></a></td>";
    }
    echo " </tr></table></fieldset>";
}
echo "</td></tr></table>\n";
$db->sql_freeresult($result4);
$orderby = linkconvertorderbyout($orderby);
// Calculates how many pages exist. Which page one should be on, etc...
$linkpagesint = ($totalselectedlinks / $weblinksconfig['links_perpage']);
$linkpageremainder = ($totalselectedlinks % $weblinksconfig['links_perpage']);
if ($linkpageremainder != 0) {
    $linkpages = ceil($linkpagesint);
    if ($totalselectedlinks < $weblinksconfig['links_perpage']) {
        $linkpageremainder = 0;
    }
} else {
    $linkpages = $linkpagesint;
}

// Page Numbering
if ($linkpages!=1 && $linkpages!=0) {
    echo "<center><br /><br />";
    $prev=$min-$weblinksconfig['links_perpage'];
    if ($prev>=0) {
        echo "&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$legendid."&amp;min=".$prev."&amp;orderby=".$orderby."&amp;show=".$weblinksconfig['links_perpage']."'>";
        echo "<img src='".evo_image('left.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_PREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }else{
        echo "<img src='".evo_image('noleft.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NOPREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }
    $counter = 1;
    $currentpage = ($max / $weblinksconfig['links_perpage']);
    while ($counter<=$linkpages ) {
       $cpage = $counter;
       $mintemp = ($weblinksconfig['links_perpage'] * $counter) - $weblinksconfig['links_perpage'];
       if ($counter == $currentpage) {
          echo "<strong>$counter</strong>&nbsp;";
        } else {
          echo "<a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$legendid."&amp;min=".$mintemp."&amp;orderby=".$orderby."&amp;show=".$show."'>".$counter."</a> ";
        }
        $counter++;
    }
    $next=$min+$weblinksconfig['links_perpage'];
    if ($max < $totalselectedlinks) {
        echo "&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$legendid."&amp;min=".$max."&amp;orderby=".$orderby."&amp;show=".$show."'>";
        echo "<img src='".evo_image('right.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NEXT']."' alt='".$lang_new[$module_name]['PAGE_NEXT']."' border='0' /></a>";
    }else{
        echo "&nbsp;&nbsp;<img src='".evo_image('noright.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NONEXT']."' alt='".$lang_new[$module_name]['PAGE_NONEXT']."' border='0' /></a>";
    }
    echo "</center>";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>