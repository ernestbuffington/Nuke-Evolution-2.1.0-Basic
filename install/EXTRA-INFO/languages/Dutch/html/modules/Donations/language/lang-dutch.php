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
$lang_donate['DONATIONS'] = 'Donaties';
$lang_donate['BREAK'] = ':';
$lang_donate['DONATE'] = 'Doneer';
$lang_donate['CONFIRM'] = 'Bevestig';

//Index
$lang_donate['VIEW_DONATIONS'] = 'Laat Donaties Zien';
$lang_donate['MAKE_DONATIONS'] = 'Doneer';

//Errors
$lang_donate['GEN_NF'] = 'Algemene gegevens konden niet worden gevonden';
$lang_donate['PAGE_NF'] = 'Pagina gegevens konden niet worden gevonden';
$lang_donate['DON_NF'] = 'Donaties konden niet worden gevonden';
$lang_donate['VALUES_NF'] = 'Donaties waarden kon niet worden gevonden';
$lang_donate['CURRENCY_NF'] = 'Munt eenheid kon niet worden gevonden';
$lang_donate['FAILED'] = 'Niet in geslaagd de Donatie te registreren!';
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">FOUT!</span><br />';
$lang_donate['NO_PP_ADD'] = 'PayPal adres is niet opgezet';

//View
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

//Make
$lang_donate['AMOUNT'] = 'Bedrag';
$lang_donate['TYPE_PRIVATE'] = 'Privé';
$lang_donate['TYPE_ANON'] = 'Anoniem';
$lang_donate['TYPE_REGULAR'] = 'Regelmatig';
$lang_donate['TYPE'] = 'Type donatie';
$lang_donate['MESSAGE'] = 'Bericht/Reden';
$lang_donate['DONATE_TO'] = 'Doneer naar';

//Help
$lang_donate['HELP_TOTAL'] = 'Dit zal het tot dusver geschonken totaal tonen.';
$lang_donate['HELP_GOAL'] = 'Dit zal het totaal tonen dat tot dusver is gedoneerd deze maand ten opzichte van het maandelijkse doel.';
$lang_donate['HELP_DONATION_REGULAR'] = 'Alles is openbaar';
$lang_donate['HELP_DONATION_ANON'] = 'Alles behalve de donatie is verborgen voor de admin(s).<br /><br /><strong>LET OP:</strong> PayPal zal deze informatie nog wel hebben dus het is niet 100% anoniem';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Uw donation is verborgen voor het publiek maar <strong>niet</strong> voor de admin.';

//Confirm
$lang_donate['CONFIRM_DONATION'] = 'Bevestigen uw donatie van %s %s?';
$lang_donate['COME_BACK'] = 'Nadat u uw donatie heeft gemaakt <strong>LET OP</strong> dat u dan gebruik maakt van de knop in paypal om terug te keren naar deze site anders zal uw donatie niet tellen.';

?>