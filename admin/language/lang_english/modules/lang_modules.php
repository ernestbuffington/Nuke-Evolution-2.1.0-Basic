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
$lang_admin[$adminpoint]['MODULES_ACTIVATE'] = 'Activate';
$lang_admin[$adminpoint]['MODULES_ACTIVE'] = 'Module is active.';
$lang_admin[$adminpoint]['MODULES_ADMIN_HEADER'] = 'Modules :: Admin Panel';
$lang_admin[$adminpoint]['MODULES_ALL'] = 'All';

$lang_admin[$adminpoint]['MODULES_BLOCK'] = 'Module block';
$lang_admin[$adminpoint]['MODULES_BLOCKS_BOTH'] = 'Both Blocks';
$lang_admin[$adminpoint]['MODULES_BLOCKS_LEFT'] = 'Left Blocks';
$lang_admin[$adminpoint]['MODULES_BLOCKS_NONE'] = 'None';
$lang_admin[$adminpoint]['MODULES_BLOCKS_RIGHT'] = 'Right Blocks';
$lang_admin[$adminpoint]['MODULES_BLOCKS_SHOW'] = 'Show Blocks';

$lang_admin[$adminpoint]['MODULES_CAT_COLLAPSE'] = 'Collapse this category in start? ';
$lang_admin[$adminpoint]['MODULES_CAT_DELETE'] = 'Delete Category';
$lang_admin[$adminpoint]['MODULES_CAT_EDIT'] = 'Edit Category';
$lang_admin[$adminpoint]['MODULES_CAT_IMG'] = 'physical name of this image';
$lang_admin[$adminpoint]['MODULES_CAT_IMG_NOTE'] = 'Category Images must be stored in <i>images/blocks/modules/</i>.';
$lang_admin[$adminpoint]['MODULES_CAT_LINK_TITLE'] = 'Link Title';
$lang_admin[$adminpoint]['MODULES_CAT_ORDER'] = 'Change Order of the Categories';
$lang_admin[$adminpoint]['MODULES_CAT_TITLE'] = 'Category Title';
$lang_admin[$adminpoint]['MODULES_COLLAPSE'] = 'Collapsible Categories ?';
$lang_admin[$adminpoint]['MODULES_CUSTOMTITLE'] = 'Custom Title';

$lang_admin[$adminpoint]['MODULES_DEACTIVATE'] = 'Deactivate';
$lang_admin[$adminpoint]['MODULES_DOUBLECLICK'] = '(Double click to activate/deactivate)';

$lang_admin[$adminpoint]['MODULES_EDIT'] = 'Change Module';
$lang_admin[$adminpoint]['MODULES_ERROR_CAT_NF'] = 'The Category wasn\'t found';
$lang_admin[$adminpoint]['MODULES_ERROR_GROUPS'] = 'You must select at least one group';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE'] = 'You have to insert Title and Link';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EMPTY'] = 'You have to insert a Title';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EXIST'] = 'The Title you inserted already exists<br />Please try again<br /><br />';
$lang_admin[$adminpoint]['MODULES_EXPLAIN'] = 'Please note, if you activate or deactivate a module here<br />changes will be shown instantly to users, but You must refresh your screen to see these changes!';
$lang_admin[$adminpoint]['MODULES_EXPLAIN2'] = 'You <strong>MUST</strong> save the changes of sort order before they are activated!';

$lang_admin[$adminpoint]['MODULES_FUNCTIONS'] = 'Functions';

$lang_admin[$adminpoint]['MODULES_INACTIVE'] = 'Module is not activated.';
$lang_admin[$adminpoint]['MODULES_INHOME'] = 'Module shown on Homepage:';

$lang_admin[$adminpoint]['MODULES_LINK'] = 'Is a Link';
$lang_admin[$adminpoint]['MODULES_LINK_DELETE'] = 'Delete Link';

$lang_admin[$adminpoint]['MODULES_MODULEHOMENOTE'] = 'The Module Title in Bold is the Module that is shown on the Homepage of your Website.<br />As long as this Module is the active Module, it may NOT be deleted.!<br />If you delete the directory of this module without changing it here first, an error message will be shown on your Homepage.<br />This Module is loaded if you click <i>home</i> in a menu.';
$lang_admin[$adminpoint]['MODULES_MODULEINFO'] = 'Info';
$lang_admin[$adminpoint]['MODULES_MVADMIN'] = 'Only Administrators';
$lang_admin[$adminpoint]['MODULES_MVALL'] = 'All Visitors';
$lang_admin[$adminpoint]['MODULES_MVANON'] = 'Only Guests';
$lang_admin[$adminpoint]['MODULES_MVGROUPS'] = 'Only Group members';
$lang_admin[$adminpoint]['MODULES_MVUSERS'] = 'Only registered Users';

$lang_admin[$adminpoint]['MODULES_NF_VALUES'] = 'No values available';
$lang_admin[$adminpoint]['MODULES_NOTINMENU'] = 'Define a Module whose name isn\'t shown in Menu';

$lang_admin[$adminpoint]['MODULES_REFRESH SCREEN'] = 'Refresh Screen';

$lang_admin[$adminpoint]['MODULES_SAVECHANGES'] = 'Save Changes';
$lang_admin[$adminpoint]['MODULES_SHOW'] = 'Show';
$lang_admin[$adminpoint]['MODULES_SHOWINMENU'] = 'Shown in menu?';

$lang_admin[$adminpoint]['MODULES_TITLE'] = 'Title';

$lang_admin[$adminpoint]['MODULES_URL'] = 'URL';

$lang_admin[$adminpoint]['MODULES_VIEW'] = 'View';
$lang_admin[$adminpoint]['MODULES_VIEWPRIV'] = 'Who can view this';

$lang_admin[$adminpoint]['MODULES_WHATGRDESC'] = 'Which Groups';
$lang_admin[$adminpoint]['MODULES_WHATGROUPS'] = 'Groups';

?>