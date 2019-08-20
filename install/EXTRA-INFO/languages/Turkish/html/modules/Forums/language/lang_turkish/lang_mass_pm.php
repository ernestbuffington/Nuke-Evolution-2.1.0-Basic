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

if(!defined('NUKE_EVO')) { die('Bu dosyaya direkt olarak erişmeniz YASAKLANMIŞTIR'); }

// Admin entries
$lang['group_allow_pm']         = 'Permissions to mass PM';
$lang['group_allow_pm_explain'] = 'Select which type of users have the rights to mass PM this group.';
// Profile entries
$lang['Enable_mass_pm']         = 'Notify on mass PM';
$lang['Enable_mass_pm_explain'] = 'Send an email for PM\'s send by admin/mod to the usergroups you belong to';
$lang['No_mass_pm']             = 'No mass PM at all';
// PM box entries
$lang['Mass_pm']                = 'Post mass PM';
// groupmsgs.php entries
$lang['All_admins']             = 'All Administrators';
$lang['All_mods']               = 'All Moderators';
$lang['All_users']              = 'All Users';
$lang['Mass_pm_count']          = '%d users was accepting mass PM, %d have recived a email notifcation'; //%d substituted with the number of recipents, 2'nd %d substituded with the number of notifyed by email
$lang['Mass_pm_not_allowed']    = 'You have no permissions to mass pm any groups';
$lang['No_mass_pm_users']       = '%s , (no users have allowed mass PM)';
$lang['PM_delivered']           = 'Your message has been delivered';
$lang['Pm_mass_users']          = '%s , in total (%d) users ';
$lang['Send_mass_pm']           = 'Send new mass PM to a usergroup';
$lang['To_group']               = 'To usergroup';

?>