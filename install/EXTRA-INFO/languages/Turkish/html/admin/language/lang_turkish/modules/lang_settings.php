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

$lang_admin[$adminpoint]['BUTTON_BACK'] = 'Geri Dön';
$lang_admin[$adminpoint]['BUTTON_BACK_SETTINGS'] = 'Ayarlar Menüsüne Geri Dön';

$lang_admin[$adminpoint]['ERROR'] = 'Hata';
$lang_admin[$adminpoint]['ERROR_FUNCTION_NOT_EXISTS'] = 'A function was selected which doesn\'t exists';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR'] = 'Your .htaccess file doesn\'t have a Rewrite Statement<br />More help about in our Wiki';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_ERROR_OPEN'] = 'The file .htaccess couldn\'t be opened';
$lang_admin[$adminpoint]['ERROR_LAZY_TAP_NF'] = 'Your .htaccess file isn\'t activated<br />More help about in our Wiki';
$lang_admin[$adminpoint]['ERROR_MODULE_FIELD_WRONG'] = 'There is an error inside the settings module';
$lang_admin[$adminpoint]['ERROR_NO_DBFIELD'] = 'No Field for Table is specified for';
$lang_admin[$adminpoint]['ERROR_NO_TABLE'] = 'No Table is specified for';
$lang_admin[$adminpoint]['ERROR_UPDATE_DBFIELD'] = 'Update failed for field';

$lang_admin[$adminpoint]['INFO_DBUPDATE_SUCCESSFULL'] = 'Güncelleme başarılı';
$lang_admin[$adminpoint]['INFO_MESSAGE'] = 'Not';

$lang_admin[$adminpoint]['SETTINGS_ADMIN_HEADER'] = 'Evolution Ayarları';

?>