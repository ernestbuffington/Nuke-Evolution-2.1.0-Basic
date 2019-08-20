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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

$lang['Rebuild_search'] = 'Reconstruire la recherche';
$lang['Rebuild_search_desc'] = 'Ce mode index chaque message de votre forum, la reconstruction de la table de recherche. 
Vous pouvez vous arr&ecirc;ter quand vous voulez et la prochaine fois que vous lancez &agrave; nouveau, vous aurez la possibilit&eacute; de continuer de l\'endroit o&ugrave; vous vous &ecirc;tes arr&ecirc;t&eacute;. <br /> <br /> 
Il peut prendre un certain temps de montrer ses progr&egrave;s (en fonction de "Messages par cycle" et "Date limite"), 
s\'il vous pla&icirc;t, afin de ne pas bouger jusqu\'&agrave; ce que ses progr&egrave;s, il est complet, &agrave; moins bien s&ucirc;r que vous voulez interrompre.';

//
// Input screen
//
$lang['Starting_post_id'] = 'D&eacute;marer post_id';
$lang['Starting_post_id_explain'] = 'Premier post lorsque le traitement commence &agrave; <br /> Vous pouvez choisir &agrave; partir du d&eacute;but ou depuis le post o&ugrave; vous vous &ecirc;tes arr&ecirc;t&eacute;';

$lang['Start_option_beginning'] = '&agrave; partir de d&eacute;but';
$lang['Start_option_continue'] = 'continuer depuis l&agrave; o&ugrave; vous vous &ecirc;tes arr&ecirc;t&eacute;';

$lang['Clear_search_tables'] = 'Tables de recherche clean';
$lang['Clear_search_tables_explain'] = 'Lorsque vous d&eacute;marrez &agrave; partir du d&eacute;but, vous pouvez effacer les 3 tables recherche de phpBB  <br /> Vous avez la possibilit&eacute; de choisir entre le SUPPRIMER / TRONQUER m&eacute;thodes';
$lang['Clear_search_no'] = 'NON';
$lang['Clear_search_delete'] = 'SUPPRIMER';
$lang['Clear_search_truncate'] = 'TRONQUER';

$lang['Num_of_posts'] = 'Nombre de post';
$lang['Num_of_posts_explain'] = 'Nombre total de post dans le processus<br />Il est automatiquement rempli avec le nombre de total de postes restants dans la base de donn&eacute;es';

$lang['Posts_per_cycle'] = 'Posts par cycle';
$lang['Posts_per_cycle_explain'] = 'Nombre de post dans le processus par cycle<br />Tenir faible pour &eacute;viter le coupure du site';

$lang['Refresh_rate'] = 'taux de rafra&icirc;chissement';
$lang['Refresh_rate_explain'] = 'Combien de temps (sec) pour rester inactif avant de passer au prochain cycle de traitement <br /> En g&eacute;n&eacute;ral, vous n\'avez pas &agrave; changer cela';

$lang['Time_limit'] = 'Limite de temps';
$lang['Time_limit_explain'] = 'Combien de temps (secondes) de post-traitement peut durer avant de passer au cycle suivant';
$lang['Time_limit_explain_safe'] = '<i>Votre php (safe mode) dispose d\'un d&eacute;lai de %s secondes configur&eacute;, alors restez en dessous de cette valeur</i>';
$lang['Time_limit_explain_webserver'] = '<i>Votre serveur Web a un d&eacute;lai de %s secondes configur&eacute;, alors restez en dessous de cette valeur</i>';
$lang['Disable_board'] = 'D&eacute;sactiver table';
$lang['Disable_board_explain'] = 'Qu\'il s\'agisse ou pas de d&eacute;sactiver votre tableau d\'administration lors du traitement';
$lang['Disable_board_explain_enabled'] = 'Il sera activ&eactue;e automatiquement apr&egrave;s la fin du traitement';
$lang['Disable_board_explain_already'] = '<i>Votre table d\'administration est d&eacte;j&agrave; d&eacute;sactiv&eacute; par le biais de la configuration admin</i>';

$lang['Fast_mode'] = 'Mode rapide';
$lang['Fast_mode_explain'] = 'L\'ensemble du processus de la base de donn&eacute;es sans enlever les premi&egrave;res entr&eacute;es  <br /> utiliser avec pr&eacute;caution! S\'il vous pla&icirc;t lire les instructions pour plus de d&eacute;tails.';

$lang['Max_info'] = '(Max : %d)';

//
// Information strings
//
$lang['Info_processing_stopped'] = 'Vous avez arr&ecirc;t&eacute; le dernier traitement au post_id %s (%s post trait&eacute;) sur %s';
$lang['Info_processing_aborted'] = 'Vous avez interrompu le dernier traitement au post_id %s (%s post trait&eacute;) sur %s';
$lang['Info_processing_aborted_soon'] = 'S\'il vous pla&icirc;t attendez un peu avant de continuer ...';
$lang['Info_processing_finished'] = 'Vous avez termin&eacute; le traitement (%s post trait&eacute;) sur %s';
$lang['Info_processing_finished_new'] = 'Vous avez termin&eacute; le traitement au post_id %s (%s post trait&eacute;) sur %s,<br />mais il y a eu %s nouveau message(s) apr&egrave;s cette date';

//
// Progress screen
//
$lang['Rebuild_search_progress'] = 'Reconstruire le processus de recherche';

$lang['Processed_post_ids'] = 'Traitement post ids : %s - %s';
$lang['Timer_expired'] = 'Timer est arriv&eacute; &agrave; &eacute;ch&eacute;ance &agrave; %s secs. ';
$lang['Cleared_search_tables'] = 'Tables de recherche n&eacute;ttoy&eacute;es. ';
$lang['Deleted_posts'] = '%s poste (s) ont &eacute;t&eacute; supprim&eacute;s par les utilisateurs au cours du traitement. ';
$lang['Processing_next_posts'] = 'Traitement de %s prochain post(s). S\'il vous pla&icirc;t patienter ...';
$lang['All_session_posts_processed'] = 'Tous les posts trait&eacute;s durant la session en cours';
$lang['All_posts_processed'] = 'Tous les posts ont &eacute;t&eacute; trait&eacute; avec succ&egrave;s.';
$lang['All_tables_optimized'] = 'Toutes les tables de recherche ont &eacute;t&eacute; optimis&eacute; avec succ&egrave;s.';

$lang['Processing_post_details'] = 'De&acute;tails du traitement du post';
$lang['Processed_posts'] = 'Traitement des posts';
$lang['Percent'] = 'Pourcentage';
$lang['Current_session'] = 'Session en cours';
$lang['Total'] = 'Total';

$lang['Process_details'] = 'Pour <b>%s</b> &agrave; <b>%s</b> (sur un total de <b>%s</b>)';
$lang['Percent_completed'] = '%s %% termin&eacute;';

$lang['Processing_time_details'] = 'D&eacute;lai du temps de traitement';
$lang['Processing_time'] = 'Temps de traitement';
$lang['Time_last_posts'] = 'Dernier %s post(s) de la session en cours';
$lang['Time_from_the_beginning'] = 'Depuis le d&eacute;but de la session en cours';
$lang['Time_average'] = 'Moyenne par cycle de la session en cours';
$lang['Time_estimated'] = 'Estim&eacute;e jusqu\'&agrave; la fin de la session en cours';

$lang['days'] = 'Jours';
$lang['hours'] = 'heures';
$lang['minutes'] = 'minutes';
$lang['seconds'] = 'secondes';

$lang['Database_size_details'] = 'D&eacute;tails de la taille de base de donn&eacute;es';
$lang['Size_current'] = 'Actuel';
$lang['Size_estimated'] = 'Estim&eacute; apr&egrave;s la fin';
$lang['Size_search_tables'] = 'Taille de la table de racherche';
$lang['Size_database'] = 'Taille de la base de donn&eacute;es';

$lang['Bytes'] = 'Bits';

$lang['Active_parameters'] = 'Param&egrave;tres actif';
$lang['Posts_last_cycle'] = 'Post(s) trait&eacute; dans le dernier cycle';
$lang['Board_status'] = 'Table &eacute;tat';
$lang['Board_disabled'] = 'D&eacute;sactiv&eacute;';
$lang['Board_enabled'] = 'Activ&eacute;';

$lang['Info_estimated_values'] = '(*) Toutes les valeurs sont estim&eacute; par rapport au pourcentage en cour de r&eacute;alisation et peuvent ne pas repr&eacute;senter la r&eacute;alit&eacute; des valeurs finales. Comme le pourcentage de fin se rapproche de la valeurs estim&eacute;e par rapport &agrave; la valeur r&eacute;els.';

$lang['Click_return_rebuild_search'] = 'Clique %sici%s pour retourner &agrave; la reconstruction de la recherche';
$lang['Rebuild_search_aborted'] = 'Reconstruction de la recherche avort&eacute; post_id %s.<br /><br />Si vous a &eacute;t&eacute; interrompu pendant le traitement, vous devez attendre un peu avant de lancer une nouvelle reconstruction de la recherche, de sorte que le dernier cycle arrive &agrave; la fin';
$lang['Wrong_input'] = 'Vous avez entr&eacute; des valeurs erron&eacute;es. S\'il vous pla&icirc;t v&eacute;rifier votre saisie et essayez &agrave; nouveau.';

// Buttons
$lang['Next'] = 'Suivant';
$lang['Processing'] = 'Traitement ...';
$lang['Finished'] = 'Termin&eacute;';

?>