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

if (!defined('ADMIN_FILE')) {
    die('Bu dosyaya direkt olarak erişmeniz YASAKLANMIŞTIR...');
}

global $adminpoint;

$lang_admin[$adminpoint]['BUTTON_ADMIN_ADD'] = 'Yönetici Oluştur';
$lang_admin[$adminpoint]['BUTTON_ADMIN_CHANGE'] = 'Yönetici Değiştir';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DELETE'] = 'Yönetici Sil';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DOIT'] = 'Tamam';
$lang_admin[$adminpoint]['BUTTON_USER_PROMOTE'] = 'Kullanıcıyı Yetkilendir';

$lang_admin[$adminpoint]['ERROR_ADMIN_WRONGAID'] = 'It seems, that an transition error occured. Please try again.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_INVALID'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" doesn\'t map the specification of a correct email adress in the system.(special characters, spaces a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_LANGUAGE'] = 'It seems, that an transition error occured. We didn\'t find the language in our system.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_AND_SUPER_EMPTY'] = 'No rights permitted - neither as Superadmin nor as Moduladmin';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_NOTEXIST'] = 'One or more of the moduls, rights should be permitted, are not available in our database.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_BADWORD'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" contains not allowed words. Here the changed content';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EXISTS'] = 'There exists an Administrator or an User with this name.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_GOD_CHANGE'] = 'The name for God-Admin isn\'t allowed to be changed';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_INVALID'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" doesn\'t map the specification of a correct name in the system.(special characters, spaces a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_SIZE'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" is %s characters long and therefore shorter than 3 characters or longer than 30 characters. Please note, that some characters are stored multibyte.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD2_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_NOT_MATCH'] = 'The Passwords do not match';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_INVALID'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" doesn\'t map the specification of a correct URL in the system.(special characters, spaces a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_BADWORD'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" contains not allowed words. Here the changed content';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EXISTS'] = 'There exists an Administrator or an User with this name.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_INVALID'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" doesn\'t map the specification of a correct username in the system.(special characters, spaces a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_NOT_EXIST'] = 'The username specified isn\'t in our databse';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_SIZE'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" is %s characters long and therefore shorter than 3 characters or longer than 30 characters. Please note, that some characters are stored multibyte.';
$lang_admin[$adminpoint]['ERROR_DB_INSERT_ADMIN'] = 'An error occured during insertion of the Administrator into the Database.';
$lang_admin[$adminpoint]['ERROR_USER_ISADMIN'] = 'Seçilen kullanıcı zaten yönetici yetkilerine sahip';

$lang_admin[$adminpoint]['FIELDSET_PERMISSIONS'] = 'Yetkiler';
$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'] = 'E-Posta Adresi';
$lang_admin[$adminpoint]['FIELD_ADMIN_LANGUAGE'] = 'Dil';
$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'] = 'Gerçek İsim';
$lang_admin[$adminpoint]['FIELD_ADMIN_NO'] = 'Hayır';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'] = 'Şifre';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'] = 'Şifreyi Onaylayın';
$lang_admin[$adminpoint]['FIELD_ADMIN_URL'] = 'Web Sitesi';
$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'] = 'Üye Adı';
$lang_admin[$adminpoint]['FIELD_ADMIN_YES'] = 'Evet';
$lang_admin[$adminpoint]['FIELD_NOTCHANGEABLE'] = 'Bu Alan Değiştirilemez';

$lang_admin[$adminpoint]['GOD_ADMIN'] = 'Tanrı Yönetici';

$lang_admin[$adminpoint]['HEAD_BACK'] = 'Ana Yönetim Ekranına Geri Dön';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINADD'] = 'Yeni Bir Yönetici Hesabı Oluştur';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINCHANGE'] = 'Yöneticiyi Değiştir';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINDELETE'] = 'Bir Yöneticiyi Sil';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINSHOW'] = 'Yöneticiyi Göster';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_MAIN'] = 'Yöneticilerin Listesi';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_PROMOTEUSER'] = 'Promoting Users to Administrator';
$lang_admin[$adminpoint]['HEAD_TITLE'] = 'Yöneticilerin Yönetimi';
$lang_admin[$adminpoint]['HELP_FIELDSET_PERMISSIONS'] = 'Here you can permit Modulrights for this Administrator. Check every Modul this Administrator should be allowed to administrate.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_EMAIL'] = 'Email Adress of the Administrator. All messages to this Administrator are sent to this Email Adress.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_LANGUAGE'] = 'Like in the Users Profiles, the site language is set for this Administrator.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_NAME'] = 'Input here is obligatory!&lt;br /&gt;The name of the Administrator is stored in all action of him and shown as a Username is shown in the System.&lt;br /&gt;The name isn\'t allowed to exist twice in the System.&lt;br /&gt;It will be checked, if another Administration Account or Username exists with your Input.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD'] = 'The Password has to be between 4 and 12 characters ling - no spaces or special signs allowed.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD2'] = 'To check if in the first Password Field no typewrite error occured.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_SUPERUSER'] = 'Attention!! A Superuser has nearly the same rights as the God-Admin !!&ltbr /&gt;Permit this only if you be shure to do so.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_URL'] = 'Website of the Administrator. We want to disable votings from an Administrator for his own website or content from his website.)';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME'] = 'Input here is obligatory!&lt;br /&gt;The Accountname of the Administrator isn\'t allowed to be twice in the system (not as Adminaccountname nor as Username).';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME_PROMOTE'] = 'This field is not changeable if you promote an User to Administrator, because this field MUST be an existing username';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_PASSWORDCHANGE'] = 'To change Passwords, this field must be checked. After that, the fields are enabled for input';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_SUPERUSER'] = 'If an Administrator is Superuser, no Modulrights have to be permitted, because Superuser are allowed to administrate all Modules';

$lang_admin[$adminpoint]['INFO_ADMIN_GOD_NODELETE'] = 'The Administrator '.$lang_admin[$adminpoint]['GOD_ADMIN'].' cann\'t be deleted';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_AFTERLINK'] = 'to get help for creating strong passwords';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_BEFORELINK'] = 'Burayı';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_CURRENTSTRENGTH'] = 'Şimdiki Zorluk Düzeyi';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_LINK'] = 'Tıklayın';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_MEDIUM'] = 'Orta';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_NOTRATED'] = 'Henüz Ölçülmedi';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONG'] = 'Güçlü';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGER'] = 'Çok Güçlü';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGEST'] = 'Mükemmel';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_WEAK'] = 'Zayıf';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_ADDED'] = 'Yönetici Hesabı başarıyla oluşturuldu';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED'] = 'Yönetici Hesabı başarıyla değiştirildi';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED_LOGOUT'] = 'Değişikliklerin devreye girmesi için önce sistemden çıkış yapmalısınız';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_DELETED'] = 'Yönetici Hesabı başarıyla silindi';
$lang_admin[$adminpoint]['INFO_ADMIN_SUPERUSER_WARN'] = 'Please not our help !!';
$lang_admin[$adminpoint]['INFO_FIELD_NOTCHANGEABLE'] = 'Bu alan değiştirilemez';

$lang_admin[$adminpoint]['MENUE_ADMIN_ADD'] = 'Yeni Yönetici Oluştur';
$lang_admin[$adminpoint]['MENUE_ADMIN_PROMOTE'] = 'Kullanıcıya Yönetici Yetkisi Ver';
$lang_admin[$adminpoint]['MENUE_ADMIN_SHOW'] = 'Yöneticileri Görüntüle';

$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_CHANGE'] = 'Değiştir';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_DELETE'] = 'Sil';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SELECT'] = 'Eylem Seçin';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SHOW'] = 'Görüntüle';
$lang_admin[$adminpoint]['OPTION_ADMIN_PASSWORDCHANGE'] = 'Şifre Değiştirilmek Zorunda';
$lang_admin[$adminpoint]['OPTION_ADMIN_SUPERUSER'] = 'Süper Kullanıcı';
$lang_admin[$adminpoint]['OPTION_ALL_LANGS'] = 'Tüm Diller';

$lang_admin[$adminpoint]['QUEST_ADMIN_CHANGE'] = 'Yönetici Değiştir';
$lang_admin[$adminpoint]['QUEST_ADMIN_DELETE'] = 'Yönetici Sil';

$lang_admin[$adminpoint]['TABLE_ADMIN_ACTION'] = 'Eylem';
$lang_admin[$adminpoint]['TABLE_ADMIN_EMAIL'] = 'E-Posta Adresi';
$lang_admin[$adminpoint]['TABLE_ADMIN_LANGUAGE'] = 'Dil';
$lang_admin[$adminpoint]['TABLE_ADMIN_NAME'] = 'Gerçek İsim';
$lang_admin[$adminpoint]['TABLE_ADMIN_REGDATE'] = 'Kayıt Tarihi';
$lang_admin[$adminpoint]['TABLE_ADMIN_SUPERUSER'] = 'Süper Kullanıcı';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERID'] = 'ID';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERNAME'] = 'Üye Adı';

$lang_admin[$adminpoint]['WARNING_ADMIN_DELETE'] = 'Bu Yönetici Hesabını silmek istediğinizden emin misiniz?';

?>