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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Beveiligingscode';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Instellingen beveiligingscode';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Beveiligingcode opties';

$lang_admin[$settingspoint]['FIELD_USEGFXCHECK'] = 'Beveiligingscode gebruiken voor';
$lang_admin[$settingspoint]['FIELD_CODESIZE'] = 'Aantal tekens voor de beveiligingscode';
$lang_admin[$settingspoint]['FIELD_CODEFONT'] = 'Font voor de beveiligingscode';
$lang_admin[$settingspoint]['FIELD_IMAGE_BACKGROUND'] = 'Achtergrond afbeelding gebruiken';
$lang_admin[$settingspoint]['FIELD_DEFAULTFONT'] = 'Standaard Font';
$lang_admin[$settingspoint]['FIELD_FONT_UPLOAD'] = 'U kunt nieuwe (ttf) Fonts gebruiken, indien u deze upload in de map:';
$lang_admin[$settingspoint]['FIELD_CAPFILE'] = 'Code keuze';

$lang_admin[$settingspoint]['OPTION_CHECKING_NO'] = 'Geen beveiligingscheck';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMIN'] = 'Alleen voor aanmelding Administrator';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_USER'] = 'Alleen voor aanmelding gebruiker';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_USER'] = 'Alleen voor gebruikers registratie';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_NEW_USER'] = 'Alleen voor aanmelding gebruikers registratie';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMINUSER'] = 'Alleen voor aanmelding administrators en gebruikers';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_ADMINUSER'] = 'Alleen voor registratie administrators en gebruikers';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_EVERYWHERE'] = 'Voor alle bovenstaande een beveiligingscode gebruiken';
$lang_admin[$settingspoint]['OPTION_CAPFILE_DEFAULT'] = 'Standaard';
$lang_admin[$settingspoint]['OPTION_CAPFILE_FILE'] = 'Bestand';

$lang_admin[$settingspoint]['IMG_CAPFILE_FILE'] = 'Beveiligigngscode';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'Geen foutmelding voor  '.$settingspoint.' beschikbaar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Opslaan';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Terug';

?>