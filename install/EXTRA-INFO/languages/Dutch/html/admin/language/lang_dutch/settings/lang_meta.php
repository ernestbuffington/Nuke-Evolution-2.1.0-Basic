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
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'META Tag beheer';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'META Tags Opties';

$lang_admin[$settingspoint]['FIELD_META'] = 'META Tag';
$lang_admin[$settingspoint]['FIELD_META_RESOURCE-TYPE'] = 'De resource-type dient altijd document heten.';
$lang_admin[$settingspoint]['FIELD_META_DISTRIBUTION'] = 'Legt de aart van de verbreding van de website vast. Zonder deze MetaTag word automatisch \'geldig voor alle\' aangenomen.<br />globaal - geldig voor alle<br />lokaal - lokale/regionale geldigheid<br />IU (internal use) - alleen voor intern gebruik';
$lang_admin[$settingspoint]['FIELD_META_AUTHOR'] = 'De autheur voor de actuele inhoud van de website, en daarmee ook voor de inhoud verantwoordelijk.';
$lang_admin[$settingspoint]['FIELD_META_COPYRIGHT'] = 'De houder van de rechten of iemand die de kopieerrechten gekregen heeft.';
$lang_admin[$settingspoint]['FIELD_META_KEYWORDS'] = 'De Keywords dienen kort maar krachtig de inhoud van de website weerspiegelen. Let er op dat zoekmachines  mmaar een bepaald aantal zoekwoorden lezen, zijn er te veel worden de rest genegeerd. De hoeveelheid hangt af van de zoekmachine, sommige lezen alleen de eerste 5. Er kunnen meerder keyword gebruikt worden gescheiden door een komma.';
$lang_admin[$settingspoint]['FIELD_META_DESCRIPTION'] = 'Een korte omschrijving vande inhoud van uw website. Hou de omschrijving kort: De maximale lengte is verschillend per zoekmachine. Meer als 150 tekens Bijv.: 25 tot 30 woorden dienen het niet te zijn.';
$lang_admin[$settingspoint]['FIELD_META_ROBOTS'] = 'De Meta-Angabe robots dienen daarvoor een zoekmachien het uitlezen van een website te verbieden. Dit verbieden kan zinvol zijn bij bijv. testsites op de server of wanneer het inrelevante paginas betreft.<br />noindex,nofollow = pagina niet lezen, Links niet volgen<br />index,nofollow = pagina lezen, Links niet volgen<br />noindex,follow = Site niet indezeren, maar links volgen<br />index,follow = site lezen, alle links volgen';
$lang_admin[$settingspoint]['FIELD_META_REVISIT-AFTER'] = 'Voor als een zoekrobot beslist na x dagen opnieuw voor bij te komen om een bestand opnieuw uit te lezen.';
$lang_admin[$settingspoint]['FIELD_META_RATING'] = 'Als de pagina van uw site voor oudere personen bestemd is dient dat kenbaar gemaakt te worden.<br />Algemeen = normale instelling, voor iedereen toegangkelijk<br />Mature = [genaue Bedeutung unbekannt]<br />Restricted = de bezoekers dienen tenminste  18 Jaar oud te zijn<br />14 years = de bezoekers dienen tenminste 14 Jaar oud zijn';
$lang_admin[$settingspoint]['FIELD_META_TITLE'] = 'De titel als korte omschrijving van de website.';
$lang_admin[$settingspoint]['FIELD_META_DATE'] = 'Met \'date\' kan aangegeven worden wanneer het bestand gepubliceerd is. Voorbeel: 2009-12-15T08:49:37+02:00<br />De tijdweergaven dient een gestandaard aanduiding te zijn. In het voorbeeld is 2009 het jaartal, 12 de maandt (December), 15 de dag, 08 de uren, 49 de minuten en 37 de Seconden. De weergave 02:00 achter het plusteken is de afwijking van de wereldtijd (UTC) in uren en minuten, in het voorbeeld twee uur. Dit betreft de midden europeese zomertijd. Als alleen de datum en de tijd weer gegeven moet, dient alleen dat deel van de datumweergave vande grote T (voor Time) aangegeven worden.';
$lang_admin[$settingspoint]['FIELD_META_AUDIENCE'] = 'De type van de doelgroep, meerdere invoer mogelijkheden worden door een komma gescheiden. Mogelijke waarden zijn bijv. \'Alle\', \'Beginner\', \'Gevorderde\', \'Expert\', \'Studenten\', \'Vrouwen\', \'Mannen\', \'Kinder\' ed;.';
$lang_admin[$settingspoint]['FIELD_META_ABSTRACT'] = 'Korte omschrijving van de website, is ongeveer hetzelfde als de inhoud van de titel-Tags.';
$lang_admin[$settingspoint]['FIELD_META_PAGE-TYPE'] = 'Type Website. Meervoudige invulmogelijkhgeid worden door een komma gescheiden. Mogelijke waarden zijn: \'Aanhef\', \'Catalogus\', \'Grafikenarchief\' ed;.';
$lang_admin[$settingspoint]['FIELD_META_PAGE-TOPIC'] = 'Het thema van de pagina, meervoudige invul mogelijkheden worden door een komma gescheiden. Mogelijke waarden zijn bijv. \'Audio\', \'Veiling\', \'Bekleding\', \'Opleiding\', \'Computer\' ed;.';
$lang_admin[$settingspoint]['FIELD_META_PUBLISHER'] = 'De voor de publicatie verantwoordelijk  resource of de software en versienummer waarmee de Meta Tags gegenereerd werd. Meest gelijk aan de Generator Tag.';

$lang_admin[$settingspoint]['CHECK_NAME_EXISTS'] = 'De META Tag bestaat al - Kies een andere naam AUB';
$lang_admin[$settingspoint]['CHECK_NOT_VALID'] = 'De opgegeven waarde is ongeldig';
$lang_admin[$settingspoint]['CHECK_INSERT_FAILED'] = 'Het opslaan in de database is mislukt';

$lang_admin[$settingspoint]['IMG_DELETE_TITLE'] = 'META Tag wissen';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Geen foutmelding voor '.$settingspoint.' beschikbaar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Opslaan';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Terug';

?>