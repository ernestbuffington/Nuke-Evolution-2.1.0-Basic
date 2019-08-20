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

$lang_admin['INDEX']['ADMIN_LOG'] = 'Sicherheitsverfolgung';
$lang_admin['INDEX']['ADMIN_LOG_ACK'] = 'quittieren';
$lang_admin['INDEX']['ADMIN_LOG_CHECKED'] = 'Die Version wurde das letzte mal gepr&uuml;ft am ';
$lang_admin['INDEX']['ADMIN_LOG_CHG'] = '<strong>Dein Admin Protokoll <strong>hat</strong> sich ge&auml;ndert</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERR'] = '<strong>Es gab ein Problem mit Deinem Fehler Protokoll.</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRCHMOD'] = '<strong>Die Datei konnte nicht geschrieben werden. Hast Du die Berechtigung gesetzt (chmod)?</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRFND'] = 'Das Protokoll konnte nicht gefunden werden.';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN1'] = 'Die Sicherheitsverfolgung protokolliert folgendes';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN2'] = '<ul><li>Admin Konto Erstellung</li><li>Fehlgeschlagene Admin Anmeldungen</li><li>Eindringling Alarm</li><li>MySQL Fehler</li></ul>';
$lang_admin['INDEX']['ADMIN_LOG_FINE'] = 'Dein Admin Protokoll hat sich nicht ge&auml;ndert';
$lang_admin['INDEX']['ADMIN_LOG_TITLE'] = 'Administratives Logbuch';
$lang_admin['INDEX']['ADMIN_LOG_VIEW'] = 'Protokoll anzeigen';

$lang_admin['INDEX']['ERROR_LOG_CHG'] = '<strong>Dein Fehler Protokoll <strong>hat</strong> sich ge&auml;ndert</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERR'] = '<strong>Es gab ein Problem mit Deinem Fehler Protokoll.</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRCHMOD'] = '<strong>Die Datei konnte nicht geschrieben werden. Hast Du die Berechtigung gesetzt (chmod)?</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRFND'] = 'Das Protokoll konnte nicht gefunden werden.';
$lang_admin['INDEX']['ERROR_LOG_ERR_OPEN'] = 'Die Datei error.log konnte nicht ge&ouml;ffnet werden';
$lang_admin['INDEX']['ERROR_LOG_FINE'] = 'Dein Fehler Protokoll hat sich nicht ge&auml;ndert';
$lang_admin['INDEX']['ERROR_LOG_TITLE'] = 'Fehler Logbuch';

$lang_admin['INDEX']['SECURITY_ADMIN_IP_LOCK'] = 'Administrationszugriff nur mit hinterlegter IP';
$lang_admin['INDEX']['SECURITY_SEC_OFF'] = 'Deaktiviert';
$lang_admin['INDEX']['SECURITY_SEC_ON'] = 'Aktiviert';
$lang_admin['INDEX']['SECURITY_SEC_STATUS'] = 'Sicherheits Status';
$lang_admin['INDEX']['SECURITY_SENTINEL'] = 'NukeSentinel(tm)';

$lang_admin['INDEX']['TRACKER_BACK'] = 'Zur&uuml;ck';
$lang_admin['INDEX']['TRACKER_CLEAR'] = 'Protokoll l&ouml;schen';
$lang_admin['INDEX']['TRACKER_CLEARED'] = 'Das Protokoll wurde gel&ouml;scht!';
$lang_admin['INDEX']['TRACKER_ERR_OPEN'] = 'Die Datei admin.log konnte nicht ge&ouml;ffnet werden';
$lang_admin['INDEX']['TRACKER_ERR_UP'] = 'Die Aktualisierung ist fehlgeschlagen';
$lang_admin['INDEX']['TRACKER_HEAD_DATE'] = 'Datum';
$lang_admin['INDEX']['TRACKER_HEAD_IP'] = 'IP';
$lang_admin['INDEX']['TRACKER_HEAD_MSG'] = 'Nachricht';
$lang_admin['INDEX']['TRACKER_HEAD_TIME'] = 'Zeit';
$lang_admin['INDEX']['TRACKER_UP'] = 'AKTUALISIERT';

$lang_admin['INDEX']['VERSIONCTL_TITLE'] = 'Versionskontrolle';

?>