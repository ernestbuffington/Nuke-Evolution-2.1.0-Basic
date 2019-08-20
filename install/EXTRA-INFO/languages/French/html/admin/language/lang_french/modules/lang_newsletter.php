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

global $adminpoint, $evoconfig;
$lang_admin[$adminpoint]['NEWSLETTER_BACKMAIN'] = 'Retour au Menu Principale d\'Administration';

$lang_admin[$adminpoint]['NEWSLETTER_DISCARD'] = 'Jeter';

$lang_admin[$adminpoint]['NEWSLETTER_ERROR_NOT_SET'] = '%s n\'est pas r&eacute;gl&eacute;';

$lang_admin[$adminpoint]['NEWSLETTER_FROM'] = 'Pour';

$lang_admin[$adminpoint]['NEWSLETTER_HELLO'] = 'Salut';

$lang_admin[$adminpoint]['NEWSLETTER_MAILCONTENT'] = 'Email Contenu';
$lang_admin[$adminpoint]['NEWSLETTER_MANYUSERSNOTE'] = 'Parce que de nombreux destinataires sont choisis, il pourrait avoir besoin de quelques minutes avant que l\'action soit termin&eacute;e<br />Merci d\'&ecirc;tre patient!';
$lang_admin[$adminpoint]['NEWSLETTER_MUSERGROUPWILLRECEIVE'] = 'Groupes d\'utilisateurs qui recevront cette Newsletter';

$lang_admin[$adminpoint]['NEWSLETTER_NEWSLETTERSENT'] = 'Votre Newsletter est envoy&eacute;e';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ADMINS'] = 'Administrateurs';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ALLUSERS'] = 'Tous les utilisateurs';
$lang_admin[$adminpoint]['NEWSLETTER_NL_NOUSERS'] = 'Le groupe choisi n\'a aucun membres<br />PMerci de revenir en arri&egrave;re et de choisir un autre groupe';
$lang_admin[$adminpoint]['NEWSLETTER_NL_RECIPS'] = 'Destinataire';
$lang_admin[$adminpoint]['NEWSLETTER_NL_REGARDS'] = 'With best regards';
$lang_admin[$adminpoint]['NEWSLETTER_NLUNSUBSCRIBE'] = '<u>Merci de noter:</u><br />Vous receverez ce bulletin parce que vous aviez accept&eacute; de les recevoir lors de votre inscription sur notre site. <br /><br />Vous pouvez changer cela &agrave; tout moment &agrave; partir de votre profil. Merci de r&eacute;gler dans votre profile le r&eacute;glage NEWSLETTER PAR MAIL - sur NON<br /><br />Vous &ecirc;tes le bienvenu si vous avez besoin d\'aide. Merci d\'envoyer un mail &agrave; notre <a href="mailto:'.$evoconfig['adminmail'].'">Compte Administrateur</a>")';
$lang_admin[$adminpoint]['NEWSLETTER_NUSERWILLRECEIVE'] = 'Les utilisateurs recevront cette Nouvelles';

$lang_admin[$adminpoint]['NEWSLETTER_PREVIEW'] = 'Visualiser';

$lang_admin[$adminpoint]['NEWSLETTER_REVIEWTEXT'] = 'Avant d\'envoyer - Consultez votre Nouvelles (aussi pour les erreurs d\'orthographes)';
$lang_admin[$adminpoint]['NEWSLETTER_SEND'] = 'Envoyer Newsletter';
$lang_admin[$adminpoint]['NEWSLETTER_SUBSCRIBEDUSERS'] = 'Les utilisateurs inscrits';
$lang_admin[$adminpoint]['NEWSLETTER_STAFF'] = 'Equipe';
$lang_admin[$adminpoint]['NEWSLETTER_SUBJECT'] = 'Sujet';

$lang_admin[$adminpoint]['NEWSLETTER_TITLE'] = 'Newsletter';

?>