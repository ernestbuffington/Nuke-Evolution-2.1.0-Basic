<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   Basic
 Nuke-Evo Version       :   2.1.0
 Nuke-Evo Build         :   1740
 Nuke-Evo Patch         :   0
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   10-Aug-2010 23:10

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
$lang['time_mode'] = 'Tijd beheer';
$lang['time_mode_text'] = 'Forum instellingen genegeerd wanneer ingesteld op een automatische mode (JavaScript is vereist voor de eerste twee).<br />Voor de manuale mode, het DST verschil is het verschil tussen Daglicht Bewaar Tijd en normale tijd voor jouw land (van 0 tot 120 minuten, normaal 60).<br /><br />* De mode gemarkeerd door het sterretje is de standaard op dit board en wordt aanbevolen door de administrateur.';
$lang['time_mode_auto'] = 'Automatische modes...';
$lang['time_mode_full_pc'] = 'Jouw computer tijd';
$lang['time_mode_server_pc'] = 'Server universele tijd, Tijdzone/DST<br /><span STYLE="margin-left: 25">van jouw computer</span>';
$lang['time_mode_full_server'] = 'Server locale tijd';
$lang['time_mode_manual'] = 'Handmatige mode...';
$lang['time_mode_dst'] = 'DST aangezet';
$lang['time_mode_dst_server'] = 'Door de server';
$lang['time_mode_dst_time_lag'] = 'DST verschil';
$lang['time_mode_dst_mn'] = 'min';
$lang['time_mode_timezone'] = 'Tijdzone';

$lang['dst_time_lag_error'] = 'DST verschil waarde fout. Je moet een aantal minuten typen tusen 0 en 120.';

$lang['dst_enabled_mode'] = ' [DST aangezet]';
$lang['full_server_mode'] = 'Tijd gesynchroniseerd met de forum server tijd';
$lang['server_pc_mode'] = 'Tijd gesynchroniseerd. met de server - Tijdzone/DST met jouw computer';
$lang['full_pc_mode'] = 'Tijd gesynchroniseerd met jouw computer tijd';

?>