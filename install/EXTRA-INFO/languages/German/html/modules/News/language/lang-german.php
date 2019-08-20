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

define("_ALLOWEDHTML","erlaubter HTML Code:");
define("_ALREADYVOTEDARTICLE","Entschuldigung, aber Du hast bereits Deine Bewertung zu diesem Artikel abgegeben!");
define("_ARTICLEPOLL","Artikel Umfrage");
define("_ARTICLERATING","Artikel Bewertung");
define("_AVERAGESCORE","durchschnittliche Bewertung");
define("_BACKTOARTICLEPAGE","Zur&uuml;ck zu den Artikeln");
define("_BAD","Schlecht");
define("_BYTESMORE","mehr Zeichen");
define("_CASTMYVOTE","Abstimmen!");
define("_COMESFROM","Dieser Artikel kommt von");
define("_COMMENT","Kommentar");
define("_COMMENTREPLY","Artikel kommentieren");
define("_COMMENTSQ","Kommentare?");
define("_COMMENTSWARNING","F&uuml;r den Inhalt der Kommentare sind die Verfasser verantwortlich.");
define("_COMREPLYPRE","Kommentar- Voransicht");
define("_CONFIGURE","Konfigurieren");
define("_CONSIDERED","fand den folgenden Artikel interessant und wollte ihn an dich senden.");
define("_DIDNTRATE","Du hast keine Bewertung f&uuml;r den Artikel gew&auml;hlt!");
define("_EXCELLENT","Exzellent");
define("_EXTRANS","HTML Code zu Text umwandeln");
define("_FDATE","Datum:");
define("_FFRIENDEMAIL","eMail des Freundes:");
define("_FFRIENDNAME","Name des Freundes:");
define("_FLAT","flach");
define("_FRIEND","Diesen Artikel an einen Freund senden");
define("_FSTORY","Artikel");
define("_FTOPIC","Thema:");
define("_FYOUREMAIL","Deine eMail:");
define("_FYOURNAME","Dein Name:");
define("_GOOD","Gut");
define("_GOTOHOME","Zur&uuml;ck zur Startseite");
define("_GOTONEWSINDEX","Zur&uuml;ck zum Artikel Index");
define("_HASSENT","wurde gesendet an");
define("_HIGHEST","H&ouml;chste Bewertung zuerst");
define("_HTMLFORMATED","HTML formatiert");
define("_INTERESTING_ARTICLE","Ein interessanter Artikel bei");
define("_LOGINCREATE","Anmelden/Neuanmeldung");
define("_MOREABOUT","Mehr zu dem Thema");
define("_MOSTREAD","Der meist gelesene Artikel zu dem Thema");
define("_NAME","Name");
define("_NESTED","geschachtelt");
define("_NEWEST","Neue zuerst");
define("_NEWS", "Neuigkeiten");
define("_NEWSBY","Nachrichten von");
define("_NEWUSER","neuer Benutzer");
define("_NOANONCOMMENTS","Keine anonymen Kommentare m&ouml;glich, bitte zuerst <a href=\"modules.php?name=Your_Account\">anmelden</a>");
define("_NOCOMMENTS","kein Kommentar");
define("_NOCOMMENTSACT","Es ist kein Kommentar f&uuml;r diesen Artikel vorhanden.");
define("_NOINFO4TOPIC","Entschuldigung, aber es gibt f&uuml;r das gew&auml;hlte Thema keine Informationen.");
define("_NOSUBJECT","Kein Betreff");
define("_NOTRIGHT","Die &Uuml;bergabe einer Variable an diese Funktion ist fehlerhaft. Diese Meldung soll helfen, Folgefehler zu vermeiden.");
define("_OK","Ok!");
define("_OLDEST","Alte zuerst");
define("_ONN","kommentiert ...");
define("_OPTIONS","Einstellungen");
define("_PARENT","aufw&auml;rts");
define("_PDATE","Datum:");
define("_PLAINTEXT","einfacher Text");
define("_POSTANON","Anonym schreiben");
define("_PREVIEW","Vorschau");
define("_PRINTER","Druckbare Version");
define("_PTOPIC","Thema:");
define("_RATEARTICLE","Artikel Bewertung");
define("_RATETHISARTICLE","Bitte nimm Dir einen Augenblick Zeit, diesen Artikel zu bewerten:");
define("_READMORE","mehr...");
define("_READPDF","Lese als PDF");
define("_READREST","Den Rest des Kommentars lesen...");
define("_READWITHCOMMENTS", "Du kannst den kompletten Artikel mit seinen Kommentaren lesen von");
define("_RECOMMEND","Diese Webseite einem Freund empfehlen");
define("_REFRESH","Aktualisieren");
define("_REGULAR","Normal");
define("_RELATED","Verwandte Links");
define("_REPLY","Darauf antworten");
define("_REPLYMAIN","Kommentar schreiben");
define("_ROOT","Hauptverzeichnis");
define("_SCORE","Bewertung:");
define("_SEARCHDIS","Diskussion durchsuchen");
define("_SEARCHONTOPIC","In diesem Thema suchen");
define("_SELECTNEWTOPIC","W&auml;hle ein neues Thema");
define("_SEND","Senden");
define("_SENDAMSG","Private Nachricht senden");
define("_SID_FAILURE", "Der gesuchte Artikel konnte leider nicht gefunden werden");
define("_SUBJECT","Betreff");
define("_THANKS","Danke!");
define("_THANKSVOTEARTICLE","Danke f&uuml;r Deine Bewertung!");
define("_THEURL","Die URL f&uuml;r diesen Artikel ist:");
define("_THREAD","Diskussionsfaden");
define("_THRESHOLD","Grenze");
define("_TOAFRIEND","an Deinen Freund mit dem Namen:");
define("_UCOMMENT","Kommentar");
define("_URL","URL");
define("_USERINFO","Benutzerinfo");
define("_VERYGOOD","Sehr gut");
define("_YOUCANREAD","Hier kannst Du weitere interessante Artikel lesen:");
define("_YOURFRIEND","Dein Freund");
define("_YOURNAME","Dein Name");
define("_YOUSENDSTORY","Du versendest diesen Artikel");

/*****[BEGIN]******************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/
define("_NE_ALLTOPICS","Alle Themen");
define("_NE_ARTICLES","Artikel");
define("_NE_CATEGORY","Kategorie");
define("_NE_COMPLETE","Original Text");
define("_NE_COUNTRATINGS","Anzahl Bewertungen");
define("_NE_DISPLAYTYPE","Spalten anzeigen");
define("_NE_DUAL","Doppelspalte");
define("_NE_HOMENUMBER","Artikel auf Startseite");
define("_NE_HOMENUMNOTE","Das &uuml;berschreibt die Benutzereinstellungen<br />\n wenn nicht auf Nuke Default gesetzt");
define("_NE_HOMETOPIC","Thema auf Startseite");
define("_NE_MODERATE","Bewertungen best&auml;tigen");
define("_NE_NEWSCONFIG","Artikel Konfiguration");
define("_NE_NO","Nein");
define("_NE_NONE_NEWS","Es sind keine Nachrichten vorhanden");
define("_NE_NOTIFYAUTH","Autor benachrichtigen");
define("_NE_NOTIFYAUTHNOTE","Dies sendet eine eMail an den Verfasser<br />\n zur Ansicht");
define("_NE_NO_EMPTY_COMMENT","Entweder ist das Feld 'Betreff' oder das Feld 'Kommentar' leer. Das ist nicht erlaubt.<br />"._GOBACK);
define("_NE_NUKEDEFAULT","Nuke Default");
define("_NE_OF","von");
define("_NE_PAGE","Seite");
define("_NE_PAGES","Seiten");
define("_NE_POPUP","Popup");
define("_NE_READLINK","Link: lies weiter");
define("_NE_SAVECHANGES","&Auml;nderungen speichern");
define("_NE_SELECT","Seite ausw&auml;hlen");
define("_NE_SINGLE","Einzelspalte");
define("_NE_TEXTTYPE","Artikell&auml;nge");
define("_NE_TRUNCATE","auf 255 Zeichen k&uuml;rzen");
define("_NE_WEBSITE","Webseite");
define("_NE_YES","Ja");
/*****[END]********************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/

?>