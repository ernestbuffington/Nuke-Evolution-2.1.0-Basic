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

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

global $evoconfig, $db;
include_once(NUKE_INCLUDE_DIR.'functions.php');

if ($evoconfig['expiring']!=0) {
    $past = time()-$evoconfig['expiring'];
    $res = $db->sql_query("SELECT user_id FROM "._USERS_TEMP_TABLE." WHERE time < '$past'");
    while (list($uid) = $db->sql_fetchrow($res)) {
      $uid = intval($uid);
      $db->sql_uquery("DELETE FROM "._USERS_TEMP_TABLE." WHERE user_id = $uid");
      $db->sql_uquery("DELETE FROM "._CNBYA_VALUE_TEMP_TABLE." WHERE uid = '$uid'");
    }

    $db->sql_uquery("OPTIMIZE TABLE "._CNBYA_VALUE_TEMP_TABLE);
    $db->sql_uquery("OPTIMIZE TABLE "._USERS_TEMP_TABLE);
    global $cache;
    $cache->delete('numwaituser', 'submissions');
}

$username  = trim(check_html($username, 'nohtml'));
$check_num = trim(check_html($check_num, 'nohtml'));
$result    = $db->sql_query("SELECT * FROM "._USERS_TEMP_TABLE." WHERE username='$username' AND check_num='$check_num'");
if ($db->sql_numrows($result) == 1) {
    $row_act = $db->sql_fetchrow($result);
    $ya_username = $row_act['username'];
    $ya_realname = $row_act['realname'];
    $ya_useremail = $row_act['user_email'];
    $ya_time = $row_act['time'];
    $lv = time();
    include_once(NUKE_BASE_DIR.'header.php');
    title(_PERSONALINFO);
    OpenTable();
    echo "<table class='forumline' cellpadding=\"3\" cellspacing=\"3\" border=\"0\" width='100%'>\n";
    echo "<tr><td align=\"center\" bgcolor='$bgcolor2' colspan=\"2\"><strong>"._FORACTIVATION."</strong>:</td></tr>\n";
    echo "<form name=\"Register\" action=\"modules.php?name=$module_name\" method=\"post\">\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._USRNICKNAME.":</td><td bgcolor='$bgcolor1'>$ya_username</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":<br />"._REQUIRED."</td><td bgcolor='$bgcolor1'>";
    echo "<input type=\"text\" name=\"realname\" value=\"$ya_realname\" size=\"50\" maxlength=\"60\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._UREALEMAIL.":</td>";
    echo "<td bgcolor='$bgcolor1'>$ya_useremail</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._UFAKEMAIL.":<br />"._OPTIONAL."</td>";
    echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"femail\" value=\"\" size=\"50\" maxlength=\"255\" /><br />"._EMAILPUBLIC."</td></tr>\n";
$xd_meta = get_xd_metadata();
while ( list($code_name, $info) = each($xd_meta) )
{
        if ($info['display_register'] == XD_DISPLAY_NORMAL && $info['signup'])
        {
            $value = isset($xdata[$code_name]) ? str_replace('"', '&quot;', $xdata[$code_name]) : '';
            $length = ( $info['field_length'] > 0) ? ( $info['field_length'] ) : '';
            switch ($info['field_type'])
            {
                case 'text':
                    $value = isset($xdata[$code_name]) ? str_replace('"', '&quot;', $xdata[$code_name]) : '';
                    $length = ( $info['field_length'] > 0) ? ( $info['field_length'] ) : '';
                    echo '<tr><td bgcolor="'.$bgcolor2.'"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td>
                            <td bgcolor="'.$bgcolor1.'"><input type="text" class="post"style="width: 200px" name="'.$code_name.'" size="35" maxlength="'.$length .'" value="'.$value.'" /></td></tr>';
                    break;
                case 'textarea':
                    echo '<tr><td bgcolor="'.$bgcolor2.'"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td>
                            <td bgcolor="'.$bgcolor1.'"><textarea name="'.$code_name.'"style="width: 300px"  rows="6" cols="30" class="post">'.$value.'</textarea></td></tr>';
                    break;
                case 'radio':
                    echo '<tr><td bgcolor="'.$bgcolor2.'"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td><td bgcolor="'.$bgcolor1.'">';
                    while ( list( , $option) = each($info['values_array']) )
                    {
                        $select = ($xdata[$code_name] == $option) ? 'selected="selected"' : '';
                        echo '<input type="radio" name="'.$code_name.'" value="'.$option.'" '.$select.' />&nbsp;<span class="gen">'.$option.'</span><br />';
                    }
                    echo '</td></tr>';
                    break;
                case 'select':
                    echo '<tr><td bgcolor="'.$bgcolor2.'"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td><td bgcolor="'.$bgcolor1.'">';
                    echo '<select name="'.$code_name.'">';
                    while ( list( , $option) = each($info['values_array']) )
                    {
                        $select = ($xdata[$code_name] == $option) ? 'selected="selected"' : '';
                        echo '<option value="'.$option.'" '.$select.'>'.$option.'</option>';
                    }
                    echo '</select></td></tr>';
                    break;
            }
        }
}
$db->sql_freeresult($result);
    echo "<tr><td bgcolor='$bgcolor2'>"._YOURHOMEPAGE.":<br />"._OPTIONAL."</td>";
    echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_website\" value=\"\" size=\"50\" maxlength=\"255\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YICQ.":<br />"._OPTIONAL."</td>";
    echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_icq\" value=\"\" size=\"30\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YAIM.":<br />"._OPTIONAL."</td>";
    echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_aim\" value=\"\" size=\"30\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YYIM.":<br />"._OPTIONAL."</td>";
    echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_yim\" value=\"\" size=\"30\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YMSNM.":<br />"._OPTIONAL."</td>";
    echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_msnm\" value=\"\" size=\"30\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YLOCATION.":<br />"._OPTIONAL."</td>";
    echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_from\" value=\"\" size=\"30\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YOCCUPATION.":<br />"._OPTIONAL."</td>";
    echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_occ\" value=\"\" size=\"30\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YINTERESTS.":<br />"._OPTIONAL."</td>";
    echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_interests\" value=\"\" size=\"30\" maxlength=\"100\" /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._RECEIVENEWSLETTER.":</td><td bgcolor='$bgcolor1'><select name='newsletter'>";
    echo "<option value=\"1\">"._YES."</option><option value=\"0\" selected='selected'>"._NO."</option></select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._ALWAYSSHOWEMAIL.":</td><td bgcolor='$bgcolor1'><select name='user_viewemail'>";
    echo "<option value=\"1\">"._YES."</option><option value=\"0\" selected='selected'>"._NO."</option></select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._HIDEONLINE.":</td><td bgcolor='$bgcolor1'><select name='user_allow_viewonline'>";
    echo "<option value=\"0\">"._YES."</option><option value=\"1\" selected='selected'>"._NO."</option></select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._FORUMSTIME."</td><td bgcolor='$bgcolor1'><select name='user_timezone'>";
    $utz = date("Z");
    $utz = round($utz/3600);
    for ($i=-12; $i<13; $i++) {
        if ($i == 0) {
            $dummy = "GMT";
        } else {
            if (!preg_match("#-#", $i)) { $i = "+$i"; }
            $dummy = "GMT $i "._HOURS."";
        }
        if ($utz == $i) {
            echo "<option name=\"user_timezone\" value=\"$i\" selected='selected'>$dummy</option>";
        } else {
            echo "<option name=\"user_timezone\" value=\"$i\">$dummy</option>";
        }
    }
    echo "</select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._FORUMSDATE.":<br />"._FORUMSDATEMSG."</td><td bgcolor='$bgcolor1'>";
    echo "<input type=\"text\" name=\"user_dateformat\" value=\"D M d, Y g:i a\" size='15' maxlength='14' /></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._SIGNATURE.":<br />"._OPTIONAL."<br />"._NOHTML."</td>";
    echo "<td bgcolor='$bgcolor1'><textarea wrap=\"virtual\" cols=\"50\" rows=\"5\" name=\"user_sig\">".$userinfo['user_sig']."</textarea><br />"._255CHARMAX."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._EXTRAINFO.":<br />"._OPTIONAL."<br />"._NOHTML."</td>";
    echo "<td bgcolor='$bgcolor1'><textarea wrap=\"virtual\" cols=\"50\" rows=\"5\" name=\"bio\">$userinfo[bio]</textarea><br />"._CANKNOWABOUT."</td></tr>\n";
    echo "<input type=\"hidden\" name=\"ya_username\" value=\"$ya_username\" />";
    echo "<input type=\"hidden\" name=\"check_num\" value=\"$check_num\" />\n";
    echo "<input type=\"hidden\" name=\"ya_time\" value=\"$ya_time\" />\n";
    echo "<input type=\"hidden\" name=\"op\" value=\"saveactivate\" />";
    echo "<tr><td bgcolor='$bgcolor1' colspan='2' align='center'><input type=\"submit\" value=\""._SAVECHANGES."\" /></td></tr>\n";
    echo "</form>\n";
    echo "</table>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    title(""._ACTIVATIONERROR."");
    OpenTable();
    echo "<center>"._ACTERROR."</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

?>