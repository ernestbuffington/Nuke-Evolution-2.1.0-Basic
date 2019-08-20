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
 [ Base:    Admin Icon/Link Pos                v1.0.0 ]
 ******************************************************/
define("_ADMINPOS", "Administracion de Posicion");
define("_UP", "Arriba");
define("_DOWN", "Abajo");
define("_ADMIN_POS","Tiene los iconos de administracion/enlaces:");
/*****[END]********************************************
 [ Base:    Admin Icon/Link Pos                v1.0.0 ]
 ******************************************************/

define('_BOTH', 'Ambos');
define('_ERROR_DELETE_CONF','Esta seguro que desea eliminar %s?');
define('_BLOCKTOP','Mover bloque hacia arriba');
define('_BLOCKBOTTOM','  Mover bloque hacia abajo ');
define('_ERROR_NOT_SET','%s no se ha ajustado');

define('_FROM','Desde');
define('_STAFF','Personal');
define('_NL_RECIPS','Destinatarios');
define('_SUBSCRIBEDUSERS','Miembros suscritos');
define('_NL_ALLUSERS','Todos los miembros');
define('_NL_ADMINS','Administradores');
define('_NL_REGARDS','Saludos cordiales');
define('_DISCARD','Desechar');
define('_REVIEWTEXT','Por favor, revisa el mensaje y comprobar la ortografia');
define('_MANYUSERSNOTE','Debido al gran numero de usuarios que van a recibir este boletin, la tarea puede tardar varios minutos para completar<br />Por favor, sea paciente!');
define('_NL_NOUSERS','El grupo seleccionado para recibir este boletin tiene cero usuarios<br />Por favor, vuelva atras y seleccione un grupo diferente');
define('_NUSERWILLRECEIVE','usuarios recibiran este boletin');
global $adminmail;
define('_NLUNSUBSCRIBE',"Le hemos enviado este mensaje porque usted ha seleccionado para recibir boletines de noticias de nuestro sitio\n\nPuede optar por darse de baja de nuestra lista de correo en cualquier momento accediendo a su cuenta\n\nSi desea mas ayuda, por favor enviar un correo a <a href=\"mailto:".$adminmail."\">nuestro administrador</a>");
define('_NEWSLETTERSENT','El boletin ha sido enviado');
define('_ADMIN_NO_MODULE_RIGHTS', 'Usted no tiene derecho a administrar este modulo ');

/*****[BEGIN]******************************************
 [ Mod:    Queries Count                       v2.0.1 ]
 ******************************************************/
define("_QUERIESCOUNT", "Conde Consultas?");
/*****[END]********************************************
 [ Mod:    Queries Count                       v2.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:  Extended Surveys Admin Interface      v1.0.0 ]
 ******************************************************/
define("_POLLADMIN", "Administracion de encuestas");
define("_POLLMAIN", "Indice de administracion de encuestas");
define("_SURVEYSADMIN", "Encuestas");
define("_POLLCHOOSE", "Bienvenido a la administracion de encuestas<br />Que desea hacer?");
define("_ADDPOLL", "Agregar Encuesta");
define("_CHANGEPOLL", "Editar Encuesta");
define("_DELETEPOLL", "Eliminar Encuesta");
define("_POLL_OPTIONS", "Opciones adicionales");
define("_POLL_INFO", "Puede cambiar algunas opciones para el bloque de Encuestas");
define("_POLLDAYS", "Numero de dias transcurridos entre la votacion");
define("_POLLRANDOM", "Mostrar una encuesta aleatorio");
define("_POLLGUESTS", "Los invitados pueden votar");
/*****[END]********************************************
 [ Mod:  Extended Surveys Admin Interface      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Admin Tracker                      v1.0.1 ]
 ******************************************************/
define("_ADMIN_LOG","Rastreador de seguridad");
define("_ADMIN_LOG_EXPLAIN1","El rastreador de seguridad registra los siguientes");
define("_ADMIN_LOG_EXPLAIN2","<ul><li>Creacion de la cuenta de administrador</li><li>Error de acceso de administrador</li><li>Alerta de intruso</li><li>MySQL Errores</li></ul>");
define("_ADMIN_LOG_CHG","<strong>Su registro de rastreador de administracion <strong>HAS</strong> cambiado</strong>");
define("_ADMIN_LOG_FINE","No ha cambiado su registro de rastreador de administracion");
define("_ADMIN_LOG_CHECKED","La version ultima fue comprobada el");
define("_ADMIN_LOG_VIEW","Ver registro");
define("_ADMIN_LOG_ACK","Reconocer");

define("_ERROR_LOG_CHG","<strong>Su registro de errores <strong>HAS</strong> cambiado</strong>");
define("_ERROR_LOG_FINE","Su registro de errores no ha cambiado");
define("_ERROR_LOG_ERR","<strong>Hubo un problema al comprobar su registro.</strong>");
define("_ERROR_LOG_ERRCHMOD","<strong>El archivo no es de escritura. Usted hizo la CHMOD?</strong>");
define("_ERROR_LOG_ERRFND","El registro no se pudo encontrar");
define("_ERROR_ERR_OPEN","No se ha podido abrir error.log");

define("_ADMIN_LOG_ERR","<strong>Hubo un problema al comprobar su registro.</strong>");
define("_ADMIN_LOG_ERRCHMOD","<strong>Su archivo No se puede escribir. Usted hizo la CHMOD?</strong>");
define("_ADMIN_LOG_ERRFND","No se encontro el registro");

define("_TRACKER_HEAD_DATE","Fecha");
define("_TRACKER_HEAD_TIME","Tiempo");
define("_TRACKER_HEAD_IP","IP");
define("_TRACKER_HEAD_MSG","Mensaje");

define("_TRACKER_UP","ACTUALIZADO");
define("_TRACKER_BACK","Atras");
define("_TRACKER_CLEAR", "Limpiar registro");

define("_TRACKER_ERR_OPEN","No se pudo abrir admin.log");
define("_TRACKER_ERR_UP","Error al actualizar");

define("_TRACKER_CLEARED", "Se ha borrado el rastreador de seguridad!");
/*****[END]********************************************
 [ Mod:     Admin Tracker                      v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Evolution Version Checker          v1.0.0 ]
 ******************************************************/
define("_ADMIN_VER_TITLE","Nuke-Evolution Comprobador de version");
define("_ADMIN_VER_ERRCON","No se puede conectar a www.nuke-evolution.com");
define("_ADMIN_VER_ERRSQL","No se pudo recuperar version de base de datos");
define("_ADMIN_VER_CHG","Hay una version nueva de Nuke-Evolution");
define("_ADMIN_VER_VIEW","Ver nueva version");
define("_ADMIN_VER_CUR","Su version es actual");
define("_CHECKVER", "Haga clic aqui para comprobar la version");
define("_VER_ERR_CON","No se puede conectar a <a href='http://www.nuke-evolution.com'>Nuke-Evolution</a>");
define("_VER_ERR_CHG","Hubo un problema de acceso con el cambio de registro");
define("_VER_TITLE","Nuke-Evolution Version");
define("_VER_VER","La version actual es el registro:");
define("_VER_YOURVER","Su version es:");
define("_VER_CHGLOG","Nuke-Evolution Registro cambiado de version");
define('_VERSIONUP2DATE', 'La instalacion es al dia, no hay actualizaciones estan disponibles para su version de Nuke-Evolution.');
define('_VERSIONOUTOFDATE', 'La instalacion <strong>no</strong> parece que hasta la fecha. Las actualizaciones estan disponibles para su version de Nuke-Evolution, por favor visite <a href="http://www.nuke-evolution.com/modules.php?name=Downloads" target="_blank">http://www.nuke-evolution.com/modules.php?name=Downloads</a> para obtener la ultima version.');
define('_VERSIONLATESTINFO', 'La ultima version disponible es <strong>Nuke-Evolution %s</strong>.');
define('_VERSIONCURRENTINFO', 'Se esta ejecutando <strong>Nuke-Evolution %s</strong>.');
define('_VERSIONSOCKETERROR', 'No se puede abrir la conexion a Nuke-Evolution Servidor, se informo de un error:<br />%s');
define('_VERSIONFUNCTIONSDISABLED', 'No se puede utilizar funciones de sockets.');
/*****[END]********************************************
 [ Mod:     Evolution Version Checker          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Who is Online                      v1.0.0 ]
 ******************************************************/
define("_who","Quien esta en linea");
/*****[END]********************************************
 [ Mod:     Who is Online                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Headlines                          v1.0.0 ]
 ******************************************************/
define("_headlines","En portada");
/*****[END]********************************************
 [ Mod:     Headlines                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   SSL Administration                 v1.0.0 ]
 ******************************************************/
define("_SSLADMIN","Activar el modo SSL para el administrador?");
define("_SSLWARNING","Usted debe tener instalado SSL en el servidor");
/*****[END]********************************************
 [ Other:   SSL Administration                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/
define("_URL_SERVER_ERROR","La URL que ha introducido (%s) no coincide con la URL que el servidor esta la presentacion de informes (%s)");
define("_URL_CONFIRM_ERROR","Desea mantener esta configuracion?");
/*****[END]********************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Lock Modules                       v1.0.0 ]
 ******************************************************/
define("_LOCK_MODULES_TITLE","Fuerza inicio de sesion a usuarios");
define("_LOCK_MODULES","Fuerza acceso a los usuarios antes de que puedan hacer nada:");
/*****[END]********************************************
 [ Mod:     Lock Modules                       v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Censor                             v1.0.0 ]
 ******************************************************/
define("_CENSOR","Censor");
define("_CENSOR_WORDS","Palabras para censurar");
define("_CENSOR_OFF","Apagado");
define("_CENSOR_WHOLE","Palabras completas");
define("_CENSOR_PARTIAL","Palabras parciales");
define("_CENSOR_SETTINGS","Configuracion de censor?");
/*****[END]********************************************
 [ Base:    Censor                             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Cache                              v1.0.2 ]
 ******************************************************/
define("_CACHE_ENABLED","Activado");
define("_CACHE_DISABLED", "Disactivado");
define("_CACHE_HOWTOENABLE", "Como habilitar?");
define("_CACHE_CLEARNOW", "Limpiar ahora");
define("_CACHE_NO", "No");
define("_CACHE_YES", "Si");
define("_CACHE_GOOD", "Buena");
define("_CACHE_BAD", "La cache no es chmodded!");
define("_CACHE_HEADER", "Nuke-Evolution Cache :: Panel de administracion");
define("_CACHE_STATUS", "Estado de cache:");
define("_CACHE_DIR_STATUS", "Estado del directorio de cache:");
define("_CACHE_NUM_FILES", "Numero de elementos en cache:");
define("_CACHE_LAST_CLEARED", "Cache ultima desactivada:");
define("_CACHE_SIZE", "Tama&ntilde;o de cache:");
define("_CACHE_USER_CAN_CLEAR", "Usuario puede borrar la cache:");
define("_CACHE_CLEAR", "Limpiar Cache");
define("_CACHE_RETURN", "Volver a la Administracion principal");
define("_CACHE_FILENAME", "Nombre de archivo");
define("_CACHE_FILESIZE", "Tama&ntilde;o del archivo");
define("_CACHE_LASTMOD", "ultima modificacion");
define("_CACHE_OPTIONS", "Opciones");
define("_CACHE_DELETE", "Eliminar");
define("_CACHE_VIEW", "Ver");
define("_CACHE_RETURNCACHE", "Volver a la administracion de cache");
define("_CACHE_INVALID", "Operacion no valida");
define("_CACHE_FILE_DELETE_SUCC", "Archivo eliminado");
define("_CACHE_FILE_DELETE_FAIL", "Eliminacion de archivos no se pudo");
define("_CACHE_CAT_DELETE_SUCC", "Categoria eliminada");
define("_CACHE_CAT_DELETE_FAIL", "Error de eliminacion de categoria");
define("_CACHE_CLEARED_SUCC", "Cache borrado correctamente");
define("_CACHE_CLEARED_FAIL", "No se pudo borrar cache");
define("_CACHE_PREF_UPDATED_SUCC", "Preferencias actualizadas correctamente");
define("_CACHE_ENABLE_HOW", "Para habilitar la cache, establezca \$use_cache to \"1\" or \"2\" in config.php Si ya no es.");
define("_CACHESAFEMODE", "Modo seguro esta habilitado en el servidor, no funcionara cache!");
define("_CACHENOTALLOWED", "No esta autorizado para ver este archivo!");
define("_CACHE_MODE", "Modo de cache");
define("_CACHE_FILEMODE", "Cache de archivo");
define("_CACHE_SQLMODE", "SQL Cache");
/*****[END]********************************************
 [ Base:    Cache                              v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  Security Status                     v1.0.0 ]
 ******************************************************/
define("_SEC_STATUS", "Estado de seguridad");
define("_INPUT_FILTER", "Filtro de entrada");
define("_SEC_OFF", "Disabilitado");
define("_SEC_ON", "Habilitado");
define("_ADMIN_IP_LOCK", "Bloqueo de IP de administracion");
/*****[END]********************************************
 [ Other:  Security Status                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  Meta Tags                           v1.0.0 ]
 ******************************************************/
define('_METACONFIG', 'Metaetiquetas Administracion');
define('_META_TAGS', 'Metaetiquetas');
/*****[END]********************************************
 [ Other:  Meta Tags                           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Color Toggle                        v1.0.0 ]
 ******************************************************/
define("_COLORTOGGLE", "Nombre de Usuario y activar Grupo Colores");
/*****[END]********************************************
 [ Mod:    Color Toggle                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
define("_THEMES_HEADER", "Nuke-Evolution :: Administracion de tema");
define("_THEMES_DEFAULT", "Tema por defecto");
define("_THEMES_DEFAULT_NOT_FOUND", " No se ha encontrado!");
define("_THEMES_DEFAULT_MISSING", "Falta el Tema por defecto! ");
define("_THEMES_ERROR", "Error");
define("_THEMES_ERROR_CRITICAL", "Error critico");
define("_THEMES_ERROR_MESSAGE", "No se ha podido reunir instalado temas");
define("_THEMES_PROBLEM", "Parece que hay un problema con su tema, por favor, asegurese de que tiene un tema valido");
define("_THEMES_NUMTHEMES", "Numero de Temas");
define("_THEMES_NUMUNINSTALLED", "Numero de Temas ha desinstalar");
define("_THEMES_MOSTPOPULAR", "Tema mas populares");
define("_THEMES_OPTIONS", "Tema Opciones");
define("_THEMES_RETURNMAIN", "Volver a la Administracion principal");
define("_THEMES_MAKEDEFAULT", "Hacer Por defecto");
define("_THEMES_DEACTIVATE", "Desactivar");
define("_THEMES_ACTIVATE", "Activar");
define("_THEMES_UNINSTALL", "Desinstalar");
define("_THEMES_EDIT", "Editar");
define("_THEMES_VIEW", "Ver");
define("_THEMES_NONE", "Ninguno");
define("_THEMES_NAME", "Nombre del tema");
define("_THEMES_CUSTOMN", "Nombre personalizado");
define("_THEMES_NUMUSERS", "# de Usuarios");
define("_THEMES_PREVIEW", "Vista previa");
define("_THEMES_STATUS", "Estado");
define("_THEMES_GROUPS", "Grupos");
define("_THEMES_OPTS", "Opciones");
define("_THEMES_INSTALLED", "Temas instalados");
define("_THEMES_ALLUSERS", "Todos los usuarios");
define("_THEMES_GROUPSONLY", "Solo grupos");
define("_THEMES_ADMINS", "Administradores");
define("_THEMES_UNINSTALLED", "Temas desinstalados");
define("_THEMES_QINSTALL", "Instalacion rapida");
define("_THEMES_INSTALL", "Instalar");
define("_THEMES_CUSTOMNAME", "Nombre de tema personalizado");
define("_THEMES_ACTIVE", "Activo");
define("_THEMES_INACTIVE", "Inactivo");
define("_THEMES_RETURN", "Regrese al Administrador de tema");
define("_THEMES_UPDATED", "Tema actualizado!");
define("_THEMES_UPDATEFAILED", "Error al actualizar el tema!");
define("_THEMES_THEME_INSTALLED", "Tema instalado!");
define("_THEMES_THEME_INSTALLED_FAILED", "Error al instalar el tema!");
define("_THEMES_THEME_UNINSTALLED", "Tema desinstalado con exito");
define("_THEMES_THEME_UNINSTALLED_FAILED", "Error de desinstalacion de tema!");
define("_THEMES_UNINSTALL1", "Confirma que desea desinstalar este tema?");
define("_THEMES_UNINSTALL2", "Se perderan todos la configuracion de este tema!");
define("_THEMES_UNINSTALL3", "Esta accion establecera todos los usuarios con este tema como tema predeterminado!");
define("_THEMES_THEME_UNINSTALL", "Desinstalar el tema");
define("_THEMES_QUNINSTALLED", "Desinstalar");
define("_THEMES_THEME_MISSING", "Falta de tema!");
define("_THEMES_THEME_DEACTIVATED", "Tema desactivado con exito!");
define("_THEMES_THEME_DEACTIVATED_FAILED", "Error de desactivacion de tema!");
define("_THEMES_DEACTIVATE1", "Confirma que desea desactivar este tema?");
define("_THEMES_DEACTIVATE2", "Esta accion establecera todos los usuarios con este tema como tema predeterminado!");
define("_THEMES_THEME_DEACTIVATE", "Desactivar el tema");
define("_THEMES_TRANSFER", "Transferir tema a usuarios");
define("_THEMES_MANG_OPTIONS", "Opciones de administracion de tema");
define("_THEMES_ALLOWCHANGE", "Permitir la seleccion del tema al usuario");
define("_THEMES_SUBMIT", "Enviar");
define("_THEMES_SETTINGS_UPDATED", "Configuracion de actualizacion!");
define("_THEMES_THEME_TRANSFER", "Transferencia de tema");
define("_THEMES_RETURN_OPTIONS", "Volver a opciones de tema");
define("_THEMES_VIEW_STATS", "Ver Estadisticas");
define("_THEMES_FROM", "De tema");
define("_THEMES_TO", "A Tema");
define("_THEMES_TRANSFER_UPDATED", "usuario(s) se actualizaron!");
define("_THEMES_THEMES", "Temas");
define("_THEMES_ADV_OPTS", "Opciones avanzadas de tema");
define("_THEMES_ADV_COMP", "Su tema es compatible con caracteristicas avanzadas");
define("_THEMES_DEF_LOADED", "Opciones predeterminadas se cargan a continuacion.");
define("_THEMES_REST_DEF", "Restaurar predeterminado");
define("_THEMES_NOT_COMPAT", "<font color='red'>Tu tema no es compatible con caracteristicas avanzadas</font>");
define("_THEMES_PERMISSIONS", "Permisos");

define('_TEXT_AREA', 'Area de Texto');
define('_THEMES_USER_OPTIONS', 'Opciones de usuario');
define('_THEMES_USERID', 'Usuario ID');
define('_THEMES_USERNAME', 'Nombre usuario');
define('_THEMES_REALNAME', 'Nombre real');
define('_THEMES_USEREMAIL', 'EMail');
define('_THEMES_USERTHEME', 'Tema');
define('_THEMES_FUNCTIONS', 'Funciones');
define('_THEMES_USER_RESET', 'Restablecer predeterminado');
define('_THEMES_USER_MODIFY', 'Modificar tema');
define('_THEMES_SUBMIT', 'Enviar');
define('_NOREALNAME', 'N/A');
define('_THEMES_PAGE_FIRST', 'Primero');
define('_THEMES_PAGE_PREVIOUS', 'Anterior');
define('_THEMES_PAGE_NEXT', 'Siguiente');
define('_THEMES_PAGE_LAST', 'Ultima');
define('_THEMES_PAGE_OF', 'a');
define('_THEMES_PAGE_OF_TOTAL', 'de');
define('_THEMES_USER_SELECT', 'Seleccione el tema de usuario');
define('_THEMES_CHANGEATO', 'Cambiar valores ATO');
define('_THEMES_MULTLANG_COMP', 'Su tema es multilingue');
define('_THEMES_NOT_MULTLANG_COMP', 'Tu tema no es multilingue');
define('_THEMES_ATO_KEY', 'ATO Clave');
define('_THEMES_DEFAULT_VALUE', 'Tema Predeterminado');
define('_THEMES_DB_VALUE', 'Valor activo');
define('_THEMES_INFO_CHANGEATO', '<em>Despues de la instalacion no correctamente, es una buena idea para cambiar los valores de ATO en modo editar</em>');

/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Advanced Security Code Control      v1.0.0 ]
 ******************************************************/
define("_USEGFXCHECK", "Usar C&oacute;digo de Seguridad");
define("_GFXOPT", "Opciones del C&oacute;digo de Seguridad");
define("_GFX_NC","Sin chequeo");
define("_GFX_AC","Para conexi&oacute;n de Administradores");
define("_GFX_LC","Para conexi&oacute;n de Usuarios");
define("_GFX_RC","Para registro de Nuevos Usuarios");
define("_GFX_CA","Para conexi&oacute;n y nuevo registro de Usuarios");
define("_GFX_AUC","Para conexi&oacute;n de Administradores y Usuarios");
define("_GFX_ANC","Para conexi&oacute;n de Administradores y registro de Nuevos Usuarios");
define("_GFX_ALLC","Siempre (Administradores y Usuarios)");
define("_GFX_CODESIZE","Tama&ntilde;o de la Letra");
define("_GFX_CODEFONT","Tipo de Letra");
define("_FONTUPLOAD","Puedes agregar nuevas letras (ttf) subi&eacute;ndolas a");
define("_GFX_USEIMAGE","&iquest;Usar imagen de fondo?");
define("_GFX_DEFAULTFONT","Letra por defecto");
/*****[END]********************************************
 [ Mod:    Advanced Security Code Control      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:    Database Manager                  v2.0.0 ]
 ******************************************************/
define("_DATABASE_ADMIN_HEADER", "Copia de Seguridad Nuke-Evolution :: Panel de Administraci&oacute;n");
define("_DATABASE_RETURNMAIN", "Volver al &iacute;ndice de la Administraci&oacute;n");
define("_DATABASE", "Base de Datos");
define("_ACTIONRESULTS", "Aqu&iacute; est&aacute;n los resultados de tu");
define("_IMPORTSUCCESS","&iexcl;La importaci&oacute;n de <em>%s</em> fu&eacute; correcta");
define("_CHECKALL","Marcar Todas");
define("_UNCHECKALL","Desmarcar Todas");
define("_SAVEDATABASE","Copia de seguridad de BD");
define("_ANALYZEDATABASE","Analizar");
define("_CHECKDATABASE","Marcar");
define("_OPTIMIZEDATABASE","Optimizar");
define("_REPAIRDATABASE","Reparar");
define("_STATUSDATABASE","Estado");
define("_BACKUPTASKS","Tarea de Copia de Seguridad");
define("_SAVEDATA","Guardar Informaci&oacute;n");
define("_INCLUDESTATEMENT","Incluir %s declaraci&oacute;n");
define("_GZIPCOMPRESS","Usar compresi&oacute;n GZIP");
define("_OPTIMIZETEXT",'<strong>OPTIMIZAR</strong></div><br /><div align="justify">Deber&iacute;a ser usado si has eliminado una gran parte de una tabla o si has hecho muchos cambios a una tabla con variables de longitud de filas (tablas que tienen columnas VARCHAR, BLOB, o TEXT). Los registros eliminados son mantenidos en una lista enlazada y consecuentemente las operaciones INSERT reh&uacute;san posiciones de registro antiguas. Puedes usar OPTIMIZAR para reclamar el espacio sin usar y defragmentar el archivo de datos.<br />
No es necesar&iacute;o optimizar todo siempre. Aunque realices muchos cambios, no ser&aacute; necesario que hagas esto m&aacute;s de una vez al mes/semana y tan solo en unas tablas.</div><br />
OPTIMIZAR funciona de la siguiente manera:<ul>
<li>Si la tabla ha eliminado o dividido filas, repara la tabla.</li>
<li>Si las p&aacute;ginas de &iacute;ndice no est&aacute;n ordenadas, las ordena.</li>
<li>Si las estad&iacute;sticas no est&aacute;n al d&iacute;a (Y la reparaci&oacute;n no pudo ser hecha al ordenar el &iacute;ndice), las actualiza.</li>
</ul><strong>Nota:</strong> &iexcl;&iexcl;La tabla est&aacute; cerrada durante el tiempo en que la OPTIMIZACI&oacute;N est&aacute; trabajando!');
define("_IMPORTFILE","Importar archivo SQL");
define("_IMPORTSQL", "Importar");
define("_DBACTION", "Acci&oacute;n");
/*****[END]********************************************
 [ Other:    Database Manager                  v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:    System Info                       v1.0.0 ]
 ******************************************************/
define("_PHP_MODULES", "M&oacute;dulos PHP");
define("_PHP_CORE", "Base PHP");
define("_PHP_ENVIRO", "Ambiente PHP");
define("_PHP_VARS", "Variables PHP");
define("_SQL_SRV", "Servidor SQL");
define("_INFO_GENERAL", "General");
define('_INFO_ADMIN_HEADER', 'Informaci&oacute;n del Sistema de Nuke-Evolution :: Panel de Administraci&oacute;n');
define('_INFO_RETURNMAIN', 'Volver al &iacute;ndice de la Administraci&oacute;n');
/*****[END]********************************************
 [ Other:    System Info                       v1.0.0 ]
 ******************************************************/

/*--FNL--*/

/*****[BEGIN]******************************************
 [ Mod:     Lazy Google Tap                    v1.0.0 ]
 ******************************************************/
define('_LAZY_TAP','Lazy Google Tap');
define('_LAZY_TAP_OFF','Deshabilitado');
define('_LAZY_TAP_BOT','S&oacute;lo motores de b&uacute;squeda');
define('_LAZY_TAP_ADMIN','Administradores & Motores de B&uacute;squeda');
define('_LAZY_TAP_EVERYONE','Todos');
define('_LAZY_TAP_NF','Debe tener un archivo .htaccess para emplear el Lazy Google Tap <br />Por favor, revise el archivo de ayuda del Lazy Google Tap');
define('_LAZY_TAP_ERROR_OPEN','No se pudo abir el archivo .htaccess ');
define('_LAZY_TAP_ERROR','Su archivo .htaccess no est&aacute; instalado correctamente. <br />Por favor revise el archivo de ayuda del Lazy Google Tap');
/*****[END]********************************************
 [ Mod:     Lazy Google Tap                    v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Evolution UserInfo Block           v1.0.0 ]
 ******************************************************/
define('_EVO_USERINFO','Bloque Informacion Usuario');
/*****[END]********************************************
 [ Mod:     Evolution UserInfo Block           v1.0.0 ]
 ******************************************************/

 /*****[BEGIN]******************************************
 [ Mod:     Link Us                             v1.0.0 ]
 ******************************************************/
define('_LINK_US','Enlace con Nosotros');
/*****[END]********************************************
 [ Mod:     Link Us                             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Image Resize Mod                   v2.4.5 ]
 ******************************************************/
define('_IMG_RESIZE','Redimensionar Imagen');
define('_IMG_WIDTH','Ancho M&aacute;x de la Imagen');
define('_IMG_HEIGHT','Altura M&aacute;x de la Imagen');
/*****[END]********************************************
 [ Mod:     Image Resize Mod                   v2.4.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Blocks                             v.1.0.0]
 ******************************************************/
define('_BLOCK_ADMIN_HEADER', 'Bloques Nuke-Evolution :: Panel de Administraci&oacute;n');
define('_BLOCK_RETURNMAIN', 'Volver al &iacute;ndice de la Adminsitraci&oacute;n');
define('_BLOCK_ADMIN_NOTE', '&iexcl;Por favor, tenga en cuenta que cuando usted active o desactive un bloque aqu&iacute;<br />ser&aacute; instant&aacute;neo para los visitantes pero no para usted, hasta que recargue la pantalla!');
define('_BLOCK_INACTIVE','El bloque no est&aacute; activo<br />(Doble click para activar/desactivar)');
define('_BLOCK_LINK_DELETE','Eliminar un bloque');
define('_BLOCK_TITLE','T&iacute;TULO');
define('_BLOCK_EDIT','Editar Bloque');
define('_BLOCKS_CACHE_TIME', 'Minutos o horas antes de que se actualizaran los contenidos de bloque (cache)');
define('_BLOCKS_CACHE_TIME_NO', 'Cache de bloque desactivado');
define('_BLOCKS_CACHE_TIME_MINUTES', 'Minutos');
define('_BLOCKS_CACHE_TIME_HOURS', 'Horas');
/*****[END]********************************************
 [ Base:    Blocks                             v.1.0.0]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Modules                            v.1.0.0]
 ******************************************************/
define('_MOD_CAT_TITLE','T&iacute;tulo de la Categor&iacute;a');
define('_MOD_CAT_IMG','Nombre de la Imagen de la Categor&iacute;a');
define('_MOD_CAT_COLLAPSE','Collapse this Category? ');
define('_MOD_CAT_IMG_NOTE','<strong>NOTA:</strong> Las Im&aacute;genes de las Categor&iacute;as deben ser colocadas en la <em>images/blocks/modules/</em> carpeta.');
define('_MOD_CAT_LINK_TITLE','T&iacute;tulo del Enlace');
define('_MOD_CAT_EDIT','Editar categor&iacute;a');
define('_MOD_INACTIVE','El M&oacute;dulo no est&aacute; activo<br />(Doble click para activar/desactivar)');
define('_MOD_LINK','Es un enlace');
define('_MOD_LINK_DELETE','Eliminar un enlace');
define('_MOD_CAT_DELETE','Eliminar una categor&iacute;a');
define('_MOD_CAT_ORDER','Cambiar el orden de la categor&iacute;a');
define('_MOD_TITLE','T&iacute;TULO');
define('_MOD_COLLAPSE','&iquest;Categor&iacute;as colapsables?');
define('_MOD_EXPLAIN','&iexcl;Por favor, tenga en cuenta que cuando usted active o desactive un m&oacute;dulo<br />ser&aacute; instant&aacute;neo para los visitantes pero no para usted, hasta que recargue la pantalla!');
define('_MOD_EXPLAIN2','Tambi&eacute;n <strong>DEBE</strong> presionar el bot&oacute;n "Enviar" para que los cambios en el orden de la categor&iacute;a sean guardados.<br />&iexcl;Los cambios no se guardan autom&aacute;ticamente!');
define('_MOD_NF_VALUES','No se han podido obtener los valores');
define('_MOD_ERROR_TITLE','Usted debe proporcionar un T&iacute;tulo y un Enlace');
define('_MOD_ERROR_TITLE_EXIST','Su titulo existe en la base de datos<br />Por favor, intentelo de nuevo<br /><br />'._GOBACK);
define('_MOD_ERROR_GROUPS','Usted debe selecionar al menos un grupo<br /><br />'._GOBACK);
define('_MOD_ERROR_CAT_NF','La Categor&iacute;a no existe');
/*****[BEGIN]******************************************
 [ Base:    Modules                            v.1.0.0]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Doc Modul Administration           v1.0.0 ]
 ******************************************************/
define("_LEGAL_OPT", "Documentos Legales");
define("_LEGALDOC", "Documentos Legales");
define("_LEGAL_ABOUTUS", "Mostrar la pagina de enlace Acerca de nosotros?");
define("_LEGAL_DISCLAIMER", "Mostrar la Declaracion de Responsabilidad enlace?");
define("_LEGAL_PRIVACY", "Mostrar la Declaracion de privacidad enlace?");
define("_LEGAL_TERMS", "Mostrar las Condiciones del servicio enlace?");
define("_LEGAL_QUESTIONS", "Utilice el Modulo de contacto Comentarios o Modulo para las cuestiones que guarden relacion");
define("_LEGAL_NONE", "Ninguno");
define("_LEGAL_CONTACT", "Modulo de contacto");
define("_LEGAL_FEEDBACK", "Modulo Comentarios");
/*****[END]********************************************
 [ Mod:     Doc Modul Administration           v1.0.0 ]
 ******************************************************/

define('_SMADM','Mapa del Sitio');
define('_SP_SUPPORTERS','Afiliados');
define('_ANALYTICS','Google Analytics');

?>