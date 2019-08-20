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
define("_CANNOTCHANGEMODE", "Kann den Modus der Datei (%s) nicht &auml;ndern");
define("_CANNOTOPENFILE", "Kann die Datei (%s) nicht &ouml;ffnen");
define("_CANNOTWRITETOFILE", "Kann nicht in die Datei (%s) schreiben");
define("_CANNOTCLOSEFILE", "Kann die Datei (%s) nicht schliessen");
define("_SITECACHED", "Diese Seite ist im Cachespeicher aufgenommen.");
define("_UPDATECACHE", "Klicke hier um den Cache zu aktualisieren.");
/*****[END]********************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
define("_ERRORINVEMAIL","FEHLER: ung&uuml;ltige eMail");
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/
define("_PERSISTENT","Automatische Anmeldung bei jedem Besuch");
/*****[END]********************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/
define("_ADMINGROUPS","Gruppen &auml;ndern");
define("_MVGROUPS","Nur f&uuml;r Gruppen");
define("_MVSUBUSERS","Nur f&uuml;r Abonnenten");
define("_WHATGRDESC","Ansicht muss gesetzt sein auf: nur f&uuml;r Gruppen ");
define("_WHATGROUPS","Welche Gruppen");
define("_GRMEMBERSHIPS","Gruppen Mitgliedschaft");
define("_GRNONE","Keine");
/*****[END]********************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/
define("_ADMIN_BLOCK_TITLE","Quick Navigation");
define("_ADMIN_BLOCK_NUKE","Admin [Nuke-Evo]");
define("_ADMIN_BLOCK_FORUMS","Admin [Forum]");
define("_ADMIN_BLOCK_LOGOUT","Abmelden");
define("_ADMIN_BLOCK_SETTINGS","Einstellungen");
define("_ADMIN_BLOCK_BLOCKS","Bl&ouml;cke");
define("_ADMIN_BLOCK_MODULES","Module");
define("_ADMIN_BLOCK_CNBYA","Benutzer");
define("_ADMIN_BLOCK_MSGS","Nachrichten");
define("_ADMIN_BLOCK_MODULE_BLOCK","Modul Block");
define("_ADMIN_BLOCK_NEWS","News");
define("_ADMIN_BLOCK_LOGIN","Admin Anmeldung");
define("_ADMIN_BLOCK_WHO_ONLINE","Wer ist online");
define("_ADMIN_BLOCK_OPTIMIZE_DB","DB optimieren");
define("_ADMIN_BLOCK_DOWNLOADS", "Downloads");
define("_ADMIN_BLOCK_EVO_USER", "Evolution UserInfo");
define("_ADMIN_BLOCK_WEBLINKS","Weblinks");
define("_ADMIN_BLOCK_REVIEWS","Testberichte");
define("_ADMIN_BLOCK_SYSTEMINFO","System Info");
define("_ADMIN_BLOCK_ERRORLOG","Fehlerlog");
define("_CACHE_ADMIN", "Cache");
define("_CACHE_CLEAR", "Cache leeren");
define("_ADMIN_ID","Admin ID:");
define("_ADMIN_PASS","Kennwort:");
define("_ADMINISTRATION","Administration");
define("_ADMIN_NO_MODULE_RIGHTS","Du hast keine Administrationsrechte f&uuml;r das Modul");
/*****[END]********************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/
define("_URL_SLASH_ERR","Bitte entfernde das Zeichen / am Ende Deiner ");
define("_URL_HTTP_ERR","Bitte gebe http:// am Anfang Deiner ");
define("_URL_NHTTP_ERR","Bitte entferne http:// am Beginn Deiner ");
define("_URL_PHP_ERR","Bitte entferne den Dateinamen am Ende Deiner ");
define("_URL_MODULE_FORUM_ERR","Bitte entferne /modules/Forums am Ende Deiner ");
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
define("_AREV","Testberichte");
define("_ADOWN","Downloads");
define("_ABAN", "Banner");
define("_AWU", "Benutzer");
define("_WAITUSERS", "Wartend");
define("_BROKENDOWN","nicht vorhanden");
define("_BROKENLINKS","nicht vorhanden");
define("_BROKENREVIEWS","nicht vorhanden");
define("_MODREQDOWN","&Auml;nderungen");
define("_MODREQLINKS","&Auml;nderungen");
define("_MODREQREVIEWS","&Auml;nderungen");
define("_WDOWNLOADS","Wartend");
define("_WLINKS","Wartend");
define("_WREVIEWS","Wartend");
define("_ABANNERS", "Aktiv");
define("_DBANNERS", "Inaktiv");
define("_WSUPPORT", "Wartend");
define("_DSUPPORT", "Inaktiv");
define("_ASUPPORT", "Aktiv");
/*****[END]********************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/
define("_NEED_DELETE","Bitte l&ouml;sche");
define("_IS_DELETED","Folgende Datei/Verzeichnis wurde gel&ouml;scht");
define("_THE_FOLDER","das Verzeichnis");
/*****[END]********************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/
define("_PASS_CONFIRM","Kennwort wiederholen");
define("_ERROR","Fehler");
define("_PASS_NOT_MATCH","Die beiden Kennw&ouml;rter stimmen nicht &uuml;berein");
/*****[END]********************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Validation                         v1.0.0 ]
 ******************************************************/
define("VALIDATE_ERROR","Der Wert %s der im Feld %s eingetragen wurde ist ung&uuml;ltig");
define("VALIDATE_USERNAME","Benutzername");
define("VALIDATE_TEXT","Text");
define("VALIDATE_FULLNAME","voller Name");
define("VALIDATE_NUMBER","Nummer");
define("VALIDATE_EMAIL","eMail");
define("VALIDATE_URL","URL");
define("VALIDATE_INT","Nummer");
define("VALIDATE_FLOAT","Nummer");
define("VALIDATE_SHORT","kurz");
define("VALIDATE_LONG","lang");
define("VALIDATE_SMALL","klein");
define("VALIDATE_BIG","gross");
define("VALIDATE_TEXT_SIZE","Der Wert %s der im Feld %s eingetragen wurde ist ung&uuml;ltig<br />Es sind zwingend %s Zeichen notwendig");
define("VALIDATE_NUMBER_SIZE","Der Wert %s der im Feld %s eingetragen wurde ist ung&uuml;ltig<br />Die Eingabe muss mindestens %s sein");
define("VALIDATE_WORD","Das eingegebene Wort in %s ist nicht erlaubt");
/*****[END]********************************************
 [ Other:  Validation                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
define("PSM_HELP_TITLE","Hilfe f&uuml;r die Passwort Sicherheit");
define("PSM_NOTRATED","Nicht eingestuft");
define("PSM_CURRENTSTRENGTH","Aktueller Sicherheitsgrad: ");
define("PSM_WEAK","Schwach");
define("PSM_MED","Mittel");
define("PSM_STRONG","Sicher");
define("PSM_STRONGER","Sicherer");
define("PSM_STRONGEST","Am sichersten");
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

/*--FNL--*/

/*--CalendarMx--*/

/*****[BEGIN]******************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/
define("_NOSURVEYS","Derzeit sind keine aktiven Umfragen vorhanden");
/*****[END]********************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
define("_NORSS", "Die RSS Datei, die Du versuchst zu laden, existiert nicht!");
/*****[END]********************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
define('_COLLAPSE','Dynamische Bl&ouml;cke ?');
define('_COLLAPSE_TITLE','Titel');
define('_COLLAPSE_ICON','Icon');
define('_COLLAPSE_START','Sollen die Bl&ouml;cke beim Start des Cookies aufgeklappt sein ?');
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
******************************************************/

define('_QUERIES','Queries:');
define('_DB_TIME','DB Access Time:');
define('_PAGEFOOTER','[ '._PAGEGENERATION.' %s '._SECONDS.' | '._QUERIES.' %s ]');
define("_THEMES_QUNINSTALLED", "nicht installiert");
define("_THEMES", "Themes");
define("_THEMES_DEFAULT", "Standardtheme");
define('_THEMES_THEME_MISSING', 'Theme nicht vorhanden');
define('_THEMES_ACTIVE', 'Aktive');
define('_THEMES_INACTIVE', 'Inaktive');
define('_ERROR_EMAIL', 'Du hast noch keinen Eintrag in der Webseiten Email oder Foren Email');
define('_NICE_TRY', 'Netter Versuch ....');
define('_OPTIMIZE_DB','Datenbank optimiert');
define('_MESSAGE_DIE_TITLE', 'Nachrichten Zentrale');

/*****[BEGIN]******************************************
 [ Base:    Log-Errors                         v1.0.0 ]
 ******************************************************/
define('_ERROR_LOG_GENERAL_ERROR','Genereller Fehler');
define('_ERROR_LOG_GENERAL_INFORMATION','Allgemeine Information');
define('_ERROR_LOG_CRITICAL_ERROR','Kritischer Fehler');
define('_ERROR_LOG_HACK_ATTEMPT','Angriffsversuch');
define('_ERROR_LOG_SECURITY_BREACH','Sicherheitsbruch');
define('_ERROR_LOG_SCRIPT_ATTACK','Script Attacke');
define('_ERROR_LOG_USER','Mitglied');
define('_ERROR_LOG_IP','IP');
define('_ERROR_LOG_INVALID_IP_YA','benutzte eine ung&uuml;tige IP-Adresse f&uuml;r den Zugriff zum YA Adminbereich');
define('_ERROR_LOG_INVALID_IP_FORUM','benutzte eine ung&uuml;tige IP-Adresse f&uuml;r den Zugriff zur Forenadministration');
define('_ERROR_LOG_INVALID_IP_ADMIN','benutzte eine ung&uuml;tige IP-Adresse f&uuml;r den Zugriff zur Administrationsebene');
define('_ERROR_LOG_BLOCKED_HTML_TAG_TEXT','Es wurde versucht, ein nicht erlaubtes HTML Tag einzuf&uuml;gen.');
define('_ERROR_LOG_BLOCKED_HTML_TAG_STRING','Geblockter Inhalt:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_SOURCE','Herkunft:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_ECHOMSG','ist ein XSS und wurde blockiert in:');
define('_ERROR_LOG_THEME_MISSING_1','Dein Default-Theme ist nicht vorhanden!');
define('_ERROR_LOG_THEME_MISSING_2','wurde NICHT gefunden!');
define('_ERROR_LOG_GOD_ADMIN_CREATED','Der God Administrator wurde angelegt:');
define('_ERROR_LOG_WRONG_MODUL_PATH','Es wurde ein ung&uuml;ltiger Modulpfad verwendet');
define('_ERROR_LOG_WRONG_ADMIN_ACCOUNT','Versuch einer Anmeldung mit');
define('_ERROR_LOG_ADMIN_NO_USERNAME','Versuch einer Anmeldung in den Administrationsbereich ohne Benutzername');
define('_ERROR_LOG_ADMIN_NO_PASSWORD','Versuch einer Anmeldung in den Administrationsbereich ohne Passwort');
define('_ERROR_LOG_ADMIN_NO_USER_PASSWORD','Versuch einer Anmeldung in den Administrationsbereich ohne Benutzername und Passwort');
define('_ERROR_LOG_BUT_FAILED','ist fehlgeschlagen');
define('_ERROR_LOG_INTRUDER_ALERT','Verursachte einen Einbruchsalarm');
/*****[END]********************************************
 [ Base:    Log-Errors                         v1.0.0 ]
******************************************************/

define('EVO_TOOLTIP_INFO', 'Info...');
define('EVO_TOOLTIP_ALERT', 'Alarm...');
define('EVO_TOOLTIP_WIKI', 'Wiki...');
define('EVO_TOOLTIP_MSN', 'MSN...');

?>