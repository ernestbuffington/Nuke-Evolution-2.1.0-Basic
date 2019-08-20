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
$lang['LEFT_Package_Module'] = 'Pakket Module';
$lang['Install_module'] = 'Installeer Module';
$lang['Manage_modules'] = 'Beheer Modules';
$lang['Stats_configuration'] = 'Configuratie';
$lang['Edit_module'] = 'Edit Module';
$lang['Stats_langcp'] = 'Taal CP';

// Package Module
$lang['Package_module'] = 'Pakket Module';
$lang['Package_module_explain'] = 'Hier is het mogelijk je drie module files samen te voegen in één module voor afleveren.';
$lang['Select_info_file'] = 'Kies info file';
$lang['Select_lang_file'] = 'Kies taal file';
$lang['Select_module_file'] = 'Kies module php file';
$lang['Package_name'] = 'Pakket naam';
$lang['Create'] = 'Creër';

// Install Module
$lang['Install_module_explain'] = 'Hier is het mogelijk een nieuwe Module installeren. Het is mogelijk omdat te doen met de twee methoden. De eerste is uploading je Module Package met het geleverde formulier die je hieronder ziet. Als het uploading niet voor je werkt, dan is het mogelijk om het Module pakket te uploaden naar je ./modules/pakfiles folder, het wordt dan automatisch hier getoond. Voor verdere instructies hoe een Module pakket te installeren, kijk dan naar de geleverde Documentatie.<br />Nadat je een Module pakket hebt gekozen om te installeren, dan wordt er wat informatie geleverd over de Module die je hebt gekozen. Wees er zeker van dat de Module Informaties correct zijn en dat je voldoet aan de minimale eisen (b.v. de correcte Statistieken Mod Versie). Het is mogelijk om de Taal te kiezen die je mee wilt installeren. Nadat je alles hebt gecontroleerd en je weet zeker dat je gaat installeren, klik de Installeer Knop.<br />de standaard Installatie laat de Module gedeactiveerd, je moet het activeren voordat het te voorschijn komt in het Statistieken Pagina.';
$lang['Select_module_pak'] = 'Selecteer Module Pakket';
$lang['Upload_module_pak'] = 'Upload Module Pakket';
$lang['Inst_module_already_exist'] = 'Module met de naam \'%s\' bestaat al.<br />Als je deze Module wilt opwaarderen, dan moet je naar Module Beheer en de Module daar eerst Updaten.<br />Als je de Module helemaal opnieuw wilt installeren , dan moet je de oude Module eerst deinstalleren.';
$lang['Incorrect_update_module'] = 'Het gekozen Pakket is geen update voor de gekozen Module. Aub wees er zeker van dat je het goede Pakket hebt gekozen.';

$lang['Module_name'] = 'Module Naam';
$lang['Module_description'] = 'Module Beschrijving';
$lang['Module_version'] = 'Module Versie';
$lang['Required_stats_version'] = 'Minimum vereisten nodig voor Statistieken Mod Versie';
$lang['Installed_stats_version'] = 'Geinstalleerde Statistieken Mod Versie';
$lang['Module_author'] = 'Module Auteur';
$lang['Author_email'] = 'Auteur E-Mail Adres';
$lang['Module_url'] = 'Module/Auteur Homepage';
$lang['Update_url'] = 'Module update Homepage (Controleer voor Updates)';
$lang['Provided_language'] = 'Geleverde Taal';
$lang['Install_language'] = 'Installeer Taal';
$lang['Module_installed'] = 'Module met succes geinstalleerd.';
$lang['Module_updated'] = 'Module met succes ge-update.';

// Manage Modules
$lang['Manage_modules_explain'] = 'Hier is het mogelijk je Modules te beheren. Je kan ze aanpassen, verwijderen, volgorde veranderen, activeren of de-activeren. Als je jouw Module wilt configureren (instellen Toestemmingen, de Taal variabelen veranderen en nog veel meer), dan moet je jouw Module aanpassen.<br />Als je klikt op een Module Naam, dan zie je een vooruitblik van die Module.';
$lang['Deactivate'] = 'Deactiveer';
$lang['Activate'] = 'Activeer';

// Delete Module
$lang['Confirm_delete_module'] = 'Weet je zeker dat je deze Module wilt verwijderen?';

// Configuration
$lang['Msg_config_updated'] = '- Statistieken Mod Configuratie met succes bijgewerkt.';
$lang['Msg_reset_view_count'] = '- Bekeken Teller met succes ge-reset.';
$lang['Msg_reset_install_date'] = '- Installeer Datum instelling naar vandaag.';
$lang['Msg_reset_cache'] = '- Met succes alle caches geruimd.';
$lang['Msg_purge_modules'] = '- Met succes de Modules folder inhoud verwijderd.';
$lang['Config_title'] = 'Statistieken Configuratie';
$lang['Config_explain'] = 'Hier is het mogelijk de Statistieken Mod te configureren.';
$lang['Messages'] = 'Berichten';
$lang['Return_limit'] = 'Return Limiet';
$lang['Return_limit_explain'] = 'Het aantal items om in elke rangorde te plaatsen.';
$lang['Reset_settings_title'] = 'Reset Instellingen';
$lang['Reset_view_count'] = 'Reset teller';
$lang['Reset_view_count_explain'] = 'Reset de teller op de bodem van de statistieken pagina op nul.';
$lang['Reset_install_date'] = 'Reset installeer datum';
$lang['Reset_install_date_explain'] = 'Reset de installeer datum. Dit zal de installeer datum op vandaag zetten.';
$lang['Reset_cache'] = 'Leeg Cache';
$lang['Reset_cache_explain'] = 'Leeg al de huidige cached data van alle modules en inhoud templates.';
$lang['Purge_module_dir'] = 'Ruim Module Directory';
$lang['Purge_module_dir_explain'] = 'Verwijderd de complete Modules Directory, alle subdirectories en files worden dan verwijderd. Aub gebruik deze Optie alleen als je echt zeker weet wat je doet en welk effect het zal hebben met je Statistieken.';

// Edit Module
$lang['Msg_changed_update_time'] = '- Met succes update tijd veranderd.';
$lang['Msg_cleared_module_cache'] = '- Met succes Module cache geleegd.';
$lang['Msg_module_fields_updated'] = '- Updated Module velden met succes.';

$lang['Module_select_title'] = 'Kies Module';
$lang['Module_select_explain'] = 'Hier kan je de Module kiezen die wilt aanpassen.';
$lang['Edit_module_explain'] = 'Hier is het mogelijk de Module te configureren. Bij de Top zie je een paar Module Informaties, dan het Berichten Venster waar alle Updates te zien zijn. Bij de bodem vind je het Configuratie Gebied en het Update Module gebied, Aub kies eeen Module Pakket \'of\' upload een Module Pakket, niet beide alstublieft.<br />Het  Configuratie Gebied kan verschillend zijn van Module tot Module, omdat sommige Modules een speciale Configuratie Optie hebben de Auteur dacht dat wel behulpzaam zou zijn voor jou.';
$lang['Module_informations'] = 'Module Informaties';
$lang['Module_languages'] = 'Talen gelinked naar deze Module';
$lang['Preview_module'] = 'Vooruitblik Module';
$lang['Module_configuration'] = 'Module Configuratie';
$lang['Update_time'] = 'Update Tijd in Minuten';
$lang['Update_time_explain'] = 'Tijd Interval (in Minuten) voor verversen van de cached data met nieuwe Data. Iedere x Minuten wordt de Module reloaded.<br />Sinds de Statistieken gebruik maken van een prioriteit systeem, kan dit groter zijn dan x minuten, maar niet meer dan één dag.';
$lang['Module_status'] = 'Module Status';
$lang['Active'] = 'Actief';
$lang['Not_active'] = 'Niet actief';
$lang['Clear_module_cache'] = 'Leeg module cache';
$lang['Clear_module_cache_explain'] = 'Leeg de module cache en reset de modules prioriteit. De volgende keer dat de Statistieken Pagina wordt geroepen, wordt deze Module reloaded.';
$lang['Update_module'] = 'Update Module';
$lang['No_module_packages_found'] = 'Geen module pakketten gevonden';

// Permissions
$lang['Msg_permissions_updated'] = '- Permissies updated';
$lang['Permissions'] = 'Permissies';
$lang['Set_permissions_title'] = 'Hier is het mogelijk om de Permissies in te stellenom een Module te bekijken. Alleen de Gebruikers (Anoniem, Geregistreerd, Moderators en Administrators) en Groepen toegestaan/geplaatst hier kunnen de Module bekijken in de Statistieken Pagina.';
$lang['Perm_all'] = 'Anonieme Gebruikers';
$lang['Perm_reg'] = 'Geregistreerd Gebruikers';
$lang['Perm_mod'] = 'Moderators';
$lang['Perm_admin'] = 'Administrators';
$lang['Perm_group'] = 'Groepen';
$lang['Added_groups'] = 'Toegevoegde Groepen';
$lang['Perm_add_group'] = 'Voeg Groep Toe';
$lang['Perm_remove_group'] = 'Verwijder Groep';
$lang['Perm_groups_title'] = 'Groepen die de Module kunnen zien';
$lang['No_groups_selected'] = 'Geen groepen geselecteerd';
$lang['No_groups_to_add'] = 'Er zijn geen groepen meer om toe te voegen';

// Language CP
$lang['Language_key'] = 'Taal Verandering -> Sleutel';
$lang['Language_value'] = 'Taal Verandering -> Waarde';
$lang['Update_all_lang'] = 'Update Alle Invoeren';
$lang['Add_new_key'] = 'Voeg een nieuwe sleutel toe';
$lang['Create_new_lang'] = 'Creër nieuwe Taal';
$lang['Delete_language'] = 'Verwijder Taal';
$lang['Language_cp_title'] = 'Taal Controle Paneel';
$lang['Language_cp_explain'] = 'Hier is het mogelijk om aanpassingen te doen in alle Taal Verandering en Taal Pakketten voor elke Module, gescheiden, bijna alles. Je kunt hier ook Importeren of Exporteren van Taal pakken.';
$lang['Export_lang_module'] = 'Exporteer taal voor huidige module';
$lang['Export_language'] = 'Exporteer de complete huidige taal';
$lang['Export_everything'] = 'Exporteer alles';
$lang['Import_new_language'] = 'Importeer nieuwe Taal';
$lang['Import_new_language_explain'] = 'Hier is het mogelijk om te uploaden (of kiezen) van een Taal Pakket die je wilt installeren. Nadat je het Taal Pakket hebt ge-upload (of gekozen), zal je wat Informatie zien over het Taal pakket. Alleen na het bekijken van deze Informatie wordt het pakket geinstalleerd.';
$lang['Select_language_pak'] = 'Kies Taal Pakket';
$lang['Upload_language_pak'] = 'Upload Taal Pakket';

$lang['Language'] = 'Taal';
$lang['Modules'] = 'Modules';
$lang['Language_pak_installed'] = 'Taal Pakket met succes geinstalleerd.';

?>