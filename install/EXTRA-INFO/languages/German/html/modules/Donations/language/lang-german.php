<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

global $lang_donate, $sitename;

//Confirm
$lang_donate['COME_BACK'] = 'Nachdem Du Deine Spende get&auml;tigt hast <strong>MUSST</strong> Du den Button bei PayPal verwenden, um auf diese Seite zur&uuml;ck zu kehren. Ansonsten wird Deine Spende nicht gewertet.';
$lang_donate['CONFIRM_DONATION'] = 'Bitte best&auml;tige Deine Spende von %s %s?';
$lang_donate['PAYPAL_BACK'] = 'Zur&uuml;ck zu '.$sitename;

//Common
$lang_donate['BREAK'] = ':';
$lang_donate['CONFIRM'] = 'Best&auml;tigen';
$lang_donate['DONATE'] = 'Spende';
$lang_donate['DONATIONS'] = 'Spenden';

//Errors
$lang_donate['CURRENCY_NF'] = 'Die W&auml;hrungssymbole konnten nicht gefunden werden';
$lang_donate['DON_NF'] = 'Die Spenden konnten nicht gefunden werden';
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">FEHLER!</span><br />';
$lang_donate['FAILED'] = 'Die Spende konnte nicht gespeichert werden!';
$lang_donate['GEN_NF'] = 'Die generellen Einstellungen konnten nicht gefunden werden';
$lang_donate['NO_OR_NEGATIV_VALUE'] = 'Der eingegebene Betrag ist entweder 0 oder negativ';
$lang_donate['NO_PP_ADD'] = 'Die PayPal Adresse wurde nicht eingetragen';
$lang_donate['PAGE_NF'] = 'Die Seiteneinstellungen konnten nicht gefunden werden';
$lang_donate['VALUES_NF'] = 'Die W&auml;hrungen konnten nicht gefunden werden';

//Help
$lang_donate['HELP_DONATION_ANON'] = 'Alles - auch die Spende - ist auch durch die Administratoren nicht einsehbar.<br /><br /><strong>BEMERKUNG:</strong> PayPal speichert Deine Informationen, so dass es nicht 100%-ig anonym ist';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Deine Spende wird <strong>nur</strong> den Administratoren angezeigt.';
$lang_donate['HELP_DONATION_REGULAR'] = 'Alles ist f&uuml;r jeden sichtbar';
$lang_donate['HELP_GOAL'] = 'Anzeige der bisherigen Spendensumme in diesem Monat mit der monatlichen Zielvorgabe.';
$lang_donate['HELP_TOTAL'] = 'Dies zeigt die bisherige Spendensumme.';

//Index
$lang_donate['MAKE_DONATIONS'] = 'Spenden';
$lang_donate['VIEW_DONATIONS'] = 'Spenden anzeigen';

//Make
$lang_donate['AMOUNT'] = 'Betrag';
$lang_donate['DONATE_TO'] = 'Spende an';
$lang_donate['MESSAGE'] = 'Nachricht/Grund';
$lang_donate['OTHER'] = 'Anderer Betrag';
$lang_donate['TYPE'] = 'Art der Spende';
$lang_donate['TYPE_ANON'] = 'Anonym';
$lang_donate['TYPE_PRIVATE'] = 'Privat';
$lang_donate['TYPE_REGULAR'] = 'Regul&auml;r';

//View
$lang_donate['AMOUNT'] = 'Betrag';
$lang_donate['DATE'] = 'Datum';
$lang_donate['DIFF'] = 'Differenz';
$lang_donate['GOAL'] = 'Ziel';
$lang_donate['N/A'] = 'N/A';
$lang_donate['NEXT'] = 'N&auml;chste';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV'] = 'Vorherige';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['USERNAME'] = 'Benutzername';
$lang_donate['TOTAL'] = 'Gesamt';

?>