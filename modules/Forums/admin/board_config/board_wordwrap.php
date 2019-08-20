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
    'wordwrap' => 'admin/board_config/board_wordwrap.tpl')
);

$wrap_enable_yes = ( $new['wrap_enable'] ) ? 'checked="checked"' : '';
$wrap_enable_no  = ( !$new['wrap_enable'] ) ? 'checked="checked"' : '';

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_WRAP_TITLE'  => $lang['wrap_title'],
    'L_ENABLE_WRAP' => $lang['wrap_enable'],
    'L_WRAP_MIN'    => $lang['wrap_min'],
    'L_WRAP_MAX'    => $lang['wrap_max'],
    'L_WRAP_DEF'    => $lang['wrap_def'],
    'L_WRAP_UNITS'  => $lang['wrap_units'],
));

//Data Template Variables
$template->assign_vars(array(
    'WRAP_ENABLE'   => $wrap_enable_yes,
    'WRAP_DISABLE'  => $wrap_enable_no,
    'WRAP_MIN'      => $new['wrap_min'],
    'WRAP_DEF'      => $new['wrap_def'],
    'WRAP_MAX'      => $new['wrap_max'],
));
$template->pparse('wordwrap');

?>