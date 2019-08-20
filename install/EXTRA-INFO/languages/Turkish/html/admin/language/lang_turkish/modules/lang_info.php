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

$lang_admin[$adminpoint]['INFO_HEAD_TITLE'] = 'Sistem Bilgileri';

$lang_admin[$adminpoint]['INFO_MYSQL_EXTENDED'] = 'Ayrıntılı Durum';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES'] = 'Çalışan İşlevler';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_COMMAND'] = 'Komut';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_DATABASE'] = 'Veritabanı';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_HOST'] = 'Sunucu';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_ID'] = 'ID';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_INFO'] = 'Bilgi';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_STATE'] = 'Durum';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_TIME'] = 'Saat';
$lang_admin[$adminpoint]['INFO_MYSQL_RUN_PROCESSES_USER'] = 'Kullanıcı';

$lang_admin[$adminpoint]['INFO_TITLE_GENERALINFO'] = 'Genel Bilgiler';
$lang_admin[$adminpoint]['INFO_TITLE_MYSQL'] = 'MySQL Bilgileri';
$lang_admin[$adminpoint]['INFO_TITLE_PHPCORE'] = 'PHP Çekirdeğine Ait Bilgiler';
$lang_admin[$adminpoint]['INFO_TITLE_PHPENVIRONMENT'] = 'PHP Çevre Değişkenleri';
$lang_admin[$adminpoint]['INFO_TITLE_PHPMODULES'] = 'PHP Eklentileri';
$lang_admin[$adminpoint]['INFO_TITLE_PHPVARIABLES'] = 'PHP Değişkenleri';

$lang_admin[$adminpoint]['MESSAGES_RETURNMAIN'] = 'Ana Yönetim Ekranına Geri Dön';

?>