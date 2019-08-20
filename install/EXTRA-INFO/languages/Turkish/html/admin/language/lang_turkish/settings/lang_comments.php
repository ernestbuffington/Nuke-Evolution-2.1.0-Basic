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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Yorum Yönetimi';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Yorumların Yönetimi';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Seçenekler';

$lang_admin[$settingspoint]['FIELD_COMMENT_LIMIT'] = 'Bayt olarak Yorum Sınırı';
$lang_admin[$settingspoint]['FIELD_COMMENT_ANONYMOUS'] = 'Misafirlerin Yorumlarında Görüntülenecek İsim';
$lang_admin[$settingspoint]['FIELD_COMMENT_MODERATE'] = 'Yönetim Türü';

$lang_admin[$settingspoint]['OPTION_MODERATE_NONE'] = 'Yok';
$lang_admin[$settingspoint]['OPTION_MODERATE_USER'] = 'Üye Tarafından Yönetim';
$lang_admin[$settingspoint]['OPTION_MODERATE_ADMIN'] = 'Yönetici Tarafından Yönetim';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

?>