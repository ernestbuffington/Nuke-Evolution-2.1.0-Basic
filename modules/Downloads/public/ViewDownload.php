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

global $userinfo;

$sql_order  = $_GETVAR->get('orderby', '_REQUEST', 'string', 'titleA');
$min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
$max        = $_GETVAR->get('max', '_REQUEST', 'int', 0);
$show       = $_GETVAR->get('show', '_REQUEST', 'int', $downloadsconfig['downloads_perpage']);
$cid        = $_GETVAR->get('cid', '_REQUEST', 'int', 0);

if ($max == 0) {
    $max =$min+$downloadsconfig['downloads_perpage'];
}

$orderby = DownloadsConvertOrderByIn($sql_order);

include_once(NUKE_BASE_DIR.'header.php');
DownloadsHeading();
DownloadsLegend();
OpenTable();
$row1     = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`='".$cid."' AND `catactive`=1");
$title    = stripslashes(check_html($row1['title'], "nohtml"));
$parentid = intval($row1['parentid']);
$title    = DownloadsGetParentLink($parentid,$title);
$title    = "<a href='modules.php?name=".$module_name."'>".$lang_new[$module_name]['MODULE_NAME']."/</a>".$title;
echo "<center><span class='option'><strong>".$lang_new[$module_name]['CATEGORY'].":&nbsp;<em>".$title."</em></strong></span></center><br />";
echo "<hr noshade='noshade' size='1' />";
$result2 = $db->sql_query("SELECT `cid`, `title`, `image`, `cdescription` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `parentid`='".$cid."' ORDER BY `title` ASC");
$numcats = $db->sql_numrows($result2);
$count = 0;
$count1 = 0;
if ( $numcats > 0 ) {
    while (list($tcid, $ttitle, $tcimage, $tcdescription) = $db->sql_fetchrow($result2) ) {
        if ($count == 0) {
            $leftside[$count1]['downloads'] = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid`='".$tcid."' AND `download_active`=1 ORDER BY ".$orderby);
            $leftside[$count1]['cid'] = $tcid;
            $leftside[$count1]['title'] = $ttitle;
            $leftside[$count1]['image'] = $tcimage;
            $leftside[$count1]['cdescription'] = evo_img_tag_to_resize($tcdescription);
            $count++;
        } else {
            $rightside[$count1]['downloads'] = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid`='".$tcid."' AND `download_active`=1 ORDER BY ".$orderby);
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
                    $cid2  = $tableleft['cid'];
                    $title = $tableleft['title'];
                    $image = $tableleft['image'];
                    $cdescription = $tableleft['cdescription'];
                    $countdownloads = $tableleft['downloads'];
                    echo "<fieldset><table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
                    echo "<tr><td width='100%' bgcolor='".$downloadsconfig['tablecolor1']."'>";
                    if ( !empty($image) ) {
                        echo "<img src='".$image."' width='16' height='16' alt='' />&nbsp;";
                    } else {
                        echo "<img src='".evo_image('dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
                    }
                    echo "<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$cid2."'>". set_smilies(decode_bbcode(stripslashes($title), 1, true)) ."&nbsp;(".$countdownloads.")".DownloadsGraphicCatNew($cid) ."</a></td></tr>\n";
                    echo "<tr><td width='100%' >". set_smilies(decode_bbcode(stripslashes($cdescription), 1, true)) ."</td></tr>\n";
                    // Lookup for SubCategories
                    $result3 = $db->sql_query("SELECT `cid`, `title`, `image` from `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `parentid`='".$cid2."' ORDER BY `title`");
                    $numsubcats = $db->sql_numrows($result3);
                    if ( $numsubcats > 0 ) {
                          echo "<tr><td>\n";
                          echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
                          while($row3 = $db->sql_fetchrow($result3)) {
                                echo "<tr><td width='100%'>&nbsp;&nbsp;";
                                if ( !empty($row3['image']) ) {
                                    echo " <img src='".$row3['image']."' width='16' height='16' alt='' />&nbsp;";
                                } else {
                                    echo " <img src='".evo_image('dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
                                }
                                echo "<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$row3['cid']."'>";
                                echo stripslashes($row3['title']) ."</a></td></tr>\n";
                          }
                          $db->sql_freeresult($result3);
                          echo "</table>\n";
                          echo "</td></tr>\n";
                    }
                    echo "</table></fieldset>\n";
          }
    }
    echo "</td>\n";
    echo "<td width='50%'>\n";
    if (!empty($rightside)) {
          foreach( $rightside as $tableright)  {
                    $cid3  = $tableright['cid'];
                    $title = $tableright['title'];
                    $image = $tableright['image'];
                    $cdescription = $tableright['cdescription'];
                    $countdownloads = $tableright['downloads'];
                    echo "<fieldset><table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
                    echo "<tr><td width='100%' bgcolor='".$downloadsconfig['tablecolor1']."'>";
                    if ( !empty($image) ) {
                        echo " <img src='".$image."' width='16' height='16' alt='' />&nbsp;";
                    } else {
                        echo " <img src='".evo_image('dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
                    }
                    echo "<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$cid3."'>". set_smilies(decode_bbcode(stripslashes($title), 1, true)) ." ($countdownloads)".DownloadsGraphicCatNew($cid) ."</a></td></tr>\n";
                    echo "<tr><td width='100%' >". set_smilies(decode_bbcode(stripslashes($cdescription), 1, true)) ."</td></tr>\n";
                    // Lookup for SubCategories
                    $result3 = $db->sql_query("SELECT `cid`, `title` from `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `parentid`='".$cid3."' ORDER BY `title`");
                    $numsubcats = $db->sql_numrows($result3);
                    if ( $numsubcats > 0 ) {
                          echo "<tr><td>\n";
                          echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
                          while($row3 = $db->sql_fetchrow($result3)) {
                                echo "<tr><td width='100%'>&nbsp;&nbsp;";
                                if ( !empty($row3['image']) ) {
                                    echo " <img src='".$row3['image']."' width='16' height='16' alt='' />&nbsp;";
                                } else {
                                    echo " <img src='".evo_image('dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
                                }
                                echo "<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$row3['cid']."'>";
                                echo stripslashes($row3['title']) ."</a></td></tr>\n";
                          }
                          $db->sql_freeresult($result3);
                          echo "</table>\n";
                          echo "</td></tr>\n";
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
$orderbyTrans = DownloadsConvertOrderByTrans($orderby);
DownloadsOrderLegend($orderbyTrans, $cid);

$result4         = $db->sql_query("SELECT * FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid`='".$cid."' AND `download_active`=1 ORDER BY ".$orderby." LIMIT ".$min.", ". $downloadsconfig['downloads_perpage']);
$fullcountresult = $db->sql_ufetchrow("SELECT COUNT(`did`) AS total FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid`='".$cid."' AND `download_active`=1");
$totalselecteddownloads = $fullcountresult['total'];

echo "<table width='100%' cellspacing='0' cellpadding='10' border='0'><tr><td>\n";
while($row4 = $db->sql_fetchrow($result4)) {
    if ( !DownloadsAllowed($row4['did'], $userinfo['user_id'], 'view') && !is_mod_admin($module_name)) {
        continue;
    } else {
        echo "<fieldset>";
        DownloadShowSingle($row4);
        echo "</fieldset><br />";
    }
}
echo "</td></tr></table>\n";
$db->sql_freeresult($result4);
$orderby = DownloadsConvertOrderByOut($orderby);
// Calculates how many pages exist. Which page one should be on, etc...
$downloadpagesint = ($totalselecteddownloads / $downloadsconfig['downloads_perpage']);
$downloadpageremainder = ($totalselecteddownloads % $downloadsconfig['downloads_perpage']);
if ($downloadpageremainder != 0) {
    $downloadpages = ceil($downloadpagesint);
    if ($totalselecteddownloads < $downloadsconfig['downloads_perpage']) {
        $downloadpageremainder = 0;
    }
} else {
    $downloadpages = $downloadpagesint;
}

// Page Numbering
if ($downloadpages!=1 && $downloadpages!=0) {
    echo "<center><br /><br />";
    $prev=$min-$downloadsconfig['downloads_perpage'];
    if ($prev>=0) {
        echo "&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$cid."&amp;min=".$prev."&amp;orderby=".$orderby."&amp;show=".$downloadsconfig['downloads_perpage']."'>";
        echo "<img src='".evo_image('left.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_PREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }else{
      echo "<img src='".evo_image('noleft.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NOPREVIOUS']."' alt='".$lang_new[$module_name]['PAGE_PREVIOUS']."' border='0' /></a>&nbsp;&nbsp;";
    }
    $counter = 1;
    $currentpage = ($max / $downloadsconfig['downloads_perpage']);
    while ($counter<=$downloadpages ) {
       $cpage = $counter;
       $mintemp = ($downloadsconfig['downloads_perpage'] * $counter) - $downloadsconfig['downloads_perpage'];
       if ($counter == $currentpage) {
          echo "<strong>$counter</strong>&nbsp;";
        } else {
          echo "<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$cid."&amp;min=".$mintemp."&amp;orderby=".$orderby."&amp;show=".$show."'>".$counter."</a> ";
        }
        $counter++;
    }
    $next=$min+$downloadsconfig['downloads_perpage'];
    if ($max < $totalselecteddownloads) {
        echo "&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$cid."&amp;min=".$max."&amp;orderby=".$orderby."&amp;show=".$show."'>";
        echo "<img src='".evo_image('right.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NEXT']."' alt='".$lang_new[$module_name]['PAGE_NEXT']."' border='0' /></a>";
    }else{
        echo "&nbsp;&nbsp;<img src='".evo_image('noright.png', $module_name)."' title='".$lang_new[$module_name]['PAGE_NONEXT']."' alt='".$lang_new[$module_name]['PAGE_NONEXT']."' border='0' /></a>";
    }
    echo "</center>";
}

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>