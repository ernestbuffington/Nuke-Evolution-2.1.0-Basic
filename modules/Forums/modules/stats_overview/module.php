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
// Statistics Overview
// 
$core->start_module(true);
$core->set_content('values');
 // configuration of module: number of columns to use for displaying the links, may be 1..n
$user_variables = $core->get_user_defines();
$use_num_columns = intval($user_variables['num_columns']);
$core->set_view('columns', 1);
$core->set_view('num_blocks', $use_num_columns);
$core->set_view('value_order', 'up_down');
$core->define_view('set_columns', array(
    'stats' => '&nbsp;')
);

$core->set_header($lang['module_name']);
//
// Use internal Functions to get an array of installed and activated Modules (and their Names)
// -> Link: <a href="#module_id">lang['module_name']</a>
//
$current_modules = get_modules();
$link_array = array();
for ($i = 0, $max = count($current_modules); $i < $max; $i++) {
    $module_id = intval($current_modules[$i]['module_id']);
    $module_short_name = trim($current_modules[$i]['short_name']);
    eval('$current_module_name = $' . $module_short_name . '[\'module_name\'];');
    if (empty($current_module_name)) {
        $current_module_name = $module_short_name;
    }
    $link_array[] = '<a href="#' . $module_short_name . '">' . $current_module_name . '</a>';
}

$data = $core->assign_defined_view('value_array', array($link_array));
$core->set_data($data);
$core->define_view('iterate_values', array());
$core->run_module();

?>