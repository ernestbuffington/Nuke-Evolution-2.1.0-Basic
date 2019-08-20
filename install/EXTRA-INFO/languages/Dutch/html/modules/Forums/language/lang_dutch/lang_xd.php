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

// Permissions words
$lang['xd_permissions'] = 'XData Toestemming Controle';
$lang['xd_permissions_describe'] = 'Hier kan je de mogelijkheid veranderen van gebruikers om gewone profiel velden in te vullen.';
$lang['field_name'] = 'Veld Naam';
$lang['Allow'] = 'Toestaan';
$lang['Default'] = 'Standaard';
$lang['Deny'] = 'Weiger';

// Edit/Add words
$lang['Basic_Options'] = 'Standaard Opties';
$lang['Advanced_Options'] = 'Uitgebreide Opties';
$lang['Advanced_warning'] = 'Verander hier niets of je moet weten wat je aan het doen bent.';
$lang['edit_xdata_field'] = 'Edit Profiel Veld';
$lang['Name'] = 'Naam';
$lang['xd_description'] = 'Beschrijving';
$lang['type'] = 'Type';
$lang['Text'] = 'Tekst';
$lang['Text_area'] = 'Tekst Gebied';
$lang['Select'] = 'Kies Box';
$lang['Radio'] = 'Radio Knoppen';
$lang['Custom'] = 'Aangepast';
$lang['Length'] = 'Lengte';
$lang['Length_explain'] = 'De maximum lengte voor tekst of een tekstgebied veld.  Nul betekend ongelimiteerd.';
$lang['Values'] = 'Waardes';
$lang['Values_explain'] = 'De opties die verschijnen voor een kies of radio veld. Elke optie moeten worden ingesloten door enkele quotes [\'].';
$lang['Default_auth'] = 'Standaard Toestemmingen';
$lang['Default_auth_explain'] = 'Gebruikers kunnen alleen dit veld aanpassen in hun profiel als deze optie op hun persoonlijke toestemming is ingsteld op "toestaan".';
$lang['Display_viewtopic_explain'] = 'Wanneer men posts bekijkt';
$lang['Display_viewprofile_explain'] = 'Wanneer men profielen bekijkt';
$lang['Display_register_explain'] = 'Wanneer men profielen aanpast';
$lang['Display_type'] = 'Laat Zien Type';
$lang['Display_normal'] = 'Normaal';
$lang['Display_none'] = 'Geen';
$lang['Display_root'] = 'TPL Variabel';
$lang['Code_name'] = 'Naam in Templates';
$lang['Code_name_explain'] = 'Als elk van hierboven is ingesteld op "TPL Variabel", dat wordt dan de naam van de variabel waar de de is aan toegeschreven.';
$lang['Regexp'] = 'Regulaire Expressie';
$lang['Regexp_explain'] = 'Alleen waarden die overeen komen met deze regulaire expressie worden toegestaan. (PCRE-Style)';
$lang['add_xdata_field'] = 'Voeg Profiel Veld Toe';
$lang['Add_success'] = 'Veld met succes toegevoegd';
$lang['Delete_success'] = 'Veld met succes verwijderd';
$lang['Edit_success'] = 'Veld informatie met succes bijgewerkt';
$lang['Click_return_fields'] = 'Klik %sHIER%s om terug te keren naar Velden Administratie';
$lang['Regexp_error'] = 'Je hebt een fout in je regulaire expressie syntax:';
$lang['handle_input'] = 'Handvat Invoer';
$lang['handle_input_explain'] = 'Kies "ja" of wil je een eigen invoer handvat wilt maken voor dit veld.';
$lang['Allow_smilies'] = 'Smilies Toestaan';
$lang['Allow_BBCode'] = 'BBCode Toestaan';
$lang['Allow_html'] = 'HTML Toestaan';
$lang['Viewtopic'] = 'Laat zien wanneer men onderwerpen bekijkt';
$lang['Signup'] = 'Laat zien gedurende inschrijven';

// Delete words
$lang['Confirm'] = 'Bevestig';
$lang['Are_you_sure'] = 'Weet je zeker dat je "%s" veld wilt verwijderen?';

// Main Menu words
$lang['Profile_admin'] = 'Profiel Velden Administratie';
$lang['Xdata_view_description'] = 'Hier kan je de extra velden beschikbaar in gebruikers profielen bekijken of aanpassen.';
$lang['xd_move'] = 'Verplaats';
$lang['xd_move_up'] = 'Verplaats Omhoog';
$lang['xd_move_down'] = 'Verplaats Omlaag';
$lang['xd_operations'] = 'Operaties';
$lang['Edit_field'] = 'Edit';
$lang['Delete_field'] = 'Verwijder';
$lang['No_fields'] = 'Er bestaan geen velden';
$lang['Add_field'] = 'Voeg Nieuw Veld Toe';

// Error
$lang['XD_duplicate_name'] = 'Een veld bestaat al in de template naam die je koos.'

?>