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
get_lang($module_name);
$pagetitle = '- '._RECOMMEND;

function RecommendSite() {
    global $db, $module_name, $userinfo;
    $yn = '';
    $ye = '';
    include_once(NUKE_BASE_DIR.'header.php');
    title(_RECOMMEND, $module_name, 'recommend_us-logo.png');
    OpenTable();
    echo '<form action="modules.php?name='.$module_name.'" method="post">'."\n";
    echo '<input type="hidden" name="op" value="SendSite" />'."\n";
    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">'."\n";
    if (is_user()) {
        $row = $db->sql_ufetchrow("SELECT username, user_email FROM ".USERS_TABLE." WHERE user_id = '".$userinfo['user_id']."'");
        $yn = stripslashes($row['username']);
        $ye = stripslashes($row['user_email']);
    }
    echo '<tr><td width="30%" style="text-align:left;"><strong>'._FYOURNAME.'</strong></td><td width="2%"></td>'."\n";
    echo '<td width="67%" style="text-align:left;"><input type="text" name="yname" value="'.$yn.'" size="40" /></td></tr>'."\n";
    echo '<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
    echo '<tr><td width="30%" style="text-align:left;"><strong>'._FYOUREMAIL.'</strong></td><td width="2%"></td>'."\n";
    echo '<td width="67%" style="text-align:left;"><input type="text" name="ymail" value="'.$ye.'" size="40" /></td></tr>'."\n";
    echo '<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>'."\n";
    echo '<tr><td width="30%" style="text-align:left"><strong>'._FFRIENDNAME.'</strong></td><td width="2%"></td>'."\n";
    echo '<td width="67%" style="text-align:left;"><input type="text" name="fname" size="40" /></td></tr>'."\n";
    echo '<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
    echo '<tr><td width="30%" style="text-align:left"><strong>'._FFRIENDEMAIL.'</strong></td><td width="2%"></td>'."\n";
    echo '<td width="67%" style="text-align:left;"><input type="text" name="fmail" size="40" /></td></tr>'."\n";
    echo '<tr><td colspan="3" style="text-align:center;"><br />';
    echo  security_code(1, 'small', 1);
    echo '</td></tr>'."\n";
    echo '<tr><td colspan="3" style="text-align:center;"><input type="submit" value="'._SEND.'" /></td></tr>'."\n";
    echo '</table>'."\n";
    echo '</form>'."\n";
     
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function SendSite() {
    global $evoconfig, $module_name, $_GETVAR;
    if (!security_code_check($_POST['gfx_check'], 'force')) {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />Wrong Security Code');
    }
    $yname = check_html($_GETVAR->get('yname', 'POST', 'alphanumeric'), 'nohtml');
    $fname = check_html($_GETVAR->get('fname', 'POST', 'alphanumeric'), 'nohtml');
    $ymail = $_GETVAR->get('ymail', 'POST', 'email');
    $fmail = $_GETVAR->get('fmail', 'POST', 'email');
    $subject = _INTSITE." ".EVO_SERVER_SITENAME;
    $message = _HELLO." $fname:\n\n"._YOURFRIEND." $yname "._OURSITE." ".EVO_SERVER_SITENAME." "._INTSENT."\n\n\n"._FSITENAME." ".EVO_SERVER_SITENAME."\n".$evoconfig['slogan']."\n"._FSITEURL." ".EVO_SERVER_URL."\n";
    if (empty($fname) || empty($fmail) || empty($yname) || empty($ymail)) {
        redirect("modules.php?name=".$module_name);
    } else {
        $to   = $fmail.', '.$fname;
        $from = $ymail.', '.$yname;
        $return = evo_mail($to, $subject, $message, $from);
        redirect("modules.php?name=".$module_name."&amp;op=SiteSent&amp;fname=".$fname."");
   }
}

function SiteSent() {
    global $_GETVAR, $module_name;
    $fname = check_html($_GETVAR->get('fname', 'GET', 'alphanumeric'), 'nohtml');
    include_once(NUKE_BASE_DIR.'header.php');
    $fname = stripslashes(Fix_Quotes(check_html(removecrlf($fname))));
    title(_RECOMMEND, $module_name, 'recommend_us-logo.png');
    OpenTable();
    echo '<center><span class="content">'._FREFERENCE.'&nbsp;'.$fname.'&nbsp;...<br /><br />'._THANKSREC.'</span></center>'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

$op = $_GETVAR->get('op', 'REQUEST');

switch($op) {
    case 'SendSite':
        SendSite();
        break;
    case 'SiteSent':
        SiteSent();
        break;
    default:
        RecommendSite();
        break;
}

?>