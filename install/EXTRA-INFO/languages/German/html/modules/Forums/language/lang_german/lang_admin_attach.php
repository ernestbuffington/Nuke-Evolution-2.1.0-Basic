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

/**
* DO NOT CHANGE
*/
if (!isset($lang) || !is_array($lang)) {
    $lang = array();
}
//
// Attachment Mod Admin Language Variables
//
$lang['Control_Panel'] = 'Verwaltung';
$lang['Extension_control'] = 'Dateitypen-Kontrolle';
$lang['Extension_group_manage'] = 'Dateityp-Gruppen Kontrolle';
$lang['Forbidden_extensions'] = 'Verbotene Dateitypen';
$lang['Quota_limits'] = 'Quoten';
$lang['Shadow_attachments'] = 'Verwaiste Anh&auml;nge';
$lang['Special_categories'] = 'Spezialkategorien';
$lang['Sync_attachments'] = 'Anh&auml;nge synchronisieren';
//
// Attachments -> Management
//
$lang['Attach_settings'] = 'Anhangs-Einstellungen';
$lang['Manage_attachments_explain'] = 'Hier kannst du die Haupteinstellungen des Anhang-Mods &auml;ndern. Wenn du auf den Test-Button klickst, f&uuml;hrt das Anhangs-Mod einige Systemtests durch, um sicherzustellen das das Mod korrekt arbeitet. Wenn du Probleme beim Upload von Dateien hast, f&uuml;hre diesen Test durch, um genauere Fehlermeldungen zu bekommen.';
$lang['Attach_filesize_settings'] = 'Anhangs-Dateigr&ouml;ssen Einstellungen';
$lang['Attach_number_settings'] = 'Anhangs-Anzahl Einstellungen';
$lang['Attach_options_settings'] = 'Anhangs-Optionen';
$lang['Upload_directory'] = 'Upload-Verzeichnis';
$lang['Upload_directory_explain'] = 'Gib den relativen Pfad ab deiner Nuke-Installation zum Upload-Verzeichnis an. Zum Beispiel gib \'files\' ein, wenn dein Nuke unter http://www.yourdomain.com/ installiert ist und das Upload-Verzeichnis unter http://www.yourdomain.com/files liegt.';
$lang['Attach_img_path'] = 'Anhangs-Icon';
$lang['Attach_img_path_explain'] = 'Dieses Bild wird neben Anhangs-Links in individuellen Beitr&auml;gen angezeigt. Lasse das Feld leer, wenn du kein Icon anzeigen willst. Diese Einstellung wird durch Einstellungen in der Dateityp-Gruppen Kontrolle ausser Kraft gesetzt.';
$lang['Attach_topic_icon'] = 'Anhangs Themen-Icon';
$lang['Attach_topic_icon_explain'] = 'Dieses Bild wird vor Themen mit Anh&auml;ngen angezeigt. Lasse das Feld leer, wenn du kein Icon anzeigen willst.';
$lang['Attach_display_order'] = 'Anhangs Anzeigereihenfolge';
$lang['Attach_display_order_explain'] = 'Hier kannst du einstellen ob die Anh&auml;nge in Beitr&auml;gen/PMs in absteigender zeitlicher Reihenfolge (neueste Anh&auml;nge zuerst) oder absteigender zeitlicher Reihenfolge (&Auml;lteste Anh&auml;nge zuerst).';
$lang['Show_apcp'] = 'Zeige neue Anhangs-/Beitrags-Konrolltafel';
$lang['Show_apcp_explain'] = 'W&auml;hle ob die Anhangs-/Beitrags-Kontrolltafel (Ja) oder die klassische Variante mit zwei getrennten Boxen f&uuml;r die Bearbeitung alter und das Posten neuer Anh&auml;nge (Nein) auf der Beitragsseite angezeigt werden soll. Der Unterschied ist schwer zu erkl&auml;ren, daher ist es das Beste es auszuprobieren.';
$lang['Max_filesize_attach'] = 'Dateigr&ouml;sse';
$lang['Max_filesize_attach_explain'] = 'Maximale Dateigr&ouml;sse f&uuml;r Anh&auml;nge. Ein Wert von 0 bedeutet \'unbegrenzt\'. Dieser Wert ist durch deine Server-Konfiguration begrenzt. Wenn deine PHP-Konfiguration z.B. nur Uploads bis max. 2 MB erlaubt, kannst du im Mod keinen h&ouml;heren Wert einstellen.';
$lang['Attach_quota'] = 'Anhangs-Quote';
$lang['Attach_quota_explain'] = 'Maximaler Plattenplatz, den alle Anh&auml;ge zusammen auf deinem Webspace belegen d&uuml;rfen. Ein Wert von 0 bedeutet \'unbegrenzt\'.';
$lang['Max_filesize_pm'] = 'Maximale Dateigr&ouml;sse im Private Nachrichten Verzeichnis';
$lang['Max_filesize_pm_explain'] = 'Maximaler Plattenplatz den Anh&auml;nge in der privaten Nachrichtenbox des Benutzers belegen d&uuml;rfen. Ein Wert von 0 bedeutet \'unbegrenzt\'.';
$lang['Default_quota_limit'] = 'Standard Quote';
$lang['Default_quota_limit_explain'] = 'Hier kannst du die Standard-Quote f&uuml;r neue Benutzer und Benutzer ohne eigene Quote einstellen. Die Option \'Keine Quote\' bewirkt keine Quoten-Begrenzung statt der hier eingestellten Standardwerte.';
$lang['Max_attachments'] = 'Maximale Anzahl Anh&auml;nge';
$lang['Max_attachments_explain'] = 'Die maximale Anzahl erlaubter Anh&auml;nge in einem Beitrag.';
$lang['Max_attachments_pm'] = 'Maximale Anzahl Anh&auml;nge in einer privaten Nachricht';
$lang['Max_attachments_pm_explain'] = 'Die maximale Anzahl erlaubter Anh&auml;nge in einer privaten Nachricht.';
$lang['Disable_mod'] = 'Deaktiviere Anhangs-Mod';
$lang['Disable_mod_explain'] = 'Diese Option dient haupts&auml;chlich dem Testen neuer Templates oder Themes, sie deaktiviert s&auml;mtliche Anhangs-Funktionen ausser den Administrationsfunktionen.';
$lang['PM_Attachments'] = 'Erlaube Anh&auml;nge in privaten Nachrichten';
$lang['PM_Attachments_explain'] = 'Erlaube/verbiete Dateianh&auml;nge in privaten Nachrichten.';
$lang['Ftp_upload'] = 'Aktiviere FTP Upload';
$lang['Ftp_upload_explain'] = 'Aktiviere/deaktiviere die FTP-Upload Option. Wenn auf ja gesetzt, musst du die Anhangs FTP Einstellungen bearbeiten und das Upload-Verzeichnis wird nicht weiter benutzt.';
$lang['Attachment_topic_review'] = 'Sollen Anh&auml;nge im Themen-&Uuml;berblick Fenster gezeigt werden?';
$lang['Attachment_topic_review_explain'] = 'Wenn du ja w&auml;hlst, werden Dateianh&auml;nge beim Antworten im Themen-&Uuml;berblick Fenster angezeigt.';
$lang['Ftp_server'] = 'FTP Upload Server';
$lang['Ftp_server_explain'] = 'Hier gibst du die IP oder den FTP-Hostnamen des Servers f&uuml;r Dateiuploads ein. L&auml;sst du dieses Feld leer, wird der Server verwendet, auf dem das phpBB installiert ist. Bitte beachte das du kein ftp:// oder &auml;hnliches zur Adresse hinzuf&uuml;gen darfst, nur einfach ftp.foo.com oder, was wesentlich schneller ist, die IP-Adresse.';
$lang['Attach_ftp_path'] = 'FTP-Pfad zu deinem Upload-Verzeichnis';
$lang['Attach_ftp_path_explain'] = 'Das Verzeichnis zur Speicherung deiner Anh&auml;nge. Dieses Verzeichnis muss nicht mit CHMOD ver&auml;ndert werden. Bitte gib hier nicht deinen FTP-Hostnamen oder deine IP ein, dieses Feld ist nur f&uuml;r den FTP-Pfad.<br />z.B.: /home/web/uploads';
$lang['Ftp_download_path'] = 'Download-Link zum FTP-Pfad';
$lang['Ftp_download_path_explain'] = 'Gib die URL deines FTP-Pfades zum Anhangs-Verzeichnis ein.<br />Wenn du einen externen FTP-Server verwendest, gib bitte die komplette URL, z.B. http://www.mystorage.com/phpBB2/upload ein.<br />Wenn du deinen lokalen Server zum Speichern der Dateien benutzt, kannst du den Pfad relativ zu deinem phpBB2-Verzeichnis eingeben, z.B. \'upload\'.<br />F&uuml;hrende Schr&auml;gstriche werden entfernt. Lasse das Feld leer, falls der FTP-Pfad nicht vom Internet aus erreichbar ist. Mit leerem Feld kann die physische Download-Methode nicht verwendet werden.';
$lang['Ftp_passive_mode'] = 'FTP Passiv Mode aktivieren';
$lang['Ftp_passive_mode_explain'] = 'Der PASV-Befehl erfordert, das der entfernte Server einen Port f&uuml;r die Daten&uuml;bertragung &ouml;ffnet und diesen zur&uuml;ckmeldet. Der entfernte Server h&ouml;rt diesen Port ab und der Klient verbindet zu diesem.';
$lang['ftp_username'] = 'FTP Benutzername';
$lang['ftp_password'] = 'FTP Passwort';
$lang['ftp_info'] = 'FTP Konfiguration';
$lang['No_ftp_extensions_installed'] = 'Du kannst die FTP-Upload Methoden nicht verwenden, da die FTP-Erweiterungen nicht in deine PHP-Version integriert wurden.';
//
// Attachments -> Shadow Attachments
//
$lang['Empty_file_entry'] = 'Leerer Dateieintrag';
$lang['Shadow_attachments_explain'] = 'Hier kannst du Anh&auml;nge von Beitr&auml;gen entfernen, falls die Dateien nicht mehr verf&uuml;gbar sind und Dateien l&ouml;schen, falls diese an keine Beitr&auml;ge mehr angeh&auml;ngt sind. Du kannst eine Datei ansehen oder herunterladen, indem du auf sie klickst; wenn kein Link verf&uuml;gbar ist, ist die Datei nicht vorhanden.';
$lang['Shadow_attachments_file_explain'] = 'L&ouml;sche alle Anh&auml;nge die auf dem Server liegen aber an keinen Beitrag angeh&auml;ngt sind.';
$lang['Shadow_attachments_row_explain'] = 'L&ouml;sche alle Anh&auml;nge aus Beitr&auml;gen deren Dateien nicht auf dem Server liegen.';
//
// Attachments -> Sync
//
$lang['Attach_sync_finished'] = 'Anhangs-Synchronisation beendet.';
$lang['Sync_posts'] = 'Post synchronisieren';
$lang['Sync_thumbnail_resetted'] = 'Thumbnail zur&uuml;ckgesetzt f&uuml;r Anhang: %s'; // replace %s with physical Filename
$lang['Sync_thumbnails'] = 'Thumbnails synchronisieren';
$lang['Sync_topics'] = 'Themen synchronisiseren';
//
// Extensions -> Extension Control
//
$lang['Explanation'] = 'Erkl&auml;rung';
$lang['Extension_exist'] = 'Der Dateityp %s existiert bereits'; // replace %s with the Extension
$lang['Extension_group'] = 'Dateityp-Gruppe';
$lang['Invalid_extension'] = 'Ung&uuml;ltiger Dateityp';
$lang['Manage_extensions'] = 'Dateitypen verwalten';
$lang['Manage_extensions_explain'] = 'Hier kannst du deine Dateitypen verwalten. Wenn du einen Dateitypen zum Upload freigeben/sperren m&ouml;chtest, benutze bitte die Dateityp-Gruppen Verwaltung.';
$lang['Unable_add_forbidden_extension'] = 'Der Dateityp %s ist gesperrt, du kannst ihn nicht zu den erlaubten hinzuf&uuml;gen'; // replace %s with Extension
//
// Extensions -> Extension Groups Management
//
$lang['Allowed'] = 'Erlaubt';
$lang['Allowed_forums'] = 'Erlaubt in Foren';
$lang['Category_images'] = 'Bilder';
$lang['Category_stream_files'] = 'Stream-Dateien';
$lang['Category_swf_files'] = 'Flash-Dateien';
$lang['Collapse'] = '+';
$lang['Decollapse'] = '-';
$lang['Download_mode'] = 'Download-Methode';
$lang['Ext_group_permissions'] = 'Gruppen-Berechtigungen';
$lang['Extension_group_exist'] = 'Die Dateityp-Gruppe %s existiert bereits'; // replace %s with the group name
$lang['Manage_extension_groups'] = 'Dateityp-Gruppen verwalten';
$lang['Manage_extension_groups_explain'] = 'Hier kannst du Dateityp-Gruppen hinzuf&uuml;gen, l&ouml;schen oder bearbeiten. Du kannst Dateityp-Gruppen deaktivieren, sie einer speziellen Kategorie zuweisen, die Download-Methode &auml;ndern und ein Icon zur Anzeige vor einem Anhang dieser Gruppe w&auml;hlen.';
$lang['Max_groups_filesize'] = 'Max. Dateigr&ouml;sse';
$lang['Special_category'] = 'Spezialkategorie';
$lang['Upload_icon'] = 'Upload Icon';
//
// Extensions -> Special Categories
//
$lang['Assigned_group'] = 'Zugeordnete Gruppe';
$lang['Attachment_version'] = 'Attachment Mod Version %s'; // %s is the version number
$lang['Display_inlined'] = 'Bilder inline anzeigen';
$lang['Display_inlined_explain'] = 'W&auml;hle, ob Bilder direkt im Beitrag (Ja) oder als Link angezeigt werden sollen.';
$lang['Image_create_thumbnail'] = 'Thumbnail erzeugen';
$lang['Image_create_thumbnail_explain'] = 'Immer einen Thumbnail erzeugen. Diese Funktion setzt nahezu alle Einstellungen dieser Spezial-Gruppe ausser Kraft, ausser der maximalen Bildgr&ouml;sse. Mit dieser Funktion wird im Beitrag ein Thumbnail angezeigt, der Benutzer kann darauf klicken, um das Originalbild anzuzeigen.<br />Bitte beachte das diese Funktion ImageMagick ben&ouml;tigt, ist es nicht installiert oder ist der Safe-Mode aktiviert, wird die GD-Library von PHP verwendet. Wird der Bildtyp nicht von PHP unterst&uuml;tzt, wird diese Funktion nicht verwendet.';
$lang['Image_imagick_path'] = 'ImageMagick Programm (Kompletter Pfad)';
$lang['Image_imagick_path_explain'] = 'Gib den Pfad zum Konvertierungsprogramm von ImageMagick an, normalerweise /usr/bin/convert (unter Windows: c:/imagemagick/convert.exe).';
$lang['Image_link_size'] = 'Bild-Link Grenze';
$lang['Image_link_size_explain'] = 'Wenn diese Gr&ouml;sse eines Bildes &uuml;berschritten wird, wird das Bild als Link anstatt inline angezeigt,<br />auch wenn inline aktiviert ist (Breite x H&ouml;he in Pixeln).<br />Wenn auf 0x0 eingestellt, ist die Begrenzung deaktiviert. Aufgrund von Einschr&auml;nkungen in PHP funktioniert diese Begrenzung mit einigen Bildtypen nicht.';
$lang['Image_min_thumb_filesize'] = 'Minimale Thumbnail-Gr&ouml;sse';
$lang['Image_min_thumb_filesize_explain'] = 'Ist ein Bild kleiner als diese Einstellung wird kein Thumbnail erzeugt, weil es klein genug ist.';
$lang['Image_search_imagick'] = 'Suche ImageMagick';
$lang['Manage_categories'] = 'Spezialkategorien verwalten';
$lang['Manage_categories_explain'] = 'Hier kannst du die Spezialkategorien konfigurieren. Du kannst spezielle Parameter und Bedingungen f&uuml;r die Spezial-Kategorie einer Dateityp-Gruppe definieren.';
$lang['Max_image_size'] = 'Max. Bildgr&ouml;sse';
$lang['Max_image_size_explain'] = 'Hier kannst du die maximal erlaubte Bildgr&ouml;sse f&uuml;r Anh&auml;nge definieren (Breite x H&ouml;he in Pixeln).<br />Wenn auf 0x0 eingestellt, ist die Begrenzung deaktiviert. Aufgrund von Einschr&auml;nkungen in PHP funktioniert diese Begrenzung mit einigen Bildtypen nicht.';
$lang['Settings_cat_flash'] = 'Einstellung f&uuml;r die Spezialkategorie: Flash-Dateien';
$lang['Settings_cat_images'] = 'Einstellung f&uuml;r die Spezialkategorie: Bilder';
$lang['Settings_cat_streams'] = 'Einstellung f&uuml;r die Spezialkategorie: Stream-Dateien';
$lang['Use_gd2'] = 'Benutze GD2-Library';
$lang['Use_gd2_explain'] = 'PHP kann mit der GD1- oder GD2-Library ausgestattet sein. Um ohne ImageMagick Thumbnails korrekt erzeugen zu k&ouml;nnen, verwendet das Attachment Mod zwei unterschiedliche Verfahren, abh&auml;ngig von der Einstellung hier. Wenn deine Thumbnails in schlechter Qualit&auml;t oder falsch dargestellt werden, versuche diese Einstellung zu &auml;ndern.';
//
// Extensions -> Forbidden Extensions
//
$lang['Extension_exist_forbidden'] = 'Der Dateityp %s ist unter den erlaubten Dateitypen definiert. Bitte l&ouml;sche sie zuerst dort, bevor du sie hier hinzuf&uuml;gen kannst.';  // replace %s with the extension
$lang['Forbidden_extension_exist'] = 'Der gesperrte Dateityp %s existiert bereits'; // replace %s with the extension
$lang['Manage_forbidden_extensions'] = 'Gesperrte Dateitypen verwalten';
$lang['Manage_forbidden_extensions_explain'] = 'Hier kannst du die gesperrten Dateitypen hinzuf&uuml;gen oder entfernen. Die Dateitypen php, php3 und php4 sind aus Sicherheitsgr&uuml;nden standardm&auml;ssig gesperrt, du kannst sie nicht l&ouml;schen.';
//
// Extensions -> Extension Groups Control -> Group Permissions
//
$lang['Add_forums'] = 'Foren hinzuf&uuml;gen';
$lang['Add_selected'] = 'Auswahl hinzuf&uuml;gen';
$lang['Group_permissions_explain'] = 'Hier kann die Verwendung einzelner Dateityp-Gruppen auf bestimmte Foren beschr&auml;nkt werden (definiert in der Box \'Erlaubt in Foren\'). Standardm&auml;ssig sind die Dateityp_gruppen in allen Foren erlaubt, in denen Anh&auml;nge gepostet werden d&uuml;rfen. F&uuml;ge die Foren in denen die Dateityp-Gruppe (die Dateitypen in dieser Gruppe) erlaubt sein soll, der Standard ALLE FOREN verschwindet sobald du Foren zur Liste hinzuf&uuml;gst. Du kannst jederzeit wieder zu ALLE FOREN wechseln. Wenn du ein neues Forum erstellst und ALLE FOREN gew&auml;hlt hast, &auml;ndert sich nichts. Wenn allerdings nur bestimmte Foren in der Liste stehen, musst du die Einstellungen nach Erzeugen neuer Foren hier aktualisieren. Es w&auml;re einfach dieses automatisch zu tun, w&uuml;rde jedoch eine Menge Datei&auml;nderungen erfordern, weshalb ich diesen Weg gew&auml;hlt habe. Bedenke das alle deine Foren hier aufgef&uuml;hrt werden.';
$lang['Group_permissions_title'] = 'Dateityp-Gruppen Berechtigungen -> \'%s\''; // Replace %s with the Groups Name
$lang['Note_admin_empty_group_permissions'] = 'HINWEIS:<br />In den unten aufgef&uuml;hrten Foren d&uuml;rfen deine Benutzer Anh&auml;nge posten. Da jedoch keine Dateityp-Gruppen freigegeben sind, kann trotzdem nichts angeh&auml;ngt werden. Wenn sie es versuchen, werden sie Fehlermeldungen erhalten. Eventuell willst du die Berechtigung f&uuml;r Anh&auml;nge in diesen Foren auf ADMIN stellen.<br /><br />';
$lang['Perm_all_forums'] = 'ALLE FOREN';
//
// Attachments -> Quota Limits
//
$lang['Assigned_groups'] = 'Zugeordnete Gruppen';
$lang['Assigned_users'] = 'Zugeordnete Benutzer';
$lang['Manage_quotas'] = 'Anhangs-Quoten verwalten';
$lang['Manage_quotas_explain'] = 'Hier kannst du Quoten hinzuf&uuml;gen, l&ouml;schen und bearbeiten. Du kannst dieses Quoten sp&auml;ter Benutzern oder Gruppen zuordnen. Um einem Benutzer eine Quote zuzuordnen, gehe auf Benutzer->Einstellungen und w&auml;hle den Benutzer, die Einstellungen befinden sich unten im Formular. Um einer Gruppe eine Quote zuzuordnen, gehe auf Gruppen->Einstellungen und w&auml;hle die Gruppe. Um zu sehen welche Benutzer oder Gruppen einer bestimmten Quote zugeordnet sind, klicke auf \'Anzeigen\' links neben der Quotenbeschreibung.';
$lang['Quota_limit_exist'] = 'Die Quote %s existiert bereits.'; // Replace %s with the Quota Description
//
// Attachments -> Control Panel
//
$lang['Control_panel_explain'] = 'Hier kannst du alle Anh&auml;nge auf Basis der Benutzer, Anh&auml;nge, Aufrufe, etc. verwalten';
$lang['Control_panel_title'] = 'Dateianhangs-Verwaltung';
$lang['File_comment_cp'] = 'Dateikommentar';
//
// Control Panel -> Search
//
$lang['Count_greater_than'] = 'Anzahl Downloads gr&ouml;sser als';
$lang['Count_smaller_than'] = 'Anzahl Downloads kleiner als';
$lang['More_days_old'] = 'Mehr als soviel Tage alt';
$lang['No_attach_search_match'] = 'Keine Anh&auml;nge f&uuml;r deine Suche gefunden';
$lang['Search_wildcard_explain'] = 'Benutze * als Wildcard f&uuml;r Teilsuche';
$lang['Size_greater_than'] = 'Anhangsgr&ouml;sse gr&ouml;sser als (Bytes)';
$lang['Size_smaller_than'] = 'Anhangsgr&ouml;sse kleiner als (Bytes)';
//
// Control Panel -> Statistics
//
$lang['Number_of_attachments'] = 'Anzahl der Anh&auml;nge';
$lang['Number_pms_attach'] = 'Gesamtzahl der Anh&auml;nge in privaten Nachrichten';
$lang['Number_posts_attach'] = 'Anzahl der Beitr&auml;ge mit Anh&auml;ngen';
$lang['Number_topics_attach'] = 'Anzahl der Themen mit Anh&auml;ngen';
$lang['Number_users_attach'] = 'Benutzer haben Anh&auml;nge gepostet';
$lang['Total_filesize'] = 'Gesamte Dateigr&ouml;sse';
//
// Control Panel -> Attachments
//
$lang['Downloads'] = 'Downloads';
$lang['Post_time'] = 'Beitragsdatum';
$lang['Posted_in_topic'] = 'Gepostet im Thema';
$lang['Size_in_kb'] = 'Gr&ouml;sse (KB)';
$lang['Statistics_for_user'] = 'Anhangs-Statistiken f&uuml;r %s'; // replace %s with username
$lang['Submit_changes'] = '&Auml;nderungen speichern';
//
// Sort Types
//
$lang['Sort_Attachments'] = 'Anh&auml;nge';
$lang['Sort_Comment'] = 'Kommentar';
$lang['Sort_Downloads'] = 'Downloads';
$lang['Sort_Extension'] = 'Dateityp';
$lang['Sort_Filename'] = 'Dateiname';
$lang['Sort_Posts'] = 'Beitr&auml;ge';
$lang['Sort_Posttime'] = 'Beitragsdatum';
$lang['Sort_Size'] = 'Gr&ouml;sse';
//
// View Types
//
$lang['View_Attachments'] = 'Anh&auml;nge';
$lang['View_Search'] = 'Suche';
$lang['View_Statistic'] = 'Statistiken';
$lang['View_Username'] = 'Benutzername';
//
// Successfully updated
//
$lang['Attach_config_updated'] = 'Anhangs-Konfiguration erfolgreich aktualisiert';
$lang['Click_return_attach_config'] = 'Klicke %shier%s, um zur Anhangs-Konfiguration zur&uuml;ckzukehren';
$lang['Test_settings_successful'] = 'Einstellungs-Test beendet, die Konfiguration scheint in Ordnung zu sein.';
//
// Some basic definitions
//
$lang['Attachment'] = 'Anhang';
$lang['Attachments'] = 'Anh&auml;nge';
$lang['Extension'] = 'Dateityp';
$lang['Extensions'] = 'Dateitypen';
//
// Auth pages
//
$lang['Auth_attach'] = 'Dateien posten';
$lang['Auth_download'] = 'Dateien herunterladen';

?>