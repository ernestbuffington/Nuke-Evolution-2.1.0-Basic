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
   exit('Bu Dosya Yönetim Sistemi Dışından Çağırılamaz!');
}

global $settingspoint;

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Admingraphic';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Graphic Settings for Administrationsmenu';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Grafik Seçenekleri';

$lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC'] = 'Show Graphicimages in Adminmenu';
$lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC_HELP'] = 'Enables or disables the icons for each admin function in the admin menue.';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS'] = 'Resim Konumu';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_HELP'] = 'Define if the position of the admin icons is above or below the descriptive text, when graphic images in admin menue is enabled.';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_UP'] = 'Above Text';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_DOWN'] = 'Below Text';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE'] = 'Activate Resize Images';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE_HELP'] = 'Defines if the automatic resize function for images in news is enabled or disabled. Resizing depends on the settings for image height and image width given below.';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH'] = 'resize to width';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH_HELP'] = 'If automatic resize function is enabled, the images in news will be resized in width to this setting.';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT'] = 'resize to height';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT_HELP'] = 'If automatic resize function is enabled, the images in news will be resized in height to this setting.';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

?>