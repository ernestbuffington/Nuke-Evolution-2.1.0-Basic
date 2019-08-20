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
    'word' => $lang['Word'],
    'count' => $lang['Count'],
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

$total_words = $db->sql_unumrows("SELECT word_id FROM ".SEARCH_MATCH_TABLE);
$sql = "SELECT Count(word_id) AS word_count, word_id
        FROM " . SEARCH_MATCH_TABLE . "
        GROUP BY word_id
        ORDER BY word_count DESC
        LIMIT 10";
$result   = $core->sql_query($sql, 'Unable to retrieve word count data');
$temp_data = $core->sql_fetchrowset($result);
for ($i = 0; $i <10; $i++) {
    $word_text = $db->sql_ufetchrow("SELECT word_text from ".SEARCH_WORD_TABLE." WHERE word_id = '".$temp_data[$i]['word_id']."'");
    $data[$i]['word_text']  = $word_text['word_text'];
    $data[$i]['word_count'] = $temp_data[$i]['word_count'];
}
$content->init_math('word_count', $data[0]['word_count'], $total_words);
$core->set_data($data);
$core->define_view('set_rows', array(
    '$core->pre_defined()',
    '$core->data(\'word_text\')',
    '$core->data(\'word_count\')',
    '$core->pre_defined()',
    '$core->pre_defined()')
);
$core->run_module();

?>