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
        $module['Board_msg_xl']['Board_msg_xl'] = $filename;
        return;
    }
}

global $_GETVAR, $currentlang;

$lang_file = '/lang_admin_bm_xl.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

include_once(NUKE_INCLUDE_DIR. 'bbcode.php');
include_once(NUKE_INCLUDE_DIR. 'functions_admin_bm.php');
include_once(NUKE_INCLUDE_DIR. 'functions_post.php');

$mode     = $_GETVAR->get('mode', '_REQUEST', 'string', '');
$preview  = $_GETVAR->get('preview', '_POST', 'string');
$editsave = $_GETVAR->get('editsave', '_POST', 'string');
$addsave  = $_GETVAR->get('addsave', '_POST', 'string');

if ( $mode == 'smilies' ) {
    generate_smilies_bm('window');
    exit;
}
//
// Pull all config data
//
$start      = $_GETVAR->get('start', 'get', 'int', 0);
$sort_order = (($_GETVAR->get('order', 'post', 'string') == 'ASC') ? 'ASC' : (($_GETVAR->get('order', 'get', 'string') == 'ASC') ? 'ASC' : 'DESC'));
$sortmode   = ($_GETVAR->get('sortmode', 'post', 'string') ? $_GETVAR->get('sortmode', 'post', 'string') : ($_GETVAR->get('sortmode', 'get', 'string') ? $_GETVAR->get('sortmode', 'get', 'string') : '' ));

if ( empty($mode) && empty($editsave) && empty($addsave) && empty($preview) ) {
    switch( $sortmode ) {
        case 'title':
            $order_by = "title " . $sort_order;
            break;
        case 'message':
            $order_by = "message " . $sort_order;
            break;
        case 'showpage':
            $order_by = "showpage " . $sort_order;
            break;
        case 'auth':
            $order_by = "auth " . $sort_order;
            break;
        case 'startdate':
            $order_by = "startdate " . $sort_order;
            break;
        case 'enddate':
            $order_by = "enddate " . $sort_order;
            break;
        case 'ordr':
            $order_by = "ordr " . $sort_order;
            break;
        case 'width':
            $order_by = "width " . $sort_order;
            break;
        default:
            $order_by = "showpage " . $sort_order;
            break;
    }
    $order_by .= ", ordr ASC LIMIT $start, " . $board_config['topics_per_page'];
    $mode_types_text = array($lang['Bm_display'], $lang['Bm_title'], $lang['Bm_message'], $lang['Bm_auth'], $lang['Bm_startdate'], $lang['Bm_enddate'],  $lang['Bm_order'], $lang['Bm_width']);
    $mode_types = array('showpage', 'title', 'message', 'auth', 'startdate', 'enddate', 'ordr', 'width');
    $select_sort_mode = '<select name="sortmode">';
    for($i = 0; $i < count($mode_types_text); $i++)  {
        $selected = ( $sortmode == $mode_types[$i] ) ? ' selected="selected"' : '';
        $select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
    }
    $select_sort_mode .= '</select>';
    $select_sort_order = '<select name="order">';
    if($sort_order == 'ASC') {
        $select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
    } else {
        $select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
    }
    $select_sort_order .= '</select>';
    //
    // Generate page
    //

    $template->set_filenames(array(
        'body' => 'admin/board_msg_xl_view_body.tpl')
    );

    $template->assign_vars(array(
        'L_SELECT_SORT_METHOD'  => $lang['Select_sort_method'],
        'L_BOARD_MSG_SHOWPAGE'  => $lang['Bm_display'],
        'L_BOARD_MSG_XL'        => $lang['Board_msg_xl'],
        'L_BOARD_AUTH'          => $lang['Bm_auth'],
        'L_BOARD_TITLE'         => $lang['Bm_title'],
        'L_BOARD_MSG_XL_EXPLAIN'=> $lang['Board_msg_xl_explain'],
        'L_BOARD_WIDTH'         => $lang['Bm_width'],
        'L_BOARD_DAYS'          => $lang['Bm_days'],
        'L_SUBMIT'              => $lang['Sort'],
        'L_BOARD_ORDER'         => $lang['Bm_order'],
        'L_BOARD_STARTDATE'     => $lang['Bm_startdate'],
        'L_BOARD_ENDDATE'       => $lang['Bm_enddate'],
        'L_BOARD_USERS_TIMEZONE'=> $lang['Bm_timezone'],
        'L_ADD'                 => $lang['Bm_Add_New'],
        'L_EDIT'                => $lang['Edit'],
        'L_DELETE'              => $lang['Delete'],
        'S_MODE_SELECT'         => $select_sort_mode,
        'S_ORDER_SELECT'        => $select_sort_order,
        'S_MODE_ACTION'         => admin_sid('admin_board_msg_xl.php'),
        'U_BOARD_MSG_ADD'       => admin_sid('admin_board_msg_xl.php&amp;mode=add'))
    );
    $sql = "SELECT * FROM " . BOARD_MSG_TABLE . " ORDER BY " . $order_by;
    if( !($result = $db->sql_query($sql)) ) {
        message_die(GENERAL_ERROR, 'Could not query board messages', '', __LINE__, __FILE__, $sql);
    }
    if ( $msg_data = $db->sql_fetchrow($result) ) {
        $i = 0;
        do {
            $id = $msg_data['msg_id'];
            $board_showpage = $msg_data['showpage'];
            $board_msg = $msg_data['message'];
            $bbcode_uid = (isset($topic_rowset[$i]['bbcode_uid']) ? $topic_rowset[$i]['bbcode_uid'] : make_bbcode_uid());
            $board_msg = bbencode_strip($board_msg, $bbcode_uid);
            if (strlen($board_msg) > 200) {
                $board_msg = substr($board_msg, 0, 200) . "...";
            }
            $board_auth = $msg_data['auth'];
            $board_title = $msg_data['title'];
            $board_width = $msg_data['width'];
            $board_days = $msg_data['days'];
            $board_order = $msg_data['ordr'];
            $board_startdate = formatTimestamp($msg_data['startdate']);
            $board_enddate = formatTimestamp($msg_data['enddate']);
            $board_users_timezone = $msg_data['users_timezone'];
            $temp_url = admin_sid('admin_board_msg_xl.php&amp;mode=edit&amp;id='.$id);
            $edit_img = '<a href="' . $temp_url . '"><img src="'. $images['icon_edit'] . '" alt="' . $lang['Edit'] . '" title="' . $lang['Edit'] . '" border="0" /></a>';
            $edit = '<a href="' . $temp_url . '">' . $lang['Edit'] . '</a>';
            $edit2 = $temp_url;
            $temp_url = admin_sid('admin_board_msg_xl.php&amp;mode=delete&amp;id='.$id);
            $delete_img = '<a href="' . $temp_url . '"><img src="'. $images['icon_delpost'] . '" alt="' . $lang['Delete'] . '" title="' . $lang['Delete'] . '" border="0" /></a>';
            $delete = '<a href="' . $temp_url . '">' . $lang['Delete'] . '</a>';
            $board_days_display =  make_days_abbr_string ($board_days);

            switch ( $board_showpage ) {
                case PAGE_INDEX:
                    $board_msg_display = $lang['Bm_index'];
                    break;
                case PAGE_LOGIN:
                    $board_msg_display = $lang['Login'];
                    break;
                case PAGE_SEARCH:
                    $board_msg_display = $lang['Search'];
                    break;
                case PAGE_VIEWONLINE:
                    $board_msg_display = $lang['Who_is_Online'];
                    break;
                case PAGE_VIEWMEMBERS:
                    $board_msg_display = $lang['Memberlist'];
                    break;
                case PAGE_PRIVMSGS:
                    $board_msg_display = $lang['Private_Message'];
                    break;
                case PAGE_FAQ:
                    $board_msg_display = $lang['FAQ'];
                    break;
                case  PAGE_REGISTER:
                    $board_msg_display = $lang['Register'];
                    break;
                case PAGE_PROFILE:
                    $board_msg_display = $lang['Profile'];
                    break;
                case PAGE_GROUPCP:
                    $board_msg_display = $lang['Usergroups'];
                    break;
                case PAGE_POSTING:
                    $board_msg_display = $lang['Posting_message'];
                    break;
                case -9999:
                    $board_msg_display = $lang['Bm_off'];
                    break;
                case 9999:
                    $board_msg_display = $lang['Bm_all_pages'];
                    break;
                default:
                    $sql2 = "SELECT forum_name FROM " . FORUMS_TABLE . "
                            WHERE forum_id = '" . $board_showpage . "'";
                    if ( !($result2 = $db->sql_query($sql2)) ) {
                        message_die(GENERAL_ERROR, 'Could not obtain forumname', '', __LINE__, __FILE__, $sql);
                    }
                    $row = $db->sql_fetchrow($result2);
                    $board_msg_display = $row['forum_name'];
                    break;
            }
            if ( $board_auth == AUTH_ALL ) {
                $board_msg_auth_display = $lang['Bm_all_auth'];
            }  else {
                if ( $board_auth == AUTH_REG ) {
                    $board_msg_auth_display = $lang['Registered'];
                } else {
                    if ( $board_auth == AUTH_MOD ) {
                        $board_msg_auth_display = $lang['Bm_mod'];
                    } else {
                        $board_msg_auth_display = $lang['Administrators'];
                    }
                }
            }

            $board_users_timezone_txt = ( $board_users_timezone == '1') ? $lang['Yes'] : $lang['No'];
            $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
            $template->assign_block_vars('board_msg_row', array(
                'ROW_NUMBER'        => $i + ( $_GETVAR->get('start', 'get', 'int') + 1 ),
                'ROW_COLOR'         => '#' . $row_color,
                'ROW_CLASS'         => $row_class,
                'BOARD_MSG_DISPLAY' => $board_msg_display,
                'BOARD_MSG'         => $board_msg,
                'BOARD_TITLE'       => $board_title,
                'BOARD_WIDTH'       => $board_width,
                'BOARD_ORDER'       => $board_order,
                'BOARD_DAYS'        => $board_days_display,
                'BOARD_STARTDATE'   => $board_startdate,
                'BOARD_ENDDATE'     => $board_enddate,
                'BOARD_USERS_TIMEZONE_TEXT' => $board_users_timezone_txt,
                'BOARD_MSG_EDIT_IMG'        => $edit_img,
                'BOARD_MSG_DELETE_IMG'      => $delete_img,
                'BOARD_MSG_EDIT'    => $edit,
                'BOARD_MSG_EDIT2'   => $edit2,
                'BOARD_MSG_DELETE'  => $delete,
                'BOARD_AUTH'        => $board_msg_auth_display)
            );
            $i++;
        } while ( $msg_data = $db->sql_fetchrow($result) );
        $db->sql_freeresult($result);
    }
    if ( $board_config['topics_per_page'] > 10 ) {
        $sql = "SELECT count(*) AS total FROM " . BOARD_MSG_TABLE;
        if ( !($result = $db->sql_query($sql)) ) {
            message_die(GENERAL_ERROR, 'Error getting total messages', '', __LINE__, __FILE__, $sql);
        }
        if ( $total = $db->sql_fetchrow($result) ) {
            $total_msg = $total['total'];
            $pagination = generate_pagination("admin_board_msg_xl.php?mode=$mode", $total_msg, $board_config['topics_per_page'], $start). '&nbsp;';
        }
        $db->sql_freeresult($result);
    } else {
        $pagination = '&nbsp;';
        $total_msg = 10;
    }
    $template->assign_vars(array(
        'PAGINATION'  => $pagination,
        'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_msg / $board_config['topics_per_page'] )),
        'L_GOTO_PAGE' => $lang['Goto_page'])
    );
    $template->pparse('body');
    include(NUKE_FORUMS_ADMIN_DIR.'page_footer_admin.php');
}
if ( $mode == 'edit' || $mode == 'add' ) {
    if ( $mode == 'edit' ) {
        $msg_id = ( $_GETVAR->get('id', 'post', 'int') ) ? $_GETVAR->get('id', 'post', 'int') : $_GETVAR->get('id', 'get', 'int');
        $sql = "SELECT * FROM " . BOARD_MSG_TABLE . " WHERE msg_id = " . $msg_id;
        $result = $db->sql_query($sql);
        if( !$result ) {
            message_die(GENERAL_ERROR, 'Could not obtain message information', "", __LINE__, __FILE__, $sql);
        }
        $msg_data       = $db->sql_fetchrow($result);
        $st_day         = date ( 'd', $msg_data['startdate'] );
        $st_month       = date ( 'm', $msg_data['startdate'] );
        $st_year        = date ( 'Y', $msg_data['startdate'] );
        $end_day        = date ( 'd', $msg_data['enddate'] );
        $end_month      = date ( 'm', $msg_data['enddate'] );
        $end_year       = date ( 'Y', $msg_data['enddate'] );
        $board_msg_showpage = $msg_data['showpage'];
        $board_msg      = $msg_data['message'];
        $board_title    = $msg_data['title'];
        $board_auth     = $msg_data['auth'];
        $board_width    = $msg_data['width'];
        $board_order    = $msg_data['ordr'];
        $board_images   = $msg_data['images'];
        $board_days     = $msg_data['days'];
        $board_users_timezone = $msg_data['users_timezone'];
        $db->sql_freeresult($result);
        if ( $msg_data['images'] != '' ) {
            $bm_images = '<img src= "'.NUKE_IMAGES_BASE_DIR.$msg_data['images'] . '" border="0" />';
        }
        $save_action = 'editsave';
    } elseif ( $mode == 'add' ) {
        $st_day             = date ( 'd', mktime ( 0, 0, 0, 1, 1, 2002 ) );
        $st_month           = date ( 'm', mktime ( 0, 0, 0, 1, 1, 2002 ) );
        $st_year            = date ( 'Y', mktime ( 0, 0, 0, 1, 1, 2002 ) );
        $end_day            = date ( 'd', mktime ( 0, 0, 0, 12, 31, 2010 ) );
        $end_month          = date ( 'm', mktime ( 0, 0, 0, 12, 31, 2010 ) );
        $end_year           = date ( 'Y', mktime ( 0, 0, 0, 12, 31, 2010 ) );
        $board_msg_showpage = '-9999';
        $board_msg          = '';
        $board_title        ='';
        $board_order        ='0';
        $board_auth         = ADMIN;
        $board_width        = '75';
        $board_images       = '';
        $board_days         = '1111111';
        $board_users_timezone = '0';
        $save_action        = 'addsave';
    }
    $startday     = make_drop_down( '1', '31', 'startday', $st_day, '1', 'nr' );
    $startmonth   = make_drop_down( '1', '12', 'startmonth', $st_month, '1', 'month' );
    $startyear    = make_drop_down( '2000', '2010', 'startyear', $st_year, '1', 'nr' );
    $endday       = make_drop_down( '1', '31', 'endday', $end_day, '1', 'nr' );
    $endmonth     = make_drop_down( '1', '12', 'endmonth', $end_month, '1', 'month' );
    $endyear      = make_drop_down( '2000', '2010', 'endyear', $end_year, '1', 'nr' );
    $forum_auth_levels = array('ALL', 'REG', 'MOD', 'ADMIN');
    $forum_auth_const = array(AUTH_ALL, AUTH_REG, AUTH_MOD, AUTH_ADMIN);
    $custom_auth  = '&nbsp;<select name="auth">';
    for($k = 0; $k < count($forum_auth_levels); $k++)  {
        $selected = ( $forum_auth_const[$k] == (isset($msg_data['auth']) ? $msg_data['auth'] : '') ) ? ' selected="selected"' : '';
        $custom_auth .= '<option value="' . $forum_auth_const[$k] . '"' . $selected . '>' . $lang['Forum_' . $forum_auth_levels[$k]] . '</option>';
    }
    $custom_auth .= '</select>&nbsp;';
    $board_startdate = $startmonth . ", " . $startday . " " . $startyear;
    $board_enddate = $endmonth . ", " . $endday . " " . $endyear;
    $board_showpage = make_showpage_dropdown ('board_showpage', $board_msg_showpage);
    $board_days = make_days_checkbox ($board_days);
    $board_users_timezone_yes = ( $board_users_timezone == '1') ? "checked=\"checked\"" : "";
    $board_users_timezone_no = ( $board_users_timezone == '0') ? "checked=\"checked\"" : "";
    $board_images_img = '';
    if ( $board_images != '' ) {
        $board_images_img = '<img src= "' .NUKE_IMAGES_BASE_DIR . $board_images . '" border="0" />';
    }
    //
    // HTML toggle selection
    //
    if ( $board_config['allow_html'] ) {
        $html_status = $lang['HTML_is_ON'];
    } else {
        $html_status = $lang['HTML_is_OFF'];
    }
    //
    // BBCode toggle selection
    //
    if ( $board_config['allow_bbcode'] ) {
        $bbcode_status = $lang['BBCode_is_ON'];
    } else {
        $bbcode_status = $lang['BBCode_is_OFF'];
    }
    //
    // Smilies toggle selection
    //
    if ( $board_config['allow_smilies'] ) {
        $smilies_status = $lang['Smilies_are_ON'];
    } else {
        $smilies_status = $lang['Smilies_are_OFF'];
    }
    generate_smilies('inline', PAGE_POSTING);
    $template->set_filenames(array(
        "body" => "admin/board_msg_xl_edit_body.tpl")
    );
    if (isset($msg_data['msg_id']) && !empty($msg_data['msg_id'])) {
        $s_hidden_fields = '<input type="hidden" name="id" value="' . $msg_data['msg_id'] . '" />';
    }
    $template->assign_vars(array(
        'BB_BOX'                => bbcode_table('message', 'post', 1, $board_msg),
        'L_BOARD_MSG_SHOWPAGE'  => $lang['Bm_showpage'],
        'L_BOARD_MSG_XL'        => $lang['Board_msg_xl'],
        'L_BOARD_MSG_XL_EXPLAIN'=> $lang['Board_msg_xl_explain'],
        'L_BOARD_AUTH'          => $lang['Bm_auth'],
        'L_BOARD_ORDER'         => $lang['Bm_order'],
        'L_BOARD_TITLE'         => $lang['Bm_title'],
        'L_BOARD_WIDTH'         => $lang['Bm_width'],
        'L_BOARD_WIDTH_EXPLAIN' => $lang['Bm_width_explain'],
        'L_BOARD_TIME_EXPLAIN'  => $lang['Bm_time_explain'],
        'L_BOARD_DATE_EXPLAIN'  => $lang['Bm_date_explain'],
        'L_BOARD_STARTDATE'     => $lang['Bm_startdate'],
        'L_BOARD_ENDDATE'       => $lang['Bm_enddate'],
        'L_YES'                 => $lang['Yes'],
        'L_NO'                  => $lang['No'],
        'L_SUBMIT'              => $lang['Submit'],
        'L_PREVIEW'             => $lang['Preview'],
        'L_ACTION'              => $save_action,
        'L_BOARD_DAYS'          => $lang['Bm_days'],
        'L_BOARD_DAYS_EXPLAIN'  => $lang['Bm_days_explain'],
        'L_BOARD_IMAGES'        => $lang['Bm_images'],
        'L_BOARD_IMAGES_EXPLAIN'=> $lang['Bm_images_explain'],
        'BM_IMG_BASEDIR'        => NUKE_IMAGES_BASE_DIR,
        'L_OPTIONS'             => $lang['Options'],
        'BM_BASE_DIR'           => NUKE_HREF_BASE_DIR,
        'HTML_STATUS'           => $html_status,
        'BBCODE_STATUS'         => sprintf($bbcode_status, '<a href="' . append_sid("faq.php?mode=bbcode&amp;menu=1") . '" target="_phpbbcode">', '</a>'),
        'SMILIES_STATUS'        => $smilies_status,
        'BOARD_MSG'             => $board_msg,
        'BOARD_TITLE'           => $board_title,
        'BOARD_DAYS'            => $board_days,
        'BOARD_ORDER'           => $board_order,
        'BOARD_WIDTH'           => $board_width,
        'BOARD_IMAGES'          => $board_images,
        'BOARD_IMAGES_IMG'      => $board_images_img,
        'BOARD_STARTDATE'       => $board_startdate,
        'BOARD_ENDDATE'         => $board_enddate,
        'BOARD_USERS_TIMEZONE_YES'  => $board_users_timezone_yes,
        'BOARD_USERS_TIMEZONE_NO'   => $board_users_timezone_no,
        'U_PREVIEW'             => admin_sid('admin_board_msg_xl.php&amp;mode=preview'),
        'S_AUTH_LEVELS_SELECT'  => $custom_auth,
        'S_STARTDATE_SELECT'    => $board_startdate,
        'S_ENDDATE_SELECT'      => $board_enddate,
        'S_SHOWPAGE_SELECT'     => $board_showpage,
        'S_HIDDEN_FIELDS'       => (isset($s_hidden_fields) ? $s_hidden_fields : ''),
        'S_BOARD_MSG_XL_ACTION' => admin_sid('admin_board_msg_xl.php'),
    ));
    $template->pparse("body");
    include(NUKE_FORUMS_ADMIN_DIR.'page_footer_admin.php');
}

if ( !empty($editsave) || !empty($addsave) || !empty($preview) ) {
    $id = ( $_GETVAR->get('id', 'post', 'int') ) ? $_GETVAR->get('id', 'post', 'int') : $_GETVAR->get('id', 'get', 'int');
    $board_msg_showpage = ( $_GETVAR->get('board_showpage', 'post', 'int') >= -100) ? $_GETVAR->get('board_showpage', 'post', 'int') : '-9999';
    $board_msg_showpage = ( $board_msg_showpage == '-9998' ) ? '-9999' : $board_msg_showpage;
    $board_title        = $_GETVAR->get('title', 'post', 'string') ? $_GETVAR->get('title', 'post', 'string') : '';
    $board_msg          = $_GETVAR->get('message', 'post', 'string') ? $_GETVAR->get('message', 'post', 'string') : '';
    $board_auth         = $_GETVAR->get('auth', 'post', 'int') ? $_GETVAR->get('auth', 'post', 'int') : 0;
    $board_width        = $_GETVAR->get('width', 'post', 'int') ? $_GETVAR->get('width', 'post', 'int') : 0;
    $board_images       = $_GETVAR->get('images', 'post', 'string') ? $_GETVAR->get('images', 'post', 'string') : '';
    $board_order        = $_GETVAR->get('order', 'post', 'int') ? $_GETVAR->get('order', 'post', 'int') : 0;
    $board_starthour    = $_GETVAR->get('starthour', 'post', 'int', 0, 24) ? $_GETVAR->get('starthour', 'post', 'int') : 0;
    $board_startmin     = $_GETVAR->get('startmin', 'post', 'int', 0, 60) ? $_GETVAR->get('startmin', 'post', 'int') : 0;
    $board_endhour      = $_GETVAR->get('endhour', 'post', 'int', 0, 24) ? $_GETVAR->get('endhour', 'post', 'int') : 0;
    $board_endmin       = $_GETVAR->get('endmin', 'post', 'int', 0, 60) ? $_GETVAR->get('endmin', 'post', 'int') : 0;
    $board_startday     = $_GETVAR->get('startday', 'post', 'int', 1, 31) ? $_GETVAR->get('startday', 'post', 'int') : 0;
    $board_startmonth   = $_GETVAR->get('startmonth', 'post', 'int', 1, 12) ? $_GETVAR->get('startmonth', 'post', 'int') : 0;
    $board_startyear    = $_GETVAR->get('startyear', 'post', 'int', 1980, 2100) ? $_GETVAR->get('startyear', 'post', 'int') : 0;
    $board_endday       = $_GETVAR->get('endday', 'post', 'int', 1, 31) ? $_GETVAR->get('endday', 'post', 'int') : 0;
    $board_endmonth     = $_GETVAR->get('endmonth', 'post', 'int', 1, 12) ? $_GETVAR->get('endmonth', 'post', 'int') : 0;
    $board_endyear      = $_GETVAR->get('endyear', 'post', 'int', 1980, 2100) ? $_GETVAR->get('endyear', 'post', 'int') : 0;
    $board_startday     = checkdays ( $board_startmonth, $board_startday, $board_startyear );
    $board_endday       = checkdays ( $board_endmonth, $board_endday, $board_endyear );
    $board_arr_days     = $_GETVAR->get('days', 'post', 'array') ?  $_GETVAR->get('days', 'post', 'array') : '';
    $board_days         = make_days_string ($board_arr_days);
    $board_starttime    = mktime ( $board_starthour, $board_startmin, 0, 1, 1, 2000 );
    $board_endtime      = mktime ( $board_endhour, $board_endmin, 0, 1, 1, 2000 );
    $board_startdate    = mktime ( 0, 0, 0, $board_startmonth, $board_startday, $board_startyear );
    $board_enddate      = mktime ( 0, 0, 0, $board_endmonth, $board_endday, $board_endyear );
    $board_users_timezone = $_GETVAR->get('users_timezone', 'post', 'int') ? $_GETVAR->get('users_timezone', 'post', 'int') : 0;
    $bbcode_uid         = make_bbcode_uid();
    $html_on            = $board_config['allow_html'];
    $bbcode_on          = $board_config['allow_bbcode'];
    $smilies_on         = $board_config['allow_smilies'];
    if ( !empty($editsave) || !empty($addsave) ) {
        if ( !empty($editsave) ) {
            $sql = "UPDATE " . BOARD_MSG_TABLE . " SET
                    auth = " . $board_auth . ", title = '" . $board_title . "',
                    message = '" . $board_msg . "', showpage = " . $board_msg_showpage . ",
                    width = '" . $board_width . "', starttime = " . $board_starttime . ", endtime = " . $board_endtime . ",
                    ordr = " . $board_order . ", days = '" . $board_days . "', images = '" . str_replace("\'", "''", $board_images) . "',
                    startdate = " . $board_startdate . ", enddate = " . $board_enddate . ", users_timezone = " . $board_users_timezone . ", bbcode_uid = '" . str_replace("\'", "''", $bbcode_uid) . "'
                    WHERE msg_id = $id";
        } else {
            $sql = "INSERT INTO " . BOARD_MSG_TABLE . " ( auth, title, message, showpage, width, ordr, days, images, starttime, endtime, startdate, enddate, users_timezone, bbcode_uid )
                    VALUES ( $board_auth, '" . $board_title . "', '" . $board_msg . "', $board_msg_showpage, $board_width, $board_order, $board_days, '" . str_replace("\'", "''", $board_images) . "', $board_starttime, $board_endtime, $board_startdate, $board_enddate, $board_users_timezone, '" . str_replace("\'", "''", $bbcode_uid) . "' )";
        }
        if( !$db->sql_query($sql) ) {
            message_die(GENERAL_ERROR, "Failed to update board message", "", __LINE__, __FILE__, $sql);
        } else {
            $message = $lang['Bm_updated'] . "<br /><br />" . sprintf($lang['Click_return_bm'], "<a href=\"" . admin_sid("admin_board_msg_xl.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
        }
    } else {
        $template->set_filenames(array(
            "body" => "admin/board_msg_xl_preview_body.tpl")
        );
        if ( !empty($board_msg) ) {
            $bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
            $board_msg = prepare_message($board_msg, $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
            if ( !$html_on ) {
                $board_msg = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $board_msg);
            }
            $board_msg = ($board_config['allow_bbcode']) ? bbencode_second_pass($board_msg, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $board_msg);
            $board_msg = make_clickable($board_msg);
            if ( $smilies_on ) {
                $board_msg = smilies_pass($board_msg);
            }
            $board_msg = word_wrap_pass($board_msg);
            $board_msg = str_replace("\n", "\n<br />\n", $board_msg);
        }
        $board_img = ( $board_images != '') ? '<img src= "'. NUKE_IMAGES_BASE_DIR . $board_images . '" border="0" />' : '';
        $template->assign_vars(array(
            'L_BACK' => $lang['Bm_back'],
            'BM_TITLE' => $board_title,
            'BM_MSG' => $board_msg,
            'BM_WIDTH' => $board_width . "%",
            'BM_IMAGES' => $board_img,
            'BM_IMG_BASEDIR' => NUKE_IMAGES_BASE_DIR,
            'BM_BASE_DIR' => NUKE_HREF_BASE_DIR
        ));
        $template->pparse('body');
    }
    include(NUKE_FORUMS_ADMIN_DIR.'page_footer_admin.php');
}

if ( $mode == 'delete' ) {
    //
    // Admin has selected to delete a board message
    //
    $msg_id = ( $_GETVAR->get('id', 'post', 'int') ) ? $_GETVAR->get('id', 'post', 'int') : $_GETVAR->get('id', 'get', 'int');
    $sql = "DELETE FROM " . BOARD_MSG_TABLE . "
            WHERE msg_id = " . $msg_id;
    $result = $db->sql_query($sql);
    if( !$result ) {
        message_die(GENERAL_ERROR, "Couldn't delete board message", "", __LINE__, __FILE__, $sql);
    }
    $message = $lang['Bm_del_success'] . "<br /><br />" . sprintf($lang['Click_return_bm'], "<a href=\"" . admin_sid("admin_board_msg_xl.php") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . admin_sid("index.php&amp;pane=right") . "\">", "</a>");
    message_die(GENERAL_MESSAGE, $message);
}
?>