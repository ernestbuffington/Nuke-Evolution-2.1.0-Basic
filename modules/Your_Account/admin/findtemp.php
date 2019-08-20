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
    global $db, $admin_file, $_GETVAR;

    $xusername   = $_GETVAR->get('xusername', '_REQUEST', 'string');
    $xuser_id    = $_GETVAR->get('xuser_id', '_REQUEST', 'int');
    $xuser_email = $_GETVAR->get('xuser_email', '_REQUEST', 'string');
    $pagetitle = ': '._USERADMIN.' - '._FINDTEMP;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title(_USERADMIN.' - '._FINDTEMP);
    amain();
    echo "<br />\n";
    if (isset($xusername) AND $xusername != '') {
        $sql = "SELECT * FROM "._USERS_TEMP_TABLE." WHERE username='$xusername'";
    } elseif (isset($xuser_id) AND $xuser_id != '') {
        $sql = "SELECT * FROM "._USERS_TEMP_TABLE." WHERE user_id='$xuser_id'";
    } elseif (isset($xuser_email) AND $xuser_email != '') {
        $sql = "SELECT * FROM "._USERS_TEMP_TABLE." WHERE user_email='$xuser_email'";
    }
    if($db->sql_numrows($db->sql_query($sql)) > 0) {
        $chnginfo = $db->sql_fetchrow($db->sql_query($sql));
        OpenTable();
        echo "<center><table border='0'>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._USERID.":</td><td><strong>".$chnginfo['user_id']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td><strong>".$chnginfo['username']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td><strong><a href='mailto:".$chnginfo['user_email']."'>".$chnginfo['user_email']."</a></strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._REGDATE.":</td><td><strong>".$chnginfo['user_regdate']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._CHECKNUM.":</td><td><strong>".$chnginfo['check_num']."</strong></td></tr>\n";
        echo "<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
        echo "<input type='hidden' name='file' value='modifyTemp' />\n";
        echo "<input type='hidden' name='chng_uid' value='".$chnginfo['user_id']."' />\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._MODIFY."' /></td></tr>\n";
        echo "</form>\n";
        echo "<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._RETURN."' /></td></tr>\n";
        echo "</form>\n";
        echo "</table></center>\n";
        CloseTable();
    } else {
        OpenTable();
        echo "<center><strong>"._TEMPNOEXIST."</strong></center>\n";
        CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>