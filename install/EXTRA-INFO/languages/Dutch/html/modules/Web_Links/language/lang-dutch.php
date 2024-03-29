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

global $module_name, $userinfo, $anonwaitdays, $outsidewaitdays;
$lang_new[$module_name]['MODULE_NAME'] = str_replace ("_", " ", $module_name);
$lang_new[$module_name]['SUBMIT_GOBACK'] = _GOBACK;
$lang_new[$module_name]['ADD_LINK'] = 'Link toevoegen';
$lang_new[$module_name]['ADMIN_ADD_CAT'] = 'Categorie toevoegen';
$lang_new[$module_name]['ADMIN_ADD_LINK'] = 'Link toevoegen';
$lang_new[$module_name]['ADMIN_ADD_SUBCAT'] = 'Subcatergorie toevoegen';
$lang_new[$module_name]['ADMIN_BROKEN_LINK'] = 'Gebroken links bewerken';
$lang_new[$module_name]['ADMIN_CATSUB_VALIDATE'] = 'Subcategorie vrijgeven';
$lang_new[$module_name]['ADMIN_CAT_ATTACHED'] = 'toegevoegd aan deze categorie';
$lang_new[$module_name]['ADMIN_CAT_VALIDATE'] = 'Categorie vrijgeven';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY'] = 'Categorieën controleren';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY_INCLSUB'] = 'Subcategorieën inbegrepen';
$lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] = 'Commentaren wissen';
$lang_new[$module_name]['ADMIN_EDITORIAL_ADD'] = 'Inleiding toevoegen';
$lang_new[$module_name]['ADMIN_EDITORIAL_MODIFY'] = 'Inleiding bewerken';
$lang_new[$module_name]['ADMIN_GO_MAIN'] = 'Terug naar hoofdmenu';
$lang_new[$module_name]['ADMIN_HEADER'] = 'Nuke-Evolution Web Links :: Module-Administratie';
$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'] = 'Voorbeeld afbeelding';
$lang_new[$module_name]['ADMIN_LINK_CHECK'] = 'Links controleren';
$lang_new[$module_name]['ADMIN_LINK_CHECK_ALL'] = 'Alle Links controleren';
$lang_new[$module_name]['ADMIN_LINK_ORIGINAL'] = 'Originale Link';
$lang_new[$module_name]['ADMIN_LINK_PROPOSED'] = 'Voorgestlede Link';
$lang_new[$module_name]['ADMIN_LINK_RATING'] = 'Waardering';
$lang_new[$module_name]['ADMIN_LINK_RATING_AVERAGE'] = 'gemiddelde waardering';
$lang_new[$module_name]['ADMIN_LINK_RATING_TOTAL'] = 'Totale waardering';
$lang_new[$module_name]['ADMIN_LINK_VALIDATE'] = 'Link vrijgeven';
$lang_new[$module_name]['ADMIN_LINK_VALIDATE_WAIT'] = 'Even wachten ..';
$lang_new[$module_name]['ADMIN_LINK_VOTE_GUESTS'] = 'Waardering door gasten';
$lang_new[$module_name]['ADMIN_LINK_VOTE_REGUSER'] = 'Waardering door geregistreerde gebruikers';
$lang_new[$module_name]['ADMIN_LINK_VOTE_TOTAL'] = 'Totale waardering';
$lang_new[$module_name]['ADMIN_LINK_VOTE_UNREG'] = 'Waardering door Administrators';
$lang_new[$module_name]['ADMIN_MODIFY_CAT'] = 'Categorie bewerken';
$lang_new[$module_name]['ADMIN_MODIFY_LINK'] = 'Links bewerken';
$lang_new[$module_name]['ADMIN_MODIFY_LINK_REQUEST'] ='Verzoek tot aanpassing vd link bewerken';
$lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] = 'Module instellingen';
$lang_new[$module_name]['ADMIN_OPTIONS'] = 'Admin Opties:';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_BREAKS_NO'] = 'Hoeveel lege regels tussen de links plaatsen?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_HEIGHT'] = 'Hoogte van het block in Pixels';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_HEIGHT'] = 'Afbeeldingsgrootte: Hoogte';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_SHOW'] = 'Afbeelding weergeven';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_WIDTH'] = 'Afbeeldingsgrootte: Breedte';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_ROWS'] = 'Hoeveel links moeten in het Links-Block weegegeven worden?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL'] = 'Moeten deze in links scrollen ?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_AMOUNT'] = 'Scroll waarde';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_DIRECTION'] = 'Scroll Richting';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_TITLE'] ='Manier van scrollen';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BEHAVIOR'] = 'Verhoudingswijze';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BLOCKS'] = 'Block instellingen';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_VOTING'] = 'Iinstellingen voor waarderingen';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_DETAIL'] = 'In hoeveel decimalen dient de waardering weergegeven worden?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_MAIN'] = 'In hoeveel decimalen dienen anders overal weergegeven worden?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_LINKS_PER_PAGE'] = 'Aantal WebLinks per pagina?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_ADMINLINKS'] = 'Mogen de administrators de mogelijkheid hebben weblinks van hun eigen sites toe te voegen?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_BESTLINKS'] = 'Aantal WebLinks op de pagina van meest populair?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_NEWLINKS'] = 'Aantal WebLinks op de pagina van nieuwste links?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_POPULAR'] = 'Aantal benodigde hits voor een links voordat deze populair word?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_SEARCHLINKS'] = 'Aantal WebLinks die in de zoekresultaten word weergegeven?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNLINKS'] = 'Mogen gasten WebLinks toesturen?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNVOTING'] = 'Mogen gasten Weblinks beoordelen? <br />(Als u dit niet toestaat zijn externe beoordelingen ook niet toegestaan)';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWN_MODREQ'] = 'Mogen gasten wijzigingen aan bestaande links voorstellen?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_GUEST_TO_REGISTERED'] = 'Aantal procenten (xx/100):  Waarderingen van gasten ten opzichte van geregistreerde gebruikers';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_UNREG_TO_REGISTERED'] = 'Aantal procenten (xx/100):  Waarderingen van Administrator1 ten opzichte van geregistreerde gebruikers';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_PERCENT'] = 'Populaire links in procenten weergeven?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_VOTEMIN'] = 'Hoeveel procent of aantal hits moet een Weblink bereiken om deze als populair weer te geven?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_SHOW_FEATURE_BOX'] ='De WebLinks Header op de hoofdpagina weergeven? (functioneerd alleen als de mudule in "Home" geactiveerd is)';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TITLE'] = 'Algemene instellingen';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_PERCENT'] = 'Best beoordeelde Links in procenten weergeven?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_VOTEMIN'] = 'Hoeveel procent of aantal hits moet een Weblink bereiken om als best boordeeld weergegeven te worden?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPVOTE_MIN'] = 'Aantal beoordelingen die een WebLink moet hebben om een TopLink te zijn?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNKNOWN'] = 'Aantal dagen die gasten moeten wachten voordat ze een WebLink beoordelen mogen';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNREGS'] = 'Aantal dagen die Administrators moeten wachten voordat ze WebLink beoordelen mogen';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_HEIGHT'] = 'Afbeeldings grtoote: Hoogte';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_URL'] = 'URL vd Thumbnail-Servers<br />(Voorbeeld: http://www.websitethumbnails.net/view.php?url=)';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_USE'] = 'Dient een Thumbnail-Server voor de weergave van de Link-voorbeelden gebruikt te worden?';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_TITLE'] = 'Afbeeldingverhouding';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_WIDTH'] = 'Afbeelding grootte: Breedte';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR1'] = 'Achtergrondkleur tabel 1';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR2'] = 'Achtergrondkleur tabel 2';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_TITLE'] = 'Tabelverhouding';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_HEIGHT'] = 'Top-Box hoogte in Pixels';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL'] = 'Dienen deze links te scrollen?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_AMOUNT'] = 'Scroll Waarde';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_DIRECTION'] = 'Scroll Richting';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW'] = 'Top-Box weergeven?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW_LINKS'] = 'Hoeveel links dienen er in de Top-Box weergegeven worden?';
$lang_new[$module_name]['ADMIN_SETTING_USE_SECURITYCODE'] = 'Beveiligingcode gebruiken?';
$lang_new[$module_name]['ADMIN_TRANSFER_CAT'] = 'Categorie verplaatsen';
$lang_new[$module_name]['ADMIN_VALIDATE_FAILED'] = 'Vrijgave mislukt';
$lang_new[$module_name]['ADMIN_VALIDATE_OPTIONS'] = 'Opties';
$lang_new[$module_name]['ADMIN_WEBLINKSADMIN'] = 'Weblinks Administratie';
$lang_new[$module_name]['ADMIN_WEBLINKS_STATUS'] = 'Weblinks Status';
$lang_new[$module_name]['AND'] = 'en';
$lang_new[$module_name]['AUTHOR'] = 'Auteur';
$lang_new[$module_name]['BE_PATIENT'] = 'Even geduld AUB ...';
$lang_new[$module_name]['BOX_HEADER_NEW'] = 'Hitlijst van de nieuwe links';
$lang_new[$module_name]['BOX_HEADER_TOP'] = 'Hitlijst van de populairste Links';
$lang_new[$module_name]['BY'] = 'van';
$lang_new[$module_name]['CATEGORIES'] = 'Categorieën';
$lang_new[$module_name]['CATEGORIES'] = 'Categorieën';
$lang_new[$module_name]['CATEGORIESSUB'] = 'Subcategorieën';
$lang_new[$module_name]['CATEGORY'] = 'Categorie';
$lang_new[$module_name]['CATEGORYSUB'] = 'Subcategorie';
$lang_new[$module_name]['COMMENTS'] = 'Commentaar';
$lang_new[$module_name]['COMMENTS_NUMBER'] = 'Aantal Commentaren';
$lang_new[$module_name]['COMMENTS_TOTAL'] = 'Totale commentaren';
$lang_new[$module_name]['DATE'] = 'Datum';
$lang_new[$module_name]['DATE_WRITTEN'] = 'toegevoegd op';
$lang_new[$module_name]['DAYS'] = 'Dagen';
$lang_new[$module_name]['DAYS_30'] = '30 dagen';
$lang_new[$module_name]['DELETE'] = 'Wissen';
$lang_new[$module_name]['DESCRIPTION'] = 'Omschrijving';
$lang_new[$module_name]['DOWN'] = 'Aflopend';
$lang_new[$module_name]['DO_RATE'] = 'Waardering/Commentaar van deze link';
$lang_new[$module_name]['DO_REPORT_BROKEN'] = 'Melden van een gebroken link';
$lang_new[$module_name]['DO_SHOW_COMMENTS'] = 'Commentaren';
$lang_new[$module_name]['DO_SHOW_DETAILS'] = 'Details';
$lang_new[$module_name]['DO_VOTE_THIS_SITE'] = 'Stem op deze site';
$lang_new[$module_name]['EDIT'] = 'Bewerken';
$lang_new[$module_name]['EDITORIAL'] = 'Inleiding';
$lang_new[$module_name]['EDITORIAL_BY'] = 'Inleiding geschreven door';
$lang_new[$module_name]['EMAIL'] = 'E-Mail';
$lang_new[$module_name]['ERROR_CAT_EXISTS'] = 'De categorie of subcategorie die u probeerde toe te voegen bestaat al<br />Ga terug en probeer het opnieuw.';
$lang_new[$module_name]['ERROR_NO_CONFIG'] = 'Er zijn problemen met de database. Er is geen configuratie voor '.$module_name.' gevonden.';
$lang_new[$module_name]['ERROR_NO_DESCRIPTION'] = 'Een omschrijving voor de link is zeer belangrijk <br />Ga terug en probeer het opnieuw';
$lang_new[$module_name]['ERROR_NO_LID'] = 'Wij hebben geen link in onze database gevonden die aan uw opgave voldoet.<br />Ga terug en probeer het opnieuw.';
$lang_new[$module_name]['ERROR_NO_TITLE'] = 'Een titel voor de links is zeer belangrijk <br />Ga terug en probeer het opnieuw';
$lang_new[$module_name]['ERROR_NO_URL'] = 'Een URL voor deze link is zeer belangrijk <br />Ga terug en probeer het opnieuw';
$lang_new[$module_name]['ERROR_SECURITYCODE'] = 'De opgegeven beveiligingcode komt niet overeen. Probeer hetopnieuw.<br />(Misschien dient u de site opnieuw te laden zodra u terug bent gegaan<br />zodat de beveiligingcode vernieuwd word).<br /><br />'.$lang_new[$module_name]['SUBMIT_GOBACK'];
$lang_new[$module_name]['ERROR_URL_EXISTS'] = 'De opgegeven ULS bestaat al in de database <br />Ga terug en corrigeer dit.';
$lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] = 'De URL of de titel van deze link bestaat al in de database <br />Ga terug en corrigeer dit';
$lang_new[$module_name]['HITS'] = 'Hits';
$lang_new[$module_name]['IGNORE'] = 'Negeren';
$lang_new[$module_name]['IMAGE_PIXEL'] = 'in Pixels';
$lang_new[$module_name]['IN'] = 'In';
$lang_new[$module_name]['INDEX_PAGE'] = 'Index Site';
$lang_new[$module_name]['INFO_ALLOW_TO_RATE'] = 'Toestaan dat gebruikers uw site mogen waarderen!';
$lang_new[$module_name]['INFO_DELETE'] = 'Verwijderen (Verwijderd de  <strong><i>defekte Link</i></strong> en de <strong><i>aanpassingsverzoek</i></strong> voor de opgegeven link)';
$lang_new[$module_name]['INFO_IGNORE'] = 'Negeren (Wist alle <strong><i>aanpassingverzoeken</i></strong> voor de opgegeven link)';
$lang_new[$module_name]['INFO_ISTHSYOURSITE'] = 'Is dat uw eigen site?';
$lang_new[$module_name]['INFO_LOOK_AFTER'] = 'Wij zullen uw verzoek zo spoedig mogelijk behandelen.';
$lang_new[$module_name]['INFO_NO_SUBCAT'] = '--- Geen subcategorie ---';
$lang_new[$module_name]['INFO_ONLYONCE'] = 'Uw URL maar een keer opgeven AUB.<br />Wij controleren of uw URL al in onze database voor komt.';
$lang_new[$module_name]['INFO_ONLYREGISTERED'] = 'Sorry maar alleen geregistreerde bezoekers mogen deze bewerking uitvoeren.<br />Indien u een geregistreerde bezoeker bent, bent u nu niet ingelogd. U kunt zich  <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">hier</a></strong> inloggen.<br />Of <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">hier</a></strong> registreren.';
$lang_new[$module_name]['INFO_PENDING'] = 'Uw link word gecontroleerd en door ons team geactiveerd.<br />Nadat deze vrijgegeven is krijgt u per E-Mail een bevestiging.';
$lang_new[$module_name]['INFO_PROMOTE_1'] = 'Misschien bent u ook geinteresseerd in de verschillende <i>Waardeer mijn website</i> opties, die wij aanbieden? Deze staan toe een afbeelding te plaatsen (of een stem formulier) direct op uw website, Om het aantal stemmen op uw website te verhogen kunt u een van onderstaande mogelijkheden kiezen die voor u het meest passend is:';
$lang_new[$module_name]['INFO_PROMOTE_2'] = 'Een mogelijkheid is waardering in ons systeem van uw website doormiddel van een tekstlink:';
$lang_new[$module_name]['INFO_PROMOTE_3'] = 'Als u iets meer wilt kunt misschien een button als link die u graag wilt:';
$lang_new[$module_name]['INFO_PROMOTE_4'] = 'Indien u probeerd te bedriegen word uw link voor eens en altijd van onze site verwijderd. Nu we het een en ander duidelijk gemaakt hebben kan deze optie op uw site er zo uit zien:';
$lang_new[$module_name]['INFO_PROMOTE_5'] = 'Hartelijk dank en veel succes bij het waarderen van uw link!';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_1'] = 'Volgende HTML- Code dient u in dit geval in uw website toe te voegen:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_2'] = 'Volgende HTML- Code dient u voor de Button in uw site toe voegen:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_3'] = 'De bediening van dit formulier staat het toe dat uw bezoekers direct op uw pagina kunnen stemmen. Wij ontvangen deze en slaan het in onze database op. Het bovenstaande voorbeeld is niet actief, maar op uw site zal deze werken als u de HTML- Code precies zo toevoegd. Hier uw HTML- Code:';
$lang_new[$module_name]['INFO_RATE_ADDED_COMMENT'] = 'Uw waardering helpt andere gebruikers om voor u te kiezen om welke gelinkte paginas te bezoeken.';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU'] = 'Dank u dat u de tijd heeft genomen om deze gelinkte site op';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] = 'te waarderen.';
$lang_new[$module_name]['INFO_RATE_CANDO'] = 'Schrijf AUB een commentaar voor deze site.';
$lang_new[$module_name]['INFO_RATE_CANNOTDO'] = 'Indien u geregistreerd was kon u een commantaar schrijven voor deze site.';
$lang_new[$module_name]['INFO_RATE_COMPLETED_OK'] = 'Dank u voor de waardering.';
$lang_new[$module_name]['INFO_RATING_1'] = 'Niet meer dan eenmaal voor dezelfde link stemmen AUB.';
$lang_new[$module_name]['INFO_RATING_2'] = 'De schaal is van 1 tot 10, waarbij1 het slechste en 10 de beste waardering is.';
$lang_new[$module_name]['INFO_RATING_3'] = 'Gelieve AUB opjectief te stemmen. Als iedereen met 1 of 10 stemd zijn de resultaten niet echt doorlaggevend.';
$lang_new[$module_name]['INFO_RATING_4'] = 'U kun een overzicht van de  <a href="modules.php?name='.$module_name.'&amp;op=TopRated">hoogst gewaardeerde links</a> laten weergeven.';
$lang_new[$module_name]['INFO_RATING_5'] = 'Waardeer AUB niet uw eigen of de site van uw directe concurent, dan bent u zekers niet objectief.';
$lang_new[$module_name]['INFO_REG_LOGGEDIN'] = 'U bent geregistreerd en ingelogd.';
$lang_new[$module_name]['INFO_THANKS'] = 'Dank u voor de informatie.';
$lang_new[$module_name]['INFO_UNREG_LOGGEDOUT'] = 'U bent niet geregstreerd of inglogd.';
$lang_new[$module_name]['INSTRUCTIONS'] = 'Handleiding';
$lang_new[$module_name]['IN_DB'] = 'in onze database';
$lang_new[$module_name]['IP_ADRESS'] = 'IP Adres';
$lang_new[$module_name]['LINKS'] = 'Links';
$lang_new[$module_name]['LINKS_NEW'] = 'Nieuwe links';
$lang_new[$module_name]['LINK_ID'] = 'Link ID';
$lang_new[$module_name]['LINK_IMAGE'] = 'Afbeelding';
$lang_new[$module_name]['LINK_IMAGE_URL'] = 'URL afbeelding';
$lang_new[$module_name]['LINK_OWNER'] = 'Eigenaar link';
$lang_new[$module_name]['LINK_PAGETITLE'] = 'Paginatitel';
$lang_new[$module_name]['LINK_PROFILE'] = 'Link Profiel';
$lang_new[$module_name]['LINK_SUBMIT'] = 'Nieuwe link inzenden';
$lang_new[$module_name]['LINK_SUBMITTER'] = 'Link inzender';
$lang_new[$module_name]['LINK_SUBMIT_DATE'] = 'Link toegestuurd op';
$lang_new[$module_name]['LINK_URL'] = 'URL link';
$lang_new[$module_name]['LINK_VALIDATE_DATE'] = 'Link gecontroleerd op';
$lang_new[$module_name]['MAIL_APPROVED_MESSAGE'] = 'Gefeliciteerd, de door u ingestuurde link is gecontroleerd en geactiveerd. Deze isnu voor iedereen toegangkelijk.';
$lang_new[$module_name]['MAIL_BROWSEURL'] = 'Test onze WebLinks Datanbank en klik op deze URL ->';
$lang_new[$module_name]['MAIL_HELLO'] = 'Hallo';
$lang_new[$module_name]['MAIL_SIGNATURE'] = 'Het team';
$lang_new[$module_name]['MAIL_SITENAME'] = 'Uw Weblink bij: ';
$lang_new[$module_name]['MAIL_THANKYOU'] = 'Hartelijk dank voor het insturen van uw link - U bent op onze site altijd hartelijk welkom';
$lang_new[$module_name]['MAIN_CATEGORY_PAGE'] = $lang_new[$module_name]['MODULE_NAME'] . ' Hoofdpagina categorie';
$lang_new[$module_name]['MESSAGE_ADMIN_SETTINGS_SAVED'] = '<span style="color:green">Uw instellingen zijn opgeslagen.<br />Controleer uw <i>Error Logger</i>, of er een foutmelding was</span>';
$lang_new[$module_name]['MESSAGE_COMMENT_DELETE_ALL'] = 'Alle commentaren zijn uit de database gewist<br />Hopelijk was dat geen fout<br />Dit is onomkeerbaar';
$lang_new[$module_name]['MESSAGE_EDITORIAL_ADDED'] = 'De inleidig is succesvol opgeslagen';
$lang_new[$module_name]['MESSAGE_EDITORIAL_MODIFIED'] = 'De inleiding is succesvol veranderd!';
$lang_new[$module_name]['MESSAGE_EDITORIAL_REMOVED'] = 'De inleiding is succesvol verwijderd';
$lang_new[$module_name]['MESSAGE_LINK_ADDED'] = 'De Link is succesvol toegevoegd!';
$lang_new[$module_name]['MESSAGE_LINK_BROKEN_ADDED'] = 'Hartelijk dank voor uw hulp bij onze service.';
$lang_new[$module_name]['MESSAGE_LINK_BROKEN_EXISTS'] = 'Hartelijk dank voor uw hulp onze service te verbeteren. <br />Alleen was een andere gebruikers sneller en had ons reeds de defecte link gemeld.';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED'] = 'Wij hebben uw Link ontvangen. Hartelijk dank!';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_EMAIL'] = 'U ontvangt van ons een E-Mail wanneer de link gecontroleerd en door ons team vrijgegeven is.';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_NOEMAIL'] = 'U heeft geen E-Mailadres opgegeven, maar wij zullen uw link controleren.<br />Kijk binnenkort weer of uw link geactiveerd is.';
$lang_new[$module_name]['MESSAGE_LINK_VALIDATED'] = 'De link is succesvol toegevoegd / vrijgegeven!';
$lang_new[$module_name]['MESSAGE_RATING_ADDED'] = 'Uw link is succesvol opgeslagen';
$lang_new[$module_name]['MODIFY'] = 'Bewerken';
$lang_new[$module_name]['MODIFY_LINK_REQUEST'] = 'Aanpassingswens link';
$lang_new[$module_name]['MOST_POPULAR'] = 'De populairste';
$lang_new[$module_name]['NAME'] = 'Naam';
$lang_new[$module_name]['NEW_LAST30DAY'] = 'laatste30 dagen';
$lang_new[$module_name]['NEW_LAST3DAY'] = 'laatste 3 dagen';
$lang_new[$module_name]['NEW_LASTWEEK'] = 'afgelopen week';
$lang_new[$module_name]['NEW_THISWEEK'] = 'deze week';
$lang_new[$module_name]['NEW_TODAY'] = 'Vandaag';
$lang_new[$module_name]['NEW_TOTAL'] = 'Nieuwe Links';
$lang_new[$module_name]['NEW_TOTAL_FORLAST'] = 'Nieuwste links van de laatste';
$lang_new[$module_name]['NONE'] = 'geen';
$lang_new[$module_name]['NOTE'] = 'Let op dat';
$lang_new[$module_name]['OF'] = 'van';
$lang_new[$module_name]['OK'] = 'OK';
$lang_new[$module_name]['PAGE_NEXT'] = 'Volgende pagina';
$lang_new[$module_name]['PAGE_NONEXT'] = 'geen volgende pagina';
$lang_new[$module_name]['PAGE_NOPREVIOUS'] = 'geen vorige pagina';
$lang_new[$module_name]['PAGE_PREVIOUS'] = 'Vorige pagina';
$lang_new[$module_name]['PICSIZE'] = 'Die maximale afbeeldings grootte is: ';
$lang_new[$module_name]['PICSIZE_HEIGHT'] = 'Hoogte';
$lang_new[$module_name]['PICSIZE_WIDTH'] = 'Breedte';
$lang_new[$module_name]['POPULAR'] = 'Populair';
$lang_new[$module_name]['PROMOTE_RATING_BUTTON_LINK'] = 'Button Link';
$lang_new[$module_name]['PROMOTE_RATING_FORM'] = 'Externe stembox';
$lang_new[$module_name]['PROMOTE_RATING_ID_REFERER'] = 'in de Code betekens uw site- ID in de '.EVO_SERVER_SITENAME.' database. Let er AUB op dat dit nummer aangegeven is.';
$lang_new[$module_name]['PROMOTE_RATING_TEXT_LINK'] = 'Text Link';
$lang_new[$module_name]['PROMOTE_RATING_THE_NUMBER'] = 'Het getal';
$lang_new[$module_name]['PROMOTE_YOUR_WEBSITE'] = 'Reclame voor website';
$lang_new[$module_name]['RATED_BEST'] = 'Hoogst gewaardeerd';
$lang_new[$module_name]['RATED_BEST_HEADER'] = 'Best gewaardeerde Links - Top';
$lang_new[$module_name]['RATED_NUMBERS'] = 'Aantal gewaardeerde Links';
$lang_new[$module_name]['RATED_TOTAL'] = 'Totaal gewaardeerde Links';
$lang_new[$module_name]['RATED_USER_AVERAGE'] = 'Gemiddelde waardering vande gebruikers';
$lang_new[$module_name]['RATING'] = 'Waardering';
$lang_new[$module_name]['RATING_BREAKDOWN_VALUES'] = 'Aantal waarderingen per waarde';
$lang_new[$module_name]['RATING_DETAILS'] = 'Details van de waardering';
$lang_new[$module_name]['RATING_LINK'] = 'Waardering van de Links';
$lang_new[$module_name]['RATING_LINK_HIGHEST'] = 'Hoogste waardering';
$lang_new[$module_name]['RATING_LINK_LOWEST'] = 'Laagste waardering';
$lang_new[$module_name]['RATING_NUMBERS'] = 'Aantal waarderingen';
$lang_new[$module_name]['RATING_OVERALL'] = 'Waardering totaal';
$lang_new[$module_name]['RATING_WEIGHT_NOTE'] = '* Opmerking: Deze site verteld u de waardering van gerigistreerde gebruikers tot in verhoudig van ongeregistreerde gebruikers';
$lang_new[$module_name]['RATING_WEIGHT_OUTNOTE'] = '*Opmerking: Deze site verteld u de waardering van gerigistreerde gebruikers tot in verhoudig van externe gebruikers';
$lang_new[$module_name]['REPORT_BROKEN'] = 'Melden van een defecte link';
$lang_new[$module_name]['SCROLL_DOWN'] = 'Naar onderen';
$lang_new[$module_name]['SCROLL_UP'] = 'Naar boven';
$lang_new[$module_name]['SEARCH_RESULTS_CATEGORIES'] = 'Gewvonden in de Categorie�n';
$lang_new[$module_name]['SEARCH_RESULTS_HEADER'] = 'Zoekresultaten voor uw opdracht:';
$lang_new[$module_name]['SEARCH_RESULTS_LINKS'] = 'In Links gevonden';
$lang_new[$module_name]['SEARCH_RESULTS_NO_MATCH'] = 'Sorry, we hebben geen resultaten in onze database gevonden';
$lang_new[$module_name]['SEARCH_RESULTS_OTHER_ENGINES'] = 'in andere zoekmachines';
$lang_new[$module_name]['SEARCH_RESULTS_TRYSEARCH'] = 'Probeer een zoekopdracht';
$lang_new[$module_name]['SHOW'] = 'Weergeven';
$lang_new[$module_name]['SHOW_EDITORIAL'] = 'Inleiding weergeven';
$lang_new[$module_name]['SHOW_LINK_COMMENTS'] = 'Commentarenvan de link weergeven';
$lang_new[$module_name]['SHOW_MOSTPOPULAR'] = 'Hoogst gewaardeerde links weergeven';
$lang_new[$module_name]['SHOW_NEWSLINKS'] = 'Nieuwe link weergeven';
$lang_new[$module_name]['SHOW_RANDOM'] = 'Willekeurige links weergeven';
$lang_new[$module_name]['SHOW_TOPRATED'] = 'Hoogst gewaardeerde links weergeven';
$lang_new[$module_name]['SORTS_BY'] = 'Links sorteren op';
$lang_new[$module_name]['SORTS_DATE_DOWN'] = 'Datum (Nieuwe links eerst)';
$lang_new[$module_name]['SORTS_DATE_UP'] = 'Datum (Oude links eerst)';
$lang_new[$module_name]['SORTS_IS'] = 'Links sorteren naar';
$lang_new[$module_name]['SORTS_POPULARITY_DOWN'] = 'Hoogst gewaardeerd (Meeste naar minste Hits)';
$lang_new[$module_name]['SORTS_POPULARITY_UP'] = 'Hoogst gewaardeerd (Minstenaar meeste Hits)';
$lang_new[$module_name]['SORTS_RATING_DOWN'] = 'Bewertung (H&ouml;chste zu niedrigste Wertungen)';
$lang_new[$module_name]['SORTS_RATING_UP'] = 'Waardering (Laagste naar hoogste waardering)';
$lang_new[$module_name]['SORTS_TITLEAZ'] = 'Titel (A tot Z)';
$lang_new[$module_name]['SORTS_TITLEZA'] = 'Titel (Z tot A)';
$lang_new[$module_name]['SUBMIT_ACCEPT'] = 'Accepteren';
$lang_new[$module_name]['SUBMIT_ADD'] = 'Toevoegen';
$lang_new[$module_name]['SUBMIT_BACK_CATEGORY'] = 'Terug naar Categorie';
$lang_new[$module_name]['SUBMIT_DELETE'] = 'Wissen';
$lang_new[$module_name]['SUBMIT_DOIT'] = 'Uitvoeren';
$lang_new[$module_name]['SUBMIT_MODIFY'] = 'Bewerken';
$lang_new[$module_name]['SUBMIT_MODIFY_REQUEST'] = 'Wijziging verzenden';
$lang_new[$module_name]['SUBMIT_RETURN'] = 'Terug';
$lang_new[$module_name]['SUBMIT_SAVE'] = 'Opslaan';
$lang_new[$module_name]['SUBMIT_VOTE'] = 'Stemmen !';
$lang_new[$module_name]['THERE_ARE'] = 'Er zijn ';
$lang_new[$module_name]['TITLE'] = 'Titel';
$lang_new[$module_name]['TO'] = 'tot';
$lang_new[$module_name]['TOTAL'] = 'Totaal';
$lang_new[$module_name]['TOTAL_LINKS'] = 'Totale Links';
$lang_new[$module_name]['UP'] = 'Oplopend';
$lang_new[$module_name]['USER'] = 'Gebruiker';
$lang_new[$module_name]['USER_REGISTERED'] = 'Geregistreerde gebruiker';
$lang_new[$module_name]['USER_REGISTERED_NOT'] = 'Gasten';
$lang_new[$module_name]['VIEW_FULL'] = 'Volledige grootte weergeven';
$lang_new[$module_name]['VISIT'] = 'Bezoeken';
$lang_new[$module_name]['VOTE'] = 'Stemmen';
$lang_new[$module_name]['VOTERS_OUTSIDE'] = 'Externe stemmer';
$lang_new[$module_name]['VOTERS_UNREGISTERED'] = 'Nicht geregistreerde gebruiker';
$lang_new[$module_name]['VOTES'] = 'Stemmen';
$lang_new[$module_name]['VOTES_OUTSIDE_NONE'] = 'Geen externe stemmen';
$lang_new[$module_name]['VOTES_REGISTERED_NONE'] = 'geen stemmen van geregistreerde gebruikers';
$lang_new[$module_name]['VOTES_TOTAL'] = 'Totale stemmen';
$lang_new[$module_name]['VOTES_UNREGISTERED_NONE'] = 'Geen stemmen door niet geregistreerde gebruikers';
$lang_new[$module_name]['VOTE_MINIMUM'] = 'Minst succesvol gestemd zijn';
$lang_new[$module_name]['WARN_CAT_DELETE'] = '<span style="color:red">WARSCHUWING : Wilt u deze categorie werkelijk wissen? <br />Er worden dan ook alle subcategorie�n en toegevoegde links verwijderd !</span>';
$lang_new[$module_name]['WARN_CAT_NOT_FOUND'] = '<span style="color:red">Er bestaat geen categorie om te wissen/bewerken/bewerken/verplaatsen</span>';
$lang_new[$module_name]['WARN_COMMENT_DELETE_ALL'] = '<span style="color:red">WAARSCHUWING<br />Dit zal <i>ALLE</i> commentaren van <i>ELKE</i> Link verwijderen.<br />Om commentaren van een speciale link te wissen kies <i>'. $lang_new[$module_name]['ADMIN_MODIFY_LINK'] .'</i> uit het Administratie menu</span>';
$lang_new[$module_name]['WARN_COMMENT_NOT_FOUND'] = '<span style="color:red">Er bestaan geen commentaren om te wissen/bewerken/vrij te geven</span>';
$lang_new[$module_name]['WARN_DETAILS_NOT_FOUND'] = '<span style="color:red">Er zijn geen details voor dezelink om weer te geven</span>';
$lang_new[$module_name]['WARN_EDITORIAL_NOT_FOUND'] = '<span style="color:red">Er is geen inleiding om weer te geven</span>';
$lang_new[$module_name]['WARN_LINK_NOT_FOUND'] = '<span style="color:red">Er is geen link om te wissen/bewerken/vrij te geven</span>';
$lang_new[$module_name]['WARN_RATE_COMPLETED_TOSHORT'] = '<span style="color:red">U heeft al in de laatste '.$anonwaitdays.' dag(en) op deze site gestemd.</span>';
$lang_new[$module_name]['WARN_RATE_NOT_SELF'] = '<span style="color:red">U kunt uw eigens ingestuurde link niet waarderen.<br/>Alle waarderingen worden opgeslagen en gecontroleerd.</span>';
$lang_new[$module_name]['WARN_RATE_NO_SELECTED'] = '<span style="color:red">Geen waardering gekozen - Stem niet geteld.</span>';
$lang_new[$module_name]['WARN_RATE_ONLY_ONCE'] = '<span style="color:red">U kunt voor elke site maar een keer stemmen.<br/>Alle waarderingen worden opgeslagen en gecontroleerd.</span>';
$lang_new[$module_name]['WARN_RATE_OUTSIDE_TOSHORT'] = '<span style="color:red">Er word per '.$outsidewaitdays.' dag(en) maar een waardering per IP adres toegestaan.</span>';
$lang_new[$module_name]['WARN_RECORDED'] = '<span style="color:red">Gebruikersnaam en IP worden opgeslagen. Misbruik dit systeem niet.</span>';
$lang_new[$module_name]['WARN_VOTE_NOT_FOUND'] = '<span style="color:red">Er is geen waardering om te wissen/bewerken/vrij te geven</span>';
$lang_new[$module_name]['WEBLINKS_IN_DB'] = 'Links in onze database.';
$lang_new[$module_name]['WEBLINKS_SIGNATURE'] = 'Het Team';
$lang_new[$module_name]['WEEKS_1'] = '1 week';
$lang_new[$module_name]['WEEKS_2'] = '2 weken';
$lang_new[$module_name]['WELCOME_USERNAME'] = "Hallo ".UsernameColor($userinfo['username']).", ";

?>