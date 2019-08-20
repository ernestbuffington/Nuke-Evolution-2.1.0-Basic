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

$lang_new[$module_name]['WHO_ADMIN_HEADER']         = 'Nuke-Evolution Quien-Esta-En Linea';
$lang_new[$module_name]['WHO_RETURNMAIN']           = 'Volver a la Administracion principal';
$lang_new[$module_name]['WHO_Actual_Servertime']    = 'Tiempo real de servidor';
$lang_new[$module_name]['WHO_Servertime']           = 'Tiempo de servidor';
$lang_new[$module_name]['WHO_Statistic_last_updated']= 'Estadistica actualizada por ultima vez en';
$lang_new[$module_name]['WHO_Lastuser']             = 'Ultimo miembro';
$lang_new[$module_name]['WHO_Sumuser']              = 'Total de miembros';
$lang_new[$module_name]['WHO_Username']             = 'Nombre de usuario';
$lang_new[$module_name]['WHO_Sessionstarted']       = 'Iniciada la sesion';
$lang_new[$module_name]['WHO_LastSessionUpdate']    = 'Periodo de sesiones actualizado';
$lang_new[$module_name]['WHO_OnlineTime']           = 'En linea desde';
$lang_new[$module_name]['WHO_UserAction']           = 'Accion del usuario';
$lang_new[$module_name]['WHO_UserIPAdress']         = 'IP-direccion';

?>