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

/*****[BEGIN]******************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/
define("_CANNOTCHANGEMODE", "Bu dosyanın modu değiştirilemiyor (%s)");
define("_CANNOTOPENFILE", "Bu dosya açılamıyor (%s)");
define("_CANNOTWRITETOFILE", "Bu dosyaya yazılamıyor (%s)");
define("_CANNOTCLOSEFILE", "Bu dosya kapatılamadı (%s)");
define("_SITECACHED", "Bu Site <strong>ÖnBellek</strong> Sistemini Kullanmaktadır.");
define("_UPDATECACHE", "<strong>ÖnBelleği Güncellemek İçin <blink>Tıklayın</blink>.</strong>");
/*****[END]********************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
define("_ERRORINVEMAIL","HATA: E-Posta Adresi Hatalı");
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/
define("_PERSISTENT","Girişlerde Beni Otomatik Olarak Hatırla");
/*****[END]********************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/
define("_ADMINGROUPS","Grup Düzenle");
define("_MVGROUPS","Sadece Gruplar");
define("_MVSUBUSERS","Sadece Aboneler");
define("_WHATGRDESC","Görüntüleme, Sadece Gruplara Göster olarak ayarlanmalıdır");
define("_WHATGROUPS","Grup Nedir");
define("_GRMEMBERSHIPS","Grup Üyeleri");
define("_GRNONE","Hayır");
/*****[END]********************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/
define("_ADMIN_BLOCK_TITLE","Hızlı Menu");
define("_ADMIN_BLOCK_NUKE","Yönetim [Site Geneli]");
define("_ADMIN_BLOCK_FORUMS","Yönetim [Forumlar]");
define("_ADMIN_BLOCK_LOGOUT","Çıkış");
define("_ADMIN_BLOCK_SETTINGS","Seçenekler");
define("_ADMIN_BLOCK_BLOCKS","Bloklar");
define("_ADMIN_BLOCK_MODULES","Eklentiler");
define("_ADMIN_BLOCK_CNBYA","Üye Yönetimi");
define("_ADMIN_BLOCK_MSGS","Mesajlar");
define("_ADMIN_BLOCK_MODULE_BLOCK","Eklentiler Bloğu");
define("_ADMIN_BLOCK_NEWS","Haber Ekle");
define("_ADMIN_BLOCK_LOGIN","Yönetici Girişi");
define("_ADMIN_BLOCK_WHO_ONLINE","Sitede Kimler Var?");
define("_ADMIN_BLOCK_OPTIMIZE_DB","Veri Tabanı");
define("_ADMIN_BLOCK_DOWNLOADS", "Dosyalar");
define("_ADMIN_BLOCK_EVO_USER", "Üye Hakkında");
define("_ADMIN_BLOCK_WEBLINKS","Web Linkleri");
define("_ADMIN_BLOCK_REVIEWS","İncelemeler");
define("_ADMIN_BLOCK_SYSTEMINFO","Sistem Bilgileri");
define("_ADMIN_BLOCK_ERRORLOG","Hata kayıtları");
define("_CACHE_ADMIN", "ÖnBellek");
define("_CACHE_CLEAR", "ÖnBelleği Temizle");
define("_ADMIN_ID","Yönetici Adı:");
define("_ADMIN_PASS","Şifre:");
define("_ADMINISTRATION","Yönetim");
define("_ADMIN_NO_MODULE_RIGHTS","Bu Eklenti için Yönetici Yetkilerine sahip değilsiniz");
/*****[END]********************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/
define("_URL_SLASH_ERR","Lütfen yazdıklarınızın sonundaki / işaretini kaldırın ");
define("_URL_HTTP_ERR","Lütfen yazdığınız alanın başına http:// ekleyin ");
define("_URL_NHTTP_ERR","Lütfen yazdıklarınızın başındaki http:// yi kaldırın ");
define("_URL_PHP_ERR","Lütfen sona eklediğiniz dosya adını silin ");
define("_URL_MODULE_FORUM_ERR","Lütfen sona eklediğiniz /modules/Forums bölümünü silin ");
/*****[END]********************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/

/*--FNA--*/

/*****[BEGIN]******************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/
define("_STORIES", "Haber Arşivi");
define("_AWL","Web Bağlantıları");
define("_ASUP","Destekleyenler");
define("_AREV","İncelemeler");
define("_ADOWN","Dosyalar");
define("_ABAN", "Reklamlar");
define("_AWU", "Üye Bilgileri");
define("_WAITUSERS", "Bekleyen");
define("_BROKENDOWN","Kayıp Dosya");
define("_BROKENLINKS","Bozuk Link");
define("_BROKENREVIEWS","Kayıp İnceleme");
define("_MODREQDOWN","Dosya Düzeltme");
define("_MODREQLINKS","Link Düzeltme");
define("_MODREQREVIEWS","İnceleme Düzeltme");
define("_WDOWNLOADS","Bekleyen Dosya");
define("_WLINKS","Bekleyen Link");
define("_WREVIEWS","Bekleyen İnceleme");
define("_ABANNERS", "Etkin Reklamlar");
define("_DBANNERS", "Devredışı Reklamlar");
define("_WSUPPORT", "Bekleyen Destekçi");
define("_DSUPPORT", "Devredışı Destekçi");
define("_ASUPPORT", "Etkin Destekçi");
/*****[END]********************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/
define("_NEED_DELETE","Bu dizini");
define("_IS_DELETED","Bu Dizini Sildik");
define("_THE_FOLDER","silmelisiniz");
/*****[END]********************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/
define("_PASS_CONFIRM","Şifreyi Yeniden Girin");
define("_ERROR","Hata");
define("_PASS_NOT_MATCH","İki Şifre birbirini tutmuyor");
/*****[END]********************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Validation                         v1.0.0 ]
 ******************************************************/
define("VALIDATE_ERROR","Bu %s Girdiğiniz %s Geçerli Değil ");
define("VALIDATE_USERNAME","Adınız");
define("VALIDATE_TEXT","Yazı");
define("VALIDATE_FULLNAME","Tam İsim");
define("VALIDATE_NUMBER","Numara");
define("VALIDATE_EMAIL","e-Posta");
define("VALIDATE_URL","URL");
define("VALIDATE_INT","Sayı");
define("VALIDATE_FLOAT","Sayı");
define("VALIDATE_SHORT","Kısa");
define("VALIDATE_LONG","Uzun");
define("VALIDATE_SMALL","Küçük");
define("VALIDATE_BIG","Büyük");
define("VALIDATE_TEXT_SIZE","yazdığınız %s bu %s yeterli değil<br /> %s karakter olmalıdır");
define("VALIDATE_NUMBER_SIZE","Yazdığınız %s bu %s yeterli değil<br /> %s karakter olmalıdır");
define("VALIDATE_WORD"," %s da izin verilmeyen bir sözcük bulundu");
/*****[END]********************************************
 [ Other:  Validation                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
define("PSM_HELP_TITLE","Şifre için Yardım");
define("PSM_NOTRATED","Belirtilmedi");
define("PSM_CURRENTSTRENGTH","Şu anki Zorluk Derecesi: ");
define("PSM_WEAK","Kötü");
define("PSM_MED","Orta");
define("PSM_STRONG","İyi");
define("PSM_STRONGER","Çok İyi");
define("PSM_STRONGEST","Çok İyi, Mükemmel");
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

/*--FNL--*/

/*--CalendarMx--*/

/*****[BEGIN]******************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/
define("_NOSURVEYS", "Anket Yok!");
/*****[END]********************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
define("_NORSS", "Bu RSS dosyası Yüklenirken Hata Oluştu, Dosya Bulunamıyor!");
/*****[END]********************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
define('_COLLAPSE','Bloklar daraltılabilsin mi?');
define('_COLLAPSE_TITLE','başlık');
define('_COLLAPSE_ICON','icon');
define('_COLLAPSE_START','Daraltılabilir bloklar başlangıçta açılsın mı?');
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
******************************************************/

define('_QUERIES','Sorgular:');
define('_DB_TIME','VT Erişim Süresi:');
define('_PAGEFOOTER','[ '._PAGEGENERATION.' %s '._SECONDS.' | '._QUERIES.' %s ]');
define("_THEMES_QUNINSTALLED", "Kaldırıldı");
define("_THEMES", "Temalar");
define("_THEMES_DEFAULT", "Varsayılan Tema");
define('_THEMES_THEME_MISSING', 'Tema Kayıp');
define('_THEMES_ACTIVE', 'Etkin');
define('_THEMES_INACTIVE', 'Devredışı');
define('_ERROR_EMAIL', 'Lütfen Sitenizin ve Forumunuzun e-posta adresini düzeltiniz');
define('_Nice_Try', 'İyi Denemeydi :) ....');
define('_OPTIMIZE_DB','Veritabanı İyileştirildi');
define('_MESSAGE_DIE_TITLE', 'Mesaj Merkezi');

/*****[BEGIN]******************************************
 [ Base:    Log-Errors                         v1.0.0 ]
 ******************************************************/
define('_ERROR_LOG_GENERAL_ERROR','Genel Hata');
define('_ERROR_LOG_GENERAL_INFORMATION','Genel Bilgiler');
define('_ERROR_LOG_CRITICAL_ERROR','Kritik Hata');
define('_ERROR_LOG_HACK_ATTEMPT','Hackleme Girişimi');
define('_ERROR_LOG_SECURITY_BREACH','Güvenlik İhlali');
define('_ERROR_LOG_SCRIPT_ATTACK','Script Saldırısı');
define('_ERROR_LOG_USER','Kullanıcı');
define('_ERROR_LOG_IP','IP');
define('_ERROR_LOG_INVALID_IP_YA','used invalid IP address attempted to access the YA admin area');
define('_ERROR_LOG_INVALID_IP_FORUM','used invalid IP address attempted to access the forum admin area');
define('_ERROR_LOG_INVALID_IP_ADMIN','used invalid IP address attempted to access the admin area');
define('_ERROR_LOG_BLOCKED_HTML_TAG_TEXT','An attempt has been made to use a blocked HTML tag.');
define('_ERROR_LOG_BLOCKED_HTML_TAG_STRING','Blocked String:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_SOURCE','Kaynak:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_ECHOMSG','is an XSS and was blocked in:');
define('_ERROR_LOG_THEME_MISSING_1','Varsayılan temanız kayıp!');
define('_ERROR_LOG_THEME_MISSING_2','bulunamadı!');
define('_ERROR_LOG_GOD_ADMIN_CREATED','Tanrı Yönetici oluşturuldu:');
define('_ERROR_LOG_WRONG_MODUL_PATH','Hatalı bir Eklenti Yolu kullanıldı');
define('_ERROR_LOG_WRONG_ADMIN_ACCOUNT','Attempted to login with');
define('_ERROR_LOG_ADMIN_NO_USERNAME','Attempted to login to the admin area with no username');
define('_ERROR_LOG_ADMIN_NO_PASSWORD','Attempted to login to the admin area with no password');
define('_ERROR_LOG_ADMIN_NO_USER_PASSWORD','Attempted to login to the admin area with no username and password');
define('_ERROR_LOG_BUT_FAILED','but failed');
define('_ERROR_LOG_INTRUDER_ALERT','Caused an Intruder Alert');
/*****[END]********************************************
 [ Base:    Log-Errors                         v1.0.0 ]
******************************************************/

define('EVO_TOOLTIP_INFO', 'Bilgi...');
define('EVO_TOOLTIP_ALERT', 'Uyarı...');
define('EVO_TOOLTIP_WIKI', 'Wiki...');
define('EVO_TOOLTIP_MSN', 'MSN...');

?>