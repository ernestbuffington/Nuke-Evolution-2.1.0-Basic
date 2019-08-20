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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Diller';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Dil Ayarları';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Dil Seçenekleri';

$lang_admin[$settingspoint]['FIELD_SITE_LANGUAGE'] = 'Siteniz için Varsayılan Dil';
$lang_admin[$settingspoint]['FIELD_SITE_LANGUAGE_HELP'] = 'Siteniz için Varsayılan Dili seçiniz. Bu özelliği kullanabilmek için birden fazla dil kurulu olmalıdır.';
$lang_admin[$settingspoint]['FIELD_SITE_MULTILINGUAL'] = 'Çokdillilik özelliğini etkinleştir';
$lang_admin[$settingspoint]['FIELD_SITE_MULTILINGUAL_HELP'] = 'Enable/disable the multilanguage capability of your website. To make the multilanguage feature work, it must be more than one language installed.';
$lang_admin[$settingspoint]['FIELD_SITE_USEFLAGS'] = 'Show Flags instead Selectfield';
$lang_admin[$settingspoint]['FIELD_SITE_USEFLAGS_HELP'] = 'Set this to YES if you want to show flags instead of text to select a language.';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

?>