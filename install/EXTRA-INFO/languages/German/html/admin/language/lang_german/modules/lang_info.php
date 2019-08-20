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

$lang_admin[$adminpoint]['INFO_HEAD_TITLE'] = 'System Informationen';

$lang_admin[$adminpoint]['INFO_MYSQL_EXTENDED'] = 'Erweiterter Status';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES'] = 'Laufende Prozesse';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_COMMAND'] = 'Kommando';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_DATABASE'] = 'Datenbank';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_HOST'] = 'Host';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_ID'] = 'ID';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_INFO'] = 'Info';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_STATE'] = 'Status';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_TIME'] = 'Zeit';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_USER'] = 'Benutzer';

$lang_admin[$adminpoint]['INFO_TITLE_GENERALINFO'] = 'Generelle Informationen';
$lang_admin[$adminpoint]['INFO_TITLE_MYSQL'] = 'MySQL Informationen';
$lang_admin[$adminpoint]['INFO_TITLE_PHPCORE'] = 'PHP Kern Informationen';
$lang_admin[$adminpoint]['INFO_TITLE_PHPENVIRONMENT'] = 'PHP Umgebung';
$lang_admin[$adminpoint]['INFO_TITLE_PHPMODULES'] = 'PHP Module';
$lang_admin[$adminpoint]['INFO_TITLE_PHPVARIABLES'] = 'PHP Variablen';

$lang_admin[$adminpoint]['MESSAGES_RETURNMAIN'] = 'Zur&uuml;ck zur Hauptadministration';

?>