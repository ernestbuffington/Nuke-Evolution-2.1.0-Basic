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

$lang_admin[$adminpoint]['CACHENOTALLOWED'] = 'Vous n\'&ecirc;tes pas autoris&eacute;s a voir ce fichier!';
$lang_admin[$adminpoint]['CACHESAFEMODE'] = 'Safe mode est actif sur votre serveur, le cache ne fonctionne pas!';

$lang_admin[$adminpoint]['CACHE_BAD'] = 'Votre cache n\'est pas Chmodd&eacute;!';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_FAIL'] = 'Suppression de la cat&eacute;gorie &agrave; &eacute;chou&eacute;';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_SUCC'] = 'Cat&eacute;gorie supprim&eacute; avec succ&egrave;s';
$lang_admin[$adminpoint]['CACHE_CLEAR'] = 'Effacer Cache';
$lang_admin[$adminpoint]['CACHE_CLEARED_FAIL'] = 'Echec de l\'effa&ccedil;age du cache';
$lang_admin[$adminpoint]['CACHE_CLEARED_SUCC'] = 'Cache effac&eacute; avec succ&egrave;s';
$lang_admin[$adminpoint]['CACHE_CLEARNOW'] = 'Effacer maintenant';
$lang_admin[$adminpoint]['CACHE_DELETE'] = 'Effacer';
$lang_admin[$adminpoint]['CACHE_DIR_STATUS'] = 'Status du r&eacute;pertoire cache:';
$lang_admin[$adminpoint]['CACHE_DISABLED'] = 'D&eacute;sactiv&eacute;';
$lang_admin[$adminpoint]['CACHE_ENABLED'] = 'Activ&eacute;';
$lang_admin[$adminpoint]['CACHE_ENABLE_HOW'] = 'To enable cache, set \$use_cache to \"1\" or \"2\" in config.php if it isn\'t already.';
$lang_admin[$adminpoint]['CACHE_FILEMODE'] = 'Fichier Cache';
$lang_admin[$adminpoint]['CACHE_FILENAME'] = 'Nom du fichier';
$lang_admin[$adminpoint]['CACHE_FILESIZE'] = 'Taille du fichier';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_FAIL'] = 'Echec de l\'effa&ccedil;age du fichier';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_SUCC'] = 'Fichier effac&eacute; avec succ&egrave;s';
$lang_admin[$adminpoint]['CACHE_GOOD'] = 'Bien';
$lang_admin[$adminpoint]['CACHE_HEADER'] = 'Evo-Cms Cache :: Admin Panel';
$lang_admin[$adminpoint]['CACHE_HOWTOENABLE'] = 'Comment activer?';
$lang_admin[$adminpoint]['CACHE_INVALID'] = 'Op&eacute;ration Invalide ';
$lang_admin[$adminpoint]['CACHE_LASTMOD'] = 'Derni&egrave;re modification';
$lang_admin[$adminpoint]['CACHE_LAST_CLEARED'] = 'Dernier effa&ccedil;age du cache:';
$lang_admin[$adminpoint]['CACHE_MODE'] = 'Cache Mode';
$lang_admin[$adminpoint]['CACHE_NO'] = 'Non';
$lang_admin[$adminpoint]['CACHE_NUM_FILES'] = 'Nombre d\'objet dans le cache:';
$lang_admin[$adminpoint]['CACHE_OPTIONS'] = 'Options';
$lang_admin[$adminpoint]['CACHE_PREF_UPDATED_SUCC'] = 'Pr&eacute;f&eacute;rences mise &agrave; jour avec succ&egrave;s';
$lang_admin[$adminpoint]['CACHE_RETURN'] = 'Retour au Menu Principale d\'Administration';
$lang_admin[$adminpoint]['CACHE_RETURNCACHE'] = 'Retour au Cache Admin';
$lang_admin[$adminpoint]['CACHE_SIZE'] = 'Taille du cache:';
$lang_admin[$adminpoint]['CACHE_SQLMODE'] = 'SQL Cache';
$lang_admin[$adminpoint]['CACHE_STATUS'] = 'Cache Status:';
$lang_admin[$adminpoint]['CACHE_USER_CAN_CLEAR'] = 'Utilisateur peut effacer le cache:';
$lang_admin[$adminpoint]['CACHE_VIEW'] = 'Voir';
$lang_admin[$adminpoint]['CACHE_YES'] = 'Oui';

?>