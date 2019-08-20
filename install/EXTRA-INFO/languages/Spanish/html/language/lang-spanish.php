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

define("_CHARSET","UTF-8");
define("_LANG_DIRECTION","ltr");
define("_SEARCH","Buscar");
define("_SUBMIT","Enviar");
define("_REFRESH_SEC_CODE","Actualice Codigo Seguridad");
define("_CONFIRM", "Confirmar");
define("_PROFILE","Perfil");
define("_LOGIN","Conectarse");
define("_VIEWING","Visualizacion");
define("_WRITES","escribe");
define("_APPROVEDBY","Aprobado por");
define("_POSTEDON","Publicado en");
define("_NICKNAME","Nombre de Usuario");
define("_PASSWORD","Contrase&ntilde;a");
define("_WELCOMETO","Bienvenido a");
define("_EDIT","Editar");
define("_DELETE","Eliminar");
define("_POSTEDBY","Publicado por");
define("_READS","lee");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Regresar</a> ]");
define("_BACK","Atras");
define("_COMMENTS","comentarios");
define("_PASTARTICLES","Articulos Pasados");
define("_OLDERARTICLES","Articulos Viejos");
define("_BY","por");
define("_ON","en");
define("_LOGOUT","Desconectarse");
define("_WAITINGCONT","Esperando Contenido");
define("_SUBMISSIONS","Peticiones");
define("_EPHEMERIDS","Ephemerids");
define("_ONEDAY","Un dia como hoy...");
define("_ASREGISTERED","Todavia no tienes una cuenta? Puede <a href=\"modules.php?name=Your_Account&amp;op=new_user\">crear una</a>. Como usuario registrado tendras ventajas como seleccionar la pagina, configurar los comentarios y enviar los comentarios con tu nombre.");
define("_MENUFOR","Menu de");
define("_NOBIGSTORY","No hay una Gran Historia Hoy en dia, aun.");
define("_BIGSTORY","Hoy la historia es mas leidos:");
define("_SURVEY","Encuesta");
define("_POLLS","Encuestas");
define("_PCOMMENTS","Comentarios:");
define("_RESULTS","Resultados");
define("_HREADMORE","leer mas...");
define("_CURRENTLY","En la actualidad hay,");
define("_GUESTS","invitado(s) y");
define("_MEMBERS","miembro (s) que esta en linea.");
define("_YOUARELOGGED","Que se registran como");
define("_YOUHAVE","Usted tiene");
define("_PRIVATEMSG","Mensaje privado(s).");
define("_YOUAREANON","Eres un usuario anonimo. Usted puede registrarse gratuitamente haciendo clic en <a href=\"modules.php?name=Your_Account&amp;op=new_user\">Aqui</a>");
define("_NOTE","Nota:");
define("_ADMIN","Administracion:");
define("_WERECEIVED","Hemos recibido");
define("_PAGESVIEWS","Vistas en la pagina desde");
define("_TOPIC","Tema");
define("_UDOWNLOADS","Descargas");
define("_VOTE","Voto");
define("_VOTES","Votos");
define("_MVIEWADMIN","Ver: Solo Administradores");
define("_MVIEWUSERS","Ver: Solo Usuarios Registrados");
define("_MVIEWANON","Ver: Solo Usuarios Anonimo");
define("_MVIEWGROUP","Ver: Solo los grupos");
define("_MVIEWALL","Ver: Todos los Visitantes");
define("_EXPIRELESSHOUR","Vencimiento: Menos de 1 hora");
define("_EXPIREIN","Vencimiento en");
define("_HTTPREFERERS","HTTP Referente");
define("_UNLIMITED","Ilimitado");
define("_HOURS","Horas");
define("_RSSPROBLEM","Actualmente hay un problema con los titulares de este sitio");
define("_SELECTLANGUAGE","Seleccionar Idioma");
define("_SELECTGUILANG","Selecciona el Idioma:");
define("_NONE","Ninguno");
define("_BLOCKPROBLEM","Hay un problema ahora con este bloque.");
define("_BLOCKPROBLEM2","En este momento no existe contenido para este bloque.");
define("_MODULENOTACTIVE","Lo sentimos, este modulo no esta activo!");
define("_MODULEDOESNOTEXIST","Lo siento ... pero este modulo no existe!");
define("_NOACTIVEMODULES","Modulos Inactivos");
define("_FORADMINTESTS","(Para Pruebas)");
define("_BBFORUMS","Foros");
define("_ACCESSDENIED", "Acceso denegado");
define("_RESTRICTEDAREA", "Esta intentando acceder a una zona restringida.");
define("_MODULEUSERS", "Lo sentimos, pero esta seccion de nuestro sitio es para <em>Solo Usuarios Registrados.</em><br /><br />You can register for free by clicking <a href=\"modules.php?name=Your_Account&amp;op=new_user\">here</a>, then you can<br />access this section without restrictions. Thanks.<br /><br />");
define("_MODULESADMINS", "Lo sentimos pero esta seccion de nuestro sitio es para <em>Solo administradores.</em><br /><br />");
define("_HOME","Inicio");
define("_HOMEPROBLEM","Hay aqui un gran problema: no tenemos una pagina principal!!!");
define("_ADDAHOME","Agregar un modulo en su pagina principal");
define("_HOMEPROBLEMUSER","Hay un problema ahora mismo en la pagina de inicio. Vuelva a intentarlo mas tarde.");
define("_MORENEWS","Mas informacion en Seccion Noticias");
define("_ALLCATEGORIES","Todas las categorias");
//define("_DATESTRING","%A, %B %d, %Y @ %T %Z");
//define("_DATESTRING2","%A, %B %d");
define('_DATESTRING','%A, %B %d, %Y (%H:%M:%S)');
define('_DATESTRING2','%A, %B %d');
define('_DATESTRING3','%d-%b-%Y');
define('_DATESTRING4','%1$s, %2$s %3$s');
define("_DATE","Fecha");
define("_HOUR","Hora");
define("_UMONTH","Mes");
define("_YEAR","A&ntilde;o");
define("_JANUARY","Enero");
define("_FEBRUARY","Febrero");
define("_MARCH","Marzo");
define("_APRIL","Abril");
define("_MAY","Mayo");
define("_JUNE","Junio");
define("_JULY","Julio");
define("_AUGUST","Augosto");
define("_SEPTEMBER","Septembre");
define("_OCTOBER","Octubre");
define("_NOVEMBER","Noviembre");
define("_DECEMBER","Diciembre");
define("_BWEL","Bienvenido");
define("_BLOGOUT","Desconectarse");
define("_BPM","Mensajes Privados");
define("_BUNREAD","No leidos");
define("_BREAD","Leer");
define("_BSAVED","Guardado");
define("_BTT","Total");
define("_BMEMP","Numero de miembros");
define("_BLATEST","Mas reciente");
define("_BTD","Nuevos Hoy");
define("_BYD","Nuevos Ayer");
define("_BOVER","Total");
define("_BVISIT","Gente en linea");
define("_BVIS","Visitantes");
define("_BMEM","Miembros");
define("_BON","Ahora en linea:");
define("_BOR","o");
define("_BPLEASE","Por favor");
define("_BREG","Registrese");
define("_BROADCAST","Difusion mensajes publico");
define("_BROADCASTFROM","Mensajes publico");
define("_TURNOFFMSG","Desactivar mensajes publicos");
define("_JOURNAL","Diario");
define("_READMYJOURNAL","Leer Mi Diario");
define("_ADD","Agregar");
define("_YES","Si");
define("_NO","No");
define("_INVISIBLEMODULES","Modulos Invisibles");
define("_ACTIVEBUTNOTSEE","(Activa pero vinculo invisible)");
define("_THISISAUTOMATED","Se trata de un mensaje automatizado para informarle que se ha completado su publicidad banner en nuestro sitio.");
define("_THERESULTS","Los resultados de su campa&ntilde;o son los siguientes:");
define("_TOTALIMPRESSIONS","Total de impresion:");
define("_CLICKSRECEIVED","Clics recibidos:");
define("_IMAGEURL","Imagen URL");
define("_CLICKURL","Click URL:");
define("_ALTERNATETEXT","Texto alternativo:");
define("_HOPEYOULIKED","Espero te gusto nuestro servicio. Nosotros esperamos contar con usted como un cliente de publicidad de nuevo pronto.");
define("_THANKSUPPORT","Gracias por su apoyo");
define("_TEAM","Tem");
define("_BANNERSFINNISHED","Banners Anuncios Terminado");
define("_PAGEGENERATION","Pagina Generada:");
define("_MEMORYUSAGE","Uso de la memoria: ");
define("_DBQUERIES","SQL Consultas: ");
//define('_PAGEFOOTER','This page was generated in %1$s seconds with %2$s DB Queries in %3$s seconds');
define("_SECONDS","Seconds");
define("_YOUHAVEONEMSG","Usted tiene 1 Nuevo mensaje privado");
define("_NEWPMSG","Mensajes nuevos");
define("_CONTRIBUTEDBY","Colaboracion de");
define("_CHAT","Chat");
define("_REGISTERED","Registrado");
define("_CHATGUESTS","Invitado");
define("_USERSTALKINGNOW","Ahora los usuarios de habla");
define("_ENTERTOCHAT","Para entrar en chat");
define("_CHATROOMS","Habitaciones disponibles");
define("_SECURITYCODE","Codigo Seguridad");
define("_TYPESECCODE","Escribe el Codigo");
define("_ASSOTOPIC","Temas asociados");
define("_ADDITIONALYGRP","Adicionalmente este modulo pertenece al Grupo de Usuarios");
define("_YOUHAVEPOINTS","Puntos que han participando en el contenido del sitio:");
define("_MVIEWSUBUSERS","Ver: Solo para usuarios suscritos");
define("_MODULESSUBSCRIBER","Lo sentimos pero esta seccion de nuestro sitio es para <em>Solo los usuarios suscritos.</em>");
define("_MODULESGROUP","Lo sentimos pero esta seccion de nuestro sitio es para <em>Miembros del Grupo</em>");
define("_SUBEXPIRED","De vencimiento de su suscripcion");
define("_HELLO","Hola");
define("_SUBSCRIPTIONAT","Este es un mensaje automatico para informarle de que su suscripcion a");
define("_HASEXPIRED","ahora ha sido vencido.");
define("_HOPESERVED","Espero haberles servido a ustedes con satisfaccion...");
define("_SUBRENEW","Si desea renovar su suscripcion por favor vaya a:");
define("_YOUARE","Tu eres");
define("_SUBSCRIBER","suscriptor");
define("_OF","de");
define("_SBYEARS","a&ntilde;os");
define("_SBYEAR","a&ntilde;o");
define("_SBMINUTES","minutos");
define("_SBHOURS","horas");
define("_SBSECONDS","segundos");
define("_SBDAYS","dias");
define("_SUBEXPIREIN","Su suscripcion expirara en:");
define("_NOTSUB","Usted no es un abonado de");
define("_NOTSUBUSR","No es un suscriptor de");
define("_SUBFROM","Usted puede suscribirse a partir de");
define("_HERE","aqui");
define("_NOW","ahora!");
define("_ADMSUB","Usuario suscrito!");
define("_ADMNOTSUB","Usuario no suscrito");
define("_ADMSUBEXPIREIN","Suscripcion caduca en:");
define("_LASTIP","Ultimo usuario IP:");
define("_LASTVISIT","Ultima visita:");
define("_LASTNA","N/A");
define("_BANTHIS","Prohibir esta IP");
define("_ADMIN_BLOCK_DENIED", "No esta autorizado para ver este bloque");
define("_NEWSLETTERBLOCKSUBSCRIBED", "Usted esta suscrito a la carta de noticias");
define("_NEWSLETTERBLOCKREGISTER", "Usted debe registrarse para recibir la carta de noticias");
define("_NEWSLETTERBLOCKREGISTERNOW", "Haga clic para registrarse");
define("_NEWSLETTERBLOCKNOTSUBSCRIBED", "No esta suscrito a la carta de noticias");
define("_NEWSLETTERBLOCKSUBSCRIBE", "Suscribir");
define("_NEWSLETTERBLOCKUNSUBSCRIBE", "Darse de baja");
define("_ANONYMOUS","Anonimo");
define("_MODULEERROR"," Hubo un error de modulo ");

define('_ILLEGAL_OP_OPERATION', 'Ha llamado este sitio con un operando no valido en su URL <br />Por favor, compruebe que en su navegador');
define('_PAGE_NOT_EXISTS', 'Lo sentimos, pero la pagina que desea esta no disponible');
define('_REFRESH_SCREEN', 'Actualizar la pantalla');

define('_AS_IS', 'Como es');
define('_OFFTOPIC', 'Fuera de tema');
define('_FLAMEBAIT', 'Llama Cebo');
define('_TROLL', 'Troll');
define('_REDUNDANT', 'Redundantes');
define('_INSIGHTFUL', ' Perspicaz ');
define('_INTERESTING', 'Interesante');
define('_INFORMATIVE', 'Informativo');
define('_FUNNY', 'Divertidos');
define('_OVERRATED', 'Mas excelente');
define('_UNDERRATED', 'Excelente menores');
define('_EVO_HELPSYSTEM', 'Nuke Evolution Ayuda');

define('_GUESTS', 'Invitados');
define('_GUEST', 'Invitado');
define('_BOTS', 'Buscar Bots');
define('_BOT', 'Buscar Bot');
define('_ABR_DAYS', 'D');
define('_ABR_MONTHS', 'M');
define('_ABR_YEARS', 'Y');
define('_ABR_MINUTES', 'Min');
define('_ABR_HOURS', 'H');
define('_ABR_SECONDS', 'Sec');

define("_ACTIVETOPICS","Temas Activo actuales");

// Modulenames to show in Who-is-Online

/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/

define('_MODULE_-50', ' Jugar el juego');
define('_MODULE_-51', ' Ver la Galeria');
define('_MODULE_-52', ' Ver puntuacion superiores');
define('_MODULE_-53', ' Ver estadisticas');
define('_MODULE_-54', ' Ver la Junta');

/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
define('_MODULE_0', ' Indice del Foro');
define('_MODULE_-1', 'Conectarse al Foro');
define('_MODULE_-2', 'Buscar');
define('_MODULE_-3', 'Registro');
define('_MODULE_-4', 'Perfil');
define('_MODULE_-6', 'Foro Quien esta en-linea');
define('_MODULE_-7', 'Lista de miembros');
define('_MODULE_-8', 'Foro FAQ');
define('_MODULE_-9', 'Anuncios del Foro');
define('_MODULE_-10', 'Mensajes Privados');
define('_MODULE_-11', 'Grupos');
define('_MODULE_-1210', 'Adjuntos');
define('_MODULE_-1214', 'Reglas de la Junta');
define('_MODULE_-12', 'Personal');
define('_MODULE_-33', 'Temas recientes');
define('_MODULE_-34', 'Estadisticas del foro');
define('_MODULE_-35', 'Filas');
define('_MODULE_-50', 'Administracion del Foro');
define('_MODULE_-5000', 'Temas del Foro');

?>