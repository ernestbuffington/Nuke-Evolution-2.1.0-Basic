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
    global $db, $admin_file, $_GETVAR, $evoconfig;

    $min    = $_GETVAR->get('min', '_REQUEST', 'int');
    $max    = $_GETVAR->get('max', '_REQUEST', 'int');
    $query  = $_GETVAR->get('query', '_REQUEST', 'string');
    $find   = $_GETVAR->get('find', '_REQUEST', 'string');
    $match  = $_GETVAR->get('match', '_REQUEST', 'string');
    $what   = $_GETVAR->get('what', '_REQUEST', 'string');
    $pagetitle = ': '._USERADMIN.' - '._SEARCHUSERS;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title(_USERADMIN.': '._SEARCHUSERS);
    amain();
    echo "<br />\n";
    asearch();
    echo "<br />\n";
    OpenTable();
    $query = str_replace('"','',$query);
    $query = str_replace("'",'',$query);
    if ($find == 'findUser') { $usertable = _USERS_TABLE; } else { $usertable = _USERS_TEMP_TABLE; }
    if ($match == 'equal') { $sign = "='$query'"; } else { $sign = "LIKE '%".$query."%'"; }
    if (!isset($min)) $min=0;
    if (!isset($max)) $max=$min+$evoconfig['perpage'];
    $totalselected = $db->sql_numrows($db->sql_query("SELECT user_id FROM $usertable WHERE $what $sign AND user_id >1"));
    echo "<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
    echo "<table align='center' cellpadding='2' cellspacing='2' bgcolor='$textcolor1' border='0'>\n";
    echo "<tr bgcolor='$bgcolor2'>\n<td><strong>"._USERID."</strong></td>\n";
    echo "<td><strong>"._USERNAME."</strong></td>\n";
    echo "<td align='center'><strong>"._UREALNAME."</strong></td>\n";
    echo "<td align='center'><strong>"._EMAIL."</strong></td>\n";
    echo "<td align='center'><strong>"._REGDATE."</strong></td>\n";
    echo "<td align='center'><strong>"._FUNCTIONS."</strong></td>\n</tr>\n";
    $result = $db->sql_query("SELECT * FROM $usertable WHERE $what $sign AND user_id > 1 ORDER BY username LIMIT $min,".$evoconfig['perpage']);
    while($chnginfo = $db->sql_fetchrow($result)) {
        echo "<tr bgcolor='$bgcolor1'>\n";
        echo "<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
        echo "<td>\n";
        echo "<input type='hidden' name='query' value='$query' />\n";
        echo "<input type='hidden' name='find' value='$find' />\n";
        echo "<input type='hidden' name='what' value='$what' />\n";
        echo "<input type='hidden' name='match' value='$match' />\n";
        echo "<input type='hidden' name='min' value='$min' />\n";
        echo "<input type='hidden' name='xop' value='$op' />\n";
        echo "<input type='hidden' name='chng_uid' value='".$chnginfo['user_id']."' />\n";
        echo "<input type='hidden' name='act_uid' value='".$chnginfo['user_id']."' />\n";
        echo $chnginfo['user_id']."</td>\n";
        echo "<td>".$chnginfo['username']."</td>\n";
        echo "<td align='center'>".$chnginfo['name']."</td>\n";
        echo "<td align='center'>".$chnginfo['user_email']."</td>\n";
        echo "<td align='center'>".$chnginfo['user_regdate']."</td>\n";
        echo "<td align='center'><select name='file'>\n";
        if ($find == 'tempUser') {
            echo "<option value='detailsTemp'>"._DETUSER."</option>\n";
            echo "<option value='modifyTemp'>"._MODIFY."</option>\n";
            echo "<option value='resendMail'>"._RESEND."</option>\n";
            echo "<option value='approveUser'>"._YA_APPROVE."</option>\n";
            echo "<option value='activateUser'>"._YA_ACTIVATE."</option>\n";
            echo "<option value='denyUser'>"._DENY."</option>\n";
        } else {
            echo "<option value='detailsUser'>"._DETUSER."</option>\n";
            echo "<option value='modifyUser'>"._MODIFY."</option>\n";
            // suspended
            if ($chnginfo['user_level'] == '0') { echo "<option value='restoreUser'>"._RESTORE."</option>\n"; }
            // deactivated
            if ($chnginfo['user_level'] == '-1') { echo "<option value='removeUser'>"._REMOVE."</option>\n"; }
            // active
            if ($chnginfo['user_level'] == 1) { echo "<option value='suspendUser'>"._SUSPEND."</option>\n"; }
            if ($chnginfo['user_level'] > -1) { echo "<option value='deleteUser'>"._YA_DEACTIVATE."</option>\n"; }
        }
        echo "</select><input type='submit' value='"._OK."' /></td>\n";
        echo "</form>\n";
        echo "</tr>\n";
    }
    $db->sql_freeresult($result);
    echo "</table>\n";
    echo "<br />\n";
    yapagenums($op, $totalselected, $evoconfig['perpage'], $max, $find, $what, $match, $query);
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>