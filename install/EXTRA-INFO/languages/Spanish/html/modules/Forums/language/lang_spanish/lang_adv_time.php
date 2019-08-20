<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                        lang_adv_time.php [English]
 *                            -------------------
 *   begin                : Sat July 09 2005
 *   copyright            : (C) 2005 -=ET=- http://www.golfexpert.net/phpbb
 *   email                : n/a
 *   Credit               : cipher_nemo < johnsuit@hotmail.com> (John Suit) n/a
 *
 *   $Id: lang_adv_time.php, 1.0.0, 2005/07/09 00:00:00, -=ET=- Exp $
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

$lang['time_mode'] = 'Gestion del tiempo';
$lang['time_mode_text'] = 'Configuracion del Foro omitira cuando establezca en un modo automatico (Es necesario para las dos primeras JavaScript).<br />Para el modo manual, la diferencia de DST es la diferencia entre horario de verano y el tiempo normal para su pais (de 0 a 120 minutos, normalmente 60).<br /><br />* El modo de marcado por el asterisco esta utilizando de forma predeterminada en este panel y se recomienda por su administrador.';
$lang['time_mode_auto'] = 'Modos automaticos...';
$lang['time_mode_full_pc'] = 'Su tiempo de equipo';
$lang['time_mode_server_pc'] = 'Servidor hora universal, Zona horaria/DST<br /><span STYLE="margin-left: 25">desde su ordenador</span>';
$lang['time_mode_full_server'] = 'Servidor hora local';
$lang['time_mode_manual'] = 'Modo manual...';
$lang['time_mode_dst'] = 'DST posibilitar';
$lang['time_mode_dst_server'] = 'Por el servidor';
$lang['time_mode_dst_time_lag'] = 'DST diferencia';
$lang['time_mode_dst_mn'] = 'min';
$lang['time_mode_timezone'] = 'Zona horaria';

$lang['dst_time_lag_error'] = 'DST diferencia de valor de error. Usted debe escribir un numero de minutos entre 0 y 120.';

$lang['dst_enabled_mode'] = ' [DST permitido]';
$lang['full_server_mode'] = 'Tiempo sincronizado con el tiempo de servidor del Foro';
$lang['server_pc_mode'] = 'Sincronizacion de tiempo. con el servidor - Zona horaria/DST con su equipo';
$lang['full_pc_mode'] = 'Tiempo sincronizado con el tiempo de equipo';

?>