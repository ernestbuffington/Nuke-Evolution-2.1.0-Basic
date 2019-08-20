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

global $lang_donate, $sitename;

//Common
$lang_donate['DONATIONS'] = 'Donaciones';
$lang_donate['BREAK'] = ':';
$lang_donate['DONATE'] = 'Donar';
$lang_donate['CONFIRM'] = 'Confirmar';

//Index
$lang_donate['VIEW_DONATIONS'] = 'Ver Donaciones';
$lang_donate['MAKE_DONATIONS'] = 'Hacer donaciones';

//Errors
$lang_donate['GEN_NF'] = 'General ajuste no se pudo encontrar';
$lang_donate['PAGE_NF'] = 'Pagina ajuste no se pudo encontrar';
$lang_donate['DON_NF'] = 'Donaciones no se pudo encontrar';
$lang_donate['VALUES_NF'] = 'Donaciones valores no se pudo encontrar';
$lang_donate['CURRENCY_NF'] = 'Codigo de moneda no se pudo encontrar';
$lang_donate['FAILED'] = 'Donacion no ha registrado!';
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">ERROR!</span><br />';
$lang_donate['NO_PP_ADD'] = 'PayPal la direccion no ha sido configurada';
$lang_donate['NO_OR_NEGATIV_VALUE'] = 'Monto es ya sea negativo o 0';

//View
$lang_donate['DATE'] = 'Fecha';
$lang_donate['USERNAME'] = 'Nombre de usuario';
$lang_donate['AMOUNT'] = 'Monto';
$lang_donate['TOTAL'] = 'Total';
$lang_donate['GOAL'] = 'Objetivo';
$lang_donate['DIFF'] = 'Diferencia';
$lang_donate['NEXT'] = 'Siguiente';
$lang_donate['PREV'] = 'Anterior';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['N/A'] = 'N/A';

//Make
$lang_donate['AMOUNT'] = 'Monto';
$lang_donate['TYPE_PRIVATE'] = 'Privado';
$lang_donate['TYPE_ANON'] = 'Anonimo';
$lang_donate['TYPE_REGULAR'] = 'Regular';
$lang_donate['TYPE'] = 'Tipo de donacion';
$lang_donate['MESSAGE'] = 'Mensaje/razon';
$lang_donate['DONATE_TO'] = 'Donar a';
$lang_donate['OTHER'] = 'Otro monto';

//Help
$lang_donate['HELP_TOTAL'] = 'Esto mostrara el monto total donado hasta.';
$lang_donate['HELP_GOAL'] = 'Esto mostrara que el monto total donados hasta vs de este mes el objetivo mensual.';
$lang_donate['HELP_DONATION_REGULAR'] = 'Todo es publico';
$lang_donate['HELP_DONATION_ANON'] = 'Todo excepto la donacion esta oculto en el administrador(s).<br /><br /><strong>NOTE:</strong> PayPal will still have all your information so it is not 100% anonymous';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Su donacion esta oculta al publico pero <strong>not</strong> el administrador.';

//Confirm
$lang_donate['CONFIRM_DONATION'] = 'Confirme su donacion de %s %s?';
$lang_donate['COME_BACK'] = 'Despues de que haya realizado su donacion <strong>PLEASE</strong> Asegurese de utilizar el boton en paypal para volver a este sitio o su donacion no contara.';
$lang_donate['PAYPAL_BACK'] = 'Volver a '.$sitename;

?>