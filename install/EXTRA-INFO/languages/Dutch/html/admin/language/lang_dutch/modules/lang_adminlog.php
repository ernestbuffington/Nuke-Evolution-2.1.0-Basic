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

$lang_admin[$adminpoint]['ADMIN_LOG'] = 'Administratie logboek';
$lang_admin[$adminpoint]['ADMIN_LOG_ERRFND'] = 'Het logboek werd niet gevonden';

$lang_admin[$adminpoint]['BACK'] = 'Terug';

$lang_admin[$adminpoint]['CLEAR_LOG'] = 'Inhoud wissen';

$lang_admin[$adminpoint]['HEAD_DATE'] = 'Datum';
$lang_admin[$adminpoint]['HEAD_IP'] = 'IP';
$lang_admin[$adminpoint]['HEAD_MSG'] = 'Inhoud';
$lang_admin[$adminpoint]['HEAD_TIME'] = 'Tijd';

$lang_admin[$adminpoint]['LOG_NOT_OPEN'] = 'Het logboek kon niet geopend worden - Om de inhoud te bekijken, download via FTP deze naar uw computer';
$lang_admin[$adminpoint]['LOG_NO_ENTRY'] = 'Geen vermelding gevonden';
$lang_admin[$adminpoint]['LOG_TOBIG'] = 'Uw logboek is groter dan 6 MB, wat toch geheugen problemen kan leiden - Om de inhoud te bekijken, download via FTP deze naar uw computer';

?>