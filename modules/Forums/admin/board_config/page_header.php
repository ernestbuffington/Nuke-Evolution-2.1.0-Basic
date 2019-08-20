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
    'head' => 'admin/board_config/page_header.tpl')
);

if ( $new['use_dhtml'] ) {
    $template->assign_block_vars('use_dhtml', array());
}

$template->assign_vars(array(
    'DHTML_DISPLAY'         => $dhtml_display,
    'DHTML_HAND'            => $dhtml_hand,
    'DHTML_ONCLICK'         => $dhtml_onclick,
    'S_CONFIG_ACTION'       => admin_sid('admin_board.php'),
    'L_YES'                 => $lang['Yes'],
    'L_NO'                  => $lang['No'],
    'L_ENABLED'             => $lang['Enabled'],
    'L_DISABLED'            => $lang['Disabled'],
    'L_CONFIGURATION_TITLE' => $lang['General_Config'],
    'L_CONFIGURATION_EXPLAIN' => $lang['Config_explain'])
);

$template->pparse('head');

?>