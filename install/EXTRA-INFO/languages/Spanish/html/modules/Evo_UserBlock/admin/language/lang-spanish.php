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
$lang_evo_userblock['ADMIN']['EVO_USERINFO'] = 'Bloque UserInfo Evolution';
$lang_evo_userblock['ADMIN']['BREAK'] = 'L&iacute;nea';
$lang_evo_userblock['ADMIN']['SAVE'] = 'Guardar';
$lang_evo_userblock['ADMIN']['SAVED'] = 'Guardado';
$lang_evo_userblock['ADMIN']['HELP'] = 'Ayuda';
$lang_evo_userblock['ADMIN']['MSG_SAVED'] = 'Mensaje Guardado';
$lang_evo_userblock['YES'] = 'Si';
$lang_evo_userblock['NO'] = 'No';

//Errors
$lang_evo_userblock['ACCESS_DENIED'] = 'Accesso Denegado';
$lang_evo_userblock['VALUES_NF'] = 'No se pudo hallar valores para ';

//Admin
$lang_evo_userblock['ADMIN']['ADMIN_HELP'] = 'Selecciona y arrastra los &iacute;tems dentro o fuera del bloque<br />Haz doble click sobre un &iacute;tem para administrarlo si estuviera disponible';
$lang_evo_userblock['ADMIN']['ADMIN_HEADER'] = 'Bloque UserInfo Nuke-Evolution :: Panel de Administraci&oacute;n de M&oacute;dulos';
$lang_evo_userblock['ADMIN']['ADMIN_RETURN'] = 'Volver al &iacute;ndice de la Administraci&oacute;n';
$lang_evo_userblock['ADMIN']['COLLAPSE'] = 'Modulos plegables?';
$lang_evo_userblock['ADMIN']['OUTPUT'] = 'Salir';

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

//Good Afternoon
$lang_evo_userblock['GOOD_AFTERNOON']['GOOD_AFTERNOON'] = 'Buenas Tardes';
$lang_evo_userblock['GOOD_AFTERNOON']['HELP'] = 'Ingrese el mensaje a mostrar.<br /><br />Emplea %name% para mostrar el nombre del usuario';

//Personal Message
$lang_evo_userblock['PERSONAL_MESSAGE']['PERSONAL_MESSAGE'] = 'Mensaje Personal';
$lang_evo_userblock['PERSONAL_MESSAGE']['HELP'] = 'Ingrese un mensaje personal al usuario<br /><br />Usa %name% para mostrar el nombre del usuario<br />Emplee %site% para mostrar el nombre del sitio<br />Se permite HTML';

//Username
$lang_evo_userblock['USERNAME']['USERNAME'] = 'Nombre de Usuario';
$lang_evo_userblock['USERNAME']['CENTER'] = 'Centrar:';

//Online
$lang_evo_userblock['ONLINE']['ONLINE'] = 'Usuarios en L&iacute;nea';
$lang_evo_userblock['ONLINE']['SHOW_MEMBERS'] = 'Mostrar Estad&iacute;sticas en L&iacute;nea:';
$lang_evo_userblock['ONLINE']['SHOW_HV'] = 'Mostrar Estad&iacute;sticas Ocultos/Visibles:';
$lang_evo_userblock['ONLINE']['SCROLL'] = 'Scroll:';
?>