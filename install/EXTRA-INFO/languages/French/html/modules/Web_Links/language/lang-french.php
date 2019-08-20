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

global $module_name, $userinfo, $anonwaitdays, $outsidewaitdays;

$lang_new[$module_name]['MODULE_NAME'] = str_replace ("_", " ", $module_name);
$lang_new[$module_name]['ADMIN_HEADER'] = 'Evo-Cms Web Lien :: Panneau d\'administration du module';
$lang_new[$module_name]['ADMIN_GO_MAIN'] = 'Retour au Menu principale d\'Administration';
$lang_new[$module_name]['ADMIN_WEBLINKSADMIN'] = 'Administration Lien internet';
$lang_new[$module_name]['ADMIN_WEBLINKS_STATUS'] = 'Status Lien Internet';
$lang_new[$module_name]['ADMIN_ADD_CAT'] = 'Ajouter une Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_ADD_SUBCAT'] = 'Ajouter une Sous-Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_ADD_LINK'] = 'Ajouter un lien';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY'] = 'V&eacute;rifier les Cat&eacute;gories';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY_INCLSUB'] = 'Inclure une Sous Cat&eacute;gories';
$lang_new[$module_name]['ADMIN_LINK_VALIDATE'] = 'Valider le Lien';
$lang_new[$module_name]['ADMIN_CAT_VALIDATE'] = 'Valider la Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_CATSUB_VALIDATE'] = 'Valider la Sous-Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_CAT_ATTACHED'] = 'attacher &agrave; cette Categorie';
$lang_new[$module_name]['ADMIN_VALIDATE_FAILED'] = 'Validation &eacute;chou&eacute;e';
$lang_new[$module_name]['ADMIN_LINK_VALIDATE_WAIT'] = 'Patientez ..';
$lang_new[$module_name]['ADMIN_VALIDATE_OPTIONS'] = 'Options';
$lang_new[$module_name]['ADMIN_LINK_CHECK'] = 'V&eacute;rifier le lien';
$lang_new[$module_name]['ADMIN_LINK_CHECK_ALL'] = 'V&eacute;rifeir tout les lienx';
$lang_new[$module_name]['ADMIN_LINK_PROPOSED'] = 'Proposer un lien';
$lang_new[$module_name]['ADMIN_LINK_ORIGINAL'] = 'Lien Original';
$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'] = 'pr&eacute;visualiser l\'image';
$lang_new[$module_name]['ADMIN_MODIFY_LINK'] = 'Modifier les Liens';
$lang_new[$module_name]['ADMIN_MODIFY_CAT'] = 'Modifier la Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_BROKEN_LINK'] = 'G&eacute;rer les liens cass&eacute;s';
$lang_new[$module_name]['ADMIN_MODIFY_LINK_REQUEST'] ='G&eacute;rer les requ&ecirc;tes';
$lang_new[$module_name]['ADMIN_TRANSFER_CAT'] = 'Transf&eacute;rer une Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_EDITORIAL_ADD'] = 'Ajouter un &eacute;ditoriale';
$lang_new[$module_name]['ADMIN_EDITORIAL_MODIFY'] = 'Modifier l\'&eacute;ditoriale';
$lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] = 'Effacer les Commentaires';
$lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] = 'Param&egrave;tres du Module';
$lang_new[$module_name]['ADMIN_LINK_VOTE_REGUSER'] = 'Votes des utilisateurs enregistr&eacute;s';
$lang_new[$module_name]['ADMIN_LINK_VOTE_UNREG'] = 'Votes des utilisateurs non-enregistr&eacute;s';
$lang_new[$module_name]['ADMIN_LINK_VOTE_GUESTS'] = 'Votes des anonymes';
$lang_new[$module_name]['ADMIN_LINK_VOTE_TOTAL'] = 'Total Votes';
$lang_new[$module_name]['ADMIN_LINK_RATING'] = 'Evaluation';
$lang_new[$module_name]['ADMIN_LINK_RATING_AVERAGE'] = 'Moyenne de l\'&eacute;valuation des utilisateurs';
$lang_new[$module_name]['ADMIN_LINK_RATING_TOTAL'] = 'Evaluation totale des utilisateurs';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BEHAVIOR'] = 'Comportement';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BLOCKS'] = 'Param&egrave;tres du Bloc';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_VOTING'] = 'Param&egrave;tres des Votes';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW'] = 'Est-ce-que la Top-Box &ecirc;tre vue? ';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW_LINKS'] = 'Combien de lien peuvent &ecirc;tre vue dans la Top-Box?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_HEIGHT'] = 'Hauteur de la Top-Box en pixel';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL'] = 'Si ces liens d&eacute;file?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_AMOUNT'] = 'Vitesse de d&eacute;filement';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_DIRECTION'] = 'Sens de d&eacute;filement';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_TITLE'] = 'Param&egrave;tre de la Table';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR1'] = 'Couleur de fond de la table 1';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR2'] = 'Couleur de fond de la table 2';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_TITLE'] = 'Param&egrave;tres des Images';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_WIDTH'] = 'Taille de l\'image : Largeur';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_HEIGHT'] = 'Taille de l\'image : Hauteur';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_USE'] = 'Doit-on utiliser un serveur de miniature pour afficher les images des liens ?';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_URL'] = 'Entrer l\'URL du serveur de miniature<br />(Exemple: http://www.websitethumbnails.net/view.php?url=)';
$lang_new[$module_name]['ADMIN_SETTING_USE_SECURITYCODE'] = 'Utiliser le code de s&eacute;curit&eacute; ?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_ROWS'] = 'Combien de lien peuvent &ecirc;tre vue dans le block lien ?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL'] = 'Si ces liens d&eacute;file ?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_BREAKS_NO'] = 'Combien de ligne d\'espace entre chaque lien ?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_HEIGHT'] = 'Hauteur du Block en Pixel';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_SHOW'] = 'Voir les images';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_WIDTH'] = 'Image taille: Largueur';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_HEIGHT'] = 'Image taille: Hauteur';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_TITLE'] ='Comportement du d&eacute;filement';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_AMOUNT'] = 'Vitesse du d&eacute;filement';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_DIRECTION'] = 'Direction du d&eacute;filement';

$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TITLE'] = 'Param&egrave;tre G&eacute;n&eacute;ral';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_LINKS_PER_PAGE'] = 'Nombre de lien internet vue par page';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_POPULAR'] = 'Combien de fois doit &ecirc;tre vue un lien pour &ecirc;tre not&eacute; comme populaire ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_NEWLINKS'] = 'Nombre de lien internet visible dans la page des nouveaux liens ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_BESTLINKS'] = 'Nombre de lien internet visible dans la page des liens populaires ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_SEARCHLINKS'] = 'Nombre de lien internet visible dans la page de recherche(R&eacute;sultat de recherche)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNLINKS'] = 'Est-ce-que les anonymes peuvent soumettre des liens ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNKNOWN'] = 'Nombre de jour que les anonymes doivent attendre avant d\'avoir le droit de voter pour un lien ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNREGS'] = 'Nombre de jour que les utilisateurs enregistr&eacute;s (ae. Admins) doivent attendre avant de pouvoir voter pour un lien ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_ADMINLINKS'] = 'Webadmins sont en mesure d\'ajouter des liens Web sur leurs sites ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_GUEST_TO_REGISTERED'] = 'Pourcentage (xx/100):  des votes anonymes par rapport aux votes des utilisateurs enregistr&eacute;s';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_UNREG_TO_REGISTERED'] = 'Pourcentage (xx/100): des votes des utilisateurs non enregistr&eacute;s(ae. Admins) par rapport au vote des utilisateurs enregistr&eacute;s';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_DETAIL'] = 'Combien de d&eacute;cimales doit &ecirc;tre montr&eacute; dans les d&eacute;tails Votes ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_MAIN'] = 'Combien de d&eacute;cimales doit &ecirc;tre indiqu&eacute; nulle part ailleurs ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_PERCENT'] = 'Toplinks doit &ecirc;tre montr&eacute; en tant que pourcentage<br />(sinon, ils sont pr&eacute;sent&eacute;s comme #/Totallinks)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_VOTEMIN'] = 'Combien de pourcentage ou de nombre doit &ecirc;tre atteint pour montrer un lien internet dans Toplink?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_PERCENT'] = 'Un liens populaire doit &ecirc;tre montr&eacute; en tant que pourcentage<br />(sinon, ils sont pr&eacute;sent&eacute;s comme #/Totallinks)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_VOTEMIN'] = 'Combien de pourcentage ou de nombre doit &ecirc;tre atteint pour montrer un lien internet dans les liens populaires?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_SHOW_FEATURE_BOX'] ='Afficher l\'en-t&ecirc;te des liens Internet  sur la page principale ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPVOTE_MIN'] = 'Nombre de vote qu\'un lien internet doit obtenir avant de devenir un lien internet Topvot&eacute;?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWN_MODREQ'] = 'Interdire aux invit&eacute;s de proposer des modifications sur les liens?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNVOTING'] = 'Autoriser les invit&eacute;s &agrave; voter ? <br />(Si vous ne l\'autoris&eacute; pas, les voteurs venant de l\'ext&eacute;rieur ne pourront pas le faire)';

$lang_new[$module_name]['THERE_ARE'] = 'Il y a ';
$lang_new[$module_name]['WEBLINKS_IN_DB'] = 'Liens dans la base de donn&eacute;es.';
$lang_new[$module_name]['TOTAL_LINKS'] = 'Total Liens';
$lang_new[$module_name]['TOTAL'] = 'Total';
$lang_new[$module_name]['TO'] = 'de';
$lang_new[$module_name]['NAME'] = 'Nom';
$lang_new[$module_name]['USER'] = 'Utilisateur';
$lang_new[$module_name]['USER_REGISTERED'] = 'Utilisateur enregistr&eacute;';
$lang_new[$module_name]['USER_REGISTERED_NOT'] = 'Utilisateur non enregistr&eacute;';
$lang_new[$module_name]['DESCRIPTION'] = 'Description';
$lang_new[$module_name]['CATEGORY'] = 'Cat&eacute;gorie';
$lang_new[$module_name]['CATEGORIES'] = 'Cat&eacute;gories';
$lang_new[$module_name]['CATEGORYSUB'] = 'Sous-Cat&eacute;gorie';
$lang_new[$module_name]['CATEGORIESSUB'] = 'Sous-Cat&eacute;gories';
$lang_new[$module_name]['EMAIL'] = 'Email';
$lang_new[$module_name]['EDITORIAL'] = 'Editoriale';
$lang_new[$module_name]['HITS'] = 'Clic';
$lang_new[$module_name]['SEARCH_RESULTS_HEADER'] = 'R&eacute;sultat de la recherche pour votre demande:';
$lang_new[$module_name]['SEARCH_RESULTS_CATEGORIES'] = 'Trouver dans les Cat&eacute;gories';
$lang_new[$module_name]['SEARCH_RESULTS_LINKS'] = 'Trouver dans les Liens';
$lang_new[$module_name]['SEARCH_RESULTS_NO_MATCH'] = 'D&eacute;sol&eacute;, mais nous n\'avons rien trouver dans la base de donn&eacute;es';
$lang_new[$module_name]['SEARCH_RESULTS_TRYSEARCH'] = 'Try to Search';
$lang_new[$module_name]['SEARCH_RESULTS_OTHER_ENGINES'] = 'dans un autre moteur de recherche';
$lang_new[$module_name]['SUBMIT_MODIFY'] = 'Modifier';
$lang_new[$module_name]['SUBMIT_DELETE'] = 'Effacer';
$lang_new[$module_name]['SUBMIT_ADD'] = 'Ajouter';
$lang_new[$module_name]['SUBMIT_SAVE'] = 'Sauvegarder';
$lang_new[$module_name]['SUBMIT_DOIT'] = 'Faites-le';
$lang_new[$module_name]['SUBMIT_ACCEPT'] = 'Accepter';
$lang_new[$module_name]['SUBMIT_GOBACK'] = _GOBACK;
$lang_new[$module_name]['SUBMIT_RETURN'] = 'Retour';
$lang_new[$module_name]['SUBMIT_BACK_CATEGORY'] = 'Retour &agrave; la Categorie';
$lang_new[$module_name]['SUBMIT_VOTE'] = 'Vote !';
$lang_new[$module_name]['SUBMIT_MODIFY_REQUEST'] = 'Soumettre une requ&ecirc;te de modification';
$lang_new[$module_name]['MODIFY'] = 'Modifier';
$lang_new[$module_name]['AUTHOR'] = 'Auteur';
$lang_new[$module_name]['DELETE'] = 'Effacer';
$lang_new[$module_name]['IGNORE'] = 'Ignorer';
$lang_new[$module_name]['EDIT'] = 'Editer';
$lang_new[$module_name]['LINK_OWNER'] = 'Propri&eacute;taire du lien';
$lang_new[$module_name]['LINK_SUBMITTER'] = 'Soumettreur du lien';
$lang_new[$module_name]['LINK_ID'] = 'ID du lien';
$lang_new[$module_name]['LINK_URL'] = 'URL du lien';
$lang_new[$module_name]['LINK_PAGETITLE'] = 'Titre de la page';
$lang_new[$module_name]['LINK_IMAGE_URL'] = 'URL de l\'image';
$lang_new[$module_name]['LINK_IMAGE'] = 'Image';
$lang_new[$module_name]['LINK_SUBMIT_DATE'] = 'Lien soumis le';
$lang_new[$module_name]['LINK_VALIDATE_DATE'] = 'Lien valider le';
$lang_new[$module_name]['LINK_PROFILE'] = 'Profile lien';
$lang_new[$module_name]['LINKS_NEW'] = 'Nouveaux liens';
$lang_new[$module_name]['IN'] = 'Dans';
$lang_new[$module_name]['BE_PATIENT'] = 'Un moment s\'il vous pla&icirc;t ...';
$lang_new[$module_name]['TITLE'] = 'Titre';
$lang_new[$module_name]['BY'] = 'par';
$lang_new[$module_name]['UP'] = 'Vers le haut';
$lang_new[$module_name]['DOWN'] = 'Vers le bas';
$lang_new[$module_name]['OK'] = 'OK';
$lang_new[$module_name]['OF'] = 'de';
$lang_new[$module_name]['NONE'] = 'Aucun';
$lang_new[$module_name]['DATE'] = 'Date';
$lang_new[$module_name]['VISIT'] = 'Visite';
$lang_new[$module_name]['VIEW_FULL'] = 'Voir en pleine &eacute;cran';
$lang_new[$module_name]['COMMENTS'] = 'Commentaires';
$lang_new[$module_name]['COMMENTS_TOTAL'] = 'Commentaires Totales';
$lang_new[$module_name]['COMMENTS_NUMBER'] = 'Nombres de commentaires';
$lang_new[$module_name]['DATE_WRITTEN'] = '&eacute;crit par';
$lang_new[$module_name]['IP_ADRESS'] = 'IP Adresse';
$lang_new[$module_name]['ADD_LINK'] = 'Ajouter un lien';
$lang_new[$module_name]['PICSIZE'] = 'La taille maximuml de l\'image doit &ecirc;tre: ';
$lang_new[$module_name]['PICSIZE_WIDTH'] = 'largeur';
$lang_new[$module_name]['PICSIZE_HEIGHT'] = 'hauteur';
$lang_new[$module_name]['INSTRUCTIONS'] = 'Instructions';
$lang_new[$module_name]['MAIN_CATEGORY_PAGE'] = $lang_new[$module_name]['MODULE_NAME'] . 'Page Principale de Cat&eacute;gorie';
$lang_new[$module_name]['LINKS'] = 'Liens';
$lang_new[$module_name]['AND'] = 'et';
$lang_new[$module_name]['CATEGORIES'] = 'Cat&eacute;gories';
$lang_new[$module_name]['IN_DB'] = 'dans notre base de donn&eacute;es';
$lang_new[$module_name]['BOX_HEADER_NEW'] = 'Les nouveaux liens les plus cliquer';
$lang_new[$module_name]['BOX_HEADER_TOP'] = 'Classement des liens les plus cliquer';
$lang_new[$module_name]['NEW_TODAY'] = 'Nouveau aujourd\'hui';
$lang_new[$module_name]['NEW_LAST3DAY'] = 'Nouveau des 3 derniers jours';
$lang_new[$module_name]['NEW_LAST30DAY'] = 'nouveau des 30 derniers jours';
$lang_new[$module_name]['NEW_THISWEEK'] = 'Nouveau de cette semaine';
$lang_new[$module_name]['NEW_LASTWEEK'] = 'Nouveau de la semaine derni&egrave;re';
$lang_new[$module_name]['NEW_TOTAL'] = 'Total des novueaux liens';
$lang_new[$module_name]['NEW_TOTAL_FORLAST'] = 'Total des nouveaux liens pour';
$lang_new[$module_name]['DAYS'] = 'Jours';
$lang_new[$module_name]['DAYS_30'] = '30 jours';
$lang_new[$module_name]['WEEKS_1'] = '1 Semaine';
$lang_new[$module_name]['WEEKS_2'] = '2 Semaines';
$lang_new[$module_name]['POPULAR'] = 'Populaire';
$lang_new[$module_name]['INDEX_PAGE'] = 'Page Principale';
$lang_new[$module_name]['LINK_SUBMIT'] = 'Soumettre un nouveau lien';
$lang_new[$module_name]['SHOW'] = 'Voir';
$lang_new[$module_name]['SHOW_NEWSLINKS'] = 'Voir les nouveaux liens';
$lang_new[$module_name]['SHOW_MOSTPOPULAR'] = 'Voir les plus populaires des liens';
$lang_new[$module_name]['SHOW_TOPRATED'] = 'Voir les liens les mieux cot&eacute;s';
$lang_new[$module_name]['SHOW_LINK_COMMENTS'] = 'Voir les commentaires du lien';
$lang_new[$module_name]['SHOW_EDITORIAL'] = 'Voir l\'&eacute;ditoriale';
$lang_new[$module_name]['IMAGE_PIXEL'] = 'en Pixel';
$lang_new[$module_name]['RATED_BEST_HEADER'] = 'Liens les mieux cot&eacute;s - Classement';
$lang_new[$module_name]['RATED_BEST'] = 'Mieux cot&eacute;s';
$lang_new[$module_name]['RATED_TOTAL'] = 'Total des liens les mieux cot&eacute;s';
$lang_new[$module_name]['RATED_NUMBERS'] = 'Nombre de Liens les mieux cot&eacute;s';
$lang_new[$module_name]['RATED_USER_AVERAGE'] = 'Cote moyenne des utilisateurs ';
$lang_new[$module_name]['RATING_DETAILS'] = 'D&eacute;tails de la cote';
$lang_new[$module_name]['RATING_OVERALL'] = 'Evaluation g&eacute;n&eacute;rale';
$lang_new[$module_name]['RATING_NUMBERS'] = 'Nombre d\'&eacute;valuations';
$lang_new[$module_name]['RATING_BREAKDOWN_VALUES'] = 'D&eacute;coupage des &eacute;valuations par valeur';
$lang_new[$module_name]['NOTE'] = 'Note';
$lang_new[$module_name]['RATING'] = 'Evaluation';
$lang_new[$module_name]['RATING_WEIGHT_NOTE'] = '* Note: Cette valeur pond&egrave;re donne un avis sur les votes Enregistr&eacute;s par rapport Non enregitr&eacute;s';
$lang_new[$module_name]['RATING_WEIGHT_OUTNOTE'] = '* Note: Cette valeur pond&egrave;re donne un avis sur les votes Enregistr&eacute;s par rapport au utilisateurs ext&eacute;rieurs';
$lang_new[$module_name]['RATING_LINK'] = 'Evaluations des liens';
$lang_new[$module_name]['RATING_LINK_HIGHEST'] = 'Meilleur &eacute;valuation';
$lang_new[$module_name]['RATING_LINK_LOWEST'] = 'Moins bonne &eacute;valuation';
$lang_new[$module_name]['VOTE_MINIMUM'] = 'minimum de votes requis';
$lang_new[$module_name]['VOTE'] = 'Vote';
$lang_new[$module_name]['VOTES'] = 'Votes';
$lang_new[$module_name]['VOTES_TOTAL'] = 'Total Votes';
$lang_new[$module_name]['VOTERS_OUTSIDE'] = 'Votes Ext&eacute;rieur';
$lang_new[$module_name]['VOTERS_UNREGISTERED'] = 'Votant non utilisateur enregistr&eacute;s';
$lang_new[$module_name]['VOTES_OUTSIDE_NONE'] = 'Pas de votant ext&eacute;rieur';
$lang_new[$module_name]['VOTES_UNREGISTERED_NONE'] = 'Pas de vote par les utilisateurs non enregistr&eacute;s';
$lang_new[$module_name]['VOTES_REGISTERED_NONE'] = 'Pas de vote par les utilisateurs enregistr&eacute;s';
$lang_new[$module_name]['DO_RATE'] = 'Evaluation de ce site';
$lang_new[$module_name]['DO_REPORT_BROKEN'] = 'Soumettre un rapport de lien bris&eacute;';
$lang_new[$module_name]['REPORT_BROKEN'] = 'Rapport de lien bris&eacute;';
$lang_new[$module_name]['DO_SHOW_DETAILS'] = 'D&eacute;tails';
$lang_new[$module_name]['DO_SHOW_COMMENTS'] = 'Commentaires';
$lang_new[$module_name]['DO_VOTE_THIS_SITE'] = 'Voter pour ce site';
$lang_new[$module_name]['PAGE_NEXT'] = 'Page Suivante';
$lang_new[$module_name]['PAGE_NONEXT'] = 'Pas de Page Suivante';
$lang_new[$module_name]['PAGE_PREVIOUS'] = 'Page Pr&eacute;c&eacute;dente';
$lang_new[$module_name]['PAGE_NOPREVIOUS'] = 'Pas de Page Pr&eacute;c&eacute;dente';
$lang_new[$module_name]['SORTS_BY'] = 'Trier les liens par';
$lang_new[$module_name]['SORTS_IS'] = 'Liens actuellement tri&eacute;s par';
$lang_new[$module_name]['SORTS_TITLEAZ'] = 'Titre (A &agrave; Z)';
$lang_new[$module_name]['SORTS_TITLEZA'] = 'Titre (Z &agrave; A)';
$lang_new[$module_name]['SORTS_POPULARITY_UP'] = 'Popularit&eacute;e (Du moins au plus cliquer)';
$lang_new[$module_name]['SORTS_POPULARITY_DOWN'] = 'Popularit&eacute;e (Du plus ou moins cliquer)';
$lang_new[$module_name]['SORTS_DATE_UP'] = 'Date (Anciens liens list&eacute;s en premier)';
$lang_new[$module_name]['SORTS_DATE_DOWN'] = 'Date (Nouveaux liens list&eacute;s en premier)';
$lang_new[$module_name]['SORTS_RATING_UP'] = 'Evaluation (Petit score &agrave; Grand score)';
$lang_new[$module_name]['SORTS_RATING_DOWN'] = 'Evaluation (Grand score &agrave; Petit Scores)';
$lang_new[$module_name]['MOST_POPULAR'] = 'Plus Populaire';
$lang_new[$module_name]['MODIFY_LINK_REQUEST'] = 'Requ&ecirc;te de Modification de lien';
$lang_new[$module_name]['EDITORIAL_BY'] = 'Editoriale post&eacute; par';
$lang_new[$module_name]['WELCOME_USERNAME'] = "Salut ".UsernameColor($userinfo['username']).", ";
$lang_new[$module_name]['PROMOTE_YOUR_WEBSITE'] = 'Promouvoir votre site web';
$lang_new[$module_name]['PROMOTE_RATING_FORM'] = 'Formulaire d\'&eacute;valuation &agrave; distance';
$lang_new[$module_name]['PROMOTE_RATING_BUTTON_LINK'] = 'Bouton Lien';
$lang_new[$module_name]['PROMOTE_RATING_TEXT_LINK'] = 'Lien text';
$lang_new[$module_name]['PROMOTE_RATING_THE_NUMBER'] = 'Le nombre';
$lang_new[$module_name]['PROMOTE_RATING_ID_REFERER'] = 'dans le source HTML r&eacute;f&eacute;rence l\'ID de votre site dans la '.$sitename.' base de donn&eacute;es. Assurez-vous que ce nombre est pr&eacute;sent.';
$lang_new[$module_name]['WEBLINKS_SIGNATURE'] = 'L\'&eacute;quipe';
$lang_new[$module_name]['ADMIN_OPTIONS'] = 'Admin Options:';
$lang_new[$module_name]['SCROLL_UP'] = 'Vers le haut';
$lang_new[$module_name]['SCROLL_DOWN'] = 'Vers le bas';

$lang_new[$module_name]['INFO_DELETE'] = 'Effacer (Supprime <strong><em>lien bris&eacute;</em></strong> et <strong><em>requ&ecirc;tes</em></strong> pour ce lien)"';
$lang_new[$module_name]['INFO_IGNORE'] = 'Ignorer (Supprimer tout<strong><em>requ&ecirc;tes</em></strong> pour ce lien)';
$lang_new[$module_name]['INFO_PENDING'] = 'Votre lien sera activ&eacute; apr&egrave;s v&eacute;rification par notre &eacute;quipe.<br />Apr&egrave;s que nous aurons v&eacute;rifi&eacute; votre lien, vous serez inform&eacute; par e-mail.';
$lang_new[$module_name]['INFO_ONLYONCE'] = 'Merci de soumettre seulement une fois votre URL.<br />Nous v&eacute;rifions que votre URL n\'existent pas d&eacute;j&agrave; dans notre base de donn&eacute;es.';
$lang_new[$module_name]['INFO_ONLYREGISTERED'] = 'D&eacute;sol&eacute;, mais nous ne permettons qu\'aux utilisateurs enregistr&eacute;s de faire l\'action que vous avez s&eacute;lectionn&eacute; sur notre site.<br />Si vous &ecirc;tes un utilisateur enregistr&eacute;, vous n\'&ecirc;tes pas connect&eacute; pour le moment. Vous pouvez vous connecter <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">ici</a></strong><br />Sinon, vous pouvez vous inscrire <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">ici</a></strong>';
$lang_new[$module_name]['INFO_NO_SUBCAT'] = '--- Pas de Sous-Cat&eacute;gorie ---';
$lang_new[$module_name]['INFO_RATING_1'] = 'Merci de ne pas voter pour la m&ecirc;me site plus d\'une fois.';
$lang_new[$module_name]['INFO_RATING_2'] = 'L\'&eacute;chelle est 1 - 10, avec 1 &eacute;tant faible et 10 &eacute;tant excellent.';
$lang_new[$module_name]['INFO_RATING_3'] = 'Merci d\'&ecirc;tre objectif dans votre vote, si chacun re&ccedil;oit un 1 ou un 10, les notations ne sont pas tr&egrave;s utiles.';
$lang_new[$module_name]['INFO_RATING_4'] = 'Vous pouvez voir une liste des <a href="modules.php?name='.$module_name.'&amp;op=TopRated">Sites les mieux not&eacute;es</a>.';
$lang_new[$module_name]['INFO_RATING_5'] = 'Ne votez pas pour votre propre site ou un concurrent.';
$lang_new[$module_name]['INFO_REG_LOGGEDIN'] = 'Vous &ecirc;tes un utilisateur enregistr&eacute; et sont enregistr&eacute;s dans';
$lang_new[$module_name]['INFO_UNREG_LOGGEDOUT'] = 'Vous n\'&ecirc;tes pas un utilisateur enregistr&eacute; ou vous n\'&ecirc;tes pas connect&eacute;s.';
$lang_new[$module_name]['INFO_RATE_CANDO'] = 'N\'h&eacute;sitez pas &agrave; ajouter un commentaire sur ce site.';
$lang_new[$module_name]['INFO_RATE_CANNOTDO'] = 'Si vous &eacute;tiez enregistr&eacute;, vous pourriez faire des commentaires sur ce site.';
$lang_new[$module_name]['INFO_ISTHSYOURSITE'] = 'Est-ce le votre?';
$lang_new[$module_name]['INFO_ALLOW_TO_RATE'] = 'Autoriser les autres utilisateurs &agrave; voter depuis votre site web!';
$lang_new[$module_name]['INFO_RATE_ADDED_COMMENT'] = 'Les commentaires des utilisateurs, tels que vous, aideront d\'autres visiteurs &agrave; mieux choisir les liens sur lesquels cliquer.';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU'] = 'Merci d\'avoir pris le temps d\'&eacute;valuer les sites sur:';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] = '.';
$lang_new[$module_name]['INFO_RATE_COMPLETED_OK'] = 'Votre note est appr&eacute;ci&eacute;e.';
$lang_new[$module_name]['INFO_THANKS'] = 'Merci pour l\'information.';
$lang_new[$module_name]['INFO_LOOK_AFTER'] = 'Nous allons examiner votre demande rapidement.';
$lang_new[$module_name]['INFO_PROMOTE_1'] = 'Peut-&ecirc;tre que vous pouvez &ecirc;tre int&eacute;ress&eacute; par plusieurs options "Evaluer un site" dont nous disposons. Ils vous permettent de placer une image (ou un formulaire d\'&eacute;valuation) sur votre site web afin d\'augmenter le nombre de votes que votre site recevra. Merci de choisir une des options &eacute;num&eacute;r&eacute;es ci-dessous:';
$lang_new[$module_name]['INFO_PROMOTE_2'] = 'Une fa&ccedil;on de lier vers le formulaire de vote par le biais d\'un lien :';
$lang_new[$module_name]['INFO_PROMOTE_3'] = 'Si vous &ecirc;tes &agrave; la recherche d\'un peu plus qu\'un lien texte de basic, vous pouvez utiliser un lien par bouton :';
$lang_new[$module_name]['INFO_PROMOTE_4'] = 'Si vous tentez de tricher, nous retirerons votre lien. Cela dit, voici &agrave; quoi ressemble le formulaire d\'&eacute;valuation &agrave; distance.';
$lang_new[$module_name]['INFO_PROMOTE_5'] = 'Merci! et bonne chance avec votre &eacute;valuation!';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_1'] = 'Le code HTML &agrave; utiliser dans ce cas, est la suivante:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_2'] = 'Le code source pour le bouton ci-dessus est:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_3'] = 'Utiliser ce formulaire permettra aux utilisateurs de voter pour votre fichier directement &agrave; partir de votre site et l\'&eacute;valuation sera enregistr&eacute;e sur notre site. Le formulaire ci-dessus est d&eacute;sactiv&eacute;, mais le code source suivant fonctionnera si vous le copiez et le collez dans votre page Web. Le code source est indiqu&eacute; ci-dessous :';

$lang_new[$module_name]['WARN_RECORDED'] = '<span style="color:red">Votre nom d\'utilisateur et votre adresse IP est enregistr&eacute;, alors merci de ne pas abuser de ce syst&egrave;me</span>';
$lang_new[$module_name]['WARN_CAT_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas de cat&eacute;gorie &agrave; supprimer/modifier/&eacute;diter/transf&eacute;rer</span>';
$lang_new[$module_name]['WARN_LINK_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas de lien &agrave; supprimer/modifier/&eacute;diter/valider</span>';
$lang_new[$module_name]['WARN_VOTE_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas de vote &agrave; supprimer/modifier/&eacute;diter/valider</span>';
$lang_new[$module_name]['WARN_COMMENT_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas de commentaire &agrave; supprimer/modifier/&eacute;diter/valider</span>';
$lang_new[$module_name]['WARN_EDITORIAL_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas d\'&eacute;ditoriale &agrave; supprimer/modifier/&eacute;diter/valider</span>';
$lang_new[$module_name]['WARN_COMMENT_DELETE_ALL'] = '<span style="color:red">ATTENTION<br />Ceci supprimera <em>Tous</em> les commentaires de <em>tous</em> les liens.<br />Pour supprimer les commenteires d\'un lien sp&eacute;cial, s&eacute;lectionner <em>'. $lang_new[$module_name]['ADMIN_MODIFY_LINK'] .'</em> depuis le Menu d\'administration</span>';
$lang_new[$module_name]['WARN_RATE_COMPLETED_TOSHORT'] = '<span style="color:red">Vous avez d&eacute;j&agrave; vot&eacute; pour ce site dans le pass&eacute; '.$anonwaitdays.' jour(s).</span>';
$lang_new[$module_name]['WARN_RATE_ONLY_ONCE'] = '<span style="color:red">Vous ne pouvez voter qu\'une seule fois pour un site.<br />Tous les votes sont enregistr&eacute;s et examin&eacute;s</span>';
$lang_new[$module_name]['WARN_RATE_NOT_SELF'] = '<span style="color:red">Vous ne pouvez pas voter pour un lien que vous avez soumis.<br />Tous les votes sont enregistr&eacute;s et examin&eacute;s</span>';
$lang_new[$module_name]['WARN_RATE_NO_SELECTED'] = '<span style="color:red">Pas d\'&eacute;valuation s&eacute;lectionn&eacute;e - Pas de vote d&eacute;pouill&eacute;s.</span>';
$lang_new[$module_name]['WARN_RATE_OUTSIDE_TOSHORT'] = '<span style="color:red">Un seul vote par adresse IP est autoris&eacute; tous les '.$outsidewaitdays.' jour(s).</span>';
$lang_new[$module_name]['WARN_CAT_DELETE'] = '<span style="color:red">ATTENTION : Etes-vous s&ucirc;r de vouloir effacer cette cat&eacute;gorie ? <br />Vous supprimerez toutes les sous-cat&eacute;gories et les liens li&eacute;s !</span>';

$lang_new[$module_name]['MESSAGE_LINK_ADDED'] = 'Votre lien a &eacute;t&eacute; correctement sauvegarder dans la base de donn&eacute;es';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED'] = 'Nous avons re&ccedil;u votre proposition de lien. Merci!';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_EMAIL'] = 'Vous reverez un Email une fois que notre &eacute;quipe aura valid&eacute; votre proposition.';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_NOEMAIL'] = 'Vous n\'avez pas fournis d\'adresse email, mais nous allons v&eacute;rifier votre lien malgr&eacute; tout.<br />Alors s\'il vous pla&icirc;t jeter un oeil de temps en temps pour voir si votre proposition est activ&eacute;.';
$lang_new[$module_name]['MESSAGE_EDITORIAL_ADDED'] = 'Votre Editoriale a &eacute;t&eacute; correctement sauvegarder dans la base de donn&eacute;es';
$lang_new[$module_name]['MESSAGE_EDITORIAL_MODIFIED'] = 'Votre Editoriale a &eacute;t&eacute; correctement modifi&eacute;';
$lang_new[$module_name]['MESSAGE_EDITORIAL_REMOVED'] = 'Votre Editoriale a &eacute;t&eacute; correctement effac&eacute;';
$lang_new[$module_name]['MESSAGE_COMMENT_DELETE_ALL'] = 'Tous les commentaires ont &eacute;t&eacute; effac&eacute; de la base de donn&eacute;es <br />Esp&egrave;rons que vous n\'avez pas fait une erreur<br />Ils ne peuvent pas &ecirc;tre r&eacute;cup&eacute;r&eacute;s';
$lang_new[$module_name]['MESSAGE_RATING_ADDED'] = 'Votre &eacute;valuation a &eacute;t&eacute; correctement sauvegarder dans la base de donn&eacute;es';
$lang_new[$module_name]['MESSAGE_LINK_BROKEN_ADDED'] = 'Merci de nous aider &agrave; maintenir l\'int&eacute;grit&eacute; de ce r&eacute;pertoire.';
$lang_new[$module_name]['MESSAGE_LINK_BROKEN_EXISTS'] = 'Merci de nous aider &agrave; maintenir l\'int&eacute;grit&eacute; de ce r&eacute;pertoire. <br />Mais un autre utilisateur a &eacute;t&eacute; plus rapide que vous et nous signal&eacute;  que ce lien &eacute;tait rompu.';
$lang_new[$module_name]['MESSAGE_LINK_VALIDATED'] ='Votre lien a &eacute;t&eacute; valid&eacute; et sauvegarder dans la base de donn&eacute;es!';
$lang_new[$module_name]['MESSAGE_ADMIN_SETTINGS_SAVED'] = '<span style="color:green">Vos param&egrave;tres du module sont sauvegard&eacute;s dans la base de donn&eacute;es.<br />V&eacute;rifiez votre journal d\'erreur pour les informations sur l\'enregistrement des erreurs</span>';

$lang_new[$module_name]['ERROR_NO_DESCRIPTION'] = 'Une description de ce lien est essentiel<br />Merci de revenir en arri&egrave;re et de l\'ajouter';
$lang_new[$module_name]['ERROR_NO_URL'] = 'L\'URL de ce lien est essentiel<br />Merci de revenir en arri&egrave;re et de l\'ajouter';

$lang_new[$module_name]['ERROR_NO_TITLE'] = 'Le titre de ce lien est essentiel<br />Merci de revenir en arri&egrave;re et de l\'ajouter';
$lang_new[$module_name]['ERROR_URL_EXISTS'] = 'L\'URL du lien existe dans notre base de donn&eacute;es <br />Merci de revenir en arri&egrave;re et corriger cela';
$lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] = 'L\'URL du lien ou le titre existe dans notre base de donn&eacute;es <br />Merci de revenir en arri&egrave;re et corriger cela';
$lang_new[$module_name]['ERROR_NO_CONFIG'] = 'Il y a un probl&egrave;me au sein de la base de donn&eacute;es. Aucune configuration pour '.$module_name.' ne peut &ecirc;tre trouv&eacute;.';
$lang_new[$module_name]['ERROR_NO_LID'] = 'Nous n\'avons trouv&eacute; aucun lien dans notre base de donn&eacute;es qui convient &agrave; votre choix.<br />Merci de revenir en arri&egrave;re et essayer &agrave; nouveau.';
$lang_new[$module_name]['ERROR_CAT_EXISTS'] = 'La cat&eacute;gorie ou sous-cat&eacute;gorie que vous d&eacute;sirez cr&eacute;er existe d&eacute;j&agrave; dans notre base de donn&eacute;es<br />Merci de revenir en arri&egrave;re et essayer &agrave; nouveau.';
$lang_new[$module_name]['ERROR_SECURITYCODE'] = 'Le code de s&eacute;curit&eacute; que vous avez rentr&eacute; n\'est pas bon. Merci d\'essayer &agrave; nouveau.<br />(Ce pourrait &ecirc;tre une bonne id&eacute;e de rafra&icirc;chir votre navigateur pour que le code de s&eacute;curit&eacute; soit actualis&eacute; &agrave; nouveau)<br /><br />'.$lang_new[$module_name]['SUBMIT_GOBACK'];

$lang_new[$module_name]['MAIL_SITENAME'] = 'Votre Lien Internet &agrave;: ';
$lang_new[$module_name]['MAIL_HELLO'] = 'Salut';
$lang_new[$module_name]['MAIL_APPROVED_MESSAGE'] = 'F&eacute;licitation ! Le lien que vous avez soumis a &eacute;t&eacute; approuv&eacute; et est disponible pour les utilisateurs du site.';
$lang_new[$module_name]['MAIL_BROWSEURL'] = 'Consultez nos Liens Web cliquer sur cette URL ->';
$lang_new[$module_name]['MAIL_THANKYOU'] = 'Grand merci pour votre proposition - Vous serez toujours les bienvenus sur notre site';
$lang_new[$module_name]['MAIL_SIGNATURE'] = 'L\'&eacute;quipe';

?>