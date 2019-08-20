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

$lang_admin[$adminpoint]['EM203'] = 'Error 203: The information contained in the entity header is not from the original site, but from third party server';
$lang_admin[$adminpoint]['EM204'] = 'Error 204: Warning !! You have clicked a link without a target!.';
$lang_admin[$adminpoint]['EM205'] = 'Error 205: You sent a header we do not allow.';
$lang_admin[$adminpoint]['EM300'] = 'Error 300: The requested address couldn\'t be identified as unique.';
$lang_admin[$adminpoint]['EM301'] = 'Error 301: The requested address is moved permanently.';
$lang_admin[$adminpoint]['EM302'] = 'Error 302: The requested address is moved temporarily.';
$lang_admin[$adminpoint]['EM303'] = 'Error 303: The requested address is moved somewhere - that we can not follow';
$lang_admin[$adminpoint]['EM304'] = 'Error 304: We don\'t allow calls for modifications to time of an address on our server';
$lang_admin[$adminpoint]['EM400'] = 'Error 400: Bad request - there is a syntax error in the request, and it\'s denied';
$lang_admin[$adminpoint]['EM401'] = 'Error 401: The request header did not contain the necessary authentication codes. Access is denied';
$lang_admin[$adminpoint]['EM402'] = 'Error 402: To access this file, payment is required';
$lang_admin[$adminpoint]['EM403'] = 'Error 403: We cannot satisfy your request. Please try again later.';
$lang_admin[$adminpoint]['EM404'] = 'Error 404: The requested address is not on this server. Maybe you have misspelled the URL ?';
$lang_admin[$adminpoint]['EM405'] = 'Error 405: The method you are using to access the file is not allowed';
$lang_admin[$adminpoint]['EM406'] = 'Error 406: Your client isn\'t configured to receive the requested address';
$lang_admin[$adminpoint]['EM407'] = 'Error 407: Your request must first be authorized before it can take place';
$lang_admin[$adminpoint]['EM408'] = 'Error 408: Request Timeout - Please try later';
$lang_admin[$adminpoint]['EM409'] = 'Error 409: Too many concurrent requests - Please try again later';
$lang_admin[$adminpoint]['EM410'] = 'Error 410: The requested address is not available.';
$lang_admin[$adminpoint]['EM411'] = 'Error 411: Your request is missing some header information';
$lang_admin[$adminpoint]['EM412'] = 'Error 412: Your client isn\'t configured to receive the requested information.';
$lang_admin[$adminpoint]['EM413'] = 'Error 413: The requested file is too large to process';
$lang_admin[$adminpoint]['EM414'] = 'Error 414: The requested address isn\'t in the right format for this server.';
$lang_admin[$adminpoint]['EM415'] = 'Error 415: The file type of the request is not supported.';
$lang_admin[$adminpoint]['EM500'] = 'Error 500: Internal server error - please try again later';
$lang_admin[$adminpoint]['EM501'] = 'Error 501: The request cannot be carried out by the server';
$lang_admin[$adminpoint]['EM502'] = 'Error 502: Bad Gateway - the server your\'re trying to reach is sending back errors.';
$lang_admin[$adminpoint]['EM503'] = 'Error 503: Temporarily Unavailable.';
$lang_admin[$adminpoint]['EM504'] = 'Error 504: The Gateway has timed out.';
$lang_admin[$adminpoint]['EM505'] = 'Error 505: The HTTP protocol you are asking for is not supported.';
$lang_admin[$adminpoint]['EMDATETIME'] = 'Date / Time';
$lang_admin[$adminpoint]['EMHOME'] = 'Back to Homepage';
$lang_admin[$adminpoint]['EMIP'] = 'IP Address';
$lang_admin[$adminpoint]['EMRECDATA'] = '<strong>NOTE:</strong> we have recorded the following data to track the problem.';
$lang_admin[$adminpoint]['EMREF'] = 'Referrer';
$lang_admin[$adminpoint]['EMSORRY'] = 'We are sorry for any problems';
$lang_admin[$adminpoint]['EMSORT'] = 'Sort Error';
$lang_admin[$adminpoint]['EMUNKNOWN'] = 'Error unknown: An error has occurred that we could not recognize';
$lang_admin[$adminpoint]['EMURL'] = 'Error URL';

// Error Manager v2.1 Admin:
$lang_admin[$adminpoint]['EALOGERRORS'] = 'Log the errors in the database?';
$lang_admin[$adminpoint]['EASHOWIMAGE'] = 'Show Image?';
$lang_admin[$adminpoint]['EASHOWINFOSAVED'] = 'Tell the visitor that the info is logged?<br />(only useful if \'Log the Errors in DB\' is ON)';
$lang_admin[$adminpoint]['EASHOWMODULBLOCKS'] = 'Show blocks??';
$lang_admin[$adminpoint]['EMABACK'] = 'Back to Error Management Administration';
$lang_admin[$adminpoint]['EMABACKMAIN'] = 'Return to Main Administration';
$lang_admin[$adminpoint]['EMADATETIME'] = 'Date / Time';
$lang_admin[$adminpoint]['EMADEL'] = 'Delete Error';
$lang_admin[$adminpoint]['EMADELALL'] = 'Delete ALL';
$lang_admin[$adminpoint]['EMADELETED'] = 'The Error is deleted from the Database';
$lang_admin[$adminpoint]['EMADELETEDALL'] = 'All Errors are deleted from the Database';
$lang_admin[$adminpoint]['EMAIP'] = 'IP Address';
$lang_admin[$adminpoint]['EMALIST'] = 'The following Errors found place at your site';
$lang_admin[$adminpoint]['EMAREF'] = 'Referrer';
$lang_admin[$adminpoint]['EMASORT'] = 'Sort Error';
$lang_admin[$adminpoint]['EMATITLE'] = 'Error';
$lang_admin[$adminpoint]['EMAURL'] = 'Error URL';
$lang_admin[$adminpoint]['EMCONFIG'] = 'Settings';
$lang_admin[$adminpoint]['EMSHOWERRORS'] = 'Show the Errors';
$lang_admin[$adminpoint]['ERROR_BLOCKS_BOTH'] = 'Both Blocks';
$lang_admin[$adminpoint]['ERROR_BLOCKS_LEFT'] = 'Left Blocks';
$lang_admin[$adminpoint]['ERROR_BLOCKS_NONE'] = 'None';
$lang_admin[$adminpoint]['ERROR_BLOCKS_RIGHT'] = 'Right Blocks';

$lang_admin[$adminpoint]['RESETCOUNTER'] = '(Reset counter)';

$lang_admin[$adminpoint]['SAVECHANGES'] = 'Save Changes';

$lang_admin[$adminpoint]['TOTALERRORS'] = 'Total number of errors on you EVO site';

?>