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
$lang_new[$module_name]['EM203'] = 'Error 203: De toegezonde informatie in de header is niet van de orginele site !!';
$lang_new[$module_name]['EM204'] = 'Error 204: U heeft op een lege link geklikt (zonder URL). Neem contact op met onze webmaster.';
$lang_new[$module_name]['EM205'] = 'Error 205: De toegezonde header is bij ons niet toegestaan !!';
$lang_new[$module_name]['EM300'] = 'Error 300: De gevraagde informatie niet duidelijk kunnen worden toegewezen.';
$lang_new[$module_name]['EM301'] = 'Error 301: Het gevraagde adres is permanent doorgeschakeld.';
$lang_new[$module_name]['EM302'] = 'Error 302: Het gevraagde adres is tijdelijk doorgeschakeld.';
$lang_new[$module_name]['EM303'] = 'Error 303: Het gevraagde adres werd doorgeschakeld - wij zullen deze omleiding niet volgen.';
$lang_new[$module_name]['EM304'] = 'Error 304: Wij staan geen verzoeken toe na de aanpassingstijd ';
$lang_new[$module_name]['EM400'] = 'Error 400: In het ontvangen verzoek is een syntaxfout.';
$lang_new[$module_name]['EM401'] = 'Error 401: Het verzoek bevat niet de nodige verificatie-informatie. Toegang niet toegestaan.';
$lang_new[$module_name]['EM402'] = 'Error 402: De toegang van het opgevraagde adres is alleen voor betalen leden toegestaan.';
$lang_new[$module_name]['EM403'] = 'Error 403: Wij kunnen het verzoek nu niet bewerken. Probeer het later nog eens.';
$lang_new[$module_name]['EM404'] = 'Error 404: Wij kunnen het opgegeven adres niet op onze server vinden. Misschien een schrijffout ?';
$lang_new[$module_name]['EM405'] = 'Error 405: Uw toegangswijze is niet toegestaan.';
$lang_new[$module_name]['EM406'] = 'Error 406: Uw systeem is niet hiervoor geconfigueerd het opgevraagdr adres te ontvangen';
$lang_new[$module_name]['EM407'] = 'Error 407: De opgevraagde toegang moet eerst worden toegestaan.';
$lang_new[$module_name]['EM408'] = 'Error 408: Er is heeft een tijdsoverschrijding plaatsgevonden. Probeer het later nogmaals';
$lang_new[$module_name]['EM409'] = 'Error 409: Te veel gelijktijdige verzoeken - Probeer het later nogmaals';
$lang_new[$module_name]['EM410'] = 'Error 410: Het opgevraagde adres is niet beschikbaar';
$lang_new[$module_name]['EM411'] = 'Error 411: in uw verzoek ontbreekt de vereiste informatie in de header';
$lang_new[$module_name]['EM412'] = 'Error 412: Uw client is hiervoor niet geconfigureerd om de gevraagde informatie te verkrijgen';
$lang_new[$module_name]['EM413'] = 'Error 413: Het gevraagde bestand is te groot om te kunnen worden verzonden';
$lang_new[$module_name]['EM414'] = 'Error 414: Het gevraagde bestand kon niet bewerkt worden';
$lang_new[$module_name]['EM415'] = 'Error 415: Het gevraagde bestand kon niet bewerkt worden';
$lang_new[$module_name]['EM500'] = 'Error 500: Interne server Fout - Probeer het later nogmaals';
$lang_new[$module_name]['EM501'] = 'Error 501: Het gevraagde adres kan door de server niet bewerkt worden';
$lang_new[$module_name]['EM502'] = 'Error 502: De gevraagde server stuurt een permanente Error';
$lang_new[$module_name]['EM503'] = 'Error 503: Het gevraagde adres is tijdelijk niet bereikbaar';
$lang_new[$module_name]['EM504'] = 'Error 504: De gateway stuurt een tijdelijke fout';
$lang_new[$module_name]['EM505'] = 'Error 505: De gevraagde HTTP-protocol wordt niet ondersteund door ons';
$lang_new[$module_name]['EMUNKNOWN'] = 'Er is bij ons een onbekende fout opgetreden.';
$lang_new[$module_name]['EMHOME'] = 'Terug naar de hoofdpagina';
$lang_new[$module_name]['EMSORRY'] = 'Onze excuses voor de problemen op';
$lang_new[$module_name]['EMRECDATA'] = '<strong>Opmerking:</strong> Wij hebben de volgende bestanden opgeslagen om het probleem op te kunnen sporen.';
$lang_new[$module_name]['EMDATETIME'] = 'Datum / Tijd';
$lang_new[$module_name]['EMSORT'] = 'Type fout';
$lang_new[$module_name]['EMREF'] = 'Referer';
$lang_new[$module_name]['EMIP'] = 'IP Addres';
$lang_new[$module_name]['EMURL'] = 'URL fout';
// Error Manager v2.1 Admin:
$lang_new[$module_name]['EMATITLE'] = 'Foutpaginas';
$lang_new[$module_name]['EMABACKMAIN'] = 'Terug naar de hoofdpagina';
$lang_new[$module_name]['EMALIST'] = 'De volgende fout is op uw pagina opgetreden';
$lang_new[$module_name]['EMADELALL'] = 'Alles wissen';
$lang_new[$module_name]['EMADEL'] = 'Foutmelding wissen';
$lang_new[$module_name]['EMADELETED'] = 'De fout werd uit de database verwijderd';
$lang_new[$module_name]['EMABACK'] = 'Terug naar de foutpagina administratie';
$lang_new[$module_name]['EMADELETEDALL'] = 'Alle foutmeldingen werden uit de database verwijderd';
$lang_new[$module_name]['EMCONFIG'] = 'Instellingen';
$lang_new[$module_name]['EMSHOWERRORS'] = 'Fout weergeven';
$lang_new[$module_name]['EALOGERRORS'] = 'De fout in de database opslaan?';
$lang_new[$module_name]['EASHOWIMAGE'] = 'Afbeelding weergeven?';
$lang_new[$module_name]['EASHOWMODULBLOCKS'] = 'Rechter blokken weergeven?';
$lang_new[$module_name]['EASHOWINFOSAVED'] = 'De bezoeker meedelen dat die informatie opgeslagen werd?<br />(Alleen zinvol als \'Fout in de database opslaan\' ingeschakeld is)';
$lang_new[$module_name]['TOTALERRORS'] = 'Totaal aantal foutmeldingen op uw pagina';
$lang_new[$module_name]['RESETCOUNTER'] = '(Teller terugzetten)';
$lang_new[$module_name]['EMADATETIME'] = 'Datum / Tij';
$lang_new[$module_name]['EMASORT'] = 'Type fout';
$lang_new[$module_name]['EMAREF'] = 'Referer';
$lang_new[$module_name]['EMAIP'] = 'IP Addres';
$lang_new[$module_name]['EMAURL'] = 'URL fout';
$lang_new[$module_name]['SAVECHANGES'] = 'Wijzigingen opslaan';

?>