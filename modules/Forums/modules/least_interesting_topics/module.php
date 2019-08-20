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
// Most Interesting Topics
//

$core->start_module(true);
$core->set_content('statistical');
$core->set_view('rows', $core->return_limit);
$core->set_view('columns', 3);
$core->define_view('set_columns', array(
    $core->pre_defined('rank'),
    'rate' => $lang['Rate'],
    'topic' => $lang['Topic'])
);

$core->set_header($lang['module_name']);
$core->assign_defined_view('align_rows', array(
    'left',
    'center',
    'left')
);
$core->assign_defined_view('width_rows', array(
    '',
    '20%',
    '')
);

$sql = 'SELECT topic_id, forum_id, topic_title, topic_replies, topic_views, topic_views/(topic_replies + 1) AS k
        FROM ' . TOPICS_TABLE . '
        WHERE (topic_status <> 2) AND (topic_replies > 0)
        ORDER BY k ASC
        LIMIT ' . $core->return_limit;
$result = $core->sql_query($sql, 'Couldn\'t retrieve topic data');
$topic_data = $core->sql_fetchrowset($result);
$core->set_data($topic_data);
$core->topic_smiles();
//
// Now this one could get a big beast
// We will explain the structure, no fear, but not now. :D
//
$core->define_view('set_rows', array(
    '$core->pre_defined()',
    '$core->data(\'k\')',
    '$core->generate_link(append_sid(\'viewtopic.php?t=\' . $core->data(\'topic_id\')), $core->data(\'topic_title\'), \'target="_blank"\')'
    ),
    array(
        '$core->data(\'forum_id\')', 'auth_view AND auth_read', 'forum', array(
            '',
            '$core->data(\'k\')',
            '$lang[\'Hidden_from_public_view\']'
        )
    )
);

$core->run_module();

?>