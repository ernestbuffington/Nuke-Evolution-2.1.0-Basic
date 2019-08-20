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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Kullanıcı Ayarları';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Temel Kullanıcı Ayarları';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Kullanıcı Seçenekleri';

$lang_admin[$settingspoint]['FIELD_HEADER_REGOPTIONS'] = 'Kayıt Olma Seçenekleri';
$lang_admin[$settingspoint]['FIELD_HEADER_EMAILOPTIONS'] = 'E-Posta Seçenekleri';
$lang_admin[$settingspoint]['FIELD_HEADER_SUSPENDOPTIONS'] = 'Suspend Options';
$lang_admin[$settingspoint]['FIELD_HEADER_LIMITOPTIONS'] = 'Sınırlar';

$lang_admin[$settingspoint]['FIELD_ALLOWUSERREG'] = 'Allow User Registration';
$lang_admin[$settingspoint]['FIELD_REQUIREADMIN'] = 'Require Admin Approval';
$lang_admin[$settingspoint]['FIELD_ALLOWUSERDELETE'] = 'Allow User self-deactivation';
$lang_admin[$settingspoint]['FIELD_DOUBLECHECKEMAIL'] = 'Doublecheck email at registration';
$lang_admin[$settingspoint]['FIELD_ALLOWUSERTHEME'] = 'Allow User changing their Style';
$lang_admin[$settingspoint]['FIELD_SERVERMAIL'] = 'Sunucu E-Posta gönderebiliyor mu?';
$lang_admin[$settingspoint]['FIELD_SENDMAILADD'] = 'Yeni Üye Kayıtları Yöneticiye Bildirilsin mi?';
$lang_admin[$settingspoint]['FIELD_SENDMAILDELETE'] = 'Notify Admin of User Deactivation';
$lang_admin[$settingspoint]['FIELD_USEACTIVATE'] = 'Use Email Activation?';
$lang_admin[$settingspoint]['FIELD_ALLOWMAILCHANGE'] = 'Allow User Email Change';
$lang_admin[$settingspoint]['FIELD_EMAILVALIDATE'] = 'Validate Email Changes';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPEND'] = 'Suspend users after';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPEND_TEMP'] = 'Temp accounts expire after';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPENDMAIN'] = 'Auto suspend user in all pageview';
$lang_admin[$settingspoint]['FIELD_USERS_PER_PAGE'] = '# of users to list per page';
$lang_admin[$settingspoint]['FIELD_NICK_MIN'] = 'Username Min Length';
$lang_admin[$settingspoint]['FIELD_NICK_MAX'] = 'Username Max Length';
$lang_admin[$settingspoint]['FIELD_PASS_MIN'] = 'Password Min Length';
$lang_admin[$settingspoint]['FIELD_PASS_MAX'] = 'Password Max Length';
$lang_admin[$settingspoint]['FIELD_SHOWONLINE'] = 'Maximum shown online time';

$lang_admin[$settingspoint]['OPTION_SUSPEND_DEACTIVATED'] = 'Asla';
$lang_admin[$settingspoint]['OPTION_SUSPEND_WEEK'] = 'Hafta';
$lang_admin[$settingspoint]['OPTION_SUSPEND_WEEKS'] = 'Hafta';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DEACTIVATED'] = 'Asla';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAY'] = 'Gün';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAYS'] = 'Gün';
$lang_admin[$settingspoint]['OPTION_USERS_PER_PAGE'] = 'Kullanıcı';
$lang_admin[$settingspoint]['OPTION_NICK_MIN'] = 'Karakter';
$lang_admin[$settingspoint]['OPTION_NICK_MAX'] = 'Karakter';
$lang_admin[$settingspoint]['OPTION_PASS_MIN'] = 'Karakter';
$lang_admin[$settingspoint]['OPTION_PASS_MAX'] = 'Karakter';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_CHOICE'] = 'Lütfen Seçin';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_SECONDS'] = 'Saniye';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTE'] = 'Dakika';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTES'] = 'Dakika';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_HOUR'] = 'Saat';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERREG'] = 'If set to &rdquo;No&rdquo;, no new user can registrate themselves on your website.<br />Only Administratiors then can add new Users.';
$lang_admin[$settingspoint]['HELP_FIELD_REQUIREADMIN'] = 'If set to &rdquo;Yes&rdquo;, new user accounts only be activated if an Administrator approved this account.';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERDELETE'] = 'If set to &rdquo;Yes&rdquo;, users can deactivate their own account.<br />Otherwise only Administrators can deactivate accounts.';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERTHEME'] = 'If set to &rdquo;No&rdquo;, users are not allowed to change the style.<br />Preview for other themes will be allowed.';
$lang_admin[$settingspoint]['HELP_FIELD_DOUBLECHECKEMAIL'] = 'If set to &rdquo;Yes&rdquo;, a new user must retype his email adress on new registration or on changing his email adress.';
$lang_admin[$settingspoint]['HELP_FIELD_SERVERMAIL'] = 'If set to &rdquo;Yes&rdquo;, an email is send by smtp protocoll. Otherwise it will be sent by sendmail protocoll.';
$lang_admin[$settingspoint]['HELP_FIELD_SENDMAILADD'] = 'If set to &rdquo;Yes&rdquo;, an additional email is sent to the administrative email adresse on every new registration.';
$lang_admin[$settingspoint]['HELP_FIELD_SENDMAILDELETE'] = 'If set to &rdquo;Yes&rdquo;, an additional email is sent to the administrative email adresse if an user deactivates his account.';
$lang_admin[$settingspoint]['HELP_FIELD_USEACTIVATE'] = 'If set to &rdquo;Yes&rdquo;, an email is sent to the new email adress of the user. Only after approving this email, the account is activated.';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWMAILCHANGE'] = 'If set to &rdquo;Yes&rdquo;, an user is able to change his email adress by himself. Otherwise email changes only could be done by an authorized Administrator.';
$lang_admin[$settingspoint]['HELP_FIELD_EMAILVALIDATE'] = 'If set to &rdquo;Yes&rdquo;, email changes would be checked by sending an email to the new given adress. If the user does not approve this link, the change will not be activated.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPENDMAIN'] = 'If set to &rdquo;Yes&rdquo;, every login is checked, if the time given in the next field, is reached. If yes, the account must be reactivated by an Administrator.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND'] = 'Given time after that an user account is deactivated and must be reactivated before an user can login aggain.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND_TEMP'] = 'Given time, a new created account is deleted, if the next step (activation by Administrator or by approving the link sended in the email to the user) is not done.';
$lang_admin[$settingspoint]['HELP_FIELD_USERS_PER_PAGE'] = 'Maximum of users logged in. If the limit is reached, the next login will be denied.';
$lang_admin[$settingspoint]['HELP_FIELD_NICK_MIN'] = 'Minimum number of characters an username must have.<br />A minimum below &rdquo;4&rdquo; is not wise.';
$lang_admin[$settingspoint]['HELP_FIELD_NICK_MAX'] = 'Maximum number of characters an username must have.';
$lang_admin[$settingspoint]['HELP_FIELD_PASS_MIN'] = 'Mimimum length of the user password.<br />A minimum below &rdquo;6&rdquo; is not wise.';
$lang_admin[$settingspoint]['HELP_FIELD_PASS_MAX'] = 'Maximum length of the user password.';
$lang_admin[$settingspoint]['FIELD_SHOWONLINE_HELP'] = 'Maximum time wherein an user will be shown online since his last activity';
?>