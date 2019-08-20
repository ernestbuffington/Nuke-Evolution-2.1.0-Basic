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

$lang_admin[$adminpoint]['THEMES_ACTIVATE'] = 'Etkinleştir';
$lang_admin[$adminpoint]['THEMES_ACTIVE'] = 'Etkin';
$lang_admin[$adminpoint]['THEMES_ADMINS'] = 'Yöneticiler';
$lang_admin[$adminpoint]['THEMES_ADV_COMP'] = 'Temanız Gelişmiş Özellikler seçeneği ile uyumludur';
$lang_admin[$adminpoint]['THEMES_ADV_OPTS'] = 'Gelişmiş Tema Seçenekleri';
$lang_admin[$adminpoint]['THEMES_ALLOWCHANGE'] = 'Üyeler Kendi Temalarını Seçebilsin mi?';
$lang_admin[$adminpoint]['THEMES_ALLUSERS'] = 'Tüm Kullanıcılar';
$lang_admin[$adminpoint]['THEMES_ATO_KEY'] = 'ATO Anahtarı';

$lang_admin[$adminpoint]['THEMES_CHANGEATO'] = 'ATO Değerlerini Değiştir';
$lang_admin[$adminpoint]['THEMES_CUSTOMN'] = 'Özel İsim';
$lang_admin[$adminpoint]['THEMES_CUSTOMNAME'] = 'Özel Tema İsmi';

$lang_admin[$adminpoint]['THEMES_DB_VALUE'] = 'Etkin Değer';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE'] = 'Devredışı Bırak';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE1'] = 'Bu temayı devredışı bırakmak istediğinizden emin misiniz?';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE2'] = 'This will set ALL users using this theme back to the default theme!';
$lang_admin[$adminpoint]['THEMES_DEFAULT'] = 'Varsayılan Tema';
$lang_admin[$adminpoint]['THEMES_DEFAULT_MISSING'] = 'Varsayılan Tema Kayıp! ';
$lang_admin[$adminpoint]['THEMES_DEFAULT_NOT_FOUND'] = ' was NOT found!';
$lang_admin[$adminpoint]['THEMES_DEFAULT_VALUE'] = 'Temanın Varsayılanları';
$lang_admin[$adminpoint]['THEMES_DEF_LOADED'] = 'Default options are loaded below.';

$lang_admin[$adminpoint]['THEMES_EDIT'] = 'Düzenle';
$lang_admin[$adminpoint]['THEMES_ERROR'] = 'Hata';
$lang_admin[$adminpoint]['THEMES_ERROR_CRITICAL'] = 'Kritik Hata';
$lang_admin[$adminpoint]['THEMES_ERROR_MESSAGE'] = 'Could not gather installed themes';

$lang_admin[$adminpoint]['THEMES_FROM'] = 'Temadan';
$lang_admin[$adminpoint]['THEMES_FUNCTIONS'] = 'İşlevler';

$lang_admin[$adminpoint]['THEMES_GROUPS'] = 'Gruplar';
$lang_admin[$adminpoint]['THEMES_GROUPSONLY'] = 'Gruplara Özel';

$lang_admin[$adminpoint]['THEMES_HEADER'] = 'Nuke-Evolution :: Tema Yönetimi';

$lang_admin[$adminpoint]['THEMES_INACTIVE'] = 'Devredışı';
$lang_admin[$adminpoint]['THEMES_INFO_CHANGEATO'] = '<em>After Installation was successfull, it is a good idea to change ATO Values in Edit Modus</em>';
$lang_admin[$adminpoint]['THEMES_INSTALL'] = 'Kur';
$lang_admin[$adminpoint]['THEMES_INSTALLED'] = 'Kurulmuş Temalar';

$lang_admin[$adminpoint]['THEMES_MAKEDEFAULT'] = 'Varsayılan Yap';
$lang_admin[$adminpoint]['THEMES_MANG_OPTIONS'] = 'Tema Yönetimi Seçenekleri';
$lang_admin[$adminpoint]['THEMES_MOSTPOPULAR'] = 'En Popüler Tema';
$lang_admin[$adminpoint]['THEMES_MULTLANG_COMP'] = 'Temanız Çokdilliliğe Uygundur';

$lang_admin[$adminpoint]['THEMES_NAME'] = 'Tema Adı';
$lang_admin[$adminpoint]['THEMES_NO'] = 'Hayır';
$lang_admin[$adminpoint]['THEMES_NONE'] = 'Yok';
$lang_admin[$adminpoint]['THEMES_NOREALNAME'] = 'N/A';
$lang_admin[$adminpoint]['THEMES_NOT_COMPAT'] = '<font color=\'red\'>Your theme is not compatible with Advanced Features</font>';
$lang_admin[$adminpoint]['THEMES_NOT_MULTLANG_COMP'] = 'Your theme is not multilingual';
$lang_admin[$adminpoint]['THEMES_NUMTHEMES'] = 'Number of Themes';
$lang_admin[$adminpoint]['THEMES_NUMUNINSTALLED'] = 'Number of Uninstalled Themes';
$lang_admin[$adminpoint]['THEMES_NUMUSERS'] = '# of Users';

$lang_admin[$adminpoint]['THEMES_OPTIONS'] = 'Tema Seçenekleri';
$lang_admin[$adminpoint]['THEMES_OPTS'] = 'Seçenekler';

$lang_admin[$adminpoint]['THEMES_PAGE_FIRST'] = 'İlk';
$lang_admin[$adminpoint]['THEMES_PAGE_LAST'] = 'Son';
$lang_admin[$adminpoint]['THEMES_PAGE_NEXT'] = 'Sonraki';
$lang_admin[$adminpoint]['THEMES_PAGE_OF'] = 'to';
$lang_admin[$adminpoint]['THEMES_PAGE_OF_TOTAL'] = 'of';
$lang_admin[$adminpoint]['THEMES_PAGE_PREVIOUS'] = 'Önceki';
$lang_admin[$adminpoint]['THEMES_PERMISSIONS'] = 'Yetkiler';
$lang_admin[$adminpoint]['THEMES_PREVIEW'] = 'Önizleme';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES'] = 'Who is allowed';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS'] = 'Hangi Gruplar';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS_INFO'] = 'View must be SET to Groups Only';
$lang_admin[$adminpoint]['THEMES_PROBLEM'] = 'There seems to be a problem with your theme, please make sure you have a valid theme';

$lang_admin[$adminpoint]['THEMES_QINSTALL'] = 'Hızlı Kur';
$lang_admin[$adminpoint]['THEMES_QUNINSTALLED'] = 'Kaldırıldı';

$lang_admin[$adminpoint]['THEMES_REALNAME'] = 'Realname';
$lang_admin[$adminpoint]['THEMES_REST_DEF'] = 'Varsayılanı Yükle';
$lang_admin[$adminpoint]['THEMES_RETURN'] = 'Tema Yönetimine Geri Dön';
$lang_admin[$adminpoint]['THEMES_RETURNMAIN'] = 'Ana Yönetim Ekranına Geri Dön';
$lang_admin[$adminpoint]['THEMES_RETURN_OPTIONS'] = 'Tema Seçeneklerine Geri Dön';

$lang_admin[$adminpoint]['THEMES_SAVECHANGES'] = 'Değişiklikleri Kaydet';
$lang_admin[$adminpoint]['THEMES_SETTINGS_UPDATED'] = 'Seçenekler Güncellendi!';
$lang_admin[$adminpoint]['THEMES_STATUS'] = 'Durum';
$lang_admin[$adminpoint]['THEMES_SUBMIT'] = 'Gönder';

$lang_admin[$adminpoint]['THEMES_TEXT_AREA'] = 'Yazı Alanı';
$lang_admin[$adminpoint]['THEMES_THEMES'] = 'Temalar';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATE'] = 'Temayı Devredışı Bırak';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED'] = 'Tema Başarıyla Devreden Çıkarıldı!';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED_FAILED'] = 'Temayı Devredışı Bırakma İşlemi Başarısız Oldu!';
$lang_admin[$adminpoint]['THEMES_THEME_INSTALLED'] = 'Tema Kuruldu!';
$lang_admin[$adminpoint]['THEMES_THEME_INSTALLED_FAILED'] = 'Temayı Kurma İşlemi Başarısız Oldu!';
$lang_admin[$adminpoint]['THEMES_THEME_MISSING'] = 'Tema Kayıp!';
$lang_admin[$adminpoint]['THEMES_THEME_TRANSFER'] = 'Tema Taşıma';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALL'] = 'Temayı Kaldır';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED'] = 'Tema Başarıyla Kaldırıldı';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED_FAILED'] = 'Tema Kaldırma Başarısız!';
$lang_admin[$adminpoint]['THEMES_TO'] = 'Temaya';
$lang_admin[$adminpoint]['THEMES_TRANSFER'] = 'Tema Kullanıcılarını Taşı';
$lang_admin[$adminpoint]['THEMES_TRANSFER_UPDATED'] = 'kullanıcı güncellendi!';

$lang_admin[$adminpoint]['THEMES_UNINSTALL'] = 'Kaldır';
$lang_admin[$adminpoint]['THEMES_UNINSTALL1'] = 'Are you sure you wish to uninstall this theme?';
$lang_admin[$adminpoint]['THEMES_UNINSTALL2'] = 'You will lose ALL your settings for this theme!';
$lang_admin[$adminpoint]['THEMES_UNINSTALL3'] = 'This will set ALL users using this theme back to the default theme!';
$lang_admin[$adminpoint]['THEMES_UNINSTALLED'] = 'Kaldırılmış Temalar';
$lang_admin[$adminpoint]['THEMES_UPDATED'] = 'Tema Güncellendi!';
$lang_admin[$adminpoint]['THEMES_UPDATEFAILED'] = 'Tema Güncelleştirme İşlemi Başarısız!';
$lang_admin[$adminpoint]['THEMES_USEREMAIL'] = 'E-Posta';
$lang_admin[$adminpoint]['THEMES_USERID'] = 'Üye ID';
$lang_admin[$adminpoint]['THEMES_USERNAME'] = 'Kullanıcı Adı';
$lang_admin[$adminpoint]['THEMES_USERTHEME'] = 'Tema';
$lang_admin[$adminpoint]['THEMES_USER_MODIFY'] = 'Temayı Düzenle';
$lang_admin[$adminpoint]['THEMES_USER_OPTIONS'] = 'Kullanıcı Seçenekleri';
$lang_admin[$adminpoint]['THEMES_USER_RESET'] = 'Varsayılana Döndür';
$lang_admin[$adminpoint]['THEMES_USER_SELECT'] = 'Kullanıcı Teması Seç';

$lang_admin[$adminpoint]['THEMES_VIEW'] = 'Görüntüle';
$lang_admin[$adminpoint]['THEMES_VIEW_STATS'] = 'İstatistikleri Göster';

$lang_admin[$adminpoint]['THEMES_YES'] = 'Evet';

?>