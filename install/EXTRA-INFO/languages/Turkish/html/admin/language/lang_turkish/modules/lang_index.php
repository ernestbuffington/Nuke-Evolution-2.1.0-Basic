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

$lang_admin['INDEX']['ADMIN_LOG'] = 'Güvenlik İzleyicisi';
$lang_admin['INDEX']['ADMIN_LOG_ACK'] = 'Bilgi';
$lang_admin['INDEX']['ADMIN_LOG_CHECKED'] = 'The version was last checked on';
$lang_admin['INDEX']['ADMIN_LOG_CHG'] = '<strong>Your Admin Tracker log <strong>HAS</strong> changed</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERR'] = '<strong>There was a problem checking your log.</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRCHMOD'] = '<strong>Your file is not writeable. Did you do the CHMOD?</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRFND'] = 'Kayıt Dosyası Bulunamadı';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN1'] = 'The Security Tracker logs the following';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN2'] = '<ul><li>Admin account creation</li><li>Failed admin logins</li><li>Intruder Alert</li><li>MySQL Errors</li></ul>';
$lang_admin['INDEX']['ADMIN_LOG_FINE'] = 'Yönetici İzleme Dosyanızda Değişiklik Yok';
$lang_admin['INDEX']['ADMIN_LOG_TITLE'] = 'Yönetici Güvenlik İzleyicisi';
$lang_admin['INDEX']['ADMIN_LOG_VIEW'] = 'Kayıtları Görüntüle';

$lang_admin['INDEX']['ERROR_ERR_OPEN'] = 'error.log dosyası açılamadı';
$lang_admin['INDEX']['ERROR_LOG_CHG'] = '<strong>Your Error Log <strong>HAS</strong> changed</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERR'] = '<strong>There was a problem checking your log.</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRCHMOD'] = '<strong>Dosyanız yazılabilir değil. CHMOD ayarlarını yaptınız mı?</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRFND'] = 'Kayıt Dosyası bulunamadı';
$lang_admin['INDEX']['ERROR_LOG_FINE'] = 'Hata Kayıtları Dosyasında değişiklik yok';
$lang_admin['INDEX']['ERROR_LOG_TITLE'] = 'Hata Kaydedicisi';

$lang_admin['INDEX']['SECURITY_ADMIN_IP_LOCK'] = 'Yönetici IP Kilidi';
$lang_admin['INDEX']['SECURITY_SEC_OFF'] = 'Devredışı';
$lang_admin['INDEX']['SECURITY_SEC_ON'] = 'Devrede';
$lang_admin['INDEX']['SECURITY_SEC_STATUS'] = 'Güvenlik Durumu';
$lang_admin['INDEX']['SECURITY_SENTINEL'] = 'NukeBekçisi(tm)';

$lang_admin['INDEX']['TRACKER_BACK'] = 'Geri Dön';
$lang_admin['INDEX']['TRACKER_CLEAR'] = 'Kayıtları Temizle';
$lang_admin['INDEX']['TRACKER_CLEARED'] = 'Güvenlik izleyicisi kayıtları temizlendi!';
$lang_admin['INDEX']['TRACKER_ERR_OPEN'] = 'admin.log dosyası açılamadı';
$lang_admin['INDEX']['TRACKER_ERR_UP'] = 'Güncelleme başarısız oldu';
$lang_admin['INDEX']['TRACKER_HEAD_DATE'] = 'Tarih';
$lang_admin['INDEX']['TRACKER_HEAD_IP'] = 'IP';
$lang_admin['INDEX']['TRACKER_HEAD_MSG'] = 'Mesaj';
$lang_admin['INDEX']['TRACKER_HEAD_TIME'] = 'Saat';
$lang_admin['INDEX']['TRACKER_UP'] = 'GÜNCELLENDİ';

$lang_admin['INDEX']['VERSIONCTL_TITLE'] = 'Nuke-Evolution Sürüm Kontrolcüsü';

?>