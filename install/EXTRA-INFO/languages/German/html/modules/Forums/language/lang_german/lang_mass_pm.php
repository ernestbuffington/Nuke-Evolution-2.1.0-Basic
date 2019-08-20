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
$lang['group_allow_pm']         = 'Berechtigungen f&uuml;r Massen PNs';
$lang['group_allow_pm_explain'] = 'W&auml;hle eine Benutzergruppe aus, die das Recht hat Massen PNs an diese Gruppe zu senden.';
// Profile entries
$lang['Enable_mass_pm']         = 'Benachrichtigung f&uuml;r Massen PNs';
$lang['Enable_mass_pm_explain'] = 'Sende eine eMail f&uuml;r PN\'s, die durch einen Admin/Mod an die Benutzergruppen derer Du angeh&ouml;rst gesendet wurde';
$lang['No_mass_pm']             = 'Keine Massen PN';
// PM box entries
$lang['Mass_pm']                = 'Massen PN schreiben';
// groupmsgs.php entries
$lang['All_admins']             = 'Alle Administratoren';
$lang['All_mods']               = 'Alle Moderatoren';
$lang['All_users']              = 'Alle Benutzer';
$lang['Mass_pm_count']          = '%d Mitglieder akzeptierten die Massen PN, %d haben eine Benachrichtigung per eMail erhalten'; //%d substituted with the number of recipents, 2'nd %d substituded with the number of notifyed by email
$lang['Mass_pm_not_allowed']    = 'Du hast keine Berechtigungen f&uuml;r Massen PNs an irgendwelche Gruppen';
$lang['No_mass_pm_users']       = '%s , (Massen PNs wurden von keinem Mitglied zugelassen )';
$lang['PM_delivered']           = 'Deine Nachricht wurde versendet';
$lang['Pm_mass_users']          = '%s , gesamt (%d) Benutzer ';
$lang['Send_mass_pm']           = 'Eine neue Massen PN an eine Benutzergruppe senden';
$lang['To_group']               = 'an Benutzergruppe';

?>