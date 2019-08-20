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

$lang_admin[$adminpoint]['THEMES_ACTIVATE'] = 'Activeren';
$lang_admin[$adminpoint]['THEMES_ACTIVE'] = 'Actief';
$lang_admin[$adminpoint]['THEMES_ADMINS'] = 'Administrators';
$lang_admin[$adminpoint]['THEMES_ADV_COMP'] = 'Deze thema is Compatibel metde uitgebreide ATO opties';
$lang_admin[$adminpoint]['THEMES_ADV_OPTS'] = 'Uitgebreide thema Opties';
$lang_admin[$adminpoint]['THEMES_ALLOWCHANGE'] = 'Welke gebruikers mogen deze thema kiezen';
$lang_admin[$adminpoint]['THEMES_ALLUSERS'] = 'Alle gebruikers';
$lang_admin[$adminpoint]['THEMES_ATO_KEY'] = 'ATO sleutel';

$lang_admin[$adminpoint]['THEMES_CHANGEATO'] = 'ATO waarden aanpassen';
$lang_admin[$adminpoint]['THEMES_CUSTOMN'] = 'Gebruikersgedefineede naam';
$lang_admin[$adminpoint]['THEMES_CUSTOMNAME'] = 'Gebruikersgedefineerde thema Naam';

$lang_admin[$adminpoint]['THEMES_DB_VALUE'] = 'Activatie waarde';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE'] = 'Deactiveren';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE1'] = 'Weet u zeker dat u deze thema deactiveren wilt?';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE2'] = 'Dit zal alle gebruikers die deze thema hebben terug zetten naar de standaard thema!';
$lang_admin[$adminpoint]['THEMES_DEFAULT'] = 'Standaard Thema';
$lang_admin[$adminpoint]['THEMES_DEFAULT_MISSING'] = 'Uw standaard thema werrd niet gevonden ! ';
$lang_admin[$adminpoint]['THEMES_DEFAULT_NOT_FOUND'] = ' is niet gevonden!';
$lang_admin[$adminpoint]['THEMES_DEFAULT_VALUE'] = 'Standaard waarde van deze thema';
$lang_admin[$adminpoint]['THEMES_DEF_LOADED'] = 'Standaard waardes zijn onderaan geladen.';

$lang_admin[$adminpoint]['THEMES_EDIT'] = 'Bewerken';
$lang_admin[$adminpoint]['THEMES_ERROR'] = 'Fout';
$lang_admin[$adminpoint]['THEMES_ERROR_CRITICAL'] = 'Kritische fout';
$lang_admin[$adminpoint]['THEMES_ERROR_MESSAGE'] = 'Informatie over het geinstalleerde thema werd niet gevonden';

$lang_admin[$adminpoint]['THEMES_FROM'] = 'van thema';
$lang_admin[$adminpoint]['THEMES_FUNCTIONS'] = 'Funkties';

$lang_admin[$adminpoint]['THEMES_GROUPS'] = 'Groepen';
$lang_admin[$adminpoint]['THEMES_GROUPSONLY'] = 'Alleen groepen';

$lang_admin[$adminpoint]['THEMES_HEADER'] = 'Nuke Evolution Theme Management :: Administratiensmenu';

$lang_admin[$adminpoint]['THEMES_INACTIVE'] = 'Inactief';
$lang_admin[$adminpoint]['THEMES_INFO_CHANGEATO'] = '<i>Als de installatievoltooid is kunt instellingen van de ATO waarden aanpassen<br />Doorvoor moet u deze thema bewerken.</i>';
$lang_admin[$adminpoint]['THEMES_INSTALL'] = 'Installeren';
$lang_admin[$adminpoint]['THEMES_INSTALLED'] = 'Geinstalleerde Thema';

$lang_admin[$adminpoint]['THEMES_MAKEDEFAULT'] = 'Als Standaard instellen';
$lang_admin[$adminpoint]['THEMES_MANG_OPTIONS'] = 'Theme Management Opties';
$lang_admin[$adminpoint]['THEMES_MOSTPOPULAR'] = 'Meest geliefde thema';
$lang_admin[$adminpoint]['THEMES_MULTLANG_COMP'] = 'Uw thema is meertalig';

$lang_admin[$adminpoint]['THEMES_NAME'] = 'Naam thema';
$lang_admin[$adminpoint]['THEMES_NO'] = 'Nee';
$lang_admin[$adminpoint]['THEMES_NONE'] = 'Geen';
$lang_admin[$adminpoint]['THEMES_NOREALNAME'] = 'N/A';
$lang_admin[$adminpoint]['THEMES_NOT_COMPAT'] = '<font color=\'red\'>Uw thema is niet compatibel met de uitgebreide ATO eigenschappen</font><br />Laat uwthame <a href=\'http://www.evo-themes.de\' target=\'_blank\'>HIER</a> aanpassen';
$lang_admin[$adminpoint]['THEMES_NOT_MULTLANG_COMP'] = '<font color="red">Uw thema is niet meertalig</font>';
$lang_admin[$adminpoint]['THEMES_NUMTHEMES'] = 'Aantal themas';
$lang_admin[$adminpoint]['THEMES_NUMUNINSTALLED'] = 'Aantal gedeinstalleerde themas';
$lang_admin[$adminpoint]['THEMES_NUMUSERS'] = '# van gebruiker';

$lang_admin[$adminpoint]['THEMES_OPTIONS'] = 'Theme Opties';
$lang_admin[$adminpoint]['THEMES_OPTS'] = 'Opties';

$lang_admin[$adminpoint]['THEMES_PAGE_FIRST'] = 'Eerste';
$lang_admin[$adminpoint]['THEMES_PAGE_LAST'] = 'Laatste';
$lang_admin[$adminpoint]['THEMES_PAGE_NEXT'] = 'Volgende';
$lang_admin[$adminpoint]['THEMES_PAGE_OF'] = 'van';
$lang_admin[$adminpoint]['THEMES_PAGE_OF_TOTAL'] = 'tot';
$lang_admin[$adminpoint]['THEMES_PAGE_PREVIOUS'] = 'Vorige';
$lang_admin[$adminpoint]['THEMES_PERMISSIONS'] = 'Rechten';
$lang_admin[$adminpoint]['THEMES_PREVIEW'] = 'Voorbeeld';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES'] = 'Wie mag dit bekijken';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS'] = 'Welke groepen';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS_INFO'] = 'Weergave moet op: Alleen voor groepen ingesteld zijn';
$lang_admin[$adminpoint]['THEMES_PROBLEM'] = 'Er zijn problemen met deze thema, weet u zeker dat deze compatibel is';

$lang_admin[$adminpoint]['THEMES_QINSTALL'] = 'Snelle installatie';
$lang_admin[$adminpoint]['THEMES_QUNINSTALLED'] = 'Gedeinstalleerd';

$lang_admin[$adminpoint]['THEMES_REALNAME'] = 'Echte Naam';
$lang_admin[$adminpoint]['THEMES_REST_DEF'] = 'Standaard herstellen';
$lang_admin[$adminpoint]['THEMES_RETURN'] = 'Terug naar thema Management';
$lang_admin[$adminpoint]['THEMES_RETURNMAIN'] = 'Terug naar hoofdmenu';
$lang_admin[$adminpoint]['THEMES_RETURN_OPTIONS'] = 'Terug naar thema opties';

$lang_admin[$adminpoint]['THEMES_SAVECHANGES'] = 'Wijzigingen opslaan';
$lang_admin[$adminpoint]['THEMES_SETTINGS_UPDATED'] = 'Instellingen geactualiseerd!';
$lang_admin[$adminpoint]['THEMES_STATUS'] = 'Status';
$lang_admin[$adminpoint]['THEMES_SUBMIT'] = 'Verzenden';
$lang_admin[$adminpoint]['THEMES_SUBMIT'] = 'Zenden';

$lang_admin[$adminpoint]['THEMES_TEXT_AREA'] = 'Tekstbereik';
$lang_admin[$adminpoint]['THEMES_THEMES'] = 'Themas';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATE'] = 'Gedeactiveerde thema';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED'] = 'Thema succesvol gedeactiveerd!';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED_FAILED'] = 'Fout opgetreden bij thema deactiveren!';
$lang_admin[$adminpoint]['THEMES_THEME_INSTALLED'] = 'Thema geinstalleerd!';
$lang_admin[$adminpoint]['THEMES_THEME_INSTALLED_FAILED'] = 'Installeren van thema mislukt!';
$lang_admin[$adminpoint]['THEMES_THEME_MISSING'] = 'Thema niet gevonden!';
$lang_admin[$adminpoint]['THEMES_THEME_TRANSFER'] = 'Thema Transfer';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALL'] = 'Gedeinstalleerde thema';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED'] = 'Thema succes gedeinstalleerd';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED_FAILED'] = 'Fout bij deinstalleren van thema!';
$lang_admin[$adminpoint]['THEMES_TO'] = 'Naar thema gaan';
$lang_admin[$adminpoint]['THEMES_TRANSFER'] = 'Gebruikers transfer thema';
$lang_admin[$adminpoint]['THEMES_TRANSFER_UPDATED'] = 'Gebruikers is geactualiseerd!';

$lang_admin[$adminpoint]['THEMES_UNINSTALL'] = 'Deinstalleren';
$lang_admin[$adminpoint]['THEMES_UNINSTALL1'] = 'Weet u het zeker dat u deze thema wilt deinstalleren?';
$lang_admin[$adminpoint]['THEMES_UNINSTALL2'] = 'U zult alle instellingen vandeze thema verliezen!';
$lang_admin[$adminpoint]['THEMES_UNINSTALL3'] = 'U zult alle gebruikers die deze thema gekozen hebben naar de stadaard thema terug zetten!';
$lang_admin[$adminpoint]['THEMES_UNINSTALLED'] = 'Gedinstalleerde themas';
$lang_admin[$adminpoint]['THEMES_UPDATED'] = 'Thema actualiseren!';
$lang_admin[$adminpoint]['THEMES_UPDATEFAILED'] = 'Thema-Actualisering mislukt!';
$lang_admin[$adminpoint]['THEMES_USEREMAIL'] = 'E-Mail';
$lang_admin[$adminpoint]['THEMES_USERID'] = 'Gebruikers ID';
$lang_admin[$adminpoint]['THEMES_USERNAME'] = 'Gebruikersnaam';
$lang_admin[$adminpoint]['THEMES_USERTHEME'] = 'Thema';
$lang_admin[$adminpoint]['THEMES_USER_MODIFY'] = 'Thema veranderen';
$lang_admin[$adminpoint]['THEMES_USER_OPTIONS'] = 'Gebruikersopties';
$lang_admin[$adminpoint]['THEMES_USER_RESET'] = 'Standaardwaardes terugzetten';
$lang_admin[$adminpoint]['THEMES_USER_SELECT'] = 'Kies een gebruikers thema';

$lang_admin[$adminpoint]['THEMES_VIEW'] = 'Weergeven';
$lang_admin[$adminpoint]['THEMES_VIEW_STATS'] = 'Statistieken weergeven';

$lang_admin[$adminpoint]['THEMES_YES'] = 'Ja';

?>