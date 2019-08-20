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

$lang['dst_enabled_mode'] = ' [DST aktiviert]';
$lang['dst_time_lag_error'] = 'Fehler beim DST Unterschied. Du musst eine Zahl zwischen 0 und 120 Minuten eingeben.';
$lang['full_pc_mode'] = 'Zeit synchronisiert mit Deiner Computer Zeit';
$lang['full_server_mode'] = 'Zeit mit der Forum-Server-Zeit synchronisiert';
$lang['server_pc_mode'] = 'Zeit synchronisiert mit dem Server - Zeitzone/DST mit Deinem Computer';
$lang['time_mode'] = 'Zeit Management';
$lang['time_mode_auto'] = 'Automatischer Modus...';
$lang['time_mode_dst'] = 'DST aktivieren';
$lang['time_mode_dst_mn'] = 'min';
$lang['time_mode_dst_server'] = 'Durch den Server';
$lang['time_mode_dst_time_lag'] = 'DST Unterschied';
$lang['time_mode_full_pc'] = 'Deine Computer Zeit';
$lang['time_mode_full_server'] = 'Server lokale Zeit';
$lang['time_mode_manual'] = 'Manueller Modus...';
$lang['time_mode_server_pc'] = 'Server Universal Zeit, Zeitzone/DST<br /><span style="margin-left: 25px;">von deinem Computer</span>';
$lang['time_mode_text'] = 'Foren Einstellungen werden ignoriert, wenn in einen automatischen Modus gesetzt (JavaScript ist erforderlich f&uuml;r die ersten zwei).<br />F&uuml;r den manuellen Modus, der DST Unterschied (Daylight Saving Time) ist die Differenz zwischen Sommer-/Winterzeit und der normalen Zeit f&uuml;r dein Land (von 0 bis 120 Minuten, typisch 60).<br /><br />* Der Modus, markiert mit dem Asterisk ist voreingestellt auf diesem Board und wird vom Administrator empfohlen.';
$lang['time_mode_timezone'] = 'Zeitzone';

?>