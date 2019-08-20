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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Param&egrave;tres Pied de page';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Param&egrave;tres Pied de page';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Pied de page Options';

$lang_admin[$settingspoint]['FIELD_FOOTER1'] = '1er Message de pied de page de votre site';
$lang_admin[$settingspoint]['FIELD_FOOTER2'] = '2eme Message de pied de page de votre site';
$lang_admin[$settingspoint]['FIELD_FOOTER3'] = '3eme Message de pied de page de votre site';
$lang_admin[$settingspoint]['FIELD_COPYRIGHT'] = 'Copyright dans le pied de page de votre site.<br />Pendant l\'installation il vous a &eacute;t&eacute; demand&eacute; de ne pas modifier ces droits d\'auteur.';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ de saisie valide pour'.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>