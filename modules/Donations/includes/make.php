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

/*==============================================================================================
    Function:    make_get_values()
    In:          N/A
    Return:      All the predefined donation values
    Notes:       N/A
================================================================================================*/
function make_get_values () {
    global $db, $lang_donate;
    //Get the donation values
    $sql = 'SELECT config_value from '._DONATIONS_DONATOR_CONFIG_TABLE.' WHERE config_name="values"';
    //If not
    if(!$result = $db->sql_query($sql)) {
        DonateError($lang_donate['VALUES_NF'],0);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    //Explode them into an array
    $values = explode(',', $row[0]);
    //Send them back
    return $values;
}

/*==============================================================================================
    Function:    make_get_currency_code()
    In:          N/A
    Return:      Returns the selected currency code
    Notes:       N/A
================================================================================================*/
function make_get_currency_code () {
    global $gen_configs, $lang_donate;
    switch ($gen_configs['currency']) {
        case 'USD':
            return "&#36;";
        break;
        case 'AUD':
            return "&#36;";
        break;
        case 'CAD':
            return "&#36;";
        break;
        case 'EUR':
            return "&euro;";
        break;
        case 'GBP':
            return "&pound;";
        break;
        case 'JPY':
            return "&yen;";
        break;
        default:
            DonateError($lang_donate['CURRENCY_NF'],0);
        break;
    }
}


/*==============================================================================================
    Function:    make_other_value()
    In:          N/A
    Return:      The other radio and text area
    Notes:       N/A
================================================================================================*/
function make_other_value () {
    global $lang_donate;
    $out = "<input type=\"radio\" name=\"amount\" value=\"other\" checked=\"checked\" />".$lang_donate['OTHER'];
    $out .= "&nbsp;&nbsp;".make_get_currency_code()."<input size=\"8\" name=\"amount\" maxlength=\"8\" type=\"text\" value=\"0.00\" />\n<br />";
    return $out;
}

/*==============================================================================================
    Function:    make_display_values()
    In:          N/A
    Return:      Radios for all the predefined values
    Notes:       N/A
================================================================================================*/
function make_display_values () {
    $values = make_get_values();
    $currency_code = make_get_currency_code();
    foreach ($values as $value) {
        $radio[] = array('value' => $value, 'text' => $currency_code.$value, 'name' => 'amount', 'checked' => '');
    }
    return donate_radio($radio,1);
}

/*==============================================================================================
    Function:    make_image_button()
    In:          N/A
    Return:      Either a submit button or an image button
    Notes:       N/A
================================================================================================*/
function make_image_button () {
    global $gen_configs, $lang_donate;
    if (empty($gen_configs['button_image'])) {
        return "<tr><td colspan=\"2\"><div align=\"center\"><input type=\"submit\" value=\"".$lang_donate['DONATE']."\" /></div></td></tr>\n";
    } else {
        return "<tr><td colspan=\"2\"><div align=\"center\"><input type=\"image\" src=\"".$gen_configs['button_image']."\" name=\"submit\" /></div></td></tr>\n";
    }
}

/*==============================================================================================
    Function:    make_image_button()
    In:          N/A
    Return:      Types of donations
    Notes:       If there are no others on it will just return blank
================================================================================================*/
function make_type () {
    global $gen_configs, $lang_donate;
    if ($gen_configs['type_private'] == 'no' && $gen_configs['type_anon'] == 'no') {
        return '';
    }
    $radio[] = array('value' => NUKE_DONATIONS_REGULAR, 'text' => $lang_donate['TYPE_REGULAR'], 'name' => 'os0', 'checked' => 'checked="checked"', 'help' => make_help_popup($lang_donate['HELP_DONATION_REGULAR'], $lang_donate['TYPE_REGULAR']));
    if($gen_configs['type_private'] == 'yes'){
        $radio[] = array('value' => NUKE_DONATIONS_PRIVAT, 'text' => $lang_donate['TYPE_PRIVATE'], 'name' => 'os0', 'checked' => '', 'help' => make_help_popup($lang_donate['HELP_DONATION_PRIVATE'], $lang_donate['TYPE_PRIVATE']));
    }
    if($gen_configs['type_anon'] == 'yes'){
        $radio[] = array('value' => NUKE_DONATIONS_ANONYM, 'text' => $lang_donate['TYPE_ANON'], 'name' => 'os0', 'checked' => '', 'help' => make_help_popup($lang_donate['HELP_DONATION_ANON'], $lang_donate['TYPE_ANON']));
    }
    return donate_radio($radio,1);
}

/*==============================================================================================
    Function:    make_message()
    In:          N/A
    Return:      Creates the message/reason box or not
    Notes:       N/A
================================================================================================*/
function make_message () {
    global $gen_configs, $lang_donate;

    if ($gen_configs['message'] == 'no') {
        return "<input type=\"hidden\" name=\"os1\" value=\"\" />\n";
    }
    $out = "<tr>\n<td align=\"right\">\n";
    $out .= $lang_donate['MESSAGE'].$lang_donate['BREAK'];
    $out .= "</td>\n<td>\n";
    $out .= donate_text_area('os1', '')."</td>\n</tr>\n";
    return $out;
}

/*==============================================================================================
    Function:    make_codes e()
    In:          N/A
    Return:      Creates the combo box of codes
    Notes:       N/A
================================================================================================*/
function make_codes () {
    global $gen_configs, $lang_donate;

    if (empty($gen_configs['codes'])) {
        return '';
    }
    $codes = $gen_configs['codes'];
    $codes = str_replace("\r\n", "\n", $codes);
    $codes = explode("\n", $codes);
    $radio[] = array('value' => $gen_configs['donation_code'], 'text' => $gen_configs['donation_name'], 'name' => 'item_name', 'checked' => 'checked="checked"');
    for ($i=1, $maxi=count($codes); $i < $maxi; $i=$i+2) {
        $j = $i - 1;
        $radio[] = array('value' => $codes[$i], 'text' => $codes[$j], 'name' => 'item_name', 'checked' => '');
    }
    return donate_radio($radio,1);
}

/*==============================================================================================
    Function:    make_donation()
    In:          N/A
    Return:      N/A
    Notes:       Makes the donation screen
================================================================================================*/
function make_donation () {
    global $gen_configs, $lang_donate, $module_name;

    OpenTable();
    if(!empty($gen_configs['page_image'])) {
        echo "<br /><div align=\"center\">\n";
        echo "<img src=\"".$gen_configs['page_image']."\" border=\"0\" alt=\"\" />";
        echo "</div>\n";
    }

    $url = (EVO_SERVER_URL != 'http://www.mysite.com' && EVO_SERVER_URL != 'http://--------.---' && EVO_SERVER_URL != 'http://') ? EVO_SERVER_URL : $_SERVER["HTTP_HOST"];
    $url = (substr($url,0,7) == 'http://') ? substr($url,7) : $url;
    $url = (substr($url,-1) == '/') ? substr($url,0, -1) : $url;
    echo "<div align=\"center\"><br /><br />\n";
    echo '<form action="modules.php?name='.$module_name.'&amp;op=confirm" method="post">';
    // cmd = which action have to be done from paypal
    // _xclick = "buy now" || _cart = "Cart"  || _ext-enter = "with formular data - buy now" || s_x_click = "all information is crypted"
    echo "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\" />\n";
    // notify_url => url-encoded website adress wherein PayPal sends transaction information    
    echo "<input type=\"hidden\" name=\"notify_url\" value=\"http://".$url."/modules.php?name=".$module_name."&amp;op=thankyou\" />\n";
    // redirect_cmd => must be _xclick if "cmd" is set to _ext-enter otherwise it isn't used
    echo "<input type=\"hidden\" name=\"redirect_cmd\" value=\"_xlick\" />\n";
    // address_override => should be set to 1 if formular overrides the donators paypal account informations
    // echo "<input type=\"hidden\" name=\"address_override\" value=\"1\" />\n";
    // currency_code => in which currency the donation is done
    echo "<input type=\"hidden\" name=\"currency_code\" value=\"".$gen_configs['currency']."\" />\n";
    // business => the paypal account the donation is done for
    echo "<input type=\"hidden\" name=\"business\" value=\"".$gen_configs['pp_email']."\" />\n";
    // no_shipping => "1" = no additional delivery adress || "2" = a delivery adress must be added after paypal login
    echo "<input type=\"hidden\" name=\"no_shipping\" value=\"1\" />\n";
    // no_note => "0" = user can add aditional comments || "1" no comment field
    echo "<input type=\"hidden\" name=\"no_note\" value=\"1\" />\n";
    // cancel_return => url where a cancelation of the donation is handled
    echo "<input type=\"hidden\" name=\"cancel_return\" value=\"http://".$url."/modules.php?name=".$module_name."&amp;op=cancel\" />\n";
    // return => url where a successfull donation is handled
    echo "<input type=\"hidden\" name=\"return\" value=\"http://".$url."/modules.php?name=".$module_name."&amp;op=thankyou\" />\n";
    // rm => "1" = all returned informations from paypal are "get"-variables || "2" all returned informations are "post"-variables
    echo "<input type=\"hidden\" name=\"rm\" value=\"2\" />\n";
    // cbt => text for button on paypal if transaction is successfull to get back to url "return"
    echo "<input type=\"hidden\" name=\"cbt\" value=\"".$lang_donate['PAYPAL_BACK']."\" />\n";
    // on0 => informational field
    echo "<input type=\"hidden\" name=\"on0\" value=\"Info\" />\n";
    if(is_user()) {
        global $userinfo;
        //Get username and id
        $uname = "message|".$userinfo['user_id'] . "|". $userinfo['username'];
        echo "<input type=\"hidden\" name=\"on1\" value=\"".$uname."\" />\n";
    } else {
        echo "<input type=\"hidden\" name=\"on1\" value=\"message\" />\n";
    }
    if (empty($gen_configs['codes'])) {
        echo "<input type=\"hidden\" name=\"item_name\" value=\"".$gen_configs['donation_code']."\" />\n";
    }
    echo "<table width=\"45%\" border=\"0\" align=\"center\">\n";
    //Values
    echo "<tr>\n<td align=\"right\">\n".$lang_donate['AMOUNT'].$lang_donate['BREAK']."\n</td>\n<td>\n";
    echo make_other_value().make_display_values()."</td>\n</tr>\n";
    //Type
    $type = make_type();
    if (!empty($type)) {
        echo "<tr>\n<td align=\"right\">\n";
        echo $lang_donate['TYPE'].$lang_donate['BREAK'];
        echo "</td>\n<td>\n";
        echo $type;
        echo "</td>\n</tr>\n";
    } else {
        echo "<input type=\"hidden\" name=\"os0\" value=\"".NUKE_DONATIONS_REGULAR."\" />\n";
    }
    if (!empty($gen_configs['codes'])) {
        echo "<tr>\n<td align=\"right\">\n";
        echo $lang_donate['DONATE_TO'].$lang_donate['BREAK'];
        echo "</td>\n<td>\n";
        echo make_codes();
        echo "</td>\n</tr>\n";
    }
    echo make_message();
    //Button
  echo make_image_button();
  echo "</table>\n";
  echo "</form>\n";
  echo "</div>\n"; 
  CloseTable();
}

evo_setcookie('currency_code', 'delete', -1);
evo_setcookie('business', 'delete', -1);
evo_setcookie('on0', 'delete', -1);
evo_setcookie('on1', 'delete', -1);
evo_setcookie('item_name', 'delete', -1);
evo_setcookie('amount', 'delete', -1);
evo_setcookie('os0', 'delete', -1);
evo_setcookie('os1', 'delete', -1);

//Get values
global $gen_configs;
$gen_configs = get_gen_configs();
if (empty($gen_configs['pp_email'])) {
    OpenTable();
    DonateError($lang_donate['NO_PP_ADD'],1);
}
make_donation();
?>