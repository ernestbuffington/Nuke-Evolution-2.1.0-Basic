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

if (!defined('MODULE_FILE') ) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = _SURVEYS;

global $db, $_GETVAR, $userinfo, $currentlang, $evoconfig;

$op         = $_GETVAR->get('op', '_REQUEST');
$pollID     = $_GETVAR->get('pollID', '_REQUEST', 'int');
$voteID     = $_GETVAR->get('voteID', '_REQUEST', 'int');
$forwarder  = $_GETVAR->get('forwarder', '_REQUEST');
$mode       = $_GETVAR->get('mode', '_REQUEST');
$r_options  = '';

if(!isset($pollID)) {
    include_once(NUKE_BASE_DIR.'header.php');
    title(_SURVEYSWELCOME, $module_name, 'surveys-logo.png');
    OpenTable();
    pollList();
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} elseif(isset($forwarder)) {
    pollCollector($pollID, $voteID, $forwarder);   
} elseif($op == 'results' && $pollID > 0) {
    include_once(NUKE_BASE_DIR.'header.php');  
    title(_CURRENTPOLLRESULTS, $module_name, 'surveys-logo.png');
    echo "<br /><table border='0' width='100%'><tr><td width='70%' valign='top'>";
    OpenTable();
    pollResults($pollID);
    CloseTable();
    echo "</td><td>&nbsp;</td><td width='30%' valign='top'>";
    OpenTable();
    echo "<strong>"._LAST5POLLS." ".EVO_SERVER_SITENAME."</strong><br /><br />";
    if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
    if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
    if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
    $querylang = '';
    if ($evoconfig['multilingual']) { $querylang = "AND planguage='$currentlang' OR planguage=''"; }
    $resu = $db->sql_query("SELECT p.pollID, p.pollTitle, SUM(pd.optionCount) FROM "._POLL_DESC_TABLE." p, "._POLL_DATA_TABLE." pd where p.artid='0' and p.pollID=pd.pollID $querylang GROUP BY pd.pollID ORDER BY p.timeStamp DESC LIMIT 1,6");
    while (list($plid, $pltitle, $plvoters) = $db->sql_fetchrow($resu)) {
        if ($pollID == $plid) {
            echo "<img src=\"". evo_image('arrow.png', 'evo') ."\" border=\"0\" alt=\"\" />&nbsp;$pltitle ($plvoters "._LVOTES.")<br /><br />";
        } else {
            echo "<img src=\"". evo_image('arrow.png', 'evo') ."\" border=\"0\" alt=\"\" />&nbsp;<a href=\"modules.php?name=$module_name&amp;op=results&amp;pollID=$plid$r_options\">$pltitle</a> ($plvoters "._LVOTES.")<br /><br />";
        }
    }
    $db->sql_freeresult($resu);
    echo "<a href=\"modules.php?name=$module_name\"><strong>"._MOREPOLLS."</strong></a>";
    CloseTable();
    echo "</td></tr></table>";
    if ( empty($mode) OR ($mode != 'nocomments') ) {
        if (!defined('IN_SURVEY')) {
            define('IN_SURVEY', TRUE);
        }
        include(NUKE_MODULES_DIR . $module_name . '/comments.php');
    }
    include_once(NUKE_BASE_DIR.'footer.php');
} elseif($voteID > 0) {
    pollCollector($pollID, $voteID);
} elseif($pollID != pollLatest()) {
    include_once(NUKE_BASE_DIR.'header.php');
    title(_SURVEYSWELCOME, $module_name, 'surveys-logo.png');
    OpenTable();
    echo "<br /><br /><table border=\"0\" align=\"center\" width='100%'><tr align='center'><td align='center'>";
    pollMain($pollID);
    echo "</td></tr></table>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    title(_CURRENTSURVEY, $module_name, 'surveys-logo.png');
    OpenTable();
    echo "<br /><br /><table border='0' align='center' width='100%'><tr align='center'><td align='center'>";
    pollMain(pollLatest());
    echo "</td></tr></table>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

/*********************************************************/
/* Functions                                             */
/*********************************************************/

function pollMain($pollID) {
    global $module_name, $content;
    if(!isset($pollID)) $pollID = 1;
    include_once(NUKE_MODULES_DIR.$module_name.'/includes/pollblock.php');
    themesidebox(_SURVEY, $content, "poll1");
}

function pollLatest() {
    global $evoconfig, $currentlang, $db;
    $querylang = '';
    if ($evoconfig['multilingual']) { $querylang = "AND planguage='$currentlang' OR planguage=''"; }
    $result = $db->sql_query("SELECT pollID FROM "._POLL_DESC_TABLE." WHERE artid='0' $querylang ORDER BY pollID DESC LIMIT 1");
    $pollID = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    return($pollID[0]);
}

function pollCollector($pollID, $voteID, $forwarder) {
    global $db, $evoconfig, $userinfo;
    $ip = identify::get_ip();
    $number_of_days = intval($evoconfig['poll_days']);
    $past = time()-86400*$number_of_days;
    $db->sql_query("DELETE FROM "._POLL_CHECK_TABLE." WHERE time < $past");
    $result = $db->sql_query("SELECT ip FROM "._POLL_CHECK_TABLE." WHERE ip='$ip' AND pollID='$pollID'");
    $ips = $db->sql_fetchrow($result);
    $uid = '';
    if ($userinfo['user_id'] != ANONYMOUS) {
        $result = $db->sql_query("SELECT ip FROM "._POLL_CHECK_TABLE." WHERE ip='".$userinfo['user_id']."' AND pollID='$pollID'");
        $uid = $db->sql_fetchrow($result);
    }
    if (empty($ips) && empty($uid)) {
        $ctime = time();
        $db->sql_query("INSERT INTO "._POLL_CHECK_TABLE." (ip, time, pollID) VALUES ('$ip', '$ctime', '$pollID')");
        if ($userinfo['user_id'] != ANONYMOUS) {
            $db->sql_uquery("INSERT INTO "._POLL_CHECK_TABLE." (ip, time, pollID) VALUES ('".$userinfo['user_id']."', '$ctime', '$pollID')");
        }
        $db->sql_uquery("UPDATE "._POLL_DATA_TABLE." SET optionCount=optionCount+1 WHERE pollID='$pollID' AND voteID='$voteID'");
        if (!empty($voteID)) {
            $db->sql_uquery("UPDATE "._POLL_DESC_TABLE." SET voters=voters+1 WHERE pollID='$pollID'");
        }
    }
    redirect($forwarder);
    exit;
}

function pollList() {
    global $userinfo, $evoconfig, $currentlang, $db, $module_name, $admin_file;

    $r_options = '';
    if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
    if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
    if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
    $editing = '';

    echo "<center><span class=\"title\"><strong>"._PASTSURVEYS."</strong></span></center>";
    echo "<br /><br />";
    echo "<table border=\"0\" cellpadding=\"8\"><tr><td>";
    $querylang = '';
    $count = 0;
    if ($evoconfig['multilingual']) { $querylang = "AND p.planguage='$currentlang' OR p.planguage=''"; }
    $result = $db->sql_query("SELECT p.pollID, p.pollTitle, SUM(pd.optionCount) FROM "._POLL_DESC_TABLE." p, "._POLL_DATA_TABLE." pd where p.artid='0' and p.pollID=pd.pollID $querylang GROUP BY p.pollID ORDER BY p.timeStamp DESC");
    while(list($plID, $plTitle, $voters) = $db->sql_fetchrow($result)) {
        if (is_mod_admin($module_name)) { $editing = ' - <a href="'.$admin_file.'.php?op=PollEdit&amp;pollID='.$plID.'">'._SV_EDIT.'</a>'; }
        echo "<img src=\"". evo_image('arrow.png', 'evo') ."\" border=\"0\" alt=\"\" title=\"\" width=\"6\" height=\"9\" />&nbsp;<a href=\"modules.php?name=$module_name&amp;pollID=$plID\">$plTitle</a> ";
        echo "(<a href=\"modules.php?name=$module_name&amp;op=results&amp;pollID=$plID$r_options\">"._RESULTS."</a> - $voters "._LVOTES."$editing)<br />\n";
        $count++;
    }
    $db->sql_freeresult($result);
    if ($count == 0) {
        echo "</td><td width=\"100%\" align=\"center\">"._NOSURVEYS;
    }
    echo "</td></tr></table><br />";
}

function pollResults($pollID) {
    global $resultTableBgColor, $resultBarFile, $db, $module_name, $admin_file;

    if(!isset($pollID)) $pollID = 1;
    $result = $db->sql_query("SELECT pollID, pollTitle, artid FROM "._POLL_DESC_TABLE." WHERE pollID='$pollID'");
    $holdtitle = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    echo "<strong>".$holdtitle['pollTitle']."</strong><br /><br />";

    $result = $db->sql_query("SELECT SUM(optionCount) FROM "._POLL_DATA_TABLE." WHERE pollID='$pollID'");
    list($sum) = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    echo "<table border=\"0\">";

    /* cycle through all options */
    $result = $db->sql_query("SELECT optionText, optionCount FROM "._POLL_DATA_TABLE." WHERE pollID='$pollID' AND optionText!='' ORDER BY voteID");
    while(list($optionText, $optionCount) = $db->sql_fetchrow($result)) {
        echo "<tr><td>$optionText</td>";
        $percent = 0;
        if($sum) {
            $percent = @(100 * $optionCount / $sum);
        }
        echo "<td>";
        $percentInt = (int)$percent * .85;
        $percent2 = (int)$percent;
        $leftbar = evo_image('leftbar.png', 'Surveys');
        $rightbar = evo_image('rightbar.png', 'Surveys');
        $mainbar = evo_image('mainbar.png', 'Surveys');
        $mainbar_d = evo_image('mainbar.png', 'Surveys');
        $l_size = @getimagesize(evo_image_dir('leftbar.png', 'Surveys'));
        $m_size = @getimagesize(evo_image_dir('mainbar.png', 'Surveys'));
        $r_size = @getimagesize(evo_image_dir('rightbar.png', 'Surveys'));
        if (isset($mainbar_d)) $m1_size = @getimagesize(NUKE_BASE_DIR.$mainbar_d);
        if ($percent > 0) {
            echo '<img src="'.$leftbar.'" height="'.$l_size[1].'" width="'.$l_size[0].'" alt="'.$percent2.' %" title="'.$percent2.' %" />';
            echo '<img src="'.$mainbar.'" height="'.$m_size[1].'" width="'.$percentInt.'" alt="'.$percent2.' %" title="'.$percent2.' %" />';
            echo '<img src="'.$rightbar.'" height="'.$r_size[1].'" width="'.$r_size[0].'" alt="'.$percent2.' %" title="'.$percent2.' %" />';
        } else {
            echo '<img src="'.$leftbar.'" height="'.$l_size[1].'" width="'.$l_size[0].'" alt="'.$percent2.' %" title="'.$percent2.' %" />';
            echo '<img src="'.$mainbar.'" height="'.$m_size[1].'" width="'.$m_size[0].'" alt="'.$percent2.' %" title="'.$percent2.' %" />';
            echo '<img src="'.$rightbar.'" height="'.$r_size[1].'" width="'.$r_size[0].'" alt="'.$percent2.' %" title="'.$percent2.' %" />';
        }
        printf(" %.2f%% (%s)", $percent, $optionCount);
        echo "</td></tr>";
    }
    $db->sql_freeresult($result);
    echo "</table><br />";
    echo "<center><span class=\"content\">";
    echo "<strong>"._TOTALVOTES." $sum</strong><br />";
    echo "<br /><br />";
    $article = '';
    if ($holdtitle['artid'] > 0) { $article = "<br /><br />"._GOBACK; }
    echo "[ <a href=\"modules.php?name=$module_name&amp;pollID=$pollID\">"._VOTING."</a> | "
        ."<a href=\"modules.php?name=$module_name\">"._OTHERPOLLS."</a> ] $article </span></center>";
    if (is_mod_admin($module_name)) {
        echo '<br /><center>[ <a href="'.$admin_file.'.php?op=CreatePoll">'._ADD.'</a> | <a href="'.$admin_file.'.php?op=PollEdit&amp;pollID='.$pollID.'">'._EDIT.'</a> ]</center>';
    }
    return 1;
}

?>