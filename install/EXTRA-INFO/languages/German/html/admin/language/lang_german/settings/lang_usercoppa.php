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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Jugendschutz Einstellungen';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Online Jugendschutz';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Jugendschutz Optionen';

$lang_admin[$settingspoint]['FIELD_COPPA'] = 'Jugendschutzabfrage aktivieren';
$lang_admin[$settingspoint]['FIELD_COPPAAGE'] = 'Altersgrenze f&uuml;r den Jugendschutz';
$lang_admin[$settingspoint]['FIELD_COPPATEXT'] = '<strong>Nutzungsbedingungen</strong><br /><small>Hier kannst Du den Inhalt Deiner Jugendschutzbestimmungen bearbeiten. <br />WICHTIG: Diese werden nur angezeigt, wenn Du die Jugendschutzbestimmungen aktiviert hast.</small>';

$lang_admin[$settingspoint]['OPTION_COPPA_AGE'] = 'Jahre';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

?>