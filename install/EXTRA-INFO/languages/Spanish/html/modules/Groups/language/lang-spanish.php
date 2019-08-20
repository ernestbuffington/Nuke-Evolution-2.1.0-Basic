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

$lang_new[$module_name]['GRATULATIONS'] = 'Felicitaciones';
$lang_new[$module_name]['HELLO'] = 'Estimado';

$lang_new[$module_name]['GROUP_ADDED'] = 'Usted se agrego al grupo '.$group_name.' en '.$board_config['nombre sitio'].'.';
$lang_new[$module_name]['GROUP_ADDED_SUBJECT'] = 'Agregar al grupo '.$group_name.' en '.$board_config['nombre sitio'];
$lang_new[$module_name]['GROUP_ADDED_INFO'] = 'Esta accion fue hecha por el moderador de grupo o el administrador del sitio, pongase en contacto con les para obtener mas informacion.';
$lang_new[$module_name]['GROUP_ADDED_LINK'] = 'Puede ver aqui su informacion de grupos';
$lang_new[$module_name]['GROUP_ADDED_LINK_VISIT'] = 'Haga clic aqui';

$lang_new[$module_name]['GROUP_APPROVED'] = 'Su solicitud para unirse al grupo '.$group_name.' on '.$board_config['nombre sitio'].' ha sido aprobada.';
$lang_new[$module_name]['GROUP_APPROVED_SUBJECT'] = 'Unirse a grupo '.$group_name.' en '.$board_config['nombre sitio'].' fue aceptada.';
$lang_new[$module_name]['GROUP_APPROVED_INFO'] = '';
$lang_new[$module_name]['GROUP_APPROVED_LINK'] = 'Puede ver aqui su informacion de grupos';
$lang_new[$module_name]['GROUP_APPROVED_LINK_VISIT'] = 'Haga clic aqui';

$lang_new[$module_name]['GROUP_REQUEST'] = 'Un usuario ha solicitado a unirse a grupo '.$group_name.' Usted es moderador en '.$board_config['nombre sitio'].'.';
$lang_new[$module_name]['GROUP_REQUEST_SUBJECT'] = 'Peticion del usuario a unirse a grupo '.$group_name.' en '.$board_config['nombre sitio'];
$lang_new[$module_name]['GROUP_REQUEST_INFO'] = '';
$lang_new[$module_name]['GROUP_REQUEST_LINK'] = 'Para aprobar o rechazar esta solicitud de pertenencia a grupos visite el siguiente vinculo';
$lang_new[$module_name]['GROUP_REQUEST_LINK_VISIT'] = 'Haga clic aqui';

?>