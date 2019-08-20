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
    die('Vous n\'avez pas acc&egrave;s &agrave; ce fichier directement...');
}

global $adminpoint;

$lang_admin[$adminpoint]['EM203'] = 'Error 203: The information contained in the entity header is not from the original site, but from third party server';
$lang_admin[$adminpoint]['EM204'] = 'Error 204: You have clicked a link without a target. It\'s a warning !!';
$lang_admin[$adminpoint]['EM205'] = 'Error 205: You sent a header we do not allow.';
$lang_admin[$adminpoint]['EM300'] = 'Error 300: The requested address couldn\'t be identified as unique.';
$lang_admin[$adminpoint]['EM301'] = 'Error 301: The requested address is moved permanently.';
$lang_admin[$adminpoint]['EM302'] = 'Error 302: The requested address is moved temporarily.';
$lang_admin[$adminpoint]['EM303'] = 'Error 303: The requested address is moved anywhere - but we do not follow';
$lang_admin[$adminpoint]['EM304'] = 'Error 304: We don\'t allow calls for modification time of an address on our server';
$lang_admin[$adminpoint]['EM400'] = 'Error 400: Bad request - there is a syntax error in the request, and it\'s denied';
$lang_admin[$adminpoint]['EM401'] = 'Error 401: The request header did not contain the necessary authentication codes. Access is denied';
$lang_admin[$adminpoint]['EM402'] = 'Error 402: To access this file, payment is required';
$lang_admin[$adminpoint]['EM403'] = 'Error 403: We cannot satisfy your request. Please try later.';
$lang_admin[$adminpoint]['EM404'] = 'Error 404: The requested address is not on this server. Maybe you have misspelled the URL ?';
$lang_admin[$adminpoint]['EM405'] = 'Error 405: The method you are using to access the file is not allowed';
$lang_admin[$adminpoint]['EM406'] = 'Error 406: Your client isn\'t configured to receive the requested address';
$lang_admin[$adminpoint]['EM407'] = 'Error 407: Your request must first be authorised before it can take place';
$lang_admin[$adminpoint]['EM408'] = 'Error 408: Request Timeout - Please try later';
$lang_admin[$adminpoint]['EM409'] = 'Error 409: Too many concurrent requests - Please try later';
$lang_admin[$adminpoint]['EM410'] = 'Error 410: The requested address is not available.';
$lang_admin[$adminpoint]['EM411'] = 'Error 411: Your request is missing some header informations';
$lang_admin[$adminpoint]['EM412'] = 'Error 412: Your client isn\'t configured to receive the requested information.';
$lang_admin[$adminpoint]['EM413'] = 'Error 413: The requested file is too big to process';
$lang_admin[$adminpoint]['EM414'] = 'Error 414: The requested address isn\'t in the right format for this server.';
$lang_admin[$adminpoint]['EM415'] = 'Error 415: The filetype of the request is not supported.';
$lang_admin[$adminpoint]['EM500'] = 'Error 500: Internal server error - please try later';
$lang_admin[$adminpoint]['EM501'] = 'Error 501: The request cannot be carried out by the server';
$lang_admin[$adminpoint]['EM502'] = 'Error 502: Bad Gateway - the server your\'re trying to reach is sending back errors.';
$lang_admin[$adminpoint]['EM503'] = 'Error 503: Temporarily Unavailable.';
$lang_admin[$adminpoint]['EM504'] = 'Error 504: The Gateway has timed out.';
$lang_admin[$adminpoint]['EM505'] = 'Error 505: The HTTP protocol you are asking for is not supported.';
$lang_admin[$adminpoint]['EMDATETIME'] = 'Date / Heure';
$lang_admin[$adminpoint]['EMHOME'] = 'Retour &agrave; la page d\'accueil';
$lang_admin[$adminpoint]['EMIP'] = 'IP Adresse';
$lang_admin[$adminpoint]['EMRECDATA'] = '<strong>NOTE:</strong> we have recorded the following data to track the problem.';
$lang_admin[$adminpoint]['EMREF'] = 'R&eacute;f&eacute;rant';
$lang_admin[$adminpoint]['EMSORRY'] = 'Nous sommes d&eacute;sol&eacute; pour tous les probl&egrave;mes';
$lang_admin[$adminpoint]['EMSORT'] = 'Trier les erreur';
$lang_admin[$adminpoint]['EMUNKNOWN'] = 'Erreur inconnu: Il s\'est produit une erreur que nous n\'avons pas pu reconna&Icirc;tre';
$lang_admin[$adminpoint]['EMURL'] = 'Erreur d\'URL';

// Error Manager v2.1 Admin:
$lang_admin[$adminpoint]['EALOGERRORS'] = 'Fichier d\'erreur dans la base de donn&eacute;es?';
$lang_admin[$adminpoint]['EASHOWIMAGE'] = 'Voir Image?';
$lang_admin[$adminpoint]['EASHOWINFOSAVED'] = 'Dire au visiteur que les information sont enregistr&eacute;es?<br />(Utile uniquement si \'Sauvegarde des erreurs dans la Base de Donn&eacute;es\' est actif)';
$lang_admin[$adminpoint]['EASHOWMODULBLOCKS'] = 'Voir les blocks?';
$lang_admin[$adminpoint]['EMABACK'] = 'Retour &agrave; l\'Administration  de la gestion des erreurs';
$lang_admin[$adminpoint]['EMABACKMAIN'] = 'Retour au Menu Principale d\'Administration';
$lang_admin[$adminpoint]['EMADATETIME'] = 'Date / Time';
$lang_admin[$adminpoint]['EMADEL'] = 'Effacer les erreurs';
$lang_admin[$adminpoint]['EMADELALL'] = 'Effacer tout';
$lang_admin[$adminpoint]['EMADELETED'] = 'L\'erreur est effac&eacute;e de la Base de donn&eacute;es';
$lang_admin[$adminpoint]['EMADELETEDALL'] = 'Toutes les erreurs sont effac&eacute;es de la Base de donn&eacute;es';
$lang_admin[$adminpoint]['EMAIP'] = 'IP Adresse';
$lang_admin[$adminpoint]['EMALIST'] = 'Les erreurs suivantes ont &eacute;t&eacute; trouv&eacute;es sur votre site';
$lang_admin[$adminpoint]['EMAREF'] = 'D\'ou vient l\'erreur';
$lang_admin[$adminpoint]['EMASORT'] = 'Trier les Erreurs';
$lang_admin[$adminpoint]['EMATITLE'] = 'Erreur';
$lang_admin[$adminpoint]['EMAURL'] = 'Erreur URL';
$lang_admin[$adminpoint]['EMCONFIG'] = 'R&eacute;glages';
$lang_admin[$adminpoint]['EMSHOWERRORS'] = 'Voir les Erreurs';
$lang_admin[$adminpoint]['ERROR_BLOCKS_BOTH'] = 'Tous les Blocks';
$lang_admin[$adminpoint]['ERROR_BLOCKS_LEFT'] = 'Blocks de Gauche';
$lang_admin[$adminpoint]['ERROR_BLOCKS_NONE'] = 'Aucun';
$lang_admin[$adminpoint]['ERROR_BLOCKS_RIGHT'] = 'Blocks de Droite';

$lang_admin[$adminpoint]['RESETCOUNTER'] = '(Mettre &agrave; z&eacute;ro le compteur)';

$lang_admin[$adminpoint]['SAVECHANGES'] = 'Sauvegarder les changements';

$lang_admin[$adminpoint]['TOTALERRORS'] = 'Nombre total d\'erreur sur votre site nuke';

?>