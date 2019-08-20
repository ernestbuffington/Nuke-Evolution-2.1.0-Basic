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
    'private_messages' => 'admin/board_config/board_private_messages.tpl')
);

$privmsg_on     = ( !$new['privmsg_disable'] ) ? 'checked="checked"' : '';
$privmsg_off    = ( $new['privmsg_disable'] ) ? 'checked="checked"' : '';
$welcome_pm_yes = ( $new['welcome_pm'] ) ? 'checked="checked"' : '';
$welcome_pm_no  = ( !$new['welcome_pm'] ) ? 'checked="checked"' : '';
//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_PRIVATE_MESSAGING'           => $lang['Private_Messaging'],
    'L_DISABLE_PRIVATE_MESSAGING'   => $lang['Disable_privmsg'],
    'L_WELCOME_PM'                  => $lang['Welcome_PM_Admin'],
    'L_PM_ALLOW_THRESHOLD'          => $lang['pm_allow_threshold'],
    'L_PM_ALLOW_TRHESHOLD_EXPLAIN'  => $lang['pm_allow_threshold_explain'],
    'L_INBOX_LIMIT'                 => $lang['Inbox_limits'],
    'L_SENTBOX_LIMIT'               => $lang['Sentbox_limits'],
    'L_SAVEBOX_LIMIT'               => $lang['Savebox_limits'],
));

//Data Template Variables
$template->assign_vars(array(
    'S_PRIVMSG_ENABLED'             => $privmsg_on,
    'S_PRIVMSG_DISABLED'            => $privmsg_off,
    'S_WELCOME_PM_ENABLED'          => $welcome_pm_yes,
    'S_WELCOME_PM_DISABLED'         => $welcome_pm_no,
    'PM_ALLOW_THRESHOLD'            => $new['pm_allow_threshold'],
    'INBOX_LIMIT'                   => $new['max_inbox_privmsgs'],
    'SENTBOX_LIMIT'                 => $new['max_sentbox_privmsgs'],
    'SAVEBOX_LIMIT'                 => $new['max_savebox_privmsgs'],
 ));
$template->pparse('private_messages');

?>