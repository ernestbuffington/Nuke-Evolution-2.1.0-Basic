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
    global $admin_file, $db, $_GETVAR;

    $chng_uid = $_GETVAR->get('chng_uid', '_REQUEST', 'int');
    $query    = $_GETVAR->get('query', '_REQUEST', 'string');
    $min      = $_GETVAR->get('min', '_REQUEST', 'int');
    $xop      = $_GETVAR->get('xop', '_REQUEST', 'string');
    $pagetitle = ': '._USERADMIN.' - '._USERUPDATE;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title(_USERADMIN.' - '._USERUPDATE);
    amain();
    echo "<br />\n";
    $result = $db->sql_query("SELECT * FROM "._USERS_TABLE." WHERE user_id='$chng_uid' OR username='$chng_uid'");
    if($db->sql_numrows($result) > 0) {
        $chnginfo = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $result = $db->sql_query("SELECT * FROM "._CNBYA_FIELD_TABLE);
        while ($sqlvalue = $db->sql_fetchrow($result)) {
            list($value) = $db->sql_fetchrow( $db->sql_query("SELECT value FROM "._CNBYA_VALUE_TABLE." WHERE fid ='".$sqlvalue['fid']."' AND uid = '$chnginfo[user_id]'"));
            $chnginfo[$sqlvalue['name']] = $value;
        }
        $db->sql_freeresult($result);
        OpenTable();
        echo "<center><form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
        echo "<table border='0'>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._USERID.":</td><td><strong>".$chnginfo['user_id']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td><input type='text' name='chng_uname' value='".$chnginfo['username']."' size='20' /><br /><strong>"._YA_CHNGRISK."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":</td><td><input type='text' name='chng_name' value='".$chnginfo['name']."' size='45' maxlength='60' /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><input type='text' name='chng_url' value='".$chnginfo['user_website']."' size='45' maxlength='60' /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td><input type='text' name='chng_email' value='".$chnginfo['user_email']."' size='45' maxlength='60' />&nbsp;<span class='tiny'>"._REQUIRED."</span></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._FAKEEMAIL.":</td><td><input type='text' name='chng_femail' value='".$chnginfo['femail']."' size='45' maxlength='60' /></td></tr>\n";
        $result = $db->sql_query("SELECT * FROM "._CNBYA_FIELD_TABLE." WHERE need <> '0' ORDER BY pos");
        while ($sqlvalue = $db->sql_fetchrow($result)) {
              $t = $sqlvalue['fid'];
              $value2 = explode('::', $sqlvalue['value']);
              if (substr($sqlvalue['name'],0,1)=='_') {
                    eval( "\$name_exit = ".$sqlvalue['name'].";");
              } else {
                    $name_exit = $sqlvalue['name'];
              }
              if (count($value2) == 1) {
                    echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'><input type='text' name='nfield[$t]' value='".$chnginfo[$sqlvalue['name']]."' size='20' maxlength='".$sqlvalue['size']."' /></td></tr>\n";
              } else {
                    echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
                    echo "<select name='nfield[$t]'>\n";
                    for ($i = 0; $i<count($value2); $i++) {
                        if (trim($chnginfo[$sqlvalue['name']]) == trim($value2[$i])) {
                            $sel = "selected='selected'";
                        } else {
                            $sel = "";
                        }
                        echo "<option value=\"".trim($value2[$i])."\" $sel>$value2[$i]</option>\n";
                    }
                    echo "</select>";
                    echo "</td></tr>\n";
              }
        }
        $db->sql_freeresult($result);
        echo "<tr><td bgcolor='$bgcolor2'>"._ICQ.":</td><td><input type='text' name='chng_user_icq' value='".$chnginfo['user_icq']."' size='20' maxlength='20' /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._AIM.":</td><td><input type='text' name='chng_user_aim' value='".$chnginfo['user_aim']."' size='20' maxlength='20' /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YIM.":</td><td><input type='text' name='chng_user_yim' value='".$chnginfo['user_yim']."' size='20' maxlength='20' /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._MSNM.":</td><td><input type='text' name='chng_user_msnm' value='".$chnginfo['user_msnm']."' size='20' maxlength='20' /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._LOCATION.":</td><td><input type='text' name='chng_user_from' value='".$chnginfo['user_from']."' size='25' maxlength='60' /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._OCCUPATION.":</td><td><input type='text' name='chng_user_occ' value='".$chnginfo['user_occ']."' size='25' maxlength='60' /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._INTERESTS.":</td><td><input type='text' name='chng_user_interests' value='".$chnginfo['user_interests']."' size='25' maxlength='255' /></td></tr>\n";
        if ($chnginfo['user_viewemail'] ==1) { $cuv = "checked='checked'"; } else { $cuv = ""; }
        echo "<tr><td bgcolor='$bgcolor2'>"._OPTION.":</td><td><input type='checkbox' name='chng_user_viewemail' value='1' $cuv /> "._ALLOWUSERS."</td></tr>\n";
        if ($chnginfo['newsletter'] == 1) { $cnl = "checked='checked'"; } else { $cnl = ""; }
        echo "<tr><td bgcolor='$bgcolor2'>"._NEWSLETTER.":</td><td><input type='checkbox' name='chng_newsletter' value='1' $cnl /> "._YES."</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._SIGNATURE.":</td><td><textarea name='chng_user_sig' rows='6' cols='45'>".$chnginfo['user_sig']."</textarea></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._PASSWORD.":</td><td><input type='password' name='chng_pass' size='12' maxlength='12' /></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._RETYPEPASSWD.":</td><td><input type='password' name='chng_pass2' size='12' maxlength='12' />&nbsp;<span class='tiny'>"._FORCHANGES."</span></td></tr>\n";
        echo "<tr><td align='center' colspan='2'>\n";
        echo "<input type='hidden' name='chng_avatar' value='".$chnginfo['user_avatar']."' />\n";
        echo "<input type='hidden' name='chng_uid' value='$chng_uid' />\n";
        echo "<input type='hidden' name='old_uname' value='".$chnginfo['username']."' />\n";
        echo "<input type='hidden' name='old_email' value='".$chnginfo['user_email']."' />\n";
        echo "<input type='hidden' name='file' value='modifyUserConf' />\n";
        if (isset($query)) { echo "<input type='hidden' name='query' value='$query' />\n"; }
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
        echo "<input type='submit' value='"._SAVECHANGES."' /></td></tr>\n";
        echo "</table></form>\n";
        echo "<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
        echo "<table border='0'>\n";
        echo "<tr><td align='center' colspan='2'>\n";
        if (isset($query)) { echo "<input type='hidden' name='query' value='$query' />\n"; }
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
        echo "<input type='submit' value='"._CANCEL."' /></td></tr>\n";
        echo "</table></form></center>\n";
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