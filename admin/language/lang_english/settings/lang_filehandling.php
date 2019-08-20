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
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Filehandling';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Filehandling Settings';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'FTP Settings';
$lang_admin[$settingspoint]['FIELD_FTPHOST'] = 'URL for FTP Access';
$lang_admin[$settingspoint]['FIELD_FTPHOST_HELP'] = 'The URL for accessing your webserver by FTP.<br />Normally you have to insert here the same adress as you did for your FTP program';
$lang_admin[$settingspoint]['FIELD_FTPPORT'] = 'FTP Port';
$lang_admin[$settingspoint]['FIELD_FTPPORT_HELP'] = 'The Port used from your webserver whereon the FTP Service is runnung.<br />Normally you have to insert here the same port as you did for your FTP program';
$lang_admin[$settingspoint]['FIELD_FTPPATH'] = 'Path to website directory';
$lang_admin[$settingspoint]['FIELD_FTPPATH_HELP'] = 'The Path to your website after you logged in by FTP.';
$lang_admin[$settingspoint]['FIELD_FTPUSER'] = 'FTP User';
$lang_admin[$settingspoint]['FIELD_FTPUSER_HELP'] = 'The Username for FTP Access.<br />You should insert here the same name you use for your FTP program.';
$lang_admin[$settingspoint]['FIELD_FTPPWD'] = 'FTP Password';
$lang_admin[$settingspoint]['FIELD_FTPPWD_HELP'] = 'The Password for the User to have FTP Access.<br />You should insert here the same password you used for your FTP program.';
$lang_admin[$settingspoint]['FIELD_DIRECTORY_MODE'] = 'Directory Permissions';
$lang_admin[$settingspoint]['FIELD_DIRECTORY_MODE_HELP'] = 'Standard Directory Permissions.<br />Your Input here will overwrite the settings made in config.php.<br />Normal permissions for a directory is 755 which means: read + write + executing permissions for owner of the directory; read + execute permissions for group and guests.';
$lang_admin[$settingspoint]['FIELD_FILE_MODE'] = 'File Permissions';
$lang_admin[$settingspoint]['FIELD_FILE_MODE_HELP'] = 'Standard File Permissions.<br />Your Input here will overwrite the settings made in config.php.<br />Normal permissions for a file is 644 which means: read + write permissions for owner of the file; only read permissions for group and guests.';

$lang_admin[$settingspoint]['CHECK_ERROR_NOConnection'] = 'The settings made are false. We couldn\'t establish a valid ftp connection to the specified server';

$lang_admin[$settingspoint]['FIELD_BREAK_FILESETTINGS'] = 'Permissions';
$lang_admin[$settingspoint]['FIELD_NONE'] = 'No Inputfield for '.$settingspoint.' available';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Save';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Return';

?>