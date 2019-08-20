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

//General
$lang['Del_Before_Date'] = 'Alle schaduw onderwerpen verwijderd voor %s<br />'; // %s = insertion of date
$lang['Deleted_Topic'] = 'Schaduw onderwerpen verwijderd met ID %d<br />'; // %d = insertion of onderwerp id
$lang['Affected_Rows'] = '%d gekende invoeren zijn behandeld<br />'; // %d = affected rows (not avail with all databases!)
$lang['Delete_From_Date'] = 'Alle schaduw onderwerpen gemaakt voor de ingevoerde datum worden verwijderd.';
$lang['Delete_Before_Date_Button'] = 'Verwijder alle voor datum';
$lang['No_Shadow_Topics'] = 'Er zijn geen schaduw onderwerpen gevonden.';
$lang['Topic_Shadow'] = 'Schaduw onderwerp';
$lang['TS_Desc'] = 'Laat het verwijderen van schaduw onderwerpen toe zonder het verwijderen van het eigenlijk bericht. Schadow onderwerpen worden gemaakt wanneer een onderwerp wordt verplaatst naar een ander forum en je kiest om een link na te laten in het orgineel geplaatst forum.';
$lang['Month'] = 'Maand';
$lang['Day'] = 'Dag';
$lang['Year'] = 'Jaar';
$lang['Clear'] = 'Leeg';
$lang['Resync_Ran_On'] = 'Resync Gedraaid Op %s<br />'; // %s = insertion of forum name
$lang['All_Forums'] = 'Alle Forums';
$lang['Version'] = 'Versie';

$lang['Title'] = 'Titel';
$lang['Moved_To'] = 'Verplaatst naar';
$lang['Moved_From'] = 'Verplaatst van';
$lang['Delete'] = 'Verwijder';

//Modes
$lang['topic_time'] = 'Onderwerp tijd';
$lang['topic_title'] = 'Onderwerp titel';

//Errors
$lang['Error_Month'] = 'Uw opgegeven maand moet tussen de 1 en 12 zijn';
$lang['Error_Day'] = 'Uw opgegeven dag moet tussen de 1 en 31 zijn';
$lang['Error_Year'] = 'Uw opgegeven jaar moet tussen de 1970 en 2038 zijn';
$lang['Error_Topics_Table'] = 'Fout bij het benaderen van de topics tabel';

//Special Cases, Do not change for another language
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';


?>