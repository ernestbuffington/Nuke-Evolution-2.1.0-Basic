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

// Auth Related Entries
$lang['Rules_attach_can'] = 'Je <b>kan</b> bestanden bijvoegen in dit forum';
$lang['Rules_attach_cannot'] = 'Je <b>kan geen </b> bestanden bijvoegen in dit forum';
$lang['Rules_download_can'] = 'Je <b>kan</b> bestanden downloaden in dit forum';
$lang['Rules_download_cannot'] = 'Je <b>kan geen</b> bestanden downloaden in dit forum';
$lang['Sorry_auth_view_attach'] = 'Sorry, je bent niet bevoegt deze bijlage te zien of te downloaden';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'Omschrijving'; // used in Administration Panel too...
$lang['Downloaded'] = 'Gedownload';
$lang['Download'] = 'Download'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'Bestands grootte';
$lang['Viewed'] = 'Bekeken';
$lang['Download_number'] = '%d maal'; // replace %d with count
$lang['Extension_disabled_after_posting'] = 'De extentie \'%s\' is niet geactiveerd door de board admin, daarom wordt deze bijlage niet getoond.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Controle paneel bijlage posten';
$lang['Attach_posting_cp_explain'] = 'Indien je klikt op een bijlage toevoegen krijg je een venster om bijlagen to te voegen.<br />Indien je klikt op geposte bijlagen krijg je een lijst van bijgevoegde bestanden en kan je deze bewerken.<br />Indien bijlage wil vervangen (uploaden van een nieuwere versie), moet je beide links klikken. Voeg de bijlage toe zoals je normaal zou doen, maar klik daarna niet op toevoegen, maar op upload nieuwe versie bij de betreffende bijlage.';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Bijlage toevoegen';
$lang['Add_attachment_title'] = 'Voeg een bijlage toe';
$lang['Add_attachment_explain'] = 'Indien je geen bijlage wil toevoegen bij uw bericht, laat dit veld leeg';
$lang['File_name'] = 'Bestands naam';
$lang['File_comment'] = 'Bestands commentaar';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'Geposte bijlagen';
$lang['Options'] = 'Opties';
$lang['Update_comment'] = 'Update commentaar';
$lang['Delete_attachments'] = 'Verwijder bijlagen';
$lang['Delete_attachment'] = 'Verwijder bijlage';
$lang['Delete_thumbnail'] = 'Verwijder thumbnail';
$lang['Upload_new_version'] = 'Upload nieuwe versie';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = '%s is een niet toegestane bestands naam'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'De bijlage is te groot.<br />Kan de maximum grootte gedefinieerd in PHP niet bereiken.<br />De bijlage Mod kan de maximum upload grootte niet bepalen in the php.ini.';
$lang['Attachment_php_size_overrun'] = 'De bijlage is te groot.<br />Maximum upload grootte: %d MB.<br />Merk op dat deze grootte bepaald is in php.ini, dit betekend dat PHP dit bepaald en de bijlage Mod dit niet kan overheersen'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = 'De extentie %s is niet toegelaten'; // replace %s with extension (e.g. .php) 
$lang['Disallowed_extension_within_forum'] = 'U bent niet bevoegd om bestanden met %s extentie te posten in dit forum'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'De bijlage is te groot.<br />Max grootte: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = 'Sorry, de maximum bestands grootte voor alle bijlagen is bereikt. Contacteer de board administrator indien hierover vragen hebt.';
$lang['Too_many_attachments'] = 'Bijlage kan niet worden toegevoegd omdat het max. aantal van %d bijlagen in dit bericht is bereikt'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'De bijgevoegde tekening moet minder dan %d pixels breed en %d pixels hoog zijn'; 
$lang['General_upload_error'] = 'Upload fout: Kan de bijlage niet uploaden naar %s.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = 'Je moet waarden invullen in het \'Voeg bijlage toe\' venster';
$lang['Error_missing_old_entry'] = 'Kan de bijlage niet updaten, kan de oude bijlage niet vinden';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = 'Sorry, de maximum bestands grootte voor alle bijlagen in uw privé bericht map is bereikt. Verwijder enkele ontvangen/gezonden bijlagen.';
$lang['Attach_quota_receiver_pm_reached'] = 'Sorry, de maximum bestands grootte voor alle bijlagen in de privé bericht map van \'%s\' is bereikt. Wacht, of laat hem/haar weten dat ze enkele bijlagen moet verwijderen.';

// Errors -> Download
$lang['No_attachment_selected'] = 'Je hebt geen bijlage geselecteerd om te downloaden of te bekijken.';
$lang['Error_no_attachment'] = 'De geselecteerde bijlage bestaat niet meer';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Ben je zeker dat je de geselecteerde bijlagen wilt verwijderen?';
$lang['Deleted_attachments'] = 'De geselecteerde bijlagen zijn verwijderd.';
$lang['Error_deleted_attachments'] = 'Kan de bijlagen niet verwijderen.';
$lang['Confirm_delete_pm_attachments'] = 'Ben je zeker dat je alle bijlagen wilt verwijderen in deze PM?';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'De bijlage optie is uitgeschakeld.';

$lang['Directory_does_not_exist'] = 'De map \'%s\' bestaat niet of kan niet gevonden worden.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'Contoleer als \'%s\' een map is.'; // replace %s with directory
$lang['Directory_not_writeable'] = 'Map \'%s\' is niet beschrijfbaar. Je moet het upload pad maken en chmod naar 777 (of verander de eigenaar naar juo httpd-servers) om bestanden te uploaden.<br />Indien je enkel plain ftp-toegang hebt, verander de \'Attribute\' van uw map naar rwxrwxrwx.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'Kan geen verbinding krijgen naar de ftp server: \'%s\'. Controleer uw ftp instellingen.';
$lang['Ftp_error_login'] = 'Kan niet inloggen op de ftp server. De gebruikers naam \'%s\' of paswoord is verkeerd. Controleer uw ftp instellingen.';
$lang['Ftp_error_path'] = 'Kan geen de ftp map niet bereiken: \'%s\'. Controleeruw FTP instellingen.';
$lang['Ftp_error_upload'] = 'Kan geen bestanden uploaden naar de ftp map: \'%s\'. Controleer uw ftp instellingen.';
$lang['Ftp_error_delete'] = 'Kan het bestand niet wissen in de ftp map: \'%s\'. Controleer uw ftp instellingen.<br />Een ander reden kan zijn dat de bijlage niet bestaat, controleer dit eerst in schaduw bijlagen.';
$lang['Ftp_error_pasv_mode'] = 'Kan ftp passieve mode niet aan/uit schakelen';

// Attach Rules Window
$lang['Rules_page'] = 'Bijlage regels';
$lang['Attach_rules_title'] = 'Toegelaten extentie groepen en hun grootte';
$lang['Group_rule_header'] = '%s -> Maximum upload grootte: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = 'Toegelaten extenties en grootte';
$lang['Note_user_empty_group_permissions'] = 'Opmerking:<br />Je hebt normaal toelating in dit forum om bijlagen te posten, <br />maar omdat er geen extentie groep toegelaten wordt hier, <br />kan je geen enkele bijlagen posten. Indien je dit probeert, <br />ga je een foutmelding krijgen.<br />';

// Quota Variables
$lang['Upload_quota'] = 'Upload quota';
$lang['Pm_quota'] = 'PM quota';
$lang['User_upload_quota_reached'] = 'Sorry, je hebt de maximum Upload quota limiet bereikt van %d %s'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'Gebruiker ACP';
$lang['UACP'] = 'Gebruiker bijlage controle paneel';
$lang['User_uploaded_profile'] = 'Uploaded: %s';
$lang['User_quota_profile'] = 'Quota: %s';
$lang['Upload_percent_profile'] = '%d%% van totaal';

// Common Variables
$lang['Bytes'] = 'Bytes';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';
$lang['Attach_search_query'] = 'Zoek bijlagen';
$lang['Test_settings'] = 'Test instellingen';
$lang['Not_assigned'] = 'Niet toegewezen';
$lang['No_file_comment_available'] = 'Geen bestands commentaar beschikbaar';
$lang['Attachbox_limit'] = 'Uw bijlage box is %d%% vol';
$lang['No_quota_limit'] = 'Geen quota limiet';
$lang['Unlimited'] = 'Geen limiet';

?>