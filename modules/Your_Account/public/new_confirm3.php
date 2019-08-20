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

global $db, $_GETVAR, $module_name, $cache, $evoconfig, $sitekey, $stop;
include_once(NUKE_BASE_DIR.'header.php');

define_once('XDATA', true);
include_once(NUKE_INCLUDE_DIR.'functions.php');
include_once(NUKE_MODULES_DIR.'Your_Account/public/custom_functions.php');
$stop = '';
$var_ary = array(
    'form_user_email'    => 'ya_user_email',
    'form_user_email2'   => 'ya_user_email2',
    'form_username'      => 'ya_username',
    'form_gfx_check'     => $module_name.'gfx_check',
    'form_user_password' => 'user_password',
    'form_user_password2'=> 'user_password2',
    'form_ya_realname'   => 'ya_realname',
    'form_femail'        => 'ya_femail',
    'form_user_website'  => 'ya_user_website',
    'form_user_icq'      => 'ya_user_icq',
    'form_user_aim'      => 'ya_user_aim',
    'form_user_yim'      => 'ya_user_yim',
    'form_user_msnm'     => 'ya_user_msnm',
    'form_user_from'     => 'ya_user_from',
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

ya_securityCheck($form_gfx_check);
$user_viewemail = '0';
$xdata = array();
$xd_meta = get_xd_metadata();
$error = false;
$error_msg = '';
while ( list($code_name, $meta) = each($xd_meta) )
{
    if ( ($meta['display_register'] == XD_DISPLAY_NORMAL && $meta['signup']) || $meta['display_register'] == XD_DISPLAY_ROOT ) {
        $xdata_input = $_GETVAR->get($code_name, '_POST', 'string');
        $xdata[$code_name] = (isset($xdata_input) && !empty($xdata_input) && $meta['handle_input']) ? trim($xdata_input) : '';
        if ( ($meta['field_length'] > 0) && (strlen($xdata[$code_name]) > $meta['field_length']) ) {
            $error = TRUE;
            $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf(_YA_XData_too_long, $meta['field_name']);
        }
        if ( ( count($meta['values_array']) > 0 ) && ( ! in_array($xdata[$code_name], $meta['values_array']) ) )
        {
            $error = TRUE;
            $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf(_YA_XData_invalid, $meta['field_name']);
        }
        if ( ( strlen($meta['field_regexp']) > 0 ) && ( ! preg_match($meta['field_regexp'], $xdata[$code_name]) ) && (strlen($xdata[$code_name]) > 0) )
        {
            $error = TRUE;
            $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf(_YA_XData_invalid, $meta['field_name']);
        }
        if ( $meta['manditory'] && empty($xdata[$code_name]) )
        {
            global $lang;
            $error = TRUE;
            $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf(_YA_XData_invalid, $meta['field_name']);
        }
        if ($meta['handle_input']) {
            echo "<input type='hidden' name='".$code_name."' value='".$xdata[$code_name]."' />\n";
        }
    }
}

if ($error) {
    OpenTable();
    echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
    echo "<span class='content'>".$error_msg."<br /><br />"._GOBACK."</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

if ($evoconfig['doublecheckemail']==1) {
    ya_mailCheck($form_user_email, $form_user_email2);
} else {
    ya_mailCheck($form_user_email, '');
}
if (empty($form_user_password) AND empty($form_user_password2)) {
    $form_user_password  = YA_MakePass();
    $form_user_password2 = $form_user_password;
}
ya_passCheck($form_user_password, $form_user_password2);
ya_userCheck($form_username);
ya_realuserCheck($form_ya_realname);

if (empty($stop)) {
    $ya_username   = $form_username;
    $ya_user_email = strtolower($form_user_email);
    $user_password = $form_user_password;
    $ya_realname   = $form_ya_realname;
    $nfield = array();
    $result = $db->sql_query("SELECT * FROM "._CNBYA_FIELD_TABLE." WHERE need = '3' ORDER BY pos");
    while ($sqlvalue = $db->sql_fetchrow($result)) {
      $t = trim($sqlvalue['fid']);
      if (empty($nfield[$t])) {
        OpenTable();
        if (substr($sqlvalue['name'],0,1)=='_') {
            eval( "\$name_exit = ".$sqlvalue['name'].";");
        } else {
            $name_exit = $sqlvalue['name'];
        }
        echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
        echo "<span class='content'>"._YA_FILEDNEED1."&nbsp;".$name_exit."&nbsp;"._YA_FILEDNEED2."<br /><br />"._GOBACK."</span></center>";
        CloseTable();
        $db->sql_freeresult($result);
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
      };
    }
    $db->sql_freeresult($result);
    title(_USERREGLOGIN);
    OpenTable();
    echo "<center><strong>"._USERFINALSTEP."</strong><br /><br />".$ya_username.",&nbsp;"._USERCHECKDATA."</center><br /><br />";
    echo "<table align='center' border='0'>";
    echo "<tr><td><strong>"._USERNAME.":&nbsp;</strong>".$ya_username."<br /></td></tr>";
    echo "<tr><td><strong>"._EMAIL.":&nbsp;</strong>".$ya_user_email."</td></tr>";
    echo "</table>";
    echo "<center><form action='modules.php?name=$module_name' method='post'>";
    if (count($nfield) > 0) {
        foreach ($nfield as $key => $var) {
            echo "<input type='hidden' name='nfield[$key]' value='$nfield[$key]' />";
        }
    }
    if (isset($gfx_check)) {
        echo "<input type='hidden' name='".$module_name."gfx_check' value='".$form_gfx_check."' />";
    }
    echo "<input type='hidden' name='ya_username' value='".$form_username."' />";
    echo "<input type='hidden' name='ya_user_email' value='".$form_user_email."' />";
    echo "<input type='hidden' name='ya_user_email2' value='".$form_user_email2."' />";
    echo "<input type='hidden' name='user_password' value='".$form_user_password."' />";
    echo "<input type='hidden' name='ya_realname' value='".$form_ya_realname."' />\n";
    echo "<input type='hidden' name='ya_femail' value='".$form_femail."' />\n";
    echo "<input type='hidden' name='ya_user_website' value='".$form_user_website."' />\n";
    echo "<input type='hidden' name='ya_user_icq' value='".$form_user_icq."' />\n";
    echo "<input type='hidden' name='ya_user_aim' value='".$form_user_aim."' />\n";
    echo "<input type='hidden' name='ya_user_yim' value='".$form_user_yim."' />\n";
    echo "<input type='hidden' name='ya_user_msnm' value='".$form_user_msnm."' />\n";
    echo "<input type='hidden' name='ya_user_from' value='".$form_user_from."' />\n";
    echo "<input type='hidden' name='ya_user_occ' value='".$form_user_occ."' />\n";
    echo "<input type='hidden' name='ya_user_interests' value='".$form_user_interests."' />\n";
    echo "<input type='hidden' name='ya_newsletter' value='".$form_newsletter."' />\n";
    echo "<input type='hidden' name='ya_user_viewemail' value='".$form_user_viewemail."' />\n";
    echo "<input type='hidden' name='ya_user_allow_viewonline' value='".$form_user_allow_viewonline."' />\n";
    echo "<input type='hidden' name='ya_user_timezone' value='".$form_user_timezone."' />\n";
    echo "<input type='hidden' name='ya_user_dateformat' value='".$form_user_dateformat."' />\n";
    echo "<input type='hidden' name='ya_user_sig' value='".$form_user_sig."' />\n";
    echo "<input type='hidden' name='ya_bio' value='".$form_bio."' />\n";
    $xdata = array();
    $xd_meta = get_xd_metadata();
    foreach ($xd_meta as $name => $info) {
        $xd_input = $_GETVAR->get($name, '_POST', 'string');
        if ( isset($xd_input) && $info['handle_input'] ) {
            $xdata[$name] = trim($xd_input);
            echo "<input type='hidden' name='".$name."' value='".$xdata[$name]."' />\n";
        }
    }
    echo "<input type='hidden' name='op' value='new_finish' /><br /><br />";
    echo "<input type='submit' value='"._FINISH."' />&nbsp;&nbsp;<a href='javascript:history.back(-1);'>"._GOBACK."</a></form></center>";
    CloseTable();
} else {
    OpenTable();
    echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
    echo "<span class='content'>$stop<br /><br /><a href='javascript:history.back(-1);'>"._GOBACK."</a></span></center>";
    CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');

?>