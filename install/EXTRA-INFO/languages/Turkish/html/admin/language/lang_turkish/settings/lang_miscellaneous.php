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

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Gelişmiş Ayarlar';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Gelişmiş Web Sitesi Ayarları';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Gelişmiş Seçenekler';

$lang_admin[$settingspoint]['FIELD_HTTPREF_ON'] = 'Save references to your Website (HTTPReferer)';
$lang_admin[$settingspoint]['FIELD_HTTPREF_ON_HELP'] = 'If set to yes, references to your website are saved in the database and shown in the referer block and referer administration. This function may slow down the website generation.';
$lang_admin[$settingspoint]['FIELD_HTTPREF_MAX'] = 'How many references should be stored';
$lang_admin[$settingspoint]['FIELD_HTTPREF_MAX_HELP'] = 'You can set the amount of referers stored in the database. Default is 1000. Do not choose a much higher value.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS'] = 'Activate Comments in Surveys';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_POLLS_HELP'] = 'With this setting you can choose if users are able to write comments to your surveys.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE'] = 'Activate Comments in Stories';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COMMENTS_ARTICLE_HELP'] = 'With this setting you can choose if users are able to write comments to your news.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES'] = 'Activate individual RSS-Feeds for registered Users (Headlines)';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_HEADLINES_HELP'] = 'Defines if registered useres are allowed to set their individual RSS feed (headline) for their profile.'; 
$lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL'] = 'Activate SSL-Access for Administrators';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_ADMINSSL_HELP'] = 'Activates the Secured Socket Layer protocol for administrators. Note that SSL must be installed and activated on the used server to make use of this function.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT'] = 'Count database queries';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_QUERIESCOUNT_HELP'] = 'Activates the count of database queries and shows the result in the footer of the website.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE'] = 'Activate User- and Groupcolors';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLORSUSE_HELP'] = 'With this setting you can activate or deactivate the function to show user and group colors.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN'] = 'Users must be logged in before they can act';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_USERMUSTLOGIN_HELP'] = 'With this setting users will be forced to log in before they are able to perform any activity.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS'] = 'Activate Advertising';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_BANNERS_HELP'] = 'With this setting it is possible to enable/disable banner advertising on your website.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS'] = 'Activate Collapsing Blocks';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_COLLAPSE_BLOCKS_HELP'] = 'With this setting it is possible to activate/deactivate the collapsible blocks feature.';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN'] = 'Should Blocks be closed on starting sessions';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_OPEN_HELP'] = 'Set this option to YES, if you would like to show blocks expanded when a new user session is started. Set this option to NO, if you would like to show blocks contacted by default.';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE'] = 'Type of Symbol used for collapsing feature';
$lang_admin[$settingspoint]['FIELD_COLLAPSE_BLOCKS_TYPE_HELP'] = 'Choose the icon type if you want to show plus/minus signs for collapsing/expanding blocks and TITLE for collapsing/expanding block by clicking the title.'; 
$lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME'] = 'Time to refresh Block-Caching';
$lang_admin[$settingspoint]['FIELD_BLOCK_CACHETIME_HELP'] = 'The block cache will be refreshed after the chosen time.';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP'] = 'Activate translation of PHP-Links to HTML-Links (LazyTap)';
$lang_admin[$settingspoint]['FIELD_ACTIVATE_LAZYTAP_HELP'] = 'Make your choice to active easy readable links. To make use of this function, the file evo.htaccess located in the root of your installation must be renamed to .htaccess';
$lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS'] = 'To activate Google Analytics, you have to add here your Google-Code';
$lang_admin[$settingspoint]['FIELD_GOOGLE_ANALYTICS_HELP'] = 'This should be your Google Analytics Code which is given from the Google Analytics website when you are registered for this service. The Google Analytics Code should have a similar syntax like UA-xxxxxx.';
$lang_admin[$settingspoint]['FIELD_TEXTEDITORS'] = 'Which Texteditor should be used';
$lang_admin[$settingspoint]['FIELD_TEXTEDITORS_HELP'] = 'Choose the texteditor for text input fields. A texteditor must be installed in order to change this option from BBCode to a different WYSIWYG editor. This setting has no effect for the forums, as a special BBCode editor is build in the forums area.';

$lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_ICON'] = 'Artı/Eksi Sembolü';
$lang_admin[$settingspoint]['OPTION_COLLAPSE_BLOCKS_TITLE'] = 'Başlık';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_DEACTIVATED'] = 'Önbellek Devredışı';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_MINUTES'] = 'Dakika';
$lang_admin[$settingspoint]['OPTION_BLOCK_CACHETIME_HOURS'] = 'Saat';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_DEACTIVATED'] = 'Devredışı';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_BOTS'] = 'Sadece Botlar';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_ALL'] = 'Herkes';
$lang_admin[$settingspoint]['OPTION_LAZYTAP_ADMINBOTS'] = 'Sadece Botlar ve Yöneticiler';
$lang_admin[$settingspoint]['OPTION_TEXTEDITOR_NONE'] = 'Yok';

$lang_admin[$settingspoint]['INFO_ACTIVATE_ADMINSSL'] = 'SSL must be activated on our Server';
$lang_admin[$settingspoint]['INFO_ACTIVATE_BANNERS'] = 'Shows Banners created in Advertising Modul';
$lang_admin[$settingspoint]['INFO_DEACTIVATED_LAZYTAP'] = 'Your LazyTap is deactivated:';
$lang_admin[$settingspoint]['INFO_TEXTEDITORS'] = 'not valid for Forums';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Kaydet';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Geri Dön';

// SexyTooltips
$lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_LAYOUT'] = 'You can choose many layouts. Change the frame and backgroung of your tooltip with only a few clicks.';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_MOUSECLICK'] = 'On Mouse Click';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_MOUSEOVER'] = 'On Mouse Over';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_POPUP'] = 'ToolTips PopUp';
$lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_POPUP'] = 'You can choose the way Tooltips pops up.';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_AUTO'] = 'Auto';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_TR'] = 'Top Right';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_TL'] = 'Top Left';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_BR'] = 'Bottom Right';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_BL'] = 'Bottom Left';
$lang_admin[$settingspoint]['SEXY_TOOLTIPS_MODE'] = 'ToolTips Mode';
$lang_admin[$settingspoint]['HELP_SEXY_TOOLTIPS_MODE'] ='You can choose the position that you want Tooltips to appear.'
// done
?>