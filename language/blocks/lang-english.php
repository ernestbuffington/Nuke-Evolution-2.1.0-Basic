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

if(!defined('NUKE_EVO')) { die('You can\'t access this file directly...'); }

$lang_block['BLOCK_NO_IMAGE'] = 'No Image available';
$lang_block['BLOCK_NO_CONTENT'] = 'No Content available';
$lang_block['BLOCK_NO_CONFIG'] = 'No Configuration possible';
$lang_block['BLOCK_DELETE'] = 'Delete';

/*****[BEGIN]******************************************
[ Lang: Articles
News
Topics]
******************************************************/
$lang_block['BLOCK_NEWS_READS'] = 'read';
$lang_block['BLOCK_NEWS_MORENEWS'] = 'more in News';
$lang_block['BLOCK_NEWS_ANONYM'] = 'Guest';
$lang_block['BLOCK_NEWS_APPROVED'] = 'Approved by';
$lang_block['BLOCK_NEWS_WRITES'] = 'writes';
$lang_block['BLOCK_NEWS_SEND_PRINTER'] = 'Send to Printer';
$lang_block['BLOCK_NEWS_SEND_FRIEND'] = 'Send to Friend';
$lang_block['BLOCK_NEWS_SELECT_PAGE'] = 'Select Page';
$lang_block['BLOCK_NEWS_OF'] = 'of';
$lang_block['BLOCK_NEWS_OF_PAGES'] = 'Pages';
$lang_block['BLOCK_NEWS_TOPICS_ALL'] = 'Show all Topics';
$lang_block['BLOCK_NEWS_ARTICLES_LAST'] = 'Last Articles';
$lang_block['BLOCK_NEWS_NOTE'] = 'Note:';
$lang_block['BLOCK_NEWS_READMORE'] = 'Read More...';
$lang_block['BLOCK_NEWS_COUNTRATINGS'] = 'Counted Ratings';
$lang_block['BLOCK_NEWS_ANONYMOUS'] = 'Anonymous';
$lang_block['BLOCK_NEWS_PRINTER'] = 'Printer Friendly';
$lang_block['BLOCK_NEWS_FRIEND'] = 'Send to a Friend';
$lang_block['BLOCK_NEWS_EDIT'] = 'Edit';
$lang_block['BLOCK_NEWS_DELETE'] = 'Delete';
$lang_block['BLOCK_NEWS_POSTED'] = 'Posted';
$lang_block['BLOCK_NEWS_POSTEDBY'] = 'Posted by';
$lang_block['BLOCK_NEWS_ON'] = 'on';
$lang_block['BLOCK_NEWS_COMMENTS'] = 'comments';
$lang_block['BLOCK_NEWS_CATEGORY'] = 'Category';
/*****[END]********************************************
[ Lang: Articles
News
Topics]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Big_Story_of_Today]
******************************************************/
$lang_block['BLOCK_BIGSTORY_OF_TODAY_CONTENT'] = 'Today\'s most read story';
/*****[END]********************************************
[ Lang: Big_Story_of_Today]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Donations
******************************************************/
$lang_block['BLOCK_DONATIONS_ANON'] = 'Anonymous';
$lang_block['BLOCK_DONATIONS_DONATE'] = 'Donation';
$lang_block['BLOCK_DONATIONS_DONATE_ANON'] = 'Anonym';
$lang_block['BLOCK_DONATIONS_DONATE_TOTAL'] = 'Total:';
$lang_block['BLOCK_DONATIONS_DONATE_GOAL'] = 'Goal:';
$lang_block['BLOCK_DONATIONS_DONATE_DIF'] = 'Difference:';
/*****[END]********************************************
[ Lang: Donations
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Downloads]
******************************************************/
$lang_block['BLOCK_DOWNLOAD_DONE'] = 'stored';
$lang_block['Download_Top_Downloads'] = 'Top Download user';
$lang_block['Download_Top_Uploader'] = 'Top Upload user';
$lang_block['Download_Statistic'] = 'Download Statistics';
$lang_block['Download_Total_Files'] = 'Total Files';
$lang_block['Download_Total_Hits'] = 'Total Hits';
/*****[END]********************************************
[ Lang: Downloads]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Evo-Forums
EvoForums_Topics
EvoForums_Basic]
******************************************************/
$lang_block['BLOCK_FORUM_ANNOUNCE'] = 'Announcements';
$lang_block['BLOCK_FORUM_ANNOUNCENO'] = 'No Announcements';
$lang_block['BLOCK_FORUM_COUNTREPLIES'] = 'Replies';
$lang_block['BLOCK_FORUM_COUNTVIEWS'] = 'Views';
$lang_block['BLOCK_FORUM_CREATEDBY'] = 'created by';
$lang_block['BLOCK_FORUM_CREATEDON'] = 'on';
$lang_block['BLOCK_FORUM_FORUM'] = 'Forum';
$lang_block['BLOCK_FORUM_FORUMS'] = 'Forums';
$lang_block['BLOCK_FORUM_LASTPOST'] = 'Last Post';
$lang_block['BLOCK_FORUM_NEWPOST'] = 'New Post';
$lang_block['BLOCK_FORUM_NOTOPIC'] = 'No Topic to show';
$lang_block['BLOCK_FORUM_POST'] = 'Post';
$lang_block['BLOCK_FORUM_POSTS'] = 'Postings';
$lang_block['BLOCK_FORUM_RECENT'] = 'Recent Topics';
$lang_block['BLOCK_FORUM_TOPIC'] = 'Topic';
$lang_block['BLOCK_FORUM_TOPICS'] = 'Topics';
$lang_block['BLOCK_FORUM_WEHAVE'] = 'We have';
// The next lines are copies from lang_main.php from Forums Language. If language isn't loaded until this time we need them for includes/auth.php.
$lang['Sorry_auth_announce'] = 'Sorry, but only %s can post announcements in this forum.';
$lang['Sorry_auth_sticky'] = 'Sorry, but only %s can post sticky messages in this forum.';
$lang['Sorry_auth_read'] = 'Sorry, but only %s can read topics in this forum.';
$lang['Sorry_auth_post'] = 'Sorry, but only %s can post topics in this forum.';
$lang['Sorry_auth_reply'] = 'Sorry, but only %s can reply to posts in this forum.';
$lang['Sorry_auth_edit'] = 'Sorry, but only %s can edit posts in this forum.';
$lang['Sorry_auth_delete'] = 'Sorry, but only %s can delete posts in this forum.';
$lang['Sorry_auth_vote'] = 'Sorry, but only %s can vote in polls in this forum.';
// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<strong>anonymous users</strong>';
$lang['Auth_Registered_Users'] = '<strong>registered users</strong>';
$lang['Auth_Users_granted_access'] = '<strong>users granted special access</strong>';
$lang['Auth_Moderators'] = '<strong>moderators</strong>';
$lang['Auth_Administrators'] = '<strong>administrators</strong>';
$lang['Not_Moderator'] = 'You are not a moderator of this forum.';
$lang['Not_Authorised'] = 'Not Authorized';
$lang['You_been_banned'] = 'You have been banned from this forum.<br />Please contact the webmaster or board administrator for more information.';
/*****[END]********************************************
[ Lang: Evo-Forums
EvoForums_Topics
EvoForums_Basic]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Groups]
******************************************************/
$lang_block['Current_memberships'] = 'Memberships';
$lang_block['Memberships_pending'] = 'Membership pending';
$lang_block['Group_member_join'] = 'Groups to join';
/*****[END]********************************************
[ Lang: Groups]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Hits
******************************************************/
$lang_block['BLOCK_HITS_TOTALHITS'] = 'Our';
$lang_block['BLOCK_HITS_PAGEVIEWS'] = 'Page views';
$lang_block['BLOCK_HITS_SINCE'] = 'since';
/*****[END]********************************************
[ Lang: Hits]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Languages]
******************************************************/
$lang_block['BLOCK_LANGUAGES_SELECT'] = 'Select Language';
$lang_block['BLOCK_TRANSLATIONS_LANG_NOT_SUPPORTED'] = 'Your selected Language is not supported';
/*****[END]********************************************
[ Lang: Languages
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Link_Us]
******************************************************/
$lang_block['BLOCK_LINKUS_VIEW_ALL_BUTTONS'] = 'View all Buttons';
$lang_block['BLOCK_LINKUS_CLICKS'] = 'Clicks';
/*****[END]********************************************
[ Lang: Link_Us]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Modules]
******************************************************/
$lang_block['BLOCK_MODULES_HOME'] = 'Home';
$lang_block['BLOCK_MODULES_MORE'] = 'More';
$lang_block['BLOCK_MODULES_NONE'] = 'No Modules';
$lang_block['BLOCK_MODULES_INVISIBLE'] = 'Invisible Modules';
$lang_block['BLOCK_MODULES_INACTIVE_MODULE'] = 'Inactive Modules';
$lang_block['BLOCK_MODULES_INACTIVE_LINK'] = 'Inactive Links';
$lang_block['BLOCK_MODULES_VIEWANON'] = 'Guests only';
$lang_block['BLOCK_MODULES_MODULEUSERS'] = 'Members only';
$lang_block['BLOCK_MODULES_MODULESADMINS'] = 'Admin\'s only';
$lang_block['BLOCK_MODULES_MODULESGROUP'] = 'Group members only';
/*****[END]********************************************
[ Lang: Modules Block]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Newsletter]
******************************************************/
$lang_block['BLOCK_NEWSLETTER_UNSUBSCRIBE'] = 'Unsubscribe';
$lang_block['BLOCK_NEWSLETTER_SUBSCRIBE'] = 'Subscribe';
$lang_block['BLOCK_NEWSLETTER_SUBSCRIBED'] = 'You have subscribed to our Newsletter';
$lang_block['BLOCK_NEWSLETTER_SUBSCRIBED_NOT'] = 'You haven\'t subscribed our Newsletter';
$lang_block['BLOCK_NEWSLETTER_REGISTER_TEXT'] = 'You have to subscribe to receive our Newsletters';
$lang_block['BLOCK_NEWSLETTER_REGISTER_DOIT'] = 'Register';
$lang_block['BLOCK_NEWSLETTER_IMAGE_TEXT'] = 'Newsletter';
/*****[END]********************************************
[ Lang: Newsletter]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Reviews]
******************************************************/
$lang_block['BLOCK_REVIEWS_FULL_VIEW'] = 'visit this Review';
$lang_block['BLOCK_REVIEWS_READS'] = 'read';
$lang_block['BLOCK_REVIEWS_VISIT'] = 'visit';
/*****[END]********************************************
[ Lang: Reviews]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Search
******************************************************/
$lang_block['BLOCK_SEARCH_SEARCH_DO'] = 'Search';
/*****[END]********************************************
[ Lang: Search]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Sentinel]
******************************************************/
$lang_block['BLOCK_SENTINEL_SENTINEL_TITLE_IMG'] = 'Sentinel protected';
$lang_block['BLOCK_SENTINEL_HTTPREFERERS'] = 'HTTP Referrer';
$lang_block['BLOCK_SENTINEL_REFERERS_DELETE'] = 'Delete Referrer';
$lang_block['BLOCK_SENTINEL_REFERERS_TOTAL'] = 'Total';
$lang_block['BLOCK_SENTINEL_CAUGHT'] = 'We have banned';
$lang_block['BLOCK_SENTINEL_SHAME'] = 'IP-Address(es)';
$lang_block['BLOCK_SENTINEL_SHAME1'] = 'from access to our site.';
$lang_block['BLOCK_SENTINEL_LIST'] = 'List of all banned IP-Addresses';
/*****[END]********************************************
[ Lang: Sentinel]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Surveys]
******************************************************/
$lang_block['BLOCK_SURVEYS_VOTE'] = 'Vote';
$lang_block['BLOCK_SURVEYS_RESULTS'] = 'Show Results';
$lang_block['BLOCK_SURVEYS_COMMENTS'] = 'Comments';
$lang_block['BLOCK_SURVEYS_POLLS'] = 'Show Polls';
$lang_block['BLOCK_SURVEYS_VOTES'] = 'Votes';
/*****[END]********************************************
[ Lang: Surveys]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: WebLinks]
******************************************************/
$lang_block['BLOCK_WEBLINKS_FULL_VIEW'] = 'Visit this web link';
$lang_block['BLOCK_WEBLINKS_VISIT'] = 'Visit';
/*****[END]********************************************
[ Lang: WebLinks]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Users]
******************************************************/
$lang_block['BLOCK_USERINFO_YOUR_IP'] = 'IP-Address';
$lang_block['BLOCK_USERINFO_YOU_HAVE'] = 'You have';
$lang_block['BLOCK_USERINFO_YOU_BE_USER'] = 'You be logged as';
$lang_block['BLOCK_USERINFO_YOU_BE_GUEST'] = 'Welcome Guest. You can register at our site';
$lang_block['BLOCK_USERINFO_PN_UNREAD'] = 'unread PN';
$lang_block['BLOCK_USERINFO_PN_READ'] = 'read PN';
$lang_block['BLOCK_USERINFO_PN_ARCHIVE'] = 'Archived';
$lang_block['BLOCK_USERINFO_PN_TITLE'] = 'Private Messages';
$lang_block['BLOCK_USERINFO_PN_TOTAL'] = 'Total';
$lang_block['BLOCK_USERINFO_GROUPS_TITLE'] = 'Group Memberships';
$lang_block['BLOCK_USERINFO_GROUPS_MEMBER_NONE'] = 'None';
$lang_block['BLOCK_USERINFO_WELCOME'] = 'Welcome';
$lang_block['BLOCK_USERINFO_REGISTER_DOIT'] = 'Register';
$lang_block['BLOCK_USERINFO_LOGIN_DOIT'] = 'Login';
$lang_block['BLOCK_USERINFO_LOGIN_USERNAME'] = 'Username';
$lang_block['BLOCK_USERINFO_LOGIN_PW'] = 'Password';
$lang_block['BLOCK_USERINFO_ONLINE'] = 'Now Online';
$lang_block['BLOCK_USERINFO_ONLINE_MEMBER'] = 'Members';
$lang_block['BLOCK_USERINFO_ONLINE_GUESTS'] = 'Guests';
$lang_block['BLOCK_USERINFO_ONLINE_TOTAL'] = 'Total';
$lang_block['BLOCK_USERINFO_ONLINE_TITLE'] = 'Members Online';
$lang_block['BLOCK_USERINFO_MEMBER_TITLE'] = 'Member';
$lang_block['BLOCK_USERINFO_MEMBERS_TITLE'] = 'Members';
$lang_block['BLOCK_USERINFO_MEMBERS_NEWEST'] = 'Newest';
$lang_block['BLOCK_USERINFO_MEMBERS_NEWTODAY'] = 'New Today';
$lang_block['BLOCK_USERINFO_MEMBERS_NEWYESTERDAY'] = 'New Yesterday';
$lang_block['BLOCK_USERINFO_MEMBERS_TOTAL'] = 'Total';
$lang_block['BLOCK_USERINFO_LOGOUT_DOIT'] = 'Logout';
$lang_block['BLOCK_USERINFO_GUEST'] = 'Guest';
$lang_block['BLOCK_USERINFO_GUESTS'] = 'Guests';
/*****[END]********************************************
[ Lang: Users]
******************************************************/

/*****[BEGIN]******************************************
[ Lang: Multilingual Block Titles]
******************************************************/
$lang_block['block-Administration'] = 'Administration';
$lang_block['block-Advertising'] = 'Advertising';
$lang_block['block-Big_Story_of_Today'] = 'Big Story of Today';
$lang_block['block-Categories'] = 'Categories';
$lang_block['block-Content'] = 'Content';
$lang_block['block-Donations'] = 'Donations';
$lang_block['block-Downloads-Access'] = 'Downloads Statistics<br />Access';
$lang_block['block-Downloads-Hot'] = 'Downloads Statistics<br />Hot';
$lang_block['block-Downloads-New'] = 'New Downloads';
$lang_block['block-Evo_User_Info'] = 'User Infobox';
$lang_block['block-EvoForums'] = 'Forums';
$lang_block['block-EvoTopics'] = 'Forum topics';
$lang_block['block-Forums'] = 'Forums';
$lang_block['block-Forums_Scroll'] = 'Forums';
$lang_block['block-Groups'] = 'Groups';
$lang_block['block-Hacker_Beware'] = 'Hacker Beware';
$lang_block['block-Hacker_Beware2'] = 'Hacker Beware';
$lang_block['block-Hacker_Beware3'] = 'Hacker Beware';
$lang_block['block-Languages'] = 'Languages';
$lang_block['block-Last_5_Articles'] = 'Last 5 Articles';
$lang_block['block-Last_5_Reviews'] = 'Last 5 Reviews';
$lang_block['block-Last_Referers'] = 'Last Referrers';
$lang_block['block-Link-us'] = 'Link us';
$lang_block['block-Modules'] = 'Menu';
$lang_block['block-Newsletter'] = 'Newsletter';
$lang_block['block-Nuke-Evolution'] = 'EVO-CMS Network';
$lang_block['block-Old_Articles'] = 'Old Articles';
$lang_block['block-Random_Headlines'] = 'Random Headlines';
$lang_block['block-Random_Links'] = 'Random Links';
$lang_block['block-Reviews'] = 'Reviews';
$lang_block['block-ScrollingSentinel'] = 'Hacker Beware';
$lang_block['block-Search'] = 'Search';
$lang_block['block-Sentinel'] = 'Hacker Beware';
$lang_block['block-Sentinel_Center'] = 'Hacker Beware';
$lang_block['block-Sentinel_Scrolling'] = 'Hacker Beware';
$lang_block['block-Sentinel_Side'] = 'Hacker Beware';
$lang_block['block-Sommaire'] = 'Menu';
$lang_block['block-Submissions'] = 'Submissions';
$lang_block['block-Supporters_Dn'] = 'Supporters';
$lang_block['block-Supporters_Lt'] = 'Supporters';
$lang_block['block-Supporters_Rn'] = 'Supporters';
$lang_block['block-Supporters_Rt'] = 'Supporters';
$lang_block['block-Supporters_Up'] = 'Supporters';
$lang_block['block-Survey'] = 'Surveys';
$lang_block['block-Themes'] = 'Themes';
$lang_block['block-Top10_Links'] = 'Top 10 Links';
$lang_block['block-Total_Hits'] = 'Total Hits';
$lang_block['block-Universal-Forums-Center'] = 'Forums';
$lang_block['block-User_Info'] = 'User Infobox';
$lang_block['block-User_Login'] = 'Login';
$lang_block['block-Who_is_Online'] = 'Who is Online';
/*****[END]********************************************
[ Lang: Multilingual Block Titles]
******************************************************/

?>