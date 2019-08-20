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

$lang_new[$module_name]['HELLO'] = 'Salut ';
$lang_new[$module_name]['PRIVMSG_CLICK']   = 'Cliquez ici pour lire vos messages priv&eacute;s : <a href="' . EVO_SERVER_URL .'/modules.php?name=Private_Messages&amp;folder=inbox">Vers vos messages</a>';
$lang_new[$module_name]['PRIVMSG_INFO']    = 'Le membre '. $userdata['username'].' du site'.$board_config['sitename'].' vient de vous envoyer un nouveau message priv&eacute; sur votre compte et vous avez souhait&eacute; &ecirc;tre inform&eacute; lors de la r&eacute;ception d\'un nouveau message. Le contenu du message est le suivant';
$lang_new[$module_name]['PRIVMSG_INFO2']   = 'Rappelez-vous que vous pouvez toujours choisir de ne pas &ecirc;tre averti des nouveaux messages en changeant le param&egrave;tre appropri&eacute; dans votre profil.';
$lang_new[$module_name]['PRIVMSG_SUBJECT'] = 'Nouveau message priv&eacute; est arrive&eacute; sur le site'.$board_config['sitename'].'.';

?>