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
    global $db, $admin_file, $_GETVAR, $evoconfig, $board_config, $cache;

    $act_uid  = $_GETVAR->get('act_uid', '_REQUEST', 'int');
    $query    = $_GETVAR->get('query', '_REQUEST', 'string');
    $min      = $_GETVAR->get('min', '_REQUEST', 'int');
    $xop      = $_GETVAR->get('xop', '_REQUEST', 'string');
    include_once(NUKE_MODULES_DIR.$module_name.'/public/functions_welcome_pm.php');
    include_once(NUKE_MODULES_DIR.$module_name.'/public/custom_functions.php');
    list($uname, $realname, $email, $upass, $ureg) = $db->sql_fetchrow($db->sql_query("SELECT username, realname, user_email, user_password, user_regdate FROM "._USERS_TEMP_TABLE." WHERE user_id='$act_uid'"));
    if ($evoconfig['servermail']) {
        $message = _SORRYTO." ".EVO_SERVER_SITENAME." "._HASAPPROVE . '<br /><br />';
        $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
        $subject = _SORRYTO." ".EVO_SERVER_SITENAME." "._HASAPPROVE;
        $to      = $email.', '.$uname;
        $return  = evo_mail($to, $subject, $message);
    }
    $db->sql_uquery("DELETE FROM "._USERS_TEMP_TABLE." WHERE user_id='$act_uid'");
    $db->sql_uquery("OPTIMIZE TABLE "._USERS_TEMP_TABLE);
    list($newest_uid) = $db->sql_ufetchrow("SELECT max(user_id) AS newest_uid FROM "._USERS_TABLE);
    if ($newest_uid < 2) { $new_uid = 2; } else { $new_uid = $newest_uid+1; }
    $db->sql_uquery("INSERT INTO "._USERS_TABLE." (user_id, name, username, user_email, user_regdate, user_password, user_level, user_active, user_avatar, user_avatar_type, user_from) VALUES ('$new_uid', '$realname', '$uname', '$email', '$ureg', '$upass', 1, 1, '', 3, '')");
    $res = $db->sql_query("SELECT * FROM "._CNBYA_VALUE_TEMP_TABLE." WHERE uid = '$act_uid'");
    while ($sqlvalue = $db->sql_fetchrow($res)) {
        $db->sql_uquery("INSERT INTO "._CNBYA_VALUE_TABLE." (uid, fid, value) VALUES ('$new_uid', '$sqlvalue[fid]','$sqlvalue[value]')");
    }
    $db->sql_freeresult($result);
    $db->sql_uquery("DELETE FROM "._CNBYA_VALUE_TEMP_TABLE." WHERE uid='$act_uid'");
    $db->sql_uquery("OPTIMIZE TABLE "._CNBYA_VALUE_TEMP_TABLE);
    $sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
            VALUES ('', 'Personal User', '1', '0')";
    if ( !($result = $db->sql_query($sql)) ) {
        DisplayError('Could not insert data into groups table<br />'.$sql);
    }
    $group_id = $db->sql_nextid();
    $sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
        VALUES ('$new_uid', '$group_id', '0')";
    if( !($result = $db->sql_query($sql)) ) {
        DisplayError('Could not insert data into user_group table<br />'.$sql);
    }
    send_pm($new_uid, $uname);
    init_group($new_uid);
    $cache->delete('numwaituser', 'submissions');
    $pagetitle = ': '._USERADMIN.' - '._YA_ACTIVATED;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    amain();
    echo "<br />\n";
    OpenTable();
    echo "<center><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
    if (isset($query)) { echo "<input type='hidden' name='query' value='$query' />\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='file' value='$xop' />\n"; }
    echo "<tr><td align='center'><strong>"._YA_ACTIVATED."</strong></td></tr>\n";
    echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
    echo "</form>\n";
    echo "</table></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>