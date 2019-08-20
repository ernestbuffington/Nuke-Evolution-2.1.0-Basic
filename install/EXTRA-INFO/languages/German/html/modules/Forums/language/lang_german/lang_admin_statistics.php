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

//
// Package Module
//
$lang['Create'] = 'erzeugen';
$lang['Package_module'] = 'Modulpakete';
$lang['Package_module_explain'] = 'Hier hast Du die M&ouml;glichkeit Deine 3 Moduldateien zu einem Modulpaket zu packen.';
$lang['Package_name'] = 'Paketname';
$lang['Select_info_file'] = 'Infodatei w&auml;hlen';
$lang['Select_lang_file'] = 'Sprachdatei w&auml;hlen';
$lang['Select_module_file'] = 'Modul PHP Datei w&auml;hlen';
//
// Install Module
//
$lang['Author_email'] = 'Autor eMail Adresse';
$lang['Incorrect_update_module'] = 'Das ausgew&auml;hlte Paket ist kein Update f&uuml;r das ausgew&auml;hlte Modul. Bitte vergewissere Dich, dass Du das richtige Paket ausgew&auml;hlt hast.';
$lang['Inst_module_already_exist'] = 'Das Modul mit dem Namen \'%s\' existiert bereits.<br />Wenn Du das Modul aktualisieren willst, musst Du in das Modulmanagement gehen und das Modul dort aktualisieren.<br />Wenn Du das Modul erneut kompett installieren willst, musst Du zuerst das alte Modul deinstallieren.';
$lang['Install_language'] = 'Sprache installieren';
$lang['Install_module_explain'] = 'Hier hast Du die M&ouml;glichkeit ein neues Modul zu installieren. Du kannst dies mit 2 Methoden machen. Mit der ersten Methode kannst Du das Modulpaket mit dem hier unten angebotenen Formular hochladen. Wenn das Hochladen bei Dir nicht funktioniert, kannst Du das Modulpaket in Dein Verzeichnis ./modules/pakfiles hochladen, es wird dann automatisch hier angezeigt. F&uuml;r weitere Informationen wie ein Modulpaket installiert wird, schaue Dir die Dokumentation an.<br />Nachdem Du ein Modulpaket zur Installation ausgew&auml;hlt hast, wirst Du einige Informationen &uuml;ber das Modul, dass du ausgew&auml;hlt hast, erhalten. Stelle bitte sicher, dass die Modulinformationen korrekt sind und die minimalen Anforderungen erf&uuml;llt werden (z.B. die richtige Version des Statistik Mod). Du hast auch die M&ouml;glichkeit die Sprache zu w&auml;hlen, mit der Du es installieren willst. Nachdem Du alles &uuml;berpr&uuml;ft hast und Dir sicher bist zu installieren, klicke den Button zur Installation.<br /><br />Die standardm&auml;ssige Installation lasst das Modul deaktiviert, Du musst es aktivieren bevor es in der Statistik Seite angezeigt wird.';
$lang['Installed_stats_version'] = 'Installierte Version des Statistik Moduls';
$lang['Module_author'] = 'Modul Autor';
$lang['Module_description'] = 'Modul Beschreibung';
$lang['Module_installed'] = 'Modul erfolgreich installiert.';
$lang['Module_name'] = 'Modul Name';
$lang['Module_updated'] = 'Modul erfolgreich upgedatet.';
$lang['Module_url'] = 'Modul/Autor Homepage';
$lang['Module_version'] = 'Modul Version';
$lang['Provided_language'] = 'Angebotene Sprache';
$lang['Required_stats_version'] = 'Minimal notwendige Version des Statistik Moduls';
$lang['Select_module_pak'] = 'Modulpaket ausw&auml;hlen';
$lang['Update_url'] = 'Modul Update Homepage (Pr&uuml;fe auf Updates)';
$lang['Upload_module_pak'] = 'Modulpaket hochladen';
//
// Manage Modules
//
$lang['Activate'] = 'Aktivieren';
$lang['Deactivate'] = 'Deaktivieren';
$lang['Manage_modules_explain'] = 'Hier hast Du die M&ouml;glichkeit Deine Module zu managen. Du kannst sie bearbeiten, l&ouml;schen, die Reihenfolge &auml;ndern, aktivieren und deaktivieren. Wenn Du Dein Modul konfigurieren willst (Zugangskontrolle einstellen, die Sprachvariablen bearbeiten und vieles mehr), musst Du Dein Modul bearbeiten.<br />Wenn Du auf einen Modulname klickst, siehst Du eine Vorschau des Moduls.';
//
// Delete Module
//
$lang['Confirm_delete_module'] = 'Bist Du sicher, dass Du dieses Modul l&ouml;schen willst';
//
// Configuration
//
$lang['Config_Stat_explain'] = 'Hier hast Du die M&ouml;glichkeit das Statistik Modul zu konfigurieren.';
$lang['Config_Stat_title'] = 'Statistik Konfiguration';
$lang['Messages'] = 'Nachrichten';
$lang['Msg_config_updated'] = '- Statistik Modul Konfiguration erfolgreich upgedatet.';
$lang['Msg_purge_modules'] = '- Erfolgreich den Inhalt des Modulverzeichnisses gel&ouml;scht.';
$lang['Msg_reset_cache'] = '- Erfolgreich alle Caches gel&ouml;scht.';
$lang['Msg_reset_install_date'] = '- Installationsdatum auf heute setzten.';
$lang['Msg_reset_view_count'] = '- Z&auml;hlanzeige erfolgreich zur&uuml;ckgesetzt.';
$lang['Purge_module_dir'] = 'Modul Verzeichnis l&ouml;schen';
$lang['Purge_module_dir_explain'] = 'L&ouml;scht das komplette Modulverzeichnis, alle Unterverzeichnisse und Dateien werden gel&ouml;scht. Bitte diese Option nur verwenden, wenn Du ganz sicher bist was Du machst und welche Auswirkungen es auf Deine Statistiken hat.';
$lang['Reset_cache'] = 'Cache l&ouml;schen';
$lang['Reset_cache_explain'] = 'L&ouml;scht alle aktuellen Cache Daten f&uuml;r alle Module und Inhaltvorlagen.';
$lang['Reset_install_date'] = 'Installationsdatum zur&uuml;cksetzen';
$lang['Reset_install_date_explain'] = 'Setzt das Installationsdatum zur&uuml;ck. Das setzt das Installationsdatum auf heute.';
$lang['Reset_settings_title'] = 'Zur&uuml;cksetzen Einstellungen';
$lang['Reset_view_count'] = 'Z&auml;hlanzeige zur&uuml;cksetzen';
$lang['Reset_view_count_explain'] = 'Die Z&auml;hlanzeige am Ende der Statistikseite auf Null zur&uuml;cksetzen.';
$lang['Return_limit'] = 'Return Limit';
$lang['Return_limit_explain'] = 'Die Anzahl der Positionen die in jedem Ranking eingef&uuml;gt werden.';
//
// Edit Module
//
$lang['Active'] = 'Aktiv';
$lang['Clear_module_cache'] = 'Modul Cache l&ouml;schen';
$lang['Clear_module_cache_explain'] = 'Den Modul Cache l&ouml;schen und die Modul Priorit&auml;ten zur&uuml;cksetzen. Das n&auml;chste Mal wenn die Statistikseite aufgerufen wird, wird dieses Modul wieder neu geladen.';
$lang['Edit_module_explain'] = 'Hier hast Du die M&ouml;glichkeit das Modul zu konfigurieren. Am Anfang siehst Du einige Modulinformationen, dann das Nachrichtenfenster, wo alle Update Nachrichten angezeigt werden. Am Ende findest Du den Bereich f&uuml;r die Konfiguration und den Bereich f&uuml;r das Modul Update. Innerhalb des Modul Update Bereichs w&auml;hle bitte ein Modulpaket \'oder\' lade ein Modulpaket hoch, bitte nicht beides.<br />Der Konfigurationsbereich kann sich von Modul zu Modul unterscheiden, weil einige Module spezielle Konfigurationsoptionen haben, wo der Autor gedacht hat, dass diese hilfreich f&uuml;r Dich sind.';
$lang['Module_configuration'] = 'Modul Konfiguration';
$lang['Module_informations'] = 'Modul Informationen';
$lang['Module_languages'] = 'Sprachen verkn&uuml;pft zu diesem Modul';
$lang['Module_select_explain'] = 'Hier kannst Du das Modul w&auml;hlen, dass Du bearbeiten willst.';
$lang['Module_select_title'] = 'Modul w&auml;hlen';
$lang['Module_status'] = 'Modul Status';
$lang['Msg_changed_update_time'] = '- Erfolgreich die Update Zeit ge&auml;ndert.';
$lang['Msg_cleared_module_cache'] = '- Erfolgreich den Modul Cache gel&ouml;scht.';
$lang['Msg_module_fields_updated'] = '- Erfolgreich die definierten Modulfelder aktualisiert.';
$lang['No_module_packages_found'] = 'Keine Modulpakete gefunden';
$lang['Not_active'] = 'Nicht aktiv';
$lang['Preview_module'] = 'Modul Vorschau';
$lang['Update_module'] = 'Modul aktualisieren';
$lang['Update_time'] = 'Update Zeit in Minuten';
$lang['Update_time_explain'] = 'Zeitintervall (in Minuten) f&uuml;r die Aktualisierung der Cache Daten mit den neuen Daten. Jede x Minuten, dass das Modul wieder geladen wird.<br />Seitdem die Statistik ein Priorit&auml;tensystem verwenden, k&ouml;nnen dies mehr als x Minuten sein, aber nicht mehr als ein Tag.';
//
// Permissions
//
$lang['Added_groups'] = 'Hinzugef&uuml;gte Gruppen';
$lang['Msg_permissions_updated'] = '- Zugangskontrolle aktualiseren';
$lang['No_groups_selected'] = 'Keine Gruppen ausgew&auml;hlt';
$lang['No_groups_to_add'] = 'Es gibt keine weiteren Gruppen zum Hinzuf&uuml;gen';
$lang['Perm_add_group'] = 'Gruppe hinzuf&uuml;gen';
$lang['Perm_admin'] = 'Administratoren';
$lang['Perm_all'] = 'G&auml;ste';
$lang['Perm_group'] = 'Gruppen';
$lang['Perm_groups_title'] = 'Gruppen die die M&ouml;glichkeit haben die Module zu sehen';
$lang['Perm_mod'] = 'Moderatoren';
$lang['Perm_reg'] = 'Mitglieder';
$lang['Perm_remove_group'] = 'Gruppe entfernen';
$lang['Permissions'] = 'Zugangskontrollen';
$lang['Set_permissions_title'] = 'Hier hast Du die M&ouml;glichkeit die Erlaubnis f&uuml;r die Ansicht der Module zu setzen. Nur die Benuzer (G&auml;ste, Registrierte, Moderatoren und Administratoren) und Gruppen die hier erlaubt/gelistet sind, haben die M&ouml;glichkeit das Modul innerhalb der Statistikseite zu sehen.';
//
// Language CP
//
$lang['Add_new_key'] = 'Neuen Schl&uuml;ssel hinzuf&uuml;gen';
$lang['Create_new_lang'] = 'Neue Sprache erstellen';
$lang['Delete_language'] = 'Sprache l&ouml;schen';
$lang['Export_everything'] = 'Alles exportieren';
$lang['Export_lang_module'] = 'Sprache f&uuml;r aktuelles Modul exportieren';
$lang['Export_language'] = 'Komplette aktuelle Sprache exportieren';
$lang['Import_new_language'] = 'Neue Sprache importieren';
$lang['Import_new_language_explain'] = 'Hier hast Du die M&ouml;glichkeit Sprachpakete die Du installieren willst hochzuladen (oder auszuw&auml;hlen). Nachdem Du das Sprachpaket hochgeladen (oder ausgew&auml;hlt) hast, siehst Du einige Informationen &uuml;ber das Sprachpaket. Nur nach der Ansicht dieser Informationen wird das Paket installiert.';
$lang['Language'] = 'Sprache';
$lang['Language_cp_explain'] = 'Hier hast Du die M&ouml;glichkeit alle Sprachvariablen und Sprachpakete f&uuml;r jedes Modul zu managen, seperat, &uuml;berhaupt... fast alles. Du kannst hier auch Sprachpakete importieren oder exportieren.';
$lang['Language_cp_title'] = 'Sprache Control Panel';
$lang['Language_key'] = 'Sprachvariable -> Schl&uuml;ssel';
$lang['Language_pak_installed'] = 'Sprachpaket erfolgreich installiert.';
$lang['Language_value'] = 'Sprachvariable -> Wert';
$lang['Modules'] = 'Module';
$lang['No_package_Up'] = 'Keine Module vorhanden. Info/Lang/PHP Dateien m&uuml;ssen in den Ordner \'modules/pakfiles\'.';
$lang['Select_language_pak'] = 'Sprachpaket w&auml;hlen';
$lang['Update_all_lang'] = 'Alle Eintr&auml;ge aktualisieren';
$lang['Upload_language_pak'] = 'Sprachpaket hochladen';

?>