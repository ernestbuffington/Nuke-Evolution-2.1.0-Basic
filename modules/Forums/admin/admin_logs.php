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
        $module['Logs']['Logs Actions'] = $filename;
        return;
    }
}

global $_GETVAR;
$template->set_filenames(array(
    "body" => "admin/logs_body.tpl")
);

$start      = $_GETVAR->get('start', 'get', 'int', 0);
$sort_order = $_GETVAR->get('order', 'request', 'string', 'ASC');

$sql = "SELECT config_value AS all_admin
        FROM " . LOGS_CONFIG_TABLE . "
        WHERE config_name = 'all_admin' ";
if(!$result = $db->sql_query($sql)) {
    message_die(CRITICAL_ERROR, "Could not query log config informations", "", __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
$db->sql_freeresult($sql);
$all_admin_authorized = $row['all_admin'];
if ( $all_admin_authorized == '0' && $userdata['user_id'] <> '2' && !is_mod_admin($module_name) && $userdata['user_view_log'] <> '1' ) {
    message_die(GENERAL_MESSAGE, $lang['Admin_not_authorized']);
}

//
// Logs sorting
//

$mode_types_text  = array($lang['Time'], $lang['Member'], $lang['Action'], $lang['Id_log']);
$mode_types       = array('time', 'username', 'mode', 'id');
$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++) {
    $selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
    $select_sort_mode .= "<option value=\"" . $mode_types[$i] . "\"$selected>" . $mode_types_text[$i] . "</option>";
}
$select_sort_mode .= '</select>';
$select_sort_order = '<select name="order">';
if($sort_order == 'ASC') {
    $select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
} else {
    $select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';
$template->assign_vars(array(
    'L_LOG_ACTIONS_TITLE'   => $lang['Log_action_title'],
    'L_LOG_ACTION_EXPLAIN'  => $lang['Log_action_explain'],
    'L_CHOOSE_SORT'         => $lang['Choose_sort_method'],
    'L_ORDER'               => $lang['Order'],
    'L_GO'                  => $lang['Go'],
    'L_CANCEL'              => $lang['Cancel'],
    'L_DELETE'              => $lang['Delete'],
    'L_DELETE_LOG'          => $lang['Choose_log'],
    'L_ID_LOG'              => $lang['Id_log'],
    'L_ACTION'              => $lang['Action'],
    'L_TOPIC'               => $lang['Topic'],
    'L_DONE_BY'             => $lang['Done_by'],
    'L_USER_IP'             => $lang['User_ip'],
    'L_DATE'                => $lang['Date'],
    'L_MARK_ALL'            => $lang['Select_all'],
    'L_UNMARK_ALL'          => $lang['Unselect_all'],
    'S_MODE_SELECT'         => $select_sort_mode,
    'S_ORDER_SELECT'        => $select_sort_order,
    'S_MODE_ACTION'         => admin_sid('admin_logs.php'),
    'S_CANCEL_ACTION'       => admin_sid('admin_logs.php'))
);
if ( $_GETVAR->get('mode', 'request', 'string') ) {
    $mode = $_GETVAR->get('mode', 'request', 'string');
    switch( $mode ) {
        case 'mode' :
            $order_by = "mode $sort_order LIMIT $start, " . $board_config['topics_per_page'];
            break;
        case 'username' :
            $order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
            break;
        case 'time' :
            $order_by = "time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
            break;
        case 'id' :
            $order_by = "log_id $sort_order LIMIT $start, " . $board_config['topics_per_page'];
            break;
        default:
            $order_by = "time DESC LIMIT $start, " . $board_config['topics_per_page'];
            break;
    }
} else {
    $order_by = "time DESC LIMIT $start, " . $board_config['topics_per_page'];
}
$sql = "SELECT *
    FROM " . LOGS_TABLE . "
    ORDER BY $order_by ";
if(!$result = $db->sql_query($sql)) {
   message_die(CRITICAL_ERROR, "Could not query log informations", "", __LINE__, __FILE__, $sql);
}
$rows = $db->sql_fetchrowset($result);
$numrows = $db->sql_numrows($result);
for ($i = 0; $i < $numrows; $i++) {
    $id_log = $rows[$i]['log_id'];
    $action = ucfirst($rows[$i]['mode']);
    $topic = $rows[$i]['topic_id'];
    $user_id = $rows[$i]['user_id'];
    $username = $rows[$i]['username'];
    $user_ip = decode_ip($rows[$i]['user_ip']);
    $date = $rows[$i]['time'];
    $temp_url = ($user_id != ANONYMOUS ? '<a href="' . admin_sid('admin_users.php&amp;mode=edit&amp;u=' . $user_id). '" target=_new>' : '');
    if ($topic > 0) { 
        $sql = "SELECT topic_title
                FROM " . TOPICS_TABLE . "
                WHERE topic_id = '$topic'";
        if(!$result = $db->sql_query($sql)) {
            message_die(CRITICAL_ERROR, "Could not query topic_title informations", "", __LINE__, __FILE__, $sql);
        }
        $topic_title = $db->sql_fetchrow($result);
        $temp2_url = append_sid('modules.php?name=Forums&amp;file=viewtopic&amp;t=' . $topic);
        if ($topic_title['topic_title']) { 
            $topic_title = (strlen($topic_title['topic_title']) >= 15) ? substr($topic_title['topic_title'], 0, 15)."..." : $topic_title['topic_title'];
            $topic_title = '<a href="' . $temp2_url . '" target="_blank">' . $topic_title . '</a>';
        } else {
            $topic_title = '<small>'.$lang['LOG_Deleted'].' (ID: ' . $topic . ')</small>';
        }
    } else {
        $topic_title = '<small>'.$lang['LOG_Empty_Entry'].'</small>';
    }
    $sql = "SELECT user_level
        FROM " . USERS_TABLE . "
        WHERE user_id = $user_id";
    if(!$result = $db->sql_query($sql)) {
        message_die(CRITICAL_ERROR, "Could not query user_level informations", "", __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $level = $row['user_level'];
    $template->assign_block_vars('record_row', array(
        'ID_LOG'    => $id_log,
        'ACTION'    => $action,
        'TOPIC'     => $topic_title,
        'USER_ID'   => $user_id,
        'USERNAME'  => $temp_url . UsernameColor($username) . '</a>',
        'USER_IP'   => $user_ip,
        'U_WHOIS_IP'=> 'http://network-tools.com/default.asp?prog=express&Netnic=whois.arin.net&host=' . $user_ip,
        'DATE'      => create_date($board_config['default_dateformat'], $date, $board_config['board_timezone']))
     );
}
$db->sql_freeresult($result);
$log_list = $_GETVAR->get('log_list', 'post', 'array' ) ? $_GETVAR->get('log_list', 'post', 'array' ): array();
$delete = $_GETVAR->get('delete', 'post', 'string') ?  TRUE : FALSE ;
$log_list_sql = implode(', ', $log_list);
if ( $log_list_sql != '' ) {
    if ( $delete ) {
        $sql = "DELETE
                FROM " . LOGS_TABLE . "
                WHERE log_id IN (" . $log_list_sql . ")";
        if( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not delete Logs', '', __LINE__, __FILE__, $sql);
        } else {
            $redirect_page = admin_sid('admin_logs.php');
            $l_redirect = sprintf($lang['Click_return_admin_log'], '<a href="' . $redirect_page . '">', '</a>');
            message_die(GENERAL_MESSAGE, $lang['Log_delete'] . '<br /><br />' . $l_redirect);
        }
    }
}
if ( $board_config['topics_per_page'] > 10 ) {
    $sql = "SELECT count(*) AS total
            FROM " . LOGS_TABLE;
    if ( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Error getting total informations for logs', '', __LINE__, __FILE__, $sql);
    }
    if ( $total = $db->sql_fetchrow($result) ) {
        $total_records = $total['total'];
        $pagination = generate_pagination("admin_logs.php&amp;mode=$mode&amp;order=$sort_order", $total_records, $board_config['topics_per_page'], $start). '&nbsp;';
    }
} else {
    $pagination = '&nbsp;';
    $total_records = 10;
}
$template->assign_vars(array(
    'PAGINATION'  => $pagination,
    'PAGE_NUMBER' => ( $total_records == '0' ) ? '&nbsp;' : sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_records / $board_config['topics_per_page'] )),
    'L_GOTO_PAGE' => $lang['Goto_page'],
    'GROUPS'      => GetColorGroups(1))
);
$template->pparse("body");
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>