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
    die('Vous n\'avez pas acc&egrave;s &agrave; ce fichier directement...');
}

global $adminpoint;

$lang_admin[$adminpoint]['BUTTON_ADMIN_ADD'] = 'Cr&eacute;er un administrateur';
$lang_admin[$adminpoint]['BUTTON_ADMIN_CHANGE'] = 'Changer l\'administrateur';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DELETE'] = 'Effacer l\'administrateur';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DOIT'] = 'OK';
$lang_admin[$adminpoint]['BUTTON_USER_PROMOTE'] = 'Promouvoir l\'tilisateur';

$lang_admin[$adminpoint]['ERROR_ADMIN_WRONGAID'] = 'Il semble qu\'une erreur s\'est produite. S\'il vous pla&icirc,t essayez &agrave; nouveau.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_EMPTY'] = 'Ce champ"'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" ne peut &ecirc;tre vide';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_INVALID'] = 'Ce champ"'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" n\'est pas une adresse valide.(sp&eacute;cial charact&egrave;res, espace a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_LANGUAGE'] = 'Il semble qu\'une erreur s\'est produite. Nous ne pouvons trouver le langage dans votre syst&egrave;me.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_AND_SUPER_EMPTY'] = 'Aucun droit de permis - ni comme superadmin ni comme Moduleadmin';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_NOTEXIST'] = 'Un ou plusieurs d\'autres modules, les droits devraient &ecirc;tre autoris&eacute;es, ne sont pas disponibles dans notre base de donn&eacute;es.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_BADWORD'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" contient des mots qui ne sont pas autoris&eacute;. Voici le contenu &agrave; modifi&eacute;';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EMPTY'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" n\'est pas autoris&eacute; &agrave; &ecirc;tre vide';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EXISTS'] = 'Il existe un administrateur ou un utilisateur avec ce nom';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_GOD_CHANGE'] = 'Le nom de l\'admin dieu n\'est pas autoris&eacute; &agrave; &ecirc;tre chang&eacute;';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_INVALID'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" ne correspond pas &agrave; la sp&eacute;cification d\'un nom correct dans le syst&egrave;me.(sp&eacute;cial charact&egrave;res, espace a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_SIZE'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" est de %s charact&egrave;res de long et donc n\'est pas compris entre 3 ou 30 caract&egrave;res. S\'il vous pla&icirc;t noter que certains caract&egrave;res multi-octets sont stock&eacute;s.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD2_EMPTY'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'].'" n\'est pas autoris&eacute; &agrave; &ecirc;tre vide';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_EMPTY'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'].'" n\'est pas autoris&eacute; &agrave; &ecirc;tre vide';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_NOT_MATCH'] = 'Les mots de passe ne correspondent pas';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_EMPTY'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" n\'est pas autoris&eacute; &agrave; &ecirc;tre vide';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_INVALID'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" ne correspond pas &agrave; la sp&eacute;cification d\'une URL correct dans le syst&egrave;me.(sp&eacute;cial charact&egrave;res, espace a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_BADWORD'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" contains not allowed words. Here the changed content';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EMPTY'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" n\'est pas autoris&eacute; &agrave; &ecirc;tre vide';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EXISTS'] = 'Il existe un administrateur ou un utilisateur avec ce nom';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_INVALID'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" ne correspond pas &agrave; la sp&eacute;cification d\'un utilisateur correct dans le syst&egrave;me.(sp&eacute;cial charact&egrave;res, espace a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_NOT_EXIST'] = 'L\'utilisateur sp&eacute;cifi&eacute; n\'est pas dans la base de donn&eacute;es';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_SIZE'] = 'Ce champ "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" st de %s charact&egrave;res de long et donc n\'est pas compris entre 3 ou 30 caract&egrave;res. S\'il vous pla&icirc;t noter que certains caract&egrave;res multi-octets sont stock&eacute;s.';
$lang_admin[$adminpoint]['ERROR_DB_INSERT_ADMIN'] = 'Il semble qu\'une erreur s\'est produite durant l\'insertion de l\'Administrateur dans la bas de donn&eacute;es.';
$lang_admin[$adminpoint]['ERROR_USER_ISADMIN'] = 'L\'utilisateur s&eacute;lectionn&eacute; est d&eacute;j&agrave; promu admin';
$lang_admin[$adminpoint]['FIELDSET_PERMISSIONS'] = 'Permissions';
$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'] = 'Email';
$lang_admin[$adminpoint]['FIELD_ADMIN_LANGUAGE'] = 'Langage';
$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'] = 'Nom r&eacute;el';
$lang_admin[$adminpoint]['FIELD_ADMIN_NO'] = 'Non';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'] = 'Mot de passe';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'] = 'Confirmation du mot de passe';
$lang_admin[$adminpoint]['FIELD_ADMIN_URL'] = 'Site Web';
$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'] = 'Nom de compte';
$lang_admin[$adminpoint]['FIELD_ADMIN_YES'] = 'Oui';
$lang_admin[$adminpoint]['FIELD_NOTCHANGEABLE'] = 'Champ non modifiable';

$lang_admin[$adminpoint]['GOD_ADMIN'] = 'Admin Dieu';

$lang_admin[$adminpoint]['HEAD_BACK'] = 'Retour au Menu d\'Administration;';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINADD'] = 'Cr&eacute;er un nouveau compte d\'Administration';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINCHANGE'] = 'Changer un Administrateur';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINDELETE'] = 'Effac&eacute; un Administrateur';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINSHOW'] = 'Voir les Administrateur';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_MAIN'] = 'Liste des Administrateurs';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_PROMOTEUSER'] = 'Promouvoir un Utilisateur en Administrateur';
$lang_admin[$adminpoint]['HEAD_TITLE'] = 'Admins Administration';
$lang_admin[$adminpoint]['HELP_FIELDSET_PERMISSIONS'] = 'Ici, vous pouvez autoriser les droits sur les modules pour cet administrateur. V&eacute;rifier pour chaque Module s\'il est autoris&eacute; &agrave; l\'administrer.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_EMAIL'] = 'Email de l\'Administrateur. Tous les messages de cet Administrateur sont envoy&eacute; &agrave; cette Email.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_LANGUAGE'] = 'Comme dans les profiles utilisateurs, le langage du site est pr&eacute;vue pour cet administrateur.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_NAME'] = 'L\'entr&eacute;e est obligatoire ! Le nom de l\'administrateur est stock&eacute; pour toutes ces actions et est affich&eacute; comme un nom d\'utilisateur dans le syst&egrave;me. Il sera v&eacute;rifi&eacute; si un autre compte administrateur ou utilisateur existe avec votre saisie';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD'] = 'Le mot de passe doit &ecirc;tre compris entre 4 et 12 caract&egrave;res - pas d\'espaces ou des caract&egrave;res sp&eacute;ciaux';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD2'] = 'Pour v&eacute;rifier si dans le premier champ "Mot de passe" une erreur ne se serait produite.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_SUPERUSER'] = 'Attention! Un super-utilisateur a presque les m&ecirc;mes droits que le Admin Dieu!!! Permettre cela seulement si vous &ecirc;tre sur de vouloir le faire.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_URL'] = 'Site de l\'Administrateur. Nous voulons d&eacute;sactiver les votes d\'un administrateur pour son propre site Web ou le contenu de son site Web.)';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME'] = 'Entr&eacute;e ici est obligatoire! Le Nom de compte de l\'administrateur n\'est pas autoris&eacute; &agrave; &ecirc;tre deux fois dans le syst&egrave;me (pas comme Nom de compte Admin ni comme nom d\'utilisateur).';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME_PROMOTE'] = 'Ce champ n\'est pas modifiable, si vous faites la promotion d\'un utilisateur vers administrateur, parce que ce domaine doit &ecirc;tre un nom d\'utilisateur existant';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_PASSWORDCHANGE'] = 'Pour modifier les mots de passe, ce champ doit &ecirc;tre v&eacute;rifi&eacute;. Apr&egrave;s cela, les champs pourrons &ecirc;tre remplis';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_SUPERUSER'] = 'Si un administrateur est un super-utilisateur, aucun droits sur les modules ne doit &ecirc;tre autoris&eacute;s, parce que les super-utilisateur sont autoris&eacute;s &agrave; administrer tous les modules';

$lang_admin[$adminpoint]['INFO_ADMIN_GOD_NODELETE'] = 'L\'administrateur '.$lang_admin[$adminpoint]['GOD_ADMIN'].' ne peut &ecirc;tre effac&eacute;';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_AFTERLINK'] = 'pour obtenir de l\'aide pour la cr&eacute;ation d\'un mot de passe fort';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_BEFORELINK'] = 'Cliquer';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_CURRENTSTRENGTH'] = 'Force actuelle ';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_LINK'] = 'ici';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_MEDIUM'] = 'Moyen';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_NOTRATED'] = 'Pas encore &eacute;valu&eacute;';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONG'] = 'Fort';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGER'] = 'Plus fort';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGEST'] = 'Le plus fort';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_WEAK'] = 'Faible';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_ADDED'] = 'Le compte administrateur a &eacute;t&eacute; cr&eacute;er avec succ&egrave;s';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED'] = 'Le compte administrateur a &eacute;t&eacute; modifi&eacute; avec succ&egrave;s';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED_LOGOUT'] = 'Vous devez vous d&eacute;connecter du syst&egrave;me pour activer vos changements';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_DELETED'] = 'Le compte administrateur a &eacute;t&eacute; effac&eacute; avec succ&egrave;s';
$lang_admin[$adminpoint]['INFO_ADMIN_SUPERUSER_WARN'] = 'S\'il vous pla&icirc;t ne nous aider !!';
$lang_admin[$adminpoint]['INFO_FIELD_NOTCHANGEABLE'] = 'Champ non modifiable';

$lang_admin[$adminpoint]['MENUE_ADMIN_ADD'] = 'Cr&eacute;er un nouvelle administrateur';
$lang_admin[$adminpoint]['MENUE_ADMIN_PROMOTE'] = 'Promouvoir un utilisateur en administrateur';
$lang_admin[$adminpoint]['MENUE_ADMIN_SHOW'] = 'Voir administrateurs';

$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_CHANGE'] = 'Changer';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_DELETE'] = 'Effacer';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SELECT'] = 'Selectionner une action';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SHOW'] = 'Voir';
$lang_admin[$adminpoint]['OPTION_ADMIN_PASSWORDCHANGE'] = 'Si le mot de passe a &eacute;t&eacute; chang&eacute;';
$lang_admin[$adminpoint]['OPTION_ADMIN_SUPERUSER'] = 'Superutilisateur';
$lang_admin[$adminpoint]['OPTION_ALL_LANGS'] = 'Toutes les langages';

$lang_admin[$adminpoint]['QUEST_ADMIN_CHANGE'] = 'Changer l\'administrateur';
$lang_admin[$adminpoint]['QUEST_ADMIN_DELETE'] = 'Effacer l\'administrateur';

$lang_admin[$adminpoint]['TABLE_ADMIN_ACTION'] = 'Action';
$lang_admin[$adminpoint]['TABLE_ADMIN_EMAIL'] = 'Email';
$lang_admin[$adminpoint]['TABLE_ADMIN_LANGUAGE'] = 'Langage';
$lang_admin[$adminpoint]['TABLE_ADMIN_NAME'] = 'Nom r&eacute;el';
$lang_admin[$adminpoint]['TABLE_ADMIN_REGDATE'] = 'Date d\'enregistrement';
$lang_admin[$adminpoint]['TABLE_ADMIN_SUPERUSER'] = 'Superutilisateur';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERID'] = 'ID';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERNAME'] = 'Nom de compte';

$lang_admin[$adminpoint]['WARNING_ADMIN_DELETE'] = 'Etes-vous certain de vouloir &eacute;ffacer ce compte administrateur';

?>