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
global $_GETVAR;

$popup = $_GETVAR->get('popup', '_REQUEST', 'int', 0);

if ($popup != '1') {
    $module_name = basename(dirname(__FILE__));
    require(NUKE_MODULES_DIR.$module_name.'/nukebb.php');
} else {
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

include($phpbb_root_path . 'common.php');

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_RANKS);
init_userprefs($userdata);

//
// set the page title and include the page header
//
$lang_file = '/lang_extend_ranks.php';
if (@file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

$page_title = $lang['Ranks'];
include_once(NUKE_INCLUDE_DIR.'page_header.php');

// global pgm options
$auth_rank_only_logged = TRUE; // TRUE will required to be logged to have access, FALSE guest are welcome
$spe_rank_max_users    = -1; // number of displayed members in the memberlist : -1=all, 0=none, value=number
$std_rank_max_users    = 10; // number of displayed members in the memberlist : -1=all, 0=none, value=number

// check for inclusion
if ( isset($check_access) ) {
    return;
}

// only registered members have access if desired
if ( $auth_rank_only_logged && !$userdata['session_logged_in'] && !is_user() ) {
    redirect(append_sid('login.php?redirect=ranks.php', TRUE));
    exit;
}

//
// special ranks
$spe_ranks = array();
$sql = "SELECT `rank_image`, `rank_title`, `rank_id` FROM " . RANKS_TABLE . " WHERE rank_special = 1 ORDER BY rank_title";
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Couldn\'t read special ranks', '', __LINE__, __FILE__, $sql);
}
 
while ($row = $db->sql_fetchrow($result) ) {
    $spe_ranks[] = $row;
}
$db->sql_freeresult($result);

for ($i=0, $max=count($spe_ranks); $i < $max; $i++ ) {
    $rank       = $spe_ranks[$i]['rank_id'];
    $rank_title = $spe_ranks[$i]['rank_title'];
    $spe_ranks[$i]['user_number'] = 0;
    $spe_ranks[$i]['users_list'] = '';

    if ($spe_rank_max_users != 0 ) {
        if ($spe_rank_max_users == -1) {
            $limit_sql = '';
        } else {
            $limit_sql = 'LIMIT 0, '.$spe_rank_max_users;
        }
        // base sql request
        $sql_base = "SELECT `user_id`, `username` FROM `" . USERS_TABLE . "` WHERE `user_active` = 1 AND `user_rank` = $rank ORDER BY `username` ".$limit_sql;
        // get the number of users having this rank
        if ( !($result = $db->sql_query($sql_base)) ) {
            message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
        }
        $spe_ranks[$i]['user_number'] = $db->sql_numrows($result);
        // get the user list
        $j = 0;
        while ( $row = $db->sql_fetchrow($result) ) {
            $j++;
            if ( ($spe_rank_max_users <= 0) || ( $j <= $spe_rank_max_users ) ) {
                $spe_ranks[$i]['users_list'] .= ($spe_ranks[$i]['users_list'] == '') ? '' : ', ';
                $spe_ranks[$i]['users_list'] .= '<a href="' . "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']  . '" class="gensmall">' . UsernameColor($row['username']) . '</a>';
            } else {
                $spe_ranks[$i]['users_list'] .= ($spe_ranks[$i]['users_list'] == '') ? '' : ', ';
                $spe_ranks[$i]['users_list'] .= ( !$profilcp ) ? '...' : '<a href="' . "modules.php?name=Profile&amp;mode=buddy&amp;sub=memberlist&amp;filter=user_rank_title&amp;comp=eq&amp;fvalue=$rank_title" . '" class="gensmall">...</a>';
            }
        }
        $db->sql_freeresult($result);        
    }
    if ($spe_ranks[$i]['user_number'] > 0) {
      $spe_ranks[$i]['users_list'] = '(' . $spe_ranks[$i]['user_number'] . ') ' . $spe_ranks[$i]['users_list'];
    }
}

//
// standard ranks
$ranks = array();
$sql = "SELECT `rank_image`, `rank_title`, `rank_id`, `rank_min` FROM " . RANKS_TABLE . " WHERE rank_special <> 1 ORDER BY rank_min";
if ( !($result = $db->sql_query($sql)) ) {
    message_die(GENERAL_ERROR, 'Couldn\'t read standard ranks', '', __LINE__, __FILE__, $sql);
}
while ($row = $db->sql_fetchrow($result) ) {
    $ranks[] = $row;
}
$db->sql_freeresult($result);

$rank_max = 99999999;
for ($i=count($ranks)-1; $i >=0; $i--) {
    $ranks[$i]['rank_max'] = $rank_max;
    $rank_title = $ranks[$i]['rank_title'];
    $rank_min = $ranks[$i]['rank_min'];

    // count users
    $ranks[$i]['user_number'] = $db->sql_unumrows("SELECT `user_id` FROM `" . USERS_TABLE . "` WHERE `user_active` = 1 AND `user_id` <> '".ANONYMOUS."' AND (`user_rank` = 0 OR `user_rank` IS NULL) AND `user_posts` >= '".$rank_min."'" . (($rank_max < 99999999)  ? " AND `user_posts` < ".$rank_max : '' ));
    // get the user list
    if ( $std_rank_max_users != 0 )  {
        $sql = $sql_base;
        if ( $std_rank_max_users != 0 ) {
          $sql .= " LIMIT 0, " . ($std_rank_max_users + 1);
        }
        if ( !($result = $db->sql_query($sql)) ) {
          message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
        }
        $j = 0;
        while ( $row = $db->sql_fetchrow($result) ) {
            $j++;
            if ( ($std_rank_max_users < 1) || ( $j <= $std_rank_max_users ) ) {
                $ranks[$i]['users_list'] .= ($ranks[$i]['users_list'] == '') ? '' : ', ';
                $ranks[$i]['users_list'] .= '<a href="' . "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id'] . '" class="gensmall">' . UsernameColor($row['username']) . '</a>';
            } else {
                $ranks[$i]['users_list'] .= ($ranks[$i]['users_list'] == '') ? '' : ', ';
                $ranks[$i]['users_list'] .= ( !$profilcp ) ? '...' : '<a href="' . "modules.php?name=Profile&amp;mode=buddy&amp;sub=memberlist&amp;filter=user_rank_title&amp;comp=eq&amp;fvalue=$rank_title" . '" class="gensmall">...</a>';
            }
        }
        $db->sql_freeresult($result);
    }
    // store the next limit
    $rank_max = $ranks[$i]['rank_min'];
    // number of user beyond userlist
    if ($ranks[$i]['user_number'] > 0) {
        $ranks[$i]['users_list'] = '(' . $ranks[$i]['user_number'] . ') ' . $ranks[$i]['users_list'];
    }
}

//
// template setting
//
$template->set_filenames(array(
    'body' => 'ranks_body.tpl')
);

// constants
$template->assign_vars(array(
    'L_SPECIAL_RANKS'   => $lang['Special_ranks'],
    'L_USERS_LIST'      => $lang['Memberlist'],
    'L_RANKS'           => $lang['Ranks'],
    'L_MINI'            => $lang['Rank_minimum'],
    'L_TOTAL_USERS'     => $lang['Total_users'],
    'SPAN_USERLIST_STD' => ($std_rank_max_users > 0) ? 2 : 1,
    'S_HIDDEN_FIELDS'   => '',
    )
);

// standard ranks
if ($std_rank_max_users != 0) {
    $template->assign_block_vars('std_userlist', array());
} else {
    $template->assign_block_vars('no_std_userlist', array());
}
$count_ranks = count($ranks);
for ($i=0; $i < $count_ranks; $i++) {
    $template->assign_block_vars('ranks', array(
        'RANK_TITLE' => $ranks[$i]['rank_title'],
        'RANK_IMAGE' => ($ranks[$i]['rank_image'] == '') ? '' : '<img src="' . $ranks[$i]['rank_image'] . '" border="0" alt="' . $ranks[$i]['rank_title'] . '" />',
        'RANK_MINI'  => $ranks[$i]['rank_min'],
        'RANK_TOTAL' => $ranks[$i]['user_number'],
        )
    );
    if ($std_rank_max_users != 0 && !empty($ranks[$i]['users_list'])) {
        $template->assign_block_vars('ranks.userlist', array(
            'USERS_LIST' => $ranks[$i]['users_list'],
            )
        );
    } elseif ($std_rank_max_users != 0 && empty($ranks[$i]['users_list'])) {
        $template->assign_block_vars('ranks.userlist', array(
            'USERS_LIST' => '---',
            )
        );
    } else  {
        $template->assign_block_vars('ranks.no_userlist', array());
    }
}

// special ranks
if ($spe_rank_max_users != 0) {
    $template->assign_block_vars('spe_userlist', array());
} else {
    $template->assign_block_vars('no_spe_userlist', array());
}
$count_spe_ranks = count($spe_ranks);
for ($i=0; $i < $count_spe_ranks; $i++) {
    $template->assign_block_vars('spe_ranks', array(
        'RANK_TITLE' => $spe_ranks[$i]['rank_title'],
        'RANK_IMAGE' => ($spe_ranks[$i]['rank_image'] == '') ? '' : '<img src="' . $spe_ranks[$i]['rank_image'] . '" border="0" alt="' . $spe_ranks[$i]['rank_title'] . '" />',
        )
    );
    if ($spe_rank_max_users != 0 && !empty($spe_ranks[$i]['users_list'])) {
        $template->assign_block_vars('spe_ranks.userlist', array(
            'USERS_LIST' => $spe_ranks[$i]['users_list'],
            )
        );
    } elseif ($spe_rank_max_users != 0 && empty($spe_ranks[$i]['users_list'])) {
        $template->assign_block_vars('spe_ranks.userlist', array(
            'USERS_LIST' => '---',
            )
        );
    } else {
        $template->assign_block_vars('spe_ranks.no_userlist', array(
            'RANK_TOTAL' => $spe_ranks[$i]['user_number'],
            )
        );
    }
}

//
// page footer
//
$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>