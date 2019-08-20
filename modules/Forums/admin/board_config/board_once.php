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
    'once' => 'admin/board_config/board_once.tpl')
);
$show_sig_once_yes      = ( $new['show_sig_once'] )     ? 'checked="checked"' : '';
$show_sig_once_no       = ( !$new['show_sig_once'] )    ? 'checked="checked"' : '';
$show_avatar_once_yes   = ( $new['show_avatar_once'] )  ? 'checked="checked"' : '';
$show_avatar_once_no    = ( !$new['show_avatar_once'] ) ? 'checked="checked"' : '';
$show_rank_once_yes     = ( $new['show_rank_once'] )    ? 'checked="checked"' : '';
$show_rank_once_no      = ( !$new['show_rank_once'] )   ? 'checked="checked"' : '';

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_ONCE_SETTINGS'       => $lang['once_settings'],
    'L_SHOW_SIG_ONCE'       => $lang['show_sig_once'],
    'L_SHOW_AVATAR_ONCE'    => $lang['show_avatar_once'],
    'L_SHOW_RANK_ONCE'      => $lang['show_rank_once']
));

//Data Template Variables
$template->assign_vars(array(
    'SHOW_SIG_ONCE_YES'     => $show_sig_once_yes,
    'SHOW_SIG_ONCE_NO'      => $show_sig_once_no,
    'SHOW_AVATAR_ONCE_YES'  => $show_avatar_once_yes,
    'SHOW_AVATAR_ONCE_NO'   => $show_avatar_once_no,
    'SHOW_RANK_ONCE_YES'    => $show_rank_once_yes,
    'SHOW_RANK_ONCE_NO'     => $show_rank_once_no
 ));
$template->pparse('once');

?>