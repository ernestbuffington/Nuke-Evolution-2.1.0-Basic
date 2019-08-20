<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                            lang_admin.php [English]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_admin.php,v 1.35.2.10 2005/02/21 18:38:17 acydburn Exp $
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
      Admin Userlist                           v2.0.2       06/11/2005
      Global Announcements                     v1.2.8       06/13/2005
      PM Quick Reply                           v1.3.5       06/14/2005
      Force Word Wrapping - Configurator       v1.0.16      06/15/2005
      Resize Posted Images                     v2.4.5       06/15/2005
      Advance Signature Divider Control        v1.0.0       06/16/2005
      Forum Blocks                             v1.0.0       06/23/2005
      Forum ACP Administration Links           v1.0.0       06/26/2005
      Faq Manager                              v1.0.0b      06/26/2005
      Board Rules                              v2.0.0       06/26/2005
      Default avatar                           v1.1.0       06/30/2005
      Disable Board Message                    v1.0.0       07/06/2005
      Disable Board Admin Override             v0.1.1       07/06/2005
      PM threshold                             v1.0.0       07/19/2005
      Limit smilies per post                   v1.0.2       07/24/2005
      Advance Admin Index Stats                v1.0.0       08/02/2005
      Log Moderator Actions                    v1.1.6       08/06/2005
      At a Glance Options                      v1.0.0       08/17/2005
      Quick Search                             v3.0.1       08/23/2005
      Show Users Today Toggle                  v1.0.0       08/24/2005
      Group Colors and Ranks                   v1.0.0       08/24/2005
      Customized Topic Status                  v1.0.0       08/25/2005
      Initial Usergroup                        v1.0.1       08/25/2005
      Hide Images and Links                    v1.0.0       08/30/2005
      DHTML Admin Menu                         v1.0.1       08/31/2005
      Hide Images                              v1.0.0       09/02/2005
      Super Quick Reply                        v1.3.2       09/08/2005
      Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
      Log Actions Mod - Topic View             v2.0.0       09/18/2005
      Forum Admin Style Selection              v1.0.0       10/01/2005
      Edit User Post Count                     v1.0.0       12/19/2005
      Online/Offline/Hidden                    v2.2.7       01/24/2006
      Display Poster Information Once          v2.0.0       06/12/2006
      Auto Group                               v1.2.2       11/06/2006
      Guests Postings Security Code            v1.0.0       10/11/2007
      Guests Search Security Code              v1.0.0       07/25/2008
-=[Other]=-
      URL Check                                v1.0.0       07/01/2005
      Cookie Check                             v1.0.0       08/04/2005
      Admin Overall-ForumAuth									 v1.0.2				08/19/2006
 ************************************************************************/

/* CONTRIBUTORS
	2002-12-15    Philip M. White (pwhite@mailhaven.com)
		Fixed many minor grammatical mistakes
*/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

//
// Format is same as lang_main
//

//
// Modules, this replaces the keys used
// in the modules[][] arrays in each module file
//
$lang['General'] = 'Administraci&oacute;n General';
$lang['Users'] = 'Administraci&oacute;n Usuarios';
$lang['Groups'] = 'Administraci&oacute;n Grupos';
$lang['Forums'] = 'Administraci&oacute;n Foros';
$lang['Topic_Shadow'] = 'Tema central';
/*****[BEGIN]******************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/
$lang['Faq_manager'] = 'FAQ Admin';
/*****[END]********************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/

$lang['Configuration'] = 'Configuraci&oacute;n';
$lang['Permissions'] = 'Permisos';
$lang['Manage'] = 'Manejo';
$lang['Disallow'] = 'Deshabilitar Nombres';
$lang['Prune'] = 'Purgar';
$lang['Mass_Email'] = 'Correo Masivo';
$lang['Ranks'] = 'Rangos';
$lang['Smilies'] = 'Emoticones';
$lang['Ban_Management'] = 'Control de Bloqueo';
$lang['Word_Censor'] = 'Palabras Censuradas';
$lang['Export'] = 'Exportar';
$lang['Create_new'] = 'Crear';
$lang['Add_new'] = 'Agregar';
$lang['Backup_DB'] = 'Copia de Seguridad de Base de Datos';
$lang['Restore_DB'] = 'Restaurar Base de Datos';

$lang['User_Permissions'] = 'Permisos de usuario';
$lang['Group_Permissions'] = 'Permisos de grupo';
$lang['Manage_Fields'] = 'Administrar campos';
$lang['Poll_Results'] = 'Resultados de encuesta';
$lang['Poll_Admin'] = 'Administracion de encuesta';
$lang['AUC'] = 'AUC';
$lang['Logs'] = 'Registros';
$lang['Logs Actions'] = 'Registros de Acciones';
$lang['Logs Config'] = 'Registros de configuracion';
$lang['Configuration_extend'] = 'Configuracion ampliada';
$lang['Quick Search List'] = 'Buscar Lista';
/*****[BEGIN]******************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/
$lang['board_faq'] = 'FAQ del Foro';
$lang['bbcode_faq'] = 'FAQ de BBcode';
$lang['attachment_faq'] = 'FAQ de Archivos Adjuntos';
$lang['prillian_faq'] = 'Prillian FAQ';
$lang['bid_faq'] = 'FAQ Lista de Amigos';
/*****[END]********************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Board Rules                        v2.0.0 ]
 ******************************************************/
$lang['site_rules'] = 'Site Rules';
/*****[END]********************************************
 [ Mod:     Board Rules                        v2.0.0 ]
 ******************************************************/

//
// Index
//
$lang['Admin'] = 'Administracion';
$lang['Not_admin'] = 'Usted no esta autorizado para administrar este foro';
$lang['Welcome_phpBB'] = 'Bienvenido a phpBB';
$lang['Admin_intro'] = 'Gracias por elegir phpBB como la solucion del Foro. Esta pantalla le dara una vision rapida de todas las estadisticas diferentes de su Foro. Se puede obtener volver a esta pagina haciendo clic en el <u>Administrador [Foros]</u> enlace en el panel izquierdo. Para volver al indice de su Foro, haga clic en el <u>Indice de foros</u> vinculo o el logotipo de phpBB tambien en el panel izquierdo. Los otros enlaces sobre el lado izquierdo de esta pantalla le controlar todos los aspectos de su experiencia de Foro permitira. Cada pantalla tendra instrucciones sobre como utilizar las herramientas.';
$lang['Main_index'] = 'Indice del Foro';
$lang['Forum_stats'] = 'Estadisticas del foro';
$lang['Preview_forum'] = 'Vista previa del Foro';
/*****[BEGIN]******************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/
$lang['Admin_Index'] = 'Adminitrar [Foros]';
$lang['Admin_Nuke'] = 'Adminitrar [Nuke-Evo]';
$lang['Home_Nuke'] = 'Inicio [Nuke-Evo]';
/*****[END]********************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/

$lang['Click_return_admin_index'] = 'Presione %sAqu&iacute;%s para volver al &iacute;ndice del Administrador';

$lang['Statistic'] = 'Estad&iacute;sticas';
$lang['Online_time'] = 'En linea desde';
$lang['LEFT_Package_Module'] = 'Paquete de Modulo';
$lang['Install_module'] = 'Instalar modulo';
$lang['Manage_modules'] = 'Administrar modulos';
$lang['Stats_configuration'] = 'Configuracion';
$lang['Edit_module'] = 'Editar Modulo';
$lang['Stats_langcp'] = 'Estadisticas de IdiomaCP';

$lang['Value'] = 'Valor';
$lang['Number_posts'] = 'N&uacute;mero de mensajes';
$lang['Posts_per_day'] = 'Mensajes por d&iacute;a';
$lang['Number_topics'] = 'Cantidad de t&oacute;picos';
$lang['Topics_per_day'] = 'T&oacute;picos por d&iacute;a';
$lang['Number_users'] = 'Cantidad de usuarios';
$lang['Users_per_day'] = 'Usuarios por d&iacute;a';
$lang['Board_started'] = 'Fecha de inicio del Foro';
$lang['Avatar_dir_size'] = 'Tama&ntilde;o de la carpeta de Avatares';
$lang['Database_size'] = 'Tama&ntilde;o de la Base de Datos';
$lang['Gzip_compression'] ='Compresi&oacute;n Gzip';
$lang['Not_available'] = 'No est&aacute; disponible';

$lang['ON'] = 'Activo'; // This is for GZip compression
$lang['OFF'] = 'Inactivo';

//
// DB Utils
//
$lang['Database_Utilities'] = 'Utilidades de la Base de Datos';

$lang['Restore'] = 'Restaurar';
$lang['Backup'] = 'Copia de seguridad';
$lang['Restore_explain'] = 'Esto restaurar&aacute; todas las tablas de phpBB desde un archivo previamente guardado. Si su servidor lo soporta usted puede subir un archivo de texto comprimido mediante el gzip y &eacute;ste sera automaticamente descomprimido automaticamente. <b>ATENCION</b> Esto sobre-escribir&aacute; la informaci&oacute;n existente. La restauraci&oacute;n puede durar unos minutos, por favor qu&eacute;dese en esta p&aacute;gina hasta que el proceso se haya completado.';
$lang['Backup_explain'] = 'Desde aqu&iacute; usted puede hacer una copia de seguridad (backup) de toda la informaci&oacute;n relacionado con phpBB. Si usted tiene tablas adicionales en la misma Base de Datos de las que quisiera realizar un backup ingrese sus nombres separados por comas en el campo de Tablas Adicionales. Si su servidor lo soporta puede utilizar el gzip para comprimir el archivo y reducir su tama&ntilde;o antes de descargarlo.';

$lang['Backup_options'] = 'Opciones de la Copia de Seguridad';
$lang['Start_backup'] = 'Iniciar la Ccopia de Seguridad';
$lang['Full_backup'] = 'Copia de Seguridad completa (Estructura y Datos)';
$lang['Structure_backup'] = 'S&oacute;lo Estructura';
$lang['Data_backup'] = 'S&oacute;lo Datos';
$lang['Additional_tables'] = 'Tablas Adicionales';
$lang['Gzip_compress'] = 'Archivo comprimido con GZip';
$lang['Select_file'] = 'Seleccionar Archivo';
$lang['Start_Restore'] = 'Iniciar Restauraci&oacute;n';

$lang['Restore_success'] = 'La Base de Datos ha sido restaurada exitosamente.<br /><br />Su Foro deber&iacute;a volver a la normalidad una vez finalizado el proceso.';
$lang['Backup_download'] = 'La descarga comenzar&aacute; enseguida, por favor espere un momento.';
$lang['Backups_not_supported'] = 'Disculpe, la opci&oacute;n de Copia de Seguridad de su Base de Datos no est&aacute; habilitada por su sistema.';

$lang['Restore_Error_uploading'] = 'Error subiendo el archivo de la copia de seguridad';
$lang['Restore_Error_filename'] = 'Error en el nombre de archivo, por favor intenet con un archivo diferente o cambien el nombre del archivo';
$lang['Restore_Error_decompress'] = 'No se puede descomprimir el archivo gzip, por favor subalo en una version de texto';
$lang['Restore_Error_no_file'] = 'Ning&uacute;n archivo ha sido subido';

//
// Auth pages
//
$lang['Select_a_User'] = 'Seleccione un usuario';
$lang['Select_a_Group'] = 'Seleccione un Grupo';
$lang['Select_a_Forum'] = 'Seleccione un Foro';
$lang['Auth_Control_User'] = 'Control de permisos de usuarios';
$lang['Auth_Control_Group'] = 'Control de Permisos de Grupos';
$lang['Auth_Control_Forum'] = 'Control de Permisos de Foros';
$lang['Look_up_User'] = 'Buscar usuario';
$lang['Look_up_Group'] = 'Buscar Grupo';
$lang['Look_up_Forum'] = 'Buscar Foro';

$lang['Group_auth_explain'] = 'Aqui puede modificar los permisos y estado de moderador asignado a cada grupo de usuarios. No olvide cuando cambia los permisos de grupo que los permisos de usuario individual pueden todavia permiten la entrada del usuario para foros, etc.. Usted se avisara si este es el caso.';
$lang['User_auth_explain'] = 'Aqui puede modificar los permisos y estado de moderador asignado a cada usuario individual. No olvide cuando cambiar permisos de usuario que grupo permisos todavia permiten la entrada del usuario para foros, etc.. Usted se avisara si este es el caso.';
$lang['Forum_auth_explain'] = 'Aqui puede alterar los niveles de autorizacion de cada foro. Tendra tanto un metodo sencillo y avanzado para hacerlo, donde avanzada ofrece un mayor control de cada operacion Foro. Recuerde que cambiar el nivel de permiso de foros afectaran a los usuarios que pueden realizar las diversas operaciones dentro de ellas.';

$lang['Simple_mode'] = 'Modo Simple';
$lang['Advanced_mode'] = 'Modo Avanzado';
$lang['Moderator_status'] = 'Estado del Moderador';

$lang['Allowed_Access'] = 'Acceso Permitido';
$lang['Disallowed_Access'] = 'Acceso no Permitido';
$lang['Is_Moderator'] = 'con Moderador';
$lang['Not_Moderator'] = 'sin Moderador';

$lang['Conflict_warning'] = 'Advertencia de Conflicto de Autorizaci&oacute;n';
$lang['Conflict_access_userauth'] = 'Este usuario a&uacute;n posee acceso a este Foro debido al Grupo al cual pertenece. Usted deber&aacute; cambiar los permisos del grupo o borrar al usuario del Grupo para prevenir que el usuario no tenga acceso a este Foro. Los derechos del Grupo y el Usuario se explican abajo.';
$lang['Conflict_mod_userauth'] = 'Este usuario todav&iacute;a posee derechos de Moderador a trav&eacute;s de un Grupo al cual pertence. Usted deber&aacute; cambiar los permisos del grupo o borrar al usuario de dicho Grupo para estar seguro que este usuario no tenga acceso al foro con permisos de Moderar. Los derechos se explican abajo.';

$lang['Conflict_access_groupauth'] = 'El siguiente usuario (o usuarios) todav&iacute;a tiene acceso a este foro debido a los permisos que tiene como Usuario. Para que no tenga acceso a este foro usted deber&aacute; cambiar sus permisos. Los derechos de Usuarios se explican abajo.';
$lang['Conflict_mod_groupauth'] = 'El siguiente usuario (o usuarios) todav&iacute;a posee derechos de Moderador en este foro. Para que no tenga acceso a este foro usted deber&aacute; cambiar sus permisos de usuario. Los derechos de Usuarios se explican abajo.';

$lang['Public'] = 'P&uacute;blico';
$lang['Private'] = 'Privado';
$lang['Registered'] = 'Registrado';
$lang['Administrators'] = 'Administrador';
$lang['Hidden'] = 'Oculto';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'TODOS';
$lang['Forum_REG'] = 'REGS';
$lang['Forum_PRIVATE'] = 'PRIVADOS';
$lang['Forum_MOD'] = 'MODS';
$lang['Forum_ADMIN'] = 'ADMINS';

$lang['View'] = 'Ver';
$lang['Read'] = 'Leer';
$lang['Post'] = 'Env&iacute;o';
$lang['Reply'] = 'Respuesta';
$lang['Edit'] = 'Editar';
$lang['Delete'] = 'Borrar';
$lang['Sticky'] = 'Importante';
$lang['Announce'] = 'Anuncio';
$lang['Vote'] = 'Votar';
$lang['Pollcreate'] = 'Crear una encuesta';

$lang['Permissions'] = 'Permisos';
$lang['Simple_Permission'] = 'Permiso Simple';

$lang['User_Level'] = 'Nivel de Usuario';
$lang['Auth_User'] = 'Usuario';
$lang['Auth_Admin'] = 'Administrador';
$lang['Group_memberships'] = 'Grupo de Usuarios';
$lang['Usergroup_members'] = 'Este Grupo contiene los siguientes Usuarios';

$lang['Forum_auth_updated'] = 'Permisos del Foro actualizado';
$lang['User_auth_updated'] = 'Permisos del usuario actualizado';
$lang['Group_auth_updated'] = 'Permisos del Grupo actualizado';

$lang['Auth_updated'] = 'los permisos han sido cambiados';
$lang['Click_return_userauth'] = 'Presione %saqu&iacute;%s para vovler a ver los Permisos de los Usuarios';
$lang['Click_return_groupauth'] = 'Presione %saqu&iacute;%s para vovler a ver los Permisos del Grupo';
$lang['Click_return_forumauth'] = 'Presione %saqu&iacute;%s para vovler a ver los Permisos del Foro';

//
// Banning
//
$lang['Ban_control'] = 'Control de Bloqueo';
$lang['Ban_explain'] = 'Desde aqu&iacute; usted puede banear a un usuario. Puede banear a los usuarios por su nombre, por su direcci&oacute;n IP, o por su Hostname. Este m&eacute;todo previene que un usuario tenga acceso a la p&aacute;gina principal del foro. Para prevenir que el Usuario se registre con una nueva cuenta tambi&eacute;n puede bannear su direcci&oacute;n de email. Tenga en cuenta que baneando una direcci&oacute;n de email no evitar&aacute; que el usuario pueda ingresar al foro ni que publique mensajes. Para realizar eso deber&aacute; utilizar uno de los dos m&eacute;todos explicados anteriormente.';
$lang['Ban_explain_warn'] = 'Tenga en cuenta que colocando un RANGO de direcciones IP usted banea a todas las direcciones que se encuentran dentro del Rango de la lista de bans.  Si realmente debe utilizar un rango intente utilizar uno peque&ntilde;o para asi no banear a otros usuarios.';

$lang['Select_username'] = 'Selecione un Nombre de Usuario';
$lang['Select_ip'] = 'Seleccione una direcci&oacute;n IP';
$lang['Select_email'] = 'Seleccione una direcci&oacute;n de Email';

$lang['Ban_username'] = 'Banear a uno o varios Usuarios';
$lang['Ban_username_explain'] = 'Usted puede banear varios usuarios en un solo paso usando la combianci&oacute;n apropiada de rat&oacute;n y teclado para el ordenador y el navegador.';

$lang['Ban_IP'] = 'Banear una o varias direcciones IP o HOSTNAMES';
$lang['IP_hostname'] = 'Direcciones IP o HOSTNAMES';
$lang['Ban_IP_explain'] = 'Para especificar diferentes IPs o Nombres de Dominio, sep&aacute;relos con comas. Para especificar un rango de direcciones IP separe el comienzo y el final utilizando un gui&oacute;n (-), para especificar un comod&iacute;n utilize el *';

$lang['Ban_email'] = 'Banear una o varias direcciones de email';
$lang['Ban_email_explain'] = 'Para especificar m&aacute;s de un email, col&oacute;quelos separados por comas. Para especificar un comod&iacute;n de usarios utilece *, por ejemplo *@hotmail.com';

$lang['Unban_username'] = 'Quitar ban de uno o mas usuarios Usuarios';
$lang['Unban_username_explain'] = 'Usted puede quitar el ban de m&uacute;ltiples Usuarios usando la correcta combinaci&oacute;n de mouse y teclado de su computadora y navegador';

$lang['Unban_IP'] = 'Quitar ban de una o varias Direcciones IP';
$lang['Unban_IP_explain'] = 'Usted puede quitar el ban a m&uacute;ltiples direcciones IP usando la correcta combinaci&oacute;n de mouse y teclado de su computadora y navegador';

$lang['Unban_email'] = 'Quitar ban de una o varias direcciones de email';
$lang['Unban_email_explain'] = 'Usted puede quitar el ban de m&uacute;ltiples direcciones de email usando la correcta combinaci&oacute;n del mouse y teclado de su computadora y navegador';

$lang['No_banned_users'] = 'No hay Usuarios baneados';
$lang['No_banned_ip'] = 'No hay direcciones de IP baneadas';
$lang['No_banned_email'] = 'No hay direcciones de email baneadas';

$lang['Ban_update_sucessful'] = 'La lista de BAN ha sido actualizada correctamente';
$lang['Click_return_banadmin'] = 'Presione %sAqu&iacute;%s para volver al Panel de Control de BANS';

//
// Configuration
//
$lang['General_Config'] = 'Configuraci&oacute;n General';
$lang['Config_explain'] = 'El siguiente formulario, le permitir&aacute; cambiar las opciones de su foro. Para la configuraci&oacute;n de Usuarios y Foros use los enlaces de la izquierda.';

$lang['Click_return_config'] = 'Presione %sAqu&iacute;%s para volver a la Configuraci&oacute;n General';

$lang['General_settings'] = 'Configuraci&oacute;n General del Foro';
$lang['Server_name'] = 'Nombre de Dominio';
$lang['Server_name_explain'] = 'El nombre de dominio en el que corre este Foro';
$lang['Script_path'] = 'Path del Script';
$lang['Script_path_explain'] = 'El path en donde phpBB2 est&aacute; ubicado, relativo al nombre de dominio';
$lang['Server_port'] = 'Puerto del Servidor';
$lang['Server_port_explain'] = 'El puerto en el que corre el servidor, generalmente 80. Solo cambiar si difiere de este valor.';
$lang['Site_name'] = 'Nombre del Sitio';
$lang['Site_desc'] = 'Descripci&oacute;n del Sito';
$lang['Board_disable'] = 'Desactivar Foro';
$lang['Board_disable_explain'] = 'Esto har&aacute; que el los Usuarios no tengan acceso al Foro. No se desloguee mientras desactiva el Foro, ya que no podr&aacute; volver a loguearse nuevamente';
/*****[BEGIN]******************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
$lang['Board_disable_msg'] = 'Mensaje para el Foro desactivado';
$lang['Board_disable_msg_explain'] = 'Este mensaje se mostrar&aacute; en el Foro cuando el mismo este desactivado..';
/*****[END]********************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
$lang['Acct_activation'] = 'Activar cuenta';
$lang['Acc_None'] = 'Ninguna'; // These three entries are the type of activation
$lang['Acc_User'] = 'Usuario';
$lang['Acc_Admin'] = 'Administrador';

$lang['Abilities_settings'] = 'Configuraci&oacute;n B&aacute;sica de Usuario y del Foro';
$lang['Max_poll_options'] = 'N&uacute;mero m&aacute;ximo de items en Encuentas';
$lang['Flood_Interval'] = 'Intervalo de Flood';
$lang['Flood_Interval_explain'] = 'Cantidad de segundos que el usuario debe esperar para publicar topicos';
$lang['Board_email_form'] = 'Email de Usuarios a trav&eacute;s del Foro';
$lang['Board_email_form_explain'] = 'Los usuarios se env&iacute;an emails mediante el Foro';
$lang['Topics_per_page'] = 'Temas por P&aacute;gina';
$lang['Posts_per_page'] = 'Respuestas por P&aacute;gina';
$lang['Hot_threshold'] = 'Cantidad de respuestas para ser considerado Popular';
$lang['Default_style'] = 'Estilo por defecto';
$lang['Override_style'] = 'Ignorar el estilo del Usuario';
$lang['Override_style_explain'] = 'Se utilizar&aacute; el estilo seleccionado por defecto sin importar la elecci&oacute;n del usuario';
$lang['Default_language'] = 'Idioma por Defecto';
$lang['Date_format'] = 'Formato de la Fecha';
$lang['System_timezone'] = 'Zona Horaria';
$lang['Enable_gzip'] = 'Activar la Compresi&oacute;n GZip';
$lang['Enable_prune'] = 'Habilitar Purga en el Foro';
$lang['Allow_HTML'] = 'Permitir HTML';
$lang['Allow_BBCode'] = 'Permitir BBCode';
$lang['Allowed_tags'] = 'Permitir etiquetas HTML';
$lang['Allowed_tags_explain'] = 'Separare tags con comas';
$lang['Allow_smilies'] = 'Permitir Emoticones';
$lang['Smilies_path'] = 'Almacenaje de la ruta de los Emoticones';
$lang['Smilies_path_explain'] = 'Ruta desde el directorio phpBB , ejemplo images/smilies';
$lang['Allow_sig'] = 'Permitir Firmas';
$lang['Max_sig_length'] = 'Longitud m&aacute;xima de la Firma';
$lang['Max_sig_length_explain'] = 'M&aacute;ximo cantidad de caracteres de la Firma';
$lang['Allow_name_change'] = 'Permitir el Cambio del Nombre de Usuario';

$lang['Avatar_settings'] = 'Configuraci&oacute;n de Avatares';
$lang['Allow_local'] = 'Habilitar galer&iacute;as de Avatares';
$lang['Allow_remote'] = 'Habilitar Avatares Remotos';
$lang['Allow_remote_explain'] = 'Permitir mostrar Avatares guardados en otros sitios web';
$lang['Allow_upload'] = 'Habilitar subida de Avatares';
$lang['Max_filesize'] = 'Tama&ntilde;o m&aacute;ximo para las im&aacute;genes';
$lang['Max_filesize_explain'] = 'Para archivos de Avatares subidos';
$lang['Max_avatar_size'] = 'M&aacute;ximas Dimensiones del Avatar';
$lang['Max_avatar_size_explain'] = '(Altura x Ancho en pixels)';
$lang['Avatar_storage_path'] = 'Ruta de Almacenamiento de Avatar';
$lang['Avatar_storage_path_explain'] = 'Ruta donde se encuentran los Avatars, ejemplo images/avatars';
$lang['Avatar_gallery_path'] = 'Ruta de la Galer&iacute;a de Avatares';
$lang['Avatar_gallery_path_explain'] = 'Ruta de la galer&iacute;a, e.g. images/avatars/gallery';

$lang['COPPA_settings'] = 'Configuraciones COPPA';
$lang['COPPA_fax'] = 'N&uacute;mero de Fax COPPA';
$lang['COPPA_mail'] = 'Direcci&oacute;n de Correo COPPA';
$lang['COPPA_mail_explain'] = 'Esta es la direcci&oacute;n de correo donde los padres deben enviar el formulario COPPA';

$lang['Email_settings'] = 'Configuraci&oacute;n de Email';
$lang['Admin_email'] = 'Direcci&oacute;n Email del Administrador';
$lang['Email_sig'] = 'Firma en Email';
$lang['Email_sig_explain'] = 'Este texto se a&ntilde;adir&aacute; al final de cada email';
$lang['Use_SMTP'] = 'Usar servidor SMTP para Email';
$lang['Use_SMTP_explain'] = 'Diga S&iacute;, si usted puede y/o debe enviar los emails por un servidor SMTP';
$lang['SMTP_server'] = 'Direcci&oacute;n SMTP del Servidor';
$lang['SMTP_username'] = 'Nombre de usuario del SMTP';
$lang['SMTP_username_explain'] = 'Ingrese un nombre de usuario solamente si su servidor SMTP lo requiere';
$lang['SMTP_password'] = 'Contrase&ntilde;a del SMTP';
$lang['SMTP_password_explain'] = 'Ingrese una contrase&ntilde;a solamente si su servidor SMTP lo requiere';

$lang['Disable_privmsg'] = 'Mensaje Privado';
$lang['Inbox_limits'] = 'M&aacute;xima cantidad de mensajes en la Bandeja de Entrada';
$lang['Sentbox_limits'] = 'M&aacute;xima cantidad de mensajes en la Bandeja de Salida';
$lang['Savebox_limits'] = 'M&aacute;xima cantidad de mensajes en La Carpeta para Guardar';

$lang['Cookie_settings'] = 'Configuraci&oacute;n de las Cookies'; 
$lang['Cookie_settings_explain'] = 'Esto controla como se env&iacute;an las cookies al Navegador, en la mayor&iacute;a de los casos la configuraci&oacute;n preestablecida sera m&aacute;s que suficiente. Si necesita cambiar esto tenga cuidado, ya que en caso de configurarlo mal podr&iacute;a hacer que sus Usuarios no puedan Ingresar al Foro';
$lang['Cookie_domain'] = 'Dominio de la Cookie';
$lang['Cookie_name'] = 'Nombre de la Cookie';
$lang['Cookie_path'] = 'Ruta de la Cookie';
$lang['Cookie_secure'] = 'Cookie segura [ https ]';
$lang['Cookie_secure_explain'] = 'Si su servidor est&aacute; corriendo via SSL marque esta opci&oacute;n de otra manera d&eacute;jelo deshabilitado';
$lang['Session_length'] = 'Duraci&oacute;n de la sesi&oacute;n [ segundos ]';
/*****[BEGIN]******************************************
 [ Mod:     Guests Postings Security Code      v1.0.0 ]
 ******************************************************/
$lang['Guest_Security_Code'] = 'Codigo de Seguridad para permitir Invitado Anuncios';
$lang['Guest_Security_Code_explain'] = 'Si a este conjunto si, todos los huespedes tienen que volver a escribir un codigo de seguridad antes de su desplazamiento se acepte';
/*****[END]********************************************
 [ Mod:     Guests Postings Security Code      v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Guests Search Security Code        v1.0.0 ]
 ******************************************************/
$lang['Guest_Search_Security_Code'] = 'Codigo de Seguridad para permitir busquedas de usuario';
$lang['Guest_Search_Security_Code_explain'] = 'Si a este conjunto si, todos los huespedes tienen que volver a escribir un codigo de seguridad antes de su busqueda se acepte';
/*****[END]********************************************
 [ Mod:     Guests Search Security Code        v1.0.0 ]
 ******************************************************/

// Visual Confirmation
$lang['Visual_confirm'] = 'Habilitar confirmaci&oacute;n visual';
$lang['Visual_confirm_explain'] = 'Exige a los usuarios escribir un c&oacute;digo de seguridad de una imagen cuando se registran definitivamente.';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Permitir conexiones autom&aacute;ticas';
$lang['Allow_autologin_explain'] = 'Permite determinar si los usuarios pueden selecionar conectarse automaticamente cuando visiten los foros';
$lang['Autologin_time'] = 'Llave para Conexi&oacute;n Autom&aacute;tica Caduca';
$lang['Autologin_time_explain'] = 'Tiempo de validez de la llave en D&iacute;as, s&iacute; el usuario no visita los foros. Establece Cero para deshabilitar la caducidad.';
// Search Flood Control - added 2.0.20
$lang['Search_Flood_Interval'] = 'Buscar Intervalo de Flood';
$lang['Search_Flood_Interval_explain'] = 'N&uacute;mero de segundos que un usuario debe esperar entre solicitudes de b&uacute;squeda'; 
$lang['Stylesheet_explain'] = 'Nombre de archivo para la cadena de estilos CSS a emplear para este theme.';

//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Intentos de conexi&oacute;n permitidos';
$lang['Max_login_attempts_explain'] = 'El n&uacute;mero de intentos permitidos de conexi&oacute;n al foro.';
$lang['Login_reset_time'] = 'Tiempo de cierre de la conexi&oacute;n';
$lang['Login_reset_time_explain'] = 'Tiempo en minutos que el usuario debe esperar hasta que se le permita conectarse de nuevo despu&eacute;s de exceder el n&uacute;mero de intentos de conexi&oacute;n.';

//
// Forum Management
//
$lang['Forum_admin'] = 'Administraci&oacute;n del Foro';
$lang['Forum_admin_explain'] = 'Desde este panel usted puede a&ntilde;adir, borrar, editar, y re-ordenar categor&iacute;as y Foros';
$lang['Edit_forum'] = 'Editar el Foro';
$lang['Create_forum'] = 'Crear un nuevo Foro';
$lang['Create_category'] = 'Crear una nueva Categor&iacute;a';
$lang['Remove'] = 'Quitar';
$lang['Action'] = 'Acci&oacute;n';
$lang['Update_order'] = 'Actualizar Orden';
$lang['Config_updated'] = 'Configuraci&oacute;n del Foro actualizada satisfactoriamente';
$lang['Edit'] = 'Editar';
$lang['Delete'] = 'Borrar';
$lang['Move_up'] = 'Hacia arriba';
$lang['Move_down'] = 'Hacia abajo';
$lang['Resync'] = 'sincronizar';
$lang['No_mode'] = 'Ning&uacute;n modo ha sido seleccionado';
$lang['Forum_edit_delete_explain'] = 'El siguiente formulario le permitir&aacute; personalizar las opciones del Foro. Para la configuraci&oacute;n de usuarios y Foros utilice los enlaces de la izquierda.';

$lang['Move_contents'] = 'Mover todos los contenidos';
$lang['Forum_delete'] = 'Borrar el Foro';
$lang['Forum_delete_explain'] = 'El siguiente formulario le permitir&aacute; Borrar alg&uacute;n foro (o categor&iacute;a) y decir donde desea colocar todos los T&oacute;picos y Categor&iacute;as.';

$lang['Status_locked'] = 'Cerrado';
$lang['Status_unlocked'] = 'Abierto';
$lang['Forum_settings'] = 'Configuraci&oacute;n General del Foro';
$lang['Forum_name'] = 'Nombre del Foro';
$lang['Forum_desc'] = 'Descripci&oacute;n';
$lang['Forum_status'] = 'Estado del Foro';
$lang['Forum_pruning'] = 'Auto-pruning';

$lang['prune_freq'] = 'Chequear t&oacute;picos y edad';//Ver Pruning!
$lang['prune_days'] = 'Remover T&oacute;picos que no tienen respuesta';
$lang['Set_prune_data'] = 'Usted ha seleccionado la opci&oacute;n Auto-pruning para este foro pero no ha seleccionado la frecuencia o cantidad de d&iacute;as para el PRUNE. Por favor regrese y efect&uacute;e los cambios';

$lang['Move_and_Delete'] = 'Mover y Borrar';

$lang['Delete_all_posts'] = 'Borrar todos los Temas';
$lang['Nowhere_to_move'] = 'No hay lugar a donde mover';

$lang['Edit_Category'] = 'Editar Categor&iacute;a';
$lang['Edit_Category_explain'] = 'Utilice este formulario para Editar categor&iacute;as';

$lang['Forums_updated'] = 'La informaci&oacute;n del Foro y sus categor&iacute;as han sido actualizadas satisfactoriamente';

$lang['Must_delete_forums'] = 'Necesita Borrar todos los foros antes de borrar una Categor&iacute;a';

$lang['Click_return_forumadmin'] = 'Presione %sAqu&iacute;%s para volver a la Administraci&oacute;n del Foro';

//
// Smiley Management
//
$lang['smiley_title'] = 'Utilitario para la edici&oacute;n de Emoticones';
$lang['smile_desc'] = 'Desde esta p&aacute;gina usted puede a&ntilde;adir, quitar o editar alg&uacute;n emoticon para que los Usuarios utilicen en el foro y en los mensajes Privados';

$lang['smiley_config'] = 'Configuraci&oacute;n de Emoticones';
$lang['smiley_code'] = 'C&oacute;digo del Emoticon';
$lang['smiley_url'] = 'Archivo de Imagen del Emoticon';
$lang['smiley_emot'] = 'Descripci&oacute;n del Emoticon';
$lang['smile_add'] = 'A&ntilde;adir un nuevo Emoticon';
$lang['Smile'] = 'Emoticon';
$lang['Emotion'] = 'Descripci&oacute;n';

$lang['Select_pak'] = 'Seleccione el archivo .pak';
$lang['replace_existing'] = 'Reemplazar Emoticones Existentes';
$lang['keep_existing'] = 'Mantener Emoticones Existentes';
$lang['smiley_import_inst'] = 'Usted debe descomprimir el paquete de Emoticones y subir todos los archivos en el directorio de Smiles para as&iacute; lograr su correcta instalaci&oacute;n. Luego seleccione la informaci&oacute;n correcta desde este formulario para as&iacute; poder importar los Smiles';
$lang['smiley_import'] = 'Importar paquete de Emoticones';
$lang['choose_smile_pak'] = 'Escoger Pack de Emoticones (.pak)';
$lang['import'] = 'Importar Emoticones';
$lang['smile_conflicts'] = 'Que se deber&iacute;a realizar en caso de conflicto';
$lang['del_existing_smileys'] = 'Borrar los smiles existentes antes de importarlos';
$lang['import_smile_pack'] = 'Importar Paquete de Emoticonos';
$lang['export_smile_pack'] = 'Crear un paquete de Emoticonos';
$lang['export_smiles'] = 'Para crear un paquete de Emoticonos de los que hay instalados, presione %sAqu&iacute;%s para bajar el archivo smiles.pak. Nombre este archivo de forma apropiada pero aseg&uacute;rese de mantener la extension .pak. Luego cree un archivo zip que contenga todos los smileys m&aacute;s el archivo .pak.';

$lang['smiley_add_success'] = 'Los Emoticonos han sido a&ntilde;adidos satisfactoriamente';
$lang['smiley_edit_success'] = 'Los Emoticonos han sido actualizados satisfactoriamente ';
$lang['smiley_import_success'] = 'El paquete de Emoticonos ha sido importado correctamente.';
$lang['smiley_del_success'] = 'Los Emoticonos han sido removidos satisfactoriamente.';
$lang['Click_return_smileadmin'] = 'Presione %sAqu&iacute;%s para volver al Panel de Emoticonos';
$lang['Confirm_delete_smiley'] = '&iquest;Est&aacute; seguro de eliminar este emotic&oacute;n?';
//
// User Management
//
$lang['User_admin'] = 'Administraci&oacute;n de Usuario';
$lang['User_admin_explain'] = 'Desde aqu&iacute; usted puede cambiar la informaci&oacute;n de tus usuarios. Para modificar los permisos de un Usuario por favor utilice el Sistema de Permisos de usuarios y Grupos.';

$lang['Look_up_user'] = 'Observar Usuario';

$lang['Admin_user_fail'] = 'No se ha logrado actualizar el perfil del Usuario';
$lang['Admin_user_updated'] = 'El perfil del Usuario ha sido actualizado satisfactoriamente';
$lang['Click_return_useradmin'] = 'Presione %sAqu&iacute;%s para volver al Panel de Administraci&oacute;n de Usuarios';

$lang['User_delete'] = 'Borrar Usuario';
$lang['User_delete_explain'] = 'Presione aqu&iacute; para borrar este Usuario. Tenga en cuenta que luego no podr&aacute; restaurarlo.';
$lang['User_deleted'] = 'El Usuario ha sido borrado satisfactoriamente.';

$lang['User_status'] = 'Usuario Activo';
$lang['User_allowpm'] = 'Puede enviar mensajes privados';
$lang['User_allowavatar'] = 'Puede mostrar su Avatar';
/*****[BEGIN]******************************************
 [ Mod:     User Signature Control             v1.0.0 ]
 ******************************************************/
$lang['user_allowsignature'] = 'Puede mostrar la firma';
/*****[END]********************************************
 [ Mod:     User Signature Control             v1.0.0 ]
 ******************************************************/

$lang['Admin_avatar_explain'] = 'Desde aqu&iacute; puede ver y borrar el Avatar del Usuario';

$lang['User_special'] = 'Campos especiales para Administradores';
$lang['User_special_explain'] = 'Estos campos no est&aacute;n disponibles para que los Usuarios lo modifiquen. Desde aqu&iacute; usted puede configurar el status y otras opciones que los Usuarios no pueden modificar.';

//
// Group Management
//
$lang['Group_administration'] = 'Administraci&oacute;n de Grupo';
$lang['Group_admin_explain'] = 'Desde este panel puede modificar los Grupos, usted puede borrar, crear y editar los Grupos existentes. Tambi&eacute;n puede escoger los Moderadores y cambiar el nombre del Grupo y su descripci&oacute;n';
$lang['Error_updating_groups'] = 'Ha ocurrido un error actualizando el Grupo';
$lang['Updated_group'] = 'El Grupo ha sido actualizado correctamente';
$lang['Added_new_group'] = 'El Nuevo Grupo ha sido creado';
$lang['Deleted_group'] = 'El Grupo ha sido borrado';
$lang['New_group'] = 'Crear Nuevo Grupo';
$lang['Edit_group'] = 'Editar Grupo';
$lang['group_name'] = 'Nombre del Grupo'; 
$lang['group_description'] = 'Descripci&oacute;n del Grupo';
$lang['group_moderator'] = 'Moderador del Grupo';
$lang['group_status'] = 'Estado del Grupo';
$lang['group_open'] = 'Grupo Abierto';
$lang['group_closed'] = 'Grupo Cerrado';
$lang['group_hidden'] = 'Grupo Oculto';
$lang['group_delete'] = 'Borrar Grupo';
$lang['group_delete_check'] = 'Borrar este Grupo';
$lang['submit_group_changes'] = 'Enviar Cambios';
$lang['reset_group_changes'] = 'Anular Cambios';
$lang['No_group_name'] = 'Debe especificar un Nombre para este Grupo';
$lang['No_group_moderator'] = 'Debe especificar un Moderador para este Grupo';
$lang['No_group_mode'] = 'Debe especificar el modo de este Grupo, Abrierto o Cerrado';
$lang['No_group_action'] = 'No se especific&oacute; una acci&oacute;n'; 
$lang['delete_group_moderator'] = '&iquest;Borrar el antiguo moderador del Grupo?';
$lang['delete_moderator_explain'] = 'Si est&aacute; cambiando el moderador del Grupo, seleccione esta casilla para remover el antiguo Moderador del Grupo. Sino el Usuario se convertir&aacute; en un miembro regular.';
$lang['Click_return_groupsadmin'] = 'Presione %sAqu&iacute;%s para volver al Panel de Administraci&oacute;n de Grupos.';
$lang['Select_group'] = 'Seleccione un Grupo';
$lang['Look_up_group'] = 'Observar un Grupo';

//
// Prune Administration
//
$lang['Forum_Prune'] = 'Purga de Foros';
$lang['Forum_Prune_explain'] = 'Esto borrar&aacute; todos los temas en los que no se hayan publicado nuevos mensajes en los d&iacute;as que usted seleccion&oacute;. Si no ingresa un n&uacute;mero entonces todos los temas ser&aacute;n borrados. No se borrar&aacute;n temas en los que hay encuestas que est&eacute;n corriendo ni anuncios. Tendr&aacute; que remover estos temas en forma manual.';
$lang['Do_Prune'] = 'Realizar Purga';
$lang['All_Forums'] = 'Todos los Foros';
$lang['Prune_topics_not_posted'] = 'Borrar temas sin respuestas de una antigüedad de estos d&iacute;as';
$lang['Topics_pruned'] = 'Temas purgados';
$lang['Posts_pruned'] = 'Mensajes purgados';
$lang['Prune_success'] = 'La purga de los foros ha sido exitosa';

//
// Word censor
//
$lang['Words_title'] = 'Control de Palabras Censuradas';
$lang['Words_explain'] = 'Desde aqu&iacute; usted puede a&ntilde;adir, editar, y quitar palabras que autom&aacute;ticamente ser&aacute;n censuradas de sus foros. Estas palabras no podr&aacute;n ser escogidas como nombres de usuarios. Los Asteriscos (*) son aceptados en los campos de las palabras, ejemplo *prueba* , prueba* (acaparar&iacute;a pruebalo), *test (acaparar&iacute;a enprueba).';
$lang['Word'] = 'Palabra';
$lang['Edit_word_censor'] = 'Editar el Censor de Palabras';
$lang['Replacement'] = 'Reemplazar';
$lang['Add_new_word'] = 'Agregar nueva palabra';
$lang['Update_word'] = 'Actualizar censor de palabras';

$lang['Must_enter_word'] = 'Debe colocar una palabra y su reemplazo';
$lang['No_word_selected'] = 'No se ha seleccionado una palabra para editar';

$lang['Word_updated'] = 'Se han realizado los cambios satisfactoriamente';
$lang['Word_added'] = 'La nueva palabra ha sido a&ntilde;adida con &eacute;xito';
$lang['Word_removed'] = 'La palabra ha sido removida del Censurador de Palabras';

$lang['Click_return_wordadmin'] = 'Clickee %sAqu&iacute;%s para regresar al Administrador de Palabras Censuradas';
$lang['Confirm_delete_word'] = '&iquest;Est&aacute; seguro de eliminar esta palabra censurada?';

//
// Mass Email
//
$lang['Mass_email_explain'] = 'Desde aqu&iacute; usted puede enviar mensajes de email a todos sus Usuarios y Grupos. Al hacer esto un email ser&aacute; enviado desde el email administrativo inidicado previamente. Si env&iacute;a este email a un Grupo numeroso por favor sea paciente y espere a que termine de cargar la p&aacute;gina. Es normal que tarde unos cuantos minutos, usted sera notificado una vez finalizado el env&iacute;o.';
$lang['Compose'] = 'Escribir'; 

$lang['Recipients'] = 'Emails'; 
$lang['All_users'] = 'A todos los Usuarios';

$lang['Email_successfull'] = 'Su email ha sido enviado';
$lang['Click_return_massemail'] = 'Presione %sAqu&iacute;%s para volver al Panel para Enviar emails Masivos';

//
// Ranks admin
//
$lang['Ranks_title'] = 'Administraci&oacute;n de Rangos';
$lang['Ranks_explain'] = 'Usando este formulario usted puede a&ntilde;adir, editar, ver y borrar rangos. Usted tambi&eacute;n puede crear rangos';

$lang['Add_new_rank'] = 'A&ntilde;adir Rango';

$lang['Rank_title'] = 'T&iacute;tulo del Rango';
$lang['Rank_special'] = 'Establecer como Rango Especial';
$lang['Rank_minimum'] = 'Cantidad M&iacute;nima de Mensajes';
$lang['Rank_maximum'] = 'Cantidad M&aacute;xima de Mensajes';
$lang['Rank_image'] = 'Im&aacute;gen del rango (tenga en cuenta la ruta del foro phpBB2)';
$lang['Rank_image_explain'] = 'Utilice esto para definir una peque&ntilde;a imagen para este rango';

$lang['Must_select_rank'] = 'Debe seleccionar un Rango';
$lang['No_assigned_rank'] = 'No se ha seleccionado un Rango';

$lang['Rank_updated'] = 'El Rango ha sido actualizado';
$lang['Rank_added'] = 'El nuevo Rango se ha a&ntilde;adido';
$lang['Rank_removed'] = 'El Rango ha sido borrado';
$lang['No_update_ranks'] = 'El rango ha sido eliminado satisfactoriamente. sin embargo, las cuentas de usuarios que usan este rango no se actualizan.  Usted necesita cambiar el rango manualmente en cada usuario';

$lang['Click_return_rankadmin'] = 'Presione %sAqu&iacute;%s para volver al Panel de Adminstraci&oacute;n de Rangos';
$lang['Confirm_delete_rank'] = '&iquest;Est&aacute; seguro de eliminar este rango?';

//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Control de Admisi&oacute;n de Nombre de Usuario';
$lang['Disallow_explain'] = 'Desde aqu&iacute; puede controlar los nombres de usuario que desea que no sean utilizados. Para lograr esto debe utilizar comodines con asteriscos (*). Recuerde que no puede prohibir nombres de usuario que ya est&eacute;n siendo utilizados. Antes de prohibir dichos nombres debe borrar a los usuarios que lo usen.';

$lang['Delete_disallow'] = 'Borrar';
$lang['Delete_disallow_title'] = 'Borrar un nombre de usuario no permitido';
$lang['Delete_disallow_explain'] = 'Usted puede remover nombres de usuario no permitidos seleccionando el nombre de usuario de la lista y pulsar el boton borrar';

$lang['Add_disallow'] = 'A&ntilde;adir';
$lang['Add_disallow_title'] = 'A&ntilde;adir un nombre de usuario no permitido';
$lang['Add_disallow_explain'] = 'Usted puede no permitir un nombre de usuario utilizando m&aacute;scaras con asteriscos(*)';

$lang['No_disallowed'] = 'Nombres de usuarios no permitidos';

$lang['Disallowed_deleted'] = 'El nombre de usuario no permitido ha sido borrado';
$lang['Disallow_successful'] = 'El nombre de usuario no permitido ha sido agregado';
$lang['Disallowed_already'] = 'El nombre de usuario no permitido que ha seleccionado no puede ser seleccionado. Debido a que ya existe en la lista, o existe en la Lista de Palabras Censuradas, o bien ya se encuentra en la lista de usuarios no permitidos';

$lang['Click_return_disallowadmin'] = 'Presione %sAqui%s para volver al Control de Admisi&oacute;n de Usuario';

$lang['Install'] = 'Instalar';
$lang['Upgrade'] = 'Actualizar';

$lang['Install_No_PCRE'] = 'phpBB2 requiere el m&oacute;dulo de expresiones regulares compatible con Perl para PHP, que no figura como soportado en su configuraci&oacute;n de PHP!';

$lang['theme'] = 'Theme';

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$lang['wrap_title'] = 'Force Word Wrapping';
$lang['wrap_enable'] = 'Force Word Wrapping';
$lang['wrap_min'] = 'Ancho m&iacute;nimo de la pantalla';
$lang['wrap_max'] = 'Ancho m&aacute;ximo de la pantalla';
$lang['wrap_def'] = 'Ancho por defecto de la pantalla';
$lang['wrap_units'] = 'Caracteres';
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/

//
// Version Check
//
$lang['Version_up_to_date'] = 'Tu instalaci&oacute;n est&aacute; actualizada, no existen nuevas actualizaciones para tu versi&oacute;n de phpBB.';
$lang['Version_not_up_to_date'] = 'Tu instalaci&oacute;n no est&aacute; actualizada. Existe una actualizaci&oacute;n disponible para tu versi&oacute;n de phpBB.';
$lang['Latest_version_info'] = 'La &uacute;ltima versi&oacute;n disponible es <b>phpBB %s</b>. ';
$lang['Current_version_info'] = 'T&uacute; est&aacute;s ejecutando la versi&oacute;n <b>phpBB %s</b>.';
$lang['Connect_socket_error'] = 'Imposible conectarse con el servidor de phpBB, el error reportado es:<br />%s';
$lang['Socket_functions_disabled'] = 'Imposible usar los socket.';
$lang['Mailing_list_subscribe_reminder'] = 'para obtener la &uacute;ltima informaci&oacute;n sobre las actualizaciones de phpBB, por que no te <a href="http://www.phpbb.com/support/" target="_blank">suscribes a lista de correo</a>.';
$lang['Version_information'] = 'Informaci&oacute;n de la Versi&oacute;n';

/*****[BEGIN]******************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
$lang['Board_statistic'] = 'Estad&iacute;sticas del Foro';
$lang['Database_statistic'] = 'Estad&iacute;sticas de la Base de Datos';
$lang['Version_info'] = 'Informaci&oacute;n de la Versi&oacute;n';
$lang['Thereof_deactivated_users'] = 'N&uacute;mero de miembros inactivos';
$lang['Thereof_Moderators'] = 'N&uacute;mero de Moderadores';
$lang['Thereof_Administrators'] = 'N&uacute;mero de Administradores';
$lang['Deactivated_Users'] = 'Miembros que aun no est&aacute;n Activos';
$lang['Users_with_Admin_Privileges'] = 'Miembros con privilegios de Administrador';
$lang['Users_with_Mod_Privileges'] = 'Miembros con privilegios de Moderador';
$lang['DB_size'] = 'Tama&ntilde;o de la Base de Datos';
$lang['Version_of_board'] = 'Versi&oacute;n de <a href="http://www.phpbb.com">phpbb</a>';
$lang['Version_of_PHP'] = 'Versi&oacute;n de <a href="http://www.php.net/">PHP</a>';
$lang['Version_of_MySQL'] = 'Versi&oacute;n de <a href="http://www.mysql.com/">MySQL</a>';
/*****[END]********************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$lang['SQR_settings'] = 'Configuraci&oacute;n SRR';
$lang['Allow_quick_reply'] = 'Permitir Respuestas R&aacute;pidas';
$lang['Anonymous_show_SQR'] = 'Mostrar Respuestas R&aacute;pidas para los usuarios An&oacute;nimos.';
$lang['Anonymous_SQR_mode'] = 'Modo de Respuesta R&aacute;pida para usuarios An&oacute;nimos.';
$lang['Anonymous_open_SQR'] = 'Abrir Autom&aacute;ticamente Formulario de Respuestas R&aacute;pidas para Usuarios An&oacute;nimos.';
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:       Admin Userlist                      v2.0.2 ]
 ******************************************************/
$lang['Userlist'] = 'Lista de usuarios';
$lang['Userlist_description'] = '	Ver una lista completa de tus usuarios y realizar varias acciones en ellas';

$lang['Add_group'] = 'Agragar al grupo';
$lang['Add_group_explain'] = 'Selecciona el grupo al que agregar los usuarios';

$lang['Open_close'] = 'Abrir/Cerrar';
$lang['Active'] = 'Activo';
$lang['Group'] = 'Grupo(s)';
$lang['Rank'] = 'Rango';
$lang['Last_activity'] = '&uacute;ltima Actividad';
$lang['Never'] = 'Nunca';
$lang['User_manage'] = 'Administra';
$lang['Find_all_posts'] = 'Buscar todas las discusiones';
$lang['Filter']='Filtro';

$lang['Select_one'] = 'Selecciona uno...';
$lang['Ban'] = 'Banneado';
$lang['Activate_deactivate'] = 'Activar/Desactivar';
$lang['Member_Deactivated'] = 'Miembro Desactivado';

$lang['Sort_User_id'] = 'Por id del Usuario';
$lang['Sort_User_level'] = 'Por Nivel del Usuario';
$lang['Sort_Rank'] = 'Por Rango';
$lang['Sort_Active'] = 'Por Activo';
$lang['Sort_Last_Activity'] = 'Por &uacute;ltima actividad';
$lang['Sort_User_Level'] = 'Por Nivel de Usuario';

$lang['User_id'] = 'ID del Usuario';
$lang['User_level'] = 'Nivel del Usuario';
$lang['Ascending'] = 'Ascendente';
$lang['Descending'] = 'Descendente';
$lang['Show'] = 'Mostrar';
$lang['All'] = 'Todo';

$lang['Member'] = 'Miembro';
$lang['Pending'] = 'Pendiente';

$lang['Confirm_user_ban'] = 'Est&aacute; usted seguro de querer Banear el(los) usuario(s) selecionado(s)?';
$lang['Confirm_user_deleted'] = 'Est&aacute; usted seguro de querer Eliminar el(los) usuario(s) selecionado(s)?';

$lang['User_status_updated'] = 'Estados de los usuarios actualizados satisfactoriamente!';
$lang['User_banned_successfully'] = 'Usuario(s) Bloqueado(s) Satisfactoriamente!';
$lang['User_deleted_successfully'] = '&iexcl;Usuario(s) eliminado(s) exitosamente!';
$lang['User_add_group_successfully'] = 'Usuario(s) Agregado(s) al grupo satisfactoriamente!';
$lang['Cancel'] = 'Cancelar';
$lang['Click_return_userlist'] = 'Haga clic en %saqu&iacute;%s para volver a la lista de usuarios';
/*****[END]********************************************
 [ Mod:       Admin Userlist                      v2.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$lang['Globalannounce'] ='Anuncio Global';
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    PM Quick Reply                      v1.3.5 ]
 ******************************************************/
$lang['ropm_quick_reply'] = 'Respuesta R&aacute;pida en MP';
$lang['enable_ropm_quick_reply'] = 'Habilitar Respuesta R&aacute;pida en MP';
$lang['ropm_quick_reply_bbc'] = 'Habilitar Botones BBCode';
$lang['ropm_quick_reply_smilies'] = 'N&uacute;mero de Emoticones';
$lang['ropm_quick_reply_smilies_info'] = 'Introduce 0, si quieres que no se muestre ning&uacute;n emoticon.';
/*****[END]********************************************
 [ Mod:    PM Quick Reply                      v1.3.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
$lang['Must_select_search'] = 'Usted debe selecionar B&uacute;squeda R&aacute;pida'; //You must select a quick search
$lang['Search_title'] = 'Administraci&oacute;n de B&uacute;squeda R&aacute;pida';
$lang['Search_explain'] = 'Usa esta secci&oacute;n para agregar, editar, y selecionar motores de busqueda para agregar en Busqueda R&aacute;pida.'; //  Using this facility, you can add, edit, and select search tools to add in the quick search
$lang['Search_name'] = 'Nombre del Motor de B&uacute;squeda';
$lang['Search_name_explain'] = 'Este nombre se mostrara en la lista desplegable para selecionar un motor. Ejemplos: <b>Yahoo / Google</b>';
$lang['Search_url'] = 'URL de Busqueda';
$lang['Search_url_explain'] = 'El URL es necesario para que la busqueda funcione. Ejemplo:<br /><span style="color:red">Nota: Si en motor de busqueda necesita alg&uacute;n string adicional <b>DESPU&eacute;S</b> de</span> <b>la Palabra Clave</b><span style="color:red">, Pon el string en la segunda caja! No tienes que agragar ninguna </span> <b>Palabra Clave</b> <span style="color:red">por supuesto, dejalo en blanco.</span><br /><br />- <span style="color:blue">http://search.yahoo.com/search?ei=UTF-8&fr=sfp&p=</span><b>Palabra Clave</b><br />- <span style="color:blue">http://www.google.com/search?hl=en&ie=UTF-8&oe=UTF-8&q=</span><b>Palabra Clave</b><br />- <span style="color:blue">http://www.alltheweb.com/search?cat=web&cs=utf8&q=</span><b>Palabra Clave</b><span style="color:blue">&rys=0&itag=crv&_sb_lang=pref</span><br />';
$lang['Must_enter_search_name'] = 'Usted puede colocar aqui el nombre de la busqueda';
$lang['Search_updated'] = 'Motor de busqueda actualizado satisfactoriamente';
$lang['Search_added'] = 'Motor de busqueda actualizado satisfactoriamente';
$lang['Click_return_addsearchadmin'] = 'Pulsa %sAqu&iacute;%s para volver a Men&uacute; de Administraci&oacute;n - Agregar nuevo Motor.';
// a href, /a tags
$lang['Search_removed'] = 'Motor de Busqueda se ha eliminado satisfactoriamente';
$lang['Add_new_search'] = 'Agregar Motor de Busqueda';
// Quick Search Enable Setting for Board Configuration Panel
$lang['Quick_search_enable'] = 'Habilitar Busqueda R&aacute;pida ';
$lang['Quick_search_enable_explain'] = 'Mostrar Busqueda R&aacute;pida en el Encabezado de los Foros.'; //Shows the Quick Search field in the overall header.
/*****[END]********************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
$lang['sig_title']   = 'Control Avanzado de Firma';
$lang['sig_divider'] = 'Divisor de Firma Actual';
$lang['sig_explain'] = 'Aqu&iacute; puedes poner una serie de caracteres para que dividan la firma del mensaje.';
/*****[END]********************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/
$lang['Default_avatar'] = 'Establecer Avatar por Defecto';
$lang['Default_avatar_explain'] = 'Aqu&iacute; selecionas quieres poner a los usuarios nuevos que no tienes avantar. Puede poner uno para invitados y otro para usuarios registrado sin avatar asignado o para ambos.<br />La ruta donde debe estar es \'modules/Forums/avatars/gallery\'';
$lang['Default_avatar_guests'] = 'Invitados';
$lang['Default_avatar_users'] = 'Usuarios Registrados';
$lang['Default_avatar_both'] = 'Ambos';
$lang['Default_avatar_none'] = 'Ninguno';
/*****[END]********************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
$lang['Board_disable_adminview'] = 'Acceso Administrativo con los Foros deshabilitados.';
$lang['Board_disable_adminview_explain'] = 'Esta opci&oacute;n permite a los Administradores entrar a los Foros cuando estos entan desabilitados.';
/*****[END]********************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/
$lang['URL_server_error'] = 'La URL Introducida (%s) no concuerda con la URL que reporta el Servidor (%s)';
$lang['URL_error_confirm'] = '&iquest;Quiere usted guardar los cambios?';
/*****[END]********************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/
$lang['pm_allow_threshold'] = 'Umbral para permitir PM';
$lang['pm_allow_threshold_explain'] = 'Establece aqu&iacute; una cantidad m&iacute;nima de intervenciones por parte del usarios para que pueda hacer uso de los mensajes privados.';
/*****[END]********************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
$lang['Max_smilies'] = 'N&uacute;mero maximo de Emoticonos por mensaje';
/*****[END]********************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  Cookie Check                        v1.0.0 ]
 ******************************************************/
$lang['Cookie_server_error'] = 'El Dominio que has puesto para el Cookie (%s) no concuerda con el URL que reporta el Servidor (%s)';
$lang['Cookie_error_confirm'] = '&iquest;Quiere usted guardar la configuraci&oacute;n?';
$lang['Cookie_name_error'] = 'El nombre del Cookie que has puesto(%s) es un nombre est&aacute;ndar de cookie y puede causar problemas.<br/> Una recomendaci&oacute;n puede ser un nombre como %s';
/*****[END]********************************************
 [ Other:  Cookie Check                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
$lang['File_not_deleted'] = 'Usted no ha eliminado el archivo install_tables.php: hagalo antes para poder ver esta p&aacute;gina.';
$lang['Log_action_title'] = 'Registro de Acciones';
$lang['Log_action_explain'] = 'Aqu&iacute; usted puede ver todos las acciones de los Moderadores/Administradores';
$lang['Choose_sort_method'] = 'Seleciona el m&eacute;todo de Clasificaci&oacute;n';
$lang['Order'] = 'Orden';
$lang['Go'] = 'Ir';
$lang['Id_log'] = 'Registro Id';
$lang['Choose_log'] = 'Selecionar Registro';
$lang['Delete'] = 'Eliminar';
$lang['Action'] = 'Acci&oacute;n';
$lang['Topic'] = 'Tema';
$lang['Done_by'] = 'Hecho por';
$lang['User_ip'] = 'IP del Usuario';
$lang['Select_all'] = 'Selecionar Todo';
$lang['Unselect_all'] = 'Deselecionar Todo';
$lang['Date'] = 'Fecha';
$lang['See_topic'] = 'Mirar este Tema';
$lang['Log_delete'] = 'Se han borrado los registros satisfactoriament.';
$lang['Click_return_admin_log'] = 'Pulsa %sAqu&iacute;%s para volver al Registro de acciones';
$lang['Log_Config_updated'] = 'Configuracion del MOD Registro de Acciones satisfactoria.';
$lang['Click_return_admin_log_config'] = 'Pulsa %sAqu&iacute;%s para volver a la configuraci&oacute;n del MOD Registro de Acciones';
$lang['Log_Config'] = 'Configuraci&oacute;n del Registro';
$lang['Log_Config_explain'] = 'Aqu&iacute;, usted puede configurar diversas opciones del MOD Registro de Acciones".';
$lang['General_Config_Log'] = 'Configuraci&oacute;n General del MOD Registro de Acciones';
$lang['Allow_all_admin'] = '&iquest;Permitir a otros administradores mirar el Registro de Acciones?';
$lang['Allow_all_admin_explain'] = 'Esta opci&oacute;n permite selecionar si solo el primer Administrador del sistema puede tener acceso al Registro de Acciones o agregar alg&uacute;n otro';
$lang['Admin_not_authorized'] = 'Lo siento tu no puedes ver esta p&aacute;gina. Solo en Administrador principal esta autorizado para ver esta p&aacute;gina.';
$lang['Add_username_admin_explain'] = 'Seleciona el nombre de otro Administrador para que puede ver el Registro de Acciones.';
$lang['Delete_username_admin_explain'] = 'Seleciona el nombre del Administrador que quieres que deje de ver el Registro de Acciones';
$lang['No_other_admins'] = 'No existen otros Administradores Selecionados';
$lang['No_admins_authorized'] = 'No existen otros Administradores Autorizados';
$lang['Add_Admin_Username'] = 'Seleciona un nombre de usuario para Agregar';
$lang['Delete_Admin_Username'] = 'Seleciona un nombre de usuario para Eliminar';
$lang['No_admins_allow'] = 'No hay Administradores que puedan dar permisos para ver el registro.'; //There are no admins to allow to view the logs
$lang['No_admins_disallow'] = 'No hay Administradores que puedan quitar permisos para ver el registro';
$lang['Admins_add_success'] = 'El Administrador ha sido Agregado a la lista Satisfactoriamente';
$lang['Admins_del_success'] = 'El Administrador ha sido eliminado de la lista satisfactoriamente.';
$lang['Prune_success'] = 'Purga del registro Satisfactoria';
$lang['Prune_of_logs'] = 'Purga de Registros';
$lang['Prune'] = 'Purgar Registros';
$lang['Prune_!'] = 'Purgado!';
$lang['Prune_explain'] = 'Introduce el n&uacute;mero de d&iacute;as que quieres purgar el registro. O = Todos los Registros.';
$lang['LOG_Deleted'] = 'Suprimido';
$lang['LOG_Empty_Entry'] = '-----';
$lang['LOG_Accessed_Administration'] = 'Acceder a la Administracion';
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/
$lang['glance_title'] = 'Opciones de un vistazo';
$lang['glance_override_title'] = 'Prioritario sobre la configuraci&oacute;n de los usuarios';
$lang['glance_news_explain'] = 'Introduce el n&uacute;mero de identificaci&oacute;n del Foro de noticias.<br /><small>Introduce 0 si no tiene un foro de noticias o no quieres que se vean. Separa los foros de noticias con , (1,2,3).</small>';
$lang['glance_num_news_explain'] = 'Introduce el n&uacute;mero de articulos que se puede ver.<br /><small>Introduce 0 si no tienes Foros de Noticas o no quieres que se vean.</small>';
$lang['glance_num_explain'] = 'Introduce el n&uacute;mero de Temas recientes que quieres mostrar.';
$lang['glance_ignore_forums_explain'] = 'Introduce el n&uacute;mero de ID de los Foros que te gustaria se que no se mostraranlos Temas nuevos.<br /><small>Separa los Foros con , (1,2,3). Dejalo en blanco para que se muestren todos.</small>';
$lang['glance_table_width_explain'] = 'Introduce el ancho que te gustaria ver en el bloque de Temas recientes. (Por defecto : 100%)';
$lang['glance_auth_read_explain'] = '&iquest;Mostrar t&iacute;tulos de los temas que los usuarios pueden ver pero no abrir?.';
$lang['glance_topic_length_explain'] = 'Limita el n&uacute;mero de caracteres que se pueden mostrar en el T&iacute;tulo del tema.<br /><small>Establece 0 para mostrar el T&iacute;tulo completo.</small>';
/*****[END]********************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
$lang['Online_time'] = 'Estado de tiempo Conectado'; //Online status time
$lang['Online_time_explain'] = 'N&uacute;mero de segundos para mostrar un usuario Conectado (no use un valor menor a 60).';
$lang['Online_setting'] = 'Configuraci&oacute;n de Estado Conectado';
$lang['Online_color'] = 'Color para el Estado Conectado';
$lang['Offline_color'] = 'Color para el Estado Desconectado';
$lang['Hidden_color'] = 'Color para el Estado Oculto';
/*****[END]********************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   Show Users Today Toggle              v1.0.0 ]
 ******************************************************/
 $lang['show_users_today'] = 'Mostrar en el &iacute;ndice a los usuarios que se han conectado hoy'; //Show users who logged on today on Index
/*****[END]********************************************
 [ Mod:   Show Users Today Toggle              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Group Colors and Ranks             v1.0.0 ]
 ******************************************************/
$lang['group_color'] = 'Selecionar el Color por defecto para este grupo.';
$lang['group_rank'] = 'Seleciona el Rango por defecto para este Grupo.';
/*****[BEGIN]******************************************
 [ Mod:     Group Colors and Ranks             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
$lang['topic_explain'] = 'Usted puede usar cualquier forma de HTML  para hacer esto. Usted puede personalizar un Estilo dieferenta para cada tipo de Tema.';
$lang['locked'] = 'Tema Cerrado';
$lang['sticky'] = 'Importante';
$lang['global'] = 'Anuncio Global';
$lang['announce'] = 'Anuncio';
$lang['current'] = 'Actual';
$lang['current_explain'] = 'Este es tu configuraci&oacute;n actual para este tipo de Tema. Esta es la que se muestra en los Foros.';
$lang['tag'] = 'Cambiar Vista (Por Favor, no use citas o cortan en el c&oacute;digo HTML. Ej: &lt;font color=#FFFFFF&gt;Title&lt;/font&gt;)';
$lang['topic_title'] = 'T&iacute;tulo del Tema';
$lang['moved'] = 'Movido';
$lang['topic_view_settings'] = 'Vista Personalizada del Tema';
/*****[END]********************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
$lang['Initial_user_group'] = 'Grupo de Usuario Inicial';
$lang['Initial_user_group_explain'] = 'Este es el grupo que se asigna a los usuarios cuando se registran.';
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
$lang['hide_images'] = 'Ocultar im&aacute;genes a los Visitantes';
$lang['hide_links'] = 'Ocultar Enlaces a los Visitantes';
$lang['hide_emails'] = 'Ocultar Email a los Visitantes';
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/
$lang['dhtml_menu'] = 'Usar men&uacute; DHTML en la Configuraci&oacute;n de los Foros.<br /><small>Hace el Men&uacute; de configuraci&oacute;n desplegable</small>';
/*****[END]********************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
$lang['user_hide_images'] = 'Ocultar imagenes en el Foro';
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
$lang['smilies_in_titles'] = 'Mostrar Emoticonos en los T&iacute;tulos de los Temas';
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
$lang['logs_view_level'][0] = 'Admins, Mods, Usuarios, An&oacute;nimos';
$lang['logs_view_level'][1] = 'Admins, Mods, Usuarios';
$lang['logs_view_level'][3] = 'Admins, Mods';
$lang['logs_view_level'][2] = 'Admins';
$lang['show_edited_logs'] = 'Mostrar registro de temas Editados';
$lang['show_locked_logs'] = 'Mostrar registro de temas Cerrados';
$lang['show_unlocked_logs'] = 'Mostrar registro de temas Abiertos';
$lang['show_moved_logs'] = 'Mostrar registro de tenas Movidos';
$lang['show_splitted_logs'] = 'Mostrar registro de temas separados';
$lang['allow_logs_view'] = 'Mostrar registro a';
/*****[END]********************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/
$lang['image_resize_width'] = 'Redimensionar Ancho de la imagen';
$lang['image_resize_height'] = 'Redimensionar Alto de la imagen';
/*****[END]********************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
$lang['admin_style'] = 'Usar el tema de la web en la Administraci&oacute;n de los Foros';
/*****[END]********************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
$lang['ADMIN_IP_LOCK'] = 'Admin IP Bloqueo';
$lang['ADMIN_IP_LOCK_OFF'] = 'Deshabilitado';
$lang['ADMIN_IP_LOCK_ON'] = 'Habilitado';
/*****[END]********************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
$lang['user_posts'] = 'Cuenta de Mensajes del Usuario';
/*****[END]********************************************
 [ Mod:    Edit User Post Count                v1.0.0 ]
 *****************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Display Poster Information Once    v2.0.0 ]
 ******************************************************/
$lang['once_settings'] = 'Mostrar una vez por Post';
$lang['show_sig_once'] = 'Mostrar firma una vez por post';
$lang['show_avatar_once'] = 'Mostrar Avatar una vez por post';
$lang['show_rank_once'] = 'Mostrar Rango una vez por post';
/*****[END]********************************************
 [ Mod:     Display Poster Information Once    v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Xdata                              v0.1.1 ]
 ******************************************************/
$lang['User_Permissions'] = 'Premisos de Usuarios';
$lang['Group_Permissions'] = 'Permisos de Grupos';
$lang['Manage_Fields'] = 'Administraci&oacute;n de Campos';
/*****[END]********************************************
 [ Mod:     Xdata                              v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [Mod:      Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
$lang['max_inbox'] = "Tama&ntilde;o m&aacute;ximo de los Mensajes Privados de Usuarios";
$lang['max_sentbox'] = "Tama&ntilde;o m&aacute;ximo de los Mensajes Privados de Usuarios - Mensajes Enviados";
$lang['max_savebox'] = "Tama&ntilde;o m&aacute;ximo de los Mensajes Privados de Usuarios - Mensajes Guardados";
$lang['override_max'] = "Sobreescribir la Configuraci&oacute;n general de los foros";
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/

$lang['Login_page'] = 'P&aacute;g. de Conexi&oacute;n';
$lang['Login_page_explain'] = 'Despu&eacute;s de Conectar, envia al usuario directo a la p&aacute;gina de perf&iacute;l (Si) o al &iacute;ndice del Foro (No)';
$lang['Login_page_index'] = 'Pagina de inicio';
/*****[BEGIN]******************************************
 [ Mod:     Auto Group                         v1.2.2 ]
 ******************************************************/
$lang['group_count'] = 'N&uacute;mero de mensajes requeridos';
$lang['group_count_max'] = 'N&uacute;mero m&aacute;x de mensajes';
$lang['group_count_updated'] = 'el miembro %d ha sido removido, el %d miembro ha sido agregado ha este grupo';
$lang['Group_count_enable'] = 'El usuario ser&aacute; agregado autom&aacute;ticamente cuando escriba un nuevo mensaje';
$lang['Group_count_update'] = 'Agregar/Actualizar nuevos usuarios';
$lang['Group_count_delete'] = 'Borrar/Actualizar usuarios antiguos';
$lang['User_allow_ag'] = "Activar Auto Grupo";
$lang['group_count_explain'] = 'Cuando los usuarios publiquen m&aacute;s mensajes con este valor <i>(en cualquier foro)</i> ser&aacute; agregado a este grupo de usuarios. Esto solo se aplicara si el "'.$lang['Group_count_enable'].'" este activado.';
/*****[END]********************************************
 [ Mod:     Auto Group                         v1.2.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Group Overview                     v1.0.0 ]
 ******************************************************/
$lang['Group_Overview'] = 'Informacion general de grupo';
$lang['GO_group'] = 'Grupo';
$lang['GO_mod'] = 'Moderador de Grupo';
$lang['GO_user'] = 'Miembros';
$lang['GO_status'] = 'Tipo de grupo';
$lang['GO_open'] = 'Grupo abierto';
$lang['GO_hidden'] = 'Grupo Oculto';
$lang['GO_closed'] = 'Grupo cerrado';
$lang['GO_member'] = 'Miembros del Grupo';
$lang['GO_permission'] = 'Permisos de grupo';
$lang['GO_inform'] = 'Grupo de Informacion';
$lang['GO_member_explain'] = '(Haga clic en un nombre de usuario para quitar le)';
$lang['GO_add_member'] = 'Agregar Usuario';
$lang['GO_member_added'] = 'Usuario agregado correctamente al grupo';
$lang['GO_remove_member'] = 'Usuario quitado correctamente del grupo';
$lang['GO_remove_mod'] = 'No puede eliminar el moderador del grupo';
$lang['group_delete_users'] = 'Quitar todos los miembros del grupo';
$lang['group_delete_users_check'] = 'Quitar todos los miembros del grupo de este grupo';
$lang['group_delete_users_explain'] = '(Excluir el moderador del grupo)';
$lang['group_users_removed'] = 'Todos los miembros del grupo se quitaron correctamente.';
$lang['Click_return_go'] = 'Presione %sAqui%s para volver a informacion general del grupo';
/*****[END]********************************************
 [ Mod:     Group Overview                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Various Mods Languages             v1.0.0 ]
 ******************************************************/
$lang['Overall_Permissions'] = 'Permisos globales';
$lang['Post_Icons'] = 'Publicar Iconos';
$lang['Icons_settings'] = 'Configuracion de los iconos';
$lang['Manage_Extend'] = 'Administrar total';
/*****[END]********************************************
 [ Mod:     Various Mods Languages             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Board Message XL                   v1.0.5 ]
 ******************************************************/
$lang['Board_msg_xl'] = 'Mensajes de Foro XL';
/*****[END]********************************************
 [ Mod:     Board Message XL                   v1.0.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Rebuild Search                    v2.4.0a ]
 ******************************************************/
$lang['Rebuild_Search'] = 'Reconstruir busqueda';
/*****[END]********************************************
 [ Mod:     Rebuild Search                    v2.4.0a ]
 ******************************************************/

$lang['Lang_extend_categories_hierarchy']		= 'La jerarquia de categorias';

$lang['Category_attachment']					= 'AdForo en';
$lang['Category_desc']							= 'Descripcion';
$lang['Category_config_error_fixed']			= 'Se ha solucionado un error en la configuracion de categoria';
$lang['Attach_forum_wrong']						= 'Puede agregar un foro a un foro';
$lang['Attach_root_wrong']						= 'Puede agregar un foro al Foro-indice';
$lang['Forum_name_missing']						= 'Puede agregar un foro sin un titulo';
$lang['Category_name_missing']					= 'Puede agregar una categoria sin un titulo';
$lang['Only_forum_for_topics']					= 'Temas solo se encontro en foros';
$lang['Delete_forum_with_attachment_denied']	= 'No puede eliminar un foro con subforos';
$lang['Category_delete']						= 'Eliminar categoria';
$lang['Category_delete_explain']				= 'El formulario que aparece a continuacion, podra eliminar una categoria y decidir donde desea colocar todos los foros y categorias que contenia.';

// forum links type
$lang['Forum_link_url']							= 'Enlace URL';
$lang['Forum_link_url_explain']					= 'Puede configurar aqui un URI a un programa de phpBB, o una direccion URL completa a un externo servidor';
$lang['Forum_link_internal']					= 'Programa de phpBB';
$lang['Forum_link_internal_explain']			= 'Elija Si si invoca un programa que se encuentra en los directorios de phpBB';
$lang['Forum_link_hit_count']					= 'Recuento de visitas';
$lang['Forum_link_hit_count_explain']			= 'Elija Si si desea que el Consejo para contar y mostrar el numero de hit mediante este vinculo';
$lang['Forum_link_with_attachment_deny']		= 'No se puede establecer un foro como un vinculo si ya tiene sub-niveles';
$lang['Forum_link_with_topics_deny']			= 'No se puede establecer un foro como un vinculo si ya tiene temas en';
$lang['Forum_attached_to_link_denied']			= 'Usted no puede adForor un foro o una categoria a un vinculo de Foro';

$lang['Manage_extend']							= 'Configuracion +';
$lang['No_subforums']							= 'No Subforos';
$lang['Forum_type']								= 'No Subforos seleccion tipo de Foro';
$lang['Presets']								= 'Ajustes preestablecidos';
$lang['Refresh']								= 'Actualizar';
$lang['Position_after']							= 'Posicion despues de';
$lang['Link_missing']							= 'Falta el vinculo';
$lang['Category_with_topics_deny']				= 'Temas sigue siendo en este foro. No se puede cambiar en una categoria.';
$lang['Recursive_attachment']					= 'Usted no puede adForor un foro a un nivel mas bajo de su propio rama (recursiva datos adjuntos)';
$lang['Forum_with_attachment_denied']			= 'Puede cambiar una categoria con foros vinculadas en un foro';
$lang['icon']									= 'Icono';
$lang['icon_explain']							= 'Este icono se mostrara en frente del titulo Foro. Puede establecer aqui un URI directo o una $image[] Entrada de clave (vease <em>your_template</em>/<em>your_template</em>.cfg).';

$lang['Lang_extend_post_icons']		            = 'Publicar Iconos';
                                                
$lang['Icons_settings_explain']		            = 'Aqui puede agregar, editar o eliminar iconos de mensajes';
$lang['Icons_auth']					            = 'Nivel de autenticacion';
$lang['Icons_auth_explain']			            = 'El icono solo estara disponible a los usuarios a la medida de este requisito';
$lang['Icons_defaults']				            = 'Asignacion por defecto';
$lang['Icons_defaults_explain']		            = 'Esas tareas se utilizaran en los temas listas de icono cuando no se define para un tema';
$lang['Icons_delete']				            = 'Eliminar un icono';
$lang['Icons_delete_explain']		            = 'Elija un icono para reemplazar este :';
$lang['Icons_confirm_delete']		            = 'Confirma que desea eliminar este ?';
                                                
$lang['Icons_lang_key']				            = 'Titulo de icono';
$lang['Icons_lang_key_explain']		            = 'El titulo de icono se mostrara cuando el usuario establece su raton sobre el icono (titulo o alt declaracion HTML). Puede utilizar texto, o una clave de la matriz de idioma. <br />(Compruebe el idioma/lang_<em>your_language</em>/lang_main.php).';
$lang['Icons_icon_key']				            = 'Icono';
$lang['Icons_icon_key_explain']		            = 'Url de icono o clave a la matriz de imagenes. <br />(Compruebe las plantillas/<em>your_template</em>/<em>your_template</em>.cfg)';
                                                
$lang['Icons_error_title']			            = 'El titulo de icono esta vacio';
$lang['Icons_error_del_0']			            = 'No puede eliminar el icono vacio predeterminado';
                                                
$lang['Refresh']					            = 'Actualizar';
$lang['Usage']						            = 'Uso';
                                                
$lang['Image_key_pick_up']			            = 'Recoger una clave de imagen';
$lang['Lang_key_pick_up']			            = 'Recoger una clave de lang';

$lang['Lang_extend_ranks']                      = 'Filas';
$lang['Lang_extend_merge']                      = 'Combinar temas';
/*****[BEGIN]******************************************
 [ Mod:     Language Extend                    v1.0.1 ]
 ******************************************************/

$lang['Lang_extend_lang_extend'] = 'Extension para paquetes de idiomas';
$lang['Lang_extend__custom'] = 'Paquete de idioma personalizado';
$lang['Lang_extend__phpBB'] = 'paquete de idioma de phpBB';

$lang['Languages'] = 'Lenguajes';
$lang['Lang_management'] = 'Gestion';
$lang['Lang_extend'] = 'Idioma extender Administracion';
$lang['Lang_extend_explain'] = 'Aqui puede agregar o modificar entradas de clave de idiomas';
$lang['Lang_extend_pack'] = 'Lenguaje Paquete';
$lang['Lang_extend_pack_explain'] = 'Es el nombre del paquete, por lo general el nombre de la referencia residuo a';

$lang['Lang_extend_entry'] = 'Entrada de clave de idioma';
$lang['Lang_extend_entries'] = 'Entradas de claves de idioma';
$lang['Lang_extend_level_admin'] = 'Admin';
$lang['Lang_extend_level_normal'] = 'Normal';

$lang['Lang_extend_add_entry'] = 'Agregar una nueva entrada de clave de lang';

$lang['Lang_extend_key_main'] = 'Entrada de idioma de clave principal';
$lang['Lang_extend_key_main_explain'] = 'Esta es la principal entrada clave, generalmente solo uno';
$lang['Lang_extend_key_sub'] = 'Entrada de clave secundaria';
$lang['Lang_extend_key_sub_explain'] = 'Esta segunda entrada clave nivel no se utiliza generalmente';
$lang['Lang_extend_level'] = 'Nivel de la entrada de clave de lang';
$lang['Lang_extend_level_explain'] = 'Nivel de Administracion solo puede utilizarse en el panel de configuracion de administracion. Se puede utilizar en todas partes nivel normal.';

$lang['Lang_extend_missing_value'] = 'Usted tiene que proporcionar al menos el valor de ingles';
$lang['Lang_extend_key_missing'] = 'Falta la clave de entrada principal';
$lang['Lang_extend_duplicate_entry'] = 'Esta entrada ya existe (Ver paquete %)';

$lang['Lang_extend_update_done'] = 'La entrada se ha actualizado correctamente.<br /><br />Haga clic en %sAqui%s para volver a la entrada.<br /><br />Haga clic en %sAqui%s para volver a las entradas de lista';
$lang['Lang_extend_delete_done'] = 'Se ha eliminado correctamente la entrada.<br />Tenga en cuenta que solo clave personalizada se eliminan las entradas, no las entradas claves basicas si existe.<br /><br />Haga clic en %sAqui%s para volver a las entradas de lista';

$lang['Lang_extend_search'] = 'Buscar en las entradas de clave de idioma';
$lang['Lang_extend_search_words'] = 'Palabras para buscar';
$lang['Lang_extend_search_words_explain'] = 'Palabras separadas con un espacio';
$lang['Lang_extend_search_all'] = 'Todas las palabras';
$lang['Lang_extend_search_one'] = 'Uno de los';
$lang['Lang_extend_search_in'] = 'Buscar en';
$lang['Lang_extend_search_in_explain'] = 'Precisa donde buscar';
$lang['Lang_extend_search_in_key'] = 'Claves';
$lang['Lang_extend_search_in_value'] = 'valores';
$lang['Lang_extend_search_in_both'] = 'Ambos';
$lang['Lang_extend_search_all_lang'] = 'Todos los idiomas instalados';

$lang['Lang_extend_search_no_words'] = 'Sin palabras para buscar siempre.<br /><br />Haga clic en %sAqui%s para volver a la lista de paquete.';
$lang['Lang_extend_search_results'] = 'Resultados de busqueda';
$lang['Lang_extend_value'] = 'Valor';
$lang['Lang_extend_level_leg'] = 'Nivel';

$lang['Lang_extend_added_modified'] = '*';
$lang['Lang_extend_modified'] = 'Modificado';
$lang['Lang_extend_added'] = 'Agregado';

/*****[BEGIN]******************************************
 [ Mod:     Language Extend                    v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Overall Auth Permission           v2.4.0a ]
 ******************************************************/
$lang['Auth_Control_Forum'] = 'Autorizacion Control de Foro';
$lang['Forum_auth_explain_overall'] = 'En este panel se puede configurar facilmente las autorizaciones de todos los foros.';
$lang['Forum_auth_explain_overall_edit'] = 'Haga clic encima de uno de los niveles de autenticacion e ir al foro que desea editar. Alli haga clic en la autorizacion que desea cambiar.';
$lang['Forum_auth_overall_restore'] = 'Haga clic aqui para restaurar el modo';
$lang['Forum_auth_overall_stop'] = 'Haga clic aqui para detener la edicion/Restaurar';
/*****[END]********************************************
 [ Mod:     Overall Auth Permission           v2.4.0a ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Edit Profile - Panel Feel          v2.0.0 ]
 ******************************************************/
$lang['Edit_Profile_Panel_Feel'] = 'Editar perfil - Grupo Siente Menu';
$lang['Edit_Profile_Panel_Feel_config'] = 'Siente panel de configuracion';
$lang['Edit_Profile_Panel_Feel_explain'] = 'Elegir de que lado del sitio que desea que el menu Editar perfil para que se muestre cuando el usuario esta editando su perfil.<br /><br />Opciones Explicacion:<br />Derecho y la izquierda son evidentes, pero significa que el menu no\ se mostraran en absoluto y la seccion de Editar perfil sera 1 formulario grande como que solia ser.';
/*****[END]********************************************
 [ Mod:     Edit Profile - Panel Feel          v2.0.0 ]
 ******************************************************/
 
//
// That's all Folks!
// -------------------------------------------------

?>