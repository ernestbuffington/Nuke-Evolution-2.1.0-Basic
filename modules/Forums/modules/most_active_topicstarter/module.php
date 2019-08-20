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

// true == use db cache
$core->start_module(true);
$core->set_content('bars');
$core->set_view('rows', $core->return_limit);
$core->set_view('columns', 5);
$core->define_view('set_columns', array(
    $core->pre_defined('rank'),
    'username' => $lang['Username'],
    'posts' => $lang['Topics'],
    $core->pre_defined('percent'),
    $core->pre_defined('graph'))
);

$content->percentage_sign = TRUE;
$core->set_header($lang['module_name']);
$core->assign_defined_view('align_rows', array(
    'left',
    'left',
    'center',
    'center',
    'left')
);

$sql = "SELECT COUNT(topic_id) as total_topics FROM " . TOPICS_TABLE . " WHERE topic_status <> " . TOPIC_MOVED;
$result = $core->sql_query($sql, 'Unable to retrieve total topics');
$row = $core->sql_fetchrow($result);
$total_topics = $row['total_topics'];
$sql = "SELECT u.user_id, u.user_color_gc, u.username, COUNT(t.topic_poster) num_topics
        FROM " . USERS_TABLE . " u, " . TOPICS_TABLE . " t
        WHERE (t.topic_poster <> " . ANONYMOUS . ") AND (u.user_posts > 0) AND (u.user_id = t.topic_poster)
        GROUP BY t.topic_poster ORDER BY num_topics DESC
        LIMIT " . $core->return_limit;
$result = $core->sql_query($sql, 'Unable to retrieve user and topic data');
$data = $core->sql_fetchrowset($result);
$content->init_math('num_topics', $data[0]['num_topics'], $total_topics);
$core->set_data($data);
$core->define_view('set_rows', array(
    '$core->pre_defined()',
    '$core->generate_link(append_sid(\'profile.php?mode=viewprofile&amp;u=\' . $core->data(\'user_id\')), $core->data(\'username\'), \'target="_blank"\')',
    '$core->data(\'num_topics\')',
    '$core->pre_defined()',
    '$core->pre_defined()')
);

$core->run_module();

?>