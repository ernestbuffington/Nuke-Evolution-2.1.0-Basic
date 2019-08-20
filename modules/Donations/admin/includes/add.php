<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		#$#BASE
 Nuke-Evo Version       :		#$#VER
 Nuke-Evo Build         :		#$#BUILD
 Nuke-Evo Patch         :		#$#PATCH
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		#$#DATE

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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

//Close the open table
CloseTable();
echo '<br />';
//Start a new table
OpenTable();

/*==============================================================================================
    Function:    username()
    In:          N/A
    Return:      Combo box of user names
    Notes:       N/A
================================================================================================*/
function username($username='None') {
    global $db, $lang_donate;
    $in[] = array('value' => 'N/A', 'text' => _NONE);
    $sql = 'SELECT username FROM `'._USERS_TABLE.'` WHERE `user_active` = 1 AND `user_level` > 0 AND `user_id` <> "'.ANONYMOUS.'"  ORDER BY username ASC';
    if(!$result = $db->sql_query($sql)) {
        DonateError($lang_donate['UNAMES_NF']);
    }
    while($row = $db->sql_fetchrow($result)) {
        $in[] = array('value' => $row[0], 'text' => $row[0]);
    }
    $db->sql_freeresult($result);
    $username = (empty($username)) ? 'None' : $username;
    return  donate_combo('uname', $in, $username);
}

/*==============================================================================================
    Function:    types()
    In:          N/A
    Return:      The type of donations
    Notes:       N/A
================================================================================================*/
function types() {
    global $db, $lang_donate;
    $sql = 'SELECT config_value, config_name FROM `'._DONATIONS_DONATOR_CONFIG_TABLE.'` WHERE config_name="gen_type_private"';
    if(!$result = $db->sql_query($sql)) {
        DonateError($lang_donate['TYPES_NF']);
    }
    $row = $db->sql_fetchrow($result);
    $type[$row['config_name']] = $row[0];
    $db->sql_freeresult($result);
    if ($type['gen_type_private'] == 'yes') {
        $in[] = array('value' => NUKE_DONATIONS_PRIVAT, 'text' => $lang_donate['TYPE_PRIVATE']);
        $in[] = array('value' => NUKE_DONATIONS_REGULAR, 'text' => $lang_donate['TYPE_REGULAR']);
        $ret = "<tr>\n
            <td align=\"right\">".$lang_donate['ADD_TYPE'].$lang_donate['BREAK']."</td>\n
            <td align=\"left\">".donate_combo('donshow', $in, NUKE_DONATIONS_REGULAR)."</td>\n
          </tr>\n";
        return $ret;
    }
    return  '<input type="hidden" name="donshow" value="'.NUKE_DONATIONS_REGULAR.'" />';
}

/*==============================================================================================
    Function:    make_message()
    In:          N/A
    Return:      Creates the message/reason box or not
    Notes:       N/A
================================================================================================*/
function make_message ($msg) {
    global $gen_configs, $lang_donate;

    if ($gen_configs['message'] == 'no') {
        return "<input type=\"hidden\" name=\"os1\" value=\"\" />\n";
    }
    $out = "<tr>\n<td align=\"right\">\n";
    $out .= $lang_donate['MESSAGE'].$lang_donate['BREAK'];
    $out .= "</td>\n<td align=\"left\">\n";
    $out .= donate_text_area('os1', $msg)."</td>\n</tr>\n";
    return $out;
}

/*==============================================================================================
    Function:    make_codes e()
    In:          N/A
    Return:      Creates the combo box of codes
    Notes:       N/A
================================================================================================*/
function make_codes () {
    global $db, $lang_donate;
    $sql = 'SELECT config_value, config_name FROM `'._DONATIONS_DONATOR_CONFIG_TABLE.'`';
    if(!$result = $db->sql_query($sql)) {
        DonateError($lang_donate['TYPES_NF']);
    }
    while ($row = $db->sql_fetchrow($result)) {
        $gen_configs[$row['config_name']] = $row[0];
    }
    $db->sql_freeresult($result);
    if (empty($gen_configs['gen_codes'])) {
       return "<input type=\"hidden\" name=\"item_name\" value=\"".$gen_configs['gen_donation_code']."\" />\n";
    }
    $codes = $gen_configs['gen_codes'];
    $codes = str_replace("\r\n", "\n", $codes);
    $codes = explode("\n", $codes);
    $radio[] = array('value' => $gen_configs['gen_donation_code'], 'text' => $gen_configs['gen_donation_name'], 'name' => 'item_name', 'checked' => 'CHECKED');
    for ($i=1, $maxi=count($codes); $i < $maxi; $i=$i+2) {
        $j = $i - 1;
        $radio[] = array('value' => $codes[$i], 'text' => $codes[$j], 'name' => 'item_name', 'checked' => '');
    }
    return donate_radio($radio,1);
}

/*==============================================================================================
    Function:    add_donation()
    In:          N/A
    Return:      N/A
    Notes:       Displays the on screen the add a donation
================================================================================================*/
function add_donation() {
    global $lang_donate, $admin_file, $_GETVAR, $db;
    echo "<form id=\"values\" method=\"post\" action=\"".$admin_file.".php?op=Donations&amp;file=add\">\n";
    echo "<table width=\"100%\" border=\"0\" align=\"center\">\n";
    echo "<tr>\n
            <td width=\"100%\" colspan=\"2\">";
    $id = $_GETVAR->get('id', 'GET', 'int');
    $username = $fname = $lname = $email = $donated = '';
    if (!empty($id)) {
        $sql = 'SELECT * FROM `'._DONATIONS_DONATOR_TABLE.'` WHERE `id`="'.$id.'" LIMIT 0,1';
        if ($row = $db->sql_ufetchrow($sql)) {
            $username = $row['uname'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $donated = $row['donated'];
            $msg = $row['msg'];
        }
        echo "<span style=\"font-weight: bold; font-size: 20px;\">".$lang_donate['EDIT_DONATION']."</span>";
        echo "<input type=\"hidden\" name=\"id\" value=\"".$id."\" />\n";
    } else {
        echo "<span style=\"font-weight: bold; font-size: 20px;\">".$lang_donate['ADD_DONATION']."</span>";
    }
    echo "</td></tr>\n";
    echo "<tr>\n
            <td width=\"50%\" align=\"right\">".$lang_donate['UNAME'].$lang_donate['BREAK']."</td>\n
            <td width=\"50%\" align=\"left\">".username($username)."</td>\n
          </tr>\n";
    echo "<tr>\n
            <td align=\"right\">".$lang_donate['FIRST_NAME'].$lang_donate['BREAK']."</td>\n
            <td align=\"left\">".donate_text('fname', $fname)."</td>\n
          </tr>\n";
    echo "<tr>\n
            <td align=\"right\">".$lang_donate['LAST_NAME'].$lang_donate['BREAK']."</td>\n
            <td align=\"left\">".donate_text('lname', $lname)."</td>\n
          </tr>\n";
    echo "<tr>\n
            <td align=\"right\">".$lang_donate['EMAIL_ADD'].$lang_donate['BREAK']."</td>\n
            <td align=\"left\">".donate_text('email', $email)."</td>\n
          </tr>\n";
    echo "<tr>\n
            <td align=\"right\">".$lang_donate['DONATION'].$lang_donate['BREAK']."</td>\n
            <td align=\"left\">".donate_text('donated', $donated, 5, 10)."</td>\n
          </tr>\n";
    echo types();
    echo "<tr><td align=\"right\">\n";
    echo $lang_donate['DONATE_TO'].$lang_donate['BREAK'];
    echo "</td><td align=\"left\">\n";
    echo make_codes();
    echo "</td></tr>\n";
    echo make_message($msg);
    echo '<tr><td colspan="2"><div align="center"><input type="submit" value="'._SUBMIT.'" /></div></td></tr>';
    echo "</table></form>\n";
}

/*==============================================================================================
    Function:    check_donation()
    In:          N/A
    Return:      N/A
    Notes:       Validates the donation
================================================================================================*/
function check_donation() {
    global $lang_donate;
    if ($_POST['uname'] == 'N/A') {
        if (empty($_POST['fname'])) {
            DonateError($lang_donate['MISSING_FNAME']);
        }
        if (empty($_POST['lname'])) {
            DonateError($lang_donate['MISSING_LNAME']);
        }
    }
    if(!preg_match('/[\d\.]/',$_POST['donated'])) {
        DonateError($lang_donate['INVALID_DONATION']);
    }
}

/*==============================================================================================
    Function:    write_donation()
    In:          N/A
    Return:      N/A
    Notes:       Writes the donation to the DB
================================================================================================*/
function write_donation() {
    global $lang_donate, $db, $cache, $_GETVAR;
    if ($_POST['uname'] != 'N/A') {
        $_POST['uname'] = Fix_Quotes($_POST['uname'], true);
        $sql = 'SELECT * FROM `'._USERS_TABLE.'` WHERE `username`="'.$_POST['uname'].'" LIMIT 0,1';
        if(!$result = $db->sql_query($sql)) {
            DonateError($lang_donate['UINFO_NF']);
        }
        $user = $db->sql_fetchrow($result);
        if(!is_array($user)) {
            DonateError($lang_donate['UINFO_NF']);
        }
        $db->sql_freeresult($result);
        $uname = $_POST['uname'];
        $uid = $user['user_id'];
        if (!empty($_POST['fname'])) {
            $fname = Fix_Quotes($_POST['fname'], true);
            $lname = Fix_Quotes($_POST['lname'], true);
        } else {
            if (substr_count($user['name'], ' ') == 1) {
                list($fname, $lname) = preg_split('# #',$user['name']);
            } else {
                $fname = $user['name'];
                $lname = '';
            }
        }
        if (empty($_POST['email'])) {
            $email = $user['user_email'];
        } else {
            $email = Fix_Quotes($_POST['email'], true);
        }
        $donto = Fix_Quotes($_POST['item_name'], true);
    } else {
        $uname = '';
        $uid = '0';
        $fname = Fix_Quotes($_POST['fname'], true);
        $lname = Fix_Quotes($_POST['lname'], true);
        $email = Fix_Quotes($_POST['email'], true);
        $donto = Fix_Quotes($_POST['item_name'], true);
    }
    $msg     = Fix_Quotes($_POST['os1'], true);
    $donated = Fix_Quotes($_POST['donated'], true);
    $donshow = ($_POST['donshow'] == NUKE_DONATIONS_REGULAR) ? '1' : '2';
    $id = $_GETVAR->get('id', 'POST', 'int');
    if (empty($id)) {
        $sql = 'INSERT INTO `'._DONATIONS_DONATOR_TABLE.'` (`id`, `uid`, `uname`, `fname`, `lname`, `email`, `donated`, `dondate`, `donshow`, `uip`, `donok`, `msg`, `donto`) VALUES ("","'.$uid.'","'.$uname.'","'.$fname.'","'.$lname.'","'.$email.'","'.$donated.'",'.time().',"'.$donshow.'","","","'.$msg.'","'.$donto.'")';
    } else {
        $sql = 'UPDATE `'._DONATIONS_DONATOR_TABLE.'` SET `uname`="'.$uname.'", `uid`="'.$uid.'", `fname`="'.$fname.'", `lname`="'.$lname.'", `email`="'.$email.'", `donated`="'.$donated.'", `donto`="'.$donto.'", `donshow`="'.$donshow.'", `msg`="'.$msg.'" WHERE `id`='.$id;
    }
    $db->sql_query($sql);
    //Clear the cache
    $cache->delete('donations', 'donations');
    $cache->delete('donations_goal', 'donations');
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

//If new values were posted
echo '<div style="text-align:center;">';
if (!empty($_POST)) {
    global $lang_donate;
    check_donation();
    write_donation();
    echo $lang_donate['ADDED'];
} else {
    add_donation();
}
echo '</div>';

?>