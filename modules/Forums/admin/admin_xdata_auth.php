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
        $module['XData']['User_Permissions'] = $filename . '&amp;type=user';
        $module['XData']['Group_Permissions'] = $filename . '&amp;type=group';
        return;
    }
}

global $_GETVAR;

//
// include language file (borrowed mercilessly from CyberAlien's eXtreme Styles MOD)
//
if(!defined('XD_LANG_INCLUDED')) {
    $lang_file = '/lang_xd.php';
    if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
        include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
    } elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
        include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
    } else {
        die('Neither your selected nor the board-default language-file could be found');
    }
    define('XD_LANG_INCLUDED', TRUE);
}

//
// Set mode & type
//
$mode = htmlspecialchars($_GETVAR->get('mode', 'request', 'string', NULL));
$type = htmlspecialchars($_GETVAR->get('type', 'request', 'string', NULL));

//
// Begin program
//
if ($type == 'user') {
    if ( ( $mode == 'edit' || $mode == 'save' ) && ( $_GETVAR->get('username', 'post', 'string', NULL) || $_GETVAR->get(POST_USERS_URL, 'request', 'int', NULL) ) ) {
        $xd_meta = get_xd_metadata();
        if ( $_GETVAR->get('username', 'post', 'string', NULL) ) {
            $this_userdata = get_userdata($_GETVAR->get('username', 'post', 'string', ''), TRUE);
            if ( !is_array($this_userdata) ) {
                message_die(GENERAL_MESSAGE, $lang['No_such_user']);
            }
            $user_id = $this_userdata['user_id'];
        } else {
            $user_id = ( $_GETVAR->get(POST_USERS_URL, 'request', 'int', NULL) );
        }
        if ( !($_GETVAR->get('submit', 'post', 'string', NULL)) ) {
            //
            // Show the edit form
            //
            $template->set_filenames( array(
                'body' => 'admin/xd_auth_body.tpl'
                )
            );
            $template->assign_vars( array(
                'L_AUTH_TITLE'      => $lang['xd_permissions'],
                'L_USERNAME'        => $lang['Username'],
                'L_PERMISSIONS'     => $lang['Permissions'],
                'L_AUTH_EXPLAIN'    => $lang['xd_permissions_describe'],
                'L_FIELD_NAME'      => $lang['field_name'],
                'L_ALLOW'           => $lang['Allow'],
                'L_DEFAULT'         => $lang['Default'],
                'L_DENY'            => $lang['Deny'],
                'L_SUBMIT'          => $lang['Submit'],
                'L_RESET'           => $lang['Reset'],
                'AUTH_ALLOW'        => XD_AUTH_ALLOW,
                'AUTH_DENY'         => XD_AUTH_DENY,
                'AUTH_DEFAULT'      => XD_AUTH_DEFAULT,
                'USERNAME'          => $username,
                'S_HIDDEN_FIELDS'   => '<input type="hidden" name="'.POST_USERS_URL.'" value="'.$user_id.'" /><input type="hidden" name="mode" value="save" /><input type="hidden" name="type" value="user" />',
                'S_AUTH_ACTION'     => admin_sid('admin_xdata_auth.php')
                )
            );
            while ( list($code_name, $meta) = each($xd_meta) ) {
                $sql = "SELECT xa.auth_value
                        FROM (" . XDATA_AUTH_TABLE . " xa, " . USER_GROUP_TABLE . " ug)
                        WHERE xa.field_id = {$meta['field_id']}
                        AND xa.group_id = ug.group_id
                        AND ug.user_id = {$user_id}";
                if ( ! ( $result = $db->sql_query($sql) ) ) {
                    message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_user_auth'], "", __LINE__, __FILE__, $sql);
                }
                $row = $db->sql_fetchrow($result);
                $auth = isset($row['auth_value']) ? $row['auth_value'] : XD_AUTH_DEFAULT;
                $template->assign_block_vars( 'xdata', array(
                    'CODE_NAME' => $code_name,
                    'NAME' => $meta['field_name'],
                    'ALLOW_CHECKED'     => ( ( $auth == XD_AUTH_ALLOW ) ? 'checked="checked" ' : '' ),
                    'DENY_CHECKED'      => ( ( $auth == XD_AUTH_DENY ) ? 'checked="checked" ' : '' ),
                    'DEFAULT_CHECKED'   => ( ($auth == XD_AUTH_DEFAULT ) ? 'checked="checked" ' : '')
                    )
                );
            }
            $template->pparse('body');
        } else {
            //
            // Save the settings
            //
            $sql = "SELECT g.group_id
                    FROM (" . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug)
                    WHERE g.group_id = ug.group_id AND ug.user_id = $user_id";
            if (!($result = $db->sql_query($sql))) {
                message_die(GENERAL_ERROR, $lang['XData_error_obtaining_usergroup'], "", __LINE__, __FILE__, $sql);
            }
            $personal_group = $db->sql_fetchrow($result);
            $personal_group = $personal_group['group_id'];
            while ( list($code_name, $meta) = each($xd_meta) ) {
                $auth = str_replace("\'", "''", htmlspecialchars($_GETVAR->get("xd_$code_name", 'post', 'string', NULL)) );
                $sql = "DELETE FROM " . XDATA_AUTH_TABLE . "
                        WHERE group_id = $personal_group
                        AND field_id = {$meta['field_id']}";
                if (! $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, $lang['XData_error_updating_auth'], "", __LINE__, __FILE__, $sql);
                }
                if ( $auth != XD_AUTH_DEFAULT ) {
                    $sql = "INSERT INTO " . XDATA_AUTH_TABLE . " (group_id, field_id, auth_value)
                            VALUES ({$personal_group}, {$meta['field_id']}, {$auth})";
                    if (! $db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, $lang['XData_error_updating_auth'], "", __LINE__, __FILE__, $sql);
                    }
                }
            }
            $message = sprintf($lang['XData_success_updating_permissions'],"<a href=\"" . admin_sid("admin_xdata_auth.php&amp;type=user") . "\">","</a>");
            $message .= sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
        }
    } else {
        //
        // Default user selection box
        //
        $template->set_filenames(array(
            'body' => 'admin/user_select_body.tpl')
        );
        $template->assign_vars(array(
            'L_USER_TITLE'    => $lang['xd_permissions'],
            'L_USER_EXPLAIN'  => $lang['xd_permissions_describe'],
            'L_USER_SELECT'   => $lang['Select_a_User'],
            'L_LOOK_UP'       => $lang['Look_up_user'],
            'L_FIND_USERNAME' => $lang['Find_username'],
            'U_SEARCH_USER'   => append_sid('search.php&amp;mode=searchuser&amp;popup=1&amp;menu=1'),
            'S_USER_ACTION'   => admin_sid('admin_xdata_auth.php&amp;type=user'),
            )
        );
        $template->pparse('body');
    }
} elseif ($type == 'group') {
    if ( ( $mode == 'edit' || $mode == 'save' ) && ( $_GETVAR->get('group', 'post', 'int', NULL) || $_GETVAR->get(POST_GROUPS_URL, 'request', 'int', NULL) ) ) {
        $xd_meta = get_xd_metadata();
        if ( $_GETVAR->get('group', 'post', 'int', NULL) ) {
            $group_id = $_GETVAR->get('group', 'post', 'int', NULL);
        } else {
            $group_id = $_GETVAR->get(POST_GROUPS_URL, 'request', 'int', NULL);
        }
        if ( !($_GETVAR->get('submit', 'post', 'string', NULL)) ) {
            //
            // Show the edit form
            //
            $template->set_filenames( array(
                'body' => 'admin/xd_auth_body.tpl'
                )
            );
            $sql = "SELECT group_name FROM " . GROUPS_TABLE . "
                    WHERE group_id = {$group_id}";
            if (!($result = $db->sql_query($sql))) {
                message_die(GENERAL_ERROR, $lang['XData_error_obtaining_group_data'], "", __LINE__, __FILE__, $sql);
            }
            $group_name = $db->sql_fetchrow($result);
            $group_name = $group_name['group_name'];
            $template->assign_vars( array(
                'L_AUTH_TITLE'      => $lang['xd_group_permissions'],
                'L_USERNAME'        => $lang['group_name'],
                'L_PERMISSIONS'     => $lang['Permissions'],
                'L_AUTH_EXPLAIN'    => $lang['xd_group_permissions_describe'],
                'L_FIELD_NAME'      => $lang['field_name'],
                'L_ALLOW'           => $lang['Allow'],
                'L_DEFAULT'         => $lang['Default'],
                'L_DENY'            => $lang['Deny'],
                'L_SUBMIT'          => $lang['Submit'],
                'L_RESET'           => $lang['Reset'],
                'AUTH_ALLOW'        => XD_AUTH_ALLOW,
                'AUTH_DENY'         => XD_AUTH_DENY,
                'AUTH_DEFAULT'      => XD_AUTH_DEFAULT,
                'USERNAME'          => $group_name,
                'S_HIDDEN_FIELDS'   => '<input type="hidden" name="'.POST_GROUPS_URL.'" value="'.$group_id.'" /><input type="hidden" name="mode" value="save" /><input type="hidden" name="type" value="group" />',
                'S_AUTH_ACTION'     => admin_sid('admin_xdata_auth.php')
                )
            );
            while ( list($code_name, $meta) = each($xd_meta) ) {
                $sql = "SELECT xa.auth_value FROM " . XDATA_AUTH_TABLE . " xa
                        WHERE xa.field_id = {$meta['field_id']}
                        AND xa.group_id = {$group_id}";
                if ( ! ( $result = $db->sql_query($sql) ) ) {
                    message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_user_auth'], "", __LINE__, __FILE__, $sql);
                }
                $row = $db->sql_fetchrow($result);
                $auth = isset($row['auth_value']) ? $row['auth_value'] : XD_AUTH_DEFAULT;
                $template->assign_block_vars( 'xdata', array(
                    'CODE_NAME'         => $code_name,
                    'NAME'              => $meta['field_name'],
                    'ALLOW_CHECKED'     => ( ( $auth == XD_AUTH_ALLOW ) ? 'checked="checked" ' : '' ),
                    'DENY_CHECKED'      => ( ( $auth == XD_AUTH_DENY ) ? 'checked="checked" ' : '' ),
                    'DEFAULT_CHECKED'   => ( ($auth == XD_AUTH_DEFAULT ) ? 'checked="checked" ' : '')
                    )
                );
            }
            $template->pparse('body');
        } else {
            //
            // Save the settings
            //
            while ( list($code_name, $meta) = each($xd_meta) ) {
                $auth = htmlspecialchars($_GETVAR->get("xd_$code_name", 'post', 'string', NULL));
                $sql = "DELETE FROM " . XDATA_AUTH_TABLE . "
                        WHERE group_id = $group_id
                        AND field_id = {$meta['field_id']}";
                if (! $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, $lang['XData_error_updating_auth'], "", __LINE__, __FILE__, $sql);
                }
                if ( $auth != XD_AUTH_DEFAULT ) {
                    $sql = "INSERT INTO " . XDATA_AUTH_TABLE . " (group_id, field_id, auth_value)
                            VALUES ({$group_id}, {$meta['field_id']}, {$auth})";
                    if (! $db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, $lang['XData_error_updating_auth'], "", __LINE__, __FILE__, $sql);
                    }
                }
            }
            $message = sprintf($lang['XData_success_updating_permissions'],"<a href=\"" . admin_sid("admin_xdata_auth.php&amp;type=user") . "\">","</a>");
            $message .= sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
        }
    } else {
        $template->set_filenames( array('body' => 'admin/auth_select_body.tpl') );
        $sql = "SELECT group_id, group_name
                FROM " . GROUPS_TABLE . "
                WHERE group_single_user <> " . TRUE;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, $lang['XData_error_obtaining_group_data'], "", __LINE__, __FILE__, $sql);
        }
        if ( $row = $db->sql_fetchrow($result) ) {
            $select_list = '<select name="' . POST_GROUPS_URL . '">';
            do {
                $select_list .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
            } while ( $row = $db->sql_fetchrow($result) );
            $select_list .= '</select>';
        }
        $template->assign_vars(array(
            'S_AUTH_SELECT' => $select_list)
        );
        $s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="type" value="group" />';
        $template->assign_vars(array(
            'L_AUTH_TITLE'      => $lang['xd_group_permissions'],
            'L_AUTH_EXPLAIN'    => $lang['xd_group_permissions_describe'],
            'L_AUTH_SELECT'     => $lang['Select_a_Group'],
            'L_LOOK_UP'         => $lang['Look_up_Group'],
            'S_HIDDEN_FIELDS'   => $s_hidden_fields,
            'S_AUTH_ACTION'     => admin_sid('admin_xdata_auth.php'))
        );
        $template->pparse('body');
    }
}
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
?>