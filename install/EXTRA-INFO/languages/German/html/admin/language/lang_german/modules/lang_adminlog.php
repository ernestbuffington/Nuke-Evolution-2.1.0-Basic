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

$lang_admin[$adminpoint]['ADMIN_LOG'] = 'Logbuch Administration';
$lang_admin[$adminpoint]['ADMIN_LOG_ERRFND'] = 'Das Logbuch kann nicht gefunden werden';

$lang_admin[$adminpoint]['BACK'] = 'Zur&uuml;ck';

$lang_admin[$adminpoint]['CLEAR_LOG'] = 'Alle Eintr&auml;ge l&ouml;schen';

$lang_admin[$adminpoint]['HEAD_DATE'] = 'Datum';
$lang_admin[$adminpoint]['HEAD_IP'] = 'IP';
$lang_admin[$adminpoint]['HEAD_MSG'] = 'Eintrag';
$lang_admin[$adminpoint]['HEAD_TIME'] = 'Zeit';

$lang_admin[$adminpoint]['LOG_NOT_OPEN'] = 'Wir k&ouml;nnen das Logbuch nicht &ouml;ffnen - um den Inhalt anzuschauen lade die Datei deshalb bitte per FTP auf Deinen Rechner';
$lang_admin[$adminpoint]['LOG_NO_ENTRY'] = 'Keine Eintr&auml;ge vorhanden';
$lang_admin[$adminpoint]['LOG_TOBIG'] = 'Dein Logbuch ist gr&ouml;&szlig;er als 6 MB, was zu Hauptspeicherproblemen f&uuml;hren kann - um den Inhalt anzuschauen lade die Datei deshalb bitte per FTP auf Deinen Rechner';

?>