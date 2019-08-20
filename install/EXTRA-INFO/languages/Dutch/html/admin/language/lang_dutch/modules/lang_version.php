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

$lang_admin[$adminpoint]['VERSIONCTL_BACK'] = 'Zur&uuml;ck';

$lang_admin[$adminpoint]['VERSIONCTL_CHECKVER'] = 'Klik hier om deze versie te controleren.';
$lang_admin[$adminpoint]['VERSIONCTL_CHG'] = 'Er is een nieuwe versie van Nuke-Evolution beschikbaar.';
$lang_admin[$adminpoint]['VERSIONCTL_CHGLOG'] = 'Nuke-Evolution wijzigingslijst';
$lang_admin[$adminpoint]['VERSIONCTL_CUR'] = 'U heeft de laatste versie';

$lang_admin[$adminpoint]['VERSIONCTL_Download'] = 'Download';

$lang_admin[$adminpoint]['VERSIONCTL_ERRCON'] = 'Geen contact met www.evo-german.com mogelijk';
$lang_admin[$adminpoint]['VERSIONCTL_ERRSQL'] = 'De huidige versie kon niet uit de database gelezen worden.';
$lang_admin[$adminpoint]['VERSIONCTL_ERR_CHG'] = 'Er is een probleem met de lijst ophalen van de wijzigingen.';
$lang_admin[$adminpoint]['VERSIONCTL_ERR_CON'] = 'Op <a href="http://www.evo-german.com">Nuke-Evolution Germany</a> kan op dit moment geen contact worden opgenomen.';

$lang_admin[$adminpoint]['VERSIONCTL_TITLE'] = 'Nuke-Evolution Versie';
$lang_admin[$adminpoint]['VERSIONCTL_TITLE'] = 'Nuke-Evolution Versie controle';

$lang_admin[$adminpoint]['VERSIONCTL_VER'] = 'De actuele versie is:';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONCURRENTINFO'] = 'Uheeft <strong>Nuke Evolution %s</strong>.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONFUNCTIONSDISABLED'] = 'De Socket-Funktie van uw webserver kon niet gebruikt worden.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONLATESTINFO'] = 'De laatste beschikbare versie is <strong>Nuke Evolution %s</strong>.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONOUTOFDATE'] = 'Uw installatie schijnt <strong>niet actueel</strong> te zijn. <br />Er zijn updates beschikbaar voor uw  Nuke-Evolution Versie. <br />Kijk op <a href="http://www.evo-german.com/modules.php?name=Downloads" target="_blank">http://www.evo-german.com/modules.php?name=Downloads</a> om te nieuwste versie te verkrijgen.';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONSOCKETERROR'] = 'Helaas is er geen verbinding mogelijk met de Evo-German Server. De fout die opgetreden is is:<br />%s';
$lang_admin[$adminpoint]['VERSIONCTL_VERSIONUP2DATE'] = 'Uw installatie is actueel, er zijun geen updates beschikbaar voor uw versie van Nuke-Evolution Version.';
$lang_admin[$adminpoint]['VERSIONCTL_VIEW'] = 'Nieuwe versie weergeven';
$lang_admin[$adminpoint]['VERSIONCTL_YOURVER'] = 'Uw versie is:';

?>