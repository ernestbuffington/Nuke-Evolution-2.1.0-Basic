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

define("_CHARSET","UTF-8");
define("_LANG_DIRECTION","ltr");
define("_SEARCH","Ara");
define("_SUBMIT","Gönder");
define("_REFRESH_SEC_CODE","Güvenlik Kodunu Yenile");
define("_CONFIRM", "Onayla");
define("_PROFILE","Üye Bilgileri");
define("_LOGIN","Giriş");
define("_VIEWING","Görüntülüyor");
define("_WRITES","yazdı:");
define("_APPROVEDBY","Onaylayan:");
define("_POSTEDON","Gönderildiği Zaman:");
define("_NICKNAME","Üye Adı:");
define("_PASSWORD","Şifre");
define("_WELCOMETO","Hoşgeldiniz:");
define("_EDIT","Düzenle");
define("_DELETE","Sil");
define("_POSTEDBY","Gönderen:");
define("_READS","Okunma:");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\"><strong>Geri Dön</strong></a> ]");
define("_BACK","Geri Dön");
define("_COMMENTS","yorumlar");
define("_PASTARTICLES","Son Başlıklar");
define("_OLDERARTICLES","Eski Başlıklar");
define("_BY","_");
define("_ON","~");
define("_LOGOUT","Çıkış");
define("_WAITINGCONT","Bekleyen İçerik");
define("_SUBMISSIONS","Gönderilenler");
define("_EPHEMERIDS","Geçiciler");
define("_ONEDAY","Bu günkü gibi bir gündü...");
define("_ASREGISTERED","Şu an bir hesabınız yok mu? Buradan, çabucak <strong><blink><a href=\"modules.php?name=Your_Account&amp;op=new_user\">Yeni Bir Üyelik</a></blink></strong> oluşturabilirsiniz. Kayıtlı bir üyemiz olarak tema değiştirebilme, isminizle yorum yapabilme gibi ayrıcalıklar edineceksiniz.");
define("_MENUFOR","Menü:");
define("_NOBIGSTORY","Bu gün için Yeni Bir Makale yok.");
define("_BIGSTORY","Bu günün En Çok Okunan haberi:");
define("_SURVEY","Anket");
define("_POLLS","Oylama");
define("_PCOMMENTS","Yorumlar:");
define("_RESULTS","Sonuçlar");
define("_HREADMORE","daha fazlası...");
define("_CURRENTLY","Şu anda burada,");
define("_GUESTS","misafir ve");
define("_MEMBERS","üye bulunuyor.");
define("_YOUARELOGGED","Merhaba");
define("_YOUHAVE","Şu anda");
define("_PRIVATEMSG","Özel Mesajınız Var.");
define("_YOUAREANON","Henüz üye değilseniz, <a href=\"modules.php?name=Your_Account&amp;op=new_user\"><strong><blink>Buraya</blink></strong></a> tıklayarak ücretsiz kayıt olabilirsiniz.");
define("_NOTE","Not:");
define("_ADMIN","Yönetici:");
define("_WERECEIVED","Şu ana kadar");
define("_PAGESVIEWS","sayfa görüntülendi. Başlangıç:");
define("_TOPIC","Konu");
define("_UDOWNLOADS","İndirme");
define("_VOTE","Oy");
define("_VOTES","Toplam Oy");
define("_MVIEWADMIN","Görebilenler: Sadece Yöneticiler");
define("_MVIEWUSERS","Görebilenler: Sadece Kayıtlı Kullanıcılar");
define("_MVIEWANON","Görebilenler: Sadece Misafir Ziyaretçiler");
define("_MVIEWGROUP","Görebilenler: Sadece Gruplar");
define("_MVIEWALL","Görebilenler: Tüm Ziyaretçiler");
define("_EXPIRELESSHOUR","İmha: 1 saat içinde");
define("_EXPIREIN","İmha:");
define("_HTTPREFERERS","HTTP Gönderenler");
define("_UNLIMITED","Sınırsız");
define("_HOURS","Saat");
define("_RSSPROBLEM","Şu anda bu sitenin Haber Başlıklarında bir sorun var");
define("_SELECTLANGUAGE","Dil Seçiniz");
define("_SELECTGUILANG","Arabirim Dilini Seçiniz:");
define("_LANG_NO_MULTILINGUAL","Bu Site Çokdilliliği Desteklememektedir");
define("_NONE","Yok");
define("_BLOCKPROBLEM","<center>Şu anda bu bloğun bir sorunu var.</center>");
define("_BLOCKPROBLEM2","<center>Şu anda bu bloğun bir içeriği yok.</center>");
define("_MODULENOTACTIVE","Üzgünüz, bu Eklenti henüz etkinleştirilmemiş!");
define("_MODULEDOESNOTEXIST","Üzgünüz, böyle bir Eklenti YOK!");
define("_NOACTIVEMODULES","Devredışı Eklentiler");
define("_FORADMINTESTS","(Yönetici testleri için)");
define("_BBFORUMS","Forumlar");
define("_ACCESSDENIED", "Erişim Reddedildi");
define("_RESTRICTEDAREA", "Erişim Kısıtlaması olan bir alana ulaşmaya çalışıyorsunuz.");
define("_MODULEUSERS", "Özür dileriz, Sitemizin bu bölümü <em>Sadece Üyelerimiz</em> içindir.<br /><br />Ücretsiz ve kolayca <a href=\"modules.php?name=Your_Account&amp;op=new_user\">Buraya</a>, tıklayarak üye olabilirsiniz<br />daha sonra bu bölüme kısıtlamalarla karşılaşmadan erişebileceksiniz. Teşekkürler.<br /><br />");
define("_MODULESADMINS", "Özür dileriz, Sitemizin bu bölümü <em>Sadece Yöneticiler</em> içindir.<br /><br />");
define("_HOME","Ana Sayfa");
define("_HOMEPROBLEM","Önemli bir sorunumuz var: Ana Sayfa yok!!!");
define("_ADDAHOME","Ana Sayfaya bir Eklenti ekleyin");
define("_HOMEPROBLEMUSER","Şu anda Ana Sayfamızda bir sorun var. Lütfen daha sonra tekrar deneyiniz.");
define("_MORENEWS","Devamı Haberler Bölümünde");
define("_ALLCATEGORIES","Tüm Kategoriler");
//define("_DATESTRING","%A, %B %d, %Y @ %T %Z");
//define("_DATESTRING2","%A, %B %d");
define('_DATESTRING','%A, %B %d, %Y (%H:%M:%S)');
define('_DATESTRING2','%A, %B %d');
define('_DATESTRING3','%d-%b-%Y');
define('_DATESTRING4','%1$s, %2$s %3$s');
define("_DATE","Tarih");
define("_HOUR","Saat");
define("_UMONTH","Ay");
define("_YEAR","Yıl");
define("_JANUARY","Ocak");
define("_FEBRUARY","Şubat");
define("_MARCH","Mart");
define("_APRIL","Nisan");
define("_MAY","Mayıs");
define("_JUNE","Haziran");
define("_JULY","Temmuz");
define("_AUGUST","Ağustos");
define("_SEPTEMBER","Eylül");
define("_OCTOBER","Ekim");
define("_NOVEMBER","Kasım");
define("_DECEMBER","Aralık");
define("_BWEL","Hoşgeldin");
define("_BLOGOUT","Çıkış");
define("_BPM","Özel Mesajlar");
define("_BUNREAD","Okunmamış");
define("_BREAD","Okunmuş");
define("_BSAVED","Kaydedildi");
define("_BTT","Toplam");
define("_BMEMP","Üyelik");
define("_BLATEST","Son Üye");
define("_BTD","Bugün Yeni");
define("_BYD","Dün Yeni");
define("_BOVER","Toplam");
define("_BVISIT","Şu Anda Bağlı");
define("_BVIS","Ziyaretçi");
define("_BMEM","Üye");
define("_BON","Şu Anda Bağlı");
define("_BOR","ya da");
define("_BPLEASE","Lütfen");
define("_BREG","Kayıt Olun");
define("_BROADCAST","Genel Mesaj Yayınla");
define("_BROADCASTFROM","Genel Mesaj:");
define("_TURNOFFMSG","Genel Mesajları Kapat");
define("_JOURNAL","Günlük");
define("_READMYJOURNAL","Günlüğümü Oku");
define("_ADD","Ekle");
define("_YES","Evet");
define("_NO","Hayır");
define("_INVISIBLEMODULES","Görünmez Eklentiler");
define("_ACTIVEBUTNOTSEE","(Etkin ama görünmeyen linkler)");
define("_THISISAUTOMATED","Bu, sitemizdeki banner reklam yayınınızın şu an itibari ile bittiğini bildiren otomatik bir mesajdır.");
define("_THERESULTS","Reklamınızın sonuçları aşağıdadır:");
define("_TOTALIMPRESSIONS","Yapılan Toplam Gösterim:");
define("_CLICKSRECEIVED","Alınan Tıklama:");
define("_IMAGEURL","Grafik Adresi(URL)");
define("_CLICKURL","Tıklama Adresi(URL):");
define("_ALTERNATETEXT","Alternatif Metin:");
define("_HOPEYOULIKED","Servisimizden memnun kaldığınızı umuyoruz. Sizi tekrar reklam müşterimiz olarak görmeyi diliyoruz.");
define("_THANKSUPPORT","Desteğiniz için Teşekkürler");
define("_TEAM","Takımı");
define("_BANNERSFINNISHED","Bitmiş Reklamlar");
define("_PAGEGENERATION","Sayfa Üretimi:");
define("_MEMORYUSAGE","Bellek Kullanımı: ");
define("_DBQUERIES","VT Sorgusu: ");
//define('_PAGEFOOTER','Bu sayfa %1$s saniyede, %2$s VT Sorgusu %3$s saniyede çalıştırılarak üretilmiştir');
define("_SECONDS","Saniye");
define("_YOUHAVEONEMSG","1 Yeni Özel Mesajınız Var");
define("_NEWPMSG","Yeni Özel Mesajınız Var");
define("_CONTRIBUTEDBY","Katkıda bulunan");
define("_CHAT","Sohbet");
define("_REGISTERED","Kayıtlı");
define("_CHATGUESTS","Ziyaretçiler");
define("_USERSTALKINGNOW","Kullanıcı Sohbet Ediyor");
define("_ENTERTOCHAT","Sohbete Katıl");
define("_CHATROOMS","Geçerli Sohbet Odaları");
define("_SECURITYCODE","Güvenlik Kodu");
define("_TYPESECCODE","Güvenlik Kodunu Girin");
define("_ASSOTOPIC","İlgili Konular");
define("_ADDITIONALYGRP","Bu eklentiyi ilgili Üye Grubu görebilir");
define("_YOUHAVEPOINTS","Site içeriğimize katkıda bulunarak kazandığınız Puanlar:");
define("_MVIEWSUBUSERS","Görebilenler: Sadece Aboneler");
define("_MODULESSUBSCRIBER","Üzgünüz, Sitemizin Bu Bölümü <strong><blink><em>Abone Üyelerimize Özel</em></blink></strong>dir.");
define("_MODULESGROUP","Üzgünüz, sitemizin bu bölümü <blink><em>Grup Üyelerine</em></blink> özeldir.");
define("_SUBHERE","<a href=\"$subscription_url\"><strong><blink>Buraya</blink></strong></a> tıklayarak servislerimize abone olabilirsiniz.");
define("_SUBEXPIRED","Aboneliğiniz Sona Ermiştir");
define("_HELLO","Merhaba");
define("_SUBSCRIPTIONAT","Bu mesaj aboneliğiniz hakkında bilgi vermek için gönderilmiştir.");
define("_HASEXPIRED","aboneliğinizin sona erdiğini bildirmek için otomatik olarak gönderilmiştir.");
define("_HOPESERVED","Servislerimizden memnun kaldığınızı umuyoruz...");
define("_SUBRENEW","Aboneliğinizi yenilemek isterseniz lütfen şu adresi ziyaret edin:");
define("_YOUARE","");
define("_SUBSCRIBER","Abonelik süreniz");
define("_OF",":");
define("_SBYEARS","yıl");
define("_SBYEAR","yıl");
define("_SBMINUTES","dakika");
define("_SBHOURS","saat");
define("_SBSECONDS","saniye");
define("_SBDAYS","gün");
define("_SUBEXPIREIN","Aboneliğinizin bitiş tarihi:");
define("_NOTSUB","Abonemiz değilsiniz:");
define("_NOTSUBUSR","Abonesi değilsiniz");
define("_SUBFROM","Hemen abone olmak için,");
define("_HERE","Buraya");
define("_NOW","Şimdi Tıklayın!");
define("_ADMSUB","Üye Abone!");
define("_ADMNOTSUB","Üye Abone Değil");
define("_ADMSUBEXPIREIN","Aboneliğin Bitiş Tarihi:");
define("_LASTIP","Üyenin Son IP Adresi:");
define("_LASTVISIT","Son Ziyaretiniz:");
define("_LASTNA","N/A");
define("_BANTHIS","Bu IP Adresini Engelle");
define("_ADMIN_BLOCK_DENIED", "Bu bloğun içeriğini görüntüleme hakkına sahip değilsiniz");
define("_NEWSLETTERBLOCKSUBSCRIBED", "Haber Bültenimize Abonesiniz");
define("_NEWSLETTERBLOCKREGISTER", "Haber Bültenimizi almak için Üye Olmalısınız");
define("_NEWSLETTERBLOCKREGISTERNOW", "Üye olmak için Tıklayın");
define("_NEWSLETTERBLOCKNOTSUBSCRIBED", "Haber Bültenimize Abone değilsiniz");
define("_NEWSLETTERBLOCKSUBSCRIBE", "Abone olmak için TIKLAYIN");
define("_NEWSLETTERBLOCKUNSUBSCRIBE", "Aboneliğinizi bitirmek için TIKLAYIN");
define("_ANONYMOUS","Misafir");
define("_MODULEERROR","Çalıştırmak İstediğiniz Eklentide Hata Var.");

define('_ILLEGAL_OP_OPERATION', 'Site içerisindeki bir bölümü izin verilmeyen bir anahtarla açmaya çalıştınız <br />Lütfen adres satırına girdiğiniz bilgiyi kontrol edin.');
define('_PAGE_NOT_EXISTS', 'Üzgünüz, ulaşmaya çalıştığınız sayfa mevcut değil');
define('_REFRESH_SCREEN', 'Ekranı Yenile');

define('_AS_IS', 'As is');
define('_OFFTOPIC', 'Konu Dışı');
define('_FLAMEBAIT', 'Flame Bait');
define('_TROLL', 'Troll');
define('_REDUNDANT', 'Redudant');
define('_INSIGHTFUL', 'Insightful');
define('_INTERESTING', 'İlginç');
define('_INFORMATIVE', 'Bilgilendirici');
define('_FUNNY', 'Komik');
define('_OVERRATED', 'Over Rated');
define('_UNDERRATED', 'Under Rated');
define('_EVO_HELPSYSTEM', 'Nuke Evolution Yardımı');
define('_OVERLIB_CLOSE', 'Kapat');

define('_GUEST', 'Misafir');
define('_BOTS', 'Arama Robotu');
define('_BOT', 'Arama Robotu');
define('_ABR_DAYS', 'G');
define('_ABR_MONTHS', 'A');
define('_ABR_YEARS', 'Y');
define('_ABR_MINUTES', 'Dak');
define('_ABR_HOURS', 'S');
define('_ABR_SECONDS', 'San');

define("_ACTIVETOPICS","Güncel Konu Başlıkları");

define('_MESSAGE', 'Mesaj');
define('_EMAIL', 'e-Posta');
define('_FROM', 'kimden');

// Modulenames to show in Who-is-Online
define('_MODULE_0', ' Forum Dizini');
define('_MODULE_-1', 'Foruma Giriş');
define('_MODULE_-2', 'Arama');
define('_MODULE_-3', 'Üye Ol');
define('_MODULE_-4', 'Üye Bilgileri');
define('_MODULE_-6', 'Forumda Kimler Bağlı?');
define('_MODULE_-7', 'Üye Listesi');
define('_MODULE_-8', 'Forumda S.S.S.');
define('_MODULE_-9', 'Foruma Gönderilenler');
define('_MODULE_-10', 'Özel Mesajlar');
define('_MODULE_-11', 'Üye Grupları');
define('_MODULE_-12', 'Forum: Ekip');
define('_MODULE_-1210', 'Eklenen Dosyalar');
define('_MODULE_-1214', 'Forum Kuralları');
define('_MODULE_-15', 'Forum: Forumlar');
define('_MODULE_-16', 'Forum: Konular');
define('_MODULE_-17', 'Forum: Gönderilenler');
define('_MODULE_-33', 'Son Başlıklar');
define('_MODULE_-34', 'Forum İstatistikleri');
define('_MODULE_-35', 'Rütbeler');
define('_MODULE_-50', 'Forum Yönetimi');
define('_MODULE_-5000', 'Forum Konuları');

?>