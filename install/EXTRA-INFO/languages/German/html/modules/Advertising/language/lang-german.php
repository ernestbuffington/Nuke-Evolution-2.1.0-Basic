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

global $module_name;
$lang_new[$module_name]['_ACTIVATE'] = 'Aktivieren';
$lang_new[$module_name]['_ACTIVE'] = 'Aktiv';
$lang_new[$module_name]['_ACTIVEADSFOR'] = 'Zur Zeit aktive Banner f&uuml;r';
$lang_new[$module_name]['_ACTIVEBANNERS'] = 'Zur Zeit aktive Banner';
$lang_new[$module_name]['_ACTIVEBANNERS2'] = 'Aktive Banner';
$lang_new[$module_name]['_ADCLASS'] = 'Banner Klasse';
$lang_new[$module_name]['_ADCODE'] = 'Javascript/HTML Code';
$lang_new[$module_name]['_ADDADVERTISINGPLAN'] = 'Werbeangebot hinzuf&uuml;gen';
$lang_new[$module_name]['_ADDBANNER'] = 'Banner hinzuf&uuml;gen';
$lang_new[$module_name]['_ADDCLIENT'] = 'Neuen Kunden hinzuf&uuml;gen';
$lang_new[$module_name]['_ADDCLIENT2'] = 'Kunden hinzuf&uuml;gen';
$lang_new[$module_name]['_ADDEDDATE'] = 'Datum hinzugef&uuml;gt';
$lang_new[$module_name]['_ADDIMPRESSIONS'] = 'Weitere Einblendungen hinzuf&uuml;gen';
$lang_new[$module_name]['_ADDNEWBANNER'] = 'Neuen Banner hinzuf&uuml;gen';
$lang_new[$module_name]['_ADDNEWPLAN'] = 'Neues Angebot hinzuf&uuml;gen';
$lang_new[$module_name]['_ADDNEWPOSITION'] = 'Bannerpositionen hinzuf&uuml;gen';
$lang_new[$module_name]['_ADDPLANERROR'] = '<strong>Fehler:</strong> Eines oder mehrere Felder sind leer. Bitte gehe zur&uuml;ck und behebe das Problem.';
$lang_new[$module_name]['_ADDPOSITION'] = 'Position hinzuf&uuml;gen';
$lang_new[$module_name]['_ADFLASH'] = 'Flash';
$lang_new[$module_name]['_ADSGFX_FAILURE'] = 'Bitte den richtigen Sicherheitscode eingeben.';
$lang_new[$module_name]['_ADIMAGE'] = 'Bild';
$lang_new[$module_name]['_ADINFOINCOMPLETE'] = '<strong>Fehler:</strong> Banner Information ist nicht komplett!';
$lang_new[$module_name]['_ADISNTYOURS'] = '<strong>Fehler:</strong> Der Banner den Du Dir gerade versuchst anzeigen zu lassen, ist keinem Konto zugeteilt.';
$lang_new[$module_name]['_ADPOSITIONS'] = 'Position hinzuf&uuml;gen';
$lang_new[$module_name]['_ADSMENU'] = 'Werbemen&uuml;';
$lang_new[$module_name]['_ADSMODULEINACTIVE'] = '[ Warnung: Werbemodul (advertising module) ist inaktiv! ]';
$lang_new[$module_name]['_ADSNOCLIENT'] = '<strong>Fehler:</strong> Es gibt keinen Werbekunden.<br />Bitte erstelle einen neuen Kunden bevor Du Banner hinzuf&uuml;gst.';
$lang_new[$module_name]['_ADSNOCONTENT'] = 'Entschuldigung, zur Zeit haben wir keine weitere Werbung in Planung.';
$lang_new[$module_name]['_ADSYSTEM'] = 'Werbesystem';
$lang_new[$module_name]['_ADVERTISING'] = 'Werbung';
$lang_new[$module_name]['_ADVERTISINGPLANS'] = 'Werbeangebote';
$lang_new[$module_name]['_ADVERTISINGCLIENTS'] = 'Werbekunden';
$lang_new[$module_name]['_ADVERTISINGPLANEDIT'] = 'Werbeangebot bearbeiten';
$lang_new[$module_name]['_ALTTEXT'] = 'Alternativer Text';
$lang_new[$module_name]['_ASSIGNEDADS'] = 'Zugewiesene Banner';
$lang_new[$module_name]['_BACK'] = 'Zur&uuml;ck';
$lang_new[$module_name]['_BANNERID'] = 'Banner ID';
$lang_new[$module_name]['_BANNERIMAGE'] = 'Banner Bild';
$lang_new[$module_name]['_BANNERNAME'] = 'Banner Name';
$lang_new[$module_name]['_BANNERS'] = 'Banner';
$lang_new[$module_name]['_BANNERS_ADMIN_HEADER'] = 'Banner :: Modul-Administration';
$lang_new[$module_name]['_BANNERS_RETURNMAIN'] = 'Zur&uuml;ck zur Hauptadministration';
$lang_new[$module_name]['_BANNERSADMIN'] = 'Banner Administration';
$lang_new[$module_name]['_BANNERURL'] = 'Banner URL';
$lang_new[$module_name]['_BUYLINKS'] = 'Kaufe Links';
$lang_new[$module_name]['_CANTDELETEPOSITION'] = '<strong>Fehler:</strong> Du kannst nicht ALLE Positionen l&ouml;schen. Wenigstens eines sollte in der Datenbank vorhanden sein.<br />Bearbeite die Position, wenn Du &Auml;nderungen machen musst oder f&uuml;ge eine neue hinzu.';
$lang_new[$module_name]['_CLASS'] = 'Klasse';
$lang_new[$module_name]['_CLASSNOTE'] = 'Wenn Dein Banner Klasse Javascript/HTML Code ist, werden die n&auml;chsten 4 Felder ignoriert und es z&auml;hlt nur der untere Code Bereich. Wenn Dein Banner Klasse Flash ist, dann musst Du die komplette URL mit .SWF in das n&auml;chste Feld einsetzen und die Breite und H&ouml;he des Flash Movie. (URL anklicken und Alternativer Text werden ignoriert).';
$lang_new[$module_name]['_CLICKS'] = 'Klicks';
$lang_new[$module_name]['_CLICKSPERCENT'] = 'Klicks Prozent';
$lang_new[$module_name]['_CLICKURL'] = 'Seiten URL';
$lang_new[$module_name]['_CLIENT'] = 'Kunde';
$lang_new[$module_name]['_CLIENTLOGIN'] = 'Kunden Login';
$lang_new[$module_name]['_CLIENTNAME'] = 'Kunden Name';
$lang_new[$module_name]['_CLIENTPASSWD'] = 'Kunden Kennwort';
$lang_new[$module_name]['_CLIENTWITHOUTBANNERS'] = 'Der Kunde hat momentan keine Banner laufen.';
$lang_new[$module_name]['_CONTACTEMAIL'] = 'eMail Ansprechpartner';
$lang_new[$module_name]['_CONTACTNAME'] = 'Name Ansprechpartner';
$lang_new[$module_name]['_COUNTRYNAME'] = 'Dein Land';
$lang_new[$module_name]['_CURREGUSERS'] = 'Zur Zeit registrierte Mitglieder:';
$lang_new[$module_name]['_CURRENTPOSITIONS'] = 'Derzeitige Banner Positionen';
$lang_new[$module_name]['_CURRENTSTATUS'] = 'Derzeitiger Status:';
$lang_new[$module_name]['_DAYS'] = 'Tage';
$lang_new[$module_name]['_DEACTIVATE'] = 'Deaktivieren';
$lang_new[$module_name]['_DELCLIENTHASBANNERS'] = 'Dieser Kunde hat die folgenden <b>aktiven Banner</b> laufen';
$lang_new[$module_name]['_DELETE'] = 'L&ouml;schen';
$lang_new[$module_name]['_DELETEALLADS'] = 'Alle Banner l&ouml;schen';
$lang_new[$module_name]['_DELETEBANNER'] = 'Banner l&ouml;schen';
$lang_new[$module_name]['_DELETECLIENT'] = 'Werbekunden l&ouml;schen';
$lang_new[$module_name]['_DELETEPLAN'] = 'Werbeangebot l&ouml;schen';
$lang_new[$module_name]['_DELETEPOSITION'] = 'Bannerposition l&ouml;schen';
$lang_new[$module_name]['_DELIVERY'] = 'Zustellungs Modus';
$lang_new[$module_name]['_DELIVERYQUANTITY'] = 'Zustellungs Menge';
$lang_new[$module_name]['_DELIVERYTYPE'] = 'Zustellungs Modus';
$lang_new[$module_name]['_DESCRIPTION'] = 'Beschreibung';
$lang_new[$module_name]['_EDIT'] = 'Bearbeiten';
$lang_new[$module_name]['_EDITCLIENT'] = 'Werbekunden &auml;ndern';
$lang_new[$module_name]['_EDITBANNER'] = 'Banner &auml;ndern';
$lang_new[$module_name]['_EDITPOSITION'] = 'Bannerposition bearbeiten';
$lang_new[$module_name]['_EDITTERMS'] = 'Verkaufsbedingungen bearbeiten';
$lang_new[$module_name]['_EMAILSTATS'] = 'eMail Statistiken';
$lang_new[$module_name]['_ENTER'] = 'Enter';
$lang_new[$module_name]['_EXTRAINFO'] = 'Weitere Infos';
$lang_new[$module_name]['_FLASHFILEURL'] = 'Flash Datei URL';
$lang_new[$module_name]['_FLASHMOVIE'] = 'Flash Film';
$lang_new[$module_name]['_FLASHSIZE'] = 'Flash Movie Gr&ouml;sse';
$lang_new[$module_name]['_FOLLOWINGSTATS'] = 'Die nachfolgende komplette Statistik Deiner Werbeausgaben an';
$lang_new[$module_name]['_FUNCTIONS'] = 'Funktionen';
$lang_new[$module_name]['_FUNCTIONNOTALLOWED'] = '<strong>Fehler:</strong> Die ausgew&auml;hlte Funktion ist nicht erlaubt.';
$lang_new[$module_name]['_GENERALSTATS'] = 'Allgemeine Statistiken';
$lang_new[$module_name]['_GENERATEDON'] = 'Bericht erzeugt f&uuml;r';
$lang_new[$module_name]['_GOOGLERANK'] = 'Diese Seite hat den Google-Rank:';
$lang_new[$module_name]['_GOBACK'] = '[ <a href="javascript:history.go(-1)">zur&uuml;ck</a> ]';
$lang_new[$module_name]['_HEIGHT'] = 'H&ouml;he';
$lang_new[$module_name]['_HEREARENUMBERS'] = 'Hier sind einige Zahlenstatistiken &uuml;ber unsere Seite, die Du interessant finden k&ouml;nntest, bevor Du mit der Einstellung Deiner Werbung fortf&auml;hrst:';
$lang_new[$module_name]['_IMAGESIZE'] = 'Bild Gr&ouml;sse';
$lang_new[$module_name]['_IMAGESWFURL'] = 'Bild URL';
$lang_new[$module_name]['_IMPLEFT'] = 'Einblendungen &uuml;brig/offen';
$lang_new[$module_name]['_IMPMADE'] = 'Bisher gez&auml;hlte Einblendungen';
$lang_new[$module_name]['_IMPPURCHASED'] = 'gekaufte Einblendungen';
$lang_new[$module_name]['_IMPRELEFT'] = '&uuml;brige/offene Einblendungen';
$lang_new[$module_name]['_IMPREMADE'] = 'gemachte Einblendungen';
$lang_new[$module_name]['_IMPRESSIONS'] = 'Einblendungen';
$lang_new[$module_name]['_IMPTOTAL'] = 'Einblendungen gesamt';
$lang_new[$module_name]['_INACTIVE'] = 'Inaktiv';
$lang_new[$module_name]['_INACTIVEADS'] = 'Zur Zeit inaktive Banner f&uuml;r';
$lang_new[$module_name]['_INACTIVEBANNERS'] = 'Inaktive Banner';
$lang_new[$module_name]['_INITIALSTATUS'] = 'Initial Status';
$lang_new[$module_name]['_INPIXELS'] = '(Gr&ouml;sse in Pixel)';
$lang_new[$module_name]['_LISTPLANS'] = 'Die folgende Liste zeigt unsere Werbepl&auml;ne, Preise und eine direkte Verbindung, um Deine Kleinanzeigen zu kaufen:';
$lang_new[$module_name]['_LOGIN'] = 'Kunden-Loginname';
$lang_new[$module_name]['_LOGININCORRECT'] = 'Anmeldung fehlgeschlagen!!!';
$lang_new[$module_name]['_MADE'] = 'Erfolgte';
$lang_new[$module_name]['_MAINPAGE'] = 'Hauptseite';
$lang_new[$module_name]['_MONTHS'] = 'Monate';
$lang_new[$module_name]['_MOVEADS'] = 'Verschiebe Banner nach';
$lang_new[$module_name]['_MOVEDADSSTATUS'] = 'Neuer Status f&uuml;r verschobene Banner';
$lang_new[$module_name]['_MYADS'] = 'Meine Kleinanzeigen';
$lang_new[$module_name]['_NA'] = 'N/A';
$lang_new[$module_name]['_NAME'] = 'Name';
$lang_new[$module_name]['_NO'] = 'Nein';
$lang_new[$module_name]['_NOCONTENT'] = 'Hier ist zur Zeit noch kein Inhalt verf&uuml;gbar';
$lang_new[$module_name]['_NOCHANGES'] = 'Keine &Auml;nderungen';
$lang_new[$module_name]['_NONE'] = 'Keine';
$lang_new[$module_name]['_NOTE'] = 'Hinweis:';
$lang_new[$module_name]['_PASSWORD'] = 'Passwort';
$lang_new[$module_name]['_PDAYS'] = 'Tage';
$lang_new[$module_name]['_PIDERROR'] = 'Das Angebot konnte nicht gefunden werden';
$lang_new[$module_name]['_PLANNAME'] = 'Name des Angebots';
$lang_new[$module_name]['_PIDERROR'] = 'Das Angebot konnte nicht gefunden werden';
$lang_new[$module_name]['_PLANSPRICES'] = 'Angebote &amp; Preise';
$lang_new[$module_name]['_PLANDESCRIPTION'] = 'Angebot Beschreibung';
$lang_new[$module_name]['_PLANBUYLINKS'] = 'Link zum Bezahlen<br /><br />Gib hier bitte den Link ein,<br /> der zu einem Bezahlsystem f&uuml;hrt <br />damit Dein Kunde die bestellte Leistung <br />bezahlen kann';
$lang_new[$module_name]['_PLANSNOTE'] = 'Angebote sind nur f&uuml;r Empfehlungen und werden im Werbemodul ver&ouml;ffentlicht, damit Deine Kunden wissen, was Du anzubieten hast, Konditionen, Preise einen Link f&uuml;r die Bezahlung Deines Service.';
$lang_new[$module_name]['_PMONTHS'] = 'Monate';
$lang_new[$module_name]['_POSEXAMPLE'] = 'Du kannst dir die Datei <i>/blocks/block-Advertising.php</i> anschauen und die Datei <i>/header.php</i> um ein gutes Beispiel zu haben, wie dies in Deine Seite eingebunden wird.';
$lang_new[$module_name]['_POSINFOINCOMPLETE'] = '<strong>Fehler:</strong> Bannerposition Feldname kann nicht leer sein.';
$lang_new[$module_name]['_POSITION'] = 'Position';
$lang_new[$module_name]['_POSITIONHASADS'] = 'Die gew&auml;hlte Bannerposition die Du l&ouml;schen willst, enth&auml;lt zugewiesene Banner.<br />Bitte w&auml;hle eine neue Position um alle Banner zu verschieben.';
$lang_new[$module_name]['_POSITIONNAME'] = 'Position Name';
$lang_new[$module_name]['_POSITIONNOTE'] = 'Du musst den folgenden Code in Deine Theme Datei einf&uuml;gen, um die Positionen verwenden zu k&ouml;nnen: <i> ads(position);</i> - "position" gibt die Anzahl der Positionen an, die Du in Deinem Bannerfeld verwenden kannst.';
$lang_new[$module_name]['_POSITIONNUMBER'] = 'Position Zahl';
$lang_new[$module_name]['_PRICE'] = 'Preis';
$lang_new[$module_name]['_PURCHASED'] = 'Gekauft';
$lang_new[$module_name]['_PURCHASEDIMPRESSIONS'] = 'Gekaufte Einblendungen';
$lang_new[$module_name]['_PYEARS'] = 'Jahre';
$lang_new[$module_name]['_QUANTITY'] = 'Menge';
$lang_new[$module_name]['_RECEIVEDCLICKS'] = 'Empfangende Klicks';
$lang_new[$module_name]['_SAVECHANGES'] = '&Auml;nderungen speichern';
$lang_new[$module_name]['_SAVEPOSITION'] = '&Auml;nderungen speichern';
$lang_new[$module_name]['_SITENAMEADS'] = '(Um Deinen Seiten Name in den Text einzubetten, verwende [sitename] und um Dein L&auml;ndername zu verwenden schreibe [country] in den Text und es wird dementsprechend im Werbemodul ersetzt)';
$lang_new[$module_name]['_SITESTATS'] = 'Seiten Statistik';
$lang_new[$module_name]['_STATSNOTSEND'] = 'Die Statistiken f&uuml;r den ausgew&auml;hlten Banner k&ouml;nnen nicht gesendet werden, weil<br />es mit keiner eMail verbunden ist.<br />Bitte kontaktiere den Administrator';
$lang_new[$module_name]['_STATSSENT'] = 'Die Statistiken f&uuml;r Deine Banner wurden per eMail gesendet an:';
$lang_new[$module_name]['_STATUS'] = 'Status';
$lang_new[$module_name]['_SURETODELBANNER'] = 'Willst Du diesen Banner wirklich l&ouml;schen?';
$lang_new[$module_name]['_SURETODELCLIENT'] = 'Du bist dabei den Kunden mit seinen Bannern zu l&ouml;schen!!!';
$lang_new[$module_name]['_SURETODELPOSITION'] = 'Du bist dabei, eine Bannerposition zu l&ouml;schen. Bist Du sicher, dass Du fortfahren willst?';
$lang_new[$module_name]['_SURETODELPLAN'] = 'Du bist dabei das Werbeangebot zu l&ouml;schen. Bist Du sicher, dass Du fortfahren willst?';
$lang_new[$module_name]['_TERMSNOTE'] = 'Schaue die Standard Bedingungen sorgf&auml;ltig durch. &Auml;ndere was immer Du &auml;ndern willst entsprechend Deiner Werbestrategie. Dies wird im Werbemodul (advertising module) ver&ouml;ffentlicht.';
$lang_new[$module_name]['_TERMS'] = 'Bedingungen';
$lang_new[$module_name]['_TERMSCONDITIONS'] = 'Begriffe und Bedingungen';
$lang_new[$module_name]['_TERMSOFSERVICEBODY'] = 'Verkaufsbedingungen Body';
$lang_new[$module_name]['_TOTALVIEWS'] = 'Alle bisherigen Seitenaufrufe:';
$lang_new[$module_name]['_TYPE'] = 'Type';
$lang_new[$module_name]['_UNLIMITED'] = 'unbeschr&auml;nkt';
$lang_new[$module_name]['_VIEWBANNER'] = 'Zeige Banner';
$lang_new[$module_name]['_VIEWSDAY'] = 'Durschnittliche Seitenaufrufe am Tag';
$lang_new[$module_name]['_VIEWSHOUR'] = 'Durschnittliche Seitenaufrufe die Stunde';
$lang_new[$module_name]['_VIEWSMONTH'] = 'Durschnittliche Seitenaufrufe im Monat:';
$lang_new[$module_name]['_VIEWSYEAR'] = 'Durschnittliche Seitenaufrufe im Jahr';
$lang_new[$module_name]['_WELCOMEADS'] = '<strong>Willkommen in unserer Werbeabteilung!</strong><br /><br />Wenn Du Deine Banner hier einf&uuml;gen m&ouml;chtest, dann m&ouml;chtest Du vielleicht noch einige Details, bzw. einiges &uuml;ber unsere Ziele und geplanten Werbungen wissen.<br /><br />Wenn Du bereits Werbekunde bei uns bist, dann melde Dich bitte <strong><a href="modules.php?name=Advertising&amp;op=client">hier</a></strong> an.<br />';
$lang_new[$module_name]['_WIDTH'] = 'Breite';
$lang_new[$module_name]['_XFORUNLIMITED'] = 'schreibe X f&uuml;r unlimitiert';
$lang_new[$module_name]['_YEARS'] = 'Jahre';
$lang_new[$module_name]['_YES'] = 'Ja';
$lang_new[$module_name]['_YOURBANNER'] = 'Dein Banner';
$lang_new[$module_name]['_YOURSTATS'] = 'Deine Bannerstatistik an';

?>