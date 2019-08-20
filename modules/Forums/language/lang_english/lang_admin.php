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
// Format is same as lang_main
//

//
// Modules, this replaces the keys used
// in the modules[][] arrays in each module file
//
$lang['AUC'] = 'AUC';
$lang['Add_new'] = 'Add';
$lang['Backup_DB'] = 'Backup Database';
$lang['Ban_Management'] = 'Ban Control';
$lang['Configuration'] = 'Configuration';
$lang['Configuration_extend'] = 'Configuration Extended';
$lang['Create_new'] = 'Create';
$lang['Disallow'] = 'Disallow names';
$lang['Export'] = 'Export';
$lang['Faq_manager'] = 'FAQ Admin';
$lang['Forums'] = 'Forum Admin';
$lang['General'] = 'General Admin';
$lang['Group_Permissions'] = 'Group Permissions';
$lang['Groups'] = 'Group Admin';
$lang['Logs Actions'] = 'Logs Actions';
$lang['Logs Config'] = 'Logs Configuration';
$lang['Logs'] = 'Logs';
$lang['Manage'] = 'Management';
$lang['Manage_Fields'] = 'Manage Fields';
$lang['Mass_Email'] = 'Mass Email';
$lang['Permissions'] = 'Permissions';
$lang['Poll_Admin'] = 'Poll Admin';
$lang['Poll_Results'] = 'Poll Results';
$lang['Prune'] = 'Pruning';
$lang['Quick Search List'] = 'Quick Search List';
$lang['Ranks'] = 'Ranks';
$lang['Restore_DB'] = 'Restore Database';
$lang['Smilies'] = 'Smiles';
$lang['Topic_Shadow'] = 'Topic Shadow';
$lang['User_Permissions'] = 'User Permissions';
$lang['Users'] = 'User Admin';
$lang['Word_Censor'] = 'Word Censors';
$lang['attachment_faq'] = 'Attachment FAQ';
$lang['bbcode_faq'] = 'BBcode FAQ';
$lang['bid_faq'] = 'Buddy List FAQ';
$lang['board_faq'] = 'Board FAQ';
$lang['prillian_faq'] = 'Prillian FAQ';
$lang['site_rules'] = 'Site Rules';
//
// Index
//
$lang['Admin'] = 'Administration';
$lang['Admin_Index'] = 'Admin [Forums]';
$lang['Admin_Nuke'] = 'Admin [Evo-CMS]';
$lang['Admin_intro'] = 'Thank you for choosing phpBB as your forum solution. This screen will give you a quick overview of all the various statistics of your board. You can get back to this page by clicking on the <u>Admin [Forums]</u> link in the left pane. To return to the index of your board, click the <u>Forums Index</u> link or the phpBB logo also in the left pane. The other links on the left hand side of this screen will allow you to control every aspect of your forum experience. Each screen will have instructions on how to use the tools.';
$lang['Avatar_dir_size'] = 'Avatar directory size';
$lang['Board_started'] = 'Board started';
$lang['Click_return_admin_index'] = 'Click %sHere%s to return to the Admin Index';
$lang['Database_size'] = 'Database size';
$lang['Edit_module'] = 'Edit Module';
$lang['Forum_stats'] = 'Forum Statistics';
$lang['Gzip_compression'] ='Gzip compression';
$lang['Home_Nuke'] = 'Home Index';
$lang['Install_module'] = 'Install Module';
$lang['LEFT_Package_Module'] = 'Module package';
$lang['Main_index'] = 'Forum Index';
$lang['Manage_modules'] = 'Manage Modules';
$lang['Not_admin'] = 'You are not authorized to administer this board';
$lang['Not_available'] = 'Not available';
$lang['Number_posts'] = 'Number of posts';
$lang['Number_topics'] = 'Number of topics';
$lang['Number_users'] = 'Number of users';
$lang['OFF'] = 'OFF';
$lang['ON'] = 'ON'; // This is for GZip compression
$lang['Online_time'] = 'Online since';
$lang['Posts_per_day'] = 'Posts per day';
$lang['Preview_forum'] = 'Preview Forum';
$lang['Statistic'] = 'Statistics';
$lang['Stats_configuration'] = 'Configuration';
$lang['Stats_langcp'] = 'Stats LanguageCP';
$lang['Topics_per_day'] = 'Topics per day';
$lang['Users_per_day'] = 'Users per day';
$lang['Value'] = 'Value';
$lang['Welcome_phpBB'] = 'Welcome to phpBB';
//
// DB Utils
//
$lang['Additional_tables'] = 'Additional tables';
$lang['Backup'] = 'Backup';
$lang['Backup_download'] = 'Your download will start shortly; please wait until it begins.';
$lang['Backup_explain'] = 'Here you can back up all your phpBB-related data. If you have any additional custom tables in the same database with phpBB that you would like to back up as well, please enter their names, separated by commas, in the Additional Tables text box below. If your server supports it you may also gzip-compress the file to reduce its size before download.';
$lang['Backup_options'] = 'Backup options';
$lang['Backups_not_supported'] = 'Sorry, but database backups are not currently supported for your database system.';
$lang['Data_backup'] = 'Data only backup';
$lang['Database_Utilities'] = 'Database Utilities';
$lang['Full_backup'] = 'Full backup';
$lang['Gzip_compress'] = 'Gzip compress file';
$lang['Restore'] = 'Restore';
$lang['Restore_Error_decompress'] = 'Cannot decompress a gzip file; please upload a plain text version';
$lang['Restore_Error_filename'] = 'Filename problem; please try an alternative file';
$lang['Restore_Error_no_file'] = 'No file was uploaded';
$lang['Restore_Error_uploading'] = 'Error in uploading the backup file';
$lang['Restore_explain'] = 'This will perform a full restore of all phpBB tables from a saved file. If your server supports it, you may upload a gzip-compressed text file and it will automatically be decompressed. <strong>WARNING</strong>: This will overwrite any existing data. The restore may take a long time to process, so please do not move from this page until it is complete.';
$lang['Restore_success'] = 'The Database has been successfully restored.<br /><br />Your board should be back to the state it was when the backup was made.';
$lang['Select_file'] = 'Select a file';
$lang['Start_Restore'] = 'Start Restore';
$lang['Start_backup'] = 'Start Backup';
$lang['Structure_backup'] = 'Structure-Only backup';
//
// Auth pages
//
$lang['Administrators'] = 'Administrators';
$lang['Advanced_mode'] = 'Advanced Mode';
$lang['Allowed_Access'] = 'Allowed Access';
$lang['Announce'] = 'Announce';
$lang['Auth_Admin'] = 'Administrator';
$lang['Auth_Control_Forum'] = 'Forum Permissions Control';
$lang['Auth_Control_Group'] = 'Group Permissions Control';
$lang['Auth_Control_User'] = 'User Permissions Control';
$lang['Auth_User'] = 'User';
$lang['Auth_updated'] = 'Permissions have been updated';
$lang['Click_return_forumauth'] = 'Click %sHere%s to return to Forum Permissions';
$lang['Click_return_groupauth'] = 'Click %sHere%s to return to Group Permissions';
$lang['Click_return_userauth'] = 'Click %sHere%s to return to User Permissions';
$lang['Conflict_access_groupauth'] = 'The following user (or users) still have access rights to this forum via their user permission settings. You may want to alter the user permissions to fully prevent them having access rights. The users granted rights (and the forums involved) are noted below.';
$lang['Conflict_access_userauth'] = 'This user still has access rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having access rights. The groups granting rights (and the forums involved) are noted below.';
$lang['Conflict_mod_groupauth'] = 'The following user (or users) still have moderator rights to this forum via their user permissions settings. You may want to alter the user permissions to fully prevent them having moderator rights. The users granted rights (and the forums involved) are noted below.';
$lang['Conflict_mod_userauth'] = 'This user still has moderator rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having moderator rights. The groups granting rights (and the forums involved) are noted below.';
$lang['Conflict_warning'] = 'Authorization Conflict Warning';
$lang['Delete'] = 'Delete';
$lang['Disallowed_Access'] = 'Disallowed Access';
$lang['Edit'] = 'Edit';
$lang['Forum_ADMIN'] = 'ADMIN';
$lang['Forum_ALL'] = 'ALL';
$lang['Forum_MOD'] = 'MOD';
$lang['Forum_PRIVATE'] = 'PRIVATE';
$lang['Forum_REG'] = 'REG';
$lang['Forum_auth_explain'] = 'Here you can alter the authorization levels of each forum. You will have both a simple and advanced method for doing this, where advanced offers greater control of each forum operation. Remember that changing the permission level of forums will affect which users can carry out the various operations within them.';
$lang['Forum_auth_updated'] = 'Forum permissions updated';
$lang['Group_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each user group. Do not forget when changing group permissions that individual user permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$lang['Group_auth_updated'] = 'Group permissions updated';
$lang['Group_memberships'] = 'User group memberships';
$lang['Hidden'] = 'Hidden';
$lang['Is_Moderator'] = 'Is Moderator';
$lang['Look_up_Forum'] = 'Look up Forum';
$lang['Look_up_Group'] = 'Look up Group';
$lang['Look_up_User'] = 'Look up User';
$lang['Moderator_status'] = 'Moderator status';
$lang['Not_Moderator'] = 'Not Moderator';
$lang['Permissions'] = 'Permissions';
$lang['Pollcreate'] = 'Poll create';
$lang['Post'] = 'Post';
$lang['Private'] = 'Private';
$lang['Public'] = 'Public';
$lang['Read'] = 'Read';
$lang['Registered'] = 'Registered';
$lang['Reply'] = 'Reply';
$lang['Select_a_Forum'] = 'Select a Forum';
$lang['Select_a_Group'] = 'Select a Group';
$lang['Select_a_User'] = 'Select a User';
$lang['Simple_Permission'] = 'Simple Permissions';
$lang['Simple_mode'] = 'Simple Mode';
$lang['Sticky'] = 'Sticky';
$lang['User_Level'] = 'User Level';
$lang['User_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each individual user. Do not forget when changing user permissions that group permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$lang['User_auth_updated'] = 'User permissions updated';
$lang['Usergroup_members'] = 'This group has the following members';
$lang['View'] = 'View';
$lang['Vote'] = 'Vote';
//
// Banning
//
$lang['Ban_IP'] = 'Ban one or more IP addresses or host names';
$lang['Ban_IP_explain'] = 'To specify several different IP addresses or host names separate them with commas. To specify a range of IP addresses, separate the start and end with a hyphen (-); to specify a wildcard, use an asterisk (*).';
$lang['Ban_control'] = 'Ban Control';
$lang['Ban_email'] = 'Ban one or more email addresses';
$lang['Ban_email_explain'] = 'To specify more than one email address, separate them with commas. To specify a wildcard username, use * like *@hotmail.com';
$lang['Ban_explain'] = 'Here you can control the banning of users. You can achieve this by banning either or both of a specific user or an individual or range of IP addresses or host names. These methods prevent a user from even reaching the index page of your board. To prevent a user from registering under a different username you can also specify a banned email address. Please note that banning an email address alone will not prevent that user from being able to log on or post to your board. You should use one of the first two methods to achieve this.';
$lang['Ban_explain_warn'] = 'Please note that entering a range of IP addresses results in all the addresses between the start and end being added to the ban list. Attempts will be made to minimize the number of addresses added to the database by introducing wildcards automatically where appropriate. If you really must enter a range, try to keep it small or better yet state specific addresses.';
$lang['Ban_update_sucessful'] = 'The ban list has been updated successfully';
$lang['Ban_username'] = 'Ban one or more specific users';
$lang['Ban_username_explain'] = 'You can ban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';
$lang['Click_return_banadmin'] = 'Click %sHere%s to return to Ban Control';
$lang['IP_hostname'] = 'IP addresses or host names';
$lang['No_banned_email'] = 'No banned email addresses';
$lang['No_banned_ip'] = 'No banned IP addresses';
$lang['No_banned_users'] = 'No banned usernames';
$lang['Select_email'] = 'Select an Email address';
$lang['Select_ip'] = 'Select an IP address';
$lang['Select_username'] = 'Select a Username';
$lang['Unban_IP'] = 'Un-ban one or more IP addresses';
$lang['Unban_IP_explain'] = 'You can un-ban multiple IP addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';
$lang['Unban_email'] = 'Un-ban one or more email addresses';
$lang['Unban_email_explain'] = 'You can un-ban multiple email addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';
$lang['Unban_username'] = 'Un-ban one or more specific users';
$lang['Unban_username_explain'] = 'You can un-ban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';
//
// Configuration
//
$lang['Abilities_settings'] = 'User and Forum Basic Settings';
$lang['Acc_Admin'] = 'Admin';
$lang['Acc_None'] = 'None'; // These three entries are the type of activation
$lang['Acc_User'] = 'User';
$lang['Acct_activation'] = 'Enable account activation';
$lang['Admin_email'] = 'Admin Email Address';
$lang['Allow_BBCode'] = 'Allow BBCode';
$lang['Allow_HTML'] = 'Allow HTML';
$lang['Allow_local'] = 'Enable gallery avatars';
$lang['Allow_name_change'] = 'Allow Username changes';
$lang['Allow_remote'] = 'Enable remote avatars';
$lang['Allow_remote_explain'] = 'Avatars linked to from another website';
$lang['Allow_sig'] = 'Allow Signatures';
$lang['Allow_smilies'] = 'Allow Smiles';
$lang['Allow_upload'] = 'Enable avatar uploading';
$lang['Allowed_tags'] = 'Allowed HTML tags';
$lang['Allowed_tags_explain'] = 'Separate tags with commas';
$lang['Avatar_gallery_path'] = 'Avatar Gallery Path';
$lang['Avatar_gallery_path_explain'] = 'Path under the root dir for pre-loaded images, e.g. images/avatars/gallery';
$lang['Avatar_settings'] = 'Avatar Settings';
$lang['Avatar_storage_path'] = 'Avatar Storage Path';
$lang['Avatar_storage_path_explain'] = 'Path under the root dir, e.g. images/avatars';
$lang['Board_disable'] = 'Disable board';
$lang['Board_disable_explain'] = 'This will make the board unavailable to users. Administrators are able to access the Administration Panel while the board is disabled.';
$lang['Board_disable_msg'] = 'Disable board message';
$lang['Board_disable_msg_explain'] = 'This text will be showed if "Disable board" is on "Yes".';
$lang['Board_email_form'] = 'User email via board';
$lang['Board_email_form_explain'] = 'Users send email to each other via this board';
$lang['COPPA_fax'] = 'COPPA Fax Number';
$lang['COPPA_mail'] = 'COPPA Mailing Address';
$lang['COPPA_mail_explain'] = 'This is the mailing address to which parents will send COPPA registration forms';
$lang['COPPA_settings'] = 'COPPA Settings';
$lang['Click_return_config'] = 'Click %sHere%s to return to General Configuration';
$lang['Config_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side.';
$lang['Cookie_domain'] = 'Cookie domain';
$lang['Cookie_name'] = 'Cookie name';
$lang['Cookie_path'] = 'Cookie path';
$lang['Cookie_secure'] = 'Cookie secure';
$lang['Cookie_secure_explain'] = 'If your server is running via SSL, set this to enabled, else leave as disabled';
$lang['Cookie_settings'] = 'Cookie settings';
$lang['Cookie_settings_explain'] = 'These details define how cookies are sent to your users\' browsers. In most cases the default values for the cookie settings should be sufficient, but if you need to change them do so with care -- incorrect settings can prevent users from logging in';
$lang['Date_format'] = 'Date Format';
$lang['Default_language'] = 'Default Language';
$lang['Default_style'] = 'Default Theme';
$lang['Disable_privmsg'] = 'Private Messaging';
$lang['Email_settings'] = 'Email Settings';
$lang['Email_sig'] = 'Email Signature';
$lang['Email_sig_explain'] = 'This text will be attached to all emails the board sends';
$lang['Enable_gzip'] = 'Enable GZip Compression';
$lang['Enable_prune'] = 'Enable Forum Pruning';
$lang['Flood_Interval'] = 'Flood Interval';
$lang['Flood_Interval_explain'] = 'Number of seconds a user must wait between posts';
$lang['General_Config'] = 'General Configuration';
$lang['General_settings'] = 'General Board Settings';
$lang['Guest_Search_Security_Code'] = 'Enable Security Code for Guest Search\'s';
$lang['Guest_Search_Security_Code_explain'] = 'If you set this to yes, all guests have to retype a security code before their search is accepted';
$lang['Guest_Security_Code'] = 'Enable Security Code for Guest Postings';
$lang['Guest_Security_Code_explain'] = 'If you set this to yes, all guests have to retype a security code before their posting is accepted';
$lang['Hot_threshold'] = 'Posts for Popular Threshold';
$lang['Inbox_limits'] = 'Max posts in Inbox';
$lang['Max_avatar_size'] = 'Maximum Avatar Dimensions';
$lang['Max_avatar_size_explain'] = '(Height x Width in pixels)';
$lang['Max_filesize'] = 'Maximum Avatar File Size';
$lang['Max_filesize_explain'] = 'For uploaded avatar files';
$lang['Max_poll_options'] = 'Max number of poll options';
$lang['Max_sig_length'] = 'Maximum signature length';
$lang['Max_sig_length_explain'] = 'Maximum number of characters in user signatures';
$lang['Override_style'] = 'Override user style';
$lang['Override_style_explain'] = 'Replaces users style with the default';
$lang['Posts_per_page'] = 'Posts Per Page';
$lang['SMTP_password'] = 'SMTP Password';
$lang['SMTP_password_explain'] = 'Only enter a password if your SMTP server requires it';
$lang['SMTP_server'] = 'SMTP Server Address';
$lang['SMTP_username'] = 'SMTP Username';
$lang['SMTP_username_explain'] = 'Only enter a username if your SMTP server requires it';
$lang['Savebox_limits'] = 'Max posts in Savebox';
$lang['Script_path'] = 'Script path';
$lang['Script_path_explain'] = 'The path where phpBB2 is located relative to the domain name';
$lang['Sentbox_limits'] = 'Max posts in Sentbox';
$lang['Server_name'] = 'Domain Name';
$lang['Server_name_explain'] = 'The domain name from which this board runs';
$lang['Server_port'] = 'Server Port';
$lang['Server_port_explain'] = 'The port your server is running on, usually 80. Only change if different';
$lang['Session_length'] = 'Session length [ seconds ]';
$lang['Site_desc'] = 'Site description';
$lang['Site_name'] = 'Site name';
$lang['Smilies_path'] = 'Smiles Storage Path';
$lang['Smilies_path_explain'] = 'Path under your phpBB root dir, e.g. images/smiles';
$lang['System_timezone'] = 'System Time zone';
$lang['Topics_per_page'] = 'Topics Per Page';
$lang['Use_SMTP'] = 'Use SMTP Server for email';
$lang['Use_SMTP_explain'] = 'Say yes if you want or have to send email via a named server instead of the local mail function';
//
// Visual Confirmation
//
$lang['Visual_confirm'] = 'Enable Visual Confirmation';
$lang['Visual_confirm_explain'] = 'Requires users enter a code defined by an image when registering.';
//
// Autologin Keys - added 2.0.18
//
$lang['Allow_autologin'] = 'Allow automatic logins';
$lang['Allow_autologin_explain'] = 'Determines whether users are allowed to select to be automatically logged in when visiting the forum';
$lang['Autologin_time'] = 'Automatic login key expiry';
$lang['Autologin_time_explain'] = 'How long a auto login key is valid for in days if the user does not visit the board. Set to zero to disable expiry.';
//
// Search Flood Control - added 2.0.20
//
$lang['Search_Flood_Interval'] = 'Search Flood Interval';
$lang['Search_Flood_Interval_explain'] = 'Number of seconds a user must wait between search requests';
$lang['Stylesheet_explain'] = 'Filename for CSS stylesheet to use for this theme.';
//
// Login attempts configuration
//
$lang['Login_reset_time'] = 'Login lock time';
$lang['Login_reset_time_explain'] = 'Time in minutes the user have to wait until he is allowed to login again after exceeding the number of allowed login attempts.';
$lang['Max_login_attempts'] = 'Allowed login attempts';
$lang['Max_login_attempts_explain'] = 'The number of allowed board login attempts.';
//
// Forum Management
//
$lang['Action'] = 'Action';
$lang['Click_return_forumadmin'] = 'Click %sHere%s to return to Forum Administration';
$lang['Config_updated'] = 'Forum Configuration Updated Successfully';
$lang['Create_category'] = 'Create new category';
$lang['Create_forum'] = 'Create new forum';
$lang['Delete'] = 'Delete';
$lang['Delete_all_posts'] = 'Delete all posts';
$lang['Edit'] = 'Edit';
$lang['Edit_Category'] = 'Edit Category';
$lang['Edit_Category_explain'] = 'Use this form to modify a category\'s name.';
$lang['Edit_forum'] = 'Edit forum';
$lang['Forum_admin'] = 'Forum Administration';
$lang['Forum_admin_explain'] = 'From this panel you can add, delete, edit, re-order and re-synchronise categories and forums';
$lang['Forum_delete'] = 'Delete Forum';
$lang['Forum_delete_explain'] = 'The form below will allow you to delete a forum (or category) and decide where you want to put all topics (or forums) it contained.';
$lang['Forum_desc'] = 'Description';
$lang['Forum_edit_delete_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side';
$lang['Forum_name'] = 'Forum name';
$lang['Forum_pruning'] = 'Auto-pruning';
$lang['Forum_settings'] = 'General Forum Settings';
$lang['Forum_status'] = 'Forum status';
$lang['Forums_updated'] = 'Forum and Category information updated successfully';
$lang['Move_and_Delete'] = 'Move and Delete';
$lang['Move_contents'] = 'Move all contents';
$lang['Move_down'] = 'Move down';
$lang['Move_up'] = 'Move up';
$lang['Must_delete_forums'] = 'You need to delete all forums before you can delete this category';
$lang['No_mode'] = 'No mode was set';
$lang['Nowhere_to_move'] = 'Nowhere to move to';
$lang['Remove'] = 'Remove';
$lang['Resync'] = 'Resync';
$lang['Set_prune_data'] = 'You have turned on auto-prune for this forum but did not set a frequency or number of days to prune. Please go back and do so.';
$lang['Status_locked'] = 'Locked';
$lang['Status_unlocked'] = 'Unlocked';
$lang['Update_order'] = 'Update Order';
$lang['prune_days'] = 'Remove topics that have not been posted to in';
$lang['prune_freq'] = 'Check for topic age every';
//
// Smiley Management
//
$lang['Click_return_smileadmin'] = 'Click %sHere%s to return to Smiley Administration';
$lang['Confirm_delete_smiley'] = 'Are you sure you want to delete this Smiley?';
$lang['Emotion'] = 'Emotion';
$lang['Select_pak'] = 'Select Pack (.pak) File';
$lang['Smile'] = 'Smile';
$lang['choose_smile_pak'] = 'Choose a Smile Pack .pak file';
$lang['del_existing_smileys'] = 'Delete existing smiley\'s before import';
$lang['export_smile_pack'] = 'Create Smiley Pack';
$lang['export_smiles'] = 'To create a smiley pack from your currently installed smiley\'s, click %sHere%s to download the smiles.pak file. Name this file appropriately making sure to keep the .pak file extension. Then create a zip file containing all of your smiley images plus this .pak configuration file.';
$lang['import'] = 'Import Smiley\'s';
$lang['import_smile_pack'] = 'Import Smiley Pack';
$lang['keep_existing'] = 'Keep Existing Smiley';
$lang['replace_existing'] = 'Replace Existing Smiley';
$lang['smile_add'] = 'Add a new Smiley';
$lang['smile_conflicts'] = 'What should be done in case of conflicts';
$lang['smile_desc'] = 'From this page you can add, remove and edit the emoticons or smiley\'s that your users can use in their posts and private messages.';
$lang['smiley_add_success'] = 'The Smiley was successfully added';
$lang['smiley_code'] = 'Smiley Code';
$lang['smiley_config'] = 'Smiley Configuration';
$lang['smiley_del_success'] = 'The Smiley was successfully removed';
$lang['smiley_edit_success'] = 'The Smiley was successfully updated';
$lang['smiley_emot'] = 'Smiley Emotion';
$lang['smiley_import'] = 'Smiley Pack Import';
$lang['smiley_import_inst'] = 'You should unzip the smiley package and upload all files to the appropriate Smiley directory for your installation. Then select the correct information in this form to import the smiley pack.';
$lang['smiley_import_success'] = 'The Smiley Pack was imported successfully!';
$lang['smiley_title'] = 'Smiles Editing Utility';
$lang['smiley_url'] = 'Smiley Image File';
//
// User Management
//
$lang['Admin_avatar_explain'] = 'Here you can see and delete the user\'s current avatar.';
$lang['Admin_user_fail'] = 'Couldn\'t update the user\'s profile.';
$lang['Admin_user_updated'] = 'The user\'s profile was successfully updated.';
$lang['Click_return_useradmin'] = 'Click %sHere%s to return to User Administration';
$lang['Look_up_user'] = 'Look up user';
$lang['User_admin'] = 'User Administration';
$lang['User_admin_explain'] = 'Here you can change your users\' information and certain options. To modify the users\' permissions, please use the user and group permissions system.';
$lang['User_allowavatar'] = 'Can display avatar';
$lang['User_allowpm'] = 'Can send Private Messages';
$lang['User_delete'] = 'Delete this user';
$lang['User_delete_explain'] = 'Click here to delete this user; this cannot be undone.';
$lang['User_deleted'] = 'User was successfully deleted.';
$lang['User_special'] = 'Special admin-only fields';
$lang['User_special_explain'] = 'These fields are not able to be modified by the users. Here you can set their status and other options that are not given to users.';
$lang['User_status'] = 'User is active';
$lang['user_allowsignature'] = 'Can display signature';
//
// Group Management
//
$lang['Added_new_group'] = 'The new group was successfully created';
$lang['Click_return_groupsadmin'] = 'Click %sHere%s to return to Group Administration.';
$lang['Deleted_group'] = 'The group was successfully deleted';
$lang['Edit_group'] = 'Edit group';
$lang['Error_updating_groups'] = 'There was an error while updating the groups';
$lang['Group_admin_explain'] = 'From this panel you can administer all your user groups. You can delete, create and edit existing groups. You may choose moderators, toggle open/closed group status and set the group name and description';
$lang['Group_administration'] = 'Group Administration';
$lang['Look_up_group'] = 'Look up group';
$lang['New_group'] = 'Create new group';
$lang['No_group_action'] = 'No action was specified';
$lang['No_group_mode'] = 'You must specify a mode for this group, open or closed';
$lang['No_group_moderator'] = 'You must specify a moderator for this group';
$lang['No_group_name'] = 'You must specify a name for this group';
$lang['Select_group'] = 'Select a group';
$lang['Updated_group'] = 'The group was successfully updated';
$lang['delete_group_moderator'] = 'Delete the old group moderator?';
$lang['delete_moderator_explain'] = 'If you\'re changing the group moderator, check this box to remove the old moderator from the group. Otherwise, do not check it, and the user will become a regular member of the group.';
$lang['group_closed'] = 'Closed group';
$lang['group_delete'] = 'Delete group';
$lang['group_delete_check'] = 'Delete this group';
$lang['group_description'] = 'Group description';
$lang['group_hidden'] = 'Hidden group';
$lang['group_moderator'] = 'Group moderator';
$lang['group_name'] = 'Group name';
$lang['group_open'] = 'Open group';
$lang['group_status'] = 'Group status';
$lang['reset_group_changes'] = 'Reset Changes';
$lang['submit_group_changes'] = 'Submit Changes';
//
// Prune Administration
//
$lang['All_Forums'] = 'All Forums';
$lang['Do_Prune'] = 'Do Prune';
$lang['Forum_Prune'] = 'Forum Prune';
$lang['Forum_Prune_explain'] = 'This will delete any topic which has not been posted to within the number of days you select. If you do not enter a number then all topics will be deleted. It will not remove topics in which polls are still running nor will it remove announcements. You will need to remove those topics manually.';
$lang['Posts_pruned'] = 'Posts pruned';
$lang['Prune_success'] = 'Pruning of forums was successful';
$lang['Prune_topics_not_posted'] = 'Prune topics with no replies in this many days';
$lang['Topics_pruned'] = 'Topics pruned';
//
// Word censor
//
$lang['Add_new_word'] = 'Add new word';
$lang['Click_return_wordadmin'] = 'Click %sHere%s to return to Word Censor Administration';
$lang['Confirm_delete_word'] = 'Are you sure you want to delete this word censor?';
$lang['Edit_word_censor'] = 'Edit word censor';
$lang['Must_enter_word'] = 'You must enter a word and its replacement';
$lang['No_word_selected'] = 'No word selected for editing';
$lang['Replacement'] = 'Replacement';
$lang['Update_word'] = 'Update word censor';
$lang['Word'] = 'Word';
$lang['Word_added'] = 'The word censor has been successfully added';
$lang['Word_removed'] = 'The selected word censor has been successfully removed';
$lang['Word_updated'] = 'The selected word censor has been successfully updated';
$lang['Words_explain'] = 'From this control panel you can add, edit, and remove words that will be automatically censored on your forums. In addition people will not be allowed to register with usernames containing these words. Wildcards (*) are accepted in the word field. For example, *test* will match detestable, test* would match testing, *test would match detest.';
$lang['Words_title'] = 'Word Censoring';
//
// Mass Email
//
$lang['All_users'] = 'All Users';
$lang['Click_return_massemail'] = 'Click %sHere%s to return to the Mass Email form';
$lang['Compose'] = 'Compose';
$lang['Email_successfull'] = 'Your message has been sent';
$lang['Mass_email_explain'] = 'Here you can email a message to either all of your users or all users of a specific group. To do this, an email will be sent out to the administrative email address supplied, with a blind carbon copy sent to all recipients. If you are emailing a large group of people please be patient after submitting and do not stop the page halfway through. It is normal for a mass emailing to take a long time and you will be notified when the script has completed';
$lang['Recipients'] = 'Recipients';
//
// Ranks admin
//
$lang['Add_new_rank'] = 'Add new rank';
$lang['Click_return_rankadmin'] = 'Click %sHere%s to return to Rank Administration';
$lang['Confirm_delete_rank'] = 'Are you sure you want to delete this rank?';
$lang['Must_select_rank'] = 'You must select a rank';
$lang['No_assigned_rank'] = 'No special rank assigned';
$lang['No_update_ranks'] = 'The rank was successfully deleted. However, user accounts using this rank were not updated. You will need to manually reset the rank on these accounts';
$lang['Rank_added'] = 'The rank was successfully added';
$lang['Rank_image'] = 'Rank Image<br /><small>(Relative to your site-root a.e. images/ranks)</small>';
$lang['Rank_image_explain'] = 'Use this to define a small image associated with the rank';
$lang['Rank_maximum'] = 'Maximum Posts';
$lang['Rank_minimum'] = 'Minimum Posts';
$lang['Rank_removed'] = 'The rank was successfully deleted';
$lang['Rank_special'] = 'Set as Special Rank';
$lang['Rank_title'] = 'Rank Title';
$lang['Rank_updated'] = 'The rank was successfully updated';
$lang['Ranks_explain'] = 'Using this form you can add, edit, view and delete ranks. You can also create custom ranks which can be applied to a user via the user management facility';
$lang['Ranks_title'] = 'Rank Administration';
//
// Disallow Username Admin
//
$lang['Add_disallow'] = 'Add';
$lang['Add_disallow_explain'] = 'You can disallow a username using the wildcard character * to match any character';
$lang['Add_disallow_title'] = 'Add a disallowed username';
$lang['Click_return_disallowadmin'] = 'Click %sHere%s to return to Disallow Username Administration';
$lang['Delete_disallow'] = 'Delete';
$lang['Delete_disallow_explain'] = 'You can remove a disallowed username by selecting the username from this list and clicking delete';
$lang['Delete_disallow_title'] = 'Remove a Disallowed Username';
$lang['Disallow_control'] = 'Username Disallow Control';
$lang['Disallow_explain'] = 'Here you can control usernames which will not be allowed to be used. Disallowed usernames are allowed to contain a wildcard character of *. Please note that you will not be allowed to specify any username that has already been registered. You must first delete that name then disallow it.';
$lang['Disallow_successful'] = 'The disallowed username has been successfully added';
$lang['Disallowed_already'] = 'The name you entered could not be disallowed. It either already exists in the list, exists in the word censor list, or a matching username is present.';
$lang['Disallowed_deleted'] = 'The disallowed username has been successfully removed';
$lang['Install'] = 'Install';
$lang['Install_No_PCRE'] = 'phpBB2 Requires the Perl-Compatible Regular Expressions Module for PHP which your PHP configuration doesn\'t appear to support!';
$lang['No_disallowed'] = 'No Disallowed Usernames';
$lang['Upgrade'] = 'Upgrade';
$lang['theme'] = 'Theme';
$lang['wrap_def'] = 'Default Screen Width';
$lang['wrap_enable'] = 'Force Word Wrapping';
$lang['wrap_max'] = 'Maximum Screen Width';
$lang['wrap_min'] = 'Minimum Screen Width';
$lang['wrap_title'] = 'Force Word Wrapping';
$lang['wrap_units'] = 'characters';
//
// Version Check
//
$lang['Activate_deactivate'] = 'Activate/De-activate';
$lang['Active'] = 'Active';
$lang['Add_group'] = 'Add to a Group';
$lang['Add_group_explain'] = 'Select which group to add the selected users to';
$lang['Add_new_search'] = 'Add a new search';
$lang['All'] = 'All';
$lang['Allow_quick_reply'] = 'Allow Quick Reply';
$lang['Anonymous_SQR_mode'] = 'Anonymous Users Quick Reply Mode';
$lang['Anonymous_open_SQR'] = 'Open Quick Reply Form for Anonymous Users automatically';
$lang['Anonymous_show_SQR'] = 'Show Quick Reply Form to Anonymous Users';
$lang['Ascending'] = 'Ascending';
$lang['Ban'] = 'Ban';
$lang['Board_statistic'] = 'Board statistics';
$lang['Cancel'] = 'Cancel';
$lang['Click_return_addsearchadmin'] = 'Click %sHere%s to return to the Add-Search Management Panel';
$lang['Click_return_userlist'] = 'Click %sHere%s to return to the User List';
$lang['Confirm_user_ban'] = 'Are you sure you want to ban the selected user(s)?';
$lang['Confirm_user_deleted'] = 'Are you sure you want to delete the selected user(s)?';
$lang['Connect_socket_error'] = 'Unable to open connection to phpBB Server, reported error is:<br />%s';
$lang['Current_version_info'] = 'You are running <strong>phpBB %s</strong>.';
$lang['DB_size'] = 'Size of the database';
$lang['Database_statistic'] = 'Database statistics';
$lang['Deactivated_Users'] = 'Members in need of Activation';
$lang['Descending'] = 'Descending';
$lang['Filter']='Filter';
$lang['Find_all_posts'] = 'Find All Posts';
$lang['Globalannounce'] ='Global Announce';
$lang['Group'] = 'Group(s)';
$lang['Last_activity'] = 'Last Activity';
$lang['Latest_version_info'] = 'The latest available version is <strong>phpBB %s</strong>. ';
$lang['Mailing_list_subscribe_reminder'] = 'For the latest information on updates to phpBB, why not <a href="http://www.phpbb.com/support/" target="_blank">subscribe to our mailing list</a>.';
$lang['Member'] = 'Member';
$lang['Member_Deactivated'] = 'Member Deactivated';
$lang['Must_enter_search_name'] = 'You must enter the search name';
$lang['Must_select_search'] = 'You must select a quick search';
$lang['Never'] = 'Never';
$lang['Open_close'] = 'Open/Close';
$lang['Pending'] = 'Pending';
$lang['Rank'] = 'Rank';
$lang['SQR_settings'] = 'SQR Settings';
$lang['Search_added'] = 'Search was added successfully';
$lang['Search_explain'] = 'Using this facility, you can add, edit, and select search tools to add in the quick search.';
$lang['Search_name'] = 'Search Name';
$lang['Search_name_explain'] = 'The name display on the search drop down list. Examples: <strong>Yahoo / Google</strong>';
$lang['Search_removed'] = 'Search was removed successfully';
$lang['Search_title'] = 'Quick Search Management';
$lang['Search_updated'] = 'Search was updated successfully';
$lang['Search_url'] = 'Search URL';
$lang['Search_url_explain'] = 'The URL required for search to work. Examples:<br /><span style="color:red">Note: If the search engine needs additional string <strong>AFTER</strong> a</span>&nbsp;<strong>Keyword</strong><span style="color:red">, put the additional string in the second box! You don\'t have to add the word</span>&nbsp;<strong>Keyword</strong>&nbsp;<span style="color:red">of course, just leave it blank.</span><br /><br />- <span style="color:blue">http://search.yahoo.com/search?ei=utf-8&fr=sfp&p=</span><strong>Keyword</strong><br />- <span style="color:blue">http://www.google.com/search?hl=en&ie=utf-8&oe=utf-8&q=</span><strong>Keyword</strong><br />- <span style="color:blue">http://www.alltheweb.com/search?cat=web&cs=utf8&q=</span><strong>Keyword</strong><span style="color:blue">&rys=0&itag=crv&_sb_lang=pref</span><br />';
$lang['Select_one'] = 'Select One...';
$lang['Show'] = 'Show';
$lang['Socket_functions_disabled'] = 'Unable to use socket functions.';
$lang['Sort_Active'] = 'By Active';
$lang['Sort_Last_Activity'] = 'By Last Activity';
$lang['Sort_Rank'] = 'By Rank';
$lang['Sort_User_Level'] = 'By User Level';
$lang['Sort_User_id'] = 'By User id';
$lang['Sort_User_level'] = 'By User Level';
$lang['Thereof_Administrators'] = 'Number of Administrators';
$lang['Thereof_Moderators'] = 'Number of Moderators';
$lang['Thereof_deactivated_users'] = 'Number of non-active members';
$lang['User_add_group_successfully'] = 'User(s) added to group successfully!';
$lang['User_banned_successfully'] = 'User(s) banned successfully!';
$lang['User_deleted_successfully'] = 'User(s) deleted successfully!';
$lang['User_id'] = 'User id';
$lang['User_level'] = 'User Level';
$lang['User_manage'] = 'Manage';
$lang['User_status_updated'] = 'User(s) status updated successfully!';
$lang['Userlist'] = 'User list';
$lang['Userlist_description'] = 'View a complete list of your users and perform various actions on them';
$lang['Users_with_Admin_Privileges'] = 'Members with administrator privileges';
$lang['Users_with_Mod_Privileges'] = 'Members with moderator privileges';
$lang['Version_info'] = 'Version information';
$lang['Version_information'] = 'Version Information';
$lang['Version_not_up_to_date'] = 'Your installation does <strong>not</strong> seem to be up to date. Updates are available for your version of phpBB.';
$lang['Version_of_MySQL'] = 'Version of <a href="http://www.mysql.com/">MySQL</a>';
$lang['Version_of_PHP'] = 'Version of <a href="http://www.php.net/">PHP</a>';
$lang['Version_of_board'] = 'Version of <a href="http://www.phpbb.com">phpbb</a>';
$lang['Version_up_to_date'] = 'Your installation is up to date, no updates are available for your version of phpBB.';
$lang['enable_ropm_quick_reply'] = 'Enable PM Quick Reply';
$lang['ropm_quick_reply'] = 'PM Quick Reply';
$lang['ropm_quick_reply_bbc'] = 'Enable BBCode-Buttons';
$lang['ropm_quick_reply_smilies'] = 'Number of smiley\'s';
$lang['ropm_quick_reply_smilies_info'] = 'You have to enter 0 here, if you don\'t want any smiley\'s to be displayed.';
//
// Quick Search Enable Setting for Board Configuration Panel
//
$lang['ADMIN_IP_LOCK'] = 'Admin IP Lock';
$lang['ADMIN_IP_LOCK_OFF'] = 'Disabled';
$lang['ADMIN_IP_LOCK_ON'] = 'Enabled';
$lang['Action'] = 'Action';
$lang['Add_Admin_Username'] = 'Choose an username to add';
$lang['Add_username_admin_explain'] = 'Choose the name of another Admin that you want to allow to see the logged actions';
$lang['Admin_not_authorized'] = 'Sorry, you\'re not allowed to view this page. Only the main Admin has permission.';
$lang['Admins_add_success'] = 'Admin have been added to the list successfully';
$lang['Admins_del_success'] = 'Admin(s) have been deleted from the list successfully';
$lang['Allow_all_admin'] = 'Allow other Admin\'s to see the Log Actions ?';
$lang['Allow_all_admin_explain'] = 'This option will allow you to choose if only the first admin of the board will be able to see the Log';
$lang['Attach_forum_wrong'] = 'You cannot add a forum to a forum';
$lang['Attach_root_wrong'] = 'You cannot add a forum to the forum-index';
$lang['Board_disable_adminview'] = 'Administrator access when board disabled';
$lang['Board_disable_adminview_explain'] = 'This will allow Administrators to access the entire board when it is disabled.';
$lang['Board_msg_xl'] = 'Board Messages XL';
$lang['Category_attachment'] = 'Attached on';
$lang['Category_config_error_fixed'] = 'An error in the category setup has been fixed';
$lang['Category_delete'] = 'Delete Category';
$lang['Category_delete_explain'] = 'The form below will allow you to delete a category and decide where you want to put all forums and categories it contained.';
$lang['Category_desc'] = 'Description';
$lang['Category_name_missing'] = 'You cannot add a category without a title';
$lang['Choose_log'] = 'Select Log';
$lang['Choose_sort_method'] = 'Choose sorting method';
$lang['Click_return_admin_log'] = 'Click %sHere%s to return to the Log Actions';
$lang['Click_return_admin_log_config'] = 'Click %sHere%s to return to the Log Actions MOD Configuration';
$lang['Click_return_go'] = 'Click %sHere%s to return to group overview';
$lang['Cookie_error_confirm'] = 'Do you want to keep this setting?';
$lang['Cookie_name_error'] = 'The Cookie Name you entered (%s) is a standard cookie name and might cause problems. <br /> A recommend name might be %s';
$lang['Cookie_server_error'] = 'The Cookie Domain you entered (%s) does not match the URL that the server is reporting (%s)';
$lang['Date'] = 'Date';
$lang['Default_avatar'] = 'Set a default avatar';
$lang['Default_avatar_both'] = 'Both';
$lang['Default_avatar_explain'] = 'This gives users that haven\'t yet selected an avatar, a default one. Set the default avatar for guests and users, and then select whether you want the avatar to be displayed for registered users, guests, both or none.<br />The path is \'images/avatars/gallery\'';
$lang['Default_avatar_guests'] = 'Guests';
$lang['Default_avatar_none'] = 'None';
$lang['Default_avatar_users'] = 'Users';
$lang['Delete'] = 'Delete';
$lang['Delete_Admin_Username'] = 'Choose an username to delete';
$lang['Delete_forum_with_attachment_denied'] = 'You cannot delete a forum with sub forums';
$lang['Delete_username_admin_explain'] = 'Choose the name of another Admin that you don\'t want to allow to see the logged actions';
$lang['Done_by'] = 'Done By';
$lang['File_not_deleted'] = 'You have not yet delete the file install_tables.php : do it before trying to see this page.';
$lang['Forum_name_missing'] = 'You cannot add a forum without a title';
$lang['GO_add_member'] = 'Add user';
$lang['GO_closed'] = 'Closed group';
$lang['GO_group'] = 'Group';
$lang['GO_hidden'] = 'Hidden group';
$lang['GO_inform'] = 'Group Information';
$lang['GO_member'] = 'Group Members';
$lang['GO_member_added'] = 'User successfully added to group';
$lang['GO_member_explain'] = '(Click on a username to remove him)';
$lang['GO_mod'] = 'Group Moderator';
$lang['GO_open'] = 'Open group';
$lang['GO_permission'] = 'Group Permissions';
$lang['GO_remove_member'] = 'User successfully removed from group';
$lang['GO_remove_mod'] = 'You can\'t remove the group moderator';
$lang['GO_status'] = 'Group type';
$lang['GO_user'] = 'Members';
$lang['General_Config_Log'] = 'General Configuration of Log Actions MOD';
$lang['Go'] = 'Go';
$lang['Group_Overview'] = 'Group Overview';
$lang['Group_Permissions'] = 'Group Permissions';
$lang['Group_count_delete'] = 'Delete/Update old users';
$lang['Group_count_enable'] = 'Users automatic added when posting';
$lang['Group_count_update'] = 'Add/Update new users';
$lang['Hidden_color'] = 'Hidden text color';
$lang['Icons_settings'] = 'Icons Settings';
$lang['Id_log'] = 'Log Id';
$lang['Initial_user_group'] = 'Initial User Group';
$lang['Initial_user_group_explain'] = 'Sets the Initial usergroup users are put in on signup';
$lang['LOG_Accessed_Administration'] = 'Accessed Administration';
$lang['LOG_Deleted'] = 'Deleted';
$lang['LOG_Empty_Entry'] = '-----';
$lang['Lang_extend_categories_hierarchy'] = 'Category hierarchy';
$lang['Log_Config'] = 'Configuration of the Log';
$lang['Log_Config_explain'] = 'Here, you will be able to configure some options of the Log Actions MOD.';
$lang['Log_Config_updated'] = 'Configuration of Log Actions MOD successful';
$lang['Log_action_explain'] = 'Here you can see your moderators/administrators actions';
$lang['Log_action_title'] = 'Logs Actions';
$lang['Log_delete'] = 'Log deleted successfully.';
$lang['Login_page'] = 'Login page';
$lang['Login_page_explain'] = 'After Login, User is redirected to his Profile (Yes) or to Forum Index page (No)';
$lang['Login_page_index'] = 'Home Page';
$lang['Manage_Extend'] = 'Manage Extended';
$lang['Manage_Fields'] = 'Manage Fields';
$lang['Max_smilies'] = 'Maximum smiley\'s limit per post';
$lang['No_admins_allow'] = 'There are no admin\'s to allow to view the logs';
$lang['No_admins_authorized'] = 'No other Admin\'s authorized';
$lang['No_admins_disallow'] = 'There are no admin\'s to disallow to view the logs';
$lang['No_other_admins'] = 'No other Admin\'s to choose';
$lang['Offline_color'] = 'Offline text color';
$lang['Online_color'] = 'Online text color';
$lang['Online_setting'] = 'Online Status Setting';
$lang['Online_time'] = 'Online status time';
$lang['Online_time_explain'] = 'Number of seconds a user must be displayed online (do not use lower value than 60).';
$lang['Only_forum_for_topics'] = 'Topics could only be found in forums';
$lang['Order'] = 'Order';
$lang['Overall_Permissions'] = 'Overall Permissions';
$lang['Post_Icons'] = 'Post Icons';
$lang['Prune'] = 'Prune Logs';
$lang['Prune_!'] = 'Prune !';
$lang['Prune_explain'] = 'Enter the number of days that you want to prune the logs. 0 = all the logs';
$lang['Prune_of_logs'] = 'Prune of the Logs';
$lang['Prune_success'] = 'Prune of the Logs successful';
$lang['Quick_search_enable'] = 'Enable Quick Search';
$lang['Quick_search_enable_explain'] = 'Shows the Quick Search field in the overall header.';
$lang['Rebuild_Search'] = 'Search Rebuild';
$lang['See_topic'] = 'See the post';
$lang['Select_all'] = 'Select All';
$lang['Topic'] = 'Topic';
$lang['URL_error_confirm'] = 'Do you want to keep this setting?';
$lang['URL_server_error'] = 'The URL you entered (%s) does not match the URL that the server is reporting (%s)';
$lang['Unselect_all'] = 'Unselect All';
$lang['User_Permissions'] = 'User Permissions';
$lang['User_allow_ag'] = "Activate Auto Group";
$lang['User_ip'] = 'User IP';
$lang['admin_style'] = 'Use your site theme\'s style for forum admin';
$lang['allow_logs_view'] = 'Show logs to';
$lang['announce'] = 'Announcement';
$lang['current'] = 'Current';
$lang['current_explain'] = 'This is your current settings for this topic type. This is how it will be displayed on the forum.';
$lang['dhtml_menu'] = 'Use DHTML on Forum Configuration.<br /><small>Makes the Configuration Tables Collapse</small>';
$lang['glance_auth_read_explain'] = 'Show topics the user can view but not read?';
$lang['glance_ignore_forums_explain'] = 'Enter the Forum ID of Forums you would like to be ignored on the recent topics list.<br /><small>Separate Forums with , (1,2,3). Leave blank to show all.</small>';
$lang['glance_news_explain'] = 'Enter the Forum ID of your News Forum<br /><small>Set to 0 if you don\'t have a news forum or don\'t want news displayed. Separate News Forums with , (1,2,3).</small>';
$lang['glance_num_explain'] = 'Enter the amount of recent topics to display';
$lang['glance_num_news_explain'] = 'Enter the number of news articles to display.<br /><small>Set to 0 if you don\'t have a news forum or don\'t want news displayed.</small>';
$lang['glance_override_title'] = 'Override User Settings';
$lang['glance_table_width_explain'] = 'Enter the width you would like the Recent Blocks displayed. (Default : 100%)';
$lang['glance_title'] = 'At a Glance Options';
$lang['glance_topic_length_explain'] = 'Limit the number of characters displayed in topic title.<br /><small>Set to 0 to show full title.</small>';
$lang['global'] = 'Global Announcement';
$lang['group_color'] = 'Select the default color group for this group.';
$lang['group_count'] = 'Number of required posts';
$lang['group_count_explain'] = 'When users have posted more posts than this value <em>(in any forum)</em> then they will be added to this usergroup<br /> This only apply\'s if "'.$lang['Group_count_enable'].'" are enabled';
$lang['group_count_max'] = 'Number of max posts';
$lang['group_count_updated'] = '%d member(s) have been removed, %d members are added to this group';
$lang['group_delete_users'] = 'Remove all group members';
$lang['group_delete_users_check'] = 'Remove all group members of this group';
$lang['group_delete_users_explain'] = '(Exclude the group moderator)';
$lang['group_rank'] = 'Select the default rank for this group.';
$lang['group_users_removed'] = 'All members of group successfully removed.';
$lang['hide_emails'] = 'Hide Email links to Guests';
$lang['hide_images'] = 'Hide Images to Guests';
$lang['hide_links'] = 'Hide Links to Guests';
$lang['image_resize_height'] = 'Resize Image Height';
$lang['image_resize_width'] = 'Resize Image Width';
$lang['locked'] = 'Locked Topic';
$lang['logs_view_level'][0] = 'Admin\'s, Mod\'s, Users, Anonymous';
$lang['logs_view_level'][1] = 'Admin\'s, Mod\'s, Users';
$lang['logs_view_level'][2] = 'Admin\'s';
$lang['logs_view_level'][3] = 'Admin\'s, Mod\'s';
$lang['max_inbox'] = "Maximum Size of User's Private Message Inbox";
$lang['max_savebox'] = "Maximum Size of User's Private Message Savebox";
$lang['max_sentbox'] = "Maximum Size of User's Private Message Sentbox";
$lang['moved'] = 'Moved';
$lang['once_settings'] = 'Show Once Per Post';
$lang['override_max'] = "Override Main Board Setting";
$lang['pm_allow_threshold'] = 'Allow PM threshold';
$lang['pm_allow_threshold_explain'] = 'Set here the minimal amount of posts the user has to write before being able to use the private messages.';
$lang['show_avatar_once'] = 'Show avatar once per post';
$lang['show_edited_logs'] = 'Show Topic Edit logs';
$lang['show_locked_logs'] = 'Show Topic Locked logs';
$lang['show_moved_logs'] = 'Show Topic Moved logs';
$lang['show_rank_once'] = 'Show rank once per post';
$lang['show_sig_once'] = 'Show sig once per post';
$lang['show_splitted_logs'] = 'Show Topic Splitted logs';
$lang['show_unlocked_logs'] = 'Show Topic Unlocked logs';
$lang['show_users_today'] = 'Show users who logged on today on Index<br /><small>Note: Not Recommended for large sites</small>';
$lang['sig_divider'] = 'Current Signature Divider';
$lang['sig_explain'] = 'This is where you control what divides the user\'s signature from their post';
$lang['sig_title'] = 'Advanced Signature Control';
$lang['smilies_in_titles'] = 'Show Smiley\'s in Topic Titles';
$lang['sticky'] = 'Sticky';
$lang['tag'] = 'Change the view (Please do not use quotes or slashes in your html. Ex: &lt;font color=#FFFFFF&gt;Title&lt;/font&gt;)';
$lang['topic_explain'] = 'You can use any form of HTML to do this. You can customize a different style for each topic type';
$lang['topic_title'] = 'Topic Title';
$lang['topic_view_settings'] = 'Customized Topic View';
$lang['user_hide_images'] = 'Hide Images in Forums';
$lang['user_posts'] = 'User Post Count';
//
// forum links type
//
$lang['Auth_Control_Forum'] = 'Authorization Control Forum';
$lang['Category_with_topics_deny'] = 'Topics remains in this forum. You can\'t change it into a category.';
$lang['Edit_Profile_Panel_Feel'] = 'Edit Profile - Panel Feel Menu';
$lang['Edit_Profile_Panel_Feel_config'] = 'Panel Feel Configuration';
$lang['Edit_Profile_Panel_Feel_explain'] = 'Choose which side of the site you would like the Edit Profile Menu to be displayed when your users are editing their profile.<br /><br />Options Explained:<br />Right and Left are obvious but Off means that the menu won\'t be displayed at all and the Edit Profile section will be 1 large form like it used to be.';
$lang['Forum_attached_to_link_denied'] = 'You can\'t attach a forum or a category to a forum link';
$lang['Forum_auth_explain_overall'] = 'In this panel you can set easily the authorizations for all your forums.';
$lang['Forum_auth_explain_overall_edit'] = 'Click above on one of the authentication levels and go to the forum you want to edit. There click on the authorization you want to change.';
$lang['Forum_auth_overall_restore'] = 'Click here for restore mode';
$lang['Forum_auth_overall_stop'] = 'Click here to stop editing/restoring';
$lang['Forum_link_hit_count'] = 'Hit count';
$lang['Forum_link_hit_count_explain'] = 'Choose yes if you want the board to count and display the number of hit using this link';
$lang['Forum_link_internal'] = 'phpBB prog';
$lang['Forum_link_internal_explain'] = 'Choose yes if you invoke a program that stands in the phpBB dirs';
$lang['Forum_link_url'] = 'Link URL';
$lang['Forum_link_url_explain'] = 'You can set here an URI to a phpBB prog, or a full URL to an external server';
$lang['Forum_link_with_attachment_deny'] = 'You can\'t set a forum as a link if it has already sub-levels';
$lang['Forum_link_with_topics_deny'] = 'You can\'t set a forum as a link if it has already topics in';
$lang['Forum_type'] = 'Select Forum Type';
$lang['Forum_with_attachment_denied'] = 'You can\'t change a category with forums attached to into a forum';
$lang['Icons_auth'] = 'Auth level';
$lang['Icons_auth_explain'] = 'The icon will be available only to the users suiting this requirement';
$lang['Icons_confirm_delete'] = 'Are you sure you want to delete this one ?';
$lang['Icons_defaults'] = 'Default assignment';
$lang['Icons_defaults_explain'] = 'Those assignments will be used on the topics lists when no icon is defined for a topic';
$lang['Icons_delete'] = 'Delete an icon';
$lang['Icons_delete_explain'] = 'Please choose an icon in order to replace this one :';
$lang['Icons_error_del_0'] = 'You can\'t remove the default empty icon';
$lang['Icons_error_title'] = 'The icon title is empty';
$lang['Icons_icon_key'] = 'Icon';
$lang['Icons_icon_key_explain'] = 'Icon url or key to the images array. <br />(check templates/<em>your_template</em>/<em>your_template</em>.cfg)';
$lang['Icons_lang_key'] = 'Icon title';
$lang['Icons_lang_key_explain'] = 'The icon title will be displayed when the user set his mouse on the icon (title or alt HTML statement). You can use text, or a key of the language array. <br />(check language/lang_<em>your_language</em>/lang_main.php).';
$lang['Icons_settings_explain'] = 'Here you can add, edit or delete posts icons';
$lang['Image_key_pick_up'] = 'Pick up an image key';
$lang['Lang_extend'] = 'Language Extend Management';
$lang['Lang_extend__custom'] = 'Custom language pack';
$lang['Lang_extend__phpBB'] = 'phpBB language pack';
$lang['Lang_extend_add_entry'] = 'Add a new lang key entry';
$lang['Lang_extend_added'] = 'Added';
$lang['Lang_extend_added_modified'] = '*';
$lang['Lang_extend_delete_done'] = 'The entry has been successfully deleted.<br />Note that only customized key entries are deleted, not the basic key entries if exist.<br /><br />Click %sHere%s to return to entries list';
$lang['Lang_extend_duplicate_entry'] = 'This entry already exists (see pack %)';
$lang['Lang_extend_entries'] = 'Language key entries';
$lang['Lang_extend_entry'] = 'Language key entry';
$lang['Lang_extend_explain'] = 'Here you can add or modify languages key entries';
$lang['Lang_extend_key_main'] = 'Language main key entry';
$lang['Lang_extend_key_main_explain'] = 'This is the main key entry, usually the only one';
$lang['Lang_extend_key_missing'] = 'Main entry key is missing';
$lang['Lang_extend_key_sub'] = 'Secondary key entry';
$lang['Lang_extend_key_sub_explain'] = 'This second level key entry is usually not used';
$lang['Lang_extend_lang_extend'] = 'Extension for languages packs';
$lang['Lang_extend_level'] = 'Level of the lang key entry';
$lang['Lang_extend_level_admin'] = 'Admin';
$lang['Lang_extend_level_explain'] = 'Admin level can only be used in the admin configuration panel. Normal level can be used everywhere.';
$lang['Lang_extend_level_leg'] = 'Level';
$lang['Lang_extend_level_normal'] = 'Normal';
$lang['Lang_extend_merge']= 'Merge Topics';
$lang['Lang_extend_missing_value'] = 'You have to provide at least the English value';
$lang['Lang_extend_modified'] = 'Modified';
$lang['Lang_extend_pack'] = 'Language Pack';
$lang['Lang_extend_pack_explain'] = 'This is the name of the pack, usually the name of the MOD referring to';
$lang['Lang_extend_post_icons'] = 'Post Icons';
$lang['Lang_extend_ranks'] = 'Ranks';
$lang['Lang_extend_search'] = 'Search in language key entries';
$lang['Lang_extend_search_all'] = 'All words';
$lang['Lang_extend_search_all_lang'] = 'All languages installed';
$lang['Lang_extend_search_in'] = 'Search in';
$lang['Lang_extend_search_in_both'] = 'both';
$lang['Lang_extend_search_in_explain'] = 'Precise where to search';
$lang['Lang_extend_search_in_key'] = 'keys';
$lang['Lang_extend_search_in_value'] = 'values';
$lang['Lang_extend_search_no_words'] = 'No words to search provided.<br /><br />Click %sHere%s to return to the pack list.';
$lang['Lang_extend_search_one'] = 'One of those';
$lang['Lang_extend_search_results'] = 'Search results';
$lang['Lang_extend_search_words'] = 'Words to find';
$lang['Lang_extend_search_words_explain'] = 'Separate words with a space';
$lang['Lang_extend_update_done'] = 'The entry has been successfully updated.<br /><br />Click %sHere%s to return to the entry.<br /><br />Click %sHere%s to return to entries list';
$lang['Lang_extend_value'] = 'Value';
$lang['Lang_key_pick_up'] = 'Pick up a lang key';
$lang['Lang_management'] = 'Management';
$lang['Languages'] = 'Languages';
$lang['Link_missing'] = 'Link is missing';
$lang['Manage_extend'] = 'Configuration +';
$lang['No_subforums'] = 'No Sub forums';
$lang['Position_after'] = 'Position after';
$lang['Presets'] = 'Presets';
$lang['Rebuild_Search_Next'] = 'Next'; // No UTF-8 is here available because this variable is shown in JavaScript
$lang['Recursive_attachment'] = 'You can\'t attach a forum to a lowest level of its own branch (recursive attachment)';
$lang['Refresh'] = 'Refresh';
$lang['Refresh'] = 'Refresh';
$lang['Usage'] = 'Usage';
$lang['icon'] = 'Icon';
$lang['icon_explain'] = 'This icon will be displayed in front of the forum title. You can set here a direct URI or a $image[] key entry (see <em>your_template</em>/<em>your_template</em>.cfg).';

?>