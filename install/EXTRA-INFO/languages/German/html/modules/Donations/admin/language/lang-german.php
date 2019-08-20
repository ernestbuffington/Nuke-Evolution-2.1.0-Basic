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

global $lang_donate;

//Common
$lang_donate['ADMIN_HEADER'] = 'Nuke-Evolution Spenden :: Modul-Administration';
$lang_donate['RETURNMAIN'] = 'Zur&uuml;ck zur Haupt-Administration';
$lang_donate['DONATIONS'] = 'Spenden';
$lang_donate['CURRENT_DONATIONS'] = 'Aktuelle Spendenliste';
$lang_donate['DONATION_VALUES'] = 'Spendenwerte';
$lang_donate['CONFIG_BLOCK'] = 'Blockkonfiguration';
$lang_donate['CONFIG_GENERAL'] = 'Generelle Einstellungen';
$lang_donate['CONFIG_PAGE'] = 'Seitenkonfiguration';
$lang_donate['ADD_DONATION'] = 'Spende hinzuf&uuml;gen';
$lang_donate['EDIT_DONATION'] = 'Spende bearbeiten';
$lang_donate['DELETE_DONATION'] = 'Spende l&ouml;schen';
$lang_donate['BREAK'] = ':';
$lang_donate['YES'] = 'Ja';
$lang_donate['NO'] = 'Nein';
$lang_donate['DONATION_SUBMIT'] = 'Best&auml;tigen';

//Config Page & Config Block
$lang_donate['SHOW_AMOUNTS'] = 'Spende anzeigen';
$lang_donate['SHOW_GOAL'] = 'Spendenziel anzeigen';
$lang_donate['SHOW_ANON_AMNTS'] = 'Anonyme Spender anzeigen';
$lang_donate['BUTTON_IMAGE'] = 'Bild f&uuml;r den Button';
$lang_donate['NUM_DONATIONS'] = 'Anzahl der Spenden die angezeigt werden sollen';
$lang_donate['SHOW_DATES'] = 'Soll das Datum der Spende angezeigt werden';

//Config Page
$lang_donate['PAGE_HEADER_IMG'] = 'Bild f&uuml;r die Best&auml;tigungsseite';

//Config Donation
$lang_donate['PP_EMAIL'] = 'PayPal eMail Adresse';
$lang_donate['CURRENCY'] = 'W&auml;hrung';
$lang_donate['DONATION_NAME'] = 'Name der Spende';
$lang_donate['DONATION_CODE'] = 'Spendencode (Artikelnummer)';
$lang_donate['MONTHLY_GOAL'] = 'monatliches Spendenziel';
$lang_donate['DATE_FORMAT'] = 'Datumsformat (<a href="http://us3.php.net/date">PHP Datumsaufbau</a>)';
$lang_donate['TYPE'] = 'Art der Spenden';
$lang_donate['TYPE_PRIVATE'] = 'Privat';
$lang_donate['TYPE_ANON'] = 'Anonym';
$lang_donate['TYPE_REGULAR'] = 'Regul&auml;r';
$lang_donate['THANK_YOU'] = 'Vielen Dank';
$lang_donate['IMAGE'] = 'Bild';
$lang_donate['MESSAGE'] = 'Kommentar';
$lang_donate['CANCEL'] = 'Abbrechen';
$lang_donate['ALLOW_MESSAGE'] = 'Sollen Nachrichten/Kommentare erlaubt werden';
$lang_donate['SCROLL'] = 'Soll die Spendenliste scrollen';
$lang_donate['NUMBERS'] = 'Fortlaufende Nummerierung anzeigen';
$lang_donate['CODES'] = 'Spendencodes';
$lang_donate['COOKIE_TRACK'] = 'Sollen die Spenden per Cookie verfolgt werden';

//Add Donation
$lang_donate['ADD_DONATION'] = 'Eine Spende hinzuf&uuml;gen';
$lang_donate['UNAME'] = 'Benutzername';
$lang_donate['FIRST_NAME'] = 'Vorname';
$lang_donate['LAST_NAME'] = 'Familienname';
$lang_donate['EMAIL_ADD'] = 'eMail Adresse';
$lang_donate['DONATION'] = 'Spende';
$lang_donate['ADDED'] = 'Die Spende wurde gespeichert';
$lang_donate['ADD_TYPE'] = 'Spendentyp';
$lang_donate['DONATE_TO'] = 'Spende an';

//Security
$lang_donate['ACCESS_DENIED'] = '<span style="color: #FF0000; font-weight: bold;">Der Zugriff ist nicht gestattet</span>';

//Errors
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">FEHLER!</span><br />';
$lang_donate['VALUES_NF'] = 'Die Werte konnten nicht gelesen werden';
$lang_donate['VALUES_ND'] = 'Die Werte k&ouml;nnen nicht angezeigt werden';
$lang_donate['UNAMES_NF'] = 'Der Benutzername konnte nicht gefunden werden';
$lang_donate['UINFO_NF'] = 'Es konnten keine Benutzerinformationen gefunden werden';
$lang_donate['TYPES_NF'] = 'Der Spendentyp konnte nicht ermittelt werden';
$lang_donate['MISSING_FNAME'] = 'Bitte den Vornamen eingeben';
$lang_donate['MISSING_LNAME'] = 'Bitte den Familiennamen eingeben';
$lang_donate['INVALID_DONATION'] = 'Bitte einen g&uuml;tigen Wert f&uuml;r die Spende eingeben';
$lang_donate['INVALID_EMAIL'] = 'Bitte eine g&uuml;tige eMail-Adresse eingeben';
$lang_donate['CODES_SHORT'] = 'Du musst einen Spendencode sowie den PayPal Code in die Spendenkonfiguration eingeben:';
$lang_donate['CODES_SPACES'] = 'Es sind keine Leerzeichen f&uuml;r den Code erlaubt';

//Current
$lang_donate['DATE'] = 'Datum';
$lang_donate['USERNAME'] = 'Benutzername';
$lang_donate['AMOUNT'] = 'Betrag';
$lang_donate['TOTAL'] = 'Gesamt';
$lang_donate['GOAL'] = 'Ziel';
$lang_donate['DIFF'] = 'Differenz';
$lang_donate['NEXT'] = 'N&auml;chste';
$lang_donate['PREV'] = 'Vorige';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['N/A'] = 'keine Angaben';

//Help
$lang_donate['HELP_DONATION_ANON'] = 'Alles wird - selbst f&uuml;r die Administratoren - verborgen.<br /><br /><strong>HINWEIS:</strong> PayPal speichert nat&uuml;rlich die Informationen, so dass es nicht zu 100% Anonym ist';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Die Spenden werden der Allgemeinheit nicht angezeigt, jedoch <strong>f&uuml;r</strong> die Administratoren.';
$lang_donate['HELP_DONATION_NAME'] = 'Das ist der prim&auml;re Spendentyp';
$lang_donate['HELP_DONATION_CODE'] = 'Das ist der prim&auml;re Code f&uuml;r den Spendtyp f&uuml;r PayPal';
$lang_donate['HELP_DONATION_CODES'] = 'Hier kannst Du andere Spendentypen und Spendencodes einf&uuml;gen. Das ist <strong>optional</strong>.<br /><br />Zum Beispiel einen Code f&uuml;r Rechnungen (Artikelnummer).<hr />Die erste Zeile ist der Text '
                                      .'der in einer Auswahlbox angezeigt wird. Es sollten Informationen sein, die f&uuml;r Deine Benutzer verst&auml;ndlich sind. Leerzeichen sind erlaubt.<br />Als Beispiel: Webseiten Spende<br /><br />'
                                      .'Die n&auml;chste Zeile ist der PayPal Code den Du verwenden m&ouml;chtest.<br />Leerzeichen sind <strong>NICHT</strong> erlaubt!<br />Als Beispiel: webseiten_spende<hr />Das Endresultat des Beispieles w&auml;re:<br />'
                                      .'Webseiten Spende<br />webseiten_spende';
$lang_donate['HELP_COOKIE_TRACK'] = 'Damit werden die Spendenwerte in einem Cookie gespeichert. Es ist eine weitere M&ouml;glichkeit, den Spendenweg zu verfolgen. <br /><strong>Diese Option sollte nur gew&auml;hlt werden wenn ansonsten Probleme auftreten!</strong>';
?>