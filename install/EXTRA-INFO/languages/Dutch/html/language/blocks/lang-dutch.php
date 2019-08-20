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

$lang_block['BLOCK_NO_IMAGE']  = 'Geen afbeelding aanwezig';
$lang_block['BLOCK_NO_CONTENT'] = 'Geeninhoud aanwezig';
$lang_block['BLOCK_NO_CONFIG'] = 'Configuratie niet mogelijk';
$lang_block['BLOCK_DELETE']  = 'Verwijderen';

/*****[BEGIN]******************************************
 [ Lang:     Articles
             News
             Topics]
 ******************************************************/
$lang_block['BLOCK_NEWS_READS'] = 'Gelezen';
$lang_block['BLOCK_NEWS_MORENEWS'] = 'Meer in nieuws';
$lang_block['BLOCK_NEWS_ANONYM'] = 'Gast';
$lang_block['BLOCK_NEWS_WRITES'] = 'Geschreven door:';
$lang_block['BLOCK_NEWS_SEND_PRINTER'] = 'Dit artikel printen';
$lang_block['BLOCK_NEWS_SEND_FRIEND'] = 'Dit artikel naar een vriend versturen';
$lang_block['BLOCK_NEWS_SELECT_PAGE'] = 'Pagina kiezen';
$lang_block['BLOCK_NEWS_OF'] = 'van';
$lang_block['BLOCK_NEWS_OF_PAGES'] = 'Paginas';
$lang_block['BLOCK_NEWS_TOPICS_ALL'] = 'Alle onderwerpen weergeven';
$lang_block['BLOCK_NEWS_ARTICLES_LAST'] = 'Laatste Artikel';
$lang_block['BLOCK_NEWS_NOTE'] = 'Notitie:';
$lang_block['BLOCK_NEWS_READMORE'] = 'meer ...';
$lang_block['BLOCK_NEWS_COUNTRATINGS'] = 'Aantal waarderingen';
$lang_block['BLOCK_NEWS_ANONYMOUS'] = 'Gast';
$lang_block['BLOCK_NEWS_PRINTER'] = 'Printvriendelijk versie';
$lang_block['BLOCK_NEWS_FRIEND'] = 'Dit artikel naar een vriend sturen';
$lang_block['BLOCK_NEWS_EDIT'] = 'Aanpassen';
$lang_block['BLOCK_NEWS_DELETE'] = 'Verwijderen';
$lang_block['BLOCK_NEWS_POSTEDBY'] = 'Geschreven door:';
$lang_block['BLOCK_NEWS_ON'] = 'op';
$lang_block['BLOCK_NEWS_COMMENTS'] = 'Commentaar';
$lang_block['BLOCK_NEWS_CATEGORY'] = 'Categorie';
/*****[END]********************************************
 [ Lang:     Articles
             News
             Topics]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Big_Story_of_Today]
 ******************************************************/
$lang_block['BLOCK_BIGSTORY_OF_TODAY_CONTENT'] = 'Meest gelezen bericht van vandaag';
/*****[END]********************************************
[ Lang:      Big_Story_of_Today]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Donations
 ******************************************************/
$lang_block['BLOCK_DONATIONS_ANON'] = 'Anoniem';
$lang_block['BLOCK_DONATIONS_DONATE'] = 'Donatie';
$lang_block['BLOCK_DONATIONS_DONATE_ANON'] = 'Anoniem';
$lang_block['BLOCK_DONATIONS_DONATE_TOTAL'] = 'Totaal:';
$lang_block['BLOCK_DONATIONS_DONATE_GOAL'] = 'Doel:';
$lang_block['BLOCK_DONATIONS_DONATE_DIF'] = 'Verschil:';
/*****[END]********************************************
 [ Lang:     Donations
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Downloads]
 ******************************************************/
$lang_block['Download_Top_Downloads'] = 'Top Downloader';
$lang_block['Download_Top_Uploader'] = 'Top Uploader';
$lang_block['Download_Statistic'] = 'Download Statistiek';
$lang_block['Download_Total_Files'] = 'Totale bestanden';
$lang_block['Download_Total_Hits'] = 'Totale hits';
/*****[END]********************************************
[ Lang:      Downloads]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Evo-Forums
             EvoForums_Topics
             EvoForums_Basic]
 ******************************************************/
$lang_block['BLOCK_FORUM_ANNOUNCE'] = 'Mededelingen';
$lang_block['BLOCK_FORUM_ANNOUNCENO'] = 'Er zijn geen mededelingen';
$lang_block['BLOCK_FORUM_COUNTREPLIES'] = 'Antwoorden';
$lang_block['BLOCK_FORUM_COUNTVIEWS'] = 'Aanzichten';
$lang_block['BLOCK_FORUM_CREATEDBY']  = 'Gemaakt door';
$lang_block['BLOCK_FORUM_CREATEDON']  = 'op';
$lang_block['BLOCK_FORUM_FORUM']  = 'Forum';
$lang_block['BLOCK_FORUM_FORUMS'] = 'Forums';
$lang_block['BLOCK_FORUM_LASTPOST']  = 'Laatste onderwep';
$lang_block['BLOCK_FORUM_NEWPOST']   = 'Nieuw onderwerp';
$lang_block['BLOCK_FORUM_NOTOPIC']    = 'Er zijn geen onderwerpen om weer te geven';
$lang_block['BLOCK_FORUM_POST']   = 'Onderwerp';
$lang_block['BLOCK_FORUM_POSTS']  = 'Berichten';
$lang_block['BLOCK_FORUM_RECENT']    = 'Overzicht laatste onderwerpen';
$lang_block['BLOCK_FORUM_TOPIC']  = 'Onderwerp';
$lang_block['BLOCK_FORUM_TOPICS'] = 'Onderwerpen';
$lang_block['BLOCK_FORUM_WEHAVE'] = 'Wij hebben';
// The next lines are copies from lang_main.php from Forums Language. If language isn't loaded until this time we need them for includes/auth.php.
$lang['Sorry_auth_announce'] = 'Aankondigingen in dit forum kunnen alleen door %s gedaan worden.';
$lang['Sorry_auth_sticky'] = 'Belangrijke berichten kunnen in dit forum alleen door %s gedaan worden.';
$lang['Sorry_auth_read'] = 'Alleen %s hebben het recht om onderwerpen in forum te lezen.';
$lang['Sorry_auth_post'] = 'Alleen %s hebben het recht om in dit forum onderwerpen aan te maken.';
$lang['Sorry_auth_reply'] = 'Alleen %s hebben het recht om in dit forum omop onderwerpen te reageren.';
$lang['Sorry_auth_edit'] = 'Alleen %s hebben het recht om in dit forum onderwerpen te bewerken.';
$lang['Sorry_auth_delete'] = 'Alleen %s hebben het recht om in dit forum onderwerpen te verwijderen.';
$lang['Sorry_auth_vote'] = 'In dit forum kunnen alleen %s stemmen.';
// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<strong>Gasten</strong>';
$lang['Auth_Registered_Users'] = '<strong>Leden</strong>';
$lang['Auth_Users_granted_access'] = '<strong>Gebruikers met speciale rechten</strong>';
$lang['Auth_Moderators'] = '<strong>Moderators</strong>';
$lang['Auth_Administrators'] = '<strong>Administrators</strong>';
$lang['Not_Moderator'] = 'U bent geen moderator in dit forum.';
$lang['Not_Authorised'] = 'Niet bevoegd';
$lang['You_been_banned'] = 'U bent van dit forum verbannen.<br />Neem contact op met de Administrator voor meer info.';
/*****[END]********************************************
 [ Lang:     Evo-Forums
             EvoForums_Topics
             EvoForums_Basic]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Groups]
 ******************************************************/
$lang_block['Current_memberships'] = 'Leden groepen';
$lang_block['Memberships_pending'] = 'Wachtende groepen';
$lang_block['Group_member_join'] = 'Open Groepen';
/*****[END]********************************************
 [ Lang:     Groups]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Hits
 ******************************************************/
$lang_block['BLOCK_HITS_TOTALHITS'] = 'Wij hadden';
$lang_block['BLOCK_HITS_PAGEVIEWS'] = 'pagina bezoeken';
$lang_block['BLOCK_HITS_SINCE'] = 'sinds';
/*****[END]********************************************
 [ Lang:     Hits]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Languages]
 ******************************************************/
$lang_block['BLOCK_LANGUAGES_SELECT'] = 'Kies uw taal';
$lang_block['BLOCK_TRANSLATIONS_LANG_NOT_SUPPORTED'] = 'De huidige taal word niet ondersteund';
/*****[END]********************************************
 [ Lang:     Languages
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Link_Us]
 ******************************************************/
$lang_block['BLOCK_LINKUS_VIEW_ALL_BUTTONS'] = 'Alle knoppen weergeven';
$lang_block['BLOCK_LINKUS_CLICKS'] = 'Kliks';
/*****[END]********************************************
 [ Lang:     Link_Us]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Modules]
 ******************************************************/
$lang_block['BLOCK_MODULES_HOME'] = 'Home';
$lang_block['BLOCK_MODULES_MORE'] = 'Meer';
$lang_block['BLOCK_MODULES_NONE'] = 'Geen bericht';
$lang_block['BLOCK_MODULES_INVISIBLE'] = 'Niet zichtbare Modules';
$lang_block['BLOCK_MODULES_INACTIVE_MODULE'] = 'Inactieve Modules';
$lang_block['BLOCK_MODULES_INACTIVE_LINK'] = 'Inactieve Links';
$lang_block['BLOCK_MODULES_VIEWANON'] = 'Alleen voor gasten';
$lang_block['BLOCK_MODULES_MODULEUSERS'] = 'Alleen voor leden';
$lang_block['BLOCK_MODULES_MODULESADMINS'] = 'Alleen voor admnistrators';
$lang_block['BLOCK_MODULES_MODULESGROUP'] = 'Alleen voor leden van een bepaalde groep';
/*****[END]********************************************
 [ Lang:     Modules Block]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Newsletter]
 ******************************************************/
$lang_block['BLOCK_NEWSLETTER_UNSUBSCRIBE'] = 'Afmelden';
$lang_block['BLOCK_NEWSLETTER_SUBSCRIBE'] = 'Abbonneren';
$lang_block['BLOCK_NEWSLETTER_SUBSCRIBED'] = 'U hebt u aangemeld voor de nieuwsbrief';
$lang_block['BLOCK_NEWSLETTER_SUBSCRIBED_NOT'] = 'U heb u niet voor de nieuwsbrief aangeld';
$lang_block['BLOCK_NEWSLETTER_REGISTER_TEXT'] = 'U dient zich eerst te registreren om voor de nieuwsbrief aan te kunnen melden';
$lang_block['BLOCK_NEWSLETTER_REGISTER_DOIT'] = 'Registreren';
$lang_block['BLOCK_NEWSLETTER_IMAGE_TEXT'] = 'Nieuwsbrief';
/*****[END]********************************************
 [ Lang:     Newsletter]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Reviews]
 ******************************************************/
$lang_block['BLOCK_REVIEWS_FULL_VIEW'] = 'Deze recessie bekijken';
$lang_block['BLOCK_REVIEWS_VISIT'] = 'Bekijken';
/*****[END]********************************************
[ Lang:      Reviews]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Search
 ******************************************************/
$lang_block['BLOCK_SEARCH_SEARCH_DO'] = 'Zoeken';
/*****[END]********************************************
 [ Lang:     Search]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Sentinel]
 ******************************************************/
$lang_block['BLOCK_SENTINEL_SENTINEL_TITLE_IMG'] = 'Beschermd door Sentinel';
$lang_block['BLOCK_SENTINEL_HTTPREFERERS'] = 'HTTP Referer';
$lang_block['BLOCK_SENTINEL_REFERERS_DELETE']  = 'Referer verwijderen';
$lang_block['BLOCK_SENTINEL_REFERERS_TOTAL']  = 'Totaal';
$lang_block['BLOCK_SENTINEL_CAUGHT'] = 'Wij hebben';
$lang_block['BLOCK_SENTINEL_SHAME'] = 'IP-Adres(sen)';
$lang_block['BLOCK_SENTINEL_SHAME1'] = 'voor toegang naar onze <br />site geband.';
$lang_block['BLOCK_SENTINEL_LIST'] = 'Dit is de lijst van de door NukeSentinel gebande IP Adressen.';
/*****[END]********************************************
 [ Lang:     Sentinel]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Surveys]
 ******************************************************/
$lang_block['BLOCK_SURVEYS_VOTE'] = 'Stemmen';
$lang_block['BLOCK_SURVEYS_RESULTS'] = 'Naar resultaten';
$lang_block['BLOCK_SURVEYS_COMMENTS'] = 'Reacties';
$lang_block['BLOCK_SURVEYS_POLLS'] = 'Naar de polls';
$lang_block['BLOCK_SURVEYS_VOTES'] = 'Stemmen';
/*****[END]********************************************
[ Lang:      Surveys]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     WebLinks]
 ******************************************************/
$lang_block['BLOCK_WEBLINKS_FULL_VIEW'] = 'Deze Weblink bekijken';
$lang_block['BLOCK_WEBLINKS_VISIT'] = 'Bekijken';
/*****[END]********************************************
[ Lang:      WebLinks]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Users]
 ******************************************************/
$lang_block['BLOCK_USERINFO_YOUR_IP'] = 'IP-Adres';
$lang_block['BLOCK_USERINFO_YOU_HAVE'] = 'U hebt';
$lang_block['BLOCK_USERINFO_YOU_BE_USER'] = 'U bent aangemeld als';
$lang_block['BLOCK_USERINFO_YOU_BE_GUEST'] = 'U bent als gast op onze site, U kunt zich hier registreren';
$lang_block['BLOCK_USERINFO_PN_UNREAD'] = 'Ongelezen';
$lang_block['BLOCK_USERINFO_PN_READ'] = 'Gelezen';
$lang_block['BLOCK_USERINFO_PN_ARCHIVE'] = 'Gearchiveerd';
$lang_block['BLOCK_USERINFO_PN_TITLE'] = 'Prive berichten';
$lang_block['BLOCK_USERINFO_PN_TOTAL'] = 'Totaal';
$lang_block['BLOCK_USERINFO_GROUPS_TITLE'] = 'Groeps lidmaatschap';
$lang_block['BLOCK_USERINFO_GROUPS_MEMBER_NONE'] = 'Geen';
$lang_block['BLOCK_USERINFO_WELCOME'] = 'Welkom';
$lang_block['BLOCK_USERINFO_REGISTER_DOIT'] = 'Registreren';
$lang_block['BLOCK_USERINFO_LOGIN_DOIT'] = 'Inloggen';
$lang_block['BLOCK_USERINFO_LOGIN_USERNAME'] = 'Gebruikersnaam';
$lang_block['BLOCK_USERINFO_LOGIN_PW'] = 'Wachtwoord';
$lang_block['BLOCK_USERINFO_ONLINE'] = 'Jetzt Online';
$lang_block['BLOCK_USERINFO_ONLINE_MEMBER'] = 'Leden';
$lang_block['BLOCK_USERINFO_ONLINE_GUESTS'] = 'Gasten';
$lang_block['BLOCK_USERINFO_ONLINE_TOTAL'] = 'Totaal';
$lang_block['BLOCK_USERINFO_ONLINE_TITLE'] = 'Online gebruikers';
$lang_block['BLOCK_USERINFO_MEMBERS_TITLE'] = 'Leden';
$lang_block['BLOCK_USERINFO_MEMBERS_NEWEST'] = 'Laatste';
$lang_block['BLOCK_USERINFO_MEMBERS_NEWTODAY'] = 'Nieuw vandaag';
$lang_block['BLOCK_USERINFO_MEMBERS_NEWYESTERDAY'] = 'Nieuw gisteren';
$lang_block['BLOCK_USERINFO_MEMBERS_TOTAL'] = 'Totaal';
$lang_block['BLOCK_USERINFO_LOGOUT_DOIT'] = 'Uitloggen';
$lang_block['BLOCK_USERINFO_GUEST'] = 'Gast';
$lang_block['BLOCK_USERINFO_GUESTS'] = 'Gasten';
/*****[END]********************************************
[ Lang:      Users]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Multilingual Block Titles]
 ******************************************************/
$lang_block['block-Administration'] = 'Administratie';
$lang_block['block-Advertising'] = 'Advertentie';
$lang_block['block-Big_Story_of_Today'] = 'Bericht van de dag';
$lang_block['block-Categories'] = 'Berichten categorien';
$lang_block['block-Content'] = 'Inhoud';
$lang_block['block-Donations'] = 'Donaties';
$lang_block['block-Downloads-Access'] = 'Download Statistieken';
$lang_block['block-Downloads-Hot'] = 'Populairste Downloads';
$lang_block['block-Downloads-New'] = 'Nieuwste Downloads';
$lang_block['block-Evo_User_Info'] = 'Gebruikers<br /> Info-Centrale';
$lang_block['block-EvoForums'] = 'Forumoverzicht';
$lang_block['block-EvoTopics'] = 'Forumberichten';
$lang_block['block-Forums'] = 'Forums';
$lang_block['block-Forums_Scroll'] = 'Forums';
$lang_block['block-Groups'] = 'Overzicht groepen';
$lang_block['block-Hacker_Beware'] = 'Hackerbescherming';
$lang_block['block-Hacker_Beware2'] = 'Hackerbescherming';
$lang_block['block-Hacker_Beware3'] = 'Hackerbescherming';
$lang_block['block-Languages'] = 'Taal selectie';
$lang_block['block-Last_5_Articles'] = 'Actuele Artikel';
$lang_block['block-Last_5_Reviews'] = 'Actuele Testberichten';
$lang_block['block-Last_Referers'] = 'Laatste Websitebezoeken';
$lang_block['block-Link-us'] = 'Plaats een link naar ons';
$lang_block['block-Modules'] = 'Menu';
$lang_block['block-Modules_all'] = 'Menus';
$lang_block['block-News-Center'] = 'Berichten overzicht';
$lang_block['block-Newsletter'] = 'Berichten';
$lang_block['block-Nuke-Evolution'] = 'Nuke-Evolution Netwerk';
$lang_block['block-Old_Articles'] = 'Gearchiveerde Artikels';
$lang_block['block-Random_Headlines'] = 'Willekeurige titels';
$lang_block['block-Random_Links'] = 'Willekeurige links';
$lang_block['block-Random_Quotes'] = 'Willekeurige treffer';
$lang_block['block-Reviews'] = 'Testbericht';
$lang_block['block-Search'] = 'Zoeken';
$lang_block['block-Sentinel'] = 'Hackerbescherming';
$lang_block['block-Sentinel_Center'] = 'Hackerbescherming';
$lang_block['block-Sentinel_Scrolling'] = 'Hackerbescherming';
$lang_block['block-Sentinel_Side'] = 'Hackerbescherming';
$lang_block['block-Sommaire'] = 'Menu';
$lang_block['block-Submissions'] = 'Overzicht inzendingen';
$lang_block['block-Supporters_Dn'] = 'Wij worden ondersteund door';
$lang_block['block-Supporters_Random'] = 'Wij worden ondersteund door';
$lang_block['block-Supporters_Rt'] = 'Wij worden ondersteund door';
$lang_block['block-Survey'] = 'Polls';
$lang_block['block-Themes'] = 'Themaselectie';
$lang_block['block-Top10_Links'] = 'Top 10 Links';
$lang_block['block-Total_Hits'] = 'Bezoekers';
$lang_block['block-Universal-Forums-Center'] = 'Forems';
$lang_block['block-User_Info'] = 'Gebruikers info centrale';
$lang_block['block-User_Login'] = 'Inloggen';
$lang_block['block-Who_is_Online'] = 'Wie is online';
/*****[END]********************************************
 [ Lang:     Multilingual Block Titles]
 ******************************************************/

?>