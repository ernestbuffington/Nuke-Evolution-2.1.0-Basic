<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

// Error Manager v2.1
$lang_new[$module_name]['EM203'] = 'Erreur 203: The information contained in the entity header is not from the original site, but from third party server';
$lang_new[$module_name]['EM204'] = 'Erreur 204: You have clicked a link without a target. It\'s a warning !!';
$lang_new[$module_name]['EM205'] = 'Erreur 205: You sent a header we do not allow.';
$lang_new[$module_name]['EM300'] = 'Erreur 300: The requested address couldn\'t be identified as unique.';
$lang_new[$module_name]['EM301'] = 'Erreur 301: The requested address is moved permanently.';
$lang_new[$module_name]['EM302'] = 'Erreur 302: The requested address is moved temporarily.';
$lang_new[$module_name]['EM303'] = 'Erreur 303: The requested address is moved anywhere - but we do not follow';
$lang_new[$module_name]['EM304'] = 'Erreur 304: We don\'t allow calls for modification time of an address on our server';
$lang_new[$module_name]['EM400'] = 'Erreur 400: Bad request - there is a syntax error in the request, and it\'s denied';
$lang_new[$module_name]['EM401'] = 'Erreur 401: Acces non autoris&Eacute;!';
$lang_new[$module_name]['EM402'] = 'Erreur 402: To access this file, payment is required';
$lang_new[$module_name]['EM403'] = 'Erreur 403: We cannot satisfy your request. Please try later.';
$lang_new[$module_name]['EM404'] = 'Erreur 404: The requested address is not on this server. Maybe you have misspelled the URL ?';
$lang_new[$module_name]['EM405'] = 'Erreur 405: The method you are using to access the file is not allowed';
$lang_new[$module_name]['EM406'] = 'Erreur 406: Your client isn\'t configured to receive the requested address';
$lang_new[$module_name]['EM407'] = 'Erreur 407: Your request must first be authorised before it can take place';
$lang_new[$module_name]['EM408'] = 'Erreur 408: Request Timeout - Please try later';
$lang_new[$module_name]['EM409'] = 'Erreur 409: Too many concurrent requests - Please try later';
$lang_new[$module_name]['EM410'] = 'Erreur 410: The requested address is not available.';
$lang_new[$module_name]['EM411'] = 'Erreur 411: Your request is missing some header informations';
$lang_new[$module_name]['EM412'] = 'Erreur 412: Your client isn\'t configured to receive the requested information.';
$lang_new[$module_name]['EM413'] = 'Erreur 413: The requested file is too big to process';
$lang_new[$module_name]['EM414'] = 'Erreur 414: The requested address isn\'t in the right format for this server.';
$lang_new[$module_name]['EM415'] = 'Erreur 415: The filetype of the request is not supported.';
$lang_new[$module_name]['EM500'] = 'Erreur 500: Internal server error - please try later';
$lang_new[$module_name]['EM501'] = 'Erreur 501: The request cannot be carried out by the server';
$lang_new[$module_name]['EM502'] = 'Erreur 502: Bad Gateway - the server your\'re trying to reach is sending back errors.';
$lang_new[$module_name]['EM503'] = 'Erreur 503: Temporarily Unavailable.';
$lang_new[$module_name]['EM504'] = 'Erreur 504: The Gateway has timed out.';
$lang_new[$module_name]['EM505'] = 'Erreur 505: The HTTP protocol you are asking for is not supported.';
$lang_new[$module_name]['EMUNKNOWN'] = 'Il s\'est produit une erreur que nous ne pouvons pas reconna&icirc;tre';
$lang_new[$module_name]['EMHOME'] = 'Retour &agrave; la page d\'acceuil';
$lang_new[$module_name]['EMSORRY'] = 'Nous sommes d&eacute;sol&eacute;s pour les probl&egrave;mes';
$lang_new[$module_name]['EMRECDATA'] = '<strong>NOTE:</strong> nous avons enregistr&eacute; les donn&eacute;es suivantes pour suivre le probl&egrave;me.';
$lang_new[$module_name]['EMDATETIME'] = 'Date / Heure';
$lang_new[$module_name]['EMSORT'] = 'Trier les erreurs';
$lang_new[$module_name]['EMREF'] = 'R&eacute;f&eacute;rer';
$lang_new[$module_name]['EMIP'] = 'Adresse IP';
$lang_new[$module_name]['EMURL'] = 'Erreur d\'URL';
// Error Manager v2.1 Admin:
$lang_new[$module_name]['EMATITLE'] = 'Erreur';
$lang_new[$module_name]['EMABACKMAIN'] = 'Retour au Menu d\'Administration';
$lang_new[$module_name]['EMALIST'] = 'Les erreurs suivantes ont &eacute;t&eacute; trouv&eacute; sur votre site';
$lang_new[$module_name]['EMADELALL'] = 'Tout &eacute;ffacer';
$lang_new[$module_name]['EMADEL'] = '&Eacute;ffacer les erreurs';
$lang_new[$module_name]['EMADELETED'] = 'L\'erreur est supprim&eacute;e de la base de donn&eacute;es';
$lang_new[$module_name]['EMABACK'] = 'Retour &agrave; la gestion des erreurs d\'administration';
$lang_new[$module_name]['EMADELETEDALL'] = 'Toutes les erreurs sont supprim&eacute;s de la base de donn&eacute;es';
$lang_new[$module_name]['EMCONFIG'] = 'Param&egrave;tres';
$lang_new[$module_name]['EMSHOWERRORS'] = 'Voir les erreurs';
$lang_new[$module_name]['EALOGERRORS'] = 'Enregister les erreurs dans la base de donn&eacute;es?';
$lang_new[$module_name]['EASHOWIMAGE'] = 'Voir l\'image?';
$lang_new[$module_name]['EASHOWMODULBLOCKS'] = 'Voir les blocks?';
$lang_new[$module_name]['EASHOWINFOSAVED'] = 'Dire aux visiteurs que l\'information est enregistr&eacute;e?<BR>(Utile seulement si \'log des erreurs dans la DB\' est ON)';
$lang_new[$module_name]['TOTALERRORS'] = 'Nombre d\'erreur sur votre site nuke';
$lang_new[$module_name]['RESETCOUNTER'] = '(Mise &agrave; z&eacute;ro du compteur)';
$lang_new[$module_name]['EMADATETIME'] = 'Date / Heure';
$lang_new[$module_name]['EMASORT'] = 'Trier les erreurs';
$lang_new[$module_name]['EMAREF'] = 'R&eacute;f&eacute;rer';
$lang_new[$module_name]['EMAIP'] = 'Adresse IP';
$lang_new[$module_name]['EMAURL'] = 'Erreur d\'URL';
$lang_new[$module_name]['SAVECHANGES'] = 'Sauvegarder les changements';

?>