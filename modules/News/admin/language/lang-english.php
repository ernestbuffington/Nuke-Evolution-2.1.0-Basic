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

define("_NEWS","News");
define("_ALLTOPICS","All Topics");
define("_OK","Ok!");
define("_SAVE","Save");
define("_NOSUBJECT","No Subject");
define("_ARTICLES","Articles");
define("_AREYOUSURE","Are you sure you included a URL? Did you test them for typos?");
define("_SELECTTOPIC","Select Topic");
define("_OPTION","Option");
define("_AUTHOR","Author");
define("_NEWS_ADMIN_HEADER", "News :: Modules Admin Panel");
define("_NEWSSUBMISSION_ADMIN_HEADER", "Submissions :: Modules Admin Panel");
define("_NEWSCONFIG_ADMIN_HEADER", "News Configuration :: Modules Admin Panel");
define("_NEWS_RETURNMAIN", "Return to Main Administration");
define("_ARTICLEADMIN","Articles/Stories Administration");
define("_ADDARTICLE","Add New Article");
define("_STORYTEXT","Story Text");
define("_EXTENDEDTEXT","Extended Text");
define("_ARESUREURL","(Are you sure you included an URL? Did you test it for typos?)");
define("_PUBLISHINHOME","Publish in Home?");
define("_ONLYIFCATSELECTED","Only works if <em>Articles</em> category isn't selected");
define("_PROGRAMSTORY","Do you want to program this story?");
define("_NOWIS","Now is");
define("_DAY","Day");
define("_PREVIEWSTORY","Preview Story");
define("_POSTSTORY","Post Story");
define("_REMOVESTORY","Are you sure you want to remove Story ID #");
define("_ANDCOMMENTS","and all it's comments?");
define("_CATEGORIESADMIN","Categories Administration");
define("_CATEGORYADD","Add a New Category");
define("_CATNAME","Category Name");
define("_NOARTCATEDIT","You can't edit <em>Articles</em> Category");
define("_ASELECTCATEGORY","Select Category");
define("_CATEGORYNAME","Category Name");
define("_DELETECATEGORY","Delete Category");
define("_SELECTCATDEL","Select a Category to Delete");
define("_CATDELETED","Category Deleted!");
define("_WARNING","Warning");
define("_THECATEGORY","The Category");
define("_HAS","has");
define("_STORIESINSIDE","stories inside");
define("_DELCATWARNING1","You can Delete this Category and ALL its stories and comments");
define("_DELCATWARNING2","or you can Move ALL the stories to a New Category.");
define("_DELCATWARNING3","What do you want to do?");
define("_YESDEL","Yes! Delete ALL!");
define("_NOMOVE","No! Move my Stories");
define("_MOVESTORIES","Move Stories to a New Category");
define("_ALLSTORIES","ALL stories under");
define("_WILLBEMOVED","will be moved.");
define("_SELECTNEWCAT","Please Select the New Category");
define("_MOVEDONE","Congratulations! The move has been completed!");
define("_CATEXISTS","This Category already exists!");
define("_CATSAVED","Category Saved!");
define("_GOTOADMIN","Go back to <a href=\"%s\">Admin Section</a>");
define("_CATADDED","New Category Added!");
define("_AUTOSTORYEDIT","Edit Automated Story");
define("_NOTES","Notes");
define("_CHNGPROGRAMSTORY","Select new date for this Story:");
define("_SUBMISSIONSADMIN","Stories Submissions Administration");
define("_DELETESTORY","Delete Story");
define("_EDITARTICLE","Edit Article");
define("_NOSUBMISSIONS","No New Submissions");
define("_NEWSUBMISSIONS","New Stories Submissions");
define("_NOTAUTHORIZED1","You aren't authorized to touch this Article!");
define("_NOTAUTHORIZED2","You can't edit and/or delete articles that you don't published");
define("_POLLTITLE","Poll Title");
define("_POLLEACHFIELD","Please enter each available option into a single field");
define("_ACTIVATECOMMENTS","Activate Comments for this Story?");
define("_ATTACHAPOLL","Attach a Poll to this article");
define("_LEAVEBLANKTONOTATTACH","(Leave blank to post the article without any attached Poll)<br />(NOTE: Automated/Programmed news can't have attached Polls)");
define("_USERPROFILE","User Profile");
define("_EMAILUSER","Email User");
define("_SENDPM","Send Private Message");

/*****************************************************/
/* NEW in NSN News 1.1.0 */
/*****************************************************/
define("_NE_ARTPUB","Article Published");
define("_NE_HASPUB","The article you submitted has been published. You can view it at:");
define("_NE_NEWSCONFIG","News Configuration");
define("_NE_DISPLAYTYPE","Display Column");
define("_NE_SINGLE","Single Column");
define("_NE_DUAL","Dual Column");
define("_NE_ROTATOR", "Rotation");
define("_NE_READLINK","Read More Link");
define("_NE_POPUP","Popup");
define("_NE_PAGE","Page");
define("_NE_TEXTTYPE","Article Length");
define("_NE_TRUNCATE","Truncate to 255 chars");
define("_NE_COMPLETE","Original text");
define("_NE_NOTIFYAUTH","Notify Author");
define("_NE_NOTIFYAUTHNOTE","This will email article submitter<br />\non approval");
define("_NE_NO","No");
define("_NE_YES","Yes");
define("_NE_HOMETOPIC","Topic in Home");
define("_NE_ALLTOPICS","All Topics");
define("_NE_HOMENUMBER","Articles in Home");
define("_NE_NUKEDEFAULT","EVO Default");
define("_NE_ARTICLES","Articles");
define("_NE_HOMENUMNOTE","This will over-ride user preferences<br />\nif set other then EVO Default");
define("_NE_SAVECHANGES","Save Changes");
define("_NE_ID","ID");
define("_NE_ACTION","Action");
define("_NE_ROTATOR_WIDTH", "Width of News Rotators Content in %");
define("_NE_ROTATOR_HEIGHT", "Height of News Rotators Content in px");
define("_NE_ROTATOR_SPEED", "Rotation Speed in Milliseconds (a good value is 8000)");

define("_DISPLAY_T_ICON","Display Topic Icon with News Article?");
define("_DISPLAY_WRITES","Display Author Writes \"text\" with News Article?");

define("_LAST","last");
define("_GO","Go!");
define("_TOPICS","Topics");
define("_AUTOMATEDARTICLES","Automated Articles");
define("_NOAUTOARTICLES","There are no Automated Articles");
define("_STORYID","Story ID");

?>