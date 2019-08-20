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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Grafische instelling';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Algemene instellingen van het Administratie menu';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Grafische instellingen';

$lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC'] = 'Grafische symbolen in het admin menu weergeven';
$lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC_HELP'] = 'Grafische symbolen kunnen in en uitgeschakeld worden.';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS'] = 'Positie van de grafieken';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_HELP'] = 'Als  grafische symbolen voor het administratiemenu ingeschakeld zijn, kan het zo ingesteld worden dat de omschijving boven of onder de sybolen weergegeven worden.';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_UP'] = 'Boven de tekst';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_DOWN'] = 'Onder de tekst';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE'] = 'Afbeeldings grootte aanpassen activeren';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE_HELP'] = 'Hier kan ingesteld worden of de automatsche grootte aanpassing van de afbeeldingen in nieuws in of uitgeschakeld word. De grootte is afhankelijk van de instellingen van de hoogte en de breedte van de afbeelding.';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH'] = 'Op deze breedte aanpassen';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH_HELP'] = 'Als de automatische grootte aanpassing geactiveerd is kan hier de breedte in pixels opgegeven worden waarin de afbeelding weergegeven word.';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT'] = 'Op deze hoogte aanpasssen';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT_HELP'] = 'Als de automatische grootte aanpassing geactiveerd is kan hier de hoogte in Pixel opgegeven worden waarin de afbeelding weergegeven word.';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Geen foutomschijving voor '.$settingspoint.' beschikbaar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Opslaan';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Terug';

?>