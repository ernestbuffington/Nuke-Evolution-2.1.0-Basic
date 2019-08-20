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

define("_CHARSET","UTF-8");
define("_LANG_DIRECTION","ltr");
define("_SEARCH","Zoeken");
define("_SUBMIT","Bevestigen");
define("_REFRESH_SEC_CODE","Beveiligingscode vernieuwen");
define("_CONFIRM", "Bevestigen");
define("_PROFILE","Account");
define("_LOGIN","Inloggen");
define("_VIEWING","Bekeken");
define("_WRITES","Geschreven door:");
define("_APPROVEDBY","Vrijgegeven door:");
define("_POSTEDON","Geschreven op:");
define("_NICKNAME","Gebruikersnaam");
define("_PASSWORD","Wachtwoord");
define("_WELCOMETO","Welkom op");
define("_EDIT","Bewerken");
define("_DELETE","Wissen");
define("_POSTEDBY","Geschreven door:");
define("_READS","gelezen");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">terug</a> ]");
define("_BACK","Terug");
define("_COMMENTS","Reacties");
define("_PASTARTICLES","Laatste artikel");
define("_OLDERARTICLES","Oudere Artikels");
define("_BY","van");
define("_ON","op");
define("_LOGOUT","Uitloggen");
define("_WAITINGCONT","Wachtend nieuws");
define("_SUBMISSIONS","Artikel");
define("_EPHEMERIDS","Dag thema");
define("_ONEDAY","Een dag als vandaag...");
define("_ASREGISTERED","Heeft U nog geen account? Dan kunt U <a href=\"modules.php?name=Your_Account&amp;op=new_user\">hier</a>. een aanmaken. ");
define("_MENUFOR","Menu voor");
define("_NOBIGSTORY","Vandaag geen nieuws");
define("_BIGSTORY","Meest gelezen bericht van vandaag:");
define("_SURVEY","Poll");
define("_POLLS","Polls");
define("_PCOMMENTS","Reacties:");
define("_RESULTS","Uitslagen");
define("_HREADMORE","Verder lezen...");
define("_CURRENTLY","Op dit moment zijn");
define("_GUESTS","Gasten en");
define("_MEMBERS","Leden online.");
define("_YOUARELOGGED","U bent aangemeld als");
define("_YOUHAVE","U heeft");
define("_PRIVATEMSG","persoonlijke bericht(en).");
define("_YOUAREANON","U bent hier als gast. U kunt zicht <a href=\"modules.php?name=Your_Account&amp;op=new_user\">hier registreren</a>");
define("_NOTE","Notitie:");
define("_ADMIN","Administrator:");
define("_WERECEIVED","Wij hadden");
define("_PAGESVIEWS","Pagina views sinds");
define("_TOPIC","Thema");
define("_UDOWNLOADS","Downloads");
define("_VOTE","Stem");
define("_VOTES","Stemmen");
define("_MVIEWADMIN","Alleen zichtbaar voor administrators");
define("_MVIEWUSERS","Alleen zichtbaar voor leden");
define("_MVIEWANON","Alleen zichtbaar voor gasten");
define("_MVIEWGROUP","Alleen zichtbaar voor groepen");
define("_MVIEWALL","Zichtbaar voor alle bezoekers");
define("_EXPIRELESSHOUR","Verloop minder dan 1 uur");
define("_EXPIREIN","Verloopt op");
define("_HTTPREFERERS","HTTP Referer");
define("_UNLIMITED","Onbegrenst");
define("_HOURS","Uren");
define("_RSSPROBLEM","Er zijn problemen met de titels op de pagina");
define("_SELECTLANGUAGE","Taal kiezen");
define("_SELECTGUILANG","Taal voor het Interface kiezen");
define("_LANG_NO_MULTILINGUAL","Deze site is niet meertalig");
define("_NONE","geen");
define("_BLOCKPROBLEM","Er zijn problemen met dit block.");
define("_BLOCKPROBLEM2","Dit blok heeft op dit moment geen inhoud.");
define("_MODULENOTACTIVE","Sorry, deze module is niet actief!");
define("_MODULEDOESNOTEXIST","Sorry... deze module bestaat niet!");
define("_NOACTIVEMODULES","Inactieve Module");
define("_FORADMINTESTS","(Voor de admin om te testen");
define("_BBFORUMS","Forum");
define("_ACCESSDENIED","Geen toegang");
define("_RESTRICTEDAREA","U staat op hetpunt om een gesloten bereikt te betreden.");
define("_MODULEUSERS","Sorry, maar dit gedeelte is alleen voor onze <i>leden</i> toegangkelijk.<br /><br />U kunt zich hier gratis registreren, door <a href=\"modules.php?name=Your_Account&amp;op=new_user\"><i>hier te klikken</i></a>, <br />Bent u al lid dan kunt u <a href=\"modules.php?name=Your_Account\"><i>hier</i></a> inloggen.<br /><br />");
define("_MODULESADMINS","Sorry dit gedeelte is alleen voor  <i>Administrats</i> toegangkelijk.<br /><br />");
define("_HOME","Home");
define("_HOMEPROBLEM","Es is een groot probleem: Wij hebben geen homepagina!!!");
define("_ADDAHOME","Module voorde  Homepage toevoegen");
define("_HOMEPROBLEMUSER","Er is op dit moment een probleem met de site. Probeer het later nog eens.");
define("_MORENEWS","Meer in het nieuws gedeelte");
define("_ALLCATEGORIES","Alle Categorien");
//define("_DATESTRING","%A, %d. %B, %Y @ %T %Z");
//define("_DATESTRING2","%A, %d %B");
define('_DATESTRING','%A, %B %d, %Y (%H:%M:%S)');
define('_DATESTRING2','%A, %B %d');
define('_DATESTRING3','%d-%b-%Y');
define('_DATESTRING4','%1$s, %2$s %3$s');
define("_DATE","Datum");
define("_HOUR","Uur");
define("_UMONTH","Maand");
define("_YEAR","Jaar");
define("_JANUARY","January");
define("_FEBRUARY","February");
define("_MARCH","Maart");
define("_APRIL","April");
define("_MAY","Mei");
define("_JUNE","Juni");
define("_JULY","Juli");
define("_AUGUST","Augustus");
define("_SEPTEMBER","September");
define("_OCTOBER","Oktober");
define("_NOVEMBER","November");
define("_DECEMBER","December");
define("_BWEL","Welkom");
define("_BLOGOUT","Uitloggen");
define("_BPM","Persoonlijke berichten");
define("_BUNREAD","Ongelezen");
define("_BREAD","gelezen");
define("_BSAVED","Beveiligd");
define("_BTT","Totaal");
define("_BMEMP","Lidmaatschap");
define("_BLATEST","Nieuwste");
define("_BTD","Vandaag nieuw");
define("_BYD","Gisteren nieuw");
define("_BOVER","Alle");
define("_BVISIT","Gebruikers online");
define("_BVIS","Bezoeker");
define("_BMEM","Leden");
define("_BON","Nu online");
define("_BOR","of");
define("_BPLEASE","AUB");
define("_BREG","Registreren");
define("_BROADCAST","Broadcast publiekelijk bericht");
define("_BROADCASTFROM","Publiekelijk bericht van");
define("_TURNOFFMSG","Publiekelijke berichten uitschakelen");
define("_JOURNAL","Dagboek");
define("_READMYJOURNAL","Mijn dagboek lezen");
define("_ADD","Toevoegen");
define("_YES","Ja");
define("_NO","Nee");
define("_INVISIBLEMODULES","Onzichtbare Modules");
define("_ACTIVEBUTNOTSEE","(Actief, maar onzichtbare link)");
define("_THISISAUTOMATED","Dit is een automatische E-Mail ter informatie dat uw banner op onze site gedeactiveerd is.");
define("_THERESULTS","De uitslagen van uw advertentie op onze site is als volgt:");
define("_TOTALIMPRESSIONS","Totale aantal impressies:");
define("_CLICKSRECEIVED","Aantal hits:");
define("_IMAGEURL","URL vd afbeelding");
define("_CLICKURL","URL aanklikken:");
define("_ALTERNATETEXT","Alternatieve tekst:");
define("_HOPEYOULIKED","Wij hopen datu onze service kon waarderen en hopen u spoedig weer te mogen zien.");
define("_THANKSUPPORT","Dank vooruw ondersteuning");
define("_TEAM","Team");
define("_BANNERSFINNISHED","Banner toegevoegd");
define("_PAGEGENERATION","Opgebouwd op:");
define("_MEMORYUSAGE","HDD gebruik: ");
define("_DBQUERIES","DB oproepen: ");
//define('_PAGEFOOTER','Diese Seite wurde in %1$s Sekunden mit %2$s DB Queries in %3$s Sekunden erstellt');
define("_SECONDS","Seconden");
define("_YOUHAVEONEMSG","U heeft een nieuw bericht");
define("_NEWPMSG","nieuwe persoonlijke berichten");
define("_CONTRIBUTEDBY","Ondersteund door");
define("_CHAT","Chat");
define("_REGISTERED","Geregistreerd");
define("_CHATGUESTS","Gasten");
define("_USERSTALKINGNOW","Chat gebruikers");
define("_ENTERTOCHAT","Hier gaat het naar de chat");
define("_CHATROOMS","Beschikbare kamers");
define("_SECURITYCODE","Beveiliging-Code");
define("_TYPESECCODE","Beveiligingscode invoeren");
define("_ASSOTOPIC","Beschikbare onderwerpen");
define("_ADDITIONALYGRP","Op dit moment behoord deze module een gebruikersgroep toe");
define("_YOUHAVEPOINTS","Punten die u krijgt wanneer u deel neemt:");
define("_MVIEWSUBUSERS","Alleen voor geabboneerde gebruikers");
define("_MODULESSUBSCRIBER","Sorry, maar dit deel is alleen voor <i>Abonnenees.</i>");
define("_MODULESGROUP","Sorr, maar dit deel is alleen voor  <i>Groepsleden</i>");
define("_SUBEXPIRED","Uw abbonement verloppt op");
define("_HELLO","Hallo");
define("_SUBSCRIPTIONAT","Dit is een automatisch bericht om u mee te delen dat uw abbonement op");
define("_HASEXPIRED","nu afgelopen is.");
define("_HOPESERVED","Wij hopen dat u tevreden bent...");
define("_SUBRENEW","Als u uw abbonement verlengen wilt ga dan naar:");
define("_YOUARE","U bent");
define("_SUBSCRIBER","Abbonement");
define("_OF","van");
define("_SBYEARS","Jaren");
define("_SBYEAR","Jaar");
define("_SBMINUTES","Minuten");
define("_SBHOURS","Uren");
define("_SBSECONDS","Seconden");
define("_SBDAYS","Dagen");
define("_SUBEXPIREIN","Uw abbonement verloopt op:");
define("_NOTSUB","U bent geen abbonee van");
define("_NOTSUBUSR","Geen abbonee van");
define("_SUBFROM","U kunt abboneren van");
define("_HERE","Hier");
define("_NOW","Nu!");
define("_ADMSUB","Geabbonnerde gebruiker!");
define("_ADMNOTSUB","Gebruiker geen abbonee");
define("_ADMSUBEXPIREIN","Abbonement  verloopt op:");
define("_LASTIP","IP laatste gebruiker:");
define("_LASTVISIT","Laatste boezoek op:");
define("_LASTNA","N/A");
define("_BANTHIS","Ban deze IP");
define("_CZ_SECURITYCODE","Beveiligingscode: ");
define("_CZ_TYPESECCODE","Beveilingscode hier invoeren: ");
define("_ADMIN_BLOCK_DENIED", "U heeft geen rechten dit blok te bekijken");
define("_NEWSLETTERBLOCKSUBSCRIBED", "U heeft zich op onze nieuwsbrief geabboneerd");
define("_NEWSLETTERBLOCKREGISTER", "U dient zich eerst te registreren om op de nieuwesbrief te kunnen abboneren");
define("_NEWSLETTERBLOCKREGISTERNOW", "Klik voor registratie");
define("_NEWSLETTERBLOCKNOTSUBSCRIBED", "U heeft geen  abbonement op onze nieuwsbrief");
define("_NEWSLETTERBLOCKSUBSCRIBE", "Abboneren");
define("_NEWSLETTERBLOCKUNSUBSCRIBE", "Uischakelen");
define("_ANONYMOUS","Anoniem");
define("_MODULEERROR","Module fout opgetreden");

define('_ILLEGAL_OP_OPERATION', 'U heeft deze site op een illegale wijze opgeroepen <br />Controleer AUB de URL in uw browser');
define('_PAGE_NOT_EXISTS', 'Sorry, de opgevraagde pagina bestaat niet meer');
define('_REFRESH_SCREEN', 'Beeld verversen');

define('_AS_IS', '-Geen opmerking-');
define('_OFFTOPIC', 'Off topic');
define('_FLAMEBAIT', 'Opgeblazen');
define('_TROLL', 'Troll');
define('_REDUNDANT', 'Herhaling');
define('_INSIGHTFUL', 'Leerzaam');
define('_INTERESTING', 'Interessant');
define('_INFORMATIVE', 'Informatief');
define('_FUNNY', 'Grappig');
define('_OVERRATED', 'Ongewaardeerd');
define('_UNDERRATED', 'Gewaardeerd');
define('_EVO_HELPSYSTEM', 'Hulp Nuke Evolution');
define('_OVERLIB_CLOSE', 'Sluiten');

define('_GUEST', 'Gast');
define('_BOTS', 'Zoekmachines');
define('_BOT', 'Zoekmachine');
define('_ABR_DAYS', 'T');
define('_ABR_MONTHS', 'M');
define('_ABR_YEARS', 'J');
define('_ABR_MINUTES', 'Min');
define('_ABR_HOURS', 'H');
define('_ABR_SECONDS', 'Sec');

define("_ACTIVETOPICS","Op dit moment geen actieve onderwerpen");

define('_MESSAGE', 'bericht');
define('_EMAIL', 'E-mail');
define('_FROM', 'van');

// Modulenames to show in Who-is-Online
define('_MODULE_0', ' Forum: Index');
define('_MODULE_-1', 'Forum: Login');
define('_MODULE_-2', 'Forum: Zoeken');
define('_MODULE_-3', 'Registratieformulier');
define('_MODULE_-4', 'Profiel');
define('_MODULE_-6', 'Forum: Wie is online');
define('_MODULE_-7', 'Forum: Ledenlijst');
define('_MODULE_-8', 'Forum: FAQ');
define('_MODULE_-9', 'Forum: Onderwerpen');
define('_MODULE_-10', 'Prive berichten');
define('_MODULE_-11', 'Forum: Groepen');
define('_MODULE_-12', 'Forum: Teampagina');
define('_MODULE_-1210', 'Forum: Bijlages');
define('_MODULE_-1214', 'Forum: Board-Regels');
define('_MODULE_-15', 'Foren');
define('_MODULE_-16', 'Forum: Themas');
define('_MODULE_-17', 'Forum: Beitr&auml;ge');
define('_MODULE_-33', 'Forum: Laatste themas');
define('_MODULE_-34', 'Forum: Statistieken');
define('_MODULE_-35', 'Forum: Rangen');
define('_MODULE_-50', 'Forum: Administratie');
define('_MODULE_-5000', 'Forum: Thema overzicht');

?>
