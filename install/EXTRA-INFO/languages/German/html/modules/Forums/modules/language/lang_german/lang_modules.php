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
$admin_statistics['module_name'] = 'Administrative Statistiken';
$admin_statistics['Board_Up_Days'] = 'Board Online Tage';
$admin_statistics['Latest_Reg_User'] = 'Letztes Mitglied';
$admin_statistics['Latest_Reg_User_Date'] = 'Registrierungsdatum des letzten Mitglieds';
$admin_statistics['Most_Ever_Online'] = 'Anzahl Benutzer, die jemals gleichzeitig online waren';
$admin_statistics['Most_Ever_Online_Date'] = 'Datum an dem die meisten Benutzer online waren';
$admin_statistics['Disk_usage'] = 'Speicherbedarf';
// [/admin_statistics]
// [stats_overview]
$stats_overview = array();
$stats_overview['module_name'] = 'Statistik &Uuml;berblick';
// Admin Specific
$stats_overview['num_columns_title'] = 'Setzte die Anzahl der Spalten';
$stats_overview['num_columns_explain'] = 'Hier hast Du die M&ouml;glichkeit die Anzahl der angezeigten Spalten zu setzten';
// [/stats_overview]
// [top_posters]
$top_posters = array();
$top_posters['module_name'] = 'Top Poster';
// [/top_posters]
// [top_posters_month]
$top_posters_month = array();
$top_posters_month['module_name'] = 'Benutzer mit den meisten Beitr&auml;gen in diesem Monat';
// [/top_posters_month]
// [top_posters_week]
$top_posters_week = array();
$top_posters_week['module_name'] = 'Benutzer mit den meisten Beitr&auml;gen in dieser Woche';
// [/top_posters_week]
// [topics_by_month]
$topics_by_month = array();
$topics_by_month['module_name'] = 'Anzahl neuer Themen in diesem Monat';
$topics_by_month['Year'] = 'Jahr';
$topics_by_month['Month_jan'] = 'Jan';
$topics_by_month['Month_feb'] = 'Feb';
$topics_by_month['Month_mar'] = 'Mar';
$topics_by_month['Month_apr'] = 'Apr';
$topics_by_month['Month_may'] = 'Mai';
$topics_by_month['Month_jun'] = 'Jun';
$topics_by_month['Month_jul'] = 'Jul';
$topics_by_month['Month_aug'] = 'Aug';
$topics_by_month['Month_sep'] = 'Sep';
$topics_by_month['Month_oct'] = 'Okt';
$topics_by_month['Month_nov'] = 'Nov';
$topics_by_month['Month_dec'] = 'Dez';
// [/topics_by_month]
// [most_active_topicstarter]
$most_active_topicstarter = array();
$most_active_topicstarter['module_name'] = 'Aktivste Themen-Ersteller';
// [/most_active_topicstarter]
// [posts_by_month]
$posts_by_month = array();
$posts_by_month['module_name'] = 'Anzahl neuer Beitr&auml;ge pro Monat';
$posts_by_month['Year'] = 'Jahr';
$posts_by_month['Month_jan'] = 'Jan';
$posts_by_month['Month_feb'] = 'Feb';
$posts_by_month['Month_mar'] = 'Mar';
$posts_by_month['Month_apr'] = 'Apr';
$posts_by_month['Month_may'] = 'Mai';
$posts_by_month['Month_jun'] = 'Jun';
$posts_by_month['Month_jul'] = 'Jul';
$posts_by_month['Month_aug'] = 'Aug';
$posts_by_month['Month_sep'] = 'Sep';
$posts_by_month['Month_oct'] = 'Okt';
$posts_by_month['Month_nov'] = 'Nov';
$posts_by_month['Month_dec'] = 'Dez';
// [/posts_by_month]
// [top_attachments]
$top_attachments = array();
$top_attachments['module_name'] = 'Am h&auml;ufigsten heruntergeladene Anh&auml;nge';
$top_attachments['Filename'] = 'Dateiname';
$top_attachments['Filecomment'] = 'Datei Kommentar';
$top_attachments['Size'] = 'Dateigr&ouml;sse';
$top_attachments['Downloads'] = 'Downloads';
$top_attachments['Posttime'] = 'Beitrag Datum';
$top_attachments['Posted_in_topic'] = 'Geschrieben in Thema';
$top_attachments['Hidden_from_public_view'] = 'Diese Datei ist versteckt f&uuml;r die &ouml;ffentliche Ansicht';
// Admin Variables
$top_attachments['exclude_images_title'] = 'Bilder ausschliessen';
$top_attachments['exclude_images_explain'] = 'Wenn diese Einstellung aktiviert ist, werden Bilder in der Top Anh&auml;nge Statistik nicht ber&uuml;cksichtigt.';
// [/top_attachments]
// [most_active_topics]
$most_active_topics = array();
$most_active_topics['module_name'] = 'Themen mit den meisten Antworten';
$most_active_topics['Hidden_from_public_view'] = 'Dieses Thema ist versteckt f&uuml;r die &ouml;ffentliche Ansicht';
// [/most_active_topics]
// [most_viewed_topics]
$most_viewed_topics = array();
$most_viewed_topics['module_name'] = 'Am h&auml;ufigsten betrachtete Themen';
$most_viewed_topics['Hidden_from_public_view'] = 'Dieses Thema ist versteckt f&uuml;r die &ouml;ffentliche Ansicht';
// [/most_viewed_topics]
// [most_interesting_topics]
$most_interesting_topics = array();
$most_interesting_topics['module_name'] = 'Die interessantesten Themen';
$most_interesting_topics['Rate'] = 'Rate (Betrachtungen/Nachricht)';
$most_interesting_topics['Hidden_from_public_view'] = 'Dieses Thema ist versteckt f&uuml;r die &ouml;ffentliche Ansicht';
// [/most_interesting_topics]
// [top_words]
$top_words = array();
$top_words['module_name'] = 'Am h&auml;ufigsten verwendete W&ouml;rter';
$top_words['Word'] = 'Wort';
$top_words['Count'] = 'Anzahl';
// [/top_words]
// [least_interesting_topics]
$least_interesting_topics = array();
$least_interesting_topics['module_name'] = 'Am wenigsten interessante Themen';
$least_interesting_topics['Rate'] = 'Rate (Betrachtungen/Nachricht)';
$least_interesting_topics['Hidden_from_public_view'] = 'Dieses Thema ist versteckt f&uuml;r die &ouml;ffentliche Ansicht';
// [/least_interesting_topics]
// [top_smilies]
$top_smilies = array();
$top_smilies['module_name'] = 'Top Smilies';
$top_smilies['Smilie_image'] = 'Smiley Bild';
$top_smilies['Smilie_code'] = 'Smiley Code';
// [/top_smilies]
// [users_by_month]
$users_by_month = array();
$users_by_month['module_name'] = 'Anzahl neuer Mitglieder pro Monat';
$users_by_month['Year'] = 'Jahr';
$users_by_month['Month_jan'] = 'Jan';
$users_by_month['Month_feb'] = 'Feb';
$users_by_month['Month_mar'] = 'Mar';
$users_by_month['Month_apr'] = 'Apr';
$users_by_month['Month_may'] = 'Mai';
$users_by_month['Month_jun'] = 'Jun';
$users_by_month['Month_jul'] = 'Jul';
$users_by_month['Month_aug'] = 'Aug';
$users_by_month['Month_sep'] = 'Sep';
$users_by_month['Month_oct'] = 'Okt';
$users_by_month['Month_nov'] = 'Nov';
$users_by_month['Month_dec'] = 'Dez';
// [/users_by_month]

?>