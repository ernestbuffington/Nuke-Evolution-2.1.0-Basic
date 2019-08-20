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

define("_CHARSET","UTF-8");
define("_LANG_DIRECTION","ltr");
define("_SEARCH","Search");
define("_SUBMIT","Submit");
define("_REFRESH_SEC_CODE","Refresh Security Code");
define("_CONFIRM", "Confirm");
define("_PROFILE","Profile");
define("_LOGIN","Login");
define("_VIEWING","Viewing");
define("_WRITES","writes");
define("_APPROVEDBY","Approved by");
define("_POSTEDON","Posted on");
define("_NICKNAME","Nickname");
define("_PASSWORD","Password");
define("_WELCOMETO","Welcome to");
define("_EDIT","Edit");
define("_DELETE","Delete");
define("_POSTEDBY","Posted by");
define("_READS","reads");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Go Back</a> ]");
define("_BACK","Back");
define("_COMMENTS","comments");
define("_PASTARTICLES","Past Articles");
define("_OLDERARTICLES","Older Articles");
define("_BY","by");
define("_ON","on");
define("_LOGOUT","Logout");
define("_WAITINGCONT","Waiting Content");
define("_SUBMISSIONS","Submissions");
define("_EPHEMERIDS","Ephemerids");
define("_ONEDAY","One Day like Today...");
define("_ASREGISTERED","Don't have an account yet? You can <a href=\"modules.php?name=Your_Account&amp;op=new_user\">create one</a>. As a registered user you have some advantages like theme manager, comments configuration and post comments with your name.");
define("_MENUFOR","Menu for");
define("_NOBIGSTORY","There isn't a Biggest Story for Today, yet.");
define("_BIGSTORY","Today's most read Story is:");
define("_SURVEY","Survey");
define("_POLLS","Polls");
define("_PCOMMENTS","Comments:");
define("_RESULTS","Results");
define("_HREADMORE","read more...");
define("_CURRENTLY","There are currently,");
define("_GUESTS","guest(s) and");
define("_MEMBERS","member(s) that are online.");
define("_YOUARELOGGED","You are logged as");
define("_YOUHAVE","You have");
define("_PRIVATEMSG","private message(s).");
define("_YOUAREANON","You are Anonymous user. You can register for free by clicking <a href=\"modules.php?name=Your_Account&amp;op=new_user\">here</a>");
define("_NOTE","Note:");
define("_ADMIN","Admin:");
define("_WERECEIVED","We received");
define("_PAGESVIEWS","page views since");
define("_TOPIC","Topic");
define("_UDOWNLOADS","Downloads");
define("_VOTE","Vote");
define("_VOTES","Votes");
define("_MVIEWADMIN","View: Administrators Only");
define("_MVIEWUSERS","View: Registered Users Only");
define("_MVIEWANON","View: Anonymous Users Only");
define("_MVIEWGROUP","View: Groups Only");
define("_MVIEWALL","View: All Visitors");
define("_EXPIRELESSHOUR","Expiration: Less than 1 hour");
define("_EXPIREIN","Expiration in");
define("_HTTPREFERERS","HTTP Referers");
define("_UNLIMITED","Unlimited");
define("_HOURS","Hours");
define("_RSSPROBLEM","Currently there is a problem with headlines from this site");
define("_SELECTLANGUAGE","Select Language");
define("_SELECTGUILANG","Select Interface Language:");
define("_LANG_NO_MULTILINGUAL","This Board is not Multilingual");
define("_NONE","None");
define("_BLOCKPROBLEM","There is a problem right now with this block.");
define("_BLOCKPROBLEM2","There isn't content right now for this block.");
define("_MODULENOTACTIVE","Sorry, this Module isn't active!");
define("_MODULEDOESNOTEXIST","Sorry... but this module does not exist!");
define("_NOACTIVEMODULES","Inactive Modules");
define("_FORADMINTESTS","(for Admin tests)");
define("_BBFORUMS","Forums");
define("_ACCESSDENIED", "Access Denied");
define("_RESTRICTEDAREA", "You are trying to access a restricted area.");
define("_MODULEUSERS", "We are Sorry, but this section of our site is for <em>Registered Users Only.</em><br /><br />You can register for free by clicking <a href=\"modules.php?name=Your_Account&amp;op=new_user\">here</a>, then you can<br />access this section without restrictions. Thanks.<br /><br />");
define("_MODULESADMINS", "We are Sorry but this section of our site is for <em>Administrators Only.</em><br /><br />");
define("_HOME","Home");
define("_HOMEPROBLEM","There is a big problem here: we do not have a Homepage!!!");
define("_ADDAHOME","Add a Module in your Home");
define("_HOMEPROBLEMUSER","There is a problem right now on the Homepage. Please check back later.");
define("_MORENEWS","More in News Section");
define("_ALLCATEGORIES","All Categories");
//define("_DATESTRING","%A, %B %d, %Y @ %T %Z");
//define("_DATESTRING2","%A, %B %d");
define('_DATESTRING','%A, %B %d, %Y (%H:%M:%S)');
define('_DATESTRING2','%A, %B %d');
define('_DATESTRING3','%d-%b-%Y');
define('_DATESTRING4','%1$s, %2$s %3$s');
define("_DATE","Date");
define("_HOUR","Hour");
define("_UMONTH","Month");
define("_YEAR","Year");
define("_JANUARY","January");
define("_FEBRUARY","February");
define("_MARCH","March");
define("_APRIL","April");
define("_MAY","May");
define("_JUNE","June");
define("_JULY","July");
define("_AUGUST","August");
define("_SEPTEMBER","September");
define("_OCTOBER","October");
define("_NOVEMBER","November");
define("_DECEMBER","December");
define("_BWEL","Welcome");
define("_BLOGOUT","Logout");
define("_BPM","Private Messages");
define("_BUNREAD","Unread");
define("_BREAD","Read");
define("_BSAVED","Saved");
define("_BTT","Total");
define("_BMEMP","Membership");
define("_BLATEST","Latest");
define("_BTD","New Today");
define("_BYD","New Yesterday");
define("_BOVER","Overall");
define("_BVISIT","People Online");
define("_BVIS","Visitors");
define("_BMEM","Members");
define("_BON","Online Now");
define("_BOR","or");
define("_BPLEASE","Please");
define("_BREG","Register");
define("_BROADCAST","Broadcast Public Message");
define("_BROADCASTFROM","Public Message from");
define("_TURNOFFMSG","Turn Off Public Messages");
define("_JOURNAL","Journal");
define("_READMYJOURNAL","Read My Journal");
define("_ADD","Add");
define("_YES","Yes");
define("_NO","No");
define("_INVISIBLEMODULES","Invisible Modules");
define("_ACTIVEBUTNOTSEE","(Active but invisible link)");
define("_THISISAUTOMATED","This is an automated email to let you know that your banner advertising in our site has been completed.");
define("_THERESULTS","The results of your campaign are as follows:");
define("_TOTALIMPRESSIONS","Total Impression Made:");
define("_CLICKSRECEIVED","Clicks Received:");
define("_IMAGEURL","Image URL");
define("_CLICKURL","Click URL:");
define("_ALTERNATETEXT","Alternate Text:");
define("_HOPEYOULIKED","Hope you liked our service. We'll look forward to having you as an advertising customer again soon.");
define("_THANKSUPPORT","Thanks for your Support");
define("_TEAM","Team");
define("_BANNERSFINNISHED","Banners Ads Finished");
define("_PAGEGENERATION","Page Generation:");
define("_MEMORYUSAGE","Memory Usage: ");
define("_DBQUERIES","SQL Queries: ");
//define('_PAGEFOOTER','This page was generated in %1$s seconds with %2$s DB Queries in %3$s seconds');
define("_SECONDS","Seconds");
define("_YOUHAVEONEMSG","You Have 1 New Private Message");
define("_NEWPMSG","New Private Messages");
define("_CONTRIBUTEDBY","Contributed by");
define("_CHAT","Chat");
define("_REGISTERED","Registered");
define("_CHATGUESTS","Guests");
define("_USERSTALKINGNOW","Users Talking Now");
define("_ENTERTOCHAT","Enter To Chat");
define("_CHATROOMS","Available Rooms");
define("_SECURITYCODE","Security Code");
define("_TYPESECCODE","Type Security Code");
define("_ASSOTOPIC","Associated Topics");
define("_ADDITIONALYGRP","Additionaly this module belongs to the Users Group");
define("_YOUHAVEPOINTS","Points you have by participating on the site's content:");
define("_MVIEWSUBUSERS","View: Subscribed Users Only");
define("_MODULESSUBSCRIBER","We are Sorry but this section of our site is for <em>Subscribed Users Only.</em>");
define("_MODULESGROUP","We are Sorry but this section of our site is for <em>Group Members</em>");
define("_SUBEXPIRED","Your Subscription Expired");
define("_HELLO","Hello");
define("_SUBSCRIPTIONAT","This is an automated message to let you know that your subscription at");
define("_HASEXPIRED","has been expired now.");
define("_HOPESERVED","Hope to have served you with satisfaction...");
define("_SUBRENEW","If you want to renew your subscription please go to:");
define("_YOUARE","You are");
define("_SUBSCRIBER","subscriber");
define("_OF","of");
define("_SBYEARS","years");
define("_SBYEAR","year");
define("_SBMINUTES","minutes");
define("_SBHOURS","hours");
define("_SBSECONDS","seconds");
define("_SBDAYS","days");
define("_SUBEXPIREIN","Your subscription will expire in:");
define("_NOTSUB","You are not a subscriber of");
define("_NOTSUBUSR","Not a subscriber of");
define("_SUBFROM","You can subscribe from");
define("_HERE","here");
define("_NOW","now!");
define("_ADMSUB","Subscribed User!");
define("_ADMNOTSUB","User NOT Subscribed");
define("_ADMSUBEXPIREIN","Subscription Expire in:");
define("_LASTIP","Last user IP:");
define("_LASTVISIT","Last visit:");
define("_LASTNA","N/A");
define("_BANTHIS","Ban This IP");
define("_ADMIN_BLOCK_DENIED", "You are not allowed to view this block");
define("_NEWSLETTERBLOCKSUBSCRIBED", "You are subscribed to the newsletter");
define("_NEWSLETTERBLOCKREGISTER", "You must register to receive the newsletter");
define("_NEWSLETTERBLOCKREGISTERNOW", "Click to register");
define("_NEWSLETTERBLOCKNOTSUBSCRIBED", "You are not subscribed to the newsletter");
define("_NEWSLETTERBLOCKSUBSCRIBE", "Subscribe");
define("_NEWSLETTERBLOCKUNSUBSCRIBE", "Unsubscribe");
define("_ANONYMOUS","Anonymous");
define("_MODULEERROR","There was a module error");

define('_ILLEGAL_OP_OPERATION', 'You have called this site with an illegal operand in your URL <br />Please check it in your Browser');
define('_PAGE_NOT_EXISTS', 'Sorry, but the page you wanted isn`t available');
define('_REFRESH_SCREEN', 'Refresh Screen');

define('_AS_IS', 'As is');
define('_OFFTOPIC', 'Off Topic');
define('_FLAMEBAIT', 'Flame Bait');
define('_TROLL', 'Troll');
define('_REDUNDANT', 'Redudant');
define('_INSIGHTFUL', 'Insightful');
define('_INTERESTING', 'Interesting');
define('_INFORMATIVE', 'Informative');
define('_FUNNY', 'Funny');
define('_OVERRATED', 'Over Rated');
define('_UNDERRATED', 'Under Rated');
define('_EVO_HELPSYSTEM', 'Nuke Evolution Help');
define('_OVERLIB_CLOSE', 'Close');

define('_GUEST', 'Guest');
define('_BOTS', 'Search Bots');
define('_BOT', 'Search Bot');
define('_ABR_DAYS', 'D');
define('_ABR_MONTHS', 'M');
define('_ABR_YEARS', 'Y');
define('_ABR_MINUTES', 'Min');
define('_ABR_HOURS', 'H');
define('_ABR_SECONDS', 'Sec');

define("_ACTIVETOPICS","Current Active Topics");

define('_MESSAGE', 'Message');
define('_EMAIL', 'eMail');
define('_FROM', 'from');

// Modulenames to show in Who-is-Online
define('_MODULE_0', ' Forum: Index');
define('_MODULE_-1', 'Forum: Login');
define('_MODULE_-2', 'Forum: Search');
define('_MODULE_-3', 'Register');
define('_MODULE_-4', 'Profile');
define('_MODULE_-6', 'Forum: Who-is-online');
define('_MODULE_-7', 'Memberlist');
define('_MODULE_-8', 'Forum: FAQ');
define('_MODULE_-9', 'Forum: Postings');
define('_MODULE_-10', 'Private Messages');
define('_MODULE_-11', 'Forum: Groups');
define('_MODULE_-12', 'Forum: Staff');
define('_MODULE_-1210', 'Forum: Attachments');
define('_MODULE_-1214', 'Forum: Board Rules');
define('_MODULE_-15', 'Forum: Forums');
define('_MODULE_-16', 'Forum: Topics');
define('_MODULE_-17', 'Forum: Posts');
define('_MODULE_-33', 'Forum: Recent Topics');
define('_MODULE_-34', 'Forum: Statistics');
define('_MODULE_-35', 'Forum: Ranks');
define('_MODULE_-50', 'Forum: Administration');
define('_MODULE_-5000', 'Forum: Topics');

?>
