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
$lang['Affected_Rows'] = '%d known entries were affected<br />'; // %d = affected rows (not avail with all databases!)
$lang['All_Forums'] = 'All Forums';
$lang['Clear'] = 'Clear';
$lang['Day'] = 'Day';
$lang['Del_Before_Date'] = 'Deleted all Shadow Topics before %s<br />'; // %s = insertion of date
$lang['Delete'] = 'Delete';
$lang['Delete_Before_Date_Button'] = 'Delete All Before Date';
$lang['Delete_From_Date'] = 'All Shadow Topics that were created before the entered date will be removed.';
$lang['Deleted_Topic'] = 'Deleted Shadow Topic %s<br />'; // %s = topic name
$lang['Month'] = 'Month';
$lang['Moved_From'] = 'Moved From';
$lang['Moved_To'] = 'Moved To';
$lang['No_Shadow_Topics'] = 'No Shadow Topics were found.';
$lang['Resync_Ran_On'] = 'Resync Ran On %s<br />'; // %s = insertion of forum name
$lang['TS_Desc'] = 'Allows the removal of shadow topics without the deletion of the actual message.  Shadow topics are created when you move a post to another forum and choose to leave behind a link in the original forum to the new post.';
$lang['Title'] = 'Title';
$lang['Topic_Shadow'] = 'Topic Shadow';
$lang['Version'] = 'Version';
$lang['Year'] = 'Year';
//
// Modes
//
$lang['topic_time'] = 'Topic Time';
$lang['topic_title'] = 'Topic Title';
//
// Errors
//
$lang['Error_Day'] = 'Your input day must be between 1 and 31';
$lang['Error_Month'] = 'Your input month must be between 1 and 12';
$lang['Error_Topics_Table'] = 'Error accessing topics table';
$lang['Error_Year'] = 'Your input year must be between 1970 and 2038';
//
// Special Cases, Do not change for another language
//
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';

?>