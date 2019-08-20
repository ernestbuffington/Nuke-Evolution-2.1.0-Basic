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


/*****[BEGIN]******************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/
define("_CANNOTCHANGEMODE", "Cannot change the mode of file (%s)");
define("_CANNOTOPENFILE", "Cannot open file (%s)");
define("_CANNOTWRITETOFILE", "Cannot write to file (%s)");
define("_CANNOTCLOSEFILE", "Cannot close file (%s)");
define("_SITECACHED", "This site is cached.");
define("_UPDATECACHE", "Click here to update the cache.");
/*****[END]********************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
define("_ERRORINVEMAIL","ERROR: Invalid Email");
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/
define("_PERSISTENT","Log me on automatically each visit");
/*****[END]********************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/
define("_ADMINGROUPS","Edit Groups");
define("_MVGROUPS","Groups Only");
define("_MVSUBUSERS","Subscribers Only");
define("_WHATGRDESC","View must be SET to Groups Only");
define("_WHATGROUPS","What Groups");
define("_GRMEMBERSHIPS","Group Memberships");
define("_GRNONE","None");
/*****[END]********************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/
define("_ADMIN_BLOCK_TITLE","Quick Navigation");
define("_ADMIN_BLOCK_NUKE","Admin [EVO-CMS]");
define("_ADMIN_BLOCK_FORUMS","Admin [Forums]");
define("_ADMIN_BLOCK_LOGOUT","Logout");
define("_ADMIN_BLOCK_SETTINGS","Preferences");
define("_ADMIN_BLOCK_BLOCKS","Blocks");
define("_ADMIN_BLOCK_MODULES","Modules");
define("_ADMIN_BLOCK_CNBYA","Users Configuration");
define("_ADMIN_BLOCK_MSGS","Messages");
define("_ADMIN_BLOCK_MODULE_BLOCK","Module Block");
define("_ADMIN_BLOCK_NEWS","News");
define("_ADMIN_BLOCK_LOGIN","Admin Login");
define("_ADMIN_BLOCK_WHO_ONLINE","Who Is Online");
define("_ADMIN_BLOCK_OPTIMIZE_DB","Database");
define("_ADMIN_BLOCK_DOWNLOADS", "Downloads");
define("_ADMIN_BLOCK_EVO_USER", "EVO UserInfo");
define("_ADMIN_BLOCK_WEBLINKS","Web Links");
define("_ADMIN_BLOCK_REVIEWS","Reviews");
define("_ADMIN_BLOCK_SYSTEMINFO","System Info");
define("_ADMIN_BLOCK_ERRORLOG","Error Log");
define("_CACHE_ADMIN", "Cache");
define("_CACHE_CLEAR", "Clear Cache");
define("_ADMIN_ID","Admin ID:");
define("_ADMIN_PASS","Password:");
define("_ADMINISTRATION","Administration");
define("_ADMIN_NO_MODULE_RIGHTS","You do not have administration permission for module");
/*****[END]********************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/
define("_URL_SLASH_ERR","Please remove the / from the end of your ");
define("_URL_HTTP_ERR","Please put http:// at the beginning of your ");
define("_URL_NHTTP_ERR","Please remove the http:// from the beginning of your ");
define("_URL_PHP_ERR","Please remove the file name at the end of your ");
define("_URL_MODULE_FORUM_ERR","Please remove /modules/Forums at the end of your ");
/*****[END]********************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/

/*--FNA--*/

/*****[BEGIN]******************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/
define("_STORIES", "Stories");
define("_AWL","Web Links");
define("_ASUP","Supporters");
define("_AREV","Reviews");
define("_ADOWN","Downloads");
define("_ABAN", "Banners");
define("_AWU", "Your Account");
define("_WAITUSERS", "Waiting");
define("_BROKENDOWN","Broken");
define("_BROKENLINKS","Broken");
define("_BROKENREVIEWS","Broken");
define("_MODREQDOWN","Modifications");
define("_MODREQLINKS","Modifications");
define("_MODREQREVIEWS","Modifications");
define("_WDOWNLOADS","Waiting");
define("_WLINKS","Waiting");
define("_WREVIEWS","Waiting");
define("_ABANNERS", "Active");
define("_DBANNERS", "Inactive");
define("_WSUPPORT", "Waiting");
define("_DSUPPORT", "Inactive");
define("_ASUPPORT", "Active");
/*****[END]********************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/
define("_NEED_DELETE","You must delete");
define("_IS_DELETED","We have deleted");
define("_THE_FOLDER","the folder");
/*****[END]********************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/
define("_PASS_CONFIRM","Re-type Password");
define("_ERROR","Error");
define("_PASS_NOT_MATCH","The two passwords do not match");
/*****[END]********************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Validation                         v1.0.0 ]
 ******************************************************/
define("VALIDATE_ERROR","The %s you entered in %s was not valid ");
define("VALIDATE_USERNAME","username");
define("VALIDATE_TEXT","text");
define("VALIDATE_FULLNAME","fullname");
define("VALIDATE_NUMBER","number");
define("VALIDATE_EMAIL","email");
define("VALIDATE_URL","URL");
define("VALIDATE_INT","Number");
define("VALIDATE_FLOAT","Number");
define("VALIDATE_SHORT","short");
define("VALIDATE_LONG","long");
define("VALIDATE_SMALL","small");
define("VALIDATE_BIG","big");
define("VALIDATE_TEXT_SIZE","The %s you entered in %s not valid<br />It must be %s characters");
define("VALIDATE_NUMBER_SIZE","The %s you entered in %s not valid<br />It must be %s");
define("VALIDATE_WORD","A word was found in %s which is not allowed");
/*****[END]********************************************
 [ Other:  Validation                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
define("PSM_HELP_TITLE","Password Strenght Help");
define("PSM_NOTRATED","Not Rated");
define("PSM_CURRENTSTRENGTH","Current Strength: ");
define("PSM_WEAK","Weak");
define("PSM_MED","Medium");
define("PSM_STRONG","Strong");
define("PSM_STRONGER","Stronger");
define("PSM_STRONGEST","Strongest");
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

/*--FNL--*/

/*--CalendarMx--*/

/*****[BEGIN]******************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/
define("_NOSURVEYS","There are no active Surveys available");
/*****[END]********************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
define("_NORSS", "The RSS file you are trying to load does not exist!");
/*****[END]********************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
define('_COLLAPSE','Collapsible blocks?');
define('_COLLAPSE_TITLE','title');
define('_COLLAPSE_ICON','icon');
define('_COLLAPSE_START','Collapsible blocks start open?');
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
******************************************************/

define('_QUERIES','Queries:');
define('_DB_TIME','DB Access Time:');
define('_PAGEFOOTER','[ '._PAGEGENERATION.' %s '._SECONDS.' | '._QUERIES.' %s ]');
define("_THEMES_QUNINSTALLED", "Uninstalled");
define("_THEMES", "Themes");
define("_THEMES_DEFAULT", "Default Theme");
define('_THEMES_THEME_MISSING', 'Theme is missing');
define('_THEMES_ACTIVE', 'Active');
define('_THEMES_INACTIVE', 'Inactive');
define('_ERROR_EMAIL', 'Please configure either your site email or your forum email');
define('_Nice_Try', 'Nice Try ....');
define('_OPTIMIZE_DB','Database Optimized');
define('_MESSAGE_DIE_TITLE', 'Message Center');

/*****[BEGIN]******************************************
 [ Base:    Log-Errors                         v1.0.0 ]
 ******************************************************/
define('_ERROR_LOG_GENERAL_ERROR','General Error');
define('_ERROR_LOG_GENERAL_INFORMATION','General Information');
define('_ERROR_LOG_CRITICAL_ERROR','Critical Error');
define('_ERROR_LOG_HACK_ATTEMPT','Hack Attempt');
define('_ERROR_LOG_SECURITY_BREACH','Security Breach');
define('_ERROR_LOG_SCRIPT_ATTACK','Script Attack');
define('_ERROR_LOG_USER','User');
define('_ERROR_LOG_IP','IP');
define('_ERROR_LOG_INVALID_IP_YA','used invalid IP address attempted to access the YA admin area');
define('_ERROR_LOG_INVALID_IP_FORUM','used invalid IP address attempted to access the forum admin area');
define('_ERROR_LOG_INVALID_IP_ADMIN','used invalid IP address attempted to access the admin area');
define('_ERROR_LOG_BLOCKED_HTML_TAG_TEXT','An attempt has been made to use a blocked HTML tag.');
define('_ERROR_LOG_BLOCKED_HTML_TAG_STRING','Blocked String:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_SOURCE','Source:');
define('_ERROR_LOG_BLOCKED_HTML_TAG_ECHOMSG','is an XSS and was blocked in:');
define('_ERROR_LOG_THEME_MISSING_1','Your default theme is missing!');
define('_ERROR_LOG_THEME_MISSING_2','was NOT found!');
define('_ERROR_LOG_GOD_ADMIN_CREATED','God Admin was created:');
define('_ERROR_LOG_WRONG_MODUL_PATH','Inappropriate module path was used');
define('_ERROR_LOG_WRONG_ADMIN_ACCOUNT','Attempted to login with');
define('_ERROR_LOG_ADMIN_NO_USERNAME','Attempted to login to the admin area with no username');
define('_ERROR_LOG_ADMIN_NO_PASSWORD','Attempted to login to the admin area with no password');
define('_ERROR_LOG_ADMIN_NO_USER_PASSWORD','Attempted to login to the admin area with no username and password');
define('_ERROR_LOG_BUT_FAILED','but failed');
define('_ERROR_LOG_INTRUDER_ALERT','Caused an Intruder Alert');
/*****[END]********************************************
 [ Base:    Log-Errors                         v1.0.0 ]
******************************************************/

define('EVO_TOOLTIP_INFO', 'Info...');
define('EVO_TOOLTIP_ALERT', 'Alert...');
define('EVO_TOOLTIP_WIKI', 'Wiki...');
define('EVO_TOOLTIP_MSN', 'MSN...');

?>