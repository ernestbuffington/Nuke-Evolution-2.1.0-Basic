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

define('IN_PHPBB', TRUE);
global $_GETVAR, $ThemeInfoInfo;

$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR . $module_name. '/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

include($phpbb_root_path . 'common.php');

$lang_file = '/lang_auc.php';
if (@file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
// End session management

$group = $_GETVAR->get('id', '_REQUEST', 'int', NULL);
$exist = $_GETVAR->get('group', '_GET', 'string', NULL);
$i     = 1;

$template->set_filenames(array('body' => 'auc_listing_body.tpl') );

if($exist) {
    if($exist == 'admins') {
      $group_name = str_replace("%s", '', $lang['Admin_online_color']);
      $g          = ADMIN;
    } elseif($exist == 'mods') {
      $group_name = str_replace("%s", '', $lang['Mod_online_color']);
      $g          = MOD;
    } elseif($exist == 'less_admins') {
      $group_name = str_replace("%s", '', $lang['Super_Mod_online_color']);
      $g             = LESS_ADMIN;
    }

    $template->assign_vars(array(
        'T_L'        => $lang['listing_left'],
        'T_C_2'      => $group_name,
        'T_R'        => $lang['listing_right']
        )
    );
    $q = "SELECT user_id, username, user_msnm, user_yim, user_aim, user_icq, user_website, user_email, user_viewemail, user_level  FROM ". USERS_TABLE ."
         WHERE user_level = '". $g ."'
         AND user_active > 0
         AND user_id <> ".ANONYMOUS."
         ORDER BY user_id ASC";
    $r = $db->sql_query($q);
    while($row1 = $db->sql_fetchrow($r)) {
        $contact_img = EvoKernel_UserContactImg($row1);
        $info = $contact_img['online_status_img'].$contact_img['profile_img'].$contact_img['pm_img'].$contact_img['email_img'].$contact_img['www_img'].$contact_img['msn_img'].$contact_img['yim_script'].$contact_img['aim_img'].$contact_img['icq_script'];
        $row_color    = ( !($i % 2) ) ? $ThemeInfo['bgcolor1'] : $ThemeInfo['bgcolor2'];
        if (is_admin($row1['user_level'])) {
            $style_color = '#' . $ThemeInfo['fontcolor3'];
        } elseif ($row1['user_level'] == MOD) {
            $style_color = '#' . $ThemeInfo['fontcolor2'];
        } elseif ($row['user_level'] == LESS_ADMIN) {
            $style_color = '#' . $ThemeInfo['fontcolor4'];
        }
        $template->assign_block_vars("colors", array(
             'USER'         => "<span style='color:". $style_color ."'>". $row1['username'] ."</span>",
             'ROW_CLASS'    => $row_class,
             'INFO_LINE'    => $info)
                     );
        $i++;
    }
    $db->sql_freeresult($r);
} elseif ($group) {
    $sql = "SELECT *
            FROM ".AUC_TABLE."
            WHERE group_id = '". $group ."'";
    if (!$result = $db->sql_query($sql))
        message_die(GENERAL_ERROR, "Error Selecting Group Name.", "", __LINE__, __FILE__, $sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    $row1  = $db->sql_ufetchrowset("SELECT user_id, username, user_msnm, user_yim, user_aim, user_icq, user_website, user_email, user_viewemail, user_level FROM ". USERS_TABLE ."  
            WHERE user_color_gi  REGEXP  '(".$group.")' and user_active > 0 and user_id <> '".ANONYMOUS."' ORDER BY username ASC");
    $counted = count($row1);
    for ($a = 0; $a < $counted; $a++) {
        $i++;
        $contact_img = EvoKernel_UserContactImg($row1[$a]);
        $row_color    = ( !($a % 2) ) ? $ThemeInfo['bgcolor1'] : $ThemeInfo['bgcolor2'];
        $info = $contact_img['online_status_img'].$contact_img['profile_img'].$contact_img['pm_img'].$contact_img['email_img'].$contact_img['www_img'].$contact_img['msn_img'].$contact_img['yim_script'].$contact_img['aim_img'].$contact_img['icq_script'];

        $template->assign_block_vars('colors', array(
            'USER'         => UsernameColor($row1[$a]['username']),
            'ROW_COLOR'    => $row_color,
            'INFO_LINE'    => $info
            )
        );
    }
} else {
    redirect(append_sid('index.php'), TRUE);
}

if ($i == 1) {
    message_die(GENERAL_MESSAGE, sprintf($lang['listing_none'], '<strong>'. $row['group_name'] .'</strong>'));
}

$template->assign_vars(array(
    'T_L'   => $lang['listing_left'],
    'T_C_2' => $row['group_name'],
    'T_R'   => $lang['listing_right'])
);

// Generate page
include_once(NUKE_INCLUDE_DIR.'page_header.php');
$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>