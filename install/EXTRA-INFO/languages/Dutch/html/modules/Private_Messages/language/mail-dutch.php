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

$lang_new[$module_name]['HELLO'] = 'Hallo ';
$lang_new[$module_name]['PRIVMSG_CLICK']   = 'Klik hier om u bericht te lezen: <a href="' . EVO_SERVER_URL .'/modules.php?name=Private_Messages&amp;folder=inbox">-Naar bericht-</a>';
$lang_new[$module_name]['PRIVMSG_INFO']    = 'Gebruiker '. $userdata['username'].' auf '.$board_config['sitename'].' heeft u een nieuw bericht gestuurd. U wou over nieuwe prive berichten geinformeerd worden. Het bericht luid:';
$lang_new[$module_name]['PRIVMSG_INFO2']   = 'U kunt de kennisgeving over nieuwe berichten elk moment in uw account deactiveren.';
$lang_new[$module_name]['PRIVMSG_SUBJECT'] = 'Er is voor u een nieuw bericht op '.$board_config['sitename'].' binnengekomen.';

?>