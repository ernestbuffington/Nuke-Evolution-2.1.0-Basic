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

global $_GETVAR;

$submit         = $_GETVAR->get('submit', '_POST');

if ( isset($submit) ) {
    $username   = $_GETVAR->get('username', '_POST');
    $email      = $_GETVAR->get('email', '_POST');
    $username   = ( !empty($username) ) ? phpbb_clean_username($username) : '';
    $email      = ( !empty($email) ) ? trim(strip_tags(htmlspecialchars($email))) : '';
    $sql = "SELECT user_id, username, user_email, user_active, user_lang
                FROM " . USERS_TABLE . "
                WHERE user_email = '" . str_replace("\'", "''", $email) . "'
                AND username = '" . str_replace("\'", "''", $username) . "'";
    if ( $result = $db->sql_query($sql) ) {
        if ( $row = $db->sql_fetchrow($result) ) {
            if ( !$row['user_active'] ) {
                message_die(GENERAL_MESSAGE, $lang['No_send_account_inactive']);
            }

            $username       = $row['username'];
            $user_id        = $row['user_id'];
            $user_email     = $row['user_email'];
            $user_lang      = $row['user_lang'];
            $user_actkey    = gen_rand_string(true);
            $key_len        = 54 - strlen($server_url);
            $key_len        = ($key_len > 6) ? $key_len : 6;
            $user_actkey    = substr($user_actkey, 0, $key_len);
            $user_password  = gen_rand_string(false);
            $sql = "UPDATE " . USERS_TABLE . "
                    SET user_newpasswd = '" . EvoCrypt($user_password) . "', user_actkey = '$user_actkey'
                    WHERE user_id = " . $row['user_id'];
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update new password information', '', __LINE__, __FILE__, $sql);
            }
            $langemail = array();
            $thislang  = ((isset($user_lang) && !empty($user_lang))? $user_lang : strtolower($board_config['default_lang']));
            if (!isset($langemail[$thislang])) {
                if (is_file(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/user_activate_passwd.php')) {
                    @include_once(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/user_activate_passwd.php');
                } else {
                    @include_once(NUKE_FORUMS_DIR.'language/lang_english/email/user_activate_passwd.php');
                }
            }
            $email_to       = array();
            $email_to[$username] = $user_email;
            $recipients     = evo_mail_batch($email_to);
            $subject        = $langemail['german']['EmailSubject'];
            $email_message  = $langemail[$thislang]['Hello'].'&nbsp;'.$username.',<br /><br />';
            $email_message .= $langemail[$thislang]['Part1'].'<br />';
            $email_message .= '<a href="http://'.EVO_SERVER_URL . '&amp;mode=activate&amp;'.POST_USERS_URL.'='.$user_id.'&amp;act_key='.$user_actkey.'">'.$langemail['english']['ActivationLink'].'</a><br /><br />';
            $email_message .= $langemail[$thislang]['Part2'].'<br /><br />';
            $email_message .= $langemail['english']['Password'].':&nbsp;'.$user_password.'<br /><br />';
            $email_message .= $langemail['english']['Part3'].'<br /><br />';
            $email_message .= $board_config['board_email_sig'];
            $mailsend       = evo_mail($recipients, $subject, $email_message, '', '', TRUE);
            $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="15;url=' . append_sid("index.php") . '" />')
            );
            if (empty($mailsend['error'])) {
                $message = $lang['Password_updated'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.php") . '">', '</a>');
            } else {
                $message = $lang['Error'].':<br />'.$mailsend['error'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.php") . '">', '</a>');
            }
            message_die(GENERAL_MESSAGE, $message);
        } else {
            message_die(GENERAL_MESSAGE, $lang['No_email_match']);
        }
    } else {
        message_die(GENERAL_ERROR, 'Could not obtain user information for sendpassword', '', __LINE__, __FILE__, $sql);
    }
} else {
    $username = '';
    $email    = '';
}

//
// Output basic page
//
include(NUKE_INCLUDE_DIR . 'page_header.php');

$template->set_filenames(array(
    'body' => 'profile_send_pass.tpl')
);
make_jumpbox('viewforum.php');

$template->assign_vars(array(
    'USERNAME'          => $username,
    'EMAIL'             => $email,
    'L_SEND_PASSWORD'   => $lang['Send_password'],
    'L_ITEMS_REQUIRED'  => $lang['Items_required'],
    'L_EMAIL_ADDRESS'   => $lang['Email_address'],
    'L_SUBMIT'          => $lang['Submit'],
    'L_RESET'           => $lang['Reset'],
    'S_HIDDEN_FIELDS'   => '',
    'S_PROFILE_ACTION'  => append_sid('profile.php?mode=sendpassword'))
);

$template->pparse('body');
include(NUKE_INCLUDE_DIR . 'page_tail.php');

?>