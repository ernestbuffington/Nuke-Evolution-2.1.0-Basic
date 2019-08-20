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

if (!defined('MODULE_FILE') || !defined('IN_STATISTICS_MODULE') ) {
   die('You can\'t access this file directly...');
}

$now = explode('-', formatTimestamp(time(),'d-m-Y'));
$nowdate = $now[0];
$nowmonth = $now[1];
$nowyear = $now[2];

function Stats_Main() {
    global $db, $evoconfig, $module_name, $cache, $lang_new;
    $result  = $db->sql_query('SELECT `type`, `var`, `count` FROM `'._COUNTER_TABLE.'` ORDER BY `count` DESC, var');
    $browser = $os = array();
    $totalos = $totalbr = 0;
    while (list($type, $var, $count) = $db->sql_fetchrow($result)) {
        if ($type == 'browser') {
            $browser[$var] = $count;
        } elseif ($type == 'os') {
            if ($var == 'OS/2') { $var = 'OS2'; }
            $os[$var] = $count;
            $totalos += $count;
        }
    }
    $db->sql_freeresult($result);
    if ($totalos <= 1) {$totalos = 1;}
    $result = $db->sql_ufetchrow('SELECT SUM(hits) AS hits FROM `'._STATS_HOUR_TABLE.'`');
    $totalbr = $result['hits'];
    $db->sql_freeresult($result);
    $m_size = @getimagesize(evo_image_dir('mainbar.png', $module_name));
    title(EVO_SERVER_SITENAME.' '.$lang_new[$module_name]['STATS'], $module_name, 'stats-logo.png');
    OpenTable();
    echo '<table class="forumline" cellspacing="1" width="100%">
    <tr>
        <td colspan="3" class="row1">
            <div class="gen" align="center">'.$lang_new[$module_name]['WERECEIVED'].'&nbsp;<strong>'.$totalbr.'</strong>&nbsp;'.$lang_new[$module_name]['SPAGESVIEWS'].'&nbsp;'.$lang_new[$module_name]['SINCE'].'&nbsp;'.$evoconfig['startdate'].'<br /><br />
            
                [ <a href="modules.php?name='.$module_name.'&amp;op=stats">'.$lang_new[$module_name]['VIEWDETAILED'].'</a> ] [ <a href="modules.php?name=Forums&amp;file=statistics">'.$lang_new[$module_name]['VIEWFORUMSTATS'].'</a> ]</div><br />
        </td>
    </tr><tr>
        <td class="cat" colspan="3"><div class="cattitle" align="center">'.$lang_new[$module_name]['BROWSERS'].'</div></td>
    </tr>';
    $totalbr = 100 / $totalbr;
// Browsers
    if (is_array($browser)) {
        foreach ($browser AS $var => $count) {
            $perc = @round(($totalbr * $count), 2);
            $img_perc = @round(($totalbr * $count), 0);
            echo '<tr align="left">
            <td class="row1"><div class="gen"><img src="'. evo_image(strtolower($var).'.png', $module_name) .'" width="16" height="16" alt="" />&nbsp;'.$var.'</div></td>
            <td class="row2"><img src="'. evo_image('leftbar.png', $module_name) .'" alt="" /><img src="'. evo_image('mainbar.png', $module_name) .'" alt="" height="'.$m_size[1].'" width="'.$img_perc.'" /><img src="'. evo_image('rightbar.png', $module_name) .'" alt="" /></td>
            <td class="row3"><div class="gen">'.$perc.' % ('.$count.')</div></td>
        </tr>';
        }
    }
// Operating System
    $totalos = 100 / $totalos;
    echo '<tr>
        <td class="cat" colspan="3"><div class="cattitle" align="center">'.$lang_new[$module_name]['OPERATINGSYS'].'</div></td>
    </tr>';
    if (is_array($os)) {
        foreach ($os AS $var => $count) {
            $perc = @round(($totalos * $count), 2);
            $img_perc = @round(($totalos * $count), 0);
            echo '<tr align="left">
            <td class="row1"><div class="gen"><img src="'. evo_image(strtolower($var).'.png', $module_name) .'" width="16" height="16" alt="" />&nbsp;'.$var.':</div></td>
            <td class="row2"><img src="'. evo_image('leftbar.png', $module_name) .'" alt="" /><img src="'. evo_image('mainbar.png', $module_name) .'" alt="" height="'.$m_size[1].'" width="'.$img_perc.'" /><img src="'. evo_image('rightbar.png', $module_name) .'" alt="" /></td>
            <td class="row3"><div class="gen">'.$perc.' % ('.$count.')</div></td>
        </tr>';
        }
    }
// Miscellaneous Stats
    list($unum) = $db->sql_ufetchrow('SELECT COUNT(user_id) FROM `'._USERS_TABLE.'` WHERE `user_id` > 1 AND `user_active` > 0');
    list($snum) = $db->sql_ufetchrow('SELECT COUNT(sid) FROM `'._STORIES_TABLE.'`');
    list($cnum) = $db->sql_ufetchrow('SELECT COUNT(tid) FROM `'._COMMENTS_TABLE.'`');
    list($subnum) = $db->sql_ufetchrow('SELECT COUNT(qid) FROM `'._QUEUE_TABLE.'`');
    $evover = ucfirst(NUKE_EVO).' '.ucfirst(EVO_EDITION);

    echo '<tr>
        <td colspan="3" class="cat"><div class="cattitle" align="center">'.$lang_new[$module_name]['MISCSTATS'].'</div></td>
    </tr><tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('users.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['REGUSERS'].'</span></td><td class="row3"><span class="gen">'.$unum.'</span></td>
    </tr><tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('news.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['STORIESPUBLISHED'].'</span></td><td class="row3"><span class="gen">'.$snum.'</span></td>
    </tr>';
    if (is_active('Topics')) {
        list($tnum) = $db->sql_ufetchrow("SELECT COUNT(topicid) FROM `"._TOPICS_TABLE."`");
        echo '<tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('topics.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['SACTIVETOPICS'].'</span></td><td class="row3"><span class="gen">'.$tnum.'</span></td>
        </tr>';
    }
    echo '<tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('comments.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['COMMENTSPOSTED'].'</span></td><td class="row3"><span class="gen">'.$cnum.'</span></td>
        </tr>';
    if (is_active('Web_Links')) {
        list($links) = $db->sql_ufetchrow('SELECT COUNT(lid) FROM `'._WEBLINKS_LINKS_TABLE.'`');
        list($cat_links) = $db->sql_ufetchrow('SELECT COUNT(cid) FROM `'._WEBLINKS_CATEGORIES_TABLE.'`');
        echo '<tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('links.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['LINKSINLINKS'].'</span></td><td class="row3"><span class="gen">'.$links.'</span></td>
    </tr><tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('folder_link.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['LINKSCAT'].'</span></td><td class="row3"><span class="gen">'.$cat_links.'</span></td>
    </tr>';
    }
    if (is_active('Reviews')) {
        list($reviews) = $db->sql_ufetchrow('SELECT COUNT(rid) FROM `'._REVIEWS_REVIEWS_TABLE.'`');
        list($cat_reviews) = $db->sql_ufetchrow('SELECT COUNT(cid) FROM `'._REVIEWS_CATEGORIES_TABLE.'`');
        echo '<tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('reviews.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['REVIEWSINREVIEWS'].'</span></td><td class="row3"><span class="gen">'.$reviews.'</span></td>
    </tr><tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('folder_reviews.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['REVIEWSCAT'].'</span></td><td class="row3"><span class="gen">'.$cat_reviews.'</span></td>
    </tr>';
    }
    if (is_active('Downloads')) {
        list($reviews) = $db->sql_ufetchrow('SELECT COUNT(did) FROM `'._DOWNLOADS_DOWNLOADS_TABLE.'`');
        list($cat_reviews) = $db->sql_ufetchrow('SELECT COUNT(cid) FROM `'._DOWNLOADS_CATEGORIES_TABLE.'`');
        echo '<tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('downloads.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['DOWNLOADSINDOWNLOADS'].'</span></td><td class="row3"><span class="gen">'.$reviews.'</span></td>
    </tr><tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('folder_downloads.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['DOWNLOADSCAT'].'</span></td><td class="row3"><span class="gen">'.$cat_reviews.'</span></td>
    </tr>';
    }
    echo '<tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('waiting.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['NEWSWAITING'].'</span></td><td class="row3"><span class="gen">'.$subnum.'</span></td>
    </tr>';
    echo '<tr align="left">
        <td class="row1" colspan="2"><span class="gen"><img src="'. evo_image('version.png' ,$module_name).'" alt="" />&nbsp;'.$lang_new[$module_name]['EVOVER'].'</span></td><td class="row3"><span class="gen">'.ucfirst($evover).'</span></td>
    </tr></table>';
    CloseTable();
}

function Stats() {
    global $nowyear, $nowmonth, $nowdate, $evoconfig,  $db, $now, $module_name, $lang_new;

    list($total) = $db->sql_ufetchrow('SELECT SUM(hits) FROM `'._STATS_HOUR_TABLE."`");
    title(EVO_SERVER_SITENAME.' '.$lang_new[$module_name]['STATS'], $module_name, 'stats-logo.png');
    OpenTable();
    echo '<table class="forumline" cellspacing="1" width="100%">
    <tr>
        <td colspan="3" class="row1">
        <div class="gen" align="center">'.$lang_new[$module_name]['WERECEIVED'].'&nbsp;<strong>'.$total.'</strong>&nbsp;'.$lang_new[$module_name]['SPAGESVIEWS'].'&nbsp;'.$lang_new[$module_name]['SINCE'].'&nbsp;'.$evoconfig['startdate'].'<br /><br />
        <br /><br />'.$lang_new[$module_name]['TODAYIS'].": $now[0]/$now[1]/$now[2]<br />";

    list($year, $month, $hits) = $db->sql_ufetchrow("SELECT `year`, `month`, SUM(hits) as hits FROM `"._STATS_HOUR_TABLE."` GROUP BY `month`, `year` ORDER BY `hits` DESC LIMIT 0,1");
    echo $lang_new[$module_name]['MOSTMONTH'].": ".getmonth($month)." $year ($hits ".$lang_new[$module_name]['HITS'].")<br />";

    list($year, $month, $date, $hits) = $db->sql_ufetchrow("SELECT `year`, `month`, `date`, SUM(hits) as hits FROM `"._STATS_HOUR_TABLE."` GROUP BY `date`, `month`, `year` ORDER BY `hits` DESC LIMIT 0,1");
    echo $lang_new[$module_name]['MOSTDAY'].": $date ".getmonth($month)." $year ($hits ".$lang_new[$module_name]['HITS'].")<br />";

    list($year, $month, $date, $hour, $hits) = $db->sql_ufetchrow("SELECT `year`, `month`, `date`, `hour`, `hits` from `"._STATS_HOUR_TABLE."` ORDER BY `hits` DESC LIMIT 0,1");
    if ($hour < 10) {
        $hour = "0$hour:00 - 0$hour:59";
    } else {
        $hour = "$hour:00 - $hour:59";
    }
    echo $lang_new[$module_name]['MOSTHOUR'].": $hour ".$lang_new[$module_name]['ON']." ".getmonth($month)." $date, $year ($hits ".$lang_new[$module_name]['HITS'].")<br /><br />[ <a href=\"modules.php?name=".$module_name."\">".$lang_new[$module_name]['RETURNBASICSTATS']."</a> ]</div><br />&nbsp;</td></tr>";
    showYearStats($nowyear);
    showMonthStats($nowyear,$nowmonth);
    showDailyStats($nowyear,$nowmonth,$nowdate);
    showHourlyStats($nowyear,$nowmonth,$nowdate);
    echo '</table><br />';
    CloseTable();
}

function YearlyStats($year) {
    global $nowmonth, $module_name, $lang_new;
    title(EVO_SERVER_SITENAME.' '.$lang_new[$module_name]['STATS'], $module_name, 'stats-logo.png');
    OpenTable();
    echo '<table class="forumline" cellspacing="1" width="100%">';
    showMonthStats($year,$nowmonth);
    echo '</table><br />';
    echo "<center>[ <a href=\"modules.php?name=".$module_name."\">".$lang_new[$module_name]['BACKTOMAIN']."</a> | <a href=\"modules.php?name=$module_name&amp;op=stats\">".$lang_new[$module_name]['BACKTODETSTATS']."</a> ]</center>";
    CloseTable();
}

function MonthlyStats($year, $month) {
    global $nowdate, $module_name, $lang_new;
    title(EVO_SERVER_SITENAME.' '.$lang_new[$module_name]['STATS'], $module_name, 'stats-logo.png');
    OpenTable();
    echo '<table class="forumline" cellspacing="1" width="100%">';
    showDailyStats($year,$month,$nowdate);
    echo '</table><br />';
    echo "<center>[ <a href=\"modules.php?name=".$module_name."\">".$lang_new[$module_name]['BACKTOMAIN']."</a> | <a href=\"modules.php?name=".$module_name."&amp;op=stats\">".$lang_new[$module_name]['BACKTODETSTATS']."</a> ]</center>";
    CloseTable();
}

function DailyStats($year, $month, $date) {
    global $module_name, $lang_new;
    title(EVO_SERVER_SITENAME.' '.$lang_new[$module_name]['STATS'], $module_name, 'stats-logo.png');
    OpenTable();
    echo '<table class="forumline" cellspacing="1" width="100%">';
    showHourlyStats($year,$month,$date);
    echo '</table><br />';
    echo "<center>[ <a href=\"modules.php?name=".$module_name."\">".$lang_new[$module_name]['BACKTOMAIN']."</a> | <a href=\"modules.php?name=".$module_name."&amp;op=stats\">".$lang_new[$module_name]['BACKTODETSTATS']."</a> ]</center>";
    CloseTable();
}

function showYearStats($nowyear) {
    global $db, $module_name, $cache, $lang_new;
    if ((($m_size = $cache->load('m_size', 'config')) === false) || empty($m_size)) {
        $m_size = @getimagesize(evo_image_dir('mainbar.png', $module_name));
        $cache->save('m_size', 'config', $m_size);
    }
    if ((($l_size = $cache->load('l_size', 'config')) === false) || empty($l_size)) {
        $l_size = @getimagesize(evo_image_dir('leftbar.png', $module_name));
        $cache->save('l_size', 'config', $l_size);
    }
    if ((($r_size = $cache->load('r_size', 'config')) === false) || empty($r_size)) {
        $r_size = @getimagesize(evo_image_dir('rightbar.png', $module_name));
        $cache->save('r_size', 'config', $r_size);
    }
    list($TotalHitsYear) = $db->sql_ufetchrow("SELECT SUM(hits) AS TotalHitsYear FROM `"._STATS_HOUR_TABLE."`");
    $result = $db->sql_query("SELECT `year`, SUM(hits) FROM `"._STATS_HOUR_TABLE."` GROUP BY `year` ORDER BY year");
    echo '<tr>
        <td colspan="3" class="cat"><div class="cattitle" align="center">'.$lang_new[$module_name]['YEARLYSTATS'].'</div></td>
    </tr><tr>
        <td width="25%" class="row2"><span class="gen"><strong>'.$lang_new[$module_name]['YEAR'].'</strong></span></td><td colspan="2" class="row2"><span class="gen"><strong>'.$lang_new[$module_name]['SPAGESVIEWS'].'</strong></span></td>
    </tr>';
    while (list($year,$hits) = $db->sql_fetchrow($result)){
        echo '<tr>
        <td class="row1"><span class="gen">';
        if ($year != $nowyear) {
            echo '<a href="modules.php?name='.$module_name.'&amp;op=yearly&amp;year='.$year.'">'.$year.'</a>';
        } else {
            echo $year;
        }
        echo '</span></td><td class="row1" nowrap="nowrap">';
        $WidthIMG = @round(100 * $hits/$TotalHitsYear,0);
        echo "<img src=\"". evo_image('leftbar.png', $module_name) ."\" alt=\"\" width=\"".$l_size[0]."\" height=\"".$l_size[1]."\" />";
        echo "<img src=\"". evo_image('mainbar.png', $module_name) ."\" height=\"".$m_size[1]."\" width=\"".($WidthIMG * 2)."\" alt=\"\" />";
        echo "<img src=\"". evo_image('rightbar.png', $module_name) ."\" alt=\"\" width=\"".$r_size[0]."\" height=\"".$r_size[1]."\" /></td><td class=\"row1\"><span class=\"gen\">$hits</span></td>
    </tr>";
    }
    $db->sql_freeresult($result);
}

function showMonthStats($nowyear, $nowmonth) {
    global $db, $module_name, $cache, $lang_new;
    if ((($m_size = $cache->load('m_size', 'config')) === false) || empty($m_size)) {
        $m_size = @getimagesize(evo_image_dir('mainbar.png', $module_name));
        $cache->save('m_size', 'config', $m_size);
    }
    if ((($l_size = $cache->load('l_size', 'config')) === false) || empty($l_size)) {
        $l_size = @getimagesize(evo_image_dir('leftbar.png', $module_name));
        $cache->save('l_size', 'config', $l_size);
    }
    if ((($r_size = $cache->load('r_size', 'config')) === false) || empty($r_size)) {
        $r_size = @getimagesize(evo_image_dir('rightbar.png', $module_name));
        $cache->save('r_size', 'config', $r_size);
    }
    list($TotalHitsMonth) = $db->sql_ufetchrow("SELECT sum(hits) AS TotalHitsMonth FROM `"._STATS_HOUR_TABLE."` WHERE `year`='$nowyear'");
    echo '<tr>
        <td colspan="3" class="cat"><div class="cattitle" align="center">'.$lang_new[$module_name]['MONTLYSTATS'].' '.$nowyear.'</div></td>
    </tr><tr>
        <td width="25%" class="row2"><span class="gen"><strong>'.$lang_new[$module_name]['MONTH'].'</strong></span></td><td class="row2" colspan="2"><span class="gen"><strong>'.$lang_new[$module_name]['SPAGESVIEWS'].'</strong></span></td>
    </tr>';
    $result = $db->sql_query("SELECT month, SUM(hits) FROM "._STATS_HOUR_TABLE." WHERE year='$nowyear' GROUP BY month ORDER BY month");
    while (list($month,$hits) = $db->sql_fetchrow($result)){
        echo '<tr>
        <td class="row1"><span class="gen">';
        if ($month != $nowmonth) {
            echo "<a href=\"modules.php?name=".$module_name."&amp;op=monthly&amp;year=$nowyear&amp;month=$month\">".getmonth($month)."</a>";
        } else {
            echo getmonth($month);
        }
        echo '</span></td><td class="row1" nowrap="nowrap">';
        $WidthIMG = @round(100 * $hits/$TotalHitsMonth,0);
        echo '<img src="'. evo_image('leftbar.png', $module_name) .'" alt="" width="'.$l_size[0].'" height="'.$l_size[1].'" />';
        echo '<img src="'. evo_image('mainbar.png', $module_name) .'" alt ="" width="'.($WidthIMG * 2).'" height="'.$m_size[1].'" />';
        echo '<img src="'. evo_image('rightbar.png', $module_name) .'" alt="" width="'.$r_size[0].'" height="'.$r_size[1].'" /></td><td class="row1"><span class="gen">'.$hits.'</span></td></tr>';
    }
    $db->sql_freeresult($result);
}

function showDailyStats($year, $month, $nowdate) {
    global $db, $module_name, $cache, $lang_new;
    if ((($m_size = $cache->load('m_size', 'config')) === false) || empty($m_size)) {
        $m_size = @getimagesize(evo_image_dir('mainbar.png', $module_name));
        $cache->save('m_size', 'config', $m_size);
    }
    if ((($l_size = $cache->load('l_size', 'config')) === false) || empty($l_size)) {
        $l_size = @getimagesize(evo_image_dir('leftbar.png', $module_name));
        $cache->save('l_size', 'config', $l_size);
    }
    if ((($r_size = $cache->load('r_size', 'config')) === false) || empty($r_size)) {
        $r_size = @getimagesize(evo_image_dir('rightbar.png', $module_name));
        $cache->save('r_size', 'config', $r_size);
    }

    $result = $db->sql_query("SELECT `date`, SUM(hits) as `hits` FROM `"._STATS_HOUR_TABLE."` WHERE `year`='$year' AND `month`='$month' GROUP BY `date` ORDER BY `date`");
    $TotalHitsDate = $date = 0;
    $days = array();
    while ($row = $db->sql_fetchrow($result)) {
        $TotalHitsDate = $TotalHitsDate + $row['hits'];
        $date++;
        while ($date < $row['date']) {
            $days[] = array('date'=>$date, 'hits'=>0);
            $date++;
        }
        $days[] = $row;
    }
    $db->sql_freeresult($result);
    echo '<tr>
        <td colspan="3" class="cat"><div class="cattitle" align="center">'.$lang_new[$module_name]['DAILYSTATS'].' '.getmonth($month).', '.$year.'</div></td>
    </tr><tr>
        <td width="25%" class="row2"><span class="gen"><strong>'.$lang_new[$module_name]['DATE'].'</strong></span></td><td class="row2" colspan="2"><span class="gen"><strong>'.$lang_new[$module_name]['SPAGESVIEWS'].'</strong></span></td>
    </tr>';
    foreach ($days as $day) {
        $date = $day['date'];
        $hits = $day['hits'];
        echo '<tr>
        <td class="row1"><span class="gen">';
        if ($date != $nowdate && $hits > 0 ) {
            echo '<a href="modules.php?name='.$module_name.'&amp;op=daily&amp;year='.$year.'&amp;month='.$month.'&amp;date='.$date.'">'.$date.'</a>';
        } else {
            echo $date;
        }
        echo '</span></td><td class="row1" nowrap="nowrap">';
        if ($hits == 0) {
            $WidthIMG = 0;
            $d_percent = 0;
        } else {
            $WidthIMG = @round(100 * $hits/$TotalHitsDate,0);
            $d_percent = @substr(100 * $hits / $TotalHitsDate, 0, 5);
        }
        echo "<img src=\"". evo_image('leftbar.png', $module_name) ."\" alt=\"\" width=\"".$l_size[0]."\" height=\"".$l_size[1]."\" />";
        echo "<img src=\"". evo_image('mainbar.png', $module_name) ."\" height=\"".$m_size[1]."\" width=\"".($WidthIMG * 2)."\" alt=\"\" />";
        echo "<img src=\"". evo_image('rightbar.png', $module_name) ."\" alt=\"\" width=\"".$r_size[0]."\" height=\"".$r_size[1]."\" /></td><td class=\"row1\"><span class=\"gen\">$hits ($d_percent%)</span></td>
    </tr>";
    }
}

function showHourlyStats($year, $month, $date) {
    global $db, $module_name, $cache, $lang_new;
    if ((($m_size = $cache->load('m_size', 'config')) === false) || empty($m_size)) {
        $m_size = @getimagesize(evo_image_dir('mainbar.png', $module_name));
        $cache->save('m_size', 'config', $m_size);
    }
    if ((($l_size = $cache->load('l_size', 'config')) === false) || empty($l_size)) {
        $l_size = @getimagesize(evo_image_dir('leftbar.png', $module_name));
        $cache->save('l_size', 'config', $l_size);
    }
    if ((($r_size = $cache->load('r_size', 'config')) === false) || empty($r_size)) {
        $r_size = @getimagesize(evo_image_dir('rightbar.png', $module_name));
        $cache->save('r_size', 'config', $r_size);
    }
    list($TotalHitsHour) = $db->sql_ufetchrow('SELECT SUM(hits) AS TotalHitsHour FROM `'._STATS_HOUR_TABLE."` WHERE `year`='$year' AND `month`='$month' AND `date`='$date'");
    $nowdate = date('d-m-Y');
    $nowdate_arr = explode('-', $nowdate);
    echo '<tr>
        <td colspan="3" class="cat"><div class="cattitle" align="center">'.$lang_new[$module_name]['HOURLYSTATS'].' '.getmonth($month).' '.$date.', '.$year.'</div></td>
    </tr><tr>
        <td width="25%" class="row2"><span class="gen"><strong>'.$lang_new[$module_name]['HOUR'].'</strong></span></td>
        <td class="row2" colspan="2"><span class="gen"><strong>'.$lang_new[$module_name]['SPAGESVIEWS'].'</strong></span></td>
    </tr>';
    for ($k = 0;$k<=23;$k++) {
    $result = $db->sql_query("SELECT hour, hits FROM "._STATS_HOUR_TABLE." WHERE year='$year' AND month='$month' AND date='$date' AND hour='$k'");
    if ($db->sql_numrows($result) == 0){
        $hits=0;
    } else {
        list($hour,$hits) = $db->sql_fetchrow($result);
    }
    $db->sql_freeresult($result);
    $a = ($k < 10) ? "0$k" : $k;
    echo '<tr>
        <td class="row1"><span class="gen">';
    echo "$a:00 - $a:59";
    $a = '';
    echo '</span></td><td class="row1" nowrap="nowrap">';
    if ($hits == 0) {
        $WidthIMG = $d_percent = 0;
    } else {
        $WidthIMG = @round(100 * $hits/$TotalHitsHour,0);
        $d_percent = @substr(100 * $hits / $TotalHitsHour, 0, 5);
    }
    echo "<img src=\"". evo_image('leftbar.png', $module_name) ."\" alt=\"\" width=\"".$l_size[0]."\" height=\"".$l_size[1]."\" />";
    echo "<img src=\"". evo_image('mainbar.png', $module_name) ."\" height=\"".$m_size[1]."\" width=\"".($WidthIMG * 2)."\" alt=\"\" />";
    echo "<img src=\"". evo_image('rightbar.png', $module_name) ."\" alt=\"\" width=\"".$r_size[0]."\" height=\"".$r_size[1]."\" /></td><td class=\"row1\"><span class=\"gen\">$hits ($d_percent%)</span></td></tr>";
    }
}

function getmonth($month) {
    $month = intval($month);
    $months = array(1=>_JANUARY, _FEBRUARY, _MARCH, _APRIL, _MAY, _JUNE, _JULY, _AUGUST, _SEPTEMBER, _OCTOBER, _NOVEMBER, _DECEMBER);
    return (array_key_exists($month, $months) ? $months[$month] : '');
}

?>