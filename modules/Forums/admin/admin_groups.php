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
    if ( !empty($setmodules) ) {
        $filename = basename(__FILE__);
        $module['Groups']['Manage'] = $filename;
        return;
    }
}

global $_GETVAR, $cache;
include_once(NUKE_INCLUDE_DIR . 'functions_selects.php');
$lang_file = '/lang_mass_pm.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}
$group_id = $_GETVAR->get(POST_GROUPS_URL, 'request', 'int', 0);
$mode = $_GETVAR->get('mode', 'request', 'string', '');
$group_count_remove = 0;
$group_count_added  = 0;
$yesno = GROUP_INITIAL_NO;

attachment_quota_settings('group', $_GETVAR->get('group_update', 'post', 'string', NULL), $mode);

if ( $_GETVAR->get('edit', 'request', 'string', NULL) || $_GETVAR->get('new', 'request', 'string', NULL) ) {
    //
    // Ok they are editing a group or creating a new group
    //
    $template->set_filenames(array(
        'body' => 'admin/group_edit_body.tpl')
    );
    if ( $_GETVAR->get('edit', 'post', 'string', NULL) ) {
        //
        // They're editing. Grab the vars.
        //
        $sql = "SELECT *
                FROM " . GROUPS_TABLE . "
                WHERE group_single_user <> " . TRUE . "
                AND group_id = $group_id";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
        }
        if ( !($group_info = $db->sql_fetchrow($result)) ) {
            message_die(GENERAL_MESSAGE, $lang['Group_not_exist']);
        }
        $initialgroup = $board_config['initial_group_id'];
        if ($initialgroup == NULL) {
            message_die(GENERAL_ERROR, 'Error getting initial group information', '', __LINE__, __FILE__, $sql);
        }
        if (intval($initialgroup) == $group_id) {
            $yesno = 1;
        } else {
           $yesno = 0;
        }
        $mode = 'editgroup';
        $template->assign_block_vars('group_edit', array());
    } else if ( $_GETVAR->get('new', 'post', 'string', NULL) ) {
        $group_info = array (
            'group_name'            => '',
            'group_description'     => '',
            'group_moderator'       => '',
            'group_color'           => '',
            'group_rank'            => '',
            'group_count'           => '99999999',
            'group_count_max'       => '99999999',
            'group_count_enable'    => '0',
            'max_inbox'             => $board_config['max_inbox_privmsgs'],
            'max_sentbox'           => $board_config['max_sentbox_privmsgs'],
            'max_savebox'           => $board_config['max_savebox_privmsgs'],
            'override_max_inbox'    => '',
            'override_max_sentbox'  => '',
            'override_max_savebox'  => '',
            'group_allow_pm'        => AUTH_ADMIN,
            'group_type'            => GROUP_OPEN);
        $group_open = ' checked="checked"';
        $mode = 'newgroup';
    }

    //
    // Ok, now we know everything about them, let's show the page.
    //
    if ($group_info['group_moderator'] != '') {
        $sql = "SELECT user_id, username
                FROM " . USERS_TABLE . "
                WHERE user_id = " . $group_info['group_moderator'];
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not obtain user info for moderator list', '', __LINE__, __FILE__, $sql);
        }
        if ( !($row = $db->sql_fetchrow($result)) ) {
            message_die(GENERAL_ERROR, 'Could not obtain user info for moderator list', '', __LINE__, __FILE__, $sql);
        }
        $group_moderator = $row['username'];
    } else {
        $group_moderator = '';
    }

    $group_open             = ( $group_info['group_type'] == GROUP_OPEN ) ? ' checked="checked"' : '';
    $group_closed           = ( $group_info['group_type'] == GROUP_CLOSED ) ? ' checked="checked"' : '';
    $group_hidden           = ( $group_info['group_type'] == GROUP_HIDDEN ) ? ' checked="checked"' : '';
    $group_count_enable_checked = ( $group_info['group_count_enable'] ) ? ' checked="checked"' : '';
    $initialgroup_yes       = ( $yesno == GROUP_INITIAL_YES ) ? ' checked="checked"' : '';
    $initialgroup_no        = ( $yesno == GROUP_INITIAL_NO ) ? ' checked="checked"' : '';
    $group_color            = auc_colors_select($group_info['group_color'], "group_color", "group_id");
    $group_rank             = ranks_select($group_info['group_rank'], "group_rank", "rank_id");
    $max_inbox              = $group_info['max_inbox'];
    $max_sentbox            = $group_info['max_sentbox'];
    $max_savebox            = $group_info['max_savebox'];
    $override_max_inbox     = ( $group_info['override_max_inbox'] == 1 ) ? ' checked="checked"' : '';
    $override_max_sentbox   = ( $group_info['override_max_sentbox'] == 1 ) ? ' checked="checked"' : '';
    $override_max_savebox   = ( $group_info['override_max_savebox'] == 1 ) ? ' checked="checked"' : '';
    $group_allow_pm_all     = ( $group_info['group_allow_pm'] == AUTH_ALL ) ? ' checked="checked"' : '';
    $group_allow_pm_reg     = ( $group_info['group_allow_pm'] == AUTH_REG ) ? ' checked="checked"' : '';
    $group_allow_pm_private = ( $group_info['group_allow_pm'] == AUTH_ACL ) ? ' checked="checked"' : '';
    $group_allow_pm_mod     = ( $group_info['group_allow_pm'] == AUTH_MOD ) ? ' checked="checked"' : '';
    $group_allow_pm_admin   = ( $group_info['group_allow_pm'] == AUTH_ADMIN ) ? ' checked="checked"' : '';
    $s_hidden_fields        = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
    $template->assign_vars(array(
        'GROUP_NAME'                    => $group_info['group_name'],
        'GROUP_DESCRIPTION'             => $group_info['group_description'],
        'GROUP_MODERATOR'               => $group_moderator,
        'GROUP_COUNT'                   => $group_info['group_count'],
        'GROUP_COUNT_MAX'               => $group_info['group_count_max'],
        'GROUP_COUNT_ENABLE_CHECKED'    => $group_count_enable_checked,
        'L_GROUP_COUNT'                 => $lang['group_count'],
        'L_GROUP_COUNT_MAX'             => $lang['group_count_max'],
        'L_GROUP_COUNT_EXPLAIN'         => $lang['group_count_explain'],
        'L_GROUP_COUNT_ENABLE'          => $lang['Group_count_enable'],
        'L_GROUP_COUNT_UPDATE'          => $lang['Group_count_update'],
        'L_GROUP_COUNT_DELETE'          => $lang['Group_count_delete'],
        'GROUP_COLOR'                   => $group_color,
        'L_GROUP_COLOR'                 => $lang['group_color'],
        'GROUP_RANK'                    => $group_rank,
        'L_GROUP_RANK'                  => $lang['group_rank'],
        'GROUP_ALLOW_PM'                => $group_info['group_allow_pm'],
        'L_GROUP_ALLOW_PM'              => $lang['group_allow_pm'],
        'L_GROUP_ALLOW_PM_EXPLAIN'      => $lang['group_allow_pm_explain'],
        'L_GROUP_ALL_ALLOW_PM'          => ucfirst(strtolower($lang['Forum_ALL'])),
        'L_GROUP_REG_ALLOW_PM'          => ucfirst(strtolower($lang['Forum_REG'])),
        'L_GROUP_PRIVATE_ALLOW_PM'      => ucfirst(strtolower($lang['Forum_PRIVATE'])),
        'L_GROUP_MOD_ALLOW_PM'          => ucfirst(strtolower($lang['Forum_MOD'])),
        'L_GROUP_ADMIN_ALLOW_PM'        => ucfirst(strtolower($lang['Forum_ADMIN'])),
        'S_GROUP_ALL_ALLOW_PM_CHECKED'  => $group_allow_pm_all,
        'S_GROUP_REG_ALLOW_PM_CHECKED'  => $group_allow_pm_reg,
        'S_GROUP_PRIVATE_ALLOW_PM_CHECKED' => $group_allow_pm_private,
        'S_GROUP_MOD_ALLOW_PM_CHECKED'  => $group_allow_pm_mod,
        'S_GROUP_ADMIN_ALLOW_PM_CHECKED' => $group_allow_pm_admin,
        'S_GROUP_ALL_ALLOW_PM'          => AUTH_ALL,
        'S_GROUP_REG_ALLOW_PM'          => AUTH_REG,
        'S_GROUP_PRIVATE_ALLOW_PM'      => AUTH_ACL,
        'S_GROUP_MOD_ALLOW_PM'          => AUTH_MOD,
        'S_GROUP_ADMIN_ALLOW_PM'        => AUTH_ADMIN,
        'L_GROUP_TITLE'                 => $lang['Group_administration'],
        'L_GROUP_EDIT_DELETE'           => ( $_GETVAR->get('new', 'post', 'string', NULL) ) ? $lang['New_group'] : $lang['Edit_group'],
        'L_GROUP_NAME'                  => $lang['group_name'],
        'L_GROUP_DESCRIPTION'           => $lang['group_description'],
        'L_GROUP_MODERATOR'             => $lang['group_moderator'],
        'L_FIND_USERNAME'               => $lang['Find_username'],
        'L_GROUP_STATUS'                => $lang['group_status'],
        'L_GROUP_INITIAL'               => $lang['Initial_user_group'],
        'L_GROUP_INITIAL_EXPLAIN'       => $lang['Initial_user_group_explain'],
        'L_GROUP_OPEN'                  => $lang['group_open'],
        'L_GROUP_CLOSED'                => $lang['group_closed'],
        'L_GROUP_HIDDEN'                => $lang['group_hidden'],
        'L_GROUP_DELETE'                => $lang['group_delete'],
        'L_GROUP_DELETE_CHECK'          => $lang['group_delete_check'],
        'L_SUBMIT'                      => $lang['Submit'],
        'L_RESET'                       => $lang['Reset'],
        'L_DELETE_MODERATOR'            => $lang['delete_group_moderator'],
        'L_DELETE_MODERATOR_EXPLAIN'    => $lang['delete_moderator_explain'],
        'L_MAX_INBOX'                   => $lang['max_inbox'],
        'L_MAX_SENTBOX'                 => $lang['max_sentbox'],
        'L_MAX_SAVEBOX'                 => $lang['max_savebox'],
        'MAX_INBOX'                     => $max_inbox,
        'MAX_SENTBOX'                   => $max_sentbox,
        'MAX_SAVEBOX'                   => $max_savebox,
        'L_OVERRIDE_MAX'                => $lang['override_max'],
        'OVERRIDE_MAX_INBOX'            => $override_max_inbox,
        'OVERRIDE_MAX_SENTBOX'          => $override_max_sentbox,
        'OVERRIDE_MAX_SAVEBOX'          => $override_max_savebox,
        'L_YES'                         => $lang['Yes'],
        'L_NO'                          => $lang['No'],
        'U_SEARCH_USER'                 => append_sid('search.php?mode=searchuser&amp;popup=1&amp;menu=1'),
        'S_GROUP_OPEN_TYPE'             => GROUP_OPEN,
        'S_GROUP_CLOSED_TYPE'           => GROUP_CLOSED,
        'S_GROUP_HIDDEN_TYPE'           => GROUP_HIDDEN,
        'S_GROUP_INITIAL_YES_TYPE'      => GROUP_INITIAL_YES,
        'S_GROUP_INITIAL_NO_TYPE'       => GROUP_INITIAL_NO,
        'S_GROUP_OPEN_CHECKED'          => $group_open,
        'S_GROUP_CLOSED_CHECKED'        => $group_closed,
        'S_GROUP_HIDDEN_CHECKED'        => $group_hidden,
        'S_GROUP_INITIAL_YES_CHECKED'   => $initialgroup_yes,
        'S_GROUP_INITIAL_NO_CHECKED'    => $initialgroup_no,
        'S_GROUP_ACTION'                => admin_sid('admin_groups.php'),
        'S_HIDDEN_FIELDS'               => $s_hidden_fields)
    );
    $template->pparse('body');
} else if ( $_GETVAR->get('group_update', 'post', 'string', NULL) ) {
    //
    // Ok, they are submitting a group, let's save the data based on if it's new or editing
    //
    if ( $_GETVAR->get('group_delete', 'post', 'string', NULL) )  {
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
        $sql = "SELECT config_value
                FROM " . CONFIG_TABLE . "
                WHERE config_name='initial_group_id'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $initialgroup = $row[0];
        if ($initialgroup == $group_id) {
            $sql = "UPDATE
                    " . CONFIG_TABLE . "
                    SET config_value = '0'
                    WHERE config_name ='initial_group_id'";
            if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not update group', '', __LINE__, __FILE__, $sql);
            }
        }
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
        // We have to change the colors of the user
        remove_group_attributes('', $group_id);
        $message = $lang['Deleted_group'] . '<br /><br />' . sprintf($lang['Click_return_groupsadmin'], '<a href="' . admin_sid("admin_groups.php") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    } else {
        $group_type = $_GETVAR->get('group_type', 'post', 'int', NULL) ? $_GETVAR->get('group_type', 'post', 'int') : GROUP_OPEN;
        $group_name = $_GETVAR->get('group_name', 'post', 'string', NULL) ? htmlspecialchars(trim($_GETVAR->get('group_name', 'post', 'string'))) : '';
        $group_description = $_GETVAR->get('group_description', 'post', 'string', NULL) ? trim($_GETVAR->get('group_description', 'post', 'string')) : '';
        $group_moderator = $_GETVAR->get('username', 'post', 'string', NULL) ? $_GETVAR->get('username', 'post', 'string') : '';
        $delete_old_moderator = $_GETVAR->get('delete_old_moderator', 'post', 'string', NULL) ? TRUE : FALSE;
        $group_count = $_GETVAR->get('group_count', 'post', 'int', 0);
        $group_count_max = $_GETVAR->get('group_count_max', 'post', 'int', 0);
        $group_count_enable = $_GETVAR->get('group_count_enable', 'post', 'int') ? TRUE : FALSE;
        $group_count_update = $_GETVAR->get('group_count_update', 'post', 'int') ? TRUE : FALSE;
        $group_count_delete = $_GETVAR->get('group_count_delete', 'post', 'int') ? TRUE : FALSE;
        $group_color = $_GETVAR->get('group_color', 'post', 'int', 0);
        $group_rank = $_GETVAR->get('group_rank', 'post', 'int', 0);
        $max_inbox = $_GETVAR->get('max_inbox', 'post', 'int', 100);
        $max_sentbox = $_GETVAR->get('max_sentbox', 'post', 'int');
        $max_savebox = $_GETVAR->get('max_savebox', 'post', 'int');
        $override_max_inbox = $_GETVAR->get('override_max_inbox', 'post', 'int') ? TRUE : FALSE;
        $override_max_sentbox = $_GETVAR->get('override_max_sentbox', 'post', 'int') ? TRUE : FALSE;
        $override_max_savebox = $_GETVAR->get('override_max_savebox', 'post', 'int') ? TRUE : FALSE;
        $group_allow_pm = $_GETVAR->get('group_allow_pm', 'post', 'string', AUTH_ADMIN);
        if ( $group_name == '' ) {
            message_die(GENERAL_MESSAGE, $lang['No_group_name']);
        } else if ( $group_moderator == '' ) {
            message_die(GENERAL_MESSAGE, $lang['No_group_moderator']);
        }
        $this_userdata = get_userdata($group_moderator, TRUE);
        $group_moderator = $this_userdata['user_id'];
        if ( !$group_moderator ) {
            message_die(GENERAL_MESSAGE, $lang['No_group_moderator']);
        }
        if( $mode == 'editgroup' ) {
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
            if( $_GETVAR->get('initial_group', 'post', 'int', NULL) ) {
                if($_GETVAR->get('initial_group', 'post', 'int', NULL) == 1) {
                    $sql = "UPDATE " . CONFIG_TABLE . "
                            SET config_value = '".$group_id."'
                            WHERE config_name ='initial_group_id'";
                    $result = $db->sql_query($sql);
                    if ( !($result = $db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, 'Error getting initial group id information', '', __LINE__, __FILE__, $sql);
                    }
                } else {
                    $sql = "SELECT config_value
                            FROM " . CONFIG_TABLE . "
                            WHERE config_name='initial_group_id'";
                    $result = $db->sql_query($sql);
                    $row = $db->sql_fetchrow($result);
                    $initialgroup = $row[0];
                    if ($initialgroup == NULL) {
                        message_die(GENERAL_ERROR, 'Error getting initial group information', '', __LINE__, __FILE__, $sql);
                    }
                    if (intval($initialgroup) == $group_id) {
                        $sql = "UPDATE " . CONFIG_TABLE . "
                                SET config_value = '0'
                                WHERE config_name ='initial_group_id'";
                        $result = $db->sql_query($sql);
                        if ( !($result = $db->sql_query($sql)) ) {
                            message_die(GENERAL_ERROR, 'Error getting initial group id information', '', __LINE__, __FILE__, $sql);
                        }
                    }
                }
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
            $sql = "UPDATE " . GROUPS_TABLE . " SET group_type = $group_type, group_name = '" . str_replace("\'", "''", $group_name) . "', group_description = '" . str_replace("\'", "''", $group_description) . "', group_moderator = $group_moderator, group_count='$group_count', group_count_max='$group_count_max', group_count_enable='$group_count_enable', group_allow_pm = '$group_allow_pm', group_rank = '$group_rank', group_color = '$group_color', max_inbox = '$max_inbox', max_sentbox = '$max_sentbox', max_savebox = '$max_savebox', override_max_inbox = '$override_max_inbox', override_max_sentbox = '$override_max_sentbox', override_max_savebox = '$override_max_savebox' WHERE group_id = $group_id";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update group', '', __LINE__, __FILE__, $sql);
            }
            add_group_attributes('', $group_id);
            if ($group_count_delete) {
                //removing old users
                $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                        WHERE group_id=$group_id
                        AND user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);
                }
                $group_count_remove=$db->sql_affectedrows();
                if ( $group_count_remove > 0 ) {
                    remove_group_attributes('', $group_id);
                }
            }
            if ( $group_count_update) {
                //finding new users
                $sql = "SELECT u.user_id FROM " . USERS_TABLE . " u
                        LEFT JOIN " . USER_GROUP_TABLE ." ug ON u.user_id=ug.user_id AND ug.group_id='".$group_id."'
                        WHERE u.user_posts>='".$group_count."' AND u.user_posts < '".$group_count_max."'
                        AND ug.group_id is NULL
                        AND u.user_id NOT IN ('".$group_moderator."','".ANONYMOUS."')";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, $sql.'Could not select new users, group count', '', __LINE__, __FILE__, $sql);
                }
                //inserting new users
                $group_count_added=0;
                while ( ($new_members = $db->sql_fetchrow($result)) ) {
                    $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                            VALUES ($group_id, " . $new_members['user_id'] . ", 0)";
                    if ( !($result2 = $db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, 'Error inserting user group, group count', '', __LINE__, __FILE__, $sql);
                    }
                    add_group_attributes($new_members['user_id'], $group_id);
                    $group_count_added++;
                }
            }
            $cache->delete('UserColors', 'config');
            $cache->delete('GroupColors', 'config');
            $message = $lang['Updated_group'] .'<br />'.sprintf($lang['group_count_updated'],$group_count_remove,$group_count_added). '<br /><br />' . sprintf($lang['Click_return_groupsadmin'], '<a href="' . admin_sid("admin_groups.php") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');;
            message_die(GENERAL_MESSAGE, $message);
        } else if( $mode == 'newgroup' ) {
            $sql = "INSERT INTO " . GROUPS_TABLE . " (group_type, group_name, group_description, group_moderator, group_count, group_count_max, group_count_enable, group_rank, group_color, group_allow_pm, group_single_user, max_inbox, max_sentbox, max_savebox, override_max_inbox, override_max_sentbox, override_max_savebox)
                    VALUES ($group_type, '" . str_replace("\'", "''", $group_name) . "', '" . str_replace("\'", "''", $group_description) . "', $group_moderator, '$group_count','$group_count_max','$group_count_enable', '$group_rank', '$group_color', '$group_allow_pm', '0', '$max_inbox', '$max_sentbox', '$max_savebox', '$override_max_inbox', '$override_max_sentbox', '$override_max_savebox')";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not insert new group', '', __LINE__, __FILE__, $sql);
            }
            $new_group_id = $db->sql_nextid();
            $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                    VALUES ($new_group_id, $group_moderator, 0)";
            if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not insert new user-group info', '', __LINE__, __FILE__, $sql);
            }
            if ($group_count_delete) {
                //removing old users
                $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                        WHERE group_id=$new_group_id
                        AND user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);
                }
                $group_count_remove=$db->sql_affectedrows();
                if ( $group_count_remove > 0 ) {
                    remove_group_attributes('', $group_id);
                }
            }
            if ( $group_count_update) {
                //finding new users
                $sql = "SELECT u.user_id
                        FROM (" . USERS_TABLE . " u
                        LEFT JOIN " . USER_GROUP_TABLE ." ug ON u.user_id=ug.user_id AND ug.group_id='$new_group_id')
                        WHERE u.user_posts>='$group_count' AND u.user_posts<'$group_count_max'
                        AND ug.group_id is NULL
                        AND u.user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, $sql.'Could not select new users, group count', '', __LINE__, __FILE__, $sql);
                }
                //inserting new users
                $group_count_added=0;
                while ( ($new_members = $db->sql_fetchrow($result)) ) {
                    $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                            VALUES ($new_group_id, " . $new_members['user_id'] . ", 0)";
                    if ( !($result2 = $db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, 'Error inserting user group, group count', '', __LINE__, __FILE__, $sql);
                    }
                    add_group_attributes($new_members['user_id'], $group_id);
                    $group_count_added++;
                }
            }
            if( $_GETVAR->get('initial_group', 'post', 'int', NULL) ) {
                if($_GETVAR->get('initial_group', 'post', 'int', NULL) == 1) {
                    $sql = "UPDATE " . CONFIG_TABLE . "
                            SET config_value = '$new_group_id'
                            WHERE config_name ='initial_group_id'";
                    $result = $db->sql_query($sql);
                    if ( !$db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not insert new user-group info', '', __LINE__, __FILE__, $sql);
                    }
                }
            }
            $message = $lang['Added_new_group'] .'<br />'.sprintf($lang['group_count_updated'],$group_count_remove,$group_count_added). '<br /><br />' . sprintf($lang['Click_return_groupsadmin'], '<a href="' . admin_sid("admin_groups.php") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');;
            message_die(GENERAL_MESSAGE, $message);
        } else {
            message_die(GENERAL_MESSAGE, $lang['No_group_action']);
        }
    }
} else {
    $sql = "SELECT group_id, group_name
            FROM " . GROUPS_TABLE . "
            WHERE group_single_user <> " . TRUE . "
            ORDER BY group_name";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not obtain group list', '', __LINE__, __FILE__, $sql);
    }
    $select_list = '';
    if ( $row = $db->sql_fetchrow($result) ) {
        $select_list .= '<select name="' . POST_GROUPS_URL . '">';
        do {
            $select_list .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
        } while ( $row = $db->sql_fetchrow($result) );
        $select_list .= '</select>';
    }
    $template->set_filenames(array(
        'body' => 'admin/group_select_body.tpl')
    );
    $template->assign_vars(array(
        'L_GROUP_TITLE'     => $lang['Group_administration'],
        'L_GROUP_EXPLAIN'   => $lang['Group_admin_explain'],
        'L_GROUP_SELECT'    => $lang['Select_group'],
        'L_LOOK_UP'         => $lang['Look_up_group'],
        'L_CREATE_NEW_GROUP'=> $lang['New_group'],
        'S_GROUP_ACTION'    => admin_sid('admin_groups.php'),
        'S_GROUP_SELECT'    => $select_list)
    );
    if ( $select_list != '' ) {
        $template->assign_block_vars('select_box', array());
    }
    $template->pparse('body');
}
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>