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

global $lang_donate;

//Common
$lang_donate['ADMIN_HEADER'] = 'Nuke-Evolution Bağışlar :: Eklenti Yönetim Paneli';
$lang_donate['RETURNMAIN'] = 'Ana Yönetim Ekranına Geri Dön';
$lang_donate['DONATIONS'] = 'Bağışlar';
$lang_donate['CURRENT_DONATIONS'] = 'Yapılmış Bağışlar';
$lang_donate['DONATION_VALUES'] = 'Bağış Tutarları';
$lang_donate['CONFIG_BLOCK'] = 'Bloğu Ayarla';
$lang_donate['CONFIG_GENERAL'] = 'Bağışları Ayarla';
$lang_donate['CONFIG_PAGE'] = 'Ayar Sayfası';
$lang_donate['ADD_DONATION'] = 'Bağış Ekle';
$lang_donate['EDIT_DONATION'] = 'Bağışları Düzenle';
$lang_donate['DELETE_DONATION'] = 'Bağışı Sil';
$lang_donate['BREAK'] = ':';
$lang_donate['YES'] = 'Evet';
$lang_donate['NO'] = 'Hayır';
$lang_donate['DONATION_SUBMIT'] = 'Gönder';

//Config Page & Config Block
$lang_donate['SHOW_AMOUNTS'] = 'Show amounts';
$lang_donate['SHOW_GOAL'] = 'Show goal';
$lang_donate['SHOW_ANON_AMNTS'] = 'Show anonymous';
$lang_donate['BUTTON_IMAGE'] = 'Button image';
$lang_donate['NUM_DONATIONS'] = 'Number of donations shown';
$lang_donate['SHOW_DATES'] = 'Bağış Tarihlerini Göster';

//Config Page
$lang_donate['PAGE_HEADER_IMG'] = 'Sayfanın Üstündeki Resim';

//Config Donation
$lang_donate['PP_EMAIL'] = 'PayPal E-Posta Adresi';
$lang_donate['CURRENCY'] = 'Para Birimi';
$lang_donate['DONATION_NAME'] = 'Donation Name';
$lang_donate['DONATION_CODE'] = 'Donation Code';
$lang_donate['MONTHLY_GOAL'] = 'Aylık Hedef';
$lang_donate['DATE_FORMAT'] = 'Tarih Formatı (<a href="http://us3.php.net/date">PHP Tarih Formatı</a>)';
$lang_donate['TYPE'] = 'Type Of Donations';
$lang_donate['TYPE_PRIVATE'] = 'Gizli';
$lang_donate['TYPE_ANON'] = 'İsimsiz';
$lang_donate['TYPE_REGULAR'] = 'Normal';
$lang_donate['THANK_YOU'] = 'Teşekkürler';
$lang_donate['IMAGE'] = 'Resim';
$lang_donate['MESSAGE'] = 'Mesaj';
$lang_donate['CANCEL'] = 'İptal';
$lang_donate['ALLOW_MESSAGE'] = 'Allow Message/Reason';
$lang_donate['SCROLL'] = 'Scrollable donation list';
$lang_donate['NUMBERS'] = 'Show numbers';
$lang_donate['CODES'] = 'Donations codes (Adding more donation types)';
$lang_donate['COOKIE_TRACK'] = 'Track donations with cookies';

//Add Donation
$lang_donate['ADD_DONATION'] = 'Bağış Ekle';
$lang_donate['UNAME'] = 'Username';
$lang_donate['FIRST_NAME'] = 'First Name';
$lang_donate['LAST_NAME'] = 'Last Name';
$lang_donate['EMAIL_ADD'] = 'Email Address';
$lang_donate['DONATION'] = 'Donation';
$lang_donate['ADDED'] = 'Donation added';
$lang_donate['ADD_TYPE'] = 'Type of Donation';
$lang_donate['DONATE_TO'] = 'Donate to';

//Security
$lang_donate['ACCESS_DENIED'] = '<span style="color: #FF0000; font-weight: bold;">Erişim Reddedildi</span>';

//Errors
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">HATA!</span><br />';
$lang_donate['VALUES_NF'] = 'Bağış Değerleri okunamadı';
$lang_donate['VALUES_ND'] = 'Bağış Değerleri görüntülenemedi';
$lang_donate['UNAMES_NF'] = 'Could not find username';
$lang_donate['UINFO_NF'] = 'Could not get user information';
$lang_donate['TYPES_NF'] = 'Could not get donation types';
$lang_donate['MISSING_FNAME'] = 'Please enter a first name';
$lang_donate['MISSING_LNAME'] = 'Please enter a last name';
$lang_donate['INVALID_DONATION'] = 'Please enter a valid donation';
$lang_donate['INVALID_EMAIL'] = 'Please enter a valid email address';
$lang_donate['CODES_SHORT'] = 'You must enter a code name, and a PayPal code in the Donations codes:';
$lang_donate['CODES_SPACES'] = 'Spaces are not allowed in the code';

//Current
$lang_donate['DATE'] = 'Tarih';
$lang_donate['USERNAME'] = 'Kullanıcı Adı';
$lang_donate['AMOUNT'] = 'Aktarım';
$lang_donate['TOTAL'] = 'Toplam';
$lang_donate['GOAL'] = 'Hedef';
$lang_donate['DIFF'] = 'Fark';
$lang_donate['NEXT'] = 'Sonraki';
$lang_donate['PREV'] = 'Önceki';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['N/A'] = 'N/A';

//Help
$lang_donate['HELP_DONATION_ANON'] = 'Everything except the donation is hidden from the admin(s).<br /><br /><strong>NOTE:</strong> PayPal will still have all the information so it is not 100% anonymous';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Donations are hidden from the public but <strong>not</strong> the admin.';
$lang_donate['HELP_DONATION_NAME'] = 'This is the primary donation type';
$lang_donate['HELP_DONATION_CODE'] = 'This is the primary donation type code in Paypal';
$lang_donate['HELP_DONATION_CODES'] = 'This is where you can put in other donation types and codes.  This is <strong>optional</strong>.<br /><br />For example if you wanted to make a code for hospital bills.<hr />The first line is the text '
                                      .'which will show up in the combo box.  Make sure you put something that will make sense to people.  Spaces are allowed.<br />So for this example: Hospital Bills<br /><br />'
                                      .'The next line is the PayPal code you want to use.<br />Spaces are <strong>NOT</strong> allowed!<br />So for this example: hospital_bills<hr />So the final result would be:<br />'
                                      .'Hospital Bills<br />hospital_bills';
$lang_donate['HELP_COOKIE_TRACK'] = 'This will hold donation values in a users cookies.  It adds another way to help track donations.<br /><strong>This should only be used if you are having problems!</strong>';
?>