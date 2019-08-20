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

if (!defined('ADMIN_FILE')) {
    die('You can\'t access this file directly...');
}

global $adminpoint;

$lang_admin[$adminpoint]['BUTTON_ADMIN_ADD'] = 'Administrator aanmaken';
$lang_admin[$adminpoint]['BUTTON_ADMIN_CHANGE'] = 'Administrator aanpassen';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DELETE'] = 'Administrator wissen';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DOIT'] = 'OK';
$lang_admin[$adminpoint]['BUTTON_USER_PROMOTE'] = 'Gebruiker bevorderen';

$lang_admin[$adminpoint]['FIELDSET_PERMISSIONS'] = 'Rechtenuitgifte';
$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'] = 'Email-Adres';
$lang_admin[$adminpoint]['FIELD_ADMIN_LANGUAGE'] = 'Talen instelling';
$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'] = 'Naam';
$lang_admin[$adminpoint]['FIELD_ADMIN_NO'] = 'Nee';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'] = 'Wachtwoord';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'] = 'Wachtwoord bevestigen';
$lang_admin[$adminpoint]['FIELD_ADMIN_URL'] = 'Website';
$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'] = 'Gebruikersnaam';
$lang_admin[$adminpoint]['FIELD_ADMIN_YES'] = 'Ja';
$lang_admin[$adminpoint]['FIELD_NOTCHANGEABLE'] = 'Veld niet meer te veranderen';

$lang_admin[$adminpoint]['GOD_ADMIN'] = 'God Admin';

$lang_admin[$adminpoint]['HEAD_BACK'] = 'Terug naar Administrators menu;';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINADD'] = 'Nieuwe Administrator aanmaken';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINCHANGE'] = 'Administrator aanpassen';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINDELETE'] = 'Administrator wissen';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINSHOW'] = 'Administrator weergeven';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_MAIN'] = 'Lijst Administrators';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_PROMOTEUSER'] = 'Gebruiker bevorderen';
$lang_admin[$adminpoint]['HEAD_TITLE'] = 'Admins Administratie';
$lang_admin[$adminpoint]['HELP_FIELDSET_PERMISSIONS'] = 'Hier kunt u de rechten voor een Administrator instellen. Klik op elk module waatoe hij toegang mag hebben.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_EMAIL'] = 'Het E-mail aAdres van de Administrator. Dit E-mail adres word gebruikt voor alle berichten voor de Administrator.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_LANGUAGE'] = 'Net zoals in het profiel kun je hier de taal instellen.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_NAME'] = 'Een opgave van de naam is dringend noodzakelijk;br /&gt;Deze naam word bij alle handelingen weergegeven;br /&gt;Deze naam mag niet met een al bestaandegebruiker overeenkomen;br /&gt;Dit word voor u als eerste gecontroleerd.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD'] = 'Het wachtwoord dient tussen de 4 en 12 tekens lang te zijn - Er mogen geenspaties of speciale tekens gebruikt te worden.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD2'] = 'Ter controle dat de wachtwoorden ovcereenkomen.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_SUPERUSER'] = 'LET OP!! Een superadmin heeft bijna dezelfde rechten als een God-Admin !!&ltbr /&gt;Pas op met aan wie je deze rechten vergeeft.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_URL'] = 'De website van de administrator. Hiermee word vookomen dat de administrator zijn eigen website waardeerd (Downloads, Links, Reviews etc.)';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME'] = 'Een opgave van de naam is dringend noodzakelijk;br /&gt;Deze naam word bij alle handelingen weergegeven;br /&gt;Deze naam mag niet met een al bestaandegebruiker overeenkomen;br /&gt;Dit word voor u als eerste gecontroleerd.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME_PROMOTE'] = 'Dit veld  is bij bevordering van een gebruiker niet meer aan te passen, omdat dit veld met de gebruikernaam moet overeenkomen;';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_PASSWORDCHANGE'] = 'Om een wachtwoord te veranderen moet dit veld aangeklikt zijn. Dan pas word het invoerveld vrijgeschakeld';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_SUPERUSER'] = 'Als Superadmin geactiveerd is hoeven geen module rechten meer aangeklikt te worden omdat de Superadmin automatisch alle rechten over de modules heeft';

$lang_admin[$adminpoint]['INFO_ADMIN_GOD_NODELETE'] = 'Het Administrator account '.$lang_admin[$adminpoint]['GOD_ADMIN'].' kan niet gewist worden';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_AFTERLINK'] = 'om hulp te krijgen om eenveilig wachtwoord aan te maken';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_BEFORELINK'] = 'Klik';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_CURRENTSTRENGTH'] = 'Actuele beveiligingsgraad ';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_LINK'] = 'hier';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_MEDIUM'] = 'Middel';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_NOTRATED'] = 'Niet gecontroleerd';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONG'] = 'Veilig';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGER'] = 'Zeer veilig';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGEST'] = 'Absoluut veilig';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_WEAK'] = 'Zwak';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_ADDED'] = 'Administrator account succesvol aangemaakt';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED'] = 'Der Administrator wurde erfolgreich ge&auml;ndert';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED_LOGOUT'] = 'Om de aangepaste instellingen te activeren dient u zich eerst uit te loggen';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_DELETED'] = 'De Administrator is succesvol gewist';
$lang_admin[$adminpoint]['INFO_ADMIN_SUPERUSER_WARN'] = 'Lees AUB de helptekst !!';
$lang_admin[$adminpoint]['INFO_FIELD_NOTCHANGEABLE'] = 'Veld is niet aante passen';

$lang_admin[$adminpoint]['MENUE_ADMIN_ADD'] = 'Administrator aanmaken';
$lang_admin[$adminpoint]['MENUE_ADMIN_PROMOTE'] = 'Gebruiker bevorderen';
$lang_admin[$adminpoint]['MENUE_ADMIN_SHOW'] = 'Administrators weergeven';

$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_CHANGE'] = 'Aanpassen';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_DELETE'] = 'verwijderen';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SELECT'] = 'Aktie kiezen';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SHOW'] = 'Weergeven';
$lang_admin[$adminpoint]['OPTION_ADMIN_PASSWORDCHANGE'] = 'Dient het wachtwoord veranderd te worden';
$lang_admin[$adminpoint]['OPTION_ADMIN_SUPERUSER'] = 'Superadmin';
$lang_admin[$adminpoint]['OPTION_ALL_LANGS'] = 'Alle talen';

$lang_admin[$adminpoint]['QUEST_ADMIN_CHANGE'] = 'Administrator aanpassen';
$lang_admin[$adminpoint]['QUEST_ADMIN_DELETE'] = 'Administrator wissen';

$lang_admin[$adminpoint]['TABLE_ADMIN_ACTION'] = 'Aktie';
$lang_admin[$adminpoint]['TABLE_ADMIN_EMAIL'] = 'Email-Adres';
$lang_admin[$adminpoint]['TABLE_ADMIN_LANGUAGE'] = 'Taal';
$lang_admin[$adminpoint]['TABLE_ADMIN_NAME'] = 'Naam';
$lang_admin[$adminpoint]['TABLE_ADMIN_REGDATE'] = 'Registratiedatum';
$lang_admin[$adminpoint]['TABLE_ADMIN_SUPERUSER'] = 'Superadmin';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERID'] = 'ID';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERNAME'] = 'Gebruikersnaam';

$lang_admin[$adminpoint]['WARNING_ADMIN_DELETE'] = 'Wilt u deze Administrator werkelijk wissen';

$lang_admin[$adminpoint]['ERROR_ADMIN_WRONGAID'] = 'Er is een fout opgetreden, probeer het nomaals.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_EMPTY'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" mag niet leeg zijn';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_INVALID'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" E-Mail adres formaat komt niet overeen met het formaat in ons systeem (Speciale tekens, spaties etc.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_LANGUAGE'] = 'Er is een een fout is de taalselectie opgetreden, wij konden deze taal niet in onze databank vinden.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_AND_SUPER_EMPTY'] = 'De Administrator heeft geen rechten - noch als Superadmin noch als Moduleadmin';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_NOTEXIST'] = 'Een of meerdere vergeven modulerechte bestaan niet in onze database.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_BADWORD'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" bevat tekens die niet toegestaan zijn, hier de gecorrigeerde inhoud';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EMPTY'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" mag niet leeg zijn';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EXISTS'] = 'Er bestaad reeds een gebruiker of Administrator met deze naam.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_GOD_CHANGE'] = 'De naam mag bij een God-Admin niet veranderd worden';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_INVALID'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" voor de gebruikersnaam bevat ongeldige tekens (Speciale tekens, Spaties etc.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_SIZE'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" is %s tekens te lang of te kort (min 3 tekens of max 30 tekens). Let erop dat sommige tekens meer als 1 Byte kunnen beslaan.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD2_EMPTY'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'].'" darf nicht leer sein';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_EMPTY'] = 'Das Feld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'].'" mag niet leeg zijn';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_NOT_MATCH'] = 'De opgegeven wachtwoorden komen niet overeen';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_EMPTY'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" mag niet leeg zijn';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_INVALID'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" is volgens ons systeem geen geldig websiteadres (Speaciale tekens, Spaties etc.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_BADWORD'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" bevat woorden niet hier niet toegestaan zijn. Hier de gecorrigeerde tekst';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EMPTY'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" mag niet leeg zijn';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EXISTS'] = 'Er bestaat reeds een gebruiker of administrator met deze naam.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_INVALID'] = 'Het veld gebruikersnaam "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" bevat ongeldige tekens (Speciale tekens, Spaties etc.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_NOT_EXIST'] = 'Er is tijdens het controleren van de gebruiker een fout opgetreden. Deze bestaat niet in onze databank.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_SIZE'] = 'Het veld "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" is %s tekens te lang of te kort. Let erop dat sommige tekens meer als 1 Byte kunnen beslaan.';
$lang_admin[$adminpoint]['ERROR_DB_INSERT_ADMIN'] = 'ER is tijdens het toevoegen van een Administrator in de databank een fout opgetreden.';
$lang_admin[$adminpoint]['ERROR_USER_ISADMIN'] = 'De geselecteerde gebruiker is reeds een administrator';

?>