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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Sicherheitscode';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Sicherheitscode Einstellungen';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Sicherheitscode Optionen';

$lang_admin[$settingspoint]['FIELD_USEGFXCHECK'] = 'Sicherheitcode verwenden bei';
$lang_admin[$settingspoint]['FIELD_CODESIZE'] = 'Anzahl der Zeichen f&uuml;r den Sicherheitscode';
$lang_admin[$settingspoint]['FIELD_CODEFONT'] = 'Font f&uuml;r den Sicherheitscode';
$lang_admin[$settingspoint]['FIELD_IMAGE_BACKGROUND'] = 'Hintergrundbild verwenden';
$lang_admin[$settingspoint]['FIELD_DEFAULTFONT'] = 'Standard Font';
$lang_admin[$settingspoint]['FIELD_FONT_UPLOAD'] = 'Du kannst neue (ttf) Fonts nutzen, indem Du diese hochl&auml;dtst in das Verzeichnis:';
$lang_admin[$settingspoint]['FIELD_CAPFILE'] = 'Codeauswahl';

$lang_admin[$settingspoint]['OPTION_CHECKING_NO'] = 'Kein Sicherheitscheck';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMIN'] = 'Nur Anmeldung Administrator';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_USER'] = 'Nur Anmeldung Benutzer';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_USER'] = 'Nur Neuregistrierung Benutzer';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_NEW_USER'] = 'Nur Anmeldung Benutzer und Benutzer Neuregistrierung';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMINUSER'] = 'Nur Anmeldung Administratoren und Benutzer';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_ADMINUSER'] = 'Nur Neuregistrierung Administratoren und Benutzer';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_EVERYWHERE'] = 'Bei allen Vorg&auml;ngen die einen Sicherheitscode erm&ouml;glichen';
$lang_admin[$settingspoint]['OPTION_CAPFILE_DEFAULT'] = 'Standard';
$lang_admin[$settingspoint]['OPTION_CAPFILE_FILE'] = 'Datei';

$lang_admin[$settingspoint]['IMG_CAPFILE_FILE'] = 'Sicherheitscode';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

?>