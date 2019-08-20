<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

// Admin entries
$lang['group_allow_pm'] = 'Permission d\'envoyer des emails de masse';
$lang['group_allow_pm_explain'] = 'S&eacute;lectionnez quel type de membres a le droit d\'envoyer des emails de masse aux membres de ce groupe.'; 

// Profile entries
$lang['Enable_mass_pm'] = 'M\'avertir de la r&eacute;ception d\'un email de masse';
$lang['Enable_mass_pm_explain'] = 'Envoyer un e-mail lorsqu\'un message priv&eacute; issu d\'un email de masse vous est envoy&eacute; pas l\'administrateur ou un mod&eacute;rateur du forum.';
$lang['No_mass_pm'] = 'Pas du tout de email de masse';

// PM box entries
$lang['Mass_pm'] = 'Envoyer un email de masse';

// groupmsgs.php entries
$lang['Send_mass_pm'] = 'Envoyer un email de masse &agrave; un groupe de membres';
$lang['Pm_mass_users'] = '%s , au total (%d) membres';
$lang['All_users'] = 'Tous les membres';
$lang['All_mods'] = 'Tous les Mod&eacute;rateurs';
$lang['All_admins'] = 'Tous les Administrateurs';
$lang['To_group'] = 'Au groupe';
$lang['No_mass_pm_users'] = '%s , (aucun membre n\'a autoris&eacute; les mails de masse par message priv&eacute;)';
$lang['PM_delivered'] = 'Votre message a bien &eacute;t&eacute; distribu&eacute;';
$lang['Mass_pm_count'] = '%d membres l\'ont reçu, dont %d ont &eacute;t&eacute; avertis par email'; //%d substituted with the number of recipents, 2'nd %d substituded with the number of notifyed by email
$lang['Mass_pm_not_allowed'] = 'Vous n\'avez pas l\'autorisation d\'envoyer des mails de masse, pour aucun groupe de membres.';

?>