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

$lang_admin[$adminpoint]['VERSIONCTL_BACK'] = 'Zur&uuml;ck';

$lang_admin[$adminpoint]['VERSIONCTL_CHECKVER'] = 'Hier klicken, um die Versionskontrolle zu starten.';
$lang_admin[$adminpoint]['VERSIONCTL_CHG'] = 'Eine neue Version von Nuke-Evolution ist verf&uuml;gbar.';
$lang_admin[$adminpoint]['VERSIONCTL_CHGLOG'] = 'Nuke-Evolution &Auml;nderungsliste';
$lang_admin[$adminpoint]['VERSIONCTL_CUR'] = 'Du hast eine aktuelle Version';

$lang_admin[$adminpoint]['VERSIONCTL_Download'] = 'Download';

$lang_admin[$adminpoint]['VERSIONCTL_ERRCON'] = 'www.evo-german.com konnte nicht kontaktiert werden';
$lang_admin[$adminpoint]['VERSIONCTL_ERRSQL'] = 'Die Version konnte nicht aus der Datenbank gelesen werden.';
$lang_admin[$adminpoint]['VERSIONCTL_ERR_CHG'] = 'Es gibt Probleme beim Zugriff auf die Liste der &Auml;nderungen.';
$lang_admin[$adminpoint]['VERSIONCTL_ERR_CON'] = 'Auf <a href="http://www.evo-german.com">Nuke-Evolution Germany</a> kann derzeit nicht zugegriffen werden.';

$lang_admin[$adminpoint]['VERSIONCTL_TITLE'] = 'Nuke-Evolution Version';
$lang_admin[$adminpoint]['VERSIONCTL_TITLE'] = 'Nuke-Evolution Versionskontrolle';

$lang_admin[$adminpoint]['VERSIONCTL_VER'] = 'Die aktuelle Version ist:';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONCURRENTINFO'] = 'Du hast <strong>Nuke Evolution %s</strong>.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONFUNCTIONSDISABLED'] = 'Die Socket-Funktionen Deines Webservers k&ouml;nnen nicht genutzt werden.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONLATESTINFO'] = 'Die letzte verf&uuml;gbare Version ist <strong>Nuke Evolution %s</strong>.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONOUTOFDATE'] = 'Deine Installation scheint <strong>nicht aktuell</strong> zu sein. <br />Es sind Updates f&uuml;r Deine Nuke-Evolution Version verf&uuml;gbar. <br />Bitte schaue auf <a href="http://www.evo-german.com/modules.php?name=Downloads" target="_blank">http://www.evo-german.com/modules.php?name=Downloads</a> um die neueste Version zu erhalten.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONSOCKETERROR'] = 'Leider ist eine Verbindung zum Evo-German Server nicht m&ouml;glich. Der Fehler, der gemeldet wurde ist:<br />%s';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONUP2DATE'] = 'Deine Installation ist aktuell. Es sind keine Updates f&uuml;r Deine Nuke-Evolution Version verf&uuml;gbar.';
$lang_admin[$adminpoint]['VERSIONCTL_VIEW'] = 'Neue Version anzeigen';
$lang_admin[$adminpoint]['VERSIONCTL_YOURVER'] = 'Deine Version ist:';

?>