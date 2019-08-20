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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Yasal Belgeler';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Yasal Belgelerin Ayarları';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Yasal Belgelere ait Seçenekler';

$lang_admin[$settingspoint]['FIELD_SHOW_ABOUTUS'] = 'Hakkımızda Sayfasına ait link gösterilsin mi?';
$lang_admin[$settingspoint]['FIELD_SHOW_DISCLAIMER'] = 'Show the Disclaimer Statement link?';
$lang_admin[$settingspoint]['FIELD_SHOW_PRIVACY'] = 'Show the Privacy Statement link?';
$lang_admin[$settingspoint]['FIELD_SHOW_TERMS'] = 'Show the Terms of Service link?';
$lang_admin[$settingspoint]['FIELD_FEEDBACK_MODUL'] = 'Use the Contact Module or Feedback Module for questions pertaining';

$lang_admin[$settingspoint]['OPTION_FEEDBACK_NONE'] = 'Yok';
$lang_admin[$settingspoint]['OPTION_FEEDBACK_FEEDBACK'] = 'Feedback Modul';
$lang_admin[$settingspoint]['OPTION_FEEDBACK_CONTACT'] = 'Contact Modul';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

?>