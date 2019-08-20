<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

global $module_name;

//Active/Inactive
$lang_new[$module_name]['ADDED'] = 'Hinzugef&uuml;gt';
$lang_new[$module_name]['ALL_ACTIVE_SITES'] = 'Es sind alle Link-Buttons aktiv';
$lang_new[$module_name]['BANNER_BUTTONS'] = 'Werbe-Buttons';
$lang_new[$module_name]['CLICKS'] = 'Klicks';
$lang_new[$module_name]['DESCRIPTION'] = 'Beschreibung';
$lang_new[$module_name]['NO_ACTIVE_SITES'] = 'Es sind keine aktiven Link-Buttons vorhanden';
$lang_new[$module_name]['RESOURCES'] = 'Ressourcen';
$lang_new[$module_name]['SITE_NAME'] = 'Name der Seite';
$lang_new[$module_name]['STANDARD_BUTTONS'] = 'Standard-Buttons';
$lang_new[$module_name]['VISITS'] = 'Anzahl Besuche';

//Admin Config
$lang_new[$module_name]['BUTTON_BANNER_SIZE'] = 'Banner-Button Gr&ouml;sse';
$lang_new[$module_name]['BUTTON_RESSOURCE_SIZE'] = 'Ressource-Button Gr&ouml;sse';
$lang_new[$module_name]['BUTTON_SIZE'] = 'Standard-Button Gr&ouml;sse';
$lang_new[$module_name]['BUTTON_SUBMIT_METHOD'] = 'Button Best&auml;tigungsmethode';
$lang_new[$module_name]['FOLDER_UPLOAD_LOCATION'] = 'Verzeichnis f&uuml;r neue Buttons';
$lang_new[$module_name]['HEIGHT'] = 'H&ouml;he';
$lang_new[$module_name]['LINK'] = 'Link';
$lang_new[$module_name]['LINK_US_CONFIG'] = 'Generelle Einstellungen';
$lang_new[$module_name]['NO'] = 'Nein';
$lang_new[$module_name]['UPLOAD'] = 'Hochladen';
$lang_new[$module_name]['USERS_SUBMIT_BUTTON'] = 'Benutzer d&uuml;rfen Buttons best&auml;tigen';
$lang_new[$module_name]['WIDTH'] = 'Breite';
$lang_new[$module_name]['YES'] = 'Ja';

//Block Config
$lang_new[$module_name]['BLOCK_CONFIG'] = 'Blockkonfiguration';
$lang_new[$module_name]['BLOCK_HEIGHT'] = 'Block H&ouml;he';
$lang_new[$module_name]['BUTTON_SEPARATION'] = 'Trennung der Buttons';
$lang_new[$module_name]['DOTTED'] = 'gestrichelte Linie';
$lang_new[$module_name]['DOWN'] = 'Abw&auml;rts';
$lang_new[$module_name]['ENABLE_FADE'] = 'Einblendeffekt aktivieren';
$lang_new[$module_name]['ENABLE_MARQUEE'] = 'Laufschrift aktivieren';
$lang_new[$module_name]['EXAMPLE'] = 'Beispiel';
$lang_new[$module_name]['FAST'] = 'Schnell';
$lang_new[$module_name]['HORIZONTAL'] = 'Horizontale Linie';
$lang_new[$module_name]['LEFT'] = 'Links';
$lang_new[$module_name]['LINK_US_IMAGE'] = 'Dein Seitenlogo f&uuml;r den Link';
$lang_new[$module_name]['MARQUEE_DIRECTION'] = 'Richtung der Laufschrift';
$lang_new[$module_name]['MARQUEE_SCROLL'] = 'Anzahl Zeilen der Laufschrift';
$lang_new[$module_name]['NO_SEPARATION'] = 'keine Trennung';
$lang_new[$module_name]['RIGHT'] = 'Rechts';
$lang_new[$module_name]['SHOW_CLICK_COUNTER'] = 'Zeige den Klickz&auml;hler';
$lang_new[$module_name]['SLOW'] = 'Langsam';
$lang_new[$module_name]['UP'] = 'Aufw&auml;rts';

//Buttons
$lang_new[$module_name]['ACTIVE'] = 'Aktiv';
$lang_new[$module_name]['ADD_BUTTON'] = 'Einen weiteren Button hinzuf&uuml;gen';
$lang_new[$module_name]['ADD_SITE_LINK'] = 'Einen Link-Button hinzuf&uuml;gen';
$lang_new[$module_name]['BUTTON_TYPE'] = 'Button Typ';
$lang_new[$module_name]['DATE_ADDED'] = 'Anlegedatum';
$lang_new[$module_name]['DEACTIVATED'] = 'Deaktiviert';
$lang_new[$module_name]['EDIT_SUCCESSFUL'] = 'Der Button wurde erfolgreich ge&auml;ndert';
$lang_new[$module_name]['EDIT_UNSUCCESSFUL'] = 'Die &Auml;nderung konnte nicht vorgenommen werden';
$lang_new[$module_name]['ERROR'] = 'FEHLER! Unbekanntes Bildformat';
$lang_new[$module_name]['IMAGE_TYPES'] = 'Verf&uuml;gbare Bildtypen';
$lang_new[$module_name]['RESOURCE_BUTTONS'] = 'Ressource-Buttons';
$lang_new[$module_name]['SAVE_EDIT_LINK_BUTTON'] = 'Speichere den ge&auml;nderten Link-Button';
$lang_new[$module_name]['SITE_DESCRIPTION'] = 'Beschreibung der Seite';
$lang_new[$module_name]['SITE_ID'] = 'Seiten ID';
$lang_new[$module_name]['SITE_IMAGE'] = 'Bild der Seite';
$lang_new[$module_name]['SITE_NAME'] = 'Name der Seite';
$lang_new[$module_name]['SITE_STATUS'] = 'Seitenstatus';
$lang_new[$module_name]['SITE_URL'] = 'URL der Seite';
$lang_new[$module_name]['UPDATE_BLOCK_CONFIG'] = 'ge&auml;nderte Blockkonfiguration speichern';
$lang_new[$module_name]['UPDATE_MAIN_CONFIG'] = 'ge&auml;nderte Konfiguration speichern';
$lang_new[$module_name]['UPDATE_MODULE_CONFIG'] = 'ge&auml;nderte Modulkonfiguration speichern';

//Index/common
$lang_new[$module_name]['ADD_LINK_BUTTON'] = 'Neuen Link-Button anlegen';
$lang_new[$module_name]['ADMINISTRATION'] = 'Nuke-Evolution Link zu uns :: Modul-Administration';
$lang_new[$module_name]['ADMIN_CONFIG'] = 'Generelle Einstellungen';
$lang_new[$module_name]['BLOCK_CONFIG'] = 'Blockonfiguration';
$lang_new[$module_name]['CONFIG_ERROR'] = 'Die Konfigurationstabelle ist nicht lesbar';
$lang_new[$module_name]['CURRENT_VERSION'] = 'Deine Version ist im Moment!';
$lang_new[$module_name]['DELETE'] = 'L&ouml;schen';
$lang_new[$module_name]['DOWNLOAD_HERE'] = 'Von hier herunter laden';
$lang_new[$module_name]['EDIT'] = 'Bearbeiten';
$lang_new[$module_name]['LINK_US'] = 'Link zu uns';
$lang_new[$module_name]['LINK_US_INDEX']= 'Diese Webseiten haben einen Link zu uns gesetzt - bitte besuche sie!';
$lang_new[$module_name]['MAIN_ADMINISTRATION'] = 'Hauptadministration';
$lang_new[$module_name]['MODULE_CONFIG'] ='Modulkonfiguration';
$lang_new[$module_name]['VIEW_ACTIVE_SITES'] = 'Aktive Link-Buttons anzeigen';
$lang_new[$module_name]['VIEW_INACTIVE_SITES'] = 'Inaktive Link-Buttons anzeigen';

//Module Config
$lang_new[$module_name]['SHOW_BANNER'] = 'Zeige Banner-Button';
$lang_new[$module_name]['SHOW_RESOURCES'] = 'Zeige Ressourcen-Button';
$lang_new[$module_name]['SHOW_STANDARD'] = 'Zeige Standard-Button';

?>