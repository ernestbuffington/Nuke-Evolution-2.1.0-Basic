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

global $new_username, $board_config, $activate_link;

$lang['DATE_FORMAT'] =  'd M Y'; // This should be changed to the default date format for your language, php date() format
$lang['DIRECTION'] = 'ltr';
$lang['ENCODING'] = 'UTF-8';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Sorry, but only %s can post announcements in this forum.';
$lang['Sorry_auth_delete'] = 'Sorry, but only %s can delete posts in this forum.';
$lang['Sorry_auth_edit'] = 'Sorry, but only %s can edit posts in this forum.';
$lang['Sorry_auth_post'] = 'Sorry, but only %s can post topics in this forum.';
$lang['Sorry_auth_read'] = 'Sorry, but only %s can read topics in this forum.';
$lang['Sorry_auth_reply'] = 'Sorry, but only %s can reply to posts in this forum.';
$lang['Sorry_auth_sticky'] = 'Sorry, but only %s can post sticky messages in this forum.';
$lang['Sorry_auth_vote'] = 'Sorry, but only %s can vote in polls in this forum.';
// These replace the %s in the above strings
$lang['Auth_Administrators'] = '<strong>administrators</strong>';
$lang['Auth_Anonymous_Users'] = '<strong>anonymous users</strong>';
$lang['Auth_Moderators'] = '<strong>moderators</strong>';
$lang['Auth_Registered_Users'] = '<strong>registered users</strong>';
$lang['Auth_Users_granted_access'] = '<strong>users granted special access</strong>';
$lang['Not_Authorised'] = 'Not Authorized';
$lang['Not_Moderator'] = 'You are not a moderator of this forum.';
$lang['You_been_banned'] = 'You have been banned from this forum.<br />Please contact the webmaster or board administrator for more information.';
//
// Common, these terms are used extensively on several pages
//
$lang['1_Day'] = '1 Day';
$lang['1_Month'] = '1 Month';
$lang['1_Year'] = '1 Year';
$lang['2_Weeks'] = '2 Weeks';
$lang['3_Months'] = '3 Months';
$lang['6_Months'] = '6 Months';
$lang['7_Days'] = '7 Days';
$lang['AIM'] = 'AIM Address';
$lang['Admin_panel'] = 'Go to Administration Panel';
$lang['Author'] = 'Author';
$lang['Board_disable'] = 'Sorry, but this board is currently unavailable.  Please try again later.';
$lang['Cancel'] = 'Cancel';
$lang['Category'] = 'Category';
$lang['Click_return_forum'] = 'Click %sHere%s to return to the forum';
$lang['Click_return_group'] = 'Click %sHere%s to return to group information';
$lang['Click_return_login'] = 'Click %sHere%s to try again';
$lang['Click_return_modcp'] = 'Click %sHere%s to return to the Moderator Control Panel';
$lang['Click_return_topic'] = 'Click %sHere%s to return to the topic'; // %s's here are for uris, do not remove!
$lang['Click_view_message'] = 'Click %sHere%s to view your message';
$lang['Confirm'] = 'Confirm';
$lang['Could_not_insert_for'] = 'Could not insert %d for %d';
$lang['Could_not_optain_for'] = 'Could not optain %d for %d';
$lang['Could_not_update'] = 'Could not update %d';
$lang['Disabled'] = 'Disabled';
$lang['Email'] = 'Email';
$lang['Enabled'] = 'Enabled';
$lang['Error'] = 'Error';
$lang['Forum'] = 'Forum';
$lang['Forum_Index'] = '%s Forum Index';  // eg. sitename Forum Index, %s can be removed if you prefer
$lang['Go'] = 'Go';
$lang['Goto_page'] = 'Goto page';
$lang['Hours'] = 'Hours';
$lang['ICQ'] = 'ICQ Number';
$lang['IP_Address'] = 'IP Address';
$lang['Joined'] = 'Joined';
$lang['Jump_to'] = 'Jump to';
$lang['MSNM'] = 'MSN Messenger';
$lang['Message'] = 'Message';
$lang['Next'] = 'Next';
$lang['No'] = 'No';
$lang['Page_of'] = 'Page <strong>%d</strong> of <strong>%d</strong>'; // Replaces with: Page 1 of 2 for example
$lang['Password'] = 'Password';
$lang['Post'] = 'Post';
$lang['Post_new_topic'] = 'Post new topic';
$lang['Posted'] = 'Posted';
$lang['Poster'] = 'Poster';
$lang['Posts'] = 'Posts';
$lang['Preview'] = 'Preview';
$lang['Previous'] = 'Previous';
$lang['Replies'] = 'Replies';
$lang['Reply_to_topic'] = 'Reply to topic';
$lang['Reply_with_quote'] = 'Reply with quote';
$lang['Reset'] = 'Reset';
$lang['Select_forum'] = 'Select a forum';
$lang['Select_username'] = 'Select username';
$lang['Spellcheck'] = 'Spellcheck';
$lang['Submit'] = 'Submit';
$lang['Time'] = 'Time';
$lang['Topic'] = 'Topic';
$lang['Topics'] = 'Topics';
$lang['Username'] = 'Username';
$lang['View_latest_post'] = 'View latest post';
$lang['View_newest_post'] = 'View newest post';
$lang['Views'] = 'Views';
$lang['YIM'] = 'Yahoo Messenger';
$lang['Yes'] = 'Yes';
//
// Email-Extention
//
$lang['HELLO'] = 'Hello';
$lang['NEW_ACCOUNT_ACTIVATE_LINK'] = 'Link: <a href="'. $activate_link . '>'. $activate_link .'</a>';
$lang['NEW_ACCOUNT_OBJECT'] = 'The account owned by ' . $new_username . ' has been deactivated or newly created, you should check the details of this user (if required) and activate it using the following link:';
$lang['REACTIVATE_ACCOUNT_ACTIVATE_LINK'] = 'Link: <a href="'. $activate_link . '>'. $activate_link .'</a>';
$lang['REACTIVATE_ACCOUNT_OBJECT'] = 'Your account on '. $board_config['sitename'] .' has been deactivated, most likely due to changes made to your profile. In order to reactivate your account you must click on the link below:';
//
// Errors (not related to a specific failure on a page)
//
$lang['A_critical_error'] = 'A Critical Error Occurred';
$lang['Action'] = 'Action';
$lang['Admin'] = 'Administrator';
$lang['Admin_reauthenticate'] = 'To administer the board you must re-authenticate yourself.';
$lang['All'] = 'All';
$lang['An_error_occured'] = 'An Error Occurred';
$lang['Announcements'] = 'Announcements';
$lang['BBCode_box_hidden'] = 'Hidden';
$lang['BBcode_box_hide'] = 'Click to Hide Content';
$lang['BBcode_box_view'] = 'Click to View Content';
$lang['Board_Currently_Disabled'] = 'Board is currently disabled';
$lang['Click_return_reports'] = 'Click %shere%s to return to the Report Posts control panel.';
$lang['Close'] = 'Close';
$lang['Close_success'] = 'Reports were Opened/Closed successfully.';
$lang['Close_window'] = 'Close the window';
$lang['Closed'] = 'Closed';
$lang['Closed_by_user_on_date'] = 'Closed by %s on %s';
$lang['Comments'] = 'Comments';
$lang['Comments_explain'] = 'Please write some comments about your report on this specific post.';
$lang['Contract'] = 'Contract';
$lang['Critical_Error'] = 'Critical Error';
$lang['Critical_Information'] = 'Critical Information';
$lang['Delete_Explication'] = 'If a Moderator/Administrator deletes a topic, it will no longer be displayed on the forum and nobody will be able to restore it. <br /><strong>Be careful with this function</strong>';
$lang['Delete_success'] = 'Reports were deleted successfully.';
$lang['Deleting_topic'] = 'Deleting a topic';
$lang['Display'] = 'Display only';
$lang['Edit_Explication'] = 'By editing a post, an Administrator and/or a Moderator can change what a user has written in the post.';
$lang['Editing_topic'] = 'Editing a topic';
$lang['Emails_Allowed_For_Registered_Only'] = 'Please login to see this email';
$lang['Enter_Forum'] = '%senter%s the forums!';
$lang['Error_Check_Num'] = "Invalid check number<br /><br />You will need to register again<br /><br />Click <a href=\"%s\">here</a> to register";
$lang['Expand'] = 'Expand';
$lang['Extra_Info'] = 'Extra Info';
$lang['Forum_advanced_search'] = '%s Advanced Search';
$lang['Forums'] = 'Forums';
$lang['GVideo_link'] = 'Link';
$lang['General_Error'] = 'General Error';
$lang['Get_Registered'] = 'Get %sregistered%s or ';
$lang['Global_Announcements'] = 'Global Announcements';
$lang['Hidden'] = 'Hidden';
$lang['Image_Blocked'] = 'You have chosen to block images.<br />%sEdit Your Profile%s';
$lang['Images_Allowed_For_Registered_Only'] = 'Please login to see this image.';
$lang['Information'] = 'Information';
$lang['Junior'] = 'Junior Admin';
$lang['Last_action_checkbox'] = 'This action was done through the checkbox and drop down menu.';
$lang['Last_action_comments'] = 'Comments from Moderators';
$lang['Last_action_comments_explain'] = 'Please write some comments about your action on this specific report';
$lang['Links_Allowed_For_Registered_Only'] = 'Please login to see this link';
$lang['Lock_Explication'] = 'When a Moderator/Administrator locks a topic, it\'s not possible for a normal user to reply. But Moderators/Administrators can still continue to post.';
$lang['Locking_topic'] = 'Locking a topic';
$lang['Login_Logout'] = 'Login / Logout';
$lang['Look_up_User'] = 'Look up User';
$lang['Max_smilies_per_post'] = 'You can only use maximum %s smiley\'s per post.<br />You have %s smiley\'s too much in use.';
$lang['Messenger'] = 'Messenger';
$lang['Mini_Index'] = 'Forum Index';
$lang['Mod'] = 'Moderator';
$lang['Move_Explication'] = 'If you choose to move a topic, you will be able to send the topic, which is in a forum A, to a forum B. You can also choose to leave a Shadow Topic in the forum A.';
$lang['Move_edit_message'] = 'Edited: <strong>%s</strong> by <strong>%s</strong>';
$lang['Move_lock_message'] = 'Locked: <strong>%s</strong> by <strong>%s</strong>';
$lang['Move_merge_message'] = 'Merged: <strong>%s</strong> by <strong>%s</strong><br />From Topic <strong>%s</strong> (<strong>%s</strong>)';
$lang['Move_move_message'] = 'Moved: <strong>%s</strong> by <strong>%s</strong><br />From <strong>%s</strong> to <strong>%s</strong>';
$lang['Move_split_message'] = 'Splitted: <strong>%s</strong> by <strong>%s</strong><br />From Topic <strong>%s</strong> (<strong>%s</strong>)';
$lang['Move_unlock_message'] = 'Unlocked: <strong>%s</strong> by <strong>%s</strong>';
$lang['Moving_topic'] = 'Moving a topic';
$lang['Newsletter'] = 'Receive Newsletter by Email?';
$lang['No_action_specified'] = 'There is no action specified';
$lang['No_newer_posts'] = 'There are no newer posts in this forum';
$lang['No_older_posts'] = 'There are no older posts in this forum';
$lang['Non_existent_posts'] = 'Found and deleted %s leftover report(s) pointing to non-existent (deleted) posts';
$lang['Offline'] = 'Offline';
$lang['Online'] = 'Online';
$lang['Online_status'] = 'Status';
$lang['Open'] = 'Open';
$lang['Open_quick_reply'] = 'Open Quick Reply Form automatically';
$lang['Opened'] = 'Open';
$lang['Opened_by_user_on_date'] = 'Opened by %s on %s';
$lang['Opt_in'] = 'Opt in to receive emails when a report is submitted';
$lang['Opt_out'] = 'Opt out so you don\'t receive emails when a report is submitted';
$lang['Opt_success'] = 'You have opt out/in successfully.';
$lang['Period'] = 'since <strong>%d</strong> days'; // %d = days
$lang['Post_already_reported'] = 'This post has already been reported.';
$lang['Post_global_announcement'] = 'Global Announcement';
$lang['Post_reported'] = 'Post report submitted successfully.';
$lang['Post_reports_many_cp'] = 'There are %s open Reported Posts';
$lang['Post_reports_none_cp'] = 'There aren\'t any open Reported Posts';
$lang['Post_reports_one_cp'] = 'There is %s open Reported Post';
$lang['Post_review'] = 'Post Review';
$lang['Previous_comments'] = 'Previous comments';
$lang['Quick_Reply'] = 'Quick Reply';
$lang['Quick_reply_mode'] = 'Quick Reply Mode';
$lang['Quick_reply_mode_advanced'] = 'Advanced';
$lang['Quick_reply_mode_basic'] = 'Basic';
$lang['Quick_reply_panel'] = 'Super Quick Reply Mod';
$lang['Quick_search_at'] = 'at';
$lang['Quick_search_for'] = 'Search for';
$lang['Rank_title'] = 'Rank Title';
$lang['Real_Name'] = 'Real Name:';
$lang['Recent_click_return'] = 'Click %shere%s to return to recent site.';
$lang['Recent_days'] = 'Days';
$lang['Recent_first'] = 'started at %s';
$lang['Recent_first_poster'] = ' by %s';
$lang['Recent_last'] = 'Last';
$lang['Recent_last24'] = 'Last 24 Hours';
$lang['Recent_lastXdays'] = 'Last %s days';
$lang['Recent_lastweek'] = 'Last Week';
$lang['Recent_no_topics'] = 'No topics were found.';
$lang['Recent_select_mode'] = 'Select mode:';
$lang['Recent_showing_posts'] = 'Showing Posts:';
$lang['Recent_title_last24'] = ' from the last 24 hours';
$lang['Recent_title_lastXdays'] = ' from the last %s days'; // %s = days
$lang['Recent_title_lastweek'] = ' from the last week';
$lang['Recent_title_more'] = '<font size="4">%s</font> topics %s'; // %s = topics; %s = sort method
$lang['Recent_title_one'] = '<font size="4">%s</font> topic %s'; // %s = topics; %s = sort method
$lang['Recent_title_today'] = ' from today';
$lang['Recent_title_yesterday'] = ' from yesterday';
$lang['Recent_today'] = 'Today';
$lang['Recent_topics'] = 'Recent Topics';
$lang['Recent_wrong_mode'] = 'You have selected a wrong mode.';
$lang['Recent_yesterday'] = 'Yesterday';
$lang['Report_comment'] = 'Comments regarding your action';
$lang['Report_email'] = 'Send Email when Post Reported';
$lang['Report_not_selected'] = 'You haven\'t selected any reports.';
$lang['Report_post'] = 'Report Post';
$lang['Reporter'] = 'Reporter';
$lang['Rules'] = 'Board Rules';
$lang['Rules_title'] = 'Action : %s';
$lang['Search_subject_only'] = 'Search message subject only';
$lang['Select'] = 'Select';
$lang['Select_one'] = 'Select One';
$lang['Show_avatars'] = 'Show Avatars in Topic';
$lang['Show_hide_quick_reply_form'] = 'Show/hide quick reply form';
$lang['Show_quick_reply'] = 'Show Quick Reply Form';
$lang['Show_signatures'] = 'Show Signatures in Topic';
$lang['Split_Explication'] = 'Splitting a topic which has a lot of pages gives you the ability to keep your topics more organized.';
$lang['Spliting_topic'] = 'Splitting a topic';
$lang['Staff'] = 'Staff';
$lang['Status'] = 'Status';
$lang['Status_locked']   = 'Locked';
$lang['Status_unlocked'] = 'Unlocked';
$lang['Sticky_Topics'] = 'Sticky Topics';
$lang['Super'] = 'Super Moderator';
$lang['Theme'] = 'Theme';
$lang['Topic_global_announcement']='<strong>Global Announcement:</strong>';
$lang['Unlock_Explication'] = 'A Moderator/Administrator can unlock a topic which has been locked. This will allow all users to continue to post in the thread.';
$lang['Unlocking_topic'] = 'Unlocking a topic';
$lang['Version_check'] = 'Check for newest version';
$lang['View_next_post'] = 'View next Post';
$lang['View_post'] = 'View Post';
$lang['View_post_reports'] = 'List of reported Posts';
$lang['View_previous_post'] = 'View previous Post';
$lang['Welcome_PM'] = 'Set as the Welcome PM';
$lang['Welcome_PM_Admin'] = 'Welcome PM';
$lang['Welcome_PM_Set'] = 'Your Welcome PM has been set';
$lang['XData_error_obtaining_group_data'] = 'Error obtaining group data';
$lang['XData_error_obtaining_new_field_info'] = 'Could not get field_order and field_id for new field.';
$lang['XData_error_obtaining_user_xdata'] = 'Error obtaining user\'s XData';
$lang['XData_error_obtaining_userdata'] = 'Error while finding  a user\'s XData field to edit it';
$lang['XData_error_obtaining_usergroup'] = 'Error obtaining usergroup';
$lang['XData_error_updating_auth'] = 'Error updating auth table';
$lang['XData_error_updating_fields'] = 'Error updating field table';
$lang['XData_failure_inserting_data'] = 'Failure to add specefied data';
$lang['XData_failure_obtaining_field_auth'] = 'Error obtaining field auths';
$lang['XData_failure_obtaining_field_data'] = 'Error obtaining field data';
$lang['XData_failure_obtaining_user_auth'] = 'Error obtaining auth for user';
$lang['XData_failure_removing_data'] = 'Failure to remove specefied data';
$lang['XData_field_non_existant'] = 'Field does not exist';
$lang['XData_invalid'] = 'The value you entered for %s is invalid.';
$lang['XData_no_field_selected'] = 'You have not selected a field';
$lang['XData_success_updating_permissions'] = "Permissions updated successfully <br /><br /> Click %shere%s to return to Field Permissions <br /><br />";
$lang['XData_too_long'] = 'Your %s is too long.';
$lang['XData_unable_to_switch_fields'] = 'Unable to switch fields';
$lang['false'] = 'False';
$lang['glance_show'] = 'Show At a Glance (Recent Topics)<br />';
$lang['is_hidden'] = '%s is hidden';
$lang['is_offline'] = '%s is offline';
$lang['is_online'] = '%s is online now';
$lang['show_glance_option']['0'] = 'None';
$lang['show_glance_option']['1'] = 'All';
$lang['show_glance_option']['10'] = 'Index, Category and Forum';
$lang['show_glance_option']['2'] = 'Index Only';
$lang['show_glance_option']['3'] = 'Forums Only';
$lang['show_glance_option']['4'] = 'Topics Only';
$lang['show_glance_option']['5'] = 'Index and Topics';
$lang['show_glance_option']['6'] = 'Index and Forums';
$lang['show_glance_option']['7'] = 'Forums and Topics';
$lang['show_glance_option']['8'] = 'Category Only';
$lang['show_glance_option']['9'] = 'Index and Category';
$lang['sig_current'] = 'Current Signature';
$lang['sig_description'] = 'Edit Signature (<strong>Preview included</strong>)';
$lang['sig_edit'] = 'Edit Signature';
$lang['sig_none'] = 'No Signature available';
$lang['sig_save'] = 'Save';
$lang['sig_save_message'] = 'Signature saved successful !';
$lang['sqr']['0'] = 'No';
$lang['sqr']['1'] = 'Yes';
$lang['sqr']['2'] = 'On last page only';
$lang['topic_glance_priority'] = 'Cement this topic on the Recent Topics Display';
$lang['true'] = 'True';
$lang['user_hide_images'] = 'Hide Images in Forums';
$lang['youtube_link'] = 'Link';
//
// FAQ & Rules
//
$lang['BBCode_attach'] = 'Attachment Guide';
$lang['BBCode_rules'] = 'Code Of Conduct';
$lang['Edit_Profile_Menu_title'] = 'Edit Profile';
$lang['dhtml_faq_noscript'] = "It appears that your browser does not support javascript or it has been disabled in your browser's settings.<br /><br />Please, click %sHERE%s to view a plain HTML version.";
$lang['panel_feel']['0'] = 'Off';
$lang['panel_feel']['1'] = 'Right';
$lang['panel_feel']['2'] = 'Left';
//
// Global Header strings
//
$lang['Admin_online_color'] = '%sAdministrator%s';
$lang['BBCode_guide'] = 'BBCode Guide';
$lang['Browsing_forum'] = 'Users browsing this forum:';
$lang['Current_time'] = 'The time now is %s'; // %s replaced by time
$lang['Edit_profile'] = 'Edit your profile';
$lang['FAQ'] = 'Forum FAQ';
$lang['Guest_user_total'] = '%d Guest';
$lang['Guest_users_total'] = '%d Guests';
$lang['Guest_users_zero_total'] = '0 Guests';
$lang['Hidden_user_total'] = '%d Hidden and ';
$lang['Hidden_users_total'] = '%d Hidden and ';
$lang['Hidden_users_zero_total'] = '0 Hidden and ';
$lang['Last_Post'] = 'Last Post';
$lang['Memberlist'] = 'Members';
$lang['Mod_online_color'] = '%sModerator%s';
$lang['Moderator'] = 'Moderator';
$lang['Moderators'] = 'Moderators';
$lang['Online_user_total'] = 'In total there is <strong>%d</strong> user online :: ';
$lang['Online_users_total'] = 'In total there are <strong>%d</strong> users online :: ';
$lang['Online_users_zero_total'] = 'In total there are <strong>0</strong> users online :: ';
$lang['Profile'] = 'Profile';
$lang['Record_online_users'] = 'Most users ever online was <strong>%s</strong> on %s'; // first %s = number of users, second %s is the date.
$lang['Reg_user_total'] = '%d Registered, ';
$lang['Reg_users_total'] = '%d Registered, ';
$lang['Reg_users_zero_total'] = '0 Registered, ';
$lang['Register'] = 'Register';
$lang['Registered_users'] = 'Registered Users:';
$lang['Search'] = 'Search';
$lang['Search_new'] = 'View posts since last visit';
$lang['Search_unanswered'] = 'View unanswered posts';
$lang['Search_your_posts'] = 'View your posts';
$lang['Statistics'] = 'Statistics';
$lang['Usergroups'] = 'Usergroups';
$lang['Viewonline'] = 'Who is online';
$lang['You_last_visit'] = 'You last visited on %s'; // %s replaced by date/time
$lang['rmw_image_title'] = 'Click to view full-size';
//
// Group control panel
//
$lang['Add_member'] = 'Add Member';
$lang['Already_member_group'] = 'You are already a member of this group';
$lang['Approve_selected'] = 'Approve Selected';
$lang['Are_group_moderator'] = 'You are the group moderator';
$lang['Confirm_unsub'] = 'Are you sure you want to unsubscribe from this group?';
$lang['Confirm_unsub_pending'] = 'Your subscription to this group has not yet been approved; are you sure you want to unsubscribe?';
$lang['Could_not_add_user'] = 'The user you selected does not exist.';
$lang['Could_not_anon_user'] = 'You cannot make Anonymous a group member.';
$lang['Current_memberships'] = 'Current memberships';
$lang['Deny_selected'] = 'Deny Selected';
$lang['Group_Control_Panel'] = 'Group Control Panel';
$lang['Group_Information'] = 'Group Information';
$lang['Group_Members'] = 'Group Members';
$lang['Group_Moderator'] = 'Group Moderator';
$lang['Group_added'] = 'You have been added to this usergroup.';
$lang['Group_approved'] = 'Your request has been approved.';
$lang['Group_closed'] = 'Closed group';
$lang['Group_description'] = 'Group description';
$lang['Group_hidden'] = 'Hidden group';
$lang['Group_hidden_members'] = 'This group is hidden; you cannot view its membership';
$lang['Group_joined'] = 'You have successfully subscribed to this group.<br />You will be notified when your subscription is approved by the group moderator.';
$lang['Group_member_details'] = 'Group Membership Details';
$lang['Group_member_join'] = 'Join a Group';
$lang['Group_membership'] = 'Group membership';
$lang['Group_name'] = 'Group name';
$lang['Group_not_exist'] = 'That user group does not exist';
$lang['Group_open'] = 'Open group';
$lang['Group_request'] = 'A request to join your group has been made.';
$lang['Group_type'] = 'Group type';
$lang['Group_type_updated'] = 'Successfully updated group type.';
$lang['Groups'] = 'Groups';
$lang['Join_auto'] = 'You may join this group, since your post count meet the group criteria';
$lang['Join_group'] = 'Join Group';
$lang['Login_to_join'] = 'Log in to join or manage group memberships';
$lang['Member_this_group'] = 'You are a member of this group';
$lang['Memberships_pending'] = 'Memberships pending';
$lang['No_add_allowed'] = 'automatic user addition is not allowed';
$lang['No_group_members'] = 'This group has no members';
$lang['No_groups_exist'] = 'No Groups Exist';
$lang['No_more'] = 'no more users accepted';
$lang['No_pending_group_members'] = 'This group has no pending members';
$lang['Non_member_groups'] = 'Non-member groups';
$lang['None'] = 'None';
$lang['Not_group_moderator'] = 'You are not this group\'s moderator, therefore you cannot perform that action.';
$lang['Not_logged_in'] = 'You must be logged in to join a group.';
$lang['Pending_members'] = 'Pending Members';
$lang['Pending_this_group'] = 'Your membership of this group is pending';
$lang['Remove_selected'] = 'Remove Selected';
$lang['Subscribe'] = 'Subscribe';
$lang['This_closed_group'] = 'This is a closed group: %s';
$lang['This_hidden_group'] = 'This is a hidden group: %s';
$lang['This_open_group'] = 'This is an open group: click to request membership';
$lang['Unsub_success'] = 'You have been un-subscribed from this group.';
$lang['Unsubscribe'] = 'Unsubscribe';
$lang['User_is_member_group'] = 'User is already a member of this group';
$lang['View_Information'] = 'View Information';
//
// Index page
//
$lang['Forums_marked_read'] = 'All forums have been marked read';
$lang['Index'] = 'Index';
$lang['Mark_all_forums'] = 'Mark all forums read';
$lang['No_Posts'] = 'No Posts';
$lang['No_forums'] = 'This board has no forums';
$lang['Private_Message'] = 'Private Message';
$lang['Private_Messages'] = 'Private Messages';
$lang['Who_is_Online'] = 'Who is Online';
//
// Login
//
$lang['Enter_password'] = 'Please enter your username and password to log in.';
$lang['Error_login'] = 'You have specified an incorrect or inactive username, or an invalid password.';
$lang['Forgotten_password'] = 'I forgot my password';
$lang['Log_me_in'] = 'Log me on automatically each visit';
$lang['Login'] = 'Log in';
$lang['Logout'] = 'Log out';
$lang['Wrong Security Code'] = 'The Security Code entered doesn\'t match';
//
// Memberslist
//
$lang['Order'] = 'Order';
$lang['Select_sort_method'] = 'Select sort method';
$lang['Sort'] = 'Sort';
$lang['Sort_Ascending'] = 'Ascending';
$lang['Sort_Descending'] = 'Descending';
$lang['Sort_Email'] = 'Email';
$lang['Sort_Joined'] = 'Joined Date';
$lang['Sort_Location'] = 'Location';
$lang['Sort_Posts'] = 'Total posts';
$lang['Sort_Top_Ten'] = 'Top Ten Posters';
$lang['Sort_Username'] = 'Username';
$lang['Sort_Website'] = 'Website';
//
// Moderator Control Panel
//
$lang['Confirm_delete_topic'] = 'Are you sure you want to remove the selected topic/s?';
$lang['Confirm_lock_topic'] = 'Are you sure you want to lock the selected topic/s?';
$lang['Confirm_move_topic'] = 'Are you sure you want to move the selected topic/s?';
$lang['Confirm_unlock_topic'] = 'Are you sure you want to unlock the selected topic/s?';
$lang['Delete'] = 'Delete';
$lang['IP_info'] = 'IP Information';
$lang['Leave_shadow_topic'] = 'Leave shadow topic in old forum.';
$lang['Lock'] = 'Lock';
$lang['Lookup_IP'] = 'Look up IP address';
$lang['Mod_CP'] = 'Moderator Control Panel';
$lang['Mod_CP_explain'] = 'Using the form below you can perform mass moderation operations on this forum. You can lock, unlock, move, delete or prioritise any number of topics.';
$lang['Move'] = 'Move';
$lang['Move_to_forum'] = 'Move to forum';
$lang['New_forum'] = 'New forum';
$lang['No_Topics_Moved'] = 'No topics were moved.';
$lang['None_selected'] = 'You have not selected any topics to perform this operation on. Please go back and select at least one.';
$lang['Other_IP_this_user'] = 'Other IP addresses this user has posted from';
$lang['Prioritize'] = 'Prioritize';
$lang['Priority'] = 'Priority';
$lang['Select'] = 'Select';
$lang['Split_Topic'] = 'Split Topic Control Panel';
$lang['Split_Topic_explain'] = 'Using the form below you can split a topic in two, either by selecting the posts individually or by splitting at a selected post';
$lang['Split_after'] = 'Split from selected post';
$lang['Split_forum'] = 'Forum for new topic';
$lang['Split_posts'] = 'Split selected posts';
$lang['Split_title'] = 'New topic title';
$lang['This_posts_IP'] = 'IP address for this post';
$lang['Too_many_error'] = 'You have selected too many posts. You can only select one post to split a topic after!';
$lang['Topic_split'] = 'The selected topic has been split successfully';
$lang['Topics_Locked'] = 'The selected topics have been locked.';
$lang['Topics_Moved'] = 'The selected topics have been moved.';
$lang['Topics_Prioritized'] = 'The selected topics have been prioritized.';
$lang['Topics_Removed'] = 'The selected topics have been successfully removed from the database.';
$lang['Topics_Unlocked'] = 'The selected topics have been unlocked.';
$lang['Unlock'] = 'Unlock';
$lang['Users_this_IP'] = 'Users posting from this IP address';
//
// Posting/Replying (Not private messaging!)
//
$lang['Add_option'] = 'Add option';
$lang['Add_poll'] = 'Add a Poll';
$lang['Add_poll_explain'] = 'If you do not want to add a poll to your topic, leave the fields blank.';
$lang['Already_voted'] = 'You have already voted in this poll.';
$lang['Attach_signature'] = 'Attach signature (signatures can be changed in profile)';
$lang['BBCode_is_OFF'] = '%sBBCode%s is <u>OFF</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s is <u>ON</u>'; // %s are replaced with URI pointing to FAQ
$lang['Cannot_delete_poll'] = 'Sorry, but you cannot delete an active poll.';
$lang['Cannot_delete_replied'] = 'Sorry, but you may not delete posts that have been replied to.';
$lang['Confirm_delete'] = 'Are you sure you want to delete this post?';
$lang['Confirm_delete_poll'] = 'Are you sure you want to delete this poll?';
$lang['Days'] = 'Days'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Delete'] = 'Delete';
$lang['Delete_own_posts'] = 'Sorry, but you can only delete your own posts.';
$lang['Delete_poll'] = 'Delete Poll';
$lang['Deleted'] = 'Your message has been deleted successfully.';
$lang['Disable_BBCode_post'] = 'Disable BBCode in this post';
$lang['Disable_HTML_post'] = 'Disable HTML in this post';
$lang['Disable_Smilies_post'] = 'Disable Smilies in this post';
$lang['Edit_Post'] = 'Edit post';
$lang['Edit_own_posts'] = 'Sorry, but you can only edit your own posts.';
$lang['Emoticons'] = 'Emoticons';
$lang['Empty_message'] = 'You must enter a message when posting.';
$lang['Empty_poll_title'] = 'You must enter a title for your poll.';
$lang['Empty_subject'] = 'You must specify a subject when posting a new topic.';
$lang['Flood_Error'] = 'You cannot make another post so soon after your last; please try again in a short while.';
$lang['Forum_locked'] = 'This forum is locked: you cannot post, reply to, or edit topics.';
$lang['HTML_is_OFF'] = 'HTML is <u>OFF</u>';
$lang['HTML_is_ON'] = 'HTML is <u>ON</u>';
$lang['Message_body'] = 'Message body';
$lang['No_post_id'] = 'You must select a post to edit';
$lang['No_post_mode'] = 'No post mode specified'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)
$lang['No_such_post'] = 'There is no such post. Please return and try again.';
$lang['No_topic_id'] = 'You must select a topic to reply to';
$lang['No_valid_mode'] = 'You can only post, reply, edit, or quote messages. Please return and try again.';
$lang['No_vote_option'] = 'You must specify an option when voting.';
$lang['Notify'] = 'Notify me when a reply is posted';
$lang['Options'] = 'Options';
$lang['Poll_delete'] = 'Your poll has been deleted successfully.';
$lang['Poll_for'] = 'Run poll for';
$lang['Poll_for_explain'] = '[ Enter 0 or leave blank for a never-ending poll ]';
$lang['Poll_option'] = 'Poll option';
$lang['Poll_question'] = 'Poll question';
$lang['Poll_view_toggle'] = 'Allow View';
$lang['Poll_view_toggle_explain'] = '[ Allows user to see results before voting. ]';
$lang['Post_Announcement'] = 'Announcement';
$lang['Post_Normal'] = 'Normal';
$lang['Post_Sticky'] = 'Sticky';
$lang['Post_a_new_topic'] = 'Post a new topic';
$lang['Post_a_reply'] = 'Post a reply';
$lang['Post_has_no_poll'] = 'This post has no poll.';
$lang['Post_topic_as'] = 'Post topic as';
$lang['Smilies_are_OFF'] = 'Smiley\'s are <u>OFF</u>';
$lang['Smilies_are_ON'] = 'Smiley\'s are <u>ON</u>';
$lang['Stored'] = 'Your message has been entered successfully.';
$lang['To_few_poll_options'] = 'You must enter at least two poll options.';
$lang['To_many_poll_options'] = 'You have tried to enter too many poll options.';
$lang['Topic_locked'] = 'This topic is locked: you cannot edit posts or make replies.';
$lang['Topic_reply_notification'] = 'Topic Reply Notification';
$lang['Topic_review'] = 'Topic review';
$lang['Update'] = 'Update';
$lang['Vote_cast'] = 'Your vote has been cast.';
$lang['glance_news_heading'] = 'Latest Site News';
$lang['glance_next'] = 'Next';
$lang['glance_none'] = 'None News';
$lang['glance_previous'] = 'Previous';
$lang['glance_recent_heading'] = 'Recent Topics';
//
// Private Messaging
//
$lang['All_Messages'] = 'All Messages';
$lang['Cannot_send_privmsg'] = 'Sorry, but the administrator has prevented you from sending private messages.';
$lang['Click_return_inbox'] = 'Click %sHere%s to return to your Inbox';
$lang['Click_return_index'] = 'Click %sHere%s to return to the Index';
$lang['Click_return_profile'] = 'Click %sHere%s to return to your Profile';
$lang['Click_view_privmsg'] = 'Click %sHere%s to visit your Inbox';
$lang['Confirm_delete_pm'] = 'Are you sure you want to delete this message?';
$lang['Confirm_delete_pms'] = 'Are you sure you want to delete these messages?';
$lang['Date'] = 'Date';
$lang['Delete_all'] = 'Delete All';
$lang['Delete_marked'] = 'Delete Marked';
$lang['Delete_message'] = 'Delete Message';
$lang['Disable_BBCode_pm'] = 'Disable BBCode in this message';
$lang['Disable_HTML_pm'] = 'Disable HTML in this message';
$lang['Disable_Smilies_pm'] = 'Disable Smiley\'s in this message';
$lang['Display_messages'] = 'Display messages from previous'; // Followed by number of days/weeks/months
$lang['Edit_message'] = 'Edit private message';
$lang['Edit_pm'] = 'Edit message';
$lang['Find'] = 'Find';
$lang['Find_username'] = 'Find a username';
$lang['Flag'] = 'Flag';
$lang['From'] = 'From';
$lang['Inbox'] = 'Inbox';
$lang['Inbox_size'] = 'Your Inbox is %d%% full'; // eg. Your Inbox is 50% full
$lang['Login_check_pm'] = 'Log in to check your private messages';
$lang['Mark'] = 'Mark';
$lang['Mark_all'] = 'Mark all';
$lang['Message_sent'] = 'Your message has been sent.';
$lang['New_pm'] = '%d new message'; // You have 1 new message
$lang['New_pms'] = '%d new messages'; // You have 2 new messages
$lang['No_folder'] = 'No folder specified';
$lang['No_match'] = 'No matches found.';
$lang['No_messages_folder'] = 'You have no messages in this folder';
$lang['No_new_pm'] = 'No new messages';
$lang['No_post_id'] = 'No post ID was specified';
$lang['No_such_folder'] = 'No such folder exists';
$lang['No_such_user'] = 'Sorry, but no such user exists.';
$lang['No_to_user'] = 'You must specify a username to whom to send this message.';
$lang['No_unread_pm'] = 'No unread messages';
$lang['Notification_subject'] = 'New Private Message has arrived!';
$lang['Outbox'] = 'Outbox';
$lang['PM_disabled'] = 'Private messaging has been disabled on this board.';
$lang['Post_new_pm'] = 'Post message';
$lang['Post_quote_pm'] = 'Quote message';
$lang['Post_reply_pm'] = 'Reply to message';
$lang['Private_Messaging'] = 'Private Messaging';
$lang['Read_message'] = 'Read message';
$lang['Read_pm'] = 'Read message';
$lang['Save_marked'] = 'Save Marked';
$lang['Save_message'] = 'Save Message';
$lang['Savebox'] = 'Savebox';
$lang['Savebox_size'] = 'Your Savebox is %d%% full';
$lang['Saved'] = 'Saved';
$lang['Send_a_new_message'] = 'Send a new private message';
$lang['Send_a_reply'] = 'Reply to a private message';
$lang['Sent'] = 'Sent';
$lang['Sentbox'] = 'Sentbox';
$lang['Sentbox_size'] = 'Your Sentbox is %d%% full';
$lang['Subject'] = 'Subject';
$lang['To'] = 'To';
$lang['Unmark_all'] = 'Unmark all';
$lang['Unread_message'] = 'Unread message';
$lang['Unread_pm'] = '%d unread message';
$lang['Unread_pms'] = '%d unread messages';
$lang['You_new_pm'] = '%d new private message';// You have 1 new message
$lang['You_new_pms'] = '%d new private messages';// You have 2 new messages
$lang['You_no_new_pm'] = 'No new private messages';
//
// Profiles/Registration
//
$lang['About_user'] = 'All about %s'; // %s is username
$lang['Account_activated_subject'] = 'Account Activated';
$lang['Account_active'] = 'Your account has now been activated. Thank you for registering';
$lang['Account_active_admin'] = 'The account has now been activated';
$lang['Account_added'] = 'Thank you for registering. Your account has been created. You may now log in with your username and password';
$lang['Account_inactive'] = 'Your account has been created. However, this forum requires account activation. An activation key has been sent to the e-mail address you provided. Please check your e-mail for further information';
$lang['Account_inactive_admin'] = 'Your account has been created. However, this forum requires account activation by the administrator. An e-mail has been sent to them and you will be informed when your account has been activated';
$lang['Agree_not'] = 'I do not agree to these terms';
$lang['Agree_over_13'] = 'I Agree to these terms and am <strong>over</strong> or <strong>exactly</strong> 13 years of age';
$lang['Agree_under_13'] = 'I Agree to these terms and am <strong>under</strong> 13 years of age';
$lang['Already_activated'] = 'You have already activated your account';
$lang['Always_add_sig'] = 'Always attach my signature';
$lang['Always_bbcode'] = 'Always allow BBCode';
$lang['Always_html'] = 'Always allow HTML';
$lang['Always_notify'] = 'Always notify me of replies';
$lang['Always_notify_explain'] = 'Sends an e-mail when someone replies to a topic you have posted in. This can be changed whenever you post.';
$lang['Always_smile'] = 'Always enable Smiley\'s';
$lang['Avatar'] = 'Avatar';
$lang['Avatar_URL'] = 'URL of Avatar Image';
$lang['Avatar_explain'] = 'Displays a small graphic image below your details in posts. Only one image can be displayed at a time. The dimensions of the image are restricted to a maximum of %d pixels wide, and %d pixels high. Uploaded avatars have a file size limit of %d KB, and must be less than or equal to the maximum dimensions. Remotely hosted avatars will be automatically scaled to fit these dimensions.';
$lang['Avatar_filesize'] = 'The avatar image file size must be less than %d KB'; // The avatar image file size must be less than 6 KB
$lang['Avatar_filetype'] = 'The avatar filetype must be .jpg, .gif or .png';
$lang['Avatar_gallery'] = 'Avatar gallery';
$lang['Avatar_imagesize'] = 'The avatar must be less than %d pixels wide and %d pixels high';
$lang['Avatar_panel'] = 'Avatar control panel';
$lang['Board_lang'] = 'Board Language';
$lang['Board_style'] = 'Board Style';
$lang['CC_email'] = 'Send a copy of this e-mail to yourself';
$lang['COPPA'] = 'Your account has been created but has to be approved. Please check your e-mail for details.';
$lang['Confirm_password'] = 'Confirm password';
$lang['Confirm_password_explain'] = 'You must confirm your current password if you wish to change it or alter your e-mail address';
$lang['Contact'] = 'Contact';
$lang['Current_Image'] = 'Current Image';
$lang['Current_password'] = 'Current password';
$lang['Current_password_mismatch'] = 'The current password you supplied does not match that stored in the database.';
$lang['Date_format'] = 'Date format';
$lang['Date_format_explain'] = 'The syntax used is identical to the PHP <a href=\'http://www.php.net/date\' onclick=\'window.open(this.href,\"_blank\"); return false;\'>date()</a> function.';
$lang['Delete_Image'] = 'Delete Image';
$lang['Email_address'] = 'E-mail address';
$lang['Email_banned'] = 'Sorry, but this e-mail address has been banned.';
$lang['Email_invalid'] = 'Sorry, but this e-mail address is invalid.';
$lang['Email_message_desc'] = 'This message will be sent as plain text, so do not include any HTML or BBCode. The return address for this message will be set to your e-mail address.';
$lang['Email_sent'] = 'The e-mail has been sent.';
$lang['Email_taken'] = 'Sorry, but that e-mail address is already registered to a user.';
$lang['Empty_message_email'] = 'You must enter a message to be e-mailed.';
$lang['Empty_subject_email'] = 'You must specify a subject for the e-mail.';
$lang['Fields_empty'] = 'You must fill in the required fields.';
$lang['File_no_data'] = 'The file at the URL you gave contains no data';
$lang['Flood_email_limit'] = 'You cannot send another e-mail at this time. Try again later.';
$lang['Hidden_email'] = '[ Hidden ]';
$lang['Hide_user'] = 'Hide your online status';
$lang['Incomplete_URL'] = 'The URL you entered is incomplete';
$lang['Interests'] = 'Interests';
$lang['Items_required'] = 'Items marked with a * are required unless stated otherwise.';
$lang['Link_remote_Avatar'] = 'Link to off-site Avatar';
$lang['Link_remote_Avatar_explain'] = 'Enter the URL of the location containing the Avatar image you wish to link to.';
$lang['Location'] = 'Location';
$lang['Login_attempts_exceeded'] = 'The maximum number of %s login attempts has been exceeded. You are not allowed to login for the next %s minutes.';
$lang['New_account_subject'] = 'New user account';
$lang['New_password'] = 'New password';
$lang['New_password_activation'] = 'New password activation';
$lang['No_connection_URL'] = 'A connection could not be made to the URL you gave';
$lang['No_email_match'] = 'The e-mail address you supplied does not match the one listed for that username.';
$lang['No_send_account_inactive'] = 'Sorry, but your password cannot be retrieved because your account is currently inactive. Please contact the forum administrator for more information.';
$lang['No_themes'] = 'No Themes In database';
$lang['No_user_id_specified'] = 'Sorry, but that user does not exist.';
$lang['No_user_specified'] = 'No user was specified';
$lang['Notify_on_privmsg'] = 'Notify on new Private Message';
$lang['Occupation'] = 'Occupation';
$lang['Only_one_avatar'] = 'Only one type of avatar can be specified';
$lang['Password_activated'] = 'Your account has been re-activated. To log in, please use the password supplied in the e-mail you received.';
$lang['Password_long'] = 'Your password must be no more than 32 characters.';
$lang['Password_mismatch'] = 'The passwords you entered did not match.';
$lang['Password_updated'] = 'A new password has been created; please check your e-mail for details on how to activate it.';
$lang['Pick_local_Avatar'] = 'Select Avatar from the gallery';
$lang['Please_remove_install_contrib'] = 'Please ensure both the install/ and contrib/ directories are deleted';
$lang['Popup_on_privmsg'] = 'Pop up window on new Private Message';
$lang['Popup_on_privmsg_explain'] = 'Some templates may open a new window to inform you when new private messages arrive.';
$lang['Poster_rank'] = 'Poster rank';
$lang['Preferences'] = 'Preferences';
$lang['Profile_info'] = 'Profile Information';
$lang['Profile_info_warn'] = 'This information will be publicly viewable';
$lang['Profile_updated'] = 'Your profile has been updated';
$lang['Profile_updated_inactive'] = 'Your profile has been updated. However, you have changed vital details, thus your account is now inactive. Check your e-mail to find out how to reactivate your account, or if admin activation is required, wait for the administrator to reactivate it.';
$lang['Public_view_email'] = 'Always show my e-mail address';
$lang['Reactivate'] = 'Reactivate your account!';
$lang['Recipient'] = 'Recipient';
$lang['Reg_agreement'] = 'While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.<br /><br />You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br /><br />This forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).<br /><br />By clicking Register below you agree to be bound by these conditions.';
$lang['Registration'] = 'Registration Agreement Terms';
$lang['Registration_info'] = 'Registration Information';
$lang['Return_profile'] = 'Cancel avatar';
$lang['Search_user_posts'] = 'Find all posts by %s'; // Find all posts by username
$lang['Select_avatar'] = 'Select avatar';
$lang['Select_category'] = 'Select category';
$lang['Select_from_gallery'] = 'Select Avatar from gallery';
$lang['Send_email'] = 'Send e-mail';
$lang['Send_email_msg'] = 'Send an e-mail message';
$lang['Send_password'] = 'Send me a new password';
$lang['Send_private_message'] = 'Send private message';
$lang['Session_invalid'] = 'Invalid Session. Please resubmit the form.';
$lang['Signature'] = 'Signature';
$lang['Signature_explain'] = 'This is a block of text that can be added to posts you make. There is a %d character limit';
$lang['Signature_too_long'] = 'Your signature is too long.';
$lang['Timezone'] = 'Timezone';
$lang['Total_posts'] = 'Total posts';
$lang['Upload_Avatar_URL'] = 'Upload Avatar from a URL';
$lang['Upload_Avatar_URL_explain'] = 'Enter the URL of the location containing the Avatar image, it will be copied to this site.';
$lang['Upload_Avatar_file'] = 'Upload Avatar from your machine';
$lang['User_admin_for'] = 'User Administration for';
$lang['User_not_exist'] = 'That user does not exist';
$lang['User_post_day_stats'] = '%.2f posts per day'; // 1.5 posts per day
$lang['User_post_pct_stats'] = '%.2f%% of total'; // 1.25% of total
$lang['User_prevent_email'] = 'This user does not wish to receive e-mail. Try sending them a private message.';
$lang['Username_disallowed'] = 'Sorry, but this username has been disallowed.';
$lang['Username_invalid'] = 'Sorry, but this username contains an invalid character such as \'.';
$lang['Username_taken'] = 'Sorry, but this username has already been taken.';
$lang['View_avatar_gallery'] = 'Show gallery';
$lang['Viewing_user_profile'] = 'Viewing profile :: %s'; // %s is username
$lang['Website'] = 'Website';
$lang['Welcome_subject'] = 'Welcome to %s Forums'; // Welcome to my.com forums
$lang['Word_Wrap'] = 'Screen Width';
$lang['Word_Wrap_Error'] = 'The post display width is out of range.';
$lang['Word_Wrap_Explain'] = 'This is the maximum line length of user\'s posts.';
$lang['Word_Wrap_Extra'] = 'characters (range: %min% - %max% chars.)';
$lang['Wrong_Profile'] = 'You cannot modify a profile that is not your own.';
$lang['Wrong_activation'] = 'The activation key you supplied does not match any in the database.';
$lang['Wrong_remote_avatar_format'] = 'The URL of the remote avatar is not valid';
$lang['password_confirm_if_changed'] = 'You only need to confirm your password if you changed it above';
$lang['password_if_changed'] = 'You only need to supply a password if you want to change it';
//
// Stats block text
//
$lang['Forum_is_locked'] = 'Forum is locked';
$lang['New_post'] = 'New post';
$lang['New_posts'] = 'New posts';
$lang['New_posts_hot'] = 'New posts [ Popular ]';
$lang['New_posts_locked'] = 'New posts [ Locked ]';
$lang['Newest_user'] = 'The newest registered user is <strong>%s%s%s</strong>'; // a href, username, /a
$lang['No_new_posts'] = 'No new posts';
$lang['No_new_posts_hot'] = 'No new posts [ Popular ]';
$lang['No_new_posts_last_visit'] = 'No new posts since your last visit';
$lang['No_new_posts_locked'] = 'No new posts [ Locked ]';
$lang['Posted_article_total'] = 'Our users have posted a total of <strong>%d</strong> article'; // Number of posts
$lang['Posted_articles_total'] = 'Our users have posted a total of <strong>%d</strong> articles'; // Number of posts
$lang['Posted_articles_zero_total'] = 'Our users have posted a total of <strong>0</strong> articles'; // Number of posts
$lang['Registered_user_total'] = 'We have <strong>%d</strong> registered user'; // # registered users
$lang['Registered_users_total'] = 'We have <strong>%d</strong> registered users'; // # registered users
$lang['Registered_users_zero_total'] = 'We have <strong>0</strong> registered users'; // # registered users
//
// Viewforum
//
$lang['All_Topics'] = 'All Topics';
$lang['Display_topics'] = 'Display topics from previous';
$lang['Forum_not_exist'] = 'The forum you selected does not exist.';
$lang['Mark_all_topics'] = 'Mark all topics read';
$lang['No_topics_post_one'] = 'There are no posts in this forum.<br />Click on the <strong>Post New Topic</strong> link on this page to post one.';
$lang['Reached_on_error'] = 'You have reached this page in error.';
$lang['Rules_delete_can'] = 'You <strong>can</strong> delete your posts in this forum';
$lang['Rules_delete_cannot'] = 'You <strong>cannot</strong> delete your posts in this forum';
$lang['Rules_edit_can'] = 'You <strong>can</strong> edit your posts in this forum';
$lang['Rules_edit_cannot'] = 'You <strong>cannot</strong> edit your posts in this forum';
$lang['Rules_moderate'] = 'You <strong>can</strong> %smoderate this forum%s'; // %s replaced by a href links, do not remove!
$lang['Rules_post_can'] = 'You <strong>can</strong> post new topics in this forum';
$lang['Rules_post_cannot'] = 'You <strong>cannot</strong> post new topics in this forum';
$lang['Rules_reply_can'] = 'You <strong>can</strong> reply to topics in this forum';
$lang['Rules_reply_cannot'] = 'You <strong>cannot</strong> reply to topics in this forum';
$lang['Rules_vote_can'] = 'You <strong>can</strong> vote in polls in this forum';
$lang['Rules_vote_cannot'] = 'You <strong>cannot</strong> vote in polls in this forum';
$lang['Topic_Announcement'] = '<strong>Announcement:</strong>';
$lang['Topic_Moved'] = '<strong>Moved:</strong>';
$lang['Topic_Poll'] = '<strong>[ Poll ]</strong>';
$lang['Topic_Sticky'] = '<strong>Sticky:</strong>';
$lang['Topics_marked_read'] = 'The topics for this forum have now been marked read';
$lang['View_forum'] = 'View Forum';
//
// Viewonline
//
$lang['Forum_Location'] = 'Forum Location';
$lang['Forum_index'] = 'Forum Index';
$lang['Guest_user_online'] = 'There is %d Guest user online'; // There is 1 Guest user online
$lang['Guest_users_online'] = 'There are %d Guest users online'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = 'There are 0 Guest users online'; // There are 10 Guest users online
$lang['Hidden_user_online'] = '%d Hidden user online'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d Hidden users online'; // 6 Hidden users online
$lang['Hidden_users_zero_online'] = '0 Hidden users online'; // 6 Hidden users online
$lang['Last_updated'] = 'Last Updated';
$lang['Logging_on'] = 'Logging on';
$lang['No_users_browsing'] = 'There are no users currently browsing this forum';
$lang['Online_explain'] = 'This data is based on users active over the past ' . ( ($board_config['online_time']/60)%60 ) . ' minutes';
$lang['Online_time'] = 'Online since';
$lang['Posting_message'] = 'Posting a Message';
$lang['Reg_user_online'] = 'There is %d Registered user and '; // There is 1 Registered and
$lang['Reg_users_online'] = 'There are %d Registered users and '; // There are 5 Registered and
$lang['Reg_users_zero_online'] = 'There are 0 Registered users and '; // There are 5 Registered and
$lang['Searching_forums'] = 'Searching Forums';
$lang['Statistic_last_updated'] = 'Statistic last updated on';
$lang['Viewing_FAQ'] = 'Viewing FAQ';
$lang['Viewing_groupcp'] = 'Viewing Group Control Panel';
$lang['Viewing_member_list'] = 'Viewing Member List';
$lang['Viewing_online'] = 'Viewing Who is Online';
$lang['Viewing_priv_msgs'] = 'Viewing Private Messages';
$lang['Viewing_profile'] = 'Viewing Profile';
$lang['Viewing_ranks'] = 'Viewing Ranks';
$lang['Viewing_rules'] = 'Viewing Board Rules';
$lang['Viewing_stats'] = 'Viewing Statistics';
//
// Viewtopic
//
$lang['All_Posts'] = 'All Posts';
$lang['Back_to_top'] = 'Back to top';
$lang['Code'] = 'Code'; // comes before bbcode code output.
$lang['Delete_post'] = 'Delete this post';
$lang['Delete_topic'] = 'Delete this topic';
$lang['Display_posts'] = 'Display posts from previous';
$lang['Edit_delete_post'] = 'Edit/Delete this post';
$lang['Edited_time_total'] = 'Last edited by %s on %s; edited %d time in total'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'Last edited by %s on %s; edited %d times in total'; // Last edited by me on 12 Oct 2001; edited 2 times in total
$lang['Guest'] = 'Guest';
$lang['ICQ_status'] = 'ICQ Status';
$lang['Lock_topic'] = 'Lock this topic';
$lang['Merge_topics'] = 'Merge this topic';
$lang['Move_topic'] = 'Move this topic';
$lang['Newest_First'] = 'Newest First';
$lang['No_longer_watching'] = 'You are no longer watching this topic';
$lang['No_newer_topics'] = 'There are no newer topics in this forum';
$lang['No_older_topics'] = 'There are no older topics in this forum';
$lang['No_posts_topic'] = 'No posts exist for this topic';
$lang['Oldest_First'] = 'Oldest First';
$lang['PHPCode'] = 'PHP'; // PHP MOD
$lang['Post_subject'] = 'Post subject';
$lang['Quote'] = 'Quote'; // comes before bbcode quote output.
$lang['Read_profile'] = 'View user\'s profile';
$lang['Split_topic'] = 'Split this topic';
$lang['Start_watching_topic'] = 'Watch this topic for replies';
$lang['Stop_watching_topic'] = 'Stop watching this topic';
$lang['Submit_vote'] = 'Submit Vote';
$lang['Topic_post_not_exist'] = 'The topic or post you requested does not exist';
$lang['Total_votes'] = 'Total Votes';
$lang['Unlock_topic'] = 'Unlock this topic';
$lang['View_IP'] = 'View IP address of poster';
$lang['View_next_topic'] = 'View next topic';
$lang['View_previous_topic'] = 'View previous topic';
$lang['View_results'] = 'View Results';
$lang['View_topic'] = 'View topic';
$lang['Visit_website'] = 'Visit poster\'s website';
$lang['You_are_watching'] = 'You are now watching this topic';
$lang['must_first_vote'] = 'You must first vote to see the results of this poll';
$lang['wrote'] = 'wrote'; // proceeds the username and is followed by the quoted text
//
// Visual confirmation system strings
//
$lang['Confirm_code'] = 'Confirmation code';
$lang['Confirm_code_explain'] = 'Enter the code exactly as you see it. The code is case sensitive and zero has a diagonal line through it.';
$lang['Confirm_code_impaired'] = 'If you are visually impaired or cannot otherwise read this code please contact the %sAdministrator%s for help.';
$lang['Confirm_code_wrong'] = 'The confirmation code you entered was incorrect';
$lang['Too_many_registers'] = 'You have exceeded the number of registration attempts for this session. Please try again later.';
//
// Search
//
$lang['All_available'] = 'All available';
$lang['Close_window'] = 'Close Window';
$lang['Display_results'] = 'Display results as';
$lang['Found_search_match'] = 'Search found %d match'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'Search found %d matches'; // eg. Search found 24 matches
$lang['No_search_match'] = 'No topics or posts met your search criteria';
$lang['No_searchable_forums'] = 'You do not have permissions to search any forum on this site.';
$lang['Return_first'] = 'Return first'; // followed by xxx characters in a select box
$lang['Search_Flood_Error'] = 'You cannot make another search so soon after your last; please try again in a short while.';
$lang['Search_author'] = 'Search for Author';
$lang['Search_author_explain'] = 'Use * as a wildcard for partial matches';
$lang['Search_for_all'] = 'Search for all terms';
$lang['Search_for_any'] = 'Search for any terms or use query as entered';
$lang['Search_keywords'] = 'Search for Keywords';
$lang['Search_keywords_explain'] = 'You can use <u>AND</u> to define words which must be in the results, <u>OR</u> to define words which may be in the result and <u>NOT</u> to define words which should not be in the result. Use * as a wildcard for partial matches';
$lang['Search_msg_only'] = 'Search message text only';
$lang['Search_options'] = 'Search Options';
$lang['Search_previous'] = 'Search previous'; // followed by days, weeks, months, year, all in a select box
$lang['Search_query'] = 'Search Query';
$lang['Search_title_msg'] = 'Search topic title and message text';
$lang['Sort_Author'] = 'Author';
$lang['Sort_Forum'] = 'Forum';
$lang['Sort_Post_Subject'] = 'Post Subject';
$lang['Sort_Time'] = 'Post Time';
$lang['Sort_Topic_Title'] = 'Topic Title';
$lang['Sort_by'] = 'Sort by';
$lang['characters_posts'] = 'characters of posts';
//
// Timezones ... for display on each page
//
$lang['All_times'] = 'All times are %s'; // eg. All times are GMT - 12 Hours (times from next block)
$lang['-12'] = 'GMT - 12 Hours';
$lang['-11'] = 'GMT - 11 Hours';
$lang['-10'] = 'GMT - 10 Hours';
$lang['-9'] = 'GMT - 9 Hours';
$lang['-8'] = 'GMT - 8 Hours';
$lang['-7'] = 'GMT - 7 Hours';
$lang['-6'] = 'GMT - 6 Hours';
$lang['-5'] = 'GMT - 5 Hours';
$lang['-4'] = 'GMT - 4 Hours';
$lang['-3.5'] = 'GMT - 3.5 Hours';
$lang['-3'] = 'GMT - 3 Hours';
$lang['-2'] = 'GMT - 2 Hours';
$lang['-1'] = 'GMT - 1 Hours';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Hour';
$lang['2'] = 'GMT + 2 Hours';
$lang['3'] = 'GMT + 3 Hours';
$lang['3.5'] = 'GMT + 3.5 Hours';
$lang['4'] = 'GMT + 4 Hours';
$lang['4.5'] = 'GMT + 4.5 Hours';
$lang['5'] = 'GMT + 5 Hours';
$lang['5.5'] = 'GMT + 5.5 Hours';
$lang['6'] = 'GMT + 6 Hours';
$lang['6.5'] = 'GMT + 6.5 Hours';
$lang['7'] = 'GMT + 7 Hours';
$lang['8'] = 'GMT + 8 Hours';
$lang['9'] = 'GMT + 9 Hours';
$lang['9.5'] = 'GMT + 9.5 Hours';
$lang['10'] = 'GMT + 10 Hours';
$lang['11'] = 'GMT + 11 Hours';
$lang['12'] = 'GMT + 12 Hours';
$lang['13'] = 'GMT + 13 Hours';
// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 Hours';
$lang['tz']['-11'] = 'GMT - 11 Hours';
$lang['tz']['-10'] = 'GMT - 10 Hours';
$lang['tz']['-9'] = 'GMT - 9 Hours';
$lang['tz']['-8'] = 'GMT - 8 Hours';
$lang['tz']['-7'] = 'GMT - 7 Hours';
$lang['tz']['-6'] = 'GMT - 6 Hours';
$lang['tz']['-5'] = 'GMT - 5 Hours';
$lang['tz']['-4'] = 'GMT - 4 Hours';
$lang['tz']['-3.5'] = 'GMT - 3.5 Hours';
$lang['tz']['-3'] = 'GMT - 3 Hours';
$lang['tz']['-2'] = 'GMT - 2 Hours';
$lang['tz']['-1'] = 'GMT - 1 Hours';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 Hour';
$lang['tz']['2'] = 'GMT + 2 Hours';
$lang['tz']['3'] = 'GMT + 3 Hours';
$lang['tz']['3.5'] = 'GMT + 3.5 Hours';
$lang['tz']['4'] = 'GMT + 4 Hours';
$lang['tz']['4.5'] = 'GMT + 4.5 Hours';
$lang['tz']['5'] = 'GMT + 5 Hours';
$lang['tz']['5.5'] = 'GMT + 5.5 Hours';
$lang['tz']['6'] = 'GMT + 6 Hours';
$lang['tz']['6.5'] = 'GMT + 6.5 Hours';
$lang['tz']['7'] = 'GMT + 7 Hours';
$lang['tz']['8'] = 'GMT + 8 Hours';
$lang['tz']['9'] = 'GMT + 9 Hours';
$lang['tz']['9.5'] = 'GMT + 9.5 Hours';
$lang['tz']['10'] = 'GMT + 10 Hours';
$lang['tz']['11'] = 'GMT + 11 Hours';
$lang['tz']['12'] = 'GMT + 12 Hours';
$lang['tz']['13'] = 'GMT + 13 Hours';
$lang['datetime']['Sunday'] = 'Sunday';
$lang['datetime']['Monday'] = 'Monday';
$lang['datetime']['Tuesday'] = 'Tuesday';
$lang['datetime']['Wednesday'] = 'Wednesday';
$lang['datetime']['Thursday'] = 'Thursday';
$lang['datetime']['Friday'] = 'Friday';
$lang['datetime']['Saturday'] = 'Saturday';
$lang['datetime']['Sun'] = 'Sun';
$lang['datetime']['Mon'] = 'Mon';
$lang['datetime']['Tue'] = 'Tue';
$lang['datetime']['Wed'] = 'Wed';
$lang['datetime']['Thu'] = 'Thu';
$lang['datetime']['Fri'] = 'Fri';
$lang['datetime']['Sat'] = 'Sat';
$lang['datetime']['January'] = 'January';
$lang['datetime']['February'] = 'February';
$lang['datetime']['March'] = 'March';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'May';
$lang['datetime']['June'] = 'June';
$lang['datetime']['July'] = 'July';
$lang['datetime']['August'] = 'August';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'October';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'December';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'Mar';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'May';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Oct';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dec';

?>