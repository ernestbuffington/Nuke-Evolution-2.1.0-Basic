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

global $evoconfig, $plus_minus_images;

if (!defined('HOME_FILE') || (defined('HOME_FILE') && $weblinksconfig['show_header'])) {
    LinksHeading();
    LinksLegend();
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
$result = $db->sql_query("select `cid`, `title`, `image`, `cdescription` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `parentid`=0 ORDER BY `title`");
$columncount = 0;
while ($row = $db->sql_fetchrow($result)) {
    $style = '';
    if (!$evoconfig['collapse_start']) {
        $style = 'style="display: none;"';
    }
    $cid    = intval($row['cid']);
    $title  = set_smilies(decode_bbcode(stripslashes($row['title']), 1, true));
    $cdescription = set_smilies(decode_bbcode(stripslashes($row['cdescription']), 1, true));
    $image  = $row['image'];
    $cnumrows1 = $db->sql_numrows($db->sql_query("SELECT `lid` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `cid`='".$cid."'"));
    $cnum1  = "&nbsp;(".$cnumrows1.")";
    if ($columncount == 0) { echo "<tr>"; }
    echo "<td width='50%' align='center' valign='top' bgcolor='". $weblinksconfig['tablecolor2'] ."'>\n";
    echo "<table style='border-color:" . $weblinksconfig['tablecolor1'] .";' width='100%' border='0' cellpadding='0' cellspacing='0'>\n";
    echo "<tr><td bgcolor='".$weblinksconfig['tablecolor1']."' valign='top' align='left'>";
    if ( !empty($image) ) {
        echo "&nbsp;<img src='".$image."' width='16' height='16' alt='' />&nbsp;";
    } else {
        echo "&nbsp;<img src='".evo_image('dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
    }
    echo "<span class='option'><a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$cid."'><strong>".$title."</strong></a>".$cnum1.categorynewlinkgraphic($cid).linkcategorypopgraphic($cid) ."</span><img src='".$switchimage."' align='right' class='showstate' name='".$switchname."' width='9' height='9' border='0' onclick='expandcontent(this, \"weblinkscategory".$cid."\")' alt='' style='cursor: pointer;' /></td></tr>\n";
    if ($cdescription) {
        echo "<tr><td><table width='100%'><tr><td width='10%'></td>";
        echo "<td align='left'>".evo_img_tag_to_resize($cdescription)."</td>";
        echo "</tr></table></td></tr>";
    }
    echo "</table>";
    $result2 = $db->sql_query("SELECT `cid`, `title`, `image` FROM `"._WEBLINKS_CATEGORIES_TABLE."` WHERE `parentid`='$cid' ORDER BY `title`");
    $subnumrows = $db->sql_numrows($result2);
    if ($subnumrows > 0) {
        echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td width='100%' id='weblinkscategory".$cid."' class='switchcontent' ".$style.">";
        while ($row2 = $db->sql_fetchrow($result2)) {
            $subcid = intval($row2['cid']);
            $simage = $row2['image'];
            $stitle = set_smilies(decode_bbcode(stripslashes($row2['title']), 1, true));
            $cnumrows2 = $db->sql_numrows($db->sql_query("SELECT `lid` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `cid`='".$subcid."'"));
            $cnum = "&nbsp;(".$cnumrows2.")";
            echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>\n";
            echo "<tr><td width='5%' bgcolor='". $weblinksconfig['tablecolor1'] ."'></td><td bgcolor='". $weblinksconfig['tablecolor1'] ."' align='left'><span class='content' style='width:100%;'>";
            if ( !empty($simage) ) {
                echo "&nbsp;<img src='".$simage."' width='16px' height='16px' alt='' />&nbsp;";
            } else {
                echo "&nbsp;<img src='".evo_image('sub-dir.png', $module_name)."' width='16' height='16' alt='' />&nbsp;";
            }
            echo "<a href='modules.php?name=".$module_name."&amp;op=viewlink&amp;cid=".$subcid."'>".$stitle."&nbsp;</a>".$cnum."&nbsp;".categorynewlinkgraphic($subcid).linkcategorypopgraphic($subcid) ."</span></td></tr>\n";
            echo "</table>";
        }
        echo "</td></tr></table>";
    }
    $db->sql_freeresult($result2);
    $columncount++;
    if ( $columncount == 2 ) {
        echo "</td></tr>";
        $columncount = 0;
    } else {
        echo "</td>";
    }
}
if ($columncount == 1) { echo "<td></td></tr>";}
echo "</table></fieldset>";
echo "<br /><br />";
$db->sql_freeresult($result);
// Block-Content starts here
if ($weblinksconfig['show_topbox']) {
    echo "<table width='100%' border='1' cellspacing='0' cellpadding='0' class='scrolltable'>";
    echo "<tr class='scrolltable'>";
    echo "<td class='scrolltable' width='50%' valign='top'><div align='center'><img src='".evo_image('newlinks.png', $module_name)."' alt='' />&nbsp;<strong>".$lang_new[$module_name]['BOX_HEADER_NEW']."</strong><br /></div></td>";
    echo "<td class='scrolltable' width='50%' valign='top'><div align='center'><img src='".evo_image('stats.png', $module_name)."' alt='' />&nbsp;<strong>".$lang_new[$module_name]['BOX_HEADER_TOP']."</strong><br /></div></td>";
    echo "</tr>";
    echo "<tr class='scrolltable'>";
    echo "<td class='scrolltable' width='50%' height='".$weblinksconfig['topbox_height']."' valign='top'>\n";
    $blockcontent1 = '';
    $a = 1;
    $result = $db->sql_query("SELECT `lid`, `title`, `hits` FROM `". _WEBLINKS_LINKS_TABLE ."` ORDER BY `date` DESC limit 0, ".$weblinksconfig['maxshow']);
    while(list($lid, $title, $hits) = $db->sql_fetchrow($result)) {
        $title2 = stripslashes(preg_replace('#_#', ' ', $title));
        $blockcontent1 .= $a.") <a href='modules.php?name=".$module_name."&amp;op=viewlinkdetails&amp;lid=".$lid."&amp;ttitle=".$title."'>".$title2."</a>";
        $blockcontent1 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<strong>".$hits."</strong>]";
        if ($weblinksconfig['topbox_scroll'] ) {
            for($i = 0; $i<=$weblinksconfig['block_line_breaks']; $i++) {
                $blockcontent1 .= '<br />';
            }
        } else {
            $blockcontent1 .= '<br />';
        }
        $a++;
    }
    $db->sql_freeresult($result);
    if ($weblinksconfig['topbox_scroll'] ) {
        echo evo_marquee('Weblinks_Index1', $weblinksconfig['topbox_height'], '100%', $blockcontent1, ($weblinksconfig['topbox_scroll_direction'] ? 'Up' : 'Down'), $weblinksconfig['topbox_scroll_amount'], $weblinksconfig['topbox_height'], '100%' , 1, 0);
    }
    echo "</td>";
    echo "<td class='scrolltable' width='50%' height='".$weblinksconfig['topbox_height']."' valign='top'>\n";
    $a = 1;
    $blockcontent2 = '';
    $result = $db->sql_query("SELECT `lid`, `title`, `hits` FROM `". _WEBLINKS_LINKS_TABLE ."` ORDER BY `hits` DESC limit 0, ".$weblinksconfig['maxshow']);
    while(list($lid, $title, $hits) = $db->sql_fetchrow($result)) {
        $title2 = stripslashes(preg_replace("#_#", " ", $title));
        $blockcontent2 .= $a.") <a href='modules.php?name=".$module_name."&amp;op=viewlinkdetails&amp;lid=".$lid."&amp;ttitle=".$title."'>".$title2."</a>";
        $blockcontent2 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<strong>".$hits."</strong>]";
        if ($weblinksconfig['topbox_scroll'] ) {
            for($i = 0; $i<=$weblinksconfig['block_line_breaks']; $i++) {
                $blockcontent2 .= '<br />';
            }
        } else {
            $blockcontent2 .= '<br />';
        }
        $a++;
    }
    $db->sql_freeresult($result);
    if ($weblinksconfig['topbox_scroll'] ) {
        echo evo_marquee('Weblinks_Index2', $weblinksconfig['topbox_height'], '100%', $blockcontent2, ($weblinksconfig['topbox_scroll_direction'] ? 'Up' : 'Down'), $weblinksconfig['topbox_scroll_amount'], $weblinksconfig['topbox_height'], '100%' , 1, 0);
    }
    echo "</td></tr></table>";
} else {
    echo '';
}

$numrows = $db->sql_unumrows("SELECT `lid` FROM "._WEBLINKS_LINKS_TABLE);
$catnum  = $db->sql_unumrows("SELECT `cid` FROM "._WEBLINKS_CATEGORIES_TABLE);
echo "<br /><br /><center><span class='content'>".$lang_new[$module_name]['THERE_ARE']."&nbsp;<strong>".$numrows."</strong>&nbsp;".$lang_new[$module_name]['LINKS']."&nbsp;".$lang_new[$module_name]['AND']."&nbsp;<strong>".$catnum."</strong>&nbsp;".$lang_new[$module_name]['CATEGORIES']."&nbsp;".$lang_new[$module_name]['IN_DB']."</span></center>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>