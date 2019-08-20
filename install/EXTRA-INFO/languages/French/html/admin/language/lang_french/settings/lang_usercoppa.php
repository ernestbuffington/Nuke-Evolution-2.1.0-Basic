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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Param&egrave;tre COPPA';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Protection de l\'enfance en ligne COPPA';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'COPPA Options';

$lang_admin[$settingspoint]['FIELD_COPPA'] = 'Conformit&eacute; COPPA requise';
$lang_admin[$settingspoint]['FIELD_COPPAAGE'] = 'Age limite pour Coppa';
$lang_admin[$settingspoint]['FIELD_COPPATEXT'] = '<strong>COPPA Termes</strong><br /><small>Ici vous pouvez editer le contenu de status du COPPA. <br />NOTE: Ce ne sera affich&eacute; que si vous avez activ&eacute; COPPA.</small>';

$lang_admin[$settingspoint]['OPTION_COPPA_AGE'] = 'Ans';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ valide pour'.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>