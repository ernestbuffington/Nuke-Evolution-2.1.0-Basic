<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
*                            $RCSfile: lang_admin_topic_shadow.php,v $
*                            -------------------
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
*   $Id: lang_admin_topic_shadow.php,v 1.3 2003/06/26 00:16:32 nivisec Exp $
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

/* If you are translating this, please e-mail a copy to me! */
/* admin@nivisec.com is fine to use */

/* General */
$lang['Del_Before_Date'] = 'Borrar todos los Temas ocultos antes de %s<br />'; // %s = insertion of date
$lang['Deleted_Topic'] = 'Borrar los Temas Ocultos con ID %s<br />'; // %s = topic name
$lang['Affected_Rows'] = '%d Las entradas sabidas fueron afectadas<br />'; // %d = affected rows (not avail with all databases!)
$lang['Delete_From_Date'] = 'Todos los Temas Ocultos que fueron creados antes de que la fecha introducida seran eliminados.';
$lang['Delete_Before_Date_Button'] = 'Suprima Todo Antes de la Fecha';
$lang['No_Shadow_Topics'] = 'Ningun Tema oculto fue encontrado.';
$lang['Topic_Shadow'] = 'Tema Oculto';
$lang['TS_Desc'] = 'Permite la remocion de temas ocultos sin la supresion del mensaje real.  Los temas ocultos son creados cuando usted mueve un poste a otro foro y elige dejar atras un enlace en el foro original para el poste nuevo.';
$lang['Month'] = 'Mes';
$lang['Day'] = 'Dia';
$lang['Year'] = 'A&ntilde;o';
$lang['Clear'] = 'Limpie';
$lang['Resync_Ran_On'] = 'Resync Corrio Adelante %s<br />'; // %s = insertion of forum name
$lang['All_Forums'] = 'Todos Los Foros';
$lang['Version'] = 'Version';

$lang['Title'] = 'Titulo';
$lang['Moved_To'] = 'Se Movio para';
$lang['Moved_From'] = 'Se Movio de';
$lang['Delete'] = 'Borrar';

/* Modes */
$lang['topic_time'] = 'Tiempo de Tema';
$lang['topic_title'] = 'Titulo de Tema';

/* Errors */
$lang['Error_Month'] = 'Su mes de aporte debe tener en medio 1 a&ntilde;os de edad y 12';
$lang['Error_Day'] = 'Su dia de aporte debe tener en medio 1 a&ntilde;os de edad y 31';
$lang['Error_Year'] = 'Su año de aporte debe tener en medio 1970 a&ntilde;os de edad y 2038';
$lang['Error_Topics_Table'] = 'El error accediendo a tabla de temas';

//Special Cases, Do not change for another language
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';

?>