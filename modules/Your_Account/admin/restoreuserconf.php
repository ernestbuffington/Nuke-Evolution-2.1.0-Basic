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
    global $db, $admin_file, $_GETVAR, $evoconfig, $board_config;

    $res_uid  = $_GETVAR->get('res_uid', '_REQUEST', 'int');
    $query    = $_GETVAR->get('query', '_REQUEST', 'string');
    $min      = $_GETVAR->get('min', '_REQUEST', 'int');
    $xop      = $_GETVAR->get('xop', '_REQUEST', 'string');
    list($email, $username) = $db->sql_fetchrow($db->sql_query("SELECT user_email, username FROM "._USERS_TABLE." WHERE user_id='$res_uid'"));
    if ($evoconfig['servermail']) {
        $message = _SORRYTO." ".EVO_SERVER_SITENAME." "._HASRESTORE . '<br /><br />';
        $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
        $subject = _ACCTRESTORE;
        $to      = $email.', '.$username;
        $return  = evo_mail($to, $subject, $message);
    }
    $db->sql_uquery("UPDATE "._USERS_TABLE." SET user_level='1', user_active='1' WHERE user_id='$res_uid'");
    $pagetitle = ': '._USERADMIN.' - '._ACCTRESTORE;
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
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
    echo "<tr><td align='center'><strong>"._ACCTRESTORE."</strong></td></tr>\n";
    echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
    echo "</form>\n";
    echo "</table></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>