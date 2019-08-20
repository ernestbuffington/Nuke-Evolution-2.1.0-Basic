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
 Nuke-Evo Author        :   ReOrGaNiSaTiOn

 Copyright (c) 2010 by The Nuke-Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS 'NOT' ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE 'NOT' ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if (!defined('NUKE_EVO')) {
   die('You can\'t access this file directly...');
}

$errorcounter = 0;
if ( $adminsetup == 1 ) {
    // Let's check our variables
    
    if ( !$InstallConfig['admin_name'] ) {
        $admin_name_error = '<div style="color : red;">'.$lang_install['Admin_Name_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( !$InstallConfig['admin_homepage'] || $InstallConfig['admin_homepage'] == 'http://' ) {
        $admin_homepage_error = '<div style="color : red;">'.$lang_install['Admin_Homepage_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( !$InstallConfig['admin_email'] ) {
        $admin_email = '<div style="color : red;">'.$lang_install['Admin_Email_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( !$InstallConfig['admin_password'] ) {
        $admin_password_error = '<div style="color : red;">'.$lang_install['Admin_Password_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( !$InstallConfig['admin_password2'] ) {
        $admin_password2_error = '<div style="color : red;">'.$lang_install['Admin_Password2_no_entry'].'</div>';
        $errorcounter++;
    }
    if ( $InstallConfig['admin_password'] != $InstallConfig['admin_password2'] ) {
        $admin_password2_error .= '<div style="color : red;">'.$lang_install['Admin_Password_not_match'].'</div>';
        $errorcounter++;
    } else {
        if ( ($InstallConfig['update'] == 2) && !empty($InstallConfig['admin_md5_password'])) {
            $is_ok = 0;
            switch ($InstallConfig['admin_md5_password']) {
                case md5($InstallConfig['admin_password']): $is_ok = 1; break;
                case md5(md5($InstallConfig['admin_password'])): $is_ok = 1; break;
                case md5(md5(md5($InstallConfig['admin_password']))): $is_ok = 1; break;
                case md5(md5(md5(md5($InstallConfig['admin_password'])))): $is_ok = 1; break;
                case md5(md5(md5(md5(md5($InstallConfig['admin_password']))))): $is_ok = 1; break;
                case md5(md5(md5(md5(md5(md5($InstallConfig['admin_password'])))))): $is_ok = 1; break;
            }
            if ( $is_ok == 0 ) {
                $admin_password2_error .= '<div style="color : red;">'.$lang_install['Admin_Password_not_match_existing'].'</div>';
                $errorcounter++;
            }
        }
    }
    if ( !$InstallConfig['admin_lang'] ) {
        $admin_lang_error = '<div style="color : red;">'.$lang_install['Admin_Lang_no_entry'].'</div>';
        $errorcounter++;
    }
    if ($errorcounter == 0) {
        $error = '<div style="color : green;text-align : center;">'.$lang_install['Admin_Conf_ok'].'<br />'.$error.'</div>';
        $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 2;
        evo_setcookie($InstallConfig);
    } else {
        $error .= '<div style="color : red;text-align : center;">'.$lang_install['Admin_Conf_wrong'].'</div><br />';
        $InstallConfig['adminsetup'] = 0;
        $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
        evo_setcookie($InstallConfig);
    }
}

if ($InstallConfig['next_step'] < $InstallConfig['max_step'] && $InstallConfig['dbsetup'] == 1 && $InstallConfig['adminsetup'] == 1) {
    $goback = 1;
    $gonext = 1;
} else {
    $goback = 1;
    $gonext = 0;
}    
install_header($goback, $gonext);
if ( $InstallConfig['update'] == 2 && $adminsetup != 1) {
    $db_admin = $db->sql_ufetchrow('SELECT * FROM `'.$InstallConfig['dbprefix'].'_authors` WHERE `name` = "God"', SQL_ASSOC);
    $InstallConfig['admin_name'] = $db_admin['aid'];
    $InstallConfig['admin_homepage'] = $db_admin['url'];
    $InstallConfig['admin_email'] = $db_admin['email'];
    $InstallConfig['admin_password'] = '';
    $InstallConfig['admin_password2'] = '';
    $admin_pw = '<input type="hidden" name="md5_password" value="'.$db_admin['pwd'].'" />';
    $InstallConfig['admin_lang'] = $db_admin['admlanguage'];
    $lang_temp = '<div style="color : red;text-align : center;">'.$lang_install['Base_From_Update'].'</div>';
}

OpenTable();
OpenTable2();
echo "<div class='topictitle'><center>".$lang_install['Admin_Setup'].($lang_temp != '' ? '<br />'.$lang_temp : '')."</center></div>";
CloseTable2();
echo '<br />';
if ( strlen($error) > 1 ) {
    OpenTable2();
    echo $error;
    CloseTable2();
}
echo '<fieldset><legend>'.$lang_install['Admin_Configuration_Details'].'</legend>';
echo '<form method="post" name="form_basesetup" action="' . $_SERVER['PHP_SELF'] . '">';
echo '<input type="hidden" name="adminsetup" value="1" />';
if ( $InstallConfig['update'] == 2 ) {
    echo $admin_pw;
}
echo '<input type="hidden" name="step" value="'.$InstallConfig['step'].'" />';
echo '<table width="100%">';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Admin_Help_Name']).'&nbsp;'.$lang_install['Admin_Name'];
if ( $admin_name_error ) { echo '<br />'.$admin_name_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="admin_name" size="25" value="'.($InstallConfig['admin_name'] ? $InstallConfig['admin_name'] : $var_install['stories_aid']).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Admin_Help_Homepage']).'&nbsp;'.$lang_install['Admin_Homepage'];
if ( $admin_homepage_error ) { echo '<br />'.$admin_homepage_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="admin_homepage" size="50" maxlength="200" value="'.($InstallConfig['admin_homepage'] ? $InstallConfig['admin_homepage'] : $InstallConfig['base_url']).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Admin_Help_Email']).'&nbsp;'.$lang_install['Base_Board_Email'];
if ( $admin_email_error ) { echo '<br />'.$admin_email_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="text" name="admin_email" size="50" maxlength="200" value="'.($InstallConfig['admin_email'] ? $InstallConfig['admin_email'] : $var_install['bbconfig_board_email']).'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Admin_Help_Password']).'&nbsp;'.$lang_install['Admin_Password'];
if ( $admin_password_error ) { echo '<br />'.$admin_password_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="password" name="admin_password" size="25" maxlength="25" value="'.($InstallConfig['admin_password'] ? $InstallConfig['admin_password'] : '').'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Admin_Help_Password2']).'&nbsp;'.$lang_install['Admin_Password2'];
if ( $admin_password2_error ) { echo '<br />'.$admin_password2_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="40%"><input type="password" name="admin_password2" size="25" maxlength="25" value="'.($InstallConfig['admin_password2'] ? $InstallConfig['admin_password2'] : '').'" /></td></tr>';
echo '<tr><td class="row1" width="60%">'.evo_help_img($lang_install['Admin_Help_Lang']).'&nbsp;'.$lang_install['Admin_Lang'];
if ( $admin_lang_error ) { echo '<br />'.$admin_lang_error.'</td>'; } else { echo '</td>'; }
echo '<td class="row1" width="60%"><select name="admin_lang">';
$languageslist = lang_list();
for ($i=0, $maxi=count($languageslist); $i < $maxi; $i++) {
    if(!empty($languageslist[$i])) {
        echo '<option value="'.$languageslist[$i].'"';
        if($languageslist[$i]==($InstallConfig['admin_lang'] ? $InstallConfig['admin_lang'] : $InstallConfig['language'])) {
            echo ' selected="selected"';
        }
        echo '>'.$languageslist[$i].'</option>';
    }
}
echo '</select></td></tr>';
if ( $InstallConfig['adminsetup'] != 1 ) {
    echo '<tr><td colspan="2"><center><input type="submit" name="button_adminsetup" value="'.$lang_install['Submit'].'" /></center></td></tr>';
}
echo '</table></form></fieldset>';
echo '<br />';

if ($InstallConfig['adminsetup'] == 1) {
    $previous = $next = '';
    if ($InstallConfig['old_step'] > $InstallConfig['min_step'] ) {
        $previous = '<a href="install.php?step='.$InstallConfig['old_step'].'"><img src="install/images/left.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }
    if ($InstallConfig['next_step'] < $InstallConfig['max_step'] && $InstallConfig['dbsetup'] == 1) {
        $next = '<a href="install.php?step='.$InstallConfig['next_step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
    } else {
        $next = '<a href="install.php?step='.$InstallConfig['step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }    
    echo "<center>$previous&nbsp;&nbsp;$next</center>";
}
echo "<br /><br />";
CloseTable();

?>