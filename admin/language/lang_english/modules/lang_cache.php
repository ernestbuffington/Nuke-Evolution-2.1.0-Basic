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

if (!defined('ADMIN_FILE')) {
    die('You can\'t access this file directly...');
}

global $adminpoint;

$lang_admin[$adminpoint]['CACHENOTALLOWED'] = 'You are not allowed to view this file!';
$lang_admin[$adminpoint]['CACHESAFEMODE'] = 'Safe mode is enabled on your server, cache will NOT function!';

$lang_admin[$adminpoint]['CACHE_BAD'] = 'Your cache is NOT chmodded!';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_FAIL'] = 'Category deletion failed';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_SUCC'] = 'Category deleted successfully';
$lang_admin[$adminpoint]['CACHE_CLEAR'] = 'Clear Cache';
$lang_admin[$adminpoint]['CACHE_CLEARED_FAIL'] = 'Cache failed to clear';
$lang_admin[$adminpoint]['CACHE_CLEARED_SUCC'] = 'Cache cleared successfully';
$lang_admin[$adminpoint]['CACHE_CLEARNOW'] = 'Clear Now';
$lang_admin[$adminpoint]['CACHE_DELETE'] = 'Delete';
$lang_admin[$adminpoint]['CACHE_DIR_STATUS'] = 'Cache Directory Status:';
$lang_admin[$adminpoint]['CACHE_DISABLED'] = 'Disabled';
$lang_admin[$adminpoint]['CACHE_ENABLED'] = 'Enabled';
$lang_admin[$adminpoint]['CACHE_ENABLE_HOW'] = 'To enable cache, set \$use_cache to \"1\" or \"2\" in config.php if it isn\'t already.';
$lang_admin[$adminpoint]['CACHE_FILEMODE'] = 'File Cache';
$lang_admin[$adminpoint]['CACHE_FILENAME'] = 'Filename';
$lang_admin[$adminpoint]['CACHE_FILESIZE'] = 'File Size';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_FAIL'] = 'File deletion failed';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_SUCC'] = 'File deleted successfully';
$lang_admin[$adminpoint]['CACHE_GOOD'] = 'Good';
$lang_admin[$adminpoint]['CACHE_HEADER'] = 'Cache :: Admin Panel';
$lang_admin[$adminpoint]['CACHE_HOWTOENABLE'] = 'How to enable?';
$lang_admin[$adminpoint]['CACHE_INVALID'] = 'Invalid Operation';
$lang_admin[$adminpoint]['CACHE_LASTMOD'] = 'Last Modified';
$lang_admin[$adminpoint]['CACHE_LAST_CLEARED'] = 'Cache last cleared:';
$lang_admin[$adminpoint]['CACHE_MODE'] = 'Cache Mode';
$lang_admin[$adminpoint]['CACHE_NO'] = 'No';
$lang_admin[$adminpoint]['CACHE_NUM_FILES'] = 'Number of cached items:';
$lang_admin[$adminpoint]['CACHE_OPTIONS'] = 'Options';
$lang_admin[$adminpoint]['CACHE_PREF_UPDATED_SUCC'] = 'Preferences updated succesfully';
$lang_admin[$adminpoint]['CACHE_RETURN'] = 'Return to Main Administration';
$lang_admin[$adminpoint]['CACHE_RETURNCACHE'] = 'Return to Cache Admin';
$lang_admin[$adminpoint]['CACHE_SIZE'] = 'Cache size:';
$lang_admin[$adminpoint]['CACHE_SQLMODE'] = 'SQL Cache';
$lang_admin[$adminpoint]['CACHE_STATUS'] = 'Cache Status:';
$lang_admin[$adminpoint]['CACHE_USER_CAN_CLEAR'] = 'User can clear cache:';
$lang_admin[$adminpoint]['CACHE_VIEW'] = 'View';
$lang_admin[$adminpoint]['CACHE_YES'] = 'Yes';

?>