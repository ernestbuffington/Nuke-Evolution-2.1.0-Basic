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

global $adminpoint, $evoconfig;

$lang_admin[$adminpoint]['NEWSLETTER_BACKMAIN'] = 'Ana Yönetim Ekranına Geri Dön';

$lang_admin[$adminpoint]['NEWSLETTER_DISCARD'] = 'Vazgeç';

$lang_admin[$adminpoint]['NEWSLETTER_ERROR_NOT_SET'] = '%s isn\'t set';

$lang_admin[$adminpoint]['NEWSLETTER_FROM'] = 'kimden';

$lang_admin[$adminpoint]['NEWSLETTER_HELLO'] = 'Merhaba';

$lang_admin[$adminpoint]['NEWSLETTER_MAILCONTENT'] = 'E-Posta İçeriği';
$lang_admin[$adminpoint]['NEWSLETTER_MANYUSERSNOTE'] = 'Because many Recipients are choosen, it could need some minutes before the action is finished<br />Please be patient !';
$lang_admin[$adminpoint]['NEWSLETTER_MUSERGROUPWILLRECEIVE'] = 'Usergroups will recieve this News';

$lang_admin[$adminpoint]['NEWSLETTER_NEWSLETTERSENT'] = 'Bülteniniz Gönderildi';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ADMINS'] = 'Yöneticiler';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ALLUSERS'] = 'Tüm Kullanıcılar';
$lang_admin[$adminpoint]['NEWSLETTER_NL_NOUSERS'] = 'Seçtiğiniz bu grupta hiç üye yok<br />Lütfen geri dönün ve başka bir grup seçin';
$lang_admin[$adminpoint]['NEWSLETTER_NL_RECIPS'] = 'Alıcılar';
$lang_admin[$adminpoint]['NEWSLETTER_NL_REGARDS'] = 'With best regards';
$lang_admin[$adminpoint]['NEWSLETTER_NLUNSUBSCRIBE'] = '<u>Please note:</u><br />Your got this newsletter because you had agreed to receive them during your registration process on our website. <br /><br />You can stop this at anytime by change it in your userprofil. Please set in your user profile under settings NEWSLETTER BY MAIL - on NO<br /><br />You be welcome if you need help. Please send an email to our <a href="mailto:'.$evoconfig['adminmail'].'">administrative Account</a>")';
$lang_admin[$adminpoint]['NEWSLETTER_NUSERWILLRECEIVE'] = 'Bu Bülteni alacak olan Üyeler';

$lang_admin[$adminpoint]['NEWSLETTER_PREVIEW'] = 'Önizleme';

$lang_admin[$adminpoint]['NEWSLETTER_REVIEWTEXT'] = 'Before sending - check your News (also for typewrite mistakes)';

$lang_admin[$adminpoint]['NEWSLETTER_SEND'] = 'Bülteni Gönder';
$lang_admin[$adminpoint]['NEWSLETTER_SUBSCRIBEDUSERS'] = 'Abone Kullanıcılar';
$lang_admin[$adminpoint]['NEWSLETTER_STAFF'] = 'Takım';
$lang_admin[$adminpoint]['NEWSLETTER_SUBJECT'] = 'Konu';

$lang_admin[$adminpoint]['NEWSLETTER_TITLE'] = 'Bülten';

?>