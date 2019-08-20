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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Çerez Ayarları';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Forum Çerez Ayarları';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Çerez Seçenekleri';

$lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO'] = 'These details define how cookies are sent to your users\' browsers. In most cases the default values for the cookie settings should be sufficient, but if you need to change them do so with care -- incorrect settings can prevent users from logging in';
$lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO_USER'] = 'Cookie Settings User specific';

$lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN'] = 'Cookie Domain';
$lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN_HELP'] = 'If Nuke Evolution is installed in the root of a domain f.e. http://www.mysite.com or http://mysite.com, the cookie domain should be set as .mysite.com (note the period before the name). If your site is installed on a subdomain like http://evo.mysite.com, the cookie domain should be set as evo.mysite.com If installed in a sub folder like http://www.mysite.com/evo/, set www.mysite.com as the cookie domain.';
$lang_admin[$settingspoint]['FIELD_COOKIE_PATH'] = 'Cookie Path';
$lang_admin[$settingspoint]['FIELD_COOKIE_PATH_HELP'] = 'If Nuke Evolution is installed in the root of a domain like http://www.mysite.com or http://mysite.com or it is installed on a sub domain like http://evo.mysite.com, the cookie path should be set to /. If your site is in a sub folder like http://www.mysite.com/evo/ the cookie path should be set to /evo (note that there is no / at the end).';
$lang_admin[$settingspoint]['FIELD_COOKIE_NAME'] = 'Cookie Name';
$lang_admin[$settingspoint]['FIELD_COOKIE_NAME_HELP'] = 'In all cases the cookie name cookie name MUST match exactly your domain without the suffix f.e. if you domain is http://www.mysite.com, http://mysite.com or http://evo.mysite.com the cookie name must be always mysite, even if your site is installed in a sub folder.';
$lang_admin[$settingspoint]['FIELD_COOKIE_SECURE'] = 'Secure Cookie';
$lang_admin[$settingspoint]['FIELD_COOKIE_SECURE_HELP'] = 'To use a secured protocol for the cookies, the web server must prepared to accept HTTPS connections.';
$lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH'] = 'Sessions length in seconds';
$lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH_HELP'] = 'Define how long a single session is valid. You have to define the session length in seconds. Default is 3600.';
$lang_admin[$settingspoint]['FIELD_COOKIE_CHECK'] = 'Activate the Cookie Check';
$lang_admin[$settingspoint]['FIELD_COOKIE_CHECK_HELP'] = 'Checks if the browser accepts cookies';
$lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER'] = 'Activate the CookieCleaner';
$lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER_HELP'] = 'Shows the option to delete all cookies set by this site.';
$lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY'] = 'Allowed period of pageview inactivity';
$lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY_HELP'] = 'Duration of how long a user is logged in without any activity.';
$lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME'] = 'Çerez Süresi';
$lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME_HELP'] = 'After this time the cookie expires and will be deleted by the browser automatically.';

$lang_admin[$settingspoint]['OPTION_COOKIE_LOGOUT'] = 'Pencere kapandığında çıkış yap';
$lang_admin[$settingspoint]['OPTION_COOKIE_BLOCK'] = 'Girişleri İncelle';
$lang_admin[$settingspoint]['OPTION_COOKIE_SECONDS'] = 'Saniye';
$lang_admin[$settingspoint]['OPTION_COOKIE_MINUTE'] = 'Dakika';
$lang_admin[$settingspoint]['OPTION_COOKIE_MINUTES'] = 'Dakika';
$lang_admin[$settingspoint]['OPTION_COOKIE_HOUR'] = 'Saat';
$lang_admin[$settingspoint]['OPTION_COOKIE_HOURS'] = 'Saat';
$lang_admin[$settingspoint]['OPTION_COOKIE_DAY'] = 'Gün';
$lang_admin[$settingspoint]['OPTION_COOKIE_DAYS'] = 'Gün';
$lang_admin[$settingspoint]['OPTION_COOKIE_WEEK'] = 'Hafta';
$lang_admin[$settingspoint]['OPTION_COOKIE_WEEKS'] = 'Hafta';
$lang_admin[$settingspoint]['OPTION_COOKIE_MONTH'] = 'Ay';
$lang_admin[$settingspoint]['OPTION_COOKIE_MONTHS'] = 'Ay';
$lang_admin[$settingspoint]['OPTION_COOKIE_INDEFINITE'] = 'Indefinite';
$lang_admin[$settingspoint]['OPTION_COOKIE_AUTOMATIC'] = 'İlk sayfa görüntülemesinden sonra otomatik çıkış yap';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

?>