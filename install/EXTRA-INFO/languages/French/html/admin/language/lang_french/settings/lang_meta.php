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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'META Tags';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Administration des Meta Tags';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'META Tags Options';

$lang_admin[$settingspoint]['FIELD_META'] = 'META Tag';
$lang_admin[$settingspoint]['FIELD_META_RESOURCE-TYPE'] = 'Ressource-Type';
$lang_admin[$settingspoint]['FIELD_META_DISTRIBUTION'] = 'Distribution';
$lang_admin[$settingspoint]['FIELD_META_AUTHOR'] = 'G&eacute;n&eacute;ralement le nom non qualifi&eacute; de l\'auteur.';
$lang_admin[$settingspoint]['FIELD_META_COPYRIGHT'] = 'G&eacute;n&eacute;ralement une d&eacute;claration du droit d\'auteur sans r&eacute;serve.';
$lang_admin[$settingspoint]['FIELD_META_KEYWORDS'] = 'Mots-cl&eacute;s utilis&eacute;s par les moteurs de recherche indexent votre document, en plus de mots du titre et le corps du document. G&eacute;n&eacute;ralement utilis&eacute; pour les synonymes et les suppl&eacute;ants des mots du titre. Chaque mot doit &ecirc;tre s&eacute;par&eacute; par des virgules.';
$lang_admin[$settingspoint]['FIELD_META_DESCRIPTION'] = 'Une courte description en langage clair du document. Utilis&eacute; par les moteurs de recherche pour d&eacute;crire votre document.';
$lang_admin[$settingspoint]['FIELD_META_ROBOTS'] = 'Contr&ocirc;le des robots Web<br />index,nofollow = emp&ecirc;che quelque chose sur la page d\'&ecirc;tre index&eacute;e<br />noindex,follow = robots peuvent traverser cette page, mais pas l\'indexer<br />index,follow = toute la page est index&eacute;e et les liens sont suivis';
$lang_admin[$settingspoint]['FIELD_META_REVISIT-AFTER'] = 'C\'est une &eacute;tiquette tr&egrave;s importante car elle indique au moteur de recherche la fr&eacute;quence autoris&eacute;e de visite &agrave; votre page. En raison de l\'abus par les moteur de recherche spammeurs, notamment cette balise est g&eacute;n&eacute;ralement ignor&eacute; par les moteurs de recherche.';
$lang_admin[$settingspoint]['FIELD_META_RATING'] = 'Utilis&eacute; pour indiquer le status du site.<br />General = contenu public pour tous les utilisateurss<br />Mature = [ne sait pas]<br />Restricted = contenu X <br />14 years = un contenu adapt&eacute; pour les utilisateurs plus de 14 ans';
$lang_admin[$settingspoint]['FIELD_META_TITLE'] = 'Titre de la page Web. Utilisez env. 10 mots qui seront vos mots cl&eacute;s principaux. Les moteurs de recherche utilisant la balise de titre comme la balise mot-cl&eacute;. Gardez l\'accent sur deux ou quatre mots-cl&eacute;s.';
$lang_admin[$settingspoint]['FIELD_META_DATE'] = 'Date d\'expiration du document. Essentiellement, cela fera un document qui sera recharg&eacute; &agrave; partir du site Web apr&egrave;s la date. Mettre une date dans le pass&eacute; pour d&eacute;sactiver le cache du document. Exemple: 2009-12-15T08:49:37+02:00';
$lang_admin[$settingspoint]['FIELD_META_AUDIENCE'] = 'Ici, vous pouvez sp&eacute;cifi&eacute; l\'audience de votre site web par exemple \'Tout le monde\', \'Experts\', \'Femme\', \'Homme\' ou similaire.';
$lang_admin[$settingspoint]['FIELD_META_ABSTRACT'] = 'Donne un bref r&eacute;sum&eacute; de la description. Le R&eacute;sum&eacute; Meta est utilis&eacute;e principalement avec des documents universitaires. Le contenu de cette balise est g&eacute;n&eacute;ralement de 10 mots ou moins.';
$lang_admin[$settingspoint]['FIELD_META_PAGE-TYPE'] = 'Type de la page, utilis&eacute; par certains moteurs de recherche. Pas toutes les pages besoin de cela.';
$lang_admin[$settingspoint]['FIELD_META_PAGE-TOPIC'] = 'Sujet de la page, utilis&eacute; par certains moteurs de recherche. Pas toutes les pages besoin de cela.';
$lang_admin[$settingspoint]['FIELD_META_PUBLISHER'] = 'La balise Meta Editeur est utilis&eacute; pour d&eacute;clarer le nom et le num&eacute;ro de version de l\'outil de publication utilis&eacute; pour cr&eacute;er la page. La balise Meta Editeur est la m&ecirc;me que la balise META Generator.';

$lang_admin[$settingspoint]['CHECK_NAME_EXISTS'] = 'META Tag existe - utiliser un autre nom';
$lang_admin[$settingspoint]['CHECK_NOT_VALID'] = 'Entrer invalide';
$lang_admin[$settingspoint]['CHECK_INSERT_FAILED'] = 'Insertion dans la base de donn&eacute;es a &eacute;chou&eacute;';

$lang_admin[$settingspoint]['IMG_DELETE_TITLE'] = 'Effacer META Tag';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ de saisie valide pour '.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>