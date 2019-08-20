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
// Modules, this replaces the keys used
$lang['Control_Panel'] = 'Controle Paneel';
$lang['Shadow_attachments'] = 'Schaduw Bijlagen';
$lang['Forbidden_extensions'] = 'Verboden Extensies';
$lang['Extension_control'] = 'Extensie Controle';
$lang['Extension_group_manage'] = 'Extensie Groepen Controle';
$lang['Special_categories'] = 'Speciale Categorieën';
$lang['Sync_attachments'] = 'Synchronizeer Bijlagen';
$lang['Quota_limits'] = 'Quota Limieten';

// Attachments -> Management
$lang['Attach_settings'] = 'Bijlage Instellingen';
$lang['Manage_attachments_explain'] = 'Hier kan je Hoofd Instellingen configureren voor de Bijlage Mod. Als je drukt op de Test Instellingen Knop, dan zal de Bijlage Mod een paar Systeem Tests doen om er zeker van te zijn dat de Mod goed werkt. Als je problemen hebt met het uploaden van Files, aub doe deze Test, om een gedetailleerd fouten bericht te krijgen.';
$lang['Attach_filesize_settings'] = 'Bijlage File grootte Instelling';
$lang['Attach_number_settings'] = 'Bijlage Nummer Instellingen';
$lang['Attach_options_settings'] = 'Bijlage Opties';

$lang['Upload_directory'] = 'Upload Folder';
$lang['Upload_directory_explain'] = 'Voer het relatieve pad van jouw phpBB2 installatie bij de bijlagen upload folder. Bijvoorbeeld, voer \'file\'in als je phpBB2 Installatie is geplaatst in http://www.yourdomain.com/phpBB2 en de Bijlage Upload Folder is geplaatst in http://www.yourdomain.com/phpBB2/files.';
$lang['Attach_img_path'] = 'Bijlagen Posting Icoon';
$lang['Attach_img_path_explain'] = 'Dit plaatje is geplaatst naast de Bijlage Links in individuele Postings. Laat dit veld leeg als je geen icoon wilt laten zien. Deze Instelling wordt overschreven door de Instellingen in Extensie Groeps Beheer.';
$lang['Attach_topic_icon'] = 'Bijlage Onderwerp Icoon';
$lang['Attach_topic_icon_explain'] = 'Dit Plaatje wordt getoond voor de onderwerpen met Bijlagen. Laat dit veld leeg als je geen icoon wilt laten zien.';
$lang['Attach_display_order'] = 'Bijlage volgorde van laten zien';
$lang['Attach_display_order_explain'] = 'Hier kan je kiezen of de Bijlagen in Post/PM  wilt laten zien in Stijgende Filetijd Volgorde (Nieuwste Bijlage Eerst) of Dalende Filetijd Volgorde (Oudste Bijlage Eerst)';
$lang['Show_apcp'] = 'Laat nieuwe Bijlage Posting Controle Paneel zien';
$lang['Show_apcp_explain'] = 'Kies of, om de Bijlagen Posting Controle Paneel te zien (ja) of de oude methode met twee Boxes voor Bijlagen Files en aanpassen van je geposte Bijlagen (nee) in je Posting Scherm. Hoe het er uit ziet is erg moeilijk uit te leggen, daarom is het beste om het maar uit te proberen.';

$lang['Max_filesize_attach'] = 'Filegrootte';
$lang['Max_filesize_attach_explain'] = 'Maximum file grootte voor Bijlagen. Een waarde van 0 betekend \'ongelimiteerd\'. Deze Instelling is beperkt door je Server Configuratie. Bijvoorbeeld, als je php Configuratie alleen een maximum van 2 MB uploads toelaat, dit kan niet worden overschreven door de Mod.';
$lang['Attach_quota'] = 'Bijlagen Quota';
$lang['Attach_quota_explain'] = 'Maximum Disk Ruimte ALLE Bijlagen kan je Hosting ruimte kosten. Een waarde van 0 betekend \'ongelimiteerd\'.';
$lang['Max_filesize_pm'] = 'Maximum File grootte in Privé Berichten Folder';
$lang['Max_filesize_pm_explain'] = 'Maximum Disk Ruimte Bijlagen kan worden opgebruikt in ieder Gebruikers Privé Berichten box. Een waarde van 0 betekent \'ongelimiteerd\'.';
$lang['Default_quota_limit'] = 'Standaard Quota Limiet';
$lang['Default_quota_limit_explain'] = 'Hier kan je kiezen voor de Standaard Quota Limiet automatisch toegewezen bij nieuw geregistreerde Gebruikers en Gebruikers zonder gedefinieerd Quota Limiet. De Optie \'Geen Quota Limiet\' is voor niet gebruiken iedere Bijlagen Quotas, inplaats van het gebruiken van de standaard Instellingen die je hebt gedefinieerd in deze Management Paneel.';

$lang['Max_attachments'] = 'Maximum Aantal van Bijlagen';
$lang['Max_attachments_explain'] = 'Het maximum aantal van Bijlagen toegestaan in één post.';
$lang['Max_attachments_pm'] = 'Maximum aantal van Bijlagen in één Privé Bericht';
$lang['Max_attachments_pm_explain'] = 'Definieer het maximum aantal van Bijlagen die een gebruiker is toegestaan mee te sturen in een privé bericht.';

$lang['Disable_mod'] = 'Uitzetten Bijlagen Mod';
$lang['Disable_mod_explain'] = 'Deze optie is voornamelijk voor het testen van nieuwe templates of themas, het zet alle  Bijlagen Functies uit behalve in de Admin Paneel.';
$lang['PM_Attachments'] = 'Toestaan Bijlagen in Privé Berichten';
$lang['PM_Attachments_explain'] = 'Toestaan/Uitzetten Bijlagen files aan Privé Berichten.';
$lang['Ftp_upload'] = 'Aanzetten FTP Upload';
$lang['Ftp_upload_explain'] = 'Toestaan/Uitzetten van de FTP Upload optie. Als is insteld op ja, moet je de Bijlagen FTP instellingen en de Upload folder niet langer in gebruik definieeren.';
$lang['Attachment_topic_review'] = 'Wil je de Bijlagen in de Onderwerp Vooruitblik Venster laten zien ?';
$lang['Attachment_topic_review_explain'] = 'Als je ja kiest, zullen alle Bijlagen Files worden getoond in de Onderwerp Rapport wanneer je een antwoord post.';

$lang['Ftp_server'] = 'FTP Upload Server';
$lang['Ftp_server_explain'] = 'Hier kan je het IP-Adres of FTP-Hostnaam invoeren van de Server die wordt gebruikt voor je uploaded files. Als je dit veld leeg , de Server waarop je phpBB2 Board is geinstalleerd wordt dan gebruikt. Aub let op dat het niet is toegestaan een om ftp:// of iets anders toe te voegen aan het adres, gewoon eenvoudig ftp.foo.com of, wat veel sneller is, het IP Adres.';

$lang['Attach_ftp_path'] = 'FTP Pad naar je upload folder';
$lang['Attach_ftp_path_explain'] = 'De Folder waar je Bijlagen worden opgeslagen. Deze Folder hoeft niet te worden chmodded. Aub voer hier niet je IP of FTP-Adres in, dit invoer veld is alleen voor het FTP Pad.<br />Bijvoorbeeld: /home/web/uploads';
$lang['Ftp_download_path'] = 'Download Link naar FTP Pad';
$lang['Ftp_download_path_explain'] = 'Voer de URL naar je FTP Pad in, waar je Bijlagen worden opgeslagen.<br />Als je een Remote FTP Server gebruikt, aub voer dan de gehele url in, bijvoorbeeld http://www.mystorage.com/phpBB2/upload.<br />Als je een Local Host gebruikt om je Files op te slaan, dan is het mogelijk het url pad in te voeren relatief naar je phpBB2 Folder, bijvoorbeeld \'upload\'.<br />Een trailing slash wordt verwijderd. Laat dit veld leeg, als het FTP Pad niet toegankelijk is via het Internet. Met dit veld leeg dan is het niet mogelijk de natuurlijke download methode te gebruiken.';
$lang['Ftp_passive_mode'] = 'Aanzetten FTP Passieve Mode';
$lang['Ftp_passive_mode_explain'] = 'Het PASV commando verzoekt dat de remote server een port opent voor de data connection en geeft het adres van die port. De remote server luistert naar die port en de client maakt contact met het.';

$lang['ftp_username'] = 'Je FTP Gebruikersnaam';
$lang['ftp_password'] = 'Je FTP Wachtwoord';

$lang['No_ftp_extensions_installed'] = 'Het is niet mogelijk de FTP Upload Methode te gebruiken, omdat FTP Extensions niet zijn gecompiled in je PHP Installatie.';

// Attachments -> Schaduw Bijlagen
$lang['Shadow_attachments_explain'] = 'Hier kan je Bijlagen data verwijderen van postings wanneer de files worden gemist in je file systeem, en verwijder files die niet langer een bijlagen zijn bij bestaande postings. Je kunt downloaden of een file bekijken als je er op klikt; als er geen link aanwezig is, dan bestaat de file niet.';
$lang['Shadow_attachments_file_explain'] = 'Verwijder alle Bijlagen files die in je file systeem zijn maar niet zijn toegewezen aan een bestaande post.';
$lang['Shadow_attachments_row_explain'] = 'Verwijder alle geposte bijlagen data voor files die niet bestaan in je file systeem.';
$lang['Empty_file_entry'] = 'Leeg File Invoer';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'Thumbnail ge-reset voor bijlagen: %s'; // vervang %s met fysieke Filenaam
$lang['Attach_sync_finished'] = 'Bijlagen Syncronizatie Klaar.';

// Extensions -> Extension Control
$lang['Manage_extensions'] = 'Beheer Extensies';
$lang['Manage_extensions_explain'] = 'Hier kan je je File Extensies beheren. Als je wilt toestaan/weigeren een extensie te worden ge-upload, aub gebruik dan de Extensie Groeps Beheer.';
$lang['Explanation'] = 'Uitleg';
$lang['Extension_group'] = 'Extensie Groep';
$lang['Invalid_extension'] = 'Invalide Extensie';
$lang['Extension_exist'] = 'De Extensie %s bestaat al'; // vervang het %s met de Extensie
$lang['Unable_add_forbidden_extension'] = 'De Extensie %s is verboden, het is niet mogelijk dat je het toevoegd aan de toegestane Extensies'; // vervang %s met Extensie

// Extensions -> Extensie Groeps Beheer
$lang['Manage_extension_groups'] = 'Beheer Extensie Groepen';
$lang['Manage_extension_groups_explain'] = 'Hier kan je in Extensie Groepen, toevoegen, verwijderen en aanpassen, je kan Extensie Groepen uitzetten, een speciale Categorie er aan toewijzen, het download mechanisme veranderen en je kan een Upload Icoon definieëren welke zich laat zien aan de voorkant van een Bijlage die bij de groep behoort.';
$lang['Special_category'] = 'Speciale Categorie';
$lang['Category_images'] = 'Images';
$lang['Category_stream_files'] = 'Stream Files';
$lang['Category_swf_files'] = 'Flash Files';
$lang['Allowed'] = 'Toegestaan';
$lang['Allowed_forums'] = 'Toegestane Forums';
$lang['Ext_group_permissions'] = 'Groep Permissies';
$lang['Download_mode'] = 'Download Mode';
$lang['Upload_icon'] = 'Upload Icoon';
$lang['Max_groups_filesize'] = 'Maximum Filegrootte';
$lang['Extension_group_exist'] = 'De Extensie Groep %s bestaat al'; // replace %s with the group name
$lang['Collapse'] = '+';
$lang['Decollapse'] = '-';

// Extensions -> Special Categories
$lang['Manage_categories'] = 'Beheer Speciale Categorieën';
$lang['Manage_categories_explain'] = 'Hier kan je de Speciale Categorieën Configureren. Je kan Speciale Parameters en Condities instellen voor de Speciale Categorieën toegewezen aan een Extensie Groep.';
$lang['Settings_cat_images'] = 'Instellingen voor Speciale Categorie: Images';
$lang['Settings_cat_streams'] = 'Instellingen voor Speciale Categorie: Stream Files';
$lang['Settings_cat_flash'] = 'Instellingen voor Speciale Categorie: Flash Files';
$lang['Display_inlined'] = 'Laat Images Inlined zien';
$lang['Display_inlined_explain'] = 'Kies of om images direct in een post laten zien (ja) of laat de images als een link zien?';
$lang['Max_image_size'] = 'Maximum Image Dimensies';
$lang['Max_image_size_explain'] = 'Hier kan je de maximum toegestane Image Dimensie die moet worden toegevoegd (Breedte x Hoogte in pixels)definieëren.<br />Als het is ingesteld op 0x0, dan is deze eigenschap uitgezet. Met sommige Images zal deze eigenschap niet werken wegens limitaties in PHP.';
$lang['Image_link_size'] = 'Image Link Dimensies';
$lang['Image_link_size_explain'] = 'Als deze gedefinieërde Dimensie van een Image is bereikt, wordt de Image getoond als  een Link, dan het laten zien als inlined,<br />als Inline Bekijken is aangezet (Breedte x Hoogte in pixels).<br />Als dit is ingesteld als 0x0, deze eigenschap is uitgezet. Met sommige Images zal deze eigenschap niet werken wegens limitaties in PHP.';
$lang['Assigned_group'] = 'Toegewezen Groep';

$lang['Image_create_thumbnail'] = 'Creër Thumbnail';
$lang['Image_create_thumbnail_explain'] = 'Altijd een Thumbnail creëren. Deze eigenschap overschrijft bijn alle instellingen binnenin deze Speciale Categorie, behalve de Maximum Image Dimensies. Met deze eigenschap zal een thumbnail worden geplaatst in de post, de Gebruiker kan er op klikken om de echte Image te openen.<br />Let op deze eigenschap vereist dat Imagick is geinstalleerd, als het niet is geinstalleerd of als Safe-Mode is aangezet de GD-Extensie van PHP wordt dan gebruikt. Als het Image-Type niet is ondersteund door PHP, zal deze eigenschap niet worden gebruikt.';
$lang['Image_min_thumb_filesize'] = 'Minimum Thumbnail Filegrootte';
$lang['Image_min_thumb_filesize_explain'] = 'Als een Image kleiner is dan de gedefinieerde Filegrootte, wordt er geen Thumbnail gecreerd, omdat het al klein genoeg is.';
$lang['Image_imagick_path'] = 'Imagick Programma (Volledige Pad)';
$lang['Image_imagick_path_explain'] = 'Voer het Pad in naar het convert programma van imagick, normaal /usr/bin/convert (op windows: c:/imagemagick/convert.exe).';
$lang['Image_search_imagick'] = 'Zoek Imagick';

$lang['Use_gd2'] = 'Maak gebruik van GD2 Extensie';
$lang['Use_gd2_explain'] = 'Met PHP is het mogelijk de GD1 or GD2 Extensies te gebruiken voor image manipuleren. Om Thumbnails correct te creëren zonder imagemagick de Bijlagen Mod gebruikt twee verschillende methodes, gebaseerd op jouw selectie hier. Als jouw thumbnails in een slechte kwaliteit zijn of een puinhoop, probeer de instelling te veranderen.';
$lang['Attachment_version'] = 'Bijlagen Mod Versie %s'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'Beheer Verboden Extensies';
$lang['Manage_forbidden_extensions_explain'] = 'Hier kan je de verboden extensies toevoegen of verwijderen. De Extensies php, php3 and php4 zijn standdaard al verboden voor veiligheids redenen, je kan ze niet verwijderen.';
$lang['Forbidden_extension_exist'] = 'De verboden Extensie %s bestaat al'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = 'De Extensie %s is gedefinieerd in jouw toegestane Extensions, aub verwijder het daar voordat je het hier toevoegd.';  // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'Extensie Groep Permissies -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'Hier kan je de gekozen Extensie Groep naar Forums van jouw keus (gedefineerd in de Toegestane Forums Box)beperken. De standaard is om Extensie Groepen naar alle Forums toe te staan de Gebruiker kan dan Bijlagen Files in forums gebruiken (de normale manier zoals de Bijlagen Mod het deed sinds het begin). Voeg die Forums toe waar je de Extensie Groep (de Extensies binnenin die Groep) die daar mogen zijn, de standaard is ALLE FORUMS zal verdwijnen wanneer je forums toevoegd aan de lijst. Je kunt ALLE FORUMS op elk ogenblik her-toevoegen. Als je een Forum toevoegd bij jouw Board en de Toestemming is ingesteld naar ALLE FORUMS dan verandert er niets. Maar als je naar bepaalde Forums hebt veranderd en de toegang hebt beperkt, moet je hier terug keren om de het nieuw gevormde Forum toe te voegen. Het is makkelijk dit automatisch te doen, maar dat dwingt je je een hoop Files aan te passen, daarvoor heb ik er voor gekozen het op deze manier te doen. Aub houd in gedachten, dat al je Forums hier op de lijst staan.';
$lang['Note_admin_empty_group_permissions'] = 'NOTITIE:<br />Binnenin in de Forum lijst hieronder mogen je gebruikers normaal de File bijlagen gebruiken, maar sinds geen Extensie Groep toestemming heeft om daar bijlagen aanhangen te gebruiken, kunnen je gebruikers er niks aanhangen. Als ze het proberen, ontvangen ze Fout Berichten. Misschien wil je Toestemming instellen \'Post Files\' naar ADMIN op deze Forums.<br /><br />';
$lang['Add_forums'] = 'Forums Toevoegen';
$lang['Add_selected'] = 'Toevoegen Gekozen';
$lang['Perm_all_forums'] = 'ALLE FORUMS';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'Beheer Bijlagen Quota Limieten';
$lang['Manage_quotas_explain'] = 'Hier kan je Quota Limieten toevoegen/verwijderen/veranderen. Het is mogelijk om deze Quota Limieten later aan Gebruikers en Groepen later toe te wijzen. Om een Quota Limiet aan een Gebruiker toe te wijzen, moet je gaan naar Gebruikers->Beheer, kies de Gebruikers en dan zie je de Opties op de bodem. Om een Quota Limiet toe te wijzen aan een Groep, ga naar Groeps->Beheer, kies de Groep om aan te passen, en je zult de Configuratie Instellingen zien. Als je wilt zien, welke Gebruiker en Groepen zijn toegewezen aan specifieke Quota Limiet, Klik op \'Bekijk\' aan de linkerkant van Quota Beschrijving.';
$lang['Assigned_users'] = 'Toegewezen Gebruikers';
$lang['Assigned_groups'] = 'Toegewezen Groepen';
$lang['Quota_limit_exist'] = 'Het Quota Limiet %s bestaat al.'; // Replace %s with the Quota Description

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'File Bijlagen Controle Paneel';
$lang['Control_panel_explain'] = 'Hier kan je alle Bijlagen gebaseerd op Gebruikers, Bijlagen, Bekeken enz... bekijken en beheren.';
$lang['File_comment_cp'] = 'File Commentaar';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = 'Gebruik * als een wildcard voor gedeeltelijke overeenkomst';
$lang['Size_smaller_than'] = 'Bijlagen grootte kleiner dan (bytes)';
$lang['Size_greater_than'] = 'Bijlagen grootte groter dan (bytes)';
$lang['Count_smaller_than'] = 'Download telling is kleiner dan';
$lang['Count_greater_than'] = 'Download telling is goter dan';
$lang['More_days_old'] = 'Meer dan zoveel dagen oud';
$lang['No_attach_search_match'] = 'Geen Bijlagen met jouw zoek criteria';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'Aantal van Bijlagen';
$lang['Total_filesize'] = 'Totaal Filegrootte';
$lang['Number_posts_attach'] = 'Aantal van Posts met Bijlagen';
$lang['Number_topics_attach'] = 'Aantal van Onderwerpen met Bijlagen';
$lang['Number_users_attach'] = 'Onafhankelijke Gebruikers Gepostte Bijlagen';
$lang['Number_pms_attach'] = 'Total AantalNumber of Bijlagen in Private Messages';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = 'Bijlagen Statistieken voor %s'; // replace %s with username
$lang['Size_in_kb'] = 'Grootte (KB)';
$lang['Downloads'] = 'Downloads';
$lang['Post_time'] = 'Post Tijd';
$lang['Posted_in_topic'] = 'Posted in Ondewerp';
$lang['Submit_changes'] = 'Verstuur Veranderingen';

// Sort Types
$lang['Sort_Attachments'] = 'Bijlagen';
$lang['Sort_Size'] = 'Grootte';
$lang['Sort_Filename'] = 'Filename';
$lang['Sort_Comment'] = 'Commentaar';
$lang['Sort_Extension'] = 'Extensie';
$lang['Sort_Downloads'] = 'Downloads';
$lang['Sort_Posttime'] = 'Post Tijd';
$lang['Sort_Posts'] = 'Posts';

// View Types
$lang['View_Statistic'] = 'Statistieken';
$lang['View_Search'] = 'Zoeken';
$lang['View_Username'] = 'Gebruikersnaam';
$lang['View_Attachments'] = 'Bijlagen';

// Successfully updated
$lang['Attach_config_updated'] = 'Bijlagen Configuratie met succes ge-update';
$lang['Click_return_attach_config'] = 'Klik %sHier%s om terug te keren naar Bijlagen Configuratie';
$lang['Test_settings_successful'] = 'Instellingen Test klaar, configuratie lijkt goed te zijn.';

// Some basic definitions
$lang['Attachments'] = 'Bijlagen';
$lang['Attachment'] = 'Bijlage';
$lang['Extensions'] = 'Extensies';
$lang['Extension'] = 'Extensie';

// Auth pages
$lang['Auth_attach'] = 'Post Files';
$lang['Auth_download'] = 'Download Files';

?>