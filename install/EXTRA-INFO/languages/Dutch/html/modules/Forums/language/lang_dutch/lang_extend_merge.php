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

global $lang_extend_admin;
{
	$lang['Lang_extend_merge'] = 'Simpel Threads Samenvoegen';
}

$lang['Refresh'] = 'Vernieuwen';
$lang['Merge_topics'] = 'Onderwerpen samenvoegen';
$lang['Merge_title'] = 'Nieuwe onderwerp titel';
$lang['Merge_title_explain'] = 'Dit zal de nieuwe titel zijn van het uiteindelijk onderwerp. Laat dit leeg indien je de titel wil gebruiken van het bestemde onderwerp';
$lang['Merge_topic_from'] = 'Samen te voegen onderwerp';
$lang['Merge_topic_from_explain'] = 'Dit onderwerp zal worden samengevoegd worden met het andere onderwerp. Je kan de onderwerp id ingeven, de url van het onderwerp, of de url van een bericht in dit onderwerp';
$lang['Merge_topic_to'] = 'Bestemde onderwerp';
$lang['Merge_topic_to_explain'] = 'Dit onderwerp zal alle berichten bevatten van het voorgaande onderwerp. Je kan de onderwerp id ingeven, de url van het onderwerp, of de url van een bericht in dit onderwerp';
$lang['Merge_from_not_found'] = 'Het samen te voegen onderwerp kan niet gevonden worden';
$lang['Merge_to_not_found'] = 'Het bestemde onderwerp kan niet gevonden worden';
$lang['Merge_topics_equals'] = 'Je kan geen zelfde onderwerpen samenvoegen';
$lang['Merge_from_not_authorized'] = 'U bent niet bevoegd om onderwerpen te modereren, komende van het forum van het samen te voegen onderwerp';
$lang['Merge_to_not_authorized'] =  'U bent niet bevoegd om onderwerpen te modereren, komende van het forum van het bestemde onderwerp';
$lang['Merge_poll_from'] = 'Er is een peiling in het samen te voegen onderwerp. Het zal gekopieerd worden naar het bestemde onderwerp';
$lang['Merge_poll_from_and_to'] = 'Het bestemde onderwerp heeft reeds een peiling. De peiling van het samen te voegen onderwerp zal verwijderd worden';
$lang['Merge_confirm_process'] = 'Ben je zeker dat je wil samenvoegen <br />"<b>%s</b>"<br />naar<br />"<b>%s</b>"';
$lang['Merge_topic_done'] = 'De onderwerpen zijn succesvol samengevoegd.';

?>