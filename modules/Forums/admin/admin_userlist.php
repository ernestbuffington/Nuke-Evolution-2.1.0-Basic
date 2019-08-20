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
        $module['Users']['Userlist'] = $filename;
        return;
    }
}

global $_GETVAR;

//
// Set mode
//

$mode    = $_GETVAR->get('mode', 'request', 'string', '');
$confirm = $_GETVAR->get('confirm', 'request', 'string', FALSE) ? TRUE : FALSE;
$cancel  = $_GETVAR->get('cancel', 'request', 'string', FALSE) ? TRUE : FALSE;

//
// get starting position
//
$start = $_GETVAR->get('start', 'get', 'int', 0);
//
// get show amount
//
$show =  $_GETVAR->get('show', 'request', 'int', $board_config['posts_per_page']);
//
// sort method
//
$sort = $_GETVAR->get('sort', 'request', 'string', 'user_id');
//
// sort order
//
$sort_order =  $_GETVAR->get('order', 'request', 'string', 'ASC');
//
// alphanumeric stuff
//
$alphanum = ($_GETVAR->get('alphanum', 'request', 'string') ? $_GETVAR->get('alphanum', 'request', 'string') : '');
if ( !empty($alphanum) ) {
    $alpha_where = ( $alphanum == 'num' ) ? "AND username NOT RLIKE '^[A-Z]'" : "AND username LIKE '$alphanum%'";
} else {
    $alpha_where = '';
}
$user_ids = array();
$langemail = array();
$filter = '';
$filter_where = '';
$find_by = 'find_username';
if ( $_GETVAR->get('filter', 'request', 'string', NULL) ) {
    $filter = $_GETVAR->get('filter', 'request', 'string');
    if (!empty($filter)) {
        $filter = preg_replace('/\*/', '%', phpbb_clean_username($filter));
        $find_by = $_GETVAR->get('find_by', 'request', 'string', '');
        switch($find_by) {
        case 'find_user_email':
            $filter_where =" AND user_email LIKE '" . str_replace("\'", "''", $filter) . "'";
            break;
        case 'find_user_website':
            $filter_where =" AND user_website LIKE '" . str_replace("\'", "''", $filter) . "'";
            break;
        default:
            $filter_where =" AND username LIKE '" . str_replace("\'", "''", $filter) . "'";
            break;
        }
        $alpahnum = '';
        $alpha_where = '';
    }
}
//
// users id
// because it is an array we will intval() it when we use it
//
if ( $_GETVAR->get(POST_USERS_URL, 'request', 'array', NULL) ) {
    $user_ids = $_GETVAR->get(POST_USERS_URL, 'request', 'array');
} else {
    unset($user_ids);
}
switch( $mode ) {
    case 'delete':
        //
        // see if cancel has been hit and redirect if it has
        // shouldn't get to this point if it has been hit but
        // do this just in case
        //
        if ( $cancel == TRUE ) {
            redirect(admin_sid('admin_userlist.php'));
        }
        //
        // check confirm and either delete or show confirm message
        //
        if ( $confirm == FALSE ) {
            // show message
            $i = 0;
            $hidden_fields = '';
            $max_user_ids = (isset($user_ids) ? count($user_ids) : 0);
            while( $i < $max_user_ids ) {
                $user_id = intval($user_ids[$i]);
                $hidden_fields .= '<input type="hidden" name="' . POST_USERS_URL . '[]" value="' . $user_id . '" />';
                unset($user_id);
                $i++;
            }
            $template->set_filenames(array(
                'body' => 'admin/confirm_body.tpl')
            );
            $template->assign_vars(array(
                'MESSAGE_TITLE'     => $lang['Delete'],
                'MESSAGE_TEXT'      => $lang['Confirm_user_deleted'],
                'U_INDEX'           => '',
                'L_INDEX'           => '',
                'L_YES'             => $lang['Yes'],
                'L_NO'              => $lang['No'],
                'S_CONFIRM_ACTION'  => admin_sid('admin_userlist.php&amp;mode=delete'),
                'S_HIDDEN_FIELDS'   => $hidden_fields)
            );
        } else {
            // delete users
            $i = 0;
            $j = count($user_ids);
            while( $i < $j ) {
                $user_id = intval($user_ids[$i]);
                $sql = "SELECT u.username, g.group_id
                        FROM (" . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g)
                        WHERE ug.user_id = $user_id
                        AND g.group_id = ug.group_id
                        AND g.group_single_user = '1'
                        AND u.user_id = ug.user_id";
                if( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not obtain group information for this user', '', __LINE__, __FILE__, $sql);
                }
                $row = $db->sql_fetchrow($result);
                $sql = "UPDATE " . POSTS_TABLE . "
                    SET poster_id = " . ANONYMOUS . ", post_username = '" . $row['username'] . "'
                    WHERE poster_id = $user_id";
                if( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not update posts for this user', '', __LINE__, __FILE__, $sql);
                }
                $sql = "UPDATE " . TOPICS_TABLE . "
                    SET topic_poster = " . ANONYMOUS . "
                    WHERE topic_poster = $user_id";
                if( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not update topics for this user', '', __LINE__, __FILE__, $sql);
                }
                $sql = "UPDATE " . VOTE_USERS_TABLE . "
                    SET vote_user_id = " . ANONYMOUS . "
                    WHERE vote_user_id = $user_id";
                if( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not update votes for this user', '', __LINE__, __FILE__, $sql);
                }
                $sql = "SELECT group_id
                    FROM " . GROUPS_TABLE . "
                    WHERE group_moderator = $user_id";
                if( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not select groups where user was moderator', '', __LINE__, __FILE__, $sql);
                }
                while ( $row_group = $db->sql_fetchrow($result) ) {
                    $group_moderator[] = $row_group['group_id'];
                }
                if ( isset($group_moderator) && is_array($group_moderator) && count($group_moderator) ) {
                    $update_moderator_id = implode(', ', $group_moderator);
                    // Set Moderator of Group to Admin who is deleting
                    $sql = "UPDATE " . GROUPS_TABLE . "
                           SET group_moderator = " . $userdata['user_id'] . "
                           WHERE group_moderator IN ($update_moderator_id)";
                    if( !$db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not update group moderators', '', __LINE__, __FILE__, $sql);
                    }
                }
                $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                    WHERE group_id = '".$row['group_id']."'";
                if( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
                }
                $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
                    WHERE user_id = $user_id";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete user from topic watch table', '', __LINE__, __FILE__, $sql);
                }
                $sql = "DELETE FROM " . BANLIST_TABLE . "
                    WHERE ban_userid = $user_id";
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete user from banlist table', '', __LINE__, __FILE__, $sql);
                }
                $sql = "DELETE FROM " . SESSIONS_TABLE . "
                        WHERE uname = '".$row['username']."'";
                if ( !$db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, 'Could not delete sessions for this user', '', __LINE__, __FILE__, $sql);
                }
                $sql = "SELECT privmsgs_id
                    FROM " . PRIVMSGS_TABLE . "
                    WHERE privmsgs_from_userid = $user_id
                        OR privmsgs_to_userid = $user_id";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not select all users private messages', '', __LINE__, __FILE__, $sql);
                }
                // This little bit of code directly from the private messaging section.
                while ( $row_privmsgs = $db->sql_fetchrow($result) ) {
                    $mark_list[] = $row_privmsgs['privmsgs_id'];
                }
                if ( isset($mark_list) && is_array($mark_list) && count($mark_list) ) {
                    $delete_sql_id = implode(', ', $mark_list);
                    $delete_text_sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
                        WHERE privmsgs_text_id IN ($delete_sql_id)";
                    $delete_sql = "DELETE FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_id IN ($delete_sql_id)";
                    if ( !$db->sql_query($delete_sql) ) {
                        message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
                    }
                    if ( !$db->sql_query($delete_text_sql) ) {
                        message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $delete_text_sql);
                    }
                }
                $sql = "DELETE FROM " . USERS_TABLE . "
                    WHERE user_id = $user_id";
                if( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
                }
                $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                    WHERE user_id = $user_id";
                if( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Could not delete user from user_group table', '', __LINE__, __FILE__, $sql);
                }
                if ($row['group_id'] > 0) {
                    $db->sql_uquery ("DELETE FROM " . GROUPS_TABLE . " WHERE group_id = " . $row['group_id']);
                }
                unset($user_id);
                $i++;
            }
            $message = $lang['User_deleted_successfully'] . "<br /><br />" . sprintf($lang['Click_return_userlist'], "<a href=\"" . admin_sid("admin_userlist.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
        }
        break;
    case 'ban':
        //
        // see if cancel has been hit and redirect if it has
        // shouldn't get to this point if it has been hit but
        // do this just in case
        //
        if ( $cancel == TRUE ) {
            redirect(admin_sid('admin_userlist.php'));
        }
        //
        // check confirm and either ban or show confirm message
        //
        if ( $confirm == FALSE ) {
            $i = 0;
            $hidden_fields = '';
            while( $i < count($user_ids) ) {
                $user_id = intval($user_ids[$i]);
                $hidden_fields .= '<input type="hidden" name="' . POST_USERS_URL . '[]" value="' . $user_id . '" />';

                unset($user_id);
                $i++;
            }
            $template->set_filenames(array(
                'body' => 'admin/confirm_body.tpl')
            );
            $template->assign_vars(array(
                'MESSAGE_TITLE'     => $lang['Ban'],
                'MESSAGE_TEXT'      => $lang['Confirm_user_ban'],
                'U_INDEX'           => '',
                'L_INDEX'           => '',
                'L_YES'             => $lang['Yes'],
                'L_NO'              => $lang['No'],
                'S_CONFIRM_ACTION'  => admin_sid('admin_userlist.php&amp;mode=ban'),
                'S_HIDDEN_FIELDS'   => $hidden_fields)
            );
        } else {
            // ban users
            $i = 0;
            while( $i < count($user_ids) ) {
                $user_id = intval($user_ids[$i]);
                $sql = "INSERT INTO " . BANLIST_TABLE . " ( ban_userid )
                        VALUES ( '$user_id' )";
                if( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not obtain ban user', '', __LINE__, __FILE__, $sql);
                }
                unset($user_id);
                $i++;
            }
            $message = $lang['User_banned_successfully'] . "<br /><br />" . sprintf($lang['Click_return_userlist'], "<a href=\"" . admin_sid("admin_userlist.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
        }
        break;
    case 'activate':
        //
        // activate or deactive the seleted users
        //
        $i = 0;
        while( $i < count($user_ids) ) {
            $user_id = intval($user_ids[$i]);
            $sql = "SELECT user_active FROM " . USERS_TABLE . "
                WHERE user_id = $user_id";
            if( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain user information', '', __LINE__, __FILE__, $sql);
            }
            $row = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);
            $new_status = ( $row['user_active'] ) ? 0 : 1;
            $new_level = ($new_status) ? 1 : -1;
            $name = ($new_status) ? '' : $lang['Member_Deactivated'] ;
            $sql = "UPDATE " .  USERS_TABLE . "
                SET user_active = $new_status,
                user_level = $new_level,
                name = '$name'
                WHERE user_id = $user_id";
            if( !($result = $db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not update user status', '', __LINE__, __FILE__, $sql);
            }

            unset($user_id);
            $i++;
        }
        $message = $lang['User_status_updated'] . "<br /><br />" . sprintf($lang['Click_return_userlist'], "<a href=\"" . admin_sid("admin_userlist.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
        message_die(GENERAL_MESSAGE, $message);
        break;
    case 'group':
        //
        // add users to a group
        //
        if ( $confirm == FALSE ) {
            // show form to select which group to add users to
            $i = 0;
            $hidden_fields = '';
            while( $i < count($user_ids) ) {
                $user_id = intval($user_ids[$i]);
                $hidden_fields .= '<input type="hidden" name="' . POST_USERS_URL . '[]" value="' . $user_id . '" />';
                unset($user_id);
                $i++;
            }
            $template->set_filenames(array(
                'body' => 'admin/userlist_group.tpl')
            );
            $template->assign_vars(array(
                'MESSAGE_TITLE'     => $lang['Add_group'],
                'MESSAGE_TEXT'      => $lang['Add_group_explain'],
                'L_GROUP'           => $lang['Group'],
                'S_GROUP_VARIABLE'  => POST_GROUPS_URL,
                'S_ACTION'          => admin_sid('admin_userlist.php&amp;mode=group'),
                'L_GO'              => $lang['Go'],
                'L_CANCEL'          => $lang['Cancel'],
                'L_SELECT'          => $lang['Select_one'],
                'S_HIDDEN_FIELDS'   => $hidden_fields)
            );
            $sql = "SELECT group_id, group_name FROM " . GROUPS_TABLE . "
                WHERE group_single_user <> " . TRUE . "
                ORDER BY group_name";
            if( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not query groups', '', __LINE__, __FILE__, $sql);
            }
            // loop through groups
            while ( $row = $db->sql_fetchrow($result) )  {
                $template->assign_block_vars('grouprow',array(
                    'GROUP_NAME' => $row['group_name'],
                    'GROUP_ID' => $row['group_id'])
                );
            }
        } else {
            // add the users to the selected group
            $group_id = $_GETVAR->get(POST_GROUPS_URL, 'post', 'int', NULL);
            $i = 0;
            while( $i < count($user_ids) ) {
                $user_id = intval($user_ids[$i]);
                //
                // For security, get the ID of the group moderator.
                //
                switch(SQL_LAYER) {
                    default:
                        $sql = "SELECT g.group_moderator, g.group_type, aa.auth_mod
                            FROM ( " . GROUPS_TABLE . " g
                            LEFT JOIN " . AUTH_ACCESS_TABLE . " aa ON aa.group_id = g.group_id )
                            WHERE g.group_id = $group_id";
                        break;
                }
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, 'Could not get moderator information', '', __LINE__, __FILE__, $sql);
                }
                $group_info = $db->sql_fetchrow($result);
                $sql = "SELECT user_id, user_email, user_lang, user_level
                        FROM " . USERS_TABLE . "
                        WHERE user_id = $user_id";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Could not get user information", $lang['Error'], __LINE__, __FILE__, $sql);
                }
                $row = $db->sql_fetchrow($result);
                $sql = "SELECT ug.user_id, u.user_level
                        FROM (" . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u)
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
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET user_level = " . MOD . "
                                WHERE user_id = " . $row['user_id'];
                        if ( !$db->sql_query($sql) ) {
                            message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                        }
                    }
                    //
                    // Get the group name
                    // Email the user and tell them they're in the group
                    //
                    $group_sql = "SELECT group_name
                                FROM " . GROUPS_TABLE . "
                                WHERE group_id = $group_id";
                    if ( !($result = $db->sql_query($group_sql)) ) {
                        message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql);
                    }
                    $group_name_row = $db->sql_fetchrow($result);
                    $group_name     = $group_name_row['group_name'];
                    $thislang  = ((isset($row['user_lang']) && !empty($row['user_lang']))? $row['user_lang'] : strtolower($board_config['default_lang']));
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
                    $email_message .= '<a href="http://'.EVO_SERVER_URL.'/modules.php?name=Groups&amp;'.POST_GROUPS_URL.'='.$group_id.'">'.$langemail[$thislang]['GroupLink'].'</a><br /><br />';
                    $email_message .= $board_config['board_email_sig'];
                    $mailsend       = evo_mail($email_to, $subject, $email_message, '', '', TRUE);
                }
                unset($user_id);
                $i++;
            }
            $message = $lang['User_add_group_successfully'] . "<br /><br />" . sprintf($lang['Click_return_userlist'], "<a href=\"" . admin_sid("admin_userlist.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
        }
        break;
    default:
        //
        // get and display all of the users
        //
        $template->set_filenames(array(
          'body' => 'admin/userlist_body.tpl')
        );
        //
        // gets for alphanum
        //
        $alpha_range = array();
        $alpha_letters = array();
        $alpha_letters = range('A','Z');
        $alpha_start = array($lang['All'], '#');
        $alpha_range = array_merge($alpha_start, $alpha_letters);
        $i = 0;
        $temp = 'num';
        while( $i < count($alpha_range) ) {
            if ( $alpha_range[$i] != $lang['All'] ) {
                if ( $alpha_range[$i] != '#' && !empty($alpha_range[$i])) {
                    $temp = strtolower($alpha_range[$i]);
                } else {
                    $temp = 'num';
                }
                $alphanum_search_url = admin_sid('admin_userlist.php?sort=' . $sort . '&amp;order=' . $sort_order . '&amp;show=' . $show . '&amp;alphanum=' . $temp);
            } else {
                $alphanum_search_url = admin_sid('admin_userlist.php?sort=' . $sort . '&amp;order=' . $sort_order . '&amp;show=' . $show);
            }
            if ( ( $alphanum == $temp ) || ( $alpha_range[$i] == $lang['All'] && empty($alphanum) ) ) {
                $alpha_range[$i] = '<strong>' . $alpha_range[$i] . '</strong>';
            }
            $template->assign_block_vars('alphanumsearch', array(
                'SEARCH_SIZE' => floor(100/count($alpha_range)) . '%',
                'SEARCH_TERM' => $alpha_range[$i],
                'SEARCH_LINK' => $alphanum_search_url)
            );
            $i++;
        }
        $hidden_fields = '<input type="hidden" name="start" value="' . $start . '" />';
        $hidden_fields .= '<input type="hidden" name="alphanum" value="' . $alphanum . '" />';
        //
        // set up template varibles
        //
        $template->assign_vars(array(
            'L_TITLE'               => $lang['Userlist'],
            'L_DESCRIPTION'         => $lang['Userlist_description'],
            'L_OPEN_CLOSE'          => $lang['Open_close'],
            'L_ACTIVE'              => $lang['Active'],
            'L_USERNAME'            => $lang['Username'],
            'L_GROUP'               => $lang['Group'],
            'L_RANK'                => $lang['Rank'],
            'L_POSTS'               => $lang['Posts'],
            'L_FIND_ALL_POSTS'      => $lang['Find_all_posts'],
            'L_JOINED'              => $lang['Joined'],
            'L_ACTIVTY'             => $lang['Last_activity'],
            'L_MANAGE'              => $lang['User_manage'],
            'L_PERMISSIONS'         => $lang['Permissions'],
            'L_EMAIL'               => $lang['Email'],
            'L_PM'                  => $lang['Private_Message'],
            'L_WEBSITE'             => $lang['Website'],
            'S_USER_VARIABLE'       => POST_USERS_URL,
            'S_ACTION'              => admin_sid('admin_userlist.php'),
            'L_GO'                  => $lang['Go'],
            'L_SELECT'              => $lang['Select_one'],
            'L_DELETE'              => $lang['Delete'],
            'L_BAN'                 => $lang['Ban'],
            'L_ACTIVATE_DEACTIVATE' => $lang['Activate_deactivate'],
            'L_ADD_GROUP'           => $lang['Add_group'],
            'S_SHOW'                => $show,
            'L_FILTER'              => $lang['Filter'],
            'L_SORT_BY'             => $lang['Select_sort_method'],
            'L_SORT_USER_ID'        => $lang['Sort_User_id'],
            'L_SORT_ACTIVE'         => $lang['Sort_Active'],
            'L_SORT_USERNAME'       => $lang['Sort_Username'],
            'L_SORT_JOINED'         => $lang['Sort_Joined'],
            'L_SORT_ACTIVTY'        => $lang['Sort_Last_Activity'],
            'L_SORT_USER_LEVEL'     => $lang['Sort_User_Level'],
            'L_SORT_POSTS'          => $lang['Sort_Posts'],
            'L_SORT_RANK'           => $lang['Sort_Rank'],
            'L_SORT_EMAIL'          => $lang['Sort_Email'],
            'L_SORT_WEBSITE'        => $lang['Sort_Website'],
            'L_ASCENDING'           => $lang['Sort_Ascending'],
            'L_DESCENDING'          => $lang['Sort_Descending'],
            'L_SORT_BY'             => $lang['Sort_by'],
            'L_USER_ID'             => $lang['User_id'],
            'L_USER_LEVEL'          => $lang['User_level'],
            'L_SHOW'                => $lang['Show'],
            'S_SORT'                => $lang['Sort'],
            'S_HIDDEN_FIELDS'       => $hidden_fields,
            'SELECTED_ASCENDING'    => ($sort_order=="ASC") ? " selected='selected'" : "",
            'SELECTED_DESCENDING'   => ($sort_order=="DESC") ? " selected='selected'" : "",
            'S_FILTER'              => preg_replace('/%/', '*', $filter),
            'SELECTED_FIND_USERNAME' => ($find_by=="find_username") ? "selected='selected'" : "",
            'SELECTED_FIND_EMAIL'   => ($find_by=="find_user_email") ? "selected='selected'" : "",
            'SELECTED_FIND_WEBSITE' => ($find_by=="find_user_website") ? "selected='selected'" : "",
            'SELECTED_USER_ID'      => ($sort=="user_id") ? " selected='selected'" : "",
            'SELECTED_ACTIVE'       => ($sort=="user_active") ? " selected='selected'" : "",
            'SELECTED_USERNAME'     => ($sort=="username") ? " selected='selected'" : "",
            'SELECTED_JOINED'       => ($sort=="user_regdate") ? " selected='selected'" : "",
            'SELECTED_ACTIVTY'      => ($sort=="user_lastvisit") ? " selected='selected'" : "",
            'SELECTED_USER_LEVEL'   => ($sort=="user_level") ? " selected='selected'" : "",
            'SELECTED_POSTS'        => ($sort=="user_posts") ? " selected='selected'" : "",
            'SELECTED_RANK'         => ($sort=="user_rank") ? " selected='selected'" : "",
            'SELECTED_EMAIL'        => ($sort=="user_email") ? " selected='selected'" : "",
            'SELECTED_WEBSITE'      => ($sort=="user_website") ? " selected='selected'" : "",
            'S_HIDDEN_FIELDS'       => $hidden_fields)
        );
        if ($sort == 'user_regdate') {
            $sort_new = "CONCAT(substring(user_regdate, 9,4), '-', CASE substring(user_regdate, 1,3) 
WHEN 'Jan' THEN '01' 
WHEN 'Feb' THEN '02' 
WHEN 'Mar' THEN '03' 
WHEN 'Apr' THEN '04' 
WHEN 'May' THEN '05' 
WHEN 'Jun' THEN '06' 
WHEN 'Jul' THEN '07' 
WHEN 'Aug' THEN '08' 
WHEN 'Sep' THEN '09' 
WHEN 'Oct' THEN '10' 
WHEN 'Nov' THEN '11' 
WHEN 'Dec' THEN '12' 
END, '-', substring(user_regdate, 5,2))";
        } else {
            $sort_new = $sort;
        }
        $order_by = "ORDER BY $sort_new $sort_order ";
        $sql = "SELECT *
                FROM " . USERS_TABLE . "
                WHERE user_id <> " . ANONYMOUS . "
                $alpha_where
                $order_by
                LIMIT $start, $show";
        if( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
        }
        // loop through users
        $i = 1;
        while ( $row = $db->sql_fetchrow($result) ) {
            //
            // users avatar
            //
            $avatar_img = '';
            if ( $row['user_avatar_type'] && $row['user_allowavatar'] ) {
                switch( $row['user_avatar_type'] ) {
                    case USER_AVATAR_UPLOAD:
                        $avatar_img = ( $board_config['allow_avatar_upload'] ) ? avatar_resize($board_config['avatar_path'] . '/' . $row['user_avatar']) : '';
                        break;
                    case USER_AVATAR_REMOTE:
                        $avatar_img = avatar_resize($row['user_avatar']);
                        break;
                    case USER_AVATAR_GALLERY:
                        $avatar_img = ( $board_config['allow_avatar_local'] ) ? avatar_resize($board_config['avatar_gallery_path'] . '/' . $row['user_avatar']) : '';
                        break;
                }
            }
            //
            // users rank
            //
            $rank_sql = "SELECT *
                        FROM " . RANKS_TABLE . "
                        ORDER BY rank_special, rank_min";
            if ( !($rank_result = $db->sql_query($rank_sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
            }
            while ( $rank_row = $db->sql_fetchrow($rank_result) ) {
                $ranksrow[] = $rank_row;
            }
            $db->sql_freeresult($rank_result);
            $poster_rank = '';
            $rank_image = '';
            if ( $row['user_rank'] ) {
                for($ji = 0; $ji < count($ranksrow); $ji++) {
                    if ( $row['user_rank'] == $ranksrow[$ji]['rank_id'] && $ranksrow[$ji]['rank_special'] ) {
                        $poster_rank = $ranksrow[$ji]['rank_title'];
                        $rank_image = ( $ranksrow[$ji]['rank_image'] ) ? '<img src="/' . $ranksrow[$ji]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
                    }
                }
            } else {
                for($ji = 0; $ji < count($ranksrow); $ji++) {
                    if ( $row['user_posts'] >= $ranksrow[$ji]['rank_min'] && !$ranksrow[$ji]['rank_special'] ) {
                        $poster_rank = $ranksrow[$ji]['rank_title'];
                        $rank_image = ( $ranksrow[$ji]['rank_image'] ) ? '<img src="/' . $ranksrow[$ji]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
                    }
                }
            }
            //
            // setup user row template varibles
            //
            $template->assign_block_vars('user_row', array(
                'ROW_NUMBER'    => $i + ( $_GETVAR->get('start', 'get', 'int', 0) + 1 ),
                'ROW_CLASS'     => ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'],
                'USER_ID'       => $row['user_id'],
                'ACTIVE'        => ( $row['user_active'] == TRUE ) ? $lang['Yes'] : $lang['No'],
                'USERNAME'      => UsernameColor($row['username']),
                'U_PROFILE'     => append_sid('profile.php&amp;mode=viewprofile&amp;u=' . $row['user_id'], 1),
                'RANK'          => $poster_rank,
                'I_RANK'        => $rank_image,
                'I_AVATAR'      => $avatar_img,
                'JOINED'        => formatTimestamp(strtotime(substr($row['user_regdate'], 4,2).' '.substr($row['user_regdate'], 0,3).' '.substr($row['user_regdate'], 8,4)), '', '1'),
                'LAST_ACTIVITY' => ( !empty($row['user_lastvisit']) ) ? create_date('d M Y', $row['user_lastvisit'], $board_config['board_timezone']) : $lang['Never'],
                'POSTS'         => ( $row['user_posts'] ) ? $row['user_posts'] : 0,
                'U_SEARCH'      => append_sid('forums.php&amp;file=search&amp;search_author=' . urlencode(strip_tags($row['username'])), 1),
                'U_WEBSITE'     => ( $row['user_website'] ) ? $row['user_website'] : '',
                'EMAIL'         => $row['user_email'],
                'U_PM'          => append_sid('privmsg.php&amp;file=index&amp;mode=post&amp;u=' . $row['user_id'], 1),
                'U_MANAGE'      => admin_sid('admin_users.php&amp;mode=edit&amp;' . POST_USERS_URL . '=' . $row['user_id']),
                'U_PERMISSIONS' => admin_sid('admin_ug_auth.php&amp;mode=user&amp;' . POST_USERS_URL . '=' . $row['user_id']))
            );
            //
            // get the users group information
            //
            $group_sql = "SELECT *
                          FROM (" . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g)
                          WHERE ug.user_id = " . $row['user_id'] . "
                          AND g.group_single_user <> 1
                          AND g.group_id = ug.group_id";
            if( !($group_result = $db->sql_query($group_sql)) ) {
                message_die(GENERAL_ERROR, 'Could not query groups', '', __LINE__, __FILE__, $group_sql);
            }
            $g = 0;
            while ( $group_row = $db->sql_fetchrow($group_result) ) {
                //
                // assign the group varibles
                //
                if ( $group_row['group_moderator'] == $row['user_id'] ) {
                    $group_status = $lang['Moderator'];
                } else if ( $group_row['user_pending'] == TRUE ) {
                    $group_status = $lang['Pending'];
                } else {
                    $group_status = $lang['Member'];
                }
                $template->assign_block_vars('user_row.group_row', array(
                    'GROUP_NAME'    => GroupColor($group_row['group_name']),
                    'GROUP_STATUS'  => $group_status,
                    'U_GROUP'       => append_sid('groupcp.php&amp;g=' . $group_row['group_id'])
                    )
                );
                $g++;
            }
            if ( $g == 0 ) {
                $template->assign_block_vars('user_row.no_group_row', array(
                    'L_NONE' => $lang['None'])
                );
            }
            $i++;
        }
        $db->sql_freeresult($result);
        $count_sql = "SELECT count(user_id) AS total
                        FROM " . USERS_TABLE . "
                        WHERE user_id <> " . ANONYMOUS . " $alpha_where";
        if ( !($count_result = $db->sql_query($count_sql)) ) {
            message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
        }
        if ( $total = $db->sql_fetchrow($count_result) ) {
            $total_members = $total['total'];
            $pagination = generate_pagination(admin_sid("admin_userlist.php?sort=$sort&amp;order=$sort_order&amp;show=$show" . ( ( isset($alphanum) ) ? "&amp;alphanum=$alphanum" : '' )), $total_members, $show, $start);
        }
        $template->assign_vars(array(
            'PAGINATION' => $pagination,
            'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $show ) + 1 ), ceil( $total_members / $show )))
        );
        break;
} // switch()
$template->pparse('body');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>