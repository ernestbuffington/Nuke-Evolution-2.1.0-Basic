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

// Delete words
$lang['Are_you_sure'] = 'Are you sure you want to delete field "%s"?';
$lang['Confirm'] = 'Confirm';
// Edit/Add words
$lang['Add_success'] = 'Field added successfully';
$lang['Advanced_Options'] = 'Advanced Options';
$lang['Advanced_warning'] = 'Don\'t change anything here unless you know what you\'re doing.';
$lang['Allow_BBCode'] = 'Allow BBCode';
$lang['Allow_html'] = 'Allow HTML';
$lang['Allow_smilies'] = 'Allow Smilies';
$lang['Basic_Options'] = 'Basic Options';
$lang['Checkbox'] = 'Checkbox';
$lang['Click_return_fields'] = 'Click %shere%s to return to Fields Administration';
$lang['Code_name'] = 'Name in Templates';
$lang['Code_name_explain'] = 'If any of the above is set to "TPL Variable", this will be tha name of the variable the data is asigned to.';
$lang['Custom'] = 'Custom';
$lang['Date'] = 'Date';
$lang['Default_auth'] = 'Default Permissions';
$lang['Default_auth_explain'] = 'Users will only be able to edit this field in their profiles if this option or their personal permission is set to "allow".';
$lang['Delete_success'] = 'Field deleted successfully';
$lang['Display_none'] = 'None';
$lang['Display_normal'] = 'Normal';
$lang['Display_register_explain'] = 'When editing profiles';
$lang['Display_root'] = 'TPL Variable';
$lang['Display_type'] = 'Display Type';
$lang['Display_viewprofile_explain'] = 'When viewing profiles';
$lang['Display_viewtopic_explain'] = 'When viewing posts';
$lang['Edit_success'] = 'Field information updated successfully';
$lang['Length'] = 'Length';
$lang['Length_explain'] = 'The maximum length for a text or textarea field.  Zero means unlimited.';
$lang['Name'] = 'Name';
$lang['Radio'] = 'Radio Buttons';
$lang['Regexp'] = 'Regular Expression';
$lang['Regexp_error'] = 'You have an error in your regular expression syntax:';
$lang['Regexp_explain'] = 'Only values matching this regular expression will be allowed. (PCRE-Style)';
$lang['Select'] = 'Select Box';
$lang['Signup'] = 'Display during sign up';
$lang['Text'] = 'Text';
$lang['Text_area'] = 'Text Area';
$lang['Values'] = 'Values';
$lang['Values_explain'] = 'The options that will appear for a select or radio field.  Each option should be enclosed with single quotes [\'].';
$lang['Viewtopic'] = 'Display when viewing topics';
$lang['add_xdata_field'] = 'Add Profile Field';
$lang['custom'] = 'Custom';
$lang['edit_xdata_field'] = 'Edit Profile Field';
$lang['handle_input'] = 'Handle Input';
$lang['handle_input_explain'] = 'Select "yes" unless you want to make your own input handler for this field.';
$lang['letters'] = 'Letters Only';
$lang['manditory'] = 'Make Manditory';
$lang['none'] = 'None';
$lang['numbers'] = 'Numbers Only';
$lang['type'] = 'Type';
$lang['xd_description'] = 'Description';
// Error
$lang['XD_duplicate_name'] = 'A field already exists with the template name you chose.';
// Main Menu words
$lang['Add_field'] = 'Add New Field';
$lang['Delete_field'] = 'Delete';
$lang['Edit_field'] = 'Edit';
$lang['No_fields'] = 'No fields exist';
$lang['Profile_admin'] = 'Profile Fields Administration';
$lang['Xdata_view_description'] = 'Here you can view and edit the extra fields available in users\' profiles.';
$lang['xd_move'] = 'Move';
$lang['xd_move_down'] = 'Move Down';
$lang['xd_move_up'] = 'Move Up';
$lang['xd_operations'] = 'Operations';
// Permissions words
$lang['Allow'] = 'Allow';
$lang['Default'] = 'Default';
$lang['Deny'] = 'Deny';
$lang['field_name'] = 'Field Name';
$lang['xd_group_permissions'] = 'XDATA Group Permissions';
$lang['xd_group_permissions_describe'] = 'Here you can alter the ability of groups to fill in custom profile fields.';
$lang['xd_permissions'] = 'XData Permissions Control';
$lang['xd_permissions_describe'] = 'Here you can alter the ability of users to fill in custom profile fields.';

?>