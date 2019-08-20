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
    $pagetitle = ': '._USERADMIN.' - '._WAITINGUSERS;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title(_USERADMIN.": "._WAITINGUSERS);
    amain();
    echo "<br />\n";
    OpenTable();
    if (!isset($min)) $min=0;
    if (!isset($max)) $max=$min+$evoconfig['perpage'];
    $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM "._USERS_TEMP_TABLE));
    echo "<table align='center' cellpadding='2' cellspacing='2' bgcolor='$textcolor1' border='0'>\n";
    echo "<tr bgcolor='$bgcolor2'>\n<td><strong>"._USERNAME." ("._USERID.")</strong></td>\n";
    echo "<td align='center'><strong>"._UREALNAME."</strong></td>\n";
    echo "<td align='center'><strong>"._EMAIL."</strong></td>\n";
    echo "<td align='center'><strong>"._REGDATE."</strong></td>\n";
    echo "<td align='center'><strong>"._FUNCTIONS."</strong></td>\n</tr>\n";
    $result = $db->sql_query("SELECT * FROM "._USERS_TEMP_TABLE." ORDER BY time LIMIT $min,".$evoconfig['perpage']);
    while($chnginfo = $db->sql_fetchrow($result)) {
        echo "<tr bgcolor='$bgcolor1'>\n<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
        echo "<input type='hidden' name='min' value='$min' />\n";
        echo "<input type='hidden' name='xop' value='$op' />\n";
        echo "<input type='hidden' name='apr_uid' value='".$chnginfo['user_id']."' />\n";
        echo "<input type='hidden' name='act_uid' value='".$chnginfo['user_id']."' />\n";
        echo "<input type='hidden' name='chng_uid' value='".$chnginfo['user_id']."' />\n";
        echo "<td>".$chnginfo['username']." (".$chnginfo['user_id'].")</td>\n";
        echo "<td align='center'>".$chnginfo['realname']."</td>\n";
        echo "<td align='center'>".$chnginfo['user_email']."</td>\n";
        echo "<td align='center'>".$chnginfo['user_regdate']."</td>\n";
        echo "<td align='center'><select name='file'>\n";
        echo "<option value='detailsTemp' selected='selected'>"._DETUSER."</option>\n";
        echo "<option value='approveUser'>"._YA_APPROVE."</option>\n";
        echo "<option value='activateUser'>"._YA_ACTIVATE."</option>\n";
        echo "<option value='modifyTemp'>"._MODIFY."</option>\n";
        echo "<option value='denyUser'>"._DENY."</option>\n";
        echo "<option value='resendMail'>"._RESEND."</option>\n";
        echo "</select><input type='submit' value='"._OK."' />\n";
        echo "</td></form></tr>\n";
    }
    $db->sql_freeresult($result);
    echo "";
    echo "</td></table>\n";
    echo "<br />\n";
    yapagenums($op, $totalselected, $evoconfig['perpage'], $max, '', '', '', '');
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>