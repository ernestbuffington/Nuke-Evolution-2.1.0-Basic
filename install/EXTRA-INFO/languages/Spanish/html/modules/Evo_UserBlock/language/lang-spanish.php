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

global $lang_evo_userblock;

//Common
$lang_evo_userblock['BLOCK']['EVO_USERINFO'] = 'Bloque UserInfo Evolution';
$lang_evo_userblock['BLOCK']['ANON'] = 'An&oacute;nimo';
$lang_evo_userblock['BLOCK']['BREAK'] = ':';

//Error
$lang_evo_userblock['BLOCK']['ERR_NF'] = 'No se pudo obtener valores de los addons';

//Login
$lang_evo_userblock['BLOCK']['LOGIN']['REG'] = 'Registrarse';
$lang_evo_userblock['BLOCK']['LOGIN']['LOST'] = 'Perd&iacute; Contrase&ntilde;a';
$lang_evo_userblock['BLOCK']['LOGIN']['DELCOOKIE'] = 'Limpiar Cookies?';
$lang_evo_userblock['BLOCK']['LOGIN']['LOGIN'] = 'Conectarse';
$lang_evo_userblock['BLOCK']['LOGIN']['USERNAME'] = 'Nombre de Usuario';
$lang_evo_userblock['BLOCK']['LOGIN']['PASSWORD'] = 'Contrase&ntilde;a';
$lang_evo_userblock['BLOCK']['LOGIN']['LOGOUT'] = 'Desconectarse';
$lang_evo_userblock['BLOCK']['LOGIN']['COOKIECLEAR'] = 'Limpiar Cookies';

//Online
$lang_evo_userblock['BLOCK']['ONLINE']['BREAK'] = ':';
$lang_evo_userblock['BLOCK']['ONLINE']['HIDDEN'] = 'Ocultar';
$lang_evo_userblock['BLOCK']['ONLINE']['VISIBLE'] = 'Visible';
$lang_evo_userblock['BLOCK']['ONLINE']['GUESTS'] = 'Invitado(s)';
$lang_evo_userblock['BLOCK']['ONLINE']['MEMBERS'] = 'Miembro(s)';
$lang_evo_userblock['BLOCK']['ONLINE']['TOTAL'] = 'Total';
$lang_evo_userblock['BLOCK']['ONLINE']['GUEST'] = 'Invitado';
$lang_evo_userblock['BLOCK']['ONLINE']['VIEW'] = 'Ver';
$lang_evo_userblock['BLOCK']['ONLINE']['PROFILE'] = 'Perf&iacute;l';
$lang_evo_userblock['BLOCK']['ONLINE']['ONLINE'] = 'En l&iacute;nea';
$lang_evo_userblock['BLOCK']['ONLINE']['STATS'] = 'Estad&iacute;sticas en L&iacute;nea';

//Language
$lang_evo_userblock['BLOCK']['LANG']['SELECT'] = 'Elegir Idioma';

//Most Online
$lang_evo_userblock['BLOCK']['MOST']['MOST'] = 'Top en L&iacute;nea';
$lang_evo_userblock['BLOCK']['MOST']['STATS'] = 'Estad&iacute;sticas';
$lang_evo_userblock['BLOCK']['ONLINE']['DATE'] = 'Fecha';
$lang_evo_userblock['BLOCK']['ONLINE']['BOTS'] = 'Motores de b&uacute;squeda';

//PMs
$lang_evo_userblock['BLOCK']['PMS']['INBOX'] = 'Bandeja Entrada';
$lang_evo_userblock['BLOCK']['PMS']['OPEN_INBOX'] = 'Leer Mensajes';

//Members
$lang_evo_userblock['BLOCK']['MEMBERS']['MEMBERS'] = 'Membres&iacute;as de Grupo';

//Users
$lang_evo_userblock['BLOCK']['USERS']['MEMBERSHIPS'] = 'Membres&iacute;as';
$lang_evo_userblock['BLOCK']['USERS']['NEW_TODAY'] = 'Nuevos Hoy';
$lang_evo_userblock['BLOCK']['USERS']['NEW_YESTERDAY'] = 'Nuevos Ayer';
$lang_evo_userblock['BLOCK']['USERS']['WAITING'] = 'Esperando';
$lang_evo_userblock['BLOCK']['USERS']['TOTAL'] = 'Total';
$lang_evo_userblock['BLOCK']['USERS']['LATEST'] = '&Uacute;ltimo';

//Posts
$lang_evo_userblock['BLOCK']['POSTS']['FORUMS'] = 'Foros';
$lang_evo_userblock['BLOCK']['POSTS']['TOPICS'] = 'Temas';
$lang_evo_userblock['BLOCK']['POSTS']['POSTS'] = 'Mensajes';
$lang_evo_userblock['BLOCK']['POSTS']['UR_POSTS'] = 'Tus Mensajes';
$lang_evo_userblock['BLOCK']['POSTS']['UR_TOPICS'] = 'Tus Temas';

//Good afternoon
$lang_evo_userblock['BLOCK']['AFTERNOON']['AFTERNOON'] = 'Buenas tardes';
$lang_evo_userblock['BLOCK']['AFTERNOON']['MORNING'] = 'Buenos dias';
$lang_evo_userblock['BLOCK']['AFTERNOON']['EVENING'] = 'Buenas tardes';
$lang_evo_userblock['BLOCK']['AFTERNOON']['NIGHT'] = 'Buenas noches';

//Show IP
$lang_evo_userblock['BLOCK']['SHOW_IP'] = 'Su IP: ';

?>