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
      $module['Users']['Permissions'] = $filename . "&amp;mode=user";
      $module['Groups']['Permissions'] = $filename . "&amp;mode=group";
      return;
  }
}

//
// Load default header
//
$no_page_header = TRUE;

global $_GETVAR, $currentlang;

$user_id    = $_GETVAR->get(POST_USERS_URL, '_REQUEST', 'int');
$group_id   = $_GETVAR->get(POST_GROUPS_URL, '_REQUEST', 'int');
$adv        = $_GETVAR->get('adv', '_REQUEST', 'int');
$mode       = $_GETVAR->get('mode', '_REQUEST');
$submit     = $_GETVAR->get('submit', '_REQUEST');
$username   = $_GETVAR->get('username', '_REQUEST');
$userlevel  = $_GETVAR->get('userlevel', '_REQUEST');

$lang_file = '/lang_admin_attach.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

//
// Start program - define vars
//
include_once( NUKE_FORUMS_DIR . 'cat_mod/includes/def_auth.php' );
// build an indexed array on field names
@reset($field_names);
$forum_auth_fields = array();
while ( list($auth_key, $auth_name) = @each($field_names) ) {
  $forum_auth_fields[] = $auth_key;
}
attach_setup_usergroup_auth($forum_auth_fields, $auth_field_match, $field_names);

// ---------------
// Start Functions
//
function check_auth($type, $key, $u_access, $is_admin) {
    $auth_user = 0;
    if( count($u_access) ) {
        for($j = 0; $j < count($u_access); $j++) {
            $result = 0;
            switch($type) {
                case AUTH_ACL:
                        $result = $u_access[$j][$key];
                        break;
                case AUTH_MOD:
                        $result = $result || $u_access[$j]['auth_mod'];
                        break;
                case AUTH_ADMIN:
                        $result = $result || $is_admin;
                        break;
            }
            $auth_user = $auth_user || $result;
        }
    } else {
        $auth_user = $is_admin;
    }
    return $auth_user;
}
//
// End Functions
// -------------
if ( !empty($submit) && ( ( $mode == 'user' && $user_id ) || ( $mode == 'group' && $group_id ) ) ) {
    $user_level = '';
    if ( $mode == 'user' ) {
        //
        // Get group_id for this user_id
        //
        $sql = "SELECT g.group_id, u.user_level
                FROM (" . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u, " . GROUPS_TABLE . " g)
                WHERE u.user_id = $user_id
                AND ug.user_id = u.user_id
                AND g.group_id = ug.group_id
                AND g.group_single_user = " . TRUE;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not select info from user/user_group table', '', __LINE__, __FILE__, $sql);
        }
        $row = $db->sql_fetchrow($result);
        $group_id = intval($row['group_id']);
        $user_level = intval($row['user_level']);
        if ( !($group_id) ) {
            message_die(GENERAL_ERROR, 'The selected user has NO user_group - that is an heavy error', '', __LINE__, __FILE__, $sql);
        }
        $db->sql_freeresult($result);
    }
    //
    // Carry out requests
    //
    if ( ($mode == 'user') &&  ($userlevel == 'admin')   &&  ($user_level != ADMIN)  ) {
        //
        // Make user an admin (if already user)
        //
        if ( $userdata['user_id'] != $user_id ) {
            $sql = "UPDATE " . USERS_TABLE . "
                    SET user_level = " . ADMIN . "
                    WHERE user_id = '$user_id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
            }
            $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                    WHERE group_id = '$group_id'
                    AND auth_mod = '0'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Couldn't delete auth access info", "", __LINE__, __FILE__, $sql);
            }
            //
            // Delete any entries in auth_access, they are not required if user is becoming an
            // admin
            //
            $sql = "UPDATE " . AUTH_ACCESS_TABLE . "
                    SET auth_view = '0', auth_read = '0', auth_post = '0', auth_reply = '0', auth_edit = '0', auth_delete = '0', auth_sticky = '0', auth_announce = '0', auth_globalannounce = 0
                    WHERE group_id = '$group_id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Couldn't update auth access", "", __LINE__, __FILE__, $sql);
            }
        }
        cache_tree(TRUE);
        $message = $lang['Auth_updated'] . '<br /><br />' . sprintf($lang['Click_return_userauth'], '<a href="' . admin_sid("admin_ug_auth.php&amp;mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    } else {
        if  ( ($mode == 'user') &&  ($userlevel == 'user')  &&  ($user_level == ADMIN)  ) {
            //
            // Make admin a user (if already admin) ... ignore if you're trying
            // to change yourself from an admin to user!
            //
            if ( $userdata['user_id'] != $user_id ) {
                $sql = "UPDATE " . AUTH_ACCESS_TABLE . "
                        SET auth_view = '0', auth_read = '0', auth_post = '0', auth_reply = '0', auth_edit = '0', auth_delete = '0', auth_sticky = '0', auth_announce = '0', auth_globalannounce = 0
                        WHERE group_id = '$group_id'";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not update auth access', '', __LINE__, __FILE__, $sql);
                }
                //
                // Update users level, reset to USER
                //
                $sql = "UPDATE " . USERS_TABLE . "
                        SET user_level = " . USER . "
                        WHERE user_id = $user_id";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                }
            }
            $message = $lang['Auth_updated'] . '<br /><br />' . sprintf($lang['Click_return_userauth'], '<a href="' . admin_sid("admin_ug_auth.php&amp;mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');
        } else {
            $change_mod_list = ( isset($HTTP_POST_VARS['moderator']) ) ? $HTTP_POST_VARS['moderator'] : array();
            if ( empty($adv) ) {
                $sql = "SELECT f.*
                        FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
                        WHERE f.cat_id = c.cat_id
                        ORDER BY c.cat_order, f.forum_order ASC";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Couldn't obtain forum information", "", __LINE__, __FILE__, $sql);
                }
                $forum_access = $forum_auth_level_fields = array();
                while( $row = $db->sql_fetchrow($result) ) {
                    $forum_access[] = $row;
                }
                $db->sql_freeresult($result);
                for($i = 0; $i < count($forum_access); $i++) {
                    $forum_id = $forum_access[$i]['forum_id'];
                    for($j = 0; $j < count($forum_auth_fields); $j++) {
                        $forum_auth_level_fields[$forum_id][$forum_auth_fields[$j]] = $forum_access[$i][$forum_auth_fields[$j]] == AUTH_ACL;
                    }
                }
                while( list($forum_id, $value) = @each($HTTP_POST_VARS['private']) ) {
                    while( list($auth_field, $exists) = @each($forum_auth_level_fields[$forum_id]) ) {
                        if ($exists) {
                            $change_acl_list[$forum_id][$auth_field] = $value;
                        }
                    }
                }
            } else {
                $change_acl_list = array();
                for($j = 0; $j < count($forum_auth_fields); $j++) {
                    $auth_field = $forum_auth_fields[$j];
                    while( list($forum_id, $value) = @each($HTTP_POST_VARS['private_' . $auth_field]) ) {
                        $change_acl_list[$forum_id][$auth_field] = $value;
                    }
                }
            }
            // get all sorted by level
            $keys = array();
            $keys = get_auth_keys('Root', TRUE);
            $forum_access = array();

            // extract forums
            $forum_access = array();
            for ($i=0; $i < count($keys['id']); $i++) {
                if (isset($tree['type'][ $keys['idx'][$i] ]) && ($tree['type'][ $keys['idx'][$i] ] == POST_FORUM_URL)) {
                    $forum_access[] = $tree['data'][ $keys['idx'][$i] ];
                }
            }
            $sql = ( $mode == 'user' ) ? "SELECT aa.* FROM (" . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE. " g) WHERE ug.user_id = $user_id AND g.group_id = ug.group_id AND aa.group_id = ug.group_id AND g.group_single_user = " . TRUE : "SELECT * FROM " . AUTH_ACCESS_TABLE . " WHERE group_id = '$group_id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
            }
            $auth_access = array();
            while( $row = $db->sql_fetchrow($result) ) {
                $auth_access[$row['forum_id']] = $row;
            }
            $db->sql_freeresult($result);
            $forum_auth_action = array();
            $update_acl_status = array();
            $update_mod_status = array();
            for($i = 0; $i < count($forum_access); $i++) {
                $forum_id = $forum_access[$i]['forum_id'];
                if ( ( isset($auth_access[$forum_id]['auth_mod']) && $change_mod_list[$forum_id] != $auth_access[$forum_id]['auth_mod'] ) ||
                     ( !isset($auth_access[$forum_id]['auth_mod']) && !empty($change_mod_list[$forum_id]) ) ) {
                    $update_mod_status[$forum_id] = $change_mod_list[$forum_id];
                    if ( !$update_mod_status[$forum_id] ) {
                        $forum_auth_action[$forum_id] = 'delete';
                    } else if ( !isset($auth_access[$forum_id]['auth_mod']) ) {
                        $forum_auth_action[$forum_id] = 'insert';
                    } else {
                        $forum_auth_action[$forum_id] = 'update';
                    }
                }
                for($j = 0; $j < count($forum_auth_fields); $j++) {
                    $auth_field = $forum_auth_fields[$j];
                    if( $forum_access[$i][$auth_field] == AUTH_ACL && isset($change_acl_list[$forum_id][$auth_field]) ) {
                        if ( ( empty($auth_access[$forum_id]['auth_mod']) && ( isset($auth_access[$forum_id][$auth_field]) && $change_acl_list[$forum_id][$auth_field] != $auth_access[$forum_id][$auth_field] ) ||
                             ( !isset($auth_access[$forum_id][$auth_field]) && !empty($change_acl_list[$forum_id][$auth_field]) ) ) || !empty($update_mod_status[$forum_id]) ) {
                            $update_acl_status[$forum_id][$auth_field] = ( !empty($update_mod_status[$forum_id]) ) ? 0 :  $change_acl_list[$forum_id][$auth_field];
                            if ( isset($auth_access[$forum_id][$auth_field]) && empty($update_acl_status[$forum_id][$auth_field]) && $forum_auth_action[$forum_id] != 'insert' && $forum_auth_action[$forum_id] != 'update' ) {
                                $forum_auth_action[$forum_id] = 'delete';
                            } else if ( !isset($auth_access[$forum_id][$auth_field]) && !( $forum_auth_action[$forum_id] == 'delete' && empty($update_acl_status[$forum_id][$auth_field]) ) ) {
                                $forum_auth_action[$forum_id] = 'insert';
                            } else if ( isset($auth_access[$forum_id][$auth_field]) && !empty($update_acl_status[$forum_id][$auth_field]) ) {
                                $forum_auth_action[$forum_id] = 'update';
                            }
                        } else if ( ( isset($auth_access[$forum_id][$auth_field]) && (isset($auth_access[$forum_id]['auth_mod']) && empty($auth_access[$forum_id]['auth_mod'])) &&  (isset($change_acl_list[$forum_id][$auth_field]) && $change_acl_list[$forum_id][$auth_field] == $auth_access[$forum_id][$auth_field]) ) && (isset($forum_auth_action[$forum_id]) && $forum_auth_action[$forum_id] == 'delete') ) {
                            $forum_auth_action[$forum_id] = 'update';
                        }
                     }
                }
            }
            //
            // Checks complete, make updates to DB
            //
            $delete_sql = '';
            while( list($forum_id, $action) = @each($forum_auth_action) ) {
                if ( $action == 'delete' ) {
                    $delete_sql .= ( ( $delete_sql != '' ) ? ', ' : '' ) . $forum_id;
                } else {
                    if ( $action == 'insert' ) {
                        $sql_field = '';
                        $sql_value = '';
                        while ( list($auth_type, $value) = @each($update_acl_status[$forum_id]) ) {
                            $sql_field .= ( ( $sql_field != '' ) ? ', ' : '' ) . $auth_type;
                            $sql_value .= ( ( $sql_value != '' ) ? ', ' : '' ) . $value;
                        }
                        $sql_field .= ( ( $sql_field != '' ) ? ', ' : '' ) . 'auth_mod';
                        $sql_value .= ( ( $sql_value != '' ) ? ', ' : '' ) . ( ( !isset($update_mod_status[$forum_id]) ) ? 0 : $update_mod_status[$forum_id]);
                        $sql = "INSERT IGNORE INTO " . AUTH_ACCESS_TABLE . " (forum_id, group_id, $sql_field)
                                VALUES ($forum_id, $group_id, $sql_value)";
                    } else {
                        $sql_values = '';
                        while ( list($auth_type, $value) = @each($update_acl_status[$forum_id]) ) {
                            $sql_values .= ( ( $sql_values != '' ) ? ', ' : '' ) . $auth_type . ' = ' . $value;
                        }
                        $sql_values .= ( ( $sql_values != '' ) ? ', ' : '' ) . 'auth_mod = ' . ( ( !isset($update_mod_status[$forum_id]) ) ? 0 : $update_mod_status[$forum_id]);
                        $sql = "UPDATE " . AUTH_ACCESS_TABLE . "
                                SET $sql_values
                                WHERE group_id = '$group_id'
                                AND forum_id = '$forum_id'";
                    }
                    if( !($result = $db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, "Couldn't update private forum permissions", "", __LINE__, __FILE__, $sql);
                    }
                }
            }
            if ( $delete_sql != '' ) {
                $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                        WHERE group_id = '$group_id'
                        AND forum_id IN ($delete_sql)";
                if( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Couldn't delete permission entries", "", __LINE__, __FILE__, $sql);
                }
            }
            $l_auth_return = ( $mode == 'user' ) ? $lang['Click_return_userauth'] : $lang['Click_return_groupauth'];
            $message = $lang['Auth_updated'] . '<br /><br />' . sprintf($l_auth_return, '<a href="' . admin_sid("admin_ug_auth.php&amp;mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');
        }
        //
        // Update user level to mod for appropriate users
        //
        $sql = "SELECT u.user_id
                FROM (" . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u)
                WHERE ug.group_id = aa.group_id
                AND u.user_id = ug.user_id
                AND ug.user_pending = 0
                AND u.user_level NOT IN (" . MOD . ", " . ADMIN . ")
                GROUP BY u.user_id
                HAVING SUM(aa.auth_mod) > 0";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
        }
        $set_mod = '';
        while( $row = $db->sql_fetchrow($result) ) {
            $set_mod .= ( ( $set_mod != '' ) ? ', ' : '' ) . $row['user_id'];
        }
        $db->sql_freeresult($result);
        //
        // Update user level to user for appropriate users
        //
        $sql = "SELECT u.user_id
                FROM ( ( " . USERS_TABLE . " u
                LEFT JOIN " . USER_GROUP_TABLE . " ug ON ug.user_id = u.user_id )
                LEFT JOIN " . AUTH_ACCESS_TABLE . " aa ON aa.group_id = ug.group_id )
                WHERE u.user_level NOT IN (" . USER . ", " . ADMIN . ")
                GROUP BY u.user_id
                HAVING SUM(aa.auth_mod) = 0";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
        }
        $unset_mod = "";
        while( $row = $db->sql_fetchrow($result) ) {
            $unset_mod .= ( ( $unset_mod != '' ) ? ', ' : '' ) . $row['user_id'];
        }
        $db->sql_freeresult($result);
        if ( $set_mod != '' ) {
            $sql = "UPDATE " . USERS_TABLE . "
                    SET user_level = " . MOD . "
                    WHERE user_id IN ($set_mod)";
            if( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Couldn't update user level", "", __LINE__, __FILE__, $sql);
            }
        }
        cache_tree(TRUE);
        if ( $unset_mod != '' ) {
            $sql = "UPDATE " . USERS_TABLE . "
                    SET user_level = " . USER . "
                    WHERE user_id IN ($unset_mod)";
            if( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, "Couldn't update user level", "", __LINE__, __FILE__, $sql);
            }
        }
        $sql = "SELECT user_id FROM " . USER_GROUP_TABLE . "
                WHERE group_id = '$group_id'";
        $result = $db->sql_query($sql);
        $group_user = array();
        while ($row = $db->sql_fetchrow($result)) {
            $group_user[$row['user_id']] = $row['user_id'];
        }
        $db->sql_freeresult($result);
        $sql = "SELECT ug.user_id, COUNT(auth_mod) AS is_auth_mod
                FROM (" . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug)";
        if ( !empty($group_user)) {
            $sql .= "WHERE ug.user_id IN (" . implode(', ', $group_user) . ")
                AND aa.group_id = ug.group_id
                AND aa.auth_mod = 1
                GROUP BY ug.user_id";
        } else {
            $sql .= "WHERE aa.group_id = ug.group_id
                AND aa.auth_mod = 1
                GROUP BY ug.user_id";
        }
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not obtain moderator status', '', __LINE__, __FILE__, $sql);
        }
        while ($row = $db->sql_fetchrow($result)) {
            if ($row['is_auth_mod']) {
                unset($group_user[$row['user_id']]);
            }
        }
        $db->sql_freeresult($result);
        if (count($group_user)) {
            $sql = "UPDATE " . USERS_TABLE . "
                    SET user_level = " . USER . "
                    WHERE user_id IN (" . implode(', ', $group_user) . ") AND user_level = " . MOD;
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
            }
        }
        message_die(GENERAL_MESSAGE, $message);
        $cache->delete('forum_moderators', 'config');
    }
} else if ( ( $mode == 'user' && (!empty($username) || $user_id ) ) || ( $mode == 'group' && !empty($group_id) ) ) {
    if ( !empty($username) ) {
        $this_userdata = get_userdata($username, TRUE);
        if ( !is_array($this_userdata) ) {
            message_die(GENERAL_MESSAGE, $lang['No_such_user']);
        }
        $user_id = $this_userdata['user_id'];
    }
    //
    // Front end
    //
    // get all sorted by level
    $keys = array();
    $keys = get_auth_keys('Root', TRUE);
    // get the maximum level
    $max_level = 0;
    for ($i=0; $i < count($keys['id']); $i++) {
        if ($keys['real_level'][$i] > $max_level) {
            $max_level = $keys['real_level'][$i];
        }
    }
    // extract forums
    $forum_access = array();
    for ($i=0; $i < count($keys['id']); $i++) {
        if ((isset($tree['type'][ $keys['idx'][$i] ])) && ($tree['type'][ $keys['idx'][$i] ] == POST_FORUM_URL)) {
            $forum_access[] = $tree['data'][ $keys['idx'][$i] ];
        }
    }
    if( empty($adv) ) {
        for($i = 0; $i < count($forum_access); $i++) {
            $forum_id = $forum_access[$i]['forum_id'];
            $forum_auth_level[$forum_id] = AUTH_ALL;
            for($j = 0; $j < count($forum_auth_fields); $j++) {
                $forum_access[$i][$forum_auth_fields[$j]] . ' :: ';
                if ( $forum_access[$i][$forum_auth_fields[$j]] == AUTH_ACL ) {
                    $forum_auth_level[$forum_id] = AUTH_ACL;
                    $forum_auth_level_fields[$forum_id][] = $forum_auth_fields[$j];
                }
            }
        }
    }
    //
    // Check if a private user group existis for this user and if not, create one.
    //
    $sql = "SELECT user_id FROM " . USER_GROUP_TABLE . " WHERE user_id = '$user_id'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $user_check = $row['user_id'];
    if ( $user_check != $user_id ) {
        $sql = "SELECT MAX(group_id) AS total
                FROM " . GROUPS_TABLE;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not select last group_id information', '', __LINE__, __FILE__, $sql);
        }
        if ( !($row = $db->sql_fetchrow($result)) ) {
            message_die(GENERAL_ERROR, 'Could not obtain next group_id information', '', __LINE__, __FILE__, $sql);
        }
        $group_id = $row['total'] + 1;
        $sql = "INSERT INTO " . GROUPS_TABLE . " (group_id, group_name, group_description, group_single_user, group_moderator)
                VALUES ('$group_id', '', 'Personal User', '1', '0')";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not create private group', '', __LINE__, __FILE__, $sql);
        }
        $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                VALUES ('$group_id', '$user_id', '0')";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not create private group', '', __LINE__, __FILE__, $sql);
        }
    }
    //
    //  End Private group check.
    //
    $sql = "SELECT u.user_id, u.username, u.user_level, g.group_id, g.group_name, g.group_single_user, ug.user_pending FROM (" . USERS_TABLE . " u, " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug) WHERE ";
    $sql .= ( $mode == 'user' ) ? "u.user_id = '$user_id' AND ug.user_id = u.user_id AND g.group_id = ug.group_id" : "g.group_id = '$group_id' AND ug.group_id = g.group_id AND u.user_id = ug.user_id";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Couldn't obtain user/group information", "", __LINE__, __FILE__, $sql);
    }
    $ug_info = array();
    $counter = 0;
    while( $row = $db->sql_fetchrow($result) ) {
        $ug_info[$counter] = $row;
        $counter++;
    }
    $db->sql_freeresult($result);
    $sql = ( $mode == 'user' ) ? "SELECT aa.*, g.group_single_user FROM (" . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE. " g) WHERE ug.user_id = $user_id AND g.group_id = ug.group_id AND aa.group_id = ug.group_id AND g.group_single_user = 1" : "SELECT * FROM " . AUTH_ACCESS_TABLE . " WHERE group_id = '$group_id'";
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
    }
    $auth_access = array();
    $auth_access_count = array();    
    while( $row = $db->sql_fetchrow($result) ) {
        $auth_access[$row['forum_id']][] = $row;
        if ( isset($auth_access_count[$row['forum_id']])) {
            $auth_access_count[$row['forum_id']]++;
        } else {
            $auth_access_count[$row['forum_id']] = 1;
        }
    }
    $db->sql_freeresult($result);
    $is_admin = ( $mode == 'user' ) ? ( ( $ug_info[0]['user_level'] == ADMIN && $ug_info[0]['user_id'] != ANONYMOUS ) ? 1 : 0 ) : 0;
    for($i = 0; $i < count($forum_access); $i++) {
        $forum_id = $forum_access[$i]['forum_id'];
        unset($prev_acl_setting);
        for($j = 0; $j < count($forum_auth_fields); $j++) {
            $key = $forum_auth_fields[$j];
            $value = $forum_access[$i][$key];
            switch( $value ) {
                case AUTH_ALL:
                case AUTH_REG:
                    $auth_ug[$forum_id][$key] = 1;
                    break;
                case AUTH_ACL:
                    $auth_ug[$forum_id][$key] = ( !empty($auth_access_count[$forum_id]) ) ? check_auth(AUTH_ACL, $key, $auth_access[$forum_id], $is_admin) : 0;
                    $auth_field_acl[$forum_id][$key] = $auth_ug[$forum_id][$key];
                    if ( isset($prev_acl_setting) ) {
                        if ( $prev_acl_setting != $auth_ug[$forum_id][$key] && empty($adv) ) {
                            $adv = 1;
                        }
                    }
                    $prev_acl_setting = $auth_ug[$forum_id][$key];
                    break;
                case AUTH_MOD:
                    $auth_ug[$forum_id][$key] = ( !empty($auth_access_count[$forum_id]) ) ? check_auth(AUTH_MOD, $key, $auth_access[$forum_id], $is_admin) : 0;
                    break;
                case AUTH_ADMIN:
                    $auth_ug[$forum_id][$key] = $is_admin;
                    break;
                default:
                    $auth_ug[$forum_id][$key] = 0;
                    break;
            }
        }
        //
        // Is user a moderator?
        //
        $auth_ug[$forum_id]['auth_mod'] = ( !empty($auth_access_count[$forum_id]) ) ? check_auth(AUTH_MOD, 'auth_mod', $auth_access[$forum_id], 0) : 0;
    }
    $s_column_span = 2 + $max_level; // Two columns always present
    if( $adv ) {
        $s_column_span = $s_column_span + count($forum_auth_fields)-1;
    }
    // read the objects without the index forum (i=0)
    for ($i=1; $i < count($keys['id']); $i++) {
        $this_var = $keys['idx'][$i];
        $level  = $keys['real_level'][$i];
        if ($tree['type'][$this_var] == POST_CAT_URL) {
            $class_cat = 'cat';
            $template->assign_block_vars('row', array());
            $template->assign_block_vars('row.cathead', array(
                'CLASS_CAT' => $class_cat,
                'CAT_TITLE' => get_object_lang( $tree['type'][$this_var] . $tree['id'][$this_var], 'name', true),
                'INC_SPAN'  => $max_level - $level+1,
                )
            );
            for ($k=1; $k <= $level; $k++) {
                $template->assign_block_vars('row.cathead.inc', array());
            }
            if ($adv) {
                for ($j=0; $j < count($forum_auth_fields); $j++) {
                    $template->assign_block_vars('row.cathead.aclvalues', array());
                }
            } else {
                $template->assign_block_vars('row.cathead.aclvalues', array());
            }
        }
        if ($tree['type'][$this_var] == POST_FORUM_URL) {
            $forum_id = $tree['data'][ $keys['idx'][$i] ]['forum_id'];
            $user_ary = $auth_ug[$forum_id];
            if ( empty($adv) ) {
                if ( $forum_auth_level[$forum_id] == AUTH_ACL ) {
                    $allowed = 1;
                    for($j = 0; $j < count($forum_auth_level_fields[$forum_id]); $j++) {
                        if ( !$auth_ug[$forum_id][$forum_auth_level_fields[$forum_id][$j]] ) {
                            $allowed = 0;
                        }
                    }
                    $optionlist_acl = '<select name="private[' . $forum_id . ']">';
                    if ( $is_admin || $user_ary['auth_mod'] ) {
                        $optionlist_acl .= '<option value="1">' . $lang['Allowed_Access'] . '</option>';
                    } else if ( $allowed ) {
                        $optionlist_acl .= '<option value="1" selected="selected">' . $lang['Allowed_Access'] . '</option><option value="0">'. $lang['Disallowed_Access'] . '</option>';
                    } else {
                        $optionlist_acl .= '<option value="1">' . $lang['Allowed_Access'] . '</option><option value="0" selected="selected">' . $lang['Disallowed_Access'] . '</option>';
                    }
                    $optionlist_acl .= '</select>';
                } else {
                    $optionlist_acl = '&nbsp;';
                }
            } else {
                for($j = 0; $j < count($forum_access); $j++) {
                    if ( $forum_access[$j]['forum_id'] == $forum_id ) {
                        for($k = 0; $k < count($forum_auth_fields); $k++) {
                            $field_name = $forum_auth_fields[$k];
                            if( $forum_access[$j][$field_name] == AUTH_ACL ) {
                                $optionlist_acl_adv[$forum_id][$k] = '<select name="private_' . $field_name . '[' . $forum_id . ']">';
                                if( isset($auth_field_acl[$forum_id][$field_name]) && !($is_admin || $user_ary['auth_mod']) ) {
                                    if( !$auth_field_acl[$forum_id][$field_name] ) {
                                        $optionlist_acl_adv[$forum_id][$k] .= '<option value="1">' . $lang['ON'] . '</option><option value="0" selected="selected">' . $lang['OFF'] . '</option>';
                                    } else {
                                        $optionlist_acl_adv[$forum_id][$k] .= '<option value="1" selected="selected">' . $lang['ON'] . '</option><option value="0">' . $lang['OFF'] . '</option>';
                                    }
                                } else {
                                    if( $is_admin || $user_ary['auth_mod'] ) {
                                        $optionlist_acl_adv[$forum_id][$k] .= '<option value="1">' . $lang['ON'] . '</option>';
                                    } else {
                                        $optionlist_acl_adv[$forum_id][$k] .= '<option value="1">' . $lang['ON'] . '</option><option value="0" selected="selected">' . $lang['OFF'] . '</option>';
                                    }
                                }
                                $optionlist_acl_adv[$forum_id][$k] .= '</select>';
                            }
                        }
                    }
                }
            }
            $optionlist_mod = '<select name="moderator[' . $forum_id . ']">';
            $optionlist_mod .= ( $user_ary['auth_mod'] ) ? '<option value="1" selected="selected">' . $lang['Is_Moderator'] . '</option><option value="0">' . $lang['Not_Moderator'] . '</option>' : '<option value="1">' . $lang['Is_Moderator'] . '</option><option value="0" selected="selected">' . $lang['Not_Moderator'] . '</option>';
            $optionlist_mod .= '</select>';
            $row_class = ( !( $i % 2 ) ) ? 'row2' : 'row1';
            $row_color = ( !( $i % 2 ) ) ? $theme['td_color1'] : $theme['td_color2'];
            $template->assign_block_vars('row', array());
            $template->assign_block_vars('row.forums', array(
                'INC_SPAN' => $max_level - $level+1,
                'ROW_COLOR' => '#' . $row_color,
                'ROW_CLASS' => $row_class,
                'FORUM_NAME'  => get_object_lang(POST_FORUM_URL . $tree['data'][ $keys['idx'][$i] ]['forum_id'], 'name', true),
                'U_FORUM_AUTH'  => admin_sid('admin_forumauth.php?f=' . $tree['data'][ $keys['idx'][$i] ]['forum_id']),
                'S_MOD_SELECT' => $optionlist_mod)
            );
            for ($k=1; $k <= $level; $k++) {
                $template->assign_block_vars('row.forums.inc', array());
            }
            if( !$adv ) {
                $template->assign_block_vars('row.forums.aclvalues', array(
                    'S_ACL_SELECT' => $optionlist_acl)
                );
            } else {
                for($j = 0; $j < count($forum_auth_fields); $j++) {
                    $template->assign_block_vars('row.forums.aclvalues', array(
                        'S_ACL_SELECT' => (isset($optionlist_acl_adv[$forum_id][$j]) ? $optionlist_acl_adv[$forum_id][$j] : ''))
                        );
                }
            }
        }
    }
    //@reset($auth_user);
    if ( $mode == 'user' ) {
        $t_username = $ug_info[0]['username'];
        $s_user_type = ( $is_admin ) ? '<select name="userlevel"><option value="admin" selected="selected">' . $lang['Auth_Admin'] . '</option><option value="user">' . $lang['Auth_User'] . '</option></select>' : '<select name="userlevel"><option value="admin">' . $lang['Auth_Admin'] . '</option><option value="user" selected="selected">' . $lang['Auth_User'] . '</option></select>';
    } else {
        if (!isset($ug_info[0]['group_name'])) {
            $result = $db->sql_ufetchrow("SELECT group_name FROM ".GROUPS_TABLE." WHERE group_id=$group_id");
            $t_groupname = $result['group_name'];
        } else {
            $t_groupname = $ug_info[0]['group_name'];
        }
    }
    $name = array();
    $id = array();
    for($i = 0; $i < count($ug_info); $i++) {
        if( ( $mode == 'user' && !$ug_info[$i]['group_single_user'] ) || $mode == 'group' ) {
            $name[] = ( $mode == 'user' ) ? $ug_info[$i]['group_name'] :  $ug_info[$i]['username'];
            $id[] = ( $mode == 'user' ) ? intval($ug_info[$i]['group_id']) : intval($ug_info[$i]['user_id']);
        }
    }
    $t_usergroup_list = $t_pending_list = '';
    if( count($name) > 0 ) {
        for($i = 0; $i < count($ug_info); $i++) {
            $ug = ( $mode == 'user' ) ? 'group&amp;' . POST_GROUPS_URL : 'user&amp;' . POST_USERS_URL;
            if (!$ug_info[$i]['user_pending'] && isset($name[$i])) {
                $t_usergroup_list .= ( ( $t_usergroup_list != '' ) ? ', ' : '' ) . '<a href="' . admin_sid("admin_ug_auth.php&amp;mode=$ug=" . $id[$i]) . '">' . UsernameColor($name[$i]) . '</a>';
            } elseif ( isset($name[$i]) ) {
                $t_pending_list .= ( ( $t_pending_list != '' ) ? ', ' : '' ) . '<a href="' . admin_sid("admin_ug_auth.php&amp;mode=$ug=" . $id[$i]) . '">' . UsernameColor($name[$i]) . '</a>';
            }
        }
    }
    if ( strlen($t_usergroup_list) > 1 ) {
        $t_usergroup_list = substr($t_usergroup_list, 0, -1);
    } else {
       $t_usergroup_list = $lang['None'];
    }
    if ( strlen($t_pending_list) > 1 ) {
       $t_pending_list = substr($t_pending_list, 0, -1);
    } else {
       $t_pending_list = $lang['None'];
    }
    $s_column_span = 2; // Two columns always present
    if( !$adv ) {
        $template->assign_block_vars('acltype', array(
            'L_UG_ACL_TYPE' => $lang['Simple_Permission'])
        );
        $s_column_span++;
    } else {
        for($i = 0; $i < count($forum_auth_fields); $i++) {
            $cell_title = $field_names[$forum_auth_fields[$i]];
            $template->assign_block_vars('acltype', array(
                'L_UG_ACL_TYPE' => $cell_title)
            );
            $s_column_span++;
        }
    }
    //
    // Dump in the page header ...
    //
    $template->set_filenames(array(
        "body" => 'admin/auth_ug_body.tpl')
    );
    $adv_switch = ( empty($adv) ) ? 1 : 0;
    $u_ug_switch = ( $mode == 'user' ) ? POST_USERS_URL . "=" . $user_id : POST_GROUPS_URL . "=" . $group_id;
    $switch_mode = admin_sid('admin_ug_auth.php&amp;mode=' . $mode . '&amp;' . $u_ug_switch . '&amp;adv=' . $adv_switch);
    $switch_mode_text = ( empty($adv) ) ? $lang['Advanced_mode'] : $lang['Simple_mode'];
    $u_switch_mode = '<a href="' . $switch_mode . '">' . $switch_mode_text . '</a>';
    $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="adv" value="' . $adv . '" />';
    $s_hidden_fields .= ( $mode == 'user' ) ? '<input type="hidden" name="' . POST_USERS_URL . '" value="' . $user_id . '" />' : '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
    if ( $mode == 'user' ) {
        $template->assign_block_vars('switch_user_auth', array());
        $template->assign_vars(array(
            'USERNAME' => UsernameColor($t_username),
            'USER_LEVEL' => $lang['User_Level'] . " : " . $s_user_type,
            'USER_GROUP_MEMBERSHIPS' => $lang['Group_memberships'] . ' : ' . $t_usergroup_list)
        );
    } else {
        $template->assign_block_vars("switch_group_auth", array());
        $template->assign_vars(array(
            'USERNAME' => GroupColor($t_groupname),
            'GROUP_MEMBERSHIP' => $lang['Usergroup_members'] . ' : ' . $t_usergroup_list . '<br />' . $lang['Pending_members'] . ' : ' . $t_pending_list)
        );
    }
    $template->assign_vars(array(
       'L_USER_OR_GROUPNAME' => ( $mode == 'user' ) ? $lang['Username'] : $lang['Group_name'],
       'L_AUTH_TITLE' => ( $mode == 'user' ) ? $lang['Auth_Control_User'] : $lang['Auth_Control_Group'],
       'L_AUTH_EXPLAIN' => ( $mode == 'user' ) ? $lang['User_auth_explain'] : $lang['Group_auth_explain'],
       'L_MODERATOR_STATUS' => $lang['Moderator_status'],
       'L_PERMISSIONS' => $lang['Permissions'],
       'L_SUBMIT' => $lang['Submit'],
       'L_RESET' => $lang['Reset'],
       'L_FORUM' => $lang['Forum'],
       'U_USER_OR_GROUP' => admin_sid('admin_ug_auth.php'),
       'U_SWITCH_MODE' => $u_switch_mode,
       'SPACER'    => '/' . $images['spacer'],
       'INC_SPAN'    => $max_level+1,
       'S_COLUMN_SPAN' => $s_column_span + $max_level+2,
       'S_AUTH_ACTION' => admin_sid('admin_ug_auth.php'),
       'S_HIDDEN_FIELDS' => $s_hidden_fields)
    );
} else {
    //
    // Select a user/group
    //
    $template->set_filenames(array(
        'body' => ( $mode == 'user' ) ? 'admin/user_select_body.tpl' : 'admin/auth_select_body.tpl')
    );
    if ( $mode == 'user' ) {
        $template->assign_vars(array(
            'L_FIND_USERNAME' => $lang['Find_username'],
            'U_SEARCH_USER' => append_sid('search.php?mode=searchuser&amp;popup=1&amp;menu=1'))
        );
    } else {
        $sql = "SELECT group_id, group_name
                FROM " . GROUPS_TABLE . "
                WHERE group_single_user <> " . TRUE . "
                ORDER BY group_name";
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, "Couldn't get group list", "", __LINE__, __FILE__, $sql);
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
    }
    $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
    $l_type = ( $mode == 'user' ) ? 'USER' : 'AUTH';
    $template->assign_vars(array(
        'L_' . $l_type . '_TITLE' => ( $mode == 'user' ) ? $lang['Auth_Control_User'] : $lang['Auth_Control_Group'],
        'L_' . $l_type . '_EXPLAIN' => ( $mode == 'user' ) ? $lang['User_auth_explain'] : $lang['Group_auth_explain'],
        'L_' . $l_type . '_SELECT' => ( $mode == 'user' ) ? $lang['Select_a_User'] : $lang['Select_a_Group'],
        'L_LOOK_UP' => ( $mode == 'user' ) ? $lang['Look_up_User'] : $lang['Look_up_Group'],
        'S_HIDDEN_FIELDS' => $s_hidden_fields,
        'S_' . $l_type . '_ACTION' => admin_sid('admin_ug_auth.php'))
    );
}
$template->pparse('body');
include(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>