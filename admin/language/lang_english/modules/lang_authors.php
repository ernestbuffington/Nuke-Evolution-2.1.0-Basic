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

if (!defined('ADMIN_FILE')) {
die('You can\'t access this file directly...');
}

global $adminpoint;

$lang_admin[$adminpoint]['BUTTON_ADMIN_ADD'] = 'Create Administrator';
$lang_admin[$adminpoint]['BUTTON_ADMIN_CHANGE'] = 'Change Administrator';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DELETE'] = 'Delete Administrator';
$lang_admin[$adminpoint]['BUTTON_ADMIN_DOIT'] = 'OK';
$lang_admin[$adminpoint]['BUTTON_USER_PROMOTE'] = 'Promote User';

$lang_admin[$adminpoint]['ERROR_ADMIN_WRONGAID'] = 'It seems, that a transition error occurred. Please try again.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_EMAIL_INVALID'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'].'" doesn\'t map the specifications of a correct email address in the system.(special characters, spaces a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_LANGUAGE'] = 'It seems, that a transitions error has occurred. We didn\'t find the language in our system.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_AND_SUPER_EMPTY'] = 'No rights permitted - neither as SuperAdmin nor as ModuleAdmin';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_MODULE_NOTEXIST'] = 'One or more of the module rights permitted, are not available in our database.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_BADWORD'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" contains words that are not allowed . This is the changed content';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_EXISTS'] = 'An Administrator with this User name already exists.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_GOD_CHANGE'] = 'The name for God-Admin isn\'t allowed to be changed';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_INVALID'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" doesn\'t map the specifications of a correct name in the system.(special characters, spaces a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_NAME_SIZE'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'].'" is %s characters long and therefore shorter than 3 characters or longer than 30 characters. Please note, that some characters are stored multibyte.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD2_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_PASSWORD_NOT_MATCH'] = 'The Passwords do not match';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_URL_INVALID'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_URL'].'" doesn\'t map the specifications of a correct URL in the system.(special characters, spaces a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_BADWORD'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" contains words that are not allowed . This is the changed content';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EMPTY'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" isn\'t allowed to be empty';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_EXISTS'] = 'An Administrator with this User name already exists.';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_INVALID'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" doesn\'t map the specifications of a correct username in the system.(special characters, spaces a.s.o.)';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_NOT_EXIST'] = 'The username specified isn\'t in our database';
$lang_admin[$adminpoint]['ERROR_CHECK_FIELD_USERNAME_SIZE'] = 'The field "'.$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'].'" is %s characters long and therefore shorter than 3 characters or longer than 30 characters. Please note, that some characters are stored multibyte.';
$lang_admin[$adminpoint]['ERROR_DB_INSERT_ADMIN'] = 'An error occurred during insertion of the Administrator into the Database.';
$lang_admin[$adminpoint]['ERROR_USER_ISADMIN'] = 'The selected user has already been promoted to admin';

$lang_admin[$adminpoint]['FIELDSET_PERMISSIONS'] = 'Permissions';
$lang_admin[$adminpoint]['FIELD_ADMIN_EMAIL'] = 'Email-Address';
$lang_admin[$adminpoint]['FIELD_ADMIN_LANGUAGE'] = 'Language';
$lang_admin[$adminpoint]['FIELD_ADMIN_NAME'] = 'Real name';
$lang_admin[$adminpoint]['FIELD_ADMIN_NO'] = 'No';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD'] = 'Password';
$lang_admin[$adminpoint]['FIELD_ADMIN_PASSWORD2'] = 'Confirm Password';
$lang_admin[$adminpoint]['FIELD_ADMIN_URL'] = 'Website';
$lang_admin[$adminpoint]['FIELD_ADMIN_USERNAME'] = 'Account name';
$lang_admin[$adminpoint]['FIELD_ADMIN_YES'] = 'Yes';
$lang_admin[$adminpoint]['FIELD_NOTCHANGEABLE'] = 'Field not changeable';

$lang_admin[$adminpoint]['GOD_ADMIN'] = 'God Admin';

$lang_admin[$adminpoint]['HEAD_BACK'] = 'Back to Main Administration;';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINADD'] = 'Create new Administration Account';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINCHANGE'] = 'Change Administrator';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINDELETE'] = 'Delete an Administrator';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_ADMINSHOW'] = 'Show Administrator';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_MAIN'] = 'List of Administrators';
$lang_admin[$adminpoint]['HEAD_SUBTITLE_PROMOTEUSER'] = 'Promoting Users to Administrator';
$lang_admin[$adminpoint]['HEAD_TITLE'] = 'Admins Administration';
$lang_admin[$adminpoint]['HELP_FIELDSET_PERMISSIONS'] = 'Here you can permit Module rights for this Administrator. Check every Module this Administrator should be allowed to administrate.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_EMAIL'] = 'Email Address of the Administrator. All messages to this Administrator are sent to this Email Address.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_LANGUAGE'] = 'Like in the Users Profiles, the site language is set for this Administrator.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_NAME'] = 'Input here is obligatory! The name(s) of all Administrators as well as all of their actions are stored and shown within the system by their Username(s). A Username is not allowed to exist twice within the system so a check must be performed to be sure your chosen name does not already exist.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD'] = 'The Password must be between 4 and 12 characters long - no spaces or special signs allowed.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_PASSWORD2'] = 'This Password field must match the above field. If an error occurs please check both fields for typographical errors.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_SUPERUSER'] = 'Attention!! A Superuser has nearly the same rights as the God-Admin !! Permit this ONLY if you\'re absolutely positive you can trust this user.';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_URL'] = 'Website of the Administrator. We want to disable an Administrator voting for on their own website or it\'s content.)';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME'] = 'Input here is obligatory! The Account name of the Administrator isn\'t allowed to exist twice within the system (not as Admin or User account name).';
$lang_admin[$adminpoint]['HELP_FIELD_ADMIN_USERNAME_PROMOTE'] = 'This field is not changeable if you promote a User to Administrator, because this field MUST be an existing username.';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_PASSWORDCHANGE'] = 'To change Passwords, this field must be checked. After that, the fields are enabled for input.';
$lang_admin[$adminpoint]['HELP_OPTION_ADMIN_SUPERUSER'] = 'If an Administrator is a Superuser, no Module rights need to be permitted. A Superuser IS allowed to administrate ALL Modules, please be advised.';

$lang_admin[$adminpoint]['INFO_ADMIN_GOD_NODELETE'] = 'The Administrator '.$lang_admin[$adminpoint]['GOD_ADMIN'].' can\'t be deleted';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_AFTERLINK'] = 'to get help for creating strong passwords';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_BEFORELINK'] = 'Click';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_CURRENTSTRENGTH'] = 'Current Strength';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_LINK'] = 'here';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_MEDIUM'] = 'Medium';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_NOTRATED'] = 'Not Rated Yet';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONG'] = 'Strong';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGER'] = 'Stronger';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_STRONGEST'] = 'Strongest';
$lang_admin[$adminpoint]['INFO_ADMIN_PW_WEAK'] = 'Weak';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_ADDED'] = 'The Administrator Account was successfully created';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED'] = 'The Administrator Account was successfully changed';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_CHANGED_LOGOUT'] = 'You must logout from the system to activate your changes';
$lang_admin[$adminpoint]['INFO_ADMIN_SUCCESSFULL_DELETED'] = 'The Administrator Account was successfully deleted';
$lang_admin[$adminpoint]['INFO_ADMIN_SUPERUSER_WARN'] = 'WARNING! Superusers have nearly full access, please be advised!!';
$lang_admin[$adminpoint]['INFO_FIELD_NOTCHANGEABLE'] = 'Field not changeable';

$lang_admin[$adminpoint]['MENUE_ADMIN_ADD'] = 'Create new Administrator';
$lang_admin[$adminpoint]['MENUE_ADMIN_PROMOTE'] = 'Promote User to Administrator';
$lang_admin[$adminpoint]['MENUE_ADMIN_SHOW'] = 'Show Administrators';

$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_CHANGE'] = 'Change';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_DELETE'] = 'Delete';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SELECT'] = 'Select Action';
$lang_admin[$adminpoint]['OPTION_ADMIN_ACTION_SHOW'] = 'Show';
$lang_admin[$adminpoint]['OPTION_ADMIN_PASSWORDCHANGE'] = 'Should the Password be changed';
$lang_admin[$adminpoint]['OPTION_ADMIN_SUPERUSER'] = 'Superuser';
$lang_admin[$adminpoint]['OPTION_ALL_LANGS'] = 'All Languages';

$lang_admin[$adminpoint]['QUEST_ADMIN_CHANGE'] = 'Change Administrator';
$lang_admin[$adminpoint]['QUEST_ADMIN_DELETE'] = 'Delete Administrator';

$lang_admin[$adminpoint]['TABLE_ADMIN_ACTION'] = 'Action';
$lang_admin[$adminpoint]['TABLE_ADMIN_EMAIL'] = 'Email-Address';
$lang_admin[$adminpoint]['TABLE_ADMIN_LANGUAGE'] = 'Language';
$lang_admin[$adminpoint]['TABLE_ADMIN_NAME'] = 'Real name';
$lang_admin[$adminpoint]['TABLE_ADMIN_REGDATE'] = 'Registration Date';
$lang_admin[$adminpoint]['TABLE_ADMIN_SUPERUSER'] = 'Superuser';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERID'] = 'ID';
$lang_admin[$adminpoint]['TABLE_ADMIN_USERNAME'] = 'Account name';

$lang_admin[$adminpoint]['WARNING_ADMIN_DELETE'] = 'Are you sure you want to delete this Administrator Account';

?>