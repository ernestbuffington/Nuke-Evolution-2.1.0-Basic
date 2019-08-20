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

define("_NEWS","News");
define("_ALLTOPICS","Tous les sujets");
define("_OK","Ok!");
define("_SAVE","Sauvegarder");
define("_NOSUBJECT","Pas de sujet");
define("_ARTICLES","Articles");
define("_AREYOUSURE","&Ecirc;tes-vous s&ucirc;r d'inclure une URL ? Avez-vous v&eacute;rifi&eacute; l'orthographe ?");
define("_SELECTTOPIC","S&eacute;lectionner le sujet");
define("_OPTION","Option");
define("_AUTHOR","Auteur");
define("_NEWS_ADMIN_HEADER", "Evo-Cms News :: Panneau d'administration du module");
define("_NEWSSUBMISSION_ADMIN_HEADER", "Evo-Cms Soumissions :: Panneau d'administration du module");
define("_NEWSCONFIG_ADMIN_HEADER", "Evo-Cms News Configuration :: Panneau d'administration du module");
define("_NEWS_RETURNMAIN", "Retour au menu principale d'administration");
define("_ARTICLEADMIN","Articles/Histoire Administration");
define("_ADDARTICLE","Ajouter un nouvel Article");
define("_STORYTEXT","Text de l'histoire");
define("_EXTENDEDTEXT","Text &eacute;tendu");
define("_ARESUREURL","(&Ecirc;tes-vous s&ucirc;r d'inclure une URL? Avez-vous tester les fautes de frappe?)");
define("_PUBLISHINHOME","Publier dans l'accueil?");
define("_ONLYIFCATSELECTED","Fonctionne seulement si la cat&eacute;gorie <em>Articles</em> n'est pas s&eacute;lectionn&eacute;");
define("_PROGRAMSTORY","Voulez-vous programmer cette histoire?");
define("_NOWIS","Maintenant il est");
define("_DAY","Jour");
define("_PREVIEWSTORY","Pr&eacute;visualiser l'histoire");
define("_POSTSTORY","Poster l'histoire");
define("_REMOVESTORY","&Ecirc;tes-vous s&ucirc;r d'effacer l'histoire ID #");
define("_ANDCOMMENTS","et tous les commentaires?");
define("_CATEGORIESADMIN","Cat&eacute;gories Administration");
define("_CATEGORYADD","Ajouter une nouvelle cat&eacute;gorie");
define("_CATNAME","Nom de la cat&eacute;gorie");
define("_NOARTCATEDIT","Vous ne pouvez pas modifier la cat&eacute;gorie de l'<em>Articles</em>");
define("_ASELECTCATEGORY","Choisir une cat&eacute;gorie");
define("_CATEGORYNAME","Nom de la cat&eacute;gorie");
define("_DELETECATEGORY","Effacer la cat&eacute;gorie");
define("_SELECTCATDEL","S&eacute;lectionner une cat&eacute;gorie pour la Supprimer");
define("_CATDELETED","Cat&eacute;gorie effac&eacute;e!");
define("_WARNING","Attention");
define("_THECATEGORY","La cat&eacute;gorie");
define("_HAS","a");
define("_STORIESINSIDE","des histoires &agrave; l'int&eacute;rieur");
define("_DELCATWARNING1","Vous pouvez supprimer cette cat&eacute;gorie et toutes ses histoires et commentaires");
define("_DELCATWARNING2","ou vous pouvez d&eacute;placer toutes les histoires dans une nouvelle cat&eacute;gorie.");
define("_DELCATWARNING3","Que voulez-vous faire?");
define("_YESDEL","Oui! Effacer tout!");
define("_NOMOVE","Non! D&eacute;placer mes histoires");
define("_MOVESTORIES","D&eacute;placer les histoires dans une nouvelle cat&eacute;gorie");
define("_ALLSTORIES","Toutes les histoires en dessous");
define("_WILLBEMOVED","vont &ecirc;tre d&eacute;plac&eacute;es.");
define("_SELECTNEWCAT","Merci de s&eacute;lectionner une nouvelle cat&eacute;gorie");
define("_MOVEDONE","F&eacute;licitations! Le d&eacute;placement a &eacute;t&eacute; achev&eacute;!");
define("_CATEXISTS","Cette cat&eacute;gorie existe d&eacute;j&agrave;!");
define("_CATSAVED","Cat&eacute;gorie sauvegard&eacute;es!");
define("_GOTOADMIN","Retour &agrave; l'<a href=\"%s\">Admin Section</a>");
define("_CATADDED","Nouvelle cat&eacute;gorie ajout&eacute;es!");
define("_AUTOSTORYEDIT","Modifier les histoires automatis&eacute;es");
define("_NOTES","Notes");
define("_CHNGPROGRAMSTORY","S&eacute;lectionner une nouvelle date pour cette histoire:");
define("_SUBMISSIONSADMIN","Administration de soumissions des hisoitres");
define("_DELETESTORY","Effacer histoire");
define("_EDITARTICLE","Edition de l'article");
define("_NOSUBMISSIONS","Pas de nouvelle soumissions");
define("_NEWSUBMISSIONS","Nouvelle histoire soumise");
define("_NOTAUTHORIZED1","Vous n'&ecirc;tes pas autoris&eacute; &agrave; toucher cette article!");
define("_NOTAUTHORIZED2","Vous ne pouvez pas &eacute;diter et/ou effacer les articles que vous n'avez pas publi&eacute;");
define("_POLLTITLE","Titre du sondage");
define("_POLLEACHFIELD","Merci d'entrez une option par champ disponible");
define("_ACTIVATECOMMENTS","Activer les commentaires pour cette histoire?");
define("_ATTACHAPOLL","Attacher un sondage &agrave; cette article");
define("_LEAVEBLANKTONOTATTACH","(Laissez vide pour &eacute;crire l'article sans joindre un Sondage)<br />(NOTE: Les news Automatiques/Programm&eacute;es ne peut pas avoir de sondage joint)");
define("_USERPROFILE","Profil utilisateur");
define("_EMAILUSER","Email de l'utilisateur");
define("_SENDPM","Envoyer un message priv&eacute;");

/*****************************************************/
/* NEW in NSN News 1.1.0                             */
/*****************************************************/
define("_NE_ARTPUB","Article Publi&eacute;");
define("_NE_HASPUB","L'article que vous avez soumis a &eacute;t&eacute; publi&eacute;. Vous pouvez le consulter &agrave;:");
define("_NE_NEWSCONFIG","Configuration des News");
define("_NE_DISPLAYTYPE","Affichage de la colonne");
define("_NE_SINGLE","Simple colonne");
define("_NE_DUAL","Double colonne");
define("_NE_ROTATOR", "Rotation");
define("_NE_READLINK","Lien lire la suite");
define("_NE_POPUP","Popup");
define("_NE_PAGE","Page");
define("_NE_TEXTTYPE","Longueur de l'article");
define("_NE_TRUNCATE","Tronquer &agrave; 255 caract&egrave;res");
define("_NE_COMPLETE","Text Original");
define("_NE_NOTIFYAUTH","Notifier l'auteur");
define("_NE_NOTIFYAUTHNOTE","L'email de l'auteur n'est pas approuv&eacute;");
define("_NE_NO","Non");
define("_NE_YES","Oui");
define("_NE_HOMETOPIC","Sujet dans l'accueil");
define("_NE_ALLTOPICS","Tous les sujets");
define("_NE_HOMENUMBER","Articles dans l'accueil");
define("_NE_NUKEDEFAULT","Evo par D&eacute;faut");
define("_NE_ARTICLES","Articles");
define("_NE_HOMENUMNOTE","Ceci remplacera les pr&eacute;f&eacute;rences de l'utilisateur s'il est r&eacute;gl&eacute; par d&eacute;faut autrement que sur Evo");
define("_NE_SAVECHANGES","Sauvegarder les changements");
define("_NE_ID","ID");
define("_NE_ACTION","Action");
define("_NE_ROTATOR_WIDTH", "Largeur du rotateurs de contenu des Nouvelles dans %");
define("_NE_ROTATOR_HEIGHT", "Hauteur du rotateur de contenu des Nouvelles en px");
define("_NE_ROTATOR_SPEED", "Vitesse de rotation en Millisecondes (une bonne valeur est 8000)");


define("_DISPLAY_T_ICON","Afficher l'ic&ocirc;ne du sujet avec les articles?");
define("_DISPLAY_WRITES","Afficher l'autteur du texte avec les nouveaux articles?");

define("_GO","Go!");
define("_TOPICS","Sujets");
define('_LAST','Dernier');
define('_STORYID','Num&eacute;ro article');
define('_AUTOMATEDARTICLES','Articles programm&eacute;s');
define('_NOAUTOARTICLES','Pas d\'articles programm&eacute;s');

?>