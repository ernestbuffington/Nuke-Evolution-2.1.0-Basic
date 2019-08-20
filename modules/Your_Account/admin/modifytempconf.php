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
    $chng_uname = $_GETVAR->get('chng_uname', '_REQUEST', 'string');
    $old_uname  = $_GETVAR->get('old_uname', '_REQUEST', 'string');
    $chng_email = $_GETVAR->get('chng_email', '_REQUEST', 'string');
    $old_email  = $_GETVAR->get('old_email', '_REQUEST', 'string');
    $nfield     = $_GETVAR->get('nfield', '_REQUEST', 'array', array());
    $stop = '';
    if ($chng_uname != $old_uname) { ya_userCheck($chng_uname); }
    if ($chng_email != $old_email) { ya_mailCheck($chng_email); }
    if (empty($stop)) {
        $time = time();
        $db->sql_uquery("UPDATE "._USERS_TEMP_TABLE." SET username='$chng_uname', realname='$chng_realname',  user_email='$chng_email' WHERE user_id='$chng_uid'");
        if (count($nfield) > 0) {
         foreach ($nfield as $key => $var) {
         $nfield[$key] = ya_fixtext($nfield[$key]);
         if (($db->sql_numrows($db->sql_query("SELECT fid FROM "._CNBYA_VALUE_TEMP_TABLE." WHERE fid='$key' AND uid = '$chng_uid'"))) == 0) {
            $sql = "INSERT INTO "._CNBYA_VALUE_TEMP_TABLE." (uid, fid, value) VALUES ('$chng_uid', '$key','$nfield[$key]')";
            $db->sql_query($sql);
          }
          else {
            $db->sql_uquery("UPDATE "._CNBYA_VALUE_TEMP_TABLE." SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$chng_uid'");
          }
         }
        }
        $pagetitle = ': '._USERADMIN.' - '._ACCTMODIFY;
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
        if (isset($min))   { echo "<input type='hidden' name='min' value='$min' />\n"; }
        if (isset($xop))   { echo "<input type='hidden' name='file' value='$xop' />\n"; }
        echo "<tr><td align='center'><strong>"._ACCTMODIFY."</strong></td></tr>\n";
        echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
        echo "</form>\n";
        echo "</table></center>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
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