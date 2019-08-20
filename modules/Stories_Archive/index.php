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

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
$module_name = basename(dirname(__FILE__));

$lang_path = NUKE_BASE_DIR . 'language/evo/';
if (@file_exists($lang_path . 'time_' . $currentlang . '.php')) {
    include_once($lang_path . 'time_' . $currentlang . '.php');
} elseif (@file_exists($lang_path . 'time_' . $board_config['default_lang'] . '.php')) {
    include_once($lang_path . 'time_' . $board_config['default_lang'] . '.php');
} else {
    DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $module_name);
}
get_lang($module_name);

function StoriesArchiveHeading($text='') {
    global $module_name;
    title($text, $module_name, 'stories-logo.png');
}

function select_month() {
    global $db, $module_name, $langtime;
    
    // Get oldest storydate + difference in months (count from today) from table
    $oldest = $db->sql_ufetchrow("SELECT DATE_FORMAT(`time`, '%Y%m') as oldest, PERIOD_DIFF(FROM_UNIXTIME(".time().", '%Y%m'), DATE_FORMAT(`time`, '%Y%m'))+1 as diff 
                FROM `"._STORIES_TABLE."` ORDER BY `time` ASC LIMIT 1");
    include_once(NUKE_BASE_DIR.'header.php');
    StoriesArchiveHeading();
    OpenTable();
    echo "<fieldset><legend><strong>"._STORIESARCHIVE."</strong></legend><br />";
    echo "<center><span class=\"content\">"._SELECTMONTH2VIEW."</span><br /><br /></center><br />";
    echo "<center><ul>";
    for($i=0; $i <= $oldest['diff']; $i++) {
        $temp_result = $db->sql_ufetchrow("SELECT count(`sid`) as stories, DATE_FORMAT(DATE_SUB(now(), INTERVAL '".$i."' MONTH), '%Y') as year, DATE_FORMAT(DATE_SUB(now(), INTERVAL '".$i."' MONTH), '%m') as nummonth, DATE_FORMAT(DATE_SUB(now(), INTERVAL '".$i."' MONTH), '%b') as charmonth 
                            FROM `"._STORIES_TABLE."` 
                            WHERE UNIX_TIMESTAMP(`time`) < UNIX_TIMESTAMP(DATE_FORMAT(DATE_SUB(DATE_FORMAT(now(), '%Y-%m-01 00:00:00'), INTERVAL '".($i-1)."' MONTH), '%Y-%m-01 00:00:00'))
                            AND   UNIX_TIMESTAMP(`time`) > UNIX_TIMESTAMP(DATE_FORMAT(DATE_SUB(DATE_FORMAT(now(), '%Y-%m-01 00:00:00'), INTERVAL '".$i."' MONTH), '%Y-%m-01 00:00:00'))");
        echo "<li><a href=\"modules.php?name=$module_name&amp;sa=show_month&amp;year=".$temp_result['year']."&amp;month=".$temp_result['nummonth']."&amp;month_l=".$temp_result['charmonth']."\">".$temp_result['year']." - ". $langtime['datetime'][$temp_result['charmonth']]." (".$temp_result['stories'].")</a></li>";
    }        
    echo "</ul></center>"
    ."<center>"
    ."<form action=\"modules.php?name=Search\" method=\"post\">"
    ."<input type=\"text\" name=\"query\" size=\"30\" />&nbsp;"
    ."<input type=\"submit\" value=\""._SEARCH."\" />"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$module_name&amp;sa=show_all\">"._SHOWALLSTORIES."</a> ]</center>";
    echo "<br /></fieldset>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function show_month($year, $month, $month_l) {
    global $userinfo, $db, $bgcolor1, $bgcolor2, $evoconfig, $currentlang, $module_name, $langtime;

    $actualtime = actualTime();
    $month_l    = $langtime['datetime'][$month_l];
    include_once(NUKE_BASE_DIR.'header.php');
    StoriesArchiveHeading("$month_l $year");
    $r_options = '';
    if(is_user()) {
      if (isset($userinfo['umode'])) { $r_options .= "&amp;umode=".$userinfo['umode']; }
      if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
      if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
    }
    OpenTable();

    echo "<table summary=\""._STORIESARCHIVE." $month_l $year\" border=\"1\" width=\"100%\">"
        ."<caption><span class=\"title\"><strong>"._STORIESARCHIVE."</strong></span></caption>\n"
        ."<thead>"
           ."<tr>"
              ."<th class=\"row3\" align=\"left\"><strong>&nbsp;</strong></th>"   
              ."<th class=\"row3\" align=\"left\"><strong>"._ARTICLES."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._COMMENTS."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._READS."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._USCORE."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._STORIESDATE."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._ACTIONS."</strong></th>"
          ."</tr>"
        ."</thead>"
        ."<tbody>";

    $result = $db->sql_query("SELECT sid, catid, title, UNIX_TIMESTAMP(time) as time, comments, counter, topic, alanguage, score, ratings FROM "._STORIES_TABLE." WHERE time >= '$year-$month-01 00:00:00' AND time <= '$year-$month-31 23:59:59' AND time <= '".$actualtime."' ORDER BY sid DESC");
    while ($row = $db->sql_fetchrow($result)) {
        $sid = intval($row['sid']);
        $catid = intval($row['catid']);
        $title = check_words(stripslashes(check_html($row['title'], "nohtml")));
        $time = formatTimestamp($row['time']);
        $comments = intval($row['comments']);
        $counter = ($row['counter'] > 0 ? intval($row['counter']) : 0);
        $topic = intval($row['topic']);
        $alanguage = $row['alanguage'];
        $score = intval($row['score']);
        $ratings = intval($row['ratings']);
        $actions = "<a href=\"modules.php?name=News&amp;op=print&amp;sid=$sid\"><img src='".evo_image('print.png', $module_name)."' border='0' alt='"._PRINTER."' title='"._PRINTER."' /></a>&nbsp;<a href=\"modules.php?name=News&amp;op=friend&amp;op=FriendSend&amp;sid=$sid\"><img src='".evo_image('friend.png', $module_name)."' border='0' alt='"._FRIEND."' title='"._FRIEND."' /></a>";
        if ($ratings > 0) {
            $r_image = round($score / $ratings);
            if ($r_image == 1) {
                    $the_image = "<img src='".evo_image('stars-1.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            } elseif ($r_image == 2) {
                    $the_image = "<img src='".evo_image('stars-2.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            } elseif ($r_image == 3) {
                    $the_image = "<img src='".evo_image('stars-3.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            } elseif ($r_image == 4) {
                    $the_image = "<img src='".evo_image('stars-4.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            } elseif ($r_image == 5) {
                    $the_image = "<img src='".evo_image('stars-5.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            }
        } else {
            $the_image = '';
        }
        if ($catid == 0) {
            $title = "<a href=\"modules.php?name=News&amp;op=article&amp;sid=$sid$r_options\">$title</a>";
        } elseif ($catid != 0) {
            $row_res = $db->sql_fetchrow($db->sql_query("SELECT title FROM "._STORIES_CATEGORIES_TABLE." WHERE catid='$catid'"));
            $cat_title = check_words($row_res['title']);
            $title = "<a href=\"modules.php?name=News&amp;op=categories&amp;op=newindex&amp;catid=$catid\"><em>$cat_title</em></a>: <a href=\"modules.php?name=News&amp;op=article&amp;sid=$sid$r_options\">$title</a>";
        }
        if ($evoconfig['multilingual'] == 1) {
            if (empty($alanguage)) {
            $alanguage = $currentlang;
            }
            $alt_language = ucfirst($alanguage);
            $lang_img = "<img src=\"images/language/flag-$alanguage.png\" border=\"0\" hspace=\"2\" alt=\"$alt_language\" title=\"$alt_language\" />";
        } else {
            $lang_img = "<strong><big><strong>&middot;</strong></big></strong>";
        }
        if ($evoconfig['articlecomm'] == 0) {
            $comments = 0;
        }
        echo    "<tr>"               
                  ."<td class=\"row3\" align=\"left\">$lang_img</td>" 
                  ."<td class=\"rowhc\" align=\"left\">$title</td>"
                  ."<td class=\"row3\" align=\"center\">$comments</td>"
                  ."<td class=\"row2\" align=\"center\">$counter</td>"
                  ."<td class=\"row3\" align=\"center\">$the_image</td>"
                  ."<td class=\"row2\" align=\"center\">$time</td>"
                  ."<td class=\"row3\" align=\"center\">$actions</td>"                  
                 ."</tr>";            
            
    }
    $db->sql_freeresult($result);
    echo "<tr><td colspan=\"7\" class=\"row3\" >&nbsp;</td></tr>";
    echo "</tbody>"
        ."</table>"
    ."<br /><br />"
    ."<hr size=\"1\" noshade=\"noshade\"/>"
    ."<br />";
    echo "<center>"
    ."<form action=\"modules.php?name=Search\" method=\"post\">"
    ."<input type=\"text\" name=\"query\" size=\"30\" />&nbsp;"
    ."<input type=\"submit\" value=\""._SEARCH."\" />"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$module_name\">"._ARCHIVESINDEX."</a> | <a href=\"modules.php?name=$module_name&amp;sa=show_all\">"._SHOWALLSTORIES."</a> ]</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function show_all($min) {
    global $db, $evoconfig, $currentlang, $module_name, $userinfo, $langtime;

    $actualtime = actualTime();
    $max = 250;
    include_once(NUKE_BASE_DIR.'header.php');
    StoriesArchiveHeading();
    title(''._ALLSTORIESARCH);
    $r_options = '';
    if(is_user()) {
      if (isset($userinfo['umode'])) { $r_options .= "&amp;umode=".$userinfo['umode']; }
      if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
      if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
    }
    OpenTable();
    
    echo "<table summary=\""._ALLSTORIESARCH."\" border=\"1\" width=\"100%\">"
        ."<caption><span class=\"title\"><strong>"._STORIESARCHIVE."</strong></span></caption>\n"
        ."<thead>"
           ."<tr>"
              ."<th class=\"row3\" align=\"left\"><strong>&nbsp;</strong></th>"   
              ."<th class=\"row3\" align=\"left\"><strong>"._ARTICLES."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._COMMENTS."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._READS."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._USCORE."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._DATE."</strong></th>"
              ."<th class=\"row3\" align=\"center\"><strong>"._ACTIONS."</strong></th>"
          ."</tr>"
        ."</thead>"
        ."<tbody>";
        
    
    $result = $db->sql_query("SELECT sid, catid, title, UNIX_TIMESTAMP(time) as time, comments, counter, topic, alanguage, score, ratings FROM "._STORIES_TABLE." WHERE time <= now() ORDER BY sid DESC LIMIT $min,$max");
    $numrows = $db->sql_numrows($db->sql_query("SELECT sid FROM "._STORIES_TABLE." WHERE time <= '".$actualtime."'"));
    while($row = $db->sql_fetchrow($result)) {
        $sid = intval($row['sid']);
        $catid = intval($row['catid']);
        $title = check_words(stripslashes(check_html($row['title'], "nohtml")));
        $time = formatTimestamp($row['time']);
        $comments = intval($row['comments']);
        $counter = ($row['counter'] > 0 ? intval($row['counter']) : 0);
        $topic = intval($row['topic']);
        $alanguage = $row['alanguage'];
        $score = intval($row['score']);
        $ratings = intval($row['ratings']);
        $actions = "<a href=\"modules.php?name=News&amp;op=print&amp;sid=$sid\"><img src='".evo_image('print.png', $module_name)."' border='0' alt='"._PRINTER."' title='"._PRINTER."' /></a>&nbsp;<a href=\"modules.php?name=News&amp;op=friend&amp;op=FriendSend&amp;sid=$sid\"><img src='".evo_image('friend.png', $module_name)."' border='0' alt='"._FRIEND."' title='"._FRIEND."' /></a>";
        if ($ratings > 0) {
            $r_image = round($score / $ratings);
            if ($r_image == 1) {
                    $the_image = "<img src='".evo_image('stars-1.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            } elseif ($r_image == 2) {
                    $the_image = "<img src='".evo_image('stars-2.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            } elseif ($r_image == 3) {
                    $the_image = "<img src='".evo_image('stars-3.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            } elseif ($r_image == 4) {
                    $the_image = "<img src='".evo_image('stars-4.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            } elseif ($r_image == 5) {
                    $the_image = "<img src='".evo_image('stars-5.png', 'News')."' title='"._NE_COUNTRATINGS." ".$ratings."' alt='' border='0' />";
            }
        } else {
            $the_image = '';
        }
        if ($catid == 0) {
            $title = "<a href=\"modules.php?name=News&amp;op=article&amp;sid=$sid$r_options\">$title</a>";
        } elseif ($catid != 0) {
            $row_res = $db->sql_fetchrow($db->sql_query("SELECT title from "._STORIES_CATEGORIES_TABLE." WHERE catid='$catid'"));
            $cat_title = check_words(stripslashes($row_res['title']));
            $title = "<a href=\"modules.php?name=News&amp;op=categories&amp;op=newindex&amp;catid=$catid\"><em>$cat_title</em></a>: <a href=\"modules.php?name=News&amp;op=article&amp;sid=$sid$r_options\">$title</a>";
        }
        if ($evoconfig['multilingual'] == 1) {
            if (empty($alanguage)) {
                $alanguage = $currentlang;
            }
            $alt_language = ucfirst($alanguage);
            $lang_img = "<img src=\"images/language/flag-$alanguage.png\" border=\"0\" hspace=\"2\" alt=\"$alt_language\" title=\"$alt_language\" />";
        } else {
            $lang_img = "<strong><big><strong>&middot;</strong></big></strong>";
        }
        
        
        echo    "<tr>"               
                  ."<td class=\"row3\" align=\"left\">$lang_img</td>" 
                  ."<td class=\"rowhc\" align=\"left\">$title</td>"
                  ."<td class=\"row3\" align=\"center\">$comments</td>"
                  ."<td class=\"row2\" align=\"center\">$counter</td>"
                  ."<td class=\"row3\" align=\"center\">$the_image</td>"
                  ."<td class=\"row2\" align=\"center\">$time</td>"
                  ."<td class=\"row3\" align=\"center\">$actions</td>"                  
                 ."</tr>";  
    }
    $db->sql_freeresult($result);
        echo "<tr><td colspan=\"7\" class=\"row3\" >&nbsp;</td></tr>";
    echo "</tbody>"
        ."</table>"
    ."<br /><br />"
    ."<hr size=\"1\" noshade=\"noshade\"/>"
    ."<br />";
    $a = 0;
    if (($numrows > 250) && ($min == 0)) {
        $min = $min+250;
        $a++;
        echo "<center>[ <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$min\">"._NEXTPAGE."</a> ]</center><br />";
    }
    if (($numrows > 250) && ($min >= 250) && ($a != 1)) {
        $pmin = $min-250;
        $min = $min+250;
        $a++;
        echo "<center>[ <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$pmin\">"._PREVIOUSPAGE."</a> | <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$min\">"._NEXTPAGE."</a> ]</center><br />";
    }
    if (($numrows <= 250) && ($a != 1) && ($min != 0)) {
        $pmin = $min-250;
        echo "<center>[ <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$pmin\">"._PREVIOUSPAGE."</a> ]</center><br />";
    }
  
    echo "<center>"
    ."<form action=\"modules.php?name=Search\" method=\"post\">"
    ."<input type=\"text\" name=\"query\" size=\"30\" />&nbsp;"
    ."<input type=\"submit\" value=\""._SEARCH."\" />"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$module_name\">"._ARCHIVESINDEX."</a> ]</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

global $_GETVAR, $currentlang;

$sa         = $_GETVAR->get('sa', '_REQUEST');
$min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
$year       = $_GETVAR->get('year', '_REQUEST', 'int', 0);
$month      = $_GETVAR->get('month', '_REQUEST', 'int', 0);
$month_l    = $_GETVAR->get('month_l', '_REQUEST');

switch($sa) {

    case 'show_all':
        show_all($min);
    break;

    case 'show_month':
        show_month($year, $month, $month_l);
    break;

    default:
        select_month();
    break;

}

?>