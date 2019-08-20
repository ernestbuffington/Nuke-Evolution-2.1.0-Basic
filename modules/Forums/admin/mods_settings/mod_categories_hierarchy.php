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

// service functions
include_once(NUKE_INCLUDE_DIR . 'functions_mods_settings.php');
$lang_file = '/lang_extend_categories_hierarchy.php';
if (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file)) {
    include(NUKE_FORUMS_DIR . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include(NUKE_FORUMS_DIR . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

// mod definition
$mod_name = 'Hierarchy_setting';
$config_fields = array(
    'sub_forum' => array(
        'lang_key'  => 'Use_sub_forum',
        'explain' => 'Index_packing_explain',
        'type'    => 'LIST_RADIO',
        'default' => 'Medium',
        'user'    => 'user_sub_forum',
        'values'  => array(
            'None'    => 0,
            'Medium'  => 1,
            'Full'    => 2,
            ),
        ),
    'split_cat'     => array(
        'lang_key'  => 'Split_categories',
        'type'    => 'LIST_RADIO',
        'default' => 'Yes',
        'user'    => 'user_split_cat',
        'values'  => $list_yes_no,
    ),
    'last_topic_title' => array(
        'lang_key'  => 'Use_last_topic_title',
        'type'    => 'LIST_RADIO',
        'default' => 'Yes',
        'user'    => 'user_last_topic_title',
        'values'  => $list_yes_no,
    ),
    'last_topic_title_length' => array(
        'lang_key'  => 'Last_topic_title_length',
        'type'    => 'TINYINT',
        'default' => 24,
    ),
    'sub_level_links' => array(
        'lang_key'  => 'Sub_level_links',
        'explain' => 'Sub_level_links_explain',
        'type'    => 'LIST_RADIO',
        'default' => 'With_pics',
        'user'    => 'user_sub_level_links',
        'values'  => array(
            'No'    => 0,
            'Yes'   => 1,
            'With_pics' => 2,
        ),
    ),
    'display_viewonline' => array(
        'lang_key'  => 'Display_viewonline',
        'type'    => 'LIST_RADIO',
        'default' => 'Always',
        'user'    => 'user_display_viewonline',
        'values'  => array(
            'Never'           => 0,
            'Root_index_only' => 1,
            'Always'          => 2,
        ),
    ),
    'max_posts' => array(
        'lang_key'  => 'max_posts',
        'type'    => 'INT',
        'default' => '0',
        'hide'    => TRUE,
    ),
    'max_topics' => array(
        'lang_key'  => 'max_topics',
        'type'    => 'INT',
        'default' => '0',
        'hide'    => TRUE,
    ),
    'max_users' => array(
        'lang_key'  => 'max_users',
        'type'    => 'INT',
        'default' => '0',
        'hide'    => TRUE,
    ),
);

// init config table
init_board_config($mod_name, $config_fields);

?>