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
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Gestion des fichiers';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Param&egrave;tre de gestion des fichiers';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Param&egrave;tre FTP';
$lang_admin[$settingspoint]['FIELD_FTPHOST'] = 'URL pour l\'acc&egrave;s au FTP';
$lang_admin[$settingspoint]['FIELD_FTPHOST_HELP'] = 'L\'URL pour acc&eacute;der &agrave; votre serveur par FTP. <br /> Normalement, vous devez indiquer ici la m&ecirc;me adresse que vous avez utiliser pour votre programme FTP';
$lang_admin[$settingspoint]['FIELD_FTPPORT'] = 'Port FTP';
$lang_admin[$settingspoint]['FIELD_FTPPORT_HELP'] = 'Le port utilis&eacute; par votre serveur web sur lequel le service FTP est ex&eacute;cut&eacute;. <br /> Normalement, vous devez indiquer ici le m&ecirc;me port que vous avez utiliser dans votre programme FTP';
$lang_admin[$settingspoint]['FIELD_FTPPATH'] = 'Chemin du r&eacute;pertoire de votre site';
$lang_admin[$settingspoint]['FIELD_FTPPATH_HELP'] = 'Chemin du r&eacute;pertoire de votre site apr&egrave;s vous &ecirc;tre connect&eacute; au FTP';
$lang_admin[$settingspoint]['FIELD_FTPUSER'] = 'Utilisateur FTP';
$lang_admin[$settingspoint]['FIELD_FTPUSER_HELP'] = 'Le nom d\'utilisateur pour acc&eacute;der au FTP.<br />Vous devez indiquer ici le m&ecirc;me nom que vous utilisez pour votre programme FTP';
$lang_admin[$settingspoint]['FIELD_FTPPWD'] = 'Mot de passe FTP';
$lang_admin[$settingspoint]['FIELD_FTPPWD_HELP'] = 'Le mot de passe de votre utilisateur pour acc&eacute;der au FTP<br />Vous devez indiquer ici le m&ecirc;me mot de passe que vous utilisez pour votre programme FTP.';
$lang_admin[$settingspoint]['FIELD_DIRECTORY_MODE'] = 'Permissions des r&eacute;pertoires';
$lang_admin[$settingspoint]['FIELD_DIRECTORY_MODE_HELP'] = 'Permissions standard des dossiers<br />Votre entr&eacute;e ici va &eacute;raser les r&eacute;glages effectu&eacute;s dans le fichier config.php <br /> Les permissions normal pour un r&eacute;pertoire est de 755 ce qui signifie: lecture + &eacute;criture + ex&eacute;cution pour le propri&eacute;taire du r&eacute;pertoire, lire + autorisations d\'ex&eacute;cution pour le groupe et les invit&eacute;s.';
$lang_admin[$settingspoint]['FIELD_FILE_MODE'] = 'Permissions des fichiers';
$lang_admin[$settingspoint]['FIELD_FILE_MODE_HELP'] = 'Permissions standard des fichiers.<br />Votre entr&eacute;e ici va &eacute;raser les r&eacute;glages effectu&eacute;s dans le fichier config.php <br /> Les permissions normal pour un r&eacute;pertoire est de 644 ce qui signifie: lecture + &eacute;criture + ex&eacute;cution pour le propri&eacute;taire du r&eacute;pertoire, lire + autorisations d\'ex&eacute;cution pour le groupe et les invit&eacute;s.';

$lang_admin[$settingspoint]['CHECK_ERROR_NOConnection'] = 'Les r&eacute;glages effectu&eacute;s sont mauvais. Ils ne nous ont pas permis d\'&eacute;tablir une connexion ftp valide sur le serveur sp&eacute;cifi&eacute;';

$lang_admin[$settingspoint]['FIELD_BREAK_FILESETTINGS'] = 'Permissions';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas d\'entr&eacute;e valide pour'.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>