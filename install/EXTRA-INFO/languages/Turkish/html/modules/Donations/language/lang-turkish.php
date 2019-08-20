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

if(!defined('NUKE_EVO')) { die('Bu dosyaya direkt olarak erişmeniz YASAKLANMIŞTIR...'); }

global $lang_donate;

//Confirm
$lang_donate['COME_BACK'] = 'Bağış yaptıktan sonra PayPal sitesinden buraya geri döndürüldüğünüze <strong>EMİN OLUN!</strong> aksi takdirde bağışınız listeye eklenemez.';
$lang_donate['CONFIRM_DONATION'] = 'Lütfen bağış yapmak istediğiniz tutarı seçiniz %s %s?';
$lang_donate['PAYPAL_BACK'] = 'Geri Dönün '.EVO_SERVER_SITENAME;

//Common
$lang_donate['BREAK'] = ':';
$lang_donate['CONFIRM'] = 'Onayla';
$lang_donate['DONATE'] = 'Bağış';
$lang_donate['DONATIONS'] = 'Bağışlar';

//Errors
$lang_donate['CURRENCY_NF'] = 'Para Birimine ulaşılamadı';
$lang_donate['DON_NF'] = 'Bağışlar okunamadı';
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">HATA!</span><br />';
$lang_donate['FAILED'] = 'Bağışınız Kaydedilemedi!';
$lang_donate['GEN_NF'] = 'Genel Ayarlar okunamadı';
$lang_donate['NO_OR_NEGATIV_VALUE'] = 'Amount is either negative or 0';
$lang_donate['NO_PP_ADD'] = 'PayPal adresi henüz ayarlanmadı';
$lang_donate['PAGE_NF'] = 'Sayfa Ayarları okunamadı';
$lang_donate['VALUES_NF'] = 'Bağış Değerleri okunamadı';

//Help
$lang_donate['HELP_DONATION_ANON'] = 'Kimliğiniz tanınmadan (Yönetici Hariç) bağış yapabilirsiniz.<br /><br /><strong>NOT:</strong> PayPal bilgilerinizi biliyor olacak, 100% gizlilik olası değildir.';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Yaptığınız bağış, <strong>Yönetici Hariç</strong> hiç kimse tarafından görülemez.';
$lang_donate['HELP_DONATION_REGULAR'] = 'Bağışlar herkese görünsün';
$lang_donate['HELP_GOAL'] = 'Bu bir aylık süre için bağış hedefidir.';
$lang_donate['HELP_TOTAL'] = 'Bu yapılan toplam bağış tutarıdır.';

//Index
$lang_donate['MAKE_DONATIONS'] = 'Bağış Yap';
$lang_donate['VIEW_DONATIONS'] = 'Bağışları Göster';

//Make
$lang_donate['AMOUNT'] = 'Hesap';
$lang_donate['DONATE_TO'] = 'Donate to';
$lang_donate['MESSAGE'] = 'Message/Reason';
$lang_donate['OTHER'] = 'Other Amount';
$lang_donate['TYPE'] = 'Type of donation';
$lang_donate['TYPE_ANON'] = 'Misafir';
$lang_donate['TYPE_PRIVATE'] = 'Özel Yap';
$lang_donate['TYPE_REGULAR'] = 'Normal';

//View
$lang_donate['AMOUNT'] = 'Hesap';
$lang_donate['DATE'] = 'Tarih';
$lang_donate['DIFF'] = 'Fark';
$lang_donate['GOAL'] = 'Hedef';
$lang_donate['N/A'] = 'N/A';
$lang_donate['NEXT'] = 'Sonraki';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV'] = 'Önceki';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['USERNAME'] = 'Üye Adı';
$lang_donate['TOTAL'] = 'Toplam';

?>