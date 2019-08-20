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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Dateihandling';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Einstellungen Dateihandling';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'FTP Einstellungen';
$lang_admin[$settingspoint]['FIELD_FTPHOST'] = 'URL f&uuml;r FTP Zugriff';
$lang_admin[$settingspoint]['FIELD_FTPHOST_HELP'] = 'IP-Adresse oder Dom&auml;nenname f&uuml;r den Zugriff per FTP.<br />Die gleichen Einstellungen wie im FTP Programm.';
$lang_admin[$settingspoint]['FIELD_FTPPORT'] = 'FTP Port';
$lang_admin[$settingspoint]['FIELD_FTPPORT_HELP'] = 'Der Port (normalerweise 21) f&uuml;r den FTP Service auf dem Server';
$lang_admin[$settingspoint]['FIELD_FTPPATH'] = 'Pfad zum Verzeichnis der Webseite';
$lang_admin[$settingspoint]['FIELD_FTPPATH_HELP'] = 'Der Dateipfad zum Verzeichnis der Webseite, beginnend mit dem Login auf dem FTP-Server.<br />';
$lang_admin[$settingspoint]['FIELD_FTPUSER'] = 'FTP Benutzer';
$lang_admin[$settingspoint]['FIELD_FTPUSER_HELP'] = 'Der Benutzername f&uuml;r den FTP Zugriff.<br />Bitte den gleichen Benutzer verwenden, der f&uuml;r das Upload der Evo Dateien verwendet wurde.';
$lang_admin[$settingspoint]['FIELD_FTPPWD'] = 'FTP Passwort';
$lang_admin[$settingspoint]['FIELD_FTPPWD_HELP'] = 'Das Passwort f&uuml;r den FTP Zugriff.<br />Bitte das gleiche Passwort eingeben, wie f&uuml;r das Upload der Evo Dateien verwendet wurde.';
$lang_admin[$settingspoint]['FIELD_DIRECTORY_MODE'] = 'Verzeichnis Zugriffsrechte';
$lang_admin[$settingspoint]['FIELD_DIRECTORY_MODE_HELP'] = 'Die Standard Zugriffsrechte f&uuml;r Verzeichnisse.<br />Die Eingabe &uuml;berschreibt die gesetzten Zugriffsrechte in der config.php.<br />Standardzugriffsrecht ist 755, d.h. lesen + schreiben + ausf&uuml;hren f&uuml;r den Verzeichnisinhaber; lesen und ausf&uuml;hren f&uuml;r Gruppenmitglieder und G&auml;ste.';
$lang_admin[$settingspoint]['FIELD_FILE_MODE'] = 'Datei Zugriffsrechte';
$lang_admin[$settingspoint]['FIELD_FILE_MODE_HELP'] = 'Die Standard Zugriffsrechte f&uuml;r Dateien.<br />Die Eingabe &uuml;berschreibt die gesetzten Zugriffsrechte in der config.php.<br />Standardzugriffsrecht ist 755, d.h. lesen + schreiben f&uuml;r den Verzeichnisinhaber; nur lesen f&uuml;r Gruppenmitglieder und G&auml;ste.';

$lang_admin[$settingspoint]['CHECK_ERROR_NOConnection'] = 'Die angegebenen Einstellungen sind falsch. Wir konnten keine g&uuml;ltige Verbindung zum angegebenen Server aufbauen.';

$lang_admin[$settingspoint]['FIELD_BREAK_FILESETTINGS'] = 'Zugriffsrechte';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

?>