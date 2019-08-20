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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'META Tags';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'META Tag Verwaltung';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'META Tags Optionen';

$lang_admin[$settingspoint]['FIELD_META'] = 'META Tag';
$lang_admin[$settingspoint]['FIELD_META_RESOURCE-TYPE'] = 'Der resource-type sollte immer document lauten.';
$lang_admin[$settingspoint]['FIELD_META_DISTRIBUTION'] = 'Legt die Art der Verbreitung der Webseite fest. Ohne diesen MetaTag wird automatisch \'g&uuml;ltig f&uuml;r alle\' angenommen.<br />global - g&uuml;ltig f&uuml;r alle<br />local - lokale/regionale G&uuml;ltigkeit<br />IU (internal use) - nur f&uuml;r internen Gebrauch';
$lang_admin[$settingspoint]['FIELD_META_AUTHOR'] = 'Der Autor des intellektuellen Inhaltes der Webseite, und damit auch der f&uuml;r den Inhalt verantwortliche.';
$lang_admin[$settingspoint]['FIELD_META_COPYRIGHT'] = 'Der Inhaber der urheberrechtlichen Verwertungsrechte oder jemand, auf den die Kopierrechte &uuml;bertragen wurden.';
$lang_admin[$settingspoint]['FIELD_META_KEYWORDS'] = 'Die Keywords sollten stichwortartig das zentrale Thema der Webseite widerspiegeln. Beachte, dass Suchdienste h&auml;ufig nur bis zu einer bestimmten Anzahl von Keywords auslesen, sind es zu viele, wird der Rest ignoriert. Wieviel Keywords ausgelesen werden, h&auml;ngt vom Suchdienst ab, manche lesen nur die ersten 5 aus. &Uuml;berdies bekommt ein einzelnes Keyword eine h&ouml;here Relevanz, wenn es insgesamt weniger Keywords sind. Es k&ouml;nnen mehrere Keywords genannt werden, trenne die einzelnen Keywords durch ein Komma.';
$lang_admin[$settingspoint]['FIELD_META_DESCRIPTION'] = 'Eine kurze textliche Beschreibung des Inhaltes der Webseite. Halte den Beschreibungstext kurz: Die maximale L&auml;nge der bei einem Suchtreffer angezeigten Beschreibung unterscheidet sich von Suchdienst zu Suchdienst. Mehr als 150 Zeichen bzw. 25 bis 30 W&ouml;rter sollten es nicht sein.';
$lang_admin[$settingspoint]['FIELD_META_ROBOTS'] = 'Die Meta-Angabe robots dient dazu, einem Suchdienst das Auslesen einer Webseite zu verbieten. Dieses Verbieten kann sinnvoll sein, wenn z.B. Testseiten auf den Server geladen werden oder wenn es sich um irrelevante Seiten handelt.<br />noindex,nofollow = Seite nicht auslesen, Links nicht folgen<br />index,nofollow = Seite auslesen, Links nicht folgen<br />noindex,follow = Seite nicht indexieren, aber den Links folgen<br />index,follow = Seite auslesen, allen Links folgen';
$lang_admin[$settingspoint]['FIELD_META_REVISIT-AFTER'] = 'Soll einen Suchrobot veranlassen, nach x Tagen erneut vorbeizukommen und die Datei neu einzulesen.';
$lang_admin[$settingspoint]['FIELD_META_RATING'] = 'Wenn der Inhalt Deiner Seiten f&uuml;r &auml;ltere Personen bestimmt ist, sollte dies kenntlich gemacht werden.<br />General = normale Einstellung, f&uuml;r jeden zug&auml;nglich<br />Mature = [genaue Bedeutung unbekannt]<br />Restricted = die Surfer sollten mindestens 18 Jahre alt sein<br />14 years = die Surfer sollten mindestens 14 Jahre alt sein';
$lang_admin[$settingspoint]['FIELD_META_TITLE'] = 'Der Titel der Webseite als kurzer knapper Satz in der Art einer &Uuml;berschrift.';
$lang_admin[$settingspoint]['FIELD_META_DATE'] = 'Mit \'date\' kann angegeben werden, wann die Datei publiziert wurde. Beispiel: 2009-12-15T08:49:37+02:00<br />Die Zeitangabe sollte einem standardisierten Schema folgen. Im Beispiel ist 2009 die Jahreszahl, 12 der Monat (Dezember), 15 der Tag, 08 die Stunden, 49 die Minuten und 37 die Sekunden. Die Angabe 02:00 hinter dem Pluszeichen ist die Abweichung von der koordinierten Weltzeit (UTC) in Stunden und Minuten, im Beispiel zwei Stunden. Dies entspricht der Mitteleurop&auml;ischen Sommerzeit. Wenn nur das Datum, aber keine Uhrzeit notiert werden soll, sollte nur den Teil der Datumsangabe bis vor dem großen T (f&uuml;r Time) angegeben werden.';
$lang_admin[$settingspoint]['FIELD_META_AUDIENCE'] = 'Der Typ der Zielgruppe, Mehrfacheintr&auml;ge werden durch Komma getrennt. M&ouml;gliche Werte sind z.B. \'Alle\', \'Anf&auml;nger\', \'Fortgeschrittene\', \'Experten\', \'Studenten\', \'Frauen\', \'M&auml;nner\', \'Kinder\' u.&auml;.';
$lang_admin[$settingspoint]['FIELD_META_ABSTRACT'] = 'Kurze Beschreibung des Inhaltes der Webseite, ist dem Inhalt des title-Tags &auml;hnlich.';
$lang_admin[$settingspoint]['FIELD_META_PAGE-TYPE'] = 'Der Typ der Webseite. Mehrfacheintr&auml;ge werden durch Komma getrennt. M&ouml;gliche Werte sind: \'Anleitung\', \'Katalog\', \'Grafikarchiv\' u.&auml;.';
$lang_admin[$settingspoint]['FIELD_META_PAGE-TOPIC'] = 'Das Thema der Seite, Mehrfacheintr&auml;ge werden durch Komma getrennt. M&ouml;gliche Werte sind \'Audio\', \'Auktionen\', \'Bekleidung\', \'Bildung\', \'Computer\' o.&auml;.';
$lang_admin[$settingspoint]['FIELD_META_PUBLISHER'] = 'Der f&uuml;r die Ver&ouml;ffentlichung der Resource verantwortliche oder die Software und Versionsnummer mit der die Meta Tags generiert wurden. Meist identisch mit dem Generator Tag.';

$lang_admin[$settingspoint]['CHECK_NAME_EXISTS'] = 'Das META Tag existiert bereits - bitte einen anderen Namen w&auml;hlen';
$lang_admin[$settingspoint]['CHECK_NOT_VALID'] = 'Die eingegebenen Werte sind nicht g&uuml;tig';
$lang_admin[$settingspoint]['CHECK_INSERT_FAILED'] = 'Das einf&uuml;gen in die Datenbank ist fehlgeschlagen';

$lang_admin[$settingspoint]['IMG_DELETE_TITLE'] = 'META Tag l&ouml;schen';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

?>