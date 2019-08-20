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
   exit('Bu Dosya Yönetim Sistemi Dışından Çağırılamaz!');
}

global $adminpoint;

$lang_admin[$adminpoint]['ADMIN_GO_MAIN']            = 'Ana Yönetim Ekranına Geri Dön';
$lang_admin[$adminpoint]['ADMIN_HEADER']             = 'Database Administration';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTEXT']   = 'Message from Database';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTYPE']   = 'Message Type';
$lang_admin[$adminpoint]['ANALYZE_HEADER_NAME']      = 'Name of the Table';
$lang_admin[$adminpoint]['ANALYZE_HEADER_OP']        = 'Operation';

$lang_admin[$adminpoint]['BACKUP_HEADER_BACKUP']     = 'Yedekleme ?';
$lang_admin[$adminpoint]['BACKUP_HEADER_NAME']       = 'Name of the Table';
$lang_admin[$adminpoint]['BACKUP_INFO_MSG']          = 'All Tables shown here are Tables with content.';
$lang_admin[$adminpoint]['BACKUP_SUBMIT']            = 'Backup Table optimation';
$lang_admin[$adminpoint]['BACKUP_TABLES_BACKUP_MSG'] = 'For those Tables was made a backup';
$lang_admin[$adminpoint]['BACKUP_TABLES_CONFIRM_MSG'] = 'Bu tabloları mı yedeklemek istiyorsunuz ?';

$lang_admin[$adminpoint]['CHECK_ALL']                = 'Tümünü Seç';

$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] = 'We got no informations from the database - mostly we get this error because your database user hasn\'t the correct rights to do so.';
$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT']  = 'You have no access rights for the database to run Statistics';
$lang_admin[$adminpoint]['DATABASE_QUERY_RESULT']    = 'Result of the database request';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_ERROR']   = 'Hata';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_INFO']    = 'Information';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_OP_ANALYZE'] = 'Analiz';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_STATUS']  = 'Status';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_WARNING'] = 'Uyarı';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPACT']    = 'Compakt';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPRESSED'] = 'Sıkıştırılmış';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_DYNAMIC']    = 'Dynamic';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_FIXED']      = 'Fix';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_REDUNDANT']  = 'Redundant';
$lang_admin[$adminpoint]['DELETE_HEADER_DELETE']     = 'Silinsin mi ?';
$lang_admin[$adminpoint]['DELETE_HEADER_NAME']       = 'Name of the Table';
$lang_admin[$adminpoint]['DELETE_SUBMIT']            = 'Confirm Table delete';
$lang_admin[$adminpoint]['DELETE_TABLES_CONFIRM_MSG'] = 'Bu tabloları mı silmek istiyorsunuz ?';
$lang_admin[$adminpoint]['DELETE_TABLES_DELETED_MSG'] = 'Those Tables were deleted';

$lang_admin[$adminpoint]['FILES_QUERY_NO_RESULT']    = 'There are no Backupfiles';

$lang_admin[$adminpoint]['KB']                       = 'KB';

$lang_admin[$adminpoint]['MAIN_HEADER']              = 'Veritabanı Yönetimi';
$lang_admin[$adminpoint]['MB']                       = 'MB';

$lang_admin[$adminpoint]['NONE']                     = 'Yok';

$lang_admin[$adminpoint]['OPTIMIZE_HEADER_NAME']       = 'Tablonun Adı';
$lang_admin[$adminpoint]['OPTIMIZE_HEADER_OPTIMIZE']   = 'İyileştirilsin mi ?';
$lang_admin[$adminpoint]['OPTIMIZE_SUBMIT']            = 'Tablo İyileştirmeyi Onayla';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_CONFIRM_MSG'] = 'Bu Tablolar İyileştirilsin mi ?';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_OPTIMIZED_MSG'] = 'Bu Tablolar İyileştirildi';

$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_DELETE']     = 'Delete File';
$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_VIEW']       = 'View File';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_BACKUP']     = 'Action ?';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_CREATED']    = 'Backup created on';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_NAME']       = 'Name of the file';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_FILE']         = 'Backup File';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_MSG']          = 'All shown Files are stored in includes/cache directory';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_ROWS']         = 'Rows inside Backup';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_TABLES']       = 'Tables inside Backup';
$lang_admin[$adminpoint]['SHOW_BACKUP_SUBMIT']            = 'Eylemi Başlat';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_SIZE'] = 'Veritabanının Boyutu';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_TABLES'] = 'Number of Tables inside the Database';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COLLATION'] = 'Collation';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COMMENT'] = 'Yorum';
$lang_admin[$adminpoint]['STATISTICS_HEADER_FORMAT'] = 'Format';
$lang_admin[$adminpoint]['STATISTICS_HEADER_INCREMENT'] = 'Next Increment';
$lang_admin[$adminpoint]['STATISTICS_HEADER_MAXSIZE'] = 'Maximum allowed Tablesize';
$lang_admin[$adminpoint]['STATISTICS_HEADER_NAME']   = 'Tablo Adı';
$lang_admin[$adminpoint]['STATISTICS_HEADER_ROWS']   = 'Counted Rows';
$lang_admin[$adminpoint]['STATISTICS_HEADER_SIZE']   = 'Size of Table';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TIMESTAMPS'] = 'created on<br />last change on<br />last check on';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TYPE']   = 'Type';
$lang_admin[$adminpoint]['SWITCH_ALL']               = 'Switch all';

$lang_admin[$adminpoint]['TITLE_ANALYZE_DB']         = 'Veritabanını İncele';
$lang_admin[$adminpoint]['TITLE_OPTIMIZE_DB']        = 'Veritabanını İyileştir';
$lang_admin[$adminpoint]['TITLE_SHOW_STATISTICS']    = 'İstatistikleri Görüntüle';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP']      = 'Tabloları Yedekle';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUPED']    = 'Backup made for Tables';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP_SHOW'] = 'Yedekleri Görüntüle';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETE']      = 'Tabloları Sil';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETED']     = 'Tablolar Silindi';
$lang_admin[$adminpoint]['TITLE_TABLES_OPTIMIZED']   = 'Veritabanı İyileştirildi';
$lang_admin[$adminpoint]['TITLE_TABLES_REPAIR']      = 'Tabloları Onar';

$lang_admin[$adminpoint]['UNCHECK_ALL']              = 'Tüm Seçimleri Kaldır';

?>