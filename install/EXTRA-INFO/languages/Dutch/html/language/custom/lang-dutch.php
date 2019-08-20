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

/*****[BEGIN]******************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/
define("_CANNOTCHANGEMODE", "Kan de Modus in het bestand (%s) niet veranderen");
define("_CANNOTOPENFILE", "Kan het bestand (%s) niet openenen");
define("_CANNOTWRITETOFILE", "Kan het bestand (%s) niet beschijven");
define("_CANNOTCLOSEFILE", "Kan het bestand  (%s) niet sluiten");
define("_SITECACHED", "Dze site is in het Cache geheugen opgenomen.");
define("_UPDATECACHE", "Klik hier  om de cache te actualiseren.");
/*****[END]********************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
define("_ERRORINVEMAIL","FOUT: ongeldige E-mail");
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/
define("_PERSISTENT","Automatisch aanmelden bij elk bezoek");
/*****[END]********************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/
define("_ADMINGROUPS","Groepen aanpassen");
define("_MVGROUPS","Alleen voor groepen");
define("_MVSUBUSERS","Alleen voor abbonees");
define("_WHATGRDESC","Aanzicht moet op: Alleen voor groepen gezet zijn ");
define("_WHATGROUPS","Welke Groepen");
define("_GRMEMBERSHIPS","Lidmaatschap groepen");
define("_GRNONE","geen");
/*****[END]********************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/
define("_ADMIN_BLOCK_TITLE","Snelle Navigatie");
define("_ADMIN_BLOCK_NUKE","Admin [Nuke-Evo]");
define("_ADMIN_BLOCK_FORUMS","Admin [Forum]");
define("_ADMIN_BLOCK_LOGOUT","Uitloggen");
define("_ADMIN_BLOCK_SETTINGS","Instellingen");
define("_ADMIN_BLOCK_BLOCKS","Blokken");
define("_ADMIN_BLOCK_MODULES","Modules");
define("_ADMIN_BLOCK_CNBYA","Gebruikers");
define("_ADMIN_BLOCK_MSGS","Berichten");
define("_ADMIN_BLOCK_MODULE_BLOCK","Module Blok");
define("_ADMIN_BLOCK_NEWS","Nieuws");
define("_ADMIN_BLOCK_LOGIN","Admin Aanmelding");
define("_ADMIN_BLOCK_WHO_ONLINE","Wie is online");
define("_ADMIN_BLOCK_OPTIMIZE_DB","DB optimaliseren");
define("_ADMIN_BLOCK_DOWNLOADS", "Downloads");
define("_ADMIN_BLOCK_EVO_USER", "Evolution gebruikersinfo");
define("_ADMIN_BLOCK_WEBLINKS","Weblinks");
define("_ADMIN_BLOCK_REVIEWS","Testbericht");
define("_ADMIN_BLOCK_SYSTEMINFO","System Info");
define("_ADMIN_BLOCK_ERRORLOG","Foutenlog");
define("_CACHE_ADMIN", "Cache");
define("_CACHE_CLEAR", "Cache legen");
define("_ADMIN_ID","Admin ID:");
define("_ADMIN_PASS","Wachtwoord:");
define("_ADMINISTRATION","Administratie");
define("_ADMIN_NO_MODULE_RIGHTS","U hebt geen administratierechten voor deze module");
/*****[END]********************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/
define("_URL_SLASH_ERR","Verwijder AUB het / teken aan het einde van uw ");
define("_URL_HTTP_ERR","Type http:// aan het begin van uw ");
define("_URL_NHTTP_ERR","Verwijder http:// aan het begin van uw ");
define("_URL_PHP_ERR","Verwijder de bestandsnaam aan het einde van uw ");
define("_URL_MODULE_FORUM_ERR","Verwijder /modules/Forums aan het einde van uw ");
/*****[END]********************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/

/*--FNA--*/

/*****[BEGIN]******************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/
define("_STORIES","Artikel");
define("_AWL","Web Links");
define("_ASUP","Supporter");
define("_AREV","Testbericht");
define("_ADOWN","Downloads");
define("_ABAN", "Banner");
define("_AWU", "Gebruiker");
define("_WAITUSERS", "Wachtend");
define("_BROKENDOWN","niet beschikbaar");
define("_BROKENLINKS","niet beschikbaar");
define("_BROKENREVIEWS","niet beschikbaar");
define("_MODREQDOWN","aanpassingen");
define("_MODREQLINKS","aanpassingen");
define("_MODREQREVIEWS","aanpassingen");
define("_WDOWNLOADS","Wachtend");
define("_WLINKS","Wachtend");
define("_WREVIEWS","Wachtend");
define("_ABANNERS", "Actief");
define("_DBANNERS", "Inactief");
define("_WSUPPORT", "Wachtend");
define("_DSUPPORT", "Inactief");
define("_ASUPPORT", "Actief");
/*****[END]********************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/
define("_NEED_DELETE","Verwijder AUB");
define("_IS_DELETED","Volgende bestands/omschrijving is verwijderd");
define("_THE_FOLDER","de omschrijving");
/*****[END]********************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/
define("_PASS_CONFIRM","Wachtwoord bevestigen");
define("_ERROR","Fout");
define("_PASS_NOT_MATCH","Wachtwoorden komen niet overeen");
/*****[END]********************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Validation                         v1.0.0 ]
 ******************************************************/
define("VALIDATE_ERROR","De waarde %s in het veld %s is ongeldig");
define("VALIDATE_USERNAME","Gebruikersnaam");
define("VALIDATE_TEXT","Text");
define("VALIDATE_FULLNAME","volledige Naam");
define("VALIDATE_NUMBER","Nummer");
define("VALIDATE_EMAIL","E-mail");
define("VALIDATE_URL","URL");
define("VALIDATE_INT","Nummer");
define("VALIDATE_FLOAT","Nummer");
define("VALIDATE_SHORT","kort");
define("VALIDATE_LONG","lang");
define("VALIDATE_SMALL","klein");
define("VALIDATE_BIG","groot");
define("VALIDATE_TEXT_SIZE","De waarde %s in het veld %s is ongeldig<br />Er zijn dringend %s tekens noodzakelijk");
define("VALIDATE_NUMBER_SIZE","De waarde %s in het veld %s in ongeldig<br />Het dient minstens %s zijn");
define("VALIDATE_WORD","Het ingevooerde woord %s is niet toegestaan");
/*****[END]********************************************
 [ Other:  Validation                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
define("PSM_HELP_TITLE","Hulp voor een sterk wachtwoord");
define("PSM_NOTRATED","Niet geklasseerd");
define("PSM_CURRENTSTRENGTH","Actuele bescherminggraad: ");
define("PSM_WEAK","Zwak");
define("PSM_MED","Middel");
define("PSM_STRONG","Goed");
define("PSM_STRONGER","Beter");
define("PSM_STRONGEST","Zeer goed");
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

/*--FNL--*/

/*--CalendarMx--*/

/*****[BEGIN]******************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/
define("_NOSURVEYS","Op dit moment zijn er geen actieve pool voor handen");
/*****[END]********************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
define("_NORSS", "Het RSS bestand, dat u probeerde te laden bestaat niet!");
/*****[END]********************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
define('_COLLAPSE','Dynamische Blocken ?');
define('_COLLAPSE_TITLE','Titel');
define('_COLLAPSE_ICON','Icoon');
define('_COLLAPSE_START','Moeten de blocken in het begin geopend zijn?');
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
******************************************************/

define('_QUERIES','Queries:');
define('_DB_TIME','DB Acces Tijd:');
define('_PAGEFOOTER','[ '._PAGEGENERATION.' %s '._SECONDS.' | '._QUERIES.' %s ]');
define("_THEMES_QUNINSTALLED", "niet geinstalleerd");
define("_THEMES", "Themes");
define("_THEMES_DEFAULT", "Standaard theme");
define('_THEMES_THEME_MISSING', 'Theme niet beschikbaar');
define('_THEMES_ACTIVE', 'Aktief');
define('_THEMES_INACTIVE', 'Inaktief');
define('_ERROR_EMAIL', 'U hebt nog geen invoer in de website E-mail of forum E-mail');
define('_NICE_TRY', 'Leuk geprobeerd ....');
define('_OPTIMIZE_DB','Database geoptimaliseerd');
define('_MESSAGE_DIE_TITLE', 'Berichten centrale');

/*****[BEGIN]******************************************
 [ Base:    Log-Errors                         v1.0.0 ]
 ******************************************************/
define('_ERROR_LOG_GENERAL_ERROR','Algemene fout');
define('_ERROR_LOG_GENERAL_INFORMATION','Algemene Informatie');
define('_ERROR_LOG_CRITICAL_ERROR','Kritische Fout');
define('_ERROR_LOG_HACK_ATTEMPT','Hackerpoging');
define('_ERROR_LOG_SECURITY_BREACH','Beschermingsfout');
define('_ERROR_LOG_SCRIPT_ATTACK','Script Attack');
define('_ERROR_LOG_USER','Lid');
define('_ERROR_LOG_IP','IP');
define('_ERROR_LOG_INVALID_IP_YA','gebruikte een ongeldige IP-Adresse voor een aanval op het Administratiegedeelte');
define('_ERROR_LOG_INVALID_IP_FORUM','gebruikte een ongeldige IP-Adresse voor een aanval op het Forumadministratie');
define('_ERROR_LOG_INVALID_IP_ADMIN','gebruikte een ongeldige IP-Adresse voor een aanval op het Administratiegedeelte');
define('_ERROR_LOG_BLOCKED_HTML_TAG_TEXT','Er is geprobeerd een niet toegestane HTML Tag in te voegen.');
define('_ERROR_LOG_BLOCKED_HTML_TAG_STRING','Gegevens gebande:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_SOURCE','Herkomst:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_ECHOMSG','is een  XSS en werd geblokt in:');
define('_ERROR_LOG_THEME_MISSING_1','Uw standaard theme is niet voorhanden!');
define('_ERROR_LOG_THEME_MISSING_2','is niet gevonden!');
define('_ERROR_LOG_GOD_ADMIN_CREATED','Een God Administrator is aangemaakt:');
define('_ERROR_LOG_WRONG_MODUL_PATH','Er werd een ongeldige module path gebruikt');
define('_ERROR_LOG_WRONG_ADMIN_ACCOUNT','Probeerd werd een aanmelding met');
define('_ERROR_LOG_ADMIN_NO_USERNAME','Geprobeerde werd een aanmelding zonder gebruikernaam');
define('_ERROR_LOG_ADMIN_NO_PASSWORD','Geprobeerde werd een aanmelding zonder wachtwoord');
define('_ERROR_LOG_ADMIN_NO_USER_PASSWORD','Geprobeerde werd een aanmelding zonder gebruikersnaam of wachtwoord');
define('_ERROR_LOG_BUT_FAILED','is niet gelukt');
define('_ERROR_LOG_INTRUDER_ALERT','veroorzaakte een hacker alarm');
/*****[END]********************************************
 [ Base:    Log-Errors                         v1.0.0 ]
******************************************************/
define('EVO_TOOLTIP_INFO', 'Info...');
define('EVO_TOOLTIP_ALERT', 'Alarm...');
define('EVO_TOOLTIP_WIKI', 'Wiki...');
define('EVO_TOOLTIP_MSN', 'MSN...');

?>