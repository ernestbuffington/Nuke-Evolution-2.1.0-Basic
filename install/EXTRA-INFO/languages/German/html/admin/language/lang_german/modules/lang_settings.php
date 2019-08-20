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

$lang_admin[$adminpoint]['BUTTON_BACK'] = 'Zur&uuml;ck';
$lang_admin[$adminpoint]['BUTTON_BACK_SETTINGS'] = 'Zur&uuml;ck zum Men&uuml; Einstellungen';

$lang_admin[$adminpoint]['ERROR'] = 'Fehler';
$lang_admin[$adminpoint]['ERROR_FUNCTION_NOT_EXISTS'] = 'Es wurde eine Funktion zum &uuml;berpr&uuml;fen der Eingabe angegeben, die nicht existiert';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR'] = 'Deine .htaccess Datei enth&auml;lt keine Rewrite Anweisungen<br />Weitere Hilfe in unserem Wiki';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR_OPEN'] = 'Die Datei .htaccess konnte nicht ge&ouml;ffnet werden';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_NF'] = 'Deine Datei .htaccess ist nicht aktiviert<br />Weitere Hilfe in unserem Wiki';
$lang_admin[$adminpoint]['ERROR_MODULE_FIELD_WRONG'] = 'Es ist ein Programmierfehler im Modul';
$lang_admin[$adminpoint]['ERROR_NO_DBFIELD'] = 'Es ist kein Tabellenfeld angegeben f&uuml;r das Feld';
$lang_admin[$adminpoint]['ERROR_NO_TABLE'] = 'Es ist keine Tabelle angegeben f&uuml;r das Feld';
$lang_admin[$adminpoint]['ERROR_UPDATE_DBFIELD'] = 'Fehler beim Update der Datenbank f&uuml;r das Feld';

$lang_admin[$adminpoint]['INFO_DBUPDATE_SUCCESSFULL'] = 'Das Update der Datenbank war erfolgreich';
$lang_admin[$adminpoint]['INFO_MESSAGE'] = 'Hinweis';

$lang_admin[$adminpoint]['SETTINGS_ADMIN_HEADER'] = 'Einstellungen';

?>