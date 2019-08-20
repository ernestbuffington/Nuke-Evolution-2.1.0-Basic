<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
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

if (!defined('MODULE_FILE') ) {
    die('You can\'t access this file directly...');
}

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}


// [admin_statistics]
$admin_statistics = array();
$admin_statistics['module_name'] = 'Administration Statistique';
$admin_statistics['Board_Up_Days'] = 'Board Up Days';
$admin_statistics['Latest_Reg_User'] = 'Dernier utilisateur enregistr&eacute;';
$admin_statistics['Latest_Reg_User_Date'] = 'Date du dernier utilsateur enregistr&eacute;';
$admin_statistics['Most_Ever_Online'] = 'Le plus d\'utilisateur en ligne';
$admin_statistics['Most_Ever_Online_Date'] = 'Date du plus grand nombre d\'utilisateur en ligne';
$admin_statistics['Disk_usage'] = 'Disque utilis&eacute;';
// [/admin_statistics]
// [stats_overview]
$stats_overview = array();
$stats_overview['module_name'] = 'Vue d\'ensemble des Statistiques';
$stats_overview['num_columns_title'] = 'D&eacute;finir le nombre de colonnes';
$stats_overview['num_columns_explain'] = 'Ici vous &ecirc;tes en mesure de fixer le nombre de colonnes affich&eacute;es';
// [/stats_overview]
// [top_posters]
$top_posters = array();
$top_posters['module_name'] = 'Top Posteur';
// [/top_posters]
// [top_posters_month]
$top_posters_month = array();
$top_posters_month['module_name'] = 'Top posteur de ce mois';
// [/top_posters_month]
// [top_posters_week]
$top_posters_week = array();
$top_posters_week['module_name'] = 'Top posteur de la semaine';
// [/top_posters_week]
// [topics_by_month]
$topics_by_month = array();
$topics_by_month['module_name'] = 'Nombre de nouveau message de ce mois';
$topics_by_month['Year'] = 'Ann&eacute;e';
$topics_by_month['Month_jan'] = 'Jan';
$topics_by_month['Month_feb'] = 'Feb';
$topics_by_month['Month_mar'] = 'Mar';
$topics_by_month['Month_apr'] = 'Avr';
$topics_by_month['Month_may'] = 'Mai';
$topics_by_month['Month_jun'] = 'Jui';
$topics_by_month['Month_jul'] = 'Juil';
$topics_by_month['Month_aug'] = 'Aou';
$topics_by_month['Month_sep'] = 'Sep';
$topics_by_month['Month_oct'] = 'Oct';
$topics_by_month['Month_nov'] = 'Nov';
$topics_by_month['Month_dec'] = 'Dec';
// [/topics_by_month]
// [most_active_topicstarter]
$most_active_topicstarter = array();
$most_active_topicstarter['module_name'] = 'Utilisateurs les plus actifs en nouveau post';
// [/most_active_topicstarter]
// [posts_by_month]
$posts_by_month = array();
$posts_by_month['module_name'] = 'Nombre de nouveau post par mois';
$posts_by_month['Year'] = 'Ann&eacute;e';
$posts_by_month['Month_jan'] = 'Jan';
$posts_by_month['Month_feb'] = 'Feb';
$posts_by_month['Month_mar'] = 'Mar';
$posts_by_month['Month_apr'] = 'Apr';
$posts_by_month['Month_may'] = 'May';
$posts_by_month['Month_jun'] = 'Jun';
$posts_by_month['Month_jul'] = 'Jul';
$posts_by_month['Month_aug'] = 'Aug';
$posts_by_month['Month_sep'] = 'Sep';
$posts_by_month['Month_oct'] = 'Oct';
$posts_by_month['Month_nov'] = 'Nov';
$posts_by_month['Month_dec'] = 'Dec';
// [/posts_by_month]
// [most_viewed_topics]
$most_viewed_topics = array();
$most_viewed_topics['module_name'] = 'Sujets plus regard&eacute;es';
$most_viewed_topics['Hidden_from_public_view'] = 'Ce sujet est cach&eacute;e &agrave; la vue du public';
// [/most_viewed_topics]
// [top_attachments]
$top_attachments = array();
$top_attachments['module_name'] = 'Top T&eacute;l&eacute;charg&eacute;s Attachements';
$top_attachments['Filename'] = 'Nom de fichier';
$top_attachments['Filecomment'] = 'Commentaire du fichier';
$top_attachments['Size'] = 'Taille du fichier ';
$top_attachments['Downloads'] = 'T&eacute;l&eacute;chargement';
$top_attachments['Posttime'] = 'Heure du post';
$top_attachments['Posted_in_topic'] = 'Post&eacute; dans la rubrique';
$top_attachments['Hidden_from_public_view'] = 'Ce fichier est cach&eacute; &agrave; la vue du public';
$top_attachments['exclude_images_title'] = 'Exclude Images';
$top_attachments['exclude_images_explain'] = 'Si ce param&egrave;tre est activ&eacute;, les images ne sont pas consid&eacute;r&eacute;s dans le Haut Attachements statistiques.';
// [/top_attachments]
// [most_active_topics]
$most_active_topics = array();
$most_active_topics['module_name'] = 'Sujets les plus actifs';
$most_active_topics['Hidden_from_public_view'] = 'Ce sujet est cach&eacute;e &agrave; la vue du public';
// [/most_active_topics]
// [most_viewed_topics]
$most_viewed_topics = array();
$most_viewed_topics['module_name'] = 'Les plus regard&eacute;es des sujets';
$most_viewed_topics['Hidden_from_public_view'] = 'Ce sujet est cach&eacute;e &agrave; la vue du public';
// [/most_viewed_topics]
// [most_interesting_topics]
$most_interesting_topics = array();
$most_interesting_topics['module_name'] = 'Le plus int&eacute;rssants des sujets';
$most_interesting_topics['Rate'] = 'Taux (vues/messages)';
// [/most_interesting_topics]
// [top_words]
$top_words = array();
$top_words['module_name'] = 'Plus utilis&eacute; des mots';
$top_words['Word'] = 'Mot';
$top_words['Count'] = 'Nombre';
// [/top_words]
// [least_interesting_topics]
$least_interesting_topics = array();
$least_interesting_topics['module_name'] = 'Les sujets les moins int&eacute;ressants';
$least_interesting_topics['Rate'] = 'Taux (vues/messages)';
// [/least_interesting_topics]
// [top_smilies]
$top_smilies = array();
$top_smilies['module_name'] = 'Top Smilies';
$top_smilies['Smilie_image'] = 'Smiley Image';
$top_smilies['Smilie_code'] = 'Smiley Code';
// [/top_smilies]
// [users_by_month]
$users_by_month = array();
$users_by_month['module_name'] = 'Nombre de nouveau utilisateur par mois';
$users_by_month['Year'] = 'Ann&eacute;e';
$users_by_month['Month_jan'] = 'Jan';
$users_by_month['Month_feb'] = 'F&eacute;v';
$users_by_month['Month_mar'] = 'Mar';
$users_by_month['Month_apr'] = 'Avr';
$users_by_month['Month_may'] = 'Mai';
$users_by_month['Month_jun'] = 'Jui';
$users_by_month['Month_jul'] = 'Juil';
$users_by_month['Month_aug'] = 'Aou';
$users_by_month['Month_sep'] = 'Sep';
$users_by_month['Month_oct'] = 'Oct';
$users_by_month['Month_nov'] = 'Nov';
$users_by_month['Month_dec'] = 'D&eacute;c';
// [/users_by_month]

?>