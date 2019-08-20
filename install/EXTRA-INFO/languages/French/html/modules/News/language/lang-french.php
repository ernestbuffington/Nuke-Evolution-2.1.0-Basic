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

define("_ALLOWEDHTML","Autoriser l'HTML:");
define("_ALREADYVOTEDARTICLE","D&eacute;sol&eacute;, vous avez d&eacute;j&agrave; vot&eacute; pour cet article r&eacute;cemment!");
define("_ARTICLEPOLL","Sondage de l'Article");
define("_ARTICLERATING","Note de l'Article");
define("_AVERAGESCORE","Score moyen");
define("_BACKTOARTICLEPAGE","Retour &agrave; la page de l'article");
define("_BAD","Mauvais");
define("_BYTESMORE","bytes more");
define("_CASTMYVOTE","Voter!");
define("_COMESFROM","Cet article provient de");
define("_COMMENT","commenter");
define("_COMMENTREPLY","Poster un Commentaire");
define("_COMMENTSQ","commentaires?");
define("_COMMENTSWARNING","Les commentaires sont la propri&eacute;t&eacute; de leurs auteurs. Nous ne sommes pas responsables de leur contenu.");
define("_COMREPLYPRE","Pr&eacute;visualiser le commentaire");
define("_CONFIGURE","Configurer");
define("_CONSIDERED","consid&eacute;re que l'article suivant est int&eacute;ressant et je voulais vous l'envoyer.");
define("_DIDNTRATE","Vous n'avez pas s&eacute;lectionner de score pour l'article!");
define("_EXCELLENT","Excellent");
define("_EXTRANS","Convertir (html tags en text)");
define("_FDATE","Date:");
define("_FFRIENDEMAIL","Email de votre ami:");
define("_FFRIENDNAME","Nom de votre ami:");
define("_FLAT","Monotone");
define("_FRIEND","Envoyer &agrave; un ami ");
define("_FSTORY","Histoire");
define("_FTOPIC","Sujet:");
define("_FYOUREMAIL","Votre Email:");
define("_FYOURNAME","Votre Nom:");
define("_GOOD","Bon");
define("_GOTOHOME","Aller &agrave; l'accueil");
define("_GOTONEWSINDEX","Aller &agrave; l'index des news");
define("_HASSENT","A &eacute;t&eacute; envoy&eacute; &agrave;");
define("_HIGHEST","Haut score en premier");
define("_HTMLFORMATED","HTML Format&eacute;");
define("_INTERESTING_ARTICLE","Article int&eacute;ressant &agrave;");
define("_LOGINCREATE","Connecter/Cr&eacute;er un compte");
define("_MOREABOUT","En savoir plus sur");
define("_MOSTREAD","Le plus lu &agrave; propos de");
define("_NAME","Nom");
define("_NESTED","Nich&eacute;");
define("_NEWEST","R&eacute;cent au plus ancien");
define("_NEWSBY","News par");
define("_NEWUSER","Nouvel utilisateur");
define("_NOANONCOMMENTS","Les commentaires pour les anonymes ne sont pas autoris&eacute;s, merci <a href=\"modules.php?name=Your_Account\">S'enregistrer</a>");
define("_NOCOMMENTS","Pas de Commentaire");
define("_NOCOMMENTSACT","D&eacute;sol&eacute;, les commantaires ne sont pas autoris&eacute;s pour cette article.");
define("_NOINFO4TOPIC","D&eacute;sol&eacute;, il n'y a pas d'information pour le sujet s&eacute;lectionn&eacute;.");
define("_NOSUBJECT","Pas de sujet");
define("_NOTRIGHT","Quelque chose ne va pas en passant une variable &agrave; cette fonction. Ce message est juste pour garder les choses de gâcher la route");
define("_OK","Ok!");
define("_OLDEST","Les plus anciens");
define("_ONN","par...");
define("_OPTIONS","Options");
define("_PARENT","Origine");
define("_PDATE","Date:");
define("_PLAINTEXT","Bon vieux texte brut");
define("_POSTANON","Poster anonymement");
define("_PREVIEW","Pr&eacute;visualis&eacute;");
define("_PRINTER","Version imprimable");
define("_PTOPIC","Sujet:");
define("_RATEARTICLE","Note de l'article");
define("_RATETHISARTICLE","Merci de prendre uen seconde pour voter pour cette article:");
define("_READMORE","Lire plus...");
define("_READPDF","Lire en PDF");
define("_READREST","Lire la suite de ce commentaire...");
define("_READWITHCOMMENTS", "Vous pouvez lire l'histoire compl&egrave;te de ses commentaires &agrave; partir de");
define("_RECOMMEND","Recommander ce site &agrave; un ami");
define("_REFRESH","Rafra&icirc;chir");
define("_REGULAR","R&eacute;gulier");
define("_RELATED","Lien relatif");
define("_REPLY","R&eacute;pondre &agrave; cela");
define("_REPLYMAIN","Poster un commentaire");
define("_ROOT","Root");
define("_SCORE","Score:");
define("_SEARCHDIS","Rechercher une Discussion");
define("_SEARCHONTOPIC","Rechercher dans ce sujet");
define("_SELECTNEWTOPIC","S&eacute;lectionner un nouveau sujet");
define("_SEND","Envoyer");
define("_SENDAMSG","Envoyer le message");
define("_SID_FAILURE","Nous ne pouvons pas trouver l'article pour la recherche que vous avez effectu&eacute;");
define("_SUBJECT","Sujet");
define("_THANKS","Merci!");
define("_THANKSVOTEARTICLE","Merci de votre vote pour cette article!");
define("_THEURL","L'URL pour cette histoire est:");
define("_THREAD","Thread");
define("_THRESHOLD","Commencement");
define("_TOAFRIEND","Sp&&eacute;cifiez un ami:");
define("_UCOMMENT","Commentaire");
define("_URL","URL");
define("_USERINFO","Info utilisateur");
define("_VERYGOOD","Vraiment Bien");
define("_YOUCANREAD","Vous pouvez lire des articles int&eacute;ressants &agrave;");
define("_YOURFRIEND","Votre ami");
define("_YOURNAME","Votre Nom");
define("_YOUSENDSTORY","Vous allez envoyer l'article");

/*****[BEGIN]******************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/
define("_NE_ALLTOPICS","Tout les sujets");
define("_NE_ARTICLES","Articles");
define("_NE_CATEGORY","Cat&eacute;gorie");
define("_NE_COMPLETE","Text original");
define("_NE_COUNTRATINGS","Avis comptabilis&eacute;");
define("_NE_DISPLAYTYPE","Afficher en colonne");
define("_NE_DUAL","Double Colonne");
define("_NE_HOMENUMBER","Articles dans l'accueil");
define("_NE_HOMENUMNOTE","Ceci remplacera les pr&eacute;f&eacute;rences de l'utilisateur s'il est r&eacute;gl&eacute; par d&eacute;faut autrement que sur EVO");
define("_NE_HOMETOPIC","Sujet dans l'accueil");
define("_NE_MODERATE","Soumettre une Mod&eacute;ration");
define("_NE_NEWSCONFIG","Configuration News ");
define("_NE_NO","Non");
define("_NE_NONE_NEWS","Pas de news valable");
define("_NE_NOTIFYAUTH","Notifier Auteur");
define("_NE_NOTIFYAUTHNOTE","L'email de l'auteur n'est pas valide");
define("_NE_NO_EMPTY_COMMENT","Un des champs: sujet ou commentaire est vide. Merci de revenir en arri&egrave;re.<br />"._GOBACK);
define("_NE_NUKEDEFAULT","Evo par D&eacute;faut");
define("_NE_OF","de");
define("_NE_PAGE","Page");
define("_NE_PAGES","pages");
define("_NE_POPUP","Popup");
define("_NE_READLINK","Lien lire plus");
define("_NE_SAVECHANGES","Sauvegarder les changements");
define("_NE_SELECT","S&eacute;lectionner une Page");
define("_NE_SINGLE","Simple Colonne");
define("_NE_TEXTTYPE","Taille de l'article");
define("_NE_TRUNCATE","Tronquer &agrave; 255 caract&egrave;res");
define("_NE_WEBSITE","Site Web");
define("_NE_YES","Oui");
/*****[END]********************************************
 [ Mod:     NSN News                           v1.1.0 ]
 ******************************************************/

?>