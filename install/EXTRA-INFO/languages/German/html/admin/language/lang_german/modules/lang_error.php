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

$lang_admin[$adminpoint]['EM203'] = 'Error 203: Die gesendete Information im Header ist nicht von der Original-Seite !!';
$lang_admin[$adminpoint]['EM204'] = 'Error 204: Du hast einen leeren Link geclickt (ohne URL). Bitte informiere unseren Webmaster.';
$lang_admin[$adminpoint]['EM205'] = 'Error 205: Der gesendete Header ist bei uns nicht erlaubt !!';
$lang_admin[$adminpoint]['EM300'] = 'Error 300: Die angeforderte Information kann nicht eindeutig zugeordnet werden.';
$lang_admin[$adminpoint]['EM301'] = 'Error 301: Die angeforderte Adresse wurde permanent umgeleitet.';
$lang_admin[$adminpoint]['EM302'] = 'Error 302: Die angeforderte Adresse wurde tempor&auml;r umgeleitet.';
$lang_admin[$adminpoint]['EM303'] = 'Error 303: Die angeforderte Adresse wurde umgeleitet - wir werden dieser Umleitung nicht folgen.';
$lang_admin[$adminpoint]['EM304'] = 'Error 304: Wir erlauben keine Anfragen nach der &Auml;nderungszeit einer Datei';
$lang_admin[$adminpoint]['EM400'] = 'Error 400: In der empfangenen Anfrage ist ein Syntaxfehler.';
$lang_admin[$adminpoint]['EM401'] = 'Error 401: Die Anfrage enth&auml;t nicht die notwendigen Authentifizierungsinformationen. Der Zugriff ist nicht erlaubt.';
$lang_admin[$adminpoint]['EM402'] = 'Error 402: Der Zugriff auf die angeforderte Adresse ist nur zahlenden Mitgliedern erlaubt.';
$lang_admin[$adminpoint]['EM403'] = 'Error 403: Wir k&ouml;nnen die Anfrage im moment nicht bearbeiten. Bitte versuchen Sie es sp&auml;ter noch einmal.';
$lang_admin[$adminpoint]['EM404'] = 'Error 404: Wir k&ouml;nnen die angefragte Adresse auf unserem Server nicht finden. Vielleicht ein Schreibfehler ?';
$lang_admin[$adminpoint]['EM405'] = 'Error 405: Die von Ihnen verwendete Zugriffsmethode ist nicht erlaubt.';
$lang_admin[$adminpoint]['EM406'] = 'Error 406: Ihr System ist nicht daf&uuml;r konfiguriert, die angefragte Adresse zu empfangen';
$lang_admin[$adminpoint]['EM407'] = 'Error 407: Der angefragte Zugriff muss erst autorisiert werden.';
$lang_admin[$adminpoint]['EM408'] = 'Error 408: Es ist eine Zeit&uuml;berschreitung aufgetreten. Bitte versuchen Sie es sp&auml;ter noch einmal';
$lang_admin[$adminpoint]['EM409'] = 'Error 409: Zu viele gleichzeitige Anfragen - Bitte versuchen Sie es sp&auml;ter noch einmal';
$lang_admin[$adminpoint]['EM410'] = 'Error 410: Die angeforderte Adresse ist nicht vorhanden';
$lang_admin[$adminpoint]['EM411'] = 'Error 411: In Ihrer Anfrage fehlen notwendige Informationen im Header';
$lang_admin[$adminpoint]['EM412'] = 'Error 412: Ihr Client ist nicht daf&uuml;r konfiguriert, die angefragte Information zu erhalten';
$lang_admin[$adminpoint]['EM413'] = 'Error 413: Die angefragte Datei ist zu gross um gesendet werden zu k&ouml;nnen';
$lang_admin[$adminpoint]['EM414'] = 'Error 414: Die angefragte Datei kann nicht bearbeitet werden';
$lang_admin[$adminpoint]['EM415'] = 'Error 415: Die angefragte Datei kann nicht bearbeitet werden';
$lang_admin[$adminpoint]['EM500'] = 'Error 500: Interner Server Fehler - Bitte versuchen Sie es sp&auml;ter noch einmal';
$lang_admin[$adminpoint]['EM501'] = 'Error 501: Die angefragte Adresse kann durch den Server nicht verarbeitet werden';
$lang_admin[$adminpoint]['EM502'] = 'Error 502: Der angefragte Server sendet permanente Fehler';
$lang_admin[$adminpoint]['EM503'] = 'Error 503: Die angefragte Adresse ist tempor&auml;r nicht erreichbar';
$lang_admin[$adminpoint]['EM504'] = 'Error 504: Das Gateway liefert einen vor&uuml;bergehenden Fehler';
$lang_admin[$adminpoint]['EM505'] = 'Error 505: Das angeforderte HTTP-Protokol wird von uns nicht unterst&uuml;zt';
$lang_admin[$adminpoint]['EMDATETIME'] = 'Datum / Zeit';
$lang_admin[$adminpoint]['EMHOME'] = 'Zur&uuml;ck zur Hauptseite';
$lang_admin[$adminpoint]['EMIP'] = 'IP Addresse';
$lang_admin[$adminpoint]['EMRECDATA'] = '<strong>Bemerkung:</strong> Wir haben die folgenden Daten gespeichert, um dem Problem auf die Spur zu kommen.';
$lang_admin[$adminpoint]['EMREF'] = 'Referer';
$lang_admin[$adminpoint]['EMSORRY'] = 'Wir entschuldigen uns f&uuml;r die Probleme auf';
$lang_admin[$adminpoint]['EMSORT'] = 'Fehlertyp';
$lang_admin[$adminpoint]['EMUNKNOWN'] = 'Error unknown: Es ist ein uns nicht bekannter Fehler aufgetreten.';
$lang_admin[$adminpoint]['EMURL'] = 'Fehler URL';

// Error Manager v2.1 Admin:
$lang_admin[$adminpoint]['EALOGERRORS'] = 'Die Fehler in der Datenbank speichern?';
$lang_admin[$adminpoint]['EASHOWIMAGE'] = 'Bild zeigen?';
$lang_admin[$adminpoint]['EASHOWINFOSAVED'] = 'Dem Besucher mitteilen, dass die Information gespeichert wurde?<br />(nur sinnvoll wenn \'Die Fehler in der Datenbank speichern?\' eingeschaltet ist)';
$lang_admin[$adminpoint]['EASHOWMODULBLOCKS'] = 'Rechte Bl&ouml;cke zeigen?';
$lang_admin[$adminpoint]['EMABACK'] = 'Zur&uuml;ck zur Fehlerseiten Administration';
$lang_admin[$adminpoint]['EMABACKMAIN'] = 'Zur&uuml;ck zur Hauptadministration';
$lang_admin[$adminpoint]['EMADATETIME'] = 'Datum / Zeit';
$lang_admin[$adminpoint]['EMADEL'] = 'Fehlereintrag l&ouml;schen';
$lang_admin[$adminpoint]['EMADELALL'] = 'Alle l&ouml;schen';
$lang_admin[$adminpoint]['EMADELETED'] = 'Der Fehler wurde aus der Datenbank gel&ouml;scht';
$lang_admin[$adminpoint]['EMADELETEDALL'] = 'Alle Fehlereintr&auml;ge wurden aus der Datenbank gel&ouml;scht';
$lang_admin[$adminpoint]['EMAIP'] = 'IP Addresse';
$lang_admin[$adminpoint]['EMALIST'] = 'Die folgenden Fehler sind auf Deiner Seite aufgetreten';
$lang_admin[$adminpoint]['EMAREF'] = 'Referer';
$lang_admin[$adminpoint]['EMASORT'] = 'Fehlertyp';
$lang_admin[$adminpoint]['EMATITLE'] = 'Fehlerseiten';
$lang_admin[$adminpoint]['EMAURL'] = 'Fehler URL';
$lang_admin[$adminpoint]['EMCONFIG'] = 'Einstellungen';
$lang_admin[$adminpoint]['EMSHOWERRORS'] = 'Fehler anzeigen';
$lang_admin[$adminpoint]['ERROR_BLOCKS_BOTH'] = 'Beide Bl&ouml;cke';
$lang_admin[$adminpoint]['ERROR_BLOCKS_LEFT'] = 'Linke Bl&ouml;cke';
$lang_admin[$adminpoint]['ERROR_BLOCKS_NONE'] = 'Keine Bl&ouml;cke';
$lang_admin[$adminpoint]['ERROR_BLOCKS_RIGHT'] = 'Rechte Bl&ouml;cke';

$lang_admin[$adminpoint]['RESETCOUNTER'] = '(Z&auml;hler zur&uuml;cksetzen)';

$lang_admin[$adminpoint]['SAVECHANGES'] = '&Auml;nderungen speichern';

$lang_admin[$adminpoint]['TOTALERRORS'] = 'Gesamtanzahl an Fehlermeldungen auf Deiner Seite';

?>