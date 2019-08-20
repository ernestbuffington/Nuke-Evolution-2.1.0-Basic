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

if (!defined('ADMIN_FILE') && !defined('FORUM_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (defined('PHPBB_BOARD_CONFIG')) {
    if( !empty($setmodules) ) {
        $filename = basename(__FILE__);
        $module['Groups']['Group_Overview'] = $filename;
        return;
    }
}

global $_GETVAR;

//
// Set mode
//
$mode = $_GETVAR->get('mode', 'request', 'string', '');

// Delete User
if ($mode == 'delete') {
    $group_id = $_GETVAR->get('g', 'get', 'int', NULL) ? $_GETVAR->get('g', 'get', 'int') : message_die(GENERAL_ERROR, 'Could not get group id');
    $user_id = $_GETVAR->get('u', 'get', 'int', NULL) ? $_GETVAR->get('u', 'get', 'int') : message_die(GENERAL_ERROR, 'Could not get user id');

    $sql = "SELECT g.*, aa.auth_mod
            FROM ". GROUPS_TABLE ." g, ". AUTH_ACCESS_TABLE ." aa
            WHERE g.group_id = $group_id
            AND aa.group_id = g.group_id";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
    }
    $group_info = $db->sql_fetchrow($result);

    if ( $group_info['auth_mod'] ) {
        $sql = "UPDATE " . USERS_TABLE . "
                SET user_level = 0
                WHERE user_id = $user_id
                AND user_level != 1";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
        }
    }

    if ( $user_id != $group_info['group_moderator'] ) {
        $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                WHERE user_id = $user_id
                AND group_id = $group_id";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not update user group table', '', __LINE__, __FILE__, $sql);
        }
        remove_group_attributes($user_id, $group_id);

        $message = $lang['GO_remove_member'] .'<br /><br />'. sprintf($lang['Click_return_go'], '<a href="'. admin_sid("admin_group_overview.php") .'">', '</a>') .'<br /><br />'. sprintf($lang['Click_return_admin_index'], '<a href=\"'. admin_sid("index.php&amp;pane=right") .'\">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    } else {
        $message = $lang['GO_remove_mod'] . '<br /><br />' . sprintf($lang['Click_return_go'], '<a href="' . admin_sid("admin_group_overview.php") . '">', '</a>') .'<br /><br />'. sprintf($lang['Click_return_admin_index'], '<a href=\"'. admin_sid("index.php&amp;pane=right") .'\">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    }
}

// Update Group
if ( $_GETVAR->get('submit', 'post', 'string', NULL) ) {
    $group_id = $_GETVAR->get('group_id', 'post', 'int', NULL);

    if ( $_GETVAR->get('group_delete_user', 'post', 'string', NULL) ) {
        $sql = "SELECT g.group_moderator, aa.auth_mod
                FROM ". GROUPS_TABLE ." g, ". AUTH_ACCESS_TABLE ." aa
                WHERE g.group_id = $group_id
                AND aa.group_id = g.group_id";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
        }
        $auth = $db->sql_fetchrow($result);

        if ( $auth['auth_mod'] ) {
            $sql = "SELECT ug.user_id
                    FROM ". GROUPS_TABLE ." g, ". USER_GROUP_TABLE ." ug
                    WHERE g.group_id = $group_id
                    AND ug.group_id = g.group_id
                    AND ug.user_id != g.group_moderator";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not get group user', '', __LINE__, __FILE__, $sql);
            }
            $group_info = array();
            while ( $row = $db->sql_fetchrow($result) ) {
                $group_info[] = $row;
            }

            for($i = 0; $i < count($group_info); $i++) {
                remove_group_attributes($group_info[$i]['user_id'], $group_id);
                $sql = "UPDATE " . USERS_TABLE . "
                        SET user_level = 0
                        WHERE user_id = ". $group_info[$i]['user_id'] ."
                        AND user_level != 1";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                }
            }
        }

        $sql = "DELETE FROM ". USER_GROUP_TABLE ."
                WHERE group_id = $group_id
                AND user_id != ". $auth['group_moderator'];
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not delete group users', '', __LINE__, __FILE__, $sql);
        }

        $message = $lang['group_users_removed'] . '<br /><br />' . sprintf($lang['Click_return_go'], '<a href="' . admin_sid("admin_group_overview.php") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');

        message_die(GENERAL_MESSAGE, $message);
    }

    if ( $_GETVAR->get('group_delete', 'post', 'string', NULL) ) {
        //
        // Reset User Moderator Level
        //

        // Is Group moderating a forum ?
        $sql = "SELECT auth_mod FROM " . AUTH_ACCESS_TABLE . "
                WHERE group_id = " . $group_id;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not select auth_access', '', __LINE__, __FILE__, $sql);
        }

        $row = $db->sql_fetchrow($result);
        if (intval($row['auth_mod']) == 1) {
            // Yes, get the assigned users and update their Permission if they are no longer moderator of one of the forums
            $sql = "SELECT user_id FROM " . USER_GROUP_TABLE . "
                    WHERE group_id = " . $group_id;
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not select user_group', '', __LINE__, __FILE__, $sql);
            }

            $rows = $db->sql_fetchrowset($result);
            for ($i = 0; $i < count($rows); $i++) {
                $sql = "SELECT g.group_id FROM " . AUTH_ACCESS_TABLE . " a, " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug
                        WHERE (a.auth_mod = 1) AND (g.group_id = a.group_id) AND (a.group_id = ug.group_id) AND (g.group_id = ug.group_id)
                        AND (ug.user_id = " . intval($rows[$i]['user_id']) . ") AND (ug.group_id <> " . $group_id . ")";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not obtain moderator permissions', '', __LINE__, __FILE__, $sql);
                }
                if ($db->sql_numrows($result) == 0) {
                    $sql = "UPDATE " . USERS_TABLE . " SET user_level = " . USER . "
                            WHERE user_level = " . MOD . " AND user_id = " . intval($rows[$i]['user_id']);
                    if ( !$db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not update moderator permissions', '', __LINE__, __FILE__, $sql);
                    }
                }
            }
        }

        //
        // Delete Group
        //
        $sql = "DELETE FROM " . GROUPS_TABLE . "
                WHERE group_id = " . $group_id;
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not update group', '', __LINE__, __FILE__, $sql);
        }
        $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                WHERE group_id = " . $group_id;
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not update user_group', '', __LINE__, __FILE__, $sql);
        }

        $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                WHERE group_id = " . $group_id;
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not update auth_access', '', __LINE__, __FILE__, $sql);
        }
        remove_group_attributes('', $group_id);
        $message = $lang['Deleted_group'] . '<br /><br />' . sprintf($lang['Click_return_go'], '<a href="' . admin_sid("admin_group_overview.php") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    } else {
        $group_type           = $_GETVAR->get('group_type', 'post', 'int', GROUP_OPEN);
        $group_name           = trim( $_GETVAR->get('group_name', 'post', 'string', '') );
        $group_description    = trim( $_GETVAR->get('group_description', 'post', 'string', ''));
        $group_moderator      = $_GETVAR->get('group_mod', 'post', 'string', '');
        $delete_old_moderator = $_GETVAR->get('delete_old_moderator', 'post', 'int', FALSE);

        if ( $group_name == '' ) {
            message_die(GENERAL_MESSAGE, $lang['No_group_name']);
        } else if ( $group_moderator == '' ) {
            message_die(GENERAL_MESSAGE, $lang['No_group_moderator']);
        }
        $this_userdata = get_userdata($group_moderator, true);
        $group_moderator = $this_userdata['user_id'];

        if ( !$group_moderator ) {
            message_die(GENERAL_MESSAGE, $lang['No_group_moderator']);
        }
        $sql = "SELECT *
                FROM " . GROUPS_TABLE . "
                WHERE group_single_user <> " . TRUE . "
                AND group_id = " . $group_id;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
        }
        if( !($group_info = $db->sql_fetchrow($result)) ) {
            message_die(GENERAL_MESSAGE, $lang['Group_not_exist']);
        }
        if ( $group_info['group_moderator'] != $group_moderator ) {
            if ( $delete_old_moderator ) {
                $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                        WHERE user_id = " . $group_info['group_moderator'] . "
                        AND group_id = " . $group_id;
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not update group moderator', '', __LINE__, __FILE__, $sql);
                }
            }

            $sql = "SELECT user_id
                    FROM " . USER_GROUP_TABLE . "
                    WHERE user_id = $group_moderator
                    AND group_id = $group_id";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Failed to obtain current group moderator info', '', __LINE__, __FILE__, $sql);
            }

            if ( !($row = $db->sql_fetchrow($result)) ) {
                $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                        VALUES (" . $group_id . ", " . $group_moderator . ", 0)";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not update group moderator', '', __LINE__, __FILE__, $sql);
                }
            }
        }
        $sql = "UPDATE " . GROUPS_TABLE . "
                SET group_type = $group_type, group_name = '" . str_replace("\'", "''", $group_name) . "', group_description = '" . str_replace("\'", "''", $group_description) . "', group_moderator = $group_moderator
                WHERE group_id = $group_id";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not update group', '', __LINE__, __FILE__, $sql);
        }
        $message = $lang['Updated_group'] . '<br /><br />' . sprintf($lang['Click_return_go'], '<a href="' . admin_sid("admin_group_overview.php") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');;
        message_die(GENERAL_MESSAGE, $message);
    }
}

// Add User
if ( $_GETVAR->get('add', 'post', 'string', NULL) ) {
    $username = htmlspecialchars( $_GETVAR->get('username', 'post', 'string', '') );
    $group_id = $_GETVAR->get('group_id', 'post', 'int', NULL);
    $sql = "SELECT bg.group_moderator, bg.group_type, ba.auth_mod
            FROM ".GROUPS_TABLE." AS bg Left Join ".AUTH_ACCESS_TABLE." AS ba ON bg.group_id = ba.group_id
            WHERE bg.group_id = '".$group_id."'";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not get moderator information', '', __LINE__, __FILE__, $sql);
    }
    if ( $group_info = $db->sql_fetchrow($result) ) {
        $group_moderator = $group_info['group_moderator'];
    } else {
        message_die(GENERAL_MESSAGE, $lang['No_group_moderator']);
    }
    if ( $group_moderator == $userdata['user_id'] || $userdata['user_level'] == ADMIN ) {
        $is_moderator = TRUE;
    }
    $sql = "SELECT user_id, user_email, user_lang, user_level, username
            FROM " . USERS_TABLE . "
            WHERE username = '" . str_replace("\'", "''", $username) . "'";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Could not get user information", $lang['Error'], __LINE__, __FILE__, $sql);
    }
    if ( !($row = $db->sql_fetchrow($result)) ) {
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url=' . admin_sid("admin_group_overview.php") . '" />')
        );
        $message = $lang['Could_not_add_user'] . "<br /><br />" . sprintf($lang['Click_return_go'], "<a href=\"" . admin_sid("admin_group_overview.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_index'], "<a href=\"" . append_sid("index.php") . "\">", "</a>");
        message_die(GENERAL_MESSAGE, $message);
    }
    if ( $row['user_id'] == ANONYMOUS ) {
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url=' . admin_sid("admin_group_overview.php") . '">')
        );
        $message = $lang['Could_not_anon_user'] . '<br /><br />' . sprintf($lang['Click_return_go'], '<a href="' . admin_sid("admin_group_overview.php?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    }
    $sql = "SELECT ug.user_id, u.user_level
            FROM " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u
            WHERE u.user_id = " . $row['user_id'] . "
            AND ug.user_id = u.user_id
            AND ug.group_id = $group_id";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not get user information', '', __LINE__, __FILE__, $sql);
    }
    if ( !($db->sql_fetchrow($result)) ) {
        $sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
                VALUES (" . $row['user_id'] . ", $group_id, 0)";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not add user to group', '', __LINE__, __FILE__, $sql);
        }
        if ( $row['user_level'] != ADMIN && $row['user_level'] != MOD && $group_info['auth_mod'] ) {
            $sql = "UPDATE " . USERS_TABLE . " SET user_level = " . MOD . "
                    WHERE user_id = " . $row['user_id'];
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
            }
        }
        add_group_attributes($row['user_id'], $group_id);
        //
        // Get the group name
        // Email the user and tell them they're in the group
        //
        $group_sql = "SELECT group_name FROM " . GROUPS_TABLE . " WHERE group_id = $group_id";
        if ( !($result = $db->sql_query($group_sql)) ) {
            message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql);
        }
        $group_name_row = $db->sql_fetchrow($result);
        $group_name = $group_name_row['group_name'];
        $langemail = array();
        $thislang  = ((isset($user_lang) && !empty($user_lang))? $user_lang : strtolower($board_config['default_lang']));
        if (!isset($langemail[$thislang])) {
            if (is_file(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/group_added.php')) {
                @include_once(NUKE_FORUMS_DIR.'language/lang_'.$thislang.'/email/group_added.php');
            } else {
                @include_once(NUKE_FORUMS_DIR.'language/lang_english/email/group_added.php');
            }
        }
        $email_to       = array();
        $email_to[$row['username']] = $row['user_email'];
        $subject        = $langemail[$thislang]['EmailSubject'];
        $email_message  = $langemail[$thislang]['Hello'].'&nbsp;'.$row['username'].',<br /><br />';
        $email_message .= $langemail[$thislang]['Part1'].':&nbsp;'.$group_name.'<br /><br />';
        $email_message .= $langemail[$thislang]['Part2'].':<br />';
        $email_message .= $langemail[$thislang]['Part3'].'<br /><br />';
        $email_message .= '<a href="'.EVO_SERVER_URL.'/modules.php?name=Groups&amp;'.POST_GROUPS_URL.'='.$group_id.'">'.$langemail[$thislang]['GroupLink'].'</a><br /><br />';
        $email_message .= $board_config['board_email_sig'];
        $mailsend       = evo_mail($email_to, $subject, $email_message, '', '', TRUE);
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="5;url=' . append_sid("index.php") . '" />')
        );
        if (empty($mailsend['error'])) {
            $message = $lang['GO_member_added'] . '<br /><br />' . sprintf($lang['Click_return_go'],  '<a href="' . admin_sid('admin_group_overview.php') . '">', '</a>');
        } else {
            $message = $lang['Error'].':<br />'.$mailsend['error'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . admin_sid('admin_group_overview.php') . '">', '</a>');
        }
        message_die(GENERAL_MESSAGE, $message);
    } else {
        $template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url=' . admin_sid("admin_group_overview.php") . '">')
        );
        $message = $lang['User_is_member_group'] . '<br /><br />' . sprintf($lang['Click_return_go'], '<a href="' . admin_sid("admin_group_overview.php") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.php") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    }
}

$sql = "SELECT group_id
        FROM ". GROUPS_TABLE ."
        WHERE group_single_user != 1
        ORDER BY group_id DESC";
if(!$q_groups = $db->sql_query($sql)) {
    message_die(GENERAL_ERROR, "Could not query group information", "", __LINE__, __FILE__, $sql);
}
if( $total_groups = $db->sql_numrows($q_groups) ) {
    $group_rows = $db->sql_fetchrowset($q_groups);
}
for($i = 0; $i < $total_groups; $i++) {
    $sql = "SELECT g.*, u.username, u.user_id
            FROM ". GROUPS_TABLE ." g, ". USERS_TABLE ." u
            WHERE g.group_id = ". $group_rows[$i]['group_id'] ."
            AND g.group_moderator = u.user_id";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not query group information', '', __LINE__, __FILE__, $sql);
    }
    $groups = $db->sql_fetchrow($result);
    $mod_url = admin_sid('admin_users.php&amp;mode=edit&amp;'. POST_USERS_URL . '=' . $groups['user_id']);
    $status = ( ( $groups['group_type'] != GROUP_OPEN ) ? ( $groups['group_type'] != GROUP_CLOSED ? ( $lang['GO_hidden'] ) : $lang['GO_closed'] ) : $lang['GO_open']);
    $group_open = ( $groups['group_type'] == GROUP_OPEN ) ? ' checked="checked"' : '';
    $group_closed = ( $groups['group_type'] == GROUP_CLOSED ) ? ' checked="checked"' : '';
    $group_hidden = ( $groups['group_type'] == GROUP_HIDDEN ) ? ' checked="checked"' : '';
    $sql = "SELECT u.username, u.user_id
            FROM ". USER_GROUP_TABLE ." ug, "._USERS_TABLE ." u
            WHERE ug.group_id = ". $group_rows[$i]['group_id'] ."
            AND u.user_id = ug.user_id
            AND ug.user_pending = 0
            GROUP BY u.user_id
            ORDER BY u.username";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not query group information', '', __LINE__, __FILE__, $sql);
    }
    $members = array();
    $users   = 0;
    while ( $row = $db->sql_fetchrow($result) ) {
        $members[] = $row;
        $users++;
    }
    $memberlist = '';
    for($j = 0; $j < count($members); $j++) {
        if ( $members[$j]['user_id'] == $groups['group_moderator'] ) {
            $userlink = '<span style="color:#' . $theme['fontcolor2'] . '">'.$members[$j]['username'].'</span>';
        } else {
            $userlink =  '<a href="'. admin_sid("admin_group_overview.php&amp;mode=delete&amp;u=". $members[$j]['user_id']."&amp;g=". $group_rows[$i]['group_id']).'">'.$members[$j]['username'].'</a>';
        }
        $memberlist .= ( ( $memberlist != '' ) ? ', ' : '' ) . $userlink;
    }
    $sql = "SELECT u.username, u.user_id
            FROM ". USER_GROUP_TABLE ." ug, "._USERS_TABLE ." u
            WHERE ug.group_id = ". $group_rows[$i]['group_id'] ."
            AND u.user_id = ug.user_id
            AND ug.user_pending = 1
            GROUP BY u.user_id
            ORDER BY u.username";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not query group information', '', __LINE__, __FILE__, $sql);
    }
    $pending_members = array();
    while ( $row = $db->sql_fetchrow($result) ) {
        $pending_members[] = $row;
        $users++;
    }
    $pending_memberlist = '';
    for($j = 0; $j < count($pending_members); $j++) {
        if ( $pending_members[$j]['user_id'] == $groups['group_moderator'] ) {
            $userlink = '<span style="color:#' . $theme['fontcolor2'] . '">'.$pending_members[$j]['username'].'</span>';
        } else {
            $pending_userlink =  '<a href="'. admin_sid("admin_group_overview.php&amp;mode=delete&amp;u=". $pending_members[$j]['user_id']."&amp;g=". $group_rows[$i]['group_id']).'">'.$pending_members[$j]['username'].'</a>';
        }
        $pending_memberlist .= ( ( $pending_memberlist != '' ) ? ', ' : '' ) . $pending_userlink;
    }
    $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
    $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
    $template->assign_block_vars('groups',array(
        'ROW_COLOR'             => '#' . $row_color,
        'ROW_CLASS'             => $row_class,
        'GROUP'                 => str_replace('"', '&quot;', $groups['group_name']),
        'GROUP_DESCRIPTION'     => str_replace('"', '&quot;', $groups['group_description']),
        'MOD'                   => $groups['username'],
        'GROUP_MOD_ID'          => $groups['user_id'],
        'U_MOD'                 => $mod_url,
        'USERS'                 => $users,
        'STATUS'                => $status,
        'GROUP_ID'              => $groups['group_id'],
        'U_SEARCH_USER'         => append_sid('search.php?mode=searchuser&amp;popup=1&amp;menu=1&amp;group_id='.$groups['group_id']),
        'S_GROUP_OPEN_TYPE'     => GROUP_OPEN,
        'S_GROUP_CLOSED_TYPE'   => GROUP_CLOSED,
        'S_GROUP_HIDDEN_TYPE'   => GROUP_HIDDEN,
        'S_GROUP_OPEN_CHECKED'  => $group_open,
        'S_GROUP_CLOSED_CHECKED'=> $group_closed,
        'S_GROUP_HIDDEN_CHECKED'=> $group_hidden,
        'GROUP_MEMBERS'         => $memberlist,
        'PENDING_GROUP_MEMBERS' => $pending_memberlist,
        'U_PERMISSION'          => admin_sid('admin_ug_auth.php&amp;mode=group&amp;g='.$groups['group_id']),
        'U_INFORM'              => 'modules.php?name=Groups&amp;' . POST_GROUPS_URL . '=' . $groups['group_id'],
        'S_GROUP_ACTION'        => admin_sid('admin_group_overview.php'),
        'S_GROUP_INDEX'         => $i)
    );
}// End for ($i...
$db->sql_freeresult($result);
$template->assign_vars(array(
    'L_GO_TITLE'                    => $lang['Group_Overview'],
    'L_GO_TEXT'                     => $lang['Group_admin_explain'],
    'L_GO_GROUP'                    => $lang['GO_group'],
    'L_GO_MOD'                      => $lang['GO_mod'],
    'L_GO_USER'                     => $lang['GO_user'],
    'L_GO_STATUS'                   => $lang['GO_status'],
    'L_GO_EDIT'                     => $lang['Edit'],
    'L_PERMISSION'                  => $lang['GO_permission'],
    'L_INFORM'                      => $lang['GO_inform'],
    'L_GROUP_NAME'                  => $lang['group_name'],
    'L_GROUP_DESCRIPTION'           => $lang['group_description'],
    'L_GROUP_MODERATOR'             => $lang['group_moderator'],
    'L_GROUP_STATUS'                => $lang['group_status'],
    'L_GROUP_OPEN'                  => $lang['group_open'],
    'L_GROUP_CLOSED'                => $lang['group_closed'],
    'L_GROUP_HIDDEN'                => $lang['group_hidden'],
    'L_GROUP_DELETE'                => $lang['group_delete'],
    'L_GROUP_DELETE_CHECK'          => $lang['group_delete_check'],
    'L_GROUP_DELETE_USERS'          => $lang['group_delete_users'],
    'L_GROUP_DELETE_USERS_CHECK'    => $lang['group_delete_users_check'],
    'L_GROUP_DELETE_USERS_EXPLAIN'  => $lang['group_delete_users_explain'],
    'L_DELETE_MODERATOR'            => $lang['delete_group_moderator'],
    'L_DELETE_MODERATOR_EXPLAIN'    => $lang['delete_moderator_explain'],
    'L_YES'                         => $lang['Yes'],
    'L_MEMBERS'                     => $lang['GO_member'],
    'L_PENDING_MEMBERS'             => $lang['Pending'],
    'L_MEMBERS_EXPLAIN'             => $lang['GO_member_explain'],
    'L_ADD_MEMBER'                  => $lang['GO_add_member'],
    'L_ADD_NEW'                     => $lang['Add_new'],
    'L_SUBMIT'                      => $lang['Submit'],
    'L_FIND_USERNAME'               => $lang['Find_username'],
    'L_NEW_GROUP'                   => $lang['New_group'],
    'S_NEW_GROUP_FORM'              => admin_sid('admin_groups.php&amp;mode=new'))
);
$template->set_filenames(array(
    'body' => 'admin/admin_group_overview_body.tpl')
);
$template->pparse("body");
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>