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

 Copyright (c) 2010 by the Evo Europe Development Team
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

global $supporter_config, $module_name;

$lang_new[$module_name]['SP_ACTIVATE'] = 'Activer';
$lang_new[$module_name]['SP_ACTIVESITES'] = 'Site Actif';
$lang_new[$module_name]['SP_ADDED'] = 'Ajout&eacute;';
$lang_new[$module_name]['SP_ADDSUPPORTER'] = 'Ajouter un supporteur';
$lang_new[$module_name]['SP_ADMINMAIN'] = 'Support&egrave;res Administration';
$lang_new[$module_name]['SP_ADMIN_HEADER'] = 'Evo-Cms Supporteurs :: Panneau d\'administration du module';
$lang_new[$module_name]['SP_ALLREQ'] = 'Tous les champs sont requis';
$lang_new[$module_name]['SP_APPROVE'] = 'Approuver';
$lang_new[$module_name]['SP_APPROVESITE'] = 'Approuver Site';
$lang_new[$module_name]['SP_BESUPPORTER'] = 'Etre un Supporteur';
$lang_new[$module_name]['SP_CONFBANN'] = 'Mauvais envoi';
$lang_new[$module_name]['SP_CONFIGMAIN'] = 'Configuration Supporteurs';
$lang_new[$module_name]['SP_DBERROR1'] = 'ERREUR: Echec de l\'&eacute;criture &agrave; la base de donn&eacute;es';
$lang_new[$module_name]['SP_DEACTIVATE'] = 'D&eacute;sactiver';
$lang_new[$module_name]['SP_DELETESITE'] = 'Effacer Site';
$lang_new[$module_name]['SP_DESCRIPTION'] = 'Description';
$lang_new[$module_name]['SP_EDITED'] = 'Dernier changement';
$lang_new[$module_name]['SP_EDITED_USER'] = 'chang&eacute; par';
$lang_new[$module_name]['SP_EDITSITE'] = 'Editer Site';
$lang_new[$module_name]['SP_EDITSITE'] = 'Modifier Site';
$lang_new[$module_name]['SP_FILETYPERROR'] = 'Mauvais type d\'image. seulement les images (gif, jpg, jpeg, png, swf) sont autoris&eacute;es';
$lang_new[$module_name]['SP_GOTOADMIN'] = 'Administration Supporteur';
$lang_new[$module_name]['SP_IMAGE'] = 'Site Image';
$lang_new[$module_name]['SP_IMAGETYPE'] = 'Type de lien vers l\'image';
$lang_new[$module_name]['SP_IMAGETYPE0'] = 'C\'est l\'URL d\'une image !';
$lang_new[$module_name]['SP_IMAGETYPE1'] = 'L\'image est t&eacute;l&eacute;charg&eacute;e depuis votre PC!';
$lang_new[$module_name]['SP_IMAGE_UPLOAD'] = 'Image du site t&eacute;l&eacute;chargement <br /><small>Si une des deux posibilit&eacute;es est coch&eacute;e,<br />T&eacute;l&eacute;charger sera pr&eacute;f&eacute;rable</small>';
$lang_new[$module_name]['SP_IMAGE_URL'] = 'Url de l\'image du site';
$lang_new[$module_name]['SP_INACTIVESITES'] = 'Sites Inactif';
$lang_new[$module_name]['SP_LINKED'] = 'Lien';
$lang_new[$module_name]['SP_MAXHEIGHT'] = 'Hauteur max de l\'image';
$lang_new[$module_name]['SP_MAXWIDTH'] = 'Largueur max de l\'image';
$lang_new[$module_name]['SP_MISSINGDATA'] = 'Vous avez oubli&eacute; de soumettre des donn&eacute;es!';
$lang_new[$module_name]['SP_MUSTBE'] = 'Images de plus que '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' vont &ecirc;tre redimensionn&eacute;es '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' sur l\'&eacute;cran.';
$lang_new[$module_name]['SP_NAME'] = 'Nom du Site';
$lang_new[$module_name]['SP_NOACTIVESITES'] = 'Il n\'y a pas de site actif.';
$lang_new[$module_name]['SP_NOINACTIVESITES'] = 'Il n\'y a pas de site inactif.';
$lang_new[$module_name]['SP_NOSUBMITTEDSITES'] = 'Il n\'y a pas de site soumis.';
$lang_new[$module_name]['SP_NOUPLOAD'] = 'Image n\'est pas t&eacute;l&eacute;charger correctement.';
$lang_new[$module_name]['SP_REQUIREUSER'] = 'Exiger d\'&ecirc;tre membre';
$lang_new[$module_name]['SP_RETURNMAIN'] = 'Retour au menu principale d\'administration';
$lang_new[$module_name]['SP_SAVECHANGES'] = 'Sauvegarder les changements';
$lang_new[$module_name]['SP_SITEID'] = 'Site ID';
$lang_new[$module_name]['SP_SUBMITSITE'] = 'Soumettre un Site';
$lang_new[$module_name]['SP_SUBMITTED'] = 'Soumis';
$lang_new[$module_name]['SP_SUBMITTEDSITES'] = 'Sites soumis';
$lang_new[$module_name]['SP_SUPPORTEDBY'] = 'Support&eacute; par';
$lang_new[$module_name]['SP_SUPPORTERS'] = 'Supporteurs';
$lang_new[$module_name]['SP_SURE2DELETE'] = 'Etes-vous s&ucirc;r de vouloir effacer ce site?';
$lang_new[$module_name]['SP_UPLOAD'] = 'T&eacute;l&eacute;charger';
$lang_new[$module_name]['SP_UPLOADERROR'] = 'Le fichier n\'a pas &eacute;t&eacute; t&eacute;l&eacute;charg&eacute;';
$lang_new[$module_name]['SP_URL'] = 'Site URL';
$lang_new[$module_name]['SP_USEREMAIL'] = 'Email de l\'utilisateur';
$lang_new[$module_name]['SP_USERID'] = 'ID de l\'utilisateur ';
$lang_new[$module_name]['SP_USERIP'] = 'IP de l\'utilisateur ';
$lang_new[$module_name]['SP_USERNAME'] = 'Nom de l\'utilisateur';
$lang_new[$module_name]['SP_VISITS'] = 'Visites';
$lang_new[$module_name]['SP_YOUDELETE'] = 'Vous &ecirc;tes sur de supprimer ce site';
$lang_new[$module_name]['SP_YOUREMAIL'] = 'Votre Email';
$lang_new[$module_name]['SP_YOURIP'] = 'Votre IP';
$lang_new[$module_name]['SP_YOURNAME'] = 'Votre Nom';

?>