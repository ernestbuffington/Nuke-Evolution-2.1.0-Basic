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
$lang_admin[$adminpoint]['MODULES_ACTIVATE'] = 'Activer';
$lang_admin[$adminpoint]['MODULES_ACTIVE'] = 'Module est activ&eacute;.';
$lang_admin[$adminpoint]['MODULES_ADMIN_HEADER'] = 'Evo-Cms Modules :: Panneau d\'administration';
$lang_admin[$adminpoint]['MODULES_ALL'] = 'Tout';

$lang_admin[$adminpoint]['MODULES_BLOCK'] = 'Module block';
$lang_admin[$adminpoint]['MODULES_BLOCKS_BOTH'] = 'Les deux Blocks';
$lang_admin[$adminpoint]['MODULES_BLOCKS_LEFT'] = 'Blocks de Gauche';
$lang_admin[$adminpoint]['MODULES_BLOCKS_NONE'] = 'Aucun';
$lang_admin[$adminpoint]['MODULES_BLOCKS_RIGHT'] = 'Blocks de Droite';
$lang_admin[$adminpoint]['MODULES_BLOCKS_SHOW'] = 'Voir Blocks';

$lang_admin[$adminpoint]['MODULES_CAT_COLLAPSE'] = 'Replier cette cat&eacute;gorie au d&eacute;part? ';
$lang_admin[$adminpoint]['MODULES_CAT_DELETE'] = 'Effacer Cat&eacute;gorie';
$lang_admin[$adminpoint]['MODULES_CAT_EDIT'] = 'Editer Categorie';
$lang_admin[$adminpoint]['MODULES_CAT_IMG'] = 'physical name of this image';
$lang_admin[$adminpoint]['MODULES_CAT_IMG_NOTE'] = 'Category Images must be stored in  <i>images/blocks/modules/</i>.';
$lang_admin[$adminpoint]['MODULES_CAT_LINK_TITLE'] = 'Lien Titre';
$lang_admin[$adminpoint]['MODULES_CAT_ORDER'] = 'Changer l\'ordre des cat&eacute;gories';
$lang_admin[$adminpoint]['MODULES_CAT_TITLE'] = 'Titre Cat&eacute;gorie';
$lang_admin[$adminpoint]['MODULES_COLLAPSE'] = 'Replier les Cat&eacute;gories ?';
$lang_admin[$adminpoint]['MODULES_CUSTOMTITLE'] = 'Titre personnalis&eacute;';

$lang_admin[$adminpoint]['MODULES_DEACTIVATE'] = 'D&eacute;sactiver';
$lang_admin[$adminpoint]['MODULES_DOUBLECLICK'] = '(Doubleclick active/d&eacute;sactive)';

$lang_admin[$adminpoint]['MODULES_EDIT'] = 'Changer Module';
$lang_admin[$adminpoint]['MODULES_ERROR_CAT_NF'] = 'La cat&eacute;gotie n\'a pas &eacute;t&eacute; touv&eacute;e';
$lang_admin[$adminpoint]['MODULES_ERROR_GROUPS'] = 'Vous devez s&eacute;lectionner un groupe';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE'] = 'Vous devez ins&eacute;rer Titre and Lien';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EMPTY'] = 'Vous devez ins&eacute;rer le Titre ';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EXIST'] = 'The Title you inserted exists<br />Please try again<br /><br />';
$lang_admin[$adminpoint]['MODULES_EXPLAIN'] = 'S\'il vous pla&icirc;t noter que si vous activer ou d&eacute;sactiver un module ici<br /> il sera montr&eacute; pour un visiteur imm&eacute;diatement. Mais vous devez actualiser l\'&eacute;cran avant de voir vos modifications!';
$lang_admin[$adminpoint]['MODULES_EXPLAIN2'] = 'Vous <strong>devez</strong> enregistrer les modifications d\'ordre de tri avant qu\'ils ne soient activ&eacute;s!';

$lang_admin[$adminpoint]['MODULES_FUNCTIONS'] = 'Fonctions';

$lang_admin[$adminpoint]['MODULES_INACTIVE'] = 'Le module n\'est pas actif.';
$lang_admin[$adminpoint]['MODULES_INHOME'] = 'Module vu sur la page principale:';

$lang_admin[$adminpoint]['MODULES_LINK'] = 'Est-ce un lien';
$lang_admin[$adminpoint]['MODULES_LINK_DELETE'] = 'Effacer Lien';

$lang_admin[$adminpoint]['MODULES_MODULEHOMENOTE'] = 'Le titre du module en gras montre le module qui est affich&eacute; sur la page principale de votre site Web.<br />Tant que ce module est le module principal, il ne peut pas &ecirc;tre supprim&eacute;.!<br />Si vous supprimez le r&eacute;pertoire de ce module sans le changer ici, un message d\'erreur sera affich&eacute; sur la page principale.<br />Ce Module est charg&eacute; si vous cliquez sur <i> Accueil </i> dans un menu.';
$lang_admin[$adminpoint]['MODULES_MODULEINFO'] = 'Info';
$lang_admin[$adminpoint]['MODULES_MVADMIN'] = 'Administrateurs seulement';
$lang_admin[$adminpoint]['MODULES_MVALL'] = 'Tous les Visiteurs';
$lang_admin[$adminpoint]['MODULES_MVANON'] = 'Anonyme seulement';
$lang_admin[$adminpoint]['MODULES_MVGROUPS'] = 'Membres de groupe seulement';
$lang_admin[$adminpoint]['MODULES_MVUSERS'] = 'Utilisateur enregistre&eacute; seulement';

$lang_admin[$adminpoint]['MODULES_NF_VALUES'] = 'Pas de valeurs valides';
$lang_admin[$adminpoint]['MODULES_NOTINMENU'] = 'D&eacute;finir un nom de module n\'est pas vu dans le menu';

$lang_admin[$adminpoint]['MODULES_REFRESH SCREEN'] = 'Rafra&icirc;chir l\'&eacute;cran';

$lang_admin[$adminpoint]['MODULES_SAVECHANGES'] = 'Sauvegarder les changements';
$lang_admin[$adminpoint]['MODULES_SHOW'] = 'Afficher';
$lang_admin[$adminpoint]['MODULES_SHOWINMENU'] = 'Voir dans le Menu?';

$lang_admin[$adminpoint]['MODULES_TITLE'] = 'Titre';

$lang_admin[$adminpoint]['MODULES_URL'] = 'URL';

$lang_admin[$adminpoint]['MODULES_VIEW'] = 'Voir';
$lang_admin[$adminpoint]['MODULES_VIEWPRIV'] = 'Qui peut voir cela?';

$lang_admin[$adminpoint]['MODULES_WHATGRDESC'] = 'Quels sont les groupes';
$lang_admin[$adminpoint]['MODULES_WHATGROUPS'] = 'Groupes';

?>