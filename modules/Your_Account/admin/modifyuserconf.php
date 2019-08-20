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

    $chng_uid       = $_GETVAR->get('chng_uid', '_POST', 'int');
    $chng_uname     = $_GETVAR->get('chng_uname', '_POST', 'string');
    $old_uname      = $_GETVAR->get('old_uname', '_POST', 'string');
    $chng_name      = $_GETVAR->get('chng_name', '_POST', 'string');
    $chng_email     = $_GETVAR->get('chng_email', '_POST', 'string');
    $old_email      = $_GETVAR->get('old_email', '_POST', 'string');
    $chng_femail    = $_GETVAR->get('chng_femail', '_POST', 'string');
    $chng_url       = $_GETVAR->get('chng_url', '_POST', 'string');
    $chng_user_icq  = $_GETVAR->get('chng_user_icq', '_POST', 'string');
    $chng_user_aim  = $_GETVAR->get('chng_user_aim', '_POST', 'string');
    $chng_user_yim  = $_GETVAR->get('chng_user_yim', '_POST', 'string');
    $chng_user_msnm = $_GETVAR->get('chng_user_msnm', '_POST', 'string');
    $chng_user_occ  = $_GETVAR->get('chng_user_occ', '_POST', 'string');
    $chng_user_from = $_GETVAR->get('chng_user_from', '_POST', 'string');
    $chng_user_interests = $_GETVAR->get('chng_user_interests', '_POST', 'string');
    $chng_avatar    = $_GETVAR->get('chng_avatar', '_POST', 'string');
    $chng_user_viewemail = $_GETVAR->get('chng_user_viewemail', '_POST', 'int');
    $chng_user_sig  = $_GETVAR->get('chng_user_sig', '_POST', 'string');
    $chng_pass      = $_GETVAR->get('chng_pass', '_POST', 'string');
    $chng_pass2     = $_GETVAR->get('chng_pass2', '_POST', 'string');
    $chng_newsletter = $_GETVAR->get('chng_newsletter', '_POST', 'int');
    $nfield         = $_GETVAR->get('nfield', '_POST', 'array', array());
    $query          = $_GETVAR->get('query', '_REQUEST', 'string');
    $min            = $_GETVAR->get('min', '_REQUEST', 'int');
    $xop            = $_GETVAR->get('xop', '_REQUEST', 'string');
    $stop = '';
    if ($chng_uname != $old_uname) { ya_userCheck($chng_uname); }
    if ($chng_email != $old_email) { ya_mailCheck($chng_email); }
    if (!empty($chng_pass) OR !empty($chng_pass2)) { ya_passCheck($chng_pass, $chng_pass2); }
    $chng_uname = ya_fixtext($chng_uname);
    $chng_name = ya_fixtext($chng_name);
    $chng_email = ya_fixtext($chng_email);
    $chng_femail = ya_fixtext($chng_femail);
    $chng_url = ya_fixtext($chng_url);
    $chng_user_icq = ya_fixtext($chng_user_icq);
    $chng_user_aim = ya_fixtext($chng_user_aim);
    $chng_user_yim = ya_fixtext($chng_user_yim);
    $chng_user_msnm = ya_fixtext($chng_user_msnm);
    $chng_user_occ = ya_fixtext($chng_user_occ);
    $chng_user_from = ya_fixtext($chng_user_from);
    $chng_user_interests = ya_fixtext($chng_user_interests);
    $chng_avatar = ya_fixtext($chng_avatar);
    $chng_user_viewemail = intval($chng_user_viewemail);
    $chng_user_sig = ya_fixtext($chng_user_sig);
    $chng_newsletter = intval($chng_newsletter);
    if (empty($stop)) {
        if (!empty($chng_pass)) {
            $cpass = EvoCrypt($chng_pass);
            $db->sql_uquery("UPDATE "._USERS_TABLE." SET username='$chng_uname', name='$chng_name', user_email='$chng_email', femail='$chng_femail', user_website='$chng_url', user_icq='$chng_user_icq', user_aim='$chng_user_aim', user_yim='$chng_user_yim', user_msnm='$chng_user_msnm', user_from='$chng_user_from', user_occ='$chng_user_occ', user_interests='$chng_user_interests', user_viewemail='$chng_user_viewemail', user_avatar='$chng_avatar', user_sig='$chng_user_sig', user_password='$cpass', newsletter='$chng_newsletter' WHERE user_id='$chng_uid'");
        } else {
            $db->sql_uquery("UPDATE "._USERS_TABLE." SET username='$chng_uname', name='$chng_name', user_email='$chng_email', femail='$chng_femail', user_website='$chng_url', user_icq='$chng_user_icq', user_aim='$chng_user_aim', user_yim='$chng_user_yim', user_msnm='$chng_user_msnm', user_from='$chng_user_from', user_occ='$chng_user_occ', user_interests='$chng_user_interests', user_viewemail='$chng_user_viewemail', user_avatar='$chng_avatar', user_sig='$chng_user_sig', newsletter='$chng_newsletter' WHERE user_id='$chng_uid'");
        }
        if (count($nfield) > 0) {
            foreach ($nfield as $key => $var) {
                $nfield[$key] = ya_fixtext($nfield[$key]);
                if (($db->sql_numrows($db->sql_query("SELECT fid FROM "._CNBYA_VALUE_TABLE." WHERE fid='$key' AND uid = '$chng_uid'"))) == 0) {
                    $sql = "INSERT INTO "._CNBYA_VALUE_TABLE." (uid, fid, value) VALUES ('$chng_uid', '$key','$nfield[$key]')";
                    $db->sql_query($sql);
                }
                else {
                    $db->sql_uquery("UPDATE "._CNBYA_VALUE_TABLE." SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$chng_uid'");
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
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
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