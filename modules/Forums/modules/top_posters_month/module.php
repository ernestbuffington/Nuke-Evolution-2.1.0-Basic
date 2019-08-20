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

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

//
// Top Posting Users this Month

$core->start_module(true);
$core->set_content('bars');
$core->set_view('rows', $core->return_limit);
$core->set_view('columns', 5);
$core->define_view('set_columns', array(
    $core->pre_defined('rank'),
    'username' => $lang['Username'],
    'posts' => $lang['Posts'],
    $core->pre_defined('percent'),
    $core->pre_defined('graph'))
);

$content->percentage_sign = TRUE;
$month = array();
$current_time = 0;
$current_time = time();
$year = date('Y', $current_time);
$month [0] = mktime (0,0,0,1,1, $year);
$month [1] = $month [0] + 2678400;
$month [2] = mktime (0,0,0,3,1, $year);
$month [3] = $month [2] + 2678400;
$month [4] = $month [3] + 2592000;
$month [5] = $month [4] + 2678400;
$month [6] = $month [5] + 2592000;
$month [7] = $month [6] + 2678400;
$month [8] = $month [7] + 2678400;
$month [9] = $month [8] + 2592000;
$month [10] = $month [9] + 2678400;
$month [11] = $month [10] + 2592000;
$month [12] = $month [11] + 2592000;
$arr_num = (date('n')-1);
$time_thismonth = $month[$arr_num];
$l_this_month = date('F', $time_thismonth);
$core->set_header($lang['module_name'] . ' [' . $l_this_month . ' ' . date('Y', $time_thismonth) . ']');
$core->assign_defined_view('align_rows', array(
    'left',
    'left',
    'center',
    'center',
    'left')
);

$sql = "SELECT u.user_id, u.user_color_gc, u.username, count(u.user_id) as user_posts
        FROM " . USERS_TABLE . " u, " . POSTS_TABLE . " p
        WHERE (u.user_id = p.poster_id) AND (p.post_time > '" . intval($time_thismonth) . "') AND (u.user_id <> " . ANONYMOUS . ")
        GROUP BY user_id, username
        ORDER BY user_posts DESC
        LIMIT " . $core->return_limit;
$result = $core->sql_query($sql, 'Unable to retrieve users data');
$total_posts_thismonth = 0;
$user_count = $core->sql_numrows($result);
$user_data = $core->sql_fetchrowset($result);
for ($i = 0; $i < $user_count; $i++) {
    $total_posts_thismonth += $user_data[$i]['user_posts'];
}
$content->init_math('user_posts', $user_data[0]['user_posts'], $total_posts_thismonth);
$core->set_data($user_data);
$core->define_view('set_rows', array(
    '$core->pre_defined()',
    '$core->generate_link(append_sid(\'profile.php?mode=viewprofile&amp;u=\' . $core->data(\'user_id\')), $core->data(\'username\'), \'target="_blank"\')',
    '$core->data(\'user_posts\')',
    '$core->pre_defined()',
    '$core->pre_defined()')
);
$core->run_module();

?>