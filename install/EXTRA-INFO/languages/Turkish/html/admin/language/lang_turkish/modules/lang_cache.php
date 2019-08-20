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
    die('Bu dosyaya direkt olarak erişmeniz YASAKLANMIŞTIR...');
}

global $adminpoint;

$lang_admin[$adminpoint]['CACHENOTALLOWED'] = 'Bu dosyayı görüntüleme yetkiniz yok!';
$lang_admin[$adminpoint]['CACHESAFEMODE'] = 'Sunucunuzda Safe Mode açık, Önbellek işlevi ÇALIŞMAYABİLİR!';

$lang_admin[$adminpoint]['CACHE_BAD'] = 'Önbelleğinizin CHMOD Ayarı Doğru Değil!';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_FAIL'] = 'Kategori silme hatası';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_SUCC'] = 'Kategori başarıyla silindi';
$lang_admin[$adminpoint]['CACHE_CLEAR'] = 'Önbelleği Temizle';
$lang_admin[$adminpoint]['CACHE_CLEARED_FAIL'] = 'Önbellek temizleme hatası';
$lang_admin[$adminpoint]['CACHE_CLEARED_SUCC'] = 'Önbellek başarıyla temizlendi';
$lang_admin[$adminpoint]['CACHE_CLEARNOW'] = 'Şimdi Temizle';
$lang_admin[$adminpoint]['CACHE_DELETE'] = 'Sil';
$lang_admin[$adminpoint]['CACHE_DIR_STATUS'] = 'Önbellek Dizininin Durumu:';
$lang_admin[$adminpoint]['CACHE_DISABLED'] = 'Devredışı';
$lang_admin[$adminpoint]['CACHE_ENABLED'] = 'Devrede';
$lang_admin[$adminpoint]['CACHE_ENABLE_HOW'] = 'Önbelleği devreye almak için, eğer daha önceden yapmadıysanız config.php içindeki \$use_cache değişkenini \"1\" veya \"2\" yapınız.';
$lang_admin[$adminpoint]['CACHE_FILEMODE'] = 'Dosya Önbelleği';
$lang_admin[$adminpoint]['CACHE_FILENAME'] = 'Dosya Adı';
$lang_admin[$adminpoint]['CACHE_FILESIZE'] = 'Dosya Boyu';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_FAIL'] = 'Dosya Silme Hatası';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_SUCC'] = 'Dosya Başarıyla Silindi';
$lang_admin[$adminpoint]['CACHE_GOOD'] = 'İyi';
$lang_admin[$adminpoint]['CACHE_HEADER'] = 'Nuke-Evolution Önbellek :: Yönetim Paneli';
$lang_admin[$adminpoint]['CACHE_HOWTOENABLE'] = 'Nasıl devreye sokulur?';
$lang_admin[$adminpoint]['CACHE_INVALID'] = 'Hatalı İşlem';
$lang_admin[$adminpoint]['CACHE_LASTMOD'] = 'Son Değişiklik';
$lang_admin[$adminpoint]['CACHE_LAST_CLEARED'] = 'Önbelleğin Son Temizlenme Tarihi:';
$lang_admin[$adminpoint]['CACHE_MODE'] = 'Önbellek Türü';
$lang_admin[$adminpoint]['CACHE_NO'] = 'Hayır';
$lang_admin[$adminpoint]['CACHE_NUM_FILES'] = 'Önbelleğe Alınan Dosya Sayısı:';
$lang_admin[$adminpoint]['CACHE_OPTIONS'] = 'Seçenekler';
$lang_admin[$adminpoint]['CACHE_PREF_UPDATED_SUCC'] = 'Ayarlar Başarıyla Güncellendi';
$lang_admin[$adminpoint]['CACHE_RETURN'] = 'Ana Yönetim Ekranına Geri Dön';
$lang_admin[$adminpoint]['CACHE_RETURNCACHE'] = 'Önbellek Yönetimine Geri Dön';
$lang_admin[$adminpoint]['CACHE_SIZE'] = 'Önbellek Boyutu:';
$lang_admin[$adminpoint]['CACHE_SQLMODE'] = 'SQL Önbelleği';
$lang_admin[$adminpoint]['CACHE_STATUS'] = 'Önbellek Durumu:';
$lang_admin[$adminpoint]['CACHE_USER_CAN_CLEAR'] = 'Kullanıcılar Önbelleği Temizleyebilsin mi:';
$lang_admin[$adminpoint]['CACHE_VIEW'] = 'Görüntüle';
$lang_admin[$adminpoint]['CACHE_YES'] = 'Evet';

?>