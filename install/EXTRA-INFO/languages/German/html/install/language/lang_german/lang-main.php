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
 Nuke-Evo Author        :   ReOrGaNiSaTiOn

 Copyright (c) 2008 by The Nuke-Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS 'NOT' ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE 'NOT' ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

// General entries were no UTF-8 is accepted
$lang_install['Next']  = 'WEITER';
$lang_install['Back']  = 'ZURUECK';
$lang_install['Restart']  = 'NEUSTART';
$lang_install['Help']  = 'HILFE';
$lang_install['IMG_OK']  = 'Check ist ok';
$lang_install['IMG_BAD']  = 'Check fehlgeschlagen';
$lang_install['IMG_WARN']  = 'Nur eine Warnung, kein Fehler';
$lang_install['IMG_DONE']  = 'Erledigt';

// General entries with UTF-8 support
$lang_install['Langcode'] = 'de-de';
$lang_install['Landdir']  = 'ltr';
$lang_install['No']  = 'Nein';
$lang_install['Yes']  = 'Ja';

$lang_install['Head_Title'] = 'Installation';
$lang_install['Block_Title'] = 'Status';
$lang_install['Block_Step_0'] = 'Willkommen';
$lang_install['Block_Step_1'] = 'Infos';
$lang_install['Block_Step_2'] = 'Datei-Konfiguration';
$lang_install['Block_Step_3'] = 'DB-Konfiguration';
$lang_install['Block_Step_4'] = 'DB-Installation';
$lang_install['Block_Step_5'] = 'Basis Konfiguration';
$lang_install['Block_Step_6'] = 'Administrator anlegen';
$lang_install['Block_Step_7'] = 'DB-Grunddaten';
$lang_install['Block_Step_8'] = 'Fertig';
$lang_install['Block_Step_9'] = 'Logbuch';

// Help-System
if (!defined('_EVO_HELPSYSTEM')) {
    define('_EVO_HELPSYSTEM', 'Evo Hilfe');
}

// Step Welcome
$lang_install['Welcome'] = 'Gratulation<br/><br/>Du bist dabei >> '.$var_install['version'].' << zu installieren<br/>Diese Installationsprozedur f&uuml;hrt Dich durch die Informationssammlung, Systemtests und wird Dir dabei helfen, eine solide Grundeinstellung f&uuml;r Dein System zu setzen.';
$lang_install['Language_Select'] = 'Wenn hier kein Auswahlfeld f&uuml;r andere Sprachen angezeigt wird, hast Du die Sprachdateien nicht auf den Server geladen.';
$lang_install['License_Header'] = 'Bitte lies dieses Lizenzabkommen sorgf&auml;ltig durch und best&auml;tige Deine Zustimmung';
$lang_install['License_Agreement'] = 'Mit dem Fortfahren der Installation werden die Lizenzbestimmungen dieser Software akzeptiert';
$lang_install['License_Text'] = '
               W I C H T I G E  I N F O R M A T I O N
           --------------------------------------------------
Rechtsgrundlage f&uuml;r die Nutzung dieser Software ist die GPL (General Public License).
Diese Software unterliegt der GPL und damit - wie jede andere Software grunds&auml;tzlich auch - dem Urheberrechtsschutz. Das bedeutet, dass Dritte diese Software nicht nach freiem Belieben bearbeiten und vertreiben d&uuml;rfen, sondern sich an gewisse Regeln halten m&uuml;ssen.

In Erweiterung der GPL gilt f&uuml;r dieses Paket noch folgendes:
a) Die Entfernung, Ver&auml;nderung oder das unterdr&uuml;cken der Anzeige der enthaltenen Copyrights, Credits oder auch anderen Anzeigen, die lizenz&auml;hnlichen Charakter haben, ist verboten.
b) Die Entfernung, Ver&auml;nderung oder das unterdr&uuml;cken der Anzeige der im Paket oder in Modulen, Bl&ouml;cken oder anderen Teilen des Paketes genierten Copyrights, Credits oder auch anderen Anzeigen, die lizenz&auml;hnlichen Charakter haben, ist verboten.

Rechte und Pflichten (Auszugsweise)
===================================

Wesentliche Bestimmungen der GPL sind die &#167;&#167; 1 bis 4. Nach &#167; 1 ist jeder Nutzer berechtigt, die Software mit Quelltext zu kopieren und zu verbreiten, soweit ein entsprechender Copyright-Vermerk, ein Haftungsausschluss und die Lizenzbedingungen beigef&uuml;gt werden. Nach &#167; 2 ist auch die Bearbeitung der Software grunds&auml;tzlich erlaubt. Wird diese ver&auml;nderte Softwareversion jedoch in Umlauf gebracht, dann m&uuml;ssen weitere drei Voraussetzungen erf&uuml;llt sein:

    * Die ver&auml;nderten Dateien m&uuml;ssen mit einem Bearbeitungsvermerk mit Datum versehen werden.
    * Die Software muss auch in der ver&auml;nderten Form vollst&auml;ndig der GPL unterworfen werden.
    * Bei Ausf&uuml;hrung interaktiver Kommandos muss einmalig ein Copyright-Vermerk, ein Gew&auml;hrleistungsausschluss sowie die Quelle der Lizenz angezeigt werden.

Nach &#167; 3 ist zus&auml;tzlich daf&uuml;r zu sorgen, dass dem Nutzer der bearbeiteten Version der Quelltext zur Verf&uuml;gung gestellt wird. Dies kann entweder dadurch erfolgen, dass dieser auf Datentr&auml;gern mitgeliefert oder ein schriftliches Angebot auf Nachlieferung des Quelltextes ausgesprochen wird. &#167; 4 regelt die Einhaltung der Lizenzbestimmungen. Insoweit verliert der Nutzer automatisch im Rahmen einer aufl&ouml;senden Bedingung die Nutzungserlaubnis, sobald gegen die Lizenzbestimmungen der GPL versto&szlig;en wird. Arbeitet daher ein Programmierer dieses Packet um und bindet es in eine propriet&auml;re (kostenpflichtige Standard-) Software zum Weitervertrieb ein, so entf&auml;llt sein Nutzungsrecht und er kann auf Unterlassung in Anspruch genommen werden. Anspruchsberechtigt f&uuml;r diesen Unterlassungsanspruch sind s&auml;mtliche (Mit-) Urheber der Software (&#167; 8 UrhG), deren Anzahl schnell den zweistelligen Bereich erreichen kann. &#167; 6 GPL stellt fest, dass der Lizenzvertrag stets zwischen den urspr&uuml;nglichen Urheber und dem Empf&auml;nger zustande kommt, nicht etwa im Rahmen einer Unterlizenz von Nutzer auf den nachfolgenden Nutzer.


Gew&auml;hrleistung und Haftung (Auszugsweise)
==============================================

&#167; 11 der GPL schlie&szlig;t jegliche Gew&auml;hrleitung f&uuml;r dieses Packet aus. Hierdurch soll erreicht werden, dass die Weiterentwicklung der Software nicht gef&auml;hrdet wird. Der komplette Ausschluss der Gew&auml;hrleistung in den US-amerikanisch gepr&auml;gten GPL steht jedoch in Widerspruch zum deutschen AGB-Recht (hier &#167;&#167; 307, 308 BGB), wonach u.a. die Gew&auml;hrleistungsrechte nur in geringem Umfang eingeschr&auml;nkt werden k&ouml;nnen. Allerdings werden wir uns im Rahmen dieses Packets auf &#167;&#167; 516 ff. BGB berufen, wonach u.a. die Haftung bei Schenkungsvertr&auml;gen auf Vorsatz und grobe Fahrl&auml;ssigkeit beschr&auml;nkt ist und eine Sachm&auml;ngelhaftung nur bei Arglist in Betracht kommt.
Die Haftung f&uuml;r Sch&auml;den ist in &#167; 12 GPL geregelt. Hier werden s&auml;mtliche, ehemaligen Miturheber von der Haftung freigestellt. Hinsichtlich der Haftung f&uuml;r Sch&auml;den gilt jedoch im deutschen Recht Entsprechendes zur Sachm&auml;ngelhaftung: Die Haftung kann nicht vollst&auml;ndig ausgeschlossen werden, sondern lediglich ein Reduzierung auf Vorsatz und grobe Fahrl&auml;ssigkeit vorgenommen werden.


Hinweis:
=======

Es gilt der Grundsatz "Einmal GPL, immer GPL". Sobald also diese Packet einmal in eine Anwendung eingebunden wurde, so unterfallen alle anderen Abwandlungen und &Auml;nderungsversionen ebenfalls der GPL. Sie sollten also peinlichst darauf bedacht sein, dieses Packet weder als Ganzes noch in Teilen in gewerbliche oder kommerzielle Anwendungen einzubinden, noch Code-Fragmente aus unserem Packet zu nutzen, wenn Ihre Anwendung danach immer noch gewerblich oder kommerziell genutzt werden soll.';

// Step Infos
$lang_install['Infos_Title'] = 'Wir haben jetzt Dein System &uuml;berpr&uuml;ft<br />Nachfolgend findest Du die Informationen, die wir gefunden haben und ob diese Einstellungen ok sind oder nicht';
$lang_install['DB_Setup'] = 'In diesem Schritt wird die Datenbankverbindung eingerichtet.<br />Die notwendigen Daten solltest Du von Deinem Provider erhalten oder bei der Errichtung der Datenbank selbst bestimmt haben<br />';

// Language entries for Installer
$lang_install['Date']    = 'Datum';
$lang_install['Step']    = 'Schritt';
$lang_install['Last_Step']    = 'Letzter Schritt';
$lang_install['Log_Message']    = 'Logbucheintrag';
$lang_install['Submit'] = 'Eingaben Absenden';

$lang_install['Installation_started'] = 'Installation gestartet';
$lang_install['Server_Configuration_Details'] = 'Server Konfiguration Details';
$lang_install['Server_Configuration_Summary'] = 'Server Konfiguration Zusammenfassung';
$lang_install['DB_Installation'] = 'Anlegen der Datenbanktabellen';
$lang_install['Installation_Start_failed'] = 'Sorry, aber wir haben kritische Punkte gefunden, die eine lauff&auml;hige Version von Nuke-Evolution unwahrscheinlich machen.<br/>Klicke auf "Hilfe" und lese in unserem Wiki, welche Grundvoraussetzungen f&uuml;r eine ordnungsgem&auml;sse Installation notwendig sind.<br/>Tips und Tricks sowie Hoster, die eine passende Umgebung f&uuml;r Nuke-Evolution bieten, findest Du in unserem Forum.';
$lang_install['Errors_found'] = 'Gefundene Fehler';
$lang_install['Warnings_found'] = 'Gefundene Warnungen';

$lang_install['File_Setup'] = 'Datei Konfiguration';
$lang_install['File_error'] = 'Fehler: Die Datei ist nicht vorhanden.';
$lang_install['File_warning'] = 'Warnung: Die Datei ist nicht vorhanden.';
$lang_install['File_notchanged'] = 'Warnung: Die Zugriffsrechte stimmen nicht';
$lang_install['File_mustexist'] = 'Die Datei muss vorhanden sein - ist aber nicht vorhanden.<br />Das ist ein Fehler. Im Hilfetext ist der genaue Dateipfad angegeben. Bitte &uuml;berpr&uuml;fe, ob diese Datei/Verzeichnis tats&auml;chlich auf den Server geladen wurde.';
$lang_install['File_shouldexist'] = 'Die Datei sollte existieren - ist aber nicht vorhanden.<br />Das ist kein Fehler, da die Datei optional ist. Im Hilfetext sind dazu weitere Informationen vorhanden.';
$lang_install['File_done'] = 'Alles Ok: Die Datei hat die richtigen Zugriffsrechte';
$lang_install['File_htaccess'] = 'Datei: .htaccess';
$lang_install['File_Help_htaccess'] = 'Datei: .htacess<br />Pfad: root<br />Diese Datei stellt eine Erweiterung der Webserver Konfiguration dar. In restriktiven Umgebungen kann diese Datei zu einem Webserver Fehler f&uuml;hren, weshalb wir sie als evo.htaccess ausliefern. Du kannst versuchen, diese Datei in .htaccess umzubenennen. Wenn Du dann einen Webserver Fehler erh&auml;lst, bennene die Datei wieder in evo.htaccess um, damit Du mit der Installation fortfahren kannst.';
$lang_install['File_staccess'] = 'Datei: .staccess';
$lang_install['File_Help_staccess'] = '';
$lang_install['File_ultramode'] = 'Datei: Ultramode';
$lang_install['File_Help_ultramode'] = '';
$lang_install['File_errorlog'] = 'Datei f&uuml;r Fehlermeldungen';
$lang_install['File_Help_errorlog'] = 'Datei: error.log<br />Pfad: includes/log/<br />In dieser Datei werden alle Warnungen oder Fehler aus Betrieb der Webseite protokolliert. Hat die Datei nicht die richtige Schreibberechtiung, erfolgt keine Protokollierung';;
$lang_install['File_adminlog'] = 'Datei f&uuml;r Administrationsmeldungen';
$lang_install['File_Help_adminlog'] = 'Datei: admin.log<br />Pfad: includes/log/<br />In dieser Datei werden alle Warnungen oder Fehler aus dem Administrationsbereich protokolliert. Hat die Datei nicht die richtige Schreibberechtiung, erfolgt keine Protokollierung';
$lang_install['File_ForumsCacheDir'] = 'Verzeichnis: Foren Cache';
$lang_install['File_Help_ForumsCacheDir'] = '';
$lang_install['File_FilesDir'] = 'Verzeichnis: Foren Dateiup/Download';
$lang_install['File_Help_FilesDir'] = '';
$lang_install['File_FilesThumbDir'] = 'Verzeichnis: Foren Vorschaubilder';
$lang_install['File_Help_FilesThumbDir'] = '';
$lang_install['File_AvatarDir'] = 'Verzeichnis: Avatare';
$lang_install['File_Help_AvatarDir'] = '';
$lang_install['File_LangBBCode'] = 'Datei: Sprachdatei f&uuml;r BBCode';
$lang_install['File_Help_LangBBCode'] = '';
$lang_install['File_LangFAQ'] = 'Datei: Sprachdatei f&uuml;r FAQ';
$lang_install['File_Help_LangFAQ'] = '';
$lang_install['File_LangFAQAttach'] = 'Datei: Sprachdatei f&uuml;r FAQ Anh&auml;nge';
$lang_install['File_Help_LangFAQAttach'] = '';
$lang_install['File_LangRules'] = 'Datei: Sprachdatei f&uuml;r Forenregeln';
$lang_install['File_Help_LangRules'] = '';
$lang_install['File_ForumModules'] = 'Verzeichnis: Forenmodule';
$lang_install['File_Help_ForumModules'] = '';
$lang_install['File_ForumModulesCache'] = 'Verzeichnis: Forenmodule Cache';
$lang_install['File_Help_ForumModulesCache'] = '';
$lang_install['File_ForumModulesCacheExplain'] = 'Verzeichnis: Forenmodule Cache Erkl&auml;rungen';
$lang_install['File_Help_ForumModulesCacheExplain'] = '';
$lang_install['File_SupportersImagesSupporters'] = 'Verzeichnis: Supporter Banner';
$lang_install['File_Help_SupportersImagesSupporters'] = '';
$lang_install['File_IncludesCache'] = 'Verzeichnis: Cacheverzeichnis';
$lang_install['File_Help_IncludesCache'] = '';
$lang_install['File_IncludesCacheFile'] = 'Datei: Datei f&uuml;r den Cache';
$lang_install['File_Help_IncludesCacheFile'] = '';
$lang_install['File_HTMLPurifierDecorator'] = 'Verzeichnis: HTML-Purifier Decorator';
$lang_install['File_Help_HTMLPurifierDecorator'] = '';
$lang_install['File_HTMLPurifierSerializer'] = 'Verzeichnis: HTML-Purifier Serializer';
$lang_install['File_Help_HTMLPurifierSerializer'] = '';
$lang_install['File_HTMLPurifierSerializerHtml'] = 'Verzeichnis: HTML-Purifier Serializer-HTML';
$lang_install['File_Help_HTMLPurifierSerializerHtml'] = '';
$lang_install['File_IconModDefIcons'] = 'Datei: Icon-Mod definierte Icons';
$lang_install['File_Help_IconModDefIcons'] = '';
$lang_install['File_Configdb'] = 'Datei: Datenbank Konfigurationsdatei';
$lang_install['File_Help_Configdb'] = '';
$lang_install['Downloads_Files_Dir'] = 'Verzeichnis: Downloadmodul Dateien';
$lang_install['Downloads_Files_Dir_Help'] = '';
$lang_install['File_CantOpen'] = 'Die Datei kann nicht ge&ouml;ffnet werden';
$lang_install['File_CantWrite'] = 'Die Datei kann nicht geschrieben werden';
$lang_install['File_CantChange'] = 'Die Zugriffsberechtigung der Datei konnte nicht ge&auml;ndert werden';
$lang_install['File_ErrorChmod'] = 'Einige Dateien haben die falschen Zugriffsberechtigungen.<br />Wir haben versucht, diese zu &Auml;ndern, der Webserver hat jedoch nicht die richtigen Berechtigungen dazu.<br />Du kannst nun entweder die Berechtigungen per FTP selbst setzen oder wir k&ouml;nnen das per FTP &uuml;bernehmen.<br />Wenn Du die Berechtigungen selbst &auml;ndern m&ouml;chtest, findest Du zu jeder Datei in den Hilfstexten den Ort, an dem die Datei/das Verzeichnis zu finden ist. Nachdem Du die &Auml;nderungen vorgenommen hast, starte die Installation erneut.<br />Wir k&ouml;nnen diese &Auml;nderungen aber auch f&uuml;r Dich &uuml;bernehmen, wenn Du auf auf den Butten unten klickst. Wir werden dann, nach Eingabe eines g&uuml;tigen FTP Benutzerlogins die &Auml;nderungen vornehmen. Nach erfolgreicher Beendigung der Aktion musst Du die Installation neu starten.';
$lang_install['File_FTPChmod'] = 'FTP Berechtigungs&auml;nderung starten';
$lang_install['FTP_Configuration_Details'] = 'FTP Konfiguration';
$lang_install['FTP_User'] = 'FTP Benutzername';
$lang_install['FTP_Pwd'] = 'FTP Passwort';
$lang_install['FTP_Host'] = 'FTP Host';
$lang_install['FTP_Path'] = 'FTP Pfad';
$lang_install['FTP_Port'] = 'FTP Port';
$lang_install['FTP_Help_User'] = 'Bitte trage hier den FTP Benutzeraccount ein, der f&uuml;r das hochladen der Dateien auf den Server benutzt wurde.<br />Wir haben anhand der Dateiberechtigungen den Benutzer eingetragen, der als Inhaber der Dateien auf dem Webserver gef&uuml;hrt wird.';
$lang_install['FTP_Help_Pwd'] = 'Hier ist das Passwort f&uuml;r den FTP Benutzeraccount einzutragen.';
$lang_install['FTP_Help_Host'] = 'Die Domain oder IP-Adress Deines Servers auf den wir per FTP zugreifen sollen.<br />Hier sind genau dieselben Daten einzutragen wie in der FTP Software.';
$lang_install['FTP_Help_Port'] = 'Port, auf dem der FTP Service auf dem Server l&auml;uft. Normalerweise ist das Port:21. Hier sind die gleichen Daten einzutragen wie in der FTP Software. Wurde dort kein anderer Port angegeben oder ist das Feld dort leer, ist Port 21 als Standardwert vorgegeben.';
$lang_install['FTP_Help_Path'] = 'Der Pfad zur Evo Installation.<br />Bitte trage hier den Pfad ein, der nach einem Login per FTP durchlaufen werden muss um in das Verzeichnis der Evo-Installation zu kommen.<br />Wurde kein Subverzeichnis f&uuml;r die Installation verwendet, kann das Feld leer bleiben.';
$lang_install['FTP_Error_Host'] = 'Wir k&ouml;nnen keine Verbindung mit dem Server aufnehmen. Bitte &uuml;berpr&uuml;fe, ob Du dieselben Eingaben gemacht hast wie f&uuml;r Deine FTP Software.';
$lang_install['FTP_Error_Login'] = 'FTP Benutzername oder Passwort sind nicht korrekt. Bitte &uuml;berpr&uuml;fe, ob Du dieselben Eingaben gemacht hast wie f&uuml;r Deine FTP Software.';

$lang_install['DB_Host'] = 'Servername';
$lang_install['DB_Help_Host'] = 'Der Name des Datenbankservers. Im Normalfall \'localhost\', was auch als Vorgabe von uns verwendet wurde.<br />Den Hostnamen des Datenbankservers erh&auml;lst Du von Deinem Provider.<br />Damit keine Namensaufl&ouml;sung verwendet werden muss, kannst Du auch die IP-Adresse des Datenbankservers eingeben.';
$lang_install['DB_Name'] = 'Name der Datenbank';
$lang_install['DB_Help_Name'] = 'Name der Datenbank<br />Entweder wurde die Datenbank von Deinem Provider angelegt (in diesem Falle hast Du den Datenbanknamen von Deinem Provider erhalten) oder Du hast die Datenbank selbst angelegt (in diesem Falle der Name, den Du f&uuml;r die Datenbank gew&auml;hlt hattest';
$lang_install['DB_Username'] = 'Benutzername f&uuml;r die Datenbankverbindung';
$lang_install['DB_Help_Username'] = 'Datenbank Benutzername<br />Der Benutzername, der verwendet wird, um sich bei der Datenbank anzumelden.<br />Entweder hast Du diesen Namen von Deinem Provider erhalten oder Du hast ihn selbst gew&auml;hlt als Du die Datenbank angelegt hast.';
$lang_install['DB_Password'] = 'Passwort f&uuml;r die Datenbankverbindung';
$lang_install['DB_Help_Password'] = 'Passwort<br />Das Passwort f&uuml;r den Datenbankbenutzer. Entweder hast Du diesen von Deinem Provider erhalten oder Du hast selbst einen gew&auml;hlt als Du die Datenbank angelegt hast.';
$lang_install['DB_Type'] = 'Datenbank Typ';
$lang_install['DB_Help_Type'] = 'Datenbank Typ<br />Der Typ der Datenbank. Wir haben Dein System untersucht und die Typen, die zur Auswahl stehen, sind verf&uuml;gbar.';
$lang_install['DB_Prefix'] = 'Tabellen-Pr&auml;fix (Standard: evo)';
$lang_install['DB_Help_Prefix'] = 'Tabellen-Pr&auml;fix<br />Jede Tabelle hat Ihren eindeutigen Namen innerhalb der Datenbank. Da mehrere Systeme innerhalb der gleichen Datenbank installiert werden k&ouml;nnen, m&uuml;ssen diese sich durch den Pr&auml;fix unterscheiden. Standard ist \'evo_\'. D.h. der Pr&auml;fix \'evo_\' wird jeder Tabelle, die wir installieren, vorangestellt.';
$lang_install['DB_Conf_wrong'] = 'Wir konnten keine Verbindung mit dem Datenbankserver aufnehmen.<br />Bitte &uuml;berpr&uuml;fe Deine Eingaben';
$lang_install['DB_DB_wrong'] = 'Wir konnten zwar eine Verbindung mit dem Datenbankserver aufnehmen, jedoch nicht mit Deiner Datenbank.br />Bitte &uuml;berpr&uuml;fe Deine Eingaben';
$lang_install['DB_Conf_ok'] = 'Wir konnten eine Verbindung mit der Datenbank aufnehmen.<br />Deine Eingaben sind ok.';
$lang_install['DB_Prefix_exists'] = 'Es gibt bereits Tabellen in der Datenbank mit diesem Prefix.';
$lang_install['DB_Delete_Existing'] = 'Sollen die bereits vorhandenen Tabellen &uuml;berschrieben/gel&ouml;scht werden';
$lang_install['DB_Help_Delete_Existing'] = 'Tabellen l&ouml;schen/&uuml;berschreiben<br />Wir haben in Deiner Datenbank Tabellen gefunden. D.h. Du m&ouml;chtest in eine Datenbank installieren, in der bereits Daten vorhanden sind.<br />Mit \'Nein\', werden eventuell gleichnamige Tabellen nicht &uuml;berschrieben. Wir pr&uuml;fen, ob die Tabellen vollst&auml;ndig sind und erg&auml;nzen evt. um notwendige Felder bzw. Indizes.<br />Mit \'Ja\' werden die vorhanden Tabellen gel&ouml;scht und neu angelegt. Dies ist die sicherere Methode f&uuml;r ein funktionierendes System.';
$lang_install['DB_Help_Update_Existing'] = 'Funktionierende Konfiguration gefunden<br/>Wir haben eine funktionierende Konfiguration gefunden.<br />Es sieht danach aus, als ob dies keine frische Installation sondern eher ein Update ist.<br />Wenn Du \'update\' w&auml;hlst, dann werden die bestehenden Tabellen nicht &uuml;berschrieben sondern nur gepr&uuml;ft und n&ouml;tigenfalls erg&auml;nzt.';
$lang_install['DB_Update_Existing'] = 'Ist das ein Update oder eine neue Installation';
$lang_install['DB_Update_Question'] = 'Wir haben eine funktionierende Datenbankverbindung gefunden. Bitte best&auml;tige, ob dies eine neue Installation oder ein Upgrade ist.';
$lang_install['DB_Help_Update_Convert'] = 'In &auml;lteren Installationen wurde der Zeichensatz: ISO-8859-1 verwendet. Nuke-Evolution > 2.1.0 verwendet aber UTF-8, einen multibyte internationalen Zeichensatz. Wenn Du hier mit Ja best&auml;tigst, werden alle Textfelder von ISO-8859-1 nach UTF-8 konvertiert';
$lang_install['DB_Update_Convert'] = 'Zeichensatz von ISO-8859-1 nach UTF-8 konvertieren ?';
$lang_install['DB_Update'] = 'Update';
$lang_install['DB_No_Convertion'] = 'Keine Konvertierung';
$lang_install['DB_Convert'] = 'Konvertieren';
$lang_install['DB_Installation'] = 'Neue Installation';
$lang_install['DB_Upgrade'] = 'Datenbank - Aktualisierung';
$lang_install['DB_Help_DiffUserPrefix'] = 'Verschiedene Tabellenpr&auml;fixe<br />Die vorhandene Konfiguration zeigt, dass Du f&uuml;r die Benutzertabellen einen anderen Pr&auml;fix als f&uuml;r Deine restlichen Tabellen verwendest. Dieser Installer unterst&uuml;tzt eine solche Installtion nicht. Solltest Du "JA" w&auml;hlen, wird der Installer versuchen, die Benutzertabellen umzubenennen damit Du mit der Installation fortfahren kannst. Im anderen Falle wird die Installation abgebrochen. Du kannst die Tabellen "user_table" und "user_temp_table" nach der Installation selbst wieder umbenennen, wobei Du dann auch in der config.php die Eintragung f&uuml;r die Variable "user_prefix" manuell &auml;ndern musst.';
$lang_install['DB_DiffUserPrefix'] = 'Soll der Tabellenpr&auml;fix f&uuml;r Deine Benutzertabellen ge&auml;ndert werden';
$lang_install['DB_DiffUserPrefixMore'] = 'Deine bestehende Konfiguration zeigt unterschiedliche Pr&auml;fixe f&uul;r Deine Benutzertabellen auf. W&auml;hlst Du jetzt "JA", wird die Installation fortgesetzt, der Installer bennent die Tabellen um und f&uuml;hrt die Installation fort. Bei "NEIN" wird die Installation an dieser Stelle abgebrochen.<br />Mehr Informationen erh&auml;st Du &uuml;ber unsere Feldhilfe';
$lang_install['DB_Table_Exists'] = 'Tabelle existiert bereits';
$lang_install['DB_Table_NotExists'] = 'Tabelle muss neu angelegt werden';
$lang_install['DB_Table_Done'] = 'Tabelle erfolgreich angelegt';
$lang_install['DB_Table_Warning_override'] = 'Du hast Dich entschieden, vorhandene Tabellen zu &uuml;berschreiben. Alle Daten in diesen Tabellen werden verloren gehen !!<br /> Falls dies eine falsche Entscheidung von Dir war, kannst Du zur&uuml;ck gehen oder die Installation neu starten.';
$lang_install['DB_Table_Create_in_process'] = 'Die Erstellung der Tabellen l&auml;uft .... nicht unterbrechen !!';
$lang_install['DB_Table_Deleted'] = 'Tabelle gel&ouml;scht';
$lang_install['DB_Table_Created'] = 'Tabelle angelegt';
$lang_install['DB_Table_Checked'] = 'Tabelle gepr&uuml;ft';
$lang_install['DB_Table_Identical'] = 'Die Tabelle entspricht den neuen Vorgabewerten';
$lang_install['DB_Table_Changed'] = 'Die Tabelle wurde den neuen Vorgabewerten angepasst';
$lang_install['DB_Table_Created_not'] = 'Tabelle konnte nicht angelegt werden. Schwerer Fehler';
$lang_install['DB_Table_Changed_not'] = 'Die Tabelle konnte nicht an die neuen Vorgabewerten angepasst werden. Schwerer Fehler.';
$lang_install['DB_Table_Created_ready'] = 'Die Tabelleninstalltion ist nun beendet<br />Es ist -soweit uns bekannt- kein Fehler aufgetreten.<br />Im n&auml;chsten Schritt konfigurierst Du nun Dein System';
$lang_install['DB_Table_Created_ready_error'] = 'Die Tabelleninstalltion ist nun beendet<br />Es sind Fehler aufgetreten.<br />Bitte pr&uuml;fe das Logbuch. Dort kannst Du sehen, wo die/der Fehler aufgetreten ist.';
$lang_install['DB_Entry_Update_missed'] = 'Ein Fehler ist beim einf&uuml;gen der Daten in die Datenbank erfolgt';
$lang_install['DB_RenameUserTableFail'] = 'Wir konnten die Benutzertabellen nicht umbenennen';

// Language entries for Checks
$lang_install['Found_language'] = 'Wir haben festgestellt, dass Du diese Sprache nutzt';
$lang_install['Found_language_change'] = 'Wenn Du diese Sprache &auml;ndern m&ouml;chtest (die gleichzeitig dann f&uuml;r Dein System g&uuml;ltig sein wird), dann w&auml;hle zwischen den Sprachen, die wir gefunden haben';

$lang_install['SystemInfo'] = 'System Informationen';
$lang_install['Sysname']    = 'Betriebssystem';
$lang_install['SysNodename']= 'Name des Servers';
$lang_install['SysDomain']  = 'Server Domain';
$lang_install['SysRelease'] = 'Betriebssystem Release';
$lang_install['SysVersion'] = 'Betriebssystem Version';
$lang_install['SysMachine'] = 'Prozessor Architektur';
$lang_install['SystemUserInfo']     = 'System Benutzer Informationen';
$lang_install['SysUser']            = 'System Benutzer';
$lang_install['SysUserProcessID']   = 'System Benutzer ID';
$lang_install['SysUserProcessName'] = 'System Benutzer Name';
$lang_install['SysGroup']           = 'System Gruppen Informationen';
$lang_install['SysGroupProcessID']  = 'System Gruppen ID';
$lang_install['SysGroupProcessName']= 'System Gruppen Name';

$lang_install['FreeDiskSpace']    = 'Freier Plattenspeicher';
$lang_install['No_Free_Disk_Space'] = 'Wir konnten den freien Plattenspeicher nicht ermitteln. Bitte pr&uuml;fe ob mind. 50 MB verf&uuml;gbar sind';
$lang_install['Safe_Mod']    = 'Safe Mode';
$lang_install['SafeMod_On']    = 'Safe Mode ist aktiviert.<br />In diesem Fall k&ouml;nnen Probleme in allen Dateiaktionen auftreten (z.B. Cache, Dateiupload etc.)';
$lang_install['PHP_Version']    = 'PHP Version';
$lang_install['Wrong_PHP_Version'] = 'Deine PHP-Version ist zu alt. Wir unterst&uuml;tzen diese Version nicht mehr.';
$lang_install['Unsafe_PHP_Version'] = 'Deine PHP-Version ist zu alt. Wir unterst&uuml;tzen zwar diese Version, jedoch empfehlen wir ein Update, da diese Version bekannte Schwachstellen hat &uuml;ber die Deine Seite geknackt werden kann.';
$lang_install['Register_Globals']    = 'Register Globals';
$lang_install['Register_Globals_On'] = 'Register Globals ist auf Deinem Server aktiviert.<br />Ok, wir pr&uuml;fen unsere Variablen, aber es bleibt trotzdem ein Sicherheitsrisiko f&uuml;r Mods, Module, Bl&ouml;cke und AddOns, die nicht unsere Variablenpr&uuml;fung nutzen.';
$lang_install['Captcha_enabled'] = 'Captcha verf&uuml;gbar';
$lang_install['Open_Basedir'] = 'Open Basedir';
$lang_install['Open_Basedir_On'] = 'Open Basedir ist aktiviert und erlaubt keinen Schreibzugriff auf die Dateien, die per FTP auf den Webserver &uuml;bertragen wurden. FTP Benutzer und Gruppe sind unterschiedlich zu Webserver Benutzer und Gruppe';
$lang_install['Session_Support'] = 'Session Support';
$lang_install['No_Session_Support'] = 'Session Support ist nicht aktiviert<br />Das PHP-Modul Session Support wird aus Sicherheitsgr&uuml;nden ben&ouml;tigt. Die Installation wird deshalb abgebrochen.';
$lang_install['CURL_Libary'] = 'Curl Library';
$lang_install['No_Curl_Modul'] = 'Das PHP CURL-Modul ist nicht geladen<br />Dadurch kannst Du keine Dateizugriffe auf externe Server vornehmen. Z.B. schl&auml;gt die Pr&uuml;fung auf Updates fehl.';
$lang_install['File_Upload'] = 'Datei hochladen erlaubt';
$lang_install['No_FileUploads'] = 'Auf Deinem Server ist die _Unterst&uuml;tzung f&uuml;r den Dateiupload nicht konfiguriert.';
$lang_install['Size_MB'] = 'MB';
$lang_install['Size_GB'] = 'GB';
$lang_install['File_Upload_Maxsize'] = 'Maximale Dateigr&ouml;sse f&uuml;r das hochladen';
$lang_install['Max_FileSize_ToSmall'] = 'Die erlaubte Dateigr&ouml;sse zum hochladen auf Deinen Server ist zu klein. Deshalb brechen wir die Installation hier ab.';
$lang_install['Max_FileSize_Small'] = 'Die erlaubte Dateigr&ouml;sse zum hochladen auf Deinen Server ist sehr klein.';
$lang_install['SMTP_enabled'] = 'SMTP eingerichtet';
$lang_install['SMTP_host'] = 'SMTP Server';
$lang_install['SMTP_sender'] = 'STMP Absender';
$lang_install['SMTP_command'] = 'STMP Kommando';
$lang_install['FTP_enabled'] = 'FTP eingerichtet';
$lang_install['Max_Post_Size'] = 'Maximale Gr&ouml;sse eines Beitrags';
$lang_install['Mod_Rewrite'] = 'Mod Rewrite (wichtig f&uuml;r Lazy Google Tab)';
$lang_install['Mod_Rewrite_no'] = 'Du wirst den Lazy Google Tab nicht nutzen k&ouml;nnen, da Dein System den mod_rewrite nicht unterst&uuml;tzt.';
$lang_install['Mod_Rewrite_no_check'] = 'Wir konnten nicht pr&uuml;fen, ob das Apache Modul "mod_rewrite" gelade ist. Es kann also sein, dass Du den Lazy Google Tab nicht nutzen kannst.';
$lang_install['GD_Libary'] = 'GD Library';
$lang_install['GD_Libary_JPEG'] = 'GD Library - JPEG Support (wichtig f&uuml;r Captcha)';
$lang_install['Memory_Limit'] = 'Max. Speichernutzung durch ein Programm';
$lang_install['Memory_Limit_not'] = 'In Deinem System ist keine Obergrenze f&uuml;r den Speichergebrauch \'memory_limit\' gesetzt. Das bedeutet, das ein Programm den gesamten Hauptspeicher verwenden kann. Insbesondere bei vielen Downloads bedeutet dies einen z.T. gravierender Verlust an Systemgeschwindigkeit f&uuml;r andere User.';

// Language entries Base Configuration
$lang_install['Base_Setup'] = 'Grundeinstellungen<br />Hier werden nun die wichtigsten Grundeinstellungen f&uuml;r Dein System festgelegt.<br />Alle Einstellungen k&ouml;nnen sp&auml;ter in der Systemadministration Deiner Webseite ge&auml;ndert werden.';
$lang_install['Base_Sitename'] = 'Name der Webseite';
$lang_install['Base_Help_Sitename'] = 'Der Name Deiner Webseite<br />Maximal 200 Zeichen.<br />Der Name erscheint in der Browserleiste und wird im Forum verwendet. Ebenso erscheint der Name als Meta-Tag im Header Deiner Seite (z.B. f&uuml;r Suchmaschinen)';
$lang_install['Base_Sitename_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Sitedescription'] = 'Kurzbeschreibung der Seite (max. 200 Zeichen)';
$lang_install['Base_Help_Sitedescription'] = 'Eine kurze Beschreibung Deiner Seite. Maximal 200 Zeichen.';
$lang_install['Base_Descriptione_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Url'] = 'URL Deiner Webseite (ohne http://)';
$lang_install['Base_Help_Url'] = 'Alles, was Du in der Browserzeile (ohne http://) eingeben musst, um Deine Webseite aufzurufen.';
$lang_install['Base_Url_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Server_Port'] = 'Port des Webservers';
$lang_install['Base_Help_Server_Port'] = 'Port des Webservers.<br />Nummer: 5-stellig.<br />Die Portadresse auf Deinem Server, an der Dein Webserver antwortet. Im Normalfall Port: 80 oder hinter einem Proxyserver: 8080.';
$lang_install['Base_Server_Port_wrong_entry'] = 'Der Serverport muss gr&ouml;sser als Port 80 und kleiner als Port 65535 sein';
$lang_install['Base_Server_Port_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Cookie_Domain'] = 'Cookie Domain';
$lang_install['Base_Help_Cookie_Domain'] = 'Cookie Domain.<br />Die Cookie Dom&auml;ne entspricht normalerweise der Dom&auml;ne Deiner Webseite.<br />Wenn Deine Webseite &uuml;ber <strong>www.meineseite.com</strong> aufzurufen ist, dann w&auml;re die Cookie-Dom&auml;ne <strong>meineseite.com</strong>';
$lang_install['Base_Cookie_Name_wrong_chars'] = 'In Deinem Cookienamen sind unerlaubte Zeichen enthalten';
$lang_install['Base_Cookie_Name_no_entry'] = 'Der Cookie Name enth&auml;lt Zeichen, die nicht erlaubt sind.';
$lang_install['Base_Cookie_Domain_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Cookie_Path'] = 'Cookie Pfad';
$lang_install['Base_Help_Cookie_Path'] = 'Cookie Pfad.<br />Wenn Deine Webseite &uuml;ber eine Subverzeichnis aufgerufen wird (also z.B. www.meineseite.com/sub), dann ist hier der Verzeichnisteil einzutragen (also z.B. /sub).';
$lang_install['Base_Cookie_Path_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Cookie_Name'] = 'Name des Cookies';
$lang_install['Base_Help_Cookie_Name'] = 'Name des Cookies.<br />Ein eindeuter Name f&uuml;r den Cookie.<br />Innerhalb Deiner Dom&auml;ne darf dieser Name nur einmal f&uuml;r einen Cookie vorkommen.<br />Der Cookienamen darf keine Umlaute und nur Zahlen oder Buchstaben umfassen. Keine Sonderzeichen.';
$lang_install['Base_Cookie_Name_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Board_Email'] = 'Email-Adresse des Webmasters';
$lang_install['Base_Help_Board_Email'] = 'Email-Adresse des Webmasters.<br />Wird f&uuml;r alle System-Emails als Absender verwendet.<br />In manchen Systemen muss dieser Absender mit den PHP-Einstellungen f&uuml;r SMTP-Versand &uuml;bereinstimmen.';
$lang_install['Base_Board_Email_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Board_Email_Sig'] = 'Signatur der Email';
$lang_install['Base_Help_Board_Email_Sig'] = 'Signatur der Email.<br />Maximal 200 Zeichen.<br />In einer Email oder Nachricht des Systems wird Dein Eintrag hier als Signatur (Unterschrift) verwendet.';
$lang_install['Base_Board_Email_Sig_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Board_Default_Lang'] = 'Standardsprache';
$lang_install['Base_Help_Board_Default_Lang'] = 'Standardsprache.<br />Die Grundspracheinstellung des Systems. Du kannst nur zwischen Sprachen w&auml;hlen, die bereits auf Deinem System installiert sind.<br />Kann sp&auml;ter in der Administration ge&auml;ndert werden.';
$lang_install['Base_Board_Default_Lang_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Board_Startdate'] = 'Startdatum der Seite';
$lang_install['Base_Help_Board_Startdate'] = 'Startdatum der Seite.<br />Wird als <strong>offizielles Startdatum</strong> Deiner Webseite genommen. Im Regelfall das Installationsdatum, wenn Deine Seite jedoch schon l&auml;nger verf&uuml;gbar ist, kannst Du die Einstellung hier &auml;ndern.';
$lang_install['Base_Board_Startdate_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Board_Dateformat'] = 'Standard Datumsformat';
$lang_install['Base_Help_Board_Dateformat'] = 'Standard Datumsformat.<br />Das hier eingegebene Format wird im gesamten System f&uuml;r die Aufbereitung der Datumsausgabe verwendet.';
$lang_install['Base_Board_Dateformat_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Board_Timezone'] = 'Zeitzone Deiner Seite';
$lang_install['Base_Help_Board_Timezone'] = 'Zeitzone.<br />Da Deine Webseite weltweit erreichbar ist - die Benutzer aber in unterschiedlichen Zeitzonen leben,<br />m&uuml;ssen alle Daten auf eine gemeinsame Basis bezogen werden.<br />Das ist die Zeitzone, die f&uuml;r Deine Seite g&uuml;ltig ist.<br />Im Regelfall nicht die Zeitzone, in der Du lebst, sondern die Zeitzone, in der Dein Server steht.';
$lang_install['Base_Board_Timezone_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Base_Conf_wrong'] = 'Wir haben Fehler in Deiner Basis Konfiguration festgestellt.<br />Bitte pr&uuml;fe Deine Eingaben.';
$lang_install['Base_Conf_ok'] = 'Wir konnten in Deiner Basis Konfiguration keinen Fehler erkennen.<br />Mit dem n&auml;chsten Schritt wird nun der Administrator angelegt.';
$lang_install['Base_From_Update'] = 'Du befindest Dich im Update-Modus.<br />Die angezeigten Informationen stammen aus Deinem existierenden System.';

// Language entries for creating Admin Account
$lang_install['Admin_Setup'] = 'Webseiten Administrator anlegen';
$lang_install['Admin_Configuration_Details'] = 'Administrator';
$lang_install['Admin_Name'] = 'Benutzername des Administrators (wird bei Beitr&auml;gen, die der Administrator schreibt angezeigt)';
$lang_install['Admin_Help_Name'] = 'Der Benutzername des Administrators wird an den Stellen, an denen ansonsten der Benutzername eines Benutzers steht, angezeigt.';
$lang_install['Admin_Name_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Admin_Homepage'] = 'Webseite des Administrators';
$lang_install['Admin_Help_Homepage'] = 'Webseite des Administrators<br />Auch der Administrator darf bei Bewertungen nicht mehrfach f&uuml;r seine eigene Seite stimmen, deshalb muss hier eine Webseite eingetragen werden.';
$lang_install['Admin_Homepage_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Admin_Password'] = 'Passwort';
$lang_install['Admin_Help_Password'] = 'Passwort<br />Das Passwort muss mindestens 6-stellig sein und nicht mehr als 25-stellig.';
$lang_install['Admin_Password2'] = 'Passwort wiederholen';
$lang_install['Admin_Password_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Admin_Password_not_match'] = 'Die Passw&ouml;rter stimmen nicht &uuml;berein';
$lang_install['Admin_Password_not_match_existing'] = 'Die Passw&ouml;rter stimmen nicht mit dem exisitierenden aus Deiner Datenbank &uuml;berein';
$lang_install['Admin_Help_Password2'] = 'Passwort wiederholen<br />Da das Passwort dieses Administrators nicht mehr &auml;nderbar ist, muss es noch einmal wiederholt werden um Fl&uuml;chtigkeitsfehler auszuschliessen.';
$lang_install['Admin_Lang'] = 'Spracheinstellung';
$lang_install['Admin_Help_Lang'] = 'Spracheinstellung.<br />Der Webseiteninhalt wird dem Administrator aufgrund dieser Spracheinstellung in der entsprechenden Sprache angezeigt.';
$lang_install['Admin_Lang_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Admin_Create_User'] = 'Soll ein gleichnamiger Benutzer angelegt werden ?';
$lang_install['Admin_Help_Create_User'] = 'Benutzer anlegen<br />Sicherheitstechnisch macht es Sinn, keinen Benutzer f&uuml;r diesen Administrator anzulegen.<br />Aus Bequemlichkeit (Benutzer = Administrator) wird das jedoch von den meisten Webseitenbetreibern so gehandhabt';
$lang_install['Admin_Create_User_no_entry'] = 'Das Feld darf nicht leer sein';
$lang_install['Admin_Conf_wrong'] = 'Wir haben Fehler in Deiner Eingaben festgestellt.<br />Bitte pr&uuml;fe Deine Eingaben.';
$lang_install['Admin_Conf_ok'] = 'Wir konnten in Deinen Eingaben keinen Fehler erkennen.<br />Mit dem n&auml;chsten Schritt werden nun die allgemeinen Grunddaten und Deine Basiskonfiguration in der Datenbank gespeichert.';

// Language entries for Database Step
$lang_install['Base_Information_Setup'] = 'Basis Informationen in die Datenbank einlesen';
$lang_install['Base_Information_Details'] = 'Datenbanktabellen in der Datenbank';
$lang_install['Base_Informations_NoNeed'] = 'Keine Grunddaten zum Einlesen vorhanden';
$lang_install['Base_Informations_ToDo'] = 'Grunddaten zum Einlesen vorhanden';
$lang_install['Base_Informations_Done'] = 'Grunddaten bereits eingelesen';
$lang_install['Base_Informations_ready'] = 'Die Grunddaten sind nun in der Datenbank eingepflegt.<br />Es ist -soweit uns bekannt- kein Fehler aufgetreten.<br />Die Installation ist somit erfolgreich beendet.';
$lang_install['Base_Informations_in_process'] = 'Die Grunddaten werden eingepflegt ... bitte nicht unterbrechen !!';
$lang_install['Base_Information_DB_Success'] = 'Basis Informationen erfolgreich in die Datenbank eingelesen';
$lang_install['Base_Informations_ready_error'] = 'Es ist ein Fehler beim einf&uuml;gen der Basisdaten in die Datenbank aufgetreten.<br />Bitte pr&uuml;fe Deine Installation.<br />Die Installation ist somit nicht erfolgreich beendet.';

// Language entries for Last Step
$lang_install['Information_Setup_Ready'] = 'Gratulation!<br />Die Installation ist nun beendet.';
$lang_install['Information_Setup_Ready_allok'] = 'Wir konnten w&auml;hrend der Installation keinen Fehler erkennen.<br/>D.h. Deine Webseite ist f&uuml;r die Benutzung nun grunds&auml;tzlich eingerichtet.';
$lang_install['Information_Setup_Ready_nostep'] = 'Es wurden nicht alle Installationsschritte durchgef&uuml;hrt.<br />Bei den durchgef&uuml;hrten Installationsschritten konnten wir keinen Fehler erkennen.<br />Ob Deine Webseite funktioniert, k&ouml;nnen wir nicht sagen, Du kannst die Installation erneut starten oder Deine Webseite testen.';
$lang_install['Information_Setup_Ready_error'] = 'Es sind schwere Fehler w&auml;hrend der Installation aufgetreten.<br />Wir empfehlen Dir, das Logbuch zu pr&uuml;fen und die Installation erneut durchzuf&uuml;hren.';
$lang_install['Information_Setup_Ready_noinfo'] = 'Wir haben keine Information &uuml;ber den Zustand Deiner Installation.<br />D.h. wir k&ouml;nnen weder sagen, ob Du eine Installation durchgef&uuml;hrt hast, noch ob Fehler aufgetreten sind.<br />Wir empfehlen die Installation erneut zu starten.';
$lang_install['Information_Setup_GoHome'] = 'Zu Deiner Webseite';
$lang_install['Information_Setup_GoAdmin'] = 'Zur Administration Deiner Webseite';
$lang_install['Donate'] = 'Diese Software wurde in unserer Freizeit entwickelt. Bitte honoriere unsere Arbeit mit einer Spende.';

// Language entries for Database fields

$lang_install['Page_Top']    = 'Seite oben';
$lang_install['Left_Block']  = 'Linker Block';
$lang_install['Page_Bottom'] = 'Seite unten';
$lang_install['Group_Administrators'] = 'Administratoren';
$lang_install['Group_Moderators'] = 'Moderatoren';

$lang_install['bbboard_message_1'] = 'Diese Nachricht wird auf allen Seiten und f&uuml;r alle Besucher angezeigt. Begrenzt auf 80% der verf&uuml;gbaren Breite.';
$lang_install['bbboard_message_2'] = 'Diese Nachricht wird nur auf der Index-Seite und nur f&uuml;r angemeldete Benutzer gezeigt.';

$lang_install['bbcategories_cat_title'] = 'Allgemein';

$lang_install['bbconfig_board_disable_msg'] = 'Diese Webseite ist momentan gesperrt...';
$lang_install['bbconfig_default_dateformat'] = 'D d-M-Y H:i';
$lang_install['bbconfig_locked_view_open'] = 'Geschlossen: <strike>';
$lang_install['bbconfig_locked_view_close'] = '</strike>';
$lang_install['bbconfig_global_view_open'] = 'Globale Ank&uuml;ndigung:';
$lang_install['bbconfig_global_view_close'] = '';
$lang_install['bbconfig_announce_view_open'] = 'Ank&uuml;ndigung:';
$lang_install['bbconfig_announce_view_close'] = '';
$lang_install['bbconfig_sticky_view_open'] = 'Information:';
$lang_install['bbconfig_sticky_view_close'] = '';
$lang_install['bbconfig_moved_view_open'] = 'Verschoben:';
$lang_install['bbconfig_moved_view_close'] = '';

$lang_install['bbextension_groups_Images'] = 'Bilder';
$lang_install['bbextension_groups_Archives'] = 'Archive';
$lang_install['bbextension_groups_Plain_Text'] = 'Nur Text';
$lang_install['bbextension_groups_Documents'] = 'Dokumente';
$lang_install['bbextension_groups_Real_Media'] = 'Real Media';
$lang_install['bbextension_groups_Streams'] = 'Streams';
$lang_install['bbextension_groups_Flash_Files'] = 'Flash Dateien';

$lang_install['bbforums_forum_name'] = 'Hauptkategorie';

$lang_install['bbgroups_group_name_Anonymous'] = 'G&auml;ste';
$lang_install['bbgroups_group_name_Moderators'] = 'Moderatoren';
$lang_install['bbgroups_group_description_Moderators'] = 'Moderatoren dieses Forums';
$lang_install['bbgroups_group_name_Administrators'] = 'Administratoren';
$lang_install['bbgroups_group_description_Administrators'] = 'Administratoren dieses Forums';
$lang_install['bbgroups_group_name_Users'] = 'Benutzer';
$lang_install['bbgroups_group_description_Users'] = 'Allgemeine Benutzergruppe';

$lang_install['bbposts_text_post_subject'] = 'Willkommen bei Nuke-Evolution!';
$lang_install['bbposts_text_post_text'] = 'Danke f&uuml;r die Installation von Nuke-Evolution German Edition.\r\n\r\nDas Evo Team hat eine Menge harter Arbeit in diesen Release investiert, um ihn schneller, funktionabler und sicherer zu machen. Wir ermuntern dich dazu, die enthaltene Dokumentation komplett durchzulesen, so dass du ein umfassendes Verst&auml;ndnis der M&ouml;glichkeiten mit Evo erh&auml;lst.\r\n\r\nInnerhalb der originalen Archive sind einige Verzeichnisse mit n&uuml;tzlichen Informationen enthalten.\r\n\r\nDer erste ist der Installationsordner, wobei wir davon ausgehen, dass du diesen bereits kennst. Darin enthalten sind ausserdem drei Dokumente, die dir dabei helfen, dein Evo zu installieren und zu konfigurieren. Solltest du diese noch nicht vollst&auml;ndig durchgelesen haben, so mache es JETZT !!\r\n\r\nDer Zweite ist das Hilfe-Verzeichnis. Darin wirst du einige sehr hilfreiche Dokumentationen finden, die unser Team zusammengestellt hat um einige der M&ouml;glichkeiten des Evo zu erl&auml;utern. Ebenso findest du ein paar Dokumente, die dir bei Fehlern, Browsereinstellungen und nicht korrekter Installation weiter helfen k&ouml;nnen.\r\n\r\nDer Dritte ist das Verzeichnis f&uuml;r den Themen-Editor. Wenn du ein PHP-Nuke Thema nach Evo konvertieren m&ouml;chtest, so hast du den Anleitungen in diesem Ordner zu folgen.\r\n\r\nWir sind sicher, dass Evo die Beste Nuke-Software ist, die du jemals hattest. Geniesse und schaue immer wieder mal bei www.nuke-evolution.de f&uuml;r Support, Updates oder einfach um Hi! zu sagen vorbei. \r\n\r\n[b:16f8943d60]- Das Nuke-Evolution Team[/b:16f8943d60]';

$lang_install['bbquota_limits_Low'] = 'Gering';
$lang_install['bbquota_limits_Medium'] = 'Normal';
$lang_install['bbquota_limits_High'] = 'Hoch';

$lang_install['bbranks_rank_title_Site_Owner'] = 'Seiteninhaber';
$lang_install['bbranks_rank_title_Site_Admin'] = 'Administrator';

$lang_install['bbsmilies_Very_Happy'] = 'Sehr Gl&uuml;cklich';
$lang_install['bbsmilies_Smile'] = 'Grinsen';
$lang_install['bbsmilies_Sad'] = 'Schlecht';
$lang_install['bbsmilies_Surprised'] = '&Uuml;berrascht';
$lang_install['bbsmilies_Shocked'] = 'Schockiert';
$lang_install['bbsmilies_Confused'] = 'Durcheinander';
$lang_install['bbsmilies_Cool'] = 'Cool';
$lang_install['bbsmilies_Laughing'] = 'Lachen';
$lang_install['bbsmilies_Mad'] = '&Uuml;bel';
$lang_install['bbsmilies_Razz'] = 'Razz';
$lang_install['bbsmilies_Embarassed'] = 'Verwirrt';
$lang_install['bbsmilies_Crying_or_Very_sad'] = 'Heulen oder sehr schlecht';
$lang_install['bbsmilies_Evil_or_Very_Mad'] = 'Teuflisch oder sehr &Uuml;bel';
$lang_install['bbsmilies_Twisted_Evil'] = 'unehrlicher Teufel';
$lang_install['bbsmilies_Rolling_Eyes'] = 'rollende Augen';
$lang_install['bbsmilies_Wink'] = 'Winken';
$lang_install['bbsmilies_Exclamation'] = 'Ausrufezeichen';
$lang_install['bbsmilies_Question'] = 'Frage';
$lang_install['bbsmilies_Idea'] = 'Idee';
$lang_install['bbsmilies_Arrow'] = 'Pfeil';
$lang_install['bbsmilies_Neutral'] = 'Neutral';
$lang_install['bbsmilies_Mr_Green'] = 'Mr. Green';

$lang_install['bbstats_module_info_long_name_modul1'] = 'Statistics Overview Section';
$lang_install['bbstats_module_info_extra_info_modul1'] = 'This Module will print out a link Block with Links to the current Module at the Statistics Site.\nYou are able to define the number of columns displayed for this Module within the Administration Panel -&gt; Edit Module.';
$lang_install['bbstats_module_info_long_name_modul2'] = 'Top Posters';
$lang_install['bbstats_module_info_extra_info_modul2'] = 'This Module displays the Top Posters from your board.\nAnonymous Poster are not counted.';
$lang_install['bbstats_module_info_long_name_modul3'] = 'Administrative Statistics';
$lang_install['bbstats_module_info_extra_info_modul3'] = 'This Module displays some Admin Statistics about your Board.\nIt is nearly the same you are able to see within the first Administration Panel visit.';
$lang_install['bbstats_module_info_long_name_modul4'] = 'Most viewed topics';
$lang_install['bbstats_module_info_extra_info_modul4'] = 'This Module displays the most viewed topics at your board.';
$lang_install['bbstats_module_info_long_name_modul5'] = 'Top Posters this Month (Site History Mod)';
$lang_install['bbstats_module_info_extra_info_modul5'] = 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Monthly basis.';
$lang_install['bbstats_module_info_long_name_modul6'] = 'New topics by month';
$lang_install['bbstats_module_info_extra_info_modul6'] = 'This Module will display the topics created at your Board in a monthly statistic.';
$lang_install['bbstats_module_info_long_name_modul7'] = 'Most Interesting Topics';
$lang_install['bbstats_module_info_extra_info_modul7'] = 'This module will show the most interesting topics.';
$lang_install['bbstats_module_info_long_name_modul8'] = 'Top Words';
$lang_install['bbstats_module_info_extra_info_modul8'] = 'This Module displays the most used words on your board.';
$lang_install['bbstats_module_info_long_name_modul9'] = 'Least Interesting Topics';
$lang_install['bbstats_module_info_extra_info_modul9'] = 'This module will show the least interesting topics.';
$lang_install['bbstats_module_info_long_name_modul10'] = 'Most Active Topicstarter';
$lang_install['bbstats_module_info_extra_info_modul10'] = 'This Module displays the most active topicstarter on your board.\nAnonymous Poster are not counted.';
$lang_install['bbstats_module_info_long_name_modul11'] = 'Top Smilies';
$lang_install['bbstats_module_info_extra_info_modul11'] = 'This Module displays the Top Smilies used at your board.\nThis Module uses an Smilie Index Table for caching the smilie data and to not\nrequire re-indexing of all posts.';
$lang_install['bbstats_module_info_long_name_modul12'] = 'New users by month';
$lang_install['bbstats_module_info_extra_info_modul12'] = 'This Module will display the users registered to your Board in a monthly statistic.';
$lang_install['bbstats_module_info_long_name_modul13'] = 'New posts by month';
$lang_install['bbstats_module_info_extra_info_modul13'] = 'This Module will display the posts created at your Board in a monthly statistic.';
$lang_install['bbstats_module_info_long_name_modul14'] = 'Top Posters this Week (Site History Mod)';
$lang_install['bbstats_module_info_extra_info_modul14'] = 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Weekly basis.';
$lang_install['bbstats_module_info_long_name_modul15'] = 'Top Downloaded Attachments';
$lang_install['bbstats_module_info_extra_info_modul15'] = 'This Module will print out the most downloaded Files.\nThe Attachment Mod Version 2.3.x have to be installed in order to let this Module work.\nYou are able to exclude Images from the statistic too.';
$lang_install['bbstats_module_info_long_name_modul16'] = 'Most active Topics';
$lang_install['bbstats_module_info_extra_info_modul16'] = 'This Module displays the most active topics at your board.';

$lang_install['bbthemes_name_tr_color1_name'] = 'Die hellste Zeilenfarbe';
$lang_install['bbthemes_name_tr_color2_name'] = 'Mittlere Zeilenfarbe';
$lang_install['bbthemes_name_tr_color3_name'] = 'Dunkelste Zeilenfarbe';
$lang_install['bbthemes_name_tr_class1_name'] = '';
$lang_install['bbthemes_name_tr_class2_name'] = '';
$lang_install['bbthemes_name_tr_class3_name'] = '';
$lang_install['bbthemes_name_th_color1_name'] = 'Randfarbe f&uuml;r einen Rand um die komplette Seite';
$lang_install['bbthemes_name_th_color2_name'] = '&Auml;&szlig;erer Tabellenrand';
$lang_install['bbthemes_name_th_color3_name'] = 'Innerer Tabellenrand';
$lang_install['bbthemes_name_th_class1_name'] = 'Silber gradient Bild';
$lang_install['bbthemes_name_th_class2_name'] = 'Blauer gradient Bild';
$lang_install['bbthemes_name_th_class3_name'] = 'Fade-out gradient';
$lang_install['bbthemes_name_td_color1_name'] = 'Hintergrund f&uuml;r Quote-Bereiche';
$lang_install['bbthemes_name_td_color2_name'] = 'Alle wei&szlig;en Bereiche';
$lang_install['bbthemes_name_td_color3_name'] = '';
$lang_install['bbthemes_name_td_class1_name'] = 'Hintergrundfarbe f&uuml;r Themenbeitr&auml;ge';
$lang_install['bbthemes_name_td_class2_name'] = '2.te Hintergrundfarbe f&uuml;r Themenbeitr&auml;ge';
$lang_install['bbthemes_name_td_class3_name'] = '';
$lang_install['bbthemes_name_fontface1_name'] = 'Hauptschriftart';
$lang_install['bbthemes_name_fontface2_name'] = 'Zus&auml;tzliche Thementitel Schriftart';
$lang_install['bbthemes_name_fontface3_name'] = 'Schriftart f&uuml;r Formulare';
$lang_install['bbthemes_name_fontsize1_name'] = 'Kleinste Schriftgr&ouml;sse';
$lang_install['bbthemes_name_fontsize2_name'] = 'Mittlere Schriftgr&ouml;sse';
$lang_install['bbthemes_name_fontsize3_name'] = 'Standard Schriftgr&ouml;sse';
$lang_install['bbthemes_name_fontcolor1_name'] = 'Quote &amp; Copyright Textfarbe';
$lang_install['bbthemes_name_fontcolor2_name'] = 'Code Textfarbe';
$lang_install['bbthemes_name_fontcolor3_name'] = 'Farbe f&uuml;r die &Uuml;berschrift der Haupttabellen';
$lang_install['bbthemes_name_span_class1_name'] = '';
$lang_install['bbthemes_name_span_class2_name'] = '';
$lang_install['bbthemes_name_span_class3_name'] = '';

$lang_install['bbtopics_topic_title'] = 'Willkommen bei Nuke-Evolution!';

$lang_install['bbxdata_fields_field_name_icq'] = 'ICQ Nummer';
$lang_install['bbxdata_fields_field_name_aim'] = 'AIM Adresse';
$lang_install['bbxdata_fields_field_name_msn'] = 'MSN Messenger';
$lang_install['bbxdata_fields_field_name_yim'] = 'Yahoo Messenger';
$lang_install['bbxdata_fields_field_name_website'] = 'Webseite';
$lang_install['bbxdata_fields_field_name_location'] = 'Herkunft';
$lang_install['bbxdata_fields_field_name_occupation'] = 'Beruf';
$lang_install['bbxdata_fields_field_name_interests'] = 'Interessen';
$lang_install['bbxdata_fields_field_name_signature'] = 'Signatur';

$lang_install['blocks_bkey_Main_Menu'] = 'Hauptmen&uuml;';
$lang_install['blocks_bkey_Administration'] = 'Administration';
$lang_install['blocks_bkey_Search'] = 'Suchen';
$lang_install['blocks_bkey_Survey'] = 'Umfrage';
$lang_install['blocks_bkey_Information'] = 'Informationen';
$lang_install['blocks_bkey_User_Info'] = 'Benutzerinfo';
$lang_install['blocks_bkey_Nuke_Evolution'] = 'Nuke-Evolution';
$lang_install['blocks_bkey_Hacker_Beware'] = 'Hackerschutz';
$lang_install['blocks_bkey_Top_10_Downloads'] = 'Top 10 Downloads';
$lang_install['blocks_bkey_Top_10_Links'] = 'Top 10 Links';
$lang_install['blocks_bkey_Forums'] = 'Foren';
$lang_install['blocks_bkey_Submissions'] = 'Submissions';
$lang_install['blocks_bkey_Link_to_us'] = 'Link zu uns';
$lang_install['blocks_bkey_Donations'] = 'Spenden';

$lang_install['config_slogan'] = 'Dein Wahlspruch hier';
$lang_install['config_foot1'] = '<a href="modules.php?name=Spambot_Killer" target="_blank">Spambot Killer</a><br /><a href="modules.php?name=Site_Map" target="_blank"><strong>Site Map</strong></a><br />';
$lang_install['config_foot2'] = '<a href="rss.php?feed=news" target="_blank"><img border="0" src="images/powered/feed_20_news.png" width="94" height="15" alt="[News Feed]" title="News Feed" /></a> <a href="rss.php?feed=forums" target="_blank"><img border="0" src="images/powered/feed_20_forums.png" width="94" height="15" alt="[Forums Feed]" title="Forums Feed" /></a> <a href="rss.php?feed=downloads" target="_blank"><img border="0" src="images/powered/feed_20_down.png" width="94" height="15" alt="[Downloads Feed]" title="Downloads Feed" /></a> <a href="rss.php?feed=weblinks" target="_blank"><img border="0" src="images/powered/feed_20_links.png" width="94" height="15" alt="[Web Links Feed]" title="Web Links Feed" /></a>  <a href="http://htmlpurifier.org/"><img src="images/powered/html_purifier_powered.png" alt="Powered by HTML Purifier" border="0" /></a> <a href="http://tool.motoricerca.info/robots-checker.phtml?checkreferer=1" target="_blank"><img border="0" src="images/powered/valid-robots.png" width="80" height="15" alt="[Validate robots.txt]" title="Validate robots.txt" /></a><br />';
$lang_install['config_foot3'] = '';
$lang_install['config_anonymous'] = 'Anonym';
$lang_install['config_backend_title'] = 'EVO CMS Powered Site';
$lang_install['config_notify_subject'] = 'Neuer Artikel auf Deiner Webseite';
$lang_install['config_notify_message'] = 'Hey! Es wurde ein neuer Artikel auf Deiner Webseite eingereicht.';

$lang_install['cnbya_config_tos_text'] = 'Das ist der voreingestellte TOS (Terms of Service). Der Text kann in der Evo-Administration - Einstellungen verändert werden.';

$lang_install['donators_config_block_message'] = 'Ist diese Seite hilfreich? Unterst&uuml;tze uns durch eine kleine Spende.';
$lang_install['donators_config_gen_donation_name'] = 'Spenden';
$lang_install['donators_config_gen_currency'] = 'EUR';
$lang_install['donators_config_gen_date_format'] = 'd/m/Y';
$lang_install['donators_config_gen_thank_message'] = 'Wir bedanken uns f&uuml;r die freundliche Spende!<br /><br />Bitte besuche uns bald wieder!';
$lang_install['donators_config_gen_cancel_message'] = 'Sorry, aber Du kannst keine Spende t&auml;tigen!<br /><br />Versuche es sp&auml;ter wieder!';

$lang_install['downloads_categories_title'] = 'Hauptkategorie';
$lang_install['downloads_categories_cdescription'] = 'Hauptkategorie - angelegt w&auml;hrend der Installation';

$lang_install['evo_userinfo_good_afternoon'] = 'Guten Abend';
$lang_install['evo_userinfo_username'] = 'Benutzername';
$lang_install['evo_userinfo_show_ip'] = 'Zeige IP';
$lang_install['evo_userinfo_avatar'] = 'Avatar';
$lang_install['evo_userinfo_personal_message'] = 'Pers&ouml;nliche Nachricht';
$lang_install['evo_userinfo_rank'] = 'Rang';
$lang_install['evo_userinfo_mostever'] = 'Online Rekord';
$lang_install['evo_userinfo_language'] = 'Sprache';
$lang_install['evo_userinfo_Break'] = 'Break';
$lang_install['evo_userinfo_pms'] = 'PNs';
$lang_install['evo_userinfo_themes'] = 'Themen';
$lang_install['evo_userinfo_login'] = 'Login/Logout/Registrieren';
$lang_install['evo_userinfo_members'] = 'Mitglieder';
$lang_install['evo_userinfo_online'] = 'Online';
$lang_install['evo_userinfo_users'] = 'Benutzer';
$lang_install['evo_userinfo_posts'] = 'Beitr&auml;ge';

$lang_install['evo_userinfo_addons_good_afternoon_message'] = 'Guten Morgen %name%:';
$lang_install['evo_userinfo_addons_personal_message_message'] = '<div align="center">Hallo %name%, <br />Willkommen auf %site%.</div>';

$lang_install['evolution_censor_words'] = 'ass asshole arse bitch bullshit c0ck clit cock crap cum cunt fag faggot fuck fucker fucking fuk fuking motherfucker pussy shit tits twat';

$lang_install['links_categories_title'] = 'Hauptkategorie';
$lang_install['links_categories_cdescription'] = 'Hauptkategorie - angelegt w&auml;hrend der Installation';


$lang_install['modules_meta_keywords'] = 'Nuke-Evolution, evo, pne, evolution, nuke, php-nuke, software, downloads, community, forums, bulletin, boards, cms, nuke-evo, phpnuke';

$lang_install['modules_title_Advertising'] = 'Werbung';
$lang_install['modules_title_Content'] = 'Inhalt';
$lang_install['modules_title_Docs'] = 'Impressum';
$lang_install['modules_title_Donations'] = 'Projektunterst&uuml;tzung';
$lang_install['modules_title_Downloads'] = 'Downloads';
$lang_install['modules_title_FAQ'] = 'FAQ';
$lang_install['modules_title_Feedback'] = 'Kontakt';
$lang_install['modules_title_Forums'] = 'Diskussionen';
$lang_install['modules_title_Groups'] = 'Gruppen';
$lang_install['modules_title_News'] = 'Artikel';
$lang_install['modules_title_NukeSentinel'] = 'NukeSentinel';
$lang_install['modules_title_Private_Messages'] = 'Private Nachrichten';
$lang_install['modules_title_Profile'] = 'Profil';
$lang_install['modules_title_Recommend_Us'] = 'Empfehle uns';
$lang_install['modules_title_Reviews'] = 'Testberichte';
$lang_install['modules_title_Search'] = 'Suchen';
$lang_install['modules_title_Site_Map'] = 'Seiten&uuml;bersicht';
$lang_install['modules_title_Spambot_Killer'] = 'Spambot Killer';
$lang_install['modules_title_Statistics'] = 'Statistiken';
$lang_install['modules_title_Stories_Archive'] = 'Artikel Archiv';
$lang_install['modules_title_Submit_News'] = 'Artikel einreichen';
$lang_install['modules_title_Supporters'] = 'Unterst&uuml;tzt durch';
$lang_install['modules_title_Surveys'] = 'Umfragen';
$lang_install['modules_title_Top'] = 'Top 10';
$lang_install['modules_title_Topics'] = 'Themenbereiche';
$lang_install['modules_title_Web_Links'] = 'Web Links';
$lang_install['modules_title_Your_Account'] = 'Dein Konto';

$lang_install['modules_cat_Home'] = 'Home';
$lang_install['modules_cat_Members'] = 'Mitglieder';
$lang_install['modules_cat_Community'] = 'Community';
$lang_install['modules_cat_Statistics'] = 'Statistiken';
$lang_install['modules_cat_Files_Links'] = 'Dateien&nbsp;&amp;&nbsp;Links';
$lang_install['modules_cat_News'] = 'Neuigkeiten';
$lang_install['modules_cat_Other'] = 'Sonstiges';


$lang_install['modules_links_title'] = 'Home';

$lang_install['poll_data_optionText_1'] = 'Ummmm, nicht schlecht';
$lang_install['poll_data_optionText_2'] = 'Cool';
$lang_install['poll_data_optionText_3'] = 'Schrecklich';
$lang_install['poll_data_optionText_4'] = 'Die allerbeste!';
$lang_install['poll_data_optionText_5'] = 'was, zur H&ouml;lle ist das?';
$lang_install['poll_data_optionText_6'] = '';
$lang_install['poll_data_optionText_7'] = '';
$lang_install['poll_data_optionText_8'] = '';
$lang_install['poll_data_optionText_9'] = '';
$lang_install['poll_data_optionText_10'] = '';
$lang_install['poll_data_optionText_11'] = '';
$lang_install['poll_data_optionText_12'] = '';

$lang_install['poll_desc_pollTitle'] = 'Was denkst Du &uuml;ber diese Webseite?';
$lang_install['poll_desc_planguage'] = 'german';

$lang_install['quotes_quote'] = 'Nos morituri te salutamus - CBHS';

$lang_install['reviews_categories_title'] = 'Hauptkategorie';
$lang_install['reviews_categories_cdescription'] = 'Hauptkategorie - angelegt w&auml;hrend der Installation';

$lang_install['stories_title'] = 'Willkommen auf EVO CMS';
$lang_install['stories_hometext'] = 'Willkommen auf EVO CMS.<br /><br />Wir empfehlen jetzt das Anlegen eines zus&auml;tzlichen Administrators f&uuml;r die t&auml;gliche Arbeit. Du kannst das &uuml;ber die Administrationsoberfl&auml;che machen <a href="admin.php">hier klicken</a>.<br /><br /><br /><br /><strong>Hinweis:</strong> Dieser Artikel kann entweder &uuml;ber die Artikelverwaltung oder durch klicken auf den L&ouml;schbutton unterhalb gel&ouml;scht werden.';

$lang_install['stories_cat_Articles'] = 'Artikel';

$lang_install['themes_custom_name'] = 'Chromo';

$lang_install['topics_text'] = 'EVO CMS';
$lang_install['topics_name'] = 'evolution';

$lang_install['users_name_Anonymous'] = 'Gast';
$lang_install['users_timezone_Anonymous'] = '1.00';
$lang_install['users_lang_Anonymous'] = 'german';
$lang_install['users_dateformat_Anonymous'] = 'D d-M-Y H:i';

?>