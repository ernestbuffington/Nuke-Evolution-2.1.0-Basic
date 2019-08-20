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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

$lang['Rebuild_search'] = 'Neuaufbau Suchtabelle';
$lang['Rebuild_search_desc'] = 'Dieser Mod bearbeitet alle Beitr&auml;ge im Forum und baut die Suchworttabellen neu auf.
Du kannst den Prozess jederzeit abbrechen und beim n&auml;chsten Start an der Stelle wieder aufsetzen, an der Du abgebrochen hattest.<br /><br />
Es kann unter Umst&auml;nden l&auml;ngere Zeit dauern bis der Prozess abgeschlossen ist (abh&auml;ngig von "Beitr&auml;gen per Zyklus" und "Zeitlimit"),
also, bitte verlasse den Browser w&auml;hrend des Prozesses nicht - ausser Du m&ouml;chtest den Prozess wirklich abbrechen.';
//
// Input screen
//
$lang['Clear_search_delete'] = 'L&ouml;schen';
$lang['Clear_search_no'] = 'Nein';
$lang['Clear_search_tables'] = 'L&ouml;sche die Suchtabellen';
$lang['Clear_search_tables_explain'] = 'Wenn Du vom ersten Beitrag aus startest, kannst Du die 3 Forensuchtabellen l&ouml;schen<br />Du hast die Wahl zwischen dem L&Ouml;SCHEN der Tabelle/LEEREN der Tabelle';
$lang['Clear_search_truncate'] = 'Leeren';
$lang['Disable_board'] = 'Sperre die Webseite';
$lang['Disable_board_explain'] = 'Soll die Webseite w&auml;hrend der Programmlaufzeit gesperrt werden ?';
$lang['Disable_board_explain_already'] = '<i>Deine Webseite wurde bereits durch die Foren-Administration gesperrt</i>';
$lang['Disable_board_explain_enabled'] = 'Die Webseite wird automatisch am Ende des Vorgangs wieder freigegeben.';
$lang['Fast_mode'] = 'Schneller Modus';
$lang['Fast_mode_explain'] = 'Bearbeitet die gesamte Datenbank ohne zuerst die alten Eintr&auml;ge zu entfernen<br />Nur mit Vorsicht zu gebrauchen!!! Bitte zuerst die Anleitung f&uuml;r mehr Informationen dazu durchlesen.';
$lang['Max_info'] = '(Max : %d)';
$lang['Num_of_posts'] = 'Anzahl der Beitr&auml;ge';
$lang['Num_of_posts_explain'] = 'Gesamtanzahl der Beitr&auml;ge, die durchsucht werden m&uuml;ssen<br />Wird automatisch mit der Anzahl der gefundenen Beitr&auml;ge in der Datenbank gef&uuml;llt.';
$lang['Posts_per_cycle'] = 'Beitr&auml;ge per Zyklus';
$lang['Posts_per_cycle_explain'] = 'Anzahl der Beitr&auml;ge pro Durchgang.<br />Halte die Zahl gering, damit keine Servertimeouts erfolgen';
$lang['Refresh_rate'] = 'Refresh Rate';
$lang['Refresh_rate_explain'] = 'Pause (in Sekunden) zwischen den Zyklen<br />Normalerweise sollte der Wert nicht ge&auml;ndert werden';
$lang['Start_option_beginning'] = 'Starte vom ersten Beitrag';
$lang['Start_option_continue'] = 'Starte vom letzten Abbruch';
$lang['Starting_post_id'] = 'Starte von Beitrags_id';
$lang['Starting_post_id_explain'] = 'Der erste Beitrag, von dem der Neuaufbau beginnen soll<br />Du kannst zwischen dem ersten Beitrag oder einer vorherigen Abbruchstelle starten ';
$lang['Time_limit'] = 'Zeitlimit';
$lang['Time_limit_explain'] = 'Maximale Zeitspanne (Sekunden) bevor der n&auml;chste Zyklus begonnen werden muss (Timeout-Wert f&uuml;r Prozesse beachten)';
$lang['Time_limit_explain_safe'] = '<i>Dein php(safe mode) hat ein Zeitlimit von %s Sekunden konfiguriert, also bleibe bitte unterhalb dieses Wertes</i>';
$lang['Time_limit_explain_webserver'] = '<i>Dein Webserver hat ein Zeitlimit von %s Sekunden konfiguriert, also bleibe bitte unterhalb dieses Wertes</i>';
//
// Information strings
//
$lang['Info_processing_aborted'] = 'Du hattest zulezt beim Beitrag %s abgebrochen (%s bearbeitete Beitr&auml;ge) von %s';
$lang['Info_processing_aborted_soon'] = 'Bitte warte einen Moment bevor Du weiter machst...';
$lang['Info_processing_finished'] = 'Die Bearbeitung wurde erfolgreich durchgef&uuml;hrt (%s bearbeitete Beitr&auml;ge) von %s';
$lang['Info_processing_finished_new'] = 'Die Bearbeitung wurde erfolgreich mit dem Beitrag %s abgeschlossen (%s bearbeitete Beitr&auml;ge) von %s,<br />es wurden aber danach neue Beitr&auml;ge in die Datenbank eingef&uuml;gt';
$lang['Info_processing_stopped'] = 'Du hattest zulezt beim Beitrag %s angehalten (%s bearbeitete Beitr&auml;ge) von %s';
//
// Progress screen
//
$lang['Active_parameters'] = 'Aktuelle Parameter';
$lang['All_posts_processed'] = 'Alle Beitr&auml;ge wurden erfolgreich bearbeitet.';
$lang['All_session_posts_processed'] = 'Alle Beitr&auml;ge der aktuellen Sitzung wurden bearbeitet.';
$lang['All_tables_optimized'] = 'Alle Suchtabellen wurden erfolgreich optimiert.';
$lang['Board_disabled'] = 'Inaktiv';
$lang['Board_enabled'] = 'Aktiv';
$lang['Board_status'] = 'Status der Webseite';
$lang['Bytes'] = 'Bytes';
$lang['Cleared_search_tables'] = 'Die Suchtabellen wurden gel&ouml;scht. ';
$lang['Click_return_rebuild_search'] = 'Klicke %shier%s um zum Men&uuml;punkt Neuaufbau Suchtabelle zur&uuml;ck zu kehren';
$lang['Current_session'] = 'Aktuelle Sitzung';
$lang['Database_size_details'] = 'Datenbankgr&ouml;sse Details';
$lang['Deleted_posts'] = '%s Beitr&aum;ge wurden w&auml;hrend der Bearbeitung durch Deine User gel&ouml;scht. ';
$lang['Info_estimated_values'] = '(*) Alle erwarteten Werte sind Sch&auml;tzwerte<br /> basierend auf dem bereits abgeschlossenen Prozentsatz und m&uuml;ssen nicht mit den endg&uuml;ltigen Werten &uuml;bereinstimmen.<br /> Je h&ouml;her der abgeschlossene Prozentsatz, desto genauer stimmt der erwartete Wert mit dem endg&uuml;ltigen Wert &uuml;berein.';
$lang['Percent'] = 'Prozent';
$lang['Percent_completed'] = '%s %% erledigt';
$lang['Posts_last_cycle'] = 'Beitr&auml;ge pro Zyklus';
$lang['Process_details'] = 'von <strong>%s</strong> bis <strong>%s</strong> (von insgesamt <strong>%s</strong>)';
$lang['Processed_post_ids'] = 'Bearbeitete Beitrags-Ids: %s - %s';
$lang['Processed_posts'] = 'Bearbeitete Beitr&auml;ge';
$lang['Processing_next_posts'] = 'Die n&auml;chsten %s Beitr&auml;ge werden bearbeitet. Bitte warte ...';
$lang['Processing_post_details'] = 'Bearbeite Beitragsdetails';
$lang['Processing_time'] = 'Zeitverl&auml;fe';
$lang['Processing_time_details'] = 'Prozesszeit Details';
$lang['Rebuild_search_aborted'] = 'Der Neuafubau wurde bei der Beitrags-Id %s abgebrochen.<br /><br />Wenn Du w&auml;hrend eines aktiven Prozesses abgebrochen hast, so musst Du noch ein bischen warten, bevor Du das Programm erneut starten kannst.';
$lang['Rebuild_search_progress'] = 'Fortschrittsanzeige';
$lang['Size_current'] = 'Aktuell';
$lang['Size_database'] = 'Gr&ouml;sse der Datenbank';
$lang['Size_estimated'] = 'Erwartete Gr&ouml;sse';
$lang['Size_search_tables'] = 'Gr&ouml;sse der Suchtabellen';
$lang['Time_average'] = 'Durchschnitt per Zyklus seit Programmstart';
$lang['Time_estimated'] = 'Gesch&auml;tzte Zeit bis zur Fertigstellung';
$lang['Time_from_the_beginning'] = 'Seit Programmstart';
$lang['Time_last_posts'] = 'F&uuml;r die letzen %s Beitr&auml;ge';
$lang['Timer_expired'] = 'Zeitlimit wurde nach %s Sekunden erreicht. ';
$lang['Total'] = 'Gesamt';
$lang['Wrong_input'] = 'Du hast fehlerhafte Werte eingegeben. Bitte &uuml;berpr&uuml;fe Deine Eingaben und versuche es erneut.';
$lang['days'] = 'Tage';
$lang['hours'] = 'Stunden';
$lang['minutes'] = 'Minuten';
$lang['seconds'] = 'Sekunden';
//
// Buttons
//
$lang['Finished'] = 'Beendet';
$lang['Next'] = 'N&auml;chste';
$lang['Processing'] = 'In Arbeit ...';

?>