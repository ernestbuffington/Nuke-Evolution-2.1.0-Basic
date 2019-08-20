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

$lang_admin['INDEX']['ADMIN_LOG'] = 'Admin Speurder';
$lang_admin['INDEX']['ADMIN_LOG_ACK'] = 'Bevestig';
$lang_admin['INDEX']['ADMIN_LOG_CHECKED'] = 'Deze versie is het laatst gecontroleerd op ';
$lang_admin['INDEX']['ADMIN_LOG_CHG'] = '<strong>Je Admin Speurder logboek is veranderd</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERR'] = '<strong>Er was een probleem bij je logboek controleren.</</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRCHMOD'] = '<strong>Je file is niet beschrijfbaar.<br />Heb je de chdmod gedaan?</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRFND'] = 'Het logboek kon niet gevonden worden';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN1'] = 'De Admin Speuder houdt het volgende bij.';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN2'] = '<ul><li>Admin account aangemaakt</li><li>Mislukte Admin logins</li><li>Inbreker alarm</li><li>MySQL Fouten</li></ul>';
$lang_admin['INDEX']['ADMIN_LOG_FINE'] = 'Uw error log is niet veranderd';
$lang_admin['INDEX']['ADMIN_LOG_TITLE'] = 'Administratie Logboek';
$lang_admin['INDEX']['ADMIN_LOG_VIEW'] = 'Bekijk logboek';

$lang_admin['INDEX']['ERROR_LOG_CHG'] = '<strong>Uw error log is gewijzigd</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERR'] = '<strong>Er was een probleem met uw error logboek.</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRCHMOD'] = '<strong>Het bestand kon niet beschreven worden (chmod)?</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRFND'] = 'Uw logboek werd niet gevonden.';
$lang_admin['INDEX']['ERROR_LOG_ERR_OPEN'] = 'Het bestand error.log kon niet geopend worden';
$lang_admin['INDEX']['ERROR_LOG_FINE'] = 'Uw error log is niet veranderd';
$lang_admin['INDEX']['ERROR_LOG_TITLE'] = 'Error Logboek';

$lang_admin['INDEX']['SECURITY_ADMIN_IP_LOCK'] = 'Administratietoegang met achterliggende IP';
$lang_admin['INDEX']['SECURITY_SEC_OFF'] = 'Gedeactiveerd';
$lang_admin['INDEX']['SECURITY_SEC_ON'] = 'Geactiveerd';
$lang_admin['INDEX']['SECURITY_SEC_STATUS'] = 'Beveiligingsstatus';
$lang_admin['INDEX']['SECURITY_SENTINEL'] = 'NukeSentinel(tm)';

$lang_admin['INDEX']['TRACKER_BACK'] = 'Terug';
$lang_admin['INDEX']['TRACKER_CLEAR'] = 'Logboek wissen';
$lang_admin['INDEX']['TRACKER_CLEARED'] = 'Het logboek is gewist!';
$lang_admin['INDEX']['TRACKER_ERR_OPEN'] = 'Het bestand admin.log kon niet worden geopend';
$lang_admin['INDEX']['TRACKER_ERR_UP'] = 'Het actualiseren is mislukt';
$lang_admin['INDEX']['TRACKER_HEAD_DATE'] = 'Datum';
$lang_admin['INDEX']['TRACKER_HEAD_IP'] = 'IP';
$lang_admin['INDEX']['TRACKER_HEAD_MSG'] = 'Bericht';
$lang_admin['INDEX']['TRACKER_HEAD_TIME'] = 'Tijd';
$lang_admin['INDEX']['TRACKER_UP'] = 'GEACTUALISEERD';

$lang_admin['INDEX']['VERSIONCTL_TITLE'] = 'Versie controle';

?>