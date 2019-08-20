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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Temel Ayarlar';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Temel Ayarlar';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Temel Seçenekler';
$lang_admin[$settingspoint]['FIELD_SITENAME'] = 'Web Sitenizin Adı';
$lang_admin[$settingspoint]['FIELD_SITENAME_HELP'] = 'This should be the name of your website. Keep it as short as possible. This name is shown in the browser as the name of your website.';
$lang_admin[$settingspoint]['FIELD_SITEURL'] = 'Web Sitenizin Adresi';
$lang_admin[$settingspoint]['FIELD_SITEURL_HELP'] = 'This must be the URL of your website beginning with http://';
$lang_admin[$settingspoint]['FIELD_SITELOGO'] = 'Web Sitenizin Logosu';
$lang_admin[$settingspoint]['FIELD_SITELOGO_HELP'] = 'You can define a logo graphic for your website here. This field should contain the filename of an image located in the image folder.';
$lang_admin[$settingspoint]['FIELD_SITESLOGAN'] = 'Slogan of your Website';
$lang_admin[$settingspoint]['FIELD_SITESLOGAN_HELP'] = 'A short description of the content or a slogan for your website. The description or slogan should be as short as possible.';
$lang_admin[$settingspoint]['FIELD_STARTDATE'] = 'Startdate of this Website';
$lang_admin[$settingspoint]['FIELD_STARTDATE_DAY'] = 'Gün';
$lang_admin[$settingspoint]['FIELD_STARTDATE_MONTH'] = 'Ay';
$lang_admin[$settingspoint]['FIELD_STARTDATE_YEAR'] = 'Yıl';
$lang_admin[$settingspoint]['FIELD_STARTDATE_HELP'] = 'The start date of your website. This date is shown in the header of the Statistics-Module. The given date does not depend on the site language setting. It should contain the month and year - f.e. Jan. 2010';
$lang_admin[$settingspoint]['FIELD_ADMINMAIL'] = 'Administrative Email-Adress';
$lang_admin[$settingspoint]['FIELD_ADMINMAIL_HELP'] = 'This should be a valid email address of the founder or admin of this website - f.e. webmaster@yourpage.com';
$lang_admin[$settingspoint]['FIELD_ITEMSTOP'] = 'Number of Items in Top Page';
$lang_admin[$settingspoint]['FIELD_ITEMSTOP_HELP'] = 'This setting defines the amount of shown entries of the Top-Module. Default is 10 (TOP 10)';
$lang_admin[$settingspoint]['FIELD_STORIESHOME'] = 'Stories Number in Home';
$lang_admin[$settingspoint]['FIELD_STORIESHOME_HELP'] = 'This setting defines the amount of news shown in home. Default is 10. This setting is overwritten by the setting in the Articles configuration or a user setting.';
$lang_admin[$settingspoint]['FIELD_OLDSTORIES'] = 'Stories in Old Articles Box';
$lang_admin[$settingspoint]['FIELD_OLDSTORIES_HELP'] = 'This setting defines the amount of news shown in the article archives. Default is 30.';
$lang_admin[$settingspoint]['FIELD_ANONPOST'] = 'Allow Anonymous to Post?';
$lang_admin[$settingspoint]['FIELD_ANONPOST_HELP'] = 'This setting defines, if guests are allowed to submit news and write comments.';
$lang_admin[$settingspoint]['FIELD_LOCALEFORMAT'] = 'Yerel Saat Formatı';
$lang_admin[$settingspoint]['FIELD_LOCALEFORMAT_HELP'] = 'This is the local PHP time format. This setting is no longer in use. It is just left for compatibility reasons.';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

?>