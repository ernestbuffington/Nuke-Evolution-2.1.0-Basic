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

    $min      = $_GETVAR->get('min', '_REQUEST', 'int');
    $xop      = $_GETVAR->get('xop', '_REQUEST', 'string');
    $pagetitle = ': '._USERADMIN.' - '._ADDUSER;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Your_Account\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title(_USERADMIN.' - '._ADDUSER);
    amain();
    echo "<br />\n";
    OpenTable();
    echo "<center><form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
    echo "<table border='0'>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_uname' size='30' maxlength='".$evoconfig['nick_max']."' />&nbsp;<span class='tiny'>"._REQUIRED."</span></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_name' size='30' maxlength='50' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_email' size='30' maxlength='60' />&nbsp;<span class='tiny'>"._REQUIRED."</span></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._RETYPEEMAIL.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_email2' size='30' maxlength='60' />&nbsp;<span class='tiny'>"._REQUIRED."</span></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._FAKEEMAIL.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_femail' size='30' maxlength='60' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_url' size='30' maxlength='60' /></td></tr>\n";

    $result = $db->sql_query("SELECT * FROM "._CNBYA_FIELD_TABLE." WHERE need <> '0' ORDER BY pos");
    while ($sqlvalue = $db->sql_fetchrow($result)) {
      $t = $sqlvalue['fid'];
      $value2 = explode("::", $sqlvalue['value']);
      if (substr($sqlvalue['name'],0,1)=='_') {
        eval( "\$name_exit = ".$sqlvalue['name'].";");
      } else {
        $name_exit = $sqlvalue['name'];
      }
      if (count($value2) == 1) {
        echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
        echo "<input type='text' name='nfield[$t]' size='20' maxlength='".$sqlvalue['size']."' />\n";
      } else {
        echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
        echo "<select name='nfield[$t]'>\n";
        for ($i = 0; $i<count($value2); $i++) {
            echo "<option value=\"".trim($value2[$i])."\">".trim($value2[$i])."</option>\n";
        }
      echo "</select>";
      }
      if (($sqlvalue['need']) > 1) {
        echo"&nbsp;<span class='tiny'>"._REQUIRED."</span>";
      }
      echo"<span class='tiny'>"._REQUIRED."</span>";
      echo "</td></tr>\n";
    }
    $db->sql_freeresult($result);
    echo "<tr><td bgcolor='$bgcolor2'>"._ICQ.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_user_icq' size='20' maxlength='20' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._AIM.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_user_aim' size='20' maxlength='20' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YIM.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_user_yim' size='20' maxlength='20' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._MSNM.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_user_msnm' size='20' maxlength='20' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._LOCATION.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_user_from' size='25' maxlength='60' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._OCCUPATION.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_user_occ' size='25' maxlength='60' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._INTERESTS.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_user_intrest' size='25' maxlength='255' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._OPTION.":</td><td bgcolor='$bgcolor1'><input type='checkbox' name='add_user_viewemail' value='1' /> "._ALLOWUSERS."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._NEWSLETTER.":</td><td bgcolor='$bgcolor1'><input type='checkbox' name='add_newsletter' value='1' /> "._YES."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._SIGNATURE.":</td><td bgcolor='$bgcolor1'><textarea name='add_user_sig' rows='6' cols='45'></textarea></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._PASSWORD.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_pass' size='12' maxlength='".$evoconfig['pass_max']."' />&nbsp;<span class='tiny'>"._REQUIRED."</span></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._RETYPEPASSWORD.":</td><td bgcolor='$bgcolor1'><input type='text' name='add_pass2' size='12' maxlength='".$evoconfig['pass_max']."' />&nbsp;<span class='tiny'>"._REQUIRED."</span></td></tr>\n";
    echo "<tr><td align='center' colspan='2'>\n";
    echo "<input type='hidden' name='add_avatar' value='' />\n";
    echo "<input type='hidden' name='file' value='addUserConf' />\n";
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
    echo "<input type='submit' value='"._ADDUSERBUT."' /></td></tr>\n";
    echo "</table>\n";
    echo "</form>\n";
    echo "<form action='".$admin_file.".php?op=Your_Account' method='post'>\n";
    echo "<table border='0'>\n";
    echo "<tr><td align='center' colspan='2'>\n";
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='file' value='$xop' />\n"; }
    echo "<input type='submit' value='"._CANCEL."' /></td></tr>\n";
    echo "</table>\n";
    echo "</form></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>