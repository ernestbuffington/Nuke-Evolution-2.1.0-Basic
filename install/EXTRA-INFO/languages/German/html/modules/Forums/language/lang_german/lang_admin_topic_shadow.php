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
// General
//
$lang['Affected_Rows'] = '%d bekannte Eintr&auml;ge waren betroffen<br />'; // %d = affected rows (not avail with all databases!)
$lang['All_Forums'] = 'Alle Foren';
$lang['Clear'] = 'Leeren';
$lang['Day'] = 'Tag';
$lang['Del_Before_Date'] = 'Alle Shadow-Topics vor dem %s gel&ouml;scht<br />'; // %s = insertion of date
$lang['Delete'] = 'L&ouml;schen';
$lang['Delete_Before_Date_Button'] = 'L&ouml;sche alle vor Datum';
$lang['Delete_From_Date'] = 'Alle Shadow-Topics, die vor dem gew&auml;hlten Datum erstellt wurden, werden gel&ouml;scht.';
$lang['Deleted_Topic'] = 'Shadow-Topic mit der ID %d gel&ouml;scht<br />'; // %d = insertion of topic id
$lang['Month'] = 'Monat';
$lang['Moved_From'] = 'Verschoben von';
$lang['Moved_To'] = 'Verschoben nach';
$lang['No_Shadow_Topics'] = 'Keine Shadow-Topics gefunden.';
$lang['Resync_Ran_On'] = 'Resync lauft auf %s<br />'; // %s = insertion of forum name
$lang['TS_Desc'] = 'Erlaubt das Entfernen von Shadow-Topics ohne die L&ouml;schung des eigentlichen Beitrags. Shadow-Topics werden erzeugt, wenn Du einen Beitrag in ein anderes Forum verschiebst und einen Link im alten Forum hinterl&auml;sst.';
$lang['Title'] = 'Titel';
$lang['Topic_Shadow'] = 'Topic Shadow';
$lang['Version'] = 'Version';
$lang['Year'] = 'Jahr';
//
// Modes
//
$lang['topic_time'] = 'Themen-Zeit';
$lang['topic_title'] = 'Themen-Titel';
//
// Errors
//
$lang['Error_Day'] = 'Der Tag muss zwischen 1 und 31 liegen';
$lang['Error_Month'] = 'Der Monat muss zwischen 1 und 12 liegen';
$lang['Error_Topics_Table'] = 'Fehler beim lesen der Themen-Tabelle';
$lang['Error_Year'] = 'Das Jahr muss zwischen 1970 und 2038 liegen';
//
// Special Cases, Do not change for another language
//
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';

?>