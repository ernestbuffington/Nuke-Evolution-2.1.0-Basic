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

$lang_new[$module_name]['MODULE_NAME'] = str_replace ("_", " ", $module_name);
$lang_new[$module_name]['ADMIN_HEADER'] = 'Nuke-Evolution Revisiones :: Panel de administracion de modulos';
$lang_new[$module_name]['ADMIN_GO_MAIN'] = 'Volver a la Administracion principal';
$lang_new[$module_name]['ADMIN_REVIEWSADMIN'] = 'Administracion de revisiones';
$lang_new[$module_name]['ADMIN_REVIEWS_STATUS'] = 'Estado de Revisiones';
$lang_new[$module_name]['ADMIN_ADD_CAT'] = 'Agregar una categoria';
$lang_new[$module_name]['ADMIN_ADD_SUBCAT'] = 'Agregar una subcategoria';
$lang_new[$module_name]['ADMIN_ADD_REVIEW'] = 'Agregue un reporte';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY'] = 'Comprobar Categorias';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY_INCLSUB'] = 'Incluye subcategorias';
$lang_new[$module_name]['ADMIN_REVIEW_VALIDATE'] = 'Validar las revisiones';
$lang_new[$module_name]['ADMIN_CAT_VALIDATE'] = 'Validar la categoria';
$lang_new[$module_name]['ADMIN_CATSUB_VALIDATE'] = 'Validar la subcategoria';
$lang_new[$module_name]['ADMIN_CAT_ATTACHED'] = 'adjunto a esta categoria';
$lang_new[$module_name]['ADMIN_VALIDATE_FAILED'] = 'Validacion fallada';
$lang_new[$module_name]['ADMIN_REVIEW_VALIDATE_WAIT'] = 'Esperar ..';
$lang_new[$module_name]['ADMIN_VALIDATE_OPTIONS'] = 'Opciones';
$lang_new[$module_name]['ADMIN_REVIEW_CHECK'] = 'Comprobar las revisiones';
$lang_new[$module_name]['ADMIN_REVIEW_CHECK_ALL'] = 'Comprobar todas las revisiones';
$lang_new[$module_name]['ADMIN_REVIEW_PROPOSED'] = 'Revision propuesta';
$lang_new[$module_name]['ADMIN_REVIEW_ORIGINAL'] = 'Revision original';
$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'] = 'vista previa de la imagen';
$lang_new[$module_name]['ADMIN_MODIFY_REVIEW'] = 'Modificar las revisiones';
$lang_new[$module_name]['ADMIN_MODIFY_CAT'] = 'Modificar la categoria';
$lang_new[$module_name]['ADMIN_BROKEN_REVIEW'] = 'Manejar las revisiones rotas';
$lang_new[$module_name]['ADMIN_MODIFY_REVIEW_REQUEST'] ='Manejar Solicitudes de revision';
$lang_new[$module_name]['ADMIN_TRANSFER_CAT'] = 'Transferir Categoria';
$lang_new[$module_name]['ADMIN_EDITORIAL_ADD'] = 'Agregar el editorial';
$lang_new[$module_name]['ADMIN_EDITORIAL_MODIFY'] = 'Modificar el editorial';
$lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] = 'Eliminar Comentarios';
$lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] = 'Ajustes del modulo';
$lang_new[$module_name]['ADMIN_REVIEW_VOTE_REGUSER'] = 'Votos del usuario registrado';
$lang_new[$module_name]['ADMIN_REVIEW_VOTE_UNREG'] = 'Votos de usuario no registrados';
$lang_new[$module_name]['ADMIN_REVIEW_VOTE_GUESTS'] = 'Votos de los invitados';
$lang_new[$module_name]['ADMIN_REVIEW_VOTE_TOTAL'] = 'Total de Votos';
$lang_new[$module_name]['ADMIN_REVIEW_RATING'] = 'Clasificacion';
$lang_new[$module_name]['ADMIN_REVIEW_RATING_AVERAGE'] = 'Clasificacion media de los usuarios';
$lang_new[$module_name]['ADMIN_REVIEW_RATING_TOTAL'] = 'Clasificacion total de los usuarios';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BEHAVIOR'] = 'Comportamiento';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BLOCKS'] = 'Ajustes del bloque';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_VOTING'] = 'Ajustes del voto';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW'] = 'Si se muestra la Tapa-Caja?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW_REVIEWS'] = 'Cuantas entradas se deben demostrar en la Tapa-Caja?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_HEIGHT'] = 'Altura de la Tapa-Caja en pixel';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL'] = 'Si esas revisiones se demuestran el movimiento en sentido vertical?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_AMOUNT'] = 'Cantidad de desplazamiento';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_DIRECTION'] = 'Direccion de desplazamiento';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_TITLE'] = 'Comportamiento de la tabla';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR1'] = 'Color de fondo de la tabla 1';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR2'] = 'Color de fondo de la tabla 2';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_TITLE'] = 'Comportamiento de la imagen';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_WIDTH'] = 'Tama&ntilde;o de la imagen: Anchura';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_HEIGHT'] = 'Tama&ntilde;o de la imagen: Altura';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_USE'] = 'Si utilizaron una miniatura-servidor para demostrar Revision-Imagenes?';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_URL'] = 'Incorporar el URL del miniatura-servidor<br />(Ejemplo: http://www.websitethumbnails.net/view.php?url=)';
$lang_new[$module_name]['ADMIN_SETTING_USE_SECURITYCODE'] = 'Utilizar el codigo de seguridad?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_ROWS'] = 'Cuantas revisiones se deben demostrar en Revision-bloque?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL'] = 'Si esas revisiones se demuestran el movimiento en sentido vertical?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_BREAKS_NO'] = 'Cuantos linea-se rompen se debe insertar entre cada revision?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_HEIGHT'] = 'Altura del bloque en pixel';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_WIDTH'] = 'Tama&ntilde;o de la imagen: Anchura';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_HEIGHT'] = 'Tama&ntilde;o de la imagen: Altura';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_TITLE'] ='Comportamiento del Desplazamiento';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_AMOUNT'] = 'Cantidad del Desplazamiento';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_DIRECTION'] = 'Direccion del Desplazamiento';

$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TITLE'] = 'Ajustes generales';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_REVIEWS_PER_PAGE'] = 'Numero de revisiones mostradas por la pagina';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_POPULAR'] = 'Cuantos golpes si una revision tiene que llegar a ser popular?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_NEWREVIEWS'] = 'Numero de revisiones mostradas en la nueva pagina de la revision?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_BESTREVIEWS'] = 'Numero de revisiones mostradas en la pagina mas popular?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_SEARCHREVIEWS'] = 'Numero de revisiones mostradas en la pagina de la busqueda (resultados de la busqueda)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNREVIEWS'] = 'Si los invitados pueden enviar nuevas revisiones?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNKNOWN'] = 'El numero de invitados cuantos dias debe esperar antes de que puedan votar por una revision';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNREGS'] = 'Numero de los usuarios no registrados cuantos dias (AE. Admitradores) debe esperar antes de que puedan votar por una revision';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_ADMINREVIEWS'] = 'Si el administrador Web puede agregar revisiones en sus sitios?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_GUEST_TO_REGISTERED'] = 'Porcentaje (xx/100):  Votos de huesped contra votos de usuarios registrados';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_UNREG_TO_REGISTERED'] = 'Porcentaje (xx/100):  Usuarios no registrados (AE. Votos de Administrador) contra votos de usuarios registrados';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_DETAIL'] = 'Cuantos lugares decimales se deben demostrar en detalles del voto?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_MAIN'] = 'Cuantos lugares decimales se deben demostrar en cualquier otro lugar?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPREVIEWS_PERCENT'] = 'Si los top revisiones se demuestran como por ciento<br />(si no se demuestran como #/Total revisiones)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPREVIEWS_VOTEMIN'] = 'El cuanto por ciento o numera se debe alcanzar para demostrar una revision de la web como revision superior ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_PERCENT'] = 'Si las revisiones populares se demuestran como por ciento<br />(si no se muestran como #/Total revisiones)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_VOTEMIN'] = 'El cuanto por ciento o numero se debe alcanzar para demostrar una revision como revision popular?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_SHOW_FEATURE_BOX'] ='Mostrar el Encabezado de las revisiones en la pagina principal?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPVOTE_MIN'] = 'El numero de votos una revision de la web debe tener que convertirse en una revision votada superior?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWN_MODREQ'] = 'invitados del bloque pueden sugerir cambios de la revision?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNVOTING'] = 'Permitir que las invitados voten? <br />(Si usted no permite, no se permite a los votantes exteriores tambien)';

$lang_new[$module_name]['REVIEWS'] = 'Revisiones';
$lang_new[$module_name]['REVIEW'] = 'Revision';
$lang_new[$module_name]['REVIEW_HEADER'] = 'Encabezado';
$lang_new[$module_name]['REVIEW_BODY'] = 'Cuerpo';
$lang_new[$module_name]['REVIEW_FOOTER'] = 'Pie';
$lang_new[$module_name]['REVIEW_SIGNATURE'] = 'Firma';
$lang_new[$module_name]['THERE_ARE'] = 'Hay ';
$lang_new[$module_name]['REVIEWS_IN_DB'] = 'Revisiones en nuestra base de datos.';
$lang_new[$module_name]['TOTAL_REVIEWS'] = 'Total Reviews';
$lang_new[$module_name]['TOTAL'] = 'Total';
$lang_new[$module_name]['TO'] = 'A';
$lang_new[$module_name]['NAME'] = 'Nombre';
$lang_new[$module_name]['USER'] = 'Usuario';
$lang_new[$module_name]['USER_REGISTERED'] = 'Usuario registrado';
$lang_new[$module_name]['USER_REGISTERED_NOT'] = 'Usuario no registrado';
$lang_new[$module_name]['DESCRIPTION'] = 'Descripcion';
$lang_new[$module_name]['CATEGORY'] = 'Categoria';
$lang_new[$module_name]['CATEGORIES'] = 'Categorias';
$lang_new[$module_name]['CATEGORYSUB'] = 'Subcategoria';
$lang_new[$module_name]['CATEGORIESSUB'] = 'Subcategorias';
$lang_new[$module_name]['EMAIL'] = 'Email';
$lang_new[$module_name]['EDITORIAL'] = 'Editorial';
$lang_new[$module_name]['HITS'] = 'Aciertos';
$lang_new[$module_name]['SEARCH_RESULTS_HEADER'] = 'Resultados de la busqueda para su pregunta:';
$lang_new[$module_name]['SEARCH_RESULTS_CATEGORIES'] = 'Encontrado en categorias';
$lang_new[$module_name]['SEARCH_RESULTS_REVIEWS'] = 'Encontrado en revisiones';
$lang_new[$module_name]['SEARCH_RESULTS_NO_MATCH'] = 'Lo siento, sino nosotros no encontro un fosforo a su busqueda en nuestra base de datos';
$lang_new[$module_name]['SEARCH_RESULTS_TRYSEARCH'] = 'Intentar buscar';
$lang_new[$module_name]['SEARCH_RESULTS_OTHER_ENGINES'] = 'en otros motores de la busqueda';
$lang_new[$module_name]['SUBMIT_MODIFY'] = 'Modificarse';
$lang_new[$module_name]['SUBMIT_DELETE'] = 'Eliminar';
$lang_new[$module_name]['SUBMIT_ADD'] = 'Agregar';
$lang_new[$module_name]['SUBMIT_SAVE'] = 'Guardar';
$lang_new[$module_name]['SUBMIT_DOIT'] = 'Hacerlo';
$lang_new[$module_name]['SUBMIT_ACCEPT'] = 'Aceptar';
$lang_new[$module_name]['SUBMIT_GOBACK'] = _GOBACK;
$lang_new[$module_name]['SUBMIT_RETURN'] = 'Volver';
$lang_new[$module_name]['SUBMIT_BACK_CATEGORY'] = 'Volver a la categoria';
$lang_new[$module_name]['SUBMIT_VOTE'] = 'Voto !';
$lang_new[$module_name]['SUBMIT_MODIFY_REQUEST'] = 'Enviar modifican Solicitud';
$lang_new[$module_name]['MODIFY'] = 'Modificarse';
$lang_new[$module_name]['AUTHOR'] = 'Autor';
$lang_new[$module_name]['DELETE'] = 'Eliminar';
$lang_new[$module_name]['IGNORE'] = 'Ignore';
$lang_new[$module_name]['EDIT'] = 'Editar';
$lang_new[$module_name]['REVIEW_OWNER'] = 'Due&ntilde;o de la revision';
$lang_new[$module_name]['REVIEW_SUBMITTER'] = 'Submitter de la revision';
$lang_new[$module_name]['REVIEW_REQUEST_SUBMITTER'] = 'Solicitud presentada por';
$lang_new[$module_name]['REVIEW_ID'] = 'Revision ID';
$lang_new[$module_name]['REVIEW_URL'] = 'Revision URL';
$lang_new[$module_name]['REVIEW_PAGETITLE'] = 'Titulo de la pagina';
$lang_new[$module_name]['REVIEW_IMAGE_URL'] = 'Imagen URL';
$lang_new[$module_name]['REVIEW_IMAGE'] = 'Imagen';
$lang_new[$module_name]['REVIEW_SUBMIT_DATE'] = 'Revision presentada el';
$lang_new[$module_name]['REVIEW_VALIDATE_DATE'] = 'Revision validada el';
$lang_new[$module_name]['REVIEW_PROFILE'] = 'Perfil de la revision';
$lang_new[$module_name]['REVIEWS_NEW'] = 'Nuevas revisiones';
$lang_new[$module_name]['IN'] = 'En';
$lang_new[$module_name]['BE_PATIENT'] = 'Un momento por favor ...';
$lang_new[$module_name]['TITLE'] = 'Title';
$lang_new[$module_name]['BY'] = 'por';
$lang_new[$module_name]['UP'] = 'Arriba';
$lang_new[$module_name]['DOWN'] = 'Abajo';
$lang_new[$module_name]['OK'] = 'Aceptar';
$lang_new[$module_name]['OF'] = 'de';
$lang_new[$module_name]['NONE'] = 'Ninguno';
$lang_new[$module_name]['DATE'] = 'Fecha';
$lang_new[$module_name]['VISIT'] = 'Mostrar';
$lang_new[$module_name]['COMMENTS'] = 'Comentarios';
$lang_new[$module_name]['COMMENTS_TOTAL'] = 'Total de los comentarios';
$lang_new[$module_name]['COMMENTS_NUMBER'] = 'Numero de comentarios';
$lang_new[$module_name]['DATE_WRITTEN'] = 'escrito el';
$lang_new[$module_name]['IP_ADRESS'] = 'IP Direccion';
$lang_new[$module_name]['ADD_REVIEW'] = 'Agregar una revision';
$lang_new[$module_name]['PICSIZE'] = 'El tama&ntilde;o maximo del cuadro debe ser: ';
$lang_new[$module_name]['PICSIZE_WIDTH'] = 'anchura';
$lang_new[$module_name]['PICSIZE_HEIGHT'] = 'altura';
$lang_new[$module_name]['INSTRUCTIONS'] = 'Instrucciones';
$lang_new[$module_name]['MAIN_CATEGORY_PAGE'] = $lang_new[$module_name]['MODULE_NAME'] . ' Pagina principal de categoria';
$lang_new[$module_name]['REVIEWS'] = 'Revisiones';
$lang_new[$module_name]['AND'] = 'y';
$lang_new[$module_name]['CATEGORIES'] = 'Categorias';
$lang_new[$module_name]['IN_DB'] = 'en nuestra base de datos';
$lang_new[$module_name]['BOX_HEADER_NEW'] = 'Nueva lista de comentarios';
$lang_new[$module_name]['BOX_HEADER_TOP'] = 'Lista comentarios de visitas';
$lang_new[$module_name]['NEW_TODAY'] = 'Nuevos Hoy';
$lang_new[$module_name]['NEW_LAST3DAY'] = 'Nuevos ultimos 3 dias';
$lang_new[$module_name]['NEW_LAST30DAY'] = 'Nuevos ultimos 30 dias';
$lang_new[$module_name]['NEW_THISWEEK'] = 'Nuevo esta semana';
$lang_new[$module_name]['NEW_LASTWEEK'] = 'Nuevo la semana pasada';
$lang_new[$module_name]['NEW_TOTAL'] = 'Comentarios nuevos totales';
$lang_new[$module_name]['NEW_TOTAL_FORLAST'] = 'Total Nuevos comentarios de los ultimos';
$lang_new[$module_name]['DAYS'] = 'Dias';
$lang_new[$module_name]['DAYS_30'] = '30 Dias';
$lang_new[$module_name]['WEEKS_1'] = '1 Semana';
$lang_new[$module_name]['WEEKS_2'] = '2 Semanas';
$lang_new[$module_name]['POPULAR'] = 'Popular';
$lang_new[$module_name]['INDEX_PAGE'] = 'Pagina de indice';
$lang_new[$module_name]['REVIEW_SUBMIT'] = 'Enviar la nueva revision';
$lang_new[$module_name]['SHOW'] = 'Mostrar';
$lang_new[$module_name]['SHOW_NEWSREVIEWS'] = 'Mostrar las nuevas revisiones';
$lang_new[$module_name]['SHOW_MOSTPOPULAR'] = 'Mostrar la mayoria de las revisiones populares';
$lang_new[$module_name]['SHOW_TOPRATED'] = 'Mostrar las revisiones Toprated';
$lang_new[$module_name]['SHOW_REVIEW_COMMENTS'] = 'Mostrar los comentarios de la revision';
$lang_new[$module_name]['SHOW_EDITORIAL'] = 'Mostrar el editorial';
$lang_new[$module_name]['IMAGE_PIXEL'] = 'en pixel';
$lang_new[$module_name]['RATED_BEST_HEADER'] = 'Las mejores revisiones clasificadas - Top';
$lang_new[$module_name]['RATED_BEST'] = 'Clasificado mejor';
$lang_new[$module_name]['RATED_TOTAL'] = 'Revisiones clasificadas totales';
$lang_new[$module_name]['RATED_NUMBERS'] = 'Numero de revisiones clasificadas';
$lang_new[$module_name]['RATED_USER_AVERAGE'] = 'Clasificacion media de los usuarios';
$lang_new[$module_name]['RATING_DETAILS'] = 'Detalles de la Clasificacion';
$lang_new[$module_name]['RATING_OVERALL'] = 'Clasificacion total';
$lang_new[$module_name]['RATING_NUMBERS'] = 'Numero de Clasificaciones';
$lang_new[$module_name]['RATING_BREAKDOWN_VALUES'] = 'Desglose de la clasificacion por valor';
$lang_new[$module_name]['NOTE'] = 'Nota';
$lang_new[$module_name]['RATING'] = 'Clasificacion';
$lang_new[$module_name]['RATING_WEIGHT_NOTE'] = '* Nota: Este recurso pesa registrado contra clasificacion no registrada de los usuarios';
$lang_new[$module_name]['RATING_WEIGHT_OUTNOTE'] = '* Nota: Este recurso pesa registrado contra. Clasificacion exterior de los votantes';
$lang_new[$module_name]['RATING_REVIEW'] = 'Revisiones que clasifican';
$lang_new[$module_name]['RATING_REVIEW_HIGHEST'] = 'La Clasificacion mas alta';
$lang_new[$module_name]['RATING_REVIEW_LOWEST'] = 'La Clasificacion mas baja';
$lang_new[$module_name]['VOTE_MINIMUM'] = 'votos minimos requeridos';
$lang_new[$module_name]['VOTE'] = 'Voto';
$lang_new[$module_name]['VOTES'] = 'Votos';
$lang_new[$module_name]['VOTES_TOTAL'] = 'Total Votos';
$lang_new[$module_name]['VOTERS_OUTSIDE'] = 'Votantes exteriores';
$lang_new[$module_name]['VOTERS_UNREGISTERED'] = 'Usuarios no registrados (votantes)';
$lang_new[$module_name]['VOTES_OUTSIDE_NONE'] = 'Ningunos votos exteriores';
$lang_new[$module_name]['VOTES_UNREGISTERED_NONE'] = 'Ningunos votos no registrados de los usuarios';
$lang_new[$module_name]['VOTES_REGISTERED_NONE'] = 'Ningunos votos de los usuarios registrados';
$lang_new[$module_name]['DO_RATE'] = 'Clasificar este sitio';
$lang_new[$module_name]['DO_REPORT_BROKEN'] = 'Enviar la revision rota del informe';
$lang_new[$module_name]['REPORT_BROKEN'] = 'Divulgar la revision rota';
$lang_new[$module_name]['DO_SHOW_DETAILS'] = 'Detalles';
$lang_new[$module_name]['DO_SHOW_COMMENTS'] = 'Comentarios';
$lang_new[$module_name]['DO_VOTE_THIS_SITE'] = 'Voto para este sitio';
$lang_new[$module_name]['PAGE'] = 'Pagina';
$lang_new[$module_name]['PAGE_NEXT'] = 'Pagina siguiente';
$lang_new[$module_name]['PAGE_NONEXT'] = 'Ninguna pagina siguiente';
$lang_new[$module_name]['PAGE_PREVIOUS'] = 'Pagina anterior';
$lang_new[$module_name]['PAGE_NOPREVIOUS'] = 'Ninguna pagina anterior';
$lang_new[$module_name]['SORTS_BY'] = 'Revisiones de la clase por';
$lang_new[$module_name]['SORTS_IS'] = 'Revisiones clasificadas actual por';
$lang_new[$module_name]['SORTS_TITLEAZ'] = 'Titulo (A to Z)';
$lang_new[$module_name]['SORTS_TITLEZA'] = 'Titulo (Z to A)';
$lang_new[$module_name]['SORTS_POPULARITY_UP'] = 'Popularidad (lo menos a la mayoria de los Aciertos)';
$lang_new[$module_name]['SORTS_POPULARITY_DOWN'] = 'Popularidad (la mayoria a menos Aciertos)';
$lang_new[$module_name]['SORTS_DATE_UP'] = 'Fecha (viejas revisiones enumeradas primero)';
$lang_new[$module_name]['SORTS_DATE_DOWN'] = 'Fecha (nuevas revisiones enumeradas primero)';
$lang_new[$module_name]['SORTS_RATING_UP'] = 'Clasificacion (las cuentas mas bajas a las cuentas mas altas)';
$lang_new[$module_name]['SORTS_RATING_DOWN'] = 'Clasificacion (las cuentas mas altas a las cuentas mas bajas)';
$lang_new[$module_name]['MOST_POPULAR'] = 'El mas popular';
$lang_new[$module_name]['MODIFY_REVIEW_REQUEST'] = 'Modificacion de la revision de la Solicitud';
$lang_new[$module_name]['EDITORIAL_BY'] = 'Editorial publicada por';
$lang_new[$module_name]['WELCOME_USERNAME'] = "Hola ".UsernameColor($userinfo['username']).", ";
$lang_new[$module_name]['PROMOTE_YOUR_WEBSITE'] = 'Promover su Sitio Web';
$lang_new[$module_name]['PROMOTE_RATING_FORM'] = 'Formulario remoto de la Clasificacion';
$lang_new[$module_name]['PROMOTE_RATING_BUTTON_REVIEW'] = 'Revision del boton';
$lang_new[$module_name]['PROMOTE_RATING_TEXT_REVIEW'] = 'Revision del texto';
$lang_new[$module_name]['PROMOTE_RATING_THE_NUMBER'] = 'El numero';
$lang_new[$module_name]['PROMOTE_RATING_ID_REFERER'] = 'en el codigo HTML origen hace referencia a numero de identificacion del sitio en '.$sitename.' database. Be sure this number is present.';
$lang_new[$module_name]['REVIEWS_SIGNATURE'] = 'El equipo';
$lang_new[$module_name]['ADMIN_OPTIONS'] = 'Opciones de Administracion:';
$lang_new[$module_name]['SCROLL_UP'] = 'Arriba';
$lang_new[$module_name]['SCROLL_DOWN'] = 'Abajo';
$lang_new[$module_name]['COPYRIGHT'] = 'Copia de los derechos reservados; por';
$lang_new[$module_name]['COPYRIGHT2'] = 'Todos los derechos reservados.';
$lang_new[$module_name]['ORIGINAL'] = 'original';

$lang_new[$module_name]['INFO_DELETE'] = 'Eliminar (Elimina <strong><em>revision rota</em></strong> y <strong><em>peticiones</em></strong> para una revision dada)"';
$lang_new[$module_name]['INFO_IGNORE'] = 'No hacer caso (Elimina todo <strong><em>peticiones</em></strong> para una revision dada)';
$lang_new[$module_name]['INFO_PENDING'] = 'Su revision sera activada despues de ser comprobada por nuestro equipo.<br />Despues de que hayamos verificado su revision usted sera informado a traves de un email.';
$lang_new[$module_name]['INFO_ONLYONCE'] = 'Enviar por favor su URL solamente una vez.<br />Le comprobamos URL contra los existencias en nuestra base de datos.';
$lang_new[$module_name]['INFO_ONLYREGISTERED'] = 'Lo siento, pero nosotros permitir que solamente los usuarios registrados hagan la accion que usted ha seleccionado en nuestro sitio.<br />Si usted es un usuario registrado, en el momento le no abren una sesion. Usted puede abrirse una sesion <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">here</a></strong><br />Si no usted puede colocarse <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">aqui</a></strong>';
$lang_new[$module_name]['INFO_NO_SUBCAT'] = '--- Ninguna subcategoria ---';
$lang_new[$module_name]['INFO_RATING_1'] = 'No votar por favor por el mismo recurso mas de una vez.';
$lang_new[$module_name]['INFO_RATING_2'] = 'La escala es 1 - 10, con 1 que es pobre y 10 siendo excelentes.';
$lang_new[$module_name]['INFO_RATING_3'] = 'Ser por favor objetivo en su voto, si cada uno recibe un 1 o 10, la clasificacion no muy util.';
$lang_new[$module_name]['INFO_RATING_4'] = 'Usted puede ver una lista de <a href="modules.php?name='.$module_name.'&amp;op=TopRated">Recursos clasificados superiores</a>.';
$lang_new[$module_name]['INFO_RATING_5'] = 'No votar por su recurso propio o un competidor.';
$lang_new[$module_name]['INFO_REG_LOGGEDIN'] = 'Usted es un usuario registrado y se abre una sesion.';
$lang_new[$module_name]['INFO_UNREG_LOGGEDOUT'] = 'Usted no es un usuario registrado o usted no ha abierto una sesion.';
$lang_new[$module_name]['INFO_RATE_CANDO'] = 'Sentir libre de agregar un comentario sobre este sitio.';
$lang_new[$module_name]['INFO_RATE_CANNOTDO'] = 'Si usted era registrado usted podria hacer comentarios en este sitio web.';
$lang_new[$module_name]['INFO_ISTHSYOURSITE'] = 'Es este su recurso?';
$lang_new[$module_name]['INFO_ALLOW_TO_RATE'] = 'Permitir que otros usuarios lo clasifiquen de su sitio web!';
$lang_new[$module_name]['INFO_RATE_ADDED_COMMENT'] = 'La entrada de usuarios tales como se ayudara a otros visitantes mejor a decidir a que revisiones a chascar en.';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU'] = 'Gracias por tardar la epoca de clasificar un sitio aqui en:';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] = '.';
$lang_new[$module_name]['INFO_RATE_COMPLETED_OK'] = 'Se aprecia su grado.';
$lang_new[$module_name]['INFO_THANKS'] = 'Gracias por la informacion.';
$lang_new[$module_name]['INFO_LOOK_AFTER'] = 'Miraremos en su peticion pronto.';
$lang_new[$module_name]['INFO_PROMOTE_1'] = 'Quiza usted puede estar interesado en varios del <em>Rate alejado al Sitio Web</em> las opciones tenemos disponible. estos permiten que usted ponga una imagen (o aun una forma del grado) en su sitio web para aumentar el numero de votos que su recurso recibe. Elegir por favor a partir de la una de las opciones enumeradas abajo:';
$lang_new[$module_name]['INFO_PROMOTE_2'] = 'Una forma a ligar a la forma del grado esta a traves de un vinculo simple del texto:';
$lang_new[$module_name]['INFO_PROMOTE_3'] = 'Si usted esta buscando un poco mas que un vinculo basico del texto, usted puede desear utilizar un peque&ntilde;o vinculo del boton:';
$lang_new[$module_name]['INFO_PROMOTE_4'] = 'Si usted enga&ntilde;a en esto, quitaremos su vinculo. Diciendo eso, aqui es lo que parece la forma alejada actual del grado.';
$lang_new[$module_name]['INFO_PROMOTE_5'] = '°Gracias! y buena suerte con su clasificacion!';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_1'] = 'El codigo del HTML que usted debe utilizar en este caso, es el siguiente:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_2'] = 'El codigo fuente para el boton antedicho es:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_3'] = 'Usar esta forma permitira que los usuarios clasifiquen su recurso directo de su sitio y el grado sera registrado aqui. La forma antedicha es lisiada, pero el codigo fuente siguiente trabajara si usted lo corta y pegar simplemente en su Web page. El codigo fuente se demuestra abajo:';
$lang_new[$module_name]['INFO_REVIEW_URL'] = '<span style="font-size: xx-small; color: #f00; font-weight: bold;">URL a una revision en un servidor externo.<br />Todos los campos abajo seran no hechos caso si un URL se da aqui.</span>';
$lang_new[$module_name]['INFO_REVIEW_IMGURL'] = '<span style="font-size: xx-small;">Ruta local de Imagen (Ejemplo: modules/Reviews/photos/myimage.png)<br />Para tener acceso a imagenes de un servidor externo usted tiene que agregar un URL lleno (ejemplo: http://www.mysite.com/myimage.png)<br />Si se permiten miniaturas, que este campo vacio para mostrar una imagen en miniatura.</span>';

$lang_new[$module_name]['WARN_RECORDED'] = '<span style="color:red">Su username e IP address se registra, tan satisfacen, no abusan del sistema</span>';
$lang_new[$module_name]['WARN_CAT_NOT_FOUND'] = '<span style="color:red">No hay categoria a suprimir/modificar/editar/transferir</span>';
$lang_new[$module_name]['WARN_REVIEW_NOT_FOUND'] = '<span style="color:red">No hay revision a suprimir/modificar/editar/validar</span>';
$lang_new[$module_name]['WARN_VOTE_NOT_FOUND'] = '<span style="color:red">No hay voto a suprimir/modificar/editar/validar</span>';
$lang_new[$module_name]['WARN_COMMENT_NOT_FOUND'] = '<span style="color:red">No hay comentario a suprimir/modificar/editar/validar</span>';
$lang_new[$module_name]['WARN_EDITORIAL_NOT_FOUND'] = '<span style="color:red">No hay editorial a suprimir/modificar/editar/validar</span>';
$lang_new[$module_name]['WARN_COMMENT_DELETE_ALL'] = '<span style="color:red">ATTENTION<br />Esto suprimira <em>TODOS</em> Comentarios de <em>EVERY</em> Revision.<br />Para suprimir comentarios de una revision especial, seleccionar <em>'. $lang_new[$module_name]['ADMIN_MODIFY_REVIEW'] .'</em> del menu de Administracion</span>';
$lang_new[$module_name]['WARN_RATE_COMPLETED_TOSHORT'] = '<span style="color:red">Usted ha votado ya por este recurso en el pasado '.$anonwaitdays.' dia(s).</span>';
$lang_new[$module_name]['WARN_RATE_ONLY_ONCE'] = '<span style="color:red">Usted puede votar solamente una vez por un recurso.<br />Se registran y se repasan todos los votos</span>';
$lang_new[$module_name]['WARN_RATE_NOT_SELF'] = '<span style="color:red">Usted no puede votar sobre una revision que usted envio.<br />Se registran y se repasan todos los votos</span>';
$lang_new[$module_name]['WARN_RATE_NO_SELECTED'] = '<span style="color:red">NinguÃÅn grado seleccionado - ninguÃÅn voto marcado.</span>';
$lang_new[$module_name]['WARN_RATE_OUTSIDE_TOSHORT'] = '<span style="color:red">Solamente un voto por IP direccion permitio cada '.$outsidewaitdays.' dia(s).</span>';
$lang_new[$module_name]['WARN_CAT_DELETE'] = '<span style="color:red">ADVERTENCIA : Es usted que usted quiere sure suprimir esta categoria ? <br />Usted suprimira todas las subcategorias y revisiones atadas tambien !</span>';

$lang_new[$module_name]['MESSAGE_REVIEW_ADDED'] = 'Su revision se guardo con exito en la base de datos';
$lang_new[$module_name]['MESSAGE_REVIEW_SUBMITTED'] = 'Recibimos su sumision de la revision. Gracias!';
$lang_new[$module_name]['MESSAGE_REVIEW_SUBMITTED_EMAIL'] = 'Usted recibira un email despues de que nuestro equipo haya comprobado su sumision.';
$lang_new[$module_name]['MESSAGE_REVIEW_SUBMITTED_NOEMAIL'] = 'Usted no proporciono un email address pero comprobaremos su revision pronto.<br />Satisfacer tan miran de vez en cuando si se activa su sumision.';
$lang_new[$module_name]['MESSAGE_EDITORIAL_ADDED'] = 'Su editorial se guardo con exito en la base de datos';
$lang_new[$module_name]['MESSAGE_EDITORIAL_MODIFIED'] = 'Su editorial se modifica con exito';
$lang_new[$module_name]['MESSAGE_EDITORIAL_REMOVED'] = 'Su editorial se quita con exito';
$lang_new[$module_name]['MESSAGE_COMMENT_DELETE_ALL'] = 'Todos los comentarios se suprimen de base de datos<br />Esperanzadamente usted no ha incurrido en una equivocacion<br />No pueden ser recuperados';
$lang_new[$module_name]['MESSAGE_RATING_ADDED'] = 'Su revision se guardo con exito en la base de datos';
$lang_new[$module_name]['MESSAGE_REVIEW_BROKEN_ADDED'] = 'Gracias por ayudar a mantener la integridad de este directorio.';
$lang_new[$module_name]['MESSAGE_REVIEW_BROKEN_EXISTS'] = 'Gracias por ayudar a mantener la integridad de este directorio. <br />Pero otro usuario era mas rapido que usted y divulgado nos esta revision rota.';
$lang_new[$module_name]['MESSAGE_REVIEW_VALIDATED'] = 'La revision se valida y se ahorra con exito en la base de datos!';
$lang_new[$module_name]['MESSAGE_ADMIN_SETTINGS_SAVED'] = '<span style="color:green">Sus ajustes del modulo se ahorran en la base de datos.<br />Comprobar su registro de errores para saber si hay informacion sobre errores del ahorro</span>';
$lang_new[$module_name]['MESSAGE_REVIEW_MODIFIED'] = 'La revision modificada se ahorra con exito en la base de datos!';

$lang_new[$module_name]['ERROR_NO_DESCRIPTION'] = 'Una descripcion de la revision es esencial <br />Volver por favor y agregarlo';
$lang_new[$module_name]['ERROR_NO_URL'] = 'Un URL a la revision es esencial <br />Volver por favor y agregarlo';
$lang_new[$module_name]['ERROR_NO_TITLE'] = 'Un titulo para la revision es esencial <br />Volver por favor y agregarlo';
$lang_new[$module_name]['ERROR_URL_EXISTS'] = 'El URL a la revision existe en nuestra base de datos <br />Volver por favor y corregirlo';
$lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] = 'El URL a la revision o al titulo existe en nuestra base de datos <br />Volver por favor y corregirlo';
$lang_new[$module_name]['ERROR_NO_CONFIG'] = 'Hay un problema dentro de la base de datos. No '.$module_name.' la configuracion podia ser encontrada.';
$lang_new[$module_name]['ERROR_NO_RID'] = 'No encontramos ninguna revision en nuestra base de datos que es conveniente a su opcion.<br />Volver por favor e intentarlo otra vez.';
$lang_new[$module_name]['ERROR_CAT_EXISTS'] = 'La categoria o la subcategoria que usted quiso crear ya existe en nuestra base de datos <br />Volver por favor e intentarlo otra vez.';
$lang_new[$module_name]['ERROR_SECURITYCODE'] = 'El codigo de seguridad que usted ha introducido no cabe. Intentar por favor otra vez.<br />(Podria ser una buena idea restaurar su hojeador cuando usted esta detras asi que el codigo de seguridad se restaura tambien)<br /><br />'.$lang_new[$module_name]['SUBMIT_GOBACK'];

$lang_new[$module_name]['MAIL_SITENAME'] = 'Su revision en: ';
$lang_new[$module_name]['MAIL_HELLO'] = 'Hola';
$lang_new[$module_name]['MAIL_APPROVED_MESSAGE'] = '°Enhorabuena! La revision que usted envio a nuestras revisiones la base de datos se ha aprobado ahora y esta disponible para los usuarios del sitio.';
$lang_new[$module_name]['MAIL_BROWSEURL'] = 'Comprobar nuestra base de datos de las revisiones con un Haga clic en en este URL ->';
$lang_new[$module_name]['MAIL_THANKYOU'] = 'Gracias buenas por su sumision - usted sera siempre agradable en nuestro sitio web';
$lang_new[$module_name]['MAIL_SIGNATURE'] = 'El equipo';

?>