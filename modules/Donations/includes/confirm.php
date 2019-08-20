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

//Display the page title
donation_index();

function confirm_donation () {
    global $gen_configs, $lang_donate, $module_name, $_GETVAR;

    $_GETVAR->unsetVariables();

    if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
        redirect('modules.php?name='.$module_name.'&amp;op=make');
    }

    if (!isset($_SESSION)) { session_start(); }
    if (isset($_SESSION['PP_D'])) unset($_SESSION['PP_D']);
    $_SESSION['PP_D'] = $_POST;
    $cookie = '';
    if ($gen_configs['cookie'] == 'yes') {
        evo_setcookie('currency_code', $_POST['currency_code'], time()+3600);
        evo_setcookie('business', $_POST['business'], time()+3600);
        evo_setcookie('on0', $_POST['on0'], time()+3600);
        evo_setcookie('on1', $_POST['on1'], time()+3600);
        evo_setcookie('item_name', $_POST['item_name'], time()+3600);
        evo_setcookie('amount', $_POST['amount'], time()+3600);
        evo_setcookie('os0', $_POST['os0'], time()+3600);
        evo_setcookie('os1', $_POST['os1'], time()+3600);
        $cookie = 'onclick="donationcookie()"';
    }
    echo "<br />\n";
    OpenTable();
    echo "<div style='text-align:center; width:100%;'>\n";
    //Use this line if you want to use the sandbox
    //echo "<form action=\"https://www.sandbox.paypal.com/webscr\" method=\"post\">\n";
    echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">';
    foreach ($_POST as $key => $value) {
        echo "<input type=\"hidden\" name=\"".$key."\" value=\"".htmlentities($value, ENT_NOQUOTES)."\" />\n";
    }
    echo "<table width=\"100%\" border=\"0\">\n";
    //Change to force a language
    //echo "<input type='hidden' name='lc' value='US' />";
    echo "<tr><td>".sprintf($lang_donate['CONFIRM_DONATION'], $_POST['amount'], $_POST['currency_code'])."</td></tr>\n";
    echo "<tr><td><input type=\"submit\" value=\"".$lang_donate['CONFIRM']."\" $cookie /></td></tr>\n";
    echo "<tr><td>".$lang_donate['COME_BACK']."</td></tr>\n";
    echo "</table>\n";
    echo "</form>\n";
    echo "</div>\n";
    CloseTable();
}

//Get values
global $gen_configs;
$gen_configs = get_gen_configs();
if (empty($gen_configs['pp_email'])) {
    OpenTable();
    DonateError($lang_donate['NO_PP_ADD'],1);
}
if (intval($_POST['amount']) <= 0) {
    OpenTable();
    DonateError($lang_donate['NO_OR_NEGATIV_VALUE'].'<br />'._GOBACK,1);
}

confirm_donation();
?>