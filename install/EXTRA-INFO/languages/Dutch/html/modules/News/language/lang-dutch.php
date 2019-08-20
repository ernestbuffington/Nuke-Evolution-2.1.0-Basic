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

define("_ALLOWEDHTML","Toegestane HTML Code:");
define("_ALREADYVOTEDARTICLE","Sorry, maar u heeft al een waardering op dit gegeven!");
define("_ARTICLEPOLL","Artikel poll");
define("_ARTICLERATING","Waardering artikel");
define("_AVERAGESCORE","gemiddelde waardering");
define("_BACKTOARTICLEPAGE","terug naar de artikelpagina");
define("_BAD","Slecht");
define("_BYTESMORE","meer zien laten");
define("_CASTMYVOTE","Stemmen!");
define("_COMESFROM","Dit artikel komt van");
define("_COMMENT","Raectie");
define("_COMMENTREPLY","Op artikel reageren");
define("_COMMENTSQ","Reacties?");
define("_COMMENTSWARNING","Voor de inhoud van de reacties zijn wij niet verantwoordelijk.");
define("_COMREPLYPRE","Vooraanzicht reacties");
define("_CONFIGURE","Instellen");
define("_CONSIDERED","Ik vond het volgende artikel interessant en wou je hiervan even op de hoogte stellen.");
define("_DIDNTRATE","U heeft geen waardering voor dit artikelen gekozen!");
define("_EXCELLENT","Uitstekend");
define("_EXTRANS","HTML Code naar teks overzetten");
define("_FDATE","Datum:");
define("_FFRIENDEMAIL","E-mail een vriend:");
define("_FFRIENDNAME","Naam vriend:");
define("_FLAT","Vlak");
define("_FRIEND","Dit artikel naar een vriend sturen");
define("_FSTORY","Artikel");
define("_FTOPIC","Thema:");
define("_FYOUREMAIL","Uw E-Mail:");
define("_FYOURNAME","Uw naam:");
define("_GOOD","Goed");
define("_GOTOHOME","Terug naar startpagina");
define("_GOTONEWSINDEX","Terug naar artikel index");
define("_HASSENT","is verstuurd naar");
define("_HIGHEST","Hoogste waardering eerst");
define("_HTMLFORMATED","HTML format");
define("_INTERESTING_ARTICLE","Een interessant artikel op");
define("_LOGINCREATE","Registreren/Inloggen");
define("_MOREABOUT","Meer tot dit onderwerp");
define("_MOSTREAD","De meest gelezen artikel tot dit onderwerp");
define("_NAME","Naam");
define("_NESTED","genesteld");
define("_NEWEST","Nieuwe eerst");
define("_NEWS", "Nieuwtjes");
define("_NEWSBY","Berichten van");
define("_NEWUSER","Nieuwe gebruiker");
define("_NOANONCOMMENTS","Geen anonieme reactie mogelijk, eeerst AUB <a href=\"modules.php?name=Your_Account\">inloggen</a>");
define("_NOCOMMENTS","geen reactie");
define("_NOCOMMENTSACT","Er is geen reactie voor dit artikel beschikbaar.");
define("_NOINFO4TOPIC","Sorry, maar er is voor het gekozen onderwerp geen informatie beschikbaar.");
define("_NOSUBJECT","geen onderwerp");
define("_NOTRIGHT","Er is een fout opgetreden, deze melding moet helpen om verdere fouten te voorkomen.");
define("_OK","Ok!");
define("_OLDEST","Oude eerst");
define("_ONN","Reactie ...");
define("_OPTIONS","Instellingen");
define("_PARENT","Oplopend");
define("_PDATE","Datum:");
define("_PLAINTEXT","Eenvoudige tekst");
define("_POSTANON","Anoniem schrijven");
define("_PREVIEW","Voorbeeld");
define("_PRINTER","Printvriendelijk versie");
define("_PTOPIC","Thema:");
define("_RATEARTICLE","Artikel waardering");
define("_RATETHISARTICLE","Neeem AUB even de tijd om deze artikel een waardering te geven:");
define("_READMORE","Lees hier verder...");
define("_READPDF","Als PDF lezen");
define("_READREST","De rest van de reactie lezen...");
define("_READWITHCOMMENTS", "U kunt het volledige artikel met de reacties lezen op");
define("_RECOMMEND","Deze website een vriend aanbevelen");
define("_REFRESH","Geactualiseerd");
define("_REGULAR","Normaal");
define("_RELATED","Gerelateerde links");
define("_REPLY","hierop antwoorden");
define("_REPLYMAIN","Reactie geven");
define("_ROOT","Hoofd path");
define("_SCORE","Waardering:");
define("_SEARCHDIS","Discussie doorzoeken");
define("_SEARCHONTOPIC","In dit onderwerp zoeken");
define("_SELECTNEWTOPIC","Kies een nieuw onderwerp");
define("_SEND","Versturen");
define("_SENDAMSG","Persoonlijk bericht versturen");
define("_SID_FAILURE", "Het gezochte artikel werd niet gevonden");
define("_SUBJECT","Onderwerp");
define("_THANKS","Dank u!");
define("_THANKSVOTEARTICLE","Bedankt voor uw waardering!");
define("_THEURL","De URL voor dit artikel is:");
define("_THREAD","Discussielijn");
define("_THRESHOLD","Grens");
define("_TOAFRIEND","aan uw vriend met de naam:");
define("_UCOMMENT","Reactie");
define("_URL","URL");
define("_USERINFO","Gebruikersinfo");
define("_VERYGOOD","Zeer goed");
define("_YOUCANREAD","Hier kunt u meer interessante artikels lezen:");
define("_YOURFRIEND","Uw vriend");
define("_YOURNAME","Uw naam");
define("_YOUSENDSTORY","U verzend dit artikel");

/*****[BEGIN]******************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/
define("_NE_ALLTOPICS","Alle onderwerpen");
define("_NE_ARTICLES","Artikel");
define("_NE_CATEGORY","categorie");
define("_NE_COMPLETE","Originele tekst");
define("_NE_COUNTRATINGS","Aantal waarderingen");
define("_NE_DISPLAYTYPE","scheiding weergeven");
define("_NE_DUAL","Dubbele scheiding");
define("_NE_HOMENUMBER","Artikel op de startpagina");
define("_NE_HOMENUMNOTE","Dit overschrijft de gebruikersinstellingen<br />\n als dit niet op Nuke Default is gezet");
define("_NE_HOMETOPIC","Onderwerp op de startpagina");
define("_NE_MODERATE","Moderate waarderingen");
define("_NE_NEWSCONFIG","Artikel configuratie");
define("_NE_NO","Nee");
define("_NE_NONE_NEWS","Er zijn geen berichten beschikbaar");
define("_NE_NOTIFYAUTH","Autor op de hoogte stellen");
define("_NE_NOTIFYAUTHNOTE","Dit verzend een E-Mail naar de auteur<br />\n ter overzicht");
define("_NE_NO_EMPTY_COMMENT","Het veld 'onderwerp'of het veld 'reacite' is leeg. Dit is niet toegstaan.<br />"._GOBACK);
define("_NE_NUKEDEFAULT","Nuke Default");
define("_NE_OF","van");
define("_NE_PAGE","Pagina");
define("_NE_PAGES","Paginas");
define("_NE_POPUP","Popup");
define("_NE_READLINK","Link: lees verder");
define("_NE_SAVECHANGES","Wijziging opslaan");
define("_NE_SELECT","Pagina kiezen");
define("_NE_SINGLE","Enkele scheiding");
define("_NE_TEXTTYPE","Artikellengte");
define("_NE_TRUNCATE","op 255 tekens begrenzen");
define("_NE_WEBSITE","Website");
define("_NE_YES","Ja");
/*****[END]********************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/

?>