<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   BASIC
 Nuke-Evo Version       :   2.1.0RC2
 Nuke-Evo Build         :   2352
 Nuke-Evo Patch         :   ---
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   03-Feb-2009

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
$lang_new[$module_name]['ADMIN_HEADER'] = 'Nuke-Evolution Enlaces Web :: Panel de administracion de modulos';
$lang_new[$module_name]['ADMIN_GO_MAIN'] = 'Volver a la Administracion principal';
$lang_new[$module_name]['ADMIN_WEBLINKSADMIN'] = 'Administracion de vinculos Web';
$lang_new[$module_name]['ADMIN_WEBLINKS_STATUS'] = 'Estado de vinculos Web';
$lang_new[$module_name]['ADMIN_ADD_CAT'] = 'Agregar una categoria';
$lang_new[$module_name]['ADMIN_ADD_SUBCAT'] = 'Agregar una subcategoria';
$lang_new[$module_name]['ADMIN_ADD_LINK'] = 'Agregar un vinculo ';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY'] = 'Probar Categorias';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY_INCLSUB'] = 'Incluye subcategorias';
$lang_new[$module_name]['ADMIN_LINK_VALIDATE'] = 'Validar vinculos';
$lang_new[$module_name]['ADMIN_CAT_VALIDATE'] = 'Validar la categoria';
$lang_new[$module_name]['ADMIN_CATSUB_VALIDATE'] = 'Validar la SubCategoria';
$lang_new[$module_name]['ADMIN_CAT_ATTACHED'] = 'adjunta a esta categoria';
$lang_new[$module_name]['ADMIN_VALIDATE_FAILED'] = 'Error de validacion';
$lang_new[$module_name]['ADMIN_LINK_VALIDATE_WAIT'] = 'Espera ..';
$lang_new[$module_name]['ADMIN_VALIDATE_OPTIONS'] = 'Opciones';
$lang_new[$module_name]['ADMIN_LINK_CHECK'] = 'Comprobar vinculos';
$lang_new[$module_name]['ADMIN_LINK_CHECK_ALL'] = 'Comprobar todos los vinculos';
$lang_new[$module_name]['ADMIN_LINK_PROPOSED'] = 'Vinculo propuesta';
$lang_new[$module_name]['ADMIN_LINK_ORIGINAL'] = 'Vinculo original';
$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'] = 'Vista previa Imagen';
$lang_new[$module_name]['ADMIN_MODIFY_LINK'] = 'Modificar vinculos';
$lang_new[$module_name]['ADMIN_MODIFY_CAT'] = 'Modificar categoria';
$lang_new[$module_name]['ADMIN_BROKEN_LINK'] = 'Administrar vinculos rotos';
$lang_new[$module_name]['ADMIN_MODIFY_LINK_REQUEST'] ='Administrar solicitudes de vinculo';
$lang_new[$module_name]['ADMIN_TRANSFER_CAT'] = 'Transferir la categoria';
$lang_new[$module_name]['ADMIN_EDITORIAL_ADD'] = 'Agregar editorial';
$lang_new[$module_name]['ADMIN_EDITORIAL_MODIFY'] = 'Modificar editorial';
$lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] = 'Eliminar los comentarios';
$lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] = 'Configuracion del modulo';
$lang_new[$module_name]['ADMIN_LINK_VOTE_REGUSER'] = 'Votos de usuario registrado';
$lang_new[$module_name]['ADMIN_LINK_VOTE_UNREG'] = 'Votos de usuario no registrado';
$lang_new[$module_name]['ADMIN_LINK_VOTE_GUESTS'] = 'Votos de invitados';
$lang_new[$module_name]['ADMIN_LINK_VOTE_TOTAL'] = 'Total Votos';
$lang_new[$module_name]['ADMIN_LINK_RATING'] = 'Clasificacion';
$lang_new[$module_name]['ADMIN_LINK_RATING_AVERAGE'] = 'Valoracion media de los usuarios';
$lang_new[$module_name]['ADMIN_LINK_RATING_TOTAL'] = 'Total de los usuarios de clasificacion';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BEHAVIOR'] = 'Comportamiento';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BLOCKS'] = 'Configuracion de bloque';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_VOTING'] = 'Configuracion de la votacion';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW'] = 'Deberia aparecer el cuadro de arriba? ';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW_LINKS'] = 'Cuantas entradas deberian aparecer en el parte superior-box?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_HEIGHT'] = 'Altura de la parte superior-caja de pixel';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL'] = 'Esos vinculos se deberian mostrar desplazable?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_AMOUNT'] = 'Cantidad de desplazamiento';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_DIRECTION'] = 'Direccion de desplazamiento';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_TITLE'] = 'Comportamiento de tabla';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR1'] = 'Color de fondo tabla 1';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR2'] = 'Color de fondo tabla 2';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_TITLE'] = 'Comportamiento de la imagen';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_WIDTH'] = 'Tama&ntilde;o de imagen: ancho';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_HEIGHT'] = 'Tama&ntilde;o de imagen: alto';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_USE'] = 'Debemos utilizar un servidor miniatura para mostrar el vinculo-imagenes?';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_URL'] = 'Escriba la direccion URL del miniatura-servidor<br />(Example: http://www.websitethumbnails.net/view.php?url=)';
$lang_new[$module_name]['ADMIN_SETTING_USE_SECURITYCODE'] = 'Utilice el codigo de seguridad ?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_ROWS'] = 'Cuantos vinculos se deberian aparecer en el bloque de vinculos?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL'] = 'Esos vinculos se deberian mostrar desplazable?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_BREAKS_NO'] = 'Cuantos-saltos de linea deben insertarse entre cada enlace?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_HEIGHT'] = 'Altura de Block en pixel';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_SHOW'] = 'Mostrar imagenes';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_WIDTH'] = 'Tama&ntilde;o de imagen: ancho';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_HEIGHT'] = 'Tama&ntilde;o de imagen: alto';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_TITLE'] ='Comportamiento de desplazamiento';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_AMOUNT'] = 'Cantidad de desplazamiento';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_DIRECTION'] = 'Direccion de desplazamiento';

$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TITLE'] = 'Configuracion general';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_LINKS_PER_PAGE'] = 'Numero de sitios web mostrados por pagina';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_POPULAR'] = 'Cuantos hits deberia tener un vinculo Web a popularizado?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_NEWLINKS'] = 'Numero de sitios Web que se muestra en la pagina de nuevo link?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_BESTLINKS'] = 'Numero de sitios Web que se muestra en la pagina mas popular?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_SEARCHLINKS'] = 'Numero de sitios Web que se muestra en la pagina de busqueda (resultados de busqueda)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNLINKS'] = 'Deberia poder presentar nuevos enlaces invitados?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNKNOWN'] = 'Numero de dias invitados debe esperar antes de que pueden votar por un vinculo Web';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNREGS'] = 'Numero de dias no registradas usuarios (ae. Administradores) deben esperar antes de que pueden votar por un vinculo Web';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_ADMINLINKS'] = 'Deberia poder agregar enlaces en sus sitios Web administradores?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_GUEST_TO_REGISTERED'] = 'Porcentaje (xx/100):  El invitado vota en contra de votos de Usuarios registrados';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_UNREG_TO_REGISTERED'] = 'Porcentaje (xx/100):  Los usuarios no registrados (ae. Administradores) votos contra los votos de los usuarios registrados';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_DETAIL'] = 'Cuantos decimales debe mostrarse en detalles de voto?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_MAIN'] = 'Cuantos decimales debe mostrarse en ningun otro lugar?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_PERCENT'] = 'Vinculos de arriba se deberian mostrar como porcentaje<br />(de lo contrario se muestran como #/Enlaces total)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_VOTEMIN'] = 'Cuantos porcentaje o numeros deben lograrse para mostrar un vinculo Web como vinculo Top?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_PERCENT'] = 'Debe mostrar Enlaces popular como porcentaje<br />(de lo contrario se muestran como #/Enlaces total)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_VOTEMIN'] = 'Cuantos porcentaje o numeros deben lograrse para mostrar un vinculo Web como vinculo popular?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_SHOW_FEATURE_BOX'] ='Mostrar encabezado de vinculos Web en la pagina principal?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPVOTE_MIN'] = 'Numero de votos un vinculo Web debe tener para convertirse en un vinculo Top mas votado Web?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWN_MODREQ'] = 'Invitados de bloque de sugerir cambios de vinculo?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNVOTING'] = 'Permitir invitados a votar? <br />(Si no permite, no se permiten tambien fuera de votantes)';

$lang_new[$module_name]['THERE_ARE'] = 'Hay';
$lang_new[$module_name]['WEBLINKS_IN_DB'] = 'Vinculos en nuestra base de datos.';
$lang_new[$module_name]['TOTAL_LINKS'] = 'Total Enlaces';
$lang_new[$module_name]['TOTAL'] = 'Total';
$lang_new[$module_name]['TO'] = 'a';
$lang_new[$module_name]['NAME'] = 'Nombre';
$lang_new[$module_name]['USER'] = 'Usuario';
$lang_new[$module_name]['USER_REGISTERED'] = 'Usuario registrado';
$lang_new[$module_name]['USER_REGISTERED_NOT'] = 'Usuario no registrado';
$lang_new[$module_name]['DESCRIPTION'] = 'Descripcion';
$lang_new[$module_name]['CATEGORY'] = 'Categoria';
$lang_new[$module_name]['CATEGORIES'] = 'Categorias';
$lang_new[$module_name]['CATEGORYSUB'] = 'SubCategoria';
$lang_new[$module_name]['CATEGORIESSUB'] = 'SubCategorias';
$lang_new[$module_name]['EMAIL'] = 'Email';
$lang_new[$module_name]['EDITORIAL'] = 'Editorial';
$lang_new[$module_name]['HITS'] = 'Hits';
$lang_new[$module_name]['SEARCH_RESULTS_HEADER'] = 'Resultados de busqueda para la consulta:';
$lang_new[$module_name]['SEARCH_RESULTS_CATEGORIES'] = 'Se encuentra en categorias';
$lang_new[$module_name]['SEARCH_RESULTS_LINKS'] = 'Se encuentra en vinculos';
$lang_new[$module_name]['SEARCH_RESULTS_NO_MATCH'] = 'Lo sentimos, pero no encontramos un partido a su busqueda en nuestra base de datos';
$lang_new[$module_name]['SEARCH_RESULTS_TRYSEARCH'] = 'Tratar de buscar';
$lang_new[$module_name]['SEARCH_RESULTS_OTHER_ENGINES'] = 'en otros motores de busqueda';
$lang_new[$module_name]['SUBMIT_MODIFY'] = 'Modificar';
$lang_new[$module_name]['SUBMIT_DELETE'] = 'Borrar';
$lang_new[$module_name]['SUBMIT_ADD'] = 'Agregar';
$lang_new[$module_name]['SUBMIT_SAVE'] = 'Guardar';
$lang_new[$module_name]['SUBMIT_DOIT'] = 'Hacerlo';
$lang_new[$module_name]['SUBMIT_ACCEPT'] = 'Aceptar';
$lang_new[$module_name]['SUBMIT_GOBACK'] = _GOBACK;
$lang_new[$module_name]['SUBMIT_RETURN'] = 'Devolver';
$lang_new[$module_name]['SUBMIT_BACK_CATEGORY'] = 'Volver a la categoria';
$lang_new[$module_name]['SUBMIT_VOTE'] = 'Voto !';
$lang_new[$module_name]['SUBMIT_MODIFY_REQUEST'] = 'Enviar solicitud de modificacion';
$lang_new[$module_name]['MODIFY'] = 'Modificar';
$lang_new[$module_name]['AUTHOR'] = 'Autor';
$lang_new[$module_name]['DELETE'] = 'Borrar';
$lang_new[$module_name]['IGNORE'] = 'Ignore';
$lang_new[$module_name]['EDIT'] = 'Editar';
$lang_new[$module_name]['LINK_OWNER'] = 'Propietario de vinculo';
$lang_new[$module_name]['LINK_SUBMITTER'] = 'Remitente de vinculo';
$lang_new[$module_name]['LINK_ID'] = 'Enlace ID';
$lang_new[$module_name]['LINK_URL'] = 'Enlace URL';
$lang_new[$module_name]['LINK_PAGETITLE'] = 'Titulo de la pagina';
$lang_new[$module_name]['LINK_IMAGE_URL'] = 'Imagen URL';
$lang_new[$module_name]['LINK_IMAGE'] = 'Imagen';
$lang_new[$module_name]['LINK_SUBMIT_DATE'] = 'Vinculo presentado el';
$lang_new[$module_name]['LINK_VALIDATE_DATE'] = 'Vinculo validado en';
$lang_new[$module_name]['LINK_PROFILE'] = 'Perfil de vinculo';
$lang_new[$module_name]['LINKS_NEW'] = 'Nuevos vinculos';
$lang_new[$module_name]['IN'] = 'En';
$lang_new[$module_name]['BE_PATIENT'] = 'Un momento por favor ...';
$lang_new[$module_name]['TITLE'] = 'Titulo';
$lang_new[$module_name]['BY'] = 'por';
$lang_new[$module_name]['UP'] = 'Arriba';
$lang_new[$module_name]['DOWN'] = 'Abajo';
$lang_new[$module_name]['OK'] = 'Aceptar';
$lang_new[$module_name]['OF'] = 'de';
$lang_new[$module_name]['NONE'] = 'Ninguno';
$lang_new[$module_name]['DATE'] = 'Fecha';
$lang_new[$module_name]['VISIT'] = 'Visitas';
$lang_new[$module_name]['VIEW_FULL'] = 'Pantalla de vista completa';
$lang_new[$module_name]['COMMENTS'] = 'Comentarios';
$lang_new[$module_name]['COMMENTS_TOTAL'] = 'Totales de comentarios';
$lang_new[$module_name]['COMMENTS_NUMBER'] = 'Numero de comentarios';
$lang_new[$module_name]['DATE_WRITTEN'] = 'escrito sobre';
$lang_new[$module_name]['IP_ADRESS'] = 'Direccion IP';
$lang_new[$module_name]['ADD_LINK'] = 'Agregar un vinculo';
$lang_new[$module_name]['PICSIZE'] = 'El Tama&ntilde;o maximo de la imagen debe ser: ';
$lang_new[$module_name]['PICSIZE_WIDTH'] = 'Ancho';
$lang_new[$module_name]['PICSIZE_HEIGHT'] = 'altura';
$lang_new[$module_name]['INSTRUCTIONS'] = 'Instrucciones';
$lang_new[$module_name]['MAIN_CATEGORY_PAGE'] = $lang_new[$module_name]['MODULE_NAME'] . ' Pagina principal de categoria';
$lang_new[$module_name]['LINKS'] = 'Enlaces';
$lang_new[$module_name]['AND'] = 'y';
$lang_new[$module_name]['CATEGORIES'] = 'Categorias';
$lang_new[$module_name]['IN_DB'] = 'en nuestra Base de datos';
$lang_new[$module_name]['BOX_HEADER_NEW'] = 'Nueva lista de vinculos';
$lang_new[$module_name]['BOX_HEADER_TOP'] = 'Top lista de vinculos';
$lang_new[$module_name]['NEW_TODAY'] = 'Hoy nuevo';
$lang_new[$module_name]['NEW_LAST3DAY'] = 'Nuevos ultimos 3 dias';
$lang_new[$module_name]['NEW_LAST30DAY'] = 'Nuevos ultimos 30 dias';
$lang_new[$module_name]['NEW_THISWEEK'] = 'Nuevo esta semana';
$lang_new[$module_name]['NEW_LASTWEEK'] = 'Nuevo la semana pasada';
$lang_new[$module_name]['NEW_TOTAL'] = 'Enlaces nuevo total';
$lang_new[$module_name]['NEW_TOTAL_FORLAST'] = 'Total ultimos vinculos nuevos';
$lang_new[$module_name]['DAYS'] = 'Dias';
$lang_new[$module_name]['DAYS_30'] = '30 Dias';
$lang_new[$module_name]['WEEKS_1'] = '1 Semana';
$lang_new[$module_name]['WEEKS_2'] = '2 Semanas';
$lang_new[$module_name]['POPULAR'] = 'Popular';
$lang_new[$module_name]['INDEX_PAGE'] = 'Indice pagina';
$lang_new[$module_name]['LINK_SUBMIT'] = 'Enviar nuevo vinculo';
$lang_new[$module_name]['SHOW'] = 'Mostrar';
$lang_new[$module_name]['SHOW_NEWSLINKS'] = 'Mostrar vinculos nuevo';
$lang_new[$module_name]['SHOW_MOSTPOPULAR'] = 'Mostrar Enlaces mas populares';
$lang_new[$module_name]['SHOW_TOPRATED'] = 'Mostrar mas votados Enlaces';
$lang_new[$module_name]['SHOW_LINK_COMMENTS'] = 'Mostrar Enlace Comentarios';
$lang_new[$module_name]['SHOW_EDITORIAL'] = 'Mostrar Editorial';
$lang_new[$module_name]['IMAGE_PIXEL'] = 'en Pixel';
$lang_new[$module_name]['RATED_BEST_HEADER'] = 'Enlaces mejor valorados - Top';
$lang_new[$module_name]['RATED_BEST'] = 'Mejor valorados';
$lang_new[$module_name]['RATED_TOTAL'] = 'Total clasificacion de Enlaces';
$lang_new[$module_name]['RATED_NUMBERS'] = 'Numero de vinculos de clasificacion';
$lang_new[$module_name]['RATED_USER_AVERAGE'] = 'Valoracion media de los usuarios';
$lang_new[$module_name]['RATING_DETAILS'] = 'Calificacion Detalles';
$lang_new[$module_name]['RATING_OVERALL'] = 'Calificacion global';
$lang_new[$module_name]['RATING_NUMBERS'] = 'Numero de clasificacion';
$lang_new[$module_name]['RATING_BREAKDOWN_VALUES'] = 'Desglose de la clasificacion por valor';
$lang_new[$module_name]['NOTE'] = 'Nota';
$lang_new[$module_name]['RATING'] = 'Calificacion';
$lang_new[$module_name]['RATING_WEIGHT_NOTE'] = '* Nota: Tsu registro de recursos de peso frente a usuarios no registrados puntuaciones';
$lang_new[$module_name]['RATING_WEIGHT_OUTNOTE'] = '* Nota: Este recurso pesa Fuera de los votantes registrados frente a puntuaciones';
$lang_new[$module_name]['RATING_LINK'] = 'Clasificacion de vinculos';
$lang_new[$module_name]['RATING_LINK_HIGHEST'] = 'Calificacion mas alta';
$lang_new[$module_name]['RATING_LINK_LOWEST'] = 'Calificacion mas baja';
$lang_new[$module_name]['VOTE_MINIMUM'] = 'minimo de votos requeridos';
$lang_new[$module_name]['VOTE'] = 'Voto';
$lang_new[$module_name]['VOTES'] = 'Votos';
$lang_new[$module_name]['VOTES_TOTAL'] = 'Total Votos';
$lang_new[$module_name]['VOTERS_OUTSIDE'] = 'Fuera de los votantes';
$lang_new[$module_name]['VOTERS_UNREGISTERED'] = 'Los usuarios no registrados (votantes)';
$lang_new[$module_name]['VOTES_OUTSIDE_NONE'] = 'No fuera votos';
$lang_new[$module_name]['VOTES_UNREGISTERED_NONE'] = 'No votos de los usuarios no registrados';
$lang_new[$module_name]['VOTES_REGISTERED_NONE'] = 'No votos de los usuarios registrados';
$lang_new[$module_name]['DO_RATE'] = 'Valorar este Sitio:';
$lang_new[$module_name]['DO_REPORT_BROKEN'] = 'Enviar Reportar enlace roto';
$lang_new[$module_name]['REPORT_BROKEN'] = 'Reportar enlace roto';
$lang_new[$module_name]['DO_SHOW_DETAILS'] = 'Detalles';
$lang_new[$module_name]['DO_SHOW_COMMENTS'] = 'Comentarios';
$lang_new[$module_name]['DO_VOTE_THIS_SITE'] = 'Vota por este sitio';
$lang_new[$module_name]['PAGE_NEXT'] = 'Pagina siguiente';
$lang_new[$module_name]['PAGE_NONEXT'] = 'No pagina siguiente';
$lang_new[$module_name]['PAGE_PREVIOUS'] = 'Pagina anterior';
$lang_new[$module_name]['PAGE_NOPREVIOUS'] = 'No pagina anterior';
$lang_new[$module_name]['SORTS_BY'] = 'Clase Enlaces por';
$lang_new[$module_name]['SORTS_IS'] = 'Enlaces clasificados actual por';
$lang_new[$module_name]['SORTS_TITLEAZ'] = 'Titulo (A to Z)';
$lang_new[$module_name]['SORTS_TITLEZA'] = 'Titulo (Z to A)';
$lang_new[$module_name]['SORTS_POPULARITY_UP'] = 'Popularidad (Mas a menos Aciertos)';
$lang_new[$module_name]['SORTS_POPULARITY_DOWN'] = 'Popularity (Mas a menos Aciertos)';
$lang_new[$module_name]['SORTS_DATE_UP'] = 'Fecha (Viejos Enlaces enumerados primero)';
$lang_new[$module_name]['SORTS_DATE_DOWN'] = 'Fecha (Nuevos Enlaces enumerados primero)';
$lang_new[$module_name]['SORTS_RATING_UP'] = 'Clasificacion (Las cuentas mas bajas a las cuentas mas altas)';
$lang_new[$module_name]['SORTS_RATING_DOWN'] = 'Clasificacion (Las cuentas mas altas a las cuentas mas bajas)';
$lang_new[$module_name]['MOST_POPULAR'] = 'El mas popular';
$lang_new[$module_name]['MODIFY_LINK_REQUEST'] = 'Modificacion del vinculo de la Solicitud';
$lang_new[$module_name]['EDITORIAL_BY'] = 'Editorial publicada por';
$lang_new[$module_name]['WELCOME_USERNAME'] = "Hi ".UsernameColor($userinfo['username']).", ";
$lang_new[$module_name]['PROMOTE_YOUR_WEBSITE'] = 'Promover su Sitio Web';
$lang_new[$module_name]['PROMOTE_RATING_FORM'] = 'Formulario remoto de la Clasificacion';
$lang_new[$module_name]['PROMOTE_RATING_BUTTON_LINK'] = 'Vinculo del boton';
$lang_new[$module_name]['PROMOTE_RATING_TEXT_LINK'] = 'Vinculo del texto';
$lang_new[$module_name]['PROMOTE_RATING_THE_NUMBER'] = 'El numero';
$lang_new[$module_name]['PROMOTE_RATING_ID_REFERER'] = 'al HTML la fuente se refiere a su sitio\'s ID numero adentro '.$sitename.' base de datos. Estar seguro que este numero esta presente.';
$lang_new[$module_name]['WEBLINKS_SIGNATURE'] = 'El equipo';
$lang_new[$module_name]['ADMIN_OPTIONS'] = 'Opciones de Administracion:';
$lang_new[$module_name]['SCROLL_UP'] = 'Arriba';
$lang_new[$module_name]['SCROLL_DOWN'] = 'Abajo';

$lang_new[$module_name]['INFO_DELETE'] = 'Eliminar (Elimina <strong><em>enlace roto</em></strong> y <strong><em>peticiones</em></strong> para un vinculo dado)"';
$lang_new[$module_name]['INFO_IGNORE'] = 'Ignore (Suprime todos <strong><em>peticiones</em></strong> para un vinculo dado)';
$lang_new[$module_name]['INFO_PENDING'] = 'Su Vinculo sera activado despues de ser comprobada por nuestro equipo.<br />Despues de que hayamos verificado su vinculo cerca le informaran a traves de un email.';
$lang_new[$module_name]['INFO_ONLYONCE'] = 'Enviar por favor su URL solamente una vez.<br />Le comprobamos URL contra los existencias en nuestra base de datos.';
$lang_new[$module_name]['INFO_ONLYREGISTERED'] = 'Lo siento, pero nosotros permitir que solamente los usuarios registrados hagan la accion que usted ha seleccionado en nuestro sitio.<br />If you are a registered user, you are not logged in at the moment. You can login <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">here</a></strong><br />Otherwise you can register yourself <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">here</a></strong>';
$lang_new[$module_name]['INFO_NO_SUBCAT'] = '--- Ninguna subcategoria ---';
$lang_new[$module_name]['INFO_RATING_1'] = 'No votar por favor por el mismo recurso mas de una vez.';
$lang_new[$module_name]['INFO_RATING_2'] = 'La escala es 1 - 10, con 1 que es pobre y 10 siendo excelentes.';
$lang_new[$module_name]['INFO_RATING_3'] = 'Ser por favor objetivo en su voto, si cada uno recibe un 1 o 10, la clasificacion no muy util.';
$lang_new[$module_name]['INFO_RATING_4'] = 'Usted puede ver una lista de <a href="modules.php?name='.$module_name.'&amp;op=TopRated">Recursos clasificados superiores</a>.';
$lang_new[$module_name]['INFO_RATING_5'] = 'No votar por su recurso propio o un competidor.';
$lang_new[$module_name]['INFO_REG_LOGGEDIN'] = 'Usted es un usuario registrado y se abre una sesion.';
$lang_new[$module_name]['INFO_UNREG_LOGGEDOUT'] = 'Usted no es un usuario registrado o usted no ha abierto una sesion.';
$lang_new[$module_name]['INFO_RATE_CANDO'] = 'Sentir libre de agregar un comentario sobre este sitio.';
$lang_new[$module_name]['INFO_RATE_CANNOTDO'] = 'Si usted esta registrado usted podria hacer comentarios en este sitio web.';
$lang_new[$module_name]['INFO_ISTHSYOURSITE'] = 'Es este su recurso?';
$lang_new[$module_name]['INFO_ALLOW_TO_RATE'] = 'Permitir que otros usuarios lo clasifiquen de su sitio web!';
$lang_new[$module_name]['INFO_RATE_ADDED_COMMENT'] = 'La entrada de usuarios tales como se ayudara a otros visitantes mejor a decidir a que vinculos haga click en.';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU'] = 'Gracias por el momento de tasa en un sitio aqui:';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] = '.';
$lang_new[$module_name]['INFO_RATE_COMPLETED_OK'] = 'Se agradece su clasificacion.';
$lang_new[$module_name]['INFO_THANKS'] = 'Gracias por la informacion.';
$lang_new[$module_name]['INFO_LOOK_AFTER'] = 'Veremos en breve su solicitud.';
$lang_new[$module_name]['INFO_PROMOTE_1'] = 'Tal vez usted puede estar interesado en varios de los mandos a distancia <em>Rate a Website</em> options we have available. These allow you to place an image (or even a rating form) on your web site in order to increase the number of votes your resource receive. Please choose from one of the options listed below:';
$lang_new[$module_name]['INFO_PROMOTE_2'] = 'Una forma de vincular a la calificacion de forma es a traves de un simple enlace de texto:';
$lang_new[$module_name]['INFO_PROMOTE_3'] = 'Si estas buscando un poco mas de un enlace de texto basicos, es posible que desee utilizar un pequeño boton de enlace:';
$lang_new[$module_name]['INFO_PROMOTE_4'] = 'Si usted engañar a este respecto, nos quita el vinculo. Dicho esto, aqui es lo que parece el formulario de clasificacion remoto actual.';
$lang_new[$module_name]['INFO_PROMOTE_5'] = 'Gracias! y buena suerte con sus puntuaciones!';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_1'] = 'El codigo HTML se debe usar en este caso, es la siguiente:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_2'] = 'El codigo fuente para el boton anterior es:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_3'] = 'Usando este formulario permitira a los usuarios el tipo de recursos directamente de su sitio y la calificacion se registraran aqui. El formulario esta desactivado, pero el siguiente codigo fuente funcionara si simplemente cortar y pegar en tu pagina web. El codigo fuente se muestra a continuacion:';

$lang_new[$module_name]['WARN_RECORDED'] = '<span style="color:red">Nombre de Usuario y la direccion IP esta registrada, asi que por favor, no abusar del sistema</span>';
$lang_new[$module_name]['WARN_CAT_NOT_FOUND'] = '<span style="color:red">No hay categoria para borrar/modificar/editar/transferencia</span>';
$lang_new[$module_name]['WARN_LINK_NOT_FOUND'] = '<span style="color:red">No hay enlaces para borrar/modificar/editar/validar</span>';
$lang_new[$module_name]['WARN_VOTE_NOT_FOUND'] = '<span style="color:red">No hay voto para eliminar/modificar/editar/validar</span>';
$lang_new[$module_name]['WARN_COMMENT_NOT_FOUND'] = '<span style="color:red">No hay ningun comentario para borrar/modificar/editar/validar</span>';
$lang_new[$module_name]['WARN_EDITORIAL_NOT_FOUND'] = '<span style="color:red">No hay ninguna editorial para borrar/modificar/editar/validar</span>';
$lang_new[$module_name]['WARN_COMMENT_DELETE_ALL'] = '<span style="color:red">ATTENTION<br />Teliminar su voluntad <em>Todo</em> Comentarios de <em>EVERY</em> Link.<br />Para borrar los comentarios de un enlace, seleccione <em>'. $lang_new[$module_name]['ADMIN_MODIFY_LINK'] .'</em> desde el menu del administrador</span>';
$lang_new[$module_name]['WARN_RATE_COMPLETED_TOSHORT'] = '<span style="color:red">Usted ya ha votado a favor de este recurso en el pasado '.$anonwaitdays.' dia(s).</span>';
$lang_new[$module_name]['WARN_RATE_ONLY_ONCE'] = '<span style="color:red">Solo puedes votar una vez por un recurso.<br />Todos los votos son registrados y revisados</span>';
$lang_new[$module_name]['WARN_RATE_NOT_SELF'] = '<span style="color:red">Usted no puede votar en un enlace que envia a.<br />Todos los votos son registrados y revisados</span>';
$lang_new[$module_name]['WARN_RATE_NO_SELECTED'] = '<span style="color:red">No hay ninguna valoracion seleccionado - no anoto votacion.</span>';
$lang_new[$module_name]['WARN_RATE_OUTSIDE_TOSHORT'] = '<span style="color:red">Solo un voto por cada direccion IP se permite '.$outsidewaitdays.' dia(s).</span>';
$lang_new[$module_name]['WARN_CAT_DELETE'] = '<span style="color:red">ADVERTENCIA: Esta seguro que desea eliminar esta categoria ? <br />Usted eliminara todas las sub-categorias y enlaces adjuntos y !</span>';

$lang_new[$module_name]['MESSAGE_LINK_ADDED'] = 'Link es su exito en la base de datos guardado';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED'] = 'Enlace Hemos recibido su peticion. Gracias!';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_EMAIL'] = 'Usted recibira un correo electronico despues de que nuestro equipo ha comprobado su presentacion.';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_NOEMAIL'] = 'Usted no proporciono una direccion de correo electronico, pero vamos a comprobar antes de su enlace.<br />So please look from time to time if your Submission is activated.';
$lang_new[$module_name]['MESSAGE_EDITORIAL_ADDED'] = 'Su editorial se ha guardado en la base de datos';
$lang_new[$module_name]['MESSAGE_EDITORIAL_MODIFIED'] = 'Su exito editorial es modificado';
$lang_new[$module_name]['MESSAGE_EDITORIAL_REMOVED'] = 'Su editorial se ha eliminado';
$lang_new[$module_name]['MESSAGE_COMMENT_DELETE_ALL'] = 'Todos los comentarios se eliminan de la base de datos<br />Espero que no han cometido un error<br />Ellos no pueden ser recuperados';
$lang_new[$module_name]['MESSAGE_RATING_ADDED'] = 'Su vinculo con exito se guarda en la base de datos';
$lang_new[$module_name]['MESSAGE_LINK_BROKEN_ADDED'] = 'Gracias por ayudarnos a mantener la integridad de este directorio.';
$lang_new[$module_name]['MESSAGE_LINK_BROKEN_EXISTS'] = 'Gracias por ayudarnos a mantener la integridad de este directorio. <br />Sin embargo, otro usuario mas rapido de lo que fue y nos informo de este enlace roto.';
$lang_new[$module_name]['MESSAGE_LINK_VALIDATED'] ='The Link is successfully validated and saved in the Database!';
$lang_new[$module_name]['MESSAGE_ADMIN_SETTINGS_SAVED'] = '<span style="color:green">Su modulo de configuracion se guardan en la Base de Datos.<br />Compruebe su registro de errores para obtener informacion sobre el ahorro de los errores</span>';

$lang_new[$module_name]['ERROR_NO_DESCRIPTION'] = 'Una descripcion de la relacion es esencial <br />Por favor, vuelva atras y agregarlo';
$lang_new[$module_name]['ERROR_NO_URL'] = 'Un URL para el enlace es esencial <br />Por favor, vuelva atras y agregarlo';
$lang_new[$module_name]['ERROR_NO_TITLE'] = 'Un titulo para el enlace es esencial <br />Por favor, vuelva atras y agregarlo';
$lang_new[$module_name]['ERROR_URL_EXISTS'] = 'La URL del enlace existente en nuestra base de datos <br />Por favor, vuelva atras y corregirlo';
$lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] = 'La URL del enlace o el titulo existe en nuestra base de datos <br />Por favor, vuelva atras y corregirlo';
$lang_new[$module_name]['ERROR_NO_CONFIG'] = 'Hay un problema dentro de la base de datos. No '.$module_name.' configuracion se puede encontrar.';
$lang_new[$module_name]['ERROR_NO_LID'] = 'No se encontraron enlaces en nuestra base de datos que sean adecuados a su seleccion.<br />Por favor, vuelva atras y intente de nuevo.';
$lang_new[$module_name]['ERROR_CAT_EXISTS'] = 'La categoria o subcategoria que desea crear ya existe en nuestra base de datos <br />Por favor, vuelva atras y intente de nuevo.';
$lang_new[$module_name]['ERROR_SECURITYCODE'] = 'El codigo de seguridad que ha introducido no encaja. Por favor, intentelo de nuevo.<br />(It could be a good idea to refresh your browser when you\'re back so the security code is refreshed too)<br /><br />'.$lang_new[$module_name]['SUBMIT_GOBACK'];

$lang_new[$module_name]['MAIL_SITENAME'] = 'Link en su web: ';
$lang_new[$module_name]['MAIL_HELLO'] = 'Hola';
$lang_new[$module_name]['MAIL_APPROVED_MESSAGE'] = 'Felicidades! El enlace que ha enviado a nuestra base de datos de enlaces ha sido aprobada y ahora esta a disposicion de los usuarios del sitio.';
$lang_new[$module_name]['MAIL_BROWSEURL'] = 'Revise nuestro sitio Enlaces Base de datos con un clic en esta URL ->';
$lang_new[$module_name]['MAIL_THANKYOU'] = 'Gracias por su presentacion - Usted siempre sera bienvenido en nuestro sitio web';
$lang_new[$module_name]['MAIL_SIGNATURE'] = ' El Equipo ';

?>