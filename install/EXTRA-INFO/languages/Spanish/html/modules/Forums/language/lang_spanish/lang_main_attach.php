<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/**
*
* attachment mod main [English]
*
* @package attachment_mod
* @version $Id: lang_main_attach.php,v 1.1 2005/11/05 10:25:02 acydburn Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!isset($lang) || !is_array($lang))
{
    $lang = array();
}

//
// Attachment Mod Main Language Variables
//

// Auth Related Entries
$lang['Rules_attach_can'] = 'Usted <strong>puede</strong> adjuntar archivos en este foro';
$lang['Rules_attach_cannot'] = 'Usted <strong>no puede</strong> adjuntar archivos en este foro';
$lang['Rules_download_can'] = 'Usted <strong>puede</strong> descargar archivos en este foro';
$lang['Rules_download_cannot'] = 'Usted <strong>no puede</strong> descargar archivos en este foro';
$lang['Sorry_auth_view_attach'] = 'Lo sentimos, pero usted no esta autorizado a ver o descargar este Anexo';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'Descripcion'; // used in Administration Panel too...
$lang['Downloaded'] = 'Descargar';
$lang['Download'] = 'Descargar'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'Tama&ntilde;o de archivo';
$lang['Viewed'] = 'Ver';
$lang['Download_number'] = '%d Tiempo(s)'; // replace %d with count
$lang['Extension_disabled_after_posting'] = 'La extension \'%s\' fue desactivada por un administrador del foro, por lo tanto, este adjunto no se muestra.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Panel de control registro de datos adjuntos';
$lang['Attach_posting_cp_explain'] = 'Si hace clic en Agregar un archivo adjunto, aparecera el cuadro que para agregar archivos adjuntos.<br />Si haces clic en registrar datos adjuntos, vera una lista de archivos adjuntos ya y es capaces de editarlas.<br />Si desea reemplazar (carga nueva version) un archivo adjunto, usted tiene que haga clic en ambos vinculos. Agregar el archivo adjunto normalmente se haria, posteriormente no haga clic en Agregar datos adjuntos, mas bien clic en cargar nueva version en la entrada de datos adjuntos que desea actualizar.';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Agregar adjunto';
$lang['Add_attachment_title'] = 'Agregar un adjunto';
$lang['Add_attachment_explain'] = 'Si no desea agregar un archivo adjunto en tu mensaje, por favor, deje los campos en blanco';
$lang['File_name'] = 'Nombre del Archivo';
$lang['File_comment'] = 'Comentario del Archivo';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'Datos adjuntos anunciados';
$lang['Options'] = 'Opciones';
$lang['Update_comment'] = 'Actualizar el comentario';
$lang['Delete_attachments'] = 'Eliminar archivos adjuntos';
$lang['Delete_attachment'] = 'Eliminar datos adjuntos';
$lang['Delete_thumbnail'] = 'Eliminar miniaturas';
$lang['Upload_new_version'] = 'Nueva version de carga';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = '%s es un nombre de archivo no valido'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'El archivo adjunto es demasiado grande.<br />No se pudo obtener el maximo que Tama&ntilde;o definido en PHP.<br />El mod datos adjuntos no puede determinar el Tama&ntilde;o maximo de carga definido en el php.ini.';
$lang['Attachment_php_size_overrun'] = 'El archivo adjunto es demasiado grande.<br />Tama&ntilde;o maximo de carga: %d MB.<br />Por favor, tenga en cuenta que este Tama&ntilde;o esta definido en php.ini, esto significa es establecido por PHP y el mod datos adjuntos no puede reemplazar este valor.'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = 'La extension %s no esta permitido'; // replace %s with extension (e.g. .php) 
$lang['Disallowed_extension_within_forum'] = 'No se le permite enviar archivos con la extension de %s dentro de este Forum'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'El archivo adjunto es demasiado grande.<br />Tama&ntilde;o maximo: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = 'Lo sentimos, pero se alcanza el Tama&ntilde;o de archivo maximo de todos los datos adjuntos. Pongase en contacto con el administrador del foro si tiene preguntas.';
$lang['Too_many_attachments'] = 'Se pueden agregar datos adjuntos, desde el maximo. numero de %d Datos adjuntos en este puesto logro'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'Los datos adjuntos /Image debe ser menos %d pixeles de ancho y %d pixeles de alto'; 
$lang['General_upload_error'] = 'Error de carga: no puede cargar datos adjuntos a %s.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = 'Usted tiene que especificar valores en \'Agregar un archivo adjunto\' Cuadro';
$lang['Error_missing_old_entry'] = 'No se puede actualizar adjunto, no pudo encontrar antigua entrada de datos adjuntos';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = 'Lo sentimos, pero se ha alcanzado el Tama&ntilde;o de archivo maximo para datos adjuntos todo en la carpeta de mensajes privados. Elimine algunos de sus datos adjuntos recibido enviado.';
$lang['Attach_quota_receiver_pm_reached'] = 'Lo sentimos, pero el Tama&ntilde;o de archivo maximo de todos los datos adjuntos en la carpeta de mensaje privado de \'%s\' se ha alcanzado. Por favor, que sabe, o esperar a ha eliminado algunos de sus datos adjuntos.';

// Errors -> Download
$lang['No_attachment_selected'] = 'No ha seleccionado un archivo adjunto para descargar o ver.';
$lang['Error_no_attachment'] = 'Los datos adjuntos seleccionado ya no existe';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Usted desea eliminar los datos adjuntos seleccionados?';
$lang['Deleted_attachments'] = 'Se han eliminado los datos adjuntos seleccionados.';
$lang['Error_deleted_attachments'] = 'No se puede eliminar archivos adjuntos.';
$lang['Confirm_delete_pm_attachments'] = 'Usted desea eliminar datos adjuntos todos publicados en este PM?';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'La caracteristica de datos adjuntos esta deshabilitada.';

$lang['Directory_does_not_exist'] = 'El directorio \'%s\' no existe o no se encontro.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'Por favor comprobar si \'%s\' es un directorio.'; // replace %s with directory
$lang['Directory_not_writeable'] = 'Directorio \'%s\' no es escritura. Tendra que crear la ruta de carga y chmod que 777 (o cambio al propietario del propietario que httpd-servidores) para cargar archivos.<br />Si tienes acceso solo normal ftp a cambiar la \'Atributo\' del directorio en rwxrwxrwx.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'No se pudo conectar al servidor FTP: \'%s\'. Compruebe la configuracion de FTP.';
$lang['Ftp_error_login'] = 'No se puede acceder al servidor FTP. El nombre de usuario \'%s\' o la Contrase&ntilde;a es incorrecta. Compruebe la configuracion de FTP.';
$lang['Ftp_error_path'] = 'No pudo tener acceso a directorio de ftp: \'%s\'. Compruebe la configuracion de FTP.';
$lang['Ftp_error_upload'] = 'No se puede cargar archivos al directorio de ftp: \'%s\'. Compruebe la configuracion de FTP.';
$lang['Ftp_error_delete'] = 'No se puede eliminar los archivos en el directorio de ftp: \'%s\'. Compruebe la configuracion de FTP.<br />Otra razon de este error podria ser la inexistencia de los datos adjuntos, por favor cheque este primer en archivos adjuntos de sombra.';
$lang['Ftp_error_pasv_mode'] = 'No se puede habilitar o deshabilitar el modo pasivo de FTP';

// Attach Rules Window
$lang['Rules_page'] = 'Reglas de datos adjuntos';
$lang['Attach_rules_title'] = 'Grupos de Extension permitidas y sus Tama&ntilde;o';
$lang['Group_rule_header'] = '%s -> Tama&ntilde;o maximo de carga: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = 'Extensiones permitidas y sus Tama&ntilde;os';
$lang['Note_user_empty_group_permissions'] = 'NOTA:<br />Que normalmente se permite adjuntar archivos en este Foro, <br />Pero puesto que ningun grupo de extension se permite a adjuntarse aqui, <br />Usted no puede asociar nada. Si intenta, <br />usted recibira un mensaje de error.<br />';

// Quota Variables
$lang['Upload_quota'] = 'Cargar cuota';
$lang['Pm_quota'] = 'PM Cuota';
$lang['User_upload_quota_reached'] = 'Lo sentimos, ha alcanzado su maximo limite de cuota de carga de %d %s'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'Usuario ACP';
$lang['UACP'] = 'Panel de control de datos adjuntos de usuario';
$lang['User_uploaded_profile'] = 'Cargado: %s';
$lang['User_quota_profile'] = 'Cuota: %s';
$lang['Upload_percent_profile'] = '%d%% del total';

// Common Variables
$lang['Bytes'] = 'Bytes';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';
$lang['Attach_search_query'] = 'Busqueda de archivos adjuntos';
$lang['Test_settings'] = 'Ajustes de prueba';
$lang['Not_assigned'] = 'Sin asignar';
$lang['No_file_comment_available'] = 'Ningun comentario de archivo disponible';
$lang['Attachbox_limit'] = 'El cuadro adjunto es %d%% completo';
$lang['No_quota_limit'] = 'Sin limite de cuota';
$lang['Unlimited'] = 'Ilimitado';

?>