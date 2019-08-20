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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Taal';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Taalinstellingen';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Taalopties';

$lang_admin[$settingspoint]['FIELD_SITE_LANGUAGE'] = 'Standaard taal voor deze website';
$lang_admin[$settingspoint]['FIELD_SITE_LANGUAGE_HELP'] = 'Kies hier de standaard taal voor uw website. Er moeten meerdere talen geinstalleerd zijn om een keuze te kunnen maken.';
$lang_admin[$settingspoint]['FIELD_SITE_MULTILINGUAL'] = 'Site meertalig maken activeren';
$lang_admin[$settingspoint]['FIELD_SITE_MULTILINGUAL_HELP'] = 'Hier kunt u de optie meertalig in of uit schakelen. Om de site meertalig te maken dient u meerdere talen te installeren.';
$lang_admin[$settingspoint]['FIELD_SITE_USEFLAGS'] = 'Flaggen ipv keuzemenu weergeven';
$lang_admin[$settingspoint]['FIELD_SITE_USEFLAGS_HELP'] = 'Deze keuze op ja zetten om flaggen te tonen ipv een keuzelijst met landen.';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Geen foutmelding voor '.$settingspoint.' beschikbaar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Opslaan';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Terug';

?>