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

if (!defined('ADMIN_FILE') && !defined('IN_SETTINGS')) {
   exit('Ce fichier n\'&eacute;tait pas convoqu&eacute;e depuis l\'ADMINISTRATION');
}

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Mod&eacute;ration des Commentaires';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Mod&eacute;ration Commentaires';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Options';

$lang_admin[$settingspoint]['FIELD_COMMENT_LIMIT'] = 'Commentaires Limit&eacute; en octets';
$lang_admin[$settingspoint]['FIELD_COMMENT_ANONYMOUS'] = 'Voir le nom de l\'utilisateur pour les commentaires anonymes';
$lang_admin[$settingspoint]['FIELD_COMMENT_MODERATE'] = 'Mod&eacute;ration Type';

$lang_admin[$settingspoint]['OPTION_MODERATE_NONE'] = 'Aucun';
$lang_admin[$settingspoint]['OPTION_MODERATE_USER'] = 'Mod&eacute;ration Utilisateur';
$lang_admin[$settingspoint]['OPTION_MODERATE_ADMIN'] = 'Mod&eacute;ration Administrateur';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ d\'entr&eacute;e valide pour'.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>