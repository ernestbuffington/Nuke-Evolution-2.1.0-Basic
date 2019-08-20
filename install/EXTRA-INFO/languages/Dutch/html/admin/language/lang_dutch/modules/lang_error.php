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

$lang_admin[$adminpoint]['EM203'] = 'Error 203: De informatie in de header entiteit is niet van de oorspronkelijke site, maar vanaf derde partij server';
$lang_admin[$adminpoint]['EM204'] = 'Error 204: U hebt geklikt op de link, zonder een doel. Dit is een waarschuwing !!';
$lang_admin[$adminpoint]['EM205'] = 'Error 205: Je stuurde een header we niet toestaan.';
$lang_admin[$adminpoint]['EM300'] = 'Error 300: Het gevraagde adres kan niet worden aangemerkt als een unieke.';
$lang_admin[$adminpoint]['EM301'] = 'Error 301: Het gevraagde adres is definitief verhuisd.';
$lang_admin[$adminpoint]['EM302'] = 'Error 302: Het gevraagde adres is tijdelijk verhuisd.';
$lang_admin[$adminpoint]['EM303'] = 'Error 303: De gevraagde adres is overal verplaatst - maar wij niet volgen deze niet';
$lang_admin[$adminpoint]['EM304'] = 'Error 304: Wij staan oproepen voor aanpassingen van tijd en adres op onze server niet toe';
$lang_admin[$adminpoint]['EM400'] = 'Error 400: Ongeldig verzoek - is er een syntax fout in het verzoek, en het is toegestaan';
$lang_admin[$adminpoint]['EM401'] = 'Error 401: Het verzoek header bevatten niet de noodzakelijke authenticatie codes. De toegang is geweigerd';
$lang_admin[$adminpoint]['EM402'] = 'Error 402: Voor toegang tot dit bestand is betaling vereist';
$lang_admin[$adminpoint]['EM403'] = 'Error 403: We kunnen niet voldoen aan uw verzoek. Probeer het later nog eens.';
$lang_admin[$adminpoint]['EM404'] = 'Error 404: Het gevraagde adres is niet aanwezig op deze server. Misschien heb je de URL verkeerd gespeld ?';
$lang_admin[$adminpoint]['EM405'] = 'Error 405: De methode die u gebruikt om het bestand te openen is niet toegestaan';
$lang_admin[$adminpoint]['EM406'] = 'Error 406: Uw cliënt is niet geconfigureerd om het gewenste adres te ontvangen';
$lang_admin[$adminpoint]['EM407'] = 'Error 407: Uw aanvraag moet eerst worden goedgekeurd voordat het kan plaatsvinden';
$lang_admin[$adminpoint]['EM408'] = 'Error 408: Aanvraag timeout - Probeer het later te proberen';
$lang_admin[$adminpoint]['EM409'] = 'Error 409: Te veel gelijktijdige aanvragen - Probeer het later opnieuw';
$lang_admin[$adminpoint]['EM410'] = 'Error 410: Het gevraagde adres is niet beschikbaar.';
$lang_admin[$adminpoint]['EM411'] = 'Error 411: Uw aanvraag wordt een aantal ontbrekende header informatie';
$lang_admin[$adminpoint]['EM412'] = 'Error 412: Uw cliënt is niet geconfigureerd om de gevraagde informatie te ontvangen.';
$lang_admin[$adminpoint]['EM413'] = 'Error 413: Het gevraagde bestand is te groot om te verwerken';
$lang_admin[$adminpoint]['EM414'] = 'Error 414: Het gevraagde adres niet in het juiste formaat voor deze server.';
$lang_admin[$adminpoint]['EM415'] = 'Error 415: Het bestandstype van het verzoek wordt niet ondersteund.';
$lang_admin[$adminpoint]['EM500'] = 'Error 500: Interne serverfout - Probeer het later opnieuw';
$lang_admin[$adminpoint]['EM501'] = 'Error 501: Het verzoek kan niet worden uitgevoerd door de server';
$lang_admin[$adminpoint]['EM502'] = 'Error 502: Bad Gateway - de server die u probeerd te bereiken stuurt fouten terug.';
$lang_admin[$adminpoint]['EM503'] = 'Error 503: Tijdelijk niet beschikbaar.';
$lang_admin[$adminpoint]['EM504'] = 'Error 504: The Gateway heeft een timed out.';
$lang_admin[$adminpoint]['EM505'] = 'Error 505: Het HTTP-protocol word niet ondersteund.';
$lang_admin[$adminpoint]['EMDATETIME'] = 'Datum / Tijd';
$lang_admin[$adminpoint]['EMHOME'] = 'Terug naar de homapagina';
$lang_admin[$adminpoint]['EMIP'] = 'IP Addres';
$lang_admin[$adminpoint]['EMRECDATA'] = '<strong>TIP:</strong> Wij heeben de volgende gegevens om het probleem te traceren.';
$lang_admin[$adminpoint]['EMREF'] = 'Referer';
$lang_admin[$adminpoint]['EMSORRY'] = 'Onze excuses voor eventuele problemen';
$lang_admin[$adminpoint]['EMSORT'] = 'Sort fouten';
$lang_admin[$adminpoint]['EMUNKNOWN'] = 'Fout onbekend: Er kwam een fout voor die we niet herkennen';
$lang_admin[$adminpoint]['EMURL'] = 'URL fout';

// Error Manager v2.1 Admin:
$lang_admin[$adminpoint]['EALOGERRORS'] = 'Deze fouten in de database opslaan?';
$lang_admin[$adminpoint]['EASHOWIMAGE'] = 'Afbeelding weergeven?';
$lang_admin[$adminpoint]['EASHOWINFOSAVED'] = 'Vertel de bezoeker dat de info wordt gelogd?<br />(alleen te gebruiken als \'fouten in de database opslaan\' ingeschakeld is)';
$lang_admin[$adminpoint]['EASHOWMODULBLOCKS'] = 'Blokken weergeven??';
$lang_admin[$adminpoint]['EMABACK'] = 'Terug naar fouten administratie';
$lang_admin[$adminpoint]['EMABACKMAIN'] = 'Terug naar hoofdmenu';
$lang_admin[$adminpoint]['EMADATETIME'] = 'Datum / Tijd';
$lang_admin[$adminpoint]['EMADEL'] = 'Fout verwijderen';
$lang_admin[$adminpoint]['EMADELALL'] = 'Alles verwijderen';
$lang_admin[$adminpoint]['EMADELETED'] = 'De fout is uit de database verwijderd';
$lang_admin[$adminpoint]['EMADELETEDALL'] = 'Alle fouten zijn uit de database verwijderd';
$lang_admin[$adminpoint]['EMAIP'] = 'IP Addres';
$lang_admin[$adminpoint]['EMALIST'] = 'De volgende fouten zijn op uw pagina gevonden';
$lang_admin[$adminpoint]['EMAREF'] = 'Referer';
$lang_admin[$adminpoint]['EMASORT'] = 'Sort fouten';
$lang_admin[$adminpoint]['EMATITLE'] = 'Fout';
$lang_admin[$adminpoint]['EMAURL'] = 'URL fout';
$lang_admin[$adminpoint]['EMCONFIG'] = 'Instellingen';
$lang_admin[$adminpoint]['EMSHOWERRORS'] = 'Fouten weergeven';
$lang_admin[$adminpoint]['ERROR_BLOCKS_BOTH'] = 'Beide blokken';
$lang_admin[$adminpoint]['ERROR_BLOCKS_LEFT'] = 'Linker blokken';
$lang_admin[$adminpoint]['ERROR_BLOCKS_NONE'] = 'Geen';
$lang_admin[$adminpoint]['ERROR_BLOCKS_RIGHT'] = 'Rechter blokken';

$lang_admin[$adminpoint]['RESETCOUNTER'] = '(Reset teller)';

$lang_admin[$adminpoint]['SAVECHANGES'] = 'wijziging opslaan';

$lang_admin[$adminpoint]['TOTALERRORS'] = 'Totale aantal fouten op uw nuke site';

?>