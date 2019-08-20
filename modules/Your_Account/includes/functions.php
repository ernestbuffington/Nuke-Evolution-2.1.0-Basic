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

if (!defined('MODULE_FILE') && !defined('ADMIN_FILE') ) {
   die('You can\'t access this file directly...');
}

global $module_name;

/*************************************************************************************/
// function Show_CNBYA_menu(){ [added by menelaos dot hetnet dot nl']
/*************************************************************************************/
function Show_CNBYA_menu($show_header_cookie = TRUE){
    global $stop, $module_name, $redirect, $mode, $t, $f, $evoconfig;
    OpenTable();
    if ($stop) {
        echo "<center><span class=\"title\"><strong>"._LOGININCOR."</strong></span></center>\n";
    } else {
        echo "<center><span class=\"title\"><strong>"._USERREGLOGIN."</strong></span></center>\n";
    }
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr><td align=\"left\"><span class=\"content\">\n";
    echo "[ <a href=\"modules.php?name=$module_name\">"._LOGIN."</a> \n";
    echo "| <a href=\"modules.php?name=$module_name&amp;op=new_user\">"._REGNEWUSER."</a> ]\n";
    echo "</span>\n";
    echo "</td><td align=\"right\"><span class=\"content\">\n";
    echo "[ <a href=\"modules.php?name=$module_name&amp;op=pass_lost\">"._PASSWORDLOST."</a> \n";
    if ($show_header_cookie) {
        echo "| <a href=\"modules.php?name=$module_name&amp;op=ShowCookiesRedirect\">"._YA_COOKIEDELALL."</a> \n";
    }
    echo " ]</span>\n";
    echo "</td></tr></table>\n";
    CloseTable();
    echo "<br />";
    return;
}

function ya_securityCheck($gfx_input) {
    global $stop, $db, $evoconfig, $module_name;

    $gfxchk = array(3,4,6,7);
    if (!security_code_check($gfx_input, $gfxchk, $module_name)) {
        $stop .= "<br /><center>"._SECCODEINCOR."</center><br />";
    }
    return;
}

function ya_userCheck($username) {
    global $stop, $db, $evoconfig;

    // Need to find a way to include extended caracters
    if(!Validate($username, 'username', '', 1, 1)) {
        $stop .= "<br /><center>"._ERRORINVNICK."</center><br />";
    }
    if (empty($stop) && (strlen($username) > $evoconfig['nick_max'] || strlen($username) < $evoconfig['nick_min'])) {
        $stop .= "<br /><center>"._YA_NICKLENGTH."</center>";
    }
    if (empty($stop) && (strrpos($username,' ') > 0)) {
        $stop .= "<br /><center>"._NICKNOSPACES."</center>";
    }
    if (empty($stop) && ($db->sql_unumrows("SELECT username FROM "._USERS_TABLE." WHERE username='$username'") > 0)) {
        $stop .= "<br /><center>"._NICKTAKEN."</center><br />";
    }
    if (empty($stop) && ($db->sql_unumrows("SELECT username FROM "._USERS_TEMP_TABLE." WHERE username='$username'") > 0)) {
        $stop .= "<br /><center>"._NICKTAKEN."</center><br />";
    }
    $temp_name = check_words($username);
    if ($temp_name != $username) {
        $stop .= "<br /><center>"._NAMERESTRICTED."</center><br />";
    }
    return;
}

function ya_realuserCheck($username) {
    global $stop, $db, $evoconfig;

    // Need to find a way to include extended caracters
    if(!isset($username) || empty($username)) {
        $stop .= "<br /><center>"._YA_ERRORINREALNAME."</center><br />";
    }
    $temp_name = check_words($username);
    if ($temp_name != $username) {
        $stop .= "<br /><center>"._NAMERESTRICTED."</center><br />";
    }
    return;
}

function ya_mailCheck($user_email, $user_email2='') {
    global $stop, $db, $evoconfig;

    if ($evoconfig['doublecheckemail']==1) {
        if (empty($user_email2) || $user_email2 != $user_email) {
            $stop .= "<br /><center>"._EMAILDIFFERENT."</center><br />";
        }
    }
    $user_email = strtolower($user_email);
    if ((!$user_email) || (empty($user_email)) || (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*?[a-z]+$/is', $user_email))) {
        $stop .= "<br /><center>"._ERRORINVEMAIL."</center><br />";
    }
    if (!empty($user_email)) {
        if (preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*?[a-z]+$/is', $user_email)) {
            $sql = "SELECT ban_email FROM " . BANLIST_TABLE;
            if ($result = $db->sql_query($sql)) {
                if ($row = $db->sql_fetchrow($result)) {
                    do {
                        $match_email = str_replace('*', '.*?', $row['ban_email']);
                        if (preg_match('/^' . $match_email . '$/is', $user_email)) {
                            $db->sql_freeresult($result);
                            $stop .= "<br /><center>"._MAILBLOCKED.": $match_email</center";
                            break;
                        }
                    } while($row = $db->sql_fetchrow($result));
                }
            }
            $db->sql_freeresult($result);
        }
    }
    if (strrpos($user_email,' ') > 0) {
        $stop .= "<br /><center>"._ERROREMAILSPACES."</center><br />";
    }
    if ($db->sql_unumrows("SELECT user_email FROM "._USERS_TABLE." WHERE user_email='$user_email'") > 0) {
        $stop .= "<br /><center>"._EMAILREGISTERED."</center><br />";
    }
    if ($db->sql_unumrows("SELECT user_email FROM "._USERS_TABLE." WHERE user_email='".md5($user_email)."'") > 0) {
        $stop .= "<br /><center>"._EMAILNOTUSABLE."</center><br />";
    }
    if ($db->sql_unumrows("SELECT user_email FROM "._USERS_TEMP_TABLE." WHERE user_email='$user_email'") > 0) {
        $stop .= "<br /><center>"._EMAILREGISTERED."</center><br />";
    }
    $hostpart_email = substr(stristr($user_email, '@'), 1);
    if (gethostbyname($hostpart_email)) {
        if (!checkdnsrr($hostpart_email, 'MX')) {
            $stop .= "<br /><center>"._YA_ERRORNOEMAILSERVER."</center><br />";
        }
    } else {
        $stop .= "<br /><center>"._YA_ERRORNOSERVER."</center><br />";
    }
    return;
}

function ya_passCheck($user_pass1, $user_pass2) {
    global $stop, $evoconfig;

    if (strlen($user_pass1) > $evoconfig['pass_max']) {
        $stop .= "<center>"._YA_PASSLENGTH."</center><br />";
    }
    if (strlen($user_pass1) < $evoconfig['pass_min']) {
        $stop .= "<center>"._YA_PASSLENGTH."</center><br />";
    }
    if ($user_pass1 != $user_pass2) {
        $stop .= "<center>"._PASSWDNOMATCH."</center><br />";
    }
    return;
}

function ya_fixtext($ya_fixtext) {
    if (empty($ya_fixtext)) { return $ya_fixtext; }
    $ya_fixtext = Fix_Quotes($ya_fixtext);
    return $ya_fixtext;
}


function yacookie($setuid, $setusername, $setpass, $setstorynum, $setumode, $setuorder, $setthold, $setnoscore, $setublockon, $settheme, $setcommentmax) {
    global $evoconfig, $db, $userinfo;
    $ip     = $userinfo['user_ip'];
    $result = $db->sql_query("SELECT time FROM "._SESSION_TABLE." WHERE uname='$setusername'");
    $ctime  = time();
    $guest  = 0;
    if (!empty($setusername)) {
        $uname = substr($setusername, 0,25);
        if ($row = $db->sql_fetchrow($result)) {
            $db->sql_uquery("UPDATE "._SESSION_TABLE." SET uname='$setusername', time='$ctime', host_addr='$ip', guest='$guest' WHERE uname='$uname'");
        } else {
            $db->sql_uquery("INSERT INTO "._SESSION_TABLE." (uname, time, host_addr, guest, starttime) VALUES ('$uname', '$ctime', '$ip', '$guest', '$ctime')");
        }
    }
    $db->sql_freeresult($result);
    $info = "$setuid:$setusername:$setpass:$setstorynum:$setumode:$setuorder:$setthold:$setnoscore:$setublockon:$settheme:$setcommentmax";
    if ($evoconfig['cookietimelife'] != '-') {
        evo_setcookie('user', $info, $evoconfig['cookietimelife']);
    } else {
        evo_setcookie('user', $info, 0);
    };
    evo_setcookie($evoconfig['cookie_name'] . '_data', 'delete', -1);
    evo_setcookie($evoconfig['cookie_name'] . '_sid', 'delete', -1);
    evo_setcookie('theme', 'delete', -1);
    evo_setcookie('user_language', 'delete', -1);
    evo_setcookie('CNB_test1', 'delete', -1);
    $db->sql_uquery("DELETE FROM "._SESSION_TABLE." WHERE uname='".$ip."' AND guest='1'");
    $db->sql_uquery("UPDATE "._USERS_TABLE." SET last_ip='".$ip."' WHERE username='".$setusername."'");
}

function YA_CoolSize($size) {
    $mb = 1024*1024;
    if ( $size > $mb ) {
        $mysize = sprintf ('%01.2f',$size/$mb) . ' MB';
    } elseif ( $size >= 1024 ) {
        $mysize = sprintf ('%01.2f',$size/1024) . ' Kb';
    } else {
        $mysize = $size . ' bytes';
    }
    return $mysize;
}

// Borrowed from Nuke 7.8 Ads module
function YA_MakePass() {
    static $makepass;
    if(!empty($makepass)) return $makepass;
    $cons = 'bcdfghjklmnpqrstvwxyz';
    $vocs = 'aeiou';
    for ($x=0; $x < 6; $x++) {
        mt_srand ((double) microtime() * 1000000);
        $con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
        $voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
    }
    mt_srand((double)microtime()*1000000);
    $num1 = mt_rand(0, 9);
    $num2 = mt_rand(0, 9);
    $makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];
    return $makepass;
}

if (is_mod_admin($module_name)) {
    function ya_save_config($config_name, $config_value, $config_param=""){
        global $db, $cache;
        Fix_Quotes($config_value);
        if($config_param == 'html') {
            $config_name = check_html($config_name, 'nohtml');
            $config_value = check_html($config_value, 'html');
            $db -> sql_uquery("UPDATE "._CNBYA_CONFIG_TABLE." SET config_value='$config_value' WHERE config_name='$config_name'");
        }
        if($config_param == 'nohtml') {
            $config_name = check_html($config_name, 'nohtml');
            $config_value = ya_fixtext(check_html($config_value, 'nohtml'));
            $db -> sql_uquery("UPDATE "._CNBYA_CONFIG_TABLE." SET config_value='$config_value' WHERE config_name='$config_name'");
        } else {
            $config_name=check_html($config_name, 'nohtml');
            $config_value = intval($config_value);
            $db -> sql_uquery("UPDATE "._CNBYA_CONFIG_TABLE." SET config_value='$config_value' WHERE config_name='$config_name'");
        }
        $cache->delete('evoconfig', 'config');
        $cache->resync();
    }
    
    function ya_get_configs(){
        global $db, $cache, $evoconfig;
        return $evoconfig;
    }
    
    function amain() {
        global $evoconfig, $module_name, $db, $bgcolor1, $admin_file;
        $cnbyaversion = $evoconfig['version'];
    
        OpenTable();
        $act = $db->sql_numrows($db->sql_query("SELECT user_id FROM "._USERS_TABLE." WHERE user_level>'0' AND user_id>'1'"));
        $sus = $db->sql_numrows($db->sql_query("SELECT user_id FROM "._USERS_TABLE." WHERE user_level='0' AND user_id>'1'"));
        $del = $db->sql_numrows($db->sql_query("SELECT user_id FROM "._USERS_TABLE." WHERE user_level='-1' AND user_id>'1'"));
        $nor = $db->sql_numrows($db->sql_query("SELECT user_id FROM "._USERS_TABLE." WHERE user_id>'1'"));
        $pen = $db->sql_numrows($db->sql_query("SELECT user_id FROM "._USERS_TEMP_TABLE));
    
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0' width='100%'>\n";
        echo "<tr bgcolor='$bgcolor1'>\n";
        echo "<td align='center' width='50%'><a href='".$admin_file.".php?op=Your_Account&amp;file=addUser'>"._ADDUSER."</a></td>\n";
        echo "<td align='right'><a href='".$admin_file.".php?op=Your_Account&amp;file=listnormal&amp;query=1'>"._ACTIVEUSERS.":</a></td>";
        echo "<td align='left'>($act)</td>\n";
        echo "</tr>\n";
        echo "<tr bgcolor='$bgcolor1'>";
        echo "<td align='center' width='50%'><a href='".$admin_file.".php?op=Your_Account&amp;file=addField'>"._YA_ADDFIELD."</a></td>\n";
        echo "<td align='right'><a href='".$admin_file.".php?op=Your_Account&amp;file=listnormal&amp;query=a'>"._NORMALUSERS.":</a></td>";
        echo "<td align='left'>($nor)</td>\n";
        echo "</tr>\n";
        echo "<tr bgcolor='$bgcolor1'>\n";
        echo "<td align='center' width='50%'><a href='".$admin_file.".php?op=Your_Account&amp;file=searchUser'>"._SEARCHUSERS."</a></td>\n";
        echo "<td align='right'><a href='".$admin_file.".php?op=Your_Account&amp;file=listnormal&amp;query=-1'>"._DELETEUSERS.":</a></td>";
        echo "<td align='left'>($del)</td>\n";
        echo "</tr>\n";
        echo "<tr bgcolor='$bgcolor1'>\n";
        echo "<td align='center' width='50%'>&nbsp;</td>\n";
        echo "<td align='right'><a href='".$admin_file.".php?op=Your_Account&amp;file=listnormal&amp;query=0'>"._SUSPENDUSERS.":</a></td>";
        echo "<td align='left'>($sus)</td>\n";
        echo "</tr>\n";
        echo "<tr bgcolor='$bgcolor1'>\n";
        echo "<td align='center' width='50%'><a href='".$admin_file.".php?op=Your_Account&amp;file=credits'>"._CREDITS."</a></td>\n";
        echo "<td align='right'><a href='".$admin_file.".php?op=Your_Account&amp;file=listpending'>"._WAITINGUSERS.":</a></td>";
        echo "<td align='left'>($pen)</td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        CloseTable();
    }
    
    function asearch() {
        global $admin_file, $module_name, $bgcolor2, $bgcolor1, $textcolor1, $find, $what, $match, $query, $db;
        OpenTable();
        echo "<form method='post' action='".$admin_file.".php?op=Your_Account'>\n";
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0' bgcolor='$bgcolor1'>\n";
        echo "<tr>\n";
        echo "<td align='center'><strong>"._YA_FIND.":</strong></td>\n";
        echo "<td align='center'><strong>"._YA_BY.":</strong></td>\n";
        echo "<td align='center'><strong>"._YA_MATCH.":</strong></td>\n";
        echo "<td align='center'><strong>"._YA_QUERY.":</strong></td>\n";
        echo "</tr>\n<tr>\n";
        if ($find == 'tempUser') { $sel1 = ''; $sel2 = ' selected=\'selected\''; } else { $sel1 = ' selected=\'selected\''; $sel2 = ''; }
        echo "<td align='center'><select name='find'>\n";
        echo "<option value='findUser'$sel1>"._YA_REGLUSER."</option>\n";
        echo "<option value='tempUser'$sel2>"._YA_TEMPUSER."</option>\n";
        echo "</select></td>\n";
        echo "<td align='center'><select name='what'>\n";
        $result = $db->sql_query("DESCRIBE "._USERS_TABLE);
        $allowed_fields = array('user_id',
                                'name',
                                'username',
                                'user_email',
                                'femail',
                                'user_website',
                                'user_avatar',
                                'user_regdate',
                                'user_icq',
                                'user_occ',
                                'user_from',
                                'user_interests',
                                'user_sig',
                                'user_viewemail',
                                'user_aim',
                                'user_yim',
                                'user_msnm',
                                'storynum',
                                'bio',
                                'theme',
                                'newsletter',
                                'user_posts',
                                'user_rank',
                                'user_level',
                                'user_active',
                                'user_lastvisit',
                                'user_timezone',
                                'user_lang',
                                'user_dateformat',
                                'user_allowhtml',
                                'user_allowbbcode',
                                'user_allowsmile',
                                'user_allowavatar',
                                'user_allow_pm',
                                'user_allow_mass_pm',
                                'user_allow_viewonline',
                                'user_notify',
                                'user_notify_pm',
                                'user_popup_pm',
                                'user_avatar_type',
                                'last_ip',
                                'agreedtos',
                                'user_allowsignature',
                                'user_showsignatures');
        while($row = $db->sql_fetchrow($result)){
            if( in_array($row[0], $allowed_fields)) {
                $ya_field_name = constant('_YA_'.$row[0]);
                echo "<option value='" . $row[0]."' " . ((($what == $row[0]) || (empty($what) && $row[0] == 'username') )? 'selected=\'selected\'' : '') . ">" . $ya_field_name . "</option>\n";
            }
        }
        $db->sql_freeresult($result);
        echo "</select></td>\n";
        if ($match == 'equal') { $sel1 = ''; $sel2 = ' selected=\'selected\''; } else { $sel1 = ' selected=\'selected\''; $sel2 = ''; }
        echo "<td align='center'><select name='match'>\n";
        echo "<option value='like' $sel1>"._YA_LIKE."</option>\n";
        echo "<option value='equal' $sel2>"._YA_EQUAL."</option>\n";
        echo "</select></td>\n";
        echo "<td align='center'><input type='text' name='query' value='$query' size='30' maxlength='60' /></td>\n";
        echo "<td align='center'><input type='hidden' name='file' value='listresults' /><input type='submit' value='"._YA_SEARCH."' /></td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo "</form>\n";
        CloseTable();
    }
}

function mmain($user) {
    global $stop, $module_name, $redirect, $mode, $t, $f, $evoconfig, $user, $p, $userinfo;
    if(is_user()) {
        redirect("modules.php?name=$module_name&amp;op=userinfo&amp;username=".$userinfo['username']);
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        Show_CNBYA_menu();
        OpenTable();
        echo "<form action=\"modules.php?name=$module_name\" method=\"post\"><table border=\"0\">\n";
        echo "<tr><td>"._NICKNAME.":</td><td><input type=\"text\" name=\"username\" size=\"15\" maxlength=\"25\" /></td></tr>\n";
        echo "<tr><td>"._PASSWORD.":</td><td><input type=\"password\" name=\"user_password\" size=\"15\" maxlength=\"20\" AutoComplete=\"off\" /></td></tr>\n";
        $cnbchk = array(2,4,5,7);
        echo security_code($cnbchk, 'large', 0, $module_name);
        echo "<tr><td colspan='2'>\n";
        echo "<input type=\"hidden\" name=\"redirect\" value=\"$redirect\" />\n";
        echo "<input type=\"hidden\" name=\"mode\" value=\"$mode\" />\n";
        echo "<input type=\"hidden\" name=\"f\" value=\"$f\" />\n";
        echo "<input type=\"hidden\" name=\"t\" value=\"$t\" />\n";
        echo "<input type=\"hidden\" name=\"p\" value=\"$p\" />\n";
        echo "<input type=\"hidden\" name=\"op\" value=\"login\" />\n";
        echo "<input type=\"submit\" value=\""._LOGIN."\" />";
        if ($evoconfig['useactivate'] == 0) { echo "<br />("._BESUREACT.")\n"; }
        echo "</td></tr></table></form><br />\n\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }
}


function yapagenums($op, $totalselected, $perpage, $max, $find, $what, $match, $query) {
    global $admin_file, $module_name;
    $pagesint = ($totalselected / $perpage);
    $pageremainder = ($totalselected % $perpage);
    if ($pageremainder != 0) {
        $pages = ceil($pagesint);
        if ($totalselected < $perpage) { $pageremainder = 0; }
    } else {
        $pages = $pagesint;
    }
    if ($pages != 1 && $pages != 0) {
        $counter = 1;
        $currentpage = ($max / $perpage);
        echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
        echo "<tr><form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
        echo "<input type='hidden' name='op' value='$op' />\n";
        if ($what > '')    { echo "<input type='hidden' name='what' value='$what' />\n"; }
        if ($find > '')    { echo "<input type='hidden' name='find' value='$find' />\n"; }
        if ($match > '')    { echo "<input type='hidden' name='match' value='$match' />\n"; }
        if ($query > '')    { echo "<input type='hidden' name='query' value='$query' />\n"; }
        echo "<td align='center'><strong>"._YA_SELECTPAGE.": </strong><select name='min' />\n";
        while ($counter <= $pages ) {
            $mintemp = ($perpage * $counter) - $perpage;
            if($counter == $currentpage) {
                echo "<option selected='selected'>$counter</option>\n";
            } else {
                echo "<option value='$mintemp'>$counter</option>\n";
            }
            $counter++;
        }
        echo "</select><strong> "._YA_OF." $pages "._YA_PAGES."</strong>&nbsp;<input type='submit' value='"._YA_GO."' /></td>\n</form>\n</tr>\n";
        echo "</table>\n";
    }
}

function disabled() {
    DisplayError("<span class='option'>"._ACTDISABLED."</span>");
}

function notuser() {
    DisplayError("<span class='option'>"._MUSTBEUSER."</span>");
}

?>