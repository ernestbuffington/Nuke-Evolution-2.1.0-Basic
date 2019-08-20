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

if (!defined('NUKE_EVO')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION OR NOT WITHIN NUKE-EVO');
}


/*************************************************************************************/
// function yacookiecheck()
/*************************************************************************************/
function yacookiecheck(){
    evo_setcookie('CNB_test1', 'value1', 0);
}
/*************************************************************************************/
// function yacookiecheckresults()
/*************************************************************************************/
function yacookiecheckresults($op, $cookieresult){
    global $evoconfig, $module_name, $_GETVAR;
    $cookiedebug = 0;        // cookiedebug: set this to '1' if you want additional debug info
    $cookietest  = 0;

    $cookiecheck = evo_getcookie('CNB_test1');
    if (!$cookieresult && $cookiecheck != 'value1') {
        yacookiecheck();
        redirect("modules.php?name=$module_name&amp;op=".$op."&amp;cookieresult=1");
    }
    $debugcookie = "<table width='100%' cellspacing='10' cellpadding='0' border='0' align='center'>";
    if( evo_getcookie('CNB_test1') == 'value1') {
        $debugcookie .= "<tr><td>1: setcookie('CNB_test1','value1', 0)";
        $debugcookie .= "</td><td><font color='#009933'><strong>"._YA_COOKIEOK."</strong></font></td></tr>";
    } else {
        $debugcookie .= "<tr><td>1: setcookie('CNB_test1','value1', 0;)";
        $debugcookie .= "</td><td><font color='#FF3333'><strong>"._YA_COOKIEFAIL."</strong></font></td></tr>";
        $cookietest++;
    }
    $debugcookie .= "</td></tr></table>";
    if ($cookietest || $cookiedebug ){
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
    }
    if ($cookietest){
        echo "<table width='100%' cellspacing='0' cellpadding='5' border='0'><tr>";
        echo "<td colspan='2'><img src='".evo_image('warning.png', $module_name)."' alt='' align='left' width='40' height='40' />";
        echo "<font color='#FF3333'><strong>"._YA_COOKIENO."</strong></font>";
        echo "</td></tr><tr><td valign='top'>";
        if ($cookiedebug) {
            OpenTable();
            echo $debugcookie;
            CloseTable();
        }
        echo "</td></tr></table>";
    } else if ($cookiedebug) {
        echo "<table width='100%' cellspacing='0' cellpadding='5' border='0'><tr>";
        echo "<td colspan='2'><img src='".evo_image('warning.png', $module_name)."' alt='' align='left' width='40' height='40' />";
        echo "<font color='#009933'><strong>"._YA_COOKIEYES."</strong></font>";
        echo "</td></tr><tr><td valign='top'>";
        if ($cookiedebug) {
            OpenTable();
            echo $debugcookie;
            CloseTable();
        }
        echo "</td><tr><form action='modules.php?name=$module_name' method='post'>";
        echo "<td align='right'><input type='submit' name='submit' value='"._YA_CONTINUE."' /></td></form></tr></table>";
    }
    if ($cookietest || $cookiedebug ){
        CloseTable();
        echo '<br />';
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}
/*************************************************************************************/
// function ShowCookiesRedirect()
/*************************************************************************************/
function ShowCookiesRedirect() {
    global $evoconfig, $module_name;

    evo_setcookie('CNB_test1','deleted',-1);
    redirect("modules.php?name=$module_name&amp;op=ShowCookies");
}

/*************************************************************************************/
// function ShowCookies()
/*************************************************************************************/
function ShowCookies() {
    global $evoconfig,$module_name;

    $show_header_cookie = FALSE;
    include_once(NUKE_BASE_DIR.'header.php');
    Show_CNBYA_menu($show_header_cookie);
    OpenTable();
    $cookies = evo_getcookie('*');
    $CookieArray = (is_array($cookies) ? $cookies : array());
    echo "<form action='modules.php?name=$module_name&amp;op=DeleteCookies' method='post'>";
    echo "<table width='100%' cellspacing='0' cellpadding='5' border='0'><tr>";
    echo "<td colspan='2'><img src='".evo_image('warning.png', $module_name)."' alt='' align='left' width='40' height='40' />";
    echo "<span class='content'>"._YA_DELCOOKIEINFO1."</span></td></tr><tr><td width='100%'>";
    echo "<table cellspacing='0' cellpadding='5' border='1' align='left'><tr><td colspan='2'>";
    echo "<span class='title'>"._YA_CURRENTCOOKIE."</span></td></tr>";
    echo "<tr><td nowrap='nowrap'><strong>"._YA_COOKIENAME."</strong></td><td width='100%'><strong>"._YA_COOKIEVAL."</strong></td></tr>";
    if (is_array($CookieArray) && !empty($CookieArray)) {
        while(list($cName, $cValue) = each($CookieArray)) {
            $cMore   = '';
            $cOutput = '';
            if (!$cValue['cookie_value'] || empty($cValue['cookie_value'])) {
                $cOutput = '(empty)';
            } else {
                $cOutput = $cValue['cookie_value'];
            }
            if (strlen($cOutput) > 30) {
                $cOutput = substr($cOutput, 0, 30).'....';
            }
            echo "<tr><td align='left' nowrap='nowrap'>$cName</td><td width='100%' align='left'>$cOutput</td></tr>";
        }
        echo "</table></td><td valign='top'><input type='submit' name='submit' value='"._YA_COOKIEDELTHESE."' /></td></tr></table></form>";
    } else {
        echo "<tr><td colspan='2'>"._YA_COOKIENOCUR1."</td></tr></table>";
        echo "</td><td valign='top'><input type='submit' name='submit' value='"._YA_COOKIEDELALL."' /></td></tr></table></form>";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    $CookieArray = '';
}
/*************************************************************************************/
// function DeleteCookies()
/*************************************************************************************/
function DeleteCookies() {
    global $evoconfig, $module_name, $userinfo, $user, $cookie;
    include_once(NUKE_BASE_DIR.'header.php');
    Show_CNBYA_menu();
    OpenTable();

    $r_uid      = $userinfo['user_id'];
    $r_username = $userinfo['username'];
    $cookies    = evo_getcookie('*');
    $CookieArray = (is_array($cookies) ? $cookies : array());
    echo "<form action='modules.php?name=$module_name&amp;op=ShowCookies' method='post'>";
    echo "<table width='100%' cellspacing='0' cellpadding='5' border='0'><tr>";
    echo "<td colspan='2'><img src='".evo_image('warning.png', $module_name)."' alt=' align='left' width='40' height='40' alt=''/>";
    echo "<span class='content'>"._YA_COOKIEDEL1."</td></tr><tr><td  width='100%'>";
    echo "<table cellspacing='0' cellpadding='5' border='1' align='left'><tr><td colspan='2'>";
    echo "<span class='title'>"._YA_CURRENTCOOKIE."</span></td></tr>";
    echo "<tr><td nowrap='nowrap'><strong>"._YA_COOKIENAME."</strong></td><td width='100%'><strong>"._YA_COOKIESTAT."</strong></td></tr>";
    if (is_array($CookieArray) && !empty($CookieArray)) {
        while(list($cName,$cValue) = each($CookieArray)) {
            $cValue['cookie_value'] = '';
            // Multiple cookie paths used to expire cookies that are no longer in use as well.
            evo_setcookie($cName,'deleted',-1);
            echo "<tr><td align='left' nowrap='nowrap'>$cName</td><td width='100%' align='left'>"._YA_COOKIEDEL2."</td></tr>";
        }
        echo "</table><td valign='top'><input type='submit' name='submit' value='"._YA_COOKIESHOWALL."' /></td></tr></table></form>";
    }
    else {
        echo "<tr><td width='100%' colspan='2'>"._YA_COOKIENOCUR2."</td></tr></table>";
        echo "</td><td valign='top'><input type='submit' name='submit' value='"._YA_COOKIESHOWALL."' /></td></tr></table></form>";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>