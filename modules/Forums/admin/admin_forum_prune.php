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
        $module['Forums']['Prune'] = $filename;
        return;
    }
}

global $_GETVAR;

$forumurl = $_GETVAR->get(POST_FORUM_URL, '_REQUEST', 'string');
require_once(NUKE_INCLUDE_DIR . 'prune.php');
require_once(NUKE_INCLUDE_DIR . 'functions_admin.php');

//
// Get the forum ID for pruning
//
if( !empty($forumurl) ) {
    $fid    = ($forumurl ? $forumurl : message_die('Possible Hacking attempt') );
    $type   = substr($fid, 0, 1);
    $id     = intval(substr($fid, 1));
    $cat_id = -1;
    $forum_id = -1;
    if ($fid == 'Root') {
        $type = POST_CAT_URL;
    }
    if ($type == POST_CAT_URL) {
        $cat_id = $id;
    } else {
        $forum_id = $id;
    }
    $fid = $type . $id;
    if ( empty($fid) || ( $fid == POST_CAT_URL . '0' ) ) {
        $fid = 'Root';
    }

    // set the sql request
    $tkeys = array();
    $tkeys = get_auth_keys($fid, true);
    $forum_rows = array();
    for ($i=0, $max=count($tkeys['id']); $i < $max; $i++) {
        if (isset($tree['type'][$tkeys['idx'][$i]]) && $tree['type'][$tkeys['idx'][$i]] == POST_FORUM_URL) {
            $forum_rows[] = $tree['data'][$tkeys['idx'][$i]];
        }
    }
} else {
    $forum_rows = array();
    $forum_id = '';
    $forum_sql = '';
}

//
// Check for submit to be equal to Prune. If so then proceed with the pruning.
//
if( $_GETVAR->get('doprune', 'post', 'string') ) {
    $prunedays =  $_GETVAR->get('prunedays', 'post', 'int') ? $_GETVAR->get('prunedays', 'post', 'int') : 0;
    // Convert days to seconds for timestamp functions...
    $prunedate = time() - ( $prunedays * 86400 );
    $template->set_filenames(array(
        'body' => 'admin/forum_prune_result_body.tpl')
    );
    for($i = 0; $i < count($forum_rows); $i++) {
        $p_result = prune($forum_rows[$i]['forum_id'], $prunedate);
        sync('forum', $forum_rows[$i]['forum_id']);
        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
        $template->assign_block_vars('prune_results', array(
            'ROW_COLOR'     => '#' . $row_color,
            'ROW_CLASS'     => $row_class,
            'FORUM_NAME'    => get_object_lang(POST_FORUM_URL . $forum_rows[$i]['forum_id'], 'name'),
            'FORUM_TOPICS'  => $p_result['topics'],
            'FORUM_POSTS'   => $p_result['posts'])
        );
    }
    $template->assign_vars(array(
        'L_FORUM_PRUNE'     => $lang['Forum_Prune'],
        'L_FORUM'           => $lang['Forum'],
        'L_TOPICS_PRUNED'   => $lang['Topics_pruned'],
        'L_POSTS_PRUNED'    => $lang['Posts_pruned'],
        'L_PRUNE_RESULT'    => $lang['Prune_success'])
    );
} else {
    //
    // If they haven't selected a forum for pruning yet then
    // display a select box to use for pruning.
    //
    if( !($_GETVAR->get(POST_FORUM_URL, 'post', 'string')) ) {
        //
        // Output a selection table if no forum id has been specified.
        //
        $template->set_filenames(array(
            'body' => 'admin/forum_prune_select_body.tpl')
        );
        $select_list = selectbox(POST_FORUM_URL, false, '', true);
        //
        // Assign the template variables.
        //
        $template->assign_vars(array(
            'L_FORUM_PRUNE'       => $lang['Forum_Prune'],
            'L_SELECT_FORUM'      => $lang['Select_a_Forum'],
            'L_LOOK_UP'           => $lang['Look_up_Forum'],
            'S_FORUMPRUNE_ACTION' => admin_sid('admin_forum_prune.php'),
            'S_FORUMS_SELECT'     => $select_list)
        );
    } else {
        //
        // Output the form to retrieve Prune information.
        //
        $template->set_filenames(array(
            'body' => 'admin/forum_prune_body.tpl')
        );
        $forum_name = ($fid == 'Root') ? $lang['All_Forums'] : get_object_lang($fid, 'name');
        $prune_data = $lang['Prune_topics_not_posted'] . " ";
        $prune_data .= '<input class="post" type="text" name="prunedays" size="4" /> ' . $lang['Days'];
        $hidden_input = '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $fid . '" />';

        //
        // Assign the template variables.
        //
        $template->assign_vars(array(
            'FORUM_NAME'            => $forum_name,
            'L_FORUM'               => ( $cat_id > 0 ) ? $lang['Category'] : $lang['Forum'],
            'L_FORUM_PRUNE'         => $lang['Forum_Prune'],
            'L_FORUM_PRUNE_EXPLAIN' => $lang['Forum_Prune_explain'],
            'L_DO_PRUNE'            => $lang['Do_Prune'],
            'S_FORUMPRUNE_ACTION'   => admin_sid('admin_forum_prune.php'),
            'S_PRUNE_DATA'          => $prune_data,
            'S_HIDDEN_VARS'         => $hidden_input)
        );
    }
}
//
// Actually output the page here.
//
$template->pparse('body');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>