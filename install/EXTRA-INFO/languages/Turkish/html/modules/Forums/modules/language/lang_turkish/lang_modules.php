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

if (!defined('MODULE_FILE') ) {
    die('You can\'t access this file directly...');
}

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

// [admin_statistics]
$admin_statistics = array();
$admin_statistics['module_name'] = 'Yönetimsel İstatistikler';
$admin_statistics['Board_Up_Days'] = 'Forumun Açık Olduğu Süre';
$admin_statistics['Latest_Reg_User'] = 'En Son Kayıt Olan Üye';
$admin_statistics['Latest_Reg_User_Date'] = 'Son Üyenin Kayıt Olma Tarihi';
$admin_statistics['Most_Ever_Online'] = 'En Fazla Üye Bağlı Olma Rekoru';
$admin_statistics['Most_Ever_Online_Date'] = 'En Fazla Üyenin Bağlı Olduğu Zaman';
$admin_statistics['Disk_usage'] = 'Disk Kullanımı';
// [/admin_statistics]
// [stats_overview]
$stats_overview = array();
$stats_overview['module_name'] = 'İstatistiklere Genel Bakış';
// Admin Specific
$stats_overview['num_columns_title'] = 'Set the number of columns';
$stats_overview['num_columns_explain'] = 'Here you are able to set the number of columns displayed';
// [/stats_overview]
// [top_posters]
$top_posters = array();
$top_posters['module_name'] = 'En Çok Yazanlar';
// [/top_posters]
// [top_posters_month]
$top_posters_month = array();
$top_posters_month['module_name'] = 'Bu Ay En Çok Yazanlar';
// [/top_posters_month]
// [top_posters_week]
$top_posters_week = array();
$top_posters_week['module_name'] = 'Bu Hafta En Çok Yazan Üyeler';
// [/top_posters_week]
// [topics_by_month]
$topics_by_month = array();
$topics_by_month['module_name'] = 'Aylara göre yeni açılan başlıklar';
$topics_by_month['Year'] = 'Yıl';
$topics_by_month['Month_jan'] = 'Oca';
$topics_by_month['Month_feb'] = 'Şub';
$topics_by_month['Month_mar'] = 'Mar';
$topics_by_month['Month_apr'] = 'Nis';
$topics_by_month['Month_may'] = 'May';
$topics_by_month['Month_jun'] = 'Haz';
$topics_by_month['Month_jul'] = 'Tem';
$topics_by_month['Month_aug'] = 'Ağu';
$topics_by_month['Month_sep'] = 'Eyl';
$topics_by_month['Month_oct'] = 'Ekm';
$topics_by_month['Month_nov'] = 'Kas';
$topics_by_month['Month_dec'] = 'Arl';
// [/topics_by_month]
// [most_active_topicstarter]
$most_active_topicstarter = array();
$most_active_topicstarter['module_name'] = 'En Çok Konu Açan Üyeler';
// [/most_active_topicstarter]
// [posts_by_month]
$posts_by_month = array();
$posts_by_month['module_name'] = 'Aylara göre yeni başlıklar';
$posts_by_month['Year'] = 'Yıl';
$posts_by_month['Month_jan'] = 'Oca';
$posts_by_month['Month_feb'] = 'Şub';
$posts_by_month['Month_mar'] = 'Mar';
$posts_by_month['Month_apr'] = 'Nis';
$posts_by_month['Month_may'] = 'May';
$posts_by_month['Month_jun'] = 'Haz';
$posts_by_month['Month_jul'] = 'Tem';
$posts_by_month['Month_aug'] = 'Ağu';
$posts_by_month['Month_sep'] = 'Eyl';
$posts_by_month['Month_oct'] = 'Ekm';
$posts_by_month['Month_nov'] = 'Kas';
$posts_by_month['Month_dec'] = 'Arl';
// [/posts_by_month]
// [top_attachments]
$top_attachments = array();
$top_attachments['module_name'] = 'Top Downloaded Attachments';
$top_attachments['Filename'] = 'Dosya Adı';
$top_attachments['Filecomment'] = 'Dosya Yorumları';
$top_attachments['Size'] = 'Dosya Boyutu';
$top_attachments['Downloads'] = 'Dosyalar';
$top_attachments['Posttime'] = 'Gönderilme Zamanı';
$top_attachments['Posted_in_topic'] = 'Gönderildiği Başlık';
$top_attachments['Hidden_from_public_view'] = 'Bu Dosya üye olunmadan görüntülenemez';
// Admin Variables
$top_attachments['exclude_images_title'] = 'Exclude Images';
$top_attachments['exclude_images_explain'] = 'If this setting is enabled, images are not considered within the Top Attachments statistics.';
// [/top_attachments]
// [most_active_topics]
$most_active_topics = array();
$most_active_topics['module_name'] = 'Most Active Topics';
$most_active_topics['Hidden_from_public_view'] = 'Bu başlık üye olunmadan görüntülenemez';
// [/most_active_topics]
// [most_viewed_topics]
$most_viewed_topics = array();
$most_viewed_topics['module_name'] = 'Most Viewed Topics';
$most_viewed_topics['Hidden_from_public_view'] = 'Bu başlık üye olunmadan görüntülenemez';
// [/most_viewed_topics]
// [most_interesting_topics]
$most_interesting_topics = array();
$most_interesting_topics['module_name'] = 'Most Interesting Topics';
$most_interesting_topics['Rate'] = 'Rate (views/messages)';
$most_interesting_topics['Hidden_from_public_view'] = 'Bu başlık üye olunmadan görüntülenemez';
// [/most_interesting_topics]
// [top_words]
$top_words = array();
$top_words['module_name'] = 'Most Used Words';
$top_words['Word'] = 'Word';
$top_words['Count'] = 'Count';
// [/top_words]
// [least_interesting_topics]
$least_interesting_topics = array();
$least_interesting_topics['module_name'] = 'Least Interesting Topics';
$least_interesting_topics['Rate'] = 'Rate (views/messages)';
$least_interesting_topics['Hidden_from_public_view'] = 'Bu başlık üye olunmadan görüntülenemez';
// [/least_interesting_topics]
// [top_smilies]
$top_smilies = array();
$top_smilies['module_name'] = 'Top Smilies';
$top_smilies['Smilie_image'] = 'Smiley Image';
$top_smilies['Smilie_code'] = 'Smiley Code';
// [/top_smilies]
// [users_by_month]
$users_by_month = array();
$users_by_month['module_name'] = 'Number of new users by month';
$users_by_month['Year'] = 'Yıl';
$users_by_month['Month_jan'] = 'Oca';
$users_by_month['Month_feb'] = 'Şub';
$users_by_month['Month_mar'] = 'Mar';
$users_by_month['Month_apr'] = 'Nis';
$users_by_month['Month_may'] = 'May';
$users_by_month['Month_jun'] = 'Haz';
$users_by_month['Month_jul'] = 'Tem';
$users_by_month['Month_aug'] = 'Ağu';
$users_by_month['Month_sep'] = 'Eyl';
$users_by_month['Month_oct'] = 'Ekm';
$users_by_month['Month_nov'] = 'Kas';
$users_by_month['Month_dec'] = 'Arl';
// [/users_by_month]

?>