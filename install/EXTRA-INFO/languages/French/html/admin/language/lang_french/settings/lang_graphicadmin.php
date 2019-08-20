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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Admin Graphique';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Param&egrave;tre Graphique pour Menu Administrations';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Graphique Options';

$lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC'] = 'Voir des images dans l\'Admin Menu';
$lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC_HELP'] = 'Enables or disables the icons for each admin function in the admin menue.';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS'] = 'Position des images';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_HELP'] = 'Define if the position of the admin icons is above or below the descriptive text, when graphic images in admin menue is enabled.';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_UP'] = 'Au dessus du texte';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_DOWN'] = 'En dessous du texte';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE'] = 'Activer le redimensionnement des Images';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE_HELP'] = 'D&eacute;finit si la fonction de redimensionnement automatique des images dans les nouvelles est activ&eacute; ou d&eacute;sactiv&eacute;. Redimensionnement d&eacute;pend des r&eacute;glages de la hauteur et la largeur de l\'image sur l\'image ci-dessous.';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH'] = 'Redimensionnement &agrave; une largeur';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH_HELP'] = 'Si fonction de redimensionnement automatique est activ&eacute;e, les images dans les nouvelles seront redimensionn&eacute;es en largeur par rapport &agrave; ce param&egrave;tre.';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT'] = 'Redimensionnement &agrave; une hauteur';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT_HELP'] = 'Si fonction de redimensionnement automatique est activ&eacute;e, les images dans les nouvelles seront redimensionn&eacute;es en hauteur par rapport &agrave; ce param&egrave;tre.';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ de saisie valide pour '.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>