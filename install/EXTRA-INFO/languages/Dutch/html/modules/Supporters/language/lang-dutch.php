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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

global $supporter_config, $module_name;
$lang_new[$module_name]['SP_ACTIVATE'] = 'Activeren';
$lang_new[$module_name]['SP_ACTIVESITES'] = 'Actieve paginas';
$lang_new[$module_name]['SP_ADDED'] = 'Toegevoegd';
$lang_new[$module_name]['SP_ADDSUPPORTER'] = 'Supporter toevoegen';
$lang_new[$module_name]['SP_ADMINMAIN'] = 'Supporter-Administratie';
$lang_new[$module_name]['SP_ADMIN_HEADER'] = 'Nuke-Evolution Supporter :: Module Administratie';
$lang_new[$module_name]['SP_ALLREQ'] = 'Alle velden verplicht';
$lang_new[$module_name]['SP_APPROVE'] = 'Vrijgegeven';
$lang_new[$module_name]['SP_APPROVESITE'] = 'Pagina vrijgeven';
$lang_new[$module_name]['SP_BESUPPORTER'] = 'Supporter worden';
$lang_new[$module_name]['SP_CONFBANN'] = 'foutieve Upload';
$lang_new[$module_name]['SP_CONFIGMAIN'] = 'Supporter Configuratien';
$lang_new[$module_name]['SP_DBERROR1'] = 'FOUT: kon niet naar de database schrijven';
$lang_new[$module_name]['SP_DEACTIVATE'] = 'Deactiveren';
$lang_new[$module_name]['SP_DELETESITE'] = 'Pagina verwijderen';
$lang_new[$module_name]['SP_DESCRIPTION'] = 'Omschrijving';
$lang_new[$module_name]['SP_EDITED'] = 'Laatste gewijzigd op';
$lang_new[$module_name]['SP_EDITED_USER'] = 'gewijzigd door';
$lang_new[$module_name]['SP_EDITSITE'] = 'Pagina bewerken';
$lang_new[$module_name]['SP_EDITSITE'] = 'Pagina bewerken';
$lang_new[$module_name]['SP_FILETYPERROR'] = 'Verkeerde bestandsformaat. Er zijn alleen afbeeldingen (gif, jpg, jpeg, png, swf) toegestaan';
$lang_new[$module_name]['SP_GOTOADMIN'] = 'Supporter Admin';
$lang_new[$module_name]['SP_IMAGE'] = 'Pagina afbeelding';
$lang_new[$module_name]['SP_IMAGETYPE'] = 'Afbeeldings type';
$lang_new[$module_name]['SP_IMAGETYPE0'] = 'Dit is een URL van een afbeelding!';
$lang_new[$module_name]['SP_IMAGETYPE1'] = 'Afbeelding is geupload!';
$lang_new[$module_name]['SP_IMAGE_UPLOAD'] = 'Pagina afbeelding uploaden <br /><small>Als beide afbeeldings types opgegeven zijn word het geuploade bestand voorgetrokken</small>';
$lang_new[$module_name]['SP_IMAGE_URL'] = 'URL pagina afbeelding';
$lang_new[$module_name]['SP_INACTIVESITES'] = 'Inactieve paginas';
$lang_new[$module_name]['SP_LINKED'] = 'Gelinkt';
$lang_new[$module_name]['SP_MAXHEIGHT'] = 'max hoogte afbeelding';
$lang_new[$module_name]['SP_MAXWIDTH'] = 'max breedte afbeelding';
$lang_new[$module_name]['SP_MISSINGDATA'] = 'Formuliergegevens niet gevonden!';
$lang_new[$module_name]['SP_MUSTBE'] = 'Afbeeldingen die groter zijn dan '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' worden tot '.$supporter_config['max_width'].'x'.$supporter_config['max_height'].' verkleind weergegeven.';
$lang_new[$module_name]['SP_NAME'] = 'Naam pagina';
$lang_new[$module_name]['SP_NOACTIVESITES'] = 'Er zijn geen actieve paginas.';
$lang_new[$module_name]['SP_NOINACTIVESITES'] = 'Er zijn geen inactieve paginas.';
$lang_new[$module_name]['SP_NOSUBMITTEDSITES'] = 'Er zijn geen toegestuurde paginas.';
$lang_new[$module_name]['SP_NOUPLOAD'] = 'Afbeelding werd niet goed geupload.';
$lang_new[$module_name]['SP_REQUIREUSER'] = 'Registrering succesvol';
$lang_new[$module_name]['SP_RETURNMAIN'] = 'Terug naar hoofdadministratie';
$lang_new[$module_name]['SP_SAVECHANGES'] = 'Wijzigingen opslaan';
$lang_new[$module_name]['SP_SITEID'] = 'Pagina ID';
$lang_new[$module_name]['SP_SUBMITSITE'] = 'Pagina toesturen';
$lang_new[$module_name]['SP_SUBMITTED'] = 'Toegestuurt';
$lang_new[$module_name]['SP_SUBMITTEDSITES'] = 'Toegezonden paginas';
$lang_new[$module_name]['SP_SUPPORTEDBY'] = 'Ondersteund door';
$lang_new[$module_name]['SP_SUPPORTERS'] = 'Supporter';
$lang_new[$module_name]['SP_SURE2DELETE'] = 'Wilt u deze pagina werkelijk verwijderen?';
$lang_new[$module_name]['SP_UPLOAD'] = 'Uploaden';
$lang_new[$module_name]['SP_UPLOADERROR'] = 'Bestand werd niet geupload';
$lang_new[$module_name]['SP_URL'] = 'URL Pagina';
$lang_new[$module_name]['SP_USEREMAIL'] = 'E-Mail gebruiker';
$lang_new[$module_name]['SP_USERID'] = 'ID gebruiker';
$lang_new[$module_name]['SP_USERIP'] = 'IP gebruiker';
$lang_new[$module_name]['SP_USERNAME'] = 'Gebruikersnaam';
$lang_new[$module_name]['SP_VISITS'] = 'Bezoeken';
$lang_new[$module_name]['SP_YOUDELETE'] = 'U staat op het punt om deze pagina te verwijderen';
$lang_new[$module_name]['SP_YOUREMAIL'] = 'Uw E-Mail';
$lang_new[$module_name]['SP_YOURIP'] = 'Uw IP';
$lang_new[$module_name]['SP_YOURNAME'] = 'Uw naam';

?>