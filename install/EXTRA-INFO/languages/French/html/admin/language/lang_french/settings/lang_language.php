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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Langages';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Param&egrave;tres Langage';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Langage Options';

$lang_admin[$settingspoint]['FIELD_SITE_LANGUAGE'] = 'Langage par d&eacute;faut pour votre site Web';
$lang_admin[$settingspoint]['FIELD_SITE_LANGUAGE_HELP'] = 'Choisissez la langue par d&eacute;faut pour votre site web. Plus d\'une langue doit &ecirc;tre install&eacute; pour modifier ce param&egrave;tre.';
$lang_admin[$settingspoint]['FIELD_SITE_MULTILINGUAL'] = 'Activer Multilangage';
$lang_admin[$settingspoint]['FIELD_SITE_MULTILINGUAL_HELP'] = 'Activer / d&eacute;sactiver la capacit&eacute; multilingue de votre site web. Pour faire fonctionner la fonction multilingue, il faut plus d\'une langue install&eacute;e.';
$lang_admin[$settingspoint]['FIELD_SITE_USEFLAGS'] = 'Afficher des drapeaux pour choisir la langue';
$lang_admin[$settingspoint]['FIELD_SITE_USEFLAGS_HELP'] = 'R&eacute;glez cette option sur Oui si vous voulez afficher des drapeaux au lieu du texte pour s&eacute;lectionner une langue';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'pas de champ de saisie valide pour '.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>