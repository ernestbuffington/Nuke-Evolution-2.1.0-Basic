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

$sql = "SELECT user_active, user_id, username, user_email, user_newpasswd, user_lang, user_actkey
        FROM " . USERS_TABLE . "
        WHERE user_id = " . intval($HTTP_GET_VARS[POST_USERS_URL]);
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not obtain user information', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) ) {
    if ( $row['user_active'] && empty($row['user_actkey']) ) {
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="10;url=' . append_sid("index.php") . '" />')
        );
        message_die(GENERAL_MESSAGE, $lang['Already_activated']);
    } else if ( (trim($row['user_actkey']) == trim($HTTP_GET_VARS['act_key'])) && (!empty($row['user_actkey'])) ) {
        if (intval($board_config['require_activation']) == USER_ACTIVATION_ADMIN && $row['user_newpasswd'] == '') {
            if (!is_user()) {
                redirect(append_sid('login.php?redirect=profile.php&amp;mode=activate&amp;' . POST_USERS_URL . '=' . $row['user_id'] . '&amp;act_key=' . trim($HTTP_GET_VARS['act_key'])));
            } else if (!is_admin() ) {
                message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
            }
        }
        $sql_update_pass = ( !empty($row['user_newpasswd']) ) ? ", user_password = '" . str_replace("\'", "''", $row['user_newpasswd']) . "', user_newpasswd = ''" : '';
        $sql = "UPDATE " . USERS_TABLE . "
                SET user_active = 1, user_actkey = ''" . $sql_update_pass . "
                WHERE user_id = " . $row['user_id'];
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql_update);
        }

        if ( intval($board_config['require_activation']) == USER_ACTIVATION_ADMIN && empty($sql_update_pass) ) {
            $langemail = array();
            $thislang  = ((isset($row['user_lang']) && !empty($row['user_lang']))? $row['user_lang'] : strtolower($board_config['default_lang']));
            if (!isset($langemail[$thislang])) {
                if (is_file(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/admin_welcome_activated.php')) {
                    @include_once(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/admin_welcome_activated.php');
                } else {
                    @include_once(NUKE_FORUMS_DIR.'language/lang_english/email/admin_welcome_activated.php');
                }
            }
            $email_to       = array();
            $email_to[$row['username']] = $row['user_email'];
            $recipients     = evo_mail_batch($email_to);
            $subject        = $langemail[$thislang]['EmailSubject'];
            $email_message  = $langemail[$thislang]['Hello'].'&nbsp;'.$username.',<br /><br />';
            $email_message .= $langemail[$thislang]['Part1'].'<br /><br />';
            $email_message .= $board_config['board_email_sig'];
            $mailsend       = evo_mail($recipients, $subject, $email_message, '', '', TRUE);
            $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="10;url=' . append_sid("index.php") . '" />')
            );
            if (empty($mailsend['error'])) {
                $message = $lang['Account_active_admin'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.php") . '">', '</a>');
            } else {
                $message = $lang['Error'].':<br />'.$mailsend['error'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.php") . '">', '</a>');
            }
            message_die(GENERAL_MESSAGE, $message);
        } else {
            $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="10;url=' . append_sid("index.php") . '" />')
            );
            $message = ( $sql_update_pass == '' ) ? $lang['Account_active'] : $lang['Password_activated'];
            message_die(GENERAL_MESSAGE, $message);
        }
    } else {
        message_die(GENERAL_MESSAGE, $lang['Wrong_activation']);
    }
    $db->sql_freeresult($result);
} else {
    message_die(GENERAL_MESSAGE, $lang['No_such_user']);
}

?>