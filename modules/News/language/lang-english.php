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

define("_ALLOWEDHTML","Allowed HTML:");
define("_ALREADYVOTEDARTICLE","Sorry, you already voted for this article recently!");
define("_ARTICLEPOLL","Article's Poll");
define("_ARTICLERATING","Article Rating");
define("_AVERAGESCORE","Average Score");
define("_BACKTOARTICLEPAGE","Back to Article's Page");
define("_BAD","Bad");
define("_BYTESMORE","bytes more");
define("_CASTMYVOTE","Cast my Vote!");
define("_COMESFROM","This article comes from");
define("_COMMENT","comment");
define("_COMMENTREPLY","Comment Post");
define("_COMMENTSQ","comments?");
define("_COMMENTSWARNING","The comments are owned by the poster. We aren't responsible for their content.");
define("_COMREPLYPRE","Comment Post Preview");
define("_CONFIGURE","Configure");
define("_CONSIDERED","considered the following article interesting and wanted to send it to you.");
define("_DIDNTRATE","You didn't select any score for the article!");
define("_EXCELLENT","Excellent");
define("_EXTRANS","Extrans (html tags to text)");
define("_FDATE","Date:");
define("_FFRIENDEMAIL","Your Friend's E-mail:");
define("_FFRIENDNAME","Your Friend's Name:");
define("_FLAT","Flat");
define("_FRIEND","Send to a Friend");
define("_FSTORY","Story");
define("_FTOPIC","Topic:");
define("_FYOUREMAIL","Your E-mail:");
define("_FYOURNAME","Your Name:");
define("_GOOD","Good");
define("_GOTOHOME","Go to Home");
define("_GOTONEWSINDEX","Go to News Index");
define("_HASSENT","Has been sent to");
define("_HIGHEST","Highest Scores First");
define("_HTMLFORMATED","HTML Formatted");
define("_INTERESTING_ARTICLE","Interesting Article at");
define("_LOGINCREATE","Login/Create an Account");
define("_MOREABOUT","More about");
define("_MOSTREAD","Most read story about");
define("_NAME","Name");
define("_NESTED","Nested");
define("_NEWEST","Newest First");
define("_NEWS", "News");
define("_NEWSBY","News by");
define("_NEWUSER","New User");
define("_NOANONCOMMENTS","No Comments Allowed for Anonymous, please <a href=\"modules.php?name=Your_Account\">register</a>");
define("_NOCOMMENTS","No Comments");
define("_NOCOMMENTSACT","Sorry, Comments are not available for this article.");
define("_NOINFO4TOPIC","Sorry, there isn't information for the selected topic.");
define("_NOSUBJECT","No Subject");
define("_NOTRIGHT","Something is not right with passing a variable to this function. This message is just to keep things from messing up down the road");
define("_OK","Ok!");
define("_OLDEST","Oldest First");
define("_ONN","on...");
define("_OPTIONS","Options");
define("_PARENT","Parent");
define("_PDATE","Date:");
define("_PLAINTEXT","Plain Old Text");
define("_POSTANON","Post Anonymously");
define("_PREVIEW","Preview");
define("_PRINTER","Printer Friendly");
define("_PTOPIC","Topic:");
define("_RATEARTICLE","Article Rating");
define("_RATETHISARTICLE","Please take a second and vote for this article:");
define("_READMORE","Read More...");
define("_READPDF","Read as PDF");
define("_READREST","Read the rest of this comment...");
define("_READWITHCOMMENTS", "You can read the complete story with its comments from");
define("_RECOMMEND","Recommend this Site to a Friend");
define("_REFRESH","Refresh");
define("_REGULAR","Regular");
define("_RELATED","Related Links");
define("_REPLY","Reply to This");
define("_REPLYMAIN","Post Comment");
define("_ROOT","Root");
define("_SCORE","Score:");
define("_SEARCHDIS","Search Discussion");
define("_SEARCHONTOPIC","Search on This Topic");
define("_SELECTNEWTOPIC","Select a New Topic");
define("_SEND","Send");
define("_SENDAMSG","Send a Message");
define("_SID_FAILURE", "We cannot find the article you have searched for");
define("_SUBJECT","Subject");
define("_THANKS","Thanks!");
define("_THANKSVOTEARTICLE","Thanks for voting for this article!");
define("_THEURL","The URL for this story is:");
define("_THREAD","Thread");
define("_THRESHOLD","Threshold");
define("_TOAFRIEND","to a specified friend:");
define("_UCOMMENT","Comment");
define("_URL","URL");
define("_USERINFO","User Info");
define("_VERYGOOD","Very Good");
define("_YOUCANREAD","You can read interesting articles at");
define("_YOURFRIEND","Your Friend");
define("_YOURNAME","Your Name");
define("_YOUSENDSTORY","You will send the story");

/*****[BEGIN]******************************************
[ Mod: NSN News v1.1.0 ]
******************************************************/
define("_NE_ALLTOPICS","All Topics");
define("_NE_ARTICLES","Articles");
define("_NE_CATEGORY","Category");
define("_NE_COMPLETE","Original text");
define("_NE_COUNTRATINGS","Counted Ratings");
define("_NE_DISPLAYTYPE","Display Column");
define("_NE_DUAL","Dual Column");
define("_NE_HOMENUMBER","Articles in Home");
define("_NE_HOMENUMNOTE","This will override user preferences<br />\nif set other than EVO Default");
define("_NE_HOMETOPIC","Topic in Home");
define("_NE_MODERATE","Submit Moderation");
define("_NE_NEWSCONFIG","News Configuration");
define("_NE_NO","No");
define("_NE_NONE_NEWS","No News available");
define("_NE_NOTIFYAUTH","Notify Author");
define("_NE_NOTIFYAUTHNOTE","This will email article submitter<br />\non approval");
define("_NE_NO_EMPTY_COMMENT","One of the fields: subject or comment is empty. Please go back.<br />"._GOBACK);
define("_NE_NUKEDEFAULT","EVO Default");
define("_NE_OF","of");
define("_NE_PAGE","Page");
define("_NE_PAGES","pages");
define("_NE_POPUP","Popup");
define("_NE_READLINK","Read More Link");
define("_NE_SAVECHANGES","Save Changes");
define("_NE_SELECT","Select Page");
define("_NE_SINGLE","Single Column");
define("_NE_TEXTTYPE","Article Length");
define("_NE_TRUNCATE","Truncate to 255 chars");
define("_NE_WEBSITE","Website");
define("_NE_YES","Yes");
/*****[END]********************************************
[ Mod: NSN News v1.1.0 ]
******************************************************/

?>