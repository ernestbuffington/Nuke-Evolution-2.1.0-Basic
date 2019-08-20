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
    die('Vous n\'avez pas acc&egrave;s &agrave; ce fichier directement...');
}

global $adminpoint;

$lang_admin[$adminpoint]['INFO_HEAD_TITLE'] = 'Informations Syst&egrave;me';

$lang_admin[$adminpoint]['INFO_MYSQL_EXTENDED'] = 'Situation &eacute;tendu';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES'] = 'Les processus en cours';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_COMMAND'] = 'Commande';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_DATABASE'] = 'Base de Donn&eacute;es';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_HOST'] = 'H&ocirc;te';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_ID'] = 'ID';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_INFO'] = 'Info';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_STATE'] = 'Etat';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_TIME'] = 'Heure';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_USER'] = 'Utilisateur';

$lang_admin[$adminpoint]['INFO_TITLE_GENERALINFO'] = 'Informations G&eacute;n&eacute;ral ';
$lang_admin[$adminpoint]['INFO_TITLE_MYSQL'] = 'MySQL Informations';
$lang_admin[$adminpoint]['INFO_TITLE_PHPCORE'] = 'PHP Core Informations';
$lang_admin[$adminpoint]['INFO_TITLE_PHPENVIRONMENT'] = 'PHP Environnement';
$lang_admin[$adminpoint]['INFO_TITLE_PHPMODULES'] = 'PHP Modules';
$lang_admin[$adminpoint]['INFO_TITLE_PHPVARIABLES'] = 'PHP Variables';

$lang_admin[$adminpoint]['MESSAGES_RETURNMAIN'] = 'Retour au Menu Principale d\'Administration';

?>