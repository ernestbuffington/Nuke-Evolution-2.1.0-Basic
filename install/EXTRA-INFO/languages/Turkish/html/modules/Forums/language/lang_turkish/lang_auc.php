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

if(!defined('NUKE_EVO')) { die('Bu dosyaya direkt olarak erişmeniz YASAKLANMIŞTIR'); }

//
// Admin Panel  - Common
//
$lang['error']                  = 'Error';
$lang['information']            = 'Information';
$lang['success']                = 'Success';
//
// Message Die's - Config Panel
//
$lang['Return_to_config']       = 'Return to %sAUC Config%s';
$lang['Return_to_management']   = 'Return to %sAUC Management%s';
$lang['add_error']              = 'Both Fields Required To Add A Color Group.';
$lang['add_error_2']            = 'This Colorgroup Already Exists.';
$lang['add_error_3']            = 'HTML Colors are 6 digits.';
$lang['add_success']            = 'Color Information Saved.';
$lang['delete_error']           = 'Select One To Delete.';
$lang['delete_success']         = 'Color Data Deleted. Users With That Data Have Been Reset.';            
$lang['edit_error']             = 'Select A Colorgroup Name To Edit First.';
$lang['save_error']             = 'Both Fields Required To Update A Group.';
$lang['save_error_1']           = 'That Colorgroup Name Is Already In Use.';
//
// Management Panel
//
$lang['choose_user_id_error']   = 'You did not add usernames or select one from the drop down.';
$lang['group_delete_user_2']    = 'User Color Data Updated.';
//
// Config Panel
//
$lang['add_new_color']          = 'Add New Color';
$lang['add_new_color_1']        = 'Colorgroup Name<br /><span class="gensmall">Example: Support Team</span>';
$lang['add_new_color_2']        = 'Colorgroup Color<br /><span class="gensmall">Example: FFFFFF, Use HTML color codes.</span>';
$lang['add_new_color_3']        = ' Add This ';
$lang['admin_main_header_c']    = 'Advanced Username Color: Configuration';
$lang['admin_main_header_m']    = 'Advanced Username Color: Management';
$lang['delete_color']           = 'Delete A Color Group';
$lang['delete_color_1']         = 'Choose A Colorgroup To Delete<br /><span class="gensmall">Uyarı: This will drop all users from this colorgroup as well.</span>';
$lang['delete_color_2']         = 'Delete Options';
$lang['delete_color_3']         = ' Delete Colorgroup ';
$lang['edit_color']             = 'Edit Existing Color Group';
$lang['edit_color_1']           = 'All Colorgroups Are Listed.';
$lang['edit_color_2']           = 'Select One';
$lang['edit_color_3']           = ' Edit This ';
$lang['editing_color']          = 'Changeable Information Is Below';
$lang['editing_color_1']        = 'Change Colorgroup Name';
$lang['editing_color_2']        = 'Change Group Color<br /><span class="gensmall">Example: FFFFFF, Use HTML color codes.</span>';
$lang['editing_color_3']        = ' Save This ';
$lang['move_down']              = 'Down';
$lang['move_up']                = 'Up';
$lang['view_group_colors']      = 'Group HTML Color';
$lang['view_group_colors_2']    = 'Example';
$lang['view_group_colors_3']    = 'Username Color';
$lang['view_group_names']       = 'Colorgroup Titles';
//
// Management Panel
//
$lang['choose_group']           = 'Choose A Colorgroup To Manage';
$lang['choose_group_2']         = 'Existing Colorgroups To Add Members To';
$lang['choose_group_3']         = 'Choose One';
$lang['choose_group_4']         = ' Select Group ';
$lang['group_already_assigned'] = 'Users Already In this Colorgroup';
$lang['group_assign']           = 'Add a User to this Colorgroup';
$lang['group_assign_1']         = ' Add to Colorgroup ';
$lang['group_assign_2']         = 'Add Multiple Users to this Colorgroup, Drop A Line For Each User.';
$lang['group_delete_user']      = 'Delete a User from this Colorgroup';
$lang['group_delete_user_1']    = ' Remove User ';
$lang['group_selected']         = 'You are adding to: <strong>%G%</strong>';
$lang['group_user_added']       = 'User Data Updated.';
//
// Listing Page
//
$lang['added_to_group']         = 'Added to this Colorgroup';
$lang['changed_user_color']     = 'Color changed';
$lang['deleted_from_group']     = 'Deleted from Colorgroup';
$lang['goup_group']             = 'Add A Forum Group To This Group';
$lang['listing_left']           = 'User';
$lang['listing_none']           = 'There Are No Members Yet Added To The %s Colorgroup.';
$lang['listing_right']          = 'User Info';

?>