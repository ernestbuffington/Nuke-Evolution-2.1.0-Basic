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
        $module['Forums']['Permissions']   = $filename;
        return;
    }
}

global $_GETVAR, $currentlang;

$lang_file = '/lang_admin.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}
$lang_file = '/lang_admin_attach.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

include_once( NUKE_FORUMS_DIR . 'cat_mod/includes/def_auth.php');

// build an indexed array on field names
@reset($field_names);
$forum_auth_fields = array();
while ( list($auth_key, $auth_name) = @each($field_names) ) {
    $forum_auth_fields[] = $auth_key;
}
attach_setup_forum_auth($simple_auth_ary, $forum_auth_fields, $field_names);

if( $_GETVAR->get(POST_FORUM_URL, 'post', 'string') || $_GETVAR->get(POST_FORUM_URL, 'get', 'string') ) {
    $fid = $_GETVAR->get(POST_FORUM_URL, 'post', 'string') ? $_GETVAR->get(POST_FORUM_URL, 'post', 'string') : ( $_GETVAR->get(POST_FORUM_URL, 'get', 'string') ? $_GETVAR->get(POST_FORUM_URL, 'get', 'string') : message_die('Possible Hacking attempt') );
    $f_type = substr($fid, 0, 1);
    if ($f_type == POST_FORUM_URL) {
        $forum_id = intval(substr($fid, 1));
        $forum_sql = " WHERE forum_id = $forum_id";
    } else {
        unset($forum_id);
        $forum_sql = '';
    }
} else {
    unset($forum_id);
    $forum_sql = '';
}

if( $_GETVAR->get('adv', 'get', 'int') == 0 || $_GETVAR->get('adv', 'get', 'int') == 1 ) {
    $adv = intval($_GETVAR->get('adv', 'get', 'int'));
} else {
    unset($adv);
}
//
// Start program proper
//
if( $_GETVAR->get('submit', 'post', 'string') ) {
    $sql = '';
    if(!empty($forum_id)) {
        if( $_GETVAR->get('simpleauth', 'post', 'string') ) {
            $simple_ary = $simple_auth_ary[intval($_GETVAR->get('simpleauth', 'post', 'string'))];
            for($i = 0; $i < count($simple_ary); $i++) {
                $sql .= ( ( $sql != '' ) ? ', ' : '' ) . $forum_auth_fields[$i] . ' = ' . $simple_ary[$i];
            }
            if (is_array($simple_ary)) {
                $sql = "UPDATE " . FORUMS_TABLE . " SET $sql WHERE forum_id = $forum_id";
            }
        } else {
            for($i = 0; $i < count($forum_auth_fields); $i++) {
                $value = $_GETVAR->get($forum_auth_fields[$i], 'post', 'int', 0);
                    if ( $forum_auth_fields[$i] == 'auth_vote' ) {
                        if ( $_GETVAR->get('auth_vote', 'post', 'string') == AUTH_ALL ) {
                            $value = AUTH_REG;
                        }
                    }
                    $sql .= ( ( $sql != '' ) ? ', ' : '' ) .$forum_auth_fields[$i] . ' = ' . $value;
            }
            $sql = "UPDATE " . FORUMS_TABLE . " SET $sql WHERE forum_id = $forum_id";
        }
        if ( $sql != '' ) {
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Could not update auth table', '', __LINE__, __FILE__, $sql);
            }
        }
        $forum_sql = '';
        $adv = 0;
    }
    cache_tree(TRUE);
    $template->assign_vars(array(
        'META' => '<meta http-equiv="refresh" content="3;url=' . admin_sid("admin_forumauth.php&amp;" . POST_FORUM_URL . "=$forum_id") . '" />')
    );
    $message = $lang['Forum_auth_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumauth'],  '<a href="' . admin_sid("admin_forumauth.php") . '">', "</a>");
    message_die(GENERAL_MESSAGE, $message);

} // End of submit

//
// Get required information, either all forums if
// no id was specified or just the requsted if it
// was
//

if( empty($forum_id) ) {
    //
    // Output the selection table if no forum id was
    // specified
    //
    $template->set_filenames(array(
        'body' => 'admin/auth_select_body.tpl')
    );
    $select_list = selectbox(POST_FORUM_URL, FALSE, '', TRUE);
    $template->assign_vars(array(
        'L_AUTH_TITLE'      => $lang['Auth_Control_Forum'],
        'L_AUTH_EXPLAIN'    => $lang['Forum_auth_explain'],
        'L_AUTH_SELECT'     => $lang['Select_a_Forum'],
        'L_LOOK_UP'         => $lang['Look_up_Forum'],
        'S_AUTH_ACTION'     => admin_sid('admin_forumauth.php'),
        'S_AUTH_SELECT'     => $select_list)
    );

} else {
    //
    // Output the authorisation details if an id was
    // specified
    //
    $template->set_filenames(array(
        'body' => 'admin/auth_forum_body.tpl')
    );
    $forum_rows[0] = $tree['data'][$tree['keys'][POST_FORUM_URL . $forum_id]];
    $forum_name_trad = get_object_lang(POST_FORUM_URL . $forum_id, 'name');
    $forum_name = $forum_rows[0]['forum_name'];
    if ($forum_name != $forum_name_trad) {
        $forum_name = '(' . $forum_name . ') ' . $forum_name_trad;
    }
    @reset($simple_auth_ary);
    while( list($key, $auth_levels) = each($simple_auth_ary)) {
        $matched = 1;
        for($k = 0; $k < count($auth_levels); $k++) {
            $matched_type = $key;
            if ( $forum_rows[0][$forum_auth_fields[$k]] != $auth_levels[$k] ) {
                $matched = 0;
            }
        }
        if ( $matched ) {
            break;
        }
    }

    //
    // If we didn't get a match above then we
    // automatically switch into 'advanced' mode
    //
    if ( !isset($adv) && !$matched ) {
        $adv = 1;
    }
    $s_column_span = 0;
    if ( empty($adv) ) {
        $simple_auth = '<select name="simpleauth">';
        for($j = 0; $j < count($simple_auth_types); $j++) {
            $selected = ( $matched_type == $j ) ? ' selected="selected"' : '';
            $simple_auth .= '<option value="' . $j . '"' . $selected . '>' . $simple_auth_types[$j] . '</option>';
        }
        $simple_auth .= '</select>';
        $template->assign_block_vars('forum_auth_titles', array(
            'CELL_TITLE' => $lang['Simple_mode'])
        );
        $template->assign_block_vars('forum_auth_data', array(
            'S_AUTH_LEVELS_SELECT' => $simple_auth)
        );
        $s_column_span++;
    } else {
        //
        // Output values of individual
        // fields
        //
        for($j = 0; $j < count($forum_auth_fields); $j++) {
            $custom_auth[$j] = '&nbsp;<select name="' . $forum_auth_fields[$j] . '">';
            for($k = 0; $k < count($forum_auth_levels); $k++) {
                $selected = ( $forum_rows[0][$forum_auth_fields[$j]] == $forum_auth_const[$k] ) ? ' selected="selected"' : '';
                $custom_auth[$j] .= '<option value="' . $forum_auth_const[$k] . '"' . $selected . '>' . $lang['Forum_' . $forum_auth_levels[$k]] . '</option>';
            }
            $custom_auth[$j] .= '</select>&nbsp;';
            $cell_title = $field_names[$forum_auth_fields[$j]];
            $template->assign_block_vars('forum_auth_titles', array(
                'CELL_TITLE' => $cell_title)
            );
            $template->assign_block_vars('forum_auth_data', array(
                'S_AUTH_LEVELS_SELECT' => $custom_auth[$j])
            );
            $s_column_span++;
        }
    }
    $adv_mode           = ( empty($adv) ) ? '1' : '0';
    $switch_mode        = admin_sid('admin_forumauth.php&amp;' . POST_FORUM_URL . '=f' . $forum_id . '&amp;adv='. $adv_mode);
    $switch_mode_text   = ( empty($adv) ) ? $lang['Advanced_mode'] : $lang['Simple_mode'];
    $u_switch_mode      = '<a href="' . $switch_mode . '">' . $switch_mode_text . '</a>';
    $s_hidden_fields    = '<input type="hidden" name="' . POST_FORUM_URL . '" value="f' . $forum_id . '">';
    $template->assign_vars(array(
        'FORUM_NAME'        => $forum_name,
        'L_FORUM'           => $lang['Forum'],
        'L_AUTH_TITLE'      => $lang['Auth_Control_Forum'],
        'L_AUTH_EXPLAIN'    => $lang['Forum_auth_explain'],
        'L_SUBMIT'          => $lang['Submit'],
        'L_RESET'           => $lang['Reset'],
        'U_SWITCH_MODE'     => $u_switch_mode,
        'S_FORUMAUTH_ACTION'=> admin_sid('admin_forumauth.php'),
        'S_COLUMN_SPAN'     => $s_column_span,
        'S_HIDDEN_FIELDS'   => $s_hidden_fields)
    );

}
$template->pparse('body');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>