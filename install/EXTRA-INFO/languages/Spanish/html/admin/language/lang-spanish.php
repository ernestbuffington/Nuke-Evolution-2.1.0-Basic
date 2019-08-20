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

global $admin_file, $sitename, $nukeurl;

define("_DOWNLOAD","Descargas");
define("_ENCYCLOPEDIA","Enciclopedia");
define("_FAQ","F.A.Q.");
define("_NEWS","Noticias");
define("_REVIEWS","Rese&ntilde;as");
define("_ADMPOLLS","Sondeos / Encuestas");
define("_TOPICS","Temas de las Noticias");
define("_WEBLINKS","Enlaces");
define("_LINK_US","Enlace con nosotros");
define("_FORUMS","Foros");
define("_SEND","Enviar");
define("_URL","URL");
define("_EMAIL","Email");
define("_FUNCTIONS","Funciones");
//define("_YES","Yes");
//define("_NO","No");
define("_REQUIRED","(Obligatorio)");
define("_SAVECHANGES","Guardar cambios");
define("_OK","Ok!");
define("_SAVE","Guardar");
define("_ID","ID");
define("_SUBJECT","T&iacute;tulo");
define("_WHOSONLINE","&iquest;Qui&eacute;n est&aacute; conectado?");
define("_ARTICLES","Art&iacute;culos");
define("_ALL","Todo");
define("_PREVIEW","Vista Previa");
define("_EXTRAINFO","Informaci&oacute;n Adicional");
define("_YOUARELOGGEDOUT","&iexcl;Ya est&aacute;s desconectado!");
define("_HOMECONFIG","Configuraci&oacute;n de la P&aacute;gina de Inicio");
define("_DESCRIPTION","Descripci&oacute;n");
define("_HOMEPAGE","P&aacute;gina de Inicio");
define("_NAME","Nombre");
define("_FROM","De");
define("_TO","Para");
define("_SUBMIT","Enviar");
define("_SHOW","Ver");
define("_DAYS","d&iacute;as");
define("_STAFF","Personal");
define("_ADMINID","Admin ID");
define("_ADMINLOGIN","Sistema de Conexi&oacute;n de Administraci&oacute;n");
define("_EDITADMINS","Editar Administradores");
define("_PREFERENCES","Preferencias");
define("_ADMINMENU","Men&uacute; de Administraci&oacute;n");
define("_BANNERSADMIN","Administraci&oacute;n de Banners");
define("_ADMINLOGOUT","Desconectar / Salir");
define("_LAST","&uacute;ltimo");
define("_GO","Ir!");
define("_CURRENTPOLL","Encuesta Actual");
define("_STORYID","ID de Noticia");
define("_BANNERS_ADMIN_HEADER", "Banners de Nuke-Evolution :: Panel de Administraci&oacute;n de M&oacute;dulos");
define("_BANNERS_RETURNMAIN", "Volver al &iacute;ndice de la Administraci&oacute;n");
define("_ACTIVEBANNERS","Banners Activos");
define("_ACTIVEBANNERS2","Banner Activo");
define("_IMPRESSIONS","Impresiones");
define("_IMPLEFT","Imp. restantes");
define("_CLICKS","Clicks");
define("_CLICKSPERCENT","% Clicks");
define("_CLIENTNAME","Nombre del Cliente");
define("_ADVERTISINGCLIENTS","Clientes");
define("_CONTACTNAME","Nombre del Contacto");
define("_CONTACTEMAIL","Email del Contacto");
define("_ADDNEWBANNER","Agregar nuevo Banner");
define("_PURCHASEDIMPRESSIONS","Impresiones Compradas");
//define("_IMAGEURL","Image URL");
//define("_CLICKURL","Click URL");
define("_ADDBANNER","Agregar Banner");
define("_ADDCLIENT","Agregar nuevo Cliente");
define("_CLIENTLOGIN","Login del Cliente");
define("_CLIENTPASSWD","Password del Cliente");
define("_ADDCLIENT2","Agregar Cliente");
define("_DELETEBANNER","Borrar Banner");
define("_SURETODELBANNER","&iquest;Est&aacute;s seguro de querer borrar este Banner?");
define("_EDITBANNER","Editar Banner");
define("_ADDIMPRESSIONS","Agregar impresiones");
define("_PURCHASED","Comprado");
define("_MADE","Realizadas");
define("_DELETECLIENT","Borrar Cliente");
define("_SURETODELCLIENT","&iquest;Est&aacute;s seguro de querer borrar este Cliente y todos sus Banners?");
define("_CLIENTWITHOUTBANNERS","Este Cliente no tiene ning&uacute;n Banner activo.");
define("_DELCLIENTHASBANNERS","Este Cliente tiene los siguientes Banners activos");
define("_EDITCLIENT","Editar Cliente");
define("_REMOVECOMMENTS","Borrar Comentarios");
define("_SURETODELCOMMENTS","&iquest;Est&aacute;s seguro de querer borrar este comentario y todas sus respuestas?");
define("_BLOCKSADMIN","Administraci&oacute;n de Bloques");
define("_BLOCKS","Bloques");
define("_BLOCKSSHOW","Bloques Visibles");
define("_TITLE","Titulo");
define("_POSITION","Posici&oacute;n");
define("_WEIGHT","Orden");
define("_STATUS","Estado");
define("_LEFTBLOCK","<strong>Bloque Izquierdo</strong>");
define("_LEFT","Izquierda");
define("_RIGHTBLOCK","<strong>Bloque Derecho</strong>");
define("_RIGHT","Derecho");
define("_ACTIVE","Activo");
define("_DEACTIVATE","Desactivar");
define("_INACTIVE","Inactivo");
define("_ACTIVATE","Activar");
define("_TYPE","Tipo");
define("_ADDNEWBLOCK","Agregar bloque");
define("_RSSFILE","Archivo RSS/RDF del sitio");
define("_ONLYHEADLINES","(S&oacute;lo para Titulares)");
define("_CONTENT","Contenido");
define("_MAILCONTENT","Contenido");
define("_ACTIVATE2","&iquest;Activar?");
define("_REFRESHTIME","Tiempo de Recarga");
//define("_HOUR","Hour");
define("_UGROUPS", "Grupos de Usuarios");
define("_CREATEBLOCK","Crear Bloque");
define("_EDITBLOCK","Editar Bloque");
define("_BLOCK","Bloque");
define("_SAVEBLOCK","Guardar Bloque");
define("_BLOCKACTIVATION","Activaci&oacute;n del Bloque");
define("_BLOCKPREVIEW","Esta es una Vista Previa del Bloque");
define("_WANT2ACTIVATE","&iquest;Quieres activar este Bloque?");
define("_ARESUREDELBLOCK","&iquest;Est&aacute;s seguro de querer quitar el Bloque?");
define("_RSSFAIL","Hay un problema con el archivo RSS de la direcci&oacute;n URL");
define("_RSSTRYAGAIN","Revisa la direcci&oacute;n URL y el archivo RSS, y vuelve a probar.");
define("_RSSCONTENT","(Contenido RSS/RDF)");
define("_IFRSSWARNING","Si pones un URL el contenido no ser&aacute; visualizado!");
define("_BLOCKUP","Arriba");
define("_BLOCKDOWN","Abajo");
define("_SETUPHEADLINES","(Selecciona \"No Definido\" y escribe el URL o selecciona simplemente un sitio en la lista para desplegar sus noticias)");
define("_HEADLINESADMIN","Administraci&oacute;n de Titulares");
define("_HEADLINES_ADMIN_HEADER", "Nuke-Evolution Titular :: Panel de administracion");
define("_HEADLINES_RETURNBLOCK", "Volver a Bloque de Administracion");
define("_ADDHEADLINE","Agregar Titular");
define("_EDITHEADLINE","Editar Titular");
define("_SURE2DELHEADLINE","ADVERTENCIA: &iquest;Est&aacute;s seguro de querer borrar este titular?");
define("_CUSTOM","Costumbre");
define("_AUTHORSADMIN","Autor de la Administracion");
define("_AUTHORS_ADMIN_HEADER", "Nuke-Evolution Editar Administradores :: Panel de administracion");
define("_AUTHORS_RETURNMAIN", "Return to Main Administration");
define("_MODIFYINFO","Modificar la informacion");
define("_DELAUTHOR","Eliminar autor");
define("_AUTHOR_EXISTS","El nombre de administrador ya existe");
define("_AUTHOR_EDITING_UNAUTH","Edicion no autorizada de los autores detectados");
define("_ADDAUTHOR","Agregar un nuevo administrador");
define("_AUTHOR_NICK_INVALID","Nombre de Nick no valido");
define("_PERMISSIONS","Permisos");
define("_USERS","Usuarios");
define("_SUPERUSER","Super Usuario");
define("_SUPERWARNING","ATENCI&oacute;N: si seleccionas Super Usuario, tendr&aacute; acceso total!");
define("_ADDAUTHOR2","Agregar Autor");
define("_RETYPEPASSWD","Re-escribir Clave");
define("_PASS_NOT_MATCH", "La clave no coincide con");
define("_ERROR_FIRST_EMAIL", "correo esta vacio o no es valido");
define("_ERROR_FIRST_NICK", "Nombre de Nick esta vacio o no es valido");
define("_ERROR_FIRST_URL", "Direccion URL esta vacio o no es valido");
define("_FORCHANGES","(Para cambios solo)");
define("_COMPLETEFIELDS","Debe completar todos los campos obligatorios");
define("_CREATIONERROR","Error de creacion del autor");
define("_AUTHORDELSURE","Confirma que desea eliminar");
define("_AUTHORDEL","Eliminar autor");
define("_REQUIREDNOCHANGE","(requerido, no podr&aacute; ser cambiado despu&eacute;s)");
define("_PUBLISHEDSTORIES","Este administrador ha publicado historias");
define("_SELECTNEWADMIN","Selecciona un nuevo administrador para reasignar");
define("_GODNOTDEL","*(la cuenta GOD no puede borrarse)");
define("_MAINACCOUNT","Administrador God*");
//define("_ADD","Add");
define("_DAY","Dia");
define("_AUTOMATEDARTICLES","Noticias Programados");
define("_NOAUTOARTICLES","No hay Noticias Programadas");
define("_WARNING","Cuidado");
define("_NOFUNCTIONS","---------");
define("_REFERER_ADMIN_HEADER", "Referencias HTTP del Nuke-Evolution :: Panel de Administraci&oacute;n");
define("_REFERER_RETURNMAIN", "Volver al &iacute;ndice de la Administraci&oacute;n");
define("_WHOLINKS","&iquest;Qui&eacute;n enlaza nuestro sitio?");
define("_DELETEREFERERS","Borrar los Datos");
define('_ERROR_NONE_TO_DISPLAY','No hay %s para mostrar');
define("_SITENAME","Nombre del Sitio");
define("_PASSWDNOMATCH","Lo siento, el nuevo Password no concuerda. Int&eacute;ntalo de nuevo");
define("_SETTINGS_ADMIN_HEADER", "Preferencias Nuke-Evolution :: Panel de Administraci&oacute;n");
define("_SETTINGS_RETURNMAIN", "Volver al &iacute;ndice de la Administraci&oacute;n");
define("_SITECONFIG","Configuraci&oacute;n del Sitio Web");
define("_GENSITEINFO","Informaci&oacute;n General del Sitio");
define("_SITEURL","URL del sitio");
define("_SITELOGO","Logotipo del sitio");
define("_SITESLOGAN","Slogan del sitio");
define("_ADMINEMAIL","E-Mail del Administrador");
define("_ITEMSTOP","N&uacute;mero de art&iacute;culos en la P&aacute;gina de los Top");
define("_STORIESHOME","N&uacute;mero de Noticias en el Home");
define("_OLDSTORIES","Noticias en el Bloque de Noticias Anteriores");
define("_DEFAULTTHEME","Theme por defecto del sitio");
define("_SELLANGUAGE","Seleccionar Idioma para el sitio");
define("_LOCALEFORMAT","Formato de Tiempo Local");
define("_BANNERSOPT","Opciones de Banners");
define("_STARTDATE","Fecha de Inicio del Sitio");
define("_ACTBANNERS","&iquest;Activar Banners en tu Sitio?");
define("_FOOTERMSG","Mensajes de Pi&eacute; de P&aacute;gina");
define("_FOOTERLINE1","Pi&eacute; de P&aacute;gina 1");
define("_FOOTERLINE2","Pi&eacute; de P&aacute;gina 2");
define("_FOOTERLINE3","Pi&eacute; de P&aacute;gina 3");
define("_BACKENDCONF","Configuraci&oacute;n del Backend");
define("_BACKENDTITLE","T&iacute;tulo del Backend");
define("_BACKENDLANG","Idioma del Backend");
define("_MAIL2ADMIN","Enviar Nuevas Noticias al Administrador");
define("_NOTIFYSUBMISSION","&iquest;Notificar por E-Mail los Nuevos Env&iacute;os?");
define("_EMAIL2SENDMSG","E-Mail para enviar el mensaje");
define("_EMAILSUBJECT","Asunto del E-Mail");
define("_EMAILMSG","Mensaje del E-Mail");
define("_EMAILFROM","Cuenta de E-Mail (De)");
define("_COMMENTSMOD","Moderaci&oacute;n de los Comentarios");
define("_MODTYPE","Tipo de Moderaci&oacute;n");
define("_MODADMIN","Moderaci&oacute;n por Administradores");
define("_MODUSERS","Moderaci&oacute;n por Usuarios");
define("_NOMOD","Sin Moderaci&oacute;n");
define("_COMMENTSOPT","Opci&oacute;n de Comentarios");
define("_COMMENTSLIMIT","L&iacute;mite en Bytes de los comentarios");
define("_ANONYMOUSNAME","Nombre del An&oacute;nimo");
define("_GRAPHICOPT","Opciones Gr&aacute;ficas");
define("_ADMINGRAPHIC","Men&uacute; Gr&aacute;fico de Administraci&oacute;n");
define("_MISCOPT","Opciones Variadas");
define("_PASSWDLEN","Tama&ntilde;o m&iacute;nimo del Password de usuario");
define("_MAXREF","&iquest;Cu&aacute;ntas Referers quieres como m&aacute;ximo?");
define("_COMMENTSPOLLS","&iquest;Activar Comentarios en las Encuestas?");
define("_ALLOWANONPOST","Permitir env&iacute;os an&oacute;nimos");
define("_ACTIVATEHTTPREF","Activar HTTP Enlaces");
define("_SIZE","Tama&ntilde;o");
define("_MESSAGES","Mensajes");
//define("_MESSAGESADMIN","Messages Administration");
define("_MESSAGES_ADMIN_HEADER", "Mensajes Nuke-Evolution :: Panel de Administraci&oacute;n");
define("_MESSAGES_RETURNMAIN", "Volver al &iacute;ndice de la Administraci&oacute;n");
define("_MESSAGETITLE","T&iacute;tulo");
define("_MESSAGECONTENT","Contenido");
define("_EXPIRATION","Caducidad");
define("_VIEWPRIV","&iquest;Qui&eacute;n puede ver esto?");
define("_MVADMIN","S&oacute;lo Administradores");
define("_MVUSERS","S&oacute;lo Usuarios Registrados");
define("_MVANON","S&oacute;lo Usuarios An&oacute;nimos");
define("_MVALL","Todo el mundo");
define("_CHANGEDATE","&iquest;Cambiar la fecha de comienzo a hoy?");
define("_IFYOUACTIVE","(Si activa este Mensaje ahora, la fecha de comienzo ser&aacute; hoy)");
define("_FILENAME","Nombre de Archivo");
define("_FILEINCLUDE","(Selecciona un bloque a ser inclu&iacute;do. Todos los dem&aacute;s campos ser&aacute;n ignorados)");
define("_BLOCKFILE","(Archivo de Bloque)");
define("_COMMENTSARTICLES","&iquest;Activar Comentarios para las Noticias?");
define("_MULTILINGUALOPT","Opciones multi-idioma");
define("_ACTMULTILINGUAL","&iquest;Activar opciones multi-idioma? ");
define("_ACTUSEFLAGS","Mostrar banderas en cambio de texto? ");
define("_LANGUAGE","Lenguaje");
define("_EDITMSG","Editar Mensaje");
define("_ADDMSG","Agregar Mensaje");
define("_ALLMESSAGES","Lista de Mensajes");
define("_VIEW","Visible para");
define("_REMOVEMSG","&iquest;Est&aacute;s seguro de querer quitar este Mensaje? ");
define("_MODULES_ADMIN_HEADER", "M&oacute;dulos Nuke-Evolution :: Panel de Administraci&oacute;n");
define("_MODULES_BLOCK", "Bloque de M&oacute;dulos");
define("_MODULES_RETURNMAIN", "Volver al &iacute;ndice de la Administraci&oacute;n");
define("_MODULES","M&oacute;dulos");
define("_MODULESADMIN","Administraci&oacute;n de M&oacute;dulos");
define("_MODULESADDONS","M&oacute;dulos y Addons");
define("_MODULESACTIVATION","Muestra el estado de los M&oacute;dulos/Addons y permite activar o desactivar estos.<br />Los m&oacute;dulos nuevos se copian en la carpeta <i>/modules/</i> ser&aacute;n agregados autom&aacute;ticamente a la base de datos de forma <i>Inactiva</i> cuando actualices la p&aacute;gina.<br />Si quieres eliminar alg&uacute;n m&oacute;dulo solo borra la carpeta del mismo, contenida en la carpeta <i>/modules/</i> el sistema lo actualizara automaticamente en la base de datos para mostrar los cambios.");
define("_NEWSLETTER_ADMIN_HEADER", "Boletines Nuke-Evolution :: Panel de Administraci&oacute;n");
define("_NEWSLETTER_RETURNMAIN", "Volver al &iacute;ndice de la Administraci&oacute;n");
define("_NEWSLETTER","Bolet&iacute;n");
define("_MASSMAIL","E-Mail masivo a TODOS los usuarios");
define("_ANEWSLETTER","Bolet&iacute;n s&oacute;lo a los usuarios suscritos");
define("_WHATTODO","&iquest;Qu&eacute; deseas enviar?");
define("_SUBSCRIBEDUSERS","Usuarios Suscritos");
define("_NYOUAREABOUTTOSEND","Est&aacute;s a punto de enviar un bolet&iacute;n a los usuarios suscritos.");
define("_NUSERWILLRECEIVE","Usuarios recibir&aacute;n este Bolet&iacute;n.");
define("_REVIEWTEXT","Por favor revisa bien el texto:");
define("_NAREYOUSURE2SEND","&iquest;Est&aacute;s seguro de querer enviar este Bolet&iacute;n ahora?");
define("_MYOUAREABOUTTOSEND","Est&aacute;n a punto de enviar un E-Mail masivo a TODOS los usuarios registrados.");
define("_MUSERWILLRECEIVE","Usuarios recibir&aacute;n este E-Mail.");
define("_MUSERGROUPWILLRECEIVE","Este Bolet&iacute;n ha sido enviado a ");
define("_MAREYOUSURE2SEND","&iquest;Est&aacute;s seguro de querer enviar el E-Mail masivo ahora?");
define("_POSSIBLESPAM","Advierte que ciertos usuarios se pueden sentir ofendidos por este tipo de mensajes masivos y puede ser considerado como Spam!");
define("_MASSEMAIL","E-Mail Masivo");
define("_MANYUSERSNOTE","CUIDADO! Hay muchos usuarios que recibir&aacute;n este correo. Por favor espera que el script termine su operaci&oacute;n. Esto puede llevar varios minutos en completarse!");
define("_NLUNSUBSCRIBE","=========================================================<br />Tu est&aacute;s recibiendo este Bolet&iacute;n debido a as&iacute; lo has seleccionado en el sitio $sitename.\nPuedes desuscribirte de este servicio haciendo clicklick en el URL:\n\n$nukeurl/modules.php?name=Your_Account&op=edituser\"\n\nluego selecciona \"No\" en la opci&oacute;n de Recibir Bolet&iacute;n por Email y graba tus cambios, si necesitas mayor asistencia por favor contacta al administrador de $sitename.");
define("_NEWSLETTERSENT","El Bolet&iacute;n ha sido enviado.");
define("_MASSEMAILSENT","Email Masivo a todos los usuarios registrados ha sido enviado.");
define("_MASSEMAILMSG","=========================================================<br />Est&aacute;s recibiendo este correo porque eres usuario registrado de $sitename. Esperamos que este mensaje no te cause molestias y de alguna manera contribuya a mejorar nuestro servicio.");
define("_FIXBLOCKS","Arreglar Conflictos de orden en los bloques");
define("_CUSTOMTITLE","T&iacute;tulo Propio");
define("_CHANGEMODNAME","Cambiar Nombre del M&oacute;dulo");
define("_CUSTOMMODNAME","N&oacute;mbre propio del M&oacute;dulo:");
define("_MODULEEDIT","Editar M&oacute;dulos");
define("_BLOCKFILE2","ARCHIVO");
define("_BLOCKSYSTEM","SISTEMA");
define("_DEFHOMEMODULE","M&oacute;dulo por Defecto del Homepage");
define("_MODULEINHOME","M&oacute;dulo en el Home pagina:");
define("_CHANGE","Cambiar");
define("_INHOME","En Inicio");
define("_MODULEHOMENOTE","<b>-= CUIDADO =-</b><br />El t&iacute;tulo en negritas representa el m&oacute;dulo que esta como predeterminado en la P&aacute;gina de Inicio.<br />No podr&aacute;s desactivar este m&oacute;dulo o especificar restricciones mientras este sea el m&oacute;dulo predeterminado!<br />Si borras el directorio del m&oacute;dulo ver&aacute;s un error en la P&aacute;gina de Inicio.<br />Este m&oacute;dulo tambi&eacute;n sera reemplazado con un enlace a la <i>P&aacute;gina de inicio</i> desde el bloque de m&oacute;dulos.");
define("_PUTINHOME","Al Inicio");
define("_SURETOCHANGEMOD","&iquest;Est&aacute;s seguro de querer cambiar tu Homepage de");
define("_CENTERBLOCK","Bloque Central");
define("_ADMINISTRATION","Administracion");
define("_NOADMINYET","No existen cuentas de administradores a&uacute;n, procede a crear el Super Usuario:");
define("_CREATEUSERDATA","&iquest;Deseas crear un usuario com&uacute;n con los mismos datos?");
define("_NORMAL","Normal");
define("_INACTIVEBANNERS","Banners Inactivos");
define("_CENTERUP","<strong>Centro Arriba</strong>");
define("_CENTERDOWN","<strong>Centro Abajo</strong>");
define("_NOTINMENU","[ <big><strong>&middot;</strong></big> ] implica un m&oacute;dulo cuyo nombre y enlace no son visibles en el Bloque de M&oacute;dulos");
define("_SHOWINMENU","&iquest;Visible en Bloque M&oacute;dulos?");
define("_BANNERS","Banners");
define("_ALTTEXT","Texto alternativo");
define("_MUSTBEINIMG","debe estar en el directorio /images/. Valido solo para el modulo AvantGo");
define("_USERSOPTIONS","Opciones de usuarios");
define("_BROADCASTMSG","&iquest;Activar mensajes p&uacute;blicos?");
define("_MYHEADLINES","&iquest;Activar Lector de Noticias?");
define("_USERSHOMENUM","Permitir que los usuarios cambien noticias en el inicio?");
define("_CENSOROPTIONS","Opciones de censura");
define("_CENSORMODE","Modo de Censura");
define("_NOFILTERING","Sin Filtrado");
define("_EXACTMATCH","Frase Exacta");
define("_MATCHBEG","Palabra igual al inicio");
define("_MATCHANY","Coincidencia en cualquier parte del texto");
define("_CENSORREPLACE","Reemplaza palabras censuradas con:");
define("_SECURITYCODE","C&oacute;digo de Seguridad");
define("_TYPESECCODE","Escribe aqu&iacute; el c&oacute;digo de seguridad");
define("_VALIDIFREG","Ser&aacute; v&aacute;lido s&oacute;lo si arriba se ha seleccionado Usuarios Registrados");
define("_AFTEREXPIRATION","Despu&eacute;s de Caducar");
define("_SUBUSERS","Usuarios Suscritos");
define("_SUBVISIBLE","&iquest;Visible a los Suscriptores?");
define("_IMAGESWFURL","URL de la Imagen");
define("_DONATORS","Donaciones");
define("_DEFAULT","Por defecto");
define("_DELETEBLOCK","Eliminar bloque");
define("_BACK","Atras");

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
define("_PSM_NOTRATED","No clasificado");
define("_PSM_CLICK","Click");
define("_PSM_HERE","<strong>aqui</strong>");
define("_PSM_HELP","para ayuda a crear una contrase&ntilde;a segura");
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
define('_NO_ADMIN_RIGHTS', 'No tiene permiso de administracion para ');
define('_NO_FORUM_RIGHTS', 'Es posible, que usted tiene permisos para la administracion el modulo que ha seleccionado<br/>Pero tambien necesita derechos de administracion de foro para poder hacer su trabajo.<br />error en el modulo ');
define('_NO_ADMIN_MODULE_LANGUAGE_FOUND', 'No se encontro ningun archivo de idioma para el modulo: ');  
?>