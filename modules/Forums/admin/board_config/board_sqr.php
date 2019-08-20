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
    "sqr" => "admin/board_config/board_sqr.tpl")
);

$quickreply_yes             = ( $new['allow_quickreply'] ) ? 'checked="checked"' : '';
$quickreply_no              = ( !$new['allow_quickreply'] ) ? 'checked="checked"' : '';
$anonymous_sqr_mode_basic   = ( $new['anonymous_sqr_mode']==0 ) ? 'checked="checked"' : '';
$anonymous_sqr_mode_advanced = ( $new['anonymous_sqr_mode']!=0 ) ? 'checked="checked"' : '';
$anonymous_sqr_select       = quick_reply_select($new['anonymous_show_sqr'], 'anonymous_show_sqr');
$anonymous_open_sqr_yes     = ( $new['anonymous_open_sqr'] ) ? 'checked="checked"' : '';
$anonymous_open_sqr_no      = ( !$new['anonymous_open_sqr'] ) ? 'checked="checked"' : '';

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_SQR_SETTINGS'                => $lang['SQR_settings'],
    'L_ALLOW_QUICK_REPLY'           => $lang['Allow_quick_reply'],
    'L_ANONYMOUS_SHOW_SQR'          => $lang['Anonymous_show_SQR'],
    'L_ANONYMOUS_SQR_MODE'          => $lang['Anonymous_SQR_mode'],
    'L_ANONYMOUS_SQR_MODE_BASIC'    => $lang['Quick_reply_mode_basic'],
    'L_ANONYMOUS_OPEN_SQR'          => $lang['Anonymous_open_SQR'],
    'L_ANONYMOUS_SQR_MODE_ADVANCED' => $lang['Quick_reply_mode_advanced'],
));

//Data Template Variables
$template->assign_vars(array(
    'ANONYMOUS_SQR_SELECT'          => $anonymous_sqr_select,
    'QUICKREPLY_YES'                => $quickreply_yes,
    'QUICKREPLY_NO'                 => $quickreply_no,
    'ANONYMOUS_SQR_MODE_BASIC'      => $anonymous_sqr_mode_basic,
    'ANONYMOUS_SQR_MODE_ADVANCED'   => $anonymous_sqr_mode_advanced,
    'ANONYMOUS_OPEN_SQR_YES'        => $anonymous_open_sqr_yes,
    'ANONYMOUS_OPEN_SQR_NO'         => $anonymous_open_sqr_no,
 ));
$template->pparse('sqr');

?>