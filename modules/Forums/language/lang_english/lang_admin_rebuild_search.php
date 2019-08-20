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

$lang['Rebuild_search'] = 'Rebuild Search';
$lang['Rebuild_search_desc'] = 'This mod will index every post in your forum, rebuilding the search tables.
You can stop whenever you like and the next time you run it again you\'ll have the option of continuing from where you left off.<br /><br />
It may take a long time to show its progress (depending on "Posts per cycle" and "Time limit"),
so please do not move from its progress page until it is complete, unless of course you want to interrupt it.';
//
// Input screen
//
$lang['Clear_search_delete'] = 'DELETE';
$lang['Clear_search_no'] = 'NO';
$lang['Clear_search_tables'] = 'Clear search tables';
$lang['Clear_search_tables_explain'] = 'When you start from the beginning you can clear the 3 phpBB search tables<br />You have the option of choosing between the DELETE/TRUNCATE methods';
$lang['Clear_search_truncate'] = 'TRUNCATE';
$lang['Disable_board'] = 'Disable board';
$lang['Disable_board_explain'] = 'Whether or not to disable your board while processing';
$lang['Disable_board_explain_already'] = '<em>Your board is already disabled through the admin configuration</em>';
$lang['Disable_board_explain_enabled'] = 'It will be enabled automatically after the end of processing';
$lang['Fast_mode'] = 'Fast mode';
$lang['Fast_mode_explain'] = 'Process the whole db without removing entries first<br />Use with caution!!! Please read the instructions for details.';
$lang['Max_info'] = '(Max : %d)';
$lang['Num_of_posts'] = 'Number of posts';
$lang['Num_of_posts_explain'] = 'Number of total posts to process<br />It\'s automatically filled with the number of total/remaining posts found in the db';
$lang['Posts_per_cycle'] = 'Posts per cycle';
$lang['Posts_per_cycle_explain'] = 'Number of posts to process per cycle<br />Keep it low to avoid php/webserver timeouts';
$lang['Refresh_rate'] = 'Refresh rate';
$lang['Refresh_rate_explain'] = 'How much time (secs) to stay idle before moving to next processing cycle<br />Usually you don\'t have to change this';
$lang['Start_option_beginning'] = 'start from beginning';
$lang['Start_option_continue'] = 'continue from last stopped';
$lang['Starting_post_id'] = 'Starting post_id';
$lang['Starting_post_id_explain'] = 'First post where processing will begin from<br />You can choose to start from the beginning or from the post you last stopped';
$lang['Time_limit'] = 'Time limit';
$lang['Time_limit_explain'] = 'How much time (secs) post processing can last before moving to next cycle';
$lang['Time_limit_explain_safe'] = '<em>Your php (safe mode) has a timeout of %s secs configured, so stay below this value</em>';
$lang['Time_limit_explain_webserver'] = '<em>Your webserver has a timeout of %s secs configured, so stay below this value</em>';
//
// Information strings
//
$lang['Info_processing_aborted'] = 'You last aborted the processing at post_id %s (%s processed posts) on %s';
$lang['Info_processing_aborted_soon'] = 'Please wait a little before you continue...';
$lang['Info_processing_finished'] = 'You successfully finished the processing (%s processed posts) on %s';
$lang['Info_processing_finished_new'] = 'You successfully finished the processing at post_id %s (%s processed posts) on %s,<br />but there have been %s new post(s) after that date';
$lang['Info_processing_stopped'] = 'You last stopped the processing at post_id %s (%s processed posts) on %s';
//
// Progress screen
//
$lang['Active_parameters'] = 'Active parameters';
$lang['All_posts_processed'] = 'All posts were processed successfully.';
$lang['All_session_posts_processed'] = 'Processed all posts in current session.';
$lang['All_tables_optimized'] = 'All search tables were optimized successfully.';
$lang['Board_disabled'] = 'Disabled';
$lang['Board_enabled'] = 'Enabled';
$lang['Board_status'] = 'Board status';
$lang['Bytes'] = 'Bytes';
$lang['Cleared_search_tables'] = 'Cleared search tables. ';
$lang['Click_return_rebuild_search'] = 'Click %sHere%s to return to Rebuild Search';
$lang['Current_session'] = 'Current Session';
$lang['Database_size_details'] = 'Database size details';
$lang['Deleted_posts'] = '%s post(s) were deleted by your users during processing. ';
$lang['Info_estimated_values'] = '(*) All the estimated values are calculated approximately<br /> based on the current completed percent and may not represent the actual final values.<br /> As the completed percent increases the estimated values will come closer to the actual ones.';
$lang['Percent'] = 'Percent';
$lang['Percent_completed'] = '%s %% completed';
$lang['Posts_last_cycle'] = 'Processed post(s) on last cycle';
$lang['Process_details'] = 'from <strong>%s</strong> to <strong>%s</strong> (out of total <strong>%s</strong>)';
$lang['Processed_post_ids'] = 'Processed post ids : %s - %s';
$lang['Processed_posts'] = 'Processed Posts';
$lang['Processing_next_posts'] = 'Processing next %s post(s). Please wait...';
$lang['Processing_post_details'] = 'Processing post details';
$lang['Processing_time'] = 'Processing time';
$lang['Processing_time_details'] = 'Processing time details';
$lang['Rebuild_search_aborted'] = 'Rebuild search aborted at post_id %s.<br /><br />If you aborted while processing was on, you have to wait a little before you run Rebuild Search again, so the last cycle can finish.';
$lang['Rebuild_search_progress'] = 'Rebuild Search Progress';
$lang['Size_current'] = 'Current';
$lang['Size_database'] = 'Database size';
$lang['Size_estimated'] = 'Estimated after finish';
$lang['Size_search_tables'] = 'Search Tables size';
$lang['Time_average'] = 'Average per cycle of current session';
$lang['Time_estimated'] = 'Estimated until finish of current session';
$lang['Time_from_the_beginning'] = 'From the beginning of current session';
$lang['Time_last_posts'] = 'Last %s post(s) of current session';
$lang['Timer_expired'] = 'Timer expired at %s secs. ';
$lang['Total'] = 'Total';
$lang['Wrong_input'] = 'You have entered some wrong values. Please check your input and try again.';
$lang['days'] = 'days';
$lang['hours'] = 'hours';
$lang['minutes'] = 'minutes';
$lang['seconds'] = 'seconds';
//
// Buttons
//
$lang['Finished'] = 'Finished';
$lang['Next'] = 'Next';
$lang['Processing'] = 'Processing...';

?>