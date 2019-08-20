<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

if(!defined('NUKE_EVO')) { die('Bu dosyaya direkt olarak erişmeniz YASAKLANMIŞTIR'); }

global $supporter_config, $module_name;

$lang_new[$module_name]['SP_ACTIVATE'] = 'Etkinleştir';
$lang_new[$module_name]['SP_ACTIVESITES'] = 'Etkin Siteler';
$lang_new[$module_name]['SP_ADDED'] = 'Eklendi';
$lang_new[$module_name]['SP_ADDSUPPORTER'] = 'Bir Destekçi Ekle';
$lang_new[$module_name]['SP_ADMINMAIN'] = 'Destekleyenler Yönetimi';
$lang_new[$module_name]['SP_ADMIN_HEADER'] = 'Nuke-Evolution Supporters :: Eklenti Yönetim Paneli';
$lang_new[$module_name]['SP_ALLREQ'] = 'Tüm Alanlar Gereklidir';
$lang_new[$module_name]['SP_APPROVE'] = 'Onayla';
$lang_new[$module_name]['SP_APPROVESITE'] = 'Siteyi Onayla';
$lang_new[$module_name]['SP_BESUPPORTER'] = 'Destekçi Ol';
$lang_new[$module_name]['SP_CONFBANN'] = 'Bad Upload';
$lang_new[$module_name]['SP_CONFIGMAIN'] = 'Destekleyenler Ayarları';
$lang_new[$module_name]['SP_DBERROR1'] = 'ERROR: Failed to write to database';
$lang_new[$module_name]['SP_DEACTIVATE'] = 'Devredışı Bırak';
$lang_new[$module_name]['SP_DELETESITE'] = 'Siteyi Sil';
$lang_new[$module_name]['SP_DESCRIPTION'] = 'Açıklama';
$lang_new[$module_name]['SP_EDITED'] = 'Last change';
$lang_new[$module_name]['SP_EDITED_USER'] = 'changed by';
$lang_new[$module_name]['SP_EDITSITE'] = 'Siteyi Düzenle';
$lang_new[$module_name]['SP_FILETYPERROR'] = 'Hatalı Dosya Türü. Sadece resim (gif, jpg, jpeg, png, swf) dosyaları yükleyebilirsiniz';
$lang_new[$module_name]['SP_GOTOADMIN'] = 'Destekleyenler Yönetimi';
$lang_new[$module_name]['SP_IMAGE'] = 'Site Resmi';
$lang_new[$module_name]['SP_IMAGETYPE'] = 'Image Link Type';
$lang_new[$module_name]['SP_IMAGETYPE0'] = 'This is an Image URL !';
$lang_new[$module_name]['SP_IMAGETYPE1'] = 'The image is uploaded from your pc!';
$lang_new[$module_name]['SP_IMAGE_UPLOAD'] = 'Site Image Upload <br /><small>If both Image possibilities are set, Upload will be preferenced</small>';
$lang_new[$module_name]['SP_IMAGE_URL'] = 'Site Image URL';
$lang_new[$module_name]['SP_INACTIVESITES'] = 'Devredışı Siteler';
$lang_new[$module_name]['SP_LINKED'] = 'Linked';
$lang_new[$module_name]['SP_MAXHEIGHT'] = 'En Fazla Resim Yüksekliği';
$lang_new[$module_name]['SP_MAXWIDTH'] = 'En Fazla Resim Genişliği';
$lang_new[$module_name]['SP_MISSINGDATA'] = 'You are missing submission data!';
$lang_new[$module_name]['SP_MUSTBE'] = 'Images larger than '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' will be resized to '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' on display';
$lang_new[$module_name]['SP_NAME'] = 'Site Adı';
$lang_new[$module_name]['SP_NOACTIVESITES'] = 'Şu an için Etkin Bir Site yok.';
$lang_new[$module_name]['SP_NOINACTIVESITES'] = 'Devredışı Bir Site yok.';
$lang_new[$module_name]['SP_NOSUBMITTEDSITES'] = 'Şu an için Gönderilmiş Bir Site yok.';
$lang_new[$module_name]['SP_NOUPLOAD'] = 'Resim düzgün bir şekilde yüklenemedi.';
$lang_new[$module_name]['SP_REQUIREUSER'] = 'Üyelik Gereklidir';
$lang_new[$module_name]['SP_RETURNMAIN'] = 'Ana Yönetim Ekranına Geri Dön';
$lang_new[$module_name]['SP_SAVECHANGES'] = 'Değişiklikleri Kaydet';
$lang_new[$module_name]['SP_SITEID'] = 'Site ID';
$lang_new[$module_name]['SP_SUBMITSITE'] = 'Site Gönder';
$lang_new[$module_name]['SP_SUBMITTED'] = 'Gönderildi';
$lang_new[$module_name]['SP_SUBMITTEDSITES'] = 'Gönderilmiş Siteler';
$lang_new[$module_name]['SP_SUPPORTEDBY'] = 'Supported by';
$lang_new[$module_name]['SP_SUPPORTERS'] = 'Supporters';
$lang_new[$module_name]['SP_SURE2DELETE'] = 'Are you sure you want to delete this site?';
$lang_new[$module_name]['SP_UPLOAD'] = 'Yükle';
$lang_new[$module_name]['SP_UPLOADERROR'] = 'File wasn\'t uploaded';
$lang_new[$module_name]['SP_URL'] = 'Site URL';
$lang_new[$module_name]['SP_USEREMAIL'] = 'User Email';
$lang_new[$module_name]['SP_USERID'] = 'User ID';
$lang_new[$module_name]['SP_USERIP'] = 'User IP';
$lang_new[$module_name]['SP_USERNAME'] = 'Kullanıcı Adı';
$lang_new[$module_name]['SP_VISITS'] = 'Visits';
$lang_new[$module_name]['SP_YOUDELETE'] = 'You are about to delete the site';
$lang_new[$module_name]['SP_YOUREMAIL'] = 'E-Posta Adresiniz';
$lang_new[$module_name]['SP_YOURIP'] = 'IP Adresiniz';
$lang_new[$module_name]['SP_YOURNAME'] = 'Adınız';

?>