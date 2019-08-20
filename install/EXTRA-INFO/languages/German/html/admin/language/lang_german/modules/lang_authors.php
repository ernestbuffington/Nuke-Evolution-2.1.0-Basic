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

if (!defined('ADMIN_FILE')) {
    die('You can\'t access this file directly...');
}

global $adminpoint;

$lang_admin[$adminpoint]['BUTTON_ADMIN_ADD'] = 'Administrator anlegen';
$lang_admin[$adminpoint]['BUTTON_ADMIN_CHANGE'] = 'Administrator &auml;ndern';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DELETE'] = 'Administrator l&ouml;schen';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DOIT'] = 'OK';
$lang_admin[$adminpoint]['BUTTON_USER_PROMOTE'] = 'Benutzer bef&ouml;rdern';

$lang_admin[$adminpoint]['FIELDSET_PERMISSIONS'] = 'Rechtevergabe';
$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'] = 'Email-Adresse';
$lang_admin[$adminpoint]['FIELD_ADMIN_LANGUAGE'] = 'Spracheinstellung';
$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'] = 'Name';
$lang_admin[$adminpoint]['FIELD_ADMIN_NO'] = 'Nein';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'] = 'Passwort';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'] = 'Passwort best&auml;tigen';
$lang_admin[$adminpoint]['FIELD_ADMIN_URL'] = 'Webseite';
$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'] = 'Benutzername';
$lang_admin[$adminpoint]['FIELD_ADMIN_YES'] = 'Ja';
$lang_admin[$adminpoint]['FIELD_NOTCHANGEABLE'] = 'Feld nicht &auml;nderbar';

$lang_admin[$adminpoint]['GOD_ADMIN'] = 'God Admin';

$lang_admin[$adminpoint]['HEAD_BACK'] = 'Zur&uuml;ck zum Administratoren Men&uuml;';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINADD'] = 'Neuen Administrator anlegen';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINCHANGE'] = 'Administrator &auml;ndern';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINDELETE'] = 'Administrator l&ouml;schen';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINSHOW'] = 'Administrator anzeigen';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_MAIN'] = 'Liste der Administratoren';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_PROMOTEUSER'] = 'Benutzer bef&ouml;rdern';
$lang_admin[$adminpoint]['HEAD_TITLE'] = 'Admins Administration';
$lang_admin[$adminpoint]['HELP_FIELDSET_PERMISSIONS'] = 'Hier k&ouml;nnen die Rechte f&uuml;r den Administrator vergeben werden. Klicke jedes Modul an, das dieser Administrator verwalten soll.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_EMAIL'] = 'Die Email Adresse des Administrators. An diese Email Adresse werden alle Nachrichten f&uuml;r den Administrator gesendet.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_LANGUAGE'] = 'Wie beim Benutzerprofil wird hier die Seitensprache des Administrators voreingestellt.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_NAME'] = 'Die Eingabe ist zwingend erforderlich!&lt;br /&gt;Dieser Name wird bei allen Aktionen des Administrators angezeigt bzw. gespeichert.&lt;br /&gt;Der hier eingegebene Name des Administrators darf nicht mit einem bereits verwendeten Benutzernamen &uuml;bereinstimmen.&lt;br /&gt;Abgepr&uuml;ft wird, ob ein Administrator oder ein Benutzer dieses Namens bereits angelegt ist.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD'] = 'Das Passwort darf zwischen 4 und 12 Zeichen lang sein - keine Leer oder Sonderzeichen enthalten.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD2'] = 'Zur &Uuml;berpr&uuml;fung, ob kein Schreibfehler in der ersten Passworteingabe erfolgte.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_SUPERUSER'] = 'Achtung!! Der Superuser hat fast die gleichen Rechte wie ein God-Admin !!&ltbr /&gt;Vergib dieses Recht sehr sehr sorgf&auml;ltig.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_URL'] = 'Die Webseite des Administrators. Hiermit wird verhindert, dass der Administrator seine eigene Webseite bewertet oder kommentiert (Downloads, Links, Reviews etc.)';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME'] = 'Die Eingabe ist zwingend erforderlich!&lt;br /&gt;Der hier eingegebene Name des Administrators darf nicht mit einem bereits verwendeten Benutzernamen &uuml;bereinstimmen.&lt;br /&gt;Abgepr&uuml;ft wird, ob ein Administrator oder ein Benutzer dieses Namens bereits angelegt ist.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME_PROMOTE'] = 'Dieses Feld ist bei der Bef&ouml;rderung eines Benutzers nicht &auml;nderbar, da dieses Feld mit dem Benutzernamen &uuml;bereinstimmen mu&szlig;';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_PASSWORDCHANGE'] = 'Damit eine eine Passwort&auml;nderung erfolgen kann, muss dieses Feld angeklickt sein. Erst dann werden die Eingabefelder f&uuml;r das Passwort freigeschaltet';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_SUPERUSER'] = 'Wenn das Recht Superuser aktiviert ist, m&uuml;ssen keine Modulrechte mehr vergeben werden, da ein Superuser Administrationsrechte f&uuml;r alle Module hat';

$lang_admin[$adminpoint]['INFO_ADMIN_GOD_NODELETE'] = 'Der Administrator '.$lang_admin[$adminpoint]['GOD_ADMIN'].' kann nicht gel&ouml;scht werden';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_AFTERLINK'] = 'um Hilfe f&uuml;r das erstellen sicherer Passw&ouml;rter zu erhalten';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_BEFORELINK'] = 'Klicke';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_CURRENTSTRENGTH'] = 'Aktueller Sicherheitsgrad ';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_LINK'] = 'hier';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_MEDIUM'] = 'Mittel';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_NOTRATED'] = 'Nicht gepr&uuml;ft';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONG'] = 'Sicher';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGER'] = 'Sehr Sicher';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGEST'] = 'Absolut Sicher';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_WEAK'] = 'Schwach';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_ADDED'] = 'Der Administrator wurde erfolgreich angelegt';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED'] = 'Der Administrator wurde erfolgreich ge&auml;ndert';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED_LOGOUT'] = 'Damit die ge&auml;nderten Einstellungen wirksam werden, musst Du Dich ausloggen';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_DELETED'] = 'Der Administrator wurde erfolgreich gel&ouml;scht';
$lang_admin[$adminpoint]['INFO_ADMIN_SUPERUSER_WARN'] = 'Bitte den Hilfetext beachten !!';
$lang_admin[$adminpoint]['INFO_FIELD_NOTCHANGEABLE'] = 'Feld nicht &auml;nderbar';

$lang_admin[$adminpoint]['MENUE_ADMIN_ADD'] = 'Administrator anlegen';
$lang_admin[$adminpoint]['MENUE_ADMIN_PROMOTE'] = 'Benutzer bef&ouml;rdern';
$lang_admin[$adminpoint]['MENUE_ADMIN_SHOW'] = 'Administratoren anzeigen';

$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_CHANGE'] = '&Auml;ndern';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_DELETE'] = 'L&ouml;schen';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SELECT'] = 'Aktion w&auml;hlen';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SHOW'] = 'Anzeigen';
$lang_admin[$adminpoint]['OPTION_ADMIN_PASSWORDCHANGE'] = 'Soll das Passwort ge&auml;ndert werden';
$lang_admin[$adminpoint]['OPTION_ADMIN_SUPERUSER'] = 'Superuser';
$lang_admin[$adminpoint]['OPTION_ALL_LANGS'] = 'Alle Sprachen';

$lang_admin[$adminpoint]['QUEST_ADMIN_CHANGE'] = 'Administrator &auml;ndern';
$lang_admin[$adminpoint]['QUEST_ADMIN_DELETE'] = 'Administrator l&ouml;schen';

$lang_admin[$adminpoint]['TABLE_ADMIN_ACTION'] = 'Aktion';
$lang_admin[$adminpoint]['TABLE_ADMIN_EMAIL'] = 'Email-Adresse';
$lang_admin[$adminpoint]['TABLE_ADMIN_LANGUAGE'] = 'Sprache';
$lang_admin[$adminpoint]['TABLE_ADMIN_NAME'] = 'Name';
$lang_admin[$adminpoint]['TABLE_ADMIN_REGDATE'] = 'Registrierungsdatum';
$lang_admin[$adminpoint]['TABLE_ADMIN_SUPERUSER'] = 'Superuser';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERID'] = 'ID';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERNAME'] = 'Benutzername';

$lang_admin[$adminpoint]['WARNING_ADMIN_DELETE'] = 'Soll dieser Administrator wirklich gel&ouml;scht werden';

$lang_admin[$adminpoint]['ERROR_ADMIN_WRONGAID'] = 'Es ist ein &Uuml;bermittlungsfehler aufgetreten. Bitte versuche es noch einmal.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_EMPTY'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" darf nicht leer sein';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_INVALID'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" entspricht nicht den Vorgaben f&uuml;r eine Emailadresse in unserem System (Sonderzeichen, Leerzeichen etc.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_LANGUAGE'] = 'Ein Fehler bei der &Uuml;bermittlung der Sprache des Administrators ist aufgetreten. Wir konnten die gew&auml;hlte Sprache nicht in unserer Datenbank finden.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_AND_SUPER_EMPTY'] = 'Der Administrator hat keine Rechte - weder als Superadmin nocht als Moduladmin';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_NOTEXIST'] = 'Eines oder mehrere der angegebenen Module, f&uuml;r die Berechtigungen vergeben werden sollen, existieren in unserer Datenbank nicht.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_BADWORD'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" enth&auml;lt Wortelemente, die bei uns nicht erlaubt sind. Hier der korrigierte Inhalt';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EMPTY'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" darf nicht leer sein';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EXISTS'] = 'Es gibt bereits einen Benutzer oder Administrator mit diesem Namen.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_GOD_CHANGE'] = 'Der Name darf beim God-Admin nicht verändert werden';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_INVALID'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" entspricht nicht den Vorgaben f&uuml;r einen Benutzernamen in unserem System (Sonderzeichen, Leerzeichen etc.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_SIZE'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" ist %s Zeichen lang und damit entweder k&uuml;rzer als 3 Zeichen oder l&auml;nger als 30 Zeichen. Beachte bitte, dass manche Zeichen mehr als 1 Byte Speicherbedarf haben.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD2_EMPTY'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'].'" darf nicht leer sein';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_EMPTY'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'].'" darf nicht leer sein';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_NOT_MATCH'] = 'Die eingegebenen Passw&ouml;rter stimmen nicht &uuml;berein';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_EMPTY'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" darf nicht leer sein';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_INVALID'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" entspricht nicht den Vorgaben f&uuml;r eine Webseitenadresse in unserem System (Sonderzeichen, Leerzeichen etc.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_BADWORD'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" enth&auml;lt Wortelemente, die bei uns nicht erlaubt sind. Hier der korrigierte Inhalt';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EMPTY'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" darf nicht leer sein';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EXISTS'] = 'Es gibt bereits einen Benutzer oder Administrator mit diesem Namen.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_INVALID'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" entspricht nicht den Vorgaben f&uuml;r einen Benutzernamen in unserem System (Sonderzeichen, Leerzeichen etc.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_NOT_EXIST'] = 'Es ist ein Fehler bei der &uuml;berpr&uuml;fung des Benutzernamens aufgetreten. Dieser existiert nicht in der Datenbank.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_SIZE'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" ist %s Zeichen lang und damit entweder k&uuml;rzer als 3 Zeichen oder l&auml;nger als 30 Zeichen. Beachte bitte, dass manche Zeichen mehr als 1 Byte Speicherbedarf haben.';
$lang_admin[$adminpoint]['ERROR_DB_INSERT_ADMIN'] = 'Ein Fehler ist beim einf&uuml;gen des Administrators in die Datenbank aufgetreten.';
$lang_admin[$adminpoint]['ERROR_USER_ISADMIN'] = 'Der ausgew&auml;hlte Benutzer ist bereits Administrator';

?>