<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                             lang_auc.php
 *                            --------------
 *        Version            : 1.0.5
 *        Email            : austin@phpbb-amod.com
 *        Site            : http://phpbb-tweaks.com/
 *        Copyright        : aUsTiN-Inc 2003/5
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      AUC Group                                v1.0.0       06/20/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

/* Admin Panel */
/* Common */
$lang['error']                        = "Error";
$lang['information']                = "Informaci&oacute;n";
$lang['success']                    = "&eacute;xito";

/* Message Die's */
/* Config Panel */
$lang['add_error']                    = "Ambos campos requeridos para agregar un grupo de colores.";
$lang['add_error_2']                = "Este grupo ya existe.";
$lang['add_error_3']                = "Colores HTML son de seis d&iacute;gitos.";
$lang['add_success']                = "Informaci&oacute;n de color actualizada.";
$lang['Return_to_config']           = "Presione Aqu&iacute; para regresar a la %sConfiguracion AUC%s";
$lang['Return_to_management']      = "Presione Aqu&iacute; para regresar a la %sAdministraci&oacute;n AUC%s";
$lang['edit_error']                    = "Selecciona el nombre de un grupo para editar.";
$lang['save_error']                    = "Ambos campos requeridos para editar el grupo.";
$lang['save_error_1']                = "se nombre de grupo ya esta en uso.";
$lang['delete_error']                = "Selecciona uno para eliminar.";
$lang['delete_success']                = "Informaci&oacute;n de color eliminada. Usuarios con esa informaci&oacute;n ser&aacute;n actualizados.";            
/* Management Panel */
$lang['group_delete_user_2']        = "Informaci&oacute;n de colores de usuarios actualizada.";
$lang['choose_user_id_error']        = 'Usted no agregar los nombres de usuario o seleccione uno de la lista desplegable.';

/* Config Panel */
$lang['admin_main_header_c']        = "Nombre de usuario avanzado del color: Configuracion";
$lang['admin_main_header_m']        = "Nombre de usuario avanzado del color: Gestion";
$lang['add_new_color']                = "Agregar nuevo color";
$lang['add_new_color_1']            = "Nombre del grupo de colores<br /><span class='gensmall'>Ejemplo: Equipo de Soporte</span>";
$lang['add_new_color_2']            = "Nombre del grupo de colores<br /><span class='gensmall'>Ejemplo: FFFFFF, Utilice codigos de color HTML.</span>";
$lang['add_new_color_3']            = " Add This ";
$lang['edit_color']                    = "Editar Grupo de color existentes";
$lang['edit_color_1']                = "Todos los grupos de color son de publicacion.";
$lang['edit_color_2']                = "Seleccione Uno";
$lang['edit_color_3']                = " Editar este ";
$lang['editing_color']                = "Modificable Informacion esta por debajo de";
$lang['editing_color_1']            = "Cambiar el nombre del grupo de color";
$lang['editing_color_2']            = "Grupo Cambio de color<br /><span class='gensmall'>Ejemplo: FFFFFF, Use HTML color codes.</span>";
$lang['editing_color_3']            = " Guardar el ";
$lang['delete_color']                = "Eliminar un grupo de colores";
$lang['delete_color_1']                = "Elija un grupo de colores en Eliminar<br /><span class='gensmall'>Advertencia: Esto quitar todos los usuarios de este grupo de color, asi como.</span>";
$lang['delete_color_2']                = "Borrar Opciones";
$lang['delete_color_3']                = " Eliminar grupo de colores ";
$lang['view_group_names']            = "Grupo de colores titulos";
$lang['view_group_colors']            = "Grupo HTML Color";
$lang['view_group_colors_2']        = "Ejemplo";
$lang['view_group_colors_3']        = "Nombre de usuario a color";
$lang['move_up']				      = 'Arriba';
$lang['move_down']				= 'Abajo';

/* Management Panel */
$lang['choose_group']                = "Elija un grupo de colores en Administrar";
$lang['choose_group_2']                = "Grupos existentes de color Para agregar miembros a";
$lang['choose_group_3']                = "Elija uno";
$lang['choose_group_4']                = " Seleccione Grupo ";
$lang['group_selected']                = "Que estas agregando a: <strong>%G%</strong>";
$lang['group_already_assigned']        = "Ya los usuarios En este grupo de color";
$lang['group_assign']                = "Agregar un usuario a este grupo de color";
$lang['group_assign_1']                = " Agregar a grupo Color ";
$lang['group_assign_2']                = "Agregar varios usuarios a este grupo de color, caida una linea para cada usuario.";
$lang['group_user_added']            = "Actualizacion de datos de usuario.";
$lang['group_delete_user']            = "Eliminar un usuario de este grupo de color";
$lang['group_delete_user_1']        = " Eliminar usuario ";

/* Listing Page */
$lang['listing_left']                = "Usuario";
$lang['listing_right']                = "Info de Usuario";
$lang['listing_none']                = 'No hay miembros Sin embargo, se agrego al %s Grupo de Color.';

/*****[BEGIN]******************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
$lang['goup_group']                = 'Agregar un Grupo de discusion a este grupo';
/*****[END]********************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
 $lang['deleted_from_group'] = 'Suprimirse del grupo de color';
 $lang['changed_user_color'] = 'Cambiado de color';
 $lang['added_to_group'] = 'Agregado a este grupo de color';

?>