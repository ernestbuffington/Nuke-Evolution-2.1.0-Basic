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

$lang_admin[$adminpoint]['ADMIN_LOG'] = 'Log file Administration';
$lang_admin[$adminpoint]['ADMIN_LOG_ERRFND'] = 'The log file could not be found';

$lang_admin[$adminpoint]['BACK'] = 'Back';

$lang_admin[$adminpoint]['CLEAR_LOG'] = 'Delete all Entries';

$lang_admin[$adminpoint]['HEAD_DATE'] = 'Date';
$lang_admin[$adminpoint]['HEAD_IP'] = 'IP';
$lang_admin[$adminpoint]['HEAD_MSG'] = 'Message';
$lang_admin[$adminpoint]['HEAD_TIME'] = 'Time';

$lang_admin[$adminpoint]['LOG_NOT_OPEN'] = 'We can\'t open your Log file - please use your FTP-Client and download and view this file.';
$lang_admin[$adminpoint]['LOG_NO_ENTRY'] = 'No Entries in the Log file';
$lang_admin[$adminpoint]['LOG_TOBIG'] = 'Your Log file is greater than 6 MB - this may cause a memory leak - please use your FTP-Client and download and view this file.';
?>