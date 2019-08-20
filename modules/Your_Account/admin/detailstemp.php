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

    $chng_uid = $_GETVAR->get('chng_uid', '_REQUEST', 'int');
    $query    = $_GETVAR->get('query', '_REQUEST', 'string');
    $min      = $_GETVAR->get('min', '_REQUEST', 'int');
    $xop      = $_GETVAR->get('xop', '_REQUEST', 'string');
    $pagetitle = ': '._USERADMIN.' - '._DETUSER;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title(_USERADMIN.' - '._DETUSER.": <em>$chng_uid</em>");
    amain();
    echo "<br />\n";
    $result = $db->sql_query("SELECT * FROM "._USERS_TEMP_TABLE." WHERE user_id='$chng_uid'");
    if($db->sql_numrows($result) > 0) {
        $chnginfo = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        OpenTable();
        echo "<center><table border='0'>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._USERID.":</td><td><strong><input type='text' value='".$chnginfo['user_id']."' size='40' disabled='disabled' style='color=#000000; background-color: #FFFFFF' /></strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td><strong><input type='text' value='".$chnginfo['username']."' size='40' disabled='disabled' style='color=#000000; background-color: #FFFFFF' /></strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":</td><td><strong><input type='text' value='".$chnginfo['realname']."' size='40' disabled='disabled' style='color=#000000; background-color: #FFFFFF' /></strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td><strong><a href='mailto:".$chnginfo['user_email']."'><input type='text' value='".$chnginfo['user_email']."' size='40' disabled='disabled' style='color=#000000; background-color: #FFFFFF' /></a></strong></td></tr>\n";
        $result = $db->sql_query("SELECT * FROM "._CNBYA_FIELD_TABLE." WHERE need <> '0' ORDER BY pos");
        while ($sqlvalue = $db->sql_fetchrow($result)) {
            $t = $sqlvalue['fid'];
            $result1 = $db->sql_query("SELECT * FROM "._CNBYA_VALUE_TEMP_TABLE." WHERE uid='$chng_uid' AND fid='$t'");
            while ($tmpsqlvalue = $db->sql_fetchrow($result1)) {
                $tmp_value=$tmpsqlvalue['value'];
                if (substr($sqlvalue['name'],0,1)=='_') {
                    eval( "\$name_exit = ".$sqlvalue['name'].";");
                } else {
                    $name_exit = $sqlvalue['name'];
                }
                echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'><strong><input type='text' value='$tmp_value' size='40' disabled='disabled' style='color=#000000; background-color: #FFFFFF' /></strong>";
                echo "</td></tr>\n";
            }
            $db->sql_freeresult($result1);
        }
        $db->sql_freeresult($result);
        echo "<tr><td bgcolor='$bgcolor2'>"._REGDATE.":</td><td><input type='text' value='".$chnginfo['user_regdate']."' size='40' disabled='disabled' style='color=#000000; background-color: #FFFFFF' /></td></tr>\n";
        $chnginfo['time'] = date("D M j H:i T Y", $chnginfo['time']);
        echo "<tr><td bgcolor='$bgcolor2'>"._YA_APPROVE2.":</td><td><input type='text' value='".$chnginfo['time']."' size='40' disabled='disabled' style='color=#000000; background-color: #FFFFFF' />&nbsp;</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._CHECKNUM.":</td><td><input type='text' value=".$chnginfo['check_num']." size='40' disabled='disabled' style='color=#000000; background-color: #FFFFFF' /></td></tr>\n";
        echo "<tr><td colspan=\"2\" align=\"left\"><br />\n";
        echo "<table cellspacing=\"0\" cellpadding=\"0\" border='0'><tr>\n";
        echo "<form action='".$admin_file.".php?op=Your_Account' method='post'><td>\n";
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
        echo "<input type='submit' value='"._RETURN."' /></td></form>\n";
        echo "<td width=\"3\"></td>\n";
        echo "<form action='".$admin_file.".php?op=Your_Account' method='post'><td>\n";
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
        echo "<input type='hidden' name='file' value='modifyTemp' />\n";
        echo "<input type='hidden' name='chng_uid' value='".$chnginfo['user_id']."' />\n";
        echo "<input type='submit' value='"._MODIFY."' /></td></form>\n";
        echo "<td width=\"3\"></td>\n";
        echo "<form action='".$admin_file.".php?op=Your_Account' method='post'><td>\n";
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
        echo "<input type='hidden' name='file' value='denyUser' />\n";
        echo "<input type='hidden' name='chng_uid' value='".$chnginfo['user_id']."' />\n";
        echo "<input type='submit' value='"._DENY."' /></td></form>\n";
        echo "<td width=\"3\"></td>\n";
        if ($evoconfig['useactivate'] == 0) {
            echo "<form action='".$admin_file.".php?op=Your_Account' method='post'><td valign=\"top\">\n";
            if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
            if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
            echo "<input type='hidden' name='file' value='approveUserConf' />\n";
            echo "<input type='hidden' name='apr_uid' value='".$chnginfo['user_id']."' />\n";
            echo "<input type='submit' value='"._YA_APPROVE."' /></td></form>\n";
        } else {
            echo "<form action='".$admin_file.".php?op=Your_Account' method='post'><td>\n";
            if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
            if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
            echo "<input type='hidden' name='file' value='activateUser' />\n";
            echo "<input type='hidden' name='act_uid' value='".$chnginfo['user_id']."' />\n";
            echo "<input type='submit' value='"._YA_ACTIVATE."' /></td></form>\n";
        }
        echo "</tr></table>\n";
        echo "</td></tr><tr><td colspan=\"2\"><strong>"._NOTE."</strong>\n";
        echo "</td></tr><tr><td colspan=\"2\"><strong>"._YA_APPROVENOTE."</strong>\n";
        echo "</td></tr><tr><td colspan=\"2\"><strong>"._YA_ACTIVATENOTE."</strong>\n";
        echo "</td></tr></table></center>\n";
        echo "<br />\n";
        CloseTable();
    } else {
        OpenTable();
        echo "<center><strong>"._USERNOEXIST."</strong></center>\n";
        CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>