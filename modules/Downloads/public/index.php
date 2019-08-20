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

global $evoconfig, $plus_minus_images;

if (!defined('HOME_FILE') || (defined('HOME_FILE') && $downloadsconfig['show_header'])) {
    DownloadsHeading();
    DownloadsLegend();
    OpenTable();
} else {
    OpenTable();
  echo "<center><span class='title'><strong>".$lang_new[$module_name]['MAIN_CATEGORY_PAGE']."</strong></span></center><br />";
}
if ($evoconfig['collapse_start'] == true) {
    $switchimage = $plus_minus_images['minus'];
    $switchname  = 'minus';
} else {
    $switchimage = $plus_minus_images['plus'];
    $switchname  = 'plus';
}

echo "<fieldset><table width='100%' border='0' cellspacing='10' cellpadding='0' align='center'>";
$result = $db->sql_query("select `cid`, `title`, `image`, `cdescription` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `parentid`=0 AND `catactive`=1 ORDER BY `title`");
$countcat = $db->sql_numrows($result);
$columncount = 0;
if ($countcat > 0) {
    while ($row = $db->sql_fetchrow($result)) {
        $style = '';
        if (!$evoconfig['collapse_start']) {
            $style = 'style="display: none;"';
        }
        $cid = intval($row['cid']);
        $title = set_smilies(decode_bbcode(stripslashes($row['title']), 1, true));
        $cdescription = set_smilies(decode_bbcode(stripslashes($row['cdescription']), 1, true));
        $image = $row['image'];
        $cnumrows1 = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid`='".$cid."' AND `download_active`=1");
        $cnum1 = "&nbsp;(".$cnumrows1.")";
        if ($columncount == 0) { echo "<tr>"; }
        echo "<td width='50%' align='center' valign='top' bgcolor='". $downloadsconfig['tablecolor2'] ."'>\n";
        echo "<table style='border-color:" . $downloadsconfig['tablecolor1'] .";' width='100%' border='0' cellpadding='0' cellspacing='0'>\n";
        echo "<tr><td width='100%' bgcolor='".$downloadsconfig['tablecolor1']."' valign='top' align='left'>";
        if ( !empty($image) ) {
            echo "&nbsp;<img src='".$image."' width='16' height='16' alt='' />&nbsp;";
        } else {
            echo "&nbsp;<img src='".evo_image('dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
        }
        echo "<span class='option'><a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$cid."'><strong>".$title."</strong></a>&nbsp;".$cnum1."&nbsp;".DownloadsGraphicCatNew($cid).DownloadsGraphicCatPopular($cid) ."</span><img src='".$switchimage."' align='right' class='showstate' name='".$switchname."' width='9' height='9' border='0' onclick='expandcontent(this, \"downloadscategory".$cid."\")' alt='' style='cursor: pointer;' /></td></tr>\n";
        if ($cdescription) {
            echo "<tr><td><table width='100%'><tr><td width='10%'></td>";
            echo "<td align='left'>".evo_img_tag_to_resize($cdescription)."</td>";
            echo "</tr></table></td></tr>";
        }
        echo "</table>";
        $result2 = $db->sql_query("SELECT `cid`, `title`, `image`, `cdescription` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `parentid`='".$cid."' AND `catactive`=1 ORDER BY `title`");
        $subnumrows = $db->sql_numrows($result2);
        if ($subnumrows > 0) {
            echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td width='100%' id='downloadscategory".$cid."' class='switchcontent' ".$style.">";
            while ($row2 = $db->sql_fetchrow($result2)) {
                $cdescription2 = set_smilies(decode_bbcode(stripslashes($row2['cdescription']), 1, true));
                $subcid = intval($row2['cid']);
                $simage = $row2['image'];
                $stitle = set_smilies(decode_bbcode(stripslashes($row2['title']), 1, true));
                $cnumrows2 = $db->sql_unumrows("SELECT `did` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid`='".$subcid."' AND `download_active`=1 ");
                $cnum = "&nbsp;(".$cnumrows2.")";
                echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>\n";
                echo "<tr><td width='5%' bgcolor='". $downloadsconfig['tablecolor1'] ."'></td><td width='95%' bgcolor='". $downloadsconfig['tablecolor1'] ."' align='left'><span class='content' style='width:100%;'>";
                if ( !empty($simage) ) {
                    echo "&nbsp;<img src='".$simage."' width='16' height='16' alt='' />&nbsp;";
                } else {
                    echo "&nbsp;<img src='".evo_image('sub-dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
                }
                echo "<a href='modules.php?name=".$module_name."&amp;op=viewdownload&amp;cid=".$subcid."'>".$stitle."</a>&nbsp;".$cnum."&nbsp;".DownloadsGraphicCatNew($subcid).DownloadsGraphicCatPopular($subcid) ."</span></td></tr>\n";
                if ($cdescription) {
                    echo "<tr><td width='10%'></td>";
                    echo "<td width='90%' align='left'>".evo_img_tag_to_resize($cdescription2)."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            echo "</td></tr></table>\n";
        }
        $db->sql_freeresult($result2);
        $columncount++;
        if ( $columncount == 2 ) {
            echo "</td></tr>\n";
            $columncount = 0;
        } else {
            echo "</td>";
        }
    }
    if ($columncount == 1) { echo "<td></td></tr>";}
    echo "</table></fieldset>\n";
} else {
    echo "<tr><td></td></tr></table></fieldset>\n";
}
echo "<br /><br />";
$db->sql_freeresult($result);
// Block-Content starts here
if ($downloadsconfig['show_topbox']) {
    echo "<table width='100%' border='1' cellspacing='0' cellpadding='0' class='scrolltable'>";
    echo "<tr class='scrolltable'>";
    echo "<td class='scrolltable' width='50%' valign='top'><div align='center'><img src='".evo_image('newdownloads.png', $module_name)."' alt='' />&nbsp;<strong>".$lang_new[$module_name]['BOX_HEADER_NEW']."</strong><br /></div></td>";
    echo "<td class='scrolltable' width='50%' valign='top'><div align='center'><img src='".evo_image('stats.png', $module_name)."' alt='' />&nbsp;<strong>".$lang_new[$module_name]['BOX_HEADER_TOP']."</strong><br /></div></td>";
    echo "</tr>";
    echo "<tr class='scrolltable'>";
    echo "<td class='scrolltable' width='50%' height='".$downloadsconfig['topbox_height']."' valign='top'>\n";
    $blockcontent1 = '';
    $a = 1;
    $result = $db->sql_query("SELECT `did`, `title`, `hits` FROM `". _DOWNLOADS_DOWNLOADS_TABLE ."` WHERE `download_active`=1 ORDER BY `date` DESC limit 0, ".$downloadsconfig['maxshow']);
    while(list($did, $title, $hits) = $db->sql_fetchrow($result)) {
        $title2 = stripslashes(preg_replace('#_#', ' ', $title));
        $blockcontent1 .= $a.")&nbsp;<a href='modules.php?name=".$module_name."&amp;op=showdownload&amp;did=".$did."'>".$title2."</a>";
        $blockcontent1 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<strong>".$hits."</strong>]";
        if ($downloadsconfig['topbox_scroll'] ) {
            for($i = 0; $i<=$downloadsconfig['block_line_breaks']; $i++) {
                $blockcontent1 .= '<br />';
            }
        } else {
            $blockcontent1 .= '<br />';
        }
        $a++;
    }
    $db->sql_freeresult($result);
    if ( $downloadsconfig['topbox_scroll'] ) {
        echo evo_marquee('Downloads_Index1', $downloadsconfig['topbox_height'], '100%', $blockcontent1, ($downloadsconfig['topbox_scroll_direction'] ? 'Up' : 'Down'), $downloadsconfig['topbox_scroll_amount'], $downloadsconfig['topbox_height'], '100%' , 1, 0);
    } else {
        echo $blockcontent1;
    }
    echo "</td>";
    echo "<td class='scrolltable' width='50%' height='".$downloadsconfig['topbox_height']."' valign='top'>\n";
    $a = 1;
    $blockcontent2 = '';
    $result = $db->sql_query("SELECT `did`, `title`, `hits` FROM `". _DOWNLOADS_DOWNLOADS_TABLE ."` WHERE `download_active`=1 ORDER BY `hits` DESC limit 0, ".$downloadsconfig['maxshow']);
    while(list($did, $title, $hits) = $db->sql_fetchrow($result)) {
        $title2 = stripslashes(preg_replace('#_#', ' ', $title));
        $blockcontent2 .= $a.")&nbsp;<a href='modules.php?name=".$module_name."&amp;op=showdownload&amp;did=".$did."'>".$title2."</a>";
        $blockcontent2 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<strong>".$hits."</strong>]";
        if ($downloadsconfig['topbox_scroll'] ) {
            for($i = 0; $i<=$downloadsconfig['block_line_breaks']; $i++) {
                $blockcontent2 .= '<br />';
            }
        } else {
            $blockcontent2 .= '<br />';
        }
        $a++;
    }
    $db->sql_freeresult($result);
    if ($downloadsconfig['topbox_scroll'] ) {
        echo evo_marquee('Downloads_Index2', $downloadsconfig['topbox_height'], '100%', $blockcontent2, ($downloadsconfig['topbox_scroll_direction'] ? 'Up' : 'Down'), $downloadsconfig['topbox_scroll_amount'], $downloadsconfig['topbox_height'], '100%' , 1, 0);
    } else {
        echo $blockcontent2;
    }
    echo "</td></tr></table>";
} else {
    echo '';
}

$result3 = $db->sql_ufetchrow("SELECT COUNT(`did`) AS `numdown` FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `download_active`=1 ");
$numrows = intval($result3['numdown']);
$result4 = $db->sql_ufetchrow("SELECT COUNT(`cid`) AS `numcats` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `catactive`=1 ");
$catnum = intval($result4['numcats']);
echo "<br /><br /><center><span class='content'>".$lang_new[$module_name]['THERE_ARE']."&nbsp;<strong>".$numrows."</strong>&nbsp;".(($numrows == 1) ? $lang_new[$module_name]['DOWNLOAD'] : $lang_new[$module_name]['DOWNLOADS'])." ".$lang_new[$module_name]['AND']."&nbsp;<strong>".$catnum."</strong>&nbsp;".$lang_new[$module_name]['CATEGORIES']."&nbsp;".$lang_new[$module_name]['IN_DB']."</span></center>";
CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');

?>