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

global $lang_extend_admin;

//
// admin part
//
if ( $lang_extend_admin ) {
    $lang['Lang_extend_merge']      = 'Themen zusammen f&uuml;hren';
}
$lang['Merge_confirm_process']      = 'Willst du wirklich <br />"<b>%s</b>"<br />mit<br />"<b>%s</b>" verbinden';
$lang['Merge_from_not_authorized']  = 'Du bist nicht berechtigt, das Forum des zu verbindenden Themas zu moderieren';
$lang['Merge_from_not_found']       = 'Das zu verbindende Thema wurde nicht gefunden';
$lang['Merge_poll_from']            = 'Es gibt eine Umfrage im zu verbindenden Thema, diese wird in\'s Zielthema &uuml;bernommen';
$lang['Merge_poll_from_and_to']     = 'Das Zielthema hat bereits eine Umfrage. Die Umfrage des zu verbindenden Themas wird gel&ouml;scht';
$lang['Merge_title']                = 'Neuer Thementitel';
$lang['Merge_title_explain']        = 'Dies wird der Titel des neu zusammengef&uuml;hrten Themas. Leer lassen, wenn der Titel des Zielthemas verwendet werden soll.';
$lang['Merge_to_not_authorized']    =  'Du bist nicht berechtigt, das Forum des Zielthemas zu moderieren';
$lang['Merge_to_not_found']         = 'Das Zielthema wurde nicht gefunden';
$lang['Merge_topic_done']           = 'Die Themen wurden erfolgreich verbunden.';
$lang['Merge_topic_from']           = 'Zu verbindendes Thema';
$lang['Merge_topic_from_explain']   = 'Dieses Thema wird mit dem anderen verbunden. Du kannst die Themen-ID, die URL des Themas oder die URL eines Beitrages aus dem Thema angeben';
$lang['Merge_topic_to']             = 'Zielthema';
$lang['Merge_topic_to_explain']     = 'Dieses Thema erh&auml;lt alle Beitr&auml;ge des vorhergehenden Themas. Du kannst die Themen-ID, die URL des Themas oder die URL eines Beitrages aus dem Thema angeben';
$lang['Merge_topics']               = 'Themen verbinden';
$lang['Merge_topics_equals']        = 'Du kannst ein Thema nicht mit sich selbst verbinden';
$lang['Refresh']                    = 'Aktualisieren';

?>