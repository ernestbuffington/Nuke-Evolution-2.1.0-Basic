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

$lang_admin[$adminpoint]['BUTTON_BACK'] = 'Terug';
$lang_admin[$adminpoint]['BUTTON_BACK_SETTINGS'] = 'Terug naar instellingen men';

$lang_admin[$adminpoint]['ERROR'] = 'Fout';
$lang_admin[$adminpoint]['ERROR_FUNCTION_NOT_EXISTS'] = 'Er is een  functie tercontrole aangegevens die niet bestaat';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR'] = 'Uw .htaccess bestand heeft geen schrijfrechten<br />Meer info in onze Wiki';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR_OPEN'] = 'Het .htaccess bestand kon niet geopend worden';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_NF'] = 'Uw .htaccess bestand is niet geactiveerd<br />Meer info in onze Wiki';
$lang_admin[$adminpoint]['ERROR_MODULE_FIELD_WRONG'] = 'Er zit een programmeerfout in de module';
$lang_admin[$adminpoint]['ERROR_NO_DBFIELD'] = 'Er is geen tabel voor dit veld';
$lang_admin[$adminpoint]['ERROR_NO_TABLE'] = 'Er is geen tabel voor dit veld opgegeven';
$lang_admin[$adminpoint]['ERROR_UPDATE_DBFIELD'] = 'Fout bij update database voor dit veld';

$lang_admin[$adminpoint]['INFO_DBUPDATE_SUCCESSFULL'] = 'Update database succesvol';
$lang_admin[$adminpoint]['INFO_MESSAGE'] = 'Tip';

$lang_admin[$adminpoint]['SETTINGS_ADMIN_HEADER'] = 'Instellingen';

?>