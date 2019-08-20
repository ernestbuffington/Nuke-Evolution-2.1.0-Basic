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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }
// Admin entries
$lang['group_allow_pm'] = 'Permissies voor massa PM';
$lang['group_allow_pm_explain'] = 'Kies welk type van gebruikers de rechten hebben om deze groep een massa PM te sturen.';
 
// Profile entries
$lang['Enable_mass_pm'] = 'Waarschuw over massa PM';
$lang['Enable_mass_pm_explain'] = 'Stuur een email voor PM\'s gestuurd door admin/mod naar de gebruikers groep waar jij toe behoort';
$lang['No_mass_pm'] = 'Absoluut geen massa PM';

// PM box entries
$lang['Mass_pm'] = 'Stuur massa PM';

// groupmsgs.php entries
$lang['Send_mass_pm'] = 'Stuur nieuwe massa PM naar een gebruikers groep';
$lang['Pm_mass_users'] = '%s , in totaal (%d) gebruikers';
$lang['All_users'] = 'Alle Gebruikers';
$lang['To_group'] = 'Naar gebruikers groepen';
$lang['No_mass_pm_users'] = '%s , (geen gebruikers hebben toestemming voor massa PM)';
$lang['PM_delivered'] = 'Je bericht is afgeleverd';
$lang['Mass_pm_count'] = '%d gebruikers accepteerden de massa PM, %d hebben een email waarschuwings bericht ontvangen'; //%d substituted with the number of recipents, 2'nd %d substituded with the number of notifyed by email
$lang['Mass_pm_not_allowed'] = 'Je hebt geen toestemming om een massa pm te sturen naar wat voor groepen dan ook';

?>