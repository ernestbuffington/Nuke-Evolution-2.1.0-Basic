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

$lang_admin[$adminpoint]['VERSIONCTL_BACK'] = 'Geri Dön';

$lang_admin[$adminpoint]['VERSIONCTL_CHECKVER'] = 'Sürüm Kontrolu Yapmak İçin Burayı Tıklayın';
$lang_admin[$adminpoint]['VERSIONCTL_CHG'] = 'Nuke-Evolutionun Yeni Bir Sürümü Var';
$lang_admin[$adminpoint]['VERSIONCTL_CHGLOG'] = 'Nuke-Evolution Sürüm Değişiklik Kaydı';
$lang_admin[$adminpoint]['VERSIONCTL_CUR'] = 'Siz En Son Sürümü Kullanıyorsunuz';

$lang_admin[$adminpoint]['VERSIONCTL_Download'] = 'İndir';

$lang_admin[$adminpoint]['VERSIONCTL_ERRCON'] = 'Could not connect to www.nuke-evolution.com';
$lang_admin[$adminpoint]['VERSIONCTL_ERRSQL'] = 'Could not retrieve version from Database';
$lang_admin[$adminpoint]['VERSIONCTL_ERR_CHG'] = 'There was a problem with accessing the Changed Log';
$lang_admin[$adminpoint]['VERSIONCTL_ERR_CON'] = 'Could not connect to <a href="http://www.evo-german.com">Nuke-Evolution</a>';

$lang_admin[$adminpoint]['VERSIONCTL_TITLE'] = 'Nuke-Evolution Sürüm Kontrolcüsü';
$lang_admin[$adminpoint]['VERSIONCTL_TITLE'] = 'Nuke-Evolution Sürümü';

$lang_admin[$adminpoint]['VERSIONCTL_VER'] = 'En Son Sürümün Numarası Şudur:';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONCURRENTINFO'] = 'You are running <strong>Nuke-Evolution %s</strong>.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONFUNCTIONSDISABLED'] = 'Unable to use socket functions.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONLATESTINFO'] = 'The latest available version is <strong>Nuke-Evolution %s</strong>.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONOUTOFDATE'] = 'Your installation does <strong>not</strong> seem to be up to date. Updates are available for your version of Nuke-Evolution, please visit <a href="http://www.nuke-evolution.com/modules.php?name=Downloads" target="blank">http://www.nuke-evolution.com/modules.php?name=Downloads</a> to obtain the latest version.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONSOCKETERROR'] = 'Unable to open connection to Nuke-Evolution Server, reported error is:<br />%s';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONUP2DATE'] = 'Your installation is up to date, no updates are available for your version of Nuke-Evolution.';
$lang_admin[$adminpoint]['VERSIONCTL_VIEW'] = 'Yeni Sürümü Göster';
$lang_admin[$adminpoint]['VERSIONCTL_YOURVER'] = 'Sizin şu anki sürümünüz:';

?>