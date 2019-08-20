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

$lang['General'] = 'Algemeen Admin';
$lang['Users'] = 'Gebruikers Admin';
$lang['Groups'] = 'Groeps Admin';
$lang['Forums'] = 'Forum Admin';
/*****[BEGIN]******************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/
$lang['Faq_manager'] = 'FAQ Admin';
/*****[END]********************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/

$lang['Configuration'] = 'Configuratie';
$lang['Permissions'] = 'Toelatingen';
$lang['Manage'] = 'Beheer';
$lang['Disallow'] = 'Niet toegestane namen';
$lang['Prune'] = 'Snoeien';
$lang['Mass_Email'] = 'Bulk email';
$lang['Ranks'] = 'Rangen';
$lang['Smilies'] = 'Smilies';
$lang['Ban_Management'] = 'Ban beheer';
$lang['Word_Censor'] = 'Woord censuur';
$lang['Export'] = 'Exporteren';
$lang['Create_new'] = 'Aanmaken';
$lang['Add_new'] = 'Toevoegen';
$lang['Backup_DB'] = 'Backup database';
$lang['Restore_DB'] = 'Herstel database';
/*****[BEGIN]******************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/
$lang['board_faq'] = 'Board FAQ';
$lang['bbcode_faq'] = 'BBcode FAQ';
$lang['attachment_faq'] = 'Bijlage FAQ';
$lang['prillian_faq'] = 'Prillian FAQ';
$lang['bid_faq'] = 'Buddy Lijst FAQ';
/*****[END]********************************************
 [ Mod:     Faq Manager                       v1.0.0b ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Board Rules                        v2.0.0 ]
 ******************************************************/
$lang['site_rules'] = 'Site Regels';
/*****[END]********************************************
 [ Mod:     Board Rules                        v2.0.0 ]
 ******************************************************/


//
// Index
//
$lang['Admin'] = 'Administratie';
$lang['Not_admin'] = 'Je bent niet bevoegd om dit board te beheren!';
$lang['Welcome_phpBB'] = 'Welkom bij phpBB';
$lang['Admin_intro'] = 'Bedankt dat je phpBB gekozen hebt als je forum software. Dit scherm geeft je een kort overzicht van de verschillende statistieken van je board. Je kan op deze pagina terug komen door te klikken op de <u>Beheerder Index</u> link in het linker vlak. Om terug te gaan naar de index van je board, kun je op het phpBB logo klikken dat ook in het linker vlak staat. Met de andere links aan de linkerkant van dit scherm kun je elk aspect van je forum beheren, elk scherm geeft uitleg over het gebruik van de tools.';
$lang['Main_index'] = 'Forum index';
$lang['Forum_stats'] = 'Forum statistieken';
$lang['Preview_forum'] = 'Vooruitblik forum';
/*****[BEGIN]******************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/
$lang['Admin_Index'] = 'Admin [Forums]';
$lang['Admin_Nuke'] = 'Admin [Nuke-Evo]';
$lang['Home_Nuke'] = 'Startpagina [Nuke-Evo]';
/*****[END]********************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/

$lang['Click_return_admin_index'] = 'Klik %sHIER%s om terug te gaan naar de Admin index';

$lang['Statistic'] = 'Statistieken';
$lang['Value'] = 'Waarde';
$lang['Number_posts'] = 'Aantal posts';
$lang['Posts_per_day'] = 'Posts per dag';
$lang['Number_topics'] = 'Aantal onderwerpen';
$lang['Topics_per_day'] = 'Onderwerpen per dag';
$lang['Number_users'] = 'Aantal gebruikers';
$lang['Users_per_day'] = 'Gebruikers per dag';
$lang['Board_started'] = 'Board gestart';
$lang['Avatar_dir_size'] = 'Avatar directory formaat';
$lang['Database_size'] = 'Database formaat';
$lang['Gzip_compression'] ='Gzip compressie';
$lang['Not_available'] = 'Niet beschikbaar';

$lang['ON'] = 'Aan'; // Dit is voor GZip compressie
$lang['OFF'] = 'Uit';


//
// DB Utils
//
$lang['Database_Utilities'] = 'Database utilities';

$lang['Restore'] = 'Herstellen';
$lang['Backup'] = 'Backup';
$lang['Restore_explain'] = 'Dit herstelt alle phpBB tabellen volledig vanuit een opgeslagen bestand. Als je server het ondersteunt, kun je een met gzip gecomprimeerd tekst bestand uploaden, dit wordt automatisch uitgepakt. <b>WAARSCHUWING</B> Dit overschrijft alle bestaande data. De \'herstel\' actie kan geruime tijd in beslag nemen, ga niet van deze pagina weg voordat hij is afgerond.';
$lang['Backup_explain'] = 'Hier kun je alle aan phpBB gerelateerde data opslaan. Als je extra tabellen hebt aangemaakt in dezelfde database als phpBB, die je ook wilt opslaan, voer dan hun namen in, gescheiden door komma\'s, in het \'extra tabellen\' tekstvak hieronder. Als je server het ondersteunt, kun je het bestand eerst met gzip comprimeren voordat je hem download.';

$lang['Backup_options'] = 'Backup opties';
$lang['Start_backup'] = 'Start backup';
$lang['Full_backup'] = 'Volledige backup';
$lang['Structure_backup'] = 'Alleen struktuur backup';
$lang['Data_backup'] = 'Alleen data backup';
$lang['Additional_tables'] = 'Extra tabellen';
$lang['Gzip_compress'] = 'Gzip comprimeer bestand';
$lang['Select_file'] = 'Selecteer een bestand';
$lang['Start_Restore'] = 'Start herstellen';

$lang['Restore_success'] = 'De Database is succesvol hersteld.<br /><br />Je board zou terug moeten zijn in dezelfde staat als op het moment dat je de backup maakte.';
$lang['Backup_download'] = 'Je download begint over enkele ogenblikken, wacht totdat hij gestart is AUB.';
$lang['Backups_not_supported'] = 'Sorry, maar database backups worden momenteel niet ondersteund voor jouw database systeem';

$lang['Restore_Error_uploading'] = 'Fout in het uploaden van het backup bestand';
$lang['Restore_Error_filename'] = 'Probleem met de bestandsnaam, probeer een ander bestand';
$lang['Restore_Error_decompress'] = 'Kan geen gzip bestand decomprimeren, upload een eenvoudige tekst versie';
$lang['Restore_Error_no_file'] = 'Er is geen bestand ge-upload';


//
// Auth pages
//
$lang['Select_a_User'] = 'Selecteer een gebruiker';
$lang['Select_a_Group'] = 'Selecteer een groep';
$lang['Select_a_Forum'] = 'Selecteer een forum';
$lang['Auth_Control_User'] = 'Gebruikers toelatings beheer';
$lang['Auth_Control_Group'] = 'Groeps toelatings beheer';
$lang['Auth_Control_Forum'] = 'Forum toelatings beheer';
$lang['Look_up_User'] = 'Zoek een gebruiker';
$lang['Look_up_Group'] = 'Zoek een groep';
$lang['Look_up_Forum'] = 'Zoek een forum';

$lang['Group_auth_explain'] = 'Hier kun je de toelatingen en moderator status veranderen die zijn toegewezen aan elke gebruikersgroep. Vergeet niet dat, wanneer je groeps toelatingen verandert, individuele gebruikers toelatingen nog steeds toegang kunnen geven tot forums e.d. Je krijgt een waarschuwing wanneer dit het geval is.';
$lang['User_auth_explain'] = 'Hier kun je de toelatingen en moderator status veranderen die zijn toegewezen aan elke individuele gebruiker. Vergeet niet dat, wanneer je gebruikers toelatingen verandert, groeps toelatingen de gebruiker nog steeds toegang kunnen geven tot forums e.d. Je krijgt een waarschuwing wanneer dit het geval is.';
$lang['Forum_auth_explain'] = 'Hier kun je het authorisatie niveau van elk forum aanpassen. Je hebt hiervoor een simpele en een uitgebreide methode, waarbij de uitgebreide methode je meer invloed geeft op elke forum actie. Denk eraan dat wanneer je het toelatings niveau van forums aanpast, dit invloed heeft op welke gebruikers bepaalde acties daarbinnen kunnen uitvoeren.';

$lang['Simple_mode'] = 'Eenvoudige mode';
$lang['Advanced_mode'] = 'Uitgebreide Mode';
$lang['Moderator_status'] = 'Moderator status';

$lang['Allowed_Access'] = 'Geef toegang';
$lang['Disallowed_Access'] = 'Weiger toegang';
$lang['Is_Moderator'] = 'Is moderator';
$lang['Not_Moderator'] = 'Geen moderator';

$lang['Conflict_warning'] = 'Authorisatie conflict waarschuwing';
$lang['Conflict_access_userauth'] = 'Deze gebruiker heeft nog toegang tot dit forum via een groep waarvan hij/zij deel uit maakt. Je kunt de groeps toelatingen aanpassen om volledig te voorkomen dat hij/zij toegangs rechten heeft. De groeps toestemmingen (en de forums waarover het gaat) staan hieronder opgesomd.';
$lang['Conflict_mod_userauth'] = 'Deze gebruiker heeft nog moderator rechten op dit forum via een groep waarvan hij/zij deel uit maakt. Je kunt de groeps toelatingen aanpassen om volledig te voorkomen dat hij/zij moderator rechten heeft. De rechten (en de forums waarover het gaat) staan hieronder opgesomd.';

$lang['Conflict_access_groupauth'] = 'De volgende gebruiker (of gebruikers) heeft nog toegang tot dit forum via hun gebruikers toelatingen. Je kunt de gebruikers toelatingen aanpassen om volledig te voorkomen dat hij/zij toegangs rechten heeft. De gebruikers rechten (en de forums waarom het gaat) staan hieronder opgesomd.';
$lang['Conflict_mod_groupauth'] = 'De volgende gebruiker (of gebruikers) heeft nog moderator rechten op dit forum via hun gebruikers toelatingen. Je kunt de gebruikers toelatingen aanpassen om volledig te voorkomen dat hij/zij moderator rechten heeft. De gebruikers rechten (en de forums waarom het gaat) staan hieronder opgesomd.';

$lang['Public'] = 'Openbaar';
$lang['Private'] = 'Privé';
$lang['Registered'] = 'Geregistreerd';
$lang['Administrators'] = 'Administrateurs';
$lang['Hidden'] = 'Verborgen';

// These are displayed in the drop down boxes for advanced
// mode forum auth, probeer en hou ze kort!
$lang['Forum_ALL'] = 'ALL';
$lang['Forum_REG'] = 'REG';
$lang['Forum_PRIVATE'] = 'PRIVATE';
$lang['Forum_MOD'] = 'MOD';
$lang['Forum_ADMIN'] = 'ADMIN';

$lang['View'] = 'Bekijk';
$lang['Read'] = 'Lees';
$lang['Post'] = 'Verstuur';
$lang['Reply'] = 'Antwoord';
$lang['Edit'] = 'Bewerk';
$lang['Delete'] = 'Verwijder';
$lang['Sticky'] = 'Sticky';
$lang['Announce'] = 'Mededelingen';
$lang['Vote'] = 'Stem';
$lang['Pollcreate'] = 'Peiling aanmaken';

$lang['Permissions'] = 'Toelatingen';
$lang['Simple_Permission'] = 'Eenvoudige toelatingen';

$lang['User_Level'] = 'Gebruikers niveau';
$lang['Auth_User'] = 'Gebruiker';
$lang['Auth_Admin'] = 'Beheerder';
$lang['Group_memberships'] = 'Gebruikersgroep lidmaatschap';
$lang['Usergroup_members'] = 'Deze groep heeft de volgende leden';

$lang['Forum_auth_updated'] = 'Forum toelatingen ge-update';
$lang['User_auth_updated'] = 'Gebruikers toelatingen ge-update';
$lang['Group_auth_updated'] = 'Groeps toelatingen ge-update';

$lang['Auth_updated'] = 'Toelatingen zijn ge-update';
$lang['Click_return_userauth'] = 'Klik %sHIER%s om terug te gaan naar gebruikers toelatingen';
$lang['Click_return_groupauth'] = 'Klik %sHIER%s om terug te gaan naar groeps toelatingen';
$lang['Click_return_forumauth'] = 'Klik %sHIER%s om terug te gaan naar forum toelatingen';


//
// Banning
//

$lang['Ban_control'] = 'Ban beheer';
$lang['Ban_explain'] = 'Hier kun je het bannen van gebruikers beheren. je kunt dit bereiken door een specifieke gebruiker of een persoon of range van IP adressen of hostnamen te bannen. Deze methode zorgt ervoor dat de gebruiker niet eens de index pagina van je forum kan bereiken. Om te voorkomen dat de gebruiker zich onder een andere gebruikersnaam registreert kun je ook ge-bande email adressen specificeren. Denk eraan dat het bannen van alleen een email adres niet voorkomt dat een gebruiker in kan loggen en berichten kan plaatsen op je board. Daarvoor moet je een van de eerste twee methoden gebruiken.';
$lang['Ban_explain_warn'] = 'Denk eraan dat bij het invoeren van een IP-range alle adresssen tussen het begin en einde op de ban-lijst staan. Er wordt geprobeerd om het aantal adressen in de database te minimaliseren door, waar mogelijk, automatisch wildcards toe te passen. Als je echt een range in wilt voeren, probeer hem dan klein te houden. of beter nog, vermeld een specifiek adres.';

$lang['Select_username'] = 'Selecteer een gebruikersnaam';
$lang['Select_ip'] = 'Selecteer een IP-adres';
$lang['Select_email'] = 'Selecteer een email adres';

$lang['Ban_username'] = 'Ban één of meer specifieke gebruikers';
$lang['Ban_username_explain'] = 'Je kunt meerdere gebruikers in een keer bannen door de juiste combinatie van muis en toetsenbord voor jouw computer en browser';

$lang['Ban_IP'] = 'Ban één of meer IP adressen of hostnamen';
$lang['IP_hostname'] = 'IP adressen of hostnamen';
$lang['Ban_IP_explain'] = 'Om meerdere IP\'s of hostnamen in te voeren dien je ze te scheiden met komma\'s. Om een IP-range in te voeren zet je een hyphen (-) tussen het begin en het eind. Om een wildcard aan te geven gebruik je *';

$lang['Ban_email'] = 'Ban één of meer email adressen';
$lang['Ban_email_explain'] = 'Om meerdere email adressen in te voeren dien je ze te scheiden met komma\'s. Om een wildcard aan te geven gebruik je *, bijvoorbeeld *@hotmail.com';

$lang['Unban_username'] = 'Un-ban één of meer specifieke gebruikers';
$lang['Unban_username_explain'] = 'Je kunt meerdere gebruikers in een keer un-bannen door de juiste combinatie van muis en toetsenbord voor jouw computer en browser';

$lang['Unban_IP'] = 'Un-ban één of meer IP adressen';
$lang['Unban_IP_explain'] = 'Je kunt meerdere IP adressen in een keer un-bannen door de juiste combinatie van muis en toetsenbord voor jouw computer en browser';

$lang['Unban_email'] = 'Un-ban een of meer email adressen';
$lang['Unban_email_explain'] = 'Je kunt meerdere email adressen in een keer un-bannen door de juiste combinatie van muis en toetsenbord voor jouw computer en browser';

$lang['No_banned_users'] = 'Geen ge-bande gebruikersnamen';
$lang['No_banned_ip'] = 'Geen ge-bande adressen';
$lang['No_banned_email'] = 'Geen ge-bande email adressen';

$lang['Ban_update_sucessful'] = 'De banlijst is succesvol ge-update';
$lang['Click_return_banadmin'] = 'Klik %sHIER%s om terug te gaan naar ban beheer';


//
// Configuration
//
$lang['General_Config'] = 'Algemene configuratie';
$lang['Config_explain'] = 'Met het formulier hieronder kun je alle algemene board opties aanpassen. Voor gebruikers en forum configuratie gebruik je de links aan de linkerkant.';

$lang['Click_return_config'] = 'Klik %sHIER%s om terug te gaan naar algemene configuratie';

$lang['General_settings'] = 'Algemene board instellingen';
$lang['Server_name'] = 'Domein naam';
$lang['Server_name_explain'] = 'Het domein naam van de server (b.v. www.phpbb.nl)';
$lang['Script_path'] = 'Script pad';
$lang['Script_path_explain'] = 'Het pad waar phpBB geinstalleerd is (b.v. /phpBB/)';
$lang['Server_port'] = 'Server poort';
$lang['Server_port_explain'] = 'De poort waarop de HTTP server draait, normaal 80.';
$lang['Site_name'] = 'Site naam';
$lang['Site_desc'] = 'Site omschrijving';
$lang['Board_disable'] = 'Board uitschakelen';
$lang['Board_disable_explain'] = 'Dit maakt het board onbereikbaar voor gebruikers. Log niet uit wanneer je het board uitschakelt, je kunt namelijk niet meer inloggen!';
/*****[BEGIN]******************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
$lang['Board_disable_msg'] = 'Uitgezet board bericht';
$lang['Board_disable_msg_explain'] = 'Deze tekst zal worden gezien als "Board uitschakelen" staat op "Ja".';
/*****[END]********************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
$lang['Acct_activation'] = 'Account activering aanzetten';
$lang['Acc_None'] = 'Geen'; // These three entries are the type of activation
$lang['Acc_User'] = 'Gebruiker';
$lang['Acc_Admin'] = 'Beheerder';

$lang['Abilities_settings'] = 'Gebruikers en forum basis instellingen';
$lang['Max_poll_options'] = 'Max aantal peiling opties';
$lang['Flood_Interval'] = 'Overloop interval';
$lang['Flood_Interval_explain'] = 'Aantal seconden die een gebruiker moet wachten tussen twee posts';
$lang['Board_email_form'] = 'Gebruiker email via board';
$lang['Board_email_form_explain'] = 'Gebruikers sturen elkaar email via dit board';
$lang['Topics_per_page'] = 'Onderwerpen per pagina';
$lang['Posts_per_page'] = 'Posts per pagina';
$lang['Hot_threshold'] = 'Posts voor populair drempel';
$lang['Default_style'] = 'Standaard stijl';
$lang['Override_style'] = 'Negeer gebruiker stijl';
$lang['Override_style_explain'] = 'Vervang gebruiker stijl door de standaard';
$lang['Default_language'] = 'Standaard taal';
$lang['Date_format'] = 'Datum formaat';
$lang['System_timezone'] = 'Tijdzone van het systeem';
$lang['Enable_gzip'] = 'GZip compressie aanzetten';
$lang['Enable_prune'] = 'Aanzetten forum pruning';
$lang['Allow_HTML'] = 'HTML toestaan';
$lang['Allow_BBCode'] = 'BBCode toestaan';
$lang['Allowed_tags'] = 'Toegestane HTML tags';
$lang['Allowed_tags_explain'] = 'Tags scheiden met komma\'s';
$lang['Allow_smilies'] = 'Smilies toestaan';
$lang['Smilies_path'] = 'Smilies opslag map';
$lang['Smilies_path_explain'] = 'Map onder je phpBB root dir, bijv. images/smilies';
$lang['Allow_sig'] = 'Handtekening toestaan';
$lang['Max_sig_length'] = 'Maximum handtekening lengte';
$lang['Max_sig_length_explain'] = 'Maximum aantal karakters in gebruikers handtekening';
$lang['Allow_name_change'] = 'Gebruikersnaam veranderen toestaan';

$lang['Avatar_settings'] = 'Avatar instellingen';
$lang['Allow_local'] = 'Gallerij avatars toestaan';
$lang['Allow_remote'] = 'Remote avatars toestaan';
$lang['Allow_remote_explain'] = 'Avatars waarnaar gelinked wordt vanaf een andere website';
$lang['Allow_upload'] = 'Avatar uploading toestaan';
$lang['Max_filesize'] = 'Maximale avatar bestands grootte';
$lang['Max_filesize_explain'] = 'Voor ge-uploade avatar bestanden';
$lang['Max_avatar_size'] = 'Maximale avatar afmetingen';
$lang['Max_avatar_size_explain'] = '(Hoogte x breedte in pixels)';
$lang['Avatar_storage_path'] = 'Avatar opslag map';
$lang['Avatar_storage_path_explain'] = 'Map onder phpBB root dir, bijv. images/avatars';
$lang['Avatar_gallery_path'] = 'Avatar gallerij map';
$lang['Avatar_gallery_path_explain'] = 'Map onder phpBB root dir voor-geladen afbeeldingen, bijv. images/avatars/gallerij';

$lang['COPPA_settings'] = 'COPPA instellingen';
$lang['COPPA_fax'] = 'COPPA fax nummer';
$lang['COPPA_mail'] = 'COPPA mail addres';
$lang['COPPA_mail_explain'] = 'Dit is het mail adres waar ouders COPPA registratie formulieren naar toe sturen';

$lang['Email_settings'] = 'Email instellingen';
$lang['Admin_email'] = 'Admin email adres';
$lang['Email_sig'] = 'Email handtekening';
$lang['Email_sig_explain'] = 'Deze tekst wordt toegevoegd aan alle emails die het board verstuurt';
$lang['Use_SMTP'] = 'Gebruik SMTP Server voor email';
$lang['Use_SMTP_explain'] = 'Vul \'ja\' in als de email via een benoemde server wilt of moet versturen in plaats van de \'local mail\' functie';
$lang['SMTP_server'] = 'SMTP server adres';
$lang['SMTP_username'] = 'SMTP gebruikersnaam';
$lang['SMTP_username_explain'] = 'Vul alleen een gebruikersnaam in als dit nodig is';
$lang['SMTP_password'] = 'SMTP Wachtwoord';
$lang['SMTP_password_explain'] = 'Vul alleen een wachtwoord in als dit nodig is';

$lang['Disable_privmsg'] = 'Privé berichten';
$lang['Inbox_limits'] = 'Max posts in inbox';
$lang['Sentbox_limits'] = 'Max posts in verstuurdbox';
$lang['Savebox_limits'] = 'Max posts in bewaarbox';

$lang['Cookie_settings'] = 'Cookie instellingen';
$lang['Cookie_settings_explain'] = 'Deze bepalen hoe een cookie, die aan een browser gestuurd wordt, is gedefinieerd. In de meeste gevallen voldoen de standaard instellingen. Als je ze toch moet aanpassen let dan goed op, door foute instellingen kunnen gebruikers mogelijk niet meer inloggen.';
$lang['Cookie_domain'] = 'Cookie domein';
$lang['Cookie_name'] = 'Cookie naam';
$lang['Cookie_path'] = 'Cookie pad';
$lang['Cookie_secure'] = 'Cookie secure [ https ]';
$lang['Cookie_secure_explain'] = 'Zet deze optie alleen aan als je server gebruik maakt van SSL, zet dit dan aan, laat het anders uit';
$lang['Session_length'] = 'Sessie lengte [ seconds ]';

// Visual Confirmation
$lang['Visual_confirm'] = 'Visuele bevestiging toestaan';
$lang['Visual_confirm_explain'] = 'Gebruikers moeten een code gebruiken, gedefinieerd in een tekening, bij registratie.';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Laat automatisch inloggen toe';
$lang['Allow_autologin_explain'] = 'Bepaalt of gebruikers wordt toegestaan te kiezen voor automatisch inloggen bij het bezoeken van het forum';
$lang['Autologin_time'] = 'Automatisch login key verloopt';
$lang['Autologin_time_explain'] = 'Hoe lang een autologin key geldig is in dagen dat een gebruiker niet het board bezoekt. Stel in op nul om verloopt uit te zetten.';
$lang['Stylesheet_explain'] = 'Filenaam voor CSS stylesheet om te gebruiken voor dit thema.';

//
// Forum Management
//
$lang['Forum_admin'] = 'Forum beheer';
$lang['Forum_admin_explain'] = 'Vanaf dit paneel kan je categorieën en forums toevoegen, verwijderen, reorganiseren en opnieuw synchroniseren';
$lang['Edit_forum'] = 'Bewerk forum';
$lang['Create_forum'] = 'Maak een nieuw forum aan';
$lang['Create_category'] = 'Maak een nieuwe categorie aan';
$lang['Remove'] = 'Verwijder';
$lang['Action'] = 'Actie';
$lang['Update_order'] = 'Volgorde updaten';
$lang['Config_updated'] = 'Forum configuratie succesvol ge-update';
$lang['Edit'] = 'Bewerk';
$lang['Delete'] = 'Verwijder';
$lang['Move_up'] = 'Schuif omhoog';
$lang['Move_down'] = 'Schuif omhoog';
$lang['Resync'] = 'Resync';
$lang['No_mode'] = 'Geen mode was gezet';
$lang['Forum_edit_delete_explain'] = 'Met het formulier hieronder kun je alle algemene boardopties aanpassen. Voor gebruikers en forum configuraties kun je de links aan de linkerkant gebruiken';

$lang['Move_contents'] = 'Verplaats alle inhoud';
$lang['Forum_delete'] = 'Verwijder forum';
$lang['Forum_delete_explain'] = 'Met het formulier hieronder kun je een forum (of categorie) verwijderen en bepalen waarheen je alle onderwerpen (of forums) wilt verplaatsen.';

$lang['Status_locked'] = 'Vergrendelen';
$lang['Status_unlocked'] = 'Ontgrendelen';
$lang['Forum_settings'] = 'Algemene forum instellingen';
$lang['Forum_name'] = 'Forum naam';
$lang['Forum_desc'] = 'Omschrijving';
$lang['Forum_status'] = 'Forum status';
$lang['Forum_pruning'] = 'Auto-snoeien';

$lang['prune_freq'] = 'Controleer de leeftijd van een onderwerp elke';
$lang['prune_days'] = 'Verwijder onderwerp waarin niets gepost is in';
$lang['Set_prune_data'] = 'Je hebt auto-snoeien aangezet voor dit forum, maar hebt geen frequentie of aantal dagen aan gegeven. ga alstublieft terug en doe dit alsnog';

$lang['Move_and_Delete'] = 'Verplaats en verwijder';

$lang['Delete_all_posts'] = 'Verwijder alle posts';
$lang['Nowhere_to_move'] = 'Geen plek om naartoe te verplaatsen';

$lang['Edit_Category'] = 'Bewerk categorie';
$lang['Edit_Category_explain'] = 'Gebruik dit formulier om de naam van een categorie aan te passen.';

$lang['Forums_updated'] = 'Forum en categorie informatie succesvol ge-update';

$lang['Must_delete_forums'] = 'Je moet alle forums verwijderen voordat je deze categorie kunt verwijderen';

$lang['Click_return_forumadmin'] = 'Klik %sHIER%s om terug te gaan naar forum beheer';


//
// Smiley Management
//
$lang['smiley_title'] = 'Smilies bewerken';
$lang['smile_desc'] = 'Vanaf deze pagina kun je de emoticons of smileys, die gebruikers in hun posts of privé berichten kunnen gebruiken, toevoegen, verwijderen en bewerken.';

$lang['smiley_config'] = 'Smiley configuratie';
$lang['smiley_code'] = 'Smiley code';
$lang['smiley_url'] = 'Smiley grafisch bestand';
$lang['smiley_emot'] = 'Smiley emotie';
$lang['smile_add'] = 'Voeg een nieuwe smiley toe';
$lang['Smile'] = 'Smile';
$lang['Emotion'] = 'Emotie';

$lang['Select_pak'] = 'Selecteer pak (.pak) bestand';
$lang['replace_existing'] = 'Vervang bestaande smiley';
$lang['keep_existing'] = 'Houd bestaande smiley';
$lang['smiley_import_inst'] = 'Je moet het smiley pakket unzippen en alle bestanden uploaden naar de juiste smiley directory voor jouw installatie. Selecteer vervolgens de juiste informatie in dit formulier om het smiley pack te importeren.';
$lang['smiley_import'] = 'Smiley pack importeren';
$lang['choose_smile_pak'] = 'Kies een smile pack .pak bestand';
$lang['import'] = 'Importeer smileys';
$lang['smile_conflicts'] = ' Wat moet er gedaan worden in geval van een conflict';
$lang['del_existing_smileys'] = 'Verwijder bestaande smileys voor het importeren';
$lang['import_smile_pack'] = 'Importeer smiley pack';
$lang['export_smile_pack'] = 'Maak smiley pack aan';
$lang['export_smiles'] = 'Om een smiley pack aan te maken met je huidige geinstalleerde smileys, kun je %sHIER%s klikken om het smiles.pak bestand te downloaden. Hernoem het bestand naar een geschikte naam, maar houd de .pak extensie. Maak vervolgens een zip bestand aan met al je smiley plaatjes plus dit .pak configuratie bestand.';

$lang['smiley_add_success'] = 'De smiley is succesvol toegevoegd';
$lang['smiley_edit_success'] = 'De smiley is succesvol ge-update';
$lang['smiley_import_success'] = 'Het smiley pack is succesvol geimporteerd!';
$lang['smiley_del_success'] = 'De smiley is succesvol verwijderd';
$lang['Click_return_smileadmin'] = 'Klik %sHIER%s om terug te gaan naar smiley beheer';


//
// User Management
//
$lang['User_admin'] = 'Gebruikers beheer';
$lang['User_admin_explain'] = 'Hier kun je informatie en bepaalde specifieke opties van gebruikers aanpassen. Als je de gebruikers permissies wilt aanpassen dien je het gebruiker en groeps permissie systeem te gebruiken.';

$lang['Look_up_user'] = 'Zoek gebruiker';

$lang['Admin_user_fail'] = 'Gebruikers profiel kon niet ge-update worden.';
$lang['Admin_user_updated'] = 'Gebruikers profiel is succesvol ge-update';
$lang['Click_return_useradmin'] = 'Klik %sHIER%s om terug te gaan naar gebruikers beheer';

$lang['User_delete'] = 'Verwijder deze gebruiker.';
$lang['User_delete_explain'] = 'Klik hier om deze gebruiker te verwijderen, dit kan niet ongedaan worden gemaakt.';
$lang['User_deleted'] = 'Gebruiker is succesvol verwijderd.';

$lang['User_status'] = 'Gebruiker is actief';
$lang['User_allowpm'] = 'Kan privé berichten versturen';
$lang['User_allowavatar'] = 'Kan avatar weergeven';

$lang['Admin_avatar_explain'] = 'Hier kun je de huidige avatar van de gebruiker bekijken en verwijderen.';

$lang['User_special'] = 'Speciale admin-alleen velden';
$lang['User_special_explain'] = 'Deze velden kunnen niet worden aangepast door gebruikers. Hier kun je hun status instellen en andere opties die niet beschikbaar zijn voor gebruikers.';

//
// Group Management
//
$lang['Group_administration'] = 'Groeps beheer';
$lang['Group_admin_explain'] = 'Vanaf dit paneel kun je al je gebruikersgroepen beheren, je kunt: verwijderen aanmaken en bestaande groepen bewerken. je kunt moderators kiezen, groep open/gesloten status wijzigen en de groepsnaam en omschrijving opgeven';
$lang['Error_updating_groups'] = 'Er heeft zich een fout voorgedaan tijdens het updaten van de groepen';
$lang['Updated_group'] = 'De groep is succesvol ge-update';
$lang['Added_new_group'] = 'De nieuwe groep is succesvol aangemaakt';
$lang['Deleted_group'] = 'De groep is succesvol verwijderd';
$lang['New_group'] = 'Maak een nieuwe groep';
$lang['Edit_group'] = 'Bewerk groep';
$lang['group_name'] = 'Groep naam';
$lang['group_description'] = 'Groep omschrijving';
$lang['group_moderator'] = 'Groep moderator';
$lang['group_status'] = 'Groep status';
$lang['group_open'] = 'Open groep';
$lang['group_closed'] = 'Gesloten groep';
$lang['group_hidden'] = 'Verborgen group';
$lang['group_delete'] = 'Verwijder group';
$lang['group_delete_check'] = 'Deze groep verwijderen';
$lang['submit_group_changes'] = 'Wijzigingen bevestigen';
$lang['reset_group_changes'] = 'Herstel wijzigingen';
$lang['No_group_name'] = 'Je moet een naam opgeven voor deze groep';
$lang['No_group_moderator'] = 'Je moet een moderator aangeven voor deze groep';
$lang['No_group_mode'] = 'Je moet de staat van deze groep aangeven, open of gesloten';
$lang['No_group_action'] = 'Geen actie opgegeven';
$lang['delete_group_moderator'] = 'De oude groeps moderator verwijderen?';
$lang['delete_moderator_explain'] = 'Selecteer dit veld als je tijdens het wijzigen van een groepsmoderator wilt dat de oude moderator verwijderd wordt. Als je dit niet selecteert wordt de oude moderator gewon een lid van de groep.';
$lang['Click_return_groupsadmin'] = 'Klik %sHIER%s om terug te gaan naar groep beheer.';
$lang['Select_group'] = 'Selecteer een groep';
$lang['Look_up_group'] = 'Zoek een groep';


//
// Prune Administration
//
$lang['Forum_Prune'] = 'Forum Snoeien';
$lang['Forum_Prune_explain'] = 'Dit verwijdert elk onderwerp waarop geen post is geweest in het aantal dagen dat je aangeeft. Als je geen nummer invoert worden alle onderwerpen verwijderd. Dit verwijdert geen onderwerpen waarin nog peilingen lopen, ook verwijdert het geen mededelingen. Die onderwerpen dien je handmatig te verwijderen.';
$lang['Do_Prune'] = 'Doe snoeien';
$lang['All_Forums'] = 'Alle forums';
$lang['Prune_topics_not_posted'] = 'Snoei onderwerpen zonder antwoord in bepaald aantal dagen';
$lang['Topics_pruned'] = 'Onderwerpen gesnoeid';
$lang['Posts_pruned'] = 'Posts gesnoeid';
$lang['Prune_success'] = 'Snoeien van de forums is succesvol afgerond';


//
// Word censor
//
$lang['Words_title'] = 'Woord censurering';
$lang['Words_explain'] = 'Op dit paneel kun je woorden toevoegen, bewerken en verwijderen die automatisch op alle forums ge-censureerd worden. Bovendien kunnen gebruikers zich niet registreren met en gebruikersnaam waarin zo\'n woord voorkomt. Wildcards (*) worden geaccepteerd in het woord veld, bijv. *pik* komt overeen met Lopikkerwaard, pik* met pikant en *pik met hospik.';
$lang['Word'] = 'Woord';
$lang['Edit_word_censor'] = 'Bewerk censuur woord';
$lang['Replacement'] = 'Vervangen door';
$lang['Add_new_word'] = 'Nieuw woord toevoegen';
$lang['Update_word'] = 'Woord censuur updaten';

$lang['Must_enter_word'] = 'Je moet een woord en de vervanging daarvoor opgeven';
$lang['No_word_selected'] = 'Geen woord geselecteerd om te bewerken';

$lang['Word_updated'] = 'Het geselecteerde censuur woord is succesvol ge-update';
$lang['Word_added'] = 'Het censuur woord is succesvol toegevoegd';
$lang['Word_removed'] = 'Het geselecteerde censuur woord is succesvol verwijderd';

$lang['Click_return_wordadmin'] = 'Klik %sHIER%s om terug te gaan naar censuur Woorden beheer';


//
// Mass Email
//
$lang['Mass_email_explain'] = 'Hier kun je email sturen aan al je gebruikers, of aan gebruikers uit een specifieke groep. Hiervoor wordt een email verstuurd aan het beheerders email adres dat opgegeven is, met een \'blind carbon copy\' aan alle ontvangers. Als je een grote groep wilt mailen, wees dan geduldig na het verzenden en stop de pagina niet halverwege. Het is normaal dat Massa email geruime tijd in beslag neemt, je krijgt een melding wanneer het script is afgerond.';
$lang['Compose'] = 'Opstellen';

$lang['Recipients'] = 'Ontvangers';
$lang['All_users'] = 'Alle gebruikers';

$lang['Email_successfull'] = 'Je bericht is verzonden';
$lang['Click_return_massemail'] = 'Klik %sHIER%s om terug te gaan naar het Massa email formulier';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Rangen beheer';
$lang['Ranks_explain'] = 'Met dit formulier kun je rangen toevoegen, bewerken, bekijken en verwijderen. Je kunt ook aangepaste rangen aanmaken die toegepast kunnen worden via de gebruikers beheer faciliteit';

$lang['Add_new_rank'] = 'Nieuwe rang toevoegen';

$lang['Rank_title'] = 'Rang titel';
$lang['Rank_special'] = 'Als speciale rang instellen';
$lang['Rank_minimum'] = 'Minimum posts';
$lang['Rank_maximum'] = 'Maximum posts';
$lang['Rank_image'] = 'Rang afbeelding (Relatief naar phpBB2 root pad)';
$lang['Rank_image_explain'] = 'Gebruik dit om een klein plaatje aan een rang te verbinden';

$lang['Must_select_rank'] = 'Je moet een rang selecteren';
$lang['No_assigned_rank'] = 'Geen speciale rang toegewezen';

$lang['Rank_updated'] = 'De rang is succesvol ge-update';
$lang['Rank_added'] = 'De rang is succesvol toegevoegd';
$lang['Rank_removed'] = 'De rang is succesvol verwijderd';
$lang['No_update_ranks'] = 'De rang is succesvol verwijderd, maar de gebruikers die deze rang gebruikten zijn niet aangepast. Je zal dit handmatig moeten veranderen.';

$lang['Click_return_rankadmin'] = 'Klik %sHIER%s om terug te gaan naar rang beheer';


//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Geweigerde gebruikersnaam beheer';
$lang['Disallow_explain'] = 'Hier kun je bepalen welke gebruikersnamen niet gebruikt mogen worden. Geweigerde gebruikersnamen mogen het wildcard karakter * bevatten. Denk eraan dat je geen gebruikersnaam kunt specficeren die al geregistreerd is, je moet die eerst verwijderen en dan weigeren';

$lang['Delete_disallow'] = 'Verwijderen';
$lang['Delete_disallow_title'] = 'Verwijder een geweigerde gebruikersnaam';
$lang['Delete_disallow_explain'] = 'Je kunt een geweigerde gebruikersnaam verwijderen door de naam in deze lijst te selecteren en op bevestigen te klikken';

$lang['Add_disallow'] = 'Toevoegen';
$lang['Add_disallow_title'] = 'Voeg een geweigerde gebruikersnaam toe';
$lang['Add_disallow_explain'] = 'Je kunt een gebruikersnaam weigeren door gebruik te maken van het wildcard karakter * om een willekeurig ander karakter te vervangen';

$lang['No_disallowed'] = 'Geen geweigerde gebruikersnamen';

$lang['Disallowed_deleted'] = 'De geweigerde gebruikersnaam is succesvol verwijderd';
$lang['Disallow_successful'] = 'De geweigerde gebruikersnaam is succesvol toegevoegd';
$lang['Disallowed_already'] = 'De naam die je ingevoerd hebt kon niet worden toegevoegd aan de lijst. Hij staat er al in of er is een bestaande gebruikersnaam aanwezig';

$lang['Click_return_disallowadmin'] = 'Klik %sHIER%s om terug te gaan naar geweigerde gebruikersnaam beheer';

$lang['Install'] = 'Installeer';
$lang['Upgrade'] = 'Upgrade';

$lang['Install_No_PCRE'] = 'phpBB2 heeft de Perl-Compatible Regular Expressions Module voor PHP nodig. Deze is niet actief in je PHP installatie.';

$lang['theme'] = 'Thema';


/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$lang['wrap_title'] = 'Forceer Word Wrapping';
$lang['wrap_enable'] = 'Forceer Word Wrapping';
$lang['wrap_min'] = 'Minimum Scherm Breedte';
$lang['wrap_max'] = 'Maximum Scherm Breedte';
$lang['wrap_def'] = 'Standaard Scherm Breedte';
$lang['wrap_units'] = 'karakters';
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/

//
// Version Check
//
$lang['Version_up_to_date'] = 'Je installatie is up to date, er zijn geen updates beschikbaar voor jouw versie van phpBB.';
$lang['Version_not_up_to_date'] = 'Je installatie schijnt <b>niet</b> up to date te zijn. Updates zijn beschikbaar voor jouw versie van phpBB.';
$lang['Latest_version_info'] = 'De laatst beschikbare versie is <b>phpBB %s</b>. ';
$lang['Current_version_info'] = 'Je draait nu <b>phpBB %s</b>.';
$lang['Connect_socket_error'] = 'Kan geen verbinding openen met de phpBB Server, gemelde fout is:<br />%s';
$lang['Socket_functions_disabled'] = 'Kan niet de socket functies gebruiken.';
$lang['Mailing_list_subscribe_reminder'] = 'Voor de laatste informatie over updates van phpBB, waarom niet <a href="http://www.phpbb.com/support/" target="_new">inschrijven bij onze mailing lijst</a>.';
$lang['Version_information'] = 'Versie Informatie';

/*****[BEGIN]******************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
$lang['Board_statistic'] = 'Board statistieken';
$lang['Database_statistic'] = 'Database statistieken';
$lang['Version_info'] = 'Versie informatie';
$lang['Thereof_deactivated_users'] = 'Aantal niet aktieve leden';
$lang['Thereof_Moderators'] = 'Aantal Moderators';
$lang['Thereof_Administrators'] = 'Aantal Beheerders';
$lang['Deactivated_Users'] = 'Leden die geactiveerd moeten worden';
$lang['Users_with_Admin_Privileges'] = 'Leden met beheer privileges';
$lang['Users_with_Mod_Privileges'] = 'Leden met moderator privileges';
$lang['DB_size'] = 'Grootte van de database';
$lang['Version_of_board'] = 'Versie van <a href="http://www.phpbb.com">phpbb</a>';
$lang['Version_of_PHP'] = 'Versie van <a href="http://www.php.net/">PHP</a>';
$lang['Version_of_MySQL'] = 'Versie van <a href="http://www.mysql.com/">MySQL</a>';
/*****[END]********************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$lang['SQR_settings'] = 'SQR Instellingen';
$lang['Allow_quick_reply'] = 'Snel Antwoord Toestaan';
$lang['Anonymous_show_SQR'] = 'Snel Antwoord formulier laten zien aan Anonieme Gebruikers';
$lang['Anonymous_SQR_mode'] = 'Anonieme Gebruikers Snel Antwoord Mode';
$lang['Anonymous_open_SQR'] = 'Open Snel Antwoord Formulier voor Anonieme Gebruikers automatisch';
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

/*****************************************************/
/* Forum - Admin Userlist                     v2.0.2 */
/*****************************************************/
$lang['Userlist'] = 'Gebruikerslijst';
$lang['Userlist_description'] = 'Bekijk een complete gebruikerslijst en doe verschillende acties hierop';

$lang['Add_group'] = 'Voeg in een groep';
$lang['Add_group_explain'] = 'Selecteer aan welke groep de geselecteerde gebruikers moeten toegevoegd worden';

$lang['Open_close'] = 'Openen/Sluiten';
$lang['Active'] = 'Actief';
$lang['Group'] = 'Groep(en)';
$lang['Rank'] = 'Rang';
$lang['Last_activity'] = 'Laatste aktiviteit';
$lang['Never'] = 'Nooit';
$lang['User_manage'] = 'Beheren';
$lang['Find_all_posts'] = 'Zoek alle berichten';

$lang['Select_one'] = 'Selecteer één';
$lang['Ban'] = 'Ban';
$lang['Activate_deactivate'] = 'Activeren/De-activeren';

$lang['User_id'] = 'Gebruiker id';
$lang['User_level'] = 'Gebruiker Niveau';
$lang['Ascending'] = 'Stijgend';
$lang['Descending'] = 'Dalend';
$lang['Show'] = 'Laat zien';
$lang['All'] = 'Alles';

$lang['Member'] = 'Lid';
$lang['Pending'] = 'Hangende';

$lang['Confirm_user_ban'] = 'Ben je zeker dat je de geselecteerde gebruiker(s) wil bannen?';
$lang['Confirm_user_deleted'] = 'Ben je zeker dat je de geselecteerde gebruiker(s) wil verwijderen?';

$lang['User_status_updated'] = 'Gebruiker(s) status successvol ge-updated!';
$lang['User_banned_successfully'] = 'Gebruiker(s) successvol gebanned!';
$lang['User_deleted_successfully'] = 'Gebruiker(s) successvol verwijdert!';
$lang['User_add_group_successfully'] = 'Gebruiker(s) successvol toegevoegd aan groep!';
$lang['Cancel'] = 'Afbreken';
$lang['Click_return_userlist'] = 'Klik %sHIER%s om terug te keren naar gebruikerslijst';
/*****************************************************/
/* Forum - Admin Userlist                      v2.0.2*/
/*****************************************************/

/*****************************************************/
/* Forum - Global Announce                    v1.2.8 */
/*****************************************************/
$lang['Globalannounce'] ='Algemene mededelingen'; 
/*****************************************************/
/* Forum - Global Announce                    v1.2.8 */
/*****************************************************/

/*****************************************************/
/* Forum - PM Quick Reply                    v1.3.5  */
/*****************************************************/
$lang['ropm_quick_reply'] = 'PM snel antwoord';
$lang['enable_ropm_quick_reply'] = "Laat PM snel antwoord toe";
$lang['ropm_quick_reply_bbc'] = "Laat BBCode-toetsen toe";
$lang['ropm_quick_reply_smilies'] = "Aantal smilies";
$lang['ropm_quick_reply_smilies_info'] = "Je moet hier 0 invoeren, als je geen smilies wilt zichtbaar maken.";
/*****************************************************/
/* Forum - PM Quick Reply                     v1.3.5 */
/*****************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
$lang['Must_select_search'] = 'Je moet een snel zoeken kiezen';
$lang['Search_title'] = 'Snel Zoeken Beheer';
$lang['Search_explain'] = 'Gebruikmakend van dit instrument, kan je toevoegen, aanpassen, en zoek tools kiezen om toe te voegen bij de snel zoeken.';
$lang['Search_name'] = 'Zoek Naam';
$lang['Search_name_explain'] = 'De naam die gezien moet worden in de drop down lijst. Voorbeelden: <b>Yahoo / Google</b>';
$lang['Search_url'] = 'Zoek URL';
$lang['Search_url_explain'] = 'De URL benodigd voor zoeken om mee te werken. Voorbeelden:<br /><span style="color:red">Notitie: Als de zoek machine een extra string nodig heeft <b>NA</b> een</span> <b>Keyword</b><span style="color:red">, plaats de extra string in de volgende box! Je hoeft natuurlijk niet het woord </span> <b>Keyword</b> <span style="color:red">toe te voegen, laat het gewoon leeg.</span><br /><br />- <span style="color:blue">http://search.yahoo.com/search?ei=UTF-8&fr=sfp&p=</span><b>Keyword</b><br />- <span style="color:blue">http://www.google.com/search?hl=en&ie=UTF-8&oe=UTF-8&q=</span><b>Keyword</b><br />- <span style="color:blue">http://www.alltheweb.com/search?cat=web&cs=utf8&q=</span><b>Keyword</b><span style="color:blue">&rys=0&itag=crv&_sb_lang=pref</span><br />';
$lang['Must_enter_search_name'] = 'Je moet de zoek naam invoeren';
$lang['Search_updated'] = 'Zoeken is met succes ge-update';
$lang['Search_added'] = 'Zoeken is met succes toegevoegd';
$lang['Click_return_addsearchadmin'] = 'Klik %sHIER%s om terug te keren naar het Toevoegen Zoek Beheer Menu';
// a href, /a tags
$lang['Search_removed'] = 'Zoeken is met succes verwijderd';
$lang['Add_new_search'] = 'Een nieuwe zoeken toevoegen';
// Quick Search Enable Setting for Board Configuration Panel
$lang['Quick_search_enable'] = 'Snel Zoeken Aanzetten';
$lang['Quick_search_enable_explain'] = 'Laat het Snel Zoeken veld zien in de algehele kop zien.';
/*****[END]********************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/

/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1        */
/*****************************************************/
$lang['sig_title']   = 'Uitgebreide handtekening controle';
$lang['sig_divider'] = 'Huidige handtekening verdeler';
$lang['sig_explain'] = "Dit is waar je controleert wat de handtekening van de post scheidt";
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1        */
/*****************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/
$lang['Default_avatar'] = 'Stel standaard avatar in';
$lang['Default_avatar_explain'] = 'Dit geeft gebruikers die nog geen avatar hebben gekozen, de standaard avatar. Stel de standaard avatar in voor gasten en gebruikers, en kies dan of je de avatar wilt laten zien voor gebruikers, gasten, of allebij of geen avatar.<br />Het pad is \'modules/Forums/avatars/gallery\'';
$lang['Default_avatar_guests'] = 'Gasten';
$lang['Default_avatar_users'] = 'Gebruikers';
$lang['Default_avatar_both'] = 'Beide';
$lang['Default_avatar_none'] = 'Geen';
/*****[END]********************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
$lang['Board_disable_adminview'] = 'Beheerders toegang wanneer board uitstaat';
$lang['Board_disable_adminview_explain'] = 'Dit staat Beheerders toe op het gehele board te komen wanneer deze uit staat.';
/*****[END]********************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/
$lang['URL_server_error'] = 'De URL die je invoerd (%s) komt niet overeen met de URL die de server rapporteert (%s)';
$lang['URL_error_confirm'] = 'Wil je deze instelling behouden?';
/*****[END]********************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/
$lang['pm_allow_threshold'] = 'Sta PM drempel toe';
$lang['pm_allow_threshold_explain'] = 'Stel hier het minimale aantal in van posts die de gebruiker moet plaatsen voordat ze de privé berichten kunnen gebruiken.';
/*****[END]********************************************
 [ Mod:     PM threshold                       v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
$lang['Max_smilies'] = 'Maximum smilies limiet per post';
/*****[END]********************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  Cookie Check                        v1.0.0 ]
 ******************************************************/
$lang['Cookie_server_error'] = 'Het Cookie Domein die je invoerd (%s) komt niet overeen met de URL die de server rapporteerd (%s)';
$lang['Cookie_error_confirm'] = 'Wil je deze instelling bewaren?';
$lang['Cookie_name_error'] = 'De Cookie Naam die je invoerd (%s) is een standaard cookie naam en kan problemen veroorzaken. <br/> Een aanbevolen naam kan zijn %s';
/*****[END]********************************************
 [ Other:  Cookie Check                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
$lang['File_not_deleted'] = 'Je hebt nog niet de file install_tables.php verwijderd: doe het voordat je probeert deze pagina te zien.';
$lang['Log_action_title'] = 'Logs Acties';
$lang['Log_action_explain'] = 'Hier kan je jouw moderators/beheerders acties zien';
$lang['Choose_sort_method'] = 'Kies sorteer methode';
$lang['Order'] = 'Volgorde';
$lang['Go'] = 'Doe';
$lang['Id_log'] = 'Log Id';
$lang['Choose_log'] = 'Kies Log';
$lang['Delete'] = 'Verwijder';
$lang['Action'] = 'Actie';
$lang['Topic'] = 'Onderwerp';
$lang['Done_by'] = 'Gedaan Door';
$lang['User_ip'] = 'Gebruiker IP';
$lang['Select_all'] = 'Kies Alles';
$lang['Unselect_all'] = 'Niet Alles Kiezen';
$lang['Date'] = 'Datum';
$lang['See_topic'] = 'Bekijk de post';
$lang['Log_delete'] = 'Log met succes verwijderd.';
$lang['Click_return_admin_log'] = 'Klik %sHIER%s om terug te gaan naar de Log Acties';
$lang['Log_Config_updated'] = 'Configuratie van Log Acties MOD met succes';
$lang['Click_return_admin_log_config'] = 'Klik %sHIER%s om terug te keren naar de Log Acties MOD Configuratie';
$lang['Log_Config'] = 'Configuratie van de Log';
$lang['Log_Config_explain'] = 'Hier, heb je de mogelijkheid om opties te configureren van de Log Acties MOD.';
$lang['General_Config_Log'] = 'Algemene Configuratie van de Log Acties MOD';
$lang['Allow_all_admin'] = 'Andere Admins toestaan om Log Acties te zien?';
$lang['Allow_all_admin_explain'] = 'Deze optie geef je de kans te kiezen of alleen de eerste admin van het board het Log kan zien';
$lang['Admin_not_authorized'] = 'Sorry, je hebt geen toestemming deze pagina te bekijken. Alleen de hoofd Admin heeft toestemming.';
$lang['Add_username_admin_explain'] = 'Kies de naam van een andere Admin die je toestaat om logged acties te bekijken';
$lang['Delete_username_admin_explain'] = 'Kies de naam van een andere Admin die je niet toestaat om de logged actions te bekijken';
$lang['No_other_admins'] = 'Geen andere Admins te kiezen';
$lang['No_admins_authorized'] = 'Geen andere Admins toegestaan';
$lang['Add_Admin_Username'] = 'Kies een gebruikersnaam om toe te voegen';
$lang['Delete_Admin_Username'] = 'Kies een gebruikersnaam om te verwijderen';
$lang['No_admins_allow'] = 'Er zijn geen admins om toe te staan de logs te bekijken';
$lang['No_admins_disallow'] = 'Er zijn geen admins om niet toe te staan de logs te bekijken';
$lang['Admins_add_success'] = 'Admin is met succes bij de lijst gevoegd';
$lang['Admins_del_success'] = 'Admin(s) zijn met succes verwijderd van de lijst';
$lang['Prune_success'] = 'Ruimen van de Logs met succes';
$lang['Prune_of_logs'] = 'Ruimen van de Logs';
$lang['Prune'] = 'Ruimen Logs';
$lang['Prune_!'] = 'Ruim op!';
$lang['Prune_explain'] = 'Voer het aantal dagen in dat je de logs wilt ruimen. 0 = al de logs';     /*****[END]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/
$lang['glance_title'] = 'At a Glance Opties';
$lang['glance_override_title'] = 'Negeer Gebruikers Instellingen';
$lang['glance_news_explain'] = 'Vooer het Forum ID in van jouw Nieuws Forum<br /><small>Stel in op 0 als je geen nieuws forum hebt of het nieuws niet wil laten zien. Scheid de Nieuws Forums met, (1,2,3).</small>';
$lang['glance_num_news_explain'] = 'Voer het getal van nieuws artikelen in die je wilt zien.<br /><small>Stel in op 0 ls je geen nieuws forum hebt of het nieuws niet wil laten zien.</small>';
$lang['glance_num_explain'] = 'Voer het aantal van recente onderwerpen in die je wilt laten zien';
$lang['glance_ignore_forums_explain'] = 'Voer het Forum ID in van Forums die je wilt negeren op de recente onderwerpen lijst.<br /><small>Scheid Forums met, (1,2,3). Laat leeg om alles te zien.</small>';
$lang['glance_table_width_explain'] = 'Voer de breedte in waarin je de Recente Blokken wilt laten zien. (Standaard : 100%)';
$lang['glance_auth_read_explain'] = 'Laat onderwerpen zien die de gebruiker kan lezen maar niet lezen?';
$lang['glance_topic_length_explain'] = 'Limiteer het aantal karakters gezien in de Onderwerp titel.<br /><small>Stel op 0 voor volledige titel.</small>';
/*****[END]********************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.6 ]
 ******************************************************/
$lang['Online_time'] = 'Online status tijd';
$lang['Online_time_explain'] = 'Getal van seconden dat een gebruiker online moet laten zien (gebruik geen lagere waarde dan 60).';
$lang['Online_setting'] = 'Online Status Instelling';
$lang['Online_color'] = 'Online tekst kleur';
$lang['Offline_color'] = 'Offline tekst kleur';
$lang['Hidden_color'] = 'Verborgen tekst kleur';
/*****[END]********************************************
 [ Mod:    Online/Offline/Hidden               v2.2.6 ]
 ******************************************************/

 /*****[BEGIN]******************************************
 [ Mod:   Show Users Today Toggle              v1.0.0 ]
 ******************************************************/
 $lang['show_users_today'] = "Laat gebruikers die vandaag waren ingelogd zien op de Forum Index";
/*****[END]********************************************
 [ Mod:   Show Users Today Toggle              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 ******************************************************/
$lang['group_color'] = "Kies de standaard kleur groep voor deze groep.";
$lang['group_rank'] = "Kies een standaard rang voor deze groep.";
/*****[BEGIN]******************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
$lang['topic_explain'] = 'Je kan elk soort van HTML gebruiken om dit te doen. Je kan een andere stijl kiezen voor elk onderwerp type';
$lang['locked'] = 'Gesloten Onderwerp';
$lang['sticky'] = 'Sticky';
$lang['global'] = 'Algemene Bekendmaking';
$lang['announce'] = 'Bekendmaking';
$lang['current'] = 'Huidige';
$lang['current_explain'] = 'Dit zijn je huidige instellingen voor dit onderwerp type. Dit is hoe het wordt getoond op het forum.';
$lang['tag'] = 'Verander het uiterlijk (Alstublieft gebruik geen quotes of slashes in je html. Bv: &lt;font color=#FFFFFF&gt;Titel&lt;/font&gt;)';
$lang['topic_title'] = 'Onderwerp Titel';
$lang['moved'] = "Verhuisd";
$lang['topic_view_settings'] = "Veranderde Onderwerp Uiterlijk";
/*****[END]********************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
$lang['Initial_user_group'] = 'Begin Gebruikers Groep';
$lang['Initial_user_group_explain'] = 'Stel het begin groep in van gebruikersgroep, waar gebruikers worden geplaatst bij inschrijven';
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
$lang['hide_images'] = "Verberg Plaatjes voor Bezoekers";
$lang['hide_links'] = "Verberg Links voor Bezoekers";
$lang['hide_emails'] = "Verberg Email links voor Bezoekers";
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Admin DHTML Menu                   v1.0.0 ]
 ******************************************************/
$lang['dhtml_menu'] = "Gebruik DHTML op Forum Configuratie.<br /><small>Zorgt ervoor dat configuratie tabellen inklappen</small>";
/*****[END]********************************************
 [ Mod:     Admin DHTML Menu                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
$lang['user_hide_images'] = 'Verberg Plaatjes in Forums';
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
$lang['smilies_in_titles'] = 'Laat Smilies in Onderwerp titels zien';
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
$lang['logs_view_level'][0] = 'Admins, Mods, Gebruikers, Anoniempjes';
$lang['logs_view_level'][1] = 'Admins, Mods, Gebruikers';
$lang['logs_view_level'][3] = 'Admins, Mods';
$lang['logs_view_level'][2] = 'Admins';
$lang['show_edited_logs'] = 'Laat Onderwerp Edit logs zien';
$lang['show_locked_logs'] = 'Laat Onderwerp Opslot logs zien';
$lang['show_unlocked_logs'] = 'Laat Onderwerp niet opslot logs zien';
$lang['show_moved_logs'] = 'Laat Onderwerp Verplaatst logs zien';
$lang['show_splitted_logs'] = 'Laat Onderwerp Gesplitst logs zien';
$lang['allow_logs_view'] = 'Laat logs zien aan';
/*****[END]********************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/
$lang['image_resize_width'] = 'Verander grootte Image Breedte';
$lang['image_resize_height'] = 'Verander grootte Image Hoogte';
/*****[END]********************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
$lang['admin_style'] = 'Gebruik je site thema\'s style voor forum admin';
/*****[END]********************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
$lang['ADMIN_IP_LOCK'] = 'Admin IP Lock';
$lang['ADMIN_IP_LOCK_OFF'] = 'Uitgezet';
$lang['ADMIN_IP_LOCK_ON'] = 'Aangezet';
/*****[END]********************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Display Poster Information Once    v2.0.0 ]
 ******************************************************/
$lang['once_settings'] = 'Toon eens per Post';
$lang['show_sig_once'] = 'Toon sig eens per post';
$lang['show_avatar_once'] = 'Toon avatar eens per post';
$lang['show_rank_once'] = 'Toon rang eens per post';
/*****[END]********************************************
 [ Mod:     Display Poster Information Once    v2.0.0 ]
 ******************************************************/


//
// That's all Folks!
// -------------------------------------------------

?>