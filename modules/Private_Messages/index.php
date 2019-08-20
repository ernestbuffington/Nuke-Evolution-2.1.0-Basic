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
   die('You can\'t access this file directly...');
}

global $_GETVAR, $evoconfig, $board_config, $userinfo, $currentlang, $suppress, $name, $db;
// We do not want to have PM-Popup's while in Private Messages

$suppress    = (($_GETVAR->get('suppress', '_REQUEST', 'int', 0) == 0 ) ? 0 : 1);
$privmsgs_id = $_GETVAR->get(POST_POST_URL, '_REQUEST', 'int', 0);
$pm_uname    = $_GETVAR->get('pm_uname', '_REQUEST', 'string', '');
$mode        = $_GETVAR->get('mode', '_REQUEST', 'string', '');
$name        = $_GETVAR->get('name', '_REQUEST', 'string', '');
$popup       = $_GETVAR->get('popup', '_REQUEST', 'int', 0);
$user_id     = $_GETVAR->get(POST_USERS_URL, '_GET', 'int', 0);
$privmsg_message = '';
$privmsg_subject = '';

if ($suppress) {
    $mode  = '';
    $popup = 0;
}
if (!empty($pm_uname)) {
    $u = get_user_field('user_id', $pm_uname, TRUE);
    redirect('modules.php?name=Private_Messages&amp;mode=post&amp;u='.$u);
    exit;
}

$mod_name  = str_replace('_', ' ', $name);

if (!(isset($popup)) || ($popup != '1')) {
    require(NUKE_FORUMS_DIR.'nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
    $nuke_file_path = 'modules.php?name=Forums&amp;file=';
}
define('IN_PHPBB', true);
include($phpbb_root_path . 'common.php');
include(NUKE_INCLUDE_DIR.'bbcode.php');
include(NUKE_INCLUDE_DIR.'functions_post.php');
$module_name = basename(dirname(__FILE__));
$title_name  = $module_name;
$logo_name = 'private_messages-logo.png';
//
// Is PM disabled?
//
if ( ($board_config['privmsg_disable']) ) {
    message_die(GENERAL_MESSAGE, 'PM_disabled');
}

$html_entities_match = array('#&(?!(\#[0-9]+;))#', '#<#', '#>#', '#"#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;', '&quot;');

//
// Parameters
//
$folder             = $_GETVAR->get('folder', '_REQUEST', 'string', 'input');
$group_id           = $_GETVAR->get(POST_GROUPS_URL, '_REQUEST', 'int', 0);
$submit             = $_GETVAR->get('post', '_POST', 'string', '');
$submit_search      = $_GETVAR->get('usersubmit', '_POST');
$submit_msgdays     = $_GETVAR->get('submit_msgdays', '_POST');
$cancel             = $_GETVAR->get('cancel', '_POST');
$preview            = $_GETVAR->get('preview', '_POST');
$confirm            = $_GETVAR->get('confirm', '_POST');
$delete             = $_GETVAR->get('delete', '_POST');
$delete_all         = $_GETVAR->get('deleteall', '_POST');
$save               = $_GETVAR->get('save', '_POST');
$sid                = $_GETVAR->get('sid', '_POST', 'int', 0);
$start              = $_GETVAR->get('start', '_GET', 'int', 0);
$start              = ($start < 0) ? 0 : $start;
$welcome_pm         = $_GETVAR->get('w_pm', '_POST');
$mark_list          = $_GETVAR->get('mark', '_POST', 'array', array());

$subject            = $_GETVAR->get('subject', '_POST');
$message            = $_GETVAR->get('message', '_POST');
$username           = $_GETVAR->get('username', '_POST');
$msgdays            = $_GETVAR->get('msgdays', '_REQUEST', 'int');
$disable_html       = $_GETVAR->get('disable_html', '_POST');
$disable_bbcode     = $_GETVAR->get('disable_bbcode', '_POST');
$disable_smilies    = $_GETVAR->get('disable_smilies', '_POST');
$attach_sig         = $_GETVAR->get('attach_sig', '_POST');

$error = FALSE;

$refresh = $preview || $submit_search;

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_PRIVMSGS);
init_userprefs($userdata);
//
// End session management
//
if ( $mode == 'masspm' ) {
    $lang_file = '/lang_mass_pm.php';
    if (@file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
        include_once($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
    } elseif (@file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
        include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file);
    } else {
        die('Neither your selected nor the board-default language-file could be found');
    }
}

switch ($folder) {
    case 'inbox':   $page_title = $lang['Inbox']; break;
    case 'outbox':  $page_title = $lang['Outbox']; break;
    case 'sentbox': $page_title = $lang['Sentbox']; break;
    case 'savebox': $page_title = $lang['Savebox']; break;
    default:        $folder = 'inbox'; $page_title = $lang['Inbox']; break;
}

if ( !empty($group_id) ) {
    if( $group_id != 'users' && $group_id != 'admins' && $group_id != 'moderators' ) {
        $sql = "SELECT DISTINCT g.group_name
                FROM (".GROUPS_TABLE . " g, ".USER_GROUP_TABLE . " ug)
                WHERE g.group_single_user <> 1 AND g.group_id='".$group_id."'
                AND (
                        ('".$userdata['user_level']."'='".ADMIN."') OR
                        (g.group_allow_pm='".AUTH_MOD."' AND g.group_moderator = '" . $userdata['user_id']."') OR
                        (g.group_allow_pm='".AUTH_ACL."' AND ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ) OR
                        (g.group_allow_pm='".AUTH_REG."' AND '".$userdata['user_id']."'!='".ANONYMOUS."' ) OR
                        (g.group_allow_pm='".AUTH_ALL."')
                )" ;
        $result = $db->sql_query($sql);
        if( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, "Could not select group name!", __LINE__, __FILE__, $sql);
        }
        if( ! $db->sql_numrows($result)) {
            message_die(GENERAL_ERROR, $lang['Not_Authorised']);
        }
        $group = $db->sql_fetchrow($result);
        $group_name=$group['group_name'];
        $sql = "SELECT distinct u.user_id, u.user_lang, u.user_email, u.username, u.user_notify_pm,u.user_active,u.user_allow_mass_pm
                FROM (" . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug)
                WHERE u.user_allow_mass_pm > 1 AND ug.group_id = $group_id
                AND ug.user_pending <> " . TRUE . "
                AND u.user_id <> " . ANONYMOUS . "
                AND u.user_level <> -1
                AND u.user_active = 1
                AND u.user_id = ug.user_id
                ORDER BY u.user_lang";
    } elseif ($group_id == 'users') {
        if( !is_admin() ) {
            message_die(GENERAL_ERROR, $lang['Not_Authorised']);
        }
        $sql = "SELECT distinct user_id, user_lang, user_email, username, user_notify_pm,user_active,user_allow_mass_pm
                FROM " . USERS_TABLE."
                WHERE user_allow_mass_pm > 1
                AND user_id <> " . ANONYMOUS."
                AND user_level <> -1
                AND user_active = 1
                ORDER BY user_lang";
        $group_name=$lang['All_users'];
    } elseif ($group_id == 'admins') {
        if( !is_admin() ) {
            message_die(GENERAL_ERROR, $lang['Not_Authorised']);
        }
        $sql = "SELECT distinct user_id, user_lang, user_email, username, user_notify_pm,user_active,user_allow_mass_pm
                FROM " . USERS_TABLE."
                WHERE user_allow_mass_pm > 1
                AND user_level = '2'
                AND user_active = 1
                ORDER BY user_lang";
        $group_name=$lang['All_admins'];
    } elseif ($group_id == 'moderators') {
        if( !is_admin() ) {
            message_die(GENERAL_ERROR, $lang['Not_Authorised']);
        }
        $sql = "SELECT distinct user_id, user_lang, user_email, username, user_notify_pm,user_active,user_allow_mass_pm
                FROM " . USERS_TABLE."
                WHERE user_allow_mass_pm > 1
                AND user_level = '3'
                AND user_active = 1
                ORDER BY user_lang";
        $group_name=$lang['All_mods'];
    }
    if( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Coult not select group members!", __LINE__, __FILE__, $sql);
    }
    if( ! $db->sql_numrows($result)) {
        $pm_list = $db->sql_fetchrowset($result);
        //
        // Output a relevant GENERAL_MESSAGE about users/group
        // not existing
        //
        $error = TRUE;
        $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_to_user'];
    }
    $PM_list = $db->sql_fetchrowset($result);
    $PM_count= $db->sql_numrows($result);
}

if(!empty($welcome_pm) && !empty($submit)) {
    if(empty($subject)) {
        message_die(GENERAL_ERROR,$lang['Welcome_PM_Subject']);
    }
    if($db->sql_numrows($db->sql_query("SELECT * FROM "._WELCOME_PM_TABLE)) != 0) {
        $sql_w_pm = "UPDATE "._WELCOME_PM_TABLE." SET subject='".$subject."', msg='".$message."'";
    } else {
        $sql_w_pm = "INSERT INTO "._WELCOME_PM_TABLE." (`subject`, `msg`) VALUES('".$subject."', '".$message."')";
    }
    $db->sql_query($sql_w_pm );
    $msg = $lang['Welcome_PM_Set'] . '<br /><br />' . sprintf($lang['Click_return_inbox'], '<a href="' . append_sid("privmsg.php?folder=inbox") . '">', '</a> ') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
    message_die(GENERAL_MESSAGE, $msg);
}

$pm_allow_threshold = isset($board_config['pm_allow_threshold']) ? $board_config['pm_allow_threshold'] : 1;
if ( ($userdata['user_posts'] < $pm_allow_threshold) && !is_admin())
{
    message_die(GENERAL_MESSAGE, 'Not_Authorised');
}
if(!$userdata['session_logged_in']) {
    redirect('modules.php?name=Your_Account&amp;redirect=privmsg&amp;folder=inbox');
    exit;
}

//
// Cancel
//
if ( $cancel ) {
    redirect(append_sid('privmsg.php?folder='.$folder, true));
    exit;
}


//
// Define the box image links
//
$inbox_img      = '<a href="' . append_sid("privmsg.php?folder=inbox") . '"><img src="' . $images['pm_inbox'] . '" border="0" alt="' . $lang['Inbox'] . '" /></a>';
$inbox_url      = '<a href="' . append_sid("privmsg.php?folder=inbox") . '">' . $lang['Inbox'] . '</a>';
$outbox_img     = '<a href="' . append_sid("privmsg.php?folder=outbox") . '"><img src="' . $images['pm_outbox'] . '" border="0" alt="' . $lang['Outbox'] . '" /></a>';
$outbox_url     = '<a href="' . append_sid("privmsg.php?folder=outbox") . '">' . $lang['Outbox'] . '</a>';
$sentbox_img    = '<a href="' . append_sid("privmsg.php?folder=sentbox") . '"><img src="' . $images['pm_sentbox'] . '" border="0" alt="' . $lang['Sentbox'] . '" /></a>';
$sentbox_url    = '<a href="' . append_sid("privmsg.php?folder=sentbox") . '">' . $lang['Sentbox'] . '</a>';
$savebox_img    = '<a href="' . append_sid("privmsg.php?folder=savebox") . '"><img src="' . $images['pm_savebox'] . '" border="0" alt="' . $lang['Savebox'] . '" /></a>';
$savebox_url    = '<a href="' . append_sid("privmsg.php?folder=savebox") . '">' . $lang['Savebox'] . '</a>';

if (empty($mode)) {
    switch ( $folder ) {
        case ('inbox'):
            $inbox_img      = '<img src="' . $images['pm_inbox'] . '" border="0" alt="' . $lang['Inbox'] . '" />';
            $inbox_url      = $lang['Inbox'];
            break;
        case ('outbox'):
            $outbox_img     = '<img src="' . $images['pm_outbox'] . '" border="0" alt="' . $lang['Outbox'] . '" />';
            $outbox_url     = $lang['Outbox'];
            break;
        case ('sentbox'):
            $sentbox_img    = '<img src="' . $images['pm_sentbox'] . '" border="0" alt="' . $lang['Sentbox'] . '" />';
            $sentbox_url    = $lang['Sentbox'];
            break;
        case ('savebox'):
            $savebox_img    = '<img src="' . $images['pm_savebox'] . '" border="0" alt="' . $lang['Savebox'] . '" />';
            $savebox_url    = $lang['Savebox'];
            break;
    }
}
execute_privmsgs_attachment_handling($mode);

// ----------
// Start main
//
if ( $mode == 'newpm' && !$suppress ) {
    $gen_simple_header = TRUE;
    include_once(NUKE_INCLUDE_DIR.'page_header_review.php');
    $template->set_filenames(array(
            'body' => 'privmsgs_popup.tpl')
    );
    if ( is_user() ) {
        $have_priv_mess = check_priv_mess($userdata['user_id']);
        if ( $have_priv_mess > 0 ) {
            $l_new_message = ( $have_priv_mess == 1 ) ? $lang['You_new_pm'] : $lang['You_new_pms'];
            $l_message_text_unread = sprintf($l_new_message, $have_priv_mess);
        } else {
            $l_message_text_unread = $lang['No_unread_pm'];
        }
        $l_message_text_unread .= '<br /><br />' . sprintf($lang['Click_view_privmsg'], '<a href="' . append_sid("privmsg.php?folder=inbox") . '" onclick="jump_to_inbox();return false;">', '</a>');
    } else {
        $l_new_message = $lang['Login_check_pm'];
        $l_message_text_unread = '';
    }
    $template->assign_vars(array(
        'U_PRIVATEMSGS'  => append_sid("privmsg.php?folder=inbox"),
        'L_CLOSE_WINDOW' => $lang['Close_window'],
        'L_MESSAGE'      => $l_message_text_unread)
    );
    $template->pparse('body');
    include(NUKE_INCLUDE_DIR.'page_tail_review.php');
    exit;
} elseif ( $mode == 'read' ) {
    if ( !isset($privmsgs_id) ) {
        message_die(GENERAL_ERROR, $lang['No_post_id']);
    }
    if ( !$userdata['session_logged_in'] ) {
        redirect('modules.php?name=Your_Account&amp;redirect=privmsg&amp;folder='.$folder.'&amp;mode='.$mode.'&amp;' . POST_POST_URL . '='.$privmsgs_id);
        exit;
    }
    //
    // SQL to pull appropriate message, prevents nosey people
    // reading other peoples messages ... hopefully!
    //
    switch( $folder ) {
        case 'inbox':
            $l_box_name = $lang['Inbox'];
            $pm_sql_user = "AND pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                            AND ( pm.privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                            OR pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                            OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
            break;
        case 'outbox':
            $l_box_name = $lang['Outbox'];
            $pm_sql_user = "AND pm.privmsgs_from_userid =  " . $userdata['user_id'] . "
                            AND ( pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                            OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) ";
            break;
        case 'sentbox':
            $l_box_name = $lang['Sentbox'];
            $pm_sql_user = "AND pm.privmsgs_from_userid =  " . $userdata['user_id'] . "
                            AND pm.privmsgs_type = " . PRIVMSGS_SENT_MAIL;
            break;
        case 'savebox':
            $l_box_name = $lang['Savebox'];
            $pm_sql_user = "AND ( ( pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                            AND pm.privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                            OR ( pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                            AND pm.privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " )
                            )";
            break;
        default:
            message_die(GENERAL_ERROR, $lang['No_such_folder']);
            break;
    }

    //
    // Major query obtains the message ...
    //
    $sql = "SELECT u.username AS username_1, u.user_id AS user_id_1, u2.username AS username_2, u2.user_id AS user_id_2, u.user_sig_bbcode_uid, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_avatar, u.user_allow_viewonline AS user_allow_viewonline_1, u2.user_allow_viewonline AS user_allow_viewonline_2, u.user_session_time AS user_session_time_1, u2.user_session_time AS user_session_time_2, pm.*, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text
            FROM " . PRIVMSGS_TABLE . " pm, " . PRIVMSGS_TEXT_TABLE . " pmt, " . USERS_TABLE . " u, " . USERS_TABLE . " u2
            WHERE pm.privmsgs_id = '$privmsgs_id'
            AND pmt.privmsgs_text_id = pm.privmsgs_id
            $pm_sql_user
            AND u.user_id = pm.privmsgs_from_userid
            AND u2.user_id = pm.privmsgs_to_userid";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not query private message post information', '', __LINE__, __FILE__, $sql);
    }

    //
    // Did the query return any data?
    //
    if ( !($privmsg = $db->sql_fetchrow($result)) ) {
        redirect(append_sid('privmsg.php?folder='.$folder, true));
        exit;
    }
    $db->sql_freeresult($result);
    $privmsg_id = $privmsg['privmsgs_id'];

    //
    // Is this a new message in the inbox? If it is then save
    // a copy in the posters sent box
    //
    if (($privmsg['privmsgs_type'] == PRIVMSGS_NEW_MAIL || $privmsg['privmsgs_type'] == PRIVMSGS_UNREAD_MAIL) && $folder == 'inbox') {
        // Update appropriate counter
        switch ($privmsg['privmsgs_type']) {
            case PRIVMSGS_NEW_MAIL:
                $sql = "user_new_privmsg = user_new_privmsg - 1";
                break;
            case PRIVMSGS_UNREAD_MAIL:
                $sql = "user_unread_privmsg = user_unread_privmsg - 1";
                break;
        }
        $sql = "UPDATE " . USERS_TABLE . "
                SET $sql
                WHERE user_id = " . $userdata['user_id'];
        if ( !$db->sql_uquery($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update private message read status for user', '', __LINE__, __FILE__, $sql);
        }
        $sql = "UPDATE " . PRIVMSGS_TABLE . "
                SET privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                WHERE privmsgs_id = " . $privmsg['privmsgs_id'];
        if ( !$db->sql_uquery($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update private message read status', '', __LINE__, __FILE__, $sql);
        }
        // Check to see if the poster has a 'full' sent box
        $sql = "SELECT COUNT(privmsgs_id) AS sent_items, MIN(privmsgs_date) AS oldest_post_time
                FROM " . PRIVMSGS_TABLE . "
                WHERE privmsgs_type = " . PRIVMSGS_SENT_MAIL . "
                        AND privmsgs_from_userid = " . $privmsg['privmsgs_from_userid'];
        if ( !($result3 = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain sent message info for sendee', '', __LINE__, __FILE__, $sql);
        }
        $sql_priority = ( SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') ? 'LOW_PRIORITY' : '';
        if ( $sent_info = $db->sql_fetchrow($result3) ) {
            if ($board_config['max_sentbox_privmsgs'] && $sent_info['sent_items'] >= $board_config['max_sentbox_privmsgs']) {
                $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_type = " . PRIVMSGS_SENT_MAIL . "
                        AND privmsgs_date = " . $sent_info['oldest_post_time'] . "
                        AND privmsgs_from_userid = " . $privmsg['privmsgs_from_userid'];
                if ( !$result1 = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not find oldest privmsgs', '', __LINE__, __FILE__, $sql);
                }
                $old_privmsgs_id = $db->sql_fetchrow($result1);
                $old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
                $db->sql_freeresult($result1);
                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_id = '$old_privmsgs_id'";
                if ( !$db->sql_uquery($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (sent)', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . "
                        WHERE privmsgs_text_id = '$old_privmsgs_id'";
                if ( !$db->sql_uquery($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (sent)', '', __LINE__, __FILE__, $sql);
                }
            }
        }
        $db->sql_freeresult($result3);
        //
        // This makes a copy of the post and stores it as a SENT message from the sendee. Perhaps
        // not the most DB friendly way but a lot easier to manage, besides the admin will be able to
        // set limits on numbers of storable posts for users ... hopefully!
        //
        $sql = "INSERT $sql_priority INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
                VALUES (" . PRIVMSGS_SENT_MAIL . ", '" . str_replace("\'", "''", addslashes($privmsg['privmsgs_subject'])) . "', " . $privmsg['privmsgs_from_userid'] . ", " . $privmsg['privmsgs_to_userid'] . ", " . $privmsg['privmsgs_date'] . ", '" . $privmsg['privmsgs_ip'] . "', " . $privmsg['privmsgs_enable_html'] . ", " . $privmsg['privmsgs_enable_bbcode'] . ", " . $privmsg['privmsgs_enable_smilies'] . ", " .  $privmsg['privmsgs_attach_sig'] . ")";
        if ( !$db->sql_uquery($sql) ) {
            message_die(GENERAL_ERROR, 'Could not insert private message sent info', '', __LINE__, __FILE__, $sql);
        }
        $privmsg_sent_id = $db->sql_nextid();
        $sql = "INSERT $sql_priority INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
                VALUES ('$privmsg_sent_id', '" . $privmsg['privmsgs_bbcode_uid'] . "', '" . str_replace("\'", "''", addslashes($privmsg['privmsgs_text'])) . "')";
        if ( !$db->sql_uquery($sql) ) {
            message_die(GENERAL_ERROR, 'Could not insert private message sent text', '', __LINE__, __FILE__, $sql);
        }
        $attachment_mod['pm']->duplicate_attachment_pm($privmsg['privmsgs_attachment'], $privmsg['privmsgs_id'], $privmsg_sent_id);
    }
    //
    // Pick a folder, any folder, so long as it's one below ...
    //
    $post_urls = array(
        'post' => append_sid("privmsg.php?mode=post"),
        'reply' => append_sid("privmsg.php?mode=reply&amp;" . POST_POST_URL . "=$privmsg_id"),
        'quote' => append_sid("privmsg.php?mode=quote&amp;" . POST_POST_URL . "=$privmsg_id"),
        'edit' => append_sid("privmsg.php?mode=edit&amp;" . POST_POST_URL . "=$privmsg_id")
    );
    $post_icons = array(
        'post_img' => '<a href="' . $post_urls['post'] . '"><img src="' . $images['pm_postmsg'] . '" alt="' . $lang['Post_new_pm'] . '" title="' . $lang['Post_new_pm'] . '" border="0" /></a>',
        'post' => '<a href="' . $post_urls['post'] . '">' . $lang['Post_new_pm'] . '</a>',
        'reply_img' => '<a href="' . $post_urls['reply'] . '"><img src="' . $images['pm_replymsg'] . '" alt="' . $lang['Post_reply_pm'] . '" title="' . $lang['Post_reply_pm'] . '" border="0" /></a>',
        'reply' => '<a href="' . $post_urls['reply'] . '">' . $lang['Post_reply_pm'] . '</a>',
        'quote_img' => '<a href="' . $post_urls['quote'] . '"><img src="' . $images['pm_quotemsg'] . '" alt="' . $lang['Post_quote_pm'] . '" title="' . $lang['Post_quote_pm'] . '" border="0" /></a>',
        'quote' => '<a href="' . $post_urls['quote'] . '">' . $lang['Post_quote_pm'] . '</a>',
        'edit_img' => '<a href="' . $post_urls['edit'] . '"><img src="' . $images['pm_editmsg'] . '" alt="' . $lang['Edit_pm'] . '" title="' . $lang['Edit_pm'] . '" border="0" /></a>',
        'edit' => '<a href="' . $post_urls['edit'] . '">' . $lang['Edit_pm'] . '</a>'
    );
    if ( $folder == 'inbox' ) {
        $post_img   = $post_icons['post_img'];
        $reply_img  = $post_icons['reply_img'];
        $quote_img  = $post_icons['quote_img'];
        $edit_img   = '';
        $post       = $post_icons['post'];
        $reply      = $post_icons['reply'];
        $quote      = $post_icons['quote'];
        $edit       = '';
        $l_box_name = $lang['Inbox'];
    } else if ( $folder == 'outbox' ) {
        $post_img   = $post_icons['post_img'];
        $reply_img  = '';
        $quote_img  = '';
        $edit_img   = $post_icons['edit_img'];
        $post       = $post_icons['post'];
        $reply      = '';
        $quote      = '';
        $edit       = $post_icons['edit'];
        $l_box_name = $lang['Outbox'];
    } else if ( $folder == 'savebox' ) {
        if ( $privmsg['privmsgs_type'] == PRIVMSGS_SAVED_IN_MAIL ) {
            $post_img   = $post_icons['post_img'];
            $reply_img  = $post_icons['reply_img'];
            $quote_img  = $post_icons['quote_img'];
            $edit_img   = '';
            $post       = $post_icons['post'];
            $reply      = $post_icons['reply'];
            $quote      = $post_icons['quote'];
            $edit       = '';
        } else {
            $post_img   = $post_icons['post_img'];
            $reply_img  = '';
            $quote_img  = '';
            $edit_img   = '';
            $post       = $post_icons['post'];
            $reply      = '';
            $quote      = '';
            $edit       = '';
        }
        $l_box_name = $lang['Saved'];
    } else if ( $folder == 'sentbox' ) {
        $post_img   = $post_icons['post_img'];
        $reply_img  = '';
        $quote_img  = '';
        $edit_img   = '';
        $post       = $post_icons['post'];
        $reply      = '';
        $quote      = '';
        $edit       = '';
        $l_box_name = $lang['Sent'];
    }
    $s_hidden_fields = '<input type="hidden" name="mark[]" value="' . $privmsgs_id . '" />';
    $page_title = $lang['Read_pm'];
    include_once(NUKE_INCLUDE_DIR.'page_header.php');
    //
    // Load templates
    //
    $template->set_filenames(array(
            'body' => 'privmsgs_read_body.tpl')
    );

    $template->assign_vars(array(
        'INBOX_IMG'     => $inbox_img,
        'SENTBOX_IMG'   => $sentbox_img,
        'OUTBOX_IMG'    => $outbox_img,
        'SAVEBOX_IMG'   => $savebox_img,
        'INBOX'         => $inbox_url,
        'POST_PM_IMG'   => $post_img,
        'REPLY_PM_IMG'  => $reply_img,
        'EDIT_PM_IMG'   => $edit_img,
        'QUOTE_PM_IMG'  => $quote_img,
        'POST_PM'       => $post,
        'REPLY_PM'      => $reply,
        'EDIT_PM'       => $edit,
        'QUOTE_PM'      => $quote,
        'SENTBOX'       => $sentbox_url,
        'OUTBOX'        => $outbox_url,
        'SAVEBOX'       => $savebox_url,
        'BOX_NAME'      => $l_box_name,
        'L_MESSAGE'     => $lang['Message'],
        'L_INBOX'       => $lang['Inbox'],
        'L_OUTBOX'      => $lang['Outbox'],
        'L_SENTBOX'     => $lang['Sent'],
        'L_SAVEBOX'     => $lang['Saved'],
        'L_FLAG'        => $lang['Flag'],
        'L_SUBJECT'     => $lang['Subject'],
        'L_POSTED'      => $lang['Posted'],
        'L_DATE'        => $lang['Date'],
        'L_FROM'        => $lang['From'],
        'L_TO'          => $lang['To'],
        'L_SAVE_MSG'    => $lang['Save_message'],
        'L_DELETE_MSG'  => $lang['Delete_message'],
        'S_PRIVMSGS_ACTION' => append_sid("privmsg.php?folder=$folder"),
        'S_HIDDEN_FIELDS'   => $s_hidden_fields)
    );
    $user_id_from  = $privmsg['user_id_1'];
    $user_id_to    = $privmsg['user_id_2'];
    $username_from = UsernameColor($privmsg['username_1']);
    $username_to   = UsernameColor($privmsg['username_2']);
    init_display_pm_attachments($privmsg['privmsgs_attachment']);
    $post_date     = create_date($board_config['default_dateformat'], $privmsg['privmsgs_date'], $board_config['board_timezone']);
    $temp_url      = "modules.php?name=Forums&amp;file=search&amp;search_author=" . urlencode($privmsg['username_1']) . "&amp;showresults=posts";
    $search_img    = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $privmsg['username_1']) . '" title="' . sprintf($lang['Search_user_posts'], $privmsg['username_1']) . '" border="0" /></a>';
    $search        = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $username_from) . '</a>';
    $contact_img1  = EvoKernel_UserContactImg($privmsg['user_id_1']);
    $contact_img2  = EvoKernel_UserContactImg($privmsg['user_id_2']);
    //
    // Processing of post
    //
    $post_subject = ($board_config['smilies_in_titles']) ? smilies_pass($privmsg['privmsgs_subject']) : $privmsg['privmsgs_subject'];
    $private_message = $privmsg['privmsgs_text'];
    $bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
    if ( $board_config['allow_sig'] ) {
        $user_sig = ( $privmsg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig'] : $privmsg['user_sig'];
    } else {
        $user_sig = '';
    }
    $user_sig_bbcode_uid = ( $privmsg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig_bbcode_uid'] : $privmsg['user_sig_bbcode_uid'];
    //
    // If the board has HTML off but the post has HTML
    // on then we process it, else leave it alone
    //
    if ( !$board_config['allow_html'] || !$userdata['user_allowhtml']) {
        if ( !empty($user_sig)) {
            $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
        }
        if ( $privmsg['privmsgs_enable_html'] ) {
            $private_message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $private_message);
        }
    }
    if ( !empty($user_sig) && $privmsg['privmsgs_attach_sig'] && !empty($user_sig_bbcode_uid) ) {
        $user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
    }
    if ( !empty($bbcode_uid) ) {
        $private_message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($private_message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $private_message);
    }
    $private_message = make_clickable($private_message);
    if ( $privmsg['privmsgs_attach_sig'] && !empty($user_sig) ) {
        $private_message .= '<br />' . $board_config['sig_line'] . '<br />' . make_clickable($user_sig);
    }
    $orig_word = array();
    $replacement_word = array();
    obtain_word_list($orig_word, $replacement_word);
    if ( count($orig_word) ) {
        $post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
        $private_message = preg_replace($orig_word, $replacement_word, $private_message);
    }
    if ( $board_config['allow_smilies'] && $privmsg['privmsgs_enable_smilies'] ) {
        $private_message = smilies_pass($private_message);
    }
    $private_message = word_wrap_pass($private_message);
    $private_message = str_replace("\n", '<br />', $private_message);
    //
    // Dump it to the templating engine
    //
    $template->assign_vars(array(
        'MESSAGE_TO'        => $username_to,
        'MESSAGE_FROM'      => $username_from,
        'POST_SUBJECT'      => $post_subject,
        'POST_DATE'         => $post_date,
        'MESSAGE'           => $private_message,
        'POSTER_FROM_ONLINE_STATUS_IMG' => $contact_img1['online_status_img'],
        'POSTER_FROM_ONLINE_STATUS'     => $contact_img1['online_status'],
        'POSTER_TO_ONLINE_STATUS'       => $contact_img2['online_status'],
        'PROFILE_IMG'       => $contact_img1['profile_img'],
        'PROFILE'           => $contact_img1['profile'],
        'SEARCH_IMG'        => $search_img,
        'SEARCH'            => $search,
        'EMAIL_IMG'         => $contact_img1['email_img'],
        'EMAIL'             => $contact_img1['email'],
        'WWW_IMG'           => $contact_img1['www_img'],
        'WWW'               => $contact_img1['www'],
        'ICQ_STATUS_IMG'    => $contact_img1['icq_status_img'],
        'ICQ_IMG'           => $contact_img1['icq_img'],
        'ICQ'               => $contact_img1['icq'],
        'ICQ_IMG_NOSCRIPT'  => $contact_img1['icq_noscript'],
        'AIM_IMG'           => $contact_img1['aim_img'],
        'AIM'               => $contact_img1['aim'],
        'MSN_IMG'           => $contact_img1['msn_img'],
        'MSN'               => $contact_img1['msn'],
        'YIM_STATUS_IMG'    => $contact_img1['yim_status_img'],
        'YIM_IMG'           => $contact_img1['yim_img'],
        'YIM_IMG_NOSCRIPT'  => $contact_img1['yim_noscript'],
        'YIM'               => $contact_img1['yim'])
    );
    if ( $folder == 'inbox' || $folder == 'savebox' ) {
        include(NUKE_INCLUDE_DIR.'ropm_quick_reply.php');
    }
    $template->pparse('body');
    include(NUKE_INCLUDE_DIR.'page_tail.php');
} else if ( ( $delete && $mark_list ) || $delete_all ) {
    if ( !$userdata['session_logged_in'] ) {
        redirect('modules.php?name=Your_Account&amp;redirect=privmsg&amp;folder=inbox');
        exit;
    }
    if ( isset($mark_list) && !is_array($mark_list) ) {
        // Set to empty array instead of '0' if nothing is selected.
        $mark_list = array();
    }
    if ( !$confirm ) {
        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
        $s_hidden_fields .= ( isset($delete) ) ? '<input type="hidden" name="delete" value="true" />' : '<input type="hidden" name="deleteall" value="true" />';
        for($i = 0; $i < count($mark_list); $i++) {
            $s_hidden_fields .= '<input type="hidden" name="mark[]" value="' . intval($mark_list[$i]) . '" />';
        }
        //
        // Output confirmation page
        //
        include_once(NUKE_INCLUDE_DIR.'page_header.php');
        $template->set_filenames(array(
            'confirm_body' => 'confirm_body.tpl')
        );
        $template->assign_vars(array(
            'MESSAGE_TITLE'     => $lang['Information'],
            'MESSAGE_TEXT'      => ( (count($mark_list) == 1) && !$delete_all ) ? $lang['Confirm_delete_pm'] : $lang['Confirm_delete_pms'],
            'L_YES'             => $lang['Yes'],
            'L_NO'              => $lang['No'],
            'S_CONFIRM_ACTION'  => append_sid("privmsg.php?folder=$folder"),
            'S_HIDDEN_FIELDS'   => $s_hidden_fields)
        );
        $template->pparse('confirm_body');
        include(NUKE_INCLUDE_DIR.'page_tail.php');
    } else if ( $confirm ) {
        $delete_sql_id = '';
        if (!$delete_all) {
            for ($i = 0; $i < count($mark_list); $i++) {
                $delete_sql_id .= ((!empty($delete_sql_id)) ? ', ' : '') . intval($mark_list[$i]);
            }
            $delete_sql_id = "AND privmsgs_id IN ($delete_sql_id)";
        }
        switch($folder) {
           case 'inbox':
              $delete_type = "privmsgs_to_userid = " . $userdata['user_id'] . " AND (
              privmsgs_type = " . PRIVMSGS_READ_MAIL . " OR privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
              break;

           case 'outbox':
              $delete_type = "privmsgs_from_userid = " . $userdata['user_id'] . " AND ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
              break;

           case 'sentbox':
              $delete_type = "privmsgs_from_userid = " . $userdata['user_id'] . " AND privmsgs_type = " . PRIVMSGS_SENT_MAIL;
              break;

           case 'savebox':
              $delete_type = "( ( privmsgs_from_userid = " . $userdata['user_id'] . "
              AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " )
              OR ( privmsgs_to_userid = " . $userdata['user_id'] . "
              AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " ) )";
              break;
        }

        $sql = "SELECT privmsgs_id
           FROM " . PRIVMSGS_TABLE . "
           WHERE $delete_type $delete_sql_id";
        if ( !($result = $db->sql_query($sql)) )  {
           message_die(GENERAL_ERROR, 'Could not obtain id list to delete messages', '', __LINE__, __FILE__, $sql);
        }
        $mark_list = array();
        while ( $row = $db->sql_fetchrow($result) ) {
           $mark_list[] = $row['privmsgs_id'];
        }
        $db->sql_freeresult($result);
        unset($delete_type);
        $attachment_mod['pm']->delete_all_pm_attachments($mark_list);
        if ( count($mark_list) ) {
            $delete_sql_id = '';
            for ($i = 0; $i < count($mark_list); $i++) {
                $delete_sql_id .= ((!empty($delete_sql_id)) ? ', ' : '') . intval($mark_list[$i]);
            }
            if ($folder == 'inbox' || $folder == 'outbox') {
                switch ($folder) {
                    case 'inbox':
                        $sql = "privmsgs_to_userid = " . $userdata['user_id'];
                        break;
                    case 'outbox':
                        $sql = "privmsgs_from_userid = " . $userdata['user_id'];
                        break;
                }
                // Get information relevant to new or unread mail
                // so we can adjust users counters appropriately
                $sql = "SELECT privmsgs_to_userid, privmsgs_type
                        FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_id IN ($delete_sql_id)
                                AND $sql
                                AND privmsgs_type IN (" . PRIVMSGS_NEW_MAIL . ", " . PRIVMSGS_UNREAD_MAIL . ")";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not obtain user id list for outbox messages', '', __LINE__, __FILE__, $sql);
                }
                if ( $row = $db->sql_fetchrow($result)) {
                    $update_users = $update_list = array();
                    do {
                        switch ($row['privmsgs_type']) {
                            case PRIVMSGS_NEW_MAIL:
                                $update_users['new'][$row['privmsgs_to_userid']] = (isset($update_users['new'][$row['privmsgs_to_userid']]) ? $update_users['new'][$row['privmsgs_to_userid']]++ : 0);
                                break;
                            case PRIVMSGS_UNREAD_MAIL:
                                $update_users['unread'][$row['privmsgs_to_userid']] = (isset($update_users['unread'][$row['privmsgs_to_userid']]) ? $update_users['unread'][$row['privmsgs_to_userid']]++ : 0);
                                break;
                        }
                    } while ($row = $db->sql_fetchrow($result));
                    if (count($update_users)) {
                        while (list($type, $users) = each($update_users)) {
                            while (list($user_id, $dec) = each($users)) {
                                $update_list[$type][$dec][] = $user_id;
                            }
                        }
                        unset($update_users);
                        while (list($type, $dec_ary) = each($update_list)) {
                            switch ($type) {
                                case 'new':
                                    $type = "user_new_privmsg";
                                    break;
                                case 'unread':
                                    $type = "user_unread_privmsg";
                                    break;
                            }
                            while (list($dec, $user_ary) = each($dec_ary)) {
                                $user_ids = implode(', ', $user_ary);
                                $sql = "UPDATE " . USERS_TABLE . "
                                        SET $type = $type - $dec
                                        WHERE user_id IN ($user_ids)";
                                if ( !$db->sql_uquery($sql) ) {
                                    message_die(GENERAL_ERROR, 'Could not update user pm counters', '', __LINE__, __FILE__, $sql);
                                }
                            }
                        }
                        unset($update_list);
                    }
                }
                $db->sql_freeresult($result);
            }
            // Delete the messages
            $delete_text_sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
                    WHERE privmsgs_text_id IN ($delete_sql_id)";
            $delete_sql = "DELETE FROM " . PRIVMSGS_TABLE . "
                    WHERE privmsgs_id IN ($delete_sql_id)
                            AND ";
            switch( $folder ) {
                case 'inbox':
                    $delete_sql .= "privmsgs_to_userid = " . $userdata['user_id'] . " AND (
                            privmsgs_type = " . PRIVMSGS_READ_MAIL . " OR privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                    break;
                case 'outbox':
                    $delete_sql .= "privmsgs_from_userid = " . $userdata['user_id'] . " AND (
                            privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
                    break;
                case 'sentbox':
                    $delete_sql .= "privmsgs_from_userid = " . $userdata['user_id'] . " AND privmsgs_type = " . PRIVMSGS_SENT_MAIL;
                    break;
                case 'savebox':
                    $delete_sql .= "( ( privmsgs_from_userid = " . $userdata['user_id'] . "
                            AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " )
                    OR ( privmsgs_to_userid = " . $userdata['user_id'] . "
                            AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " ) )";
                    break;
            }
            if ( !$db->sql_query($delete_sql) ) {
                message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
            }
            if ( !$db->sql_query($delete_text_sql) ) {
                message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $delete_text_sql);
            }
        }
    }
} else if ( $save && $mark_list && $folder != 'savebox' && $folder != 'outbox' ) {
    if ( !$userdata['session_logged_in'] ) {
        redirect('modules.php?name=Your_Account&amp;redirect=privmsg&amp;folder=inbox');
        exit;
    }
    if (count($mark_list)) {
        // See if recipient is at their savebox limit
        $sql = "SELECT COUNT(privmsgs_id) AS savebox_items, MIN(privmsgs_date) AS oldest_post_time
                FROM " . PRIVMSGS_TABLE . "
                WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . "
                AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                OR ( privmsgs_from_userid = " . $userdata['user_id'] . "
                AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )";
        if ( !($result1 = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not obtain sent message info for sendee', '', __LINE__, __FILE__, $sql);
        }
        $sql_priority = ( SQL_LAYER == 'mysql' ) ? 'LOW_PRIORITY' : '';
        if ( $saved_info = $db->sql_fetchrow($result1) )  {
            if ($board_config['max_savebox_privmsgs'] && $saved_info['savebox_items'] >= $board_config['max_savebox_privmsgs'] ) {
                $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
                        WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . "
                        AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                        OR ( privmsgs_from_userid = " . $userdata['user_id'] . "
                        AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )
                        AND privmsgs_date = " . $saved_info['oldest_post_time'];
                if ( !$result = $db->sql_query($sql) )  {
                        message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
                }
                $old_privmsgs_id = $db->sql_fetchrow($result);
                $old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
                $db->sql_freeresult($result);
                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_id = '$old_privmsgs_id'";
                if ( !$db->sql_uquery($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
                }
                $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . "
                        WHERE privmsgs_text_id = '$old_privmsgs_id'";
                if ( !$db->sql_uquery($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (save)', '', __LINE__, __FILE__, $sql);
                }
            }
        }
        $db->sql_freeresult($result1);
        $saved_sql_id = '';
        for ($i = 0; $i < count($mark_list); $i++) {
            $saved_sql_id .= ((!empty($saved_sql_id)) ? ', ' : '') . intval($mark_list[$i]);
        }
        // Process request
        $saved_sql = "UPDATE " . PRIVMSGS_TABLE;
        // Decrement read/new counters if appropriate
        if ($folder == 'inbox' || $folder == 'outbox') {
            switch ($folder) {
                case 'inbox':
                    $sql = "privmsgs_to_userid = " . $userdata['user_id'];
                    break;
                case 'outbox':
                    $sql = "privmsgs_from_userid = " . $userdata['user_id'];
                    break;
            }
            // Get information relevant to new or unread mail
            // so we can adjust users counters appropriately
            $sql = "SELECT privmsgs_to_userid, privmsgs_type
                    FROM " . PRIVMSGS_TABLE . "
                    WHERE privmsgs_id IN ($saved_sql_id)
                    AND $sql
                    AND privmsgs_type IN (" . PRIVMSGS_NEW_MAIL . ", " . PRIVMSGS_UNREAD_MAIL . ")";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain user id list for outbox messages', '', __LINE__, __FILE__, $sql);
            }
            if ( $row = $db->sql_fetchrow($result)) {
                $update_users = $update_list = array();
                do {
                    switch ($row['privmsgs_type']) {
                        case PRIVMSGS_NEW_MAIL:
                            $update_users['new'][$row['privmsgs_to_userid']] = (isset($update_users['new'][$row['privmsgs_to_userid']]) ? $update_users['new'][$row['privmsgs_to_userid']]++ : 0);
                            break;
                        case PRIVMSGS_UNREAD_MAIL:
                            $update_users['unread'][$row['privmsgs_to_userid']] = (iosset($update_users['unread'][$row['privmsgs_to_userid']]) ? $update_users['unread'][$row['privmsgs_to_userid']]++ : 0);
                            break;
                    }
                } while ($row = $db->sql_fetchrow($result));
                if (count($update_users)) {
                    while (list($type, $users) = each($update_users))  {
                        while (list($user_id, $dec) = each($users)) {
                            $update_list[$type][$dec][] = $user_id;
                        }
                    }
                    unset($update_users);
                    while (list($type, $dec_ary) = each($update_list)) {
                        switch ($type) {
                            case 'new':
                                $type = "user_new_privmsg";
                                break;
                            case 'unread':
                                $type = "user_unread_privmsg";
                                break;
                        }
                        while (list($dec, $user_ary) = each($dec_ary)) {
                            $user_ids = implode(', ', $user_ary);
                            $sql = "UPDATE " . USERS_TABLE . "
                                    SET $type = $type - $dec
                                    WHERE user_id IN ($user_ids)";
                            if ( !$db->sql_uquery($sql) ) {
                                message_die(GENERAL_ERROR, 'Could not update user pm counters', '', __LINE__, __FILE__, $sql);
                            }
                        }
                    }
                    unset($update_list);
                }
            }
            $db->sql_freeresult($result);
        }
        switch ($folder) {
            case 'inbox':
                $saved_sql .= " SET privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . "
                        WHERE privmsgs_to_userid = " . $userdata['user_id'] . "
                                AND ( privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                        OR privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                        OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . ")";
                break;
            case 'outbox':
                $saved_sql .= " SET privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . "
                        WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                                AND ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                        OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) ";
                break;
            case 'sentbox':
                $saved_sql .= " SET privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . "
                        WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                                AND privmsgs_type = " . PRIVMSGS_SENT_MAIL;
                break;
        }
        $saved_sql .= " AND privmsgs_id IN ($saved_sql_id)";
        if ( !$db->sql_query($saved_sql) ) {
            message_die(GENERAL_ERROR, 'Could not save private messages', '', __LINE__, __FILE__, $saved_sql);
        }
        redirect(append_sid('privmsg.php?folder=savebox', true));
        exit;
    }
} else if ( $submit || $refresh || !empty($mode) ) {
    if ( !$userdata['session_logged_in'] ) {
        $user_redirect = ( isset($user_id) ) ? '&amp;' . POST_USERS_URL . '=' . $user_id : '';
        redirect('modules.php?name=Your_Account&amp;redirect=privmsg&amp;folder='.$folder.'&amp;mode='.$mode. $user_redirect);
        exit;
    }
    //
    // Toggles
    //
    if ( !$board_config['allow_html'] ) {
        $html_on = 0;
    } else {
        $html_on = ( $submit || $refresh ) ? ( ( !empty($disable_html) ) ? 0 : TRUE ) : $userdata['user_allowhtml'];
    }
    if ( !$board_config['allow_bbcode'] ) {
        $bbcode_on = 0;
    } else {
        $bbcode_on = ( $submit || $refresh ) ? ( ( !empty($disable_bbcode) ) ? 0 : TRUE ) : $userdata['user_allowbbcode'];
    }
    if ( !$board_config['allow_smilies'] ) {
        $smilies_on = 0;
    } else {
        $smilies_on = ( $submit || $refresh ) ? ( ( !empty($disable_smilies) ) ? 0 : TRUE ) : $userdata['user_allowsmile'];
    }
    $attach_sig = ( $submit || $refresh ) ? ( ( !empty($attach_sig) ) ? TRUE : 0 ) : $userdata['user_attachsig'];
    $user_sig = ( !empty($userdata['user_sig']) && $board_config['allow_sig'] ) ? $userdata['user_sig'] : "";
    if ( $submit && $mode != 'edit' ) {
        // No Flood control for Admins
        if ( !is_admin() ) {
            //
            // Flood control
            //
            $sql = "SELECT MAX(privmsgs_date) AS last_post_time
                    FROM " . PRIVMSGS_TABLE . "
                    WHERE privmsgs_from_userid = " . $userdata['user_id'];
            if ( $result = $db->sql_query($sql) )  {
                $db_row = $db->sql_fetchrow($result);
                $last_post_time = $db_row['last_post_time'];
                $current_time = time();
                if ( ( $current_time - $last_post_time ) < $board_config['flood_interval']) {
                        message_die(GENERAL_MESSAGE, $lang['Flood_Error']);
                }
            }
            $db->sql_freeresult($result);
            //
            // End Flood control
            //
        }
    }
    if ($submit && $mode == 'edit') {
        $sql = 'SELECT privmsgs_from_userid
            FROM ' . PRIVMSGS_TABLE . '
            WHERE privmsgs_id = ' . (int) $privmsgs_id . '
            AND privmsgs_from_userid = ' . $userdata['user_id'];
        if (!($result = $db->sql_query($sql))) {
            message_die(GENERAL_ERROR, "Could not obtain message details", "", __LINE__, __FILE__, $sql);
        }
        if (!($row = $db->sql_fetchrow($result))) {
            message_die(GENERAL_MESSAGE, $lang['No_such_post']);
        }
        $db->sql_freeresult($result);
        unset($row);
    }
    if ( $submit ) {
        if ( !empty($username) ) {
            $to_username_array = explode (";", $username);
            $n=0;
            foreach ($to_username_array as $name) {
                $to_username = phpbb_clean_username($name);
                $sql = "SELECT user_id, username, user_notify_pm, user_email, user_lang, user_active
                        FROM " . USERS_TABLE . "
                        WHERE username = '".$to_username."'
                        AND user_id <> " . ANONYMOUS;
                if( !($result2 = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not obtain users PM information', '', __LINE__, __FILE__, $sql);
                }
                $to_users[$n] = $db->sql_fetchrow($result2);
                $db->sql_freeresult($result2);
                if (strcasecmp($to_users[$n]['username'], $to_username) != 0) {
                        $error = TRUE;
                        $error_msg .= $lang['No_such_user']." " .phpbb_clean_username($to_username_array[$n]);
                        break;
                }
                $n++;
            }
        } else if ( empty($group_id) ) {
            $error = TRUE;
            $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_to_user'];
        } else if ( !empty($group_id) ) {
            $to_users = $PM_list;
        } else {
            $error = TRUE;
            $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_to_user'];
        }
        $privmsg_subject = trim(htmlspecialchars($subject));
        if ( empty($privmsg_subject) )  {
            $error = TRUE;
            $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_subject'];
        }
        if ( !empty($message) ) {
            if ( !$error ) {
                if ( $bbcode_on ) {
                    $bbcode_uid = make_bbcode_uid();
                }
                $privmsg_message = prepare_message($message, $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
                //Clean up all BBcode UID
                $message_text = htmlspecialchars(trim(stripslashes($message)));
                $quote = $lang['Quote'];
                $code = $lang['Code'];
                //Clean up all BBcode tags
                $bbcode_match = array('/\[quote=\&quot\;\w+\&quot\;\]/si', '/\[quote\]/si', '/\[\/quote\]/si', '/\[code\]/si', '/\[\/code\]/si', '/\[\w+\]/si', '/\[\/\w+\]/si', '/\[\w+=\w+\]/si', '/\[\/\w+=\w+\]/si','/\[\w+\]/si', '/\[\/\w+\]/si');
                $bbcode_replace = array("\n$quote >>\n", "\n$quote >>\n","\n<< $quote\n", "\n$code >>\n","\n<< $code\n",'','','','','','');
                $message_text = preg_replace($bbcode_match, $bbcode_replace, $message_text);
            }
        } else {
            $error = TRUE;
            $error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_message'];
        }
    }
    if ( $submit && !$error ) {
        //
        // Has admin prevented user from sending PM's?
        //
        if ( !$userdata['user_allow_pm'] ) {
            $message = $lang['Cannot_send_privmsg'];
            message_die(GENERAL_MESSAGE, $message);
        }
        foreach($to_users as $to_userdata) {
            $msg_time = time();
            if ( $mode != 'edit' ) {
                //
                // See if recipient is at their inbox limit
                //
                $sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time
                        FROM " . PRIVMSGS_TABLE . "
                        WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                        OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                        OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )
                                AND privmsgs_to_userid = " . $to_userdata['user_id'];
                if ( !($result = $db->sql_query($sql)) ) {
                        message_die(GENERAL_MESSAGE, $lang['No_such_user']);
                }
                $sql_priority = ( SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli') ? 'LOW_PRIORITY' : '';
                if ( $inbox_info = $db->sql_fetchrow($result) ) {
                    if ($board_config['max_inbox_privmsgs'] && $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'])
                    {
                        $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
                                WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                                                OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                                                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  )
                                        AND privmsgs_date = " . $inbox_info['oldest_post_time'] . "
                                        AND privmsgs_to_userid = " . $to_userdata['user_id'];
                        if ( !$result1 = $db->sql_query($sql) ) {
                                message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (inbox)', '', __LINE__, __FILE__, $sql);
                        }
                        $old_privmsgs_id = $db->sql_fetchrow($result1);
                        $old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
                        $db->sql_freeresult($result1);
                        $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . "
                                WHERE privmsgs_id = '$old_privmsgs_id'";
                        if ( !$db->sql_uquery($sql) ) {
                                message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (inbox)'.$sql, '', __LINE__, __FILE__, $sql);
                        }
                        $sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . "
                                WHERE privmsgs_text_id = '$old_privmsgs_id'";
                        if ( !$db->sql_uquery($sql) ) {
                                message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (inbox)', '', __LINE__, __FILE__, $sql);
                        }
                    }
                }
                $db->sql_freeresult($result);
                $sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
                        VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("\'", "''", $privmsg_subject) . "', " . $userdata['user_id'] . ", " . $to_userdata['user_id'] . ", $msg_time, '$user_ip', '$html_on', '$bbcode_on', '$smilies_on', '$attach_sig')";
            } else {
                $sql_info = "UPDATE " . PRIVMSGS_TABLE . "
                        SET privmsgs_type = " . PRIVMSGS_NEW_MAIL . ", privmsgs_subject = '" . str_replace("\'", "''", $privmsg_subject) . "', privmsgs_from_userid = " . $userdata['user_id'] . ", privmsgs_to_userid = " . $to_userdata['user_id'] . ", privmsgs_date = '$msg_time', privmsgs_ip = '$user_ip', privmsgs_enable_html = '$html_on', privmsgs_enable_bbcode = '$bbcode_on', privmsgs_enable_smilies = '$smilies_on', privmsgs_attach_sig = '$attach_sig'
                        WHERE privmsgs_id = '$privmsg_id'";
            }
            if ( !($result = $db->sql_uquery($sql_info)) ) {
                message_die(GENERAL_ERROR, "Could not insert/update private message sent info.", "", __LINE__, __FILE__, $sql_info);
            }
            if ( $mode != 'edit' ) {
                $privmsg_sent_id = $db->sql_nextid();
                $sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
                        VALUES ('$privmsg_sent_id', '" . $bbcode_uid . "', '" . str_replace("\'", "''", $privmsg_message) . "')";
            } else {
                $sql = "UPDATE " . PRIVMSGS_TEXT_TABLE . "
                        SET privmsgs_text = '" . str_replace("\'", "''", $privmsg_message) . "', privmsgs_bbcode_uid = '$bbcode_uid'
                        WHERE privmsgs_text_id = '$privmsg_id'";
            }
            if ( !$db->sql_uquery($sql) ) {
                message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql_info);
            }
            $attachment_mod['pm']->insert_attachment_pm($privmsg_id);
            if ( $mode != 'edit' ) {
                //
                // Add to the users new pm counter
                //
                $sql = "UPDATE " . USERS_TABLE . "
                        SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . time() . "
                        WHERE user_id = " . $to_userdata['user_id'];
                if ( !$status = $db->sql_uquery($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
                }
                if ( $to_userdata['user_notify_pm'] && !empty($to_userdata['user_email']) && $to_userdata['user_active'] && (function_exists('mail'))) {
                    // Using new email function evo_mail()
                    if ( empty($to_userdata['user_lang'] )) { $to_userdata['user_lang'] = $board_config['default_lang'];}
                    @include_once(NUKE_MODULES_DIR . $module_name . '/language/mail-'.$to_userdata['user_lang'].'.php');
                    $message  = $lang_new[$module_name]['HELLO'].' '.$to_userdata['username'].',<br /><br />';
                    $message .= $lang_new[$module_name]['PRIVMSG_INFO'].'<br /><br />';
                    $message .= $message_text.'<br /><br />';
                    $message .= $lang_new[$module_name]['PRIVMSG_INFO2'].'<br /><br />';
                    $message .= $lang_new[$module_name]['PRIVMSG_CLICK'].'<br /><br />';
                    $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
                    $subject  = $lang_new[$module_name]['PRIVMSG_SUBJECT'];
                    $to       = $to_userdata['user_email'].', '.$to_userdata['username'];
                    $return   = evo_mail($to, $subject, $message);
                }
            }
        }
        $meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("privmsg.php?folder=inbox") . '" />';
        $msg = $lang['Message_sent'] . '<br /><br />' . sprintf($lang['Click_return_inbox'], '<a href="' . append_sid("privmsg.php?folder=inbox") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $msg, $lang['Private_Messaging'], '', '', '', $meta);
    } else if ( $preview || $refresh || $error ) {
        //
        // If we're previewing or refreshing then obtain the data
        // passed to the script, process it a little, do some checks
        // where neccessary, etc.
        //
        $to_username = (isset($username) ) ? trim(htmlspecialchars(stripslashes($username))) : '';
        $privmsg_subject = ( isset($subject) ) ? trim(htmlspecialchars(stripslashes($subject))) : '';
        $privmsg_message = ( isset($message) ) ? trim($message) : '';
        $privmsg_message = preg_replace('#<textarea>#si', '&lt;textarea&gt;', $privmsg_message);
        if ( $mode == 'masspm' ) {
            $sql = "SELECT DISTINCT g.group_id, g.group_name
                    FROM ".GROUPS_TABLE . " g, ".USER_GROUP_TABLE . " ug
                    WHERE g.group_single_user <> 1
                    AND (
                        ('".$userdata['user_level']."'='".ADMIN."') OR
                        (g.group_allow_pm='".AUTH_MOD."' AND g.group_moderator = '" . $userdata['user_id']."') OR
                        (g.group_allow_pm='".AUTH_ACL."' AND ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ) OR
                        (g.group_allow_pm='".AUTH_REG."' AND '".$userdata['user_id']."'!='".ANONYMOUS."' ) OR
                        (g.group_allow_pm='".AUTH_ALL."')
                    )" ;
            if( !$g_result = $db->sql_query($sql) ) {
              message_die(GENERAL_ERROR, "Could not select group names!", __LINE__, __FILE__, $sql);
            }
            $group_list = $db->sql_fetchrowset($g_result);
            if( !is_admin() && empty($group_list)) {
              message_die(GENERAL_ERROR, $lang['Mass_pm_not_allowed']);
            }
            $select_list = '<select name = "' . POST_GROUPS_URL . '">';
            $select_list .= (is_admin()) ? '<option value = "users" '. (($group_id=='users') ? ' SELECTED ' : '' ).'>' . $lang['All_users'] .'</option>':'';
            $select_list .= (is_admin()) ? '<option value = "admins" '. (($group_id=='admins') ? ' SELECTED ' : '' ).'>' . $lang['All_admins'] .'</option>':'';
            $select_list .= (is_admin()) ? '<option value = "moderators" '. (($group_id=='moderators') ? ' SELECTED ' : '' ).'>' . $lang['All_mods'] .'</option>':'';
            for($i = 0;$i < count($group_list); $i++) {
                $select_list .= '<option value = "' . $group_list[$i]['group_id'].'"'. (($group_list[$i]['group_id']==$group_id) ? ' SELECTED ' : '').'>'.$group_list[$i]['group_name'] .'</option>';
            }
            $select_list .= "</select>";
        }
        if ( !$preview ) {
            $privmsg_message = stripslashes($privmsg_message);
        }
        //
        // Do mode specific things
        //
        if ( $mode == 'post' ) {
            $page_title = $lang['Post_new_pm'];
            $user_sig = ( !empty($userdata['user_sig']) && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';
        } else if ( $mode == 'reply' ) {
            $page_title = $lang['Post_reply_pm'];
            $user_sig = ( !empty($userdata['user_sig']) && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';
        } else if ( $mode == 'edit' ) {
            $page_title = $lang['Edit_pm'];
            $sql = "SELECT u.user_id, u.user_sig
                    FROM " . PRIVMSGS_TABLE . " pm, " . USERS_TABLE . " u
                    WHERE pm.privmsgs_id = '$privmsg_id'
                            AND u.user_id = pm.privmsgs_from_userid";
            if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Could not obtain post and post text", "", __LINE__, __FILE__, $sql);
            }
            if ( $postrow = $db->sql_fetchrow($result) ) {
                if ( $userdata['user_id'] != $postrow['user_id'] ) {
                    message_die(GENERAL_MESSAGE, $lang['Edit_own_posts']);
                }
                $user_sig = ( !empty($postrow['user_sig']) && $board_config['allow_sig'] ) ? $postrow['user_sig'] : '';
            }
            $db->sql_freeresult($result);
        }
    } else {
        if ( $privmsgs_id == 0 && ( $mode == 'reply' || $mode == 'edit' || $mode == 'quote' ) ) {
            message_die(GENERAL_ERROR, $lang['No_post_id']);
        }
        if ( !empty($user_id) ) {
            $sql = "SELECT username
                    FROM " . USERS_TABLE . "
                    WHERE user_id = '$user_id'
                    AND user_id <> " . ANONYMOUS;
            if ( !($result = $db->sql_query($sql)) ) {
                $error = TRUE;
                $error_msg = $lang['No_such_user'];
            }
            if ( $row = $db->sql_fetchrow($result) ) {
                $to_username = $row['username'];
            }
            $db->sql_freeresult($result);
        } else if ( $mode == 'edit' ) {
            $sql = "SELECT pm.*, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text, u.username, u.user_id, u.user_sig
                    FROM " . PRIVMSGS_TABLE . " pm, " . PRIVMSGS_TEXT_TABLE . " pmt, " . USERS_TABLE . " u
                    WHERE pm.privmsgs_id = '".$privmsgs_id."'
                    AND pmt.privmsgs_text_id = pm.privmsgs_id
                    AND pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                    AND ( pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
                    OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )
                   AND u.user_id = pm.privmsgs_to_userid";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain private message for editing', '', __LINE__, __FILE__, $sql);
            }
            if ( !($privmsg = $db->sql_fetchrow($result)) ) {
                redirect(append_sid('privmsg.php?folder='.$folder, true));
                exit;
            }
            $db->sql_freeresult($result);
            $privmsg_subject = $privmsg['privmsgs_subject'];
            $privmsg_message = $privmsg['privmsgs_text'];
            $privmsg_bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
            $privmsg_bbcode_enabled = ($privmsg['privmsgs_enable_bbcode'] == 1);
            if ( $privmsg_bbcode_enabled ) {
                $privmsg_message = preg_replace("/\:(([a-z0-9]:)?)$privmsg_bbcode_uid/si", '', $privmsg_message);
            }
            $privmsg_message = str_replace('<br />', "\n", $privmsg_message);
            $privmsg_message = preg_replace('#</textarea>#si', '&lt;/textarea&gt;', $privmsg_message);
            $user_sig = ( $board_config['allow_sig'] ) ? (($privmsg['privmsgs_type'] == PRIVMSGS_NEW_MAIL) ? $user_sig : $privmsg['user_sig']) : '';
            $to_username = $privmsg['username'];
            $to_userid = $privmsg['user_id'];
        } else if ( $mode == 'reply' || $mode == 'quote' ) {
            $sql = "SELECT pm.privmsgs_subject, pm.privmsgs_date, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text, u.username, u.user_id
                    FROM " . PRIVMSGS_TABLE . " pm, " . PRIVMSGS_TEXT_TABLE . " pmt, " . USERS_TABLE . " u
                    WHERE pm.privmsgs_id = '$privmsgs_id'
                    AND pmt.privmsgs_text_id = pm.privmsgs_id
                    AND pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                    AND u.user_id = pm.privmsgs_from_userid";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain private message for editing', '', __LINE__, __FILE__, $sql);
            }
            if ( !($privmsg = $db->sql_fetchrow($result)) ) {
                redirect(append_sid('privmsg.php?folder='.$folder, true));
                exit;
            }
            $db->sql_freeresult($result);
            $privmsg_subject = ( ( !preg_match('/^Re:/', $privmsg['privmsgs_subject']) ) ? 'Re: ' : '' ) . $privmsg['privmsgs_subject'];
            $to_username = $privmsg['username'];
            $to_userid = $privmsg['user_id'];
            if ( $mode == 'quote' ) {
                $privmsg_message = $privmsg['privmsgs_text'];
                $privmsg_bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
                $privmsg_message = preg_replace("/\:(([a-z0-9]:)?)$privmsg_bbcode_uid/si", '', $privmsg_message);
                $privmsg_message = str_replace('<br />', "\n", $privmsg_message);
                $privmsg_message = preg_replace('#</textarea>#si', '&lt;/textarea&gt;', $privmsg_message);
                $msg_date =  create_date($board_config['default_dateformat'], $privmsg['privmsgs_date'], $board_config['board_timezone']);
                $privmsg_message = '[quote="' . $to_username . '"]' . $privmsg_message . '[/quote]';
                $mode = 'reply';
            }
        } else if ( $mode == 'masspm' ) {
            $page_title = $lang['Send_mass_pm'];
            $post_a = $lang['Send_mass_pm'];
            $user_sig = ( !empty($userdata['user_sig']) && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';
            $sql = "SELECT DISTINCT g.group_id, g.group_name
                    FROM ".GROUPS_TABLE . " g, ".USER_GROUP_TABLE . " ug
                    WHERE g.group_single_user <> 1
                    AND (
                        ('".$userdata['user_level']."'='".ADMIN."') OR
                        (g.group_allow_pm='".AUTH_MOD."' AND g.group_moderator = '" . $userdata['user_id']."') OR
                        (g.group_allow_pm='".AUTH_ACL."' AND ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ) OR
                        (g.group_allow_pm='".AUTH_REG."' AND '".$userdata['user_id']."'!='".ANONYMOUS."' ) OR
                        (g.group_allow_pm='".AUTH_ALL."')
                    )" ;
            if( !$g_result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Could not select group names!", __LINE__, __FILE__, $sql);
            }
            $group_list = $db->sql_fetchrowset($g_result);
            if( is_admin() && empty($group_list)) {
                message_die(GENERAL_ERROR, $lang['Mass_pm_not_allowed']);
            }
            $select_list = '<select name = "' . POST_GROUPS_URL . '">';
            $select_list .= (is_admin()) ? '<option value = "users" '. (($group_id=='users') ? ' SELECTED ' : '' ).'>' . $lang['All_users'] .'</option>':'';
            $select_list .= (is_admin()) ? '<option value = "admins" '. (($group_id=='admins') ? ' SELECTED ' : '' ).'>' . $lang['All_admins'] .'</option>':'';
            $select_list .= (is_admin()) ? '<option value = "moderators" '. (($group_id=='moderators') ? ' SELECTED ' : '' ).'>' . $lang['All_mods'] .'</option>':'';
            for($i = 0;$i < count($group_list); $i++) {
                $select_list .= '<option value = "' . $group_list[$i]['group_id'].'"'. (($group_list[$i]['group_id']==$group_id) ? ' SELECTED ' : '').'>'.$group_list[$i]['group_name'] .'</option>';
            }
            $select_list .= "</select>";
        } else {
           $privmsg_subject = $privmsg_message = $to_username = $select_list = '';
        }
    }
    //
    // Has admin prevented user from sending PM's?
    //
    if ( !$userdata['user_allow_pm'] && $mode != 'edit' ) {
        $message = $lang['Cannot_send_privmsg'];
        message_die(GENERAL_MESSAGE, $message);
    }
    //
    // Start output, first preview, then errors then post form
    //
    $page_title = $lang['Send_private_message'];
    include_once(NUKE_INCLUDE_DIR.'page_header.php');
    if ( $preview && !$error ) {
        $orig_word = array();
        $replacement_word = array();
        obtain_word_list($orig_word, $replacement_word);
        if ( $bbcode_on ) {
            $bbcode_uid = make_bbcode_uid();
        }
        $preview_message = stripslashes(prepare_message($privmsg_message, $html_on, $bbcode_on, $smilies_on, $bbcode_uid));
        $privmsg_message = stripslashes(preg_replace($html_entities_match, $html_entities_replace, $privmsg_message));
        //
        // Finalise processing as per viewtopic
        //
        if ( !$html_on || !$board_config['allow_html'] || !$userdata['user_allowhtml'] ) {
            if ( !empty($user_sig) ) {
                $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
            }
        }
        if ( $attach_sig && !empty($user_sig) && $userdata['user_sig_bbcode_uid'] ) {
            $user_sig = bbencode_second_pass($user_sig, $userdata['user_sig_bbcode_uid']);
        }
        if ( $bbcode_on ) {
            $preview_message = bbencode_second_pass($preview_message, $bbcode_uid);
        }
        if ( $attach_sig && !empty($user_sig) ) {
            $preview_message = $preview_message . '<br />' . $board_config['sig_line'] . '<br />' . $user_sig;
        }
        if ( count($orig_word) ) {
            $preview_subject = preg_replace($orig_word, $replacement_word, $privmsg_subject);
            $preview_message = preg_replace($orig_word, $replacement_word, $preview_message);
        } else {
            $preview_subject = ($board_config['smilies_in_titles']) ? smilies_pass($privmsg_subject) : $privmsg_subject;
        }
        if ( $smilies_on ) {
            $preview_message = smilies_pass($preview_message);
        }
        $preview_message = word_wrap_pass($preview_message);
        $preview_message = make_clickable($preview_message);
        $preview_message = str_replace("\n", '<br />', $preview_message);
        $s_hidden_fields = '<input type="hidden" name="folder" value="' . $folder . '" />';
        $s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
        if ( isset($privmsg_id) ) {
            $s_hidden_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $privmsg_id . '" />';
        }
        $template->set_filenames(array(
            "preview" => 'privmsgs_preview.tpl')
        );
        $attachment_mod['pm']->preview_attachments();
        $template->assign_vars(array(
            'TOPIC_TITLE'       => $preview_subject,
            'POST_SUBJECT'      => $preview_subject,
            'MESSAGE_TO'        => (($mode == 'masspm') ? $group_name : UsernameColor($to_username)),
            'MESSAGE_FROM'      => UsernameColor($userdata['username']),
            'POST_DATE'         => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
            'MESSAGE'           => $preview_message,
            'S_HIDDEN_FIELDS'   => $s_hidden_fields,
            'L_SUBJECT'         => $lang['Subject'],
            'L_DATE'            => $lang['Date'],
            'L_FROM'            => $lang['From'],
            'L_TO'              => $lang['To'],
            'L_PREVIEW'         => $lang['Preview'],
            'L_POSTED'          => $lang['Posted'])
        );
        $template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
    }
    //
    // Start error handling
    //
    if ($error) {
        $privmsg_message = htmlspecialchars($privmsg_message);
        $template->set_filenames(array(
            'reg_header' => 'error_body.tpl')
        );
        $template->assign_vars(array(
            'ERROR_MESSAGE' => $error_msg)
        );
        $template->assign_var_from_handle('ERROR_BOX', 'reg_header');
    }
    //
    // Load templates
    //
    $template->set_filenames(array(
            'body' => 'posting_body.tpl')
    );
    //
    // Enable extensions in posting_body
    //
    if ( $mode == 'masspm' ) {
        $template->assign_block_vars('switch_groupmsg', array());
    } else {
        $template->assign_block_vars('switch_privmsg', array());
    }
    //
    // HTML toggle selection
    //
    if ( $board_config['allow_html'] ) {
        $html_status = $lang['HTML_is_ON'];
        $template->assign_block_vars('switch_html_checkbox', array());
    } else {
        $html_status = $lang['HTML_is_OFF'];
    }
    //
    // BBCode toggle selection
    //
    if ( $board_config['allow_bbcode'] ) {
        $bbcode_status = $lang['BBCode_is_ON'];
        $template->assign_block_vars('switch_bbcode_checkbox', array());
    } else {
        $bbcode_status = $lang['BBCode_is_OFF'];
    }
    //
    // Smilies toggle selection
    //
    if ( $board_config['allow_smilies'] ) {
        $smilies_status = $lang['Smilies_are_ON'];
        $template->assign_block_vars('switch_smilies_checkbox', array());
    } else {
        $smilies_status = $lang['Smilies_are_OFF'];
    }
    //
    // Signature toggle selection - only show if
    // the user has a signature
    //
    if ( !empty($user_sig) ) {
        $template->assign_block_vars('switch_signature_checkbox', array());
    }
    if ( $mode == 'post' ) {
        $post_a = $lang['Send_a_new_message'];
    } else if ( $mode == 'reply' ) {
        $post_a = $lang['Send_a_reply'];
        $mode = 'post';
    } else if ( $mode == 'edit' ) {
        $post_a = $lang['Edit_message'];
    }
    $s_hidden_fields = '<input type="hidden" name="folder" value="' . $folder . '" />';
    $s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
    if ( $mode == 'edit' ) {
        $s_hidden_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $privmsgs_id . '" />';
    }
    if ( is_admin() && ( $mode != 'masspm') ) {
        $template->assign_block_vars('switch_Welcome_PM', array());
    }
    //
    // Send smilies to template
    //
    generate_smilies('inline', PAGE_PRIVMSGS);
    if ( $mode == 'masspm' ) {
        $template->assign_vars(array(
        'BB_BOX'                => bbcode_table('message', 'post', 1, $privmsg_message),
        'SUBJECT'               => $privmsg_subject,
        'USERNAME'              => (( $select_list) ?  $select_list : $group_name),
        'MESSAGE'               => $privmsg_message,
        'HTML_STATUS'           => $html_status,
        'SMILIES_STATUS'        => $smilies_status,
        'BBCODE_STATUS'         => sprintf($bbcode_status, '<a href="' . append_sid("faq.php?mode=bbcode") . '" onclick="window.open(this.href,\'_blank\'); return false;">', '</a>'),
        'FORUM_NAME'            => $lang['Private_Message'],
        'L_SUBJECT'             => $lang['Subject'],
        'L_MESSAGE_BODY'        => $lang['Message_body'],
        'L_OPTIONS'             => $lang['Options'],
        'L_PREVIEW'             => $lang['Preview'],
        'L_SUBMIT'              => $lang['Submit'],
        'L_CANCEL'              => $lang['Cancel'],
        'L_POST_A'              => $post_a,
        'L_DISABLE_HTML'        => $lang['Disable_HTML_pm'],
        'L_DISABLE_BBCODE'      => $lang['Disable_BBCode_pm'],
        'L_DISABLE_SMILIES'     => $lang['Disable_Smilies_pm'],
        'L_ATTACH_SIGNATURE'    => $lang['Attach_signature'],
        'S_HTML_CHECKED'        => ( !$html_on ) ? ' checked="checked"' : '',
        'S_BBCODE_CHECKED'      => ( !$bbcode_on ) ? ' checked="checked"' : '',
        'S_SMILIES_CHECKED'     => ( !$smilies_on ) ? ' checked="checked"' : '',
        'S_SIGNATURE_CHECKED'   => ( $attach_sig ) ? ' checked="checked"' : '',
        'S_HIDDEN_FORM_FIELDS'  => $s_hidden_fields,
        'S_POST_ACTION'         => append_sid("privmsg.php"),
        'U_VIEW_FORUM'          => append_sid("privmsg.php"))
        );
    } else {
        $template->assign_vars(array(
        'BB_BOX'                => bbcode_table('message', 'post', 1, $privmsg_message),
        'SUBJECT'               => $privmsg_subject,
        'USERNAME'              => $to_username,
        'MESSAGE'               => $privmsg_message,
        'HTML_STATUS'           => $html_status,
        'SMILIES_STATUS'        => $smilies_status,
        'BBCODE_STATUS'         => sprintf($bbcode_status, '<a href="' . append_sid("faq.php?mode=bbcode") . '" onclick="window.open(this.href,\'_blank\'); return false;">', '</a>'),
        'FORUM_NAME'            => $lang['Private_Message'],
        'BOX_NAME'              => (isset($l_box_name) ? $l_box_name : ''),
        'INBOX_IMG'             => $inbox_img,
        'SENTBOX_IMG'           => $sentbox_img,
        'OUTBOX_IMG'            => $outbox_img,
        'SAVEBOX_IMG'           => $savebox_img,
        'INBOX'                 => $inbox_url,
        'SENTBOX'               => $sentbox_url,
        'OUTBOX'                => $outbox_url,
        'SAVEBOX'               => $savebox_url,
        'L_SUBJECT'             => $lang['Subject'],
        'L_MESSAGE_BODY'        => $lang['Message_body'],
        'L_OPTIONS'             => $lang['Options'],
        'L_SPELLCHECK'          => $lang['Spellcheck'],
        'L_PREVIEW'             => $lang['Preview'],
        'L_SUBMIT'              => $lang['Submit'],
        'L_CANCEL'              => $lang['Cancel'],
        'L_POST_A'              => $post_a,
        'L_FIND_USERNAME'       => $lang['Find_username'],
        'L_FIND'                => $lang['Find'],
        'L_DISABLE_HTML'        => $lang['Disable_HTML_pm'],
        'L_DISABLE_BBCODE'      => $lang['Disable_BBCode_pm'],
        'L_DISABLE_SMILIES'     => $lang['Disable_Smilies_pm'],
        'L_ATTACH_SIGNATURE'    => $lang['Attach_signature'],
        'L_WELCOME_PM'          => $lang['Welcome_PM'],
        'S_WELCOME_PM'          => ( $welcome_pm ) ? ' checked="checked"' : '',
        'S_HTML_CHECKED'        => ( !$html_on ) ? ' checked="checked"' : '',
        'S_BBCODE_CHECKED'      => ( !$bbcode_on ) ? ' checked="checked"' : '',
        'S_SMILIES_CHECKED'     => ( !$smilies_on ) ? ' checked="checked"' : '',
        'S_SIGNATURE_CHECKED'   => ( $attach_sig ) ? ' checked="checked"' : '',
        'S_HIDDEN_FORM_FIELDS'  => $s_hidden_fields,
        'S_POST_ACTION'         => append_sid("privmsg.php"),
        'U_SEARCH_USER'         => 'modules.php?name=Forums&amp;file=search&amp;mode=searchuser&amp;popup=1',
        'U_VIEW_FORUM'          => append_sid("privmsg.php"))
        );
    }
    $template->pparse('body');
    include(NUKE_INCLUDE_DIR.'page_tail.php');
}
//
// Default page
//
if ( !$userdata['session_logged_in'] ) {
    redirect('modules.php?name=Your_Account&amp;redirect=privmsg&amp;folder=inbox');
    exit;
}
//
// Update unread status
//
$sql = "UPDATE " . USERS_TABLE . "
        SET user_unread_privmsg = user_unread_privmsg + user_new_privmsg, user_new_privmsg = '0', user_last_privmsg = " . $userdata['session_start'] . "
        WHERE user_id = " . $userdata['user_id'];
if ( !$result=$db->sql_uquery($sql) ) {
    message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
}
$sql = "UPDATE " . PRIVMSGS_TABLE . "
        SET privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "
        WHERE privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
        AND privmsgs_to_userid = " . $userdata['user_id'];
if ( !$db->sql_uquery($sql) ) {
    message_die(GENERAL_ERROR, 'Could not update private message new/read status (2) for user', '', __LINE__, __FILE__, $sql);
}
//
// Reset PM counters
//
$userdata['user_new_privmsg'] = 0;
$userdata['user_unread_privmsg'] = ( $userdata['user_new_privmsg'] + $userdata['user_unread_privmsg'] );
//
// Generate page
//
if( empty($mode) ) {
    include_once(NUKE_INCLUDE_DIR.'page_header.php');
}
//
// Load templates
//
$template->set_filenames(array(
    'body' => 'privmsgs_body.tpl')
);

$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// New message
//
$post_new_mesg_url = '<a href="' . append_sid("privmsg.php?mode=post") . '"><img src="' . $images['post_new'] . '" alt="' . $lang['Send_a_new_message'] . '" border="0" /></a>';

//
// General SQL to obtain messages
//

$sql_tot = "SELECT COUNT(privmsgs_id) AS total
        FROM " . PRIVMSGS_TABLE . " ";
$sql = "SELECT pm.privmsgs_type, pm.privmsgs_id, pm.privmsgs_date, pm.privmsgs_subject, u.user_id, u.username
        FROM " . PRIVMSGS_TABLE . " pm, " . USERS_TABLE . " u ";

switch( $folder ) {
    case 'inbox':
        $sql_tot .= "WHERE privmsgs_to_userid = " . $userdata['user_id'] . "
                AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                        OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                        OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";

        $sql .= "WHERE pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                AND u.user_id = pm.privmsgs_from_userid
                AND ( pm.privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                        OR pm.privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                        OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
        break;
    case 'outbox':
        $sql_tot .= "WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                        OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";

        $sql .= "WHERE pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                AND u.user_id = pm.privmsgs_to_userid
                AND ( pm.privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                        OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
        break;
    case 'sentbox':
        $sql_tot .= "WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                AND privmsgs_type =  " . PRIVMSGS_SENT_MAIL;

        $sql .= "WHERE pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                AND u.user_id = pm.privmsgs_to_userid
                AND pm.privmsgs_type =  " . PRIVMSGS_SENT_MAIL;
        break;
    case 'savebox':
        $sql_tot .= "WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . "
                        AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                OR ( privmsgs_from_userid = " . $userdata['user_id'] . "
                        AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )";

        $sql .= "WHERE u.user_id = pm.privmsgs_from_userid
                AND ( ( pm.privmsgs_to_userid = " . $userdata['user_id'] . "
                        AND pm.privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                OR ( pm.privmsgs_from_userid = " . $userdata['user_id'] . "
                        AND pm.privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " ) )";
        break;
    default:
            message_die(GENERAL_MESSAGE, $lang['No_such_folder']);
            break;
}

//
// Show messages over previous x days/months
//
if ( $submit_msgdays && ( !empty($msgdays)) ) {
    $min_msg_time = time() - ($msg_days * 86400);
    $limit_msg_time_total = " AND privmsgs_date > $min_msg_time";
    $limit_msg_time = " AND pm.privmsgs_date > $min_msg_time ";
    if ( !empty($msgdays) ) {
        $start = 0;
    }
} else {
    $limit_msg_time = $limit_msg_time_total = '';
    $msg_days = 0;
}

$sql .= $limit_msg_time . " ORDER BY pm.privmsgs_date DESC LIMIT $start, " . $board_config['topics_per_page'];
$sql_all_tot = $sql_tot;
$sql_tot .= $limit_msg_time_total;

for ($i = 1; $i < 5; $i++) {
    $tot = 'tot_'.$i;
    $sql_1 = "SELECT COUNT(privmsgs_id) AS total
            FROM " . PRIVMSGS_TABLE . " ";
    switch($i) {
        // inbox (1)
        case 1:
            $sql_1 .= "WHERE privmsgs_to_userid = " . $userdata['user_id'] . "
                AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
            break;
        // sentbox (2)
        case 2:
            $sql_1 .= "WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                AND privmsgs_type =  " . PRIVMSGS_SENT_MAIL;
            break;
        case 3:
        // outbox (3)
            $sql_1 .= "WHERE privmsgs_from_userid = " . $userdata['user_id'] . "
                AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
                OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
            break;
        case 4:
            // savebox (4)
            $sql_1 .= "WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . "
                AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
                OR ( privmsgs_from_userid = " . $userdata['user_id'] . "
                AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )";
            break;
    }
    if ( !($result1 = $db->sql_query($sql_1) )) {
        message_die(GENERAL_ERROR, 'Could not query forum PM information', '', __LINE__, __FILE__, $sql_tot_pm_savebox);
    }
    while ($row1 = $db->sql_fetchrow($result1)) {
        switch ($i) {
            case 1:
                $total_inbox = $row1['total'];
                break;
            case 2:
                $total_sentbox = $row1['total'];
                break;
            case 3:
                $total_outbox = $row1['total'];
                break;
            case 4:
                $total_savebox = $row1['total'];
                break;
        }
    }
    $db->sql_freeresult($result1);
}

//
// Get messages
//
if ( !($result = $db->sql_query($sql_tot)) ) {
    message_die(GENERAL_ERROR, 'Could not query private message information', '', __LINE__, __FILE__, $sql_tot);
}

$pm_total = ( $row = $db->sql_fetchrow($result) ) ? $row['total'] : 0;
$db->sql_freeresult($result);
if ( !($result = $db->sql_query($sql_all_tot)) ) {
    message_die(GENERAL_ERROR, 'Could not query private message information', '', __LINE__, __FILE__, $sql_tot);
}

$pm_all_total = ( $row = $db->sql_fetchrow($result) ) ? $row['total'] : 0;
$db->sql_freeresult($result);

//
// Build select box
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

$select_msg_days = '';
for($i = 0; $i < count($previous_days); $i++) {
    $selected = ( $msg_days == $previous_days[$i] ) ? ' selected="selected"' : '';
    $select_msg_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}

//
// Define correct icons
//
switch ( $folder ) {
    case 'inbox':
        $l_box_name = $lang['Inbox'];
        break;
    case 'outbox':
        $l_box_name = $lang['Outbox'];
        break;
    case 'savebox':
        $l_box_name = $lang['Savebox'];
        break;
    case 'sentbox':
        $l_box_name = $lang['Sentbox'];
        break;
}
$post_pm = append_sid("privmsg.php?mode=post");
$post_pm_img = '<a href="' . $post_pm . '"><img src="' . $images['pm_postmsg'] . '" alt="' . $lang['Post_new_pm'] . '" title="' . $lang['Post_new_pm'] . '" border="0" /></a>';
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_mass_pm.php');
if ( is_admin() ) {
    $mass_pm_img = '<a href="' . append_sid("privmsg.php?mode=masspm") . '"><img src="' . $images['mass_pm'] . '" border="0" alt="' . $lang['Mass_pm'] . '" title="' . $lang['Mass_pm'] . '" /></a>';
} else {
    $sql_g = "SELECT DISTINCT g.group_id FROM ".GROUPS_TABLE . " g, ".USER_GROUP_TABLE . " ug
                WHERE g.group_single_user <> 1
                AND ((g.group_allow_pm='".AUTH_MOD."' AND g.group_moderator = '" . $userdata['user_id']."') OR
                (g.group_allow_pm='".AUTH_ACL."' AND ug.user_id = " . $userdata['user_id'] . " AND ug.group_id = g.group_id ) OR
                (g.group_allow_pm='".AUTH_REG."')
                )" ;
    if( !$g_result = $db->sql_query($sql_g) ) {
        message_die(GENERAL_ERROR, "Could not select group names!", __LINE__, __FILE__, $sql_g);
    }
    if( $db->sql_numrows($g_result)) {
        $mass_pm_img = '<a href="' . append_sid("privmsg.php?mode=masspm") . '"><img src="' . $images['mass_pm'] . '" border="0" alt="' . $lang['Mass_pm'] . '" /></a>';
    } else {
        $mass_pm_img = '&nbsp;';
    }
    $db->sql_freeresult($g_result);
}
$post_pm = '<a href="' . $post_pm . '">' . $lang['Post_new_pm'] . '</a>';

//
// Output data for inbox status
//
if ( $folder != 'outbox' ) {
    $inbox_limit_pct = ( $board_config['max_' . $folder . '_privmsgs'] > 0 ) ? round(( $pm_all_total / $board_config['max_' . $folder . '_privmsgs'] ) * 100) : 100;
    $inbox_limit_img_length = ( $board_config['max_' . $folder . '_privmsgs'] > 0 ) ? round(( $pm_all_total / $board_config['max_' . $folder . '_privmsgs'] ) * $board_config['privmsg_graphic_length']) : $board_config['privmsg_graphic_length'];
    $inbox_limit_remain = ( $board_config['max_' . $folder . '_privmsgs'] > 0 ) ? $board_config['max_' . $folder . '_privmsgs'] - $pm_all_total : 0;
    $template->assign_block_vars('switch_box_size_notice', array());
    switch( $folder ) {
        case 'inbox':
            $l_box_size_status = sprintf($lang['Inbox_size'], $inbox_limit_pct);
            break;
        case 'sentbox':
            $l_box_size_status = sprintf($lang['Sentbox_size'], $inbox_limit_pct);
            break;
        case 'savebox':
            $l_box_size_status = sprintf($lang['Savebox_size'], $inbox_limit_pct);
            break;
        default:
            $l_box_size_status = '';
            break;
    }
} else {
   $inbox_limit_img_length = $inbox_limit_pct = $l_box_size_status = '';
}

//
// Dump vars to template
//
$template->assign_vars(array(
    'BOX_NAME'              => $l_box_name,
    'INBOX_IMG'             => $inbox_img,
    'SENTBOX_IMG'           => $sentbox_img,
    'OUTBOX_IMG'            => $outbox_img,
    'SAVEBOX_IMG'           => $savebox_img,
    'INBOX'                 => $inbox_url,
    'SENTBOX'               => $sentbox_url,
    'OUTBOX'                => $outbox_url,
    'SAVEBOX'               => $savebox_url,
    'TOTAL_INBOX'           => $total_inbox,
    'TOTAL_SENTBOX'         => $total_sentbox,
    'TOTAL_OUTBOX'          => $total_outbox,
    'TOTAL_SAVEBOX'         => $total_savebox,
    'POST_PM_IMG'           => $post_pm_img,
    'MASS_PM_IMG'           => (isset($mass_pm_img) ? $mass_pm_img : ''),
    'POST_PM'               => $post_pm,
    'L_GO'                  => $lang['Go'],
    'INBOX_LIMIT_IMG_WIDTH' => $inbox_limit_img_length,
    'INBOX_LIMIT_PERCENT'   => $inbox_limit_pct,
    'LCAP_IMG'              => $images['voting_lcap'],
    'MAINBAR_IMG'           => $images['voting_graphic'][0],
    'RCAP_IMG'              => $images['voting_rcap'],
    'BOX_SIZE_STATUS'       => $l_box_size_status,
    'L_INBOX'               => $lang['Inbox'],
    'L_OUTBOX'              => $lang['Outbox'],
    'L_SENTBOX'             => $lang['Sent'],
    'L_SAVEBOX'             => $lang['Saved'],
    'L_MARK'                => $lang['Mark'],
    'L_FLAG'                => $lang['Flag'],
    'L_SUBJECT'             => $lang['Subject'],
    'L_DATE'                => $lang['Date'],
    'L_DISPLAY_MESSAGES'    => $lang['Display_messages'],
    'L_FROM_OR_TO'          => ( $folder == 'inbox' || $folder == 'savebox' ) ? $lang['From'] : $lang['To'],
    'L_MARK_ALL'            => $lang['Mark_all'],
    'L_UNMARK_ALL'          => $lang['Unmark_all'],
    'L_DELETE_MARKED'       => $lang['Delete_marked'],
    'L_DELETE_ALL'          => $lang['Delete_all'],
    'L_SAVE_MARKED'         => $lang['Save_marked'],
    'S_PRIVMSGS_ACTION'     => append_sid('privmsg.php?folder='.$folder),
    'S_HIDDEN_FIELDS'       => '',
    'S_POST_NEW_MSG'        => $post_new_mesg_url,
    'S_SELECT_MSG_DAYS'     => $select_msg_days,
    'U_POST_NEW_TOPIC'      => append_sid('privmsg.php?mode=post'))
);

//
// Okay, let's build the correct folder
//
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not query private messages', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) ) {
    $i = 0;
    do {
        $privmsg_id = $row['privmsgs_id'];
        $flag = $row['privmsgs_type'];
        $icon_flag = ( $flag == PRIVMSGS_NEW_MAIL || $flag == PRIVMSGS_UNREAD_MAIL ) ? $images['pm_unreadmsg'] : $images['pm_readmsg'];
        $icon_flag_alt = ( $flag == PRIVMSGS_NEW_MAIL || $flag == PRIVMSGS_UNREAD_MAIL ) ? $lang['Unread_message'] : $lang['Read_message'];
        $msg_userid = $row['user_id'];
        $msg_username = UsernameColor($row['username']);
        $u_from_user_profile = "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=$msg_userid";
        $msg_subject = ($board_config['smilies_in_titles']) ? smilies_pass($row['privmsgs_subject']) : $row['privmsgs_subject'];
        if ( count($orig_word) ) {
            $msg_subject = preg_replace($orig_word, $replacement_word, $msg_subject);
        }
        $u_subject = append_sid("privmsg.php?folder=$folder&amp;mode=read&amp;" . POST_POST_URL . "=$privmsg_id");
        $msg_date = create_date($board_config['default_dateformat'], $row['privmsgs_date'], $board_config['board_timezone']);
        if ( $flag == PRIVMSGS_NEW_MAIL && $folder == 'inbox' ) {
            $msg_subject = '<strong>' . $msg_subject . '</strong>';
            $msg_date = '<strong>' . $msg_date . '</strong>';
            $msg_username = '<strong>' . $msg_username . '</strong>';
        }
        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
        $i++;
        $template->assign_block_vars('listrow', array(
            'ROW_COLOR'                 => '#' . $row_color,
            'ROW_CLASS'                 => $row_class,
            'FROM'                      => $msg_username,
            'SUBJECT'                   => $msg_subject,
            'DATE'                      => $msg_date,
            'PRIVMSG_ATTACHMENTS_IMG'   => privmsgs_attachment_image($privmsg_id),
            'PRIVMSG_FOLDER_IMG'        => $icon_flag,
            'L_PRIVMSG_FOLDER_ALT'      => $icon_flag_alt,
            'S_MARK_ID'                 => $privmsg_id,
            'U_READ'                    => $u_subject,
            'U_FROM_USER_PROFILE'       => $u_from_user_profile)
            );
        } while( $row = $db->sql_fetchrow($result) );
        $template->assign_vars(array(
            'PAGINATION'    => generate_pagination("privmsg.php?folder=$folder", $pm_total, $board_config['topics_per_page'], $start),
            'PAGE_NUMBER'   => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $pm_total / $board_config['topics_per_page'] )),
            'L_GOTO_PAGE'   => $lang['Goto_page'])
        );
} else {
    $template->assign_vars(array(
        'L_NO_MESSAGES' => $lang['No_messages_folder'])
    );
    $template->assign_block_vars("switch_no_messages", array() );
}
$db->sql_freeresult($result);
if( empty($mode) ) {
    $template->pparse('body');
    include(NUKE_INCLUDE_DIR.'page_tail.php');
}

?>