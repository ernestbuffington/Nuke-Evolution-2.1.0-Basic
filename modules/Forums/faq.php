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
$userdata = session_pagestart($user_ip, PAGE_FAQ);
init_userprefs($userdata);
//
// End session management
//

// Set vars to prevent naughtiness
$faq    = array();
$mode   = $_GETVAR->get('mode', '_GET');
$dhtml  = $_GETVAR->get('dhtml', '_GET', 'string', 'yes');

//
// Load the appropriate faq file
//
switch($mode) {
    case 'bbcode':
        $lang_file = 'lang_bbcode';
        $l_title = $lang['BBCode_guide'];
            break;
    case 'faq_attach':
        $lang_file = 'lang_faq_attach';
        $l_title = $lang['BBCode_attach'];
        break;
    case 'rules':
        $lang_file = 'lang_rules';
        $l_title = $lang['BBCode_rules'];
        break;
    default:
        $lang_file = 'lang_faq';
        $l_title = $lang['FAQ'];
        break;
}

$lang_file = '/' . $lang_file . '.php';
if (@file_exists($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $currentlang . $lang_file);
} elseif (@file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file)) {
    include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . $lang_file);
} else {
    die('Neither your selected nor the board-default language-file could be found');
}

attach_faq_include($lang_file);

//
// Pull the array data from the lang pack
//
$j = 0;
$counter = 0;
$counter_2 = 0;
$faq_block = array();
$faq_block_titles = array();

for($i = 0; $i < count($faq); $i++) {
    if( $faq[$i][0] != '--' )  {
        $faq_block[$j][$counter]['id'] = $counter_2;
        $faq_block[$j][$counter]['question'] = $faq[$i][0];
        $faq_block[$j][$counter]['answer'] = $faq[$i][1];
        $counter++;
        $counter_2++;
    } else {
        $j = ( $counter != 0 ) ? $j + 1 : 0;
        $faq_block_titles[$j] = $faq[$i][1];
        $counter = 0;
    }
}

//
// Lets build a page ...
//
$page_title = $l_title;
include_once(NUKE_INCLUDE_DIR.'page_header.php');

$template->set_filenames(array(
    'body' => ($dhtml == 'no' ? 'faq_body.tpl' : 'faq_dhtml.tpl')
    )
);

$template->assign_vars(array(
    'U_CFAQ_JSLIB'      => NUKE_INCLUDE_HREF_DIR . 'collapsible_faq.js',
    'L_CFAQ_NOSCRIPT'   => sprintf($lang['dhtml_faq_noscript'], ('<a href="'.append_sid("faq.php?dhtml=no".($mode ? '&amp;mode='.$mode : '')).'">'), '</a>'),
    'L_FAQ_TITLE'       => $l_title,
    'L_BACK_TO_TOP'     => $lang['Back_to_top']
    )
);

for($i = 0; $i < count($faq_block); $i++) {
    if( count($faq_block[$i]) ) {
        $template->assign_block_vars('faq_block', array(
            'BLOCK_TITLE' => $faq_block_titles[$i]
            )
        );
        $template->assign_block_vars('faq_block_link', array(
            'BLOCK_TITLE' => $faq_block_titles[$i]
            )
        );
        for($j = 0; $j < count($faq_block[$i]); $j++) {
            $row_color = ( !($j % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( !($j % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
            $template->assign_block_vars('faq_block.faq_row', array(
                'ROW_COLOR'     => '#' . $row_color,
                'ROW_CLASS'     => $row_class,
                'FAQ_QUESTION'  => $faq_block[$i][$j]['question'],
                'FAQ_ANSWER'    => $faq_block[$i][$j]['answer'],
                'SPACER_IMG'    => $images['spacer'],
                'U_FAQ_ID'      => $faq_block[$i][$j]['id']
                )
            );
            $template->assign_block_vars('faq_block_link.faq_row_link', array(
                'ROW_COLOR'     => '#' . $row_color,
                'ROW_CLASS'     => $row_class,
                'FAQ_LINK'      => $faq_block[$i][$j]['question'],
                'U_FAQ_LINK'    => '#' . $faq_block[$i][$j]['id']
                )
            );
        }
    }
}

$template->pparse('body');
include_once(NUKE_INCLUDE_DIR.'page_tail.php');

?>