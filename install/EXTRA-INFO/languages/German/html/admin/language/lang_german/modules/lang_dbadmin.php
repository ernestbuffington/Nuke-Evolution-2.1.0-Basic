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
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

global $adminpoint;

$lang_admin[$adminpoint]['ADMIN_GO_MAIN']            = 'Zur&uuml;ck zur Hauptadministration';
$lang_admin[$adminpoint]['ADMIN_HEADER']             = 'Datenbank Administration';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTEXT']   = 'R&uuml;ckmeldung der Datenbank';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTYPE']   = 'Nachrichtentyp';
$lang_admin[$adminpoint]['ANALYZE_HEADER_NAME']      = 'Name der Tabelle';
$lang_admin[$adminpoint]['ANALYZE_HEADER_OP']        = 'Datenbankoperation';

$lang_admin[$adminpoint]['BACKUP_HEADER_BACKUP']     = 'Sichern ?';
$lang_admin[$adminpoint]['BACKUP_HEADER_NAME']       = 'Name der Tabelle';
$lang_admin[$adminpoint]['BACKUP_INFO_MSG']          = 'Nachfolgend sind nur Tabellen aufgef&uuml;hrt, die Datens&auml;tze beinhalten.';
$lang_admin[$adminpoint]['BACKUP_SUBMIT']            = 'Sichern der Tabellen best&auml;tigen';
$lang_admin[$adminpoint]['BACKUP_TABLES_BACKUPD_MSG']= 'Folgende Tabellen wurden gesichert';
$lang_admin[$adminpoint]['BACKUP_TABLES_CONFIRM_MSG']= 'Wollen Sie diese Tabellen wirklich sichern ?';

$lang_admin[$adminpoint]['CHECK_ALL']                = 'Alle ausw&auml;hlen';

$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] = 'Wir haben keine Information aus der Datenbank erhalten - dies k&ouml;nnte ein Rechteproblem Deines Datenbankbenutzers sein.';
$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT']  = 'Die Zugriffsrechte auf die Datenbank lassen keine Statistikinformationen zu';
$lang_admin[$adminpoint]['DATABASE_QUERY_RESULT']    = 'Ergebnis der Datenbankabfrage';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_ERROR']   = 'Fehler';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_INFO']    = 'Information';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_OP_ANALYZE'] = 'Analyse';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_STATUS']  = 'Status';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_WARNING'] = 'Warnung';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPACT']    = 'Kompakt';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPRESSED'] = 'Komprimiert';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_DYNAMIC']    = 'Dynamisch';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_FIXED']      = 'Fix';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_REDUNDANT']  = 'Redundant';
$lang_admin[$adminpoint]['DELETE_HEADER_DELETE']     = 'L&ouml;schen ?';
$lang_admin[$adminpoint]['DELETE_HEADER_NAME']       = 'Name der Tabelle';
$lang_admin[$adminpoint]['DELETE_SUBMIT']            = 'L&ouml;schen der Tabellen best&auml;tigen';
$lang_admin[$adminpoint]['DELETE_TABLES_CONFIRM_MSG']= 'Wollen Sie diese Tabellen wirklich l&ouml;schen ?';
$lang_admin[$adminpoint]['DELETE_TABLES_DELETED_MSG']= 'Folgende Tabellen wurden gel&ouml;scht';

$lang_admin[$adminpoint]['FILES_QUERY_NO_RESULT']    = 'Es wurden keine Sicherungsdateien gefunden';

$lang_admin[$adminpoint]['KB']                       = 'KB';

$lang_admin[$adminpoint]['MAIN_HEADER']              = 'Datenbank Administration';
$lang_admin[$adminpoint]['MB']                       = 'MB';

$lang_admin[$adminpoint]['NONE']                     = 'Keine';

$lang_admin[$adminpoint]['OPTIMIZE_HEADER_NAME']       = 'Name der Tabelle';
$lang_admin[$adminpoint]['OPTIMIZE_HEADER_OPTIMIZE']   = 'Optimieren ?';
$lang_admin[$adminpoint]['OPTIMIZE_SUBMIT']            = 'Optimierung der Tabellen best&auml;tigen';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_CONFIRM_MSG']= 'Wollen Sie diese Tabellen wirklich optimieren ?';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_OPTIMIZED_MSG']= 'Folgende Tabellen wurden optimiert';

$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_DELETE']     = 'Datei l&ouml;schen';
$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_VIEW']       = 'Datei Informationen';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_BACKUP']     = 'Aktion ?';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_CREATED']    = 'Sicherung erstellt am';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_NAME']       = 'Name der Datei';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_FILE']         = 'Sicherungsdatei';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_MSG']          = 'Alle angezeigte Sicherungsdatein befinden sich im Verzeichnis includes/cache';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_ROWS']         = 'Anzahl Datens&auml;tze im Backupfile';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_TABLES']       = 'Anzahl Tabellen im Backupfile';
$lang_admin[$adminpoint]['SHOW_BACKUP_SUBMIT']            = 'Starte Aktion';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_SIZE']      = 'Gr&ouml;&szlig;e der Datenbank';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_TABLES']    = 'Anzahl Tabellen in der Datenbank';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COLLATION']   = 'Sortierung';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COMMENT']     = 'Kommentar';
$lang_admin[$adminpoint]['STATISTICS_HEADER_FORMAT']      = 'Format';
$lang_admin[$adminpoint]['STATISTICS_HEADER_INCREMENT']   = 'N&auml;chster Inkrement';
$lang_admin[$adminpoint]['STATISTICS_HEADER_MAXSIZE']     = 'Erlaubte Tabellengr&ouml;&szlig;e';
$lang_admin[$adminpoint]['STATISTICS_HEADER_NAME']        = 'Name der Tabelle';
$lang_admin[$adminpoint]['STATISTICS_HEADER_ROWS']        = 'Anzahl Datens&auml;tze';
$lang_admin[$adminpoint]['STATISTICS_HEADER_SIZE']        = 'Tabellengr&ouml;&szlig;e';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TIMESTAMPS']  = 'angelegt am<br/>letzte &Auml;nderung am<br/>letzer Check am';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TYPE']        = 'Typ';
$lang_admin[$adminpoint]['SWITCH_ALL']                    = 'Auswahl umkehren';

$lang_admin[$adminpoint]['TITLE_ANALYZE_DB']         = 'Datenbank analysieren';
$lang_admin[$adminpoint]['TITLE_OPTIMIZE_DB']        = 'Datenbank optimieren';
$lang_admin[$adminpoint]['TITLE_SHOW_STATISTICS']    = 'Statistik anzeigen';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP']      = 'Tabellen sichern';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUPED']    = 'Tabellen gesichert';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP_SHOW'] = 'Sicherungen anzeigen';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETE']      = 'Tabellen l&ouml;schen';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETED']     = 'Tabellen gel&ouml;scht';
$lang_admin[$adminpoint]['TITLE_TABLES_OPTIMIZED']   = 'Datenbank optimiert';
$lang_admin[$adminpoint]['TITLE_TABLES_REPAIR']      = 'Tabellen reparieren';

$lang_admin[$adminpoint]['UNCHECK_ALL']              = 'Alle abw&auml;hlen';

?>