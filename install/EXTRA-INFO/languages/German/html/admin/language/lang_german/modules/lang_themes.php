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

if (!defined('ADMIN_FILE')) {
    die('You can\'t access this file directly...');
}

$lang_admin[$adminpoint]['THEMES_ACTIVATE'] = 'Aktivieren';
$lang_admin[$adminpoint]['THEMES_ACTIVE'] = 'Aktiv';
$lang_admin[$adminpoint]['THEMES_ADMINS'] = 'Administratoren';
$lang_admin[$adminpoint]['THEMES_ADV_COMP'] = 'Dein Theme ist kompatibel mit den erweiterten Eigenschaften (ATO)';
$lang_admin[$adminpoint]['THEMES_ADV_OPTS'] = 'Erweiterte Theme Optionen';
$lang_admin[$adminpoint]['THEMES_ALLOWCHANGE'] = 'Erlaube Mitgliedern die Theme-Auswahl';
$lang_admin[$adminpoint]['THEMES_ALLUSERS'] = 'Alle Benutzer';
$lang_admin[$adminpoint]['THEMES_ATO_KEY'] = 'ATO Schl&uuml;ssel';

$lang_admin[$adminpoint]['THEMES_CHANGEATO'] = 'ATO Werte &auml;ndern';
$lang_admin[$adminpoint]['THEMES_CUSTOMN'] = 'Benutzerdefinierter Name';
$lang_admin[$adminpoint]['THEMES_CUSTOMNAME'] = 'Benutzerdefinierter Theme Name';

$lang_admin[$adminpoint]['THEMES_DB_VALUE'] = 'Aktiver Wert';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE'] = 'Deaktivieren';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE1'] = 'Bist Du sicher, dass Du dieses Theme deaktivieren willst?';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE2'] = 'Das wird ALLE Mitglieder die dieses Theme verwenden auf das Standard Theme setzten!';
$lang_admin[$adminpoint]['THEMES_DEFAULT'] = 'Standard Theme';
$lang_admin[$adminpoint]['THEMES_DEFAULT_MISSING'] = 'Dein Standard Theme konnte nicht gefunden werden ! ';
$lang_admin[$adminpoint]['THEMES_DEFAULT_NOT_FOUND'] = ' wurde NICHT gefunden!';
$lang_admin[$adminpoint]['THEMES_DEFAULT_VALUE'] = 'Standardwert des Themes';
$lang_admin[$adminpoint]['THEMES_DEF_LOADED'] = 'Standard Optionen sind unten geladen.';

$lang_admin[$adminpoint]['THEMES_EDIT'] = 'Bearbeiten';
$lang_admin[$adminpoint]['THEMES_ERROR'] = 'Fehler';
$lang_admin[$adminpoint]['THEMES_ERROR_CRITICAL'] = 'Kritischer Fehler';
$lang_admin[$adminpoint]['THEMES_ERROR_MESSAGE'] = 'Informationen zu den installierten Themen konnten nicht gefunden werden';

$lang_admin[$adminpoint]['THEMES_FROM'] = 'Von Theme';
$lang_admin[$adminpoint]['THEMES_FUNCTIONS'] = 'Funktionen';

$lang_admin[$adminpoint]['THEMES_GROUPS'] = 'Gruppen';
$lang_admin[$adminpoint]['THEMES_GROUPSONLY'] = 'Nur Gruppen';

$lang_admin[$adminpoint]['THEMES_HEADER'] = 'Nuke Evolution Theme Management :: Administrationsmen&uuml;';

$lang_admin[$adminpoint]['THEMES_INACTIVE'] = 'Inaktiv';
$lang_admin[$adminpoint]['THEMES_INFO_CHANGEATO'] = '<i>Nachdem die Installation abgeschlossen ist, kannst Du die ATO-Werte Deinen Vorstellungen anpassen<br />Dazu musst Du das Theme bearbeiten.</i>';
$lang_admin[$adminpoint]['THEMES_INSTALL'] = 'Installieren';
$lang_admin[$adminpoint]['THEMES_INSTALLED'] = 'Installierte Themes';

$lang_admin[$adminpoint]['THEMES_MAKEDEFAULT'] = 'Als Standard definieren';
$lang_admin[$adminpoint]['THEMES_MANG_OPTIONS'] = 'Theme Management Optionen';
$lang_admin[$adminpoint]['THEMES_MOSTPOPULAR'] = 'Beliebtestes Theme';
$lang_admin[$adminpoint]['THEMES_MULTLANG_COMP'] = 'Dein Theme ist mehrsprachig';

$lang_admin[$adminpoint]['THEMES_NAME'] = 'Theme Name';
$lang_admin[$adminpoint]['THEMES_NO'] = 'Nein';
$lang_admin[$adminpoint]['THEMES_NONE'] = 'Kein';
$lang_admin[$adminpoint]['THEMES_NOREALNAME'] = 'N/A';
$lang_admin[$adminpoint]['THEMES_NOT_COMPAT'] = '<font color=\'red\'>Dein Theme ist nicht kompatibel mit den erweiterten Eigenschaften (ATO)</font><br />Lass Dein Theme <a href=\'http://www.evo-themes.de\' target=\'_blank\'>HIER</a> anpassen';
$lang_admin[$adminpoint]['THEMES_NOT_MULTLANG_COMP'] = '<font color="red">Dein Theme ist nicht f&uuml;r Mehrsprachigkeit ausgelegt</font>';
$lang_admin[$adminpoint]['THEMES_NUMTHEMES'] = 'Anzahl an Themes';
$lang_admin[$adminpoint]['THEMES_NUMUNINSTALLED'] = 'Anzahl deinstallierter Themes';
$lang_admin[$adminpoint]['THEMES_NUMUSERS'] = '# von Benutzer';

$lang_admin[$adminpoint]['THEMES_OPTIONS'] = 'Theme Optionen';
$lang_admin[$adminpoint]['THEMES_OPTS'] = 'Optionen';

$lang_admin[$adminpoint]['THEMES_PAGE_FIRST'] = 'Erste';
$lang_admin[$adminpoint]['THEMES_PAGE_LAST'] = 'Letzte';
$lang_admin[$adminpoint]['THEMES_PAGE_NEXT'] = 'N&auml;chste';
$lang_admin[$adminpoint]['THEMES_PAGE_OF'] = 'bis';
$lang_admin[$adminpoint]['THEMES_PAGE_OF_TOTAL'] = 'von';
$lang_admin[$adminpoint]['THEMES_PAGE_PREVIOUS'] = 'Vorige';
$lang_admin[$adminpoint]['THEMES_PERMISSIONS'] = 'Berechtigungen';
$lang_admin[$adminpoint]['THEMES_PREVIEW'] = 'Vorschau';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES'] = 'Wer darf es anschauen';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS'] = 'Welche Gruppen';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS_INFO'] = 'Ansicht muss gesetzt sein auf : Nur f&uuml;r Gruppen';
$lang_admin[$adminpoint]['THEMES_PROBLEM'] = 'Es gibt ein Problem mit Deinem Theme. Stelle bitte sicher, das Du ein kompatibles Theme hast';

$lang_admin[$adminpoint]['THEMES_QINSTALL'] = 'Schnell Installation';
$lang_admin[$adminpoint]['THEMES_QUNINSTALLED'] = 'Deinstalliert';

$lang_admin[$adminpoint]['THEMES_REALNAME'] = 'Echter Name';
$lang_admin[$adminpoint]['THEMES_REST_DEF'] = 'Standard wieder herstellen';
$lang_admin[$adminpoint]['THEMES_RETURN'] = 'Zur&uuml;ck zum Theme Management';
$lang_admin[$adminpoint]['THEMES_RETURNMAIN'] = 'Zur&uuml;ck zur Haupt-Administration';
$lang_admin[$adminpoint]['THEMES_RETURN_OPTIONS'] = 'Zur&uuml;ck zu Theme Optionen';

$lang_admin[$adminpoint]['THEMES_SAVECHANGES'] = '&Auml;nderungen speichern';
$lang_admin[$adminpoint]['THEMES_SETTINGS_UPDATED'] = 'Einstellungen aktualisiert!';
$lang_admin[$adminpoint]['THEMES_STATUS'] = 'Status';
$lang_admin[$adminpoint]['THEMES_SUBMIT'] = 'Absenden';
$lang_admin[$adminpoint]['THEMES_SUBMIT'] = 'Senden';

$lang_admin[$adminpoint]['THEMES_TEXT_AREA'] = 'Textbereich';
$lang_admin[$adminpoint]['THEMES_THEMES'] = 'Themes';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATE'] = 'Deaktiviere Theme';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED'] = 'Theme erfolgreich deaktiviert!';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED_FAILED'] = 'Theme deaktivieren ist fehlgeschlagen!';
$lang_admin[$adminpoint]['THEMES_THEME_INSTALLED'] = 'Theme installiert!';
$lang_admin[$adminpoint]['THEMES_THEME_INSTALLED_FAILED'] = 'Installieren des Themes fehlgeschlagen!';
$lang_admin[$adminpoint]['THEMES_THEME_MISSING'] = 'Theme fehlt!';
$lang_admin[$adminpoint]['THEMES_THEME_TRANSFER'] = 'Theme Transfer';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALL'] = 'Deinstalliere Theme';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED'] = 'Theme erfolgreich deinstalliert';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED_FAILED'] = 'Theme deinstallieren ist fehlgeschlagen!';
$lang_admin[$adminpoint]['THEMES_TO'] = 'Zu Theme';
$lang_admin[$adminpoint]['THEMES_TRANSFER'] = 'Transfer Theme Benutzer';
$lang_admin[$adminpoint]['THEMES_TRANSFER_UPDATED'] = 'Benutzer wurde(n) aktualisiert!';

$lang_admin[$adminpoint]['THEMES_UNINSTALL'] = 'Deinstallieren';
$lang_admin[$adminpoint]['THEMES_UNINSTALL1'] = 'Bist Du sicher, dass Du dieses Theme deinstallieren willst?';
$lang_admin[$adminpoint]['THEMES_UNINSTALL2'] = 'Du wist ALLE Deine Einstellungen f&uuml;r dieses Theme verlieren!';
$lang_admin[$adminpoint]['THEMES_UNINSTALL3'] = 'Das wird ALLE Mitglieder die dieses Theme verwenden auf das Standard Theme setzten!';
$lang_admin[$adminpoint]['THEMES_UNINSTALLED'] = 'Deinstallierte Themes';
$lang_admin[$adminpoint]['THEMES_UPDATED'] = 'Theme aktualisiert!';
$lang_admin[$adminpoint]['THEMES_UPDATEFAILED'] = 'Theme-Aktualisierung ist fehlgeschlagen!';
$lang_admin[$adminpoint]['THEMES_USEREMAIL'] = 'eMail';
$lang_admin[$adminpoint]['THEMES_USERID'] = 'Benutzer ID';
$lang_admin[$adminpoint]['THEMES_USERNAME'] = 'Benutzername';
$lang_admin[$adminpoint]['THEMES_USERTHEME'] = 'Theme';
$lang_admin[$adminpoint]['THEMES_USER_MODIFY'] = 'Theme &auml;ndern';
$lang_admin[$adminpoint]['THEMES_USER_OPTIONS'] = 'Benutzeroptionen';
$lang_admin[$adminpoint]['THEMES_USER_RESET'] = 'R&uuml;cksetzen auf Default';
$lang_admin[$adminpoint]['THEMES_USER_SELECT'] = 'W&auml;hle ein Benutzer Theme';

$lang_admin[$adminpoint]['THEMES_VIEW'] = 'Anzeigen';
$lang_admin[$adminpoint]['THEMES_VIEW_STATS'] = 'Statistiken anzeigen';

$lang_admin[$adminpoint]['THEMES_YES'] = 'Ja';

?>