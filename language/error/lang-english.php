<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		#$#BASE
 Nuke-Evo Version       :		#$#VER
 Nuke-Evo Build         :		#$#BUILD
 Nuke-Evo Patch         :		#$#PATCH
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		#$#DATE

 Copyright (c) 2007 by The Nuke Evolution Development Team
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

if(!defined('NUKE_EVO')) { die('You can\'t access this file directly...'); }

// Error Manager v2.1
$lang_new[$module_name]['EM203'] = 'Error 203: The information contained in the entity header is not from the original site, but from third party server';
$lang_new[$module_name]['EM204'] = 'Error 204: You have clicked a link without a target. It\'s a warning !!';
$lang_new[$module_name]['EM205'] = 'Error 205: You sent a header we do not allow.';
$lang_new[$module_name]['EM300'] = 'Error 300: The requested address couldn\'t be identified as unique.';
$lang_new[$module_name]['EM301'] = 'Error 301: The requested address is moved permanently.';
$lang_new[$module_name]['EM302'] = 'Error 302: The requested address is moved temporarily.';
$lang_new[$module_name]['EM303'] = 'Error 303: The requested address is moved anywhere - but we do not follow';
$lang_new[$module_name]['EM304'] = 'Error 304: We don\'t allow calls for modification time of an address on our server';
$lang_new[$module_name]['EM400'] = 'Error 400: Bad request - there is a syntax error in the request, and it\'s denied';
$lang_new[$module_name]['EM401'] = 'Error 401: The request header did not contain the necessary authentication codes. Access is denied';
$lang_new[$module_name]['EM402'] = 'Error 402: To access this file, payment is required';
$lang_new[$module_name]['EM403'] = 'Error 403: We cannot satisfy your request. Please try later.';
$lang_new[$module_name]['EM404'] = 'Error 404: The requested address is not on this server. Maybe you have misspelled the URL ?';
$lang_new[$module_name]['EM405'] = 'Error 405: The method you are using to access the file is not allowed';
$lang_new[$module_name]['EM406'] = 'Error 406: Your client isn\'t configured to receive the requested address';
$lang_new[$module_name]['EM407'] = 'Error 407: Your request must first be authorized before it can take place';
$lang_new[$module_name]['EM408'] = 'Error 408: Request Timeout - Please try later';
$lang_new[$module_name]['EM409'] = 'Error 409: Too many concurrent requests - Please try later';
$lang_new[$module_name]['EM410'] = 'Error 410: The requested address is not available.';
$lang_new[$module_name]['EM411'] = 'Error 411: Your request is missing some header information';
$lang_new[$module_name]['EM412'] = 'Error 412: Your client isn\'t configured to receive the requested information.';
$lang_new[$module_name]['EM413'] = 'Error 413: The requested file is too big to process';
$lang_new[$module_name]['EM414'] = 'Error 414: The requested address isn\'t in the right format for this server.';
$lang_new[$module_name]['EM415'] = 'Error 415: The file type of the request is not supported.';
$lang_new[$module_name]['EM500'] = 'Error 500: Internal server error - please try later';
$lang_new[$module_name]['EM501'] = 'Error 501: The request cannot be carried out by the server';
$lang_new[$module_name]['EM502'] = 'Error 502: Bad Gateway - the server your\'re trying to reach is sending back errors.';
$lang_new[$module_name]['EM503'] = 'Error 503: Temporarily Unavailable.';
$lang_new[$module_name]['EM504'] = 'Error 504: The Gateway has timed out.';
$lang_new[$module_name]['EM505'] = 'Error 505: The HTTP protocol you are asking for is not supported.';
$lang_new[$module_name]['EMUNKNOWN'] = 'An error occurred that we couldn\'t recognize';
$lang_new[$module_name]['EMHOME'] = 'Back to Homepage';
$lang_new[$module_name]['EMSORRY'] = 'We are sorry for any problems';
$lang_new[$module_name]['EMRECDATA'] = '<strong>NOTE:</strong> We have recorded the following data to track the problem.';
$lang_new[$module_name]['EMDATETIME'] = 'Date / Time';
$lang_new[$module_name]['EMSORT'] = 'Sort Error';
$lang_new[$module_name]['EMREF'] = 'Referrer';
$lang_new[$module_name]['EMIP'] = 'IP-Address';
$lang_new[$module_name]['EMURL'] = 'Error URL';
// Error Manager v2.1 Admin:
$lang_new[$module_name]['EMATITLE'] = 'Error';
$lang_new[$module_name]['EMABACKMAIN'] = 'Return to Main Administration';
$lang_new[$module_name]['EMALIST'] = 'The following Errors found place at your site';
$lang_new[$module_name]['EMADELALL'] = 'Delete ALL';
$lang_new[$module_name]['EMADEL'] = 'Delete Error';
$lang_new[$module_name]['EMADELETED'] = 'The Error is deleted from the Database';
$lang_new[$module_name]['EMABACK'] = 'Back to Error Management Administration';
$lang_new[$module_name]['EMADELETEDALL'] = 'All Errors are deleted from the Database';
$lang_new[$module_name]['EMCONFIG'] = 'Settings';
$lang_new[$module_name]['EMSHOWERRORS'] = 'Show the Errors';
$lang_new[$module_name]['EALOGERRORS'] = 'Log the errors in the database?';
$lang_new[$module_name]['EASHOWIMAGE'] = 'Show Image?';
$lang_new[$module_name]['EASHOWMODULBLOCKS'] = 'Show blocks??';
$lang_new[$module_name]['EASHOWINFOSAVED'] = 'Tell the visitor that the info is logged?<br />(only useful if \'Log the Errors in DB\' is ON)';
$lang_new[$module_name]['TOTALERRORS'] = 'Total number of errors on you nuke site';
$lang_new[$module_name]['RESETCOUNTER'] = '(Reset counter)';
$lang_new[$module_name]['EMADATETIME'] = 'Date / Time';
$lang_new[$module_name]['EMASORT'] = 'Sort Error';
$lang_new[$module_name]['EMAREF'] = 'Referrer';
$lang_new[$module_name]['EMAIP'] = 'IP-Address';
$lang_new[$module_name]['EMAURL'] = 'Error URL';
$lang_new[$module_name]['SAVECHANGES'] = 'Save Changes';

?>