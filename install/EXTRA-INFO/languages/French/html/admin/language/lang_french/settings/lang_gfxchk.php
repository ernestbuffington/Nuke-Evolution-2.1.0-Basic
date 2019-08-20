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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Code de s&eacute;curit&eacute;';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Param&egrave;tre Code de s&eacute;curit&eacute;';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Code de s&eacute;curit&eacute; Options';

$lang_admin[$settingspoint]['FIELD_USEGFXCHECK'] = 'Utiliser Code de s&eacute;curit&eacute;';
$lang_admin[$settingspoint]['FIELD_CODESIZE'] = 'Nombre de caract&egrave;res';
$lang_admin[$settingspoint]['FIELD_CODEFONT'] = 'Font face';
$lang_admin[$settingspoint]['FIELD_IMAGE_BACKGROUND'] = 'Utiliser une image de font?';
$lang_admin[$settingspoint]['FIELD_DEFAULTFONT'] = 'Polices par d&eacute;faut';
$lang_admin[$settingspoint]['FIELD_FONT_UPLOAD'] = 'Vous pouvez ajouter de nouvelles (TTF) polices en les t&eacute;l&eacute;chargeant &agrave;:';
$lang_admin[$settingspoint]['FIELD_CAPFILE'] = 'Codeauswahl';

$lang_admin[$settingspoint]['OPTION_CHECKING_NO'] = 'Pas de test';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMIN'] = 'Seulement la connection des administrateurs';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_USER'] = 'Seulement la connection des utilisateurs';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_USER'] = 'Seulement la connection des nouveaux utilisateurs';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_NEW_USER'] = 'Les deux, connection utilisateurs et nouveaux utilisateurs ';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMINUSER'] = 'Seulement pour la connection des administrateurs et des utilisateurs';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_ADMINUSER'] = 'Seulement pour la connection des administrateurs et des nouveaux utilisateurs';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_EVERYWHERE'] = 'Partout, toutes les options (admins et utilisateurs)';
$lang_admin[$settingspoint]['OPTION_CAPFILE_DEFAULT'] = 'D&eacute;faut';
$lang_admin[$settingspoint]['OPTION_CAPFILE_FILE'] = 'Fichier';

$lang_admin[$settingspoint]['IMG_CAPFILE_FILE'] = 'Code de s&eacute;curit&eacute;';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ de saisie valide pour '.$settingspoint.' ';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>