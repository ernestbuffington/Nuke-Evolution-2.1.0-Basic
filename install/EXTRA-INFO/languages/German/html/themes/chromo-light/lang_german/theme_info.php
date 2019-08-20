<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
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

$current_theme = basename(dirname(dirname(__FILE__)));

$param_names = array(
            'Link 1 URL',
            'Link 1 Text',
            'Link 2 URL',
            'Link 2 Text',
            'Link 3 URL',
            'Link 3 Text',
            'Link 4 URL',
            'Link 4 Text',
            'BG Color 1',
            'BG Color 2',
            'BG Color 3',
            'BG Color 4',
            'Text Color 1',
            'Text Color 2'
            );

$params = array(
            'link1',
            'link1text',
            'link2',
            'link2text',
            'link3',
            'link3text',
            'link4',
            'link4text',
            'bgcolor1',
            'bgcolor2',
            'bgcolor3',
            'bgcolor4',
            'textcolor1',
            'textcolor2'
            );

$default = array(
            'index.php',
            'HAUPTSEITE',
            'modules.php?name=Forums',
            'FOREN',
            'modules.php?name=Downloads',
            'DOWNLOADS',
            'modules.php?name=Your_Account',
            'DEIN KONTO',
            '#AAAFB2',
            '#878C92',
            '#F0F0F0',
            '#F3F4FF',
            '#FFFFFF',
            '#D59E00'
            );
global $ThemeInfo;
$ThemeInfo = LoadThemeInfo($current_theme);

?>