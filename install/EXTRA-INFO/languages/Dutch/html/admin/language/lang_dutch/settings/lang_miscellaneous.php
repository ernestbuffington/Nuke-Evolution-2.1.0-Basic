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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Uitgebreide instellingen';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Uitgebreide instellingen';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Uitgebreide instellingen';

$lang_admin[$settingspoint]['FIELD_HTTPREF_ON'] = 'Opslaan van referenties naar ons Activeren (HTTPReferer)';
$lang_admin[$settingspoint]['FIELD_HTTPREF_ON_HELP'] = 'Hier kan ingesteld worden of de referenties naar uw webpagina in de database opgeslagen dienen te worden. Referenties worden dan in het referentieblok en in herkomst bezoekers weergegeven. Het activeren van deze functie kan tot een vertraging van de opbouw van de site leiden.';
$lang_admin[$settingspoint]['FIELD_HTTPREF_MAX'] = 'Hoeveel referenties mogen maximaal opgeslagen worden';
$lang_admin[$settingspoint]['FIELD_HTTPREF_MAX_HELP'] = 'Hier kan het maximale aantal referenties ingesteld worden die in de database opgeslagen worden. De standaardwaarde is 1000. Er dient geen waarde opgegeven worden die veel lager is.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS'] = 'Commentaren in polls activeren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS_HELP'] = 'Hier kunt u instellen of er op polls gereageerd kan worden.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE'] = 'Commentaren in artikelen activeren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE_HELP'] = 'Hier kunt u instellen of er op berichten gereageerd kunnen worden.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES'] = 'Individuele RSS-Feeds voor gebruikers activeren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES_HELP'] = 'Hier kunt u instellen of het toegestaan dat induviduele gebruikers RRS feeds in hun profiel kunnen activeren.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL'] = 'SSL-Toegang voor administrators activeren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL_HELP'] = 'Activeer het Secured Socket Layer Protocol voor administrators. SSL dient op de server geinstalleerd en geactiveerd zijn om deze functie te kunnen gebruiken.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT'] = 'Aantal toegangen naar de database tellen';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT_HELP'] = 'Activeerd het aantal toegangen naar de database en geeft het resultaat in de footer van de site weer.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE'] = 'Kleuren voor gebruikers en groepsen activeren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE_HELP'] = 'Hier kan ingesteld worden of de namen van geregistreerde gebruikers en groepen in verschillende kleuren weergegeven worden.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN'] = 'Gebruikers dwingen om zich te registreren voordat ze ook maar iets kunnen doen';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN_HELP'] = 'Met deze functie dwing je gebruikers te registreren voordat ze iets op de site kunnen doen.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS'] = 'Advertenties op de site toestaan';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS_HELP'] = 'Met deze functies kunt advertenties op de site in of uitschakelen.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS'] = 'Openklapbare blokken activeren';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS_HELP'] = 'Met deze optie kan je blokken open en dichtgeklappen toestaan of weigeren.';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN'] = 'Moeten de bokken in het begin opengeklapt zijn';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN_HELP'] = 'Deze optie op ja zetten als de blocken standaard opengeklapt dienen te zijn.';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE'] = 'Met welk sysmbool moet de functie van het openklappen van de blokken aangegeven worden';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE_HELP'] = 'Kies het symbool dat naast de titel de optie van het open en dichtklappen van de blokken moet aangeven.';
$lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME'] = 'In welk tijdsbestek dienen de blokken vernieuwd te worden';
$lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME_HELP'] = 'De blokken cache  word automatisch na de aangegeven tijd vernieuwd.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP'] = 'Links in uw homepagine van PHP in HTML converteren (LazyTap)';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP_HELP'] = 'Kies een groep bezoekers om de functie van eenvoudig leesbare links te activeren. Om er voor te zorgen dat dit werkt moet het bestand evo.htaccess in de root van uw installatie in .htaccess veranderd zijn.';
$lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS'] = 'Om Google Analytics te activeren dient u hier de Google Code in te voeren';
$lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS_HELP'] = 'Hier kan de Google Anylytics code ingevoerd worden, alleen als u zich bij Google service hiervoor geregistreerd bent. De code ziet er uit als bijv.: UA-xxxxx.';
$lang_admin[$settingspoint]['FIELD_TEXTEDITORS'] = 'Welke teksteditor zal als standaard gebruikt worden?';
$lang_admin[$settingspoint]['FIELD_TEXTEDITORS_HELP'] = 'Hier kunt u uw standaard teksteditor opgeven. Deze functie heeft geen invloed op het forum gedeelte.';

$lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_ICON'] = 'Plus/Minus Symbool';
$lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_TITLE'] = 'Titel';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_DEACTIVATED'] = 'Gedeactiveerd';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_MINUTES'] = 'Minuten';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_HOURS'] = 'Uren';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_DEACTIVATED'] = 'Gedeactiveerd';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_BOTS'] = 'Alleen voor WebCrawler';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_ALL'] = 'Voor iedereen';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_ADMINBOTS'] = 'Voor WebCrawler en administrators';
$lang_admin[$settingspoint]['OPTION_TEXTEDITOR_NONE'] = 'Geen';

$lang_admin[$settingspoint]['INFO_ACTIVATE_ADMINSSL'] = 'Hier voor dient SSL op uw server geactiveerd zijn';
$lang_admin[$settingspoint]['INFO_ACTIVATE_BANNERS'] = 'Er worden de in door Advertentiemodule advertenties weergegeven';
$lang_admin[$settingspoint]['INFO_DEACTIVATED_LAZYTAP'] = 'Uw Lazytap is om de volgende reden gedeactiveerd';
$lang_admin[$settingspoint]['INFO_TEXTEDITORS'] = 'niet geldig voor het forum';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Geen foutmelding voor '.$settingspoint.' beschikbaar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Opslaan';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Terug';

?>