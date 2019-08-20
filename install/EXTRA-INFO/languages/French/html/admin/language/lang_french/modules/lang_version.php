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

$lang_admin[$adminpoint]['VERSIONCTL_BACK'] = 'Retour';

$lang_admin[$adminpoint]['VERSIONCTL_CHECKVER'] = 'Cliquer ici pour v&eacute;rifier votre version';
$lang_admin[$adminpoint]['VERSIONCTL_CHG'] = 'Il y a une nouvelle version de Evo-Cms';
$lang_admin[$adminpoint]['VERSIONCTL_CHGLOG'] = 'Evo-Cms Version Changement';
$lang_admin[$adminpoint]['VERSIONCTL_CUR'] = 'Votre version est &agrave; jour';

$lang_admin[$adminpoint]['VERSIONCTL_Download'] = 'T&eacute;l&eacute;charger';

$lang_admin[$adminpoint]['VERSIONCTL_ERRCON'] = 'Impossible de se connecter &agrave; www.nuke-evolution.com';
$lang_admin[$adminpoint]['VERSIONCTL_ERRSQL'] = 'Impossible de r&eacute;cup&eacute;rer la version de la Base de Donn&eacute;es';
$lang_admin[$adminpoint]['VERSIONCTL_ERR_CHG'] = 'Il y a un probl&egrave;me pour acc&eacute;der au log des changements';
$lang_admin[$adminpoint]['VERSIONCTL_ERR_CON'] = 'Impossible de se connecter &agrave; <a href="http://www.evo-german.com">Evo-Cms</a>';

$lang_admin[$adminpoint]['VERSIONCTL_TITLE'] = 'Evo-Cms Version Contr&ocirc;leur';
$lang_admin[$adminpoint]['VERSIONCTL_TITLE'] = 'Evo-Cms Version';

$lang_admin[$adminpoint]['VERSIONCTL_VER'] = 'La version actuelle est:';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONCURRENTINFO'] = 'Vous ex&eacute;cutez <strong>Evo-Cms %s</strong>.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONFUNCTIONSDISABLED'] = 'Incapable d\'utiliser la fonction socket.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONLATESTINFO'] = 'La derni&egrave;re version disponible est <strong>Evo-Cms %s</strong>.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONOUTOFDATE'] = 'Votre installation <strong>ne</strong> semble pas &ecirc;tre &agrave; jour. Des mises &agrave; jour sont disponibles pour votre version de Evo-Cms, Merci de visiter <a href="http://www.nuke-evolution.com/modules.php?name=Downloads" target="blank">http://www.nuke-evolution.com/modules.php?name=Downloads</a> pour obtenir les derni&egrave;res version.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONSOCKETERROR'] = 'Impossible d\'ouvrir une connection au Serveur Evo-Cms, l\'erreur report&eacutee; est:<br />%s';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONUP2DATE'] = 'Votre installation est &agrave; jour, aucune mise &agrave; jour sont disponibles pour votre version de Evo-Cms.';
$lang_admin[$adminpoint]['VERSIONCTL_VIEW'] = 'Voir la nouvelle Version';
$lang_admin[$adminpoint]['VERSIONCTL_YOURVER'] = 'Votre version est:';

?>