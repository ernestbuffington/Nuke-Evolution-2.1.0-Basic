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
// New Topics by Month
//
$core->start_module(true);
$core->set_content('values');
$sql = "SELECT YEAR(FROM_UNIXTIME(topic_time)) as year_topic, MONTH(FROM_UNIXTIME(topic_time)) as month_topic, COUNT(*) AS num_topics 
        FROM " . TOPICS_TABLE . " 
        GROUP BY YEAR(FROM_UNIXTIME(topic_time)), MONTH(FROM_UNIXTIME(topic_time)) 
        ORDER BY topic_time";
$result = $core->sql_query($sql, 'Couldn\'t retrieve users data');
$row_count = $core->sql_numrows($result);
$rows = $core->sql_fetchrowset($result);
$month_array = array();

for ($i = 0; $i < $row_count; $i++){
    $month_array[$rows[$i]['year_topic']][($rows[$i]['month_topic']-1)]['num_topics'] = $rows[$i]['num_topics'];
}
@reset($month_array);
while (list($year, $data) = each($month_array)){
    for ($i = 0; $i < 12; $i++) {
        if (!isset($month_array[$year][$i])) {
            $month_array[$year][$i]['num_topics'] = 0;
        }
    }
}
@reset($month_array);
$year_ar = array();
$month_1 = array();
$month_2 = array();
$month_3 = array();
$month_4 = array();
$month_5 = array();
$month_6 = array();
$month_7 = array();
$month_8 = array();
$month_9 = array();
$month_10 = array();
$month_11 = array();
$month_12 = array();

while (list($year, $data) = each($month_array)) {
    $year_ar[] = $year;
    for ($i = 0; $i < 12; $i++) {
        eval("\$month_" . ($i+1) . "[] = \$month_array[\$year][\$i]['num_topics'];");
    }
}
$core->set_view('columns', 13);
$core->set_view('num_blocks', 1);
$core->set_view('value_order', 'left_right');
$core->define_view('set_columns', array(
    'year' => $lang['Year'],
    '1' => $lang['Month_jan'],
    '2' => $lang['Month_feb'],
    '3' => $lang['Month_mar'],
    '4' => $lang['Month_apr'],
    '5' => $lang['Month_may'],
    '6' => $lang['Month_jun'],
    '7' => $lang['Month_jul'],
    '8' => $lang['Month_aug'],
    '9' => $lang['Month_sep'],
    '10' => $lang['Month_oct'],
    '11' => $lang['Month_nov'],
    '12' => $lang['Month_dec'])
);
$core->set_header($lang['module_name']);
$data = $core->assign_defined_view('value_array', array(
    $year_ar, 
    $month_1,
    $month_2,
    $month_3,
    $month_4,
    $month_5,
    $month_6,
    $month_7,
    $month_8,
    $month_9,
    $month_10,
    $month_11,
    $month_12)
);

$core->set_data($data);
$core->define_view('iterate_values', array());
$core->run_module();

?>