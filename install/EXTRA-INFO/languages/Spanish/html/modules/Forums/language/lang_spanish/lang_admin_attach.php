<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/**
*
* attachment mod admin [English]
*
* @package attachment_mod
* @version $Id: lang_admin_attach.php,v 1.3 2005/11/20 13:38:55 acydburn Exp $
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
// Attachment Mod Admin Language Variables
//

// Modules, this replaces the keys used
$lang['Control_Panel'] = 'Panel de control';
$lang['Shadow_attachments'] = 'Adjuntos Sombreados';
$lang['Forbidden_extensions'] = 'Extensiones Prohibida';
$lang['Extension_control'] = 'Contro de Extension';
$lang['Extension_group_manage'] = 'Grupos de Extension de Control';
$lang['Special_categories'] = 'Categorias especiales';
$lang['Sync_attachments'] = 'Sincronizar archivos adjuntos';
$lang['Quota_limits'] = 'Limites de cuota';

// Attachments -> Management
$lang['Attach_settings'] = 'Ajustes de los Datos adjuntos';
$lang['Manage_attachments_explain'] = 'Aqui usted puede configurar los ajustes principales para la MOD de los Datos adjuntos. Si usted presiona los ajustes de la prueba abotonan, los Datos adjuntos que la MOD hace algunas pruebas del sistema para estar segura que la MOD trabajara correctamente. Si usted tiene problemas con los archivos que cargan, funcionar con por favor esta prueba, para conseguir un error-mensaje detallado.';
$lang['Attach_filesize_settings'] = 'Ajustes del tama&ntilde;o del archivo de los Datos adjuntos';
$lang['Attach_number_settings'] = 'Ajustes del numero de los Datos adjuntos';
$lang['Attach_options_settings'] = 'Opciones de los Datos adjuntos';

$lang['Upload_directory'] = 'Cargar Directorio';
$lang['Upload_directory_explain'] = 'Entrar en la trayectoria relativa de su instalacion phpBB2 al directorio de la carga por teletratamiento de los Datos adjuntos. Por ejemplo, entrar \'modules/Forums/files\' si su instalacion phpBB2 se localiza en http://www.yourdomain.com/modules/foros y el directorio de Cargar de los Datos adjuntos se localiza en http://www.yourdomain.com/modules/Forums/files.';
$lang['Attach_img_path'] = 'Icono de archivo adjunto de enviados';
$lang['Attach_img_path_explain'] = 'Esta imagen se muestra junto a los enlaces de datos adjuntos en mensajes individuales. Deje este campo vacio si no desea un icono que se va a mostrar. Esta configuracion se sobrescribiran por la configuracion en Administracion de grupos de extension.';
$lang['Attach_topic_icon'] = 'Icono de temas de datos adjuntos';
$lang['Attach_topic_icon_explain'] = 'Esta imagen se muestra antes de temas con datos adjuntos. Deja este campo vacio si no desea un icono que se va a mostrar.';
$lang['Attach_display_order'] = 'Orden de visualizacion de datos adjuntos';
$lang['Attach_display_order_explain'] = 'Aqui puede elegir si desea mostrar los datos adjuntos en mensajes/PMs en tiempo de archivo descendente orden (nueva datos adjuntos primera) o tiempo de archivo ascendente orden (mas antiguo datos adjuntos primera).';
$lang['Show_apcp'] = 'Mostrar panel de control de contabilizacion de nuevos datos adjuntos';
$lang['Show_apcp_explain'] = 'Elegir si desea mostrar el panel de control de contabilizacion de datos adjuntos (si) o el metodo antiguo con dos cuadros para adForor archivos y la edicion sus contabilizados datos adjuntos (no) dentro de la contabilizacion de pantalla. El aspecto de es muy dificil de explicar, por lo tanto, es mejor probarlo.';

$lang['Max_filesize_attach'] = 'Tama&ntilde;o del archivo';
$lang['Max_filesize_attach_explain'] = 'Tama&ntilde;o de archivo maximo para datos adjuntos. Un valor de 0 significa  \'ilimitado\'. Esta configuracion esta restringida por su configuracion del servidor. Por ejemplo, si la carga de su configuracion solo permite un maximo de 2 MB de php, esto puede sobrescribir por la mod.';
$lang['Attach_quota'] = 'Cuota de datos adjuntos';
$lang['Attach_quota_explain'] = 'Pueden contener datos adjuntos todos de espacio de disco maximo en su espacio Web. Un valor de 0 significa \'ilimitado\'.';
$lang['Max_filesize_pm'] = 'Tama&ntilde;o de archivo maximo en la carpeta de mensajes privados';
$lang['Max_filesize_pm_explain'] = 'Datos adjuntos de espacio de disco maximo pueden utilizar up en cuadro de mensaje privado de cada usuario. Un valor de 0 significa \'ilimitado\'.';
$lang['Default_quota_limit'] = 'Limite de cuota predeterminado';
$lang['Default_quota_limit_explain'] = 'Aqui se puede seleccionar el limite de cuota predeterminado asigna automaticamente a usuarios registrados recientemente y usuarios sin un limite de cuota definido. La opcion \'No limite de cuota\' es para no usar cualquier cuotas de datos adjuntos, en su lugar mediante la configuracion predeterminada has definido dentro de este panel de administracion.';

$lang['Max_attachments'] = 'Maximum Numero de archivos adjuntos';
$lang['Max_attachments_explain'] = 'El numero maximo permitido de archivos adjuntos en un mensaje.';
$lang['Max_attachments_pm'] = 'Numero maximo de archivos adjuntos en un mensaje privado';
$lang['Max_attachments_pm_explain'] = 'Definir el numero maximo de archivos adjuntos que el usuario esta autorizado a incluir en un mensaje privado.';

$lang['Disable_mod'] = 'Deshabilitar datos adjuntos mod';
$lang['Disable_mod_explain'] = 'Esta opcion es principalmente para pruebas nuevas plantillas o temas, deshabilita todo de datos adjuntos de funciones, excepto el panel de administracion.';
$lang['PM_Attachments'] = 'Permitir datos adjuntos en mensajes privados';
$lang['PM_Attachments_explain'] = 'Permitir o denegar adForor archivos a mensajes privados.';
$lang['Ftp_upload'] = 'Habilitar la carga FTP';
$lang['Ftp_upload_explain'] = 'Habilitar o deshabilitar la opcion de carga FTP. Si establece que si, tiene que definir la configuracion de FTP de datos adjuntos y ya no utiliza el directorio de carga.';
$lang['Attachment_topic_review'] = 'Desea mostrar datos adjuntos en la ventana de examen de temas ?';
$lang['Attachment_topic_review_explain'] = 'Si elige Si, todos los archivos adjuntos se mostrara en el examen de temas cuando contabilice una respuesta.';

$lang['Ftp_server'] = 'Servidor de la carga FTP';
$lang['Ftp_server_explain'] = 'Aqui puede especificar la direccion de IP o FTP-nombre de host del servidor utilizado para los archivos cargados. Si deja este campo vacio, se utilizara el servidor en el que su Foro phpBB2 esta instalado. Tenga en cuenta que no se permite agregar ftp:// o algo mas a la direccion, simplemente ftp.foo.com o, que es mucho mas rapido, la direccion IP normal.';

$lang['Attach_ftp_path'] = 'Ruta de FTP a su directorio de carga';
$lang['Attach_ftp_path_explain'] = 'El directorio donde se almacenaran sus datos adjuntos. Este directorio no tiene que ser chmodded. No escriba su IP o FTP-direccion aqui, este campo de entrada es solo para la ruta de FTP.<br />Por ejemplo: /home/web/uploads';
$lang['Ftp_download_path'] = 'Descargar vinculo en la ruta de acceso de FTP';
$lang['Ftp_download_path_explain'] = 'Escriba la direccion URL su ruta de FTP, donde se almacenan sus datos adjuntos.<br />Si estas usando un servidor FTP remoto, escriba la direccion url completa, por ejemplo http://www.mystorage.com/phpBB2/upload.<br />Si estas utilizando el host local para almacenar sus archivos, es poder entrar la ruta de direccion url relativa a su directorio phpBB2, por ejemplo \'cargar\'.<br />Se quitara una barra diagonal final. Deje este campo vacio, si la ruta de FTP no es accesible desde Internet. Con este campo vacio es incapaces de utilizar el metodo descarga fisica.';
$lang['Ftp_passive_mode'] = 'Habilitar el modo pasivo de FTP';
$lang['Ftp_passive_mode_explain'] = 'El comando PASV pide que el servidor remoto abrir un puerto para la conexion de datos y volver a la direccion de ese puerto. El servidor remoto escucha en ese puerto y el cliente se conecta a ella.';
$lang['ftp_username'] = 'Nombre de usuario de FTP';
$lang['ftp_password'] = 'Contrase&ntilde;a de FTP';

$lang['No_ftp_extensions_installed'] = 'Usted no es capaz de utilizar los metodos de cargar de FTP, porque las extensiones FTP no se compilan en la instalacion de PHP.';

// Attachments -> Shadow Attachments
$lang['Shadow_attachments_explain'] = 'Aqui puede borrar los datos adjuntos de mensajes cuando los archivos se encuentra en su sistema de archivos, y borrar archivos que ya no se adForon a los envios. Puede descargar o ver un archivo si hace clic en el, si no esta presente relacion,.';
$lang['Shadow_attachments_file_explain'] = 'Aqui puede borrar los datos adjuntos de borrar todos los archivos adjuntos que existen en su sistema de ficheros y no estan asignados a un mensaje existente.';
$lang['Shadow_attachments_row_explain'] = 'Eliminar todos los datos para publicar archivos adjuntos que no existen en el sistema de archivos.';
$lang['Empty_file_entry'] = 'Entrada de archivo vacio';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'Doble-clic en miniatura para datos adjuntos: %s'; // replace %s with physical Filename
$lang['Attach_sync_finished'] = 'Datos adjuntos Syncronization terminado.';
$lang['Sync_topics'] = 'Temas de sincronizacion';
$lang['Sync_posts'] = 'Mensajes de sincronizacion';
$lang['Sync_thumbnails'] = 'Miniaturas de sincronizacion';
// Extensions -> Extension Control
$lang['Manage_extensions'] = 'Administrar extensiones';
$lang['Manage_extensions_explain'] = 'Aqui puede administrar su extensiones de archivo. Si desea a permitir/negar una extension que se cargan, por favor, utilice la gestion de grupos de extension.';
$lang['Explanation'] = 'Explanation';
$lang['Extension_group'] = 'Extension Group';
$lang['Invalid_extension'] = 'Invalid Extension';
$lang['Extension_exist'] = 'The Extension %s already exist'; // replace %s with the Extension
$lang['Unable_add_forbidden_extension'] = 'The Extension %s is forbidden, you are not able to add it to the allowed Extensions'; // replace %s with Extension

// Extensions -> Extension Groups Management
$lang['Manage_extension_groups'] = 'Administre Grupos de la Extension';
$lang['Manage_extension_groups_explain'] = 'He aqui usted puede agregar, puede suprimir y puede modificar sus Grupos de la Extension, usted puede desactivar Grupos de la Extension, los puede asignar una Categoria especial, cambie el mecanismo de descarga y usted puede definir un Icono de Cargar que se exhibio delante de un Anexo perteneciendole al Grupo.';
$lang['Special_category'] = 'Categoria Especial';
$lang['Category_images'] = 'Imagenes';
$lang['Category_stream_files'] = 'Archivos Corrientes';
$lang['Category_swf_files'] = 'Archivos Flash';
$lang['Allowed'] = 'Permitido';
$lang['Allowed_forums'] = 'Foros Permitidos';
$lang['Ext_group_permissions'] = 'Permisos del Grupo';
$lang['Download_mode'] = 'Modo de Descarga';
$lang['Upload_icon'] = 'Cargue Icono';
$lang['Max_groups_filesize'] = 'Maximo tama&ntilde;o del Archivo';
$lang['Extension_group_exist'] = 'Grupo de la Extension %s Ya existe'; // replace %s with the group name
$lang['Collapse'] = '+';
$lang['Decollapse'] = '-';

// Extensions -> Special Categories
$lang['Manage_categories'] = 'Administrar categorias especiales';
$lang['Manage_categories_explain'] = 'Aqui puede configurar las categorias especial. Puede configurar parametros especial y condiciones para las Categorias especial asignado a un grupo de extension.';
$lang['Settings_cat_images'] = 'Configuracion de categoria especial: imagenes';
$lang['Settings_cat_streams'] = 'Configuracion de categoria especial: archivos de secuencia';
$lang['Settings_cat_flash'] = 'Configuracion de categoria especial: archivos de Flash';
$lang['Display_inlined'] = 'Mostrar imagenes entre lineas';
$lang['Display_inlined_explain'] = 'Elija si para mostrar imagenes directamente en el puesto (si) o para mostrar imagenes como un vinculo ?';
$lang['Max_image_size'] = 'Maximo dimensiones de imagen';
$lang['Max_image_size_explain'] = 'Aqui puede definir el maximo permitido de dimension de la imagen para adFororse (ancho x alto en pixeles).<br />Si se establece a 0x0, esta caracteristica esta deshabilitada. Con algunas imagenes esta caracteristica no funcionara debido a limitaciones en PHP.';
$lang['Image_link_size'] = 'Dimensiones del Enlace de Imagen';
$lang['Image_link_size_explain'] = 'Si esta Dimension definida de una Imagen es alcanzada, la Imagen ser exhibida como un Link, en vez de exhibirla adentro En Linea,<br />Si En Linea la Vista est habilitada (la Altura de la x de Anchura en pixeles).<br />Si est colocado para 0x0, esta caracteristica est deshabilitada. Con algunas Imgenes esta Caracteristica no surtir efecto debido a limitaciones en PHP.';
$lang['Assigned_group'] = 'Grupo Asignado';

$lang['Image_create_thumbnail'] = 'Cree Miniatura';
$lang['Image_create_thumbnail_explain'] = 'Siempre cree una Miniatura. Esta caracteristica pasa sobre la disposicion casi todos los Ajustes dentro de esta Categoria Especial, deducen excepcion de las Mximas Dimensiones de Imagen. Con esta Caracteristica una Miniatura ser exhibida dentro del poste, el Usuario puede dar un clic sobre ella abrir la imagen real.<br />Por favor Repare en Que esta caracteristica requiere que Imagick sea instalado, si no es instalada o si Safe-Mode est habilitado el GD-EXTENSION de PHP ser usado. Si el Tipo de Imagen no cuenta con el respaldo de PHP, esta Caracteristica no ser usada.';
$lang['Image_min_thumb_filesize'] = 'El tama&ntilde;o Minusculo minimo del Archivo';
$lang['Image_min_thumb_filesize_explain'] = 'Si una Imagen es ms peque&ntilde;a que este Archivo definido tama&ntilde;o, ninguna Miniatura ser creada, porque es bastante peque&ntilde;a.';
$lang['Image_imagick_path'] = 'El Programa del Imagick (la Ruta Completa)';
$lang['Image_imagick_path_explain'] = 'Entre en la Ruta para el programa del converso de imagick, normalmente /usr/bin/convert (on windows: c:/imagemagick/convert.exe).';
$lang['Image_search_imagick'] = 'Buscar Imagick';

$lang['Use_gd2'] = 'Aproveche GD2 Extension';
$lang['Use_gd2_explain'] = 'PHP puede ser compilado con el GD1 o GD2 Extension para la imagen manipulando. Correctamente crear Miniaturas sin magick de imagen el Anexo Mod usa dos metodos diferentes, a base de su seleccion aqui. Si sus miniaturas estn en una mala calidad o atornilladas arriba, el intento para cambiar este ajuste.';
$lang['Attachment_version'] = 'El Adjunto la Version a la ultima %s'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'Administrar extensiones Prohibida';
$lang['Manage_forbidden_extensions_explain'] = 'Aqui puede agregar o eliminar las extensiones prohibidas. Las extensiones de php, php3 y php4 estan prohibidos predeterminada por razones de seguridad, no puedes eliminarlos.';
$lang['Forbidden_extension_exist'] = 'La Extension prohibida %s Ya existe'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = 'La Extension %s Est definido en sus Extensiones permitidas, por favor suprimalo su antes de que usted lo adicione aqui.';  // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'Los Permisos del Grupo de la Extension -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'He aqui usted puede restringir el Grupo seleccionado de la Extension a Foros de su eleccion (definido en la Caja Permitida de Foros). El Default debe permitir Grupos de la Extension para todos los Foros en los que el Usuario puede AdForor Archivos (la forma normal el Adjunto Mod lo hizo desde el comienzo). Simplemente adicione que esos Foros que usted quiere la Extension Se Agrupan (las Extensiones dentro de este Grupo) estar permitido alli, el default TODOS LOS FOROS enterrar cuando usted le agregue los Foros a la Lista. Usted puede readicionar TODOS LOS FOROS en cualquier Tiempo dado. Si usted le agregue un Foro a su Foro Directiva y el Permiso es colocado para TODOS LOS FOROS nada cambiar. Pero si usted ha cambiado y ha restringido el acceso a ciertos Foros, usted tiene que confirmar de nuevo aqui para adicionar su Foro recien creado. Es fcil de hacer esto automticamente, pero esto le obligar a editar un monton de Archivos, por consiguiente he escogido la manera en que es ahora. Por favor mantenga en mente, que todo sus Foros se encontrarn enumerados aqui.';
$lang['Note_admin_empty_group_permissions'] = 'NOTA:<br />Dentro de los debajo Foros listados sus Usuarios tienen normalmente permiso de pegar archivos, excepto desde que no el Grupo de la Extension tiene permiso de estar adjunto a la presente alli, sus Usuarios son incapaces de pegar cualquier cosa. Si intentan, recibirn Mensajes de Error. Tal vez usted quiere colocar el Permiso \'Post Files\' to ADMIN at these Forums.<br /><br />';
$lang['Add_forums'] = 'Agregue Foros';
$lang['Add_selected'] = 'Agregue Seleccionado';
$lang['Perm_all_forums'] = 'TODOS LOS FOROS';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'Administrar los limites de cuota de datos adjuntos';
$lang['Manage_quotas_explain'] = 'Aqui usted puede agregar/borrar/cambiar de limites de cuota. Usted puede asignar a estos limites de cuota de usuarios y grupos mas tarde. Para asignar un limite de cuota a un usuario, usted tiene que ir a Usuarios->Gestion, seleccione el usuario y veras las opciones en la parte inferior. Para asignar un limite de cuota a un grupo, vaya a Grupos->Gestion, seleccione el grupo para editarlo, y veras los ajustes de configuracion. Si desea ver, usuarios y grupos que estan asignados a un determinado limite de cuota, haga clic en \'Ver\' a la izquierda de la Cuota Descripcion.';
$lang['Assigned_users'] = 'Asignacion de usuarios';
$lang['Assigned_groups'] = 'Asignacion de grupos';
$lang['Quota_limit_exist'] = 'El limite de cuota %s ya existe.'; // Replace %s with the Quota Description

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'Panel de control de archivos adjuntos';
$lang['Control_panel_explain'] = 'Aqui usted puede ver y administrar todos los archivos adjuntos sobre la base de usuarios, archivos adjuntos, etc Reproducciones...';
$lang['File_comment_cp'] = 'Archivo comentario';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = 'Destine * como un comodín para fosforos parciales';
$lang['Size_smaller_than'] = 'El tama&ntilde;o del adjunto más peque&ntilde;o que (bytes)';
$lang['Size_greater_than'] = 'El tama&ntilde;o del adjunto mayor que (bytes)';
$lang['Count_smaller_than'] = 'La cuenta de descarga es más peque&ntilde;a';
$lang['Count_greater_than'] = 'La cuenta de descarga es mayor';
$lang['More_days_old'] = 'Mas que tantos dias de edad';
$lang['No_attach_search_match'] = 'Ningún Adjunto se responsabilizo por sus criterios de busqueda';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'Numero de archivos adjuntos';
$lang['Total_filesize'] = 'Tama&ntilde;o total del Archico';
$lang['Number_posts_attach'] = 'Numero de mensajes con Adjuntos';
$lang['Number_topics_attach'] = 'Numero de temas con archivos adjuntos';
$lang['Number_users_attach'] = 'Usuarios Independientes Publicando Adjuntos';
$lang['Number_pms_attach'] = 'Numero total de archivos adjuntos en mensajes privados';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = 'Estadísticas del Adjunto para %s'; // replace %s with username
$lang['Size_in_kb'] = 'Tama&ntilde;o (KB)';
$lang['Downloads'] = 'Descargas';
$lang['Post_time'] = 'Tiempo del anuncio';
$lang['Posted_in_topic'] = 'Anunciado en el Tema';
$lang['Submit_changes'] = 'Enviar cambios';

// Sort Types
$lang['Sort_Attachments'] = 'Adjuntos';
$lang['Sort_Size'] = 'Tama&ntilde;o';
$lang['Sort_Filename'] = 'Nombre del Archivo';
$lang['Sort_Comment'] = 'Comentarios';
$lang['Sort_Extension'] = 'Extension';
$lang['Sort_Downloads'] = 'Descargas';
$lang['Sort_Posttime'] = 'Mensaje Tiempo';
$lang['Sort_Posts'] = 'Mensajes';

// View Types
$lang['View_Statistic'] = 'EstadIsticas';
$lang['View_Search'] = 'buscar';
$lang['View_Username'] = 'Nombre de usuario';
$lang['View_Attachments'] = 'Adjuntos';

// Successfully updated
$lang['Attach_config_updated'] = 'La configuracion del adjunto actualizada exitosamente';
$lang['Click_return_attach_config'] = 'Click %sAqui%s Para regresar a la Configuracion del Adjunto';
$lang['Test_settings_successful'] = 'Los ajustes Experimentan ya termine, la configuración parece fina.';

// Some basic definitions
$lang['Attachments'] = 'Adjuntos';
$lang['Attachment'] = 'Archivo adjunto';
$lang['Extensions'] = 'Extensiones';
$lang['Extension'] = 'Extension';

// Auth pages
$lang['Auth_attach'] = 'Publicar Archivos';
$lang['Auth_download'] = 'Descargar archivos';

?>