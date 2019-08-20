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

global $_GETVAR, $module_name, $lang_new;

$pagetitle = $lang_new[$module_name]['_ADVERTISING'];

function advertising_is_client() {
    global $db, $module_name, $_GETVAR, $advertising_client, $lang_new;
    static $client;

    $advertising_client = array();
    $advertising_client['cid']  = 0;
    $advertising_client['name'] = '';
    if (isset($client) && is_array($client)) {
        if ($client['is_client']) {
            $advertising_client['cid']  = $client['cid'];
            $advertising_client['name'] = $client['name'];
            return TRUE;
        }
    }
    $client        = array();
    $client['is_client'] = FALSE;
    $login         = $_GETVAR->get('login', 'POST', 'string', '');
    $pass          = $_GETVAR->get('pass', 'POST', 'string', '');
    $gfx_check     = $_GETVAR->get($module_name.'gfx_check', 'REQUEST', 'string');
    $advertisecookie        = evo_getcookie('advertiseclient');
    if (isset($advertisecookie) && !empty($advertisecookie)) {
        $advertisecookie_client = explode(':', $advertisecookie);
        $db_client = $db->sql_ufetchrow("SELECT `cid`, `name`, `login`, `passwd` FROM "._BANNER_CLIENT_TABLE." WHERE cid='".$advertisecookie_client[0]."'");
        if ($db_client['cid'] == $advertisecookie_client[0]) {
            if (($db_client['login'] == $advertisecookie_client[1]) && ($db_client['passwd'] == $advertisecookie_client[2])) {
                $client['is_client'] = TRUE;
                $advertising_client['name'] = $client['name'] = $db_client['name'];
                $advertising_client['cid']  = $client['cid']  = $db_client['cid'];
            }
        }
    } elseif (!empty($login) && !empty($pass)) {
        if (!security_code_check($gfx_check, 'force', $module_name)) {
            include_once(NUKE_BASE_DIR.'header.php');
            title($lang_new[$module_name]['_PLANSPRICES'], $module_name, 'ads-logo.png');
            OpenTable();
            echo '<div class="texterrorcenter">'.$lang_new[$module_name]['_ADSGFX_FAILURE'].'</div>';
            echo '<br /><br />';
            echo '<center>' .$lang_new[$module_name]['_GOBACK']. '</center>';
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        }
        $row = $db->sql_ufetchrow("SELECT `cid`, `name` FROM "._BANNER_CLIENT_TABLE." WHERE `login`='".$login."' AND `passwd`='".$pass."'");
        if ($row['cid'] >= 1) {
            $cid = $row['cid'];
            $infos = "$cid:$login:$pass";
            evo_setcookie('advertiseclient', $infos, 0);
            $advertising_client['cid']  = $client['cid']  = $cid;
            $advertising_client['name'] = $client['name'] = $row['name'];
            $client['is_client'] = TRUE;
        }
    }
    if (!$client['is_client']) {
        return FALSE;
    } else {
        return TRUE;
    }

}

function advertising_themenu() {
    global $module_name, $db, $op, $lang_new;

    OpenTable();
    echo "<br />";
    if (advertising_is_client()) {
        if ($op == 'client_home') {
            $client_opt = '';
        } else {
            $client_opt = "| <a href='modules.php?name=$module_name&amp;op=client_home'>".$lang_new[$module_name]['_MYADS']."</a>";
        }
    } else {
        $client_opt = "| <a href='modules.php?name=$module_name&amp;op=client'>".$lang_new[$module_name]['_CLIENTLOGIN']."</a>";
    }
    echo "<center><strong>".$lang_new[$module_name]['_ADSMENU']."</strong><br /><br />[ <a href='modules.php?name=".$module_name."'>".$lang_new[$module_name]['_MAINPAGE']."</a> | " . (is_active('Statistics') ? "<a href='modules.php?name=Statistics'>".$lang_new[$module_name]['_SITESTATS']."</a> |" : "") . "  <a href='modules.php?name=".$module_name."&amp;op=terms'>".$lang_new[$module_name]['_TERMS']."</a> | <a href='modules.php?name=".$module_name."&amp;op=plans'>".$lang_new[$module_name]['_PLANSPRICES']."</a> ".$client_opt." ]</center>";
    CloseTable();
}

function advertising_theindex() {
    global $db, $module_name, $lang_new;

    include_once(NUKE_BASE_DIR.'header.php');
    $text = '<br /><br />'.$lang_new[$module_name]['_WELCOMEADS'].'<br />';
    title($text, $module_name, 'ads-logo.png');
    advertising_themenu();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function advertising_plans() {
    global $module_name, $db, $ThemeInfo, $lang_new;

    include_once(NUKE_BASE_DIR.'header.php');
    title($lang_new[$module_name]['_PLANSPRICES'], $module_name, 'ads-logo.png');
    advertising_themenu();
    OpenTable();
    $result = $db->sql_query("SELECT * FROM "._BANNER_PLANS_TABLE." WHERE active='1'");
    if ($db->sql_numrows($result) > 0) {
        echo $lang_new[$module_name]['_PLANNAME']."<br /><br />";
        echo "<table border='1' width='100%' cellpadding='3'>";
        echo "<tr><td align='center' nowrap='nowrap' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>".$lang_new[$module_name]['_PLANNAME']."</strong></td><td bgcolor='".$ThemeInfo['bgcolor2']."'>&nbsp;<strong>".$lang_new[$module_name]['_DESCRIPTION']."</strong></td><td align='center' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>".$lang_new[$module_name]['_QUANTITY']."</strong></td><td align='center' bgcolor='".$ThemeInfo['bgcolor2']."'><strong>".$lang_new[$module_name]['_PRICE']."</strong></td><td align='center' bgcolor='".$ThemeInfo['bgcolor2']."' nowrap='nowrap'><strong>".$lang_new[$module_name]['_BUYLINKS']."</strong></td></tr>";
        while ($row = $db->sql_fetchrow($result)) {
            if ($row['delivery_type'] == '0') {
                $delivery = $lang_new[$module_name]['_IMPRESSIONS'];
            } elseif ($row['delivery_type'] == '1') {
                $delivery = $lang_new[$module_name]['_CLICKS'];
            } elseif ($row['delivery_type'] == '2') {
                $delivery = $lang_new[$module_name]['_DAYS'];
            } elseif ($row['delivery_type'] == '3') {
                $delivery = $lang_new[$module_name]['_MONTHS'];
            } elseif ($row['delivery_type'] == '4') {
                $delivery = $lang_new[$module_name]['_YEARS'];
            }
            echo "<tr><td valign='top'><strong>".$row['name']."</strong></td><td>".$row['description']."</td>\n";
            echo "<td valign='bottom'><center>".$row['delivery']."<br />".$delivery."</center></td>\n";
            echo "<td valign='bottom'>".$row['price']."</td>\n";
            if (strstr($row['buy_links'], 'http')) {
                echo "<td valign='bottom' nowrap='nowrap'><center><a href='".$row['buy_links']."' target='_NEW'>".$row['buy_links']."</a></center></td></tr>";
            } else {
                echo "<td valign='bottom' nowrap='nowrap'><center>".$row['buy_links']."</center></td></tr>";
            }
        }
        $db->sql_freeresult($result);
        echo "</table>";
    } else {
        echo "<center>".$lang_new[$module_name]['_ADSNOCONTENT']."<br /><br />".$lang_new[$module_name]['_GOBACK']."</center>";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function advertising_terms() {
    global $module_name, $db, $lang_new, $langtime;

    $today = getdate();
    $month = $today['mon'];
    switch ($month) {
        case '1': $month = $langtime['datetime']['January']; break;
        case '2': $month = $langtime['datetime']['February']; break;
        case '3': $month = $langtime['datetime']['March']; break;
        case '4': $month = $langtime['datetime']['April']; break;
        case '5': $month = $langtime['datetime']['May']; break;
        case '6': $month = $langtime['datetime']['June']; break;
        case '7': $month = $langtime['datetime']['July']; break;
        case '8': $month = $langtime['datetime']['August']; break;
        case '9': $month = $langtime['datetime']['September']; break;
        case '10': $month = $langtime['datetime']['October']; break;
        case '11': $month = $langtime['datetime']['November']; break;
        case '12': $month = $langtime['datetime']['December']; break;
    }
    $year = $today['year'];
    include_once(NUKE_BASE_DIR.'header.php');
    title($lang_new[$module_name]['_TERMSCONDITIONS'], $module_name, 'ads-logo.png');
    advertising_themenu();
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM "._BANNER_TERMS_TABLE));
    $terms = preg_replace("#\[sitename\]#si", EVO_SERVER_SITENAME, $row['terms_body']);
    $terms = preg_replace("#\[country\]#si", $row['country'], $terms);
    $terms = decode_bb_all($terms, 1, true);
    OpenTable();
    echo $terms;
    echo "<p align='right'>".$row['country'].", $month $year</p>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function advertising_client() {
    global $module_name, $db, $client, $lang_new;

    if (advertising_is_client()) {
        advertising_client_home();
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        title($lang_new[$module_name]['_CLIENTLOGIN'], $module_name, 'ads-logo.png');
        advertising_themenu();
        OpenTable();
        echo "<br />";
        echo "<div align='center'>";
        echo "<form method='post' onsubmit='this.submit.disabled = true' action='modules.php?name=".$module_name."'><table border='0' align='center' cellpadding='3'>\n";
        echo "<tr><td align='left'>".$lang_new[$module_name]['_LOGIN'].":</td><td align='left'><input type='text' name='login' size='15' /></td></tr>\n";
        echo "<tr><td align='left'>".$lang_new[$module_name]['_PASSWORD'].":</td><td align='left'><input type='password' name='pass' size='15' /></td></tr>\n";
        echo "<tr><td align='center' colspan='2'>";
        echo security_code(7, 'small', 1, $module_name);
        echo "</td></tr>\n<tr><td colspan='2' align='center'><input type='hidden' name='op' value='client_home' /><input name='submit' type='submit' value='".$lang_new[$module_name]['_ENTER']."' /></td></tr>\n</table>\n</form>";
        echo "</div>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}

function advertising_client_logout() {
    global $module_name;
    $client = '';
    evo_setcookie('advertiseclient', 'delete', -1);
    redirect('modules.php?name='.$module_name.'&amp;op=client');
}

function advertising_client_home() {
    global $db, $ThemeInfo, $module_name, $_GETVAR, $advertising_client, $lang_new;

    $a = 0;
    if (advertising_is_client()) {
        include_once(NUKE_BASE_DIR.'header.php');
        title($lang_new[$module_name]['_ADSYSTEM'], $module_name, 'ads-logo.png');
        advertising_themenu();
        OpenTable();
        $cid = $advertising_client['cid'];
        echo "<center>".$lang_new[$module_name]['_ACTIVEADSFOR']." ".$advertising_client['name']."</center><br />"
            ."<table width='100%' border='1'><tr>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_NAME']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPMADE']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPTOTAL']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPLEFT']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLICKS']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>% ".$lang_new[$module_name]['_CLICKS']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_TYPE']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_FUNCTIONS']."</strong></td></tr>";
        $result = $db->sql_query("SELECT * FROM "._BANNER_TABLE." WHERE cid='".$advertising_client['cid']."' AND active='1'");
        while ($row = $db->sql_fetchrow($result)) {
            $bid      = intval($row['bid']);
            $imptotal = intval($row['imptotal']);
            $impmade  = intval($row['impmade']);
            $clicks   = intval($row['clicks']);
            $date     = $row['date'];
            if ($impmade == 0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
                $percent = $percent.'%';
            }
            if ($imptotal == 0) {
                $left     = $lang_new[$module_name]['_UNLIMITED'];
                $imptotal = $lang_new[$module_name]['_UNLIMITED'];
            } else {
                $left = $imptotal-$impmade;
            }
            if ($row['ad_class'] == 'flash' || $row['ad_class'] == 'code') {
                $clicks  = $lang_new[$module_name]['_NA'];
                $percent = $lang_new[$module_name]['_NA'];
            }
            if (empty($row['name'])) {
                $row['name'] = $lang_new[$module_name]['_NONE'];
            }
            echo "<tr><td align='center'>".$row['name']."</td>"
                ."<td align='center'>".$impmade."</td>"
                ."<td align='center'>".$imptotal."</td>"
                ."<td align='center'>".$left."</td>"
                ."<td align='center'>".$clicks."</td>"
                ."<td align='center'>".$percent."</td>"
                ."<td align='center'>".ucfirst($row['ad_class'])."</td>"
                ."<td align='center'><a href='modules.php?name=".$module_name."&amp;op=client_report&amp;cid=".$cid."&amp;bid=".$bid."'><img src='".evo_image('mail_stat.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_EMAILSTATS']."' title='".$lang_new[$module_name]['_EMAILSTATS']."' /></a>&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=view_banner&amp;cid=".$cid."&amp;bid=".$bid."'><img src='".evo_image('view.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_VIEWBANNER']."' title='".$lang_new[$module_name]['_VIEWBANNER']."' /></a></td></tr>";
        }
        $db->sql_freeresult($result);
        echo "</table>";
        echo "<br /><br /><center>".$lang_new[$module_name]['_INACTIVEADS']." ".$advertising_client['name']."</center><br />"
            ."<table width='100%' border='1'><tr>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_NAME']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPMADE']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPTOTAL']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPLEFT']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLICKS']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>% ".$lang_new[$module_name]['_CLICKS']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_TYPE']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_FUNCTIONS']."</strong></td></tr>";
        $sql = "SELECT * FROM "._BANNER_TABLE." WHERE cid='".$advertising_client['cid']."' AND active='0'";
        $result = $db->sql_query($sql, true);
        while ($row = $db->sql_fetchrow($result)) {
            $bid      = intval($row['bid']);
            $imptotal = intval($row['imptotal']);
            $impmade  = intval($row['impmade']);
            $clicks   = intval($row['clicks']);
            $date     = $row['date'];
            $date     = $row['date'];
            if($impmade == 0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
                $percent = $percent.'%';
            }
            if($imptotal == 0) {
                $left     = $lang_new[$module_name]['_UNLIMITED'];
                $imptotal = $lang_new[$module_name]['_UNLIMITED'];
            } else {
                $left = $imptotal-$impmade;
            }
            if ($row['ad_class'] == 'flash' || $row['ad_class'] == 'code') {
                $clicks  = $lang_new[$module_name]['_NA'];
                $percent = $lang_new[$module_name]['_NA'];
            }
            if (empty($row['name'])) {
                $row['name'] = $lang_new[$module_name]['_NONE'];
            }
            echo "<tr><td align='center'>".$row['name']."</td>"
                ."<td align='center'>".$impmade."</td>"
                ."<td align='center'>".$imptotal."</td>"
                ."<td align='center'>".$left."</td>"
                ."<td align='center'>".$clicks."</td>"
                ."<td align='center'>".$percent."</td>"
                ."<td align='center'>".ucfirst($row['ad_class'])."</td>"
                ."<td align='center'><a href='modules.php?name=".$module_name."&amp;op=client_report&amp;cid=".$cid."&amp;bid=".$bid."'><img src='".evo_image('mail_stat.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_EMAILSTATS']."' title='".$lang_new[$module_name]['_EMAILSTATS']."' /></a>&nbsp;&nbsp;<a href='modules.php?name=".$module_name."&amp;op=view_banner&amp;cid=".$cid."&amp;bid=".$bid."'><a href='modules.php?name=".$module_name."&amp;op=view_banner&amp;cid=".$cid."&amp;bid=".$bid."'><img src='".evo_image('view.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_VIEWBANNER']."' title='".$lang_new[$module_name]['_VIEWBANNER']."' /></a></td></tr>";
            $a = 1;
        }
        $db->sql_freeresult($result);
        if ($a != 1) {
            echo "<tr><td align='center' colspan='8'><em>".$lang_new[$module_name]['_NOCONTENT']."</em></td></tr>";
        }
        echo "</table><br /><br /><center>[ <a href='modules.php?name=".$module_name."&amp;op=client_logout'>"._LOGOUT."</a> ]</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        advertising_client();
    }
}

function advertising_view_banner() {
    global $db, $module_name, $client, $ThemeInfo, $_GETVAR, $advertising_client, $lang_new;

    if (!advertising_is_client()) {
        advertising_client();
    } else {
        $bid    = $_GETVAR->get('bid', '_REQUEST', 'int');
        include_once(NUKE_BASE_DIR.'header.php');
        title($lang_new[$module_name]['_ADSYSTEM'], $module_name, 'ads-logo.png');
        advertising_themenu();
        OpenTable();
        $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_TABLE." WHERE bid='".$bid." AND cid=".$advertising_client['cid']."'");
        $cid        = intval($row['cid']);
        $imptotal   = intval($row['imptotal']);
        $impmade    = intval($row['impmade']);
        $clicks     = intval($row['clicks']);
        $imageurl   = $row['imageurl'];
        $clickurl   = $row['clickurl'];
        $ad_class   = $row['ad_class'];
        $ad_code    = $row['ad_code'];
        $ad_width   = $row['ad_width'];
        $ad_height  = $row['ad_height'];
        $alttext    = $row['alttext'];
        $bid        = intval($row['bid']);
        $date       = $row['date'];
        echo "<center><span class='title'><strong>" .$lang_new[$module_name]['_YOURBANNER'].": ".$row['name']."</strong></span></center><br /><br />";
        if ($ad_class == 'code') {
            $ad_code = stripslashes(Fix_Quotes($ad_code));
            echo "<table border='0' align='center'><tr><td>".$ad_code."</td></tr></table>><br /><br />";
        } elseif ($ad_class == 'flash') {
            echo "<center>
                <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
                codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0'
                width='$ad_width' height='".$ad_height."' id='".$bid."'>
                <param name=movie value='".$imageurl."'>
                <param name=quality value=high>
                <embed src='".$imageurl."' quality=high width='".$ad_width."' height='".$ad_height."'
                name='$bid' align='' type='application/x-shockwave-flash'
                pluginspace='http://www.macromedia.com/go/getflashplayer'>
                </embed>
                </object>
                </center><br /><br />";
        } else {
            echo "<center><img src='".$imageurl."' border='1' alt='".$alttext."' title='".$alttext."' width='".$ad_width."' height='".$ad_height."' /></center><br /><br />";
        }
        echo "<center>Banner Information: ".$row['name']."</center><br />"
            ."<table width='100%' border='1'><tr>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_NAME']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPMADE']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPTOTAL']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPLEFT']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLICKS']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>% ".$lang_new[$module_name]['_CLICKS']."</strong></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_TYPE']."</strong></td></tr>";
        if ($impmade == 0) {
            $percent = 0;
        } else {
            $percent = substr(100 * $clicks / $impmade, 0, 5);
            $percent = $percent.'%';
        }
        if ($imptotal == 0) {
            $left     = $lang_new[$module_name]['_UNLIMITED'];
            $imptotal = $lang_new[$module_name]['_UNLIMITED'];
        } else {
            $left = $imptotal-$impmade;
        }
        if ($row['ad_class'] == 'flash' || $row['ad_class'] == 'code') {
            $clicks  = $lang_new[$module_name]['_NA'];
            $percent = $lang_new[$module_name]['_NA'];
        }
        if (empty($row['name'])) {
            $row['name'] = $lang_new[$module_name]['_NONE'];
        }
        if ($row['active'] == 1) {
            $status = $lang_new[$module_name]['_ACTIVE'];
        } elseif ($row['active'] == 0) {
            $status = $lang_new[$module_name]['_INACTIVE'];
        }
        echo "<tr><td align='center'>".$row['name']."</td>"
            ."<td align='center'>".$impmade."</td>"
            ."<td align='center'>".$imptotal."</td>"
            ."<td align='center'>".$left."</td>"
            ."<td align='center'>".$clicks."</td>"
            ."<td align='center'>".$percent."</td>"
            ."<td align='center'>".ucFirst($row['ad_class'])."</td></tr><tr>"
            ."<td align='center' colspan='7'>".$lang_new[$module_name]['_CURRENTSTATUS']." ".$status."</td></tr>"
            ."</table><br /><br />"
            ."<center>[ <a href='modules.php?name=".$module_name."&amp;op=client_report&amp;cid=".$cid."&amp;bid=".$bid."'>".$lang_new[$module_name]['_EMAILSTATS']."</a> | <a href='modules.php?name=".$module_name."&amp;op=logout'>"._LOGOUT."</a> ]</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}

function advertising_client_report() {
    global $db, $module_name, $evo_config, $_GETVAR, $advertising_client, $lang_new;

    $bid    = $_GETVAR->get('bid', 'REQUEST', 'int');
    if (!advertising_is_client()) {
        advertising_client();
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        title($lang_new[$module_name]['_ADSYSTEM'], $module_name, 'ads-logo.png');
        advertising_themenu();
        OpenTable();
        list($name, $email) = $db->sql_ufetchrow("SELECT name, email FROM "._BANNER_CLIENT_TABLE." WHERE cid='".$advertising_client['cid']."'");
        $client_name = htmlentities($name);
        if (empty($email)) {
            echo "<center><strong>".$lang_new[$module_name]['_STATSNOTSEND']."</strong><br /><br />".$lang_new[$module_name]['_GOBACK']."</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        } else {
            list($bid, $name, $imptotal, $impmade, $clicks, $imageurl, $clickurl, $date, $ad_class) = $db->sql_ufetchrow("SELECT bid, name, imptotal, impmade, clicks, imageurl, clickurl, date, ad_class FROM "._BANNER_TABLE." WHERE bid='".$bid."' AND cid='".$advertising_client['cid']."'");
            $bid        = intval($bid);
            $imptotal   = intval($imptotal);
            $impmade    = intval($impmade);
            $clicks     = intval($clicks);
            if ($impmade == 0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
            }
            if ($imptotal == 0) {
                $left     = $lang_new[$module_name]['_UNLIMITED'];
                $imptotal = $lang_new[$module_name]['_UNLIMITED'];
            } else {
                $left = $imptotal-$impmade;
            }
            $fdate   = formatTimestamp(time());
            $subject = $lang_new[$module_name]['_YOURSTATS'].' '.EVO_SERVER_SITENAME;
            $message = $lang_new[$module_name]['_FOLLOWINGSTATS']." ".EVO_SERVER_SITENAME.":\n\n\n".$lang_new[$module_name]['_CLIENTNAME'].": ".$client_name."\n".$lang_new[$module_name]['_BANNERID'].": ".$bid."\n".$lang_new[$module_name]['_BANNERNAME'].": ".$name."\n";
            if (empty($ad_class) || $ad_class == 'image') {
                $message .= $lang_new[$module_name]['_BANNERIMAGE'].": ".$imageurl."\n".$lang_new[$module_name]['_BANNERURL'].": ".$clickurl."\n\n".$lang_new[$module_name]['_IMPPURCHASED'].": ".$imptotal."\n".$lang_new[$module_name]['_IMPREMADE'].": ".$impmade."\n".$lang_new[$module_name]['_IMPRELEFT'].": ".$left."\n".$lang_new[$module_name]['_RECEIVEDCLICKS'].": ".$clicks."\n".$lang_new[$module_name]['_CLICKSPERCENT'].": ".$percent."%\n\n\n".$lang_new[$module_name]['_GENERATEDON'].": ".$fdate;
            } elseif ($ad_class == 'flash') {
                $message .= $lang_new[$module_name]['_FLASHMOVIE'].": ".$imageurl."\n\n".$lang_new[$module_name]['_IMPPURCHASED'].": ".$imptotal."\n".$lang_new[$module_name]['_IMPREMADE'].": ".$impmade."\n".$lang_new[$module_name]['_IMPRELEFT'].": ".$left."\n".$lang_new[$module_name]['_RECEIVEDCLICKS'].": ".$lang_new[$module_name]['_NA']."\n".$lang_new[$module_name]['_CLICKSPERCENT'].": ".$lang_new[$module_name]['_NA']."\n\n\n".$lang_new[$module_name]['_GENERATEDON'].": ".$fdate;
            } elseif ($ad_class == 'code') {
                $message .= $lang_new[$module_name]['_IMPPURCHASED'].": ".$imptotal."\n".$lang_new[$module_name]['_IMPREMADE'].": ".$impmade."\n".$lang_new[$module_name]['_IMPRELEFT'].": ".$left."\n".$lang_new[$module_name]['_RECEIVEDCLICKS'].": ".$lang_new[$module_name]['_NA']."\n".$lang_new[$module_name]['_CLICKSPERCENT'].": ".$lang_new[$module_name]['_NA']."\n\n\n".$lang_new[$module_name]['_GENERATEDON'].": ".$fdate;
            }
            $to = $email.','.$name;
            $return = evo_mail($to, $subject, $message);
            echo "<center><br /><br /><br />"
                ."<strong>".$lang_new[$module_name]['_STATSSENT']." ".$email."</strong><br /><br />"
                ."<a href='modules.php?name=".$module_name."&amp;op=client_home'>".$lang_new[$module_name]['_BACK']."</a></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }
}

$op     = $_GETVAR->get('op', '_REQUEST', 'string');

switch ($op) {
    case 'sitestats':
        advertising_sitestats();
        break;
    case 'plans':
        advertising_plans();
        break;
    case 'terms':
        advertising_terms();
        break;
    case 'client':
        advertising_client();
        break;
    case 'client_home':
        advertising_client_home();
        break;
    case 'client_logout':
        advertising_client_logout();
        break;
    case 'client_report':
        advertising_client_report();
        break;
    case 'view_banner':
        advertising_view_banner();
        break;
    default:
        advertising_theindex();
        break;
}

?>