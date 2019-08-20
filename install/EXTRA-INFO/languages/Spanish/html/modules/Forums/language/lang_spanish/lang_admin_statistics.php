<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                            lang_admin_statistics.php [English]
 *                              -------------------
 *     begin                : Fri Jan 24 2003
 *     copyright            : (C) 2003 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *
 *     $Id: lang_admin_statistics.php,v 1.21 2003/03/16 18:38:29 acydburn Exp $
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

// Package Module
$lang['Package_module'] = 'Modulo paquete';
$lang['Package_module_explain'] = 'Aqui estan en condiciones de su paquete de tres archivos a un modulo Modulo para la entrega de paquetes.';
$lang['Select_info_file'] = 'Seleccione Informacion de archivo';
$lang['Select_lang_file'] = 'Seleccione archivo de idioma';
$lang['Select_module_file'] = 'Seleccionar modulo de archivo php';
$lang['Package_name'] = 'El nombre del paquete';
$lang['Create'] = 'Crear';

// Install Module
$lang['Install_module_explain'] = 'Aqui se puede instalar un nuevo modulo. Se puede hacer esto con dos metodos. El primero de ellos esta cargando su paquete de modulo con el formulario proporcionado que vera a continuacion. Si carga no funciona para usted, es capaz de cargar el paquete de modulo para su ./modulos/directorio de archivos del paquete, se mostrara automaticamente aqui, a continuacion. Para mas instrucciones de como instalar un paquete de modulo, eche un vistazo a la documentacion proporcionada.<br />Despues de que haya elegido un paquete de modulo para instalar, se le pedira con algunas informaciones sobre el modulo ha elegido. Asegurese de que la informacion del modulo son correctas y que usted cumple los requisitos minimos (es decir, la correcta estadisticas mod version). Se puede elegir el idioma que desea instalar con demasiado. Despues de todo lo ha comprobado y seguro que instalar, haga clic en el boton instalar.<br />El valor predeterminado Instalacion dejar que el modulo desactivado, tienes que activarlo antes de se muestra en la pagina Estadisticas.';
$lang['Select_module_pak'] = 'Seleccione el modulo de paquete';
$lang['Upload_module_pak'] = 'Cargar el modulo de paquete';
$lang['Inst_module_already_exist'] = 'Modulo con el nombre \'%s\' ya existe.<br />Si desea actualizar este modulo, tienes que vaya a modulo de administracion y actualizar el modulo se.<br />Si desea reinstalar completamente este modulo, debera desinstalar el modulo antiguo primero.';
$lang['Incorrect_update_module'] = 'El paquete seleccionado no es una actualizacion para el modulo seleccionado. Asegurese de que ha seleccionado el paquete correcto.';

$lang['Module_name'] = 'Nombre de modulo';
$lang['Module_description'] = 'Descripcion de modulo';
$lang['Module_version'] = 'Modulo Version';
$lang['Required_stats_version'] = 'Minimo requerido estadisticas mod version';
$lang['Installed_stats_version'] = 'Version de mod estadisticas instalados';
$lang['Module_author'] = 'Modulo Autor';
$lang['Author_email'] = 'Direccion de correo electronico del autor';
$lang['Module_url'] = 'Modulo/Autor Pagina principal';
$lang['Update_url'] = 'Actualizacion de modulo pagina (Buscar actualizaciones)';
$lang['Provided_language'] = 'Proporciona el lenguaje';
$lang['Install_language'] = 'Instalar idioma';
$lang['Module_installed'] = 'Modulo instalado correctamente.';
$lang['Module_updated'] = 'Modulo actualizado correctamente.';

// Manage Modules
$lang['Manage_modules_explain'] = 'Aqui se puede administrar sus modulos. Puede modificarlos, eliminarlos, cambiar el orden, activar y desactivarles. Si desea configurar su modulo (configuracion de permisos, edicion de las variables de idioma y mucho mas), debera editar su modulo.<br />Si hace clic en un nombre de modulo, podra ver una vista previa de este modulo.';
$lang['Deactivate'] = 'Desactivado';
$lang['Activate'] = 'Activo';

// Delete Module
$lang['Confirm_delete_module'] = 'Confirma que desea eliminar este modulo';

// Configuration
$lang['Msg_config_updated'] = '- Configuracion de estadisticas mod actualizado correctamente.';
$lang['Msg_reset_view_count'] = '- Numero de vista correctamente doble-clic.';
$lang['Msg_reset_install_date'] = '- Instalar fecha configurado para hoy.';
$lang['Msg_reset_cache'] = '- Todas las caches de borrados correctamente.';
$lang['Msg_purge_modules'] = '- Se elimino correctamente el contenido del directorio de modulos.';
$lang['Config_title'] = 'Estadisticas de configuracion';
$lang['Config_explain'] = 'Aqui usted puede configurar el modelo de Estadistica.';
$lang['Messages'] = 'Mensajes';
$lang['Return_limit'] = 'Volver Limite';
$lang['Return_limit_explain'] = 'El numero de temas a incluir en cada clasificacion.';
$lang['Reset_settings_title'] = 'Restablecer ajustes';
$lang['Reset_view_count'] = 'Restablecer vista contador';
$lang['Reset_view_count_explain'] = 'Restablecer la vista de contador en la parte inferior de la pagina de estadisticas a cero.';
$lang['Reset_install_date'] = 'Restablecer la fecha de instalacion';
$lang['Reset_install_date_explain'] = 'Restablecer la fecha de instalacion. Esto fijara la fecha para la instalacion de hoy.';
$lang['Reset_cache'] = 'Borrar cache';
$lang['Reset_cache_explain'] = 'Borrar toda la cache de datos actual para todos los modulos de contenido y plantillas.';
$lang['Purge_module_dir'] = 'Borrar Modulo Directorio';
$lang['Purge_module_dir_explain'] = 'Eliminar el directorio completo de los modulos, todos los subdirectorios y los archivos seran eliminados. Por favor, use esta opcion solo si esta completamente seguro de lo que hacemos y que este efecto tendra a su Estadisticas.';

// Edit Module
$lang['Msg_changed_update_time'] = '- Hora de actualizacion correctamente cambiado.';
$lang['Msg_cleared_module_cache'] = '- Cache de modulo correctamente liquidado.';
$lang['Msg_module_fields_updated'] = '- Modulo actualizada definible campos correctamente.';

$lang['Module_select_title'] = 'Seleccione el modulo';
$lang['Module_select_explain'] = 'Aqui puede seleccionar el modulo que desea editar.';
$lang['Edit_module_explain'] = 'Aqui se puede configurar el modulo. En la cima vera algunas informaciones de modulo, a continuacion, la ventana de mensajes que se muestran todos los mensajes de actualizacion. En el Buttom encontrara la zona de configuracion y el espacio de modulo de actualizacion. Dentro de la zona de modulo de actualizacion, seleccione un paquete de modulo \'o\' cargar un paquete de modulo, no tanto por favor.<br />El espacio de configuracion puede diferir de un modulo para modulo, porque algunos modulos tienen opciones de configuracion especial el autor cree que seria util para usted.';
$lang['Module_informations'] = 'Informacion del modulo';
$lang['Module_languages'] = 'Vinculado a este modulo de idiomas';
$lang['Preview_module'] = 'Modulo de vista previa';
$lang['Module_configuration'] = 'Modulo de configuracion';
$lang['Update_time'] = 'Actualizacion de tiempo en minutos';
$lang['Update_time_explain'] = 'Intervalo tiempo (en minutos), de actualizar la cache de datos con nuevos datos. Cada x minutos, el modulo de obtener recarga.<br />desde la Direccion de Estadistica esta utilizando un sistema de prioridades, esto podria ser mayor de x minutos, pero no mas de un dia.';
$lang['Module_status'] = 'Estado del modulo';
$lang['Active'] = 'Activo';
$lang['Not_active'] = 'No activo';
$lang['Clear_module_cache'] = 'Borrar la cache del modulo';
$lang['Clear_module_cache_explain'] = 'Borrar la cache del modulo y reiniciar los modulos prioridad. La proxima vez que la pagina de estadisticas que se llama, este Modulo obtener recarga.';
$lang['Update_module'] = 'Modulo de actualizacion';
$lang['No_module_packages_found'] = 'No encuentra el modulo de paquetes';

// Permissions
$lang['Msg_permissions_updated'] = '- Actualizacion de los permisos';
$lang['Permissions'] = 'Permisos';
$lang['Set_permissions_title'] = 'Aqui usted puede configurar el permiso para ver un Modulo. Solo los usuarios (Anonimo, registrados, moderadores y administradores) y grupos permitido / enumerados aqui pueden ver el modulo en la pagina de estadisticas.';
$lang['Perm_all'] = 'Usuarios anonimos';
$lang['Perm_reg'] = 'Usuarios Registrados';
$lang['Perm_mod'] = 'Moderadores';
$lang['Perm_admin'] = 'Administradores';
$lang['Perm_group'] = 'Grupos';
$lang['Added_groups'] = 'Agregar Grupos';
$lang['Perm_add_group'] = 'Agregar grupo';
$lang['Perm_remove_group'] = 'Eliminar grupo';
$lang['Perm_groups_title'] = 'Grupos de poder para ver el modulo';
$lang['No_groups_selected'] = 'No se admiten grupos seleccionados';
$lang['No_groups_to_add'] = 'No hay mas grupos para agregar';

// Language CP
$lang['Language_key'] = 'Idioma variable -> clave';
$lang['Language_value'] = 'Idioma variable -> Valor';
$lang['Update_all_lang'] = 'Actualizacion de todas las entradas';
$lang['Add_new_key'] = 'Agregar nueva clave';
$lang['Create_new_lang'] = 'Crear un nuevo idioma';
$lang['Delete_language'] = 'Eliminar Idioma';
$lang['Language_cp_title'] = 'Idioma del Panel de control';
$lang['Language_cp_explain'] = 'Aqui usted es capaz de gestionar todos los idiomas y Paquetes de Idioma de variables para cada modulo, por separado, a todos ... casi todo. Usted puede importar o exportar paquetes de idioma tambien aqui.';
$lang['Export_lang_module'] = 'Idioma para la exportacion de modulo actual';
$lang['Export_language'] = 'Exportacion completa lenguaje actual';
$lang['Export_everything'] = 'Exportacion de todo';
$lang['Import_new_language'] = 'Importacion nuevo idioma';
$lang['Import_new_language_explain'] = 'Aqui usted puede subir (o seleccione) el paquete de idioma que desea instalar. Despues de haber subido (o seleccionado) el paquete de idioma, vera algunos Informacion sobre el paquete de idioma. Solo despues de ver este paquete de la Informacion se instalara.';
$lang['Select_language_pak'] = 'Selecciona Idioma de paquetes';
$lang['Upload_language_pak'] = 'Paquetes de Idioma Cargar';

$lang['Language'] = 'Idioma';
$lang['Modules'] = 'Modulos';
$lang['Language_pak_installed'] = 'Paquete de idioma instalado con exito.';
$lang['No_package_Up'] = 'No se encontraron los archivos de paquete. Informacion/Lang/PHP Archivos tienen que ser puestos en \'modules/pakfiles\'.';

?>