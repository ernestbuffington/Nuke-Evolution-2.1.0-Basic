<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
*                            $RCSfile: lang_admin_priv_msgs.php,v $
*                            -------------------
*   begin                : Tue January 20 2002
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
*   $Id: lang_admin_priv_msgs.php,v 1.1 2005/07/21 15:49:49 Nivisec Exp $
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

/*************/
/*  IF YOU TRANSLATE THIS FILE, PLEASE UPLOAD IT AT:
/* http://www.nivisec.com/phpbb.php?l=ad
/*************/

/* Added in 1.6.0 */
$lang['PM_View_Type'] = 'Tipo de vista PM';
$lang['Show_IP'] = 'Mostrar la direccion IP';
$lang['Rows_Per_Page'] = 'Filas por pagina';
$lang['Archive_Feature'] = 'Caracteristicas de almacenamiento';
$lang['Inline'] = 'En linea';
$lang['Pop_up'] = 'Elemento emergente';
$lang['Current'] = 'Actual';
$lang['Rows_Plus_5'] = 'Agregar 5 filas';
$lang['Rows_Minus_5'] = 'Quitar 5 filas';
$lang['Enable'] = 'Habilitar';
$lang['Disable'] = 'Deshabilitar';
$lang['Inserted_Default_Value'] = '%s Elemento de configuracion no existe, inserta un valor predeterminado<br />'; // %s = config name
$lang['Updated_Config'] = 'Elemento de configuracion actualizado %s<br />'; // %s = config item
$lang['Archive_Table_Inserted'] = 'Cuadro archivo no existe, lo creo<br />';
$lang['Switch_Normal'] = 'Para cambiar el Modo Normal';
$lang['Switch_Archive'] = 'Para cambiar el modo Archivo';

/* General */
$lang['Deleted_Message'] = 'Eliminado mensaje privado - %s <br />'; // %s = PM title
$lang['Archived_Message'] = 'Mensaje privado archivados - %s <br />'; // %s = PM title
$lang['Archived_Message_No_Delete'] = 'No se puede eliminar %s, Para que se caracterizo Archivo Como bien <br />'; // %s = PM title
$lang['Private_Messages'] = 'Mensajes Privados';
$lang['Private_Messages_Archive'] = 'Archivo de Mensajes Privados';
$lang['Archive'] = 'Archivo';
$lang['To'] = 'Para';
$lang['Subject'] = 'Tema';
$lang['Sent_Date'] = 'Fecha enviada';
$lang['Delete'] = 'Borrar';
$lang['From'] = 'Desde';
$lang['Sort'] = 'Ordenar';
$lang['Filter_By'] = 'Filtrar por';
$lang['PM_Type'] = 'Tipo de PM';
$lang['Status'] = 'Estado';
$lang['No_PMS'] = 'No hay mensajes privados asociada a los criterios de ordenacion para mostrar';
$lang['Archive_Desc'] = 'Mensajes privado que ha elegido archivar aparecen aqui.  Los usuarios ya no pueden tener acceso a estos (remitente y receptor), pero puede ver o eliminarlos en cualquier momento.';
$lang['Normal_Desc'] = 'Todos los mensajes privados su bordo puede administrarse aqui.  Puede leer cualquiera que te gusta y elija Eliminar o archivar (mantener, pero los usuarios no se pueden ver) asi los mensajes.';
$lang['Version'] = 'Version';
$lang['Remove_Old'] = 'Huerfano MPs:</a>&nbsp;<span class="gensmall">Los usuarios que ya no existen podria haber dejado detras de MPs, se retirara.</span>';
$lang['Remove_Sent'] = 'Sent Box PMs:</a>&nbsp;<span class="gensmall">MPs en el cuadro son solo envio copia de exactamente el mismo mensaje que se envio, salvo asignado al remitente despues de que el otro usuario ha leido el PM. Estos no son realmente necesarios.</span>';
$lang['Remove_All'] = 'Todos los MPs:</a>&nbsp;<span class="gensmall">PRECAUCIoN: Se borraran todas MPs</span>';
$lang['Affected_Rows'] = '%d conocida entradas eliminado<br />';
$lang['Removed_Old'] = 'Eliminado todos los huerfanos MPs<br />';
$lang['Removed_Sent'] = 'Eliminado todos los MPs enviados<br />';
$lang['Removed_All'] = 'Eliminado todos los MPs<br />';
$lang['Utilities'] = 'Utilidades de eliminacion masiva';
$lang['Nivisec_Com'] = 'Nivisec.com';

/* PM Types */
$lang['PM_-1'] = 'Todos los tipos'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'Leer MPs'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'Nueva MPs'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'Enviado MPs'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'Guardado MPs (Entrada)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'Guardado MPs (Salida)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'Sin MPs'; //PRIVMSGS_UNREAD_MAIL = 5

/* Errors */
$lang['Error_Other_Table'] = 'Error al consultar una tabla requerida.';
$lang['Error_Posts_Text_Table'] = 'Error al consultar la tabla de texto de mensajes privados.';
$lang['Error_Posts_Table'] = 'Error al consultar de mensajes privados tabla.';
$lang['Error_Posts_Archive_Table'] = 'Error al consultar la tabla de archivo de mensajes privados.';
$lang['No_Message_ID'] = 'Se ha especificado ningun identificador de mensaje.';
/*Special Cases, Do not bother to change for another language */
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_subject'] = $lang['Tema'];
$lang['privmsgs_from_userid'] = $lang['Borrar'];
$lang['privmsgs_to_userid'] = $lang['Para'];
$lang['privmsgs_type'] = $lang['PM_Type'];
$lang['Close_Window'] = 'Cerrar esta ventana';

?>