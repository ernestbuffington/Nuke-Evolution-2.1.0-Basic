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

$lang_admin[$adminpoint]['INFO_HEAD_TITLE'] = 'System Information';

$lang_admin[$adminpoint]['INFO_MYSQL_EXTENDED'] = 'Extended Status';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES'] = 'Running Processes';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_COMMAND'] = 'Command';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_DATABASE'] = 'Database';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_HOST'] = 'Host';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_ID'] = 'ID';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_INFO'] = 'Info';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_STATE'] = 'State';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_TIME'] = 'Time';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_USER'] = 'User';

$lang_admin[$adminpoint]['INFO_TITLE_GENERALINFO'] = 'General Information';
$lang_admin[$adminpoint]['INFO_TITLE_MYSQL'] = 'MySQL Information';
$lang_admin[$adminpoint]['INFO_TITLE_PHPCORE'] = 'PHP Core Information';
$lang_admin[$adminpoint]['INFO_TITLE_PHPENVIRONMENT'] = 'PHP Environment';
$lang_admin[$adminpoint]['INFO_TITLE_PHPMODULES'] = 'PHP Modules';
$lang_admin[$adminpoint]['INFO_TITLE_PHPVARIABLES'] = 'PHP Variables';

$lang_admin[$adminpoint]['MESSAGES_RETURNMAIN'] = 'Return to Main Administration';

?>