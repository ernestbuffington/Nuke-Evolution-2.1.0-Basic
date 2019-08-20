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

$lang_admin['INDEX']['ADMIN_LOG'] = 'Traqueur de s&eacute;curit&eacute;';
$lang_admin['INDEX']['ADMIN_LOG_ACK'] = 'Effacer';
$lang_admin['INDEX']['ADMIN_LOG_CHECKED'] = 'La version a &eacute;t&eacute; contr&ocirc;l&eacute;e le';
$lang_admin['INDEX']['ADMIN_LOG_CHG'] = '<strong>Votre Admin Trackeur log <strong>a</strong> chang&eacute;</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERR'] = '<strong>Il y avait un probl&egrave;me de contr&ocirc;le de votre journal.</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRCHMOD'] = '<strong>Votre fichier n\'est pas accessible en &eacute;criture. Avez-vous fait le CHMOD</strong>';
$lang_admin['INDEX']['ADMIN_LOG_ERRFND'] = 'Le journal n\'a pas pu &ecirc;tre trouv&eacute;';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN1'] = 'Le traqueur de s&eacute;curit&eacute; a cr&eacute;e les logs suivant :';
$lang_admin['INDEX']['ADMIN_LOG_EXPLAIN2'] = '<ul><li>Cr&eacute;ation d\'un compte administrateur</li><li>Echec de la connexion admin</li><li>Alerte q\'intrusion
</li><li>MySQL erreurs</li></ul>';
$lang_admin['INDEX']['ADMIN_LOG_FINE'] = 'Votre traqueur de s&eacute;curit&eacute; n\'a pas chang&eacute;';
$lang_admin['INDEX']['ADMIN_LOG_TITLE'] = 'Traqueur de s&eacute;curit&eacute;';
$lang_admin['INDEX']['ADMIN_LOG_VIEW'] = 'Voir Log';

$lang_admin['INDEX']['ERROR_ERR_OPEN'] = 'Impossible d\'ouvrir error.log';
$lang_admin['INDEX']['ERROR_LOG_CHG'] = '<strong>Votre log erreur <strong>&agrave;</strong> chang&eacute;</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERR'] = '<strong>Il y avait un probl&egrave;me de contr&ocirc;le de votre journal.</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRCHMOD'] = '<strong>Votre fichier n\'est pas accessible en &eacute;criture. Avez-vous fait le CHMOD?</strong>';
$lang_admin['INDEX']['ERROR_LOG_ERRFND'] = 'Le journal n\'a pas pu &ecirc;tre trouv&eacute;';
$lang_admin['INDEX']['ERROR_LOG_FINE'] = 'Votre log d\'erreur n\'a pas chang&eacute;';
$lang_admin['INDEX']['ERROR_LOG_TITLE'] = 'Erreur Logger';

$lang_admin['INDEX']['SECURITY_ADMIN_IP_LOCK'] = 'Admin IP Lock';
$lang_admin['INDEX']['SECURITY_SEC_OFF'] = 'D&eacute;sactiv&eacute;';
$lang_admin['INDEX']['SECURITY_SEC_ON'] = 'Activer';
$lang_admin['INDEX']['SECURITY_SEC_STATUS'] = 'Security Status';
$lang_admin['INDEX']['SECURITY_SENTINEL'] = 'NukeSentinel(tm)';

$lang_admin['INDEX']['TRACKER_BACK'] = 'Retour';
$lang_admin['INDEX']['TRACKER_CLEAR'] = 'Effacer Log';
$lang_admin['INDEX']['TRACKER_CLEARED'] = 'Votre Security Tracker a &eacute;t&eacute; effac&eacute;!';
$lang_admin['INDEX']['TRACKER_ERR_OPEN'] = 'Impossible d\'ouvrir admin.log';
$lang_admin['INDEX']['TRACKER_ERR_UP'] = 'Impossible de mettre &agrave; jour';
$lang_admin['INDEX']['TRACKER_HEAD_DATE'] = 'Date';
$lang_admin['INDEX']['TRACKER_HEAD_IP'] = 'IP';
$lang_admin['INDEX']['TRACKER_HEAD_MSG'] = 'Message';
$lang_admin['INDEX']['TRACKER_HEAD_TIME'] = 'Heure';
$lang_admin['INDEX']['TRACKER_UP'] = 'Mise &agrave; Jour';

$lang_admin['INDEX']['VERSIONCTL_TITLE'] = 'Evo-Cms Version Checker';

?>