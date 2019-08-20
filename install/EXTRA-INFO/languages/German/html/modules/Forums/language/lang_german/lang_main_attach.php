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
// Attachment Mod Main Language Variables
//
// Auth Related Entries
$lang['Rules_attach_can'] = 'Du <strong>kannst</strong> Dateien an Deine Beitr&auml;ge in diesem Forum anh&auml;ngen.';
$lang['Rules_attach_cannot'] = 'Du kannst <strong>keine</strong> Dateien an Deine Beitr&auml;ge in diesem Forum anh&auml;ngen.';
$lang['Rules_download_can'] = 'Du <strong>kannst</strong> in diesem Forum Dateien herunterladen.';
$lang['Rules_download_cannot'] = 'Du kannst in diesem Forum <strong>keine</strong> Dateien herunterladen.';
$lang['Sorry_auth_view_attach'] = 'Du bist leider nicht berechtigt diesen Anhang anzusehen oder herunterzuladen';
// Attach Rules Window
$lang['Allowed_extensions_and_sizes'] = 'Erlaubte Dateitypen und -Gr&ouml;ssen';
$lang['Attach_rules_title'] = 'Erlaubte Dateitypen und -Gr&ouml;ssen';
$lang['Group_rule_header'] = '%s -> Maximale Upload-Gr&ouml;sse: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Note_user_empty_group_permissions'] = 'HINWEIS:<br />Du kannst normalerweise in diesem Forum Dateien anh&auml;ngen,<br />da jedoch keine freigegebenen Dateitypen existieren,<br />kannst Du nichts hochladen. Wenn Du es versuchst,<br />erh&auml;ltst Du eine Fehlermeldung.<br />';
$lang['Rules_page'] = 'Anhangs-Regeln';
// Common Variables
$lang['Attach_search_query'] = 'Anh&auml;nge suchen';
$lang['Attachbox_limit'] = 'Deine Anhangsbox ist zu %d%% gef&uuml;llt';
$lang['Bytes'] = 'Bytes';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';
$lang['No_file_comment_available'] = 'Kein Dateikommentar verf&uuml;gbar';
$lang['No_quota_limit'] = 'Kein Pensum';
$lang['Not_assigned'] = 'Nicht definiert';
$lang['Test_settings'] = 'Einstellungen testen';
$lang['Unlimited'] = 'Unbegrenzt';
// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Bist Du sicher dass Du die gew&auml;hlten Anh&auml;nge l&ouml;schen willst?';
$lang['Confirm_delete_pm_attachments'] = 'Willst Du wirklich alle Anh&auml;nge dieser Nachricht l&ouml;schen?';
$lang['Deleted_attachments'] = 'Die gew&auml;hlten Anh&auml;nge wurden gel&ouml;scht.';
$lang['Error_deleted_attachments'] = 'Konnte Anh&auml;nge nicht l&ouml;schen.';
// Errors -> Download
$lang['Error_no_attachment'] = 'Der gew&auml;hlte Anhang exisitiert nicht mehr';
$lang['No_attachment_selected'] = 'Du hast keinen Anhang zum Anzeigen/Herunterladen gew&auml;hlt.';
// Errors -> PM Related
$lang['Attach_quota_receiver_pm_reached'] = 'Der maximale Speicher f&uuml;r Anh&auml;nge in den privaten Nachrichten des Empf&auml;ngers \'%s\' wurde erreicht. Bitte gib ihr/ihm Bescheid oder warte bis sie/er einige seiner Anh&auml;nge gel&ouml;scht hat.';
$lang['Attach_quota_sender_pm_reached'] = 'Der maximale Speicher f&uuml;r Dateianh&auml;nge in Deinen privaten Nachrichten ist erreicht. Bitte l&ouml;sche zuerst einige empfangene/gesendete Anh&auml;nge.';
// Errors -> Posting Attachments
$lang['Attach_quota_reached'] = 'Der maximale Speicher f&uuml;r Dateianh&auml;nge ist erreicht. Bitte wende Dich an den Administrator, falls du dazu Fragen hast.';
$lang['Attachment_php_size_na'] = 'Der Anhang ist zu gross.<br />Konnte die maximale PHP-Uploadgr&ouml;sse nicht ermitteln.<br />Das Attachment Mod kann die maximale Uploadgr&ouml;sse aus der php.ini nicht ermitteln.';
$lang['Attachment_php_size_overrun'] = 'Der Anhang ist zu gross.<br />Maximale Uploadgr&ouml;sse: %d MB.<br />Bitte beachte das dieser Wert in der php.ini definiert ist. Das Attachment Mod kann diesen Wert nicht &uuml;berschreiten.'; // replace %d with ini_get('upload_max_filesize')
$lang['Attachment_too_big'] = 'Der Anhang ist zu gross.<br />Max. Gr&ouml;sse: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Disallowed_extension'] = 'Der Dateityp ist nicht erlaubt'; // replace %s with extension (e.g. .php) 
$lang['Disallowed_extension_within_forum'] = 'Du darfst Dateien des Typs %s in diesem Forum nicht anh&auml;ngen'; // replace %s with the Extension
$lang['Error_empty_add_attachbox'] = 'Du musst die Felder in der \'Datei anh&auml;ngen\' Box ausf&uuml;llen';
$lang['Error_imagesize'] = 'Das angeh&auml;ngte Bild muss weniger als %d Pixel breit und %d Pixel hoch sein'; 
$lang['Error_missing_old_entry'] = 'Kann Anhang nicht aktualisieren, konnte alten Anhang nicht finden';
$lang['General_upload_error'] = 'Upload-Fehler: Konnte Anhang nicht nach %s hochladen.'; // replace %s with local path
$lang['Invalid_filename'] = '%s ist ein ung&uuml;ltiger Dateiname'; // replace %s with given filename
$lang['Too_many_attachments'] = 'Die Datei kann nicht angeh&auml;ngt werde, da die maximale Anzahl von %d Anh&auml;ngen in diesem Beitrag erreicht ist'; // replace %d with maximum number of attachments
// General Error Messages
$lang['Attachment_feature_disabled'] = 'Das Attach Mod ist deaktiviert.';
$lang['Directory_does_not_exist'] = 'Das Verzeichnis \'%s\' existiert nicht oder konnte nicht gefunden werden.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'Bitte pr&uuml;fe, ob \'%s\' ein Verzeichnis ist.'; // replace %s with directory
$lang['Directory_not_writeable'] = 'Das Verzeichnis \'%s\' ist nicht beschreibbar. Du musst den Upload-Pfad erzeugen und ihn auf chmod 777 stellen (oder dessen Besitzer auf deinen HTTPD-Server Besitzer &auml;ndern), um Dateien hochladen zu k&ouml;nnen.<br />Wenn Du nur reinen FTP-Zugang hast, &auml;ndere die \'Attribute\' des Verzeichnisses zu rwxrwxrwx.'; // replace %s with directory
$lang['Ftp_error_connect'] = 'Konnte nicht zum FTP-Server verbinden: \'%s\'. Bitte pr&uuml;fe deine FTP-Einstellungen.';
$lang['Ftp_error_delete'] = 'Konnte keine Dateien im FTP-Verzeichnis l&ouml;schen: \'%s\'. Bitte pr&uuml;fe deine FTP-Einstellungen.<br />Ein anderer Grund k&ouml;nnte sein, das der Anhang nicht existiert, bitte pr&uuml;fe dies zuerst unter \'Verwaiste Anh&auml;nge\'.';
$lang['Ftp_error_login'] = 'Konnte nicht am FTP-Server anmelden. Der Username \'%s\' oder das Passwort sind falsch. Bitte pr&uuml;fe deine FTP-Einstellungen.';
$lang['Ftp_error_pasv_mode'] = 'Konnte passiven FTP Modus nicht aktivieren/deaktivieren';
$lang['Ftp_error_path'] = 'Konnte nicht auf das FTP-Verzeichnis zugreifen: \'%s\'. Bitte pr&uuml;fe deine FTP-Einstellungen.';
$lang['Ftp_error_upload'] = 'Konnte keine Dateien in das FTP_verzeichnis hochladen: \'%s\'. Bitte pr&uuml;fe deine FTP-Einstellungen.';
// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Dateianhangs-Verwaltung';
$lang['Attach_posting_cp_explain'] = 'Wenn Du auf \'Datei anh&auml;ngen\' klickst, siehst Du die Box f&uuml;r das Hinzuf&uuml;gen von Anh&auml;ngen.<br />Wenn Du auf \'Angeh&auml;ngte Dateien\' klickst, siehst du eine Liste bereits angeh&auml;ngter Dateien und kannst sie bearbeiten.<br />Wenn Du einen Anhang ersetzen willst (neuere Version hochladen), musst Du beide Links klicken. F&uuml;ge den neuen Anhang ganz normal hinzu, klicke aber anstatt auf \'Datei anh&auml;ngen\' auf \'Neue Version hochladen\' beim zu aktualisierenden Anhang.';
// Posting/PM -> Posted Attachments
$lang['Delete_attachment'] = 'Anhang l&ouml;schen';
$lang['Delete_attachments'] = 'Anh&auml;nge l&ouml;schen';
$lang['Delete_thumbnail'] = 'Thumbnail l&ouml;schen';
$lang['Options'] = 'Optionen';
$lang['Posted_attachments'] = 'Angeh&auml;ngte Dateien';
$lang['Update_comment'] = 'Kommentar aktualisieren';
$lang['Upload_new_version'] = 'Neue Version hochladen';
// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Datei anh&auml;ngen';
$lang['Add_attachment_explain'] = 'Wenn Du keine Datei an Deinen Beitrag anh&auml;ngen willst, lasse die Felder leer';
$lang['Add_attachment_title'] = 'Datei anh&auml;ngen';
$lang['File_comment'] = 'Dateikomentar';
$lang['File_name'] = 'Dateiname';
// Quota Variables
$lang['Pm_quota'] = 'PN Pensum';
$lang['Upload_quota'] = 'Upload Pensum';
$lang['User_upload_quota_reached'] = 'Du hast Dein maximales Upload-Pensum von %d %s erreicht'; // replace %d with Size, %s with Size Lang (MB for example)
// User Attachment Control Panel
$lang['UACP'] = 'User-Anhangs Verwaltung';
$lang['Upload_percent_profile'] = '%d%% vom Gesamtpensum';
$lang['User_acp_title'] = 'User ACP';
$lang['User_quota_profile'] = 'Pensum: %s';
$lang['User_uploaded_profile'] = 'Hochgeladen: %s';
// Viewtopic -> Display of Attachments
$lang['Description'] = 'Beschreibung'; // used in Administration Panel too...
$lang['Download'] = 'Herunterladen'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Download_number'] = '%d mal'; // replace %d with count
$lang['Downloaded'] = 'Heruntergeladen';
$lang['Extension_disabled_after_posting'] = 'Der Dateityp \'%s\' wurde vom Admin gesperrt, dieser Anhang wird deshalb nicht angezeigt.'; // used in Posts and PM's, replace %s with mime type
$lang['Filesize'] = 'Dateigr&ouml;sse';
$lang['Viewed'] = 'Angesehen';

?>