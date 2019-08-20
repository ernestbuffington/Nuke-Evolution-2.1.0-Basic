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

$lang_new[$module_name]['MODULE_NAME'] = str_replace ("_", " ", $module_name);
$lang_new[$module_name]['NJMAP'] = 'Mapa del sitio';
$lang_new[$module_name]['SITEMAPADMIN'] = 'Administraci&oacute;n de Mapa del sitio';
$lang_new[$module_name]['SITEMAP_ADMIN_HEADER'] =  'Nuke-Evolution NukeJMap [Mapa del sitio] :: Panel de administracion de modulos';
$lang_new[$module_name]['SITEMAP_RETURNMAIN'] =  'Volver a la Administracion principal';
$lang_new[$module_name]['XMLCREATE'] = 'Creacion XML:';
$lang_new[$module_name]['YES'] = 'Si:';
$lang_new[$module_name]['NO'] = 'No:';
$lang_new[$module_name]['NDOWN'] = 'Lista de Descargas:';
$lang_new[$module_name]['NNEWS'] = 'Lista de Noticias:';
$lang_new[$module_name]['NREV'] = 'Lista de Rese&ntilde;as:';
$lang_new[$module_name]['NUSER'] = 'Lista de Usuarios:';
$lang_new[$module_name]['NTOPICS'] = 'Lista de recientes del Foro \ Mensaje:';
$lang_new[$module_name]['OK'] = 'Aceptar';

$lang_new[$module_name]['Key'] = 'Llave:';
$lang_new[$module_name]['Key0'] = 'Nota: Todos los modulos aparecen en orden alfabetico.';
$lang_new[$module_name]['Key1'] = 'Modulos activos (usuarios registrados)';
$lang_new[$module_name]['Key2'] = 'Modulos activos (los visitantes)';
$lang_new[$module_name]['Key3'] = 'Foro';
$lang_new[$module_name]['Key4'] = 'Noticias, Foro y otras categorias de contenido';
$lang_new[$module_name]['Key5'] = 'Foro Temas';
$lang_new[$module_name]['Key6'] = 'Pagina de inicio';

$lang_new[$module_name]['ERROR'] = 'Error al guardar los valores de configuracion de Mapa del sitio';
$lang_new[$module_name]['Value_missing'] = 'Valor faltante';
$lang_new[$module_name]['ERR_NDOWN'] = 'No. de Descargas';
$lang_new[$module_name]['ERR_NNEWS'] = 'No. de Noticias';
$lang_new[$module_name]['ERR_NREV'] = 'No. de Comentarios';
$lang_new[$module_name]['ERR_NUSER'] = 'No. de Usuarios';
$lang_new[$module_name]['ERR_NTOPICS'] = 'No. de Mensajes';

?>