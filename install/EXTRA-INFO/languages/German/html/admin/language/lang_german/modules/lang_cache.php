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

$lang_admin[$adminpoint]['CACHENOTALLOWED'] = 'Du hast keine Berechtigung diese Datei zu sehen!';
$lang_admin[$adminpoint]['CACHESAFEMODE'] = 'Der Safe Mode ist auf Deinem Server aktiviert, Cache wird NICHT funktionieren!';

$lang_admin[$adminpoint]['CACHE_BAD'] = 'Dein Cache hat nicht die erforderliche Berechtigung (chmod)!';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_FAIL'] = 'Kategorie l&ouml;schen fehlgeschlagen';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_SUCC'] = 'Kategorie erfolgreich gel&ouml;scht';
$lang_admin[$adminpoint]['CACHE_CLEAR'] = 'Cache leeren';
$lang_admin[$adminpoint]['CACHE_CLEARED_FAIL'] = 'Cache konnte nicht geleert werden';
$lang_admin[$adminpoint]['CACHE_CLEARED_SUCC'] = 'Cache erfolgreich geleert';
$lang_admin[$adminpoint]['CACHE_CLEARNOW'] = 'Jetzt leeren';
$lang_admin[$adminpoint]['CACHE_DELETE'] = 'L&ouml;schen';
$lang_admin[$adminpoint]['CACHE_DIR_STATUS'] = 'Cache Verzeichnis Status:';
$lang_admin[$adminpoint]['CACHE_DISABLED'] = 'Deaktiviert';
$lang_admin[$adminpoint]['CACHE_ENABLED'] = 'Aktiviert';
$lang_admin[$adminpoint]['CACHE_ENABLE_HOW'] = 'Um den Cache zu aktivieren, setze \$use_cache auf \"true\" in config.php wenn es nicht bereits gesetzt ist.';
$lang_admin[$adminpoint]['CACHE_FILEMODE'] = 'Datei Cache';
$lang_admin[$adminpoint]['CACHE_FILENAME'] = 'Dateiname';
$lang_admin[$adminpoint]['CACHE_FILESIZE'] = 'Dateigr&ouml;sse';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_FAIL'] = 'L&ouml;schen der Datei fehlgeschlagen';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_SUCC'] = 'Datei erfolgreich gel&ouml;scht';
$lang_admin[$adminpoint]['CACHE_GOOD'] = 'Gut';
$lang_admin[$adminpoint]['CACHE_HEADER'] = 'Nuke-Evolution Cache :: Administrationsmen&uuml;';
$lang_admin[$adminpoint]['CACHE_HOWTOENABLE'] = 'Wie aktivieren?';
$lang_admin[$adminpoint]['CACHE_INVALID'] = 'Ung&uuml;ltige Operation';
$lang_admin[$adminpoint]['CACHE_LASTMOD'] = 'Letzte &Auml;nderung';
$lang_admin[$adminpoint]['CACHE_LAST_CLEARED'] = 'Cache zuletzt geleert:';
$lang_admin[$adminpoint]['CACHE_MODE'] = 'Cache Mode';
$lang_admin[$adminpoint]['CACHE_NO'] = 'Nein';
$lang_admin[$adminpoint]['CACHE_NUM_FILES'] = 'Anzahl an zwischengespeicherten Dateien:';
$lang_admin[$adminpoint]['CACHE_OPTIONS'] = 'Optionen';
$lang_admin[$adminpoint]['CACHE_PREF_UPDATED_SUCC'] = 'Pr&auml;ferenzen erfolgreich aktualisiert';
$lang_admin[$adminpoint]['CACHE_RETURN'] = 'Zur&uuml;ck zur Hauptadministration';
$lang_admin[$adminpoint]['CACHE_RETURNCACHE'] = 'Zur&uuml;ck zur Cache Administration';
$lang_admin[$adminpoint]['CACHE_SIZE'] = 'Cache Gr&ouml;sse:';
$lang_admin[$adminpoint]['CACHE_SQLMODE'] = 'SQL Cache';
$lang_admin[$adminpoint]['CACHE_STATUS'] = 'Cache Status:';
$lang_admin[$adminpoint]['CACHE_USER_CAN_CLEAR'] = 'Benutzer darf Cache leeren:';
$lang_admin[$adminpoint]['CACHE_VIEW'] = 'Anzeigen';
$lang_admin[$adminpoint]['CACHE_YES'] = 'Ja';

?>