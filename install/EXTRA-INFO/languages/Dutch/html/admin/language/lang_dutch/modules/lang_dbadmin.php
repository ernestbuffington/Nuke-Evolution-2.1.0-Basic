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

$lang_admin[$adminpoint]['ADMIN_GO_MAIN']            = 'Terug naar het hoofdmenu';
$lang_admin[$adminpoint]['ADMIN_HEADER']             = 'Database administratie';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTEXT']   = 'Antwoord van de database';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTYPE']   = 'Type bericht';
$lang_admin[$adminpoint]['ANALYZE_HEADER_NAME']      = 'Tabelnaam';
$lang_admin[$adminpoint]['ANALYZE_HEADER_OP']        = 'Aktie databank';

$lang_admin[$adminpoint]['BACKUP_HEADER_BACKUP']     = 'Opslaan ?';
$lang_admin[$adminpoint]['BACKUP_HEADER_NAME']       = 'Tabelnaam';
$lang_admin[$adminpoint]['BACKUP_INFO_MSG']          = 'Er zijn alleen tabellen weergegeven die die data bevatten.';
$lang_admin[$adminpoint]['BACKUP_SUBMIT']            = 'Beveiligen van de tabellen bevestigen';
$lang_admin[$adminpoint]['BACKUP_TABLES_BACKUPD_MSG']= 'Volgende tabel is beveiligd';
$lang_admin[$adminpoint]['BACKUP_TABLES_CONFIRM_MSG']= 'Wilt u deze tabel werkelijk beveiligen ?';

$lang_admin[$adminpoint]['CHECK_ALL']                = 'Alles selecteren';

$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] = 'Wij hebben geen informatie uit de database gekregen - Dit kan een rechten probleem van de gebruikers van de database zijn.';
$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT']  = 'De toegangsrechten van de database laat geen statistiek informatie toe';
$lang_admin[$adminpoint]['DATABASE_QUERY_RESULT']    = 'Resultaat van de database opvraag';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_ERROR']   = 'Fout';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_INFO']    = 'Informatie';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_OP_ANALYZE'] = 'Analyse';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_STATUS']  = 'Status';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_WARNING'] = 'Waarschuwing';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPACT']    = 'Compakt';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPRESSED'] = 'Gecomprimeerd';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_DYNAMIC']    = 'Dynamisch';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_FIXED']      = 'Reapareer';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_REDUNDANT']  = 'Redundant';
$lang_admin[$adminpoint]['DELETE_HEADER_DELETE']     = 'Wissen ?';
$lang_admin[$adminpoint]['DELETE_HEADER_NAME']       = 'Naam van de tabel';
$lang_admin[$adminpoint]['DELETE_SUBMIT']            = 'Wissen bevestigen';
$lang_admin[$adminpoint]['DELETE_TABLES_CONFIRM_MSG']= 'Wilt u deze tabel werkelijk wissen ?';
$lang_admin[$adminpoint]['DELETE_TABLES_DELETED_MSG']= 'Volgende tabellen zijn gewist';

$lang_admin[$adminpoint]['FILES_QUERY_NO_RESULT']    = 'Er zijn geen beveilings gegevens gevonden';

$lang_admin[$adminpoint]['KB']                       = 'KB';

$lang_admin[$adminpoint]['MAIN_HEADER']              = 'Databank Administratie';
$lang_admin[$adminpoint]['MB']                       = 'MB';

$lang_admin[$adminpoint]['NONE']                     = 'Geen';

$lang_admin[$adminpoint]['OPTIMIZE_HEADER_NAME']       = 'Naam van de tabel';
$lang_admin[$adminpoint]['OPTIMIZE_HEADER_OPTIMIZE']   = 'Optimaliseren ?';
$lang_admin[$adminpoint]['OPTIMIZE_SUBMIT']            = 'Bevestiging optimaliseren van de tabel';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_CONFIRM_MSG']= 'Wilt u deze tabel werkelijk optimaliseren ?';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_OPTIMIZED_MSG']= 'Volgende tabellen zijn geoptimaliseerd';

$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_DELETE']     = 'Gegevens wissen';
$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_VIEW']       = 'Informatie gegevens';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_BACKUP']     = 'Aktie ?';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_CREATED']    = 'Beveiliging aangemaakt op';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_NAME']       = 'Naam bestand';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_FILE']         = 'Beveiligingsbestand';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_MSG']          = 'Alle weergeven beveiligings bestanden bevinden zich in includes/cache';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_ROWS']         = 'Aantal bestands regels in Backupfile';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_TABLES']       = 'Aantal tabellen in backup bestand';
$lang_admin[$adminpoint]['SHOW_BACKUP_SUBMIT']            = 'Beginbewerking';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_SIZE']      = 'Grootte vande databank';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_TABLES']    = 'Aantal tabellen in de databank';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COLLATION']   = 'Sortering';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COMMENT']     = 'Commentaar';
$lang_admin[$adminpoint]['STATISTICS_HEADER_FORMAT']      = 'Formaat';
$lang_admin[$adminpoint]['STATISTICS_HEADER_INCREMENT']   = 'Volgende Inkrement';
$lang_admin[$adminpoint]['STATISTICS_HEADER_MAXSIZE']     = 'Toegestane max gtootte';
$lang_admin[$adminpoint]['STATISTICS_HEADER_NAME']        = 'Naam vande tabel';
$lang_admin[$adminpoint]['STATISTICS_HEADER_ROWS']        = 'Aantal bestandsregels';
$lang_admin[$adminpoint]['STATISTICS_HEADER_SIZE']        = 'Tabel grootte';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TIMESTAMPS']  = 'Gemaakt op<br/>laatste wijziging op<br/>Laatst gecheckt';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TYPE']        = 'Type';
$lang_admin[$adminpoint]['SWITCH_ALL']                    = 'Selectie omkeren';

$lang_admin[$adminpoint]['TITLE_ANALYZE_DB']         = 'Database analyseren';
$lang_admin[$adminpoint]['TITLE_OPTIMIZE_DB']        = 'Database optimaliseren';
$lang_admin[$adminpoint]['TITLE_SHOW_STATISTICS']    = 'Statistieken weergeven';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP']      = 'Tabellen beveiligen';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUPED']    = 'Tabellen beveiligd';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP_SHOW'] = 'Beveiligingen weergeven';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETE']      = 'Tabellen wissen';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETED']     = 'Tabellen gewist';
$lang_admin[$adminpoint]['TITLE_TABLES_OPTIMIZED']   = 'Database geoptimaliseerd';
$lang_admin[$adminpoint]['TITLE_TABLES_REPAIR']      = 'Tabellen repareren';

$lang_admin[$adminpoint]['UNCHECK_ALL']              = 'Alle deselecteren';

?>