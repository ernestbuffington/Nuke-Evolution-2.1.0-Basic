<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       Basic
 Nuke-Evo Version       :       2.1.0
 Nuke-Evo Build         :       1740
 Nuke-Evo Patch         :       0
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       10-Aug-2010 23:10

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
$lang_new[$module_name]['_ACTIVATE'] = 'Activeren';
$lang_new[$module_name]['_ACTIVE'] = 'Actief';
$lang_new[$module_name]['_ACTIVEADSFOR'] = 'Op dit moment banners actief voor';
$lang_new[$module_name]['_ACTIVEBANNERS'] = 'Actieve banners op dit moment';
$lang_new[$module_name]['_ACTIVEBANNERS2'] = 'Actieve banner';
$lang_new[$module_name]['_ADCLASS'] = 'Banner Klasse';
$lang_new[$module_name]['_ADCODE'] = 'Javascript/HTML Code';
$lang_new[$module_name]['_ADDADVERTISINGPLAN'] = 'Aanbieding toevoegen';
$lang_new[$module_name]['_ADDBANNER'] = 'Banner toevoegen';
$lang_new[$module_name]['_ADDCLIENT'] = 'Nieuwe klanten toevoegen';
$lang_new[$module_name]['_ADDCLIENT2'] = 'Klanten toevoegen';
$lang_new[$module_name]['_ADDEDDATE'] = 'Datum toegevoegd';
$lang_new[$module_name]['_ADDIMPRESSIONS'] = 'Verdere impressie toevoegen';
$lang_new[$module_name]['_ADDNEWBANNER'] = 'Nieuwe banner toevoegen';
$lang_new[$module_name]['_ADDNEWPLAN'] = 'Nieuwe aanbieding toevoegen';
$lang_new[$module_name]['_ADDNEWPOSITION'] = 'Bannerposities toevoegen';
$lang_new[$module_name]['_ADDPLANERROR'] = '<strong>Fout:</strong> Een of meerdere velden zijn leeg, ga terug en corrigeer dit.';
$lang_new[$module_name]['_ADDPOSITION'] = 'Positie toevoegen';
$lang_new[$module_name]['_ADFLASH'] = 'Flash';
$lang_new[$module_name]['_ADSGFX_FAILURE'] = 'De goede veiligheidscode invoeren AUB.';
$lang_new[$module_name]['_ADIMAGE'] = 'Afbeelding';
$lang_new[$module_name]['_ADINFOINCOMPLETE'] = '<strong>Fout:</strong> Banner informatie is niet compleet';
$lang_new[$module_name]['_ADISNTYOURS'] = '<strong>Fout:</strong> De banner die u probeerd weer te geven is uw geen account toegewezen.';
$lang_new[$module_name]['_ADPOSITIONS'] = 'Positie toevoegen';
$lang_new[$module_name]['_ADSMENU'] = 'Adverteer menu';
$lang_new[$module_name]['_ADSMODULEINACTIVE'] = '[ Waarschuwing: Adverteer module (advertising module) is niet actief! ]';
$lang_new[$module_name]['_ADSNOCLIENT'] = '<strong>Fout:</strong> Er zijn geen klanten.<br />Voeg eerst een klant toe voordat u een banner toevoegd';
$lang_new[$module_name]['_ADSNOCONTENT'] = 'Sorry, op dit moment hebben we geen verdere adverteer plannen.';
$lang_new[$module_name]['_ADSYSTEM'] = 'Adverteer system';
$lang_new[$module_name]['_ADVERTISING'] = 'Advertentie';
$lang_new[$module_name]['_ADVERTISINGPLANS'] = 'Adverteer aanbieding';
$lang_new[$module_name]['_ADVERTISINGCLIENTS'] = 'Klanten';
$lang_new[$module_name]['_ADVERTISINGPLANEDIT'] = 'Aanbieding bewerken';
$lang_new[$module_name]['_ALTTEXT'] = 'Alternatieve tekst';
$lang_new[$module_name]['_ASSIGNEDADS'] = 'Toegewezen banner';
$lang_new[$module_name]['_BACK'] = 'Terug';
$lang_new[$module_name]['_BANNERID'] = 'Banner ID';
$lang_new[$module_name]['_BANNERIMAGE'] = 'Afbeelding banner';
$lang_new[$module_name]['_BANNERNAME'] = 'Naam banner';
$lang_new[$module_name]['_BANNERS'] = 'Banner';
$lang_new[$module_name]['_BANNERS_ADMIN_HEADER'] = 'Nuke-Evolution Banner :: Module-Administratie';
$lang_new[$module_name]['_BANNERS_RETURNMAIN'] = 'Terug naar hoofdadministratie';
$lang_new[$module_name]['_BANNERSADMIN'] = 'Banner Administratie';
$lang_new[$module_name]['_BANNERURL'] = 'Banner URL';
$lang_new[$module_name]['_BUYLINKS'] = 'Links kopen';
$lang_new[$module_name]['_CANTDELETEPOSITION'] = '<strong>Fout:</strong> U kunt niet alle posities wissen, er dient er tenminste een in de database aanwezig te zijn.<br />Bewerkt deze positie als u aanpassingen moet maken of voeg een nieuwe toe.';
$lang_new[$module_name]['_CLASS'] = 'Klasse';
$lang_new[$module_name]['_CLASSNOTE'] = 'Als uw banner Klasse Javascript/HTML Code is, worden de volgende 4 velden negeerd en geld alleen het onderste code bereik. Als uw banner Klasse Flash is, dan moet de complete URL met .SWF in het volgende ingevoerd worden met de hoogte en breedte van de Flash Movie. (URL aanklikken en de alternatieve tekst word genegeerd).';
$lang_new[$module_name]['_CLICKS'] = 'Kliks';
$lang_new[$module_name]['_CLICKSPERCENT'] = 'Kliks in procenten';
$lang_new[$module_name]['_CLICKURL'] = 'Pagina URL';
$lang_new[$module_name]['_CLIENT'] = 'Klant';
$lang_new[$module_name]['_CLIENTLOGIN'] = 'Inlog klanten';
$lang_new[$module_name]['_CLIENTNAME'] = 'Naam klant';
$lang_new[$module_name]['_CLIENTPASSWD'] = 'Wachtwoord klant';
$lang_new[$module_name]['_CLIENTWITHOUTBANNERS'] = 'De klant heeft momenteel geen banner.';
$lang_new[$module_name]['_CONTACTEMAIL'] = 'E-Mail contactpersoon';
$lang_new[$module_name]['_CONTACTNAME'] = 'Naam contactpersoon';
$lang_new[$module_name]['_COUNTRYNAME'] = 'Uw land';
$lang_new[$module_name]['_CURREGUSERS'] = 'Op dit moment geregistreerde leden:';
$lang_new[$module_name]['_CURRENTPOSITIONS'] = 'Banner Posities';
$lang_new[$module_name]['_CURRENTSTATUS'] = 'Status:';
$lang_new[$module_name]['_DAYS'] = 'Dagen';
$lang_new[$module_name]['_DEACTIVATE'] = 'Deactiveren';
$lang_new[$module_name]['_DELCLIENTHASBANNERS'] = 'Deze klant heeft de volgende  <b>actieve banners</b> lopen';
$lang_new[$module_name]['_DELETE'] = 'Verwijderen';
$lang_new[$module_name]['_DELETEALLADS'] = 'Alle banners verwijderen';
$lang_new[$module_name]['_DELETEBANNER'] = 'Banner verwijderen';
$lang_new[$module_name]['_DELETECLIENT'] = 'Klanten verwijderen';
$lang_new[$module_name]['_DELETEPLAN'] = 'Aanbieding verwijderen';
$lang_new[$module_name]['_DELETEPOSITION'] = 'Bannerpositie verwijderen';
$lang_new[$module_name]['_DELIVERY'] = 'Weergeve modus';
$lang_new[$module_name]['_DELIVERYQUANTITY'] = 'Aantal weergaves';
$lang_new[$module_name]['_DELIVERYTYPE'] = 'Type weergave';
$lang_new[$module_name]['_DESCRIPTION'] = 'Omschrijving';
$lang_new[$module_name]['_EDIT'] = 'Bewerken';
$lang_new[$module_name]['_EDITCLIENT'] = 'Klanten bewerken';
$lang_new[$module_name]['_EDITBANNER'] = 'Banner bewerken';
$lang_new[$module_name]['_EDITPOSITION'] = 'Banner posities bewerken';
$lang_new[$module_name]['_EDITTERMS'] = 'Overeenkomst bewerken';
$lang_new[$module_name]['_EMAILSTATS'] = 'E-Mail statistieken';
$lang_new[$module_name]['_ENTER'] = 'Enter';
$lang_new[$module_name]['_EXTRAINFO'] = 'Verdere informatie';
$lang_new[$module_name]['_FLASHFILEURL'] = 'URL Flash bestand';
$lang_new[$module_name]['_FLASHMOVIE'] = 'Flash Film';
$lang_new[$module_name]['_FLASHSIZE'] = 'Grootte Flash Movie';
$lang_new[$module_name]['_FOLLOWINGSTATS'] = 'De volgende volledige statistieken van uw advertentie-uitgaven voor';
$lang_new[$module_name]['_FUNCTIONS'] = 'Functies';
$lang_new[$module_name]['_FUNCTIONNOTALLOWED'] = '<strong>Fout:</strong> De gekozen functie is niet toegestaan.';
$lang_new[$module_name]['_GENERALSTATS'] = 'Algemene statistieken';
$lang_new[$module_name]['_GENERATEDON'] = 'Bericht opgesteld voor';
$lang_new[$module_name]['_GOOGLERANK'] = 'Dese site heeft de Google-Rank:';
$lang_new[$module_name]['_GOBACK'] = '[ <a href="javascript:history.go(-1)">terug</a> ]';
$lang_new[$module_name]['_HEIGHT'] = 'Hoogte';
$lang_new[$module_name]['_HEREARENUMBERS'] = 'Voordat u verder gaat zijn hier enige statistieken over onze site die u misschien interresant kunt vinden:';
$lang_new[$module_name]['_IMAGESIZE'] = 'Grootte afbeelding';
$lang_new[$module_name]['_IMAGESWFURL'] = 'URL afbeelding';
$lang_new[$module_name]['_IMPLEFT'] = 'Advertentie links';
$lang_new[$module_name]['_IMPMADE'] = 'Reeds geplaatste advertenties ';
$lang_new[$module_name]['_IMPPURCHASED'] = 'Gekochte advertenties';
$lang_new[$module_name]['_IMPRELEFT'] = 'Overinge advertenties';
$lang_new[$module_name]['_IMPREMADE'] = 'gemaakte advertenties';
$lang_new[$module_name]['_IMPRESSIONS'] = 'Advertenties';
$lang_new[$module_name]['_IMPTOTAL'] = 'Totale advertenties';
$lang_new[$module_name]['_INACTIVE'] = 'Inactief';
$lang_new[$module_name]['_INACTIVEADS'] = 'Op dit moment is er geen banner voor';
$lang_new[$module_name]['_INACTIVEBANNERS'] = 'Inactieve banner';
$lang_new[$module_name]['_INITIALSTATUS'] = 'Initial Status';
$lang_new[$module_name]['_INPIXELS'] = '(Grootte in pixels)';
$lang_new[$module_name]['_LISTPLANS'] = 'De volgende lijst toont onze advertentie-planner, prijzen en een directe link naar uw advertenties te kopen:';
$lang_new[$module_name]['_LOGIN'] = 'Klanten login';
$lang_new[$module_name]['_LOGININCORRECT'] = 'Aanmelden mislukt!!!';
$lang_new[$module_name]['_MADE'] = 'gemaakt';
$lang_new[$module_name]['_MAINPAGE'] = 'Hoofdpagina';
$lang_new[$module_name]['_MONTHS'] = 'Maanden';
$lang_new[$module_name]['_MOVEADS'] = 'Verplaats bannernaar';
$lang_new[$module_name]['_MOVEDADSSTATUS'] = 'Nieuwe stats voor verplaatste banner';
$lang_new[$module_name]['_MYADS'] = 'Mijn advertenties';
$lang_new[$module_name]['_NA'] = 'N/A';
$lang_new[$module_name]['_NAME'] = 'Naam';
$lang_new[$module_name]['_NO'] = 'Nee';
$lang_new[$module_name]['_NOCONTENT'] = 'Inhoud op dit moment niet beschikbaar';
$lang_new[$module_name]['_NOCHANGES'] = 'Onveranderd';
$lang_new[$module_name]['_NONE'] = 'Geen';
$lang_new[$module_name]['_PASSWORD'] = 'Wachtwoord';
$lang_new[$module_name]['_PDAYS'] = 'Dagen';
$lang_new[$module_name]['_PLANNAME'] = 'Aanbieding';
$lang_new[$module_name]['_PLANSPRICES'] = 'Aanbieding en prijzen';
$lang_new[$module_name]['_PLANDESCRIPTION'] = 'Omschrijving aanbieding';
$lang_new[$module_name]['_PLANBUYLINKS'] = 'Link om te betalen<br /><br />Geef hier deze link op,<br /> die naar uw betalingssysteem gaat <br />zodat de klant de bestelde servive <br />kan betalen';
$lang_new[$module_name]['_PLANSNOTE'] = 'Aanbiedingen zijn slechts aanbevelingen en zijn gepubliceerd in de advertentie-module, zodat de klanten weten wat u aan te bieden heeft, condities, prijs van een link en de bataling hier van.';
$lang_new[$module_name]['_PMONTHS'] = 'Maanden';
$lang_new[$module_name]['_POSEXAMPLE'] = 'U kunt het bestand <i>/blocks/block-Advertising.php</i> bekijken en het bestand <i>/header.php</i> om een goed voorbeeld te krijgen hoe deze in uw site ingebouwd kan worden.';
$lang_new[$module_name]['_POSINFOINCOMPLETE'] = '<strong>Fout:</strong> Veld bannerpositie mag niet leeg zijn.';
$lang_new[$module_name]['_POSITION'] = 'Positie';
$lang_new[$module_name]['_POSITIONHASADS'] = 'De gekozen bannerpositie die u wilt verwijderen bevat een banner.<br />Kies AUB een nieuwe positie om alle banners te verplaatsen.';
$lang_new[$module_name]['_POSITIONNAME'] = 'Positie naam';
$lang_new[$module_name]['_POSITIONNOTE'] = 'U dient de volgende code in uw thema bestand in te voegen om de posite te kunnen gebruiken: <i> ads(position);</i> - \"position\" geeft het aantal posities aan die u in uw veld banner gebruiken kan.';
$lang_new[$module_name]['_POSITIONNUMBER'] = 'Positie aantal';
$lang_new[$module_name]['_PRICE'] = 'Prijs';
$lang_new[$module_name]['_PURCHASED'] = 'Gekocht';
$lang_new[$module_name]['_PURCHASEDIMPRESSIONS'] = 'Gekochte advertenties';
$lang_new[$module_name]['_PYEARS'] = 'Jaren';
$lang_new[$module_name]['_QUANTITY'] = 'Aantal';
$lang_new[$module_name]['_RECEIVEDCLICKS'] = 'Ontvangen kliks';
$lang_new[$module_name]['_SAVECHANGES'] = 'Wijzigingen opslaan';
$lang_new[$module_name]['_SAVEPOSITION'] = 'Wijziging opslaan';
$lang_new[$module_name]['_SITENAMEADS'] = '(Om uw site naam in de tekst toe te voegen gebruikt u [sitename] , om uw land toe te voegen gebruikt u [country] in de tekst, dit vervolgens in de advertentie module gewijzigd)';
$lang_new[$module_name]['_SITESTATS'] = 'Pagina statistieken';
$lang_new[$module_name]['_STATSNOTSEND'] = 'De statistieken voor de geselecteerde banner kon niet worden verzonden, omdat<br />het met geen E-Mailadres verbonden is.<br />Neem contact op met de administrator';
$lang_new[$module_name]['_STATSSENT'] = 'De statistieken voor uw banner zijn per E-Mail verstuurd naar:';
$lang_new[$module_name]['_STATUS'] = 'Status';
$lang_new[$module_name]['_SURETODELBANNER'] = 'Wilt u deze banner werkelijk verwijdern?';
$lang_new[$module_name]['_SURETODELCLIENT'] = 'U staat op het punt een klant met zijn banner te verwijderen!!!';
$lang_new[$module_name]['_SURETODELPOSITION'] = 'U staat op het punt een banner positie te verwijderen. Weet u zeker dat u verder wilt gaan?';
$lang_new[$module_name]['_SURETODELPLAN'] = 'U staat op het punt een aanbieding te verwijderen. Weet u zeker dat u verder wilt gaan?';
$lang_new[$module_name]['_TERMSNOTE'] = 'Lees de voorwaarder zorgvuldig door. Verander wat u veranderen wilt comform uw website stategie. Deze word in de advertentie module (advertising module) weergegeven.';
$lang_new[$module_name]['_TERMS'] = 'Voorwaarden';
$lang_new[$module_name]['_TERMSCONDITIONS'] = 'Begrippen en voorwaarden';
$lang_new[$module_name]['_TERMSOFSERVICEBODY'] = 'Voorwaarden Body';
$lang_new[$module_name]['_TOTALVIEWS'] = 'Alle paginaoproepen tot nu toe:';
$lang_new[$module_name]['_TYPE'] = 'Type';
$lang_new[$module_name]['_UNLIMITED'] = 'Onbegrenst';
$lang_new[$module_name]['_VIEWBANNER'] = 'Banner weergeven';
$lang_new[$module_name]['_VIEWSDAY'] = 'Gemiddelde pagina oproepen per dag';
$lang_new[$module_name]['_VIEWSHOUR'] = 'Gemiddelde pagina oproepen per uur';
$lang_new[$module_name]['_VIEWSMONTH'] = 'Gemiddelde pagina oproepen per maand:';
$lang_new[$module_name]['_VIEWSYEAR'] = 'Gemiddelde pagina oproepen per jaar';
$lang_new[$module_name]['_WELCOMEADS'] = '<strong>Welkom op onze advertentie afdeling!</strong><br /><br />Als u hier een banner wilt toevoegen dan wilt u misschien nog enige datails weten zoals bijv onze doelstellingen en geplande advertenties.<br /><br />Indien u reeds klant bij ons bent kunt u zicht gelijk  <strong><a href=\"modules.php?name=Advertising&amp;op=client\">hier</a></strong> inloggen.<br />';
$lang_new[$module_name]['_WIDTH'] = 'Breedte';
$lang_new[$module_name]['_XFORUNLIMITED'] = 'Vermeld X voor ongelimiteerd';
$lang_new[$module_name]['_YEARS'] = 'Jaar';
$lang_new[$module_name]['_YES'] = 'Ja';
$lang_new[$module_name]['_YOURBANNER'] = 'Uw Banner';
$lang_new[$module_name]['_YOURSTATS'] = 'Uw banner statistiek op';

?>