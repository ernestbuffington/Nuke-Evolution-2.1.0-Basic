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
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Languages';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Language Settings';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Language Options';

$lang_admin[$settingspoint]['FIELD_SITE_LANGUAGE'] = 'Default Language for your Website';
$lang_admin[$settingspoint]['FIELD_SITE_LANGUAGE_HELP'] = 'Choose the default language for your website. More than one language must be installed to change this setting.';
$lang_admin[$settingspoint]['FIELD_SITE_MULTILINGUAL'] = 'Activate Multilanguage Feature';
$lang_admin[$settingspoint]['FIELD_SITE_MULTILINGUAL_HELP'] = 'Enable/disable the multilanguage capability of your website. To make the multilanguage feature work, it must have more than one language installed.';
$lang_admin[$settingspoint]['FIELD_SITE_USEFLAGS'] = 'Show Flags instead Select field';
$lang_admin[$settingspoint]['FIELD_SITE_USEFLAGS_HELP'] = 'Set this to YES if you want to show flags instead of text to select a language.';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Save';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Return';

?>