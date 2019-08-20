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

define("_SEND","Enviar");
define("_URL","URL");
define("_PRINTER","Impresora amistosa");
define("_FRIEND","Enviar a un amigo");
define("_YOURNAME","Su nombre");
define("_OK","Aceptar!");
define("_RELATED","Enlaces relacionados");
define("_MOREABOUT","Mas acerca");
define("_NEWSBY","Noticias por");
define("_MOSTREAD","La mayoria leyeron historia acerca");
define("_READMORE","Leer mas...");
define("_BYTESMORE","bytes mas");
define("_COMMENTSQ","comentarios?");
define("_COMMENT","comentario");
define("_CONFIGURE","Configurar");
define("_LOGINCREATE","Abrir una sesion/crear una cuenta");
define("_THRESHOLD","Umbral");
define("_NOCOMMENTS","Ningunos comentarios");
define("_NESTED","Jerarquizado");
define("_FLAT","Plano");
define("_THREAD","Subproceso");
define("_OLDEST","El primer mas viejo");
define("_NEWEST","El primer mas nuevo");
define("_HIGHEST","Las cuentas mas altas primero");
define("_COMMENTSWARNING","Los comentarios son poseidos por el cartel. Nosotros no responsables de su contenido.");
define("_SCORE","Puntuacion:");
define("_USERINFO","Usuario Info");
define("_READREST","Leer el resto de este comentario...");
define("_REPLY","Contestacion a esto");
define("_REPLYMAIN","Comentario del mensaje");
define("_NOSUBJECT","Ningun tema");
define("_NOANONCOMMENTS","Ningunos comentarios permitidos para anonimo, por favor <a href=\"modules.php?name=Your_Account&amp;op=new_user\">registro</a>");
define("_PARENT","Padre");
define("_ROOT","Raiz");
define("_UCOMMENT","Comentario");
define("_ALLOWEDHTML","HTML permitido:");
define("_POSTANON","Mensaje anonimo");
define("_EXTRANS","Extrans (etiquetas del HTML al texto)");
define("_HTMLFORMATED","HTML Dado formato");
define("_PLAINTEXT","Viejo texto llano");
define("_ONN","en...");
define("_SUBJECT","Tema");
define("_COMMENTREPLY","Mensaje del comentario");
define("_COMREPLYPRE","Mensaje del comentario");
define("_NOTRIGHT","Algo no esta a la derecha con el paso de una variable a esta funcion. Este mensaje es apenas guardar cosas de ensuciar abajo del camino");
define("_SENDAMSG","Enviar un mensaje");
define("_YOUSENDSTORY","Usted enviara la historia");
define("_TOAFRIEND","a un amigo especificado:");
define("_FYOURNAME","Su nombre:");
define("_FYOUREMAIL","Su email:");
define("_FFRIENDNAME","Nombre de su amigo:");
define("_FFRIENDEMAIL","Email de su amigo:");
define("_INTERESTING_ARTICLE","Articulo interesante en");
define("_YOURFRIEND","Su amigo");
define("_CONSIDERED","consideraba el articulo siguiente interesante y quiso enviarlelo.");
define("_FDATE","Fecha:");
define("_FTOPIC","Tema:");
define("_YOUCANREAD","Usted puede leer los articulos interesantes en");
define("_FSTORY","Historia");
define("_HASSENT","Se ha enviado a");
define("_THANKS","Gracias!");
define("_RECOMMEND","Recomendar este sitio a un amigo");
define("_PDATE","Fecha:");
define("_PTOPIC","Tema:");
define("_COMESFROM","Este articulo viene de");
define("_THEURL","El URL para esta historia es:");
define("_PREVIEW","Vista previa");
define("_NEWUSER","Nuevo usuario");
define("_OPTIONS","Opciones");
define("_REFRESH","Restaurar");
define("_NOCOMMENTSACT","Lo siento, los comentarios no estan disponibles para este articulo.");
define("_ARTICLEPOLL","Encuesta del articulo");
define("_RATEARTICLE","Clasificacion del articulo");
define("_RATETHISARTICLE","Tomar por favor un segundo y un voto para este articulo:");
define("_CASTMYVOTE","Emitir mi voto!");
define("_AVERAGESCORE","Cuenta media");
define("_BAD","Malo");
define("_REGULAR","Regular");
define("_GOOD","Bueno");
define("_VERYGOOD","Muy bueno");
define("_EXCELLENT","Excelente");
define("_ARTICLERATING","Clasificacion del articulo");
define("_THANKSVOTEARTICLE","Gracias por votar por este articulo!");
define("_ALREADYVOTEDARTICLE","Lo siento, usted voto ya por este articulo recientemente!");
define("_BACKTOARTICLEPAGE","De nuevo a la pagina del articulo");
define("_DIDNTRATE","Usted no selecciono ninguna cuenta para el articulo!");
define("_NOINFO4TOPIC","Lo siento, no hay informacion para el tema seleccionado.");
define("_GOTONEWSINDEX","Ir al indice de las noticias");
define("_SELECTNEWTOPIC","Seleccionar un nuevo tema");
define("_GOTOHOME","Ir a dirigirse");
define("_SEARCHONTOPIC","Busqueda en este tema");
define("_SEARCHDIS","Discusion de la busqueda");
define("_READPDF","Leido como PDF");
define("_READWITHCOMMENTS", "Usted puede leer la historia completa con sus comentarios de");
/*****[BEGIN]******************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/
define("_NE_SELECT","Seleccionar la pagina");
define("_NE_OF","de");
define("_NE_PAGES","pages");
define("_NE_NEWSCONFIG","Configuracion de las noticias");
define("_NE_DISPLAYTYPE","Columna de la exhibicion");
define("_NE_SINGLE","Solo columna");
define("_NE_DUAL","Columna dual");
define("_NE_READLINK","Leer mas Vinculo");
define("_NE_POPUP","Movil");
define("_NE_PAGE","Pagina");
define("_NE_TEXTTYPE","Longitud del articulo");
define("_NE_TRUNCATE","Truncar a 255 caracteres");
define("_NE_COMPLETE","Original texto");
define("_NE_NOTIFYAUTH","Notificar a autor");
define("_NE_NOTIFYAUTHNOTE","Esto se correo electronico del remitente de articulo<br />\no aprobacion");
define("_NE_NO","No");
define("_NE_YES","Si");
define("_NE_HOMETOPIC","Tema en la pagina principal");
define("_NE_ALLTOPICS","Todos los temas");
define("_NE_HOMENUMBER","Articulos en la pagina principal");
define("_NE_NUKEDEFAULT","Nuke predeterminado");
define("_NE_ARTICLES","Articulos");
define("_NE_HOMENUMNOTE","Esto eliminara preferencias de usuario<br />\nSi conjunto distinto Nuke predeterminado");
define("_NE_SAVECHANGES","Guardar los cambios");
/*****[END]********************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/
define("_NE_MODERATE","Enviar la moderacion");
define("_NE_WEBSITE","Sitio Web");
define("_NE_CATEGORY","Categoria");
define("_NE_COUNTRATINGS","Clasificaciones contadas");
define("_NE_NONE_NEWS","Ningunas noticias disponibles");
define("_NE_NO_EMPTY_COMMENT","Uno de los campos: el tema o el comentario es vacio. Volver por favor.<br />"._GOBACK);

?>