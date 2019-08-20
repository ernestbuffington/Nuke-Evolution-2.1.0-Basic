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

global $adminpoint;

$lang_admin[$adminpoint]['MODULES_ACTIVATE'] = 'Aktivieren';
$lang_admin[$adminpoint]['MODULES_ACTIVE'] = 'Das Modul ist aktiviert.';
$lang_admin[$adminpoint]['MODULES_ADMIN_HEADER'] = 'Nuke-Evolution Module :: Admin Panel';
$lang_admin[$adminpoint]['MODULES_ALL'] = 'Alle';

$lang_admin[$adminpoint]['MODULES_BLOCK'] = 'Modulblock';
$lang_admin[$adminpoint]['MODULES_BLOCKS_BOTH'] = 'Beide Bl&ouml;cke';
$lang_admin[$adminpoint]['MODULES_BLOCKS_LEFT'] = 'Linke Bl&ouml;cke';
$lang_admin[$adminpoint]['MODULES_BLOCKS_NONE'] = 'Keine';
$lang_admin[$adminpoint]['MODULES_BLOCKS_RIGHT'] = 'Rechte Bl&ouml;cke';
$lang_admin[$adminpoint]['MODULES_BLOCKS_SHOW'] = 'Bl&ouml;cke anzeigen';

$lang_admin[$adminpoint]['MODULES_CAT_COLLAPSE'] = 'Diese Kategorie zuklappen? ';
$lang_admin[$adminpoint]['MODULES_CAT_DELETE'] = 'Kategorie l&ouml;schen';
$lang_admin[$adminpoint]['MODULES_CAT_EDIT'] = 'Kategorie bearbeiten';
$lang_admin[$adminpoint]['MODULES_CAT_IMG'] = 'Dateiname des Kategoriebildes';
$lang_admin[$adminpoint]['MODULES_CAT_IMG_NOTE'] = 'Kategoriebilder m&uuml;ssen im Verzeichnis <i>images/blocks/modules/</i> gespeichert werden.';
$lang_admin[$adminpoint]['MODULES_CAT_LINK_TITLE'] = 'Link Titel';
$lang_admin[$adminpoint]['MODULES_CAT_ORDER'] = '&Auml;ndern der Kategoriereihenfolge';
$lang_admin[$adminpoint]['MODULES_CAT_TITLE'] = 'Titel der Kategorie';
$lang_admin[$adminpoint]['MODULES_COLLAPSE'] = 'Aufklappbare Kategorien ?';
$lang_admin[$adminpoint]['MODULES_CUSTOMTITLE'] = 'Spezieller Titel';

$lang_admin[$adminpoint]['MODULES_DEACTIVATE'] = 'Deaktivieren';
$lang_admin[$adminpoint]['MODULES_DOUBLECLICK'] = '(Doppelklick zum aktivieren/deaktivieren)';

$lang_admin[$adminpoint]['MODULES_EDIT'] = 'Modul &auml;ndern';
$lang_admin[$adminpoint]['MODULES_ERROR_CAT_NF'] = 'Die Kategorie wurden nicht gefunden';
$lang_admin[$adminpoint]['MODULES_ERROR_GROUPS'] = 'Du musst mindestens 1 Gruppe ausw&auml;hlen';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE'] = 'Du musst einen Titel und einen Link angeben';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EMPTY'] = 'Du musst einen Titel angeben';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EXIST'] = 'Der von Dir angegebene Titel existiert bereits<br />Bitte gib einen neuen Titel ein<br /><br />';
$lang_admin[$adminpoint]['MODULES_EXPLAIN'] = 'Bitte beachte, dass wenn Du hier ein Modul aktivierst oder deaktivierst<br />wird dies f&uuml;r die Benutzer sofort sichtbar. F&uuml;r Dich jedoch erst, wenn Du Deinen Browser aktualisiert hast!';
$lang_admin[$adminpoint]['MODULES_EXPLAIN2'] = 'Du <strong>MUSST</strong> die &Auml;nderung der Sortierreihenfolge best&auml;tigen bevor diese gespeichert wird.<br />Deine &Auml;nderung wird nicht automatisch gespeichert !';

$lang_admin[$adminpoint]['MODULES_FUNCTIONS'] = 'Funktionen';

$lang_admin[$adminpoint]['MODULES_INACTIVE'] = 'Das Modul ist nicht aktiviert.';
$lang_admin[$adminpoint]['MODULES_INHOME'] = 'Geladenes Modul auf der Hauptseite:';

$lang_admin[$adminpoint]['MODULES_LINK'] = 'Ist ein Link';
$lang_admin[$adminpoint]['MODULES_LINK_DELETE'] = 'Link l&ouml;schen';

$lang_admin[$adminpoint]['MODULES_MODULEHOMENOTE'] = 'Modul-Titel in Fettschrift repr&auml;sentieren das Modul, welches auf der Hauptseite geladen wird.<br />Dieses Modul kann nicht deaktiviert oder gel&ouml;scht werden, solange es das Standardmodul ist.!<br />Wird das Standardmodul aus dem Modulverzeichnis gel&ouml;scht, erscheint eine Fehlermeldung auf der Hauptseite.<br />Dieses Modul wird auch beim Anklicken des Links <i>Hauptseite</i> geladen.';
$lang_admin[$adminpoint]['MODULES_MODULEINFO'] = 'Hinweis';
$lang_admin[$adminpoint]['MODULES_MVADMIN'] = 'Nur Administratoren';
$lang_admin[$adminpoint]['MODULES_MVALL'] = 'Alle Besucher';
$lang_admin[$adminpoint]['MODULES_MVANON'] = 'Nur G&auml;ste';
$lang_admin[$adminpoint]['MODULES_MVGROUPS'] = 'Nur Gruppenmitglieder';
$lang_admin[$adminpoint]['MODULES_MVUSERS'] = 'Nur registrierte Benutzer';

$lang_admin[$adminpoint]['MODULES_NF_VALUES'] = 'Es konnten keine Werte ermittelt werden';
$lang_admin[$adminpoint]['MODULES_NOTINMENU'] = 'Definiert ein Modul, wobei dessen Name und Link nicht im Modulblock sichtbar ist';

$lang_admin[$adminpoint]['MODULES_REFRESH SCREEN'] = 'Anzeige aktualisieren';

$lang_admin[$adminpoint]['MODULES_SAVECHANGES'] = '&Auml;nderungen speichern';
$lang_admin[$adminpoint]['MODULES_SHOW'] = 'Anzeigen';
$lang_admin[$adminpoint]['MODULES_SHOWINMENU'] = 'Im Modulblock sichtbar?';

$lang_admin[$adminpoint]['MODULES_TITLE'] = 'Titel';

$lang_admin[$adminpoint]['MODULES_URL'] = 'URL';

$lang_admin[$adminpoint]['MODULES_VIEW'] = 'Anzeigen';
$lang_admin[$adminpoint]['MODULES_VIEWPRIV'] = 'Wer kann dies anschauen';

$lang_admin[$adminpoint]['MODULES_WHATGRDESC'] = 'Welche Gruppen';
$lang_admin[$adminpoint]['MODULES_WHATGROUPS'] = 'Gruppen';

?>