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

global $module_name, $userinfo, $anonwaitdays, $outsidewaitdays;

$lang_new[$module_name]['MODULE_NAME'] = str_replace ("_", " ", $module_name);
$lang_new[$module_name]['ADD_REVIEW'] = 'Ajouter une Critique';
$lang_new[$module_name]['ADMIN_ADD_CAT'] = 'Ajouter une Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_ADD_REVIEW'] = 'Ajouter une Critique';
$lang_new[$module_name]['ADMIN_ADD_SUBCAT'] = 'Ajouter une Sous-Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_BROKEN_REVIEW'] = 'G&eacute;rer les critiques bris&eacute;';
$lang_new[$module_name]['ADMIN_CATSUB_VALIDATE'] = 'Valider la Sous-Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_CAT_ATTACHED'] = 'attacher &agrave; cette cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_CAT_VALIDATE'] = 'Valider la Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY'] = 'V&eacute;rifier les cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY_INCLSUB'] = 'Inclure les Sous-Cat&eacute;gories';
$lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] = 'Effacer les commentaires';
$lang_new[$module_name]['ADMIN_EDITORIAL_ADD'] = 'Ajouter un Editoriale';
$lang_new[$module_name]['ADMIN_EDITORIAL_MODIFY'] = 'Modifier l\'Editoriale';
$lang_new[$module_name]['ADMIN_GO_MAIN'] = 'Retour au Menu Principale d\'administration';
$lang_new[$module_name]['ADMIN_HEADER'] = 'Evo-Cms Critiques :: Panneau d\'administration du module';
$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'] = 'Pr&eacute;visualiser l\'image';
$lang_new[$module_name]['ADMIN_MODIFY_CAT'] = 'Modifier la Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_MODIFY_REVIEW'] = 'Modifier la Critique';
$lang_new[$module_name]['ADMIN_MODIFY_REVIEW_REQUEST'] ='G&eacute;rer le requ&ecirc;te de critique';
$lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] = 'Param&egrave;tres du Module';
$lang_new[$module_name]['ADMIN_OPTIONS'] = 'Admin Options:';
$lang_new[$module_name]['ADMIN_REVIEWSADMIN'] = 'Administration Critiques';
$lang_new[$module_name]['ADMIN_REVIEWS_STATUS'] = 'Critiques Status';
$lang_new[$module_name]['ADMIN_REVIEW_CHECK'] = 'V&eacute;rifier la critique';
$lang_new[$module_name]['ADMIN_REVIEW_CHECK_ALL'] = 'V&eacute;rifier toutes les critiques';
$lang_new[$module_name]['ADMIN_REVIEW_ORIGINAL'] = 'Critique Originale';
$lang_new[$module_name]['ADMIN_REVIEW_PROPOSED'] = 'Critique Propos&eacute;e';
$lang_new[$module_name]['ADMIN_REVIEW_RATING'] = 'Evaluation';
$lang_new[$module_name]['ADMIN_REVIEW_RATING_AVERAGE'] = 'Evaluation moyenne des utilisateurs';
$lang_new[$module_name]['ADMIN_REVIEW_RATING_TOTAL'] = 'Total des votes utilisateurs';
$lang_new[$module_name]['ADMIN_REVIEW_VALIDATE'] = 'Valider la critique';
$lang_new[$module_name]['ADMIN_REVIEW_VALIDATE_WAIT'] = 'Patientez ..';
$lang_new[$module_name]['ADMIN_REVIEW_VOTE_GUESTS'] = 'Votes Anonymes';
$lang_new[$module_name]['ADMIN_REVIEW_VOTE_REGUSER'] = 'Votes utilisateurs enregistr&eacute;s';
$lang_new[$module_name]['ADMIN_REVIEW_VOTE_TOTAL'] = 'Total Votes';
$lang_new[$module_name]['ADMIN_REVIEW_VOTE_UNREG'] = 'Votes utilisateurs non enregistr&eacute;s';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_BREAKS_NO'] = 'Combien de saut de ligne doivent &ecirc;tre ins&eacute;r&eacute;s entre chaque critiques?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_HEIGHT'] = 'Taille du block en Pixel';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_HEIGHT'] = 'Taille Image : Hauteur';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_WIDTH'] = 'Taille Image : Largeur';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_ROWS'] = 'Combien de critiques peuvent &ecirc;tre vue dans le Block Critique?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL'] = 'Est-ce que les critiques d&eacute;filent ?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_AMOUNT'] = 'Vitesse de d&eacute;filement';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_DIRECTION'] = 'Direction du d&eacute;filement';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_TITLE'] ='Comportement du d&eacute;filement';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BEHAVIOR'] = 'Comportement';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BLOCKS'] = 'Param&egrave;tres du Block';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_VOTING'] = 'Param&egrave;tres Vote';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_DETAIL'] = 'Combien de d&eacute;cimales doit &ecirc;tre montr&eacute; dans les d&eacute;tails du Vote ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_MAIN'] = 'Combien de d&eacute;cimales doit &ecirc;tre indiqu&eacute; nulle part ailleurs ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_ADMINREVIEWS'] = 'Webadmins sont en mesure d\'ajouter des critiques sur leurs sites ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_BESTREVIEWS'] = 'Nombre de critiques vue dans la page des plus polulaire ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_NEWREVIEWS'] = 'Nombre de critiques vue dans la page des nouvelles critiques ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_POPULAR'] = 'Combien de fois doit &ecirc;tre vue une critique pour &ecirc;tre not&eacute; comme populaire ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_SEARCHREVIEWS'] = 'Nombre de critiques vue dans la page de recherche (R&eacute;sultat de recherche) ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNREVIEWS'] = 'Est-ce que les anonymes peuvent soumettre de nouvelle critique?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNVOTING'] = 'Autoriser les anonymes &agrave; voter? <br />(Si vous ne l\'autoris&eacute; pas, les voteurs venant de l\'ext&eacute;rieur ne pourront pas le faire)';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWN_MODREQ'] = 'Interdire aux invit&eacute;s de proposer des modifications sur les critiques ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_GUEST_TO_REGISTERED'] = 'Pourcentage (xx/100): des votes anonymes par rapport aux votes des utilisateurs enregistr&eacute;s';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_UNREG_TO_REGISTERED'] = 'Pourcentage (xx/100): des votes des utilisateurs non enregistr&eacute;s(ae. Admins) par rapport au vote des utilisateurs enregistr&eacute;s';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_PERCENT'] = 'Critique Populaire sont montr&eacute; en tant que pourcentage
<br />(sinon, elles sont pr&eacute;sent&eacute;s comme #/TotalCritique)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_VOTEMIN'] = 'Combien de pourcentage ou de nombre doit &ecirc;tre atteint pour montrer une Critique comme populaire?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_REVIEWS_PER_PAGE'] = 'Nombre de critique visible par page ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_SHOW_FEATURE_BOX'] ='Voir l\'en-t&ecirc;te des critiques sur la page principale?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TITLE'] = 'Param&egrave;tre G&eacute;n&eacute;ral';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPREVIEWS_PERCENT'] = 'Les top critiques sont montr&eacute; en tant que pourcentage<br />(sinon, elles sont pr&eacute;sent&eacute;s comme #/TotalCritique)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPREVIEWS_VOTEMIN'] = 'Combien de pourcentage ou de nombre doit &ecirc;tre atteint pour montrer une Critique comme Top Critique ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPVOTE_MIN'] = 'Nombre de voix que doit avoir une  critique pour devenir un critique TopVot&eacute; ?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNKNOWN'] = 'Nombre de jour que les anonymes doivent attendre avant de pouvoir voter pour une critique';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNREGS'] = 'Nombre de jour que les utilisateurs non enregistr&eacute;s doivent attendre avant de pouvoir voter pour une critique';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_HEIGHT'] = 'Taille de l\'image: Hauteur';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_URL'] = 'Entrer l\'URL du serveur de miniature<br />(Example: http://www.websitethumbnails.net/view.php?url=)';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_USE'] = 'Doit-on utiliser un serveur de miniature pour afficher les images ?';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_TITLE'] = 'Param&egrave;tre Image';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_WIDTH'] = 'Taille de l\'image: Largeur';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR1'] = 'Couleur de fond de la table 1';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR2'] = 'Couleur de fond de la table 2';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_TITLE'] = 'Param&egrave;tre de la Table';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_HEIGHT'] = 'Taille de la Top-Box en Pixel';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL'] = 'Est-ce que les critiques d&eacute;filent ?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_AMOUNT'] = 'Vitesse de d&eacute;filement';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_DIRECTION'] = 'Direction du d&eacute;filement';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW'] = 'Si le Top-Box est montr&eacute; ?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW_REVIEWS'] = 'Combien de critique peuvent &ecirc;tre vue dans le Top-Box?';
$lang_new[$module_name]['ADMIN_SETTING_USE_SECURITYCODE'] = 'Utiliser le code de s&eacute;curit&eacute;?';
$lang_new[$module_name]['ADMIN_TRANSFER_CAT'] = 'Transf&eacute;rer Cat&eacute;gorie';
$lang_new[$module_name]['ADMIN_VALIDATE_FAILED'] = 'Validation &eacute;chou&eacute;';
$lang_new[$module_name]['ADMIN_VALIDATE_OPTIONS'] = 'Options';
$lang_new[$module_name]['AND'] = 'et';
$lang_new[$module_name]['AUTHOR'] = 'Auteur';
$lang_new[$module_name]['BE_PATIENT'] = 'Un moment merci ...';
$lang_new[$module_name]['BOX_HEADER_NEW'] = 'Liste des nouvelles Critiques';
$lang_new[$module_name]['BOX_HEADER_TOP'] = 'Liste des meilleurs Critiques';
$lang_new[$module_name]['BY'] = 'par';
$lang_new[$module_name]['CATEGORIES'] = 'Cat&eacute;gories';
$lang_new[$module_name]['CATEGORIES'] = 'Cat&eacute;gories';
$lang_new[$module_name]['CATEGORIESSUB'] = 'Sous-Cat&eacute;gories';
$lang_new[$module_name]['CATEGORY'] = 'Cat&eacute;gorie';
$lang_new[$module_name]['CATEGORYSUB'] = 'Sous-Cat&eacute;gorie';
$lang_new[$module_name]['COMMENTS'] = 'Commentaires';
$lang_new[$module_name]['COMMENTS_NUMBER'] = 'Nombre de commentaire';
$lang_new[$module_name]['COMMENTS_TOTAL'] = 'Total des Commentaires';
$lang_new[$module_name]['COPYRIGHT'] = 'Copyright &copy; par';
$lang_new[$module_name]['COPYRIGHT2'] = 'Tous droits r&eacute;serv&eacute;s.';
$lang_new[$module_name]['DATE'] = 'Date';
$lang_new[$module_name]['DATE_WRITTEN'] = '&eacute;crit par';
$lang_new[$module_name]['DAYS'] = 'Jours';
$lang_new[$module_name]['DAYS_30'] = '30 Jours';
$lang_new[$module_name]['DELETE'] = 'Effacer';
$lang_new[$module_name]['DESCRIPTION'] = 'Description';
$lang_new[$module_name]['DOWN'] = 'Vers le bas';
$lang_new[$module_name]['DO_RATE'] = 'Noter ce site';
$lang_new[$module_name]['DO_REPORT_BROKEN'] = 'Signaler que la critique est bris&eacute;e';
$lang_new[$module_name]['DO_SHOW_COMMENTS'] = 'Commentaires';
$lang_new[$module_name]['DO_SHOW_DETAILS'] = 'D&eacute;tails';
$lang_new[$module_name]['DO_VOTE_THIS_SITE'] = 'Voter pour ce site';
$lang_new[$module_name]['EDIT'] = 'Editer';
$lang_new[$module_name]['EDITORIAL'] = 'Editoriale';
$lang_new[$module_name]['EDITORIAL_BY'] = 'Editoriale post&eacute; par';
$lang_new[$module_name]['EMAIL'] = 'Email';
$lang_new[$module_name]['ERROR_CAT_EXISTS'] = 'La Cat&eacute;gorie ou Sous-Cat&eacute;gorie que vous voulez cr&eacute;er existe d&eacute;j&agrave; dans notre base de donn&eacute;es <br />Merci de revenir en arri&egrave;re et de recommencer.';
$lang_new[$module_name]['ERROR_NO_CONFIG'] = 'Il y a un probl&egrave;me au sein de la base de donn&eacute;es. Aucune configuration du module '.$module_name.' n\'a &eacute;t&eacute; trouv&eacute;e.';
$lang_new[$module_name]['ERROR_NO_DESCRIPTION'] = 'Une description de cette critique est essentiel <br />Merci de revenir en arri&egrave; et de l\'ajouter';
$lang_new[$module_name]['ERROR_NO_RID'] = 'Nous n\'avons trouv&eacute; aucune critique dans notre base de donn&eacute;es qui convient &agrave; votre choix.<br />Merci de revenir en arri&egrave;re et de recommencer.';
$lang_new[$module_name]['ERROR_NO_TITLE'] = 'Le titre de la critique est essentiel <br />Merci de revenir en arri&egrave; et de l\'ajouter';
$lang_new[$module_name]['ERROR_NO_URL'] = 'L\'URL de cette critique est essentiel<br />Merci de revenir en arri&egrave; et de l\'ajouter';
$lang_new[$module_name]['ERROR_SECURITYCODE'] = 'Le code de s&eacute;curit&eacute; que vous avez rentr&eacute; n\'est pas bon. Merci de recommencer.<br />(Ce pourrait &ecirc;tre une bonne id&eacute;e de rafra&icirc;chir votre navigateur lorsque vous &ecirc;tes de retour de sorte que le code de s&eacute;curit&eacute; soit actualis&eacute;)<br /><br />'._GOBACK;
$lang_new[$module_name]['ERROR_URL_EXISTS'] = 'L\'URL de la critique existe d&eacute;j&agrave; dans notre base de donn&eacute;es <br />Merci de revenir en arri&egrave; et de corriger cela';
$lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] = 'L\'URL ou le titre de la critique existe d&eacute;j&agrave; dans notre base de donn&eacute;es <br />Merci de revenir en arri&egrave; et de corriger cela';
$lang_new[$module_name]['HITS'] = 'Hits';
$lang_new[$module_name]['IGNORE'] = 'Ignorer';
$lang_new[$module_name]['IMAGE_PIXEL'] = 'en Pixel';
$lang_new[$module_name]['IN'] = 'en';
$lang_new[$module_name]['INDEX_PAGE'] = 'Index Page';
$lang_new[$module_name]['INFO_ALLOW_TO_RATE'] = 'Autoriser les autres utilisateurs &agrave; voter depuis votre site web!';
$lang_new[$module_name]['INFO_DELETE'] = 'Effacer (Efface <strong><em>avis bris&eacute;es</em></strong> et <strong><em>requ&ecirc;tes</em></strong> pour une critique donn&eacute;e)"';
$lang_new[$module_name]['INFO_IGNORE'] = 'Ignorer (Supprime toutes les <strong><em>demandes</em></strong> pour une critique donn&eacute;e)';
$lang_new[$module_name]['INFO_ISTHSYOURSITE'] = 'Est-ce la votre?';
$lang_new[$module_name]['INFO_LOOK_AFTER'] = 'Nous allons examiner votre demande dans peu de temps.';
$lang_new[$module_name]['INFO_NO_SUBCAT'] = '--- Pas de sous-cat&eacute;gorie ---';
$lang_new[$module_name]['INFO_ONLYONCE'] = 'Merci de soumettre votre URL qu\'une seul fois.<br />Nous v&eacute;rifions que vos URL n\'existent pas d&eacute;j&agrave; dans notre base de donn&eacute;es.';
$lang_new[$module_name]['INFO_ONLYREGISTERED'] = 'D&eacute;sol&eacute;, nous permettons uniquement aux utilisateurs enregistr&eacute;s de faire l\'action que vous avez s&eacute;lectionn&eacute;.<br />Si vous &ecirc;tes un utilisateur enregistr&eacute;, vous n\'&ecirc;tes pas connect&eacute; pour le moment. Vous pouvez vous connecter. <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">ici</a></strong><br />Sinon, vous pouvez vous inscrire <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">ici</a></strong>';
$lang_new[$module_name]['INFO_PENDING'] = 'Votre critique sera activ&eacute; apr&egrave;s v&eacute;rification par notre &eacute;quipe.<br />Apr&egrave;s que nous aurons v&eacute;rifi&eacute; votre critique, vous serez inform&eacute; par un e-mail.';
$lang_new[$module_name]['INFO_PROMOTE_1'] = 'Peut-&ecirc;tre que vous pouvez &ecirc;tre int&eacute;ress&eacute; par plusieurs des options <em>Evaluation &agrave; distance du site </em> dont nous disposons. Ils vous permettent de placer une image (ou un formulaire d\'&eacute;valuation) sur votre site web afin d\'augmenter le nombre de votes que votre site recevra. S\'il vous pla&icirc;t choisir une des options &eacute;num&eacute;r&eacute;es ci-dessous :';
$lang_new[$module_name]['INFO_PROMOTE_2'] = 'Une forme de lien vers le formulaire de vote par le biais d\'un lien textuel:';
$lang_new[$module_name]['INFO_PROMOTE_3'] = 'Si vous &ecirc;tes &agrave; la recherche d\'un peu plus d\'un lien texte de base, vous pouvez utiliser un lien par bouton :';
$lang_new[$module_name]['INFO_PROMOTE_4'] = 'Si vous tentez de tricher ici, nous allons retirer votre lien. Cela dit, voici ce que le formulaire d\'&eacute;valuation &agrave; distance ressemble.';
$lang_new[$module_name]['INFO_PROMOTE_5'] = 'Merci! et bonne chance avec votre &eacute;valuation!';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_1'] = 'Le code HTML &agrave; utiliser dans ce cas, est le suivant :';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_2'] = 'Le code source pour le bouton ci-dessus est :';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_3'] = 'Utiliser ce formulaire permettra aux utilisateurs de voter pour votre fichier directement &agrave; partir de votre site et l\'&eacute;valuation sera enregistr&eacute;e ici. Le formulaire ci-dessus est d&eacute;sactiv&eacute;, mais le code source suivant fonctionnera si vous le copiez et collez-le dans votre page Web. Le code source est indiqu&eacute; ci-dessous :';
$lang_new[$module_name]['INFO_RATE_ADDED_COMMENT'] = 'Les commentaires des utilisateurs tels que vous aideront d\'autres visiteurs &agrave; mieux choisir les critiques et &agrave; cliquer dessus.';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU'] = 'Merci d\'avoir pris le temps d\'&eacute;valuer les sites sur :';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] = '.';
$lang_new[$module_name]['INFO_RATE_CANDO'] = 'N\'h&eacute;sitez pas &agrave; ajouter un commentaire sur ce site.';
$lang_new[$module_name]['INFO_RATE_CANNOTDO'] = 'Si vous &eacute;tiez enregistr&eacute;, vous pourriez faire des commentaires sur ce site.';
$lang_new[$module_name]['INFO_RATE_COMPLETED_OK'] = 'Votre &eacute;valuation est appr&eacute;ci&eacute;e.';
$lang_new[$module_name]['INFO_RATING_1'] = 'Merci de ne pas voter pour la m&ecirc;me ressource plus d\'une fois.';
$lang_new[$module_name]['INFO_RATING_2'] = 'L\'&eacute;chelle est 1 - 10, avec 1 &eacute;tant faible et 10 &eacute;tant excellent.';
$lang_new[$module_name]['INFO_RATING_3'] = 'Merci d\'&ecirc;tre objectif dans votre &eacute;valuation, si chacun re&ccedil;oit un 1 ou un 10, les notations ne sont pas tr&egrave;s utiles.';
$lang_new[$module_name]['INFO_RATING_4'] = 'Vous pouvez voir une liste des <a href="modules.php?name='.$module_name.'&amp;op=TopRated">Ressource les mieux not&eacute;es</a>.';
$lang_new[$module_name]['INFO_RATING_5'] = 'Ne votez pas pour votre propre site ou un concurrent.';
$lang_new[$module_name]['INFO_REG_LOGGEDIN'] = 'Vous &ecirc;tes un utilisateur enregistr&eacute; et &ecirc;tes connect&eacute;s.';
$lang_new[$module_name]['INFO_REVIEW_IMGURL'] = '<span style="font-size: xx-small;">Chemin locale d\'acc&egrave;s &agrave; l\'image (Example: modules/Reviews/photos/myimage.png)<br />Pour acc&eacute;der aux images &agrave; partir d\'un serveur externe, vous devez ajouter une URL compl&egrave;te (Exemple: http://www.momsite.com/monimage.png)<br />Si les vignettes sont permis, laissez ce champ vide pour afficher une image miniature.</span>';
$lang_new[$module_name]['INFO_REVIEW_URL'] = '<span style="font-size: xx-small; color: #f00; font-weight: bold;">URL de la critique est sur un serveur externe.<br />Tous les champs ci-dessous seront ignor&eacute;s si une URL est donn&eacute;e ici.</span>';
$lang_new[$module_name]['INFO_THANKS'] = 'Merci pour l\'information.';
$lang_new[$module_name]['INFO_UNREG_LOGGEDOUT'] = 'Vous n\'&ecirc;tes pas un utilisateur enregistr&eacute;, ou vous n\'&ecirc;tes pas connect&eacute;.';
$lang_new[$module_name]['INSTRUCTIONS'] = 'Instructions';
$lang_new[$module_name]['IN_DB'] = 'dans votre base de donn&eacute;es';
$lang_new[$module_name]['IP_ADRESS'] = 'IP Adresse';
$lang_new[$module_name]['MAIL_APPROVED_MESSAGE'] = 'F&eacute;licitations! La critique que vous avez soumis &agrave; notre base de donn&eacute;es vient d\'&ecirc;tre approuv&eacute;e et est disponible pour les utilisateurs du site.';
$lang_new[$module_name]['MAIL_BROWSEURL'] = 'Consultez notre base de donn&eacute;es de critique avec un clic sur cette URL ->';
$lang_new[$module_name]['MAIL_HELLO'] = 'Salut';
$lang_new[$module_name]['MAIL_SIGNATURE'] = 'L\'&eacute;quipe';
$lang_new[$module_name]['MAIL_SITENAME'] = 'Votre critique &agrave; : ';
$lang_new[$module_name]['MAIL_THANKYOU'] = 'Grand merci pour votre proposition - Vous serez toujours les bienvenus sur notre site';
$lang_new[$module_name]['MAIN_CATEGORY_PAGE'] = $lang_new[$module_name]['MODULE_NAME'] . ' Page de la Cat&eacute;gorie Principale ';
$lang_new[$module_name]['MESSAGE_ADMIN_SETTINGS_SAVED'] = '<span style="color:green">Vos param&egrave;tres du module ont &eacute;t&eacute; sauv&eacute; dans la base de donn&eacute;es.<br />V&eacute;rifiez votre journal d\'erreur pour les informations sur l\'enregistrement des erreurs</span>';
$lang_new[$module_name]['MESSAGE_COMMENT_DELETE_ALL'] = 'Tous les commentaires sont supprim&eacute;s de la base de donn&eacute;es<br />J\'esp&egrave;re que vous n\'avez pas fait d\'erreur<br />Ils ne peuvent pas &ecirc;tre r&eacute;cup&eacute;r&eacute;s';
$lang_new[$module_name]['MESSAGE_EDITORIAL_ADDED'] = 'Votre Editoriale est enregistr&eacute; avec succ&egrave;s dans la base de donn&eacute;es';
$lang_new[$module_name]['MESSAGE_EDITORIAL_MODIFIED'] = 'Votre &eacute;ditoriale est modifi&eacute; avec succ&egrave;s';
$lang_new[$module_name]['MESSAGE_EDITORIAL_REMOVED'] = 'Votre &eacute;ditoriale est effac&eacute; avec succ&egrave;s';
$lang_new[$module_name]['MESSAGE_RATING_ADDED'] = 'Votre &eacute;valuation est enregistr&eacute; avec succ&egrave;s dans la base de donn&eacute;es';
$lang_new[$module_name]['MESSAGE_REVIEW_ADDED'] = 'Votre critique est enregistr&eacute; avec succ&egrave;s dans la base de donn&eacute;es';
$lang_new[$module_name]['MESSAGE_REVIEW_BROKEN_ADDED'] = 'Merci de nous aider &agrave; maintenir l\'int&eacute;grit&eacute; de ce r&eacute;pertoire.';
$lang_new[$module_name]['MESSAGE_REVIEW_BROKEN_EXISTS'] = 'Merci de nous aider &agrave; maintenir l\'int&eacute;grit&eacute; de ce r&eacute;pertoire. <br />Mais un autre utilisateur a &eacute;t&eacute; plus rapide que vous et nous a signal&eacute; que cette critique &eacute;tait bris&eacute;e.';
$lang_new[$module_name]['MESSAGE_REVIEW_MODIFIED'] = 'La modification de la critique est enregistr&eacute; avec succ&egrave;s dans la base de donn&eacute;es!';
$lang_new[$module_name]['MESSAGE_REVIEW_SUBMITTED'] = 'Nous avons re&ccedil;u votre demande de critique. Merci!';
$lang_new[$module_name]['MESSAGE_REVIEW_SUBMITTED_EMAIL'] = 'Vous recevrez un e-mail apr&egrave;s que notre &eacute;quipe aura v&eacute;rifi&eacute; votre proposition.';
$lang_new[$module_name]['MESSAGE_REVIEW_SUBMITTED_NOEMAIL'] = 'Vous n\'avez pas fourni d\'adresse email, mais nous allons v&eacute;rifier votre avis bient&ocirc;t. <br /> Alors s\'il vous pla&icirc;t oeil de temps en temps, si votre soumission est activ&eacute;.';
$lang_new[$module_name]['MESSAGE_REVIEW_VALIDATED'] = 'La critique a &eacute;t&eacute; valid&eacute;e avec succ&egrave;s et sauvegard&eacute;e dans la base de donn&eacute;es!';
$lang_new[$module_name]['MODIFY'] = 'Modifier';
$lang_new[$module_name]['MODIFY_REVIEW_REQUEST'] = 'Requ&ecirc;te de modification de critique';
$lang_new[$module_name]['MOST_POPULAR'] = 'Plus Populaire';
$lang_new[$module_name]['NAME'] = 'Nom';
$lang_new[$module_name]['NEW_LAST30DAY'] = 'Nouvelle des 30 derniers jours';
$lang_new[$module_name]['NEW_LAST3DAY'] = 'Nouvelle des 3 derniers jours';
$lang_new[$module_name]['NEW_LASTWEEK'] = 'Nouvelle de la semaine derni&egrave;re';
$lang_new[$module_name]['NEW_THISWEEK'] = 'Nouvelle de cette semaine';
$lang_new[$module_name]['NEW_TODAY'] = 'Nouvelle d\'aujourd\'hui';
$lang_new[$module_name]['NEW_TOTAL'] = 'Total des nouvelles critiques';
$lang_new[$module_name]['NEW_TOTAL_FORLAST'] = 'Total des nouvelles critiques pour le dernier';
$lang_new[$module_name]['NONE'] = 'Aucun';
$lang_new[$module_name]['NOTE'] = 'Note';
$lang_new[$module_name]['OF'] = 'de';
$lang_new[$module_name]['OK'] = 'OK';
$lang_new[$module_name]['ORIGINAL'] = 'original';
$lang_new[$module_name]['PAGE'] = 'Page';
$lang_new[$module_name]['PAGE_NEXT'] = 'Page suivante';
$lang_new[$module_name]['PAGE_NONEXT'] = 'Pas de page suivante';
$lang_new[$module_name]['PAGE_NOPREVIOUS'] = 'Pas de page pr&eacute;c&egrave;dante';
$lang_new[$module_name]['PAGE_PREVIOUS'] = 'Page pr&eacute;c&egrave;dante';
$lang_new[$module_name]['PICSIZE'] = 'La taille maximum de l\'image doit &ecirc;tre : ';
$lang_new[$module_name]['PICSIZE_HEIGHT'] = 'hauteur';
$lang_new[$module_name]['PICSIZE_WIDTH'] = 'largeur';
$lang_new[$module_name]['POPULAR'] = 'Populaire';
$lang_new[$module_name]['PROMOTE_RATING_BUTTON_REVIEW'] = 'Bouton Critique';
$lang_new[$module_name]['PROMOTE_RATING_FORM'] = 'Formulaire d\'&eacute;valuation &agrave; distance';
$lang_new[$module_name]['PROMOTE_RATING_ID_REFERER'] = 'dans le source HTML l\'ID de r&eacute;f&eacute;rence de votre site est '.EVO_SERVER_SITENAME.' dans la base de donn&eacute;es. Assurez-vous que ce nombre soit pr&eacute;sent.';
$lang_new[$module_name]['PROMOTE_RATING_TEXT_REVIEW'] = 'Texte de la critique';
$lang_new[$module_name]['PROMOTE_RATING_THE_NUMBER'] = 'le nombre';
$lang_new[$module_name]['PROMOTE_YOUR_WEBSITE'] = 'Promouvoir votre site web';
$lang_new[$module_name]['RATED_BEST'] = 'Mieux not&eacute;';
$lang_new[$module_name]['RATED_BEST_HEADER'] = 'Critiques les mieux not&eacute;es - Top';
$lang_new[$module_name]['RATED_NUMBERS'] = 'Nombre d\'&eacute;valuation de la crit';
$lang_new[$module_name]['RATED_TOTAL'] = 'Total des critiques &eacute;valu&eacute;es';
$lang_new[$module_name]['RATED_USER_AVERAGE'] = 'Note moyenne des utilisateurs';
$lang_new[$module_name]['RATING'] = 'Note';
$lang_new[$module_name]['RATING_BREAKDOWN_VALUES'] = 'D&eacute;coupage des &eacute;valuations par valeur';
$lang_new[$module_name]['RATING_DETAILS'] = 'D&eacute;tails des &eacute;valuation';
$lang_new[$module_name]['RATING_NUMBERS'] = 'Nombre de vote';
$lang_new[$module_name]['RATING_OVERALL'] = 'Evaluation g&eacute;n&eacute;rale';
$lang_new[$module_name]['RATING_REVIEW'] = 'Evaluation des critiques';
$lang_new[$module_name]['RATING_REVIEW_HIGHEST'] = 'Meilleure &eacute;valuation';
$lang_new[$module_name]['RATING_REVIEW_LOWEST'] = 'Moins bonne &eacute;valuation';
$lang_new[$module_name]['RATING_WEIGHT_NOTE'] = '* Note: Cette valeur pond&egrave;re l\'&eacute;valuation entre utilisateur enregistr&eacute; et non enregistr&eacute;';
$lang_new[$module_name]['RATING_WEIGHT_OUTNOTE'] = '* Note: Cette valeur pond&egrave;re l\'&eacute;valuation entre utilisateur enregistr&eacute; et les votants ext&eacute;rieurs';
$lang_new[$module_name]['REPORT_BROKEN'] = 'Signaler une critique bri&eacute;e';
$lang_new[$module_name]['REVIEW'] = 'Critique';
$lang_new[$module_name]['REVIEWS'] = 'Critiques';
$lang_new[$module_name]['REVIEWS_IN_DB'] = 'Critiques dans notre base de donn&eacute;es.';
$lang_new[$module_name]['REVIEWS_NEW'] = 'Nouvelles critiques';
$lang_new[$module_name]['REVIEWS_SIGNATURE'] = 'L\'&eacute;quipe';
$lang_new[$module_name]['REVIEW_BODY'] = 'Corps';
$lang_new[$module_name]['REVIEW_FOOTER'] = 'Pied de page';
$lang_new[$module_name]['REVIEW_HEADER'] = 'En-t&ecirc;te';
$lang_new[$module_name]['REVIEW_ID'] = 'ID de la critique';
$lang_new[$module_name]['REVIEW_IMAGE'] = 'Image';
$lang_new[$module_name]['REVIEW_IMAGE_URL'] = 'URL de l\'image';
$lang_new[$module_name]['REVIEW_OWNER'] = 'Propri&eacute;taire de la critique';
$lang_new[$module_name]['REVIEW_PAGETITLE'] = 'Titre de page';
$lang_new[$module_name]['REVIEW_PROFILE'] = 'Critique Profil';
$lang_new[$module_name]['REVIEW_REQUEST_SUBMITTER'] = 'Requ&ecirc;te soumise par';
$lang_new[$module_name]['REVIEW_SIGNATURE'] = 'Signature';
$lang_new[$module_name]['REVIEW_SUBMIT'] = 'Soumettre une nouvelle critique';
$lang_new[$module_name]['REVIEW_SUBMITTER'] = 'Soumetteur de la critique';
$lang_new[$module_name]['REVIEW_SUBMIT_DATE'] = 'Critique soumise le';
$lang_new[$module_name]['REVIEW_URL'] = 'URL de la critique';
$lang_new[$module_name]['REVIEW_VALIDATE_DATE'] = 'Critique valid&eacute;e le';
$lang_new[$module_name]['SCROLL_DOWN'] = 'Vers le bas';
$lang_new[$module_name]['SCROLL_UP'] = 'Vers le haut';
$lang_new[$module_name]['SEARCH_RESULTS_CATEGORIES'] = 'Trouver dans les cat&eacute;gories';
$lang_new[$module_name]['SEARCH_RESULTS_HEADER'] = 'R&eacute;sultats de recherche pour votre demande:';
$lang_new[$module_name]['SEARCH_RESULTS_NO_MATCH'] = 'D&eacute;sol&eacute;, nous n\'avons rien trouv&eacute; pour votre recherche dans notre base de donn&eacute;es';
$lang_new[$module_name]['SEARCH_RESULTS_OTHER_ENGINES'] = 'dans un autre moteur de recherche';
$lang_new[$module_name]['SEARCH_RESULTS_REVIEWS'] = 'Trouver dans les critiques';
$lang_new[$module_name]['SEARCH_RESULTS_TRYSEARCH'] = 'Essayez de rechercher';
$lang_new[$module_name]['SHOW'] = 'Voir';
$lang_new[$module_name]['SHOW_EDITORIAL'] = 'Voir l\'&eacute;ditoriale';
$lang_new[$module_name]['SHOW_MOSTPOPULAR'] = 'Voir plus de critiques populaires';
$lang_new[$module_name]['SHOW_NEWSREVIEWS'] = 'Voir les nouvelles critiques';
$lang_new[$module_name]['SHOW_REVIEW_COMMENTS'] = 'Voir les commentaires de la critique';
$lang_new[$module_name]['SHOW_TOPRATED'] = 'Voir les mieux not&eacute;es des critiques';
$lang_new[$module_name]['SORTS_BY'] = 'Trier les critiques par';
$lang_new[$module_name]['SORTS_DATE_DOWN'] = 'Date (Nouvelles critiques affich&eacute;es en premier)';
$lang_new[$module_name]['SORTS_DATE_UP'] = 'Date (Anciennes critiques affich&eacute;es en premier)';
$lang_new[$module_name]['SORTS_IS'] = 'Les critique sont actuellement trier par';
$lang_new[$module_name]['SORTS_POPULARITY_DOWN'] = 'Popularit&eacute;e (Plus au moins vue)';
$lang_new[$module_name]['SORTS_POPULARITY_UP'] = 'Popularit&eacute;e (Moins au plus vue)';
$lang_new[$module_name]['SORTS_RATING_DOWN'] = 'Evaluation (Mieux au moins bien not&eacute;)';
$lang_new[$module_name]['SORTS_RATING_UP'] = 'Evaluation (Moins au mieux not&eacute;)';
$lang_new[$module_name]['SORTS_TITLEAZ'] = 'Titre (A &agrave; Z)';
$lang_new[$module_name]['SORTS_TITLEZA'] = 'Titre (Z &agrave; A)';
$lang_new[$module_name]['SUBMIT_ACCEPT'] = 'Accepter';
$lang_new[$module_name]['SUBMIT_ADD'] = 'Ajouter';
$lang_new[$module_name]['SUBMIT_BACK_CATEGORY'] = 'Retour &agrave; la Cat&eacute;gorie';
$lang_new[$module_name]['SUBMIT_DELETE'] = 'Effacer';
$lang_new[$module_name]['SUBMIT_DOIT'] = 'Faites-le';
$lang_new[$module_name]['SUBMIT_GOBACK'] = _GOBACK;
$lang_new[$module_name]['SUBMIT_MODIFY'] = 'Modifier';
$lang_new[$module_name]['SUBMIT_MODIFY_REQUEST'] = 'Soumettre une requ&ecirc;te de modification';
$lang_new[$module_name]['SUBMIT_RETURN'] = 'Retourner';
$lang_new[$module_name]['SUBMIT_SAVE'] = 'Sauvegarder';
$lang_new[$module_name]['SUBMIT_VOTE'] = 'Voter !';
$lang_new[$module_name]['THERE_ARE'] = 'Il y a ';
$lang_new[$module_name]['TITLE'] = 'Titre';
$lang_new[$module_name]['TO'] = 'De';
$lang_new[$module_name]['TOTAL'] = 'Total';
$lang_new[$module_name]['TOTAL_REVIEWS'] = 'Total de critiques';
$lang_new[$module_name]['UP'] = 'Haut';
$lang_new[$module_name]['USER'] = 'Utilisateur';
$lang_new[$module_name]['USER_REGISTERED'] = 'Utilisateur enregistr&eacute;';
$lang_new[$module_name]['USER_REGISTERED_NOT'] = 'Utilisateur non-enregistr&eacute;';
$lang_new[$module_name]['VISIT'] = 'Voir';
$lang_new[$module_name]['VOTE'] = 'Vote';
$lang_new[$module_name]['VOTERS_OUTSIDE'] = 'Votants ext&eacute;rieur';
$lang_new[$module_name]['VOTERS_UNREGISTERED'] = 'Utilisateur non-enregistr&eacute; (Votants)';
$lang_new[$module_name]['VOTES'] = 'Votes';
$lang_new[$module_name]['VOTES_OUTSIDE_NONE'] = 'Pas de votes ext&eacute;rieur';
$lang_new[$module_name]['VOTES_REGISTERED_NONE'] = 'Pas de votes d\'utilisateur enregistr&eacute;';
$lang_new[$module_name]['VOTES_TOTAL'] = 'Total Votes';
$lang_new[$module_name]['VOTES_UNREGISTERED_NONE'] = 'Pas de votes d\'utilisateur non-enregistr&eacute;';
$lang_new[$module_name]['VOTE_MINIMUM'] = 'minimum votes requis';
$lang_new[$module_name]['WARN_CAT_DELETE'] = '<span style="color:red">ATTENTION: Etes-vous s&ucirc;r de vouloir supprimer cette cat&eacute;gorie? <br />Vous allez aussi supprimer toutes les sous-cat&eacute;gories et les commentaires li&eacute;s!</span>';
$lang_new[$module_name]['WARN_CAT_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas de cat&eacute;gorie &agrave; effacer/modifier/&eacute;diter/transf&egrave;rer</span>';
$lang_new[$module_name]['WARN_COMMENT_DELETE_ALL'] = '<span style="color:red">ATTENTION<br />Ceci supprimera <em>Tous</em> les commentaires pour <em>chaque</em> critique.<br />Pour effacer les commentaires d\'une critique particuli&egrave;re, s&eacute;lectionnez <em>'. $lang_new[$module_name]['ADMIN_MODIFY_REVIEW'] .'</em> depuis le menu admin</span>';
$lang_new[$module_name]['WARN_COMMENT_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas de commentaire &agrave; effacer/modifier/&eacute;diter/valider</span>';
$lang_new[$module_name]['WARN_EDITORIAL_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas d\'&eacute;ditoriale &agrave; effacer/modifier/&eacute;diter/valider</span>';
$lang_new[$module_name]['WARN_RATE_COMPLETED_TOSHORT'] = '<span style="color:red">Vous avez d&eacute;j&agrave; vot&eacute; pour cette critique dans les  '.$anonwaitdays.' dernier jour(s).</span>';
$lang_new[$module_name]['WARN_RATE_NOT_SELF'] = '<span style="color:red">Vous ne pouvez pas voter pour une critique que vous avez soumis.<br />Tous les votes sont enregistr&eacute;s et examin&eacute;s</span>';
$lang_new[$module_name]['WARN_RATE_NO_SELECTED'] = '<span style="color:red">Pas d\'&eacute;valuation &eacute;lectionn&eacute;s - pas de vote comptabilis&eacute;s.</span>';
$lang_new[$module_name]['WARN_RATE_ONLY_ONCE'] = '<span style="color:red">Vous pouvez voter qu\'une seule fois pour une ressource.<br />Tous les votes sont enregistr&eacute;s et examin&eacute;s</span>';
$lang_new[$module_name]['WARN_RATE_OUTSIDE_TOSHORT'] = '<span style="color:red">Un seul vote par adresse IP est autoris&eacute; tous les '.$outsidewaitdays.' jour(s).</span>';
$lang_new[$module_name]['WARN_RECORDED'] = '<span style="color:red">Votre nom d\'utilisateur et adresse IP est enregistr&eacute;e, donc merci de ne pas abuser du syst&egrave;me</span>';
$lang_new[$module_name]['WARN_REVIEW_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas de critique &agrave; effacer/modifier/&eacute;diter/valider</span>';
$lang_new[$module_name]['WARN_VOTE_NOT_FOUND'] = '<span style="color:red">Il n\'y a pas de vote &agrave; effacer/modifier/&eacute;diter/valider</span>';
$lang_new[$module_name]['WEEKS_1'] = '1 semaines';
$lang_new[$module_name]['WEEKS_2'] = '2 semaines';
$lang_new[$module_name]['WELCOME_USERNAME'] = "Salut ".UsernameColor($userinfo['username']).", ";

?>