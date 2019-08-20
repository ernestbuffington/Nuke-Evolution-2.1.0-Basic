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
$admin_statistics['module_name'] = 'Administrative Statistieken';
$admin_statistics['Board_Up_Days'] = 'Board Online in dagen';
$admin_statistics['Latest_Reg_User'] = 'Laatste lid';
$admin_statistics['Latest_Reg_User_Date'] = 'Registreringsdatum laatste lid';
$admin_statistics['Most_Ever_Online'] = 'Aantal gebruikers die gelijktijg online waren';
$admin_statistics['Most_Ever_Online_Date'] = 'Datum wanneer de meeste gebruiker online waren';
$admin_statistics['Disk_usage'] = 'Schijfgebruik';
// [/admin_statistics]
// [stats_overview]
$stats_overview = array();
$stats_overview['module_name'] = 'Statistieken overzicht';
// Admin Specific
$stats_overview['num_columns_title'] = 'Aantal spaties instellen';
$stats_overview['num_columns_explain'] = 'Hier heeft u de mogelijkheid om het aan weergegeven spaties in te stellen';
// [/stats_overview]
// [top_posters]
$top_posters = array();
$top_posters['module_name'] = 'Top Poster';
// [/top_posters]
// [top_posters_month]
$top_posters_month = array();
$top_posters_month['module_name'] = 'Gebruiker met de meeste inzendingen deze maand';
// [/top_posters_month]
// [top_posters_week]
$top_posters_week = array();
$top_posters_week['module_name'] = 'Gebruiker met de meeste inzendingen deze week';
// [/top_posters_week]
// [topics_by_month]
$topics_by_month = array();
$topics_by_month['module_name'] = 'Aantal nieuwe onderwerpen deze maand';
$topics_by_month['Year'] = 'Jaar';
$topics_by_month['Month_jan'] = 'Jan';
$topics_by_month['Month_feb'] = 'Feb';
$topics_by_month['Month_mar'] = 'Mar';
$topics_by_month['Month_apr'] = 'Apr';
$topics_by_month['Month_may'] = 'Mei';
$topics_by_month['Month_jun'] = 'Jun';
$topics_by_month['Month_jul'] = 'Jul';
$topics_by_month['Month_aug'] = 'Aug';
$topics_by_month['Month_sep'] = 'Sep';
$topics_by_month['Month_oct'] = 'Okt';
$topics_by_month['Month_nov'] = 'Nov';
$topics_by_month['Month_dec'] = 'Dec';
// [/topics_by_month]
// [most_active_topicstarter]
$most_active_topicstarter = array();
$most_active_topicstarter['module_name'] = 'Actiefste plaatser van onderwerpen';
// [/most_active_topicstarter]
// [posts_by_month]
$posts_by_month = array();
$posts_by_month['module_name'] = 'Aantal nieuwe inzendingen per maand';
$posts_by_month['Year'] = 'Jaar';
$posts_by_month['Month_jan'] = 'Jan';
$posts_by_month['Month_feb'] = 'Feb';
$posts_by_month['Month_mar'] = 'Mar';
$posts_by_month['Month_apr'] = 'Apr';
$posts_by_month['Month_may'] = 'Mei';
$posts_by_month['Month_jun'] = 'Jun';
$posts_by_month['Month_jul'] = 'Jul';
$posts_by_month['Month_aug'] = 'Aug';
$posts_by_month['Month_sep'] = 'Sep';
$posts_by_month['Month_oct'] = 'Okt';
$posts_by_month['Month_nov'] = 'Nov';
$posts_by_month['Month_dec'] = 'Dec';
// [/posts_by_month]
// [top_attachments]
$top_attachments = array();
$top_attachments['module_name'] = 'Meest gedownloade bijlages';
$top_attachments['Filename'] = 'Bestandsnaam';
$top_attachments['Filecomment'] = 'Commentaar bestand';
$top_attachments['Size'] = 'Bestandsgrootte';
$top_attachments['Downloads'] = 'Downloads';
$top_attachments['Posttime'] = 'Datum inzending';
$top_attachments['Posted_in_topic'] = 'Geplaatst in onderwerp';
$top_attachments['Hidden_from_public_view'] = 'Dit bestand is verborgen voor publieke weergave';
// Admin Variables
$top_attachments['exclude_images_title'] = 'Afbeeldingen uitzonderen';
$top_attachments['exclude_images_explain'] = 'Als deze instelling geactiveerd is worden de afbeeldingen in de Top bijlages statistieken niet meegenomen.';
// [/top_attachments]
// [most_active_topics]
$most_active_topics = array();
$most_active_topics['module_name'] = 'Onderwerpen met de meeste antwoorden';
$most_active_topics['Hidden_from_public_view'] = 'Dit onderwerp is verborgen voor publiekelijke weergave';
// [/most_active_topics]
// [most_viewed_topics]
$most_viewed_topics = array();
$most_viewed_topics['module_name'] = 'Meest bekeken onderwerpen';
$most_viewed_topics['Hidden_from_public_view'] = 'Dit onderwerp is verborgen voor publiekelijke weergave';
// [/most_viewed_topics]
// [most_interesting_topics]
$most_interesting_topics = array();
$most_interesting_topics['module_name'] = 'De interessanste onderwerpen';
$most_interesting_topics['Rate'] = 'waarderingen (bekeken onderwerpen)';
$most_interesting_topics['Hidden_from_public_view'] = 'Dit onderwerp is verborgen voor publiekelijke weergave';
// [/most_interesting_topics]
// [top_words]
$top_words = array();
$top_words['module_name'] = 'Meest gebruikte woorden';
$top_words['Word'] = 'Woord';
$top_words['Count'] = 'Aantal';
// [/top_words]
// [least_interesting_topics]
$least_interesting_topics = array();
$least_interesting_topics['module_name'] = 'Minst interessante onderwerpen';
$least_interesting_topics['Rate'] = 'waarderingen (bekeken onderwerpe)';
$least_interesting_topics['Hidden_from_public_view'] = 'Dit onderwerp is verborgen voor publiekelijke weergave';
// [/least_interesting_topics]
// [top_smilies]
$top_smilies = array();
$top_smilies['module_name'] = 'Top Smilies';
$top_smilies['Smilie_image'] = 'Smiley';
$top_smilies['Smilie_code'] = 'Smiley Code';
// [/top_smilies]
// [users_by_month]
$users_by_month = array();
$users_by_month['module_name'] = 'Aantal nieuwe leden per maand';
$users_by_month['Year'] = 'Jaar';
$users_by_month['Month_jan'] = 'Jan';
$users_by_month['Month_feb'] = 'Feb';
$users_by_month['Month_mar'] = 'Mar';
$users_by_month['Month_apr'] = 'Apr';
$users_by_month['Month_may'] = 'Mei';
$users_by_month['Month_jun'] = 'Jun';
$users_by_month['Month_jul'] = 'Jul';
$users_by_month['Month_aug'] = 'Aug';
$users_by_month['Month_sep'] = 'Sep';
$users_by_month['Month_oct'] = 'Okt';
$users_by_month['Month_nov'] = 'Nov';
$users_by_month['Month_dec'] = 'Dec';
// [/users_by_month]

?>