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

$lang['Archive_Feature'] = 'Archive Feature';
$lang['Archive_Table_Inserted'] = 'Archive Table did not exist, created it<br />';
$lang['Current'] = 'Current';
$lang['Disable'] = 'Disable';
$lang['Enable'] = 'Enable';
$lang['Inline'] = 'Inline';
$lang['Inserted_Default_Value'] = '%s Configuration Item did not exist, inserted a default value<br />'; // %s = config name
$lang['PM_View_Type'] = 'PM View Type';
$lang['Pop_up'] = 'Pop-up';
$lang['Rows_Minus_5'] = 'Remove 5 Rows';
$lang['Rows_Per_Page'] = 'Rows Per Page';
$lang['Rows_Plus_5'] = 'Add 5 Rows';
$lang['Show_IP'] = 'Show IP Address';
$lang['Switch_Archive'] = 'Switch To Archive Mode';
$lang['Switch_Normal'] = 'Switch To Normal Mode';
$lang['Updated_Config'] = 'Updated Configuration Item %s<br />'; // %s = config item
//
// General
//
$lang['Affected_Rows'] = '%d known entries removed<br />';
$lang['Archive'] = 'Archive';
$lang['Archive_Desc'] = 'Private Messages you have chosen to archive are listed here. Users are no longer able to access these (sender and receiver), but you can view or delete them at any time.';
$lang['Archived_Message'] = 'Archived Private Message - %s <br />'; // %s = PM title
$lang['Archived_Message_No_Delete'] = 'Cannot Delete %s, It Was Marked For Archive As Well <br />'; // %s = PM title
$lang['Delete'] = 'Delete';
$lang['Deleted_Message'] = 'Deleted Private Message - %s <br />'; // %s = PM title
$lang['Filter_By'] = 'Filter By';
$lang['From'] = 'From';
$lang['Nivisec_Com'] = 'Nivisec.com';
$lang['No_PMS'] = 'No Private Messages Matching Your Sort Criteria To Display';
$lang['Normal_Desc'] = 'All the Private Messages on your board may be managed here. You can read any you\'d like and choose to delete or archive (keep, but users cannot view) the messages as well.';
$lang['PM_Type'] = 'PM Type';
$lang['Private_Messages'] = 'Private Messages';
$lang['Private_Messages_Archive'] = 'Private Messages Archive';
$lang['Remove_All'] = 'All PMs:</a>&nbsp;<span class="gensmall">CAUTION: Will clear ALL PM\'s</span>';
$lang['Remove_Old'] = 'Orphan PM\'s:</a>&nbsp;<span class="gensmall">Users who no longer exist could have left PM\'s behind, this will remove them.</span>';
$lang['Remove_Sent'] = 'Sent Box PM\'s:</a>&nbsp;<span class="gensmall">PM\'s in the sent box are just copies of the exact same message that was sent, except assigned to the sender after the other user has read the PM. These are not needed really.</span>';
$lang['Removed_All'] = 'Removed All PM\'s<br />';
$lang['Removed_Old'] = 'Removed All Orphan PM\'s<br />';
$lang['Removed_Sent'] = 'Removed All Sent PM\'s<br />';
$lang['Sent_Date'] = 'Sent Date';
$lang['Sort'] = 'Sort';
$lang['Status'] = 'Status';
$lang['Subject'] = 'Subject';
$lang['To'] = 'To';
$lang['Utilities'] = 'Mass Deletion Utilities';
$lang['Version'] = 'Version';
//
// PM Types
//
$lang['PM_-1'] = 'All Types'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'Read PMs'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'New PMs'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'Sent PMs'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'Saved PMs (In)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'Saved PMs (Out)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'Unread PMs'; //PRIVMSGS_UNREAD_MAIL = 5
//
// Errors
//
$lang['Error_Other_Table'] = 'Error querying a required table.';
$lang['Error_Posts_Archive_Table'] = 'Error querying Private Messages Archive table.';
$lang['Error_Posts_Table'] = 'Error querying Private Messages table.';
$lang['Error_Posts_Text_Table'] = 'Error querying Private Messages Text table.';
$lang['No_Message_ID'] = 'No message ID was specified.';
//
// Special Cases, Do not bother to change for another language
//
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['Close_Window'] = 'Close this Window';
$lang['DESC'] = $lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];

?>