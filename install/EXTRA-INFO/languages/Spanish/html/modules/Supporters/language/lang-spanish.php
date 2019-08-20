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

global $supporter_config;
$lang_new[$module_name]['SP_MAXWIDTH'] = 'Ancho M&aacute;ximo de la Imagen';
$lang_new[$module_name]['SP_MAXHEIGHT'] = 'Altura M&aacute;xima de la Imagen';
$lang_new[$module_name]['SP_ACTIVATE'] = 'Activado';
$lang_new[$module_name]['SP_ACTIVESITES'] = 'Sitios activos';
$lang_new[$module_name]['SP_ADDED'] = 'Agregado';
$lang_new[$module_name]['SP_ADDSUPPORTER'] = 'Agregar Afiliados';
$lang_new[$module_name]['SP_ADMIN_HEADER'] = 'Afiliados Nuke-Evolution :: Panel de Administraci&oacute;n de M&oacute;dulos';
$lang_new[$module_name]['SP_RETURNMAIN'] = 'Volver al &iacute;ndice de Administraci&oacute;n';
$lang_new[$module_name]['SP_ADMINMAIN'] = 'Administraci&oacute;n de Afiliados';
$lang_new[$module_name]['SP_ALLREQ'] = 'Todos los campos son necesarios';
$lang_new[$module_name]['SP_APPROVE'] = 'Aprobado';
$lang_new[$module_name]['SP_APPROVESITE'] = 'Sitio Aprobado';
$lang_new[$module_name]['SP_BESUPPORTER'] = 'Conviertase un Afiliado';
$lang_new[$module_name]['SP_CONFBANN'] = 'Problemas en la subida';
$lang_new[$module_name]['SP_CONFIGMAIN'] = 'Configuraci&oacute;n de Afiliados';
$lang_new[$module_name]['SP_DBERROR1'] = 'ERROR: Fall&oacute; al escribir la Base de datos';
$lang_new[$module_name]['SP_DEACTIVATE'] = 'Desactivado';
$lang_new[$module_name]['SP_DELETESITE'] = 'Eliminar Sitio';
$lang_new[$module_name]['SP_DESCRIPTION'] = 'Descripcion';
$lang_new[$module_name]['SP_EDITSITE'] = 'Editar Sitio';
$lang_new[$module_name]['SP_EDITSITE'] = 'Modificar Sitio';
$lang_new[$module_name]['SP_GOTOADMIN'] = 'Administrador de Afiliados';
$lang_new[$module_name]['SP_IMAGE'] = 'Imagen del Sitio';
$lang_new[$module_name]['SP_IMAGE_UPLOAD'] = 'Carga de la imagen de sitio <br /><small>Si ambas posibilidades de Imagen son determinadas, carga sera preferente</small>';
$lang_new[$module_name]['SP_IMAGE_URL'] = 'URL de la imagen del sitio';
$lang_new[$module_name]['SP_IMAGETYPE'] = 'Enalce Tipo de Image';
$lang_new[$module_name]['SP_IMAGETYPE0'] = '&iexcl;Esto es una URL de imagen!!';
$lang_new[$module_name]['SP_IMAGETYPE1'] = 'The image is uploaded from your pc!';
$lang_new[$module_name]['SP_INACTIVESITES'] = 'Sitios inactivos';
$lang_new[$module_name]['SP_LINKED'] = 'Enlazado';
$lang_new[$module_name]['SP_MISSINGDATA'] = '&iexcl;Has omitido informaci&oacute;n en el envio!';
$lang_new[$module_name]['SP_MUSTBE'] = 'Imagenes m&aacute;s grandes que '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' ser&aacute;n redimensionadas a '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' al mostrarse';
$lang_new[$module_name]['SP_NAME'] = 'Nombre del Sitio';
$lang_new[$module_name]['SP_NOACTIVESITES'] = 'No hay sitios activos.';
$lang_new[$module_name]['SP_NOINACTIVESITES'] = 'No hay sitios inactivos.';
$lang_new[$module_name]['SP_NOSUBMITTEDSITES'] = 'No hay sitios enviados.';
$lang_new[$module_name]['SP_NOUPLOAD'] = 'La imagen no ha sido subida apropiadamente.';
$lang_new[$module_name]['SP_REQUIREUSER'] = 'Requiere ser miembro';
$lang_new[$module_name]['SP_SAVECHANGES'] = 'Guardar Cambios';
$lang_new[$module_name]['SP_SITEID'] = 'ID del Sitio';
$lang_new[$module_name]['SP_SUBMITTEDSITES'] = 'Sitios enviados';
$lang_new[$module_name]['SP_SUBMITSITE'] = 'Enviar Sitio';
$lang_new[$module_name]['SP_SUBMITTED'] = 'Enviado';
$lang_new[$module_name]['SP_SUPPORTEDBY'] = 'por';
$lang_new[$module_name]['SP_SUPPORTERS'] = 'Afiliados';
$lang_new[$module_name]['SP_SURE2DELETE'] = '&iquest;Est&aacute;s seguro de querer elimniar este sitio?';
$lang_new[$module_name]['SP_UPLOAD'] = 'Subir';
$lang_new[$module_name]['SP_URL'] = 'URL del Sitio';
$lang_new[$module_name]['SP_USEREMAIL'] = 'Correo Electr&oacute;nico del Usuario';
$lang_new[$module_name]['SP_USERID'] = 'ID del Usuario';
$lang_new[$module_name]['SP_USERIP'] = 'IP del Usuario';
$lang_new[$module_name]['SP_USERNAME'] = 'Nombre del Usuario';
$lang_new[$module_name]['SP_VISITS'] = 'Visitas';
$lang_new[$module_name]['SP_YOUDELETE'] = 'Has eliminado este sitio';
$lang_new[$module_name]['SP_YOUREMAIL'] = 'Tu E-Mail';
$lang_new[$module_name]['SP_YOURIP'] = 'Tu IP';
$lang_new[$module_name]['SP_YOURNAME'] = 'Tu Nombre';
$lang_new[$module_name]['SP_UPLOADERROR'] = 'Archivo no cargado';
$lang_new[$module_name]['SP_FILETYPERROR'] = 'Tipo de archivo incorrecto. Solo imagenes (gif, jpg, jpeg, png, swf) se permiten';
$lang_new[$module_name]['SP_EDITED'] = 'Ultimo cambio';
$lang_new[$module_name]['SP_EDITED_USER'] = 'modificado por';
?>