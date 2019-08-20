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

$lang_admin[$adminpoint]['ADMIN_LOG'] = 'Kayıt Defteri Yönetimi';
$lang_admin[$adminpoint]['ADMIN_LOG_ERRFND'] = 'Kayıt Bulunamadı';

$lang_admin[$adminpoint]['BACK'] = 'Geri Dön';

$lang_admin[$adminpoint]['CLEAR_LOG'] = 'Tüm Girdileri Sil';

$lang_admin[$adminpoint]['HEAD_DATE'] = 'Tarih';
$lang_admin[$adminpoint]['HEAD_IP'] = 'IP';
$lang_admin[$adminpoint]['HEAD_MSG'] = 'Mesaj';
$lang_admin[$adminpoint]['HEAD_TIME'] = 'Saat';

$lang_admin[$adminpoint]['LOG_NOT_OPEN'] = 'Kayıt Dosyası Açılamıyor - İçerdiği Bilgileri FTP Programınızla İnceleyebilirsiniz';
$lang_admin[$adminpoint]['LOG_NO_ENTRY'] = 'Kayıt Dosyası Veri İçermiyor';
$lang_admin[$adminpoint]['LOG_TOBIG'] = 'Kayıt Dosyası 6 MB dan büyük - bellek yetmezliğine sebep olabilir - İçindekilere bakmak için FTP programınızla indirin ve içeriğini inceleyin';

?>