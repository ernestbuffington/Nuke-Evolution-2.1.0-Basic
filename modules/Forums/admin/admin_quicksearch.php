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
        $module['General']['Quick Search List'] = $filename;
        return;
    }
}

global $_GETVAR;

$mode = $_GETVAR->get('mode', 'request', 'string', NULL);
if ( empty($mode) ) {
    $mode = $_GETVAR->get('add', 'post', 'string', NULL) ? 'add' : ( $_GETVAR->get('save', 'post', 'string', NULL) ? 'save' : '' );
}
if( $mode ) {
    if( $mode == 'edit' || $mode == 'add' ) {
        //
        // They want to add a new page, show the form.
        //
        $search_id = $_GETVAR->get('id', '_REQUEST', 'int', 0);
        $s_hidden_fields = '';
        if( $mode == 'edit' ) {
            if( empty($search_id) ) {
                message_die(GENERAL_MESSAGE, $lang['Must_select_search']);
            }
            $sql = "SELECT * FROM " . QUICKSEARCH_TABLE . "
                    WHERE search_id = $search_id";
            if(!$result = $db->sql_query($sql)) {
                message_die(GENERAL_ERROR, "Couldn't obtain quick search data", "", __LINE__, __FILE__, $sql);
            }
            $search_info = array();
            $search_info = $db->sql_fetchrow($result);
            $s_hidden_fields .= '<input type="hidden" name="id" value="' . $search_id . '" />';
        }
        $s_hidden_fields .= '<input type="hidden" name="mode" value="save" />';
        $template->set_filenames(array(
            'body' => 'admin/quicksearch_edit.tpl')
        );

        $template->assign_vars(array(
            'SEARCH_NAME'           => ($mode=='add' ? '' : $search_info['search_name']),
            'SEARCH_URL1'           => ($mode=='add' ? '' : $search_info['search_url1']),
            'SEARCH_URL2'           => ($mode=='add' ? '' : $search_info['search_url2']),
            'L_SEARCHS_TITLE'       => $lang['Search_title'],
            'L_SEARCHS_TEXT'        => $lang['Search_explain'],
            'L_SEARCH_NAME'         => $lang['Search_name'],
            'L_SEARCH_NAME_EXPLAIN' => $lang['Search_name_explain'],
            'L_SEARCH_URL'          => $lang['Search_url'],
            'L_SEARCH_URL_EXPLAIN'  => $lang['Search_url_explain'],
            'L_SUBMIT'              => $lang['Submit'],
            'L_RESET'               => $lang['Reset'],
            'L_YES'                 => $lang['Yes'],
            'L_NO'                  => $lang['No'],
            'S_SEARCH_ACTION'       => admin_sid('admin_quicksearch.php'),
            'S_HIDDEN_FIELDS'       => $s_hidden_fields)
        );
    } else if( $mode == 'save' ) {
        //
        // Ok, they sent us our info, let's update it.
        //
        $search_id = $_GETVAR->get('id', 'post', 'int', 0);
        $search_name = trim($_GETVAR->get('search_name', 'post', 'string', ''));
        $search_url1 = trim($_GETVAR->get('search_url1', 'post', 'string', ''));
        $search_url2 = trim($_GETVAR->get('search_url2', 'post', 'string', ''));
        if( empty($search_name) ) {
            message_die(GENERAL_MESSAGE, $lang['Must_enter_search_name']);
        }
        if ($search_id) {
            $sql = "UPDATE " . QUICKSEARCH_TABLE . "
                    SET search_name = '" . str_replace("\'", "''", $search_name) . "', search_url1 = '" . str_replace("\'", "''", $search_url1) . "', search_url2 = '" . str_replace("\'", "''", $search_url2) . "'
                    WHERE search_id = $search_id";
            $message = $lang['Search_updated'];
        } else {
            $sql = "INSERT INTO " . QUICKSEARCH_TABLE . " (search_name, search_url1, search_url2)
                    VALUES ('" . str_replace("\'", "''", $search_name) . "', '" . str_replace("\'", "''", $search_url1) . "', '" . str_replace("\'", "''", $search_url2) . "')";
            $message = $lang['Search_added'];
        }
        if( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, "Couldn't update quick search table", "", __LINE__, __FILE__, $sql);
        }
        $message .= "<br /><br />" . sprintf($lang['Click_return_addsearchadmin'], "<a href=\"" . admin_sid("admin_quicksearch.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
        message_die(GENERAL_MESSAGE, $message);
    } else if( $mode == 'delete' ) {
        $search_id = $_GETVAR->get('id', 'post', 'int', NULL) ? $_GETVAR->get('id', 'post', 'int') : message_die(CRITICAL_ERROR, 'No search ID was selected to be deleted.');
        if( $search_id ) {
            $sql = "DELETE FROM " . QUICKSEARCH_TABLE . "
                    WHERE search_id = $search_id";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't delete quick search data", "", __LINE__, __FILE__, $sql);
            }
            $message = $lang['Search_removed'] . "<br /><br />" . sprintf($lang['Click_return_addsearchadmin'], "<a href=\"" . admin_sid("admin_quicksearch.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
        } else {
            message_die(GENERAL_MESSAGE, $lang['Must_select_page']);
        }
    } else {
        $template->set_filenames(array(
            'body' => 'admin/quicksearch_body.tpl')
        );
        $sql = "SELECT * FROM " . QUICKSEARCH_TABLE . "
                ORDER BY search_name";
        if( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, "Couldn't retrieve quick search data", "", __LINE__, __FILE__, $sql);
        }
        $search_rows = array();
        $search_rows = $db->sql_fetchrowset($result);
        $search_count = count($search_rows);
        $template->assign_vars(array(
            'L_SEARCHS_TITLE'   => $lang['Search_title'],
            'L_SEARCHS_TEXT'    => $lang['Search_explain'],
            'L_SEARCH_NAME'     => $lang['Search_name'],
            'L_EDIT'            => $lang['Edit'],
            'L_DELETE'          => $lang['Delete'],
            'L_ADD_SEARCH'      => $lang['Add_new_search'],
            'L_ACTION'          => $lang['Action'],
            'S_SEARCHS_ACTION'  => admin_sid('admin_quicksearch.php'))
        );
        for( $i = 0; $i < $search_count; $i++) {
            $search_name = $search_rows[$i]['search_name'];
            $search_id = $search_rows[$i]['search_id'];
            $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
            $template->assign_block_vars('addsearch', array(
                'ROW_COLOR'         => '#' . $row_color,
                'ROW_CLASS'         => $row_class,
                'SEARCH_NAME'       => $search_name,
                'U_SEARCH_EDIT'     => admin_sid('admin_quicksearch.php&amp;mode=edit&amp;id=' . $search_id),
                'U_SEARCH_DELETE'   => admin_sid('admin_quicksearch.php&amp;mode=delete&amp;id=' . $search_id))
            );
        }
    }
} else {
    //
    // Show the default page
    //
    $template->set_filenames(array(
        'body' => 'admin/quicksearch_body.tpl')
    );
    $sql = "SELECT * FROM " . QUICKSEARCH_TABLE . "
        ORDER BY search_name";
    if( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Couldn't retrieve quick search data", "", __LINE__, __FILE__, $sql);
    }
    $search_count = $db->sql_numrows($result);
    $search_rows = array();
    $search_rows = $db->sql_fetchrowset($result);
    $template->assign_vars(array(
        'L_SEARCHS_TITLE'   => $lang['Search_title'],
        'L_SEARCHS_TEXT'    => $lang['Search_explain'],
        'L_SEARCH_NAME'     => $lang['Search_name'],
        'L_EDIT'            => $lang['Edit'],
        'L_DELETE'          => $lang['Delete'],
        'L_ADD_SEARCH'      => $lang['Add_new_search'],
        'L_ACTION'          => $lang['Action'],
        'S_SEARCHS_ACTION'  => admin_sid('admin_quicksearch.php'))
    );
    for($i = 0; $i < $search_count; $i++) {
        $search_name = $search_rows[$i]['search_name'];
        $search_id = $search_rows[$i]['search_id'];
        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
        $template->assign_block_vars('addsearch', array(
            'ROW_COLOR'         => '#' . $row_color,
            'ROW_CLASS'         => $row_class,
            'SEARCH_NAME'       => $search_name,
            'U_SEARCH_EDIT'     => admin_sid('admin_quicksearch.php&amp;mode=edit&amp;id=' . $search_id),
            'U_SEARCH_DELETE'   => admin_sid('admin_quicksearch.php&amp;mode=delete&amp;id=' . $search_id))
        );
    }
}
$template->pparse('body');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>