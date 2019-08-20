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

$lang_admin[$adminpoint]['MODULES_ACTIVATE'] = 'Etkinleştir';
$lang_admin[$adminpoint]['MODULES_ACTIVE'] = 'Eklenti etkinleştirildi.';
$lang_admin[$adminpoint]['MODULES_ADMIN_HEADER'] = 'Nuke-Evolution Eklentiler :: Yönetim Paneli';
$lang_admin[$adminpoint]['MODULES_ALL'] = 'Tümü';

$lang_admin[$adminpoint]['MODULES_BLOCK'] = 'Modulblock';
$lang_admin[$adminpoint]['MODULES_BLOCKS_BOTH'] = 'Both Blocks';
$lang_admin[$adminpoint]['MODULES_BLOCKS_LEFT'] = 'Left Blocks';
$lang_admin[$adminpoint]['MODULES_BLOCKS_NONE'] = 'Yok';
$lang_admin[$adminpoint]['MODULES_BLOCKS_RIGHT'] = 'Right Blocks';
$lang_admin[$adminpoint]['MODULES_BLOCKS_SHOW'] = 'Blokları Göster';

$lang_admin[$adminpoint]['MODULES_CAT_COLLAPSE'] = 'Collapse this category in start? ';
$lang_admin[$adminpoint]['MODULES_CAT_DELETE'] = 'Kategori Sil';
$lang_admin[$adminpoint]['MODULES_CAT_EDIT'] = 'Kategori Düzenle';
$lang_admin[$adminpoint]['MODULES_CAT_IMG'] = 'physical name of this image';
$lang_admin[$adminpoint]['MODULES_CAT_IMG_NOTE'] = 'Category Images must be stored in  <i>images/blocks/modules/</i>.';
$lang_admin[$adminpoint]['MODULES_CAT_LINK_TITLE'] = 'Link Başlığı';
$lang_admin[$adminpoint]['MODULES_CAT_ORDER'] = 'Change Order of the Categories';
$lang_admin[$adminpoint]['MODULES_CAT_TITLE'] = 'Kategori Başlığı';
$lang_admin[$adminpoint]['MODULES_COLLAPSE'] = 'Collapsable Categories ?';
$lang_admin[$adminpoint]['MODULES_CUSTOMTITLE'] = 'Özel Başlık';

$lang_admin[$adminpoint]['MODULES_DEACTIVATE'] = 'Devredışı Bırak';
$lang_admin[$adminpoint]['MODULES_DOUBLECLICK'] = '(Etkinleştirmek veya Devredışı Bırakmak için Çift Tıklayınız)';

$lang_admin[$adminpoint]['MODULES_EDIT'] = 'Eklentiyi Değiştir';
$lang_admin[$adminpoint]['MODULES_ERROR_CAT_NF'] = 'The Category wasn\'t found';
$lang_admin[$adminpoint]['MODULES_ERROR_GROUPS'] = 'You must select one group';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE'] = 'You have to insert Title and Link';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EMPTY'] = 'You have to insert a Title';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EXIST'] = 'The Title you inserted exists<br />Please try again<br /><br />';
$lang_admin[$adminpoint]['MODULES_EXPLAIN'] = 'Please note, if you activate or deactivate a modul here<br />it will be shown for a visitor immediatelly. But you must refresh the screen before you see your changes!';
$lang_admin[$adminpoint]['MODULES_EXPLAIN2'] = 'You <strong>MUST</strong> save the changes of sortorder before they are activated !';

$lang_admin[$adminpoint]['MODULES_FUNCTIONS'] = 'İşlevler';

$lang_admin[$adminpoint]['MODULES_INACTIVE'] = 'Modul is not activated.';
$lang_admin[$adminpoint]['MODULES_INHOME'] = 'Modul shown on Homepage:';

$lang_admin[$adminpoint]['MODULES_LINK'] = 'Is a Link';
$lang_admin[$adminpoint]['MODULES_LINK_DELETE'] = 'Linki Sil';

$lang_admin[$adminpoint]['MODULES_MODULEHOMENOTE'] = 'Modul Titles in bold shows the Modul which is shown on the main page of your Website.<br />As long as this module is the main modul, it couldn\'t be deleted.!<br />If you delete the directory of this module without changing it here, a error message is shown on your main page<br />This Modul is loaded if you click <i>home</i> in a menu.';
$lang_admin[$adminpoint]['MODULES_MODULEINFO'] = 'Bilgi';
$lang_admin[$adminpoint]['MODULES_MVADMIN'] = 'Sadece Yöneticiler';
$lang_admin[$adminpoint]['MODULES_MVALL'] = 'Tüm Ziyaretçiler';
$lang_admin[$adminpoint]['MODULES_MVANON'] = 'Sadece Misafirler';
$lang_admin[$adminpoint]['MODULES_MVGROUPS'] = 'Sadece Grup Üyeleri';
$lang_admin[$adminpoint]['MODULES_MVUSERS'] = 'Sadece Kayıtlı Kullanıcılar';

$lang_admin[$adminpoint]['MODULES_NF_VALUES'] = 'No values available';
$lang_admin[$adminpoint]['MODULES_NOTINMENU'] = 'Define a Module whos name isn\'t be shown in Menu';

$lang_admin[$adminpoint]['MODULES_REFRESH SCREEN'] = 'Ekranı Yenile';

$lang_admin[$adminpoint]['MODULES_SAVECHANGES'] = 'Değişiklikleri Kaydet';
$lang_admin[$adminpoint]['MODULES_SHOW'] = 'Göster';
$lang_admin[$adminpoint]['MODULES_SHOWINMENU'] = 'Menüde Görünsün mü?';

$lang_admin[$adminpoint]['MODULES_TITLE'] = 'Başlık';

$lang_admin[$adminpoint]['MODULES_URL'] = 'URL';

$lang_admin[$adminpoint]['MODULES_VIEW'] = 'Görüntüle';
$lang_admin[$adminpoint]['MODULES_VIEWPRIV'] = 'Bunu kim görebilir';

$lang_admin[$adminpoint]['MODULES_WHATGRDESC'] = 'Hangi Gruplar';
$lang_admin[$adminpoint]['MODULES_WHATGROUPS'] = 'Gruplar';

?>