<?php
/***************************************************************************
 *            lang_extend_post_icons.php [English]
 *            --------------------------
 *  begin       : 28/09/2003
 *  copyright     : Ptirhiik
 *  email       : ptirhiik@clanmckeen.com
 *
 *  version       : 1.0.1 - 28/10/2003
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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

// admin part
$lang['Lang_extend_post_icons']   = 'Publicar Iconos';

$lang['Icons_settings_explain']   = 'Aqui puede agregar, editar o eliminar mensajes de iconos';
$lang['Icons_auth']         = 'Nivel de autenticacion';
$lang['Icons_auth_explain']     = 'El icono solo estara disponible a los usuarios a la medida de este requisito';
$lang['Icons_defaults']       = 'Asignacion por defecto';
$lang['Icons_defaults_explain']   = 'Esas tareas se utilizaran en los temas listas de icono cuando no se define para un tema';
$lang['Icons_delete']       = 'Eliminar un icono';
$lang['Icons_delete_explain']   = 'Por favor, elija un icono con el fin de sustituir este :';
$lang['Icons_confirm_delete']   = 'Estas seguro de que desea eliminar este ?';

$lang['Icons_lang_key']       = 'Icono titulo';
$lang['Icons_lang_key_explain']   = 'El icono titulo se mostrara cuando el usuario configurar su raton sobre el icono (o alt titulo HTML declaracion). Puede utilizar el texto, o una clave de la lengua matriz. <br />(comprobar la lengua/lang_<em>your_language</em>/lang_main.php).';
$lang['Icons_icon_key']       = 'Icono';
$lang['Icons_icon_key_explain']   = 'Icono url o imagenes clave de la matriz. <br />(comprobar plantillas/<em>your_template</em>/<em>your_template</em>.cfg)';

$lang['Icons_error_title']      = 'El icono titulos esta vacio';
$lang['Icons_error_del_0']      = 'No se puede quitar el icono por defecto vacio';

$lang['Refresh']          = 'Actualizar';
$lang['Usage']            = 'Uso';

$lang['Image_key_pick_up']      = 'Recoger una clave de imagen';
$lang['Lang_key_pick_up']     = 'Recoger una clave de lang';


$lang['Icons_settings']     = 'Mensajes de iconos';
$lang['Icons_per_row']      = 'Iconos por fila';
$lang['Icons_per_row_explain']  = 'Establecer aqui el numero de iconos mostrados por fila en la pantalla de contabilizacion';
$lang['post_icon_title']    = 'Icono de mensaje';

// icons
$lang['icon_none']        = 'Ningun icono';
$lang['icon_note']        = 'Nota';
$lang['icon_important']     = 'Importante';
$lang['icon_idea']        = 'Idea';
$lang['icon_warning']     = 'Advertencia !';
$lang['icon_question']      = 'Pregunta';
$lang['icon_cool']        = 'Enfriar';
$lang['icon_funny']       = 'Divertidos';
$lang['icon_angry']       = 'Grrrr !';
$lang['icon_sad']       = 'Snif !';
$lang['icon_mocker']      = 'Hehehe !';
$lang['icon_shocked']     = 'Oooh !';
$lang['icon_complicity']    = 'Complicidad';
$lang['icon_bad']       = 'Mala !';
$lang['icon_great']       = 'Gran !';
$lang['icon_disgusting']    = 'Beark !';
$lang['icon_winner']      = 'Gniark !';
$lang['icon_impressed']     = 'Oh si !';
$lang['icon_roleplay']      = 'Juego de roles';
$lang['icon_fight']       = 'Luchar';
$lang['icon_loot']        = 'Botin';
$lang['icon_picture']     = 'Cuadro';
$lang['icon_calendar']      = 'Calendario de eventos';

?>