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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Param&egrave;tre TOS';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Termes des Services (TOS) Param&egrave;tre';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'TOS Options';

$lang_admin[$settingspoint]['FIELD_TOS'] = 'Voir Termes du Services [TOS]';
$lang_admin[$settingspoint]['FIELD_TOSALL'] = 'TOS visible aux membres aussi';
$lang_admin[$settingspoint]['FIELD_TOSTEXT'] = '<strong>Termes du Services</strong><br /><small>Ici vous pouvez &eacute;diter le contenu de votre TOS. <br />NOTE: Ce ne sera affich&eacute; que si vous avez activ&eacute; le TOS.</small>';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'PAs de champ d\'entr&eacute; valide pour '.$settingspoint.' ';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>