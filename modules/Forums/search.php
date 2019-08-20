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

if (!defined('MODULE_FILE') ) {
   die('You can\'t access this file directly...');
}

define('IN_PHPBB', TRUE);
global $_GETVAR, $lang;

$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

include($phpbb_root_path . 'common.php');
include_once(NUKE_INCLUDE_DIR.'bbcode.php');
include_once(NUKE_INCLUDE_DIR.'functions_search.php');

// Start session management
$userdata = session_pagestart($user_ip, PAGE_SEARCH);
init_userprefs($userdata);
// End session management

// Define initial vars
$mode             = $_GETVAR->get('mode', 'request', 'string', '');
$search_keywords  = $_GETVAR->get('search_keywords', 'request', 'string', '');
$search_author    = phpbb_clean_username($_GETVAR->get('search_author', 'request', 'string', ''));
$search_id        = $_GETVAR->get('search_id', 'get', 'string', '');
$show_results     = $_GETVAR->get('show_results', 'post', 'string', 'posts');
$show_results     = ($show_results == 'topics') ? 'topics' : 'posts';
$search_terms     = $_GETVAR->get('search_terms', 'post', 'string', NULL) ? (( $_GETVAR->get('search_terms', 'post', 'string', NULL) == 'all' ) ? 1 : 0 ) : 0;
$search_fields    = $_GETVAR->get('search_fields', 'post', 'string', NULL) ? (( $_GETVAR->get('search_fields', 'post', 'string', NULL) == 'all' ) ? 1 : (( $_GETVAR->get('search_fields', 'post', 'string', NULL) == 'subonly' ) ? 2 : 0)) : 0;
$return_chars     = $_GETVAR->get('return_chars', 'post', 'int', 200);
$search_where     =  $_GETVAR->get('search_where', 'post', 'string', 'Root');
$group_id         = $_GETVAR->get('group_id', 'get', 'int', NULL);

if ( ((!is_user() && !is_admin()) && $board_config['search_disable_security_code'] == 1) && ( $search_id || $search_keywords != '' || $search_author != '' || $mode == 'searchuser' ) ) {
    if ( (!security_code_check($_POST['gfx_check'], 'force')) && (!is_user() && !is_admin()) ) {
        message_die(GENERAL_ERROR, $lang['Wrong Security Code']);
    }
}

$sort_by          = $_GETVAR->get('sort_by', 'post', 'int', 0);
$sort_dir         = ($_GETVAR->get('sort_dir', 'post', 'string') == 'ASC') ? 'ASC' : 'DESC';
$search_time      = $topic_days = $_GETVAR->get('search_time', 'request', 'int', 0);
if ($search_time > 0) {
  $search_time = time() - ( $search_time * 86400 );
}

$start = $_GETVAR->get('start', 'get', 'int', 0);
$start = ($start < 0) ? 0 : $start;

$sort_by_types = array($lang['Sort_Time'], $lang['Sort_Post_Subject'], $lang['Sort_Topic_Title'], $lang['Sort_Author'], $lang['Sort_Forum']);

// encoding match for workaround
$multibyte_charset = 'utf-8, big5, shift_jis, euc-kr, gb2312';

// Begin core code
if ( $mode == 'searchuser' ) {
    // This handles the simple windowed user search functions called from various other scripts
    if ( $_GETVAR->get('search_username', 'post', 'string', NULL) ) {
        username_search(phpbb_clean_username($_GETVAR->get('search_username', 'post', 'string')), $group_id);
    } else {
        username_search('', $group_id);
    }
    exit;
} else if ( $search_keywords != '' || $search_author != '' || $search_id ) {
    $store_vars = array('search_results', 'total_match_count', 'split_search', 'sort_by', 'sort_dir', 'show_results', 'return_chars');
    $search_results = '';

    // Search ID Limiter, decrease this value if you experience further timeout problems with searching forums
    $limiter = 5000;
    $current_time = time();

    // Cycle through options ...
    if ( $search_id == 'newposts' || $search_id == 'egosearch' || $search_id == 'unanswered' || $search_keywords != '' || $search_author != '' ) {
        // Flood control
        $where_sql = ($userdata['user_id'] == ANONYMOUS || empty($userdata['user_id'])) ? "se.host_addr = '$user_ip'" : 'se.uname = "' . $userdata['username'].'"';
        $sql = 'SELECT MAX(sr.search_time) AS last_search_time
                FROM (' . SEARCH_TABLE . ' sr, ' . SESSIONS_TABLE . ' se)
                WHERE sr.session_id = se.session_id
                AND '.$where_sql;
        if ($result = $db->sql_query($sql)) {
            if ($row = $db->sql_fetchrow($result)) {
                if (intval($row['last_search_time']) > 0 && ($current_time - intval($row['last_search_time'])) < intval($board_config['search_flood_interval'])) {
                    message_die(GENERAL_MESSAGE, $lang['Search_Flood_Error']);
                }
            }
        }
        if ( $search_id == 'newposts' || $search_id == 'egosearch' || ( $search_author != '' && $search_keywords == '' )  ) {
            if ( $search_id == 'newposts' ) {
                if ( $userdata['session_logged_in'] ) {
                    $sql = "SELECT post_id
                            FROM " . POSTS_TABLE . "
                            WHERE post_time >= " . $userdata['user_lastvisit'];
                } else {
                    redirect(append_sid('login.php?redirect=search.php&amp;search_id=newposts', TRUE));
                }
                $show_results = 'topics';
                $sort_by = 0;
                $sort_dir = 'DESC';
            } else if ( $search_id == 'egosearch' ) {
                if ( $userdata['session_logged_in'] ) {
                    $sql = "SELECT post_id
                            FROM " . POSTS_TABLE . "
                            WHERE poster_id = " . $userdata['user_id'];
                } else {
                    redirect(append_sid('login.php?redirect=search.php&amp;search_id=egosearch', TRUE));
                }
                $show_results = 'topics';
                $sort_by = 0;
                $sort_dir = 'DESC';
            } else {
                $search_author = str_replace('*', '%', trim($search_author));
                if( ( strpos($search_author, '%') !== FALSE ) && ( strlen(str_replace('%', '', $search_author)) < $board_config['search_min_chars'] ) ) {
                    $search_author = '';
                }
                $sql = "SELECT user_id
                        FROM " . USERS_TABLE . "
                        WHERE username LIKE '" . str_replace("\'", "''", $search_author) . "'";
                if ( !($result = $db->sql_query($sql)) ) {
                    message_die(GENERAL_ERROR, "Couldn't obtain list of matching users (searching for: $search_author)", "", __LINE__, __FILE__, $sql);
                }
                $matching_userids = '';
                if ( $row = $db->sql_fetchrow($result) ) {
                    do {
                        $matching_userids .= ( ( $matching_userids != '' ) ? ', ' : '' ) . $row['user_id'];
                    } while( $row = $db->sql_fetchrow($result) );
                } else {
                    message_die(GENERAL_MESSAGE, $lang['No_search_match']);
                }
                $sql = "SELECT post_id
                        FROM " . POSTS_TABLE . "
                        WHERE poster_id IN ($matching_userids)";
                if ($search_time) {
                    $sql .= " AND post_time >= " . $search_time;
                }
            }
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain matched posts list', '', __LINE__, __FILE__, $sql);
            }
            $search_ids = array();
            while( $row = $db->sql_fetchrow($result) ) {
                $search_ids[] = $row['post_id'];
            }
            $db->sql_freeresult($result);
            $total_match_count = count($search_ids);
        } else if ( $search_keywords != '' ) {
            $stopword_array = @file($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/search_stopwords.txt');
            $synonym_array = @file($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/search_synonyms.txt');
            $split_search = array();
            $stripped_keywords = stripslashes($search_keywords);
            $split_search = ( !strstr($multibyte_charset, $lang['ENCODING']) ) ?  split_words(clean_words('search', $stripped_keywords, $stopword_array, $synonym_array), 'search') : split(' ', $search_keywords);
            unset($stripped_keywords);
            switch ($search_fields) {
                case 0: 
                    $search_msg_only = "AND m.title_match = 0";
                    break;
                case 1: 
                    $search_msg_only = "";
                    break;
                case 2: 
                    $search_msg_only = "AND m.title_match > 0";
                    break;
                default:
                    $search_msg_only = "AND m.title_match = 0";
                    break;
            }
            $word_count = 0;
            $current_match_type = 'or';
            $word_match = array();
            $result_list = array();
            for($i = 0; $i < count($split_search); $i++) {
                if ( strlen(str_replace(array('*', '%'), '', trim($split_search[$i]))) < 3 ) {
                    $split_search[$i] = '';
                    continue;
                }
                switch ( $split_search[$i] ) {
                    case 'and':
                        $current_match_type = 'and';
                        break;
                    case 'or':
                        $current_match_type = 'or';
                        break;
                    case 'not':
                        $current_match_type = 'not';
                        break;
                    default:
                        if ( !empty($search_terms) ) {
                            $current_match_type = 'and';
                        }
                        if ( !strstr($multibyte_charset, $lang['ENCODING']) ) {
                            $match_word = str_replace('*', '%', $split_search[$i]);
                            $sql = "SELECT m.post_id
                                    FROM " . SEARCH_WORD_TABLE . " w, " . SEARCH_MATCH_TABLE . " m
                                    WHERE w.word_text LIKE '$match_word'
                                    AND m.word_id = w.word_id
                                    AND w.word_common <> '1'
                                    $search_msg_only";
                        } else {
                            $match_word =  addslashes('%' . str_replace('*', '', $split_search[$i]) . '%');
                            $search_msg_only = ( $search_fields ) ? "OR post_subject LIKE '$match_word'" : '';
                            $sql = "SELECT post_id
                                FROM " . POSTS_TEXT_TABLE . "
                                WHERE post_text LIKE '$match_word'
                                $search_msg_only";
                        }
                        if ( !($result = $db->sql_query($sql)) ) {
                            message_die(GENERAL_ERROR, 'Could not obtain matched posts list', '', __LINE__, __FILE__, $sql);
                        }
                        $row = array();
                        while( $temp_row = $db->sql_fetchrow($result) ) {
                            $row[$temp_row['post_id']] = 1;
                            if ( !$word_count ) {
                                $result_list[$temp_row['post_id']] = 1;
                            } else if ( $current_match_type == 'or' ) {
                                $result_list[$temp_row['post_id']] = 1;
                            } else if ( $current_match_type == 'not' ) {
                                $result_list[$temp_row['post_id']] = 0;
                            }
                        }
                        if ( $current_match_type == 'and' && $word_count ) {
                            @reset($result_list);
                            while( list($post_id, $match_count) = @each($result_list) ) {
                                if ( !$row[$post_id] ) {
                                    $result_list[$post_id] = 0;
                                }
                            }
                        }
                        $word_count++;
                        $db->sql_freeresult($result);
                        break;
                    }
            }
            @reset($result_list);
            $search_ids = array();
            while( list($post_id, $matches) = each($result_list) ) {
                if ( $matches ) {
                    $search_ids[] = $post_id;
                }
            }
            unset($result_list);
            $total_match_count = count($search_ids);
        }
        // If user is logged in then we'll check to see which (if any) private
        // forums they are allowed to view and include them in the search.
        //
        // If not logged in we explicitly prevent searching of private forums
        $auth_sql = '';
        // get the object list
        $keys = array();
        $keys = get_auth_keys($search_where, TRUE, -1, -1, 'auth_read');
        $s_flist = '';
        for ($i=0, $max = count($keys['id']); $i < $max; $i++) {
            if ( isset($tree['type'][ $keys['idx'][$i] ]) && ($tree['type'][ $keys['idx'][$i] ] == POST_FORUM_URL) && $tree['auth'][ $keys['id'][$i] ]['auth_read'] ) {
                $s_flist .= (($s_flist != '') ? ', ' : '') . $tree['id'][ $keys['idx'][$i] ];
            }
        }
        if ($s_flist != '') {
            $auth_sql .= (( $auth_sql != '' ) ? " AND" : '') . " f.forum_id IN ($s_flist) ";
        }
        // Author name search
        if ( $search_author != '' ) {
            $search_author = str_replace('*', '%', trim($search_author));
            if( ( strpos($search_author, '%') !== FALSE ) && ( strlen(str_replace('%', '', $search_author)) < $board_config['search_min_chars'] ) ) {
                $search_author = '';
            }
        }
        if ( $total_match_count ) {
            if ( $show_results == 'topics' ) {
                // This one is a beast, try to seperate it a bit (workaround for connection timeouts)
                $search_id_chunks = array();
                $count = 0;
                $chunk = 0;
                if (count($search_ids) > $limiter) {
                    for ($i = 0; $i < count($search_ids); $i++) {
                        if ($count == $limiter) {
                            $chunk++;
                            $count = 0;
                        }
                        $search_id_chunks[$chunk][$count] = $search_ids[$i];
                        $count++;
                    }
                } else {
                    $search_id_chunks[0] = $search_ids;
                }
                $search_ids = array();
                for ($i = 0; $i < count($search_id_chunks); $i++) {
                    $where_sql = '';
                    if ( $search_time ) {
                        $where_sql .= ( $search_author == '' && $auth_sql == ''  ) ? " AND post_time >= '$search_time' " : " AND p.post_time >= '$search_time' ";
                    }
                    if ( $search_author == '' && $auth_sql == '' ) {
                        $sql = "SELECT topic_id
                                FROM " . POSTS_TABLE . "
                                WHERE post_id IN (" . implode(", ", $search_id_chunks[$i]) . ")
                                $where_sql
                                GROUP BY topic_id";
                    } else {
                        $from_sql = POSTS_TABLE . " p";
                        if ( $search_author != '' ) {
                            $from_sql .= ", " . USERS_TABLE . " u";
                            $where_sql .= " AND u.user_id = p.poster_id AND u.username LIKE '$search_author' ";
                        }
                        if ( $auth_sql != '' ) {
                            $from_sql .= ", " . FORUMS_TABLE . " f";
                            $where_sql .= " AND f.forum_id = p.forum_id AND $auth_sql";
                        }
                        $sql = "SELECT p.topic_id
                                FROM $from_sql
                                WHERE p.post_id IN (" . implode(", ", $search_id_chunks[$i]) . ")
                                $where_sql
                                GROUP BY p.topic_id";
                    }
                    if ( !($result = $db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, 'Could not obtain topic ids', '', __LINE__, __FILE__, $sql);
                    }
                    while ($row = $db->sql_fetchrow($result)) {
                        $search_ids[] = $row['topic_id'];
                    }
                    $db->sql_freeresult($result);
                }
                $total_match_count = count($search_ids);
            } else if ( $search_author != '' || $search_time || $auth_sql != '' ) {
                $search_id_chunks = array();
                $count = 0;
                $chunk = 0;
                if (count($search_ids) > $limiter) {
                    for ($i = 0; $i < count($search_ids); $i++) {
                        if ($count == $limiter) {
                            $chunk++;
                            $count = 0;
                        }
                        $search_id_chunks[$chunk][$count] = $search_ids[$i];
                        $count++;
                    }
                } else {
                    $search_id_chunks[0] = $search_ids;
                }
                $search_ids = array();
                for ($i = 0; $i < count($search_id_chunks); $i++) {
                    $where_sql = ( $search_author == '' && $auth_sql == '' ) ? 'post_id IN (' . implode(', ', $search_id_chunks[$i]) . ')' : 'p.post_id IN (' . implode(', ', $search_id_chunks[$i]) . ')';
                    $select_sql = ( $search_author == '' && $auth_sql == '' ) ? 'post_id' : 'p.post_id';
                    $from_sql = (  $search_author == '' && $auth_sql == '' ) ? POSTS_TABLE : POSTS_TABLE . ' p';
                    if ( $search_time ) {
                        $where_sql .= ( $search_author == '' && $auth_sql == '' ) ? " AND post_time >= $search_time " : " AND p.post_time >= $search_time";
                    }
                    if ( $auth_sql != '' ) {
                        $from_sql .= ", " . FORUMS_TABLE . " f";
                        $where_sql .= " AND f.forum_id = p.forum_id AND $auth_sql";
                    }
                    if ( $search_author != '' ) {
                        $from_sql .= ", " . USERS_TABLE . " u";
                        $where_sql .= " AND u.user_id = p.poster_id AND u.username LIKE '$search_author'";
                    }
                    $sql = "SELECT " . $select_sql . "
                            FROM ($from_sql)
                            WHERE $where_sql";
                    if ( !($result = $db->sql_query($sql)) ) {
                        message_die(GENERAL_ERROR, 'Could not obtain post ids', '', __LINE__, __FILE__, $sql);
                    }
                    while( $row = $db->sql_fetchrow($result) ) {
                        $search_ids[] = $row['post_id'];
                    }
                    $db->sql_freeresult($result);
                }
                $total_match_count = count($search_ids);
            }
        } else if ( $search_id == 'unanswered' ) {
            if ( $auth_sql != '' ) {
                $sql = "SELECT t.topic_id, f.forum_id
                        FROM (" . TOPICS_TABLE . "  t, " . FORUMS_TABLE . " f)
                        WHERE t.topic_replies = '0'
                        AND t.forum_id = f.forum_id
                        AND t.topic_moved_id = '0'
                        AND $auth_sql";
            } else {
               $sql = "SELECT topic_id
                       FROM " . TOPICS_TABLE . "
                       WHERE topic_replies = '0'
                       AND topic_moved_id = '0'";
            }
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain post ids', '', __LINE__, __FILE__, $sql);
            }
            $search_ids = array();
            while( $row = $db->sql_fetchrow($result) ) {
                $search_ids[] = $row['topic_id'];
            }
            $db->sql_freeresult($result);
            $total_match_count = count($search_ids);
            // Basic requirements
            $show_results = 'topics';
            $sort_by = 0;
            $sort_dir = 'DESC';
        } else {
            message_die(GENERAL_MESSAGE, $lang['No_search_match']);
        }
        // Delete old data from the search result table
        $sql = 'DELETE FROM ' . SEARCH_TABLE . '
                WHERE search_time < ' . ($current_time - (int) $board_config['session_length']);
        if ( !$result = $db->sql_query($sql) ) {
          message_die(GENERAL_ERROR, 'Could not delete old search id sessions', '', __LINE__, __FILE__, $sql);
        }
        // Store new result data
        $search_results = implode(', ', $search_ids);
        $per_page = ( $show_results == 'posts' ) ? $board_config['posts_per_page'] : $board_config['topics_per_page'];
        // Combine both results and search data (apart from original query)
        // so we can serialize it and place it in the DB
        $store_search_data = array();
        // Limit the character length (and with this the results displayed at all following pages) to prevent
        // truncated result arrays. Normally, search results above 12000 are affected.
        // - to include or not to include
        for($i = 0; $i < count($store_vars); $i++) {
            if (isset($$store_vars[$i])) {
                $store_search_data[$store_vars[$i]] = $$store_vars[$i];
            }
        }
        $result_array = serialize($store_search_data);
        unset($store_search_data);
        mt_srand ((double) microtime() * 1000000);
        $search_id = mt_rand();
        $sql = "UPDATE " . SEARCH_TABLE . "
                SET search_id = $search_id, search_time = $current_time, search_array = '" . str_replace("\'", "''", $result_array) . "'
                WHERE session_id = '" . $userdata['session_id'] . "'";
        if ( !($result = $db->sql_query($sql)) || !$db->sql_affectedrows() ) {
          $sql = "INSERT INTO " . SEARCH_TABLE . " (search_id, session_id, search_time, search_array)
                  VALUES($search_id, '" . $userdata['session_id'] . "', $current_time, '" . str_replace("\'", "''", $result_array) . "')";
          if ( !($result = $db->sql_query($sql)) ) {
              message_die(GENERAL_ERROR, 'Could not insert search results', '', __LINE__, __FILE__, $sql);
          }
       }
    } else {
        $search_id = intval($search_id);
        if ( $search_id ) {
            $sql = "SELECT search_array
                    FROM " . SEARCH_TABLE . "
                    WHERE search_id = '$search_id'";
            if ( !($result = $db->sql_query($sql)) ) {
                message_die(GENERAL_ERROR, 'Could not obtain search results', '', __LINE__, __FILE__, $sql);
            }
            if ( $row = $db->sql_fetchrow($result) ) {
                $search_data = unserialize($row['search_array']);
                if (is_array($search_data)) {
                    $counti = count($search_data);
                    for($i = 0, $max = $counti; $i < $max; $i++) {
                        $$store_vars[$i] = $search_data[$store_vars[$i]];
                    }
                }
            }
        }
    }
    // Look up data ...
    if ( $search_results != '' ) {
        if ( $show_results == 'posts' ) {
           $sql = "SELECT pt.post_text, pt.bbcode_uid, pt.post_subject, p.*, f.forum_id, f.forum_name, t.*, u.username, u.user_id, u.user_color_gc, u.user_sig, u.user_sig_bbcode_uid
                   FROM (" . FORUMS_TABLE . " f, " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TEXT_TABLE . " pt)
                   WHERE p.post_id IN ($search_results)
                   AND pt.post_id = p.post_id
                   AND f.forum_id = p.forum_id
                   AND p.topic_id = t.topic_id
                   AND p.poster_id = u.user_id";
        } else {
          $sql = "SELECT t.*, f.forum_id, f.forum_name, u.username, u.user_id, u.user_color_gc as color1, u2.user_color_gc as color2, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time
                  FROM (" . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2)
                  WHERE t.topic_id IN ($search_results)
                  AND t.topic_poster = u.user_id
                  AND f.forum_id = t.forum_id
                  AND p.post_id = t.topic_first_post_id
                  AND p2.post_id = t.topic_last_post_id
                  AND u2.user_id = p2.poster_id";
        }
        $per_page = ( $show_results == 'posts' ) ? $board_config['posts_per_page'] : $board_config['topics_per_page'];
        $sql .= " ORDER BY ";
        switch ( $sort_by ) {
            case 1:
                $sql .= ( $show_results == 'posts' ) ? 'pt.post_subject' : 't.topic_title';
                break;
            case 2:
                $sql .= 't.topic_title';
                break;
            case 3:
                $sql .= 'u.username';
                break;
            case 4:
                $sql .= 'f.forum_id';
                break;
            default:
                $sql .= ( $show_results == 'posts' ) ? 'p.post_time' : 'p2.post_time';
                break;
        }
        $sql .= " $sort_dir LIMIT $start, " . $per_page;
        if ( !$result = $db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, 'Could not obtain search results', '', __LINE__, __FILE__, $sql);
        }
        $searchset = array();
        while( $row = $db->sql_fetchrow($result) ) {
            $searchset[] = $row;
        }
        $db->sql_freeresult($result);
        // Define censored word matches
        $orig_word = array();
        $replacement_word = array();
        obtain_word_list($orig_word, $replacement_word);
        // Output header
        $page_title = $lang['Search'];
        include_once(NUKE_INCLUDE_DIR.'page_header.php');
        if ( $show_results == 'posts' ) {
            $template->set_filenames(array(
                'body' => 'search_results_posts.tpl')
            );
        } else {
            $template->set_filenames(array(
                'body' => 'search_results_topics.tpl')
            );
        }
        make_jumpbox('viewforum.php');
        $l_search_matches = ( $total_match_count == 1 ) ? sprintf($lang['Found_search_match'], $total_match_count) : sprintf($lang['Found_search_matches'], $total_match_count);
        $template->assign_vars(array(
            'L_SEARCH_MATCHES' => $l_search_matches,
            'L_TOPIC'          => $lang['Topic'])
        );
        $highlight_active = '';
        $highlight_match = array();
        if (!isset($split_search) || !is_array($split_search)) {
            $split_search = array();
        }
        for($j = 0; $j < count($split_search); $j++ ) {
            $split_word = $split_search[$j];
            if ( $split_word != 'and' && $split_word != 'or' && $split_word != 'not' ) {
                $highlight_match[] = '#\b(' . str_replace("*", "([\w]+)?", $split_word) . ')\b#is';
                $highlight_active .= " " . $split_word;
                for ($k = 0; $k < count($synonym_array); $k++) {
                    list($replace_synonym, $match_synonym) = split(' ', trim(strtolower($synonym_array[$k])));
                    if ( $replace_synonym == $split_word ) {
                        $highlight_match[] = '#\b(' . str_replace("*", "([\w]+)?", $replace_synonym) . ')\b#is';
                        $highlight_active .= ' ' . $match_synonym;
                    }
                }
            }
        }
        $highlight_active = urlencode(trim($highlight_active));
        $tracking_topics = evo_getcookie($board_config['cookie_name'] . '_t') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_t')) : array();
        $tracking_forums = evo_getcookie($board_config['cookie_name'] . '_f') ? unserialize(evo_getcookie($board_config['cookie_name'] . '_f')) : array();
        for($i = 0; $i < count($searchset); $i++) {
            $forum_url = (isset($searchset[$i]['forum_id']) ? "modules.php?name=Forums&amp;file=viewforum&amp;" . POST_FORUM_URL . "=" . $searchset[$i]['forum_id'] . "" : '');
            $topic_url = (isset($searchset[$i]['topic_id']) ? "modules.php?name=Forums&amp;file=viewtopic&amp;" . POST_TOPIC_URL . "=" . $searchset[$i]['topic_id'] . "&amp;highlight=$highlight_active" : '');
            $post_url  = (isset($searchset[$i]['post_id'])  ? "modules.php?name=Forums&amp;file=viewtopic&amp;" . POST_POST_URL . "=" . $searchset[$i]['post_id'] . "&amp;highlight=$highlight_active#" . $searchset[$i]['post_id'] . "" : '');
            $post_date = (isset($searchset[$i]['post_time']) ? (create_date($board_config['default_dateformat'], $searchset[$i]['post_time'], $board_config['board_timezone'])) : '');
            $message   = (isset($searchset[$i]['post_text']) ? $searchset[$i]['post_text'] : '');
            $topic_title = (isset($searchset[$i]['topic_title']) ? (($board_config['smilies_in_titles']) ? smilies_pass($searchset[$i]['topic_title']) : $searchset[$i]['topic_title']) : '');
            $forum_id  = (isset($searchset[$i]['forum_id']) ? $searchset[$i]['forum_id'] : '');
            $topic_id  = (isset($searchset[$i]['topic_id']) ? $searchset[$i]['topic_id'] : '');
            if ( $show_results == 'posts' ) {
                if ( isset($return_chars) ) {
                    $bbcode_uid = $searchset[$i]['bbcode_uid'];
                    // If the board has HTML off but the post has HTML
                    // on then we process it, else leave it alone
                    if ( $return_chars != -1 ) {
                        $message = strip_tags($message);
                        $message = preg_replace("/\[.*?:$bbcode_uid:?.*?\]/si", '', $message);
                        $message = preg_replace('/\[url\]|\[\/url\]/si', '', $message);
                        $message = ( strlen($message) > $return_chars ) ? substr($message, 0, $return_chars) . ' ...' : $message;
                    } else {
                        if ( !$board_config['allow_html'] ) {
                            if ( $postrow[$i]['enable_html'] ) {
                                $message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\\2&gt;', $message);
                            }
                        }
                        if ( $bbcode_uid != '' ) {
                            $message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
                        }
                        $message = make_clickable($message);
                        if ( $highlight_active ) {
                            if ( preg_match('/<.*>/', $message) ) {
                                $message = preg_replace($highlight_match, '<!-- #sh -->\1<!-- #eh -->', $message);
                                $end_html = 0;
                                $start_html = 1;
                                $temp_message = '';
                                $message = ' ' . $message . ' ';
                                while( $start_html = strpos($message, '<', $start_html) ) {
                                    $grab_length = $start_html - $end_html - 1;
                                    $temp_message .= substr($message, $end_html + 1, $grab_length);
                                    if ( $end_html = strpos($message, '>', $start_html) ) {
                                        $length = $end_html - $start_html + 1;
                                        $hold_string = substr($message, $start_html, $length);
                                        if ( strrpos(' ' . $hold_string, '<') != 1 ) {
                                            $end_html = $start_html + 1;
                                            $end_counter = 1;
                                            while ( $end_counter && $end_html < strlen($message) ) {
                                                if ( substr($message, $end_html, 1) == '>' ) {
                                                    $end_counter--;
                                                } else if ( substr($message, $end_html, 1) == '<' ) {
                                                    $end_counter++;
                                                }
                                                $end_html++;
                                            }
                                            $length = $end_html - $start_html + 1;
                                            $hold_string = substr($message, $start_html, $length);
                                            $hold_string = str_replace('<!-- #sh -->', '', $hold_string);
                                            $hold_string = str_replace('<!-- #eh -->', '', $hold_string);
                                        } else if ( $hold_string == '<!-- #sh -->' ) {
                                            $hold_string = str_replace('<!-- #sh -->', '<span style="color:#' . $theme['fontcolor3'] . '"><strong>', $hold_string);
                                        } else if ( $hold_string == '<!-- #eh -->' ) {
                                            $hold_string = str_replace('<!-- #eh -->', '</strong></span>', $hold_string);
                                        }
                                        $temp_message .= $hold_string;
                                        $start_html += $length;
                                    } else {
                                        $start_html = strlen($message);
                                    }
                                }
                                $grab_length = strlen($message) - $end_html - 1;
                                $temp_message .= substr($message, $end_html + 1, $grab_length);
                                $message = trim($temp_message);
                            } else {
                                $message = preg_replace($highlight_match, '<span style="color:#' . $theme['fontcolor3'] . '"><strong>\1</strong></span>', $message);
                            }
                        }
                    }
                    if ( count($orig_word) ) {
                        $topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
                        $post_subject = ( $searchset[$i]['post_subject'] != "" ) ? preg_replace($orig_word, $replacement_word, $searchset[$i]['post_subject']) : $topic_title;
                        $message = preg_replace($orig_word, $replacement_word, $message);
                    } else {
                        $post_subject = ( $searchset[$i]['post_subject'] != '' ) ? $searchset[$i]['post_subject'] : $topic_title;
                    }
                    if ($board_config['allow_smilies'] && $searchset[$i]['enable_smilies']) {
                        $message = smilies_pass($message);
                    }
                    $message = str_replace("\n", '<br />', $message);
                }
                $poster = ( $searchset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $searchset[$i]['user_id']) . '">' : '';
                $poster .= ( $searchset[$i]['user_id'] != ANONYMOUS ) ? UsernameColor($searchset[$i]['user_color_gc'], $searchset[$i]['username']) : ( ( UsernameColor($searchset[$i]['user_color_gc'], $searchset[$i]['post_username']) != "" ) ? UsernameColor($searchset[$i]['user_color_gc'], $searchset[$i]['post_username']) : $lang['Guest'] );
                $poster .= ( $searchset[$i]['user_id'] != ANONYMOUS ) ? '</a>' : '';
                if ( $userdata['session_logged_in'] && $searchset[$i]['post_time'] > $userdata['user_lastvisit'] ) {
                    if ( !empty($tracking_topics[$topic_id]) && !empty($tracking_forums[$forum_id]) ) {
                        $topic_last_read = ( $tracking_topics[$topic_id] > $tracking_forums[$forum_id] ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
                    } else if ( !empty($tracking_topics[$topic_id]) || !empty($tracking_forums[$forum_id]) ) {
                        $topic_last_read = ( !empty($tracking_topics[$topic_id]) ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
                    }
                    if ( $searchset[$i]['post_time'] > $topic_last_read ) {
                        $mini_post_img = $images['icon_minipost_new'];
                        $mini_post_alt = $lang['New_post'];
                    } else {
                        $mini_post_img = $images['icon_minipost'];
                        $mini_post_alt = $lang['Post'];
                    }
                } else {
                    $mini_post_img = $images['icon_minipost'];
                    $mini_post_alt = $lang['Post'];
                }
                /*--FNA #1--*/
                $template->assign_block_vars("searchresults", array(
                    'TOPIC_TITLE'   => $topic_title,
                    'FORUM_NAME'    => get_object_lang(POST_FORUM_URL . $searchset[$i]['forum_id'], 'name'),
                    'POST_SUBJECT'  => $post_subject,
                    'POST_DATE'     => $post_date,
                    'POSTER_NAME'   => $poster,
                    'TOPIC_REPLIES' => $searchset[$i]['topic_replies'],
                    'TOPIC_VIEWS'   => $searchset[$i]['topic_views'],
                    'MESSAGE'       => $message,
                    'MINI_POST_IMG' => $mini_post_img,
                    'FOLDER_IMG'    => $images['folder'],
                    'L_MINI_POST_ALT' => $mini_post_alt,
                    'U_POST'        => $post_url,
                    'U_TOPIC'       => $topic_url,
                    'U_FORUM'       => $forum_url)
                );
            } else {
                $message = '';
                if ( count($orig_word) ) {
                    $topic_title = preg_replace($orig_word, $replacement_word, $searchset[$i]['topic_title']);
                }
                $topic_type = $searchset[$i]['topic_type'];
                if($topic_type == POST_GLOBAL_ANNOUNCE ) {
                   $topic_type = $lang['Topic_global_announcement'] . " ";
                } else if ($topic_type == POST_ANNOUNCE) {
                    $topic_type = $lang['Topic_Announcement'] . ' ';
                } else if ($topic_type == POST_STICKY) {
                    $topic_type = $lang['Topic_Sticky'] . ' ';
                } else {
                    $topic_type = '';
                }
                if ( $searchset[$i]['topic_vote'] ) {
                    $topic_type .= $lang['Topic_Poll'] . ' ';
                }
                $views = $searchset[$i]['topic_views'];
                $replies = $searchset[$i]['topic_replies'];
                if ( ( $replies + 1 ) > $board_config['posts_per_page'] ) {
                    $total_pages = ceil( ( $replies + 1 ) / $board_config['posts_per_page'] );
                    $goto_page = ' [ <img src="' . $images['icon_gotopost'] . '" alt="' . $lang['Goto_page'] . '" title="' . $lang['Goto_page'] . '" />' . $lang['Goto_page'] . ': ';
                    $times = 1;
                    for($j = 0; $j < $replies + 1; $j += $board_config['posts_per_page']) {
                        $goto_page .= '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=" . $topic_id . "&amp;start=$j") . '">' . $times . '</a>';
                        if ( $times == 1 && $total_pages > 4 ) {
                            $goto_page .= ' ... ';
                            $times = $total_pages - 3;
                            $j += ( $total_pages - 4 ) * $board_config['posts_per_page'];
                        } else if ( $times < $total_pages ) {
                            $goto_page .= ', ';
                        }
                        $times++;
                    }
                    $goto_page .= ' ] ';
                } else {
                    $goto_page = '';
                }
                if ( $searchset[$i]['topic_status'] == TOPIC_MOVED ) {
                    $topic_type = $lang['Topic_Moved'] . ' ';
                    $topic_id = $searchset[$i]['topic_moved_id'];
                    $topic_title = $board_config['global_view_open'] . $topic_title . $board_config['global_view_close'];
                    $folder_image = '<img src="' . $images['folder'] . '" alt="' . $lang['No_new_posts'] . '" />';
                    $newest_post_img = '';
                } else {
                    if ( $searchset[$i]['topic_status'] == TOPIC_LOCKED ) {
                        $folder = $images['folder_locked'];
                        $folder_new = $images['folder_locked_new'];
                        $topic_title = $board_config['locked_view_open'].$topic_title.$board_config['locked_view_close'];
                    } else if ( $searchset[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE  ) {
                        $folder =  $images['folder_global_announce'];
                        $folder_new = $images['folder_global_announce_new'];
                        $topic_title = $board_config['global_view_open'] . "&nbsp;" . $topic_title . $board_config['global_view_close'];
                    } else if ( $searchset[$i]['topic_type'] == POST_ANNOUNCE ) {
                        $folder = $images['folder_announce'];
                        $folder_new = $images['folder_announce_new'];
                        $topic_title = $board_config['announce_view_open'] . "&nbsp;" . $topic_title . $board_config['announce_view_close'];
                    } else if ( $searchset[$i]['topic_type'] == POST_STICKY ) {
                        $folder = $images['folder_sticky'];
                        $folder_new = $images['folder_sticky_new'];
                        $topic_title = $board_config['sticky_view_open'] . "&nbsp;" . $topic_title . $board_config['sticky_view_close'];
                    } else {
                        if ( $replies >= $board_config['hot_threshold'] ) {
                            $folder = $images['folder_hot'];
                            $folder_new = $images['folder_hot_new'];
                        } else {
                            $folder = $images['folder'];
                            $folder_new = $images['folder_new'];
                        }
                    }
                    if ( $userdata['session_logged_in'] ) {
                        if ( $searchset[$i]['post_time'] > $userdata['user_lastvisit'] ) {
                            if ( !empty($tracking_topics) || !empty($tracking_forums) || evo_getcookie($board_config['cookie_name'] . '_f_all') ) {
                                $unread_topics = TRUE;
                                if ( !empty($tracking_topics[$topic_id]) ) {
                                    if ( $tracking_topics[$topic_id] > $searchset[$i]['post_time'] ) {
                                        $unread_topics = FALSE;
                                    }
                                }
                                if ( !empty($tracking_forums[$forum_id]) ) {
                                    if ( $tracking_forums[$forum_id] > $searchset[$i]['post_time'] ) {
                                        $unread_topics = FALSE;
                                    }
                                }
                                if ( evo_getcookie($board_config['cookie_name'] . '_f_all') ) {
                                    if ( unserialize(evo_getcookie($board_config['cookie_name'] . '_f_all')) > $searchset[$i]['post_time'] ) {
                                        $unread_topics = FALSE;
                                    }
                                }
                                if ( $unread_topics ) {
                                    $folder_image = $folder_new;
                                    $folder_alt = $lang['New_posts'];

                                    $newest_post_img = '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
                                } else {
                                    $folder_alt = ( $searchset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
                                    $folder_image = $folder;
                                    $folder_alt = $folder_alt;
                                    $newest_post_img = '';
                                }
                            } else if ( $searchset[$i]['post_time'] > $userdata['user_lastvisit'] ) {
                                $folder_image = $folder_new;
                                $folder_alt = $lang['New_posts'];
                                $newest_post_img = '<a href="' . append_sid("viewtopic.php?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
                            } else {
                                $folder_image = $folder;
                                $folder_alt = ( $searchset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
                                $newest_post_img = '';
                            }
                        } else {
                            $folder_image = $folder;
                            $folder_alt = ( $searchset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
                            $newest_post_img = '';
                        }
                    } else {
                        $folder_image = $folder;
                        $folder_alt = ( $searchset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
                        $newest_post_img = '';
                    }
                }
                $topic_author = ( $searchset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $searchset[$i]['user_id']) . '">' : '';
                $topic_author .= ( $searchset[$i]['user_id'] != ANONYMOUS ) ? UsernameColor($searchset[$i]['color1'], $searchset[$i]['username']) : ( ( UsernameColor($searchset[$i]['color1'], $searchset[$i]['post_username']) != '' ) ? UsernameColor($searchset[$i]['color1'], $searchset[$i]['post_username']) : $lang['Guest'] );
                $topic_author .= ( $searchset[$i]['user_id'] != ANONYMOUS ) ? '</a>' : '';
                $first_post_time = create_date($board_config['default_dateformat'], $searchset[$i]['topic_time'], $board_config['board_timezone']);
                $last_post_time = create_date($board_config['default_dateformat'], $searchset[$i]['post_time'], $board_config['board_timezone']);
                $last_post_author = ( $searchset[$i]['id2'] == ANONYMOUS ) ? ( ($searchset[$i]['post_username2'] != '' ) ? $searchset[$i]['post_username2'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.php?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $searchset[$i]['id2']) . '">' . UsernameColor($searchset[$i]['color2'], $searchset[$i]['user2']) . '</a>';
                $last_post_url = '<a href="' . append_sid("viewtopic.php?"  . POST_POST_URL . '=' . $searchset[$i]['topic_last_post_id']) . '#' . $searchset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" /></a>';
                /*--FNA #2--*/
                $template->assign_block_vars('searchresults', array( 
                    'FORUM_NAME'        => get_object_lang(POST_FORUM_URL . $searchset[$i]['forum_id'], 'name'),
                    'FORUM_ID'          => $forum_id,
                    'TOPIC_ID'          => $topic_id,
                    'FOLDER'            => $folder_image,
                    'NEWEST_POST_IMG'   => $newest_post_img,
                    'TOPIC_FOLDER_IMG'  => $folder_image,
                    'GOTO_PAGE'         => $goto_page,
                    'REPLIES'           => $replies,
                    'TOPIC_TITLE'       => $topic_title,
                    'TOPIC_TYPE'        => $topic_type,
                    'VIEWS'             => $views,
                    'TOPIC_AUTHOR'      => $topic_author,
                    'FIRST_POST_TIME'   => $first_post_time,
                    'LAST_POST_TIME'    => $last_post_time,
                    'LAST_POST_AUTHOR'  => $last_post_author,
                    'LAST_POST_IMG'     => $last_post_url,
                    'FOLDER_IMG'        => $images['folder'],
                    'L_TOPIC_FOLDER_ALT'=> $folder_alt,
                    'U_VIEW_FORUM'      => $forum_url,
                    'U_VIEW_TOPIC'      => $topic_url)
                );
            }
        }
        $base_url = "search.php?search_id=$search_id";
        $template->assign_vars(array(
            'PAGINATION'    => generate_pagination($base_url, $total_match_count, $per_page, $start),
            'PAGE_NUMBER'   => sprintf($lang['Page_of'], ( floor( $start / $per_page ) + 1 ), ceil( $total_match_count / $per_page )),
            'L_AUTHOR'      => $lang['Author'],
            'L_MESSAGE'     => $lang['Message'],
            'L_FORUM'       => $lang['Forum'],
            'L_TOPICS'      => $lang['Topics'],
            'L_REPLIES'     => $lang['Replies'],
            'L_VIEWS'       => $lang['Views'],
            'L_POSTS'       => $lang['Posts'],
            'L_LASTPOST'    => $lang['Last_Post'],
            'L_POSTED'      => $lang['Posted'],
            'L_SUBJECT'     => $lang['Subject'],
            'L_GOTO_PAGE'   => $lang['Goto_page'])
        );
        $template->pparse('body');
        include_once(NUKE_INCLUDE_DIR.'page_tail.php');
    } else {
        message_die(GENERAL_MESSAGE, $lang['No_search_match']);
    }
}
//
// Search forum
//
$s_forums = get_tree_option();
//
// Number of chars returned
//
$s_characters = '<option value="-1">' . $lang['All_available'] . '</option>';
$s_characters .= '<option value="0">0</option>';
$s_characters .= '<option value="25">25</option>';
$s_characters .= '<option value="50">50</option>';
for($i = 100; $i < 1100 ; $i += 100) {
    $selected = ( $i == 200 ) ? ' selected="selected"' : '';
    $s_characters .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
}
//
// Sorting
//
$s_sort_by = "";
for($i = 0; $i < count($sort_by_types); $i++) {
    $s_sort_by .= '<option value="' . $i . '">' . $sort_by_types[$i] . '</option>';
}
//
// Search time
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);
$s_time = '';
for($i = 0; $i < count($previous_days); $i++) {
    $selected = ( $topic_days == $previous_days[$i] ) ? ' selected="selected"' : '';
    $s_time .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
//
// Output the basic page
//
$page_title = $lang['Search'];
include_once(NUKE_INCLUDE_DIR.'page_header.php');

$template->set_filenames(array(
    'body' => 'search_body.tpl')
);
make_jumpbox('viewforum.php');
if ( !is_user() && $board_config['search_disable_security_code'] == 1) {
    $template->assign_block_vars('switch_search_security_code', array());
    $template->assign_vars(array(
        'L_SEARCH_SECURITY_CODE' => security_code(1,'small', 1))
    );
}
$template->assign_vars(array(
    'L_SEARCH_QUERY'                => $lang['Search_query'],
    'L_SEARCH_OPTIONS'              => $lang['Search_options'],
    'L_SEARCH_KEYWORDS'             => $lang['Search_keywords'],
    'L_SEARCH_KEYWORDS_EXPLAIN'     => $lang['Search_keywords_explain'],
    'L_SEARCH_AUTHOR'               => $lang['Search_author'],
    'L_SEARCH_AUTHOR_EXPLAIN'       => $lang['Search_author_explain'],
    'L_SEARCH_ANY_TERMS'            => $lang['Search_for_any'],
    'L_SEARCH_ALL_TERMS'            => $lang['Search_for_all'],
    'L_SEARCH_MESSAGE_ONLY'         => $lang['Search_msg_only'],
    'L_SEARCH_MESSAGE_SUBJECT_ONLY' => $lang['Search_subject_only'],
    'L_SEARCH_MESSAGE_TITLE'        => $lang['Search_title_msg'],
    'L_CATEGORY'                    => $lang['Category'],
    'L_RETURN_FIRST'                => $lang['Return_first'],
    'L_CHARACTERS'                  => $lang['characters_posts'],
    'L_SORT_BY'                     => $lang['Sort_by'],
    'L_SORT_ASCENDING'              => $lang['Sort_Ascending'],
    'L_SORT_DESCENDING'             => $lang['Sort_Descending'],
    'L_SEARCH_PREVIOUS'             => $lang['Search_previous'],
    'L_DISPLAY_RESULTS'             => $lang['Display_results'],
    'L_FORUM'                       => $lang['Forum'],
    'L_TOPICS'                      => $lang['Topics'],
    'L_POSTS'                       => $lang['Posts'],
    'S_SEARCH_ACTION'               => append_sid("search.php?mode=results"),
    'S_CHARACTER_OPTIONS'           => $s_characters,
    'S_FORUM_OPTIONS'               => $s_forums,
    'S_TIME_OPTIONS'                => $s_time,
    'S_SORT_OPTIONS'                => $s_sort_by,
    'S_HIDDEN_FIELDS'               => '')
);
$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');
?>