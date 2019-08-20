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
        $module['Forums']['Manage_extend'] = $filename;
        return;
    }
}

global $_GETVAR;
$selected_id = $_GETVAR->get('selected_id', '_REQUEST', 'string');

include_once(NUKE_INCLUDE_DIR . 'functions_admin.php');

//--------------------------------
//
//  constants
//
//--------------------------------
define('POST_FLINK_URL', 'l');

// auth list : put in this file all the auth fields description
include_once( NUKE_FORUMS_DIR . 'cat_mod/includes/def_auth.php');

// fields presents in forums table, except auths ones :
//    table_field => form_field
$forums_fields_list = array(
    'forum_id'              => 'id',
    'cat_id'                => 'main_id',
    'forum_name'            => 'name',
    'forum_desc'            => 'desc',
    'forum_status'          => 'status',
    'forum_order'           => 'order',
    'forum_posts'           => 'forum_posts',
    'forum_topics'          => 'forum_topics',
    'forum_last_post_id'    => 'forum_last_post_id',
    'prune_next'            => 'prune_next',
    'prune_enable'          => 'prune_enable',
    'forum_display_sort'    => 'forum_display_sort',
    'forum_display_order'   => 'forum_display_order',
    'forum_link'            => 'link',
    'forum_link_internal'   => 'link_internal',
    'forum_link_hit_count'  => 'link_hit_count',
    'forum_link_hit'        => 'link_hit',
    'icon'                  => 'icon',
    'main_type'             => 'main_type'
);

// fields presents in categories table :
//    table_field => form_field
$categories_fields_list = array(
    'cat_id'                => 'id',
    'cat_title'             => 'name',
    'cat_order'             => 'order',
    'cat_main_type'         => 'main_type',
    'cat_main'              => 'main_id',
    'cat_desc'              => 'desc',
    'icon'                  => 'icon'
);

// type of the form fields
$fields_type = array(
    'type'                  => 'VARCHAR',
    'id'                    => 'INTEGER',
    'main_type'             => 'VARCHAR',
    'main_id'               => 'INTEGER',
    'order'                 => 'INTEGER',
    'name'                  => 'VARCHAR',
    'desc'                  => 'HTML',
    'icon'                  => 'HTML',
    'status'                => 'INTEGER',
    'prune_enable'          => 'INTEGER',
    'link'                  => 'HTML',
    'link_internal'         => 'INTEGER',
    'link_hit_count'        => 'INTEGER',
    'link_hit'              => 'INTEGER',
    'forum_posts'           => 'INTEGER',
    'forum_topics'          => 'INTEGER',
    'forum_last_post_id'    => 'INTEGER',
    'prune_next'            => 'INTEGER'
);



// list for pull down menu and check of values :
//    value => lang key entry
$forum_type_list = array(
    POST_CAT_URL            => 'Category',
    POST_FORUM_URL          => 'Forum',
    POST_FLINK_URL          => 'Forum_link'
);

// forum status
//    value => lang key entry
$forum_status_list = array(
    FORUM_UNLOCKED          => 'Status_unlocked',
    FORUM_LOCKED            => 'Status_locked'
);

// check the presence of the field allowing to attach forums to forums
$sql = "SELECT main_type FROM " . FORUMS_TABLE . " LIMIT 0, 1";
if ( $db->sql_query($sql) ) {
    define('SUB_FORUM_ATTACH', TRUE);
}

// some compliancy
$sql = "SELECT forum_display_sort, forum_display_order FROM " . FORUMS_TABLE . " LIMIT 0, 1";
if ( $db->sql_query($sql) && function_exists('get_forum_display_sort_option') ) {
    define('TOPIC_DISPLAY_ORDER', TRUE);
    $forums_fields_list['forum_display_sort'] = 'display_sort';
    $forums_fields_list['forum_display_order'] = 'display_order';
    $fields_type['display_sort'] = 'INTEGER';
    $fields_type['display_order'] = 'INTEGER';
}

// prune functions
include_once( NUKE_INCLUDE_DIR . 'prune.php');

// return message after update
$return_msg = '<br /><br />' . sprintf($lang['Click_return_forumadmin'], '<a href="' . admin_sid("admin_forums_extend.php&amp;selected_id=$selected_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . admin_sid("index.php&amp;pane=right") . '">', '</a>');

//--------------------------------
//
//  functions
//
//--------------------------------
function admin_add_error( $msg ) {
    global $error, $error_msg, $lang;
    $error = TRUE;
    $error_msg .= ( empty($error_msg) ? '<br />' : '<br /><br />' ) . ( isset($lang[$msg]) ? $lang[$msg] : $msg );
}

function admin_get_nav_cat_desc($cur='') {
    global $nav_separator;
    $nav_cat_desc = make_cat_nav_tree($cur, 'admin_forums_extend');
    if ( !empty($nav_cat_desc) ) {
        $nav_cat_desc = $nav_separator . $nav_cat_desc;
    }
    return $nav_cat_desc;
}

function delete_item( $old, $new='', $topic_dest='' ) {
    global $db;
    // no changes
    if ( $old == $new ) {
        return;
    }
    // old type and id
    $old_type = substr($old, 0, 1);
    $old_id = intval(substr($old, 1));
    // new type and id
    $new_type = substr($new, 0, 1);
    $new_id = intval( substr($new, 1) );
    if ( ($new_id == 0) || !in_array($new_type, array(POST_FORUM_URL, POST_CAT_URL)) ) {
        $new_type = POST_CAT_URL;
        $new_id = 0;
    }
    // topic dest
    $dst_type = substr($topic_dest, 0, 1);
    $dst_id = intval(substr($topic_dest, 1));
    if ( ($dst_id == 0) || ($dst_type != POST_FORUM_URL) ) {
        $topic_dest = '';
    }
    // re-attach all the content to the new id
    if ( !empty($new) ) {
        // forums
        if ( defined('SUB_FORUM_ATTACH') ) {
            $sql = "UPDATE " . FORUMS_TABLE . "
                    SET main_type = '$new_type', cat_id = $new_id
                    WHERE main_type = '$old_type' AND cat_id = $old_id";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t update forum attachement', '', __LINE__, __FILE__, $sql);
            }
        } else if ( $old_type == POST_CAT_URL ) {
        // if old type was a forum, it can't have sub-forums attached wthout the parent type field
            if ( ($new_type == POST_CAT_URL) && ($new_id != 0) )  {
                $sql = "UPDATE " . FORUMS_TABLE . "
                        SET cat_id = $new_id
                        WHERE cat_id = $old_id";
                if ( !$db->sql_query($sql) )  {
                    message_die(GENERAL_ERROR, 'Couldn\'t update forum attachement', '', __LINE__, __FILE__, $sql);
                }
            } else if ( ($new_type == POST_FORUM_URL) || ($new_id == 0) ) {
                // check if forum attached
                $sql = "SELECT * FROM " . FORUMS_TABLE . " WHERE cat_id = $old_id LIMIT 0, 1";
                if ( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Couldn\'t read forums attachement', '', __LINE__, __FILE__, $sql);
                }
                if ( $row = $db->sql_fetchrow($result) ) {
                    message_die(GENERAL_ERROR, 'Attempt to attach a forum to root index or to a forum');
                }
            }
        }
        // categories
        $sql = "UPDATE " . CATEGORIES_TABLE . "
                SET cat_main_type = '$new_type', cat_main = $new_id
                WHERE cat_main_type = '$old_type' AND cat_main = $old_id";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t update categories attachement', '', __LINE__, __FILE__, $sql);
        }
    }

    // topics move
    if ( !empty($topic_dest) && ($dst_type == POST_FORUM_URL) ) {
        if ( ($dst_type == POST_FORUM_URL) && ($old_type == POST_FORUM_URL) ) {
            // topics
            $sql = "UPDATE " . TOPICS_TABLE . " SET forum_id = $dst_id WHERE forum_id = $old_id";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t move topics to other forum', '', __LINE__, __FILE__, $sql);
            }

            // posts
            $sql = "UPDATE " . POSTS_TABLE . " SET forum_id = $dst_id WHERE forum_id = $old_id";
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, "Couldn't move posts to other forum", "", __LINE__, __FILE__, $sql);
            }
            sync('forum', $dst_id);
        }
    }

    // all what is attached to a forum
    if ( $old_type == POST_FORUM_URL ) {
        // read current moderators for the old forum
        $sql = "SELECT ug.user_id FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug
                WHERE a.forum_id = $old_id
                AND a.auth_mod = 1
                AND ug.group_id = a.group_id";
        if( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t obtain moderator list', '', __LINE__, __FILE__, $sql);
        }
        $user_ids = array();
        while ( $row = $db->sql_fetchrow($result) ) {
            $user_ids[] = $row['user_id'];
        }

        // remove moderator status for those ones
        if ( !empty($user_ids) ) {
            $old_moderators = implode(', ', $user_ids);

            // check which ones remain moderators
            $sql = "SELECT ug.user_id FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug
                    WHERE a.forum_id <> $old_id
                    AND a.auth_mod = 1
                    AND ug.group_id = a.group_id
                    AND ug.user_id IN ($old_moderators)";
            if( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t obtain moderator list', '', __LINE__, __FILE__, $sql);
            }
            $user_ids = array();
            while ( $row = $db->sql_fetchrow($result) ) {
                $user_ids[] = $row['user_id'];
            }
            $new_moderators = empty($user_ids) ? '' : implode(', ', $user_ids);
            // update users status
            $sql = "UPDATE " . USERS_TABLE . "
                    SET user_level = " . USER . "
                    WHERE user_id IN ($old_moderators)
                    AND user_level <> " . ADMIN;
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t update users mod level', '', __LINE__, __FILE__, $sql);
            }
            if ( !empty($new_moderators) ) {
                $sql = "UPDATE " . USERS_TABLE . "
                        SET user_level = " . MOD . "
                        WHERE user_id IN ($new_moderators)
                        AND user_level <> " . ADMIN;
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Couldn\'t update users mod level', '', __LINE__, __FILE__, $sql);
                }
            }
        }

        // remove auth for the old forum
        $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . " WHERE forum_id = $old_id";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t remove from auth table', '', __LINE__, __FILE__, $sql);
        }

        // prune table
        $sql = "DELETE FROM " . PRUNE_TABLE . " WHERE forum_id = $old_id";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t remove from prune table old forum type', '', __LINE__, __FILE__, $sql);
        }

        // polls
        $sql = "SELECT v.vote_id FROM " . VOTE_DESC_TABLE . " v, " . TOPICS_TABLE . " t
                WHERE t.forum_id = $old_id
                AND v.topic_id = t.topic_id";
        if ( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t obtain list of vote ids', '', __LINE__, __FILE__, $sql);
        }
        $vote_ids = array();
        while ( $row = $db->sql_fetchrow($result) ) {
            $vote_ids[] = $row['vote_id'];
        }
        $s_vote_ids = empty($vote_ids) ? '' : implode(', ', $vote_ids);
        if ( !empty($s_vote_ids) ) {
            $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . " WHERE vote_id IN ($s_vote_ids)";
            if ( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t remove from vote results table', '', __LINE__, __FILE__, $sql);
            }
            $sql = "DELETE FROM " . VOTE_USERS_TABLE . " WHERE vote_id IN ($s_vote_ids)";
            if ( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t remove from vote results table', '', __LINE__, __FILE__, $sql);
            }
            $sql = "DELETE FROM " . VOTE_DESC_TABLE . " WHERE vote_id IN ($s_vote_ids)";
            if ( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t remove from vote desc table', '', __LINE__, __FILE__, $sql);
            }
        }

        // topics
        prune($old_id, 0, TRUE); // Delete everything from forum
    }

    // delete the old one
    if ( $old_type == POST_FORUM_URL ) {
        $sql = "DELETE FROM " . FORUMS_TABLE . " WHERE forum_id = $old_id";
    } else {
        $sql = "DELETE FROM " . CATEGORIES_TABLE . " WHERE cat_id = $old_id";
    }
    if ( !$db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Couldn\'t delete old forum/category', '', __LINE__, __FILE__, $sql);
    }
}

function reorder_tree() {
    global $tree, $db;

    // read the tree
    read_tree(TRUE);

    // update with new order
    $order = 0;
    for ($i = 0; $i < count($tree['data']); $i++ ) {
        if ( !empty($tree['id'][$i]) ) {
            $order += 10;
            if ( $tree['type'][$i] == POST_FORUM_URL ) {
                $sql = "UPDATE " . FORUMS_TABLE . "
                        SET forum_order = $order
                        WHERE forum_id = " . intval($tree['id'][$i]);
            } else {
                $sql = "UPDATE " . CATEGORIES_TABLE . "
                        SET cat_order = $order
                        WHERE cat_id = " . intval($tree['id'][$i]);
            }
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t reorder forums/categories table', '', __LINE__, __FILE__, $sql);
            }
        }
    }

    // re-read the tree
    cache_tree(TRUE);
    board_stats();
}

//--------------------------------
//
//  get parms
//
//--------------------------------
// mode
$mode = $_GETVAR->get('mode', 'request', 'string', NULL);
if ( !empty($mode) && !in_array( $mode, array('edit', 'create', 'delete', 'moveup', 'movedw', 'resync') ) ) {
    $mode = '';
}

// selected id : current displayed id
$type = substr($selected_id, 0, 1);
$id = intval(substr($selected_id, 1) );
switch ($type) {
    case POST_FORUM_URL:
        $type = POST_FORUM_URL;
        break;
    case POST_CAT_URL:
    default:
        $type = POST_CAT_URL;
}
$selected_id = $type . $id;
// check if the selected id is a valid one
if ( !isset($tree['keys'][$selected_id]) ) {
    $selected_id = 'Root';
}

// work id
$fid    = $_GETVAR->get('fid', 'request', 'string', '');
$type   = substr($fid, 0, 1);
$id     = intval( substr($fid, 1) );
$fid    = $type . $id;

// check buttons
$edit_forum   = $_GETVAR->get('edit', 'post', 'string', NULL);
$create_forum = $_GETVAR->get('create', 'post', 'string', NULL);
$delete_forum = $_GETVAR->get('delete', 'post', 'string', NULL);
$resync_forum = $_GETVAR->get('resync', 'post', 'string', NULL);
$submit       = $_GETVAR->get('update', 'post', 'string', NULL);
$cancel       = $_GETVAR->get('cancel', 'post', 'string', NULL);

if ( $edit_forum || $delete_forum || $resync_forum ) {
    $fid = $selected_id;
}

// check when the fid is required if it is a valid one
if ( !isset($tree['keys'][$fid]) && ( $edit_forum || $delete_forum || ($mode == 'edit') || ($mode == 'create') || ($mode == 'moveup') || ($mode == 'movedw') || ($mode == 'resync') ) ) {
    $fid = '';
    $edit_forum = FALSE;
    $delete_forum = FALSE;
    if ( !in_array($mode, array('create', 'resync')) && !$create_forum && !$resync_forum ) {
        $mode = '';
    }
}

// convert buttons to mode
if ( $edit_forum ) {
    $mode = 'edit';
}
if ( $delete_forum ) {
    $mode = 'delete';
}
if ( $create_forum ) {
    $mode = 'create';
    $fid = '';
}
if ( $resync_forum ) {
    $mode = 'resync';
}
if ( $mode == 'delete' ) {
    $delete_forum = TRUE;
}

// reset the selected id
if ( isset($tree['keys'][$fid]) && !empty($tree['main'][ $tree['keys'][$fid] ]) ) {
    $selected_id = $tree['main'][ $tree['keys'][$fid] ];
}

//--------------------------------
//
//  process
//
//--------------------------------
// move up/down
if ( ($mode == 'moveup') || ($mode == 'movedw') ) {
    $prec = '';
    $next = '';
    $main = $tree['main'][ $tree['keys'][$fid] ];
    for ( $i = 0; $i < count($tree['sub'][$main]); $i++ ) {
        $prec = ( $i == 0 ) ? $main : $tree['sub'][$main][$i-1];
        $found = ( $tree['sub'][$main][$i] == $fid );
        if ( $found ) {
            $next = ( ($i+1) < count($tree['sub'][$main]) ) ? $tree['sub'][$main][$i+1] : $tree['sub'][$main][$i];
            break;
        }
    }
    if ( $found ) {
        // moving up/down
        $ref = ($mode == 'moveup') ? $prec : $next;
        $inc = ($mode == 'moveup') ? -5 : +5;
        if ( ( ($mode == 'moveup') && ($ref != $main) ) || ( ($mode == 'movedw') && ($ref != $fid) ) ) {
            $idx = $tree['keys'][$ref];
            if ( $tree['type'][$idx] == POST_FORUM_URL ) {
                $order = $tree['data'][$idx]['forum_order'] + $inc;
            } else {
                $order = $tree['data'][$idx]['cat_order'] + $inc;
            }
            // update the current one
            if ( substr($fid, 0, 1) == POST_FORUM_URL ) {
                $sql = "UPDATE " . FORUMS_TABLE . "
                        SET forum_order = $order
                        WHERE forum_id = " . intval(substr($fid, 1));
            } else {
                $sql = "UPDATE " . CATEGORIES_TABLE . "
                        SET cat_order = $order
                        WHERE cat_id = " . intval(substr($fid, 1));
            }
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t update order in categories/forums table', '', __LINE__, __FILE__, $sql);
            }
        }
    }
    // add topics count and various informations
    get_user_tree($userdata);
    $mode = '';
}

// resync
if ( $mode == 'resync' ) {
    $tkeys = array();
    $tkeys = get_auth_keys($fid, TRUE);
    for ( $i = 0; $i < count($tkeys['id']); $i++ ) {
        $wid = $tkeys['id'][$i];
        if ( substr($wid, 0, 1) == POST_FORUM_URL ) {
            sync('forum', intval(substr($wid, 1)) );
        }
    }
    // reorder
    reorder_tree();
    // end message
    $message = $lang['Forums_updated'] . $return_msg;
    message_die(GENERAL_MESSAGE, $message);
    exit;
}

// handle edition
if ( ($mode == 'edit') || ($mode == 'create') || ($mode == 'delete') ) {
    $this_var = isset($tree['keys'][$fid]) ? $fid : '';
    $idx = isset($tree['keys'][$fid]) ? $tree['keys'][$fid] : '';
    $item = array();
    //-------------------------
    // get values from memory
    //-------------------------
    // get type and id
    $old_type = empty($this_var) ? POST_FORUM_URL : substr($fid, 0, 1);
    $old_id = empty($this_var) ? 0 : intval(substr($fid, 1));
    // choose the appropriate list of field (forums or categories table)
    switch ($old_type) {
        case POST_FORUM_URL:
            $fields_list = 'forums_fields_list';
            break;
        case POST_CAT_URL:
            $fields_list = 'categories_fields_list';
            break;
        default:
            $fields_list = 'forums_fields_list';
            break;
    }

    // get value from the tree for all fields in the list
    @reset($$fields_list);
    while ( list($table_field, $process_field) = @each($$fields_list) ) {
        $item[$process_field] = empty($this_var) ? '' : trim($tree['data'][$idx][$table_field]);
    }

    // add fields not present in the list or having a special treatment
    $item['type'] = $old_type;

    // parent id
    $item['main'] = empty($this_var) ? $selected_id : $item['main_type'] . $item['main_id'];
    $item['main_type'] = substr($item['main'], 0, 1);
    $item['main_id'] = intval( substr($item['main'], 1) );
    if ( (intval($item['main_id']) == 0) || !in_array($item['main_type'], array(POST_CAT_URL, POST_FORUM_URL)) ) {
        $item['main'] = 'Root';
        $item['main_type'] = POST_CAT_URL;
        $item['main_id'] = 0;
    }

    // position : added field
    $item['position'] = $item['main'];
    $found = FALSE;
    if ( !empty($this_var) ) {
        for ( $i = 0; $i < count($tree['sub'][ $item['main'] ]); $i++ ) {
            $item['position'] = ( $i == 0 ) ? $item['main'] : $tree['sub'][ $item['main'] ][$i-1];
            $found = ( $tree['sub'][ $item['main'] ][$i] == $fid );
            if ( $found ) {
                break;
            }
        }
    }
    if ( !$found && !empty($tree['sub'][ $item['main'] ]) ) {
        $i = count($tree['sub'][ $item['main'] ]);
        $item['position'] = $tree['sub'][ $item['main'] ][$i-1];
    }

    // move topic : added field
    $item['move'] = '';

    // links specific
    if ( !empty($item['link']) && ($item['type'] == POST_FORUM_URL) ) {
        $item['type'] = POST_FLINK_URL;
    }

    // prune information
    $row = array();
    if ( !empty($this_var) && ($item['type'] == POST_FORUM_URL) ) {
        // read the auto-prune table
        $sql = "SELECT * FROM " . PRUNE_TABLE . " WHERE forum_id = " . $item['id'];
        if ( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Auto-Prune: Couldn\'t read auto_prune table.', '', __LINE__, __FILE__, $sql);
        }
        if ( !$row = $db->sql_fetchrow($result) ) {
            $row = array();
        }
    }
    $item['prune_days'] = empty($row) ? 7 : $row['prune_days'];
    $item['prune_freq'] = empty($row) ? 1 : $row['prune_freq'];

    // auth
    $forum_auth = array();

    // initiate with the first preset (public)
    @reset($field_names);
    $i = 0;
    while ( list($auth_key, $auth_name) = @each($field_names) ) {
        $auth_value = isset($simple_auth_ary[0][$i]) ? $simple_auth_ary[0][$i] : AUTH_ADMIN;
        $forum_auth[$auth_key] = $auth_value;
        $i++;
    }

    // get the value from memory
    @reset($tree['data'][$idx]);
    while ( list($key, $value) = @each($tree['data'][$idx]) ) {
        if ( substr($key, 0, strlen('auth_')) == 'auth_' ) {
            $forum_auth[$key] = $value;
        }
    }

    //-------------------------
    // get values from form
    //-------------------------
    // type
    $item['type'] = $_GETVAR->get('type', 'post', 'string', $item['type']);
    if ( !isset($forum_type_list[ $item['type'] ]) ) {
        $item['type'] = POST_FORUM_URL;
    }

    // choose the appropriate list of field (forums or categories table)
    switch ($item['type']) {
        case POST_FLINK_URL:
        case POST_FORUM_URL:
            $fields_list = 'forums_fields_list';
            break;
        case POST_CAT_URL:
            $fields_list = 'categories_fields_list';
            break;
        default:
            $fields_list = 'forums_fields_list';
            break;
    }

    // get value from form
    @reset($$fields_list);
    while ( list($table_field, $process_field) = @each($$fields_list) ) {
        $form_field = $_GETVAR->get($process_field, 'post', 'string');
        if ( strlen($form_field) > 0 ) {
            // get field from form
            switch ($fields_type[$process_field]) {
                case 'INTEGER':
                    $form_field = intval($form_field);
                    break;
                case 'HTML':
                    $form_field = (trim($form_field));
                    break;
                default:
                    $form_field = (trim($form_field));
                    break;
            }
            // store
            $item[$process_field] = $form_field;
        }
    }

    // Fix for deleting Forumimages
    $item['icon'] = trim($_GETVAR->get('icon', 'post', 'string'));

    // parent id
    $item['main'] = $_GETVAR->get('main', 'post', 'string', $item['main']);
    $item['main_type'] = substr($item['main'], 0, 1);
    $item['main_id'] = intval( substr($item['main'], 1) );
    if ( ($item['main_id'] == 0) || !in_array($item['main_type'], array(POST_CAT_URL, POST_FORUM_URL)) ) {
        $item['main'] = 'Root';
        $item['main_type'] = POST_CAT_URL;
        $item['main_id'] = 0;
    } else {
        $item['main'] = $item['main_type'] . $item['main_id'];
    }

    // position
    if ( $_GETVAR->get('position', 'post', 'string', NULL) ) {
        $type = substr($_GETVAR->get('position', 'post', 'string'), 0, 1);
        $id = intval( substr($_GETVAR->get('position', 'post', 'string'), 1) );
        if ( !in_array($type, array(POST_FORUM_URL, POST_CAT_URL)) || ($id == 0) ) {
            $item['position'] = 'Root';
        } else {
            $item['position'] = $type . $id;
        }
    }

    // move topics
    if ( $_GETVAR->get('move', 'post', 'string', NULL) ) {
        $type = substr($_GETVAR->get('move', 'post', 'string'), 0, 1);
        $id = intval(substr($_GETVAR->get('move', 'post', 'string'), 1));
        if ( ($type != POST_FORUM_URL) || ($id == 0) ) {
            $item['move'] = '';
        } else {
            $item['move'] = $type . $id;
        }
    }

    // status
    $item['status'] = (isset($item['status']) ? $item['status'] : (is_array($forum_status_list) ? $forum_status_list[0] : FORUM_UNLOCKED));
    if ( !isset($forum_status_list[ $item['status'] ]) ) {
        @reset($forum_status_list);
        list($status, $value) = @each($forum_status_list);
        $item['status'] = $status;
    }

    // auth
    @reset($forum_auth);
    while ( list($key, $value) = @each($forum_auth) ) {
        if ( $_GETVAR->get($key, 'post', 'int', NULL) ) {
            $forum_auth[$key] = $_GETVAR->get($key, 'post', 'int');
        }
    }

    // check a preset choose
    $forum_preset = -1;
    if ( $_GETVAR->get('preset_choice', 'post', 'int', NULL) && ( $_GETVAR->get('preset_choice', 'post', 'int') == 1 ) ) {
        if ( isset($simple_auth_ary[ $_GETVAR->get('forum_preset', 'post', 'int', NULL) ]) ) {
            $forum_preset = $_GETVAR->get('forum_preset', 'post', 'int');
            $preset_data = $simple_auth_ary[$forum_preset];
            @reset($field_names);
            $i = 0;
            while ( list($field_key, $field_lang) = @each($field_names) ) {
                $forum_auth[$field_key] = $preset_data[$i];
                $i++;
            }
        }
    } else {
        // try to identify a preset
        @reset($simple_auth_ary);
        while( list($preset_key, $preset_data) = @each($simple_auth_ary) ) {
            $matched = TRUE;
            @reset($field_names);
            $i = 0;
            while ( list($field_key, $field_lang) = @each($field_names) ) {
                $matched = ( $forum_auth[$field_key] == $preset_data[$i] );
                if ( !$matched ) {
                    break;
                }
                $i++;
            }
            if ( $matched ) {
                $forum_preset = $preset_key;
                break;
            }
        }
    }

    //-------------------------
    // process
    //-------------------------
    if ( $cancel ) {
        $mode = '';
    } else if ( $submit ) {
        // do some check
        $error = FALSE;
        $error_msg = '';

        // forum name
        if ( empty($item['name']) ) {
            admin_add_error( 'Forum_name_missing' );
        }

        // check move dest
        if ( !empty($item['move']) ) {
            $type = substr($item['move'], 0, 1);
            $id = intval(substr($item['move'], 1));
            $werror = FALSE;
            if ( ($type != POST_FORUM_URL) || ($id == 0) ) {
                $werror = TRUE;
            } else if ( !isset($tree['keys'][ $type . $id ]) ) {
                $werror = TRUE;
            } else if ( !empty($tree['data'][ $tree['keys'][ $type . $id ] ]['forum_link']) ) {
                $werror = TRUE;
            }
            if ( $werror ) {
                admin_add_error( 'Nowhere_to_move' );
            }
        }

        // force to choose a dest for attached items if delete
        if ( $delete_forum ) {
            if ( empty($item['move']) && !empty($tree['sub'][$fid]) ) {
                admin_add_error( 'Nowhere_to_move' );
            } else {
                $item['type'] = substr($item['move'], 0, 1);
                $item['id'] = intval(substr($item['move'], 1));
            }
        }

        // forum main
        if ( !defined('SUB_FORUM_ATTACH') ) {
            if ( ($item['main_type'] != POST_CAT_URL) || ( ($item['main'] == 'Root') && ($item['type'] != POST_CAT_URL) ) ) {
                admin_add_error( (($item['main'] == 'Root') ? 'Attach_root_wrong' : 'Attach_forum_wrong') );
            }
        }

        // recursive attachment
        if ( !empty($fid) ) {
            $main = $item['main'];
            while ( $main != 'Root' ) {
                if ( $main == $fid ) {
                    admin_add_error( 'Recursive_attachment' );
                    break;
                }
                $main = $tree['main'][ $tree['keys'][$main] ];
            }
        }

        // recursive dest
        if ( !empty($item['move']) && $delete_forum ) {
            $main = $item['move'];
            while ( $main != 'Root' ) {
                if ( $main == $fid ) {
                    admin_add_error( 'Recursive_attachment' );
                    break;
                }
                $main = $tree['main'][ $tree['keys'][$main] ];
            }
        }

        // category check
        if ( $item['type'] == POST_CAT_URL ) {
            // empty
        }

        // forum link type check
        if ( $item['type'] == POST_FLINK_URL ) {
            // is the link ok ?
            if ( empty($item['link']) ) {
                admin_add_error( 'Link_missing' );
            }

            // is there something already attached to the forum
            if ( !empty($fid) ) {
                // forums and cats
                if ( !empty($tree['sub'][$fid]) ) {
                    admin_add_error( 'Forum_link_with_attachment_deny' );
                }
            }
        }

        // forums
        if ( $item['type'] == POST_FORUM_URL ) {
            // prune
            if ( $item['prune_enable'] ) {
                if ( empty($item['prune_days']) || empty($item['prune_freq']) ) {
                    admin_add_error( 'Set_prune_data' );
                }
            }

            // sub levels
            if ( !defined('SUB_FORUM_ATTACH') && !empty($tree['sub'][ $fid ]) ) {
                // check if forum attached
                $found = FALSE;
                for ( $i = 0; $i < count($tree['sub'][ $fid ]); $i++ ) {
                    $found = ( $tree['type'][ $tree['keys'][ $tree['sub'][$fid][$i] ] ] == POST_FORUM_URL );
                    if ( $found ) {
                        break;
                    }
                }
                if ( $found ) {
                    admin_add_error( 'Forum_with_attachment_denied' );
                }
            }
        }

        // check content
        if ( ($old_type == POST_FORUM_URL) && ($item['type'] != POST_FORUM_URL) ) {
            // check if topics are present
            $sql = "SELECT * FROM " . TOPICS_TABLE . " WHERE forum_id = $old_id LIMIT 0, 1";
            if ( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t access topics table', '', __LINE__, __FILE__, $sql);
            }
            if ($row = $db->sql_fetchrow($result)) {
                $move_found = empty($item['move']); // empty = delete
                if ( !empty($item['move']) ) {
                    $type = substr($item['move'], 0, 1);
                    $id = intval(substr($item['move'], 1));
                    if ( $type == POST_FORUM_URL ) {
                        if ( isset($tree['keys'][ $item['move'] ] ) && ($item['move'] != $fid) ) {
                            $move_found = TRUE;
                        }
                    }
                }
                if ( !$move_found ) {
                    if ( $new_type == POST_CAT_URL ) {
                        admin_add_error( 'Category_with_topics_deny' );
                    } else if ( $new_type == POST_FLINK_URL ) {
                        admin_add_error( 'Forum_link_with_topics_deny' );
                    } else {
                        admin_add_error( 'Nowhere_to_move' );
                    }
                }
            }
        }

        // send errors
        if ( $error ) {
            $selected_id = $item['main'];
            $error_msg .= $return_msg;
            message_die(GENERAL_MESSAGE, $error_msg);
        }

        // get an order
        $item['order'] = 0;
        if ( !empty($item['position']) && ($item['position'] != 'Root') ) {
            $order_idx = $tree['keys'][ $item['position'] ];
            $item['order'] = ($tree['type'][$order_idx] == POST_CAT_URL) ? $tree['data'][$order_idx]['cat_order'] : $tree['data'][$order_idx]['forum_order'];
        }
        $item['order'] += 5;

        // get an id
        $item['type'] = ($item['type'] == POST_FLINK_URL) ? POST_FORUM_URL : $item['type'];
        $new_item = FALSE;
        if ( ( empty($fid) || ($old_type != $item['type']) ) && !$delete_forum) {
            $new_item = TRUE;
            $item['id'] = 0;
            if ( $item['type'] == POST_FORUM_URL ) {
                $sql = "SELECT MAX(forum_id) AS max_id FROM " . FORUMS_TABLE;
            } else {
                $sql = "SELECT MAX(cat_id) AS max_id FROM " . CATEGORIES_TABLE;
            }
            if ( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t get order number from forums/categories table', '', __LINE__, __FILE__, $sql);
            }
            if ( $row = $db->sql_fetchrow($result) ) {
                $item['id'] = $row['max_id'];
            }
            $item['id']++;
        }

        if ( !$delete_forum ) {
            // update
            $fields_list = ( $item['type'] == POST_FORUM_URL ) ? 'forums_fields_list' : 'categories_fields_list';
            $sql_fields = '';
            $sql_values = '';
            $sql_update = '';

            // regular fields
            @reset($$fields_list);
            while ( list($table_field, $process_field) = @each($$fields_list) ) {
                if ( ($table_field != 'main_type') || defined('SUB_FORUM_ATTACH') || ($item['type'] != POST_FORUM_URL) ) {
                    $table_value = ($fields_type[$process_field] == 'INTEGER') ? intval($item[$process_field]) : sprintf("'%s'", $item[$process_field]);
                    $sql_fields .= ( empty($sql_fields) ? '' : ', ' ) . $table_field;
                    $sql_values .= ( empty($sql_values) ? '' : ', ' ) . $table_value;
                    $sql_update .= ( empty($sql_update) ? '' : ', ' ) . $table_field . '=' . $table_value;
                }
            }

            // auth fields
            if ( $item['type'] == POST_FORUM_URL ) {
                @reset($forum_auth);
                while ( list($table_field, $auth_value) = @each($forum_auth) )  {
                    $table_value = intval($auth_value);
                    $sql_fields .= ( empty($sql_fields) ? '' : ', ' ) . $table_field;
                    $sql_values .= ( empty($sql_values) ? '' : ', ' ) . $table_value;
                    $sql_update .= ( empty($sql_update) ? '' : ', ' ) . $table_field . '=' . $table_value;
                }
            }

            // build the final sql request
            $table = ($item['type'] == POST_FORUM_URL) ? FORUMS_TABLE : CATEGORIES_TABLE;
            $index_field = ($item['type'] == POST_FORUM_URL) ? 'forum_id' : 'cat_id';
            $index_value = intval($item['id']);
            if ( $new_item ) {
                $sql = "INSERT INTO $table ($sql_fields) VALUES($sql_values)";
            } else {
                $sql = "UPDATE $table SET $sql_update WHERE $index_field=$index_value";
            }
            if ( !$db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t update forums/categories table', '', __LINE__, __FILE__, $sql);
            }
        }

        // prune table
        if ( $item['type'] == POST_FORUM_URL ) {
            if ( !$item['prune_enable'] || $delete_forum ) {
                $sql = "DELETE FROM " . PRUNE_TABLE . " WHERE forum_id = " . intval($item['id']);
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Couldn\'t remove from prune table the forum', '', __LINE__, __FILE__, $sql);
                }
            } else {
                $sql = "SELECT * FROM " . PRUNE_TABLE . " WHERE forum_id = " . intval($item['id']);
                if ( !$result = $db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Couldn\'t access prune table', '', __LINE__, __FILE__, $sql);
                }
                if( $db->sql_numrows($result) > 0 ) {
                    $sql = "UPDATE " . PRUNE_TABLE . "
                            SET prune_days = " . intval($item['prune_days']) . ",
                            prune_freq = " . intval($item['prune_freq']) . "
                            WHERE forum_id = " . intval($item['id']);
                } else {
                    $sql = "INSERT INTO " . PRUNE_TABLE . "  (forum_id, prune_days, prune_freq )
                            VALUES( " . intval($item['id']) . ", " . intval($item['prune_days']) . ",  " . intval($item['prune_freq']) . " )";
                }
                if ( !$db->sql_query($sql) ) {
                    message_die(GENERAL_ERROR, 'Couldn\'t update prune table', '', __LINE__, __FILE__, $sql);
                }
            }
        }

        // clean previous if new created
        if ( $new_item || $delete_forum ) {
            delete_item( $fid, $item['type'] . $item['id'], $item['move'] );
        }

        // reorder
        reorder_tree();

        // end message
        $selected_id = $item['main'];
        $message = $lang['Forums_updated'] . $return_msg;
        message_die(GENERAL_MESSAGE, $message);
        exit;
    } else {
        // template
        $template->set_filenames(array(
            'body' => 'admin/forum_extend_edit_body.tpl')
        );

        // header
        $template->assign_vars(array(
            'L_TITLE'             => $lang['Edit_forum'],
            'L_TITLE_EXPLAIN'     => $lang['Forum_edit_delete_explain'],
            'L_TYPE'              => $lang['Forum_type'],
            'L_NAME'              => $lang['Forum_name'],
            'L_DESC'              => $lang['Forum_desc'],
            'L_MAIN'              => $lang['Category_attachment'],
            'L_POSITION'          => $lang['Position_after'],
            'L_STATUS'            => $lang['Forum_status'],
            'L_MOVE'              => $lang['Move_contents'],
            'L_ICON'              => $lang['icon'],
            'L_ICON_EXPLAIN'      => $lang['icon_explain'],
            'L_PRUNE_ENABLE'      => $lang['Forum_pruning'],
            'L_ENABLED'           => $lang['Enabled'],
            'L_PRUNE_DAYS'        => $lang['prune_days'],
            'L_PRUNE_FREQ'        => $lang['prune_freq'],
            'L_LINK'              => $lang['Forum_link'],
            'L_FORUM_LINK'        => $lang['Forum_link_url'],
            'L_FORUM_LINK_EXPLAIN'            => $lang['Forum_link_url_explain'],
            'L_FORUM_LINK_INTERNAL'           => $lang['Forum_link_internal'],
            'L_FORUM_LINK_INTERNAL_EXPLAIN'   => $lang['Forum_link_internal_explain'],
            'L_FORUM_LINK_HIT_COUNT'          => $lang['Forum_link_hit_count'],
            'L_FORUM_LINK_HIT_COUNT_EXPLAIN'  => $lang['Forum_link_hit_count_explain'],
            'L_AUTH'              => $lang['Auth_Control_Forum'],
            'L_PRESET'            => $lang['Presets'],
            'L_SUBMIT'            => $delete_forum ? $lang['Delete'] : $lang['Submit'],
            'L_CANCEL'            => $lang['Cancel'],
            'L_REFRESH'           => $lang['Refresh'],
            'L_YES'               => $lang['Yes'],
            'L_NO'                => $lang['No'],
            'L_DAYS'              => $lang['Days'],
            )
        );

        // type select list
        $s_type_opt = '';
        @reset($forum_type_list);
        while ( list($key, $value) = @each($forum_type_list) ) {
            $selected = ( $item['type'] == $key ) ? ' selected="selected"' : '';
            $s_type_opt .= '<option value="' . $key . '"' . $selected . '>' . $lang[$value] . '</option>';
        }

        // status select list
        $s_status_opt = '';
        @reset($forum_status_list);
        while ( list($key, $value) = @each($forum_status_list) ) {
            $selected = ( $item['status'] == $key ) ? ' selected="selected"' : '';
            $s_status_opt .= '<option value="' . $key . '"' . $selected . '>' . $lang[$value] . '</option>';
        }

        // presets list
        $s_presets = '';
        $selected = ( $forum_preset < 0) ? ' selected="selected"' : '';
        $s_presets .= '<option value="-1"' . $selected . '>' . $lang['None'] . '</option>';
        @reset($simple_auth_ary);
        $i = 0;
        while ( list($preset_key, $preset_data) = @each($simple_auth_ary) ) {
            $selected = ($preset_key == $forum_preset) ? ' selected="selected"' : '';
            $s_presets .= '<option value="' . $preset_key . '"' . $selected . '>' . $simple_auth_types[$i] . '</option>';
            $i++;
        }

        // position list
        $s_post_opt = '';
        $selected = ($item['position'] == $item['main']) ? ' selected="selected"' : '';
        $s_post_opt .= '<option value="' . $item['main'] . '"' . $selected . '>' . get_object_lang($item['main'], 'name', TRUE) . '</option>';
        for ( $i = 0; $i < count($tree['sub'][ $item['main'] ]); $i++ ) {
            if ( $tree['sub'][ $item['main'] ][$i] != $fid ) {
                $selected = ($tree['sub'][ $item['main'] ][$i] == $item['position']) ? ' selected="selected"' : '';
                $s_post_opt .= '<option value="' . $tree['sub'][ $item['main'] ][$i] . '"' . $selected . '>|--&nbsp;' . get_object_lang($tree['sub'][ $item['main'] ][$i], 'name', TRUE) . '</option>';
            }
        }

        // place to move topics and attachements
        $s_move_opt = get_tree_option('--', TRUE);
        $s_move_opt = '<option value="" selected="selected">' . $lang['Delete_all_posts'] . '</option>' . $s_move_opt;

        // icon
        $icon = '';
        if ( !empty($tree['data'][$idx]['icon']) ) {
            $icon = $tree['data'][$idx]['icon'];
            $icon_img = $icon;
            if ( isset($images[$icon_img]) ) {
                $icon_img = $images[$icon_img];
            }
        }

        $icon_img = empty($icon) ? '' : '&nbsp;&nbsp;<img src="' . ( isset($images[$icon]) ? $images[$icon] : $icon ) . '" border="0" alt="' . $icon . '" title="' . $icon . '" />';

        // vars
        $template->assign_vars(array(
            'S_TYPE_OPT'        => $s_type_opt,
            'NAME'              => htmlspecialchars($item['name']),
            'DESC'              => $item['desc'],
            'S_FORUMS_OPT'      => get_tree_option($item['main'], TRUE),
            'S_POS_OPT'         => $s_post_opt,
            'S_STATUS_OPT'      => $s_status_opt,
            'S_MOVE_OPT'        => $s_move_opt,
            'ICON'              => $icon,
            'ICON_IMG'          => (isset($icon_img) ? $icon_img : ''),
            'S_PRESET_OPT'      => $s_presets,
            'AUTH_SPAN'         => ($item['type'] == POST_FORUM_URL) ? 4 : 1
            )
        );
        if ( $item['type'] == POST_FORUM_URL ) {
            $template->assign_vars(array(
                 'PRUNE_DISPLAY'     => $item['prune_enable'] ? '' : 'none',
                'PRUNE_ENABLE_YES'  => $item['prune_enable'] ? 'checked="checked"' : '',
                'PRUNE_ENABLE_NO'   => !$item['prune_enable'] ? 'checked="checked"' : '',
                'PRUNE_DAYS'        => $item['prune_days'],
                'PRUNE_FREQ'        => $item['prune_freq'],
                'FORUM_LINK'        => $item['link'],
                'LINK_INTERNAL_YES' => $item['link_internal'] ? 'checked="checked"' : '',
                'LINK_INTERNAL_NO'  => !$item['link_internal'] ? 'checked="checked"' : '',
                'LINK_COUNT_YES'    => $item['link_hit_count'] ? 'checked="checked"' : '',
                'LINK_COUNT_NO'     => !$item['link_hit_count'] ? 'checked="checked"' : ''
                )
            );
        }

        // some switches
        if ( $item['type'] == POST_CAT_URL ) {
            $template->assign_block_vars('category', array());
        } else {
            $template->assign_block_vars('no_category', array());
        }
        if ( $item['type'] == POST_FORUM_URL ) {
            $template->assign_block_vars('forum', array());
        } else {
            $template->assign_block_vars('no_forum', array());
        }
        if ( $item['type'] == POST_FLINK_URL ) {
            $template->assign_block_vars('link', array());
        } else {
            $template->assign_block_vars('no_link', array());
        }
        if ( in_array($item['type'], array(POST_FORUM_URL, POST_FLINK_URL)) ) {
            $template->assign_block_vars('forum_link', array());
            if ( $item['type'] == POST_FLINK_URL ) {
                $template->assign_block_vars('forum_link.link', array());
            } else {
                $template->assign_block_vars('forum_link.no_link', array());
            }
        }

        // place to move topics
        if ( $delete_forum || ( ($old_type == POST_FORUM_URL) && ($item['type'] != POST_FORUM_URL) ) ) {
            // check if any topics in this forum
            $topics = FALSE;
            $sql = "SELECT * FROM " . TOPICS_TABLE . " WHERE forum_id = $old_id LIMIT 0, 1";
            if ( !$result = $db->sql_query($sql) ) {
                message_die(GENERAL_ERROR, 'Couldn\'t access topics table', '', __LINE__, __FILE__, $sql);
            }
            if ($row = $db->sql_fetchrow($result)) {
                $topics = TRUE;
            }
            if ( $topics || !empty($tree['sub'][$fid]) ) {
                $template->assign_block_vars('move', array());
            }
        }

        // auth
        if ( $item['type'] != POST_CAT_URL ) {
            // list of auth
            $offset = 3;
            $color_line = FALSE;
            @reset($forum_auth);
            while ( list($key, $value) = @each($forum_auth) ) {
                // forum link only use the auth view
                if ( ($item['type'] == POST_FORUM_URL) || ($key == 'auth_view') ) {
                    $s_auth_opt = '';
                    for ( $i = 0; $i < count($forum_auth_const); $i++) {
                        $auth_key = $forum_auth_const[$i];
                        $auth_value = $forum_auth_levels[$i];
                        $selected = ($auth_key == $value) ? ' selected="selected"' : '';
                        $s_auth_opt .= '<option value="' . $auth_key . '"' . $selected . '>' . ( isset($lang['Forum_' . $auth_value]) ? $lang['Forum_' . $auth_value] : $auth_value ) . '</option>';
                    }

                    // try to find a legend
                    $l_key = $key;
                    if ( isset($field_names[$key]) ) {
                        $l_key = $field_names[$key];
                    } else {
                        $l_key = ucfirst(str_replace('_', ' ', substr($key, strlen('auth_'))));
                    }

                    // new line
                    $offset++;
                    if ( $offset > 3 ) {
                        $color_line = !$color_line;
                        $template->assign_block_vars('forum_link.auth', array() );
                        $offset = 0;
                        $color = !$color_line;
                    }
                    $color = !$color;
                    $template->assign_block_vars('forum_link.auth.cell', array(
                        'COLOR'      => $color ? 'row1' : 'row2',
                        'L_AUTH'     => isset($lang[$l_key]) ? $lang[$l_key] : $l_key,
                        'AUTH'       => $key,
                        'S_AUTH_OPT' => $s_auth_opt,
                        )
                    );
                }
            }

            // finish the line
            if ( ($item['type'] == POST_FORUM_URL) && ($offset < 3) ) {
                $template->assign_block_vars('forum_link.auth.empty', array(
                    'SPAN'  => 3 - $offset,
                    )
                );
            }
        }

        // topic display order
        if ( defined('TOPIC_DISPLAY_ORDER') && ($item['type'] != POST_CAT_URL) ) {
            $forum_display_sort_list = get_forum_display_sort_option($item['display_sort'], 'list', 'sort');
            $forum_display_order_list = get_forum_display_sort_option($item['display_order'], 'list', 'order');
            $template->assign_vars(array(
                'L_FORUM_DISPLAY_SORT'        => $lang['Sort_by'],
                'S_FORUM_DISPLAY_SORT_LIST'   => $forum_display_sort_list,
                'S_FORUM_DISPLAY_ORDER_LIST'  => $forum_display_order_list,
                )
            );
            $template->assign_block_vars('forum.topic_display_order', array());
        }

        // footer
        $s_hidden_fields = '';
        $s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
        $s_hidden_fields .= '<input type="hidden" name="selected_id" value="' . $selected_id . '" />';
        $s_hidden_fields .= '<input type="hidden" name="fid" value="' . $fid . '" />';
        $template->assign_vars(array(
            'L_INDEX'         => sprintf($lang['Forum_Index'], $board_config['sitename']),
            'NAV_CAT_DESC'    => admin_get_nav_cat_desc($selected_id),
            'S_HIDDEN_FIELDS' => $s_hidden_fields,
            'U_INDEX'         => admin_sid('admin_forums_extend.php'),
            'S_ACTION'        => admin_sid('admin_forums_extend.php'),
            )
        );
    }
}

// display the main list
if ( $mode == '' ) {
    // template
    $template->set_filenames(array(
        'body' => 'admin/forum_extend_body.tpl')
    );

    // header
    $template->assign_vars(array(
        'L_TITLE'         => $lang['Forum_admin'],
        'L_TITLE_EXPLAIN' => $lang['Forum_admin_explain'],
        'L_ICON'          => $lang['icon'],
        'L_ICON_EXPLAIN'  => $lang['icon_explain'],
        'L_FORUM'         => get_object_lang($selected_id, 'name', TRUE),
        'L_TOPICS'        => $lang['Topics'],
        'L_POSTS'         => $lang['Posts'],
        'L_ACTION'        => $lang['Action'],
        'L_EDIT'          => $lang['Edit'],
        'L_DELETE'        => $lang['Delete'],
        'L_MOVEUP'        => $lang['Move_up'],
        'L_MOVEDW'        => $lang['Move_down'],
        'IMG_MOVEUP'      => $images['up_arrow'],
        'IMG_MOVEDW'      => $images['down_arrow'],
        'L_RESYNC'        => $lang['Resync'],
        'L_CREATE_FORUM'  => $lang['Create_forum'],
        'L_EDIT_FORUM'    => $lang['Edit_forum'],
        'L_DELETE_FORUM'  => $lang['Forum_delete'],
        'L_RESYNC_FORUM'  => $lang['Resync'],
        'NO_SUBFORUMS'    => $lang['No_subforums'],
        )
    );
    if ( $selected_id != 'Root' ) {
        $template->assign_block_vars( 'no_root', array() );
    } else {
        $template->assign_block_vars( 'root', array() );
    }

    $color = FALSE;
    $counted_subtree = (isset($tree['sub'][$selected_id]) ? count($tree['sub'][$selected_id]): 0);
    for ($i=0; $i < $counted_subtree; $i++) {
        $this_var = $tree['sub'][$selected_id][$i];
        $idx = $tree['keys'][$this_var];

        // get data for this level
        $folder = $images['forum'];
        $l_folder = $lang['Forum'];
        if ( isset($tree['data'][$idx]['forum_status']) && ($tree['data'][$idx]['forum_status'] == FORUM_LOCKED)) {
            $folder = $images['forum_locked'];
            $l_folder = $lang['Forum_locked'];
        }
        if ( ($tree['type'][$idx] == POST_CAT_URL) || !empty($tree['sub'][$this_var]) ) {
            $folder = $images['category'];
            $l_folder = $lang['Category'];
            if ( isset($tree['data'][$idx]['forum_status']) && ($tree['data'][$idx]['forum_status'] == FORUM_LOCKED)) {
                $folder = $images['category_lock'];
                $l_folder = $lang['Category_locked'];
            }
        }
        if ( !empty($tree['data'][$idx]['forum_link']) ) {
            $folder = $images['link'];
            $l_folder = $lang['Forum_link'];
        }

        // is there some sub-levels for this level ?
        $sub = (isset($tree['sub'][$this_var]) ? count($tree['sub'][$this_var]) : 0);
        $links = '';
        for ($j = 0; $j < $sub; $j++ ) {
            $sub_this = $tree['sub'][$this_var][$j];
            $sub_idx = $tree['keys'][$sub_this];

            // sub folder icon
            $sub_folder = $images['icon_miniforum'];
            $sub_l_folder = $lang['Forum'];
            if ( isset($tree['data'][$sub_idx]['forum_status']) && ($tree['data'][$sub_idx]['forum_status'] == FORUM_LOCKED)) {
                $sub_folder = $images['icon_miniforum_locked'];
                $sub_l_folder = $lang['Forum_locked'];
            }
            if ( ($tree['type'][$sub_idx] == POST_CAT_URL) || !empty($tree['sub'][$sub_this]) ) {
                $sub_folder = $images['icon_minicat'];
                $sub_l_folder = $lang['Category'];
                if ( $tree['data'][$sub_idx]['forum_status'] == FORUM_LOCKED) {
                    $sub_folder = $images['icon_minicat_locked'];
                    $sub_l_folder = $lang['Category_locked'];
                }
            }
            if ( !empty($tree['data'][$sub_idx]['forum_link']) ) {
                $sub_folder = $images['icon_minilink'];
                $sub_l_folder = $lang['Forum_link'];
                if ( isset($tree['data'][$sub_idx]['forum_status']) && ($tree['data'][$sub_idx]['forum_status'] == FORUM_LOCKED)) {
                    $sub_folder = $images['icon_minilink_locked'];
                    $sub_l_folder = $lang['Forum_locked'];
                }
            }

            // sub level link
            $sub_folder = $sub_folder;
            $link = '<a href="' . admin_sid("admin_forums_extend.php&amp;selected_id=$sub_this") . '" class="gensmall" title="' . preg_replace('#<[^>]+>#', '', get_object_lang($sub_this, 'desc', TRUE)) . '">';
            $link .= '<img src="'. $sub_folder . '" border="0" alt="' . $sub_l_folder . '" title="' . $sub_l_folder . '" align="middle" />';
            $link .= '&nbsp;' . get_object_lang($sub_this, 'name', TRUE) . '</a>';
            $links .= ( empty($links) ? '' : ', ' ) . $link;
        }

        $icon = '';
        if ( !empty($tree['data'][$idx]['icon']) ) {
            $icon = $tree['data'][$idx]['icon'];
            $icon_img = $icon;
            if ( isset($images[$icon_img]) ) {
                $icon_img = $images[$icon_img];
            }
        }
        $color = !$color;
        $template->assign_block_vars('row', array(
            'COLOR'       => $color ? 'row1' : 'row2',
            'FOLDER'      => $folder,
            'L_FOLDER'    => $l_folder,
            'ICON_IMG'    => (isset($icon_img) ? $icon_img : ''),
            'ICON'        => $icon,
            'FORUM_NAME'  => get_object_lang($this_var, 'name', TRUE),
            'FORUM_DESC'  => get_object_lang($this_var, 'desc', TRUE),
            'TOPICS'      => (isset($tree['data'][$idx]['tree.forum_topics']) ? $tree['data'][$idx]['tree.forum_topics'] : ''),
            'POSTS'       => (isset($tree['data'][$idx]['tree.forum_posts']) ? $tree['data'][$idx]['tree.forum_posts'] : ''),
            'LINKS'       => empty($links) ? '' : '<br /><strong>' . $lang['Subforums'] . ':&nbsp;</strong>' . $links,
            'U_FORUM'     => admin_sid('admin_forums_extend.php&amp;selected_id=' . $this_var),
            'U_EDIT'      => admin_sid('admin_forums_extend.php&amp;mode=edit&amp;fid=' . $this_var),
            'U_DELETE'    => admin_sid('admin_forums_extend.php&amp;mode=delete&amp;fid=' . $this_var),
            'U_RESYNC'    => admin_sid('admin_forums_extend.php&amp;mode=resync&amp;fid=' . $this_var),
            'U_MOVEUP'    => admin_sid('admin_forums_extend.php&amp;mode=moveup&amp;fid=' . $this_var),
            'U_MOVEDW'    => admin_sid('admin_forums_extend.php&amp;mode=movedw&amp;fid=' . $this_var)
            )
        );

        if ( !empty($icon) ) {
            $template->assign_block_vars('row.forum_icon', array());
        }
    }

    // no subforums
    if ( empty($tree['sub'][$selected_id]) ) {
        $template->assign_block_vars( 'empty', array() );
    }

    // footer
    $s_hidden_fields = '';
    $s_hidden_fields .= '<input type="hidden" name="selected_id" value="' . $selected_id . '" />';
    $template->assign_vars(array(
        'L_INDEX'         => sprintf($lang['Forum_Index'], $board_config['sitename']),
        'NAV_CAT_DESC'    => admin_get_nav_cat_desc($selected_id),
        'S_HIDDEN_FIELDS' => $s_hidden_fields,
        'U_INDEX'         => admin_sid('admin_forums_extend.php'),
        'S_ACTION'        => admin_sid('admin_forums_extend.php'),
        )
    );
}

// dump
$template->pparse('body');
include_once(NUKE_FORUMS_ADMIN_DIR . 'page_footer_admin.php');

?>