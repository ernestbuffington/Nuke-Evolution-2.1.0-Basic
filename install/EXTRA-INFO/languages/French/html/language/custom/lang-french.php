<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
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

/*****[BEGIN]******************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/
define("_CANNOTCHANGEMODE", "Ne pas changer le mode de fichier (%s)");
define("_CANNOTOPENFILE", "Ne pas ouvrir les fichiers (%s)");
define("_CANNOTWRITETOFILE", "Ne pas &eacute;crire sur le fichier (%s)");
define("_CANNOTCLOSEFILE", "Ne pas fermer le fichier (%s)");
define("_SITECACHED", "Ce site est cach&eacute;.");
define("_UPDATECACHE", "Cliquez ici pour mettre &agrave; jour le cache.");
/*****[END]********************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
define("_ERRORINVEMAIL","ERREUR: Email Invalide");
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/
define("_PERSISTENT","Connectez moi automatiquement &agrave; chaque visite");
/*****[END]********************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/
define("_ADMINGROUPS","Editer les Groupes");
define("_MVGROUPS","Groupes Seulement");
define("_MVSUBUSERS","Abonn&eacute;s seulement");
define("_WHATGRDESC","Sera visible uniquement au Groupe");
define("_WHATGROUPS","Quels Groupes");
define("_GRMEMBERSHIPS","Adh&eacute;sion &agrave; un groupe");
define("_GRNONE","Aucun");
/*****[END]********************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/
define("_ADMIN_BLOCK_TITLE","Navigation Rapide");
define("_ADMIN_BLOCK_NUKE","Admin [Nuke-Evo]");
define("_ADMIN_BLOCK_FORUMS","Admin [Forums]");
define("_ADMIN_BLOCK_LOGOUT","D&eacute;connexion");
define("_ADMIN_BLOCK_SETTINGS","Pr&eacute;f&eacute;rences");
define("_ADMIN_BLOCK_BLOCKS","Blocs");
define("_ADMIN_BLOCK_MODULES","Modules");
define("_ADMIN_BLOCK_CNBYA","Utilisateurs");
define("_ADMIN_BLOCK_MSGS","Messages");
define("_ADMIN_BLOCK_MODULE_BLOCK","Block Modules");
define("_ADMIN_BLOCK_NEWS","Nouvelles");
define("_ADMIN_BLOCK_LOGIN","Connexion Admin");
define("_ADMIN_BLOCK_WHO_ONLINE","Qui est en ligne");
define("_ADMIN_BLOCK_OPTIMIZE_DB","Base de donn&eacute;es");
define("_ADMIN_BLOCK_DOWNLOADS", "T&eacute;l&eacute;chargements");
define("_ADMIN_BLOCK_EVO_USER", "Infos Utilisateur");
define("_ADMIN_BLOCK_WEBLINKS","Lien Web");
define("_ADMIN_BLOCK_REVIEWS","Compte Rendu");
define("_ADMIN_BLOCK_SYSTEMINFO","Information Systeme");
define("_ADMIN_BLOCK_ERRORLOG","Fichier de log");
define("_CACHE_ADMIN", "Cache");
define("_CACHE_CLEAR", "Vider le Cache");
define("_ADMIN_ID","ID Admin:");
define("_ADMIN_PASS","Mot de passe:");
define("_ADMINISTRATION","Administration");
define("_ADMIN_NO_MODULE_RIGHTS","Vous n'avez pas l'autorisation de l'administration du module");
/*****[END]********************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/
define("_URL_SLASH_ERR","Veuillez d&eacute;placer le / vers la fin de votre ");
define("_URL_HTTP_ERR","Veuillez mettre http:// au d&eacute;but de votre ");
define("_URL_NHTTP_ERR","Veuillez d&eacute;placer le http:// vers le d&eacute;but de votre ");
define("_URL_PHP_ERR","Veuillez d&eacute;placer le nom de fichier &agrave; la fin de votre ");
define("_URL_MODULE_FORUM_ERR","Veuillez d&eacute;placer /modules/Forums &agrave; la fin de votre ");
/*****[END]********************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/

/*--FNA--*/

/*****[BEGIN]******************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/
define("_STORIES", "Histoires");
define("_AWL","Liens Web");
define("_ASUP","Support&egrave;res");
define("_AREV","Compte-Rendus");
define("_ADOWN","T&eacute;l&eacute;chargement");
define("_ABAN", "Banni&egrave;res");
define("_AWU", "Votre Compte");
define("_WAITUSERS", "Attente");
define("_BROKENDOWN","cass&eacute;");
define("_BROKENLINKS","cass&eacute;");
define("_BROKENREVIEWS","cass&eacute;");
define("_MODREQDOWN","Modifications");
define("_MODREQLINKS","Modifications");
define("_MODREQREVIEWS","Modifications");
define("_WDOWNLOADS","Attente");
define("_WLINKS","Attente");
define("_WREVIEWS","Attente");
define("_ABANNERS", "Banni&egrave;res Actives");
define("_DBANNERS", "Banni&egrave;res Inactives");
define("_WSUPPORT", "Support&egrave;res en Attente");
define("_DSUPPORT", "Support&egrave;res Inactifs");
define("_ASUPPORT", "Support&egrave;res Actifs");
/*****[END]********************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/
define("_NEED_DELETE","Vous devez &eacute;ffacer ");
define("_IS_DELETED","Vous avez &eacuteffac&eacute; ");
define("_THE_FOLDER","Le dossier");
/*****[END]********************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/
define("_PASS_CONFIRM","Re-taper le mot de pass");
define("_ERROR","Erreur");
define("_PASS_NOT_MATCH","Les 2 mots de passe ne sont pas semblables");
/*****[END]********************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Validation                         v1.0.0 ]
 ******************************************************/
define("VALIDATE_ERROR","Le %s que vous avez entr&eacute; dans %s n'est pas valide ");
define("VALIDATE_USERNAME","Nom Utilisateur");
define("VALIDATE_TEXT","texte");
define("VALIDATE_FULLNAME","Nom Complet");
define("VALIDATE_NUMBER","nombre");
define("VALIDATE_EMAIL","email");
define("VALIDATE_URL","URL");
define("VALIDATE_INT","Nombre");
define("VALIDATE_FLOAT","Nombre");
define("VALIDATE_URL","URL");
define("VALIDATE_SHORT","court");
define("VALIDATE_LONG","long");
define("VALIDATE_SMALL","petit");
define("VALIDATE_BIG","gros");
define("VALIDATE_TEXT_SIZE","Le %s que vous avez entr&eacute; dans %s n'est pas valide<br />Vous avez besoin de %s charact&egrave;res");
define("VALIDATE_NUMBER_SIZE","Le %s que vous avez entr&eacute; dans %s n'est pas valide<br />Il doit &ecirc;tre %s");
define("VALIDATE_WORD","Un mot a &eacute;t&eacute; trouv&eacute; dans %s celui ci n'est pas autoris&eacute;");
/*****[END]********************************************
 [ Other:  Validation                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
define("PSM_HELP_TITLE","Force de votre mot de passe Aide");
define("PSM_NOTRATED","Pas d'estimation");
define("PSM_CURRENTSTRENGTH","Force Actuelle: ");
define("PSM_WEAK","Faible");
define("PSM_MED","Moyen");
define("PSM_STRONG","Fort");
define("PSM_STRONGER","Puissant");
define("PSM_STRONGEST","Dur");
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

/*--FNL--*/

/*--CalendarMx--*/

/*****[BEGIN]******************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/
define("_NOSURVEYS", "Pas de Sondage!");
/*****[END]********************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
define("_NORSS", "Le fichier RSS que vous avez choisi de charger n'existe pas!");
/*****[END]********************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/

define('_QUERIES','Requ&ecirc;tes:');
define('_DB_TIME','Temps d\'acc&egrave;s &agrave; la DB:');
define('_PAGEFOOTER','[ '._PAGEGENERATION.' %s '._SECONDS.' | '._QUERIES.' %s ]');
define("_THEMES_QUNINSTALLED", "D&eacute;sinstall&eacute;");
define("_THEMES", "Th&egrave;mes");
define("_THEMES_DEFAULT", "Th&egrave;me par D&eacute;faut");

define('_ERROR_EMAIL', 'S\'il vous pla&icirc;t configurer votre site e-mail ou votre forum email');
define('_Nice_Try', 'Bien essay&eacute; ....');
define("_OPTIMIZE_DB","Base de donn&eacutee Optimis&eacute;");

/*****[BEGIN]******************************************
 [ Base:    Log-Errors                         v1.0.0 ]
 ******************************************************/
define('_ERROR_LOG_GENERAL_ERROR','Erreur G&eacute;n&eacute;ral');
define('_ERROR_LOG_GENERAL_INFORMATION','Information G&eacute;n&eacute;ral');
define('_ERROR_LOG_CRITICAL_ERROR','Erreur Critique');
define('_ERROR_LOG_HACK_ATTEMPT','Tentative de Hack');
define('_ERROR_LOG_SECURITY_BREACH','Violation de S&eacute;curit&eacute;e ');
define('_ERROR_LOG_SCRIPT_ATTACK','Attaque de Script');
define('_ERROR_LOG_USER','Utilisateur');
define('_ERROR_LOG_IP','IP');
define('_ERROR_LOG_INVALID_IP_YA','utilis&eacute; adresse IP non valide a tent&eacute; d\'acc&eacute;der &agrave; la zone YA admin');
define('_ERROR_LOG_INVALID_IP_FORUM','utilis&eacute; adresse IP non valide a tent&eacute; d\'acc&eacute;der &agrave; au forum admin');
define('_ERROR_LOG_INVALID_IP_ADMIN','utilis&eacute; adresse IP non valide a tent&eacute; d\'acc&eacute;der &agrave; la zone admin');
define('_ERROR_LOG_BLOCKED_HTML_TAG_TEXT','Une tentative a &eacute;t&eacute; faite d\'utiliser une balise HTML bloqu&eacute;.');
define('_ERROR_LOG_BLOCKED_HTML_TAG_STRING','Chaine Bloqu&eacute;e:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_SOURCE','Source:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_ECHOMSG','est un XSS et a &eacute;t&eacute; bloqu&eacute; dans:');
define('_ERROR_LOG_THEME_MISSING_1','Votre th&egrave;me par d&eacute;faut est manquant!');
define('_ERROR_LOG_THEME_MISSING_2','n\'a pas &eacute;t&eacute; trouv&eacute;!');
define('_ERROR_LOG_GOD_ADMIN_CREATED','Super Admin a &eacute;t&eacute; cr&eacute;&eacute;:');
define('_ERROR_LOG_WRONG_MODUL_PATH','Chemin inappropri&eacute; du module a &eacute;t&eacute; utilis&eacute;');
define('_ERROR_LOG_WRONG_ADMIN_ACCOUNT','Tentative de connexion avec');
define('_ERROR_LOG_ADMIN_NO_USERNAME','Tentative de connexion &agrave; la zone admin avec aucun utilisateur');
define('_ERROR_LOG_ADMIN_NO_PASSWORD','Tentative de connexion &agrave; la zone admin avec aucun mot de passe');
define('_ERROR_LOG_ADMIN_NO_USER_PASSWORD','Tentative de connexion &agrave; la zone admin avec aucun utilisateur et mot de passe');
define('_ERROR_LOG_BUT_FAILED','mais &eacute;chou&eacute;');
define('_ERROR_LOG_INTRUDER_ALERT','A caus&eacute; une alerte d\'intrusion');
/*****[END]********************************************
 [ Base:    Log-Errors                         v1.0.0 ]
******************************************************/
define('EVO_TOOLTIP_INFO', 'Info...'); 
define('EVO_TOOLTIP_ALERT', 'Alert...'); 
define('EVO_TOOLTIP_WIKI', 'Wiki...'); 
define('EVO_TOOLTIP_MSN', 'MSN...'); 

?>