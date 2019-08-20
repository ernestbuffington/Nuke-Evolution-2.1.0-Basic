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

global $adminpoint, $evoconfig;
$lang_admin[$adminpoint]['NEWSLETTER_BACKMAIN'] = 'Return to Main Administration';

$lang_admin[$adminpoint]['NEWSLETTER_DISCARD'] = 'Discard';

$lang_admin[$adminpoint]['NEWSLETTER_ERROR_NOT_SET'] = '%s isn\'t set';

$lang_admin[$adminpoint]['NEWSLETTER_FROM'] = 'from';

$lang_admin[$adminpoint]['NEWSLETTER_HELLO'] = 'Hello';

$lang_admin[$adminpoint]['NEWSLETTER_MAILCONTENT'] = 'Email Content';
$lang_admin[$adminpoint]['NEWSLETTER_MANYUSERSNOTE'] = 'Because many Recipients are chosen, it could take a few moments before this action completes.<br />Please be patient!';
$lang_admin[$adminpoint]['NEWSLETTER_MUSERGROUPWILLRECEIVE'] = 'User groups will receive this News';

$lang_admin[$adminpoint]['NEWSLETTER_NEWSLETTERSENT'] = 'Your Newsletter was send';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ADMINS'] = 'Administrators';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ALLUSERS'] = 'All Users';
$lang_admin[$adminpoint]['NEWSLETTER_NL_NOUSERS'] = 'The Group chosen has no members.<br />Please go back and select another group.';
$lang_admin[$adminpoint]['NEWSLETTER_NL_RECIPS'] = 'Recipient';
$lang_admin[$adminpoint]['NEWSLETTER_NL_REGARDS'] = 'With best regards';
$lang_admin[$adminpoint]['NEWSLETTER_NLUNSUBSCRIBE'] = '<u>Please note:</u><br />You have received this Newsletter because you selected this option during the registration process on our website. <br />You can choose to stop receiving these at anytime by changing the preferences in your user profile. <br />To stop receiving this news letter simply choose: Edit your profile - Preferences - Receive Newsletter by Email?: set to No and save.<br /> Additionally if you need any assistance, please send an email to our (<a href="mailto:'.$evoconfig['adminmail'].'">Website Administration.</a>)';
$lang_admin[$adminpoint]['NEWSLETTER_NUSERWILLRECEIVE'] = 'Users will recieve this News';

$lang_admin[$adminpoint]['NEWSLETTER_PREVIEW'] = 'Preview';

$lang_admin[$adminpoint]['NEWSLETTER_REVIEWTEXT'] = 'Before sending - Please check your News article for typographical or other possible mistakes before posting';

$lang_admin[$adminpoint]['NEWSLETTER_SEND'] = 'Send Newsletter';
$lang_admin[$adminpoint]['NEWSLETTER_SUBSCRIBEDUSERS'] = 'Subscribed Users';
$lang_admin[$adminpoint]['NEWSLETTER_STAFF'] = 'Team';
$lang_admin[$adminpoint]['NEWSLETTER_SUBJECT'] = 'Subject';

$lang_admin[$adminpoint]['NEWSLETTER_TITLE'] = 'Newsletter';

?>