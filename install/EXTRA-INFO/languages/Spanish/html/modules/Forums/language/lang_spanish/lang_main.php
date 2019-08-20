<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                            lang_main.php [English]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_main.php,v 1.1 2005/05/09 17:44:47 chatserv Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Recent Topics                            v1.2.4       06/11/2005
      Global Announcements                     v1.2.8       06/13/2005
      Select Expand BBcodes                    v1.3.0       06/14/2005
      Force Word Wrapping - Configurator       v1.0.16      06/15/2005
      Topic Cement                             v1.0.3       06/15/2005
      Cache phpBB version in ACP               v1.0.0       06/15/2005
      Search Only Subject                      v0.9.1       06/15/2005
      Resize Posted Images                     v2.4.5       06/15/2005
      View/Disable Avatars/Signatures          v1.1.2       06/16/2005
      Signature Editor/Preview Deluxe          v1.0.0       06/22/2005
      Separate Announcements & Sticky          v2.0.0a      06/24/2005
      Staff Site                               v2.0.3       06/24/2005
      Forum Statistics                         v1.2.2       06/25/2005
      Disable Board Admin Override             v0.1.1       07/06/2005
      Memberlist Find User                     v1.0.0       07/06/2005
      PHP Syntax Highlighter BBCode            v3.0.7       07/10/2005
      Theme Simplifications                    v1.0.0       07/19/2005
      Limit smilies per post                   v1.0.2       07/24/2005
      YA Merge                                 v1.0.0       07/28/2005
      User Administration Link on Profile      v1.0.0       07/29/2005
      Move Message - Merge AddOn               v1.0.0       07/30/2005
      Must first vote to see results           v1.0.0       08/03/2005
      Log Moderator Actions                    v1.1.6       08/06/2005
      XData                                    v1.0.3       02/08/2007
      At a Glance Options                      v1.0.0       08/17/2005
      Extended Quote Tag                       v1.0.0       08/17/2005
      At a Glance Cement                       v1.0.0       08/17/2005
      Online Time                              v1.0.0       08/21/2005
      Quick Search                             v3.0.1       08/23/2005
      Hide Images and Links                    v1.0.0       08/30/2005
      Report Posts                             v1.2.3       08/30/2005
      Show Groups                              v1.0.1       09/02/2005
      Hide Images                              v1.0.0       09/02/2005
      Super Quick Reply                        v1.3.2       09/08/2005
      Log Actions Mod - Topic View             v2.0.0       09/18/2005
      Advanced BBCode Box                      v5.0.0a      11/16/2005
      Remote Avatar Resize                     v1.1.4       11/19/2005
      Online/Offline/Hidden                    v2.2.7       01/24/2006
      Auto Group                               v1.2.2       11/06/2006
      Who is Online Location Fix               v0.9.1       11/07/2007
      DHTML Collapsible FAQ MOD                v1.0.0       12/03/2007
 ************************************************************************/

//
// CONTRIBUTORS:
//     Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

$lang['ENCODING'] = 'UTF-8';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
$lang['DATE_FORMAT'] =  'd M Y'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
// $lang['TRANSLATION'] = '';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Foro';
$lang['Category'] = 'Categoria';
$lang['Topic'] = 'Tema';
$lang['Topics'] = 'Temas';
$lang['Replies'] = 'Respuestas';
$lang['Views'] = 'Vistos';
$lang['Post'] = 'Mensaje';
$lang['Posts'] = 'Mensajes';
$lang['Posted'] = 'Anunciado';
$lang['Username'] = 'Nombre Usuario';
$lang['Password'] = 'Contrase&ntilde;a';
$lang['Email'] = 'Correo';
$lang['Poster'] = 'Cartel';
$lang['Author'] = 'Autor';
$lang['Time'] = 'Tiempo';
$lang['Hours'] = 'Horas';
$lang['Message'] = 'Mensaje';

$lang['1_Day'] = '1 Dia';
$lang['7_Days'] = '7 Dias';
$lang['2_Weeks'] = '2 Semanas';
$lang['1_Month'] = '1 Mes';
$lang['3_Months'] = '3 Meses';
$lang['6_Months'] = '6 Meses';
$lang['1_Year'] = '1 Year';

$lang['Go'] = 'Ir';
$lang['Jump_to'] = 'Saltar a';
$lang['Submit'] = 'Enviar';
$lang['Reset'] = 'Restablecer';
$lang['Cancel'] = 'Cancelar';
$lang['Preview'] = 'Vista Previa';
$lang['Confirm'] = 'Confirmar';
$lang['Spellcheck'] = 'Corrector ortografico';
$lang['Yes'] = 'Si';
$lang['No'] = 'No';
$lang['Enabled'] = 'Activado';
$lang['Disabled'] = 'Desactivado';
$lang['Error'] = 'Error';

$lang['Next'] = 'Siguiente';
$lang['Previous'] = 'Anterior';
$lang['Goto_page'] = 'Ir a pagina';
$lang['Joined'] = 'Inicio';
$lang['IP_Address'] = 'IP Direccion';

$lang['Select_forum'] = 'Seleccione un foro';
$lang['View_latest_post'] = 'Ver ultimo mensaje';
$lang['View_newest_post'] = 'Ver ultima entrada';
$lang['Page_of'] = 'Pagina <strong>%d</strong> of <strong>%d</strong>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'ICQ Numero';
$lang['AIM'] = 'AIM Direccion';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = '%s Indice del Foro';  // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = 'Publicar nuevo tema';
$lang['Reply_to_topic'] = 'Responder al tema';
$lang['Reply_with_quote'] = 'Responder con cita';

$lang['Click_return_topic'] = 'Presione %sAqui%s para volver al tema'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Presione %sAqui%s para volver a intentarlo';
$lang['Click_return_forum'] = 'Presione %sAqui%s para volver al foro';
$lang['Click_view_message'] = 'Presione %sAqui%s para ver su mensaje';
$lang['Click_return_modcp'] = 'Presione %sAqui%s para volver al Moderador Panel de control';
$lang['Click_return_group'] = 'Presione %sAqui%s para regresar a la informacion de los grupos';

$lang['Could_not_update'] = 'No es posible actualizar %d';
$lang['Could_not_insert_for'] = 'No puede insertar %d para %d';
$lang['Could_not_optain_for'] = 'Podria no obtener %d para %d';

$lang['Admin_panel'] = 'Vaya al panel de administracion';

$lang['Board_disable'] = 'Lo sentimos, pero esta placa no esta ahora disponible. Por favor, intentelo de nuevo mas tarde.';
//
// Global Header strings
//
$lang['Registered_users'] = 'Usuarios Registrados:';
$lang['Browsing_forum'] = 'Usuarios viendo este foro:';
$lang['Online_users_zero_total'] = 'En total hay <strong>0</strong> usuarios en linea :: ';
$lang['Online_users_total'] = 'En total hay <strong>%d</strong> usuarios en linea :: ';
$lang['Online_user_total'] = 'En total hay <strong>%d</strong> usuarios en linea :: ';
$lang['Reg_users_zero_total'] = '0 Registrado, ';
$lang['Reg_users_total'] = '%d Registrado, ';
$lang['Reg_user_total'] = '%d Registrado, ';
$lang['Hidden_users_zero_total'] = '0 Ocultos y ';
$lang['Hidden_user_total'] = '%d Ocultos y ';
$lang['Hidden_users_total'] = '%d Ocultos y ';
$lang['Guest_users_zero_total'] = '0 Invitados';
$lang['Guest_users_total'] = '%d Invitados';
$lang['Guest_user_total'] = '%d Invitado';
$lang['Record_online_users'] = 'La mayoria de los usuarios conectados a la vez fue <strong>%s</strong> en %s'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministradore%s';
$lang['Mod_online_color'] = '%sModeradore%s';

$lang['You_last_visit'] = 'La ultima vez que visito el%s'; // %s replaced by date/time
$lang['Current_time'] = 'Ahora el tiempo es %s'; // %s replaced by time

$lang['Search_new'] = 'Ver mensajes desde la ultima visita';
$lang['Search_your_posts'] = 'Ver tus mensajes';
$lang['Search_unanswered'] = 'Ver mensajes sin respuesta';

$lang['Register'] = 'Registrar';
$lang['Profile'] = 'Perfil';
$lang['Edit_profile'] = 'Perfil';
$lang['Search'] = 'Buscar';
$lang['Memberlist'] = 'Miembros';
$lang['FAQ'] = 'FAQ';
$lang['Viewonline'] = 'En linea';
/*****[BEGIN]******************************************
 [ Mod:     Forum Statistics                   v1.2.2 ]
 ******************************************************/
$lang['Statistics'] = 'Estadisticas';
/*****[END]********************************************
 [ Mod:     Forum Statistics                   v1.2.2 ]
 ******************************************************/
$lang['BBCode_guide'] = 'BBCode Guia';
$lang['Usergroups'] = 'Grupos';
$lang['Last_Post'] = 'Ultimos Mensajes';
/*****[BEGIN]******************************************
 [ Mod:     Resize Posted Images               v2.4.5 ]
 ******************************************************/
$lang['rmw_image_title'] = 'Pulse para ver en Tama&ntilde;o completo';
/*****[END]********************************************
 [ Mod:     Resize Posted Images               v2.4.5 ]
 ******************************************************/
$lang['Moderator'] = 'Moderador';
$lang['Moderators'] = 'Moderadores';
//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Nuestros usuarios han publicado un total de <strong>0</strong> articulos'; // Number of posts
$lang['Posted_articles_total'] = 'Nuestros usuarios han publicado un total de<strong>%d</strong> articulos'; // Number of posts
$lang['Posted_article_total'] = 'Nuestros usuarios han publicado un total de <strong>%d</strong> articulos'; // Number of posts
$lang['Registered_users_zero_total'] = 'Tenemos <strong>0</strong> usuarios registrados'; // # registered users
$lang['Registered_users_total'] = 'Tenemos <strong>%d</strong> usuarios registrados'; // # registered users
$lang['Registered_user_total'] = 'Tenemos <strong>%d</strong> usuarios registrados'; // # registered users
$lang['Newest_user'] = 'El ultimo usuario registrado es <strong>%s%s%s</strong>'; // a href, username, /a

$lang['No_new_posts_last_visit'] = 'No hay mensajes nuevos desde su ultima visita';
$lang['No_new_posts'] = 'Ningun mensaje';
$lang['New_posts'] = 'Nuevos mensajes';
$lang['New_post'] = 'Nuevo mensaje';
$lang['No_new_posts_hot'] = 'No hay nuevos mensajes [ Popular ]';
$lang['New_posts_hot'] = 'Nuevos mensajes [ Popular ]';
$lang['No_new_posts_locked'] = 'Nuevos mensajes [ Bloqueado ]';
$lang['New_posts_locked'] = 'Nuevos mensajes [ Bloqueado ]';
$lang['Forum_is_locked'] = 'Foro bloqueado';
//
// Login
//
$lang['Enter_password'] = 'Escriba su nombre de usuario y Contrase&ntilde;a para iniciar sesion en.';
$lang['Login'] = 'Iniciar sesion';
$lang['Logout'] = 'Cerrar sesion';

$lang['Forgotten_password'] = 'He olvidado mi Contrase&ntilde;a';

$lang['Log_me_in'] = 'Me sesion automaticamente en cada visita';

$lang['Error_login'] = 'Ha especificado un nombre de usuario incorrecto o esta inactivo, o una Contrase&ntilde;a no valida.';
$lang['Wrong Security Code'] = 'El codigo de seguridad especificado no\coincide';
//
// Index page
//
$lang['Index'] = 'Indice';
$lang['No_Posts'] = 'No hay comentarios';
$lang['No_forums'] = 'Esta placa no tiene foros';

$lang['Private_Message'] = 'Mensaje Privado';
$lang['Private_Messages'] = 'Mensajes Privados';
$lang['Who_is_Online'] = 'Quien esta en linea';

$lang['Mark_all_forums'] = ' Marcar todos los foros como leidos ';
$lang['Forums_marked_read'] = 'Todos los foros se han marcado como leidos';
//
// Viewforum
//
$lang['View_forum'] = 'Ver Foro';

$lang['Forum_not_exist'] = 'El foro que ha seleccionado no existe.';
$lang['Reached_on_error'] = 'Yo ha llegado a esta pagina por error.';

$lang['Display_topics'] = 'Mostrar temas anteriores';
$lang['All_Topics'] = 'Todos los temas';

$lang['Topic_Announcement'] = '<strong>Anuncio:</strong>';
$lang['Topic_Sticky'] = '<strong>Adhesivas:</strong>';
$lang['Topic_Moved'] = '<strong>Desplazado:</strong>';
$lang['Topic_Poll'] = '<strong>[ Encuesta ]</strong>';

$lang['Mark_all_topics'] = 'Marcar todos los temas como leidos';
$lang['Topics_marked_read'] = 'Los temas de este foro han sido marcados como leidos';

$lang['Rules_post_can'] = 'Usted <strong>puede</strong> postear nuevos temas en este foro';
$lang['Rules_post_cannot'] = 'Usted <strong>no puede</strong> postear nuevos temas en este foro';
$lang['Rules_reply_can'] = 'Usted <strong>puede</strong> dar respuesta a los temas en este foro';
$lang['Rules_reply_cannot'] = 'Usted <strong>no puesto dar</strong> dar respuesta a los temas en este foro';
$lang['Rules_edit_can'] = 'Usted <strong>puede</strong> editar tus mensajes en este foro';
$lang['Rules_edit_cannot'] = 'Usted <strong>no puede</strong> editar tus mensajes en este foro';
$lang['Rules_delete_can'] = 'Usted <strong>puede</strong> suprimir sus mensajes en este foro';
$lang['Rules_delete_cannot'] = 'Usted <strong>no puede</strong> suprimir sus mensajes en este foro';
$lang['Rules_vote_can'] = 'Usted <strong>puede</strong> votar en las encuestas en este foro';
$lang['Rules_vote_cannot'] = 'Usted <strong>no puede</strong> votar en las encuestas en este foro';
$lang['Rules_moderate'] = 'Usted <strong>puede</strong> %smoderadar este foro%s'; // %s replaced by a href links, do not remove!

$lang['No_topics_post_one'] = 'No hay mensajes en este foro.<br />Haga clic en el <strong>Mensaje nuevo tema</strong> enlace en esta pagina para enviar un.';

//
// Viewtopic
//
$lang['View_topic'] = 'Ver tema';

$lang['Guest'] = 'Invitado';
$lang['Post_subject'] = 'Asunto';
$lang['View_next_topic'] = 'Ver tema siguiente';
$lang['View_previous_topic'] = 'Ver tema anterior';
$lang['Submit_vote'] = 'Enviar Votacion';
$lang['View_results'] = 'Ver Resultados';
$lang['must_first_vote'] = 'En primer lugar, debe votar para ver los resultados de esta encuesta';

$lang['No_newer_topics'] = 'No hay nuevos temas en este foro';
$lang['No_older_topics'] = 'No hay mayores temas en este foro';
$lang['Topic_post_not_exist'] = 'El tema o mensaje que usted solicito no existe';
$lang['No_posts_topic'] = 'No existen mensajes para este tema';

$lang['Display_posts'] = 'Mostrar mensajes de anteriores';
$lang['All_Posts'] = 'Todos los mensajes';
$lang['Newest_First'] = 'El mas reciente primero';
$lang['Oldest_First'] = 'El mas antiguo primero';

$lang['Back_to_top'] = 'Volver arriba';

$lang['Read_profile'] = 'Ver usuario(s)\perfil';
$lang['Visit_website'] = 'Visita cartel(s)\ Sitio web';
$lang['ICQ_status'] = 'ICQ Estado';
$lang['Edit_delete_post'] = 'Editar/Eliminar este mensaje';
$lang['View_IP'] = 'Ver la direccion IP del cartel';
$lang['Delete_post'] = 'Eliminar este mensaje';

$lang['wrote'] = 'wrote'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Quote'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.
/*****[BEGIN]******************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
$lang['PHPCode'] = 'PHP'; // PHP MOD
/*****[END]********************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/

$lang['Edited_time_total'] = 'Ultima editado por %s en %s; editado %d tiempo en el total de'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'ultima editado por %s en %s; editado %d tiempo en el total de'; // Last edited by me on 12 Oct 2001; edited 2 times in total

$lang['Lock_topic'] = 'Bloquear este tema';
$lang['Unlock_topic'] = 'Desbloquear este tema';
$lang['Move_topic'] = 'Mover este tema';
$lang['Delete_topic'] = 'Eliminar este tema';
$lang['Split_topic'] = 'Dividir este tema';
$lang['Merge_topics'] = 'Combinar este tema';

$lang['Stop_watching_topic'] = 'Dejar de vigilar este tema';
$lang['Start_watching_topic'] = 'Mira este tema para las respuestas';
$lang['No_longer_watching'] = 'Usted ya no estan viendo este tema';
$lang['You_are_watching'] = 'Ahora esta viendo este tema';

$lang['Total_votes'] = 'Total Votos';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Cuerpo del mensaje';
$lang['Topic_review'] = 'Examen del tema';

$lang['No_post_mode'] = 'No post mode specified'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = 'Publicar un nuevo tema';
$lang['Post_a_reply'] = 'Publicar una respuesta';
$lang['Post_topic_as'] = 'Publicar tema como';
$lang['Edit_Post'] = 'Editar mensaje';
$lang['Options'] = 'Opciones';

$lang['Post_Announcement'] = 'Anuncio';
$lang['Post_Sticky'] = 'Adhesivas';
$lang['Post_Normal'] = 'Normal';

$lang['Confirm_delete'] = 'Estas seguro de que desea eliminar este mensaje?';
$lang['Confirm_delete_poll'] = 'Estas seguro de que deseas suprimir esta encuesta?';

$lang['Flood_Error'] = 'Usted no puede hacer otro mensaje tan pronto despues de la ultima vez, por favor, intentelo de nuevo en un corto periodo de tiempo.';
$lang['Empty_subject'] = 'Debe especificar un tema al publicar un nuevo tema.';
$lang['Empty_message'] = 'Debe introducir un mensaje al publicar.';
$lang['Forum_locked'] = 'Este foro esta cerrado y no puede publicar, responder o editar temas.';
$lang['Topic_locked'] = 'Este tema esta cerrado y no puede editar mensajes o respuestas.';
$lang['No_post_id'] = 'Debe seleccionar un mensaje para editar';
$lang['No_topic_id'] = 'Usted debe seleccionar un tema para responder a';
$lang['No_valid_mode'] = 'Solo se puede publicar, responder, editar o citar mensajes. Por favor, regrese y vuelva a intentarlo.';
$lang['No_such_post'] = 'No existe tal mensaje. Por favor, regrese y vuelva a intentarlo.';
$lang['Edit_own_posts'] = 'Lo sentimos, pero solo puede editar sus propios mensajes.';
$lang['Delete_own_posts'] = 'Lo sentimos, pero solo se puede borrar sus propios mensajes.';
$lang['Cannot_delete_replied'] = 'Lo sentimos, pero no puede eliminar los mensajes que se han contestado.';
$lang['Cannot_delete_poll'] = 'Lo sentimos, pero no se puede borrar una encuesta activa.';
$lang['Empty_poll_title'] = 'Debe introducir un titulo para el sondeo.';
$lang['To_few_poll_options'] = 'Debe introducir al menos dos opciones de encuesta.';
$lang['To_many_poll_options'] = 'Ha intentado entrar demasiadas opciones de encuesta.';
$lang['Post_has_no_poll'] = 'Este mensaje no tiene ninguna encuesta.';
$lang['Already_voted'] = 'Usted ya ha votado en esta encuesta.';
$lang['No_vote_option'] = 'Debe especificar una opcion ha la hora de votar.';

$lang['Add_poll'] = 'Agregar una encuesta';
$lang['Add_poll_explain'] = 'Si no desea agregar una encuesta a su tema, deje los campos en blanco.';
$lang['Poll_view_toggle_explain'] = '[ Permite al usuario ver los resultados antes de votar. ]';
$lang['Poll_question'] = 'Cuestion de la encuesta';
$lang['Poll_option'] = 'Opcion de sondeo';
$lang['Add_option'] = 'Agregar opcion';
$lang['Update'] = 'Actualizar';
$lang['Delete'] = 'Borrar';
$lang['Poll_for'] = 'Ejecutar la encuesta para';
$lang['Poll_view_toggle'] = 'Permitir vista';
$lang['Days'] = 'Dias'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Entrar 0 o dejelo en blanco para una encuesta interminable ]';
$lang['Delete_poll'] = 'Eliminar la encuesta';

$lang['Disable_HTML_post'] = 'Desactivar HTML en este mensaje';
$lang['Disable_BBCode_post'] = 'Deshabilitar BBCode en este mensaje';
$lang['Disable_Smilies_post'] = 'Deshabilitar Smilies en este mensaje';

$lang['HTML_is_ON'] = 'HTML es <u>ACTIVADO</u>';
$lang['HTML_is_OFF'] = 'HTML es <u>DESACTIVADO</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s es <u>ACTIVADO</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s es <u>DESACTIVADO</u>';
$lang['Smilies_are_ON'] = 'Las caritas son <u>ACTIVADO</u>';
$lang['Smilies_are_OFF'] = 'Las caritas son <u>DESACTIVADO</u>';

$lang['Attach_signature'] = 'Adjuntar firma (la firma puede ser cambiada en el perfil)';
$lang['Notify'] = 'Notificarme cuando se publique una respuesta';

$lang['Stored'] = 'Su mensaje se ha introducido con exito.';
$lang['Deleted'] = 'Su mensaje se ha eliminado con exito.';
$lang['Poll_delete'] = 'Su encuesta se ha eliminado con exito.';
$lang['Vote_cast'] = 'Su voto ha sido emitidos.';

$lang['Topic_reply_notification'] = 'Tema Responder Notificacion';

$lang['glance_news_heading'] = 'Ultimas Noticias del Sitio';
$lang['glance_recent_heading'] = 'Temas recientes';
$lang['glance_next'] = 'Siguiente';
$lang['glance_previous'] = 'Anterior';
$lang['glance_none'] = 'Ninguna Noticias';

//
// Private Messaging
//
$lang['Private_Messaging'] = 'MensajerIa Privada';

$lang['Login_check_pm'] = 'Entre para ver sus mensajes privados';
$lang['New_pms'] = '%d mensajes nuevos'; // You have 2 new messages
$lang['New_pm'] = '%d mensajes nuevos'; // You have 1 new message
$lang['No_new_pm'] = 'Ningun mensaje';
$lang['Unread_pms'] = '%d mensajes no leidos';
$lang['Unread_pm'] = '%d mensaje no leido';
$lang['No_unread_pm'] = 'Ningun mensajes no leidos';
$lang['You_new_pm'] = '%d nuevo mensaje privado';// You have 1 new message
$lang['You_new_pms'] = '%d nuevo mensajes privados';// You have 2 new messages
$lang['You_no_new_pm'] = 'Ningun nuevo mensajes privados';

$lang['Unread_message'] = 'Mensajes no leidos';
$lang['Read_message'] = 'Leer mensaje';

$lang['Read_pm'] = 'Leer mensaje';
$lang['Post_new_pm'] = 'Publicar mensaje';
$lang['Post_reply_pm'] = 'Responder a un mensaje';
$lang['Post_quote_pm'] = 'Citar el mensaje';
$lang['Edit_pm'] = 'Editar mensaje';

$lang['Inbox'] = 'Entrada';
$lang['Outbox'] = 'Salida';
$lang['Savebox'] = 'Guardar cuadro';
$lang['Sentbox'] = 'Enviado cuadro';
$lang['Flag'] = 'Bandera';
$lang['Subject'] = 'Tema';
$lang['From'] = 'Desde';
$lang['To'] = 'a';
$lang['Date'] = 'Fecha';
$lang['Mark'] = 'Marca';
$lang['Sent'] = 'Enviado';
$lang['Saved'] = 'Guardado';
$lang['Delete_marked'] = 'Eliminar Marcado';
$lang['Delete_all'] = 'Borrar Todos';
$lang['Save_marked'] = 'Guardar Marcado';
$lang['Save_message'] = 'Guardar mensaje';
$lang['Delete_message'] = 'Eliminar mensaje';

$lang['Display_messages'] = 'Mostrar mensajes de anteriores'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Todos los mensajes';

$lang['No_messages_folder'] = 'Usted no tiene mensajes en esta carpeta';

$lang['PM_disabled'] = 'Privados de mensajeria se ha inhabilitado en este foro.';
$lang['Cannot_send_privmsg'] = 'Lo sentimos, pero el administrador le ha impedido el envio de mensajes privados.';
$lang['No_to_user'] = 'Debe especificar un nombre de usuario a los que enviar este mensaje.';
$lang['No_such_user'] = 'Lo sentimos, pero no existe tal usuario.';

$lang['Disable_HTML_pm'] = 'Desactivar HTML en este mensaje';
$lang['Disable_BBCode_pm'] = 'Deshabilitar BBCode en este mensaje';
$lang['Disable_Smilies_pm'] = 'Deshabilitar Smilies en este mensaje';

$lang['Message_sent'] = 'Su mensaje ha sido enviado.';

$lang['Click_return_inbox'] = 'Presione %sAqui%s para regresar a tu bandeja de entrada';
$lang['Click_return_index'] = 'Presione %sAqui%s para volver al indice';
$lang['Click_return_profile'] = 'Presione %sAqui%s para volver a su perfil';

$lang['Send_a_new_message'] = 'Enviar un nuevo mensaje privado';
$lang['Send_a_reply'] = 'Responder a un mensaje privado';
$lang['Edit_message'] = 'Editar mensaje privado';

$lang['Notification_subject'] = 'Nuevo mensaje privado ha llegado!';

$lang['Find_username'] = 'Buscar un nombre de usuario';
$lang['Find'] = 'Buscar';
$lang['No_match'] = 'No se han encontrado resultados.';

$lang['No_post_id'] = 'Nigun mensaje ID Se ha especificado';
$lang['No_such_folder'] = 'No existe tal carpeta';
$lang['No_folder'] = 'Niguna carpeta especificada';

$lang['Mark_all'] = 'Marcar todos';
$lang['Unmark_all'] = 'Desmarcar todos';

$lang['Confirm_delete_pm'] = 'Estas seguro de que desea eliminar este mensaje?';
$lang['Confirm_delete_pms'] = 'Estas seguro de que desea eliminar estos mensajes?';

$lang['Inbox_size'] = 'Bandeja esta %d%% lleno'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Enviados esta %d%% lleno';
$lang['Savebox_size'] = 'Guardado esta %d%% lleno';

$lang['Click_view_privmsg'] = 'Presione %sAqui%s visitar a tu bandeja de entrada';
//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Viendo perfil :: %s'; // %s is username
$lang['About_user'] = 'Todo acerca de %s'; // %s is username
/*****[BEGIN]******************************************
 [ Mod:    User Administration Link on Profile v1.0.0 ]
 ******************************************************/
$lang['User_admin_for'] = 'Administracion de usuario';
/*****[END]********************************************
 [ Mod:    User Administration Link on Profile v1.0.0 ]
 ******************************************************/

$lang['Preferences'] = 'Preferencias';
$lang['Items_required'] = 'Articulos marcados con * son obligatorios a menos que se indique lo contrario.';
$lang['Registration_info'] = 'Informacion de Registro';
$lang['Profile_info'] = 'Informacion del perfil';
$lang['Profile_info_warn'] = 'Esta informacion se puede ver publicamente';
$lang['Avatar_panel'] = 'Panel de control de Avatar';
$lang['Avatar_gallery'] = 'Galeria de Avatar';

$lang['Website'] = 'Sitio Web';
$lang['Location'] = 'Pais';
$lang['Contact'] = 'Contacto';
$lang['Email_address'] = 'Direccion de Correo';
$lang['Send_private_message'] = 'Enviar mensaje privado';
$lang['Hidden_email'] = '[ Oculto ]';
$lang['Interests'] = 'Intereses';
$lang['Occupation'] = 'Occupacion';
$lang['Poster_rank'] = 'Rango de cartel';

$lang['Total_posts'] = 'Total de mensajes';
$lang['User_post_pct_stats'] = '%.2f%% del total'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f mensajes por dia'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Buscar todos los mensajes de %s'; // Find all posts by username

$lang['No_user_id_specified'] = 'Lo sentimos, pero ese usuario no existe.';
$lang['Wrong_Profile'] = 'No se puede modificar un perfil que no es su propio perfil.';

$lang['Only_one_avatar'] = 'Solo un tipo de avatar se puede especificar';
$lang['File_no_data'] = 'El archivo en la URL que ha proporcionado no contiene datos';
$lang['No_connection_URL'] = 'Una conexion no puede hacerse a la direccion URL que le dio';
$lang['Incomplete_URL'] = 'La URL que ha introducido es incompleta';
$lang['Wrong_remote_avatar_format'] = 'El URL del avatar remoto no es valido';
$lang['No_send_account_inactive'] = 'Lo sentimos, pero tu contrase&ntilde;a no se puede recuperar debido a que su cuenta esta actualmente inactiva. Por favor, pongase en contacto con el administrador del foro para mas informacion.';

$lang['Always_smile'] = 'Siempre permitir Emoticones';
$lang['Always_html'] = 'Siempre permitir HTML';
$lang['Always_bbcode'] = 'Siempre permitir BBCode';
$lang['Always_add_sig'] = 'Siempre adjuntar mi firma';
$lang['Always_notify'] = 'Siempre notificarme de respuestas';
$lang['Always_notify_explain'] = 'Envia un correo electronico cuando alguien responde a un tema que han publicado pulg Esto puede ser cambiado cada vez que cargo.';

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$lang['Word_Wrap'] = 'Ancho de la Pantalla';
$lang['Word_Wrap_Explain'] = 'Este es la longitud m&aacute;xima lineal del mensaje del miembro.';
$lang['Word_Wrap_Extra'] = 'caracteres (rango: %min% - %max% caracteres.)';
$lang['Word_Wrap_Error'] = 'El ancho del mensaje est&aacute; fuera del rango.';
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/

$lang['Board_style'] = "Estilo del Foro";
$lang['Board_lang'] = "Idioma del Foro";
$lang['No_themes'] = "No hay temas en la base de datos";
$lang['Timezone'] = "Zona horaria";
$lang['Date_format'] = "Formato de Fecha";
$lang['Date_format_explain'] = "La sintaxis usada es id&eacute;ntica a la funci&oacute;n <a href=\"http://www.php.net/date\" target=\"_other\">date()</a> de PHP";
$lang['Signature'] = "Firma";
$lang['Signature_explain'] = "Este es un bloque de texto que se puede agregar a los mensajes que publique. Existe un l&iacute;mite de %d caracteres";
$lang['Public_view_email'] = "Mostrar siempre mi Email";

$lang['Current_password'] = "Contrase&ntilde;a actual";
$lang['New_password'] = "Nueva contrase&ntilde;a";
$lang['Confirm_password'] = "Confirmar contrase&ntilde;a";
$lang['Confirm_password_explain'] = "Debe confirmar su actual contrase&ntilde;a si desea cambiar esta o su direcci&oacute;n de correo electr&oacute;nico";
$lang['password_if_changed'] = "Solo debe ingresar una contrase&ntilde;a si desea cambiarla";
$lang['password_confirm_if_changed'] = "Solo necesita confirmar su contrase&ntilde;a si la cambi&oacute; arriba";

$lang['Avatar'] = 'Avatar';
/*****[BEGIN]******************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/
$lang['Avatar_explain'] = "Muestra una peque&ntilde;a imagen bajo sus detalles en los mensajes. Solo una imagen puede ser mostrada a la vez, su ancho no puede ser mayor que %d pixels, y su altura no mayor que %d pixels y el tama&ntilde;o de archivo no mas de %dkB."; $lang['Upload_Avatar_file'] = "Enviar Avatar desde su PC";
/*****[END]********************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/
$lang['Upload_Avatar_file'] = 'Enviar Avatar desde tu PC';
$lang['Upload_Avatar_URL'] = "Enviar Avatar desde un URL";
$lang['Upload_Avatar_URL_explain'] = "Escriba el URL donde se encuentra el archivo de imagen de su Avatar, ser&aacute; copiado a este sitio.";
$lang['Pick_local_Avatar'] = "Seleccionar Avatar de la galer&iacute;a";
$lang['Link_remote_Avatar'] = "Vincular a un Avatar fuera de este sitio";
$lang['Link_remote_Avatar_explain'] = "Escriba el URL donde se encuentra el archivo de imagen de su Avatar.";
$lang['Avatar_URL'] = "URL de imagen de Avatar";
$lang['Select_from_gallery'] = "Seleccionar Avatar de nuestra galer&iacute;a";
$lang['View_avatar_gallery'] = "Mostrar Galer&iacute;a";

$lang['Select_avatar'] = "Seleccionar avatar";
$lang['Return_profile'] = "Cancelar avatar";
$lang['Select_category'] = "Seleccionar categor&iacute;a";

$lang['Delete_Image'] = "Borrar Imagen";
$lang['Current_Image'] = "Imagen Actual";

$lang['Notify_on_privmsg'] = "Notificarme por nuevos Mensajes Privados";
$lang['Popup_on_privmsg'] = "Desplegar nueva ventana cuando hay Mensajes Privados";
$lang['Popup_on_privmsg_explain'] = "Algunas plantillas pueden abrir una nueva ventana para informarle cuando ha recibido nuevos mensajes privados"; 
$lang['Hide_user'] = "Ocultar su estado en linea";

$lang['Profile_updated'] = "Su perfil ha sido actualizado";
$lang['Profile_updated_inactive'] = "Su perfil ha sido actualizado, sin embargo, ha cambiado detalles importantes y su cuenta ha sido desactivada. Revise su email para averiguar como reactivar su cuenta, o si es necesaria la activaci&oacute;n del Administrador espere a que este reactive su cuenta";

$lang['Password_mismatch'] = "Las contrase&ntilde;as que ingres&oacute; no coinciden";
$lang['Current_password_mismatch'] = "La contrase&ntilde;a que ingres&oacute; no coincide con la que est&aacute; almacenada en la base de datos";
$lang['Password_long'] = "Su contrase&ntilde;a no debe contener m&aacute;s de 32 caracteres";
$lang['Username_taken'] = "Lo lamentamos pero este nombre de usuario ya est&aacute; en uso";
$lang['Username_invalid'] = "El nombre de usuario contiene un caracter inv&aacute;lido como \"";
$lang['Username_disallowed'] = "Disculpe, este nombre de usuario est&aacute; restringido";
$lang['Email_taken'] = "Lo lamentamos pero esta direcci&oacute;n de correo electr&oacute;nico ya ha sido registrada por un usuario";
$lang['Email_banned'] = "Disculpe, esta direcci&oacute;n de correo electr&oacute;nico ha sido baneada";
$lang['Email_invalid'] = "La direcci&oacute;n de correo electr&oacute;nico ingresada es inv&aacute;lida";
$lang['Signature_too_long'] = "La firma es muy larga";
$lang['Fields_empty'] = "Debe completar los campos obligatorios";
$lang['Avatar_filetype'] = "El tipo de imagen del avatar debe ser .jpg, .gif o .png";
$lang['Avatar_filesize'] = "El tama&ntilde;o de archivo del avatar debe ser menor de %d kB"; // El tama&ntilde;o de archivo del avatar debe ser menor de 6 kB
$lang['Avatar_imagesize'] = "El avatar debe tener menos de %d pixels de ancho por %d pixels de alto"; 

$lang['Welcome_subject'] = "Bienvenido a los Foros de %s"; // Bienvenido a los Foros de Nombre de Sitio
$lang['New_account_subject'] = "Nueva cuenta de usuario";
$lang['Account_activated_subject'] = "Cuenta Activada";

$lang['Account_added'] = "Gracias por registrarse, su cuenta ha sido creada. Ahora puede entrar con su nombre de usuario y contrase&ntilde;a";
$lang['Account_inactive'] = "Su cuenta ha sido creada. Sin embargo, este foro requiere activaci&oacute;n de la cuenta, una clave de activaci&oacute;n se ha enviado a su email. Por favor revise su email para mas informaci&oacute;n";
$lang['Account_inactive_admin'] = "Su cuenta ha sido creada. Sin embargo, este foro requiere activaci&oacute;n del Administrador. Un email ha sido enviado al Administrador y Usted ser&aacute; informado cuando su cuenta haya sido activada";
$lang['Account_active'] = "Su cuenta ha sido activada. Gracias por registrarse";
$lang['Account_active_admin'] = "La cuenta ha sido activada";
$lang['Reactivate'] = "&iexcl;Reactive su cuenta!";
$lang['Already_activated'] = 'Ya ha activado su cuenta';
$lang['COPPA'] = "Su cuenta ha sido creada pero debe ser aprobada, por favor revise su email por mayores detalles.";

$lang['Registration'] = "Condiciones de Registro";
$lang['Reg_agreement'] = "Aun cuando los administradores y moderadores de estos foros har&aacute;n todo lo posible por remover  cualquier material cuestionable tan pronto como sea posible, es imposible revisar todos los mensajes. Por lo tanto Usted acepta que todos los mensajes publicados en estos foros expresan las opiniones de sus autores y no la de los administradores, moderadores o el webmaster (excepto en mensajes publicados por ellos mismos) por lo cual no se les considerar&aacute; responsables.<br /><br />Usted est&aacute; de acuerdo en no publicar material abusivo, obsceno, vulgar, de odio, amenazante, orientado sexualmente, o ningun otro que de alguna forma viole leyes vigentes. Si publicase material de esa &iacute;ndole su cuenta de acceso al foro ser&aacute; cancelada y su proveedor de Acceso a Internet ser&aacute; informado. La direcci&oacute;n IP de todos los mensajes es guardada para ayudar a cumplir estas normas. Usted est&aacute; de acuerdo en que el webmaster, administrador y moderadores de este Foro tienen el derecho de borrar, editar, mover o cerrar cualquier tema en cualquier momento si lo consideran conveniente. Como usuario Usted acepta que toda la informaci&oacute;n que ingrese sea almacenada en una base de datos. Aun cuando esta informaci&oacute;n no ser&aacute; proporcionada a terceros sin su consentimiento, el webmaster, administrador y moderadores no pueden responsabilizarse por intentos de hackers que puedan llevar a que esta informaci&oacute;n se vea comprometida.<br /><br />Este sistema de foros utiliza cookies para almacenar informaci&oacute;n en su computadora local. Estos cookies no contienen la informaci&oacute;n que Usted ha ingresado, solamente se utilizan para mejorar la visualizaci&oacute;n de los foros. El email solamente es usado para confirmar sus detalles de registro y contrase&ntilde;a (y para enviar nuevas contrase&ntilde;as si olvida la actual).<br /><br />Al registrarse Usted aceptar&aacute; todas estas condiciones.";

$lang['Agree_under_13'] = "Estoy de acuerdo con estas condiciones y soy <b>menor</b> de 13 a&ntilde;os de edad";
$lang['Agree_over_13'] = "Estoy de acuerdo con estas condiciones y soy <b>mayor</b> de 13 a&ntilde;os de edad";
$lang['Agree_not'] = "No estoy de acuerdo con estas condiciones";

$lang['Wrong_activation'] = "La clave de activaci&oacute;n suministrada no coincide con ninguna en la base de datos";
$lang['Send_password'] = "Enviarme una nueva contrase&ntilde;a"; 
$lang['Password_updated'] = "Se ha creado una nueva contrase&ntilde;a, por favor revise su email por detalles sobre como activarla";
$lang['No_email_match'] = "El email suministrado no coincide con el de ese nombre de usuario";
$lang['New_password_activation'] = "Activaci&oacute;n de nueva contrase&ntilde;a";
$lang['Password_activated'] = "Su cuenta ha sido re-activada. Para entrar use la contrase&ntilde;a provista en el email que recibi&oacute;";

$lang['Send_email_msg'] = "Enviar un email";
$lang['No_user_specified'] = "No se especific&oacute; usuario";
$lang['User_prevent_email'] = "Este usuario no desea recibir email. Intente enviarle un mensaje privado";
$lang['User_not_exist'] = "Ese usuario no existe";
$lang['CC_email'] = "Enviar una copia de este mensaje a Usted";
$lang['Email_message_desc'] = "Este mensaje ser&aacute; enviado como texto simple, no incluya HTML ni BBCode. La direcci&oacute;n de respuesta para este mensaje ser&aacute; su email.";
$lang['Flood_email_limit'] = "No puede enviar otro email en este momento, intentelo mas tarde";
$lang['Recipient'] = "Destinatario";
$lang['Email_sent'] = "El email ha sido enviado";
$lang['Send_email'] = "Enviar email";
$lang['Empty_subject_email'] = "Debe especificar un asunto para el email";
$lang['Empty_message_email'] = "Debe ingresar un mensaje para ser enviado";

$lang['Login_attempts_exceeded'] = 'El n&uacute;mero m&aacute;ximo de intentos de conexi&oacute;n ha sido excedido. No se le permitir&aacute; conectarse en los siguientes %s minutos.';
$lang['Please_remove_install_contrib'] = 'Por favor aseg&uacute;rese de haber eliminado los directorios install/ y contrib/';
$lang['Session_invalid'] = 'Sessi&oacute;n Invalida. Por Favor reenvia el formulario.';

//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'El c&oacute;digo de confirmaci&oacute;n ingresado fue incorrecto';
$lang['Too_many_registers'] = 'Has excedido el n&uacute;mero de intentos de registro para esta sesi&oacute;n. Por favor intente m&aacute;s tarde.';
$lang['Confirm_code_impaired'] = 'Si est&aacute;s visualmente impedido o no puedes leer este c&oacute;digo, por favor contacte al %sAdministrador%s para ayuda.';
$lang['Confirm_code'] = 'C&oacute;digo de Confirmaci&oacute;n';
$lang['Confirm_code_explain'] = 'Ingrese el c&oacute;digo exactamente como lo ve. El c&oacute;digo es sensible y el cero tiene una linea diagonal a trav&eacute;s de &eacute;l.';

//
// Memberslist
//
$lang['Select_sort_method'] = "Ordenar por";
$lang['Sort'] = "Ordenar";
$lang['Sort_Top_Ten'] = "Los 10 autores que m&aacute;s escriben";
$lang['Sort_Joined'] = "Fecha de Registro";
$lang['Sort_Username'] = "Nombre de usuario";
$lang['Sort_Location'] = "Ubicaci&oacute;n";
$lang['Sort_Posts'] = "Cantidad de mensajes";
$lang['Sort_Email'] = "Email";
$lang['Sort_Website'] = "Sitio Web";
$lang['Sort_Ascending'] = "Ascendente";
$lang['Sort_Descending'] = "Descendente";
$lang['Order'] = "Orden";
//
// Group control panel
//
$lang['Group_Control_Panel'] = "Panel de Control de Grupo";
$lang['Group_member_details'] = "Detalles de Membres&iacute;a de Grupo";
$lang['Group_member_join'] = "Unirse a Grupo";

$lang['Group_Information'] = "Informaci&oacute;n de Grupo";
$lang['Group_name'] = "Nombre de Grupo";
$lang['Group_description'] = "Descripci&oacute;n de Grupo";
$lang['Group_membership'] = "Membres&iacute;a de Grupo";
$lang['Group_Members'] = "Miembros de Grupo";
$lang['Group_Moderator'] = "Moderador de Grupo";
$lang['Pending_members'] = "Miembros Pendientes";

$lang['Group_type'] = "Tipo de Grupo";
$lang['Group_open'] = "Grupo Abierto";
$lang['Group_closed'] = "Grupo Cerrado";
$lang['Group_hidden'] = "Grupo Oculto";

$lang['Current_memberships'] = "Membres&iacute;as actuales";
$lang['Non_member_groups'] = "Grupos donde no es miembro";
$lang['Memberships_pending'] = "Membres&iacute;as pendientes";

$lang['No_groups_exist'] = "No existen Grupos";
$lang['Group_not_exist'] = "Ese grupo no existe";

$lang['Join_group'] = "Unirse a Grupo";
$lang['No_group_members'] = "Este grupo no tiene miembros";
$lang['Group_hidden_members'] = "Esta grupo est&aacute; oculto, no puede ver su membres&iacute;a";
$lang['No_pending_group_members'] = "Este grupo no tiene miembros pendientes";
$lang["Group_joined"] = "Subscripci&oacute;n a grupo exitosa <br />Usted ser&aacute; notificado cuando su subscripci&oacute;n sea aprobada por el moderador del grupo";
$lang['Group_request'] = "Se ha realizado un pedido para unirse al grupo";
$lang['Group_approved'] = "Su pedido ha sido aprobado";
$lang['Group_added'] = "Usted ha sido agregado a este grupo"; 
$lang['Already_member_group'] = "Usted ya es miembro de este grupo";
$lang['User_is_member_group'] = "El usuario ya es miembro de este grupo";
$lang['Group_type_updated'] = "Tipo de grupo actualizado con &eacute;xito";

$lang['Could_not_add_user'] = 'El usuario seleccionado no existe..';
$lang['Could_not_anon_user'] = 'Puede hacer Anonimo un miembro del grupo.';

$lang['Confirm_unsub'] = 'Confirma que desea cancelar la suscripcion de este grupo?';
$lang['Confirm_unsub_pending'] = 'La suscripcion a este grupo aun no ha sido aprobada; estas seguro de que desea cancelar la suscripcion?';

$lang['Unsub_success'] = 'Usted ha sido suscrito ha este grupo.';

$lang['Approve_selected'] = 'Aprobar seleccionados';
$lang['Deny_selected'] = 'Denegar seleccionados';
$lang['Not_logged_in'] = 'Debe estar conectado en a unirse a un grupo.';
$lang['Remove_selected'] = 'Quitar seleccionado';
$lang['Add_member'] = 'Agregar miembro';
$lang['Not_group_moderator'] = 'No eres moderador de este grupo, por lo tanto, no puede realizar esa accion.';

$lang['Login_to_join'] = 'Registrate para unirte a los miembros del grupo o administrar';
$lang['This_open_group'] = 'Este es un grupo abierto: haga clic para solicitar la adhesion';
/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
//$lang['This_closed_group'] = 'This is a closed group: no more users accepted';
//$lang['This_hidden_group'] = 'This is a hidden group: automatic user addition is not allowed';
$lang['This_closed_group'] = 'Este es un Grupo Cerrado: %s';
$lang['This_hidden_group'] = 'Este es un Grupo Oculto: %s';
$lang['No_more'] = 'no se aceptan m&aacute;s usuarios';
$lang['No_add_allowed'] = 'la adici&oacute;n autom&aacute;tica de usuarios no esta activada';
$lang['Join_auto'] = 'Tu podrias unirte a este grupo, despu&eacute;s que el criterio del grupo te permita unirte seg&uacute;n tu conteno de mensajes';
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
$lang['Member_this_group'] = 'Usted es un miembro de este grupo';
$lang['Pending_this_group'] = 'Su composicion de este grupo esta pendiente';
$lang['Are_group_moderator'] = 'Usted es el moderador de grupo';
$lang['None'] = 'Ninguno';

$lang['Subscribe'] = 'Suscribirse';
$lang['Unsubscribe'] = 'Cancelar la suscripcion';
$lang['View_Information'] = 'Ver la informacion';
//
// Search
//
$lang['Search_query'] = 'Consulta de busqueda';
$lang['Search_options'] = 'Opciones de busqueda';

$lang['Search_keywords'] = 'Busqueda de palabras clave';
$lang['Search_keywords_explain'] = 'Puede utilizar <u>AND</u> para definir palabras que deben estar en los resultados, <u>O</u> para definir palabras que pueden estar en los resultados y <u>NO</u> para definir palabras que no deben estar en los resultados. Use * como un comodin para comparaciones parciales';
$lang['Search_author'] = 'Buscar por Autor';
$lang['Search_author_explain'] = 'Use * como un comodin para comparaciones parciales';

$lang['Search_for_any'] = 'Buscar cualquiera de los terminos o usar consulta tal como se escribio';
$lang['Search_for_all'] = 'Buscar todas las palabras';
$lang['Search_title_msg'] = 'Buscar en titulos y texto del mensaje';
$lang['Search_msg_only'] = 'Busqueda de texto del mensaje solo';

$lang['Return_first'] = 'Mostrar los primeros'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'caracteres de los mensajes';

$lang['Search_previous'] = 'Buscar anterior'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Ordenar por';
$lang['Sort_Time'] = 'Tiempo despues';
$lang['Sort_Post_Subject'] = 'Asunto Publicado';
$lang['Sort_Topic_Title'] = 'Tema Titulo';
$lang['Sort_Author'] = 'Autor';
$lang['Sort_Forum'] = 'Foro';

$lang['Display_results'] = 'Mostrar resultados como';
$lang['All_available'] = 'Todos los disponibles';
$lang['No_searchable_forums'] = 'Usted no tiene permisos para buscar cualquier foro en este sitio.';

$lang['No_search_match'] = 'Ningun temas ni tampoco los mensajes reunio los criterios de busqueda';
$lang['Found_search_match'] = 'Busqueda encontrado %d coincidir'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'Busqueda encontrado %d coincide con'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'Usted no puede hacer otra busqueda tan pronto despues de la ultima vez, por favor, intentelo de nuevo en poco tiempo.';

$lang['Close_window'] = 'Cerrar Ventana';

//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = "Lo sentimos pero solo %s pueden publicar anuncios en este foro";
$lang['Sorry_auth_sticky'] = "Lo sentimos pero solo %s pueden publicar PostIt en este foro"; 
$lang['Sorry_auth_read'] = "Lo sentimos pero solo %s pueden leer temas en este foro"; 
$lang['Sorry_auth_post'] = "Lo sentimos pero solo %s pueden publicar temas en este foro"; 
$lang['Sorry_auth_reply'] = "Lo sentimos pero solo %s pueden responder a mensajes en este foro"; 
$lang['Sorry_auth_edit'] = "Lo sentimos pero solo %s pueden editar mensajes en este foro"; 
$lang['Sorry_auth_delete'] = "Lo sentimos pero solo %s pueden borrar mensajes en este foro"; 
$lang['Sorry_auth_vote'] = "Lo sentimos pero solo %s pueden votar en encuestas en este foro"; 

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = "<b>usuarios an&oacute;nimos</b>";
$lang['Auth_Registered_Users'] = "<b>miembros registrados</b>";
$lang['Auth_Users_granted_access'] = "<b>miembros con acceso especial</b>";
$lang['Auth_Moderators'] = "<b>Moderadores</b>";
$lang['Auth_Administrators'] = "<b>Administradores</b>";

$lang['Not_Moderator'] = "Usted no es moderador en este foro";
$lang['Not_Authorised'] = "No Autorizado";

$lang['You_been_banned'] = "Se le ha restringido el acceso a este foro<br />Por favor contacte al webmaster o al administrador del foro para mayor informaci&oacute;n";
//
// Viewonline
//
$lang['Reg_users_zero_online'] = 'Hay 0 Usuarios registrados y '; // There are 5 Registered and
$lang['Reg_users_online'] = 'Hay %d Usuarios registrados y '; // There are 5 Registered and
$lang['Reg_user_online'] = 'Hay %d Usuarios registrados y '; // There is 1 Registered and
$lang['Hidden_users_zero_online'] = '0 Usuarios ocultos en linea'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d Usuarios ocultos en linea'; // 6 Hidden users online
$lang['Hidden_user_online'] = '%d Usuario oculto en linea'; // 6 Hidden users online
$lang['Guest_users_online'] = 'Hay %d Usuarios invitados en linea'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = 'Hay 0 Usuarios invitados en linea'; // There are 10 Guest users online
$lang['Guest_user_online'] = 'Hay %d Usuarios invitados en linea'; // There is 1 Guest user online
$lang['No_users_browsing'] = 'No hay actualmente usuarios viendo este foro';

/*****[BEGIN]******************************************
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/
$lang['Online_explain'] = 'Estos datos estan basados en usuarios activos durante los ultimos ' . ( ($board_config['online_time']/60)%60 ) . ' minutes';
$lang['Statistic_last_updated'] = 'Estadistica actualizada por ultima vez en';
/*****[END]********************************************
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/

$lang['Forum_Location'] = 'Ubicacion del Foro';
$lang['Last_updated'] = 'Ultima Actualizacion';

$lang['Forum_index'] = 'Foros de discusion';
$lang['Logging_on'] = 'Inicio de sesion';
$lang['Posting_message'] = 'Envio de un mensaje';
$lang['Searching_forums'] = 'Busqueda en el Foro';
$lang['Viewing_profile'] = 'Ver Perfil';
$lang['Viewing_online'] = 'Ver Quien esta en linea';
$lang['Viewing_member_list'] = "Viendo lista de miembros";
$lang['Viewing_priv_msgs'] = "Viendo mensajes privados";
$lang['Viewing_FAQ'] = "Viendo FAQ";

/*****[BEGIN]******************************************
 [ Mod:    Who is Online Location Fix          v0.9.1 ]
 ******************************************************/
$lang['Viewing_groupcp'] = 'Grupo de Visualizacion de Panel de control';
$lang['Viewing_rules'] = 'Visualizacion de Reglas de la Junta';
$lang['Viewing_stats'] = 'Visualizacion de estadisticas';
$lang['Viewing_ranks'] = 'Visualizacion de las categorias';
/*****[END]********************************************
 [ Mod:    Who is Online Location Fix          v0.9.1 ]
 ******************************************************/

//
// Moderator Control Panel
//
$lang['Mod_CP'] = "Panel de Control del Moderador";
$lang['Mod_CP_explain'] = "Usando el siguiente formulario puede realizar operaciones de moderaci&oacute;n en este foro. Puede cerrar, desbloquear, mover o borrar cualquier n&uacute;mero de temas.";

$lang['Select'] = "Seleccionar";
$lang['Delete'] = "Borrar";
$lang['Move'] = "Mover";
$lang['Lock'] = "Cerrar";
$lang['Unlock'] = "Desbloquear";

$lang['Topics_Removed'] = "Los temas seleccionados han sido removidos con &eacute;xito de la base de datos.";
$lang['Topics_Locked'] = "Los temas seleccionados han sido cerrados";
$lang['Topics_Moved'] = "Los temas seleccionados han sido movidos";
$lang['Topics_Unlocked'] = "Los temas seleccionados han sido desbloqueados";
$lang['No_Topics_Moved'] = "No se movieron temas";
/*****[BEGIN]******************************************
 [ Mod:    Topic Cement                        v1.0.3 ]
 ******************************************************/
$lang['Topics_Prioritized'] = 'Los Temas seleccionados han sido priorizados.';
$lang['Priority'] = 'Prioridad';
$lang['Prioritize'] = 'Priorizar';
/*****[END]********************************************
 [ Mod:    Topic Cement                        v1.0.3 ]
 ******************************************************/

$lang['Confirm_delete_topic'] = "&iquest;Est&aacute; seguro que quiere eliminar el/los tema/s seleccionado/s?";
$lang['Confirm_lock_topic'] = "&iquest;Est&aacute; seguro que quiere cerrar el/los tema/s seleccionado/s?";
$lang['Confirm_unlock_topic'] = "&iquest;Est&aacute; seguro que quiere desbloquear el/los tema/s seleccionado/s?";
$lang['Confirm_move_topic'] = "&iquest;Est&aacute; seguro que quiere mover el/los tema/s seleccionado/s?";

$lang['Move_to_forum'] = "Mover al foro";
$lang['Leave_shadow_topic'] = "Dejar tema sombreado en antiguo foro.";

$lang['Split_Topic'] = "Panel de Control para Divisi&oacute;n de Temas";
$lang['Split_Topic_explain'] = "Usando el siguiente formulario puede dividir un tema en dos, ya sea seleccionando los mensajes individualmente o dividi&eacute;ndolo en un mensaje determinado";
$lang['Split_title'] = "T&iacute;tulo del nuevo tema";
$lang['Split_forum'] = "Foro para nuevo tema";
$lang['Split_posts'] = "Dividir mensajes seleccionados";
$lang['Split_after'] = "Dividir desde el mensaje seleccionado";
$lang['Topic_split'] = "El tema seleccionado ha sido dividido con &eacute;xito";

$lang['Too_many_error'] = "Ha seleccionado muchos mensajes. Solo puede escoger un mensaje para dividir un tema a partir de &eacute;l";

$lang['None_selected'] = "No ha seleccionado temas para esta operaci&oacute;n. Por favor regrese y seleccione al menos uno.";
$lang['New_forum'] = "Nuevo Foro";

$lang['This_posts_IP'] = "IP para este mensaje";
$lang['Other_IP_this_user'] = "Otros IP's desde los que este usuario ha publicado mensajes";
$lang['Users_this_IP'] = "Usuarios publicando de este IP";
$lang['IP_info'] = "Informaci&oacute;n IP";
$lang['Lookup_IP'] = "Buscar por IP";
//
// Timezones ... for display on each page
//
$lang['All_times'] = 'All times are %s'; // eg. All times are GMT - 12 Hours (times from next block)


$lang['-12'] = 'GMT - 12 Horas';
$lang['-11'] = 'GMT - 11 Horas';
$lang['-10'] = 'GMT - 10 Horas';
$lang['-9'] = 'GMT - 9 Horas';
$lang['-8'] = 'GMT - 8 Horas';
$lang['-7'] = 'GMT - 7 Horas';
$lang['-6'] = 'GMT - 6 Horas';
$lang['-5'] = 'GMT - 5 Horas';
$lang['-4'] = 'GMT - 4 Horas';
$lang['-3.5'] = 'GMT - 3.5 Horas';
$lang['-3'] = 'GMT - 3 Horas';
$lang['-2'] = 'GMT - 2 Horas';
$lang['-1'] = 'GMT - 1 Horas';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Hour';
$lang['2'] = 'GMT + 2 Horas';
$lang['3'] = 'GMT + 3 Horas';
$lang['3.5'] = 'GMT + 3.5 Horas';
$lang['4'] = 'GMT + 4 Horas';
$lang['4.5'] = 'GMT + 4.5 Horas';
$lang['5'] = 'GMT + 5 Horas';
$lang['5.5'] = 'GMT + 5.5 Horas';
$lang['6'] = 'GMT + 6 Horas';
$lang['6.5'] = 'GMT + 6.5 Horas';
$lang['7'] = 'GMT + 7 Horas';
$lang['8'] = 'GMT + 8 Horas';
$lang['9'] = 'GMT + 9 Horas';
$lang['9.5'] = 'GMT + 9.5 Horas';
$lang['10'] = 'GMT + 10 Horas';
$lang['11'] = 'GMT + 11 Horas';
$lang['12'] = 'GMT + 12 Horas';
$lang['13'] = 'GMT + 13 Horas';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 Horas';
$lang['tz']['-11'] = 'GMT - 11 Horas';
$lang['tz']['-10'] = 'GMT - 10 Horas';
$lang['tz']['-9'] = 'GMT - 9 Horas';
$lang['tz']['-8'] = 'GMT - 8 Horas';
$lang['tz']['-7'] = 'GMT - 7 Horas';
$lang['tz']['-6'] = 'GMT - 6 Horas';
$lang['tz']['-5'] = 'GMT - 5 Horas';
$lang['tz']['-4'] = 'GMT - 4 Horas';
$lang['tz']['-3.5'] = 'GMT - 3.5 Horas';
$lang['tz']['-3'] = 'GMT - 3 Horas';
$lang['tz']['-2'] = 'GMT - 2 Horas';
$lang['tz']['-1'] = 'GMT - 1 Horas';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 Hour';
$lang['tz']['2'] = 'GMT + 2 Horas';
$lang['tz']['3'] = 'GMT + 3 Horas';
$lang['tz']['3.5'] = 'GMT + 3.5 Horas';
$lang['tz']['4'] = 'GMT + 4 Horas';
$lang['tz']['4.5'] = 'GMT + 4.5 Horas';
$lang['tz']['5'] = 'GMT + 5 Horas';
$lang['tz']['5.5'] = 'GMT + 5.5 Horas';
$lang['tz']['6'] = 'GMT + 6 Horas';
$lang['tz']['6.5'] = 'GMT + 6.5 Horas';
$lang['tz']['7'] = 'GMT + 7 Horas';
$lang['tz']['8'] = 'GMT + 8 Horas';
$lang['tz']['9'] = 'GMT + 9 Horas';
$lang['tz']['9.5'] = 'GMT + 9.5 Horas';
$lang['tz']['10'] = 'GMT + 10 Horas';
$lang['tz']['11'] = 'GMT + 11 Horas';
$lang['tz']['12'] = 'GMT + 12 Horas';
$lang['tz']['13'] = 'GMT + 13 Horas';

$lang['datetime']['Sunday'] = "Domingo";
$lang['datetime']['Monday'] = "Lunes";
$lang['datetime']['Tuesday'] = "Martes";
$lang['datetime']['Wednesday'] = "Mi&eacute;rcoles";
$lang['datetime']['Thursday'] = "Jueves";
$lang['datetime']['Friday'] = "Viernes";
$lang['datetime']['Saturday'] = "S&aacute;bado";
$lang['datetime']['Sun'] = "Dom";
$lang['datetime']['Mon'] = "Lun";
$lang['datetime']['Tue'] = "Mar";
$lang['datetime']['Wed'] = "Mie";
$lang['datetime']['Thu'] = "Jue";
$lang['datetime']['Fri'] = "Vie";
$lang['datetime']['Sat'] = "Sab";
$lang['datetime']['January'] = "Enero";
$lang['datetime']['February'] = "Febrero";
$lang['datetime']['March'] = "Marzo";
$lang['datetime']['April'] = "Abril";
$lang['datetime']['May'] = "Mayo";
$lang['datetime']['June'] = "Junio";
$lang['datetime']['July'] = "Julio";
$lang['datetime']['August'] = "Augosto";
$lang['datetime']['September'] = "Septiembre";
$lang['datetime']['October'] = "Octubre";
$lang['datetime']['November'] = "Noviembre";
$lang['datetime']['December'] = "Diciembre";
$lang['datetime']['Jan'] = "Ene";
$lang['datetime']['Feb'] = "Feb";
$lang['datetime']['Mar'] = "Mar";
$lang['datetime']['Apr'] = "Abr";
$lang['datetime']['May'] = "May";
$lang['datetime']['Jun'] = "Jun";
$lang['datetime']['Jul'] = "Jul";
$lang['datetime']['Aug'] = "Ago";
$lang['datetime']['Sep'] = "Sep";
$lang['datetime']['Oct'] = "Oct";
$lang['datetime']['Nov'] = "Nov";
$lang['datetime']['Dec'] = "Dic";

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = "Informaci&oacute;n";
$lang['Critical_Information'] = "Informaci&oacute;n Cr&iacute;tica";

$lang['General_Error'] = "Error General";
$lang['Critical_Error'] = "Error Cr&iacute;tico";
$lang['An_error_occured'] = "Ocurri&oacute; un Error";
$lang['A_critical_error'] = "Ocurri&oacute; un Error Cr&iacute;tico";
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$lang['Quick_reply_panel'] = 'Respuesta rapida Super Modo.';
$lang['Quick_Reply'] = 'Respuesta rapida';
$lang['Show_quick_reply'] = 'Mostrar formulario de Respuesta rapida';
$lang['sqr']['0'] = 'No';
$lang['sqr']['1'] = 'Si';
$lang['sqr']['2'] = 'Solo en la ultima pagina';
$lang['Quick_reply_mode'] = 'Modo de Respuesta Rapida';
$lang['Quick_reply_mode_basic'] = 'Basico';
$lang['Quick_reply_mode_advanced'] = 'Avanzado';
$lang['Show_hide_quick_reply_form'] = 'Mostrar / ocultar formulario de respuesta rapida';
$lang['Open_quick_reply'] = 'Abrir el formulario de respuesta rapida de forma automatica';
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$lang['Rank_title'] = 'T&iacute;tulo del Rango';
$lang['Admin_reauthenticate'] = 'Para administrar la tarjeta que debe volver a autenticarse.';

/*****[BEGIN]******************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
$lang['Recent_topics'] = 'Temas recientes';
$lang['Recent_today'] = 'Hoy';
$lang['Recent_yesterday'] = 'Ayer';
$lang['Recent_last24'] = 'Ultimas 24 horas';
$lang['Recent_lastweek'] = 'Ultima Semana';
$lang['Recent_lastXdays'] = 'Ultimo %s dias';
$lang['Recent_last'] = 'Ultimo';
$lang['Recent_days'] = 'Dias';
$lang['Recent_first'] = 'comenzo a %s';
$lang['Recent_first_poster'] = ' por %s';
$lang['Recent_select_mode'] = 'Seleccione el modo de:';
$lang['Recent_showing_posts'] = 'Listado mensajes:';
$lang['Recent_title_one'] = '<font size="4">%s</font> tema %s'; // %s = topics; %s = sort method
$lang['Recent_title_more'] = '<font size="4">%s</font> temas %s'; // %s = topics; %s = sort method
$lang['Recent_title_today'] = ' a partir de hoy';
$lang['Recent_title_yesterday'] = ' de ayer';
$lang['Recent_title_last24'] = ' de las ultimas 24 horas';
$lang['Recent_title_lastweek'] = ' desde la ultima semana';
$lang['Recent_title_lastXdays'] = ' a partir de los ultimo %s dias'; // %s = days
$lang['Recent_no_topics'] = 'No se han encontrado temas.';
$lang['Recent_wrong_mode'] = 'Usted ha seleccionado un modo incorrecto.';
$lang['Recent_click_return'] = 'Presione %saqui%s para volver al sitio reciente.';
/*****[END]********************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$lang['Topic_global_announcement']='<strong>Anuncio Global:</strong>';
$lang['Post_global_announcement'] = 'Anuncio Global';
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Select Expand BBcodes              v1.2.8 ]
 ******************************************************/
$lang['Select'] = 'Seleccione';
$lang['Expand'] = 'Ampliar';
$lang['Contract'] = 'Contrato';
/*****[END]********************************************
 [ Mod:     Select Expand BBcodes              v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/
$lang['Version_check'] = 'Comprobar nueva version';
/*****[END]********************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Search Only Subject                 v0.9.1 ]
 ******************************************************/
$lang['Search_subject_only'] = 'Buscar solo el asunto del mensaje';
/*****[END]********************************************
 [ Mod:    Search Only Subject                 v0.9.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
$lang['Show_avatars'] = 'Mostrar Avatares en el Tema';
$lang['Show_signatures'] = 'Mostrar Firmas en el Tema';
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                    v2.1.1 RC ]
 ******************************************************/
$lang['Quick_search_for'] = 'Buscar';
$lang['Quick_search_at'] = 'en';
// In this case, the %s displays the Site Name as defined in the ACP. e.g. phpBB.com Advanced Search
$lang['Forum_advanced_search'] = '%s Busqueda avanzada';
/*****[END]********************************************
 [ Mod:     Quick Search                    v2.1.1 RC ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/
$lang['sig_description'] = 'Editar Firma (<strong>Incluye vista previa</strong>)';
$lang['sig_edit'] = 'Editar Firma';
$lang['sig_current'] = 'Firma actual';
$lang['sig_none'] = 'Firma no disponible';
$lang['sig_save'] = 'Guardar';
$lang['sig_save_message'] = 'Firma guardado con exito !';
/*****[END]********************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Separate Announcements & Sticky   v2.0.0a ]
 ******************************************************/
$lang['Global_Announcements'] = 'Anuncios globales';
$lang['Announcements'] = 'Anuncios';
$lang['Sticky_Topics'] = 'Temas Adhesivas';
/*****[END]********************************************
 [ Mod:     Separate Announcements & Sticky   v2.0.0a ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/
$lang['Staff'] = 'Personal';
$lang['Forums'] = 'Foros';
$lang['Mod'] = 'Moderador';
$lang['Admin'] = 'Administrador';
$lang['Super'] = 'Super Moderador';
$lang['Junior'] = 'Administrador Junior';
$lang['Period'] = 'desde <strong>%d</strong> dias'; // %d = days
$lang['Messenger'] = 'Messenger';
/*****[END]********************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Disable Board Admin Override        v0.1.1 ]
 ******************************************************/
$lang['Board_Currently_Disabled'] = 'El Foro est&aacute; actualmente deshabilitado';
/*****[END]********************************************
 [ Mod:    Disable Board Admin Override        v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Memberlist Find User                v1.0.0 ]
 ******************************************************/
$lang['Look_up_User'] = 'Buscar Miembro';
/*****[END]********************************************
 [ Mod:    Memberlist Find User                v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Theme Simplifications              v1.0.0 ]
 ******************************************************/
$lang['Mini_Index'] = '&iacute;ndice';
$lang['Rules'] = 'Reglas';
$lang['Login_Logout'] = 'Conectarse / Desconectarse';
/*****[END]********************************************
 [ Mod:     Theme Simplifications              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
$lang['Welcome_PM'] = 'Establecer como MP de Bienvenida';
$lang['Welcome_PM_Set'] = 'Tu MP de Bienvenida ha sido establecido';
$lang['Welcome_PM_Admin'] = 'MP de Bienvenida';
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Limit smilies per post             v1.0.2 ]
 ******************************************************/
$lang['Max_smilies_per_post'] = 'Solamente puedes usar %s emoticones como m&aacute;ximo por mensaje.<br />Tienes %s emoticones, demasiados en uso.';
/*****[END]********************************************
 [ Mod:     Limit smilies per post             v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     YA Merge                           v1.0.0 ]
 ******************************************************/
 $lang['Real_Name'] = 'Nombre Real:';
 $lang['Newsletter'] = 'Recibir Bolet&iacute;n por Email?';
 $lang['Extra_Info'] = 'Informaci&oacute;n Extra:';
 $lang['Error_Check_Num'] = "N&uacute;mero de Chequeo no V&aacute;lido<br /><br />Necesitar&aacute;s registrarte de nuevo<br /><br />Haz click <a href=\"%s\">aqu&iacute;</a> para registrarte";
 $lang['Extra_Info'] = 'Informaci&oacute;n Extra';
/*****[END]********************************************
 [ Mod:     YA Merge                           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
$lang['Move_merge_message'] = 'Unido: <b>%s</b> por <b>%s</b><br />Desde Tema <b>%s</b> (<b>%s</b>)';
$lang['Move_move_message'] = 'Movido: <b>%s</b> por <b>%s</b><br />Desde <b>%s</b> a <b>%s</b>';
$lang['Move_lock_message'] = 'Cerrado: <b>%s</b> por <b>%s</b>';
$lang['Move_edit_message'] = 'Editado: <b>%s</b> por <b>%s</b>';
$lang['Move_unlock_message'] = 'Abierto: <b>%s</b> por <b>%s</b>';
$lang['Move_split_message'] = 'Divido: <b>%s</b> por <b>%s</b><br />Desde Tema <b>%s</b> (<b>%s</b>)';
$lang['Close_window'] = 'Cerrar la ventana';
$lang['Rules_title'] = 'Acci&oacute;n : %s';
$lang['Locking_topic'] = 'Cerrando un tema';
$lang['Unlocking_topic'] = 'Abrir un tema';
$lang['Spliting_topic'] = 'Dividiendo un tema';
$lang['Moving_topic'] = 'Moviendo un tema';
$lang['Deleting_topic'] = 'Eliminando un tema';
$lang['Editing_topic'] = 'Editando un tema';
$lang['Lock_Explication'] = 'Cuando un Moderador/Administrador cierra un tema, un Miembro normal no puede responder. Pero los Moderadores/Administradores pueden continuar con los mensajes.';
$lang['Unlock_Explication'] = 'A Moderator/Administrator can unlock a topic which has been locked. This will allow all users to continue to post in the thread.';
$lang['Split_Explication'] = 'Al dividir un tema que tiene muchas p&aacute;ginas te da la posibilidad de mantener tus temas m&aacute;s organizados.';
$lang['Move_Explication'] = 'Si elijes mover un tema, podr&aacute;s enviar el tema, que est&aacute; en el Foro A, al Foro B. Tambi&eacute;n puedes elegir dejar un Tema Shadow en el foro A.';
$lang['Delete_Explication'] = 'Si un Moderador/Administrador elimina un tema, ya no se mostrar&aacute; en el foro y nadie podr&aacute; restaurarlo. <br /><b>S&eacute; cuidadoso con esta funci&oacute;n</b>';
$lang['Edit_Explication'] = 'Al editar un mensaje, un Administrador y/o un Moderador pueden cambiar lo que escribi&oacute; el miembro en el mensaje.';
$lang['No_action_specified'] = 'No hay acci&oacute;n especificada';
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
$lang['true'] = 'verdadero';
$lang['false'] = 'Falso';

$lang['XData_too_long'] = 'Your %s is too long.';
$lang['XData_invalid'] = 'The value you entered for %s is invalid.';

$lang['XData_error_obtaining_userdata'] = 'Error while finding  a user\'s XData field to edit it';
$lang['XData_failure_removing_data'] = 'Failure to remove specefied data';
$lang['XData_failure_inserting_data'] = 'Failure to add specefied data';
$lang['XData_error_obtaining_user_xdata'] = 'Error obtaining user\'s XData';
$lang['XData_failure_obtaining_field_data'] = 'Error obtaining field data';
$lang['XData_failure_obtaining_field_auth'] = 'Error obtaining field auths';
$lang['XData_failure_obtaining_user_auth'] = 'Error obtaining auth for user';
$lang['XData_error_obtaining_usergroup'] = 'Error obtaining usergroup';
$lang['XData_error_obtaining_group_data'] = 'Error obtaining group data';
$lang['XData_error_updating_auth'] = 'Error updating auth table';
$lang['XData_error_updating_fields'] = 'Error updating field table';
$lang['XData_success_updating_permissions'] = "Permissions updated successfully <br /><br /> Click %shere%s to return to Field Permissions <br /><br />";
$lang['XData_error_obtaining_new_field_info'] = 'Could not get field_order and field_id for new field.';

$lang['XData_no_field_selected'] = 'You have not selected a field';
$lang['XData_field_non_existant'] = 'Field does not exist';
$lang['XData_unable_to_switch_fields'] = 'Unable to switch fields';
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/
$lang['show_glance_option']['1'] = 'Todos';
$lang['show_glance_option']['0'] = 'Ninguno';
$lang['show_glance_option']['2'] = 'S&oacute;lo el &iacute;ndice';
$lang['show_glance_option']['3'] = 'S&oacute;lo Foros';
$lang['show_glance_option']['4'] = 'S&oacute;lo Temas';
$lang['show_glance_option']['5'] = '&iacute;ndice y Temas';
$lang['show_glance_option']['6'] = '&iacute;ndice y Foros';
$lang['show_glance_option']['7'] = 'Foros y Temas';
$lang['show_glance_option']['8'] = 'Category Only';
$lang['show_glance_option']['9'] = 'indice y Categoria';
$lang['show_glance_option']['10'] = 'indice Categoria y Foro';
$lang['glance_show'] = 'Mostrar de un vistazo (Temas Recientes)<br />';
/*****[END]********************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
$lang['View_post'] = 'Ver Mensaje';
$lang['Post_review'] = 'Revisi&oacute;n del Mensaje';
$lang['View_next_post'] = 'Ver Mensajes siguientes';
$lang['View_previous_post'] = 'Ver Mensajes Previos';
$lang['No_newer_posts'] = 'No hay nuevos mensajes en este Foro';
$lang['No_older_posts'] = 'No hay Mensajes antiguos en este Foro';
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Cement                 v1.0.0 ]
 ******************************************************/
$lang['topic_glance_priority'] = 'Cementar este tema en la Muestra de Temas Recientes';
/*****[END]********************************************
 [ Mod:     At a Glance Cement                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Online/Offline/Hidden              v2.2.7 ]
 ******************************************************/
$lang['Online'] = 'En L&iacute;nea';
$lang['Offline'] = 'Desconectado';
$lang['Hidden'] = 'Oculto';
$lang['is_online'] = '%s est&aacute; actualmente en l&iacute;nea';
$lang['is_offline'] = '%s est&aacute; desconectado';
$lang['is_hidden'] = '%s est&aacute; oculto';
$lang['Online_status'] = 'Estado';
/*****[END]********************************************
 [ Mod:     Online/Offline/Hidden              v2.2.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
$lang['Images_Allowed_For_Registered_Only'] = 'Por favor con&eacute;ctate para ver esta imagen.';
$lang['Links_Allowed_For_Registered_Only'] = 'Por favor con&eacute;ctate para ver este enlace';
$lang['Emails_Allowed_For_Registered_Only'] = 'Por favor con&eacute;ctate para ver este email';
$lang['Get_Registered'] = '%sReg&iacute;strate%s o ';
$lang['Image_Blocked'] = 'Has seleccionado bloquear im&aacute;genes.<br />%sEditar Tu Perfil%s';
$lang['Enter_Forum'] = '%singresar%s a los Foros!';
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
$lang['Post_reports_none_cp'] = 'No hay ningun mensaje Reportado';
$lang['Post_reports_one_cp'] = 'Hay %s Mensaje abiertor reportado';
$lang['Post_reports_many_cp'] = 'Hay %s Mensajes abiertor reportados';

$lang['All'] = 'Todo';
$lang['Display'] = 'Mostrar s&oacute;lo';
$lang['Report_post'] = 'Reportar Mensaje';

$lang['Reporter'] = 'Reportado por';
$lang['Status'] = 'Estado';
$lang['Select_one'] = 'Seleccionar Uno';

$lang['Opt_in'] = 'Opci&oacute;n - recibir correos electr&oacute;nicos cuando env&iacute;an un reporte';
$lang['Opt_out'] = 'Opci&oacute;n - no recibir recibir correos cuando env&iacute;an un reporte';

$lang['Post_reported'] = 'Mensaje de Reporte enviado exitosamente.';
$lang['Close_success'] = 'Reportes fueron Abiertos/Cerrados exitosamente.';
$lang['Opt_success'] = 'Has seleccionado Opci&oacute;n exitosamente.';
$lang['Delete_success'] = 'Los Reportes fueron eliminados exitosamente.';
$lang['Click_return_reports'] = 'Haz click %saqu&iacute;%s para volver al Panel de Control de los Mensajes de Reporte.';
$lang['Report_email'] = 'Enviar e-mail cuando se reporte mensaje';

$lang['Post_already_reported'] = 'Ya se ha reportado este mensaje.';

$lang['Report_not_selected'] = 'No has seleccionado ning&uacute;n reporte.';

$lang['Comments'] = 'Comentarios';
$lang['Last_action_comments'] = 'Comentarios de los Moderadores';
$lang['Last_action_comments_explain'] = 'Por favor escribe algunos comentarios sobre tu acci&oacute;n en este reporte';
$lang['Comments_explain'] = 'Por favor escribe algunos comentarios sobre tu reporte en este mensaje espec&iacute;fico.';

$lang['Action'] = 'Acci&oacute;n';
$lang['Report_comment'] = 'Comentarios en relaci&oacute;n a su acci&oacute;n';
$lang['Previous_comments'] = 'Comentarios previos';

$lang['Last_action_checkbox'] = 'Esta acci&oacute;n fue realizada a trav&eacute;s del cuadro de seleci&oacute;n y el men&uacute; desplegable hacia abajo.';

$lang['Opened_by_user_on_date'] = 'Abierto por %s el %s';
$lang['Closed_by_user_on_date'] = 'Cerrado por %s el %s';
$lang['Opened'] = 'Abierto';
$lang['Closed'] = 'Cerrado';
$lang['Open'] = 'Abierto';
$lang['Close'] = 'Cerrado';

$lang['Non_existent_posts'] = 'Encontr&oacute; y elimin&oacute; %s reporte(s) sobrante(s) se&ntilde;alando mensajes no existentes (borrados)';

$lang['Theme'] = 'Theme';

/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Show Groups                        v1.0.1 ]
 ******************************************************/
//$lang['Groups'] = 'Member Of';
/*****[END]********************************************
 [ Mod:     Show Groups                        v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images                        v1.0.0 ]
 ******************************************************/
$lang['user_hide_images'] = 'Ocultar Im&aacute;genes en los Foros';
/*****[END]********************************************
 [ Mod:     Hide Images                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/
$lang['BBCode_box_hidden'] = 'Oculto';
$lang['BBcode_box_view'] = 'Pulsa para ver Contenido';
$lang['BBcode_box_hide'] = 'Pulsa para Ocultar Contenido';
/*****[END]********************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/

// Email-Extention
$lang['HELLO'] = 'Hello';
$lang['NEW_ACCOUNT_OBJECT'] = 'Propiedad de la cuenta ' . $new_username . ' ha sido desactivado o de nueva creacion, debera verificar los detalles de este usuario (si es necesario) y activar mediante el siguiente enlace:';
$lang['NEW_ACCOUNT_ACTIVATE_LINK'] = 'Link: <a href="'. $activate_link . '>'. $activate_link .'</a>';
$lang['REACTIVATE_ACCOUNT_OBJECT'] = 'Su cuenta de '. $board_config['nombre del sitio'] .' ha sido desactivado, muy probablemente debido a los cambios realizados a su perfil. Con el fin de reactivar su cuenta debe hacer clic en el enlace de abajo:';
$lang['REACTIVATE_ACCOUNT_ACTIVATE_LINK'] = 'Link: <a href="'. $activate_link . '>'. $activate_link .'</a>';

// FAQ & Rules
/*****[BEGIN]******************************************
 [ Mod:     DHTML Collapsible FAQ MOD          v1.0.0 ]
 ******************************************************/
$lang['dhtml_faq_noscript'] = "Parece que tu navegador no soporta javascript o se ha desactivado en la configuracion de su navegador.<br /><br />Por favor, haga clic en %sAQUI%s para ver una version HTML.";
/*****[END]********************************************
 [ Mod:     DHTML Collapsible FAQ MOD          v1.0.0 ]
 ******************************************************/
$lang['BBCode_attach'] = 'Guia del archivo adjunto';
$lang['BBCode_rules'] = 'Codigo de Conducta';

/*****[BEGIN]******************************************
 [ Mod:     Edit Profile - Panel Feel          v2.0.0 ]
 ******************************************************/
$lang['panel_feel']['1'] = 'Derecho';
$lang['panel_feel']['2'] = 'Izquierdo';
$lang['panel_feel']['0'] = 'Apagado';
$lang['Edit_Profile_Menu_title'] = 'Editar perfil';
/*****[END]********************************************
 [ Mod:     Edit Profile - Panel Feel          v2.0.0 ]
 ******************************************************/

/*--ARCADE MOD--*/

//
// That's all, Folks!
// -------------------------------------------------

?>