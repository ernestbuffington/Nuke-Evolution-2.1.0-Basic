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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Generelle Einstellungen';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Generelle Einstellungen';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Basiseinstellungen';
$lang_admin[$settingspoint]['FIELD_SITENAME'] = 'Name der Seite';
$lang_admin[$settingspoint]['FIELD_SITENAME_HELP'] = 'Gib in diesem Feld Deiner Website einen Namen. Der Name sollte m&ouml;glichst kurz gehalten werden. Der hier angegebene Name erscheint unter anderem als Seitentitel in der Browserleiste.'; 
$lang_admin[$settingspoint]['FIELD_SITEURL'] = 'Seitenadresse';
$lang_admin[$settingspoint]['FIELD_SITEURL_HELP'] = 'Hier bitte die URL Deiner Website beginnend mit http:// eintragen.';
$lang_admin[$settingspoint]['FIELD_SITELOGO'] = 'Seitenlogo';
$lang_admin[$settingspoint]['FIELD_SITELOGO_HELP'] = 'Hier kann der Dateiname eines Logos f&uuml;r die Website eingetragen werden. Das entsprechende Logo muss sich im images Verzeichnis befinden, um angezeigt zu werden.';
$lang_admin[$settingspoint]['FIELD_SITESLOGAN'] = 'Seitenspruch';
$lang_admin[$settingspoint]['FIELD_SITESLOGAN_HELP'] = 'Hier kann eine Kurzbeschreibung der Website angegeben werden. Die Beschreibung sollte so kurz wie m&ouml;glich gew&auml;hlt werden.';
$lang_admin[$settingspoint]['FIELD_STARTDATE'] = 'Seitenstartdatum';
$lang_admin[$settingspoint]['FIELD_STARTDATE_DAY'] = 'Tag';
$lang_admin[$settingspoint]['FIELD_STARTDATE_MONTH'] = 'Monat';
$lang_admin[$settingspoint]['FIELD_STARTDATE_YEAR'] = 'Jahr';
$lang_admin[$settingspoint]['FIELD_STARTDATE_HELP'] = 'Das Statdatum, an dem die Website online gegangen ist. Dieses Datum wird z.B. in der Seitenstatistik angezeigt.';
$lang_admin[$settingspoint]['FIELD_ADMINMAIL'] = 'Administrative Email-Adresse';
$lang_admin[$settingspoint]['FIELD_ADMINMAIL_HELP'] = 'An dieser Stelle eine g&uuml;ltige eMail-Adresse angeben, unter der der Seiteninhaber oder Admin erreichbar ist - z.B. webmaster@meineseite.de';
$lang_admin[$settingspoint]['FIELD_ITEMSTOP'] = 'Zahl der Eintr&auml;ge auf der Top-Seite';
$lang_admin[$settingspoint]['FIELD_ITEMSTOP_HELP'] = 'Hier kann die Anzahl der Eintr&auml;ge des Top-Moduls eingestellt werden. Voreingestellung ist 10 (TOP 10)';
$lang_admin[$settingspoint]['FIELD_STORIESHOME'] = 'Zahl der Artikel auf der Startseite';
$lang_admin[$settingspoint]['FIELD_STORIESHOME_HELP'] = 'Hier kann die Anzahl der auf der Hauptseite angezeigten Artikel eingestellt werden. Voreinstellung ist 10. Dieser Wert wird durch eine Einstellung in der Artikel Konfiguration, oder durch eine Benutzereinstellung &uuml;berschrieben.';
$lang_admin[$settingspoint]['FIELD_OLDSTORIES'] = 'Zahl der vorherigen Artikel';
$lang_admin[$settingspoint]['FIELD_OLDSTORIES_HELP'] = 'Hier kann eingestellt werden, wie viele Artikel im Artikelarchiv angezeigt werden. Voreinstellung ist 30.';
$lang_admin[$settingspoint]['FIELD_ANONPOST'] = 'D&uuml;rfen G&auml;ste schreiben?';
$lang_admin[$settingspoint]['FIELD_ANONPOST_HELP'] = 'Mit dieser Einstellung kann festgelegt werden, ob es G&auml;sten erlaubt ist Artikel einzureichen und Kommentare zu Artikeln abzugeben.';
$lang_admin[$settingspoint]['FIELD_LOCALEFORMAT'] = 'Lokales Zeitformat';
$lang_admin[$settingspoint]['FIELD_LOCALEFORMAT_HELP'] = 'Einstellung des lokalen PHP Zeitformats. Diese Einstellung hat keinen Einflu&szlig; auf das System und wird nur aus Gr&uuml;nden der Kompatibilit&auml;t mitgef&uuml;hrt.';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

?>