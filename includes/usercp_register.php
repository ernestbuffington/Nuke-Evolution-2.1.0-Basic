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

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');

global $_GETVAR, $userdata, $evoconfig;

// ---------------------------------------
// Load agreement template since user has not yet
// agreed to registration conditions/coppa
//
function show_coppa() {
    global $userdata, $template, $lang, $phpbb_root_path;
    $template->set_filenames(array(
        'body' => 'agreement.tpl')
    );
    $template->assign_vars(array(
        'REGISTRATION'      => $lang['Registration'],
        'AGREEMENT'         => $lang['Reg_agreement'],
        'AGREE_OVER_13'     => $lang['Agree_over_13'],
        'AGREE_UNDER_13'    => $lang['Agree_under_13'],
        'DO_NOT_AGREE'      => $lang['Agree_not'],
        'U_AGREE_OVER13'    => append_sid('profile.php?mode=register&amp;agreed=true'),
        'U_AGREE_UNDER13'   => append_sid('profile.php?mode=register&amp;agreed=true&amp;coppa=true'))
    );
    $template->pparse('body');
}
//
// ---------------------------------------
//
// Load variables
if ( !defined('IN_PROFILE') ) {
    $mode           = $_GETVAR->get('mode', '_REQUEST');
}
$check_num      = $_GETVAR->get('check_num', '_REQUEST');
$coppa          = $_GETVAR->get('coppy', '_REQUEST', 'int', 0);
$submit         = $_GETVAR->get('submit', '_POST', 'string', '');
$avatargallery  = $_GETVAR->get('avatargallery', '_POST', 'string', '');
$submitavatar   = $_GETVAR->get('submitavatar', '_POST', 'string', '');
$cancelavatar   = $_GETVAR->get('cancelavatar', '_POST', 'string', '');
$user_id        = $_GETVAR->get('user_id', '_REQUEST', 'int', 0);
$current_email  = $_GETVAR->get('current_email', '_POST', 'email');
$username       = $_GETVAR->get('username', '_POST', 'string', '');

$error = FALSE;
$error_msg = '';

if ( defined('IN_ADMIN_USERS') ) {
    global $admin_userid;
    $mode = 'editprofile';
    $userwork = get_user_field('*', $admin_userid);
    $userwork['session_id'] = '';
    $user_id  = $admin_userid;
    include_once(NUKE_INCLUDE_DIR . 'functions.php');
} else {
    $userwork = &$userdata;
}

if ( $mode == 'register' && isset($check_num) ) {
    global $db;
    $user_temp  = $db->sql_ufetchrow("SELECT * FROM "._USERS_TEMP_TABLE." WHERE check_num='".$check_num."'");
    if($user_temp != NULL) {
        $template->assign_block_vars('switch_silent_password', array());
        $db->sql_uquery("DELETE FROM "._USERS_TEMP_TABLE." WHERE check_num='".$check_num."'");
    } else {
        $message = sprintf($lang['Error_Check_Num'], 'modules.php?name=Your_Account&amp;op=new_user');
        message_die(GENERAL_ERROR, $message);
    }
} else {
    $template->assign_block_vars('switch_ya_merge', array());
}

function init_group($uid) {
    global $db, $evoconfig;
    if($evoconfig['initial_group_id'] != '0' && $evoconfig['initial_group_id'] != NULL) {
        $initialusergroup = intval($evoconfig['initial_group_id']);
        if($initialusergroup == 0) {
            return;
        }
        $db->sql_query("INSERT INTO ".USER_GROUP_TABLE." (group_id, user_id, user_pending) VALUES ('$initialusergroup', $uid, '0')");
        add_group_attributes($uid, $initialusergroup);
    }
}

function change_post_msg($message,$ya_username) {
    $message = str_replace("%NAME%", $ya_username, $message);
    return $message;
}

function send_pm($new_uid,$ya_username) {
    global $db, $evoconfig, $evoconfig;
    if($evoconfig['welcome_pm'] != '1') { return; }
    $privmsgs_date = time();
    $sql = "SELECT * FROM "._WELCOME_PM_TABLE;
    if ( !($result = $db->sql_query($sql)) ) {
        echo "Could not obtain private message";
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $message = $row['msg'];
    $subject = $row['subject'];
    if(empty($message) || empty($subject)) {
        return;
    }
    $message = change_post_msg($message,$ya_username);
    $subject = change_post_msg($subject,$ya_username);
    $bbcode_uid = make_bbcode_uid();
    $privmsg_message = prepare_message($message, 1, 1, 1, $bbcode_uid);
    $sql = "INSERT INTO ".PRIVMSGS_TABLE." (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date ) VALUES ('1', '".$subject."', '2', '".$new_uid."', ".$privmsgs_date.")";
    if ( !$db->sql_query($sql) ) {
       echo "Could not insert private message sent info";
    }
    $privmsg_sent_id = $db->sql_nextid();
    $privmsg_message = addslashes($privmsg_message);
    $sql = "INSERT INTO ".PRIVMSGS_TEXT_TABLE." (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text) VALUES ('".$privmsg_sent_id."', '".$bbcode_uid."', '".$privmsg_message."')";
    if ( !$db->sql_query($sql) ) {
       echo "Could not insert private message sent text";
    }
    $sql = "UPDATE ".USERS_TABLE."
            SET user_new_privmsg = user_new_privmsg + 1,  user_last_privmsg = '" . time() . "'
            WHERE user_id = $new_uid";
    if ( !($result = $db->sql_query($sql)) ) {
         echo "Could not update users table";
    }
}

//
// Check and initialize some variables if needed
//
$lang_file = '/lang_mass_pm.php';
if (@file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists($phpbb_root_path . 'language/lang_' . $evoconfig['default_lang'] . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $evoconfig['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}
$lang_file = '/lang_adv_time.php';
if (@file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists($phpbb_root_path . 'language/lang_' . $evoconfig['default_lang'] . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $evoconfig['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

if ( !empty($submit) || !empty($avatargallery) || !empty($submitavatar) || !empty($cancelavatar) || $mode == 'register' ) {
    include_once(NUKE_INCLUDE_DIR . 'functions_validate.php');
    include_once(NUKE_INCLUDE_DIR . 'bbcode.php');
    include_once(NUKE_INCLUDE_DIR . 'functions_post.php');
    $strip_var_list = array('email' => 'email', 'icq' => 'icq', 'aim' => 'aim', 'msn' => 'msn', 'yim' => 'yim', 'website' => 'website', 'location' => 'location', 'occupation' => 'occupation', 'interests' => 'interests', 'confirm_code' => 'confirm_code', 'glance_show' => 'glance_show');
    while( list($var, $param) = @each($strip_var_list) ) {
        $$var = $_GETVAR->get($param, '_POST');
    }
    $trim_var_list = array('cur_password' => 'cur_password', 'new_password' => 'new_password', 'password_confirm' => 'password_confirm', 'signature' => 'signature');
    while( list($var, $param) = @each($trim_var_list) ) {
        $$var = trim($_GETVAR->get($param, '_POST'));
    }
    // Run some validation on the optional fields. These are pass-by-ref, so they'll be changed to
    // empty strings if they fail.
    validate_optional_fields($icq, $aim, $msn, $yim, $website, $location, $occupation, $interests, $signature);
    $xdata = array();
    $xd_meta = get_xd_metadata();
    foreach ($xd_meta as $name => $info) {
        $xd_input = $_GETVAR->get($name, '_POST', 'string', '');
        if ( !empty($xd_input) && $info['handle_input'] ) {
            $xdata[$name] = trim($xd_input);
            $xdata[$name] = str_replace('<br />', "\n", $xdata[$name]);
            if ($info['field_type'] == 'date') {
                list ($day, $month, $year) = preg_split ('#[/.-]#', $xdata[$name]);
                if (checkdate((int)$month, (int)$day, (int)$year))  {
                    $xdata[$name] = mktime(24,0,0,$month,$day,$year);
                }
            }
        } else {
            $xdata[$name] = NULL;
        }
    }
    $signature_bbcode_uid = '';
    $allow_mass_pm        = $_GETVAR->get('allow_mass_pm', '_POST', 'int', 2);
    $viewemail            = $_GETVAR->get('viewemail', '_POST', 'int', 0);
    $hide_images          = $_GETVAR->get('hide_images', '_POST', 'int', 0);
    $allowviewonline      = $_GETVAR->get('hideonline', '_POST', 'int', 1);
    $notifyreply          = $_GETVAR->get('notifyreply', '_POST', 'int', 0);
    $notifypm             = $_GETVAR->get('notifypm', '_POST', 'int', 1);
    $popup_pm             = $_GETVAR->get('popup_pm', '_POST', 'int', 0);
    $sid                  = $_GETVAR->get('sid', '_POST', 'int', 0);
    $rname                = $_GETVAR->get('rname', '_POST', 'string', '');
    if ( $mode == 'register' ) {
        $attachsig        = $_GETVAR->get('attachsig', '_POST', 'int', $evoconfig['allow_sig']);
        $allowhtml        = $_GETVAR->get('allowhtml', '_POST', 'int', $evoconfig['allow_html'] );
        $allowbbcode      = $_GETVAR->get('allowbbcode', '_POST', 'int', $evoconfig['allow_bbcode']);
        $allowsmilies     = $_GETVAR->get('allowsmilies', '_POST', 'int', $evoconfig['allow_smilies'] );
        $showavatars      = $_GETVAR->get('showavatars', '_POST', 'int', TRUE );
        $showsignatures   = $_GETVAR->get('showsignatures', '_POST', 'int', TRUE );
        if ( isset($user_temp)) {
            $username     = $user_temp['username'];
            $rname        = $user_temp['realname'];
            $email        = $user_temp['user_email'];
            $new_password = $user_temp['user_password'];
            $password_confirm = $user_temp['user_password'];
        }
    } else {
        $attachsig        = $_GETVAR->get('attachsig', '_POST', 'int', $userwork['user_attachsig']);
        $allowhtml        = $_GETVAR->get('allowhtml', '_POST', 'int', $userwork['user_allowhtml']);
        $allowbbcode      = $_GETVAR->get('allowbbcode', '_POST', 'int', $userwork['user_allowbbcode']);
        $allowsmilies     = $_GETVAR->get('allowsmilies', '_POST', 'int', $userwork['user_allowsmile']);
        $showavatars      = $_GETVAR->get('showavatars', '_POST', 'int', $userwork['user_showavatars']);
        $showsignatures   = $_GETVAR->get('showsignatures', '_POST', 'int', $userwork['user_showsignatures']);
    }
    $user_wordwrap        = $_GETVAR->get('user_wordwrap', '_POST', 'int', $evoconfig['wrap_def']);
    $user_style           = $_GETVAR->get('profilestyle', '_POST', 'string', $userwork['theme']);
    $user_lang            = $_GETVAR->get('profilelanguage', '_POST', 'string', $evoconfig['default_lang']);
    if ( $user_lang != $evoconfig['default_lang'] ) {
        $allowed_languages = lang_list();
        $selected_lang     = $user_lang;
        if ( in_array($selected_lang, $allowed_languages) ) {
            $user_lang = $selected_lang;
        } else {
            $error = true;
            $error_msg = $lang['Fields_empty'];
        }
    }
    $user_timezone        = $_GETVAR->get('timezone', '_POST', 'double', $evoconfig['board_timezone']);
    $time_mode            = $_GETVAR->get('time_mode', '_POST', 'int', $evoconfig['default_time_mode']);
    $dst_time_lag         = $_GETVAR->get('dst_time_lag', '_POST', 'int', $evoconfig['default_dst_time_lag']);
    if ( preg_match("#[^0-9]#",$dst_time_lag) || $dst_time_lag < 0 || $dst_time_lag > 120 ) {
        $error = TRUE;
        $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['dst_time_lag_error'];
    }
    $user_dateformat      = $_GETVAR->get('dateformat', '_POST', 'string', $evoconfig['default_dateformat']);
    $user_show_quickreply = $_GETVAR->get('show_quickreply', '_POST', 'int', TRUE);
    $user_quickreply_mode = $_GETVAR->get('quickreply_mode', '_POST', 'int', TRUE);
    $user_open_quickreply = $_GETVAR->get('open_quickreply', '_POST', 'int', TRUE);
    $extra_info           = $_GETVAR->get('extra_info', '_POST', 'string', '');
    $newsletter           = $_GETVAR->get('newsletter', '_POST', 'int', FALSE);;

    if (!empty($submitavatar) || !empty($submit)) {
        include_once(NUKE_INCLUDE_DIR . 'usercp_avatar.php');
        $avatar_input_select   = $_GETVAR->get('avatarselect', '_POST', 'string', '');
        $avatar_input_local    = $_GETVAR->get('avatarlocal', '_POST', 'string', '');
        if (!empty($avatar_input_select) && $evoconfig['allow_avatar_local'] )  {
            $user_avatar_local = $avatar_input_select;
        } elseif (!empty($avatar_input_local)) {
            $user_avatar_local = $avatar_input_local;
        } else {
            $user_avatar_local = '';
        }
        if ($evoconfig['allow_avatar_local']) {
            $user_avatar_category   = $_GETVAR->get('avatarcatname', '_POST', 'string', '');
        } else {
            $user_avatar_category   = '';
        }
        $is_avatar_url          = FALSE;
        $user_avatar_remoteurl  = $_GETVAR->get('avatarremoteurl', '_POST', 'string', '');
        $input_avatar_url       = $_GETVAR->get('avatarurl', '_POST', 'string', '');
        if (!empty($input_avatar_url)) {
            $user_avatar_remote = $input_avatar_url;
            $user_avatar_filename   = $input_avatar_url;
            $is_avatar_url      = TRUE;
        } else {
            $user_avatar_upload = $_GETVAR->get('avatar', '_FILES', 'array', array());
            if (!empty($user_avatar_upload['tmp_name'])) {
                $is_avatar_url  = TRUE;
            }
        }
        if ($is_avatar_url && isset($user_avatar_upload['tmp_name']) && !empty($user_avatar_upload['tmp_name']) ) {
            $user_avatar_filename   = $user_avatar_upload['tmp_name'];
            $user_avatar_name       = $user_avatar_upload['name'];
            $user_avatar_size       = $user_avatar_upload['size'];
            $user_avatar_filetype   = $user_avatar_upload['type'];
            $avatar_sql             = '';
        }
        if ( $is_avatar_url ) {
            if ( !empty($user_avatar_upload['tmp_name']) || !empty($user_avatar_remote) ) {
                $avatar_mode      = (!empty($user_avatar_upload['tmp_name']) ? 'local' : 'remote');
                $avatar_sql       = user_avatar_upload($mode, $avatar_mode, $userwork['user_avatar'], $userwork['user_avatar_type'], $error, $error_msg, $user_avatar_filename, $user_avatar_name, $user_avatar_size, $user_avatar_filetype);
                $user_avatar      = $userwork['user_avatar'] = $user_avatar_name;
                $user_avatar_type = $userwork['user_avatar_type'] = USER_AVATAR_UPLOAD;
            } else if ( !empty($user_avatar_name) ) {
                $l_avatar_size    = sprintf($lang['Avatar_filesize'], round($evoconfig['avatar_filesize'] / 1024));
                $error            = true;
                $error_msg       .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $l_avatar_size;
            }
        } else if ( !empty($user_avatar_remoteurl) && $evoconfig['allow_avatar_remote'] ) {
            $avatar_sql       = user_avatar_url($mode, $error, $error_msg, $user_avatar_remoteurl);
            $user_avatar      = $userwork['user_avatar'] = $user_avatar_remoteurl;
            $user_avatar_type = $userwork['user_avatar_type'] = USER_AVATAR_REMOTE;
        } else if ( !empty($user_avatar_local) && $evoconfig['allow_avatar_local'] ) {
            $avatar_sql       = user_avatar_gallery($mode, $error, $error_msg, $user_avatar_local, $user_avatar_category);
            $user_avatar      = $userwork['user_avatar'] = $user_avatar_category . '/' . $user_avatar_local;
            $user_avatar_type = $userwork['user_avatar_type'] = USER_AVATAR_GALLERY;
        }
    }
    $avatar_delete = $_GETVAR->get('avatardel', '_POST', 'string', '');
    if ( !empty($avatar_delete) && $mode == 'editprofile' ) {
        $avatar_sql       = user_avatar_delete($userwork['user_avatar_type'], $userwork['user_avatar']);
        $user_avatar      = $userwork['user_avatar'] = '';
        $user_avatar_type = $userwork['user_avatar_type'] = USER_AVATAR_NONE;
    }
    if (is_admin()) {
        $user_rank = $_GETVAR->get('user_rank', '_POST', 'string', '');
    }
    if ( (!empty($avatargallery) || !empty($submitavatar) || !empty($cancelavatar)) && (empty($submit)) ) {
        $cur_password     = htmlspecialchars($cur_password);
        $new_password     = htmlspecialchars($new_password);
        $password_confirm = htmlspecialchars($password_confirm);
        @reset($xdata);
        while ( list($code_name, $value) = each($xdata) ) {
            $xdata[$code_name] = $value;
        }
    }
}
//
// Let's make sure the user isn't logged in while registering,
// and ensure that they were trying to register a second time
// (Prevents double registrations)
//
if ($mode == 'register' && ($userwork['session_logged_in'] || $username == $userwork['username'])) {
    message_die(GENERAL_MESSAGE, $lang['Username_taken'], '', __LINE__, __FILE__);
}
//
// Did the user submit? In this case build a query to update the users profile in the DB
//
if ( !empty($submit) ) {
    include_once(NUKE_INCLUDE_DIR . 'usercp_avatar.php');
    $passwd_sql = '';
    if ( $mode == 'editprofile' ) {
        if ( $user_id != $userwork['user_id'] ) {
            $error = TRUE;
            $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Wrong_Profile'];
        }
    } else if ( $mode == 'register' ) {
        if ( empty($username) || empty($new_password) || empty($password_confirm) || empty($email) ) {
            $error = TRUE;
            $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
        }
    }
    if ($evoconfig['enable_confirm'] && $mode == 'register') {
        $confirm_id = $_GETVAR->get('confirm_id', '_POST', 'string', '');
        if (empty($confirm_id)) {
            $error = TRUE;
            $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
        } else {
            $confirm_id = htmlspecialchars($confirm_id);
            if (!preg_match('/^[A-Za-z0-9]+$/', $confirm_id)) {
                $confirm_id = '';
            }
            $sql = 'SELECT code
                    FROM ' . CONFIRM_TABLE . "
                    WHERE confirm_id = '$confirm_id'
                    AND session_id = '" . $userwork['session_id'] . "'";
            if (!($result = $db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Could not obtain confirmation code', '', __LINE__, __FILE__, $sql);
            }
            if ($row = $db->sql_fetchrow($result)) {
                if ($row['code'] != $confirm_code) {
                    $error = TRUE;
                    $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
                } else  {
                    $sql = 'DELETE FROM ' . CONFIRM_TABLE . "
                            WHERE confirm_id = '$confirm_id'
                            AND session_id = '" . $userwork['session_id'] . "'";
                    if (!$db->sql_query($sql)) {
                        message_die(GENERAL_ERROR, 'Could not delete confirmation code', '', __LINE__, __FILE__, $sql);
                    }
                }
            } else {
                $error = TRUE;
                $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
            }
            $db->sql_freeresult($result);
        }
    }
    $passwd_sql = '';
    if ( !empty($new_password) && !empty($password_confirm) ) {
        if ( $new_password != $password_confirm ) {
            $error = TRUE;
            $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
        } else if ( strlen($new_password) > 32 ) {
            $error = TRUE;
            $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_long'];
        } else {
            if ( $mode == 'editprofile' ) {
                $sql = "SELECT user_password
                        FROM " . USERS_TABLE . "
                        WHERE user_id = '$user_id'";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not obtain user_password information', '', __LINE__, __FILE__, $sql);
                }
                $row = $db->sql_fetchrow($result);
                $db->sql_freeresult($result);
                if ( $row['user_password'] != $cur_password ) {
                    $error = TRUE;
                    $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
                }
            }
            if ( !$error ) {
                if($mode != 'register') {
                    $new_password = EvoCrypt($new_password);
                }
                $passwd_sql = "user_password = '$new_password', ";
                $userinfo['user_password'] = $new_password;
            }
        }
    } else if ( ( empty($new_password) && !empty($password_confirm) ) || ( !empty($new_password) && empty($password_confirm) ) ) {
        $error = TRUE;
        $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
    }
    //
    // Do a ban check on this email address
    //
    if ( $email != $userwork['user_email'] || $mode == 'register' ) {
        $result = validate_email($email);
        if ( $result['error'] ) {
            $email = $userwork['user_email'];
            $error = TRUE;
            $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
        }
        if ( $mode == 'editprofile' ) {
            $sql = "SELECT user_password
                    FROM " . USERS_TABLE . "
                    WHERE user_id = '$user_id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain user_password information', '', __LINE__, __FILE__, $sql);
            }
            $row = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);
            if ( $row['user_password'] != $cur_password ) {
                $email = $userwork['user_email'];
                $error = TRUE;
                $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
            }
        }
    }
    $username_sql = '';
    if ( $evoconfig['allow_namechange'] || $mode == 'register' ) {
        if ( empty($username) ) {
            // Error is already triggered, since one field is empty.
            $error = TRUE;
        } else if ( $username != $userwork['username'] || $mode == 'register' ) {
            if (strtolower($username) != strtolower($userwork['username']) || $mode == 'register') {
                $result = validate_username($username);
                if ( $result['error'] ) {
                    $error = TRUE;
                    $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
                }
            }
            if (!$error) {
                $username_sql = "username = '" . str_replace("\'", "''", $username) . "', ";
            }
        }
    }
    if ( $signature != '' ) {
        if ( strlen($signature) > $evoconfig['max_sig_chars'] ) {
            $error = TRUE;
            $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Signature_too_long'];
        }
        if ( !isset($signature_bbcode_uid) || $signature_bbcode_uid == '' ) {
            $signature_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
        }
        $signature = prepare_message($signature, $allowhtml, $allowbbcode, $allowsmilies, $signature_bbcode_uid);
    }
    $xd_meta = get_xd_metadata();
    while ( list($code_name, $meta) = each($xd_meta) ) {
        $meta['field_desc'] = decode_bbcode(set_smilies(stripslashes($meta['field_desc'])), 1, true);
        if ( $meta['field_type'] == 'checkbox' ) {
            $xdata[$code_name] = ( isset($xdata[$code_name]) ) ? 1 : 0;
        }
        if ( $meta['handle_input'] && ( ($mode == 'register' && $meta['default_auth'] == XD_AUTH_ALLOW) || ($mode != 'register' ? xdata_auth($code_name, $user_id) : 0) || $userwork['user_level'] == ADMIN ) ) {
            if ( ($meta['field_length'] > 0) && (strlen($xdata[$code_name]) > $meta['field_length']) ) {
                $error = TRUE;
                $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_too_long'], $meta['field_name']);
            }
            if ( ( count($meta['values_array']) > 0 ) && ( ! in_array($xdata[$code_name], $meta['values_array']) ) ) {
                $error = TRUE;
                $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
            }
            if ( $meta['manditory'] && (strlen($xdata[$code_name]) < 1) ) {
                $error = TRUE;
                $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
            }
            if ( ( strlen($meta['field_regexp']) > 0 ) && ( ! preg_match($meta['field_regexp'], $xdata[$code_name]) ) && (strlen($xdata[$code_name]) > 0) ) {
                $error = TRUE;
                $error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
            }
            if ( $meta['allow_bbcode'] ) {
                if (!$userwork['xdata_bbcode'] && $mode != 'register') {
                    $xdata_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
                    if ($allowbbcode && !empty($xdata_bbcode_uid)) {
                        $db->sql_query('UPDATE `'.USERS_TABLE.'` SET xdata_bbcode="'.$xdata_bbcode_uid.'" WHERE `user_id` ='.$userwork['user_id']);
                    }
                } else {
                    $xdata_bbcode_uid = $userwork['xdata_bbcode'];
                }
            }
            $xdata[$code_name] = prepare_message($xdata[$code_name], $meta['allow_html'], $meta['allow_bbcode'], $meta['allow_smilies'], $xdata_bbcode_uid);
        }
    }
    if ( $user_wordwrap < $evoconfig['wrap_min'] || $user_wordwrap > $evoconfig['wrap_max'] ) {
        $error = TRUE;
        $error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Word_Wrap_Error'];
    }
    if ( !$error ) {
        if ( empty($avatar_sql)  ) {
            $avatar_sql = ( $mode == 'editprofile' ) ? '' : "'', " . USER_AVATAR_NONE;
        }
        if ( $mode == 'editprofile' ) {
            if ( $email != $userwork['user_email'] && $evoconfig['require_activation'] != USER_ACTIVATION_NONE && $userwork['user_level'] != ADMIN ) {
                $user_active = 0;
                $user_actkey = gen_rand_string(true);
                $key_len = 54 - ( strlen($server_url) );
                $key_len = ( $key_len > 6 ) ? $key_len : 6;
                $user_actkey = substr($user_actkey, 0, $key_len);
                if ( $userwork['session_logged_in'] ) {
                    session_end($userwork['sid'], $userwork['user_id']);
                }
            } else {
                $user_active = 1;
                $user_actkey = '';
            }
            $is_saved = 0;
            if (is_admin() ) {
                $sql_user_rank = ( empty($user_rank) ? ", user_rank = '' " : ", user_rank = '".$user_rank."' ");
            } else {
                $sql_user_rank = '';
            }
            $sql = "UPDATE " . USERS_TABLE . "
                    SET " . $username_sql . $passwd_sql . "user_email = '" . str_replace("\'", "''", $email) ."', user_icq = '" . str_replace("\'", "''", $icq) . "', user_website = '" . str_replace("\'", "''", $website) . "', user_occ = '" . str_replace("\'", "''", $occupation) . "', user_from = '" . str_replace("\'", "''", $location) . "',
                            user_interests = '" . str_replace("\'", "''", $interests) . "', user_glance_show = '". intval($glance_show) . "', user_viewemail = '$viewemail', user_aim = '" . str_replace("\'", "''", str_replace(' ', '+', $aim)) . "', user_yim = '" . str_replace("\'", "''", $yim) . "', user_msnm = '" . str_replace("\'", "''", $msn) . "',
                            user_attachsig = $attachsig, user_allowsmile = '$allowsmilies', user_showavatars = '$showavatars', user_showsignatures = '$showsignatures', user_allowhtml = '$allowhtml', user_allowbbcode = '$allowbbcode', user_allow_viewonline = '$allowviewonline', user_notify = '$notifyreply', user_notify_pm = '$notifypm',
                            user_allow_mass_pm = '$allow_mass_pm', user_popup_pm = '$popup_pm', user_timezone = '$user_timezone', user_time_mode = $time_mode, user_dst_time_lag = $dst_time_lag, user_dateformat = '" . str_replace("\'", "''", $user_dateformat) . "', user_show_quickreply = '$user_show_quickreply', user_quickreply_mode = '$user_quickreply_mode',
                            user_wordwrap = '" . str_replace("\'", "''", $user_wordwrap) . "', user_open_quickreply = $user_open_quickreply, user_lang = '" . str_replace("\'", "''", $user_lang) . "', theme = '$user_style', user_active = '$user_active', user_actkey = '" . str_replace("\'", "''", $user_actkey) . "'" . $avatar_sql . ", name = '".$rname."',
                            newsletter = '".$newsletter."', bio = '".$extra_info."', user_hide_images = '$hide_images' ".$sql_user_rank."
                    WHERE user_id = '$user_id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql);
            } else {
                $is_saved = 1;
                // Update Admin Passwort if user is Admin too
                if ( !empty($passwd_sql) ) {
                    $is_admin_field = get_admin_field('aid', $username);
                    if ( isset($is_admin_field) && !empty($is_admin_field['name'])) {
                        $db->sql_uquery("UPDATE `". _AUTHOR_TABLE . "` SET `pwd` = '".$new_password."' WHERE `aid` = '".$username."'");
                    }
                }
            }
            if ( !defined('IN_ADMIN_USERS') && ($is_saved == 1) ) {
                global $userinfo;
                $userinfo['theme'] = $user_style;
                $userinfo['user_lang'] = $user_lang;
                $currentlang = $user_lang;
                evo_setcookie('user_language', $currentlang, 0);
                evo_setcookie('theme', $user_style, 0);
                evo_setusercookie($user_id);
                // We remove all stored login keys since the password has been updated
                // and change the current one (if applicable)
                if ( !empty($passwd_sql) ) {
                    session_reset_keys($user_id, $user_ip);
                }
            }
            foreach ($xdata as $code_name => $value) {
                set_user_xdata($user_id, $code_name, $value);
            }
            if ( !$user_active ) {
                //
                // The users account has been deactivated, send them an email with a new activation key
                //
                if ( $evoconfig['require_activation'] != USER_ACTIVATION_ADMIN ) {
                    $new_username = preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25));
                    $activate_link = EVO_SERVER_URL.'/modules.php?name=Your_Account&amp;mode=activate&amp;' . POST_USERS_URL . '=' . $user_id . '&amp;act_key=' . $user_actkey;
                    $message  = $lang['HELLO'].' '.$new_username.',<br /><br />';
                    $message .= $lang['NEW_ACCOUNT_OBJECT'].'<br /><br />';
                    $message .= $message_text.'<br /><br />';
                    $message .= $lang['NEW_ACCOUNT_ACTIVATE_LINK'].'<br /><br />';
                    $message .= (!empty($evoconfig['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $evoconfig['board_email_sig']) : '';
                    $subject = $lang['Reactivate'];
                    $to      = $admin['email'];
                    $return  = evo_mail($to, $subject, $message);
                } else if ( $evoconfig['require_activation'] == USER_ACTIVATION_ADMIN ) {
                    $my_modul_admins = get_mod_admins('Forums', '1');
                    for ($i=0, $max = count($my_modul_admins); $i < $max; $i++) {
                        $admin = $my_modul_admins[$i];
                        if (!empty($admin['email'])) {
                            $admin_name  = $admin['aid'];
                            $admin_email = $admin['email'];
                            $new_username = preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25));
                            $activate_link = EVO_SERVER_URL.'/modules.php?name=Your_Account&amp;mode=activate&amp;' . POST_USERS_URL . '=' . $user_id . '&amp;act_key=' . $user_actkey;
                            $message  = $lang['HELLO'].' '.$admin['aid'].',<br /><br />';
                            $message .= $lang['NEW_ACCOUNT_OBJECT'].'<br /><br />';
                            $message .= $message_text.'<br /><br />';
                            $message .= $lang['NEW_ACCOUNT_ACTIVATE_LINK'].'<br /><br />';
                            $message .= (!empty($evoconfig['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $evoconfig['board_email_sig']) : '';
                            $subject = $lang['Reactivate'];
                            $to      = $admin['email'];
                            $return  = evo_mail($to, $subject, $message);
                        }
                    }
                }
                //evcz mod=>logout
                global $userinfo;
                $r_uid = $userinfo['user_id'];
                $r_username = $userinfo['username'];
                evo_setcookie('user', 'delete', -1);
                $db->sql_uquery("DELETE FROM "._SESSION_TABLE." WHERE uname='$r_username'");
                $user = "";
                //fine evcz mod=>logout
                if (is_active('Forums')) {
                    $message = $lang['Profile_updated_inactive'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.php") . '" target="_parent">', '</a>');
                } else {
                    $message = $lang['Profile_updated_inactive'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="index.php" target="_parent">', '</a>');
                }
            } else {
                if (is_active('Forums')) {
                    $message = $lang['Profile_updated'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.php") . '" target="_parent">', '</a>');
                    $message .= '<br /><br />' . sprintf($lang['Click_return_profile'],  '<a href=' . append_sid('profile.php?mode=viewprofile&amp;u=' . $userwork['user_id']) . ' target="_parent">', '</a>');
                } else {
                    $message = $lang['Profile_updated'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="index.php" target="_parent">', '</a>');
                }
            }
            if ( defined('IN_ADMIN_USERS') ) {
                $message = $message . '<br /><br />' . sprintf($lang['Click_return_userlist'], "<a href=\"" . admin_sid("admin_userlist.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
                message_die(GENERAL_MESSAGE, $message);
            } else {
                message_die(GENERAL_MESSAGE, $message);
            }
        } else {
            $sql = "SELECT MAX(user_id) AS total
                    FROM ".USERS_TABLE;
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
            }
            if ( !($row = $db->sql_fetchrow($result)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
            }
            $db->sql_freeresult($result);
            $user_id = $row['total'] + 1;
            //
            // Get current date
            //
            $reg_date = date("M d, Y");
            $sql = "INSERT INTO ".USERS_TABLE." (user_id, username, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_glance_show, user_sig, user_sig_bbcode_uid, user_avatar, user_avatar_type, user_viewemail, user_aim, user_yim, user_msnm, user_attachsig, user_allowsmile, user_showavatars, user_showsignatures, user_allowhtml, user_allowbbcode, user_allow_viewonline, user_notify, user_notify_pm, user_allow_mass_pm, user_popup_pm, user_timezone, user_time_mode, user_dst_time_lag, user_dateformat, user_show_quickreply, user_quickreply_mode, user_wordwrap, user_open_quickreply, user_lang, theme, user_level, user_allow_pm, name, newsletter, bio, user_hide_images, user_active, user_actkey)
                    VALUES ('$user_id', '" . str_replace("\'", "''", $username) . "', '" . $reg_date . "', '" . str_replace("\'", "''", $new_password) . "', '" . str_replace("\'", "''", $email) . "', '" . str_replace("\'", "''", $icq) . "', '" . str_replace("\'", "''", $website) . "', '" . str_replace("\'", "''", $occupation) . "', '" . str_replace("\'", "''", $location) . "', '" . str_replace("\'", "''", $interests) . "', '" . str_replace("\'", "''", $glance_show) . "', '" . str_replace("\'", "''", $signature) . "', '$signature_bbcode_uid', '$user_avatar', '$user_avatar_type', '$viewemail', '" . str_replace("\'", "''", str_replace(' ', '+', $aim)) . "', '" . str_replace("\'", "''", $yim) . "', '" . str_replace("\'", "''", $msn) . "', '$attachsig', '$allowsmilies', '$showavatars', '$showsignatures', '$allowhtml', '$allowbbcode', '$allowviewonline', '$notifyreply', '$notifypm', '$allow_mass_pm', '$popup_pm', '$user_timezone', '$time_mode', '$dst_time_lag', '" . str_replace("\'", "''", $user_dateformat) . "', '$user_show_quickreply', '$user_quickreply_mode', '" . str_replace("\'", "''", $user_wordwrap) . "', $user_open_quickreply, '" . str_replace("\'", "''", $user_lang) . "', '$user_style', '1', '1', '".$rname."', '".$newsletter."', '".$extra_info."', '$hide_images', ";
            if ( $evoconfig['require_activation'] == USER_ACTIVATION_SELF || $evoconfig['require_activation'] == USER_ACTIVATION_ADMIN || $coppa ) {
                $user_actkey = gen_rand_string(true);
                $key_len = 54 - (strlen($server_url));
                $key_len = ( $key_len > 6 ) ? $key_len : 6;
                $user_actkey = substr($user_actkey, 0, $key_len);
                $sql .= "0, '" . str_replace("\'", "''", $user_actkey) . "')";
            } else {
                $sql .= "1, '')";
            }
            if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) ) {
                message_die(GENERAL_ERROR, 'Could not insert data into users table', '', __LINE__, __FILE__, $sql);
            }
            $sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
                    VALUES ('', 'Personal User', '1', '0')";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not insert data into groups table', '', __LINE__, __FILE__, $sql);
            }
            $group_id = $db->sql_nextid();
            $sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
                    VALUES ('$user_id', '$group_id', '0')";
            if( !($result = $db->sql_query($sql, END_TRANSACTION)) ) {
                message_die(GENERAL_ERROR, 'Could not insert data into user_group table', '', __LINE__, __FILE__, $sql);
            }
            init_group($user_id);
            send_pm($user_id,str_replace("\'", "''", $username));
            foreach ($xdata as $code_name => $value) {
                set_user_xdata($user_id, $code_name, $value);
            }
            if ( $coppa ) {
                $message = $lang['COPPA'];
                $email_template = 'coppa_welcome_inactive';
            } else if ( $evoconfig['require_activation'] == USER_ACTIVATION_SELF ) {
                $message = $lang['Account_inactive'];
                $email_template = 'user_welcome_inactive';
            } else if ( $evoconfig['require_activation'] == USER_ACTIVATION_ADMIN ) {
                $message = $lang['Account_inactive_admin'];
                $email_template = 'admin_welcome_inactive';
            } else {
                $message = $lang['Account_added'];
                $email_template = 'user_welcome';
            }
            $sql = "SELECT ug.user_id, g.group_id as g_id, g.group_name , u.user_posts, g.group_count
                    FROM (".GROUPS_TABLE." g LEFT JOIN ".USER_GROUP_TABLE." ug ON g.group_id=ug.group_id AND ug.user_id=$user_id , "._USERS_TABLE." u )
                    WHERE u.user_id=$user_id
                    AND ug.user_id is NULL
                    AND g.group_count=0
                    AND g.group_single_user=0
                    AND g.group_moderator<>$user_id";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Error geting users post stat', '', __LINE__, __FILE__, $sql);
            }
            while ($group_data = $db->sql_fetchrow($result)) {
                //user join a autogroup
                $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                        VALUES (".$group_data['g_id'].", $user_id, 0)";
                if ( !($db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Error inserting user group, group count', '', __LINE__, __FILE__, $sql);
                }
            }
            if ( $evoconfig['require_activation'] == USER_ACTIVATION_ADMIN ) {
                $my_modul_admins = get_mod_admins('Forums', '1');
                for ($i=0, $max = count($my_modul_admins); $i < $max; $i++) {
                    $admin = $my_modul_admins[$i];
                    if (!empty($admin['email'])) {
                        $admin_name  = $admin['aid'];
                        $admin_email = $admin['email'];
                        $new_username = preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25));
                        $activate_link = EVO_SERVER_URL.'/modules.php?name=Your_Account&amp;mode=activate&amp;' . POST_USERS_URL . '=' . $user_id . '&amp;act_key=' . $user_actkey;
                        $message  = $lang['HELLO'].' '.$admin['aid'].',<br /><br />';
                        $message .= $lang['NEW_ACCOUNT_OBJECT'].'<br /><br />';
                        $message .= $message_text.'<br /><br />';
                        $message .= $lang['NEW_ACCOUNT_ACTIVATE_LINK'].'<br /><br />';
                        $message .= (!empty($evoconfig['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $evoconfig['board_email_sig']) : '';
                        $subject = $lang['New_account_subject'];
                        $to      = $admin['email'];
                        $return  = evo_mail($to, $subject, $message);
                    }
                }
            }
            if ( defined('IN_ADMIN_USERS') ) {
                $message = $message . '<br /><br />';
            } else {
                $message = $message . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.php") . '">', '</a>');
                message_die(GENERAL_MESSAGE, $message);
            }
        } // if mode == register
    }
} // End of submit
if ( $error ) {
    //
    // If an error occured we need to stripslashes on returned data
    //
    $username           = stripslashes($username);
    $rname              = stripslashes($rname);
    $email              = stripslashes($email);
    $cur_password       = '';
    $new_password       = '';
    $password_confirm   = '';
    $icq                = stripslashes($icq);
    $aim                = str_replace('+', ' ', stripslashes($aim));
    $msn                = stripslashes($msn);
    $yim                = stripslashes($yim);
    $website            = stripslashes($website);
    $location           = stripslashes($location);
    $occupation         = stripslashes($occupation);
    $interests          = stripslashes($interests);
    $glance_show        = stripslashes($glance_show);
    $hide_images        = stripslashes($hide_images);
    @reset($xdata);
    while ( list($code_name, $value) = each($xdata) ) {
        $xdata[$code_name] = stripslashes($value);
        if ($xd_meta[$code_name]['allow_bbcode']) {
            $xdata[$code_name] = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si", '\\3', $value) : $value;
        }
    }
    $user_wordwrap      = stripslashes($user_wordwrap);
    $user_lang          = stripslashes($user_lang);
    $user_dateformat    = stripslashes($user_dateformat);
    $user_rank          = stripslashes($user_rank);
} else if ( $mode == 'editprofile' && empty($avatargallery) && empty($submitavatar) && empty($cancelavatar) ) {
    $user_id            = $userwork['user_id'];
    if (empty($user_id) || $user_id <= 0) {
        message_die(GENERAL_MESSAGE, $lang['User_not_exist']);
    }
    $username           = $userwork['username'];
    $email              = $userwork['user_email'];
    $cur_password       = '';
    $new_password       = '';
    $password_confirm   = '';
    $icq                = $userwork['user_icq'];
    $aim                = str_replace('+', ' ', $userwork['user_aim']);
    $msn                = $userwork['user_msnm'];
    $yim                = $userwork['user_yim'];
    $website            = $userwork['user_website'];
    $userwork['user_from'] = str_replace('.gif', '', $userwork['user_from']);
    $location           = $userwork['user_from'];
    $occupation         = $userwork['user_occ'];
    $interests          = $userwork['user_interests'];
    $glance_show        = $userwork['user_glance_show'];
    $hide_images        = $userwork['user_hide_images'];
    $allow_mass_pm      = $userwork['user_allow_mass_pm'];
    $xdata_bbcode       = $userwork['xdata_bbcode'];
    $xd_meta            = get_xd_metadata();
    $xdata              = get_user_xdata($userwork['user_id']);
    foreach ($xdata as $name => $value) {
        if ($xd_meta[$name]['field_type'] == 'date') {
            $xdata[$name] = formatTimestamp($xdata[$name], '', TRUE);
        }
        if ($xd_meta[$name]['allow_bbcode']) {
            $xdata[$name] = ($xdata_bbcode != '') ? preg_replace("/:(([a-z0-9]+:)?)$xdata_bbcode(=|\])/si", '\\3', $value) : $value;
        }
    }
    $viewemail          = $userwork['user_viewemail'];
    $notifypm           = $userwork['user_notify_pm'];
    $popup_pm           = $userwork['user_popup_pm'];
    $notifyreply        = $userwork['user_notify'];
    $attachsig          = $userwork['user_attachsig'];
    $allowhtml          = $userwork['user_allowhtml'];
    $allowbbcode        = $userwork['user_allowbbcode'];
    $allowsmilies       = $userwork['user_allowsmile'];
    $showavatars        = $userwork['user_showavatars'];
    $showsignatures     = $userwork['user_showsignatures'];
    $allowviewonline    = $userwork['user_allow_viewonline'];
    $user_avatar        = ( $userwork['user_allowavatar'] ) ? $userwork['user_avatar'] : '';
    $user_avatar_type   = ( $userwork['user_allowavatar'] ) ? $userwork['user_avatar_type'] : USER_AVATAR_NONE;
    $user_style         = $userwork['theme'];
    $user_wordwrap      = $userwork['user_wordwrap'];
    $user_lang          = $userwork['user_lang'];
    $user_timezone      = $userwork['user_timezone'];
    $time_mode          = $userwork['user_time_mode'];
    $dst_time_lag       = $userwork['user_dst_time_lag'];
    $user_dateformat    = $userwork['user_dateformat'];
    $user_show_quickreply = $userwork['user_show_quickreply'];
    $user_quickreply_mode = $userwork['user_quickreply_mode'];
    $user_open_quickreply = $userwork['user_open_quickreply'];
    $rname              = $userwork['name'];
    $extra_info         = $userwork['bio'];
    $newsletter         = $userwork['newsletter'];
    $user_rank          = $userwork['user_rank'];
}

//
// Default pages
//
if ( !defined('ADMIN_FILE') ) {
//    title('', 'Profile', 'profile-logo.png');
//    $gen_simple_header = TRUE;
//    include_once(NUKE_INCLUDE_DIR . 'page_header.php');
    if  ( $mode == 'editprofile') {
        if ( $user_id != $userwork['user_id'] ) {
            message_die(GENERAL_MESSAGE, $lang['Wrong_Profile']);
            exit;
        } else {
            get_lang('Your_Account');
            define_once('CNBYA',true);
            include_once(NUKE_MODULES_DIR . 'Your_Account/public/navbar.php');
            nav(1);
        }
    }
}

make_jumpbox('viewforum.php');

if( !empty($avatargallery) && !$error ) {
    include_once(NUKE_INCLUDE_DIR . 'usercp_avatar.php');
    $avatar_category = htmlspecialchars($_GETVAR->get('avatarcategory', '_POST', 'string', ''));
    $template->set_filenames(array(
        'body' => 'profile_avatar_gallery.tpl')
    );
    display_avatar_gallery($mode, $avatar_category, $user_id, $email, $current_email, $coppa, $username, $email, $new_password, $cur_password, $password_confirm, $icq, $aim, $msn, $yim, $website, $location, $occupation, $interests, $glance_show, $signature, $viewemail, $notifypm, $allow_mass_pm, $popup_pm, $notifyreply, $attachsig, $allowhtml, $allowbbcode, $allowsmilies, $showavatars, $showsignatures, $allowviewonline, $user_style, $user_wordwrap, $user_lang, $user_timezone, $time_mode, $dst_time_lag, $user_dateformat, $user_show_quickreply, $user_quickreply_mode, $user_open_quickreply, $userwork['session_id'], $xdata, $rname, $extra_info, $newsletter, $hide_images);
} else {
    include_once(NUKE_INCLUDE_DIR . 'functions_selects.php');
    if ( !isset($coppa) ) {
        $coppa = FALSE;
    }
    if ( empty($user_style) ) {
        $user_style = $evoconfig['default_style'];
    }
    $avatar_img = GetAvatar($userwork['user_id']);
    $s_hidden_fields  = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" />';
    $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userwork['session_id'] . '" />';

    if( $mode == 'editprofile' ) {
        $s_hidden_fields .= '<input type="hidden" name="user_id" value="' . $userwork['user_id'] . '" />';
        // Send the users current email address. If they change it, and account activation is turned on
        // the user account will be disabled and the user will have to reactivate their account.
        $s_hidden_fields .= '<input type="hidden" name="current_email" value="' . $userwork['user_email'] . '" />';
        $s_hidden_fields .= '<input type="hidden" name="cur_password" value="' . $userwork['user_password'] . '" />';
    }
    if ( !empty($user_avatar_local) ) {
        $s_hidden_fields .= '<input type="hidden" name="avatarlocal" value="' . $user_avatar_local . '" /><input type="hidden" name="avatarcatname" value="' . $user_avatar_category . '" />';
    }
    $html_status    = ( $userwork['user_allowhtml'] && $evoconfig['allow_html'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
    $bbcode_status  = ( $userwork['user_allowbbcode'] && $evoconfig['allow_bbcode']  ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
    $smilies_status = ( $userwork['user_allowsmile'] && $evoconfig['allow_smilies']  ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];
    $l_time_mode_0  = '';
    $l_time_mode_1  = '';
    $l_time_mode_2  = $lang['time_mode_dst_server'];
    $l_time_mode_3  = $lang['time_mode_full_server'];
    $l_time_mode_4  = $lang['time_mode_server_pc'];
    $l_time_mode_6  = $lang['time_mode_full_pc'];
    switch ($evoconfig['default_time_mode']) {
        case MANUAL_DST:
            $l_time_mode_1 = $l_time_mode_1 . '*';
        break;
        case SERVER_SWITCH:
            $l_time_mode_2 = $l_time_mode_2 . '*';
        break;
        case FULL_SERVER:
            $l_time_mode_3 = $l_time_mode_3 . '*';
        break;
        case SERVER_PC:
            $l_time_mode_4 = $l_time_mode_4 . '*';
        break;
        case FULL_PC:
            $l_time_mode_6 = $l_time_mode_6 . '*';
        break;
        default:
            $l_time_mode_0 = $l_time_mode_0 . '*';
        break;
    }
    $time_mode_manual_dst_checked = '';
    $time_mode_server_switch_checked = '';
    $time_mode_full_server_checked = '';
    $time_mode_server_pc_checked = '';
    $time_mode_full_pc_checked = '';
    $time_mode_manual_checked = '';
    switch ($time_mode) {
        case MANUAL_DST:
            $time_mode_manual_dst_checked = 'checked="checked"';
            break;
        case SERVER_SWITCH:
            $time_mode_server_switch_checked = 'checked="checked"';
            break;
        case FULL_SERVER:
            $time_mode_full_server_checked = 'checked="checked"';
            break;
        case SERVER_PC:
            $time_mode_server_pc_checked = 'checked="checked"';
            break;
        case FULL_PC:
            $time_mode_full_pc_checked = 'checked="checked"';
            break;
        default:
            $time_mode_manual_checked = 'checked="checked"';
            break;
    }
    $allow_mass_pm_checked = '';
    $allow_mass_pm_notify_checked = '';
    $disable_mass_pm_checked = '';
    switch ($allow_mass_pm) {
        case 2:
            $allow_mass_pm_checked = 'checked="checked"';
            break;
        case 4:
            $allow_mass_pm_notify_checked = 'checked="checked"';
            break;
        default:
            $disable_mass_pm_checked = 'checked="checked"';
            break;
    }
    if ( $error ) {
        $template->set_filenames(array(
            'reg_header' => 'error_body.tpl')
        );
        $template->assign_vars(array(
            'ERROR_MESSAGE' => $error_msg)
        );
        $template->assign_var_from_handle('ERROR_BOX', 'reg_header');
    }
    $panel_feel_value = $evoconfig['edit_profile_panel_feel'];
    if ($panel_feel_value == '1'){
        $profile_add_body = 'profile_add_body_right';
    } elseif ($panel_feel_value == '2'){
        $profile_add_body = 'profile_add_body_left';
    } else {
        $profile_add_body = 'profile_add_body';
    }
    $template->set_filenames(array(
        'body' => ''.$profile_add_body.'.tpl')
    );
    // Who can disable receiving mass PM ?
    // Set 'A' for Admins, 'M' for admins+Mods or 'U' for all Users
    //
    $can_disable_mass_pm = 'U';
    switch ( $can_disable_mass_pm ) {
        case 'A':
            if ( $userwork['user_level'] == ADMIN ) {
                $template->assign_block_vars('switch_can_disable_mass_pm', array());
            } else {
                $template->assign_block_vars('switch_can_not_disable_mass_pm', array());
            }
            break;
        case 'M':
            if ( $userwork['user_level'] == ADMIN || $userwork['user_level'] == MOD ) {
                $template->assign_block_vars('switch_can_disable_mass_pm', array());
            } else {
                $template->assign_block_vars('switch_can_not_disable_mass_pm', array());
            }
            break;
        default:
            $template->assign_block_vars('switch_can_disable_mass_pm', array());
            break;
    }
    if ( ($mode == 'register') || ($evoconfig['allow_namechange']) ) {
        $template->assign_block_vars('switch_namechange_allowed', array());
    } else {
        $template->assign_block_vars('switch_namechange_disallowed', array());
    }
    $xd_meta = get_xd_metadata();
    while ( list($code_name, $info) = each($xd_meta) ) {
        $info['field_desc'] = set_smilies(decode_bbcode(stripslashes($info['field_desc']), 1, true));
        if ( xdata_auth($code_name, $userwork['user_id']) || intval($userwork['user_level']) == ADMIN ) {
            if ($info['field_type'] == 'date') {
                $xdata[$code_name] = formatTimestamp($xdata[$code_name], '', TRUE);
                $info['field_desc']= $info['field_desc'] . '<br /><small>Format: '._ABR_DAYS . _ABR_DAYS.'-'._ABR_MONTHS . _ABR_MONTHS.'-'._ABR_YEARS . _ABR_YEARS . _ABR_YEARS . _ABR_YEARS.'</small>';
            }
            if ($info['display_register'] == XD_DISPLAY_NORMAL) {
                $template->assign_block_vars('xdata', array(
                    'CODE_NAME'     => $code_name,
                    'NAME'          => $info['field_name'],
                    'DESCRIPTION'   => $info['field_desc'],
                    'VALUE'         => isset($xdata[$code_name]) ? str_replace('"', '&quot;', $xdata[$code_name]) : '',
                    'MAX_LENGTH'    => ( $info['field_length'] > 0) ? ( $info['field_length'] ) : 255
                    )
                );
            switch ($info['field_type']) {
                case 'text':
                    $template->assign_block_vars('xdata.switch_type_text', array());
                    break;
                case 'checkbox':
                   $template->assign_block_vars('xdata.switch_type_checkbox', array( 'CHECKED' => ($xdata[$code_name] == 1) ? ' checked="checked"' : ''  ));
                   break;
                case 'textarea':
                    $template->assign_block_vars('xdata.switch_type_textarea', array());
                    break;
                case 'radio':
                    $template->assign_block_vars('xdata.switch_type_radio', array());
                    while ( list( , $option) = each($info['values_array']) ) {
                        $template->assign_block_vars('xdata.switch_type_radio.options', array(
                            'OPTION'  => $option,
                            'CHECKED' => (isset($xdata[$code_name]) && ($xdata[$code_name] == $option) ? 'checked="checked"' : ''))
                        );
                    }
                    break;
                case 'select':
                    $template->assign_block_vars('xdata.switch_type_select', array());
                    while ( list( , $option) = each($info['values_array']) ) {
                        $template->assign_block_vars('xdata.switch_type_select.options', array(
                            'OPTION'   => $option,
                            'SELECTED' => (isset($xdata[$code_name]) && ($xdata[$code_name] == $option) ? 'selected="selected"' : ''))
                        );
                    }
                    break;
                case 'date':
                    $template->assign_block_vars('xdata.switch_type_date', array());
                    break;
            }
        } elseif ($info['display_register'] == XD_DISPLAY_ROOT) {
            if ($info['field_type'] == 'date') {
                $xdata[$code_name] = formatTimestamp($xdata[$code_name], '', TRUE);
                $info['field_desc']= $info['field_desc'] . '<br /><small>Format: '._ABR_DAYS . _ABR_DAYS.'-'._ABR_MONTHS . _ABR_MONTHS.'-'._ABR_YEARS . _ABR_YEARS . _ABR_YEARS . _ABR_YEARS.'</small>';
            }
            $template->assign_block_vars('xdata',
                array(
                    'CODE_NAME' => $code_name,
                    'NAME' => $xd_meta[$code_name]['field_name'],
                    'DESCRIPTION' => $xd_meta[$code_name]['field_desc'],
                    'VALUE' => (isset($xdata[$code_name]) ? str_replace('"', '&quot;', $xdata[$code_name]) : ''))
                );
                $template->assign_block_vars('xdata.switch_is_'.$code_name, array());
                switch ($info['field_type']) {
                    case 'checkbox':
                        $template->assign_block_vars('xdata.switch_type_checkbox', array( 'CHECKED' => ($xdata[$code_name] == $lang['true']) ? ' checked="checked"' : ''  ));
                        break;
                    case 'radio':
                        while ( list( , $option) = each($info['values_array']) ) {
                            $template->assign_block_vars('xdata.switch_is_'.$code_name.'.options', array(
                                'OPTION' => $option,
                                'CHECKED' => (isset($xdata[$code_name]) && ($xdata[$code_name] == $option) ? 'checked="checked"' : ''))
                            );
                        }
                        break;
                    case 'select':
                        while ( list( , $option) = each($info['values_array']) ) {
                            $template->assign_block_vars('xdata.switch_is_'.$code_name.'.options', array(
                                'OPTION' => $option,
                                'SELECTED' => (isset($xdata[$code_name]) && ($xdata[$code_name] == $option) ? 'selected="selected"' : ''))
                            );
                        }
                        break;
                }
            }
        }
    }
    // Visual Confirmation
    $confirm_image = '';
    if (!empty($evoconfig['enable_confirm']) && $mode == 'register') {
        $sql = 'SELECT session_id FROM ' . SESSIONS_TABLE;
        if (!($result = $db->sql_query($sql))) {
            message_die(GENERAL_ERROR, 'Could not select session data', '', __LINE__, __FILE__, $sql);
        }
        if ($row = $db->sql_fetchrow($result)) {
            $confirm_sql = '';
            do {
                $confirm_sql .= (($confirm_sql != '') ? ', ' : '') . "'" . $row['session_id'] . "'";
            } while ($row = $db->sql_fetchrow($result));
            $sql = 'DELETE FROM ' .  CONFIRM_TABLE . "
                    WHERE session_id NOT IN ($confirm_sql)";
            if (!$db->sql_query($sql)) {
                message_die(GENERAL_ERROR, 'Could not delete stale confirm data', '', __LINE__, __FILE__, $sql);
            }
        }
        $db->sql_freeresult($result);
        $sql = 'SELECT COUNT(session_id) AS attempts
                FROM ' . CONFIRM_TABLE . "
                WHERE session_id = '" . $userwork['session_id'] . "'";
        if (!($result = $db->sql_query($sql))) {
            message_die(GENERAL_ERROR, 'Could not obtain confirm code count', '', __LINE__, __FILE__, $sql);
        }
        if ($row = $db->sql_fetchrow($result)) {
            if ($row['attempts'] > 3) {
                message_die(GENERAL_MESSAGE, $lang['Too_many_registers']);
            }
        }
        $db->sql_freeresult($result);
        // Generate the required confirmation code
        // NB 0 (zero) could get confused with O (the letter) so we make change it
        $code = dss_rand();
        $code = strtoupper(str_replace('0', 'o', substr($code, 0, 6)));
        $confirm_id = md5(uniqid($user_ip));
        $sql = 'INSERT INTO ' . CONFIRM_TABLE . " (confirm_id, session_id, code)
                VALUES ('$confirm_id', '". $userwork['session_id'] . "', '$code')";
        if (!$db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Could not insert new confirm code information', '', __LINE__, __FILE__, $sql);
        }
        unset($code);
        $confirm_image = (GZIPSUPPORT) ? '<img src="' . append_sid("usercp_confirm.php?id=$confirm_id") . '" alt="" title="" />' : '<img src="' . append_sid("usercp_confirm.php?id=$confirm_id&amp;c=1") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.php?id=$confirm_id&amp;c=2") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.php?id=$confirm_id&amp;c=3") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.php?id=$confirm_id&amp;c=4") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.php?id=$confirm_id&amp;c=5") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.php?id=$confirm_id&amp;c=6") . '" alt="" title="" />';
        $s_hidden_fields .= '<input type="hidden" name="confirm_id" value="' . $confirm_id . '" />';
        $template->assign_block_vars('switch_confirm', array());
    }
    if ( $evoconfig['wrap_enable'] ) {
        $template->assign_block_vars('force_word_wrapping',array());
    }
    if (is_admin()) {
        $sql = "SELECT * FROM " . RANKS_TABLE . "
               WHERE rank_special = '1'
               ORDER BY rank_title";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not obtain ranks data', '', __LINE__, __FILE__, $sql);
        }

        $rank_select_box = '<option value="0">' . $lang['No_assigned_rank'] . '</option>';
        while( $row = $db->sql_fetchrow($result) ) {
            $rank = $row['rank_title'];
            $rank_id = $row['rank_id'];

            $selected = ( $userwork['user_rank'] == $rank_id ) ? ' selected="selected"' : '';
            $rank_select_box .= '<option value="' . $rank_id . '"' . $selected . '>' . $rank . '</option>';
        }
        $db->sql_freeresult($result);
        $template->assign_block_vars('switch_rank_block', array());
    }
    // Let's do an overall check for settings/versions which would prevent
    // us from doing file uploads....
    //
    $ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
    $form_enctype = ( @$ini_val('file_uploads') == '0' || strtolower(@$ini_val('file_uploads') == 'off') || @phpversion() == '4.0.4pl1' || !$evoconfig['allow_avatar_upload'] || ( @phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';
    $template->assign_vars(array(
        'USERNAME'                      => isset($username) ? $username : '',
        'CUR_PASSWORD'                  => isset($cur_password) ? $cur_password : '',
        'NEW_PASSWORD'                  => isset($new_password) ? $new_password : '',
        'PASSWORD_CONFIRM'              => isset($password_confirm) ? $password_confirm : '',
        'EMAIL'                         => isset($email) ? $email : '',
        'SIG_EDIT_LINK'                 => (defined('IN_ADMIN_USERS') ? admin_sid('admin_users&amp;mode=signature&amp;'.POST_USERS_URL.'='.$userwork['user_id']) : append_sid('profile.php?mode=signature')),
        'SIG_DESC'                      => $lang['sig_description'],
        'SIG_BUTTON_DESC'               => $lang['sig_edit'],
        'CONFIRM_IMG'                   => $confirm_image,
        'YIM'                           => $yim,
        'ICQ'                           => $icq,
        'MSN'                           => $msn,
        'AIM'                           => $aim,
        'OCCUPATION'                    => $occupation,
        'ALLOW_MASS_PM'                 => $allow_mass_pm,
        'ALLOW_MASS_PM_CHECKED'         => $allow_mass_pm_checked,
        'ALLOW_MASS_PM_NOTIFY_CHECKED'  => $allow_mass_pm_notify_checked,
        'DISABLE_MASS_PM_CHECKED'       => $disable_mass_pm_checked,
        'INTERESTS'                     => $interests,
        'GLANCE_SHOW'                   => glance_option_select($glance_show, 'glance_show'),
        'L_GLANCE_SHOW'                 => $lang['glance_show'],
        'HIDE_IMAGES_YES'               => ( $hide_images ) ? 'checked="checked"' : '',
        'HIDE_IMAGES_NO'                => ( !$hide_images ) ? 'checked="checked"' : '',
        'L_HIDE_IMAGES'                 => $lang['user_hide_images'],
        'LOCATION'                      => $location,
        'WEBSITE'                       => $website,
        'SIGNATURE'                     => ( isset($signature ) ? str_replace('<br />', "\n", $signature) : ''),
        'VIEW_EMAIL_YES'                => ( $viewemail ) ? 'checked="checked"' : '',
        'VIEW_EMAIL_NO'                 => ( !$viewemail ) ? 'checked="checked"' : '',
        'HIDE_USER_YES'                 => ( $allowviewonline ) ? 'checked="checked"' : '',
        'HIDE_USER_NO'                  => ( !$allowviewonline ) ? 'checked="checked"' : '',
        'NOTIFY_PM_YES'                 => ( $notifypm ) ? 'checked="checked"' : '',
        'NOTIFY_PM_NO'                  => ( !$notifypm ) ? 'checked="checked"' : '',
        'POPUP_PM_YES'                  => ( $popup_pm ) ? 'checked="checked"' : '',
        'POPUP_PM_NO'                   => ( !$popup_pm ) ? 'checked="checked"' : '',
        'ALWAYS_ADD_SIGNATURE_YES'      => ( $attachsig ) ? 'checked="checked"' : '',
        'ALWAYS_ADD_SIGNATURE_NO'       => ( !$attachsig ) ? 'checked="checked"' : '',
        'NOTIFY_REPLY_YES'              => ( $notifyreply ) ? 'checked="checked"' : '',
        'NOTIFY_REPLY_NO'               => ( !$notifyreply ) ? 'checked="checked"' : '',
        'ALWAYS_ALLOW_BBCODE_YES'       => ( $allowbbcode ) ? 'checked="checked"' : '',
        'ALWAYS_ALLOW_BBCODE_NO'        => ( !$allowbbcode ) ? 'checked="checked"' : '',
        'ALWAYS_ALLOW_HTML_YES'         => ( $allowhtml ) ? 'checked="checked"' : '',
        'ALWAYS_ALLOW_HTML_NO'          => ( !$allowhtml ) ? 'checked="checked"' : '',
        'ALWAYS_ALLOW_SMILIES_YES'      => ( $allowsmilies ) ? 'checked="checked"' : '',
        'ALWAYS_ALLOW_SMILIES_NO'       => ( !$allowsmilies ) ? 'checked="checked"' : '',
        'SHOW_AVATARS_YES'              => ( $showavatars ) ? 'checked="checked"' : '',
        'SHOW_AVATARS_NO'               => ( !$showavatars ) ? 'checked="checked"' : '',
        'SHOW_SIGNATURES_YES'           => ( $showsignatures ) ? 'checked="checked"' : '',
        'SHOW_SIGNATURES_NO'            => ( !$showsignatures ) ? 'checked="checked"' : '',
        'ALLOW_AVATAR'                  => $evoconfig['allow_avatar_upload'],
        'AVATAR'                        => $avatar_img,
        'AVATAR_SIZE'                   => $evoconfig['avatar_filesize'],
        'RANK_SELECT_BOX'               => $rank_select_box,
        'L_SELECT_RANK'                 => $lang['Rank_title'],
        'L_WORD_WRAP'                   => $lang['Word_Wrap'],
        'L_WORD_WRAP_EXPLAIN'           => $lang['Word_Wrap_Explain'],
        'L_WORD_WRAP_EXTRA'             => strtr($lang['Word_Wrap_Extra'],array('%min%' => $evoconfig['wrap_min'], '%max%' => $evoconfig['wrap_max'])),
        'L_BOARD_LANGUAGE'              => $lang['Board_lang'],
        'WRAP_ROW'                      => ( $mode == 'register' ) ? $evoconfig['wrap_def'] : $user_wordwrap,
        'LANGUAGE_SELECT'               => language_select($user_lang, 'profilelanguage'),
        'STYLE_SELECT'                  => GetThemeSelect('profilestyle', 'user_themes', false, '', $userwork['theme'], 0),
        'TIMEZONE_SELECT'               => tz_select($user_timezone, 'timezone'),
        'TIME_MODE'                     => $time_mode,
        'TIME_MODE_MANUAL_CHECKED'      => $time_mode_manual_checked,
        'TIME_MODE_MANUAL_DST_CHECKED'  => $time_mode_manual_dst_checked,
        'TIME_MODE_SERVER_SWITCH_CHECKED' => $time_mode_server_switch_checked,
        'TIME_MODE_FULL_SERVER_CHECKED' => $time_mode_full_server_checked,
        'TIME_MODE_SERVER_PC_CHECKED'   => $time_mode_server_pc_checked,
        'TIME_MODE_FULL_PC_CHECKED'     => $time_mode_full_pc_checked,
        'DST_TIME_LAG'                  => $dst_time_lag,
        'DATE_FORMAT'                   => $user_dateformat,
        'QUICK_REPLY_SELECT'            => quick_reply_select($user_show_quickreply, 'show_quickreply'),
        'QUICK_REPLY_MODE_BASIC'        => ( $user_quickreply_mode==0 ) ? 'checked="checked"' : '',
        'QUICK_REPLY_MODE_ADVANCED'     => ( $user_quickreply_mode!=0 ) ? 'checked="checked"' : '',
        'OPEN_QUICK_REPLY_YES'          => ( $user_open_quickreply ) ? 'checked="checked"' : '',
        'OPEN_QUICK_REPLY_NO'           => ( !$user_open_quickreply ) ? 'checked="checked"' : '',
        'RNAME'                         => $rname,
        'EXTRA_INFO'                    => $extra_info,
        'NEWSLETTER_NO'                 => ( $newsletter==0 ) ? 'checked="checked"' : '',
        'NEWSLETTER_YES'                => ( $newsletter==0 ) ? '' : 'checked="checked"',
        'HTML_STATUS'                   => $html_status,
        'BBCODE_STATUS'                 => sprintf($bbcode_status, '<a href="' . append_sid("faq.php?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
        'SMILIES_STATUS'                => $smilies_status,
        'L_CURRENT_PASSWORD'            => $lang['Current_password'],
        'L_NEW_PASSWORD'                => ( $mode == 'register' ) ? $lang['Password'] : $lang['New_password'],
        'L_CONFIRM_PASSWORD'            => $lang['Confirm_password'],
        'L_CONFIRM_PASSWORD_EXPLAIN'    => ( $mode == 'editprofile' ) ? $lang['Confirm_password_explain'] : '',
        'L_PASSWORD_IF_CHANGED'         => ( $mode == 'editprofile' ) ? $lang['password_if_changed'] : '',
        'L_PASSWORD_CONFIRM_IF_CHANGED' => ( $mode == 'editprofile' ) ? $lang['password_confirm_if_changed'] : '',
        'L_SUBMIT'                      => $lang['Submit'],
        'L_RESET'                       => $lang['Reset'],
        'L_ICQ_NUMBER'                  => $lang['ICQ'],
        'L_MESSENGER'                   => $lang['MSNM'],
        'L_YAHOO'                       => $lang['YIM'],
        'L_WEBSITE'                     => $lang['Website'],
        'L_AIM'                         => $lang['AIM'],
        'L_LOCATION'                    => $lang['Location'],
        'L_OCCUPATION'                  => $lang['Occupation'],
        //'L_BOARD_LANGUAGE'            => $lang['Board_lang'],
        'L_BOARD_STYLE'                 => $lang['Theme'],
        'L_TIMEZONE'                    => $lang['Timezone'],
        'L_TIME_MODE'                   => $lang['time_mode'],
        'L_TIME_MODE_TEXT'              => $lang['time_mode_text'],
        'L_TIME_MODE_MANUAL'            => $lang['time_mode_manual'],
        'L_TIME_MODE_DST'               => $lang['time_mode_dst'],
        'L_TIME_MODE_DST_OFF'           => $l_time_mode_0,
        'L_TIME_MODE_DST_ON'            => $l_time_mode_1,
        'L_TIME_MODE_DST_SERVER'        => $l_time_mode_2,
        'L_TIME_MODE_DST_TIME_LAG'      => $lang['time_mode_dst_time_lag'],
        'L_TIME_MODE_DST_MN'            => $lang['time_mode_dst_mn'],
        'L_TIME_MODE_TIMEZONE'          => $lang['time_mode_timezone'],
        'L_TIME_MODE_AUTO'              => $lang['time_mode_auto'],
        'L_TIME_MODE_FULL_SERVER'       => $l_time_mode_3,
        'L_TIME_MODE_SERVER_PC'         => $l_time_mode_4,
        'L_TIME_MODE_FULL_PC'           => $l_time_mode_6,
        'L_DATE_FORMAT'                 => $lang['Date_format'],
        'L_DATE_FORMAT_EXPLAIN'         => $lang['Date_format_explain'],
        'L_QUICK_REPLY_PANEL'           => $lang['Quick_reply_panel'],
        'L_SHOW_QUICK_REPLY'            => $lang['Show_quick_reply'],
        'L_QUICK_REPLY_MODE'            => $lang['Quick_reply_mode'],
        'L_QUICK_REPLY_MODE_BASIC'      => $lang['Quick_reply_mode_basic'],
        'L_QUICK_REPLY_MODE_ADVANCED'   => $lang['Quick_reply_mode_advanced'],
        'L_OPEN_QUICK_REPLY'            => $lang['Open_quick_reply'],
        'L_NAME'                        => $lang['Real_Name'],
        'L_USERNAME'                    => $lang['Username'],
        'L_NEWSLETTER'                  => $lang['Newsletter'],
        'L_EXTRA_INFO'                  => $lang['Extra_Info'],
        'L_YES'                         => $lang['Yes'],
        'L_NO'                          => $lang['No'],
        'L_INTERESTS'                   => $lang['Interests'],
        'L_ENABLE_MASS_PM'              => $lang['Enable_mass_pm'],
        'L_ENABLE_MASS_PM_EXPLAIN'      => $lang['Enable_mass_pm_explain'],
        'L_NO_MASS_PM'                  => $lang['No_mass_pm'],
        'L_ALWAYS_ALLOW_SMILIES'        => $lang['Always_smile'],
        'L_ALWAYS_ALLOW_BBCODE'         => $lang['Always_bbcode'],
        'L_ALWAYS_ALLOW_HTML'           => $lang['Always_html'],
        'L_HIDE_USER'                   => $lang['Hide_user'],
        'L_ALWAYS_ADD_SIGNATURE'        => $lang['Always_add_sig'],
        'L_SHOW_AVATARS'                => $lang['Show_avatars'],
        'L_SHOW_SIGNATURES'             => $lang['Show_signatures'],
        'L_AVATAR_PANEL'                => $lang['Avatar_panel'],
        'L_AVATAR_EXPLAIN'              => sprintf($lang['Avatar_explain'], $evoconfig['avatar_max_width'], $evoconfig['avatar_max_height'], (round($evoconfig['avatar_filesize'] / 1024))),
        'L_UPLOAD_AVATAR_FILE'          => $lang['Upload_Avatar_file'],
        'L_UPLOAD_AVATAR_URL'           => $lang['Upload_Avatar_URL'],
        'L_UPLOAD_AVATAR_URL_EXPLAIN'   => $lang['Upload_Avatar_URL_explain'],
        'L_AVATAR_GALLERY'              => $lang['Select_from_gallery'],
        'L_SHOW_GALLERY'                => $lang['View_avatar_gallery'],
        'L_LINK_REMOTE_AVATAR'          => $lang['Link_remote_Avatar'],
        'L_LINK_REMOTE_AVATAR_EXPLAIN'  => $lang['Link_remote_Avatar_explain'],
        'L_DELETE_AVATAR'               => $lang['Delete_Image'],
        'L_CURRENT_IMAGE'               => $lang['Current_Image'],
        'L_SIGNATURE'                   => $lang['Signature'],
        'L_SIGNATURE_EXPLAIN'           => sprintf($lang['Signature_explain'], $evoconfig['max_sig_chars']),
        'L_NOTIFY_ON_REPLY'             => $lang['Always_notify'],
        'L_NOTIFY_ON_REPLY_EXPLAIN'     => $lang['Always_notify_explain'],
        'L_NOTIFY_ON_PRIVMSG'           => $lang['Notify_on_privmsg'],
        'L_POPUP_ON_PRIVMSG'            => $lang['Popup_on_privmsg'],
        'L_POPUP_ON_PRIVMSG_EXPLAIN'    => $lang['Popup_on_privmsg_explain'],
        'L_PREFERENCES'                 => $lang['Preferences'],
        'L_PUBLIC_VIEW_EMAIL'           => $lang['Public_view_email'],
        'L_ITEMS_REQUIRED'              => $lang['Items_required'],
        'L_REGISTRATION_INFO'           => $lang['Registration_info'],
        'L_PROFILE_INFO'                => $lang['Profile_info'],
        'L_PROFILE_INFO_NOTICE'         => $lang['Profile_info_warn'],
        'L_EDIT_PROFILE_MENU_TITLE'     => $lang['Edit_Profile_Menu_title'],
        'L_EMAIL_ADDRESS'               => $lang['Email_address'],
        'L_CONFIRM_CODE_IMPAIRED'       => sprintf($lang['Confirm_code_impaired'], '<a href="mailto:' . $evoconfig['board_email'] . '">', '</a>'),
        'L_CONFIRM_CODE'                => $lang['Confirm_code'],
        'L_CONFIRM_CODE_EXPLAIN'        => $lang['Confirm_code_explain'],
        'S_ALLOW_AVATAR_UPLOAD'         => $evoconfig['allow_avatar_upload'],
        'S_ALLOW_AVATAR_LOCAL'          => $evoconfig['allow_avatar_local'],
        'S_ALLOW_AVATAR_REMOTE'         => $evoconfig['allow_avatar_remote'],
        'S_HIDDEN_FIELDS'               => $s_hidden_fields,
        'S_FORM_ENCTYPE'                => $form_enctype,
        'S_PROFILE_ACTION'              => (defined('IN_ADMIN_USERS') ? admin_sid('admin_users') : append_sid('profile.php'))
        )
    );

    //
    // This is another cheat using the block_var capability
    // of the templates to 'fake' an IF...ELSE...ENDIF solution
    // it works well :)
    //
    if ( $mode != 'register' ) {
        if ( $userwork['user_allowavatar'] && ( $evoconfig['allow_avatar_upload'] || $evoconfig['allow_avatar_local'] || $evoconfig['allow_avatar_remote'] ) ) {
            $template->assign_block_vars('switch_avatar_block', array() );
            if ( $evoconfig['allow_avatar_upload'] && @file_exists(@phpbb_realpath('./' . $evoconfig['avatar_path'])) ) {
                if ( !empty($form_enctype) ) {
                    $template->assign_block_vars('switch_avatar_block.switch_avatar_local_upload', array() );
                }
                $template->assign_block_vars('switch_avatar_block.switch_avatar_remote_upload', array() );
            }
            if ( $evoconfig['allow_avatar_remote'] ) {
                $template->assign_block_vars('switch_avatar_block.switch_avatar_remote_link', array() );
            }
            if ( $evoconfig['allow_avatar_local'] && @file_exists(@phpbb_realpath('./' . $evoconfig['avatar_gallery_path'])) ) {
                $template->assign_block_vars('switch_avatar_block.switch_avatar_local_gallery', array() );
            }
        }
    }
}

$template->pparse('body');
if ( defined('IN_ADMIN_USERS') ) {
    include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
} else {
    include_once(NUKE_INCLUDE_DIR . 'page_tail.php');
}

?>