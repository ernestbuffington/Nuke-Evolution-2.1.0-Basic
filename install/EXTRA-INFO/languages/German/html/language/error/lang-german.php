<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		#$#BASE
 Nuke-Evo Version       :		#$#VER
 Nuke-Evo Build         :		#$#BUILD
 Nuke-Evo Patch         :		#$#PATCH
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		#$#DATE

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

// Error Manager v2.1
$lang_new[$module_name]['EM203'] = 'Error 203: Die gesendete Information im Header ist nicht von der Original-Seite !!';
$lang_new[$module_name]['EM204'] = 'Error 204: Du hast einen leeren Link geclickt (ohne URL). Bitte informiere unseren Webmaster.';
$lang_new[$module_name]['EM205'] = 'Error 205: Der gesendete Header ist bei uns nicht erlaubt !!';
$lang_new[$module_name]['EM300'] = 'Error 300: Die angeforderte Information kann nicht eindeutig zugeordnet werden.';
$lang_new[$module_name]['EM301'] = 'Error 301: Die angeforderte Adresse wurde permanent umgeleitet.';
$lang_new[$module_name]['EM302'] = 'Error 302: Die angeforderte Adresse wurde tempor&auml;r umgeleitet.';
$lang_new[$module_name]['EM303'] = 'Error 303: Die angeforderte Adresse wurde umgeleitet - wir werden dieser Umleitung nicht folgen.';
$lang_new[$module_name]['EM304'] = 'Error 304: Wir erlauben keine Anfragen nach der &Auml;nderungszeit einer Datei';
$lang_new[$module_name]['EM400'] = 'Error 400: In der empfangenen Anfrage ist ein Syntaxfehler.';
$lang_new[$module_name]['EM401'] = 'Error 401: Die Anfrage enth&auml;t nicht die notwendigen Authentifizierungsinformationen. Der Zugriff ist nicht erlaubt.';
$lang_new[$module_name]['EM402'] = 'Error 402: Der Zugriff auf die angeforderte Adresse ist nur zahlenden Mitgliedern erlaubt.';
$lang_new[$module_name]['EM403'] = 'Error 403: Wir k&ouml;nnen die Anfrage im moment nicht bearbeiten. Bitte versuchen Sie es sp&auml;ter noch einmal.';
$lang_new[$module_name]['EM404'] = 'Error 404: Wir k&ouml;nnen die angefragte Adresse auf unserem Server nicht finden. Vielleicht ein Schreibfehler ?';
$lang_new[$module_name]['EM405'] = 'Error 405: Die von Ihnen verwendete Zugriffsmethode ist nicht erlaubt.';
$lang_new[$module_name]['EM406'] = 'Error 406: Ihr System ist nicht daf&uuml;r konfiguriert, die angefragte Adresse zu empfangen';
$lang_new[$module_name]['EM407'] = 'Error 407: Der angefragte Zugriff muss erst autorisiert werden.';
$lang_new[$module_name]['EM408'] = 'Error 408: Es ist eine Zeit&uuml;berschreitung aufgetreten. Bitte versuchen Sie es sp&auml;ter noch einmal';
$lang_new[$module_name]['EM409'] = 'Error 409: Zu viele gleichzeitige Anfragen - Bitte versuchen Sie es sp&auml;ter noch einmal';
$lang_new[$module_name]['EM410'] = 'Error 410: Die angeforderte Adresse ist nicht vorhanden';
$lang_new[$module_name]['EM411'] = 'Error 411: In Ihrer Anfrage fehlen notwendige Informationen im Header';
$lang_new[$module_name]['EM412'] = 'Error 412: Ihr Client ist nicht daf&uuml;r konfiguriert, die angefragte Information zu erhalten';
$lang_new[$module_name]['EM413'] = 'Error 413: Die angefragte Datei ist zu gross um gesendet werden zu k&ouml;nnen';
$lang_new[$module_name]['EM414'] = 'Error 414: Die angefragte Datei kann nicht bearbeitet werden';
$lang_new[$module_name]['EM415'] = 'Error 415: Die angefragte Datei kann nicht bearbeitet werden';
$lang_new[$module_name]['EM500'] = 'Error 500: Interner Server Fehler - Bitte versuchen Sie es sp&auml;ter noch einmal';
$lang_new[$module_name]['EM501'] = 'Error 501: Die angefragte Adresse kann durch den Server nicht verarbeitet werden';
$lang_new[$module_name]['EM502'] = 'Error 502: Der angefragte Server sendet permanente Fehler';
$lang_new[$module_name]['EM503'] = 'Error 503: Die angefragte Adresse ist tempor&auml;r nicht erreichbar';
$lang_new[$module_name]['EM504'] = 'Error 504: Das Gateway liefert einen vor&uuml;bergehenden Fehler';
$lang_new[$module_name]['EM505'] = 'Error 505: Das angeforderte HTTP-Protokol wird von uns nicht unterst&uuml;zt';
$lang_new[$module_name]['EMUNKNOWN'] = 'Es ist ein uns nicht bekannter Fehler aufgetreten.';
$lang_new[$module_name]['EMHOME'] = 'Zur&uuml;ck zur Hauptseite';
$lang_new[$module_name]['EMSORRY'] = 'Wir entschuldigen uns f&uuml;r die Probleme auf';
$lang_new[$module_name]['EMRECDATA'] = '<strong>Bemerkung:</strong> Wir haben die folgenden Daten gespeichert, um dem Problem auf die Spur zu kommen.';
$lang_new[$module_name]['EMDATETIME'] = 'Datum / Zeit';
$lang_new[$module_name]['EMSORT'] = 'Fehlertyp';
$lang_new[$module_name]['EMREF'] = 'Referer';
$lang_new[$module_name]['EMIP'] = 'IP Addresse';
$lang_new[$module_name]['EMURL'] = 'Fehler URL';
// Error Manager v2.1 Admin:
$lang_new[$module_name]['EMATITLE'] = 'Fehlerseiten';
$lang_new[$module_name]['EMABACKMAIN'] = 'Zur&uuml;ck zur Hauptadministration';
$lang_new[$module_name]['EMALIST'] = 'Die folgenden Fehler sind auf Deiner Seite aufgetreten';
$lang_new[$module_name]['EMADELALL'] = 'Alle l&ouml;schen';
$lang_new[$module_name]['EMADEL'] = 'Fehlereintrag l&ouml;schen';
$lang_new[$module_name]['EMADELETED'] = 'Der Fehler wurde aus der Datenbank gel&ouml;scht';
$lang_new[$module_name]['EMABACK'] = 'Zur&uuml;ck zur Fehlerseiten Administration';
$lang_new[$module_name]['EMADELETEDALL'] = 'Alle Fehlereintr&auml;ge wurden aus der Datenbank gel&ouml;scht';
$lang_new[$module_name]['EMCONFIG'] = 'Einstellungen';
$lang_new[$module_name]['EMSHOWERRORS'] = 'Fehler anzeigen';
$lang_new[$module_name]['EALOGERRORS'] = 'Die Fehler in der Datenbank speichern?';
$lang_new[$module_name]['EASHOWIMAGE'] = 'Bild zeigen?';
$lang_new[$module_name]['EASHOWMODULBLOCKS'] = 'Rechte Bl&ouml;cke zeigen?';
$lang_new[$module_name]['EASHOWINFOSAVED'] = 'Dem Besucher mitteilen, dass die Information gespeichert wurde?<br />(nur sinnvoll wenn \'Die Fehler in der Datenbank speichern?\' eingeschaltet ist)';
$lang_new[$module_name]['TOTALERRORS'] = 'Gesamtanzahl an Fehlermeldungen auf Deiner Seite';
$lang_new[$module_name]['RESETCOUNTER'] = '(Z&auml;hler zur&uuml;cksetzen)';
$lang_new[$module_name]['EMADATETIME'] = 'Datum / Zeit';
$lang_new[$module_name]['EMASORT'] = 'Fehlertyp';
$lang_new[$module_name]['EMAREF'] = 'Referer';
$lang_new[$module_name]['EMAIP'] = 'IP Addresse';
$lang_new[$module_name]['EMAURL'] = 'Fehler URL';
$lang_new[$module_name]['SAVECHANGES'] = '&Auml;nderungen speichern';

?>