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

/* Admin Panel */
	/* Common */
$lang['error']						= "Erreur";
$lang['information']				= "Information";
$lang['success']					= "Succ&egrave;s";

	/* Message Die's */
			/* Config Panel */
$lang['add_error']					= "Les deux champs sont requis pour ajouter un groupe de couleur.";
$lang['add_error_2']				= "Ce groupe existe d&eacute;j&eacute;.";
$lang['add_error_3']				= "Les couleurs HTML sont &agrave; 6 chiffres.";
$lang['add_success']				= "Informations de couleur sauvegard&eacute;es.";
$lang['Return_to_config']           = "Retournez &agrave; la %sConfig AUC%s";
$lang['Return_to_management']      = "Retournez au %sManagement AUC%s";
$lang['edit_error']					= "S&eacute;lectionner un nom de groupe &agrave; &eacute;diter en premier.";
$lang['save_error']					= "Les deux premiers champs sont requis pour mettre &agrave; jour un groupe.";
$lang['save_error_1']				= "Ce nom de groupe est d&eacute;j&agrave; en usage.";
$lang['delete_error']				= "S&eacute;lectionnner en un &agrave; effacer.";
$lang['delete_success']				= "Donn&eacute;es de couleur effac&eacute;es. Les utilisateurs avec ces donn&eacute;es ont &eacute;t&eacute; effac&eacute;s.";			
				/* Management Panel */
$lang['group_delete_user_2']		= "Donn&eacute;es de couleur utilisateur mises &agrave; jour.";
$lang['choose_user_id_error']		= "Si vous essayez d'ajouter manuellement un utilisateur, vous devez sp&eacute;cifier son id_utilisateur, <b>Non</b> son nom d'utilisateur. Pour trouver son id_utilisateur, passez simplement la souris sur le nom dans le tableau &amp; Regardez dans votre barre de status &agrave; u=, apr&egrave;s le = est id utilisateur.";

	/* Config Panel */
$lang['admin_main_header_c']		= "Configuration - Couleur avanc&eacute;e du nom d'utilisateur";
$lang['admin_main_header_m']		= "Administration - Couleur avanc&eacute;e du nom d'utilisateur";
$lang['add_new_color']				= "Ajouter une nouvelle couleur";
$lang['add_new_color_1']			= "Nom du Groupe<br><span class='gensmall'>Exemple: Support Team</span>";
$lang['add_new_color_2']			= "Couleur du Groupe<br><span class='gensmall'>Exemple: FFFFFF, Utiliser les codes couleurs HTML.</span>";
$lang['add_new_color_3']			= " Ajouter";
$lang['edit_color']					= "Editer les couleurs de groupe existants";
$lang['edit_color_1']				= "Tous les groupes sont d&eacute;sign&eacute;s.";
$lang['edit_color_2']				= "S&eacute;lectionner";
$lang['edit_color_3']				= " Editer ";
$lang['editing_color']				= "L'Information changeable est priv&eacute;e";
$lang['editing_color_1']			= "Changer le nom du groupe";
$lang['editing_color_2']			= "Changer la couleur du groupe<br><span class='gensmall'>Exemple: FFFFFF, Utiliser les codes couleurs HTML.</span>";
$lang['editing_color_3']			= " Sauvegarder ";
$lang['delete_color']				= "Effacer une couleur de groupe";
$lang['delete_color_1']				= "Choisissez un groupe &agrave; effacer<br><span class='gensmall'>Avertissement: Ceci enl&egrave;vera tous les utilisateurs du groupe aussi.</span>";
$lang['delete_color_2']				= "Options effacer";
$lang['delete_color_3']				= " Effacer un Groupe ";
$lang['view_group_names']			= "Titre du groupe";
$lang['view_group_colors']			= "Couleur HTML du groupe";
$lang['view_group_colors_2']		= "Exemple";
$lang['view_group_colors_3']		= "Couleur du nom d'utilisateur";

				/* Management Panel */
$lang['choose_group']				= "Choisissez un groupe &agrave; administrer";
$lang['choose_group_2']				= "Groupes existants auquels ajouter des membres";
$lang['choose_group_3']				= "Choisissez un";
$lang['choose_group_4']				= " S&eacute;lectionner un Groupe ";
$lang['group_selected']				= "Vous &ecirc;tes ajout&eacute; &agrave;: <b>%G%</b>";
$lang['group_already_assigned']		= "L'utilisateur est d&eacute;j&agrave; dans ce groupe";
$lang['group_assign']				= "Ajouter un utilisateur dans ce groupe<br><br>Manuellement ajouter son id_utilisateur";
$lang['group_assign_1']				= " Ajouter au Groupe ";
$lang['group_assign_2']				= "Ajouter de multiple utilisateurs &agrave; ce groupe, Copier une ligne pour chaque utilisateur.";
$lang['group_user_added']			= "Donn&eacute;es utilisateur mises &agrave; jour.";
$lang['group_delete_user']			= "effacer un utilisateur de ce groupe";
$lang['group_delete_user_1']		= " Enlever un utilisateur ";

/* Listing Page */
$lang['listing_left']				= "Utilisateur";
$lang['listing_right']				= "Info utilisateur";
$lang['listing_none']				= 'Il n\'y a aucun membre encore d\'ajout&eacute; au groupe %s.';

/*****[BEGIN]******************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
$lang['goup_group']                = 'Ajouter un groupe &agrave; ce groupe du forum';
/*****[END]********************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
 
 $lang['deleted_from_group'] = 'Supprim&eactue; du groupe de couleur';
 $lang['changed_user_color'] = 'Couleur chang&eacute';
 $lang['added_to_group'] = 'Ajout&eacute; &agrave; ce groupe de couleur';

?>