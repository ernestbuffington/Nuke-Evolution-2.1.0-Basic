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

define("_ALLOWEDHTML","İzin Verilen HTML:");
define("_ALREADYVOTEDARTICLE","Üzgünüz, bu habere zaten az önce oy verdiniz!");
define("_ARTICLEPOLL","Haberin Anketi");
define("_ARTICLERATING","Haber Puanlama");
define("_AVERAGESCORE","Ortalama Puan");
define("_BACKTOARTICLEPAGE","Makaleler Sayfasına Geri Dön");
define("_BAD","Kötü");
define("_BYTESMORE","byte kaldı");
define("_CASTMYVOTE","Oyumu Gönder!");
define("_COMESFROM","Bu Haberin Geldiği Yer:");
define("_COMMENT","yorum");
define("_COMMENTREPLY","Yorum Gönder");
define("_COMMENTSQ","yorumlar?");
define("_COMMENTSWARNING","Buradaki yorumlar sadece yorumu göndereni bağlar. Yorum içerikleri bizim görüşümüz değildir.");
define("_COMREPLYPRE","Yorum Gönderme Önizlemesi");
define("_CONFIGURE","Ayarlar");
define("_CONSIDERED","considered the following article interesting and wanted to send it to you.");
define("_DIDNTRATE","Bu makaleyi puanlamak için Puan Seçmelisiniz!");
define("_EXCELLENT","Mükemmel");
define("_EXTRANS","Dönüştür (html taglarını text yap)");
define("_FDATE","Tarih:");
define("_FFRIENDEMAIL","Arkadaşınızın E-Posta Adresi:");
define("_FFRIENDNAME","Arkadaşınızın Adı:");
define("_FLAT","Düz");
define("_FRIEND","Bir Arkadaşınıza Yollayın");
define("_FSTORY","İçerik");
define("_FTOPIC","Konu:");
define("_FYOUREMAIL","E-Posta Adresiniz:");
define("_FYOURNAME","Adınız:");
define("_GOOD","İyi");
define("_GOTOHOME","Ana Sayfaya Git");
define("_GOTONEWSINDEX","Haberler Dizinine Git");
define("_HASSENT","Gönderildi");
define("_HIGHEST","Önce Yüksek Puanlılar");
define("_HTMLFORMATED","HTML Formatlı");
define("_INTERESTING_ARTICLE","İlginç Makaleler ..");
define("_LOGINCREATE","Giriş/Hesap Aç");
define("_MOREABOUT","Daha Fazlası");
define("_MOSTREAD","Aşağıdaki konuda en çok okunan makale");
define("_NAME","İsim");
define("_NESTED","İç İçe");
define("_NEWEST","Önce Yeniler");
define("_NEWS", "Haberler");
define("_NEWSBY","Gönderdiği Haberler");
define("_NEWUSER","Yeni Kullanıcı");
define("_NOANONCOMMENTS","Misafir kullanıcı yorum yazamaz, lütfen <a href=\"modules.php?name=Your_Account&amp;op=new_user\">Kayıt Olun</a>");
define("_NOCOMMENTS","Yorum Yok");
define("_NOCOMMENTSACT","Üzgünüz, Bu Haber İçin Yorumlar Etkin Değil.");
define("_NOINFO4TOPIC","Üzgünüz, seçilen konu hakkında bir bilgi bulunamadı.");
define("_NOSUBJECT","Konu Yok");
define("_NOTRIGHT","Something is not right with passing a variable to this function. This message is just to keep things from messing up down the road");
define("_OK","Tamam!");
define("_OLDEST","Eski Başa");
define("_ONN","on...");
define("_OPTIONS","Seçenekler");
define("_PARENT","Parent");
define("_PDATE","Tarih:");
define("_PLAINTEXT","Düzyazı Olarak Gönder");
define("_POSTANON","Misafir Olarak Gönder");
define("_PREVIEW","Önİzle");
define("_PRINTER","Yazıcı Dostu");
define("_PTOPIC","Konu:");
define("_RATEARTICLE","Makale Puanlama");
define("_RATETHISARTICLE","Lütfen bir kaç saniyenizi ayırın ve bu habere puan verin:");
define("_READMORE","Devamını Oku...");
define("_READPDF","PDF Olarak Oku");
define("_READREST","Read the rest of this comment...");
define("_READWITHCOMMENTS", "You can read the complete story with its comments from");
define("_RECOMMEND","Bu siteyi bir arkadaşına öner");
define("_REFRESH","Yenile");
define("_REGULAR","Regular");
define("_RELATED","İlgili Linkler");
define("_REPLY","Cevap Ver");
define("_REPLYMAIN","Yorum Ekle");
define("_ROOT","Kök");
define("_SCORE","Puan:");
define("_SEARCHDIS","Search Discussion");
define("_SEARCHONTOPIC","Bu Konuda Ara");
define("_SELECTNEWTOPIC","Yeni Bir Konu Seçin");
define("_SEND","Gönder");
define("_SENDAMSG","Bir Mesaj Yollayın");
define("_SID_FAILURE", "Aradığınız Makaleyi bulamadık");
define("_SUBJECT","Başlık");
define("_THANKS","Teşekkürler!");
define("_THANKSVOTEARTICLE","Bu Habere Oy Verdiğiniz İçin Teşekkürler!");
define("_THEURL","Bu Haberin Bulunduğu Web Linki:");
define("_THREAD","Sıralı");
define("_THRESHOLD","Başlangıç");
define("_TOAFRIEND","arkadaşınıza göndereceksiniz:");
define("_UCOMMENT","Yorum");
define("_URL","URL");
define("_USERINFO","Kullanıcı Bilgisi");
define("_VERYGOOD","Çok İyi");
define("_YOUCANREAD","Daha Fazla Haber İçin:");
define("_YOURFRIEND","Arkadaşınız");
define("_YOURNAME","İsminiz");
define("_YOUSENDSTORY","Bu haberi:");

/*****[BEGIN]******************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/
define("_NE_ALLTOPICS","Tüm Konular");
define("_NE_ARTICLES","Makaleler");
define("_NE_CATEGORY","Kategori");
define("_NE_COMPLETE","Original text");
define("_NE_COUNTRATINGS","Counted Ratings");
define("_NE_DISPLAYTYPE","Sütunları Göster");
define("_NE_DUAL","Çift Sütun");
define("_NE_HOMENUMBER","Articles in Home");
define("_NE_HOMENUMNOTE","This will override user preferences<br />\nif set other than Nuke Default");
define("_NE_HOMETOPIC","Topic in Home");
define("_NE_MODERATE","Submit Moderation");
define("_NE_NEWSCONFIG","Haber Ayarları");
define("_NE_NO","Hayır");
define("_NE_NONE_NEWS","No News available");
define("_NE_NOTIFYAUTH","Yazarı Bilgilendir");
define("_NE_NOTIFYAUTHNOTE","This will email article submitter<br />\non approval");
define("_NE_NO_EMPTY_COMMENT","One of the fields: subject or comment is empty. Please go back.<br />"._GOBACK);
define("_NE_NUKEDEFAULT","Nuke Varsayılanı");
define("_NE_OF","of");
define("_NE_PAGE","Sayfa");
define("_NE_PAGES","sayfa");
define("_NE_POPUP","Yeni Pencerede");
define("_NE_READLINK","Daha Fazlasını Göster Linki");
define("_NE_SAVECHANGES","Değişiklikleri Kaydet");
define("_NE_SELECT","Sayfa Seçin");
define("_NE_SINGLE","Tek Sütun");
define("_NE_TEXTTYPE","Makale Uzunluğu");
define("_NE_TRUNCATE","255 Karaktere Kadar Kısalt");
define("_NE_WEBSITE","Web Sitesi");
define("_NE_YES","Evet");
/*****[END]********************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/

?>