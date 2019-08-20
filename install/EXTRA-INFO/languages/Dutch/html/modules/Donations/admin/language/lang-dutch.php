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

global $lang_donate;

//Common
$lang_donate['ADMIN_HEADER'] = 'Nuke-Evolution Donaties :: Module Administatie Menu';
$lang_donate['RETURNMAIN'] = 'Terug naar Administratie Hoofdmenu';
$lang_donate['DONATIONS'] = 'Donaties';
$lang_donate['CURRENT_DONATIONS'] = 'Huidige Donaties';
$lang_donate['DONATION_VALUES'] = 'Waarde Donaties';
$lang_donate['CONFIG_BLOCK'] = 'Config Blok';
$lang_donate['CONFIG_GENERAL'] = 'Config Donaties';
$lang_donate['CONFIG_PAGE'] = 'Config Pagina';
$lang_donate['ADD_DONATION'] = 'Donatie Toevoegen';
$lang_donate['BREAK'] = ':';
$lang_donate['YES'] = 'Ja';
$lang_donate['NO'] = 'Nee';
$lang_donate['DONATION_SUBMIT'] = 'Toevoegen';

//Config Page & Config Block
$lang_donate['SHOW_AMOUNTS'] = 'Laat het bedrag zien';
$lang_donate['SHOW_GOAL'] = 'Laat het doel zien';
$lang_donate['SHOW_ANON_AMNTS'] = 'Laat anoniem zien';
$lang_donate['BUTTON_IMAGE'] = 'Knop afbeelding';
$lang_donate['NUM_DONATIONS'] = 'Zichtbaar aantal donaties';
$lang_donate['SHOW_DATES'] = 'Laat donatie datums zien';

//Config Page
$lang_donate['PAGE_HEADER_IMG'] = 'Pagina Hoofd Afbeelding';

//Config Donation
$lang_donate['PP_EMAIL'] = 'PayPal Email Adres';
$lang_donate['CURRENCY'] = 'Munt';
$lang_donate['DONATION_NAME'] = 'Donatie Naam';
$lang_donate['DONATION_CODE'] = 'Donatie Code';
$lang_donate['MONTHLY_GOAL'] = 'Maandelijks Doel';
$lang_donate['DATE_FORMAT'] = 'Datum Formaat (<a href="http://us3.php.net/date">PHP Date</a>)';
$lang_donate['TYPE'] = 'Type Donatie';
$lang_donate['TYPE_PRIVATE'] = 'Privé';
$lang_donate['TYPE_ANON'] = 'Anoniem';
$lang_donate['TYPE_REGULAR'] = 'Regelmatig';
$lang_donate['THANK_YOU'] = 'Dank U';
$lang_donate['IMAGE'] = 'Afbeelding';
$lang_donate['MESSAGE'] = 'Bericht';
$lang_donate['CANCEL'] = 'Annuleer';
$lang_donate['ALLOW_MESSAGE'] = 'Bericht/Reden Toestaan';
$lang_donate['SCROLL'] = 'Scrollende donatie lijst';
$lang_donate['NUMBERS'] = 'Laat nummers zien';
$lang_donate['CODES'] = 'Donatie codes';
$lang_donate['COOKIE_TRACK'] = 'Spoor donaties op met cookies';

//Add Donation
$lang_donate['ADD_DONATION'] = 'Donatie Toevoegen';
$lang_donate['UNAME'] = 'Gebruikersnaam';
$lang_donate['FIRST_NAME'] = 'Voornaam';
$lang_donate['LAST_NAME'] = 'Achternaam';
$lang_donate['EMAIL_ADD'] = 'Email Adres';
$lang_donate['DONATION'] = 'Donatie';
$lang_donate['ADDED'] = 'Donatie Toegevoegd';
$lang_donate['ADD_TYPE'] = 'Type Donatie';
$lang_donate['DONATE_TO'] = 'Doneer naar';

//Security
$lang_donate['ACCESS_DENIED'] = '<span style="color: #FF0000; font-weight: bold;">Toegang geweigerd</span>';

//Errors
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">FOUT!</span><br />';
$lang_donate['VALUES_NF'] = 'Kan de waardes niet vinden';
$lang_donate['VALUES_ND'] = 'Kan de waardes niet tonen';
$lang_donate['UNAMES_NF'] = 'Kan de gebruikersnaam niet vinden';
$lang_donate['UINFO_NF'] = 'Kan de gebruiker informatie niet vinden';
$lang_donate['TYPES_NF'] = 'Kan de donatie types niet vinden';
$lang_donate['MISSING_FNAME'] = 'Voor uw voornam in';
$lang_donate['MISSING_LNAME'] = 'Voor uw achternaam in';
$lang_donate['INVALID_DONATION'] = 'Voer een geldige donatie in';
$lang_donate['INVALID_EMAIL'] = 'Vooer een geldig email adres in';
$lang_donate['CODES_SHORT'] = 'U moet een code naam in voeren en een PayPal code in de Donatie codes:';
$lang_donate['CODES_SPACES'] = 'Spaties zijn niet toegestaan in de code';

//Current
$lang_donate['DATE'] = 'Datum';
$lang_donate['USERNAME'] = 'Gebruikersnaam';
$lang_donate['AMOUNT'] = 'Bedrag';
$lang_donate['TOTAL'] = 'Totaal';
$lang_donate['GOAL'] = 'Doel';
$lang_donate['DIFF'] = 'Verschil';
$lang_donate['NEXT'] = 'Volgende';
$lang_donate['PREV'] = 'Vorige';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['N/A'] = 'N/A';

//Help
$lang_donate['HELP_DONATION_ANON'] = 'Alles behalve de donatie is verborgen voor de admin(s).<br /><br /><strong>LET OP:</strong> PayPal zal deze informatie nog wel hebben dus het is niet 100% anoniem';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Uw donation is verborgen voor het publiek maar <strong>niet</strong> voor de admin.';
$lang_donate['HELP_DONATION_NAME'] = 'Dit is het primaire donatie type';
$lang_donate['HELP_DONATION_CODE'] = 'Dit is de primaire donatie type code in Paypal';
$lang_donate['HELP_DONATION_CODES'] = 'Dit is waar u andere donatie types en codes kunt aanbrengen.  Dit is <strong>optioneel</strong>.<br /><br />Bijvoorbeeld als u een code voor ziekenhuis rekeningen wilt maken.<hr />De eerste regel is de tekst '
                                      .'welke in de combo box zal verschijnen.  Zorg ervoor dat het herkenbaar is voor mensen.  Spaties zijn toegestaan.<br />Bijvoorbeeld: Ziekenhuis Rekeningen<br /><br />'
                                      .'De volgen regel is devPayPal code die u wilt gebruiken.<br />Spaties zijn <strong>NIET</strong> toegestaan!<br />Bijvoorbeeld: Ziekenhuis_Rekeningen<hr />Dus het uiteidelijke resultaat zal zijn:<br />'
                                      .'Ziekenhuis Rekeningen<br />Ziekenhuis_Rekeningen';
$lang_donate['HELP_COOKIE_TRACK'] = 'Dit zal de donatie waarden in een gebruikers cookies onthouden.  Het voegt een andere manier toe om en donatie te traceren.<br /><strong>Dit zou slechts moeten worden gebruikt als u problemen hebt!</strong>';
?>