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

define("_NEWS","Haberler");
define("_ALLTOPICS","Tüm Konular");
define("_OK","Tamam!");
define("_SAVE","Kaydet");
define("_NOSUBJECT","Konu Yok");
define("_ARTICLES","Haber");
define("_AREYOUSURE","Bir URL eklediniz mi? Yazım hatalarına karşı kontrol ettiniz mi?");
define("_SELECTTOPIC","Konu Seçin");
define("_OPTION","Seçenek");
define("_AUTHOR","Yazar");
define("_NEWS_ADMIN_HEADER", "Nuke-Evolution News :: Eklenti Yönetim Paneli");
define("_NEWSSUBMISSION_ADMIN_HEADER", "Nuke-Evolution Submissions :: Eklenti Yönetim Paneli");
define("_NEWSCONFIG_ADMIN_HEADER", "Nuke-Evolution Haber Ayarları :: Eklenti Yönetim Paneli");
define("_NEWS_RETURNMAIN", "Ana Yönetim Ekranına Geri Dön");
define("_ARTICLEADMIN","Makale/Haber Yönetimi");
define("_ADDARTICLE","Yeni Haber Ekle");
define("_STORYTEXT","Haber Metni");
define("_EXTENDEDTEXT","Geniş Metin");
define("_ARESUREURL","(Bir URL eklediniz mi? Yazım kontrolü yaptınız mı?)");
define("_PUBLISHINHOME","Anasayfada yayınla?");
define("_ONLYIFCATSELECTED","Sadece <em>Haberler</em> kategorisi seçili değilse çalışır");
define("_PROGRAMSTORY","Bu haberi programlamak ister misiniz?");
define("_NOWIS","Şu an");
define("_DAY","Gün");
define("_PREVIEWSTORY","Haber Önizle");
define("_POSTSTORY","Haber Gönder");
define("_REMOVESTORY","Haber #");
define("_ANDCOMMENTS","ve yorumlarını silmek istediğinizden emin misiniz?");
define("_CATEGORIESADMIN","Kategori Yönetimi");
define("_CATEGORYADD","Yeni Bir Kategori Ekle");
define("_CATNAME","Kategori İsmi");
define("_NOARTCATEDIT","<em>Haberler</em> kategorisi düzenlenemez");
define("_ASELECTCATEGORY","Kategori Seçin");
define("_CATEGORYNAME","Kategori İsmi");
define("_DELETECATEGORY","Kategori Sil");
define("_SELECTCATDEL","Silmek İçin Kategori Seçin");
define("_CATDELETED","Kategori Silindi!");
define("_WARNING","Uyarı");
define("_THECATEGORY","Kategori");
define("_HAS","");
define("_STORIESINSIDE","haber içeriyor");
define("_DELCATWARNING1","Bu kategoriyi ve TÜM haber ve yorumlarını silebilir");
define("_DELCATWARNING2","veya TÜM haberleri yeni bir kategoriye taşıyabilirsiniz.");
define("_DELCATWARNING3","ne yapmak istiyorsunuz?");
define("_YESDEL","Evet! HEPSİNİ sil!");
define("_NOMOVE","Hayır! Haberleri taşı");
define("_MOVESTORIES","Haberleri Yeni Bir Kategoriye Taşı");
define("_ALLSTORIES","");
define("_WILLBEMOVED","altındaki tüm haberler taşınacak.");
define("_SELECTNEWCAT","Yeni Kategoriyi Seçin");
define("_MOVEDONE","tebrikler! Taşınma tamamlandı!");
define("_CATEXISTS","Bu kategori zaten mevcut!");
define("_CATSAVED","Kategori kaydedildi!");
define("_GOTOADMIN","Yönetici Bölümüne Git");
define("_CATADDED","Yeni Kategori Eklendi!");
define("_AUTOSTORYEDIT","Oto-Haber Düzenle");
define("_NOTES","Notlar");
define("_CHNGPROGRAMSTORY","Bu haber için yeni tarihi seçin:");
define("_SUBMISSIONSADMIN","Haber Önerileri Yönetimi");
define("_DELETESTORY","Haber Sil");
define("_EDITARTICLE","Haber Düzenle");
define("_NOSUBMISSIONS","Yeni Öneri Yok");
define("_NEWSUBMISSIONS","Yeni Haber Önerileri");
define("_NOTAUTHORIZED1","Bu habere dokunma yetkiniz yok!");
define("_NOTAUTHORIZED2","Kendi yayınlamadığınız haberleri düzenleyemez/silemezsiniz");
define("_POLLTITLE","Anket Başlığı");
define("_POLLEACHFIELD","Lütfen her seçeneği tek bir satıra girin");
define("_ACTIVATECOMMENTS","Bu yazı için yorumlar aktifleşsin mi?");
define("_ATTACHAPOLL","Bu yazıya bir anket ekle");
define("_LEAVEBLANKTONOTATTACH","(Haberi anket eklemeden göndermek için boş bırakın)<br />(NOT: Otomatik/Programlı haberlere anket eklenemez)");
define("_USERPROFILE","Kullanıcı Profili");
define("_EMAILUSER","Kullanıcı Emaili");
define("_SENDPM","Özel Mesaj Gönder");

/*****************************************************/
/* NEW in NSN News 1.1.0                             */
/*****************************************************/
define("_NE_ARTPUB","Yazı Yayınla");
define("_NE_HASPUB","Yazı yayınlandı. Görünüşü:");
define("_NE_NEWSCONFIG","Haber Ayarları");
define("_NE_DISPLAYTYPE","Sütunları Göster");
define("_NE_SINGLE","Tek sütun");
define("_NE_DUAL","Çift Sütun");
define("_NE_READLINK","Daha fazlası linki");
define("_NE_POPUP","Popup");
define("_NE_PAGE","Sayfa");
define("_NE_TEXTTYPE","Yazının uzunluğu");
define("_NE_TRUNCATE","255 Karaktere Kadar Kısalt");
define("_NE_COMPLETE","Orijinal yazı");
define("_NE_NOTIFYAUTH","Yazan kişi");
define("_NE_NOTIFYAUTHNOTE","Bu eposta haber onaylayıcısıdır");
define("_NE_NO","Hayır");
define("_NE_YES","Evet");
define("_NE_HOMETOPIC","Anasayfadaki Konular");
define("_NE_ALLTOPICS","Tüm konular");
define("_NE_HOMENUMBER","Anasayfadaki Haberler");
define("_NE_NUKEDEFAULT","Ana Sayfa");
define("_NE_ARTICLES","Yazılar");
define("_NE_HOMENUMNOTE","Kullanıcı ayarlarının üstüne yazılacaktır.");
define("_NE_SAVECHANGES","Ayarları Kaydet");
define("_NE_ID","ID");
define("_NE_ACTION","Eylem");

define("_DISPLAY_T_ICON","Haberlerde Konu Resmi Gösterilsin mi?");
define("_DISPLAY_WRITES","Yazarın Bilgilerini Göster \"text\" haber Sayfasında?");

define("_LAST","son");
define("_GO","Git!");
define("_TOPICS","Konular");
define("_AUTOMATEDARTICLES","Automated Articles");
define("_NOAUTOARTICLES","There are no Automated Articles");
define("_STORYID","Haber ID");

?>