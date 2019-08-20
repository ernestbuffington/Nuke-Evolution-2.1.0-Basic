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
   die ('You can\'t access this file directly...');
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

global $evoconfig, $_GETVAR, $module_name, $cache, $board_config;
include_once(NUKE_BASE_DIR.'header.php');
define_once('XDATA', true);
include_once(NUKE_INCLUDE_DIR .'functions.php');
include_once(NUKE_MODULES_DIR.'Your_Account/public/custom_functions.php');
include_once(NUKE_MODULES_DIR.'Your_Account/public/functions_welcome_pm.php');

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
if ($evoconfig['doublecheckemail']==1) {
    ya_mailCheck($form_user_email, $form_user_email2);
} else {
    ya_mailCheck($form_user_email, '');
}
ya_passCheck($form_user_password, $form_user_password);
ya_userCheck($form_username);
ya_realuserCheck($form_ya_realname);

$nfield = $_GETVAR->get('nfield', '_POST', 'array');
$user_regdate = date("M d, Y");
if (empty($stop)) {
    if (empty($stop)) {
        $ya_username = ya_fixtext($form_username);
        $ya_user_email = ya_fixtext($form_user_email);
        if ($result = $db->sql_query("SELECT username, user_email FROM "._USERS_TABLE." WHERE `username`='".$ya_username."' OR `user_email`='".$ya_user_email."'")) {
            if ($row = $db->sql_fetchrow($result)) {
                if (isset($row['username']) || isset($row['user_email'])) {
                    if ($row['username'] ==  $ya_username || $row['user_email'] == $ya_user_email) {
                        redirect("modules.php?name=$module_name");
                        exit;
                    }
                }
            }
        }
        $new_password   = EvoCrypt($form_user_password);
        $realname       = ya_fixtext($form_ya_realname);
        $user_website   = $form_user_website;
        if (!preg_match('#http://#', $user_website) AND !empty($user_website)) { 
            $user_website = 'http://'.$user_website;
        }
        $femail = ya_fixtext($form_femail);
        $bio = str_replace("<br />", "\r\n", $form_bio);
        $user_sig = str_replace("<br />", "\r\n", $form_user_sig);
        $user_icq = ya_fixtext($form_user_icq);
        $user_aim = ya_fixtext($form_user_aim);
        $user_yim = ya_fixtext($form_user_yim);
        $user_msnm = ya_fixtext($form_user_msnm);
        $user_occ = ya_fixtext($form_user_occ);
        $user_from = ya_fixtext($form_user_from);
        $user_interests = ya_fixtext($form_user_interests);
        $user_dateformat = ya_fixtext($form_user_dateformat);
        $newsletter = intval($form_user_newsletter);
        $user_viewemail = intval($form_user_viewemail);
        $user_allow_viewonline = intval($form_user_allow_viewonline);
        $user_timezone = intval($form_user_timezone);
        $xdata = array();
        $xd_meta = get_xd_metadata();
        foreach ($xd_meta as $name => $info) {
            $xdata_input = $_GETVAR->get($name, '_POST', 'string');
            if ( (isset($xdata_input) && !empty($xdata_input)) && $info['handle_input'] ) {
                $xdata[$name] = trim($_GETVAR->get($name, '_POST', 'string'));
                $xdata[$name] = str_replace('<br />', "\n", $xdata[$name]);
            }
        }
        list($newest_uid) = $db->sql_ufetchrow("SELECT max(user_id) AS newest_uid FROM "._USERS_TABLE);
        if ($newest_uid < 2) { $new_uid = 2; } else { $new_uid = $newest_uid+1; }
        $lv = time();
        $result = $db->sql_uquery("INSERT INTO "._USERS_TABLE." (user_id, name, username, user_email, user_avatar, user_regdate, user_viewemail, user_password, user_lang, user_lastvisit) VALUES ($new_uid, '$ya_username', '$ya_username', '$ya_user_email', '', '$user_regdate', '0', '$new_password', '$language', '$lv')");
        if ((count($nfield) > 0) AND ($result)) {
            foreach ($nfield as $key => $var) {
                $db->sql_uquery("INSERT INTO "._CNBYA_VALUE_TABLE." (uid, fid, value) VALUES ('$new_uid', '$key','$nfield[$key]')");
            }
        }
        $db->sql_uquery("UPDATE "._USERS_TABLE." SET user_avatar='', user_avatar_type='3', user_lang='$language', user_lastvisit='$lv', umode='nested' WHERE user_id='$new_uid'");
        $db->sql_uquery("UPDATE "._USERS_TABLE." SET username='$ya_username', name='$realname', user_email='$ya_user_email', femail='$femail', user_website='$user_website', user_icq='$user_icq', user_aim='$user_aim', user_yim='$user_yim', user_msnm='$user_msnm', user_from='$user_from', user_occ='$user_occ', user_interests='$user_interests', newsletter='$newsletter', user_viewemail='$user_viewemail', user_allow_viewonline='$user_allow_viewonline', user_timezone='$user_timezone', user_dateformat='$user_dateformat', user_sig='$user_sig', bio='$bio', user_password='$new_password', user_regdate='$user_regdate' WHERE user_id='$new_uid'");
        $sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
                VALUES ('', 'Personal User', '1', '0')";
        if ( !($result = $db->sql_query($sql)) ) {
            DisplayError('Could not insert data into groups table<br />'.$sql);
        }
        $group_id = $db->sql_nextid();
        $sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending) VALUES ('$new_uid', '$group_id', '0')";
        if( !($result = $db->sql_query($sql)) ) {
            DisplayError('Could not insert data into user_group table<br />'.$sql);
        }
        foreach ($xdata as $code_name => $value) {
            set_user_xdata($new_uid, $code_name, $value);
        }
        if(!$result) {
            OpenTable();
            echo _ADDERROR."<br />";
            CloseTable();
        } else {
            init_group($new_uid);
            if ($evoconfig['servermail']) {
                $message = _WELCOMETO." ".EVO_SERVER_SITENAME." (".EVO_SERVER_URL.")!<br /><br />";
                $message .= _YOUUSEDEMAIL."<br />$ya_user_email<br />"._TOREGISTER." ".EVO_SERVER_SITENAME." (".EVO_SERVER_URL.").<br /><br />";
                $message .= _FOLLOWINGMEM."<br />"._UNICKNAME." $ya_username<br />"._UREALNAME." $ya_realname<br />"._UPASSWORD." $user_password <br /><br />";
                $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
                $subject = _REGISTRATIONSUB;
                $to      = $ya_user_email.','.$ya_username;
                $return  = evo_mail($to, $subject, $message);
            }
            title(_USERREGLOGIN);
            OpenTable();
            $result = $db->sql_unumrows("SELECT user_id FROM "._USERS_TABLE." WHERE username='$ya_username' AND user_password='$new_password'");
            if ($result == 1) {
                evo_setusercookie($new_uid);
                echo "<center><strong>".$userinfo['username'].":</strong> "._ACTMSG2."</center>";
                $complete = 1;
            } else {
                echo "<center>"._SOMETHINGWRONG."</center><br />";
            }
            CloseTable();
            if ($evoconfig['sendaddmail'] AND $evoconfig['servermail'] AND !empty($evoconfig['adminmail'])) {
                $subject  = EVO_SERVER_SITENAME." - "._MEMADD;
                $from_ip  = identify::get_ip();
                $message  = "$ya_username "._YA_APLTO." ".EVO_SERVER_SITENAME." "._YA_FROM." $from_ip.<br />";
                $message .= "-----------------------------------------------------------<br />";
                $message .= _YA_NOREPLY . '<br /><br />';
                $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
                $from     = $ya_user_email.', '.$ya_username;
                $return   = evo_mail($evoconfig['adminmail'], $subject, $message, $from);
            }
            send_pm($new_uid,$ya_username);
            if($complete) {
                redirect('index.php', 3);
                exit();
            }
        }
    } else {
        echo $stop;
    }
} else {
    echo $stop;
}
include(NUKE_BASE_DIR . 'footer.php');

?>