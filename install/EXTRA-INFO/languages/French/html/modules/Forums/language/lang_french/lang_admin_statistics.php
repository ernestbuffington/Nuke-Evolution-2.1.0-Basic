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

// Package Module
$lang['Package_module'] = 'Ensemble des modules';
$lang['Package_module_explain'] = 'Ici, vous pouvez combiner vos fichiers de 3 modules en un pack de module de distribution.';
$lang['Select_info_file'] = 'S&eacute;lectionner un fichier information';
$lang['Select_lang_file'] = 'S&eacute;lectionner un fichier de langue';
$lang['Select_module_file'] = 'S&eacute;lectionner le fichier php d\'un module';
$lang['Package_name'] = 'Nom du pack';
$lang['Create'] = 'Cr&eacute;er';

// Install Module
$lang['Install_module_explain'] = 'Ici, vous pouvez installer un nouveau module. Vous pouvez faire cela de 2 fa&ccedil;ons. La premi&egrave;re consiste &agrave; uploader votre pack de module avec le formulaire fourni ci-dessous. Si l\'upload ne fonctionne pas, vous pouvez uploader le pack de module vers votre r&eacute;pertoire ./modules/pakfiles, il sera affich&eacute; automatiquement ici. Pour plus d\'informations sur comment installer un pack de module, vous pouvez regarder la documentation incluse.<br />Apr&egrave;s avoir choisi d\'installer un pack de module, vous serez guid&eacute; vers certaines informations concernant le module que vous avez choisi. Veuillez vous assurer que les informations sont correctes et que vous remplissez les conditions minimum (par exemple, la bonne version du Mod Statistiques). Vous pouvez aussi choisir le langage que vous souhaitez installer avec. Apr&egrave;s avoir tout v&eacute;rifi&eacute; et que vous &ecirc;tes pr&ecirc;t &agrave; l\'installer, cliquez sur le bouton \'Installation\'.<br />L\'installation par d&eacute;faut laisse le module d&eacute;sactiv&eacute;, vous devez l\'activer pour qu\'il soit affich&eacute; sur la page de statistiques.';
$lang['Select_module_pak'] = 'S&eacute;lectionner un pack de module';
$lang['Upload_module_pak'] = 'Uploader un pack de module';
$lang['Inst_module_already_exist'] = 'Le module \'%s\' existe d&eacute;j&agrave;.<br />Si vous souhaitez mettre &agrave; jour ce module, vous devez aller dans la gestion des modules et le mettre &agrave; jour.<br />Si vous souhaitez le r&eacute;installer compl&egrave;tement, vous devez d\'abord d&eacute;sinstaller l\'ancien.';
$lang['Incorrect_update_module'] = 'Le pack s&eacute;lectionn&eacute; n\'est pas une mise &agrave; jour du module s&eacute;lectionn&eacute;. Veuillez vous assurer que vous avez s&eacute;lectionn&eacute; le bon pack.';

$lang['Module_name'] = 'Nom du module';
$lang['Module_description'] = 'Description du module';
$lang['Module_version'] = 'Version du module';
$lang['Required_stats_version'] = 'Version minimum du Mod Statistiques requise';
$lang['Installed_stats_version'] = 'Version du Mod Statistiques install&eacute;e';
$lang['Module_author'] = 'Auteur du module';
$lang['Author_email'] = 'Email de l\'auteur';
$lang['Module_url'] = 'Site web du module/auteur';
$lang['Update_url'] = 'Site web des mises &agrave; jour du module (v&eacute;rifiez les derni&egrave;res mises &agrave; jour)';
$lang['Provided_language'] = 'Langage disponible';
$lang['Install_language'] = 'Langage &agrave; installer';
$lang['Module_installed'] = 'Ce module a &eacute;t&eacute; install&eacute; avec succ&egrave;s.';
$lang['Module_updated'] = 'Ce module a &eacute;t&eacute; mis &agrave; jour avec succ&egrave;s.';

// Manage Modules
$lang['Manage_modules_explain'] = 'Ici, vous pouvez g&eacute;rer vos modules. Vous pouvez les &eacute;diter, les supprimer, modifier l\'ordre, les activer et les d&eacute;sactiver. Si vous souhaitez configurer votre module (choisir les permissions, &eacute;diter les variables de langue, etc...), vous devez l\'&eacute;diter.<br />Si vous cliquez sur le nom d\'un module, vous apercevrez une pr&eacute;visualisation de ce module.';
$lang['Deactivate'] = 'D&eacute;sactiver';
$lang['Activate'] = 'Activer';

// Delete Module
$lang['Confirm_delete_module'] = 'Etes-vous s&ucirc;r de vouloir supprimer ce module ?';

// Configuration
$lang['Msg_config_updated'] = '- La configuration du Mod Statistiques a &eacute;t&eacute; mise &agrave; jour avec succ&egrave;s.';
$lang['Msg_reset_view_count'] = '- Le compteur de visites a &eacute;t&eacute; remis &agrave; z&eacute;ro avec succ&egrave;s.';
$lang['Msg_reset_install_date'] = '- La date d\'installation a &eacute;t&eacute; mise sur la date d\'aujourd\'hui.';
$lang['Msg_reset_cache'] = '- Tous les caches ont &eacute;t&eacute; vid&eacute;s avec succ&egrave;s.';
$lang['Msg_purge_modules'] = '- Le r&eacute;pertoire des modules a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s.';
$lang['Config_title'] = 'Configuration des statistiques';
$lang['Stats_Config_explain'] = 'Ici, vous pouvez configurer le Mod Statistiques.';
$lang['Messages'] = 'Messages';
$lang['Return_limit'] = 'Limite de r&eacute;p&eacute;tition';
$lang['Return_limit_explain'] = 'Nombre de rangs &agrave; inclure pour chaque classement.';
$lang['Reset_settings_title'] = 'R&eacute;initialiser les options';
$lang['Reset_view_count'] = 'R&eacute;initialiser le compteur de visites';
$lang['Reset_view_count_explain'] = 'Remettre le compteur de visites en bas de la page de statistiques &agrave; z&eacute;ro.';
$lang['Reset_install_date'] = 'R&eacute;initialiser la date d\'installation';
$lang['Reset_install_date_explain'] = 'Remettre la date d\'installation &agrave; la date d\'aujourd\'hui.';
$lang['Reset_cache'] = 'Vider le cache';
$lang['Reset_cache_explain'] = 'Vider toutes les donn&eacute;es actuelles du cache pour tous les modules et contenus des templates.';
$lang['Purge_module_dir'] = 'Vider le r&eacute;pertoire des modules';
$lang['Purge_module_dir_explain'] = 'Supprimer compl&egrave;tement le r&eacute;pertoire des modules, tous les sous-r&eacute;pertoires ainsi que tous les fichiers seront supprim&eacute;s. Veuillez utiliser cette option seulement si vous &ecirc;tes s&ucirc;r de ce que vous fa&icirc;tes et quel effet cela aura sur vos statistiques.';

// Edit Module
$lang['Msg_changed_update_time'] = '- Le temps de mise &agrave; jour &agrave; &eacute;t&eacute; modifi&eacute; avec succ&egrave;s.';
$lang['Msg_cleared_module_cache'] = '- Le cache des modules a &eacute;t&eacute; vid&eacute; avec succ&egrave;s.';
$lang['Msg_module_fields_updated'] = '- Les champs d&eacute;finis des modules ont &eacute;t&eacute; mis &agrave; jour avec succ&egrave;s.';

$lang['Module_select_title'] = 'S&eacute;lectionner un module';
$lang['Module_select_explain'] = 'Ici, vous pouvez s&eacute;lectionner le module que vous souhaitez &eacute;diter.';
$lang['Edit_module_explain'] = 'Ici, vous pouvez configurer le module. Ci-dessous, vous pouvez apercevoir certaines informations, dans la fen&ecirc;tre Messages l&agrave; o&ugrave; tous les messages mis &agrave; jour sont affich&eacute;s. Ci-desous, vous trouverez &eacute;galement la zone de configuration et celle de mise &agrave; jour du module. Dans la zone de mise &agrave; jour, veuillez s&eacute;lectionner un pack de module \'ou\' uploadez un pack de module, surtout pas les deux en m&ecirc;me temps.<br />La zone de configuration peut changer d\'un module &agrave; un autre, certains disposent d\'options sp&eacute;ciales de configuration; l\'auteur consid&egrave;re qu\'elles pourraient vous &ecirc;tre utiles.';
$lang['Module_informations'] = 'Informations du module';
$lang['Module_languages'] = 'Langages rattach&eacute;s &agrave; ce module';
$lang['Preview_module'] = 'Pr&eacute;visualiser ce module';
$lang['Module_configuration'] = 'Configuration du module';
$lang['Update_time'] = 'Temps de mise &agrave; jour (en minutes)';
$lang['Update_time_explain'] = 'Intervalle de temps (en minutes) du rafra&icirc;chissement des donn&eacute;es du cache avec de nouvelles donn&eacute;es. Chaque \'X\' minutes, le module est r&eacute;actualis&eacute;.<br />Depuis que les statistiques utilisent un syst&egrave;me de priorit&eacute;, cette dur&eacute;e peut &ecirc;tre plus importante que \'X\' minutes, mais cela ne peut pas d&eacute;passer plus d\'une journ&eacute;e.';
$lang['Module_status'] = 'Statut du module';
$lang['Active'] = 'Actif';
$lang['Not_active'] = 'D&eacute;sactiv&eacute;';
$lang['Clear_module_cache'] = 'Vider le cache des modules';
$lang['Clear_module_cache_explain'] = 'Videz le cache du module et remettez &agrave; z&eacute;ro ses priorit&eacute;s. La prochaine fois que la page de statistiques sera appel&eacute;e, ce module sera recharg&eacute;.';
$lang['Update_module'] = 'Mettre &agrave; jour ce module';
$lang['No_module_packages_found'] = 'Aucun pack de module n\'a &eacute;t&eacute; trouv&eacute;';

// Permissions
$lang['Msg_permissions_updated'] = '- Permissions mises &agrave; jour';
$lang['Permissions'] = 'Permissions';
$lang['Set_permissions_title'] = 'Ici, vous pouvez choisir les permissions pour voir un module. Seuls les utilisateurs (Anonyme, Membre, Mod&eacute;rateur et webmaster) et groupes autoris&eacute;s/list&eacute;s ici peuvent voir le module sur la page de statistiques.';
$lang['Perm_all'] = 'Anonyme';
$lang['Perm_reg'] = 'Membre';
$lang['Perm_mod'] = 'Mod&eacute;rateur';
$lang['Perm_admin'] = 'webmaster';
$lang['Perm_group'] = 'Groupes';
$lang['Added_groups'] = 'Groupes ajout&eacute;s';
$lang['Perm_add_group'] = 'Ajouter un groupe';
$lang['Perm_remove_group'] = 'Supprimer un groupe';
$lang['Perm_groups_title'] = 'Groupes autoris&eacute;s &agrave; voir le module';
$lang['No_groups_selected'] = 'Aucun groupe n\'a &eacute;t&eacute; s&eacute;lectionn&eacute;';
$lang['No_groups_to_add'] = 'Il n\'y a plus aucun groupe &agrave; ajouter';

// Language CP
$lang['Language_key'] = 'Variable de langue';
$lang['Language_value'] = 'Valeur';
$lang['Update_all_lang'] = 'Mettre &agrave; jour toutes les entr&eacute;es';
$lang['Add_new_key'] = 'Ajouter une nouvelle variable';
$lang['Create_new_lang'] = 'Cr&eacute;er un nouveau langage';
$lang['Delete_language'] = 'Supprimer';
$lang['Language_cp_title'] = 'Panneau de Contr&ocirc;le des langages';
$lang['Language_cp_explain'] = 'Ici, vous pouvez g&eacute;rer toutes les variables et packs de langues pour chaque module, les ordonner, etc... Vous pouvez &eacute;galement importer ou exporter des packs de langages.';
$lang['Export_lang_module'] = 'Exporter la langue de ce module';
$lang['Export_language'] = 'Exporter ce langage';
$lang['Export_everything'] = 'Exporter tout';
$lang['Import_new_language'] = 'Importer un langage';
$lang['Import_new_language_explain'] = 'Ici, vous pouvez uploader (ou s&eacute;lectionner) le pack de langue que vous souhaitez installer. Apr&egrave;s avoir upload&eacute; (ou s&eacute;lectionn&eacute;) un pack de langue, vous apercevrez certaines informations le concernant. C\'est seulement apr&egrave;s avoir regard&eacute; ces informations que le pack sera install&eacute;.';
$lang['Select_language_pak'] = 'S&eacute;lectionner un pack de langue';
$lang['Upload_language_pak'] = 'Uploader un pack de langue';

$lang['Language'] = 'Langue';
$lang['Modules'] = 'Modules';
$lang['Language_pak_installed'] = 'Le pack de langue a &eacute;t&eacute; install&eacute; avec succ&egrave;s.';
$lang['No_package_Up'] = 'Aucun fichier trouv&eacute;. Le fichier Info/Lang/PHP doit &ecirc;tre plac&eacute dans \'modules/pakfiles\'.';


?>