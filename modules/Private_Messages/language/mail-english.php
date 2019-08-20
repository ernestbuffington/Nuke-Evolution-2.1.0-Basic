<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

$lang_new[$module_name]['HELLO'] = 'Hello ';
$lang_new[$module_name]['PRIVMSG_CLICK']   = 'Click here to read your PM: <a href="' . EVO_SERVER_URL .'/modules.php?name=Private_Messages&amp;folder=inbox">-To your Message-</a>';
$lang_new[$module_name]['PRIVMSG_INFO']    = 'The member '. $userdata['username'].' from '.$board_config['sitename'].' has just sent you a new private message to your account and you have requested that you want to be notified on this event. The content of the message is as follow';
$lang_new[$module_name]['PRIVMSG_INFO2']   = 'Remember that you can always choose not to be notified of new messages by changing the appropriate setting in your profile.';
$lang_new[$module_name]['PRIVMSG_SUBJECT'] = 'New Private Message on '.$board_config['sitename'].' has arrived';

?>