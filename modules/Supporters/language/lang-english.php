<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

global $supporter_config, $module_name;

$lang_new[$module_name]['SP_ACTIVATE'] = 'Activate';
$lang_new[$module_name]['SP_ACTIVESITES'] = 'Active Sites';
$lang_new[$module_name]['SP_ADDED'] = 'Added';
$lang_new[$module_name]['SP_ADDSUPPORTER'] = 'Add a Supporter';
$lang_new[$module_name]['SP_ADMINMAIN'] = 'Supporters Administration';
$lang_new[$module_name]['SP_ADMIN_HEADER'] = 'Supporters :: Modules Admin Panel';
$lang_new[$module_name]['SP_ALLREQ'] = 'All Fields Required';
$lang_new[$module_name]['SP_APPROVE'] = 'Approve';
$lang_new[$module_name]['SP_APPROVESITE'] = 'Approve Site';
$lang_new[$module_name]['SP_BESUPPORTER'] = 'Be A Supporter';
$lang_new[$module_name]['SP_CONFBANN'] = 'Bad Upload';
$lang_new[$module_name]['SP_CONFIGMAIN'] = 'Supporters Configuration';
$lang_new[$module_name]['SP_DBERROR1'] = 'ERROR: Failed to write to database';
$lang_new[$module_name]['SP_DEACTIVATE'] = 'Deactivate';
$lang_new[$module_name]['SP_DELETESITE'] = 'Delete Site';
$lang_new[$module_name]['SP_DESCRIPTION'] = 'Description';
$lang_new[$module_name]['SP_EDITED'] = 'Last change';
$lang_new[$module_name]['SP_EDITED_USER'] = 'changed by';
$lang_new[$module_name]['SP_EDITSITE'] = 'Edit Site';
$lang_new[$module_name]['SP_EDITSITE'] = 'Modify Site';
$lang_new[$module_name]['SP_FILETYPERROR'] = 'Wrong file type. Only images (gif, jpg, jpeg, png, swf) are allowed';
$lang_new[$module_name]['SP_GOTOADMIN'] = 'Supporter Administration';
$lang_new[$module_name]['SP_IMAGE'] = 'Site Image';
$lang_new[$module_name]['SP_IMAGETYPE'] = 'Image Link Type';
$lang_new[$module_name]['SP_IMAGETYPE0'] = 'This is an Image URL !';
$lang_new[$module_name]['SP_IMAGETYPE1'] = 'The image is uploaded from your pc!';
$lang_new[$module_name]['SP_IMAGE_UPLOAD'] = 'Site Image Upload <br /><small>If both Image possibilities are set, Upload will be preferenced.</small>';
$lang_new[$module_name]['SP_IMAGE_URL'] = 'Site Image URL';
$lang_new[$module_name]['SP_INACTIVESITES'] = 'Inactive Sites';
$lang_new[$module_name]['SP_LINKED'] = 'Linked';
$lang_new[$module_name]['SP_MAXHEIGHT'] = 'Max Image Height';
$lang_new[$module_name]['SP_MAXWIDTH'] = 'Max Image Width';
$lang_new[$module_name]['SP_MISSINGDATA'] = 'You are missing submission data!';
$lang_new[$module_name]['SP_MUSTBE'] = 'Images larger than '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' will be resized to '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' on display';
$lang_new[$module_name]['SP_NAME'] = 'Site Name';
$lang_new[$module_name]['SP_NOACTIVESITES'] = 'There are no Active Sites.';
$lang_new[$module_name]['SP_NOINACTIVESITES'] = 'There are no Inactive Sites.';
$lang_new[$module_name]['SP_NOSUBMITTEDSITES'] = 'There are no Submitted Sites.';
$lang_new[$module_name]['SP_NOUPLOAD'] = 'Image did not upload properly.';
$lang_new[$module_name]['SP_REQUIREUSER'] = 'Require Membership';
$lang_new[$module_name]['SP_RETURNMAIN'] = 'Return to Main Administration';
$lang_new[$module_name]['SP_SAVECHANGES'] = 'Save Changes';
$lang_new[$module_name]['SP_SITEID'] = 'Site ID';
$lang_new[$module_name]['SP_SUBMITSITE'] = 'Submit Site';
$lang_new[$module_name]['SP_SUBMITTED'] = 'Submitted';
$lang_new[$module_name]['SP_SUBMITTEDSITES'] = 'Submitted Sites';
$lang_new[$module_name]['SP_SUPPORTEDBY'] = 'Supported by';
$lang_new[$module_name]['SP_SUPPORTERS'] = 'Supporters';
$lang_new[$module_name]['SP_SURE2DELETE'] = 'Are you sure you want to delete this site?';
$lang_new[$module_name]['SP_UPLOAD'] = 'Upload';
$lang_new[$module_name]['SP_UPLOADERROR'] = 'File wasn\'t uploaded';
$lang_new[$module_name]['SP_URL'] = 'Site URL';
$lang_new[$module_name]['SP_USEREMAIL'] = 'User Email';
$lang_new[$module_name]['SP_USERID'] = 'User ID';
$lang_new[$module_name]['SP_USERIP'] = 'User IP';
$lang_new[$module_name]['SP_USERNAME'] = 'User Name';
$lang_new[$module_name]['SP_VISITS'] = 'Visits';
$lang_new[$module_name]['SP_YOUDELETE'] = 'You are about to delete the site';
$lang_new[$module_name]['SP_YOUREMAIL'] = 'Your Email';
$lang_new[$module_name]['SP_YOURIP'] = 'Your IP';
$lang_new[$module_name]['SP_YOURNAME'] = 'Your Name';

?>