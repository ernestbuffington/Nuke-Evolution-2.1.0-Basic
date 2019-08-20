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
    die('Bu dosyaya direkt olarak erişmeniz YASAKLANMIŞTIR...');
}

global $adminpoint;

$lang_admin[$adminpoint]['EM203'] = 'Hata 203: The information contained in the entity header is not from the original site, but from third party server';
$lang_admin[$adminpoint]['EM204'] = 'Hata 204: You have clicked a link without a target. It\'s a warning !!';
$lang_admin[$adminpoint]['EM205'] = 'Hata 205: You sent a header we do not allow.';
$lang_admin[$adminpoint]['EM300'] = 'Hata 300: The requested address couldn\'t be identified as unique.';
$lang_admin[$adminpoint]['EM301'] = 'Hata 301: The requested address is moved permanently.';
$lang_admin[$adminpoint]['EM302'] = 'Hata 302: The requested address is moved temporarily.';
$lang_admin[$adminpoint]['EM303'] = 'Hata 303: The requested address is moved anywhere - but we do not follow';
$lang_admin[$adminpoint]['EM304'] = 'Hata 304: We don\'t allow calls for modification time of an address on our server';
$lang_admin[$adminpoint]['EM400'] = 'Hata 400: Bad request - there is a syntax error in the request, and it\'s denied';
$lang_admin[$adminpoint]['EM401'] = 'Hata 401: The request header did not contain the necessary authentication codes. Access is denied';
$lang_admin[$adminpoint]['EM402'] = 'Hata 402: To access this file, payment is required';
$lang_admin[$adminpoint]['EM403'] = 'Hata 403: We cannot satisfy your request. Please try later.';
$lang_admin[$adminpoint]['EM404'] = 'Hata 404: The requested address is not on this server. Maybe you have misspelled the URL ?';
$lang_admin[$adminpoint]['EM405'] = 'Hata 405: The method you are using to access the file is not allowed';
$lang_admin[$adminpoint]['EM406'] = 'Hata 406: Your client isn\'t configured to receive the requested address';
$lang_admin[$adminpoint]['EM407'] = 'Hata 407: Your request must first be authorised before it can take place';
$lang_admin[$adminpoint]['EM408'] = 'Hata 408: Request Timeout - Please try later';
$lang_admin[$adminpoint]['EM409'] = 'Hata 409: Too many concurrent requests - Please try later';
$lang_admin[$adminpoint]['EM410'] = 'Hata 410: The requested address is not available.';
$lang_admin[$adminpoint]['EM411'] = 'Hata 411: Your request is missing some header informations';
$lang_admin[$adminpoint]['EM412'] = 'Hata 412: Your client isn\'t configured to receive the requested information.';
$lang_admin[$adminpoint]['EM413'] = 'Hata 413: The requested file is too big to process';
$lang_admin[$adminpoint]['EM414'] = 'Hata 414: The requested address isn\'t in the right format for this server.';
$lang_admin[$adminpoint]['EM415'] = 'Hata 415: The filetype of the request is not supported.';
$lang_admin[$adminpoint]['EM500'] = 'Hata 500: Internal server error - please try later';
$lang_admin[$adminpoint]['EM501'] = 'Hata 501: The request cannot be carried out by the server';
$lang_admin[$adminpoint]['EM502'] = 'Hata 502: Bad Gateway - the server your\'re trying to reach is sending back errors.';
$lang_admin[$adminpoint]['EM503'] = 'Hata 503: Temporarily Unavailable.';
$lang_admin[$adminpoint]['EM504'] = 'Hata 504: The Gateway has timed out.';
$lang_admin[$adminpoint]['EM505'] = 'Hata 505: The HTTP protocol you are asking for is not supported.';
$lang_admin[$adminpoint]['EMDATETIME'] = 'Tarih / Zaman';
$lang_admin[$adminpoint]['EMHOME'] = 'Ana Sayfaya Geri Dön';
$lang_admin[$adminpoint]['EMIP'] = 'IP Adresi';
$lang_admin[$adminpoint]['EMRECDATA'] = '<strong>NOT:</strong> we have recorded the following data to track the problem.';
$lang_admin[$adminpoint]['EMREF'] = 'Referer';
$lang_admin[$adminpoint]['EMSORRY'] = 'We are sorry for any problems';
$lang_admin[$adminpoint]['EMSORT'] = 'Sort Error';
$lang_admin[$adminpoint]['EMUNKNOWN'] = 'Bilinmeyen hata: There occured an error we couldn\'t recognize';
$lang_admin[$adminpoint]['EMURL'] = 'Hatalı URL';

// Error Manager v2.1 Admin:
$lang_admin[$adminpoint]['EALOGERRORS'] = 'Log the errors in the database?';
$lang_admin[$adminpoint]['EASHOWIMAGE'] = 'Show Image?';
$lang_admin[$adminpoint]['EASHOWINFOSAVED'] = 'Tell the visitor that the info is logged?<br />(only usefull if \'Log the Errors in DB\' is ON)';
$lang_admin[$adminpoint]['EASHOWMODULBLOCKS'] = 'Show blocks??';
$lang_admin[$adminpoint]['EMABACK'] = 'Back to Error Management Administration';
$lang_admin[$adminpoint]['EMABACKMAIN'] = 'Ana Yönetim Ekranına Geri Dön';
$lang_admin[$adminpoint]['EMADATETIME'] = 'Tarih / Zaman';
$lang_admin[$adminpoint]['EMADEL'] = 'Hataları Sil';
$lang_admin[$adminpoint]['EMADELALL'] = 'Tümünü SİL';
$lang_admin[$adminpoint]['EMADELETED'] = 'Bu Hata Veritabanından Silindi';
$lang_admin[$adminpoint]['EMADELETEDALL'] = 'Tüm Hatalar Veritabanından Silindi';
$lang_admin[$adminpoint]['EMAIP'] = 'IP Adresi';
$lang_admin[$adminpoint]['EMALIST'] = 'The following Errors found place at your site';
$lang_admin[$adminpoint]['EMAREF'] = 'Referer';
$lang_admin[$adminpoint]['EMASORT'] = 'Sort Error';
$lang_admin[$adminpoint]['EMATITLE'] = 'Hata';
$lang_admin[$adminpoint]['EMAURL'] = 'Error URL';
$lang_admin[$adminpoint]['EMCONFIG'] = 'Ayarlar';
$lang_admin[$adminpoint]['EMSHOWERRORS'] = 'Hataları Göster';
$lang_admin[$adminpoint]['ERROR_BLOCKS_BOTH'] = 'Both Blocks';
$lang_admin[$adminpoint]['ERROR_BLOCKS_LEFT'] = 'Left Blocks';
$lang_admin[$adminpoint]['ERROR_BLOCKS_NONE'] = 'Yok';
$lang_admin[$adminpoint]['ERROR_BLOCKS_RIGHT'] = 'Right Blocks';

$lang_admin[$adminpoint]['RESETCOUNTER'] = '(Sayacı Sıfırla)';

$lang_admin[$adminpoint]['SAVECHANGES'] = 'Değişiklikleri Kaydet';

$lang_admin[$adminpoint]['TOTALERRORS'] = 'Sitenizdeki Toplam Hata Sayısı';

?>