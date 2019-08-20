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

$lang_admin[$adminpoint]['BUTTON_BACK'] = 'Retour';
$lang_admin[$adminpoint]['BUTTON_BACK_SETTINGS'] = 'Retour au menu de R&eacute;glage';

$lang_admin[$adminpoint]['ERROR'] = 'Erreur';
$lang_admin[$adminpoint]['ERROR_FUNCTION_NOT_EXISTS'] = 'La fonction choisie n\'existe pas';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR'] = 'Votre fichier .htaccess n\'a pas le status de r&eacute;&eacute;criture<br />Pour plus d\'aide voir dans votre wiki';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR_OPEN'] = 'Le fichier .htaccess ne peut &ecirc;tre ouvert';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_NF'] = 'Votre fichier .htaccess n\'est pas activ&eacute;<br />Pour plus d\'aide voir dans votre wiki';
$lang_admin[$adminpoint]['ERROR_MODULE_FIELD_WRONG'] = 'Il y a une erreur dans les param&egrave;tres du module';
$lang_admin[$adminpoint]['ERROR_NO_DBFIELD'] = 'Aucun champ pour cette table sp&eacute;cifi&eacute;es pour';
$lang_admin[$adminpoint]['ERROR_NO_TABLE'] = 'Aucune table sp&eacute;cifi&eacute;es pour';
$lang_admin[$adminpoint]['ERROR_UPDATE_DBFIELD'] = 'Mis &agrave; jour &eacute;chou&eacute; pour le champ';

$lang_admin[$adminpoint]['INFO_DBUPDATE_SUCCESSFULL'] = 'Mise &agrave; jour r&eacute;ussi';
$lang_admin[$adminpoint]['INFO_MESSAGE'] = 'Note';

$lang_admin[$adminpoint]['SETTINGS_ADMIN_HEADER'] = 'Evolution R&eacute;glages';

?>