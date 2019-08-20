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
/*----[ Welcome! ] ----------------------------------------------------
|           Welcome to Nuke-Evolution, an advanced content             |
|                 management system based on PHP-Nuke                  |
----------------------------------------------------------------------*/

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

/*----[ $dbhost ] -----------------------------------------------------
| Your database host, normally 'localhost'                             |
|                                                                      |
| Default: localhost                                                   |
----------------------------------------------------------------------*/
$dbhost = '%dbhost%';
/*----[ $dbname ] -----------------------------------------------------
| The name of your database that will hold Evo's tables                |
|                                                                      |
| Default: xxx_evo                                                     |
----------------------------------------------------------------------*/
$dbname = '%dbname%';

/*----[ $dbuname ] ----------------------------------------------------
| The username linked to your database, must have correct permissions  |
|                                                                      |
| Default: xxx_evo                                                     |
----------------------------------------------------------------------*/
$dbuname = '%dbuname%';

/*----[ $dbpass ] -----------------------------------------------------
| The password associated with your db usersname                       |
|                                                                      |
| Default: null                                                        |
----------------------------------------------------------------------*/
$dbpass = '%dbpass%';

/*----[ $dbtype ] -----------------------------------------------------
| The type of SQL server you prefer to use                             |
|                                                                      |
| Choose from the following (case-sensitive):                          |
|    - mysql (4.x or later)                                            |
|    - mysqli (PHP must be compiled with "System Mysql")               |
|                                                                      |
| Default: mysql                                                       |
----------------------------------------------------------------------*/
$dbtype = '%dbtype%';

/*----[ $prefix ] -----------------------------------------------------
| The prefix for your Nuke-Evolution tables                            |
|                                                                      |
| Default: evo                                                         |
----------------------------------------------------------------------*/
$prefix = '%prefix%';

/*----[ $user_prefix ] ------------------------------------------------
| The prefix for your Nuke-Evolution user-related tables               |
| Do not change this unless it is really needed                        |
|                                                                      |
| Default: evo                                                         |
----------------------------------------------------------------------*/
$user_prefix = '%user_prefix%';

/*----[ $admin_file ] -------------------------------------------------
| The filename of your Admin File                                      |
|                                                                      |
| If you change this to something other than it's default value, you   |
| must also rename the file called 'admin.php' to the new value you    |
| assigned to this variable                                            |
|                                                                      |
| Default: admin                                                       |
----------------------------------------------------------------------*/
$admin_file = 'admin';

/*----[ $directory_mode ] ---------------------------------------------
| permissions - by default, Evo will create new folders with the       |
| permissions set with the following settings.  NOTE: do NOT use       |
| quotes around this value or it will not work.                        |
| Examples:                                                            |
| Server API = Apache = 0777                                           |
| Server API = CGI = 0755                                              |
----------------------------------------------------------------------*/
$directory_mode = 0777;

/*----[ $file_mode ] --------------------------------------------------
| file permissions mode - by default, Evo will create all new files    |
| with the permissions that are provided here.  NOTE: do NOT use any   |
| quotes (single or double) around this value or it will not work.     |
| Examples:                                                            |
| Server API = Apache = 0666                                           |
| Server API = CGI = 0644                                              |
----------------------------------------------------------------------*/
$file_mode = 0666;

/*----[ $debug ] -------------------------------------------------- ---
| Debugging Status of your website                                     |
|                                                                      |
| If you want errors being shown, set this to true.                    |
| It will also display evo notices at the footer, but that's visible   |
| for admins only.                                                     |
| If you dont want any errors being shown, set this to false.          |
|                                                                      |
| Default: true                                                        |
----------------------------------------------------------------------*/
$debug = true;

/*----[ $use_cache ] --------------------------------------------------
| Use caching of database fetched data                                 |
|                                                                      |
| You can choose between these options:                                |
|   0: Cache Off                                                       |
|   1: File Cache                                                      |
|       - Faster load, more server usage                               |
|         We recommend you use SQL cache if you have                   |
|         problems with the File Cache                                 |
|   2: SQL Cache                                                       |
|       - One more query per page, less server usage                   |
|                                                                      |
| Default: 1 (File Cache)                                              |
----------------------------------------------------------------------*/
$use_cache = 1;

/*----[ $persistency ] ------------------------------------------------
| Allow persistent database connections                                |
|                                                                      |
| true = On                                                            |
| false = Off  (Default)                                               |
----------------------------------------------------------------------*/
$persistency = false;

/*----[ Default Constants ] -------------------------------------------
| This Constants normally are set by Installer.                        |
| They only have to be changed if this file was installed manually     |
|                                                                      |
| KERNEL_STATUS_SAFEMODE          = 1/0 (by Default 0 = false)         |
| KERNEL_STATUS_OPENBASEDIR       = 1/0 (by Default 0 = false)         |
| KERNEL_STATUS_SESSIONSUPPORT    = 1/0 (by Default 1 = true)          |
| KERNEL_STATUS_CURLSUPPORT       = 1/0 (by Default 1 = true)          |
| KERNEL_STATUS_FILEUPLOAD        = 1/0 (by Default 1 = true)          |
| KERNEL_STATUS_FILEUPLOADMAXSIZE = Size in MB (by Default 20)         |
| KERNEL_STATUS_POSTMAXSIZE       = Size in MB (by Default 12)         |
| KERNEL_STATUS_GDSUPPORT         = 1/0 (by Default 1 = true)          |
| KERNEL_STATUS_MAXMEMORY         = Size in MB (by Default 32)         |
----------------------------------------------------------------------*/
define ('KERNEL_STATUS_SAFEMODE', '%safe_mode%');
define ('KERNEL_STATUS_OPENBASEDIR', '%open_basedir%');
define ('KERNEL_STATUS_SESSIONSUPPORT', '%session_support%');
define ('KERNEL_STATUS_CURLSUPPORT', '%curl_support%');
define ('KERNEL_STATUS_FILEUPLOAD', '%file_upload%');
define ('KERNEL_STATUS_FILEUPLOADMAXSIZE', '%file_upload_maxsize%');
define ('KERNEL_STATUS_POSTMAXSIZE', '%post_maxsize%');
define ('KERNEL_STATUS_GDSUPPORT', '%gd_support%');
define ('KERNEL_STATUS_MAXMEMORY', '%max_memory%');

/**********************************************************************/
/* You have finished configuration of your site. Now you can change   */
/* all you want in the Administration Section. To enter just launch   */
/* your web browser pointing to http://yourdomain.com/admin.php       */
/* (or whatever you have setup in $admin_file)                        */
/*                                                                    */
/* Remember to go to the Settings section where you can configure     */
/* your new site.                                                     */
/*                                                                    */
/* Congratulations! Now you have the webs best portal installed!      */
/* Thanks for choosing Nuke- Evolution: The Future of the Web!        */
/**********************************************************************/

?>