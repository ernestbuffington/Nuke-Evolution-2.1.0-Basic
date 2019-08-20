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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Cookie Einstellungen';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Cookie Einstellungen f&uuml;r diese Webseite';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Cookie Optionen';

$lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO'] = 'Hier kannst Du einstellen, wie Cookies zum Browser gesendet werden. Meistens stimmen die Standardeinstellungen. Solltest Du sie &auml;ndern m&uuml;ssen, tue es mit Bedacht, ansonsten kann sich niemand mehr einloggen.';
$lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO_USER'] = 'Benutzerspezifische Cookie-Einstellungen';

$lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN'] = 'Cookie Domain';
$lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN_HELP'] = 'Wenn Nuke Evolution im Hauptverzeichnis der Domain installiert ist z.B. http://www.meineseite.de oder http://meineseite.de, dann muss als Cookie Domain .meineseite.de eingetragen werden (beachte den Punkt vor der Domain). Wenn die Seite in einer Subdomain wie http://evo.meineseite.de installiert ist, dann ist evo.meineseite.de als Cookie Domain anzugeben. Wenn in einem Unterverzeichnis wie http://www.meineseite.de/evo/ installiert wurde, dann lautet die Cookie Domain www.meineseite.de';
$lang_admin[$settingspoint]['FIELD_COOKIE_PATH'] = 'Cookie Pfad';
$lang_admin[$settingspoint]['FIELD_COOKIE_PATH_HELP'] = 'Wenn Nuke Evolution im Hauptverzeichnis einer Domain wie http://www.meineseite.de oder http://meineseite.de installiert ist, oder in einer Subdomain wie http://evo.meineseite.de, dann muss der Cookie Pfad / lauten. Ist die Seite in einem Unterverzeichnis wie http://www.meineseite.de/evo/ installiert lautet der korrekte Cookie Pfad hingegen /evo (beachte, dass kein / am Ende angegeben werden darf).';
$lang_admin[$settingspoint]['FIELD_COOKIE_NAME'] = 'Cookie Name';
$lang_admin[$settingspoint]['FIELD_COOKIE_NAME_HELP'] = 'In allen F&auml;llen muss der Cookie Name exakt dem Domain Namen ohne Suffix entsprechen. Ist Deine Domain z.B. http://www.meineseite.de, http://meineseite.de oder http://evo.meineseite.de, dann muss der Cookie Name meineseite lauten, auch wenn Nuke Evolution in einem Unterverzeichnis installiert ist.';
$lang_admin[$settingspoint]['FIELD_COOKIE_SECURE'] = 'Aktiviere sichere Cookies (https)';
$lang_admin[$settingspoint]['FIELD_COOKIE_SECURE_HELP'] = 'Der Webserver muss daf&uuml;r vorbereitet sein HTTPS Verbindungen zu akzeptieren, wenn sichere Cookies verwendet werden sollen.';
$lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH'] = 'Sitzungsdauer in Sekunden';
$lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH_HELP'] = 'Hier kann eingestellt werden, wie lange eine Sitzung (Session) g&uuml;ltig ist. Die Angabe muss in Sekunden erfolgen. Voreinstellung ist 3600.';
$lang_admin[$settingspoint]['FIELD_COOKIE_CHECK'] = 'Cookiepr&uuml;fung aktivieren';
$lang_admin[$settingspoint]['FIELD_COOKIE_CHECK_HELP'] = 'Pr&uuml;fung ob der Browser Cookies akzeptiert.';
$lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER'] = 'Cookiel&ouml;schung aktivieren';
$lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER_HELP'] = 'Zeigt die Option, alle Cookies dieser Seite zu l&ouml;schen.';
$lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY'] = 'Erlaubte Dauer der Inaktivit&auml;t auf einer Seite';
$lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY_HELP'] = 'Dauer f&uuml;r die ein Mitglied angemeldet bleibt, wenn dieser inaktiv ist.';
$lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME'] = 'Lebensdauer der Cookies';
$lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME_HELP'] = 'Nach der eingestellten Zeit verfallen die Cookies und werden vom Browser automatisch gel&ouml;scht.';

$lang_admin[$settingspoint]['OPTION_COOKIE_LOGOUT'] = 'Beim Schliessen des Fensters abmelden';
$lang_admin[$settingspoint]['OPTION_COOKIE_BLOCK'] = 'Anmeldungen blockieren';
$lang_admin[$settingspoint]['OPTION_COOKIE_SECONDS'] = 'Sekunden';
$lang_admin[$settingspoint]['OPTION_COOKIE_MINUTE'] = 'Minute';
$lang_admin[$settingspoint]['OPTION_COOKIE_MINUTES'] = 'Minuten';
$lang_admin[$settingspoint]['OPTION_COOKIE_HOUR'] = 'Stunde';
$lang_admin[$settingspoint]['OPTION_COOKIE_HOURS'] = 'Stunden';
$lang_admin[$settingspoint]['OPTION_COOKIE_DAY'] = 'Tag';
$lang_admin[$settingspoint]['OPTION_COOKIE_DAYS'] = 'Tage';
$lang_admin[$settingspoint]['OPTION_COOKIE_WEEK'] = 'Woche';
$lang_admin[$settingspoint]['OPTION_COOKIE_WEEKS'] = 'Wochen';
$lang_admin[$settingspoint]['OPTION_COOKIE_MONTH'] = 'Monat';
$lang_admin[$settingspoint]['OPTION_COOKIE_MONTHS'] = 'Monate';
$lang_admin[$settingspoint]['OPTION_COOKIE_INDEFINITE'] = 'Unendlich';
$lang_admin[$settingspoint]['OPTION_COOKIE_AUTOMATIC'] = 'Automatisch Abmelden beim ersten Seitenaufruf';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

?>