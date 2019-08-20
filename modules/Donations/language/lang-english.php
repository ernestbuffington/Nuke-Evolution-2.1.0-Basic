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

global $lang_donate;

//Confirm
$lang_donate['COME_BACK'] = 'After you have made your donation <strong>PLEASE</strong> make sure you use the button in paypal to return to this site or your donation will not count.';
$lang_donate['CONFIRM_DONATION'] = 'Please confirm your donation of %s %s?';
$lang_donate['PAYPAL_BACK'] = 'Return to '.EVO_SERVER_SITENAME;

//Common
$lang_donate['BREAK'] = ':';
$lang_donate['CONFIRM'] = 'Confirm';
$lang_donate['DONATE'] = 'Donate';
$lang_donate['DONATIONS'] = 'Donations';

//Errors
$lang_donate['CURRENCY_NF'] = 'Currency code could not be found';
$lang_donate['DON_NF'] = 'Donations could not be found';
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">ERROR!</span><br />';
$lang_donate['FAILED'] = 'Donation failed to record!';
$lang_donate['GEN_NF'] = 'General setting could not be found';
$lang_donate['NO_OR_NEGATIV_VALUE'] = 'Amount is either negative or 0';
$lang_donate['NO_PP_ADD'] = 'PayPal address has not been setup';
$lang_donate['PAGE_NF'] = 'Page setting could not be found';
$lang_donate['VALUES_NF'] = 'Donations values could not be found';

//Help
$lang_donate['HELP_DONATION_ANON'] = 'Everything except the donation is hidden from the admin(s).<br /><br /><strong>NOTE:</strong> PayPal will still have all your information so it is not 100% anonymous';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Your donation is hidden from the public but <strong>not</strong> the admin.';
$lang_donate['HELP_DONATION_REGULAR'] = 'Everything is public';
$lang_donate['HELP_GOAL'] = 'This will show the total amount donated so far this month vs the monthly goal.';
$lang_donate['HELP_TOTAL'] = 'This will show the total amount donated so far.';

//Index
$lang_donate['MAKE_DONATIONS'] = 'Make Donations';
$lang_donate['VIEW_DONATIONS'] = 'View Donations';

//Make
$lang_donate['AMOUNT'] = 'Amount';
$lang_donate['DONATE_TO'] = 'Donate to';
$lang_donate['MESSAGE'] = 'Message/Reason';
$lang_donate['OTHER'] = 'Other Amount';
$lang_donate['TYPE'] = 'Type of donation';
$lang_donate['TYPE_ANON'] = 'Anonymous';
$lang_donate['TYPE_PRIVATE'] = 'Private';
$lang_donate['TYPE_REGULAR'] = 'Regular';

//View
$lang_donate['AMOUNT'] = 'Amount';
$lang_donate['DATE'] = 'Date';
$lang_donate['DIFF'] = 'Difference';
$lang_donate['GOAL'] = 'Goal';
$lang_donate['N/A'] = 'N/A';
$lang_donate['NEXT'] = 'Next';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV'] = 'Previous';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['USERNAME'] = 'Username';
$lang_donate['TOTAL'] = 'Total';

?>