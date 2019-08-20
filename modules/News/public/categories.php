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

if (!defined('MODULE_FILE') && !defined('NEWS_INDEX_FILE')) {
   die('You can\'t access this file directly...');
}

function ModuleNewsCategoriesNewIndex() {
    global $module_name, $actualtime, $_GETVAR, $neconfig, $userinfo, $querylang, $display;

    if($neconfig['homenumber'] == 0) {
        $storynum = $userinfo['storynum'];
    } else {
        $storynum = $neconfig['homenumber'];
    }
    $catid  = $_GETVAR->get('catid', '_REQUEST', 'int', 0);
    $min    = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $max    = $_GETVAR->get('max', '_REQUEST', 'int', $min + $storynum);
    if ($topic == 0 ) {
        redirect('modules.php?name='.$module_name);
    }

    include_once(NUKE_BASE_DIR.'header.php');
    ModuleNewsHeading();
    if($neconfig['readmore']) {
        echo "<script language='JavaScript' type='text/javascript'>\n";
        echo "<!-- Begin\n";
        echo "function NewsReadWindow(mypage, myname, w, h, scroll) {\n";
        echo "var winl = (screen.width - w) / 2;\n";
        echo "var wint = (screen.height - h) / 2;\n";
        echo "winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+''\n";
        echo "win = window.open(mypage, myname, winprops)\n";
        echo "if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }\n";
        echo "}\n";
        echo "//  End -->\n";
        echo "</script>\n";
    }
    $db->sql_uquery('UPDATE `'._STORIES_CATEGORIES_TABLE.'` set `counter`= counter+1 WHERE `catid`="'.$catid.'"');    $total = $db->sql_ufetchrow('SELECT COUNT(`sid`) AS `total` FROM `'._STORIES_TABLE.'` WHERE `topic`="'.$topic.'" '.$querylang.' AND time <= "'.$actualtime.'"');
    $totalarticles = $total['total'];
    $result = $db->sql_query('SELECT `sid` FROM `'._STORIES_TABLE.'` WHERE `catid`="'.$catid.'" '.$querylang.' AND time <= "'.$actualtime.'" ORDER BY `catid`, `sid` DESC LIMIT '.$min.','.$storynum.'');
    $totalrows = $db->sql_numrows($result);
    if ($neconfig['columns'] == 1) { // DUAL
        echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\n";
    }
    $a = 0;
    if ($totalrows > 0) {
        while ($row = $db->sql_fetchrow($result)) {
            $artinfo    = ModuleNews_GetDBRow('`sid`="'.$row['sid'].'" AND time <= "'.$actualtime.'"'.$querylang, $display);
            $morelink   = '';
            $datetime   = formatTimeStamp($artinfo['time'], '', 1);
            $read_link  = "<a href='modules.php?name=".$module_name."&amp;op=read_article&amp;sid=".$artinfo['sid'].$display."' target='_blank' onclick='NewsReadWindow(this.href,\"ReadArticle\",\"600\",\"400\",\"yes\");return false;'>";
            $story_link = "<a href='modules.php?name=".$module_name."&amp;op=article&amp;sid=".$artinfo['sid'].$display."'>";
            if ($artinfo['introcount'] > 255 || $artinfo['fullcount'] > 0 || $artinfo['comments'] > 0 || $artinfo['acomm'] == 1) {
                if($neconfig['readmore'] == 1) {
                    $morelink .= $read_link."<span style='font-weight:bold;'>"._READMORE."</span></a>&nbsp;|&nbsp;";
                } else {
                    $morelink .= $story_link."<span style='font-weight:bold;'>"._READMORE."</span></a>&nbsp;|&nbsp;";
                }
            } else {
                $morelink .= '';
            }
            if ($artinfo['introcount'] > 255) {
                $artinfo['hometext'] = strip_tags($artinfo['hometext'], "<br />");
                $artinfo['hometext'] = substr($artinfo['hometext'], 0, 255);
            }
            $artinfo['morelink'] = $morelink . $artinfo['morelink'];
            if($neconfig['columns'] == 1) { // DUAL
                if ($a == 0) {
                    echo "<tr>\n";
                }
                echo "<td valign='top' width='50%'>";
                themeindex($artinfo['aid'], $artinfo['informant'], $artinfo['datetime'], $artinfo['title'], $artinfo['counter'], $artinfo['topic'], $artinfo['hometext'], $artinfo['notes'], $artinfo['morelink'], $artinfo['topics']['topicname'], $artinfo['topics']['topicimage'], $artinfo['topics']['topictext'], $artinfo['informantwrites']);
                echo "</td>\n";
                $a++;
                if ($a == 2) {
                    echo "</tr>\n"; $a = 0;
                } else {
                    echo "<td>&nbsp;</td>";
                }
            } else { // SINGLE
                themeindex($artinfo['aid'], $artinfo['informant'], $artinfo['datetime'], $artinfo['title'], $artinfo['counter'], $artinfo['topic'], $artinfo['hometext'], $artinfo['notes'], $artinfo['morelink'], $artinfo['topics']['topicname'], $artinfo['topics']['topicimage'], $artinfo['topics']['topictext'], $artinfo['informantwrites']);
            }
        }
        $db->sql_freeresult($result);
        if ($neconfig['columns'] == 1) { // DUAL
            if ($a ==1) {
                echo "<td width='50%'>&nbsp;</td></tr>\n";
            } else {
                echo "</tr>\n";
            }
            echo "</table>\n";
        }
        echo "\n<!-- PAGING -->\n";
        $articlepagesint = ($totalarticles / $storynum);
        $articlepageremain = ($totalarticles % $storynum);
        if ($articlepageremain != 0) {
            $articlepages = ceil($articlepagesint);
            if ($totalarticles < $storynum) {
                $articlepageremain = 0;
            }
        } else {
            $articlepages = $articlepagesint;
        }
        if ($articlepages != 1 && $articlepages != 0) {
            echo "<br />\n";
            OpenTable();
            $counter = 1;
            $currentpage = ($max / $storynum);
            echo "<form action='modules.php?name=".$module_name."' method='post'>\n";
            echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
            echo "<tr>\n<td><span style='font-weight:bold;'>"._NE_SELECT."</span>";
            echo "<select name='min' onchange='top.location.href=this.options[this.selectedIndex].value'>\n";
            while ($counter <= $articlepages ) {
                $cpage = $counter;
                $mintemp = ($storynum * $counter) - $storynum;
                if ($counter == $currentpage) {
                    echo "<option selected='selected'>".$counter."</option>\n";
                } else {
                    if(defined('HOME_FILE')) {
                      echo "<option value='index.php?topic=".$topic."&amp;min=".$mintemp."'>".$counter."</option>\n";
                    } else {
                      echo "<option value='modules.php?name=".$module_name."&amp;op=categories&amp;catid=".$catid."&amp;min=".$mintemp."'>".$counter."</option>\n";
                    }
                }
                $counter++;
            }
            echo "</select><span style='font-weight:bold;'>"._NE_OF."&nbsp;".$articlepages."&nbsp;"._NE_PAGES."</span></td>\n</tr>\n";
            echo "</table>\n";
            echo "</form>\n";
            CloseTable();
        }
        echo "<!-- CLOSE PAGING -->\n";
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' ._NE_NONE_NEWS.'<br /><br />'. _GOBACK);
    }
}

$mode = $_GETVAR->get('mode', '_REQUEST', 'string', '');

switch ($mode) {
    case 'newindex':
    default: ModuleNewsCategoriesNewIndex(); break;
}

?>