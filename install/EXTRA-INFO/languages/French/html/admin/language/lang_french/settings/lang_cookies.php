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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'R&eacute;glages Cookie';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Panneau de r&eacute;glages du Cookie';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Options Cookie';

$lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO'] = '<br \>Ces d&eacute;tails d&eacute;finisent comment les cookies sont envoy&eacute;s au navigateur de vos utilisateurs. Dans la plupart des cas, les valeurs des param&egrave;tres par d&eacute;faut des cookies doivent &ecirc;tre suffisantes, mais si vous avez besoin de changer, faite le avec prudence - des param&egrave;tres incorrects peuvent emp&ecirc;cher les utilisateurs de se connecter <br \>';
$lang_admin[$settingspoint]['FIELD_HEADER_COOKIE_INFO_USER'] = 'Param&egrave;tres des cookies d\'utilisateur sp&eacute;cifique';

$lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN'] = 'Cookie Domaine';
$lang_admin[$settingspoint]['FIELD_COOKIE_DOMAIN_HELP'] = 'Si Nuke Evolution est install&eacute; dans la racine d\'un domaine Pour exemple. http://www.mysite.com ou http://mysite.com, le domaine de cookie doit &ecirc;tre d&eacute;finie comme .mysite.com (Note de la p&eacute;riode avant le nom). Si votre site est install&eacute; sur un sous-domaine comme http://evo.mysite.com, le domaine de cookie doit &ecirc;tre fix&eacute; comme evo.mysite.com . S\'il est install&eacute; dans un sous-dossier comme http://www.mysite.com/evo/, d&eacute;finir www.mysite.com comme le domaine de cookie.';
$lang_admin[$settingspoint]['FIELD_COOKIE_PATH'] = 'Chemin du cookie';
$lang_admin[$settingspoint]['FIELD_COOKIE_PATH_HELP'] = 'Si Nuke Evolution est install&eacute; dans la racine d\'un domaine comme http://www.mysite.com ou http://mysite.com ou il est install&eacute; sur un sous-domaine comme http://evo.mysite.com, le chemin du cookie doit &ecirc;tre r&eacute;gl&eacute; sur /. Si votre site est dans un sous-dossier comme http://www.mysite.com/evo/ le chemin du cookie doit &ecirc;tre r&eacute;gl&eacute; sur /evo (Notez qu\'il n\'y a pas de / &agrave; la fin).';
$lang_admin[$settingspoint]['FIELD_COOKIE_NAME'] = 'Nom du Cookie';
$lang_admin[$settingspoint]['FIELD_COOKIE_NAME_HELP'] = 'Dans tous les cas le nom du cookie doit correspondre exactement &agrave; votre nom de domaine sans le suffixe. Pour exemple si votre domaine est http://www.mysite.com, http://mysite.com ou http://evo.mysite.com le nom du cookie doit &ecirc;tre toujours monsite, m&ecirc;me si votre site est install&eacute; dans un sous-dossier.';
$lang_admin[$settingspoint]['FIELD_COOKIE_SECURE'] = 'Secure Cookie';
$lang_admin[$settingspoint]['FIELD_COOKIE_SECURE_HELP'] = 'Pour utiliser un protocole s&eacute;curis&eacute; pour les cookies, le serveur web doit dispos&eacute; &agrave; accepter les connexions HTTPS.';
$lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH'] = 'Dur&eacute;e de validit&eacute; du cookie';
$lang_admin[$settingspoint]['FIELD_COOKIE_SESSION_LENGTH_HELP'] = 'D&eacute;finir combien de temps une seule session est valide. Vous devez d&eacute;finir la dur&eacute;e de la session en secondes. Par d&eacute;faut est 3600.';
$lang_admin[$settingspoint]['FIELD_COOKIE_CHECK'] = 'Activez le contr&ocirc;le par Cookie';
$lang_admin[$settingspoint]['FIELD_COOKIE_CHECK_HELP'] = 'V&eacute;rifie si le navigateur accepte les cookies';
$lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER'] = 'Activez le CookieCleaner';
$lang_admin[$settingspoint]['FIELD_COOKIE_CLEANER_HELP'] = 'Voir l\'option de supprimer tous les cookies de ce site.';
$lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY'] = 'D&eacute;lai de consultation de la page sans activit&eacute;e';
$lang_admin[$settingspoint]['FIELD_COOKIE_INACTIVITY_HELP'] = 'Dur&eacute;e o&ugrave; un utilisateur reste connect&eacute; sans aucune activit&eacute;e.';
$lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME'] = 'Temps de Cookies';
$lang_admin[$settingspoint]['FIELD_COOKIE_LIFETIME_HELP'] = 'Pass&eacute; ce d&eacute;lai, le cookie expire et sera supprim&eacute; automatiquement par le navigateur.';

$lang_admin[$settingspoint]['OPTION_COOKIE_LOGOUT'] = 'D&eacute;connectino quand la fen&ecirc;tre est ferm&eacute;e';
$lang_admin[$settingspoint]['OPTION_COOKIE_BLOCK'] = 'Block Logins';
$lang_admin[$settingspoint]['OPTION_COOKIE_SECONDS'] = 'Secondes';
$lang_admin[$settingspoint]['OPTION_COOKIE_MINUTE'] = 'Minute';
$lang_admin[$settingspoint]['OPTION_COOKIE_MINUTES'] = 'Minutes';
$lang_admin[$settingspoint]['OPTION_COOKIE_HOUR'] = 'Hour';
$lang_admin[$settingspoint]['OPTION_COOKIE_HOURS'] = 'Hours';
$lang_admin[$settingspoint]['OPTION_COOKIE_DAY'] = 'Jour';
$lang_admin[$settingspoint]['OPTION_COOKIE_DAYS'] = 'Jours';
$lang_admin[$settingspoint]['OPTION_COOKIE_WEEK'] = 'Semaine';
$lang_admin[$settingspoint]['OPTION_COOKIE_WEEKS'] = 'Semaines';
$lang_admin[$settingspoint]['OPTION_COOKIE_MONTH'] = 'Mois';
$lang_admin[$settingspoint]['OPTION_COOKIE_MONTHS'] = 'Mois';
$lang_admin[$settingspoint]['OPTION_COOKIE_INDEFINITE'] = 'Ind&eacute;fini';
$lang_admin[$settingspoint]['OPTION_COOKIE_AUTOMATIC'] = 'D&eacute;connexion automatique &agrave; la premi&egrave;re consultation';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas de champ de saisie valide pour '.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarde';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

?>