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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Param&egrave;tres Utilisateur';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Basic Param&egrave;tres Utilisateur';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Utilisateur Options';

$lang_admin[$settingspoint]['FIELD_HEADER_REGOPTIONS'] = 'Options d\'Enregistrement';
$lang_admin[$settingspoint]['FIELD_HEADER_EMAILOPTIONS'] = 'Options Email';
$lang_admin[$settingspoint]['FIELD_HEADER_SUSPENDOPTIONS'] = 'Options Suspendre';
$lang_admin[$settingspoint]['FIELD_HEADER_LIMITOPTIONS'] = 'Limites';

$lang_admin[$settingspoint]['FIELD_ALLOWUSERREG'] = 'Autoriser les utilisateurs &agrave; s\'enregistrer';
$lang_admin[$settingspoint]['FIELD_REQUIREADMIN'] = 'Validation par un admin';
$lang_admin[$settingspoint]['FIELD_ALLOWUSERDELETE'] = 'Autoriser les utilisateurs &agrave; se d&eacute;sactiver';
$lang_admin[$settingspoint]['FIELD_DOUBLECHECKEMAIL'] = 'Double validation de l\'email &agrave; l\'enregistrement';
$lang_admin[$settingspoint]['FIELD_ALLOWUSERTHEME'] = 'Autoriser les utilisateurs &agrave; changer leur th&egrave;me';
$lang_admin[$settingspoint]['FIELD_SERVERMAIL'] = 'Le serveur peut envoyer des mails?';
$lang_admin[$settingspoint]['FIELD_SENDMAILADD'] = 'Notification admin de l\'enregistrement d\'un utilisateur';
$lang_admin[$settingspoint]['FIELD_SENDMAILDELETE'] = 'Notification admin de la d&eacute;sactivation d\'un utilisateur';
$lang_admin[$settingspoint]['FIELD_USEACTIVATE'] = 'Utiliser le mail d\'activation?';
$lang_admin[$settingspoint]['FIELD_ALLOWMAILCHANGE'] = 'Autoriser les utilisateur &agrave; changer leur email';
$lang_admin[$settingspoint]['FIELD_EMAILVALIDATE'] = 'Valider les changements Email';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPEND'] = 'Suspendre les utilisateurs apr&egrave;s';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPEND_TEMP'] = 'Temps d\'expiration du compte en attente';
$lang_admin[$settingspoint]['FIELD_AUTOSUSPENDMAIN'] = 'Auto suspendre l\'utilisateur dans toutes les consultations de page';
$lang_admin[$settingspoint]['FIELD_USERS_PER_PAGE'] = '# utilisateurs lister par page';
$lang_admin[$settingspoint]['FIELD_NICK_MIN'] = 'Utilisateur Taille Min';
$lang_admin[$settingspoint]['FIELD_NICK_MAX'] = 'Utilisateur Taille Max';
$lang_admin[$settingspoint]['FIELD_PASS_MIN'] = 'Password Taille Min';
$lang_admin[$settingspoint]['FIELD_PASS_MAX'] = 'Password Taille Max';
$lang_admin[$settingspoint]['FIELD_SHOWONLINE'] = 'Maximum de temps vue en ligne';

$lang_admin[$settingspoint]['OPTION_SUSPEND_DEACTIVATED'] = 'Jamais';
$lang_admin[$settingspoint]['OPTION_SUSPEND_WEEK'] = 'Semaine';
$lang_admin[$settingspoint]['OPTION_SUSPEND_WEEKS'] = 'Semaines';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DEACTIVATED'] = 'Jamais';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAY'] = 'Jour';
$lang_admin[$settingspoint]['OPTION_SUSPEND_TEMP_DAYS'] = 'Jours';
$lang_admin[$settingspoint]['OPTION_USERS_PER_PAGE'] = 'Utilisateurs';
$lang_admin[$settingspoint]['OPTION_NICK_MIN'] = 'Charact&egrave;res';
$lang_admin[$settingspoint]['OPTION_NICK_MAX'] = 'Charact&egrave;res';
$lang_admin[$settingspoint]['OPTION_PASS_MIN'] = 'Charact&egrave;res';
$lang_admin[$settingspoint]['OPTION_PASS_MAX'] = 'Charact&egrave;res';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_CHOICE'] = 'Merci de selectionner';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_SECONDS'] = 'Secondes';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTE'] = 'Minute';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_MINUTES'] = 'Minutes';
$lang_admin[$settingspoint]['OPTION_SHOWONLINE_HOUR'] = 'Heure';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Pas d\'entr&eacute;e valide pour'.$settingspoint.'';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Sauvegarder';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Retour';

$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERREG'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Non&rdquo;, pas de nouvel utilisateur peut s\'enregistrer sur votre site web. <br /> Seulement les Administrateurs peuvent alors ajouter de nouveaux utilisateurs.';
$lang_admin[$settingspoint]['HELP_FIELD_REQUIREADMIN'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;, les nouveaux comptes ne sont activ&eacute; que si un administrateur a approuv&eacute; ce compte.';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERDELETE'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;, les utilisateurs peuvent d&eacute;sactiver leur propre compte. <br /> Dans le cas contraire seuls les administrateurs peuvent d&eacute;sactiver des comptes.';
 $lang_admin[$settingspoint]['HELP_FIELD_ALLOWUSERTHEME'] = 'S\'il est d&eacute;fini &agrave; &rdquo;No&rdquo;, les utilisateurs ne sont pas autoris&eacute;s &agrave; changer leur th&egrave;me.<br />L\'aper&ccedil;u d\'autres th&egrave;mes seront autoris&eacute;s.';
$lang_admin[$settingspoint]['HELP_FIELD_DOUBLECHECKEMAIL'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;, un nouvel utilisateur doit retaper son adresse email sur le nouvel enregistrement ou sur la modification de son adresse e-mail.';
$lang_admin[$settingspoint]['HELP_FIELD_SERVERMAIL'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;, un e-mail est envoy&eacute; par protocoll SMTP. Sinon, il sera envoy&eacute; par protocoll sendmail.';
$lang_admin[$settingspoint]['HELP_FIELD_SENDMAILADD'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;,  e-mail suppl&eacute;mentaire est envoy&eacute; &agrave; l\'adresse e-mail administrative pour chaque nouvel enregistrement.';
$lang_admin[$settingspoint]['HELP_FIELD_SENDMAILDELETE'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;, un e-mail suppl&eacute;mentaire est envoy&eacute; &agrave; l\'adresse e-mail administrative si un utilisateur d&eacute;sactive son compte.';
$lang_admin[$settingspoint]['HELP_FIELD_USEACTIVATE'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;, un email est envoy&eacute; &agrave; l\'adresse e-mail de l\'utilisateur. Ce n\'est qu\'apr&egrave;s l\'approbation de cette e-mail, le compte est activ&eacute;.';
$lang_admin[$settingspoint]['HELP_FIELD_ALLOWMAILCHANGE'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;, un utilisateur est en mesure de changer son adresse e-mail lui-m&ecirc;me. Sinon, les changements ne peuvent &ecirc;tre effectu&eacute;s que par un administrateur autoris&eacute;.';
$lang_admin[$settingspoint]['HELP_FIELD_EMAILVALIDATE'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;, le changement de mail est v&eacute;rifi&eacute;, en envoyant un courriel &agrave; l\'adresse donn&eacute;e. Si l\'utilisateur n\'a pas approuver ce lien, le changement ne sera pas activ&eacute;.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPENDMAIN'] = 'S\'il est d&eacute;fini &agrave; &rdquo;Oui&rdquo;, chaque connexion est v&eacute;rifi&eacute;, si &agrave; un moment donn&eacute; le champ suivant est atteint. Si oui, le compte doit &ecirc;tre r&eacute;activ&eacute; par un administrateur.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND'] = 'D&eacute;lai apr&egrave;s lequel un compte utilisateur est d&eacute;sactiv&eacute; et doit &ecirc;tre r&eacute;activ&eacute; avant que l\'utilisateur puisse se reconnecter &agrave; nouveau.';
$lang_admin[$settingspoint]['HELP_FIELD_AUTOSUSPEND_TEMP'] = 'D&eacute;lai apr&egrave;s lequel un nouveau compte cr&eacute;&eacute; est supprim&eacute;, si l\' &eacute;tape suivante (activation par l\'administrateur ou en approuvant le lien de l\'email envoy&eacute;e) ne se fait pas.';
$lang_admin[$settingspoint]['HELP_FIELD_USERS_PER_PAGE'] = 'Maximum d\'utilisateurs connect&eacute;s. Si la limite est atteinte, la prochaine connexion sera refus&eacute;e.';
$lang_admin[$settingspoint]['HELP_FIELD_NICK_MIN'] = 'Nombre de caract&egrave;res minimum un nom d\'utilisateur doit avoir.<br />Un minimum au-dessous &rdquo;4&rdquo; n\'est pas sage.';
$lang_admin[$settingspoint]['HELP_FIELD_NICK_MAX'] = 'Nombre de caract&egrave;res maximum un nom d\'utilisateur doit avoir.';
$lang_admin[$settingspoint]['HELP_FIELD_PASS_MIN'] = 'Longueur mimimum  du mot de passe utilisateur.<br />Un minimum au-dessous &rdquo;6&rdquo; n\'est pas sage';
$lang_admin[$settingspoint]['HELP_FIELD_PASS_MAX'] = 'Longueur maximum du mot de passe utilisateur.';
$lang_admin[$settingspoint]['FIELD_SHOWONLINE_HELP'] = 'Temps maximum dans lequel un utilisateur seront affich&eacute;es en ligne depuis sa derni&egrave;re activit&eacute;';
?>