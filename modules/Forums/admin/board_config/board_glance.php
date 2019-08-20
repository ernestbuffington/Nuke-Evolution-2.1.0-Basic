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

if (!defined('ADMIN_FILE') && !defined('FORUM_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    'glance' => 'admin/board_config/board_glance.tpl')
);

$glance_show              = glance_option_select($new['glance_show'], 'glance_show');
$glance_show_override_yes = ( $new['glance_show_override'] ) ? 'checked ="checked"' : '';
$glance_show_override_no  = ( !$new['glance_show_override'] ) ? 'checked = "checked"' : '';
$glance_auth_read_yes     = ( $new['glance_auth_read'] ) ? 'checked = "checked"' : '';
$glance_auth_read_no      = ( !$new['glance_auth_read'] ) ? 'checked = "checked"' : '';

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_GLANCE_SHOW'                 => $lang['glance_show'],
    'L_GLANCE_TITLE'                => $lang['glance_title'],
    'L_GLANCE_OVERRIDE_TITLE'       => $lang['glance_override_title'],
    'L_GLANCE_NEWS_EXPLAIN'         => $lang['glance_news_explain'],
    'L_GLANCE_NUM_NEWS_EXPLAIN'     => $lang['glance_num_news_explain'],
    'L_GLANCE_NUM_EXPLAIN'          => $lang['glance_num_explain'],
    'L_GLANCE_IGNORE_FORUMS'        => $lang['glance_ignore_forums_explain'],
    'L_GLANCE_TABLE_WIDTH'          => $lang['glance_table_width_explain'],
    'L_GLANCE_AUTH_READ_EXPLAIN'    => $lang['glance_auth_read_explain'],
    'L_GLANCE_TOPIC_LENGTH_EXPLAIN' => $lang['glance_topic_length_explain'],
));

//Data Template Variables
$template->assign_vars(array(
    'GLANCE_SELECT'                 => $glance_show,
    'GLANCE_SHOW_OVERRIDE_YES'      => $glance_show_override_yes,
    'GLANCE_SHOW_OVERRIDE_NO'       => $glance_show_override_no,
    'GLANCE_AUTH_READ_YES'          => $glance_auth_read_yes,
    'GLANCE_AUTH_READ_NO'           => $glance_auth_read_no,
    'GLANCE_NEWS_ID'                => $new['glance_news_id'],
    'GLANCE_NUM_NEWS'               => $new['glance_num_news'],
    'GLANCE_NUM'                    => $new['glance_num'],
    'GLANCE_IGNORE_FORUMS'          => $new['glance_ignore_forums'],
    'GLANCE_TABLE_WIDTH'            => $new['glance_table_width'],
    'GLANCE_TOPIC_LENGTH'           => $new['glance_topic_length'],
));
$template->pparse('glance');

?>