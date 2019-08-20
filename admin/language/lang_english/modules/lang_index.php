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

$lang_admin['INDEX']['ADMIN_LOG'] = 'Security Tracker';
$lang_admin['INDEX']['ADMIN_LOG_ACK'] = 'Acknowledge';
$lang_admin['INDEX']['ADMIN_LOG_CHECKED'] = 'The version was last checked on';
$lang_admin['INDEX']['ADMIN_LOG_CHG'] = '<strong>Your Admin Tracker log <strong>HAS</strong> changed</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERR'] = '<strong>There was a problem checking your log.</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRCHMOD'] = '<strong>Your file is not writeable. Did you do the CHMOD?</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRFND'] = 'The log could not be found';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN1'] = 'The Security Tracker logs the following';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN2'] = '<ul><li>Admin account creation</li><li>Failed admin logins</li><li>Intruder Alert</li><li>MySQL Errors</li></ul>';
$lang_admin['INDEX']['ADMIN_LOG_FINE'] = 'Your Admin Tracker log has not changed';
$lang_admin['INDEX']['ADMIN_LOG_TITLE'] = 'Admin Tracker';
$lang_admin['INDEX']['ADMIN_LOG_VIEW'] = 'View Log';

$lang_admin['INDEX']['ERROR_ERR_OPEN'] = 'Failed to open error.log';
$lang_admin['INDEX']['ERROR_LOG_CHG'] = '<strong>Your Error Log <strong>HAS</strong> changed</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERR'] = '<strong>There was a problem checking your log.</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRCHMOD'] = '<strong>Your file is not writeable. Did you do the CHMOD?</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRFND'] = 'The log could not be found';
$lang_admin['INDEX']['ERROR_LOG_FINE'] = 'Your Error Log has not changed';
$lang_admin['INDEX']['ERROR_LOG_TITLE'] = 'Error Logger';

$lang_admin['INDEX']['SECURITY_ADMIN_IP_LOCK'] = 'Admin IP Lock';
$lang_admin['INDEX']['SECURITY_SEC_OFF'] = 'Disabled';
$lang_admin['INDEX']['SECURITY_SEC_ON'] = 'Enabled';
$lang_admin['INDEX']['SECURITY_SEC_STATUS'] = 'Security Status';
$lang_admin['INDEX']['SECURITY_SENTINEL'] = 'NukeSentinel(tm)';

$lang_admin['INDEX']['TRACKER_BACK'] = 'Back';
$lang_admin['INDEX']['TRACKER_CLEAR'] = 'Clear Log';
$lang_admin['INDEX']['TRACKER_CLEARED'] = 'Your Security Tracker has been cleared!';
$lang_admin['INDEX']['TRACKER_ERR_OPEN'] = 'Failed to open admin.log';
$lang_admin['INDEX']['TRACKER_ERR_UP'] = 'Failed to update';
$lang_admin['INDEX']['TRACKER_HEAD_DATE'] = 'Date';
$lang_admin['INDEX']['TRACKER_HEAD_IP'] = 'IP';
$lang_admin['INDEX']['TRACKER_HEAD_MSG'] = 'Message';
$lang_admin['INDEX']['TRACKER_HEAD_TIME'] = 'Time';
$lang_admin['INDEX']['TRACKER_UP'] = 'UPDATED';

$lang_admin['INDEX']['VERSIONCTL_TITLE'] = 'Evo-CMS Version Checker';

?>