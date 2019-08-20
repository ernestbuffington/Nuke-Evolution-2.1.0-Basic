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

if (!defined('ADMIN_FILE') && !defined('IN_SETTINGS')) {
   exit('Ce fichier n\'&eacute;tait pas convoqu&eacute;e depuis l\'ADMINISTRATION');
}

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Am&eacute;lioration des param&egrave;tres';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Am&eacute;lioration des param&egrave;tres du WebSite';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Options renforc&eacute;e';

$lang_admin[$settingspoint]['FIELD_HTTPREF_ON'] = 'Sauvegarder les r&eacute;f&eacute;rences &agrave; votre site Web (HTTPReferer)';
$lang_admin[$settingspoint]['FIELD_HTTPREF_ON_HELP'] = 'Si d&eacute;fini &agrave; oui, les r&eacute;f&eacute;rences &agrave; votre site Web sont enregistr&eacute;es dans la base de donn&eacute;es et affich&eacute; dans le bloc r&eacute;f&eacute;rant et l\'administration r&eacute;f&eacute;rant. Cette fonction peut ralentir la g&eacute;n&eacute;ration du site internet.';
$lang_admin[$settingspoint]['FIELD_HTTPREF_MAX'] = 'Combien de r&eacute;f&eacute;rences doivent &ecirc;tre conserv&eacute;s.';
$lang_admin[$settingspoint]['FIELD_HTTPREF_MAX_HELP'] = 'Vous pouvez fixer le montant des r&eacute;f&eacute;rants stock&eacute;es dans la base de donn&eacute;es. Par d&eacute;faut est 1000. Ne choisissez pas une valeur beaucoup plus &eacute;lev&eacute;e.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS'] = 'Commentaires Activer dans les enqu&ecirc;tes';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS_HELP'] = 'Avec ce r&eacute;glage, vous pouvez choisir si les utilisateurs sont en mesure d\'&eacute;crire des commentaires &agrave; vos enqu&ecirc;tes.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE'] = 'Commentaires Activer dans les histoires';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE_HELP'] = 'Avec ce r&eacute;glage, vous pouvez choisir si les utilisateurs sont en mesure d\'&eacute;crire des commentaires de vos nouvelles.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES'] = 'Activer Flux RSS individuels pour les utilisateurs enregistr&eacute;s (Titres)';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES_HELP'] = 'D&eacute;finit si les utilisateurs inscrits sont autoris&eacute;s &agrave; r&eacute;gler leurs flux RSS individuels (Titres) de leur profil.'; 
$lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL'] = 'Activer SSL-acc&egrave;s pour les administrateurs';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL_HELP'] = 'Active le protocole Secure Socket Layer pour les administrateurs. Notez que SSL doit &ecirc;tre install&eacute; et activ&eacute;, sur le serveur utilis&eacute;, pour faire usage de cette fonction.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT'] = 'Compte de requ&ecirc;tes de base de donn&eacute;es';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT_HELP'] = 'Active le nombre de requ&ecirc;tes de bases de donn&eacute;es et affiche le r&eacute;sultat dans le pied de page du site.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE'] = 'Active les couleurs pour les Utilisateurs et Groupes';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE_HELP'] = 'Avec ce r&eacute;glage, vous pouvez activer ou d&eacute;sactiver la fonction de montrer les couleurs des utilisateurs et des groupes.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN'] = 'L\'utilisateur doit &ecirc;tre connect&eacute; avant de pouvoir agir';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN_HELP'] = 'Avec ce param&egrave;tre utilisateurs seront oblig&eacute;s de se connecter avant qu\'ils ne soient en mesure d\'effectuer toute activit&eacute;.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS'] = 'Activer la publicit&eacute;';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS_HELP'] = 'Avec ce r&eacute;glage, il est possible d\'activer / d&eacute;sactiver les banni&egrave;res publicitaires sur votre site web.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS'] = 'Activer le repli des blocs';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS_HELP'] = 'Avec ce r&eacute;glage, il est possible d\'activer / d&eacute;sactiver la fonction de blocs repliables.';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN'] = 'Si les blocs sont ferm&eacute;es en d&eacute;but de sessions';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN_HELP'] = 'R&eacute;glez cette option sur OUI, si vous voulez montrer les blocs &eacute;largi quand une nouvelle session utilisateur est d&eacute;marr&eacute;e. Choisir cette option pour NO, si vous voulez montrer blocs ferm&eacute; par d&eacute;faut.';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE'] = 'Type de symbole utilis&eacute; pour escamotables';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE_HELP'] = 'Choisissez le type d\'ic&ocirc;ne si vous voulez montrer des signes plus ou moins pour plier/d&eacute;plier les blocs ou le Titre pour plier/d&eacute;plier en cliquant dessus.'; 
$lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME'] = 'Temps de rafra&icirc;chisement du cache du Bloc';
$lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME_HELP'] = 'Le cache du bloc sera actualis&eacute; apr&egrave;s le d&eacute;lai choisi.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP'] = 'Activer traduction de PHP-Links vers HTML-Links (LazyTap)';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP_HELP'] = 'Faites votre choix pour activer facilement des liens lisibles. Pour utiliser cette fonction, le fichier evo.htaccess situ&eacute; dans la racine de votre installation doit &ecirc;tre renomm&eacute; .htaccess';
$lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS'] = 'Pour activer Google Analytics, vous devez ajouter ici votre Google Code';
$lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS_HELP'] = 'Ce devrait &ecirc;tre votre code Google Analytics qui est donn&eacute; &agrave; partir du site Google Analytics si vous &ecirc;tes inscrits &agrave; ce service. Le code Google Analytics doit avoir une syntaxe similaire &agrave; UA-xxxxxx.';
$lang_admin[$settingspoint]['FIELD_TEXTEDITORS'] = 'Quel &eacute;diteur de texte voulez-vous utiliser';
$lang_admin[$settingspoint]['FIELD_TEXTEDITORS_HELP'] = 'Choisissez l\'&eacute;diteur de texte pour les champs de saisie de texte. Un &eacute;diteur de texte doit &ecirc;tre install&eacute; afin de changer cette option &agrave; partir du BBCode &agrave; un &eacute;diteur WYSIWYG diff&eacute;rents. Ce param&egrave;tre n\'a aucun effet pour les forums, comme un &eacute;diteur sp&eacute;cial BBCode est construit pour les forums.';

$lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_ICON'] = 'Plus/Moins Symbole';
$lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_TITLE'] = 'Titre';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_DEACTIVATED'] = 'Cache d&eacute;sactiver';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_MINUTES'] = 'Minutes';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_HOURS'] = 'Heures';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_DEACTIVATED'] = 'D&eacute;sactiver';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_BOTS'] = 'WebCrawler';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_ALL'] = 'Tout le monde';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_ADMINBOTS'] = 'Web Crawler et Administrateurs';
$lang_admin[$settingspoint]['OPTION_TEXTEDITOR_NONE'] = 'Aucun';

$lang_admin[$settingspoint]['INFO_ACTIVATE_ADMINSSL'] = 'SSL doit &ecirc;tre activ&eacute; sur votre Serveur';
$lang_admin[$settingspoint]['INFO_ACTIVATE_BANNERS'] = 'Voir les banni&egrave;res cr&eacute;&eacute;es dans le module Publicitaire';
$lang_admin[$settingspoint]['INFO_DEACTIVATED_LAZYTAP'] = 'Votre LazyTap est d&eacute;sactiv&eacute;:';
$lang_admin[$settingspoint]['INFO_TEXTEDITORS'] = 'non valide pour les Forums';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ de saisie valide pour '.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

 // SexyTooltips 
$lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_LAYOUT'] = 'Vous pouvez choisir de nombreux pr&eacute;sentation . Changer le cadre et le fond de vos info-bulles en seulement quelques clics'; 
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_MOUSECLICK'] = 'Au clic de souris'; 
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_MOUSEOVER'] = 'Au passage de la souris'; 
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_POPUP'] = 'Info-bulle PopUp'; 
$lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_POPUP'] = 'Vous pouvez choisir la fa&ccedil;on dont s\'affiche les info bulles.'; 
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_AUTO'] = 'Auto'; 
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_TR'] = 'En haut &agrave; droite'; 
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_TL'] = 'En haut &agrave; gauche'; 
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_BR'] = 'En bas &agrave; droite'; 
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_BL'] = 'En bas &agrave; gauche'; 
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_MODE'] = 'Mode Info-Bulle'; 
$lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_MODE'] ='Vous pouvez choisir la position o&ugrave; vous voulez que les info-bulles apparaissent.';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_BREAK'] = 'Param&egrave;tres des Info-Bulle';
 
// done 

?>