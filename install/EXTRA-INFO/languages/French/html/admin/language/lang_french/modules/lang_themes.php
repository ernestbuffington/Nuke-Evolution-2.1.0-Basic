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

$lang_admin[$adminpoint]['THEMES_ACTIVATE'] = 'Activer';
$lang_admin[$adminpoint]['THEMES_ACTIVE'] = 'Actif';
$lang_admin[$adminpoint]['THEMES_ADMINS'] = 'Administrateurs';
$lang_admin[$adminpoint]['THEMES_ADV_COMP'] = 'Votre th&egrave;me est compatible avec les fonctionnalit&eacute;s avanc&eacute;es';
$lang_admin[$adminpoint]['THEMES_ADV_OPTS'] = 'Options avanc&eacute;es du th&egrave;me';
$lang_admin[$adminpoint]['THEMES_ALLOWCHANGE'] = 'Autoriser les Utilisateurs &agrave; choisir leur Th&egrave;me';
$lang_admin[$adminpoint]['THEMES_ALLUSERS'] = 'Tout les utilisateurs';
$lang_admin[$adminpoint]['THEMES_ATO_KEY'] = 'ATO Clef';

$lang_admin[$adminpoint]['THEMES_CHANGEATO'] = 'Changer les valeurs ATO';
$lang_admin[$adminpoint]['THEMES_CUSTOMN'] = 'Nom personnalis&eacute;';
$lang_admin[$adminpoint]['THEMES_CUSTOMNAME'] = 'Nom du th&egrave;me personnalis&eacute;';

$lang_admin[$adminpoint]['THEMES_DB_VALUE'] = 'Valeur active';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE'] = 'D&eacute;sactiver';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE1'] = 'Etes vous sur de vouloir d&eacute;sactiver ce th&egrave;me?';
$lang_admin[$adminpoint]['THEMES_DEACTIVATE2'] = 'Cela va r&eacute;gler TOUS les utilisateurs en utilisant ce th&egrave;me retour au th&egrave;me par d&eacute;faut!';
$lang_admin[$adminpoint]['THEMES_DEFAULT'] = 'Th&egrave;me par D&eacute;fault';
$lang_admin[$adminpoint]['THEMES_DEFAULT_MISSING'] = 'Votre th&egrave;me par d&eacute;faut est introuvable! ';
$lang_admin[$adminpoint]['THEMES_DEFAULT_NOT_FOUND'] = ' n\'a pas &eacute;t&eacute; trouv&eacute;!';
$lang_admin[$adminpoint]['THEMES_DEFAULT_VALUE'] = 'Th&egrave;mes par D&eacute;faut';
$lang_admin[$adminpoint]['THEMES_DEF_LOADED'] = 'Les options par d&eacute;faut sont charg&eacute;es en dessous';

$lang_admin[$adminpoint]['THEMES_EDIT'] = 'Editer';
$lang_admin[$adminpoint]['THEMES_ERROR'] = 'Erreur';
$lang_admin[$adminpoint]['THEMES_ERROR_CRITICAL'] = 'Erreur Critique';
$lang_admin[$adminpoint]['THEMES_ERROR_MESSAGE'] = 'Impossible de recueillir les th&egrave;mes install&eacute;s';

$lang_admin[$adminpoint]['THEMES_FROM'] = 'Du Th&egrave;me';
$lang_admin[$adminpoint]['THEMES_FUNCTIONS'] = 'Fonctions';

$lang_admin[$adminpoint]['THEMES_GROUPS'] = 'Groupes';
$lang_admin[$adminpoint]['THEMES_GROUPSONLY'] = 'Groupes Seulement';

$lang_admin[$adminpoint]['THEMES_HEADER'] = 'Evo-Cms :: Gestionnaire de Th&egrave;me ';

$lang_admin[$adminpoint]['THEMES_INACTIVE'] = 'Inactif';
$lang_admin[$adminpoint]['THEMES_INFO_CHANGEATO'] = '<em>After Installation was successfull, it is a good idea to change ATO Values in Edit Modus</em>';
$lang_admin[$adminpoint]['THEMES_INSTALL'] = 'Installer';
$lang_admin[$adminpoint]['THEMES_INSTALLED'] = 'Th&egrave;mes install&eacute;s';

$lang_admin[$adminpoint]['THEMES_MAKEDEFAULT'] = 'Mettre par D&eacute;fault';
$lang_admin[$adminpoint]['THEMES_MANG_OPTIONS'] = 'Gestionnaire de Th&egrave;me Options';
$lang_admin[$adminpoint]['THEMES_MOSTPOPULAR'] = 'Th&egrave;me le plus populaire';
$lang_admin[$adminpoint]['THEMES_MULTLANG_COMP'] = 'Votre th&egrave;me est multilangue';

$lang_admin[$adminpoint]['THEMES_NAME'] = 'Nom du Th&egrave;me';
$lang_admin[$adminpoint]['THEMES_NO'] = 'Non';
$lang_admin[$adminpoint]['THEMES_NONE'] = 'Aucun';
$lang_admin[$adminpoint]['THEMES_NOREALNAME'] = 'N/A';
$lang_admin[$adminpoint]['THEMES_NOT_COMPAT'] = '<font color=\'red\'>Votre th&egrave;me n\'est pas compatible avec les fonctionnalit&eacute;s avanc&eacute;es</font>';
$lang_admin[$adminpoint]['THEMES_NOT_MULTLANG_COMP'] = 'Votre th&egrave;me n\'est pas multilangue';
$lang_admin[$adminpoint]['THEMES_NUMTHEMES'] = 'Nombre de th&egrave;me';
$lang_admin[$adminpoint]['THEMES_NUMUNINSTALLED'] = 'Nombre de th&egrave;me d&eacute;sinstall&eacute;';
$lang_admin[$adminpoint]['THEMES_NUMUSERS'] = 'Nombre d\'utilisateurs';

$lang_admin[$adminpoint]['THEMES_OPTIONS'] = ' Options Th&egrave;me';
$lang_admin[$adminpoint]['THEMES_OPTS'] = 'Options';

$lang_admin[$adminpoint]['THEMES_PAGE_FIRST'] = 'Premier';
$lang_admin[$adminpoint]['THEMES_PAGE_LAST'] = 'Suivant';
$lang_admin[$adminpoint]['THEMES_PAGE_NEXT'] = 'Pr&eacute;c&egrave;dent';
$lang_admin[$adminpoint]['THEMES_PAGE_OF'] = '&agrave;';
$lang_admin[$adminpoint]['THEMES_PAGE_OF_TOTAL'] = 'de';
$lang_admin[$adminpoint]['THEMES_PAGE_PREVIOUS'] = 'Visualiser';
$lang_admin[$adminpoint]['THEMES_PERMISSIONS'] = 'Permissions';
$lang_admin[$adminpoint]['THEMES_PREVIEW'] = 'Visualiser';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES'] = 'Qui est autoris&eacute; ?';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS'] = 'Quelle groupes';
$lang_admin[$adminpoint]['THEMES_PRIVILEGES_GROUPS_INFO'] = 'View must be SET to Groups Only';
$lang_admin[$adminpoint]['THEMES_PROBLEM'] = 'There seems to be a problem with your theme, please make sure you have a valid theme';

$lang_admin[$adminpoint]['THEMES_QINSTALL'] = 'Installation Rapide';
$lang_admin[$adminpoint]['THEMES_QUNINSTALLED'] = 'D&eacute;sinstaller';

$lang_admin[$adminpoint]['THEMES_REALNAME'] = 'Nom r&eacute;el';
$lang_admin[$adminpoint]['THEMES_REST_DEF'] = 'Restaurer par D&eacute;fault';
$lang_admin[$adminpoint]['THEMES_RETURN'] = 'Retour au Gestonnaire de Th&egrave;me';
$lang_admin[$adminpoint]['THEMES_RETURNMAIN'] = 'Retour au Menu Principale d\'Administration';
$lang_admin[$adminpoint]['THEMES_RETURN_OPTIONS'] = 'Retour aux Options du Th&egrave;me';

$lang_admin[$adminpoint]['THEMES_SAVECHANGES'] = 'Sauvegarder les changement';
$lang_admin[$adminpoint]['THEMES_SETTINGS_UPDATED'] = 'R&eacute;glages mis &agrave; jour!';
$lang_admin[$adminpoint]['THEMES_STATUS'] = 'Status';
$lang_admin[$adminpoint]['THEMES_SUBMIT'] = 'Soumettre';

$lang_admin[$adminpoint]['THEMES_TEXT_AREA'] = 'Zone de Text';
$lang_admin[$adminpoint]['THEMES_THEMES'] = 'Th&egrave;mes';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATE'] = 'Th&egrave;me d&eacute;sactiver';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED'] = 'Th&egrave;me d&eacute;sactiver avec succ&egrave;s!';
$lang_admin[$adminpoint]['THEMES_THEME_DEACTIVATED_FAILED'] = 'D&eacute;sactivation du Th&egrave;me &agrave; &eacute;chou&eacute;e!';
$lang_admin[$adminpoint]['THEMES_THEME_INSTALLED'] = 'Th&egrave;me Installer!';
$lang_admin[$adminpoint]['THEMES_THEME_INSTALLED_FAILED'] = 'Impossible d\'installer le Th&egrave;me!';
$lang_admin[$adminpoint]['THEMES_THEME_MISSING'] = 'Th&egrave;me Manquant!';
$lang_admin[$adminpoint]['THEMES_THEME_TRANSFER'] = 'Th&egrave;me de Transfert';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALL'] = 'D&eacute;sintaller le Th&egrave;me';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED'] = 'Th&egrave;me d&eacute;sintaller avec succ&egrave;s';
$lang_admin[$adminpoint]['THEMES_THEME_UNINSTALLED_FAILED'] = 'D&eacute;sintallation du Th&egrave;me &agrave; &eacute;chou&eacute;e!';
$lang_admin[$adminpoint]['THEMES_TO'] = 'Pour le th&egrave;me';
$lang_admin[$adminpoint]['THEMES_TRANSFER'] = 'Th&egrave;me de transfert pour l\'utilisateur';
$lang_admin[$adminpoint]['THEMES_TRANSFER_UPDATED'] = 'utilisateur(s) ont &eacute;t&eacute; mis &agrave; jour!';

$lang_admin[$adminpoint]['THEMES_UNINSTALL'] = 'D&eacute;sintaller';
$lang_admin[$adminpoint]['THEMES_UNINSTALL1'] = 'Etes-vous sur de vouloir d&eacute;sintaller ce th&egrave;me ?';
$lang_admin[$adminpoint]['THEMES_UNINSTALL2'] = 'Vous perdrez tous vos param&egrave;tres pour ce th&egrave;me!';
$lang_admin[$adminpoint]['THEMES_UNINSTALL3'] = 'Cela va r&eacute;gler TOUS les utilisateurs en utilisant ce th&egrave;me Retour au th&egrave;me par d&eacute;faut!';
$lang_admin[$adminpoint]['THEMES_UNINSTALLED'] = 'Th&egrave;mes d&eacute;sinstaller';
$lang_admin[$adminpoint]['THEMES_UPDATED'] = 'Th&egrave;me mis &agrave; jour!';
$lang_admin[$adminpoint]['THEMES_UPDATEFAILED'] = 'Mise &agrave; jour du Th&egrave;me &agrave; &eacute;chou&eacute;e!';
$lang_admin[$adminpoint]['THEMES_USEREMAIL'] = 'E-Mail';
$lang_admin[$adminpoint]['THEMES_USERID'] = 'Utilisateur ID';
$lang_admin[$adminpoint]['THEMES_USERNAME'] = 'Nom de l\'utilisateur';
$lang_admin[$adminpoint]['THEMES_USERTHEME'] = 'Th&egrave;me';
$lang_admin[$adminpoint]['THEMES_USER_MODIFY'] = 'Modifier Th&egrave;me';
$lang_admin[$adminpoint]['THEMES_USER_OPTIONS'] = 'Options utilisateur';
$lang_admin[$adminpoint]['THEMES_USER_RESET'] = 'Remettre par d&eacute;faut';
$lang_admin[$adminpoint]['THEMES_USER_SELECT'] = 'S&eacute;lectionner un th&egrave; pour l\'utilisateur';

$lang_admin[$adminpoint]['THEMES_VIEW'] = 'Voir';
$lang_admin[$adminpoint]['THEMES_VIEW_STATS'] = 'Voir Statistique';

$lang_admin[$adminpoint]['THEMES_YES'] = 'Oui';

?>