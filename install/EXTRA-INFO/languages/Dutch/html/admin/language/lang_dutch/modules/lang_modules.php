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

$lang_admin[$adminpoint]['MODULES_ACTIVATE'] = 'Activeren';
$lang_admin[$adminpoint]['MODULES_ACTIVE'] = 'De module is geactiveerd.';
$lang_admin[$adminpoint]['MODULES_ADMIN_HEADER'] = 'Nuke-Evolution Module : Admin Paneel';
$lang_admin[$adminpoint]['MODULES_ALL'] = 'Alle';

$lang_admin[$adminpoint]['MODULES_BLOCK'] = 'Moduleblok';
$lang_admin[$adminpoint]['MODULES_BLOCKS_BOTH'] = 'Beide blokken';
$lang_admin[$adminpoint]['MODULES_BLOCKS_LEFT'] = 'Linker blokken';
$lang_admin[$adminpoint]['MODULES_BLOCKS_NONE'] = 'Geen';
$lang_admin[$adminpoint]['MODULES_BLOCKS_RIGHT'] = 'Rechter blokken';
$lang_admin[$adminpoint]['MODULES_BLOCKS_SHOW'] = 'bloken weergeven';

$lang_admin[$adminpoint]['MODULES_CAT_COLLAPSE'] = 'Deze categorie dichtvouwen? ';
$lang_admin[$adminpoint]['MODULES_CAT_DELETE'] = 'Categorie wissen';
$lang_admin[$adminpoint]['MODULES_CAT_EDIT'] = 'Categorie bewerken';
$lang_admin[$adminpoint]['MODULES_CAT_IMG'] = 'Bestandsnaam van de categorieafbeelding';
$lang_admin[$adminpoint]['MODULES_CAT_IMG_NOTE'] = 'Categorieafbeeldingen moet in <i>images/blocks/modules/</i> opgeslagen worden.';
$lang_admin[$adminpoint]['MODULES_CAT_LINK_TITLE'] = 'Link Titel';
$lang_admin[$adminpoint]['MODULES_CAT_ORDER'] = 'Categorie volgorde aanpassen';
$lang_admin[$adminpoint]['MODULES_CAT_TITLE'] = 'Titel der Categorie';
$lang_admin[$adminpoint]['MODULES_COLLAPSE'] = 'openklapbare Categorien ?';
$lang_admin[$adminpoint]['MODULES_CUSTOMTITLE'] = 'Speciale Titel';

$lang_admin[$adminpoint]['MODULES_DEACTIVATE'] = 'Deactiveren';
$lang_admin[$adminpoint]['MODULES_DOUBLECLICK'] = '(Dubbelklik om te activeren/deactiveren)';

$lang_admin[$adminpoint]['MODULES_EDIT'] = 'Module aanpassen';
$lang_admin[$adminpoint]['MODULES_ERROR_CAT_NF'] = 'De categorie is niet gevonden';
$lang_admin[$adminpoint]['MODULES_ERROR_GROUPS'] = 'U dient tenminste 1 groep te selecteren';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE'] = 'U dient een titel en een link opgeven';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EMPTY'] = 'U moet een titel opgeven';
$lang_admin[$adminpoint]['MODULES_ERROR_TITLE_EXIST'] = 'De door u opgegeven titel bestaat reeds<br />Geef een nieuwe titel op<br /><br />';
$lang_admin[$adminpoint]['MODULES_EXPLAIN'] = 'Letop  datwanneer u een module module avtiveerd of deactiveerd<br />word deze voor de gebruiker direkt zichtbaar. Voor u pas wanneer u uw Browser actualiseerd!';
$lang_admin[$adminpoint]['MODULES_EXPLAIN2'] = 'U <strong>MOET</strong> de verandering in de sorteer volgorde bevestigen voordat deze opgeslagen word.<br />De aanpassing word niet automatisch opgeslagen !';

$lang_admin[$adminpoint]['MODULES_FUNCTIONS'] = 'Functies';

$lang_admin[$adminpoint]['MODULES_INACTIVE'] = 'De module is niet geactiveerd.';
$lang_admin[$adminpoint]['MODULES_INHOME'] = 'Geladen Module op de voorpagina:';

$lang_admin[$adminpoint]['MODULES_LINK'] = 'Is een link';
$lang_admin[$adminpoint]['MODULES_LINK_DELETE'] = 'Link wissen';

$lang_admin[$adminpoint]['MODULES_MODULEHOMENOTE'] = 'Vet gedrukte module-Titel geven de module titel aan die op de voorpagina geladen word.<br />Deze module kan niet verwijderd worden zo lang het een standaard module is.!<br />Als de standaard module gewist verschijnt er eenfoutmelding op de voorpagina.<br />Deze module word ook na het aanklikken van de link op de voorpagina geladen.';
$lang_admin[$adminpoint]['MODULES_MODULEINFO'] = 'TIP';
$lang_admin[$adminpoint]['MODULES_MVADMIN'] = 'Alleen administrators';
$lang_admin[$adminpoint]['MODULES_MVALL'] = 'Alle bezoeker';
$lang_admin[$adminpoint]['MODULES_MVANON'] = 'Alleen gasten';
$lang_admin[$adminpoint]['MODULES_MVGROUPS'] = 'Alleen groepsleden';
$lang_admin[$adminpoint]['MODULES_MVUSERS'] = 'Alleen geregistreerde gebruikers';

$lang_admin[$adminpoint]['MODULES_NF_VALUES'] = 'Er konden geen waarden toegekend worden';
$lang_admin[$adminpoint]['MODULES_NOTINMENU'] = 'Defineer een module waarbij hun naam en link in het module blok niet zichtbaar zijn';

$lang_admin[$adminpoint]['MODULES_REFRESH SCREEN'] = 'Weergave actualiseren';

$lang_admin[$adminpoint]['MODULES_SAVECHANGES'] = 'Wijzigingen opslaan';
$lang_admin[$adminpoint]['MODULES_SHOW'] = 'Weergeven';
$lang_admin[$adminpoint]['MODULES_SHOWINMENU'] = 'in moduleblok weergeven?';

$lang_admin[$adminpoint]['MODULES_TITLE'] = 'Titel';

$lang_admin[$adminpoint]['MODULES_URL'] = 'URL';

$lang_admin[$adminpoint]['MODULES_VIEW'] = 'Weergeven';
$lang_admin[$adminpoint]['MODULES_VIEWPRIV'] = 'Wie mag dit bekijken';

$lang_admin[$adminpoint]['MODULES_WHATGRDESC'] = 'Welke groepen';
$lang_admin[$adminpoint]['MODULES_WHATGROUPS'] = 'Groepen';

?>