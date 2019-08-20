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

$lang['Archive_Feature'] = 'Archiv  Feature';
$lang['Archive_Table_Inserted'] = 'Archiv Tabelle existierte nicht, wurde erstellt<br />';
$lang['Current'] = 'derzeit';
$lang['Disable'] = 'Abschalten';
$lang['Enable'] = 'Aktivieren';
$lang['Inline'] = 'Inline';
$lang['Inserted_Default_Value'] = '%s Position der Konfiguration existiert nicht, ein vorgegebener Wert wurde eingef&uuml;gt<br />'; // %s = config name
$lang['PM_View_Type'] = 'PN anzeigen lassen als';
$lang['Pop_up'] = 'Pop-up';
$lang['Rows_Minus_5'] = '5 Zeilen entfernen';
$lang['Rows_Per_Page'] = 'Zeilen pro Seite';
$lang['Rows_Plus_5'] = '5 Zeilen hinzuf&uuml;gen';
$lang['Show_IP'] = 'IP Adresse zeigen';
$lang['Switch_Archive'] = 'In den Archiv Modus wechsel';
$lang['Switch_Normal'] = 'Auf normalen Modus wechseln';
$lang['Updated_Config'] = 'Die Position der Konfiguration %s wurde aktualisiert<br />'; // %s = config item
//
// Errors
//
$lang['Error_Other_Table'] = 'Fehler beim Lesen einer ben&ouml;tigten Tabelle.';
$lang['Error_Posts_Archive_Table'] = 'Fehler beim Lesen der Privaten Nachricht Archiv Tabelle.';
$lang['Error_Posts_Table'] = 'Fehler beim Lesen der Privaten Nachricht Tabelle.';
$lang['Error_Posts_Text_Table'] = 'Fehler beim Lesen der Privaten Nachricht Text-Tabelle.';
$lang['No_Message_ID'] = 'Keine Nachrichten-ID angegeben.';
//
// General
//
$lang['Affected_Rows'] = '%d bekannte Eintr&auml;ge entfernt<br />';
$lang['Archive'] = 'Archiv';
$lang['Archive_Desc'] = 'Die zur Archivierung vorgesehenen privaten Nachrichten sind hier aufgelistet. Benutzer k&ouml;nnen diese nicht mehr erreichen (Sender und Empf&auml;nger), Du kannst sie jedoch jederzeit anzeigen oder l&ouml;schen.';
$lang['Archived_Message'] = 'Private Nachricht archiviert - %s <br />'; // %s = PM title
$lang['Archived_Message_No_Delete'] = 'Kann %s nicht l&ouml;schen, sie ist ausserdem zur Archivierung markiert<br />'; // %s = PM title
$lang['Delete'] = 'L&ouml;schen';
$lang['Deleted_Message'] = 'Private Nachricht gel&ouml;scht - %s <br />'; // %s = PM title
$lang['Filter_By'] = 'Filtern &uuml;ber';
$lang['From'] = 'Von';
$lang['Nivisec_Com'] = 'Nivisec.com';
$lang['No_PMS'] = 'Keine zur Sortierung passenden privaten Nachrichten anzuzeigen';
$lang['Normal_Desc'] = 'Alle privaten Nachrichten des Boards k&ouml;nnen hier verwaltet werden. Du kannst die Nachrichten hier lesen, l&ouml;schen, archivieren oder aufheben, Benutzer k&ouml;nnen sie aber nicht mehr erreichen).';
$lang['PM_Type'] = 'PM-Typ';
$lang['Private_Messages'] = 'Private Nachrichten';
$lang['Private_Messages_Archive'] = 'Private Nachrichten Archiv';
$lang['Remove_All'] = 'Alle PNs:</a> <span class="gensmall">ACHTUNG: Das l&ouml;scht ALLE PNs</span>';
$lang['Remove_Old'] = 'Verwaiste PNs:</a> <span class="gensmall">Nicht mehr vorhandene Benutzer k&ouml;nnten PNs zur&uuml;ckgelassen haben, diese Funktion entfernt sie.</span>';
$lang['Remove_Sent'] = 'Ausgangs-PNs:</a> <span class="gensmall">PMs im Postausgang sind lediglich Kopien der gesendeten Nachrichten, nur dass sie dem Absender zugeordnet werden, sobald der Empf&auml;nger sie gelesen hat. Sie werden eigentlich nicht gebraucht.</span>';
$lang['Removed_All'] = 'Alle PNs entfernt<br />';
$lang['Removed_Old'] = 'Alle verwaisten PNs entfernt<br />';
$lang['Removed_Sent'] = 'Alle Ausgangs-PNs entfernt<br />';
$lang['Sent_Date'] = 'Sendedatum';
$lang['Sort'] = 'Sortieren';
$lang['Status'] = 'Status';
$lang['Subject'] = 'Betreff';
$lang['To'] = 'An';
$lang['Utilities'] = 'Massen L&ouml;sch-Werkzeuge';
$lang['Version'] = 'Version';
//
// PM Types
//
$lang['PM_-1'] = 'Alle Typen'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'PNs lesen'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'Neue PNs'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'Gesendete PNs'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'Gespeicherte PNs (Eingang)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'Gespeicherte PNs (Ausgang)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'Ungelesene PNs'; //PRIVMSGS_UNREAD_MAIL = 5
//
// Special Cases, Do not bother to change for another language
//
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['Close_Window'] = 'Fenster schliessen';
$lang['DESC'] = $lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];

?>