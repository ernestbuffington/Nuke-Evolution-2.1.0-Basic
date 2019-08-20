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


if (!defined('IN_PHPBB') && !defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

$nav_separator = "&nbsp;->&nbsp;";
global $tree;

//--------------------------------------------------------------------------------------------------
//
// board_stats : update the board stats (topics, posts and users)
// -----------
//--------------------------------------------------------------------------------------------------
function board_stats() {
    global $db, $board_config;

    // max users
    $sql = "SELECT COUNT(user_id) AS user_total FROM " . USERS_TABLE . " WHERE user_id > 0 AND user_active=1";
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Couldn\'t access users table', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $max_users = intval( $row['user_total'] );
    // update
    if ( $board_config['max_users'] != $max_users ) {
        $board_config['max_users'] = $max_users;
        $sql = "UPDATE " . CONFIG_TABLE . " 
                SET config_value = " . $board_config['max_users'] . " 
                WHERE config_name = 'max_users'";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t update config table', '', __LINE__, __FILE__, $sql);
        }
    }
    // topics and posts
    $sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total FROM " . FORUMS_TABLE;
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Couldn\'t access forums table', '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $max_topics = intval( $row['topic_total'] );
    $max_posts = intval( $row['post_total'] );
    // update
    if ( $board_config['max_topics'] != $max_topics ) {
        $board_config['max_topics'] = $max_topics;
        $sql = "UPDATE " . CONFIG_TABLE . " 
                SET config_value = " . $board_config['max_topics'] . " 
                WHERE config_name = 'max_topics'";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t update config table', '', __LINE__, __FILE__, $sql);
        }
    }
    if ( $board_config['max_posts'] != $max_posts ) {
        $board_config['max_posts'] = $max_posts;
        $sql = "UPDATE " . CONFIG_TABLE . " 
                SET config_value = " . $board_config['max_posts'] . " 
                WHERE config_name = 'max_posts'";
        if ( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t update config table', '', __LINE__, __FILE__, $sql);
        }
    }
}

//--------------------------------------------------------------------------------------------------
//
// $tree : designed to get all the hierarchy
// ------
//
//	indexes :
//		- id : full designation : ie Root, f3, c20
//		- idx : rank order
//
//	$tree['keys'][id]			=> idx,
//	$tree['auth'][id]			=> auth_value array : ie tree['auth'][id]['auth_view'],
//	$tree['sub'][id]			=> array of sub-level ids,
//	$tree['main'][idx]			=> parent id,
//	$tree['type'][idx]			=> type of the row, can be 'c' for categories or 'f' for forums,
//	$tree['id'][idx]			=> value of the row id : cat_id for cats, forum_id for forums,
//	$tree['data'][idx]			=> db table row,
//	$tree['unread_topics'][idx]	=> boolean value to true if there is new topics
//--------------------------------------------------------------------------------------------------
$tree = array();

//--------------------------------------------------------------------------------------------------
//
// get_object_lang() : return the translated value of field depending on row type in the hierarchy
//
//--------------------------------------------------------------------------------------------------
function get_object_lang($cur, $field, $all=FALSE) {
    global $board_config, $lang, $tree;

    $res  = '';
    $this_var = (isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : NULL);
    $type     = (isset($tree['type'][$this_var]) ? $tree['type'][$this_var] : NULL);
    if ($cur == 'Root') {
        switch($field) {
            case 'name':
                if (isset($lang[$board_config['sitename']])) {
                    $res = sprintf($lang['Forum_Index'], $lang[$board_config['sitename']]);
                } else {
                    $res = sprintf($lang['Forum_Index'], $board_config['sitename']);
                }
                break;
            case 'desc':
                if (isset($lang[$board_config['site_desc']])) {
                    $res = $lang[$board_config['site_desc']];
                } else {
                    $res = $board_config['site_desc'];
                }
                break;
        }
    } else {
        switch($field) {
            case 'name':
                $field = ($type == POST_CAT_URL) ? 'cat_title' : 'forum_name';
                break;
            case 'desc':
                $field = ($type == POST_CAT_URL) ? 'cat_desc' : 'forum_desc';
                break;
        }
        $res = ((isset($tree['auth'][$cur]['auth_view']) && $tree['auth'][$cur]['auth_view']) || $all) ? $tree['data'][$this_var][$field] : '';
        if (isset($lang[$res])) {
            $res = $lang[$res];
        }
    }
    return $res;
}

//--------------------------------------------------------------------------------------------------
//
// cache_words() : buid the cache words file
//
//--------------------------------------------------------------------------------------------------
function cache_words() {
    return;
}

//--------------------------------------------------------------------------------------------------
//
// cache_themes() : buid the cache theme file
//
//--------------------------------------------------------------------------------------------------
function cache_themes() {
    return;
}

//--------------------------------------------------------------------------------------------------
//
// cache_tree() : build the cache tree file
//
//--------------------------------------------------------------------------------------------------
function cache_tree_output() {
    return;
}

function cache_tree_level($main, &$parents, &$cats, &$forums) {
    global $tree;

    // read all parents
    $tree_level = array();
    // get the forums of the level
    $xy = (isset($parents[POST_FORUM_URL][$main]) ? count($parents[POST_FORUM_URL][$main]) : 0);
    for ($i=0; $i < $xy; $i++) {
        $idx = $parents[POST_FORUM_URL][$main][$i];
        $tree_level['type'][] = POST_FORUM_URL;
        $tree_level['id'][]   = $forums[$idx]['forum_id'];
        $tree_level['sort'][] = $forums[$idx]['forum_order'];
        $tree_level['data'][] = $forums[$idx];
    }
    // add the categories of this level
    $xy = (isset($parents[POST_CAT_URL][$main]) ? count($parents[POST_CAT_URL][$main]): 0);
    for ($i=0; $i < $xy; $i++) {
        $idx = $parents[POST_CAT_URL][$main][$i];
        $tree_level['type'][] = POST_CAT_URL;
        $tree_level['id'][]   = $cats[$idx]['cat_id'];
        $tree_level['sort'][] = $cats[$idx]['cat_order'];
        $tree_level['data'][] = $cats[$idx];
    }
    // sort the level
    @array_multisort($tree_level['sort'], $tree_level['type'], $tree_level['id'], $tree_level['data']);
    // add the tree_level to the tree
    $order = 0;
    $xy = (isset($tree_level['data']) ? count($tree_level['data']) : 0);
    for ($i=0; $i < $xy; $i++) {
        $this_var = (isset($tree['data']) ? count($tree['data']) : 0);
        $key      = $tree_level['type'][$i] . $tree_level['id'][$i];
        $order    = $order + 10;
        $tree['keys'][$key]   = $this_var;
        $tree['main'][]       = $main;
        $tree['type'][]       = $tree_level['type'][$i];
        $tree['id'][]         = $tree_level['id'][$i];
        $tree['data'][]       = $tree_level['data'][$i];
        $tree['sub'][$main][] = $key;
        cache_tree_level($key, $parents, $cats, $forums);
    }
}

function cache_tree($write=FALSE) {
    global $db, $tree, $userdata, $board_config;

    // extended auth compliancy
    $sql_extend_auth = '';
    if ( defined('EXTEND_AUTH_INSTALLED') ) {
        $sql_extend_auth = ' AND aa.auth_type = ' . POST_FORUM_URL;
    }
    $tree    = array();
    $parents = array();
    $forums  = array();
    $cats    = array();
    $idx     = 0;
    // read categories
    $sql = "SELECT * FROM " . CATEGORIES_TABLE . " ORDER BY cat_order, cat_id";
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Couldn\'t access list of Categories', '', __LINE__, __FILE__, $sql);
    }
    while ($row = $db->sql_fetchrow($result)) {
        if ($row['cat_main'] == $row['cat_id']) {
            $row['cat_main'] = 0;
        }
        if ( empty($row['cat_main_type']) ) {
            $row['cat_main_type'] = POST_CAT_URL;
            $row['cat_order'] = $row['cat_order'] + 9000000;
        }
        $row['main'] = ($row['cat_main'] == 0) ? 'Root' : $row['cat_main_type'] . $row['cat_main'];
        $idx = count($cats);
        $cats[$idx] = $row;
        $parents[POST_CAT_URL][ $row['main'] ][] = $idx;
    }
    $db->sql_freeresult($result);
    // read forums
    $sql = "SELECT * FROM " . FORUMS_TABLE . " ORDER BY forum_order, forum_id";
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, "Couldn't access list of Forums", "", __LINE__, __FILE__, $sql);
    }
    $idx = 0;
    while ($row = $db->sql_fetchrow($result)) {
        $main_type = (empty($row['main_type'])) ? POST_CAT_URL : $row['main_type'];
        $row['main'] = ($row['cat_id'] == 0) ? 'Root' : $main_type . $row['cat_id'];
        $idx = count($forums);
        $forums[$idx] = $row;
        $parents[POST_FORUM_URL][ $row['main'] ][] = $idx;
    }
    $db->sql_freeresult($result);
    // build the tree
    cache_tree_level('Root', $parents, $cats, $forums);
    // Obtain list of moderators of each forum
    // First users, then groups ... broken into two queries
    $sql = "SELECT aa.forum_id, u.user_id, u.username 
            FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
            WHERE aa.auth_mod = 1
                AND g.group_single_user = 1 
                AND ug.group_id = aa.group_id 
                AND g.group_id = aa.group_id 
                AND u.user_id = ug.user_id 
                $sql_extend_auth
            GROUP BY u.user_id, aa.forum_id 
            ORDER BY aa.forum_id, u.user_id";
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
    }
    while( $row = $db->sql_fetchrow($result) ) {
        if (isset($tree['keys'][ POST_FORUM_URL . $row['forum_id'] ])) {
            $idx = $tree['keys'][ POST_FORUM_URL . $row['forum_id'] ];
            $tree['mods'][$idx]['user_id'][] = $row['user_id'];
            $tree['mods'][$idx]['username'][] = UsernameColor($row['username']);
        }
    }
    $db->sql_freeresult($result);
    $sql = "SELECT aa.forum_id, g.group_id, g.group_name 
            FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g 
            WHERE aa.auth_mod = 1 
                AND g.group_single_user = 0 
                AND g.group_type <> " . GROUP_HIDDEN . "
                AND ug.group_id = aa.group_id 
                AND g.group_id = aa.group_id 
                $sql_extend_auth
            GROUP BY g.group_id, aa.forum_id 
            ORDER BY aa.forum_id, g.group_id";
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
    }
    while( $row = $db->sql_fetchrow($result) ) {
        if (isset($tree['keys'][ POST_FORUM_URL . $row['forum_id'] ])) {
            $idx = $tree['keys'][ POST_FORUM_URL . $row['forum_id'] ];
            $tree['mods'][$idx]['group_id'][] = $row['group_id'];
            $tree['mods'][$idx]['group_name'][] = GroupColor($row['group_name']);
        }
    }
    $db->sql_freeresult($result);
    if ($write) {
        cache_tree_output();
    }
}

//--------------------------------------------------------------------------------------------------
//
// read_tree() : read the tables and fill the hierarchical tree
//
//--------------------------------------------------------------------------------------------------
function read_tree($force=FALSE) {
    global $tree, $db, $userdata, $board_config, $_GETVAR;

    $sql_extend_auth = '';
    $use_cache_file = FALSE;
    $s_last_posts = '';
    $last_posts = array();
    $new_topic_data = array();
    $tree['unread_topics'] = array();
    // read the user cookie
    $tracking_topics  = ( evo_getcookie($board_config['cookie_name'] . '_t') ) ? unserialize(evo_getcookie($board_config['cookie_name'] . '_t')) : array();
    $tracking_forums  = ( evo_getcookie($board_config['cookie_name'] . '_f') ) ? unserialize(evo_getcookie($board_config['cookie_name'] . '_f')) : array();
    $tracking_all     = ( evo_getcookie($board_config['cookie_name'] . '_f_all') ) ? unserialize(evo_getcookie($board_config['cookie_name'] . '_f_all')) : FALSE;
    // extended auth compliancy
    if ( defined('EXTEND_AUTH_INSTALLED') ) {
        $sql_extend_auth = ' AND aa.auth_type = ' . POST_FORUM_URL;
    }
    cache_tree();
    // read the last post
    $sql = "SELECT forum_id, forum_last_post_id FROM " . FORUMS_TABLE;
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Couldn\'t access list of last posts from forums', '', __LINE__, __FILE__, $sql);
    }
    while ( $row = $db->sql_fetchrow($result) ) {
        if ( isset($row['forum_last_post_id']) && $row['forum_last_post_id'] > 0 ) {
            $last_posts[$row['forum_last_post_id']] = $row['forum_id'];
            $s_last_posts .= ( empty($s_last_posts) ? '' : ', ' ) . $row['forum_last_post_id'];
        }
    }
    $db->sql_freeresult($result);
    $sql_last_posts = empty($s_last_posts) ? '' : " OR p.post_id IN ($s_last_posts)";
    // read the last or unread posts
    $user_lastvisit = (is_user() ? $userdata['user_lastvisit'] : 99999999999);
    $sql = "SELECT p.forum_id, p.topic_id, p.post_time, p.post_username, u.username, u.user_id, t.topic_last_post_id, t.topic_title
            FROM (" . POSTS_TABLE . " p, " . TOPICS_TABLE . " t, " . USERS_TABLE . " u)
            WHERE (t.topic_id = p.topic_id AND t.forum_id = p.forum_id AND t.topic_moved_id = 0)
                AND u.user_id = p.poster_id 
                AND( p.post_time > $user_lastvisit $sql_last_posts )
                AND p.post_id = t.topic_last_post_id";
    if ( !$result = $db->sql_query($sql) ) {
        message_die(GENERAL_ERROR, 'Couldn\'t access list of unread posts from forums', '', __LINE__, __FILE__, $sql);
    }
    while ($row = $db->sql_fetchrow($result)) {
        if ( $row['post_time'] > $user_lastvisit ) {
            $new_topic_data[ $row['forum_id'] ][ $row['topic_id'] ] = $row['post_time'];
        }
        if ( isset($last_posts[ $row['topic_last_post_id'] ]) && $row['topic_last_post_id'] > 0 ) {
            // topic title censor
            $row['topic_title'] = check_words($row['topic_title']);
            // store the added columns
            $idx = $tree['keys'][POST_FORUM_URL . $row['forum_id'] ];
            @reset($row);
            while ( list($key, $value) = @each($row) ) {
                $nkey = intval($key);
                if ( $key != "$nkey" ) {
                    $tree['data'][$idx][$key] = $row[$key];
                }
            }
        }
    }
    $db->sql_freeresult($result);
    // set the unread flag
    $xy = (isset($tree['data']) ? count($tree['data']): 0);
    for ($i=0; $i < $xy; $i++) {
        if ( $tree['type'][$i] == POST_FORUM_URL ) {
            // get the last post time per forums
            $forum_id = $tree['id'][$i];
            $unread_topics = FALSE;
            if ( isset($new_topic_data[$forum_id]) && ($new_topic_data[$forum_id] > 0) ) {
                $forum_last_post_time = 0;
                @reset($new_topic_data[$forum_id]);
                while( list($check_topic_id, $check_post_time) = @each($new_topic_data[$forum_id]) ) {
                    if( is_user() ) {
                        if( $check_post_time > $userdata['user_lastvisit'] ) {
                            $unread_topics = TRUE;
                        }
                    }
                    if( isset($tracking_topics[$check_topic_id]) || isset($tracking_forums[$forum_id]) ) {
                        if (isset($tracking_topics[$check_topic_id])) {
                            if ($tracking_topics[$check_topic_id] > $check_post_time)  {
                                $unread_topics = FALSE;
                            }
                        } else {
                            if ($tracking_forums[$forum_id] > $check_post_time)  {
                                $unread_topics = FALSE;
                            }
                        }
                    }
                    if (isset($tracking_forumsall) && $tracking_forumsall > $check_post_time) {
                        $unread_topics = FALSE;
                    }
                }
            }
            // store the result
            $tree['unread_topics'][$i] = $unread_topics;
        }
    }
    return;
}

//--------------------------------------------------------------------------------------------------
//
// set_tree_user_auth() : enhance each row with auths and other things : use get_user_tree() as entry point
//
//--------------------------------------------------------------------------------------------------
function set_tree_user_auth() {
    global $tree, $board_config, $userdata, $lang;

    // read the tree from the bottom
    $xy = (isset($tree['data']) ? (count($tree['data']) - 1) : -1);
    for ($i = $xy; $i >= 0; $i--) {
        //---------------------
        // full ids
        //---------------------
        $cur      = $tree['type'][$i] . $tree['id'][$i];
        $main     = $tree['main'][$i];
        $main_idx = ($main == 'Root') ? -1 : $tree['keys'][$main];
        //---------------------
        // auth view
        //---------------------
        $auth_view = FALSE;
        if ( isset($tree['auth'][$cur]['auth_view']) && !empty($tree['auth'][$cur]['auth_view']) ) {
            // forum auth
            $auth_view = $tree['auth'][$cur]['auth_view'];
        } else if ( isset($tree['auth'][$cur]['tree.auth_view']) ) {
            // categorie auth : get the sub level one
            $auth_view = $tree['auth'][$cur]['tree.auth_view'];
        }
        $tree['auth'][$cur]['auth_view'] = $auth_view;
        if ( !isset($tree['auth'][$cur]['tree.auth_view']) ) {
            $tree['auth'][$cur]['tree.auth_view'] = $auth_view;
        }
        // grant the main level
        if ($main != 'Root') {
            $tree['auth'][$main]['tree.auth_view'] = (isset($tree['auth'][$main]['tree.auth_view']) ? $tree['auth'][$main]['tree.auth_view'] : $tree['auth'][$cur]['tree.auth_view']);
        }
        //---------------------
        // auth read
        //---------------------
        $auth_read = FALSE;
        if ( isset($tree['auth'][$cur]['auth_read']) && !empty($tree['auth'][$cur]['auth_read']) ) {
            // forum auth
            $auth_read = $tree['auth'][$cur]['auth_read'];
        }
        $tree['auth'][$cur]['auth_read'] = $auth_read;
        //---------------------
        // forum information
        //---------------------
        // locked status
        $locked = TRUE;
        $tree['data'][$i]['tree.locked'] = (isset($tree['data'][$i]['tree.locked']) ? $tree['data'][$i]['tree.locked'] : TRUE);
        if ( !isset($tree['data'][$i]['forum_status']) || (isset($tree['data'][$i]['forum_status']) && ($tree['data'][$i]['forum_status'] == FORUM_UNLOCKED)) ) {
            // forum info
            $tree['data'][$i]['locked'] = FALSE;
            $tree['data'][$i]['tree.locked'] = FALSE;
        } else if ( !isset($tree['data'][$i]['tree.locked']) || (isset($tree['data'][$i]['tree.locked']) && ($tree['data'][$i]['tree.locked'] == FORUM_UNLOCKED)) ) {
            // category info : get the sub levels one
            $tree['data'][$i]['locked'] = FALSE;
            $tree['data'][$i]['tree.locked'] = FALSE;
        }
        // number of posts and topics
        if (!isset($tree['data'][$i]['tree.forum_posts'])) {
            $tree['data'][$i]['tree.forum_posts'] = 0;
            $tree['data'][$i]['tree.forum_topics'] = 0;
        }
        if ($tree['auth'][$cur]['auth_view']) {
            $tree['data'][$i]['tree.forum_posts'] += (isset($tree['data'][$i]['forum_posts']) ? $tree['data'][$i]['forum_posts'] : 0);
            $tree['data'][$i]['tree.forum_topics'] += (isset($tree['data'][$i]['forum_topics']) ? $tree['data'][$i]['forum_topics'] : 0);
        }
        // grant the main level
        if ($main != 'Root') {
            if ( !isset($tree['data'][$main_idx]['tree.locked']) ) {
                $tree['data'][$main_idx]['tree.locked'] = $tree['data'][$i]['tree.locked'];
            }
            $tree['data'][$main_idx]['tree.locked'] = ($tree['data'][$main_idx]['tree.locked'] && $tree['data'][$i]['tree.locked']);
            // number of posts and topics
            if (!isset($tree['data'][$main_idx]['tree.forum_posts'])) {
                $tree['data'][$main_idx]['tree.forum_posts'] = 0;
                $tree['data'][$main_idx]['tree.forum_topics'] = 0;
            }
            if ($tree['auth'][$cur]['auth_view']) {
                $tree['data'][$main_idx]['tree.forum_posts'] += $tree['data'][$i]['tree.forum_posts'];
                $tree['data'][$main_idx]['tree.forum_topics'] += $tree['data'][$i]['tree.forum_topics'];
            }
        }
        //---------------------
        // last post
        //---------------------
        if ($tree['auth'][$cur]['auth_read']) {
            if (isset($tree['data'][$i]['topic_last_post_id'])) {
                // fill the sub
                if (!isset($tree['data'][$i]['tree.topic_last_post_id']) || (isset($tree['data'][$i]['tree.topic_last_post_id']) && ($tree['data'][$i]['post_time'] > $tree['data'][$i]['tree.post_time']))) {
                    $tree['data'][$i]['tree.topic_last_post_id']  = $tree['data'][$i]['topic_last_post_id'];
                    $tree['data'][$i]['tree.post_time']           = $tree['data'][$i]['post_time'];
                    $tree['data'][$i]['tree.post_user_id']        = $tree['data'][$i]['user_id'];
                    $tree['data'][$i]['tree.post_username']       = ($tree['data'][$i]['user_id'] != ANONYMOUS) ? UsernameColor($tree['data'][$i]['username']) : ( (!empty($tree['data'][$i]['post_username'])) ? UsernameColor($tree['data'][$i]['post_username']) : $lang['Guest'] );
                    $tree['data'][$i]['tree.topic_title']         = $tree['data'][$i]['topic_title'];
                    $tree['data'][$i]['tree.unread_topics']       = $tree['unread_topics'][$i];
                }
            }
        }
        // grant the main level
        if ($main != 'Root') {
            if (isset($tree['data'][$i]['tree.topic_last_post_id'])) {
                if (!isset($tree['data'][$main_idx]['tree.topic_last_post_id']) || (isset($tree['data'][$main_idx]['tree.topic_last_post_id']) && ($tree['data'][$i]['post_time'] > $tree['data'][$main_idx]['tree.post_time']))) {
                    $tree['data'][$main_idx]['tree.topic_last_post_id'] = $tree['data'][$i]['tree.topic_last_post_id'];
                    $tree['data'][$main_idx]['tree.post_time']      = $tree['data'][$i]['tree.post_time'];
                    $tree['data'][$main_idx]['tree.post_user_id']   = $tree['data'][$i]['tree.post_user_id'];
                    $tree['data'][$main_idx]['tree.post_username']  = UsernameColor($tree['data'][$i]['tree.post_username']);
                    $tree['data'][$main_idx]['tree.topic_title']    = $tree['data'][$i]['tree.topic_title'];
                    $tree['data'][$main_idx]['tree.unread_topics']  = $tree['data'][$i]['tree.unread_topics'];
                }
            }
        }
    }
}

//--------------------------------------------------------------------------------------------------
//
// get_user_tree() : generate the hierarchy tree - called in init_userprefs()
//
//--------------------------------------------------------------------------------------------------
function get_user_tree(&$userdata) {
    global $tree;

    if (empty($tree)) {
        read_tree();
    }
    // read the user auth if requiered
    if (empty($tree['auth'])) {
        $tree['auth'] = array();
        $wauth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);
        if (!empty($wauth)) {
            reset($wauth);
            while (list($key, $data) = each($wauth)) {
                $tree['auth'][POST_FORUM_URL . $key] = $data;
            }
        }
        // enhanced each level
        set_tree_user_auth();
    }
    return;
}

//--------------------------------------------------------------------------------------------------
//
// get_auth_keys() : return an array() with only the viewable row id
// returned array :
//		$keys['keys'][id]		=> n,
//		$keys['id'][n]			=> id (used by $tree),
//		$keys['real_level'][n]	=> level in this auth-tree (root=-1),
//		$keys['level'][n]		=> level adjust for display (sub-level=parent level under certain conditions)
//		$keys['idx'][n]			=> idx (used by $tree)
//--------------------------------------------------------------------------------------------------
function get_auth_keys($cur='Root', $all=FALSE, $level=-1, $max=-1, $auth_key='auth_view') {
    global $board_config;
    global $tree;

    $keys = array();
    $last_i = -1;
    // add the level
    if ( ($cur == 'Root') || $tree['auth'][$cur][$auth_key] || $all) {
        // push the level
        if (($max < 0) || ($level < $max) || (($level==$max) && ((substr($tree['main'][$tree['keys'][$cur]], 0, 1) == POST_CAT_URL) || ($tree['main'][$tree['keys'][$cur]] == 'Root') ))) {
            // if child of cat, align the level on the parent one
            $orig_level = $level;
            if (!$all) {
                if (($level > 0) && ((substr($cur, 0, 1) == POST_FORUM_URL) || (intval($board_config['sub_forum']) > 0)) && (substr($tree['main'][$tree['keys'][$cur]], 0, 1) == POST_CAT_URL)) {
                    $level = $level-1;
                }
            }
            // store this level
            $last_i++;
            $keys['keys'][$cur]       = $last_i;
            $keys['id'][$last_i]      = $cur;
            $keys['real_level'][$last_i]  = $orig_level;
            $keys['level'][$last_i]     = $level;
            $keys['idx'][$last_i]     = (isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1);
            // get sub-levels
            $xy = (isset($tree['sub'][$cur]) ? count($tree['sub'][$cur]) : 0);
            for ($i=0; $i < $xy; $i++) {
                $tkeys = array();
                $tkeys = get_auth_keys($tree['sub'][$cur][$i], $all, $orig_level+1, $max, $auth_key);
                // add sub-levels
                $xyx = (isset($tkeys['id']) ? count($tkeys['id']) : 0);
                for ($j=0; $j < $xyx; $j++) {
                    $last_i++;
                    $keys['keys'][$tkeys['id'][$j]] = $last_i;
                    $keys['id'][$last_i]      = $tkeys['id'][$j];
                    $keys['real_level'][$last_i]  = $tkeys['real_level'][$j];
                    $keys['level'][$last_i]     = $tkeys['level'][$j];
                    $keys['idx'][$last_i]     = $tkeys['idx'][$j];
                }
            }
        }
    }
    return $keys;
}
//--------------------------------------------------------------------------------------------------
//
// get_max_depth() : return the maximum level in the branch of the tree
//
//--------------------------------------------------------------------------------------------------
function get_max_depth($cur='Root', $all=FALSE, $level=-1, &$keys, $max=-1) {
    global $tree;
    
    if (empty($keys['id'])) {
        $keys = array();
        $keys = get_auth_keys($cur, $all);
    }
    $max_level = 0;
    $xy = count($keys['id']);
    for ($i=0; $i < $xy; $i++) {
        if ($keys['level'][$i] > $max_level) {
            $max_level = $keys['level'][$i];
        }
    }
    return $max_level;
}

//--------------------------------------------------------------------------------------------------
//
// get_tree_option() : return a drop down menu list of <option></option>
//
//--------------------------------------------------------------------------------------------------
function get_tree_option($cur='', $all=FALSE) {
    global $tree, $lang;

    $keys = array();
    $keys = get_auth_keys('Root', $all);
    $res = '';
    $xy = (isset($keys['id']) ? count($keys['id']) : 0);
    for ($i=0; $i < $xy; $i++) {
        // only get object that are not forum links type
        if ( (isset($tree['type'][ $keys['idx'][$i] ]) && $tree['type'][ $keys['idx'][$i] ] != POST_FORUM_URL) || empty($tree['data'][ $keys['idx'][$i] ]['forum_link']) || $all) {
            $selected = ($cur == $keys['id'][$i]) ? ' selected="selected"' : '';
            $res .= '<option value="' . $keys['id'][$i] . '"' .  $selected . '>';
            // name
            $name = get_object_lang($keys['id'][$i], 'name', $all);
            // increment
            $inc = '';
            for ($k=1; $k <= $keys['real_level'][$i]; $k++) {
                $inc .= '|&nbsp;&nbsp;&nbsp;';
            }
            if ($keys['level'][$i] >=0) {
                $inc .= '|--';
            }
            $name = $inc . $name;
            $res .= strip_tags($name) . '</option>';
        }
    }
    return $res;
}

//--------------------------------------------------------------------------------------------------
//
// build_index() : display a level and its sublevels : use dislay_index() as entry point
//
//--------------------------------------------------------------------------------------------------
function build_index($cur='Root', $cat_break=FALSE, &$forum_moderators, $real_level=-1, $max_level=-1, &$keys) {
    global $tree, $wdata, $template, $board_config, $lang, $images;

    // init
    $display = FALSE;
    // get the sub_forum switch value
    $sub_forum = intval($board_config['sub_forum']);
    if (($sub_forum == 2) && defined('IN_VIEWFORUM')) {
        $sub_forum = 1;
    }
    $pack_first_level = ($sub_forum == 2);
    // verify the cat_break parm
    if (($cur != 'Root') && ($real_level == -1)) {
        $cat_break = FALSE;
    }
    // display the level
    $this_var = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;
    // display each kind of row
    // root level head
    if ($real_level == -1) {
        // get max inc level
        $max = -1;
        if ($sub_forum == 2) {
            $max = 0;
        }
        if ($sub_forum == 1) {
            $max = 1;
        }
        $keys = array();
        $keys = get_auth_keys($cur, FALSE, -1, $max);
        $max_level = get_max_depth($cur, FALSE, -1, $keys, $max);
    }
    // table header
    if (($board_config['split_cat'] && $cat_break && ($real_level==0)) || ((!$board_config['split_cat'] || !$cat_break) && ($real_level==-1))) {
        // if break, get the local max level
        if ($board_config['split_cat'] && $cat_break && ($real_level==0)) {
            $max_level = 0;
            // the array is sorted
            $start = FALSE;
            $stop = FALSE;
            $xy = count($keys['id']);
            for ($i=0; ($i < $xy && !$stop); $i++) {
                if ( $start && ($tree['main'][$keys['idx'][$i]] == $tree['main'][$this_var])) {
                    $stop = TRUE;
                    break;
                }
                if ($keys['id'][$i] == $cur) {
                    $start = TRUE;
                }
                if ($start && !$stop && ($keys['level'][$i] > $max_level)) {
                    $max_level = $keys['level'][$i];
                }
            }
        }
        $template->assign_block_vars('catrow', array());
        $template->assign_block_vars('catrow.tablehead', array(
                'L_FORUM'   => ($this_var < 0) ? $lang['Forum'] : get_object_lang($cur, 'name'),
                'INC_SPAN'  => $max_level+2)
        );
    }
    // get the level
    $level = $keys['level'][$keys['keys'][$cur]];
    // sub-forum view management
    $pull_down = TRUE;
    if ($sub_forum > 0) {
        $pull_down = FALSE;
        if (($real_level==0) && ($sub_forum == 1)) {
            $pull_down = TRUE;
        }
    }
    if ($level >=0 ) {
        // cat header row
        if ( ($tree['type'][$this_var] == POST_CAT_URL) && $pull_down) {
            // display a cat row
            $cat = $tree['data'][$this_var];
            $cat_id = $tree['id'][$this_var];
            // get the class colors
            $class_catLeft  = 'catLeft';
            $class_cat    = 'cat';
            $class_rowpic = 'rowpic';
            // cat icon
            $icon_img = empty($cat['icon']) ? $images['spacer'] : ( isset($images[ $cat['icon'] ]) ? $images[ $cat['icon'] ] : $cat['icon'] );
            $cat_desc = get_object_lang($cur, 'desc');
            // send to template
            $template->assign_block_vars('catrow', array());
            $template->assign_block_vars('catrow.cathead', array(
                        'CAT_TITLE'     => get_object_lang($cur, 'name'),
                        'CAT_DESC'      => (strlen($cat_desc) > 1 ? $cat_desc : '&nbsp;'),
                        'CAT_IMAGE'     => $icon_img,
                        'CLASS_CATLEFT' => $class_catLeft,
                        'CLASS_CAT'     => $class_cat,
                        'CLASS_ROWPIC'  => $class_rowpic,
                        'INC_SPAN'      => $max_level - $level+5,
                        'U_VIEWCAT'     => append_sid('index.php?' . POST_CAT_URL . '='.$cat_id))
            );
            // add indentation to the display
            for ($k=1; $k <= $level; $k++) {
                $template->assign_block_vars('catrow.cathead.inc', array(
                        'INC_CLASS' => ($k % 2) ?  'row1' : 'row2')
                );
            }
            // something displayed
            $display = TRUE;
        }
    }
    // forum header row
    if ($level >= 0) {
        if ( ($tree['type'][$this_var] == POST_FORUM_URL) || (($tree['type'][$this_var] == POST_CAT_URL) && !$pull_down)) {
            // get the data
            $data = $tree['data'][$this_var];
            $id   = $tree['id'][$this_var];
            $type = $tree['type'][$this_var];
            $last_post_id = 
            $sub  = (!empty($tree['sub'][$cur]) && $tree['auth'][$cur]['tree.auth_view']);
            // specific to the data type
            $title  = get_object_lang($cur, 'name');
            $desc   = trim(get_object_lang($cur, 'desc'));
            // specific to something attached
            if ($sub) {
                $i_new    = $images['category_new'];
                $a_new    = $lang['New_posts'];
                $i_norm   = $images['category'];
                $a_norm   = $lang['No_new_posts'];
                $i_locked = $images['category_locked'];
                $a_locked = $lang['Forum_locked'];
            } else {
                $i_new    = $images['forum_new'];
                $a_new    = $lang['New_posts'];
                $i_norm   = $images['forum'];
                $a_norm   = $lang['No_new_posts'];
                $i_locked = $images['forum_locked'];
                $a_locked = $lang['Forum_locked'];
            }
            // forum link type
            if (($tree['type'][$this_var] == POST_FORUM_URL) && !empty($tree['data'][$this_var]['forum_link'])) {
                $i_new    = $images['link'];
                $a_new    = $lang['Forum_link'];
                $i_norm   = $images['link'];
                $a_norm   = $lang['Forum_link'];
                $i_locked = $images['link'];
                $a_locked = $lang['Forum_link'];
            }
            // front icon
            $folder_image = ( isset($tree['data'][$this_var]['tree.unread_topics']) && $tree['data'][$this_var]['tree.unread_topics'] ) ? $i_new : $i_norm;
            $folder_alt   = ( isset($tree['data'][$this_var]['tree.unread_topics']) && $tree['data'][$this_var]['tree.unread_topics'] ) ? $a_new : $a_norm;
            if (isset($tree['data'][$this_var]['tree.locked']) && $tree['data'][$this_var]['tree.locked'] ) {
                $folder_image = $i_locked;
                $folder_alt   = $a_locked;
            }
            // moderators list
            $l_moderators = '';
            $moderator_list = '';
            if ($type == POST_FORUM_URL) {
                $counted_mods = (isset($forum_moderators[$id]) ? count($forum_moderators[$id]) : 0);
                if ( $counted_mods > 0 ) {
                    $l_moderators = ( count($forum_moderators[$id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
                    $moderator_list = implode(', ', $forum_moderators[$id]);
                }
            }
            // last post
            $last_post = $lang['No_Posts'];
            if ( isset($data['tree.topic_last_post_id']) ) {
                // resize
                $topic_title = $data['tree.topic_title'];
                if ( strlen($topic_title) > (intval($board_config['last_topic_title_length'])-3) ) {
                    $topic_title = substr($topic_title, 0, intval($board_config['last_topic_title_length'])) . '...';
                }
                $topic_title = '<a href="' . append_sid("viewtopic.php?"  . POST_POST_URL . "=" . $data['tree.topic_last_post_id']) . '#' . $data['tree.topic_last_post_id'] . '" title="' . $data['tree.topic_title'] . '">' . $topic_title . '</a><br />';
                $last_post_time = create_date($board_config['default_dateformat'], $data['tree.post_time'], $board_config['board_timezone']);
                $last_post  = (($board_config['last_topic_title']) ? $topic_title : '');
                $last_post .= $last_post_time . '<br />';
                $last_post .= ( $data['tree.post_user_id'] == ANONYMOUS ) ? UsernameColor($data['tree.post_username']) . ' ' : '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $data['tree.post_user_id']) . '">' . UsernameColor($data['tree.post_username']) . '</a> ';
                $last_post .= '<a href="' . append_sid("viewtopic.php?"  . POST_POST_URL . '=' . $data['tree.topic_last_post_id']) . '#' . $data['tree.topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
            }
            $links = '';
            if ( $sub && ( !$pull_down || ( ($type == POST_FORUM_URL) && ($sub_forum > 0) ) ) && (intval($board_config['sub_level_links']) > 0) ) {
                $xy = (isset($tree['sub'][$cur]) ? count($tree['sub'][$cur]) : 0);
                for ($j=0; $j < $xy; $j++) {
                    if ($tree['auth'][ $tree['sub'][$cur][$j] ]['auth_view']) {
                        $wcur = $tree['sub'][$cur][$j];
                        $wthis  = $tree['keys'][$wcur];
                        $wdata  = $tree['data'][$wthis];
                        $wname  = get_object_lang($wcur, 'name');
                        $wdesc  = get_object_lang($wcur, 'desc');
                        switch($tree['type'][$wthis]) {
                            case POST_FORUM_URL:
                                $wpgm = append_sid('viewforum.php?' . POST_FORUM_URL . '=' . $tree['id'][$wthis]);
                                break;
                            case POST_CAT_URL:
                                $wpgm = append_sid('index.php?' . POST_CAT_URL . '=' . $tree['id'][$wthis]);
                                break;
                            default:
                                $wpgm = append_sid('index.php');
                                break;
                        }
                        if ($wname != '') {
                            $link = '<a href="' . $wpgm . '" title="' . htmlspecialchars($wdesc) . '" class="gensmall">' . $wname . '</a>';
                        }
                        if (intval($board_config['sub_level_links']) == 2) {
                            $wsub = (!empty($tree['sub'][$wcur]) && $tree['auth'][$wcur]['tree.auth_view']);
                            // specific to something attached
                            if ($wsub) {
                                $wi_new    = $images['icon_minicat_new'];
                                $wa_new    = $lang['New_posts'];
                                $wi_norm   = $images['icon_minicat'];
                                $wa_norm   = $lang['No_new_posts'];
                                $wi_locked = $images['icon_minicat_locked'];
                                $wa_locked = $lang['Forum_locked'];
                            }else {
                                $wi_new    = $images['icon_miniforum_new'];
                                $wa_new    = $lang['New_posts'];
                                $wi_norm   = $images['icon_miniforum'];
                                $wa_norm   = $lang['No_new_posts'];
                                $wi_locked = $images['icon_miniforum_locked'];
                                $wa_locked = $lang['Forum_locked'];
                            }
                            // forum link type
                            if (($tree['type'][$wthis] == POST_FORUM_URL) && !empty($wdata['forum_link'])) {
                                $wi_new    = $images['icon_minilink_new'];
                                $wa_new    = $lang['Forum_link'];
                                $wi_norm   = $images['icon_minilink'];
                                $wa_norm   = $lang['Forum_link'];
                                $wi_locked = $images['icon_minilink_locked'];
                                $wa_locked = $lang['Forum_link'];
                            }
                            // front icon
                            $wfolder_image = ( $data['tree.unread_topics'] ) ? $wi_new : $wi_norm;
                            $wfolder_alt   = ( $data['tree.unread_topics'] ) ? $wa_new : $wa_norm;
                            if ($wdata['tree.locked']) {
                                $wfolder_image = $wi_locked;
                                $wfolder_alt   = $wa_locked;
                            }
                            $wlast_post  = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . append_sid("viewtopic.php?"  . POST_POST_URL . '=' . $data['tree.topic_last_post_id']) . '#' . $data['tree.topic_last_post_id'] . '">';
                            $wlast_post .= '<img src="' . $wfolder_image . '" border="0" alt="" title="' . $wfolder_alt . '" style="vertical-align:middle;" /></a>';
                        }
					    if ($link != '') {
					        $links .= (($links != '') ? '<br />' : '') . $wlast_post . $link ;
					    }
				    }
			    }
            }
            // forum icon
            $icon_img = empty($data['icon']) ? '' : ( isset($images[ $data['icon'] ]) ? $images[ $data['icon'] ] : $data['icon'] );
            // send to template
            $template->assign_block_vars('catrow', array());
            $template->assign_block_vars('catrow.forumrow', array(
                    'FORUM_FOLDER_IMG'=> $folder_image, 
                    'ICON_IMG'        => $icon_img,
                    'FORUM_NAME'      => $title,
                    'FORUM_DESC'      => (strlen($desc) > 1 ? $desc : '&nbsp;'),
                    'POSTS'           => $data['tree.forum_posts'],
                    'TOPICS'          => $data['tree.forum_topics'],
                    'LAST_POST'       => $last_post,
                    'MODERATORS'      => (!empty($moderator_list) ? $moderator_list : '&nbsp;'),
                    'L_MODERATOR'     => empty($moderator_list) ? '' : ( empty($l_moderators) ? '<br />' : '<br /><strong>' . $l_moderators . ':</strong>&nbsp;' ),
                    'L_LINKS'         => empty($links) ? '&nbsp;' : ( empty($lang['Subforums']) ? '<br />' : '<br /><strong>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $lang['Subforums'] . ':</strong><br />' ),
                    'LINKS'           => (!empty($links) ? $links : '&nbsp;'),
                    'L_FORUM_FOLDER_ALT'  => $folder_alt, 
                    'U_VIEWFORUM'     => ($type == POST_FORUM_URL) ? append_sid("viewforum.php?" . POST_FORUM_URL . "=$id") : append_sid("index.php?" . POST_CAT_URL . "=$id"),
                    'INC_SPAN'        => $max_level- $level+1,
                    'INC_CLASS'       => ( !($level % 2) ) ? 'row1' : 'row2')
            );
            // display icon
            if ( !empty($icon_img) ) {
                $template->assign_block_vars('catrow.forumrow.forum_icon', array());
            }
            // add indentation to the display
            for ($k=1; $k <= $level; $k++) {
                $template->assign_block_vars('catrow.forumrow.inc', array(
                        'INC_CLASS' => ($k % 2) ?  'row1' : 'row2')
                );
            }
            // forum link type
            if (($tree['type'][$this_var] == POST_FORUM_URL) && !empty($tree['data'][$this_var]['forum_link'])) {
                $s_hit_count = '';
                if ($tree['data'][$this_var]['forum_link_hit_count']) {
                    $s_hit_count = sprintf($lang['Forum_link_visited'], $tree['data'][$this_var]['forum_link_hit']);
                }
                $template->assign_block_vars('catrow.forumrow.forum_link', array(
                            'HIT_COUNT' => $s_hit_count)
                );
            } else {
                $template->assign_block_vars('catrow.forumrow.forum_link_no', array());
            }
            // something displayed
            $display = TRUE;
        }
    }
    // display sub-levels
    $xy = (isset($tree['sub'][$cur]) ? count($tree['sub'][$cur]) : 0);
    for ($i=0; $i < $xy; $i++) {
        if (!empty($keys['keys'][$tree['sub'][$cur][$i]])) {
            $wdisplay = build_index($tree['sub'][$cur][$i], $cat_break, $forum_moderators, $level+1, $max_level, $keys);
            if ($wdisplay) {
                $display = TRUE;
            }
        }
    }
    if ($level >=0 ) {
        // forum footer row
        if ($tree['type'][$this_var] == POST_FORUM_URL) {
        }
    }
    if ($level >=0 ) {
        // cat footer
        if ( ($tree['type'][$this_var] == POST_CAT_URL) && $pull_down) {
            $template->assign_block_vars('catrow', array());
            $template->assign_block_vars('catrow.catfoot', array('INC_SPAN' => $max_level - $level+5));
            // add indentation to the display
            for ($k=1; $k <= $level; $k++) {
                $template->assign_block_vars('catrow.catfoot.inc', array(
                        'INC_SPAN' => $max_level - $level+5,
                        'INC_CLASS' => ($k % 2) ?  'row1' : 'row2')
                );
            }
        }
    }
    // root level footer
    if (($board_config['split_cat'] && $cat_break && $real_level==0) || ((!$board_config['split_cat'] || !$cat_break) && $real_level==-1)) {
        $template->assign_block_vars('catrow', array());
        $template->assign_block_vars('catrow.tablefoot', array());
    }
    return $display;
}

//--------------------------------------------------------------------------------------------------
//
// display_index() : display the index using the tpl var {BOARD_INDEX}, return true if the index is not empty
//
//--------------------------------------------------------------------------------------------------
function display_index($cur='Root') {
    global $tree, $board_config, $template, $lang, $images, $nav_separator, $nav_cat_desc;

    $template->set_filenames(array(
            'index' => 'index_box.tpl')
    );
    // moderators list
    $forum_moderators = array();
    @reset($tree['mods']);
    while ( list($idx, $data) = @each($tree['mods']) ) {
        if ( $tree['type'][$idx] == POST_FORUM_URL ) {
            $xy = (isset($data['user_id']) ? count($data['user_id']) : 0);
            for ( $i = 0; $i < $xy; $i++ ) {
                $forum_moderators[$tree['id'][$idx]][] = '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $data['user_id'][$i]) . '">' . $data['username'][$i] . '</a>';
            }
            $xy = (isset($data['group_id']) ? count($data['group_id']) : 0);
            for ( $i = 0; $i < $xy; $i++ ) {
                $forum_moderators[$tree['id'][$idx]][] = '<a href="' . append_sid("groupcp.php?" . POST_GROUPS_URL . "=" . $data['group_id'][$i]) . '">' . $data['group_name'][$i] . '</a>';
            }
        }
    }

    // let's dump all of this on the template
    $keys = array();
    $display = build_index($cur, $board_config['split_cat'], $forum_moderators, -1, -1, $keys);
    // constants
    $template->assign_vars(array(
                'L_FORUM' => $lang['Forum'],
                'L_TOPICS' => $lang['Topics'],
                'L_POSTS' => $lang['Posts'],
                'L_LASTPOST' => $lang['Last_Post'])
    );
    $template->assign_vars(array(
                'SPACER'    => $images['spacer'],
                'NAV_SEPARATOR' => $nav_separator,
                'NAV_CAT_DESC'  => $nav_cat_desc)
    );
    if ($display) {
        $template->assign_var_from_handle('BOARD_INDEX', 'index');
    }
    return $display;
}

//--------------------------------------------------------------------------------------------------
//
// make_cat_nav_tree() : build the nav sentence
//
//--------------------------------------------------------------------------------------------------
function make_cat_nav_tree($cur, $pgm='', $nav_class='nav') {
    global $db, $nav_separator, $tree;

    // get topic or post level
    $type = substr($cur, 0, 1);
    $needle = strpos($cur, '#');
    if ($needle > 1) {
        $id = intval(substr($cur,1, $needle));
        $cur = substr($cur, 0, $needle);
    } else {
        $id = intval(substr($cur,1));
    }
    $topic_title = '';
    $fcur = '';
    switch ($type) {
        case POST_TOPIC_URL:
            $sql = "SELECT forum_id, topic_title FROM " . TOPICS_TABLE . " WHERE topic_id = $id";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not query topics information', '', __LINE__, __FILE__, $sql);
            }
            if ($row = $db->sql_fetchrow($result)) {
                $fcur = POST_FORUM_URL . $row['forum_id'];
                $topic_title = smilies_pass(check_words($row['topic_title']));
            }
            $db->sql_freeresult($result);
            break;
        case POST_POST_URL:
            $sql = "SELECT t.forum_id, t.topic_title FROM " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t 
                    WHERE t.topic_id=p.topic_id AND p.post_id = $id";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not query posts information', '', __LINE__, __FILE__, $sql);
            }
            if ($row = $db->sql_fetchrow($result)) {
                $fcur = POST_FORUM_URL . $row['forum_id'];
                $topic_title = smilies_pass(check_words($row['topic_title']));
            }
            $db->sql_freeresult($result);
            break;
    }
    // keep the compliancy with prec versions
    if (!isset($tree['keys'][$cur])) {
        $cur = isset($tree['keys'][POST_CAT_URL . $cur]) ? POST_CAT_URL . $cur : $cur;
    }
    // find the object
    $this_var = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;
    $res = '';
    while (($this_var >= 0) || ($fcur != '')) {
        $type = (substr($fcur, 0, 1) != '') ? substr($cur, 0, 1) : $tree['type'][$this_var];
        switch($type) {
            case POST_CAT_URL:
                $field_name   = get_object_lang($cur, 'name');
                $param_type   = POST_CAT_URL;
                $param_value  = $tree['id'][$this_var];
                $pgm_name   = 'index.php';
                break;
            case POST_FORUM_URL:
                $field_name   = get_object_lang($cur, 'name');
                $param_type   = POST_FORUM_URL;
                $param_value  = $tree['id'][$this_var];
                $pgm_name   = 'viewforum.php';
                break;
            case POST_TOPIC_URL:
                $field_name   = $topic_title;
                $param_type   = POST_TOPIC_URL;
                $param_value  = $id;
                $pgm_name   = 'viewtopic.php';
                break;
            case POST_POST_URL:
                $field_name   = $topic_title;
                $param_type   = POST_POST_URL;
                $param_value  = $id . '#' . $id;
                $pgm_name   = 'viewtopic.php';
                break;
            default :
                $field_name   = '';
                $param_type   = '';
                $param_value  = '';
                $pgm_name   = 'index.php';
                break;
        }
        if ($pgm != '') {
            $pgm_name = $pgm.'.php';
        }
        if (!empty($field_name) && !defined('FORUM_ADMIN')) {
            $res = '<a href="' . append_sid($pgm_name . (($field_name != '') ? "?$param_type=$param_value" : '')) . '" class="' . $nav_class . '">' . $field_name . '</a>' . (($res != '') ? $nav_separator . $res : '');
        } elseif (!empty($field_name) && defined('FORUM_ADMIN')) {
            $res = '<a href="' . admin_sid($pgm_name . (($field_name != '') ? "?$param_type=$param_value" : '')) . '" class="' . $nav_class . '">' . $field_name . '</a>' . (($res != '') ? $nav_separator . $res : '');
        }
        // find parent object
        if ($fcur != '') {
            $cur  = $fcur;
            $pgm  = '';
            $fcur = '';
            $topic_title = '';
        } else {
            $cur = $tree['main'][$this_var];
        }
        $this_var = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;
    }
    return $res;
}


//--------------------------------------------------------------------------------------------------
//
// jumpbox() : replace the original phpBB make_jumpbox()
//
//--------------------------------------------------------------------------------------------------
function jumpbox($action, $match_forum_id = 0) {
    global $template, $userdata, $lang, $db, $nav_links, $SID;
    global $links;

    // build the jumpbox
    $boxstring  = '<select name="selected_id" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }">';
    $boxstring .= '<option value="-1">' . $lang['Select_forum'] . '</option><option value="-1">&nbsp;</option>' . get_tree_option(POST_FORUM_URL . $match_forum_id);
    $boxstring .= '</select>';
    // add SID if missing
    if ( !empty($SID) ) {
        $boxstring .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
    }
    // dump this to template
    $template->set_filenames(array(
            'jumpbox' => 'jumpbox.tpl')
    );
    $template->assign_vars(array(
            'L_GO' => $lang['Go'],
            'L_JUMP_TO' => $lang['Jump_to'],
            'L_SELECT_FORUM' => $lang['Select_forum'],
            'S_JUMPBOX_SELECT' => $boxstring,
            'S_JUMPBOX_ACTION' => append_sid($action))
    );
    $template->assign_var_from_handle('JUMPBOX', 'jumpbox');
    return;
}

//--------------------------------------------------------------------------------------------------
//
// selectbox() : replace the original phpBB function_admin/make_forum_select()
//
//--------------------------------------------------------------------------------------------------
function selectbox($box_name, $ignore_forum = FALSE, $select_forum = '', $all=FALSE) {
    $s_id = ($select_forum != '') ? POST_FORUM_URL . $select_forum : '';
    $s_list = get_tree_option($select_forum, $all);
    $res = '<select name="' . $box_name . '">' . $s_list . '</select>';
    return $res;
}

?>