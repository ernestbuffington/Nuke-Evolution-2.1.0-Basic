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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

global $new_username, $board_config, $activate_link;

$lang['DATE_FORMAT'] =  'd M Y'; // This should be changed to the default date format for your language, php date() format
$lang['DIRECTION'] = 'ltr';
$lang['ENCODING'] = 'UTF-8'; 
$lang['LEFT'] = 'Gauche';
$lang['RIGHT'] = 'Droit';
//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'D&eacute;sol&eacute;, mais seuls les %s peuvent poster des annonces dans ce forum.';
$lang['Sorry_auth_sticky'] = 'D&eacute;sol&eacute;, mais seuls les %s peuvent poster des post-it dans ce forum.';
$lang['Sorry_auth_read'] = 'D&eacute;sol&eacute;, mais seuls les %s peuvent lire des sujets dans ce forum.';
$lang['Sorry_auth_post'] = 'D&eacute;sol&eacute;, mais seuls les %s peuvent poster dans ce forum.';
$lang['Sorry_auth_reply'] = 'D&eacute;sol&eacute;, mais seuls les %s peuvent r&eacute;pondre aux messages dans ce forum.';
$lang['Sorry_auth_edit'] = 'D&eacute;sol&eacute;, mais seuls les %s peuvent &eacute;diter des messages dans ce forum.';
$lang['Sorry_auth_delete'] = 'D&eacute;sol&eacute;, mais seuls les %s peuvent supprimer des messages dans ce forum.';
$lang['Sorry_auth_vote'] = 'D&eacute;sol&eacute;, mais seuls les %s peuvent voter aux sondages dans ce forum.';
// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>utilisateurs anonymes</b>';
$lang['Auth_Registered_Users'] = '<b>utilisateurs enregistr&eacute;s</b>';
$lang['Auth_Users_granted_access'] = '<b>utilisateurs avec un acc&egrave;s sp&eacute;cial</b>';
$lang['Auth_Moderators'] = '<b>mod&eacute;rateurs</b>';
$lang['Auth_Administrators'] = '<b>administrateurs</b>';
$lang['Not_Moderator'] = 'Vous n\'&ecirc;tes pas mod&eacute;rateur sur ce forum.';
$lang['Not_Authorised'] = 'Non Autoris&eacute;';
$lang['You_been_banned'] = 'Vous avez &eacute;t&eacute; banni de ce forum.<br />Veuillez contacter le webmaster ou l\'administrateur du forum pour plus d\'informations.';
//
// Common, these terms are used extensively on several pages
//
$lang['1_Day'] = '1 Jour';
$lang['1_Month'] = '1 Mois';
$lang['1_Year'] = '1 An';
$lang['2_Weeks'] = '2 Semaines';
$lang['3_Months'] = '3 Mois';
$lang['6_Months'] = '6 Mois';
$lang['7_Days'] = '7 Jours';
$lang['AIM'] = 'Adresse AIM';
$lang['Admin_panel'] = 'Aller au Panneau d\'administration';
$lang['Author'] = 'Auteur';
$lang['Board_disable'] = 'D&eacute;sol&eacute;, mais ce forum est actuellement indisponible. Veuillez r&eacute;essayer ult&eacute;rieurement.';
$lang['Cancel'] = 'Annuler';
$lang['Category'] = 'Cat&eacute;gorie';
$lang['Click_return_forum'] = 'Cliquez %sici%s pour retourner au forum';
$lang['Click_return_group'] = 'Cliquez %sici%s pour retourner aux informations du groupe';
$lang['Click_return_login'] = 'Cliquez %sici%s pour r&eacute;essayer';
$lang['Click_return_modcp'] = 'Cliquez %sici%s pour retourner au Panneau de Contr&ocirc;le du Mod&eacute;rateur';
$lang['Click_return_topic'] = 'Cliquez %sici%s pour retourner au sujet de discussion'; // %s's here are for uris, do not remove!
$lang['Click_view_message'] = 'Cliquez %sici%s pour voir votre message';
$lang['Confirm'] = 'Confirmer';
$lang['Could_not_insert_for'] = 'Impossible d\'ajouter %d de %d';
$lang['Could_not_optain_for'] = 'Impossible d\'obtenir %d de %d';
$lang['Could_not_update'] = 'Impossible de mettre &agrave; jour %d';
$lang['Disabled'] = 'D&eacute;sactiv&eacute;';
$lang['Email'] = 'E-mail';
$lang['Enabled'] = 'Activ&eacute;';
$lang['Error'] = 'Erreur';
$lang['Forum'] = 'Forum';
$lang['Forum_Index'] = '%s Index du Forum';  // eg. sitename Forum Index, %s can be removed if you prefer
$lang['Go'] = 'Aller';
$lang['Goto_page'] = 'Aller &agrave; la page';
$lang['Hours'] = 'Heures';
$lang['ICQ'] = 'Num&eacute;ro ICQ';
$lang['IP_Address'] = 'Adresse IP';
$lang['Joined'] = 'Inscrit le';
$lang['Jump_to'] = 'Aller vers';
$lang['MSNM'] = 'MSN Messenger';
$lang['Message'] = 'Message';
$lang['Next'] = 'Suivante';
$lang['No'] = 'Non';
$lang['Page_of'] = 'Page <b>%d</b> sur <b>%d</b>'; // Replaces with: Page 1 of 2 for example
$lang['Password'] = 'Mot de passe';
$lang['Post'] = 'Message';
$lang['Post_new_topic'] = 'Poster un nouveau sujet';
$lang['Posted'] = 'Post&eacute; le';
$lang['Poster'] = 'Poster';
$lang['Posts'] = 'Messages';
$lang['Preview'] = 'Pr&eacute;visualisation';
$lang['Previous'] = 'Pr&eacute;c&eacute;dente';
$lang['Replies'] = 'R&eacute;ponses';
$lang['Reply_to_topic'] = 'R&eacute;pondre au sujet';
$lang['Reply_with_quote'] = 'R&eacute;pondre en citant';
$lang['Reset'] = 'R&eacute;initialiser';
$lang['Select_forum'] = 'S&eacute;lectionner un forum';
$lang['Select_username'] = 'S&eacute;lectionner un utilisateur';
$lang['Spellcheck'] = 'V&eacute;rificateur d\'orthographe';
$lang['Submit'] = 'Envoyer';
$lang['Time'] = 'Temps';
$lang['Topic'] = 'Sujet';
$lang['Topics'] = 'Sujets';
$lang['Username'] = 'Nom d\'utilisateur';
$lang['View_latest_post'] = 'Voir le dernier message';
$lang['View_newest_post'] = 'Voir le message le plus r&eacute;cent';
$lang['Views'] = 'Vus';
$lang['YIM'] = 'Yahoo Messenger';
$lang['Yes'] = 'Oui';
//
// Email-Extention
//
$lang['HELLO'] = 'Salut';
$lang['NEW_ACCOUNT_OBJECT'] = 'Le compte appartenant &agrave; ' . $new_username . ' a &eacute;t&eacute; d&eacute;sactiv&eacute; ou nouvellement cr&eacute;&eacute;, vous devriez v&eacute;rifier les d&eacute;tails de cet utilisateur (si n&eacute;cessaire) et l\'activer en utilisant le lien suivant:';
$lang['NEW_ACCOUNT_ACTIVATE_LINK'] = 'Lien: <a href="'. $activate_link . '>'. $activate_link .'</a>';
$lang['REACTIVATE_ACCOUNT_OBJECT'] = 'Votre compte '. $board_config['sitename'] .' a &eacute;t&eacute; d&eacute;sactiv&eacute;, vraisemblablement en raison de modifications apport&eacute;es &agrave; votre profil. Afin de r&eacute;activer votre compte, vous devez cliquer sur le lien ci-dessous:';
$lang['REACTIVATE_ACCOUNT_ACTIVATE_LINK'] = 'Lien: <a href="'. $activate_link . '>'. $activate_link .'</a>';
//
// Global Header strings
//
$lang['Registered_users'] = 'Utilisateurs enregistr&eacute;s:';
$lang['Browsing_forum'] = 'Utilisateurs parcourant actuellement ce forum:';
$lang['Online_users_zero_total'] = 'Il y a en tout <b>0</b> utilisateur en ligne :: ';
$lang['Online_users_total'] = 'Il y a en tout <b>%d</b> utilisateurs en ligne :: ';
$lang['Online_user_total'] = 'Il y a en tout <b>%d</b> utilisateur en ligne :: ';
$lang['Reg_users_zero_total'] = '0 Enregistr&eacute;, ';
$lang['Reg_users_total'] = '%d Enregistr&eacute;s, ';
$lang['Reg_user_total'] = '%d Enregistr&eacute;, ';
$lang['Hidden_users_zero_total'] = '0 Invisible et ';
$lang['Hidden_users_total'] = '%d Invisibles et ';
$lang['Hidden_user_total'] = '%d Invisible et ';
$lang['Guest_users_zero_total'] = '0 Invit&eacute;';
$lang['Guest_users_total'] = '%d Invit&eacute;s';
$lang['Guest_user_total'] = '%d Invit&eacute;';
$lang['Record_online_users'] = 'Le record du nombre d\'utilisateurs en ligne est de <b>%s</b> le %s'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrateur%s';
$lang['Mod_online_color'] = '%sMod&eacute;rateur%s';

$lang['You_last_visit'] = 'Derni&egrave;re visite le %s'; // %s replaced by date/time
$lang['Current_time'] = 'La date actuelle est le %s'; // %s replaced by date/time

$lang['Search_new'] = 'Voir les nouveaux messages depuis votre derni&egrave;re visite';
$lang['Search_your_posts'] = 'Voir ses messages';
$lang['Search_unanswered'] = 'Voir les messages sans r&eacute;ponses';

$lang['Register'] = 'S\'enregistrer';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = 'Editer votre profil';
$lang['Search'] = 'Rechercher';
$lang['Memberlist'] = 'Liste des Membres';
$lang['FAQ'] = 'FAQ';
$lang['Viewonline'] = 'Qui est en ligne';
/*****[BEGIN]******************************************
 [ Mod:     Forum Statistics                   v1.2.2 ]
 ******************************************************/
$lang['Statistics'] = 'Statistiques';
/*****[END]********************************************
 [ Mod:     Forum Statistics                   v1.2.2 ]
 ******************************************************/
$lang['BBCode_guide'] = 'Guide du BBCode';
$lang['Usergroups'] = 'Groupes d\'utilisateurs';
$lang['Last_Post'] = 'Derniers Messages';
/*****[BEGIN]******************************************
 [ Mod:     Resize Posted Images               v2.4.5 ]
 ******************************************************/
$lang['rmw_image_title'] = 'Cliquez pour voir en taille originale';
/*****[END]********************************************
 [ Mod:     Resize Posted Images               v2.4.5 ]
 ******************************************************/
$lang['Moderator'] = 'Mod&eacute;rateur';
$lang['Moderators'] = 'Mod&eacute;rateurs';
//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Nos membres ont post&eacute; un total de <b>0</b> message'; // Number of posts
$lang['Posted_articles_total'] = 'Nos membres ont post&eacute; un total de <b>%d</b> messages'; // Number of posts
$lang['Posted_article_total'] = 'Nos membres ont post&eacute; un total de <b>%d</b> message'; // Number of posts
$lang['Registered_users_zero_total'] = 'Nous avons <b>0</b> utilisateur enregistr&eacute;'; // # registered users
$lang['Registered_users_total'] = 'Nous avons <b>%d</b> membres enregistr&eacute;s'; // # registered users
$lang['Registered_user_total'] = 'Nous avons <b>%d</b> membre enregistr&eacute;'; // # registered users
$lang['Newest_user'] = 'L\'utilisateur enregistr&eacute; le plus r&eacute;cent est <b>%s%s%s</b>'; // a href, username, /a 
$lang['No_new_posts_last_visit'] = 'Pas de nouveaux messages depuis votre derni&egrave;re visite';
$lang['No_new_posts'] = 'Pas de nouveaux messages';
$lang['New_posts'] = 'Nouveaux messages';
$lang['New_post'] = 'Nouveau message';
$lang['No_new_posts_hot'] = 'Pas de nouveaux messages [ Populaire ]';
$lang['New_posts_hot'] = 'Nouveaux messages [ Populaire ]';
$lang['No_new_posts_locked'] = 'Pas de nouveaux messages [ Verrouill&eacute; ]';
$lang['New_posts_locked'] = 'Nouveaux messages [ Verrouill&eacute; ]';
$lang['Forum_is_locked'] = 'Forum Verrouill&eacute;';
//
// Login
//
$lang['Enter_password'] = 'Veuillez entrer votre nom d\'utilisateur et votre mot de passe pour vous connecter.';
$lang['Login'] = 'Connexion';
$lang['Logout'] = 'D&eacute;connexion';
$lang['Forgotten_password'] = 'J\'ai oubli&eacute; mon mot de passe';
$lang['Log_me_in'] = 'Se connecter automatiquement &agrave; chaque visite';
$lang['Error_login'] = 'Vous avez sp&eacute;cifi&eacute; un nom d\'utilisateur incorrect ou inactif ou un mot de passe invalide';
//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Pas de Messages';
$lang['No_forums'] = 'Ce Forum n\'a pas de sous-forums';
$lang['Private_Message'] = 'Message Priv&eacute;';
$lang['Private_Messages'] = 'Messages Priv&eacute;s';
$lang['Who_is_Online'] = 'Qui est en ligne ?';
$lang['Mark_all_forums'] = 'Marquer tous les forums comme lus';
$lang['Forums_marked_read'] = 'Tous les forums ont &eacute;t&eacute; marqu&eacute;s comme lus';
//
// Viewforum
//
$lang['All_Topics'] = 'Tous les Sujets';
$lang['Display_topics'] = 'Montrer les sujets depuis';
$lang['Forum_not_exist'] = 'Le forum que vous avez s&eacute;lectionn&eacute; n\'existe pas.';
$lang['Mark_all_topics'] = 'Marquez tous les sujets comme lus';
$lang['No_topics_post_one'] = 'Il n\'y a pas de messages dans ce forum<br />Cliquez sur le lien <b>Poster un Nouveau Sujet</b> sur cette page pour en poster un.';
$lang['Reached_on_error'] = 'Vous avez atteint cette page par erreur.';
$lang['Rules_edit_can'] = 'Vous <b>pouvez</b> &eacute;diter vos messages dans ce forum';
$lang['Rules_edit_cannot'] = 'Vous <b>ne pouvez pas</b> &eacute;diter vos messages dans ce forum';
$lang['Rules_delete_can'] = 'Vous <b>pouvez</b> supprimer vos messages dans ce forum';
$lang['Rules_delete_cannot'] = 'Vous <b>ne pouvez pas</b> supprimer vos messages dans ce forum';
$lang['Rules_moderate'] = 'Vous <b>pouvez</b> %smod&eacute;rer ce forum%s'; // %s replaced by a href links, do not remove! 
$lang['Rules_post_can'] = 'Vous <b>pouvez</b> poster de nouveaux sujets dans ce forum';
$lang['Rules_post_cannot'] = 'Vous <b>ne pouvez pas</b> poster de nouveaux sujets dans ce forum';
$lang['Rules_reply_can'] = 'Vous <b>pouvez</b> r&eacute;pondre aux sujets dans ce forum';
$lang['Rules_reply_cannot'] = 'Vous <b>ne pouvez pas</b> r&eacute;pondre aux sujets dans ce forum';
$lang['Rules_vote_can'] = 'Vous <b>pouvez</b> voter dans les sondages de ce forum';
$lang['Rules_vote_cannot'] = 'Vous <b>ne pouvez pas</b> voter dans les sondages de ce forum';
$lang['Topic_Announcement'] = '<b>Annonce:</b>';
$lang['Topic_Sticky'] = '<b>Post-it:</b>';
$lang['Topic_Moved'] = '<b>D&eacute;plac&eacute;:</b>';
$lang['Topic_Poll'] = '<b>[ Sondage ]</b>';
$lang['Topics_marked_read'] = 'Les sujets de forum sont &agrave; pr&eacute;sent marqu&eacute;s comme lus.';
$lang['View_forum'] = 'Voir le Forum';
//
// Viewtopic
//
$lang['View_topic'] = 'Voir le sujet';

$lang['Guest'] = 'Invit&eacute;';
$lang['Post_subject'] = 'Sujet du message';
$lang['View_next_topic'] = 'Voir le sujet suivant';
$lang['View_previous_topic'] = 'Voir le sujet pr&eacute;c&eacute;dent';
$lang['Submit_vote'] = 'Envoyer le vote';
$lang['View_results'] = 'Voir les r&eacute;sultats';
$lang['must_first_vote'] = 'Vous devez voter avant de pouvoir voir les r&eacute;sultats de ce sondage';

$lang['No_newer_topics'] = 'Il n\'y a pas de nouveaux sujets dans ce forum';
$lang['No_older_topics'] = 'Il n\'y a pas d\'anciens sujets dans ce forum';
$lang['Topic_post_not_exist'] = 'Le sujet ou message que vous recherchez n\'existe pas';
$lang['No_posts_topic'] = 'Il n\'existe pas de messages pour ce sujet';

$lang['Display_posts'] = 'Montrer les messages depuis';
$lang['All_Posts'] = 'Tous les messages';
$lang['Newest_First'] = 'Le plus r&eacute;cent en premier';
$lang['Oldest_First'] = 'Le plus ancien en premier';

$lang['Back_to_top'] = 'Revenir en haut';

$lang['Read_profile'] = 'Voir le profil de l\'utilisateur'; 
$lang['Visit_website'] = 'Visiter le site web du posteur';
$lang['ICQ_status'] = 'Statut ICQ';
$lang['Edit_delete_post'] = 'Editer/Supprimer ce message';
$lang['View_IP'] = 'Voir l\'adresse IP du posteur';
$lang['Delete_post'] = 'Supprimer ce message';

$lang['wrote'] = 'a &eacute;crit'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Citation'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.
/*****[BEGIN]******************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
$lang['PHPCode'] = 'PHP'; // PHP MOD
/*****[END]********************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/

$lang['Edited_time_total'] = 'Derni&egrave;re &eacute;dition par %s le %s; &eacute;dit&eacute; %d fois'; // Last edited by me on 12 Oct 2001, edited 1 time in total
$lang['Edited_times_total'] = 'Derni&egrave;re &eacute;dition par %s le %s; &eacute;dit&eacute; %d fois'; // Last edited by me on 12 Oct 2001, edited 2 times in total

$lang['Lock_topic'] = 'Verrouiller le sujet';
$lang['Unlock_topic'] = 'D&eacute;verrouiller le sujet';
$lang['Move_topic'] = 'D&eacute;placer le sujet';
$lang['Delete_topic'] = 'Supprimer le sujet';
$lang['Split_topic'] = 'Diviser le sujet';
$lang['Merge_topics'] = 'Fusionner ce sujet';

$lang['Stop_watching_topic'] = 'Arr&ecirc;ter de surveiller ce sujet';
$lang['Start_watching_topic'] = 'Surveiller les r&eacute;ponses de ce sujet';
$lang['No_longer_watching'] = 'Vous ne surveillez plus ce sujet';
$lang['You_are_watching'] = 'Vous surveillez ce sujet &agrave; pr&eacute;sent';

$lang['Total_votes'] = 'Total des votes';
//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Corps du message';
$lang['Topic_review'] = 'Revue du sujet';

$lang['No_post_mode'] = 'Mode du sujet non sp&eacute;cifi&eacute;'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = 'Poster un nouveau sujet';
$lang['Post_a_reply'] = 'Poster une r&eacute;ponse';
$lang['Post_topic_as'] = 'Poster le sujet en tant que';
$lang['Edit_Post'] = 'Editer le sujet';
$lang['Options'] = 'Options';

$lang['Post_Announcement'] = 'Annonce';
$lang['Post_Sticky'] = 'Post-it';
$lang['Post_Normal'] = 'Normal';

$lang['Confirm_delete'] = 'Etes-vous s&ucirc;r de vouloir supprimer ce message ?';
$lang['Confirm_delete_poll'] = 'Etes-vous s&ucirc;r de vouloir supprimer ce sondage ?';

$lang['Flood_Error'] = 'Vous ne pouvez pas poster un autre sujet en si peu de temps apr&egrave;s le dernier, veuillez r&eacute;essayer dans un court instant.';
$lang['Empty_subject'] = 'Vous devez pr&eacute;ciser le nom du sujet avant de pouvoir poster un nouveau sujet.';
$lang['Empty_message'] = 'Vous devez entrer un message avant de poster.';
$lang['Forum_locked'] = 'Ce forum est verrouill&eacute;, vous ne pouvez pas poster, ni r&eacute;pondre, ni &eacute;diter les sujets.';
$lang['Topic_locked'] = 'Ce sujet est verrouill&eacute;, vous ne pouvez pas &eacute;diter les messages ou faire de r&eacute;ponses.';
$lang['No_post_id'] = 'Vous devez s&eacute;lectionner un message &agrave; &eacute;diter';
$lang['No_topic_id'] = 'Vous devez s&eacute;lectionner le sujet auquel r&eacute;pondre';
$lang['No_valid_mode'] = 'Vous pouvez seulement poster, r&eacute;pondre, &eacute;diter ou citer des messages, veuillez revenir en arri&egrave;re et r&eacute;essayer.';
$lang['No_such_post'] = 'Il n\'y a pas de message de ce type, veuillez revenir en arri&egrave;re et r&eacute;essayer.';
$lang['Edit_own_posts'] = 'D&eacute;sol&eacute;, mais vous pouvez seulement &eacute;diter vos propres messages.';
$lang['Delete_own_posts'] = 'D&eacute;sol&eacute;, mais vous pouvez uniquement supprimer vos propres messages.';
$lang['Cannot_delete_replied'] = 'D&eacute;sol&eacute;, mais vous ne pouvez pas supprimer un message ayant eu des r&eacute;ponses.';
$lang['Cannot_delete_poll'] = 'D&eacute;sol&eacute;, mais vous ne pouvez pas supprimer un sondage actif.';
$lang['Empty_poll_title'] = 'Vous devez entrer un titre pour le sondage.';
$lang['To_few_poll_options'] = 'Vous devez au moins entrer deux options pour le sondage.';
$lang['To_many_poll_options'] = 'Vous avez entr&eacute; trop d\'options pour le sondage.';
$lang['Post_has_no_poll'] = 'Ce sujet n\'a pas de sondage.';
$lang['Already_voted'] = 'Vous avez d&eacute;j&agrave; particip&eacute; &agrave; ce sondage.'; 
$lang['No_vote_option'] = 'Vous devez choisir une option avant de voter.';

$lang['Add_poll'] = 'Ajouter un sondage';
$lang['Add_poll_explain'] = 'Si vous ne voulez pas ajouter de sondage &agrave; votre sujet, laissez ces champs vides.';
$lang['Poll_view_toggle_explain'] = '[ Permet &agrave; l\'utilisateur de voir des r&eacute;sultats avant le vote. ]';
$lang['Poll_question'] = 'Question du sondage';
$lang['Poll_option'] = 'Option du sondage';
$lang['Add_option'] = 'Ajouter l\'option';
$lang['Update'] = 'Mettre &agrave; jour';
$lang['Delete'] = 'Supprimer';
$lang['Poll_for'] = 'Sondage pendant';
$lang['Poll_view_toggle'] = 'Autoriser &agrave; voir';
$lang['Days'] = 'Jours'; // Ceci est utilis&eacute; pour le sondage actuel pour ... Jours + dans admin_forums pour la r&eacute;duction
$lang['Poll_for_explain'] = '[ Entrez 0 ou laissez vide pour ne jamais terminer le sondage ]';
$lang['Delete_poll'] = 'Supprimer le sondage';

$lang['Disable_HTML_post'] = 'D&eacute;sactiver le HTML dans ce message';
$lang['Disable_BBCode_post'] = 'D&eacute;sactiver le BBCode dans ce message';
$lang['Disable_Smilies_post'] = 'D&eacute;sactiver les Smilies dans ce message';

$lang['HTML_is_ON'] = 'Le HTML est <u>Activ&eacute;</u>';
$lang['HTML_is_OFF'] = 'Le HTML est <u>D&eacute;sactiv&eacute;</u>';
$lang['BBCode_is_ON'] = 'Le %sBBCode%s est <u>Activ&eacute;</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = 'Le %sBBCode%s est <u>D&eacute;sactiv&eacute;</u>';
$lang['Smilies_are_ON'] = 'Les Smilies sont <u>Activ&eacute;s</u>';
$lang['Smilies_are_OFF'] = 'Les Smilies sont <u>D&eacute;sactiv&eacute;s</u>';

$lang['Attach_signature'] = 'Attacher sa signature (les signatures peuvent &ecirc;tre modifi&eacute;es dans le profil)';
$lang['Notify'] = 'M\'avertir lorsqu\'une r&eacute;ponse est post&eacute;e';

$lang['Stored'] = 'Message enregistr&eacute; avec succ&egrave;s.';
$lang['Deleted'] = 'Message supprim&eacute; avec succ&egrave;s.';
$lang['Poll_delete'] = 'Votre sondage a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s.';
$lang['Vote_cast'] = 'Votre vote a &eacute;t&eacute; pris en compte.';

$lang['Topic_reply_notification'] = 'Notification de R&eacute;ponse au Sujet';

$lang['glance_news_heading'] = 'Derni&egrave;re News du site';
$lang['glance_recent_heading'] = 'Sujet r&eacute;cent';
$lang['glance_next'] = 'suivant';
$lang['glance_previous'] = 'Pr&eacute;c&egrave;dent';
$lang['glance_none'] = 'Aucune News';
//
// Private Messaging
//
$lang['Private_Messaging'] = 'Messages Priv&eacute;s';

$lang['Login_check_pm'] = 'Se connecter pour v&eacute;rifier ses messages priv&eacute;s';
$lang['New_pms'] = 'Vous avez %d nouveaux messages'; // You have 2 new messages
$lang['New_pm'] = 'Vous avez %d nouveau message'; // You have 1 new message
$lang['No_new_pm'] = 'Vous n\'avez pas de nouveaux messages';
$lang['Unread_pms'] = 'Vous avez %d messages non lus';
$lang['Unread_pm'] = 'Vous avez %d message non lu';
$lang['No_unread_pm'] = 'Vous n\'avez pas de messages non lus';
$lang['You_new_pm'] = 'Un nouveau message priv&eacute; vous attend dans votre Bo&icirc;te de r&eacute;ception';
$lang['You_new_pms'] = 'De nouveaux messages priv&eacute;s vous attendent dans votre Bo&icirc;te de r&eacute;ception';
$lang['You_no_new_pm'] = 'Aucun nouveau message priv&eacute; ne vous attend dans votre Bo&icirc;te de r&eacute;ception';

$lang['Unread_message'] = 'Message non lu';
$lang['Read_message'] = 'Lire le message';

$lang['Read_pm'] = 'Lire le message'; 
$lang['Post_new_pm'] = 'Poster le message'; 
$lang['Post_reply_pm'] = 'R&eacute;pondre au message'; 
$lang['Post_quote_pm'] = 'Citer le message'; 
$lang['Edit_pm'] = 'Editer le message'; 

$lang['Inbox'] = 'Bo&icirc;te de r&eacute;ception';
$lang['Outbox'] = 'Bo&icirc;te d\'envoi';
$lang['Savebox'] = 'Archives';
$lang['Sentbox'] = 'Messages envoy&eacute;s';
$lang['Flag'] = 'Flag';
$lang['Subject'] = 'Sujet';
$lang['From'] = 'De';
$lang['To'] = 'A';
$lang['Date'] = 'Date';
$lang['Mark'] = 'Marquer';
$lang['Sent'] = 'Envoy&eacute;';
$lang['Saved'] = 'Sauv&eacute;';
$lang['Delete_marked'] = 'Supprimer la S&eacute;lection';
$lang['Delete_all'] = 'Tout Supprimer';
$lang['Save_marked'] = 'Sauvegarder la S&eacute;lection'; 
$lang['Save_message'] = 'Sauvegarder le Message';
$lang['Delete_message'] = 'Supprimer le Message';


$lang['Display_messages'] = 'Montrer les messages depuis'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Tous les Messages';

$lang['No_messages_folder'] = 'Vous n\'avez pas de messages dans ce dossier';

$lang['PM_disabled'] = 'Les messages priv&eacute;s ont &eacute;t&eacute; d&eacute;sactiv&eacute;s sur ce forum.';
$lang['Cannot_send_privmsg'] = 'D&eacute;sol&eacute;, mais l\'administrateur vous a emp&ecirc;ch&eacute; d\'envoyer des messages priv&eacute;s.';
$lang['No_to_user'] = 'Vous devez pr&eacute;ciser un nom d\'utilisateur pour envoyer ce message.';
$lang['No_such_user'] = 'D&eacute;sol&eacute;, mais cet utilisateur n\'existe pas.';

$lang['Disable_HTML_pm'] = 'D&eacute;sactiver le HTML dans ce message';
$lang['Disable_BBCode_pm'] = 'D&eacute;sactiver le BBCode dans ce message';
$lang['Disable_Smilies_pm'] = 'D&eacute;sactiver les Smilies dans ce message';

$lang['Message_sent'] = 'Votre message a &eacute;t&eacute; envoy&eacute;.';

$lang['Click_return_inbox'] = 'Cliquez %sici%s pour retourner &agrave; votre Bo&icirc;te de r&eacute;ception';
$lang['Click_return_index'] = 'Cliquez %sici%s pour retourner &agrave; l\'Index';
$lang['Click_return_profile'] = 'Cliquez %sici%s pour retourner &agrave; votre Profil';

$lang['Send_a_new_message'] = 'Envoyer un nouveau message priv&eacute;';
$lang['Send_a_reply'] = 'R&eacute;pondre &agrave; un message priv&eacute;';
$lang['Edit_message'] = 'Editer un message priv&eacute;';

$lang['Notification_subject'] = 'Un Nouveau Message Priv&eacute; vient d\'arriver.';

$lang['Find_username'] = 'Trouver un nom d\'utilisateur';
$lang['Find'] = 'Trouver';
$lang['No_match'] = 'Aucun enregistrement trouv&eacute;.';

$lang['No_post_id'] = 'L\'ID du message n\'a pas &eacute;t&eacute; sp&eacute;cifi&eacute;e';
$lang['No_such_folder'] = 'Le dossier n\'existe pas';
$lang['No_folder'] = 'Pas de dossier sp&eacute;cifi&eacute;';

$lang['Mark_all'] = 'Tout s&eacute;lectionner';
$lang['Unmark_all'] = 'Tout d&eacute;s&eacute;lectionner';

$lang['Confirm_delete_pm'] = 'Etes-vous s&ucirc;r de vouloir supprimer ce message ?';
$lang['Confirm_delete_pms'] = 'Etes-vous s&ucirc;r de vouloir supprimer ces messages ?';

$lang['Inbox_size'] = 'Votre Bo&icirc;te de r&eacute;ception est pleine &agrave; %d%%'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Votre Bo&icirc;te des Messages envoy&eacute;s est pleine &agrave; %d%%'; 
$lang['Savebox_size'] = 'Votre Bo&icirc;te des Archives est pleine &agrave; %d%%'; 

$lang['Click_view_privmsg'] = 'Cliquez %sici%s pour voir votre Bo&icirc;te de r&eacute;ception';
//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Voir le profil : %s'; // %s is username 
$lang['About_user'] = 'Tout &agrave; propos de %s'; // %s is username
/*****[BEGIN]******************************************
 [ Mod:    User Administration Link on Profile v1.0.0 ]
 ******************************************************/
$lang['User_admin_for'] = 'Administration d\'utilisateur pour';
/*****[END]********************************************
 [ Mod:    User Administration Link on Profile v1.0.0 ]
 ******************************************************/

$lang['Preferences'] = 'Pr&eacute;f&eacute;rences';
$lang['Items_required'] = 'Les champs marqu&eacute; d\'un * sont obligatoires.';
$lang['Registration_info'] = 'Enregistrement';
$lang['Profile_info'] = 'Profil';
$lang['Profile_info_warn'] = 'Ces informations seront visibles publiquement';
$lang['Avatar_panel'] = 'Panneau de contr&ocirc;le des Avatars';
$lang['Avatar_gallery'] = 'Galerie des Avatars';

$lang['Website'] = 'Site Web';
$lang['Location'] = 'Localisation';
$lang['Contact'] = 'Contact';
$lang['Email_address'] = 'Adresse e-mail';
$lang['Send_private_message'] = 'Envoyer un message priv&eacute;';
$lang['Hidden_email'] = '[ Invisible ]';
$lang['Interests'] = 'Loisirs';
$lang['Occupation'] = 'Emploi'; 
$lang['Poster_rank'] = 'Rang du posteur';

$lang['Total_posts'] = 'Messages';
$lang['User_post_pct_stats'] = '%.2f%% du total'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f messages par jour'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Trouver tous les messages de %s'; // Find all posts by username

$lang['No_user_id_specified'] = 'D&eacute;sol&eacute;, mais cet utilisateur n\'existe pas.';
$lang['Wrong_Profile'] = 'Vous ne pouvez pas modifier un profil qui n\'est pas le v&ocirc;tre.';

$lang['Only_one_avatar'] = 'Seul un type d\'avatar peut &ecirc;tre sp&eacute;cifi&eacute;';
$lang['File_no_data'] = 'Le fichier de l\'URL que vous avez donn&eacute; ne contient aucune donn&eacute;es';
$lang['No_connection_URL'] = 'Une connexion ne peut &ecirc;tre &eacute;tablie avec l\'URL que vous avez donn&eacute;e';
$lang['Incomplete_URL'] = 'L\'URL que vous avez entr&eacute;e est incompl&egrave;te';
$lang['Wrong_remote_avatar_format'] = 'L\'URL de l\'avatar est invalide';
$lang['No_send_account_inactive'] = 'D&eacute;sol&eacute;, mais votre mot de passe ne peut pas &ecirc;tre renouvel&eacute; &eacute;tant donn&eacute; que votre compte est actuellement inactif. Veuillez contacter l\'administrateur du forum afin d\'obtenir de plus amples informations.';

$lang['Always_smile'] = 'Toujours activer les Smilies';
$lang['Always_html'] = 'Toujours autoriser le HTML';
$lang['Always_bbcode'] = 'Toujours autoriser le BBCode';
$lang['Always_add_sig'] = 'Toujours attacher sa signature';
$lang['Always_notify'] = 'Toujours m\'avertir des r&eacute;ponses';
$lang['Always_notify_explain'] = 'Envoi un e-mail lorsque quelqu\'un r&eacute;pond aux sujets que vous avez post&eacute;. Ceci peut &ecirc;tre chang&eacute; chaque fois que vous postez.';

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$lang['Word_Wrap'] = 'Taille de l\'&eacute;cran';
$lang['Word_Wrap_Explain'] = 'C\'est la longueur de ligne maximum des posts de l\'utilisateur.';
$lang['Word_Wrap_Extra'] = 'caract&egrave;res (fourchette: 50 - 99 char.)';
$lang['Word_Wrap_Error'] = 'La largeur d\'affichage du post est hors de fourchette.';
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$lang['Board_style'] = 'Th&egrave;me du Forum';
$lang['Board_lang'] = 'Langue du Forum';
$lang['No_themes'] = 'Pas de Th&egrave;me dans la base de donn&eacute;es';
$lang['Timezone'] = 'Fuseau horaire';
$lang['Date_format'] = 'Format de la date';
$lang['Date_format_explain'] = 'La syntaxe utilis&eacute;e est identique &agrave; la fonction <a href=\'http://www.php.net/manual/fr/function.date.php\' onclick=\'window.open(this.href,\"_blank\"); return false;\'>date()</a> du PHP.';
$lang['Signature'] = 'Signature';
$lang['Signature_explain'] = 'Ceci est un bloc de texte qui peut &ecirc;tre ajout&eacute; aux messages que vous postez. Il y a une limite de %d caract&egrave;res';
$lang['Public_view_email'] = 'Toujours montrer son adresse e-mail';
$lang['Current_password'] = 'Mot de passe actuel';
$lang['New_password'] = 'Nouveau mot de passe';
$lang['Confirm_password'] = 'Confirmer le mot de passe';
$lang['Confirm_password_explain'] = 'Vous devez confirmer votre mot de passe si vous souhaitez modifier votre adresse e-mail';
$lang['password_if_changed'] = 'Vous avez seulement besoin de fournir un mot de passe si vous voulez le changer';
$lang['password_confirm_if_changed'] = 'Vous avez seulement besoin de confirmer votre mot de passe si vous l\'avez chang&eacute; ci-dessus';
$lang['Avatar'] = 'Avatar';
/*****[BEGIN]******************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/
$lang['Avatar_explain'] = 'Affiche une petite image au-dessous de vos d&eacute;tails dans vos messages. Seule une image peut &ecirc;tre affich&eacute;e &agrave; la fois, sa largeur ne peut pas d&eacute;passer %d pixels, sa hauteur %d pixels et la taille du fichier, pas plus de %d ko.';
/*****[END]********************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/
$lang['Upload_Avatar_file'] = 'Envoyer l\'Avatar depuis votre ordinateur';
$lang['Upload_Avatar_URL'] = 'Envoyer l\'Avatar &agrave; partir d\'une URL';
$lang['Upload_Avatar_URL_explain'] = 'Entrez l\'URL de l\'image Avatar, elle sera copi&eacute;e sur ce site.';
$lang['Pick_local_Avatar'] = 'S&eacute;lectionner un Avatar de la Galerie';
$lang['Link_remote_Avatar'] = 'Lier l\'Avatar &agrave; partir d\'un autre site';
$lang['Link_remote_Avatar_explain'] = 'Entrez l\'URL de l\'image Avatar que vous voulez lier.';
$lang['Avatar_URL'] = 'URL de l\'Image Avatar';
$lang['Select_from_gallery'] = 'S&eacute;lectionner un Avatar &agrave; partir de la Galerie';
$lang['View_avatar_gallery'] = 'Montrer la Galerie';
$lang['Select_avatar'] = 'S&eacute;lectionner l\'avatar';
$lang['Return_profile'] = 'Annuler l\'avatar';
$lang['Select_category'] = 'S&eacute;lectionner une cat&eacute;gorie';
$lang['Delete_Image'] = 'Supprimer l\'Image';
$lang['Current_Image'] = 'Image Actuelle';
$lang['Notify_on_privmsg'] = 'M\'avertir des nouveaux Messages Priv&eacute;s';
$lang['Popup_on_privmsg'] = 'Ouverture d\'une Pop-Up lors de nouveaux Messages Priv&eacute;s.'; 
$lang['Popup_on_privmsg_explain'] = 'Certains th&egrave;mes peuvent ouvrir une nouvelle fen&ecirc;tre pour vous informer de l\'arriv&eacute;e de nouveaux messages priv&eacute;s'; 
$lang['Hide_user'] = 'Cacher sa pr&eacute;sence en ligne';
$lang['Profile_updated'] = 'Votre profil a &eacute;t&eacute; mis &agrave; jour';
$lang['Profile_updated_inactive'] = 'Votre profil a &eacute;t&eacute; mis &agrave; jour, toutefois vous avez modifi&eacute; des d&eacute;tails vitaux, ainsi votre compte redevient inactif. V&eacute;rifier votre bo&icirc;te e-mail pour savoir comment r&eacute;activer votre compte, ou si l\'activation par l\'administrateur est requise, patientez jusqu\'&agrave; ce qu\'il le r&eacute;active.';
$lang['Password_mismatch'] = 'Les mots de passes que avez entr&eacute;s sont diff&eacute;rents.';
$lang['Current_password_mismatch'] = 'Le mot de passe que vous avez fourni est diff&eacute;rent de celui stock&eacute; sur la base de donn&eacute;es.';
$lang['Password_long'] = 'Votre mot de passe ne doit pas d&eacute;passer 32 caract&egrave;res.';
$lang['Username_taken'] = 'D&eacute;sol&eacute;, mais ce nom d\'utilisateur est d&eacute;j&agrave; pris.';
$lang['Username_invalid'] = 'D&eacute;sol&eacute;, mais ce nom d\'utilisateur contient un caract&egrave;re invalide comme \' par exemple.';
$lang['Username_disallowed'] = 'D&eacute;sol&eacute;, mais ce nom d\'utilisateur a &eacute;t&eacute; interdit d\'utilisation.';
$lang['Email_taken'] = 'D&eacute;sol&eacute;, mais cette adresse e-mail est d&eacute;j&agrave; enregistr&eacute;e par un autre utilisateur.';
$lang['Email_banned'] = 'D&eacute;sol&eacute;, mais cette adresse e-mail a &eacute;t&eacute; bannie.';
$lang['Email_invalid'] = 'D&eacute;sol&eacute;, mais cette adresse e-mail est invalide.';
$lang['Signature_too_long'] = 'Votre signature est trop longue.';
$lang['Fields_empty'] = 'Vous devez compl&eacute;ter les champs obligatoires.';
$lang['Avatar_filetype'] = 'Le type de fichier de l\'avatar doit &ecirc;tre .jpg, .gif ou .png';
$lang['Avatar_filesize'] = 'La taille de l\'image de l\'avatar doit &ecirc;tre inf&eacute;rieure &agrave; %d ko'; // The avatar image file size must be less than 6 ko
$lang['Avatar_imagesize'] = 'La taille de l\'avatar doit &ecirc;tre de %d pixels de largeur et de %d pixels de hauteur'; 
$lang['Welcome_subject'] = 'Bienvenue sur les Forums de %s'; // Welcome to my.com forums
$lang['New_account_subject'] = 'Nouveau compte utilisateur';
$lang['Account_activated_subject'] = 'Compte activ&eacute;';
$lang['Account_added'] = 'Merci de vous &ecirc;tre enregistr&eacute;, votre compte a &eacute;t&eacute; cr&eacute;&eacute;. Vous pouvez vous connecter avec votre nom d\'utilisateur et mot de passe';
$lang['Account_inactive'] = 'Votre compte a &eacute;t&eacute; cr&eacute;&eacute;. Toutefois, ce forum requiert que votre compte soit activ&eacute;, et donc une clef d\'activation a &eacute;t&eacute; envoy&eacute;e &agrave; l\'adresse e-mail que vous avez fournie. Veuillez v&eacute;rifier votre bo&icirc;te e-mail pour de plus amples informations.';
$lang['Account_inactive_admin'] = 'Votre compte a &eacute;t&eacute; cr&eacute;&eacute;. Toutefois, ce forum requiert que votre compte soit activ&eacute; par l\'administrateur. Un e-mail lui a &eacute;t&eacute; envoy&eacute; et vous serez inform&eacute;s lorsque votre compte sera activ&eacute;.';
$lang['Account_active'] = 'Votre compte a &eacute;t&eacute; activ&eacute;. Merci de vous &ecirc;tre enregistr&eacute;';
$lang['Account_active_admin'] = 'Le compte a &eacute;t&eacute; activ&eacute;';
$lang['Reactivate'] = 'R&eacute;activez votre compte !';
$lang['Already_activated'] = 'Votre compte est d&eacute;j&agrave; activ&eacute;';
$lang['COPPA'] = 'Votre compte a &eacute;t&eacute; cr&eacute;&eacute;, mais il doit &ecirc;tre approuv&eacute;, veuillez v&eacute;rifier votre bo&icirc;te e-mail pour plus de d&eacute;tails.';
$lang['Registration'] = 'Enregistrement - R&egrave;glement';
$lang['Reg_agreement'] = 'Les administrateurs et mod&eacute;rateurs de ce forum s\'efforceront de supprimer ou &eacute;diter tous les messages &agrave; caract&egrave;re r&eacute;pr&eacute;hensible aussi rapidement que possible. Toutefois, il leur est impossible de passer en revue tous les messages. Vous admettez donc que tous les messages post&eacute;s sur ces forums expriment la vue et opinion de leurs auteurs respectifs, et non pas des administrateurs, ou mod&eacute;rateurs, ou webmestres (except&eacute; les messages post&eacute;s par eux-m&ecirc;me) et par cons&eacute;quent ne peuvent pas &ecirc;tre tenus pour responsables.<br /><br />Vous consentez &agrave; ne pas poster de messages injurieux, obsc&egrave;nes, vulgaires, diffamatoires, menaçants, sexuels ou tout autre message qui violerait les lois applicables. Le faire peut vous conduire &agrave; &ecirc;tre banni imm&eacute;diatement de façon permanente (et votre fournisseur d\'acc&egrave;s &agrave; internet en sera inform&eacute;). L\'adresse IP de chaque message est enregistr&eacute;e afin d\'aider &agrave; faire respecter ces conditions. Vous &ecirc;tes d\'accord sur le fait que le webmestre, l\'administrateur et les mod&eacute;rateurs de ce forum ont le droit de supprimer, &eacute;diter, d&eacute;placer ou verrouiller n\'importe quel sujet de discussion &agrave; tout moment. En tant qu\'utilisateur, vous &ecirc;tes d\'accord sur le fait que toutes les informations que vous donnerez ci-apr&egrave;s seront stock&eacute;es dans une base de donn&eacute;es. Cependant, ces informations ne seront divulgu&eacute;es &agrave; aucune tierce personne ou soci&eacute;t&eacute; sans votre accord. Le webmestre, l\'administrateur, et les mod&eacute;rateurs ne peuvent pas &ecirc;tre tenus pour responsables si une tentative de piratage informatique conduit &agrave; l\'acc&egrave;s de ces donn&eacute;es.<br /><br />Ce forum utilise les cookies pour stocker des informations sur votre ordinateur. Ces cookies ne contiendront aucune information que vous aurez entr&eacute; ci-apr&egrave;s, ils servent uniquement &agrave; am&eacute;liorer le confort d\'utilisation. L\'adresse e-mail est uniquement utilis&eacute;e afin de confirmer les d&eacute;tails de votre enregistrement ainsi que votre mot de passe (et aussi pour vous envoyer un nouveau mot de passe dans la cas o&ugrave; vous l\'oublieriez).<br /><br />En vous enregistrant, vous vous portez garant du fait d\'&ecirc;tre en accord avec le r&egrave;glement ci-dessus.';
$lang['Agree_under_13'] = 'J\'accepte le r&egrave;glement et j\'ai <b>moins</b> de 13 ans';
$lang['Agree_over_13'] = 'J\'accepte le r&egrave;glement et j\'ai <b>exactement</b> ou <b>plus</b> de 13 ans';
$lang['Agree_not'] = 'Je n\'accepte pas le r&egrave;glement';
$lang['Wrong_activation'] = 'La clef d\'activation que vous avez fournie ne correspond pas &agrave; celle de la base de donn&eacute;es.';
$lang['Send_password'] = 'Envoyez moi un nouveau mot de passe'; 
$lang['Password_updated'] = 'Un nouveau mot de passe a &eacute;t&eacute; cr&eacute;&eacute;, veuillez v&eacute;rifier votre bo&icirc;te e-mail pour plus de d&eacute;tails concernant l\'activation de celui-ci.';
$lang['No_email_match'] = 'L\'adresse e-mail que vous avez fournie ne correspond pas avec celle qui a &eacute;t&eacute; utilis&eacute;e pour ce nom d\'utilisateur.';
$lang['New_password_activation'] = 'Activation d\'un nouveau mot de passe';
$lang['Password_activated'] = 'Votre compte a &eacute;t&eacute; r&eacute;activ&eacute;. Pour vous connecter, veuillez utiliser le mot de passe fourni dans l\'e-mail que vous avez reçu.';
$lang['Send_email_msg'] = 'Envoyer un message e-mail';
$lang['No_user_specified'] = 'Aucun utilisateur sp&eacute;cifi&eacute;';
$lang['User_prevent_email'] = 'Cet utilisateur ne souhaite pas recevoir d\'e-mail. Essayez de lui envoyer un message priv&eacute;.';
$lang['User_not_exist'] = 'Cet utilisateur n\'existe pas';
$lang['CC_email'] = 'Envoyer une copie de cet e-mail &agrave; soi-m&ecirc;me';
$lang['Email_message_desc'] = 'Ce message sera envoy&eacute; en texte plein, n\'ins&eacute;rez aucun code HTML ou BBCode. L\'adresse de r&eacute;ponse pour ce message sera celle de votre e-mail.';
$lang['Flood_email_limit'] = 'Vous ne pouvez pas envoyer un autre e-mail pour le moment, essayez plus tard';
$lang['Recipient'] = 'Destinataire';
$lang['Email_sent'] = 'L\'e-mail a &eacute;t&eacute; envoy&eacute;.';
$lang['Send_email'] = 'Envoyer l\'e-mail';
$lang['Empty_subject_email'] = 'Vous devez sp&eacute;cifier le sujet pour l\'e-mail.';
$lang['Empty_message_email'] = 'Vous devez entrer un message pour qu\'il soit exp&eacute;di&eacute;.';
$lang['Login_attempts_exceeded'] = 'Le nombre maximum de %s tentatives de connexions autoris&eacute;es a &eacute;t&eacute; d&eacute;pass&eacute;. Vous n\'&ecirc;tes pas autoris&eacute; &agrave; vous connecter durant les %s prochaines minutes.';
$lang['Please_remove_install_contrib'] = 'Veuillez vous assurer que les deux r&eacute;pertoires install/ et contrib/ sont supprim&eacute;s';
//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'Le code de confirmation que vous avez saisie est incorrect';
$lang['Too_many_registers'] = 'Vous avez exc&eacute;d&eacute; le nombre de tentatives d\'enregistrement pour cette session.  Svp essai encore plus tard.';
$lang['Confirm_code_impaired'] = 'Si vous ne pouvez pas lire ce code, entrez en contact avec le %sAdministrator%s pour l\'aide.';
$lang['Confirm_code'] = 'Code de confirmation';
$lang['Confirm_code_explain'] = 'Entrez exactement le code que vous voyez sur l\'image';
//
// Memberslist
//
$lang['Select_sort_method'] = 'S&eacute;lectionner la m&eacute;thode de tri';
$lang['Sort'] = 'Trier';
$lang['Sort_Top_Ten'] = 'Top10 des Posteurs';
$lang['Sort_Joined'] = 'Inscrit le';
$lang['Sort_Username'] = 'Nom d\'utilisateur';
$lang['Sort_Location'] = 'Localisation';
$lang['Sort_Posts'] = 'Messages';
$lang['Sort_Email'] = 'E-mail';
$lang['Sort_Website'] = 'Site Web';
$lang['Sort_Ascending'] = 'Croissant';
$lang['Sort_Descending'] = 'D&eacute;croissant';
$lang['Order'] = 'Ordre';
//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Panneau de Contr&ocirc;le des Groupes';
$lang['Group_member_details'] = 'Appartenance &agrave; un groupe';
$lang['Group_member_join'] = 'Rejoindre un Groupe';
$lang['Group_Information'] = 'Informations du groupe';
$lang['Group_name'] = 'Nom du groupe';
$lang['Group_description'] = 'Description du groupe';
$lang['Group_membership'] = 'Votre statut';
$lang['Group_Members'] = 'Membres du groupe';
$lang['Group_Moderator'] = 'Mod&eacute;rateur du groupe';
$lang['Pending_members'] = 'Membres en attente';
$lang['Group_type'] = 'Type du groupe';
$lang['Group_open'] = 'Groupe ouvert';
$lang['Group_closed'] = 'Groupe ferm&eacute;';
$lang['Group_hidden'] = 'Groupe invisible';
$lang['Current_memberships'] = 'Membre du groupe';
$lang['Non_member_groups'] = 'Non-membre du groupe';
$lang['Memberships_pending'] = 'Adh&eacute;sions en attente';
$lang['No_groups_exist'] = 'Aucun groupe n\'existe';
$lang['Group_not_exist'] = 'Ce groupe d\'utilisateurs n\'existe pas';
$lang['Join_group'] = 'Rejoindre le Groupe';
$lang['No_group_members'] = 'Ce groupe n\'a pas de membres';
$lang['Group_hidden_members'] = 'Ce groupe est invisible; vous ne pouvez pas voir son effectif';
$lang['No_pending_group_members'] = 'Ce groupe n\'a pas d\'utilisateurs en attente';
$lang['Group_joined'] = 'Vous vous &ecirc;tes inscrit &agrave; ce groupe avec succ&egrave;s.<br />Vous serez averti lorsque votre inscription sera approuv&eacute;e par le mod&eacute;rateur du groupe.';
$lang['Group_request'] = 'Une requ&ecirc;te d\'adh&eacute;sion &agrave; votre groupe a &eacute;t&eacute; faites.';
$lang['Group_approved'] = 'Votre requ&ecirc;te a &eacute;t&eacute; approuv&eacute;e.';
$lang['Group_added'] = 'Vous avez &eacute;t&eacute; rajout&eacute; &agrave; ce groupe d\'utilisateurs.';
$lang['Already_member_group'] = 'Vous &ecirc;tes d&eacute;j&agrave; membre de ce groupe';
$lang['User_is_member_group'] = 'L\'utilisateur est d&eacute;j&agrave; membre de ce groupe';
$lang['Group_type_updated'] = 'Vous avez mis &agrave; jour le type du groupe avec succ&egrave;s.';
$lang['Could_not_add_user'] = 'L\'utilisateur que vous avez s&eacute;lectionn&eacute; n\'existe pas.';
$lang['Could_not_anon_user'] = 'Vous ne pouvez pas rendre des utilisateurs Anonymes membre d\'un groupe.';
$lang['Confirm_unsub'] = 'Etes-vous s&ucirc;r de vouloir vous d&eacute;sinscrire de ce groupe ?';
$lang['Confirm_unsub_pending'] = 'Votre inscription &agrave; ce groupe n\'a pas encore &eacute;t&eacute; approuv&eacute;e; &ecirc;tes-vous s&ucirc;r de vouloir vous d&eacute;sinscrire ?';
$lang['Unsub_success'] = 'Vous avez &eacute;t&eacute; d&eacute;sinscrit de ce groupe.';
$lang['Approve_selected'] = 'Approuver la s&eacute;lection';
$lang['Deny_selected'] = 'Refuser la s&eacute;lection';
$lang['Not_logged_in'] = 'Vous devez &ecirc;tre connect&eacute; pour joindre un groupe.';
$lang['Remove_selected'] = 'Supprimer la s&eacute;lection';
$lang['Add_member'] = 'Ajouter le Membre';
$lang['Not_group_moderator'] = 'Vous n\'&ecirc;tes pas le mod&eacute;rateur de ce groupe, vous ne pouvez donc pas accomplir cette action.';
$lang['Login_to_join'] = 'Connectez-vous pour joindre ou g&eacute;rer les adh&eacute;sions du groupe';
$lang['This_open_group'] = 'Ceci est un groupe ouvert: cliquez pour faire une demande d\'adh&eacute;sion';
/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
//$lang['This_closed_group'] = 'Ceci est un groupe ferm&eacute;: plus aucun utilisateurs accept&eacute;';
//$lang['This_hidden_group'] = 'Ceci est un groupe ouvert: cliquez pour faire une demande d\'adh&eacute;sion';
$lang['This_closed_group'] = 'Ceci est une groupe ferm&eacute;: %s';
$lang['This_hidden_group'] = 'Ceci est un groupe invisible: %s';
$lang['No_more'] = 'plus jamais d\'utilisateur accept&eacute;';
$lang['No_add_allowed'] = 'l\'ajout automatique d\'utilisateur n\'est pas autoris&eacute;';
$lang['Join_auto'] = 'Vous pouvez joindre ce groupe, puisque votre nombre de posts rejoint les crit&egrave;res de groupe';
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
$lang['Member_this_group'] = 'Vous &ecirc;tes Membre du groupe';
$lang['Pending_this_group'] = 'Votre adh&eacute;sion &agrave; ce groupe est en attente';
$lang['Are_group_moderator'] = 'Vous &ecirc;tes le Mod&eacute;rateur du groupe';
$lang['None'] = 'Aucun';
$lang['Subscribe'] = 'S\'inscrire';
$lang['Unsubscribe'] = 'Se d&eacute;sinscrire';
$lang['View_Information'] = 'Voir les Informations';
//
// Search
//
$lang['Search_query'] = 'Rechercher';
$lang['Search_options'] = 'Options de Recherche';
$lang['Search_keywords'] = 'Recherche par Mots-cl&eacute;s';
$lang['Search_keywords_explain'] = 'Vous pouvez utiliser <u>AND</u> pour d&eacute;terminer les mots qui doivent &ecirc;tre pr&eacute;sents dans les r&eacute;sultats, <u>OR</u> pour d&eacute;terminer les mots qui peuvent &ecirc;tre pr&eacute;sents dans les r&eacute;sultats et <u>NOT</u> pour d&eacute;terminer les mots qui ne devraient pas &ecirc;tre pr&eacute;sents dans les r&eacute;sultats. Utilisez * comme un joker pour des recherches partielles';
$lang['Search_author'] = 'Recherche par Auteur';
$lang['Search_author_explain'] = 'Utilisez * comme un joker pour des recherches partielles';
$lang['Search_for_any'] = 'Rechercher n\'importe quel de ces termes';
$lang['Search_for_all'] = 'Rechercher tous les termes';
$lang['Search_title_msg'] = 'Rechercher dans les titres et messages';
$lang['Search_msg_only'] = 'Rechercher dans les messages uniquement';
$lang['Return_first'] = 'Retourner les'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'premiers caract&egrave;res des messages';
$lang['Search_previous'] = 'Rechercher depuis'; // followed by days, weeks, months, year, all in a select box
$lang['Sort_by'] = 'Trier par';
$lang['Sort_Time'] = 'Heure du Message';
$lang['Sort_Post_Subject'] = 'Sujet du Message';
$lang['Sort_Topic_Title'] = 'Titre du Sujet';
$lang['Sort_Author'] = 'Auteur';
$lang['Sort_Forum'] = 'Forum';
$lang['Display_results'] = 'Afficher les r&eacute;sultats sous forme de';
$lang['All_available'] = 'Tous disponible';
$lang['No_searchable_forums'] = 'Vous n\'avez pas la permission de rechercher quelconque forum sur ce site.';
$lang['No_search_match'] = 'Aucun sujet ou message ne correspond &agrave; vos crit&egrave;res de recherche';
$lang['Found_search_match'] = '%d r&eacute;sultat trouv&eacute;'; // eg. Search found 1 match
$lang['Found_search_matches'] = '%d r&eacute;sultats trouv&eacute;s'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'Vous ne pouvez pas lancer une autre recherche si rapidement apr&egrave;s la derni&egrave;re effectu&eacute;e; veuillez r&eacute;essayer de nouveau dans un court moment.';
$lang['Close_window'] = 'Fermer la Fen&ecirc;tre';
//
// Viewonline
//
$lang['Reg_users_zero_online'] = 'Il y a 0 utilisateur enregistr&eacute; et '; // There are 5 Registered and
$lang['Reg_users_online'] = 'Il y a %d utilisateurs enregistr&eacute;s et '; // There are 5 Registered and
$lang['Reg_user_online'] = 'Il y a %d utilisateur enregistr&eacute; et '; // There is 1 Registered and
$lang['Hidden_users_zero_online'] = '0 utilisateur invisible en ligne'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d utilisateurs invisibles en ligne'; // 6 Hidden users online
$lang['Hidden_user_online'] = '%d utilisateur invisible en ligne'; // 6 Hidden users online
$lang['Guest_users_zero_online'] = 'Il y a 0 invit&eacute; en ligne'; // There are 10 Guest users online
$lang['Guest_users_online'] = 'Il y a %d invit&eacute;s en ligne'; // There are 10 Guest users online
$lang['Guest_user_online'] = 'Il y a %d invit&eacute; en ligne'; // There is 1 Guest user online
$lang['No_users_browsing'] = 'Il n\'y a actuellement personne sur ce forum';
/*****[BEGIN]******************************************
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/
$lang['Online_explain'] = 'Ces donn&eacute;es sont bas&eacute;es sur des utilisateurs actifs au cours du pass&eacute; ' . $board_config['online_time'] . ' minutes';
$lang['Statistic_last_updated'] = 'Derni&egrave;re mise &agrave jour des statistiques';
/*****[END]********************************************
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/
$lang['Forum_Location'] = 'Localisation sur le Forum';
$lang['Last_updated'] = 'Derni&egrave;re mise &agrave; jour';
$lang['Forum_index'] = 'Index du Forum';
$lang['Logging_on'] = 'Se connecte';
$lang['Posting_message'] = 'Poste un message';
$lang['Searching_forums'] = 'Recherche sur le forum';
$lang['Viewing_profile'] = 'Regarde un profil';
$lang['Viewing_online'] = 'Regarde qui est en ligne';
$lang['Viewing_member_list'] = 'Regarde la liste des membres';
$lang['Viewing_priv_msgs'] = 'Regarde ses Messages Priv&eacute;s';
$lang['Viewing_FAQ'] = 'Regarde la FAQ';
/*****[BEGIN]******************************************
 [ Mod:    Who is Online Location Fix          v0.9.1 ]
 ******************************************************/
$lang['Viewing_groupcp'] = 'Afficher le panneau de contr&ocirc;le des groupes';
$lang['Viewing_rules'] = 'Afficher les r&egrave;gles';
$lang['Viewing_stats'] = 'Afficher les Statistiques';
$lang['Viewing_ranks'] = 'Afficher les rangs';
/*****[END]********************************************
 [ Mod:    Who is Online Location Fix          v0.9.1 ]
 ******************************************************/
//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Panneau de Contr&ocirc;le de Mod&eacute;ration';
$lang['Mod_CP_explain'] = 'En utilisant le formulaire ci-dessous, vous pouvez accomplir des op&eacute;rations de mod&eacute;ration de masse sur ce forum. Vous pouvez verrouiller, d&eacute;verrouiller, d&eacute;placer ou supprimer n\'importe quel nombre de sujets.';
$lang['Select'] = 'S&eacute;lectionner';
$lang['Delete'] = 'Supprimer';
$lang['Move'] = 'D&eacute;placer';
$lang['Lock'] = 'Verrouiller';
$lang['Unlock'] = 'D&eacute;verrouiller';
$lang['Topics_Removed'] = 'Le(s) sujet(s) s&eacute;lectionn&eacute;(s) a/ont &eacute;t&eacute; retir&eacute;(s) de la base de donn&eacute;es avec succ&egrave;s.';
$lang['Topics_Locked'] = 'Le(s) sujet(s) s&eacute;lectionn&eacute;(s) a/ont &eacute;t&eacute; verrouill&eacute;(s).';
$lang['Topics_Moved'] = 'Le(s) sujet(s) s&eacute;lectionn&eacute;(s) a/ont &eacute;t&eacute; d&eacute;plac&eacute;(s).';
$lang['Topics_Unlocked'] = 'Le(s) sujet(s) s&eacute;lectionn&eacute;(s) a/ont &eacute;t&eacute; d&eacute;verrouill&eacute;(s).';
$lang['No_Topics_Moved'] = 'Aucun sujet n\'a &eacute;t&eacute; d&eacute;plac&eacute;.';
/*****[BEGIN]******************************************
 [ Mod:    Topic Cement                        v1.0.3 ]
 ******************************************************/
$lang['Topics_Prioritized'] = 'Les sujets choisis ont &eacute;t&eacute; donn&eacute;s en priorit&eacute;.';
$lang['Priority'] = 'Priorit&eacute;';
$lang['Prioritize'] = 'Prioritaire';
/*****[END]********************************************
 [ Mod:    Topic Cement                        v1.0.3 ]
 ******************************************************/
$lang['Confirm_delete_topic'] = 'Etes-vous s&ucirc;r de vouloir supprimer le(s) sujet(s) s&eacute;lectionn&eacute;(s) ?';
$lang['Confirm_lock_topic'] = 'Etes-vous s&ucirc;r de vouloir verrouiller le(s) sujet(s) s&eacute;lectionn&eacute;(s) ?';
$lang['Confirm_unlock_topic'] = 'Etes-vous s&ucirc;r de vouloir d&eacute;verrouiller le(s) sujet(s) s&eacute;lectionn&eacute;(s) ?';
$lang['Confirm_move_topic'] = 'Etes-vous s&ucirc;r de vouloir d&eacute;placer le(s) sujet(s) s&eacute;lectionn&eacute;(s) ?';
$lang['Move_to_forum'] = 'D&eacute;placer vers le forum';
$lang['Leave_shadow_topic'] = 'Laisser un sujet-traceur dans l\'ancien forum.';
$lang['Split_Topic'] = 'Panneau de Contr&ocirc;le de la division des Sujets';
$lang['Split_Topic_explain'] = 'En utilisant le formulaire ci-dessous, vous pouvez diviser un sujet en deux sujets, soit en s&eacute;lectionnant les messages individuellement, soit en divisant &agrave; partir d\'un message s&eacute;lectionn&eacute;';
$lang['Split_title'] = 'Titre du nouveau sujet';
$lang['Split_forum'] = 'Forum du nouveau sujet';
$lang['Split_posts'] = 'Diviser les messages s&eacute;lectionn&eacute;s';
$lang['Split_after'] = 'Diviser &agrave; partir des messages s&eacute;lectionn&eacute;s';
$lang['Topic_split'] = 'Le sujet s&eacute;lectionn&eacute; a &eacute;t&eacute; divis&eacute; avec succ&egrave;s';
$lang['Too_many_error'] = 'Vous avez s&eacute;lectionn&eacute; trop de messages. Vous ne pouvez seulement s&eacute;lectionner qu\'un seul message pour diviser le sujet &agrave; partir de ce message!';
$lang['None_selected'] = 'Vous n\'avez s&eacute;lectionn&eacute; aucun sujet pour accomplir cette op&eacute;ration. Veuillez revenir en arri&egrave;re et s&eacute;lectionnez-en au moins un.';
$lang['New_forum'] = 'Nouveau forum';
$lang['This_posts_IP'] = 'Adresse IP de ce message';
$lang['Other_IP_this_user'] = 'Autres adresses IP &agrave; partir desquelles cet utilisateur a post&eacute;';
$lang['Users_this_IP'] = 'Utilisateurs postant &agrave; partir de cette adresse IP';
$lang['IP_info'] = 'Informations sur l\'adresse IP';
$lang['Lookup_IP'] = 'Chercher l\'adresse IP';
//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Toutes les heures sont au format %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 Heures';
$lang['-11'] = 'GMT - 11 Heures';
$lang['-10'] = 'GMT - 10 Heures';
$lang['-9'] = 'GMT - 9 Heures';
$lang['-8'] = 'GMT - 8 Heures';
$lang['-7'] = 'GMT - 7 Heures';
$lang['-6'] = 'GMT - 6 Heures';
$lang['-5'] = 'GMT - 5 Heures';
$lang['-4'] = 'GMT - 4 Heures';
$lang['-3.5'] = 'GMT - 3,5 Heures';
$lang['-3'] = 'GMT - 3 Heures';
$lang['-2'] = 'GMT - 2 Heures';
$lang['-1'] = 'GMT - 1 Heure';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Heure';
$lang['2'] = 'GMT + 2 Heures';
$lang['3'] = 'GMT + 3 Heures';
$lang['3.5'] = 'GMT + 3,5 Heures';
$lang['4'] = 'GMT + 4 Heures';
$lang['4.5'] = 'GMT + 4,5 Heures';
$lang['5'] = 'GMT + 5 Heures';
$lang['5.5'] = 'GMT + 5,5 Heures';
$lang['6'] = 'GMT + 6 Heures';
$lang['6.5'] = 'GMT + 6.5 Heures';
$lang['7'] = 'GMT + 7 Heures';
$lang['8'] = 'GMT + 8 Heures';
$lang['9'] = 'GMT + 9 Heures';
$lang['9.5'] = 'GMT + 9,5 Heures';
$lang['10'] = 'GMT + 10 Heures';
$lang['11'] = 'GMT + 11 Heures';
$lang['12'] = 'GMT + 12 Heures';
$lang['13'] = 'GMT + 13 Heures';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 Heures';
$lang['tz']['-11'] = 'GMT - 11 Heures';
$lang['tz']['-10'] = 'GMT - 10 Heures';
$lang['tz']['-9'] = 'GMT - 9 Heures';
$lang['tz']['-8'] = 'GMT - 8 Heures';
$lang['tz']['-7'] = 'GMT - 7 Heures';
$lang['tz']['-6'] = 'GMT - 6 Heures';
$lang['tz']['-5'] = 'GMT - 5 Heures';
$lang['tz']['-4'] = 'GMT - 4 Heures';
$lang['tz']['-3.5'] = 'GMT - 3:30 Heures';
$lang['tz']['-3'] = 'GMT - 3 Heures';
$lang['tz']['-2'] = 'GMT - 2 Heures';
$lang['tz']['-1'] = 'GMT - 1 Heure';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 Heure';
$lang['tz']['2'] = 'GMT + 2 Heures';
$lang['tz']['3'] = 'GMT + 3 Heures';
$lang['tz']['3.5'] = 'GMT + 3:30 Heures';
$lang['tz']['4'] = 'GMT + 4 Heures';
$lang['tz']['4.5'] = 'GMT + 4:30 Heures';
$lang['tz']['5'] = 'GMT + 5 Heures';
$lang['tz']['5.5'] = 'GMT + 5:30 Heures';
$lang['tz']['6'] = 'GMT + 6 Heures';
$lang['tz']['6.5'] = 'GMT + 6:30 Heures';
$lang['tz']['7'] = 'GMT + 7 Heures';
$lang['tz']['8'] = 'GMT + 8 Heures';
$lang['tz']['9'] = 'GMT + 9 Heures';
$lang['tz']['9.5'] = 'GMT + 9:30 Heures';
$lang['tz']['10'] = 'GMT + 10 Heures';
$lang['tz']['11'] = 'GMT + 11 Heures';
$lang['tz']['12'] = 'GMT + 12 Heures';
$lang['tz']['13'] = 'GMT + 13 Heures';

$lang['datetime']['Sunday'] = 'Dimanche';
$lang['datetime']['Monday'] = 'Lundi';
$lang['datetime']['Tuesday'] = 'Mardi';
$lang['datetime']['Wednesday'] = 'Mercredi';
$lang['datetime']['Thursday'] = 'Jeudi';
$lang['datetime']['Friday'] = 'Vendredi';
$lang['datetime']['Saturday'] = 'Samedi';
$lang['datetime']['Sun'] = 'Dim';
$lang['datetime']['Mon'] = 'Lun';
$lang['datetime']['Tue'] = 'Mar';
$lang['datetime']['Wed'] = 'Mer';
$lang['datetime']['Thu'] = 'Jeu';
$lang['datetime']['Fri'] = 'Ven';
$lang['datetime']['Sat'] = 'Sam';
$lang['datetime']['January'] = 'Janvier';
$lang['datetime']['February'] = 'F&eacute;vrier';
$lang['datetime']['March'] = 'Mars';
$lang['datetime']['April'] = 'Avril';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['June'] = 'Juin';
$lang['datetime']['July'] = 'Juillet';
$lang['datetime']['August'] = 'Ao&ucirc;t';
$lang['datetime']['September'] = 'Septembre';
$lang['datetime']['October'] = 'Octobre';
$lang['datetime']['November'] = 'Novembre';
$lang['datetime']['December'] = 'D&eacute;cembre';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'F&eacute;v';
$lang['datetime']['Mar'] = 'Mar';
$lang['datetime']['Apr'] = 'Avr';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['Jun'] = 'Juin';
$lang['datetime']['Jul'] = 'Juil';
$lang['datetime']['Aug'] = 'Ao&ucirc;';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Oct';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'D&eacute;c';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Informations';
$lang['Critical_Information'] = 'Informations Critiques';
$lang['General_Error'] = 'Erreur G&eacute;n&eacute;rale';
$lang['Critical_Error'] = 'Erreur Critique';
$lang['An_error_occured'] = 'Une Erreur est Survenue';
$lang['A_critical_error'] = 'Une Erreur Critique est Survenue';
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$lang['Quick_reply_panel'] = 'Configuration du Module r&eacute;ponse rapide';
$lang['Quick_Reply'] = 'R&eacute;ponse rapide';
$lang['Show_quick_reply'] = 'Voir le bloc de r&eacute;ponse rapide ouvert par d&eacute;faut';
$lang['sqr']['0'] = 'Non';
$lang['sqr']['1'] = 'Oui';
$lang['sqr']['2'] = 'Sur la derni&egrave;re page seulement';
$lang['Quick_reply_mode'] = 'Afficher le mod boite r&eacute;ponse rapide';
$lang['Quick_reply_mode_basic'] = 'Basique';
$lang['Quick_reply_mode_advanced'] = 'Avancer';
$lang['Show_hide_quick_reply_form'] = 'activer/d&eacute;sactiver la r&eacute;ponse rapide sur le forum';
$lang['Open_quick_reply'] = 'Voir le bloc de r&eacute;ponse rapide ouvert par d&eacute;faut';
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
 
$lang['Admin_reauthenticate'] = 'Pour administrer le forum, vous devez vous authentifier de nouveau.';
 
/*****[BEGIN]******************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
$lang['Recent_topics'] = 'Sujets R&eacute;cents';
$lang['Recent_today'] = 'Aujourd\'hui';
$lang['Recent_yesterday'] = 'Hier';
$lang['Recent_last24'] = 'Derni&egrave;res 24 Heures';
$lang['Recent_lastweek'] = 'La Semaine Derni&egrave;re';
$lang['Recent_lastXdays'] = 'Dernier %s Jours';
$lang['Recent_last'] = 'Derniers';
$lang['Recent_days'] = 'Jours';
$lang['Recent_first'] = 'Commencer &agrave; %s';
$lang['Recent_first_poster'] = ' par %s';
$lang['Recent_select_mode'] = 'Mode choisi:';
$lang['Recent_showing_posts'] = 'Montrer Les Posts:';
$lang['Recent_title_one'] = '<font size="4">%s</font> topic %s'; // %s = topics; %s = M&eacute;thode de classement
$lang['Recent_title_more'] = '<font size="4">%s</font> topics %s'; // %s = topics; %s = M&eacute;thode de classement
$lang['Recent_title_today'] = ' d\'aujourd\'hui';
$lang['Recent_title_yesterday'] = 'd\'hier';
$lang['Recent_title_last24'] = ' des derni&egrave;res 24 heures';
$lang['Recent_title_lastweek'] = ' de la semaine derni&egrave;re';
$lang['Recent_title_lastXdays'] = ' de ces %s derniers jours'; // %s = jours
$lang['Recent_no_topics'] = 'Aucun sujet n\'a &eacute;t&eacute; trouv&eacute;.';
$lang['Recent_wrong_mode'] = 'Vous avez s&eacute;lectionner un mauvais mod.';
$lang['Recent_click_return'] = 'Cliquer %sici%s pour retourner en arri&egrave;re.';
/*****[END]********************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$lang['Topic_global_announcement']='<b>Annonce Globale:</b>';
$lang['Post_global_announcement'] = 'Annonce Globale';
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Select Expand BBcodes              v1.2.8 ]
 ******************************************************/
$lang['Select'] = 'S&eacute;lectionner';
$lang['Expand'] = 'Agrandir';
$lang['Contract'] = 'R&eacute;duire';
/*****[END]********************************************
 [ Mod:     Select Expand BBcodes              v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/
$lang['Version_check'] = 'V&eacute;rifiez la disponibilit&eacute; d\'une nouvelle version';
/*****[END]********************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Search Only Subject                 v0.9.1 ]
 ******************************************************/
$lang['Search_subject_only'] = 'Recherche seulement sur les titres des messages';
/*****[END]********************************************
 [ Mod:    Search Only Subject                 v0.9.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
$lang['Show_avatars'] = 'Afficher l\'Avatar dans les Sujets';
$lang['Show_signatures'] = 'Afficher la Signature dans les Sujets';
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                    v2.1.1 RC ]
 ******************************************************/
$lang['Quick_search_for'] = 'Recherche pour'; 
$lang['Quick_search_at'] = 'sur'; 
// In this case, the %s displays the Site Name as defined in the ACP. e.g. phpBB.com Advanced Search
$lang['Forum_advanced_search'] = 'Recherche avanc&eacute;e de %s'; 
/*****[END]********************************************
 [ Mod:     Quick Search                    v2.1.1 RC ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/
$lang['sig_description'] = 'Editer Signature (<b>Preview included</b>)';
$lang['sig_edit'] = 'Editer la Signature';
$lang['sig_current'] = 'Signature Actuelle';
$lang['sig_none'] = 'Signature Non Valide';
$lang['sig_save'] = 'Sauvegarder';
$lang['sig_save_message'] = 'La sauvegarde de la signature a r&eacute;ussie !';
/*****[END]********************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Separate Announcements & Sticky   v2.0.0a ]
 ******************************************************/
$lang['Global_Announcements'] = 'Annonce Globale';
$lang['Announcements'] = 'Annonce';
$lang['Sticky_Topics'] = 'Sujets en Post-it';
/*****[END]********************************************
 [ Mod:     Separate Announcements & Sticky   v2.0.0a ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/
$lang['Staff'] = "Staff du Site";
$lang['Forums'] = 'Forums';
$lang['Mod'] = "Mod&eacute;rateur";
$lang['Admin'] = "Administrateur";
$lang['Super'] = "Super Mod&eacute;rateur";
$lang['Junior'] = "Admin Junior";
$lang['Period'] = 'depuis <b>%d</b> jours'; // %d = jours
$lang['Messenger'] = 'Messenger';
/*****[END]********************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Disable Board Admin Override        v0.1.1 ]
 ******************************************************/
$lang['Board_Currently_Disabled'] = 'Le forum est actuellement d&eacute;sactiv&eacute;';
/*****[END]********************************************
 [ Mod:    Disable Board Admin Override        v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Memberlist Find User                v1.0.0 ]
 ******************************************************/
$lang['Look_up_User'] = 'Rechercher un utilisateur';
/*****[END]********************************************
 [ Mod:    Memberlist Find User                v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Theme Simplifications              v1.0.0 ]
 ******************************************************/
$lang['Mini_Index'] = 'Index Du Forum';
$lang['Rules'] = 'R&egrave;gles du Forum';
$lang['Login_Logout'] = 'Connexion / D&eacute;connexion';
/*****[END]********************************************
 [ Mod:     Theme Simplifications              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
$lang['Welcome_PM'] = 'Mettre comme message priv&eacute; de Bienvenue';
$lang['Welcome_PM_Set'] = 'Votre message priv&eacute; de Bienvenue a &eacute;t&eacute; envoy&eacute;';
$lang['Welcome_PM_Admin'] = 'Message priv&eacute; de Bienvenue';
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Limit smilies per post             v1.0.2 ]
 ******************************************************/
$lang['Max_smilies_per_post'] = 'Vous pouvez utiliser un maximum de %s smilies par post.<br />Vous avez %s smilies de trop.';
/*****[END]********************************************
 [ Mod:     Limit smilies per post             v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     YA Merge                           v1.0.0 ]
 ******************************************************/
 $lang['Name'] = 'Pseudo';
 $lang['Real_Name'] = 'Nom R&eacute;el:';
 $lang['Newsletter'] = 'Recevez le Newsletter par Email ?';
 $lang['Error_Check_Num'] = "Contr&ocirc;le Invalide du Nombre<br /><br />Vous devrez vous enregistrer de nouveau<br /><br />Cliquez <a href=\"%s\">ici</a> pour vous enregistrer";
 $lang['Extra_Info'] = 'Infos Suppl&eacute;mentaires';
/*****[END]********************************************
 [ Mod:     YA Merge                           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
$lang['Move_merge_message'] = 'Fusionn&eacute;: <b>%s</b> par <b>%s</b><br />Vers le Sujet <b>%s</b> (<b>%s</b>)';
$lang['Move_move_message'] = 'D&eacute;plac&eacute;: <b>%s</b> par <b>%s</b><br />Vers <b>%s</b> &agrave; <b>%s</b>';
$lang['Move_lock_message'] = 'Verrouill&eacute;: <b>%s</b> par <b>%s</b>';
$lang['Move_edit_message'] = 'Edit&eacute;: <b>%s</b> par <b>%s</b>';
$lang['Move_unlock_message'] = 'D&eacute;verrouill&eacute;: <b>%s</b> par <b>%s</b>';
$lang['Move_split_message'] = 'Divis&eacute;: <b>%s</b> par <b>%s</b><br />Sujet de<b>%s</b> (<b>%s</b>)';
$lang['Close_window'] = 'Fermer la fen&ecirc;tre'; 
$lang['Rules_title'] = 'Action : %s'; 
$lang['Locking_topic'] = 'Verrouillage du sujet'; 
$lang['Unlocking_topic'] = 'D&eacute;verrouillage du sujet'; 
$lang['Spliting_topic'] = 'Division du sujet'; 
$lang['Moving_topic'] = 'D&eacute;placement du sujet'; 
$lang['Deleting_topic'] = 'Suppression du sujet'; 
$lang['Editing_topic'] = 'Edition du sujet'; 
$lang['Lock_Explication'] = 'Quand un Mod/Admin ferme un sujet, Il n\'est plus possible pour un simple utilisateur de r&eacute;pondre. Mais les Mod/Admins peuvent continuer &agrave; poster.'; 
$lang['Unlock_Explication'] = 'Un Mod/Admin peut d&eacute;verrouiller un sujet verrouill&eacute;. Cela permet aux utilisateurs de continuer &agrave; poster.'; 
$lang['Split_Explication'] = 'Diviser un sujet lorsque les pages deviennent trop nombreuses afin de mieux organiser vos sujets.'; 
$lang['Move_Explication'] = 'Si vous d&eacute;cidez de d&eacute;placer un sujet, vous pouvez continuer &agrave; poster quand il est dans le forum A, vers le forum B. Vous pouvez d&eacute;cider de laisser un traceur dans le forum A.'; 
$lang['Delete_Explication'] = 'Si un Mod/Admin supprime un sujet, il sera impossible de poster et de le faire r&eacute;apparaitre. <br /><b>Faites attention avec cette fonction</b>'; 
$lang['Edit_Explication'] = 'En &eacute;ditant un message, un Admin et/ou un Mod peut changer ce que l\'utilisateur a &eacute;crit.'; 
$lang['No_action_specified'] = 'Il n\'y a pas d\'action sp&eacute;cifi&eacute;e';
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
$lang['true'] = 'Vrai';
$lang['false'] = 'Faut';

$lang['XData_too_long'] = 'Votre %s est trop long.';
$lang['XData_invalid'] = 'La valeur que vous avez &eacute;crite pour %s est invalide.';

$lang['XData_error_obtaining_userdata'] = "Erreur lors de la recherche d'un utilisateur XData champ &agrave &eacute;diter";
$lang['XData_failure_removing_data'] = '&Eacute;chec de suppr&eacutession les donn&eacute;es sp&eacute;cifi&eacute;es';
$lang['XData_failure_inserting_data'] = "&Eacute;che d'ajout des donn&eacute;es sp&eacute;cifi&eacute;es";
$lang['XData_error_obtaining_user_xdata'] = "Erreur d'obtention XData de l'utilisateur";
$lang['XData_failure_obtaining_field_data'] = "Erreur d'obtention de la donn&eacute;e";
$lang['XData_failure_obtaining_field_auth'] = "Error d'obtention de l'authentification";
$lang['XData_failure_obtaining_user_auth'] = "Erreur d'obtention de l'authentification de l'utilisateur";
$lang['XData_error_obtaining_usergroup'] = "Erreur d'obtention du groupe d'utilisateur";
$lang['XData_error_obtaining_group_data'] = "Erreur d'obtention de donn&eacute;e du groupe";
$lang['XData_error_updating_auth'] = 'Erreur de mise &acirc; jour de la table d\'authenfication';
$lang['XData_error_updating_fields'] = 'Erreur de mise &acirc; jour de champs de la table';
$lang['XData_success_updating_permissions'] = "Permissions mise &acirc; jour correctement <br /><br /> Clique %shere%s pour retourner aux champs des permissions <br /><br />";
$lang['XData_error_obtaining_new_field_info'] = "Impossible d'obtenir le num&eacute;ro et l'ordre pour le nouveau champs.";

$lang['XData_no_field_selected'] = "Vous n'avez pas s&eacute;lectionn&eacute; de champs";
$lang['XData_field_non_existant'] = "Le champ n'existe pas";
$lang['XData_unable_to_switch_fields'] = 'Impossible de changer de champs';
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/
$lang['show_glance_option']['1'] = 'Tous';
$lang['show_glance_option']['0'] = 'Aucun';
$lang['show_glance_option']['2'] = 'Index Seulement';
$lang['show_glance_option']['3'] = 'Forums Seulement';
$lang['show_glance_option']['4'] = 'Sujets Seulement';
$lang['show_glance_option']['5'] = 'Index et Sujets';
$lang['show_glance_option']['6'] = 'Index et Forums';
$lang['show_glance_option']['7'] = 'Forums et Sujets';
$lang['show_glance_option']['8'] = 'Cat&eacute;gorie seulement';
$lang['show_glance_option']['9'] = 'Index and Cat&eacute;gorie';
$lang['show_glance_option']['10'] = 'Index, Cat&eacute;gorie and Forums';
$lang['glance_show'] = 'Mettre en &eacute;vidence (Sujets r&eacute;cents)<br />';
/*****[END]********************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
$lang['View_post'] = 'Voir le sujet';
$lang['Post_review'] = 'Revue du sujet';
$lang['View_next_post'] = 'Voir le sujet suivant';
$lang['View_previous_post'] = 'Voir le sujet pr&eacute;c&eacute;dent';
$lang['No_newer_posts'] = "Il n\'y a pas de nouveau message dans ce forum";
$lang['No_older_posts'] = "Il n\'y a pas message ancien dans ce forum";
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Cement                 v1.0.0 ]
 ******************************************************/
$lang['topic_glance_priority'] = 'Mettre ce sujet sur l\'affichage des Posts r&eacute;cents';
/*****[END]********************************************
 [ Mod:     At a Glance Cement                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Online/Offline/Hidden              v2.2.7 ]
 ******************************************************/
$lang['Online'] = 'En Ligne';
$lang['Offline'] = 'D&eacute;connect&eacute;';
$lang['Hidden'] = 'Cach&eacute;';
$lang['is_online'] = '%s est en ligne maintenant';
$lang['is_offline'] = '%s est d&eacute;connect&eacute;';
$lang['is_hidden'] = '%s est en ligne';
$lang['Online_status'] = 'Status';
/*****[END]********************************************
 [ Mod:     Online/Offline/Hidden              v2.2.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
$lang['Images_Allowed_For_Registered_Only'] = 'Connectez-vous pour voir les images.';
$lang['Links_Allowed_For_Registered_Only'] = 'Connectez-vous pour voir les liens';
$lang['Emails_Allowed_For_Registered_Only'] = 'Connectez-vous pour voir les emails';
$lang['Get_Registered'] = 'Choix %sEnregistrement%s ou ';
$lang['Image_Blocked'] = 'Vous avez choisi de bloquer les images.<br />%sEditer votre profil%s';
$lang['Enter_Forum'] = '%sentrer%s le forum!';
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
$lang['Post_reports_none_cp'] = 'Il n\'y a aucun rapport ouvert';
$lang['Post_reports_one_cp'] = 'Il y a %s rapport ouvert';
$lang['Post_reports_many_cp'] = 'Il y a %s rapports ouverts';

$lang['All'] = 'Tous';
$lang['Display'] = 'Afficher';
$lang['Report_post'] = 'Rapporter le Post';

$lang['Reporter'] = 'Rapporteur';
$lang['Status'] = 'Statut';
$lang['Select_action'] = 'S&eacute;lectionner l\'action';

$lang['Opt_in'] = 'Activer si vous voulez recevoir un e-mail quand un rapport est envoy&eacute;';
$lang['Opt_out'] = 'D&eacute;sactiver si vous ne voulez pas recevoir d\'e-mail quand un rapport est envoy&eacute;';

$lang['Post_reported'] = 'Rapport de post envoy&eacute; avec succ&egrave;s.';
$lang['Close_success'] = 'Les rapports s&eacute;lectionn&eacute;s ont &eacute;t&eacute; ouverts/ferm&eacute;s avec succ&egrave;s.';
$lang['Delete_success'] = 'Les rapports s&eacute;lectionn&eacute;s ont &eacute;t&eacute; supprim&eacute;s avec succ&egrave;s.';
$lang['Opt_success'] = 'Vous avez d&eacute;s/activez avec succ&egrave;s.';
$lang['Click_return_report_post'] = 'Cliquez %sici%s pour essayer de rapporter encore ce post.';
$lang['Report_email'] = 'Envoy&eacute; un e-mail quand un post est rapport&eacute;';

$lang['Post_already_reported'] = 'Ce post a d&eacute;j&agrave; &eacute;t&eacute; rapport&eacute;.';

$lang['Report_not_selected'] = 'Vous n\'avez s&eacute;lectionn&eacute; aucun rapport.';

$lang['Comments'] = 'Commentaires';
$lang['Last_action_comments'] = 'Commentaires des Mod&eacute;rateurs';
$lang['Last_action_comments_explain'] = 'Veuillez, s&eacute;lectionner une action ( ou plusieurs) et &eacute;crivez un commentaire expliquant votre action sur le rapport sp&eacute;cifi&eacute;.';
$lang['Comments_explain'] = 'Veuillez, s&eacute;lectionnez une raison ( ou plusieurs) pour le rapport et &eacute;crivez un commentaire expliquant pourquoi vous rapportez ce post.';

$lang['Action'] = 'Action';
$lang['Report_action_comments'] = 'Commentaire expliquant votre action';
$lang['Previous_comments'] = 'Pr&eacute;c&eacute;dents commentaires';

$lang['Last_action_checkbox'] = 'L\'action a &eacute;t&eacute; faite grace aux cases &agrave; cocher et &agrave; la liste d&eacute;roulante.';

$lang['Opened_by_user_on_date'] = '%s (<i>%s</i>)<br /><b>Action:</b> Ouvert';
$lang['Closed_by_user_on_date'] = '%s (<i>%s</i>)<br /><b>Action:</b> Ferm&eacute;';
$lang['Opened'] = 'Ouvert';
$lang['Closed'] = 'Ferm&eacute;';
$lang['Open'] = 'Ouvrir';
$lang['Close'] = 'Fermer';

$lang['Reports_non_existent_posts'] = '%s rapports restants et ne correspondant &agrave; aucun post existant ont &eacute;t&eacute; trouv&eacute; et supprim&eacute;)';

$lang['Theme'] = 'Th&egrave;me';

/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Show Groups                        v1.0.1 ]
 ******************************************************/
//$lang['Groups'] = 'Membre De';
/*****[END]********************************************
 [ Mod:     Show Groups                        v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images                        v1.0.0 ]
 ******************************************************/
$lang['user_hide_images'] = 'Cacher les Images du Forums';
/*****[END]********************************************
 [ Mod:     Hide Images                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/
$lang['BBCode_box_hidden'] = 'Cacher';
$lang['BBcode_box_view'] = 'Cliquer pour Voir le Contenu';
$lang['BBcode_box_hide'] = 'Cliquer pour Cacher le Contenu';
/*****[END]********************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/



// FAQ & Rules
/*****[BEGIN]******************************************
 [ Mod:     DHTML Collapsible FAQ MOD          v1.0.0 ]
 ******************************************************/
$lang['dhtml_faq_noscript'] = "Il semble que votre navigateur ne supporte pas le javascript ou qu'il a &eacute;t&eacute; d&eacute;sactiv&eacute; dans les param&egrave;tres de votre navigateur. <br /> <br /> S'il vous pla&icirc;t, cliquez %sHERE%s pour afficher une version HTML.";

/*****[END]********************************************
 [ Mod:     DHTML Collapsible FAQ MOD          v1.0.0 ]
 ******************************************************/
$lang['BBCode_attach'] = "Guide d'attachement";
$lang['BBCode_rules'] = 'Code de Conduite';

/*****[BEGIN]******************************************
 [ Mod:     Edit Profile - Panel Feel          v2.0.0 ]
 ******************************************************/
$lang['panel_feel']['1'] = 'Droite';
$lang['panel_feel']['2'] = 'Gauche';
$lang['panel_feel']['0'] = 'Off';
$lang['Edit_Profile_Menu_title'] = 'Editer le Profil';
/*****[END]********************************************
 [ Mod:     Edit Profile - Panel Feel          v2.0.0 ]
 ******************************************************/

/*--ARCADE MOD--*/

//
// That's all, Folks!
// -------------------------------------------------

?>