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

if (!defined('MODULE_FILE')) {
   die('You can\´t access this file directly');;
}

global $_GETVAR;
$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

if (!defined('IN_PHPBB')) {
    define('IN_PHPBB', TRUE);
}

$get_bm_id = $_GETVAR->get('bm', 'get', 'int');

include_once(NUKE_INCLUDE_DIR . 'functions_bm.php');
include_once(NUKE_INCLUDE_DIR . 'bbcode.php');
include_once(NUKE_INCLUDE_DIR. 'functions_post.php');

$bm_id = '';
$bm_title = $lang['Bm_error'];
$bm_msg = $lang['Bm_no_message'];
$bm_width = '50%';
$bm_images = '';
$bm_ordr = 0;
$bm_prv_id = '';
$bm_prv_title = '';
$bm_nxt_id = '';
$bm_nxt_title = '';
$l_bm_nxt='';
$l_bm_prv='';

$bmxl_html_on    = $board_config['allow_html'];
$bmxl_bbcode_on  = $board_config['allow_bbcode'];
$bmxl_smilies_on = $board_config['allow_smilies'];

$sql = get_boardmsg_sql($userdata['bm_page'], $userdata['user_timezone']);
$sql_pn = $sql;

if  ( !empty($get_bm_id) ) {
    $bm_id = $get_bm_id;
    $sql .= " AND msg_id = '" . $bm_id . "'";
}
$sql .= " ORDER BY ordr ASC, msg_id ASC";

if ( $result = $db->sql_query($sql) ) {
    if ( $row = $db->sql_fetchrow($result) ) {
        $bm_ordr = $row['ordr'];
        $bm_id = $row['msg_id'];
        if ( is_admin() || is_mod_admin('Forums') ) {
            $bm_title = '<a href="admin.php?op=forums&amp;pane=main&amp;file=admin_board_msg_xl&amp;mode=edit&amp;id=' . $bm_id . '">' . $row['title'] . '</a>';
        } else {
            $bm_title = $row['title'];
        }
        $board_msg = $row['message'];
        $bm_width = $row['width'] . "%";

        $bbcode_uid = ( $bmxl_bbcode_on ) ? make_bbcode_uid() : '';
        $board_msg = prepare_message($board_msg, $bmxl_html_on, $bmxl_bbcode_on, $bmxl_smilies_on, $bbcode_uid);
        if ( !$bmxl_html_on ) {
            $board_msg = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $board_msg);
        }
        $board_msg = ($board_config['allow_bbcode']) ? bbencode_second_pass($board_msg, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $board_msg);
        $board_msg = make_clickable($board_msg);
        if ( $bmxl_smilies_on ) {
            $board_msg = smilies_pass($board_msg);
        }
        $board_msg = word_wrap_pass($board_msg);
        $board_msg = str_replace("\n", "\n<br />\n", $board_msg);

        if ( $row['images'] != '' ) {
            $bm_images = '<img src= "'.NUKE_IMAGES_BASE_DIR . $row['images'] . '" border="0" alt="" />';
        }
    }
}
$db->sql_freeresult($result);

$bm_page_php = get_bm_page_php($userdata['bm_page']);

$sql_prv = $sql_pn;
$sql_prv .= " AND ordr < " . intval($bm_ordr) . "
            ORDER BY ordr DESC, msg_id ASC
            LIMIT 1";

if ( $result = $db->sql_query($sql_prv) ) {
    if ( $row = $db->sql_fetchrow($result) ) {
        $bm_prv_id = $row['msg_id'];
        $bm_prv_title = $row['title'];
        $l_bm_prv = $lang['Bm_prev'];
    }
    $db->sql_freeresult($result);
}

$sql_nxt = $sql_pn;
$sql_nxt .= " AND ordr > " . intval($bm_ordr) . "
            ORDER BY ordr ASC, msg_id ASC
            LIMIT 1";

if ( $result = $db->sql_query($sql_nxt) ) {
    if ( $row = $db->sql_fetchrow($result) ) {
        $bm_nxt_id = $row['msg_id'];
        $bm_nxt_title = $row['title'];
        $l_bm_nxt = $lang['Bm_next'];
    }
    $db->sql_freeresult($result);
}

$template->assign_vars(array(
    'BM_TITLE'      => $bm_title,
    'BM_MSG'        => (!empty($board_msg) ? $board_msg : ''),
    'BM_WIDTH'      => $bm_width,
    'BM_IMAGES'     => $bm_images,
    'BM_PRV_TITLE'  => $bm_prv_title,
    'U_BM_PRV'      => append_sid($bm_page_php . 'bm=' . $bm_prv_id),
    'BM_NXT_TITLE'  => $bm_nxt_title,
    'U_BM_NXT'      => append_sid($bm_page_php . 'bm=' . $bm_nxt_id),
    'L_BM_NXT'      => $l_bm_nxt,
    'L_BM_PRV'      => $l_bm_prv
    )
);

if ($bm_id != '' && strlen($board_msg) > 1) {
    $template->assign_block_vars('switch_board_msg', array());
}

?>