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

global $module_name, $userinfo, $anonwaitdays, $outsidewaitdays;

$lang_new[$module_name]['MODULE_NAME'] = str_replace ("_", " ", $module_name);
$lang_new[$module_name]['SUBMIT_GOBACK'] = _GOBACK;
$lang_new[$module_name]['ADD_LINK'] = 'Add a Link';
$lang_new[$module_name]['ADMIN_ADD_CAT'] = 'Bir Kategori Ekle';
$lang_new[$module_name]['ADMIN_ADD_LINK'] = 'Bir Bağlantı Ekle';
$lang_new[$module_name]['ADMIN_ADD_SUBCAT'] = 'Bir Alt Kategori Ekle';
$lang_new[$module_name]['ADMIN_BROKEN_LINK'] = 'Kırık Bağlantıları Yönet';
$lang_new[$module_name]['ADMIN_CATSUB_VALIDATE'] = 'Validate SubCategory';
$lang_new[$module_name]['ADMIN_CAT_ATTACHED'] = 'attached to this Category';
$lang_new[$module_name]['ADMIN_CAT_VALIDATE'] = 'Kategoriyi Onayla';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY'] = 'Kategorileri Kontrol Et';
$lang_new[$module_name]['ADMIN_CHECK_CATEGORY_INCLSUB'] = 'Alt Kategorileri Dahil Et';
$lang_new[$module_name]['ADMIN_COMMENTS_DELETE'] = 'Yorumları Sil';
$lang_new[$module_name]['ADMIN_EDITORIAL_ADD'] = 'Add Editorial';
$lang_new[$module_name]['ADMIN_EDITORIAL_MODIFY'] = 'Modify Editorial';
$lang_new[$module_name]['ADMIN_GO_MAIN'] = 'Ana Yönetim Ekranına Geri Dön';
$lang_new[$module_name]['ADMIN_HEADER'] = 'Nuke-Evolution Web Linkleri :: Eklenti Yönetim Paneli';
$lang_new[$module_name]['ADMIN_IMAGE_PREVIEW'] = 'Image Preview';
$lang_new[$module_name]['ADMIN_LINK_CHECK'] = 'Check Links';
$lang_new[$module_name]['ADMIN_LINK_CHECK_ALL'] = 'Tüm Bağlantıları Kontrol Et';
$lang_new[$module_name]['ADMIN_LINK_ORIGINAL'] = 'Original Link';
$lang_new[$module_name]['ADMIN_LINK_PROPOSED'] = 'Proposed Link';
$lang_new[$module_name]['ADMIN_LINK_RATING'] = 'Puan';
$lang_new[$module_name]['ADMIN_LINK_RATING_AVERAGE'] = 'Users Average Rating';
$lang_new[$module_name]['ADMIN_LINK_RATING_TOTAL'] = 'Users Total Rating';
$lang_new[$module_name]['ADMIN_LINK_VALIDATE'] = 'Bağlantıları Onayla';
$lang_new[$module_name]['ADMIN_LINK_VALIDATE_WAIT'] = 'Waiting ..';
$lang_new[$module_name]['ADMIN_LINK_VOTE_GUESTS'] = 'Guests Votes';
$lang_new[$module_name]['ADMIN_LINK_VOTE_REGUSER'] = 'Registered User Votes';
$lang_new[$module_name]['ADMIN_LINK_VOTE_TOTAL'] = 'Toplam Oy';
$lang_new[$module_name]['ADMIN_LINK_VOTE_UNREG'] = 'UnRegistered User Votes';
$lang_new[$module_name]['ADMIN_MODIFY_CAT'] = 'Kategoriyi Düzenle';
$lang_new[$module_name]['ADMIN_MODIFY_LINK'] = 'Bağlantıları Düzenle';
$lang_new[$module_name]['ADMIN_MODIFY_LINK_REQUEST'] ='Manage Link Requests';
$lang_new[$module_name]['ADMIN_MODULE_SETTINGS'] = 'Eklentiye Özel Ayarlar';
$lang_new[$module_name]['ADMIN_OPTIONS'] = 'Admin Options:';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_BREAKS_NO'] = 'How many line-breaks should be inserted between each link?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_HEIGHT'] = 'Height of the Block in Pixel';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_HEIGHT'] = 'Image Size: Height';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_SHOW'] = 'Resimleri Göster';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_IMAGE_WIDTH'] = 'Image Size: Width';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_ROWS'] = 'How many links should be shown in the Links-block?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL'] = 'Should those links be shown scrolling?';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_AMOUNT'] = 'Scroll amount';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_DIRECTION'] = 'Scroll direction';
$lang_new[$module_name]['ADMIN_SETTING_BLOCK_SCROLL_TITLE'] ='Scroll behavior';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BEHAVIOR'] = 'Behavior';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_BLOCKS'] = 'Block Settings';
$lang_new[$module_name]['ADMIN_SETTING_FIELDSET_VOTING'] = 'Vote Settings';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_DETAIL'] = 'How many decimal places should be shown in Vote details?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_DECIMAL_MAIN'] = 'How many decimal places should be shown anywhere else?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_LINKS_PER_PAGE'] = 'Number of Web Links shown per page';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_ADMINLINKS'] = 'Should WebAdmins be able to add Web Links on their sites?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_BESTLINKS'] = 'Number of Web Links shown in the Most Popular page?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_NEWLINKS'] = 'Number of Web Links shown in the New Link page?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_POPULAR'] = 'How many hits should a WebLink have to become popular?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_SEARCHLINKS'] = 'Number of Web Links shown in the Search page (Search Results)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNLINKS'] = 'Should Guests be able to submit new Web Links?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWNVOTING'] = 'Allow Guests to Vote? <br />(If you do not allow, Outside Voters are not allowed too)';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_NO_UNKNOWN_MODREQ'] = 'Block Guests from suggesting Link changes?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_GUEST_TO_REGISTERED'] = 'Percentage (xx/100):  Guest votes against votes from registered Users';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_PERC_UNREG_TO_REGISTERED'] = 'Percentage (xx/100):  Unregistered Users (ae. Admins) votes against votes from registered Users';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_PERCENT'] = 'Should Popular Links be shown as Percent<br />(otherwise they are shown as #/Totallinks)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_POPULAR_VOTEMIN'] = 'How many Percent or Numbers must be reached to show a WebLink as Popular Link?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_SHOW_FEATURE_BOX'] ='Show Web Links Header on Main Page?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TITLE'] = 'Genel Ayarlar';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_PERCENT'] = 'Should TopLinks be shown as Percent<br />(otherwise they are shown as #/Totallinks)?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPLINKS_VOTEMIN'] = 'How many Percent or Numbers must be reached to show a WebLink as Toplink?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_TOPVOTE_MIN'] = 'Number of votes a WebLink must have to become a TopVoted WebLink?';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNKNOWN'] = 'Number of Days Guests must wait before they can vote for a WebLink';
$lang_new[$module_name]['ADMIN_SETTING_GENERAL_VOTEDAYS_UNREGS'] = 'Number of Days unregistered Users (ae. Admins) must wait before they can vote for a WebLink';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_HEIGHT'] = 'Image Size: Height';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_URL'] = 'Enter the URL of the thumbnail-server<br />(Example: http://www.websitethumbnails.net/view.php?url=)';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_THUMBNAIL_USE'] = 'Should we use a thumbnail-server to show Link-Images?';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_TITLE'] = 'Image behavior';
$lang_new[$module_name]['ADMIN_SETTING_IMAGE_WIDTH'] = 'Image Size: Width';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR1'] = 'Table Background Color 1';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_COLOR2'] = 'Table Background Color 2';
$lang_new[$module_name]['ADMIN_SETTING_TABLE_TITLE'] = 'Table behavior';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_HEIGHT'] = 'Height of the Top-Box in Pixel';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL'] = 'Should those links be shown scrolling?';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_AMOUNT'] = 'Scroll amount';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SCROLL_DIRECTION'] = 'Scroll direction';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW'] = 'Should the Top-Box be shown? ';
$lang_new[$module_name]['ADMIN_SETTING_TOPBOX_SHOW_LINKS'] = 'How many entries should be shown in the Top-Box?';
$lang_new[$module_name]['ADMIN_SETTING_USE_SECURITYCODE'] = 'Use Security Code ?';
$lang_new[$module_name]['ADMIN_TRANSFER_CAT'] = 'Kategoriyi Transfer Et';
$lang_new[$module_name]['ADMIN_VALIDATE_FAILED'] = 'Validation failed';
$lang_new[$module_name]['ADMIN_VALIDATE_OPTIONS'] = 'Seçenekler';
$lang_new[$module_name]['ADMIN_WEBLINKSADMIN'] = 'Web Links Administration';
$lang_new[$module_name]['ADMIN_WEBLINKS_STATUS'] = 'Web Links Status';
$lang_new[$module_name]['AND'] = 'and';
$lang_new[$module_name]['AUTHOR'] = 'Author';
$lang_new[$module_name]['BE_PATIENT'] = 'One Moment please ...';
$lang_new[$module_name]['BOX_HEADER_NEW'] = 'New Links Hitlist';
$lang_new[$module_name]['BOX_HEADER_TOP'] = 'Top Links Hitlist';
$lang_new[$module_name]['BY'] = 'by';
$lang_new[$module_name]['CATEGORIES'] = 'Categories';
$lang_new[$module_name]['CATEGORIES'] = 'Categories';
$lang_new[$module_name]['CATEGORIESSUB'] = 'SubCategories';
$lang_new[$module_name]['CATEGORY'] = 'Category';
$lang_new[$module_name]['CATEGORYSUB'] = 'SubCategory';
$lang_new[$module_name]['COMMENTS'] = 'Comments';
$lang_new[$module_name]['COMMENTS_NUMBER'] = 'Number of Comments';
$lang_new[$module_name]['COMMENTS_TOTAL'] = 'Comments total';
$lang_new[$module_name]['DATE'] = 'Date';
$lang_new[$module_name]['DATE_WRITTEN'] = 'written on';
$lang_new[$module_name]['DAYS'] = 'Days';
$lang_new[$module_name]['DAYS_30'] = '30 Days';
$lang_new[$module_name]['DELETE'] = 'Delete';
$lang_new[$module_name]['DESCRIPTION'] = 'Description';
$lang_new[$module_name]['DOWN'] = 'Down';
$lang_new[$module_name]['DO_RATE'] = 'Rate this Site';
$lang_new[$module_name]['DO_REPORT_BROKEN'] = 'Submit Report Broken Link';
$lang_new[$module_name]['DO_SHOW_COMMENTS'] = 'Comments';
$lang_new[$module_name]['DO_SHOW_DETAILS'] = 'Details';
$lang_new[$module_name]['DO_VOTE_THIS_SITE'] = 'Vote for this Site';
$lang_new[$module_name]['EDIT'] = 'Edit';
$lang_new[$module_name]['EDITORIAL'] = 'Editorial';
$lang_new[$module_name]['EDITORIAL_BY'] = 'Editorial posted by';
$lang_new[$module_name]['EMAIL'] = 'Email';
$lang_new[$module_name]['ERROR_CAT_EXISTS'] = 'The Category or SubCategory you wanted to create already exists in our database <br />Please go back and try it again.';
$lang_new[$module_name]['ERROR_NO_CONFIG'] = 'There is a problem within the database. No '.$module_name.' configuration could be found.';
$lang_new[$module_name]['ERROR_NO_DESCRIPTION'] = 'A Description of the Link is essential <br />Please go back and add it';
$lang_new[$module_name]['ERROR_NO_LID'] = 'We found no Link in our database which is suitable to your choice.<br />Please go back and try it again.';
$lang_new[$module_name]['ERROR_NO_TITLE'] = 'A Title for the Link is essential <br />Please go back and add it';
$lang_new[$module_name]['ERROR_NO_URL'] = 'A URL to the Link is essential <br />Please go back and add it';
$lang_new[$module_name]['ERROR_SECURITYCODE'] = 'The Security Code you have entered doesn\'t fit. Please try again.<br />(It could be a good idea to refresh your browser when you\'re back so the security code is refreshed too)<br /><br />'._GOBACK;
$lang_new[$module_name]['ERROR_URL_EXISTS'] = 'The URL to the Link exists in our database <br />Please go back and correct it';
$lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] = 'The URL to the Link or the Title exists in our database <br />Please go back and correct it';
$lang_new[$module_name]['HITS'] = 'Hits';
$lang_new[$module_name]['IGNORE'] = 'Ignore';
$lang_new[$module_name]['IMAGE_PIXEL'] = 'in Pixel';
$lang_new[$module_name]['IN'] = 'In';
$lang_new[$module_name]['INDEX_PAGE'] = 'Index Page';
$lang_new[$module_name]['INFO_ALLOW_TO_RATE'] = 'Allow other users to rate it from your web site!';
$lang_new[$module_name]['INFO_DELETE'] = 'Delete (Deletes <strong><em>broken link</em></strong> and <strong><em>requests</em></strong> for a given link)"';
$lang_new[$module_name]['INFO_IGNORE'] = 'Ignore (Deletes all <strong><em>requests</em></strong> for a given link)';
$lang_new[$module_name]['INFO_ISTHSYOURSITE'] = 'Is this your resource?';
$lang_new[$module_name]['INFO_LOOK_AFTER'] = 'We\'ll look into your request shortly.';
$lang_new[$module_name]['INFO_NO_SUBCAT'] = '--- No SubCategory ---';
$lang_new[$module_name]['INFO_ONLYONCE'] = 'Please submit your URL only once.<br />We check you URL against existing ones in our database.';
$lang_new[$module_name]['INFO_ONLYREGISTERED'] = 'Sorry, but we allow only registered Users to do the action you have selected on our site.<br />If you are a registered user, you are not logged in at the moment. You can login <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">here</a></strong><br />Otherwise you can register yourself <strong><a href="modules.php?name=Your_Account&amp;module='.$module_name.'">here</a></strong>';
$lang_new[$module_name]['INFO_PENDING'] = 'Your Link will be activated after being checked by our Team.<br />After we have verified your link you will be informed by through an email.';
$lang_new[$module_name]['INFO_PROMOTE_1'] = 'Maybe you can be interested in several of the remote <em>Rate a Website</em> options we have available. These allow you to place an image (or even a rating form) on your web site in order to increase the number of votes your resource receive. Please choose from one of the options listed below:';
$lang_new[$module_name]['INFO_PROMOTE_2'] = 'One way to link to the rating form is through a simple text link:';
$lang_new[$module_name]['INFO_PROMOTE_3'] = 'If you\'re looking for a little more than a basic text link, you may wish to use a small button link:';
$lang_new[$module_name]['INFO_PROMOTE_4'] = 'If you cheat on this, we`ll remove your link. Having said that, here is what the current remote rating form looks like.';
$lang_new[$module_name]['INFO_PROMOTE_5'] = 'Thanks! and good luck with your ratings!';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_1'] = 'The HTML code you should use in this case, is the following:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_2'] = 'The source code for the above button is:';
$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_3'] = 'Using this form will allow users to rate your resource directly from your site and the rating will be recorded here. The above form is disabled, but the following source code will work if you simply cut and paste it into your web page. The source code is shown below:';
$lang_new[$module_name]['INFO_RATE_ADDED_COMMENT'] = 'Input from users such as yourself will help other visitors better decide which links to click on.';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU'] = 'Thank you for taking the time to rate a site here at:';
$lang_new[$module_name]['INFO_RATE_ADDED_THANKYOU_2'] = '.';
$lang_new[$module_name]['INFO_RATE_CANDO'] = 'Feel free to add a comment about this site.';
$lang_new[$module_name]['INFO_RATE_CANNOTDO'] = 'If you were registered you could make comments on this website.';
$lang_new[$module_name]['INFO_RATE_COMPLETED_OK'] = 'Your rating is appreciated.';
$lang_new[$module_name]['INFO_RATING_1'] = 'Please do not vote for the same resource more than once.';
$lang_new[$module_name]['INFO_RATING_2'] = 'The scale is 1 - 10, with 1 being poor and 10 being excellent.';
$lang_new[$module_name]['INFO_RATING_3'] = 'Please be objective in your vote, if everyone receives a 1 or a 10, the ratings aren`t very useful.';
$lang_new[$module_name]['INFO_RATING_4'] = 'You can view a list of the <a href="modules.php?name='.$module_name.'&amp;op=TopRated">Top Rated Resources</a>.';
$lang_new[$module_name]['INFO_RATING_5'] = 'Do not vote for your own resource or a competitor.';
$lang_new[$module_name]['INFO_REG_LOGGEDIN'] = 'You are a registered user and are logged in.';
$lang_new[$module_name]['INFO_THANKS'] = 'Thanks for the information.';
$lang_new[$module_name]['INFO_UNREG_LOGGEDOUT'] = 'You are not a registered user or you have not logged in.';
$lang_new[$module_name]['INSTRUCTIONS'] = 'Instructions';
$lang_new[$module_name]['IN_DB'] = 'in our Database';
$lang_new[$module_name]['IP_ADRESS'] = 'IP Address';
$lang_new[$module_name]['LINKS'] = 'Links';
$lang_new[$module_name]['LINKS_NEW'] = 'New Links';
$lang_new[$module_name]['LINK_ID'] = 'Link ID';
$lang_new[$module_name]['LINK_IMAGE'] = 'Image';
$lang_new[$module_name]['LINK_IMAGE_URL'] = 'Image URL';
$lang_new[$module_name]['LINK_OWNER'] = 'Link Owner';
$lang_new[$module_name]['LINK_PAGETITLE'] = 'Page Title';
$lang_new[$module_name]['LINK_PROFILE'] = 'Link Profile';
$lang_new[$module_name]['LINK_SUBMIT'] = 'Submit new Link';
$lang_new[$module_name]['LINK_SUBMITTER'] = 'Link Submitter';
$lang_new[$module_name]['LINK_SUBMIT_DATE'] = 'Link submitted on';
$lang_new[$module_name]['LINK_URL'] = 'Link URL';
$lang_new[$module_name]['LINK_VALIDATE_DATE'] = 'Link validated on';
$lang_new[$module_name]['MAIL_APPROVED_MESSAGE'] = 'Congratulations! The web link you submitted to our links database has been approved right now and is available to the users of the site.';
$lang_new[$module_name]['MAIL_BROWSEURL'] = 'Check our Web Links Database with a click on this URL ->';
$lang_new[$module_name]['MAIL_HELLO'] = 'Hello';
$lang_new[$module_name]['MAIL_SIGNATURE'] = 'The Team';
$lang_new[$module_name]['MAIL_SITENAME'] = 'Your WebLink at: ';
$lang_new[$module_name]['MAIL_THANKYOU'] = 'Kind thanks for your submission - You will always be welcome on our website';
$lang_new[$module_name]['MAIN_CATEGORY_PAGE'] = $lang_new[$module_name]['MODULE_NAME'] . ' Main Category Page';
$lang_new[$module_name]['MESSAGE_ADMIN_SETTINGS_SAVED'] = '<span style="color:green">Your Module Settings are saved in the Database.<br />Check your Error log for information about saving errors</span>';
$lang_new[$module_name]['MESSAGE_COMMENT_DELETE_ALL'] = 'All Comments are deleted from Database<br />Hopefully you haven\'t made a mistake<br />They cannot be recovered';
$lang_new[$module_name]['MESSAGE_EDITORIAL_ADDED'] = 'Your Editorial is successfully saved in the Database';
$lang_new[$module_name]['MESSAGE_EDITORIAL_MODIFIED'] = 'Your Editorial is successfully modified';
$lang_new[$module_name]['MESSAGE_EDITORIAL_REMOVED'] = 'Your Editorial is successfully removed';
$lang_new[$module_name]['MESSAGE_LINK_ADDED'] = 'Your Link is successfully saved in the Database';
$lang_new[$module_name]['MESSAGE_LINK_BROKEN_ADDED'] = 'Thank you for helping to maintain this directory\'s integrity.';
$lang_new[$module_name]['MESSAGE_LINK_BROKEN_EXISTS'] = 'Thank you for helping to maintain this directory\'s integrity. <br />But another user was faster than you and reported us this broken link.';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED'] = 'We received your Link submission. Thanks!';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_EMAIL'] = 'You will receive an Email after our Team has checked your submission.';
$lang_new[$module_name]['MESSAGE_LINK_SUBMITTED_NOEMAIL'] = 'You didn\'t provide an Email address but we will check your link soon.<br />So please look from time to time if your Submission is activated.';
$lang_new[$module_name]['MESSAGE_LINK_VALIDATED'] ='The Link is successfully validated and saved in the Database!';
$lang_new[$module_name]['MESSAGE_RATING_ADDED'] = 'Your Link is successfully saved in the Database';
$lang_new[$module_name]['MODIFY'] = 'Modify';
$lang_new[$module_name]['MODIFY_LINK_REQUEST'] = 'Request Link Modification';
$lang_new[$module_name]['MOST_POPULAR'] = 'Most Popular';
$lang_new[$module_name]['NAME'] = 'Name';
$lang_new[$module_name]['NEW_LAST30DAY'] = 'New Last 30 Days';
$lang_new[$module_name]['NEW_LAST3DAY'] = 'New Last 3 Days';
$lang_new[$module_name]['NEW_LASTWEEK'] = 'New Last Week';
$lang_new[$module_name]['NEW_THISWEEK'] = 'New This Week';
$lang_new[$module_name]['NEW_TODAY'] = 'New Today';
$lang_new[$module_name]['NEW_TOTAL'] = 'Total New Links';
$lang_new[$module_name]['NEW_TOTAL_FORLAST'] = 'Total New Links for last';
$lang_new[$module_name]['NONE'] = 'None';
$lang_new[$module_name]['NOTE'] = 'Note';
$lang_new[$module_name]['OF'] = 'of';
$lang_new[$module_name]['OK'] = 'OK';
$lang_new[$module_name]['PAGE_NEXT'] = 'Next Page';
$lang_new[$module_name]['PAGE_NONEXT'] = 'No Next Page';
$lang_new[$module_name]['PAGE_NOPREVIOUS'] = 'No Previous Page';
$lang_new[$module_name]['PAGE_PREVIOUS'] = 'Previous Page';
$lang_new[$module_name]['PICSIZE'] = 'The maximum size of the Picture should be: ';
$lang_new[$module_name]['PICSIZE_HEIGHT'] = 'height';
$lang_new[$module_name]['PICSIZE_WIDTH'] = 'width';
$lang_new[$module_name]['POPULAR'] = 'Popular';
$lang_new[$module_name]['PROMOTE_RATING_BUTTON_LINK'] = 'Button Link';
$lang_new[$module_name]['PROMOTE_RATING_FORM'] = 'Remote Rating Form';
$lang_new[$module_name]['PROMOTE_RATING_ID_REFERER'] = 'in the HTML source references your site\'s ID number in '.EVO_SERVER_SITENAME.' database. Be sure this number is present.';
$lang_new[$module_name]['PROMOTE_RATING_TEXT_LINK'] = 'Text Link';
$lang_new[$module_name]['PROMOTE_RATING_THE_NUMBER'] = 'The Number';
$lang_new[$module_name]['PROMOTE_YOUR_WEBSITE'] = 'Promote your Website';
$lang_new[$module_name]['RATED_BEST'] = 'Best Rated';
$lang_new[$module_name]['RATED_BEST_HEADER'] = 'Best Rated Links - Top';
$lang_new[$module_name]['RATED_NUMBERS'] = 'Number of Rated Links';
$lang_new[$module_name]['RATED_TOTAL'] = 'Total Rated Links';
$lang_new[$module_name]['RATED_USER_AVERAGE'] = 'Users Average Rating';
$lang_new[$module_name]['RATING'] = 'Rating';
$lang_new[$module_name]['RATING_BREAKDOWN_VALUES'] = 'Breakdown of Ratings by Value';
$lang_new[$module_name]['RATING_DETAILS'] = 'Rating Details';
$lang_new[$module_name]['RATING_LINK'] = 'Links Rating';
$lang_new[$module_name]['RATING_LINK_HIGHEST'] = 'Highest Rating';
$lang_new[$module_name]['RATING_LINK_LOWEST'] = 'Lowest Rating';
$lang_new[$module_name]['RATING_NUMBERS'] = 'Number of Ratings';
$lang_new[$module_name]['RATING_OVERALL'] = 'Overall Rating';
$lang_new[$module_name]['RATING_WEIGHT_NOTE'] = '* Note: This Resource weighs Registered vs. Unregistered users ratings';
$lang_new[$module_name]['RATING_WEIGHT_OUTNOTE'] = '* Note: This Resource weighs Registered vs. Outside voters ratings';
$lang_new[$module_name]['REPORT_BROKEN'] = 'Report Broken Link';
$lang_new[$module_name]['SCROLL_DOWN'] = 'Down';
$lang_new[$module_name]['SCROLL_UP'] = 'Up';
$lang_new[$module_name]['SEARCH_RESULTS_CATEGORIES'] = 'Found in Categories';
$lang_new[$module_name]['SEARCH_RESULTS_HEADER'] = 'Search Results for your query:';
$lang_new[$module_name]['SEARCH_RESULTS_LINKS'] = 'Found in Links';
$lang_new[$module_name]['SEARCH_RESULTS_NO_MATCH'] = 'Sorry, but we didn\'t find a match to your Search in our Database';
$lang_new[$module_name]['SEARCH_RESULTS_OTHER_ENGINES'] = 'in other Search engines';
$lang_new[$module_name]['SEARCH_RESULTS_TRYSEARCH'] = 'Try to Search';
$lang_new[$module_name]['SHOW'] = 'Show';
$lang_new[$module_name]['SHOW_EDITORIAL'] = 'Show Editorial';
$lang_new[$module_name]['SHOW_LINK_COMMENTS'] = 'Show Link Comments';
$lang_new[$module_name]['SHOW_MOSTPOPULAR'] = 'Show Most Popular Links';
$lang_new[$module_name]['SHOW_NEWSLINKS'] = 'Show New Links';
$lang_new[$module_name]['SHOW_RANDOM'] = 'Show Random Links';
$lang_new[$module_name]['SHOW_TOPRATED'] = 'Show Toprated Links';
$lang_new[$module_name]['SORTS_BY'] = 'Sort Links by';
$lang_new[$module_name]['SORTS_DATE_DOWN'] = 'Date (New Links Listed First)';
$lang_new[$module_name]['SORTS_DATE_UP'] = 'Date (Old Links Listed First)';
$lang_new[$module_name]['SORTS_IS'] = 'Links currently sorted by';
$lang_new[$module_name]['SORTS_POPULARITY_DOWN'] = 'Popularity (Most to Least Hits)';
$lang_new[$module_name]['SORTS_POPULARITY_UP'] = 'Popularity (Least to Most Hits)';
$lang_new[$module_name]['SORTS_RATING_DOWN'] = 'Rating (Highest Scores to Lowest Scores)';
$lang_new[$module_name]['SORTS_RATING_UP'] = 'Rating (Lowest Scores to Highest Scores)';
$lang_new[$module_name]['SORTS_TITLEAZ'] = 'Title (A to Z)';
$lang_new[$module_name]['SORTS_TITLEZA'] = 'Title (Z to A)';
$lang_new[$module_name]['SUBMIT_ACCEPT'] = 'Accept';
$lang_new[$module_name]['SUBMIT_ADD'] = 'Add';
$lang_new[$module_name]['SUBMIT_BACK_CATEGORY'] = 'Back to Category';
$lang_new[$module_name]['SUBMIT_DELETE'] = 'Delete';
$lang_new[$module_name]['SUBMIT_DOIT'] = 'Do it';
$lang_new[$module_name]['SUBMIT_MODIFY'] = 'Modify';
$lang_new[$module_name]['SUBMIT_MODIFY_REQUEST'] = 'Submit Modify Request';
$lang_new[$module_name]['SUBMIT_RETURN'] = 'Return';
$lang_new[$module_name]['SUBMIT_SAVE'] = 'Save';
$lang_new[$module_name]['SUBMIT_VOTE'] = 'Vote !';
$lang_new[$module_name]['THERE_ARE'] = 'There are ';
$lang_new[$module_name]['TITLE'] = 'Başlık';
$lang_new[$module_name]['TO'] = 'To';
$lang_new[$module_name]['TOTAL'] = 'Total';
$lang_new[$module_name]['TOTAL_LINKS'] = 'Total Links';
$lang_new[$module_name]['UP'] = 'Up';
$lang_new[$module_name]['USER'] = 'User';
$lang_new[$module_name]['USER_REGISTERED'] = 'Registered User';
$lang_new[$module_name]['USER_REGISTERED_NOT'] = 'Not Registered User';
$lang_new[$module_name]['VIEW_FULL'] = 'View full screen';
$lang_new[$module_name]['VISIT'] = 'Visit';
$lang_new[$module_name]['VOTE'] = 'Vote';
$lang_new[$module_name]['VOTERS_OUTSIDE'] = 'Outside Voters';
$lang_new[$module_name]['VOTERS_UNREGISTERED'] = 'Unregistered Users (Voters)';
$lang_new[$module_name]['VOTES'] = 'Votes';
$lang_new[$module_name]['VOTES_OUTSIDE_NONE'] = 'No Outside Votes';
$lang_new[$module_name]['VOTES_REGISTERED_NONE'] = 'No Registered Users Votes';
$lang_new[$module_name]['VOTES_TOTAL'] = 'Total Votes';
$lang_new[$module_name]['VOTES_UNREGISTERED_NONE'] = 'No Unregistered Users Votes';
$lang_new[$module_name]['VOTE_MINIMUM'] = 'minimum votes required';
$lang_new[$module_name]['WARN_CAT_DELETE'] = '<span style="color:red">WARNING : Are you sure you want to delete this category ? <br />You will delete all sub-categories and attached links as well !</span>';
$lang_new[$module_name]['WARN_CAT_NOT_FOUND'] = '<span style="color:red">There is no Category to delete/modify/edit/transfer</span>';
$lang_new[$module_name]['WARN_COMMENT_DELETE_ALL'] = '<span style="color:red">ATTENTION<br />This will delete <em>ALL</em> Comments from <em>EVERY</em> Link.<br />To Delete Comments from a special Link, select <em>'. $lang_new[$module_name]['ADMIN_MODIFY_LINK'] .'</em> from the Admin menu</span>';
$lang_new[$module_name]['WARN_COMMENT_NOT_FOUND'] = '<span style="color:red">There is no Comment to delete/modify/edit/validate</span>';
$lang_new[$module_name]['WARN_DETAILS_NOT_FOUND'] = '<span style="color:red">There are no Details to show for this link</span>';
$lang_new[$module_name]['WARN_EDITORIAL_NOT_FOUND'] = '<span style="color:red">There is no Editorial to show</span>';
$lang_new[$module_name]['WARN_LINK_NOT_FOUND'] = '<span style="color:red">There is no Link to delete/modify/edit/validate</span>';
$lang_new[$module_name]['WARN_RATE_COMPLETED_TOSHORT'] = '<span style="color:red">You have already voted for this resource in the past '.$anonwaitdays.' day(s).</span>';
$lang_new[$module_name]['WARN_RATE_NOT_SELF'] = '<span style="color:red">You cannot vote on a link you submitted.<br />All votes are logged and reviewed</span>';
$lang_new[$module_name]['WARN_RATE_NO_SELECTED'] = '<span style="color:red">No rating selected - no vote tallied.</span>';
$lang_new[$module_name]['WARN_RATE_ONLY_ONCE'] = '<span style="color:red">You can only vote once for a resource.<br />All votes are logged and reviewed</span>';
$lang_new[$module_name]['WARN_RATE_OUTSIDE_TOSHORT'] = '<span style="color:red">Only one vote per IP address allowed every '.$outsidewaitdays.' day(s).</span>';
$lang_new[$module_name]['WARN_RECORDED'] = '<span style="color:red">Your Username and IP-Address is recorded, so please, don\'t abuse the system</span>';
$lang_new[$module_name]['WARN_VOTE_NOT_FOUND'] = '<span style="color:red">There is no Vote to delete/modify/edit/validate</span>';
$lang_new[$module_name]['WEBLINKS_IN_DB'] = 'Links in our database.';
$lang_new[$module_name]['WEBLINKS_SIGNATURE'] = 'The Team';
$lang_new[$module_name]['WEEKS_1'] = '1 Week';
$lang_new[$module_name]['WEEKS_2'] = '2 Weeks';
$lang_new[$module_name]['WELCOME_USERNAME'] = "Hi ".UsernameColor($userinfo['username']).", ";

?>