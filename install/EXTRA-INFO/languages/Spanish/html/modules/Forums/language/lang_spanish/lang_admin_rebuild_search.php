<?php

/***************************************************************************
 *                       lang_admin_rebuild_search.php [English]
 *                       ---------------------------------------
 *     begin                : Mon Aug 22 2005
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_admin_rebuild_search.php,v 2.4.0.0 2006/06/17 18:38:17 chatasos Exp $
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

$lang['Rebuild_search'] = 'Reconstruir Busqueda';
$lang['Rebuild_search_desc'] = 'Este indice se mod cada anuncio en su foro, la reconstruccion de la busqueda de los cuadros. 
Puede parar cuando quiera y la proxima vez que ejecute de nuevo tendra la opcion de continuar desde donde lo dejaste.<br /><br />
Puede tomar mucho tiempo para mostrar su progreso (en funcion de "Anuncios por ciclo" y "Tiempo limite"), 
asi que por favor no pasar de su progreso hasta que la pagina esta completa, a menos que, por supuesto, usted desea interrumpir su.';

//
// Input screen
//
$lang['Starting_post_id'] = 'A partir post_id';
$lang['Starting_post_id_explain'] = 'Primer anuncio donde comenzara el procesamiento de<br />Puede elegir iniciar desde el principio o desde el anuncio que se detuvo ultima ves';

$lang['Start_option_beginning'] = 'empezar desde el principio';
$lang['Start_option_continue'] = 'continuara desde el ultimo detenido';

$lang['Clear_search_tables'] = 'Borrar los cuadros de busqueda';
$lang['Clear_search_tables_explain'] = 'Cuando se inicia desde el principio se puede borrar el phpBB 3 cuadros de busqueda<br />Usted tiene la opcion de elegir entre BORRAR / TRUNCATE metodos';
$lang['Clear_search_no'] = 'NO';
$lang['Clear_search_delete'] = 'BORRAR';
$lang['Clear_search_truncate'] = 'TRUNCATE';

$lang['Num_of_posts'] = 'Numero de anuncios';
$lang['Num_of_posts_explain'] = 'Numero de anuncios totales a procesar<br />Se rellena automaticamente con el numero del total/puestos restantes se encuentran en la base de datos';

$lang['Posts_per_cycle'] = 'Anuncios por ciclo';
$lang['Posts_per_cycle_explain'] = 'Numero de anuncios a proceso por ciclo<br />Mantenerlo bajo para evitar php/servidor Web tiempos fuera';

$lang['Refresh_rate'] = 'Tasa de actualizacion';
$lang['Refresh_rate_explain'] = 'Cuanto tiempo (segundos) a permanecer inactivo antes de pasar al siguiente ciclo de procesamiento<br />Generalmente no tienes que cambiar esto';

$lang['Time_limit'] = 'Limite de tiempo';
$lang['Time_limit_explain'] = 'Cuanto tiempo (segundos) posterior procesamiento puede durar antes de pasar al siguiente ciclo';
$lang['Time_limit_explain_safe'] = '<em>Su php (modo seguro) tiene un tiempo de espera de %s segundos configurados, por lo tanto, permanecer por debajo de este valor</em>';
$lang['Time_limit_explain_webserver'] = '<em>Su servidor web tiene un tiempo de espera de %s segundos configurados, por lo tanto, permanecer por debajo de este valor</em>';

$lang['Disable_board'] = 'Deshabilitar el foro';
$lang['Disable_board_explain'] = 'Si se deshabilita el foro al procesar o no';
$lang['Disable_board_explain_enabled'] = 'Se habilitara automaticamente despues del final de procesamiento';
$lang['Disable_board_explain_already'] = '<em>El Consejo ya esta deshabilitado a traves de la configuracion de administracion</em>';

$lang['Fast_mode'] = 'Modo rapido';
$lang['Fast_mode_explain'] = 'Procesar toda la base de datos sin quitar entradas en primer lugar<br />Utilizar con precaucion!!! Lea las instrucciones para obtener mas detalles.';

$lang['Max_info'] = '(Max : %d)';

//
// Information strings
//
$lang['Info_processing_stopped'] = 'ultima se detuvo el procesamiento en post_id %s (%s anuncios procesados) en %s';
$lang['Info_processing_aborted'] = 'ultima ha anulado el procesamiento en post_id %s (%s anuncios procesado) en %s';
$lang['Info_processing_aborted_soon'] = 'Espere un poco antes de continuar...';
$lang['Info_processing_finished'] = 'Termino el procesamiento de correctamente (%s anuncios procesado) en %s';
$lang['Info_processing_finished_new'] = 'Que terminado con exito el procesamiento en post_id %s (%s anuncios procesado) en %s,<br />Pero se han producido %s nuevo anuncio(s) despues de esa fecha';

//
// Progress screen
//
$lang['Rebuild_search_progress'] = 'Reconstruir el progreso de la busqueda';

$lang['Processed_post_ids'] = 'ID de procesado posterior : %s - %s';
$lang['Timer_expired'] = 'El temporizador expiro en %s segundos. ';
$lang['Cleared_search_tables'] = 'Tablas de busqueda liquidado. ';
$lang['Deleted_posts'] = '%s anuncio(s) se eliminaron por sus usuarios durante el procesamiento. ';
$lang['Processing_next_posts'] = 'Procesamiento de los siguiente %s anuncio(s). Por favor, espere...';
$lang['All_session_posts_processed'] = 'Procesar todos los anuncios en la sesion actual.';
$lang['All_posts_processed'] = 'Todos los anuncios se procesaban correctamente.';
$lang['All_tables_optimized'] = 'Todas las tablas de busqueda se optimizaron correctamente.';

$lang['Processing_post_details'] = 'Detalles del anuncio de procesamiento';
$lang['Processed_posts'] = 'Mensajes procesados';
$lang['Percent'] = 'Por ciento';
$lang['Current_session'] = 'Sesion actual';
$lang['Total'] = 'Total';

$lang['Process_details'] = 'desde <strong>%s</strong> para <strong>%s</strong> (de total <strong>%s</strong>)';
$lang['Percent_completed'] = '%s %% completado';

$lang['Processing_time_details'] = 'Detalles acerca del tiempo de procesamiento';
$lang['Processing_time'] = 'Tiempo de procesamiento';
$lang['Time_last_posts'] = 'ultimo %s anuncio(s) del actual periodo de sesiones';
$lang['Time_from_the_beginning'] = 'Desde el inicio de sesion actual';
$lang['Time_average'] = 'Promedio por ciclo de la sesion actual';
$lang['Time_estimated'] = 'Estimado hasta el fin del actual periodo de sesiones';

$lang['days'] = 'dias';
$lang['hours'] = 'horas';
$lang['minutes'] = 'minutos';
$lang['seconds'] = 'segundos';

$lang['Database_size_details'] = 'Detalles de tama&ntilde;o de la base de datos';
$lang['Size_current'] = 'Actual';
$lang['Size_estimated'] = 'Estimado despues de finalizar';
$lang['Size_search_tables'] = 'Tama&ntilde;o de las tablas de busqueda';
$lang['Size_database'] = 'Tama&ntilde;o de la base de datos';

$lang['Bytes'] = 'Bytes';

$lang['Active_parameters'] = 'Parametros activos';
$lang['Posts_last_cycle'] = 'Procesados anuncio(s) en el ultimo ciclo';
$lang['Board_status'] = 'Estado del foro';
$lang['Board_disabled'] = 'Discapacitados';
$lang['Board_enabled'] = 'Habilitado';

$lang['Info_estimated_values'] = '(*) Todos los valores estimados se calculan en aproximadamente<br />
			Segun el porcentaje completado actual y no se pueden representar los valores reales finales.<br />
			A medida que aumenta el porcentaje completado los valores estimados se acercarse a los reales.';

$lang['Click_return_rebuild_search'] = 'Haga clic en %saqui%s para volver a buscar reconstruccion';
$lang['Rebuild_search_aborted'] = 'Reconstruir busqueda anulado en post_id %s.<br /><br />Si usted anulado mientras procesamiento se encontraba en, tendra que esperar un poco antes de ejecutar busqueda reconstruir una vez mas, por lo que puede finalizar el ultimo ciclo.';
$lang['Wrong_input'] = 'Ha escrito algunos valores equivocados. Compruebe su entrada y vuelva a intentarlo.';

// Buttons
$lang['Next'] = 'Siguiente';
$lang['Processing'] = 'Procesamiento...';
$lang['Finished'] = 'Terminado';

?>