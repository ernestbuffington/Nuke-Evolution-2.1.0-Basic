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

if (is_mod_admin($module_name)) {
    global $db, $admin_file, $_GETVAR, $evoconfig, $board_config;

    $act_uid  = $_GETVAR->get('act_uid', '_REQUEST', 'int');
    $min      = $_GETVAR->get('min', '_REQUEST', 'int');
    $xop      = $_GETVAR->get('xop', '_REQUEST', 'string');
    $pagetitle = ': '._USERADMIN.' - '._YA_ACTIVATEUSER;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    list($username, $realname, $email, $check_num) = $db->sql_fetchrow($db->sql_query("SELECT username, realname, user_email, check_num FROM "._USERS_TEMP_TABLE." WHERE user_id='$act_uid'"));

    title(_USERADMIN." - "._YA_ACTIVATEUSER);
    amain();
    echo "<br />\n";
    OpenTable();
    echo "<center><table align='center' border='0' cellpadding='0' cellspacing='0'>\n";
    echo "<tr><td align=center><strong>"._SURE2ACTIVATE.":</strong></td></tr><td><br />\n";
    OpenTable();
    echo "<table align='center' border='0' align=\"center\">";
    echo "<tr><td width=\"50%\"><strong>"._USERNAME.":</strong></td><td align=\"left\">$username<br /></td></tr>";
    echo "<tr><td width=\"50%\"><strong>"._UREALNAME.":</strong></td><td align=\"left\">$realname<br /></td></tr>";
    echo "<tr><td width=\"50%\"><strong>"._EMAIL.":</strong></td><td align=\"left\">$email</td></tr>";
    echo "</table>";
    CloseTable();
    echo "<br /></td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\">\n";
    echo "<table cellspacing=\"0\" cellpadding=\"0\" border='0' align=\"center\"><tr>\n";
    echo "<form action='".$admin_file.".php?op=Your_Account' method='post'><td width=\"49%\" align=\"right\">\n";
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
    echo "<input type='hidden' name='file' value='activateUserConf' />\n";
    echo "<input type='hidden' name='act_uid' value='$act_uid' />\n";
    echo "<input type='submit' value='"._YES."' /></td></form>\n";
    echo "<td width=\"10\"></td>\n";
    echo "<form action='".$admin_file.".php?op=Your_Account' method='post'><td width=\"49%\" align=\"left\">\n";
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='file' value='$xop' />\n"; }
    echo "<input type='submit' value='"._NO."' /></td></form>\n";
    echo "</tr><tr><td colspan=\"3\" align=\"center\">\n";
    echo "<br /><strong>"._YA_ACTIVATEWARN1."</strong>\n";
    echo "<br /><strong>"._YA_ACTIVATEWARN2."</strong>\n";
    echo "</td></tr><tr>\n";
    echo "<form action='".$admin_file.".php?op=Your_Account' method='post'><td colspan=\"3\" align=\"center\">\n";
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
    echo "<input type='hidden' name='file' value='approveUserConf' />\n";
    echo "<input type='hidden' name='apr_uid' value='$act_uid' />\n";
    echo "<input type='submit' value='"._YA_APPROVEUSER."' /></td></form>\n";
    echo "</tr></table>\n";
    echo "</td></tr></table></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>