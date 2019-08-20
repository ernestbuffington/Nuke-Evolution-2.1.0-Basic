<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		BASIC
 Nuke-Evo Version       :		2.1.0RC2
 Nuke-Evo Build         :		2352
 Nuke-Evo Patch         :		---
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		03-Feb-2009

 Copyright (c) 2010 by The Nuke Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('ERROR: SERVERPATH AND FILELOCATION ARE DIFFERENT');
}

global $lang_donate;

//Common
$lang_donate['ADMIN_HEADER'] = 'Donaciones Nuke-Evolution :: Panel de Administraci&oacute;n del M&oacute;dulo';
$lang_donate['RETURNMAIN'] = 'Volver al &iacute;ndice de la Administraci&oacute;n';
$lang_donate['DONATIONS'] = 'Donaciones';
$lang_donate['CURRENT_DONATIONS'] = 'Donaciones Actuales';
$lang_donate['DONATION_VALUES'] = 'Valores de la Donaci&oacute;n';
$lang_donate['CONFIG_BLOCK'] = 'Configurar Bloque';
$lang_donate['CONFIG_GENERAL'] = 'Configurar Donaciones';
$lang_donate['CONFIG_PAGE'] = 'Configurar P&aacute;gina';
$lang_donate['ADD_DONATION'] = 'Agregar Donaci&oacute;n';
$lang_donate['EDIT_DONATION'] = 'Editar Donaci&oacute;n';
$lang_donate['DELETE_DONATION'] = 'Borrar Donaci&oacute;n';
$lang_donate['BREAK'] = ':';
$lang_donate['YES'] = 'Si';
$lang_donate['NO'] = 'No';
$lang_donate['DONATION_SUBMIT'] = 'Enviar';

//Config Page & Config Block
$lang_donate['SHOW_AMOUNTS'] = 'Mostrar cantidades';
$lang_donate['SHOW_GOAL'] = 'Mostrar meta';
$lang_donate['SHOW_ANON_AMNTS'] = 'Mostrar an&oacute;nimos';
$lang_donate['BUTTON_IMAGE'] = 'Bot&oacute;n de Imagen';
$lang_donate['NUM_DONATIONS'] = 'N&uacute;mero de donaciones mostradas';
$lang_donate['SHOW_DATES'] = 'Mostrar fecha de donaci&oacute;n';

//Config Page
$lang_donate['PAGE_HEADER_IMG'] = 'Imagen en el Encabezado de la P&aacute;gina';

//Config Donation
$lang_donate['PP_EMAIL'] = 'Direcci&oacute;n de Correo Electr&oacute;nico de PayPal';
$lang_donate['CURRENCY'] = 'Valor Monetario';
$lang_donate['DONATION_NAME'] = 'Nombre de la Donaci&oacute;n';
$lang_donate['DONATION_CODE'] = 'C&oacute;digo de la Donaci&oacute;n';
$lang_donate['MONTHLY_GOAL'] = 'Meta Mensual';
$lang_donate['DATE_FORMAT'] = 'Formato de la Fecha (<a href="http://us3.php.net/date">PHP Date</a>)';
$lang_donate['TYPE'] = 'Tipo de Donaciones';
$lang_donate['TYPE_PRIVATE'] = 'Privada';
$lang_donate['TYPE_ANON'] = 'An&oacute;nima';
$lang_donate['TYPE_REGULAR'] = 'Regular';
$lang_donate['THANK_YOU'] = 'Muchas gracias';
$lang_donate['IMAGE'] = 'Imagen';
$lang_donate['MESSAGE'] = 'Mensaje';
$lang_donate['CANCEL'] = 'Cancelar';
$lang_donate['ALLOW_MESSAGE'] = 'Permitir Mensaje/Raz&oacute;n';
$lang_donate['SCROLL'] = 'Lista de Donaciones Enrrollable';
$lang_donate['NUMBERS'] = 'Mostrar n&uacute;meros';
$lang_donate['CODES'] = 'C&oacute;digos de las Donaciones';
$lang_donate['COOKIE_TRACK'] = 'Seguimiento de las donaciones con cookies';

//Add Donation
$lang_donate['ADD_DONATION'] = 'Agregar Donaci&oacute;n';
$lang_donate['UNAME'] = 'Nombre de Usuario';
$lang_donate['FIRST_NAME'] = 'Primer Nombre';
$lang_donate['LAST_NAME'] = 'Apellido';
$lang_donate['EMAIL_ADD'] = 'Direcci&oacute;n de Correo Electr&oacute;nico';
$lang_donate['DONATION'] = 'Donaci&oacute;n';
$lang_donate['ADDED'] = 'Donaci&oacute;n agregada';
$lang_donate['ADD_TYPE'] = 'Tipo de Donaci&oacute;n';
$lang_donate['DONATE_TO'] = 'Donar a';

//Security
$lang_donate['ACCESS_DENIED'] = '<span style="color: #FF0000; font-weight: bold;">Accesso Denegado</span>';

//Errors
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">ERROR!</span><br />';
$lang_donate['VALUES_NF'] = 'No se pudo encontrar los valores';
$lang_donate['VALUES_ND'] = 'No se pudo mostrar los valores';
$lang_donate['UNAMES_NF'] = 'No se pudo encontrar el nombre de usuario';
$lang_donate['UINFO_NF'] = 'No se pudo encontrar la informaci&oacute;n del usuario';
$lang_donate['TYPES_NF'] = 'No se pudo encontrar los tipos de donaci&oacute;n';
$lang_donate['MISSING_FNAME'] = 'Por favor ingrese el primer nombre';
$lang_donate['MISSING_LNAME'] = 'Por favor ingrese el apellido';
$lang_donate['INVALID_DONATION'] = 'Por favor ingrese una donaci&oacute;n v&aacute;lida';
$lang_donate['INVALID_EMAIL'] = 'Por favor ingrese una direcci&oacute;n v&aacute;lida de correo electr&oacute;nico';
$lang_donate['CODES_SHORT'] = 'Debe ingresar un nombre de c&oacute;digo y un c&oacute;digo PayPal en los c&oacute;digos de las Donaciones:';
$lang_donate['CODES_SPACES'] = 'No se permiten espacios en el c&oacute;digo';

//Current
$lang_donate['DATE'] = 'Fecha';
$lang_donate['USERNAME'] = 'Nombre de Usuario';
$lang_donate['AMOUNT'] = 'Cantidad';
$lang_donate['TOTAL'] = 'Total';
$lang_donate['GOAL'] = 'Meta';
$lang_donate['DIFF'] = 'Diferencia';
$lang_donate['NEXT'] = 'Siguiente';
$lang_donate['PREV'] = 'Anterior';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['N/A'] = 'N/A';

//Help
$lang_donate['HELP_DONATION_ANON'] = 'Todo excepto la donaci&oacute;n es ocultada de los adminitrador(s).<br /><br /><strong>NOTE:</strong> PayPal will still have all the information so it is not 100% anonymous';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Tu donaci&oacute;n ser&aacute; ocultada de ser vista p&uacute;blicamente pero <strong>not</strong> de los Administradores.';
$lang_donate['HELP_DONATION_NAME'] = 'Este es el tipo de donaci&oacute;n primaria';
$lang_donate['HELP_DONATION_CODE'] = 'Este es el c&oacute;digo del tipo de donaci&oacute;n primaria en Paypal';
$lang_donate['HELP_DONATION_CODES'] = 'Este es donde puedes colocar otros tipos de donaci&oacute;n y c&oacute;digos.  Esto es <strong>opcional</strong>.<br /><br />Por ejemplo si desea crear un c&oacute;digo para pagos hospital.<hr>La primera l&iacute;nea es el texto '
                                      .'que se mostrar&aacute; en el cuadro.  Aseg&uacute;rese de poner algo que tenga sentido para las personas.  Se permiten los espacios.<br />Por ejemplo: Gastos en Hospital<br /><br />'
                                      .'La siguiente l&iacute;nea es el c&oacute;digo PayPal que desea emplear.<br />&iexcl;<strong>NO</strong> se permiten espacios!<br />Por ejemplo: gastos_en_hospital<hr>Por lo que el resultado final ser&aacute;:<br />'
                                      .'Gastos en Hospital<br />gastos_en_hospital';
$lang_donate['HELP_COOKIE_TRACK'] = 'Esto celebrara donacion valores en un cookies de los usuarios.  Agrega otra forma de ayudar a realizar un seguimiento donaciones.<br /><strong>Esto solo debe usarse si tienes problemas!</strong>';
?>