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

define("_ACTIVE","Activo");
define("_ACTIVEADSFOR","Banderas activas actuales para");
define("_ADISNTYOURS","<strong>Error:</strong> La bandera que usted esta intentando ver no se asigna a su cuenta.");
define("_ADSMENU","Publicidad del menu");
define("_ADSNOCONTENT","Lo siento en este tiempo no tenemos ningun plan publicitario disponible.");
define("_ADSYSTEM","Publicidad del sistema");
define("_ADVERTISING","Publicidad");
define("_ADPOSITIONS","Posiciones de los anuncios");
define("_ADSMODULEINACTIVE","[ Advertencia: La publicidad del modulo es inactiva! ]");
define("_ASSIGNEDADS","Anuncios asignados");
define("_ADDNEWPOSITION","Agregar la publicidad de posiciones");
define("_ADDPOSITION","Agregar la posicion");
define("_ADDADVERTISINGPLAN","Agregar la publicidad de plan");
define("_ADDNEWPLAN","Agregar el nuevo plan");
define("_ADCLASS","Clase del anuncio");
define("_ADIMAGE","Imagen");
define("_ADCODE","Javascript/HTML Codigo");
define("_ADFLASH","Flash");
define("_ADSNOCLIENT","<strong>Error:</strong> No hay ningun cliente publicitario.<br />Crear por favor a nuevo cliente antes de agregar banderas.");
define("_ADINFOINCOMPLETE","<strong>Error:</strong> La informacion de la bandera es incompleta!");
define("_ADDEDDATE","Fecha agregada");
define("_ADVERTISINGPLANS","Publicidad de planes");
define("_ADDPLANERROR","<strong>Error:</strong> Uno o mas campos son vacios. Volver por favor y corregir el problema.");
define("_ADVERTISINGPLANEDIT","Publicidad del plan Editar");

define("_BANNERID","Banner ID");
define("_BANNERIMAGE","Banner Imagen");
define("_BANNERNAME","Banner Nombre");
define("_BANNERURL","Banner URL");
define("_BUYLINKS","Comprar a Enlaces");

define("_CLASS","Clase");
define("_CLIENT","Cliente");
define("_CLICKS","Haga clic en");
define("_CLICKSPERCENT","Haga clic en Por ciento");
define("_CLIENTLOGIN","Conexion del cliente");
define("_CLIENTNAME","Nombre del cliente");
define("_CURREGUSERS","Usuarios registrados actuales:");
define("_CURRENTSTATUS","Estado actual:");
define("_CURRENTPOSITIONS","Posiciones actuales de los anuncios");
define("_COUNTRYNAME","Su nombre de pais");
define("_CLASSNOTE","Si es su clase del anuncio Javascript/HTML Cifrar los 4 campos siguientes sera no hecho caso y contara solamente el area de codigo abajo. Si su clase del anuncio es flash usted debe poner el URL completo de .SWF en la anchura siguiente del campo y del sistema y la altura de la pelicula de destello (el URL del Haga clic en y los campos alternos del texto seran no hechos caso).");
define("_CANTDELETEPOSITION","<strong>Error:</strong> Usted no puede suprimir toda las posiciones. Por lo menos uno debe estar en la base de datos.<br />Corregir la posicion si usted necesita cambiarla o agregar un nuevo.");

define("_DAYS","Dias");
define("_DELIVERY","Modo de la entrega");
define("_DESCRIPTION","Descripcion");
define("_DELIVERYQUANTITY","Cantidad de la entrega");
define("_DELIVERYTYPE","Modo de la entrega");
define("_DELETEPOSITION","Posicion de los anuncios de Eliminar");
define("_DELETEALLADS","Suprimir todas las banderas");
define("_DELETEPLAN","Plan de los anuncios de Eliminar");

define("_EMAILSTATS","Email Estadisticas");
define("_ENTER","Entrar");
define("_EDITTERMS","Terminos de Editar del servicio");
define("_EDITPOSITION","Editar que hace publicidad de la posicion");

define("_FLASHMOVIE","Flash Pelicula");
define("_FOLLOWINGSTATS","Los siguientes son la Estadisticas completa para su inversion publicitaria en");
define("_FUNCTIONS","Funciones");
define("_FUNCTIONNOTALLOWED","<strong>Error:</strong> La funcion seleccionada no se permite.");
define("_FLASHFILEURL","Flash Archivo URL");
define("_FLASHSIZE","Flash Tama&ntilde;o de la pelicula");

define("_GENERATEDON","Divulgar generado en");
define("_GENERALSTATS","Estadisticas generales");
define("_GOOGLERANK","Fila de la pagina de este Google del sitio:");

define("_HEREARENUMBERS","Aqui estan algunos numeros sobre nuestro sitio que usted puede ser que encuentre interesante antes de proceder comprar su publicidad:");
define("_HEIGHT","Altura");

define("_IMPPURCHASED","Impresiones compradas");
define("_IMPREMADE","Impresiones hechas");
define("_IMPRELEFT","Impresiones dejadas");
define("_IMPMADE","Imp. Hecho");
define("_IMPRESSIONS","Impresiones");
define("_IMPTOTAL","Imp. Total");
define("_IMPLEFT","Imp. Izquierdo");
define("_INACTIVE","Inactivo");
define("_INACTIVEADS","Banderas inactivas actuales para");
define("_INITIALSTATUS","Estado inicial");
define("_IMAGESWFURL","Imagen URL");
define("_IMAGESIZE","Tama&ntilde;o de la imagen");
define("_INPIXELS","(Tama&ntilde;o en pixeles)");

define("_LISTPLANS","La lista siguiente demuestra nuestros planes publicitarios, precios y un enlace directo para comprar sus anuncios:");
define("_LOGININCORRECT","Conexion incorrecta!!!");

define("_MAINPAGE","Pagina principal");
define("_MONTHS","Meses");
define("_MYADS","Mis anuncios");
define("_MOVEADS","Mover los anuncios a");
define("_MOVEDADSSTATUS","Nuevo estado de anuncios movidos");

define("_NAME","Nombre");
define("_NOCONTENT","No hay contenido aqui en este tiempo...");
define("_NOCHANGES","Ningunos cambios");

define("_PLANNAME","Nombre del plan");
define("_PLANSPRICES","Planes y precios");
define("_PRICE","Precio");
define("_POSITIONNAME","Colocar el nombre");
define("_POSITIONNUMBER","Numero de posicion");
define("_PLANDESCRIPTION","Descripcion del plan");
define("_PLANBUYLINKS","Comprar a Enlaces");
define("_POSEXAMPLE","Usted puede tener una mirada en el archivo <em>/blocks/block-Advertising.php</em> y archivo <em>/header.php</em> para tener un ejemplo claro en como ejecutar esto en su sitio.");
define("_POSITIONNOTE","Para utilizar la posicion usted debe incluir el codigo: <em> ads(position);</em> in your theme file, where \"position\" es el numero de la posicion que usted quiere utilizar en ese espacio del anuncio.");
define("_PLANSNOTE","Los planes estan para la referencia solamente y seran publicados en el modulo publicitario asi que sus clientes saben lo que usted tiene que ofrecer, las condiciones, los precios y un vinculo para pagar su servicio.");
define("_POSINFOINCOMPLETE","<strong>Error:</strong> La publicidad del campo conocido de la posicion no puede ser vacia.");
define("_POSITIONHASADS","La posicion de los anuncios que usted selecciono para suprimir tiene banderas asignadas a ella.<br />Seleccionar por favor una nueva posicion para mover todos los anuncios.");
define("_PDAYS","Dias");
define("_PMONTHS","Meses");
define("_PYEARS","A&ntilde;os");

define("_QUANTITY","Cantidad");

define("_RECEIVEDCLICKS","Haga clic en recibidos");

define("_SITESTATS","Estadisticas del sitio");
define("_STATSNOTSEND","Las estadisticas para la bandera seleccionada no se pueden enviar porque<br />no hay un email asociado a el.<br />Entrar en contacto con por favor a administrador");
define("_STATSSENT","Las estadisticas para su bandera del anuncio han sido enviadas por el email en:");
define("_SITENAMEADS","(Para encajar su nombre del sitio en el uso del texto [sitename] y para utilizar su tipo del nombre de pais [country] en el texto y el sera substituido de hacer publicidad el modulo)");
define("_SAVEPOSITION","Guardar los cambios");
define("_SURETODELPOSITION","Usted esta a punto de suprimir una posicion de los anuncios. Es usted que usted quiere seguro proceder?");
define("_SURETODELPLAN","Su es alrededor suprimir un plan publicitario. Es usted que usted quiere sure proceder?");

define("_TERMS","Terminos");
define("_TERMSCONDITIONS","Condiciones");
define("_TOTALVIEWS","Opiniones totales de las paginas hasta ahora:");
define("_TYPE","Tipo");
define("_TERMSOFSERVICEBODY","Terminos del cuerpo del servicio");
define("_TERMSNOTE","Revision de Cuidado los terminos del defecto. Cambiar lo que usted quiere para cambiar acordar con su politica publicitaria. Esto sera publicada en el modulo publicitario.");

define("_VIEWSYEAR","Opiniones medias de las paginas por a&ntilde;o:");
define("_VIEWSMONTH","Opiniones medias de las paginas por mes:");
define("_VIEWSDAY","Opiniones medias de las paginas por dia:");
define("_VIEWSHOUR","Opiniones medias de las paginas por hora:");
define("_VIEWBANNER","Ver Banner");

define("_WELCOMEADS","<strong>Bienvenido a nuestra seccion publicitaria!</strong><br /><br />Si usted quiere su anuncio de la bandera aqui en nuestro sitio web, usted puede querer saber algunos detalles porque usted debe saber lo que pueden ofrecer los planes un poco de la blanco y de los anuncios nosotros.<br /><br />Si usted es ya nuestro cliente publicitario, abrirse una sesion por favor <strong><a href=\"modules.php?name=Advertising&amp;op=client\">aqui</a></strong>.<br />");
define("_WIDTH","Anchura");

define("_XFORUNLIMITED","escribir X para ilimitado");

define("_YEARS","A&ntilde;os");
define("_YOURBANNER","Su bandera");
define("_YOURSTATS","Sus estadisticas de la bandera en");

?>