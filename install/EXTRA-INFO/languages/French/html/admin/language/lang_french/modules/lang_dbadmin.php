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
   exit('Ce fichier n\'a pas &eacute;t&eacute; appel&eacute; dans ADMINISTRATION');
}

global $adminpoint;

$lang_admin[$adminpoint]['ADMIN_GO_MAIN']            = 'Retour au Menu Principale Administration';
$lang_admin[$adminpoint]['ADMIN_HEADER']             = 'Administration de la base de donn&eacute;es';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTEXT']   = 'Message pour la base de donn&eacute;es';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTYPE']   = 'Message Type';
$lang_admin[$adminpoint]['ANALYZE_HEADER_NAME']      = 'Nom de la table';
$lang_admin[$adminpoint]['ANALYZE_HEADER_OP']        = 'Op&eacute;ration';

$lang_admin[$adminpoint]['BACKUP_HEADER_BACKUP']     = 'Sauvegarde ?';
$lang_admin[$adminpoint]['BACKUP_HEADER_NAME']       = 'Nom de la table';
$lang_admin[$adminpoint]['BACKUP_INFO_MSG']          = 'Tous les tableaux pr&eacute;sent&eacute;s ici sont des tables avec un contenu.';
$lang_admin[$adminpoint]['BACKUP_SUBMIT']            = 'Sauvegarde des tables optimis&eacute;es';
$lang_admin[$adminpoint]['BACKUP_TABLES_BACKUP_MSG'] = 'Pour toutes les tables, une sauvegarde a &eacute;t&eacute; faite';
$lang_admin[$adminpoint]['BACKUP_TABLES_CONFIRM_MSG']= 'Voulez-vous sauvegarder toutes ces tables ?';

$lang_admin[$adminpoint]['CHECK_ALL']                = 'S&eacute;lectionner tout';

$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] = 'Nous avons obtenu aucune informations de la base de donn&eacute;es - pour la plupart nous obtenons cette erreur, car votre nom d\'utilisateur de base de donn&eacute;es n\'a pas les droits appropri&eacute;s pour le faire.';
$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT']  = 'Vous n\'avez pas de droits d\'acc&egrave;s &agrave; la base de donn&eacute;es pour ex&eacute;cuter des statistiques';
$lang_admin[$adminpoint]['DATABASE_QUERY_RESULT']    = 'R&eacute;sultat de votre requ&ecirc;te de base de donn&eacute;es';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_ERROR']   = 'Erreur';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_INFO']    = 'Information';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_OP_ANALYZE'] = 'Analyse';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_STATUS']  = 'Status';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_WARNING'] = 'Attention';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPACT']    = 'Compakt';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPRESSED'] = 'Compress&eacute;';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_DYNAMIC']    = 'Dynamique';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_FIXED']      = 'Fixe';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_REDUNDANT']  = 'Redondant';
$lang_admin[$adminpoint]['DELETE_HEADER_DELETE']     = 'Effacer ?';
$lang_admin[$adminpoint]['DELETE_HEADER_NAME']       = 'Nom de la table';
$lang_admin[$adminpoint]['DELETE_SUBMIT']            = 'Confirmer l\'effa&ccedil;age de la table';
$lang_admin[$adminpoint]['DELETE_TABLES_CONFIRM_MSG']= 'Voulez-vous effacer ces tables?';
$lang_admin[$adminpoint]['DELETE_TABLES_DELETED_MSG']= 'Ces tables sont effac&eacute;es';

$lang_admin[$adminpoint]['FILES_QUERY_NO_RESULT']    = 'Il n\'y a pas de fichier de sauvegarde';

$lang_admin[$adminpoint]['KB']                       = 'KB';

$lang_admin[$adminpoint]['MAIN_HEADER']              = 'Administration Base de Donn&eacute;es';
$lang_admin[$adminpoint]['MB']                       = 'MB';

$lang_admin[$adminpoint]['NONE']                     = 'Aucun';

$lang_admin[$adminpoint]['OPTIMIZE_HEADER_NAME']       = 'Nom de la table';
$lang_admin[$adminpoint]['OPTIMIZE_HEADER_OPTIMIZE']   = 'Optimiser ?';
$lang_admin[$adminpoint]['OPTIMIZE_SUBMIT']            = 'Confirmer l\'optimisation de la table';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_CONFIRM_MSG']= 'Voulez-vous optimiser ces tables?';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_OPTIMIZED_MSG']= 'Ces tables ont &eacute;t&eacute; optimiser';

$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_DELETE']     = 'Effacer le fichier';
$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_VIEW']       = 'Voir Fichier';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_BACKUP']     = 'Action ?';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_CREATED']    = 'Sauvegarde cr&eacute;er le';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_NAME']       = 'Nom du fichier';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_FILE']         = 'Fichier de Sauvegarde';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_MSG']          = 'Tous les fichiers affich&eacute;s sont dans le r&eacute;pertoire ./includes/cache';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_ROWS']         = 'Ligne &agrave; l \'int&eacute;rieur de la sauvegarde';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_TABLES']       = 'Tables &agrave; l \'int&eacute;rieur de la sauvegarde';
$lang_admin[$adminpoint]['SHOW_BACKUP_SUBMIT']            = 'D&eacute;marer l\'Action';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_SIZE'] = 'Taille de la base de donn&eacute;es';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_TABLES'] = 'Nombre de tables &agrave; l \'int&eacute;rieur de la base de donn&eacute;es';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COLLATION']= 'Collation';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COMMENT']= 'Commentaire';
$lang_admin[$adminpoint]['STATISTICS_HEADER_FORMAT'] = 'Format';
$lang_admin[$adminpoint]['STATISTICS_HEADER_INCREMENT']= 'Increment Suivant';
$lang_admin[$adminpoint]['STATISTICS_HEADER_MAXSIZE']= 'Taille de table maximum autoris&eacute;';
$lang_admin[$adminpoint]['STATISTICS_HEADER_NAME']   = 'Nom de la Table';
$lang_admin[$adminpoint]['STATISTICS_HEADER_ROWS']   = 'Nombre de ligne';
$lang_admin[$adminpoint]['STATISTICS_HEADER_SIZE']   = 'Taille de la Table';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TIMESTAMPS']= 'Cr&eacute;&eacute;e le<br/>Dernier changement le <br/>Derni&egrave;re v&eacute;rification le';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TYPE']   = 'Type';
$lang_admin[$adminpoint]['SWITCH_ALL']               = 'Inverser tout';

$lang_admin[$adminpoint]['TITLE_ANALYZE_DB']         = 'Analyse la Base de donn&eacute;es';
$lang_admin[$adminpoint]['TITLE_OPTIMIZE_DB']        = 'Optimise la Base de donn&eacute;es';
$lang_admin[$adminpoint]['TITLE_SHOW_STATISTICS']    = 'Voir Statistique';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP']      = 'Sauvegarder les Tables';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUPED']    = 'Faire une sauvegarder pour les Tables';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP_SHOW'] = 'Voir Sauvegarde';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETE']      = 'Effacer Tables';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETED']     = 'Tables effac&eacute;es';
$lang_admin[$adminpoint]['TITLE_TABLES_OPTIMIZED']   = 'Base de donn&eacute;es optimis&eacute;es';
$lang_admin[$adminpoint]['TITLE_TABLES_REPAIR']      = 'R&eacute;parer Tables';

$lang_admin[$adminpoint]['UNCHECK_ALL']              = 'D&eacute;s&eacute;lectionner tout';

?>