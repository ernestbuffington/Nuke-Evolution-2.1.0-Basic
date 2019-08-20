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
        $module['General']['Word_Censor'] = $filename;
        return;
    }
}

global $_GETVAR, $cache;

if (  $_GETVAR->get('cancel', 'post', 'string', NULL) ) {
    redirect(admin_sid('admin_words.php', TRUE));
}
$mode =  $_GETVAR->get('mode', 'request', 'string', '');
// Restrict mode input to valid options
$mode = ( in_array($mode, array('add', 'edit', 'save', 'delete')) ) ? $mode : '';
if( $mode != '' ) {
    if( $mode == 'edit' || $mode == 'add' ) {
        $word_id = $_GETVAR->get('id', 'get', 'int', 0);
        $template->set_filenames(array(
            'body' => 'admin/words_edit_body.tpl')
        );
        $word_info = array('word' => '', 'replacement' => '');
        $s_hidden_fields = '';
        if( $mode == 'edit' ) {
            if( $word_id ) {
                $sql = 'SELECT *
                       FROM ' . WORDS_TABLE . '
                       WHERE word_id = ' . $word_id;
                if(!$result = $db->sql_query($sql)) {
                    message_die(GENERAL_ERROR, "Could not query words table", "Error", __LINE__, __FILE__, $sql);
                }
                $word_info = $db->sql_fetchrow($result);
                $s_hidden_fields .= '<input type="hidden" name="id" value="' . $word_id . '" />';
            } else {
                message_die(GENERAL_MESSAGE, $lang['No_word_selected']);
            }
        }
        $template->assign_vars(array(
            'WORD'              => htmlspecialchars($word_info['word']),
            'REPLACEMENT'       => htmlspecialchars($word_info['replacement']),
            'L_WORDS_TITLE'     => $lang['Words_title'],
            'L_WORDS_TEXT'      => $lang['Words_explain'],
            'L_WORD_CENSOR'     => $lang['Edit_word_censor'],
            'L_WORD'            => $lang['Word'],
            'L_REPLACEMENT'     => $lang['Replacement'],
            'L_SUBMIT'          => $lang['Submit'],
            'S_WORDS_ACTION'    => admin_sid('admin_words.php&amp;mode=save'),
            'S_HIDDEN_FIELDS'   => $s_hidden_fields)
        );
        $template->pparse('body');
        include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
    } else if( $mode == 'save' ) {
        $word_id      = $_GETVAR->get('id', 'post', 'int', NULL);
        $word         = trim( $_GETVAR->get('word', 'post', 'string', NULL) );
        $replacement  = trim( $_GETVAR->get('replacement', 'post', 'string', NULL) );
        if(empty($word) || empty($replacement)) {
            message_die(GENERAL_MESSAGE, $lang['Must_enter_word']);
        }
        if( $word_id ) {
            $sql = "UPDATE " . WORDS_TABLE . "
                    SET word = '" . str_replace("\'", "''", $word) . "', replacement = '" . str_replace("\'", "''", $replacement) . "'
                    WHERE word_id = $word_id";
            $message = $lang['Word_updated'];
        } else {
            $sql = "INSERT INTO " . WORDS_TABLE . " (word, replacement)
                    VALUES ('" . str_replace("\'", "''", $word) . "', '" . str_replace("\'", "''", $replacement) . "')";
            $message = $lang['Word_added'];
        }
        if(!$result = $db->sql_query($sql)) {
            message_die(GENERAL_ERROR, "Could not insert data into words table", $lang['Error'], __LINE__, __FILE__, $sql);
        }
        $cache->delete('evoconfig', 'config');
        $message .= "<br /><br />" . sprintf($lang['Click_return_wordadmin'], "<a href=\"" . admin_sid("admin_words.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            cache_words();
            message_die(GENERAL_MESSAGE, $message);
    } else if( $mode == 'delete' ) {
        $word_id = $_GETVAR->get('id', 'request', 'int', NULL);
        $confirm = $_GETVAR->get('confirm', 'post', 'string', NULL);
        if( $word_id && $confirm ) {
            $sql = "DELETE FROM " . WORDS_TABLE . "
                    WHERE word_id = $word_id";
            $cache->delete('evoconfig', 'config');
            if(!$result = $db->sql_query($sql)) {
                    message_die(GENERAL_ERROR, "Could not remove data from words table", $lang['Error'], __LINE__, __FILE__, $sql);
            }
            cache_words();
            $message = $lang['Word_removed'] . "<br /><br />" . sprintf($lang['Click_return_wordadmin'], "<a href=\"" . admin_sid("admin_words.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
        } elseif( $word_id && !$confirm) {
            // Present the confirmation screen to the user
            $template->set_filenames(array(
                'body' => 'admin/confirm_body.tpl')
            );
            $hidden_fields = '<input type="hidden" name="mode" value="delete" /><input type="hidden" name="id" value="' . $word_id . '" />';
            $template->assign_vars(array(
                'MESSAGE_TITLE'     => $lang['Confirm'],
                'MESSAGE_TEXT'      => $lang['Confirm_delete_word'],
                'L_YES'             => $lang['Yes'],
                'L_NO'              => $lang['No'],
                'S_CONFIRM_ACTION'  => admin_sid('admin_words.php'),
                'S_HIDDEN_FIELDS'   => $hidden_fields)
            );
        } else {
            message_die(GENERAL_MESSAGE, $lang['No_word_selected']);
        }
    }
} else {
    $template->set_filenames(array(
            'body' => 'admin/words_list_body.tpl')
    );
    $sql = 'SELECT *
            FROM ' . WORDS_TABLE . '
            ORDER BY word';
    if( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Could not query words table", $lang['Error'], __LINE__, __FILE__, $sql);
    }
    $word_rows = $db->sql_fetchrowset($result);
    $db->sql_freeresult($result);
    $word_count = count($word_rows);
    $template->assign_vars(array(
        'L_WORDS_TITLE'     => $lang['Words_title'],
        'L_WORDS_TEXT'      => $lang['Words_explain'],
        'L_WORD'            => $lang['Word'],
        'L_REPLACEMENT'     => $lang['Replacement'],
        'L_EDIT'            => $lang['Edit'],
        'L_DELETE'          => $lang['Delete'],
        'L_ADD_WORD'        => $lang['Add_new_word'],
        'L_ACTION'          => $lang['Action'],
        'S_WORDS_ACTION'    => admin_sid('admin_words.php&amp;mode=add'),
        'S_HIDDEN_FIELDS'   => '')
    );
    for($i = 0; $i < $word_count; $i++) {
        $word = $word_rows[$i]['word'];
        $replacement = $word_rows[$i]['replacement'];
        $word_id = $word_rows[$i]['word_id'];
        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
        $template->assign_block_vars('words', array(
            'ROW_COLOR'     => '#' . $row_color,
            'ROW_CLASS'     => $row_class,
            'WORD'          => htmlspecialchars($word),
            'REPLACEMENT'   => htmlspecialchars($replacement),
            'U_WORD_EDIT'   => admin_sid('admin_words.php&amp;mode=edit&amp;id=' . $word_id),
            'U_WORD_DELETE' => admin_sid('admin_words.php&amp;mode=delete&amp;id=' . $word_id))
        );
    }
}
$template->pparse('body');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>