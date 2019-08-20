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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Impressum';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Impressum Einstellungen';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Impressum Anzeigeoptionen';

$lang_admin[$settingspoint]['FIELD_SHOW_ABOUTUS'] = 'Soll der Link \'&Uuml;ber uns\' angezeigt werden ';
$lang_admin[$settingspoint]['FIELD_SHOW_DISCLAIMER'] = 'Soll der Link f&uuml;r den Haftungsausschluss angezeigt werden';
$lang_admin[$settingspoint]['FIELD_SHOW_PRIVACY'] = 'Soll der Link f&uuml;r den Datenschutz angezeigt werden';
$lang_admin[$settingspoint]['FIELD_SHOW_TERMS'] = 'Soll der Link f&uuml;r die Nutzungsbedingungen angezeigt werden';
$lang_admin[$settingspoint]['FIELD_FEEDBACK_MODUL'] = 'Soll das Kontaktmodul oder das Feedbackmodul f&uuml;r Anfragen verwendet werden';

$lang_admin[$settingspoint]['OPTION_FEEDBACK_NONE'] = 'Keines';
$lang_admin[$settingspoint]['OPTION_FEEDBACK_FEEDBACK'] = 'Feedbackmodul';
$lang_admin[$settingspoint]['OPTION_FEEDBACK_CONTACT'] = 'Kontaktmodul';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

?>