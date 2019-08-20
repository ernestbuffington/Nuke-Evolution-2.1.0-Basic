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
$lang_install['Next']  = 'VERDER';
$lang_install['Back']  = 'TERUG';
$lang_install['Restart']  = 'HERSTART';
$lang_install['Help']  = 'HELP';
$lang_install['IMG_OK']  = 'Check is ok';
$lang_install['IMG_BAD']  = 'Check mislukt';
$lang_install['IMG_WARN']  = 'Alleen een waarschuwing, geen fout';
$lang_install['IMG_DONE']  = 'Klaar';

// General entries with UTF-8 support
$lang_install['Langcode'] = 'nl-nl';
$lang_install['Landdir']  = 'ltr';
$lang_install['No']  = 'Nee';
$lang_install['Yes']  = 'Ja';

$lang_install['Head_Title'] = 'Installatie';
$lang_install['Block_Title'] = 'Status';
$lang_install['Block_Step_0'] = 'Welkom';
$lang_install['Block_Step_1'] = 'Infos';
$lang_install['Block_Step_2'] = 'Bestands-Configuratie';
$lang_install['Block_Step_3'] = 'DB-Configuratie';
$lang_install['Block_Step_4'] = 'DB-Installatie';
$lang_install['Block_Step_5'] = 'Basis Configuratie';
$lang_install['Block_Step_6'] = 'Administrator aanmaken';
$lang_install['Block_Step_7'] = 'DB-Basis gegevens';
$lang_install['Block_Step_8'] = 'Klaar';
$lang_install['Block_Step_9'] = 'Logboek';

// Help-System
if (!defined('_EVO_HELPSYSTEM')) {
    define('_EVO_HELPSYSTEM', 'Evo Help');
}

// Step Welcome
$lang_install['Welcome'] = 'Gefeliciteerd<br/><br/>u staat op het punt >> '.$var_install['version'].' << te installeren<br/>Deze installatieprocedure bevat het verzamelen van informatie, Systeemtests en zal u erbij helpen een solide ondergrond te creeren voor uw systeem.';
$lang_install['Language_Select'] = 'Indien hier geen andere talen weergegeven worden zijn deze nog niet op de server aanwezig.';
$lang_install['License_Header'] = 'Lees AUB eerst de licentieovereenkomst zorgvuldig door en bevestig dan uw toestemming';
$lang_install['License_Agreement'] = 'Indien u met de installatie doorgaat accepteerd u de licentieovereenkomst';
$lang_install['License_Text'] = '
               B E L A N G R I J K E  I N F O R M A T I E
           ---------------------------------------------	-----
Wettelijke basis voor het gebruik van deze software valt onder GPL (General Public License).
Deze software wordt beheerd onder GPL en dus zoals elke andere software in principe onder de bescherming van het auteursrecht. Dat betekend dat derden deze software niet naar eigen inzicht mogen bewerken en distributeren, maar zich aan bepaalde regels dienen te houden.

Voor dit pakket dat onder GPL valt geld ook het volgende:
a) Het verwijderen, veranderen of het onderdrukken van de weergave van de Copyrights, Credits of andere zaken die een soortgelijk karakter hebben is verboden.
b) Het verwijderen, veranderen of het onderdrukken van de weergave van de Copyrights van de in het pakket bevindende modules, blokken, maar ook credits of andere zaken die een soortgelijk karakter hebben is verboden.

Rechten en plichten (Uittreksel)
===================================

Belangrijke bepalingen van het GPL sind die &#167;&#167; 1 bis 4. Nach &#167; 1 ist jeder Nutzer berechtigt, die Software mit Quelltext zu kopieren und zu verbreiten, soweit ein entsprechender Copyright-Vermerk, ein Haftungsausschluss und die Lizenzbedingungen beigef&uuml;gt werden. Nach &#167; 2 ist auch die Bearbeitung der Software grunds&auml;tzlich erlaubt. Wird diese ver&auml;nderte Softwareversion jedoch in Umlauf gebracht, dann m&uuml;ssen weitere drei Voraussetzungen erf&uuml;llt sein:  

    * De aangepaste bestanden dienen met een verwerkingsnota gedateerd worden.
    * De Software moet ook in aangepaste form volledig onder de GPL vallen.
    * Bij uitvoering van interactieve opdrachten moet eenmalig een copyright merk, een uitsluiting van garantie en een bron van de licentie worden weergegeven.

Naar &#167; 3 is tevens daar voor te zorgen dat de gebruiker van de bewerkte versie de broncode beschikbaar steld. Dit kan worden gedaan door het feit dat op diskettes of een schriftelijk aanbod geleverd wordt uitgesproken over de latere oplevering van de broncode. &#167; 4 regelt de naleving van de licentievoorwaarden. Insoweit verliert der Nutzer automatisch im Rahmen einer aufl&ouml;senden Bedingung die Nutzungserlaubnis, sobald gegen die Lizenzbestimmungen der GPL versto&szlig;en wird. Arbeitet daher ein Programmierer dieses Packet um und bindet es in eine propriet&auml;re (kostenpflichtige Standard-) Software zum Weitervertrieb ein, so entf&auml;llt sein Nutzungsrecht und er kann auf Unterlassung in Anspruch genommen werden. Anspruchsberechtigt f&uuml;r diesen Unterlassungsanspruch sind s&auml;mtliche (Mit-) Urheber der Software (&#167; 8 UrhG), deren Anzahl schnell den zweistelligen Bereich erreichen kann. &#167; 6 GPL stellt fest, dass der Lizenzvertrag stets zwischen den urspr&uuml;nglichen Urheber und dem Empf&auml;nger zustande kommt, nicht etwa im Rahmen einer Unterlizenz von Nutzer auf den nachfolgenden Nutzer.


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
$lang_install['Step']    = 'Stap';
$lang_install['Last_Step']    = 'Laatste stap';
$lang_install['Log_Message']    = 'Logboekbericht';
$lang_install['Submit'] = 'Invoer verturen';

$lang_install['Installation_started'] = 'Installatie gestart';
$lang_install['Server_Configuration_Details'] = 'Details server configuratie';
$lang_install['Server_Configuration_Summary'] = 'Samenvatting server configuratie';
$lang_install['DB_Installation'] = 'Aanmaken database tabellen';
$lang_install['Installation_Start_failed'] = 'Sorry, maar er zijn kritische punten gevonden die een succesvolle installatie van Nuke-Evolution niet garanderen.<br/>Klik op "Help" en lees onze Wiki, die een voorwaarde zijn voor een goede installatie.<br/>Tips en Tricks zoals Hoster, die een passende omgeving voor Nuke-Evolution bieden, vind u in onze forum.';
$lang_install['Errors_found'] = 'Gevonden fout';
$lang_install['Warnings_found'] = 'Gevonden waarschuwing';

$lang_install['File_Setup'] = 'Bestands configuratie';
$lang_install['File_error'] = 'Fout: Het bestand is niet gevonden.';
$lang_install['File_notchanged'] = 'Waarschuwing: Het bestand kon niet aangepast worden';
$lang_install['File_done'] = 'Alles Ok: Het bestand kon correct aangepast worden';
$lang_install['File_htaccess'] = 'Bestand: .htacess';
$lang_install['File_Help_htaccess'] = '';
$lang_install['File_staccess'] = 'Bestand: .staccess';
$lang_install['File_Help_staccess'] = '';
$lang_install['File_ultramode'] = 'Bestand: Ultramode';
$lang_install['File_Help_ultramode'] = '';
$lang_install['File_errorlog'] = 'Bestand voor foutmeldingen: errorlog.txt';
$lang_install['File_Help_errorlog'] = '';
$lang_install['File_adminlog'] = 'Bestand voor administratieve meldingen: adminlog.txt';
$lang_install['File_Help_adminlog'] = '';
$lang_install['File_ForumsCacheDir'] = 'Map: Forum Cache';
$lang_install['File_Help_ForumsCacheDir'] = '';
$lang_install['File_FilesDir'] = 'Map: Forum bestand/Download';
$lang_install['File_Help_FilesDir'] = '';
$lang_install['File_FilesThumbDir'] = 'Map: Forum preview';
$lang_install['File_Help_FilesThumbDir'] = '';
$lang_install['File_AvatarDir'] = 'Map: Avatars';
$lang_install['File_Help_AvatarDir'] = '';
$lang_install['File_LangBBCode'] = 'Bestand: Taalbestand voor BBCode';
$lang_install['File_Help_LangBBCode'] = '';
$lang_install['File_LangFAQ'] = 'Bestand: Taalbestand voor FAQ';
$lang_install['File_Help_LangFAQ'] = '';
$lang_install['File_LangFAQAttach'] = 'Bestand: Taalbestand voor FAQ bijlages';
$lang_install['File_Help_LangFAQAttach'] = '';
$lang_install['File_LangRules'] = 'Bestand: Taalbestand voor forumregels';
$lang_install['File_Help_LangRules'] = '';
$lang_install['File_ForumModules'] = 'Map: Forum modules';
$lang_install['File_Help_ForumModules'] = '';
$lang_install['File_ForumModulesCache'] = 'Map: Forum module Cache';
$lang_install['File_Help_ForumModulesCache'] = '';
$lang_install['File_ForumModulesCacheExplain'] = 'Map: Forum module Cache omschrijving';
$lang_install['File_Help_ForumModulesCacheExplain'] = '';
$lang_install['File_SupportersImagesSupporters'] = 'Map: Supporter Banner';
$lang_install['File_Help_SupportersImagesSupporters'] = '';
$lang_install['File_IncludesCache'] = 'Verzeichnis: Cache map';
$lang_install['File_Help_IncludesCache'] = '';
$lang_install['File_IncludesCacheFile'] = 'Bestand: Cache bestand';
$lang_install['File_Help_IncludesCacheFile'] = '';
$lang_install['File_HTMLPurifierDecorator'] = 'Map: HTML-Purifier Decorator';
$lang_install['File_Help_HTMLPurifierDecorator'] = '';
$lang_install['File_HTMLPurifierSerializer'] = 'Map: HTML-Purifier Serializer';
$lang_install['File_Help_HTMLPurifierSerializer'] = '';
$lang_install['File_HTMLPurifierSerializerHtml'] = 'Map: HTML-Purifier Serializer-HTML';
$lang_install['File_Help_HTMLPurifierSerializerHtml'] = '';
$lang_install['File_IconModDefIcons'] = 'Bestand: Icon-Mod gedefineerde Icons';
$lang_install['File_Help_IconModDefIcons'] = '';
$lang_install['File_Configdb'] = 'Bestand: Database configuratiebestand';
$lang_install['File_Help_Configdb'] = '';
$lang_install['Downloads_Files_Dir'] = 'Map: betanden download module';
$lang_install['Downloads_Files_Dir_Help'] = '';
$lang_install['Downloads_Caxe_Dir'] = 'Map: Downloadmodule Upload Cache';
$lang_install['Downloads_Caxe_Dir_Help'] = '';
$lang_install['File_CantOpen'] = 'Het bestand kon niet geopend worden';
$lang_install['File_CantWrite'] = 'Het bestand kon niet beschreven worden';

$lang_install['DB_Host'] = 'Servernaam';
$lang_install['DB_Help_Host'] = 'De naam van de databaseserver. Normaal \'localhost\', die ook door ons standaard werd gebruikt.<br />De hostnaam van de database server krijgt u van uw provider.<br />U kunt ook het IP-Adres van de database server opgeven.'; 
$lang_install['DB_Name'] = 'Naam database';
$lang_install['DB_Help_Name'] = 'Naamdatabase<br />Indien de database door uw provider aangemaakt werd heeft u de gegevens van uw provider nodig of als u deze zelf aangemaakt heeft dient u hier de door u gekozen naam in te vullen';
$lang_install['DB_Username'] = 'Gebruikersnaam van de database';
$lang_install['DB_Help_Username'] = 'Gebruikersnaam van de database<br />De gebruikersnaam die gebruikt word om u aan te melden bij de database.<br />U gebruikt de naam die u van uw provider heeft gekregen of de zelf aangemaakte gebruikersnaam.';
$lang_install['DB_Password'] = 'Wachtwoord van de database';
$lang_install['DB_Help_Password'] = 'Wachtwoord<br />Het wachtwoord van de databasegebruiker. U gebruikt het wachtwoord die u van uw provider gekregen heeft of het zelf aangemaakte wachtwoord.';
$lang_install['DB_Type'] = 'Type database';
$lang_install['DB_Help_Type'] = 'Type database<br />Het type database. Wij hebben uw systeem onderzocht en de volgende types zijn beschikbaar.';
$lang_install['DB_Prefix'] = 'Prefix (Standaard: evo)';
$lang_install['DB_Help_Prefix'] = 'Prefix<br />Elke tabel heeft zijn eigen naam binnen de database. Omdat er meerdere systemen gelijktijdig binnen dezelfde database geinstalleerd kunnen worden dienen ze door deze prefix gescheiden te worden. Standaard is \'evo_\'. Omdat de Prefix \'evo_\' word standaard elke tabel hierin geinstalleerd.';
$lang_install['DB_Conf_wrong'] = 'Er kon geen verbinding met de database tot stand worden gebracht.<br />Controleer uw gegevens';
$lang_install['DB_DB_wrong'] = 'Wij werd weliswaar een verbinding tot stand worden gebracht maar niet met uw database.<br />Controleer uw gegevens';
$lang_install['DB_Conf_ok'] = 'Verbinding met de database tot stand gebracht.<br />Uw gegevens zijn in orde.';
$lang_install['DB_Prefix_exists'] = 'Er bestaan reeds tabellen in uw database met dezelfde Prefix.';
$lang_install['DB_Delete_Existing'] = 'Dienen de bestaande tabellen overschreven/verwijderd worden';
$lang_install['DB_Help_Delete_Existing'] = 'Tabellen verwijderen/overschrijven<br />Wij hebben in uw database tabellen gevonden. Wilt u in een database installeren waarin reeds data bestaan?.<br />Met \'Nee\', worden eventuele gelijknamige tabellen niet overschreven. Wij controleren of de tabellen volledig zijn en voegen evt velden of indexen toe.<br />Met \'Ja\' worden de bestaande tabellen verwijderd en opnieuw aangemaakt. Dit is de beste methode voor een goed werkend systeem.';
$lang_install['DB_Help_Update_Existing'] = 'Funktionierende Konfiguration gefunden<br/>Wir haben eine funktionierende Konfiguration gefunden.<br />Es sieht danach aus, als ob dies keine frische Installation sondern eher ein Update ist.<br />Wenn Du \'update\' w&auml;hlst, dann werden die bestehenden Tabellen nicht &uuml;berschrieben sondern nur gepr&uuml;ft und n&ouml;tigenfalls erg&auml;nzt.';
$lang_install['DB_Update_Existing'] = 'Is dit een Update of een nieuwe installatie';
$lang_install['DB_Update_Question'] = 'Wij hebben een functionerende databaseverbinding gevonden. Bevestig AUB of dit een nieuwe installatie of een Update is.';
$lang_install['DB_Help_Update_Convert'] = 'In oudere installaties werd de lettercode: ISO-8859-1 gebruikt. Nuke-Evolution > 2.1.0 gebruikt UTF-8, een multibyte internationale lettercode. Als u hier met ja bevestigd worden alle ISO-8859-1 tekstvelden naar UTF-8 geconverteerd';
$lang_install['DB_Update_Convert'] = 'Lettercode van ISO-8859-1 naar UTF-8 converteren ?';
$lang_install['DB_Update'] = 'Update';
$lang_install['DB_No_Convertion'] = 'Niet converteren';
$lang_install['DB_Convert'] = 'Converteren';
$lang_install['DB_Installation'] = 'Nieuwe Installatie';
$lang_install['DB_Upgrade'] = 'Database - Actualiseren';
$lang_install['DB_Help_DiffUserPrefix'] = 'Verschillende tabellenprfixes<br />De huidige configuratie geeft aan dat u voor de gebruikerstabellen een andere prefix als voor de overige tabellen gebruikt. Deze installer ondersteund dit soort installatie niet. Als u  "JA" kies zal de installer proberen de gebruikerstabellen te hernoemen waardoor de installatie verder kan gaan. In het andere geval word deze afgebroken. U kunt de tabellen "user_table" en "user_temp_table" na de installatie zelf herbernoemen, waarbij u dan ook in de config.php de invoer voor de variable "user_prefix" handmatig aanpassen moet.';
$lang_install['DB_DiffUserPrefix'] = 'Dient de tabellenprefix voor uw gebruikerstabellen veranderd worden';
$lang_install['DB_DiffUserPrefixMore'] = 'Uw bestaande configuratie geeft verschillende prifixen voor uw gebruikerstabellen weer. Indien u "JA" kiest word de installatie voortgegezet, de installer hernoemd de tabellen vervolgd de installatie. Indien "NEE" word de installatie op dit punt afgebroken.<br />Meer informatie verkrijgt u via ons hulp veld';
$lang_install['DB_Table_Exists'] = 'Tabellen bestaan al';
$lang_install['DB_Table_NotExists'] = 'Tabellen  moeten onpieuw aangemaakt worden';
$lang_install['DB_Table_Done'] = 'Tabellen succesvol aangemaakt';
$lang_install['DB_Table_Warning_override'] = 'U heeft besloten de bestaande tabellen te overschrijven. Alle gegevens in deze tabellen zullen verloren gaan !!<br /> Indien dit niet de bedoeling was kunt u terug gaan of de installatie herstarten.';
$lang_install['DB_Table_Create_in_process'] = 'Bezig met het aanmaken van de tabellen .... niet onderbreken !!';
$lang_install['DB_Table_Deleted'] = 'Tabellen gewist';
$lang_install['DB_Table_Created'] = 'Tabellen aangemaakt';
$lang_install['DB_Table_Checked'] = 'Tabelle gecontroleerd';
$lang_install['DB_Table_Identical'] = 'De tabellen bevatten de standaardwaarden';
$lang_install['DB_Table_Changed'] = 'De tabellen worden met de standaardwaarden aangepast';
$lang_install['DB_Table_Created_not'] = 'Tabellen konden niet aangemaakt worden, Ernstige fout';
$lang_install['DB_Table_Changed_not'] = 'De tabellen konden niet met de standaardwaarden voorzien worden. Ernstige fout.';
$lang_install['DB_Table_Created_ready'] = 'De tabelleninstalltie is beeindingd<br />Er is zo ver bekend geen fout opgetreden.<br />Met de volgende stap configureerd u uw systeem';
$lang_install['DB_Table_Created_ready_error'] = 'De tabelleninstalltie is beeindigd<br />Er zijn fouten opgetreden.<br />Controleerd AUB het logboek. Daar kunt u zien waar/welke fouten er zijn opgetreden.';
$lang_install['DB_Entry_Update_missed'] = 'Er is een fout opgetreden tijdens het toevoegen van gegevens in de database.';
$lang_install['DB_RenameUserTableFail'] = 'Wij konden de gebruikerstabellen niet hernoemen';

// Language entries for Checks
$lang_install['Found_language'] = 'Wij hebben vastgesteld dat u deze taal gebruikt';
$lang_install['Found_language_change'] = 'ALs u de taal veranderen wilt (die gelijktijdig ook voor uw systeem gebruikt worden zal), dan kunt u kiezen tussen de door ons gevonden talen';

$lang_install['FreeDiskSpace']    = 'Vrije opslagruimte';
$lang_install['No_Free_Disk_Space'] = 'Onvoldoende opslagruimte. Controleer of u tenminste 50 MB beschikbaar heeft';
$lang_install['Safe_Mod']    = 'Safe Mode';
$lang_install['SafeMod_On']    = 'Safe Mode is geactiveerd.<br />In dit geval kunnen er problemen optreden bij de dataverwerking (Bijv. Cache, upload van bestanden etc.)';
$lang_install['PHP_Version']    = 'PHP Versie';
$lang_install['Wrong_PHP_Version'] = 'Uw  PHP-Versie is te oud. Wij ondersteunen deze versie niet meer.';
$lang_install['Unsafe_PHP_Version'] = 'Uw PHP-Versie is te oud. Wij ondersteunen deze versie, maar bevelen u aan om een update uit te voeren, omdat deze versie bekende veiligheidslekken heeft waarorver uw site gehackt kan worden.';
$lang_install['Register_Globals']    = 'Register Globals';
$lang_install['Register_Globals_On'] = 'Register Globals is op uw server geactiveerd.<br />Ok, wij controleren onze variablen, maar het blijft een veiligheidsrisico voor mods, modules, blokken en addons die niet onze variabelentest ondersteunen.';
$lang_install['Captcha_enabled'] = 'Captcha beschikbaar';
$lang_install['Open_Basedir'] = 'Open Basedir';
$lang_install['Open_Basedir_On'] = 'Open Basedir is geactiveerd.<br />Deze PHP-instelling kan tot gevolg hebben dat er bij de cache of bij het uploaden van bestanden problemen kan geven.';
$lang_install['Session_Support'] = 'Session Support';
$lang_install['No_Session_Support'] = 'Session Support is niet geactiveerd<br />Het PHP-Module Session Support is om veiligheidsredenen noodzakelijk. De installatie word afgebroken.';
$lang_install['CURL_Libary'] = 'Curl Library';
$lang_install['No_Curl_Modul'] = 'De PHP CURL-Module is niet geladen<br />Hierdoor kunt u geen bestanden openen op een externe server. Bijv. het controleren van updates zal mislukken.';
$lang_install['File_Upload'] = 'Bestanden uploaden toegestaan';
$lang_install['No_FileUploads'] = 'Op uw sever is de instelling voor het uploaden van bestanden niet geconfigureerd.';
$lang_install['Size_MB'] = 'MB';
$lang_install['Size_GB'] = 'GB';
$lang_install['File_Upload_Maxsize'] = 'Maximale bestandsgrootte voor de upload';
$lang_install['Max_FileSize_ToSmall'] = 'De toegestane bestandsgrootte voor de upload naar uw server is te klein. Daarom word de installatie afgebroken.';
$lang_install['Max_FileSize_Small'] = 'De toegestane bestandsgrootte voor de upload is te klein.';
$lang_install['SMTP_enabled'] = 'SMTP ingericht';
$lang_install['SMTP_host'] = 'SMTP Server';
$lang_install['SMTP_sender'] = 'STMP Afzender';
$lang_install['SMTP_command'] = 'STMP commando';
$lang_install['FTP_enabled'] = 'FTP ingericht';
$lang_install['Max_Post_Size'] = 'Maximale grootte bericht';
$lang_install['Mod_Rewrite'] = 'Mod Rewrite (voor Lazy Google Tab belangrijk)';
$lang_install['Mod_Rewrite_no'] = 'U kunt de Lazy Google Tab niet gebruiken, omdat uw systeem de mod_rewrite niet ondersteund.';
$lang_install['Mod_Rewrite_no_check'] = 'Wij kunnen niet controleren of het Apache Modul "mod_rewrite" geladen is. Het kan ook zijn dat u Lazy Google Tab niet kunt gebruiken.';
$lang_install['GD_Libary'] = 'GD Library';
$lang_install['GD_Libary_JPEG'] = 'GD Library - JPEG Support (belangrijk voor Captcha)';
$lang_install['Memory_Limit'] = 'Max. geheugengebruik door een programma';
$lang_install['Memory_Limit_not'] = 'In uw systeem is geen bovengrens voor het geheugengebruik \'memory_limit\' ingesteld. Dat betekend dat een programma het totale geheugen kan gebruiken. In het bijzonder bij veel downloads betekend dat snelheids beperking voor andere gebruikers op uw systeem.';

// Language entries Base Configuration
$lang_install['Base_Setup'] = 'Basisinstellingen<br />Hier worden de belangrijkste basisinstellingen voor uw systeem ingesteld.<br />Alle instellingen kunnen later in de system administratie van uw website aangepast worden.';
$lang_install['Base_Sitename'] = 'Naam van de website';
$lang_install['Base_Help_Sitename'] = 'De naam van uw website<br />Maximaal 200 tekens.<br />De naam verschijnt boven in uw browser en word in uw forum gebruikt. Ook verschijnt deze als Meta-Tag in de header van uw pagina (Bijv. voor zoekmachines)';
$lang_install['Base_Sitename_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Sitedescription'] = 'Kort omschijving van uw site (max. 200 tekens)';
$lang_install['Base_Help_Sitedescription'] = 'Korte omschrijving van uw site. Maximaal 200 tekens.';
$lang_install['Base_Descriptione_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Url'] = 'URL van uw website (zonder http://)';
$lang_install['Base_Help_Url'] = 'Alles, wat u in uw browser moet intypen om uw website op te vragen (ohne http://).';
$lang_install['Base_Url_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Server_Port'] = 'Poort van uw webserver';
$lang_install['Base_Help_Server_Port'] = 'Poort van uw webserver.<br />Nummer: 5-nummers.<br />Het poortadres op uw webserver op welk deze antwoord. Normaal poort: 80 of bij gebruik van een proxyserver: 8080.';
$lang_install['Base_Server_Port_wrong_entry'] = 'De serverpoort moet groter zijn dan poort 80 en kleiner als poort 65535';
$lang_install['Base_Server_Port_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Cookie_Domain'] = 'Cookie Domain';
$lang_install['Base_Help_Cookie_Domain'] = 'Cookie Domain.<br />Het cookie domein is normaal het domein van uw website.<br />Als uw webseite normaal via <strong>www.mijndomein.com</strong> op te vragen is, dan is het Cookie-domeinl;ne <strong>mijndomein.com</strong>';
$lang_install['Base_Cookie_Name_wrong_chars'] = 'In uw cookienaam bevinden zich niet toegestane tekens';
$lang_install['Base_Cookie_Name_no_entry'] = 'In de cookie naam bevinden zicht niet toegestane tekens.';
$lang_install['Base_Cookie_Domain_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Cookie_Path'] = 'Cookie Pfad';
$lang_install['Base_Help_Cookie_Path'] = 'Cookie Pfad.<br />Indien uw website zich in een map op uw domein bevind (zoals bijv. www.mijndomein.com/sub), dan dient u hier de mapnaam op te geven (dus bijv. /sub).';
$lang_install['Base_Cookie_Path_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Cookie_Name'] = 'Naam van de cookies';
$lang_install['Base_Help_Cookie_Name'] = 'Naam van de cookies.<br />Een unieke naam voor de Cookie.<br />Binnen uw domein mag deze naam voor een coockie maar eenmaal voor komen.<br />De cookienaam mag geen Umlaute, getallen, hoofdletters of bijzondere tekens bevatten.';
$lang_install['Base_Cookie_Name_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Board_Email'] = 'E-Mail-adress van de webmaster';
$lang_install['Base_Help_Board_Email'] = 'E-Mail-adres van de webmaster.<br />Deze word gebruikt voor alle systeem-E-Mails als afzender gebruikt.<br />In sommige systemen dient deze afzender met de PHP-instellingen voor SMTP-Verzender overeen te komen.';
$lang_install['Base_Board_Email_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Board_Email_Sig'] = 'Handtekening vd E-Mail';
$lang_install['Base_Help_Board_Email_Sig'] = 'Handtekening vd E-Mail.<br />Maximaal 200 tekens.<br />Word in een systeem E-Mail onder het bericht geplaatst.';
$lang_install['Base_Board_Email_Sig_no_entry'] = 'Veld mag niet leeg zijn.';
$lang_install['Base_Board_Default_Lang'] = 'Standaard taal';
$lang_install['Base_Help_Board_Default_Lang'] = 'Standaard taal.<br />De basisinstelling voor uw systeem. U kunt kiezen tussen de talen die u op uw systeem geinstalleerd heeft.<br />Dit kan later in het administratiemenu gewijzigt worden.';
$lang_install['Base_Board_Default_Lang_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Board_Startdate'] = 'Startdatum vd website';
$lang_install['Base_Help_Board_Startdate'] = 'Startdatum vd website.<br />Word als <strong>officiele startdatum</strong> van uw site opgenomen. Standaard is de installatiedatum, indien uw site al langer beschikbaar is kunt u dit hier wijzigen.';
$lang_install['Base_Board_Startdate_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Board_Dateformat'] = 'Standaard Datumsformat';
$lang_install['Base_Help_Board_Dateformat'] = 'Standaard Datumsformaat.<br />De hier aangegeven formaat word voor het gehele systeem gebruikt.';
$lang_install['Base_Board_Dateformat_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Board_Timezone'] = 'Tijdzone van uw pagina';
$lang_install['Base_Help_Board_Timezone'] = 'Tijdzone.<br />Omdat uw website wereldwijd bereikbaar is en gebruikers in diverse tijdzones leven,<br />moeten alle datums op een lijn liggen.<br />Dit is de tijdzone die geldig is voor uw website.<br />In de regel niet de uw tijdzone invoeren waar u leeft maar de tijdzone waarin uw server staat.';
$lang_install['Base_Board_Timezone_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Base_Conf_wrong'] = 'Wij hebben een fout in uw basisconfiguratie ondenkt.<br />Controleer uw gegevens.';
$lang_install['Base_Conf_ok'] = 'Wij hebben geen fouten in uw basis configuratie gevonden.<br />Met de volgende pagina word de administrator aangemaakt.';
$lang_install['Base_From_Update'] = 'U bevind zich in de update modus.<br />De weergegeven informatie komt uit uw systeem.';

// Language entries for creating Admin Account
$lang_install['Admin_Setup'] = 'Administrator voor deze website aanmaken';
$lang_install['Admin_Configuration_Details'] = 'Administrator';
$lang_install['Admin_Name'] = 'Gebruikersnaam van de admnistrator (word bij de alles wat de adminnistrator schrijft weergegeven)';
$lang_install['Admin_Help_Name'] = 'De gebruikersnaam van de administrator word op alle plaatsen weergegeven waar anders de namen van de gebruikers staan.';
$lang_install['Admin_Name_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Admin_Homepage'] = 'Website van de administrator';
$lang_install['Admin_Help_Homepage'] = 'Website van de administrator<br />Ook de administrator mag bij waarderingen niet meervoudig op zijn eigen pagina stemmen, daarom moet hier een website worden ingevuld.';
$lang_install['Admin_Homepage_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Admin_Password'] = 'Wachtwoord';
$lang_install['Admin_Help_Password'] = 'Wachtwoord<br />Het wachtwoord moet minstens 6 tekens en maximaal 25 tekens bevatten.';
$lang_install['Admin_Password2'] = 'Herhalen vh wachtwoord';
$lang_install['Admin_Password_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Admin_Password_not_match'] = 'De wachtwoorden komen niet overeen';
$lang_install['Admin_Password_not_match_existing'] = 'De wachtwoorden komen niet met in de database opgeslagen wachtwoorden overeen';
$lang_install['Admin_Help_Password2'] = 'Wachtwoord herhalen<br />Het wachtwoord van de administrator is niet meer te veranderen, daarom dient deze uit voorzorg herhaald te worden.';
$lang_install['Admin_Lang'] = 'Taal instelling';
$lang_install['Admin_Help_Lang'] = 'Taal instelling.<br />De inhoud van de website word voor de administrator op basis van deze instelling in de juiste taal weergegeven.';
$lang_install['Admin_Lang_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Admin_Create_User'] = 'Ook een gelijknamige gebruiker aanmaken?';
$lang_install['Admin_Help_Create_User'] = 'Gebruiker aanmaken<br />Uit veiligheidsredenen is het niet raadzaam om een gebruiker met dezelfde naam aan te maken.<br />Voor het gemak (gebruiker = Administrator) word dit in de meeste gevallen wel gedaan';
$lang_install['Admin_Create_User_no_entry'] = 'Dit veld mag niet leeg zijn';
$lang_install['Admin_Conf_wrong'] = 'Wij hebben een fout ondekt.<br />Controleer uw gegeven.';
$lang_install['Admin_Conf_ok'] = 'Wij hebben geen fouten gevonden.<br />Met de volgende stap worden nu de algemene basisgegevens en basisconfiguratie in de database opgeslagen.';

// Language entries for Database Step
$lang_install['Base_Information_Setup'] = 'Basis Informatie in de databaseDatenbank inlezen';
$lang_install['Base_Information_Details'] = 'Databasetabellen in de database';
$lang_install['Base_Informations_NoNeed'] = 'Geen basisgegevens om in te lezen beschikbaar';
$lang_install['Base_Informations_ToDo'] = 'Basisgegevens om in te lezen beschikbaar';
$lang_install['Base_Informations_Done'] = 'Basis gegevens is reeds ingelezen';
$lang_install['Base_Informations_ready'] = 'De basisgegevens zijn nu in de database opgeslagen.<br />Er is zover benkend geen fout opgetreden.<br />De installatie is hiermee succesvol verlopen.';
$lang_install['Base_Informations_in_process'] = 'De basisgegevens worden opgeslagen ... AUB niet onderbreken !!';
$lang_install['Base_Information_DB_Success'] = 'Basis Informatie succesvol in de database ingelezen';
$lang_install['Base_Informations_ready_error'] = 'Er is een fout bij het invoegen van de basisgegevens opgetreden.<br />Controleer AUB uw installatie.<br />De installatie is niet succesvol afgerond.';

// Language entries for Last Step
$lang_install['Information_Setup_Ready'] = 'Gefeliciteerd!<br />De installatie is klaar.';
$lang_install['Information_Setup_Ready_allok'] = 'Wij konden tijdens de installatie geen fouten ontdekken.<br/>In feite is de installatie nu klaar voor gebruik.';
$lang_install['Information_Setup_Ready_nostep'] = 'Niet alle installatie stappen zijn doorlopen.<br />Bij de stappen die u wel heeft gedaan hebben wij geen fouten kunnen vinden.<br />Of uw website functioneerd kunnen wij niet zeggen, U kunt de installatie herstarten of website testen.';
$lang_install['Information_Setup_Ready_error'] = 'Er zijn grote fouten opgetreden tijdens de installatie.<br />Wij bevelen u aan het logboek door te lezen en de installatie opnieuw uit te voeren.';
$lang_install['Information_Setup_Ready_noinfo'] = 'Wij hebben geen informarmatie over de toestand van uw installatie.<br />Daarom kunnen wij niet zeggen of de installatie goed verlopen is en of er fouten in zitten.<br />Wij adviseren de installatie opnieuw te starten.';
$lang_install['Information_Setup_GoHome'] = 'Naar uw website';
$lang_install['Information_Setup_GoAdmin'] = 'Naar de administratie van uw website';
$lang_install['Donate'] = 'Deze software werd in onze vrije tijd ontwikkeld. Waardeer ons werk doormiddel van een donatie.';

// Language entries for Database fields

$lang_install['Page_Top']    = 'Naar boven';
$lang_install['Left_Block']  = 'Linker Blok';
$lang_install['Page_Bottom'] = 'Naar beneden';
$lang_install['Group_Administrators'] = 'Administrators';
$lang_install['Group_Moderators'] = 'Moderators';

$lang_install['bbboard_message_1'] = 'Dit bericht word op alle paginas en voor alle alle bezoekers weergegeven. Begrenst op 80% van de beschikbare breedte.';
$lang_install['bbboard_message_2'] = 'Dit bericht word alleen op de index pagina en alleen voor leden weergegeven.';

$lang_install['bbcategories_cat_title'] = 'Algemeen';

$lang_install['bbconfig_board_disable_msg'] = 'Deze website is op dit moment gesloten...';
$lang_install['bbconfig_default_dateformat'] = 'D d-M-Y H:i';
$lang_install['bbconfig_locked_view_open'] = 'Gesloten: <strike>';
$lang_install['bbconfig_locked_view_close'] = '</strike>';
$lang_install['bbconfig_global_view_open'] = 'Globale aankondiging:';
$lang_install['bbconfig_global_view_close'] = '';
$lang_install['bbconfig_announce_view_open'] = 'Aankondiging:';
$lang_install['bbconfig_announce_view_close'] = '';
$lang_install['bbconfig_sticky_view_open'] = 'Informatie:';
$lang_install['bbconfig_sticky_view_close'] = '';
$lang_install['bbconfig_moved_view_open'] = 'Verplaatst:';
$lang_install['bbconfig_moved_view_close'] = '';

$lang_install['bbextension_groups_Images'] = 'Afbeeldingen';
$lang_install['bbextension_groups_Archives'] = 'Archief';
$lang_install['bbextension_groups_Plain_Text'] = 'Alleen tekst';
$lang_install['bbextension_groups_Documents'] = 'Dokumenten';
$lang_install['bbextension_groups_Real_Media'] = 'Real Media';
$lang_install['bbextension_groups_Streams'] = 'Streams';
$lang_install['bbextension_groups_Flash_Files'] = 'Flash bestanden';

$lang_install['bbforums_forum_name'] = 'Hoofdcategorie';

$lang_install['bbgroups_group_name_Anonymous'] = 'Gasten';
$lang_install['bbgroups_group_name_Moderators'] = 'Moderators';
$lang_install['bbgroups_group_description_Moderators'] = 'Moderators van dit forum';
$lang_install['bbgroups_group_name_Administrators'] = 'Administrators';
$lang_install['bbgroups_group_description_Administrators'] = 'Administrators van dit forum';
$lang_install['bbgroups_group_name_Users'] = 'Gebruiker';
$lang_install['bbgroups_group_description_Users'] = 'Algemene gebruikersgroep';

$lang_install['bbposts_text_post_subject'] = 'Welkom bij Nuke-Evolution!';
$lang_install['bbposts_text_post_text'] = 'Dank u voor de installatie van Nuke-Evolution German Edition.\r\n\r\nHet Evo Team heeft een hoop werk in deze release geinversteerd om deze sneller, functioneler en veiliger te maken. Wij bevelen u aan de documenten compleet door te lezen, zo zijn er omvangrijke mogelijkheden met Evo.\r\n\r\nBinnenin het orginele achief zijn er enige mappen met nuttige informatie.\r\n\r\nDe eerste is de installatiemap, waarbij wij er van uit gaan dat u deze wel kent. Daarin bevinden zich drie documenten die helpen uw Evo te installeren en configueren. Indien u deze nog niet volledig heeft doorgelezen dan verzoeken wij u om dit nu als nog te doen !!\r\n\r\nDe tweede is de help map. Daarin zult u enige handige documenten vinden die ons team samengesteld heeft om een paar mogelijkhed van evo wee te geven. Ebenso findest du ein paar Dokumente, die dir bei Fehlern, Browsereinstellungen und nicht korrekter Installation weiter helfen k&ouml;nnen.\r\n\r\nDer Dritte ist das Verzeichnis f&uuml;r den Themen-Editor. Wenn du ein PHP-Nuke Thema nach Evo konvertieren m&ouml;chtest, so hast du den Anleitungen in diesem Ordner zu folgen.\r\n\r\nWir sind sicher, dass Evo die Beste Nuke-Software ist, die du jemals hattest. Geniesse und schaue immer wieder mal bei www.nuke-evolution.de f&uuml;r Support, Updates oder einfach um Hi! zu sagen vorbei. \r\n\r\n[b:16f8943d60]- Das Nuke-Evolution Team[/b:16f8943d60]';

$lang_install['bbquota_limits_Low'] = 'Gering';
$lang_install['bbquota_limits_Medium'] = 'Normaal';
$lang_install['bbquota_limits_High'] = 'Hoog';

$lang_install['bbranks_rank_title_Site_Owner'] = 'Eigenaar van de site';
$lang_install['bbranks_rank_title_Site_Admin'] = 'Administrator';

$lang_install['bbsmilies_Very_Happy'] = 'Zeer gelukkig';
$lang_install['bbsmilies_Smile'] = 'Grijns';
$lang_install['bbsmilies_Sad'] = 'Slecht';
$lang_install['bbsmilies_Surprised'] = 'Verrast';
$lang_install['bbsmilies_Shocked'] = 'geschokkeerd';
$lang_install['bbsmilies_Confused'] = 'Verward';
$lang_install['bbsmilies_Cool'] = 'Cool';
$lang_install['bbsmilies_Laughing'] = 'Lachen';
$lang_install['bbsmilies_Mad'] = 'Boos';
$lang_install['bbsmilies_Razz'] = 'Razz';
$lang_install['bbsmilies_Embarassed'] = 'Verward';
$lang_install['bbsmilies_Crying_or_Very_sad'] = 'Om te huilen of zeer slecht';
$lang_install['bbsmilies_Evil_or_Very_Mad'] = 'Duivels of zeer slecht';
$lang_install['bbsmilies_Twisted_Evil'] = 'Evil';
$lang_install['bbsmilies_Rolling_Eyes'] = 'rollende Ogen';
$lang_install['bbsmilies_Wink'] = 'Wuiven';
$lang_install['bbsmilies_Exclamation'] = 'Uitroepteken';
$lang_install['bbsmilies_Question'] = 'Vraag';
$lang_install['bbsmilies_Idea'] = 'Idee';
$lang_install['bbsmilies_Arrow'] = 'Pijl';
$lang_install['bbsmilies_Neutral'] = 'Neutraal';
$lang_install['bbsmilies_Mr_Green'] = 'Mr. Green';

$lang_install['bbstats_module_info_long_name_modul1'] = 'Statistieken overview Sectie';
$lang_install['bbstats_module_info_extra_info_modul1'] = 'Deze moduleThis Module will print out a link Block with Links to the current Module at the Statistics Site.\nYou are able to define the number of columns displayed for this Module within the Administration Panel -&gt; Edit Module.';
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

$lang_install['bbthemes_name_tr_color1_name'] = 'Delichtste lijnkleuren';
$lang_install['bbthemes_name_tr_color2_name'] = 'De middelste lijnkleuren';
$lang_install['bbthemes_name_tr_color3_name'] = 'De donkerste lijnkleuren';
$lang_install['bbthemes_name_tr_class1_name'] = '';
$lang_install['bbthemes_name_tr_class2_name'] = '';
$lang_install['bbthemes_name_tr_class3_name'] = '';
$lang_install['bbthemes_name_th_color1_name'] = 'Border rond de hele pagina';
$lang_install['bbthemes_name_th_color2_name'] = 'Buitenste tabelrand';
$lang_install['bbthemes_name_th_color3_name'] = 'Binnenste tabelrand';
$lang_install['bbthemes_name_th_class1_name'] = 'Silver gradient afbeelding';
$lang_install['bbthemes_name_th_class2_name'] = 'Blauwe gradient afbeelding';
$lang_install['bbthemes_name_th_class3_name'] = 'Fade-out gradient op index';
$lang_install['bbthemes_name_td_color1_name'] = 'Achtergrond voor quote boxen';
$lang_install['bbthemes_name_td_color2_name'] = 'Alle witte gebieden';
$lang_install['bbthemes_name_td_color3_name'] = '';
$lang_install['bbthemes_name_td_class1_name'] = 'Achtergrond voor onderwerpen';
$lang_install['bbthemes_name_td_class2_name'] = '2e achtergrond voor onderwerpen';
$lang_install['bbthemes_name_td_class3_name'] = '';
$lang_install['bbthemes_name_fontface1_name'] = 'Standaard fonts';
$lang_install['bbthemes_name_fontface2_name'] = 'Extra onderwerp titel font';
$lang_install['bbthemes_name_fontface3_name'] = 'Form fonts';
$lang_install['bbthemes_name_fontsize1_name'] = 'Kleinste font formaat';
$lang_install['bbthemes_name_fontsize2_name'] = 'Middelste font formaat';
$lang_install['bbthemes_name_fontsize3_name'] = 'Normale font grootte (post body etc)';
$lang_install['bbthemes_name_fontcolor1_name'] = 'Quote & copyright tekst';
$lang_install['bbthemes_name_fontcolor2_name'] = 'Code tekst kleur';
$lang_install['bbthemes_name_fontcolor3_name'] = 'Standaard tekst kleur vd tabel';
$lang_install['bbthemes_name_span_class1_name'] = '';
$lang_install['bbthemes_name_span_class2_name'] = '';
$lang_install['bbthemes_name_span_class3_name'] = '';

$lang_install['bbtopics_topic_title'] = 'Welkom bij Nuke-Evolution!';

$lang_install['bbxdata_fields_field_name_icq'] = 'ICQ Nummer';
$lang_install['bbxdata_fields_field_name_aim'] = 'AIM Adres';
$lang_install['bbxdata_fields_field_name_msn'] = 'MSN Messenger';
$lang_install['bbxdata_fields_field_name_yim'] = 'Yahoo Messenger';
$lang_install['bbxdata_fields_field_name_website'] = 'Website';
$lang_install['bbxdata_fields_field_name_location'] = 'Herkomst';
$lang_install['bbxdata_fields_field_name_occupation'] = 'Beroep';
$lang_install['bbxdata_fields_field_name_interests'] = 'Interesses';
$lang_install['bbxdata_fields_field_name_signature'] = 'Handtekening';

$lang_install['blocks_bkey_Main_Menu'] = 'Hoofdmenu';
$lang_install['blocks_bkey_Administration'] = 'Administratie';
$lang_install['blocks_bkey_Search'] = 'Zoeken';
$lang_install['blocks_bkey_Survey'] = 'Poll';
$lang_install['blocks_bkey_Information'] = 'Informatie';
$lang_install['blocks_bkey_User_Info'] = 'Gebruikersinfo';
$lang_install['blocks_bkey_Nuke_Evolution'] = 'Nuke-Evolution';
$lang_install['blocks_bkey_Hacker_Beware'] = 'Hackerbescherming';
$lang_install['blocks_bkey_Top_10_Downloads'] = 'Top 10 Downloads';
$lang_install['blocks_bkey_Top_10_Links'] = 'Top 10 Links';
$lang_install['blocks_bkey_Forums'] = 'Forums';
$lang_install['blocks_bkey_Submissions'] = 'Inzendingen';
$lang_install['blocks_bkey_Link_to_us'] = 'Link naar ons';
$lang_install['blocks_bkey_Donations'] = 'Donaties';

$lang_install['config_slogan'] = 'Uw slogan';
$lang_install['config_foot1'] = '<a href="modules.php?name=Spambot_Killer" target="_blank">Spambot Killer</a><br /><a href="modules.php?name=Site_Map" target="_blank"><strong>Site Map</strong></a><br />';
$lang_install['config_foot2'] = '<a href="rss.php?feed=news" target="_blank"><img border="0" src="images/powered/feed_20_news.png" width="94" height="15" alt="[News Feed]" title="News Feed" /></a> <a href="rss.php?feed=forums" target="_blank"><img border="0" src="images/powered/feed_20_forums.png" width="94" height="15" alt="[Forums Feed]" title="Forums Feed" /></a> <a href="rss.php?feed=downloads" target="_blank"><img border="0" src="images/powered/feed_20_down.png" width="94" height="15" alt="[Downloads Feed]" title="Downloads Feed" /></a> <a href="rss.php?feed=weblinks" target="_blank"><img border="0" src="images/powered/feed_20_links.png" width="94" height="15" alt="[Web Links Feed]" title="Web Links Feed" /></a>  <a href="http://htmlpurifier.org/"><img src="images/powered/html_purifier_powered.png" alt="Powered by HTML Purifier" border="0" /></a> <a href="http://tool.motoricerca.info/robots-checker.phtml?checkreferer=1" target="_blank"><img border="0" src="images/powered/valid-robots.png" width="80" height="15" alt="[Validate robots.txt]" title="Validate robots.txt" /></a><br />';
$lang_install['config_foot3'] = '';
$lang_install['config_anonymous'] = 'Anoniem';
$lang_install['config_backend_title'] = 'Nuke-Evolution Powered Site';
$lang_install['config_notify_subject'] = 'NIEUWS voor mijn site';
$lang_install['config_notify_message'] = 'Hallo! U heeft een inzending voor uw site.';

$lang_install['cnbya_config_tos_text'] = 'Dit is uw standaard TOS. U kunt dit aanpassen in uw account admin Paneel.';

$lang_install['donators_config_block_message'] = 'Vind u deze site zinvol? Geef dan een kleine donatie.';
$lang_install['donators_config_gen_donation_name'] = 'Site donatie';
$lang_install['donators_config_gen_currency'] = 'EUR';
$lang_install['donators_config_gen_date_format'] = 'd/m/Y';
$lang_install['donators_config_gen_thank_message'] = 'Bedankt voor uw donatie!<br /><br />Tot ziens!';
$lang_install['donators_config_gen_cancel_message'] = 'Sorry, u kunt niet doneren!<br /><br />Tot ziens!';

$lang_install['downloads_categories_title'] = 'Algemeen';
$lang_install['downloads_categories_cdescription'] = 'Algemene aangemaakte categorie tijdens de installatie';

$lang_install['evo_userinfo_good_afternoon'] = 'Goedendag';
$lang_install['evo_userinfo_username'] = 'Gebruikersnaam';
$lang_install['evo_userinfo_show_ip'] = 'IP weergeven';
$lang_install['evo_userinfo_avatar'] = 'Avatar';
$lang_install['evo_userinfo_personal_message'] = 'Persoonlijk bericht';
$lang_install['evo_userinfo_rank'] = 'Rang';
$lang_install['evo_userinfo_mostever'] = 'Meeste ooit';
$lang_install['evo_userinfo_language'] = 'Taal';
$lang_install['evo_userinfo_Break'] = 'Break';
$lang_install['evo_userinfo_pms'] = 'PMs';
$lang_install['evo_userinfo_themes'] = 'Themes';
$lang_install['evo_userinfo_login'] = 'Inloggen/Uitloggen/Registreer';
$lang_install['evo_userinfo_members'] = 'Leden';
$lang_install['evo_userinfo_online'] = 'Online';
$lang_install['evo_userinfo_users'] = 'Gebruikers';
$lang_install['evo_userinfo_posts'] = 'Posts';

$lang_install['evo_userinfo_addons_good_afternoon_message'] = 'Goedemorgen %name%:';
$lang_install['evo_userinfo_addons_personal_message_message'] = '<div align="center">Hallo %name%, <br />Welkom op %site%.</div>';

$lang_install['evolution_censor_words'] = 'ass asshole arse bitch bullshit c0ck clit cock crap cum cunt fag faggot fuck fucker fucking fuk fuking motherfucker pussy shit tits twat';

$lang_install['links_categories_title'] = 'Algemeen';
$lang_install['links_categories_cdescription'] = 'Algemene categorie aangemaakt tijdens de installatie';


$lang_install['modules_meta_keywords'] = 'Nuke-Evolution, evo, pne, evolution, nuke, php-nuke, software, downloads, community, forums, bulletin, boards, cms, nuke-evo, phpnuke';

$lang_install['modules_title_Advertising'] = 'Adverteren';
$lang_install['modules_title_Content'] = 'Content';
$lang_install['modules_title_Docs'] = 'Docs';
$lang_install['modules_title_Donations'] = 'Donaties';
$lang_install['modules_title_Downloads'] = 'Downloads';
$lang_install['modules_title_FAQ'] = 'FAQ';
$lang_install['modules_title_Feedback'] = 'Feedback';
$lang_install['modules_title_Forums'] = 'Forums';
$lang_install['modules_title_Groups'] = 'Groepen';
$lang_install['modules_title_News'] = 'Nieuws';
$lang_install['modules_title_NukeSentinel'] = 'NukeSentinel';
$lang_install['modules_title_Private_Messages'] = 'Prive berichten';
$lang_install['modules_title_Profile'] = 'Profiel';
$lang_install['modules_title_Recommend_Us'] = 'Ons aanbevelen';
$lang_install['modules_title_Reviews'] = 'Reviews';
$lang_install['modules_title_Search'] = 'Zoeken';
$lang_install['modules_title_Site_Map'] = 'Site Map';
$lang_install['modules_title_Spambot_Killer'] = 'Spambot Killer';
$lang_install['modules_title_Statistics'] = 'Statistieken';
$lang_install['modules_title_Stories_Archive'] = 'Nieuws archief';
$lang_install['modules_title_Submit_News'] = 'Nieuws insturen';
$lang_install['modules_title_Supporters'] = 'Supporters';
$lang_install['modules_title_Surveys'] = 'Enquêtes';
$lang_install['modules_title_Top'] = 'Top';
$lang_install['modules_title_Topics'] = 'Onderwerpen';
$lang_install['modules_title_Web_Links'] = 'Web Links';
$lang_install['modules_title_Your_Account'] = 'Uw account';

$lang_install['modules_cat_Home'] = 'Home';
$lang_install['modules_cat_Members'] = 'Leden';
$lang_install['modules_cat_Community'] = 'Community';
$lang_install['modules_cat_Statistics'] = 'Statistieken';
$lang_install['modules_cat_Files_Links'] = 'Bestanden&nbsp;&amp;&nbsp;Links';
$lang_install['modules_cat_News'] = 'Nieuws';
$lang_install['modules_cat_Other'] = 'Overig';


$lang_install['modules_links_title'] = 'Home';

$lang_install['poll_data_optionText_1'] = 'Ummmm, niet slecht';
$lang_install['poll_data_optionText_2'] = 'Cool';
$lang_install['poll_data_optionText_3'] = 'Uitstekend';
$lang_install['poll_data_optionText_4'] = 'De beste!';
$lang_install['poll_data_optionText_5'] = 'wat is dit?';
$lang_install['poll_data_optionText_6'] = '';
$lang_install['poll_data_optionText_7'] = '';
$lang_install['poll_data_optionText_8'] = '';
$lang_install['poll_data_optionText_9'] = '';
$lang_install['poll_data_optionText_10'] = '';
$lang_install['poll_data_optionText_11'] = '';
$lang_install['poll_data_optionText_12'] = '';

$lang_install['poll_desc_pollTitle'] = 'Wat vind u van deze site?';
$lang_install['poll_desc_planguage'] = 'dutch';

$lang_install['quotes_quote'] = 'Nos morituri te salutamus - CBHS';

$lang_install['reviews_categories_title'] = 'Algemeen';
$lang_install['reviews_categories_cdescription'] = 'Algemene categorie aangemaakt tijdens de installatie';

$lang_install['stories_title'] = 'Welkom bij Nuke-Evolution';
$lang_install['stories_hometext'] = 'Welkom bij Nuke-Evolution.<br /><br />U dient nu een admin account aan te maken.  U kunt dit doen door <a href="admin.php">hier te klikken</a>.<br /><br /><br /><br /><strong>NOTE:</strong> U kunt dit verwijderen in de nieuws admnnistratie of door op verwijder button te klikken.';

$lang_install['stories_cat_Articles'] = 'Artikelen';

$lang_install['themes_custom_name'] = 'Chromo';

$lang_install['topics_text'] = 'Nuke-Evolution';
$lang_install['topics_name'] = 'evolution';

$lang_install['users_name_Anonymous'] = 'Gast';
$lang_install['users_timezone_Anonymous'] = '10.00';
$lang_install['users_lang_Anonymous'] = 'dutch';
$lang_install['users_dateformat_Anonymous'] = 'D M d, Y g:i a';

?>