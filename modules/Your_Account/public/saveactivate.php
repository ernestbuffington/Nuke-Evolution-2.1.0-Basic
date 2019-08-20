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
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

define_once('XDATA', true);
include_once(NUKE_INCLUDE_DIR.'functions.php');
include_once(NUKE_MODULES_DIR.'Your_Account/public/custom_functions.php');
$ya_username = trim(check_html($ya_username, 'nohtml'));
$check_num = trim(check_html($check_num, 'nohtml'));
$ya_time = intval($ya_time);
$xdata = array();
$xd_meta = get_xd_metadata();
while ( list($code_name, $meta) = each($xd_meta) )
{
    $xdata[$code_name] = (isset($_POST[$code_name]) && !empty($_POST[$code_name]) && $meta['handle_input']) ? trim($_POST[$code_name]) : '';
    if ( ($meta['field_length'] > 0) && (strlen($xdata[$code_name]) > $meta['field_length']) ) {
        $error = TRUE;
        $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf(_YA_XData_too_long, $meta['field_name']);
    }
    if ( ( count($meta['values_array']) > 0 ) && ( ! in_array($xdata[$code_name], $meta['values_array']) ) ) {
        $error = TRUE;
        $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf(_YA_XData_invalid, $meta['field_name']);
    }
    if ( ( strlen($meta['field_regexp']) > 0 ) && ( ! preg_match($meta['field_regexp'], $xdata[$code_name]) ) && (strlen($xdata[$code_name]) > 0) ) {
        $error = TRUE;
        $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf(_YA_XData_invalid, $meta['field_name']);
    }
    if ( $meta['manditory'] && empty($xdata[$code_name]) ) {
        global $lang;
        $error = TRUE;
        $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf(_YA_XData_invalid, $meta['field_name']);
    }
    if ($meta['handle_input']) {
        echo "<input type='hidden' name='".$name."' value=\"".$xdata[$name]."\" />\n";
    }
}

if ($error) {
    OpenTable();
    echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
    echo "<span class='content'>".$error_msg."<br /><br />"._GOBACK."</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}
$result = $db->sql_query("SELECT * FROM "._USERS_TEMP_TABLE." WHERE username='$ya_username' AND check_num='$check_num' AND time='$ya_time'");
if ($db->sql_numrows($result) == 1) {
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $username = $row['username'];
    $user_email = $row['user_email'];
    $user_regdate = $row['user_regdate'];
    $user_password = $row['user_password'];
    $realname = ya_fixtext($realname);
    if(empty($realname)) { $realname = $row['username']; }
    $user_sig = str_replace("<br />", "\r\n", $user_sig);
    $user_sig = ya_fixtext($user_sig);
    $user_email = ya_fixtext($user_email);
    $femail = ya_fixtext($femail);
    $user_website = ya_fixtext($user_website);
    if (!preg_match("#http://#", $user_website) AND !empty($user_website)) { $user_website = "http://$user_website"; }
    $bio = str_replace("<br />", "\r\n", $bio);
    $bio = ya_fixtext($bio);
    $user_icq = ya_fixtext($user_icq);
    $user_aim = ya_fixtext($user_aim);
    $user_yim = ya_fixtext($user_yim);
    $user_msnm = ya_fixtext($user_msnm);
    $user_occ = ya_fixtext($user_occ);
    $user_from = ya_fixtext($user_from);
    $user_interests = ya_fixtext($user_interests);
    $user_dateformat = ya_fixtext($user_dateformat);
    $newsletter = intval($newsletter);
    $user_viewemail = intval($user_viewemail);
    $user_allow_viewonline = intval($user_allow_viewonline);
    $user_timezone = intval($user_timezone);
    list($latest_uid) = $db->sql_fetchrow($db->sql_query("SELECT max(user_id) AS latest_uid FROM "._USERS_TABLE));
    if ($latest_uid == '-1') { $new_uid = 1; } else { $new_uid = $latest_uid+1; }
    $lv = time();
    $db->sql_uquery("LOCK TABLES "._USERS_TABLE." WRITE");
    $db->sql_uquery("INSERT INTO "._USERS_TABLE." (user_id, user_avatar, user_avatar_type, user_lang, user_lastvisit, umode) VALUES ($new_uid, '', '3', '$language', '$lv', 'nested')");
    $db->sql_uquery("UPDATE "._USERS_TABLE." SET username='$username', name='$realname', user_email='$user_email', femail='$femail', user_website='$user_website', user_icq='$user_icq', user_aim='$user_aim', user_yim='$user_yim', user_msnm='$user_msnm', user_from='$user_from', user_occ='$user_occ', user_interests='$user_interests', newsletter='$newsletter', user_viewemail='$user_viewemail', user_allow_viewonline='$user_allow_viewonline', user_timezone='$user_timezone', user_dateformat='$user_dateformat', user_sig='$user_sig', bio='$bio', user_password='$user_password', user_regdate='$user_regdate' WHERE user_id='$new_uid'");
    $db->sql_query("UNLOCK TABLES");
    $db->sql_uquery("DELETE FROM "._USERS_TEMP_TABLE." WHERE username='$username'");
    $res = $db->sql_query("SELECT * FROM "._CNBYA_VALUE_TEMP_TABLE." WHERE uid = '".$row['user_id']."'");
    while ($sqlvalue = $db->sql_fetchrow($res)) {
     $db->sql_uquery("INSERT INTO "._CNBYA_VALUE_TABLE." (uid, fid, value) VALUES ('$new_uid', '".$sqlvalue['fid']."','".$sqlvalue['value']."')");
    }
    $db->sql_uquery("DELETE FROM "._CNBYA_VALUE_TEMP_TABLE." WHERE uid='".$row['user_id']."'");
    include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR . $module_name . '/public/functions_welcome_pm.php');
    title(_ACTIVATIONYES);
    OpenTable();
    $result = $db->sql_unumrows("SELECT user_id FROM "._USERS_TABLE." WHERE username='$username' AND user_password='$user_password'");
    if ($result == 1) {
        send_pm($new_uid,$ya_username);
        evo_setusercookie($new_uid);
        include_once(NUKE_MODULES_DIR. $module_name . '/public/custom_functions.php');
        init_group($new_uid);
        echo "<meta http-equiv=\"refresh\" content=\"modules.php?name=Your_Account\" />";
        echo "<center><strong>".$row['username'].":</strong> "._ACTMSG."</center>";
            $complete = 1;
    } else {
        echo "<center>"._SOMETHINGWRONG."</center><br />";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    if($complete) {
        header("Refresh: 3; URL=index.php");
        exit();
    }
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    title(""._ACTIVATIONERROR."");
    OpenTable();
    echo "<center>"._ACTERROR."</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

?>