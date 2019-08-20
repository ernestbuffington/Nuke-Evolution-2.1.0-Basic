<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

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

if (!defined('ADMIN_FILE') && !defined('IN_SETTINGS')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Benutzerkonfiguration';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Generelle Benutzereinstellungen';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Benutzer Optionen';

$lang_admin[$settingspoint]['FIELD_HEADER_REGOPTIONS'] = 'Registrierungs-Optionen';
$lang_admin[$settingspoint]['FIELD_HEADER_EMAILOPTIONS'] = 'Email-Optionen';
$lang_admin[$settingspoint]['FIELD_HEADER_SUSPENDOPTIONS'] = 'Verfalls-Optionen';
$lang_admin[$settingspoint]['FIELD_HEADER_LIMITOPTIONS'] = 'Limitierungen';

$lang_admin[$settingspoint]['FIELD_ALLOWUSERREG'] = 'Benutzerregistrierung erlauben';
$lang_admin[$settingspoint]['FIELD_REQUIREADMIN'] = 'Muss ein Administrator eine Neuregistrierung freigeben';
$lang_admin[$settingspoint]['FIELD_ALLOWUSERDELETE'] = 'D&uuml;rfen sich Benutzer selbst deaktivieren';
$lang_admin[$settingspoint]['FIELD_DOUBLECHECKEMAIL'] = 'Doppelte Email Eingabe bei der Registrierung';
$lang_admin[$settingspoint]['FIELD_ALLOWUSERTHEME'] = 'Benutzern die &Auml;nderung des Standard Styles erlauben';
$lang_admin[$settingspoint]['FIELD_SERVERMAIL'] = 'Kann der Server Emails versenden';
$lang_admin[$settingspoint]['FIELD_SENDMAILADD'] = 'Administrator bei Neuregistrierung benachrichtigen<br />(Nur wenn der Server Mail versenden kann)';
$lang_admin[$settingspoint]['FIELD_SENDMAILDELETE'] = 'Administrator bei Deaktivierung benachrichtigen<br />(Nur wenn der Server Mail versenden kann)';
$lang_admin[$settingspoint]['FIELD_USEACTIVATE'] = 'Email-Aktivierung verwenden<br />(Nur wenn der Server Mail versenden kann)';
$lang_admin[$settingspoint]['FIELD_ALLOWMAILCHANGE'] = 'Mitgliedern Email-&Auml;nderung erlauben';
$lang_admin[$settingspoint]['FIELD_EMAILVALIDATE'] = 'Email&auml;nderungen &uuml;berpr&uuml;fen';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPEND'] = 'Benutzer sperren nach';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPEND_TEMP'] = 'Tempor&auml;re Konten verfallen nach';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPENDMAIN'] = 'Automatische Benutzersperre<br />(Kann die Seiten-Ladezeit erh&ouml;hen.)';
$lang_admin[$settingspoint]['FIELD_USERS_PER_PAGE'] = 'Anzahl Benutzer pro Seite';
$lang_admin[$settingspoint]['FIELD_NICK_MIN'] = 'Benutzername min. L&auml;nge';
$lang_admin[$settingspoint]['FIELD_NICK_MAX'] = 'Benutzername max. L&auml;nge';
$lang_admin[$settingspoint]['FIELD_PASS_MIN'] = 'Passwort min. L&auml;nge';
$lang_admin[$settingspoint]['FIELD_PASS_MAX'] = 'Passwort max. L&auml;nge';
$lang_admin[$settingspoint]['FIELD_SHOWONLINE'] = 'Maximal angezeigte Onlinezeit';

$lang_admin[$settingspoint]['OPTION_SUSPEND_DEACTIVATED'] = 'Nie';
$lang_admin[$settingspoint]['OPTION_SUSPEND_WEEK'] = 'Woche';
$lang_admin[$settingspoint]['OPTION_SUSPEND_WEEKS'] = 'Wochen';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DEACTIVATED'] = 'Nie';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAY'] = 'Tag';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAYS'] = 'Tage';
$lang_admin[$settingspoint]['OPTION_USERS_PER_PAGE'] = 'Benutzer';
$lang_admin[$settingspoint]['OPTION_NICK_MIN'] = 'Zeichen';
$lang_admin[$settingspoint]['OPTION_NICK_MAX'] = 'Zeichen';
$lang_admin[$settingspoint]['OPTION_PASS_MIN'] = 'Zeichen';
$lang_admin[$settingspoint]['OPTION_PASS_MAX'] = 'Zeichen';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_CHOICE'] = 'Bitte w&auml;hlen';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_SECONDS'] = 'Sekunden';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTE'] = 'Minute';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTES'] = 'Minuten';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_HOUR'] = 'Stunde';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERREG'] = 'Wenn dieses Feld auf &rdquo;Nein&rdquo; gestellt wird, k&ouml;nnen sich neue Benutzer nicht registrieren<br />Die einzige M&ouml;glichkeit, neue Benutzer anzulegen, ist dann &uuml;ber die Administrative Oberfl&auml;che';
$lang_admin[$settingspoint]['HELP_FIELD_REQUIREADMIN'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, muss ein Administrator ein neu angemeldetes Benutzerkonto explizit freischalten.';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERDELETE'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, d&uuml;rfen Benutzer Ihr Konto selbst deaktivieren.<br />Ansonsten kann ein Benutzerkonto nur &uuml;ber die administrative Oberfl&auml;che deaktiviert werden';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERTHEME'] = 'Wenn dieses Feld auf &rdquo;Nein&rdquo; gestellt wird, k&ouml;nnen Benutzer den Standardstyle nicht &auml;ndern.<br />Tempor&auml;re Stylevorausschau ist trotzdem m&ouml;glich.';
$lang_admin[$settingspoint]['HELP_FIELD_DOUBLECHECKEMAIL'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, wird bei einer Neuregistrierung das Email-Konto zur &Uuml;berpr&uuml;fung doppelt verlangt.';
$lang_admin[$settingspoint]['HELP_FIELD_SERVERMAIL'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, wird versucht, eine Email &uuml;ber das angelegte SMTP-Konto in der phpBB-Administration zu versenden. Bei &rdquo;Nein&rdquo; wird versucht, eine Email &uuml;ber das Standard-Email Programm von php = sendmail() zu versenden';
$lang_admin[$settingspoint]['HELP_FIELD_SENDMAILADD'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, wird bei jeder Neuregistrierung auch eine Email an die administrative Email Adresse versendet.';
$lang_admin[$settingspoint]['HELP_FIELD_SENDMAILDELETE'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, wird bei jeder Deaktivierung eines Benutzerkontos eine Email an die administrative Email Adresse versendet.';
$lang_admin[$settingspoint]['HELP_FIELD_USEACTIVATE'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, wird an die bei der Neuregistrierung angegebene Email Adresse eine Email mit einem Aktivierungslink versendet.<br />Erst nachdem der Benutzer diesen Link quittiert hat, wird das Benutzerkonto aktiviert.';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWMAILCHANGE'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, d&uuml;rfen Benutzer Ihre Email Adresse selbst &auml;ndern.<br />Ansonsten ist eine &Auml;nderung der Email Adresse nur durch einen Adminsitrator m&ouml;glich.';
$lang_admin[$settingspoint]['HELP_FIELD_EMAILVALIDATE'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, wird nach &Auml;nderung einer Benutzer Email Adresse, die Aufforderung zur Best&auml;tigung an die neue Email Adresse gesendet. Erst nach quittieren dieser Aufforderung wird die neue Email Adresse aktiviert.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPENDMAIN'] = 'Wenn dieses Feld auf &rdquo;Ja&rdquo; steht, wird &uuml;berpr&uuml;ft, wann sich der Benutzer das letzte Mal eingeloggt hat.<br />Entsprechend der Einstellung im n&auml;chsten Feld, wird der Benutzer nach der dort eingestellten Zeit deaktiviert und muss erst durch einen Administrator reaktiviert werden, bevor sich der Benutzer anmelden kann.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND'] = 'Ist das Feld &rdquo;Automatische Benutzersperre&rdquo; aktiviert, wird die hier eingestellte Zeitspanne zur &uuml;berpr&uuml;fung herangezogen.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND_TEMP'] = 'Zeitdauer, nach dem eine Neuregistrierung automatisch gel&ouml;scht wird, wenn der Benutzer oder ein Administrator das Konto nicht aktiviert hat.';
$lang_admin[$settingspoint]['HELP_FIELD_USERS_PER_PAGE'] = 'Anzahl der Benutzer, die sich maximal auf der Webseite anmelden d&uuml;rfen. Ist die maximale Anzahl erreicht, wird jeder weitere Anmeldevorgang abgewiesen.';
$lang_admin[$settingspoint]['HELP_FIELD_NICK_MIN'] = 'Minimale L&auml;nge des Benutzernamens.<br />Ein Wert unter &rdquo;4&rdquo; ist nicht sinnvoll.';
$lang_admin[$settingspoint]['HELP_FIELD_NICK_MAX'] = 'Maximale L&auml;nge des Benutzernamens';
$lang_admin[$settingspoint]['HELP_FIELD_PASS_MIN'] = 'Minimale L&auml;nge des Benutzer Passworts.<br />Ein Wert unter &rdquo;6&rdquo; ist nicht sinnvoll.';
$lang_admin[$settingspoint]['HELP_FIELD_PASS_MAX'] = 'Maximale L&auml;nge des Benutzer Passworts';
$lang_admin[$settingspoint]['FIELD_SHOWONLINE_HELP'] = 'Zeit, die maximal verstreichen darf um einen Benutzer seit seiner letzten Aktivit&auml;t noch als Online anzuzeigen';
?>