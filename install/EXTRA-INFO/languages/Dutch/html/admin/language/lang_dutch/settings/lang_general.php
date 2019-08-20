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

if (!defined('ADMIN_FILE') && !defined('IN_SETTINGS')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Algemene instellingen';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Algemene instellingen';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Basis instellingen';
$lang_admin[$settingspoint]['FIELD_SITENAME'] = 'Naam van de pagina';
$lang_admin[$settingspoint]['FIELD_SITENAME_HELP'] = 'Geef in dit veld de naam van de website op. De naam dient bij voorkeur zo kort mogelijk gehouden te worden. De hier opgegeven naam verschijnt oa als titel in uw browser.'; 
$lang_admin[$settingspoint]['FIELD_SITEURL'] = 'Pagina adres';
$lang_admin[$settingspoint]['FIELD_SITEURL_HELP'] = 'Geef hier de URL van uw pagina op beginnend met http:// .';
$lang_admin[$settingspoint]['FIELD_SITELOGO'] = 'Logo pagina';
$lang_admin[$settingspoint]['FIELD_SITELOGO_HELP'] = 'Hier kunt u de bestandsnaam van uw website logo opgeven. Het bestand dient zich in de map images te bevinden om weer gegeven te worden.';
$lang_admin[$settingspoint]['FIELD_SITESLOGAN'] = 'Slogan';
$lang_admin[$settingspoint]['FIELD_SITESLOGAN_HELP'] = 'Hier kunje een korte omschrijving van uw site opgeven. Deze dient zo kort mogelijk gehouden te worden.';
$lang_admin[$settingspoint]['FIELD_STARTDATE'] = 'Startdatum';
$lang_admin[$settingspoint]['FIELD_STARTDATE_HELP'] = 'De startdatum geeft aan wanneer de pagina online gekomen is. Deze datum word in de pagina statistieken weergegeven en is niet taalafhangkelijk. Het beste is maand en jaar - bijv. Jan. 2010';
$lang_admin[$settingspoint]['FIELD_ADMINMAIL'] = 'Administrative Email-Adres';
$lang_admin[$settingspoint]['FIELD_ADMINMAIL_HELP'] = 'Hier een geldig E-Mailadres opgeven waaronder de Administrator berekbaar is - bijv. webmaster@mijnpagina.nl';
$lang_admin[$settingspoint]['FIELD_ITEMSTOP'] = 'Aantal bijdrages op de Top-Site';
$lang_admin[$settingspoint]['FIELD_ITEMSTOP_HELP'] = 'Hier kan het aantal bijdrages van de Top-Modules ingesteld worden. Standaard is 10 (TOP 10)';
$lang_admin[$settingspoint]['FIELD_STORIESHOME'] = 'Aantal artikels op de hoofdpagina';
$lang_admin[$settingspoint]['FIELD_STORIESHOME_HELP'] = 'Hier kunt u het aantal artikels instellen die op de hoofdpagina weergegeven worden. Standaard is 10. Deze waarde word door de instelling in de Artikel configuratie of door een gebruikersinstelling overschreven.';
$lang_admin[$settingspoint]['FIELD_OLDSTORIES'] = 'Aantal vorige artikels';
$lang_admin[$settingspoint]['FIELD_OLDSTORIES_HELP'] = 'Hier kan ingesteld worden hoeveel artikels in het archief weer gegeven worden. Standaard waarde is 30.';
$lang_admin[$settingspoint]['FIELD_ANONPOST'] = 'Mogen gasten schrijven?';
$lang_admin[$settingspoint]['FIELD_ANONPOST_HELP'] = 'Hier kan ingesteld worden of gasten artikels mogen insturen of reacties mogen geven.';
$lang_admin[$settingspoint]['FIELD_LOCALEFORMAT'] = 'Lokale Tijdsaanduiding';
$lang_admin[$settingspoint]['FIELD_LOCALEFORMAT_HELP'] = 'Instelling vande lokale PHP tijdaanduiding. Deze instelling heeft geen invloed op het systeem en word alleen uit compabeliteits redenen meegenomen.';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'Geen foutmelding voor '.$settingspoint.' beschikbaar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Opslaan';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Terug';

?>