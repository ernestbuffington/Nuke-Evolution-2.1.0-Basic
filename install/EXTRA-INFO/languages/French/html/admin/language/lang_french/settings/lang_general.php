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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Param&egrave;tres de Base';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Param&egrave;tres Base';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Options de base';
$lang_admin[$settingspoint]['FIELD_SITENAME'] = 'Nom de votre site';
$lang_admin[$settingspoint]['FIELD_SITENAME_HELP'] = 'Ce devrait &ecirc;tre le nom de votre site web. Gardez-les aussi courts que possible. Ce nom est affich&eacute; dans le navigateur comme le nom de votre site.';
$lang_admin[$settingspoint]['FIELD_SITEURL'] = 'URL du site';
$lang_admin[$settingspoint]['FIELD_SITEURL_HELP'] = 'Ce doit &ecirc;tre l\'URL de votre site Web avec http://';
$lang_admin[$settingspoint]['FIELD_SITELOGO'] = 'Logo du site';
$lang_admin[$settingspoint]['FIELD_SITELOGO_HELP'] = 'Vous pouvez d&eacute;finir un logo graphique pour votre site web ici. Ce champ doit contenir le nom de fichier d\'une image situ&eacute; dans le dossier image.';
$lang_admin[$settingspoint]['FIELD_SITESLOGAN'] = 'Slogan de votre site';
$lang_admin[$settingspoint]['FIELD_SITESLOGAN_HELP'] = 'Une br&egrave;ve description du contenu ou un slogan pour votre site web. La description ou un slogan doit &ecirc;tre aussi courte que possible.';
$lang_admin[$settingspoint]['FIELD_STARTDATE'] = 'Date de d&eacute;part de votre site';
$lang_admin[$settingspoint]['FIELD_STARTDATE_DAY'] = 'Jour'; 
$lang_admin[$settingspoint]['FIELD_STARTDATE_MONTH'] = 'Mois'; 
$lang_admin[$settingspoint]['FIELD_STARTDATE_YEAR'] = 'Ann&eacute;e'; 
$lang_admin[$settingspoint]['FIELD_STARTDATE_HELP'] = 'La date de d&eacute;but de votre site web. Cette date est indiqu&eacute;e dans l\'en-t&ecirc;te du module statistique';
$lang_admin[$settingspoint]['FIELD_ADMINMAIL'] = 'Email de l\'Administrateur Principale';
$lang_admin[$settingspoint]['FIELD_ADMINMAIL_HELP'] = 'Ce doit &ecirc;tre une adresse email valide du fondateur ou administrateur de ce site - Pour exemple webmaster@yourpage.com';
$lang_admin[$settingspoint]['FIELD_ITEMSTOP'] = 'Nombre d\'&eacute;l&eacute;ments dans le haut de page?';
$lang_admin[$settingspoint]['FIELD_ITEMSTOP_HELP'] = 'Ce param&egrave;tre d&eacute;finit le nombre d\'entr&eacute;es de Top-Module. Par d&eacute;faut est 10 (TOP 10)';
$lang_admin[$settingspoint]['FIELD_STORIESHOME'] = 'Nombre des histoires dans Accueil';
$lang_admin[$settingspoint]['FIELD_STORIESHOME_HELP'] = 'Ce param&egrave;tre d&eacute;finit la quantit&eacute; de nouvelles indiqu&eacute; dans l\'accueil. Par d&eacute;faut est 10. Ce param&egrave;tre est &eacute;cras&eacute; par le param&egrave;tre dans la configuration articles ou d\'un param&egrave;tre utilisateur.';
$lang_admin[$settingspoint]['FIELD_OLDSTORIES'] = 'Histoires dans la boite des anciens articles';
$lang_admin[$settingspoint]['FIELD_OLDSTORIES_HELP'] = 'Ce param&egrave;tre d&eacute;finit la quantit&eacute; des nouvelles montr&eacute;es dans les archives articles. Par d&eacute;faut est 30.';
$lang_admin[$settingspoint]['FIELD_ANONPOST'] = 'Autoriser les anonymes &agrave; poster?';
$lang_admin[$settingspoint]['FIELD_ANONPOST_HELP'] = 'Ce param&egrave;tre d&eacute;finit si les clients sont autoris&eacute;s &agrave; soumettre des nouvelles et laisser un commentaire.';
$lang_admin[$settingspoint]['FIELD_LOCALEFORMAT'] = 'Format de l\'heure Locale';
$lang_admin[$settingspoint]['FIELD_LOCALEFORMAT_HELP'] = 'C\'est le format de l\'heure locale PHP. Ce param&egrave;tre n\'est plus en usage. Il est juste &agrave; gauche pour des raisons de compatibilit&eacute;.';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ de saisie valide pour '.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>