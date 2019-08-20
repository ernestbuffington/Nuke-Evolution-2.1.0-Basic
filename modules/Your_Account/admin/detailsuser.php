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
    $sql = "SELECT * FROM "._USERS_TABLE." WHERE user_id='$chng_uid'";
    if($db->sql_numrows($db->sql_query($sql)) > 0) {
        $chnginfo = $db->sql_fetchrow($db->sql_query($sql));
        $result = $db->sql_query("SELECT * FROM "._CNBYA_FIELD_TABLE);
        while ($sqlvalue = $db->sql_fetchrow($result)) {
            list($value) = $db->sql_fetchrow( $db->sql_query("SELECT value FROM "._CNBYA_VALUE_TABLE." WHERE fid ='".$sqlvalue['fid']."' AND uid = '".$chnginfo['user_id']."'"));
            $chnginfo[$sqlvalue['name']] = $value;
        }
        $db->sql_freeresult($result);
        OpenTable();
        echo "<center><table border='0'>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._USERID.":</td><td><strong>".$chnginfo['user_id']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td><strong>".$chnginfo['username']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":</td><td><strong>".$chnginfo['name']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><strong><a href='".$chnginfo['user_website']."' target='_blank'>".$chnginfo['user_website']."</a></strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td><strong><a href='mailto:".$chnginfo['user_email']."'>".$chnginfo['user_email']."</a></strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._REGDATE.":</td><td><strong>".$chnginfo['user_regdate']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._FAKEEMAIL.":</td><td><strong>".$chnginfo['femail']."</strong></td></tr>\n";

        $result = $db->sql_query("SELECT * FROM "._CNBYA_FIELD_TABLE." ORDER BY pos");
        while ($sqlvalue = $db->sql_fetchrow($result)) {
          if (substr($sqlvalue['name'],0,1)=='_') {
                eval( "\$name_exit = ".$sqlvalue['name'].";");
          } else {
                $name_exit = $sqlvalue['name'];
          }
          echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td><strong>".$chnginfo[$sqlvalue['name']]."</strong></td></tr>\n";
        }
        $db->sql_freeresult($result);
        echo "<tr><td bgcolor='$bgcolor2'>"._ICQ.":</td><td><strong>".$chnginfo['user_icq']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._AIM.":</td><td><strong>".$chnginfo['user_aim']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YIM.":</td><td><strong>".$chnginfo['user_yim']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._MSNM.":</td><td><strong>".$chnginfo['user_msnm']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._LOCATION.":</td><td><strong>".$chnginfo['user_from']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._OCCUPATION.":</td><td><strong>".$chnginfo['user_occ']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._INTERESTS.":</td><td><strong>".$chnginfo['user_interests']."</strong></td></tr>\n";
        if ($chnginfo['user_viewemail'] == 1) { $cuv = _YES; } else { $cuv = _NO; }
        echo "<tr><td bgcolor='$bgcolor2'> "._SHOWMAIL.":</td><td><strong>$cuv</strong></td></tr>\n";
        if ($chnginfo['newsletter'] == 1) { $cnl = _YES; } else { $cnl = _NO; }
        echo "<tr><td bgcolor='$bgcolor2'>"._NEWSLETTER.":</td><td><strong>$cnl</strong></td></tr>\n";
        $chnginfo['user_sig'] = preg_replace('#^\r\n#', '<br />', $chnginfo['user_sig']);
        echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._SIGNATURE.":</td><td><strong><xmp>".$chnginfo['user_sig']."</xmp></strong></td></tr>\n";
        echo "<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
        echo "<input type='hidden' name='file' value='modifyUser' />\n";
        echo "<input type='hidden' name='chng_uid' value='".$chnginfo['user_id']."' />\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._MODIFY."' /></td></tr>\n";
        echo "</form>\n";
        echo "<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._RETURN."' /></td></tr>\n";
        echo "</form>\n";
        echo "</table></center>\n";
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