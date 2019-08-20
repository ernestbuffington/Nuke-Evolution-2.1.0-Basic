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
exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

global $adminpoint;

$lang_admin[$adminpoint]['ADMIN_GO_MAIN'] = 'Back to Main Administration';
$lang_admin[$adminpoint]['ADMIN_HEADER'] = 'Database Administration';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTEXT'] = 'Message from Database';
$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTYPE'] = 'Message Type';
$lang_admin[$adminpoint]['ANALYZE_HEADER_NAME'] = 'Name of the Table';
$lang_admin[$adminpoint]['ANALYZE_HEADER_OP'] = 'Operation';

$lang_admin[$adminpoint]['BACKUP_HEADER_BACKUP'] = 'Backup?';
$lang_admin[$adminpoint]['BACKUP_HEADER_NAME'] = 'Name of the Table';
$lang_admin[$adminpoint]['BACKUP_INFO_MSG'] = 'All Tables shown here are Tables with content.';
$lang_admin[$adminpoint]['BACKUP_SUBMIT'] = 'Backup Table optimization';
$lang_admin[$adminpoint]['BACKUP_TABLES_BACKUP_MSG'] = 'A Backup of these Tables has been created';
$lang_admin[$adminpoint]['BACKUP_TABLES_CONFIRM_MSG']= 'Do you want to backup these tables?';

$lang_admin[$adminpoint]['CHECK_ALL'] = 'Check all';

$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] = 'We have received no information from the Database - usually we get this error because your Database user doesn\'t have the correct privileges.';
$lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT'] = 'You have no access rights for the Database to run Statistics';
$lang_admin[$adminpoint]['DATABASE_QUERY_RESULT'] = 'Result of the database request';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_ERROR'] = 'Error';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_INFO'] = 'Information';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_OP_ANALYZE'] = 'Analyze';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_STATUS'] = 'Status';
$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_WARNING'] = 'Warning';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPACT'] = 'Compact';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPRESSED'] = 'Compressed';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_DYNAMIC'] = 'Dynamic';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_FIXED'] = 'Fix';
$lang_admin[$adminpoint]['DB_TABLE_TYPE_REDUNDANT'] = 'Redundant';
$lang_admin[$adminpoint]['DELETE_HEADER_DELETE'] = 'Delete ?';
$lang_admin[$adminpoint]['DELETE_HEADER_NAME'] = 'Name of the Table';
$lang_admin[$adminpoint]['DELETE_SUBMIT'] = 'Confirm Table delete';
$lang_admin[$adminpoint]['DELETE_TABLES_CONFIRM_MSG']= 'Do you want to delete these Tables?';
$lang_admin[$adminpoint]['DELETE_TABLES_DELETED_MSG']= 'The Tables were deleted';

$lang_admin[$adminpoint]['FILES_QUERY_NO_RESULT'] = 'There are no Backup files';

$lang_admin[$adminpoint]['KB'] = 'KB';

$lang_admin[$adminpoint]['MAIN_HEADER'] = 'Database Administration';
$lang_admin[$adminpoint]['MB'] = 'MB';

$lang_admin[$adminpoint]['NONE'] = 'None';

$lang_admin[$adminpoint]['OPTIMIZE_HEADER_NAME'] = 'Name of the Table';
$lang_admin[$adminpoint]['OPTIMIZE_HEADER_OPTIMIZE'] = 'Optimize?';
$lang_admin[$adminpoint]['OPTIMIZE_SUBMIT'] = 'Confirm Table optimization';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_CONFIRM_MSG']= 'Do you want to optimize these Tables?';
$lang_admin[$adminpoint]['OPTIMIZE_TABLES_OPTIMIZED_MSG']= 'The Tables were optimized';

$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_DELETE'] = 'Delete File';
$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_VIEW'] = 'View File';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_BACKUP'] = 'Action?';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_CREATED'] = 'Backup created on';
$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_NAME'] = 'Name of the file';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_FILE'] = 'Backup File';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_MSG'] = 'All files shown are stored in includes/cache directory';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_ROWS'] = 'Rows inside Backup';
$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_TABLES'] = 'Tables inside Backup';
$lang_admin[$adminpoint]['SHOW_BACKUP_SUBMIT'] = 'Start Action';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_SIZE'] = 'Size of the Database';
$lang_admin[$adminpoint]['STATISTICS_DATABASE_TABLES'] = 'Number of Tables inside the Database';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COLLATION']= 'Collation';
$lang_admin[$adminpoint]['STATISTICS_HEADER_COMMENT']= 'Comment';
$lang_admin[$adminpoint]['STATISTICS_HEADER_FORMAT'] = 'Format';
$lang_admin[$adminpoint]['STATISTICS_HEADER_INCREMENT']= 'Next Increment';
$lang_admin[$adminpoint]['STATISTICS_HEADER_MAXSIZE']= 'Maximum allowed Table size';
$lang_admin[$adminpoint]['STATISTICS_HEADER_NAME'] = 'Table name';
$lang_admin[$adminpoint]['STATISTICS_HEADER_ROWS'] = 'Counted Rows';
$lang_admin[$adminpoint]['STATISTICS_HEADER_SIZE'] = 'Size of Table';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TIMESTAMPS']= 'created on<br/>last changed on<br/>last checked on';
$lang_admin[$adminpoint]['STATISTICS_HEADER_TYPE'] = 'Type';
$lang_admin[$adminpoint]['SWITCH_ALL'] = 'Switch all';

$lang_admin[$adminpoint]['TITLE_ANALYZE_DB'] = 'Analyze Database';
$lang_admin[$adminpoint]['TITLE_OPTIMIZE_DB'] = 'Optimize Database';
$lang_admin[$adminpoint]['TITLE_SHOW_STATISTICS'] = 'Show Statistics';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP'] = 'Backup Tables';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUPED'] = 'Backup of Tables created';
$lang_admin[$adminpoint]['TITLE_TABLES_BACKUP_SHOW'] = 'Show Backup\'s';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETE'] = 'Delete Tables';
$lang_admin[$adminpoint]['TITLE_TABLES_DELETED'] = 'Tables deleted';
$lang_admin[$adminpoint]['TITLE_TABLES_OPTIMIZED'] = 'Database optimized';
$lang_admin[$adminpoint]['TITLE_TABLES_REPAIR'] = 'Repair Tables';

$lang_admin[$adminpoint]['UNCHECK_ALL'] = 'Uncheck all';

?>