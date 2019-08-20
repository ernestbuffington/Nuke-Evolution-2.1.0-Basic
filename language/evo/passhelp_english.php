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
$pw_help['Header'] = 'Password Strength Help';
$pw_help['Entry']  = 'The purpose of this is to help you create a password that will be stronger and thus harder for hackers to break.  You can of course choose to ignore this as it is only a helpful tool and not a requirement.';
$pw_help['ListHeader'] = 'The password strength meter measures your password strength in the following 5 ways.';
$pw_help['Help1'] = 'Password contains a lowercase letter (a-z)';
$pw_help['Help2'] = 'Password contains a uppercase letter (A-Z)';
$pw_help['Help3'] = 'Password contains a digit (0-9)';
$pw_help['Help4'] = 'Password contains a character that is not a letter or digit (!@#$%^&amp;*)';
$pw_help['Help5'] = 'Password length is at least 10 characters long';

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

?>