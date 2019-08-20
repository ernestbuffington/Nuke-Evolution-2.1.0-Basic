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
    if( !empty($setmodules) )   {
        $filename = basename(__FILE__);
        $module['Users']['Ranks'] = $filename;
        return;
    }
}

global $_GETVAR;

$cancel = $_GETVAR->get('cancel', 'post', 'string') ? TRUE : FALSE;
if ($cancel) {
    $mode = '';
} else {
    $mode = $_GETVAR->get('mode', 'request', 'string', NULL);
}

// Restrict mode input to valid options
$mode = ( in_array($mode, array('add', 'edit', 'save', 'delete')) ) ? $mode : '';
if( $mode != '' ) {
    if( $mode == 'edit' || $mode == 'add' ) {
        // They want to add a new rank, show the form.
        //
        $rank_id = $_GETVAR->get('id', 'get', 'int', 0);
        $s_hidden_fields = '';
        if( $mode == 'edit' ) {
            if( $rank_id == 0 ) {
                message_die(GENERAL_MESSAGE, $lang['Must_select_rank']);
            }
            $sql = "SELECT * FROM " . RANKS_TABLE . "
                    WHERE rank_id = $rank_id";
            if(!$result = $db->sql_query($sql)) {
                message_die(GENERAL_ERROR, 'Couldn\'t obtain rank data', '', __LINE__, __FILE__, $sql);
            }
            $rank_info = $db->sql_fetchrow($result);
            $s_hidden_fields .= '<input type="hidden" name="id" value="' . $rank_id . '" />';
        } else {
            $rank_info['rank_special'] = 0;
        }
        $s_hidden_fields .= '<input type="hidden" name="mode" value="save" />';
        $rank_is_special = ( $rank_info['rank_special'] ) ? 'checked="checked"' : '';
        $rank_is_not_special = ( !$rank_info['rank_special'] ) ? 'checked="checked"' : '';
        $template->set_filenames(array(
                'body' => 'admin/ranks_edit_body.tpl')
        );
        $template->assign_vars(array(
            'RANK'              => $rank_info['rank_title'],
            'SPECIAL_RANK'      => $rank_is_special,
            'NOT_SPECIAL_RANK'  => $rank_is_not_special,
            'MINIMUM'           => ( $rank_is_special ) ? '' : $rank_info['rank_min'],
            'IMAGE'             => ( $rank_info['rank_image'] != '' ) ? $rank_info['rank_image'] : '',
            'IMAGE_DISPLAY'     => ( $rank_info['rank_image'] != '' ) ? '<img src="' . NUKE_HREF_BASE_DIR . $rank_info['rank_image'] . '" />' : '',
            'L_RANKS_TITLE'     => $lang['Ranks_title'],
            'L_RANKS_TEXT'      => $lang['Ranks_explain'],
            'L_RANK_TITLE'      => $lang['Rank_title'],
            'L_RANK_SPECIAL'    => $lang['Rank_special'],
            'L_RANK_MINIMUM'    => $lang['Rank_minimum'],
            'L_RANK_IMAGE'      => $lang['Rank_image'],
            'L_RANK_IMAGE_EXPLAIN' => $lang['Rank_image_explain'],
            'L_SUBMIT'          => $lang['Submit'],
            'L_RESET'           => $lang['Reset'],
            'L_YES'             => $lang['Yes'],
            'L_NO'              => $lang['No'],
            'S_RANK_ACTION'     => admin_sid('admin_ranks.php'),
            'S_HIDDEN_FIELDS'   => $s_hidden_fields)
        );
    } else if( $mode == 'save' ) {
        //
        // Ok, they sent us our info, let's update it.
        //
        $rank_id        = $_GETVAR->get('id', 'post', 'int', 0);
        $rank_title     = trim($_GETVAR->get('title', 'post', 'string', ''));
        $special_rank   = ( $_GETVAR->get('special_rank', 'post', 'int', NULL) == 1 ) ? TRUE : 0;
        $min_posts      = $_GETVAR->get('min_posts', 'post', 'int', -1);
        $rank_image     = trim($_GETVAR->get('rank_image', 'post', 'string', ''));
        if( $rank_title == '' ) {
            message_die(GENERAL_MESSAGE, $lang['Must_select_rank']);
        }
        if( $special_rank == 1 ) {
            $max_posts = -1;
            $min_posts = -1;
        }
        //
        // The rank image has to be a jpg, gif or png
        //
        if($rank_image != '') {
            if ( !preg_match("/(\.gif|\.png|\.jpg)$/is", $rank_image)) {
                $rank_image = '';
            }
        }
        if ($rank_id) {
            if (!$special_rank) {
                $sql = "UPDATE " . USERS_TABLE . "
                        SET user_rank = 0
                        WHERE user_rank = $rank_id";
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, $lang['No_update_ranks'], '', __LINE__, __FILE__, $sql);
                }
            }
            $sql = "UPDATE " . RANKS_TABLE . "
                    SET rank_title = '" . str_replace("\'", "''", $rank_title) . "', rank_special = $special_rank, rank_min = $min_posts, rank_image = '" . str_replace("\'", "''", $rank_image) . "'
                    WHERE rank_id = $rank_id";
           $message = $lang['Rank_updated'];
        } else {
           $sql = "INSERT INTO " . RANKS_TABLE . " (rank_title, rank_special, rank_min, rank_image)
                   VALUES ('" . str_replace("\'", "''", $rank_title) . "', $special_rank, $min_posts, '" . str_replace("\'", "''", $rank_image) . "')";
           $message = $lang['Rank_added'];
        }
        if( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t update/insert into ranks table', '', __LINE__, __FILE__, $sql);
        }
        $message .= "<br /><br />" . sprintf($lang['Click_return_rankadmin'], "<a href=\"" . admin_sid("admin_ranks.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php?pane=right") . "\">", "</a>");
        message_die(GENERAL_MESSAGE, $message);
    } else if( $mode == 'delete' ) {
        //
        // Ok, they want to delete their rank
        //
        $rank_id = $_GETVAR->get('id', 'request', 'int', 0);
        $confirm = $_GETVAR->get('confirm', 'post', 'string', NULL);
        if( ($rank_id > 0) && $confirm ) {
            $sql = "DELETE FROM " . RANKS_TABLE . "
                    WHERE rank_id = $rank_id";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t delete rank data', '', __LINE__, __FILE__, $sql);
            }
            $sql = "UPDATE " . USERS_TABLE . "
                    SET user_rank = 0
                    WHERE user_rank = $rank_id";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, $lang['No_update_ranks'], '', __LINE__, __FILE__, $sql);
            }
            $message = $lang['Rank_removed'] . "<br /><br />" . sprintf($lang['Click_return_rankadmin'], "<a href=\"" . admin_sid("admin_ranks.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php?pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
        } elseif( ($rank_id > 0) && !$confirm) {
            // Present the confirmation screen to the user
            $template->set_filenames(array(
                'body' => 'admin/confirm_body.tpl')
            );
            $hidden_fields = '<input type="hidden" name="mode" value="delete" /><input type="hidden" name="id" value="' . $rank_id . '" />';
            $template->assign_vars(array(
              'MESSAGE_TITLE'   => $lang['Confirm'],
              'MESSAGE_TEXT'    => $lang['Confirm_delete_rank'],
              'L_YES'           => $lang['Yes'],
              'L_NO'            => $lang['No'],
              'S_CONFIRM_ACTION'=> admin_sid('admin_ranks.php'),
              'S_HIDDEN_FIELDS' => $hidden_fields)
            );
        } else {
            message_die(GENERAL_MESSAGE, $lang['Must_select_rank']);
        }
    }
    $template->pparse('body');
    include(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
}

//
// Show the default page
//
$template->set_filenames(array(
    'body' => 'admin/ranks_list_body.tpl')
);

$sql = "SELECT * FROM " . RANKS_TABLE . "
        ORDER BY rank_min ASC, rank_special ASC";
if( !$result = $db->sql_query($sql) ) {
    message_die(GENERAL_ERROR, 'Couldn\'t obtain ranks data', '', __LINE__, __FILE__, $sql);
}
$rank_count = $db->sql_numrows($result);
$rank_rows = $db->sql_fetchrowset($result);
$template->assign_vars(array(
    'L_RANKS_TITLE'  => $lang['Ranks_title'],
    'L_RANKS_TEXT'   => $lang['Ranks_explain'],
    'L_RANK'         => $lang['Rank_title'],
    'L_RANK_MINIMUM' => $lang['Rank_minimum'],
    'L_SPECIAL_RANK' => $lang['Rank_special'],
    'L_EDIT'         => $lang['Edit'],
    'L_DELETE'       => $lang['Delete'],
    'L_ADD_RANK'     => $lang['Add_new_rank'],
    'L_ACTION'       => $lang['Action'],
    'S_RANKS_ACTION' => admin_sid('admin_ranks.php&amp;mode=add'))
);
for($i = 0; $i < $rank_count; $i++) {
    $rank = $rank_rows[$i]['rank_title'];
    $special_rank = $rank_rows[$i]['rank_special'];
    $rank_id = $rank_rows[$i]['rank_id'];
    $rank_min = $rank_rows[$i]['rank_min'];
    if( $special_rank == 1 ) {
        $rank_min = $rank_max = '-';
    }
    $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
    $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
    $rank_is_special = ( $special_rank ) ? $lang['Yes'] : $lang['No'];
    $template->assign_block_vars('ranks', array(
        'ROW_COLOR'     => '#' . $row_color,
        'ROW_CLASS'     => $row_class,
        'RANK'          => (( $rank_rows[$i]['rank_image'] != '' ) ? '<img src="' . NUKE_HREF_BASE_DIR . $rank_rows[$i]['rank_image'] . '" />' : '') . '<br />'.$rank,
        'SPECIAL_RANK'  => $rank_is_special,
        'RANK_MIN'      => $rank_min,
        'U_RANK_EDIT'   => admin_sid('admin_ranks.php&amp;mode=edit&amp;id=' . $rank_id),
        'U_RANK_DELETE' => admin_sid('admin_ranks.php&amp;mode=delete&amp;id=' . $rank_id))
    );
}

$template->pparse('body');
include(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>