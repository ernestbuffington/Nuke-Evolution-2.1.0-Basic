<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
 
/***************************************************************************
 *                          lang_faq.php [Espa&ntilde;ol]
 *                            -------------------
 *   begin                : Wednesday Oct 3, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: lang_faq.php,v 1.4.2.3 2002/12/18 15:40:20 psotfx Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/* CONTRIBUTORS:
	2002-12-15	Philip M. White (pwhite@mailhaven.com)
		Fixed many minor grammatical problems.
*/

//
// To add an entry to your FAQ simply add a line to this file in this format:
// $faq[] = array("question", "answer");
// If you want to separate a section enter $faq[] = array("--","Block heading goes here if wanted");
// Links will be created automatically
//
// DO NOT forget the ; at the end of the line.
// Do NOT put double quotes (") in your FAQ entries, if you absolutely must then escape them ie. \"something\"
//
// The FAQ items will appear on the FAQ page in the same order they are listed in this file
//
$faq[] = array("--","Preguntas sobre la Conexi&oacute;n (logeo) y el Registro");
$faq[] = array("&iquest;Por qu&eacute; no puedo conectarme?", "&iquest;Ya se registr&oacute;? Debe registrarse en el sistema antes de poder acceder a &eacute;l. &iquest;Ha sido bloquedado en el foro? (aparecer&aacute; un mensaje si has sido bloqueado). Si esto sucede env&iacute;e un mensaje al Administrador del Foro para averiguar la causa. Si se ha registrado y no ha sido bloquedado verifique que su nombre de usuario y contrase&ntilde;a coincidan, es el problema mas com&uacute;n. Si est&aacute; seguro de que est&aacute;n correctos los datos, env&iacute;e un mensaje al administrador, es posible que el Foro est&eacute; mal configurado y/o tenga fallos en la programaci&oacute;n.");
$faq[] = array("&iquest;Por qu&eacute; me tengo que registrar para todo?", "No est&aacute; obligado a hacerlo, la decisi&oacute;n la toman los Administradores y los Moderadores. Sin embargo, estar registrado le da muchas ventajas que como usuario invitado no difrutar&iacute;a, como tener su gr&aacute;fico personalizado (avatar), mensajes privados, suscripcion a grupos de usuarios, etc.... S&oacute;lo le tomar&aacute; unos segundos, es muy recomendable.");
$faq[] = array("&iquest;Por qu&eacute; mi sesi&oacute;n de usuario expira autom&aacute;ticamente?", "Si no activa la casilla <i>Ingresar autom&aacute;ticamente</i> cuando ingresa al foro, sus datos se guardan en una cookie que se elimina al salir de la p&aacute;gina o en cierto tiempo. Esto previene que su cuenta pueda ser usada por alguien m&aacute;s. Para que el sistema le reconozca autom&aacute;ticamente s&oacute;lo active la casilla al ingresar. NO es recomendable si accede al foro desde una computadora compartida (caf&eacute;-internet, biblioteca, colegio ...)");
$faq[] = array("&iquest;C&oacute;mo evito aparecer en las listas de usuarios conectados?", "En su perfil, encontrar&aacute; la opci&oacute;n <i>Ocultar mi estado de conexi&oacute;n</i>. Si activa esta opci&oacute;n, s&oacute;lo aparecer&aacute; para los Administradores, Moderadores y para si mismo; para los demas aparecer&aacute; como un usuario oculto.");
$faq[] = array("&iexcl;He perdido mi contrase&ntilde;a!", "Calma, si su contrase&ntilde;a no puede ser recuperada puede desactivarla o cambiarla. Para hacer esto dir&iacute;jase a la p&aacute;gina de registro y haga click en <u>Olvid&eacute; mi contrase&ntilde;a</u>, siga las instrucciones y estar&aacute; conectado en muy poco tiempo");
$faq[] = array("&iexcl;Me he registrado y no puedo ingresar!", "Primero, verifique sus datos (usuario y contrase&ntilde;a). Si todo es correcto hay dos posibles razones. Si el Sistema de Protecci&oacute;n Infantil (COPPA) est&aacute; activado y cuando se registr&oacute; eligi&oacute; la opci&oacute;n <u>Soy menor de 13 a&ntilde;os</u> entonces tendr&aacute; que seguir algunas instrucciones que se te dar&aacute;n para activar la cuenta. En otros casos, el Administrador pide que las cuentas se activen mediante un correo electr&oacute;nico, as&iacute; que revise su correo y confirme su suscripci&oacute;n. Algunos Foros necesitan confirmaci&oacute;n del registro. Si no sucede nada de esto contacte al administrador del foro.");
$faq[] = array("Hace un tiempo me registr&eacute;, pero ahora no puedo conectarme", "Las posibles razones son: ingres&oacute; un nombre de usuario o contrase&ntilde;a incorrectos (verifique el mensaje que se le env&iacute;a al registrarse). Es posible que el administrador haya borrado su cuenta, esto es muy frecuente, pues si no ha escrito ningun mensaje en cierto tiempo el administrador puede borrar el usuario para que la base de datos no se sature de registros. Si ha sido as&iacute;, reg&iacute;strese de nuevo y participe :)");
$faq[] = array("--","Preferencias de Miembro y Configuraciones");
$faq[] = array("&iquest;C&oacute;mo puedo cambiar mi configuraci&oacute;n?", "Todos sus datos y configuraciones (si est&aacute;s registrado) est&aacute;n archivados en nuestra base de datos. Para modificarlos haz click en el link <u>Perfil</u>, generalmente se encuentra arriba de cada p&aacute;gina.");
$faq[] = array("&iexcl;El tiempo en los foros no es correcto!", "Las horas son corectas, es posible que est&eacute;s viendo las horas correspondientes a otra zona horaria. Si este es el caso, ingresa a tu perfil y define tu zona horaria de acuerdo a tu ubicaci&oacute;n (ej. Londres, Paris, New York, Sydney, etc.) Cambiando esto, las horas deben de aparecer de acuerdo a tu zona y a tu tiempo. Si no te has registrado es tiempo de hacerlo :)");
$faq[] = array("He cambiado la zona horaria en mi perfil, pero el tiempo sigue siendo incorrecto", "Si est&aacute;s seguro(a) en que la Zona Horaria es correcta, es posible que se deba a los horarios de verano implementados por algunos pa&iacute;ses.");
$faq[] = array("Mi idioma no est&aacute; en la lista!", "Esto se puede deber a que el administrador no ha instalado el paquete de tu idioma para el foro o nadie ha creado una traducci&oacute;n :( . Si es as&iacute;, si&eacute;ntete libre de hacer una traducci&oacute;n (miles de personas te lo agradecer&aacute;n), la informaci&oacute;n la encuentras en el sitio Web del <i>phpBB Group</i> (Haz click en el enlace que se encuentra al pie de la p&aacute;gina)");
$faq[] = array("C&oacute;mo puedo poner una imagen debajo de mi Nombre de Miembro?", "Hay dos tipos de im&aacute;genes debajo de tu Nombre de Miembro. La primera es el RANGO y est&aacute; asociada con el n&uacute;mero de mensajes que has escrito en el Foro (generalmente son estrellas o bloques): La segunda es el AVATAR y es, generalmente, un gr&aacute;fico &uacute;nico y personal, el Administrador decide si se pueden usar o no; si es posible usarlos, puedes configurarlo en tu perfil. En caso de que no exista esa opci&oacute;n, contacta al Administrador y pide que esa opci&oacute;n sea activada :)");
$faq[] = array("&iquest;Como puedo cambiar mi RANGO?", "No puedes cambiar tu RANGO directamente, porque est&aacute; directamente asociado con el n&uacute;mero de mensajes enviados o tu estado de Moderador, Administrador o RANGOS especiales. Por favor, no abuses de enviar mensajes innecesariamente para incrementar tu RANGO.");
$faq[] = array("Cuando hago click sobre el enlace del E-mail de un Miembro me pide que me registre", "Para poder enviar un correo electr&oacute;nico a un Miembro v&iacute;a formulario (si el Administrador lo tiene activado) necesitas estar registrado. Esto es para evitar SPAM o mensajes maliciosos de Usuarios An&oacute;nimos.");
$faq[] = array("--","Publicaci&oacute;n de Mensajes");
$faq[] = array("&iquest;C&oacute;mo puedo publicar un mensaje en el Foro?", "F&aacute;cil, reg&iacute;strate como Miembro del Foro (haciendo click en el enlace para registrarse, generalmente arriba de cada p&aacute;gina). Despu&eacute;s de registrarte, haz click en <i>Enviar Nuevo Mensaje<i>, ah&iacute; se te presentar&aacute; un panel con el que f&aacute;cilmente publicar&aacute;s un mensaje :)");
$faq[] = array("&iquest;C&oacute;mo puedo editar o borrar un mensaje?", "Si no eres el Administrador o el Moderador del Foro, s&oacute;lo puedes borrar los mensajes que hayas enviado t&uacute; mismo. Puedes editar un mensaje haciendo click en <i>Editar</i>. Si alguien ya ha respondido a tu mensaje, encontrar&aacute;s un peque&ntilde;o texto en tu mensaje diciendo que ha sido modificado y el n&uacute;mero de veces que lo has hecho. No aparece si fue un Moderador o el Administrador el que lo edit&oacute; (la mayor&iacute;a de las veces escriben un mensaje aclaratorio).");
$faq[] = array("&iquest;C&oacute;mo puedo agregar una firma a mi mensaje?", "Para insertar una firma en tu mensaje primero debes crear una, esto se hace modificando tu perfil. Una vez creada, activas la opci&oacute;n <i>Agregar firma</i> cuando env&iacute;es un mensaje. Tambi&eacute;n puedes hacer que todos tus mensajes tengan tu firma, activando la opci&oacute;n en tu perfil.");
$faq[] = array("&iquest;C&oacute;mo creo una encuesta?", "Crear una encuesta es f&aacute;cil, cuando inicias un nuevo tema notar&aacute;s la opci&oacute;n <i>Crear una encuesta</i>, introduces los datos de la encuesta, como T&iacute;tulo y Opciones. Tienes la posibilidad de poner l&iacute;mite al n&uacute;mero de participantes (0 es infinito)");
$faq[] = array("&iquest;C&oacute;mo edito o borro una encuesta?", "Si eres el que inici&oacute; la encuesta puedes editarla de la misma manera que tu mensaje. Sin embargo, esto s&oacute;lo funcionar&aacute; si la encuesta a&uacute;n no tiene respuestas; de tenerlas s&oacute;lo el Administrador o los Moderadores podr&aacute;n editarla o borrarla");
$faq[] = array("&iquest;Por qu&eacute; no puedo acceder a alg&uacute;n foro?", "Algunos foros est&aacute;n limitados a ciertos grupos de usuarios, para verlos, enviar mensajes, editar, etc, necesitas tener ciertas autorizaciones, las cuelas s&oacute;lo te puede dar un Moderador o un Administrador del foro.");
$faq[] = array("&iquest;Por qu&eacute; no puedo votar en las encuestas?", "S&oacute;lo los Miembros Registrados pueden votar en las encuestas (para prevenir resultados trucados), si te has registrado pero no puedes votar, es posible que no tengas autorizaci&oacute;n para votar en esa encuesta :(.");
$faq[] = array("--","Formatos de los Mensajes y Tipos de temas");
$faq[] = array("&iquest;Qu&eacute; es el c&oacute;digo BBCode?", "El C&oacute;dgo BBCode es una implementaci&oacute;n especial del HTML, la forma en la que el BBCode se usa es determinada por el Administrador. Es muy similar al HTML, las etiquetas van entre corchetes [ y ] para mas informaci&oacute;n puedes ver el Manual de BBCode, el enlace aparece cada vez que vas a publicar un mensaje.");
$faq[] = array("&iquest;Puedo usar HTML?", "Depende de que el Administrador tenga habilitada la opci&oacute;n y de cu&aacute;les etiquetas HTML est&eacute;n activadas, ya que muchas etiquetas HTML podr&iacute;an da&ntilde;ar severamente la estructura del mensaje.");
$faq[] = array("&iquest;Qu&eacute; son los Emoticons?", "Los Emoticons son peque&ntilde;os gr&aacute;ficos que pueden ser usados para expresar emociones. Aparecen introduciendo un peque&ntilde;o c&oacute;digo, por ejemplo:  :) significa feliz, :( significa triste. La lista completa de Emoticons se despliega cuando env&iacute;as un mensaje.");
$faq[] = array("&iquest;Puedo enviar mensajes con im&aacute;genes?", "Las imagenes pueden ser adheridas al mensaje, insert&aacute;ndolas al momento de redactarlo. No puede haber im&aacute;genes de sitios de correo, b&uacute;squeda o cualquier autentificaci&oacute;n (Yahoo, Hotmail...).");
$faq[] = array("&iquest;Qu&eacute; son los Anuncios?", "Los anuncios contienen informaci&oacute;n importante para los usuarios.");
$faq[] = array("&iquest;Qu&eacute; son los Temas Importantes?", "Los Temas Importantes aparecen debajo de los anuncios y s&oacute;lo en la primera p&aacute;gina, es informaci&oacute;n muy importante que deber&iacute;as leer :)");
$faq[] = array("&iquest;Qu&eacute; son los Temas Cerrados o Bloquedados?", "Los Temas Cerrados o Bloqueados son precisamente eso, temas en los que ya no se puede escribir mensajes. Esto lo decide el Administrador o los Moderadores.");
$faq[] = array("--","Niveles de Usuario y Grupos");
$faq[] = array("&iquest;Qu&eacute; son los Administradores?", "Los Administradores son personas asignadas con alto nivel de control sobre el Foro entero, pueden controlar permisos, moderadores y todo tipo de configuraciones.");
$faq[] = array("&iquest;Qu&eacute; son los Moderadores?", "Los Moderadores son personas que tienen el poder de editar o borrar foros, cerrarlos o abrirlos. Son designados por el Administrador y tienen menos opciones que este.");
$faq[] = array("&iquest;Qu&eacute; son los Grupos de Miembros?", "Los Grupos de Miembros son una de las formas en las que el Administrador del Foro puede agrupar Miembros. Un Miembro puede pertenecer a varios grupos. Esto se hace con el fin de conceder permisos selectivos sobre el Foro (como convertir a todo un grupo en Moderadores).");
$faq[] = array("&iquest;C&oacute;mo puedo pertenecer a un Grupo de Miembros?", "Da click en Grupos de Miembros y pide tu inscripci&oacute;n. Si eres aceptado recibir&aacute;s un correo electr&oacute;nico. No todos los Grupos son abiertos.");
$faq[] = array("&iquest;C&oacute;mo me convierto en el Moderador de un Grupo de Miembros?", "Solamente el Administrador puede asignar este permiso, contacta con &eacute;l :)");

$faq[] = array("--","Ver Tema en Versi&oacute;n Imprimible");
$faq[] = array("&iquest;Para qu&eacute; sirve el bot&oacute;n :| |: ? - Cancelando la paginaci&oacute;n de los cuadros", "Haciendo click en este bot&oacute;n puedes remover localmente la paginaci&oacute;n fija de los cuadros para el tema actual para ayudar a que tu navegador web realice una paginaci&oacute;n apropiada para imprimir bas&aacute;ndose en un espaciamiento lineal actual, m&aacute;s que por el l&iacute;mite de ancho del Foro con n&uacute;mero de mensajes por p&aacute;gina.");
$faq[] = array("&iquest;Para qu&eacute; son los cuadros en la parte superior de la Versi&oacute;n Imprimible? - Selecci&oacute;n de Rango", "Hay dos cuadros en la parte superior de la p&aacute;gina y un bot&oacute;n de Mostrar. Ellos permiten seleccionar un rango de mensajes. F&iacute;jese que cada mensaje en la versi&oacute;n imprimible tiene un n&uacute;mero. Usa esos n&uacute;meros para llenar los cuadros en la parte superior para configurar el primer y &uacute;ltimo mensaje que deseas imprimir, y presiona el bot&oacute;n Mostrar para reordenar los mensajes. Otra forma es para configurar un rango es poner un n&uacute;mero negativo en el segundo cuadro, este significa que quieres imprimir -n mensajes. Por ejemplo, 4 7 mostrar&aacute;n los mensajes 4, 5, 6, 7. Sin embargo, si ingresas los valores 4 -7 en primer y segundo lugar respectivamente, se mostrar&aacute;n los mensajes 4, 5, 6, 7, 8, 9, 10 despu&eacute;s de presionar el bot&oacute;n <i>Rewind</i>.");
$faq[] = array("&iquest;C&oacute;mo imprimir solamente un mensaje? - Selecci&oacute;n avanzada", "Primero, ve a la vista imprimible del tema presionando el Bot&oacute;n Imprimir en la vista del Tema. Encuentra el mensaje y f&iacute;jate en el n&uacute;mero a su izquierda. Tipea el n&uacute;mero en el primer cuadro localizado en la parte superior izquierda de la vista imprimible. En el segundo cuadro pon como valor -1 y presiona el bot&oacute;n Mostrar. Esto le indicar&aacute; a la base de datos para que muestre s&oacute;lo un mensaje. Otra forma de conseguir lo mismo es poniendo el mismo n&uacute;mero en ambos cuadros. Digamos que s&oacute;lo deseas imprimir el mensaje n&uacute;mero 16. Ingresa en los cuadros en la parte superior: 16 -1 y presiona el bot&oacute;n Mostrar. En vez de 16 y -1 puedes ingresar 16 y 16. El resultado ser&aacute; el mismo. Por supuesto que este ejemplo s&oacute;lo funcionar&aacute; si hay al menos 16 mensajes en el Tema.");
$faq[] = array("&iquest;M&aacute;s preguntas?", "Una documentaci&oacute;n detallada y Foros de Soporte est&aacute;n <a href=\"http://wiking.sourceforge.net/phpBB2/wakka.php?wakka=PrinterFriendlyTopicView\">AQU&iacute;</a>");

$faq[] = array("--","Mensajer&iacute;a Privada");
$faq[] = array("&iexcl;No puedo enviar mensajes privados!", "Hay tres posibles razones: no est&aacute;s registrado o no te has conectado; el Administrador deshabilit&oacute; el Ssistema de Mensajes Privados o el Administrador ha desabilitado la mensajer&iacute;a para t&iacute;.");
$faq[] = array("Quiero evitar los Mensajes Privados no deseados!", "En un futuro ser&aacute; agregada la caracter&iacute;stica de ignorar mensajes, por ahora s&oacute;lo env&iacute;a un mensaje al Administrador si recibes mensajes no deseados :(.");
$faq[] = array("He recibido SPAM o correos maliciosos de alguien en este Foro!", "Lo sentimos mucho, la caracter&iacute;stica de mandar correos eletr&oacute;nicos tiene amplios conceptos de seguridad y privacidad. Env&iacute;a el correo al Administrador, tal como ven&iacute;a, incluyendo encabezados y dem&aacute;s. &eacute;l tomar&aacute; acciones.");

//
// These entries should remain in all languages and for all modifications
//
$faq[] = array("--","Acerca de phpBB2");
$faq[] = array("&iquest;Quien program&oacute; este Foro??", "Esta aplicaci&oacute;n (en su forma original) es producida, liberada y con derechos de autor pertenecientes al <a href=\"http://www.phpbb.com/\" target=\"_blank\">phpBB Group</a>. Est&aacute; hecho bajo la GNU (Licencia P&uacute;blica General) y es de libre distribuci&oacute;n (haz click en el enlace para conocer m&aacute;s detalles)");
$faq[] = array("&iquest;Por qu&eacute; este Foro no tiene X cosa?", "Este foro fue escrito y licenciado a trav&eacute;s de phpBB Group. Si cree que deber&iacute;a tener alguna otra opci&oacute;n o caracter&iacute;stica visite phpbb.com y mire lo que el phpBB Group tiene que decir. Por favor, no publique mensajes de ese tipo en los foros de phpBB.com, los miembros de Sourceforge est&aacute;n llenos de ideas y en constante innovaci&oacute;n para agregarle mejoras a este foro.");
$faq[] = array("&iquest;A qui&eacute;n puedo contactar acerca de abusos o usos ilegales relacionados con este foro?", "Puede contactar al Administrador del Foro. Si no encuentra la forma de contactarlo, intente contactar a cualquiera de los Moderadores. Si a&uacute;n no consigue una respuesta, deber&aacute;s contactar al propietario del dominio (haz una b&uacute;squeda <i>whois</i> del dominio) o si est&aacute; en un servicio gratuito (ej. yahoo, free.fr, f2s.com, etc.) al Administrador o al Departamento de Abusos del Servicio. Por favor, note que el phpBB Group no tiene ning&uacute;n control y de ninguna manera puede ser obligado a conocer c&oacute;mo, d&oacute;nde y qui&eacute;nes usan este Foro. Es absolutamente innecesario contactar al phpBB Group en relaci&oacute;n a cualquier problema legal (cese y renuncia, comentario difamatorio, obligado, etc.) no relacionado directamente al sitio Web phpbb.com o al software de phpBB. Si le escribes un correo electr&oacute;nico al phpBB Group sobre el uso de este software por parte de terceros no debes esperar una respuesta concisa o en general ninguna respuesta.");

//
// This ends the FAQ entries
//

?>