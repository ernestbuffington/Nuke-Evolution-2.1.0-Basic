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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Güvenlik Kodu';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Güvenlik Kodu Ayarları';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Güvenlik Kodu Ayarları';

$lang_admin[$settingspoint]['FIELD_USEGFXCHECK'] = 'Güvenlik Kodu Kullanılsın mı?';
$lang_admin[$settingspoint]['FIELD_CODESIZE'] = 'Karakter Sayısı';
$lang_admin[$settingspoint]['FIELD_CODEFONT'] = 'Seçili Font';
$lang_admin[$settingspoint]['FIELD_IMAGE_BACKGROUND'] = 'Zemin Resmi Kullanılsın mı?';
$lang_admin[$settingspoint]['FIELD_DEFAULTFONT'] = 'Varsayılan Font';
$lang_admin[$settingspoint]['FIELD_FONT_UPLOAD'] = 'You can add new (ttf) fonts by uploading them to:';
$lang_admin[$settingspoint]['FIELD_CAPFILE'] = 'Codeauswahl';

$lang_admin[$settingspoint]['OPTION_CHECKING_NO'] = 'Kontrol Yok';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMIN'] = 'Sadece Yönetici Girişlerinde';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_USER'] = 'Sadece Kullanıcı Girişlerinde';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_USER'] = 'Sadece Yeni Üye Kaydı Yapılırken';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_NEW_USER'] = 'Kullanıcı Girişlerinde ve Yeni Üye Kaydı esnasında';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_ADMINUSER'] = 'Yönetici ve Üye Girişi esnasında';
$lang_admin[$settingspoint]['OPTION_CHECKING_NEW_ADMINUSER'] = 'Administrators and new users registration only';
$lang_admin[$settingspoint]['OPTION_CHECKING_LOGIN_EVERYWHERE'] = 'Everywhere on all options (Admins and Users)';
$lang_admin[$settingspoint]['OPTION_CAPFILE_DEFAULT'] = 'Varsayılan';
$lang_admin[$settingspoint]['OPTION_CAPFILE_FILE'] = 'Dosya';

$lang_admin[$settingspoint]['IMG_CAPFILE_FILE'] = 'Güvenlik Kodu';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

?>