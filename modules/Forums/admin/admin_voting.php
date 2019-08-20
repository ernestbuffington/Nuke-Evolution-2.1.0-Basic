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
        $module['Poll_Admin']['Poll_Results'] = $filename;
        return;
    }
}

global $_GETVAR, $board_config;

$lang_file = '/lang_admin_voting.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

// Initialize variables
//
// Determine current starting row
$start = $_GETVAR->get('start', 'get', 'int', 0);
// Determine current sort field
$sort_field = $_GETVAR->get('field', 'request', 'string', 'vote_id');
// Determine current sort order
$sort_order = $_GETVAR->get('order', 'request', 'string', 'ASC');
// Assign sort fields
$sort_fields_text = array(
    $lang['Sort_vote_id'],
    $lang['Sort_poll_topic'],
    $lang['Sort_vote_start']
);
$sort_fields = array(
    'vote_id',
    'poll_topic',
    'vote_start'
);
// Set select fields
$select_sort_field = '<select name="field">';

for($i = 0; $i < count($sort_fields_text); $i++) {
    $selected = ($sort_field == $sort_fields[$i]) ? ' selected="selected"' : '';
    $select_sort_field .= '<option value="' . $sort_fields[$i] . '"' . $selected . '>' . $sort_fields_text[$i] . '</option>';
}
$select_sort_field .= '</select>';
$select_sort_order = '<select name="order">';
if($sort_order == 'ASC') {
    $select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_ascending'] . '</option><option value="DESC">' . $lang['Sort_descending'] . '</option>';
} else {
    $select_sort_order .= '<option value="ASC">' . $lang['Sort_ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_descending'] . '</option>';
}
$select_sort_order .= '</select>';

// Select query sort criteria
$order_by = '';
switch($sort_field) {
    case 'vote_id':
        $order_by = 'vote_id ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
        break;
    case 'poll_topic':
        $order_by = 'vote_text ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
        break;
    case 'vote_start':
        $order_by = 'vote_start ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
        break;
    default:
        $order_by = 'vote_id ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
        break;
}

// Build arrays
//
// Assign page template
$template->set_filenames(array('pollbody' => 'admin/admin_voting_body.tpl'));

// Assign labels
$template->assign_vars(array(
    'L_ADMIN_VOTE_EXPLAIN'  => $lang['Admin_Vote_Explain'],
    'L_ADMIN_VOTE_TITLE'    => $lang['Admin_Vote_Title'],
    'L_VOTE_ID'             => $lang['Vote_id'],
    'L_POLL_TOPIC'          => $lang['Poll_topic'],
    'L_VOTE_USERNAME'       => $lang['Vote_username'],
    'L_VOTE_END_DATE'       => $lang['Vote_end_date'],
    'L_SUBMIT'              => $lang['Submit'],
    'L_SELECT_SORT_FIELD'   => $lang['Select_sort_field'],
    'L_SORT_ORDER'          => $lang['Sort_order'],
    'S_FIELD_SELECT'        => $select_sort_field,
    'S_ORDER_SELECT'        => $select_sort_order,
    'ADMIN_VOTING_ICON'     => '<img src="' . NUKE_THEMES_DIR . $ThemeSel . '/images/admin_voting_icon.gif" alt="" />',
));

// Assign Username array
$sql = "SELECT DISTINCT u.user_id, u.username
        FROM (" . USERS_TABLE . " AS u , " . VOTE_USERS_TABLE . " AS vv)
        WHERE u.user_id = vv.vote_user_id";
if( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not query users.', '', __LINE__, __FILE__, $sql);
}
$user_arr = array();
while ( $row = $db->sql_fetchrow($result) ) {
    $user_id = $row['user_id'];
    $username = UsernameColor($row['username']);
    $user_arr[$user_id] = $username;
}

// Assign poll options array
$sql = "SELECT *
       FROM ". VOTE_RESULTS_TABLE ."
       ORDER BY vote_id";
if( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not query poll options.', '', __LINE__, __FILE__, $sql);
}
$option_arr = array();
while ( $row = $db->sql_fetchrow($result) ) {
    $vote_id = $row['vote_id'];
    $vote_option_id = $row['vote_option_id'];
    $vote_option_text = $row['vote_option_text'];
    $vote_result = $row['vote_result'];
    $option_arr[$vote_id][$vote_option_id]['text'] = $vote_option_text;
    $option_arr[$vote_id][$vote_option_id]['result'] = $vote_result;
}

// Assign individual vote results
$sql = "SELECT vote_id, vote_user_id, vote_cast
        FROM ". VOTE_USERS_TABLE ."
        ORDER BY vote_id";
if( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not query vote results.', '', __LINE__, __FILE__, $sql);
}
$voter_arr = array();
while ( $row = $db->sql_fetchrow($result) ) {
    $vote_id = $row['vote_id'];
    $vote_user_id = $row['vote_user_id'];
    $vote_cast = $row['vote_cast'];
    $voter_arr[$vote_id][$vote_user_id] = $vote_cast;
}
$db->sql_freeresult($result);
$sql = "SELECT *
       FROM ". VOTE_DESC_TABLE ."
       ORDER BY " . $order_by;
if( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Could not query poll description.', '', __LINE__, __FILE__, $sql);
}
$num_polls = $db->sql_numrows($result);
$i = 0;
while ( $row = $db->sql_fetchrow($result) ) {
    $topic_row_color = (($i % 2) == 0) ? 'row1' : 'row2';
    $vote_id = $row['vote_id'];
    $vote_text = $row['vote_text'];
    $topic_id = $row['topic_id'];
    $vote_start = $row['vote_start'];
    $vote_length = $row['vote_length'];
    $vote_end = $vote_start + $vote_length;
    if (time() < $vote_end) {
        $vote_duration = (date ('m/d/y',$vote_start)) . ' - ' . (date ('m/d/y',$vote_end)) . '<br />' . $lang['Vote_ongoing'];
    } else if ($vote_length == 0) {
        $vote_duration = (date ('m/d/y',$vote_start)) . ' - ' . '<br />' . $lang['Vote_infinite'];
    } else {
        $vote_duration = (date ('m/d/y',$vote_start)) . ' - ' . (date ('m/d/y',$vote_end)) . '<br />' . $lang['Vote_infinite'] ;
    }
    $user = '';
    $users = '';
    $user_option_arr = '';
    if (isset($voter_arr[$vote_id]) && (count($voter_arr[$vote_id]) > 0 )) {
        foreach($voter_arr[$vote_id] as $user_id => $option_id) {
            $user .= $user_arr[$user_id].', ';
            $user_option_arr[$option_id] .= $user_arr[$user_id].', ';
        }
        $user = substr($user, '0', strrpos($user, ', '));
    }
    $template->assign_block_vars("votes", array(
       'COLOR'          => $topic_row_color,
       'LINK'           => append_sid('modules.php?name=Forums&amp;file=viewtopic&amp;t='.$topic_id),
       'DESCRIPTION'    => $vote_text,
       'USER'           => $user,
       'ENDDATE'        => $vote_end,
       'VOTE_DURATION'  => $vote_duration,
       'VOTE_ID'        => $vote_id
    ));
    if (isset($voter_arr[$vote_id]) && (count($voter_arr[$vote_id]) > 0 )) {
        foreach($option_arr[$vote_id] as $vote_option_id => $elem) {
            $option_text   = $elem['text'];
            $option_result = $elem['result'];
            $user          = $user_option_arr[$vote_option_id];
            $user          = substr($user, '0', strrpos($user, ', '));
            $template->assign_block_vars('votes.detail', array(
                'OPTION' => $option_text,
                'RESULT' => $option_result,
                'USER'   => $user)
            );
        }
    }
    $i++;
}
$db->sql_freeresult($result);

// Pagination routine
//
$sql = "SELECT count(*) AS total
       FROM " . VOTE_DESC_TABLE . "
       WHERE vote_id > 0";
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
}
if ( $total = $db->sql_fetchrow($result) ) {
    $total_polls = $total['total'];
    $pagination = generate_pagination(admin_sid('admin_voting.php&amp;mode=' . $sort_field . '&amp;order=' . $sort_order), $total_polls, $board_config['topics_per_page'], $start). '&nbsp;';
}
$template->assign_vars(array(
    'PAGINATION'  => $pagination,
    'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_polls / $board_config['topics_per_page'] )),
    'L_GOTO_PAGE' => $lang['Goto_page'])
    );
//
$template->pparse('pollbody');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>