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

// Error Manager v2.1
$lang_new[$module_name]['EM203'] = 'Error 203: La informacion que figura en el encabezado de la entidad no esta en el sitio original, pero a partir de tercero de servidor';
$lang_new[$module_name]['EM204'] = 'Error 204: Hacer clic en un enlace sin un objetivo. Es una \ advertencia !!';
$lang_new[$module_name]['EM205'] = 'Error 205: Usted envio una cabecera que no permiten.';
$lang_new[$module_name]['EM300'] = 'Error 300: La direccion solicitada no puede ser identificado como unica.';
$lang_new[$module_name]['EM301'] = 'Error 301: La direccion solicitada se traslada permanentemente.';
$lang_new[$module_name]['EM302'] = 'Error 302: La direccion solicitada se ha trasladado temporalmente.';
$lang_new[$module_name]['EM303'] = 'Error 303: La direccion solicitada se mueve en cualquier lugar - pero no seguir';
$lang_new[$module_name]['EM304'] = 'Error 304: No permitimos que pide tiempo para la modificacion de una direccion en nuestro servidor';
$lang_new[$module_name]['EM400'] = 'Error 400: Solicitud incorrecta - hay un error de sintaxis en la peticion, y se nego';
$lang_new[$module_name]['EM401'] = 'Error 401: La solicitud no contiene encabezado de la autenticacion de los codigos necesarios. Acceso denegado';
$lang_new[$module_name]['EM402'] = 'Error 402: Para acceder a este archivo, el pago se requiere';
$lang_new[$module_name]['EM403'] = 'Error 403: No podemos satisfacer su solicitud. Por favor, intente mas tarde.';
$lang_new[$module_name]['EM404'] = 'Error 404: La direccion solicitada no se encuentra en este servidor. Tal vez usted tiene mal la URL ?';
$lang_new[$module_name]['EM405'] = 'Error 405: El metodo que utiliza para acceder al archivo no esta permitido';
$lang_new[$module_name]['EM406'] = 'Error 406: Su cliente no esta configurado para recibir la direccion solicitada';
$lang_new[$module_name]['EM407'] = 'Error 407: Su solicitud debe ser autorizada antes de que pueda llevarse a cabo';
$lang_new[$module_name]['EM408'] = 'Error 408: Solicitud de tiempo - Por favor, intente mas tarde';
$lang_new[$module_name]['EM409'] = 'Error 409: Demasiadas solicitudes concurrentes - Por favor, intente mas tarde';
$lang_new[$module_name]['EM410'] = 'Error 410: La direccion solicitada no esta disponible.';
$lang_new[$module_name]['EM411'] = 'Error 411: Su solicitud esta encabezado algunas informaciones';
$lang_new[$module_name]['EM412'] = 'Error 412: Su cliente no esta configurado para recibir la informacion solicitada.';
$lang_new[$module_name]['EM413'] = 'Error 413: El archivo solicitado es demasiado grande para el proceso';
$lang_new[$module_name]['EM414'] = 'Error 414: La direccion solicitada no es \ en el formato adecuado para este servidor.';
$lang_new[$module_name]['EM415'] = 'Error 415: El archivo de la solicitud no se admite.';
$lang_new[$module_name]['EM500'] = 'Error 500: Error interno del servidor - por favor intente mas tarde';
$lang_new[$module_name]['EM501'] = 'Error 501: La solicitud no puede ser llevada a cabo por el servidor';
$lang_new[$module_name]['EM502'] = 'Error 502: Puerta de enlace incorrecta  - en servidor \esta intentando alcanzar esta enviando espera errores.';
$lang_new[$module_name]['EM503'] = 'Error 503: Temporalmente no disponible.';
$lang_new[$module_name]['EM504'] = 'Error 504: La puerta ha caducado.';
$lang_new[$module_name]['EM505'] = 'Error 505: El protocolo HTTP que estan pidiendo no es compatible.';
$lang_new[$module_name]['EMUNKNOWN'] = 'Se produjo un error que no hemos podido\ reconocer';
$lang_new[$module_name]['EMHOME'] = 'Volver a la pagina principal';
$lang_new[$module_name]['EMSORRY'] = 'Pedimos disculpas por cualquier problema';
$lang_new[$module_name]['EMRECDATA'] = '<strong>NOTA:</strong> hemos registrado los siguientes datos para realizar el seguimiento del problema.';
$lang_new[$module_name]['EMDATETIME'] = 'Fecha / Hora';
$lang_new[$module_name]['EMSORT'] = 'Tipo de error';
$lang_new[$module_name]['EMREF'] = 'Referencia';
$lang_new[$module_name]['EMIP'] = 'IP Direccion';
$lang_new[$module_name]['EMURL'] = 'Error URL';
// Error Manager v2.1 Admin:
$lang_new[$module_name]['EMATITLE'] = 'Error';
$lang_new[$module_name]['EMABACKMAIN'] = 'Volver a la Administracion principal';
$lang_new[$module_name]['EMALIST'] = 'Los siguientes errores encuentran el lugar en su sitio';
$lang_new[$module_name]['EMADELALL'] = 'Borrar Todos';
$lang_new[$module_name]['EMADEL'] = 'Eliminar errores';
$lang_new[$module_name]['EMADELETED'] = 'El error se elimina de la base de datos';
$lang_new[$module_name]['EMABACK'] = 'Volver a la administracion de la gestion de error';
$lang_new[$module_name]['EMADELETEDALL'] = 'Todos los errores se eliminan de la base de datos';
$lang_new[$module_name]['EMCONFIG'] = 'Configuracion';
$lang_new[$module_name]['EMSHOWERRORS'] = 'Mostrar los errores';
$lang_new[$module_name]['EALOGERRORS'] = 'Registro de los errores en la base de datos?';
$lang_new[$module_name]['EASHOWIMAGE'] = 'Mostrar imagen?';
$lang_new[$module_name]['EASHOWMODULBLOCKS'] = 'Mostrar bloques??';
$lang_new[$module_name]['EASHOWINFOSAVED'] = 'Decir al visitante que se registra la informacion?<br />(solo util si \ Errores en el registro DB\ esta activada)';
$lang_new[$module_name]['TOTALERRORS'] = 'Numero total de errores en que sitio del nuke';
$lang_new[$module_name]['RESETCOUNTER'] = '(Restablecer contador)';
$lang_new[$module_name]['EMADATETIME'] = 'Fecha / Hora';
$lang_new[$module_name]['EMASORT'] = 'Tipo de error';
$lang_new[$module_name]['EMAREF'] = 'Referencia';
$lang_new[$module_name]['EMAIP'] = 'IP Direcion';
$lang_new[$module_name]['EMAURL'] = 'Error URL';
$lang_new[$module_name]['SAVECHANGES'] = 'Guardar cambios';

?>