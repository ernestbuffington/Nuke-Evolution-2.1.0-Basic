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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Instellingen Leeftijd begrenzing';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Online leeftijd begrenzing';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Opties leeftijds begrenzing';

$lang_admin[$settingspoint]['FIELD_COPPA'] = 'Leeftijdsbegrenzing activeren';
$lang_admin[$settingspoint]['FIELD_COPPAAGE'] = 'Leeftijdsgrens voor leeftijdsbegrenznig';
$lang_admin[$settingspoint]['FIELD_COPPATEXT'] = '<strong>Voorwaarden</strong><br /><small>Hier kunt u de inhoud voor uw leeftijdsbegrenzing berwerken. <br />WAARSCHUWING: Ditword alleen weergegeven als de leeftijdsbescherming is geactiveerd.</small>';

$lang_admin[$settingspoint]['OPTION_COPPA_AGE'] = 'Jaar';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Geen foutmelding voor '.$settingspoint.' beschikbaar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Opslaan';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Terug';

?>