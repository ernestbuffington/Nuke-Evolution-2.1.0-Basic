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

if (!defined('ADMIN_FILE') && !defined('IN_SETTINGS')) {
   exit('Bu Dosya Yönetim Sistemi Dışından Çağırılamaz!');
}

global $settingspoint;

$lang_admin[$settingspoint]['MENU_TITLE'] = 'META Etiketleri';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'META Etiket Yönetimi';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'META Etiket Seçenekleri';

$lang_admin[$settingspoint]['FIELD_META'] = 'META Etiketi';
$lang_admin[$settingspoint]['FIELD_META_RESOURCE-TYPE'] = 'Test';
$lang_admin[$settingspoint]['FIELD_META_DISTRIBUTION'] = 'Test';
$lang_admin[$settingspoint]['FIELD_META_AUTHOR'] = 'Typically the unqualified author\'s name.';
$lang_admin[$settingspoint]['FIELD_META_COPYRIGHT'] = 'Typically an unqualified copyright statement.';
$lang_admin[$settingspoint]['FIELD_META_KEYWORDS'] = 'Keywords used by search engines to index your document in addition to words from the title and document body. Typically used for synonyms and alternates of title words. Each keyword must be seperated by comma.';
$lang_admin[$settingspoint]['FIELD_META_DESCRIPTION'] = 'A short, plain language description of the document. Used by search engines to describe your document.';
$lang_admin[$settingspoint]['FIELD_META_ROBOTS'] = 'Controls Web robots<br />index,nofollow = prevents anything on the page from being indexed<br />noindex,follow = Robots may traverse this page but not index it<br />index,follow = the whole page is indexed and links are followed';
$lang_admin[$settingspoint]['FIELD_META_REVISIT-AFTER'] = 'This was a very important tag as it tells the search engine how often to spider your page. Due to abuse by search engine spammers, this particular tag is generally ignored by search engines.';
$lang_admin[$settingspoint]['FIELD_META_RATING'] = 'Used to indicate the rating of the site.<br />General = public content for all users<br />Mature = [not known]<br />Restricted = x rated content<br />14 years = suitable content for users above 14 years';
$lang_admin[$settingspoint]['FIELD_META_TITLE'] = 'Title of the web page. Use approx. 10 words which will be your major keywords. Search engines using the title tag like the keyword tag. Keep your focus on two or four keywords.';
$lang_admin[$settingspoint]['FIELD_META_DATE'] = 'Expiration date of the document. Essentially this will cause a document to be reloaded from the website after the date. Put a date in the past to disable caching of the document. Example: 2009-12-15T08:49:37+02:00';
$lang_admin[$settingspoint]['FIELD_META_AUDIENCE'] = 'Here you can specified the audience of your web site for example \'all\', \'Experts\', \'Women\', \'Men\' or similar.';
$lang_admin[$settingspoint]['FIELD_META_ABSTRACT'] = 'Gives a short summary of the description. The Meta Abstract is used primarily with academic papers. The content for this tag is usually 10 words or less.';
$lang_admin[$settingspoint]['FIELD_META_PAGE-TYPE'] = 'Type of page, used by some search engines. Not all pages need this.';
$lang_admin[$settingspoint]['FIELD_META_PAGE-TOPIC'] = 'Topic of the page, used by some search engines. Not all pages need this.';
$lang_admin[$settingspoint]['FIELD_META_PUBLISHER'] = 'The Meta Publisher tag is used to declare the name and version number of the publishing tool used to create the page. The Meta Publisher tag is the same as the Meta Generator tag.';

$lang_admin[$settingspoint]['CHECK_NAME_EXISTS'] = 'META Etiketi mevcut - başka bir tane girin';
$lang_admin[$settingspoint]['CHECK_NOT_VALID'] = 'No valid Input';
$lang_admin[$settingspoint]['CHECK_INSERT_FAILED'] = 'Insertion into database failed';

$lang_admin[$settingspoint]['IMG_DELETE_TITLE'] = 'META Etiketini SİL';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Input for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

?>