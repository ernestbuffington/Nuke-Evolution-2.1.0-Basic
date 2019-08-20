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
    'quick_reply' => 'admin/board_config/board_quick_reply.tpl')
);

$ropm_quick_reply_yes     = ( $new['ropm_quick_reply'] ) ? 'checked="checked"' : '';
$ropm_quick_reply_no      = ( !$new['ropm_quick_reply'] ) ? 'checked="checked"' : '';
$ropm_quick_reply_bbc_yes = ( $new['ropm_quick_reply_bbc'] ) ? 'checked="checked"' : '';
$ropm_quick_reply_bbc_no  = ( !$new['ropm_quick_reply_bbc'] ) ? 'checked="checked"' : '';

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_ENABLE_ROPM_QUICK_REPLY'         => $lang['enable_ropm_quick_reply'],
    'L_ROPM_QUICK_REPLY'                => $lang['ropm_quick_reply'],
    'L_ROPM_QUICK_REPLY_BBC'            => $lang['ropm_quick_reply_bbc'],
    'L_ROPM_QUICK_REPLY_SMILIES'        => $lang['ropm_quick_reply_smilies'],
    'L_ROPM_QUICK_REPLY_SMILIES_INFO'   => $lang['ropm_quick_reply_smilies_info'],
));

//Data Template Variables
$template->assign_vars(array(
    'ROPM_QUICK_REPLY_YES'              => $ropm_quick_reply_yes,
    'ROPM_QUICK_REPLY_NO'               => $ropm_quick_reply_no,
    'ROPM_QUICK_REPLY_BBC_YES'          => $ropm_quick_reply_bbc_yes,
    'ROPM_QUICK_REPLY_BBC_NO'           => $ropm_quick_reply_bbc_no,
    'ROPM_QUICK_REPLY_SMILIES'          => $new['ropm_quick_reply_smilies'],
 ));
$template->pparse('quick_reply');

?>