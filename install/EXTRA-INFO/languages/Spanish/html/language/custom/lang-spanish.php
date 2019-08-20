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

/*****[BEGIN]******************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/
define("_CANNOTCHANGEMODE", "No se puede cambiar el modo del archivo (%s)");
define("_CANNOTOPENFILE", "No se puede abrir el archivo (%s)");
define("_CANNOTWRITETOFILE", "No se puede escribir el archivo (%s)");
define("_CANNOTCLOSEFILE", "No se puede cerrar el archivo (%s)");
define("_SITECACHED", "Este sitio funciona con Cach&eacute;.");
define("_UPDATECACHE", "Haz click aqu&iacute; para actualizar el Cach&eacute;.");
/*****[END]********************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
define("_ERRORINVEMAIL","ERROR: La Direcci&oacute;n de Correo Electr&oacute;nica No es V&aacute;lida");
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/
define("_PERSISTENT","Conectarme autom&aacute;ticamente en cada visita");
/*****[END]********************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/
define("_ADMINGROUPS","Editar Grupos");
define("_MVGROUPS","S&oacute;lo Grupos");
define("_MVSUBUSERS","S&oacute;lo Suscriptores");
define("_WHATGRDESC","Su visualizaci&oacute;n debe ser PUESTA s&oacute;lo para Grupos");
define("_WHATGROUPS","Qu&eacute; Grupos");
define("_GRMEMBERSHIPS","Grupos Miembros");
define("_GRNONE","Ninguno");
/*****[END]********************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/
define("_ADMIN_BLOCK_TITLE","Navegaci&oacute;n R&aacute;pida");
define("_ADMIN_BLOCK_NUKE","Admin [Nuke-Evo]");
define("_ADMIN_BLOCK_FORUMS","Admin [Foro]");
define("_ADMIN_BLOCK_LOGOUT","Salir");
define("_ADMIN_BLOCK_SETTINGS","Preferencias");
define("_ADMIN_BLOCK_BLOCKS","Bloques");
define("_ADMIN_BLOCK_MODULES","M&oacute;dulos");
define("_ADMIN_BLOCK_CNBYA","Configurar usuarios");
define("_ADMIN_BLOCK_MSGS","Mensages");
define("_ADMIN_BLOCK_MODULE_BLOCK","Bloque men&uacute");
define("_ADMIN_BLOCK_NEWS","Noticias");
define("_ADMIN_BLOCK_LOGIN","Admin Coneccion");
define("_ADMIN_BLOCK_WHO_ONLINE","Qui&eacute;n En Linea");
define("_ADMIN_BLOCK_OPTIMIZE_DB","Base de datos");
define("_ADMIN_BLOCK_DOWNLOADS", "Descargas");
define("_ADMIN_BLOCK_EVO_USER", "Bloque UserInfo");
define("_ADMIN_BLOCK_WEBLINKS","Web Links");
define("_ADMIN_BLOCK_REVIEWS","Rese&ntilde;as");
define("_ADMIN_BLOCK_SYSTEMINFO","Info de sistema");
define("_ADMIN_BLOCK_ERRORLOG","Seguridad Log");
define("_CACHE_ADMIN", "Cach&eacute");
define("_CACHE_CLEAR", "Limpiar cach&eacute;");
define("_ADMIN_ID","Admin ID:");
define("_ADMIN_PASS","Contrase&ntilde;aa:");
define("_ADMIN_NO_MODULE_RIGHTS","No tienes permiso para administrar el modulo");
/*****[END]********************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/
define("_URL_SLASH_ERR","Por favor elimina / del final de su ");
define("_URL_HTTP_ERR","Por favor inserta http:// al principio de tu ");
define("_URL_NHTTP_ERR","Por favor elimina http:// del principio de tu ");
define("_URL_PHP_ERR","Por favor elimina el nombre del archivo al final de tu ");
define("_URL_MODULE_FORUM_ERR","Por favor elimina modules/Forums al final de tu ");
/*****[END]********************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/

/*--FNA--*/

/*****[BEGIN]******************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/
define("_STORIES", "Historias");
define("_AWL","Enlaces Web");
define("_ASUP","Aficionados");
define("_AREV","Comentarios");
define("_ADOWN","Descargas");
define("_ABAN", "Banners");
define("_AWU", "Su cuenta");
define("_WAITUSERS", "Espera");
define("_BROKENDOWN","Roto");
define("_BROKENLINKS","Roto");
define("_BROKENREVIEWS","Roto");
define("_MODREQDOWN","Modificaciones");
define("_MODREQLINKS","Modificaciones");
define("_MODREQREVIEWS","Modificaciones");
define("_WDOWNLOADS","Espera");
define("_WLINKS","Espera");
define("_WREVIEWS","Espera");
define("_ABANNERS", "Activo");
define("_DBANNERS", "Inactivo");
define("_WSUPPORT", "Espera");
define("_DSUPPORT", "Inactivo");
define("_ASUPPORT", "Activo");
/*****[END]********************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/
define("_NEED_DELETE","Debe eliminar");
define("_IS_DELETED","Hemos eliminado");
define("_THE_FOLDER","la carpeta");
/*****[END]********************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/
define("_PASS_CONFIRM","Vuelva a escribir la Contrase&ntilde;a");
define("_ERROR","Error");
define("_PASS_NOT_MATCH","Las dos Contrase&ntilde;a no coinciden");
/*****[END]********************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Validation                         v1.0.0 ]
 ******************************************************/
define("VALIDATE_ERROR","El %s que usted ha introducido en %s no es v&aacute;lid ");
define("VALIDATE_USERNAME","Nombre de usuario");
define("VALIDATE_TEXT","texto");
define("VALIDATE_FULLNAME","Nombre completo");
define("VALIDATE_NUMBER","n&uacute;mero");
define("VALIDATE_EMAIL","email");
define("VALIDATE_URL","URL");
define("VALIDATE_INT","N&uacute;mero");
define("VALIDATE_FLOAT","N&uacute;mero");
define("VALIDATE_SHORT","corto");
define("VALIDATE_LONG","largo");
define("VALIDATE_SMALL","peque&ntilde;ao");
define("VALIDATE_BIG","grande");
define("VALIDATE_TEXT_SIZE","El %s que usted ha introducido en %s no es v&aacute;lido<br />deben ser %s caracteres");
define("VALIDATE_NUMBER_SIZE","El %s que usted ha introducido en %s no es v&aacute;lido<br />Debe ser %s");
define("VALIDATE_WORD","Una palabra que usted ha introducido en %s no es v&aacute;lida");
/*****[END]********************************************
 [ Other:  Validation                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
define("PSM_HELP_TITLE","Ayuda para contrase&ntilde;aa segura");
define("PSM_NOTRATED","No Clasificado");
define("PSM_CURRENTSTRENGTH","Seguridad Actual: ");
define("PSM_WEAK","D&eacute;bil");
define("PSM_MED","Medio");
define("PSM_STRONG","Fuerte");
define("PSM_STRONGER","Muy Fuerte");
define("PSM_STRONGEST","Extremadamente Fuerte");
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

/*--FNL--*/

/*--CalendarMx--*/

/*****[BEGIN]******************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/
define("_NOSURVEYS", "&iexcl;No hay encuestas!");
/*****[END]********************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
define("_NORSS", "&iexcl;El archivo RSS que usted intenta cargar no existe!");
/*****[END]********************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
define('_COLLAPSE','Plegables bloques?');
define('_COLLAPSE_TITLE','titulo');
define('_COLLAPSE_ICON','icono');
define('_COLLAPSE_START','Plegables comenzar bloques abiertos?');
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
******************************************************/

define('_QUERIES','Consultas:');
define('_DB_TIME','DB Tiempo de acceso:');
define('_PAGEFOOTER','[ '._PAGEGENERATION.' %s '._SECONDS.' | '._QUERIES.' %s ]');
define("_THEMES_QUNINSTALLED", "Desinstalado");
define("_THEMES", "Temas");
define("_THEMES_DEFAULT", "Tema por defecto");

define('_ERROR_EMAIL', 'Por favor, configure su sitio, ya sea correo electronico o correo electronico de su foro');
define('_Nice_Try', 'Buen intento ....');
define("_OPTIMIZE_DB","Base de Datos Optimizada");

?>