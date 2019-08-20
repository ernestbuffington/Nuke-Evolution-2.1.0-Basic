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

//
// admin part
//
$lang['Icons_auth']             = 'Level der Zutrittskontrolle';
$lang['Icons_auth_explain']     = 'Die Icons werden nur den Benutzern angezeigt, die diese Anforderung erf&uuml;llen';
$lang['Icons_confirm_delete']   = 'Bist Du sicher, dass Du diesen Icon l&ouml;schen willst ?';
$lang['Icons_defaults']         = 'Standard Zuordnung';
$lang['Icons_defaults_explain'] = 'Diese Zuordnungen werden bei den Themen verwendet, bei denen kein Icon definiert wurde';
$lang['Icons_delete']           = 'L&ouml;sche ein Icon';
$lang['Icons_delete_explain']   = 'Bitte ein Icon w&auml;hlen, um dieses Icon damit auszutauschen :';
$lang['Icons_error_del_0']      = 'Du kannst nicht das Standard Icon f&uuml;r "leer" l&ouml;schen';
$lang['Icons_error_title']      = 'Der Icon Titel ist leer';
$lang['Icons_icon_key']         = 'Icon';
$lang['Icons_icon_key_explain'] = 'Icon URL oder eine Variable aus der Images Datei. <br />(siehe templates/<i>Dein_Template/dein_template</i>.cfg)';
$lang['Icons_lang_key']         = 'Icon Titel';
$lang['Icons_lang_key_explain'] = 'Der Icon Titel wird angezeigt, wenn der Benutzer seine Maus &uuml;ber das Icon h&auml;lt (Titel oder alt HTML Befehl). Du kannst hier Text verwenden, oder auch eine Variable aus den Sprachdateien verwenden. <br />(siehe language/lang_Deine_Sprache/lang_main.php).';
$lang['Icons_per_row']			= 'Icons pro Zeile';
$lang['Icons_per_row_explain']	= 'Stelle hier die Anzahl an Icons ein, die in einer Zeile in der Posting Ansicht dargestellt werden sollen';
$lang['Icons_settings']			= 'Post Icons';
$lang['Icons_settings_explain'] = 'Hier kannst Du die Post Icons verwalten';
$lang['Image_key_pick_up']      = 'Bildschl&uuml;ssel ausw&auml;hlen';
$lang['Lang_extend_post_icons'] = 'Post Icons';
$lang['Lang_key_pick_up']       = 'Sprachschl&uuml;ssel ausw&auml;hlen';
$lang['Refresh']                = 'Aktualisieren';
$lang['Usage']                  = 'Verwendet';
$lang['post_icon_title']		= 'Nachrichten Icon';
//
// icons
//
$lang['icon_angry']				= 'Grrrr !';
$lang['icon_bad']				= 'Schlecht !';
$lang['icon_calendar']			= 'Kalendar Termin';
$lang['icon_complicity']		= 'Complicity';
$lang['icon_cool']				= 'Cool';
$lang['icon_disgusting']		= 'Beark !';
$lang['icon_fight']				= 'K&auml;mpfet';
$lang['icon_funny']				= 'Witzig';
$lang['icon_great']				= 'Grossartig !';
$lang['icon_idea']				= 'Idee';
$lang['icon_important']			= 'Wichtig';
$lang['icon_impressed']			= 'Oh Ja !';
$lang['icon_loot']				= 'Loot';
$lang['icon_mocker']			= 'Hehehe !';
$lang['icon_none']				= 'Kein Icon';
$lang['icon_note']				= 'Notiz';
$lang['icon_picture']			= 'Bild';
$lang['icon_question']			= 'Frage';
$lang['icon_roleplay']			= 'Rollenspiel';
$lang['icon_sad']				= 'Snif !';
$lang['icon_shocked']			= 'Oooh !';
$lang['icon_warning']			= 'Warnung !';
$lang['icon_winner']			= 'Gniark !';

?>