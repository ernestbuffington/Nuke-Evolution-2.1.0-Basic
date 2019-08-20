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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Erweiterte Einstellungen';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Erweiterte Einstellungen';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Erweiterte Einstellungsoptionen';

$lang_admin[$settingspoint]['FIELD_HTTPREF_ON'] = 'Speicherung der Referenzierungen zu uns aktivieren (HTTPReferer)';
$lang_admin[$settingspoint]['FIELD_HTTPREF_ON_HELP'] = 'Hier kann eingestellt werden, ob Refrenzierungen zu Deiner Website in der Datenbank gespeichert werden. Referenzierungen werden dann im Referer Block und in der Besucherherkunft angezeigt. Das Einschalten dieser Funktion kann zu einem verlangsamten Seitenaufbau f&uuml;hren.';
$lang_admin[$settingspoint]['FIELD_HTTPREF_MAX'] = 'Wieviele Referenzierungen sollen maximal gespeichert werden';
$lang_admin[$settingspoint]['FIELD_HTTPREF_MAX_HELP'] = 'Hier kann die maximale Anzahl an Referenzierungen angegeben werden, die in der Datenbank gespeichert werden. Voreinstellung ist 1000. Es sollte kein Wert gew&auml;hlt werden, der viel h&ouml;her liegt.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS'] = 'Kommentarfunktion in Umfragen aktivieren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS_HELP'] = 'Hier kann eingestellt werden, ob Kommentare zu Umfragen erlaubt sind oder nicht.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE'] = 'Kommentarfunktion in Artikeln aktivieren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE_HELP'] = 'Hier kann eingestellt werden, ob Kommentare zu Artikeln erlaubt sind oder nicht.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES'] = 'Individuelle RSS-Feeds f&uuml;r Benutzer aktivieren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES_HELP'] = 'Hier kann eingestellt werden, ob es registrierten Mitgliedern erlaubt ist individuelle RSS Feeds f&uuml;r ihr Konto zu definieren.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL'] = 'SSL-Zugriff f&uuml;r Administratoren aktivieren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL_HELP'] = 'Aktiviert das Secured Socket Layer Protokoll f&uuml;r Administratoren. SSL muss dazu auf dem Server installiert und aktiviert sein, um diese Funktion benutzen zu k&ouml;nnen.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT'] = 'Anzahl Datenbankzugriffe z&auml;hlen';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT_HELP'] = 'Aktiviert das Z&auml;hlen von Datenbankzugriffen und zeigt das Ergebnis in der Fu&szlig;zeile der Seite an.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE'] = 'Benutzer- und Gruppenfarben aktivieren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE_HELP'] = 'Hier kann eingestellt werden, ob die Namen registrierter Benutzer und Benutzergruppen farblich hervorgehoben angezeigt werden sollen.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN'] = 'Benutzer zur Anmeldung zwingen, bevor Sie etwas tun k&ouml;nnen';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN_HELP'] = 'Mit dieser Einstellung k&ouml;nnen Benutzer dazu gezwungen werden sich anzumelden, bevor sie etwas tun k&ouml;nnen.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS'] = 'Werbeanzeigen auf Deiner Seite aktivieren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS_HELP'] = 'Mit dieser Einstellung kann die Anzeige von Werbebannern aktiviert bzw. deaktiviert werden.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS'] = 'Aufklappbare Bl&ouml;cke aktivieren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS_HELP'] = 'Mit diesen Einstellungen kann die Funktion der klappbaren Bl&ouml;cke ein- und ausgeschaltet werden.';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN'] = 'Sollen die Bl&ouml;cke beim Start einer neuen Session aufgeklappt sein';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN_HELP'] = 'Diese Option auf JA setzen, wenn die Bl&ouml;cke zum Start einer neuen Session ge&ouml;ffnet angezeigt werden sollen und auf NEIN, wenn geschlossen.';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE'] = 'Durch welches Symbol soll das Auf-/Zuklappen erfolgen';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE_HELP'] = 'W&auml;hle SYMBOL, wenn Du das Auf-/Zuklappen von Bl&ouml;cken &uuml;ber ein Plus/Minus Zeichen erlauben willst und TITEL, wenn dies durch Klick auf den Titel erfolgen soll.';
$lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME'] = 'In welchen Zeitabst&auml;nden soll der Blockcache erneuert werden';
$lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME_HELP'] = 'Der Blockcache wird automatisch nach der hier gew&auml;hlten Zeit aktualisiert.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP'] = 'Links Deiner Website vom PHP ins HTML Format konvertieren (LazyTap)';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP_HELP'] = 'W&auml;hle die Gruppe an Besuchern, um die Funktion der leicht lesbaren Links zu aktivieren. Damit dies funktioniert, muss die Datei evo.htaccess in der root Deiner Installation in .htaccess umbenannt sein.';
$lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS'] = 'Zum aktivieren von Google Analytics, hier den Google Code eingeben';
$lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS_HELP'] = 'Hier kann der Google Anylytics Code eingegben werden, wenn Du von Google f&uuml;r diesen Service registriert bist. Der Code hat in etwa den Aufbau UA-xxxxx.';
$lang_admin[$settingspoint]['FIELD_TEXTEDITORS'] = 'Welcher Texteditor soll zur Standardeingabe verwendet werden';
$lang_admin[$settingspoint]['FIELD_TEXTEDITORS_HELP'] = 'Hier kann ein Texteditor f&uuml;r die Texteingaben eingestellt werden. Dazu muss ein anderer WYSIWYG Editor als der BBCode Editor installiert sein. Diese Einstellung hat keinen Einfluss auf den Forenbereich, da dort bereits ein spezieller Editor integriert ist.';

$lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_ICON'] = 'Plus/Minus Symbol';
$lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_TITLE'] = 'Titel';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_DEACTIVATED'] = 'Deaktiviert';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_MINUTES'] = 'Minuten';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_HOURS'] = 'Stunden';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_DEACTIVATED'] = 'Deaktiviert';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_BOTS'] = 'Nur f&uuml;r WebCrawler';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_ALL'] = 'F&uuml;r Alle';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_ADMINBOTS'] = 'F&uuml;r WebCrawler und Administratoren';
$lang_admin[$settingspoint]['OPTION_TEXTEDITOR_NONE'] = 'Keiner';

$lang_admin[$settingspoint]['INFO_ACTIVATE_ADMINSSL'] = 'Dazu muss SSL auf Deinem Server aktiviert sein';
$lang_admin[$settingspoint]['INFO_ACTIVATE_BANNERS'] = 'Es werden die im Werbemodul angelegten Werbungen angezeigt';
$lang_admin[$settingspoint]['INFO_DEACTIVATED_LAZYTAP'] = 'Dein Lazytap ist aus folgendem Grund deaktiviert';
$lang_admin[$settingspoint]['INFO_TEXTEDITORS'] = 'nicht g&uuml;ltig f&uuml;r das Forum';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

// SexyTooltips
$lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_LAYOUT'] = 'Es stehen verschiedene Ansichten zur Auswahl. Mit nur wenigen Klicks wird das Aussehen des Tooltipp ge&auml;ndert.';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_MOUSECLICK'] = 'Mit Mouse Click';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_MOUSEOVER'] = 'Mit Mouse Over';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_POPUP'] = 'ToolTipps Men&uuml;';
$lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_POPUP'] = 'Auswahl des Tooltipps Men&uuml;.';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_AUTO'] = 'Auto';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_TR'] = 'Oben Rechts';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_TL'] = 'Oben Links';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_BR'] = 'Unten Rechts';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_BL'] = 'Unten Links';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_MODE'] = 'ToolTipps Mode';
$lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_MODE'] ='Auswahl der Position f&uuml; wo die Tooltipps erscheinen sollen.';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_BREAK'] = 'Tooltip Einstellungen';
// done
?>