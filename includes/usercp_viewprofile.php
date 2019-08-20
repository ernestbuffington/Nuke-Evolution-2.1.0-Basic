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

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

global $_GETVAR;

$users_url   = $_GETVAR->get(POST_USERS_URL, '_REQUEST', 'int');
if ( empty($users_url) || $users_url == ANONYMOUS ) {
    message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}
$profiledata = get_user_field('*', $users_url);

if (isset($profiledata['user_id']) && !empty($profiledata['user_id']) && is_array($profiledata['groups'])) {
    $groups = '';
    foreach($profiledata['groups'] as $group_id => $group) {
        if (!empty($group)) {
            $groups .= GroupColor($group) . "<br />";
        }
    }
} else {
    message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}

//
// Output page header and profile_view template
//
$template->set_filenames(array(
    'body' => 'profile_view_body.tpl')
);
if (is_active("Forums")) {
    make_jumpbox('viewforum.php');
}
//
// Calculate the number of days this user has been a member ($memberdays)
// Then calculate their posts per day
//
$regdate = $profiledata['user_regdate'];
$nukedate = strtotime($regdate);
$memberdays = max(1, round( ( time() - $nukedate ) / 86400 ));
$posts_per_day = $profiledata['user_posts'] / $memberdays;

// Get the users percentage of total posts
if ( $profiledata['user_posts'] != 0  )
{
    $total_posts = get_db_stat('postcount');
    $percentage = ( $total_posts ) ? min(100, ($profiledata['user_posts'] / $total_posts) * 100) : 0;
}
else
{
    $percentage = 0;
}

$avatar_img  = GetAvatar($profiledata['user_id']);
$ranksrow    = GetRank($profiledata['user_id']);
$rank_image  = ((isset($ranksrow['image']) && !empty($ranksrow['image'])) ? $ranksrow['image'] . '<br />' : '');
$poster_rank = ((isset($ranksrow['title']) && !empty($ranksrow['title'])) ? $ranksrow['title'] : '');

$contact_img = EvoKernel_UserContactImg($profiledata);
$temp_url = append_sid('search.php?search_author=' . urlencode($profiledata['username']) . '&amp;showresults=posts');
$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '" title="' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '" border="0" /></a>';
$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '</a>';

//
// Generate page
//
if(is_admin()) {
    $template->assign_vars(array(
        'L_USER_ADMIN_FOR' => $lang['User_admin_for'],
        'U_ADMIN_PROFILE'  => admin_sid('admin_users.php&amp;mode=edit&amp;u=' . $profiledata['user_id']))
    );
    $template->assign_block_vars('switch_user_admin', array());
}

$page_title = $lang['Viewing_profile'];
include(NUKE_INCLUDE_DIR . 'page_header.php');
display_upload_attach_box_limits($profiledata['user_id']);
$profiledata['user_from'] = str_replace(".gif", "", $profiledata['user_from']);

if (function_exists('get_html_translation_table')) {
    $u_search_author = urlencode(strtr($profiledata['username'], array_flip(get_html_translation_table(HTML_ENTITIES))));
} else {
    $u_search_author = urlencode(str_replace(array('&amp;', '&#039;', '&quot;', '&lt;', '&gt;'), array('&', "'", '"', '<', '>'), $profiledata['username']));
}

$user_sig = '';
if($profiledata['user_allowsignature'] == '0'){
    $user_sig = '\n';
} else {
    if(!empty($profiledata['user_sig'])) {
        include_once(NUKE_INCLUDE_DIR . 'bbcode.php');
        include_once(NUKE_INCLUDE_DIR . 'functions_post.php');
        $user_sig    = $profiledata['user_sig'];
        if ( !$board_config['allow_html'] || !$profiledata['user_allowhtml']) {
            if ( !empty($user_sig) ) {
                $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
            }
        }
        $user_sig_bbcode_uid = $profiledata['user_sig_bbcode_uid'];
        if ($user_sig != '' && $user_sig_bbcode_uid != '') {
            $user_sig = ($board_config['allow_bbcode']) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid, FALSE) : preg_replace("/\:$user_sig_bbcode_uid/si", '', $user_sig);
        }
        if ( !empty($user_sig) ) {
            $user_sig = make_clickable($user_sig);
        }
        if ( $board_config['allow_smilies'] ) {
            if ( !empty($user_sig) ) {
                $user_sig = smilies_pass($user_sig);
            }
        }
        if ( !empty($user_sig) ) {
            $template->assign_block_vars('user_sig', array());
            $user_sig = word_wrap_pass($user_sig);
            if ($board_config['sig_line'] == "<hr />" || $board_config['sig_line'] == "<hr />") {
                $user_sig = '<br />' . $board_config['sig_line']. str_replace("\n", "\n<br />\n", $user_sig);
            } else {
                $user_sig = $board_config['sig_line'].'<br />' . str_replace("\n", "\n<br />\n", $user_sig);
            }
        } else {
            $user_sig = '';
        }
    }
}

if($profiledata['bio']) {
    $template->assign_block_vars('user_extra', array());
}

$template->assign_vars(array(
    'USERNAME'          => UsernameColor($profiledata['username']),
    'JOINED'            => formatTimestamp(strtotime(substr($profiledata['user_regdate'], 4,2).' '.substr($profiledata['user_regdate'], 0,3).' '.substr($profiledata['user_regdate'], 8,4)), '', '1'),
    'GROUPS'            => $groups,
    'POSTER_RANK'       => $poster_rank,
    'RANK_IMAGE'        => $rank_image,
    'POSTS_PER_DAY'     => $posts_per_day,
    'POSTS'             => $profiledata['user_posts'],
    'PERCENTAGE'        => $percentage . '%',
    'POST_DAY_STATS'    => sprintf($lang['User_post_day_stats'], $posts_per_day),
    'POST_PERCENT_STATS' => sprintf($lang['User_post_pct_stats'], $percentage),
    'SEARCH_IMG'        => $search_img,
    'SEARCH'            => $search,
    'PM_IMG'            => $contact_img['pm_img'],
    'PM'                => $contact_img['pm'],
    'EMAIL_IMG'         => $contact_img['email_img'],
    'EMAIL'             => $contact_img['email'],
    'WWW_IMG'           => $contact_img['www_img'],
    'WWW'               => $contact_img['www'],
    'ICQ_STATUS_IMG'    => $contact_img['icq_status_img'],
    'ICQ_IMG'           => $contact_img['icq_img'],
    'ICQ'               => $contact_img['icq'],
    'ICQ_IMG_NOSCRIPT'  => $contact_img['icq_noscript'],
    'AIM_IMG'           => $contact_img['aim_img'],
    'AIM'               => $contact_img['aim'],
    'MSN_IMG'           => $contact_img['msn_img'],
    'MSN'               => $contact_img['msn'],
    'YIM_STATUS_IMG'    => $contact_img['yim_status_img'],
    'YIM_IMG'           => $contact_img['yim_img'],
    'YIM'               => $contact_img['yim'],
    'YIM_IMG_NOSCRIPT'  => $contact_img['yim_noscript'],
    'LOCATION'          => ( $profiledata['user_from'] ) ? $profiledata['user_from'] : '&nbsp;',
    'OCCUPATION'        => ( $profiledata['user_occ'] ) ? $profiledata['user_occ'] : '&nbsp;',
    'INTERESTS'         => ( $profiledata['user_interests'] ) ? $profiledata['user_interests'] : '&nbsp;',
    'EXTRA_INFO'        => ( $profiledata['bio'] ) ? $profiledata['bio'] : '&nbsp;',
    'AVATAR_IMG'        => $avatar_img,
    'USER_SIG'          => $user_sig,
    'L_SIG'             => $lang['Signature'],
    'L_VIEWING_PROFILE' => sprintf($lang['Viewing_user_profile'], UsernameColor($profiledata['username'])),
    'L_ABOUT_USER'      => sprintf($lang['About_user'], UsernameColor($profiledata['username'])),
    'L_AVATAR'          => $lang['Avatar'],
    'L_POSTER_RANK'     => $lang['Poster_rank'],
    'L_JOINED'          => $lang['Joined'],
    'L_GROUPS'          => $lang['Groups'],
    'L_TOTAL_POSTS'     => $lang['Total_posts'],
    'L_SEARCH_USER_POSTS' => sprintf($lang['Search_user_posts'], UsernameColor($profiledata['username'])),
    'L_CONTACT'         => $lang['Contact'],
    'L_EMAIL_ADDRESS'   => $lang['Email_address'],
    'L_EMAIL'           => $lang['Email'],
    'L_PM'              => $lang['Private_Message'],
    'L_ICQ_NUMBER'      => $lang['ICQ'],
    'L_YAHOO'           => $lang['YIM'],
    'L_AIM'             => $lang['AIM'],
    'L_MESSENGER'       => $lang['MSNM'],
    'L_WEBSITE'         => $lang['Website'],
    'L_LOCATION'        => $lang['Location'],
    'L_OCCUPATION'      => $lang['Occupation'],
    'L_INTERESTS'       => $lang['Interests'],
    'L_EXTRA_INFO'      => $lang['Extra_Info'],
/*--ARCADE MOD--*/
    'ONLINE_STATUS_IMG' => $contact_img['online_status_img'],
    'ONLINE_STATUS'     => $contact_img['online_status'],
    'L_ONLINE_STATUS'   => $lang['Online_status'],
    'U_SEARCH_USER'     => append_sid('search.php?search_author=' . $u_search_author),
    'S_PROFILE_ACTION'  => append_sid('profile.php'))
);

include_once(NUKE_INCLUDE_DIR . 'bbcode.php');

$xd_meta = get_xd_metadata();
$xdata   = get_user_xdata($HTTP_GET_VARS[POST_USERS_URL]);
while ( list($code_name, $info) = each($xd_meta) ) {
    $value = isset($xdata[$code_name]) ? $xdata[$code_name] : null;
    if ($info['field_type'] == 'date') {
        $value = formatTimestamp($value, '', TRUE);
    }
    if ( !$info['allow_html'] ) {
        $value = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $value);
    }
    if ( $info['allow_bbcode'] && $profiledata['user_sig_bbcode_uid'] != '') {
        $value = bbencode_second_pass($value, $profiledata['xdata_bbcode']);
    }
    if ($info['allow_bbcode']) {
        $value = make_clickable($value);
    }
    if ( $info['allow_smilies'] ) {
        $value = smilies_pass($value);
    }
    $value = str_replace("\n", "\n<br />\n", $value);
    if ( $info['display_viewprofile'] == XD_DISPLAY_NORMAL ) {
        if ( isset($xdata[$code_name]) ) {
            $template->assign_block_vars('xdata', array(
                'NAME' => $info['field_name'],
                'VALUE' => $value
                )
            );
        }
    } elseif ( $info['display_viewprofile'] == XD_DISPLAY_ROOT ) {
        if ( isset($xdata[$code_name]) ) {
            $template->assign_vars( array( $code_name => $value ) );
            $template->assign_block_vars( "switch_$code_name", array() );
        } else {
            $template->assign_block_vars( "switch_no_$code_name", array() );
        }
    }
}

if($profiledata['user_id'] == $userinfo['user_id']) {
    get_lang('Your_Account');
    define_once('CNBYA',true);
    include_once(NUKE_MODULES_DIR . 'Your_Account/public/navbar.php');
    nav(1);
}

$template->pparse('body');

global $admin;
if (is_admin()) {
    get_lang('Your_Account');
    echo "<center>";
    if($profiledata['user_lastvisit'] != 0){
        echo _LASTVISIT." <strong>".formatTimeStamp($profiledata['user_lastvisit'])."</strong><br />";
    } else {
        echo _LASTVISIT." <strong>"._LASTNA."</strong><br />";
    }
    if ($profiledata['last_ip'] != 0) {
        echo _LASTIP." <strong>".$profiledata['last_ip']."</strong><br /><br />";
        echo "[ <a href='".$admin_file.".php?op=ABBlockedIPAdd&amp;tip=".$profiledata['last_ip']."'>"._BANTHIS."</a> ]<br />";
    }
    echo "[ <a href=\"admin.php?op=Your_Account&amp;file=suspendUser&amp;chng_uid=".$profiledata['user_id']."\">"._SUSPENDUSER."</a> ] ";
    echo "[ <a href=\"admin.php?op=Your_Account&amp;file=deleteUser&amp;chng_uid=".$profiledata['user_id']."\">"._DELETEUSER."</a> ]<br />";
    echo "</center>";
}
global $currentlang;
if(!isset($currentlang)) { $currentlang = $nuke_config['language']; }
if (file_exists(NUKE_MODULES_DIR.'Your_Account/language/lang-'.$currentlang.'.php')) {
    @include_once(NUKE_MODULES_DIR.'Your_Account/language/lang-'.$currentlang.'.php');
} else {
    @include_once(NUKE_MODULES_DIR.'Your_Account/language/lang-english.php');
}
define_once('CNBYA',true);
$username = $profiledata['username'];
$usrinfo = $profiledata;
$incsdir = dir(NUKE_MODULES_DIR.'Your_Account/includes');
$incslist = '';
while($func=$incsdir->read()) {
    if(substr($func, 0, 3) == "ui-") {
        $incslist .= "$func ";
    }
}
closedir($incsdir->handle);
$incslist = explode(" ", $incslist);
sort($incslist);
for ($i=0; $i < count($incslist); $i++) {
    if($incslist[$i]!="") {
        $counter = 0;
        echo "<div style='text-align: left;'>\n";
        include($incsdir->path."/$incslist[$i]");
        echo "</div>\n";
    }
}

include_once(NUKE_INCLUDE_DIR . 'page_tail.php');

?>