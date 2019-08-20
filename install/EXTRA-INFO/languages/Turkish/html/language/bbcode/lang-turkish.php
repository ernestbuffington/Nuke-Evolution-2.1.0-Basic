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


$bbcode_lang['Emoticons'] = 'Gülücükler';
$bbcode_lang['More_emoticons'] = 'Daha Fazla Gülücük Göster';
$bbcode_lang['smilies_close'] = 'Pencereyi Kapat';

$lang['bbcode_b_help'] = '<strong>Koyu:</strong> [b]metin[/b]  (alt+b)';
$lang['bbcode_i_help'] = '<strong>Yatık:</strong> [i]metin[/i]  (alt+i)';
$lang['bbcode_u_help'] = '<strong>Altıçizili:</strong> [u]metin[/u]  (alt+u)';
$lang['bbcode_q_help'] = '<strong>Alıntı:</strong> [quote]metin[/quote]  (alt+q)';
$lang['bbcode_c_help'] = '<strong>Kod Görünümü:</strong> [code]kod[/code]  (alt+c)';
$lang['bbcode_l_help'] = '<strong>Liste Görünümü:</strong> [list]metin[/list] (alt+l)';
$lang['bbcode_o_help'] = '<strong>Sıralı Liste:</strong> [list=]metin[/list]  (alt+o)';
$lang['bbcode_p_help'] = '<strong>Resim Ekle:</strong> [img]http://resim_yolu[/img]  (alt+p)';
$lang['bbcode_w_help'] = '<strong>URL Adresi Ekle:</strong> [url]http://url[/url] ya da [url=http://url]URL text[/url]  (alt+w)';
$lang['bbcode_a_help'] = 'Tüm açık bbCode biçimlendirme komutlarını kapat';
$lang['bbcode_size_help'] = 'Font Boyu: [size=x-small]Küçük Yazı[/size]';
$lang['bbcode_color_help'] = 'Font Rengi: [color=red]text[/color] HTML color=#FF0000 kodlarını kullanabilirsiniz';
$lang['bbcode_font_help'] = 'Font Tipi: [font=Arial]text[/font]';
$lang['GVideo_link'] = 'Link';
$lang['youtube_link'] = 'Link';

$lang['bbcode_quote_help'] = 'Alıntı: [quote]text[/quote]';
$lang['bbcode_code_help'] = 'Kod: [code]code[/code]';
$lang['bbcode_php_help'] = 'PHP: [php]code[/php]';
$lang['bbcode_spoil_help'] = 'Gizlenen yazı: [spoil]text[/spoil]';
$lang['bbcode_img_help'] = 'Resim Ekle: [img]http://resim_yolu[/img]';
$lang['bbcode_h_help'] = 'Gizli: [hide]message[/hide] (alt+h)';
$lang['bbcode_url_help'] = 'URL Gir: [url]http://www.evo-turkish.com[/url] ya da [url=http://www.evo-turkish.com]Evo Türkiye[/url]';
$lang['bbcode_fc_help'] = 'Font Rengi: [color=red]text[/color] HTML color=#FF0000 kodlarını kullanabilirsiniz';
$lang['bbcode_fs_help'] = 'Font Boyu: [size=10]Küçük Yazı[/size]';
$lang['bbcode_ft_help'] = 'Font Tipi: [font=Tahoma]text[/font]';
$lang['bbcode_rtl_help'] = 'Mesaj Kutusunun İçindekileri Sağdan Sola Yasla';
$lang['bbcode_ltr_help'] = 'Mesaj Kutusunun İçindekileri Soldan Sağa Yasla';
$lang['bbcode_mail_help'] = 'Email Gir: [email]zor@zorbilgisayar.com[/email]';
$lang['bbcode_grad_help'] ='Renk geçişli yazı (Sadece Internet Explorer)';
$lang['bbcode_right_help'] = 'Yazıları sağa yasla: [align=right]text[/align]';
$lang['bbcode_left_help'] = 'Yazıları sola yasla: [align=left]text[/align]';
$lang['bbcode_center_help'] = 'Yazıları ortala: [align=center]text[/align]';
$lang['bbcode_justify_help'] = 'Her iki yana yasla: [align=justify]text[/align]';
$lang['bbcode_marqr_help'] = 'Sağa doğru kayan yazı: [marq=right]text[/marq]';
$lang['bbcode_marql_help'] = 'Sola doğru kayan yazı: [marq=left]text[/marq]';
$lang['bbcode_marqu_help'] = 'Yukarı doğru kayan yazı: [marq=up]text[/marq]';
$lang['bbcode_marqd_help'] = 'Aşağı doğru kayan yazı: [marq=down]text[/marq]';
$lang['bbcode_stream_help'] = 'Ses dosyası ekle: [stream]Dosya URL[/stream]';
$lang['bbcode_ram_help'] = 'Real Media dosyası ekle: [ram]Dosya URL[/ram]';
$lang['bbcode_plain_help'] = 'Seçilen yazıdan BBCode kodlarını temizle';
$lang['bbcode_hr_help'] = 'Yatay çizgi ekle [hr]';
$lang['bbcode_video_help'] = 'Video dosyası ekle: [video width=# height=#]dosya URL[/video]';
$lang['bbcode_flash_help'] = 'Flash dosyası ekle: [flash width=# height=#]flash URL[/flash]';
$lang['bbcode_fade_help'] = 'Solan yazı: [fade]text[/fade] (Sadece Internet Explorer)';
$lang['bbcode_list_help'] = 'Sıralı liste: [list|=1|a]text[/list] İpucu: [*] işareti ile liste ögesi ekleyebilirsiniz';
$lang['bbcode_strike_help'] = 'Üstüçizili: [s]text[/s]';
$lang['bbcode_sup_help'] = 'Yükseltilmiş: [sup]text[/sup]';
$lang['bbcode_sub_help'] = 'Alçaltılmış: [sub]text[/sub]';
$lang['bbcode_symbol_help'] = 'Gönderinize Sembol Ekleyin';
$lang['bbcode_youtube_help'] = 'YouTube filmi ekleyin: [youtube]YouTube URL[/youtube]';
$lang['bbcode_googlevid_help'] = 'Google filmi ekleyin: [GVideo]Google Video URL[/GVideo]';

$lang['bbcode_text_first'] = 'Önce yazıyı seçiniz';
$lang['bbcode_less_letters'] = 'Bu ancak seçim 120 karakterden azsa çalışır';
$lang['bbcode_rm_url'] = 'Bir Real Media dosyası URL adresi girin';
$lang['bbcode_no_file_url'] = ' Bir dosya URL adresi girmediniz.';
$lang['bbcode_rm_width'] = 'Real Media dosyasının genişliğini girin';
$lang['bbcode_no_rm_width'] = ' Real Media dosyasının genişliğini girmediniz.';
$lang['bbcode_rm_height'] = 'Real Media dosyasının yüksekliğini girin';
$lang['bbcode_no_rm_height'] = ' Real Media dosyasının yüksekliğini girmediniz.';
$lang['bbcode_error'] = 'Hata:';
$lang['bbcode_stream_url'] = 'Bir ses dosyası URL adresi girin';
$lang['bbcode_video_url'] = 'Bir Video URL adresi giriniz';
$lang['bbcode_video_width'] = 'Video dosyasının genişliğini giriniz';
$lang['bbcode_no_video_width'] = ' Video dosyasının genişliğini girmediniz.';
$lang['bbcode_video_height'] = 'Video dosyasının yüksekliğini giriniz';
$lang['bbcode_no_video_height'] = ' Video dosyasının yüksekliğini girmediniz.';
$lang['bbcode_google_url'] = 'Bir Google filmine ait URL giriniz';
$lang['bbcode_youtube'] = 'Bir YouTube filmine ait URL giriniz';
$lang['bbcode_email'] = ' Bir E-Posta Adresi Giriniz';
$lang['bbcode_no_email'] = ' Bir E-Posta Adresi Girmediniz.';
$lang['bbcode_flash_url'] = 'Bir Flash dosyasına ait URL giriniz';
$lang['bbcode_no_flash_url'] = ' Bir Flash dosyasına ait URL girmediniz.';
$lang['bbcode_flash_width'] = 'Flash dosyasının genişliğini giriniz';
$lang['bbcode_no_flash_width'] = ' Flash dosyasının genişliğini girmediniz.';
$lang['bbcode_flash_height'] = 'Flash dosyasının yüksekliğini giriniz';
$lang['bbcode_no_flash_height'] = ' Flash dosyasının yüksekliğini girmediniz.';
$lang['bbcode_no_message'] = 'Gönderim yapmadan önce bir mesaj yazmalısınız';
$lang['bbcode_url'] = 'URL adresini girin';
$lang['bbcode_no_url'] = ' URL adresini girmediniz';
$lang['bbcode_height'] = 'Gösterileceği yüksekliği girin';
$lang['bbcode_width'] = 'Gösterileceği genişliği girin';
$lang['bbcode_pagename'] = 'Sayfa adını girin';
$lang['bbcode_web_pagename'] = 'Web Sayfası Adı';
$lang['bbcode_no_pagename'] = ' Web Sayfasının Adını girmediniz.';
$lang['bbcode_img_url'] = 'Resim URL adresini girin';
$lang['bbcode_no_img_url'] = ' Resim URL adresini girmediniz';
$lang['bbcode_quote'] = 'Sayfanın içinden bir yazıyı seçip tekrar deneyin';

$lang['bbcode_font_type'] = 'Font Tipi';
$lang['bbcode_font_default'] = 'Varsayılan Font';
$lang['bbcode_font_size'] = 'Font Boyu';
$lang['bbcode_font_color'] = 'Font Rengi';
$lang['bbcode_alt_justify'] = 'hizalama';
$lang['bbcode_alt_right'] = 'sağa';
$lang['bbcode_alt_center'] = 'ortaya';
$lang['bbcode_alt_left'] = 'sola';
$lang['bbcode_alt_sup'] = 'superscript';
$lang['bbcode_alt_sub'] = 'subscript';
$lang['bbcode_alt_b'] = 'koyu';
$lang['bbcode_alt_i'] = 'yatık';
$lang['bbcode_alt_u'] = 'altı çizili';
$lang['bbcode_alt_s'] = 'strike';
$lang['bbcode_alt_fade'] = 'fade';
$lang['bbcode_alt_grad'] = 'gradient';
$lang['bbcode_alt_rtl'] = 'Sağdan Sola';
$lang['bbcode_alt_ltr'] = 'Soldan Sağa';
$lang['bbcode_alt_marqd'] = 'Aşağı Kayan Yazı';
$lang['bbcode_alt_marqu'] = 'Yukarı Kayan Yazı';
$lang['bbcode_alt_marql'] = 'Sola Kayan Yazı';
$lang['bbcode_alt_marqr'] = 'Sağa Kayan Yazı';
$lang['bbcode_alt_quote'] = 'Alıntı';
$lang['bbcode_alt_spoil'] = 'Spoiler';
$lang['bbcode_alt_img'] = 'Resim';
$lang['bbcode_alt_list'] = 'Liste';
$lang['bbcode_alt_hr'] = 'Yatay Çizgi';
$lang['bbcode_alt_plain'] = 'BBcodeları Temizle';
$lang['bbcode_alt_php'] = 'PHP';
$lang['bbcode_alt_code'] = 'Kod';
$lang['bbcode_alt_url'] = 'URL';
$lang['bbcode_alt_email'] = 'E-Posta';
$lang['bbcode_alt_flash'] = 'Flash';
$lang['bbcode_alt_video'] = 'Video';
$lang['bbcode_alt_stream'] = 'Stream';
$lang['bbcode_alt_realmedia'] = 'Real Media';
$lang['bbcode_alt_googlevid'] = 'Google Video';
$lang['bbcode_alt_youtube'] = 'YouTube Video';

$lang['Emoticons'] = 'Gülücükler';
$lang['More_emoticons'] = 'Daha Fazla Gülücük Göster';
$lang['smilies_close'] = 'Pencereyi Kapat';

$lang['Font_color'] = 'Font Rengi';
$lang['color_default'] = 'Varsayılan';
$lang['color_dark_red'] = 'Koyu Kırmızı';
$lang['color_red'] = 'Kırmızı';
$lang['color_orange'] = 'Kavuniçi';
$lang['color_brown'] = 'Kahverengi';
$lang['color_yellow'] = 'Sarı';
$lang['color_green'] = 'Yeşil';
$lang['color_olive'] = 'Açık Yeşil';
$lang['color_cyan'] = 'Camgöbeği';
$lang['color_blue'] = 'Mavi';
$lang['color_dark_blue'] = 'Koyu Mavi';
$lang['color_indigo'] = 'Mor';
$lang['color_violet'] = 'Menekşe';
$lang['color_white'] = 'Beyaz';
$lang['color_black'] = 'Siyah';

$lang['Font_size'] = 'Font Boyu';
$lang['font_tiny'] = 'Minik';
$lang['font_small'] = 'Küçük';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Büyük';
$lang['font_huge'] = 'Kocaman';

$lang['Close_Tags'] = 'Html Taglarını Kapat';
$lang['Styles_tip'] = 'İpucu: Stilleri yazıyı seçerek kolayca uygulayabilirsiniz.';

?>