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

$lang['time_mode'] = 'Gestion du temps';
$lang['time_mode_text'] = 'Les param&eacute;trages manuels sont ignor&eacute;s quand un mode automatique est s&eacute;lectionn&eacute; (les 2 premiers n&eacute;cessitent que JavaScript soit activ&eacute;).<br />Pour le mode manuel, le d&eacute;calage de l\'heure d\'&eacute;t&eacute; correspond au d&eacute;calage entre l\'heure d\'&eacute;t&eacute; et l\'heure d\'hiver dans votre pays (de 0 &agrave; 120 minutes).<br /><br />* Le mode rep&eacute;r&eacute; par cet ast&eacute;risque est celui utilis&eacute; par d&eacute;faut sur ce forum et vous est recommand&eacute; par son administrateur.';
$lang['time_mode_auto'] = 'Modes automatiques...';
$lang['time_mode_full_pc'] = 'Heure de votre ordinateur';
$lang['time_mode_server_pc'] = 'Heure universelle du serveur, fuseau horaire<br /><span STYLE="margin-left: 25">et heure d\'&eacute;t&eacute; de votre ordinateur</span>';
$lang['time_mode_full_server'] = 'Heure locale du serveur';
$lang['time_mode_manual'] = 'Mode manuel...';
$lang['time_mode_dst'] = 'Heure d\'&eacute;t&eacute; activ&eacute;e';
$lang['time_mode_dst_server'] = 'Par le serveur';
$lang['time_mode_dst_time_lag'] = 'D&eacute;calage de l\'heure d\'&eacute;t&eacute;';
$lang['time_mode_dst_mn'] = 'mn';
$lang['time_mode_timezone'] = 'Fuseau horaire';

$lang['dst_time_lag_error'] = 'Saisie du d&eacute;calage de l\'heure d\'&eacute;t&eacute; non conforme !<br />Vous devez saisir un nombre de minutes compris entre 0 et 120.';

$lang['dst_enabled_mode'] = ' [heure d\'&eacute;t&eacute; activ&eacute;e]';
$lang['full_server_mode'] = 'Heures synchro sur le serveur du forum';
$lang['server_pc_mode'] = 'Heures synchro sur le serveur - Fuseau & h. d\'&eacute;t&eacute; sur votre ordinateur';
$lang['full_pc_mode'] = 'Heures synchro sur votre ordinateur';

?>