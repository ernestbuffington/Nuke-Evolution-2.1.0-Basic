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

if (!defined('NUKE_EVO')) {
   die ('You can\'t access this file directly...');
}

require(NUKE_FORUMS_DIR.'nukebb.php');
define('IN_PHPBB', true);
include($phpbb_root_path . 'common.php');
$module_name = basename(dirname(__FILE__));
$title_name  = $module_name;
$logo_name   = 'groups-logo.png';

function generate_user_info(&$row, $date_format, $group_mod, &$from, &$posts, &$joined, &$poster_avatar, &$search_img, &$search) {
    global $userinfo, $lang, $images, $board_config;

    $from       = ( !empty($row['user_from']) ) ? $row['user_from'] : '&nbsp;';
    $joined     = create_date($date_format, $row['user_regdate'], $board_config['board_timezone']);
    $posts      = ( $row['user_posts'] ) ? $row['user_posts'] : 0;
    $poster_avatar = GetAvatar($row['user_id']);
    $temp_url   = append_sid('search.php?search_author=' . urlencode($row['username']) . '&amp;showresults=posts');
    $search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $row['username']) . '" title="' . sprintf($lang['Search_user_posts'], $row['username']) . '" border="0" /></a>';
    $search     = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $row['username']) . '</a>';
    return;
}
//
// --------------------------

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_GROUPCP);
init_userprefs($userdata);
//
// End session management
//

global $_GETVAR, $evoconfig, $board_config, $select_sort_mode, $select_sort_order;

$group_id       = ($_GETVAR->get(POST_GROUPS_URL, '_REQUEST', 'int')) ? $_GETVAR->get(POST_GROUPS_URL, '_REQUEST', 'int') : FALSE;
$mode           = ($_GETVAR->get('mode', '_REQUEST', 'string')) ? $_GETVAR->get('mode', '_REQUEST', 'string') : FALSE;
$confirm        = ($_GETVAR->get('confirm', '_POST', 'string')) ? TRUE : FALSE;
$cancel         = ($_GETVAR->get('cancel', '_POST', 'string')) ? TRUE : FALSE;
$sid            = $_GETVAR->get('sid', '_POST', 'string');
$start          = $_GETVAR->get('start', '_GET', 'int');
$start          = ($start <= 1) ? 0 : $start;
$groupstatus    = ($_GETVAR->get('groupstatus', '_POST', 'string')) ? TRUE : FALSE;
$grouptype      = $_GETVAR->get('group_type', '_POST', 'int');
$joingroup      = ($_GETVAR->get('joingroup', '_POST', 'string')) ? TRUE : FALSE;
$unsub          = ($_GETVAR->get('unsub', '_POST', 'string')) ? TRUE : FALSE;
$unsubpending   = ($_GETVAR->get('unsubpending', '_POST', 'string')) ? TRUE : FALSE;
$validate       = ($_GETVAR->get('validate', '_GET', 'string')) ? TRUE : FALSE;
$add            = ($_GETVAR->get('add', '_POST', 'string')) ? TRUE : FALSE;
$remove         = ($_GETVAR->get('remove', '_POST', 'string')) ? TRUE : FALSE;
$approve        = ($_GETVAR->get('approve', '_POST', 'string')) ? TRUE : FALSE;
$deny           = ($_GETVAR->get('deny', '_POST', 'string')) ? TRUE : FALSE;
$username       = $_GETVAR->get('username', '_POST', 'string', '');
$pending_members= ($_GETVAR->get('pending_members', '_POST', 'array')) ? $_GETVAR->get('pending_members', '_POST', 'array') : FALSE;
$members        = ($_GETVAR->get('members', '_POST', 'array')) ? $_GETVAR->get('members', '_POST', 'array') : FALSE;


//
// Default var values
//
$is_moderator = FALSE;
if ( !empty($groupstatus) && !empty($group_id) ) {
    if ( !is_user() ) {
        redirect('modules.php?name=Your_Account&amp;redirect=groupcp.php&amp;' . POST_GROUPS_URL . '='.$group_id);
    }
    if ($grouptype != GROUP_OPEN && $grouptype != GROUP_CLOSED && $grouptype != GROUP_HIDDEN) {
        DisplayError("<strong>"._ERROR."</strong><br /><br />Hack attempt: \"$module_name\"");
    }
    $sql = "SELECT group_moderator
            FROM " . GROUPS_TABLE . "
            WHERE group_id = '$group_id'";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    if ( $row['group_moderator'] != $userdata['user_id'] && !is_mod_admin($module_name )) {
        $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("index.php") . '" />')
        );
        $message = $lang['Not_group_moderator'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    }
    $sql = "UPDATE " . GROUPS_TABLE . "
            SET group_type = " . $grouptype . "
            WHERE group_id = '$group_id'";
    if ( !($result = $db->sql_uquery($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);
    }
    $template->assign_vars(array(
        'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '" />')
    );
    $message = $lang['Group_type_updated'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
} else if ( !empty($joingroup) && !empty($group_id) ) {
    //
    // First, joining a group
    // If the user isn't logged in redirect them to login
    //
    if ( !is_user() || !$userdata['session_logged_in'] ) {
        redirect('modules.php?name=Your_Account&amp;redirect=groupcp.php&amp;' . POST_GROUPS_URL . '='.$group_id);
    } else if ( $sid !== $userdata['session_id'] ) {
        message_die(GENERAL_ERROR, $lang['Session_invalid']);
    }
    $sql = "SELECT ug.user_id, g.group_type, group_count, group_count_max
            FROM (" . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g)
            WHERE g.group_id = '$group_id'
            AND ( g.group_type <> " . GROUP_HIDDEN . " OR (g.group_count <= '".$userdata['user_posts']."' AND g.group_count_max > '".$userdata['user_posts']."'))
            AND ug.group_id = g.group_id";
    if ( !($result = $db->sql_query($sql)) )  {
        message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);
    }
    if (  $row = $db->sql_fetchrow($result) )  {
        $is_autogroup_enable = ($row['group_count'] <= $userdata['user_posts'] && $row['group_count_max'] > $userdata['user_posts']) ? true : false;
        if ( $row['group_type'] == GROUP_OPEN || $is_autogroup_enable)  {
            do  {
                if ( $userdata['user_id'] == $row['user_id'] ) {
                    $template->assign_vars(array(
                            'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("index.php") . '" />')
                    );
                    $message = $lang['Already_member_group'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
                    message_die(GENERAL_MESSAGE, $message);
                }
            } while ( $row = $db->sql_fetchrow($result) );
            $db->sql_freeresult($result);
        } else {
            $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("index.php") . '" />')
            );
            $message = $lang['This_closed_group'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
            message_die(GENERAL_MESSAGE, $message);
        }
    } else {
        message_die(GENERAL_MESSAGE, $lang['No_groups_exist']);
    }
    $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
            VALUES ('$group_id', " . $userdata['user_id'] . ",'".(($is_autogroup_enable)? 0 : 1)."')";
    if ( !($result = $db->sql_uquery($sql)) ) {
        message_die(GENERAL_ERROR, "Error inserting user group subscription", "", __LINE__, __FILE__, $sql);
    }
    $sql = "SELECT u.user_email, u.username, u.user_lang, g.group_name
            FROM ("._USERS_TABLE . " u, ".GROUPS_TABLE." g)
            WHERE u.user_id = g.group_moderator
            AND g.group_id = '$group_id'
            AND u.user_active = '1'";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Error getting group moderator data", "", __LINE__, __FILE__, $sql);
    }
    $moderator = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    if ($is_autogroup_enable) {
        $sql_color = "SELECT group_color FROM " . GROUPS_TABLE . " WHERE group_id = '$group_id'";
        if (!$result_color = $db->sql_query($sql_color)) {
            message_die(GENERAL_ERROR, 'Could not gather group color', '', __LINE__, __FILE__, $sql);
        }
        $row_color = $db->sql_fetchrow($result_color);
        $db->sql_freeresult($result_color);
        $color = $row_color['group_color'];
        if ($color) {
            $sql_color = "SELECT group_color, group_id FROM ".AUC_TABLE." WHERE group_id = '$color'";
            if (!$result_color = $db->sql_query($sql_color)) {
                        message_die(GENERAL_ERROR, 'Could not gather group color', '', __LINE__, __FILE__, $sql);
            }
            $row_color = $db->sql_fetchrow($result_color);
            $db->sql_freeresult($result_color);
        }
        $sql_rank = "SELECT group_rank FROM " . GROUPS_TABLE . " WHERE group_id = '$group_id'";
        if (!$result_rank = $db->sql_query($sql_rank)) {
            message_die(GENERAL_ERROR, 'Could not gather group rank', '', __LINE__, __FILE__, $sql);
        }
        $row_rank = $db->sql_fetchrow($result_rank);
        $db->sql_freeresult($result_rank);
        if($row_rank['group_rank'] && !$row_color['group_color']) {
            $sql = "user_rank = '".$row_rank['group_rank']."'";
        }elseif($row_color["group_color"] && !$row_rank['group_rank']) {
            $sql = "user_color_gc = '".$row_color["group_color"]."',
                    user_color_gi  = '--".$row_color["group_id"]."--'";
        } elseif ($row_color['group_color'] && $row_rank['group_rank']) {
            $sql = "user_rank = '".$row_rank['group_rank']."',
                    user_color_gc = '".$row_color["group_color"]."',
                    user_color_gi  = '--".$row_color["group_id"]."--'";
        } else {
            $sql = '';
        }
        if ( !empty($sql) ) {
            $sql = "UPDATE " . USERS_TABLE . "
                    SET " . $sql . "
                    WHERE user_id = " . $userdata['user_id'];
            if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not add color to user', '', __LINE__, __FILE__, $sql);
            }
            $cache->delete('UserColors', 'config');
        }
        // Using new email function evo_mail()
        if ( empty($moderator['user_lang'] )) {
            $moderator['user_lang'] = $board_config['default_lang'];
        }
        $group_name = $moderator['group_name'];
        @include(NUKE_MODULES_DIR . $module_name . '/language/lang-'.$moderator['user_lang'].'.php');
        $message  = $lang_new[$module_name]['HELLO'].' '.$moderator['username'].',<br /><br />';
        $message .= $lang_new[$module_name]['GROUP_REQUEST'].'<br />';
        $message .= $lang_new[$module_name]['GROUP_REQUEST_INFO'].'<br /><br />';
        $message .= $lang_new[$module_name]['GROUP_REQUEST_LINK'].'<br >';
        $message .= "<a href='".EVO_SERVER_URL."'/modules.php?name=Groups&amp;" . POST_GROUPS_URL . "=".$group_id.">".$lang_new[$module_name]['GROUP_REQUEST_LINK_VISIT']."</a>";
        $message .= " ( ".EVO_SERVER_URL."/modules.php?name=Groups&amp;" . POST_GROUPS_URL . "=".$group_id." )<br /><br />";
        $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
        $subject = $lang_new[$module_name]['GROUP_REQUEST_SUBJECT'];
        $to      = $moderator['user_email'].','.$moderato['username'];
        $return  = evo_mail($to, $subject, $message);
    }
    $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("index.php") . '" />')
    );
    $message = ($is_autogroup_enable) ? $lang['Group_added'] : $lang['Group_joined'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
} else if ( !empty($unsub) || (!empty($unsubpending) && $group_id) ) {
    //
    // Second, unsubscribing from a group
    // Check for confirmation of unsub.
    //
    if ( !empty($cancel) ) {
        redirect('modules.php?name=groupcp.php');
    } elseif ( !is_user() || !$userdata['session_logged_in'] )  {
        redirect('modules.php?name=Your_Account&amp;redirect=groupcp.php&amp;' . POST_GROUPS_URL . '='.$group_id);
    } else if ( $sid !== $userdata['session_id'] ) {
        message_die(GENERAL_ERROR, $lang['Session_invalid']);
    }
    if ( !empty($confirm) ) {
        $sql = "UPDATE " . USERS_TABLE . "
                SET user_color_gc = '',
                user_color_gi  = '',
                user_rank = 0
                WHERE user_id = " . $userdata['user_id'];
        if ( !$db->sql_uquery($sql) ) {
            message_die(GENERAL_ERROR, 'Could not remove color from user', '', __LINE__, __FILE__, $sql);
        }
        $cache->delete('UserColors', 'config');
        $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                WHERE user_id = " . $userdata['user_id'] . "
        AND group_id = '$group_id'";
        if ( !($result = $db->sql_uquery($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not delete group memebership data', '', __LINE__, __FILE__, $sql);
        }
        if ( is_mod_admin($module_name) && $userdata['user_level'] == MOD ) {
            $sql = "SELECT COUNT(auth_mod) AS is_auth_mod
                    FROM (" . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug)
                    WHERE ug.user_id = " . $userdata['user_id'] . "
                    AND aa.group_id = ug.group_id
                    AND aa.auth_mod = '1'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain moderator status', '', __LINE__, __FILE__, $sql);
            }
            $row = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);
            if ( empty($row) || $row['is_auth_mod'] == 0 ) {
                $sql = "UPDATE " . USERS_TABLE . "
                        SET user_level = " . USER . "
                        WHERE user_id = " . $userdata['user_id'];
                if ( !($result = $db->sql_uquery($sql)) ) {
                        message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                }
            }
        }
        $template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("index.php") . '" />')
        );
        $message = $lang['Unsub_success'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    } else {
        $unsub_msg = ( !empty($unsub) ) ? $lang['Confirm_unsub'] : $lang['Confirm_unsub_pending'];
        $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" /><input type="hidden" name="unsub" value="1" />';
        $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
        $page_title = $lang['Group_Control_Panel'];
        include(NUKE_INCLUDE_DIR.'page_header.php');
        $template->set_filenames(array(
            'confirm' => 'confirm_body.tpl')
        );
        $template->assign_vars(array(
            'MESSAGE_TITLE' => $lang['Confirm'],
            'MESSAGE_TEXT' => $unsub_msg,
            'L_YES' => $lang['Yes'],
            'L_NO' => $lang['No'],
            'S_CONFIRM_ACTION' => append_sid('groupcp.php'),
            'S_HIDDEN_FIELDS' => $s_hidden_fields)
        );
        $template->pparse('confirm');
        include(NUKE_INCLUDE_DIR.'page_tail.php');
    }
} elseif ( !empty($group_id) ) {
    //
    // Did the group moderator get here through an email?
    // If so, check to see if they are logged in.
    //
    if ( !empty($validate) ) {
        if ( !is_user() ) {
            redirect('modules.php?name=Your_Account&amp;redirect=groupcp.php&amp;' . POST_GROUPS_URL . '='.$group_id);
        }
    }
    //
    // For security, get the ID of the group moderator.
    //
    $sql = "SELECT g.group_moderator, g.group_type, aa.auth_mod
            FROM ( " . GROUPS_TABLE . " g
            LEFT JOIN " . AUTH_ACCESS_TABLE . " aa ON aa.group_id = g.group_id )
            WHERE g.group_id = '$group_id'";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not get moderator information', '', __LINE__, __FILE__, $sql);
    }
    if ( $group_info = $db->sql_fetchrow($result) ) {
        $group_moderator = $group_info['group_moderator'];
        if ( $group_moderator == $userdata['user_id'] || is_mod_admin($module_name) ) {
            $is_moderator = TRUE;
        }
        //
        // Handle Additions, removals, approvals and denials
        //
        if ( !empty($add) || !empty($remove) || !empty($approve) || !empty($deny) ) {
            if ( !is_user() || !$userdata['session_logged_in'] ) {
                redirect('modules.php?name=Your_Account&amp;redirect=groupcp.php&amp;' . POST_GROUPS_URL . '='.$group_id);
            } else if ( $sid !== $userdata['session_id'] ) {
                message_die(GENERAL_ERROR, $lang['Session_invalid']);
            }
            if ( !$is_moderator ) {
                $template->assign_vars(array(
                    'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("index.php") . '" />')
                );
                $message = $lang['Not_group_moderator'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
                message_die(GENERAL_MESSAGE, $message);
            }
            if ( !empty($add ) )  {
                $username = ( !empty($username) ) ? phpbb_clean_username($username) : '';
                $sql = "SELECT user_id, user_email, user_lang, user_level
                        FROM " . USERS_TABLE . "
                        WHERE username = '" . str_replace("\'", "''", $username) . "'";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Could not get user information", $lang['Error'], __LINE__, __FILE__, $sql);
                }
                if ( !($row = $db->sql_fetchrow($result)) ) {
                    $template->assign_vars(array(
                            'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '" />')
                    );
                    $message = $lang['Could_not_add_user'] . "<br /><br />" . sprintf($lang['Click_return_group'], "<a href=\"" . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_index'], "<a href=\"" . append_sid("index.php") . "\">", "</a>");
                    message_die(GENERAL_MESSAGE, $message);
                }
                $db->sql_freeresult($result);
                if ( $row['user_id'] == ANONYMOUS ) {
                    $template->assign_vars(array(
                            'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '" />')
                    );
                    $message = $lang['Could_not_anon_user'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
                    message_die(GENERAL_MESSAGE, $message);
                }
                $sql = "SELECT ug.user_id, u.user_level
                        FROM (" . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u)
                        WHERE u.user_id = " . $row['user_id'] . "
                        AND ug.user_id = u.user_id
                        AND ug.group_id = '$group_id'";
                if ( !($result = $db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, 'Could not get user information', '', __LINE__, __FILE__, $sql);
                }
                if ( !($db->sql_fetchrow($result)) ) {
                    $sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
                            VALUES (" . $row['user_id'] . ", '$group_id', '0')";
                    if ( !$db->sql_uquery($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not add user to group', '', __LINE__, __FILE__, $sql);
                    }
                    if ( !is_mod_admin($module_name) && $group_info['auth_mod'] ) {
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET user_level = " . MOD . "
                                WHERE user_id = " . $row['user_id'];
                        if ( !$db->sql_uquery($sql) ) {
                                message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                        }
                    }
                    //
                    // Get the group name
                    // Email the user and tell them they're in the group
                    //
                    $group_sql = "SELECT group_name
                            FROM " . GROUPS_TABLE . "
                            WHERE group_id = '$group_id'";
                    if ( !($result = $db->sql_query($group_sql)) ) {
                        message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql);
                    }
                    $group_name_row = $db->sql_fetchrow($result);
                    $db->sql_freeresult($result);
                    $group_name = $group_name_row['group_name'];
                    $sql_color = "SELECT group_color FROM " . GROUPS_TABLE . " WHERE group_id = '$group_id'";
                    if (!$result_color = $db->sql_query($sql_color)) {
                        message_die(GENERAL_ERROR, 'Could not gather group color', '', __LINE__, __FILE__, $sql);
                    }
                    $row_color = $db->sql_fetchrow($result_color);
                    $db->sql_freeresult($result_color);
                    $color = $row_color['group_color'];
                    if ($color) {
                        $sql_color = "SELECT group_color, group_id FROM ".AUC_TABLE." WHERE group_id = '$color'";
                        if (!$result_color = $db->sql_query($sql_color)) {
                                    message_die(GENERAL_ERROR, 'Could not gather group color', '', __LINE__, __FILE__, $sql);
                        }
                        $row_color = $db->sql_fetchrow($result_color);
                        $db->sql_freeresult($result_color);
                    }
                    $sql_rank = "SELECT group_rank, group_name FROM " . GROUPS_TABLE . " WHERE group_id = '$group_id'";
                    if (!$result_rank = $db->sql_query($sql_rank)) {
                        message_die(GENERAL_ERROR, 'Could not gather group rank', '', __LINE__, __FILE__, $sql);
                    }
                    $row_rank = $db->sql_fetchrow($result_rank);
                    $db->sql_freeresult($result_rank);
                    if($row_rank['group_rank'] && !$row_color['group_color']) {
                        $sql = "user_rank = '".$row_rank['group_rank']."'";
                    } elseif ($row_color["group_color"] && !$row_rank['group_rank']) {
                        $sql = "user_color_gc = '".$row_color["group_color"]."',
                                  user_color_gi  = '--".$row_color["group_id"]."--'";
                    } elseif ($row_color['group_color'] && $row_rank['group_rank']) {
                        $sql = "user_rank = '".$row_rank['group_rank']."',
                                user_color_gc = '".$row_color["group_color"]."',
                                user_color_gi  = '--".$row_color["group_id"]."--'";
                    } else {
                        $sql = '';
                    }

                    if ( !empty($sql)) {
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET " . $sql . "
                                WHERE user_id = " . $row['user_id'];
                        if ( !$db->sql_uquery($sql) ) {
                                message_die(GENERAL_ERROR, 'Could not add color to user', '', __LINE__, __FILE__, $sql);
                        }
                        $cache->delete('UserColors', 'config');
                    }
                    // Using new email function evo_mail()
                    if ( empty($row['user_lang'] )) { $row['user_lang'] = $board_config['default_lang'];}
                    @include(NUKE_MODULES_DIR . $module_name . '/language/lang-'.$row['user_lang'].'.php');
                    $message  = $lang_new[$module_name]['GRATULATIONS'].'<br /><br />';
                    $message .= $lang_new[$module_name]['GROUP_ADDED'].'<br />';
                    $message .= $lang_new[$module_name]['GROUP_ADDED_INFO'].'<br /><br />';
                    $message .= $lang_new[$module_name]['GROUP_ADDED_LINK'].'<br >';
                    $message .= "<a href='".EVO_SERVER_URL."'/modules.php?name=Groups&amp;" . POST_GROUPS_URL . "=".$group_id.">".$lang_new[$module_name]['GROUP_ADDED_LINK_VISIT']."</a>";
                    $message .= " (".EVO_SERVER_URL."/modules.php?name=Groups&amp;" . POST_GROUPS_URL . "=".$group_id." )<br /><br />";
                    $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
                    $subject = $lang_new[$module_name]['GROUP_ADDED_SUBJECT'];
                    $to      = $row['user_email'].','.$row['username'];
                    $return  = evo_mail($to, $subject, $message);
                } else {
                    $template->assign_vars(array(
                            'META' => '<meta http-equiv="refresh" content="6;url=' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '" />')
                    );
                    $message = $lang['User_is_member_group'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
                    message_die(GENERAL_MESSAGE, $message);
                }
            } else {
                if ( ( ( !empty($approve) || !empty($deny) ) && !empty($pending_members) ) || ( !empty($remove) && !empty($members) ) ) {
                    $members = ( !empty($approve) || !empty($deny) ) ? $pending_members : $members;
                    $sql_in = '';
                    for($i = 0; $i < count($members); $i++) {
                        $sql_in .= ( ( $sql_in != '' ) ? ', ' : '' ) . intval($members[$i]);
                    }
                    if ( !empty($approve) ) {
                        if ( $group_info['auth_mod'] ) {
                            $sql = "UPDATE " . USERS_TABLE . "
                                    SET user_level = " . MOD . "
                                    WHERE user_id IN ($sql_in)
                                    AND user_level NOT IN (" . MOD . ", " . ADMIN . ")";
                            if ( !$db->sql_uquery($sql) ) {
                                message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                            }
                        }
                        $sql_color = "SELECT group_color FROM " . GROUPS_TABLE . " WHERE group_id = '$group_id'";
                        if (!$result_color = $db->sql_query($sql_color)) {
                           message_die(GENERAL_ERROR, 'Could not gather group color', '', __LINE__, __FILE__, $sql);
                        }
                        $row_color = $db->sql_fetchrow($result_color);
                        $db->sql_freeresult($result_color);
                        $color = $row_color['group_color'];
                        if ($color) {
                            $sql_color = "SELECT group_color, group_id FROM ".AUC_TABLE." WHERE group_id = '$color'";
                            if (!$result_color = $db->sql_query($sql_color)) {
                                message_die(GENERAL_ERROR, 'Could not gather group color', '', __LINE__, __FILE__, $sql);
                            }
                            $row_color = $db->sql_fetchrow($result_color);
                            $db->sql_freeresult($result_color);
                        }
                        $sql_rank = "SELECT group_rank FROM " . GROUPS_TABLE . " WHERE group_id = '$group_id'";
                        if (!$result_rank = $db->sql_query($sql_rank)) {
                            message_die(GENERAL_ERROR, 'Could not gather group rank', '', __LINE__, __FILE__, $sql);
                        }
                        $row_rank = $db->sql_fetchrow($result_rank);
                        $db->sql_freeresult($result_rank);
                        if($row_rank['group_rank'] && !$row_color['group_color']) {
                            $sql = "user_rank = '".$row_rank['group_rank']."'";
                        } elseif ($row_color["group_color"] && !$row_rank['group_rank']) {
                            $sql = "user_color_gc = '".$row_color["group_color"]."',
                                      user_color_gi  = '--".$row_color["group_id"]."--'";
                        } elseif ($row_color['group_color'] && $row_rank['group_rank']) {
                            $sql = "user_rank = '".$row_rank['group_rank']."',
                                    user_color_gc = '".$row_color["group_color"]."',
                                    user_color_gi  = '--".$row_color["group_id"]."--'";
                        } else {
                            $sql = '';
                        }
                        if (!empty($sql)) {
                            $sql = "UPDATE " . USERS_TABLE . "
                                    SET " . $sql . "
                                    WHERE user_id IN ($sql_in)";
                            if ( !$db->sql_uquery($sql) ) {
                                message_die(GENERAL_ERROR, 'Could not add color to user', '', __LINE__, __FILE__, $sql);
                            }
                            $cache->delete('UserColors', 'config');
                        }
                        $sql = "UPDATE " . USER_GROUP_TABLE . "
                                SET user_pending = 0
                                WHERE user_id IN ($sql_in)
                                AND group_id = '$group_id'";
                        $sql_select = "SELECT user_email, user_lang
                                FROM ". USERS_TABLE . "
                                WHERE user_id IN ($sql_in)";
                    } elseif ( !empty($deny) || !empty($remove) ) {
                        if ( $group_info['auth_mod'] ) {
                            $sql = "SELECT ug.user_id, ug.group_id
                                    FROM (" . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug)
                                    WHERE ug.user_id IN  ($sql_in)
                                    AND aa.group_id = ug.group_id
                                    AND aa.auth_mod = '1'
                                    GROUP BY ug.user_id, ug.group_id
                                    ORDER BY ug.user_id, ug.group_id";
                            if ( !($result = $db->sql_query($sql)) )  {
                                message_die(GENERAL_ERROR, 'Could not obtain moderator status', '', __LINE__, __FILE__, $sql);
                            }
                            if ( $row = $db->sql_fetchrow($result) ) {
                                $group_check = array();
                                $remove_mod_sql = '';
                                do {
                                    $group_check[$row['user_id']][] = $row['group_id'];
                                } while ( $row = $db->sql_fetchrow($result) );
                                $db->sql_freeresult($result);
                                while( list($user_id, $group_list) = @each($group_check) )  {
                                    if ( count($group_list) == 1 ) {
                                        $remove_mod_sql .= ( ( $remove_mod_sql != '' ) ? ', ' : '' ) . $user_id;
                                    }
                                }
                                if ( $remove_mod_sql != '' ) {
                                    $sql = "UPDATE " . USERS_TABLE . "
                                            SET user_level = " . USER . "
                                            WHERE user_id IN ($remove_mod_sql)
                                            AND user_level NOT IN (" . ADMIN . ")";
                                    if ( !$db->sql_uquery($sql) ) {
                                        message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                                    }
                                }
                            }
                        }
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET user_color_gc = '',
                                user_color_gi  = '',
                                user_rank = 0
                                WHERE user_id IN ($sql_in)";
                        if ( !$db->sql_uquery($sql) )  {
                            message_die(GENERAL_ERROR, 'Could not remove color from user', '', __LINE__, __FILE__, $sql);
                        }
                        $cache->delete('UserColors', 'config');
                        $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                                WHERE user_id IN ($sql_in)
                                AND group_id = '$group_id'";
                    }
                    if ( !$db->sql_uquery($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not update user group table', '', __LINE__, __FILE__, $sql);
                    }
                    //
                    // Email users when they are approved
                    //
                    if ( !empty($approve) ) {
                        if ( !($result = $db->sql_query($sql_select)) ) {
                            message_die(GENERAL_ERROR, 'Could not get user email information', '', __LINE__, __FILE__, $sql);
                        }
                        $bcc_list = array();
                        while ($row = $db->sql_fetchrow($result)) {
                            $bcc_list[] = $row['user_email'];
                            $language = $row['user_lang'];
                            $bcc_language[] = $language;
                            $bcc_lang[$language] = $language;
                        }
                        $db->sql_freeresult($result);
                        //
                        // Get the group name
                        //
                        $group_sql = "SELECT group_name
                                FROM " . GROUPS_TABLE . "
                                WHERE group_id = '$group_id'";
                        if ( !($result = $db->sql_query($group_sql)) ) {
                            message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql);
                        }
                        $group_name_row = $db->sql_fetchrow($result);
                        $db->sql_freeresult($result);
                        $group_name = $group_name_row['group_name'];
                        foreach ($bcc_lang as $lang_file) {
                            @include_once(NUKE_MODULES_DIR . $module_name .'/language/lang-'.$lang_file.'.php');
                            $lang_content[$lang_file] = $lang_new;
                        }
                        // Using new email function evo_mail()
                        for ($i=0; $i < count($bcc_list); $i++) {
                            $message  = $lang_content[($bcc_language[$i])][$module_name]['GRATULATIONS'].'<br /><br />';
                            $message .= $lang_content[($bcc_language[$i])][$module_name]['GROUP_APPROVED'].'<br />';
                            $message .= $lang_content[($bcc_language[$i])][$module_name]['GROUP_APPROVED_INFO'].'<br /><br />';
                            $message .= $lang_content[($bcc_language[$i])][$module_name]['GROUP_APPROVED_LINK'].'<br >';
                            $message .= "<a href='".EVO_SERVER_URL."'/modules.php?name=Groups&amp;" . POST_GROUPS_URL . "=".$group_id.">".$lang_content[($bcc_language[$i])][$module_name]['GROUP_APPROVED_LINK_VISIT']."</a>";
                            $message .= " ( ".EVO_SERVER_URL."/modules.php?name=Groups&amp;" . POST_GROUPS_URL . "=".$group_id.")<br /><br />";
                            $message .= (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '';
                            $subject = $lang_content[($bcc_language[$i])][$module_name]['GROUP_APPROVED_SUBJECT'];
                            $return  = evo_mail($bcc_list[$i], $subject, $message);
                        }
                    }
                }
            }
        }
            //
            // END approve or deny
            //
    } else {
        message_die(GENERAL_MESSAGE, $lang['No_groups_exist']);
    }
    //
    // Get group details
    //
    $sql = "SELECT *
            FROM " . GROUPS_TABLE . "
            WHERE group_id = '$group_id'
            AND group_single_user = '0'";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
    }
    if ( !($group_info = $db->sql_fetchrow($result)) ) {
        message_die(GENERAL_MESSAGE, $lang['Group_not_exist']);
    }
    $db->sql_freeresult($result);
    //
    // Get moderator details for this group
    //
    $sql = "SELECT username, user_id, user_viewemail, user_posts, user_regdate, user_from, user_website, user_email, user_icq, user_aim, user_yim, user_msnm, user_allow_viewonline, user_session_time
            FROM " . USERS_TABLE . "
            WHERE user_id = " . $group_info['group_moderator'];
    if ( !($result = $db->sql_query($sql)) )  {
        message_die(GENERAL_ERROR, 'Error getting user list for group', '', __LINE__, __FILE__, $sql);
    }
    $group_moderator = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    if(!$group_moderator) {
       message_die(GENERAL_ERROR, 'Error getting moderator for group');
    }
    //
    // Get user information for this group
    //
    $sql = "SELECT u.username, u.user_id, u.user_viewemail, u.user_posts, u.user_regdate, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_msnm, ug.user_pending, u.user_allow_viewonline, u.user_session_time
            FROM (" . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug)
            WHERE ug.group_id = '$group_id'
            AND u.user_id = ug.user_id
            AND ug.user_pending = '0'
            AND ug.user_id <> " . $group_moderator['user_id'] . "
            AND u.user_active = '1'
            ORDER BY u.username";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Error getting user list for group', '', __LINE__, __FILE__, $sql);
    }
    $group_members = $db->sql_fetchrowset($result);
    $members_count = count($group_members);
    $db->sql_freeresult($result);
    $sql = "SELECT u.username, u.user_id, u.user_viewemail, u.user_posts, u.user_regdate, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_msnm, u.user_allow_viewonline, u.user_session_time
            FROM (" . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u)
            WHERE ug.group_id = '$group_id'
            AND g.group_id = ug.group_id
            AND ug.user_pending = '1'
            AND u.user_id = ug.user_id
            AND u.user_active = '1'
            ORDER BY u.username";
    if ( !($result = $db->sql_query($sql)) )  {
        message_die(GENERAL_ERROR, 'Error getting user pending information', '', __LINE__, __FILE__, $sql);
    }
    $modgroup_pending_list = $db->sql_fetchrowset($result);
    $modgroup_pending_count = count($modgroup_pending_list);
    $db->sql_freeresult($result);
    $is_group_member = 0;
    if ( $members_count > 0) {
        for($i = 0; $i <= $members_count; $i++) {
            if ( isset($group_members[$i]['user_id']) && ($group_members[$i]['user_id'] == $userdata['user_id']) && is_user() ) {
                $is_group_member = TRUE;
            }
        }
    }
    $is_group_pending_member = 0;
    $is_autogroup_enable = ($group_info['group_count'] <= $userdata['user_posts'] && $group_info['group_count_max'] > $userdata['user_posts']) ? true : false;
    if ( $modgroup_pending_count )  {
        for($i = 0; $i <= $modgroup_pending_count; $i++) {
            if ( $modgroup_pending_list[$i]['user_id'] == $userdata['user_id'] && is_user() )  {
                $is_group_pending_member = TRUE;
            }
        }
    }
    if ( is_mod_admin($module_name) ) {
        $is_moderator = TRUE;
    }
    if ( $userdata['user_id'] == $group_info['group_moderator'] ) {
        $is_moderator = TRUE;
        $group_details =  $lang['Are_group_moderator'];
        $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
    } else if ( $is_group_member || $is_group_pending_member ) {
        $template->assign_block_vars('switch_unsubscribe_group_input', array());
        $group_details =  ( $is_group_pending_member ) ? $lang['Pending_this_group'] : $lang['Member_this_group'];
        $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
    } else if ( $userdata['user_id'] == ANONYMOUS ) {
        $group_details =  $lang['Login_to_join'];
        $s_hidden_fields = '';
    } else {
        if ( $group_info['group_type'] == GROUP_OPEN ) {
           $template->assign_block_vars('switch_subscribe_group_input', array());
           $group_details =  $lang['This_open_group'];
           $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
        }
        else if ( $group_info['group_type'] == GROUP_CLOSED ) {
            if ($is_autogroup_enable) {
                $template->assign_block_vars('switch_subscribe_group_input', array());
                $group_details =  sprintf ($lang['This_closed_group'],$lang['Join_auto']);
                $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
            } else {
                $group_details =  sprintf ($lang['This_closed_group'],$lang['No_more']);
                $s_hidden_fields = '';
            }
        } elseif ( $group_info['group_type'] == GROUP_HIDDEN ) {
            if ($is_autogroup_enable) {
               $template->assign_block_vars('switch_subscribe_group_input', array());
               $group_details =  sprintf ($lang['This_hidden_group'],$lang['Join_auto']);
               $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
            } else {
               $group_details =  sprintf ($lang['This_closed_group'],$lang['No_add_allowed']);
               $s_hidden_fields = '';
            }
        }
    }
    $page_title = $lang['Group_Control_Panel'];
    include_once(NUKE_INCLUDE_DIR.'page_header.php');
    //
    // Load templates
    //
    $template->set_filenames(array(
        'info' => 'groupcp_info_body.tpl',
        'pendinginfo' => 'groupcp_pending_info.tpl')
    );
    make_jumpbox('viewforum.php');
    //
    // Add the moderator
    //
    $username    = UsernameColor($group_moderator['username']);
    $user_id     = $group_moderator['user_id'];
    generate_user_info($group_moderator, $board_config['default_dateformat'], $is_moderator, $from, $posts, $joined, $poster_avatar, $search_img, $search);
    $contact_img = EvoKernel_UserContactImg($group_moderator);
    $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
    $template->assign_vars(array(
        'L_GROUP_INFORMATION'   => $lang['Group_Information'],
        'L_GROUP_NAME'          => $lang['Group_name'],
        'L_GROUP_DESC'          => $lang['Group_description'],
        'L_GROUP_TYPE'          => $lang['Group_type'],
        'L_GROUP_MEMBERSHIP'    => $lang['Group_membership'],
        'L_SUBSCRIBE'           => $lang['Subscribe'],
        'L_UNSUBSCRIBE'         => $lang['Unsubscribe'],
        'L_JOIN_GROUP'          => $lang['Join_group'],
        'L_UNSUBSCRIBE_GROUP'   => $lang['Unsubscribe'],
        'L_GROUP_OPEN'          => $lang['Group_open'],
        'L_GROUP_CLOSED'        => $lang['Group_closed'],
        'L_GROUP_HIDDEN'        => $lang['Group_hidden'],
        'L_UPDATE'              => $lang['Update'],
        'L_GROUP_MODERATOR'     => $lang['Group_Moderator'],
        'L_GROUP_MEMBERS'       => $lang['Group_Members'],
        'L_PENDING_MEMBERS'     => $lang['Pending_members'],
        'L_SELECT_SORT_METHOD'  => $lang['Select_sort_method'],
        'L_PM'                  => $lang['Private_Message'],
        'L_EMAIL'               => $lang['Email'],
        'L_POSTS'               => $lang['Posts'],
        'L_WEBSITE'             => $lang['Website'],
        'L_FROM'                => $lang['Location'],
        'L_ORDER'               => $lang['Order'],
        'L_SORT'                => $lang['Sort'],
        'L_SUBMIT'              => $lang['Sort'],
        'L_AIM'                 => $lang['AIM'],
        'L_YIM'                 => $lang['YIM'],
        'L_MSNM'                => $lang['MSNM'],
        'L_ICQ'                 => $lang['ICQ'],
        'L_SELECT'              => $lang['Select'],
        'L_REMOVE_SELECTED'     => $lang['Remove_selected'],
        'L_ADD_MEMBER'          => $lang['Add_member'],
        'L_FIND_USERNAME'       => $lang['Find_username'],
        'GROUP_NAME'            => GroupColor($group_info['group_name']),
        'GROUP_DESC'            => $group_info['group_description'] . "&nbsp;",
        'GROUP_DETAILS'         => $group_details,
        'MOD_ROW_COLOR'         => '#' . $theme['td_color1'],
        'MOD_ROW_CLASS'         => $theme['td_class1'],
        'MOD_USERNAME'          => $username,
        'MOD_FROM'              => $from,
        'MOD_JOINED'            => $joined,
        'MOD_POSTS'             => $posts,
        'MOD_AVATAR_IMG'        => $poster_avatar,
        'MOD_PROFILE_IMG'       => $contact_img['profile_img'],
        'MOD_PROFILE'           => $contact_img['profile'],
        'MOD_SEARCH_IMG'        => $search_img,
        'MOD_SEARCH'            => $search,
        'MOD_PM_IMG'            => $contact_img['pm_img'],
        'MOD_PM'                => $contact_img['pm'],
        'MOD_EMAIL_IMG'         => $contact_img['email_img'],
        'MOD_EMAIL'             => $contact_img['email'],
        'MOD_WWW_IMG'           => $contact_img['www_img'],
        'MOD_WWW'               => $contact_img['www'],
        'MOD_ICQ_STATUS_IMG'    => $contact_img['icq_status_img'],
        'MOD_ICQ_IMG'           => $contact_img['icq_img'],
        'MOD_ICQ'               => $contact_img['icq_noscript'],
        'MOD_AIM_IMG'           => $contact_img['aim_img'],
        'MOD_AIM'               => $contact_img['aim'],
        'MOD_MSN_IMG'           => $contact_img['msn_img'],
        'MOD_MSN'               => $contact_img['msn'],
        'MOD_YIM_STATUS_IMG'    => $contact_img['yim_status_img'],
        'MOD_YIM_IMG'           => $contact_img['yim_img'],
        'MOD_YIM'               => $contact_img['yim_noscript'],
        'MOD_ONLINE_STATUS_IMG' => $contact_img['online_status_img'],
        'MOD_ONLINE_STATUS'     => $contact_img['online_status'],
        'L_ONLINE_STATUS'       => $lang['Online_status'],
        'U_MOD_VIEWPROFILE'     => append_sid('profile.php?mode=viewprofile&amp;' . POST_USERS_URL . '='.$user_id),
        'U_SEARCH_USER'         => append_sid('search.php?mode=searchuser&amp;popup=1'),
        'S_GROUP_OPEN_TYPE'     => GROUP_OPEN,
        'S_GROUP_CLOSED_TYPE'   => GROUP_CLOSED,
        'S_GROUP_HIDDEN_TYPE'   => GROUP_HIDDEN,
        'S_GROUP_OPEN_CHECKED'  => ( $group_info['group_type'] == GROUP_OPEN ) ? ' checked="checked"' : '',
        'S_GROUP_CLOSED_CHECKED'=> ( $group_info['group_type'] == GROUP_CLOSED ) ? ' checked="checked"' : '',
        'S_GROUP_HIDDEN_CHECKED'=> ( $group_info['group_type'] == GROUP_HIDDEN ) ? ' checked="checked"' : '',
        'S_HIDDEN_FIELDS'       => $s_hidden_fields,
        'S_MODE_SELECT'         => $select_sort_mode,
        'S_ORDER_SELECT'        => $select_sort_order,
        'S_GROUPCP_ACTION'      => append_sid('groupcp.php?' . POST_GROUPS_URL . '='.$group_id))
    );

    //
    // Dump out the remaining users
    //
    for($i = $start; $i < min($board_config['topics_per_page'] + $start, $members_count); $i++) {
        $username    = UsernameColor($group_members[$i]['username']);
        $user_id     = $group_members[$i]['user_id'];
        generate_user_info($group_members[$i], $board_config['default_dateformat'], $is_moderator, $from, $posts, $joined, $poster_avatar, $search_img, $search);
        $contact_img = EvoKernel_UserContactImg($group_members[$i]);
        if ( $group_info['group_type'] != GROUP_HIDDEN || $is_group_member || $is_moderator )  {
            $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
            $template->assign_block_vars('member_row', array(
                'ROW_COLOR'         => '#' . $row_color,
                'ROW_CLASS'         => $row_class,
                'USERNAME'          => $username,
                'FROM'              => $from,
                'JOINED'            => $joined,
                'POSTS'             => $posts,
                'USER_ID'           => $user_id,
                'AVATAR_IMG'        => $poster_avatar,
                'PROFILE_IMG'       => $contact_img['profile_img'],
                'PROFILE'           => $contact_img['profile'],
                'SEARCH_IMG'        => $search_img,
                'SEARCH'            => $search,
                'PM_IMG'            => $contact_img['pm_img'],
                'PM'                => $contact_img['pm'],
                'EMAIL_IMG'         => $contact_img['email_img'],
                'EMAIL'             => $contact_img['email'],
                'WWW_IMG'           => $contact_img['www_img'],
                'WWW'               => $contact_img['www'],
                'ICQ_STATUS_IMG'    => $contact_img['icq_status_img'],
                'ICQ_IMG'           => $contact_img['icq_img'],
                'ICQ'               => $contact_img['icq_noscript'],
                'AIM_IMG'           => $contact_img['aim_img'],
                'AIM'               => $contact_img['aim'],
                'MSN_IMG'           => $contact_img['msn_img'],
                'MSN'               => $contact_img['msn'],
                'YIM_STATUS_IMG'    => $contact_img['yim_status_img'],
                'YIM_IMG'           => $contact_img['yim_img'],
                'YIM'               => $contact_img['yim_noscript'],
                'ONLINE_STATUS_IMG' => $contact_img['online_status_img'],
                'ONLINE_STATUS'     => $contact_img['online_status'],
                'U_VIEWPROFILE'     => append_sid('profile.php?mode=viewprofile&amp;' . POST_USERS_URL . '='.$user_id))
            );
            if ( $is_moderator ) {
                $template->assign_block_vars('member_row.switch_mod_option', array());
            }
        }
    }
    if ( empty($members_count) || $members_count <= 0 ) {
        //
        // No group members
        //
        $template->assign_block_vars('switch_no_members', array());
        $template->assign_vars(array(
            'L_NO_MEMBERS' => $lang['No_group_members'])
        );
    }
    $current_page = ( !$members_count ) ? 1 : ceil( $members_count / $board_config['topics_per_page'] );
    $template->assign_vars(array(
        'PAGINATION'  => generate_pagination('groupcp.php?' . POST_GROUPS_URL . '='.$group_id, $members_count, $board_config['topics_per_page'], $start),
        'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), $current_page ),
        'L_GOTO_PAGE' => $lang['Goto_page'])
    );
    if ( $group_info['group_type'] == GROUP_HIDDEN && !$is_group_member && !$is_moderator ) {
        //
        // No group members
        //
        $template->assign_block_vars('switch_hidden_group', array());
        $template->assign_vars(array(
            'L_HIDDEN_MEMBERS' => $lang['Group_hidden_members'])
        );
    }
    //
    // We've displayed the members who belong to the group, now we
    // do that pending memebers...
    //
    if ( $is_moderator ) {
        //
        // Users pending in ONLY THIS GROUP (which is moderated by this user)
        //
        if ( $modgroup_pending_count ) {
            for($i = 0; $i < $modgroup_pending_count; $i++) {
                $username    = UsernameColor($modgroup_pending_list[$i]['username']);
                $user_id     = $modgroup_pending_list[$i]['user_id'];
                generate_user_info($modgroup_pending_list[$i], $board_config['default_dateformat'], $is_moderator, $from, $posts, $joined, $poster_avatar, $search_img, $search);
                $contact_img = EvoKernel_UserContactImg($modgroup_pending_list[$i]);
                $row_color   = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class   = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
                $user_select = '<input type="checkbox" name="member[]" value="' . $user_id . '">';
                $template->assign_block_vars('pending_members_row', array(
                    'ROW_CLASS'         => $row_class,
                    'ROW_COLOR'         => '#' . $row_color,
                    'USERNAME'          => $username,
                    'FROM'              => $from,
                    'JOINED'            => $joined,
                    'POSTS'             => $posts,
                    'USER_ID'           => $user_id,
                    'AVATAR_IMG'        => $poster_avatar,
                    'PROFILE_IMG'       => $contact_img['profile_img'],
                    'PROFILE'           => $contact_img['profile'],
                    'SEARCH_IMG'        => $search_img,
                    'SEARCH'            => $search,
                    'PM_IMG'            => $contact_img['pm_img'],
                    'PM'                => $contact_img['pm'],
                    'EMAIL_IMG'         => $contact_img['email_img'],
                    'EMAIL'             => $contact_img['email'],
                    'WWW_IMG'           => $contact_img['www_img'],
                    'WWW'               => $contact_img['www'],
                    'ICQ_STATUS_IMG'    => $contact_img['icq_status_img'],
                    'ICQ_IMG'           => $contact_img['icq_img'],
                    'ICQ'               => $contact_img['icq_noscript'],
                    'AIM_IMG'           => $contact_img['aim_img'],
                    'AIM'               => $contact_img['aim'],
                    'MSN_IMG'           => $contact_img['msn_img'],
                    'MSN'               => $contact_img['msn'],
                    'YIM_STATUS_IMG'    => $contact_img['yim_status_img'],
                    'YIM_IMG'           => $contact_img['yim_img'],
                    'YIM'               => $contact_img['yim_noscript'],
                    'ONLINE_STATUS_IMG' => $contact_img['online_status_img'],
                    'ONLINE_STATUS'     => $contact_img['online_status'],
                    'U_VIEWPROFILE'     => append_sid('profile.php?mode=viewprofile&amp;' . POST_USERS_URL . '='.$user_id))
                );
            }
            $template->assign_block_vars('switch_pending_members', array() );
            $template->assign_vars(array(
                'L_SELECT'          => $lang['Select'],
                'L_APPROVE_SELECTED'=> $lang['Approve_selected'],
                'L_DENY_SELECTED'   => $lang['Deny_selected'])
            );
            $template->assign_var_from_handle('PENDING_USER_BOX', 'pendinginfo');
        }
    }
    if ( $is_moderator ) {
        $template->assign_block_vars('switch_mod_option', array());
        $template->assign_block_vars('switch_add_member', array());
    }
    $template->pparse('info');
} else {
    //
    // Show the main groupcp.php screen where the user can select a group.
    //
    // Select all group that the user is a member of or where the user has
    // a pending membership.
    //
    $in_group = array();
    $s_pending_groups_opt = '';
    $s_member_groups_opt  = '';
    $s_pending_groups     = '';
    $s_member_groups      = '';
    if ( is_user() ) {
        $sql = "SELECT g.group_id, g.group_name, g.group_type, ug.user_pending
                FROM (" . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug)
                WHERE ug.user_id = " . $userdata['user_id'] . "
                AND ug.group_id = g.group_id
                AND g.group_single_user <> " . TRUE . "
                ORDER BY g.group_name, ug.user_id";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
        }
        if ( $row = $db->sql_fetchrow($result) ) {
            do  {
                $in_group[] = $row['group_id'];
                if ( $row['user_pending'] )  {
                    $s_pending_groups_opt .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
                } else {
                    $s_member_groups_opt .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
                }
            } while( $row = $db->sql_fetchrow($result) );
            $db->sql_freeresult($result);
            $s_pending_groups = '<select name="' . POST_GROUPS_URL . '">' . $s_pending_groups_opt . "</select>";
            $s_member_groups  = '<select name="' . POST_GROUPS_URL . '">' . $s_member_groups_opt . "</select>";
        }
    }
    //
    // Select all other groups i.e. groups that this user is not a member of
    //
    $ignore_group_sql = ( count($in_group) ) ? "AND group_id NOT IN (" . implode(', ', $in_group) . ")" : '';
    $sql = "SELECT group_id, group_name, group_type, group_count , group_count_max
            FROM " . GROUPS_TABLE . " g
            WHERE group_single_user <> " . TRUE . "
                    $ignore_group_sql
            ORDER BY g.group_name";
    if ( !($result = $db->sql_query($sql)) )  {
        message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
    }
    $s_group_list_opt = '';
    while( $row = $db->sql_fetchrow($result) )  {
        $is_autogroup_enable = ($row['group_count'] <= $userdata['user_posts'] && $row['group_count_max'] > $userdata['user_posts']) ? true : false;
        if  ( $row['group_type'] != GROUP_HIDDEN || is_mod_admin($module_name) || $is_autogroup_enable) {
            $s_group_list_opt .='<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
        }
    }
    $s_group_list = '<select name="' . POST_GROUPS_URL . '">' . $s_group_list_opt . '</select>';
    if ( $s_group_list_opt != '' || $s_pending_groups_opt != '' || $s_member_groups_opt != '' ) {
        //
        // Load and process templates
        //
        $page_title = $lang['Group_Control_Panel'];
        include(NUKE_INCLUDE_DIR.'page_header.php');
        $template->set_filenames(array(
            'user' => 'groupcp_user_body.tpl')
        );
        make_jumpbox('viewforum.php');
        if ( $s_pending_groups_opt != '' || $s_member_groups_opt != '' )  {
            $template->assign_block_vars('switch_groups_joined', array() );
        }
        if ( $s_member_groups_opt != '' ) {
            $template->assign_block_vars('switch_groups_joined.switch_groups_member', array() );
        }
        if ( $s_pending_groups_opt != '' ) {
            $template->assign_block_vars('switch_groups_joined.switch_groups_pending', array() );
        }
        if ( $s_group_list_opt != '' ) {
            $template->assign_block_vars('switch_groups_remaining', array() );
        }
        $s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
        $template->assign_vars(array(
            'L_GROUP_MEMBERSHIP_DETAILS'=> $lang['Group_member_details'],
            'L_JOIN_A_GROUP'            => $lang['Group_member_join'],
            'L_YOU_BELONG_GROUPS'       => $lang['Current_memberships'],
            'L_SELECT_A_GROUP'          => $lang['Non_member_groups'],
            'L_PENDING_GROUPS'          => $lang['Memberships_pending'],
            'L_SUBSCRIBE'               => $lang['Subscribe'],
            'L_UNSUBSCRIBE'             => $lang['Unsubscribe'],
            'L_VIEW_INFORMATION'        => $lang['View_Information'],
            'S_USERGROUP_ACTION'        => append_sid('groupcp.php'),
            'S_HIDDEN_FIELDS'           => $s_hidden_fields,
            'GROUP_LIST_SELECT'         => $s_group_list,
            'GROUP_PENDING_SELECT'      => $s_pending_groups,
            'GROUP_MEMBER_SELECT'       => $s_member_groups)
        );
        $template->pparse('user');
    } else {
        message_die(GENERAL_MESSAGE, $lang['No_groups_exist']);
    }
}
include(NUKE_INCLUDE_DIR.'page_tail.php');

?>