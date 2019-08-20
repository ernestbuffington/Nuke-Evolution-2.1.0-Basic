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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Documents L&eacute;gaux';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'R&eacute;glage Documents L&eacute;gaux';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Documents L&eacute;gaux Options';

$lang_admin[$settingspoint]['FIELD_SHOW_ABOUTUS'] = 'Voir le lien de la page &agrave; propos de nous?';
$lang_admin[$settingspoint]['FIELD_SHOW_DISCLAIMER'] = 'Voir le lien D&eacute;claration de Responsabilit&eacute;?';
$lang_admin[$settingspoint]['FIELD_SHOW_PRIVACY'] = 'Voir le lien Confidentialit&eacute;?';
$lang_admin[$settingspoint]['FIELD_SHOW_TERMS'] = 'Voir le lien conditions d\'utilisation (TOS)?';
$lang_admin[$settingspoint]['FIELD_FEEDBACK_MODUL'] = 'Utilisez le module de contact ou d\'&eacute;valuation du module pour les questions sur';

$lang_admin[$settingspoint]['OPTION_FEEDBACK_NONE'] = 'Aucun';
$lang_admin[$settingspoint]['OPTION_FEEDBACK_FEEDBACK'] = 'R&eacute;action Module';
$lang_admin[$settingspoint]['OPTION_FEEDBACK_CONTACT'] = 'Contact Module';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ de saisie valide pour '.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>