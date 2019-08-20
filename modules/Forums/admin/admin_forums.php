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
        $module['Forums']['Manage'] = $filename;
        return;
    }
}

global $_GETVAR, $cache;
include(NUKE_INCLUDE_DIR . 'functions_admin.php');

$forum_auth_ary = array(
    'auth_view'         => AUTH_ALL,
    'auth_read'         => AUTH_ALL,
    'auth_post'         => AUTH_REG,
    'auth_reply'        => AUTH_REG,
    'auth_edit'         => AUTH_REG,
    'auth_delete'       => AUTH_REG,
    'auth_sticky'       => AUTH_MOD,
    'auth_announce'     => AUTH_MOD,
    'auth_vote'         => AUTH_REG,
    'auth_pollcreate'   => AUTH_REG,
    'auth_attachments'  => AUTH_REG,
    'auth_download'     => AUTH_REG
);

//
// Initial setting
//
$mode = $_GETVAR->get('mode', 'request', 'string', '') ;
$cat_id   = $_GETVAR->get(POST_CAT_URL, 'request', 'int', 0);
$forum_id = $_GETVAR->get(POST_FORUM_URL, 'request', 'int', 0) ;

// check the presence of the attachment of the forum
$sql = "SELECT main_type FROM " . FORUMS_TABLE;
if ( $db->sql_query($sql) ) {
    define('SUB_FORUM_ATTACH', TRUE);
}


// check and fix parm
function admin_check_cat() {
    global $db;
    $res = FALSE;
    // build the cat list
    $mains = array();
    // from cats
    $sql = "SELECT * FROM " . CATEGORIES_TABLE . " ORDER BY cat_id";
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Couldn't access list of Categories", "", __LINE__, __FILE__, $sql);
    }
    while ( $row = $db->sql_fetchrow($result) ) {
        // fix cat_main value
        if (empty($row['cat_main_type'])) {
            $row['cat_main_type'] = POST_CAT_URL;
        }
        if ( $row['cat_main'] == $row['cat_id'] ) {
            $row['cat_main_type'] = POST_CAT_URL;
            $row['cat_main'] = 0;
        }
        // fill hierarchy array
        $mains[ POST_CAT_URL . $row['cat_id'] ] = $row['cat_main_type'] . $row['cat_main'];
    }
    // from forums
    $sql = "SELECT * FROM " . FORUMS_TABLE . " ORDER BY forum_id";
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Couldn't access list of Forums", "", __LINE__, __FILE__, $sql);
    }
    while ( $row = $db->sql_fetchrow($result) ) {
        // fill hierarchy array
        if (empty($row['main_type'])) {
            $row['main_type'] = POST_CAT_URL;
        }
        $mains[POST_FORUM_URL . $row['forum_id'] ] = $row['main_type'] . $row['cat_id'];
    }
    // no forums nor cats
    if (empty($mains)) {
        return FALSE;
    }
    // push each cat
    reset($mains);
    while (list($id, $main) = each($mains) ) {
        $root     = FALSE;
        $cur      = $id;
        $stack    = array();
        $stack[]  = $cur;
        $error    = FALSE;
        while ( !$root ) {
            // parent catagory doesn't exists
            if ( ($mains[$cur] != 'c0' ) && !isset($mains[ $mains[$cur] ]) ) {
                $error = TRUE;
                $mains[$cur] = 'c0';
            }
            // the parent category is already in the stack (recursive attachement)
            if ( in_array($mains[$cur], $stack) ) {
                $error = TRUE;
                $mains[$cur] = 'c0';
            }
            // push parent category id
            $stack[] = $mains[$cur];
            // climb up a level
            $root = ($mains[$cur] == 'c0');
            $cur = $mains[$cur];
        }
        // update database
        $type       = substr($id, 0, 1);
        $i          = intval(substr($id, 1));
        $main_type  = substr($mains[$id], 0, 1);
        $main_id    = intval(substr($mains[$id], 1));
        if ( $i != 0) {
            switch( $type ) {
                case POST_CAT_URL:
                    $sql = "UPDATE " . CATEGORIES_TABLE . " SET cat_main_type='$main_type', cat_main=$main_id WHERE cat_id=$i";
                    if ( !$result = $db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, "Couldn't update list of Categories", "", __LINE__, __FILE__, $sql);
                    }
                    break;
                case POST_FORUM_URL:
                    $sql = "UPDATE " . FORUMS_TABLE . " SET cat_id=$main_id WHERE forum_id=$i";
                    if (defined('SUB_FORUM_ATTACH')) {
                        $sql = "UPDATE " . FORUMS_TABLE . " SET main_type='$main_type, cat_id=$main_id' WHERE forum_id=$i";
                    }
                    if ( !$result = $db->sql_query($sql) ) {
                        message_die(GENERAL_ERROR, "Couldn't update list of Forums", "", __LINE__, __FILE__, $sql);
                    }
                    break;
                default:
                    $sql = '';
                    break;
            }
        }
    }
    return $error;
}

function move_tree($type, $id, $move) {
    global $db, $tree;

    // search the object
    $this_var = (isset($tree['keys'][ $type . $id ])) ? $tree['keys'][ $type . $id ] : -1;
    // get the root id
    $main     = ($this_var < 0) ? 'Root' : $tree['main'][$this_var];
    // renum objects of the same level and regenerate all
    $cats     = array();
    $forums   = array();
    $order    = 0;
    $parents  = array();
    $count_tree = (isset($tree['data']) ? count($tree['data']) : 0);
    for ($i=0; $i < $count_tree; $i++) {
        if ($tree['main'][$i] == $main) {
            $order = $order + 10;
            $worder = ($i == $this_var) ? $order + $move : $order;
            $field_name = ($tree['type'][$i] == POST_CAT_URL) ? 'cat_order' : 'forum_order';
            $tree['data'][$i][$field_name] = $worder;
        }
        if ($tree['type'][$i] == POST_CAT_URL) {
            $idx = count($cats);
            $cats[$idx] = $tree['data'][$i];
            $parents[POST_CAT_URL][ $tree['main'][$i] ][] = $idx;
        } else {
            $idx = count($forums);
            $forums[$idx] = $tree['data'][$i];
            $parents[POST_FORUM_URL][ $tree['main'][$i] ][] = $idx;
        }
    }
    // build the tree
    $tree = array();
    cache_tree_level('Root', $parents, $cats, $forums);
    $count_tree = (isset($tree['data']) ? count($tree['data']) : 0);
    // re-order all
    $order = 0;
    for ($i=0; $i < $count_tree; $i++) {
        $order = $order + 10;
        if ($tree['type'][$i] == POST_CAT_URL) {
            $sql = "UPDATE " . CATEGORIES_TABLE . " SET cat_order=$order WHERE cat_id=" . $tree['id'][$i];
        } else {
            $sql = "UPDATE " . FORUMS_TABLE . " SET forum_order=$order WHERE forum_id=" . $tree['id'][$i];
        }
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t update cat/forum order', '', __LINE__, __FILE__, $sql);
        }
    }
}

function get_info($mode, $id) {
    global $db;
    switch($mode) {
        case 'category':
            $table = CATEGORIES_TABLE;
            $idfield = 'cat_id';
            $namefield = 'cat_title';
            break;
        case 'forum':
            $table = FORUMS_TABLE;
            $idfield = 'forum_id';
            $namefield = 'forum_name';
            break;
        default:
            message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);
            break;
    }
    $sql = "SELECT count(cat_id) as total
            FROM $table";
    if( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Couldn't get Forum/Category information", "", __LINE__, __FILE__, $sql);
    }
    $count = $db->sql_fetchrow($result);
    $count = $count['total'];
    $sql = "SELECT *
            FROM $table
            WHERE $idfield = $id";
    if( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, "Couldn't get Forum/Category information", "", __LINE__, __FILE__, $sql);
    }
    if( $db->sql_numrows($result) != 1 ) {
            message_die(GENERAL_ERROR, "Forum/Category doesn't exist or multiple forums/categories with ID $id", "", __LINE__, __FILE__);
    }
    $return = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $return['number'] = $count;
    return $return;
}

function get_list($mode, $id, $select) {
    global $db;

    switch($mode) {
        case 'category':
            $table = CATEGORIES_TABLE;
            $idfield = 'cat_id';
            $namefield = 'cat_title';
            break;
        case 'forum':
            $table = FORUMS_TABLE;
            $idfield = 'forum_id';
            $namefield = 'forum_name';
            break;
        default:
            message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);
            break;
    }
    $sql = "SELECT *
            FROM $table";
    if( $select == 0 ) {
        $sql .= " WHERE $idfield <> $id";
    }
    if( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Couldn't get list of Categories/Forums", "", __LINE__, __FILE__, $sql);
    }
    $cat_list = "";
    while( $row = $db->sql_fetchrow($result) ) {
        $s = "";
        if ($row[$idfield] == $id) {
            $s = " selected=\"selected\"";
        }
        $catlist .= "<option value=\"$row[$idfield]\"$s>" . $row[$namefield] . "</option>\n";
    }
    $db->sql_freeresult($result);
    return($catlist);
}

function renumber_order($mode, $cat = 0) {
    global $db, $cache;

    switch($mode) {
        case 'category':
            $table      = CATEGORIES_TABLE;
            $idfield    = 'cat_id';
            $orderfield = 'cat_order';
            $cat        = 0;
            break;
        case 'forum':
            $table      = FORUMS_TABLE;
            $idfield    = 'forum_id';
            $orderfield = 'forum_order';
            $catfield   = 'cat_id';
            break;
        default:
            message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);
            break;
    }
    $sql = "SELECT * FROM $table";
    if( $cat != 0) {
        $sql .= " WHERE $catfield = $cat";
    }
    $sql .= " ORDER BY $orderfield ASC";
    if( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Couldn't get list of Categories", "", __LINE__, __FILE__, $sql);
    }
    $i = 10;
    $inc = 10;
    while( $row = $db->sql_fetchrow($result) ) {
        $sql = "UPDATE $table
                SET $orderfield = $i
                WHERE $idfield = " . $row[$idfield];
        if( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, "Couldn't update order fields", "", __LINE__, __FILE__, $sql);
        }
        $i += 10;
    }
    $db->sql_freeresult($result);
}
//
// End function block
// ------------------

//
// Begin program proper
//
if( isset($_POST['addforum']) || isset($_POST['addcategory']) ) {
    $mode = ( isset($_POST['addforum']) ) ? 'addforum' : 'addcat';
    if( $mode == 'addforum' ) {
        $temp_cat_id    = $_GETVAR->get('addforum', 'post', 'array', array());
        list($cat_id)   = each($temp_cat_id);
        $cat_id         = intval($cat_id);
        //
        // stripslashes needs to be run on this because slashes are added when the forum name is posted
        //
        $temp_var = $_GETVAR->get('name', 'post', 'array', array());
        $forumname = stripslashes($temp_var[$cat_id]);
    }
    if( $mode == 'addcat' ) {
        $temp_cat_id    = $_GETVAR->get('addcategory', 'post', 'array', array());
        list($cat_id)   = each($temp_cat_id);
        $temp_var       = $_GETVAR->get('name', 'post', 'array', array());
        $cat_title      = stripslashes($temp_var[$cat_id]);
        $cat_main       = $cat_id;
        $cat_id         = -1;
    }
}

if( !empty($mode) ) {
    admin_check_cat();
    get_user_tree($userdata);
    $show_index = FALSE;
    switch($mode) {
        case 'addforum':
        case 'editforum':
            //
            // Show form to create/modify a forum
            //
            if ($mode == 'editforum') {
                // $newmode determines if we are going to INSERT or UPDATE after posting?
                $l_title        = $lang['Edit_forum'];
                $newmode        = 'modforum';
                $buttonvalue    = $lang['Update'];
                $forum_id       =  $_GETVAR->get(POST_FORUM_URL, 'request', 'int', 0) ;
                $row            = get_info('forum', $forum_id);
                $cat_id         = $row['cat_id'];
                $forumname      = htmlspecialchars($row['forum_name']);
                $forumdesc      = $row['forum_desc'];
                $forumstatus    = $row['forum_status'];
                $main_type      = $row['main_type'];
                if (!defined('SUB_FORUM_ATTACH')) {
                    if (empty($main_type)) {
                        $main_type = POST_CAT_URL;
                    }
                }
                $forum_link             = $row['forum_link'];
                $forum_link_internal    = intval($row['forum_link_internal']);
                $forum_link_hit_count   = intval($row['forum_link_hit_count']);
                $forum_link_hit         = intval($row['forum_link_hit']);
                $icon                   = $row['icon'];
                $forum_display_sort     = $row['forum_display_sort'];
                $forum_display_order    = $row['forum_display_order'];
                /*--FNA #1--*/
                //
                // start forum prune stuff.
                //
                if( $row['prune_enable'] ) {
                    $prune_enabled = "checked=\"checked\"";
                    $sql = "SELECT * FROM " . PRUNE_TABLE . "
                            WHERE forum_id = $forum_id";
                    if(!$pr_result = $db->sql_query($sql)) {
                        message_die(GENERAL_ERROR, "Auto-Prune: Couldn't read auto_prune table.", __LINE__, __FILE__);
                    }
                    $pr_row = $db->sql_fetchrow($pr_result);
                } else {
                    $prune_enabled = FALSE;
                }
            } else {
                $l_title                = $lang['Create_forum'];
                $newmode                = 'createforum';
                $buttonvalue            = $lang['Create_forum'];
                $forumdesc              = '';
                $forumstatus            = FORUM_UNLOCKED;
                $forum_display_sort     = 0;
                $forum_display_order    = 0;
                $forum_id               = '';
                $prune_enabled          = '';
                $main_type              = POST_CAT_URL;
                $prune_enabled          = '';
                $forum_link             = '';
                $forum_link_internal    = 0;
                $forum_link_hit_count   = 0;
                $forum_link_hit         = 0;
                $icon                   = '';
            }
            $catlist = get_tree_option( $main_type . $cat_id, TRUE );
            $forumlocked   = '';
            $forumunlocked = '';
            $forumstatus == ( FORUM_LOCKED ) ? $forumlocked = "selected=\"selected\"" : $forumunlocked = "selected=\"selected\"";
            $statuslist  = "<option value=\"" . FORUM_UNLOCKED . "\" $forumunlocked>" . $lang['Status_unlocked'] . "</option>\n";
            $statuslist .= "<option value=\"" . FORUM_LOCKED . "\" $forumlocked>" . $lang['Status_locked'] . "</option>\n";
            $template->set_filenames(array(
                'body' => 'admin/forum_edit_body.tpl')
            );
            $forum_display_sort_list = get_forum_display_sort_option($forum_display_sort, 'list', 'sort');
            $forum_display_order_list = get_forum_display_sort_option($forum_display_order, 'list', 'order');
            $s_hidden_fields         = '<input type="hidden" name="mode" value="' . $newmode .'" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';
            /*--FNA #2--*/
            $template->assign_vars(array(
                'L_FORUM_DISPLAY_SORT'          => $lang['Sort_by'],
                'S_FORUM_DISPLAY_SORT_LIST'     => $forum_display_sort_list,
                'S_FORUM_DISPLAY_ORDER_LIST'    => $forum_display_order_list,
                'S_FORUM_ACTION'                => admin_sid('admin_forums.php'),
                'S_HIDDEN_FIELDS'               => $s_hidden_fields,
                'S_SUBMIT_VALUE'                => $buttonvalue,
                'S_CAT_LIST'                    => $catlist,
                'S_STATUS_LIST'                 => $statuslist,
                'S_PRUNE_ENABLED'               => $prune_enabled,
                'L_FORUM_TITLE'                 => $l_title,
                'L_FORUM_EXPLAIN'               => $lang['Forum_edit_delete_explain'],
                'L_FORUM_SETTINGS'              => $lang['Forum_settings'],
                'L_FORUM_NAME'                  => $lang['Forum_name'],
                'L_CATEGORY'                    => $lang['Category'],
                'L_FORUM_DESCRIPTION'           => $lang['Forum_desc'],
                'L_FORUM_STATUS'                => $lang['Forum_status'],
                'L_AUTO_PRUNE'                  => $lang['Forum_pruning'],
                'L_ENABLED'                     => $lang['Enabled'],
                'L_PRUNE_DAYS'                  => $lang['prune_days'],
                'L_PRUNE_FREQ'                  => $lang['prune_freq'],
                'L_DAYS'                        => $lang['Days'],
                'PRUNE_DAYS'                    => ( isset($pr_row['prune_days']) ) ? $pr_row['prune_days'] : 7,
                'PRUNE_FREQ'                    => ( isset($pr_row['prune_freq']) ) ? $pr_row['prune_freq'] : 1,
                'L_LINK'                        => $lang['Forum_link'],
                'L_FORUM_LINK'                  => $lang['Forum_link_url'],
                'L_FORUM_LINK_EXPLAIN'          => $lang['Forum_link_url_explain'],
                'FORUM_LINK'                    => $forum_link,
                'L_FORUM_LINK_INTERNAL'         => $lang['Forum_link_internal'],
                'L_FORUM_LINK_INTERNAL_EXPLAIN' => $lang['Forum_link_internal_explain'],
                'FORUM_LINK_INTERNAL_YES'       => ( $forum_link_internal) ? ' checked="checked"' : '',
                'FORUM_LINK_INTERNAL_NO'        => (!$forum_link_internal) ? ' checked="checked"' : '',
                'L_FORUM_LINK_HIT_COUNT'        => $lang['Forum_link_hit_count'],
                'L_FORUM_LINK_HIT_COUNT_EXPLAIN'=> $lang['Forum_link_hit_count_explain'],
                'FORUM_LINK_HIT_COUNT_YES'      => ( $forum_link_hit_count) ? ' checked="checked"' : '',
                'FORUM_LINK_HIT_COUNT_NO'       => (!$forum_link_hit_count) ? ' checked="checked"' : '',
                'L_YES'                         => $lang['Yes'],
                'L_NO'                          => $lang['No'],
                'L_ICON'                        => $lang['icon'],
                'L_ICON_EXPLAIN'                => $lang['icon_explain'],
                'ICON'                          => $icon,
                'ICON_IMG'                      => empty($icon) ? '' : '<br /><img src="' . ( isset($images[$icon]) ? $images[$icon] : $icon ) . '" border="0" alt="' . $icon . '" title="' . $icon . '" />',
                'FORUM_NAME' => $forumname,
                'DESCRIPTION' => $forumdesc)
            );
            $template->pparse('body');
            break;
        case 'createforum':
            //
            // Create a forum in the DB
            //
            if( trim($_GETVAR->get('forumname', 'post', 'string')) == '' ) {
                message_die(GENERAL_ERROR, $lang['Forum_name_missing']);
            }
                  // get ids
            $fid    =  $_GETVAR->get(POST_CAT_URL, 'post', 'string', '');
            $type   = substr($fid, 0, 1);
            $id     = intval(substr($fid, 1));
            if ($fid == 'Root') {
                $id = 0;
                $type = POST_CAT_URL;
                if (!defined('SUB_FORUM_ATTACH')) {
                    message_die(GENERAL_ERROR, $lang['Attach_root_wrong']);
                }
            }
            if ($type != POST_CAT_URL) {
                if (!defined('SUB_FORUM_ATTACH')) {
                    message_die(GENERAL_ERROR, $lang['Attach_forum_wrong']);
                }
                if ($type == POST_FORUM_URL) {
                    $this_var = $tree['keys'][$type . $id];
                    if (!empty($tree['data'][$this_var]['forum_link'])) {
                        message_die(GENERAL_ERROR, $lang['Forum_attached_to_link_denied']);
                    }
                }
            }
            $cat_id = $id;
            // get the last order
            $max_order = 0;
            $last = count($tree['data'])-1;
            if ($last >= 0) {
                $max_order = ($tree['type'][$last] == POST_CAT_URL) ? $tree['data'][$last]['cat_order'] : $tree['data'][$last]['forum_order'];
            }
            $next_order = $max_order + 10;
            $sql = "SELECT MAX(forum_id) AS max_id
                    FROM " . FORUMS_TABLE;
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't get order number from forums table", "", __LINE__, __FILE__, $sql);
            }
            $row = $db->sql_fetchrow($result);
            $max_id = $row['max_id'];
            $next_id = $max_id + 1;
            //
            // Default permissions of public ::
            //
            $field_sql = '';
            $value_sql = '';
            while( list($field, $value) = each($forum_auth_ary) ) {
                $field_sql .= ', '.$field;
                $value_sql .= ', '.$value;
            }
            $field_sql .= ', forum_display_sort';
            $value_sql .= ', ' . $_GETVAR->get('forum_display_sort', 'post', 'int', 0);
            $field_sql .= ', forum_display_order';
            $value_sql .= ', ' . $_GETVAR->get('forum_display_order', 'post', 'int', 0);
            // There is no problem having duplicate forum names so we won't check for it.
            if (defined('SUB_FORUM_ATTACH')) {
                $field_sql .= ', main_type';
                $value_sql .= ", '$type'";
            }
            $forum_link           = trim(stripslashes($_GETVAR->get('forum_link', 'post', 'string', '')));
            $forum_link_internal  = $_GETVAR->get('forum_link_internal', 'post', 'int', 0);
            $forum_link_hit_count = $_GETVAR->get('forum_link_hit_count', 'post', 'int', 0);
            $field_sql .= ", forum_link";
            $value_sql .= ", '$forum_link'";
            $field_sql .= ", forum_link_internal";
            $value_sql .= ", $forum_link_internal";
            $field_sql .= ", forum_link_hit_count";
            $value_sql .= ", $forum_link_hit_count";
            $icon       = trim(stripslashes($_GETVAR->get('icon', 'post', 'string', '')));
            $field_sql .= ", icon";
            $value_sql .= ", '$icon'";
            $sql = "INSERT INTO " . FORUMS_TABLE . " (forum_id, forum_name, cat_id, forum_desc, forum_order, forum_status, prune_enable" . $field_sql . ")
                    VALUES ('" . $next_id . "', '" . $_GETVAR->get('forumname', 'post', 'string', '') . "', $cat_id, '" . $_GETVAR->get('forumdesc', 'post', 'string', '') . "', $next_order, " . $_GETVAR->get('forumstatus', 'post', 'int', 0) . ", " . $_GETVAR->get('prune_enable', 'post', 'int', 0) . $value_sql . ")";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't insert row in forums table", "", __LINE__, __FILE__, $sql);
            }
            admin_check_cat();
            get_user_tree($userdata);
            move_tree('Root', 0, 0);
            if( $_GETVAR->get('prune_enable', 'post', 'int', NULL)) {
                if( !($_GETVAR->get('prune_days', 'post', 'int', NULL)) || !($_GETVAR->get('prune_freq', 'post', 'int', NULL)) ) {
                    message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
                }
                $sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)
                        VALUES('" . $next_id . "', " . $_GETVAR->get('prune_days', 'post', 'int') . ", " . $_GETVAR->get('prune_freq', 'post', 'int') . ")";
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Couldn't insert row in prune table", "", __LINE__, __FILE__, $sql);
                }
            }
            cache_tree(TRUE);
            board_stats();
            $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . admin_sid("admin_forums.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
            break;
        case 'modforum':
            if( trim($_GETVAR->get('forumname', 'post', 'string', '')) == '' ) {
                message_die(GENERAL_ERROR, $lang['Forum_name_missing']);
            }
            $fid    = $_GETVAR->get(POST_CAT_URL, 'post', 'string', '');
            $type   = substr($fid, 0, 1);
            $id     = intval(substr($fid, 1));
            if ($fid == 'Root') {
                $id = 0;
                $type = POST_CAT_URL;
                if (!defined('SUB_FORUM_ATTACH')) {
                    message_die(GENERAL_ERROR, $lang['Attach_root_wrong']);
                }
            }
            if ($type != POST_CAT_URL) {
                if (!defined('SUB_FORUM_ATTACH')) {
                    message_die(GENERAL_ERROR, $lang['Attach_forum_wrong']);
                }
                if ($type == POST_FORUM_URL) {
                    $this_var = $tree['keys'][$type . $id];
                    if (!empty($tree['data'][$this_var]['forum_link'])) {
                        message_die(GENERAL_ERROR, $lang['Forum_attached_to_link_denied']);
                    }
                }
            }
            $cat_id = $id;
            /*--FNA #3--*/
            // Modify a forum in the DB
            if( $_GETVAR->get('prune_enable', 'post', 'int') != 1 ) {
                $temp_prune_enable = 0;
            } else {
                $temp_prune_enable = 1;
            }
            $field_value_sql      = '';
            $forum_link           = trim(stripslashes($_GETVAR->get('forum_link', 'post', 'string', '')));
            $forum_link_internal  = $_GETVAR->get('forum_link_internal', 'post', 'int', 0);
            $forum_link_hit_count = $_GETVAR->get('forum_link_hit_count', 'post', 'int', 0);
            // check if link nothing is attached to the forum
            if (!empty($forum_link)) {
                // forum_id
                $forum_id = $_GETVAR->get('POST_FORUM_URL', 'post', 'int', 0);
                // search in tree if something is attached to
                if (isset($tree['sub'][POST_FORUM_URL . $forum_id])) {
                    message_die(GENERAL_MESSAGE, $lang['Forum_link_with_attachment_deny']);
                }
                // is there some topics attached to ?
                $sql = "SELECT * FROM " . TOPICS_TABLE . " WHERE forum_id=$forum_id";
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Couldn\'t access topics table', '', __LINE__, __FILE__, $sql);
                }
                if ($row = $db->sql_fetchrow($result)) {
                    message_die(GENERAL_MESSAGE, $lang['Forum_link_with_topics_deny']);
                }
            }
            $field_value_sql .= ", forum_link='$forum_link'";
            $field_value_sql .= ", forum_link_internal=$forum_link_internal";
            $field_value_sql .= ", forum_link_hit_count=$forum_link_hit_count";
            if (defined('SUB_FORUM_ATTACH')) {
                $field_value_sql .= ", main_type = '$type'";
            }
            $icon = $_GETVAR->get('icon', 'post', 'string', '');
            $field_value_sql .= ", icon = '$icon'";
            $sql = "UPDATE " . FORUMS_TABLE . "
                    SET forum_name = '" . $_GETVAR->get('forumname', 'post', 'string', '') . "', cat_id = $cat_id, forum_desc = '" . $_GETVAR->get('forumdesc', 'post', 'string', '') . "', forum_status = " . $_GETVAR->get('forumstatus', 'post', 'int', 0) . ", forum_display_order = " . $_GETVAR->get('forum_display_order', 'post', 'int') . ", forum_display_sort = " . $_GETVAR->get('forum_display_sort', 'post', 'int') . ", prune_enable = " . $temp_prune_enable . $field_value_sql . "
                    WHERE forum_id = " . $_GETVAR->get(POST_FORUM_URL, 'post', 'int');
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't update forum information", "", __LINE__, __FILE__, $sql);
            }
            if( $_GETVAR->get('prune_enable', 'post', 'int', NULL) == 1 ) {
                if( !($_GETVAR->get('prune_days', 'post', 'int', NULL)) || !($_GETVAR->get('prune_freq', 'post', 'int', NULL)) ) {
                    message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
                }
                $sql = "SELECT *
                        FROM " . PRUNE_TABLE . "
                        WHERE forum_id = " . $_GETVAR->get(POST_FORUM_URL, 'post', 'int', 0);
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Couldn't get forum Prune Information","",__LINE__, __FILE__, $sql);
                }
                if( $db->sql_numrows($result) > 0 ) {
                    $sql = "UPDATE " . PRUNE_TABLE . "
                            SET prune_days = " . $_GETVAR->get('prune_days', 'post', 'int', 0) . ",        prune_freq = " . $_GETVAR->get('prune_freq', 'post', 'int', 0) . "
                            WHERE forum_id = " . $_GETVAR->get(POST_FORUM_URL, 'post', 'int', 0);
                } else {
                    $sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)
                            VALUES(" . $_GETVAR->get(POST_FORUM_URL, 'post', 'int', 0) . ", " . $_GETVAR->get('prune_days', 'post', 'int', 0) . ", " . $_GETVAR->get('prune_freq', 'post', 'int', 0) . ")";
                }
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Couldn't Update Forum Prune Information","",__LINE__, __FILE__, $sql);
                }
            }
            cache_tree(TRUE);
            board_stats();
            $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . admin_sid("admin_forums.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
            break;
        case 'createcat':
            // Create a category in the DB
            $icon = $_GETVAR->get('icon', 'post', 'string', '');
            if( trim($_GETVAR->get('cat_title', 'post', 'string', '')) == '') {
                message_die(GENERAL_ERROR, $lang['Category_name_missing']);
            }
            $main = $_GETVAR->get('cat_main', 'post', 'string', '');
            if ($main == 'Root') {
                $cat_main_type = POST_CAT_URL;
                $cat_main = 0;
            } else {
                $cat_main_type = substr($main, 0, 1);
                $cat_main = intval(substr($main, 1));
            }
            if ($cat_main_type == POST_FORUM_URL) {
               $this_var = $tree['keys'][$cat_main_type . $cat_main];
                if (!empty($tree['data'][$this_var]['forum_link'])) {
                    message_die(GENERAL_ERROR, $lang['Forum_attached_to_link_denied']);
                }
            }
            // get the last order
            $max_order = 0;
            $last = (isset($tree['data']) ? count($tree['data'])-1 : -1);
            if ($last >= 0)  {
                $max_order = ($tree['type'][$last] == POST_CAT_URL) ? $tree['data'][$last]['cat_order'] : $tree['data'][$last]['forum_order'];
            }
            $next_order = $max_order + 10;
            //
            // There is no problem having duplicate forum names so we won't check for it.
            //
            $sql = "INSERT INTO " . CATEGORIES_TABLE . " (cat_title, cat_main_type, cat_main, cat_desc, icon, cat_order)
                    VALUES ('" . $_GETVAR->get('cat_title', 'post', 'string', '') . "', '" . $cat_main_type . "', " . $cat_main . ", '" . $_GETVAR->get('cat_desc', 'post', 'string', '') . "', '" . str_replace("\'", "''", $icon) . "', $next_order)";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't insert row in categories table", "", __LINE__, __FILE__, $sql);
            }
            admin_check_cat();
            get_user_tree($userdata);
            move_tree('Root', 0, 0);
            cache_tree(TRUE);
            board_stats();
            $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . admin_sid("admin_forums.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
            break;
        case 'addcat':
        case 'editcat':
            //
            // Show form to edit a category
            //
            if ($mode == 'editcat') {
                $l_title        = $lang['Edit_Category'];
                $newmode        = 'modcat';
                $buttonvalue    = $lang['Update'];
                $cat_id         = $_GETVAR->get(POST_CAT_URL, 'request', 'int', 0);
                $row            = get_info('category', $cat_id);
                $cat_title      = htmlspecialchars($row['cat_title']);
                $cat_desc       = $row['cat_desc'];
                $icon           = $row['icon'];
                $cat_main       = $row['cat_main'];
                $cat_main_type  = $row['cat_main_type'];
                if ($cat_main <= 0) {
                    $cat_main       = 0;
                    $cat_main_type  = POST_CAT_URL;
                }
            } else {
                $l_title        = $lang['Create_category'];
                $newmode        = 'createcat';
                $buttonvalue    = $lang['Create_category'];
                $cat_desc       = '';
                $icon           = '';
                $cat_main_type  = POST_CAT_URL;
                if ($cat_main <= 0) {
                    $cat_main   = 0;
                }
            }
            // get the list of cats/forums
            $catlist = get_tree_option($cat_main_type . $cat_main, TRUE);
            $template->set_filenames(array(
                'body' => 'admin/category_edit_body.tpl')
            );
            $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $cat_id . '" />';
            $template->assign_vars(array(
                'CAT_TITLE'             => $cat_title,
                'L_CAT_DESCRIPTION'     => $lang['Category_desc'],
                'CAT_DESCRIPTION'       => $cat_desc,
                'S_CAT_LIST'            => $catlist,
                'L_CATEGORY_ATTACHMENT' => $lang['Category_attachment'],
                'L_EDIT_CATEGORY'       => $l_title,
                'L_ICON'                => $lang['icon'],
                'L_ICON_EXPLAIN'        => $lang['icon_explain'],
                'ICON'                  => $icon,
                'ICON_IMG'              => empty($icon) ? '' : '<br /><img src="' . ( isset($images[$icon]) ? $images[$icon] : $icon ) . '" border="0" alt="' . $icon . '" title="' . $icon . '" />',
                'L_EDIT_CATEGORY_EXPLAIN' => $lang['Edit_Category_explain'],
                'L_CATEGORY'            => $lang['Category'],
                'S_HIDDEN_FIELDS'       => $s_hidden_fields,
                'S_SUBMIT_VALUE'        => $buttonvalue,
                'S_FORUM_ACTION'        => admin_sid('admin_forums.php'))
            );
            $template->pparse("body");
            break;
        case 'modcat':
            // Modify a category in the DB
            $icon = $_GETVAR->get('icon', 'post', 'string', '');
            if( trim($_GETVAR->get('cat_title', 'post', 'string', '')) == '') {
                message_die(GENERAL_ERROR, $lang['Category_name_missing']);
            }
            $main = $_GETVAR->get('cat_main', 'post', 'string', '');
            if ($main == 'Root') {
                $cat_main_type = POST_CAT_URL;
                $cat_main = 0;
            } else {
                $cat_main_type = substr($main, 0, 1);
                $cat_main = intval(substr($main, 1));
            }
            if ($cat_main_type == POST_FORUM_URL) {
                $this_var = $tree['keys'][$cat_main_type . $cat_main];
                if (!empty($tree['data'][$this_var]['forum_link'])) {
                    message_die(GENERAL_ERROR, $lang['Forum_attached_to_link_denied']);
                }
            }
            $sql = "UPDATE " . CATEGORIES_TABLE . "
                    SET cat_title = '" . $_GETVAR->get('cat_title', 'post', 'string', '') . "', cat_main_type='" . $cat_main_type . "', cat_main = " . $cat_main . ", cat_desc = '" . $_GETVAR->get('cat_desc', 'post', 'string', '') . "', icon = '" . str_replace("\'", "''", $icon) . "'
                    WHERE cat_id = " . $_GETVAR->get(POST_CAT_URL, 'post', 'int');
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't update forum information", "", __LINE__, __FILE__, $sql);
            }
            $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . admin_sid("admin_forums.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            cache_tree(TRUE);
            board_stats();
            $err = admin_check_cat();
            if ( $err ) {
                $message = $lang['Category_config_error_fixed'] . "<br /><br />" . $message;
            }
            message_die(GENERAL_MESSAGE, $message);
            break;
        case 'deleteforum':
            // Show form to delete a forum
            $forum_id       = $_GETVAR->get(POST_FORUM_URL, 'request', 'int');
            $select_to      = '<select name="to_id">';
            $select_to     .= "<option value=\"-1\">" . $lang['Delete_all_posts'] . "</option>\n";
            $select_to     .= '<option value=""></option>';
            $select_to     .= get_tree_option('', TRUE); 
            $select_to     .= '</select>';
            $buttonvalue    = $lang['Move_and_Delete'];
            $newmode        = 'movedelforum';
            $this_var       = $tree['keys'][POST_FORUM_URL . $forum_id];
            $name           = $tree['data'][$this_var]['forum_name'];
            $desc           = $tree['data'][$this_var]['forum_desc'];
            $name_trad      = get_object_lang(POST_FORUM_URL . $forum_id, 'name');
            $desc_trad      = get_object_lang(POST_FORUM_URL . $forum_id, 'desc');
            if ($name != $name_trad) {
                $name = '(' . $name . ') ' . $name_trad;
            }
            if ($desc != $desc_trad) {
                $desc = '(' . $desc . ') ' . $desc_trad;
            }
            $template->set_filenames(array(
                'body' => 'admin/forum_delete_body.tpl')
            );
            $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $forum_id . '" />';
            $template->assign_vars(array(
                'NAME'                  => $name,
                'L_FORUM_DELETE'        => $lang['Forum_delete'],
                'L_FORUM_DELETE_EXPLAIN'=> $lang['Forum_delete_explain'],
                'L_MOVE_CONTENTS'       => $lang['Move_contents'],
                'L_FORUM_NAME'          => $lang['Forum_name'],
                'S_HIDDEN_FIELDS'       => $s_hidden_fields,
                'S_FORUM_ACTION'        => admin_sid('admin_forums.php'),
                'S_SELECT_TO'           => $select_to,
                'S_SUBMIT_VALUE'        => $buttonvalue
                )
            );
            $template->assign_vars(array(
                'DESC'                  => $desc,
                'L_FORUM_DESC'          => $lang['Forum_desc'],
                )
            );
            $template->pparse('body');
            break;
        case 'movedelforum':
            //
            // Move or delete a forum in the DB
            //
            $from_id    = $_GETVAR->get('from_id', 'request', 'int', 0);
            $to_fid     = $_GETVAR->get('to_id', 'request', 'string', '');
            if (intval($to_fid) == -1) {
                $to_type = '';
                $to_id = -1;
            } else {
                $to_type  = substr($to_fid, 0, 1);
                $to_id    = intval(substr($to_fid, 1));
                if (($to_type != POST_FORUM_URL) || ($to_fid == 'Root')) {
                    message_die(GENERAL_MESSAGE, $lang['Only_forum_for_topics']);
                }
            }
            // check if sub-levels present
            if (!empty($tree['sub'][POST_FORUM_URL. $from_id])) {
                message_die(GENERAL_MESSAGE, $lang['Delete_forum_with_attachment_denied']);
            }
            $delete_old = $_GETVAR->get('delete_old', 'post', 'int', 0);
            // Either delete or move all posts in a forum
            if($to_id == -1) {
                // Delete polls in this forum
                $sql = "SELECT v.vote_id
                        FROM (" . VOTE_DESC_TABLE . " v, " . TOPICS_TABLE . " t)
                        WHERE t.forum_id = $from_id
                        AND v.topic_id = t.topic_id";
                if (!($result = $db->sql_query($sql))) {
                    message_die(GENERAL_ERROR, "Couldn't obtain list of vote ids", "", __LINE__, __FILE__, $sql);
                }
                if ($row = $db->sql_fetchrow($result)) {
                    $vote_ids = '';
                    do {
                       $vote_ids .= (($vote_ids != '') ? ', ' : '') . $row['vote_id'];
                    } while ($row = $db->sql_fetchrow($result));
                    $sql = "DELETE FROM " . VOTE_DESC_TABLE . "
                            WHERE vote_id IN ($vote_ids)";
                    $db->sql_query($sql);
                    $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . "
                            WHERE vote_id IN ($vote_ids)";
                    $db->sql_query($sql);
                    $sql = "DELETE FROM " . VOTE_USERS_TABLE . "
                            WHERE vote_id IN ($vote_ids)";
                    $db->sql_query($sql);
                }
                $db->sql_freeresult($result);
                include_once(NUKE_INCLUDE_DIR . 'prune.php');
                prune($from_id, 0, TRUE); // Delete everything from forum
            } else {
                $sql = "SELECT *
                        FROM " . FORUMS_TABLE . "
                        WHERE forum_id IN ($from_id, $to_id)";
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Couldn't verify existence of forums", "", __LINE__, __FILE__, $sql);
                }
                if($db->sql_numrows($result) != 2) {
                    message_die(GENERAL_ERROR, "Ambiguous forum ID's", "", __LINE__, __FILE__);
                }
                $sql = "UPDATE " . TOPICS_TABLE . "
                        SET forum_id = $to_id
                        WHERE forum_id = $from_id";
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Couldn't move topics to other forum", "", __LINE__, __FILE__, $sql);
                }
                $sql = "UPDATE " . POSTS_TABLE . "
                        SET        forum_id = $to_id
                        WHERE forum_id = $from_id";
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Couldn't move posts to other forum", "", __LINE__, __FILE__, $sql);
                }
                sync('forum', $to_id);
            }
            // Alter Mod level if appropriate - 2.0.4
            $sql = "SELECT ug.user_id
                    FROM (" . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug)
                    WHERE a.forum_id <> $from_id
                    AND a.auth_mod = 1
                    AND ug.group_id = a.group_id";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't obtain moderator list", "", __LINE__, __FILE__, $sql);
            }
            if ($row = $db->sql_fetchrow($result)) {
                $user_ids = '';
                do {
                    $user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];
                } while ($row = $db->sql_fetchrow($result));
                $sql = "SELECT ug.user_id
                        FROM (" . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug)
                        WHERE a.forum_id = $from_id
                        AND a.auth_mod = 1
                        AND ug.group_id = a.group_id
                        AND ug.user_id NOT IN ($user_ids)";
                if( !$result2 = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Couldn't obtain moderator list", "", __LINE__, __FILE__, $sql);
                }
                if ($row = $db->sql_fetchrow($result2)) {
                    $user_ids = '';
                    do {
                       $user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];
                    } while ($row = $db->sql_fetchrow($result2));
                    $sql = "UPDATE " . USERS_TABLE . "
                            SET user_level = " . USER . "
                            WHERE user_id IN ($user_ids)
                            AND user_level <> " . ADMIN;
                    $db->sql_query($sql);
                    }
                    $db->sql_freeresult($result);
            }
            $db->sql_freeresult($result2);
            $sql = "DELETE FROM " . FORUMS_TABLE . "
                    WHERE forum_id = $from_id";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't delete forum", "", __LINE__, __FILE__, $sql);
            }
            $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                    WHERE forum_id = $from_id";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't delete forum", "", __LINE__, __FILE__, $sql);
            }
            $sql = "DELETE FROM " . PRUNE_TABLE . "
                    WHERE forum_id = $from_id";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't delete forum prune information!", "", __LINE__, __FILE__, $sql);
            }
            cache_tree(TRUE);
            board_stats();
            $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . admin_sid("admin_forums.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
            break;
        case 'deletecat':
            //
            // Show form to delete a category
            //
            $cat_id         = $_GETVAR->get(POST_CAT_URL, 'request', 'int', 0);
            $from_id        = $_GETVAR->get('from_id', 'request', 'int', 0);
            $buttonvalue    = $lang['Move_and_Delete'];
            $newmode        = 'movedelcat';
            $this_var       = $tree['keys'][POST_CAT_URL . $cat_id];
            $name           = $tree['data'][$this_var]['cat_title'];
            $desc           = $tree['data'][$this_var]['cat_desc'];
            $name_trad      = get_object_lang(POST_CAT_URL . $cat_id, 'name');
            $desc_trad      = get_object_lang(POST_CAT_URL . $cat_id, 'desc');
            if ($name != $name_trad) {
                $name = '(' . $name . ') ' . $name_trad;
            }
            if ($desc != $desc_trad) {
                $desc = '(' . $desc . ') ' . $desc_trad;
            }
            // chek main category deletation
            if ($tree['main'][$this_var] == 'Root') {
                // check if other main categories
                $found = FALSE;
                for ($i=0; (($i < count($tree['data'])) && !$found); $i++) {
                    $found = (($i != $this_var) && ($tree['main'][$i] == 'Root'));
                }
                // no other main cats : check if forums presents
                if (!$found) {
                    $found = FALSE;
                    $cat_found = (isset($tree['sub'][POST_CAT_URL . $from_id]) ? count($tree['sub'][POST_CAT_URL . $from_id]) : 0);
                    for ($i=0; $i < $cat_found; $i++) {
                        $found = ($tree['type'][$tree['keys'][$tree['sub'][POST_CAT_URL . $cat_id][$i]]] == POST_FORUM_URL);
                    }
                    unset($cat_found);
                    if ($found) {
                        message_die(GENERAL_ERROR, $lang['Must_delete_forums']);
                    }
                }
            }
            // get cat list
            $s_cat_list = get_tree_option('', TRUE);
            $select_to = '<select name="to_id">' . $s_cat_list . '</select>';
            $template->set_filenames(array(
                'body' => 'admin/forum_delete_body.tpl')
            );
            $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $cat_id . '" />';
            $template->assign_vars(array(
                'NAME'                  => $name,
                'L_FORUM_DELETE'        => $lang['Category_delete'],
                'L_FORUM_DELETE_EXPLAIN'=> $lang['Category_delete_explain'],
                'L_MOVE_CONTENTS'       => $lang['Move_contents'],
                'L_FORUM_NAME'          => $lang['Category'],
                'S_HIDDEN_FIELDS'       => $s_hidden_fields,
                'S_FORUM_ACTION'        => admin_sid('admin_forums.php'),
                'S_SELECT_TO'           => $select_to,
                'S_SUBMIT_VALUE'        => $buttonvalue)
            );
            $template->assign_vars(array(
                'L_FORUM_DESC'          => $lang['Category_desc'],
                'DESC'                  => $desc,
                )
            );
            $template->pparse('body');
            break;
        case 'movedelcat':
            //
            // Move or delete a category in the DB
            //
            $from_id  = $_GETVAR->get('from_id', 'request', 'int', NULL);
            $to_fid   = $_GETVAR->get('to_id', 'request', 'string', '');
            $to_type  = substr($to_fid, 0, 1);
            $to_id    = intval(substr($to_fid, 1));
            if (!empty($to_id)) {
                $sql = "SELECT *
                        FROM " . CATEGORIES_TABLE . "
                        WHERE cat_id IN ($from_id, $to_id)";
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Couldn't verify existence of categories", "", __LINE__, __FILE__, $sql);
                }
                if($db->sql_numrows($result) != 2) {
                    message_die(GENERAL_ERROR, "Ambiguous category ID's", "", __LINE__, __FILE__);
                }
                // check that there is no forum attached to the from cat (will issue to forum attached to forums)
                if (($to_type == POST_FORUM_URL) && !defined('SUB_FORUM_ATTACH')) {
                    $found = FALSE;
                    for ($i=0; $i < count($tree['sub'][POST_CAT_URL . $from_id]); $i++) {
                        $found = ($tree['type'][$tree['keys'][$tree['sub'][POST_CAT_URL . $from_id][$i]]] == POST_FORUM_URL);
                    }
                    if ($found) {
                        message_die(GENERAL_ERROR, $lang['Must_delete_forums']);
                    }
                }
                $sql_feed = '';
                $sql_where = '';
                if (defined('SUB_FORUM_ATTACH')) {
                    $sql_feed = ", main_type='$to_type'";
                    $sql_where = " AND main_type='" . POST_CAT_URL . "'";
                }
                $sql = "UPDATE " . FORUMS_TABLE . "
                        SET cat_id = $to_id" . $sql_feed . "
                        WHERE cat_id = $from_id" . $sql_where;
                if( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, "Couldn't move forums to other category", "", __LINE__, __FILE__, $sql);
                }
            }
            $sql = "DELETE FROM " . CATEGORIES_TABLE ."
                    WHERE cat_id = $from_id";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't delete category", "", __LINE__, __FILE__, $sql);
            }
            $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . admin_sid("admin_forums.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            cache_tree(TRUE);
            board_stats();
            $err = admin_check_cat();
            if ( $err ) {
                $message = $lang['Category_config_error_fixed'] . "<br /><br />" . $message;
            }
            message_die(GENERAL_MESSAGE, $message);
            break;
        case 'forum_order':
            //
            // Change order of forums in the DB
            //
            $move       = $_GETVAR->get('move', 'GET', 'int', 0);
            $forum_id   = $_GETVAR->get(POST_FORUM_URL, 'GET', 'int', 0);
            // update the level order
            move_tree(POST_FORUM_URL, $forum_id, $move);
            cache_tree(TRUE);
            board_stats();
            $show_index = TRUE;
            break;
        case 'cat_order':
            //
            // Change order of categories in the DB
            //
            $move       = $_GETVAR->get('move', 'GET', 'int', 0);
            $cat_id     = $_GETVAR->get(POST_CAT_URL, 'GET', 'int', 0);
            // update the level order
            move_tree(POST_CAT_URL, $cat_id, $move);
            // get ids
            $main       = $tree['main'][ $tree['keys'][POST_CAT_URL . $cat_id] ];
            $cat_id     = $tree['id'][ $tree['keys'][$main] ];
            cache_tree(TRUE);
            board_stats();
            $show_index = TRUE;
            break;
        case 'forum_sync':
            sync('forum', $_GETVAR->get(POST_FORUM_URL, 'GET', 'int', 0));
            $show_index = TRUE;
            break;
        default:
            message_die(GENERAL_MESSAGE, $lang['No_mode']);
            break;
    }
    if ($show_index != TRUE) {
        include(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');
        exit;
    }
}

//
// Start page proper
//
$template->set_filenames(array(
    'body' => 'admin/forum_admin_body.tpl')
);

$template->assign_vars(array(
    'L_ACTION'          => $lang['Action'],
    'S_FORUM_ACTION'    => admin_sid('admin_forums.php'),
    'L_FORUM_TITLE'     => $lang['Forum_admin'],
    'L_FORUM_EXPLAIN'   => $lang['Forum_admin_explain'],
    'L_CREATE_FORUM'    => $lang['Create_forum'],
    'L_CREATE_CATEGORY' => $lang['Create_category'],
    'L_EDIT'            => $lang['Edit'],
    'L_DELETE'          => $lang['Delete'],
    'L_MOVE_UP'         => $lang['Move_up'],
    'L_MOVE_DOWN'       => $lang['Move_down'],
    'L_RESYNC'          => $lang['Resync'])
);

function display_admin_index($cur='Root', $level=0, $max_level=-1) {
    global $template, $lang, $images, $tree;

    // display the level
    $this_var = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;
    // root level
    if ($max_level==-1) {
        // get max inc level
        $keys      = array();
        $max_level = get_max_depth($cur, TRUE, -1, $keys);
        if ($cur != 'Root') {
            $max_level++;
        }
        $template->assign_vars(array(
            'INC_SPAN'      => ($max_level+3),
            'INC_SPAN_ALL'  => ($max_level+7),
            )
        );
    }
    // if forum index, omit one level
    if ($cur == 'Root') {
        $level=-1;
    }
    // sub-levels
    if ($this_var >= -1) {
        // cat header row
        if ((isset($tree['type'][$this_var])) && ($tree['type'][$this_var] == POST_CAT_URL) ) {
            // display a cat row
            $cat = $tree['data'][$this_var];
            $cat_id = $tree['id'][$this_var];
            // get the class colors
            $class_catLeft   = "cat";
            $class_catMiddle = "cat";
            $class_catRight  = "cat";
            $cat_title = $cat['cat_title'];
            $cat_title_trad = get_object_lang(POST_CAT_URL . $cat_id, 'name');
            if ($cat_title != $cat_title_trad) {
                $cat_title = '(' . $cat_title . ') ' . $cat_title_trad;
            }
            // title and icon
            $cat_desc = $cat['cat_desc'];
            $cat_desc_trad = get_object_lang(POST_CAT_URL . $cat_id, 'desc');
            if ($cat_desc != $cat_desc_trad) {
                $cat_desc = '(' . $cat_desc . ') ' . $cat_desc_trad;
            }
            $cat_icon = empty($cat['icon']) ? '<img src="' . evo_image('spacer.gif', 'evo').'" border="0" alt="" title="" />' : '<img src="' . ( isset($images[ $cat['icon'] ]) ? $images[ $cat['icon'] ] : $cat['icon'] ) . '" border="0" alt="' . $cat['icon'] . '" title="' . $cat['icon'] . '" />';
            // send to template
            $template->assign_block_vars('catrow', array());
            $template->assign_block_vars('catrow.cathead', array(
                'CAT_ID'            => $cat_id,
                'CAT_TITLE'         => $cat_title,
                'CAT_DESCRIPTION'   => $cat_desc,
                'ICON_IMG'          => $cat_icon,
                'CLASS_CATLEFT'     => $class_catLeft,
                'CLASS_CATMIDDLE'   => $class_catMiddle,
                'CLASS_CATRIGHT'    => $class_catRight,
                'INC_SPAN'          => $max_level - $level+3,
                'WIDTH'             => ($max_level == $level) ? 'width="50%"' : '',
                'U_CAT_EDIT'        => admin_sid('admin_forums.php&amp;mode=editcat&amp;' . POST_CAT_URL . '=' . $cat_id),
                'U_CAT_DELETE'      => admin_sid('admin_forums.php&amp;mode=deletecat&amp;' . POST_CAT_URL . '=' . $cat_id),
                'U_CAT_MOVE_UP'     => admin_sid('admin_forums.php&amp;mode=cat_order&amp;move=-15&amp;' . POST_CAT_URL . '=' . $cat_id),
                'U_CAT_MOVE_DOWN'   => admin_sid('admin_forums.php&amp;mode=cat_order&amp;move=15&amp;' . POST_CAT_URL . '=' . $cat_id),
                'U_VIEWCAT'         => admin_sid('admin_forums.php&amp;' . POST_CAT_URL . '=' . $cat_id))
            );
            // add indentation to the display
            for ($k=1; $k <= $level; $k++) {
                $template->assign_block_vars('catrow.cathead.inc', array());
            }
        }
        // forum header row
        if ((isset($tree['type'][$this_var])) && ($tree['type'][$this_var] == POST_FORUM_URL)) {
            $forum = $tree['data'][$this_var];
            $forum_id = $tree['id'][$this_var];
            $forum_link_img = '';
            if (!empty($tree['data'][$this_var]['forum_link'])) {
                $forum_link_img = '<img src="' . $images['link'] . '" border="0" />';
            } else {
                $sub = (isset($tree['sub'][POST_FORUM_URL . $forum_id]));
                $forum_link_img = '<img src="' . (($sub) ? $images['category'] : $images['forum']) . '" border="0" />';
                if ($tree['data'][$this_var]['forum_status'] == FORUM_LOCKED) {
                    $forum_link_img = '<img src="' . (($sub) ? $images['category_locked'] : $images['forum_locked']) . '" border="0" />';
                }
            }
            $forum_name = $forum['forum_name'];
            $forum_name_trad = get_object_lang(POST_FORUM_URL . $forum_id, 'name');
            if ($forum_name != $forum_name_trad) {
                $forum_name = '(' . $forum_name . ') ' . $forum_name_trad;
            }
            $forum_desc = $forum['forum_desc'];
            $forum_desc_trad = get_object_lang(POST_FORUM_URL . $forum_id, 'desc');
            if ($forum_desc != $forum_desc_trad) {
                $forum_desc = '(' . $forum_desc . ') ' . $forum_desc_trad;
            }
            $template->assign_block_vars('catrow', array());
            $template->assign_block_vars('catrow.forumrow', array(
                'LINK_IMG'          => $forum_link_img,
                'ICON_IMG'          => empty($forum['icon']) ? '' : '<img src="' . ( isset($images[ $forum['icon'] ]) ? $images[ $forum['icon'] ] : $forum['icon'] ) . '" border="0" alt="' . $forum['icon'] . '" title="' . $forum['icon'] . '" />',
                'FORUM_NAME'        => $forum_name,
                'FORUM_DESC'        => $forum_desc,
                'NUM_TOPICS'        => $forum['forum_topics'],
                'NUM_POSTS'         => $forum['forum_posts'],
                'INC_SPAN'          => $max_level - $level+1,
                'WIDTH'             => ($max_level == $level) ? 'width="50%"' : '',
                'U_VIEWFORUM'       => admin_sid('admin_forums.php&amp;' . POST_FORUM_URL . '=' . $forum_id),
                'U_FORUM_EDIT'      => admin_sid('admin_forums.php&amp;mode=editforum&amp;' . POST_FORUM_URL . '=' . $forum_id),
                'U_FORUM_DELETE'    => admin_sid('admin_forums.php&amp;mode=deleteforum&amp;' . POST_FORUM_URL . '=' . $forum_id),
                'U_FORUM_MOVE_UP'   => admin_sid('admin_forums.php&amp;mode=forum_order&amp;move=-15&amp;' . POST_FORUM_URL . '=' . $forum_id),
                'U_FORUM_MOVE_DOWN' => admin_sid('admin_forums.php&amp;mode=forum_order&amp;move=15&amp;' . POST_FORUM_URL . '=' . $forum_id),
                'U_FORUM_RESYNC'    => admin_sid('admin_forums.php&amp;mode=forum_sync&amp;' . POST_FORUM_URL . '=' . $forum_id))
            );
            // add indentation to the display
            for ($k=1; $k <= $level; $k++) {
                $template->assign_block_vars('catrow.forumrow.inc', array());
            }
        }
        // display the sub-level
        $counted_sublevels = (isset($tree['sub'][$cur]) ? count($tree['sub'][$cur]): 0);
        for ($i=0; $i < $counted_sublevels; $i++) {
            display_admin_index($tree['sub'][$cur][$i], $level+1, $max_level);
        }
        // forum footer
        // cat footer
        if (isset($tree['type'][$this_var]) && ($tree['type'][$this_var] == POST_CAT_URL) ) {
            // add the footer
            $template->assign_block_vars('catrow', array());
            $template->assign_block_vars('catrow.catfoot', array(
                'S_ADD_FORUM_SUBMIT'=> 'addforum['.$cat_id.']',
                'S_ADD_CAT_SUBMIT'  => 'addcategory['.$cat_id.']',
                'S_ADD_NAME'        => 'name['.$cat_id.']',
                'INC_SPAN'          => $max_level - $level+3,
                'INC_SPAN_ALL'      => $max_level - $level+7,
                )
            );
            // add indentation to the display
            for ($k=1; $k <= $level; $k++) {
                $template->assign_block_vars('catrow.catfoot.inc', array());
            }
        }
        // board index footer
        if ($cur == 'Root') {
            $template->assign_block_vars('switch_board_footer', array());
            if (defined('SUB_FORUM_ATTACH')) {
                $template->assign_block_vars('switch_board_footer.sub_forum_attach', array());
            }
        }
    }
}

// fix the cat_main value
admin_check_cat();
// read the cats/forums tree
get_user_tree($userdata);
// get the values of level selected
$main = 'Root';
if (!empty($cat_id)) {
    $main = POST_CAT_URL . $cat_id;
} else if (!empty($forum_id)) {
    $main = $tree['main'][$forum_id];
    $main = $tree['main'][ $tree['keys'][POST_FORUM_URL . $forum_id] ];
}
if (!isset($tree['keys'][$main])) {
    $main = 'Root';
}
// get the nav cat sentence
$nav_cat_desc = make_cat_nav_tree($main, 'admin_forums');
if ($nav_cat_desc != '') {
    $nav_cat_desc = $nav_separator . $nav_cat_desc;
}
$template->assign_vars(array(
    'SPACER'        => NUKE_FORUMS_DIR . $images['spacer'],
    'NAV_CAT_DESC'  => $nav_cat_desc,
    'L_INDEX'       => sprintf($lang['Forum_Index'], $board_config['sitename']),
    )
);
// display the tree
display_admin_index($main);
$template->pparse('body');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>