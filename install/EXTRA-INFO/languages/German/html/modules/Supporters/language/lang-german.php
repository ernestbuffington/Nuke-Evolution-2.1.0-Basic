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

 Copyright (c) 2007 by The Nuke Evolution Development Team
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

global $supporter_config, $module_name;
$lang_new[$module_name]['SP_ACTIVATE'] = 'Aktivieren';
$lang_new[$module_name]['SP_ACTIVESITES'] = 'Aktive Seiten';
$lang_new[$module_name]['SP_ADDED'] = 'Hinzugef&uuml;gt';
$lang_new[$module_name]['SP_ADDSUPPORTER'] = 'Supporter hinzuf&uuml;gen';
$lang_new[$module_name]['SP_ADMINMAIN'] = 'Supporter-Administration';
$lang_new[$module_name]['SP_ADMIN_HEADER'] = 'Nuke-Evolution Supporter :: Modul Administration';
$lang_new[$module_name]['SP_ALLREQ'] = 'Alle Felder erforderlich';
$lang_new[$module_name]['SP_APPROVE'] = 'Freigeben';
$lang_new[$module_name]['SP_APPROVESITE'] = 'Seite freigeben';
$lang_new[$module_name]['SP_BESUPPORTER'] = 'Supporter werden';
$lang_new[$module_name]['SP_CONFBANN'] = 'fehlerhafter Upload';
$lang_new[$module_name]['SP_CONFIGMAIN'] = 'Supporter Konfiguration';
$lang_new[$module_name]['SP_DBERROR1'] = 'FEHLER: Konnte nicht in die Datenbank schreiben';
$lang_new[$module_name]['SP_DEACTIVATE'] = 'Deaktivieren';
$lang_new[$module_name]['SP_DELETESITE'] = 'Seite l&ouml;schen';
$lang_new[$module_name]['SP_DESCRIPTION'] = 'Beschreibung';
$lang_new[$module_name]['SP_EDITED'] = 'Letzte &Auml;nderung am';
$lang_new[$module_name]['SP_EDITED_USER'] = 'ge&auml;ndert durch';
$lang_new[$module_name]['SP_EDITSITE'] = 'Seite editieren';
$lang_new[$module_name]['SP_EDITSITE'] = 'Seite modifizieren';
$lang_new[$module_name]['SP_FILETYPERROR'] = 'Falscher Dateityp. Es sind nur Bilder (gif, jpg, jpeg, png, swf) erlaubt';
$lang_new[$module_name]['SP_GOTOADMIN'] = 'Supporter Admin';
$lang_new[$module_name]['SP_IMAGE'] = 'Seiten Bild';
$lang_new[$module_name]['SP_IMAGETYPE'] = 'Bildlink Typ';
$lang_new[$module_name]['SP_IMAGETYPE0'] = 'Dies ist eine Bild-URL!';
$lang_new[$module_name]['SP_IMAGETYPE1'] = 'Das Bild ist von Deinem PC hochgeladen!';
$lang_new[$module_name]['SP_IMAGE_UPLOAD'] = 'Seiten Bild hochladen <br /><small>Wenn beide Bildtypen angegeben sind, wird das hochgeladene Bild bevorzugt</small>';
$lang_new[$module_name]['SP_IMAGE_URL'] = 'Seiten Bild URL';
$lang_new[$module_name]['SP_INACTIVESITES'] = 'Inaktive Seiten';
$lang_new[$module_name]['SP_LINKED'] = 'Verlinkt';
$lang_new[$module_name]['SP_MAXHEIGHT'] = 'max Bildh&ouml;he';
$lang_new[$module_name]['SP_MAXWIDTH'] = 'max Bildbreite';
$lang_new[$module_name]['SP_MISSINGDATA'] = 'Es fehlen Formulardaten!';
$lang_new[$module_name]['SP_MUSTBE'] = 'Bilder die gr&ouml;sser sind als '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' werden auf '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' verkleinert angezeigt.';
$lang_new[$module_name]['SP_NAME'] = 'Seiten Name';
$lang_new[$module_name]['SP_NOACTIVESITES'] = 'Es gibt keine aktiven Seiten.';
$lang_new[$module_name]['SP_NOINACTIVESITES'] = 'Es gibt keine inaktiven Seiten.';
$lang_new[$module_name]['SP_NOSUBMITTEDSITES'] = 'Es gibt keine eingereichten Seiten.';
$lang_new[$module_name]['SP_NOUPLOAD'] = 'Bild wurde nicht korrekt hochgeladen.';
$lang_new[$module_name]['SP_REQUIREUSER'] = 'Registrierung erforderlich';
$lang_new[$module_name]['SP_RETURNMAIN'] = 'Zur&uuml;ck zur Hauptadministration';
$lang_new[$module_name]['SP_SAVECHANGES'] = '&Auml;nderungen speichern';
$lang_new[$module_name]['SP_SITEID'] = 'Seiten ID';
$lang_new[$module_name]['SP_SUBMITSITE'] = 'Seite einreichen';
$lang_new[$module_name]['SP_SUBMITTED'] = 'Eingereicht';
$lang_new[$module_name]['SP_SUBMITTEDSITES'] = 'Eingereichte Seiten';
$lang_new[$module_name]['SP_SUPPORTEDBY'] = 'Unterst&uuml;tzt von';
$lang_new[$module_name]['SP_SUPPORTERS'] = 'Supporter';
$lang_new[$module_name]['SP_SURE2DELETE'] = 'Willst Du diese Seite wirklich l&ouml;schen?';
$lang_new[$module_name]['SP_UPLOAD'] = 'Hochladen';
$lang_new[$module_name]['SP_UPLOADERROR'] = 'Datei wurde nicht auf den Server geladen';
$lang_new[$module_name]['SP_URL'] = 'Seiten URL';
$lang_new[$module_name]['SP_USEREMAIL'] = 'Benutzer eMail';
$lang_new[$module_name]['SP_USERID'] = 'Benutzer ID';
$lang_new[$module_name]['SP_USERIP'] = 'Benutzer IP';
$lang_new[$module_name]['SP_USERNAME'] = 'Benutzername';
$lang_new[$module_name]['SP_VISITS'] = 'Besuche';
$lang_new[$module_name]['SP_YOUDELETE'] = 'Du bist dabei diese Seite zu l&ouml;schen';
$lang_new[$module_name]['SP_YOUREMAIL'] = 'Deine eMail';
$lang_new[$module_name]['SP_YOURIP'] = 'Deine IP';
$lang_new[$module_name]['SP_YOURNAME'] = 'Dein Name';

?>