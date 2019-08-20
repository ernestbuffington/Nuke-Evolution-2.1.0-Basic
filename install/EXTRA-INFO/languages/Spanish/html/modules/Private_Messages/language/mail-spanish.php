<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		BASIC
 Nuke-Evo Version       :		2.1.0RC2
 Nuke-Evo Build         :		2352
 Nuke-Evo Patch         :		---
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		03-Feb-2009

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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('ERROR: SERVERPATH AND FILELOCATION ARE DIFFERENT');
}

$lang_new[$module_name]['HELLO'] = 'Hola ';

$lang_new[$module_name]['PRIVMSG_SUBJECT'] = 'Nuevo mensaje privado en '.$board_config['sitename'].' ha llegado';
$lang_new[$module_name]['PRIVMSG_INFO'] = 'El miembro '. $userdata['username'].' from '.$board_config['sitename'].' haber enviadole un nuevo mensaje privado a su cuenta y usted ha pedido que usted quiere ser notificado en este acontecimiento. El contenido del mensaje es como sigue';
$lang_new[$module_name]['PRIVMSG_INFO2'] = 'Recordar que usted puede elegir siempre no ser notificado de nuevos mensajes cambiando el ajuste apropiado en su perfil.';

?>