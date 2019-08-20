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

$min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
$max        = $_GETVAR->get('max', '_REQUEST', 'int', $min + $storynum);

$querylang = " `time` <= '".$actualtime."' ".$querylang;
if($neconfig['hometopic'] > 0 && defined('HOME_FILE')) { // One Topic on Home
    $querylang .= " AND topic='".$neconfig['hometopic']."'";
}
$querylang .= " AND ihome='0'";

$read_morepop = "<script type='text/javascript'>\n";
$read_morepop .= "<!-- Begin\n";
$read_morepop .= "function NewsReadWindow(mypage, myname, w, h, scroll) {\n";
$read_morepop .= "var winl = (screen.width - w) / 2;\n";
$read_morepop .= "var wint = (screen.height - h) / 2;\n";
$read_morepop .= "winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+''\n";
$read_morepop .= "win = window.open(mypage, myname, winprops)\n";
$read_morepop .= "if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }\n";
$read_morepop .= "}\n";
$read_morepop .= "//  End -->\n";
$read_morepop .= "</script>\n";

$total = $db->sql_ufetchrow('SELECT COUNT(`sid`) AS `total` FROM `'._STORIES_TABLE.'` WHERE '.$querylang);
$totalarticles = $total['total'];
$newsresult = $db->sql_query("SELECT `sid` FROM `"._STORIES_TABLE."` WHERE ".$querylang." ORDER BY `sid` DESC LIMIT ".$min.", ".$max);
if ($totalarticles > 0) {
    if($neconfig['columns'] == 1 || $neconfig['columns'] == 0) {
        include_once(NUKE_BASE_DIR.'header.php');
        ModuleNewsHeading();
        OpenTable();
        if($neconfig['readmore'] == 1) {
            echo $read_morepop;
        }
        if($neconfig['columns'] == 1) { // DUAL
            echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\n";
        }
    }
    $a = 0;
    $tabcount = 0;
    while ($row = $db->sql_fetchrow($newsresult)) {
        $artinfo    = ModuleNews_GetDBRow($querylang. 'AND `sid`="'.$row['sid'].'"', $display);
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
        if ($neconfig['texttype'] && $artinfo['introcount'] > 255 ) {
            $string_end = utf8_strpos($artinfo['hometext'], ' ', 255);
            if ($string_end > 270) {
                $artinfo['hometext'] = utf8_substr($artinfo['hometext'], 0, 255).'....';
            } else {
                $artinfo['hometext'] = utf8_substr($artinfo['hometext'], 0, $string_end).'....';
            }
        }
        $artinfo['morelink'] = $morelink . $artinfo['morelink'];
        if($neconfig['columns'] == 1) { // DUAL
            if ($a == 0) {
                echo "<tr>";
            }
            echo "<td valign='top' width='50%'>";
            themeindex($artinfo['aid'], $artinfo['informant'], $artinfo['datetime'], $artinfo['title'], $artinfo['counter'], $artinfo['topic'], $artinfo['hometext'], $artinfo['notes'], $artinfo['morelink'], $artinfo['topics']['topicname'], $artinfo['topics']['topicimage'], $artinfo['topics']['topictext'], $artinfo['informantwrites']);
            echo "</td>\n";
            $a++;
            if ($a == 2) {
                echo "</tr>"; $a = 0;
            } else {
                echo "<td>&nbsp;</td>";
            }
        } elseif ($neconfig['columns'] == 0) { // SINGLE
            themeindex($artinfo['aid'], $artinfo['informant'], $artinfo['datetime'], $artinfo['title'], $artinfo['counter'], $artinfo['topic'], $artinfo['hometext'], $artinfo['notes'], $artinfo['morelink'], $artinfo['topics']['topicname'], $artinfo['topics']['topicimage'], $artinfo['topics']['topictext'], $artinfo['informantwrites']);
        } else {
            if(!empty($artinfo['topics']['topicimage'])) {
                $t_image   = @evo_image(@basename($artinfo['topics']['topicimage']), 'Topics');
                $topic_img = "<a href='modules.php?name=News&amp;new_topic=".$artinfo['topic']."'><img src='".$t_image."' border='0' alt='".$artinfo['topics']['topictext']."' title='".$artinfo['topics']['topictext']."' /></a>\n";
            } else {
                $topic_img = '';
            }
            if (!empty($artinfo['notes'])) {
                $notes = "<span style='font-weight:bold;'>"._NOTE."</span>&nbsp;".$artinfo['notes']."\n";
            } else {
                $notes = '';
            }
            if(!$artinfo['informantwrites']) {
                $infowrites = _POSTEDBY.':&nbsp;';
                if(is_array($artinfo['informant'])) {
                    $infowrites .= "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$artinfo['informant'][0]."\">".$artinfo['informant'][1]."</a> ";
                } else {
                    $infowrites .= "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$artinfo['informant']."\">".$artinfo['informant']."</a> ";
                }
                $infowrites .= '&nbsp;'._ON.'&nbsp;'.$artinfo['datetime'];
            } else {
                $infowrites = '';
            }
//            $topictext = "<a href='modules.php?name=News&amp;new_topic=".$topic."'>".$topictext."</a>&nbsp;:&nbsp;".$title;
            $title     = "<span style='font-size:smaller;font-weight:bold;'>".$artinfo['title']."</span>";
            $tab[$tabcount]['title']      = $title;
            $tab[$tabcount]['content']    = $artinfo['hometext'];
            $tab[$tabcount]['topicimage'] = $topic_img;
            $tab[$tabcount]['morelink']   = $artinfo['morelink'];
            $tab[$tabcount]['datetime']   = $infowrites;
            $tabcount++;
        }
    }
    $db->sql_freeresult($newsresult);
    if ($neconfig['columns'] == 1) { // DUAL
        if ($a ==1) {
            echo "<td width='50%'>&nbsp;</td></tr>\n";
        } else {
            echo "</tr>\n";
        }
        echo "</table>\n";
    }
    if ($neconfig['columns'] == 0 || ($neconfig['columns'] == 1)){
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
                      echo "<option value='index.php?min=".$mintemp."'>".$counter."</option>\n";
                    } else {
                      echo "<option value='modules.php?name=".$module_name."&amp;min=".$mintemp."'>".$counter."</option>\n";
                    }
                }
                $counter++;
            }
            echo "</select><span style='font-weight:bold;'>"._NE_OF."&nbsp;".$articlepages."&nbsp;"._NE_PAGES."</span></td>\n</tr>\n";
            echo "</table>\n";
            echo "</form>\n";
        }
    } else {
        $tabstyle = "<style type='text/css'>";
        for ($i=0; $i< $tabcount; $i++) {
            $tabstyle .= "#NewsRotator #news-fragment-".$i." {
                            padding:15px 15px 15px 0px;
                            background:transparent no-repeat top left;
                            }";
        }
        $tabstyle .= "</style>";
        $more_styles = $tabstyle;
        $more_js     = "<script type=\"text/javascript\">
            $(document).ready(function(){
                $(\"#NewsRotator > ul\").tabs({fx:{opacity: \"toggle\"}}).tabs(\"rotate\", ".$neconfig['rotator_speed'].", true);
            });
        </script>";
        if($neconfig['readmore'] == 1) {
            $more_js .= $read_morepop;
        }
        $blockcontent  = "<div id='NewsRotator' style='width:100%; height:100%;'>";
        $blockcontent .= " <!-- Tabs -->";
        $blockcontent .= "    ";
        for ($i=0; $i< $tabcount; $i++) {
            if ($i == 0) {
                $blockcontent .= "    <div id='news-fragment-".$i."' class='ui-tabs-panel' style=''>";
            } else {
                $blockcontent .= "    <div id='news-fragment-".$i."' class='ui-tabs-panel ui-tabs-hide' style=''>";
            }
            $blockcontent .= "<div style='height:90%;'>";
            $blockcontent .= "<div style='height:10%;'>";
            $blockcontent .= "<h2>".(!empty($tab[$i]['topicimage']) ? $tab[$i]['topicimage'] : '').'&nbsp;&nbsp;'.$tab[$i]['title']."</h2>";
            $blockcontent .= "</div>";
            $blockcontent .= "<div style='height:7%;vertical-align:middle;'>";
            $blockcontent .= $tab[$i]['datetime'];
            $blockcontent .= "</div>";
            $blockcontent .= "<div style='height:75%;'>";
            $blockcontent .= $tab[$i]['content'];
            $blockcontent .= "</div>";
            $blockcontent .= "<div style='height:8%;'>";
            $blockcontent .= $tab[$i]['morelink'];
            $blockcontent .= "</div>";
            $blockcontent .= "</div>";
            $blockcontent .= "    </div>";
        }
        $blockcontent .= "<ul class='ui-tabs-nav' style='width:".$neconfig['rotator_width']."%;'>";
        for ($i=0; $i< $tabcount; $i++) {
            if ($i == 0) {
                $blockcontent .= "<li class='ui-tabs-nav-item ui-tabs-selected' id='news-navfragment-".$i."'><a href='#news-fragment-".$i."'><span>".($i+1)."</span></a></li>";
            } else {
                $blockcontent .= "<li class='ui-tabs-nav-item' id='news-navfragment-".$i."'><a href='#news-fragment-".$i."'><span>".($i+1)."</span></a></li>";
            }
        }
        $blockcontent .= "    </ul>";
        $blockcontent .= "</div><!-- end rotator -->";
        include_once(NUKE_BASE_DIR.'header.php');
        ModuleNewsHeading();
        OpenTable();
        echo "<div style='width:".$neconfig['rotator_width']."%; height:".$neconfig['rotator_height']."px;'>";
        echo '<div style="text-align:center;"><span style="font-weight:bold;">'._NEWS.'</span></div><br />';
        echo $blockcontent;
        echo "</div><br />";
    }
    CloseTable();
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo '<center><strong><br /><br />' ._NE_NONE_NEWS.'<br /><br /></strong>';
    if (!defined('HOME_FILE')) {
        echo _GOBACK;
    }
    echo "</center>";
    CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');

?>