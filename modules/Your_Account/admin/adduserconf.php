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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (!defined('YA_ADMIN')) {
    die('CNBYA admin protection');
}

if(is_mod_admin($module_name)) {
    global $module_name, $db, $cache, $_GETVAR, $board_config, $evoconfig;

    $min        = $_GETVAR->get('min', '_REQUEST', 'int');
    $xop        = $_GETVAR->get('xop', '_REQUEST', 'string');
    $add_email  = strtolower($_GETVAR->get('add_email', '_REQUEST', 'string'));
    $add_email2 = strtolower($_GETVAR->get('add_email2', '_REQUEST', 'string'));
    $add_pass   = $_GETVAR->get('add_pass', '_REQUEST', 'string');
    $add_pass2  = $_GETVAR->get('add_pass2', '_REQUEST', 'string');
    $add_uname  = $_GETVAR->get('add_uname', '_REQUEST', 'string');
    ya_userCheck($add_uname);
    ya_mailCheck($add_email, $add_email2);
    ya_passCheck($add_pass, $add_pass2);
    $add_name = ya_fixtext($_GETVAR->get('realname', '_REQUEST', 'string'));
    if(empty($add_name)) { $add_name = $add_uname; }
    $add_femail = ya_fixtext($_GETVAR->get('add_femail', '_REQUEST', 'string'));
    $add_url = check_html($_GETVAR->get('add_url', '_REQUEST', 'string'));
    if (!preg_match("#^http://#", $add_url) AND !empty($add_url)) { $add_url = "http://$add_url"; }
    $add_user_sig = str_replace("<br />", "\r\n", $_GETVAR->get('add_user_sig', '_REQUEST', 'string'));
    $add_user_sig = ya_fixtext($add_user_sig);
    $add_user_icq = ya_fixtext($_GETVAR->get('add_user_icq', '_REQUEST', 'string'));
    $add_user_aim = ya_fixtext($_GETVAR->get('add_user_aim', '_REQUEST', 'string'));
    $add_user_yim = ya_fixtext($_GETVAR->get('add_user_yim', '_REQUEST', 'string'));
    $add_user_msnm = ya_fixtext($_GETVAR->get('add_user_msnm', '_REQUEST', 'string'));
    $add_user_from = ya_fixtext($_GETVAR->get('add_user_from', '_REQUEST', 'string'));
    $add_user_occ = ya_fixtext($_GETVAR->get('add_user_occ', '_REQUEST', 'string'));
    $add_user_interest = ya_fixtext($_GETVAR->get('add_user_interest', '_REQUEST', 'string'));
    $add_user_viewemail = $_GETVAR->get('add_user_viewemail', '_REQUEST', 'int');
    $add_newsletter = $_GETVAR->get('add_newsletter', '_REQUEST', 'int');
    include_once(NUKE_MODULES_DIR.$module_name.'/public/functions_welcome_pm.php');
    include_once(NUKE_MODULES_DIR.$module_name.'/public/custom_functions.php');
    if (empty($stop)) {
        $user_password = $add_pass;
        $add_pass = EvoCrypt($add_pass);
        $user_regdate = date("M d, Y");
        list($newest_uid) = $db->sql_ufetchrow("SELECT max(user_id) AS newest_uid FROM "._USERS_TABLE);
        if ($newest_uid < 2) { $new_uid = 2; } else { $new_uid = $newest_uid+1; }
        $sql = "INSERT INTO "._USERS_TABLE;
        $sql .= "(user_id, name, username, user_email, femail, user_website, user_regdate, user_icq, user_aim, user_yim, user_msnm, user_from, user_occ, user_interests, user_viewemail, user_avatar, user_avatar_type, user_sig, user_password, newsletter, broadcast, popmeson)";
        $sql .= "VALUES ('$new_uid', '$add_name', '$add_uname', '$add_email', '$add_femail', '$add_url', '$user_regdate', '$add_user_icq', '$add_user_aim', '$add_user_yim', '$add_user_msnm', '$add_user_from', '$add_user_occ', '$add_user_intrest', '$add_user_viewemail', '', '3', '$add_user_sig', '$add_pass', '$add_newsletter', '1', '0')";
        $result = $db->sql_query($sql);
        $sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
            VALUES ('', 'Personal User', '1', '0')";
        $result = $db->sql_query($sql);
        $group_id = $db->sql_nextid();
        $sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
            VALUES ('$new_uid', '$group_id', '0')";
        $result = $db->sql_query($sql);
        if (count($nfield) > 0) {
            foreach ($nfield as $key => $var) {
                $nfield[$key] = ya_fixtext($nfield[$key]);
                if (($db->sql_numrows($db->sql_query("SELECT fid FROM "._CNBYA_VALUE_TABLE." WHERE fid='$key' AND uid = '$new_uid'"))) == 0) {
                    $sql = "INSERT INTO "._CNBYA_VALUE_TABLE." (uid, fid, value) VALUES ('$new_uid', '$key','$nfield[$key]')";
                    $db->sql_uquery($sql);
                } else {
                    $db->sql_uquery("UPDATE "._CNBYA_VALUE_TABLE." SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$new_uid'");
                }
            }
        }
        if (!$result) {
            $pagetitle = ': '._USERADMIN;
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
            echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            title(_USERADMIN);
            OpenTable();
            echo "<center><strong>"._ERRORSQL."</strong></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            return;
        } else {
            send_pm($new_uid, $add_uname);
            init_group($new_uid);
            if ($evoconfig['servermail']) {
                $message = _WELCOMETO." ".EVO_SERVER_SITENAME."!<br /><br />";
                $message .= _YOUUSEDEMAIL." ($add_email) "._TOREGISTER." ".EVO_SERVER_SITENAME.".<br /><br />";
                $message .= _FOLLOWINGMEM."<br />"._UNICKNAME." $add_uname<br />"._UPASSWORD." $user_password <br /><br />";
                $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
                $subject = _ACCOUNTCREATED;
                $to      = $add_email.', '.$add_uname;
                $return  = evo_mail($to, $subject, $message);
            }
            if (isset($min)) {
                $xmin = "&amp;min=$min";
            } else {
                $xmin = '';
            }
            if (isset($xop)) {
                $xxop = "&amp;file=$xop";
            } else {
                $xxop = '';
            }
            redirect("".$admin_file.".php?op=Your_Account"."$xxop"."$xmin");
        }
    } else {
        $pagetitle = ': '._USERADMIN;
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        title(_USERADMIN);
        amain();
        echo "<br />\n";
        OpenTable();
        echo "<strong>$stop</strong>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        return;
    }
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>