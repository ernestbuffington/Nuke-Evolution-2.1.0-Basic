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

$lang_admin[$adminpoint]['ADMIN_LOG'] = 'Journal de bord d\'administration';
$lang_admin[$adminpoint]['ADMIN_LOG_ERRFND'] = 'Le journal n\'a pas pu &ecirc;tre trouv&eacute;';

$lang_admin[$adminpoint]['BACK'] = 'Retour';

$lang_admin[$adminpoint]['CLEAR_LOG'] = 'Effacer toutes les entr&eacute;es';

$lang_admin[$adminpoint]['HEAD_DATE'] = 'Date';
$lang_admin[$adminpoint]['HEAD_IP'] = 'IP';
$lang_admin[$adminpoint]['HEAD_MSG'] = 'Message';
$lang_admin[$adminpoint]['HEAD_TIME'] = 'Time';

$lang_admin[$adminpoint]['LOG_NOT_OPEN'] = 'Nous ne pouvons pas ouvrir votre fichier journal - vous devez essayer par FTP pour voir ce qu\'il y a dedans';
$lang_admin[$adminpoint]['LOG_NO_ENTRY'] = 'Pas d\'entr&eacute;es dans le fichier de log';
$lang_admin[$adminpoint]['LOG_TOBIG'] = 'Votre fichier journal est sup&eacute;rieure &agrave; 6 Mo - peut entra&icirc;ner une fuite de m&eacute;moire - donc s\'il vous pla&icirc;t utilisez votre client FTP et t&eacute;l&eacute;charger le fichier pour voir ce qu\'il y a dedans';

?>