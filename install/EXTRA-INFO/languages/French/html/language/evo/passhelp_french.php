<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		#$#BASE
 Nuke-Evo Version       :		#$#VER
 Nuke-Evo Build         :		#$#BUILD
 Nuke-Evo Patch         :		#$#PATCH
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		#$#DATE

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

if(defined('NUKE_EVO')) return;

define('ROOT', dirname(dirname(dirname(__FILE__))) . '/');
require_once(ROOT.'mainfile.php');

$pw_help = array();
$pw_help['Header'] = 'Aide de la force du mot de passe';
$pw_help['Entry']  = 'Le but est de vous aider &agrave; cr&eacute;er un mot de passe qui sera plus fort et donc plus difficile pour les pirates informatiques &agrave; le trouver. Vous pouvez bien s&ucirc;r choisir l\'ignorer car c\'est seulement un outil utile et non une obligation.';
$pw_help['ListHeader'] = 'La mesure de la force de votre passe se fait des 5 fa&ccedil;on suivante.';
$pw_help['Help1'] = 'Mot de passe contient des minuscules (a-z)';
$pw_help['Help2'] = 'Mot de passe contient des majuscules (A-Z)';
$pw_help['Help3'] = 'Mot de passe contient des chiffres (0-9)';
$pw_help['Help4'] = 'Mot de passe contient des caract&egrave;res qui ne sont ni des lettres ni des chiffres (!@#$%^&amp;*)';
$pw_help['Help5'] = 'Mot de passe &eacute;tant au moin de 10 caract&egrave;res de long';

$pagetitle = $pw_help['Header'];
include_once(NUKE_INCLUDE_DIR.'page_header_review.php');
OpenTable();
$output = "<div align='center'>\n";
$output .= "<span class='maintitle'>".$pw_help['Header']."</span><br /><br />\n";
$output .= "<span class='heading1'>".$pw_help['Entry']."</span><br /><br />\n";
$output .= "<span class='genmed'>".$pw_help['ListHeader']."</span><br />\n";
$output .= "<ul style='text-align:left;'>\n";
$output .= "<li>".$pw_help['Help1']."</li>\n";
$output .= "<li>".$pw_help['Help2']."</li>\n";
$output .= "<li>".$pw_help['Help3']."</li>\n";
$output .= "<li>".$pw_help['Help4']."</li>\n";
$output .= "<li>".$pw_help['Help5']."</li>\n";
$output .= "</ul>\n";
$output .= "</div>\n";
echo $output;
CloseTable();
include_once(NUKE_INCLUDE_DIR.'page_tail_review.php');