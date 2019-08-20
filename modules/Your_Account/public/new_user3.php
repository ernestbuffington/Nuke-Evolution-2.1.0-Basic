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

global $db, $evoconfig, $_GETVAR, $lang, $currentlang;

unset($_SESSION['YA1']);
unset($_SESSION['YA2']);

$_SESSION['YA1'] = true;
include_once(NUKE_BASE_DIR.'header.php');
if (!isset($lang['tz'])) {
    require(NUKE_FORUMS_DIR . 'language/lang_'.$currentlang.'/lang_main.php');
}
$var_ary = array(
    'form_user_email'    => 'ya_user_email',
    'form_user_email2'   => 'ya_user_email2',
    'form_username'      => 'ya_username',
    'form_gfx_check'     => $module_name.'gfx_check',
    'form_user_password' => 'user_password',
    'form_user_password2'=> 'user_password2',
    'form_ya_realname'   => 'ya_realname',
    'form_femail'        => 'ya_femail',
    'form_website'       => 'ya_website',
    'form_icq'           => 'ya_icq',
    'form_aim'           => 'ya_aim',
    'form_yim'           => 'ya_yim',
    'form_msnm'          => 'ya_msnm',
    'form_from'          => 'ya_from',
    'form_user_occ'      => 'ya_user_occ',
    'form_user_interests'=> 'ya_user_interests',
    'form_newsletter'    => 'ya_newsletter',
    'form_user_viewemail'=> 'ya_user_viewemail',
    'form_user_allow_viewonline' => 'ya_user_allow_viewonline',
    'form_user_timezone' => 'ya_user_timezone',
    'form_user_dateformat' => 'ya_user_dateformat',
    'form_user_sig'      => 'ya_user_sig',
    'form_bio'           => 'ya_bio',
    'stop'               => 'stop',
);
while(list($save_field, $form_field) = each($var_ary)) {
    $$save_field = $_GETVAR->get($form_field, '_POST', 'string');
}


define_once('XDATA', true);
include_once(NUKE_INCLUDE_DIR.'functions.php');
include_once(NUKE_MODULES_DIR.'Your_Account/public/custom_functions.php');
include_once(NUKE_BASE_DIR.'header.php');
title(_USERREGLOGIN);
OpenTable();
echo "<form action='modules.php?name=$module_name' method='post' name='newuser'>\n";
echo "<table align='center' cellpadding='3' cellspacing='3' border='0'>\n";
echo "<tr><td align='center' bgcolor='$bgcolor1' colspan='2'><div class=\"textbold\">"._REGNEWUSER."</div></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._NICKNAME.":</div></td><td bgcolor='$bgcolor1'><input type='text' name='ya_username' value='".$form_username."' size='15' maxlength='".$evoconfig['nick_max']."' />&nbsp;<span class='tiny'>"._REQUIRED."</span><br /><span class='tiny'>("._YA_NICKLENGTH.")</span></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._UREALNAME.":</div></td><td bgcolor='$bgcolor1'><input type='text' name='ya_realname' value='".$form_ya_realname."' size='40' maxlength='60' />&nbsp;<span class='tiny'>"._REQUIRED."</span></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._EMAIL.":</div></td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_email' value='".$form_user_email."' size='40' maxlength='255' />&nbsp;<span class='tiny'>"._REQUIRED."</span>\n";

// menelaos: added configurable doublecheck email routine
if ($evoconfig['doublecheckemail']==1) {
    echo "</td></tr><tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._RETYPEEMAIL.":</div></td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_email2' value='".$form_user_email2."' size='40' maxlength='255' /></td></tr>\n";
} else {
    echo "<input type='hidden' name='ya_user_email2' value='".$form_user_email."' /></td></tr>\n\n";
}

$result = $db->sql_query("SELECT * FROM "._CNBYA_FIELD_TABLE." WHERE (need = '2') OR (need = '3') ORDER BY pos");
while ($sqlvalue = $db->sql_fetchrow($result)) {
  $t = $sqlvalue['fid'];
  $value2 = explode("::", $sqlvalue['value']);
  if (substr($sqlvalue[name],0,1)=='_') {
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
    if (($sqlvalue['need']) > 1) echo"&nbsp;<span class='tiny'>"._REQUIRED."</span>";
      echo "</td></tr>\n";
}
$db->sql_freeresult($result);
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._PASSWORD.":</div></td><td bgcolor='$bgcolor1'><input type='password' name='user_password' size='10' value='".$form_user_password."' maxlength='".$evoconfig['pass_max']."' onkeyup='chkpwd(newuser.user_password.value)' onblur='chkpwd(newuser.user_password.value)' onmouseout='chkpwd(newuser.user_password.value)' />";
echo "<br /><span class='tiny'>("._BLANKFORAUTO.")</span><br /><span class='tiny'>("._YA_PASSLENGTH.")</span>";
global $currentlang;
echo "<table width='300' cellpadding='2' cellspacing='0' border='1' bgcolor='#EBEBEB' style='border-collapse: collapse;'><tr>
      <td height='18' id='td1' width='100' align='center'><div id='div1'></div></td>
      <td height='18' id='td2' width='100' align='center'><div id='div2'></div></td>
      <td height='18' id='td3' width='100' align='center'><div id='div3'>"._PSM_NOTRATED."</div></td>
      <td height='18' id='td4' width='100' align='center'><div id='div4'></div></td>
      <td height='18' id='td5' width='100' align='center'><div id='div5'></div></td>
      </tr></table><div id='divTEMP'></div>";
echo _PSM_CLICK." <a href=\"javascript:strengthhelp('".$currentlang."')\">"._PSM_HERE."</a> "._PSM_HELP."<br />";
echo "</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._RETYPEPASSWORD.":</div></td><td bgcolor='$bgcolor1'><input type='password' name='user_password2' value='".$form_user_password2."' size='10' maxlength='".$evoconfig['pass_max']."' /><br /><span class='tiny'>("._BLANKFORAUTO.")</span><br /><span class='tiny'>("._YA_PASSLENGTH.")</span></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._UFAKEMAIL.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_femail' value='".$form_femail."'  size='40' maxlength='255' /><br />"._EMAILPUBLIC."</td></tr>\n";
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
                            <td bgcolor="'.$bgcolor1.'"><input type="text" class="post"style="width: 200px" name="'.$code_name.'"  size="35" maxlength="'.$length .'" value="'.$value.'" /></td></tr>';
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
        elseif ($info['display_register'] == XD_DISPLAY_ROOT)
        {
            switch ($code_name) {
                case "icq":
                    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YICQ.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_icq' size='30' maxlength='100' /></td></tr>\n";
                break;
                case "aim":
                    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YAIM.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_aim' size='30' maxlength='100' /></td></tr>\n";
                break;
                case "msn":
                    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YMSNM.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_msnm' size='30' maxlength='100' /></td></tr>\n";
                break;
                case "yim":
                    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YYIM.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_yim' size='30' maxlength='100' /></td></tr>\n";
                break;
                case "website":
                    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YOURHOMEPAGE.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_website' size='40' maxlength='255' /></td></tr>\n";
                break;
                case "location":
                    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YLOCATION.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_from' size='30' maxlength='100' /></td></tr>\n";
                break;
                case "occupation":
                    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YOCCUPATION.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_occ' size='30' maxlength='100' /></td></tr>\n";
                break;
                case "interests":
                    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YINTERESTS.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_interests' size='30' maxlength='100' /></td></tr>\n";
                break;
                case "signature":
                    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._SIGNATURE.":</div>"._OPTIONAL."<br />"._NOHTML."</td><td bgcolor='$bgcolor1'><textarea cols='50' rows='5' name='ya_user_sig'></textarea><br />"._255CHARMAX."</td></tr>\n";
                break;
            }
        }
}
$db->sql_freeresult($result);
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._RECEIVENEWSLETTER.":</div></td><td bgcolor='$bgcolor1'><select name='ya_newsletter'><option value='1' selected='selected'>"._YES."</option><option value='0'>"._NO."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._ALWAYSSHOWEMAIL.":</div></td><td bgcolor='$bgcolor1'><select name='ya_user_viewemail'><option value='1' selected='selected'>"._YES."</option><option value='0'>"._NO."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._HIDEONLINE.":</div></td><td bgcolor='$bgcolor1'><select name='ya_user_allow_viewonline'><option value='0'>"._YES."</option><option value='1' selected='selected'>"._NO."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._FORUMSTIME.":</div></td><td bgcolor='$bgcolor1'>";
echo tz_select($evoconfig['board_timezone'], 'timezone');
echo "</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._FORUMSDATE.":</div>"._FORUMSDATEMSG."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_dateformat' value='".$evoconfig['default_dateformat']."' size='15' maxlength='14' /></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._EXTRAINFO.":</div>"._OPTIONAL."<br />"._NOHTML."</td><td bgcolor='$bgcolor1'><textarea cols='50' rows='5' name='ya_bio'></textarea><br />"._CANKNOWABOUT."</td></tr>\n";

$gfxchk = array(3,4,6,7);
$gfx = security_code($gfxchk, 'large', 0, $module_name);
if(!empty($gfx)) {
    echo $gfx;
}

echo "<tr><td align='right' bgcolor='$bgcolor1' colspan='2'><input type='submit' value='"._YA_CONTINUE."' />\n";
echo "<input type='hidden' name='op' value='new_confirm' /></td></tr>\n";
echo "</table></form>\n";
echo "<br />\n";
echo _COOKIEWARNING."<br />\n";
echo _ASREGUSER."<br />\n";
echo "<ul>\n";
echo "<li>"._ASREG1."</li>\n";
echo "<li>"._ASREG2."</li>\n";
echo "<li>"._ASREG3."</li>\n";
echo "<li>"._ASREG4."</li>\n";
echo "<li>"._ASREG5."</li>\n";
$thmcount = count(get_themes('active'));
if ($thmcount > 1) { echo "<li>"._ASREG6."</li>\n"; }
$sql = "SELECT custom_title FROM "._MODULES_TABLE." WHERE active='1' AND view='3' AND inmenu='1'";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $custom_title = $row['custom_title'];
    if (!empty($custom_title)) { echo "<li>"._ACCESSTO." $custom_title</li>\n"; }
}
$db->sql_freeresult($result);
$sql = "SELECT title FROM "._BLOCKS_TABLE." WHERE active='1' AND view='3'";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $b_title = $row['title'];
    if (!empty($b_title)) { echo "<li>"._ACCESSTO." $b_title</li>\n"; }
}
$db->sql_freeresult($result);
if (is_active('Journal')) { echo "<li>"._CREATEJOURNAL."</li>\n"; }
if ($evoconfig['my_headlines'] == 1) { echo "<li>"._READHEADLINES."</li>\n"; }
echo "<li>"._ASREG7."</li>\n";
echo "</ul>\n";
echo _REGISTERNOW."<br />\n";
echo _WEDONTGIVE."<br /><br />\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>