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

$lang_admin[$adminpoint]['CACHENOTALLOWED'] = 'U heeft geen rechten dit bestand te bekijken!';
$lang_admin[$adminpoint]['CACHESAFEMODE'] = 'De Safe Mode is op uw server geactiveerd, Cache zal niet functioneren!';

$lang_admin[$adminpoint]['CACHE_BAD'] = 'De Cache heeft niet de benodigde rechten (chmod)!';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_FAIL'] = 'Categorie wissen is mislukt';
$lang_admin[$adminpoint]['CACHE_CAT_DELETE_SUCC'] = 'Categorie succesvol gewist';
$lang_admin[$adminpoint]['CACHE_CLEAR'] = 'Cache legen';
$lang_admin[$adminpoint]['CACHE_CLEARED_FAIL'] = 'Cache kon niet geleegd worden';
$lang_admin[$adminpoint]['CACHE_CLEARED_SUCC'] = 'Cache succesvol geleegd';
$lang_admin[$adminpoint]['CACHE_CLEARNOW'] = 'Nu legen';
$lang_admin[$adminpoint]['CACHE_DELETE'] = 'Wissen';
$lang_admin[$adminpoint]['CACHE_DIR_STATUS'] = 'Cache Status:';
$lang_admin[$adminpoint]['CACHE_DISABLED'] = 'Gedeactiveerd';
$lang_admin[$adminpoint]['CACHE_ENABLED'] = 'Geactiveerd';
$lang_admin[$adminpoint]['CACHE_ENABLE_HOW'] = 'Zet om de Cache te activeren \$use_cache auf \"true\" in config.php als dit nog niet gebeurt is.';
$lang_admin[$adminpoint]['CACHE_FILEMODE'] = 'Cache bestand';
$lang_admin[$adminpoint]['CACHE_FILENAME'] = 'Bestandsnaam';
$lang_admin[$adminpoint]['CACHE_FILESIZE'] = 'Bestandsgrootte';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_FAIL'] = 'Wissen van het bestand mislukt';
$lang_admin[$adminpoint]['CACHE_FILE_DELETE_SUCC'] = 'Bestand succesvol gewist';
$lang_admin[$adminpoint]['CACHE_GOOD'] = 'Goed';
$lang_admin[$adminpoint]['CACHE_HEADER'] = 'Nuke-Evolution Cache :: Administratie menu';
$lang_admin[$adminpoint]['CACHE_HOWTOENABLE'] = 'Hoe geactiveerd?';
$lang_admin[$adminpoint]['CACHE_INVALID'] = 'Ongeldige aktie';
$lang_admin[$adminpoint]['CACHE_LASTMOD'] = 'Laatste aanpassing';
$lang_admin[$adminpoint]['CACHE_LAST_CLEARED'] = 'Cache het laatst geleegd:';
$lang_admin[$adminpoint]['CACHE_MODE'] = 'Cache Mode';
$lang_admin[$adminpoint]['CACHE_NO'] = 'Nee';
$lang_admin[$adminpoint]['CACHE_NUM_FILES'] = 'aantal van tussentijds opgeslagen bestanden:';
$lang_admin[$adminpoint]['CACHE_OPTIONS'] = 'Opties';
$lang_admin[$adminpoint]['CACHE_PREF_UPDATED_SUCC'] = 'Succesvol geactualiseerd';
$lang_admin[$adminpoint]['CACHE_RETURN'] = 'Terug naar het hoofdmenu';
$lang_admin[$adminpoint]['CACHE_RETURNCACHE'] = 'Terug naar de Cache Administratie';
$lang_admin[$adminpoint]['CACHE_SIZE'] = 'Cache Grootte:';
$lang_admin[$adminpoint]['CACHE_SQLMODE'] = 'SQL Cache';
$lang_admin[$adminpoint]['CACHE_STATUS'] = 'Cache Status:';
$lang_admin[$adminpoint]['CACHE_USER_CAN_CLEAR'] = 'Gebruiker mag Cache legen:';
$lang_admin[$adminpoint]['CACHE_VIEW'] = 'Weergeven';
$lang_admin[$adminpoint]['CACHE_YES'] = 'Ja';

?>