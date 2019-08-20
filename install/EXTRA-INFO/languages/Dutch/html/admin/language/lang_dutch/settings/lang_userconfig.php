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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Gebruikersconfiguratie';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Algemene instellingen';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Gebruikers opties';

$lang_admin[$settingspoint]['FIELD_HEADER_REGOPTIONS'] = 'Registratie opties';
$lang_admin[$settingspoint]['FIELD_HEADER_EMAILOPTIONS'] = 'E-Mail-Opties';
$lang_admin[$settingspoint]['FIELD_HEADER_SUSPENDOPTIONS'] = 'Verloop opties';
$lang_admin[$settingspoint]['FIELD_HEADER_LIMITOPTIONS'] = 'Limieten';

$lang_admin[$settingspoint]['FIELD_ALLOWUSERREG'] = 'Registratie toestaan';
$lang_admin[$settingspoint]['FIELD_REQUIREADMIN'] = 'Moet de Administrator een nieuwe registratie vrijschakelen';
$lang_admin[$settingspoint]['FIELD_ALLOWUSERDELETE'] = 'Mogen gebruikers zich zelf deactiveren';
$lang_admin[$settingspoint]['FIELD_DOUBLECHECKEMAIL'] = 'Dubbele E-Mail invoer bij registratie';
$lang_admin[$settingspoint]['FIELD_SERVERMAIL'] = 'Kan de Server E-Mails versturen';
$lang_admin[$settingspoint]['FIELD_SENDMAILADD'] = 'Administrator bij nieuwe registraties informeren<br />(Alleen mogelijk als de server Mail kan versturen)';
$lang_admin[$settingspoint]['FIELD_SENDMAILDELETE'] = 'Administrator bij deactivering informeren<br />(Alleen mogelijk als de server Mail kan versturen)';
$lang_admin[$settingspoint]['FIELD_USEACTIVATE'] = 'Email-activering gebruiken<br />(Alleen mogelijk als de server Mail kan versturen)';
$lang_admin[$settingspoint]['FIELD_ALLOWMAILCHANGE'] = 'E-Mail wijziging door leden toestaan';
$lang_admin[$settingspoint]['FIELD_EMAILVALIDATE'] = 'E-Mail wijzigingen controleren';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPEND'] = 'Gebruiker blokken na';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPEND_TEMP'] = 'Tijdelijk accounts vervallen na';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPENDMAIN'] = 'Automatisch gebruikers blokken<br />(Kande laadtijd van de site verhogen.)';
$lang_admin[$settingspoint]['FIELD_USERS_PER_PAGE'] = 'Aantal gebruikers per site';
$lang_admin[$settingspoint]['FIELD_NICK_MIN'] = 'Min. lengte gebruikersnaam';
$lang_admin[$settingspoint]['FIELD_NICK_MAX'] = 'Max. lengte gebruikersnaam';
$lang_admin[$settingspoint]['FIELD_PASS_MIN'] = 'Min. lengte wachtwoord';
$lang_admin[$settingspoint]['FIELD_PASS_MAX'] = 'Max. lengte wachtwoord';
$lang_admin[$settingspoint]['FIELD_SHOWONLINE'] = 'Maximale weer te geven tijd voor online';

$lang_admin[$settingspoint]['OPTION_SUSPEND_DEACTIVATED'] = 'Nooit';
$lang_admin[$settingspoint]['OPTION_SUSPEND_WEEK'] = 'Week';
$lang_admin[$settingspoint]['OPTION_SUSPEND_WEEKS'] = 'Weken';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DEACTIVATED'] = 'Nooit';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAY'] = 'Dag';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAYS'] = 'Dagen';
$lang_admin[$settingspoint]['OPTION_USERS_PER_PAGE'] = 'Gebruiker';
$lang_admin[$settingspoint]['OPTION_NICK_MIN'] = 'Teken';
$lang_admin[$settingspoint]['OPTION_NICK_MAX'] = 'Tekens';
$lang_admin[$settingspoint]['OPTION_PASS_MIN'] = 'Teken';
$lang_admin[$settingspoint]['OPTION_PASS_MAX'] = 'Tekens';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_CHOICE'] = 'Maak uw keus';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_SECONDS'] = 'Seconden';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTE'] = 'Minuut';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTES'] = 'Minuten';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_HOUR'] = 'Uur';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Geen foutmelding voor '.$settingspoint.' beschikbaar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Opslaan';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Terug';

$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERREG'] = 'Als dit veld op nee ingesteld staat kunnen nieuwe gebruikers zich niet registreren<br />De einigste manier om nieuwe gebruikers aante maken is via het admin menu';
$lang_admin[$settingspoint]['HELP_FIELD_REQUIREADMIN'] = 'Als dit veld op ja staat moet een administrator het nieuwe account vrijgeven.';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERDELETE'] = 'Als dit veld op ja staat kunnen gebruikers zicht zelf deactiveren.<br />Anders kun een gebruikersaccount alleen via het Admin menu gedeactiveerd worden';
$lang_admin[$settingspoint]['HELP_FIELD_DOUBLECHECKEMAIL'] = 'Als dit veld op ja staat zal bij een nieuwe registratie het E-Mailadres twee keer ingevoerd moeten worden.';
$lang_admin[$settingspoint]['HELP_FIELD_SERVERMAIL'] = 'Als dit veld op ja staat zal geprobeerd worden een E-Mail via het SMTP-account van het phpBB-administratie te versturen. Indien nee zal geprobeerd worden een E-Mail via het standaard E-Mail Programma van php = sendmail() te versturen';
$lang_admin[$settingspoint]['HELP_FIELD_SENDMAILADD'] = 'Als dit veld op ja staat word bij elke nieuwe registratie ook een E-Mail verstuurd worden naar de administrator.';
$lang_admin[$settingspoint]['HELP_FIELD_SENDMAILDELETE'] = 'Als dit veld op ja staat word bij elke Deactivering van een gebruikers een E-Mail naar de administrator gestuurd.';
$lang_admin[$settingspoint]['HELP_FIELD_USEACTIVATE'] = 'Als dit veld op ja staat word bij elke nieuwe registratie een E-Mail met een link met een activeringscode ter controle naar het E-Mailadres van de gebruiker gestuurd.<br />Pas nadat de gebruiker deze link gebruikt heeft word het account geactiveerd.';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWMAILCHANGE'] = 'Als dit veld op ja staat mogen gebruikers hun E-Mailadres zelf wijzigen.<br />anders is wijzigen alleen mogelijk via het Admin menu.';
$lang_admin[$settingspoint]['HELP_FIELD_EMAILVALIDATE'] = 'Als dit veld op ja staat word na het veranderen van het E-Mailadres een controle mail verstuurd, na bevestiging hiervan word het nieuwe E-Mail adres geactiveerd.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPENDMAIN'] = 'Als dit veld op ja staat word gecontroleerd wanneer de gebruiker voor het laatst ingelogd was.<br />Afhankelijk van de instelling in het volgende veld word de gebruiker na de daar ingestelde tijd gedactiveerd en dient door een administrator weer geactiveerd worden voordat hij zich weer aanmelden kan.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND'] = 'Staat dit veld op automatische gebruikersblokkade, dan word hier de ingestelde tijdsbestek ter controle gebruikt.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND_TEMP'] = 'Tijdsduur waarin het account automatsch gewist word als de gebruiker of een Amin deze niet geactiveerd heeft.';
$lang_admin[$settingspoint]['HELP_FIELD_USERS_PER_PAGE'] = 'Max. aantal gebruikers die op de site mogen aanmelden. Is het maximum bereikt worden nieuwe afgewezen.';
$lang_admin[$settingspoint]['HELP_FIELD_NICK_MIN'] = 'Minimale lengte vangebruikersnaam.<br />Een waarde onder de 4 is niet zinvol.';
$lang_admin[$settingspoint]['HELP_FIELD_NICK_MAX'] = 'Maximale lengte van gebruikersnaam';
$lang_admin[$settingspoint]['HELP_FIELD_PASS_MIN'] = 'Minimale lengte van wachtwoord.<br />Een waarde onder de 6 is niet zinvol.';
$lang_admin[$settingspoint]['HELP_FIELD_PASS_MAX'] = 'Maximale lengte van wachtwoord';
$lang_admin[$settingspoint]['FIELD_SHOWONLINE_HELP'] = 'Maximale tijd die verstrijken mag om een gebruikers als online weer te geven na laatste activiteit';
?>