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

$lang['dst_enabled_mode'] = ' [DST enabled]';
$lang['dst_time_lag_error'] = 'DST difference value error. You must type a number of minutes between 0 and 120.';
$lang['full_pc_mode'] = 'Time synchronized with your computer time';
$lang['full_server_mode'] = 'Time synchronized with the forum server time';
$lang['server_pc_mode'] = 'Time synchronized with the server - Time zone/DST with your computer';
$lang['time_mode'] = 'Time management';
$lang['time_mode_auto'] = 'Automatic modes...';
$lang['time_mode_dst'] = 'DST enable';
$lang['time_mode_dst_mn'] = 'min';
$lang['time_mode_dst_server'] = 'By the server';
$lang['time_mode_dst_time_lag'] = 'DST difference';
$lang['time_mode_full_pc'] = 'Your computer time';
$lang['time_mode_full_server'] = 'Server local time';
$lang['time_mode_manual'] = 'Manual mode...';
$lang['time_mode_server_pc'] = 'Server universal time, Time zone/DST<br /><span style="margin-left: 25px;">from your computer</span>';
$lang['time_mode_text'] = 'Forum settings ignored when set to an automatic mode (JavaScript is required for the first two).<br />For the manual mode, the DST difference is the difference between Daylight Saving Time and normal time for your country (from 0 to 120 minutes, typically 60).<br /><br />* The mode marked by the asterisk is used by default on this board and is recommended by its administrator.';
$lang['time_mode_timezone'] = 'Time zone';

?>