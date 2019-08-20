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

global $_GETVAR, $userdata;

$user_id    = ($_GETVAR->get('user_id', '_REQUEST', 'int') ? $_GETVAR->get('user_id', '_REQUEST', 'int') : $_GETVAR->get(POST_USERS_URL, '_REQUEST', 'int'));
$submit     = $_GETVAR->get('submit','_POST', 'string', '');
$subject    = $_GETVAR->get('subject', '_POST', 'string', '');
$message    = $_GETVAR->get('message', '_POST', 'string', '');
$sendcopy   = $_GETVAR->get('cc_email', '_POST', 'int', 0);

// Is send through board enabled? No, return to index
if (!$board_config['board_email_form']) {
    redirect(append_sid('index.php', true));
    exit;
}

if ( empty($user_id) ) {
    message_die(GENERAL_MESSAGE, $lang['No_user_specified']);
}

if ( !is_user() ) {
    redirect( append_sid('login.php?redirect=profile.php&amp;mode=email&amp;' . POST_USERS_URL . '=' . $user_id, true));
}

$sql = "SELECT username, user_email, user_viewemail, user_lang
        FROM " . USERS_TABLE . "
        WHERE user_id = '".$user_id."'";
if ( $result = $db->sql_query($sql) ) {
    if ( $row = $db->sql_fetchrow($result) ) {
        $db->sql_freeresult($result);
        $username   = $row['username'];
        $user_email = $row['user_email'];
        $user_lang  = $row['user_lang'];
        if ( $row['user_viewemail'] || is_admin() ) {
            if ( time() - $userdata['user_emailtime'] < $board_config['flood_interval'] ) {
                message_die(GENERAL_MESSAGE, $lang['Flood_email_limit']);
            }
            if ( !empty($submit) ) {
                $error = FALSE;
                if ( !empty($subject) ) {
                    $subject = trim(stripslashes($subject));
                } else {
                    $error = TRUE;
                    $error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Empty_subject_email'] : $lang['Empty_subject_email'];
                }
                if ( !empty($message) ) {
                    $message = trim(stripslashes($message));
                } else {
                    $error = TRUE;
                    $error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Empty_message_email'] : $lang['Empty_message_email'];
                }
                if ( !$error ) {
                    $sql = "UPDATE " . USERS_TABLE . "
                            SET user_emailtime = " . time() . "
                            WHERE user_id = " . $userdata['user_id'];
                    if ( $result = $db->sql_query($sql) ) {
                        $db->sql_freeresult($result);
                        $langemail = array();
                        $thislang  = ((isset($user_lang) && !empty($user_lang))? $user_lang : strtolower($board_config['default_lang']));
                        if (!isset($langemail[$thislang])) {
                            if (is_file(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/profile_send_email.php')) {
                                @include_once(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/profile_send_email.php');
                            } else {
                                @include_once(NUKE_FORUMS_DIR.'language/lang_english/email/profile_send_email.php');
                            }
                        }
                        $email_to       = array();
                        $email_to[$username] = $user_email;
                        if ($userdata['username'] == $username) {
                            $email_from = $board_config['board_email'];
                        } else {
                            $email_from = $userdata['user_email'].','.$userdata['username'];
                        }
                        if ( $sendcopy ) {
                            $email_to[$userdata['username']] = $userdata['user_email'];
                        }
                        $recipients     = evo_mail_batch($email_to);
                        $email_message  = $langemail[$thislang]['Hello'].'&nbsp;'.$username.',<br /><br />';
                        $email_message .= $langemail[$thislang]['Part1'].':&nbsp;'.$userdata['username'].'<br />';
                        $email_message .= $langemail[$thislang]['Part2'].':<br />';
                        $email_message .= 'mailto:&nbsp;'.$board_config['board_email'].'<br /><br />';
                        $email_message .= $langemail[$thislang]['Part3'].'<br /><br />';
                        $email_message .= $langemail[$thislang]['MessageContent'].'<br />';
                        $email_message .= '+++++++++++++++++++++++++++++++++++++++++<br /><br />';
                        $email_message .= $message.'<br /><br />';
                        $email_message .= $board_config['board_email_sig'];
                        $mailsend       = evo_mail($recipients, $subject, $email_message, $email_from, '', TRUE);
                        $template->assign_vars(array(
                            'META' => '<meta http-equiv="refresh" content="5;url=' . append_sid("index.php") . '" />')
                        );
                        if (empty($mailsend['error'])) {
                            $message = $lang['Email_sent'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.php") . '">', '</a>');
                        } else {
                            $message = $lang['Error'].':<br />'.$mailsend['error'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.php") . '">', '</a>');
                        }
                        message_die(GENERAL_MESSAGE, $message);
                    } else {
                        message_die(GENERAL_ERROR, 'Could not update last email time', '', __LINE__, __FILE__, $sql);
                    }
                }
            } else {
                include(NUKE_INCLUDE_DIR . 'page_header.php');
                $template->set_filenames(array(
                    'body' => 'profile_send_email.tpl')
                );
                make_jumpbox('viewforum.php');
                if ( $error ) {
                    $template->set_filenames(array(
                        'reg_header' => 'error_body.tpl')
                    );
                    $template->assign_vars(array(
                        'ERROR_MESSAGE' => $error_msg)
                    );
                    $template->assign_var_from_handle('ERROR_BOX', 'reg_header');
                }
                $template->assign_vars(array(
                    'USERNAME'              => $username,
                    'S_HIDDEN_FIELDS'       => '',
                    'S_POST_ACTION'         => append_sid('profile.php?mode=email&amp;' . POST_USERS_URL . '=' . $user_id),
                    'L_SEND_EMAIL_MSG'      => $lang['Send_email_msg'],
                    'L_RECIPIENT'           => $lang['Recipient'],
                    'L_SUBJECT'             => $lang['Subject'],
                    'L_MESSAGE_BODY'        => $lang['Message_body'],
                    'L_MESSAGE_BODY_DESC'   => $lang['Email_message_desc'],
                    'L_EMPTY_SUBJECT_EMAIL' => $lang['Empty_subject_email'],
                    'L_EMPTY_MESSAGE_EMAIL' => $lang['Empty_message_email'],
                    'L_OPTIONS'             => $lang['Options'],
                    'L_CC_EMAIL'            => $lang['CC_email'],
                    'L_SPELLCHECK'          => $lang['Spellcheck'],
                    'L_SEND_EMAIL'          => $lang['Send_email'])
                );
                $template->pparse('body');
                include(NUKE_INCLUDE_DIR . 'page_tail.php');
            }
        } else {
            message_die(GENERAL_MESSAGE, $lang['User_prevent_email']);
        }
    } else {
        message_die(GENERAL_MESSAGE, $lang['User_not_exist']);
    }
} else {
    message_die(GENERAL_ERROR, 'Could not select user data', '', __LINE__, __FILE__, $sql);
}

?>