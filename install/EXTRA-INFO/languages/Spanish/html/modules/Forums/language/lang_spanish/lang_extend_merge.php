<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                        lang_extend_merge.php [English]
 *                        -------------------------------
 *    begin                : 28/09/2003
 *    copyright            : Ptirhiik
 *    email                : ptirhiik@clanmckeen.com
 *
 *    version                : 1.0.1 - 21/10/2003
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
if ( $lang_extend_admin )
{
    $lang['Lang_extend_merge'] = 'Simplemente mezcla subprocesos';
}

$lang['Refresh'] = 'Actualizar';
$lang['Merge_topics'] = 'Fusionar temas';
$lang['Merge_title'] = 'Tema nuevo titulo';
$lang['Merge_title_explain'] = 'Este sera el nuevo titulo del ultimo tema. Dejelo en blanco si desea que el sistema para usar el titulo del tema del destino';
$lang['Merge_topic_from'] = 'Tema para fusionar';
$lang['Merge_topic_from_explain'] = 'Este tema se fusionaran para el otro tema. Puede introducir el tema de identificacion, la url del tema, o la url de un puesto en este tema';
$lang['Merge_topic_to'] = 'Destino tema';
$lang['Merge_topic_to_explain'] = 'Este tema recibira todos los puestos del tema precedente. Puede introducir el tema de identificacion, la url del tema, o la url de un puesto en este tema';
$lang['Merge_from_not_found'] = 'El tema de fusionar no se ha encontrado';
$lang['Merge_to_not_found'] = 'El destino tema no se ha encontrado';
$lang['Merge_topics_equals'] = 'No puede mezclar un tema con ella misma';
$lang['Merge_from_not_authorized'] = 'Usted no esta autorizado a moderada temas procedentes del foro del tema de fusionar';
$lang['Merge_to_not_authorized'] =  'Usted no esta autorizado a moderada temas procedentes de la foro del destino tema';
$lang['Merge_poll_from'] = 'Hay una encuesta sobre el tema de fusionarse. Se copian en el destino tema';
$lang['Merge_poll_from_and_to'] = 'El tema de destino ya tiene una encuesta. La encuesta de fusionar el tema sera borrado';
$lang['Merge_confirm_process'] = 'Estas seguro de que desea fusionar <br />"<strong>%s</strong>"<br />para<br />"<strong>%s</strong>"';
$lang['Merge_topic_done'] = 'Los temas que se han fusionado con exito.';

?>