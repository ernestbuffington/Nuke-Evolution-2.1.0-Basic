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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Cookie Instellingen';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Cookie instellingen voor deze website';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Cookie Opties';

$lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO'] = 'Hier kunt u instellen hoe de Cookies naar de Browser gestuurd worden. Meestal kloppen de standaard instellingen wel. Wilt u deze wel wijzigen doe dit dan voorzichtig anders kan er geen mens meer inloggen.';
$lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO_USER'] = 'Gebruikers gespecificeerde Cookie-instellingen';

$lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN'] = 'Cookie Domain';
$lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN_HELP'] = '|Als Nuke Evolution in de root van uw domein geinstalleerd is zoals bijv. http://www.mijnpagina.nl of http://mijnpagina.nl, dan moet als Cookie Domain .mijnpagina.nl ingevoerd worden (let op de puntvoor uw domeinnaam). Als de pagina in een subdomain is zoals bijv http://evo.mijnpagina.nl geinstalleerd is dan is evo.mijnpagina.nl als Cookie Domain in te voeren. Als het path bijv.: http://www.mijnpagina.nl/evo/ is, dan is het Cookie Domain www.mijnpagina.nl';
$lang_admin[$settingspoint]['FIELD_COOKIE_PATH'] = 'Cookie Path';
$lang_admin[$settingspoint]['FIELD_COOKIE_PATH_HELP'] = 'Als Nuke Evolution in de root van uw domein zoals http://www.mijnpagina.nl of http://mijnpagina.nl geinstalleerd is, of in een subdomein zoals bijv.: http://evo.mijnpagina.nl, dan moet het Cookie path / wezen. Is uw pagina in een map geinstalleerd zoals bijv.: http://www.mijnpagina.nl/evo/ dan luid het correcte Cookie path /evo (let er op dat er geen / aan het einde staat).';
$lang_admin[$settingspoint]['FIELD_COOKIE_NAME'] = 'Cookie Naam';
$lang_admin[$settingspoint]['FIELD_COOKIE_NAME_HELP'] = 'In alle gevallen moet de Cookie Naam exact de Domain Naam zonder Suffix zijn. Is uw domein bijv.: http://www.mijnpagina.nl, http://mijnpagina.nl of http://evo.mijnpagina.nl, dan moet de  Cookie naam mijnpagina wezen, ook als Nuke Evolution in een map geinstalleerd is.';
$lang_admin[$settingspoint]['FIELD_COOKIE_SECURE'] = 'Activeer veilige Cookies (https)';
$lang_admin[$settingspoint]['FIELD_COOKIE_SECURE_HELP'] = 'Als veilige Coockies gebruikt worden dient ww webserver hier voor geschikt zijn om HTTPS verbindingen te accepteren.';
$lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH'] = 'Sessie lengte in seconden';
$lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH_HELP'] = 'Hier kan ingesteld worden, hoe lang een  sessie geldig is. Deze invoer dient in seconden te zijn. Standaard is 3600.';
$lang_admin[$settingspoint]['FIELD_COOKIE_CHECK'] = 'Cookie controle activeren';
$lang_admin[$settingspoint]['FIELD_COOKIE_CHECK_HELP'] = 'Controle van de Browser Cookies accepteren.';
$lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER'] = 'Wissen van Cookie activeren';
$lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER_HELP'] = 'Geeft de optie weer, alle Cookies deze pagina te wissen.';
$lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY'] = 'Staat toe lange tijd op deze pagina inactief te wezen';
$lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY_HELP'] = 'Duur van een lid dat deze aangemeld blijft tijdens inactiviteit.';
$lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME'] = 'Levensduur van de Cookies';
$lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME_HELP'] = 'Na de ingestelde tijd vervallende Cookies en worden door de Browser automatisch gewist.';

$lang_admin[$settingspoint]['OPTION_COOKIE_LOGOUT'] = 'Bij sluiten venster afmelden';
$lang_admin[$settingspoint]['OPTION_COOKIE_BLOCK'] = 'Aanmelding blokkeren';
$lang_admin[$settingspoint]['OPTION_COOKIE_SECONDS'] = 'Seconden';
$lang_admin[$settingspoint]['OPTION_COOKIE_MINUTE'] = 'Minuut';
$lang_admin[$settingspoint]['OPTION_COOKIE_MINUTES'] = 'Minuten';
$lang_admin[$settingspoint]['OPTION_COOKIE_HOUR'] = 'Uur';
$lang_admin[$settingspoint]['OPTION_COOKIE_HOURS'] = 'Uren';
$lang_admin[$settingspoint]['OPTION_COOKIE_DAY'] = 'Dag';
$lang_admin[$settingspoint]['OPTION_COOKIE_DAYS'] = 'Dagen';
$lang_admin[$settingspoint]['OPTION_COOKIE_WEEK'] = 'Week';
$lang_admin[$settingspoint]['OPTION_COOKIE_WEEKS'] = 'Weken';
$lang_admin[$settingspoint]['OPTION_COOKIE_MONTH'] = 'Maand';
$lang_admin[$settingspoint]['OPTION_COOKIE_MONTHS'] = 'Maanden';
$lang_admin[$settingspoint]['OPTION_COOKIE_INDEFINITE'] = 'Oneindig';
$lang_admin[$settingspoint]['OPTION_COOKIE_AUTOMATIC'] = 'Automatisch afmelden bij eerste pagina oproep';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Geen invoerfout voor '.$settingspoint.' beschikbaar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Opslaan';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Terug';

?>