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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Security code';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Security code Settings';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Security code Options';

$lang_admin[$settingspoint]['FIELD_USEGFXCHECK'] = 'Use Security Code';
$lang_admin[$settingspoint]['FIELD_CODESIZE'] = 'Number of characters';
$lang_admin[$settingspoint]['FIELD_CODEFONT'] = 'Font face';
$lang_admin[$settingspoint]['FIELD_IMAGE_BACKGROUND'] = 'Use background image?';
$lang_admin[$settingspoint]['FIELD_DEFAULTFONT'] = 'Default Font';
$lang_admin[$settingspoint]['FIELD_FONT_UPLOAD'] = 'You can add new (ttf) fonts by uploading them to:';
$lang_admin[$settingspoint]['FIELD_CAPFILE'] = 'Code selection';

$lang_admin[$settingspoint]['OPTION_CHECKING_NO'] = 'No Checking';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMIN'] = 'Administrator login only';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_USER'] = 'Users login Only';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_USER'] = 'New Users registration Only';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_NEW_USER'] = 'Both, users login and new users registration only';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMINUSER'] = 'Administrators and users login only';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_ADMINUSER'] = 'Administrators and new users registration only';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_EVERYWHERE'] = 'Everywhere on all options (Admins and Users)';
$lang_admin[$settingspoint]['OPTION_CAPFILE_DEFAULT'] = 'Default';
$lang_admin[$settingspoint]['OPTION_CAPFILE_FILE'] = 'File';

$lang_admin[$settingspoint]['IMG_CAPFILE_FILE'] = 'Securitycode';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Save';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Return';

?>